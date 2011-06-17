<?php

class Membership_model extends CI_Model {

	function validate()
	{
		$this->db->where('username', strtolower($this->input->post('username')));
		$this->db->where('password', md5($this->input->post('password')));
		$query = $this->db->get('users');
		
		
		if($query->num_rows == 1)
		{
		  $user = $query->row();
			return $user->id;
		}
		return "";
	}
	
	function get_user_details_by_name($username)
	{
		$this->db->where('username', strtolower($username));
		$q = $this->db->get('users');

    if($q->num_rows == 0)
		{
			return array('');
		}
		
		foreach ($q->result() as $row) {
			    return $row;
		}
  
  }
  function get_user_name_by_id($userid)
  {

		$this->db->where('id', $userid);
		$query = $this->db->get('users');
		
		if($query->num_rows == 1)
		{
		  $user = $query->row();
			return $user->name;
		}
		return "";

  
  }
  
  function get_user_id_by_subscription_id($id)
  {

		$this->db->where('subscription_id', $id);
		$query = $this->db->get('users');
		
		
		if($query->num_rows == 1)
		{
		  $user = $query->row();
			return $user->id;
		}
		return "";

  
  }
  
  function get_user_details_by_id($userid)
	{
		$this->db->where('id', $userid);
		$q = $this->db->get('users');

    if($q->num_rows == 0)
		{
			return array('');
		}
		
    return $q->row();  
  }
  
  function validate_user_id($userid)
  {
  	$this->db->where('id', $userid);
		$q = $this->db->get('users');

    if($q->num_rows == 0)
		{
			return false;
		}
		
    return true;  
  
  
  }
  
  function get_user_address_by_id($userid)
	{
		$this->db->where('user_id', $userid);
		$this->db->where('type_id', '1');
		$q = $this->db->get('addresses');
    log_message('debug', "query = " . $this->db->last_query() . "num rows = " . $q->num_rows);
    if($q->num_rows == 0)
		{
		  $address['street1'] = '';
		  $address['street2'] = '';
		  $address['city'] = '';
		  $address['state'] = '';
		  $address['zip'] = '';
		  $address['country'] = '';		  
			return (object)$address;
		}
		
		
    return $q->row();  
  }
  
  function get_user_recruiter_id($userid)
  {
    $this->db->select('*');
		$this->db->where('id', $userid);
		$q = $this->db->get('users');

    if($q->num_rows == 0)
		{
			return -1;
		}
		$row =  $q->row();
    return  $row->recruiter_id;    
  }
  
  function get_user_recruiter_name($userid)
  {
    $rid = $this->get_user_recruiter_id($userid);
    
    $this->db->select('name');
		$this->db->where('id', $rid);
		$q = $this->db->get('users');

    if($q->num_rows == 0)
		{
			return "";
		}
		$row =  $q->row();
    return  $row->name;    
  }

  function get_total_num_users()
  {
  	$this->db->from('users');
  	return ($this->db->count_all_results());
  }

  function get_total_book_distributors_all()
  {
  
  	$this->db->where('rank_id > 0');
  	$this->db->from('users');
  	return ($this->db->count_all_results());
  }

  function get_total_registered_today()
  {
  	
  	$today = date('Y-m-d H:i:s', mktime(0, 0, 0, date("m")  , date("d"), date("Y")));

  	$this->db->where('timestamp_registered >= ' . "'" . $today . "'");
  	$this->db->from('users');
  	return ($this->db->count_all_results());
  }
  
  function get_total_registered_last_week()
  {
    $to = date('Y-m-d H:i:s', mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
    $from = date('Y-m-d H:i:s', mktime(0, 0, 0, date("m")  , date("d") - 7, date("Y")));

   	$this->db->where('timestamp_registered >= ' . "'" . $from . "'" . ' and timestamp_registered <= '. "'" . $to . "'");
  	$this->db->from('users');
  	return ($this->db->count_all_results());
  }
  
  function get_total_books_distributed()
  {
    $this->db->select_sum('my_score', 'total_score'); 
  	$query = $this->db->get('users');
  	$row = $query->row();
  	return ($row->total_score);   
  }  
  
  function get_user_information_dump_orderby_score()
  {
    $this->db->select('*');
    $this->db->order_by('my_score', 'desc'); 
  	$query = $this->db->get('users');
  	return($query->result_array());  
  
  }

  function get_user_information_dump_order_by_name()
  {
    $this->db->select('*');
    $this->db->order_by('name'); 
  	$query = $this->db->get('users');
  	return($query->result_array());  
  
  }  

  
  function get_user_team_score($userid)
  {
    $this->db->select('*');
		$this->db->where('id', $userid);
		$q = $this->db->get('users');

    if($q->num_rows == 0)
		{
			return -1;
		}
		$row =  $q->row();
    return  $row->my_team_score;    
  }
  
  function get_user_my_score($userid)
  {
    $this->db->select('*');
		$this->db->where('id', $userid);
		$q = $this->db->get('users');

    if($q->num_rows == 0)
		{
			return -1;
		}
		$row =  $q->row();
    return  $row->my_score;    
  }
  
   function get_user_num_team_members($userid)
  {
    $this->db->select('*');
		$this->db->where('id', $userid);
		$q = $this->db->get('users');

    if($q->num_rows == 0)
		{
			return -1;
		}
		$row =  $q->row();
		// log_message('debug', "Num team members = " . $row->my_team_members);
    return  $row->my_team_members;    
  }

  function is_unique_username($username)
  {
  	// If username already exists or email address already exists
	
		$this->db->where('username', strtolower($username));
		$query = $this->db->get('users');
		
		
		if($query->num_rows > 0)
    {
       return false;
    }
    return true;
    
  }
  
  function is_unique_email($str)
  {

    $this->db->where('email_address', $str);
		$query = $this->db->get('users');
		
		
		if($query->num_rows == 1)
		{
			return false;
		}
		
		return true;
  }


  function reset_password($username, $email_address)
  {

    $this->db->where('email_address', $email_address);
    if ($username != "")
      $this->db->where('username', strtolower($username));
		$query = $this->db->get('users');
		
    if($query->num_rows >= 1)
		{
		 foreach ($query->result() as $row)
		 {
		   $new_password = $this->generate_password();
       $this->update_member_password($row->id, $new_password);
       log_message('debug', "username = " . $username . "password = " . $new_password . " query = " . $this->db->last_query());
       $this->email_model->send_reset_password_email($email_address, $row->name, $row->username, $new_password);
     }
     return $query->num_rows;        
		}

		return 0;
  }


 
  function create_member($recruit_id)
	{
    	$new_member_insert_data = array(
		  'recruiter_id' => $this->input->post('recruit_id'),
			'name' => $this->input->post('name'),
			'email_address' => $this->input->post('email_address'),			
			'username' => strtolower($this->input->post('username')),
			'password' => md5($this->input->post('password')),
      'ip_address'=> 	ip2long($this->input->ip_address()),
      'timestamp_registered' => 'now()'			
		);
		
		$insert = $this->db->insert('users', $new_member_insert_data);
		$this->update_member_my_team_members($recruit_id);
		return $insert;
	}
	
	function get_recruitees_json1($userid, $start, $limit)
	{
    $this->db->where('recruiter_id', $userid);
		$q = $this->db->get('users');

    if($q->num_rows == 0)
		{
			return '({"total":"0", "results":""})';
		}
		$total_rows =  $q->num_rows;

		$sql = "select user_id AS id, name, email_address, SUM(count) AS my_count from scores, users " .
            " where scores.user_id = users.id and event_id = " . $this->session->userdata('current_event_id') . 
            " AND user_id IN (select id from users where recruiter_id = " . $userid . ") ".
            " GROUP BY user_id, name, email_address LIMIT " . $limit . " OFFSET " . $start ; 
		$q = $this->db->query($sql);
		log_message('debug', "query = " . $this->db->last_query() . "num rows = " . $q->num_rows);
		
		$arr = array();
		
		foreach ($q->result() as $row)
    {
      $temp = array();
      $temp['id'] = $row->id;
      $temp['first_name'] = $row->first_name;
      $temp['last_name'] = $row->last_name;
      $temp['email_address'] = $row->email_address;
      $temp['my_count'] = $row->my_count;
      $temp['total_count'] = $this->scores_model->get_total_books_distributed_by_user($row->id);
      $arr[] = $temp;
		}
    
    $sql = "select id, name, email_address, 0 as my_count from users where recruiter_id = " . $userid .
          " EXCEPT (select users.id , first_name, last_name, email_address, 0 as my_count from scores, users where " . 
          " scores.user_id = users.id and event_id = " . $this->session->userdata('current_event_id') . 
          " AND user_id IN (select id from users where recruiter_id = " . $userid . " ) ); ";
    $q = $this->db->query($sql);
		log_message('debug', "query = " . $this->db->last_query() . "num rows = " . $q->num_rows);

		foreach ($q->result() as $row)
    {
      $temp = array();
      $temp['id'] = $row->id;
      $temp['first_name'] = $row->first_name;
      $temp['last_name'] = $row->last_name;
      $temp['email_address'] = $row->email_address;
      $temp['my_count'] = $row->my_count;
      $temp['total_count'] = $this->scores_model->get_total_books_distributed_by_user($row->id);
      $arr[] = $temp;
		}
		
		$jsonresult = json_encode($arr);
		log_message('debug', "count = " . count($arr));
		return '({"total":"'. $total_rows .'","results":'.$jsonresult.'})';
  
  }
  
  function get_recruitees_json($userid, $start, $limit)
	{
	  $this->db->select('id');
    $this->db->where('recruiter_id', $userid);
    $this->db->where('id !=' , $userid);
    
		$q = $this->db->get('users');

    if($q->num_rows == 0)
		{
			return '({"total":"0", "results":""})';
		}
		$total_rows =   $q->num_rows;
	  $this->db->select('id, name, email_address, my_score AS my_count, my_team_score AS team_score, my_team_members AS total_members');
    $this->db->where('recruiter_id', $userid);
    $this->db->where('id !=' , $userid);
		
		$q = $this->db->get('users', $limit, $start);
		
		
		$jsonresult = json_encode($q->result());
		//log_message('debug', "count = " . count($arr));
		return '({"total":"'. $total_rows .'","results":'.$jsonresult.'})';
  
  }
  
  
  function get_team_members_id($user_id)
  {
    // get user id list
      $this->db->select('id');                    
      $this->db->where('recruiter_id', $user_id);
      $this->db->where('id !=', $user_id); 
      $q =  $this->db->get('users');
      $arr = array();
      if ($q->num_rows() == 0)
        return $arr;                                      
      log_message('debug', "query = " . $this->db->last_query());
      
      foreach ($q->result() as $row)
      {
       $arr[] = $row->id;
      }  
      return $arr;
  
  }

  function get_num_team_members($user_id)
  {
    // get user id list
      $this->db->select('id');                    
      $this->db->where('recruiter_id', $user_id);
      $this->db->where('id !=', $user_id); 
      $q =  $this->db->get('users');
      
      if ($q->num_rows() == 0)
        return 0;                                      
      log_message('debug', "query = " . $this->db->last_query());
      
      return $q->num_rows();
  
  }


  
  function get_team_members_all_fields($user_id)
  {
    // get user id list
      $this->db->select('*');                    
      $this->db->where('recruiter_id', $user_id);
      $this->db->where('id !=', $user_id); 
      $q =  $this->db->get('users');
      $arr = array();
      if ($q->num_rows() == 0)
        return $arr;                                      
      log_message('debug', "query = " . $this->db->last_query());
      
      foreach ($q->result() as $row)
      {
       $arr[] = $row;
      }  
      return $arr;
  
  }
  
  function get_all_members_id()
  {
    // get user id list
      $this->db->select('id');                    
      $q =  $this->db->get('users');
      $arr = array();
      if ($q->num_rows() == 0)
        return $arr;                                      
      log_message('debug', "query = " . $this->db->last_query());
      
      foreach ($q->result() as $row)
      {
       $arr[] = $row->id;
      }  
      return $arr;
  
  }
  
  function get_all_members_rows()
  {
    // get user id list                    
      $q =  $this->db->get('users');
      $arr = array();
      if ($q->num_rows() == 0)
        return $arr;                                      
      log_message('debug', "query = " . $this->db->last_query());
      
      foreach ($q->result() as $row)
      {
       $arr[] = $row;
      }  
      return $arr;
  
  }
  

  
  function update_member_team_score_by_change($userid, $score_change)
  {
     $score = $this->get_user_team_score($userid);
     log_message('debug', "old score = " . $score);
     
     $score = $score + $score_change;
     log_message('debug', "new score = " . $score);
     log_message('debug', "query = " . $this->db->last_query());
     
     $data = array('my_team_score' => $score);
     $this->db->where('id', $userid);
     $this->db->update('users', $data);  
     log_message('debug', "query = " . $this->db->last_query());
  }
  
  function update_member_recruiter_id($userid, $new_rid)
  {
     $data = array('recruiter_id' => $new_rid);
     $this->db->where('id', $userid);
     $this->db->update('users', $data);    
  }
  
  
  function update_member_team_score($userid, $score)
  {
     $data = array('my_team_score' => $score);
     $this->db->where('id', $userid);
     $this->db->update('users', $data);  
  }
  
  function update_member_my_score_by_change($userid, $score_change)
  {
     $score = $this->get_user_my_score($userid);
     log_message('debug', "old score = " . $score);
     
     $score = $score + $score_change;
     log_message('debug', "new score = " . $score);
     log_message('debug', "query = " . $this->db->last_query());
     
     $data = array('my_score' => $score);
     $this->db->where('id', $userid);
     $this->db->update('users', $data);  
     log_message('debug', "query = " . $this->db->last_query());
  }
  
  function update_member_my_team_members_by_change($userid, $num_change)
  {
     $num = $this->get_user_num_team_members($userid);
     log_message('debug', "num old team members = " . $num);
     
     $num = $num + $num_change;
     log_message('debug', "new num tam members = " . $num);
     log_message('debug', "query = " . $this->db->last_query());
     
     $data = array('my_team_members' => $num);
     $this->db->where('id', $userid);
     $this->db->update('users', $data);  
     log_message('debug', "query = " . $this->db->last_query());
  }
  
  function update_member_my_score($userid, $score)
  {
     $data = array('my_score' => $score);
     $this->db->where('id', $userid);
     $this->db->update('users', $data);  
  }
  
  function update_last_logged_in($userid)
  {
     $data = array('last_logged_in' => 'now()');
     $this->db->where('id', $userid);
     $this->db->update('users', $data);  
   
  }

  function update_member_my_team_members_by_num($userid, $num)
  {
     $data = array('my_team_members' => $num);
     $this->db->where('id', $userid);
     $this->db->update('users', $data);  
  }
  
  function update_member_my_team_members($userid)
  {
     $num = $this->get_num_team_members($userid);
     $this->update_member_my_team_members_by_num($userid, $num);
  }

  
  function update_member_password($userid, $new_password)
  {
     $data = array('password' => md5($new_password));
     $this->db->where('id', $userid);
     return ($this->db->update('users', $data));  
  }

  function update_member_name($userid, $name)
  {
     $data = array('name' => $name);
     $this->db->where('id', $userid);
     return ($this->db->update('users', $data));  
  }
  function update_member_address($userid, $street1, $street2, $city, $state, $zip, $country, $rs_phone, $bs_phone)
  {
  
     $this->db->where('user_id', $userid);
     $this->db->where('type_id', '1');
     
     $q = $this->db->get('addresses');
     
     if ($q->num_rows() == 0)
     {
         $data = array(
               'street1' => $street1,
               'street2' => $street2,
               'city' => $city,
               'state' => $state,
               'zip' => $zip,
               'country' => $country,
               'type_id'=> 1,
               'user_id' => $userid
               );
          $result1 = $this->db->insert('addresses', $data);
      }    
      else
      {
         $data = array(
               'street1' => $street1,
               'street2' => $street2,
               'city' => $city,
               'state' => $state,
               'zip' => $zip,
               'country' => $country
               );
      
       $this->db->where('user_id', $userid);
       $this->db->where('type_id', '1');
       
       $result1 = $this->db->update('addresses', $data);
      } 
     
     log_message('debug', "query = " . $this->db->last_query());
     
     $data = array(
            'residential_phone' => $rs_phone,
            'business_phone' => $bs_phone
             );
     $this->db->where('id', $userid);
     $result2 = $this->db->update('users', $data);
     log_message('debug', "query = " . $this->db->last_query());
     return ($result1 && $result2);             
              
  }

  function delete_user($userid)
  {
      $this->db->where('id', $userid);	
      $q =  $this->db->delete('users');	
      log_message('debug', "query = " . $this->db->last_query());
  }
  
  
  function get_current_rank_id($userid)
  {
      $this->db->select('rank_id');                    
      $this->db->where('id', $userid);
      $q =  $this->db->get('users');
      $row = $q->row();
      log_message('debug', "query = " . $this->db->last_query());
      return($row->rank_id);                     
  }
  
  function get_recruiter_id($userid)
  {
      $this->db->select('recruiter_id');                    
      $this->db->where('id', $userid);
      $q =  $this->db->get('users');
      $row = $q->row();
      return($row->recruiter_id);                     
 
  
  }
  
  function is_admin_user($userid)
  {
    return ($userid == 177 || $userid == 1); 
    //|| $userid == 283);
  
  }
  
  function generate_password($length = 8)
  {

    // start with a blank password
    $password = "";

    // define possible characters - any character in this string can be
    // picked for use in the password, so if you want to put vowels back in
    // or add special characters such as exclamation marks, this is where
    // you should do it
    $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";

    // we refer to the length of $possible a few times, so let's grab it now
    $maxlength = strlen($possible);
  
    // check for length overflow and truncate if necessary
    if ($length > $maxlength) {
      $length = $maxlength;
    }
	
    // set up a counter for how many characters are in the password so far
    $i = 0; 
    
    // add random characters to $password until $length is reached
    while ($i < $length) { 

      // pick a random character from the possible ones
      $char = substr($possible, mt_rand(0, $maxlength-1), 1);
        
      // have we already used this character in $password?
      if (!strstr($password, $char)) { 
        // no, so it's OK to add it onto the end of whatever we've already got...
        $password .= $char;
        // ... and increase the counter by one
        $i++;
      }

    }

    // done!
    return $password;

  }
  
  function move_member($userid, $to)
  {
    $parent_id = $this->get_user_recruiter_id($userid);
    if ($parent_id == -1)
    {
      echo "ID " . $userid . " is in valid" . "<br>";
      return;
    }
    
    echo "Current Parent ID = " . $parent_id . "<br>";
    
    if ($this->validate_user_id($to) == 0)
    {
      echo "Parent ID " . $to . " is in valid" . "<br>";
      return;                 
    }
    
    $personal_score = $this->get_user_my_score($userid);

    // update rank for the old parent 
    $this->update_member_my_team_members_by_change($parent_id, -1);
    // reduce parent's team score and update his rank...recursive
    $this->scores_model->update_parent($userid, -1*$personal_score);
    
    // move member
    $this->update_member_recruiter_id($userid, $to);
        
    // update rank for a new parent
    $this->update_member_my_team_members_by_change($to, 1);
    $this->scores_model->update_parent($userid, $personal_score);

    $parent_id = $this->get_user_recruiter_id($userid);
    if ($parent_id == -1)
    {
      echo "ID " . $userid . " is in valid" . "<br>";
      return;
    }
    
    echo "New Parent ID = " . $parent_id . "<br>";

    
  
  }

  function delete_member($userid)
  {
   if ($this->validate_user_id($userid) == 0)
   {
      echo "User ID " . $userid . " is in valid not found in the database" . "<br>";
      return;                 
   }

    $parent_id = $this->get_user_recruiter_id($userid);
    if ($parent_id == -1)
    {
      echo "ID " . $userid . " is in valid" . "<br>";
      return;
    }

    if ($this->get_num_team_members($userid) > 0)
    {
      echo "You can not delete this user as he has some team members. First move those members to other parent <br>";
      return;

    }
    $personal_score = $this->get_user_my_score($userid);

    // update rank for a new parent
    $this->update_member_my_team_members_by_change($parent_id, -1);
    if ($personal_score)
       $this->scores_model->update_parent($userid, -1*$personal_score);

    $this->delete_user($userid);
    echo "User ID ". $userid . " Deleted successully";
   
  }
  
  function populate_cookie()
  {
    $this->db->select('id');  
		$query = $this->db->get('users');
		
    if($query->num_rows >= 1)
		{
		 foreach ($query->result() as $row)
		 {
		   $cookie = $this->generate_password(32);
       $add_cookie_array = array(
  		  'field_id' => 7,
  			'user_id' => $row->id,
  			'value' => $cookie			
  		  );
  		  
      $this->db->where('field_id', 7);	
      $this->db->where('user_id', $row->id);
      $q =  $this->db->delete('users_data');	
  	  
  		$insert = $this->db->insert('users_data', $add_cookie_array);
      echo "$row->id " . "  " . $cookie . "<br>";		   
  
  	 }	  
		
             
		}
		return 1;
  
  
  }
  	
}
	
?>
