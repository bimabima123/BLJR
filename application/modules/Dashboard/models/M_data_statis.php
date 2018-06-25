<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 

Class m_data_statis extends CI_Model{
		
	public function tampil_data(){
		return $this->db->get('tb_content');
	}

	public function ambil_menu($where){
		return $this->db->get_where('tb_menu',$where);
	}

	public function ambil_edit($where){
		return $this->db->get_where('tb_content',$where);
	}

	public function simpan_data($data){
		return $this->db->insert('tb_content',$data);
	}

	public function simpan_edit($data,$where){
		return $this->db->update('tb_content',$data,$where);
	}

	public function hapus_data($where){
		return $this->db->delete('tb_content',$where);
	}

	public function log($data){
		return $this->db->insert('tb_logaktivitas',$data);	
	}
}
?>