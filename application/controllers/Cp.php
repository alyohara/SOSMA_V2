<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cp extends CI_Controller {

	public function index()
	{
		$this->load->model('users');
		$this->load->model('roles');
		$this->load->model('companies');
		$this->load->model('stores');
		$this->load->model('formsAux');
		$this->load->model('visitasAux');

		if (isset($_SESSION['user_id']))
		{


           

			// ==============================================================
			// get all forms
			// ==============================================================
			$forms = $this->formsAux->getAllforms(); //
			// ==============================================================
			// end get all forms
			// ==============================================================
			// ==============================================================
			// get  users count
			// ==============================================================
			$users = $this->users->countAllUsers($this->session->role, $_SESSION['user_id']);
			// ==============================================================
			// end users count
			// ==============================================================
            // ==============================================================
			// get  companies count
			// ==============================================================

			$companies = $this->companies->countAllCompaniesByRole($this->session->userdata('role'), $this->session->userdata('user_id')); //
			// ==============================================================
			// end companies count
			// ==============================================================

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
        // ==============================================================
			// get all visitas
			// ==============================================================
			$visitas = $this->visitasAux->getAllvisitas(); //


			// ==============================================================
			// end get all visitas
			// ==============================================================

			$data = array(
				'breadCrum'=> 'Dashboard', 
				'users' => $users, 
                'companies' => $companies,
                'stores' => sizeof($stores),
                'forms' => sizeof($forms),
                'visitas' => sizeof($visitas)
			);

			$this->load->view('cp/header');
			$this->load->view('cp/body_start');
			$this->load->view('cp/topbar');
			$this->load->view('cp/leftbar', $data);
			$this->load->view('cp/body', $data);
			$this->load->view('cp/footer');
		}else{
			redirect(base_url());

		}
	}
}
