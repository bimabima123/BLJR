<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class banner extends MX_Controller{
	public function __construct(){
		parent::__construct();

		if($this->session->userdata('status') != 'login'){
			redirect(base_url('index.php/Dashboard/login'));
		}

		$this->load->model('m_banner');
		$this->load->helper('url');
		$this->load->library('upload');
	}

	public function index(){
		$data['title'] = 'banner';
		$data['tb_banner'] = $this->m_banner->tampil_data();
		$this->load->view('v_banner',$data);
	}

	public function Insert(){
		$data['title'] = 'Tambah banner';
		$this->load->view('Tambah_banner',$data);
	}

	public function SaveInsert(){
			$gambar = $_FILES['gambar_banner']['name'];
			$status = $this->input->post('status');

            $ambext = explode(".",$gambar);
			$ekstensi = end($ambext);
			$nama_baru = date('YmdHis');
			$nama_file = $nama_baru.".".$ekstensi;
			
			$config['upload_path'] = './assets/images/banner/';
			$config['allowed_types']='jpeg|jpg|png|gif|';
			$contig['max_width'] = 1365;
			$config['max_height'] = 343;
			$config['file_name'] = $nama_file;


			$this->upload->initialize($config);
			if(!$this->upload->do_upload('gambar_banner')){
				$this->session->set_flashdata('message','Masukan gambar dengan format yang benar');
				redirect(base_url('index.php/Dashboard/Banner/Insert'));
			}else{
				if (empty($status)) {
					
					$data = array(
						'gambar_banner' => $nama_file,
						'url' => $this->input->post('url'),
						'status' => 'non publish'
					);
					$query = $this->m_banner->tambah_data($data);
				
					if ($query) {
						$aktivitas = array(
							'user' => $this->session->userdata('level_akses'),
							'aktivitas' => $this->session->userdata('level_akses').' menambahkan data banner',
							'waktu'=> date('Y-m-d-H-i-s')
						);

						$this->m_banner->log($aktivitas);

						$this->session->set_flashdata('message','Data Berhasil Di tambahkan');
						redirect(base_url('index.php/Dashboard/Banner'));
					}else{
						echo "gagal";
					}

				}else{
					
					$data = array(
						'gambar_banner' => $nama_file,
						'url' => $this->input->post('url'),
						'status' => $this->input->post('status')
					);

					$query = $this->m_banner->tambah_data($data);
				
					if ($query) {
						$aktivitas = array(
							'user' => $this->session->userdata('level_akses'),
							'aktivitas' => $this->session->userdata('level_akses').' menambahkan data banner',
							'waktu'=> date('Y-m-d-H-i-s')
						);

						$this->m_banner->log($aktivitas);

						$this->session->set_flashdata('message','Data Berhasil Di tambahkan');
						redirect(base_url('index.php/Dashboard/Banner'));
					}else{
						echo "gagal";
					}
				
				}	
			}
	}

	public function Update(){
		$data['title'] = 'Edit banner';
		$id_banner = $this->uri->segment(4);

		$where = array('id_banner' => $id_banner);
		$edit_banner = $this->m_banner->ambil_edit($where);

		foreach ($edit_banner->result() as $h) {
			$data['id_banner'] = $h->id_banner;
			$data['gambar_lama'] = $h->gambar_banner;
			$data['url'] = $h->url;
			$data['status'] = $h->status;
		}

		$this->load->view('Edit_banner',$data);
	} 	

	public function SaveUpdate(){
		$id_banner = $this->input->post('id_banner');
		$status = $this->input->post('status');

		$gambar = $_FILES['gambar_banner']['name'];
		$where = array('id_banner' => $id_banner);

        $ambext = explode(".",$gambar);
		$ekstensi = end($ambext);
		$nama_baru = date('YmdHis');
		$nama_file = $nama_baru.".".$ekstensi;
		
		$config['upload_path'] = './assets/images/banner/';
		$config['allowed_types']='jpeg|jpg|png|gif';
		$contig['max_width'] = 1365;
		$config['max_height'] = 343;
		$config['file_name'] = $nama_file;
		
		$queryambil = $this->db->query("SELECT id_banner,gambar_banner FROM tb_banner WHERE id_banner = ".$id_banner)->row_array();

		$this->upload->initialize($config);
		if (empty($gambar)) {
			
			if (empty($status)) {
				
				$data = array(
					'gambar_banner'=> $queryambil['gambar_banner'],
					'url' => $this->input->post('url'),
					'status' => 'non publish'
				);

				$query = $this->m_banner->simpan_edit($data,$where);
				
				if ($query) {
					$aktivitas = array(
						'user' => $this->session->userdata('level_akses'),
						'aktivitas' => $this->session->userdata('level_akses').' mengupdate data banner',
						'waktu'=> date('Y-m-d-H-i-s')
					);

					$this->m_banner->log($aktivitas);

					$this->session->set_flashdata('message','Data Berhasil Di edit');
					redirect(base_url('index.php/Dashboard/banner'));
				}else{
					echo "gagal";
				}

			}else{
				
				$data = array(
					'gambar_banner'=> $queryambil['gambar_banner'],
					'url' => $this->input->post('url'),
					'status' => $this->input->post('status')
				);

				$query = $this->m_banner->simpan_edit($data,$where);
				
				if ($query) {
					$aktivitas = array(
						'user' => $this->session->userdata('level_akses'),
						'aktivitas' => $this->session->userdata('level_akses').' mengupdate data banner',
						'waktu'=> date('Y-m-d-H-i-s')
					);

					$this->m_banner->log($aktivitas);

					$this->session->set_flashdata('message','Data Berhasil Di edit');
					redirect(base_url('index.php/Dashboard/banner'));
				}else{
					echo "gagal";
				}

			}

		}else{
			if (!$this->upload->do_upload('gambar_banner')) {
				$this->session->set_flashdata('message','Gagal mengupload foto');
				redirect(base_url('index.php/Dashboard/Banner/Update/'.$id_banner));
			}else{

				if (empty($status)){
					@unlink('./assets/images/banner/'.$queryambil['gambar_banner']);
				
					$data = array(
							'gambar_banner'=> $nama_file,
							'url' => $this->input->post('url'),
							'status' => 'non publish'
					);
				
					$query = $this->m_banner->simpan_edit($data,$where);
					
					if ($query) {
							$aktivitas = array(
								'user' => $this->session->userdata('level_akses'),
								'aktivitas' => $this->session->userdata('level_akses').' mengupdate data banner',
								'waktu'=> date('Y-m-d-H-i-s')
							);

							$this->m_banner->log($aktivitas);

							$this->session->set_flashdata('message','Data Berhasil Di edit');
							redirect(base_url('index.php/Dashboard/banner'));
					}else{
						echo "gagal";
					}

				}else{
					@unlink('./assets/images/banner/'.$queryambil['gambar_banner']);
				
					$data = array(
							'gambar_banner'=> $nama_file,
							'url' => $this->input->post('url'),
							'status' => $this->input->post('status')
					);
				
					$query = $this->m_banner->simpan_edit($data,$where);
					
					if ($query) {
							$aktivitas = array(
								'user' => $this->session->userdata('level_akses'),
								'aktivitas' => $this->session->userdata('level_akses').' mengupdate data banner',
								'waktu'=> date('Y-m-d-H-i-s')
							);

							$this->m_banner->log($aktivitas);

							$this->session->set_flashdata('message','Data Berhasil Di edit');
							redirect(base_url('index.php/Dashboard/banner'));
					}else{
						echo "gagal";
					}

				}
			}
		}

	}

	public function delete(){
		$id_banner = $this->uri->segment(4);

		$query = $this->db->query("SELECT id_banner,gambar_banner FROM tb_banner WHERE id_banner = ".$id_banner)->row_array();
		
		@unlink('./assets/images/banner/'.$query['gambar_banner']);

		$where = array('id_banner' => $id_banner );
		
		$query = $this->m_banner->hapus_data($where);

		if ($query) {
			$aktivitas = array(
				'user' => $this->session->userdata('level_akses'),
				'aktivitas' => $this->session->userdata('level_akses').' menghapus data banner',
				'waktu'=> date('Y-m-d-H-i-s')
			);

			$this->m_banner->log($aktivitas);

			$this->session->set_flashdata('message','Data Berhasil Di hapus');
			redirect(base_url('index.php/Dashboard/banner'));
		}else{
			echo "gagal";
		}
	}

}
?>