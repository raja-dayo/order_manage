<?php
	class DEO_Model extends Ci_Model
	{
		public function getCategoryModel()
		{
			$result=$this->db->get_where("category",array("status"=>1));
			
			return $result->result_array();
		}

		public function deoModel($id)
		{
			$result=$this->db->query("select * from users where id='".$id."'");
			
			return $result->result_array();
		}
		
		public function getCountry()
		{
			$result=$this->db->query("select * from country");
			
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

		public function addproductModel($category_id, $product, $image, $description)
		{
			$data=array(
				'category_id'			=>$category_id,
				'product'				=>$product,
				'image'					=>$image,
				'description'			=>$description,
				'created_on'			=>time(),
				'status'                =>1,
			);

			$result=$this->db->insert("products", $data);
			
			return $result;
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

		public function deleteProduct($id)
		{
			$data=array(
				"status"			=>0
			);

			$this->db->where('id',$id);
			
			$flag=$this->db->update("products",$data);
			
			return $flag;
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

		public function deleteCategory($id)
		{
			$data=array(
				"status"			=>0
			);

			$this->db->where('id',$id);
			
			$flag=$this->db->update("category",$data);
			
			return $flag;
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

		public function stockProductsModel()
		{
			$result=$this->db->query("SELECT products.id, products.product
            FROM products
            WHERE products.status=1 AND NOT EXISTS (
            SELECT  * FROM stock
            WHERE stock.s_product_id = products.id
            )");

			return $result->result_array();
		}

		public function stock_list_model()
		{
			$result=$this->db->query("select * from products, stock where stock.s_product_id=products.id");
			
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
		public function order_list()
		{
			$result=$this->db->query("SELECT * FROM users, orders, order_detail, customers, delivery_method 
				WHERE orders.customer_id=customers.customer_id
				AND orders.orderNo=order_detail.orderNo
				AND orders.vender_id=users.id
				AND orders.delivery_method_id=delivery_method.id order By order_id DESC"
			);
			
			
			return $result->result_array();
		}
		public function orderViewModel($id)
		{
			//$result=$this->db->query("select * from users,orders,customers,products,country,states,agents where orders.vender_id=users.id AND orders.customer_id=customers.customer_id AND orders.product_id=products.id AND customers.country_id=country.country_id AND customers.state_id=states.state_id AND orders.order_id='".$id."'");

			$result=$this->db->query("SELECT *  FROM users, customers, products, country, orders
				LEFT JOIN agents ON orders.agent = agents.a_id
				WHERE orders.vender_id=users.id
				AND orders.customer_id=customers.customer_id 
				AND orders.product_id=products.id 
				AND customers.country_id=country.country_id  
				AND orders.order_id='".$id."'"
			);
			
			return $result->result_array();
		}
		public function countOrder()
		{
			$result=$this->db->query("SELECT COUNT(*) AS num FROM orders where order_status=1 AND deleted='no'");
			
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
		public function count_refund_orders_model()
		{
			$result=$this->db->query("SELECT COUNT(*) AS num FROM orders where order_status='4'");
			
			return $result->result_array();
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
		public function deliverOrdersModel()
		{
			$result=$this->db->query("select * from orders, users, products, customers where orders.vender_id=users.id AND orders.product_id=products.id AND orders.customer_id=customers.customer_id AND orders.order_status=3");
			
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

		public function agentModel()
		{
			$result=$this->db->query("select * from agents where status='1'");
			
			return $result->result_array();
		}

		public function payment_method_model()
		{
			$result=$this->db->query("select * from payment_method");
			
			return $result->result_array();
		}

		/*public function addOrder($orderNo, $customer_id, $product_id, $quantity, $product_sell, $payment_method, $agent, $agent_percentage, $card_type, $card_number, $cvv_number, $card_ex_date,$order_date)
		{
			$data=array(

				"orderNo"				=> $orderNo,
				"vender_id"				=> $_SESSION['data']['deo']['id'],
				"customer_id"			=> $customer_id,
				"product_id"			=> $product_id,
				"order_quantity"		=> $quantity,
				"order_date"			=>	$order_date,
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
		}*/

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
		public function productCostModel($product_id)
		{
			$result=$this->db->query("select * from products where id='".$product_id."'");
			
			return $result->result_array();
		}

		public function addCustomerModel($data)
		{
			$data=array(

				"firstName"			=> $data['firstName'],		
				"lastName"			=> $data['lastName'],		
				"email"				=> $data['email'],			
				"number"			=> $data['phoneNumber'], 	
				"country_id"		=> $data['country_id'],		
				"state_id"			=> $data['state_id'], 		
				"address"			=> $data['address'], 		
				"postalCode"		=> $data['postalCode'],
				"added_by"			=> $_SESSION['data']['deo']['id'],
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

		public function searchModel($pattern)
		{
			$this->db->like('email', $pattern, 'after');
			
			$records=$this->db->get("customers");
			
			return $records->result_array();
		}

		public function getEmailModel($email)
		{
			$records=$this->db->query("select email from customers where email='".$email."'");
			
			return $records->result_array();
		}
		public function getCountriesModel()
		{
			$result=$this->db->query("select * from country");
			
			return $result->result_array();
		}

		public function getStateModel($id)
		{
			$result=$this->db->query("SELECT state_name as text, state_id as value FROM states Where country_id='".$id."'");
			
			return $result->result_array();
		}
		public function product_stock_qunatity($order_id)
		{
			$result=$this->db->query("select stock.s_product_qunatity,stock.s_id from orders, products, stock where orders.product_id=products.id AND products.id=stock.s_product_id AND orders.order_id='".$order_id."'");
			
			return $result->result_array();
		}

		public function order_tracking($order_id, $status, $tracking_id)
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

		public function update_stock_product_model($stock_id, $quantity)
		{
			$data=array(
				"s_product_qunatity"		=>$quantity,
			);

			$this->db->where("s_id",$stock_id);
			
			$this->db->update("stock",$data);
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