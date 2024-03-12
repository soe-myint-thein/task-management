<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin_model extends CI_Model{

//date
	function grab_date()
	{
		$datestring = " %Y-%m-%d";
		$date= mdate($datestring);
		return $date;
		}
	function grab_time()
	{
		$timestring = "%h:%i %a";
		$time= mdate($timestring);
		return $time;
	}//
	
	
	
	public function user_role_permission()
	{
		$query = $this->db->query("SELECT * FROM menu WHERE header_menu = 1 ORDER BY no ASC");
		return $query;
	}

	

	  
function grab_payment_statuss()
{
        $this->db->group_by("payment_status");
        $this->db->order_by("payment_status");
        $query = $this->db->get("tasks");
        if($query->num_rows()<=0)
        {
            $tags['']="..Select..";
        }
        $tags['']="..select..";
        foreach($query->result() as $row):
            $tags[$row->payment_status]=$row->payment_status;
        endforeach;
        return $tags;
}


function grab_payment_types(){
 		/*$this->db->group_by("payment_type");
        $this->db->order_by("payment_type");
        $query = $this->db->get("payments");
        if($query->num_rows()<=0)
        {
            $tags['']="..Select..";
        }
        $tags['']="..select..";
        foreach($query->result() as $row):
            $tags[$row->payment_type]=$row->payment_type;
        endforeach;*/
        $tags["cash"]="cash";
        $tags["bank"]="bank";
        return $tags;	
}


function grab_task_types()
{
        $this->db->distinct("task_type");
        $this->db->order_by("task_type");
        $query = $this->db->get("tasks");
        if($query->num_rows()<=0)
        {
            $tags['']="..Select..";
        }
        $tags['']="..select..";
        foreach($query->result() as $row):
            $tags[$row->task_type]=$row->task_type;
        endforeach;
        return $tags;
}




function grab_task_statuss()
{
        $this->db->group_by("task_status");
        $this->db->order_by("task_status");
        $query = $this->db->get("tasks");
        if($query->num_rows()<=0)
        {
            $tags['']="..Select..";
        }
        $tags['']="..select..";
        foreach($query->result() as $row):
            $tags[$row->task_status]=$row->task_status;
        endforeach;
        return $tags;
}



function grab_done_task()
{
        $this->db->group_by("id");
        $this->db->order_by("id");
        $query = $this->db->get_where("tasks",array("task_status"=>"done"));
        if($query->num_rows()<=0)
        {
            $tags['']="..Select..";
        }
        $tags['']="..select..";
        foreach($query->result() as $row):
            $tags[$row->id]=$row->task_name;
        endforeach;
        return $tags;
}

function grab_undone_task()
{
        $this->db->group_by("id");
        $this->db->order_by("id");
        $query = $this->db->get_where("tasks",array("task_status !="=>"done"));
        if($query->num_rows()<=0)
        {
            $tags['']="..Select..";
        }
        $tags['']="..select..";
        foreach($query->result() as $row):
            $tags[$row->id]=$row->task_name;
        endforeach;
        return $tags;
}



function grab_assigned_task()
{
        $this->db->select("tasks.task_name,assigned_tasks.*");
       
        $this->db->join("tasks","assigned_tasks.task_id=tasks.id");
        $query = $this->db->get_where("assigned_tasks",array("assigned_tasks.task_status"=>"done"));
        if($query->num_rows()<=0)
        {
            $tags['']="..Select..";
        }
        $tags['']="..select..";
        foreach($query->result() as $row):
            $tags[$row->id]=$row->task_name;
        endforeach;
        return $tags;
}

function get_submenu($id)
{
$submenu=explode(',',get_cookie("submenu"));
$this->db->where('status',1);
$this->db->where('header_menu',$id);
$query=$this->db->where_in('id', $submenu)->get("submenu");

return $query;
}
	

    
    
function grab_userrole()
{
		$this->db->group_by("role");
		$this->db->order_by("role");
		$query = $this->db->get("user_roles");
		if($query->num_rows()<=0)
		{
			$tags['']="..Select..";
		}
		$tags['']="..select..";
		foreach($query->result() as $row):
			$tags[$row->id]=$row->role;
		endforeach;
		return $tags;
}

    

/*Account Check*/
function check_account($username,$oldpass)
{

//$this->db->where("computer_name",gethostbyaddr($this->input->ip_address()));
$check=$this->db->get_where('users',array('email'=>$username,'password'=>$oldpass));
return $check;

}

	
	
	/*image upload and resize*/

	function img_upload($files,$folder)
		{
			
		ini_set('upload_max_filesize','30M');
		ini_set('post_max_size','30M');

			if(!$files)
			{
				return false;
			}
			
			else{					
				$path='./uploads/'.$folder.'/';
				
				//$config['file_ext']	=
				$config['overwrite']=TRUE;
			 	$config['upload_path']=$path;	
			 $config['remove_spaces'] = TRUE;	

			   	$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG|JPEG|GIF|xlsx|pdf|docx|doc|pptx';				   			
			
			 
				
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload($files))
					{
												
						echo $this->upload->display_errors();
						exit;
						
					}

					else
					{							
						$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
                    $file_name = $upload_data['file_name'];
						 return $file_name;

					}
				}
		}
		


		/*Files upload and resize*/

	function file_upload($files,$folder)
		{
			
		ini_set('upload_max_filesize','30M');
		ini_set('post_max_size','30M');

			if(!$files)
			{
				return false;
			}
			
			else{					
				$path='./uploads/'.$folder.'/';
				
				//$config['file_ext']	=
				$config['overwrite']=TRUE;
			 	$config['upload_path']=$path;	
			 $config['remove_spaces'] = TRUE;	

			   	$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG|JPEG|GIF|xlsx|pdf|docx|doc|pptx';				   			
			
			 
				
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload($files))
					{
												
						echo $this->upload->display_errors();
						exit;
						
					}

					else
					{							
						$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
                    $file_name = $upload_data['file_name'];
						 return $file_name;

					}
				}
		}
		
		
		###
		
		
	function video_upload($files,$folder)
		{
			
		ini_set('upload_max_filesize','300M');
		ini_set('post_max_size','300M');

			if(!$files)
			{
				return false;
			}
			
			else{					
				$path='./uploads/'.$folder.'/';
				
				//$config['file_ext']	=
				$config['overwrite']=TRUE;
			 	$config['upload_path']=$path;	
			 	$config['remove_spaces'] = TRUE;	

			   	$config['allowed_types'] = 'mp4|ogg';				   			
			
			 
				
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload($files))
					{
												
						echo $this->upload->display_errors();
						exit;
						
					}

					else
					{							
						
						 return true;

					}
				}
		}
		###
		
			

} 

/*site_model end here*/