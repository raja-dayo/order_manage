<?php
	
	error_reporting(0);
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Admin Extends Ci_Controller
	{
		public function __construct()
		{
			parent::__construct();

			$this->load->model("AdminModel", "admin");

			$this->load->helper("form");

			$this->load->model("Admin_Vender_Model", "adminvender");

			$this->load->library("encryption");

			$this->load->library("email");

			if(!isset($_SESSION['data']['admin']))
			{
				return redirect("login");	
			}
		}
		public function dashboard()
		{
			
			$data['pending_order']=$this->admin->countOrder();
			
			$data['venders']=$this->admin->countVender();

			$data['order_process']=$this->admin->countOrderProcess();

			$data['order_deliver']=$this->admin->countOrderDeliver();

			$data['customers']=$this->admin->count_customer_model();
			
			$data['agents']=$this->admin->count_agent_model();

			$data['refund_orders']=$this->admin->count_refund_orders_model();
		
			$this->load->view("admin/dashboard", $data);
		}

		public function vendor()
		{
			$records=$this->admin->venders();
			
			$data['records']=$records;
		
			$this->load->view("admin/vender", $data);
		}

		public function inventory()
		{
			$this->load->view("admin/inventory");
		}

		public function customer()
		{
			$records=$this->admin->customerListModel();
			
			$data['records']=$records;

			$this->load->view("admin/customers", $data);
		}

		public function profile()
		{
			
			$data['admin']=$this->admin->getAdminModel($_SESSION['data']['admin']['id']);
			
			$this->load->view("admin/profile",$data);
		
			//echo "<pre>";
			//print_r($data);	
		}

		public function update_profile()
		{
			$password = urldecode($this->encrypt->encode($_REQUEST['password']));
			
			extract($_REQUEST);
			
			if($_FILES['image']['name']=="")
			{
			
				$password = urldecode($this->encrypt->encode($password));

				$flag=$this->admin->updateAdminProfileModel($_SESSION['data']['admin']['id'], $firstname, $lastname, $password, $number, $file_name, $address);
				
				if($flag)
				{
					$_SESSION['data']['admin']['image']=$file_name;
					
					return redirect("admin/profile");
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

	                $flag=$this->admin->updateAdminProfileModel($_SESSION['data']['admin']['id'], $firstname, $lastname, $pass, $number, $file_name, $address);
	                $_SESSION['data']['admin']['image']=$file_name;
	            	
	            	if($flag)
	            	{
	            		return redirect("admin/profile");
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

		public function vendorForm()
		{
			$result['countries']=$this->admin->getCountriesModel();
			
			$this->load->view("admin/addVender",$result);
		}

		public function addVender()
		{
			extract($_REQUEST);
            
            
			$encrypt_pass = urldecode($this->encrypt->encode($name));

			$flag=$this->admin->addVenderModel($name, $lname, $email, $encrypt_pass ,$number, $country, $site);
			
			if($flag)
			{
				$this->session->set_flashdata("msg", "A new Vendor Add Successfully");
				
				return redirect("admin/vendorForm");
			}
			else
			{	
				$this->session->set_flashdata("msg", "Vendor Not added something wrong");
				
				return redirect("admin/vendorForm");
			}
		}

		public function addProduct()
		{
			$data['categories']=$this->admin->getCategoryModel();
			
			$this->load->view("admin/addProduct",$data);
		}

		public function products()
		{
			$this->load->view("admin/products");
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

		        	$flag=$this->admin->addproductModel($category_id, $productName, $file_name, $productDescription);
		        	if($flag)
					{
						$this->session->set_flashdata("msg", "Product Hase Been Added");
					
						return redirect("admin/addProduct");
					}
					else
					{
						$this->session->set_flashdata("msg", "Something wrong...!");
					
						return redirect("admin/addProduct");
					}
	        	}
	        	else
	        	{
	        		$error = array('error' => $this->upload->display_errors());
	        		
	        		$data=$error['error'];
	        	
	        		$this->session->set_flashdata("msg", $data);
				
					return redirect("admin/addProduct");
	        	}
			}
			else
			{
				$this->load->view("admin/addProduct");
			}
								
		}

		public function manage_stock()
		{
			$data['products']=$this->admin->stockProductsModel();
			
			$this->load->view("admin/manage_stock",$data);
		}

		public function stock_list()
		{
			$data['stock_list']=$this->admin->stock_list_model();

			$this->load->view("admin/stock_list",$data);
		}

		public function save_stock()
		{
			
			$_REQUEST['unit_price']=$_REQUEST['stock_price']/$_REQUEST['stock'];
			
			extract($_REQUEST);
			$result=$this->admin->save_stock_model($product, $stock, $stock_price);
			
			$this->admin->product_price($product,$unit_price);
			
			if($result)
			{
				return redirect("admin/stock_list");
			}
		}
	
		public function edit_stock()
		{
			if(isset($_REQUEST['delete_stock_id'])){

				//echo $_REQUEST['delete_stock_id'];

				$result=$this->admin->delete_stock($_REQUEST['delete_stock_id']);
				
				return redirect('admin/stock_list');
			}
			else{

				extract($_REQUEST);
				
				$data['products']=$this->admin->productsModel();
				
				$data['stock']=$this->admin->stock_edit_prodcut_model($stock_id);
				
				//echo "<pre>";

				//print_r($data['products']);
				$this->load->view("admin/edit_stock",$data);
			}
				
		}

		public function update_stock()
		{
			if(isset($_POST['cancel']))
			{
				return redirect("admin/stock_list");
			}
			else
			{
				$result=$this->admin->update_stock_model($_REQUEST['stock_id'], $_REQUEST['quantity']);
				
				if($result)
				{
					$this->session->set_flashdata("msg","Stock Updated Successfully");
					
					return redirect("admin/stock_list");
				}
			}
		}
		public function orders()
		{
			$records=$this->adminvender->order_list();
			
			$data['records']=$records;

			$this->load->view("admin/orderList", $data);
		}

		public function order_view()
		{
			if($this->session->flashdata('msg'))
			{

				$_REQUEST['order_id']=$this->session->flashdata('msg');
				
			}
			
			$data['orders']=$this->adminvender->orderViewModel($_REQUEST['order_id']);
			

			$this->load->view("admin/orderView",$data);
		}

		public function deliver_orders()
		{
			$data['records']=$this->admin->deliverOrdersModel();
			
			$this->load->view("admin/deliver_orders",$data);
		}


		public function new_order()
		{
			$result['products']=$this->admin->productsModel();

			$result['agents']=$this->admin->agentModel();

			$result['payment_methods']=$this->admin->payment_method_model();

			$result['countries']=$this->admin->getCountriesModel();

			$result['d_method']=$this->adminvender->getDeliveryMethod();

			$this->load->view("admin/new_order",$result);
		}

		public function order_delete(){

			//echo "<pre>";
			//print_r($_POST);

			$result=$this->admin->delete_order_detail($_POST['delete_order']);

			if($result){
				$res=$this->admin->delete_order($_POST['delete_order']);
				
				if($res){
					return redirect('admin/orders');
				}
			}
			
		}

		public function get_product_cost()
		{
			$_POST['product_id'];

			$result=$this->admin->productCostModel($_POST['product_id']);
			
			//echo $result[0]['prize'];
			
			echo json_encode($result);
		}

		public function search()
		{
			$pattern=$_POST['pattern'];
            
           
			if(!empty($pattern))
			{
				$records=$this->adminvender->searchModel($pattern);
				
				if(!empty($records))
				{
					?>
						<ul>
							<?php
								foreach ($records as $key => $emails) {
									$name=$emails['firstName'];//." ".$emails['lastName'];
                                    
									$encryptId=urldecode($this->encrypt->encode($emails['customer_id']));
									?>
										<li style="padding: 3px;"><a href="<?php echo site_url("admin/new_order?customer_name=$name&customer_id=$encryptId"); ?>"><?php  echo $name;?></a></li>
									<?php
								}
							?>
						</ul>
					<?php
				}
				else
				{
					?>
						<a href="<?php echo site_url("admin/customerForm")?>"  >Add Customer</a>
					<?php
				}			
			}
		}

		public function customerForm()
		{
			$data['countries']=$this->admin->getCountriesModel();
			
			$this->load->view("admin/addCustomer",$data);
		}

		public function checkEmail()
		{
			$flag=$this->admin->getEMailModel($_REQUEST['email']);
			
			if($flag)
			{
				echo "Email already exits";
			}
		}

		public function add_Customer()
		{
			//echo "<pre>";

			//print_r($_REQUEST);
			if($_REQUEST['state_id']==""){
				
				$_REQUEST['state_id']=$_REQUEST['state'];
			}
		
			$record=$this->admin->addCustomerModel($_REQUEST);
			
			$abc= $record[0]['firstName']." ".$record[0]['lastName'];
			
			$xyz=$record[0]['customer_id'];

			$this->session->set_flashdata('alpha', $abc);
			
			$this->session->set_flashdata('bita', $xyz);

			if($record)
			{
				return redirect("admin/new_order");
			}
			else
			{
				echo "No";
			}
		}

		public function getStates()
		{
			$records=$this->admin->getStateModel($_REQUEST['country_id']);
			
			//	$data['records']= $records;
			
			echo json_encode($records);
		}
		

		public function check_orderNo()
		{			
			$flag=$this->adminvender->checkOrderNoModel($_POST['num']);
			
			if($flag)
			{
				$msg="Order No alredy inserted";

				echo json_encode($msg); 
			}			
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
			$rst=$this->adminvender->getSingleDeliveryMethod($d_method);
			
			if($hidden_customer_id=="")
				
			{
				$_REQUEST['customer_id'] = rawurldecode($this->encrypt->decode($customer_id));
				$_REQUEST['vender_id'] =$_SESSION['data']['admin']['id'];
		
				foreach ($_SESSION['product'] as $key => $product) {
					
					$result=$this->adminvender->addOrderDetail($orderNo, $product['pro'], $product['qun'], $product['cost']);
				
				    $amount[]=$product['qun']*$product['cost'];
				}
					
				$_REQUEST['amount']=array_sum($amount)+$rst[0]['d_shipping_charges'];
				
				$result=$this->adminvender->addOrder($_REQUEST);

				if($result)
				{
					unset($_SESSION['product']);
					$this->session->set_flashdata('msg', "Order No $orderNo Has Added Successfully");
						
					return redirect("admin/new_order");
				}
			}
			else
			{
				$_REQUEST['customer_id'] = $hidden_customer_id;
				
				$_REQUEST['vender_id'] =$_SESSION['data']['admin']['id'];
				
				foreach ($_SESSION['product'] as $key => $product) {
					
					$result=$this->adminvender->addOrderDetail($orderNo, $product['pro'], $product['qun'], $product['cost']);

					$amount[]=$product['qun']*$product['cost'];
				}

				$_REQUEST['amount']=array_sum($amount)+$rst[0]['d_shipping_charges'];

				$result=$this->adminvender->addOrder($_REQUEST);

				if($result)
				{
					unset($_SESSION['product']);
					$this->session->set_flashdata('msg', "Order Has $orderNo Added Successfully");
						
					return redirect("admin/new_order");
				}
			}
		}
		
		public function add_more(){


			$abc=$this->adminvender->get_product_name($_POST['data']['pro']);
			
			$_POST['data']['product']=$abc[0]['product'];
			$_POST['data']['total']=$_POST['data']['cost']*$_POST['data']['qun'];


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

		public function update_order_product_page(){
            
			if(isset($_POST['od_id']))
			{
				$result['pro']=$this->adminvender->getproducts_name($_REQUEST['product']);
            
				$result['products']=$this->admin->productsModel();
    	
				$this->load->view('admin/multiple_product_page',$result);
			}
			else if(isset($_POST['delete']))
			{
				$flag=$this->admin->deleteOrderDetail($_POST['delete']);

				if($flag)
				{
					$result=$this->admin->getOrderSum($_REQUEST['orderNo']);

					foreach ($result as $key => $res) {
						$sum['abc']+=$res['od_product_quantity']*$res['od_product_price'];
					}

					$total =$sum['abc']+$result[0]['d_shipping_charges'];

					$result=$this->admin->updateOrderTotal($_REQUEST['orderNo'],$total);
					

					$this->session->set_flashdata("msg", $_REQUEST['orderNo']);

					return redirect('admin/order_view');
				}
			}
            
		}

		public function order_update_product(){

			
			$this->admin->updateOrderDetail($_REQUEST);
			
			$result=$this->admin->getOrderSum($_REQUEST['orderNo']);

			foreach ($result as $key => $res) {
				$sum['abc']+=$res['od_product_quantity']*$res['od_product_price'];
			}
			
			$total =$sum['abc']+$result[0]['d_shipping_charges'];

			$result=$this->admin->updateOrderTotal($_REQUEST['orderNo'],$total);

			return redirect('admin/orders');
		}

		public function addCategoryForm()
		{
			$this->load->view("admin/add_category_form");
		}

		public function insertCategory()
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('category', 'Category', 'required');

			if($this->form_validation->run()==TRUE)
			{
				extract($_REQUEST);
				$flag=$this->admin->addCategoryModel($category,$description);
			
				if($flag)
				{
					$this->session->set_flashdata('msg',"Category Add Successfully");
				
					return redirect('admin/addCategoryForm');
				}
			}
			else
			{
				$this->load->view("admin/add_category_form");
			}
			
		}

		public function category()
		{
			$data['categories']=$this->admin->getCategoryModel();
			
			$this->load->view("admin/categoryList",$data);
		}

		public function editCategory()
		{
			if(isset($_POST['edit']))
			{
				$data['category']=$this->admin->editCategory($_POST['edit']);
				
				$this->load->view("admin/update_category_form",$data);
			}
			else
			{
				echo $_POST['delete'];

				$flag=$this->admin->deleteCategory($_POST['delete']);
				
				if($flag)
				{
					$this->session->set_flashdata('msg', "Category Deleted Successfully");
					
					return redirect("admin/category");
				}
				else
				{
					$this->session->set_flashdata('msg', "Category Not Deleted");
					
					return redirect("admin/category");
				}
			}
		}

		public function updateCategory()
		{
			if(isset($_POST["cancel"]))
			{
				return redirect("admin/category");
			}
			else
			{
				extract($_REQUEST);

				$flag=$this->admin->updateCategory($id, $category, $description);
			
				if($flag)
				{
					$this->session->set_flashdata('msg', "Category Updated Successfully");
					
					return redirect("admin/category");
				}
				else
				{
					$this->session->set_flashdata('msg', "Category Not Update");
					
					return redirect("admin/category");
				}
			}			
		}

		public function productList()
		{
			$data['products']=$this->admin->productsModel();
			
			$this->load->view("admin/product_list",$data);
		}

		public function edit_delete_product()
		{
			if(isset($_POST['edit']))
			{
				//echo $_POST['edit'];
				
				$data['categories']=$this->admin->getCategoryModel();
				
				$data['product']=$this->admin->editProductModel($_POST['edit']);
				
				//echo "<pre>";
				//print_r($data['product']);
				$this->load->view("admin/updateProduct",$data);
			}
			else
			{
				$flag=$this->admin->deleteProduct($_POST['delete']);
				
				if($flag)
				{
					$this->session->set_flashdata('msg', "Product Deleted Successfully");
					
					return redirect("admin/productList");
				}
				else
				{
					$this->session->set_flashdata('msg', "Product Not Deleted");
					
					return redirect("admin/productList");
				}
			}			
		}

		public function updateProduct()
		{
			if(isset($_POST["cancel"]))
			{
				return redirect("admin/productList");
			}
			else
			{		
				if($_FILES['image']['name']=="")
				{
					extract($_REQUEST);
					$flag=$this->admin->updateProduct($product_id, $productName, $category_id, $product_img, $productDescription, $prize);
					
					if($flag)
					{

						$this->session->set_flashdata('msg', "Product Updated Successfully");
						
						return redirect("admin/productList");
					}
					else
					{
						$this->session->set_flashdata('msg', "Product not Updated");
						
						return redirect("admin/productList");
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

			            $flag=$this->admin->updateProduct($product_id, $productName, $category_id, $file_name, $productDescription, $prize);
			        	if($flag)
						{
							$this->session->set_flashdata("msg", "Product updated Successfully");
						
							return redirect("admin/productList");
						}
						else
						{
							$this->session->set_flashdata("msg", "Something wrong...!");
						
							return redirect("admin/updateProduct");
						}
			        }
			        else
			        {
			        	$error = array('error' => $this->upload->display_errors());
			        	
			        	$data=$error['error'];
			        	
			        	$this->session->set_flashdata("msg", $data);
						
						return redirect("admin/updateProduct");
			        }
				}
			}
		}

		public function customers_action()
		{
			if(isset($_POST['edit']))
			{
				//echo $_REQUEST['edit'];
				$data['countries']=$this->admin->getCountriesModel();
				$data['result']=$this->adminvender->editCustoemrModel($_REQUEST['edit']);

				$this->load->view("admin/edit_customer_form",$data);
			}
			else
			{
				echo $_REQUEST['delete'];
			}
		}
		public function update_customer(){

			//echo "<pre>";
			//print_r($_POST);
			//die;
			$result=$this->adminvender->updateCustomerModel($_REQUEST,$_REQUEST['c_id']);
			
			
			if($result){

				$this->session->set_flashdata("msg", "Customer data has updated Successfully");
				
				return redirect("admin/customer");
			}else{
				echo "ghalata aa";
			}
		}

		public function venders_action()
		{
			if(isset($_POST['edit']))
			{
				$vender_id= $_REQUEST['edit'];
				
				$data['result']=$this->admin->editVenderModel($vender_id);
				
				$data['countries']=$this->admin->getCountriesModel();
				
				$this->load->view("admin/editVender",$data);
			}
			else if(isset($_POST['active']))
			{
				$vender_id= $_POST['active'];

				$result=$this->admin->acitve_verdor_status($vender_id);
				
				if($result)
				{
					return redirect("admin/vendor");
				}
			}

			else if(isset($_POST['inactive']))
			{
				//echo $_POST['inactive'];
				
				$vender_id= $_POST['inactive'];

				$result=$this->admin->inacitve_verdor_status($vender_id);
				
				if($result)
				{
					return redirect("admin/vendor");
				}
			}
			else
			{
				echo $_REQUEST['delete'];
			}
		}

		public function updateVender()
		{
			//echo "yes";
			//echo "<pre>";
			//print_r($_REQUEST);
			extract($_REQUEST);
			//die;
			$result=$this->admin->update_vender_model($vendor_id,$name, $lname, $number, $country, $site);
			
			if($result)
			{
				$this->session->set_flashdata("msg","Vendor Updated Successfully");
				return redirect("admin/vendor");
			}
			else
			{
				echo "wrong";
			}
		}

		public function updateOrderTracking()
		{
			if($_REQUEST['status']==2)
			{
				$result=$this->adminvender->update_order($_REQUEST);			

				return redirect("admin/orders");
			}
			else if($_REQUEST['status']==3)
			{
				for ($i=0; $i<count($_REQUEST['o_quantity']) ; $i++) { 

					$result=$this->adminvender->update_stock_qunatity($_REQUEST['o_quantity'][$i],$_REQUEST['order_product'][$i]);
				}	
				
				$_REQUEST['amount']=array_sum($_REQUEST['amount']);
				
				$result=$this->adminvender->insert_order_history_model($_REQUEST);

				$result=$this->adminvender->update_order($_REQUEST);
				
				return redirect("admin/orders");
			}			
			else
			{
				$result=$this->adminvender->update_order($_REQUEST);			

				return redirect("admin/orders");
			}
		}	

		public function add_agent_form()
		{
			$data['countries']=$this->admin->getCountriesModel();

			$this->load->view("admin/add_agent",$data);
		}

		public function add_agent()
		{
			//echo "<pre>";
			//print_r($_REQUEST);

			extract($_REQUEST);

			$result=$this->admin->add_agent_model($name, $lname, $number, $agent_per, $country_id, $state_id);
			
			if($result)
			{
				$this->session->set_flashdata('msg', "Agnet Added Successfully");

				return redirect("admin/add_agent_form");
			}
		}

		public function agent_list()
		{
			$data['records']=$this->admin->agent_list_model();
			
			$this->load->view("admin/agent_list",$data);
		}

		public function agents_action()
		{
			
			if(isset($_REQUEST['delete']))
			{
				//echo $_REQUEST['delete'];
				//die;
				$result=$this->admin->delete_agent_model($_REQUEST['delete']);

				if($result)
				{
					$this->session->set_flashdata("msg","Agent Delete Successfully");

					return redirect("admin/agent_list");
				}
			}
			else
			{	
				$data['agent']=$this->admin->edit_agent_model($_REQUEST['edit_id']);
				
				$data['countries']=$this->admin->getCountriesModel();
				
				$data['states']=$this->admin->getStateModel($data['agent'][0]['a_country_id']);
				
				//echo "<pre>";
				//print_r($data);
				$this->load->view("admin/agent_update",$data);
			}
		}

		public function update_agent()
		{
			//echo "<pre>";
			//print_r($_REQUEST);
			extract($_REQUEST);
			$result=$this->admin->update_agent_model($agent_id,$name, $lname, $number, $agent_per, $country_id, $state_id);
			
			if($result)
			{
				$this->session->set_flashdata("msg","Agent Update Successfully");

				return redirect("admin/agent_list");
			}
		}

		public function get_percentage_pm()
		{
			$result=$this->admin->get_percentage_pm_model($_REQUEST['p_method']);
			
			echo $result[0]['percentage'];
		}

		public function pending_orders()
		{
			$data['pending_orders']=$this->admin->pending_orders_model();
			
			$this->load->view("admin/pending_orders",$data);
		}
		public function in_process_orders()
		{
			$data['inProcess_orders']=$this->admin->inProcess_orders_model();
			
			$this->load->view("admin/in_process_orders",$data);
		}
		/*public function deliver_orders()
		{
			echo "yes";
		}*/

		public function refund_orders()
		{
			$data['refund_orders']=$this->admin->refund_order_list_model();
			
			$this->load->view("admin/refund_orders",$data);
		}

		public function shipping(){

			$data['shipping']=$this->admin->getShipping();
			
			$this->load->view('admin/shipping',$data);
		}

		public function shipping_action(){

			$data['ship']=$this->admin->editShip($_POST['edit']);
			
			$this->load->view('admin/editShipping',$data);
		}

		public function updateShip(){
			
			$result=$this->admin->updateShip($_REQUEST);
			
			if($result){
				
				return redirect('admin/shipping');
			}
		}
		public function sendEmail()
	    {
			
			$result['data']=$this->admin->emailMsg();
			
			$config['protocol']         = 'smtp';
        	$config['smtp_host']        = 'ssl://om.infinix-tech.com';
        	$config['smtp_port']        = '465';
        	$config['smtp_user']        = 'no-reply@om.infinix-tech.com';
        	$config['smtp_pass']        = 'om.Infinix';
        	$config['smtp_timeout']     = '7';
        	$config['charset']          = 'utf-8';
        	$config['newline']          = "\r\n";
        	$config['mailtype']         = 'html'; // or html
        	$config['validation']       = TRUE; // bool whether to validate email or not      

        	$this->email->initialize($config);

			$this->email->from('no-reply@om.infinix-tech.com', 'Infinix Tech Solution Pvt Ltd');
        	
        	$this->email->to('rajadayo1@Gmail.com'); 

        	$this->email->subject('Email Test');
        	

        	$this->email->message($this->load->view('admin/email',$result, TRUE));  

        	if($this->email->send())
        	{
        		echo "yes";
        	}
        	else
        	{
				echo $this->email->print_debugger();

        	}
    	}		
	}
?>