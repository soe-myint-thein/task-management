<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
     
     function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Admin_model');
        error_reporting(0);
    }
    


    function register()
    {
        $data["message"]="";
        $data["settings"]=$this->db->get("branches")->row();
        $this->load->view("administrator/register_form",$data);
    }//

   


    
    function index()
    {
        $data["message"]="";

        $data["settings"]=$this->db->get("branches")->row();
        $this->load->view("administrator/login_form",$data);
    }//
    
    // doing user login     
    function do_login()
    {
        $username=$this->input->post('username');
        $password=md5($this->input->post("password"));
        $pcname=gethostbyaddr($this->input->ip_address());

        $query=$this->db->query("SELECT users.*,users.id as staff_id,user_roles.* FROM users JOIN user_roles ON users.user_role=user_roles.id  where email='$username' AND password='$password'");
/*      $query=$this->db->query("SELECT user.*,userrole.*,staff.id as staff_id,staff.department FROM user JOIN userrole ON user.user_role=userrole.role JOIN staff ON user.username=staff.username where user.username='$username' AND user.password='$password'");
*/      
                        
        if($query->num_rows()>=1)
        {
            
            $r=$query->row();
            set_cookie('staff_id',$r->staff_id,time() +3600); 
            set_cookie('name',$r->name,time() +3600); 
            set_cookie('email',$r->email,time() +3600); 
            set_cookie('admin_cookie',$username,time() +3600); 
            set_cookie('user_role',$r->user_role,time() +3600);
            set_cookie('edallow',$r->edallow,time() +3600);
            set_cookie('permission',$r->permission,time() +3600);
            set_cookie('submenu',$r->submenu,time() +3600);
            set_cookie('pc',gethostname(),time() +3600);

             redirect("Administrator");
        }       
        else
        {
             redirect("Administrator");
            

        }
        
        
       
        
    }
    
    
    
    
}
