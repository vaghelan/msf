<?php

class Login extends CI_Controller
{
 
 function __construct()
 {
   parent::__construct();
 }
 
  private function get_is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		//if(!isset($is_logged_in) || $is_logged_in != true)
		if($is_logged_in == FALSE)
		{
      return 0;
		}	
		
		return 1;
   	
	}	 
	
 
 function index()
 {
  if ($this->get_is_logged_in())
  { 
    log_message('debug', 'redirect to scores page');
    redirect('scores');

    
  }
  else
  {
    $rid = $this->session->userdata('recruit_id');
    
    if ($rid == FALSE)
    {
      $data['rid'] = '0';
      log_message('debug', "rid = " . $data['rid']);
    }  
    else
    {
      $data['rid'] = $this->session->userdata('recruit_id');
      log_message('debug', "rid 1 = " . $data['rid']);

     }     

   $this->loadView('login_form', $data);   
  }      
   
   
 }
 
 private function loadView($form_name, $data)
  {
    $this->load->view('includes/login_header');
    $this->load->view($form_name, $data);
/*     $this->load->view('includes/footer');   */
  }
  
  
 
 function validate_credentials()
 {
 		$username = strtolower(rtrim(ltrim($this->input->post('username'))));
		$password = $this->input->post('password');
 
    $result = $this->membership_model->validate($username, $password);
    
    if($result >= 0 ) // if the user's credentials validated...
		{
			$data = array(
				'username' => $username,
				'is_logged_in' => true,
				'user_id' => $result,
				'current_event_id' =>  $this->events_model->get_current_event_id(),
				'recruit_id' =>  $this->membership_model->get_user_recruiter_id($result)
			);
			$this->session->set_userdata($data);
		  $this->membership_model->update_last_logged_in($result);
			
			log_message('debug', "User Name: " . $this->session->userdata('username') );
			log_message('debug', "Logged in: " . $this->session->userdata('is_logged_in') );
			log_message('debug', "User ID: " . $this->session->userdata('user_id') );
			log_message('debug', "Current Event ID: " . $this->session->userdata('current_event_id') );
			log_message('debug', "Switching to scores form");
			header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
			redirect('scores');
		}
		else if ($result == -2) // incorrect username or password
		{
		  $data['error_message'] = "incorrect user name/password";
		  if ($this->session->userdata('recruit_id') != "")
        $data['rid'] = $this->session->userdata('recruit_id');
      else
        $data['rid'] = 0;  
	    $this->loadView('login_form', $data);		
	    header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
		}
		else if ($result == -1) // duplicate username
		{
		  $data['error_message'] = "duplicate user name. Please write to technical support";
		  if ($this->session->userdata('recruit_id') != "")
        $data['rid'] = $this->session->userdata('recruit_id');
      else
        $data['rid'] = 0;  
	    $this->loadView('login_form', $data);		
	    header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
		}
		
    
 
 }
 
 function signup_witherror($id, $error_message)
 {
    log_message('debug', $error_message);
    $data['error_message'] = $error_message;
    $data['recruit_id'] = $id;
		$this->loadView('signup_form', $data);	
 }

 
 function signup($id)
 {
   if ($this->get_is_logged_in())
   { 
    redirect('scores');
    return;
   }
 
 
    if (!isset($id))
      $id = 0;
      
    //change the session recruit id ..attis time only recruit id is in session  
    $this->session->set_userdata('recruit_id', $id);
    
      
    $data['recruit_id'] = $id; 
    $data['username'] = $this->membership_model->get_user_name_by_id($id);
    if ($data['username'] == "")
    {
     echo "Recruiter does not exist in the system ID = " . $id . ". URL given to you is invalid. Please delete the cookie and retry with right URL.";
      return;
    }
		$this->loadView('signup_form', $data);	
 }


 	function create_member()
	{
	
    log_message('debug', 'user name = ' . $this->input->post('username'));
		if (!$this->username_check($this->input->post('username')))
    {
    
      $this->signup_witherror($this->input->post('recruit_id'), "username already exists");
      //$this->signup();
      return;
    
    
   }  


	//	if (!$this->email_check($this->input->post('email_address')))
   // {
    
    //  $this->signup_witherror($this->input->post('recruit_id'), "email already registered");
      //$this->signup();
     // return;
    
    
   // }  


		
		// field name, error message, validation rules
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		// $this->form_validation->set_rules('email_address', 'Email Address', 'callback_email_check');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
	//	$this->form_validation->set_rules('username', 'Username', 'callback_username_check');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		
		
		if($this->form_validation->run() == FALSE)
		{
      $this->signup($this->input->post('recruit_id'));
      return;

		}
		
		
		if($query = $this->membership_model->create_member($this->input->post('recruit_id')))
		{
			$this->loadView('signup_successful', '');
			$this->email_model->send_signup_email($this->input->post('email_address'),
                                            $this->input->post('name'),
                                            $this->input->post('username'),
                                            $this->input->post('password'));
		}
		else
		{
      $this->signup($this->input->post('recruit_id'));			
    }
        
		
	}
	
	private function username_check($str)
	{
	  
	  if (!$this->membership_model->is_unique_username($str))
	  {
	      $this->form_validation->set_message('username_check', 'username already exists');
			  return FALSE;
		}
	  return TRUE;    
	}
	
	private function email_check($str)
	{
	  
	  if (!$this->membership_model->is_unique_email($str))
	  {
	      $this->form_validation->set_message('email_check', 'email already registered');
			  return FALSE;
		}
	  return TRUE;    
	}
	
	function forgot_password()
	{
     $r = $this->membership_model->reset_password($this->input->post('username'), $this->input->post('email_address'));
     if ($r == 0)
     {
       $data['error_message'] = "Error: Account not found for the given username and email address";
     }
     else
     {         
       if ($r > 1)
         $data['error_message'] = "Account password is reset for ". $r . " accounts registered on the same email. You will receive " . $r . " emails one for each account.";
       else
         $data['error_message'] = "Account password is reset. Check your email.";

     } 
     $this->load->view('forgot_password_form', $data);  
  }
  
  function load_forgot_password()
  {
    $this->load->view('forgot_password_form', ""); 
  }
	
	function logout()
	{
	  $uid = $this->session->userdata('user_id'); 	  

		$this->session->unset_userdata('username');
		$this->session->unset_userdata('is_logged_in');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('current_event_id');
		$this->session->sess_destroy();
		$this->session->set_userdata('recruit_id', $uid);
		$this->index();
	}


}







?>
