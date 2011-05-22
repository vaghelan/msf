<?php


class Load_Subs_model extends CI_Model {
    private $subs_db;
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->subs_db = $this->load->database('subs_db', TRUE);
        
    }
    
    function send_email()
    {
      $this->db->select('id, username, name, email_address, subscription_id');
      $this->db->where('subscription_id != 0');
      $this->db->order_by("id"); 
      $q = $this->db->get('users');    
      $cnt = 0;
      $from = 148;
      $to = 176;
      
      echo "num rows = " . $q->num_rows() . "</br>";
      foreach ($q->result() as $row)
      {
        $subs_id = $row->subscription_id;
        $username = $row->username;
        $name = $row->name;
        $email = $row->email_address;
        $userid = $row->id;
        
        $this->db->where('user_id', $userid);
        $this->db->where('field_id', 5);
        $q1 = $this->db->get('users_data');
        $subs_info = $q1->row();
        $subs_password = $subs_info->value;
        
        $cnt++;
        if ($cnt >= $from && $cnt <= $to)  
        //if ($name == 'dims')
        {
        //log_message('info', $cnt--$name--       --$username---         --$subs_password--            --$email---  </br>";
         echo "$cnt--$name--       --$username---         --$subs_password--            --$email---  </br>";  
        //  if (!$this->email->send())
          //   log_message('debug', "Could not send signup email to  " . $to . " " . $name . " ". $username);
          //else
            // log_message('debug', "Successfully Sent signup email to  " . $to . " " . $name . " ". $username);

         $this->email_model->send_signup_email($email, $name, $username, $subs_password);
          //$this->email_model->send_signup_email('vaghelan@gmail.com', $name, $username, $subs_password);
          //echo "sent email </br>";
        }
        if ($cnt > $to)
          break;
        
      
      }
      
    
    
    }
    
    function getData()
    {
      $this->subs_db->select("*, inet_ntoa(ip) as ip_address");
      $q = $this->subs_db->get('pommo_subscribers');
      log_message('debug', "result = " . $q->num_rows() . "\n");
      $count = 0;
      foreach ($q->result() as $row)
      {
         $subs_id = $row->subscriber_id;
         $email = $row->email;
         $email_split = explode("@",$email);
         $username = $email_split[0];
         $time_registered =  $row->time_registered;
         $ip = $row->ip;
         
         $this->subs_db->where('subscriber_id', $row->subscriber_id );
         $fields = array(1, 2, 3, 5, 6, 7, 8);
         $this->subs_db->where_in('field_id', $fields );
         $q1 =  $this->subs_db->get('pommo_subscriber_data');   
         log_message('debug', $this->subs_db->last_query());

           $name ="";
           $phone = "";
           $address = "";
           $q1_value = "";
           $q2_value = "";
           $q3_value = "";
           $q4_value = "";
           
           
        //echo "</br> </br> ";  

         foreach ($q1->result() as $data)
         {
           
           if ($data->field_id == 1)
              $name = $data->value;
 
           if ($data->field_id == 2)
              $phone = $data->value;

           if ($data->field_id == 3)
              $address = $data->value;
              
           if ($data->field_id == 5)
              $q1_value = $data->value;
 
           if ($data->field_id == 6)
              $q2_value = $data->value;
 
           if ($data->field_id == 7)
              $q3_value = $data->value;
 
           if ($data->field_id == 8)
              $q4_value = $data->value;   
   
         
         } 
         $password =  $this->membership_model->generate_password(8);
         log_message('debug', "username =". $username . "   ");
         log_message('debug', "password = " . $password . "  ");
         log_message('debug', "subs_id = " . $subs_id . "   ");
         log_message('debug', "email= " . $email . "   ");
         log_message('debug', "time_registered = " . $time_registered . "   ");
         log_message('debug', "name = ". $name . "   ");
         log_message('debug', "phone = ". $phone . "   ");
         log_message('debug', "address = ". $address . "   ");
         log_message('debug', "ip = ". $ip . "   ");
         log_message('debug', "q1 = ". $q1_value . "   ");
         log_message('debug', "q2 = ". $q2_value . "   ");
         log_message('debug', "q3 = ". $q3_value . "   ");
         log_message('debug', "q4 = ". $q4_value . "   \n\n");
         
         $userid = $this->membership_model->get_user_id_by_subscription_id($subs_id);
         
         if ($userid != "")
         {
           log_message('debug', "Already present \n");
           continue;
         }
         
         $import = array(                                                           
             	 	
              'recruiter_id'         => 0, 	
              'username' 	           => $username,
              'password' 	           => md5($password),
              'name' 	               => $name,
              'email_address' 	     => $email,
              'rank_id' 	           => 0,
              'my_score' 	           =>  0,
              'my_team_score' 	     =>  0,
              'my_team_members' 	   =>  0,
              'change_password_prompt' =>	 1,
              'residential_phone' 	   =>  $phone,
              'business_phone' 	       =>  '',
              'ip_address' 	           => $ip, 
              'skype_id' 	             => '',
              'facebook_id' 	        =>  '',
              'icq_id' 	              =>  '',
              'timestamp_registered' 	=>  $time_registered,
              'subscription_id' 	    =>  $subs_id,
              'subscription_status'   =>  2,   
                     
                     );
         $result = $this->db->insert('users', $import);
         if ($result)
           log_message('debug', "Row inserted........\n");
         else
           log_message('debug', "Row failed to insert........\n") ;           
         //echo "</br> </br> </br> </br> ";
                
         $userid = $this->membership_model->get_user_id_by_subscription_id($subs_id);
         
         if ($q1_value != "")
         {
           $data = array('user_id' => $userid, 'field_id' => 1, 'value' => $q1_value);
           $result = $this->db->insert('users_data', $data);
           if ($result)
             log_message('debug', "users data Row inserted q1........\n") ;
           else
             log_message('debug', "users data Row failed to insert q1........\n");        
         
         }
         
          if ($q2_value != "")
         {
           $data = array('user_id' => $userid, 'field_id' => 2, 'value' => $q2_value);
           $result = $this->db->insert('users_data', $data);
           if ($result)
             log_message('debug', "users data Row inserted q2........\n");
           else
             log_message('debug', "users data Row failed to insert q2........\n");        
         
         }
         
         if ($q3_value != "")
         {
           $data = array('user_id' => $userid, 'field_id' => 3, 'value' => $q3_value);
           $result = $this->db->insert('users_data', $data);
           if ($result)
             log_message('debug', "users data Row inserted q3........\n") ;
           else
             log_message('debug', "users data Row failed to insert q3........\n");        
         
         }
         
         if ($q4_value != "")
         {
           $data = array('user_id' => $userid, 'field_id' => 4, 'value' => $q4_value);
           $result = $this->db->insert('users_data', $data);
           if ($result)
             log_message('debug',  "users data Row inserted q4........\n") ;
           else
             log_message('debug', "users data Row failed to insert q4........\n");        
         
         }
         
           $data = array('user_id' => $userid, 'field_id' => 5, 'value' => $password);
           $result = $this->db->insert('users_data', $data);
           if ($result)
             log_message ('debug' , "users data Row inserted password........\n") ;
           else
             log_message('debug', "users data Row failed to insert password........\n");    

         
         $count ++;
         log_message('debug', "\n\n\n");
         //if ($count == 50) break;
      }
    }


}

