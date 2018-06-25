<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KategoriPeraturan extends CI_Controller{
	public function __construct(){
		parent::__construct();

		if($this->session->userdata('status') != 'login'){
			redirect(base_url('index.php/Dashboard/login'));
		}

		$this->load->model('m_kategori_peraturan');
		$this->load->helper('url');
	}

	public function index(){
		$data['title'] = 'Kategori Peraturan';
		$data['tb_peraturan_cat'] = $this->m_kategori_peraturan->tampil_data()->result();
		$this->load->view('v_kategori_peraturan',$data);
	}

	public function Insert(){
		$data['title'] = 'Tambah kategori peraturan';

		$where = array(
			'id_peraturan_cat_parent' => 'null'
		);
		$data['kategori_peraturan_parent'] = $this->m_kategori_peraturan->ambil_kategori_parent($where)->result();
		$this->load->view('Tambah_kategori_peraturan',$data);
	}

	public function SaveInsert(){
		$data = array(
			'id_peraturan_cat_parent' => $this->input->post('kategori_parent'),
			'bentuk' => $this->input->post('bentuk'),
			'level' => $this->input->post('level'),
			'urutan' => $this->input->post('urutan')
		);

		$query = $this->m_kategori_peraturan->simpan_data($data);

		if ($query) {
			$aktivitas = array(
				'user' => $this->session->userdata('level_akses'),
				'aktivitas' => $this->session->userdata('level_akses').' menambahkan data kategori peraturan',
				'waktu'=> date('Y-m-d-H-i-s')
			);

			$this->m_kategori_peraturan->log($aktivitas);

			$this->session->set_flashdata('message','Data Berhasil Di tambahkan');
			redirect(base_url('index.php/Dashboard/KategoriPeraturan'));
		}else{
			echo "gagal";
		}
	}

	public function Update(){
		$data['title'] = 'Edit kategori peraturan';
		
		$id_peraturan_cat = $this->uri->segment(4);
		
		$where = array(
			'id_peraturan_cat' => $id_peraturan_cat
		);
		
		$peraturan_cat = $this->m_kategori_peraturan->ambil_edit($where)->result();
		
		foreach ($peraturan_cat as $h){
			$data['id_peraturan_cat'] = $h->id_peraturan_cat;
			$data['id_peraturan_cat_parent'] = $h->id_peraturan_cat_parent;
			$data['bentuk'] = $h->bentuk;
			$data['level'] = $h->level;
			$data['urutan'] = $h->urutan;
			$parent = array('id_peraturan_cat' => $h->id_peraturan_cat_parent);
		}
		
		$parent = array(
			'id_peraturan_cat_parent' => 'null'
		);

		$data['kategori_peraturan_parent'] = $this->m_kategori_peraturan->ambil_kategori_parent($parent)->result();
		$this->load->view('Edit_kategori_peraturan',$data);
	}

	public function SaveUpdate(){
		$id_peraturan_cat = $this->input->post('id_peraturan_cat');

		$where = array(
			'id_peraturan_cat' => $id_peraturan_cat
		);

		$data = array(
			'id_peraturan_cat_parent' => $this->input->post('kategori_parent'),
			'bentuk' => $this->input->post('bentuk'),
			'level' => $this->input->post('level'),
			'urutan' =>	$this->input->post('urutan')
		);

		$query = $this->m_kategori_peraturan->simpan_edit($data,$where);

		if ($query) {
			$aktivitas = array(
				'user' => $this->session->userdata('level_akses'),
				'aktivitas' => $this->session->userdata('level_akses').' mengubah data kategori peraturan',
				'waktu'=> date('Y-m-d-H-i-s')
			);

			$this->m_kategori_peraturan->log($aktivitas);

			$this->session->set_flashdata('message','Data Berhasil Di edit');
			redirect(base_url('index.php/Dashboard/KategoriPeraturan'));
		}else{
			echo "gagal";
		}

	}

	public function Delete(){
		$peraturan_cat = $this->uri->segment(4);

		$where = array(
			'id_peraturan_cat' => $peraturan_cat
		);

		$query = $this->m_kategori_peraturan->hapus_data($where);

		if ($query) {
			$aktivitas = array(
				'user' => $this->session->userdata('level_akses'),
				'aktivitas' => $this->session->userdata('level_akses').' menghapus data kategori peraturan',
				'waktu'=> date('Y-m-d-H-i-s')
			);

			$this->m_kategori_peraturan->log($aktivitas);

			$this->session->set_flashdata('message','Data Berhasil Di hapus');
			redirect(base_url('index.php/Dashboard/KategoriPeraturan'));
		}else{
			echo "gagal";
		}
	}
}
?>