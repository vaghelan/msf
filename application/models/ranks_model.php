<?php


class Ranks_model extends CI_Model {



  function get_current_rank_description($userid)
  {
      $rank = $this->membership_model->get_current_rank_id($userid);
      $this->db->select('description');                    
      $this->db->where('id', $rank);
      $q =  $this->db->get('ranks');
      $row = $q->row();
      return($row->description);                     
  }
  
  private function promote_user_to_prospective_merchant($userid)
  {
    $data = array('rank_id' => 0);
    $this->db->where('id', $userid);
    $this->db->update('users', $data);      
  }
  
  private function promote_user_to_merchant($userid)
  {
    $data = array('rank_id' => 1);
    $this->db->where('id', $userid);
    $this->db->update('users', $data);      
  }
  
  private function promote_user_to_team_builder($userid)
  {
    $data = array('rank_id' => 2);
    $this->db->where('id', $userid);
    $this->db->update('users', $data);      
  }
  
  private function promote_user_to_master_team_builder($userid)
  {
    $data = array('rank_id' => 3);
    $this->db->where('id', $userid);
    $this->db->update('users', $data);      
  }
  
  private function isProspectiveMerchant()
  {
     return 0;
  
  }
  
  private function isMerchant()
  {
     return 1;
  
  }
  
  private function isTeamBuilder()
  {
     return 2;
  
  }
  
  private function isMasterTeamBuilder()
  {
     return 3;
  
  }
  

  private function satisfiesTeamBuilderCriteria($userid)
  {
     $count = 0;
     $team_members = $this->membership_model->get_team_members_all_fields($userid);
     foreach ($team_members as $member)
     {
       if ( $member->rank_id ==  $this->isMerchant() 
         || $member->rank_id ==  $this->isTeamBuilder() 
         || $member->rank_id ==  $this->isMasterTeamBuilder()         
          )
        $count++;
       if ($count == 3)
         return 1; 
          
     }
     return 0;    
  }
  
  private function satisfiesMasterTeamBuilderCriteria($userid)
  {
     $count = 0;
     $team_members = $this->membership_model->get_team_members_all_fields($userid);
     foreach ($team_members as $member)
     {
       if ( $member->rank_id ==  $this->isTeamBuilder() 
         || $member->rank_id ==  $this->isMasterTeamBuilder() )
        $count++;
       if ($count == 3)
         return 1; 
          
     }
     return 0;    
  }
  
  private  function satisfiesMerchantCriteria($score)
  {
    return ($score >= 1);
  }
  
  private  function satisfiesProspectiveMerchantCriteria($score)
  {
    return ($score == 0);
  }
  
  
  function update_rank($userid, $score)
  {
    $rank =  $this->membership_model->get_current_rank_id($userid);
    
      
    if (! $this->satisfiesMerchantCriteria($score)) 
    {
        // was he prospective merchant
        if ($rank != $this->isProspectiveMerchant()) 
        {
          // he was not prospective merchant so demote
           $this->promote_user_to_prospective_merchant($userid);
           log_message('debug', "updating rank for " .  $userid . " " . $score );
           log_message('debug', "Promote to Perspective merchant");
           return 1;
        }
        return 0;  // he is already prospective merchant
    }        
    // he is atleast merchant...  let us see
    
    if (! $this->satisfiesTeamBuilderCriteria($userid))
    {
        // was he merchant ?
        if ($rank != $this->isMerchant())  
        {
            // He was not merchant so promote
           $this->promote_user_to_merchant($userid);
           log_message('debug', "updating rank for " .  $userid . " " . $score );
           log_message('debug', "Promote to Merchant");
           return 1;
        }
        return 0;  //he is already mechant
    
    
    }   
    // he is atleast Team Builder ... let us see
    
    
    
    if (! $this->satisfiesMasterTeamBuilderCriteria($userid))
    {
        // was he team builder
        if ($rank != $this->isTeamBuilder()) 
        
        {
           // He was not team builder so promote
           $this->promote_user_to_team_builder($userid);
           log_message('debug', "updating rank for " .  $userid . " " . $score );

           log_message('debug', "Promote to Team Builder");
           return 1;
        }
        // he is already team builder
        return 0; 
    
    
    }
  // he is  master builder
  //  was he already master team builder
  if ($rank != $this->isMasterTeamBuilder()) 
  {
   // He was not Master Team builder so promote
   $this->promote_user_to_master_team_builder($userid);
   log_message('debug', "updating rank for " .  $userid . " " . $score );

   log_message('debug', "Promote to Master Team Builder");
   return 1;        
 
  }
  return 0; // he is already master builder


  }
}  



?>