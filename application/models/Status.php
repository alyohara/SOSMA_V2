<?php

/**
 *
 */
class Status extends CI_Model
{

	public function insertStatus($status='')
	{
		$this->db->insert('user_status', $status);
	}


	public function updateRoles($status='', $id='')
	{
		$this->db->where('id', $id);
		$this->db->update('user_status', $status);
	}

	public function getStatus($id='')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('user_status');
		$this->db->where('id',$id);
		return $this->db->get()->row()->status;
	}


	public function getAllStatus()
	{
		$this->db->order_by("id", "desc");
		$data = $this->db->get('user_status')->result();
		return $data;
	}
	public function getAllStatusHelper()
	{
		$this->db->order_by("id", "desc");
		$data = $this->db->get('user_status')->result_array();
		return $data;
	}
	public function getStatusSelect() {
		$result = $this->db->select('id, status')->get('user_status')->result_array();

		$status = array();
		$status[''] = 'Elija un status...';
		foreach($result as $r) {
			$status[$r['id']] = $r['status'];
		}

		return $status;
	}

}


?>
