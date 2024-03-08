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
	
    
       function getone_student_uploads($id){
        $this->db->select('student_uploads.*,courses.title as ctitle,students.name as stuname');
        $this->db->join('courses', 'courses.id = student_uploads.course_id');
        $this->db->join('students', 'students.id = student_uploads.student_id');
        
        $query=$this->db->get_where("student_uploads",array("student_uploads.content_id"=>$id));
        return $query;
    }

} 

/*site_model end here*/