<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apel_pagi extends CI_Controller {

	function __Construct()
	{
		parent:: __Construct();
			$this->load->model('M_apel_pagi');
			$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('v_apelpagi');
	}

	public function simpan_apel()
	{
		$NIP=$this->input->post('NIP');
		$data=array(
						'NIP'=>$NIP
		);

		$this->M_apel_pagi->simpan_apelpagi($data);
		echo "OK";
	}

	public function tampil_apel()
	{
		$data['query']=$this->M_apel_pagi->cari_apel();
		$this->load->view('v_apel_pagi',$data);
	}

	public function hapus($id)
	{
		$a=$this->M_apel_pagi->hapus_apelpagi($id);
		echo "OK";
	}

	public function edit_apel()
	{
		$id=$this->input->get('id');
		$a['data']=$this->M_apel_pagi->cari_id($id);
		$this->load->view('v_edit_apel',$a);
		
	}

	public function simpan_edit()
	{
		$id=$this->input->post('id');
		$NIP=$this->input->post('NIP');

		$this->M_apel_pagi->edit_data($id,$NIP);

		echo "OK";
	}

}
