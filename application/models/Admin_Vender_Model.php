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
			$records=$this->db->query("select * from products");
			
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

		public function updateCustomerModel($fname, $lname, $email, $phone_no, $country_id, $state_id, $address, $postal_code, $customer_notes, $payment_method, $cardType, $cardNumber, $cvvNumber, $ex_date, $id)
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
				"payment_method"	=> $payment_method,
				"card_type"			=> $cardType,
				"card_number"		=> $cardNumber,
				"cvv_number"		=> $cvvNumber,
				"expiry_date"		=> $ex_date,
				"update_on"			=> time()
			);
			$this->db->where('customer_id', $id);

			$result=$this->db->update('customers', $data);

			return $result;
		}

		public function searchModel($pattern)
		{
			$this->db->like('email', $pattern, 'after');
			
			$records=$this->db->get("customers");
			
			return $records->result_array();
		}
	}

?>