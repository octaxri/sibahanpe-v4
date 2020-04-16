<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pimpinan extends CI_Controller {

	function __Construct()
	{
		parent:: __Construct();
			$this->load->model('M_pimpinan');
			$this->load->helper('url');
			$this->load->helper('custom_func');

			date_default_timezone_set("Asia/jakarta");



		
		/***********log firebase*********/
			$this->log_firebase();
		/***********log firebase*********/
	}


	

	private function log_firebase()
	{
		/******************** post ke firebase ************************/
		$array_to_firebase = array(					
					"server"=>$_SERVER['SERVER_ADDR'],
					"client"=>getenv("REMOTE_ADDR"),
					"access_time"=>date('Y-m-d H:i:s'),
					"controller"=>$this->router->fetch_class(),
					"method"=>$this->router->fetch_method(),
					"session"=>$this->session->userdata(),
					"get"=>$this->input->get(),
					"post"=>$this->input->post()
				);      	
      	post_ke_firebase('https://sibahanpe.firebaseio.com/tbl_aktivitas.json',$array_to_firebase);
		/******************** post ke firebase ************************/
	}

	function index()
	{
		$data['OPD'] = $this->db->query("SELECT `ID_OPD`,`OPD` FROM `tbl_struktur` GROUP BY ID_OPD")->result();
    	$this->load->view('v_insert_pimpinan',$data);
	}

	function tambah_pimpinan()
	{
		
		$NIP=$this->input->post('NIP');
		$ID_OPD=$this->input->post('ID_OPD');
        $JABATAN_SET=$this->input->post('JABATAN_SET');
    
    	$this->db->query("DELETE FROM tbl_pimpinan WHERE ID_OPD='$ID_OPD'");

		$data=array(
				
				'NIP'=>$NIP,
				'ID_OPD'=>$ID_OPD,
                'JABATAN_SET'=>$JABATAN_SET
		);
		//var_dump($data);
		$this->M_pimpinan->simpan_pimpinan($data,'tbl_pimpinan');
		echo "OK";
	}

	function tampil_pimpinan()
	{
		$data['query']=$this->M_pimpinan->pimpinan();
		$this->load->view('v_tbl_pimpinan',$data);
	}

	function edit_pimpinan()
	{
		$id_pimpinan=$this->input->get('id');
		$data['query']=$this->M_pimpinan->cari_id($id_pimpinan);
		$this->load->view('v_edit_pimpinan',$data);
	}

	function simpan_edit_pimpinan()
	{
		$id_pimpinan=$this->input->post('id_pimpinan');
		$FID=$this->input->post('FID');
		$NIP=$this->input->post('NIP');
		$ID_OPD=$this->input->post('ID_OPD');

		$data=array(

				'FID'=>$FID,
				'NIP'=>$NIP,
				'ID_OPD'=>$ID_OPD
		);
		$id=array(
			'id_pimpinan'=>$id_pimpinan
		);

		$this->M_pimpinan->simpan_edit($data,$id,'tbl_pimpinan');
		echo "OK";
	}

	function hapus_pimpinan($id_pimpinan)
	{
		

		$this->M_pimpinan->hapus($id_pimpinan);
		echo "OK";
	}

}	