<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller{

	function __Construct(){
		parent::__Construct();
		$this->load->Model('Model_menu');
		$this->load->helper('form');
		$this->load->library('pagination');
	}
	
	function index(){
		$config = array();
        $config["base_url"] = base_url() . "index.php/menu/page";
        $config["total_rows"] = $this->Model_menu->CountData();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data Menu',
			'data'=>$this->Model_menu->ReadData($config["per_page"], $page),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_menu->CountData()
		);
		$this->load->view('view_menu',$data);
	}
	
	function page(){
		$config = array();
        $config["base_url"] = base_url() . "index.php/menu/page";
        $config["total_rows"] = $this->Model_menu->CountData();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data Menu',
			'data'=>$this->Model_menu->ReadData($config["per_page"], $page),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_menu->CountData()
		);
		$this->load->view('view_menu',$data);
	}
	
	function ListKategori(){
		echo "<option></option>";
		$data = $this->Model_menu->GetKategori();
		foreach($data as $data){
			echo "<option value='".$data['kategori']."'>".$data['kategori']."</option>";
		}
	}
	
	
	function LoadMenu(){
		$kategori = $this->input->get('kategori');	
		$data = $this->Model_menu->get_menu($kategori);
		echo $json_encode = json_encode($data);
	}
	
	function get_menu_all(){
		$data = $this->Model_menu->get_menu_all();
		echo $json_encode = json_encode($data);
	}	
	
	function save(){
		$data['no_menu'] = $this->input->post('no_menu');
		$data['nama'] = $this->input->post('nama');
		$data['kategori'] = $this->input->post('kategori');
		$data['harga'] = $this->input->post('harga');
		$data['rekomendasi'] = $this->input->post('rekomendasi');
		$this->Model_menu->save($data);
	}
	
	function update(){
		$no_menu = $this->input->post('no_menu');
		$data['nama'] = $this->input->post('nama');
		$data['kategori'] = $this->input->post('kategori');
		$data['harga'] = $this->input->post('harga');
		$data['rekomendasi'] = $this->input->post('rekomendasi');
		$this->Model_menu->update($data,$no_menu);
	}
	
	function edit(){
		$no_menu = $this->input->get('no_menu');
		$data = $this->Model_menu->edit($no_menu);
		echo $json_encode = json_encode($data);
	}
	
	
	function delete(){
		$no_menu = $this->input->get('no_menu');
		$this->Model_menu->delete($no_menu);
	}
	
	function ListPencarian(){
		echo "<option></option>";
		$data = $this->Model_menu->ListPencarian();
		foreach($data as $data){
		     if($data['Field']!='no_menu'){
				echo "<option value='".$data['Field']."'>".strtoupper($data['Field'])."</option>";
			 }
		}
	}
	
	function search(){
		$value = $this->input->get('txtcari');
		$kategori = $this->input->get('cari');
		$config = array();
        $config["base_url"] = base_url() . "index.php/menu/page";
        $config["total_rows"] = $this->Model_menu->CountData();
        $config["per_page"] = $this->Model_menu->CountData();
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data Menu',
			'data'=>$this->Model_menu->SearchData($config["per_page"], $page,$kategori,$value),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_menu->CountData()
		);
		$this->load->view('view_menu',$data);
	}
	
	function cetak(){
		$jml_data = $this->Model_menu->CountData();
		$data['data'] = $this->Model_menu->ReadData($jml_data,0);
		$data['jml_data'] = $this->Model_menu->CountData();
		$this->load->view('pdf_menu',$data);
	}
	
	function CreateID(){
		$kategori = $this->input->get('kategori');
		$no_menu_kategori =  $this->Model_menu->KodeKategori($kategori);
		$data_no_menu = $this->Model_menu->CreateID($kategori);
		echo 'M'.$no_menu_kategori.''.$data_no_menu;
	}
	

}
