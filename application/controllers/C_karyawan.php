<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_karyawan extends CI_Controller {

	var $API ="";

	function __construct() {
		parent::__construct();
		$this->API="http://localhost/web_service/service/index.php";

		//api yang sudah di hsoting
		//http://35.240.150.62/index.php/Karyawan
	}

	// proses yang akan di buka saat pertama masuk ke controller
	public function index()
	{
		$data['karyawan'] = json_decode($this->curl->simple_get($this->API.'/Karyawan'));

		$this->curl->http_header("coba");


		$this->load->view('V_karyawan', $data);
	}

	// proses untuk menambah data
	// insert data kontak
	function add(){

		$data = array(
			'id'      =>  $this->input->post('id'),
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
		$insert =  $this->curl->simple_post($this->API.'/Karyawan', $data, array(CURLOPT_BUFFERSIZE => 0));

		if($insert)
		{
			$this->session->set_flashdata('hasil','Insert Data Berhasil');
		}else
		{
			$this->session->set_flashdata('hasil','Insert Data Gagal');
		}

		redirect('C_karyawan');

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
