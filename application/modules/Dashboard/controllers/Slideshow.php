<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Slideshow extends MX_Controller{
	public function __construct(){
		parent::__construct();

		if($this->session->userdata('status') != 'login'){
			redirect(base_url('index.php/Dashboard/login'));
		}

		$this->load->model('m_slideshow');
		$this->load->helper('url');
		$this->load->library('upload');
	}

	public function index(){
		$data['title'] = 'Slideshow';
		$data['tb_slideshow'] = $this->m_slideshow->tampil_data();
		$this->load->view('v_slideshow',$data);
	}

	public function Insert(){
		$data['title'] = 'Tambah Slideshow';
		$this->load->view('Tambah_slideshow',$data);
	}

	public function SaveInsert(){
			$gambar = $_FILES['gambar_slide']['name'];
			$status = $this->input->post('status');

            $ambext = explode(".",$gambar);
			$ekstensi = end($ambext);
			$nama_baru = date("YmdHis");
			$nama_file = $nama_baru.".".$ekstensi;

			$config['upload_path'] = './assets/images/slideshow/';
			$config['allowed_types']='jpeg|jpg|png|gif';
			$config['max_width'] = 1400;
			$config['max_height'] = 200;
			$config['file_name'] = $nama_file;
			
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('gambar_slide')){
				$this->session->set_flashdata('message','Masukan gambar dengan format yang benar');
				redirect(base_url('index.php/Dashboard/Slideshow/Insert'));
			}else{
				//JIKA TIDAK MEM PUBLISH SLIDE
				if(empty($status)) {
					$data = array(
						'gambar_slide' => $nama_file,
						'status'  => 'non publish'
					); 

					$query = $this->m_slideshow->tambah_data($data);
				
					if ($query) {
						$aktivitas = array(
							'user' => $this->session->userdata('level_akses'),
							'aktivitas' => $this->session->userdata('level_akses').' menambahkan data Slideshow',
							'waktu'=> date('Y-m-d-H-i-s')
						);

						$this->m_slideshow->log($aktivitas);

						$this->session->set_flashdata('message','Data Berhasil Di tambahkan');
						redirect(base_url('index.php/Dashboard/Slideshow'));
					}else{
						echo "gagal";
					}
				}else{
					$data = array(
						'gambar_slide' => $nama_file,
						'status'  => $this->input->post('status'),
					); 
					
					$query = $this->m_slideshow->tambah_data($data);
				
					if ($query) {
						$aktivitas = array(
							'user' => $this->session->userdata('level_akses'),
							'aktivitas' => $this->session->userdata('level_akses').' menambahkan data Slideshow',
							'waktu'=> date('Y-m-d-H-i-s')
						);

						$this->m_slideshow->log($aktivitas);

						$this->session->set_flashdata('message','Data Berhasil Di tambahkan');
						redirect(base_url('index.php/Dashboard/Slideshow'));
					}else{
						echo "gagal";
					}
				}
			}
	}

	public function Update(){
		$data['title'] = 'Edit Slideshow';
		$id_slide = $this->uri->segment(4);

		$where = array('id_slide' => $id_slide);
		$edit_slideshow = $this->m_slideshow->ambil_edit($where);

		foreach ($edit_slideshow->result() as $h) {
			$data['id_slide'] = $h->id_slide;
			$data['gambar_lama'] = $h->gambar_slide;
			$data['status'] = $h->status;
		}

		$this->load->view('Edit_slideshow',$data);
	} 	

	public function SaveUpdate(){
		$id_slide = $this->input->post('id_slide');
		$status = $this->input->post('status');

		$gambar = $_FILES['gambar_slide']['name'];
		$where = array('id_slide' => $id_slide);
		
		$ambext = explode(".",$gambar);
		$ekstensi = end($ambext);
		$nama_baru = date("YmdHis");
		$nama_file = $nama_baru.".".$ekstensi;

		$config['upload_path'] = './assets/images/slideshow/';
		$config['allowed_types']='jpeg|jpg|png|gif';
		$config['max_width'] = 1400;
		$config['max_height'] = 200;
		$config['file_name'] = $nama_file;

		
		$queryambil = $this->db->query("SELECT id_slide,gambar_slide FROM tb_slide WHERE id_slide = ".$id_slide)->row_array();
		
		$this->upload->initialize($config);
		//Jika tidak mengedit gambar yang sudah ada
		if (empty($gambar)) {
			//Jika Checkbox tidak dipilih alias status slideshow tidak di pulblish atau di non publiskan 
			if (empty($status)) {
				
				$data = array(
					'gambar_slide'=> $queryambil['gambar_slide'],
					'status' => 'non publish'
				);

				$query = $this->m_slideshow->simpan_edit($data,$where);
				
				if ($query) {
						$aktivitas = array(
							'user' => $this->session->userdata('level_akses'),
							'aktivitas' => $this->session->userdata('level_akses').' mengupdate data Slideshow',
							'waktu'=> date('Y-m-d-H-i-s')
						);

						$this->m_slideshow->log($aktivitas);

						$this->session->set_flashdata('message','Data Berhasil Di edit');
						redirect(base_url('index.php/Dashboard/Slideshow'));
				}else{
						echo "gagal";
				}
		
			}else{

				$data = array(
					'gambar_slide'=> $queryambil['gambar_slide'],
					'status' => $this->input->post('status')
				);

				$query = $this->m_slideshow->simpan_edit($data,$where);
				
				if ($query) {
						$aktivitas = array(
							'user' => $this->session->userdata('level_akses'),
							'aktivitas' => $this->session->userdata('level_akses').' mengupdate data Slideshow',
							'waktu'=> date('Y-m-d-H-i-s')
						);

						$this->m_slideshow->log($aktivitas);

						$this->session->set_flashdata('message','Data Berhasil Di edit');
						redirect(base_url('index.php/Dashboard/Slideshow'));
				}else{
						echo "gagal";
				}	
			}

		}else{
			if (!$this->upload->do_upload('gambar_slide')) {
			//Jika gagal melakukan upload gambar
			$this->session->set_flashdata('message','Gagal mengupload gambar, masukan gambar dengan format yang benar');
			redirect(base_url('index.php/Dashboard/Slideshow/Update/'.$id_slide));
			//Jika mengedit gambar yang sudah ada
			}else{
				//Jika Checkbox tidak dipilih alias status slideshow tidak di pulblish atau di non publiskan 
				if (empty($status)) {
					
					@unlink('./assets/images/slideshow/'.$queryambil['gambar_slide']);

					$data = array(
							'gambar_slide'=> $nama_file,
							'status' => 'non publish'
					);

					$query = $this->m_slideshow->simpan_edit($data,$where);
				
					if ($query) {
							$aktivitas = array(
								'user' => $this->session->userdata('level_akses'),
								'aktivitas' => $this->session->userdata('level_akses').' mengupdate data Slideshow',
								'waktu'=> date('Y-m-d-H-i-s')
							);

							$this->m_slideshow->log($aktivitas);

							$this->session->set_flashdata('message','Data Berhasil Di edit');
							redirect(base_url('index.php/Dashboard/Slideshow'));
					}else{
						echo "gagal";
					}
				}else{
					@unlink('./assets/images/slideshow/'.$queryambil['gambar_slide']);

					$data = array(
							'gambar_slide'=> $nama_file,
							'status' => $this->input->post('status')
					);
					
					$query = $this->m_slideshow->simpan_edit($data,$where);
					
					if ($query) {
							$aktivitas = array(
								'user' => $this->session->userdata('level_akses'),
								'aktivitas' => $this->session->userdata('level_akses').' mengupdate data Slideshow',
								'waktu'=> date('Y-m-d-H-i-s')
							);

							$this->m_slideshow->log($aktivitas);

							$this->session->set_flashdata('message','Data Berhasil Di edit');
							redirect(base_url('index.php/Dashboard/Slideshow'));
					}else{
						echo "gagal";
					}	
				}	
			}
		}

	}

	public function delete(){
		$id_slide = $this->uri->segment(4);

		$query = $this->db->query("SELECT id_slide,gambar_slide FROM tb_slide WHERE id_slide = ".$id_slide)->row_array();
		
		@unlink('./assets/images/slideshow/'.$query['gambar_slide']);


		$where = array('id_slide' => $id_slide );
		
		$query = $this->m_slideshow->hapus_data($where);

		if ($query) {
			$aktivitas = array(
				'user' => $this->session->userdata('level_akses'),
				'aktivitas' => $this->session->userdata('level_akses').' menghapus data Slideshow',
				'waktu'=> date('Y-m-d-H-i-s')
			);

			$this->m_slideshow->log($aktivitas);

			$this->session->set_flashdata('message','Data Berhasil Di hapus');
			redirect(base_url('index.php/Dashboard/Slideshow'));
		}else{
			echo "gagal";
		}
	}

}
?>