<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_supplier extends CI_Controller{

	function __Construct(){
		parent::__Construct();
		$this->load->database();
	}
	
	function CountData(){
		 return $this->db->count_all('supplier');
	}
	
	function ReadData($limit, $start) {
        $this->db->limit($limit, $start);
		$this->db->order_by("no_supplier", "asc");
        $query = $this->db->get('supplier');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
   function Save($data){
		$this->db->insert('supplier',$data);
   }
   
   function Edit($no_supplier){
		$data = array();
		$this->db->where('no_supplier',$no_supplier);
		$query = $this->db->get('supplier');
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
	}
   
	function Update($data,$no_supplier){
		$this->db->where('no_supplier',$no_supplier);
		$this->db->update('supplier',$data);
	}
   
	function Delete($no_supplier){
		$this->db->where('no_supplier',$no_supplier);	
		$this->db->delete('supplier');
	}
	
	function ListPencarian(){
		$data = array();
		$query = $this->db->query("DESC supplier");
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
	}
	
	function SearchData($limit, $start,$kategori,$value) {
        $this->db->limit($limit, $start);
		$this->db->like($kategori, $value);
        $query = $this->db->get('supplier');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
   function CreateID(){
		$new_id = '';
		$last_id = '';
		$this->db->select_max('no_supplier','id');
		$query = $this->db->get('supplier');
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$last_id =  $row->id;
			}
		}
		$last_index = substr($last_id,1,3); 
		if($last_id==null){
			$new_id = 'S001'; 
		}
		else {
			if($last_index>=1000){
				$new_id = ''.($last_index+1);
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
				
				$new_id = 'S'.substr($last_index,0,$zero)."".($current_index+1);
			}
		}
		return $new_id;
	}
	

}