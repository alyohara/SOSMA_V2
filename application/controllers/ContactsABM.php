<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactsABM extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('users');
		$this->load->model('roles');
		$this->load->library('form_validation');
		//$this->load->model('status');
	}



	function double_email_check($email)
	{
		if($this->users->double_email_check($email, $_SESSION['userid'])) {
			return FALSE;
		} else {
			return TRUE;
		}
	}


	public function index()
	{
		if (isset($_SESSION['user_id']))
		{
			// ==============================================================
			// get all users
			// ==============================================================
			$users=$this->users->getAllUsers($this->session->role);
			// ==============================================================
			// end get all users
			// ==============================================================

			$data = array(
				'breadCrum' => 'usersABM',
				'breadCrum2' => 'usersABM',
				'users' => $users
			);

			$this->load->view('usersABM/header');
			$this->load->view('cp/body_start');
			$this->load->view('cp/topbar');
			$this->load->view('cp/leftbar', $data);
			$this->load->view('usersABM/body',$data);
			$this->load->view('usersABM/footer');
		}else{
			redirect(base_url());

		}
	}

	public function add($user='')
	{
		redirect(base_url().'usersABM/usersAdd/');
	}
	public function usersAdd()
	{
		if (isset($_SESSION['user_id']))
		{	// ==============================================================
			// get all roles
			// ==============================================================
			$roles=$this->roles->getRolesSelect();
			// ==============================================================
			// end get all roles
			// ==============================================================

			// ==============================================================
			// new user form data
			// ==============================================================
			$valueAux = set_value('username');
			$username = array(
				'name'             => 'username',
				'id'               => 'username',
				'value'			   => $valueAux,
				'type' 			   => 'text',
				'minlength'		   => '5',
				'maxlength'        => '32',
				'aria-label'       => 'Username',
				'placeholder'      => 'Username',
				'class'            => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'required' 		   => ''
			);
			$valueAux = set_value('name_title');
			$name_title = array(
				'name'             => 'name_title',
				'id'               => 'name_title',
				'value'			   => $valueAux,
				'type' 			   => 'text',
				'maxlength'        => '12',
				'aria-label'       => 'name_title',
				'placeholder'      => 'Título',
				'class'            => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1'
			);
			$valueAux = set_value('name_first');
			$name_first = array(
				'name'             => 'name_first',
				'id'               => 'name_first',
				'value'			   => $valueAux,
				'type' 			   => 'text',
				'minlength'		   => '5',
				'maxlength'        => '32',
				'aria-label'       => 'name_first',
				'placeholder'      => 'Primer Nombre',
				'class'            => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'required' 		   => ''
			);
			$valueAux = set_value('name_middle');
			$name_middle = array(
				'name'             => 'name_middle',
				'id'               => 'name_middle',
				'value'			   => $valueAux,
				'type' 			   => 'text',
				'minlength'		   => '5',
				'maxlength'        => '32',
				'aria-label'       => 'name_middle',
				'placeholder'      => 'Segundo Nombre',
				'class'            => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1'
			);
			$valueAux = set_value('name_last');
			$name_last = array(
				'name'             => 'name_last',
				'id'               => 'name_last',
				'value'			   => $valueAux,
				'type' 			   => 'text',
				'minlength'		   => '5',
				'maxlength'        => '32',
				'aria-label'       => 'name_last',
				'placeholder'      => 'Apellido',
				'class'            => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'required' 		   => ''
			);
			$valueAux = set_value('phone');
			$phone = array(
				'name'             => 'phone',
				'id'               => 'phone',
				'value'			   => $valueAux,
				'type' 			   => 'text',
				'aria-label'       => 'phone',
				'placeholder'      => 'Teléfono',
				'class'            => 'form-control form-control-lg phone-inputmask',
				'aria-describedby' => 'basic-addon1',
				'required' 		   => ''
			);
			$valueAux = set_value('email');
			$email = array(
				'name'             => 'email',
				'id'               => 'email',
				'value'			   => $valueAux,
				'type' 			   => 'email',
				'aria-label'       => 'email',
				'placeholder'      => 'Email',
				'class'            => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'required' 		   => ''
			);

			$pass = array(
				'name'             => 'pass',
				'id'               => 'pass',
				'type' 			   => 'password',
				'aria-label'       => 'pass',
				'minlength'		   => '5',
				'maxlength'        => '32',
				'placeholder'      => 'Contraseña',
				'class'            => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'required' 		   => ''
			);
			$passconf = array(
				'name'             => 'passconf',
				'id'               => 'passconf',
				'type' 			   => 'password',
				'minlength'		   => '5',
				'maxlength'        => '32',
				'aria-label'       => 'passconf',
				'placeholder'      => 'Confirme la Contraseña',
				'class'            => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'matches'		   => 'pass',
				'required' 		   => ''
			);
			$options = $roles;
			$rolesExtra = array(
				'id'               => 'roles',
				'aria-label'       => 'Roles',
				'class'            => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'required' 		   => ''
			);


			// ==============================================================
			// form validator
			// ==============================================================

			$this->form_validation->set_rules('username', 'username', 'required|min_length[5]|max_length[32]|is_unique[users.username]',
				array(
//					'required'      => 'Debe completar el usuario.',
					'is_unique'     => 'Este usuario ya existe.'
				));
//			$this->form_validation->set_rules('name_first', 'name_first', 'required|min_length[5]|max_length[32]',
//				array(
//					'required'      => 'Debe completar el nombre.'
//				));
//			$this->form_validation->set_rules('name_last', 'name_last', 'required|min_length[5]|max_length[32]',
//				array(
//					'required'      => 'Debe completar el apellido.'));
			$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[users.email]',
				array(
//					'required' => 'Debe completar el email.',
					'is_unique'  => 'Este correo ya existe.'));

			$this->form_validation->set_rules('pass', 'pass', 'required',
				array('required' => 'Debe completar la contraseña.')
			);
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|min_length[5]|max_length[32]|matches[pass]',
				array(
//					'required' => 'Debe confirmar la contraseña.',
					'matches' => 'Los passwords no coinciden.'));
//			$this->form_validation->set_rules('roles', 'roles', 'required|min_length[5]|max_length[32]',
//				array('required' => 'Debe elegir un rol.')
//			);

			// ==============================================================
			// end new user form data
			// ==============================================================
			$data = array(
				'breadCrum' => 'usersABM',
				'breadCrum2' => 'usersABM/userAdd',
				'username' => $username,
				'name_title' => $name_title,
				'name_first' => $name_first,
				'name_middle' => $name_middle,
				'name_last' => $name_last,
				'email' => $email,
				'pass' => $pass,
				'passconf' => $passconf,
				'role' => $options,
				'rolesExtra' => $rolesExtra,
				'phone' => $phone
			);


			if ($this->form_validation->run() == FALSE)
			{

				$this->load->view('usersABM/header');
				$this->load->view('cp/body_start');
				$this->load->view('cp/topbar');
				$this->load->view('cp/leftbar', $data);
				$this->load->view('usersABM/usersAdd',$data);
				$this->load->view('usersABM/footer');
			}
			else
			{
				$user=array(
					'username'=>$this->input->post('username'),
					'name_title'=>$this->input->post('name_title'),
					'name_first'=>$this->input->post('name_first'),
					'name_middle'=>$this->input->post('name_middle'),
					'name_last'=>$this->input->post('name_last'),
					'email'=>$this->input->post('email'),
					'password'=>md5($this->input->post('pass')),
					'id_user_roles'=>$this->input->post('Roles'),
					'phone'=>$this->input->post('phone'),
					'id_user_status'=>'2'
				);

				$this->users->insertUser($user, $this->session->user_id);
				$this->session->set_flashdata('success_msg', '<strong>Exito!</strong> Usuario agregado exitosamente');
				redirect(base_url().'usersABM/usersAdd');
			}


		}else{
			redirect(base_url());

		}
	}

	public function username_check($str)
	{
		if ($str == 'test')
		{
			//$this->form_validation->set_message('username_check', 'The {field} field can not be the word "test"');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}


	public function user($id='')
	{
		if (isset($_SESSION['user_id']))
		{
			// ==============================================================
			// get user
			// ==============================================================
			$user=$this->users->getUserById($id);

			// ==============================================================
			// end get user
			// ==============================================================
			// ==============================================================
			// get history
			// ==============================================================
			$history=$this->users->getHistoryByUserId($id);
			// ==============================================================
			// end get history
			// ==============================================================
			// ==============================================================
			// get all roles
			// ==============================================================
			$roles=$this->roles->getRolesSelect();
			// ==============================================================
			// end get all roles
			// ==============================================================


			$pass = array(
				'name'             => 'pass',
				'id'               => 'pass',
				'type' 			   => 'password',
				'aria-label'       => 'pass',
				'minlength'		   => '5',
				'maxlength'        => '32',
				'placeholder'      => 'Contraseña',
				'class'            => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'onkeyup'		   => 'checkPass();',
				'required' 		   => ''
			);
			$passconf = array(
				'name'             => 'passconf',
				'id'               => 'passconf',
				'type' 			   => 'password',
				'minlength'		   => '5',
				'maxlength'        => '32',
				'aria-label'       => 'passconf',
				'placeholder'      => 'Confirme la Contraseña',
				'class'            => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'matches'		   => 'pass',
				'onkeyup'		   => 'checkPass();',
				'required' 		   => ''
			);

			$data = array(
				'breadCrum' => 'usersABM',
				'breadCrum2' => 'usersABM',
				'user' => $user,
				'roles' => $roles,
				'pass'  => $pass,
				'passconf' => $passconf,
				'history' => $history
			);

			$this->load->view('usersABM/header');
			$this->load->view('cp/body_start');
			$this->load->view('cp/topbar');
			$this->load->view('cp/leftbar', $data);
			$this->load->view('usersABM/user',$data);
			$this->load->view('usersABM/footer');
		}else{
			redirect(base_url());

		}
	}


	public function userMod($id='')
	{
		if (isset($_SESSION['user_id']))
		{
			// ==============================================================
			// get user
			// ==============================================================
			if ($id=='')
			{
				$id = $_SESSION['userid'];
			};
			$user=$this->users->getUserById($id);
			// ==============================================================
			// end get user
			// ==============================================================

			// ==============================================================
			// mod user form data
			// ==============================================================

			$valueAux = $user->username;
			$username = array(
				'name'             => 'username',
				'id'               => 'username',
				'value'			   => $valueAux,
				'type' 			   => 'text',
				'minlength'		   => '5',
				'maxlength'        => '32',
				'aria-label'       => 'Username',
				'placeholder'      => 'Username',
				'class'            => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'required' 		   => '',
				'disabled'		   => ''
			);
			$valueAux = set_value('name_title');
			if (!$valueAux) {$valueAux = $user->name_title;}
			$name_title = array(
				'name'             => 'name_title',
				'id'               => 'name_title',
				'value'			   => $valueAux,
				'type' 			   => 'text',
				'maxlength'        => '12',
				'aria-label'       => 'name_title',
				'placeholder'      => 'Título',
				'class'            => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1'
			);
			$valueAux = set_value('name_first');
			if (!$valueAux) {$valueAux = $user->name_first;}
			$name_first = array(
				'name'             => 'name_first',
				'id'               => 'name_first',
				'value'			   => $valueAux,
				'type' 			   => 'text',
				'minlength'		   => '5',
				'maxlength'        => '32',
				'aria-label'       => 'name_first',
				'placeholder'      => 'Primer Nombre',
				'class'            => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'required' 		   => ''
			);
			$valueAux = set_value('name_middle');
			if (!$valueAux) {$valueAux = $user->name_middle;}
			$name_middle = array(
				'name'             => 'name_middle',
				'id'               => 'name_middle',
				'value'			   => $valueAux,
				'type' 			   => 'text',
				'minlength'		   => '5',
				'maxlength'        => '32',
				'aria-label'       => 'name_middle',
				'placeholder'      => 'Segundo Nombre',
				'class'            => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1'
			);
			$valueAux = set_value('name_last');
			if (!$valueAux) {$valueAux = $user->name_last;}
			$name_last = array(
				'name'             => 'name_last',
				'id'               => 'name_last',
				'value'			   => $valueAux,
				'type' 			   => 'text',
				'minlength'		   => '5',
				'maxlength'        => '32',
				'aria-label'       => 'name_last',
				'placeholder'      => 'Apellido',
				'class'            => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'required' 		   => ''
			);
			$valueAux = set_value('phone');
			if (!$valueAux) {$valueAux = $user->phone;}
			$phone = array(
				'name'             => 'phone',
				'id'               => 'phone',
				'value'			   => $valueAux,
				'type' 			   => 'text',
				'aria-label'       => 'phone',
				'placeholder'      => 'Teléfono',
				'class'            => 'form-control form-control-lg phone-inputmask',
				'aria-describedby' => 'basic-addon1',
				'required' 		   => ''
			);
			$valueAux = set_value('email');
			$valueAux = $user->email;
			if (!$valueAux) {$valueAux = $user->email;}
			$email = array(
				'name'             => 'email',
				'id'               => 'email',
				'value'			   => $valueAux,
				'type' 			   => 'email',
				'aria-label'       => 'email',
				'placeholder'      => 'Email',
				'class'            => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'required' 		   => ''
			);


			$options = '';
			$rolesExtra = $user->id_user_roles;


			// ==============================================================
			// form validator
			// ==============================================================
			$this->form_validation->set_rules('email', 'email', 'required|valid_email|callback_double_email_check',
				array(
					'is_unique'  => 'Este correo ya existe.'));
			$this->form_validation->set_message('double_email_check','Correo inválido');
			// ==============================================================
			// end new user form data
			// ==============================================================
			$data = array(
				'breadCrum' => 'usersABM',
				'breadCrum2' => 'usersABM',
				'username' => $username,
				'name_title' => $name_title,
				'name_first' => $name_first,
				'name_middle' => $name_middle,
				'name_last' => $name_last,
				'email' => $email,
				'role' => $options,
				'rolesExtra' => $rolesExtra,
				'phone' => $phone,
				'user_id' => $user->id
			);


			if ($this->form_validation->run() == FALSE)
			{

				$this->load->view('usersABM/header');
				$this->load->view('cp/body_start');
				$this->load->view('cp/topbar');
				$this->load->view('cp/leftbar', $data);
				$this->load->view('usersABM/userMod', $data);
				$this->load->view('usersABM/footer');
			}
			else
			{
				$user=array(
					'name_title'=>$this->input->post('name_title'),
					'name_first'=>$this->input->post('name_first'),
					'name_middle'=>$this->input->post('name_middle'),
					'name_last'=>$this->input->post('name_last'),
					'email'=>$this->input->post('email'),
					'id_user_roles'=>$this->input->post('Roles'),
					'phone'=>$this->input->post('phone'),
					'id_user_status'=>'3',
					'id' => $_SESSION['userid']
				);


				$this->users->updateUser($user, $this->session->user_id);
				$this->session->set_flashdata('success_msg', '<strong>¡Exito!</strong> Usuario modificado exitosamente');
				redirect(base_url().'usersABM/user/'.$_SESSION['userid']);
			}


		}else{
			redirect(base_url());

		}
	}


	public function userDel()
	{
		if (isset($_SESSION['user_id']))
		{
			// ==============================================================
			// get user
			// ==============================================================
			$this->users->delUserById($this->input->post('user_id_del'), $_SESSION['user_id']);
			// ==============================================================
			// end get user
			// ==============================================================
			$this->session->set_flashdata('success_msg', '<strong>¡Exito!</strong> Usuario eliminado');
			redirect(base_url().'usersABM/');
		}else{
			redirect(base_url());
		}
	}

	public function userAct()
	{
		if (isset($_SESSION['user_id']))
		{
			// ==============================================================
			// get user
			// ==============================================================
			$this->users->actUserById($this->input->post('user_id_ac'), $_SESSION['user_id']);
			// ==============================================================
			// end get user
			// ==============================================================
			$this->session->set_flashdata('msg', '<strong>¡Exito!</strong> Usuario Re -Activado');
			redirect(base_url().'usersABM/');
		}else{
			redirect(base_url());
		}
	}
	public function userHistory($id='')
	{
		if (isset($_SESSION['user_id']))
		{
			// ==============================================================
			// get user
			// ==============================================================
			$user=$this->users->getUserById($id);
			// ==============================================================
			// end get user
			// ==============================================================
			// ==============================================================
			// get history
			// ==============================================================
			$history=$this->users->getFullHistoryByUserId($id);
			// ==============================================================
			// end get history
			// ==============================================================
			// ==============================================================
			// get all roles
			// ==============================================================
			$roles=$this->roles->getRolesSelect();
			// ==============================================================
			// end get all roles
			// ==============================================================

			$data = array(
				'breadCrum' => 'usersABM',
				'breadCrum2' => 'usersABM',
				'user' => $user,
				'roles' => $roles,
				'history' => $history
			);

			$this->load->view('usersABM/header');
			$this->load->view('cp/body_start');
			$this->load->view('cp/topbar');
			$this->load->view('cp/leftbar', $data);
			$this->load->view('usersABM/history',$data);
			$this->load->view('usersABM/footer');
		}else{
			redirect(base_url());

		}
	}

	public function userChangePass()
	{
		if (isset($_SESSION['user_id']))
		{
			// ==============================================================
			// get user and new pass
			// ==============================================================
			$this->users->changePassOfUserById($this->input->post('user_id_change_pass'),$this->input->post('pass') ,$_SESSION['user_id']);
			// ==============================================================
			// end get user
			// ==============================================================
			$this->session->set_flashdata('msg', '<strong>¡Exito!</strong> Contraseña Cambiada');
			redirect(base_url().'usersABM/user/'.$this->input->post('user_id_change_pass'));
		}else{
			redirect(base_url());
		}
	}

}
