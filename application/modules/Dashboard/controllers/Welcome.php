<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Welcome extends MX_Controller{
	public function __construct(){
		parent::__construct();

		if($this->session->userdata('status') != 'login'){
			redirect(base_url('index.php/Dashboard/login'));
		}

		$this->load->model('m_welcome');
		$this->load->helper('url');
	}

	public function index(){
		$data['title'] = "Dasboard";
		$data['log'] = $this->m_welcome->show()->result();
		$this->load->view('v_welcome',$data);
	}

	public function DeleteHistory(){
		$query = $this->m_welcome->hapus_riwayat();

		if ($query) {
			$this->session->set_flashdata('message','Seluruh riwayat telah di hapus');
			redirect(base_url('index.php/Dashboard/welcome'));
		}
	}
}
?>