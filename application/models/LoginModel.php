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
	}

?>