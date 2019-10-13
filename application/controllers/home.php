<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{

	function __Construct(){
		parent::__Construct();
		$this->load->Model('Model_penjualan');
	}
	
	function index(){
		date_default_timezone_set("Asia/Jakarta");
		$jml_data = $this->Model_penjualan->CountData();
		$awal =  date('Y-m-d',strtotime('first day of this month')); 
		$akhir = date('Y-m-d',strtotime('last day of this month'));
		
		$total = 0;
		$kas = 0;
		$d = $this->Model_penjualan->Search($jml_data,0,$awal,$akhir);
		if($d){
			foreach($d as $d){
				$total+=1;
				$kas+=$d->total_bayar;
			}	
		}
		
		$data  = array(
			'title'=>'Simple Resto',
			'jml_data'=>$total,
			'kas'=>$kas,
			'data'=>$this->Model_penjualan->Search($jml_data,0,$awal,$akhir)
		);
		$this->load->view('view_home',$data);
	}
	
	function Get($value,$table,$key,$id){
		$query = mysql_query("SELECT ".$value." FROM ".$table." WHERE ".$key." = '".$id."' ");
		while($row = mysql_fetch_array($query)){
			return $row[$value];
		}
	}

}