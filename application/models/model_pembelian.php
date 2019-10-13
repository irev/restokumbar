<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_pembelian extends CI_Controller{

	function __Construct(){
		parent::__Construct();
		$this->load->database();
	}
	
	function CountData(){
		 return $this->db->count_all('pembelian');
	}
	
	function ReadData($limit, $start) {
        $this->db->limit($limit, $start);
		$this->db->order_by("no_pembelian", "asc");
        $query = $this->db->get('pembelian');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
   function CreateID(){
		$new_no_pembelian = '';
		$last_no_pembelian = '';
		$this->db->select_max('no_pembelian','no_pembelian');
		$query = $this->db->get('pembelian');
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$last_no_pembelian =  $row->no_pembelian;
			}
		}
		
		$this_year = substr(date("Y"),2); // Tahun Sekarang
		$no_pembelian_year = substr($last_no_pembelian,3,2); // Tahun pada no_pembelian
		$last_index = substr($last_no_pembelian,4,6); // Cari Index terakhir
		
		
		if($last_no_pembelian==null){
			$new_no_pembelian = $this_year.'000001';
		}
		else {
			if($last_index>=1000){
				$new_no_pembelian = $this_year.''.($last_index+1);
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
				
				if($this_year>$no_pembelian_year){
					$new_no_pembelian = $this_year.'000001';
				}else {
					$new_no_pembelian = $this_year.''.substr($last_index,0,$zero)."".($current_index+1);
				}
			}
		}
		return $new_no_pembelian;
	}
	
	
	function Supplier(){
		$data = array();
		$this->db->select('nama');
		$this->db->order_by('nama','asc');
		$query = $this->db->get('supplier');
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
	}
	
	
	function Bahan(){
		$data = array();
		$this->db->select('nama');
		$this->db->order_by('nama','asc');
		$query = $this->db->get('bahan');
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
	}
	
	
	function Harga($nama){
		$this->db->select('harga');
		$this->db->where('nama',$nama);
		$query = $this->db->get('bahan');
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				return $row->harga;
			}
		}
	}
	
	function SaveData($data){
		$this->db->insert('pembelian',$data);
	}
	
	function SaveDetail($data){
		$this->db->insert('pembelian_detail',$data);
	}
	
	function UpdateStok($nama,$jumlah){
		$this->db->query("
			UPDATE bahan SET stok = stok +".$jumlah." WHERE nama = '".$nama."'
		");
	}
   
	function Faktur($no_pembelian){
		$data = array();
		$this->db->where('no_pembelian',$no_pembelian);
		$query = $this->db->get('pembelian');
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
	}
	
	function GetItem($no_pembelian){
		$data = array();
		$this->db->select('item');
		$this->db->select('jumlah');
		$this->db->where('no_pembelian',$no_pembelian);
		$query = $this->db->get('pembelian_detail');
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
	}
	
	function Delete($no_pembelian){
		$data = $this->GetItem($no_pembelian);
		foreach($data as $data){
			$this->db->query("
				UPDATE bahan SET stok = stok +".$data['jumlah']." WHERE nama = '".$data['item']."'
			");
		}
		$this->db->query("
			DELETE FROM pembelian_detail WHERE no_pembelian = '".$no_pembelian."'		
		");
		$this->db->query("
			DELETE FROM pembelian WHERE no_pembelian = '".$no_pembelian."'		
		");
	}
	
	 function ShowDetail($no_struk){
		$data = array();
		$this->db->where('no_pembelian',$no_struk);	
		$query = $this->db->get('pembelian_detail');
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
   }
   
    function Search($limit,$start,$awal,$akhir){
		$this->db->where('tanggal >=',$awal);
		$this->db->where('tanggal <=',$akhir);
		$this->db->limit($limit, $start);
        $query = $this->db->get('pembelian');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
}