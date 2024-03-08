<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Payment_model extends CI_Model{


	function getall(){
	    $this->db->select('payments.*,tasks.task_name as task_name');
        $this->db->join('tasks', 'tasks.id = payments.task_id');
	    
	   $query=$this->db->order_by("payments.id","DESC")->get("payments");
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