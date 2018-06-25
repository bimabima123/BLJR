<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class DataAdmin extends MX_Controller{
	public function __construct(){
		parent::__construct();

		if($this->session->userdata('status') != 'login'){
			redirect(base_url('index.php/Dashboard/login'));
		}

		$this->load->model('m_data_admin');
		$this->load->helper('url');
	}

	public function index(){
		$data['title'] = "Data Admin";
		$data['dataadmin'] = $this->m_data_admin->tampil_data()->result();
		$this->load->view('v_data_admin',$data);
	}

	public function Insert(){
		$data['title'] = 'Tambah Data Admin';
		$this->load->view('Tambah_data_admin',$data);
	}

	public function SaveInsert(){
		$DataAdmin = array(
			'username' => $this->input->post('username'),
			'password' => sha1($this->input->post('password')),
			'level' => $this->input->post('level')
		);

		$query = $this->m_data_admin->simpan_data($DataAdmin);

		if ($query) {
			$aktivitas = array(
				'user' => $this->session->userdata('level_akses'),
				'aktivitas' => $this->session->userdata('level_akses').' menambahkan data admin',
				'waktu'=> date('Y-m-d-H-i-s')
			);

			$this->m_data_admin->log($aktivitas);

			$this->session->set_flashdata('message','Data Berhasil Di tambahkan');
			redirect(base_url('index.php/Dashboard/DataAdmin'));
		}else{
			$this->session->set_flashdata('message','Data gagal di input');
			redirect(base_url('index.php/Dashboard/DataAdmin/Insert'));
		}
	}

	public function Update(){
		$data['title'] = 'Edit data admin';
		
		$id_admin = $this->uri->segment(4);
		
		$where = array(
			'id_admin' => $id_admin
		);
		
		$dataadmin = $this->m_data_admin->ambil_edit($where);

		foreach($dataadmin->result() as $h){
			$data['id_admin'] = $h->id_admin;
			$data['username'] = $h->username;
			$data['level_akses'] = $h->level;
		}

		$data['option_level'] = array('admin','operator');

		$this->load->view('Edit_data_admin',$data);
	}

	public function SaveUpdate(){
		$id_admin = $this->input->post('id_admin');
		$where = array('id_admin' => $id_admin);

		if ($this->input->post('password') == '') {
			$query = $this->db->query('SELECT password FROM tb_admin WHERE id_admin = '.$id_admin)->row_array();

			$data = array(
				'username' => $this->input->post('username'),
				'password' => $query['password'],
				'level' => $this->input->post('level')
			);

			$cekupdate = $this->m_data_admin->simpan_edit($data,$where);

			if ($cekupdate) {
			 	$aktivitas = array(
					'user' => $this->session->userdata('level_akses'),
					'aktivitas' => $this->session->userdata('level_akses').' mengedit data admin',
					'waktu'=> date('Y-m-d-H-i-s')
				);

				$this->m_data_admin->log($aktivitas);

				$this->session->set_flashdata('message','Data Berhasil Di edit');
				redirect(base_url('index.php/Dashboard/DataAdmin'));
			 } 
		}else{
			$data = array(
				'username' => $this->input->post('username'),
				'password' => sha1($this->input->post('password')),
				'level' => $this->input->post('level')
			);

			$cekupdate = $this->m_data_admin->simpan_edit($data,$where);

			if ($cekupdate) {
			 	$aktivitas = array(
					'user' => $this->session->userdata('level_akses'),
					'aktivitas' => $this->session->userdata('level_akses').' mengedit data admin',
					'waktu'=> date('Y-m-d-H-i-s')
				);

				$this->m_data_admin->log($aktivitas);

				$this->session->set_flashdata('message','Data Berhasil Di edit');
				redirect(base_url('index.php/Dashboard/DataAdmin'));
			 } 

		}

	}

	public function Delete(){
		$id_admin = $this->uri->segment(4);
		$where = array('id_admin' => $id_admin);

		$query = $this->m_data_admin->hapus_data($where);

		if($query){
			$aktivitas = array(
				'user' => $this->session->userdata('level_akses'),
				'aktivitas' => $this->session->userdata('level_akses').' menghapus data admin',
				'waktu'=> date('Y-m-d-H-i-s')
			);

			$this->m_data_admin->log($aktivitas);

			$this->session->set_flashdata('message','Data Berhasil Di hapus');
			redirect(base_url('index.php/Dashboard/DataAdmin'));	
		}else{
			echo "gagal";
		}
	}

}
?>