
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cashier extends CI_Controller{
	
	function __Construct(){
		parent::__Construct();
		$this->load->library('session');
		$this->load->model('Model_cashier');
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
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m-d');
		$data['title'] = 'Bayar Cashier';
		$data['no_casheir'] = $this->Username();
		$data['no_struk'] = 'JL'.$this->Model_cashier->CreateID();
		$data['no_check'] = $this->Model_cashier->NoCheck($tanggal);
		$this->load->view('view_cashier',$data);
	}
	
	function ListKategori(){
		$kategori = $this->Model_cashier->Kategori();
		$level = $this->Model_cashier->Level();
		$extra = $this->Model_cashier->Extra();
		echo  "<option></option>";
		
		// Kategori
		foreach($kategori as $kt){
			echo "<optgroup label='".$kt['kategori']."'>";
			
			$q1 = mysql_query("SELECT nama FROM menu WHERE kategori = '".$kt['kategori']."'");
			while($r1 = mysql_fetch_array($q1)){
				echo "<option value='".$r1['nama']."'><center>".$r1['nama']."</center></option>";
			}
			
			echo "</optgroup>";	
		}
		
		// Level
		echo "<optgroup label='LEVEL PEDAS'>";
		foreach($level as $lv){
			echo "<option value='".$lv['nama']."'><center>".$lv['nama']."</center></option>";
		}
		echo "</optgroup>";	
		
		// EXTRA
		echo "<optgroup label='EXTRA MENU'>";
		foreach($extra as $ex){
			echo "<option value='".$ex['nama']."'><center>".$ex['nama']."</center></option>";
		}
		echo "</optgroup>";
		
		
	}
	
	function HargaMenu(){
		$value  = $this->input->get('menu');
		$harga_menu =  $this->Model_cashier->SelectOnce('harga','menu','nama',$value);
		$harga_level =  $this->Model_cashier->SelectOnce('harga','level_pedas','nama',$value);
		$harga_extra =  $this->Model_cashier->SelectOnce('harga','extra','nama',$value);
		
		$cek_menu = $this->Model_cashier->CekData('nama','menu','nama',$value);
		$cek_level = $this->Model_cashier->CekData('nama','level_pedas','nama',$value);
		$cek_extra = $this->Model_cashier->CekData('nama','extra','nama',$value);
		
		if($cek_menu){
			echo $harga_menu;
		}else if($cek_level){
			echo $harga_level;
		}else if($cek_extra){
			echo $harga_extra;
		}else{
			echo "0";
		}
		
	}
	
	
	function SaveData(){
		$data['no_struk'] = $this->input->post('no_struk');
		$data['no_check'] = $this->input->post('no_check');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['waktu'] = $this->input->post('waktu');
		$data['sub_total'] = $this->input->post('in_sub_total');
		$data['diskon'] = $this->input->post('in_diskon');
		$data['potongan'] = $this->input->post('in_potongan');
		$data['total_bayar'] = $this->input->post('in_grand_total');
		$data['cash'] = $this->input->post('cash');
		$data['kembalian'] = $this->input->post('in_kembalian');
		$data['no_casheir'] = $this->Username();
		$this->Model_cashier->SaveData($data);
	}
	
	
	function SaveDetail(){
		$data['no_struk'] = $this->input->get('no_struk');
		$data['tanggal'] = $this->input->get('tanggal');
		$data['item'] = $this->input->get('item');
		
		$value = $this->input->get('item');
		$kat_menu =  $this->Model_cashier->SelectOnce('kategori','menu','nama',$value);
		$kat_level = "LEVEL PEDAS";
		$kat_extra =  "EXTRA TAMBAHAN";
		
		$cek_menu = $this->Model_cashier->CekData('nama','menu','nama',$value);
		$cek_level = $this->Model_cashier->CekData('nama','level_pedas','nama',$value);
		$cek_extra = $this->Model_cashier->CekData('nama','extra','nama',$value);
		
		if($cek_menu){
			$data['kategori'] = $kat_menu;
		}else if($cek_level){
			$data['kategori'] = $kat_level;
		}else if($cek_extra){
			$data['kategori'] = $kat_extra;
		}
		
		$data['harga'] = $this->input->get('harga');
		$data['jumlah'] = $this->input->get('jumlah');
		$data['total'] = $this->input->get('total');
		$this->Model_cashier->SaveDetail($data);
	}
	
	
	
	
}