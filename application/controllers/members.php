<?php

class Members extends CI_Controller
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
  
  function save_password_ajax()
  {
   $result = $this->membership_model->update_member_password($this->session->userdata('user_id'), $this->input->post('new_password'));
   // parse_str($_SERVER['QUERY_STRING'], $_GET);
   //$str = $this->input->post('new_password');
   //echo $str;
   // echo $_GET['new_password'];
   echo "Password Saved";   
  }
  
 
  function save_address_ajax()
  {
   $result = $this->membership_model->update_member_address(
       $this->session->userdata('user_id'), 
       $this->input->post('street1'),
       $this->input->post('street2'),
       $this->input->post('city'),
       $this->input->post('state'),
       $this->input->post('country'),
       $this->input->post('zip'),
       $this->input->post('residential_phone'),
       $this->input->post('business_phone')
       
       );

   echo "Address Saved Successfully";   
  } 

  function save_name_ajax()
  {
   $result = $this->membership_model->update_member_name($this->session->userdata('user_id'), $this->input->post('name'));
   // parse_str($_SERVER['QUERY_STRING'], $_GET);
   //$str = $this->input->post('new_password');
   //echo $str;
   // echo $_GET['new_password'];
   echo "Name Saved";   
  } 
  
  
  function get_total_book_distributors_by_event()
  {
     echo $this->membership_model->get_total_book_distributors_by_event($this->session->userdata('user_id'), $this->session->userdata('current_event_id'));
  }
  
  function print_user_records()
  {
    $user_recs = $this->membership_model->get_user_information_dump();
    foreach ($user_recs as $row)
    {
      echo $row['name'];
      echo ",";
      echo $row['email_address'];
      echo "<br>";
    }
  
  
  }



	
}	