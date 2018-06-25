<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class KontakMasuk extends MX_Controller{
	public function __construct(){
		parent::__construct();

		if($this->session->userdata('status') != 'login'){
			redirect(base_url('index.php/Dashboard/login'));
		}

		$this->load->model('m_kontakmasuk');
		$this->load->helper('url');
	}

	public function index(){
		$data['title'] = "Kontak Masuk";

		$where = array('status' => 'delive');
		$dataEd = array('status' => 'read');

		$this->m_kontakmasuk->edit_status($dataEd,$where);

		$data['kontakmasuk'] = $this->m_kontakmasuk->show()->result();
		$this->load->view('v_kontakmasuk',$data);
	}

	public function Message_ajax(){
		$where = array(
			'status' => 'delive'
		);

		$data = $this->m_kontakmasuk->cek_pesan($where)->num_rows();
		echo $data;
	}

	public function DeleteMessage(){
		$query = $this->m_kontakmasuk->hapus_pesan();

		if ($query) {
			$aktivitas = array(
				'user' => $this->session->userdata('level_akses'),
				'aktivitas' => $this->session->userdata('level_akses').' menghapus seluruh pesan masuk',
				'waktu'=> date('Y-m-d-H-i-s')
			);

			$this->m_kontakmasuk->log($aktivitas);

			$this->session->set_flashdata('message','Seluruh pesan telah di hapus');
			redirect(base_url('index.php/Dashboard/KontakMasuk'));
		}else{
			echo "gagal";
		}
	}
}
?>