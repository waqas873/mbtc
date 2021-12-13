<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// this is new controlle

class Payment extends CI_Controller {

	public $selected_tab = '';

	function __Construct(){
		parent::__Construct();
		$this->selected_tab = "payment";
		$this->load->library('form_validation');
		$this->load->model('Users_model' , 'users');
		$this->load->model('Deposit_histories_model','deposit_histories');
		//$this->load->helper('Payment');

		date_default_timezone_set("America/Los_Angeles");
	}

	public function add()
	{
		$data = [];
        $this->layout = "template";
        $this->selected_tab = "payment_add";
		if(!$this->session->userdata('id')){
			redirect('user/user_dashboard'); exit;
		}
		$this->load->view('payment/payment',$data);
	}

	public function confirm_pay($inv_id='')
	{
		//debug($this->session->userdata() , true);
		if(!$this->session->userdata('id')){
            redirect('sign-in');
		}
		$ids = $this->session->userdata('id');

		$btcusd = floatval( $this->input->post('usd_amount') );
		
		if(!$this->session->userdata('invoice_id') && empty($inv_id)){
			
			$payment_processor  = 'perfect-money';
			$payment_processor_id ='2';
			
			$payment_details	 = 'Deposit section';
			
			$dh_activity_id = "DEP".rand(1,1000000000);
			$refference_number	= $dh_activity_id;
			
			$vdata = array();
			$vdata['user_id'] = $ids;
			$vdata['user_name'] =  $this->session->userdata('username');
			$vdata['package_id'] =  '';
			$vdata['refference_number'] = $refference_number;
			$vdata['payment_method'] = $payment_processor;
			$vdata['exchange_rate'] = 0;
			$vdata['btc_address'] = '';
			
			$vdata['payment_module_id'] = $payment_processor_id;
			$vdata['old_balance'] = '';
			$vdata['amount'] = $btcusd;
			$vdata['checkout_amount'] = $btcusd;
			$vdata['payment_details'] = $payment_details;
			$vdata['created_by'] = json_encode($_SESSION);
			$vdata['created_section'] = 'user area, deposit module.';
			$vdata['updated_ip'] = GetIP();
			
			$checkout_invoice_id = checkout_invoice( $vdata );
			$inv_id = $checkout_invoice_id;
			//var_dump($checkout_invoice_id);exit;
			$pm_acc        		= getSiteSettings('pm_account_id');
			
			//var_dump($vdata);exit;
			
			$this->session->set_userdata('checkout_invoice_id', $checkout_invoice_id);
			
			$btc_amount = $btcusd*1/1;
			
			$invoice_id = $inv_id;
			
			$this->session->set_userdata('invoice_id', $invoice_id);
			
			if( $payment_processor  == 'perfect-money'){
				$item_number = "$".$btcusd.' Deposit';
				if( $_SERVER['SERVER_NAME']== 'localhost' ){
					$notify_url = "https://winglehost.com/webhook/pm";
				}else{
					$notify_url = base_url('payment/pm_webhook');
				}
				
				$add_fund_url	 = base_url('payment/pm_webhook');
				$vdata = array();
				$vdata['invoice_id'] = $invoice_id;
				$vdata['btc_address'] = $pm_acc;
				$vdata['updated_ip'] = GetIP();
				
				$checkout_invoice_id = checkout_invoice_update( $vdata );
			?>
<form action="https://perfectmoney.is/api/step1.asp" method="POST">
<input type="hidden" name="PAYEE_ACCOUNT" value="<?=$pm_acc?>">
<input type="hidden" name="PAYEE_NAME" value="MBTC Digital">
<input type="hidden" name="PAYMENT_UNITS" value="USD">
<input type="hidden" name="STATUS_URL" value="<?=$notify_url?>">
<input type="hidden" name="PAYMENT_URL" value="<?=$add_fund_url?>">
<input type="hidden" name="NOPAYMENT_URL" value="<?=$add_fund_url?>">
<input type="hidden" name="PAYMENT_AMOUNT" value="<?=$btcusd?>">
<input type="hidden" name="PAYMENT_ID" value="<?=$invoice_id?>">
<input type="hidden" name="BAGGAGE_FIELDS" value="FIELD_1">
<input type="hidden" name="FIELD_1" value="<?=$invoice_id?>">
<input type="hidden" name="SUGGESTED_MEMO" value="<?=$item_number?>">
<input type="hidden" name="SUGGESTED_MEMO_NOCHANGE" value="1">
</form>
<script>document.forms[0].submit()</script>
			<?php
			exit;
			}
			
		}else{
			redirect('payment/add','refresh');
		}
		
		// end session
		if(!$this->session->userdata('invoice_id') && empty($inv_id)){
			$this->session->set_flashdata('error',"Payment deposit tracking timeout.");
			redirect('payment/add','refresh');
		}
		
		$data['payments_data'] = getUserDepositHistory($ids);
		
		$this->load->view('payment/payment',$data);
	}

	public function pm_webhook(){
		
		$flag = 0;
		
		$file_name = 'data/pm_ipn_log.php';
		
		$this->load->helper('file');
		$d = file_get_contents($file_name);
		$d = $d." \n \n ================================= \n".date("Y-m-d H:i:s");
		$d = $d." \n \n IPN HIT ".date("Y-m-d H:i:s");
		$d = $d." \n ".print_r($_REQUEST, TRUE);
		write_file($file_name, $d );
		echo("<pre>");
		var_dump($_REQUEST);
		echo("</pre>");
		$pm_acc        				= getSiteSettings('pm_account_id');
		$pm_account_secrete      	= getSiteSettings('pm_account_secrete');
		
		if (!isset($_POST['PAYMENT_ID']) || !isset($_POST['PAYEE_ACCOUNT']) || !isset($_POST['PAYMENT_AMOUNT']) || !isset($_POST['PAYMENT_UNITS']) || !isset($_POST['PAYMENT_BATCH_NUM']) || !isset($_POST['PAYER_ACCOUNT']) || !isset($_POST['TIMESTAMPGMT']))
		{
			$payment_d = 'Sending Invalid IPN';
			$error = "Fraud Case.".$payment_d;
			$d = $d." \n ".$error;
			write_file($file_name, $d );
			$flag = 1;
			//exit();
		}
		
		
		if (isset($_POST['PAYMENT_ID']) || isset($_POST['PAYEE_ACCOUNT']) || isset($_POST['PAYMENT_AMOUNT']) || isset($_POST['PAYMENT_UNITS']) || isset($_POST['PAYMENT_BATCH_NUM']) || isset($_POST['PAYER_ACCOUNT']) || isset($_POST['TIMESTAMPGMT']))
		{
			$sum			= $_POST['PAYMENT_AMOUNT'];
			$last_insert_id = intval($_POST['FIELD_1']);
			
			
			
			$payment_array = $this->db->query("SELECT * FROM paymen_history where id='".$last_insert_id."' and status != '1' LIMIT 1")->result_array();
			
			//var_dump($payment_array);exit;
			
			if( count($payment_array) > 0 ){
				$payment_details = $payment_array[0];
				
				$d .= "\n payment_details: ".print_r($payment_details,true);
				write_file($file_name, $d );
				
				$passphrase=strtoupper(md5($pm_account_secrete));
				$hash=$_POST['PAYMENT_ID'].':'.$_POST['PAYEE_ACCOUNT'].':'.
					  $_POST['PAYMENT_AMOUNT'].':'.$_POST['PAYMENT_UNITS'].':'.
					  $_POST['PAYMENT_BATCH_NUM'].':'.
					  $_POST['PAYER_ACCOUNT'].':'.$passphrase.':'.
					  $_POST['TIMESTAMPGMT'];
				$hash2=strtoupper(md5($hash));
				$pending = "Pending";
				
				if($hash2==$_POST['V2_HASH']){
					
					$d .= "\n validated ";
					write_file($file_name, $d );
					
					
				}else{
					$d .= "\n Hash2 != V2_HASH \n Balance not Added ".date("Y-m-d H:i:s");
					write_file($file_name, $d );
					$flag = 1;
					//exit;
				}
				
				
			}else{
				$d = $d." \n No payment found for ".$last_insert_id;
				write_file($file_name, $d );
				$flag = 1;
				//exit;
			}
			
		}else{
			$d = $d." \n else invalid data ";
			write_file($file_name, $d );
			$flag = 1;
		}
		
		
		
		if( $flag == 0 ){
			if( 
					floatval($_POST['PAYMENT_AMOUNT']) ==  floatval($payment_details['checkout_amount']) 
					|| float($_POST['PAYMENT_AMOUNT']) >  floatval($payment_details['checkout_amount']) 
				)
			{
				$payment_d = $payment_details['payment_details']." Total Paid in Perfect money: ".$_POST["PAYMENT_AMOUNT"]." PM payee account: ".$_POST["PAYER_ACCOUNT"]." T iD: ".$_POST["PAYMENT_ID"]." Rcv PM account: ".$_POST["PAYEE_ACCOUNT"]." And payment Status: Complete";
				
			}else{
				$d = $d." \n sorry amount is not accurate";
				write_file($file_name, $d );
				$flag = 1;
				
			}
		}
		
		
		if( $flag == 0 ){
			
			/*
			
			Array
			(
				[PAYEE_ACCOUNT] => U17747753
				[PAYMENT_ID] => 132184
				[PAYMENT_AMOUNT] => 10.00
				[PAYMENT_UNITS] => USD
				[PAYMENT_BATCH_NUM] => 289245453
				[PAYER_ACCOUNT] => U22584464
				[TIMESTAMPGMT] => 1573555737
				[V2_HASH] => 537FD23761C3654A511629D7C4B7C238
				[FIELD_1] => daBpcw==
				[BAGGAGE_FIELDS] => FIELD_1
			)
			
			*/
			
			
			$invoice_id 			= $last_insert_id;
			$amount 				= floatval($payment_details['checkout_amount']); //default value is in satoshis
			$transaction_hash 		= $_POST["PAYMENT_ID"];
			$amountCalc 			= $amount ; //optional convert to bitcoins
			
			//echo "SELECT * FROM deposit_histories where dh_invoice_id='".$last_insert_id."' and dh_status != '1' LIMIT 1";exit;
			
			
			$iscomplete = 1;
		
			    
				$vdata 							= array();
				$vdata['invoice_id'] 			= $invoice_id;
				$vdata['status'] 				= '1';
				$vdata['deposited_usd'] 			= $amount;
				$vdata['payment_details'] 		= $payment_d;
				$vdata['btc_post_response'] 	= json_encode( $_POST );
				$vdata['updated_ip'] 			= GetIP();
				
				$checkout_invoice_id 			= checkout_invoice_update( $vdata );
				
				
				$deposit_amount = $amountCalc;
				$user_id = $payment_details['user_id'];
				// update the user account amount.
				$result = $this->db->get_where('wallets',array("wallet_user_id"=>$user_id))->row();
				$balance = $result->wallet_balance+$deposit_amount;
				$deposit_amount = round($deposit_amount,2);
				$balance = round($balance,2);
				echo($balance);
				//var_dump($balance);
				$d = $d." \n All done ";
				write_file($file_name, $d );
			    
			    $locker = $this->db->query('show open tables where in_use <> 0');
			 	$locker = $locker->conn_id->affected_rows;
			 	if($locker > 0){
			 		sleep(1);
			 	}

				$this->db->update('wallets',array("wallet_balance"=>$balance),array("wallet_user_id"=>$user_id));
                
    //             $ed = email_details("deposit_confirmed","XXX",$deposit_amount,$user_id);
				// if(!empty($ed)){
		  //           send_email_to($ed['name'],$ed['to'],$ed['message'],$ed['subject'],"deposit_confirmed");
				// }
				
				echo "*ok*"; // you must echo *ok* on the page or blockchain will keep sending callback requests every block up to 1,000 times!
				
				//exit;
				
			redirect('payment/payment');
		
		}
		
		redirect('payment/payment');
	}

}

	?>