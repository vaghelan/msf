<?php


class Books_model extends CI_Model {

   function get_books()
   {

     $q = $this->db->get('books');
     return($q->result());
     
   }
   
   function get_book_id($name)
   {
      $this->db->where('name', $name);
      $result = $this->db->get('books');
      if ($result->num_rows != 1)
      {
         log_message('debug', "Num books = " . $result->num_rows . "for $name");
         return -1;
      }
      return ($result->row()->id);
   }
   
   function get_books_json()
   {
     $this->db->order_by("name", "asc");
     $q = $this->db->get('books');
      
     $numrows = $q->num_rows();
     if ($numrows > 0)
     {
     		$jsonresult = json_encode($q->result_array());
		    return '({"total":"'.$numrows.'","results":'.$jsonresult.'})';
     }
     else
     {
         return '({"total":"0", "results":""})';
     }
     
   }
   


}