<?php

/**
 *
 */
class Stores extends CI_Model
{
	public function insertState($user = '', $state = '', $id_original_user = '', $type = '')
	{

		$history = array(
			'data' => $state,
			'id_user' => $user,
			'by_user_id' => $id_original_user,
			'type' => $type
		);
		$this->db->insert('history', $history);
	}


	public function insertStore($store = '', $id2 = '')
	{
		$this->insertState($store['company_id'], ('Tienda creada exitosamente para su compañía: ' . $store['name'] . ''), $id2, '1');
		$this->insertState($store['attendant_id'], ('Tienda creada exitosamente para su compañía: ' . $store['name'] . ''), $id2, '0');
		$this->db->insert('sms', $store);
		$id = $this->db->insert_id();
		$this->insertState($id, ('Tienda creada exitosamente: ' . $store->name . ''), $id2, '2');


	}


	public function updateStore($store = '', $id = '')
	{
		$this->load->model('users');
		$this->load->model('companies');
		$oldData = $this->getStoreById($store->id);
		$this->db->where('id', $store->id);
		$this->db->update('sms', $store);
		$text = 'Datos de la Tienda Modificados:  <ul>';
//	<!-- ============================================================== -->
//	<!-- Data check -->
//	<!-- ============================================================== -->
		if ($store->name != $oldData->name) {
			$text .= "<li><strong>Nombre anterior: </strong>" . $oldData->name . "  ---  ";
			$text .= "<strong>Nombre nuevo: </strong>" . $store->name . "</li>";
		}
		if ($store->legal_address != $oldData->legal_address) {
			$text .= "<li><strong>Dirección anterior: </strong>" . $oldData->legal_address . "  ---  ";
			$text .= "<strong>Dirección nuevo: </strong>" . $store->legal_address . "</li>";
		}
		if ($store->phone != $oldData->phone) {
			$text .= "<li><strong>Teléfono anterior: </strong>" . $oldData->phone . "  ---  ";
			$text .= "<strong>Teléfono nuevo: </strong>" . $store->phone . "</li>";
		}
		if ($store->email != $oldData->email) {
			$text .= "<li><strong>Email anterior: </strong>" . $oldData->email . "  ---  ";
			$text .= "<strong>Email nuevo: </strong>" . $store->email . "</li>";
		}

		if ($store->attendant_id != $oldData->attendant_id) {
			$userNew = $this->users->getUserById($store->attendant_id);
			$userOld = $this->users->getUserById($oldData->attendant_id);
			$text .= "<li><strong>Responsable anterior: </strong>" . $userOld->username . "  ---  ";
			$text .= "<strong>Responsable nuevo: </strong>" . $userNew->username . "</li>";
		}
		if ($store->company_id != $oldData->company_id) {
			$userNew = $this->companies->getCompanyById($store->company_id);
			$userOld = $this->companies->getCompanyById($oldData->company_id);
			$text .= "<li><strong>Compañía anterior: </strong>" . $userOld->username . "  ---  ";
			$text .= "<strong>Comapñía nueva: </strong>" . $userNew->username . "</li>";
		}

		if ($text == '') {
			$text = 'Se visualizaron los datos, pero no se modificaron o no se guardó la modificación';
		} else {
			$text .= '</ul>';
		}
		$this->insertState($store->id, ($text), $id, '2');


	}

	public function getstore($id = '')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('sms');
		$this->db->where('id', $id);

		return $this->db->get()->row_array();
	}

	public function getAllStores()
	{
		$this->db->order_by("id", "desc");
		$data = $this->db->get('sms')->result();
		return $data;
	}

	public function getAllStoresByCompanyAndByUserId($companyId = '', $userId = '')
	{
		$this->db->order_by("name", "asc");
		$this->db->where('company_id', $companyId);
		$this->db->where('attendant_id', $userId);
		$data = $this->db->get('sms')->result();
		return $data;
	}

	public function getAllStoresByUserId($userId = '')
	{
		$this->db->order_by("id", "desc");
		$this->db->where('attendant_id', $userId);
		$data = $this->db->get('sms')->result();
		return $data;
	}

	public function getAllStoresByCompany($companyId = '')
	{
		$this->db->order_by("name", "asc");
		$this->db->where('company_id', $companyId);
		$data = $this->db->get('sms')->result();
		return $data;
	}

	public function getStoreById($id = '')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('sms');
		$this->db->where('id', $id);
		$aux = $this->db->get();
		$ret = $aux->row();

		return $ret;

	}

	public function getHistoryByStoreId($id = '')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('history');
		$this->db->limit(5);
		$this->db->where('type', 2);
		$this->db->where('id_user', $id);
		$this->db->order_by('id', 'DESC');
		$ret = $this->db->get()->result();
		return $ret;
	}

	public function getFullHistoryByStoreId($id = '')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('history');
		$this->db->where('type', 2);
		$this->db->where('id_user', $id);
		$this->db->order_by('id', 'DESC');
		$ret = $this->db->get()->result();
		return $ret;
	}

	public function cists($id = '', $storeId = '')
	{
		if ($this->session->userdata('role') == 4) {
			$this->load->model('companies');
			$this->db->where('id', $storeId);
			$this->db->where('attendant_id', $id);
			$data = $this->db->get('sms')->result();


			if ($data) {
				return true;
			} else {
				return false;

			}
		} else {
			if ($this->session->userdata('role') == 5) {

				$this->db->from('company-referral');
				$this->db->where('referral_id', $id);
				$ret = $this->db->get()->result();

				if ($ret) {
					$data = array();
					foreach ($ret as $r) {
						$this->db->where('id', $storeId);
						$this->db->where('company_id', $r->company_id);
						$exo  =$this->db->get('sms')->result();
						if (sizeof($exo) != 0){
							array_push($data, $exo );
						}


					}


					if (sizeof($data) != 0) {

						return true;
					} else {
						return false;
					}
				} else {
					return false;
				}
			}


		}
	}

}


?>

