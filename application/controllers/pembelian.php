<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembelian extends CI_Controller{

	
	function __Construct(){
		parent::__Construct();
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->Model('Model_pembelian');
		$this->load->helper('form');
	}
	
	// Username User
	function Username(){
		return $this->session->userdata('username');
	}
	
	// Status Login
	function GetLogin(){
		return $this->session->userdata('login');
	}
	
	function Format($harga){
		return "Rp. ".number_format($harga,0,"",".");
	}
	
	function index(){
		$config = array();
        $config["base_url"] = base_url() . "index.php/pembelian/page";
        $config["total_rows"] = $this->Model_pembelian->CountData();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data Bahan',
			'data'=>$this->Model_pembelian->ReadData($config["per_page"], $page),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_pembelian->CountData()
		);
		$this->load->view('view_pembelian',$data);
	}
	
	function page(){
		$config = array();
        $config["base_url"] = base_url() . "index.php/pembelian/page";
        $config["total_rows"] = $this->Model_pembelian->CountData();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data Bahan',
			'data'=>$this->Model_pembelian->ReadData($config["per_page"], $page),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_pembelian->CountData()
		);
		$this->load->view('view_pembelian',$data);
	}
	
	function add(){
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m-d');
		$data['title'] = 'Transaksi Pembelian';
		$data['no_casheir'] = $this->Username();
		$data['no_struk'] = 'BL'.$this->Model_pembelian->CreateID();
		$this->load->view('view_add_pembelian',$data);
	}
	
	function Supplier(){
		$data = $this->Model_pembelian->Supplier();
		echo $json_encode = json_encode($data);
	}
	
	function Bahan(){
		$data = $this->Model_pembelian->Bahan();
		echo "<option></option>";
		foreach($data as $data){
			echo "<option value='".$data['nama']."'>".$data['nama']."</option>";
		}
	}
	
	function Harga(){
		$nama = $this->input->get('nama');
		echo $this->Model_pembelian->Harga($nama);
	}
	
	function SaveData(){
		$data['no_pembelian'] = $this->input->post('no_pembelian');
		$data['no_casheir'] = $this->Username();
		$data['no_faktur'] = $this->input->post('no_faktur');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['waktu'] = $this->input->post('waktu');
		$data['supplier'] = $this->input->post('supplier');
		$data['total_bayar'] = $this->input->post('tobar');
		$this->Model_pembelian->SaveData($data);
	}
	
	function SaveDetail(){
		$data['no_pembelian'] = $this->input->get('no_pembelian');
		$data['tanggal']= $this->input->get('tanggal');
		$data['item'] = $this->input->get('item');
		$data['harga'] = $this->input->get('harga');
		$data['jumlah'] = $this->input->get('jumlah');
		$data['total'] = $this->input->get('total');
		$this->Model_pembelian->SaveDetail($data);
		$this->Model_pembelian->UpdateStok($this->input->get('item'),$this->input->get('jumlah'));
	}
	
	function CetakFaktur(){
		$id = $this->input->get('id');
		$data['data'] = $this->Model_pembelian->Faktur($id);
		$this->load->view('pdf_faktur',$data);
	}
	
	function Delete(){
		$no_pembelian = $this->input->get('no_struk');
		$this->Model_pembelian->Delete($no_pembelian);
	}
	
	function ShowDetail(){
		$no_struk = $this->input->get('no_struk');
		$data = $this->Model_pembelian->ShowDetail($no_struk);
		echo $json_encode = json_encode($data);
	}
	
	function Search(){
		$awal = $this->input->get('awal');
		$akhir = $this->input->get('akhir');
		$config = array();
        $config["base_url"] = base_url() . "index.php/pembelian/page";
        $config["total_rows"] = $this->Model_pembelian->CountData();
        $config["per_page"] = $this->Model_pembelian->CountData();
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Pencarian Data',
			'data'=>$this->Model_pembelian->Search($config["per_page"], $page,$awal,$akhir),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_pembelian->CountData()
		);
		$this->load->view('view_pembelian',$data);
	}
	
	// Report
	
	function LaporanPertahun(){
		$data = array(
			'supplier'=>$this->Model_pembelian->Supplier()
		);
		$this->load->view('pdf_pembelian',$data);
	}
	
	function LaporanPerperiode(){
		$awal = $this->input->get('awal');
		$akhir = $this->input->get('akhir');
		$data['supplier'] =$this->Model_pembelian->Supplier();
		$this->load->view('pdf_pembelian_periode',$data);
	}
	
	function LaporanPerDaftar(){
		$awal = $this->input->get('awal');
		$akhir = $this->input->get('akhir');
		$total = $this->Model_pembelian->CountData();
		$page = 0;
		$data['data'] = $this->Model_pembelian->Search($total, $page,$awal,$akhir);
		$this->load->view('pdf_pembelian_daftar',$data);
	}
	
}
