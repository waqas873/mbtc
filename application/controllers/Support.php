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

class Support extends CI_Controller
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
		$this->selected_tab = "support";
		if (!$this->session->userdata("role")) {
			redirect("user/UserDashboard");
		}
		$this->load->model('Users_model', 'users');
	}
	
	public function index()
	{
		$data = array();
		if ($this->session->userdata("role")=="admin") {
			redirect("user/UserDashboard"); exit;
		}
		$where = "role = 'admin'";
        $admin = $this->users->get_where('*', $where, true, '' , '', '');
        if(!empty($admin)){
        	$data['email'] = $admin[0]['email'];
        }
		$this->load->view("support/index",$data);
	}
	
	
}