<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

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


	}



    function register_form()
    {
        $data["message"]="";
        $data["settings"]=$this->db->get("branches")->row();
        $this->load->view("administrator/register_form",$data);
    }//



	public function index()
	{
	    $data["main_content"]="users";
	    $this->db->select("user_roles.role as title,users.*");
	    $this->db->join("user_roles","users.user_role=user_roles.id");
	    $data["lists"]=$this->db->order_by("id","DESC")->get("users");
		$this->load->view('administrator/admin_template',$data);
	}
	
	
    function register()
    {
        $data["message"]="";
        $data["settings"]=$this->db->get("branches")->row();
        $this->load->view("administrator/register_form",$data);
    }//

	public function store(){
	    
	    $this->form_validation->set_rules('name', 'name', 'trim|required');
	    $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[users.email]');
	    $this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');


            if ($this->form_validation->run() == FALSE) {
                
        	     $data["message"]="Please Fill the required Data";
       			 $data["settings"]=$this->db->get("branches")->row();
       			 $this->load->view("administrator/register_form",$data);

           } 
            
             else {
                
               
                
                $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'user_type' => $this->input->post('user_type'),
                'user_role' => $this->input->post('user_role')
                );

            
            $qry=$this->db->insert("users",$data);	
            
            
            if($qry){
                
                $data["message"]="successfully Save";
            }
            else
            {
               $data["message"]="Fail To Save";

            }

             $data["message"]="Success Register! Please Login Here";

        $data["settings"]=$this->db->get("branches")->row();

        $this->load->view("administrator/login_form",$data);

        }
            
     
       
    
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
