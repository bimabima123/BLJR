<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

Class m_kategori_peraturan extends CI_Model{
	
	public function tampil_data(){
		$this->db->order_by('id_peraturan_cat','DESC');
		return $this->db->get('tb_peraturan_cat');
	}

	public function ambil_kategori_parent($where){
		$this->db->order_by('id_peraturan_cat','ASC');
		return $this->db->get_where('tb_peraturan_cat',$where);
	}

	public function ambil_selected($where){
		return $this->db->get_where('tb_peraturan_cat',$where);
	}

	public function hapus_data($where){
		return $this->db->delete('tb_peraturan_cat',$where);
	}

	public function simpan_data($data){
		return $this->db->insert('tb_peraturan_cat',$data);
	}

	public function ambil_edit($where){
		return $this->db->get_where('tb_peraturan_cat',$where);
	}

	public function simpan_edit($data,$where){
		return $this->db->update('tb_peraturan_cat',$data,$where);
	}

	public function log($aktivitas){
		return $this->db->insert('tb_logaktivitas',$aktivitas);
	}
}
?>