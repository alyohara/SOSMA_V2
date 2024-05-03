<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forms extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('users');
		$this->load->model('roles');
		$this->load->model('companies');
		$this->load->model('stores');
		$this->load->model('formsAux');
		$this->load->library('ciqrcode');
		$this->load->helper('array');

	}


	public function index()
	{

		if (isset($_SESSION['user_id'])) {
			// ==============================================================
			// get all companies from user
			// ==============================================================

			$companiesIndex = $this->companies->getAllCompaniesWhereUserBelong($this->session->userdata('role'),$this->session->userdata('user_id')); //


			// ==============================================================
			// end get all companies from user
			// ==============================================================

			// ==============================================================
			// get all forms
			// ==============================================================
			$forms = $this->formsAux->getAllforms(); //

			if ($this->session->userdata('role') > 4) {
				$stores = array();

				$companiesAux = $this->companies->getAllCompaniesByIdReferral($this->session->userdata('user_id'));
				foreach ($companiesAux as $comp) {
					array_push($stores, $this->stores->getAllStoresByCompany($comp->id));
				}

			}

			// ==============================================================
			// end get all forms
			// ==============================================================

			$data = array(
				'breadCrum' => 'forms',
				'breadCrum2' => 'forms',
				'companies' => $companiesIndex,
				'forms' => $forms
			);

			$this->load->view('forms/header');
			$this->load->view('cp/body_start');
			$this->load->view('cp/topbar');
			$this->load->view('cp/leftbar', $data);
			$this->load->view('forms/indexCompanies', $data);
			$this->load->view('forms/footer');
		} else {
			redirect(base_url());
		}
	}
	public function company($id='')
	{

		if (isset($_SESSION['user_id'])) {
			// ==============================================================
			// get all stores from a company
			// ==============================================================
			$storesIndex = $this->stores->getAllStoresByCompany($id); //
			// ==============================================================
			// end get all get all stores from a company
			// ==============================================================



			$data = array(
				'breadCrum' => 'forms',
				'breadCrum2' => 'forms',
				'stores' =>$storesIndex,
				'company_id' => $id
			);

			$this->load->view('forms/header');
			$this->load->view('cp/body_start');
			$this->load->view('cp/topbar');
			$this->load->view('cp/leftbar', $data);
			$this->load->view('forms/indexStores', $data);
			$this->load->view('forms/footer');
		} else {
			redirect(base_url());
		}
	}
	public function store($id='', $company_id = '')
	{

		if (isset($_SESSION['user_id'])) {
			// ==============================================================
			// get all forms from a store
			// ==============================================================
			$formsTypesIndex = $this->formsAux->getAllFormsTypesByStore($id); //
			// ==============================================================
			// end get all forms from a store
			// ==============================================================
		
			



			$data = array(
				'breadCrum' => 'forms',
				'breadCrum2' => 'forms',
				'types' =>$formsTypesIndex,
				'indexStore' => $id,
				'company_id' => $company_id
			);

			$this->load->view('forms/header');
			$this->load->view('cp/body_start');
			$this->load->view('cp/topbar');
			$this->load->view('cp/leftbar', $data);
			$this->load->view('forms/indexFormsTypes', $data);
			$this->load->view('forms/footer');
		} else {
			redirect(base_url());
		}
	}

	public function add($company = '')
	{
		redirect(base_url() . 'forms/');
	}


	public function formAdd()
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
			// ==============================================================
			// get all form types
			// ==============================================================
			$formTypesAux = $this->formsAux->getAllFormsTypes(); //
			$formTypes = array();
			$formTypes = ['' => 'Elija Una Categoría'];
			foreach ($formTypesAux as $formType) {
					$formTypes += [$formType->id => $formType->form_name];
			}
			// ==============================================================
			// end get all form types
			// ==============================================================
			$valueAux = set_value('form_type');
			$options_form_type = $formTypes;
			$extraFormsType = array(
				'id' => 'id_form_type',
				'aria-label' => 'id_form_type',
				'class' => 'form-control form-control-lg',
				'aria-describedby' => 'basic-addon1',
				'class' => 'custom-select select3',
				'required' => ''
			);
			$id_forms_types = array(
				'name' => 'id_form_type',
				'options' => $options_form_type,
				'selected' => $valueAux,
				'extra' => $extraFormsType
			);

			$data = array(
				'breadCrum' => 'forms',
				'breadCrum2' => 'forms/formAdd',
				'stores' => $storesAux,
				'id_stores' => $id_stores,
				'form_types' => $formTypesAux,
				'id_forms_types' => $id_forms_types
			);

			$this->load->view('forms/header');
			$this->load->view('cp/body_start');
			$this->load->view('cp/topbar');
			$this->load->view('cp/leftbar', $data);
			$this->load->view('forms/formAdd', $data);
			$this->load->view('forms/footer');

		} else {
			redirect(base_url());
		}
	}


	public function formChangeState($id = '')
	{
		if (isset($_SESSION['user_id'])) {
			$this->formsAux->updateForm($id);
			$this->session->set_flashdata('success_msg', '<strong>Exito!</strong> Formulario modificado');
			redirect(base_url() . 'forms/');

		} else {
			redirect(base_url());
		}
	}
	public function forms($form_type_id = '', $id_sms = '', $id_company='')
	{

		if (isset($_SESSION['user_id'])) {

			// ==============================================================
			// get all forms
			// ==============================================================
			$forms = $this->formsAux->getAllformsEspcs($form_type_id, $id_sms); //


			// ==============================================================
			// end get all forms
			// ==============================================================

			$data = array(
				'breadCrum' => 'forms',
				'breadCrum2' => 'forms',
				'forms' => $forms,
				'id_sms' => $id_sms,
				'id_company' => $id_company,
				'form_type_id' =>$form_type_id
			);

			$this->load->view('forms/header');
			$this->load->view('cp/body_start');
			$this->load->view('cp/topbar');
			$this->load->view('cp/leftbar', $data);
			$this->load->view('forms/forms', $data);
			$this->load->view('forms/footer');
		} else {
			redirect(base_url());
		}
	}

}
