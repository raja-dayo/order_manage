<?php
	
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Abc Extends Ci_Controller
	{
		public function __construct()
		{
			parent::__construct();

			$this->load->model("AdminModel", "admin");
			
			$this->load->library("email");

		}
		
		public function index(){
		    
		    //$res=$this->admin->exModel();
		    
		    $result['data']=$this->admin->emailMsg();
			
			$config['protocol']         = 'smtp';
        	$config['smtp_host']        = 'ssl://om.infinix-tech.com';
        	$config['smtp_port']        = '465';
        	$config['smtp_user']        = 'no-reply@om.infinix-tech.com';
        	$config['smtp_pass']        = 'om.Infinix';
        	$config['smtp_timeout']     = '7';
        	$config['charset']          = 'utf-8';
        	$config['newline']          = "\r\n";
        	$config['mailtype']         = 'html'; // or html
        	$config['validation']       = TRUE; // bool whether to validate email or not      

        	$this->email->initialize($config);

			$this->email->from('no-reply@om.infinix-tech.com', 'Infinix Tech Solution Pvt Ltd');
        	
        	$this->email->to('nauman@infinixtechnologies.com');
        	
        	$this->email->to('rajadayo1@Gmail.com'); 
        	
        	$this->email->subject('Email Test');
        	
        	$this->email->message($this->load->view('admin/email',$result, TRUE));  

		    $this->email->send();
		    
	    }
	}
?>	