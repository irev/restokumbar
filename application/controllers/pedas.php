<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedas extends CI_Controller{

	function __Construct(){
		parent::__Construct();
		$this->load->Model('Model_pedas');
		$this->load->helper('form');
		$this->load->library('pagination');
	}
	
	function index(){
		$config = array();
        $config["base_url"] = base_url() . "index.php/pedas/page";
        $config["total_rows"] = $this->Model_pedas->CountData();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data pedas',
			'data'=>$this->Model_pedas->ReadData($config["per_page"], $page),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_pedas->CountData()
		);
		$this->load->view('view_pedas',$data);
	}
	
	function page(){
		$config = array();
        $config["base_url"] = base_url() . "index.php/pedas/page";
        $config["total_rows"] = $this->Model_pedas->CountData();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data pedas',
			'data'=>$this->Model_pedas->ReadData($config["per_page"], $page),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_pedas->CountData()
		);
		$this->load->view('view_pedas',$data);
	}

	
	function save(){
		$data['no_level'] = $this->input->post('no_level');
		$data['nama'] = $this->input->post('nama');
		$data['harga'] = $this->input->post('harga');
		$data['cabe'] = $this->input->post('cabe');
		$this->Model_pedas->save($data);
	}
	
	function update(){
		$id = $this->input->post('no_level');
		$data['nama'] = $this->input->post('nama');
		$data['harga'] = $this->input->post('harga');
		$data['cabe'] = $this->input->post('cabe');
		$this->Model_pedas->update($data,$id);
	}
	
	function edit(){
		$id = $this->input->get('id');
		$data = $this->Model_pedas->edit($id);
		echo $json_encode = json_encode($data);
	}
	
	
	function delete(){
		$id = $this->input->get('id');
		$this->Model_pedas->delete($id);
	}
	
	function CreateID(){
		echo  $this->Model_pedas->CreateID();
	}
	

}