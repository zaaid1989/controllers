<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

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
	public function index()
	{
		redirect('products/brands');
	}
	// Retive All Sent Messages
	
	
	// Delete Compose Message.
	public function add_complaint()
	{
		if($this->session->userdata('userrole')!='secratery')
		{
			show_404();
		}
        $this->load->view('complaint/add_complaint');
	}
	public function brands()
	{
        $this->load->model("products_model");
        $get_brands_list = $this->products_model->get_brands_model();
		$this->load->view('products/brands', array("get_brands_list" => $get_brands_list));
	}
	public function instruments_view()
	{
        $this->load->model("products_model");
        $get_instruments_list = $this->products_model->get_instruments_model();
		$this->load->view('products/instruments_view', array("get_instruments_list" => $get_instruments_list));
	}
	public function parts_view()
	{
        $this->load->model("products_model");
        $get_parts_list = $this->products_model->get_parts_model();
		$this->load->view('products/parts_view', array("get_parts_list" => $get_parts_list));
	}
	public function spare_part_registration()
	{
		$this->load->view('products/spare_part_registration');
	}
	public function spare_part_stock_entry()
	{
		$this->load->view('products/spare_part_stock_entry');
	}
	
	public function part_transfer_office()
	{
		if($this->session->userdata('userrole')=='Admin' || $this->session->userdata('userrole')=='secratery' )
			$this->load->view('products/part_transfer_office');
		else
			show_404();
	}
	
	public function add_order()
	{
		if($this->session->userdata('userrole')=='Admin' || $this->session->userdata('userrole')=='secratery' )
		{
			$this->load->view('products/add_order');
		}
		else
		{
			show_404();
		}
	}
	
	public function update_order()
	{
		if($this->session->userdata('userrole')=='Admin' || $this->session->userdata('userrole')=='secratery' )
		{
			$this->load->view('products/update_order');
		}
		else
		{
			show_404();
		}
	}
	
	
	public function orders()
	{
		
		if($this->session->userdata('userrole')=='Admin' || $this->session->userdata('userrole')=='secratery' )
		{
			$this->load->view('products/orders');
		}
		else
		{
			show_404();
		}
	}
	
	public function parts_ordered()
	{
		
		if($this->session->userdata('userrole')=='Admin' || $this->session->userdata('userrole')=='secratery' )
		{
			$this->load->view('products/parts_ordered');
		}
		else
		{
			show_404();
		}
	}
	
	public function parts_received()
	{
		
		if($this->session->userdata('userrole')=='Admin' || $this->session->userdata('userrole')=='secratery' )
		{
			$this->load->view('products/parts_received');
		}
		else
		{
			show_404();
		}
	}
	
	public function ledger()
	{
		
		if($this->session->userdata('userrole')=='Admin' || $this->session->userdata('userrole')=='secratery' )
		{
			$this->load->view('products/ledger');
		}
		else
		{
			show_404();
		}
	}
	
	public function warranty_claims()
	{
		
		if($this->session->userdata('userrole')=='Admin' || $this->session->userdata('userrole')=='secratery' )
		{
			$this->load->view('products/warranty_claims');
		}
		else
		{
			show_404();
		}
	}
	
	public function test_product()
	{
		if($this->session->userdata('userrole')=='Admin')
		{
			$this->load->view('products/test_product');
		}
		else
		{
			show_404();
		}
	}
	
	public function parts_against_sprf()
	{
		
		if($this->session->userdata('userrole')=='Admin' || $this->session->userdata('userrole')=='secratery' )
		{
			$this->load->view('products/parts_against_sprf');
		}
		else
		{
			show_404();
		}
	}
	
	public function dc_in()
	{
		
		if($this->session->userdata('userrole')=='Admin' || $this->session->userdata('userrole')=='secratery' )
		{
			$this->load->view('products/dc_in');
		}
		else
		{
			show_404();
		}
	}
	
	public function dc_print()
	{
		
		if($this->session->userdata('userrole')=='Admin' || $this->session->userdata('userrole')=='secratery' )
		{
			$this->load->view('products/dc_print');
		}
		else
		{
			show_404();
		}
	}
	
	public function stock_list()
	{
		
		if($this->session->userdata('userrole')=='Admin' || $this->session->userdata('userrole')=='secratery' )
		{
			$this->load->view('products/stock_list');
		}
		else
		{
			show_404();
		}
	}
	
	public function stock_list_new()
	{
		
		if($this->session->userdata('userrole')=='Admin' || $this->session->userdata('userrole')=='secratery' )
		{
			$this->load->view('products/stock_list_new');
		}
		else
		{
			show_404();
		}
	}
	
	public function spare_parts()
	{
		
		if($this->session->userdata('userrole')=='Admin' || $this->session->userdata('userrole')=='secratery' || $this->session->userdata('userrole')=='FSE' || $this->session->userdata('userrole')=='Supervisor')
		{
			$this->load->view('products/spare_parts');
		}
		else
		{
			show_404();
		}
	}
	public function update_part()
	{
		$this->load->view('products/update_part');
	}
	public function delete_part($id)
	{
		//$dbres = $this->db->query("DELETE FROM tbl_parts WHERE pk_part_id = $id");
		$dbres = $this->db->query("update tbl_parts SET delete_status='1' where pk_part_id = $id ");
		redirect(site_url() . 'products/spare_parts?msg=del');
	}
	
	public function order_booked($id)
	{
		$dbres = $this->db->query("UPDATE tbl_parts SET `order_status`='Order Booked' WHERE pk_part_id = $id");
		redirect(site_url() . 'products/orders?msg=ordered');
	}
	
	public function test_sms()
	{
		$input_xml = "";
$input_xml .= "<SMSRequest>";
$input_xml .= "<Username>03028501659</Username>";
$input_xml .= "<Password>123.123</Password>";
$input_xml .= "<From>Business</From>";
$input_xml .= "<To>03018556789</To>";
$input_xml .= "<Message>Hey Zaaid, are you satisfied with this API?</Message>";
$input_xml .= "</SMSRequest>";

$url = "http://221.132.117.58:7700/sendsms_xml.html";

//setting the curl parameters.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);

// Following line is compulsary to add as it is:
curl_setopt($ch, CURLOPT_POSTFIELDS, "xmldoc=" . $input_xml);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);

$data = curl_exec($ch);

$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if(!curl_errno($ch))
{
	$info = curl_getinfo($ch);
	
	echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'] . '<br>';
}

curl_close($ch);

//convert the XML result into array
$array_data = json_decode(json_encode(simplexml_load_string($data)), true);

print_r('<pre>');
print_r($array_data);
print_r('</pre>');
	}
	
	public function delete_sprf($id)
	{
		$dbres = $this->db->query("DELETE FROM tbl_sprf WHERE pk_sprf_id = $id");
		if (isset($_GET['complaint_id']))
			redirect(site_url() . 'products/sprf/'.$_GET['complaint_id'].'?msg=del');
		else
			redirect(site_url() . 'products/parts_against_sprf?msg=del');
	}
	public function delete_complaint($id)
	{
		$dbres = $this->db->query("DELETE FROM tbl_complaints WHERE pk_complaint_id = $id");
		redirect(site_url() . 'complaint/view_half_complaints?del=del');
	}
	
	public function delete_order($id)
	{
		$query="UPDATE tbl_orders SET `status` = '0' WHERE pk_order_id = $id";
		$dbres = $this->db->query($query);
		redirect(site_url() . 'products/parts_ordered?delete=success');
	}
	
	public function approve_dc()
	{
		$query="UPDATE tbl_stock SET `in_status` = 'approved' WHERE in_status = 'pending_approval' AND dc_type = 'in'";
		$dbres = $this->db->query($query);
		redirect(site_url() . 'products/spare_part_stock_entry?dc=success');
	}
	
	public function delete_stock($id)
	{
		$query = $this->db->query("SELECT fk_sprf_id from tbl_stock WHERE pk_stock_id = $id");
		$stock = $query->result_array();
		$dbres = $this->db->query("DELETE FROM tbl_stock WHERE pk_stock_id = $id");
		//echo (sizeof($stock));
		//exit();
		$sprf_id = 0;
		if (sizeof($stock)>0) $sprf_id = $stock[0]['fk_sprf_id'];
		//exit();
		if ($sprf_id !== 0) {
			$sprfq = $this->db->query("DELETE FROM tbl_sprf WHERE pk_sprf_id = '".$sprf_id."'");
		}
		if (isset($_GET['part']))
			redirect(site_url() . 'products/ledger?part='.$_GET['part'].'&delete=success');
		else
		redirect(site_url() . 'products/spare_part_stock_entry?delete=success');
	}
	
	public function spare_part_order_insert() {
		$this->load->model("profile_model");
		if ($_POST['date'] != "")
			$date	=	$this->profile_model->change_date_to_mysql_style($_POST['date']);
		else $date = date('Y-m-d H:i:s');
		$query_ins   =     $this->db->query("insert into  tbl_orders SET order_quantity= '".$_POST['order_quantity']."',  
												  fk_part_id='".$_POST['part_number']."',  
												  date= '".$date."',
												  order_number = '".$_POST['order_number']."',
												  `comments` =	'".urlencode($_POST['comments'])."'"
												  );
		$email = "info@mypmaonline.com"	;									  
		$subject = "Part Requisition";
		$to = "shakir_pma@hotmail.com";
		
		$query = $this->db->query("SELECT tbl_parts.*,tbl_vendors.vendor_name,tbl_products.product_name
						FROM tbl_parts
						LEFT JOIN tbl_vendors ON tbl_parts.fk_vendor_id = tbl_vendors.pk_vendor_id 
						LEFT JOIN tbl_products ON tbl_parts.fk_product_id = tbl_products.pk_product_id
						WHERE tbl_parts.pk_part_id='".$_POST['part_number']."'
						");
		$result = $query->result_array();
		
			$headers = "From: PMA <info@mypmaonline.com>\r\n" .
           "Reply-To: info@mypmaonline\r\n" ;
			$headers  .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			
			//$headers .= "CC: $cc\r\n";
			//$headers .= "BCC: hidden@special.com\r\n";
			//$headers.="Return-Path: $email \r\n";
			
			$vendor = "N/A";
			$product = "N/A";
			$part_number = "N/A";
			$description = "N/A";
			$quantity = "N/A";
			
			$body = '<table width="650" border="0">
					   <tr bgcolor="#BDD5DF">
						<td colspan="2">New Order Added. Details are below:</td>
					  </tr>						  
					  <tr bgcolor="#D5D5D5">
						<td width="110">Vendor</td>
						<td width="265">'.$result[0]['vendor_name'].'</td>
					  </tr>
					   <tr bgcolor="#D5D5D5">
						<td>Product</td>
						<td>'.$result[0]['product_name'].'</td>
					  </tr>
					  <tr bgcolor="#D5D5D5">
						<td>Part #</td>
						<td>'.$result[0]['part_number'].'</td>
					  </tr>				 
					  <tr bgcolor="#D5D5D5">
						<td valign="top">Description</td>
						<td valign="top">'.urldecode($result[0]['description']).'</td>
					  </tr>	
					<tr bgcolor="#D5D5D5">
						<td valign="top">Quantity</td>
						<td valign="top">'.$_POST['order_quantity'].'</td>
					  </tr>	
					</table>';
			mail($to, $subject, $body, $headers);
		
		
		if ($_POST['ur_id'] == "z")
			redirect(site_url() . 'products/add_order?msg=order');
		else
              redirect(site_url() . 'products/orders?msg=success');
    }
	//
	
	public function spare_part_stock_entry_insert() {
		$this->load->model("profile_model");
		$invoice_date	=	"0000-00-00 00:00:00";
		if ($_POST['invoice_date'] != "")
			$invoice_date	=	$this->profile_model->change_date_to_mysql_style($_POST['invoice_date']);
		if ($_POST['date'] != "")
			$date	=	$this->profile_model->change_date_to_mysql_style($_POST['date']);
		else $date = date('Y-m-d H:i:s');
		$dbres = $this->db->query("UPDATE tbl_parts SET `order_status`='No Order Booked' WHERE pk_part_id = '".$_POST['part_number']."'");
		
		/*
		$query_chek = $this->db->query("select * from tbl_stock where fk_part_id='".$_POST['part_number']."' AND fk_office_id= '".$_POST['stock_location']."'");
		if($query_chek->num_rows()>0)
		{
			$result 	 =     $query_chek->result_array();
			$new_stock   =     $result[0]['stock'] + $_POST['stock_in_quantity'];
			$query_upd   =     $this->db->query("update tbl_stock SET stock= '$new_stock' where fk_part_id='".$_POST['part_number']."' AND fk_office_id= '".$_POST['stock_location']."'");
		}
		else
		{*/
			/*$query="insert  into `tbl_stock` SET 	
				  `fk_vendor_id`				=		'".$_POST['vendor_name']."',
				  `fk_part_id`					=		'".$_POST['part_number']."',
				  `description`		    		=		'".urlencode($_POST['part_description'])."',
				  
				  `stock`						=		'".$_POST['stock_in_quantity']."',
				  `fk_office_id`				=		'".$_POST['stock_location']."'";
			  echo $query;exit;*/
			  $dc_type 	=	"in";
			  $dc_number =	0;
			  $current_dc_number = 0;
			  if ($_POST['stock_in_quantity']<0) $dc_type 	=	"in"; // this status is for the one that is being subtracted direct from stock entry
			  if ($dc_type 	==	"in") {
				  $query_chek = $this->db->query("select MAX(dc_number) AS dc_number from tbl_stock where dc_type='in' AND in_status= 'approved'");
				  $result 	 =     $query_chek->result_array();
				  $dc_number_prefix = date('Ym');
				  if (strlen($result[0]['dc_number'])<6 )
					$current_dc_number = 1;//$result[0]['dc_number'];
				  else
					  $current_dc_number = substr($result[0]['dc_number'],6);
				  $new_dc_number = $current_dc_number+1;
				  $dc_number = $dc_number_prefix.$new_dc_number;	//$result[0]['dc_number'] + 1;
				  
			  }
			  $order_number = explode(',',$_POST['order_number'] );
			  //if ($order_number[0]!="Other" && $order_number[0]!="")
			  $dbres = $this->db->query("UPDATE tbl_orders SET `status` = '0' WHERE order_number = '".$order_number[0]."' AND fk_part_id='".$_POST['part_number']."'");
			 // Above Line if we will want to make order status as 0 (or delted) on stock entry. But it hasn't been done like this because it's not necessary that the ordered quantity and received quantity is same. One option is to fetch prdered_quantity from table and if current_ordered_quantity == stock_in_quantity execute above statement else update order and set ordered_quantity as current_ordered_quantity - stock_in_quantity
			 // On default all data will be entered as in_status pending_approval. In another controller the in_status of all this data would be changed to approved
			  $query_ins   =     $this->db->query("insert into  tbl_stock SET stock= '".$_POST['stock_in_quantity']."',  
																			  fk_part_id='".$_POST['part_number']."',  
																			  fk_office_id= '".$_POST['stock_location']."',
																			  date= '".$date."',
																			  stock_type = '".$_POST['stock_type']."',
																			  order_number = '".$order_number[0]."',
																			  invoice_date = '".$invoice_date."',
																			  invoice_number = '".$_POST['invoice_number']."',
																			  equipment_serial = '".$_POST['equipment_serial']."',
																			  old_inventory_description = '".urlencode($_POST['old_inventory_description'])."',
																			  dc_type = '".$dc_type."',
																			  dc_number = '".$dc_number."',
																			  `comments` =	'".urlencode($_POST['comments'])."'"
												  );
		//} // end of else
		
		if ($_POST['ur_id'] == "z")
			redirect(site_url() . "products/spare_part_stock_entry?msg=success&p=".$_POST['part_number']."&t=".$_POST['stock_type']."&on=".$order_number[0]."&id=".$invoice_date."&in=".$_POST['invoice_number']."&d=".$date."&es=".$_POST['equipment_serial']."&off=".$_POST['stock_location']);
		else
              redirect(site_url() . 'products/spare_parts?msg=stock');
    }
	
	public function add_part_received() {
		  $this->load->model("profile_model");
		  $date = date('Y-m-d H:i:s');
		
		  $dc_type 	=	"in";
		  $dc_number =	0;
		  $in_status = "";
		  $stock = 0;
			  $current_dc_number = 0;
			  if ($_POST['part_condition']=="Functional") {
				  $in_status = "pending_approval";
				  $stock = 1;
				  $query_chek = $this->db->query("select MAX(dc_number) AS dc_number from tbl_stock where dc_type='in' AND in_status= 'approved'");
				  $result 	 =     $query_chek->result_array();
				  $dc_number_prefix = date('Ym');
				  if (strlen($result[0]['dc_number'])<6 )
					$current_dc_number = 1;//$result[0]['dc_number'];
				  else
					  $current_dc_number = substr($result[0]['dc_number'],6);
				  $new_dc_number = $current_dc_number+1;
				  $dc_number = $dc_number_prefix.$new_dc_number;	//$result[0]['dc_number'] + 1;
			  }
			  $query_ins   =     $this->db->query("insert into  tbl_stock SET stock= '".$stock."',  
																			  stock_type = 'Received Back',
																			  in_status='".$in_status."',
																			  fk_part_id='".$_POST['fk_part_id']."',  
																			  fk_office_id= '".$_POST['stock_location']."',
																			  receiver_name = '".$_POST['receiver_name']."',
																			  fk_complaint_id= '".$_POST['fk_complaint_id']."',
																			  date= '".$date."',
																 			  equipment_serial = '".$_POST['equipment_serial']."',
																			  old_inventory_description = '".urlencode($_POST['part_condition'])."',
																			  dc_type = '".$dc_type."',
																			  dc_number = '".$dc_number."',
																			  fk_stock_id = '".$_POST['fk_stock_id']."',
																			  `comments` =	'".urlencode($_POST['comments'])."'"
												  );
              redirect(site_url() . 'complaint/spare_parts_changed_report?msg=old_stock');
    }
	
	
	public function part_transfer_office_insert() {
		$this->load->model("profile_model");
		if ($_POST['date'] != "")
			$date	=	$this->profile_model->change_date_to_mysql_style($_POST['date']);
		else $date = date('Y-m-d H:i:s');
		
		
		$dc_type 	=	"in";
			  $dc_number =	0;
			  $current_dc_number = 0;
			  if ($_POST['stock_quantity']<0) $dc_type 	=	"in"; // this status is for the one that is being subtracted direct from stock entry
			  if ($dc_type 	==	"in") {
				  $query_chek = $this->db->query("select MAX(dc_number) AS dc_number from tbl_stock where dc_type='in' AND in_status= 'approved'");
				  $result 	 =     $query_chek->result_array();
				  $dc_number_prefix = date('Ym');
				  if (strlen($result[0]['dc_number'])<6 )
					$current_dc_number = 1;//$result[0]['dc_number'];
				  else
					  $current_dc_number = substr($result[0]['dc_number'],6);
				  $new_dc_number = $current_dc_number+1;
				  $dc_number = $dc_number_prefix.$new_dc_number;	//$result[0]['dc_number'] + 1;
				  
			  }
			 
			  // On default all data will be entered as in_status pending_approval. In another controller the in_status of all this data would be changed to approved
			  $query_ins   =     $this->db->query("insert into  tbl_stock SET stock= '".$_POST['stock_quantity']."',  
																			  fk_part_id='".$_POST['part_number']."',  
																			  fk_office_id= '".$_POST['stock_destination']."',
																			  date= '".$date."',
																			  stock_type = 'Office Trasnfer',
																			  dc_type = '".$dc_type."',
																			  dc_number = '".$dc_number."',
																			  in_status = 'approved',
																			  `comments` =	'".urlencode($_POST['comments'])."'"
												  );
												  
				///////////////////////// *************************** GET highest DC OUT Number
				$dc_number	=	0; 
				$maxqu = $this->db->query("SELECT MAX(dc_number) as mazz FROM tbl_sprf ");
				$maxval=$maxqu->result_array();
				$cur_no=$maxval[0]['mazz'];//echo $cur_no.'sana';exit;
				$dc_number=$cur_no+1;
				
				$query_ins   =     $this->db->query("insert into  tbl_stock SET stock= '-".$_POST['stock_quantity']."',  
																			  fk_part_id='".$_POST['part_number']."',  
																			  fk_office_id= '".$_POST['stock_source']."',
																			  date= '".$date."',
																			  stock_type = 'Office Trasnfer',
																			  dc_type = 'out',
																			  dc_number = '".$dc_number."',
																			  `comments` =	'".urlencode($_POST['comments'])."'"
												  );
												  
				$query_ins   =     $this->db->query("insert into tbl_sprf set fk_complaint_id = 	'0',
													  status 			= 	'1',
													  part_source	  	= 	'stock',
													  source_id			= 	'officeoption_".$_POST['stock_source']."#0',
													  dc_number	  	    = 	'".$dc_number."',
													  approval_date		= 	'".$date."',
													  fk_part_id	  = 	'".$_POST['part_number']."',
													  quantity	  	  = 	'".$_POST['stock_quantity']."',
													  total		 	  = 	'".$_POST['stock_quantity']."',
													  purpose	  	  = 	'".urlencode($_POST['comments'])."',
													  billing	  	  = 	'N/A',
													  creation_time	  = 	'".$date."'"
										  );
		
		
		if ($_POST['ur_id'] == "z")
			redirect(site_url() . 'products/part_transfer_office?msg=success');
		else
              redirect(site_url() . 'products/part_transfer_office?msg=stock');
	}
	public function spare_part_stock_entry_insert_new() {
	/*
		$this->load->model("profile_model");
		$invoice_date	=	"0000-00-00 00:00:00";
		if ($_POST['invoice_date'] != "")
			$invoice_date	=	$this->profile_model->change_date_to_mysql_style($_POST['invoice_date']);
		if ($_POST['date'] != "")
			$date	=	$this->profile_model->change_date_to_mysql_style($_POST['date']);
		else $date = date('Y-m-d H:i:s');
		$dbres = $this->db->query("UPDATE tbl_parts SET `order_status`='No Order Booked' WHERE pk_part_id = '".$_POST['part_number']."'");
		
			  $dc_type 	=	"in";
			  $dc_number =	0;
			  $current_dc_number = 0;
			  if ($_POST['stock_in_quantity']<0) $dc_type 	=	"in"; // this status is for the one that is being subtracted direct from stock entry
			  if ($dc_type 	==	"in") {
				  $query_chek = $this->db->query("select MAX(dc_number) AS dc_number from tbl_stock where dc_type='in' AND in_status= 'approved'");
				  $result 	 =     $query_chek->result_array();
				  $dc_number_prefix = date('Ym');
				  if (strlen($result[0]['dc_number'])<6 )
					$current_dc_number = 1;//$result[0]['dc_number'];
				  else
					  $current_dc_number = substr($result[0]['dc_number'],6);
				  $new_dc_number = $current_dc_number+1;
				  $dc_number = $dc_number_prefix.$new_dc_number;	//$result[0]['dc_number'] + 1;
				  
			  }
			  $order_number = explode(',',$_POST['order_number'] );
			  // On default all data will be entered as in_status pending_approval. In another controller the in_status of all this data would be changed to approved
			  $query_ins   =     $this->db->query("insert into  tbl_stock SET stock= '".$_POST['stock_in_quantity']."',  
																			  fk_part_id='".$_POST['part_number']."',  
																			  fk_office_id= '".$_POST['stock_location']."',
																			  date= '".$date."',
																			  stock_type = '".$_POST['stock_type']."',
																			  order_number = '".$order_number[0]."',
																			  invoice_date = '".$invoice_date."',
																			  invoice_number = '".$_POST['invoice_number']."',
																			  equipment_serial = '".$_POST['equipment_serial']."',
																			  old_inventory_description = '".urlencode($_POST['old_inventory_description'])."',
																			  dc_type = '".$dc_type."',
																			  dc_number = '".$dc_number."',
																			  `comments` =	'".urlencode($_POST['comments'])."'"
												  );
		//} // end of else
		
		if ($_POST['ur_id'] == "z")
			redirect(site_url() . 'products/spare_part_stock_entry?msg=success');
		else
              redirect(site_url() . 'products/spare_parts?msg=stock');
		  */
		  echo "zaaid";
		  
		  foreach($_POST['customer'] as $key=> $value)
			{
				echo $_POST['customer'][$key]. ' - '.$_POST['summery'][$key]. ' - '.$_POST['business'][$key]. ' - '.$_POST['city'][$key].'</br>';
			}
		  
		  exit;
		  
    }
	//
	public function part_insert() {
		$query="insert  into `tbl_parts` SET 	
				  `fk_vendor_id`				=		'".$_POST['vendor_name']."',
				  `fk_product_id`				=		'".$_POST['product_name']."',
				  `description`		    		=		'".urlencode($_POST['part_description'])."',
				  
				  `part_number`					=		'".$_POST['part_no']."',
				  `minimum_quantity`			=		'".$_POST['minimum_qty']."',
				  `unit_price`					=		'".$_POST['unit_price']."',
				  `comments`					=		'".urlencode($_POST['comments'])."'";
			  $dbres = $this->db->query($query);
	   
	   //
	   define ('SITE_ROOT', dirname(dirname(dirname(__FILE__))));
	   if (@$_FILES["image"]["tmp_name"][0] == "") {
        } else {
			//for insert id
			  $query2			="select * from `tbl_parts` ORDER BY pk_part_id DESC LIMIT 0,1";
			  $dbres2 			= $this->db->query($query2);
			  $get_users_lists  = $dbres2->result_array();
			  $insert_id		=$get_users_lists[0]['pk_part_id'];
			  //echo $insert_id;exit;
			//for insert id
			$dbres = $this->db->query("select * from tbl_parts where pk_part_id ='".$insert_id."'");
			$get_users_lists=$dbres->result_array();
			if($get_users_lists[0]["image"]!="")
			{
			$image_path = SITE_ROOT.'/usersimages/parts_images/' . $get_users_lists[0]["pk_part_id"] . '/' . $get_users_lists[0]["image"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
			$path = SITE_ROOT.'/usersimages/parts_images/'. $get_users_lists[0]["pk_part_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/parts_images/'. $get_users_lists[0]["pk_part_id"].'/';
            $fileData = pathinfo(basename($_FILES["image"]["name"]));
            
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_parts SET image='" .$new_file_name . "' 
						 WHERE pk_part_id='" . $get_users_lists[0]["pk_part_id"] . "'";
            $query=$this->db->query($updat_query);
			
        }
	   //
              redirect(site_url() . 'products/spare_parts?msg=success');
    }
	
	public function spare_part_update_order_insert() {
		$this->load->model("profile_model");
		if ($_POST['date'] != "")
			$date	=	$this->profile_model->change_date_to_mysql_style($_POST['date']);
		else $date = date('Y-m-d H:i:s');
		$query_ins   =     $this->db->query("UPDATE  tbl_orders SET order_quantity= '".$_POST['order_quantity']."',  
												  fk_part_id='".$_POST['part_number']."',  
												  date= '".$date."',
												  order_number = '".$_POST['order_number']."',
												  `comments` =	'".urlencode($_POST['comments'])."'
												  WHERE pk_order_id = '".$_POST['order_hidden_id']."'"
												  );
		
		/*
		if ($_POST['ur_id'] == "z")
			redirect(site_url() . 'products/add_order?msg=order');
		else*/
              redirect(site_url() . 'products/parts_ordered?msg=success_update');
    }
	
	public function part_update_insert() {
		$query="update `tbl_parts` SET 	
				  `fk_vendor_id`				=		'".$_POST['vendor_name']."',
				  `fk_product_id`				=		'".$_POST['product_name']."',
				  `description`		    		=		'".urlencode($_POST['part_description'])."',
				  `part_number`					=		'".$_POST['part_no']."',
				  `minimum_quantity`			=		'".$_POST['minimum_qty']."',
				  `unit_price`					=		'".$_POST['unit_price']."',
				  `comments`					=		'".urlencode($_POST['comments'])."'
				  where pk_part_id = '".$_POST['part_hidden_id']."'";
				  //echo $query;exit;
			  $dbres = $this->db->query($query);
	   
	   //
	   //echo $_FILES["image"]["tmp_name"][0];exit;
	   define ('SITE_ROOT', dirname(dirname(dirname(__FILE__))));
	   if (@$_FILES["image"]["tmp_name"][0] == "") {
        } else {
			//for insert id
			  $insert_id		=$_POST['part_hidden_id'];
			//for insert id
			$dbres = $this->db->query("select * from tbl_parts where pk_part_id ='".$insert_id."'");
			$get_users_lists=$dbres->result_array();
			if($get_users_lists[0]["image"]!="")
			{
			$image_path = SITE_ROOT.'/usersimages/parts_images/' . $get_users_lists[0]["pk_part_id"] . '/' . $get_users_lists[0]["image"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
			$path = SITE_ROOT.'/usersimages/parts_images/'. $get_users_lists[0]["pk_part_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/parts_images/'. $get_users_lists[0]["pk_part_id"].'/';
            $fileData = pathinfo(basename($_FILES["image"]["name"]));
            
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_parts SET image='" .$new_file_name . "' 
						 WHERE pk_part_id='" . $get_users_lists[0]["pk_part_id"] . "'";
            $query=$this->db->query($updat_query);
			
        }
	   //
              redirect(site_url() . 'products/spare_parts?msg=upt');
    }
	public function select_products()
	{
		$vendor_id			=	$this->input->post('vendor_id');
		$rrr				=	"select * from tbl_vendor_product_bridge where fk_vendor_id = '".$vendor_id."' ";
		//echo $rrr;exit;
		$nn=$this->db->query($rrr);
		$nnm=$nn->result_array();
		echo '<select name="product_name';
		echo '" class="form-control product_name"';
		echo ' >';
		echo '<option value="">---Select---</option>';
		foreach($nnm as $drt)
		{
			$rrr2=	"select * from tbl_products where pk_product_id = '".$drt["fk_product_id"]."' AND status = '0' ";
			//echo $rrr2;
			$nn2=$this->db->query($rrr2);
			if($nn2->num_rows() > 0)
			{
				echo '<option value="';
				echo $drt["fk_product_id"];
				echo '">';
				
				$nnm2=$nn2->result_array();
				echo $nnm2[0]["product_name"];
				echo '</option>';
			}
		}
        echo '</select>';
	}
	public function part_number_select()
	{
		$vendor_id			=	$this->input->post('vendor_id');
		$rrr				=	"select * from tbl_parts where fk_vendor_id = '".$vendor_id."' ";
		//echo $rrr;exit;
		$nn=$this->db->query($rrr);
		$nnm=$nn->result_array();
		echo '<select name="part_number';
		echo '" onchange="select_description(this.value)" class="form-control"';
		echo ' required>';
		echo '<option value="">---Select---</option>';
		foreach($nnm as $drt)
		{
				echo '<option value="';
				echo $drt["pk_part_id"];
				echo '">';
				
				echo $drt["part_number"];
				echo '</option>';
		}
        echo '</select>';
	}
	public function select_description()
	{
		$vendor_id			=	$this->input->post('vendor_id');
		$part_id			=	$this->input->post('part_id');
		$rrr				=	"select * from tbl_parts where fk_vendor_id = '".$vendor_id."' AND pk_part_id = '".$part_id."'";
		//echo $rrr;exit;
		$nn=$this->db->query($rrr);
		$nnm=$nn->result_array();
		echo urldecode($nnm[0]["description"]);
	}
	
	public function order_reference_ajax()
	{
		$vendor_id			=	$this->input->post('vendor_id');
		$part_id			=	$this->input->post('part_id');
		$rrr				=	"select * from tbl_orders where status='1' AND fk_part_id = '".$part_id."'";
		//echo $rrr;exit;
		$nn=$this->db->query($rrr);
		$nnm=$nn->result_array();
		echo '<option value="">--Select Order Reference--</option>';
		foreach($nnm as $val) {
				echo '<option value="';
				echo $val['order_number'].','.$val['order_quantity'];
				echo '">';
				echo $val['order_number'].' - '.date('d M Y',strtotime($val['date'])).' - Qty = '.$val['order_quantity'];
				echo '</option>';
		}
		echo '<option value="Other">Other</option>';
	}
	
	public function office_table_ajax()
	{
		$vendor_id			=	$this->input->post('vendor_id');
		$part_id			=	$this->input->post('part_id');
		?>
		<table class="table table-striped table-bordered table-hover flip-content">
                	<tr>
                <?php 
					  $query = $this->db->query("select * from tbl_offices");
					  $result = $query->result_array();
					  foreach($result as $office)
					  {
					?>
						<th><?php echo $office['office_name']?></th>
					<?php }?>
                    </tr>
                    <!---->
                    <tr>
                    <?php 
					  //The data for blow table will be fetched form tbl_stock according to the part selected from the second drop-down in above form
					  $query = $this->db->query("select * from tbl_offices");
					  $result = $query->result_array();
					  foreach($result as $office)
					  {
						echo '<td>';
						  $stock = $this->db->query("select SUM(stock) AS stock from tbl_stock where fk_office_id = '".$office['pk_office_id']."' AND fk_part_id='".$part_id."' AND (dc_type='out' OR (dc_type='in' AND in_status='approved'))");
						  $stock_result = $stock->result_array();
						  if ($stock_result[0]['stock']!=0)
							echo $stock_result[0]['stock'];
						  else
							  echo '0';
                      echo '</td>';
					 }?>
                    </tr>
                </table>
		<?php
	}
	
	public function office_table_ajax_two()
	{
		$vendor_id			=	$this->input->post('vendor_id');
		$part_id			=	$this->input->post('part_id');
		?>
		<table class="table table-striped table-bordered table-hover flip-content">
					<tr>
						<th> MSQ </th>
						<th> Balance </th>
						<th> Requisition - MSQ </th>
						<th> Requisition - SPRF </th>
						<th> Quantity Ordered Already </th>
                    </tr>
				<?php	
                	$stock_total=0;
					$stock_demand=0;
					$stock_demand_aggregate=0;
					$demand_detail = "";
					$parts_query="SELECT `pk_part_id`, `fk_instrument_id`, `fk_vendor_id`, `fk_product_id`, `part_name`, `part_number`, `order_status`, `description`, `stock_quantity`, `minimum_quantity`, `unit_price`, `comments`, `image`, vendor_name, product_name FROM `tbl_parts` 
								INNER JOIN tbl_vendors ON tbl_parts.fk_vendor_id = tbl_vendors.pk_vendor_id 
								INNER JOIN tbl_products ON tbl_parts.fk_product_id = tbl_products.pk_product_id WHERE pk_part_id='".$part_id."'";
								
								$ty22=$this->db->query($parts_query);
								$rt22=$ty22->result_array();
								if (sizeof($rt22) == "0") 
								{} 
								else {
								  foreach ($rt22 as $get_users_list) {
									  // for finding total stock
										$stock_total=0;
										$stock_demand=0;
										$stock_demand_aggregate=0;
										$stock = $this->db->query("select * from tbl_stock where  fk_part_id='".$get_users_list['pk_part_id']."'");
										  if($stock->num_rows()>0)
										  {
											  $stock_result = $stock->result_array();
											  foreach($stock_result as $total_stock)
											  {
												  $stock_total= $stock_total + $total_stock['stock'];
											  }
										  }
										  
										  $qd = $this->db->query("SELECT fk_part_id, SUM(quantity) AS demand FROM `tbl_sprf` WHERE status=0 AND fk_part_id = '".$get_users_list['pk_part_id']."' GROUP BY fk_part_id");
                                          $rd = $qd->result_array();
										  if (sizeof($rd)>0)
												$stock_demand = $rd[0]['demand'];
										  if ($stock_demand>0) 
												$stock_demand_aggregate=$stock_demand - $stock_total;
										  
										  if($stock_total>=$get_users_list["minimum_quantity"] && $stock_demand_aggregate<=0) continue;
										  
										  
										  $demand_detail = "";
										  $qd = $this->db->query("SELECT `tbl_sprf`.fk_complaint_id,`tbl_sprf`.quantity, `tbl_clients`.client_name,`tbl_complaints`.ts_number
											FROM `tbl_sprf` 
											LEFT JOIN tbl_complaints ON `tbl_sprf`.fk_complaint_id = `tbl_complaints`.pk_complaint_id
											LEFT JOIN tbl_clients ON `tbl_clients`.pk_client_id = `tbl_complaints`.fk_customer_id
											WHERE `tbl_sprf`.status=0 AND `tbl_sprf`.fk_part_id = '".$get_users_list['pk_part_id']."'");
                                          $rd = $qd->result_array();
										  if (sizeof($rd)>0)
												foreach ($rd AS $dd) {
													$demand_detail .= $dd['quantity'].' ('.$dd['client_name'].' - '.$dd['ts_number'].'), ';
												}
										$order_quantity = "";		
										$qd = $this->db->query("SELECT * from tbl_orders
											WHERE status=1 AND fk_part_id = '".$get_users_list['pk_part_id']."' ORDER BY date ASC");
                                          $rd = $qd->result_array();
										  if (sizeof($rd)>0)
												foreach ($rd AS $dd) {
													$order_quantity .= '<span title="'.$dd['order_number'].' - '.date('d-M-Y',strtotime($dd['date'])).'">'.$dd['order_quantity'].'</span> + ';
												}
										?>
										<tr>
										<td class="font-red" align="center">
										  <?php 
                                          	echo $get_users_list["minimum_quantity"];
                                          ?>
										</td>
                                        <td style="font-weight:bold;" align="center"> <!-- Stock -->
										  <?php // for finding total stock
                                          	$stock = $this->db->query("select * from tbl_stock where  fk_part_id='".$get_users_list['pk_part_id']."'");
                                                  if($stock->num_rows()>0)
                                                  {
                                                      $stock_result = $stock->result_array();
													  $stock_total=0;
													  foreach($stock_result as $total_stock)
													  {
														  $stock_total= $stock_total + $total_stock['stock'];
													  }
                                                      echo $stock_total;
                                                  }
                                                  else
                                                  {
                                                      echo '-';
                                                  }
                                          ?>
										</td>
										<td align="center"> <!-- Orders -->
											<?php 
												echo $get_users_list["minimum_quantity"]-$stock_total;
											?>
										</td>
										
										<td align="center">
										<?php if ($stock_demand_aggregate>0) echo '<span title="'.$demand_detail.'">'.$stock_demand_aggregate.'</span>'; 
										else echo '-';
										?>
										</td>
										
										<td align="center"> <!-- Order Status -->
											<?php 
												//echo $get_users_list["order_status"];
												if ($order_quantity != "") echo substr($order_quantity,0,-2);
												else echo '-';
												
											?>
										</td>
									</tr>
		<?php
	}}}
	
	public function sprf($complaint_id)
	{
		if($this->session->userdata('userrole')=='FSE' || $this->session->userdata('userrole')=='Supervisor' || $this->session->userdata('userrole')=='Admin' || $this->session->userdata('userrole')=='secratery')
		{
			$this->load->model("products_model");
			$get_complaint_list = $this->products_model->get_complaint_data($complaint_id);
			$this->load->view('products/sprf', array("get_complaint_list" => $get_complaint_list));
		}
		else
		{
			show_404();
		}
		
	}
	public function supervisor_sprf($complaint_id)
	{
		if($this->session->userdata('userrole')=='Admin' || $this->session->userdata('userrole')=='Supervisor' || $this->session->userdata('userrole')=='secratery')
		{
			$this->load->model("products_model");
			$get_complaint_list = $this->products_model->get_complaint_data($complaint_id);
			$this->load->view('products/supervisor_sprf', array("get_complaint_list" => $get_complaint_list));
		}
		else
		{
			show_404();
		}
	}
	
	
	public function get_par_image_ajax()
	{
		$part_id=$this->input->post('part_id');
		$dbres = $this->db->query("SELECT * FROM tbl_parts  where pk_part_id='".$part_id."'");
        $dbresResult=$dbres->result_array();
		if($dbresResult[0]["image"]=='')
		  {
			  echo '<img src="'.base_url().'usersimages/complaint_images/800px-No_Image_Wide.svg.png" style="width:125px;" />';
		  }
		  else
		  {
			  echo '<img src="'.base_url().'usersimages/parts_images/'. $dbresResult[0]["pk_part_id"].'/'.$dbresResult[0]["image"].'" style="width:125px;" />';
		  }
		
	}
	public function get_des_ajax()
	{
		$part_id=$this->input->post('part_id');
		$dbres = $this->db->query("SELECT * FROM tbl_parts  where pk_part_id='".$part_id."'");
        $dbresResult=$dbres->result_array();
		echo urldecode($dbresResult[0]['description']);
	}
	public function get_unitprice_ajax()
	{
		$part_id=$this->input->post('part_id');
		$dbres = $this->db->query("SELECT * FROM tbl_parts  where pk_part_id='".$part_id."'");
        $dbresResult=$dbres->result_array();
		echo $dbresResult[0]['unit_price'];
	}
	public function get_stock_quantities_table_ajax()
	{
		$part_id=$this->input->post('part_id');
		?>
        <table class="table table-striped table-bordered table-hover flip-content">
            <tr>
             <?php 
              $query = $this->db->query("select * from tbl_offices");
              $result = $query->result_array();
              foreach($result as $office)
              {
            ?>
            <th><?php echo $office['office_code']?></th>
            <?php }?>
            </tr>
			<tr>
			  <?php 
              $query = $this->db->query("select * from tbl_offices");
              $result = $query->result_array();
              foreach($result as $office)
              {
                echo '<td>';
                  $stock = $this->db->query("select SUM(stock) AS stock from tbl_stock where fk_office_id = '".$office['pk_office_id']."' 
                                             AND fk_part_id='".$part_id."' AND (dc_type='out' OR (dc_type='in' AND in_status='approved'))");
                  $stock_result = $stock->result_array();
						  if ($stock_result[0]['stock']!=0)
							echo $stock_result[0]['stock'];
						  else
							  echo '0';
              echo '</td>';
             }?>
          </tr>
        </table>
		<?php
	}
	public function insert_complaint() {
		$problem_summery=$_POST['instrument_prob'].' '.$_POST['kit_prob_des_cus'];
		$data = array(
						'ts_number' 					=> 	$_POST['ts_number'],
						'caller_name'  					=> 	$_POST['caller_name'],
						'date'							=> 	$_POST['call_date'].' '.$_POST['call_time'],
						'customer'						=> 	$_POST['customer'],
						'fk_city_id'		 					=> 	$_POST['city'],
						'problem_summary'				=>  $problem_summery,
						'status'						=> 	"1",
						'FSE_SAP'						=> 	$_POST['customer'],
						'phone'							=>  $_POST['mobile'],
						'problem_type'					=> 	$_POST['problem_type'],
						'assign_service_call' 			=> 	$_POST['assign_service_call'],
						
						
						'instrument_name'				=> 	$_POST['instrument_name'],
						'instrument_serial_no'			=>  $_POST['instrument_serial_no'],
						'instrument_prob'				=> 	$_POST['instrument_prob'],
						'instrument_error_msg'			=> 	$_POST['instrument_error_msg'],
						'error_no'						=> 	$_POST['error_no'],
						'last_ok_time'					=> 	$_POST['last_ok_time'],
						'action_after_problem'			=> 	$_POST['action_after_problem'],
						'is_done_before'				=> 	$_POST['is_done_before'],
						
						
						'kit_name'						=> 	$_POST['kit_name'],
						'kit_lot_no'					=> 	$_POST['kit_lot_no'],
						'make_pack'						=> 	$_POST['make_pack'],
						'kit_prob_des_cus'				=> 	$_POST['kit_prob_des_cus'],
						'is_colb_ok_rec'				=> 	$_POST['is_colb_ok_rec'],
						'cont_run_after'				=> 	$_POST['cont_run_after'],
						'instrument_software_version'	=>  $_POST['instrument_software_version']
            		);
            $this->load->model("complaint_model");
            $result = $this->complaint_model->insert_complaint($data);
            echo $this->db->insert_id();
            redirect(site_url() . 'complaint/operator_view_complaints?msg=success');
	  }
	// Delete Single Message.
	
	public function fse_pending_varification()
	{
		$updat_query="UPDATE tbl_complaints SET status='Pending Verification', 
												solution_date	=	'".date('Y-m-d H:i:s')."'
						 WHERE pk_complaint_id='" . $_POST['complaint_id'] . "'";
            $query=$this->db->query($updat_query);
			
		if(isset($_POST['s_pm_form']))
		{
			redirect(site_url() . 'complaint/s_pm_form/'.$_POST['complaint_id'].'?msg_pend_ver=success');
		}
		else
		{
			redirect(site_url() . 'complaint/pm_form/'.$_POST['complaint_id'].'?msg_pend_ver=success');
		}
	}
	public function supervisor_mark_completed()
	{
		$updat_query="UPDATE tbl_complaints SET status			=	'Completed',
												finish_time	=	'".date('Y-m-d H:i:s')."'
						 WHERE pk_complaint_id='" . $_POST['complaint_id'] . "'";
            $query=$this->db->query($updat_query);
			redirect(site_url() . 'complaint/pm_form/'.$_POST['complaint_id'].'?msg_mark_comp=success');
	}
	public function director_change_status()
	{
		if ($_POST['status']!= 'Closed' && $_POST['status']!= 'Completed' ) {
		$updat_query="UPDATE tbl_complaints SET 
												status			=	'".$_POST['status']."'
						 						WHERE pk_complaint_id='" . $_POST['complaint_id'] . "'";
		$query=$this->db->query($updat_query);
		}
		else {
			$updat_query="UPDATE tbl_complaints SET 
												status			=	'".$_POST['status']."'
												finish_time			=	'".date('Y-m-d H:i:s')."'
						 						WHERE pk_complaint_id='" . $_POST['complaint_id'] . "'";
			$query=$this->db->query($updat_query);
		}
			$comment_query=$this->db->query("INSERT INTO tbl_comments SET comment=	'".urlencode($_POST['comment'])."', date= '".date('Y-m-d H:i:s')."', 
											 fk_complaint_id ='".$_POST['complaint_id']."', fk_employee_id='".$this->session->userdata('userid')."'");
			if(isset($_POST['ts_report_director']))
			{
				redirect(site_url() . 'complaint/ts_report_director/'.$_POST['complaint_id'].'?msg_change_status=success');
			}
			else
			{
				redirect(site_url() . 'complaint/pm_form/'.$_POST['complaint_id'].'?msg_change_status=success');
			}
	}
	
	public function supervisor_mark_pending()
	{
		$updat_query="UPDATE tbl_complaints SET status			=	'Pending' WHERE pk_complaint_id='" . $_POST['complaint_id'] . "'";
            $query=$this->db->query($updat_query);
			redirect(site_url() . 'complaint/pm_form/'.$_POST['complaint_id'].'?msg_mark_pend=success');
	}
	
	public function pm_form_other_details_insert()
	{
		$this->load->model("profile_model");
		$updat_query="UPDATE tbl_complaints SET reporting_date		=	'".$this->profile_model->change_date_to_mysql_style($_POST['start_date']).' '.$_POST['start_time'].":0',
												name_of_customer_sign_pm_form				=	'".$_POST['name_of_customer_sign_pm_form']."',";
		//for AC?AU400
		if(isset($_POST['counter_in_front_of_equipment']))
		{
			$updat_query.="counter_in_front_of_equipment				=	'".$_POST['counter_in_front_of_equipment']."',";
		}
		//for KC4D
		if(isset($_POST['pt_kit_in_use']))
		{
			$updat_query.="pt_kit_in_use						=	'".$_POST['pt_kit_in_use']."',
							appt_kit_in_use						=	'".$_POST['appt_kit_in_use']."',
							fibrinogen_kit_in_use				=	'".$_POST['fibrinogen_kit_in_use']."',
							cups_and_balls_in_use				=	'".$_POST['cups_and_balls_in_use']."',";
		}
		
		$updat_query.="mobile_no_of_customer_sign_pm_form			=	'".$_POST['mobile_no_of_customer_sign_pm_form']."'
						 WHERE pk_complaint_id='" . $_POST['complaint_id'] . "'";
        $query=$this->db->query($updat_query);
		//
		if(isset($_POST['s_pm_form']))
		{
			redirect(site_url() . 'complaint/s_pm_form/'.$_POST['complaint_id'].'?msg_other_details=success');
		}
		else
		{
			redirect(site_url() . 'complaint/pm_form/'.$_POST['complaint_id'].'?msg_other_details=success');
		}
	}
	
	public function check_if_file_uploaded($complaint_id)
	{
		$query1="select * from tbl_pm_pictures WHERE fk_complaint_id='" . $complaint_id. "'";
        $query=$this->db->query($query1);
		$dbres=$query->result_array();
		$image = substr($this->input->post('my_image'),1,100);
		//
		if($dbres[0][$image]=='')
		{
			echo '<span class="label label-sm label-warning"> Not Uploaded </span>';
			echo '<input type="hidden" class="uploaded_not_uploaded" value="not_uploaded">';
		}
		else
		{
			echo '<span class="label label-sm label-success"> Uploaded </span>';
			echo '<input type="hidden" class="uploaded_not_uploaded" value="uploaded">';
		}
	}
	public function check_file_type($complaint_id)
	{
		$query1="select * from tbl_pm_pictures WHERE fk_complaint_id='" . $complaint_id. "'";
        $query=$this->db->query($query1);
		$dbres=$query->result_array();
		$image = substr($this->input->post('my_image'),1,100);
		//
		if($dbres[0][$image]=='')
		{
			echo '<button type="button" class="btn btn-default blue-madison-stripe"
				  data-toggle="modal" data-target="#'.$image.'">View Image</button>';
		}
		else
		{
			$file_name = explode('.',$dbres[0][$image]);
			if($file_name[1]=='png' || $file_name[1]=='gif' || $file_name[1]=='jpeg' || $file_name[1]=='jpg')
			{
				echo '<button type="button" class="btn btn-default blue-madison-stripe"
						data-toggle="modal" data-target="#'.$image.'">View Image</button>';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$complaint_id.'/'.$dbres[0][$image].'"
				 class="btn btn-default blue-madison-stripe" target="_blank">
				View File</a>';
			}
		}
	}
	public function pm_pictures_update()
	{
		define ('SITE_ROOT', dirname(dirname(dirname(__FILE__))));
		if (@$_FILES["picture_of_photocal"]["tmp_name"][0] == "") {
        } else {
			$dbres = $this->db->query("select * from tbl_pm_pictures where fk_complaint_id ='".$_POST['complaint_id']."'");
			$get_users_lists=$dbres->result_array();
			if($get_users_lists[0]["picture_of_photocal"]!="")
			{
            	
				$image_path = SITE_ROOT.'/usersimages/complaint_images/pm_form/' . $get_users_lists[0]["fk_complaint_id"] . '/' . $get_users_lists[0]["picture_of_photocal"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
           $path = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
            $fileData = pathinfo(basename($_FILES["picture_of_photocal"]["name"]));
            
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
			
            
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["picture_of_photocal"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_pm_pictures SET picture_of_photocal='" .$new_file_name . "' 
						 WHERE fk_complaint_id='" . $get_users_lists[0]["fk_complaint_id"] . "'";
            $query=$this->db->query($updat_query);
			echo '<div align="center">';
			if($image_extension=='png' || $image_extension=='gif' || $image_extension=='jpeg' ||$image_extension=='jpg')
			{
			echo '<img src="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'"malt="Thumbnail" class="img-responsive">';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'">Download File</a>';
			}
			echo '</div>';
			
        }
		if (@$_FILES["Picture_of_Reagent_Management"]["tmp_name"][0] == "") {
        } else {
			$dbres = $this->db->query("select * from tbl_pm_pictures where fk_complaint_id ='".$_POST['complaint_id']."'");
			$get_users_lists=$dbres->result_array();
			if($get_users_lists[0]["Picture_of_Reagent_Management"]!="")
			{
			$image_path = SITE_ROOT.'/usersimages/complaint_images/pm_form/' . $get_users_lists[0]["fk_complaint_id"] . '/' . $get_users_lists[0]["Picture_of_Reagent_Management"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
			$path = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
            $fileData = pathinfo(basename($_FILES["Picture_of_Reagent_Management"]["name"]));
            
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["Picture_of_Reagent_Management"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_pm_pictures SET Picture_of_Reagent_Management='" .$new_file_name . "' 
						 WHERE fk_complaint_id='" . $get_users_lists[0]["fk_complaint_id"] . "'";
            $query=$this->db->query($updat_query);
			echo '<div align="center">';
			if($image_extension=='png' || $image_extension=='gif' || $image_extension=='jpeg' ||$image_extension=='jpg')
			{
			echo '<img src="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'"malt="Thumbnail" class="img-responsive">';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'">Download File</a>';
			}
			echo '</div>';
        }
		//Operator_Maintenance_Sheet
		if (@$_FILES["Operator_Maintenance_Sheet"]["tmp_name"][0] == "") {
        } else {
			$dbres = $this->db->query("select * from tbl_pm_pictures where fk_complaint_id ='".$_POST['complaint_id']."'");
			$get_users_lists=$dbres->result_array();
			if($get_users_lists[0]["Operator_Maintenance_Sheet"]!="")
			{
			$image_path = SITE_ROOT.'/usersimages/complaint_images/pm_form/' . $get_users_lists[0]["fk_complaint_id"] . '/' . $get_users_lists[0]["Operator_Maintenance_Sheet"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
			$path = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
            $fileData = pathinfo(basename($_FILES["Operator_Maintenance_Sheet"]["name"]));
            
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["Operator_Maintenance_Sheet"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_pm_pictures SET Operator_Maintenance_Sheet='" .$new_file_name . "' 
						 WHERE fk_complaint_id='" . $get_users_lists[0]["fk_complaint_id"] . "'";
            $query=$this->db->query($updat_query);
			echo '<div align="center">';
			if($image_extension=='png' || $image_extension=='gif' || $image_extension=='jpeg' ||$image_extension=='jpg')
			{
			echo '<img src="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'"malt="Thumbnail" class="img-responsive">';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'">Download File</a>';
			}
			echo '</div>';
        }
		
		if (@$_FILES["Picture_of_Calibration_display_the_ISE_Maintenance_Menu"]["tmp_name"][0] == "") {
        } else {
			$dbres = $this->db->query("select * from tbl_pm_pictures where fk_complaint_id ='".$_POST['complaint_id']."'");
			$get_users_lists=$dbres->result_array();
			
			if($get_users_lists[0]["Picture_of_Calibration_display_the_ISE_Maintenance_Menu"]!="")
			{
				$image_path = SITE_ROOT.'/usersimages/complaint_images/pm_form/' . $get_users_lists[0]["fk_complaint_id"] . '/' . $get_users_lists[0]["Picture_of_Calibration_display_the_ISE_Maintenance_Menu"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
            
            $path = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
            $fileData = pathinfo(basename($_FILES["Picture_of_Calibration_display_the_ISE_Maintenance_Menu"]["name"]));
            
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["Picture_of_Calibration_display_the_ISE_Maintenance_Menu"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_pm_pictures SET Picture_of_Calibration_display_the_ISE_Maintenance_Menu='" .$new_file_name . "' 
						 WHERE fk_complaint_id='" . $get_users_lists[0]["fk_complaint_id"] . "'";
            $query=$this->db->query($updat_query);
			echo '<div align="center">';
			if($image_extension=='png' || $image_extension=='gif' || $image_extension=='jpeg' ||$image_extension=='jpg')
			{
			echo '<img src="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'"malt="Thumbnail" class="img-responsive">';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'">Download File</a>';
			}
			echo '</div>';        }
		if (@$_FILES["Picture_of_Selectivity_Check"]["tmp_name"][0] == "") {
        } else {
			$dbres = $this->db->query("select * from tbl_pm_pictures where fk_complaint_id ='".$_POST['complaint_id']."'");
			$get_users_lists=$dbres->result_array();
			
			if($get_users_lists[0]["Picture_of_Selectivity_Check"]!="")
			{
			   $image_path = SITE_ROOT.'/usersimages/complaint_images/pm_form/' . $get_users_lists[0]["fk_complaint_id"] . '/' . $get_users_lists[0]["Picture_of_Selectivity_Check"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
            
            $path = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
            $fileData = pathinfo(basename($_FILES["Picture_of_Selectivity_Check"]["name"]));
            
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["Picture_of_Selectivity_Check"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_pm_pictures SET Picture_of_Selectivity_Check='" .$new_file_name . "' 
						 WHERE fk_complaint_id='" . $get_users_lists[0]["fk_complaint_id"] . "'";
            $query=$this->db->query($updat_query);
			echo '<div align="center">';
			if($image_extension=='png' || $image_extension=='gif' || $image_extension=='jpeg' ||$image_extension=='jpg')
			{
			echo '<img src="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'"malt="Thumbnail" class="img-responsive">';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'">Download File</a>';
			}
			echo '</div>';
        }
		if (@$_FILES["Picture_of_ISE_Maintenance_Screen"]["tmp_name"][0] == "") {
        } else {
			$dbres = $this->db->query("select * from tbl_pm_pictures where fk_complaint_id ='".$_POST['complaint_id']."'");
			$get_users_lists=$dbres->result_array();
			
			if($get_users_lists[0]["Picture_of_ISE_Maintenance_Screen"]!="")
			{
				$image_path = SITE_ROOT.'/usersimages/complaint_images/pm_form/' . $get_users_lists[0]["fk_complaint_id"] . '/' . $get_users_lists[0]["Picture_of_ISE_Maintenance_Screen"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
            
            $path = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
            $fileData = pathinfo(basename($_FILES["Picture_of_ISE_Maintenance_Screen"]["name"]));
            
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["Picture_of_ISE_Maintenance_Screen"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_pm_pictures SET Picture_of_ISE_Maintenance_Screen='" .$new_file_name . "' 
						 WHERE fk_complaint_id='" . $get_users_lists[0]["fk_complaint_id"] . "'";
            $query=$this->db->query($updat_query);
			echo '<div align="center">';
			if($image_extension=='png' || $image_extension=='gif' || $image_extension=='jpeg' ||$image_extension=='jpg')
			{
			echo '<img src="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'"malt="Thumbnail" class="img-responsive">';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'">Download File</a>';
			}
			echo '</div>';
        }
		if (@$_FILES["Picture_of_Analyzer_Maintenance_Screen"]["tmp_name"][0] == "") {
        } else {
			$dbres = $this->db->query("select * from tbl_pm_pictures where fk_complaint_id ='".$_POST['complaint_id']."'");
			$get_users_lists=$dbres->result_array();
			
			if($get_users_lists[0]["Picture_of_Analyzer_Maintenance_Screen"]!="")
			{
				$image_path = SITE_ROOT.'/usersimages/complaint_images/pm_form/' . $get_users_lists[0]["fk_complaint_id"] . '/' . $get_users_lists[0]["Picture_of_Analyzer_Maintenance_Screen"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
            
            $path = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
            $fileData = pathinfo(basename($_FILES["Picture_of_Analyzer_Maintenance_Screen"]["name"]));
            
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["Picture_of_Analyzer_Maintenance_Screen"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_pm_pictures SET Picture_of_Analyzer_Maintenance_Screen='" .$new_file_name . "' 
						 WHERE fk_complaint_id='" . $get_users_lists[0]["fk_complaint_id"] . "'";
            $query=$this->db->query($updat_query);
			echo '<div align="center">';
			if($image_extension=='png' || $image_extension=='gif' || $image_extension=='jpeg' ||$image_extension=='jpg')
			{
			echo '<img src="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'"malt="Thumbnail" class="img-responsive">';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'">Download File</a>';
			}
			echo '</div>';
        }
		if (@$_FILES["Print_out_of_Reagent_Consumption_for_the_last_01_month_Page_1"]["tmp_name"][0] == "") {
        } else {
			$dbres = $this->db->query("select * from tbl_pm_pictures where fk_complaint_id ='".$_POST['complaint_id']."'");
			$get_users_lists=$dbres->result_array();
			
			if($get_users_lists[0]["Print_out_of_Reagent_Consumption_for_the_last_01_month_Page_1"]!="")
			{
				$image_path = SITE_ROOT.'/usersimages/complaint_images/pm_form/' . $get_users_lists[0]["fk_complaint_id"] . '/' . $get_users_lists[0]["Print_out_of_Reagent_Consumption_for_the_last_01_month_Page_1"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
            
            $path = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
            $fileData = pathinfo(basename($_FILES["Print_out_of_Reagent_Consumption_for_the_last_01_month_Page_1"]["name"]));
            
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["Print_out_of_Reagent_Consumption_for_the_last_01_month_Page_1"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_pm_pictures SET Print_out_of_Reagent_Consumption_for_the_last_01_month_Page_1='" .$new_file_name . "' 
						 WHERE fk_complaint_id='" . $get_users_lists[0]["fk_complaint_id"] . "'";
            $query=$this->db->query($updat_query);
			echo '<div align="center">';
			if($image_extension=='png' || $image_extension=='gif' || $image_extension=='jpeg' ||$image_extension=='jpg')
			{
			echo '<img src="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'"malt="Thumbnail" class="img-responsive">';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'">Download File</a>';
			}
			echo '</div>';
        }
		//
		if (@$_FILES["Print_out_of_Reagent_Consumption_for_the_last_01_month_Page_2"]["tmp_name"][0] == "") {
        } else {
			$dbres = $this->db->query("select * from tbl_pm_pictures where fk_complaint_id ='".$_POST['complaint_id']."'");
			$get_users_lists=$dbres->result_array();
			
			if($get_users_lists[0]["Print_out_of_Reagent_Consumption_for_the_last_01_month_Page_2"]!="")
			{
				$image_path = SITE_ROOT.'/usersimages/complaint_images/pm_form/' . $get_users_lists[0]["fk_complaint_id"] . '/' . $get_users_lists[0]["Print_out_of_Reagent_Consumption_for_the_last_01_month_Page_2"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
            
            $path = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
            $fileData = pathinfo(basename($_FILES["Print_out_of_Reagent_Consumption_for_the_last_01_month_Page_2"]["name"]));
            
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["Print_out_of_Reagent_Consumption_for_the_last_01_month_Page_2"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_pm_pictures SET Print_out_of_Reagent_Consumption_for_the_last_01_month_Page_2='" .$new_file_name . "' 
						 WHERE fk_complaint_id='" . $get_users_lists[0]["fk_complaint_id"] . "'";
            $query=$this->db->query($updat_query);
			echo '<div align="center">';
			if($image_extension=='png' || $image_extension=='gif' || $image_extension=='jpeg' ||$image_extension=='jpg')
			{
			echo '<img src="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'"malt="Thumbnail" class="img-responsive">';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'">Download File</a>';
			}
			echo '</div>';
        }
		//
		if (@$_FILES["Picture_of_Counter_in_the_Front_Lower_Right_Side_of_the_Analyzer"]["tmp_name"][0] == "") {
        } else {
			$dbres = $this->db->query("select * from tbl_pm_pictures where fk_complaint_id ='".$_POST['complaint_id']."'");
			$get_users_lists=$dbres->result_array();
			
			if($get_users_lists[0]["Picture_of_Counter_in_the_Front_Lower_Right_Side_of_the_Analyzer"]!="")
			{
				$image_path = SITE_ROOT.'/usersimages/complaint_images/pm_form/' . $get_users_lists[0]["fk_complaint_id"] . '/' . $get_users_lists[0]["Picture_of_Counter_in_the_Front_Lower_Right_Side_of_the_Analyzer"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
            
            $path = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
            $fileData = pathinfo(basename($_FILES["Picture_of_Counter_in_the_Front_Lower_Right_Side_of_the_Analyzer"]["name"]));
            
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["Picture_of_Counter_in_the_Front_Lower_Right_Side_of_the_Analyzer"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_pm_pictures SET Picture_of_Counter_in_the_Front_Lower_Right_Side_of_the_Analyzer='" .$new_file_name . "' 
						 WHERE fk_complaint_id='" . $get_users_lists[0]["fk_complaint_id"] . "'";
            $query=$this->db->query($updat_query);
			echo '<div align="center">';
			if($image_extension=='png' || $image_extension=='gif' || $image_extension=='jpeg' ||$image_extension=='jpg')
			{
			echo '<img src="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'"malt="Thumbnail" class="img-responsive">';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'">Download File</a>';
			}
			echo '</div>';
        }
		if (@$_FILES["PM_Form_with_Customer_Signature_Page_1"]["tmp_name"][0] == "") {
        } else {
			$dbres = $this->db->query("select * from tbl_pm_pictures where fk_complaint_id ='".$_POST['complaint_id']."'");
			$get_users_lists=$dbres->result_array();
			
			if($get_users_lists[0]["PM_Form_with_Customer_Signature_Page_1"]!="")
			{
				$image_path = SITE_ROOT.'/usersimages/complaint_images/pm_form/' . $get_users_lists[0]["fk_complaint_id"] . '/' . $get_users_lists[0]["PM_Form_with_Customer_Signature_Page_1"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
            
            $path = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
            $fileData = pathinfo(basename($_FILES["PM_Form_with_Customer_Signature_Page_1"]["name"]));
            
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["PM_Form_with_Customer_Signature_Page_1"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_pm_pictures SET PM_Form_with_Customer_Signature_Page_1='" .$new_file_name . "' 
						 WHERE fk_complaint_id='" . $get_users_lists[0]["fk_complaint_id"] . "'";
            $query=$this->db->query($updat_query);
			echo '<div align="center">';
			if($image_extension=='png' || $image_extension=='gif' || $image_extension=='jpeg' ||$image_extension=='jpg')
			{
			echo '<img src="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'"malt="Thumbnail" class="img-responsive">';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'">Download File</a>';
			}
			echo '</div>';
        }
		//2
		if (@$_FILES["PM_Form_with_Customer_Signature_Page_2"]["tmp_name"][0] == "") {
        } else {
			$dbres = $this->db->query("select * from tbl_pm_pictures where fk_complaint_id ='".$_POST['complaint_id']."'");
			$get_users_lists=$dbres->result_array();
			
			if($get_users_lists[0]["PM_Form_with_Customer_Signature_Page_2"]!="")
			{
				$image_path = SITE_ROOT.'/usersimages/complaint_images/pm_form/' . $get_users_lists[0]["fk_complaint_id"] . '/' . $get_users_lists[0]["PM_Form_with_Customer_Signature_Page_2"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
            
            $path = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
            $fileData = pathinfo(basename($_FILES["PM_Form_with_Customer_Signature_Page_2"]["name"]));
            
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["PM_Form_with_Customer_Signature_Page_2"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_pm_pictures SET PM_Form_with_Customer_Signature_Page_2='" .$new_file_name . "' 
						 WHERE fk_complaint_id='" . $get_users_lists[0]["fk_complaint_id"] . "'";
            $query=$this->db->query($updat_query);
			echo '<div align="center">';
			if($image_extension=='png' || $image_extension=='gif' || $image_extension=='jpeg' ||$image_extension=='jpg')
			{
			echo '<img src="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'"malt="Thumbnail" class="img-responsive">';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'">Download File</a>';
			}
			echo '</div>';
        }
		//3
		if (@$_FILES["PM_Form_with_Customer_Signature_Page_3"]["tmp_name"][0] == "") {
        } else {
			$dbres = $this->db->query("select * from tbl_pm_pictures where fk_complaint_id ='".$_POST['complaint_id']."'");
			$get_users_lists=$dbres->result_array();
			
			if($get_users_lists[0]["PM_Form_with_Customer_Signature_Page_3"]!="")
			{
				$image_path = SITE_ROOT.'/usersimages/complaint_images/pm_form/' . $get_users_lists[0]["fk_complaint_id"] . '/' . $get_users_lists[0]["PM_Form_with_Customer_Signature_Page_3"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
            
            $path = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
            $fileData = pathinfo(basename($_FILES["PM_Form_with_Customer_Signature_Page_3"]["name"]));
            
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["PM_Form_with_Customer_Signature_Page_3"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_pm_pictures SET PM_Form_with_Customer_Signature_Page_3='" .$new_file_name . "' 
						 WHERE fk_complaint_id='" . $get_users_lists[0]["fk_complaint_id"] . "'";
            $query=$this->db->query($updat_query);
			echo '<div align="center">';
			if($image_extension=='png' || $image_extension=='gif' || $image_extension=='jpeg' ||$image_extension=='jpg')
			{
			echo '<img src="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'"malt="Thumbnail" class="img-responsive">';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'">Download File</a>';
			}
			echo '</div>';
        }
		//4
		if (@$_FILES["PM_Form_with_Customer_Signature_Page_4"]["tmp_name"][0] == "") {
        } else {
			$dbres = $this->db->query("select * from tbl_pm_pictures where fk_complaint_id ='".$_POST['complaint_id']."'");
			$get_users_lists=$dbres->result_array();
			
			if($get_users_lists[0]["PM_Form_with_Customer_Signature_Page_4"]!="")
			{
				$image_path = SITE_ROOT.'/usersimages/complaint_images/pm_form/' . $get_users_lists[0]["fk_complaint_id"] . '/' . $get_users_lists[0]["PM_Form_with_Customer_Signature_Page_4"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
            
            $path = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
            $fileData = pathinfo(basename($_FILES["PM_Form_with_Customer_Signature_Page_4"]["name"]));
            
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["PM_Form_with_Customer_Signature_Page_4"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_pm_pictures SET PM_Form_with_Customer_Signature_Page_4='" .$new_file_name . "' 
						 WHERE fk_complaint_id='" . $get_users_lists[0]["fk_complaint_id"] . "'";
            $query=$this->db->query($updat_query);
			echo '<div align="center">';
			if($image_extension=='png' || $image_extension=='gif' || $image_extension=='jpeg' ||$image_extension=='jpg')
			{
			echo '<img src="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'"malt="Thumbnail" class="img-responsive">';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'">Download File</a>';
			}
			echo '</div>';
        }
		//
		if (@$_FILES["DC_of_any_spare_parts_changed"]["tmp_name"][0] == "") {
        } else {
			$dbres = $this->db->query("select * from tbl_pm_pictures where fk_complaint_id ='".$_POST['complaint_id']."'");
			$get_users_lists=$dbres->result_array();
			
			if($get_users_lists[0]["DC_of_any_spare_parts_changed"]!="")
			{
				$image_path = SITE_ROOT.'/usersimages/complaint_images/pm_form/' . $get_users_lists[0]["fk_complaint_id"] . '/' . $get_users_lists[0]["DC_of_any_spare_parts_changed"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
            
            $path = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
            $fileData = pathinfo(basename($_FILES["DC_of_any_spare_parts_changed"]["name"]));
            
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["DC_of_any_spare_parts_changed"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_pm_pictures SET DC_of_any_spare_parts_changed='" .$new_file_name . "' 
						 WHERE fk_complaint_id='" . $get_users_lists[0]["fk_complaint_id"] . "'";
						 //echo $updat_query;exit;
            $query=$this->db->query($updat_query);
			echo '<div align="center">';
			if($image_extension=='png' || $image_extension=='gif' || $image_extension=='jpeg' ||$image_extension=='jpg')
			{
			echo '<img src="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'"malt="Thumbnail" class="img-responsive">';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'">Download File</a>';
			}
			echo '</div>';
        }
		
		
		//
		if (@$_FILES["Run_Time"]["tmp_name"][0] == "") {
        } else {
			$dbres = $this->db->query("select * from tbl_pm_pictures where fk_complaint_id ='".$_POST['complaint_id']."'");
			$get_users_lists=$dbres->result_array();
			
			if($get_users_lists[0]["Run_Time"]!="")
			{
				$image_path = SITE_ROOT.'/usersimages/complaint_images/pm_form/' . $get_users_lists[0]["fk_complaint_id"] . '/' . $get_users_lists[0]["Run_Time"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
            
            $path = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
            $fileData = pathinfo(basename($_FILES["Run_Time"]["name"]));
            
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["Run_Time"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_pm_pictures SET Run_Time='" .$new_file_name . "' 
						 WHERE fk_complaint_id='" . $get_users_lists[0]["fk_complaint_id"] . "'";
						 //echo $updat_query;exit;
            $query=$this->db->query($updat_query);
			echo '<div align="center">';
			if($image_extension=='png' || $image_extension=='gif' || $image_extension=='jpeg' ||$image_extension=='jpg')
			{
			echo '<img src="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'"malt="Thumbnail" class="img-responsive">';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'">Download File</a>';
			}
			echo '</div>';
        }
		
		if (@$_FILES["Pressure_Monitor"]["tmp_name"][0] == "") {
        } else {
			$dbres = $this->db->query("select * from tbl_pm_pictures where fk_complaint_id ='".$_POST['complaint_id']."'");
			$get_users_lists=$dbres->result_array();
			
			if($get_users_lists[0]["Pressure_Monitor"]!="")
			{
				$image_path = SITE_ROOT.'/usersimages/complaint_images/pm_form/' . $get_users_lists[0]["fk_complaint_id"] . '/' . $get_users_lists[0]["Pressure_Monitor"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
            
            $path = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
            $fileData = pathinfo(basename($_FILES["Pressure_Monitor"]["name"]));
            
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["Pressure_Monitor"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_pm_pictures SET Pressure_Monitor='" .$new_file_name . "' 
						 WHERE fk_complaint_id='" . $get_users_lists[0]["fk_complaint_id"] . "'";
						 //echo $updat_query;exit;
            $query=$this->db->query($updat_query);
			echo '<div align="center">';
			if($image_extension=='png' || $image_extension=='gif' || $image_extension=='jpeg' ||$image_extension=='jpg')
			{
			echo '<img src="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'"malt="Thumbnail" class="img-responsive">';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'">Download File</a>';
			}
			echo '</div>';
        }
		
		if (@$_FILES["Level_Sense_Test_Report"]["tmp_name"][0] == "") {
        } else {
			$dbres = $this->db->query("select * from tbl_pm_pictures where fk_complaint_id ='".$_POST['complaint_id']."'");
			$get_users_lists=$dbres->result_array();
			
			if($get_users_lists[0]["Level_Sense_Test_Report"]!="")
			{
				$image_path = SITE_ROOT.'/usersimages/complaint_images/pm_form/' . $get_users_lists[0]["fk_complaint_id"] . '/' . $get_users_lists[0]["Level_Sense_Test_Report"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
            
            $path = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
            $fileData = pathinfo(basename($_FILES["Level_Sense_Test_Report"]["name"]));
			
			
			$image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
			
            
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["Level_Sense_Test_Report"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_pm_pictures SET Level_Sense_Test_Report='" .$new_file_name . "' 
						 WHERE fk_complaint_id='" . $get_users_lists[0]["fk_complaint_id"] . "'";
            $query=$this->db->query($updat_query);
			echo '<div align="center">';
			if($image_extension=='png' || $image_extension=='gif' || $image_extension=='jpeg' ||$image_extension=='jpg')
			{
			echo '<img src="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'"malt="Thumbnail" class="img-responsive">';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'">Download File</a>';
			}
			echo '</div>';
			
        }
		if (@$_FILES["Temperature_Report"]["tmp_name"][0] == "") {
        } else {
			$dbres = $this->db->query("select * from tbl_pm_pictures where fk_complaint_id ='".$_POST['complaint_id']."'");
			$get_users_lists=$dbres->result_array();
			
			if($get_users_lists[0]["Temperature_Report"]!="")
			{
				$image_path = SITE_ROOT.'/usersimages/complaint_images/pm_form/' . $get_users_lists[0]["fk_complaint_id"] . '/' . $get_users_lists[0]["Temperature_Report"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
            
            $path = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
            $fileData = pathinfo(basename($_FILES["Temperature_Report"]["name"]));
			
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
			
            
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["Temperature_Report"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_pm_pictures SET Temperature_Report='" .$new_file_name . "' 
						 WHERE fk_complaint_id='" . $get_users_lists[0]["fk_complaint_id"] . "'";
            $query=$this->db->query($updat_query);
			echo '<div align="center">';
			if($image_extension=='png' || $image_extension=='gif' || $image_extension=='jpeg' ||$image_extension=='jpg')
			{
			echo '<img src="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'"malt="Thumbnail" class="img-responsive">';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'">Download File</a>';
			}
			echo '</div>';
        }
		//1
		if (@$_FILES["Full_System_Check_Results_Page_1"]["tmp_name"][0] == "") {
        } else {
			$dbres = $this->db->query("select * from tbl_pm_pictures where fk_complaint_id ='".$_POST['complaint_id']."'");
			$get_users_lists=$dbres->result_array();
			
			if($get_users_lists[0]["Full_System_Check_Results_Page_1"]!="")
			{
				$image_path = SITE_ROOT.'/usersimages/complaint_images/pm_form/' . $get_users_lists[0]["fk_complaint_id"] . '/' . $get_users_lists[0]["Full_System_Check_Results_Page_1"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
            
            $path = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
            $fileData = pathinfo(basename($_FILES["Full_System_Check_Results_Page_1"]["name"]));
            
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
			
            
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["Full_System_Check_Results_Page_1"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_pm_pictures SET Full_System_Check_Results_Page_1='" .$new_file_name . "' 
						 WHERE fk_complaint_id='" . $get_users_lists[0]["fk_complaint_id"] . "'";
            $query=$this->db->query($updat_query);
			echo '<div align="center">';
			if($image_extension=='png' || $image_extension=='gif' || $image_extension=='jpeg' ||$image_extension=='jpg')
			{
			echo '<img src="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'"malt="Thumbnail" class="img-responsive">';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'">Download File</a>';
			}
			echo '</div>';
			
        }
		//2
		if (@$_FILES["Full_System_Check_Results_Page_2"]["tmp_name"][0] == "") {
        } else {
			$dbres = $this->db->query("select * from tbl_pm_pictures where fk_complaint_id ='".$_POST['complaint_id']."'");
			$get_users_lists=$dbres->result_array();
			
			if($get_users_lists[0]["Full_System_Check_Results_Page_2"]!="")
			{
				$image_path = SITE_ROOT.'/usersimages/complaint_images/pm_form/' . $get_users_lists[0]["fk_complaint_id"] . '/' . $get_users_lists[0]["Full_System_Check_Results_Page_2"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
            
            $path = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			$target_dir = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
            $fileData = pathinfo(basename($_FILES["Full_System_Check_Results_Page_2"]["name"]));
            
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
			
            
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["Full_System_Check_Results_Page_2"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_pm_pictures SET Full_System_Check_Results_Page_2='" .$new_file_name . "' 
						 WHERE fk_complaint_id='" . $get_users_lists[0]["fk_complaint_id"] . "'";
            $query=$this->db->query($updat_query);
			echo '<div align="center">';
			if($image_extension=='png' || $image_extension=='gif' || $image_extension=='jpeg' ||$image_extension=='jpg')
			{
			echo '<img src="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'"malt="Thumbnail" class="img-responsive">';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'">Download File</a>';
			}
			echo '</div>';
			
        }
		if (@$_FILES["Picture_of_Total_Tests_performed_in_last_30_days"]["tmp_name"][0] == "") {
        } else {
			$dbres = $this->db->query("select * from tbl_pm_pictures where fk_complaint_id ='".$_POST['complaint_id']."'");
			$get_users_lists=$dbres->result_array();
			
			if($get_users_lists[0]["Picture_of_Total_Tests_performed_in_last_30_days"]!="")
			{
				$image_path = SITE_ROOT.'/usersimages/complaint_images/pm_form/' . $get_users_lists[0]["fk_complaint_id"] . '/' . $get_users_lists[0]["Picture_of_Total_Tests_performed_in_last_30_days"];
				if (file_exists($image_path)) {
					unlink($image_path);
				}
			}
            /*             * * ** */
			
            
            
			$path = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
			
			if (!file_exists($path)) {
				mkdir($path, 0777);
			}
			
			$target_dir = SITE_ROOT.'/usersimages/complaint_images/pm_form/'. $get_users_lists[0]["fk_complaint_id"].'/';
            $fileData = pathinfo(basename($_FILES["Picture_of_Total_Tests_performed_in_last_30_days"]["name"]));
            
            $image_extension = strtolower($fileData["extension"]); //image extension
			$image_name_only = strtolower($fileData["filename"]);//file name only, no extension
			$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
			
			
            
            $target_dir = $target_dir . $new_file_name;
            if (move_uploaded_file($_FILES["Picture_of_Total_Tests_performed_in_last_30_days"]["tmp_name"], $target_dir)) 
			{
				//echo "do somthing";
            } 
			else 
			{
				//echo 'nothing';
            }
			$updat_query="UPDATE tbl_pm_pictures SET Picture_of_Total_Tests_performed_in_last_30_days='" .$new_file_name . "' 
						 WHERE fk_complaint_id='" . $get_users_lists[0]["fk_complaint_id"] . "'";
            $query=$this->db->query($updat_query);
			echo '<div align="center">';
			if($image_extension=='png' || $image_extension=='gif' || $image_extension=='jpeg' ||$image_extension=='jpg')
			{
			echo '<img src="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'"malt="Thumbnail" class="img-responsive">';
			}
			else
			{
				echo '<a href="'.base_url().'usersimages/complaint_images/pm_form/'.$get_users_lists[0]["fk_complaint_id"].'/'.$new_file_name.'">Download File</a>';
			}
			echo '</div>';
			
        }
		//redirect(site_url() . 'complaint/pm_form/'.$_POST['complaint_id']);
	}
	public function delete_fine($id)
	{
		$query="delete from tbl_fine 
								where pk_fine_id			= 	'".$id."'
							  ";
			  //echo $query;exit;
			  $dbres = $this->db->query($query);
		redirect(site_url() . 'complaint/all_fines?del=success');
	}
	public function delete_warning_letter($id)
	{
		$query="delete from tbl_warning_letters 
								where pk_warning_letter_id			= 	'".$id."'
							  ";
			  //echo $query;exit;
			  $dbres = $this->db->query($query);
		redirect(site_url() . 'complaint/all_warning_letters?del=success');
	}
	
}

/* End of file complaint.php */
/* Location: ./application/controllers/inbox.php */