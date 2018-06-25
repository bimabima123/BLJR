<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

Class m_nonperaturan extends CI_Model{
	
	public function tampil_data(){
		$this->db->order_by('id_nonperaturan','DESC');
		return $this->db->get('tb_nonperaturan');
	}

	public function tambah_data($tabel,$data){
		return $this->db->insert($tabel,$data);
	}

	public function ambil_edit($where){
		return $this->db->get_where('tb_nonperaturan',$where);
	}

	public function simpan_edit($data,$where){
		return $this->db->update('tb_nonperaturan',$data,$where);
	}

	public function hapus_data($where){
		return $this->db->delete('tb_nonperaturan',$where);
	}

	public function log($data){
		return $this->db->insert('tb_logaktivitas',$data);
	}
}
?>