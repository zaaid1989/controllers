<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->is_logged_in();
    }
	public function index()
	{
		$test_job = $this->db->query("SELECT * FROM tbl_crons WHERE date='".date('Y-m-d')."'");
		$job_run = $test_job->result_array();
		
		//******************* CODE FOR PRODUCT COUNT (start)***********************\\\\\\\\\\\
		$q 			=	$this->db->query("SELECT * FROM tbl_product_count WHERE date='".date('Y-m-d')."'");
		$today_product_count	=	$q->result_array();
		
		if (sizeof($today_product_count)==0) {
			$q 			=	$this->db->query("SELECT pk_product_id FROM tbl_products");
			$products	=	$q->result_array();
			
			foreach ($products AS $product) {
				$q = $this->db->query("SELECT * FROM tbl_instruments WHERE fk_product_id = '".$product['pk_product_id']."'");
				$equipments = $q->result_array();
				$total_equipment = sizeof($equipments);
				$q = $this->db->query("INSERT INTO tbl_product_count SET 
										fk_product_id 	= 	'".$product['pk_product_id']."', 
										product_count	=	'".$total_equipment."',
										date			= 	'".date('Y-m-d')."'
										");
			}
		}
		//******************* CODE FOR PRODUCT COUNT (finish)***********************\\\\\\\\\\\
		
		//if (sizeof($job_run)==0) { 
		/////// Code to change 8 days old explanation calls Pending to Charged
		$previous_week_date = date('Y-m-d',strtotime("-8 days"));
		$q = $this->db->query("SELECT * FROM tbl_fine WHERE date<='".$previous_week_date."' AND software_generated='1' AND status='Pending'"); 
		$wes = $q->result_array();
		foreach ($wes AS $fine) {
			$c = $this->db->query("UPDATE tbl_fine SET status='Charged' WHERE pk_fine_id='".$fine['pk_fine_id']."'");
		}
		
		//// Code at 8 am , it will not run on sundays (if we run it on sunday for checking saturday dvrs, possiblity that no one will open the system and dvrs will remain unchecked) and on monday it will consider it saturday.
			if (date('H') >= 8 ) { 
				// SCRIPT HERE
				if (date('N') != 7) {
					/*
					$query = "INSERT INTO tbl_tagg SET x=0.1,y=0.2,text='cron'";
					$dbres = $this->db->query($query);*/
					$previous_date = date('Y-m-d',strtotime("-1 days"));
					$td			 = date('Y-m-d');
					if (date('N') == 1) { $previous_date = date('Y-m-d',strtotime("-2 days"));  }
					$q = $this->db->query("SELECT * FROM user WHERE userrole IN('FSE','Salesman','Supervisor') AND delete_status='0'");
					$users = $q->result_array();
					foreach ($users AS $user) {
						// if user is on leave then continue
						$q = $this->db->query("SELECT * FROM `tbl_leaves` WHERE fk_employee_id = '".$user['id']."' ORDER BY application_date DESC LIMIT 3");
						$lvs = $q->result_array();
						$absent_yes = 0;
						$absent_today = 0;
						if (sizeof($lvs>0)) {
							foreach ($lvs AS $leave) {
							if ( strtotime($leave['start_date']) <= strtotime($previous_date) && strtotime($leave['end_date']) >= strtotime($previous_date) ) {
								$absent_yes = 1; // yesterday for dvr
							}
							if ( strtotime($leave['start_date']) <= strtotime($td) && strtotime($leave['end_date']) >= strtotime($td) ) {
								$absent_today = 1; // today for vs
							}
							}
						}
						
						$q = $this->db->query("SELECT * FROM tbl_dvr WHERE fk_engineer_id ='".$user['id']."' AND date='".$previous_date."'");
						$dvrs = $q->result_array();
						
						$q = $this->db->query("SELECT * FROM tbl_vs WHERE fk_engineer_id ='".$user['id']."' AND date='".$td."'");
						$vss = $q->result_array();
						
						$q = $this->db->query("SELECT * FROM tbl_fine WHERE fk_employee_id ='".$user['id']."' AND date='".$previous_date."' AND software_generated='1'");
						$expcalls = $q->result_array();
						
						$q = $this->db->query("SELECT * FROM tbl_fine_code WHERE pk_fine_code_id ='1'");
						$fa = $q->result_array();
						
						$count_dvr = sizeof($dvrs);
						$count_vs = sizeof($vss);
						
						if ($absent_yes == 1) $count_dvr = 1;
						if ($absent_today == 1) $count_vs = 1;
						if (($count_dvr ==0 || $count_vs==0)  && sizeof($expcalls)==0) { // no explanation call and either dvr or vs not entered
							$str = ""; // for explanation of fine generated
							if ($count_dvr ==0) $str .= "DVR ($previous_date), ";
							if ($count_vs ==0) $str .= "VS ($td) ";
							$this->load->model("profile_model");
							$query="insert  into `tbl_fine` SET 	
								  `fk_employee_id`				='".$user['id']."',
								  `fk_fine_code_id`				='1',
								  `amount`						='".$fa[0]['amount']."',
								  `comments`					='".urlencode('System generated call')."',
								  `status`						='Pending',
								  `software_generated`			='1',
								  `z`							='".$str."',
								  `date`						='".$previous_date."'";
								  $dbres = $this->db->query($query);
								  
								  $name = $user['first_name'];
								  $email		=	'info@mypmaonline.com';
								  
								  $fine = 'No DVR/VS submitted online';
								
								  $amount		=	$fa[0]['amount'];
								  $comments		=	'Enter your comments against the explanation calls within 7 working days if not it will be automatically charged.';
								  $to 			=   $user['company_email'];
								  //$to = 'zaaid@rozesolutions.com';
								  //$cc = 'sajjad.j@medialinkers.com';
									
								
								$subject ="System generated explanation call (No DVR/VS Submitted Online)";
								
								$headers  = "MIME-Version: 1.0\r\n";
								$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
								$headers.="From: $email \r\n";
								//$headers .= "CC: $cc\r\n";
								//$headers .= "BCC: hidden@special.com\r\n";
								$headers.="Return-Path: $email \r\n";
								
								$body = '<table width="650" border="0">
										   <tr bgcolor="#BDD5DF">
											<td colspan="2">New Explanation Call Added. Details are below:</td>
										  </tr>				  
										  <tr bgcolor="#D5D5D5">
											<td width="110">Employee Name:</td>
											<td width="265">'.$name.'</td>
										  </tr>
										   <tr bgcolor="#D5D5D5">
											<td>Explanation:</td>
											<td>'.$fine.'</td>
										  </tr>
										  <tr bgcolor="#D5D5D5">
											<td>Amount:</td>
											<td>'.$amount.'</td>
										  </tr>				 
										  <tr bgcolor="#D5D5D5">
											<td valign="top">Comments:</td>
											<td valign="top">'.$comments.'</td>
										  </tr>				  
										</table>';
								mail($to, $subject, $body, $headers);
								$to = "zaaid@rozesolutions.com";
								//mail($to, $subject, $body, $headers);
						}
					}
					$b = $this->db->query("INSERT INTO tbl_crons SET cron_name='dvr_entry', date='".date('Y-m-d h:i:s')."'");
				}
			} 
		//}
		$this->load->view('mainpage');
		
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
	public function logout() {
        $this->session->sess_destroy();
        //delete_cookie("email_id");
        redirect(site_url());
    }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */