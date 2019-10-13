<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori extends CI_Controller{

	function __Construct(){
		parent::__Construct();
		$this->load->Model('Model_kategori');
		$this->load->helper('form');
		$this->load->library('pagination');
	}
	
	function index(){
		$config = array();
        $config["base_url"] = base_url() . "index.php/kategori/page";
        $config["total_rows"] = $this->Model_kategori->CountData();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data kategori',
			'data'=>$this->Model_kategori->ReadData($config["per_page"], $page),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_kategori->CountData()
		);
		$this->load->view('view_kategori',$data);
	}
	
	function page(){
		$config = array();
        $config["base_url"] = base_url() . "index.php/kategori/page";
        $config["total_rows"] = $this->Model_kategori->CountData();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data kategori',
			'data'=>$this->Model_kategori->ReadData($config["per_page"], $page),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_kategori->CountData()
		);
		$this->load->view('view_kategori',$data);
	}

	
	function save(){
		$data['no_kategori'] = $this->input->post('no_kategori');
		$data['kategori'] = $this->input->post('kategori');
		$data['keterangan'] = $this->input->post('keterangan');
		$this->Model_kategori->save($data);
	}
	
	function update(){
		$id = $this->input->post('no_kategori');
		$data['kategori'] = $this->input->post('kategori');
		$data['keterangan'] = $this->input->post('keterangan');
		$this->Model_kategori->update($data,$id);
	}
	
	function edit(){
		$id = $this->input->get('id');
		$data = $this->Model_kategori->edit($id);
		echo $json_encode = json_encode($data);
	}
	
	
	function delete(){
		$id = $this->input->get('id');
		$this->Model_kategori->delete($id);
	}
	

}