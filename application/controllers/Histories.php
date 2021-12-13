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

class Histories extends CI_Controller
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
		if(!$this->session->userdata("role")){
			redirect("user/UserDashboard"); exit;
		}
        if($this->session->userdata("role") != "admin"){
			redirect("user/UserDashboard"); exit;
		}
		$this->layout = "admin";
		$this->selected_tab = "histories";
		$this->load->model('daily_earnings_model', 'daily_earnings');
	}
	
	public function roi($user_id = 0)
	{
		$this->selected_tab = "roi";
		$data = [];
		$where = "de_earning > 0 AND de_source = 'Roi'";
		if(!empty($user_id)){
			$user_id = decodeBase64($user_id);
			$data['user_id'] = $user_id;
			$where .= " AND de_user_id = '".$user_id."'";
		}
        $joins = array(
    	    '0' => array('table_name' => 'users users',
                'join_on' => ' users.id = daily_earnings.de_user_id',
                'join_type' => 'left'
            )
        );
        $from_table = "daily_earnings daily_earnings";
        $select_from_table = 'daily_earnings.*,users.fullname,users.username';
        $data['result'] = $this->daily_earnings->get_by_join($select_from_table, $from_table, $joins, $where, 'de_id','DESC', '', '', '', '', '', '',true);
        //debug($data['result']);
		$this->load->view("histories/roi",$data);
	}

	public function binary($user_id = 0)
	{
		$this->selected_tab = "binary";
		$data = [];
		$where = "de_earning > 0 AND de_source = 'Binary Bonus'";
		if(!empty($user_id)){
			$user_id = decodeBase64($user_id);
			$data['user_id'] = $user_id;
			$where .= " AND de_user_id = '".$user_id."'";
		}
        $joins = array(
    	    '0' => array('table_name' => 'users users',
                'join_on' => ' users.id = daily_earnings.de_user_id',
                'join_type' => 'left'
            )
        );
        $from_table = "daily_earnings daily_earnings";
        $select_from_table = 'daily_earnings.*,users.fullname,users.username';
        $data['result'] = $this->daily_earnings->get_by_join($select_from_table, $from_table, $joins, $where, 'de_id','DESC', '', '', '', '', '', '',true);
        //debug($data['result']);
		$this->load->view("histories/binary",$data);
	}

	public function referral($user_id = 0)
	{
		$this->selected_tab = "referral";
		$data = [];
		$where = "de_earning > 0 AND de_source = 'Referal Bonus'";
		if(!empty($user_id)){
			$user_id = decodeBase64($user_id);
			$data['user_id'] = $user_id;
			$where .= " AND de_user_id = '".$user_id."'";
		}
        $joins = array(
    	    '0' => array('table_name' => 'users users',
                'join_on' => ' users.id = daily_earnings.de_user_id',
                'join_type' => 'left'
            )
        );
        $from_table = "daily_earnings daily_earnings";
        $select_from_table = 'daily_earnings.*,users.fullname,users.username';
        $data['result'] = $this->daily_earnings->get_by_join($select_from_table, $from_table, $joins, $where, 'de_id','DESC', '', '', '', '', '', '',true);
        //debug($data['result']);
		$this->load->view("histories/referral",$data);
	}
	
	
}