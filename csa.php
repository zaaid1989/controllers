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
	
	public function perm_insert()
	{
		$fk_role_id	= 1; // 1 Admin (Admin),2 Supervisor (Supervisor),3 FSE (FSE),4 Salesman (Salesman),5 Secratery (secratery),6 SAP supervisor (Salesman)
		$page = $_POST['page']; // page link
		$page_title = $_POST['page_title']; // Add, Edit, Delete
		$fk_page_id = $_POST['fk_page_id'];
		$permission = $_POST['permission']; // delete
		$permission_title = $_POST['permission_title']; // Add, Edit, Delete
		$permission_group = $_POST['permission_group']; // Group
		$allowed = 1;
		
		$this->db->query("INSERT INTO `mypmaonl_pma_enterprize`.`tbl_permissions` (`pk_permission_id`, `fk_role_id`, `page`, `fk_page_id`, `permission`, `page_title`, `permission_title`, `permission_group`, `allowed`) VALUES (NULL, $fk_role_id, '$page', $fk_page_id, '$permission', '$page_title', '$permission_title', '$permission_group', $allowed) ON DUPLICATE KEY UPDATE `allowed`= $allowed");
		
		redirect(base_url().'sys/manage_roles?z=success');
	}
	
	public function kit_registration()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("bootstrap-datepicker/js/bootstrap-datepicker.js","select2new/version402/select2.full.min.js","bootstrap-fileinput/bootstrap-fileinput.js");
			$script['script_to_load']=array("components-select2.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/kit_registration',$js);
	}
	
	public function kit_edit()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("bootstrap-datepicker/js/bootstrap-datepicker.js","select2new/version402/select2.full.min.js","bootstrap-fileinput/bootstrap-fileinput.js");
			$script['script_to_load']=array("components-select2.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/kit_edit',$js);
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
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("bootstrap-datepicker/js/bootstrap-datepicker.js","select2new/version402/select2.full.min.js","autosize/autosize.min.js","bootstrap-fileinput/bootstrap-fileinput.js");
			$script['script_to_load']=array("components-select2.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/order_entry',$js);
	}
	
	public function foc_order_entry()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("bootstrap-datepicker/js/bootstrap-datepicker.js","select2new/version402/select2.full.min.js","autosize/autosize.min.js","bootstrap-fileinput/bootstrap-fileinput.js");
			$script['script_to_load']=array("components-select2.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/foc_order_entry',$js);
	}
	
	public function forecastorder_entry()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("bootstrap-datepicker/js/bootstrap-datepicker.js","select2new/version402/select2.full.min.js","autosize/autosize.min.js","bootstrap-fileinput/bootstrap-fileinput.js");
			$script['script_to_load']=array("components-select2.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/forecastorder_entry',$js);
	}
	
	public function forecastorder_confirm()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("bootstrap-datepicker/js/bootstrap-datepicker.js","select2new/version402/select2.full.min.js","autosize/autosize.min.js","bootstrap-fileinput/bootstrap-fileinput.js");
			$script['script_to_load']=array("components-select2.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/forecastorder_confirm',$js);
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
	
	public function foc_order_view()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("datatables/script/datatable.js","datatables/datatables.min.js","datatables/plugins/bootstrap/datatables.bootstrap.js","jquery.dataTables.columnFilter.js");
			$script['script_to_load']=array("table-datatables-managed.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/foc_order_view',$js);
	}
	
	public function forecastorder_view()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("datatables/script/datatable.js","datatables/datatables.min.js","datatables/plugins/bootstrap/datatables.bootstrap.js","jquery.dataTables.columnFilter.js");
			$script['script_to_load']=array("table-datatables-managed.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/forecastorder_view',$js);
	}
	
	
	
	public function individual_order_view()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("datatables/script/datatable.js","datatables/datatables.min.js","datatables/plugins/bootstrap/datatables.bootstrap.js","jquery.dataTables.columnFilter.js");
			$script['script_to_load']=array("table-datatables-managed.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/individual_order_view',$js);
	}
	
	public function foc_individual_order_view()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("datatables/script/datatable.js","datatables/datatables.min.js","datatables/plugins/bootstrap/datatables.bootstrap.js","jquery.dataTables.columnFilter.js");
			$script['script_to_load']=array("table-datatables-managed.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/foc_individual_order_view',$js);
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
	
	
	public function print_invoice()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("datatables/script/datatable.js","datatables/datatables.min.js","datatables/plugins/bootstrap/datatables.bootstrap.js","jquery.dataTables.columnFilter.js");
			$script['script_to_load']=array("table-datatables-managed.min.js");
			$css['customcss_to_load']=array("invoice-2.min.css","customdcandinvoice.css");
			$js= $plugin+$script+$css;
			$this->load->view('csatemplates/print_invoice',$js);
	}
	
	public function add_kitprice()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("select2new/version402/select2.full.min.js");
			$script['script_to_load']=array("components-select2.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/add_kitprice',$js);
	}
	
	public function customer_prices()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("select2new/version402/select2.full.min.js");
			$script['script_to_load']=array("components-select2.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/customer_prices',$js);
	}
	
	public function customer_price_report()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("datatables/script/datatable.js","datatables/datatables.min.js","datatables/plugins/bootstrap/datatables.bootstrap.js","jquery.dataTables.columnFilter.js");
			$script['script_to_load']=array("table-datatables-managed.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/customer_price_report',$js);
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
	
	public function print_dc()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("datatables/script/datatable.js","datatables/datatables.min.js","datatables/plugins/bootstrap/datatables.bootstrap.js","jquery.dataTables.columnFilter.js");
			$script['script_to_load']=array("table-datatables-managed.min.js");
			$css['customcss_to_load']=array("invoice-2.min.css","customdcandinvoice.css");
			$js= $plugin+$script+$css;
			$this->load->view('csatemplates/print_dc',$js);
	}
	
	public function asp_details()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("select2new/version402/select2.full.min.js","datatables/script/datatable.js","datatables/datatables.min.js","datatables/plugins/bootstrap/datatables.bootstrap.js","jquery.dataTables.columnFilter.js");
			$script['script_to_load']=array("table-datatables-managed.min.js","components-select2.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/asp_details',$js);
	}
	
	
	public function import_stock_in()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("bootstrap-datepicker/js/bootstrap-datepicker.js","select2new/version402/select2.full.min.js","autosize/autosize.min.js","bootstrap-fileinput/bootstrap-fileinput.js");
			$script['script_to_load']=array("components-select2.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/import_stock_in',$js);
	}
	
	public function map_report()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("select2new/version402/select2.full.min.js","datatables/script/datatable.js","datatables/datatables.min.js","datatables/plugins/bootstrap/datatables.bootstrap.js","jquery.dataTables.columnFilter.js");
			$script['script_to_load']=array("table-datatables-managed.min.js","components-select2.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/map_report',$js);
	}
	
	public function available_kits_list()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("select2new/version402/select2.full.min.js","datatables/script/datatable.js","datatables/datatables.min.js","datatables/plugins/bootstrap/datatables.bootstrap.js","jquery.dataTables.columnFilter.js");
			$script['script_to_load']=array("table-datatables-managed.min.js","components-select2.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/available_kits_list',$js);
	}
	
	public function expired_kits_list()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("select2new/version402/select2.full.min.js","datatables/script/datatable.js","datatables/datatables.min.js","datatables/plugins/bootstrap/datatables.bootstrap.js","jquery.dataTables.columnFilter.js");
			$script['script_to_load']=array("table-datatables-managed.min.js","components-select2.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/expired_kits_list',$js);
	}
	
	public function shortexpiry_kits_list()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("select2new/version402/select2.full.min.js","datatables/script/datatable.js","datatables/datatables.min.js","datatables/plugins/bootstrap/datatables.bootstrap.js","jquery.dataTables.columnFilter.js");
			$script['script_to_load']=array("table-datatables-managed.min.js","components-select2.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/shortexpiry_kits_list',$js);
	}
	
	public function potential_customers_list()
	{
		if($this->session->userdata('userrole')!='Admin')
		{
			show_404();
		}
		    $plugin['plugin_to_load']=array("select2new/version402/select2.full.min.js","datatables/script/datatable.js","datatables/datatables.min.js","datatables/plugins/bootstrap/datatables.bootstrap.js","jquery.dataTables.columnFilter.js");
			$script['script_to_load']=array("table-datatables-managed.min.js","components-select2.min.js");
			$js= $plugin+$script;
			$this->load->view('csatemplates/potential_customers_list',$js);
	}
	
	public function insert_kitprice()
	{
		$client_id	=	$_POST['fk_client_id'];//to be used in query
		
		foreach ($_POST['fk_kit_id'] as $key=> $value) {
			//condition to continue the loop if no price values entered for respective kit
			if ($_POST['kit_price'][$key] == "" && $_POST['package_quantity'][$key]=="" && $_POST['package_bonus'][$key]=="") continue;
			$last_kit_price 		= "";
			$last_package_quantity 	= "";
			$last_package_bonus 	= "";
			
			//getting/saving latest price values from table for following condition to check if values are updated or not
			$kq	=	$this->db->query("SELECT * FROM tbl_kit_prices WHERE fk_kit_id = '".$_POST['fk_kit_id'][$key]."' ORDER BY date DESC");
			$kr	=	$kq->result_array();
			
			if (sizeof($kr)>0) {
				$last_kit_price 		= $kr[0]['kit_price'];
				$last_package_quantity 	= $kr[0]['package_quantity'];
				$last_package_bonus 	= $kr[0]['package_bonus'];
			}
			//condition if the prices of kit are not changed then continue the loop
			if (	$last_kit_price == $_POST['kit_price'][$key] 				&& 
					$last_package_quantity == $_POST['package_quantity'][$key] 	&& 
					$last_package_bonus == $_POST['package_bonus'][$key]	) continue;
			// variable assignment for insert query
			$kit_id				=	$_POST['fk_kit_id'][$key];
			$kit_price			=	$_POST['kit_price'][$key];
			$package_quantity	=	$_POST['package_quantity'][$key];
			$package_bonus		=	$_POST['package_bonus'][$key];
			$added_by			=	$this->session->userdata('userid');
			$date				=	date('Y-m-d H:i:s');
			// insert query
			$query	=	"
			INSERT INTO `mypmaonl_pma_enterprize`.`tbl_kit_prices` 
			(`pk_kit_price_id`, `fk_kit_id`, `fk_client_id`, `kit_price`, `package_quantity`, `package_bonus`, `added_by`, `date`) 
			VALUES 
			(NULL, '$kit_id', '$client_id', '$kit_price', '$package_quantity', '$package_bonus', '$added_by', '$date')";
			$this->db->query($query);
		}
		redirect($_POST['redirect_url'].'&prices_updated=success');
	}
	
	public function kit_insert()
	{
		// variable assignment for insert query
		$kit_name			=	$_POST['kit_name'];
		$cat_number			=	$_POST['cat_number'];
		$fk_category_id		=	$_POST['fk_category_id'];
		$fk_vendor_id		=	$_POST['fk_vendor_id'];
		$pack_size			=	$_POST['pack_size'];
		$temp_min			=	$_POST['temp_min'];
		$temp_max			=	$_POST['temp_max'];
		$hazardous			=	$_POST['hazardous'];
		$radioactive		=	$_POST['radioactive'];
		$tests_pack_manual	=	$_POST['tests_pack_manual'];
		$tests_pack_auto	=	$_POST['tests_pack_auto'];
		$msq				=	$_POST['msq'];
		$unit_price			=	$_POST['unit_price'];
		$currency			=	$_POST['currency'];
		$updated_by			=	$this->session->userdata('userid');
		$date				=	date('Y-m-d H:i:s');
		//if ($_POST['temp_min'] == "") $temp_min			=	NULL;
		//if ($_POST['temp_max'] == "") $temp_max			=	NULL;
		// insert query
		$query	=	"
		INSERT INTO `mypmaonl_pma_enterprize`.`tbl_kits` 
		(`pk_kit_id`, `kit_name`, `cat_number`, `fk_category_id`, `fk_vendor_id`, `pack_size`, `temp_min`, `temp_max`, `hazardous`, `radioactive`, `tests_pack_manual`, `tests_pack_auto`, `msq`, `unit_price`, `currency`, `updated_by`, `date`) 
		VALUES 
		(NULL, '$kit_name', '$cat_number', '$fk_category_id', '$fk_vendor_id', '$pack_size','$temp_min','$temp_max', '$hazardous','$radioactive', '$tests_pack_manual', '$tests_pack_auto', '$msq','$unit_price', '$currency', '$updated_by', '$date')";
		$this->db->query($query);
		
		$idq	=	$this->db->query("SELECT MAX(pk_kit_id) AS fk_kit_id FROM tbl_kits");
		$idr	=	$idq->result_array();
		
		$fk_kit_id	=	$idr[0]['fk_kit_id'];
		
		$this->db->query("DELETE FROM tbl_kit_product_bridge WHERE fk_kit_id = '$fk_kit_id'");
		
		foreach ($_POST['equipment'] AS $fk_product_id) {
			$this->db->query("INSERT INTO tbl_kit_product_bridge (`pk_kit_product_bridge_id`,`fk_product_id`,`fk_kit_id`) VALUES (NULL,$fk_product_id,$fk_kit_id)");
		} 
		redirect(base_url().'csa/kits?kit_insert=success');
	}
	
	public function kit_update()
	{
		// variable assignment for insert query
		$kit_name			=	$_POST['kit_name'];
		$cat_number			=	$_POST['cat_number'];
		$fk_category_id		=	$_POST['fk_category_id'];
		$fk_vendor_id		=	$_POST['fk_vendor_id'];
		$pack_size			=	$_POST['pack_size'];
		$temp_min			=	$_POST['temp_min'];
		$temp_max			=	$_POST['temp_max'];
		$hazardous			=	$_POST['hazardous'];
		$radioactive		=	$_POST['radioactive'];
		$tests_pack_manual	=	$_POST['tests_pack_manual'];
		$tests_pack_auto	=	$_POST['tests_pack_auto'];
		$msq				=	$_POST['msq'];
		$unit_price			=	$_POST['unit_price'];
		$currency			=	$_POST['currency'];
		$fk_kit_id			=	$_POST['fk_kit_id'];
		$updated_by			=	$this->session->userdata('userid');
		$date				=	date('Y-m-d H:i:s');
		//if ($_POST['temp_min'] == "") $temp_min			=	NULL;
		//if ($_POST['temp_max'] == "") $temp_max			=	NULL;
		// insert query
		$query	=	"
		UPDATE `mypmaonl_pma_enterprize`.`tbl_kits` SET
		 `kit_name`			=	'$kit_name', 
		 `cat_number` 		=	'$cat_number',
		 `fk_category_id`	=	'$fk_category_id', 
		 `fk_vendor_id`		=	'$fk_vendor_id', 
		 `pack_size`		=	'$pack_size', 
		 `temp_min`			=	'$temp_min', 
		 `temp_max`			=	'$temp_max', 
		 `hazardous`		=	'$hazardous', 
		 `radioactive`		=	'$radioactive',
		 `tests_pack_manual`=	'$tests_pack_manual', 
		 `tests_pack_auto`	=	'$tests_pack_auto', 
		 `msq`				=	'$msq', 
		 `unit_price`		=	'$unit_price', 
		 `currency`			=	'$currency', 
		 `updated_by`		=	'$updated_by', 
		 `date`				=	'$date'
		 
		 WHERE pk_kit_id = $fk_kit_id";
		$this->db->query($query);
		
		$this->db->query("DELETE FROM tbl_kit_product_bridge WHERE fk_kit_id = '$fk_kit_id'");
		
		foreach ($_POST['equipment'] AS $fk_product_id) {
			$this->db->query("INSERT INTO tbl_kit_product_bridge (`pk_kit_product_bridge_id`,`fk_product_id`,`fk_kit_id`) VALUES (NULL,$fk_product_id,$fk_kit_id)");
		} 
		redirect(base_url().'csa/kits?kit_update=success');
	}
	
	public function kit_delete($id)
	{
		// variable assignment for insert query
		$deleted			=	1;
		$fk_kit_id			=	$id;
		$updated_by			=	$this->session->userdata('userid');
		$date				=	date('Y-m-d H:i:s');
		// insert query
		$query	=	"
		UPDATE `mypmaonl_pma_enterprize`.`tbl_kits` SET
		 `deleted`			=	'$deleted', 
		 `updated_by`		=	'$updated_by', 
		 `date`				=	'$date'
		 WHERE pk_kit_id = $fk_kit_id";
		$this->db->query($query);
		redirect(base_url().'csa/kits?kit_delete=success');
	}
	
	public function products_based_on_client_ajax()
	{
		$client_id = $this->input->post('fk_client_id');
		$pq =	$this->db->query("SELECT tbl_instruments.fk_product_id,tbl_products.product_name,COALESCE(tbl_clients.client_name) AS client_name
							FROM `tbl_instruments`
							LEFT JOIN tbl_clients ON tbl_instruments.fk_client_id = tbl_clients.pk_client_id
							LEFT JOIN tbl_products ON tbl_instruments.fk_product_id = tbl_products.pk_product_id
							WHERE tbl_products.status=0 AND tbl_products.fk_type_id = 1 AND tbl_clients.pk_client_id = '".$client_id."'
							GROUP BY pk_product_id");
		$products	=	$pq->result_array();
		echo '<select id="multiple" name="product[]" class="form-control select2-multiple" multiple>';
		foreach ($products AS $product) {
			$product_id	= $product['fk_product_id'];
			$product_name = $product['product_name'];
			echo '<option value="'.$product_id.'">'.$product_name.'</option>';
		}
		echo '<option value="-1">Manual</option>';
		echo '</select>';
		echo '</div>';
	}
	
	public function vendors_based_on_category_ajax()
	{
		$category			=	$this->input->post('category');
		$vendor				=	"";
		$this->vendors_based_on_category_select($category,$vendor);
	}
	
	public function vendors_based_on_category_select($category,$vendor)
	{
		//$category			=	$this->input->post('category');
		$rrr				=	"select tbl_vendor_category_bridge.*,COALESCE(tbl_vendors.vendor_name) AS vendor_name 
								from tbl_vendor_category_bridge 
								LEFT JOIN tbl_vendors ON tbl_vendor_category_bridge.fk_vendor_id = tbl_vendors.pk_vendor_id
								where tbl_vendor_category_bridge.fk_category_id = '".$category."' AND tbl_vendors.status = '0'
								ORDER BY vendor_name
								";
		
		$nn=$this->db->query($rrr);
		$nnm=$nn->result_array();
		echo '<select name="fk_vendor_id" class="form-control select2" id="fk_vendor_id" required>';
		echo '<option value="">---Select---</option>';
		foreach($nnm as $drt) {
			$selected =	"";
			if ($drt['fk_vendor_id']==$vendor)	$selected =	'selected = "selected"';
			if($drt['vendor_name']!=""){
				echo '<option value="'. $drt["fk_vendor_id"]. '" '.$selected.'>'. $drt["vendor_name"]. '</option>';
			}
		}
        echo '</select>';
	}
	
	public function products_based_on_category_ajax()
	{
		$category			=	$this->input->post('category');
		$products			=	"";
		$this->products_based_on_category_select_multiple($category,$products);
	}
	
	public function products_based_on_category_select_multiple($category,$products)
	{
		$products_array		=	explode(',',$products);
		$rrr				=	"select *
								from tbl_products 
								where fk_category_id = '".$category."' AND status = '0' ORDER BY product_name";
		
		$nn=$this->db->query($rrr);
		$nnm=$nn->result_array();
		echo '<select class="form-control select2"  name="equipment[]" multiple="multiple" required>';
		echo '<option value="">---Select---</option>';
		foreach($nnm as $drt) {
			$selected =	"";
			if (in_array($drt['pk_product_id'],$products_array))	$selected =	'selected = "selected"';
			if($drt['product_name']!=""){
				echo '<option value="'. $drt["pk_product_id"]. '" '.$selected.'>'. $drt["product_name"]. '</option>';
			}
		}
        echo '</select>';
	}
	
}