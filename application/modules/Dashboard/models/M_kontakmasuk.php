<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

Class m_Kontakmasuk extends CI_Model{
	public function show(){
		$this->db->order_by('id_kontakmasuk','DESC');
		return $this->db->get('tb_kontakmasuk');
	}

	public function edit_status($data,$where){
		return $this->db->update('tb_kontakmasuk',$data,$where);
	}

	public function cek_pesan($where){
		return $this->db->get_where('tb_kontakmasuk',$where);
	}

	public function hapus_pesan(){
		return $this->db->empty_table('tb_kontakmasuk',null);
	}
	
	public function log($data){
		return $this->db->insert('tb_logaktivitas',$data);	
	}
}
?>