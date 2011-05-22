<?php

class Books extends CI_Controller
{
	function __construct()
	{
	  parent::__construct();
		$this->is_logged_in();
	}

  
  public function get_books_listing()
  {
    $result = $this->books_model->get_books_json();
    echo $result;     
  
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
}


?>
