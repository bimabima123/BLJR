<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

Class m_welcome extends CI_Model{
	public function show(){
		$this->db->order_by('id_log','DESC');
		return $this->db->get('tb_logaktivitas');
	}

	public function hapus_riwayat(){
		return $this->db->empty_table('tb_logaktivitas',null);
	}
}
?>