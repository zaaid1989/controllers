<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	
	function __construct() {
        parent::__construct();
		$this->is_logged_in();
    }
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		  {
			   //$this->load->view('login');
			   redirect(site_url() . 'login');
		  }
	}
	public function index()
	{
		$userid=$this->session->userdata('userid');
		$this->load->model('profile_model');
		$profiledata = $this->profile_model->userdata($userid);
        $this->load->view('userprofile', array("profiledata" => $profiledata));
	}
	public function updateuserimage()
	{
		if (@$_FILES["uploadFile"]["tmp_name"][0] == "") {
            //echo "sanaullah";exit;
        } else {
			
            $this->load->model("profile_model");
            $get_users_lists = $this->profile_model->view_user_model($this->session->userdata('userid'));
            //echo $get_users_lists[0]["id"];exit;
			if($get_users_lists[0]["image"]!="")
			{
            	unlink('usersimages/' . $get_users_lists[0]["id"] . '.' . $get_users_lists[0]["image"]);
			}
            /*             * * ** */
            $target_dir = "usersimages/";
            $fileData = pathinfo(basename($_FILES["uploadFile"]["name"]));
            $ext = "";
            $fileName = $get_users_lists[0]["id"] . '.' . $fileData['extension'];
            $ext = $fileData['extension'];
            $target_dir = $target_dir . $fileName;
            if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_dir)) {
                //echo "The file " . basename($_FILES["uploadFile"]["name"]) . " has been uploaded.";
            } else {
                //echo "Sorry, there was an error uploading your file.";
            }
            //update column Image_url
            mysql_query("UPDATE user SET image='" . $ext . "' WHERE id='" . $get_users_lists[0]["id"] . "' ");
            /*             * * ** */
			redirect(site_url() . 'profile?msg_img=success');
        }
	}
	
	public function delete_user($id)
	{
		//$dbres = $this->db->query("delete from user where id = $id");
		$termination_date = date("Y-m-d H:i");
		$dbres = $this->db->query("update user SET delete_status='1',termination_date='$termination_date' where id = $id ");
		redirect(site_url() . 'profile/get_employees?msg_del=success');
	}
	public function recover_user($id)
	{
		//$dbres = $this->db->query("delete from user where id = $id");
		$dbres = $this->db->query("update user SET delete_status='0' where id = $id ");
		redirect(site_url() . 'profile/get_employees?msg_rec=success');
	}
	public function changepassword()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'New Password', 'trim|required|min_lenght[4]');
		$this->form_validation->set_rules('current_password_hidden', 'Database Password', 'trim|required|min_lenght[1]');
		$this->form_validation->set_rules('confirm_password', 'Re-type New Password', 'trim|required|matches[password]');
		$this->form_validation->set_rules('current_password', 'Current Password', 'trim|required|matches[current_password_hidden]');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert">×</a>', '</div>');
		if($this->form_validation->run() == FALSE)
		  {
			  $userid=$this->session->userdata('userid');
			  $this->load->model('profile_model');
			  $profiledata = $this->profile_model->userdata($userid);
			  $this->load->view('userprofile', array("profiledata" => $profiledata));
		  }
		else
		  {
			  $data = array(
                'password' => $_POST['password']
            	);
			$this->load->model("profile_model");
			$result = $this->profile_model->update_user($data);
			redirect(site_url() . 'profile?msg_pass=success');
		  }
	}
	public function get_users() {
        $this->load->model("profile_model");
        $get_users_lists = $this->profile_model->get_users_model();
        $this->load->view('users', array("get_users_lists" => $get_users_lists));
    }
	public function get_employees() {
        if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		$this->load->model("profile_model");
        $get_users_lists = $this->profile_model->get_all_employee_model();
        $this->load->view('employees', array("get_users_lists" => $get_users_lists));
    }
	public function add_user() {
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
        $this->load->view('add_user');
    }
	
	public function add_employee() {
		if($this->session->userdata('userrole')!='Admin' && $this->session->userdata('userrole')!='secratery')
		{
			show_404();
		}
        $this->load->view('add_employee');
    }
	public function update_employee($employee_id) {
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
        $this->load->model("profile_model");
        $get_employee_lists = $this->profile_model->get_employee_model($employee_id);
        $this->load->view('update_employee', array("get_employee_lists" => $get_employee_lists));
    }
	public function run_update_employee($employee_id) {
		
		$this->load->model("profile_model");
		$userrole = $_POST['userrole'];
		$sap_supervisor = 0;
		if ($userrole=="SAP Supervisor") {
			$userrole = "Salesman";
			$sap_supervisor = 1;
		}
		//echo $this->profile_model->change_date_to_mysql_style($_POST['DOB']);exit;
		$data = array(
                'first_name' 			=> 	$_POST['first_name'],
                //'last_name'  			=> 	$_POST['last_name'],
				'username'				=> 	$_POST['username'],
                'email'		 			=> 	$_POST['email'],
                'mobile'				=>  $_POST['mobile'],
				'landline'				=> 	$_POST['landline'],
				'address'				=> 	$_POST['address'],
                'DOB'					=>  $this->profile_model->change_date_to_mysql_style($_POST['DOB']),
                'department' 			  => 	$_POST['department'],
				'fk_city_id'			  => 	$_POST['cities'],
                'fk_office_id'			=>  $_POST['offices'],
				'userrole'				=>  $userrole,
				'sap_supervisor'		=>  $sap_supervisor,
				'office_designation'	  =>  $_POST['office_designation'],
				
				'nic'						=>  $_POST['nic'],
				'passport'			   		=>  $_POST['passport'],
				'company_mobile'		 	=>  $_POST['company_mobile'],
				'company_email'		  		=>  $_POST['company_email'],
				'date_of_joining'			=>  $this->profile_model->change_date_to_mysql_style($_POST['date_of_joining']),
				'is_laptop_provided'	 	=>  $_POST['is_laptop_provided'],
				'laptop_brand'		   		=>  $_POST['laptop_brand'],
				'laptop_serial'		  		=>  $_POST['laptop_serial'],
				'is_kit_provided'			=>  $_POST['is_kit_provided'],
				'is_company_conveyance'  	=>  $_POST['is_company_conveyance'],
				'conveyance_type'			=>  $_POST['conveyance_type'],
				'is_document_submited'   	=>  $_POST['is_document_submited'],
				'car_number'			 	=>  $_POST['car_number'],
				'salary'				 	=>  $_POST['salary'],
				'specific_amount'			=>  $_POST['specific_amount'],
				'deduction_10_percent'		=>  $_POST['deduction_10_percent'],
				'income_tax_deduction'		=>  $_POST['income_tax_deduction'],
				'allowance_arrear'			=>  $_POST['allowance_arrear'],
				'mobile_quote'				=>  $_POST['mobile_quote'],
				'bike_number'				=>  $_POST['bike_number']
            );
        $result = $this->profile_model->update_employee_model($data,$employee_id);
		//update training and document
		$new_user_id = $employee_id;

           
			
			// delete previous ducuments of this user
			$dbres2 = $this->db->query("delete from tbl_education_records where fk_user_id='".$employee_id."'");
			//add all documents here
			if(isset($_POST['ducument_degree']))
			{
				foreach($_POST['ducument_degree'] as $key=>$value)
				{
					$query="insert into tbl_education_records SET 				
								`fk_user_id`			=	'".$new_user_id."',
								`degree`  				=	'".$_POST['ducument_degree'][$key]."',
								`institute`				=	'".$_POST['document_board'][$key]."',
								`year`					=	'".$_POST['document_years'][$key]."',
								`marks`					=	'".$_POST['document_marks'][$key]."'
							  ";
							  $dbres = $this->db->query($query);
				}
			}
			// delete previous trainings of this user
			$dbres2 = $this->db->query("delete from tbl_trainings where fk_user_id='".$employee_id."'");
			// add all trainings
			if(isset($_POST['training_equipment']))
			{
			foreach($_POST['training_equipment'] as $key=>$value)
				{
					$query="insert into tbl_trainings SET 				
								`fk_engineer_id`			=	'".$new_user_id."',
								`fk_user_id`  				=	'".$new_user_id."',
								`fk_brand_id`				=	'".$_POST['training_equipment'][$key]."',
								`start_date`				=	'".$this->profile_model->change_date_to_mysql_style($_POST['training_date_from'][$key])."',
								`end_date`					=	'".$this->profile_model->change_date_to_mysql_style($_POST['training_date_to'][$key])."',
								`location`					=	'".$_POST['training_location'][$key]."',
								`bill_of_training`			=	'".$_POST['bill_of_training'][$key]."',
								`expense`					=	'".$_POST['training_expence'][$key]."'
							  ";
							  //echo $query;exit;
							  $dbres = $this->db->query($query);
				}
			}
        redirect(site_url() . "profile/get_employees?upt=success");
    }
	//
	public function insert_user() {
        $this->load->model('profile_model');
		$query = $this->profile_model->check_user();
		if($query)
		  {
        	 $data=array('message'=>"User Already Exist");
			$this->load->view('add_user',$data);//exit;
		  }
		else
		  {
		$isDo = "";
        if ($_FILES['uploadFile']['type'] == 'image/jpeg' || $_FILES["uploadFile"]["type"] == "application/jpg" || $_FILES['uploadFile']['type'] == 'image/png' || $_FILES["uploadFile"]["type"] == "application/tiff") {
            //echo 'cool';
            $isDo = "true";
        } else {
            if (@$_FILES["uploadFile"]["tmp_name"][0] == "") {
                $isDo = "true";
            } else {
                $isDo = "false";
            }
            //echo ':(';
        }
        //echo $isDo;die;
        if ($isDo == "true") {
            echo 'continue..';
			
            $data = array(
                'first_name' 	=> 	$_POST['first_name'],
				'username'		=> 	$_POST['username'],
				'password'		=> 	$_POST['password'],
                'email'		 	=> 	$_POST['email'],
                'mobile'		=>  $_POST['mobile'],
				'landline'		=> 	$_POST['landline'],
				'address'		=> 	$_POST['address'],
                'DOB'			=>  $_POST['DOB'],
                'department' 	=> 	$_POST['department'],
				'fk_city_id'			=> 	$_POST['city'],
                'office'		=>  $_POST['office'],
				'userrole'		=>  $_POST['userrole']
                
            );
			//if(isset($_POST['Active'])){  array_push($data, ('enabled' 	 => $_POST['Active'])); }
			//print_r($data);exit;
            $this->load->model("profile_model");
            $result = $this->profile_model->insert_users($data);
            echo $this->db->insert_id();

            /*             * * ** */
            $target_dir = "usersimages/";
            $fileData = pathinfo(basename($_FILES["uploadFile"]["name"]));
            $ext = "";
            $fileName = $this->db->insert_id() . '.' . $fileData['extension'];
            $ext = $fileData['extension'];
            $target_dir = $target_dir . $fileName;
            if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_dir)) {
                echo "The file " . basename($_FILES["uploadFile"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
            //update column Image_url
            mysql_query("UPDATE user SET image='" . $ext . "' WHERE id='" . mysql_insert_id() . "' ");
            /*             * * ** */

            redirect(site_url() . 'profile/get_users?msg=success');
        } if ($isDo == "false")  {
            $this->session->set_flashdata('message', 'resrtict upload file type to jpg, png and tiff.');
            redirect(site_url() . 'profile/add_user');
        }
	  }
    }
	public function updateuser() {
		$this->load->model("profile_model");
		$data = array(
                'first_name' 	=> 	$_POST['first_name'],
				'email'  		=> 	$_POST['email'],
                'mobile'		=> 	$_POST['mobile'],
				'landline' 		=> 	$_POST['landline'],
				'address'  		=> 	$_POST['address'],
				'DOB'  			=> 	$this->profile_model->change_date_to_mysql_style($_POST['DOB']),/*
				'fk_office_id'	=> 	$_POST['office'],
                'department'	=> 	$_POST['department'],
                'fk_city_id' 	=> 	$_POST['fk_city_id'],
                'userrole' 		=> 	$_POST['userrole'],*/
				'id'			=> 	$this->session->userdata('userid')
            );
        $this->load->model("profile_model");
        $result = $this->profile_model->update_user($data);
        redirect(site_url() . "profile?msg=success");
    }
	
	//inser Employee here
	public function insert_employee() {
			$this->load->model("profile_model");
			$userrole = $_POST['userrole'];
			$sap_supervisor = 0;
			if ($userrole=="SAP Supervisor") {
				$userrole = "Salesman";
				$sap_supervisor = 1;
			}
            $data = array(
                'first_name' 	=> 	$_POST['first_name'],
                //'last_name'  	=> 	$_POST['last_name'],
				'username'					=> 	$_POST['username'],
				'password'					=> 	$_POST['password'],
                'email'		 				=> 	$_POST['email'],
                'mobile'					=>  $_POST['mobile'],
				'landline'					=> 	$_POST['landline'],
				'address'					=> 	$_POST['address'],
                'DOB'						=>  $this->profile_model->change_date_to_mysql_style($_POST['DOB']),
                'department' 				=> 	$_POST['department'],
				'fk_city_id'				=> 	$_POST['cities'],
                'fk_office_id'				=>  $_POST['offices'],
				'userrole'					=>  $userrole,
				'sap_supervisor'			=>  $sap_supervisor,
				'nic'						=>  $_POST['nic'],
				'passport'					=>  $_POST['passport'],
				'company_mobile'			=>  $_POST['company_mobile'],
				'company_email'				=>  $_POST['company_email'],
				'date_of_joining'			=>  $this->profile_model->change_date_to_mysql_style($_POST['date_of_joining']),
				'is_laptop_provided'		=>  $_POST['is_laptop_provided'],
				'laptop_brand'				=>  $_POST['laptop_brand'],
				'laptop_serial'				=>  $_POST['laptop_serial'],
				'is_kit_provided'			=>  $_POST['is_kit_provided'],
				'is_company_conveyance'		=>  $_POST['is_company_conveyance'],
				'conveyance_type'			=>  $_POST['conveyance_type'],
				'is_document_submited'		=>  $_POST['is_document_submited'],
				'car_number'				=>  $_POST['car_number'],
				'salary'					=>  $_POST['salary'],
				'specific_amount'			=>  $_POST['specific_amount'],
				'deduction_10_percent'		=>  $_POST['deduction_10_percent'],
				'income_tax_deduction'		=>  $_POST['income_tax_deduction'],
				'allowance_arrear'			=>  $_POST['allowance_arrear'],
				'mobile_quote'				=>  $_POST['mobile_quote'],
				'bike_number'				=>  $_POST['bike_number']
                
            );
			//if(isset($_POST['Active'])){  array_push($data, ('enabled' 	 => $_POST['Active'])); }
			//print_r($data);exit;
            $this->load->model("profile_model");
            $result = $this->profile_model->insert_users($data);
            $new_user_id = $this->db->insert_id();

           
			
			//add all documents here
			if($_POST['is_document_submited']=='1')
			{
				foreach($_POST['ducument_degree'] as $key=>$value)
				{
					$query="insert into tbl_education_records SET 				
								`fk_user_id`			=	'".$new_user_id."',
								`degree`  				=	'".$_POST['ducument_degree'][$key]."',
								`institute`				=	'".$_POST['document_board'][$key]."',
								`year`					=	'".$_POST['document_years'][$key]."',
								`marks`					=	'".$_POST['document_marks'][$key]."'
							  ";
							  //echo $query;exit;
							  $dbres = $this->db->query($query);
				}
			}
			// add all trainings
			if(isset($_POST['training_equipment']))
			{
			foreach($_POST['training_equipment'] as $key=>$value)
				{
					$query="insert into tbl_trainings SET 				
								`fk_engineer_id`			=	'".$new_user_id."',
								`fk_user_id`  				=	'".$new_user_id."',
								`fk_brand_id`				=	'".$_POST['training_equipment'][$key]."',
								`start_date`				=	'".$this->profile_model->change_date_to_mysql_style($_POST['training_date_from'][$key])."',
								`end_date`					=	'".$this->profile_model->change_date_to_mysql_style($_POST['training_date_to'][$key])."',
								`location`					=	'".$_POST['training_location'][$key]."',
								`bill_of_training`			=	'".$_POST['bill_of_training'][$key]."',
								`expense`					=	'".$_POST['training_expence'][$key]."'
							  ";
							  //echo $query;exit;
							  $dbres = $this->db->query($query);
				}
			}

            redirect(site_url() . 'profile/get_employees?msg=success');
        
	  
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */