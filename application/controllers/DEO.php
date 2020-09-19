<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Deo extends Ci_controller{

		public function __construct()
		{
			parent::__construct();

			$this->load->model("DEO_Model", "DEO");

			$this->load->model("Admin_Vender_Model", "AdminVender");

			$this->load->helper("form");

			//$this->load->library("encryption");

			//$this->load->library("email");

			if(!isset($_SESSION['data']['deo']))
			{
				return redirect("login");	
			}
		}
		public function dashboard()
		{
			$data['pending_order']=$this->DEO->countOrder();

			$data['order_process']=$this->DEO->countOrderProcess();

			$data['order_deliver']=$this->DEO->countOrderDeliver();
		
			$data['refund_orders']=$this->DEO->count_refund_orders_model();
			
			$this->load->view("deo/dashboard",$data);
		}

		public function newOrder()
		{
			$result['products']=$this->DEO->productsModel();

			$result['agents']=$this->DEO->agentModel();

			$result['payment_methods']=$this->DEO->payment_method_model();

			$result['countries']=$this->DEO->getCountriesModel();

			$result['d_method']=$this->AdminVender->getDeliveryMethod();

			$this->load->view("deo/new_order",$result);
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
				$_REQUEST['vender_id'] =$_SESSION['data']['deo']['id'];
		
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
						
					return redirect("deo/newOrder");
				}
			}
			else
			{
				$_REQUEST['customer_id'] = $hidden_customer_id;
				
				$_REQUEST['vender_id'] =$_SESSION['data']['deo']['id'];
				
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
						
					return redirect("deo/newOrder");
				}
			}
		}
		
		public function add_more(){

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

			$result['products']=$this->DEO->productsModel();

			$this->load->view('deo/multiple_product_page',$result);
		}

		public function add_multiple_product(){

			$this->AdminVender->addOrderDetail($_REQUEST['orderNo'], $_REQUEST['product_id'], $_REQUEST['quantity'], $_REQUEST['sell_pro']);
			
			return redirect('deo/orders');
		}

		public function updateOrderForm()
		{
			//$data['order'] $_REQUEST['orderId'];
			//echo "jkghkdfj";
			//die;
			$data['result']		=$this->DEO->orderEditModel($_REQUEST['orderId']);
			$data['products']	=$this->AdminVender->productsModel();
				
				//echo "<pre>";

				//print_r($data);
				//die;
			$this->load->view("deo/updateOrderForm",$data);
		}
		public function orderUpdate()
		{
			//echo "<pre>";
			//print_r($_REQUEST);
			if(isset($_REQUEST['cancel']))
			{
				return redirect("deo/orders");
			}
			else
			{
				//echo "<pre>";
				//print_r($_REQUEST);
				//die;
				extract($_REQUEST);
				$flag=$this->DEO->orderUpdateModel($order_id, $customer_id, $product_id, $orderNo, $sell_pro, $quantity);
				
				if($flag)
				{
					$this->session->set_flashdata('msg', " $orderNo Order Has Updated");
					
					return redirect("deo/orders");
					//echo "yes";
				}
				else
				{
					echo "no";
				}
			}
		}
		public function deleteOrder()
		{
			
			echo "delete";
			die;
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

		public function addCategoryForm()
		{
			$this->load->view("deo/add_category_form");
		}

		public function insertCategory()
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('category', 'Category', 'required');

			if($this->form_validation->run()==TRUE)
			{
				extract($_REQUEST);
				$flag=$this->DEO->addCategoryModel($category,$description);
			
				if($flag)
				{
					$this->session->set_flashdata('msg',"Category Add Successfully");
				
					return redirect('deo/addCategoryForm');
				}
			}
			else
			{
				$this->load->view("deo/add_category_form");
			}	
		}

		public function category()
		{
			$data['categories']=$this->DEO->getCategoryModel();
			
			$this->load->view("deo/categoryList",$data);
		}

		public function edit_delete_Category()
		{
			if(isset($_POST['edit']))
			{
				$data['category']=$this->DEO->editCategory($_POST['edit']);
				
				$this->load->view("deo/update_category_form",$data);
			}
			else
			{
				echo $_POST['delete'];

				$flag=$this->DEO->deleteCategory($_POST['delete']);
				
				if($flag)
				{
					$this->session->set_flashdata('msg', "Category Deleted Successfully");
					
					return redirect("deo/category");
				}
				else
				{
					$this->session->set_flashdata('msg', "Category Not Deleted");
					
					return redirect("deo/category");
				}
			}
		}

		public function updateCategory()
		{
			if(isset($_POST["cancel"]))
			{
				return redirect("deo/category");
			}
			else
			{
				extract($_REQUEST);

				$flag=$this->DEO->updateCategory($id, $category, $description);
			
				if($flag)
				{
					$this->session->set_flashdata('msg', "Category Updated Successfully");
					
					return redirect("deo/category");
				}
				else
				{
					$this->session->set_flashdata('msg', "Category Not Update");
					
					return redirect("deo/category");
				}
			}			
		}

		public function addProduct()
		{
			$data['categories']=$this->DEO->getCategoryModel();
			
			$this->load->view("deo/addProduct",$data);
		}

		public function insertProduct()
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('productName', 'Product', 'required');

			//$this->form_validation->set_rules('prize', 'Prize', 'required');

			//$this->form_validation->set_rules('image', 'Document', 'required');
			if (empty($_FILES['image']['name']))
			{
    			$this->form_validation->set_rules('image', 'Document', 'required');
			}
			if($this->form_validation->run()==TRUE)
			{
				extract($_REQUEST);
				$config['upload_path']          = './assets/img';
            	$config['allowed_types']        = 'gif|jpg|png|jpeg';
            	$config['max_size']             = '1000000';
            	$config['max_width']            = '10240';
            	$config['max_height']           = '7680';  

            	$this->load->library('upload', $config);

           		// echo "<pre>";
           		// print_r($_FILES);
            	//die;
            	if ($this->upload->do_upload("image"))
	        	{
		        	extract($_REQUEST);

		            $data = array('upload_data' => $this->upload->data());

		            $file_name= $data['upload_data']['file_name'];

		        	$flag=$this->DEO->addproductModel($category_id, $productName, $file_name, $productDescription);
		        	if($flag)
					{
						$this->session->set_flashdata("msg", "Product Hase Been Added");
					
						return redirect("deo/addProduct");
					}
					else
					{
						$this->session->set_flashdata("msg", "Something wrong...!");
					
						return redirect("deo/addProduct");
					}
	        	}
	        	else
	        	{
	        		$error = array('error' => $this->upload->display_errors());
	        		
	        		$data=$error['error'];
	        	
	        		$this->session->set_flashdata("msg", $data);
				
					return redirect("deo/addProduct");
	        	}
			}
			else
			{
				$this->load->view("deo/addProduct");
			}
		}

		public function productList()
		{
			$data['products']=$this->DEO->productsModel();
			
			$this->load->view("deo/product_list",$data);
		}

		public function edit_delete_product()
		{
			if(isset($_POST['edit']))
			{
				
				$data['categories']=$this->DEO->getCategoryModel();
				
				$data['product']=$this->DEO->editProductModel($_POST['edit']);
				
				$this->load->view("deo/updateProduct",$data);
			}
			else
			{
				$flag=$this->DEO->deleteProduct($_POST['delete']);
				
				if($flag)
				{
					$this->session->set_flashdata('msg', "Product Deleted Successfully");
					
					return redirect("deo/productList");
				}
				else
				{
					$this->session->set_flashdata('msg', "Product Not Deleted");
					
					return redirect("deo/productList");
				}
			}			
		}

		public function updateProduct()
		{
			if(isset($_POST["cancel"]))
			{
				return redirect("deo/productList");
			}
			else
			{		
				if($_FILES['image']['name']=="")
				{
					extract($_REQUEST);
					$flag=$this->DEO->updateProduct($product_id, $productName, $category_id, $product_img, $productDescription, $prize);
					
					if($flag)
					{

						$this->session->set_flashdata('msg', "Product Updated Successfully");
						
						return redirect("deo/productList");
					}
					else
					{
						$this->session->set_flashdata('msg', "Product not Updated");
						
						return redirect("deo/productList");
					}
				}
				else
				{
					$config['upload_path']          = './assets/img';
		            $config['allowed_types']        = 'gif|jpg|png|jpeg';
		            $config['max_size']             = '1000000';
		            $config['max_width']            = '10240';
		            $config['max_height']           = '7680';  

		            $this->load->library('upload', $config);

		            if ($this->upload->do_upload("image"))
			        {
			        	extract($_REQUEST);

			            $data = array('upload_data' => $this->upload->data());

			            $file_name= $data['upload_data']['file_name'];

			            $flag=$this->DEO->updateProduct($product_id, $productName, $category_id, $file_name, $productDescription, $prize);
			        	if($flag)
						{
							$this->session->set_flashdata("msg", "Product updated Successfully");
						
							return redirect("deo/productList");
						}
						else
						{
							$this->session->set_flashdata("msg", "Something wrong...!");
						
							return redirect("deo/updateProduct");
						}
			        }
			        else
			        {
			        	$error = array('error' => $this->upload->display_errors());
			        	
			        	$data=$error['error'];
			        	
			        	$this->session->set_flashdata("msg", $data);
						
						return redirect("deo/updateProduct");
			        }
				}
			}
		}
		public function manage_stock()
		{
			$data['products']=$this->DEO->stockProductsModel();
			
			$this->load->view("deo/manage_stock",$data);
		}
		public function stock_list()
		{
			$data['stock_list']=$this->DEO->stock_list_model();

			$this->load->view("deo/stock_list",$data);
		}
			public function save_stock()
		{
			extract($_REQUEST);
			$result=$this->DEO->save_stock_model($product, $quantity);
			
			if($result)
			{
				return redirect("deo/stock_list");
			}
		}
		public function edit_stock()
		{
			extract($_REQUEST);
			$data['products']=$this->DEO->productsModel();
			$data['stock']=$this->DEO->stock_edit_prodcut_model($stock_id);
			
			$this->load->view("deo/edit_stock",$data);	
		}
		public function update_stock()
		{
			if(isset($_POST['cancel']))
			{
				return redirect("deo/stock_list");
			}
			else
			{
				$result=$this->DEO->update_stock_model($_REQUEST['stock_id'], $_REQUEST['quantity']);
				
				if($result)
				{
					$this->session->set_flashdata("msg","Stock Updated Successfully");
					
					return redirect("deo/stock_list");
				}
			}
		}
		public function orders()
		{
			$data['records']=$this->AdminVender->order_list();

			$this->load->view("deo/orderList", $data);
		}
		public function order_view()
		{	
			$data['orders']=$this->AdminVender->orderViewModel($_REQUEST['order_id']);
			
			$this->load->view("deo/orderView",$data);
		}
		
		public function updateOrderTracking()
		{
			if($_REQUEST['status']==2)
			{
				$result=$this->AdminVender->update_order($_REQUEST);			

				return redirect("deo/orders");
			}
			else if($_REQUEST['status']==3)
			{
				for ($i=0; $i<count($_REQUEST['o_quantity']) ; $i++) { 

					$result=$this->AdminVender->update_stock_qunatity($_REQUEST['o_quantity'][$i],$_REQUEST['order_product'][$i]);
				}	
				
				$_REQUEST['amount']=array_sum($_REQUEST['amount']);
				
				$result=$this->AdminVender->insert_order_history_model($_REQUEST);

				$result=$this->AdminVender->update_order($_REQUEST);
				
				return redirect("deo/orders");
			}			
			else
			{
				$result=$this->AdminVender->update_order($_REQUEST);			

				return redirect("deo/orders");
			}
		}
		public function pending_orders()
		{
			$data['pending_orders']=$this->DEO->pending_orders_model();
			
			$this->load->view("deo/pending_orders",$data);
		}
		public function in_process_orders()
		{
			$data['inProcess_orders']=$this->DEO->inProcess_orders_model();
			
			$this->load->view("deo/in_process_orders",$data);
		}
		/*public function deliver_orders()
		{
			echo "yes";
		}*/
			public function deliver_orders()
		{
			$data['records']=$this->DEO->deliverOrdersModel();
			
			$this->load->view("deo/deliver_orders",$data);
		}

		public function refund_orders()
		{
			$data['refund_orders']=$this->DEO->refund_order_list_model();
			
			$this->load->view("deo/refund_orders",$data);
		}
			public function search()
		{
			$pattern=$_POST['pattern'];

			if(!empty($pattern))
			{
				
				$records=$this->AdminVender->searchModel($pattern);
				//$records=$this->DEO->searchModel($pattern);
				
				if(!empty($records))
				{
					?>
						<ul>
							<?php
								foreach ($records as $key => $emails) {
									$name=$emails['firstName']; //." ".$emails['lastName'];

									$encryptId=urldecode($this->encrypt->encode($emails['customer_id']));
									?>
										<li style="padding: 3px;"><a href="<?php echo site_url("deo/newOrder?customer_name=$name&customer_id=$encryptId"); ?>"><?php echo $name;?></a></li>
									<?php
								}
							?>
						</ul>
					<?php
				}
				else
				{
					?>
						<a href="<?php echo site_url("deo/customerForm")?>"  >Add Customer</a>
					<?php
				}		
			}
		}
		public function get_product_cost()
		{
			$_POST['product_id'];

			$result=$this->DEO->productCostModel($_POST['product_id']);
			
		    echo json_encode($result);
		}

		public function customerForm()
		{
			$data['countries']=$this->DEO->getCountriesModel();
			
			$this->load->view("deo/addCustomer",$data);
		}

		public function checkEmail()
		{
			$flag=$this->DEO->getEMailModel($_REQUEST['email']);
			
			if($flag)
			{
				echo "Email already exits";
			}
		}

		public function getStates()
		{
			$records=$this->DEO->getStateModel($_REQUEST['country_id']);

			echo json_encode($records);
		}

		public function add_Customer()
		{
			$record=$this->DEO->addCustomerModel($_REQUEST);
			
			$abc= $record[0]['firstName']." ".$record[0]['lastName'];
			
			$xyz=$record[0]['customer_id'];

			$this->session->set_flashdata('alpha', $abc);
			
			$this->session->set_flashdata('bita', $xyz);

			if($record)
			{
				return redirect("deo/newOrder");
			}
			else
			{
				echo "No";
			}
		}

		public function customerList(){

			$data["records"]=$this->DEO->getCustomerModel();

			$this->load->view("deo/customerList", $data);
		}

		public function updateCustomerForm(){

			$customerId= rawurldecode($this->encrypt->decode($_REQUEST['customerId']));

			$data['result']=$this->DEO->editCustomerModel($customerId);
			
			$data['countries']=$this->DEO->getCountry();
			
			$this->load->view("deo/updateForm",$data);
		}
		public function updateCustomer()
		{
			$_REQUEST['c_id']= rawurldecode($this->encrypt->decode($_REQUEST['customer_id']));

			$flag=$this->AdminVender->updateCustomerModel($_REQUEST,$_REQUEST['c_id']);
			
			if($flag)
			{
				$this->session->set_flashdata('msg', 'Customer Has Updated Successfully');
				
				return redirect("deo/customerList");
			}
			else
			{
				echo "No";
			}	
		}

		public function deleteCustomer()
		{
			$_REQUEST['customerId'];
			
			return redirect("deo/customerList");
		}

		public function profile()
		{
			$data['deo']=$this->DEO->deoModel($_SESSION['data']['deo']['id']);
			
			$this->load->view("deo/profile",$data);
		}
		public function update_profile()
		{
			$password = urldecode($this->encrypt->encode($_REQUEST['password']));
			
			extract($_REQUEST);
			
			if($_FILES['image']['name']=="")
			{
			
				$password = urldecode($this->encrypt->encode($password));

				$flag=$this->DEO->updateAdminProfileModel($_SESSION['data']['deo']['id'], $firstname, $lastname, $password, $number, $file_name, $address);
				
				if($flag)
				{
					$_SESSION['data']['deo']['image']=$file_name;
					
					return redirect("deo/profile");
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
	            	$pass = urldecode($this->encrypt->encode($_REQUEST['password']));
                	
                	extract($_REQUEST);

	                $data = array('upload_data' => $this->upload->data());

	                $file_name= $data['upload_data']['file_name'];

	                $flag=$this->DEO->updateAdminProfileModel($_SESSION['data']['deo']['id'], $firstname, $lastname, $pass, $number, $file_name, $address);
	                $_SESSION['data']['deo']['image']=$file_name;
	            	
	            	if($flag)
	            	{
	            		return redirect("deo/profile");
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
	}
?>