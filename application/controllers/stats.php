<?php

class Stats extends CI_Controller
{
  function get_total_num_users()
  {
     echo $this->membership_model->get_total_num_users();
  }
  
  function  get_total_registered_today()
  {
      echo $this->membership_model->get_total_registered_today();
  }

  function  get_total_registered_last_week()
  {
      echo $this->membership_model->get_total_registered_last_week();
  }
  
  

  function get_total_book_distributors_all()
  {
     echo $this->membership_model->get_total_book_distributors_all();
  }


}	
	
	