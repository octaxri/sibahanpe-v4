<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote extends CI_Controller {


	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');		
		$this->load->model('m_vote');
		$this->load->helper('custom_func');
		
		
		$this->load->helper('text');
		date_default_timezone_set("Asia/jakarta");
	}
	
	



	public function rekap_laporan()
	{
		
		ini_set('memory_limit', '2048M');
    	$bulan = $this->input->get('bulan', TRUE);
    	$tahun = $this->input->get('tahun', TRUE);
    	$OPD = $this->input->get('OPD', TRUE);
    
		$data['bulan'] = $bulan;
    	$data['tahun'] = $tahun;
		$data['staff_arr'] = $this->m_vote->m_staff($OPD);
		$data['bendahara'] = $this->m_vote->m_bendahara_opd($OPD);
		
		$q_pimpinan = $this->db->query("SELECT * FROM tbl_pimpinan");
		$d_admin = $q_pimpinan->result();
		
		$a_admin = array();
		foreach($d_admin as $g_admin)
		{
			$a_admin[] = $g_admin->NIP;
		}
		
		$data['pimpinan'] = $a_admin;	
    
		$data['OPD'] = $OPD;
		
		
		
		//var_dump($staff_arr);
		$filename = str_replace(" ","_",$data['OPD'])."_".date('d_m_y_h_i_s');
		
		// As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
		$pdfFilePath = FCPATH."/downloads/$filename.pdf";
		$data['page_title'] = 'TPP BULAN '.$bulan.' TAHUN '. date('Y'); // pass data to the view
		 //$this->load->view('template/part/laporan_pdf.php',$data);
    
    	//echo json_encode($data);
    	$this->load->view('template/part/laporan_terbaik.php',$data);
    	
 
		
		
	}


	
	
	
	
}
