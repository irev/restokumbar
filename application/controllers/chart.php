<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chart extends CI_Controller{

	function __Construct(){
		parent::__Construct();
		$this->load->Model('Model_chart');
	}
	

	function penjualan(){
		$data['title'] = 'Grafik Penjualan /  Pendapatan';
		$this->load->view('chart_penjualan',$data);	
	}
	
	function pengeluaran(){
		$data['title'] = 'Grafik Pengeluaran';
		$this->load->view('chart_pengeluaran',$data);	
	}
	
	function labarugi(){
		$data['title'] = 'Grafik Pendapatan & Pengeluaran';
		$this->load->view('chart_labarugi',$data);	
	}
	
	
	function Sum($awal,$akhir,$table,$key){
		$query = mysql_query("
			SELECT COALESCE(SUM(".$key."),0) AS tp
			FROM ".$table."
			WHERE tanggal
			BETWEEN  '".$awal."'
			AND  '".$akhir."'
		");
		while($rs = mysql_fetch_array($query)){
			return $rs['tp'];
		}
	}
	
	function Total(){
		$tahun = $this->input->get('tahun');
		$table = $this->input->get('table');
		$key = $this->input->get('key');
		$data = array(
			$this->Sum($tahun.'-01-01',$tahun.'-01-31',$table,$key),
			$this->Sum($tahun.'-02-01',$tahun.'-02-31',$table,$key),
			$this->Sum($tahun.'-03-01',$tahun.'-03-31',$table,$key),
			$this->Sum($tahun.'-04-01',$tahun.'-04-31',$table,$key),
			$this->Sum($tahun.'-05-01',$tahun.'-05-31',$table,$key),
			$this->Sum($tahun.'-06-01',$tahun.'-06-31',$table,$key),
			$this->Sum($tahun.'-07-01',$tahun.'-07-31',$table,$key),
			$this->Sum($tahun.'-08-01',$tahun.'-08-31',$table,$key),
			$this->Sum($tahun.'-09-01',$tahun.'-09-31',$table,$key),
			$this->Sum($tahun.'-10-01',$tahun.'-10-31',$table,$key),
			$this->Sum($tahun.'-11-01',$tahun.'-11-31',$table,$key),
			$this->Sum($tahun.'-12-01',$tahun.'-12-31',$table,$key)
		);
		echo  $json_encode = json_encode($data);
	}

}