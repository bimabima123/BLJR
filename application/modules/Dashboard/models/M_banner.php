<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

Class m_banner extends CI_Model{
		
	public function tampil_data(){
		return $this->db->get('tb_banner');
	}

	public function tambah_data($data){
		return $this->db->insert('tb_banner',$data);
	}

	public function ambil_edit($where){
		return $this->db->get_where('tb_banner',$where);
	}

	public function simpan_edit($data,$where){
		return $this->db->update('tb_banner',$data,$where);
	}

	public function hapus_data($where){
		return $this->db->delete('tb_banner',$where);
	}

	public function log($data){
		return $this->db->insert('tb_logaktivitas',$data);	
	}
}
?>