<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("User_model","User");
		$this->load->model("Users_model","users");
		$this->load->model("User_balance_model","user_balance");
		$this->load->model("Wallets_model","wallets");
		date_default_timezone_set("America/Los_Angeles");
	}

	public function index()
	{
		if($this->session->userdata('id')){
            redirect('user/UserDashboard'); exit;
		}
		redirect('sign-in'); exit;

		$this->load->view('login/head.php');
		$this->load->view('login/login.php');
		$this->load->view('login/footer.php');
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect("sign-in");
	}

	public function forgot_password()
	{
		if($this->session->userdata('id')){
            redirect('user/UserDashboard'); exit;
		}

		$this->load->view('login/head.php');
		$this->load->view('login/forgot_password.php');
		$this->load->view('login/footer.php');
	}

	public function process_forgot_password() 
	{
		if($this->input->post())
		{
			$this->form_validation->set_rules('email', 'email', 'required|valid_email|trim');
			if ($this->form_validation->run()==TRUE)
			{
				$email = $this->input->post('email');
				$user = $this->users->get_by('email', $email);
				if(isset($user) && !empty($user))
				{
					$user = $user[0];
					$password_data = array();
					$password_data['sponsor_code'] = $user['sponsor_code'];
					
					$reset_password_link = site_url('login/reset_password/'.$password_data['sponsor_code'].'/');
					//debug($reset_password_link,true);
					
					$message = "Dear " . $user['fullname'] . ",<br/><br/>";
					$message .= "To reset your account password please follow the below link <br /> $reset_password_link <br/>";
					$message .= "Regards,<br/>Administration of Bitfair Company";

					$this->load->library('email');
					$this->email->initialize(array(
						'protocol'     => 'smtp',
				        'smtp_host'    => 'mail.bitfaircompany.com',
				        'smtp_port'    => '587',
				        'smtp_timeout' => '7',
				        'smtp_user'    => 'no-replay@bitfaircompany.com',
				        'smtp_pass'    => 'K~k]3gn{E+sd',
	        			'newline'   => "\r\n",
						'mailtype'=>'html',
						'charset'=>'utf-8',
						'starttls'=>true,
						'wordwrap'=>true
					));
					$this->email->clear();
					$this->email->to($email);
					$this->email->from('no-replay@bitfaircompany.com');
					$this->email->subject("Forgot Password");
					$this->email->message($message);
					$this->email->send();
					
					$this->session->set_flashdata('success_message', "An email sent to your email id please follow the link given in email to reset password.");
					redirect('login/forgot_password');
					
				}
				else
				{
					$this->session->set_flashdata('error_message', "The email you entered does not exist.");
					redirect('login/forgot_password/');
				}
			}
			else{
				$this->load->view('login/head.php');
				$this->load->view('login/forgot_password.php');
				$this->load->view('login/footer.php');
			}
		}
    }

    public function reset_password($sponsor_code='')
	{
		if($this->session->userdata('id')){
            redirect('user/UserDashboard'); exit;
		}
		if(!empty($sponsor_code)){
			$data = [];
			$data['sponsor_code'] = $sponsor_code;
			$this->load->view('login/head.php');
			$this->load->view('login/reset_password.php',$data);
			$this->load->view('login/footer.php');
		}
	}

	public function process_reset_password($sponsor_code='')
	{
		if($this->session->userdata('id')){
            redirect('user/UserDashboard'); exit;
		}

		if($this->input->post())
		{
			$this->form_validation->set_rules('sponsor_code','','required');
			$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
			if($this->form_validation->run()===TRUE)
			{
				$arr = $this->input->post();
				$where = "sponsor_code = '".$arr['sponsor_code']."'";
				$user = $this->users->count_rows($where);
				if($user==0){
					$this->session->set_flashdata('error_message','Invalid request to reset password.');
					redirect('login/reset_password'); exit;
				}
				$data = array();
				$data['password'] = $arr['password'];
                $this->users->update_by('sponsor_code',$arr['sponsor_code'],$data);
                $this->session->set_flashdata('success_message','The password has been reset successfully.');
				redirect('login/index'); exit;
			}
			else{
				$this->load->view('login/head.php');
				$this->load->view('login/reset_password.php');
				$this->load->view('login/footer.php');
			}
		}
	}

    public function signup($code=''){
    	$data = array();
    	redirect('sign-in'); exit;
    	(!empty($code))?$data['code'] = $code:" ";
    	$this->load->view('login/head.php');
		$this->load->view('login/signup.php',$data);
		$this->load->view('login/footer.php');
	}
    
    public function process_signup()
	{
		$data = array();

		if($this->input->post()){
			$this->form_validation->set_rules('fullname', 'Full Name', 'required|callback_fullname');
			$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[5]|max_length[16]|callback_is_username_exists');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_is_email_exists');
			$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('wallet_address', 'Wallet Address', 'required|alpha_numeric|min_length[25]|max_length[34]');
			$this->form_validation->set_rules('sponsor_code', 'Sponsor Code', 'required|callback_is_sponsor_code');
			$this->form_validation->set_rules('tnc', 'terms and conditions', 'required');
			if($this->form_validation->run() === TRUE){
				$data = $this->input->post();

                $where = "users.sponsor_code='".$data['sponsor_code']."' ";
				$parent_user = $this->users->get_where('*', $where, true, '' , '', '');
				$parent_id = $parent_user[0]['id'];
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
					$this->session->set_flashdata('success_message','Your account has been created successfully.');
					redirect('login/');
				}
				else{
					$this->session->set_flashdata('error_message','Error occured while signing up.');
					redirect('login/signup');
				}
			}
			else{
				$this->load->view('login/head.php');
				$this->load->view('login/signup.php');
				$this->load->view('login/footer.php');
			}
		}
	}

	public function is_sponsor_code($str)
    {
    	if(!empty($str)){
		    $staff = $this->users->sponsor_code($str);
		    if (empty($staff))
		    {
		    	$this->form_validation->set_message('is_sponsor_code', 'This %s does not exists.');
		        return FALSE;
		    }
		    else
		    {
		        return TRUE;
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

    public function blocked(){
        $this->load->view('ref/index');
    }

	public function process_login()
	{
		if($this->session->userdata('id')){
            redirect('user/UserDashboard'); exit;
		}

		if($this->input->post()){
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if($this->form_validation->run() === TRUE){

				$data = $this->input->post();

                $where = "users.password = '".$data['password']."' AND (users.email = '".$data['email']."' OR users.username = '".$data['email']."')";
				$userdata = $this->users->get_where('*', $where, true, '' , '', '');

				if(!empty($userdata) && $userdata[0]['status'] == 0){
                    redirect('login/blocked'); exit;
				}
				
				if (!empty($userdata) && $userdata[0]['status'] != 0) {
					$this->session->set_userdata("username",$userdata[0]['username']);
					$this->session->set_userdata("fullname",$userdata[0]['fullname']);
					$this->session->set_userdata("email",$userdata[0]['email']);
					$this->session->set_userdata("id",$userdata[0]['id']);
					$this->session->set_userdata("role",$userdata[0]['role']);
					$this->session->set_userdata("gender",$userdata[0]['gender']);
					$this->session->set_userdata("sponsor_code",$userdata[0]['sponsor_code']);
					$img = 'user_user.jpg';
					if(!empty($userdata[0]['profile_pic'])){
						$img = $userdata[0]['profile_pic'];
					}
					$this->session->set_userdata("profile_pic",$img);

					redirect("User/UserDashboard");
				}else{
					$this->session->set_flashdata("error_message","Invalid Username/email or Password!");
					redirect("Login/");
				}
			}
			else{
				$this->load->view('login/head.php');
				$this->load->view('login/login.php');
				$this->load->view('login/footer.php');
			}
		}
		else{
			$this->session->set_flashdata("error_message","Invalid Username/email or Password!");
			redirect("Login/");
		}
	}


}


 ?>