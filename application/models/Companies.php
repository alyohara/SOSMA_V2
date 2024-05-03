<?php

/**
 *
 */
class Companies extends CI_Model
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


	public function insertCompany($company = '', $id2 = '')
	{
		$this->db->insert('company', $company);
		$id = $this->db->insert_id();
		$referral_id = $company->id_referral;
		$company_id = $id;
		$nexus = array(
			'company_id' => $company_id,
			'referral_id' => $referral_id
		);
		$this->db->insert('company-referral', $nexus);

		$this->insertState($id, ('Compañía creada exitosamante: ' . $company->name . ''), $id2, '1');
	}

	public function insertCompanyReferral($company_id = '', $referral_id = '')
	{

		$nexus = array(
			'company_id' => $company_id,
			'referral_id' => $referral_id
		);
		$this->db->insert('company-referral', $nexus);
		$this->insertState($company_id, ('Referido agregado a compañìa exitosamante.'), $referral_id, '1');
	}


	public function updateCompany($company = '', $id = '')
	{

		$this->load->model('roles');
		$this->load->model('status');
		$this->load->model('users');
		$oldData = $this->getCompanyById($company->id);
		$this->db->where('id', $company->id);
		$this->db->update('company', $company);
		$text = 'Datos de la Compañía Modificados:  <ul>';
//	<!-- ============================================================== -->
//	<!-- Data check -->
//	<!-- ============================================================== -->
		if ($company->name != $oldData->name) {
			$text .= "<li><strong>Nombre anterior: </strong>" . $oldData->name . "  ---  ";
			$text .= "<strong>Nombre nuevo: </strong>" . $company->name . "</li>";
		}
		if ($company->type != $oldData->type) {
			$text .= "<li><strong>Tipo anterior: </strong>" . $oldData->type . "  ---  ";
			$text .= "<strong>Tipo nuevo: </strong>" . $company->type . "</li>";
		}
		if ($company->industry != $oldData->industry) {
			$text .= "<li><strong>Industria anterior: </strong>" . $oldData->industry . "  ---  ";
			$text .= "<strong>Industria nueva: </strong>" . $company->industry . "</li>";
		}
		if ($company->legal_address != $oldData->legal_address) {
			$text .= "<li><strong>Dirección anterior: </strong>" . $oldData->legal_address . "  ---  ";
			$text .= "<strong>Dirección nuevo: </strong>" . $company->legal_address . "</li>";
		}
		if ($company->phone != $oldData->phone) {
			$text .= "<li><strong>Teléfono anterior: </strong>" . $oldData->phone . "  ---  ";
			$text .= "<strong>Teléfono nuevo: </strong>" . $company->phone . "</li>";
		}
		if ($company->email != $oldData->email) {
			$text .= "<li><strong>Email anterior: </strong>" . $oldData->email . "  ---  ";
			$text .= "<strong>Email nuevo: </strong>" . $company->email . "</li>";
		}
		if ($company->website != $oldData->website) {
			$text .= "<li><strong>Website anterior: </strong>" . $oldData->website . "  ---  ";
			$text .= "<strong>Website nuevo: </strong>" . $company->website . "</li>";
		}

		if ($company->id_referral != $oldData->id_referral) {
			$userNew = $this->users->getUserById($company->id_referral);
			$userOld = $this->users->getUserById($oldData->id_referral);
			$text .= "<li><strong>Referido anterior: </strong>" . $userOld->username . "  ---  ";
			$text .= "<strong>Referido nuevo: </strong>" . $userNew->username . "</li>";
		}

		if ($text == '') {
			$text = 'Se visualizaron los datos, pero no se modificaron o no se guardó la modificación';
		} else {
			$text .= '</ul>';
		}
		$this->insertState($company->id, ($text), $id, '1');


	}

	public function getCompany($id = '')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('company');
		$this->db->where('id', $id);
		return $this->db->get();
	}

	public function getAllCompanies()
	{
		$this->db->order_by("id", "desc");
		$data = $this->db->get('company')->result();
		return $data;
	}

	public function getAllCompaniesByRole($role = '', $id = '')
	{

		$this->db->order_by("id", "desc");
		$data = array();
		if ($role >= 4) {
			$this->db->where('referral_id', $id);
			$dataAux = $this->db->get('company-referral')->result();
			$i = 0;
			foreach ($dataAux as $aux) {
				$this->db->where('id', $aux->company_id);
				array_push($data, $this->db->get('company')->row());
				$i++;

			}

		} else {
			$data = $this->db->get('company')->result();

		}
		return $data;
	}

	public function getAllCompaniesByIdReferral($id = '')
	{
		$this->db->order_by("id", "desc");
		$this->db->where('id_referral	', $id);
		$data = $this->db->get('company')->result();
		return $data;
	}

	public function getCompanyById($id = '')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('company');
		$this->db->where('id', $id);
		$aux = $this->db->get();
		$ret = $aux->row();

		return $ret;

	}

	public function getHistoryByCompanyId($id = '')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('history');
		$this->db->limit(5);
		$this->db->where('type', 1);
		$this->db->where('id_user', $id);
		$this->db->or_where('by_user_id', $id);

		$this->db->order_by('id', 'DESC');
		$ret = $this->db->get()->result();
		return $ret;
	}

	public function getFullHistoryByCompanyId($id = '')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('history');
		$this->db->where('type', 1);
		$this->db->where('id_user', $id);
		$this->db->or_where('by_user_id', $id);

		$this->db->order_by('id', 'DESC');
		$ret = $this->db->get()->result();
		return $ret;
	}

	public function getStoresByCompanyId($id = '')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('sms');
		$this->db->limit(5);
		$this->db->where('company_id', $id);

		$this->db->order_by('id', 'DESC');
		$ret = $this->db->get()->result();
		return $ret;
	}


	public function getAllStoresByCompanyId($id = '')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('sms');
		$this->db->where('company_id', $id);
		$this->db->order_by('id', 'DESC');
		$ret = $this->db->get()->result();
		return $ret;
	}

	public function getAllCompaniesWhereUserBelong($role = '', $id = '') /*get every company where the user is referral  (only clients at this time)
*/
	{
		$role = intval($role);

		$this->load->database();
		$data = '';

		/*$this->db->order_by("name", "asc");*/
		if ($role == 5) { // solo si es cliente
			$this->db->where('referral_id', $id);
			
			$data = $this->db->get('company-referral')->result();
			$companies = array();
			foreach ($data as $individualrow) {
				array_push($companies, $this->companies->getCompanyById($individualrow->company_id));
			}
			usort($companies, function($a, $b) {return strcmp($a->name, $b->name);});
			return $companies;
		}
		if ($role <= 2) { // solo si es admin o super admin
			$this->db->order_by('name', 'asc');

			$data = $this->db->get('company')->result();
			return $data;
		} else {
			return $data;
		}
	}


	public function cistc($id = '', $companyId = '')
	{
		if ($this->session->userdata('role') > 4) {
			$this->load->database();
			$this->db->select('*');
			$this->db->from('company-referral');
			$this->db->where('referral_id', $id);
			$this->db->where('company_id', $companyId);
			$ret = $this->db->get()->result();
			if ($ret) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}

	public function getAllCompaniesReferral()
	{
		$this->db->select('company-referral.id, company.name, users.email');
		$this->db->from('company-referral');
		$this->db->join('company', 'company.id = company-referral.company_id');
		$this->db->join('users', 'users.id = company-referral.referral_id');
		$this->db->order_by('company-referral.id', 'DESC');
		$data = $this->db->get()->result();
		return $data;
	}

	public function asocDel($id = '')
	{
		$this->db->where('id', $id);
		$this->db->delete('company-referral');
	}


	public function countAllCompaniesByRole($role = '', $id = '')
	{

		$this->db->order_by("id", "desc");
		$data = array();
		if ($role >= 4) {
			$this->db->where('referral_id', $id);
			$dataAux = $this->db->get('company-referral')->result();
			$i = 0;
			foreach ($dataAux as $aux) {
				$this->db->where('id', $aux->company_id);
				array_push($data, $this->db->get('company')->row());
				$i++;

			}

		} else {
			$data = $this->db->get('company')->result();

		}
		return sizeof($data);
	}
}

?>
