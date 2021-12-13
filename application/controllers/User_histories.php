<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');	

class User_histories extends CI_Controller
{
	public $selected_tab = '';
	public $user_id = '';
	
	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('id')){
			redirect("user/UserDashboard"); exit;
		}
        if($this->session->userdata("role") == "admin"){
			redirect("user/UserDashboard"); exit;
		}
		$this->layout = "template";
		$this->selected_tab = "histories";
		$this->user_id = $this->session->userdata('id');
		$this->load->model('daily_earnings_model', 'daily_earnings');
	}
	
	public function roi()
	{
		$this->selected_tab = "roi";
		$data = [];
		$where = "de_earning > 0 AND de_source = 'Roi'";
		$where .= " AND de_user_id = '".$this->user_id."'";
        $joins = array();
        $from_table = "daily_earnings daily_earnings";
        $select_from_table = 'daily_earnings.*';
        $data['result'] = $this->daily_earnings->get_by_join($select_from_table, $from_table, $joins, $where, 'de_id','DESC', '', '', '', '', '', '',true);
        //debug($data['result']);
		$this->load->view("user_histories/roi",$data);
	}

	public function binary()
	{
		$this->selected_tab = "binary";
		$data = [];
		$where = "de_earning > 0 AND de_source = 'Binary Bonus'";
		$where .= " AND de_user_id = '".$this->user_id."'";
        $joins = array();
        $from_table = "daily_earnings daily_earnings";
        $select_from_table = 'daily_earnings.*';
        $data['result'] = $this->daily_earnings->get_by_join($select_from_table, $from_table, $joins, $where, 'de_id','DESC', '', '', '', '', '', '',true);
        //debug($data['result']);
		$this->load->view("user_histories/binary",$data);
	}

	public function referral()
	{
		$this->selected_tab = "referral";
		$data = [];
		$where = "de_earning > 0 AND de_source = 'Referal Bonus'";
		$where .= " AND de_user_id = '".$this->user_id."'";
         $joins = array(
    	    '0' => array('table_name' => 'users users',
                'join_on' => ' users.id = daily_earnings.referral_from',
                'join_type' => 'left'
            )
        );
        $from_table = "daily_earnings daily_earnings";
        $select_from_table = 'daily_earnings.*,users.fullname';
        $data['result'] = $this->daily_earnings->get_by_join($select_from_table, $from_table, $joins, $where, 'de_id','DESC', '', '', '', '', '', '',true);
        //debug($data['result']);
		$this->load->view("user_histories/referral",$data);
	}
	
	
}