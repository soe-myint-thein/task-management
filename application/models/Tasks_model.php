<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Tasks_model extends CI_Model{


	function getall(){
	    $this->db->select('tasks.*,users.name as requested_by');
        $this->db->join('users', 'users.id = tasks.requested_by');
	    
	   $query=$this->db->order_by("tasks.id","DESC")->get("tasks");
        return $query;
	}
	
// 	start 
	
    


  

} 

/*site_model end here*/