<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StoresABM extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('users');
		$this->load->model('roles');
		$this->load->model('companies');
		$this->load->model('stores');
	}

//=====================================================================================
	public function index()
	{

		if (isset($_SESSION['user_id'])) {

			// ==============================================================
			// get all stores
			// ==============================================================
			//$stores = $this->stores->getAllStores(); //
			//$companiesAux = $this->companies->getAllCompaniesByRole($this->session->userdata('role'), $this->session->userdata('user_id'));

			//if ($this->session->userdata('role') > 4) {
			$stores = array();

				$companiesAux = $this->companies->getAllCompaniesByRole($this->session->userdata('role'), $this->session->userdata('user_id'));
				
				foreach ($companiesAux as $comp) {
					$storesAux = $this->stores->getAllStoresByCompany($comp->id);
					foreach ($storesAux as $store){
						array_push($stores, $store) ;
					}

				}
			//}
			// ==============================================================
			// end get all stores
			// ==============================================================

			$data = array(
				'breadCrum' => 'storesABM',
				'breadCrum2' => 'storesABM',
				'stores' => $stores
			);

			$this->load->view('storesABM/header');
			$this->load->view('cp/body_start');
			$this->load->view('cp/topbar');
			$this->load->view('cp/leftbar', $data);
			$this->load->view('storesABM/body', $data);
			$this->load->view('storesABM/footer');
		} else {
			redirect(base_url());
		}
	}

	public function add($company = '')
	{
		redirect(base_url() . 'storesABM/storesAdd/');
	}


	public function storesAdd()
	{
		if (isset($_SESSION['user_id'])) {
			// ==============================================================
			// get all users
			// ==============================================================
			$users = $this->users->getAllUsersFilter('5', $_SESSION['user_id']);
			$attendants = array();
			$attendants = ['' => 'Responsable'];
			foreach ($users as $user) {
				$attendants += [$user->id => $user->username];
			}
			// ==============================================================
			// end get all users
			// ==============================================================
			// ==============================================================
			// get all companies
			// ==============================================================
			$company = $this->companies->getAllCompanies();
			$companies = array();
			$companies = ['' => 'Compañía'];
			foreach ($company as $comp) {
				$companies += [$comp->id => $comp->name];
			}
			// ==============================================================
			// end get all companies
			// ==============================================================
			// ==============================================================
			// new store form data
			// ==============================================================
			$valueAux = set_value('store_name');
			$store_name = array(
				'name' => 'store_name',
				'id' => 'store_name',
				'value' => $valueAux,
				'type' => 'text',
				'minlength' => '5',
				'maxlength' => '32',
				'aria-label' => 'Nombre de la Tienda',
				'placeholder' => 'Nombre de la Tienda',
				'class' => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'required' => ''
			);
			$valueAux = set_value('address');
			$address = array(
				'name' => 'address',
				'id' => 'address',
				'value' => $valueAux,
				'type' => 'text',
				'minlength' => '5',
				'cols' => '32',
				'rows' => '3',
				'aria-label' => 'address',
				'placeholder' => 'Dirección Legal',
				'class' => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1'
			);

			$valueAux = set_value('attendant_id');
			$options_attendant = $attendants;
			$extraAttendant = array(
				'id' => 'attendant_id',
				'aria-label' => 'attendant_id',
				'class' => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'class' => 'custom-select select3',
				'required' => ''
			);
			$attendant_id = array(
				'name' => 'attendant_id',
				'options' => $options_attendant,
				'selected' => $valueAux,
				'extra' => $extraAttendant
			);
			$valueAux = set_value('company_id');
			$options_company = $companies;
			$extracompany = array(
				'id' => 'company_id',
				'aria-label' => 'company_id',
				'class' => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'class' => 'custom-select select3',
				'required' => ''
			);
			$company_id = array(
				'name' => 'company_id',
				'options' => $options_company,
				'selected' => $valueAux,
				'extra' => $extracompany
			);


			$valueAux = set_value('phone');
			$phone = array(
				'name' => 'phone',
				'id' => 'phone',
				'value' => $valueAux,
				'type' => 'tel',
				'aria-label' => 'phone',
				'placeholder' => 'Teléfono',
				'class' => 'form-control form-control-lg phone-inputmask',
				'aria-describedby' => 'basic-addon1',
				'required' => ''
			);
			$valueAux = set_value('email');
			$email = array(
				'name' => 'email',
				'id' => 'email',
				'value' => $valueAux,
				'type' => 'email',
				'aria-label' => 'email',
				'placeholder' => 'Email',
				'class' => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'required' => ''
			);


			// ==============================================================
			// form validator
			// ==============================================================

			$this->form_validation->set_rules(
				'store_name',
				'store_name',
				'required|min_length[5]|max_length[32]|is_unique[sms.name]',
				array(
					'is_unique' => 'Ya existe una tienda con ese nombre.'
				)
			);


			// ==============================================================
			// end new user form data
			// ==============================================================
			$data = array(
				'breadCrum' => 'storesABM',
				'breadCrum2' => 'storesABM/storesAdd',
				'store_name' => $store_name,
				'address' => $address,
				'attendant_id' => $attendant_id,
				'company_id' => $company_id,
				'email' => $email,
				'phone' => $phone
			);


			if ($this->form_validation->run() == FALSE) {

				$this->load->view('storesABM/header');
				$this->load->view('cp/body_start');
				$this->load->view('cp/topbar');
				$this->load->view('cp/leftbar', $data);
				$this->load->view('storesABM/storesAdd', $data);
				$this->load->view('storesABM/footer');
			} else {
				$store = array(
					'name' => $this->input->post('store_name'),
					'address' => $this->input->post('address'),
					'attendant_id' => $this->input->post('attendant_id'),
					'company_id' => $this->input->post('company_id'),
					'phone' => $this->input->post('phone'),
					'email' => $this->input->post('email')
				);

				$this->stores->insertStore($store, $this->session->user_id);
				$this->session->set_flashdata('success_msg', '<strong>Exito!</strong> Tienda agregada exitosamente');
				redirect(base_url() . 'storesABM/storesAdd');
			}
		} else {
			redirect(base_url());
		}
	}

	public function store($id = "")
	{
		if (isset($_SESSION['user_id'])) {
			if ($this->stores->cists($_SESSION['user_id'], $id)) {
				// ==============================================================
				// get store
				// ==============================================================
				$store = $this->stores->getStoreById($id);
				// ==============================================================
				// end get store
				// ==============================================================
				// ==============================================================
				// get all users
				// ==============================================================
				$users = $this->users->getAllUsers('5');
				$attendants = array();
				$attendants = ['' => 'Responsable'];
				foreach ($users as $user) {
					$attendants += [$user->id => $user->username];
				}
				// ==============================================================
				// end get all users
				// ==============================================================
				// ==============================================================
				// get all companies
				// ==============================================================
				$cps = $this->companies->getAllCompanies();
				$companies = array();
				$companies = ['' => 'Compañía'];
				foreach ($cps as $cpa) {
					$companies += [$cpa->id => $cpa->name];
				}
				// ==============================================================
				// end get all companies
				// ==============================================================
				// get history
				// ==============================================================
				$history = $this->stores->getHistoryByStoreId($id);
				// ==============================================================
				// end get history
				// ==============================================================

				// ==============================================================
				// get attendant data
				// ==============================================================
				$attendant = $this->users->getUserById($store->attendant_id);
				// ==============================================================
				// end get attendant data
				// ==============================================================
				// ==============================================================
				// get company
				// ==============================================================
				$company = $this->companies->getCompanyById($store->company_id);
				// ==============================================================
				// end get company
				// ==============================================================

				// ==============================================================
				// store data array
				// ==============================================================


				// ==============================================================
				// get visitas
				// ==============================================================
				$this->load->model('visitasAux');
				$visitas = $this->visitasAux->getAllVisitasByStore($id);
				// ==============================================================
				// end get visitas
				// ==============================================================
				// ==============================================================
				// get forms
				// ==============================================================
				$this->load->model('formsAux');
				$this->load->model('stores');
				$formsAux = $this->formsAux->getAllFormsByStore($id);
				// ==============================================================
				// end get forms
				// ==============================================================

				$data = array(
					'breadCrum' => 'storesABM',
					'breadCrum2' => 'storesABM/storesAdd',
					'store' => $store,
					'attendant' => $attendant,
					'attendants' => $attendants,
					'companies' => $companies,
					'company' => $company,
					'history' => $history,
					'visitas'=> $visitas,
					'forms' => $formsAux
				);


				$this->load->view('storesABM/header');
				$this->load->view('cp/body_start');
				$this->load->view('cp/topbar');
				$this->load->view('cp/leftbar', $data);
				$this->load->view('storesABM/store', $data);
				$this->load->view('storesABM/footer');

			} else {
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}


	public function storeHistory($id = '')
	{
		if (isset($_SESSION['user_id'])) {
			// ==============================================================
			// get store
			// ==============================================================
			$store = $this->stores->getStoreById($id);
			// ==============================================================
			// end get store
			// ==============================================================
			// ==============================================================
			// get history
			// ==============================================================
			$history = $this->stores->getFullHistoryByStoreId($id);
			// ==============================================================
			// end get history
			// ==============================================================

			$data = array(
				'breadCrum' => 'storesABM',
				'breadCrum2' => 'storesABM',
				'store' => $store,
				'history' => $history
			);

			$this->load->view('storesABM/header');
			$this->load->view('cp/body_start');
			$this->load->view('cp/topbar');
			$this->load->view('cp/leftbar', $data);
			$this->load->view('storesABM/history', $data);
			$this->load->view('storesABM/footer');


		} else {
			redirect(base_url());

		}
	}
//	public function companyStores($id='')   /////// 	ESTO VA A SER EL LLAMADO A LOS FORMULARIOS
//	{
//		if (isset($_SESSION['user_id']))
//		{
//			// ==============================================================
//			// get company
//			// ==============================================================
//			$company=$this->companies->getCompanyById($id);
//			// ==============================================================
//			// end get company
//			// ==============================================================
//			// ==============================================================
//			// get history
//			// ==============================================================
//			$stores=$this->companies->getAllStoresByCompanyId($id);
//			// ==============================================================
//			// end get history
//			// ==============================================================
//
//
//			$data = array(
//				'breadCrum' => 'companiesABM',
//				'breadCrum2' => 'companiesABM',
//				'company' => $company,
//				'stores' => $stores
//			);
//
//			$this->load->view('companiesABM/header');
//			$this->load->view('cp/body_start');
//			$this->load->view('cp/topbar');
//			$this->load->view('cp/leftbar', $data);
//			$this->load->view('companiesABM/stores', $data);
//			$this->load->view('companiesABM/footer');
//
//
//		}else{
//			redirect(base_url());
//
//		}
//	}


	public function storeMod($id = '')
	{
		if (isset($_SESSION['user_id'])) {
			// ==============================================================
			// get store Data
			// ==============================================================
			$store = $this->stores->getStoreById($id);
			// ==============================================================
			// end get  store Data
			// ==============================================================
			// ==============================================================
			// get all users
			// ==============================================================
			$users = $this->users->getAllUsersFilter('5', $_SESSION['user_id']);
			$attendants = array();

			foreach ($users as $user) {
				$attendants += [$user->id => $user->username];
			}
			// ==============================================================
			// end get all users
			// ==============================================================
			// ==============================================================
			// get all companies
			// ==============================================================
			$cps = $this->companies->getAllCompanies();
			$companies = array();
			$companies = ['' => 'Compañía'];
			foreach ($cps as $cpa) {
				$companies += [$cpa->id => $cpa->name];
			}
			// ==============================================================
			// end get all companies
			// ==============================================================
			// ==============================================================
			// new store form data
			// ==============================================================
			$valueAux = $store->name;
			$store_name = array(
				'name' => 'store_name',
				'id' => 'store_name',
				'value' => $valueAux,
				'type' => 'text',
				'minlength' => '5',
				'maxlength' => '32',
				'aria-label' => 'Nombre de la Tienda',
				'placeholder' => 'Nombre de la Tienda',
				'class' => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'required' => ''
			);


			$valueAux = set_value('address');
			if (!$valueAux) {
				$valueAux = $store->address;
			}

			$address = array(
				'name' => 'address',
				'id' => 'address',
				'value' => $valueAux,
				'type' => 'text',
				'minlength' => '5',
				'cols' => '32',
				'rows' => '3',
				'aria-label' => 'address',
				'placeholder' => 'Dirección Legal',
				'class' => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1'
			);

			$valueAux = set_value('attendant_id');
			if (!$valueAux) {
				$valueAux = $store->attendant_id;
			}
			$options_attendants = $attendants;
			$extraAttendant = array(
				'id' => 'attendant_id',
				'aria-label' => 'attendant_id',
				'class' => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'class' => 'custom-select select3',
				'required' => ''
			);
			$attendant_id = array(
				'name' => 'attendant_id',
				'options' => $options_attendants,
				'selected' => $valueAux,
				'extra' => $extraAttendant
			);

			$valueAux = set_value('company_id');
			if (!$valueAux) {
				$valueAux = $store->company_id;
			}
			$options_companies = $companies;
			$extraCompany = array(
				'id' => 'company_id',
				'aria-label' => 'company_id',
				'class' => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'class' => 'custom-select select3',
				'required' => ''
			);
			$company_id = array(
				'name' => 'company_id',
				'options' => $options_companies,
				'selected' => $valueAux,
				'extra' => $extraCompany
			);

			$valueAux = set_value('phone');
			if (!$valueAux) {
				$valueAux = $store->phone;
			}

			$phone = array(
				'name' => 'phone',
				'id' => 'phone',
				'value' => $valueAux,
				'type' => 'tel',
				'aria-label' => 'phone',
				'placeholder' => 'Teléfono',
				'class' => 'form-control form-control-lg phone-inputmask',
				'aria-describedby' => 'basic-addon1',
				'required' => ''
			);
			$valueAux = set_value('email');
			if (!$valueAux) {
				$valueAux = $store->email;
			}

			$email = array(
				'name' => 'email',
				'id' => 'email',
				'value' => $valueAux,
				'type' => 'email',
				'aria-label' => 'email',
				'placeholder' => 'Email',
				'class' => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'required' => ''
			);


			// ==============================================================
			// form validator
			// ==============================================================

			$this->form_validation->set_rules(
				'store_name',
				'store_name',
				'required|min_length[5]|max_length[32]'
			);


			// ==============================================================
			// end new store form data
			// ==============================================================
			$data = array(
				'breadCrum' => 'storesABM',
				'breadCrum2' => 'storesABM/storesMod',
				'store_name' => $store_name,
				'address' => $address,
				'attendant_id' => $attendant_id,
				'company_id' => $company_id,
				'email' => $email,
				'phone' => $phone,
				'store' => $store
			);
			$storeAux = $store;


			if ($this->form_validation->run() == FALSE) {

				$this->load->view('storesABM/header');
				$this->load->view('cp/body_start');
				$this->load->view('cp/topbar');
				$this->load->view('cp/leftbar', $data);
				$this->load->view('storesABM/storesMod', $data);
				$this->load->view('storesABM/footer');
			} else {
				$store->name = $this->input->post('store_name');
				$store->address = $this->input->post('address');
				$store->attendant_id = $this->input->post('attendant_id');
				$store->phone = $this->input->post('phone');
				$store->email = $this->input->post('email');
				$store->company_id = $this->input->post('company_id');


				$this->stores->updateStore($store, $this->session->user_id);
				$this->session->set_flashdata('success_msg', '<strong>Exito!</strong> Tienda modificada exitosamente');
				redirect(base_url() . 'storesABM/store/' . $storeAux->id);
			}
		} else {
			redirect(base_url());
		}
	}


}

