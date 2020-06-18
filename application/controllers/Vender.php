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
			
			$this->load->view("Vender/dashboard", $data);
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
			$result=$this->AdminVender->productsModel();

			$data['agents']=$this->Vender->agentModel();
			
			$data['products']=$result;

			$this->load->view("vender/newOrder", $data);
		}

		public function order()
		{
			$records=$this->Vender->orderList();
			
			$data['records']=$records;

			//echo "<pre>";
			//print_r($data);
			$this->load->view("vender/order",$data);
		}

		public function orderSave()
		{		
			//ECHO "<pre>";
			//print_r($_REQUEST);
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
			}
			
			//print_r($_REQUEST);
			extract($_REQUEST);
			//die;
				if($hidden_customer_id=="")
				
				{
					//$customer_id = rawurldecode($this->encrypt->decode($_REQUEST['customer_id']));	
					
					 $customer_id = rawurldecode($this->encrypt->decode($customer_id));
					//$result=$this->Vender->addOrder($_REQUEST['orderNo'], $customer_id, $_REQUEST['product_id'], $_REQUEST['quantity'],$_REQUEST['sell_pro']);
					 //echo "<br/>";
					 //echo $cardNumber." ".$cardType." ".$cvvCode." ".$expiryDate;

					
					$result=$this->Vender->addOrder($orderNo, $customer_id, $product_id, $quantity, $sell_pro, $p_method, $agent, $cardType, $cardNumber, $cvvCode, $expiryDate);
					if($result)
					{
						$this->session->set_flashdata('msg', 'Order Has Added Successfully');
						
						return redirect("vender/newOrder");
					}
				}
				else
				{
					 $customer_id = $hidden_customer_id;
					

					//$result=$this->Vender->addOrder($_REQUEST['orderNo'], $customer_id, $_REQUEST['product_id'], $_REQUEST['quantity']);

					$result=$this->Vender->addOrder($orderNo, $customer_id, $product_id, $quantity, $sell_pro, $p_method, $agent, $cardType, $cardNumber, $cvvCode, $expiryDate);
					if($result)
					{
						$this->session->set_flashdata('msg', 'Order Has Added Successfully');
						
						return redirect("vender/newOrder");
					}
				}
				

			
			/*else if(isset($p_method) && $p_method=="cradit card")
			{
				echo $cardType;
			}
			die;*/
			/*if($_REQUEST['hidden_customer_id']=="")
			{
				$customer_id = rawurldecode($this->encrypt->decode($_REQUEST['customer_id']));	
				
				$result=$this->Vender->addOrder($_REQUEST['orderNo'], $customer_id, $_REQUEST['product_id'], $_REQUEST['quantity'],$_REQUEST['sell_pro']);

				if($result)
				{
					$this->session->set_flashdata('msg', 'Order Has Added Successfully');
					
					return redirect("vender/newOrder");
				}
			}
			else
			{
				$customer_id = $_REQUEST['hidden_customer_id'];
			

				$result=$this->Vender->addOrder($_REQUEST['orderNo'], $customer_id, $_REQUEST['product_id'], $_REQUEST['quantity']);

				if($result)
				{
					$this->session->set_flashdata('msg', 'Order Has Added Successfully');
					
					return redirect("vender/newOrder");
				}
			}*/
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

		public function updateForm()
		{
			$customerId= rawurldecode($this->encrypt->decode($_REQUEST['customerId']));

			$customer=$this->Vender->editCustomerModel($customerId);
			
			$country=$this->Vender->getCountry();
			
			$data['customer']=$customer;
			
			$data['countries']=$country;
			
			$customer_state= $data['customer'][0]['state_id'];

			$data['states']=$this->Vender->getState($customer_state);

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
				//echo "<pre>";
				//print_r($_REQUEST);
				//die;
				extract($_REQUEST);
				$flag=$this->Vender->orderUpdateModel($order_id, $customer_id, $product_id, $orderNo, $sell_pro, $quantity);
				
				if($flag)
				{
					$this->session->set_flashdata('msg', " $orderNo Order Has Updated");
					
					return redirect("vender/order");
					//echo "yes";
				}
				else
				{
					echo "no";
				}
			}
		}

		public function addCustomer()
		{
			extract($_REQUEST);

			
			$record=$this->Vender->addCustomerModel($firstName, $lastName, $email, 
			$phoneNumber, $country_id ,$state_id, $address ,$postalCode, $customer_notes);
			
			
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

		public function checkEmail()
		{
			$flag=$this->Vender->getEMailModel($_REQUEST['email']);
			
			if($flag)
			{
				echo "Email already exits";
			}
		}

		public function customerList()
		{
			$records=$this->Vender->getCustomerModel();

			$data['records']=$records;

			$this->load->view("vender/customerList", $data);
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
									$name=$emails['firstName']." ".$emails['lastName'];

									$encryptId=urldecode($this->encrypt->encode($emails['customer_id']));
									?>
										<li style="padding: 3px;"><a href="<?php echo site_url("vender/newOrder?customer_name=$name&customer_id=$encryptId"); ?>"><?php echo $emails['email']?></a></li>
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
			
			$data['records']= $records;
			
			$this->load->view("vender/ajaxStates", $data);
		}

		public function updateCustomer()
		{
			if(isset($_REQUEST['cancel']))
			{
				return redirect("vender/customerList");
			}
			else
			{
				$customerId= rawurldecode($this->encrypt->decode($_REQUEST['customer_id']));

				//echo "<pre>";
				//print_r($_REQUEST);
				extract($_REQUEST);
				
				//die;
				$flag=$this->Vender->updateCustomerModel($firstName, $lastName, $email, 
				$phoneNumber, $country_id ,$state_id, $address ,$postalCode, $customer_notes,$customerId);

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
		}

		public function order_view()
		{ 
			//echo "<pre>";
			//print_r($_REQUEST);
			//die;
			$data['order']=$this->Vender->orderViewModel($_POST['order_id']);
			
			//echo "<pre>";
			//print_r($data['order']);
			//die;
			$this->load->view("vender/orderView",$data);
		}
		public function deleteCustomer()
		{
			echo $_REQUEST['customerId'];
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
			
			echo $result[0]['prize'];
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
	}
?>