<?php

/**
 *
 */
class FormsAux extends CI_Model
{
	public function getAllForms()
	{
		if ($this->session->userdata('role') > 4) {
			$this->db->select('*');
			$this->db->from('sms');
			$this->db->join('company', 'company.id = sms.company_id');
			$this->db->join('form', 'form.id_sms = sms.id');
			$this->db->join('form_type', 'form.form_type_id = form_type.id');
			$this->db->join('company-referral', 'company.id = company-referral.company_id');
			$this->db->where('company-referral.referral_id', $this->session->userdata('user_id'));
			$this->db->where('form.state', 'habilitado');
			$this->db->or_where('attendant_id', $this->session->userdata('user_id'));
			$this->db->where('form.state', 'habilitado');
			$query = $this->db->get();
			$data = $query->result();

			return $data;
		} else {
			$this->db->order_by("id", "desc");
			$data = $this->db->get('form')->result();
			return $data;
		}
	}
	public function getFormTypeById($id = '')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('form_type');
		$this->db->where('id', $id);

		return $this->db->get()->row_array();
	}

	public function getAllFormsByCompany($id='')
	{

			$this->db->select('*');
			$this->db->from('sms');
			$this->db->join('company', 'company.id = sms.company_id');
			$this->db->join('form', 'form.id_sms = sms.id');
			$this->db->where('company.id ', $id);
			$this->db->where('form.state', 'habilitado');

			$query = $this->db->get();
			$data = $query->result();

			return $data;

	}
	public function getAllFormsByStore($id='')
	{

		$this->db->select('*');
		$this->db->from('form');
		$this->db->where('id_sms', $id);
		$query = $this->db->get();
		$data = $query->result();


		return $data;

	}
	public function getAllFormsTypesByStore($id='')
	{
		$this->db->order_by("form_name", "asc");
		$this->db->select('*');
		$this->db->from('form');
		$this->db->where('id_sms', $id);
		$this->db->join('form_type', 'form.form_type_id = form_type.id');
		$query = $this->db->get();
		$data = $query->result();
		


		if ($data){
			foreach ($data as $value) {
				$formType[$value->form_type_id] = $this->getFormTypeById($value->form_type_id);
			}
			return $formType;
		}else {
			$formType = [];
			return $formType;
		}

		

	}
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

	public function insertForm($store = '', $id2 = '', $form = '')
	{
		$this->insertState($store['company_id'], 'Formulario <b>' . $form['file_name'] . '</b> cargado exitosamente para su compañia de la tienda: ' . $store['name'] . '', $id2, '1');
		$this->insertState($store['attendant_id'], 'Formulario <b>' . $form['file_name'] . '</b> cargado exitosamente para la tienda: ' . $store['name'] . '', $id2, '0');
		$this->insertState($store['id'], 'Formulario <b>' . $form['file_name'] . '</b> cargado exitosamente para la tienda: ' . $store->name . '', $id2, '2');
		$this->db->insert('form', $form);
		$id = $this->db->insert_id();
		$this->insertState($id, 'Formulario <b>' . $form['file_name'] . '</b>  cargado exitosamente para la tienda: ' . $store->name . '', $id2, '3');
	}

	public function getform($id = '')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('form');
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}

	public function updateForm($id = '')
	{
		$form = $this->getform($id);

		if ($form->state == 'habilitado') {
			$form->state = 'deshabilitado';
			$this->insertState($id, 'Formulario <b>' . $form->file_name . '</b>  dado de baja ', $this->session->userdata('user_id'), '3');
			$this->db->where('id', $id);
			$this->db->update('form', $form);
		} else {
			if ($form->state == 'deshabilitado') {

				$form->state = 'habilitado';
				$this->insertState($id, 'Formulario <b>' . $form->file_name . '</b>  habilitado nuevamente ', $this->session->userdata('user_id'), '3');
				$this->db->where('id', $id);
				$this->db->update('form', $form);
			}
		}
	}

	public function getAllFormsTypes()
	{

			$this->db->order_by("form_name", "asc");
			$data = $this->db->get('form_type')->result();
			return $data;

	}

	public function getAllformsEspcs($form_type_id = '', $id_sms = '')
	{
		$form_type_id = intval($form_type_id);
		$id_sms = intval($id_sms);

		$this->db->select('*');
		$this->db->from('form');
		$this->db->where('id_sms', $id_sms );
		$this->db->where('form_type_id', $form_type_id );
		$query = $this->db->get();
		$data = $query->result();
		return $data;

	}



//
//	public function getstore($id='')
//	{
//		$this->load->database();
//		$this->db->select('*');
//		$this->db->from('sms');
//		$this->db->where('id',$id);
//		return $this->db->get();
//	}
//
//	public function getAllStoresByCompanyAndByUserId($companyId='', $userId='')
//	{
//		$this->db->order_by("id", "desc");
//		$this->db->where('company_id', $companyId);
//		$this->db->where('attendant_id', $userId);
//		$data = $this->db->get('sms')->result();
//		return $data;
//	}
//	public function getAllStoresByCompany($companyId='')
//	{
//		$this->db->order_by("id", "desc");
//		$this->db->where('company_id', $companyId);
//		$data = $this->db->get('sms')->result();
//		return $data;
//	}
//
//	public function getStoreById($id = '')
//	{
//		$this->load->database();
//		$this->db->select('*');
//		$this->db->from('sms');
//		$this->db->where('id', $id);
//		$aux = $this->db->get();
//		$ret = $aux->row();
//
//		return $ret;
//
//	}
//	public function getHistoryByStoreId($id = '')
//	{
//		$this->load->database();
//		$this->db->select('*');
//		$this->db->from('history');
//		$this->db->limit(5);
//		$this->db->where('type', 2);
//		$this->db->where('id_user', $id);
//		$this->db->order_by('id', 'DESC');
//		$ret = $this->db->get()->result();
//		return $ret;
//	}
//	public function getFullHistoryByStoreId($id = '')
//	{
//		$this->load->database();
//		$this->db->select('*');
//		$this->db->from('history');
//		$this->db->where('type',2);
//		$this->db->where('id_user', $id);
//		$this->db->order_by('id', 'DESC');
//		$ret = $this->db->get()->result();
//		return $ret;
//	}


}


?>

