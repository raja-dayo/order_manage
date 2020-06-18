<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Login Extends Ci_controller
	{
		public function index()
		{
			
			if(isset($_SESSION['data']['admin']))
			{
				return redirect('admin/dashboard');

			}
			else if(isset($_SESSION['data']['vender']))
			{
				return redirect('vender/dashboard');
			}
			else
			{
				$this->load->view("login");
			}
		}

		public function login_process()
		{
			extract($_REQUEST);
			
			$this->load->model("LoginModel", "lModel");

			$data=$this->lModel->login_new($email);

			$decrypt_password= $data[0]['password'];


			$decrypt_password = rawurldecode($this->encrypt->decode($decrypt_password));
			

			if($password==$decrypt_password && $email==$data[0]['email'])
			{
				if($data[0]['roll_id']==1)
				{	
					$_SESSION['data']['admin']=$data[0];
				
					return redirect("admin/dashboard");
				}
				else if($data[0]['roll_id']==2)
				{
					
					$_SESSION['data']['vender']=$data[0];
					
					return redirect("vender/dashboard");
				}
				else if($data[0]['roll_id']==3)
				{
					$_SESSION['data']['customer']=$data[0];
					
					return redirect("customer/dashboard");
				}
			}
			else
			{
				//echo "ghalat aa";
				$this->session->set_flashdata("msg", "Email or password is incorrect");
				return redirect("login");
			}
			die;
				//*/	
		}

		public function logout()
		{
			unset($_SESSION['data']);
			
			return redirect("login");
		}
	}
?>