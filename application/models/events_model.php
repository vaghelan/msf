<?php


class Events_model extends CI_Model {

   function get_current_event()
   {
   $this->db->select('*');
   $this->db->from('events');
   $this->db->join('currentevents', 'currentevents.event_id = events.id');

     $q = $this->db->get();
     
     if ($q->num_rows() == 0 || $q->num_rows() > 1)
     {
       echo "Fatal error: No events defined";
       return;
     }
     
     $event = $q->row();
     
     return ($event->description);   
   }

   function get_current_event_id()
   {
     $q = $this->db->get('currentevents');
     
     if ($q->num_rows() == 0 || $q->num_rows() > 1)
     {
       echo "Fatal error: No events defined";
       return;
     }
     
     $event = $q->row();
     
     return ($event->event_id);   
   }

}