<?php

class Upload extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('formsAux');
		$this->load->model('stores');
	}

	public function index()
	{
		$this->load->view('upload_form', array('error' => ' ' ));
	}

	public function do_upload()
	{
		$filename = $this->input->post('id_stores').'_'.$this->input->post('file_name').'_'.date('Y-m-d-H-i-s');


		$config['upload_path']          = './assets/formsUploaded/';
		$config['allowed_types']        = 'gif|jpg|jpeg|png|pdf|xlsx|xls|docx|doc';
		$config['file_name']          = $filename;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error_msg', $error);
			redirect(base_url() . 'forms/formAdd/');

		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$store = $this->stores->getstore($this->input->post('id_stores'));
			$form = array(
				'state' => 'habilitado',
				'url' => $this->upload->data('file_name'),
				'file_name' => $this->input->post('file_name'),
				'date_created' => date('Y-m-d H:i:s'),
				'date_completed' => date('Y-m-d H:i:s'),
				'id_user_creator' => $this->session->userdata('user_id'),
				'id_sms' => $this->input->post('id_stores'),
				'form_type_id' => $this->input->post('id_form_type')
			);
			$this->formsAux->insertForm($store, $this->session->user_id, $form);
			$this->session->set_flashdata('success_msg', '<strong>Exito!</strong> Formulario cargado exitosamente');
			redirect(base_url() . 'forms/');
		}
	}
}
?>
