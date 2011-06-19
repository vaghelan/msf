<?php

class Loader_Subscription extends CI_Controller
{
	function __construct()
	{
	  parent::__construct();
		$this->is_logged_in();
		  
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
	
	function load()
	{
	  $this->load->model('load_subs_model');
    $this->load_subs_model->getData();
  }

  function send_emails_to_subs()
  {
  
  	$this->load->model('load_subs_model');
    $this->load_subs_model->send_email();
  
  }  
  
  function load_members()
  {
 // $this->load->library('SpreadsheetExcelReader');
 // $this->load->library('SpreadsheetExcelReader');
  
  // $this->spreadsheetexcelreader->read('/home1/virtualt/public_html/nilesh/itemtypes.xls');
  
  $fp = fopen('/home1/virtualt/public_html/nilesh/load.csv','r') or die("can't open file");

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
        $seq = $csv_line[0];
        if ($seq == "")
          continue;
        $firstname = $csv_line[1];
        $lastname = $csv_line[2];
        
        $name = $firstname . " " . $lastname;
        $email =  $csv_line[3];
        $split_email = explode('@', $email);
        $username = $split_email[0];
         
        $rid = $csv_line[4];
        $num_books = $csv_line[5];
         
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
        echo "Imported " . $user_info->name . " " . $user_info->username . "<br>";
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
	
}	