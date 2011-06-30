<?php


class Stats_model extends CI_Model {


   function get_current_stats()
   {
    
		$query = $this->db->get('stats');
		
		if($query->num_rows == 1)
		{
		  $stats = $query->row();
			return array($stats->total_registered, $stats->total_distributors, $stats->total_books, $stats->total_registered_last_week, $stats->total_registered_today) ;
		}
		return array(0,0,0,0,0,0);

   }

   function set_current_stats($tr, $td, $tb, $tr_last_week, $tr_today)
   {

    $data = array(
                  'total_registered' => $tr,
                  'total_distributors' => $td,
                  'total_books' => $tb,
                  'total_registered_last_week' => $tr_last_week,  
                  'total_registered_today' => $tr_today
                  ); 
                  
     $this->db->where('id', 0);
     $this->db->update('stats', $data);    
                  
    

   }













}