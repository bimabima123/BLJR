<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

Class m_data_admin extends CI_Model{
	public function tampil_data(){
		return $this->db->get('tb_admin');
	}

	public function simpan_data($data){
		return $this->db->insert('tb_admin',$data);
	}

	public function hapus_data($where){
		return $this->db->delete('tb_admin',$where);
	}

	public function ambil_edit($where){
		return $this->db->get_where('tb_admin',$where);
	}

	public function simpan_edit($data,$where){
		return $this->db->update('tb_admin',$data,$where);
	}

	public function log($data){
		return $this->db->insert('tb_logaktivitas',$data);
	}
}
?>