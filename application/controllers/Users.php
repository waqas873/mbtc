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

class Users extends CI_Controller
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
		$this->selected_tab = "users";
		if ($this->session->userdata("role") != "admin") {
			redirect("User/Userdashboard");
		}
		$this->load->model('Packages_model', 'packages');
		$this->load->model('Users_model','users');
		$this->load->model('Daily_earnings_model','daily_earnings');
		$this->load->model('Withdraws_model','withdraws');
		$this->load->model('Points_model','points');
		$this->load->model('Rewards_model','rewards');
		$this->load->model('User_rewards_model','user_rewards');
        $this->load->model('wallets_model','wallets');

        date_default_timezone_set("America/Los_Angeles");
        
	}
	
	/** 
	* Controller Function to List All Admins
	* 
	* @access public 
	*/
	public function index()
	{
		$data = array();
		$where = "id > 1";
        $joins = array(
            '0' => array('table_name' => 'wallets wallets',
                'join_on' => 'wallets.wallet_user_id = users.id',
                'join_type' => 'left'
            )
        );
        $from_table = "users users";
        $select_from_table = "users.*,wallets.wallet_balance";
        $users = $this->users->get_by_join($select_from_table, $from_table, $joins, $where, 'id','DESC', '', '', '', '', '', '',true);
        $index = 0;
        foreach ($users as $user) {
        	$data['users'][$index] = $user;
        	$parent_id = ($user['alpha_parent_id']>0)?$user['alpha_parent_id']:$user['parent_id'];
        	if($parent_id>0){
        		$where = "id = '".$parent_id."'";
                $parent_detail = $this->users->get_where('*', $where, true, '' , '', '');
                if(!empty($parent_detail)){
                    $parent_name = $parent_detail[0]['fullname'];
                }
        	}
        	else{
        		$parent_name = "Self";
        	}
            
            if(if_package_buy($user['id'])){
                $data['users'][$index]['status'] = 1;
            }
            else{
                $data['users'][$index]['status'] = 0;
            }

        	$data['users'][$index]['parent_name'] = $parent_name;
            $index++;
        }

        //debug($data['users'],true);
	  	$this->load->view("users/index",$data);
	}

    public function transferAmount()
    {
        $data = [];
        $this->layout = " ";
        if(!$this->input->is_ajax_request()){
           exit('No direct script access allowed');
        }
        $data['response'] = false;
        $this->form_validation->set_rules('user_id','','required|trim');
        $this->form_validation->set_rules('amount','amount','required|trim|numeric');
        if($this->form_validation->run()===TRUE){
            $formData = $this->input->post();
            $user_id = $formData['user_id'];
            $amount = $formData['amount'];
            if($amount > 0){
                $where = "wallet_user_id = '".$user_id."'";
                $result = $this->wallets->get_where('*', $where, true, '' , '', '');
                if(!empty($result)){
                    $update = [];
                    $update['wallet_balance'] = $amount+$result[0]['wallet_balance'];
                    $this->wallets->update_by('wallet_id', $result[0]['wallet_id'],$update);
                    $data['response'] = true;
                }
            }
        }
        else{
            $data['errors'] = all_errors($this->form_validation->error_array());
        }
        //debug($data , true);
        echo json_encode($data);
    }

    public function deductAmount()
    {
        $data = [];
        $this->layout = " ";
        if(!$this->input->is_ajax_request()){
           exit('No direct script access allowed');
        }
        $data['response'] = false;
        $data['less'] = false;
        $this->form_validation->set_rules('user_id','','required|trim');
        $this->form_validation->set_rules('amount','amount','required|trim|numeric');
        if($this->form_validation->run()===TRUE){
            $formData = $this->input->post();
            $user_id = $formData['user_id'];
            $amount = $formData['amount'];
            if($amount > 0){
                $where = "wallet_user_id = '".$user_id."'";
                $result = $this->wallets->get_where('*', $where, true, '' , '', '');
                if(!empty($result)){
                    $result = $result[0];
                    if($amount > $result['wallet_balance']){
                        $data['less'] = true;
                    }
                    else{
                        $update = [];
                        $update['wallet_balance'] = $result['wallet_balance'] - $amount;
                        $this->wallets->update_by('wallet_id', $result['wallet_id'],$update);
                        $data['response'] = true;
                    }
                }
            }
        }
        else{
            $data['errors'] = all_errors($this->form_validation->error_array());
        }
        //debug($data , true);
        echo json_encode($data);
    }

	public function user_detail($user_id = '' , $random = '')
	{
		if(!ctype_digit($user_id) || empty($user_id)){
            $this->session->set_flashdata('error_message', 'Invalid request to get user detail.');
		    redirect('users/index'); exit;
		}

		$data = array();
		$where = "users.id = '".$user_id."'";
        $joins = array(
        	    '0' => array('table_name' => 'user_balance user_balance',
	                'join_on' => ' user_balance.user_id = users.id ',
	                'join_type' => 'left'
	            ),
	            '1' => array('table_name' => 'user_packages user_packages',
	                'join_on' => ' user_packages.up_user_id = users.id',
	                'join_type' => 'left'
	            ),
	            '2' => array('table_name' => 'packages packages',
	                'join_on' => ' packages.package_id = user_packages.up_package_id',
	                'join_type' => 'left'
	            ),
                '3' => array('table_name' => 'wallets wallets',
                    'join_on' => 'wallets.wallet_user_id = users.id',
                    'join_type' => 'left'
                )
        );
        $from_table = "users users";
        $select_from_table = "users.*,users.created_at as user_created_at,user_balance.*,user_packages.*,packages.*,wallets.*";
        $user = $this->users->get_by_join($select_from_table, $from_table, $joins, $where, '','', '', '', '', '', '', '',true);
        if(!empty($user)){
        	$data['user'] = $user[0];
        }
        
        $roi_bonus = 0;
        $referal_bonus = 0;
        $binary_bonus = 0;

        $where = "de_user_id = '".$user_id."'";
        $daily_earnings = $this->daily_earnings->get_where('*', $where, true, '' , '', '');
        if(!empty($daily_earnings)){
        	foreach ($daily_earnings as $key => $earning) {
        		($earning['de_source']=="Roi")?$roi_bonus = $roi_bonus + $earning['de_earning']:'';
        		($earning['de_source']=="Referal Bonus")?$referal_bonus = $referal_bonus +  $earning['de_earning']:'';
        		($earning['de_source']=="Binary Bonus")?$binary_bonus = $binary_bonus +  $earning['de_earning']:'';
        	}
        }
        $data['roi_bonus'] = $roi_bonus;
        $data['referal_bonus'] = $referal_bonus;
        $data['binary_bonus'] = $binary_bonus;

        $where = "point_user_id = '".$user_id."'";
        $points = $this->points->get_where('SUM(left_points) as left_points,SUM(right_points) as right_points', $where, true, '' , '', '');
        $points = $points[0];
        $data['right_points'] = ($points['right_points']>0)?$points['right_points']:0;
        $data['left_points'] = ($points['left_points']>0)?$points['left_points']:0;

        $where = "user_rewards.ur_user_id = '".$user_id."'";
        $joins = array(
        	    '0' => array('table_name' => 'rewards rewards',
	                'join_on' => ' rewards.reward_id = user_rewards.ur_reward_id ',
	                'join_type' => 'left'
	            )
        );
        $from_table = "user_rewards user_rewards";
        $select_from_table = "user_rewards.*,rewards.*";
        $data['rewards'] = $this->user_rewards->get_by_join($select_from_table, $from_table, $joins, $where, '','', '', '', '', '', '', '',true);

        $where = "user_id = '".$user_id."' AND withdraw_status = '1'";
        $withdraws = $this->withdraws->get_where('SUM(withdraw_amount) as total_withdraws', $where, true, '' , '', '');
        $data['total_withdraws'] = ($withdraws[0]['total_withdraws']>0)?$withdraws[0]['total_withdraws']:0;

        $data['left_users'] = $this->left_right_users($user_id,"left");
        $data['right_users'] = $this->left_right_users($user_id,"right");
        $data['total_users'] = $data['left_users']+$data['right_users'];


        $where = "point_user_id = '".$user_id."'";
        $result = $this->points->get_where('SUM(right_points) as right_points,SUM(left_points) as left_points', $where, true, '', '', '');
        $result = $result[0];
        $user_right_points = ($result['right_points']>0)?$result['right_points']:0;
        $user_left_points = ($result['left_points']>0)?$result['left_points']:0;

        // $user_right_points = 2000;
        // $user_left_points = 3000;
		
		

        //debug($data,true);
	  	$this->load->view("users/user_detail",$data);
	}

	public function left_right_users($parent_id='',$position='')
	{
		$total_users = 0;
        if(!empty($parent_id) && !empty($position)){

        	$where = "parent_id = '".$parent_id."' AND position = '".$position."'";
			($position=="right")?$where .= " OR (position = 'beta_position' AND alpha_parent_id = '".$parent_id."') ":" ";
            ($position=="left")?$where .= " OR (position = 'alpha_position' AND alpha_parent_id = '".$parent_id."') ":" ";
			$users_ids = $this->users->get_where('id', $where, true, '' , '', '');
	        
	        $all_data = array();
	        $condition = (!empty($users_ids))?true:false;
	        $ii = 0;
	        while($condition===true){
	        	$arr_push = array();
	        	foreach($users_ids as $user_id){
	        		$user_id = ($ii==0)?$user_id['id']:$user_id;
	        		$total_users++;
	                $where = "parent_id = '".$user_id."' OR alpha_parent_id = '".$user_id."'";
					$child_users = $this->users->get_where('id', $where, true, '' , '', '');
					foreach($child_users as $user){
	                    array_push($arr_push,$user['id']);
					}
	        	}
	        	$users_ids = $arr_push ;
	        	(empty($users_ids))?$condition=false:'';
	        $ii++;	
	        }
        }
        return $total_users;
	}

	public function activate_user($id)
    {
        if (isset($id) && !empty($id)) {
        	$data = array();
        	$data['status'] = 1;
        	$this->users->update_by('id', $id,$data);
            $this->session->set_flashdata('success_message', 'User has been activated successfully.');
        } else {
            $this->session->set_flashdata('error_message', 'Invalid request to activate user.');
        }
        redirect('users/');
    }
    
	public function block_user($id)
    {
        if (isset($id) && !empty($id)) {
        	$data = array();
        	$data['status'] = 0;
        	$this->users->update_by('id', $id,$data);
            $this->session->set_flashdata('success_message', 'User has been blocked successfully.');
        } else {
            $this->session->set_flashdata('error_message', 'Invalid request to block user.');
        }
        redirect('users/');
    }

	
}