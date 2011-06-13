<?php

class Unsubscription extends CI_Controller
{

   function ok($userid)
   {
      $result =  $this->users_data_model->update_field($userid, 6, 0);
      echo "You have been successfully unsubscribed from MSF News Subscription. Thank you.";  
   }
   
   function unsubscribe($userid)
   {  
     $username = $this->membership_model->get_user_name_by_id($userid);
     if ($username == "")
     {
       echo "User ID not found in the database. Please contact us at admin@7thgoswami.com.";
       return;
     }
     $data['userid'] = $userid;
     $data['username'] = $username;
     $this->load->view('unsubscribe_form', $data);     
   }          


}	
	
	