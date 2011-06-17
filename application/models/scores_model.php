<?php


class Scores_model extends CI_Model {

   function get_scores()
   { 
     $q = $this->db->get('scores');
     return($q->result());     
   }
   
   function update_stats($user_id, $count)
   {
     // Update My Score if Non zero + or -
     if ($count != 0)
       $this->membership_model->update_member_my_score_by_change($user_id, $count);
     
     // Update MY Rank
     $changed = $this->ranks_model->update_rank($user_id, $this->get_total_books_distributed_by_user($user_id));

    if ($user_id == 0) // No Parent
      return;
    // Get user's parent ID
    $recruiter_id = $this->membership_model->get_user_recruiter_id($user_id);
    
    if ($count != 0)
    {
       $this->membership_model->update_member_team_score_by_change($recruiter_id, $count);
    }

     if ($changed) // if My rank has changed then only My parent's rank can change
     {
       // Update Parent's team score and his rank 
       $this->update_parent($recruiter_id);
     }
     
     return;
   
   }
   
   function add_score($event_id, $user_id, $book_id, $count, $bdate)
   {
     $data = array (
       'book_id' => $book_id,
       'event_id' => $event_id,
       'user_id' => $user_id,
       'count' => $count,
       'report_date' => $bdate     
     );
     $insert = $this->db->insert('scores', $data);
     log_message('debug', "query = " . $this->db->last_query());
     $this->update_stats($user_id, $count);
     return($insert);      
   }
   
   function get_num_books_distributed_by_user($user_id, $event_id, $start, $limit)
   {
      $this->db->where('user_id', $user_id);
      $this->db->where('event_id', $event_id);
      $q =  $this->db->get('scores', $limit, $start);
      log_message('debug', "start = " . $start . " limit = " . $limit);
      log_message('debug', "query = " . $this->db->last_query());
      return $q->num_rows();
      
   }
   
    function get_total_books_distributed_by_user_and_eventid($user_id, $event_id)
   {
      $this->db->select_sum('count');
      $this->db->where('user_id', $user_id);
      $this->db->where('event_id', $event_id); 
      $q =  $this->db->get('scores');
      log_message('debug', "query = " . $this->db->last_query() . "num rows = " . $q->num_rows());
      if ($q->num_rows() == 0) return 0;
      if ($q->row()->count) return $q->row()->count;
      return 0;
      
   }
   
    function get_total_books_distributed_by_user($user_id)
   {
      $this->db->select_sum('count');
      $this->db->where('user_id', $user_id);
      $q =  $this->db->get('scores');
      log_message('debug', "query = " . $this->db->last_query());
      if ($q->num_rows() == 0) return 0;
      if ($q->row()->count) return $q->row()->count;
      return 0;
      
   }

  function get_total_books_distributed_by_team_and_eventid($user_id, $event_id)
   {
      $arr = $this->membership_model->get_team_members_id($user_id);
      
      if (empty($arr)) return 0;      
      
      $this->db->select_sum('count');
      $this->db->where_in('user_id', $arr);
      $this->db->where('event_id', $event_id); 
      $q =  $this->db->get('scores');
      log_message('debug', "query = " . $this->db->last_query());
      if ($q->num_rows() == 0) return 0;
      if ($q->row()->count) return $q->row()->count;
      return 0;
      
   }
   
   function get_total_books_distributed_by_team($user_id)
   {
     $arr = $this->membership_model->get_team_members_id($user_id);
     if (empty($arr)) return 0;
     
      $this->db->select_sum('count');
      $this->db->where_in('user_id', $arr); 
      $q =  $this->db->get('scores');
      log_message('debug', "query = " . $this->db->last_query());
      if ($q->num_rows() == 0) return 0;
      if ($q->row()->count) return $q->row()->count;
      return 0;
     
   
   }

   function get_books_by_offet($user_id, $event_id, $num, $offset)
   {
     $this->db->select('books.description, scores.report_date, scores.count');
     $this->db->join('books', 'scores.book_id = books.id');
     $this->db->where('user_id', $user_id);
     $this->db->where('event_id', $event_id);
     $this->db->order_by("report_date", "desc"); 
     return($this->db->get('scores', $num, $offset));
   }
   
   function get_books_scored_in_json($user_id, $event_id, $start, $limit)
   {
     $this->db->select('scores.id AS id, books.id AS bid, books.name AS name, report_date, count');
     $this->db->join('books', 'scores.book_id = books.id');
     $this->db->where('user_id', $user_id);
     $this->db->where('event_id', $event_id);
     $this->db->order_by("report_date", "desc"); 
     $result = $this->db->get('scores');
     log_message('debug', "query = " . $this->db->last_query());
     $numrows = $result->num_rows();
     
     if ($numrows > 0)
     {
     
       $this->db->select('scores.id AS id, books.id AS bid, books.name AS name, report_date, count');
       $this->db->join('books', 'scores.book_id = books.id');
       $this->db->where('user_id', $user_id);
       $this->db->where('event_id', $event_id);
       $result = $this->db->get('scores', $limit, $start);
       log_message('debug', "query = " . $this->db->last_query());
       $arr = array();
        foreach ($result->result() as $row)
        {
          $row->report_date = $this->codeDate($row->report_date);
          $arr[] = $row;
        } 
     	  $jsonresult = json_encode($arr);     	  
     	  
		    return '({"total":"'.$numrows.'","results":'.$jsonresult.'})';
		    
     }
     else
     {
         return '({"total":"0","results":""})';
     }
   }
   
   function get_score_by_id($score_id)
   {
      $this->db->where('id', $score_id);
      $q = $this->db->get('scores');
      log_message('debug', "query = " . $this->db->last_query());
      $row = $q->row();
      return ($row);   
   
   }
   
   function save_score($sid, $bookName, $report_date, $count)
   {
       $row = $this->get_score_by_id($sid);
       $old_score = $row->count;
       $user_id = $row->user_id; 
   
   
       $bid = $this->books_model->get_book_id($bookName);
       if ($bid == -1)
       {
         log_message('debug', "FAILED SAVE SCORE"); 
        return 0;
       }
       $data = array(
               'book_id' => $bid,
               'report_date' => $report_date,
               'count' => $count
            );
       log_message('debug', "ID =" . $sid);            
       log_message('debug', "report date =" . $report_date);
       log_message('debug', "Book ID =". $bid);     
       log_message('debug', "Count =". $count);
       
       $this->db->where('id', $sid);
       $result = $this->db->update('scores', $data);
       log_message('debug', "UPDATE result = " . $result);
     
   
       $this->update_stats($user_id, $count - $old_score);
       
     //  if ($count != $old_score)
       //   $this->membership_model->update_member_my_score_by_change($user_id, $count - $old_score);

      // $this->ranks_model->update_rank($user_id, $this->get_total_books_distributed_by_user($user_id));
       
      // $this->update_parent($user_id, $count - $old_score);
       
       return 1;
   }   
   
     // Encodes a YYYY-MM-DD into a MM/DD/YYYY string
  function codeDate ($date) {
	  $tab = explode ("-", $date);
	  $r = $tab[1]."/".$tab[2]."/".$tab[0];
	  return $r;
  }

// Encodes a MM/DD/YYYY into a YYYY-MM-DD string
  function decodeDate ($date) 
  {
	  $tab = explode ("/", $date);   
	  $n = count($tab);
	  if($n==3) {
		  $r = $tab[2]."-".$tab[0]."-".$tab[1];
	  } else {
		 $r = "";
	  }
	  return $r;
  }
  
  function delete_scores($ids)
  {
    foreach ($ids as $id)
    {
      $row = $this->get_score_by_id($id);
      $score = $row->count;
      $user_id = $row->user_id;
      $this->db->where('id', $id);
      $this->db->delete('scores');
      log_message('debug', "scores deleted");
      
      $this->update_stats($user_id, (-1)*$score);
      
      //$this->membership_model->update_member_my_score_by_change($user_id, (-1)*$score);
      
      //$this->ranks_model->update_rank($user_id, $this->get_total_books_distributed_by_user($user_id));
      //log_message('debug', "rank updated for user id " . $user_id);   
     // $this->update_parent($user_id, (-1)*$score);    
    }
    return 1;
  
  }
  
  private function update_children_by_id($userid)
  {
    $parent_team_score = 0;
    $num_team_members = 0;
    $team_members = $this->membership_model->get_team_members_id($userid);
    foreach ($team_members as $id)
    {
         $num_team_members++;
         log_message('debug', "team member id = " . $id);
         echo "team member id = " . $id . "<br>";
         
         $ret = $this->update_children_by_id($id);
         $my_team_score = $ret[0]; 
       // This is to get all members under the tree  
       //  $num_team_members = $num_team_members + $ret[1];
         $this->membership_model->update_member_team_score($id, $my_team_score); 
         $personal_score  =  $this->get_total_books_distributed_by_user($id);
         $this->membership_model->update_member_my_score($id, $personal_score);
         $this->membership_model->update_member_my_team_members_by_num($id, $ret[1]);
         $this->ranks_model->update_rank($id, $personal_score);
        // This is to get all score under the tree
        // $parent_team_score = $parent_team_score + $personal_score + $my_team_score;
        
        $parent_team_score = $parent_team_score + $personal_score;
                
    }     
    
    return array($parent_team_score, $num_team_members);   
  }
  
  
  function update_children()
  {
    $ret = $this->update_children_by_id(0);
    
    $team_score = $ret[0];
    $num_team_members = $ret[1];
    log_message('debug', "team score = " . $team_score); 
    
    $this->membership_model->update_member_team_score(0, $team_score);  
    $personal_score  =  $this->get_total_books_distributed_by_user(0);
    $this->membership_model->update_member_my_score(0, $personal_score);
    $this->membership_model->update_member_my_team_members_by_num(0, $num_team_members);
    $this->ranks_model->update_rank(0, $personal_score);         
  
  }
  
  function update_parent($userid)
  {
    $rank_changed = $this->ranks_model->update_rank($userid, $this->get_total_books_distributed_by_user($userid));

    if ($rank_changed == 0 || $userid == 0) 
    // If Rank did not change OR No more parents then end the update
      return;
 
     // This means that rank has changed and user is not 0 so he has some leader
     
    $recruiter_id = $this->membership_model->get_user_recruiter_id($userid);

    return ($this->update_parent($recruiter_id));   
  }
   
   
}