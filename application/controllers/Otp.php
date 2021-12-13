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

class Otp extends CI_Controller
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
		$this->selected_tab = "news";
		if(!$this->session->userdata('id')){
			redirect('user/UserDashboard');
		}
		if($this->session->userdata('role') == "admin"){
			$this->layout = "admin";
		}
		$this->load->model('Users_model','users');
		date_default_timezone_set("America/Los_Angeles");
	}
	
	/** 
	* Controller Function to List All Admins
	* 
	* @access public 
	*/
	
	/** 
	* Controller Function to Add Admins
	* 
	* @access public 
	*/

	public function send_otp($otpFor = '')
    {
        $data = [];
        $this->layout = " ";
        if(!$this->input->is_ajax_request()){
           exit('No direct script access allowed');
        }
        $data['proceed'] = false;
        $data['otp'] = false;
        $user = user_info($this->session->userdata('id'));
        if(!$this->session->userdata('otp')){
        	$data['otp_code'] = rand(1,1000000);
        	$this->session->set_userdata('otp',$data['otp_code']);
        	$subject = '';
        	$message = '';
        	if($otpFor=='withdraw'){
        		$subject = 'OTP For Withdraw';
        		$message = 'OTP for withdraw request is given below.<br/>';
        	}
        	if($otpFor=='profile'){
        		$subject = 'OTP For Profile';
        		$message = 'OTP for Profile update request is given below.<br/>';
        	}
        	$message .= $data['otp_code'];
            send_email_to($user['fullname'],$user['email'],$message,$subject);
            $data['otp'] = true;
        }
        elseif(!$this->session->userdata('otpCompleted')){
            $data['otp'] = true;
        }
        else{
            $data['proceed'] = true;
        }
        //debug($data , true);
        echo json_encode($data);
    }

    public function verify_otp()
    {
        $data = [];
        $this->layout = " ";
        if(!$this->input->is_ajax_request()){
           exit('No direct script access allowed');
        }
        $data['response'] = false;
        $this->form_validation->set_rules('otp','','required|trim');
        if($this->form_validation->run()===TRUE){
            $otp = $this->input->post('otp');
            if($otp == $this->session->userdata('otp')){
            	$this->session->set_userdata('otpCompleted' , true);
                $data['response'] = true;
            }
        }
        echo json_encode($data);
    }
	
}