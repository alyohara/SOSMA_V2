<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->model('users');



	}
	public function index()
	{
		if (isset($_SESSION['user_id']))
		{
			redirect(base_url().'cp/');
		}else{
			$mailRecover = array(
				'name'             => 'email',
				'id'               => 'email',
				'aria-describedby' => 'basic-addon1',
				'aria-label'       => 'Username',
				'placeholder'      => 'Email Address',
				'class'            => 'form-control form-control-lg'
			);
			$username = array(
				'name'             => 'username',
				'id'               => 'username',
				'type' 			   => 'text',
				'aria-label'       => 'Username',
				'placeholder'      => 'Username',
				'class'            => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'required' 		   => ''
			);
			$pass = array(
				'name'             => 'password',
				'id'               => 'password',
				'type' 			   => 'password',
				'aria-label'       => 'Password',
				'placeholder'      => 'Password',
				'class'            => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'required' 		   => ''
			);

			$data = array(
				'mailRecover'=> $mailRecover,
				'username'   => $username,
				'pass'		 => $pass

			);


			$this->load->view('master/header');
			$this->load->view('login/login', $data);
			$this->load->view('master/login_footer');

		}
	}

	public function process()
	{

		if (isset($_SESSION['user_id']))
		{
			redirect("cp");
		}else{
			$user_login=array('email'=>$this->input->post('username'),'password'=>md5($this->input->post('password')), 'type' => 'user'); // the username is the email, remeber that
			$data = $this->users->chkUser($user_login['email'], $user_login['password']);

			if($data)  {
				$this->users->initSession($data);
				redirect("cp");
			}
			else{
				$this->session->set_flashdata('error_msg', 'USUARIO O CONTRASEÑA INCORRECTO');
				redirect("login");
			}
		}
	}

	public function logout()
	{
		$user_data = $this->session->all_userdata();
		foreach ($user_data as $key => $value) {
			if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
				$this->session->unset_userdata($key);
			}
		}
		$this->session->sess_destroy();
		redirect('login');
	}


}
