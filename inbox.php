<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inbox extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
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
	public function index($offset)
	{
		$userid=$this->session->userdata('userid');
		$this->load->model('inbox_model');
		$messagedata = $this->inbox_model->mymessages($userid,$offset);
		$total = $this->db->query("SELECT * FROM messages  WHERE `to` = '".$userid."' and trashed ='0'");
		$total_record=$total->num_rows();
        $this->load->view('inbox', array("messagedata" => $messagedata,
										 "titlearray" =>array(
										 					  "title"=>'Inbox',
										 					  "total_record"=>$total_record
															  )
		));
	}
	// Retive All Sent Messages
	public function sentmessages($offset)
	{
		$userid=$this->session->userdata('userid');
		$this->load->model('inbox_model');
		$messagedata = $this->inbox_model->sentmessages($userid,$offset);
		$total = $this->db->query("SELECT * FROM messages  WHERE `from` = '".$userid."' and trashed ='0'");
		$total_record=$total->num_rows();
        $this->load->view('inbox', array("messagedata" => $messagedata,
										 "titlearray" =>array("title"=>'Sent Messages',
										 					  "total_record"=>$total_record
															  )
		));
	}
	// Retive All Trashed Messages
	public function trash($offset)
	{
		$userid=$this->session->userdata('userid');
		$this->load->model('inbox_model');
		$messagedata = $this->inbox_model->trashed_messages($userid,$offset);
		$total = $this->db->query("SELECT * FROM messages  WHERE `to` = '".$userid."' and trashed ='1'");
		$total_record=$total->num_rows();
        $this->load->view('inbox', array("messagedata" => $messagedata,
										 "titlearray" =>array("title"=>'Trashed Messages',
										 					  "total_record"=>$total_record
															  )
		));
	}
	public function message_notification()
	{
		$userid=$this->session->userdata('userid');
		$this->load->model('inbox_model');
		$messagedata = $this->inbox_model->message_count();
		echo $messagedata;
	}
	
	// Delete Compose Message.
	public function compose()
	{
        $this->load->view('compose_message');
	}
	// Delete Single Message.
	public function delete($id)
	{
        $this->load->model('inbox_model');
		$messagedata = $this->inbox_model->del_function($id);
		redirect(site_url() . 'inbox/index/0?msg_delmsg=success');
	}
	// Delete The Selected Messages.
	public function delete_all()
	{
        foreach($_POST['messagename'] as $del_mes=>$value)
		{
			$this->db->where('id', $value);
		  	$this->db->update('messages', array('trashed' => '1'));
		}
		redirect(site_url() . 'inbox/index/0?msg_delmsgSlect=success');
	}
	// Mark The Selected Messages As Read.
	public function markasread()
	{
        foreach($_POST['messagename'] as $del_mes=>$value)
		{
			$this->db->where('id', $value);
		  	$this->db->update('messages', array('read' => '1'));
		}
		redirect(site_url() . 'inbox/index/0?msg_markSlectRed=success');
	}
	
	// Search Messages
	public function search_message($offset)
	{
		$searchmessage=$this->input->post('searchmessage');
		$userid=$this->session->userdata('userid');
		$this->load->model('inbox_model');
		$messagedata = $this->inbox_model->search_messages($searchmessage,$offset);
		$total = $this->db->query("SELECT * FROM messages  WHERE `subject` like '%".$searchmessage."%' OR `text` like '%".$searchmessage."%' order by id DESC");
		$total_record=$total->num_rows();
		//echo $total_record;exit;
        $this->load->view('inbox', array("messagedata" => $messagedata,
										 "titlearray" =>array("title"=>'Search Results',
										 					  "total_record"=>$total_record)
		));
	}
	// Retive One  Message
	public function message($id)
	{
		$this->load->model('inbox_model');
		$messagedata = $this->inbox_model->single_message($id);
        $this->load->view('single_message', array("messagedata" => $messagedata));
	}
	// Send Message through Mail fucntion
	public function sendmessage()
	{
		$data = array(
                'to' 			=>  $_POST['to'],
                'subject'  		=>  $_POST['subject'],
                'message'		=>  $_POST['message'],
				'files'			=>  $_FILES['files'],
                'from'			=>  $this->session->userdata('userid')
            );
		$this->load->model('inbox_model');
		$messagedata = $this->inbox_model->send_message($data);
		redirect(site_url() . 'inbox/index/0');
	}
	
}

/* End of file inbox.php */
/* Location: ./application/controllers/inbox.php */