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

class News extends CI_Controller
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
		$this->selected_tab = "news";
		$this->load->model('News_model', 'news');

		if(!$this->session->userdata('id')){
			redirect('user/UserDashboard');
		}

		if($this->session->userdata('role') == "admin"){
			$this->layout = "admin";
		}

		date_default_timezone_set("America/Los_Angeles");
	}
	
	/** 
	* Controller Function to List All Admins
	* 
	* @access public 
	*/
	
	/** 
	* Controller Function to Add Admins
	* 
	* @access public 
	*/
	public function index()
	{
		if($this->session->userdata('role')=="user"){
			redirect('user/user_dashboard'); exit;
		}

		$data = array();
		$data['news'] = $this->news->get_all('','', 'news_id', 'DESC' ,'','');
		$this->load->view("news/index",$data);
		
	}

	public function user_index()
	{
		if($this->session->userdata('role')=="admin"){
			redirect('user/admin_dashboard'); exit;
		}

		$data = array();
		$data['news'] = $this->news->get_all('','', 'news_id', 'DESC' ,'','');
		$this->load->view("news/user_index",$data);
		
	}
	
	public function add()
	{
		if($this->session->userdata('role')=="user"){
			redirect('user/user_dashboard'); exit;
		}
		$this->load->view('news/add');
		
	}

	public function process_add()
	{
		if ($this->session->userdata("role")=="user") {
			redirect("user/UserDashboard"); exit;
		}

		$data = array();
		if($this->input->post())
		{
			$this->form_validation->set_rules('news_title', 'News Title', 'required|trim');
			$this->form_validation->set_rules('news_des', 'News Description', 'required|trim');
			if($this->form_validation->run() === TRUE)
			{
			    $data = $this->input->post();

			    if(isset($_FILES['news_pic']['tmp_name']) && !empty($_FILES['news_pic']['name'])){
	                     
	                $config['upload_path']   = BASEPATH.'../assets/news_images/';
	                $config['allowed_types'] = 'jpeg|jpg|png'; 
	                $config['max_size']      = 140000; 
	                $config['max_width']     = 4000;
	                $config['max_height']    = 4000;  
	                $this->load->library('upload',$config);
	                $this->load->initialize($config);

	                if(!$this->upload->do_upload('news_pic')){
	                	$error_message = $this->upload->display_errors();
	                    $this->session->set_flashdata('error_message',$error_message);
	                    redirect('news/add/');
	                }
	                else{
	                    $uploaded_image = $this->upload->data();
	                    $data['news_pic'] = $uploaded_image['file_name'];
	                }
	            }

			    //debug($data,true);
			    if($news_id = $this->news->save($data))
			    {
                    $this->session->set_flashdata('success_message', 'News has been saved successfully.');
                    redirect('news/index'); 
			    }
			}
			else{
				$this->load->view("news/add",$data);
			}
		}
		else{
			$this->session->set_flashdata('error_message', 'Error occured while saving news.');
			redirect('news/index');
		}
	}

    public function update($news_id)
    {
    	if ($this->session->userdata("role")=="user") {
			redirect("user/UserDashboard"); exit;
		}

    	$data = array();
        
        $data['news_id'] = $news_id;
        if (isset($news_id) && !empty($news_id)) {
            $news = $this->news->get_by('news_id', $news_id);
            if (isset($news) && !empty($news)) {
                $data['data'] = $news[0];
                
  				$this->load->view('news/update',$data);

            } else {
                $this->session->set_flashdata('error_message', 'News not found.');
                redirect('News');
            }
        } else {
            $this->session->set_flashdata('error_message', 'Invalid request to update News.');
            redirect('News');
        }
    }

	public function process_update()
	{
		$data = array();
		$news_id = $this->input->post('news_id');

		if($this->input->post())
		{
			$this->form_validation->set_rules('news_id', '', 'required');
			$this->form_validation->set_rules('news_title', 'Title', 'required');
			$this->form_validation->set_rules('news_des', 'Description', 'required');
			if($this->form_validation->run() !== FALSE)
			{
				$data = $this->input->post();
                
                date_default_timezone_set('Asia/karachi');
				$now = date('h:i:s');
				$time = $this->input->post('news_created_date');
				$cur = date('y-m-d');
				$curr = $cur . " " . $now;
				$date = $time?$time." ".$now:$curr;
                $data['news_created_date'] = $date ;

                if(isset($_FILES['news_pic']['tmp_name']) && !empty($_FILES['news_pic']['name'])){
	                     
	                $config['upload_path']   = BASEPATH.'../assets/news_images/';
	                $config['allowed_types'] = 'jpeg|jpg|png'; 
	                $config['max_size']      = 140000; 
	                $config['max_width']     = 4000;
	                $config['max_height']    = 4000;  
	                $this->load->library('upload',$config);
	                $this->load->initialize($config);

	                if(!$this->upload->do_upload('news_pic')){
	                	$error_message = $this->upload->display_errors();
	                    $this->session->set_flashdata('error_message',$error_message);
	                    redirect('news/add/');
	                }
	                else{
	                    $uploaded_image = $this->upload->data();
	                    $data['news_pic'] = $uploaded_image['file_name'];
	                }
	            }

				//debug($data,true);

                if( $news_id = $this->news->update_by('news_id', $news_id, $data) )
				{
					$this->session->set_flashdata('success_message', 'News has been updated successfully.');
					redirect('News');
				}
				else
				{
					$this->session->set_flashdata('error_message', 'Error occured while updating news.');
					redirect('News');
				}
			}
			else{
				$news = $this->news->get_by('news_id', $news_id);
                $data['data'] = $news[0];
                $this->load->view("news/update",$data);
			}
		}
		else{
			$this->session->set_flashdata('error_message', 'Error occured while updating news.');
			redirect('Admin/News');
		}
	}

	public function delete($news_id)
    {
        if (isset($news_id) && !empty($news_id)) {
            $this->news->delete_by('news_id', $news_id);

            $this->session->set_flashdata('success_message', 'News has been deleted successfully.');
        } else {
            $this->session->set_flashdata('error_message', 'Invalid request to delete Package.');
        }
        redirect('News/');
    }
	
}