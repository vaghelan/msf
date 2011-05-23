<?php

class Invite extends CI_Controller
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
  
  function generate_invite()
  {
   //$this->is_logged_in();
   $data['recruit_id'] =  $this->session->userdata('user_id');
   $this->loadView('invite_form', $data);   
 }

  function index()
  {
    log_message('debug', "email list = " . $this->input->post('email_list'));
    $email_list = $this->input->post('email_list');
    $emails = explode(",", $email_list);
    $message = $this->input->post('message');
    
    
    $user_info = $this->membership_model->get_user_details_by_id($this->session->userdata('user_id'));
    
  //  $invite_link = base_url() . 'index.php/login/signup/' . $this->session->userdata('user_id');
    $invite_link = 'http://www.7thgoswami.com/account?url=' . $this->session->userdata('user_id');
    foreach ($emails as $email)
    {
       $this->email_model->send_invite_email($email, $user_info->name, $invite_link, $message);
       
    }
    $data['userdata'] = $this->membership_model->get_user_details_by_name($this->session->userdata('username'));   
    $data['current_event'] = $this->events_model->get_current_event(); 
    $data['recruit_id'] =  $this->session->userdata('user_id');
    $this->loadView('teams_form', $data);
    
  
  }
  
  
  
  function send_invite_ajax()
  {
    log_message('debug', "email list = " . $this->input->post('email_list'));
    $email_list = $this->input->post('email_list');
    $emails = explode(",", $email_list);
    $user_info = $this->membership_model->get_user_details_by_id($this->session->userdata('user_id'));
    $message = $this->input->post('message');
    
  //  $invite_link = base_url() . 'index.php/login/signup/' . $this->session->userdata('user_id');
    $invite_link = 'http://www.7thgoswami.com/account?url=' . $this->session->userdata('user_id');
    foreach ($emails as $email)
    {
       $result = $this->email_model->send_invite_email($email, $user_info->name, $invite_link, $message);
       if ($result == 0)
       {
         //echo "Error: Failed to send invite to : " . $email . "Please send email to ISV technical support ";
         echo 0;
       }
       
    }
    echo 1;
    // echo "Your friends invited!!";    
  
  }
}
  