<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Customer extends Ci_controller{

		public function dashboard()
		{
			$this->load->view("customer/dashboard");
		}

	}


?>