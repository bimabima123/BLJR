<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
Class Home extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('m_home');
	}

	//function untuk tampilan awal
	public function index(){
		$data['title'] = 'JDIH Pemerintahan Kota Bogor';
		$id = $this->uri->segment(4);
		$data['terbaru'] = $this->m_home->peraturan_terbaru($id);
		$data['level1'] = $this->m_home->option_peraturan_level(array('level'=>1))->result();
		$data['slide'] = $this->m_home->tampil_slide()->result();
		$data['banner'] = $this->m_home->tampil_banner()->result();
		$data['counter'] = $this->m_home->counter();
		$this->load->view('v_home',$data);
	}


	//function untuk tampilan menu kontak
	public function contact(){
		$data['title'] = 'JDIH Pemerintahan Kota Bogor';
		$data['slide'] = $this->m_home->tampil_slide()->result();
		$this->load->view('Kontak',$data);
	}

	//function untuk input data pada tampilan menu kontak
	public function insert_pesan(){
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$komentar = $this->input->post('komentar');
		$tanggal = date('y-m-d h:i:s');
			
		$data = array(
			'nama' => $nama,
			'email' => $email,
			'komentar' => $komentar,
			'tanggal_masuk' => $tanggal,
			'status' => 'delive'
		);
		
		$this->m_home->input_data($data, 'tb_kontakmasuk');
		$this->session->set_flashdata('message','Pesan berhasil dikirim');
		redirect(base_url('index.php/Home/contact'));

	}

	//function untuk tampilan menu peraturan
	public function peraturan(){
		$data['title'] = 'JDIH Pemerintahan Kota Bogor';
		$data['slide'] = $this->m_home->tampil_slide()->result();
		$data['banner'] = $this->m_home->tampil_banner()->result();
		$data['peraturan'] = $this->m_home->peraturan(array('level'=>1))->result();
		$this->load->view('Peraturan',$data);
	}

	//function untuk tampil menu dropdown
	public function profil(){
		$data['title'] = 'JDIH Pemerintahan Kota Bogor';
		$id = $this->uri->segment(4);

		if ($id == 0) {
			$data['stat'] = 'not';
			$data['slide'] = $this->m_home->tampil_slide()->result();
			$data['banner'] = $this->m_home->tampil_banner()->result();
			$this->load->view('IsiMenuDropdown',$data);
		}else{	
			$data['stat'] = 'available';
			$data['menu'] = $this->m_home->menu_dropdown($id);
			$data['slide'] = $this->m_home->tampil_slide()->result();
			$data['banner'] = $this->m_home->tampil_banner()->result();
			$this->load->view('IsiMenuDropdown',$data);
		}
		
	}

	//function untuk menampilkan data pada menu peraturan dalam list peraturan
	public function lookmore(){
		$data['title'] = 'JDIH Pemerintahan Kota Bogor';
		$data['level1'] = $this->m_home->option_peraturan_level(array('level'=>1))->result();
		$data['slide'] = $this->m_home->tampil_slide()->result();
		
		$id = $this->uri->segment(4);
		$data['list'] = $this->m_home->peraturan_ak($id);
		
		$list = $this->m_home->peraturan_ak($id);
		foreach ($list as $h) {
			$data['bentuk'] = $h->bentuk;
		}
		
		$this->load->view('TampilListPeraturan',$data);
	}

	//function untuk menampilkan katalog pada hasil pencarian peraturan
	public function katalog(){
		$data['title'] = 'JDIH Pemerintahan Kota Bogor';
		$data['level1'] = $this->m_home->option_peraturan_level(array('level'=>1))->result();
		$data['slide'] = $this->m_home->tampil_slide()->result();
		$data['banner'] = $this->m_home->tampil_banner()->result();
		
		//id untuk kembali
		$data['id_peraturan_cat'] = $this->uri->segment(4);
		
		$id = $this->uri->segment(5);
		$data['peraturan'] = $this->m_home->view_abstrak_katalog($id);
		
		$this->load->view('Katalog',$data);
	}

	//function untuk menampilkan abstrak pada hasil peraturan
	public function abstrak(){
		$data['title'] = 'JDIH Pemerintahan Kota Bogor';
		$data['level1'] = $this->m_home->option_peraturan_level(array('level'=>1))->result();
		$data['slide'] = $this->m_home->tampil_slide()->result();
		$data['banner'] = $this->m_home->tampil_banner()->result();
		
		//id untuk kembali
		$data['id_peraturan_cat'] = $this->uri->segment(4);

		$id = $this->uri->segment(5);
		$data['peraturan'] = $this->m_home->view_abstrak_katalog($id);
		
		$this->load->view('Abstrak',$data);
	}

	//function untuk menampilkan katalog pada hasil pencarian non peraturan
	public function nonkatalog(){
		$data['title'] = 'JDIH Pemerintahan Kota Bogor';
		$data['slide'] = $this->m_home->tampil_slide()->result();
		$data['banner'] = $this->m_home->tampil_banner()->result();

		$id = $this->uri->segment(4);
		$data['nonperaturan'] = $this->m_home->nonperaturan_katalog($id);
		
		$this->load->view('NonKatalog',$data);
	}

	//function untuk proses cari peraturan
	public function searching(){
		$data['title'] = 'JDIH Pemerintahan Kota Bogor';
		$data['level1'] = $this->m_home->option_peraturan_level(array('level'=>1))->result();
		$data['slide'] = $this->m_home->tampil_slide()->result();
		$data['cari'] = $this->m_home->cari_per();
		$this->load->view('HasilPencarian',$data);
	}

	//function untuk proses cari non peraturan
	public function search(){
		$data['title'] = 'JDIH Pemerintahan Kota Bogor';
		$data['level1'] = $this->m_home->option_peraturan_level(array('level'=>1))->result();
		$data['slide'] = $this->m_home->tampil_slide()->result();
		$data['carinon'] = $this->m_home->cari_nonper();
		$this->load->view('HasilNonPencarian',$data);
	}

}
	//function untuk menampilkan peraturan terbaru
	/*public function terbaru(){
		$data['title'] = 'JDIH Pemerintahan Kota Bogor';
		$data['slide'] = $this->m_home->tampil_slide()->result();
		$data['banner'] = $this->m_home->tampil_banner()->result();
		$id = $this->uri->segment(4);
		$data['pterbaru'] = $this->m_home->p_terbaru($id);
		$this->load->view('peraturanterbaru',$data);
	}*/

?>