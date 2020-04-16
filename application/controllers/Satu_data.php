<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satu_data extends CI_Controller {

	function __Construct()
	{
		parent:: __Construct();
			$this->load->model('M_satu_data');
			$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('v_admin_satu_data');
	}

	public function simpan_satu()
	{
		$NIP=$this->input->post('NIP');
		$data=array(
						'NIP'=>$NIP
		);

		$this->M_satu_data->simpan_satudata($data);
		echo "OK";
	}

	public function tampil_satudata()
	{
		$data['query']=$this->M_satu_data->cari_satudata();
		$this->load->view('v_tampil_satudata',$data);
	}

	public function hapus_satu()
	{
		$id=$this->input->get('id');
		$a=$this->M_satu_data->hapus_satudata($id);
		echo "OK";
	}

	public function edit_satu()
	{
		$id=$this->input->get('id');
		$a['data']=$this->M_satu_data->cari_id($id);
		$this->load->view('v_editsatu',$a);
		
	}

	public function simpan_edit()
	{
		$id=$this->input->post('id');
		$NIP=$this->input->post('NIP');

		$this->M_satu_data->edit_data($id,$NIP);

		echo "OK";
	}
}
