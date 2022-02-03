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

class Team_purchases extends CI_Controller
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
		$this->selected_tab = "team_purchases";
		if($this->session->userdata("role") != "user"){
			redirect("sign-in");
		}
		$this->load->model('Packages_model', 'packages');
		$this->load->model('User_packages_model', 'user_packages');
		$this->load->model('User_packages_upgrade_model', 'user_packages_upgrade');
		$this->load->model('Points_model','points');
		$this->load->model('Points_recieved_model','points_recieved');
		$this->load->model('Users_model','users');
		$this->load->model('Daily_earnings_model','daily_earnings');
		$this->load->model('team_purchases_model','team_purchases');
		date_default_timezone_set('Europe/London');
	}
	
	/** 
	* Controller Function to List All Admins
	* 
	* @access public 
	*/
	public function index($status = '')
	{
	    $data = [];
	    $parent_id = $this->session->userdata('id');
		$where = "parent_id = '".$parent_id."'";
		$users_ids = $this->users->get_where('id', $where, true, '' , '', '');

        $all_data = array();
        $condition = (!empty($users_ids))?true:false;
        $ii = 0;
        while($condition===true){
        	$arr_push = array();
        	foreach($users_ids as $user_id){

        		$user_id = ($ii==0)?$user_id['id']:$user_id;

        		$where = "id = '".$user_id."'";
		        $user_detail = $this->users->get_where('*', $where, true, '' , '', '');
		        $user_detail = $user_detail[0];
		        $parent_id = $user_detail['referral_id'];
		        $parent_user = user_info($parent_id);
		        $user_detail['parent_name'] = (!empty($parent_user))?$parent_user['fullname']:'Self';
		        $all_data[] = $user_detail;

                $where = "parent_id = '".$user_id."'";
				$child_users = $this->users->get_where('id', $where, true, '' , '', '');
				foreach($child_users as $user){
                    array_push($arr_push,$user['id']);
				}
        	}
        	$users_ids = $arr_push ;
        	(empty($users_ids))?$condition=false:'';
        $ii++;	
        }
        $data['users'] = array_reverse($all_data);
        $data['packages'] = $this->packages->get_all();

        $where = "team_purchases.purchased_by = '".$this->session->userdata("id")."'";
        $joins = array(
    	    '0' => array('table_name' => 'user_packages user_packages',
                'join_on' => ' user_packages.up_id = team_purchases.up_id',
                'join_type' => 'left'
            ),
            '1' => array('table_name' => 'packages packages',
                'join_on' => ' packages.package_id = user_packages.up_package_id ',
                'join_type' => 'left'
            ),
            '2' => array('table_name' => 'users users',
                'join_on' => ' users.id = user_packages.up_user_id ',
                'join_type' => 'left'
            )
        );
        $from_table = "team_purchases team_purchases";
        $select_from_table = 'team_purchases.*,packages.package_name,users.fullname';
        $data['team_purchases'] = $this->team_purchases->get_by_join($select_from_table, $from_table, $joins, $where, 'id','DESC', '', '', '', '', '', '',true);
	  	$this->load->view("team_purchases/index",$data);
	}
	
	public function process_add()
	{	
		$data = [];
		$formData = $this->input->post();
		if(empty($formData['id']) || empty($formData['package_id']) || empty($formData['up_package_amount'])){
            redirect('team_purchases');
		}
        
        $logged_in_user = $this->session->userdata('id');

		$user_id = $formData['id'];
		$package_id = $formData['package_id'];
    	$up_package_amount = $formData['up_package_amount'];

    	$where = 'package_id = "'.$package_id.'"';
        $result = $this->packages->get_where('*', $where, true, '', '', '');
        $package_min_amount = $result[0]['package_min_amount'];
    	$package_max_amount = $result[0]['package_max_amount'];
    	$package_fees =  $result[0]['package_fees'];
    	$package_name =  $result[0]['package_name'];

    	if( $up_package_amount <= $package_max_amount && $up_package_amount >= $package_min_amount ){

    		$wallet_balance = wallet_balance($logged_in_user);
        	$package_with_fees = $up_package_amount+$package_fees;
        	// if($wallet_balance<$package_with_fees){
        	// 	$wallet_balance = $wallet_balance+0.2;
        	// }

    		$data = [];
    		$data['up_package_amount'] = $formData['up_package_amount'];
    		$data['up_user_id'] = $user_id;
    		$data['up_package_id'] = $package_id;
    		$data['up_activated_at'] = date('Y-m-d');
    		$data['up_created_at'] = date('Y-m-d H:i:s');
    		$where = 'up_user_id = "'.$user_id.'"';
            $result = $this->user_packages->get_where('*', $where, true, '', '', '');
            if(!empty($result)){
                $this->process_update($formData);
            }

            if($package_with_fees>$wallet_balance){
                $balance_need = $package_with_fees-$wallet_balance;
                $this->session->set_flashdata('error_message', "Please transfer $".$balance_need." more to your wallet to purchase this package including $".$package_fees." Fee.");
                redirect('team_purchases'); exit;
            }

            $this->db->trans_start();
        	$up_id = $this->user_packages->save($data);
        	$tp = [];
        	$tp['purchased_by'] = $logged_in_user;
        	$tp['up_id'] = $up_id;
        	$tp['amount'] = $formData['up_package_amount'];
        	$tp['type'] = 1;
        	$this->team_purchases->save($tp);

        	update_wallet_balance($logged_in_user,$package_with_fees,true);

            $where = "user_packages.up_id = '".$up_id."'";
            $joins = array(
        	    '0' => array('table_name' => 'users users',
	                'join_on' => ' users.id = user_packages.up_user_id ',
	                'join_type' => 'left'
	            ),
	            '1' => array('table_name' => 'packages packages',
	                'join_on' => ' packages.package_id = user_packages.up_package_id ',
	                'join_type' => 'left'
	            )
	        );
	        $from_table = "user_packages user_packages";
	        $select_from_table = 'user_packages.*,packages.*,users.*';
	        $result = $this->user_packages->get_by_join($select_from_table, $from_table, $joins, $where, 'up_id','DESC', '', '', '', '', '', '',true);
	        $result = $result[0];

	        $user_id = $result['id'];
	        $parent_id = (!empty($result['referral_id']))?$result['referral_id']:0;
            
            // .......delivering of referral bonus.........
            $packageDetail = packageDetail($parent_id);
	        if(!empty($packageDetail)){
	        	$parent_package_amount = $packageDetail['up_package_amount'];
                $referal_bonus = ((8/100)*$result['up_package_amount']);
                update_user_balance($parent_id,$referal_bonus,false);
                daily_earnings($parent_id,$referal_bonus,"Referal Bonus",date('Y-m-d'),$user_id);
	        }

	        // .......delivering of points to users.........

	        $no_of_points = $result['up_package_amount'];
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

        	$user_info = user_info($formData['id']);
        	if(!empty($user_info)){
        		$name = $user_info['fullname'];
        		$username = $user_info['username'];
        		$message = "You have successfully activated ".$package_name." package of amount $".$up_package_amount.".<br/><br/> ";
				$message .= "Username: ".$username." <br/><br/>";
				$message .= "Package Activated at: ".date('Y-m-d H:i:s')." <br/><br/>";
				$message .= "Regards,<br/>Administration of Mega Bussiness of Trading Company";
				send_email_to($name,$user_info['email'],$message,'Package Activation');
        	}
			$this->session->set_flashdata('success_message', 'You have activated this package successfully.');
            redirect('team_purchases'); exit;
            
    	}
    	else{
    		$this->session->set_flashdata('error_message', "The minimum amount to activate this package is $".$package_min_amount." and maximum is $".$package_max_amount.".");
	        redirect('team_purchases');
    	}
	}

    public function process_update($formData = [])
    {   
        if ($this->session->userdata("role") == "admin") {
            redirect("User/UserDashboard"); exit;
        }
        $data = [];
        if(empty($formData)){
            $this->session->set_flashdata('error_message', 'Invalid request to upgrade the package.');
            redirect('team_purchases');
        }

        $logged_in_user = $this->session->userdata('id');

        $user_id = $formData['id'];
        $package_id = $formData['package_id'];
        $up_package_amount = $formData['up_package_amount'];

        $pkg_detail = package_detail($user_id);
        if(empty($pkg_detail)){
            $this->session->set_flashdata('error_message', 'Please first activate your desired package than you can upgrade your package.');
            redirect('team_purchases'); exit;
        }

        if($up_package_amount <= $pkg_detail['up_package_amount']){
            $this->session->set_flashdata('error_message', 'To upgrade your package new amount must be greater than previous package amount.');
            redirect('team_purchases');
            exit;
        }
        $where = 'package_id = "'.$package_id.'"';
        $result = $this->packages->get_where('*', $where, true, '', '', '');
        $package_min_amount = $result[0]['package_min_amount'];
        $package_max_amount = $result[0]['package_max_amount'];
        if( $up_package_amount > $package_max_amount || $up_package_amount < $package_min_amount ){
            $this->session->set_flashdata('error_message', "The minimum amount to upgrade this package is $".$package_min_amount." and maximum is $".$package_max_amount.".");
            redirect('team_purchases');exit;
        }
        $amount_update = $up_package_amount-$pkg_detail['up_package_amount'];
        $wallet_balance = wallet_balance($logged_in_user);
        if($wallet_balance < $amount_update){
            $balance_need = $amount_update-$wallet_balance;
            $this->session->set_flashdata('error_message', "Please transfer $".$balance_need." more to your wallet to upgrade your package.");
            redirect('team_purchases'); exit;
        }
        
        $this->db->trans_start();
        $save = [];
        $save['upu_user_id'] = $user_id;
        $save['upu_package_id'] = $package_id;
        $save['upu_package_amount'] = $up_package_amount;
        $save['upu_previous_amount'] = $pkg_detail['up_package_amount'];
        $save['upu_upgraded_at'] = date('Y-m-d');
        $upu_id = $this->user_packages_upgrade->save($save);

        update_wallet_balance($logged_in_user,$amount_update,true);

        $update = [];
        $update['up_package_id'] = $package_id;
        $update['up_package_amount'] = $up_package_amount;
        $update['up_upgraded_at'] = date('Y-m-d');
        $this->user_packages->update_by('up_user_id',$user_id,$update);

        $tp = [];
        $tp['purchased_by'] = $logged_in_user;
        $tp['up_id'] = $pkg_detail['up_id'];
        $tp['amount'] = $amount_update;
        $tp['type'] = 2;
        $this->team_purchases->save($tp);

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
        $this->session->set_flashdata('success_message', 'Package has been upgraded successfully.');
        redirect('team_purchases');
    }
	
}