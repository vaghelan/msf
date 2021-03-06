<?php

class Story_Report extends CI_Controller
{

	function __construct()
	{
	  parent::__construct();
		$this->is_logged_in();
	}
	
	private function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
		  log_message('debug', "Cookie not found so redirect to login");
			redirect('login');
			die();		
		}		
	}	 
	
	private function loadView($form, $data)
  {
   $this->load->view('includes/header', $data);
  // $this->load->view('includes/headers-1', $data);
   $this->load->view($form, $data);
   $this->load->view('includes/footer');  
  }
  
  function index()
  {
    $data['userdata'] = $this->membership_model->get_user_details_by_id($this->session->userdata('user_id'));   
    $data['current_event'] = $this->events_model->get_current_event();
    $data['rank'] = $this->ranks_model->get_current_rank_description($this->session->userdata('user_id'));
    
    $this->loadView('story_report_form', $data);
  
  }
  function post_story_ajax()
  {
    
    
    $user_info = $this->membership_model->get_user_details_by_id($this->session->userdata('user_id'));   
    $this->email_model->send_story_post_email($this->input->post('name'), $this->input->post('location'), $this->input->post('subject'), $this->input->post('story'));
    echo "Your Story Posted!!";   
  
  }
  
}  

?>