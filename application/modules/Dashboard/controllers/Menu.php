<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Menu extends MX_Controller{
	public function __construct(){
		parent::__construct();

		if($this->session->userdata('status') != 'login'){
			redirect(base_url('index.php/Dashboard/login'));
		}

		$this->load->model('m_menu');
		$this->load->helper('url');
	}

	public function index(){
		$data['title'] = "Dasboard";
		$data['menu'] = $this->m_menu->tampil_data()->result();
		$this->load->view('v_menu',$data);
	}

	public function insert(){
		$data['title'] = 'Tambah Menu';
		$where = array('induk_menu' => 'NULL');
		$data['induk'] = $this->m_menu->ambil_induk($where);
		$this->load->view('Tambah_menu',$data);
	}

	public function SaveInsert(){
		$dataMen = array(
			'induk_menu' => $this->input->post('induk_menu'),
			'menu' => $this->input->post('menu'),
			'uri' => $this->input->post('url')
		);

		$query = $this->m_menu->simpan_data($dataMen);

		if($query){
			$aktivitas = array(
				'user' => $this->session->userdata('level_akses'),
				'aktivitas' => $this->session->userdata('level_akses').' menambahkan data menu',
				'waktu'=> date('Y-m-d-H-i-s')
			);

			$this->m_menu->log($aktivitas);

			$this->session->set_flashdata('message','Data Berhasil Di tambahkan');
			redirect(base_url('index.php/Dashboard/menu'));
		}else{
			$this->session->set_flashdata('message','Gagal menambahkan data');
			redirect(base_url('index.php/Dashboard/Menu/Insert'));
		}
	}

	public function Update(){
		$data['title'] = 'Edit data menu';
		
		$id_menu = $this->uri->segment(4);
		
		$where = array(
			'id_menu' => $id_menu
		);
		
		$menu = $this->m_menu->ambil_edit($where);

		foreach($menu->result() as $h){
			$data['id_menu'] = $h->id_menu;
			$data['induk_menu'] = $h->induk_menu;
			$data['menu'] = $h->menu;
			$data['url'] = $h->uri;
		}

		$kondisi = array('induk_menu' => 'NULL');
		$data['parent'] = $this->m_menu->ambil_induk($kondisi)->result();
		$this->load->view('Edit_data_menu',$data);
	}

	public function SaveUpdate(){
		$id_menu = $this->input->post('id_menu');
		$where = array('id_menu' => $id_menu);

		$data = array(
			'induk_menu' => $this->input->post('induk_menu'),
			'menu' => $this->input->post('menu'),
			'uri' => $this->input->post('url')
		);

		$query = $this->m_menu->simpan_edit($data,$where);
		
		if($query){
			$aktivitas = array(
				'user' => $this->session->userdata('level_akses'),
				'aktivitas' => $this->session->userdata('level_akses').' mengubah data menu',
				'waktu'=> date('Y-m-d-H-i-s')
			);

			$this->m_menu->log($aktivitas);

			$this->session->set_flashdata('message','Data Berhasil Di edit');
			redirect(base_url('index.php/Dashboard/menu'));
		}else{
			$this->session->set_flashdata('message','Gagal mengubah menu');
			redirect(base_url('index.php/Dashboard/Menu/Update/'.$id_menu));
		}		
	}

	public function Delete(){
		$id_menu = $this->uri->segment(4);
		$where = array('id_menu' => $id_menu);
		$query = $this->m_menu->hapus_data($where);

		if($query){
			$aktivitas = array(
				'user' => $this->session->userdata('level_akses'),
				'aktivitas' => $this->session->userdata('level_akses').' menambahkan data menu',
				'waktu'=> date('Y-m-d-H-i-s')
			);

			$this->m_menu->log($aktivitas);

			$this->session->set_flashdata('message','Data Berhasil Di hapus');
			redirect(base_url('index.php/Dashboard/menu'));
		}else{
			$this->session->set_flashdata('message','Gagal menghapus data');
			redirect(base_url('index.php/Dashboard/Menu'));
		}
	}

}
?>