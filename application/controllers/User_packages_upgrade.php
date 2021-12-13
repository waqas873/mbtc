<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
*  Admins Management 
*
* Controller to manage Admins
*
* @package 		RDA
* @subpackage 	Admin Pannel
* @category 	Controller
* @author 		Muhammad Khalid<muhammad.khalid@pitb.gov.pk>  
* @link 		http://
*/	

class User_packages_upgrade extends CI_Controller
{
	/**
	* @var stirng
	* @access Public
	*/
	public $selected_tab = '';
	

	/** 
	* Controller constructor
	* 
	* @access public 
	*/
	public function __construct()
	{
		parent::__construct();
		$this->layout = "template";
		if($this->session->userdata('role') == "admin"){
			$this->layout = "admin";
		}
		$this->selected_tab = "upu";
		if (!$this->session->userdata("role")) {
			redirect("User/UserDashboard");
		}
		$this->load->model('Packages_model', 'packages');
		$this->load->model('User_packages_model', 'user_packages');
		$this->load->model('User_packages_upgrade_model', 'user_packages_upgrade');
		$this->load->model('Points_model','points');
		$this->load->model('Points_recieved_model','points_recieved');
		$this->load->model('Users_model','users');
		$this->load->model('User_model','User');

		date_default_timezone_set('Europe/London');
        
	}
	
	/** 
	* Controller Function to List All Admins
	* 
	* @access public 
	*/
	public function index()
	{
		if ($this->session->userdata("role") != "admin") {
			redirect("User/UserDashboard"); exit;
		}

		$where = "upu_id > 0 AND upu_status = '0'";
        $joins = array(
        	    '0' => array('table_name' => 'users users',
	                'join_on' => ' users.id = user_packages_upgrade.upu_user_id ',
	                'join_type' => 'left'
	            ),
	            '1' => array('table_name' => 'packages packages',
	                'join_on' => ' packages.package_id = user_packages_upgrade.upu_package_id ',
	                'join_type' => 'left'
	            ),
	            '2' => array('table_name' => 'user_packages user_packages',
	                'join_on' => ' user_packages.up_user_id = user_packages_upgrade.upu_user_id ',
	                'join_type' => 'left'
	            ),
	            '3' => array('table_name' => 'packages previous_package',
	                'join_on' => ' previous_package.package_id = user_packages.up_package_id ',
	                'join_type' => 'left'
	            )
        );
        $from_table = "user_packages_upgrade user_packages_upgrade";
        $select_from_table = "user_packages_upgrade.upu_id,user_packages_upgrade.upu_package_amount,user_packages_upgrade.upu_created_at,users.fullname,users.email,packages.package_name,packages.package_min_amount,packages.package_max_amount,user_packages.up_package_amount,previous_package.package_name as previous_package_name";
        $data['packages'] = $this->user_packages_upgrade->get_by_join($select_from_table, $from_table, $joins, $where, 'upu_id','DESC', '', '', '', '', '', '',true);
        //debug($data['packages'],true);
	  	$this->load->view("user_packages_upgrade/index",$data);
	}
    
    public function add($upu_id='',$pack_upgrade='')
    {
    	if ($this->session->userdata("role") == "admin") {
			redirect("User/UserDashboard"); exit;
		} 

    	$data = [];
        $user_id = $this->session->userdata('id');
        $package_detail = package_detail($user_id);
    	if(if_package_buy($user_id)){
    		$where = "package_id = '".$package_detail['up_package_id']."' OR package_id > '".$package_detail['up_package_id']."'";
            $data['packages'] = $this->packages->get_where('*', $where, true, '', '', '');
        }

        if(!empty($upu_id) && $pack_upgrade=="uQ12NQEvSa1MnP"){
            $where = "role = 'admin'";
            $result = $this->users->get_where('*', $where, true, '', '', '');
            if(!empty($result)){
                $result = $result[0];
                $data['admin_wallet_address'] = $result['wallet_address'];

                $where = "upu_id = '".$upu_id."'";
                $joins = array(
                        '0' => array('table_name' => 'packages packages',
                            'join_on' => ' packages.package_id = user_packages_upgrade.upu_package_id ',
                            'join_type' => 'left'
                        ),
                        '1' => array('table_name' => 'user_packages user_packages',
                            'join_on' => 'user_packages.up_user_id = user_packages_upgrade.upu_user_id',
                            'join_type' => 'left'
                        )
                );
                $from_table = "user_packages_upgrade user_packages_upgrade";
                $select_from_table = 'user_packages_upgrade.*,packages.*,user_packages.*';
                $package = $this->user_packages_upgrade->get_by_join($select_from_table, $from_table, $joins, $where, '','', '', '', '', '', '', '',true);
                if(!empty($package)){
                    $data['package_upgrade'] = $package[0];
                }
            }
        }

		$this->load->view("user_packages_upgrade/add",$data);
    }

	public function process_add()
	{	
		if ($this->session->userdata("role") == "admin") {
			redirect("User/UserDashboard"); exit;
		}
		$data = [];
		if(!$this->input->post()){
			$this->session->set_flashdata('error_message', 'Invalid request to activate the package.');
		    redirect('user_packages_upgrade/add');
		}
		$user_id = $this->session->userdata('id');
		$package_id = $this->input->post('package_id');
    	$up_package_amount = $this->input->post('up_package_amount');
		$pkg_detail = package_detail($user_id);
		if(empty($pkg_detail)){
        	$this->session->set_flashdata('error_message', 'Please first activate your desired package than you can upgrade your package.');
            redirect('user/user_dashboard'); exit;
        }

		if($up_package_amount <= $pkg_detail['up_package_amount']){
    		$this->session->set_flashdata('error_message', 'To upgrade your package new amount must be greater than previous package amount.');
            redirect('user_packages_upgrade/add');
            exit;
    	}
        $where = 'package_id = "'.$package_id.'"';
        $result = $this->packages->get_where('*', $where, true, '', '', '');
        $package_min_amount = $result[0]['package_min_amount'];
    	$package_max_amount = $result[0]['package_max_amount'];
    	if( $up_package_amount > $package_max_amount || $up_package_amount < $package_min_amount ){
    		$this->session->set_flashdata('error_message', "The minimum amount to upgrade this package is $".$package_min_amount." and maximum is $".$package_max_amount.".");
	        redirect('user_packages_upgrade/add');exit;
    	}
    	$amount_update = $up_package_amount-$pkg_detail['up_package_amount'];
    	//echo $amount_update; exit;
		$wallet_balance = wallet_balance($user_id);
    	if($wallet_balance < $amount_update){
    		$balance_need = $amount_update-$wallet_balance;
            $this->session->set_flashdata('error_message', "Please transfer $".$balance_need." more to your wallet to upgrade your package.");
	        redirect('user_packages_upgrade/add'); exit;
    	}
    	
        $this->db->trans_start();
    	$save = [];
    	$save['upu_user_id'] = $user_id;
	    $save['upu_package_id'] = $package_id;
    	$save['upu_package_amount'] = $up_package_amount;
    	$save['upu_previous_amount'] = $pkg_detail['up_package_amount'];
    	$save['upu_upgraded_at'] = date('Y-m-d');
    	$upu_id = $this->user_packages_upgrade->save($save);

    	update_wallet_balance($user_id,$amount_update,true);

        $update = [];
        $update['up_package_id'] = $package_id;
        $update['up_package_amount'] = $up_package_amount;
        $update['up_upgraded_at'] = date('Y-m-d');
        $this->user_packages->update_by('up_user_id',$user_id,$update);

        $where = "user_packages_upgrade.upu_id = '".$upu_id."'";
        $joins = array(
    	    '0' => array('table_name' => 'user_packages user_packages',
                'join_on' => ' user_packages.up_user_id = user_packages_upgrade.upu_user_id ',
                'join_type' => 'left'
            ),
            '1' => array('table_name' => 'users users',
                'join_on' => ' users.id = user_packages_upgrade.upu_user_id ',
                'join_type' => 'left'
            )
        );
        $from_table = "user_packages_upgrade user_packages_upgrade";
        $select_from_table = 'user_packages_upgrade.*,user_packages.*,users.*';
        $result = $this->user_packages_upgrade->get_by_join($select_from_table, $from_table, $joins, $where, '','', '', '', '', '', '', '',true);
        $result = $result[0];
        //debug($result,true);

        $user_id = $result['id'];
        $parent_id = (!empty($result['referral_id']))?$result['referral_id']:0;
        
        // .......delivering of referal bonus.........
        $pD = packageDetail($parent_id);
        if(!empty($pD)){
        	$parent_package_amount = $pD['up_package_amount'];
        	$referal_bonus = ((8/100)*$amount_update);
            update_user_balance($parent_id,$referal_bonus,false);
            daily_earnings($parent_id,$referal_bonus,"Referal Bonus",date('Y-m-d'),$user_id);
        }

        // .......delivering of points to users.........
        $no_of_points = $amount_update;
        $user_id = $result['parent_id'];
        $user_position = $result['position'];
        $condition = true;
        if($user_position == "right" || $user_position == "left"){
	        while ($user_id > 1 && $condition === true) {
                $right_points = ($user_position=="right")?$no_of_points:0;
                $left_points = ($user_position=="left")?$no_of_points:0;
                points($user_id,$left_points,$right_points);
	            $where = "id = '".$user_id."'";
                $result_2 = $this->users->get_where('*', $where, true, '', '', '');
                if(!empty($result_2)){
                	$result_2 = $result_2[0];
                	$user_position = $result_2['position'];
                	$user_id = $result_2['parent_id'];
                }
                else{
                	$condition = false;
                }
	        }
        }
        $this->db->trans_complete();

        $pkg_detail = package_detail($this->session->userdata('id'));
        $name = $this->session->userdata('fullname');
		$message = "Your package has been upgraded successfully to  ".$pkg_detail['package_name']." package.<br/><br/> ";
		$message .= "Regards,<br/>Administration of MBTC";
		send_email_to($name,$this->session->userdata('email'),$message,'Package Upgrade');
        $this->session->set_flashdata('success_message', 'Your package has been upgraded successfully.');
		redirect('user_packages_upgrade/add');
	}
	
}