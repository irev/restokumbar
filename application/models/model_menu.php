<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_menu extends CI_Model{

	function __Construct(){
		parent::__Construct();
		$this->load->database();
	}
	
	
	function CountData(){
		 return $this->db->count_all('menu');
	}
	
	function ReadData($limit, $start) {
        $this->db->limit($limit, $start);
		$this->db->order_by("kategori", "desc");
        $query = $this->db->get('menu');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
   function GetKategori(){
		$data = array();
		$this->db->order_by("kategori", "asc");
		$query = $this->db->get('kategori_menu');
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
	}
	
	function save($data){
		$this->db->insert('menu',$data);
	}
	
	function update($data,$no_menu){
		$this->db->where('no_menu',$no_menu);	
		$this->db->update('menu',$data);
	}
	
	function delete($value){
		$this->db->where('no_menu',$value);	
		$this->db->delete('menu');
	}
	
	function PilihFoto($no_menu){
		$this->db->select('foto');
		$this->db->where('no_menu',$no_menu);
		$query = $this->db->get('menu');
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				return $row->foto;
			}
		}
	}
	
	function edit($no_menu){
		$data = array();
		$this->db->where('no_menu',$no_menu);
		$query = $this->db->get('menu');
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
	}
	
	function get_menu($kategori){
		$data = array();
		$this->db->where('kategori',$kategori);
		$query = $this->db->get('menu');
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
	}
	
	function get_menu_all(){
		$data = array();
		$query = $this->db->get('menu');
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;	
	}	
	
	function ListPencarian(){
		$data = array();
		$query = $this->db->query("
			DESC menu
		");
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
        $query = $this->db->get('menu');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
   function KodeKategori($kategori){
		$this->db->select('no_kategori');
		$this->db->where('kategori',$kategori);
		$query = $this->db->get('kategori_menu');
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				return $row->no_kategori;
			}
		}
	}
	
	
	function CreateID($kategori){
		$new_id = '';
		$last_id = '';
		$this->db->select_max('no_menu','id');
		$this->db->where('kategori',$kategori);
		$query = $this->db->get('menu');
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$last_id =  $row->id;
			}
		}
		$last_index = substr($last_id,3); // UNTUK 8 KARAKTER
		if($last_id==null){
			$new_id = '00001'; 
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
				
				$new_id = substr($last_index,0,$zero)."".($current_index+1);
			}
		}
		return $new_id;
	}

}
