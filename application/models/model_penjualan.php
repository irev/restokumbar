<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_penjualan extends CI_Controller{

	function __Construct(){
		parent::__Construct();
		$this->load->database();
	}
	
	function CountData(){
		 return $this->db->count_all('penjualan');
	}
	
	function ReadData($limit, $start) {
        $this->db->limit($limit, $start);
		$this->db->order_by("no_struk", "asc");
        $query = $this->db->get('penjualan');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
   function ShowDetail($no_struk){
		$data = array();
		$this->db->where('no_struk',$no_struk);	
		$query = $this->db->get('penjualan_detail');
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
   }
   
   function Delete($no_struk){
		$this->db->where('no_struk',$no_struk);	
		$this->db->delete('penjualan');
   }
   
    function DeleteDetail($no_struk){
		$this->db->where('no_struk',$no_struk);	
		$this->db->delete('penjualan_detail');
   }
   
   function Search($limit,$start,$awal,$akhir){
		$this->db->where('tanggal >=',$awal);
		$this->db->where('tanggal <=',$akhir);
		$this->db->limit($limit, $start);
        $query = $this->db->get('penjualan');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
   function Struk(){
		$no_struk = $this->last_index();
		$data = array();
	    $this->db->where('no_struk',$no_struk);
		$query = $this->db->get('penjualan');
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
   }
   
   function CurrentStruk($no_struk){
		$data = array();
	    $this->db->where('no_struk',$no_struk);
		$query = $this->db->get('penjualan');
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
   }
   
   function last_index(){
		$this->db->select_max('no_struk','id');
		$query = $this->db->get('penjualan');
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				return $row->id;
			}
		}
   }
   
   function HitungTotal($awal,$akhir){
		$this->db->where('tanggal >=',$awal);
		$this->db->where('tanggal <=',$akhir);
		$this->db->select_sum('total_bayar');
		$query = $this->db->get('penjualan');
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				if($row->total_bayar==0){
					return 0;
				}else{
					return $row->total_bayar;
				}
			}
		}

   }
 
	

}