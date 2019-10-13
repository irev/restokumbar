<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller{

	
	function __Construct(){
		parent::__Construct();
		$this->load->library('pagination');
		$this->load->Model('Model_member');
		$this->load->helper('form');
	}
	
	function CreateID(){
		echo "CSM".$this->Model_member->CreateID();
	}
	
	function index(){
		$config = array();
        $config["base_url"] = base_url() . "index.php/member/page";
        $config["total_rows"] = $this->Model_member->CountData();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data Bahan',
			'data'=>$this->Model_member->ReadData($config["per_page"], $page),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_member->CountData()
		);
		$this->load->view('view_member',$data);
	}
	
	function page(){
		$config = array();
        $config["base_url"] = base_url() . "index.php/member/page";
        $config["total_rows"] = $this->Model_member->CountData();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data Bahan',
			'data'=>$this->Model_member->ReadData($config["per_page"], $page),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_member->CountData()
		);
		$this->load->view('view_member',$data);
	}
	
	function Save(){
		$tanggal =  $this->input->post('tgl_register');
		$hari = 365;
		$data['id'] = $this->input->post('id');
		$data['tgl_register'] = $this->input->post('tgl_register');
		$data['nama_lengkap'] = $this->input->post('nama_lengkap');
		$data['tempat_lahir'] = $this->input->post('tempat_lahir');
		$data['gender'] = $this->input->post('gender');
		$data['alamat'] = $this->input->post('alamat');
		$data['telp'] = $this->input->post('telp');
		$data['email'] = $this->input->post('email');
		$data['facebook'] = $this->input->post('facebook');
		$data['twitter'] = $this->input->post('twitter');
		$data['tgl_valid'] = date('Y-m-d', strtotime($tanggal .' +'.$hari.' day'));
		$data['tgl_lahir'] = $this->input->post('tgl_lahir');
		$this->Model_member->Save($data);
	}
	
	function Edit(){
		$id = $this->input->get('id');
		$data = $this->Model_member->Edit($id);
		echo $json_encode = json_encode($data);
	}
	
	function Update(){
		$id = $this->input->post('id');
		$tanggal =  $this->input->post('tgl_register');
		$hari = 365;
		$data['id'] = $this->input->post('id');
		$data['tgl_register'] = $this->input->post('tgl_register');
		$data['nama_lengkap'] = $this->input->post('nama_lengkap');
		$data['tempat_lahir'] = $this->input->post('tempat_lahir');
		$data['gender'] = $this->input->post('gender');
		$data['alamat'] = $this->input->post('alamat');
		$data['telp'] = $this->input->post('telp');
		$data['email'] = $this->input->post('email');
		$data['facebook'] = $this->input->post('facebook');
		$data['twitter'] = $this->input->post('twitter');
		$data['tgl_valid'] = date('Y-m-d', strtotime($tanggal .' +'.$hari.' day'));
		$data['tgl_lahir'] = $this->input->post('tgl_lahir');
		$this->Model_member->Update($data,$id);
	}
	
	function Delete(){
		$id = $this->input->get('id');
		$this->Model_member->Delete($id);
	}

	function ListPencarian(){
		echo "<option></option>";
		$data = $this->Model_member->ListPencarian();
		foreach($data as $data){
			echo "<option value='".$data['Field']."'>".strtoupper($data['Field'])."</option>";
		}
	}
	
	function Search(){
		$value = $this->input->get('txtcari');
		$kategori = $this->input->get('cari');
		$config = array();
        $config["base_url"] = base_url() . "index.php/member/page";
        $config["total_rows"] = $this->Model_member->CountData();
        $config["per_page"] = $this->Model_member->CountData();
        $config["uri_segment"] = 3;
		$config['first_link'] = 'Pertama';
		$config['last_link'] = 'Terakhir';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data = array(
			'title'=>'Data Bahan',
			'data'=>$this->Model_member->SearchData($config["per_page"], $page,$kategori,$value),
			'links'=>$this->pagination->create_links(),
			'page'=>$page,
			'totaldata'=>$this->Model_member->CountData()
		);
		$this->load->view('view_member',$data);
	}
	
}
