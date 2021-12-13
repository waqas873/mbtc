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

class Packages extends CI_Controller
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
		$this->layout = "admin";
		$this->selected_tab = "packages";
		if ($this->session->userdata("role") != "admin") {
			redirect("Login/");
		}
		$this->load->model('Packages_model', 'packages');

		date_default_timezone_set("America/Los_Angeles");
        
	}
	
	/** 
	* Controller Function to List All Admins
	* 
	* @access public 
	*/
	public function index()
	{
		$where = "package_id > 0";
        $data['packages'] = $this->packages->get_where('*', $where, true, '' , '', '');
	  	$this->load->view("packages/index",$data);
	}
	
	/** 
	* Controller Function to Add Admins
	* 
	* @access public 
	*/
	public function add()
	{
		$this->load->view("packages/add");
	}
	
	/** 
	* Controller Function to Process Add Admins
	* 
	* @access public 
	*/

	public function process_add()
	{
		$data = array();
		if($this->input->post())
		{
			$this->form_validation->set_rules('package_name', 'Package Name', 'required|trim|min_length[2]');
			$this->form_validation->set_rules('package_min_amount', 'Minimum Amount', 'required|trim|min_length[1]|numeric');
			$this->form_validation->set_rules('package_max_amount', 'Maximum Amount', 'required|trim|min_length[1]|numeric');
			//$this->form_validation->set_rules('package_fees', 'Package Fees', 'required|trim|min_length[1]|numeric');
			$this->form_validation->set_rules('package_roi', 'Package ROI', 'required|trim|min_length[1]');
			$this->form_validation->set_rules('capping', 'capping', 'required|trim|min_length[1]|numeric');
			if($this->form_validation->run() === TRUE)
			{
			  $data = $this->input->post(); 
			  //debug($data,true);
			  if($package_id = $this->packages->save($data))
			  {
                $this->session->set_flashdata('success_message', 'Package has been saved successfully.');
                redirect('packages/index'); 
			  }
			}
			else{
				$this->load->view("packages/add",$data);
			}
		}
		else{
			$this->session->set_flashdata('error_message', 'Error occured while saving package.');
			redirect('packages/index');
		}
	}

	public function update($package_id='')
	{
		$data = array();
		if(isset($package_id) && !empty($package_id))
		{
			$package = $this->packages->get_by('package_id', $package_id);
			if(isset($package) && !empty($package))
			{
				$data['data'] = $package[0];
				$this->load->view('packages/update', $data);
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Package not found.');
				redirect('packages/index/');
			}
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Invalid request to update package.');
			redirect('packages/index/');
		}	
	}

	public function process_update()
	{
		$data = array();
		
		if($this->input->post('package_id'))
		{
			$this->form_validation->set_rules('package_id', '', 'required');
			$this->form_validation->set_rules('package_name', 'Package Name', 'required|trim|min_length[2]');
			$this->form_validation->set_rules('package_min_amount', 'Minimum Amount', 'required|trim|min_length[1]|numeric');
			$this->form_validation->set_rules('package_max_amount', 'Maximum Amount', 'required|trim|min_length[1]|numeric');
			//$this->form_validation->set_rules('package_fees', 'Package Fees', 'required|trim|min_length[1]|numeric');
			$this->form_validation->set_rules('package_roi', 'Package ROI', 'required|trim|min_length[1]');
			$this->form_validation->set_rules('capping', 'capping', 'required|trim|min_length[1]|numeric');
			if($this->form_validation->run() === TRUE)
			{
				$package_id = $this->input->post('package_id');
				$data = $this->input->post();
				unset($data['package_id']);
                  
                if( $package_id = $this->packages->update_by('package_id', $package_id, $data) )
				{
					$this->session->set_flashdata('success_message', 'Package has been updated successfully.');
					redirect('packages/index');
				}
				else
				{
					$this->session->set_flashdata('error_message', 'Error occured while updating package.');
					redirect('packages/index');
				}
			}
			else{
				$this->load->view('packages/update');
			}
		}
		else{
			$this->session->set_flashdata('error_message', 'Error occured while verifiying user.');
			redirect('userauth/user_account/index');
		}
	}
    
	public function delete($package_id)
    {
        if (isset($package_id) && !empty($package_id)) {
            $this->packages->delete_by('package_id', $package_id);

            $this->session->set_flashdata('success_message', 'Package has been deleted successfully.');
        } else {
            $this->session->set_flashdata('error_message', 'Invalid request to delete Package.');
        }
        redirect('packages/');
    }

    public function get_package()
    {   
    	$this->layout = " ";
    	$data = array();
        if( $this->input->post() ){
            $where = 'package_id = "' . $this->input->post('package_id') . '"';
            $result = $this->packages->get_where('*', $where, true, '', '', '');
            debug($result,true);
            if( count($result) >= 1 ){
            	$data = $result[0];
            }
        }
        echo json_encode($data);
    }

	
}