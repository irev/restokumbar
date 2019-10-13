<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penjualan extends CI_Controller{

	
	function __Construct(){
		parent::__Construct();
		$this->load->library('pagination');
		$this->load->Model('Model_cashier');
		$this->load->Model('Model_penjualan');
		$this->load->helper('form');
	}
	
	function index(){
		$config = array();
        $config["base_url"] = base_url() . "index.php/penjualan/page";
        $config["total_rows"] = $this->Model_penjualan->CountData();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data Penjualan',
			'data'=>$this->Model_penjualan->ReadData($config["per_page"], $page),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_penjualan->CountData()
		);
		$this->load->view('view_penjualan',$data);
	}
	
	function page(){
		$config = array();
        $config["base_url"] = base_url() . "index.php/penjualan/page";
        $config["total_rows"] = $this->Model_penjualan->CountData();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data Penjualan',
			'data'=>$this->Model_penjualan->ReadData($config["per_page"], $page),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_penjualan->CountData()
		);
		$this->load->view('view_penjualan',$data);
	}
	
	function ShowDetail(){
		$no_struk = $this->input->get('no_struk');
		$data = $this->Model_penjualan->ShowDetail($no_struk);
		echo $json_encode = json_encode($data);
	}
	
	function Delete(){
		$no_struk = $this->input->get('no_struk');
		$this->Model_penjualan->Delete($no_struk);
		$this->Model_penjualan->DeleteDetail($no_struk);
	}
	
	function Search(){
		$awal = $this->input->get('awal');
		$akhir = $this->input->get('akhir');
		$config = array();
        $config["base_url"] = base_url() . "index.php/penjualan/page";
        $config["total_rows"] = $this->Model_penjualan->CountData();
        $config["per_page"] = $this->Model_penjualan->CountData();
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Pencarian Data',
			'data'=>$this->Model_penjualan->Search($config["per_page"], $page,$awal,$akhir),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_penjualan->CountData()
		);
		$this->load->view('view_penjualan',$data);
	}
	
	function struk(){
		$no_struk = $this->input->get('no_struk');
		$data['data'] = $this->Model_penjualan->CurrentStruk($no_struk);
		$this->load->view('pdf_struk',$data);
	}
	
	function cetak_struk(){
		$data['data'] = $this->Model_penjualan->Struk();
		$this->load->view('pdf_struk',$data);
	}
	
	function cetak(){
		$awal = $this->input->get('awal');
		$akhir = $this->input->get('akhir');
		$jml_data = $this->Model_penjualan->CountData();
		$data['data'] = $this->Model_penjualan->Search($jml_data,0,$awal,$akhir);
		$data['awal'] = $awal;
		$data['akhir'] = $akhir;
		$data['jml_data'] = $jml_data;
		$this->load->view('pdf_penjualan',$data);
	}
	
	function daily(){
		$awal = $this->input->get('awal');
		$akhir = $this->input->get('akhir');
		$jml_data = $this->Model_penjualan->CountData();
		$data['data'] = $this->Model_penjualan->Search($jml_data,0,$awal,$akhir);
		$data['awal'] = $awal;
		$data['akhir'] = $akhir;
		$data['jml_data'] = $jml_data;
		$this->load->view('pdf_daily',$data);
	}
	
	function LaporanPenjualan(){
		$data['kategori'] = $this->Model_cashier->Kategori();
		$data['level'] = $this->Model_cashier->Level();
		$data['extra'] = $this->Model_cashier->Extra();
		$this->load->view('pdf_lap_penjualan',$data);
	}
	
	function LaporanPeriode(){
		$awal = $this->input->get('awal');
		$akhir = $this->input->get('akhir');
		$data['kategori'] = $this->Model_cashier->Kategori();
		$data['level'] = $this->Model_cashier->Level();
		$data['extra'] = $this->Model_cashier->Extra();
		$this->load->view('pdf_lap_periode',$data);
	}
	
	function LaporanPerdaftar(){
		$awal = $this->input->get('awal');
		$akhir = $this->input->get('akhir');
		$total = $this->Model_penjualan->CountData();
		$page = 0;
		$data['data'] = $this->Model_penjualan->Search($total, $page,$awal,$akhir);
		$this->load->view('pdf_lap_penjualan_daftar',$data);
	}
	
}
