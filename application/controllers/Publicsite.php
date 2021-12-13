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

class Publicsite extends CI_Controller
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
		$this->layout = "publicsite";

		if($this->session->userdata("id")){
			redirect("user/UserDashboard");
		}

		$this->load->model('Packages_model', 'packages');
		$this->load->model('Users_model', 'users');
		$this->load->model('Wallets_model', 'wallets');
		$this->load->model('User_balance_model', 'user_balance');
		$this->load->model('countries_model', 'countries');

		date_default_timezone_set("America/Los_Angeles");
        
	}
	
	public function index()
	{
		$data = array();
		$where = "package_id > 0";
        $data['packages'] = $this->packages->get_where('*', $where, true, '' , '', '');
        $this->load->view("publicsite/index",$data);
	}

	public function signup($sponsor_code = '' , $side = '')
	{
		$data = array();
		$this->layout = "auth";
		$data['sponsor_code'] = $sponsor_code;
		$data['side'] = $side;
		$where = "id > 0";
        $data['countries'] = $this->countries->get_where('*', $where, true, '' , '', '');
		$this->load->view("publicsite/signup",$data);
	}

	public function process_signup()
	{
		$data = array();
		$this->layout = "auth";

		if($this->input->post()){
			$this->form_validation->set_rules('fullname', 'Full Name', 'required|callback_fullname');
			$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[5]|max_length[16]|callback_is_username_exists');
			//$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_is_email_exists');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('position', 'position', 'required');
			// $this->form_validation->set_rules('country', 'country', 'required');
			//$this->form_validation->set_rules('wallet_address', 'Wallet Address', 'required|alpha_numeric|min_length[25]|max_length[34]');
			$this->form_validation->set_rules('sponsor_code', 'Sponsor Code', 'required|callback_is_sponsor_code');
			$this->form_validation->set_rules('contact_no', 'contact no', 'required|min_length[8]|max_length[25]');
			//$this->form_validation->set_rules('tnc', 'terms and conditions', 'required');
			if($this->form_validation->run() === TRUE){
				$data = $this->input->post();

                $where = "users.sponsor_code='".$data['sponsor_code']."' ";
				$parent_user = $this->users->get_where('*', $where, true, '' , '', '');
				$parent_id = $parent_user[0]['id'];
				$data['referral_id'] = $parent_user[0]['id'];

				$condition = true;
				while($condition == true){
					$where = "users.parent_id='".$parent_id."' AND position = '".$data['position']."'";
				    $result = $this->users->get_where('*', $where, true, '' , '', '');
				    if(!empty($result)){
				    	$parent_id = $result[0]['id'];
				    }
				    else{
				    	$condition = false;
				    }
				}

				$data['parent_id'] = $parent_id;
                $data['sponsor_code'] = random_password();
				unset($data['cpassword'],$data['tnc']);
				$this->db->trans_start();
				if($user_id = $this->users->save($data)){
                    $insert = array('user_id' => $user_id);
					$this->user_balance->save($insert);
					$insert = array('wallet_user_id' => $user_id);
					$this->wallets->save($insert);
					$this->db->trans_complete();
					$this->session->set_flashdata('success_message','Your account has been created successfully.');
					redirect('sign-in');
				}
				else{
					$this->session->set_flashdata('error_message','Error occured while signing up.');
					redirect('publicsite/signup');
				}
			}
			else{
				$data['signup_tab'] = "signup_tab";
				$where = "id > 0";
                $data['countries'] = $this->countries->get_where('*', $where, true, '' , '', '');
				$this->load->view('publicsite/signup',$data);
			}
		}
		else{
			$this->session->set_flashdata('error_message','Invalid request of signing up.');
		    redirect('publicsite/signup');
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

    public function process_login()
	{
		$this->layout = "auth";
		if($this->input->post()){
			$this->form_validation->set_rules('username', 'username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if($this->form_validation->run() === TRUE){

				$data = $this->input->post();

                $where = "users.password = '".$data['password']."' AND users.username = '".$data['username']."'";
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
					$this->session->set_userdata("profile_pic",$userdata[0]['profile_pic']);  

					redirect("User/UserDashboard");
				}else{
					$this->session->set_flashdata("error_message","Invalid Username/email or Password!");
					redirect("sign-in");
				}
			}
			else{
				$this->load->view('auth/login');
			}
		}
		else{
			$this->session->set_flashdata("error_message","Invalid Username/email or Password!");
			redirect("sign-in");
		}
	}

	public function about()
	{
		$data = array();
		$this->load->view("publicsite/about",$data);
	}

	public function advantages()
	{
		$data = array();
		$this->load->view("publicsite/advantages",$data);
	}

	public function blog_single()
	{
		$data = array();
		$this->load->view("publicsite/blog-single",$data);
	}

	public function blog()
	{
		$data = array();
		$this->load->view("publicsite/blog",$data);
	}

	public function buy_sell()
	{
		$data = array();
		$this->load->view("publicsite/buy-sell",$data);
	}

	public function contact()
	{
		$data = array();
		$this->load->view("publicsite/contact",$data);
	}

	public function faqs()
	{
		$data = array();
		$this->load->view("publicsite/faqs",$data);
	}

	public function index_mining()
	{
		$data = array();
		$this->load->view("publicsite/index-mining",$data);
	}

	public function index_wallet()
	{
		$data = array();
		$this->load->view("publicsite/index-wallet",$data);
	}

	public function market_data()
	{
		$data = array();
		$this->load->view("publicsite/market-data",$data);
	}

	public function pricing()
	{
		$data = array();
		$this->load->view("publicsite/pricing",$data);
	}

	public function road_map()
	{
		$data = array();
		$this->load->view("publicsite/road-map",$data);
	}

	public function service_single()
	{
		$data = array();
		$this->load->view("publicsite/service-single",$data);
	}

	public function service()
	{
		$data = array();
		$this->load->view("publicsite/service",$data);
	}

	public function service1()
	{
		$data = array();
		$this->load->view("publicsite/service1",$data);
	}

	public function teams()
	{
		$data = array();
		$this->load->view("publicsite/teams",$data);
	}

	public function testimonial()
	{
		$data = array();
		$this->load->view("publicsite/testimonial",$data);
	}

	public function typography()
	{
		$data = array();
		$this->load->view("publicsite/typography",$data);
	}

	public function wallet_features()
	{
		$data = array();
		$this->load->view("publicsite/wallet-features",$data);
	}
	
}