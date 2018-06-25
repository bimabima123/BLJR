<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

Class m_list_peraturan extends CI_Model{
	
	public function tampil_data(){
		$query = '
			SELECT p.*,
			kp.bentuk AS nama_kategori
			FROM tb_peraturan AS p
			LEFT JOIN tb_peraturan_cat AS kp
			ON p.id_peraturan_cat = kp.id_peraturan_cat
			ORDER BY p.id_peraturan DESC
		';
		return $this->db->query($query)->result();
	}

	public function hapus_data($where){
		return $this->db->delete('tb_peraturan',$where);
	}

	public function option_kategori_level($where){
		return $this->db->get_where('tb_peraturan_cat',$where);
	}

	public function simpan_data($data){
		return $this->db->insert('tb_peraturan',$data);
	}

	public function ambil_edit($where){
		return $this->db->get_where('tb_peraturan',$where);
	}

	public function simpan_edit($data,$where){
		return $this->db->update('tb_peraturan',$data,$where);
	}

	public function option_peraturan_terkait(){
		$query = '
			SELECT P.*,KP.bentuk FROM tb_peraturan AS P
			LEFT JOIN
			tb_peraturan_cat AS KP
			ON P.id_peraturan_cat = KP.id_peraturan_cat
			ORDER BY KP.bentuk, P.tahun ASC
		';
		return $this->db->query($query);
	}

	public function log($data){
		$this->db->insert('tb_logaktivitas',$data);
	}
}
?>