<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller 
{
	/**
	* @var stirng
	* @access Public
	*/
	public $selected_tab = '';
	public $selected_page = '';
	
	/** 
	* Controller constructor
	* 
	* @access public 
	*/

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('user')){
	        redirect('dashboard');
	    }
		$this->selected_tab = 'auth';
		$this->layout = 'auth';
		// $this->load->model('admin_model', 'admin');
		$this->load->model('users_model', 'users');
	}
	
	public function login($encoded_email = '')
	{
        $data = [];
        if(!empty($encoded_email)){
        	$email = decodeBase64($encoded_email);
        	$where = "email = '".$email."'";
		    $result = $this->users->get_where('*', $where, true, '' , '', '');
		    if(!empty($result)){
                $update = ['status' => 1];
                $this->users->update_by_where($update,$where);
		    }
        }
		$this->load->view('auth/login', $data);
	}

	public function process_login()
	{
		$data = [];
		$this->layout = " ";
		if(!$this->input->is_ajax_request()){
		   exit('No direct script access allowed');
		}
		$data['response'] = false;
		$data['blocked'] = false;
		$data['activateAccount'] = false;
		$data['credentials'] = false;
		$this->form_validation->set_rules('email','email','required|trim|valid_email');
		$this->form_validation->set_rules('password','Password','required|trim');
		if($this->form_validation->run()===TRUE){
			$formData = $this->input->post();
			$password = md5($formData['password']);
			$where = "email = '".$formData['email']."' AND password = '".$password."'";
		    $result = $this->users->get_where('*', $where, true, '' , '', '');
		    if(!empty($result)){
		    	$result = $result[0];
		    	if($result['status']==1){
		    		$data['response'] = true;
		    		$this->session->set_userdata(
		    			[
		    			'user'=>$result['user_id'],
		    			'user_id'=>$result['user_id'],
		    			'username'=>$result['username'],
		    			'email'=>$result['email'],
		    			'affiliate_id'=>$result['affiliate_id'],
		    		    ]
		    		);
		    	}
		    	elseif($result['status']==0){
                    $data['activateAccount'] = true;
		    	}
		    	else{
		    		$data['blocked'] = true;
		    	}
		    }
		    else{
		    	$data['credentials'] = true;
		    }
		}
		else{
            $data['errors'] = all_errors($this->form_validation->error_array());
		}
		echo json_encode($data);
	}

	public function signup()
	{
		$data = [];
		$this->load->view('auth/signup', $data);
	}

	public function process_signup()
	{
		$data = [];
		$this->layout = " ";
		if(!$this->input->is_ajax_request()){
		   exit('No direct script access allowed');
		}
		$data['response'] = false;
		$data['subscribe'] = false;
		$formData = $this->input->post();
		$this->session->set_userdata('signupForm' , json_encode($formData));
		if(!$this->session->userdata('paymentSuccessToken')){
            $data['subscribe'] = true;
            echo json_encode($data);
            exit;
		}
		$this->form_validation->set_rules('first_name','first name','required|trim');
		$this->form_validation->set_rules('last_name','last name','required|trim');
		$this->form_validation->set_rules('username','username','required|trim');
        $this->form_validation->set_rules('email','Email','required|trim|valid_email|callback_is_email_exists');
        $this->form_validation->set_rules('password','password','required|trim|min_length[5]');
        $this->form_validation->set_rules('cpassword','confirm password','required|trim|matches[password]');
        $this->form_validation->set_rules('terms','terms and conditions','required');
		if($this->form_validation->run()===TRUE){
			$password = md5($formData['password']);
			$aff_id = $formData['aff_id'];
			unset($formData['cpassword'],$formData['terms'],$formData['password'],$formData['aff_id']);
			if(!empty($aff_id)){
				$where = "affiliate_id = '".$aff_id."'";
                $user = $this->users->get_where('*', $where, true, '', '', '');
                if(!empty($user)){
                	$formData['referral_id'] = $user[0]['user_id'];
                }
			}
			$formData['password'] = $password;
			$formData['affiliate_id'] = alphanumeric_random_string(20);
			if($id = $this->users->save($formData)){
				if($this->session->userdata('paymentSuccessToken')){
					
					$update = [];
					$date = strtotime("+7 day", time());
					$date = date('Y-m-d',$date);
					$update['trial_end_date'] = $date;
					$update['payment_token'] = $this->session->userdata('paymentSuccessToken');
					$this->users->update_by('user_id',$id,$update);
					$where = "is_active = 1 AND  privacy = 2";
                    $result = $this->coupons->get_where('*', $where, true, 'id DESC', 1, '');
                    if(!empty($result)){
                    	$coupon_id = $result[0]['id'];
                    	$save = [];
                    	$save['user_id'] = $id;
                    	$save['coupon_id'] = $coupon_id;
                    	$this->coupon_users->save($save);
                    }
                    $this->session->unset_userdata('assignCoupon');
				}
				$encoded_email = createBase64($formData['email']);
                $activate_link = site_url('auth/login/'.$encoded_email);
                $data['link'] = $activate_link;
                
                $name = 'Dear '.$formData['username'];
                $message = "To activate your account please follow the below link <br /> $activate_link";
                $message .= "<br/>Regards,<br/>Administration of Uflow";
                send_email_to($name,$formData['email'],$message,'Activate Account');

                if($this->session->userdata('paymentSuccessToken')){
                    $this->session->unset_userdata('paymentSuccessToken');
                }
                if($this->session->userdata('paypal_email')){
                    $this->session->unset_userdata('paypal_email');
                }
				$data['response'] = true;
			}
		}
		else{
			$data['errors'] = all_errors($this->form_validation->error_array());
		}
		echo json_encode($data);
	}

	public function forgot_password()
	{
		$data = [];
		$this->load->view('auth/forgot_password', $data);
	}

	public function forgot_password_link()
	{
		$data = [];
		$this->layout = " ";
		if(!$this->input->is_ajax_request()){
		   exit('No direct script access allowed');
		}
		$data['response'] = false;
		$this->form_validation->set_rules('username','username','required|trim|callback_forgot_username_exists');
		if($this->form_validation->run()===TRUE){
			$username = $this->input->post('username');
			$where = "username = '".$username."'";
		    $result = $this->users->get_where('*', $where, true, '' , '', '');
            $result = $result[0];
            $update = ['password_time'=>time()];
            if($this->users->update_by('username',$username,$update)){
            	$encoded_username = createBase64($result['username']);
            	$reset_password_link = site_url('auth/reset_password/'.$encoded_username);
            	$data['link'] = $reset_password_link;
				
				$name = $result['username'];
				$message = "To reset your account password please follow the below link <br /> $reset_password_link";
				$message .= "<br/>Regards,<br/>Administration of MBTC";
				send_email_to($name,$result['email'],$message,'Reset Password');
				$data['response'] = true;
            }	
		}
		else{
            $data['errors'] = all_errors($this->form_validation->error_array());
		}
		//debug($data , true);
		echo json_encode($data);
	}

	public function forgot_username_exists($email = '')
    {
        if(!empty($email)){
        	$where = "username = '".$email."'";
	        $result = $this->users->get_where('*', $where, true, '' , '', '');
	        if(empty($result)){
	        	$this->form_validation->set_message('forgot_username_exists', 'This %s does not exists.');
                return FALSE;
            }
            return TRUE;
        }
    }

	public function reset_password($encoded_username='')
	{
		if(empty($encoded_username)){
	        redirect('login');
	    } 
		$data = [];
		$username = decodeBase64($encoded_username);
		$where = "username = '".$username."' AND status = '1'";
	    $result = $this->users->get_where('*', $where, true, '' , '', '');
	    if(empty($result)){
	    	$this->session->set_flashdata('error_message', "Invalid request to reset password.");
		    redirect('forgot-password');
	    }
	    $result = $result[0];
	    if(strtotime("-50 minutes") > $result['password_time']){
	    	$this->session->set_flashdata('error_message', "Reset password link is expired.Please try again.");
		    redirect('forgot-password');
	    }
	    $data['result'] = $result;
		$this->load->view('auth/reset_password', $data);
	}

	public function process_reset_password()
	{
		$data = [];
		$this->layout = " ";
		if(!$this->input->is_ajax_request()){
		   exit('No direct script access allowed');
		}
		$data['response'] = false;
		$this->form_validation->set_rules('user_id', '', 'required|numeric');
		$this->form_validation->set_rules('password', 'new password', 'required|trim|min_length[5]');
		$this->form_validation->set_rules('cpassword', 'confirm password', 'required|trim|matches[password]');
		if($this->form_validation->run()===TRUE){
			$user_id = $this->input->post('user_id');
			$password = $this->input->post('password');
			$cpassword = $this->input->post('cpassword');
			//$password = md5($password);
        	$update = ['password' => $password];
        	$this->users->update_by('id',$user_id,$update);
        	$data['response'] = true;
		}
		else{
			$data['errors'] = all_errors($this->form_validation->error_array());
		}
		echo json_encode($data);
	}
	
	public function is_email_exists($str, $id = 'ci_validation')
	{
		if(!empty($str)){
			$staff = $this->admin->uniqueLogin($str, $id);
			if (empty($staff)){
				return TRUE;
			}
			else{
				$this->form_validation->set_message('is_email_exists', 'This %s is already registered.');
				return FALSE;
			}
	    }
	}
		
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('sign-in'));
	}
	
}