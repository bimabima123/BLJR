<?php 
	class m_operator extends CI_Model{
		function tampil_data(){
			return $this->db->get('tb_informasi','tb_data_planet', 'tb_kejadian');
		}
	}