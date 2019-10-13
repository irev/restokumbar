<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bahan extends CI_Controller{

	
	function __Construct(){
		parent::__Construct();
		$this->load->library('pagination');
		$this->load->Model('Model_bahan');
		$this->load->helper('form');
	}
	
	function index(){
		$config = array();
        $config["base_url"] = base_url() . "index.php/bahan/page";
        $config["total_rows"] = $this->Model_bahan->CountData();
        $config["per_page"] =  $this->Model_bahan->CountData();
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data Bahan',
			'data'=>$this->Model_bahan->ReadData($config["per_page"], $page),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_bahan->CountData()
		);
		$this->load->view('view_bahan',$data);
	}
	
	function page(){
		$config = array();
        $config["base_url"] = base_url() . "index.php/bahan/page";
        $config["total_rows"] = $this->Model_bahan->CountData();
        $config["per_page"] =  $this->Model_bahan->CountData();
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data Bahan',
			'data'=>$this->Model_bahan->ReadData($config["per_page"], $page),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_bahan->CountData()
		);
		$this->load->view('view_bahan',$data);
	}
	
	function Satuan(){
		echo "<option></option>";
		$data = $this->Model_bahan->Satuan();
		foreach($data as $data){
			echo "<option value='".$data['value']."'>".$data['value']."</option>";
		}
	}
	
	function Supplier(){
		echo "<option></option>";
		$data = $this->Model_bahan->Supplier();
		foreach($data as $data){
			echo "<option value='".$data['nama']."'>".$data['nama']."</option>";
		}
	}
	
	function Save(){
		$data['no_bahan'] = $this->input->post('no_bahan');
		$data['nama'] = $this->input->post('nama');
		$data['harga'] = $this->input->post('harga');
		$data['stok'] = $this->input->post('stok');
		$data['satuan'] = $this->input->post('satuan');
		$data['supplier'] = $this->input->post('supplier');
		$this->Model_bahan->Save($data);
	}
	
	function Edit(){
		$id = $this->input->get('id');
		$data = $this->Model_bahan->Edit($id);
		echo $json_encode = json_encode($data);
	}
	
	function Update(){
		$id = $this->input->post('no_bahan');
		$data['nama'] = $this->input->post('nama');
		$data['harga'] = $this->input->post('harga');
		$data['stok'] = $this->input->post('stok');
		$data['satuan'] = $this->input->post('satuan');
		$data['supplier'] = $this->input->post('supplier');
		$this->Model_bahan->Update($data,$id);
	}
	
	function Delete(){
		$id = $this->input->get('no_bahan');
		$this->Model_bahan->Delete($id);
	}

	function ListPencarian(){
		echo "<option></option>";
		$data = $this->Model_bahan->ListPencarian();
		foreach($data as $data){
			if($data['Field']!='id'){
				echo "<option value='".$data['Field']."'>".strtoupper($data['Field'])."</option>";
			}
		}
	}
	
	function Search(){
		$value = $this->input->get('txtcari');
		$kategori = $this->input->get('cari');
		$config = array();
        $config["base_url"] = base_url() . "index.php/bahan/page";
        $config["total_rows"] = $this->Model_bahan->CountData();
        $config["per_page"] = $this->Model_bahan->CountData();
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data Bahan',
			'data'=>$this->Model_bahan->SearchData($config["per_page"], $page,$kategori,$value),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_bahan->CountData()
		);
		$this->load->view('view_bahan',$data);
	}
	
	function cetak(){
		$jml_data = $this->Model_bahan->CountData();
		$data['data'] = $this->Model_bahan->ReadData($jml_data,0);
		$data['jml_data'] = $this->Model_bahan->CountData();
		$this->load->view('pdf_bahan',$data);
	}
	
	function CreateID(){
		echo $this->Model_bahan->CreateID();
	}
	
	function UpdateStok(){
		$id = $this->input->get('id');
		$this->Model_bahan->UpdateStok($id);
	}
	
}
