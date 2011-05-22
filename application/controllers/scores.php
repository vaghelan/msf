<?php

class Scores extends CI_Controller
{
	function __construct()
	{
	  parent::__construct();
		$this->is_logged_in();
	}

  private function loadView($form, $data)
  {
    $this->load->view('includes/header', $data);
   // $this->load->view('includes/headers-1', $data);
    $this->load->view($form, $data);
    $this->load->view('includes/footer');  
  }


  public function index()
  {

    $data['userdata'] = $this->membership_model->get_user_details_by_name($this->session->userdata('username'));   
    $data['current_event'] = $this->events_model->get_current_event();
    $data['books'] = $this->books_model->get_books(); 
    $data['rank'] = $this->ranks_model->get_current_rank_description($this->session->userdata('user_id'));
    $this->loadView('scores_form', $data);
     
                                
  } 
  
  public function get_books_scored()
  {
    // log_message('debug', "get books scored called...........................");
    $result = $this->scores_model->get_books_scored_in_json(
             $this->session->userdata('user_id'), 
             $this->session->userdata('current_event_id'), 
             $this->input->post('start'), 
             $this->input->post('limit'));
    echo $result;     
  
  }  
  
  // Encodes a YYYY-MM-DD into a MM-DD-YYYY string
  private function codeDate ($date) {
	$tab = explode ("-", $date);
	$r = $tab[1]."/".$tab[2]."/".$tab[0];
	return $r;
}
  
  private function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
		  log_message('debug', "Scors form.....Cookie not found so redirect to login");
			redirect('login');
			die();		
		}		
	}	 
	
	function add()
	{
    $this->scores_model->add_score(
                  $this->session->userdata('current_event_id'),
                  $this->session->userdata('user_id'),
                  $this->input->post('select_book'), 
                  $this->input->post('book_count'),
                  date('Y-m-d')                  
                  );
    
    $this->index();
  
  }
  
  function add_score_ajax()
  {
  
    $result = $this->scores_model->add_score(
                  $this->session->userdata('current_event_id'),
                  $this->session->userdata('user_id'),
                  $this->books_model->get_book_id($this->input->post('book_name')), 
                  $this->input->post('book_count'),
                  date('Y-m-d')
         //         $this->input->post('distribution_date')                  
                  );

    echo ($result);
  
  }
  
  function save_score_ajax()
  {
     $result = $this->scores_model->save_score(
                  $this->input->post('ID'),
                  $this->input->post('BookName'),
                  $this->input->post('ReportDate'),
                  $this->input->post('Count')
                  ); 
                   
     echo $result;
  }
  
  
  function delete_scores()
  {
      $ids = $this->input->post('ids');
      $id_scores = json_decode(stripslashes($ids));
      if(sizeof($id_scores)<1)
      {
        echo '0';
        return;
      } 
       
      
      $result = $this->scores_model->delete_scores($id_scores);
      
      echo $result;
      return;
  
  }
  
  function get_rank_ajax()
  {
    $rank = $this->membership_model->get_current_rank_id($this->session->userdata('user_id'));
    echo $rank;
  
  }
  
  function get_my_score_ajax()
  {
      $result = $this->scores_model->get_total_books_distributed_by_user_and_eventid(
                  $this->session->userdata('user_id'),
                  $this->session->userdata('current_event_id'));
      echo "$result";                                                                 
  }
  
   function get_my_total_score_ajax()
  {
      $result = $this->scores_model->get_total_books_distributed_by_user(
                  $this->session->userdata('user_id'));
      echo "$result";                                                                 
  }
  
  function get_team_score_ajax()
  {
      $result = $this->scores_model->get_total_books_distributed_by_team_and_eventid(
                  $this->session->userdata('user_id'),
                  $this->session->userdata('current_event_id'));
      echo "$result";                                                                 
  }
  
   function get_total_team_score_ajax()
  {
      $result = $this->scores_model->get_total_books_distributed_by_team(
                  $this->session->userdata('user_id'));
      echo "$result";                                                                 
  }
  
  function update_all()
  {
    $this->scores_model->update_children();
    echo "done";
  }

                        
}


?>
