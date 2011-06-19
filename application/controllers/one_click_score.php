<?php

class One_Click_Score extends CI_Controller
{
  function report($userid, $cookie, $count)
  {
    if (false == $this->membership_model->validate_user_id($userid))
    {
      echo "Invalid userid";
      return;
    } 
    
    if (false == $this->users_data_model->validate_cookie($userid, $cookie))
    {
      echo "Invalid cookie";
      return;
    }  
    $cid = $this->events_model->get_current_event_id();
    $tday = date('Y-m-d');
    $bid = $this->books_model->get_book_id('Other');
    
   // $this->add_score($cid, $userid, $bid, $this->input->post('count'), $tday)); 
    $num = $this->scores_model->get_total_books_distributed_by_user_and_eventid($userid, $cid);
    
    if ($num == 0)
    {
      $this->scores_model->add_score($cid, $userid, $bid, $count, $tday);
      echo "You are counted";
    }
    else
      echo "You are already counted"; 
  
  }
  
  function send_one_click_report_button()
  {
  
  }


}