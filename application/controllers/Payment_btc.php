<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// this is new controller
class Payment_btc extends CI_Controller {

	function __Construct(){
		parent::__Construct();
		$this->load->library('form_validation');
		$this->load->model('Users_model' , 'users');
		$this->load->model('Deposit_histories_model','deposit_histories');
		//$this->load->helper('Payment');

		date_default_timezone_set("America/Los_Angeles");
	}

	public function bitcoin()
	{
        $this->layout = "template";
        if($this->session->userdata('role') == "admin"){
			$this->layout = "admin";
		}
		$data = array();
		if(!$this->session->userdata('id'))
		{
			redirect('user/user_dashboard'); exit;
		}

	    $btcusd = get_current_btcusd();
		$data['btcusd'] = $btcusd;
		if($this->session->userdata('invoice_id')){
			unset($_SESSION['invoice_id']);
		}
		$this->load->view('payment/bitcoin_payment',$data);
	}

	public function bitcoin_confirm_pay($inv_id='')
	{
		$this->layout = "template";
		if($this->session->userdata('role') == "admin"){
			$this->layout = "admin";
		}
		$data = array();
		$user_id = $this->session->userdata('id');
		if($this->session->userdata('id'))
		{
			// check session
			if(!$this->session->userdata('invoice_id') && empty($inv_id)){
				$btcusd = $this->input->post('btcusd');
				$btc_rate = $this->input->post('btc_rate');

				$btc_amount = $btcusd*1/$btc_rate;

				$invoice_id = uniqid();
				$callback_url = base_url('payment/bitcoin_callback')."/?invoice_id=".$invoice_id."&secret=".BITCOIN_SECRET;
				$response=call_bitcoin_payment($callback_url);
				if(isset($response['address'])){
					$btc_address = $response['address'];
					$insert_data = array(
						'dh_user_id'=>$user_id,
						'dh_invoice_id'=>$invoice_id,
						'dh_blockchain_address'=>$btc_address,
						'dh_paid'=>0,
						'dh_complete'=>0,
						'dh_btc_rate'=>round($btc_rate,8),
						'dh_btcusd'=>round($btcusd,8),
						'dh_btc'=>round($btc_amount,8),
						'dh_btc_receive'=>0,
						'dh_status'=>1,
						'dh_created_at'=>formated_date(),
						'dh_updated_at'=>formated_date()
					);
					$affected=$this->deposit_histories->save($insert_data);
					if(!$affected){
						$this->session->set_flashdata('error_message',"Server is not response, please try later.");
						redirect('payment/bitcoin','refresh');
					}
				    $this->session->set_userdata('invoice_id', $invoice_id);
				}
				else{
					$this->session->set_flashdata('error_message',$response['message'].' : '.$response['description']);
					redirect('payment/bitcoin','refresh');
				}
			}
			// end session

			if(!$this->session->userdata('invoice_id') && empty($inv_id)){
				$this->session->set_flashdata('error',"Payment deposit tracking timeout.");
				redirect('payment/bitcoin','refresh');
			}

		    $invoice_id=!empty($inv_id)?$inv_id:$this->session->userdata('invoice_id');

		    $where = 'dh_invoice_id = "'.$invoice_id.'"';
            $result = $this->deposit_histories->get_where('*', $where, true, '', '', '');
		    if(empty($result)){
		      $this->session->set_flashdata('error_message',"Time out.");
              redirect('payment/bitcoin','refresh');
		    }
		    $data['deposit'] = $result[0];

			$this->load->view('payment/bitcoin_confirm_pay',$data);
		}   
	}

	public function history()
	{
		$this->layout = "template";
		if($this->session->userdata('role') == "admin"){
			$this->layout = "admin";
		}
	    $user_id = $this->session->userdata('id');
	    $data = array();
        $where = "dh_user_id = '".$user_id."' AND dh_paid = '1'";
        $data['deposit_history'] = $this->deposit_histories->get_where('*', $where, true, '', '', '');
	    $this->load->view('payment/history',$data);
	}

	public function admin_history()
	{
		$this->layout = "template";
		if($this->session->userdata('role') == "admin"){
			$this->layout = "admin";
		}
	    $data = array();
        $where = "dh_paid = '1'";
        $joins = array(
        	    '0' => array('table_name' => 'users users',
	                'join_on' => ' users.id = deposit_histories.dh_user_id ',
	                'join_type' => 'left'
	            )
        );
        $from_table = "deposit_histories deposit_histories";
        $select_from_table = 'deposit_histories.*,users.*';
        $data['deposit_history'] = $this->deposit_histories->get_by_join($select_from_table, $from_table, $joins, $where, 'dh_id','DESC', '', '', '', '', '', '',true);

        $this->load->view('payment/admin_history',$data);
	}

	public function update_deposit($invoice_id=''){
		if(!empty($invoice_id)){
            $where = 'dh_invoice_id = "'.$invoice_id.'"';
            $result = $this->deposit_histories->get_where('*', $where, true, '', '', '');
            if(!empty($result)){
				$result = $result[0];
				$btcusd = $result['dh_btcusd'];
		        $btc_rate = get_current_btcusd();
		        $btc_amount = $btcusd*1/$btc_rate;
		        $update_data = array(
					'dh_btc_rate'=>round($btc_rate,8),
					'dh_btc'=>round($btc_amount,8),
					'dh_created_at'=>formated_date(),
					'dh_updated_at'=>formated_date()
				);
				$this->deposit_histories->update_by('dh_invoice_id', $invoice_id,$update_data);
		    }
		}
	}

	public function bitcoin_callback()
	{
		$logs=json_encode($this->input->get());
		$this->db->insert('bitcoins_log',['bl_log'=>$logs]);

		if($this->input->get('secret')!= BITCOIN_SECRET){
			die('Stop doing that.');
		}
		else{

		    //update DB
		    $invoice_id =$this->input->get('invoice_id');
		    $amount = $this->input->get('value'); //default value is in satoshis
		    if(empty($amount))
		    	$amount = 0;
            //echo $amount;exit;
            $transaction_hash = $this->input->get('transaction_hash');
		    $amountCalc =  $amount / 100000000; //optional convert to bitcoins

		    $where = 'dh_invoice_id = "'.$invoice_id.'"';
            $deposit = $this->deposit_histories->get_where('*', $where, true, '', '', '');
            $deposit = $deposit[0];
            if($deposit['dh_paid']==0){
			    if($amountCalc>=$deposit['dh_btc']){
			   	    $iscomplete = 1;
			    }else{
			   	    $iscomplete = 0;
			    }
			    $deposit_amount =  (float)$amountCalc * $deposit['dh_btc_rate'];
			    $deposit_amount = number_format($deposit_amount,2);
			    $update_data = array(
			   	    'dh_paid'=>1,
			   	    'dh_complete'=>$iscomplete,
			   	    'dh_btc_receive'=>$amountCalc,
			   	    'dh_usd_deposited'=>$deposit_amount,
			   	    'dh_transaction_hash'=>$transaction_hash,
			   	    'dh_updated_at'=>formated_date()
			    );
			    if($affected = $this->deposit_histories->update_by('dh_invoice_id', $invoice_id,$update_data)){

			    	$user_id = $deposit['dh_user_id'];
				   	// update the user account amount.

				   	$this->load->model('Wallets_model' , 'wallets');
		            $where = "wallet_user_id = '".$user_id."' ";
		            $result = $this->wallets->get_where('*', $where, true, '' , '', '');
		            $result = $result[0];
		            $previous_balance = $result['wallet_balance'];
		            
		            $update_account = array();
		            $update_account['wallet_balance'] = $previous_balance+$deposit_amount;
		            $this->wallets->update_by('wallet_user_id', $user_id, $update_account);

				   	echo '"*ok*"'; // you must echo *ok* on the page or blockchain will keep sending callback requests every block up to 1,000 times!
			    }
            }

        }
    }

	function get_btc_amount(){
	    $usd_amount=$this->input->post('usd_amount');
        $btc_amount=usd_to_btc($usd_amount);
        $response = array();
        $response['status']= false;
        $response['message'] = 'USD to BTC conversion problem, try again';
        if(!empty($btc_amount)){
            $response['status']= true;
            $response['btc_amount']= $btc_amount;
            $response['message'] = 'USD to BTC conversion Amount';
        }
        echo json_encode($response);
        exit;
    }

}

	?>