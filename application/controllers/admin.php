<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller{

	function __Construct(){
		parent::__Construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->Model('Model_profil');
	}
	
	// Username User
	function Username(){
		return $this->session->userdata('username');
	}
	
	// Status Login
	function GetLogin(){
		return $this->session->userdata('login');
	}
	
	function index(){
		$data['title'] = 'Administrator';
		$this->load->view('view_login',$data);
	}
	
	function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		if($username=='admin'&&$password=='admin'){
			redirect('home');
		}else if($username=='casheir'&&$password=='casheir'){
			$data = array(
				'username' => $username,
				'login' => true
			);
			$this->session->set_userdata($data);
			redirect('cashier');
		}else{
			$this->session->sess_destroy();
			redirect('admin?login_false');
		}
		
			
		
	}
	
	function daftar(){
		$no_pegawai = $this->input->post('no_pegawai');
		$password = md5($this->input->post('password'));
		$cek = $this->Model_profil->NoPegawai($no_pegawai);
		if($cek){
			$this->Model_profil->UpdatePassword($no_pegawai,$password);
			redirect('admin?register_success');
		}else{
			redirect('admin?register_failed');
		}
	}
	
	function logout(){
		$this->session->sess_destroy();
		redirect('admin');
	}
	
	function ResetData(){
		$this->Model_profil->ResetData();
		redirect('home');
	}

}