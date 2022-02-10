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

class Withdraws extends CI_Controller
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
		$this->selected_tab = "withdraws";
		if (!$this->session->userdata("role")) {
			redirect("sign-in");
		}
		$this->load->model('Packages_model', 'packages');
		$this->load->model('Users_model','users');
		$this->load->model('Withdraws_model','withdraws');
		$this->load->model('Withdraw_limits_model','withdraw_limits');

		date_default_timezone_set('Europe/London');
	}
	
	/** 
	* Controller Function to List All Admins
	* 
	* @access public 
	*/

	public function index($user_id='',$status='')
	{
		$data = array();

		if($this->session->userdata('role')=="user"){
			$user_id = $this->session->userdata('id');
		}

		if(!empty($status)){
			if(!ctype_digit($status) || $status>2){
			    redirect("user/UserDashboard"); exit;
		    }
		    ($status==0)?$status='0':'';
		}

		$where = (!empty($user_id) && ctype_digit($user_id))?"withdraws.user_id = '".$user_id."'":"withdraw_status = '".$status."'";
		$joins = array(
        	    '0' => array('table_name' => 'users users',
	                'join_on' => ' users.id = withdraws.user_id',
	                'join_type' => 'left'
	            ),
	            '1' => array('table_name' => 'user_balance user_balance',
	                'join_on' => ' user_balance.user_id = withdraws.user_id',
	                'join_type' => 'left'
	            )
        );
        $from_table = "withdraws withdraws";
        $select_from_table = 'withdraws.*,users.*,user_balance.*';
        $data['withdraws'] = $this->withdraws->get_by_join($select_from_table, $from_table, $joins, $where, 'withdraw_id','DESC', '', '', '', '', '', '',true);
        //debug($data['withdraws'],true);

        ($status == '0')?$this->selected_tab = "pending_withdraws":'';
        ($status == 1)?$this->selected_tab = "approved_withdraws":'';
        ($status == 2)?$this->selected_tab = "rejected_withdraws":'';

        ($status == '0')?$data['heading'] = "Pending Withdraws":'';
        ($status == 1)?$data['heading'] = "Approved Withdraws":'';
        ($status == 2)?$data['heading'] = "Rejected Withdraws":'';

	  	$this->load->view("withdraws/index",$data);
	}

	public function process_add()
	{
		if ($this->session->userdata("role")=="admin") {
			redirect("Withdraws/");
		}

		$user_id = $this->session->userdata("id");
		$data = array();
		if($this->input->post('withdraw_amount'))
		{
			// $withraw_day =  date("l");
			// if($withraw_day!="Monday"){
			// 	$this->session->set_flashdata('error_message', "You can withdraw on Monday.");
			// 	redirect('withdraws/index/'); exit;
		 //    }

			$withdraw_amount = $this->input->post('withdraw_amount');
			$payment_method = $this->input->post('payment_method');
			if(empty($payment_method)){
				$this->session->set_flashdata('error_message', "Please select a payment method.");
				redirect('withdraws/index/'); exit;
			}

			$user_info = user_info($user_id);
			if($payment_method=="Perfect Money" && empty($user_info['wallet_address'])){
				$link = base_url('user_childs/update');
				$this->session->set_flashdata('error_message', "Please first provide your PM wallet address and then request for withdraw.Go to profile settings for adding PM wallet address.");
				redirect('withdraws/index/'); exit;
			}
			if($payment_method=="USDT" && empty($user_info['usdt_wallet_address'])){
				$link = base_url('user_childs/update');
				$this->session->set_flashdata('error_message', "Please first provide your USDT wallet address and then request for withdraw.Go to profile settings for adding USDT wallet address.");
				redirect('withdraws/index/'); exit;
			}

			$where2 = "wl_id > 0";
		    $limits = $this->withdraw_limits->get_where('*', $where2, true, 'wl_id DESC', 1, '');
		    $limits = $limits[0];
		    $min_limit = $limits['min_withdraw'];
		    $max_limit = $limits['max_withdraw'];
		    if($withdraw_amount == 0){
                $this->session->set_flashdata('error_message', "Invalid request of withdraw.");
				redirect('withdraws/index/'); exit;
		    }
		    if($withdraw_amount < $min_limit){
                $this->session->set_flashdata('error_message', "The minimum withdraw allowed is $".$min_limit.".");
				redirect('withdraws/index/'); exit;
		    }
		    if($withdraw_amount > $max_limit){
                $this->session->set_flashdata('error_message', "The amount of withdraw exceeds the withdraw limit.");
				redirect('withdraws/index/'); exit;
		    }

			$user_balance = user_balance($user_id);
			if($user_balance >= $withdraw_amount){

				$where = "user_id = '".$user_id."'";
	            $result = $this->withdraws->get_where('*', $where, true, 'withdraw_id DESC', 1, '');
	            //debug($result,true);
	            if(!empty($result)){
	            	
                    $date1 = $result[0]['requested_on'];
					$today = time();
					$date1= strtotime($date1);
					$no_of_hours = round(abs($today-$date1)/60/60);

                    if($no_of_hours >= 24){

                        $data['user_id'] = $user_id;
		            	$data['withdraw_amount'] = $withdraw_amount;
		            	$data['withdraw_fees'] = ((WITHDRAW_FEE/100)*$withdraw_amount);
		            	$data['requested_on'] = date('Y-m-d H:i:s');
		            	$data['payment_method'] = $payment_method;
		            	$this->withdraws->save($data);
		            	$this->session->set_flashdata('success_message', 'Your request under review.Maximum time 24 hours.');
                    }
                    else{
                    	$remaining_hours = 24 - $no_of_hours;
                    	$this->session->set_flashdata('error_message', "You can make your next withdraw request after ".$remaining_hours." hours.");
                    }
                    redirect('withdraws/index/');
	            }
	            else{
	            	$data['user_id'] = $user_id;
	            	$data['withdraw_amount'] = $withdraw_amount;
	            	$data['withdraw_fees'] = ((WITHDRAW_FEE/100)*$withdraw_amount);
	            	$data['requested_on'] = date('Y-m-d H:i:s');
	            	$data['payment_method'] = $payment_method;
	            	if($withdraw_id = $this->withdraws->save($data)){
	            		$this->session->set_flashdata('success_message', 'Your withdraw request has been submitted successfully.Please wait for admin approvel.');
	            	}
	            	else{
                        $this->session->set_flashdata('error_message', 'Error occured while submitting withdraw request.');
	            	}
	            	redirect('withdraws/index/');
	            }
            }
            else{
		    	$this->session->set_flashdata('error_message', 'Your account balance is low than amount of withdraw requested.');
				redirect('withdraws/index/');
		    }
		}
		else{
			$this->session->set_flashdata('error_message', 'Invalid request for withdraw.');
			redirect('withdraws/index/');
		}
	}

	public function approve_withdraw($withdraw_id='')
	{
		if($this->session->userdata("role")!="admin"){
    		$this->session->set_flashdata('error_message', 'Only Admin has authority to approve withdraw request.');
			redirect("Withdraws/");
		}
        
        $data = array();
        $this->db->trans_start();
        if(!empty($withdraw_id)){
            $where = "withdraw_id = '".$withdraw_id."' AND (withdraw_status = '0' OR withdraw_status = '2')";
		    $result = $this->withdraws->get_where('*', $where, true, '', '', '');
		    if(!empty($result)){
		    	$result = $result[0];
		    	$user_balance = user_balance($result['user_id']);
		    	if($result['withdraw_amount'] > $user_balance){
                    $this->session->set_flashdata('error_message', 'User has less amount in his wallet.');
			        redirect('withdraws/index/user/0/');
			        exit;
		    	}
		    	$data['withdraw_status'] = 1;
		    	$this->withdraws->update_by('withdraw_id', $withdraw_id, $data);
		    	update_user_balance($result['user_id'],$result['withdraw_amount'],true);
		    	$this->session->set_flashdata('success_message', 'Withdraw request has been approved successfully.');

		    	$user_info = user_info($result['user_id']);

				$message = "Your request of withdraw amount $".$result['withdraw_amount']." has been approved successfully.";
				$message .= "Regards,<br/>Administration of MBTC";

				send_email_to($user_info['fullname'],$user_info['email'],$message,'Withdraw Approved');
		    }
		    else{
		    	$this->session->set_flashdata('error_message', 'Invalid request to approve withdraw request.');
		    }
		    $this->db->trans_complete();
		    redirect('withdraws/index/user/0/');
        }
        else{
        	$this->session->set_flashdata('error_message', 'Invalid request to approve withdraw request.');
			redirect('withdraws/index/user/0/');
        }
	}

	public function reject_withdraw($withdraw_id='')
	{
		if($this->session->userdata("role")!="admin"){
    		$this->session->set_flashdata('error_message', 'Only Admin has authority to reject withdraw request.');
			redirect("Withdraws/");
		}

		$data = array();
		if(isset($withdraw_id) && !empty($withdraw_id))
		{
			$data['withdraw_status'] = 2;
			if($result = $this->withdraws->update_by('withdraw_id', $withdraw_id,$data)) {
				$this->session->set_flashdata('success_message', 'Withdraw request has been rejected successfully.');
			}
			else{
				$this->session->set_flashdata('error_message', 'Error occured while rejecting withdraw request.');
			}
			redirect('withdraws/index/user/2/');
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Invalid request to reject withdraw request.');
			redirect('withdraws/index/user/2/');
		}	
	}

	public function withdraw_limits() 
	{
		if($this->session->userdata("role")!="admin"){
    		redirect("user/UserDashboard");
		}

		$data = array();
		$this->selected_tab = 'withdraw_limits';
		$user_id = $this->session->userdata('id');
		$where = "wl_id > 0";
		$withdraw_limits = $this->withdraw_limits->get_where('*', $where, true, '' , '', '');
		$data['data'] = $withdraw_limits[0];
		$this->load->view('withdraws/withdraw_limits',$data);
    }

    public function process_withdraw_limits()
	{
		if($this->session->userdata("role")!="admin"){
    		redirect("user/UserDashboard");
		}

		$data = array();
		if($this->input->post())
		{
			$this->form_validation->set_rules('wl_id','','required');
			$this->form_validation->set_rules('min_withdraw','Minimum Withdraw','required|numeric');
			$this->form_validation->set_rules('max_withdraw','Maximum Withdraw','required|numeric');
			if($this->form_validation->run() === TRUE)
			{
				$wl_id = $this->input->post('wl_id');
				$data = $this->input->post();
				unset($data['wl_id']);
                if( $wl_id = $this->withdraw_limits->update_by('wl_id', $wl_id, $data) )
				{
					$this->session->set_flashdata('success_message', 'Withdraw limits has been updated successfully.');
					redirect('withdraws/withdraw_limits');
				}
				else
				{
					$this->session->set_flashdata('error_message', 'Error occured while updating withdraws limits.');
					redirect('withdraws/withdraw_limits');
				}
			}
			else{
				$this->load->view('withdraws/withdraw_limits');
			}
		}
		else{
			$this->session->set_flashdata('error_message', 'Invalid request to update withdraws limits.');
			redirect('withdraws/withdraw_limits');
		}
	}

	public function delete($withdraw_id='')
    {
    	if($this->session->userdata("role")=="admin"){
    		$this->session->set_flashdata('error_message', 'Admin does not have authority to delete withdraw request.');
			redirect("Withdraws/");
		}

        if (isset($withdraw_id) && !empty($withdraw_id)) {
        	$where = "withdraw_id = '".$withdraw_id."' AND withdraw_status = '0'";
            $result = $this->withdraws->get_where('*', $where, true, '', '', '');
            if(!empty($result)){
                $this->withdraws->delete_by('withdraw_id', $withdraw_id);
                $this->session->set_flashdata('success_message', 'Withdraw request has been deleted successfully.');
            }
            else{
            	$this->session->set_flashdata('error_message', 'Invalid request to delete withdraw request.');
            }
            redirect('withdraws/');
        } 
        else{
            $this->session->set_flashdata('error_message', 'Invalid request to delete withdraw request.');
            redirect('withdraws/');
        }  
    }

	
}