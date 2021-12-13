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

class User_rewards extends CI_Controller
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
		$this->selected_tab = "user_rewards";
		if (!$this->session->userdata("role")) {
			redirect("user/UserDashboard");
		}
		$this->load->model('Rewards_model', 'rewards');
		$this->load->model('User_rewards_model', 'user_rewards');
		$this->load->model('Users_model', 'users');
		$this->load->model('Points_model', 'points');

		date_default_timezone_set("America/Los_Angeles");
        
	}
	
	/** 
	* Controller Function to List All Admins
	* 
	* @access public 
	*/
	public function admin_index($reward_status='')
	{
		if($this->session->userdata("role")=="user"){
			redirect('user/UserDashboard'); exit;
		}

		if(empty($reward_status)){
			$this->session->set_flashdata('error_message','Invalid request to get rewards detail.');
			redirect('user/admin_dashboard'); exit;
		}

		$ur_status = ($reward_status=="Bc4hJqTL")?2:(($reward_status=="j6YgflOvD")?1:3);

		if($ur_status==3){
			$this->session->set_flashdata('error_message','Invalid request to get rewards detail.');
			redirect('user/admin_dashboard'); exit;
		}

		$this->selected_tab = ($ur_status==1)?"pending_rewards":"awarded_rewards";

		$where = "ur_status = '".$ur_status."'";
        $joins = array(
        	    '0' => array('table_name' => 'users users',
	                'join_on' => ' users.id = user_rewards.ur_user_id ',
	                'join_type' => 'left'
	            ),
	            '1' => array('table_name' => 'rewards rewards',
	                'join_on' => ' rewards.reward_id = user_rewards.ur_reward_id ',
	                'join_type' => 'left'
	            )
        );
        $from_table = "user_rewards user_rewards";
        $select_from_table = "user_rewards.*,rewards.*,users.*";
        $data['rewards'] = $this->user_rewards->get_by_join($select_from_table, $from_table, $joins, $where, 'ur_id','DESC', '', '', '', '', '', '',true);
        $data['heading'] = ($ur_status==1)?"Pending Rewards":"Awarded Rewards";

        ($ur_status == 1)?$data['action'] = "action":'';
        
        $this->load->view("user_rewards/admin_index",$data);
	}

	public function user_index()
	{
		if ($this->session->userdata("role")=="admin") {
			redirect("user/UserDashboard"); exit;
		}

		
		$user_id = $this->session->userdata("id");
		$where = "point_user_id = '".$user_id."'";
        $result = $this->points->get_where('SUM(right_points) as right_points,SUM(left_points) as left_points', $where, true, '', '', '');
        $result = $result[0];
        $user_right_points = ($result['right_points']>0)?$result['right_points']:0;
        $user_left_points = ($result['left_points']>0)?$result['left_points']:0;

        // $user_right_points = 2000;
        // $user_left_points = 3000;
		
		$where = "reward_id > 0";
        $rewards = $this->rewards->get_where('*', $where, true, '' , '', '');
        $index = 0;
        $left_status  = true;
        $right_status  = true;
        if(!empty($rewards)){
	        foreach ($rewards as $key => $reward) {
	        	$right_condition = false;
	        	$left_condition = false;
	        	$data['rewards'][$index] = $reward;
	        	$data['rewards'][$index]['user_right_investment'] = 0;
	        	$data['rewards'][$index]['user_left_investment'] = 0;
	        	$data['rewards'][$index]['status'] = "Locked";

	        	if($user_right_points >= $reward['reward_right_investment']){
	                $user_right_points = $user_right_points - $reward['reward_right_investment'];
	                $data['rewards'][$index]['user_right_investment'] = $reward['reward_right_investment'];
	                $right_condition = true;
	        	}
	        	else{
	        		if($right_status === true){
	                    $data['rewards'][$index]['user_right_investment'] = $user_right_points;
	                    $right_status = false;
	        		}
	        	}

	        	if($user_left_points >= $reward['reward_left_investment']){
	                $user_left_points = $user_left_points - $reward['reward_left_investment'];
	                $data['rewards'][$index]['user_left_investment'] = $reward['reward_left_investment'];
	                $left_condition = true;
	        	}
	        	else{
	        		if($left_status === true){
	                    $data['rewards'][$index]['user_left_investment'] = $user_left_points;
	                    $left_status = false;
	        		}
	        	}

	        	if($right_condition===true && $left_condition===true){
	        		$where = "ur_user_id = '".$user_id."' AND ur_reward_id = '".$reward['reward_id']."'";
	                $user_rewards = $this->user_rewards->get_where('*', $where, true, '' , '', '');
	                if(empty($user_rewards)){
	                	$reward_data = array();
	                	$reward_data['ur_user_id'] = $user_id;
	                	$reward_data['ur_reward_id'] = $reward['reward_id'];
	                	$this->user_rewards->save($reward_data);
	                	$data['rewards'][$index]['status'] = 1;
	                }
	                else{
	                	$data['rewards'][$index]['status'] = $user_rewards[0]['ur_status'];
	                }
	        	}

	        $index++;	
	        }
        }

        //debug($data['rewards'],true);
	  	$this->load->view("user_rewards/user_index",$data);
	}
	
	
	public function process_add()
	{
		if ($this->session->userdata("role")=="user") {
			redirect("user/UserDashboard"); exit;
		}

		$data = array();
		if($this->input->post())
		{
			$user_email = $this->input->post('user_email');
			$reward_id = $this->input->post('reward_id');
            
            $this->db->trans_start();
			$where = "email = '".$user_email."'";
            $user = $this->users->get_where('*', $where, true, '' , '', '');
            if(!empty($user)){
                $user = $user[0];
                
                if($user['status']==0){
                    $this->session->set_flashdata('error_message','This user is blocked. So this user can not be rewarded.');
			        redirect('rewards/index'); exit;
                }
                if($user['role']=="admin"){
                    $this->session->set_flashdata('error_message','The reward can not be awarded to admin.');
			        redirect('rewards/index'); exit;
                }

                $where = "ur_user_id = '".$user['id']."' AND ur_reward_id = '".$reward_id."'";
                $user_reward = $this->user_rewards->get_where('*', $where, true, '' , '', '');
                if(!empty($user_reward)){
                	$this->session->set_flashdata('error_message','This user has been already awarded with this reward.');
			        redirect('rewards/index'); exit;
                }

                $where = "reward_id = '".$reward_id."'";
                $reward = $this->rewards->get_where('*', $where, true, '' , '', '');
                $left_points = $reward[0]['reward_left_investment'];
                $right_points = $reward[0]['reward_right_investment'];
                
                $where = "point_user_id = '".$user['id']."' ";
                $points = $this->points->get_where('SUM(left_points) as left_points,SUM(right_points) as right_points', $where, true, '' , '', '');
                $points = $points[0];
                $user_left_points = ($points['left_points']>0)?$points['left_points']:0;
                $user_right_points = ($points['right_points']>0)?$points['right_points']:0;

                if($user_left_points >= $left_points && $user_right_points >= $right_points){
                    $data['ur_user_id'] = $user['id'];
	                $data['ur_reward_id'] = $reward_id;
	                $this->user_rewards->save($data);
	                $this->db->trans_complete();
	                $this->session->set_flashdata('success_message','Reward has been awarded successfully.');
	                redirect('user_rewards/index');
                }
                else{
                	$this->session->set_flashdata('error_message', 'This user does not qualify for this reward.');
                	redirect('rewards/index');
                }
            }
            else{
            	$this->session->set_flashdata('error_message', 'This user does not exist.');
			    redirect('rewards/index');
            }
		}
		else{
			$this->session->set_flashdata('error_message', 'Invalid request for giving reward.');
			redirect('rewards/index');
		}
	}

	public function approve_reward($ur_id='',$random_code='')
    {
    	if ($this->session->userdata("role")=="user") {
			redirect("user/UserDashboard"); exit;
		}
		
        if (isset($ur_id) && !empty($ur_id)) {
        	$data = array('ur_status'=>2);
            if($ur_id = $this->user_rewards->update_by('ur_id', $ur_id,$data)){
               $this->session->set_flashdata('success_message', 'Reward has been approved successfully.');
            }
            else{
            	$this->session->set_flashdata('error_message', 'Error occured while approving Reward.');
            }
            redirect('user_rewards/admin_index/j6YgflOvD');

        } else {
            $this->session->set_flashdata('error_message', 'Invalid request to approve Reward.');
        }
        redirect('user_rewards/admin_index/j6YgflOvD');
    }

	public function delete($reward_id)
    {
    	if ($this->session->userdata("role")=="user") {
			redirect("user/UserDashboard"); exit;
		}
		
        if (isset($reward_id) && !empty($reward_id)) {
            $this->user_rewards->delete_by('ur_id', $reward_id);
            $this->session->set_flashdata('success_message', 'Reward has been cancelled successfully.');
        } else {
            $this->session->set_flashdata('error_message', 'Invalid request to cancel Reward.');
        }
        redirect('user_rewards/');
    }
	
}