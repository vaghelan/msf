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
    $user_info = $this->membership_model->get_user_details_by_id($userid);
    $data['url'] = $userid . "/" . $cookie . "/" . $count;
    
    $data['name'] = $user_info->name;
    
   // echo "Username = " .  $user_info->name;
    
    $this->load->view('one_click_report_init', $data);
    
              
    
  
  }

  function report_confirm($userid, $cookie, $count)
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
     
    $data['num'] = $result = $this->scores_model->get_total_books_distributed_by_user_and_eventid($userid, $cid);
    if ($result == 0)
    {
      $this->scores_model->add_score($cid, $userid, $bid, $count, $tday);
    }
    $this->load->view('one_click_report_view', $data);
  }
  
  function send_one_click_report_button()
  {
  
  }


}