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

	public function process_deduct()
    {
        $data = [];
        $this->layout = " ";
        if(!$this->input->is_ajax_request()){
            exit('No direct script access allowed');
        }
        $data['response'] = false;
        $data['msg'] = '';
        $formData = $this->input->post();
        if(empty($formData)){
            echo json_encode($data); exit;
        }
        $ids = $formData['de_ids'];
        $de_ids = [];
        foreach($ids as $id){
            if($id['name']!='de_ids[]'){
                continue;
            }
            array_push($de_ids, $id['value']);
        }
        if(empty($de_ids)){
            echo json_encode($data); exit;
        }
        $de_ids_str = implode(",",$de_ids);
        $where = "de_id IN (".$de_ids_str.")";
        $users = $this->daily_earnings->get_where('*', $where, true, '' , '', '');
        $user_id = $users[0]['de_user_id'];
        foreach($users as $key => $value){
        	if($value['de_user_id'] != $user_id){
        		$data['msg'] = "Please select single user to deduct amount.";
        		echo json_encode($data); exit;
        	}
        }
        $where = "de_id IN (".$de_ids_str.")";
        $result = $this->daily_earnings->get_where('SUM(de_earning) as de_earning', $where, true, '' , '', '');
        $de_earning = $result[0]['de_earning'];
        if($de_earning == 0){
        	$data['msg'] = 'low earning';
        	echo json_encode($data); exit;
        }
        $user_balance = user_balance($user_id);
        if($de_earning > $user_balance){
        	$data['msg'] = 'User has less balance in his earnings wallet.';
        	echo json_encode($data); exit;
        }
        $update = [];
        $update['user_balance'] = $user_balance - $de_earning;
        $this->user_balance->update_by('user_id',$user_id,$update);
        foreach($de_ids as $id){
        	$this->daily_earnings->delete_by('de_id', $id);
        }
        $data['response'] = true;
        echo json_encode($data);
    }
	
	
}