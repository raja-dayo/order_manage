<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class DEO extends Ci_controller{

		public function __construct()
		{
			parent::__construct();

			$this->load->model("DEO_Model", "DEO");

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
			//echo "<pre>";
			//print_r($_REQUEST);
			extract($_REQUEST);
			//die;
			if($hidden_customer_id=="")
				
			{
				$customer_id = rawurldecode($this->encrypt->decode($customer_id));
		
				$result=$this->DEO->addOrder($orderNo, $customer_id, $product_id, $quantity, $sell_pro, $p_method, $agent, $pm_percentage, $cardType, $cardNumber, $cvvCode, $expiryDate);
				if($result)
				{
					$this->session->set_flashdata('msg', 'Order Has Added Successfully');
						
					return redirect("deo/newOrder");
				}
			}
			else
			{
				$customer_id = $hidden_customer_id;

				$result=$this->DEO->addOrder($orderNo, $customer_id, $product_id, $quantity, $sell_pro, $p_method, $agent, $pm_percentage, $cardType, $cardNumber, $cvvCode, $expiryDate);
				if($result)
				{
					$this->session->set_flashdata('msg', 'Order Has Added Successfully');
						
					return redirect("deo/newOrder");
				}
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

			$this->form_validation->set_rules('prize', 'Prize', 'required');

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

		        	$flag=$this->DEO->addproductModel($category_id, $productName, $file_name, $productDescription, $prize);
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
			$records=$this->DEO->orderList();
			
			$data['records']=$records;

			$this->load->view("deo/orderList", $data);
		}
			public function order_view()
		{
			//echo $_POST['order_id'];
			
			$data['order']=$this->DEO->orderViewModel($_POST['order_id']);
			
			//echo "<pre>";
			//print_r($data);

			$this->load->view("deo/orderView",$data);
		}
		public function orderTracking()
		{
			//echo "<pre>";
			//print_r($_REQUEST);
			//o_quantity
			//die;
			//echo $_POST['orderId'];
			if($_REQUEST['status']==3 || $_REQUEST['status']==4)
			{
				$this->DEO->insert_order_history_model($_POST['orderId'],$_POST['tracking'],$_POST['amount'],$_POST['[status']);
			}

			
			$result['pro']=$this->DEO->product_stock_qunatity($_POST['orderId']);
			
			$previous_quantity= $result['pro'][0]['s_product_qunatity'];
			
			$current_quantity=$previous_quantity-$_POST['o_quantity'];
			
			$stock_id         =$result['pro'][0]['s_id'];

			$result=$this->DEO->order_tracking($_POST['orderId'], $_POST['status'], $_POST['tracking']);

			$this->DEO->update_stock_product_model($stock_id, $current_quantity);
			//die;
			if($result)
			{
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
				
				$records=$this->DEO->searchModel($pattern);
				
				if(!empty($records))
				{
					?>
						<ul>
							<?php
								foreach ($records as $key => $emails) {
									$name=$emails['firstName']." ".$emails['lastName'];

									$encryptId=urldecode($this->encrypt->encode($emails['customer_id']));
									?>
										<li style="padding: 3px;"><a href="<?php echo site_url("deo/newOrder?customer_name=$name&customer_id=$encryptId"); ?>"><?php echo $emails['email']?></a></li>
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
			
			echo $result[0]['prize'];
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
			
			$data['records']= $records;
			
			$this->load->view("deo/ajaxStates", $data);
		}

		public function add_Customer()
		{
			//echo "<pre>";
			//print_r($_REQUEST);

			extract($_REQUEST);

			
			$record=$this->DEO->addCustomerModel($firstName, $lastName, $email, 
			$phoneNumber, $country_id ,$state_id, $address ,$postalCode, $customer_notes);
			
			
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