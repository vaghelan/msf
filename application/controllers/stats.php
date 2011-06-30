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

   function get_total_books_distributed()
  {
     echo $this->membership_model->get_total_books_distributed();
  }
  
  function  get_stats()
  {
   $result = $this->stats_model->get_current_stats();
   
//   ($stats->total_registered, $stats->total_distributors, $stats->total_books, $stats->total_registered_last_week, $stats->total_registered_today) ;
   
//   echo "<h1>" . $result[1] . "</h1> <em><b>" . $result[2] . "books distributed</em> <i> ". $result[4] . "</i><i>" . $result[3] . "last 7days</i>";
   
    echo "<h1>" . $result[1] . "</h1><em><b>". $result[2] . "</b> books distributed</em><i>" . " " . $result[4] ." registered today</i><i> ". $result[3] . " last 7days</i>";  
  
  }


}	
	
	