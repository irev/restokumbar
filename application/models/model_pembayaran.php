<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_pembayaran extends CI_Controller{

	function __Construct(){
		parent::__Construct();
		$this->load->database();
	}
	
	function CountData(){
		 return $this->db->count_all('pembayaran');
	}
	
	function ReadData($limit, $start) {
        $this->db->limit($limit, $start);
		$this->db->order_by("no_pembayaran", "asc");
        $query = $this->db->get('pembayaran');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
   function CreateID(){
		$new_no_pembayaran = '';
		$last_no_pembayaran = '';
		$this->db->select_max('no_pembayaran','no_pembayaran');
		$query = $this->db->get('pembayaran');
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$last_no_pembayaran =  $row->no_pembayaran;
			}
		}
		
		$this_year = substr(date("Y"),2); // Tahun Sekarang
		$no_pembayaran_year = substr($last_no_pembayaran,3,2); // Tahun pada no_pembayaran
		$last_index = substr($last_no_pembayaran,4,6); // Cari Index terakhir
		
		
		if($last_no_pembayaran==null){
			$new_no_pembayaran = $this_year.'000001';
		}
		else {
			if($last_index>=1000){
				$new_no_pembayaran = $this_year.''.($last_index+1);
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
				
				if($this_year>$no_pembayaran_year){
					$new_no_pembayaran = $this_year.'000001';
				}else {
					$new_no_pembayaran = $this_year.''.substr($last_index,0,$zero)."".($current_index+1);
				}
			}
		}
		return $new_no_pembayaran;
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
		$this->db->insert('pembayaran',$data);
	}
	
	function SaveDetail($data){
		$this->db->insert('pembayaran_detail',$data);
	}
	
   
	function Faktur($no_pembayaran){
		$data = array();
		$this->db->where('no_pembayaran',$no_pembayaran);
		$query = $this->db->get('pembayaran');
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
	}
	
	
	function Delete($no_pembayaran){
		$this->db->query("
			DELETE FROM pembayaran_detail WHERE no_pembayaran = '".$no_pembayaran."'		
		");
		$this->db->query("
			DELETE FROM pembayaran WHERE no_pembayaran = '".$no_pembayaran."'		
		");
	}
	
	 function ShowDetail($no_struk){
		$data = array();
		$this->db->where('no_pembayaran',$no_struk);	
		$query = $this->db->get('pembayaran_detail');
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
        $query = $this->db->get('pembayaran');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
   function ListPembayaran(){
		$query = $this->db->query('
			SELECT item FROM pembayaran_detail GROUP BY item ASC
		');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
}