<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
Class Login extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('m_login');
	}

	public function index(){
		$data['title'] = 'Administrator - login';
		$this->load->view('v_login',$data);
	}

	public function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => sha1($password)
			);
		$cek = $this->m_login->cek_login('tb_admin',$where)->num_rows();

		if($cek == 1){

 		$dataadmin = $this->m_login->cek_login('tb_admin',$where)->result_array();
			
			foreach ($dataadmin as $h) {
				$level_akses = $h['level'];
			}
		
		$data_session = array(
			'status' => 'login',
			'level_akses' => $level_akses,
		);

			$this->session->set_userdata($data_session);
		$this->session->set_flashdata('message', 'Selamat datang '.$this->session->userdata('level_akses'));
		
		$datalog = array(
			'user' => $this->session->userdata('level_akses'),
			'aktivitas' => $this->session->userdata('level_akses').' telah login',
			'waktu' => date('Y-m-d-H-i-s')
		);
			
		$this->m_login->insert('tb_logaktivitas',$datalog);

			redirect(base_url('index.php/Dashboard/Welcome'));

			}else{
		$this->session->set_flashdata('message', 'Username dan Password tidak cocok');
			redirect(base_url('index.php/Dashboard/Login'));
		}
	}

	public function logout(){
		$datalog = array(
			'user' => $this->session->userdata('level_akses'),
			'aktivitas' => $this->session->userdata('level_akses').' telah logout',
			'waktu' => date('Y-m-d-H-i-s')
		);
			
	$this->m_login->insert('tb_logaktivitas',$datalog);

		$this->session->sess_destroy();
		redirect(base_url('index.php/Dashboard/Welcome'));
	}
}
?>