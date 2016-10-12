<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Csa extends CI_Controller {

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
	
	public function kits()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("datatables/script/datatable.js","datatables/datatables.min.js","datatables/plugins/bootstrap/datatables.bootstrap.js","jquery.dataTables.columnFilter.js");
			$script['script_to_load']=array("table-datatables-managed.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/kits',$js);
	}
	
	public function order_entry()
	{
		if($this->session->userdata('username')!='checker')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("bootstrap-datepicker/js/bootstrap-datepicker.js","select2new/version402/select2.full.min.js","bootstrap-fileinput/bootstrap-fileinput.js");
			$script['script_to_load']=array("components-select2.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/order_entry',$js);
	}
	
	public function forecastorder_entry()
	{
		if($this->session->userdata('username')!='checker')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("bootstrap-datepicker/js/bootstrap-datepicker.js","select2new/version402/select2.full.min.js","autosize/autosize.min.js","bootstrap-fileinput/bootstrap-fileinput.js");
			$script['script_to_load']=array("components-select2.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/forecastorder_entry',$js);
	}
	
	public function order_view()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("datatables/script/datatable.js","datatables/datatables.min.js","datatables/plugins/bootstrap/datatables.bootstrap.js","jquery.dataTables.columnFilter.js");
			$script['script_to_load']=array("table-datatables-managed.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/order_view',$js);
	}
	
	public function create_invoice()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("bootstrap-datepicker/js/bootstrap-datepicker.js","select2new/version402/select2.full.min.js");
			$script['script_to_load']=array("components-select2.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/create_invoice',$js);
	}
	
	public function view_invoice()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("datatables/script/datatable.js","datatables/datatables.min.js","datatables/plugins/bootstrap/datatables.bootstrap.js","jquery.dataTables.columnFilter.js");
			$script['script_to_load']=array("table-datatables-managed.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/view_invoice',$js);
	}
	
	public function add_kitprice()
	{
		if($this->session->userdata('username')!='checker')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("select2new/version402/select2.full.min.js");
			$script['script_to_load']=array("components-select2.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/add_kitprice',$js);
	}
	
	public function create_dc()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("select2new/version402/select2.full.min.js","bootstrap-datepicker/js/bootstrap-datepicker.js","jquery-ui/jquery-ui.min.js");
			$script['script_to_load']=array("components-select2.min.js","ui-modals.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/create_dc',$js);
	}
	
	public function view_dc()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("datatables/script/datatable.js","datatables/datatables.min.js","datatables/plugins/bootstrap/datatables.bootstrap.js","jquery.dataTables.columnFilter.js");
			$script['script_to_load']=array("table-datatables-managed.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/view_dc',$js);
	}
	
}