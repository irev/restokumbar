<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');class Pegawai extends CI_Controller{		function __Construct(){		parent::__Construct();		$this->load->library('pagination');		$this->load->Model('Model_pegawai');		$this->load->helper('form');	}				function index(){		$config = array();        $config["base_url"] = base_url() . "index.php/pegawai/page";        $config["total_rows"] = $this->Model_pegawai->CountData();        $config["per_page"] = 20;        $config["uri_segment"] = 3;		$config['first_link'] = 'Pertama';		$config['last_link'] = 'Terakhir';        $this->pagination->initialize($config);        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;		$data = array(			'title'=>'Data Pegawai',			'data'=>$this->Model_pegawai->ReadData($config["per_page"], $page),			'links'=>$this->pagination->create_links(),			'page'=>$page,			'totaldata'=>$this->Model_pegawai->CountData()		);		$this->load->view('view_pegawai',$data);	}		function page(){		$config = array();        $config["base_url"] = base_url() . "index.php/pegawai/page";        $config["total_rows"] = $this->Model_pegawai->CountData();        $config["per_page"] = 20;        $config["uri_segment"] = 3;		$config['first_link'] = 'Pertama';		$config['last_link'] = 'Terakhir';        $this->pagination->initialize($config);        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;		$data = array(			'title'=>'Data Pegawai',			'data'=>$this->Model_pegawai->ReadData($config["per_page"], $page),			'links'=>$this->pagination->create_links(),			'page'=>$page,			'totaldata'=>$this->Model_pegawai->CountData()		);		$this->load->view('view_pegawai',$data);	}		function CreateID($posisi,$inisial){		$kode_posisi = $this->Model_pegawai->NoPosisi($posisi);		$kd =  'P'.''.$kode_posisi.''.$this->Model_pegawai->CreateID($posisi,$inisial);		return $kd; 	}		function Save(){		$nama = $this->input->post('nama_lengkap');		$posisi = $this->input->post('posisi');		$data['nama_lengkap'] = $this->input->post('nama_lengkap');		$data['tgl_lahir'] = $this->input->post('tgl_lahir');		$data['tgl_register'] = $this->input->post('tgl_register');		$data['gender'] = $this->input->post('gender');		$data['telp'] = $this->input->post('telp');		$data['alamat'] = $this->input->post('alamat');		$data['posisi'] = $this->input->post('posisi');				$nama_lengkap = explode(" ",$nama);		$first = substr($nama_lengkap[0],0,1);		if(count($nama_lengkap)>1){			$end = substr($nama_lengkap[1],0,1);		}else{			$end = substr($nama_lengkap[0],count($nama_lengkap)-2,1);		}		$inisial = $first.''.$end;		$data['no_pegawai'] = $this->CreateID($posisi,$inisial);		$data['inisial'] = $inisial;		if($posisi=='Casheir'){			$data['password'] = md5($this->CreateID($posisi,$inisial));		}else{			$data['password'] = '-----';		}		$this->Model_pegawai->Save($data);	}			function Edit(){		$id = $this->input->get('id');		$data = $this->Model_pegawai->Edit($id);		echo $json_encode = json_encode($data);	}		function Update(){		$id = $this->input->post('no_pegawai');		$data['no_pegawai'] = $this->input->post('no_pegawai');		$data['nama_lengkap'] = $this->input->post('nama_lengkap');		$data['tgl_lahir'] = $this->input->post('tgl_lahir');		$data['tgl_register'] = $this->input->post('tgl_register');		$data['gender'] = $this->input->post('gender');		$data['telp'] = $this->input->post('telp');		$data['alamat'] = $this->input->post('alamat');		$data['posisi'] = $this->input->post('posisi');		$this->Model_pegawai->Update($data,$id);	}		function Delete(){		$id = $this->input->get('id');		$this->Model_pegawai->Delete($id);	}	function ListPencarian(){		echo "<option></option>";		$data = $this->Model_pegawai->ListPencarian();		foreach($data as $data){			echo "<option value='".$data['Field']."'>".strtoupper($data['Field'])."</option>";		}	}		function Search(){		$value = $this->input->get('txtcari');		$kategori = $this->input->get('cari');		$config = array();        $config["base_url"] = base_url() . "index.php/pegawai/page";        $config["total_rows"] = $this->Model_pegawai->CountData();        $config["per_page"] = $this->Model_pegawai->CountData();        $config["uri_segment"] = 3;		$config['first_link'] = 'Pertama';		$config['last_link'] = 'Terakhir';        $this->pagination->initialize($config);        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;		$data = array(			'title'=>'Data Pegawai',			'data'=>$this->Model_pegawai->SearchData($config["per_page"], $page,$kategori,$value),			'links'=>$this->pagination->create_links(),			'page'=>$page,			'totaldata'=>$this->Model_pegawai->CountData()		);		$this->load->view('view_pegawai',$data);	}		function cetak(){		$jml_data = $this->Model_pegawai->CountData();		$data['data'] = $this->Model_pegawai->ReadData($jml_data,0);		$data['jml_data'] = $this->Model_pegawai->CountData();		$this->load->view('pdf_pegawai',$data);	}		function Posisi(){		$data = $this->Model_pegawai->Posisi();		echo "<option></option>";		foreach($data as $data){			echo "<option value = '".$data['nama']."'>".$data['nama']."</option>";		}	}	}