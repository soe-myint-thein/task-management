<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {

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
		
	}

	public function index()
	{
		$user_type=get_cookie("user_type");
	    $data["main_content"]="dashboard";
	   // $data["total_tasks"]=$this->Admin_model->get_tottalcount('students');
	   // $data["total_payment"]=$this->Admin_model->get_tottalcount('teachers');
		$this->load->view('administrator/admin_template',$data);
	}

	
		public function profile()
	{
	    $data["main_content"]="dashboard";
		$this->load->view('administrator/admin_template',$data);
	}

	function login_form(){
		$data["message"]="";
       // $data["settings"]=$this->db->get("branches")->row();
        $this->load->view("administrator/login_form",$data);
	}


    function register()
    {
        $data["message"]="";
        $data["settings"]=$this->db->get("branches")->row();
        $this->load->view("administrator/register_form",$data);
    }//
	

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
            set_cookie('user_type',$r->user_type,time() +3600);
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
	
	public function account_setting()
	{    $data["message"]="";
	    $data["main_content"]="account_setting_form";
		$this->load->view('administrator/admin_template',$data);
	}
	
	
	

	
	
function change_account_setting()
{

$username=get_cookie("email");

  $oldpass=md5($this->input->post('opassword'));
  $password=md5($this->input->post('password'));
  $cpassword=md5($this->input->post('cpassword'));

  $data=array(
    'password'=>$password
  );
  $check=$this->Admin_model->check_account($username,$oldpass);

//	echo $check->num_rows();

  if($check->num_rows()==1)
  {



    $this->db->where('email',$username);
    $query=$this->db->update('users',$data);

    if($query)
    {
      $data["message"]="Successfully Changed";
    }
    else
    {
      $data["message"]="Fail to change";
    }
  }


  else
  {
    $data["message"]="Enter Correct Old Password";
  }


    $data["main_content"]="account_setting_form";
		$this->load->view('administrator/admin_template',$data);


}

	
		public function logout()
	{
	    	$this->load->helper('cookie');
				delete_cookie("admin_cookie");
				delete_cookie("name");
				delete_cookie("email");
				delete_cookie("user_role");
				delete_cookie("edallow");
				delete_cookie("permission");
				delete_cookie("submenu");
				delete_cookie("pc");

				redirect("Administrator/login_form");
	}
	
}
