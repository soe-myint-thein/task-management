<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
		else
		{
			redirect('Site/lms');
		}
	}

	public function index()
	{
	    $data["main_content"]="users";
	    $this->db->select("user_roles.role as title,users.*");
	    $this->db->join("user_roles","users.user_role=user_roles.id");
	    $data["lists"]=$this->db->order_by("id","DESC")->get("users");
		$this->load->view('administrator/admin_template',$data);
	}
	
	public function create(){
	   $data["main_content"]="create_user";
	   $data["roles"]=$this->Admin_model->grab_userrole();
	   $data["message"]="";
		$this->load->view('administrator/admin_template',$data);
	}
	
	public function edit($id){
	   $data["message"]="";
	   $data["roles"]=$this->Admin_model->grab_userrole();
	   $data['list']=$this->db->get_where("users",array("id"=>$id))->row();
	   $data["main_content"]="edit_user";
		$this->load->view('administrator/admin_template',$data);
	}
	
	public function store(){
	    
	    $this->form_validation->set_rules('name', 'name', 'trim|required');
	    $this->form_validation->set_rules('email', 'email', 'trim|required');
	   
            if ($this->form_validation->run() == FALSE) {
                
        	     $data["message"]="Please Fill the required Data";
           } 
            
             else {
                
                if($_FILES["photo"]["name"] !="")
                {	
                 $photo=$this->Admin_model->img_upload('photo','user');
                 $photo=str_replace(" ","_",$_FILES['photo']['name']);
                 }
               else
               {
                $photo="";
                }
                
                $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'user_type' => $this->input->post('user_type'),
                'user_role' => $this->input->post('user_role'),
                'photo' => $photo
                );

            
            $qry=$this->db->insert("users",$data);	
            
            
            if($qry){
                
                $data["message"]="successfully Save";
            }
            else
            {
               $data["message"]="Fail To Save";

            }

        }
            
             $data["main_content"]="create_user";
             	   $data["roles"]=$this->Admin_model->grab_userrole();

    		$this->load->view('administrator/admin_template',$data);
	}
	
		public function update($id){
   $this->form_validation->set_rules('name', 'name', 'trim|required');
	    $this->form_validation->set_rules('email', 'email', 'trim|required');
	   
       	   
             if ($this->form_validation->run() == FALSE) {
                
        	     $data["message"]="Please Fill the required Data";
           } 
            
              else {
                
                if($_FILES["photo"]["name"] !="")
                {	
                 $photo=$this->Admin_model->img_upload('photo','user');
                 $photo=str_replace(" ","_",$_FILES['photo']['name']);
                 }
               else
               {
                $photo=$this->input->post('old_image');
                }
                
                
              $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'user_type' => $this->input->post('user_type'),
                'user_role' => $this->input->post('user_role'),
                'photo' => $photo
                );

            $this->db->where("id",$id);
            $qry=$this->db->update("users",$data);	
            
            
            if($qry){
                
                $data["message"]="successfully Save";
            }
            else
            {
               $data["message"]="Fail To Save";

            }

        }
            
        $data["main_content"]="edit_user";
        	   $data["roles"]=$this->Admin_model->grab_userrole();

        $data['list']=$this->db->get_where("users",array("id"=>$id))->row();
    	$this->load->view('administrator/admin_template',$data);
	}
	
	
	function delete($id){
	     $this->db->where("id",$id);
            $qry=$this->db->delete("users");
            $this->index();
	}
	
	
	
}
