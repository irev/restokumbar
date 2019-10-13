<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller{

	function __Construct(){
		parent::__Construct();
	    $this->load->Model('Model_profil');
	}
	
	function index(){
		$data['title'] = "Profil Perusahaan";
		$data['data'] = $this->Model_profil->GetProfil();
		$this->load->view('view_profil',$data);	
	}
	
	function Update(){
		$data['no_izin'] = $this->input->post('no_izin');
		$data['nama'] = $this->input->post('nama');
		$data['alamat'] = $this->input->post('alamat');
		$data['no_telp'] = $this->input->post('no_telp');
		$data['pin_bb'] = $this->input->post('pin_bb');
		$data['email'] = $this->input->post('email');
		$data['facebook'] = $this->input->post('facebook');
		$data['twitter'] = $this->input->post('twitter');
		$data['owner'] = $this->input->post('owner');
		$data['tgl_berdiri'] = $this->input->post('tgl_berdiri');
		$data['waktu_buka'] = $this->input->post('waktu_buka');
		$data['waktu_tutup'] = $this->input->post('waktu_tutup');
		$this->Model_profil->UpdateProfil($data);
		redirect('profil');
	}
	
	function Alamat(){
		echo $this->Model_profil->Alamat();
	}

}