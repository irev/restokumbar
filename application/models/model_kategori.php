<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_kategori extends CI_Model{

	function __Construct(){
		parent::__Construct();
		$this->load->database();
	}
	
	function CountData(){
		 return $this->db->count_all('kategori_menu');
	}
	
	function ReadData($limit, $start) {
        $this->db->limit($limit, $start);
		$this->db->order_by("no_kategori", "asc");
        $query = $this->db->get('kategori_menu');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
	
	function save($data){
		$this->db->insert('kategori_menu',$data);
	}
	
	function update($data,$no_kategori){
		$this->db->where('no_kategori',$no_kategori);	
		$this->db->update('kategori_menu',$data);
	}
	
	function delete($value){
		$this->db->where('no_kategori',$value);	
		$this->db->delete('kategori_menu');
		$data = $this->CountData();
	}
	
	function PilihFoto($no_kategori){
		$this->db->select('foto');
		$this->db->where('no_kategori',$no_kategori);
		$query = $this->db->get('kategori_menu');
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				return $row->foto;
			}
		}
	}
	
	function edit($no_kategori){
		$data = array();
		$this->db->where('no_kategori',$no_kategori);
		$query = $this->db->get('kategori_menu');
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
	}
	
	
	

}