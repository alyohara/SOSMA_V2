<?php

/**
 *
 */
class Roles extends CI_Model
{

	public function insertRole($role='')
	{
		$this->db->insert('roles', $roles);
	}


	public function updateRoles($roles='', $id='')
	{
		$this->db->where('id', $id);
		$this->db->update('roles', $roles);
	}

	public function getRole($id='')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('roles');
		$this->db->where('id',$id);
		return $this->db->get()->row()->role;
	}


	public function getAllRoles()
	{
		$this->db->order_by("id", "desc");
		$data = $this->db->get('roles')->result();
		return $data;
	}
	public function getAllRolesHelper()
	{
		$this->db->order_by("id", "desc");
		$data = $this->db->get('roles')->result_array();
		return $data;
	}
	public function getRolesSelect() {
		$result = $this->db->select('id, role')->get('roles')->result_array();

        $role = array();
		$role[''] = 'Elija un rol...';
        foreach($result as $r) {
			$role[$r['id']] = $r['role'];
		}

        return $role;
    }
	public function getRolesSelectByMineRole($role) {

		$result = $this->db->select('id, role')->where('id>=', $role)->get('roles')->result_array();

		$role = array();
		$role[''] = 'Elija un rol...';
		foreach($result as $r) {
			$role[$r['id']] = $r['role'];
		}

		return $role;
	}


}


?>
