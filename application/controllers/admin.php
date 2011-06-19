<?php

class Admin extends CI_Controller
{
 
 function __construct()
 {
   parent::__construct();
   $this->is_logged_in();
   $this->check_admin();
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
  
  private function check_admin()
  {
    if (!$this->membership_model->is_admin_user($this->session->userdata('user_id')))
    {
      echo "Permission denied <br>";
      die();
    }	

  
  } 
	
	function update_all()
  {
    
    $this->scores_model->update_children();
    echo "done";
  }
	
	function move_member($user_id_to_move, $user_id_new_parent)
  {
     $this->membership_model->move_member($user_id_to_move, $user_id_new_parent);  
  }
  
  function delete_member($userid)
  {
     
     if ( $this->session->userdata('user_id') == $userid)
     {
       echo "Permission Denied. You can not delete your own id.<br>";
       return;
     }

  
     $this->membership_model->delete_member($userid);  
  }

  
  function print_user_records()
  {
    $user_recs = $this->membership_model->get_user_information_dump_order_by_name();
    foreach ($user_recs as $row)
    {
      echo $row['name'];
      echo ",";
      echo $row['email_address'];
      echo "<br>";
    }
  
  
  }

 function print_user_records_table()
  {
    
    $data['user_recs'] = $this->membership_model->get_user_information_dump_orderby_score();
    $this->load->view('admin_user_info', $data);
  
  }
  
  function help()
  {
    $this->load->view('help_form');
  }
  
  function populate_cookie()
  {
   $this->membership_model->populate_cookie();
  }


}