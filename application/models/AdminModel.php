<?php
	
	class AdminModel extends Ci_Model
	{
		public function getAdminModel($id)
		{
			$result=$this->db->query("select * from users where id='".$id."'");
			
			return $result->result_array();
		}
		public function updateAdminProfileModel($id, $fname, $lname, $pass, $number, $image, $add)
		{
			$data=array(

				'name'				=>$fname,
				'last_name'			=>$lname,
				'password'			=>$pass,
				'phone_number'		=>$number,
				"address"			=>$add,
				'image'				=>$image,
				'update_on'			=>time()
			);

			$this->db->where('id', $id);

			$flag=$this->db->update("users",$data);
			
			return $flag;
		}
		public function addVenderModel($name, $lname, $email, $pass, $number, $country, $site)
		{
			$data=array(

				'name'				=>$name,
				'last_name'			=>$lname,
				'email'				=>$email,
				'password'			=>$pass,
				'status'			=>"1",
				'roll_id'			=>"2",
				'phone_number'		=>$number,
				'country_id'		=>$country,
				'site'				=>$site,
				'created_on'		=>time()
			);

			$flag=$this->db->insert("users",$data);
			
			return $flag;
		}

		public function update_vender_model($vendor_id,$name, $lname, $number, $country, $site)
		{
			$data=array(
				"name"				=>$name,
				"last_name"			=>$lname,
				"phone_number"		=>$number,
				"country_id"		=>$country,
				"site"				=>$site,
				"update_on"			=>time()
			);	

			$this->db->where("id",$vendor_id);

			$result=$this->db->update("users",$data);
			
			return $result;
		}

		public function venders()
		{
			$result=$this->db->query("SELECT * FROM users ,country WHERE users.country_id=country.country_id AND Roll_id=2");
			
			return $result->result_array();
		}

		public function acitve_verdor_status($id)
		{
			$data=array(

				"status"   =>1
			);

			$this->db->where("id",$id);

			$result=$this->db->update("users",$data);
			
			return $result;
		}

		public function inacitve_verdor_status($id)
		{
			$data=array(

				"status"   =>0
			);

			$this->db->where("id",$id);

			$result=$this->db->update("users",$data);
			
			return $result;
		}

		public function orderList()
		{
			$result=$this->db->query("select * from users, orders, customers, products where orders.vender_id=users.id AND orders.customer_id=customers.customer_id AND orders.product_id=products.id  AND orders.deleted='no' order By order_id DESC");
			
			return $result->result_array();
		}

		public function countOrder()
		{
			$result=$this->db->query("SELECT COUNT(*) AS num FROM orders where order_status=1 AND deleted='no'");
			
			return $result->result_array();
		}

		public function count_customer_model()
		{
			$result=$this->db->query("SELECT COUNT(*) AS num FROM customers where status='1'");
			
			return $result->result_array();
		}

		public function count_agent_model()
		{
			$result=$this->db->query("SELECT COUNT(*) AS num FROM agents where status='1'");
			
			return $result->result_array();
		}

		public function countOrderProcess()
		{
			$result=$this->db->query("SELECT COUNT(*) AS num FROM orders where order_status=2 AND deleted='no'");
			
			return $result->result_array();
		}

		public function countOrderDeliver()
		{
			$result=$this->db->query("SELECT COUNT(*) AS num FROM orders where order_status=3 AND deleted='no'");
			
			return $result->result_array();
		}

		public function countVender()
		{
			$result=$this->db->query("SELECT COUNT(*) AS num FROM users where Roll_id=2 AND status='1'");
			
			return $result->result_array();
		}

		public function count_refund_orders_model()
		{
			$result=$this->db->query("SELECT COUNT(*) AS num FROM orders where order_status='4'");
			
			return $result->result_array();
		}

		public function customerListModel()
		{
			$records=$this->db->query("select * from customers");
			
			return $records->result_array();
		}

		public function addproductModel($category_id, $product, $image, $description, $prize)
		{
			$data=array(
				'category_id'			=>$category_id,
				'product'				=>$product,
				'image'					=>$image,
				'description'			=>$description,
				'prize'					=>$prize,
				'created_on'			=>time(),
			);

			$result=$this->db->insert("products", $data);
			
			return $result;
		}

		public function productCostModel($product_id)
		{
			$result=$this->db->query("select * from products where id='".$product_id."'");
			
			return $result->result_array();
		}

		public function getCountriesModel()
		{
			$result=$this->db->query("select * from country");
			
			return $result->result_array();
		}

		public function getStateModel($id)
		{
			$result=$this->db->query("SELECT * FROM States Where country_id='".$id."'");
			
			return $result->result_array();
		}

		public function getEmailModel($email)
		{
			$records=$this->db->query("select email from customers where email='".$email."'");
			
			return $records->result_array();
		}
		
		public function addCustomerModel($fname, $lname, $email, $phone_no, $country_id, $state_id, $address, $postal_code, $customer_notes)
		{
			$data=array(

				"firstName"			=> $fname,
				"lastName"			=> $lname,
				"email"				=> $email,
				"number"			=> $phone_no,
				"country_id"		=> $country_id,
				"state_id"			=> $state_id,
				"address"			=> $address,
				"postalCode"		=> $postal_code,
				"customer_notes"	=> $customer_notes,
				"added_by"			=> $_SESSION['data']['admin']['id'],
				"added_on"			=> time()
			);

			$result=$this->db->insert("customers", $data);

			$insertId = $this->db->insert_id();

			$result_1=$this->db->query("select * from customers where customer_id='".$insertId."'");
			
			return $result_1->result_array();
		}

		public function addCategoryModel($category,$description)
		{
			$data=array(
				'name'					=>$category,
				'description'			=>$description,
				'created_on'			=>time(),
			);

			$flag=$this->db->insert("category",$data);
			
			return $flag;
		}

		public function getCategoryModel()
		{
			$result=$this->db->get_where("category",array("status"=>1));
			
			return $result->result_array();
		}

		public function editCategory($id)
		{
			$result=$this->db->get_where("category", array("id"=>$id));
			
			return $result->result_array();
		}

		public function updateCategory($id, $name, $description)
		{
			$data=array(
				"name"			=>$name,
				"description"	=>$description
			);

			$this->db->where("id",$id);
			$flag=$this->db->update("category",$data);
			
			return $flag;
		}

		public function deleteCategory($id)
		{
			$data=array(
				"status"			=>0
			);

			$this->db->where('id',$id);
			
			$flag=$this->db->update("category",$data);
			
			return $flag;
		}

		public function addOrder($orderNo, $customer_id, $product_id, $quantity, $product_sell, $payment_method, $agent, $agent_percentage, $card_type, $card_number, $cvv_number, $card_ex_date)
		{
			$data=array(

				"orderNo"				=> $orderNo,
				"vender_id"				=> $_SESSION['data']['admin']['id'],
				"customer_id"			=> $customer_id,
				"product_id"			=> $product_id,
				"order_quantity"		=> $quantity,
				//"amount"				=> $amount,
				//"ship_date"				=> $shipDate,
				//"state_id"				=> $state,
				//"postal_code"			=> $postalCode,
				//"shipping_address"		=> $shippingAddress,
				"o_create_on"				=> time(),
				"sell_product_cost"		=> $product_sell,
				"payment_method"		=> $payment_method,
				"agent"					=> $agent,
				"agent_percentage"		=> $agent_percentage,	
				"card_type"				=> $card_type,
				"card_number"			=> $card_number,
				"cvv_number"			=> $cvv_number,
				"card_ex_date"			=> $card_ex_date,
			);

			$result=$this->db->insert("orders", $data);	
			
			return $result;
		}
		public function orderViewModel($id)
		{
			//$result=$this->db->query("select * from users,orders,customers,products,country,states,agents where orders.vender_id=users.id AND orders.customer_id=customers.customer_id AND orders.product_id=products.id AND customers.country_id=country.country_id AND customers.state_id=states.state_id AND orders.order_id='".$id."'");

			$result=$this->db->query("SELECT *  FROM users, customers, products, country, states,orders
				LEFT JOIN agents ON orders.agent = agents.a_id
				WHERE orders.vender_id=users.id
				AND orders.customer_id=customers.customer_id 
				AND orders.product_id=products.id 
				AND customers.country_id=country.country_id 
				AND customers.state_id=states.state_id 
				AND orders.order_id='".$id."'"
			);
			
			return $result->result_array();
		}

		public function productsModel()
		{
			$result=$this->db->query("select * from products where status=1");
			
			return $result->result_array();
		}

		public function editProductModel($id)
		{
			$result=$this->db->get_where("products",array('id'=>$id));
			
			return $result->result_array();
		}

		public function updateProduct($id, $product, $category_id, $image, $description,$prize)
		{
			$data=array(
				"product"			=>$product,
				"category_id"		=>$category_id,
				"image"				=>$image,
				"description"		=>$description,
				"prize"				=>$prize
			);

			$this->db->where('id',$id);
			
			$flag=$this->db->update("products",$data);
			
			return $flag;
		}

		public function deleteProduct($id)
		{
			$data=array(
				"status"			=>0
			);

			$this->db->where('id',$id);
			
			$flag=$this->db->update("products",$data);
			
			return $flag;
		}

		public function update_order($order_id, $status, $tracking_id)
		{
			$data=array(

				"order_status"       =>$status,
				"tracking_id"        =>$tracking_id,
				"o_update_on"			 =>time(),
			);

			$this->db->where('order_id',$order_id);
			
			$result=$this->db->update("orders", $data);
			
			return $result;
		}

		public function deliverOrdersModel()
		{
			$result=$this->db->query("select * from orders, users, products, customers where orders.vender_id=users.id AND orders.product_id=products.id AND orders.customer_id=customers.customer_id AND orders.order_status=3");
			
			return $result->result_array();
		}

		public function emailMsg()
		{
			$current=time();
			$abc=$current-86400;
			$result=$this->db->query("select * from orders where orders.order_status=1 AND orders.create_on > $abc");
			
			return $result->result_array();
		}

		public function editVenderModel($vender_id)
		{
			$result=$this->db->query("select * from users where id='".$vender_id."'");
			
			return $result->result_array();
		}

		public function add_agent_model($fname, $lname, $contact_number, $agent_per, $country_id, $state_id)
		{
			$data=array(

				"a_first_name"	   		=>$fname,
				"a_last_name"	  	 	=>$lname,
				"a_percentage"			=>$agent_per,
				"a_contact_number"	   	=>$contact_number,
				"a_country_id"	   		=>$country_id,
				"a_state_id"	   		=>$state_id,
				"create_on"				=>time()
			);

			$result=$this->db->insert("agents", $data);
			
			return $result;	
		}

		public function agent_list_model()
		{
			$result=$this->db->query("select * from agents, states, country where agents.a_state_id=states.state_id AND agents.a_country_id=country.country_id AND agents.status=1  order By agents.a_id DESC");
			
			return $result->result_array();
		}

		public function agentModel()
		{
			$result=$this->db->query("select * from agents where status='1'");
			
			return $result->result_array();
		}

		public function delete_agent_model($id)
		{
			$data=array(
				"status"		=>0,
			);

			$this->db->where("a_id",$id);

			$result=$this->db->update("agents",$data);
			
			return $result;
		}
		
		public function edit_agent_model($edit_id)
		{
			$result=$this->db->query("select * from agents where a_id='".$edit_id."'");
			
			return $result->result_array();
		} 
		
		public function update_agent_model($agent_id,$name, $lname, $number, $a_per, $country_id, $state_id)
		{
			$data=array(

				"a_first_name"				=>$name,
				"a_last_name"				=>$lname,
				"a_percentage"				=>$a_per,
				"a_contact_number"			=>$number,
				"a_country_id"				=>$country_id,
				"a_state_id"				=>$state_id,
				"update_on"					=>time()
			);

			$this->db->where("a_id", $agent_id);

			$result=$this->db->update("agents", $data);
			
			return $result; 
		}
		public function payment_method_model()
		{
			$result=$this->db->query("select * from payment_method");
			
			return $result->result_array();
		}

		public function get_percentage_pm_model($p_method)
		{
			$result=$this->db->query("select percentage from payment_method where payment_method='".$p_method."'");
			
			return $result->result_array();
		}

		public function stockProductsModel()
		{
			$result=$this->db->query("SELECT products.id, products.product
			FROM products
			WHERE NOT EXISTS (
				SELECT  * FROM stock
				WHERE stock.s_product_id = products.id
			)");

			return $result->result_array();
		}
		public function save_stock_model($product, $quantity)
		{
			$data=array(

				"s_product_id"			=>$product,
				"s_product_qunatity"	=>$quantity,
				"s_create_on"			=>time(),
			);

			$result=$this->db->insert("stock", $data);
			
			return $result;
		}

		public function stock_list_model()
		{
			$result=$this->db->query("select * from products, stock where stock.s_product_id=products.id");
			
			return $result->result_array();
		}

		public function stock_edit_prodcut_model($stock_id)
		{
			$result=$this->db->query("select * from stock,products where products.id=stock.s_product_id AND stock.s_id='".$stock_id."'");
			
			return $result->result_array();
		}

		public function update_stock_model($stock_id, $s_product_qunatity)
		{
			$data=array(

				"s_product_qunatity"		=>$s_product_qunatity,
				"s_update_on"				=>time(),
			);

			$this->db->where("s_id",$stock_id);

			$result=$this->db->update("stock",$data);
			
			return $result;
		}

		public function product_stock_qunatity($order_id)
		{
			$result=$this->db->query("select stock.s_product_qunatity,stock.s_id from orders, products, stock where orders.product_id=products.id AND products.id=stock.s_product_id AND orders.order_id='".$order_id."'");
			
			return $result->result_array();
		}

		public function update_stock_product_model($stock_id, $quantity)
		{
			$data=array(
				"s_product_qunatity"		=>$quantity,
			);

			$this->db->where("s_id",$stock_id);
			
			$this->db->update("stock",$data);
		}

		public function pending_orders_model()
		{
			$result=$this->db->query("SELECT * FROM users, orders, customers, products 
				WHERE orders.vender_id=users.id 
				AND orders.customer_id=customers.customer_id
				AND orders.product_id=products.id 
				AND orders.order_status =1 
				AND orders.deleted='no' 
				ORDER BY order_id DESC"
			);

			return $result->result_array();
		}

		public function inProcess_orders_model()
		{
			$result=$this->db->query("SELECT * FROM users, orders, customers, products 
				WHERE orders.vender_id=users.id 
				AND orders.customer_id=customers.customer_id
				AND orders.product_id=products.id 
				AND orders.order_status =2 
				AND orders.deleted='no' 
				ORDER BY order_id DESC"
			);

			return $result->result_array();
		}

		public function refund_order_list_model()
		{
			$result=$this->db->query("SELECT * FROM users, orders, customers, products 
				WHERE orders.vender_id=users.id 
				AND orders.customer_id=customers.customer_id
				AND orders.product_id=products.id 
				AND orders.order_status =4 
				AND orders.deleted='no' 
				ORDER BY order_id DESC"
			);

			return $result->result_array();
		}
		public function insert_order_history_model($orderId, $tracking_id, $amount, $status)
		{
			$data=array(

				"o_h_order_id"				=>$orderId,
				"o_h_tracking_id"			=>$tracking_id,
				"o_h_amount"				=>$amount,
				"o_h_status"				=>$status,
				"o_h_update_on"				=>time(),
			);

			$result=$this->db->insert("order_history", $data);
			
			return $result;
		}
	}
?>