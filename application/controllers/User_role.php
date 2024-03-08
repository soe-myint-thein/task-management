<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_role extends CI_Controller {

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
	    $data["main_content"]="user_roles";
	    $data["lists"]=$this->db->order_by("id","DESC")->get("user_roles");
		$this->load->view('administrator/admin_template',$data);
	}
	
	public function create(){
	   $data["main_content"]="create_user_role";
	   	$data["permissions"]=$this->Admin_model->user_role_permission();
	   $data["message"]="";
		$this->load->view('administrator/admin_template',$data);
	}
	
	public function edit($id){
	   $data["message"]="";
	   	$data["permissions"]=$this->Admin_model->user_role_permission();

	   $data['list']=$this->db->get_where("user_roles",array("id"=>$id))->row();
	   $data["main_content"]="edit_user_role";
		$this->load->view('administrator/admin_template',$data);
	}
	
	public function store(){
	    
	    $this->form_validation->set_rules('role', 'role', 'trim|required');
	   
            if ($this->form_validation->run() == FALSE) {
        	     $data["message"]="Please Fill the required Data";
           } 
            
             else {
                
                
        $aa = "";
       
        $check = true;
        $id = $this->input->post('id');
        $role = $this->input->post('role');
        $edallow = $this->input->post('edallow');
        $template = $this->input->post('template');
        $permission =  $this->input->post('permission');
        $submenu =  $this->input->post('submenu');

        // Header Menu
      
       
        for ($i=0;$i<count($permission);$i++) {
        if ( $i < count($permission)-1)
            {
              $aa .= $permission[$i].",";
            }
        else {

              $aa.=$permission[$i];

             }
        }
        
         // submenu
        
         $sa = "";
          for ($i=0;$i<count($submenu);$i++) {
        if ( $i < count($submenu)-1)
            {
              $sa .= $submenu[$i].",";
            }
        else {

              $sa.=$submenu[$i];

             }
        }
        

        $data = array(
            'role'=>$role,
            'edallow'=>$edallow,
            'template'=>$template,
            'permission'=>$aa,
            'submenu'=>$sa
            );
        $query = $this->db->insert('user_roles',$data);
        if($query)           
            
           {
                
                $data["message"]="successfully Save";
            }
            else
            {
               $data["message"]="Fail To Save";

            }

        }
            
            $data["permissions"]=$this->Admin_model->user_role_permission();
             $data["main_content"]="create_user_role";
    		$this->load->view('administrator/admin_template',$data);
	}

	
		public function update($id)
		{
		    
	     $this->form_validation->set_rules('role', 'role', 'trim|required');
	   
             if ($this->form_validation->run() == FALSE) {
                
        	     $data["message"]="Please Fill the required Data";
           } 
            
              else {
                
               $aa = "";
    $check = true;
    $role = $this->input->post('role');
    $edallow = $this->input->post('edallow');
   $template = $this->input->post('template');
    $permission =  $this->input->post('permission');
    $submenu =  $this->input->post('submenu');

    for ($i=0;$i<count($permission);$i++) {
    if ( $i < count($permission)-1)
    {
        $aa .= $permission[$i].",";
    }
    else {

        $aa.=$permission[$i];

    }
    }
    
     // submenu
        
         $sa = "";
          for ($i=0;$i<count($submenu);$i++) {
        if ( $i < count($submenu)-1)
            {
              $sa .= $submenu[$i].",";
            }
        else {

              $sa.=$submenu[$i];

             }
        }


    $data = array(
        'role'=>$role,
        'edallow'=>$edallow,
        'template'=>$template,
        'permission'=>$aa,
        'submenu'=>$sa

        );
        $this->db->where("id",$id);
        $query=$this->db->update('user_roles',$data);
                        
            if($query){
                
                $data["message"]="successfully Save";
            }
            else
            {
               $data["message"]="Fail To Save";

            }

        }
    $data["main_content"]="edit_user_role";
    $data['list']=$this->db->get_where("user_roles",array("id"=>$id))->row();
	   	$data["permissions"]=$this->Admin_model->user_role_permission();
   	$this->load->view('administrator/admin_template',$data);
	}
	
	
	function delete($id){
	     $this->db->where("id",$id);
            $qry=$this->db->delete("user_roles");
            $this->index();
	}
	
	
	
}
