<?php

	class VenderModel Extends Ci_Model
	{
		public function getStateModel($id)
		{
			$result=$this->db->query("SELECT * FROM States Where country_id='".$id."'");
			
			return $result->result_array();
		}

		public function getCountry()
		{
			$result=$this->db->query("select * from country");
			
			return $result->result_array();
		}

		/*public function agentModel()
		{
			$this->db->where("status",'1');
			
			$result=$this->db->get("agents");
			
			return $result->result_array();
		}*/

		public function get_agent_model($vender_id)
		{
			$result=$this->db->query("select * from agents, states, country where agents.a_state_id=states.state_id AND agents.a_country_id=country.country_id AND agents.status=1 AND agents.vendor_id='".$vender_id."'  order By agents.a_id DESC");
			
			return $result->result_array();
		}


		public function addOrder($orderNo, $customer_id, $product_id, $quantity, $product_sell, $payment_method, $agent, $card_type, $card_number, $cvv_number, $card_ex_date, $country_id, $state_id, $address, $p_code)
		{
			$data=array(

				"orderNo"				=> $orderNo,
				"vender_id"				=> $_SESSION['data']['vender']['id'],
				"customer_id"			=> $customer_id,
				"product_id"			=> $product_id,
				"order_quantity"		=> $quantity,
				"o_country_id"			=> $country_id,
				"o_state_id"			=> $state_id,
				"o_street_address"		=> $address,
				"o_postal_code"			=> $p_code,
				//"amount"				=> $amount,
				//"ship_date"				=> $shipDate,
				//"state_id"				=> $state,
				//"postal_code"			=> $postalCode,
				//"shipping_address"		=> $shippingAddress,
				"o_create_on"				=> time(),
				"sell_product_cost"		=> $product_sell,
				"payment_method"		=> $payment_method,
				"agent"					=> $agent,
				"card_type"				=> $card_type,
				"card_number"			=> $card_number,
				"cvv_number"			=> $cvv_number,
				"card_ex_date"			=> $card_ex_date,
			);

			$result=$this->db->insert("orders", $data);	
			
			return $result;
		}

		public function getEmailModel($email)
		{
			$records=$this->db->query("select email from customers where email='".$email."'");
			
			return $records->result_array();
		}

		public function orderList()
		{
			$records=$this->db->query("select * from orders,customers,products where orders.customer_id=customers.customer_id AND orders.product_id=products.id AND orders.vender_id='".$_SESSION['data']['vender']['id']."' AND orders.deleted='no' Order By order_id DESC");

			return $records->result_array();
		}

		public function countOrder()
		{
			$result=$this->db->query("SELECT COUNT(*) AS num FROM orders WHERE vender_id='".$_SESSION['data']['vender']['id']."' AND orders.deleted='no' AND orders.order_status=1");
			
			return $result->result_array();
		}

		public function countOrderProcess()
		{
			$result=$this->db->query("SELECT COUNT(*) AS num FROM orders WHERE vender_id='".$_SESSION['data']['vender']['id']."' AND orders.deleted='no' AND orders.order_status=2");
			
			return $result->result_array();
		}

		public function countOrderDeliver()
		{
			$result=$this->db->query("SELECT COUNT(*) AS num FROM orders WHERE vender_id='".$_SESSION['data']['vender']['id']."' AND orders.deleted='no' AND orders.order_status=3");
			
			return $result->result_array();
		}
		public function countRefundOrder()
		{
			$result=$this->db->query("SELECT COUNT(*) AS num FROM orders where order_status='4' AND vender_id='".$_SESSION['data']['vender']['id']."'");
			
			return $result->result_array();
		}

		public function count_customer_model()
		{
			$result=$this->db->query("SELECT COUNT(*) AS num FROM customers where status='1'");
			
			return $result->result_array();
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
				"added_by"			=> $_SESSION['data']['vender']['id'],
				"added_on"			=> time()
			);

			$result=$this->db->insert("customers", $data);

			$insertId = $this->db->insert_id();

			$result_1=$this->db->query("select * from customers where customer_id='".$insertId."'");
			
			return $result_1->result_array();
		}
		public function getCustomerModel()
		{
			$records=$this->db->query("select * from customers");
			
			return $records->result_array();
		}

		public function editCustomerModel($id)
		{
			$records=$this->db->query("select * from customers where customer_id='".$id."'");
			
			return $records->result_array();
		}

		public function updateCustomerModel($fname, $lname, $email, $phone_no, $country_id, $state_id, $address, $postal_code, $customer_notes,$id)
		{
			$data =array(
				"firstName"			=> $fname,
				"lastName"			=> $lname,
				"email"				=> $email,
				"number"			=> $phone_no,
				"country_id"		=> $country_id,
				"state_id"			=> $state_id,
				"address"			=> $address,
				"postalCode"		=> $postal_code,
				"customer_notes"	=> $customer_notes,
				"update_on"			=> time()
			);
			$this->db->where('customer_id', $id);

			$result=$this->db->update('customers', $data);

			return $result;
		}
		public function getState($id)
		{
			$result=$this->db->query("select * from states where state_id='".$id."'");
			
			return $result->result_array();
		}

		public function orderEditModel($orderNo)
		{
			$result=$this->db->query("select * from orders, customers, products where orders.customer_id=customers.customer_id AND orders.product_id=products.id AND orderNo='".$orderNo."'");
			
			return $result->result_array();
		}

		public function orderUpdateModel($orderId, $customer_id, $product_id, $orderNo, $sell_pro, $quantity)
		{
			$data=array(
				'customer_id'			=> $customer_id,
				'product_id'			=> $product_id,
				'orderNo'				=> $orderNo,
				'order_quantity'		=> $quantity,
				'sell_product_cost'		=> $sell_pro,
			);

			$this->db->where('order_id', $orderId);

			$result=$this->db->update('orders', $data);

			return $result;
		}
		public function deleteOrderModel($orderId)
		{
			$data=array(

				"deleted"		=> "yes"
			);
			$this->db->where('order_id', $orderId);

			$result=$this->db->update("orders", $data);
			
			return $result;
		}

		public function updateVandorProfileModel($id, $fname, $lname, $pass, $number, $country, $image, $site)
		{
			$data=array(

				'name'				=>$fname,
				'last_name'			=>$lname,
				'password'			=>$pass,
				"phone_number"		=>$number,
				'image'				=>$image,
				'country_id'		=>$country,
				'site'				=>$site,
				'update_on'			=>time()
			);

			$this->db->where('id', $id);

			$flag=$this->db->update("users",$data);
			
			return $flag;
		}

		public function getVendorModel($id)
		{
			$result=$this->db->query("select * from users where id='".$id."'");
			
			return $result->result_array();
		}

		public function orderViewModel($id)
		{
			$result=$this->db->query("SELECT *  FROM users, customers, products, country, states,orders
				LEFT JOIN agents ON orders.agent = agents.a_id
				WHERE orders.vender_id=users.id
				AND orders.customer_id=customers.customer_id 
				AND orders.product_id=products.id 
				AND orders.o_country_id=country.country_id 
				AND orders.o_state_id=states.state_id 
				AND orders.order_id='".$id."'");
			
			return $result->result_array();
		}

		public function deliverOrdersModel()
		{
			$result=$this->db->query("select * from orders, users, products, customers where orders.vender_id=users.id AND orders.product_id=products.id AND orders.customer_id=customers.customer_id AND orders.order_status=3 AND orders.vender_id='".$_SESSION['data']['vender']['id']."'");
			
			return $result->result_array();
		}

		public function productCostModel($product_id)
		{
			$result=$this->db->query("select * from products where id='".$product_id."'");
			
			return $result->result_array();
		}

		public function refund_order_list_model($user_id)
		{
			$result=$this->db->query("SELECT * FROM users, orders, customers, products 
				WHERE orders.vender_id=users.id 
				AND orders.customer_id=customers.customer_id
				AND orders.product_id=products.id 
				AND orders.order_status =4 
				AND orders.deleted='no'
				AND orders.vender_id='".$user_id."' 
				ORDER BY order_id DESC"
			);

			return $result->result_array();
		}
		public function pending_orders_model($vender_id)
		{
			$result=$this->db->query("SELECT * FROM users, orders, customers, products 
				WHERE orders.vender_id=users.id 
				AND orders.customer_id=customers.customer_id
				AND orders.product_id=products.id 
				AND orders.order_status =1 
				AND orders.vender_id='".$vender_id."'
				AND orders.deleted='no' 
				ORDER BY order_id DESC"
			);

			return $result->result_array();
		}

		public function inProcess_orders_model($vender_id)
		{
			$result=$this->db->query("SELECT * FROM users, orders, customers, products 
				WHERE orders.vender_id=users.id 
				AND orders.customer_id=customers.customer_id
				AND orders.product_id=products.id 
				AND orders.order_status =2 
				AND orders.vender_id='".$vender_id."'
				AND orders.deleted='no' 
				ORDER BY order_id DESC"
			);

			return $result->result_array();
		}

		public function add_agent_model($vender_id, $name, $lname, $number, $agent_per, $country_id, $state_id)
		{
	

			$data=array(

				"a_first_name"	   		=>$name,
				"a_last_name"	  	 	=>$lname,
				"a_percentage"			=>$agent_per,
				"a_contact_number"	   	=>$number,
				"a_country_id"	   		=>$country_id,
				"a_state_id"	   		=>$state_id,
				"create_on"				=>time(),
				"vendor_id"				=>$vender_id
			);

			$result=$this->db->insert("agents", $data);
			
			return $result;	
		}
		public function payment_method_model()
		{
			$result=$this->db->query("select * from payment_method");
			
			return $result->result_array();
		}
	}
?>