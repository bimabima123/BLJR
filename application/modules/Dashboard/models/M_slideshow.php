<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

Class m_slideshow extends CI_Model{
		
	public function tampil_data(){
		return $this->db->get('tb_slide');
	}

	public function tambah_data($data){
		return $this->db->insert('tb_slide',$data);
	}

	public function ambil_edit($where){
		return $this->db->get_where('tb_slide',$where);
	}

	public function simpan_edit($data,$where){
		return $this->db->update('tb_slide',$data,$where);
	}

	public function hapus_data($where){
		return $this->db->delete('tb_slide',$where);
	}

	public function log($data){
		return $this->db->insert('tb_logaktivitas',$data);	
	}
}
?>