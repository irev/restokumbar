<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Extra extends CI_Controller{

	
	function __Construct(){
		parent::__Construct();
		$this->load->library('pagination');
		$this->load->Model('Model_extra');
		$this->load->helper('form');
	}
	
	function index(){
		$config = array();
        $config["base_url"] = base_url() . "index.php/extra/page";
        $config["total_rows"] = $this->Model_extra->CountData();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data extra',
			'data'=>$this->Model_extra->ReadData($config["per_page"], $page),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_extra->CountData()
		);
		$this->load->view('view_extra',$data);
	}
	
	function page(){
		$config = array();
        $config["base_url"] = base_url() . "index.php/extra/page";
        $config["total_rows"] = $this->Model_extra->CountData();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data extra',
			'data'=>$this->Model_extra->ReadData($config["per_page"], $page),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_extra->CountData()
		);
		$this->load->view('view_extra',$data);
	}
	
	function Satuan(){
		echo "<option></option>";
		$data = $this->Model_extra->Satuan();
		foreach($data as $data){
			echo "<option value='".$data['value']."'>".$data['value']."</option>";
		}
	}
	
	function Supplier(){
		echo "<option></option>";
		$data = $this->Model_extra->Supplier();
		foreach($data as $data){
			echo "<option value='".$data['nama']."'>".$data['nama']."</option>";
		}
	}
	
	function Save(){
		$data['no_extra'] = $this->input->post('no_extra');
		$data['nama'] = $this->input->post('nama');
		$data['harga'] = $this->input->post('harga');
		$this->Model_extra->Save($data);
	}
	
	function Edit(){
		$id = $this->input->get('id');
		$data = $this->Model_extra->Edit($id);
		echo $json_encode = json_encode($data);
	}
	
	function Update(){
		$id = $this->input->post('no_extra');
		$data['nama'] = $this->input->post('nama');
		$data['harga'] = $this->input->post('harga');
		$this->Model_extra->Update($data,$id);
	}
	
	function Delete(){
		$id = $this->input->get('no_extra');
		$this->Model_extra->Delete($id);
	}

	function ListPencarian(){
		echo "<option></option>";
		$data = $this->Model_extra->ListPencarian();
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
        $config["base_url"] = base_url() . "index.php/extra/page";
        $config["total_rows"] = $this->Model_extra->CountData();
        $config["per_page"] = $this->Model_extra->CountData();
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data extra',
			'data'=>$this->Model_extra->SearchData($config["per_page"], $page,$kategori,$value),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_extra->CountData()
		);
		$this->load->view('view_extra',$data);
	}
	
	function cetak(){
		$jml_data = $this->Model_extra->CountData();
		$data['data'] = $this->Model_extra->ReadData($jml_data,0);
		$data['jml_data'] = $this->Model_extra->CountData();
		$this->load->view('pdf_extra',$data);
	}
	
	function CreateID(){
		echo $this->Model_extra->CreateID();
	}
	
}
