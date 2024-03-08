<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Payout_model extends CI_Model{


	function getall(){
	    $this->db->select('payouts.*,tasks.task_name as task_name');
        $this->db->join('tasks', 'tasks.id = payouts.assign_task_id');
        $this->db->join('users', 'users.id = payouts.received_by');

	    
	   $query=$this->db->order_by("payouts.assign_task_id","DESC")->get("payouts");
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