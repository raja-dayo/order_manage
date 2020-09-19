<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Vender extends Ci_controller{

		public function __construct()
		{
			parent::__construct();

			$this->load->model("VenderModel", "Vender");

			$this->load->helper("form");

			$this->load->model("Admin_Vender_Model", "AdminVender");

			if(!isset($_SESSION['data']['vender']))
			{
				return redirect("login");	
			}
		}

		public function dashboard()
		{
			$result=$this->Vender->countOrder();

			$data['pro_ord']=$this->Vender->countOrderProcess();

			$data['deliver_ord']=$this->Vender->countOrderDeliver();

			$data['refund_orders']=$this->Vender->countRefundOrder();

			$data['customers']=$this->Vender->count_customer_model();
			
			$data['result']=$result;
			
			$this->load->view("vender/dashboard", $data);
		}

		public function profile()
		{
			$data['vendor']=$this->Vender->getVendorModel($_SESSION['data']['vender']['id']);
			$data['countries']=$this->Vender->getCountry();
			
			$this->load->view("vender/profile",$data);
		}

		public function updateVendor()
		{

			//echo "<pre>";
			//print_r($_REQUEST);
			$enc_password = urldecode($this->encrypt->encode($_REQUEST['password']));


			//echo $password;
			extract($_REQUEST);
			//print_r($_FILES);
			
			if($_FILES['image']['name']=="")
			{
				$flag=$this->Vender->updateVandorProfileModel($_SESSION['data']['vender']['id'], $firstname, $lastname, $enc_password, $number, $country, $file_name, $site);
				
				if($flag)
				{
					$_SESSION['data']['vender']['image']=$file_name;
					
					return redirect("vender/profile");
				}
				else
				{
					echo "wrong";
				}
			}
			else
			{
				$config['upload_path']          = './assets/img';
	            $config['allowed_types']        = 'gif|jpg|png|jpeg';
	            $config['max_size']             = 150;
	            $config['max_width']            = 2300;
	            $config['max_height']           = 1400;  

	            $this->load->library('upload', $config);

            	if ($this->upload->do_upload("image"))
	            {
					$enc_password = urldecode($this->encrypt->encode($_REQUEST['password']));
                	
                	extract($_REQUEST);

	                $data = array('upload_data' => $this->upload->data());

	                $file_name= $data['upload_data']['file_name'];

	                $flag=$this->Vender->updateVandorProfileModel($_SESSION['data']['vender']['id'], $firstname, $lastname, $enc_password, $number, $country, $file_name, $site);
	                $_SESSION['data']['vender']['image']=$file_name;
	            	
	            	if($flag)
	            	{
	            		return redirect("vender/profile");
	            	}
	            	else
	            	{
	            		echo "no";
	            	}
	            }
	             else
	            {
	            	$data=$this->upload->display_errors();
	            	
	            	$this->session->set_flashdata("msg",$data);
	            }
			}
		}

		public function newOrder()
		{	
			$data['products']=$this->AdminVender->productsModel();

			$data['agents']=$this->Vender->get_agent_model($_SESSION['data']['vender']['id']);
			
			$data['payment_methods']=$this->Vender->payment_method_model();

			$data['countries']=$this->Vender->getCountry();

			$this->load->view("vender/newOrder", $data);
		}

		public function order()
		{
			$data['records']=$this->Vender->orderList();

			$this->load->view("vender/order",$data);
		}

		public function orderSave()
		{		
			if(!isset($_REQUEST['cardNumber']) || !isset($_REQUEST['cardType']) || !isset($_REQUEST['cvvCode']) || !isset($_REQUEST['expiryDate']))
			{ 
				$_REQUEST['cardNumber'] ="NULL";
				$_REQUEST['cardType']	="NULL";
				$_REQUEST['cvvCode']	="NULL";
				$_REQUEST['expiryDate'] ="NULL";		
			}
			if(!isset($_REQUEST['agent']))
			{
				$_REQUEST['agent'] ="NULL";
				$_REQUEST['pm_percentage'] ="NULL";
			}
			
			extract($_REQUEST);

			$rst=$this->AdminVender->getSingleDeliveryMethod($d_method);
			/*if($d_method==1){

				$d_charges=15;
			}else if($d_method==2){
				$d_charges=22.5;
			}else{
				$d_charges=38;
			}*/
			//die;
			if($hidden_customer_id=="")
				
			{
				$_REQUEST['customer_id'] = rawurldecode($this->encrypt->decode($customer_id));
				$_REQUEST['vender_id'] =$_SESSION['data']['vender']['id'];
		
				foreach ($_SESSION['product'] as $key => $product) {
					
					$result=$this->AdminVender->addOrderDetail($orderNo, $product['pro'], $product['qun'], $product['cost']);
				
				    $amount[]=$product['qun']*$product['cost'];
				}
					
				$_REQUEST['amount']=array_sum($amount)+$rst[0]['d_shipping_charges'];
				
				$result=$this->AdminVender->addOrder($_REQUEST);

				if($result)
				{
					unset($_SESSION['product']);
					$this->session->set_flashdata('msg', "Order No $orderNo Has Added Successfully");
						
					return redirect("vender/newOrder");
				}
			}
			else
			{
				$_REQUEST['customer_id'] = $hidden_customer_id;
				
				$_REQUEST['vender_id'] =$_SESSION['data']['vender']['id'];
				
				foreach ($_SESSION['product'] as $key => $product) {
					
					$result=$this->AdminVender->addOrderDetail($orderNo, $product['pro'], $product['qun'], $product['cost']);

					$amount[]=$product['qun']*$product['cost'];
				}

				$_REQUEST['amount']=array_sum($amount)+$rst[0]['d_shipping_charges'];

				$result=$this->AdminVender->addOrder($_REQUEST);

				if($result)
				{
					unset($_SESSION['product']);
					$this->session->set_flashdata('msg', "Order Has $orderNo Added Successfully");
						
					return redirect("vender/newOrder");
				}
			}				
		}

		public function add_more(){

			/*
			$abc=$this->AdminVender->get_product_name($_POST['data']['pro']);
			
			$_POST['data']['product']=$abc[0]['product'];
			$_POST['data']['total']=$_POST['data']['cost']*$_POST['data']['qun'];


			$_SESSION['product'][]=$_POST['data'];
			echo json_encode($_POST);*/

			$cost = $_POST['data']['cost'];
			$abc=$this->AdminVender->get_product_name($_POST['data']['pro']);
			
			$_POST['data']['product']=$abc[0]['product'];
			$_POST['data']['total']=$_POST['data']['qun']*$cost;


			$_SESSION['product'][]=$_POST['data'];
			echo json_encode($_POST);



		}

		public function delete_pro(){

			//echo "<pre>";
			//print_r($_SESSION['product']);
			foreach ($_SESSION['product'] as $key => $product) {
				if($product['pro']==$_POST['id']){
					unset($_SESSION['product'][$key]);
				}
			}
			//echo "<pre>";
			//print_r($_SESSION['product']);
			echo json_encode($_SESSION['product']);
		}

		public function add_another_product_page(){

			$result['products']=$this->AdminVender->productsModel();

			$this->load->view('vender/multiple_product_page',$result);
		}

		public function add_multiple_product(){

			$this->AdminVender->addOrderDetail($_REQUEST['orderNo'], $_REQUEST['product_id'], $_REQUEST['quantity'], $_REQUEST['sell_pro']);
			
			return redirect('vender/order');
		}

		public function updateOrderForm()
		{
			//$data['order'] $_REQUEST['orderId'];
			$data['result']		=$this->Vender->orderEditModel($_REQUEST['orderId']);
			$data['products']	=$this->AdminVender->productsModel();
				
				//echo "<pre>";

				//print_r($data);
				//die;
			$this->load->view("vender/updateOrderForm",$data);
		}

		public function deleteOrder()
		{
			
			$flag=$this->Vender->deleteOrderModel($_REQUEST['orderId']);
		

			if($flag)
			{
				return redirect("vender/order");
			}
			else
			{
				echo "not ok";
			}
		}

		public function customerForm()
		{
			$countries=$this->Vender->getCountry();

			$data['countries']=$countries;

			$this->load->view("vender/addCustomer", $data);
		}

		public function addCustomer()
		{
			if($_REQUEST['state_id']==""){
				
				$_REQUEST['state_id']=$_REQUEST['state'];
			}

			$record=$this->Vender->addCustomerModel($_REQUEST);
			
			$abc= $record[0]['firstName']." ".$record[0]['lastName'];
			
			$xyz=$record[0]['customer_id'];

			$this->session->set_flashdata('alpha', $abc);
			
			$this->session->set_flashdata('bita', $xyz);

			if($record)
			{
				return redirect("vender/newOrder");
			}
			else
			{
				echo "No";
			}
		}

		public function customerList()
		{
			$records=$this->Vender->getCustomerModel();

			$data['records']=$records;

			$this->load->view("vender/customerList", $data);
		}

		public function updateCustomerForm()
		{
			$customerId= rawurldecode($this->encrypt->decode($_REQUEST['customerId']));

			$data['result']=$this->Vender->editCustomerModel($customerId);
			
			$data['countries']=$this->Vender->getCountry();
			
			//$customer_state= $data['customer'][0]['state_id'];

			//$data['states']=$this->Vender->getState($customer_state);
			
			$this->load->view("vender/updateForm",$data);
		}

		public function orderUpdate()
		{
			//echo "<pre>";
			//print_r($_REQUEST);
			if(isset($_REQUEST['cancel']))
			{
				return redirect("vender/order");
			}
			else
			{
				extract($_REQUEST);
				$flag=$this->Vender->orderUpdateModel($order_id, $customer_id, $product_id, $orderNo, $sell_pro, $quantity);
				
				if($flag)
				{
					$this->session->set_flashdata('msg', " $orderNo Order Has Updated");
					
					return redirect("vender/order");
				}
				else
				{
					echo "no";
				}
			}
		}

		public function deleteCustomer()
		{
			$_REQUEST['customerId'];

			return redirect("vender/customerList");
		}

		public function checkEmail()
		{
			$flag=$this->Vender->getEMailModel($_REQUEST['email']);
			
			if($flag)
			{
				echo "Email already exits";
			}
		}

		public function search()
		{
			$pattern=$_POST['pattern'];

			if(!empty($pattern))
			{
				$records=$this->AdminVender->searchModel($pattern);
				
				if(!empty($records))
				{
					?>
						<ul>
							<?php
								foreach ($records as $key => $emails) {
									$name=$emails['firstName'];//." ".$emails['lastName'];

									$encryptId=urldecode($this->encrypt->encode($emails['customer_id']));
									?>
										<li style="padding: 3px;"><a href="<?php echo site_url("vender/newOrder?customer_name=$name&customer_id=$encryptId"); ?>"><?php echo $name;?></a></li>
									<?php
								}
							?>
						</ul>
					<?php
				}
				else
				{
					?>
						<a href="<?php echo site_url("vender/customerForm")?>"  >Add Customer</a>
					<?php
				}			
			}			
		}

		public function getStates()
		{
			$records=$this->Vender->getStateModel($_REQUEST['country_id']);

			echo json_encode($records);
		}

		public function updateCustomer()
		{
				$_REQUEST['c_id']= rawurldecode($this->encrypt->decode($_REQUEST['customer_id']));

				//echo "<pre>";
				//print_r($_REQUEST);
				//extract($_REQUEST);
				
				//die;
				//$flag=$this->Vender->updateCustomerModel($firstName, $lastName, $email, 
				//$phoneNumber, $country_id ,$state_id, $address ,$postalCode, $customer_notes,$customerId);
				$flag=$this->AdminVender->updateCustomerModel($_REQUEST,$_REQUEST['c_id']);
				if($flag)
				{
					$this->session->set_flashdata('msg', 'Customer Has Updated Successfully');
					
					return redirect("vender/customerList");
				}
				else
				{
					echo "No";
				}
			
		}

		public function order_view()
		{ 
			
			$data['orders']=$this->AdminVender->orderViewModel($_POST['order_id']);
			
			$this->load->view("vender/orderView",$data);
		}

		public function deliver_orders()
		{
			$data['records']=$this->Vender->deliverOrdersModel();
			
			$this->load->view("vender/deliver_orders",$data);
		}

		public function get_product_cost()
		{
			$_POST['product_id'];

			$result=$this->Vender->productCostModel($_POST['product_id']);
			
			//echo $result[0]['prize'];
			
			echo json_encode($result);
		}

		public function refund_orders()
		{
			$data['refund_orders']=$this->Vender->refund_order_list_model($_SESSION['data']['vender']['id']);
			
			$this->load->view("vender/refund_orders",$data);
		}

		public function pending_orders()
		{
			$data['pending_orders']=$this->Vender->pending_orders_model($_SESSION['data']['vender']['id']);
			
			$this->load->view("vender/pending_orders",$data);
		}

		public function process_order()
		{
			$data["inProcess_orders"]=$this->Vender->inProcess_orders_model($_SESSION['data']['vender']['id']);
			
			$this->load->view("vender/in_process_orders",$data);
		}

		public function agentForm()
		{
			$data['countries']=$this->Vender->getCountry();
			
			$this->load->view("vender/agent_form",$data);
		}

		public function add_agent()
		{
			extract($_REQUEST);

			$vender_id=$_SESSION['data']['vender']['id'];
			
			$result=$this->Vender->add_agent_model($vender_id, $name, $lname, $number, $agent_per, $country_id, $state_id);

			if($result)
			{
				$this->session->set_flashdata("msg", "Agent Add Successfully");

				return redirect("vender/agentform");
			}
		}

		public function agentList()
		{
			$data['records']=$this->Vender->get_agent_model($_SESSION['data']['vender']['id']);


			$this->load->view("vender/agent_list",$data);
		}

		public function agents_action()
		{
			echo "under process";
		}
	}
?>