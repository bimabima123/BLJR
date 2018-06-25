<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Catper_Json extends MX_Controller{
	
	public function __construct(){
		parent::__construct();
	}

	public function getAll(){
		
		$kategori = $this->db->get('tb_peraturan_cat')->result_array();
		$arr = array();

		foreach ($kategori as $key => $rows) {
			$isi = array(
				"id_peraturan_cat" => $rows['id_peraturan_cat'],
				"bentuk" => $rows['bentuk']
			);
			
			array_push($arr,$isi);
		}
		
		$data = json_encode($arr);

		echo "{\"Kategori Peraturan\":" . $data . "}";


	}

}
?>