<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller {

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
		$this->load->model('Tasks_model');


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
	    $data["main_content"]="tasks";
	    $data["lists"]= $this->Tasks_model->getall();
		$this->load->view('administrator/admin_template',$data);
	}
	
	public function create(){
	   $data["main_content"]="create_tasks";

	  	$data["message"]="";
		$this->load->view('administrator/admin_template',$data);
	}


	
	public function edit($id){
	   $data["message"]="";
	    $data["payment_statuss"]= $this->Admin_model->grab_payment_statuss();

	    $data["task_types"]= $this->Admin_model->grab_task_types();

	    $data["task_statuss"]= $this->Admin_model->grab_task_statuss();

	   $data['list']=$this->db->get_where("tasks",array("id"=>$id))->row();

	   $data["main_content"]="edit_tasks";
		$this->load->view('administrator/admin_template',$data);
	}
	


	public function store(){
	    
	    $this->form_validation->set_rules('task_name', 'task_name', 'trim|required');
	    $this->form_validation->set_rules('description', 'description', 'trim|required');
	   
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

                $requested_by=get_cookie("user_id");
                $data = array(
                'task_name' => $this->input->post('task_name'),
                'description' => $this->input->post('description'),
                'task_docs' => $this->input->post('task_docs'),
                'requested_by' => $requested_by,
                'date' => date("Y-m-d",strtotime($this->input->post('date')))


                );

            
            $qry=$this->db->insert("tasks",$data);	
            
            
            if($qry){
                
                $data["message"]="successfully Save";
            }
            else
            {
               $data["message"]="Fail To Save";

            }

        
    }
            
             $data["main_content"]="create_tasks";
    		$this->load->view('administrator/admin_template',$data);
	}


	
		public function update($id){

 	   $this->form_validation->set_rules('task_name', 'task_name', 'trim|required');
	    $this->form_validation->set_rules('description', 'description', 'trim|required');
	   
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

                
                 $requested_by=get_cookie("user_id");
                $data = array(
                'task_name' => $this->input->post('task_name'),
                'description' => $this->input->post('description'),
                'task_docs' => $task_docs,
                'requested_by' => $requested_by,
                'date' => date("Y-m-d",strtotime($this->input->post('date')))


                );
            $this->db->where("id",$id);
            $qry=$this->db->update("tasks",$data);	
            
            
            if($qry){
                
                $data["message"]="successfully Save";
            }
            else
            {
               $data["message"]="Fail To Save";

            }

        }
            
        $data["main_content"]="edit_tasks";
         $data["payment_statuss"]= $this->Admin_model->grab_payment_statuss();

	    $data["task_types"]= $this->Admin_model->grab_task_types();

	    $data["task_statuss"]= $this->Admin_model->grab_task_statuss();

        $data['list']=$this->db->get_where("tasks",array("id"=>$id))->row();
    	$this->load->view('administrator/admin_template',$data);
	}
	
	
	function delete($id){
	     $this->db->where("id",$id);
            $qry=$this->db->delete("tasks");
            $this->index();
	}
	
	
	
	
}
