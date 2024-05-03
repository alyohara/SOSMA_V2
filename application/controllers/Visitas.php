<?php
defined('BASEPATH') or exit('No direct script access allowed');

class visitas extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('users');
		$this->load->model('roles');
		$this->load->model('companies');
		$this->load->model('stores');
		$this->load->model('formsAux');
		$this->load->model('visitasAux');


	}


	public function index()
	{

		if (isset($_SESSION['user_id'])) {

			// ==============================================================
			// get all visitas
			// ==============================================================
			$visitas = $this->visitasAux->getAllvisitas(); //


			// ==============================================================
			// end get all visitas
			// ==============================================================

			$data = array(
				'breadCrum' => 'visitas',
				'breadCrum2' => 'visitas',
				'visitas' => $visitas
			);

			$this->load->view('visitas/header');
			$this->load->view('cp/body_start');
			$this->load->view('cp/topbar');
			$this->load->view('cp/leftbar', $data);
			$this->load->view('visitas/body', $data);
			$this->load->view('visitas/footer');
		} else {
			redirect(base_url());
		}
	}


	public function visitasAdd()
	{
		if (isset($_SESSION['user_id'])) {
			// ==============================================================
			// get all stores
			// ==============================================================
			$storesAux = $this->stores->getAllStores(); //
			$stores = array();
			$stores = ['' => 'Elija Una Tienda'];
			foreach ($storesAux as $store) {
				$stores += [$store->id => $store->name];
			}
			// ==============================================================
			// end get all stores
			// ==============================================================
			// ==============================================================
			// get all users
			// ==============================================================
			$usersAux = $this->users->getAllUsersListExec(); //

			$users = array();
			$users = ['' => 'Elija Un Usuario Ejecutor'];
			foreach ($usersAux as $user) {
				$users += [$user->id => $user->username];
			}
			// ==============================================================
			// end get all users
			// ==============================================================
			$valueAux = set_value('stores');
			$options_stores = $stores;
			$extraStores = array(
				'id' => 'id_stores',
				'aria-label' => 'id_stores',
				'class' => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'class' => 'custom-select select3',
				'required' => ''
			);
			$id_stores = array(
				'name' => 'id_stores',
				'options' => $options_stores,
				'selected' => $valueAux,
				'extra' => $extraStores
			);

			$valueAux = set_value('users');
			$options_users = $users;
			$extraUsers = array(
				'id' => 'id_user',
				'aria-label' => 'id_user',
				'class' => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'class' => 'custom-select select3',
				'required' => ''
			);
			$id_user = array(
				'name' => 'id_user',
				'options' => $options_users,
				'selected' => $valueAux,
				'extra' => $extraUsers
			);


			$data = array(
				'breadCrum' => 'forms',
				'breadCrum2' => 'forms/formAdd',
				'stores' => $storesAux,
				'id_stores' => $id_stores,
				'id_user' => $id_user
			);

			$this->load->view('visitas/header');
			$this->load->view('cp/body_start');
			$this->load->view('cp/topbar');
			$this->load->view('cp/leftbar', $data);
			$this->load->view('visitas/visitasAdd', $data);
			$this->load->view('visitas/footer');

		} else {
			redirect(base_url());
		}
	}


	public function visitasAddVisit()
	{
		$store = $this->stores->getStoreById($this->input->post('id_stores'));
		$company = $this->companies->getCompanyById($store->company_id);
		$dateScheduled = date("Y-m-d", strtotime($this->input->post('date_scheduled')));

		$visita = array(
			'state' => 'Asignación de Visita',
			'id_sms' => $this->input->post('id_stores'),
			'id_user_creator' => $this->session->userdata('user_id'),
			'id_user_executor' => $this->input->post('id_user'),
			'id_attendant' => $store->attendant_id,
			'id_company' => $store->company_id,
			'id_referral' => $company->id_referral,
			'date_created' => date('Y-m-d H:i:s'),
			'date_scheduled' => $dateScheduled,
			'date_last_move' => date('Y-m-d H:i:s'),
			'date_finished' => '',
			'percentage' => 10
		);

		$this->visitasAux->insertVisit($visita, $this->session->user_id);
		$this->session->set_flashdata('success_msg', '<strong>Exito!</strong> Visita Agendada exitosamente');
		redirect(base_url() . 'visitas/');

	}


	public function visitChangeState($id = '', $op = '')
	{
		if (isset($_SESSION['user_id'])) {
			if ($this->session->userdata('role') < 4) {
				$this->visitasAux->updateVisit($id, $op);
				$this->session->set_flashdata('success_msg', '<strong>Exito!</strong> Visita Modificada');
				redirect(base_url() . 'visitas/');
			}
//			$this->formsAux->updateForm($id);
//			$this->session->set_flashdata('success_msg', '<strong>Exito!</strong> Formulario modificado');
//			redirect(base_url() . 'forms/');
//
			else {
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}


}
