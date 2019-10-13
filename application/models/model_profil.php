<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_profil extends CI_Model{

	function __Construct(){
		parent::__Construct();
		$this->load->database();
	}
	
	function GetProfil(){
		$data = array();
		$this->db->where('id',1);
		$query = $this->db->get('profil');
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
	}
	
	function UpdateProfil($data){
		$this->db->where('id',1);
		$this->db->update('profil',$data);
	}
	
	
   function Alamat(){
		$query = $this->db->query("
			SELECT alamat FROM profil
		");
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				return $row->alamat;
			}
		}
   }
   
   function NoPegawai($value){
		$this->db->select('no_pegawai');
		$this->db->where('no_pegawai',$value);
		$this->db->where('password','');
		$query = $this->db->get('pegawai');
		if($query->num_rows > 0){ 
			return true;
		}
   }
   
   function CekLogin($value,$password){
		$this->db->select('no_pegawai');
		$this->db->select('password');
		$this->db->where('no_pegawai',$value);
		$this->db->where('password',$password);
		$query = $this->db->get('pegawai');
		if($query->num_rows > 0){ 
			return true;
		}
   }
   
   function UpdatePassword($no_pegawai,$password){
	    $data['password'] = $password;
		$this->db->where('no_pegawai',$no_pegawai);
		$this->db->update('pegawai',$data);
   }
   
   function ResetData(){
		$this->db->query("TRUNCATE penjualan");
		$this->db->query("TRUNCATE penjualan_detail");
		$this->db->query("TRUNCATE pembelian");
		$this->db->query("TRUNCATE pembayaran");
   }

}