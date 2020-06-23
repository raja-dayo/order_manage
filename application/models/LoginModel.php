<?php

	class LoginModel Extends Ci_Model
	{
		public function login($email, $pass)
		{
			$result=$this->db->query("SELECT * FROM users WHERE email='".$email."' AND password='".$pass."'");

			return $result->result_array();
		}

		public function login_new($email)
		{
			$result=$this->db->query("SELECT * FROM users WHERE email='".$email."'");

			return $result->result_array();
		}

		public function check_email($email)
		{
			$this->db->where("email",$email);
			
			$result=$this->db->get("users");
			
			return $result->result_array();
		}

		public function update_verification_code($email, $code)
		{
			$data=array(

				"verification_code"			=>$code
			);

			$this->db->where("email",$email);

			$result=$this->db->update("users",$data);

			return $result; 
		}

		public function check_verification_code_model($email, $code)
		{
			$result=$this->db->query("select * from users where email='".$email."' AND verification_code='".$code."'");
			
			return $result->result_array();
		}

		public function new_password_model($email, $pass)
		{
			$data=array(

				"password"			=>$pass,
			);

			$this->db->where("email",$email);

			$result=$this->db->update("users",$data);
			
			return $result;
		}
	}

?>