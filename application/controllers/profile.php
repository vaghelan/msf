<?php

class Profile extends CI_Controller
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
//   $this->load->view('includes/headers-1', $data);
   $this->load->view($form, $data);
   $this->load->view('includes/footer');  
  }
	
	function index()
	{
	  $data['userdata'] = $this->membership_model->get_user_details_by_id($this->session->userdata('user_id'));
    $data['addrinfo'] = $this->membership_model->get_user_address_by_id($this->session->userdata('user_id'));
    $data['subscribe_info'] = $this->users_data_model->get_subscribe_option_by_id($this->session->userdata('user_id'));   
    $data['sub_prompt'] = $this->users_data_model->get_subscribe_prompt();
    $data['current_event'] = $this->events_model->get_current_event(); 
    $data['rank'] = $this->ranks_model->get_current_rank_description($this->session->userdata('user_id'));
    $this->loadView('profile_form', $data);    
  }

}