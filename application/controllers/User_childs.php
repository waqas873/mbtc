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

class User_childs extends CI_Controller
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
		if (!$this->session->userdata("role")) {
			redirect("login/");
		}
		$this->load->model('Users_model','users');
		$this->load->model('User_balance_model','user_balance');
		$this->load->model("Wallets_model","wallets");

		date_default_timezone_set("America/Los_Angeles");
        
	}
	
	/** 
	* Controller Function to List All Admins
	* 
	* @access public 
	*/
	public function index($position='')
	{
		$parent_id = $this->session->userdata('id');
        if(empty($position)){
        	$this->selected_tab = "all_users";
			$where = "parent_id = '".$parent_id."'";
		}
		else{
            $where = "parent_id = '".$parent_id."' AND position = '".$position."'";
		    $this->selected_tab = ($position=="right")?"right_users":"left_users";
		}
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
        
        $data['heading'] = ($position=="right")?"Right":'Left';
        $data['users'] = array_reverse($all_data);

	  	$this->load->view("user_childs/index",$data);
	}
	
	public function add()
	{
		$this->selected_tab = "add_user";
		if($this->session->userdata("role")=="admin"){
			$this->session->set_flashdata('error_message','Admin is not allowed to add a user.');
			redirect("user/admin_dashboard");
		}

		$this->load->view("user_childs/add");
	}

	public function process_add()
	{
		$this->selected_tab = "add_user";

		if($this->session->userdata("role")=="admin"){
			$this->session->set_flashdata('error_message','Admin is not allowed to add a user.');
			redirect("user/admin_dashboard");
		}

		$data = array();

		if($this->input->post()){
			$this->form_validation->set_rules('fullname', 'Full Name', 'required|callback_fullname');
			$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[5]|max_length[16]|callback_is_username_exists');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_is_email_exists');
			$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			if($this->form_validation->run() === TRUE){
				$data = $this->input->post();

                $parent_id = $this->session->userdata('id');
				$where = "users.parent_id = '".$parent_id."' ";
				$check_users = $this->users->get_where('*', $where, true, '' , '', '');

				if(count($check_users)>=2){
                    $where_2 = "users.parent_id = '".$parent_id."' AND position = 'right' OR position = 'beta_position'";
					if($data['position']=="left"){
                      $where_2 = "users.parent_id = '".$parent_id."' AND position = 'left' OR position = 'alpha_position'";
                    }
				    $user_2 = $this->users->get_where('*', $where_2, true, 'id DESC' , '1', '');
				    if($user_2[0]['position']=="right" || $user_2[0]['position']=="left"){
				    	$data['beta_parent_id'] = $parent_id;
				    }
				    else{
				    	$data['beta_parent_id'] = $user_2[0]['id'];
				    }
				    $data['alpha_parent_id'] = $parent_id;
				    $data['sponsor_code'] = random_password();
				    $data['position'] = ($data['position']=="right")?"beta_position":'alpha_position';
				    $data['beta_position'] = 1;
				}
				else{
					$data['parent_id'] = $parent_id;
	                $data['sponsor_code'] = random_password();
	                if(count($check_users)>0){
				    	$check_position = $check_users[0];
				    	$data['position'] = ($check_position['position']=="right")?"left":"right";
				    }
                }
				unset($data['cpassword'],$data['tnc']);
				$this->db->trans_start();
				if($user_id = $this->users->save($data)){
                    $insert = array('user_id' => $user_id);
					$this->user_balance->save($insert);
					$insert = array('wallet_user_id' => $user_id);
					$this->wallets->save($insert);
					$this->db->trans_complete();
					$this->session->set_flashdata('success_message','User account has been created successfully.');
					$position = ($data['position']=="right" || $data['position']=="beta_position")?"right":"left";
					redirect('user_childs/index/'.$position);
				}
				else{
					$this->session->set_flashdata('error_message','Error occured while adding user.');
					redirect('user_childs/add');
				}
			}
			else{
				$this->load->view('user_childs/add');
			}
		}
	}

	public function is_username_exists($str , $id = "ci_validation")
    {
    	if(!empty($str)){
		    $staff = $this->users->uniqueLogin('', $id, $str);
		    if (empty($staff))
		    {
		      return TRUE;
		    }
		    else
		    {
		      $this->form_validation->set_message('is_username_exists', 'This %s is already registered.');
		      return FALSE;
		    }
	    }
    }

    public function is_sponsor_code_exists($str , $id = "ci_validation")
    {
    	if(!empty($str)){
    		$where = "sponsor_code = '".$str."' AND id != '".$id."' ";
		    $user = $this->users->get_where('*', $where, true, '' , '', '');
		    if (empty($user))
		    {
		      return TRUE;
		    }
		    else
		    {
		      $this->form_validation->set_message('is_sponsor_code_exists', 'This %s is already registered.');
		      return FALSE;
		    }
	    }
    }

    public function is_email_exists($str , $id = "ci_validation")
    {
    	if(!empty($str)){
		    $staff = $this->users->uniqueLogin($str , $id);
		    if (empty($staff))
		    {
		      return TRUE;
		    }
		    else
		    {
		      $this->form_validation->set_message('is_email_exists', 'This %s is already registered.');
		      return FALSE;
		    }
	    }
    }

	public function fullname($fullname){
        if (! preg_match('/^[a-zA-Z\s]+$/', $fullname)) {
            $this->form_validation->set_message('fullname', 'The %s field may only contain alphabetical characters & White spaces');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function update() 
	{
		$data = [];
		$this->selected_tab = 'update';
		$user_id = $this->session->userdata('id');
		$where = "id = '".$user_id."'";
		$user = $this->users->get_where('*', $where, true, '' , '', '');
		$data['data'] = $user[0];
		$this->load->view('users/update',$data);
    }

    public function process_update()
	{
		$data = array();
		$user_id = $this->session->userdata('id');
		if($this->input->post())
		{
			if($this->session->userdata('role')=="user"){
			    $this->form_validation->set_rules('fullname', 'Full Name', 'required|callback_fullname');
			    $this->form_validation->set_rules('dob', 'Date of Birth', 'required');
			    $this->form_validation->set_rules('contact_no', 'Contact No', 'required|numeric|min_length[10]|max_length[16]');
			    $this->form_validation->set_rules('sponsor_code', 'id', 'required|alpha_numeric|min_length[5]|max_length[16]|callback_is_sponsor_code_exists[' . $user_id . ']');
		    }
			$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[5]|max_length[16]|callback_is_username_exists[' . $user_id . ']');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('wallet_address', 'Wallet Address', 'required|alpha_numeric|min_length[5]|max_length[34]');
			if($this->form_validation->run() === TRUE)
			{
				$data = $this->input->post();
                unset($data['cnic'],$data['passport_no'],$data['utility_bill']);

                if(isset($_FILES['profile_pic']['tmp_name']) && !empty($_FILES['profile_pic']['name'])){
                     
                    $config['upload_path']   = BASEPATH.'../assets/images/';
                    $config['allowed_types'] = 'jpeg|jpg|png'; 
                    $config['max_size']      = 140000; 
                    $config['max_width']     = 4000;
                    $config['max_height']    = 4000;  
                    $this->load->library('upload',$config);
                    $this->load->initialize($config);

                    if(!$this->upload->do_upload('profile_pic')){
                    	$error_message = $this->upload->display_errors();
                        $this->session->set_flashdata('error_message',$error_message);
                        redirect('user_childs/update/');
                    }
                    else{
                        $uploaded_image = $this->upload->data();
                        $data['profile_pic'] = $uploaded_image['file_name'];
                    }
                }

				//debug($data,true);

				  
                if( $user_id = $this->users->update_by('id', $user_id, $data) )
				{
					$this->session->set_flashdata('success_message', 'Your account has been updated successfully.');
					redirect('user_childs/update');
				}
				else
				{
					$this->session->set_flashdata('error_message', 'Error occured while updating your account.');
					redirect('user_childs/update');
				}
			}
			else{
				$where = "id = '".$user_id."'";
				$user = $this->users->get_where('*', $where, true, '' , '', '');
		        $data['data'] = $user[0];
				$this->load->view('users/update',$data);
			}
		}
		else{
			$this->session->set_flashdata('error_message', 'Invalid request to update your account.');
			redirect('user_childs/update');
		}
	}

    public function change_password() 
	{
		$data = array();
		$this->selected_tab = 'Change Password';
		$user_id = $this->session->userdata('id');
		$this->load->view('users/change_password',$data);
    }

    public function process_change_password() 
	{
		$data = array();
		$this->selected_tab = 'Change Password';
		$user_id = $this->session->userdata('id');
		if($this->input->post())
		{
			$this->form_validation->set_rules('old_password','Old Password','required|trim');
			$this->form_validation->set_rules('new_password', 'Password', 'required|trim|min_length[5]');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[new_password]');
			if($this->form_validation->run()===TRUE)
			{
				$arr = $this->input->post();
				$where = "id = '".$user_id."' AND password = '".$arr['old_password']."'";
				$user = $this->users->count_rows($where);
				if($user==0){
					$this->session->set_flashdata('error_message','The old password you entered does not match.');
					redirect('user_childs/change_password'); exit;
				}
				$data['password'] = $arr['new_password'];
                $this->users->update_by('id',$user_id,$data);
                $this->session->set_flashdata('success_message','The password has been changed successfully.');
				redirect('user_childs/change_password'); exit;
			}
			else{
				$this->load->view('users/change_password',$data);
			}
		}
    }
	
}