<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hukuman extends CI_Controller {


	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');		
		
		$this->load->model('m_hukuman');
		$this->load->helper('custom_func');
		
		
		if ($this->session->userdata('FID')=="") 
		{
			redirect('index.php/login');
		}
		
		$this->load->helper('text');
		date_default_timezone_set("Asia/jakarta");
	}
	
	
	function index()
	{
		
		
		$this->load->view('template/part/form_hukuman.php');
		
	}
	
	function simpan_hukuman()
	{
		
		
		var_dump($this->input->post());
		
		$judul 		= $this->input->post('judul');
		$tanggal 	= $this->input->post('tanggal');
		$hukuman 	= $this->input->post('hukuman');
		$NIP_REFF 	= $this->input->post('NIP_REFF');
		$NIP 	= $this->input->post('NIP');
		
		
		$arr = array(
					"judul"=>$judul,
					"tanggal"=>$tanggal,
					"hukuman"=>$hukuman,
					"NIP_REFF"=>$NIP_REFF						
					);
		
		
		$id_apel = $this->m_hukuman->m_simpan_apel_pagi($arr);
		
		foreach($NIP as $a)
		{
			
			if($a != '')
			{
				$data = array(
							"id_apel" => $id_apel,
							"NIP" => $a,
							"tgl" => $tanggal
						);
				$this->db->insert('tbl_apel_pagi_nip',$data);
			}
			
		}
		
		
	}
	
	function data_hukuman()
	{
		
		$data['hukuman'] = $this->m_hukuman->m_tbl_apel_pagi();
		
		$this->load->view("template/part/tbl_hukuman",$data);
	}
	
	function lihat_semua_nip($id)
	{
		
		$data['nip'] = $this->m_hukuman->m_tbl_apel_pagi_nip($id);
		
		$this->load->view("template/part/tbl_nip",$data);
	}
	

	function hapus_hukuman($id)
    {
    	$this->db->query("DELETE FROM tbl_apel_pagi_nip WHERE id_apel='$id'");
    	$this->db->query("DELETE FROM tbl_apel_pagi WHERE id='$id'");
    }


	function ambil_hukuman()
    {
    	header('Content-Type: application/json');
    	$NIP = $this->input->get('NIP');
    	$tanggal=$this->input->get('tanggal');
    	$q = $this->db->query("SELECT 
                            a.id,
                            a.judul,
                            a.tanggal,
                            a.hukuman,
                            a.NIP_REFF,
                            b.NIP
                            
                            FROM tbl_apel_pagi a 
                            INNER JOIN(
                                SELECT NIP,id_apel FROM `tbl_apel_pagi_nip` 
                                WHERE NIP ='$NIP'
                                GROUP BY id_apel
                                )b 
                                
                            ON a.id=b.id_apel
                            WHERE tanggal='$tanggal'");
    	$data = $q->result();
    	echo json_encode($data);
    }
	
}
