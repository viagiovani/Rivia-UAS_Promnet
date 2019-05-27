<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Motor extends CI_Controller {

	var $API ="";

	function __construct() {
		parent::__construct();
		$this->API="https://api.akhmad.id/uaspromnet";

		//api yang sudah di hsoting
		//http://35.240.150.62/index.php/Karyawan
	}

	// proses yang akan di buka saat pertama masuk ke controller
	public function index()
	{
		//$data['user'] = json_decode($this->curl->simple_get($this->API.'/user'));
		//$this->curl->http_header("X-Nim", "1700424");
		//$this->curl->simple_get($this->API.'/user');
		//$this->curl->debug();
		$this->load->view('index');
	}

	public function user(){

		$this->curl->http_header("X-Nim", "1700424");
		$data['user'] = json_decode($this->curl->simple_get($this->API.'/user'));
		$this->load->view('vData/user', $data);
	}

	public function motor(){
		$this->curl->http_header("X-Nim", "1700424");
		$data['motor'] = json_decode($this->curl->simple_get($this->API.'/motor'))->data;
		
		$this->curl->http_header("X-Nim", "1700424");
		$data['tenor'] = json_decode($this->curl->simple_get($this->API.'/cicil'))->data;
		
		$this->curl->http_header("X-Nim", "1700424");
		$data['dp'] = json_decode($this->curl->simple_get($this->API.'/uangmuka'))->data;
		//$this->curl->debug();
		$this->load->view('vData/motor', $data);
	}

	public function penjualan(){

		$this->curl->http_header("X-Nim", "1700424");
		$data['jual'] = json_decode($this->curl->simple_get($this->API.'/penjualan'))->data->terjual;
		//$this->curl->debug();

		$this->curl->http_header("X-Nim", "1700424");
		$data['motor'] = json_decode($this->curl->simple_get($this->API.'/motor'))->data;
		
		$this->curl->http_header("X-Nim", "1700424");
		$data['tenor'] = json_decode($this->curl->simple_get($this->API.'/cicil'))->data;
		
		$this->curl->http_header("X-Nim", "1700424");
		$data['dp'] = json_decode($this->curl->simple_get($this->API.'/uangmuka'))->data;


		$this->load->view('vData/penjualan', $data);
	}

	function add(){

		$mtr = $this->input->post('motor');
		$cicil = $this->input->post('cicil');
		$dp = $this->input->post('dp');

		$this->curl->http_header("X-Nim", "1700424");
		$motor = json_decode($this->curl->simple_get($this->API.'/motor'))->data;
		foreach ($motor as $key ) {
			if ($key->id_motor == $mtr) {
				$harga = $key->harga_motor;
			}
		}

		$this->curl->http_header("X-Nim", "1700424");
		$tenor = json_decode($this->curl->simple_get($this->API.'/cicil'))->data;
		foreach ($tenor as $key ) {
			if ($key->id_cicil == $cicil) {
				$bunga = $key->bunga;
			}
		}


		$data = array(
			'id_motor'      =>  $mtr,
			'id_cicil'    =>  $cicil,
			'id_uang_muka'	  =>  $dp,
			'cicilan_pokok' =>  $harga - $bunga,
			'cicilan_bunga' =>  ($harga*$bunga)/12,
			'cicilan_total' =>  $harga + $bunga
		);

		$this->curl->http_header("X-Nim", "1700424");
		$insert =  $this->curl->simple_post($this->API.'/penjualan', $data, array(CURLOPT_BUFFERSIZE => 0));

		if($insert)
		{
			echo "data berhasil ditambahkan";
		}else
		{
			
			$this->session->set_flashdata('hasil','Insert Data Gagal');
		} 

		//redirect('C_Motor');

	}


	// proses untuk menghapus data pada database
	function delete($id){
		if(empty($id)){
			redirect('C_karyawan');
		}else{
			$delete =  $this->curl->simple_delete($this->API.'/Karyawan', array('id'=>$id), array(CURLOPT_BUFFERSIZE => 10));
			if($delete)
			{
				$this->session->set_flashdata('hasil','Delete Data Berhasil');
			}else
			{
				$this->session->set_flashdata('hasil','Delete Data Gagal');
			}

			redirect('C_karyawan');
		}
	}

	//TUGAS : bikin fungsi update di client menggunakan service
	//
	//
	function update($id){

		$data = array(
			'id'      =>  $id,
			'name'    =>  $this->input->post('name'),
			'email'	  =>  $this->input->post('email'),
			'address' =>  $this->input->post('address'),
			'phone'	  =>  $this->input->post('phone'),
			'jabatan'   =>  $this->input->post('jabatan'),
            'status'   =>  $this->input->post('status'),
            'pend_terakhir'   =>  $this->input->post('pend_terakhir'),
            'bidang'   =>  $this->input->post('bidang'),
            'jobdesc'   =>  $this->input->post('jobdesc')  
		);
		$update =  $this->curl->simple_put($this->API.'/Karyawan', $data, array(CURLOPT_BUFFERSIZE => 0));

		if($update)
		{
			$this->session->set_flashdata('hasil','Update Data Berhasil');
		}else
		{
			$this->session->set_flashdata('hasil','Update Data Gagal');
		}

		redirect('C_karyawan');

	}
}
