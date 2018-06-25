<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class ListPeraturan extends MX_Controller{
	public function __construct(){
		parent::__construct();

		if($this->session->userdata('status') != 'login'){
			redirect(base_url('index.php/Dashboard/login'));
		}

		$this->load->model('m_list_peraturan');
		$this->load->helper('url');
		$this->load->library('upload');
	}

	public function index(){
		$data['title'] = 'List Peraturan';
		$data['tb_peraturan'] = $this->m_list_peraturan->tampil_data();
		$this->load->view('v_list_peraturan',$data);
	}

	public function Insert(){
		$data['title'] = 'Tambah data peraturan';
		$data['parent'] = $this->m_list_peraturan->option_kategori_level(array('level' => 1))->result();
		$data['peraturan_terkait'] = $this->m_list_peraturan->option_peraturan_terkait()->result();
		$this->load->view('Tambah_peraturan',$data);
	}

	public function SaveInsert(){
		$file = $_FILES['file']['name'];
		
		$ambext = explode(".",$file);
		$ekstensi = end($ambext);
		$nama_baru = date('YmdHis');
		$nama_file = $nama_baru.".".$ekstensi;

		$config['upload_path'] = './assets/file/peraturan/';
		$config['allowed_types']='|pdf|doc|docx';
		$config['file_name'] = $nama_file;

		$this->upload->initialize($config);
		if(!$this->upload->do_upload('file')){
			$this->session->set_flashdata('message','Masukan file dengan format yang benar');
			redirect(base_url('index.php/Dashboard/ListPeraturan/Insert'));
		}else{
			$dataPer = array(
				'id_peraturan_cat' => $this->input->post('kategori_peraturan'),
				'tgl_posting' => date('Y-m-d'),
				'tahun' => $this->input->post('tahun_peraturan'),
				'nomor' => $this->input->post('nomor_peraturan'),
				'subjek' => $this->input->post('subjek'),
				'add_by' => $this->session->userdata('level_akses'),
				'file' => $nama_file,
				'count' => 0,
				'status' => $this->input->post('status'),
				'peraturan_status' => $this->input->post('peraturan_terkait'),
				'riwayat_status' => $this->input->post('riwayat'),
				'tajuk_katalog' => $this->input->post('tajuk_katalog'),
				'judul_katalog' => $this->input->post('judul_katalog'),
				'bentuk_katalog' => $this->input->post('bentuk_katalog'),
				'tanggal_katalog' => $this->input->post('tanggal_katalog') ,
				'tentang_katalog' => $this->input->post('tentang_katalog'),
				'tempat_katalog' => $this->input->post('tempat_katalog'),
				'tahun_katalog' =>$this->input->post('tahun_katalog') ,
				'sumber_katalog' =>$this->input->post('sumber_katalog') ,
				'subjek_katalog' =>  $this->input->post('subjek_katalog'),
				'singkatan_katalog' => $this->input->post('singkatan_katalog'), 
				'lokasi_katalog' =>  $this->input->post('lokasi_katalog'),
				'subjek_abstrak' =>	$this->input->post('subjek_abstrak') ,
				'tahun_abstrak' => $this->input->post('tahun_abstrak'),	
				'singkatan_abstrak' =>$this->input->post('singkatan_abstrak'),
				'nomor_abstrak' => $this->input->post('no_abstrak') ,	
				'sumber_abstrak' =>	$this->input->post('sumber_abstrak') ,
				'jumlah_abstrak' =>	 $this->input->post('jumlah_abstrak'),
				'bentuk_abstrak' =>	$this->input->post('bentuk_abstrak') ,
				'tentang_abstrak' =>$this->input->post('tentang_abstrak') ,	
				'isi_abstrak' => $this->input->post('isi_abstrak'),	
				'dasar_hukum_abstrak' => $this->input->post('dasar_hukum_abstrak'),	
				'diatur_tentang_abstrak' =>	$this->input->post('diatur_tentang_abstrak') ,
				'catatan_abstrak' =>  $this->input->post('catatan_abstrak')
			);

			$query = $this->m_list_peraturan->simpan_data($dataPer);

			if ($query) {
				$aktivitas = array(
					'user' => $this->session->userdata('level_akses'),
					'aktivitas' => $this->session->userdata('level_akses').' menambahkan data peraturan',
					'waktu'=> date('Y-m-d-H-i-s')
				);

				$this->m_list_peraturan->log($aktivitas);

				$this->session->set_flashdata('message','Data Berhasil Di tambahkan');
				redirect(base_url('index.php/Dashboard/ListPeraturan'));
			}else{
				echo "gagal";
			}
		}

	}

	public function Update(){
		$data['title'] = 'Edit peraturan';
		
		$id_peraturan = $this->uri->segment(4);

		$where = array('id_peraturan' => $id_peraturan);

		$peraturan = $this->m_list_peraturan->ambil_edit($where);

		foreach ($peraturan->result() as $h) {
			$data['id_peraturan'] = $h->id_peraturan;
			$data['id_peraturan_cat'] = $h->id_peraturan_cat;
			$data['tahun'] = $h->tahun;
			$data['nomor'] = $h->nomor;
			$data['subjek'] = $h->subjek;
			$data['add_by'] = $h->add_by;
			$data['file'] = $h->file;
			$data['status'] = $h->status;
			$data['peraturan_terkait_lama'] = $h->peraturan_status;
			$data['riwayat_status'] = $h->riwayat_status;
			$data['tajuk_katalog'] = $h->tajuk_katalog;
			$data['judul_katalog'] = $h->judul_katalog;
			$data['bentuk_katalog'] = $h->bentuk_katalog;
			$data['tanggal_katalog'] = $h->tanggal_katalog;
			$data['tentang_katalog'] = $h->tentang_katalog;
			$data['tempat_katalog'] = $h->tempat_katalog;
			$data['tahun_katalog'] = $h->tahun_katalog;
			$data['sumber_katalog'] = $h->sumber_katalog;
			$data['subjek_katalog'] = $h->subjek_katalog;
			$data['singkatan_katalog'] = $h->singkatan_katalog;
			$data['lokasi_katalog'] = $h->lokasi_katalog;
			$data['subjek_abstrak'] = $h->subjek_abstrak;
			$data['tahun_abstrak'] = $h->tahun_abstrak;
			$data['singkatan_abstrak'] = $h->singkatan_abstrak;
			$data['nomor_abstrak'] = $h->nomor_abstrak;
			$data['sumber_abstrak'] = $h->sumber_abstrak;
			$data['jumlah_abstrak'] = $h->jumlah_abstrak;
			$data['bentuk_abstrak'] = $h->bentuk_abstrak;
			$data['tentang_abstrak'] = $h->tentang_abstrak;
			$data['isi_abstrak'] = $h->isi_abstrak;
			$data['dasar_hukum_abstrak'] = $h->dasar_hukum_abstrak;
			$data['diatur_tentang_abstrak'] = $h->diatur_tentang_abstrak;
			$data['catatan_abstrak'] = $h->catatan_abstrak;
		}
		//Option dinamis
		$data['parent'] = $this->m_list_peraturan->option_kategori_level(array('level' => 1))->result();
		$data['status_option'] = array('Dicabut','Mencabut','Diubah','Mengubah');
		$data['peraturan_terkait'] = $this->m_list_peraturan->option_peraturan_terkait()->result();


		$this->load->view('Edit_peraturan',$data);
	}

	public function SaveUpdate(){
		$id_peraturan = $this->input->post('id_peraturan');
		$where = array('id_peraturan' => $id_peraturan);
		$query = $this->db->query("SELECT id_peraturan,file FROM tb_peraturan WHERE id_peraturan = ".$id_peraturan)->row_array();
		
		$file = $_FILES['file']['name'];
		
		$ambext = explode('.',$file);
		$ekstensi = end($ambext);
		$nama_baru = date('Ymdhis');
		$nama_file = $nama_baru.'.'.$ekstensi;
		
		$config['upload_path'] = './assets/file/peraturan/';
		$config['allowed_types']='|pdf|doc|docx';
		$config['file_name'] = $nama_file;
		
        if(empty($file)){
            $dataPer = array(
				'id_peraturan_cat' => $this->input->post('kategori_peraturan'),
				'tgl_posting' => date('Y-m-d'),
				'tahun' => $this->input->post('tahun_peraturan'),
				'nomor' => $this->input->post('nomor_peraturan'),
				'subjek' => $this->input->post('subjek'),
				'edit_by' => $this->session->userdata('level_akses'),
				'status' => $this->input->post('status'),
				'peraturan_status' => $this->input->post('peraturan_terkait'),
				'riwayat_status' => $this->input->post('riwayat'),
				'tajuk_katalog' => $this->input->post('tajuk_katalog'),
				'judul_katalog' => $this->input->post('judul_katalog'),
				'bentuk_katalog' => $this->input->post('bentuk_katalog'),
				'tanggal_katalog' => $this->input->post('tanggal_katalog') ,
				'tentang_katalog' => $this->input->post('tentang_katalog'),
				'tempat_katalog' => $this->input->post('tempat_katalog'),
				'tahun_katalog' =>$this->input->post('tahun_katalog'),
				'sumber_katalog' =>$this->input->post('sumber_katalog'),
				'subjek_katalog' =>  $this->input->post('subjek_katalog'),
				'singkatan_katalog' => $this->input->post('singkatan_katalog'), 
				'lokasi_katalog' =>  $this->input->post('lokasi_katalog'),
				'subjek_abstrak' =>	$this->input->post('subjek_abstrak'),
				'tahun_abstrak' => $this->input->post('tahun_abstrak'),	
				'singkatan_abstrak' =>$this->input->post('singkatan_abstrak'),
				'nomor_abstrak' => $this->input->post('no_abstrak'),	
				'sumber_abstrak' =>	$this->input->post('sumber_abstrak'),
				'jumlah_abstrak' =>	 $this->input->post('jumlah_abstrak'),
				'bentuk_abstrak' =>	$this->input->post('bentuk_abstrak'),
				'tentang_abstrak' =>$this->input->post('tentang_abstrak'),	
				'isi_abstrak' => $this->input->post('isi_abstrak'),	
				'dasar_hukum_abstrak' => $this->input->post('dasar_hukum_abstrak'),	
				'diatur_tentang_abstrak' =>	$this->input->post('diatur_tentang_abstrak'),
				'catatan_abstrak' =>  $this->input->post('catatan_abstrak')
			);


			$query = $this->m_list_peraturan->simpan_edit($dataPer,$where);

			if ($query) {
				$aktivitas = array(
					'user' => $this->session->userdata('level_akses'),
					'aktivitas' => $this->session->userdata('level_akses').' mengubah data peraturan',
					'waktu'=> date('Y-m-d-H-i-s')
				);

				$this->m_list_peraturan->log($aktivitas);

				$this->session->set_flashdata('message','Data Berhasil Di edit');
				redirect(base_url('index.php/Dashboard/ListPeraturan'));
			}else{
				echo "gagal";
			}
        }else{
            $this->upload->initialize($config);
            if($this->upload->do_upload('file')){
                @unlink('./assets/file/peraturan/'.$query['file']);
                $dataPer = array(
    				'id_peraturan_cat' => $this->input->post('kategori_peraturan'),
    				'tgl_posting' => date('Y-m-d'),
    				'tahun' => $this->input->post('tahun_peraturan'),
    				'nomor' => $this->input->post('nomor_peraturan'),
    				'subjek' => $this->input->post('subjek'),
    				'edit_by' => $this->session->userdata('level_akses'),
    				'file' => $nama_file,
    				'status' => $this->input->post('status'),
    				'peraturan_status' => $this->input->post('peraturan_terkait'),
    				'riwayat_status' => $this->input->post('riwayat'),
    				'tajuk_katalog' => $this->input->post('tajuk_katalog'),
    				'judul_katalog' => $this->input->post('judul_katalog'),
    				'bentuk_katalog' => $this->input->post('bentuk_katalog'),
    				'tanggal_katalog' => $this->input->post('tanggal_katalog') ,
    				'tentang_katalog' => $this->input->post('tentang_katalog'),
    				'tempat_katalog' => $this->input->post('tempat_katalog'),
    				'tahun_katalog' =>$this->input->post('tahun_katalog'),
    				'sumber_katalog' =>$this->input->post('sumber_katalog'),
    				'subjek_katalog' =>  $this->input->post('subjek_katalog'),
    				'singkatan_katalog' => $this->input->post('singkatan_katalog'), 
    				'lokasi_katalog' =>  $this->input->post('lokasi_katalog'),
    				'subjek_abstrak' =>	$this->input->post('subjek_abstrak'),
    				'tahun_abstrak' => $this->input->post('tahun_abstrak'),	
    				'singkatan_abstrak' =>$this->input->post('singkatan_abstrak'),
    				'nomor_abstrak' => $this->input->post('no_abstrak'),	
    				'sumber_abstrak' =>	$this->input->post('sumber_abstrak'),
    				'jumlah_abstrak' =>	 $this->input->post('jumlah_abstrak'),
    				'bentuk_abstrak' =>	$this->input->post('bentuk_abstrak'),
    				'tentang_abstrak' =>$this->input->post('tentang_abstrak'),	
    				'isi_abstrak' => $this->input->post('isi_abstrak'),	
    				'dasar_hukum_abstrak' => $this->input->post('dasar_hukum_abstrak'),	
    				'diatur_tentang_abstrak' =>	$this->input->post('diatur_tentang_abstrak'),
    				'catatan_abstrak' =>  $this->input->post('catatan_abstrak')
    			);
    
    			$query = $this->m_list_peraturan->simpan_edit($dataPer,$where);
    
    			if ($query) {
    				$aktivitas = array(
    					'user' => $this->session->userdata('level_akses'),
    					'aktivitas' => $this->session->userdata('level_akses').' mengubah data peraturan',
    					'waktu'=> date('Y-m-d-H-i-s')
    				);
    
    				$this->m_list_peraturan->log($aktivitas);
    
    				$this->session->set_flashdata('message','Data Berhasil Di edit');
    				redirect(base_url('index.php/Dashboard/ListPeraturan'));
    			}else{
    				echo "gagal";
    			}
    			
            }else{
                $this->session->set_flashdata('message','Masukan file dengan format yang benar');
				redirect(base_url('index.php/Dashboard/ListPeraturan/Update/'.$id_peraturan));
            }
        }
	}

	public function Delete(){
		$id_peraturan = $this->uri->segment(4);

		$query = $this->db->query("SELECT id_peraturan,file FROM tb_peraturan WHERE id_peraturan = ".$id_peraturan)->row_array();
		@unlink('./assets/file/peraturan/'.$query['file']);

		$where = array(
			'id_peraturan' => $id_peraturan
		);

		$query = $this->m_list_peraturan->hapus_data($where);

		if ($query) {
			$aktivitas = array(
				'user' => $this->session->userdata('level_akses'),
				'aktivitas' => $this->session->userdata('level_akses').' menghapus data peraturan',
				'waktu'=> date('Y-m-d-H-i-s')
			);

			$this->m_list_peraturan->log($aktivitas);

			$this->session->set_flashdata('message','Data Berhasil Di hapus');
			redirect(base_url('index.php/Dashboard/ListPeraturan'));
		}else{
			echo "gagal";
		}
	}

}
?>