<?php

class Unsubscription extends CI_Controller
{

   function ok($userid)
   {
      $result =  $this->users_data_model->update_field($userid, 6, 0);
      $this->load->view('unsubscribe_done', "");
        
   }
   
   function unsubscribe($userid)
   {  
     $username = $this->membership_model->get_user_name_by_id($userid);
     if ($username == "")
     {
       echo "User ID not found in the database. Please contact us at admin@7thgoswami.com.";
       return;
     }
     $user_info = $this->membership_model->get_user_details_by_id($userid);
     
     $data['userid'] = $userid;
     $data['username'] = $username;
     $data['name'] = $user_info->name;
     $this->load->view('unsubscribe_form', $data);     
   }          


}	
	
	