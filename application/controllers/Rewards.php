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

class Rewards extends CI_Controller
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
		$this->selected_tab = "rewards";
		if (!$this->session->userdata("role")) {
			redirect("user/UserDashboard");
		}
		$this->load->model('Rewards_model', 'rewards');
		$this->load->model('User_rewards_model', 'user_rewards');

		date_default_timezone_set("America/Los_Angeles");
        
	}
	
	/** 
	* Controller Function to List All Admins
	* 
	* @access public 
	*/
	public function index()
	{
		if ($this->session->userdata("role")=="user") {
			redirect("user/UserDashboard"); exit;
		}

		$where = "reward_id > 0";
        $data['rewards'] = $this->rewards->get_where('*', $where, true, '' , '', '');
        //debug($data['rewards'],true);
	  	$this->load->view("rewards/index",$data);
	}
	
	/** 
	* Controller Function to Add Admins
	* 
	* @access public 
	*/
	public function add()
	{
		if ($this->session->userdata("role")=="user") {
			redirect("user/UserDashboard"); exit;
		}

		$this->load->view("rewards/add");
	}
	
	/** 
	* Controller Function to Process Add Admins
	* 
	* @access public 
	*/

	public function process_add()
	{
		if ($this->session->userdata("role")=="user") {
			redirect("user/UserDashboard"); exit;
		}

		$data = array();
		if($this->input->post())
		{
			$this->form_validation->set_rules('reward_right_investment', 'Right Investment', 'required|trim|numeric');
			$this->form_validation->set_rules('reward_left_investment', 'Left Investment', 'required|trim|numeric');
			$this->form_validation->set_rules('reward_title', 'Reward Title', 'required|trim');
			if($this->form_validation->run() === TRUE)
			{
			    $data = $this->input->post(); 

				if(isset($_FILES['reward_pic']['tmp_name']) && !empty($_FILES['reward_pic']['name'])){
	                     
	                $config['upload_path']   = BASEPATH.'../assets/reward_images/';
	                $config['allowed_types'] = 'jpeg|jpg|png'; 
	                $config['max_size']      = 140000; 
	                $config['max_width']     = 4000;
	                $config['max_height']    = 4000;  
	                $this->load->library('upload',$config);
	                $this->load->initialize($config);

	                if(!$this->upload->do_upload('reward_pic')){
	                	$error_message = $this->upload->display_errors();
	                    $this->session->set_flashdata('error_message',$error_message);
	                    redirect('rewards/add/');
	                }
	                else{
	                    $uploaded_image = $this->upload->data();
	                    $data['reward_pic'] = $uploaded_image['file_name'];
	                }
	            }

			  //debug($data,true);
			  if($reward_id = $this->rewards->save($data))
			  {
                $this->session->set_flashdata('success_message', 'Reward has been saved successfully.');
                redirect('rewards/index'); 
			  }
			}
			else{
				$this->load->view("rewards/add",$data);
			}
		}
		else{
			$this->session->set_flashdata('error_message', 'Error occured while saving reward.');
			redirect('rewards/index');
		}
	}

	public function update($reward_id='')
	{
		$data = array();
		if(isset($reward_id) && !empty($reward_id))
		{
			$reward = $this->rewards->get_by('reward_id', $reward_id);
			if(isset($reward) && !empty($reward))
			{
				$data['data'] = $reward[0];
				$this->load->view('rewards/update', $data);
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Reward not found.');
				redirect('rewards/index/');
			}
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Invalid request to update reward.');
			redirect('rewards/index/');
		}	
	}

	public function process_update()
	{
		$data = array();
		
		if($this->input->post('reward_id'))
		{
			$this->form_validation->set_rules('reward_id', '', 'required');
			$this->form_validation->set_rules('reward_right_investment', 'Right Investment', 'required|trim|numeric');
			$this->form_validation->set_rules('reward_left_investment', 'Left Investment', 'required|trim|numeric');
			$this->form_validation->set_rules('reward_title', 'Reward Title', 'required|trim');
			if($this->form_validation->run() === TRUE)
			{
				$reward_id = $this->input->post('reward_id');
				$data = $this->input->post();
				unset($data['reward_id']);

				if(isset($_FILES['reward_pic']['tmp_name']) && !empty($_FILES['reward_pic']['name'])){
	                     
	                $config['upload_path']   = BASEPATH.'../assets/reward_images/';
	                $config['allowed_types'] = 'jpeg|jpg|png'; 
	                $config['max_size']      = 140000; 
	                $config['max_width']     = 4000;
	                $config['max_height']    = 4000;  
	                $this->load->library('upload',$config);
	                $this->load->initialize($config);

	                if(!$this->upload->do_upload('reward_pic')){
	                	$error_message = $this->upload->display_errors();
	                    $this->session->set_flashdata('error_message',$error_message);
	                    redirect('rewards/update/'.$reward_id);
	                }
	                else{
	                    $uploaded_image = $this->upload->data();
	                    $data['reward_pic'] = $uploaded_image['file_name'];
	                }
	            }

				//debug($data,true);
                  
                if( $reward_id = $this->rewards->update_by('reward_id', $reward_id, $data) )
				{
					$this->session->set_flashdata('success_message', 'Reward has been updated successfully.');
					redirect('rewards/index');
				}
				else
				{
					$this->session->set_flashdata('error_message', 'Error occured while updating reward.');
					redirect('rewards/index');
				}
			}
			else{
				$this->load->view('rewards/update');
			}
		}
		else{
			$this->session->set_flashdata('error_message', 'Invalid request to update reward.');
			redirect('rewards/index');
		}
	}
    
	public function delete($reward_id)
    {
        if (isset($reward_id) && !empty($reward_id)) {
            
            $where = "ur_reward_id = '".$reward_id."'";
        	$rows = $this->user_rewards->count_rows($where);
        	if($rows>0){
        		$this->session->set_flashdata('error_message', 'This reward is awarded to users. So it cannot be delete.');
        		redirect('rewards/'); exit;
        	}

            $this->rewards->delete_by('reward_id', $reward_id);
            $this->session->set_flashdata('success_message', 'Reward has been deleted successfully.');
        } else {
            $this->session->set_flashdata('error_message', 'Invalid request to delete Reward.');
        }
        redirect('rewards/');
    }
	
}