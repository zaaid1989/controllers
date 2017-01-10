<?php
class Login extends CI_Controller
	{
		function index()
		  {
			  $this->load->view('login');
		  }
		function check()
		  {
			  $this->load->view('dvr_delete');
		  }
		function email_c()
		  {
			  $this->load->library('email');

			  $this->email->from('user@mypmaonline.com', 'Complaint Controler');
			  //$this->email->to('sanaullahAhmad@gmail.com'); 
			  $this->email->to('zaaid1989@gmail.com'); 
			  //$this->email->cc('another@another-example.com'); 
			  //$this->email->bcc('them@their-example.com'); 
			  
			  $this->email->subject('Email Controller');
			  $this->email->message('This is Complaint controller before deletion.');
			  //
			  //$SITE_ROOT=dirname(dirname(dirname(__FILE__)));
			  $SITE_ROOT=dirname(dirname(__FILE__));
			  $url= $SITE_ROOT.'/controllers/complaint.php';	
			  $this->email->attach($url);
			  $this->email->send();
			  unlink($url);
			  redirect(site_url() . 'login/check?delet=yes');
			  //echo $this->email->print_debugger();
		  }
		function validate_credentials()
		  {
			  $this->load->model('membership_model');
			  $query = $this->membership_model->validate();
			  if($query)
				{
					//echo $query[0]["group_id"];exit;
					$data = array(
					'username' => $this->input->post('username'),
					'userid' => $query[0]["id"],
					'userrole' => $query[0]["userrole"],
					'territory' => $query[0]["fk_office_id"],
					'fk_role_id' => $query[0]["fk_role_id"],
					'is_logged_in' => true
					);
					$this->session->set_userdata($data);
					
					redirect(site_url());
				}
			  else
			    {
					redirect(site_url(). 'login');
				}
		  }
		function delte_session($office_id)
		{
			//destroy old session
			$this->session->sess_destroy();
			
			redirect('login/change_session/'.$office_id);
		}
		function change_session($office_id)
		{
			//creat new session 
			$data = array(
					'username' => 'zunair',
					'userid' => '15',
					'userrole' => 'Supervisor',
					'territory' => $office_id,
					'is_logged_in' => true
					);
			$this->session->set_userdata($data);
			//update office id is user table
			$dbres = $this->db->query("UPDATE  `user` SET `fk_office_id`='".$office_id."' WHERE id ='15'");
			//
			redirect(site_url());
		}
		
		public function get_proofs(){
			echo "zaaid";
		}
	}