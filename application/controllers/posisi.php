<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posisi extends CI_Controller{

	function __Construct(){
		parent::__Construct();
		$this->load->Model('Model_posisi');
		$this->load->helper('form');
		$this->load->library('pagination');
	}
	
	function index(){
		$config = array();
        $config["base_url"] = base_url() . "index.php/posisi/page";
        $config["total_rows"] = $this->Model_posisi->CountData();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data posisi',
			'data'=>$this->Model_posisi->ReadData($config["per_page"], $page),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_posisi->CountData()
		);
		$this->load->view('view_posisi',$data);
	}
	
	function page(){
		$config = array();
        $config["base_url"] = base_url() . "index.php/posisi/page";
        $config["total_rows"] = $this->Model_posisi->CountData();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data posisi',
			'data'=>$this->Model_posisi->ReadData($config["per_page"], $page),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_posisi->CountData()
		);
		$this->load->view('view_posisi',$data);
	}

	
	function save(){
		$data['no_posisi'] = $this->input->post('no_posisi');
		$data['nama'] = $this->input->post('nama');
		$this->Model_posisi->save($data);
	}
	
	function update(){
		$id = $this->input->post('no_posisi');
		$data['nama'] = $this->input->post('nama');
		$this->Model_posisi->update($data,$id);
	}
	
	function edit(){
		$id = $this->input->get('id');
		$data = $this->Model_posisi->edit($id);
		echo $json_encode = json_encode($data);
	}
	
	
	function delete(){
		$id = $this->input->get('id');
		$this->Model_posisi->delete($id);
	}
	

}