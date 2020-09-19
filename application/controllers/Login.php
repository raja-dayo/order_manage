<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Login Extends Ci_controller
	{
		public function __construct()
		{
			parent::__construct();

			$this->load->model('LoginModel','login');

			$this->load->helper('form');

			$this->load->library('email');
		}

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
			else if(isset($_SESSION['data']['deo']))
			{
				return redirect('deo/dashboard');
			}
			else
			{
				$this->load->view("login");
			}
		}

		public function login_process()
		{
			
			extract($_REQUEST);
		
			$data=$this->login->login_new($email);
            
          
			if($data)
			{
				
				$decrypt_password= $data[0]['password'];


				$decrypt_password = rawurldecode($this->encrypt->decode($decrypt_password));

				if($password==$decrypt_password && $email==$data[0]['email'] && $data[0]['status']==1)
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
						$_SESSION['data']['deo']=$data[0];
					
						return redirect("deo/dashboard");
					}
				}
				else
				{
					$this->session->set_flashdata("msg", "Email or password is incorrect");
					return redirect("login");
				}
			}
			else
			{
				$this->session->set_flashdata("msg", "Email or password is incorrect");
				return redirect("login");
			}	
		}

		public function forgot_password()
		{
			$this->load->view("forgot_password");
		}

		public function pass_reset()
		{
			if(isset($_REQUEST['email']))
			{
				$result=$this->login->check_email($_REQUEST['email']);

				if($result)
				{	
					$this->load->helper('string');
					
					$code= random_string('alnum',6);

					$_SESSION['email']=$result[0]['email'];

					$result=$this->login->update_verification_code($_SESSION['email'],$code);
					
					if($result)
					{
						
						$config['protocol']    = 'smtp';
			        	$config['smtp_host']    = 'ssl://smtp.gmail.com';
			        	$config['smtp_port']    = '465';
			        	//$config['smtp_host']    = 'ssl://smtp.server.mysleepingtab.com';
			        	//$config['smtp_port']    = '465';
			        	$config['smtp_timeout'] = '7';
			        	$config['smtp_user']    = 'hyder.php.developer@gmail.com';
			        	$config['smtp_pass']    = '2K14cse_172';
			        	//$config['smtp_user']    = 'no-reply@om.xanaxsupplier.com';
			        	//$config['smtp_pass']    = 'r.dayo@123';
			        	$config['charset']    = 'utf-8';
			        	$config['newline']    = "\r\n";
			        	$config['mailtype'] = 'text'; // or html
			        	$config['validation'] = TRUE; // bool whether to validate email or not      

			        	$this->email->initialize($config);

						$this->email->from('no-reply@om.xanaxsupplier.com', 'Infinix Tech Solution Pvt Ltd');
			        	
			        	$this->email->to($_SESSION['email']); 

			        	$this->email->subject('Create New Password');
			        
			        	$this->email->message($code);  

			        	if($this->email->send())
			        	{
			        		$this->load->view('get_code');
			        	}
			        	else
			        	{
							echo $this->email->print_debugger();
			        	}	
					}	
				}
				else
				{
					$this->session->set_flashdata('msg',"Email not matched");

					return redirect('login/forgot_password');
				}
			}
			else if(isset($_SESSION['email']))
			{
				//$this->load->helper('string');
					
				//$code= random_string('alnum',6);

				//$result=$this->login->update_verification_code($_SESSION['email'],$code);

				$this->load->view('get_code');
			}
			
		}

		public function check_verification_code()
		{
			//echo "<pre>";
			//print_r($_REQUEST);
			//echo $_SESSION['email'];
			//die;
			$result=$this->login->check_verification_code_model($_SESSION['email'], $_REQUEST['code']);
			
			if($result)
			{
				$this->load->view('password_update_page');
			}
			else
			{
				$this->session->set_flashdata('msg',"Sorry verification code doesn't match");

				return redirect('login/pass_reset');
			}
		}

		public function change_password()
		{
			//echo "<pre>";
			//print_r($_REQUEST);

			$password = urldecode($this->encrypt->encode($_REQUEST['new_pass']));

			$result=$this->login->new_password_model($_SESSION['email'], $password);
			
			if($result)
			{
				//echo "password updated";
				
				return redirect("login");
			}
			else
			{
				echo "password not updated";
			}
		}

		public function logout()
		{
			unset($_SESSION['data']);
			
			return redirect("login");
		}
	}
?>