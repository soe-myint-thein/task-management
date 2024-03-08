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
	    $data["lists"]= $this->Tasks_model->getall();;
		$this->load->view('administrator/admin_template',$data);
	}
	
	public function create(){
	   $data["main_content"]="create_tasks";
	   $data["message"]="";
		$this->load->view('administrator/admin_template',$data);
	}
	
	public function edit($id){
	   $data["message"]="";
	   $data['list']=$this->db->get_where("tasks",array("id"=>$id))->row();
	   $data["main_content"]="edit_tasks";
		$this->load->view('administrator/admin_template',$data);
	}
	
	public function store(){
	    
	    $this->form_validation->set_rules('answer', 'answer', 'trim|required');
	    $this->form_validation->set_rules('answer', 'answer', 'trim|required');
	   
            if ($this->form_validation->run() == FALSE) {
                
        	     $data["message"]="Please Fill the required Data";
           } 
            
             else {
                
                $data = array(
                'question' => $this->input->post('question'),
                'answer' => $this->input->post('answer')
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
 	 $this->form_validation->set_rules('answer', 'answer', 'trim|required');
	 $this->form_validation->set_rules('answer', 'answer', 'trim|required');

             if ($this->form_validation->run() == FALSE) {
                
        	     $data["message"]="Please Fill the required Data";
           } 
            
              else {
                
               $data = array(
                'question' => $this->input->post('question'),
                'answer' => $this->input->post('answer')
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
        $data['list']=$this->db->get_where("tasks",array("id"=>$id))->row();
    	$this->load->view('administrator/admin_template',$data);
	}
	
	
	function delete($id){
	     $this->db->where("id",$id);
            $qry=$this->db->delete("tasks");
            $this->index();
	}
	
	
	
	
}
