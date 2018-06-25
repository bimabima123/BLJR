<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class DataStatis extends MX_Controller{
	public function __construct(){
		parent::__construct();

		if($this->session->userdata('status') != 'login'){
			redirect(base_url('index.php/Dashboard/Login'));
		}

		$this->load->model('m_data_statis');
		$this->load->helper('url');
	}

	public function index(){
		$data['title'] = 'Dashboard - Data statis';
		$data['tb_content'] = $this->m_data_statis->tampil_data()->result();
		$this->load->view('v_data_statis',$data);
	}

	public function Insert(){
		$data['title'] = 'Tambah data Konten';
		$data['menu'] = $this->m_data_statis->ambil_menu(array('induk_menu' => 0));
		$this->load->view('Tambah_data_statis',$data);
	}

	public function SaveInsert(){
		$dataCon = array(
			'id_menu' => $this->input->post('induk_menu'),
			'nama_content' => $this->input->post('judul'),
			'isi_content' => $this->input->post('isi'),
		);

		$query = $this->m_data_statis->simpan_data($dataCon);

		if ($query) {

		$aktivitas = array(
			'user' => $this->session->userdata('level_akses'),
			'aktivitas' => $this->session->userdata('level_akses').' menambahkan data statis',
			'waktu'=> date('Y-m-d-H-i-s')
		);

		$this->m_data_statis->log($aktivitas);

		$this->session->set_flashdata('message','Data Berhasil Di tambahkan');
		redirect(base_url('index.php/Dashboard/DataStatis'));

		}else{
			echo "gagal";
		}
	}

	public function Update(){
		$data['title'] = 'Edit - Konten';
		$id = $this->uri->segment(4);
		$where = array(
			'id_content' => $id
		);
		$content = $this->m_data_statis->ambil_edit($where);

		foreach ($content->result() as $h) {
			$data['id_content'] = $h->id_content;
			$data['judul'] = $h->nama_content;
			$data['isi'] = $h->isi_content;
		
		}
		
		$this->load->view('Edit_data_statis',$data);
	}

	public function SaveUpdate(){
		$where = array(
			'id_content' => $this->input->post('id_konten')
		);

		$data = array(
			'nama_content' => $this->input->post('judul'),
			'isi_content'  => $this->input->post('isi')
		);

		$query = $this->m_data_statis->simpan_edit($data,$where);

		if ($query) {

		$aktivitas = array(
			'user' => $this->session->userdata('level_akses'),
			'aktivitas' => $this->session->userdata('level_akses').' telah melakuan edit data statis',
			'waktu'=> date('Y-m-d-H-i-s')
		);

		$this->m_data_statis->log($aktivitas);

		$this->session->set_flashdata('message','Data Berhasil Di ubah');
		redirect(base_url('index.php/Dashboard/DataStatis'));

		}else{
			echo "gagal";
		}
	}

	public function Delete(){
		$id_content = $this->uri->segment(4);
		$where = array('id_content' => $id_content);
		$query = $this->m_data_statis->hapus_data($where);

		if ($query) {

		$aktivitas = array(
			'user' => $this->session->userdata('level_akses'),
			'aktivitas' => $this->session->userdata('level_akses').' menghapus data statis',
			'waktu'=> date('Y-m-d-H-i-s')
		);

		$this->m_data_statis->log($aktivitas);

		$this->session->set_flashdata('message','Data Berhasil Di hapus');
		redirect(base_url('index.php/Dashboard/DataStatis'));

		}else{
			echo "gagal";
		}
	}

}
?>