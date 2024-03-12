<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assigned_tasks extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	 var $data;

	function __construct()
	{
		 date_default_timezone_set("Asia/Rangoon");
	   ini_set('memory_limit','-1');
		parent::__construct();
		$this->load->model('Admin_model');
				$this->load->model('Assigned_tasks_model');


		$admin_cookie=get_cookie("admin_cookie");
		$user_role=get_cookie("user_role");
		$edallow=get_cookie("edallow");
		if($edallow=="Yes")
		{
			$ed='<th>Edit / Delete</th>';
		}
		else
		{
			$ed="";
		}
		
			if(get_cookie("permission") !="")
		{
		$permission=get_cookie("permission");

		$this->data=array(

			'header_menu'=>$this->db->query("SELECT * FROM menu WHERE header_menu=1 AND id IN ($permission) ORDER BY no ASC"),
			'today'=>date("d-m-Y"),
			'ed'=>$ed
			);
			
	}
		
	}

	public function index()
	{

	    $data["main_content"]="assigned_tasks";
	    $data["lists"]= $this->Assigned_tasks_model->getall();
		$this->load->view('administrator/admin_template',$data);
	}
	
	public function create(){
	   $data["main_content"]="create_assigned_tasks";
	   $data["message"]="";
	   $data["staffs"]= $this->Assigned_tasks_model->grab_staff_lists();
		$data["task_names"]= $this->Admin_model->grab_undone_task();

		$this->load->view('administrator/admin_template',$data);
	}
	
	public function edit($id){
	   $data["message"]="";
	   $data['list']=$this->db->get_where("assigned_tasks",array("id"=>$id))->row();
	   $data["staffs"]= $this->Assigned_tasks_model->grab_staff_lists();
		$data["task_names"]= $this->Admin_model->grab_undone_task();

	   $data["main_content"]="edit_assigned_tasks";
		$this->load->view('administrator/admin_template',$data);
	}
	
	public function store(){
	    
	    $this->form_validation->set_rules('task_id', 'task_id', 'trim|required');
	    $this->form_validation->set_rules('task_desc', 'task_desc', 'trim|required');
	    $this->form_validation->set_rules('assign_to', 'assign_to', 'trim|required');
	 
            if ($this->form_validation->run() == FALSE) {
                
        	     $data["message"]="Please Fill the required Data";
           } 
            
             else {



             	if(($_FILES['task_docs']['name'])!=""){

	        $this->admin_model->file_upload("task_docs",'task_docs');  
	        $task_docs =str_replace(" ","_",$_FILES['task_docs']['name']);
       
	       	 }
	      	else            
		      {
		        $task_docs="";
		      }	

		      $assign_to=implode(",",$this->input->post('assign_to'));
                
                $data = array(
                'task_id' => $this->input->post('task_id'),
                'task_desc' => $this->input->post('task_desc'),
                'is_supervisor' => $this->input->post('is_supervisor'),
                'task_docs' => $task_docs,
                'assign_to' => $assign_to

                );

            
            $qry=$this->db->insert("assigned_tasks",$data);	
            
            
            if($qry){
                
                $data["message"]="successfully Save";
            }
            else
            {
               $data["message"]="Fail To Save";

            }

        }
            	   $data["staffs"]= $this->Assigned_tasks_model->grab_staff_lists();
		$data["task_names"]= $this->Admin_model->grab_undone_task();


             $data["main_content"]="create_assigned_tasks";
    		$this->load->view('administrator/admin_template',$data);
	}
	
		public function update($id){
 		 $this->form_validation->set_rules('task_id', 'task_id', 'trim|required');
	    $this->form_validation->set_rules('task_desc', 'task_desc', 'trim|required');
	    $this->form_validation->set_rules('assign_to', 'assign_to', 'trim|required');
	 
            if ($this->form_validation->run() == FALSE) {
                
        	     $data["message"]="Please Fill the required Data";
           } 
            
             else {



             	if(($_FILES['task_docs']['name'])!=""){

	        $this->admin_model->file_upload("task_docs",'task_docs');  
	        $task_docs =str_replace(" ","_",$_FILES['task_docs']['name']);
       
	       	 }
	      	else            
		      {
		        $task_docs=$this->input->post("old_files");
		      }	

		      $assign_to=implode(",",$this->input->post('assign_to'));
                
                $data = array(
                'task_id' => $this->input->post('task_id'),
                'task_desc' => $this->input->post('task_desc'),
                'is_supervisor' => $this->input->post('is_supervisor'),
                'task_docs' => $task_docs,
                'assign_to' => $assign_to

                );

            $this->db->where("id",$id);
            $qry=$this->db->update("assigned_tasks",$data);	
            
            
            if($qry){
                
                $data["message"]="successfully Save";
            }
            else
            {
               $data["message"]="Fail To Save";

            }

        }
            
        $data["main_content"]="edit_assigned_tasks";
        $data["staffs"]= $this->Assigned_tasks_model->grab_staff_lists();
		$data["task_names"]= $this->Admin_model->grab_undone_task();


        $data['list']=$this->db->get_where("assigned_tasks",array("id"=>$id))->row();
    	$this->load->view('administrator/admin_template',$data);
	}
	
	
	function delete($id){
	     $this->db->where("id",$id);
            $qry=$this->db->delete("assigned_tasks");
            $this->index();
	}
	

	
	
}
