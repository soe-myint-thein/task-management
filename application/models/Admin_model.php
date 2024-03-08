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

	

	
	function getappointmentNoti()
	{
	    $query=$this->db->query("SELECT * FROM tbl_appointment WHERE date=CURDATE()");
        return $query->num_rows();
	}
	
	function getunreadtaskreport()
	{
	    
	    $staff_id=get_cookie('id');
	    $query=$this->db->query("SELECT * FROM tbl_task_report WHERE !FIND_IN_SET($staff_id,read_staff) AND department !='Account'");
        return $query->num_rows();
	}
	
	function getunreadpersonalreport($department)
	{
	    
	    $staff_id=get_cookie('id');
	    $query=$this->db->query("SELECT * FROM tbl_personal_daily_report WHERE !FIND_IN_SET($staff_id,read_staff) AND department='$department'");
        return $query->num_rows();
     
	}
	
	
	function getunreadeachtaskreport($taskid)
	{
	    
	    $staff_id=get_cookie('id');
	    $query=$this->db->query("SELECT * FROM tbl_task_report WHERE !FIND_IN_SET($staff_id,read_staff) AND task_id='$taskid'");
        return $query->num_rows();
	}
	
	
	function getunreadeachreport($projectid)
	{
	    
	    $staff_id=get_cookie('id');
	    $query=$this->db->query("SELECT * FROM tbl_report WHERE !FIND_IN_SET($staff_id,read_staff)  AND project_id='$projectid'");
        return $query->num_rows();
	}

function get_submenu($id)
{
$submenu=explode(',',get_cookie("submenu"));
$this->db->where('status',1);
$this->db->where('header_menu',$id);
$query=$this->db->where_in('id', $submenu)->get("submenu");

return $query;
}
	
	function getunreadreport()
	{
	    $staff_id=get_cookie('id');
	    $query=$this->db->query("SELECT * FROM tbl_report WHERE !FIND_IN_SET($staff_id,read_staff)");
        return $query->num_rows();
	}
	
	
	function getunreadsurvey()
	{
	    $staff_id=get_cookie('id');
	    $query=$this->db->query("SELECT * FROM tbl_survey WHERE !FIND_IN_SET($staff_id,read_staff)");
        return $query->num_rows();
	}
	
	function getunreaddailyreport()
	{
	    $staff_id=get_cookie('id');
	    $query=$this->db->query("SELECT * FROM tbl_personal_daily_report WHERE !FIND_IN_SET($staff_id,read_staff)");
        return $query->num_rows();
	}
	
  public function updateStatusforNotice($notification_id, $staff_id) {
        $this->db->where('notification_id', $notification_id);
        $this->db->where('staff_id', $staff_id);
        $q = $this->db->get('read_notification');
        if ($q->num_rows() > 0) {
            return true;
        } else {
            $data = array(
                'notification_id' => $notification_id,
                'staff_id' => $staff_id
            );
            $this->db->insert('read_notification', $data);
        }
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