<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Peraturan_Json extends MX_Controller{
	
	public function __construct(){
		parent::__construct();
		//$this->load->library('fungtion');
	}

	public function getBy_id(){
		
		$id_peraturan_cat = $this->uri->segment(4);

			$peraturan = $this->db->query('
				SELECT Per.*,Cat.* FROM tb_peraturan AS Per
				LEFT JOIN tb_peraturan_cat AS Cat
				ON Per.id_peraturan_cat = Cat.id_peraturan_cat
				AND Cat.id_peraturan_cat = Per.id_peraturan_cat
	            WHERE Per.id_peraturan_cat = '.$id_peraturan_cat
	        )->result_array();
			

			$arr = array();

			foreach ($peraturan as $key => $rows) {
				//$tgl = $rows['tgl_posting'];
				$riwayat_status = htmlentities(strip_tags($rows['riwayat_status']),ENT_QUOTES);
				//$tanggal = $this->fungtion->convert_date($tanggal);
				
				$isi = array(
					"id_peraturan_cat" => $rows['id_peraturan_cat'],
					"jenis" => $rows['bentuk'],
					"No. Peraturan" => $rows['nomor'],
					"Fil Download" => $rows['file'],
					"Url" => 'http://[::1]/jdih/index.php/home/Peraturan_Json/get/2'.$rows['file'],
					"Detail Peraturan" => $riwayat_status,
					"Status" => $rows['status'],
					"Hasil Materi Uji" => $rows['catatan_abstrak'],
					"Tanggal" => $rows['tgl_posting'],
					"Detail Abstrak" => 'http://[::1]/jdih/index.php/home/home/katalog/'.$rows['id_peraturan_cat'].'/'.$rows['id_peraturan'],
					"Detail Katalog" => 'http://[::1]/jdih/index.php/home/home/katalog/'.$rows['id_peraturan_cat'].'/'.$rows['id_peraturan'],
					"Tanggal Data" => $rows['tanggal_katalog'],
					"Display" => '1',
					"Operasi" => '0',
				);
				
				array_push($arr,$isi);
			}
			
			$data = json_encode($arr);

			echo "{\"Data Peraturan\": " . $data . "}";

	}

}
?>