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
    
    
    function get_field_prompt($field_id)
    {
      $this->db->where('id', $field_id);
      
      $r = $this->db->get('fields');
      if ($r->num_rows != 0)
      {
        $row = $r->row();
        return $row->prompt;
      }
      return "";
    }   

    function get_field_value($userid, $field_id)
    {
      $this->db->where('user_id', $userid);
      $this->db->where('field_id', $field_id);
      
      $r = $this->db->get('users_data');
      if ($r->num_rows != 0)
      {
        $row = $r->row();
        return $row->value;
      }
      return -1;

    }
    
    
    function add_field($userid, $field_id, $value)
    {
      $q1 = array('user_id' => $userid, 'field_id' => $field_id, 'value' => $value);
      $r = $this->db->insert('users_data', $q1);
      return $r;    
    
    }

    function update_field($userid, $field_id, $value)
    {
      $present = $this->get_field_value($userid, $field_id);
      
      if ($present != -1)
      {
        $this->db->where('user_id', $userid);
        $this->db->where('field_id', $field_id);
        $q1 = array('value' => $value);
        $r = $this->db->update('users_data', $q1);
        //log_message('debug', "update query = " . $this->db->last_query());
        return $r;
      }
      $this->add_field($userid, $field_id, $value);
      //log_message('debug', "Add query = " . $this->db->last_query());        
    }

    function delete_field($userid, $field_id)
    {
      $this->db->where('user_id', $userid);
      $this->db->where('field_id', $field_id);
      $r = $this->db->delete('users_data');
      return $r;    
    }
    
    function get_subscribe_option_by_id($userid)
    {
      $subscribe = $this->get_field_value($userid, 6);
      if ($subscribe == -1)
      {
        $this->add_field($userid, 6, 1);
        return "1";
      }
      return $subscribe;
      
    }
    
    function get_subscribe_prompt()
    {
      return $this->get_field_prompt(6);
    }


}