<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_pedas extends CI_Model{

	function __Construct(){
		parent::__Construct();
		$this->load->database();
	}
	
	function CountData(){
		 return $this->db->count_all('level_pedas');
	}
	
	function ReadData($limit, $start) {
        $this->db->limit($limit, $start);
		$this->db->order_by("no_level", "asc");
        $query = $this->db->get('level_pedas');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
	
	function save($data){
		$this->db->insert('level_pedas',$data);
	}
	
	function update($data,$no_level){
		$this->db->where('no_level',$no_level);	
		$this->db->update('level_pedas',$data);
	}
	
	function delete($value){
		$this->db->where('no_level',$value);	
		$this->db->delete('level_pedas');
		$data = $this->CountData();
	}
	
	function PilihFoto($no_level){
		$this->db->select('foto');
		$this->db->where('no_level',$no_level);
		$query = $this->db->get('level_pedas');
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				return $row->foto;
			}
		}
	}
	
	function edit($no_level){
		$data = array();
		$this->db->where('no_level',$no_level);
		$query = $this->db->get('level_pedas');
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row;
			}
		}
		$query->free_result();
		return $data;
	}
	
	function CreateID(){
		$new_id = '';
		$last_id = '';
		$this->db->select_max('no_level','id');
		$query = $this->db->get('level_pedas');
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$last_id =  $row->id;
			}
		}
		$last_index = substr($last_id,1,3); 
		if($last_id==null){
			$new_id = 'L001'; 
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
				
				$new_id = 'L'.substr($last_index,0,$zero)."".($current_index+1);
			}
		}
		return $new_id;
	}
	

}