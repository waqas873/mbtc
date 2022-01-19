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
        // $where = "";
        // $joins = array(
        // 	    '0' => array('table_name' => 'users users',
	       //          'join_on' => ' users.id = user_packages.up_user_id ',
	       //          'join_type' => 'left'
	       //      ),
	       //      '1' => array('table_name' => 'packages packages',
	       //          'join_on' => ' packages.package_id = user_packages.up_package_id ',
	       //          'join_type' => 'left'
	       //      )
        // );
        // $from_table = "user_packages user_packages";
        // $select_from_table = 'user_packages.*,packages.*,users.*';
        // $data['packages'] = $this->user_packages->get_by_join($select_from_table, $from_table, $joins, $where, 'up_id','DESC', '', '', '', '', '', '',true);
        //debug($data['packages'],true);
	  	$this->load->view("team_purchases/index",$data);
	}
	
	public function process_add()
	{	
		$data = array();
		if($this->input->post()){
			$user_id = $this->session->userdata('id');
			$package_id = $this->input->post('package_id');
        	$up_package_amount = $this->input->post('up_package_amount');

        	$where = 'package_id = "'.$package_id.'"';
            $result = $this->packages->get_where('*', $where, true, '', '', '');
            $package_min_amount = $result[0]['package_min_amount'];
        	$package_max_amount = $result[0]['package_max_amount'];
        	$package_fees =  $result[0]['package_fees'];
        	$package_name =  $result[0]['package_name'];

        	if( $up_package_amount <= $package_max_amount && $up_package_amount >= $package_min_amount ){

        		$wallet_balance = wallet_balance($user_id);
	        	$package_with_fees = $up_package_amount+$package_fees;
	        	// if($wallet_balance<$package_with_fees){
	        	// 	$wallet_balance = $wallet_balance+0.2;
	        	// }

	        	if($package_with_fees>$wallet_balance){
	        		$balance_need = $package_with_fees-$wallet_balance;
	                $this->session->set_flashdata('error_message', "Please transfer $".$balance_need." more to your wallet to purchase this package including $".$package_fees." Fee.");
			        redirect('user/user_dashboard'); exit;
	        	}

        		$data = $this->input->post();
        		$data['up_user_id'] = $user_id;
        		$data['up_package_id'] = $package_id;
        		$data['up_activated_at'] = date('Y-m-d');
        		$data['up_created_at'] = date('Y-m-d H:i:s');
        		unset($data['package_id']);
        		$where = 'up_user_id = "'.$user_id.'"';
                $result = $this->user_packages->get_where('*', $where, true, '', '', '');
                if(!empty($result)){
            	   	$this->session->set_flashdata('error_message', 'You already have purchased a package. you can now upgrade your package.');
	                redirect('user/user_dashboard'); exit;
                }
                // if($up_package_amount>4499){
            	   // 	$this->session->set_flashdata('error_message', 'You cannot purchase a package more than $1000.');
	               //  redirect('user/user_dashboard'); exit;
                // }
                $this->db->trans_start();
            	$up_id = $this->user_packages->save($data);

            	update_wallet_balance($user_id,$package_with_fees,true);

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

            	$name = $this->session->userdata('fullname');
            	$username = '';
            	$user_info = user_info($this->session->userdata("id"));
            	if(!empty($user_info)){
            		$username = $user_info['username'];
            	}
				$message = "You have successfully activated ".$package_name." package of amount $".$up_package_amount.".<br/><br/> ";
				$message .= "Username: ".$username." <br/><br/>";
				$message .= "Package Activated at: ".date('Y-m-d H:i:s')." <br/><br/>";
				$message .= "Regards,<br/>Administration of Mega Bussiness of Trading Companies";
				send_email_to($name,$this->session->userdata('email'),$message,'Package Activation');

				$this->session->set_flashdata('success_message', 'You have activated this package successfully.');
                redirect('user/user_dashboard'); exit;
                
        	}
        	else{
        		$this->session->set_flashdata('error_message', "The minimum amount to activate this package is $".$package_min_amount." and maximum is $".$package_max_amount.".");
		        redirect('user/user_dashboard');
        	}
		}
		else{
			$this->session->set_flashdata('error_message', 'Invalid request to activate the package.');
		    redirect('user/user_dashboard');
		}
	}

	public function get_package()
    {   
    	$this->layout = " ";
    	$data = array();
        if( $this->input->post() ){
            $where = 'package_id = "' . $this->input->post('package_id') . '"';
            $result = $this->packages->get_where('*', $where, true, '', '', '');
            if( count($result) >= 1 ){
            	$data = $result[0];
            }
        }
        echo json_encode($data);
    }

    public function check_package_amount()
    {
    	$this->layout = " ";
    	$data = array();
    	$data['response'] = false;
        if( $this->input->post() ){
        	$package_id = $this->input->post('package_id');
        	$up_package_amount = $this->input->post('up_package_amount');
            $where = 'package_id = "'.$package_id.'"';
            $result = $this->packages->get_where('*', $where, true, '', '', '');
            $package_min_amount = $result[0]['package_min_amount'];
        	$package_max_amount = $result[0]['package_max_amount'];
        	if( $up_package_amount <= $package_max_amount && $up_package_amount >= $package_min_amount ){
        		$data['response'] = true;
        	}
            
        }
        echo json_encode($data);
    }

	
}