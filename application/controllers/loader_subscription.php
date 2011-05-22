<?php

class Loader_Subscription extends CI_Controller
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
	
	function load()
	{
	  $this->load->model('load_subs_model');
    $this->load_subs_model->getData();
  }

  function send_emails_to_subs()
  {
  
  	$this->load->model('load_subs_model');
    $this->load_subs_model->send_email();
  
  }  
	
}	