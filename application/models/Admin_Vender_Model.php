<?php

	class Admin_Vender_Model extends Ci_Model
	{
		public function countOrder()
		{
			$result=$this->db->query("SELECT COUNT(*) AS num FROM orders");
			
			return $result->result_array();
		}

		public function orderList()
		{
			$records=$this->db->query("select * from orders,customers,products where orders.customer_id=customers.id AND orders.product_id=products.id AND delete=no");
			
			return $records->result_array();
		}

		public function productsModel()
		{
			$records=$this->db->query("select * from products where status=1");
			
			return $records->result_array();
		}

		public function addCustomerModel($fname, $lname, $email, $phone_no, $country_id, $state_id, $address, $postal_code, $customer_notes, $payment_method, $cardType, $cardNumber, $cvvNumber, $ex_date)
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
				"payment_method"	=> $payment_method,
				"card_type"			=> $cardType,
				"card_number"		=> $cardNumber,
				"cvv_number"		=> $cvvNumber,
				"expiry_date"		=> $ex_date,
				"added_by"			=> $_SESSION['data']['vender']['id'],
				"added_on"			=> time()
			);

			$result=$this->db->insert("customers", $data);

			$insertId = $this->db->insert_id();

			$result_1=$this->db->query("select * from customers where customer_id='".$insertId."'");
			
			return $result_1->result_array();
		}

		public function editCustoemrModel($id){

			$this->db->where('customer_id',$id);

			$result=$this->db->get('customers');

			return $result->result_array();
		}

		public function updateCustomerModel($data,$c_id)
		{
			$data =array(
				"firstName"			=> $data['firstName'],
				"lastName"			=> $data['lastName'],
				"email"				=> $data['email'],
				"number"			=> $data['phoneNumber'],
				"country_id"		=> $data['country_id'],
				"state_id"			=> $data['state'],
				"address"			=> $data['address'],
				"postalCode"		=> $data['postalCode'],
				"update_on"			=> time()
			);
			$this->db->where('customer_id', $c_id);

			$result=$this->db->update('customers', $data);

			return $result;
		}

		public function searchModel($pattern)
		{
			$this->db->like('postalCode', $pattern, 'after');
			
			$this->db->or_like('firstname', $pattern, 'after');
			
			$records=$this->db->get("customers");
			
			return $records->result_array();
		}

		public function getDeliveryMethod(){

			$result=$this->db->get("delivery_method");
			
			return $result->result_array();
		}
		
		public function getSingleDeliveryMethod($id){

			$this->db->where('id',$id);
			
			$result=$this->db->get("delivery_method");
			
			return $result->result_array();
		}

		public function checkOrderNoModel($orderNo)
		{
			$this->db->select('orderNo');

			$this->db->where('orderNo', $orderNo);
			
			$result=$this->db->get('orders');
			//$records=$this->db->query("select email from customers where email='".$email."'");
			
			return $result->result_array();
		
		}
		public function addOrder($data)
		{
			$data=array(

				"orderNo"				=> $data['orderNo'],// $orderNo,
				"vender_id"				=> $data['vender_id'], //  user_id, //$_SESSION['data']['deo']['id'],
				"customer_id"			=> $data['customer_id'],
				//"product_id"			=> $product_id,
				//"order_quantity"		=> $quantity,
				"order_date"			=>	$data['order_date'], // $order_date,
			//	"o_country_id"			=> $country_id,
			//	"o_state_id"			=> $state_id,
			//	"o_street_address"		=> $address,
			//	"o_postal_code"			=> $p_code,
				//"amount"				=> $amount,
				//"ship_date"				=> $shipDate,
				//"state_id"				=> $state,
				//"postal_code"			=> $postalCode,
				//"shipping_address"		=> $shippingAddress,
				"o_create_on"				=> time(),
				//"sell_product_cost"		=> $product_sell,
				"payment_method"		=> $data['p_method'],//payment_method
				"agent"					=> $data['agent'],
				"agent_percentage"		=> $data['pm_percentage'],	
				"card_type"				=> $data['cardNumber'],
				"card_number"			=> $data['cardNumber'],
				"cvv_number"			=> $data['cvvCode'],
				"card_ex_date"			=> $data['expiryDate'],
				"delivery_method_id"	=> $data['d_method'],
				"o_total_amount"		=>$data['amount'],
			);

			$result=$this->db->insert("orders", $data);	
			
			return $result;
		}

		public function addOrderDetail($orderNo, $product_id, $quantity, $sell_pro){

			$data=array(

				"orderNo"					=>$orderNo,
				"od_product_id"				=>$product_id,
				"od_product_quantity"		=>$quantity,
				"od_product_price"			=>$sell_pro
			);
			$result=$this->db->insert("order_detail",$data);
			
			return $result;
		}

		public function product_stock_qunatity($order_id)
		{
			$result=$this->db->query("select stock.s_product_qunatity,stock.s_id from orders, order_detail, products, stock where orders.orderNo=order_detail.orderNo AND  order_detail.od_product_id=products.id AND products.id=stock.s_product_id AND orders.order_id='".$order_id."'");

			
			return $result->result_array();
		}


		public function update_order($res)
		{
			$data=array(

				"order_status"       =>$res['status'],
				"tracking_id"        =>$res['tracking'],
				"o_update_on"		 =>time(),
			);

			$this->db->where('order_id',$res['orderId']);
			
			$result=$this->db->update("orders", $data);
			
			return $result;
		}

		public function insert_order_history_model($res)
		{
			$data=array(

				"o_h_order_id"				=>$res['orderId'],
				"o_h_tracking_id"			=>$res['tracking'],
				"o_h_amount"				=>$res['amount'],
				"o_h_status"				=>$res['status'],
				"o_h_update_on"				=>time(),
			);

			$result=$this->db->insert("order_history", $data);
			
			return $result;
		}
		public function update_stock_qunatity($quantity, $p_id){
			
			$this->db->set('s_product_qunatity', "s_product_qunatity-$quantity",FALSE);
			
			$this->db->where('s_product_id', $p_id);
			
			$result=$this->db->update('stock');

			return $result;
			
		}
		public function order_list()
		{
			$result=$this->db->query("SELECT * FROM users, orders, customers, delivery_method 
				WHERE orders.customer_id=customers.customer_id
				AND orders.vender_id=users.id
				AND orders.delivery_method_id=delivery_method.id order By order_id DESC"
			);
			
			
			return $result->result_array();
		}

		public function orderViewModel($id)
		{
			$result=$this->db->query("SELECT *  FROM users, customers, products, country, delivery_method, order_detail, orders 
				LEFT JOIN agents ON orders.agent = agents.a_id
				WHERE orders.vender_id=users.id
				AND orders.customer_id=customers.customer_id 
				AND order_detail.od_product_id=products.id 
				AND customers.country_id=country.country_id 
				AND orders.delivery_method_id=delivery_method.id
				AND orders.orderNo=order_detail.orderNo
				AND order_detail.orderNo='".$id."'

			");
			
			return $result->result_array();
		}
		
		public function get_product_name($id){

			$this->db->select("product");

			$this->db->where("id",$id);

			$result=$this->db->get("products");
			
			return $result->result_array();
		}
		
		public function getproducts_name($name)
		{
		    $this->db->where('product',$name);
		    
		    $result=$this->db->get('products');
		
		    return $result->result_array();
		}
	}
?>