<?php


class Users_Data_model extends CI_Model {

    function get_qanswer($userid, $value)
    {
      $this->db->where('user_id', $userid);
      $this->db->where('field_id', $value);
      
      $r = $this->db->get('users_data');
      return ($r->num_rows != 0);
    
    }
    
    function add_q_answer($userid, $value)
    {
      $this->db->where('user_id', $userid);
      $q1 = array('field_id' => $value, 'value' => 'on');
      $r = $this->db->insert('users_data', $q1);
      return $r;
    
    }

    function delete_q_answer($userid, $value)
    {
      $this->db->where('user_id', $userid);
      $this->db->where('field_id', $value);
      
      $r = $this->db->delete('users_data', $q1);
      return $r;
    
    }
    
    function update_answer($userid, $q, $value)
    {
      $this->db->where('user_id', $userid);
      $q1 = array('field_id' => $q, 'value' => $value);
      $r = $this->db->update('users_data', $q1);
      return $r;
   
    }


    
    function update_community_answer($userid, $value)
    {
      $present = $this->get_community_q_answer($userid, $q);
       if ($present)
       {
          $this->update_answer($userid, $value, 'on');
       
       }
    }


}