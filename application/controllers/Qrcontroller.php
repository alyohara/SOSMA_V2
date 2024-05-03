<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Qrcontroller extends CI_Controller
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

	}


	function generar_qr() {

		//hacemos configuraciones
		$params['data'] = $this->input->post('qrcode_text');
		$params['level'] = 'H';
		$params['size'] = 10;

		//decimos el directorio a guardar el codigo qr, en este
		//caso una carpeta en la raíz llamada qr_code
		$params['savename'] = FCPATH  . "assets/formsUploaded/qrs/qrA.png";
		//generamos el código qr
		$this->ciqrcode->generate($params);


		$data = array(
			'breadCrum' => 'forms',
			'breadCrum2' => 'forms',
			'qr' => "qrA.png"
		);

		$this->load->view('forms/header');
		$this->load->view('cp/body_start');
		$this->load->view('cp/topbar');
		$this->load->view('cp/leftbar', $data);
		$this->load->view('forms/qrbody', $data);
		$this->load->view('forms/footer');

	}


}
