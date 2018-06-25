<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class m_login extends CI_Model{
	
	public function cek_login($data,$where){
		return $this->db->get_where($data,$where);
	}
	public function insert($tabel,$data){
		return $this->db->insert($tabel,$data);
	}
}

?>