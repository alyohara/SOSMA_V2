<?php

/**
 *Los estados de las visitas son 10
 * 1 Asiganción de Visita
 * 2 En Programación
 * 3 Visita Programada
 * 4 En Viaje
 * 5 En Curso
 * 6 Visita Realizada
 * 7 Confección de informes
 * 8 Corrección de Informes
 * 9 Informes Listos
 * 10 Informes Cargados
 */
class visitasAux extends CI_Model
{
	public function getAllVisitas()
	{
		if ($this->session->userdata('role') > 4) {
			$this->db->select('*');
			$this->db->from('visit');
			$this->db->join('company-referral', 'visit.id_company = company-referral.company_id');
			$this->db->order_by("percentage", "asc");
			$this->db->where('id_attendant', $this->session->userdata('user_id'));
			$this->db->or_where('company-referral.referral_id', $this->session->userdata('user_id'));
			$query = $this->db->get();
			$data = $query->result();

			return $data;
		} else {
			$this->db->order_by("percentage", "asc");
			$data = $this->db->get('visit')->result();
			return $data;
		}
	}
	public function getAllVisitasById($id='')
	{
		if ($this->session->userdata('role') > 4) {
			$this->db->select('*');
			$this->db->from('visit');
			$this->db->order_by("percentage", "asc");
			$this->db->where('id_attendant', $id);
			$this->db->or_where('id_referral', $id);
			$query = $this->db->get();
			$data = $query->result();

			return $data;
		} else {
			$this->db->order_by("percentage", "asc");
			$data = $this->db->get('visit')->result();
			return $data;
		}
	}
	public function getAllVisitasByCompany($id='')
	{

			$this->db->select('*');
			$this->db->from('visit');
			$this->db->order_by("percentage", "asc");
			$this->db->where('id_company', $id);
			$query = $this->db->get();
			$data = $query->result();
			return $data;

	}
	public function getAllVisitasByStore($id='')
	{

		$this->db->select('*');
		$this->db->from('visit');
		$this->db->order_by("percentage", "asc");
		$this->db->where('id_sms', $id);
		$query = $this->db->get();
		$data = $query->result();
		return $data;

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

	public function insertVisit($visit = '', $id2 = '')
	{
		$this->load->model('stores');
		$this->insertState($visit['id_company'], 'Visita para <b>' . $this->stores->getStoreById($visit['id_sms'])->name . '</b> programada exitosamente para su compañia', $id2, '1');
		$this->insertState($visit['id_attendant'], 'Visita para <b>' . $this->stores->getStoreById($visit['id_sms'])->name . '</b> programada exitosamente', $id2, '0');
		$this->insertState($visit['id_sms'], 'Visita para <b>' . $this->stores->getStoreById($visit['id_sms'])->name . '</b> programada exitosamente', $id2, '2');
		$this->db->insert('visit', $visit);
		$id = $this->db->insert_id();
		$this->insertState($id, 'Visita para <b>' . $this->stores->getStoreById($visit['id_sms'])->name . '</b>  programada exitosamente para el ' . $visit['date_scheduled'], $id2, '4');
	}

	public function getVisit($id = '')
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('visit');
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}

	public function updateVisit($id = '', $op = '')
	{
		$visit = $this->getVisit($id);
		if ($op == 'next') {
			if ($visit->percentage == 100) {
			} else {
				$visit->percentage = $visit->percentage + 10;
			}
		}else{
			if ($op == 'prev'){
				if ($visit->percentage == 10) {
				} else {
					$visit->percentage = $visit->percentage - 10;
				}
			}
			if ($op == 'del'){
					$visit->percentage = 0;
			}else{
				if ($op == 'act'){
					$visit->percentage = 10;
				}
			}

		}
		switch ($visit->percentage) {
			case 0:
				$visit->state = 'Visita Cancelada';
				break;
			case 10:
				$visit->state = 'Asiganción de Visita';
				break;
			case 20:
				$visit->state = 'En Programación';
				break;
			case 30:
				$visit->state = 'Visita Programada';
				break;
			case 40:
				$visit->state = 'En Viaje';
				break;
			case 50:
				$visit->state = 'Visita En Curso';
				break;
			case 60:
				$visit->state = 'Visita Realizada';
				break;
			case 70:
				$visit->state = 'Confección de informes';
				break;
			case 80:
				$visit->state = 'Corrección de Informes';
				break;
			case 90:
				$visit->state = 'Informes Listos';
				break;
			case 100:
				$visit->state = 'Informes Cargados';
				break;

			default:
				break;
		}

		$this->insertState($id, 'Visita Actualizada ', $this->session->userdata('user_id'), '4');
		$this->db->where('id', $id);
		$this->db->update('visit', $visit);


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

