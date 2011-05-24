<?php

class Teams extends CI_Controller
{
	function __construct()
	{
	  parent::__construct();
		$this->is_logged_in();
	}
	
	private function loadView($form, $data)
  {
   $this->load->view('includes/header', $data);
//   $this->load->view('includes/headers-1', $data);
   $this->load->view($form, $data);
   $this->load->view('includes/footer');  
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
	
	public function index()
  {
    $data['userdata'] = $this->membership_model->get_user_details_by_name($this->session->userdata('username'));   
    $data['current_event'] = $this->events_model->get_current_event(); 
    $data['recruit_id'] =  $this->session->userdata('user_id');
    $this->loadView('teams_form', $data);
     
                                
  } 
  
  function get_team_members_ajax()
  {
    echo $this->membership_model->get_recruitees_json(
               $this->session->userdata('user_id'),
               $this->input->post('start'),
               $this->input->post('limit'));
  }
  
  function post_story()
  {
    $this->loadView('story_report_form', '');
  }
  
  function get_num_team_members_ajax()
  {
    echo ($this->membership_model->get_user_num_team_members($this->session->userdata('user_id')));
  }

  function get_team_leader_ajax()
  {
    echo ($this->membership_model->get_user_recruiter_name($this->session->userdata('user_id')));
  }
  	 
}	
