<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');	

class Internal_transfers extends CI_Controller
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
		$this->selected_tab = "internal_transfers";
		$this->user_id = $this->session->userdata('id');
		$this->load->model('internal_transfers_model', 'internal_transfers');
		$this->load->model('user_balance_model', 'user_balance');
		$this->load->model('wallets_model', 'wallets');
	}
	
	public function index()
	{
		$data = [];
		$where = "user_id = '".$this->user_id."'";
        $result = $this->user_balance->get_where('*', $where, true, '' , '', '');
        $data['user_balance'] = round($result[0]['user_balance'] , 2);

        $where = "user_id = '".$this->user_id."'";
        $data['internal_transfers'] = $this->internal_transfers->get_where('*', $where, true, 'id DESC' , '', '');
        // $joins = array();
        // $from_table = "daily_earnings daily_earnings";
        // $select_from_table = 'daily_earnings.*';
        // $data['result'] = $this->daily_earnings->get_by_join($select_from_table, $from_table, $joins, $where, 'de_id','DESC', '', '', '', '', '', '',true);
        //debug($data['result']);
		$this->load->view("internal_transfers/index",$data);
	}

	public function process_add()
    {
        $data = [];
        $this->layout = " ";
        if(!$this->input->is_ajax_request()){
           exit('No direct script access allowed');
        }
        $data['response'] = false;
        $formData = $this->input->post();
        $checkAmount = json_encode($formData);
        $this->form_validation->set_rules('privacy','privacy','required|trim|callback_check_amount['.$checkAmount.']');
        if($this->form_validation->run()===TRUE){
        	$where = "wallet_user_id = '".$this->user_id."'";
	        $result = $this->wallets->get_where('*', $where, true, '' , '', '');
	        $wallet_balance = round($result[0]['wallet_balance'] , 2);
            $id = $this->internal_transfers->save($formData);
            $data['response'] = true;
        }
        else{
            $data['errors'] = all_errors($this->form_validation->error_array());
        }
        echo json_encode($data);
    }

    public function check_amount($value , $arr = [])
    {
        $arr = json_decode($arr , true);
        if(!empty($arr)){
            $amount = $arr['amount'];
            $where = "user_id = '".$this->user_id."'";
            $result = $this->user_balance->get_where('*', $where, true, '' , '', '');
            $user_balance = $result[0]['user_balance'];
            if($amount > $user_balance){
                $this->form_validation->set_message('check_amount', 'Please enter a valid amount to transfer.');
                return FALSE;
            }
            return true;
        }
        return true;
    }

	
}