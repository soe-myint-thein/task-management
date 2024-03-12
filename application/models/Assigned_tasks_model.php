<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Assigned_tasks_model extends CI_Model{


	function getall(){
	    $this->db->select('assigned_tasks.*,tasks.task_name,users.name as assign_to');
        $this->db->join('tasks', 'tasks.id = assigned_tasks.task_id');
        $this->db->join('users', 'users.id = assigned_tasks.assign_to');
	    
	   $query=$this->db->order_by("assigned_tasks.id","DESC")->get("assigned_tasks");
        return $query;
	}
	
// 	start 
	
function grab_staff_lists()
{
        $this->db->order_by("user_type");
        $query = $this->db->get_where("users",array("user_type"=>"Staff"));
       
        return $query;
}

    
     

} 

/*site_model end here*/