<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_posisi extends CI_Model{

	function __Construct(){
		parent::__Construct();
		$this->load->database();
	}
	
	function CountData(){
		 return $this->db->count_all('posisi');
	}
	
	function ReadData($limit, $start) {
        $this->db->limit($limit, $start);
		$this->db->order_by("no_posisi", "asc");
        $query = $this->db->get('posisi');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
	
	function save($data){
		$this->db->insert('posisi',$data);
	}
	
	function update($data,$no_posisi){
		$this->db->where('no_posisi',$no_posisi);	
		$this->db->update('posisi',$data);
	}
	
	function delete($value){
		$this->db->where('no_posisi',$value);	
		$this->db->delete('posisi');
		$data = $this->CountData();
	}
	
	function PilihFoto($no_posisi){
		$this->db->select('foto');
		$this->db->where('no_posisi',$no_posisi);
		$query = $this->db->get('posisi');
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				return $row->foto;
			}
		}
	}
	
	function edit($no_posisi){
		$data = array();
		$this->db->where('no_posisi',$no_posisi);
		$query = $this->db->get('posisi');
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
	}
	
	
	

}