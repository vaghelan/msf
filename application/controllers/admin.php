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

  function update_email($userid, $username, $domain)
  {
   if (false == $this->membership_model->validate_user_id($userid))
    {
      echo "Invalid userid";
      return;
    } 
    
    $email = $username . "@" . $domain;
  
    $this->membership_model->update_email($userid, $email);  
    
    $user_info = $this->membership_model->get_user_details_by_id($userid);
    
    echo "Name: " . $user_info->name . "<br>";
    echo "Email_address : " . $user_info->email_address . "<br>";
    echo "Username :" . $user_info->username . "<br>";

    
    echo "done";
    
  
  }
    

  function delete_member_range($from, $to)
  {
    for ($i = $from; $i <= $to; $i++ )
    { 
     if ( $this->session->userdata('user_id') == $i)
     {
       echo "Permission Denied. You can not delete your own id.<br>";
       continue;
     }

  
     $this->membership_model->delete_member($i);
    }  
  }
  
  function find_duplicates()
  {
    $result = $this->membership_model->get_duplicates();
    echo "Start ...." . "<br>";
    
    foreach ($result as $row)
    {
      echo "Name: " . $row->name . "<br>";
    
    } 
    echo "End...." . "<br>";
  
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
    
    $data['user_recs'] = $this->membership_model->get_user_information_dump_orderby_score('id');
    $this->load->view('admin_user_info', $data);
  
  }
  
 function print_user_records_csv()
  {
    
    $data['user_recs'] = $this->membership_model->get_user_information_dump_orderby_score('my_score');
    $this->load->view('admin_user_info_csv', $data);
  
  } 
  
 function print_user_records_table_by_name()
  {
    
    $data['user_recs'] = $this->membership_model->get_user_information_dump_orderby_score('name');
    $this->load->view('admin_user_info', $data);
  
  }
  
 function print_user_records_table_by_username()
  {
    
    $data['user_recs'] = $this->membership_model->get_user_information_dump_orderby_score('username');
    $this->load->view('admin_user_info', $data);
  
  }  

 function print_user_records_table_by_email()
  {
    
    $data['user_recs'] = $this->membership_model->get_user_information_dump_orderby_score('email_address');
    $this->load->view('admin_user_info', $data);
  
  }  

 function print_user_records_table_by_id()
  {
    
    $data['user_recs'] = $this->membership_model->get_user_information_dump_orderby_score('id');
    $this->load->view('admin_user_info', $data);
  
  }  

 function print_user_records_table_by_score()
  {
    
    $data['user_recs'] = $this->membership_model->get_user_information_dump_orderby_score('my_score');
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
  
  function populate_subscribe_option()
  {
   $this->users_data_model->populate_subscribe_option();
  }
  
  
  
  function load_members()
  {
  
  $fp = fopen('/home1/virtualt/public_html/nilesh/sunday.csv','r') or die("can't open file");

$count = 0;
$num_columns = 0;
$imported = 0;
while($csv_line = fgetcsv($fp,1024)) {
    $count++;
    
    if ($count == 1)
    {

       for ($i = 0, $j = count($csv_line); $i < $j; $i++) {
        $num_columns++;
        echo $csv_line[$i] . " ";
       }   
          
       continue;
    }                
    
    echo '<br>';
    echo "processing record " . $count . "<br>";
    if (count($csv_line) != $num_columns)
    {
      print $csv_line . 'Skip this record not enough columns ' . count($csv_line) . ' Line = ' . $count . "<br>";
      continue;
    } 
        //$seq = $csv_line[0];
        //if ($seq == "")
        //  continue;
        $name = ltrim(rtrim($csv_line[0]));
        //$lastname = $csv_line[2];
        
        //$name = $firstname . " " . $lastname;
        $email =  strtolower(rtrim(ltrim($csv_line[1])));
        $split_email = explode('@', $email);
        $username = strtolower($split_email[0]);
         
        $rid = rtrim(ltrim($csv_line[2]));
        $num_books = rtrim(ltrim($csv_line[3]));
         
        $id = 0;
        $username1 = $username;
        while (! $this->membership_model->is_unique_username($username))
        {
          $username = $username1 . "_" . $id;
          $id++;
        }
        $pwd = 'krishna';
        echo "rid = " . $rid . " name = " . $name . " email = " . $email . " username = " . $username ."<br>";
        $this->membership_model->create_member_load($rid, $name, $email, $username, $pwd);
        $user_info = $this->membership_model->get_user_details_by_name($username);
        echo "Imported " .  $user_info->name . " " . $user_info->username . "<br>";
        $this->email_model->send_signup_email($email, $name, $username, $pwd); 
        if ($num_books)
        {
          
          $evid = $this->events_model->get_current_event_id();
          $tday = date("Y-m-d");
          $bid = $this->books_model->get_book_id('Other');
          $this->scores_model->add_score($evid, $user_info->id, $bid, $num_books, $tday);          
        }        
        $imported++;
   
}

echo "Total number of records imported " . $imported . "<br>";

 
fclose($fp) or die("can't close file");
  
  }


  function delete_members()
  {
  
  $fp = fopen('/home1/virtualt/public_html/nilesh/delete.csv','r') or die("can't open file");

$count = 0;
$num_columns = 0;
$deleted = 0;

while($csv_line = fgetcsv($fp,1024)) {
    $count++;
    
    if ($count == 1)
    {

        continue;
    }                
    
    echo '<br>';
    echo "processing record " . $count . "<br>";
        $id = rtrim(ltrim($csv_line[0]));
        
        $this->membership_model->delete_member($id);
        
        $deleted++;
   
}

echo "Total number of records deleted " . $deleted . "<br>";

 
fclose($fp) or die("can't close file");
  
  }

  function add_score($userid, $score)
  {
 
       if (false == $this->membership_model->validate_user_id($userid))
      {
        echo "ERROR : Invalid user id " . $userid . "<br>";
        return;
      
      }
 
  
  
      $evid = $this->events_model->get_current_event_id();
      $tday = date("Y-m-d");
      $bid = $this->books_model->get_book_id('Other');
      $this->scores_model->add_score($evid, $userid, $bid, $score, $tday);
      echo "Added score for userid = " . $userid . "  score = " . $score . "<br>";          
  
  }


  function add_score_bulk()
  {
  
  $fp = fopen('/home1/virtualt/public_html/nilesh/banglore_add.csv','r') or die("can't open file");

  $count = 0;
  $num_columns = 0;
  $added = 0;

   while($csv_line = fgetcsv($fp,1024)) 
   {
    $count++;
    
    if ($count == 1)
    {

        continue;
    }                
    
    echo '<br>';
    echo "processing record " . $count . "<br>";
        $id = rtrim(ltrim($csv_line[0]));
        $score = rtrim(ltrim($csv_line[4]));
        if (false == $this->membership_model->validate_user_id($id))
        {
          echo "ERROR : Invalid user id " . $id . "<br>";
          echo "ERROR : SKIPPING THIS LINE" . "<br>";
          continue;
        
        }
        
     
        
       $this->add_score($id, $score);
        
        $added++;
   
   }

echo "Total number of records processed " . $added . "<br>";

 
fclose($fp) or die("can't close file");
  
  }


  function fill_stats()
  {
    $num_registered = $this->membership_model->get_total_num_users();
    $num_last_week = $this->membership_model->get_total_registered_last_week();
    $today_reg = $this->membership_model->get_total_registered_today();
    $num_book_distributors = $this->membership_model->get_total_book_distributors_all();
    $total_books = $this->membership_model->get_total_books_distributed();
    
    $this->stats_model->set_current_stats($num_registered, $num_book_distributors, $total_books, $num_last_week, $today_reg);
    
  
  }



}