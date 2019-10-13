<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_cashier extends CI_Model{

	function __Construct(){
		parent::__Construct();
		$this->load->database();
	}
	
	function Kategori(){
		$data = array();
		$this->db->order_by('kategori','DESC');
		$query = $this->db->get('kategori_menu');
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
	}
	
	function Level(){
		$data = array();
		$query = $this->db->get('level_pedas');
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
	}
	
	function Extra(){
		$data = array();
		$query = $this->db->get('extra');
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
	}
	
	function SelectOnce($value,$table,$key,$criteria){
		$this->db->select($value);
		$this->db->where($key,$criteria);
		$query = $this->db->get($table);
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				return $row->$value;
			}
		}
	}
	
	function CekData($data,$table,$key,$value){
		$this->db->select($data);
		$this->db->where($key,$value);
		$query = $this->db->get($table);
		if($query->num_rows > 0){ 
			return true;
		}
	}
	
	function CreateID(){
		$new_no_struk = '';
		$last_no_struk = '';
		$this->db->select_max('no_struk','no_struk');
		$query = $this->db->get('penjualan');
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$last_no_struk =  $row->no_struk;
			}
		}
		
		$this_year = substr(date("Y"),2); // Tahun Sekarang
		$no_struk_year = substr($last_no_struk,3,2); // Tahun pada no_struk
		$last_index = substr($last_no_struk,4,6); // Cari Index terakhir
		
		
		if($last_no_struk==null){
			$new_no_struk = $this_year.'000001';
		}
		else {
			if($last_index>=1000){
				$new_no_struk = $this_year.''.($last_index+1);
			}else{
				$zero = 0;
				$count_index = strlen($last_index); // Hitung jumlah karakter '00001'
				for($i=0;$i<$count_index;$i++){
					if(substr($last_index,$i,1)=="0"){
						$zero++;  // Hitung jumlah nol
					}
				}
				$current_index = substr($last_index,$zero); // index current '1'

				if($current_index==9||$current_index==99||$current_index==999||$current_index==9999){
					$zero = $zero -1;
				}
				
				if($this_year>$no_struk_year){
					$new_no_struk = $this_year.'000001';
				}else {
					$new_no_struk = $this_year.''.substr($last_index,0,$zero)."".($current_index+1);
				}
			}
		}
		return $new_no_struk;
	}
	
	function NoCheck($tanggal){
		$no_check;
		$this->db->where('tanggal',$tanggal);
		$this->db->select_max('no_check','id');
		$query = $this->db->get('penjualan');
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$no_check =  $row->id+1;
			}
		}
		return $no_check;
	}
	
	function SaveData($data){
		$this->db->insert('penjualan',$data);
	}
	
	function SaveDetail($data){
		$this->db->insert('penjualan_detail',$data);
	}
	
	
	
	
	

}