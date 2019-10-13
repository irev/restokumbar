<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembayaran extends CI_Controller{

	
	function __Construct(){
		parent::__Construct();
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->Model('Model_pembayaran');
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
        $config["base_url"] = base_url() . "index.php/pembayaran/page";
        $config["total_rows"] = $this->Model_pembayaran->CountData();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data Bahan',
			'data'=>$this->Model_pembayaran->ReadData($config["per_page"], $page),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_pembayaran->CountData()
		);
		$this->load->view('view_pembayaran',$data);
	}
	
	function page(){
		$config = array();
        $config["base_url"] = base_url() . "index.php/pembayaran/page";
        $config["total_rows"] = $this->Model_pembayaran->CountData();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data Bahan',
			'data'=>$this->Model_pembayaran->ReadData($config["per_page"], $page),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_pembayaran->CountData()
		);
		$this->load->view('view_pembayaran',$data);
	}
	
	function add(){
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m-d');
		$data['title'] = 'Transaksi pembayaran';
		$data['no_casheir'] = $this->Username();
		$data['no_struk'] = 'BR'.$this->Model_pembayaran->CreateID();
		$this->load->view('view_add_pembayaran',$data);
	}
	
	
	function SaveData(){
		$data['no_pembayaran'] = $this->input->post('no_pembayaran');
		$data['no_casheir'] = $this->Username();
		$data['no_bukti'] = $this->input->post('no_bukti');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['waktu'] = $this->input->post('waktu');
		$data['keterangan'] = $this->input->post('keterangan');
		$data['total_bayar'] = $this->input->post('tobar');
		$this->Model_pembayaran->SaveData($data);
	}
	
	function SaveDetail(){
		$data['no_pembayaran'] = $this->input->get('no_pembayaran');
		$data['tanggal']= $this->input->get('tanggal');
		$data['item'] = $this->input->get('item');
		$data['harga'] = $this->input->get('harga');
		$data['jumlah'] = $this->input->get('jumlah');
		$data['total'] = $this->input->get('total');
		$this->Model_pembayaran->SaveDetail($data);
	}
	
	function CetakFaktur(){
		$id = $this->input->get('id');
		$data['data'] = $this->Model_pembayaran->Faktur($id);
		$this->load->view('pdf_faktur_pembayaran',$data);
	}
	
	function Delete(){
		$no_pembayaran = $this->input->get('no_struk');
		$this->Model_pembayaran->Delete($no_pembayaran);
	}
	
	function ShowDetail(){
		$no_struk = $this->input->get('no_struk');
		$data = $this->Model_pembayaran->ShowDetail($no_struk);
		echo $json_encode = json_encode($data);
	}
	
	function Search(){
		$awal = $this->input->get('awal');
		$akhir = $this->input->get('akhir');
		$config = array();
        $config["base_url"] = base_url() . "index.php/pembayaran/page";
        $config["total_rows"] = $this->Model_pembayaran->CountData();
        $config["per_page"] = $this->Model_pembayaran->CountData();
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Pencarian Data',
			'data'=>$this->Model_pembayaran->Search($config["per_page"], $page,$awal,$akhir),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_pembayaran->CountData()
		);
		$this->load->view('view_pembayaran',$data);
	}
	
	// Report
	
	
	function LaporanPerperiode(){
		$awal = $this->input->get('awal');
		$akhir = $this->input->get('akhir');
		$data['bayar'] =$this->Model_pembayaran->ListPembayaran();
		$this->load->view('pdf_pembayaran_periode',$data);
	}
	
	function LaporanPerDaftar(){
		$awal = $this->input->get('awal');
		$akhir = $this->input->get('akhir');
		$total = $this->Model_pembayaran->CountData();
		$page = 0;
		$data['data'] = $this->Model_pembayaran->Search($total, $page,$awal,$akhir);
		$this->load->view('pdf_pembayaran_daftar',$data);
	}
	
	
}
