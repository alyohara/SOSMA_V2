<?php

/**
 *
 */
class Contacts extends CI_Model
{

	public function insertState($user = '', $state = '', $id_original_user = '')
	{

		$history = array(
			'data' => $state,
			'id_user' => $user,
			'by_user_id' => $id_original_user,
		);
		$this->db->insert('history', $history);
	}

	public function chkUser($email = '', $password = '')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email', $email);
		$this->db->where('password', $password);

		if ($query = $this->db->get()) {
			$data = $query->row_array();
			if (($data['id_user_status'] != 3)||($data['id_user_status'] != 3)) { // show user only in active state

				$data = false;

			}
		} else {
			$data = false;
		}
		return $data;
	}

	public function chkAdmin($email = '', $password = '')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('admins');
		$this->db->where('email', $email);
		$this->db->where('password', $password);

		if ($query = $this->db->get()) {

			$data = $query->row_array();
			if ($data['id_user_status'] != 2) {
				$data = false;
			}
		} else {
			$data = false;
		}
		return $data;
	}

	public function chkAccess($data = '')
	{
		$this->load->helper('date');
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		$user = $this->getUserById($data);
		if ($user->first_access==NULL){
			$user->first_access = date('Y/m/d:h-m-s');
			$user->id_user_status = '3';
			$text = 'Fecha del primer ingreso al sistema del usuario';
			$this->insertState($data, ($text), $data);
		}
		$user->last_access = date('Y/m/d:H-m-s');
		$this->db->where('id', $user->id);
		$this->db->update('users', $user);
	}

	public function initSession($data = '')
	{
		$this->chkAccess($data['id']);
		//$this->session->sess_destroy();
		$this->session->set_userdata('user_id', $data['id']);
		$this->session->set_userdata('email', $data['email']);
		$this->session->set_userdata('name_first', $data['name_first']);
		$this->session->set_userdata('name_last', $data['name_last']);
		$this->session->set_userdata('role', $data['id_user_roles']);
		$this->session->set_userdata('username', $data['username']);

	}

	public function email_check($email)
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email', $email);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function double_email_check($email, $id)
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email', $email);
		$this->db->where('id !=', $id);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}


	public function email_check_admin($email)
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('admins');
		$this->db->where('email', $email);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function insertUser($user = '', $id2 = '')
	{
		$this->db->insert('users', $user);
		$id = $this->db->insert_id();
		$this->insertState($id, ('usuario creado, registrado y activo, status 3 y rol ' . $user['id_user_roles']), $id2);
	}

	public function insertAdmin($user = '')
	{
		$this->db->insert('admins', $user);
	}

	public function updateAdmin($user = '', $id = '')
	{
		$this->db->where('id', $id);
		$this->db->update('admins', $user);
	}

	public function updateUser($user = '', $id2 = '')
	{
		$this->load->model('roles');
		$this->load->model('status');
		$oldData = $this->getUserById($user['id']);
		$this->db->where('id', $user['id']);
		$this->db->update('users', $user);
		$text = 'Datos de Usuario Modificados:  <ul>';
//	<!-- ============================================================== -->
//	<!-- Data check -->
//	<!-- ============================================================== -->
		if ($user['name_title'] != $oldData->name_title){
			$text.="<li><strong>Título anterior: </strong>".$oldData->name_title."  ---  ";
			$text.="<strong>Título nuevo: </strong>".$user['name_title']."</li>";
		}
		if ($user['name_first'] != $oldData->name_first){
			$text.="<li><strong>Primer nombre anterior: </strong>".$oldData->name_first."  ---  ";
			$text.="<strong>Nuevo primer nombre: </strong>".$user['name_first']."</li>";
		}
		if ($user['name_middle'] != $oldData->name_middle){
			$text.="<li><strong>Segundo nombre anterior: </strong>".$oldData->name_middle."  ---  ";
			$text.="<strong>Nuevo segundo nombre: </strong>".$user['name_middle']."</li>";
		}
		if ($user['name_last'] != $oldData->name_last){
			$text.="<li><strong>Apellido anterior: </strong>".$oldData->name_last."  ---  ";
			$text.="<strong>Nuevo apellido: </strong>".$user['name_last']."</li>";
		}
		if ($user['email'] != $oldData->email){
			$text.="<li><strong>Email anterior: </strong>".$oldData->email."  ---  ";
			$text.="<strong>Nuevo email: </strong>".$user['email']."</li>";
		}
		if ($user['phone'] != $oldData->phone){
			$text.="<li><strong>Teléfono anterior: </strong>".$oldData->phone."  ---  ";
			$text.="<strong>Nuevo teléfono: </strong>".$user['phone']."</li>";
		}
		if ($user['id_user_roles'] != $oldData->id_user_roles){

			$rolViejo = $this->roles->getRole($oldData->id_user_roles);
			$rolNuevo = $this->roles->getRole($user['id_user_roles']);
			$text.="<li><strong>Rol anterior anterior: </strong>".$rolViejo."  ---  ";
			$text.="<strong>Nuevo rol : </strong>".$rolNuevo."</li>";
		}
		if ($user['id_user_status'] != $oldData->id_user_status){
			$statusViejo = $this->status->getStatus($oldData->id_user_status);
			$statusNuevo = $this->status->getStatus($user['id_user_status']);
			$text.="<li><strong>Status anterior anterior: </strong>".$statusViejo."  ---  ";
			$text.="<strong>Nuevo status: </strong>".$statusNuevo."</li>";

		}
		if ($text ==''){
			$text = 'Se visualizaron los datos, pero no se modificaron o no se guardó la modificación';
		}else{
			$text.='</ul>';
		}
		$this->insertState($user['id'], ($text), $id2);
	}

	public function getUser($email = '')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email', $email);
		return $this->db->get();
	}

	public function getAdmin()
	{
		$this->load->database();
		$query = $this->db->query("SELECT * FROM admins WHERE id = '" . $_SESSION['user_id'] . "'");
		return $query->row();


	}

	public function getAuthor($id = '')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('admins');
		$this->db->where('id', $id);
		return $this->db->get();
	}

	public function passwordReset($user_id = '', $check_state = '')
	{
		$this->db->query("UPDATE change_pass SET status='0' WHERE user_id ='" . $user_id . "' ");
		$cpss = array(
			'user_id' => $user_id,
			'check_state' => $check_state
		);
		$this->db->insert('change_pass', $cpss);
	}

	public function checkChange($iod = '')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('change_pass');
		$this->db->where('check_state', $iod);
		$this->db->where('status', 1);
		return $this->db->get();
	}

	public function changePassword($check_state = '', $npass = '')
	{
		$this->load->database();

		$this->db->select('*');
		$this->db->from('change_pass');
		$this->db->where('check_state', $check_state);
		$this->db->where('status', 1);

		$query = $this->db->get();
		$data = $query->row_array();

		if ($data > 0) {
			$uid = $data['user_id'];
			$id = $data['id'];
			$data = array('password' => $npass);
			$this->db->where('id', $uid);
			$this->db->update('users', $data);
			return true;
		} else {
			return false;
		}

	}

	public function getAllUsers($role = '')
	{
		switch ($role) { //status: 1:new, 2: register, 3: activated, 4: suspended, 5: deactivated, 6: deleted, 7: full
			case '1' : //superadmin
				$sql = "SELECT * FROM users WHERE (id_user_status = '1' OR id_user_status = '2' OR id_user_status = '3' OR id_user_status = '4' OR id_user_status = '5' OR id_user_status = '6')
AND(id_user_roles = '1' OR id_user_roles = '2' OR id_user_roles = '3' OR id_user_roles = '4' OR id_user_roles = '5' OR id_user_roles = '6' OR id_user_roles = '7')";
				break;
			case '2' : //admin
				$sql = "SELECT * FROM users WHERE ( id_user_status = '2' OR id_user_status = '3' OR id_user_status = '4')
AND(id_user_roles = '2' OR id_user_roles = '3' OR id_user_roles = '4' OR id_user_roles = '5' OR id_user_roles = '6')";
				break;
			case '3' : //supervisor
				$sql = "SELECT * FROM users WHERE ( id_user_status = '3')
AND(id_user_roles = '3' OR id_user_roles = '4' OR id_user_roles = '5' OR id_user_roles = '6')";
				break;
			case '4' : //tecnitian
				$sql = "SELECT * FROM users WHERE ( id_user_status = '3')
AND(id_user_roles = '4' OR id_user_roles = '5' OR id_user_roles = '6')";
				break;
			case '5' : //client
				$sql = "SELECT * FROM users WHERE ( id_user_status = '-1')";
				break;
			case '6' : //full user
				$sql = "SELECT * FROM users WHERE ( id_user_status = '-1')";
				break;
			default:
				$sql = "SELECT * FROM users WHERE ( id_user_status = '-1')";
				break;
		}
		$this->db->order_by("id", "desc");
		$data = $this->db->query($sql)->result();
		return $data;
	}

	public function pagInit()
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url() . "adminAccess";
		$config['total_rows'] = $this->db->count_all_results('users');
		$config['per_page'] = 20;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li> ';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li> ';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li> ';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li> ';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li> ';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li> ';
		$this->pagination->initialize($config);

	}

	public function getUserById($id = '')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
		$aux = $this->db->get();
		$ret = $aux->row();

		return $ret;

	}

	public function getHistoryByUserId($id = '')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('history');
		$this->db->limit(5);
		$this->db->where('id_user', $id);
		$this->db->or_where('by_user_id', $id);
		$this->db->order_by('id', 'DESC');
		$ret = $this->db->get()->result();
		return $ret;
	}


	public function getFullHistoryByUserId($id = '')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('history');
		$this->db->where('id_user', $id);
		$this->db->or_where('by_user_id', $id);
		$this->db->order_by('id', 'DESC');
		$ret = $this->db->get()->result();
		return $ret;
	}
	public function delUserById($id = '', $id2 = '')
	{	$oldData = $this->getUserById($id);
		$this->load->database();
		$this->db->select('*');
		$this->db->from('user_status');
		$this->db->where('id',$oldData->id_user_status);
		$oldStatus = $this->db->get()->row()->status;
		$this->db->set('id_user_status', '6');
		$this->db->where('id', $id);
		$this->db->update('users');
		$text = '<strong>Usuario eliminado:</strong> el estado anterior era '.$oldStatus.', el nuevo estado es 6 - Eliminado';
		$this->insertState($id, ($text), $id2);
	}
	public function actUserById($id = '', $id2 = '')
	{	$oldData = $this->getUserById($id);
		$this->load->database();
		$this->db->select('*');
		$this->db->from('user_status');
		$this->db->where('id',$oldData->id_user_status);
		$oldStatus = $this->db->get()->row()->status;
		$this->db->set('id_user_status', '3');
		$this->db->where('id', $id);
		$this->db->update('users');
		$text = '<strong>Usuario re-activado:</strong> el estado anterior era '.$oldStatus.', el nuevo estado es 3 - Activo; podrá retomar su curso normal';
		$this->insertState($id, ($text), $id2);
	}


	public function changePassOfUserById($id = '',$pass = '', $id2 = '')
	{	$oldData = $this->getUserById($id);
		$this->load->database();

		$this->db->set('password', md5($pass));
		$this->db->where('id', $id);
		$this->db->update('users');
		$text = '<strong>Cambio de contraseña</strong> del usuario a '.$pass.', se eliminó la contraseña anterior.   ';
		$this->insertState($id, ($text), $id2);
	}

}


?>
