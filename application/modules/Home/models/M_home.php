<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

Class m_home extends CI_Model{

	//function dari controllers function profil() 
	public function menu_dropdown($id){
		$q = $this->db->query('
			SELECT * FROM tb_menu,tb_content 
			WHERE tb_menu.id_menu = tb_content.id_menu 
			AND tb_content.id_content = '.$id
		);
		return $q->result();
	}

	public function tampil_slide(){
		return $this->db->get_where('tb_slide', array('status'=>'publish'));
	}

	public function tampil_banner(){
		return $this->db->query('
			SELECT * FROM tb_banner
			WHERE status = "publish"
			ORDER BY id_banner DESC
			LIMIT 5
		');
	}
	
	public function peraturan_terbaru(){
		$query = $this->db->query('
			SELECT * FROM tb_peraturan,tb_peraturan_cat 
			WHERE tb_peraturan_cat.id_peraturan_cat = tb_peraturan.id_peraturan_cat 
			ORDER BY id_peraturan DESC
			LIMIT 5
		');
		
		return $query->result();
	}


	public function option_peraturan_level($where){
		return $this->db->order_by('urutan ASC')->get_where('tb_peraturan_cat',$where);
	}

	public function counter(){
		
		$tampil = "";
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$tanggal = date('d-Y');
		$bulan = date('m');
		$tgl = date('d');
		$bln = date('m');
		$thn = date('Y');
		$blnlu = date('m')-01;
		$query = $this->db->get_where('tb_counter', array('ip'=>$ip, 'tanggal'=>$tanggal, 'bulan'=>$bulan))->num_rows();
		if ($query == 0) {
			$this->db->insert('tb_counter', array('ip'=>$ip, 'tanggal'=>$tanggal, 'bulan'=>$bulan));
		}
		
		$hariini = $this->db->get_where('tb_counter', array('tanggal'=>$tanggal))->num_rows();
		$blnlalu = $this->db->like('bulan',$blnlu)->get_where('tb_counter')->num_rows();
		$blnini = $this->db->like('bulan',$bln)->get_where('tb_counter')->num_rows();
		$tahunini = $this->db->like('tanggal',$thn)->get_where('tb_counter')->num_rows();

		$tampil .= "<img src=".base_url('assets/images/counter/user1.png')."> Hari Ini : ". $hariini ."<br>";
		$tampil .= "<img src=".base_url('assets/images/counter/user2.png')."> Bulan Lalu : ".$blnlalu."<br>";
		$tampil .= "<img src=".base_url('assets/images/counter/user2.png')."> Bulan Ini : ". $blnini . "<br>";
		$tampil .= "<img src=".base_url('assets/images/counter/user.png')."> Tahun Ini : ". $tahunini . "<br>";

		return $tampil;

		}

	//model function dari controller function peraturan()ip LIKE '%$ip%' AND 
	public function peraturan($where){
		return $this->db->order_by('urutan ASC')->get_where('tb_peraturan_cat',$where);
	}

	//model function untuk input pesan masuk dari controller function insert_pesan()
	public function input_data($data,$table){
		$this->db->insert($table,$data);
	}
	
	public function peraturan_ak($id){
		$query = $this->db->query('
			SELECT * FROM tb_peraturan,tb_peraturan_cat 
			WHERE tb_peraturan.id_peraturan_cat = tb_peraturan_cat.id_peraturan_cat 
			AND tb_peraturan_cat.id_peraturan_cat = '.$id
		);
		return $query->result();
	}

	public function view_abstrak_katalog($id){
		$query = $this->db->query('
			SELECT * FROM tb_peraturan,tb_peraturan_cat 
			WHERE tb_peraturan.id_peraturan_cat = tb_peraturan_cat.id_peraturan_cat 
			AND tb_peraturan.id_peraturan = '.$id
		);
		return $query->result();
	}

	//model function dari controller function nonreadmore()
	public function nonperaturan_katalog($id){
		$this->db->where('id_nonperaturan',$id);
		$q = $this->db->get('tb_nonperaturan');
		return $q->result();
	}
	
	//model function untuk proses cari dari controllers function searching()
	public function cari_per(){
		$bentuk = $this->input->GET('id_peraturan_cat', TRUE);
		$nomor = $this->input->GET('nomor', TRUE);
		$tahun = $this->input->GET('tahun', TRUE);
		$tentang = $this->input->GET('tentang_katalog', TRUE);
		$status = $this->input->GET('status', TRUE);
		
		$data = $this->db->query("
			SELECT * FROM tb_peraturan,tb_peraturan_cat 
			WHERE tb_peraturan_cat.id_peraturan_cat = tb_peraturan.id_peraturan_cat 
			AND tb_peraturan.id_peraturan_cat LIKE '%$bentuk%' 
			AND nomor LIKE '%$nomor%' 
			AND tahun LIKE '%$tahun%' 
			AND tentang_katalog LIKE '%$tentang%' 
			AND status LIKE '%$status%'"
		);
		
		return $data->result();
	}

	//model function untuk proses cari dari controllers function search()
	public function cari_nonper(){
		$judul = $this->input->GET('judul', TRUE);
		$pengarang = $this->input->GET('pengarang_katalog', TRUE);
		$penerbit = $this->input->GET('penerbit_katalog', TRUE);
		$kota = $this->input->GET('kota_katalog', TRUE);
		$tahun = $this->input->GET('tahun_katalog', TRUE);
		
		$data = $this->db->query("
			SELECT * FROM tb_nonperaturan 
			WHERE judul LIKE '%$judul%' 
			AND pengarang_katalog LIKE '%$pengarang%' 
			AND penerbit_katalog LIKE '%$penerbit%' 
			AND kota_katalog LIKE '%$kota%' 
			AND tahun_katalog LIKE '%$tahun%'"
		);
		
		return $data->result();
	}

}
	/*public function p_terbaru($id){
		$query = $this->db->query('
			SELECT * FROM tb_peraturan,tb_peraturan_cat 
			WHERE tb_peraturan.id_peraturan_cat = tb_peraturan_cat.id_peraturan_cat 
			AND tb_peraturan_cat.id_peraturan_cat = '.$id
		);
		
		return $query->result();
	}*/

?>