<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

Class m_menu extends CI_Model{
	public function tampil_data(){
		return $this->db->get('tb_menu');
	}

	public function ambil_induk($where){
		return $this->db->get_where('tb_menu',$where);
	}

	public function simpan_data($data){
		return $this->db->insert('tb_menu',$data);
	}

	public function ambil_edit($where){
		return $this->db->get_where('tb_menu',$where);
	}

	public function simpan_edit($data,$where){
		return $this->db->update('tb_menu',$data,$where);
	}

	public function hapus_data($where){
		return $this->db->delete('tb_menu',$where);
	}

	public function log($data){
		return $this->db->insert('tb_logaktivitas',$data);
	}
}
?>