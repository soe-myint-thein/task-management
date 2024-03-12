<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payouts extends CI_Controller {

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
		$this->load->model('Payout_model');


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
	    $data["main_content"]="payouts";
	    $data["lists"]= $this->Payout_model->getall();
		$this->load->view('administrator/admin_template',$data);
	}
	
	public function create(){
	   $data["main_content"]="create_payouts";
	   		$data["payment_types"]= $this->Admin_model->grab_payment_types();
	   		$data["assigned_task"]= $this->Admin_model->grab_assigned_task();

	   $data["message"]="";
		$this->load->view('administrator/admin_template',$data);
	}
	
	public function edit($id){
	   $data["message"]="";
	$data["payment_types"]= $this->Admin_model->grab_payment_types();
	   		$data["assigned_task"]= $this->Admin_model->grab_assigned_task();

	   $data['list']=$this->db->get_where("payouts",array("assign_task_id"=>$id))->row();
	   $data["main_content"]="edit_payouts";
		$this->load->view('administrator/admin_template',$data);
	}
	
	public function store(){
	    
	 	 $this->form_validation->set_rules('task_id', 'task_id', 'trim|required');
	    $this->form_validation->set_rules('amount', 'amount', 'trim|required');
	    $this->form_validation->set_rules('payment_ref', 'payment_ref', 'trim|required');
	    $this->form_validation->set_rules('payment_type', 'payment_type', 'trim|required');
	    $this->form_validation->set_rules('date', 'date', 'trim|required');
	   
            if ($this->form_validation->run() == FALSE) {
                
        	     $data["message"]="Please Fill the required Data";
           } 
            
             else {
                
                 $data = array(
                'assign_task_id' => $this->input->post('assign_task_id'),
                'amount' => $this->input->post('amount'),
                'payment_ref' => $this->input->post('payment_ref'),
                'payment_type' => $this->input->post('payment_type'),
                'paid_by' => $this->input->post('paid_by'),
                'received_by' => $this->input->post('received_by'),
                'date' => $this->input->post('date')
                );

            
            $qry=$this->db->insert("payouts",$data);	
            
            
            if($qry){
                
                $data["message"]="successfully Save";
            }
            else
            {
               $data["message"]="Fail To Save";

            }

        }
		$data["payment_types"]= $this->Admin_model->grab_payment_types();
	   		$data["assigned_task"]= $this->Admin_model->grab_assigned_task();

             $data["main_content"]="create_payouts";
    		$this->load->view('administrator/admin_template',$data);
	}
	
		public function update($id){
 		 $this->form_validation->set_rules('task_id', 'task_id', 'trim|required');
	    $this->form_validation->set_rules('amount', 'amount', 'trim|required');
	    $this->form_validation->set_rules('payment_ref', 'payment_ref', 'trim|required');
	    $this->form_validation->set_rules('payment_type', 'payment_type', 'trim|required');
	    $this->form_validation->set_rules('date', 'date', 'trim|required');
	   
            if ($this->form_validation->run() == FALSE) {
                
        	     $data["message"]="Please Fill the required Data";
           } 
            
             else {
                
                 $data = array(
                'assign_task_id' => $this->input->post('assign_task_id'),
                'amount' => $this->input->post('amount'),
                'payment_ref' => $this->input->post('payment_ref'),
                'payment_type' => $this->input->post('payment_type'),
                'paid_by' => $this->input->post('paid_by'),
                'received_by' => $this->input->post('received_by'),
                'date' => $this->input->post('date')
                );

            $this->db->where("assign_task_id",$id);
            $qry=$this->db->update("payouts",$data);	
            
            
            if($qry){
                
                $data["message"]="successfully Save";
            }
            else
            {
               $data["message"]="Fail To Save";

            }

        }
            
        $data["main_content"]="edit_payouts";	
	$data["payment_types"]= $this->Admin_model->grab_payment_types();
	   		$data["assigned_task"]= $this->Admin_model->grab_assigned_task();

        $data['list']=$this->db->get_where("payouts",array("assign_task_id"=>$id))->row();
    	$this->load->view('administrator/admin_template',$data);
	}
	
	
	function delete($id){
	     $this->db->where("assign_task_id",$id);
            $qry=$this->db->delete("payouts");
            $this->index();
	}
	
	
	
}
