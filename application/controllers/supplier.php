<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier extends CI_Controller{

	
	function __Construct(){
		parent::__Construct();
		$this->load->library('pagination');
		$this->load->Model('Model_supplier');
		$this->load->helper('form');
	}
	
	function index(){
		$config = array();
        $config["base_url"] = base_url() . "index.php/supplier/page";
        $config["total_rows"] = $this->Model_supplier->CountData();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data Supplier',
			'data'=>$this->Model_supplier->ReadData($config["per_page"], $page),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_supplier->CountData()
		);
		$this->load->view('view_supplier',$data);
	}
	
	function page(){
		$config = array();
        $config["base_url"] = base_url() . "index.php/supplier/page";
        $config["total_rows"] = $this->Model_supplier->CountData();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data Supplier',
			'data'=>$this->Model_supplier->ReadData($config["per_page"], $page),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_supplier->CountData()
		);
		$this->load->view('view_supplier',$data);
	}
	
	function Save(){
		$data['no_supplier'] = $this->input->post('no_supplier');
		$data['nama'] = $this->input->post('nama');
		$data['telp'] = $this->input->post('telp');
		$data['alamat'] = $this->input->post('alamat');
		$this->Model_supplier->Save($data);
	}
	
	function Edit(){
		$id = $this->input->get('id');
		$data = $this->Model_supplier->Edit($id);
		echo $json_encode = json_encode($data);
	}
	
	function Update(){
		$id = $this->input->post('no_supplier');
		$data['nama'] = $this->input->post('nama');
		$data['telp'] = $this->input->post('telp');
		$data['alamat'] = $this->input->post('alamat');
		$this->Model_supplier->Update($data,$id);
	}
	
	function Delete(){
		$id = $this->input->get('id');
		$this->Model_supplier->Delete($id);
	}

	function ListPencarian(){
		echo "<option></option>";
		$data = $this->Model_supplier->ListPencarian();
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
        $config["base_url"] = base_url() . "index.php/supplier/page";
        $config["total_rows"] = $this->Model_supplier->CountData();
        $config["per_page"] = $this->Model_supplier->CountData();
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data Supplier',
			'data'=>$this->Model_supplier->SearchData($config["per_page"], $page,$kategori,$value),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_supplier->CountData()
		);
		$this->load->view('view_supplier',$data);
	}
	
	function cetak(){
		$jml_data = $this->Model_supplier->CountData();
		$data['data'] = $this->Model_supplier->ReadData($jml_data,0);
		$data['jml_data'] = $this->Model_supplier->CountData();
		$this->load->view('pdf_supplier',$data);
	}
	
	function CreateID(){
		echo $this->Model_supplier->CreateID();
	}
	
}
