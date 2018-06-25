<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class NonPeraturan extends MX_Controller{
	public function __construct(){
		parent::__construct();

		if($this->session->userdata('status') != 'login'){
			redirect(base_url('index.php/Dashboard/login'));
		}

		$this->load->model('m_nonperaturan');
		$this->load->helper('url');
		$this->load->library('upload');
	}

	public function index(){
		$data['title'] = 'Manajemen non praturan';
		$data['tb_nonperaturan'] = $this->m_nonperaturan->tampil_data()->result();
		$this->load->view('v_nonperaturan',$data);
	}

	public function Insert(){
		$data['title'] = 'Tambah data';
		$this->load->view('Tambah_nonperaturan',$data);
	}

	public function SaveInsert(){
	//Mengupload gambar atau thumbnail
	$thumb = $_FILES['thubnail']['name'];
	
	$ambext = explode(".",$thumb);
	$eksetensi = end($ambext);
	$nama_baru = date('YmdHis');
	$nama_file_thumb = $nama_baru.".".$eksetensi;

	$config['upload_path'] = './assets/images/nonperaturan/';
	$config['allowed_types'] = 'JPG|jpeg|jpg|png';
	$config['max_size'] = 10000;
	$config['file_name'] = $nama_file_thumb;


	$this->upload->initialize($config);
	if (!$this->upload->do_upload('thubnail')) {
	 	$this->session->set_flashdata('message','Masukan gambar atau thumbnail dengan fromat yang benar');
		redirect(base_url('index.php/Dashboard/NonPeraturan/Insert'));
	}else{
	 	//Mengupload File pdf atau word ketika berhasil mengupload gambar atau thumbnail
	 	unset($congfig);
		$file = $_FILES['file']['name'];
		
		$ambext = explode(".",$file);
		$eksetensi = end($ambext);
		$nama_baru = date('YmdHis');
		$nama_file = $nama_baru.".".$eksetensi;
		
		$config['upload_path'] = './assets/file/nonperaturan/';
		$config['allowed_types'] = 'pdf|doc|docx';
		$config['file_name'] = $nama_file;

		$this->upload->initialize($config);
		if (!$this->upload->do_upload('file')) {
			//Menghapus gambar yang sudah di upload ketika gagal mengupload file pdf atau word.
			@unlink('./assets/images/nonperaturan/'.$nama_file_thumb);
			$this->session->set_flashdata('message','Masukan atau upload file dengan fromat yang benar');
			redirect(base_url('index.php/Dashboard/NonPeraturan/Insert'));
		}else{
				$dataPer = array(
					'judul' => $this->input->post('judul'),
					'file'  => $nama_file,
					'thumb'  => $nama_file_thumb,
					'add_by' => $this->session->userdata('level_akses'),
					'count' => 0,
					'tgl_posting' => date('Y-m-d'),
					'col_number_katalog' => $this->input->post('col_number'),
					'pengarang_katalog'  => $this->input->post('pengarang_buku'),
					'judul_katalog'  => $this->input->post('judul_buku'),
					'kota_katalog'  => $this->input->post('kota_terbit'),
					'penerbit_katalog'  => $this->input->post('penerbit_buku'),
					'tahun_katalog'  => $this->input->post('tahun_terbit'),
					'jilid_katalog'  => $this->input->post('jilid_buku'),
					'jumlah_katalog'  => $this->input->post('jumlah_halaman'),
					'tebal_katalog'  => $this->input->post('tebal_buku'),
					'subjek_pengarang_katalog'  => $this->input->post('subjek'),
					'no_induk_katalog'  => $this->input->post('no_induk'),
					'status_katalog'  => $this->input->post('status')
				);

				$query = $this->m_nonperaturan->tambah_data('tb_nonperaturan',$dataPer);

				if ($query) {
					$aktivitas = array(
						'user' => $this->session->userdata('level_akses'),
						'aktivitas' => $this->session->userdata('level_akses').' menambahkan data non peraturan',
						'waktu'=> date('Y-m-d-H-i-s')
					);

					$this->m_nonperaturan->log($aktivitas);

					$this->session->set_flashdata('message','Data Berhasil Di tambahkan');
					redirect(base_url('index.php/Dashboard/NonPeraturan'));
				}else{
					echo "gagal";
				}
			}
		}
	}

	public function Update(){
		$data['title'] = 'Edit non peraturan';
		$id_nonperaturan = $this->uri->segment(4);

		$where = array(
			'id_nonperaturan' => $id_nonperaturan
		);

		$non_peraturan = $this->m_nonperaturan->ambil_edit($where);

		foreach ($non_peraturan->result() as $h){
			$data['id_nonperaturan'] = $h->id_nonperaturan;
			$data['judul'] = $h->judul;
			$data['col_number_katalog'] = $h->col_number_katalog; 
			$data['file'] = $h->file; 
			$data['thumb'] = $h->thumb; 
			$data['pengarang_katalog'] = $h->pengarang_katalog;
			$data['judul_katalog'] = $h->judul_katalog;
			$data['kota_katalog'] = $h->kota_katalog;
			$data['penerbit_katalog'] = $h->penerbit_katalog;
			$data['tahun_katalog'] = $h->tahun_katalog;
			$data['jilid_katalog'] = $h->jilid_katalog;
			$data['jumlah_katalog'] = $h->jumlah_katalog;
			$data['tebal_katalog'] = $h->tebal_katalog;
			$data['subjek_pengarang_katalog'] = $h->subjek_pengarang_katalog;
			$data['no_induk_katalog'] = $h->no_induk_katalog;
			$data['status_katalog'] = $h->status_katalog;

		}

		$data['option_status'] = array('Dipinjam','Tersedia');

		$this->load->view('Edit_nonperaturan',$data);
	}

	public function SaveUpdate(){
		$id_nonperaturan = $this->input->post('id_nonperaturan');
		$where = array('id_nonperaturan' => $id_nonperaturan);

		$queryambil = $this->db->query('SELECT file,thumb FROM tb_nonperaturan WHERE id_nonperaturan ='.$id_nonperaturan)->row_array();

		$file = $_FILES['file']['name'];
		$thumb = $_FILES['thubnail']['name'];
		
		if (empty($file) AND empty($thumb)) {
			//Melakukan edit tanpa mengedit data file dan thumb
			$dataPer = array(
					'judul' => $this->input->post('judul'),
					'edit_by' => $this->session->userdata('level_akses'),
					'tgl_posting' => date('Y-m-d'),
					'col_number_katalog' => $this->input->post('col_number'),
					'pengarang_katalog'  => $this->input->post('pengarang_buku'),
					'judul_katalog'  => $this->input->post('judul_buku'),
					'kota_katalog'  => $this->input->post('kota_terbit'),
					'penerbit_katalog'  => $this->input->post('penerbit_buku'),
					'tahun_katalog'  => $this->input->post('tahun_terbit'),
					'jilid_katalog'  => $this->input->post('jilid_buku'),
					'jumlah_katalog'  => $this->input->post('jumlah_halaman'),
					'tebal_katalog'  => $this->input->post('tebal_buku'),
					'subjek_pengarang_katalog'  => $this->input->post('subjek'),
					'no_induk_katalog'  => $this->input->post('no_induk'),
					'status_katalog'  => $this->input->post('status')
			);

			$query = $this->m_nonperaturan->simpan_edit($dataPer,$where);

			if ($query) {
					$aktivitas = array(
						'user' => $this->session->userdata('level_akses'),
						'aktivitas' => $this->session->userdata('level_akses').' mengubah data non peraturan',
						'waktu'=> date('Y-m-d-H-i-s')
					);

					$this->m_nonperaturan->log($aktivitas);

					$this->session->set_flashdata('message','Data Berhasil Di edit');
					redirect(base_url('index.php/Dashboard/NonPeraturan'));
			}else{
				echo "gagal";
			}

		}elseif(!empty($file) AND !empty($thumb)){
		//Melakukan edit dengan mengedit keduanya
		$ambext = explode(".",$thumb);
		$eksetensi = end($ambext);
		$nama_baru = date('YmdHis');
		$nama_file_thumb = $nama_baru.".".$eksetensi;

		$config['upload_path'] = './assets/images/nonperaturan/';
		$config['allowed_types'] = 'JPG|jpeg|jpg|png';
		$config['max_size'] = 10000;
		$config['file_name'] = $nama_file_thumb;

		$this->upload->initialize($config);
		if (!$this->upload->do_upload('thubnail') AND !$this->upload->do_upload('file')) {
		 	$this->session->set_flashdata('message','Masukan gambar atau thumbnail dengan format yang benar');
			redirect(base_url('index.php/Dashboard/NonPeraturan/Update/'.$id_nonperaturan));
		}else{
		 	//Mengupload File pdf atau word ketika berhasil mengupload gambar atau thumbnail
		 	unset($config);
		 	$ambext = explode(".",$file);
		 	$eksetensi = end($ambext);
			$nama_baru = date('YmdHis');
			$nama_file = $nama_baru.".".$eksetensi;

			$config['upload_path'] = './assets/file/nonperaturan/';
			$config['allowed_types'] = 'pdf|doc|docx';
			$config['file_name'] = $nama_file;

			$this->upload->initialize($config);
			if (!$this->upload->do_upload('file')) {

				//Menghapus gambar yang sudah di upload ketika gagal mengupload file pdf atau word.
				@unlink('./assets/images/nonperaturan/'.$nama_file_thumb);
				$this->session->set_flashdata('message','Masukan atau upload file dengan format yang benar');
				redirect(base_url('index.php/Dashboard/NonPeraturan/Update/'.$id_nonperaturan));

			}else{
				@unlink('./assets/images/nonperaturan/'.$queryambil['thumb']);
				@unlink('./assets/file/nonperaturan/'.$queryambil['file']);
					$dataPer = array(
						'judul' => $this->input->post('judul'),
						'file'  => $nama_file,
						'thumb'  => $nama_file_thumb,
						'edit_by' => $this->session->userdata('level_akses'),
						'tgl_posting' => date('Y-m-d'),
						'col_number_katalog' => $this->input->post('col_number'),
						'pengarang_katalog'  => $this->input->post('pengarang_buku'),
						'judul_katalog'  => $this->input->post('judul_buku'),
						'kota_katalog'  => $this->input->post('kota_terbit'),
						'penerbit_katalog'  => $this->input->post('penerbit_buku'),
						'tahun_katalog'  => $this->input->post('tahun_terbit'),
						'jilid_katalog'  => $this->input->post('jilid_buku'),
						'jumlah_katalog'  => $this->input->post('jumlah_halaman'),
						'tebal_katalog'  => $this->input->post('tebal_buku'),
						'subjek_pengarang_katalog'  => $this->input->post('subjek'),
						'no_induk_katalog'  => $this->input->post('no_induk'),
						'status_katalog'  => $this->input->post('status')
					);

					$query = $this->m_nonperaturan->simpan_edit($dataPer,$where);

					if ($query) {
						$aktivitas = array(
							'user' => $this->session->userdata('level_akses'),
							'aktivitas' => $this->session->userdata('level_akses').' mengubah data non peraturan',
							'waktu'=> date('Y-m-d-H-i-s')
						);

						$this->m_nonperaturan->log($aktivitas);

						$this->session->set_flashdata('message','Data Berhasil Di edit');
						redirect(base_url('index.php/Dashboard/NonPeraturan'));
					}else{
						echo "gagal";
					}
				}
			}

		}elseif(empty($file)){
			//Melakukan edit tanpa mengedit file tetapi mengedit thumb
			$ambext =explode(".",$thumb);
			$eksetensi = end($ambext);
			$nama_baru = date('YmdHis');
			$nama_file = $nama_baru.".".$eksetensi;

			$config['upload_path'] = './assets/images/nonperaturan/';
			$config['allowed_types'] = 'JPG|jpeg|jpg|png';
			$config['max_size'] = 10000;
			$config['file_name'] = $nama_file;

			$this->upload->initialize($config);
			if (!$this->upload->do_upload('thubnail')) {
			 	$this->session->set_flashdata('message','Masukan gambar atau thumbnail dengan fromat yang benar');
				redirect(base_url('index.php/Dashboard/NonPeraturan/Update/'.$id_nonperaturan));
			}else{
				@unlink('./assets/images/nonperaturan/'.$queryambil['thumb']);
				$dataPer = array(
					'judul' => $this->input->post('judul'),
					'thumb' => $nama_file,
					'edit_by' => $this->session->userdata('level_akses'),
					'tgl_posting' => date('Y-m-d'),
					'col_number_katalog' => $this->input->post('col_number'),
					'pengarang_katalog'  => $this->input->post('pengarang_buku'),
					'judul_katalog'  => $this->input->post('judul_buku'),
					'kota_katalog'  => $this->input->post('kota_terbit'),
					'penerbit_katalog'  => $this->input->post('penerbit_buku'),
					'tahun_katalog'  => $this->input->post('tahun_terbit'),
					'jilid_katalog'  => $this->input->post('jilid_buku'),
					'jumlah_katalog'  => $this->input->post('jumlah_halaman'),
					'tebal_katalog'  => $this->input->post('tebal_buku'),
					'subjek_pengarang_katalog'  => $this->input->post('subjek'),
					'no_induk_katalog'  => $this->input->post('no_induk'),
					'status_katalog'  => $this->input->post('status')
				);

				$query = $this->m_nonperaturan->simpan_edit($dataPer,$where);

				if ($query) {
						$aktivitas = array(
							'user' => $this->session->userdata('level_akses'),
							'aktivitas' => $this->session->userdata('level_akses').' mengubah data non peraturan',
							'waktu'=> date('Y-m-d-H-i-s')
						);

						$this->m_nonperaturan->log($aktivitas);

						$this->session->set_flashdata('message','Data Berhasil Di edit');
						redirect(base_url('index.php/Dashboard/NonPeraturan'));
				}else{
					echo "gagal";
				}
			}

		}else{
			//Melakukan edit tanpa mengedit thumb tetapi mengedit file
			$ambext = explode(".",$file);
			$eksetensi = end($ambext);
			$nama_baru = date('YmdHis');
			$nama_file = $nama_baru.".".$eksetensi;

			$config['upload_path'] = './assets/file/nonperaturan/';
			$config['allowed_types'] = 'pdf|doc|docx';
			$config['file_name'] = $nama_file;


			$this->upload->initialize($config);
			if (!$this->upload->do_upload('file')) {
				$this->session->set_flashdata('message','Masukan atau upload file dengan fromat yang benar');
				redirect(base_url('index.php/Dashboard/NonPeraturan/Update/'.$id_nonperaturan));
			}else{
				$dataPer = array(
					'judul' => $this->input->post('judul'),
					'file' => $nama_file,
					'edit_by' => $this->session->userdata('level_akses'),
					'tgl_posting' => date('Y-m-d'),
					'col_number_katalog' => $this->input->post('col_number'),
					'pengarang_katalog'  => $this->input->post('pengarang_buku'),
					'judul_katalog'  => $this->input->post('judul_buku'),
					'kota_katalog'  => $this->input->post('kota_terbit'),
					'penerbit_katalog'  => $this->input->post('penerbit_buku'),
					'tahun_katalog'  => $this->input->post('tahun_terbit'),
					'jilid_katalog'  => $this->input->post('jilid_buku'),
					'jumlah_katalog'  => $this->input->post('jumlah_halaman'),
					'tebal_katalog'  => $this->input->post('tebal_buku'),
					'subjek_pengarang_katalog'  => $this->input->post('subjek'),
					'no_induk_katalog'  => $this->input->post('no_induk'),
					'status_katalog'  => $this->input->post('status')
				);

				$query = $this->m_nonperaturan->simpan_edit($dataPer,$where);

				if ($query) {
						@unlink('./assets/file/nonperaturan/'.$queryambil['file']);
					
						$aktivitas = array(
							'user' => $this->session->userdata('level_akses'),
							'aktivitas' => $this->session->userdata('level_akses').' mengubah data non peraturan',
							'waktu'=> date('Y-m-d-H-i-s')
						);

						$this->m_nonperaturan->log($aktivitas);

						$this->session->set_flashdata('message','Data Berhasil Di edit');
						redirect(base_url('index.php/Dashboard/NonPeraturan'));
				}else{
					echo "gagal";
				}
			}
		}
	}

	public function Delete(){
		$id_nonperaturan = $this->uri->segment(4);
		
		$queryambil = $this->db->query('SELECT file,thumb FROM tb_nonperaturan WHERE id_nonperaturan ='.$id_nonperaturan)->row_array();
		@unlink('./assets/images/nonperaturan/'.$queryambil['thumb']);

		@unlink('./assets/file/nonperaturan/'.$queryambil['file']);


		$where = array('id_nonperaturan' => $id_nonperaturan );
		
		$query = $this->m_nonperaturan->hapus_data($where);

		if ($query) {
			$aktivitas = array(
				'user' => $this->session->userdata('level_akses'),
				'aktivitas' => $this->session->userdata('level_akses').' menghapus data non peraturan',
				'waktu'=> date('Y-m-d-H-i-s')
			);

			$this->m_nonperaturan->log($aktivitas);

			$this->session->set_flashdata('message','Data Berhasil Di hapus');
			redirect(base_url('index.php/Dashboard/NonPeraturan'));
		}else{
			echo "gagal";
		}
	}
}