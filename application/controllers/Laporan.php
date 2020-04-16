<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {


	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');		
		$this->load->model('m_laporan');
		$this->load->helper('custom_func');
		
		
		if ($this->session->userdata('FID')=="") 
		{
			redirect('index.php/login');
		}
		
		$this->load->helper('text');
		date_default_timezone_set("Asia/jakarta");



		
		/***********log firebase*********/
			//$this->log_firebase();
		/***********log firebase*********/

        
        
	}
	
	private function log_firebase()
	{
		/******************** post ke firebase ************************/
		/*
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
      	*/
		/******************** post ke firebase ************************/
	}
	
	public function form()
	{
		
		/*---------tbl_setting_download----------*/
    	$q_tbl_setting_download = $this->db->query("SELECT * FROM tbl_setting_download");
    	$d_tbl_setting_download = $q_tbl_setting_download->result();
    	$a_arr = array();
    	foreach($d_tbl_setting_download as $val)
        {
        	$a_arr[] = $val->id_opd;
        }
    	$data['buka'] = $a_arr;
    	//var_dump($a_hukuman);
    	/*---------admin_hukuman----------*/
    	

		$this->load->view('template/part/form_laporan_by_bulan.php',$data);
		//var_dump($staff_arr);

	}
	
	
	public function staff_by_opd($bulan)
	{
		if(!isset($bulan))
		{
			$data['bulan'] = date('m');
		}else{
			$data['bulan'] = $bulan;
		}
		
		$data['staff_arr'] = $this->m_laporan->m_staff_by_opd();
		
		$this->load->view('template/part/laporan_by_bulan.php',$data);
		//var_dump($staff_arr);

	}
	
	
	public function rekap_pdf()
	{
		
		
		$bulan = $this->input->get('bulan', TRUE);
    	$tahun = $this->input->get('tahun', TRUE);
		$data['bulan'] = $bulan;
    	$data['tahun'] = $tahun;
		$data['staff_arr'] = $this->m_laporan->m_staff_by_opd();
		$data['bendahara'] = $this->m_laporan->m_bendahara_opd();
		
		$q_pimpinan = $this->db->query("SELECT * FROM tbl_pimpinan");
		$d_admin = $q_pimpinan->result();
		
		$a_admin = array();
		foreach($d_admin as $g_admin)
		{
			$a_admin[] = $g_admin->NIP;
		}
		
		$data['pimpinan'] = $this->m_laporan->m_penanda_tangan($this->session->userdata('ID_OPD'));	
    
		$data['OPD'] = $this->session->userdata('OPD');
		
		
		
		//var_dump($staff_arr);
		$filename = str_replace(" ","_",$data['OPD'])."_".date('d_m_y_h_i_s');
		
		// As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
		$pdfFilePath = FCPATH."/downloads/$filename.pdf";
		$data['page_title'] = 'TPP BULAN '.$bulan.' TAHUN '. date('Y'); // pass data to the view
		 //$this->load->view('template/part/laporan_pdf.php',$data);
    
    	//echo json_encode($data);
    	//$this->load->view('template/part/laporan_pdf.php',$data);
    	
		if (file_exists($pdfFilePath) == FALSE)
		{
			//ini_set('memory_limit','512M'); // boost the memory limit if it's low <img class="emoji" draggable="false" alt="" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
        	ini_set('memory_limit', '2048M');
        	//ini_set('memory_limit', '-1');
			//$html = $this->load->view('laporan_mpdf/pdf_report', $data, true); // render the view into HTML
			$html = $this->load->view('template/part/laporan_pdf.php',$data,true);
			 
			$this->load->library('pdf');
			$pdf = $this->pdf->load();
			$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date("YmdHis")."_".$this->session->userdata('FID')); // Add a footer for good measure <img class="emoji" draggable="false" alt="" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'F'); // save to file because we can
		}
		 
		redirect(base_url()."downloads/$filename.pdf","refresh");
		
		
		
		
	}

	
	public function rekap_xl()
	{
		

		$bulan = $this->input->get('bulan', TRUE);
    	$tahun = $this->input->get('tahun', TRUE);
		$data['bulan'] = $bulan;
    	$data['tahun'] = $tahun;
		$data['staff_arr'] = $this->m_laporan->m_staff_by_opd();
		$data['bendahara'] = $this->m_laporan->m_bendahara_opd();
		
		$q_pimpinan = $this->db->query("SELECT * FROM tbl_pimpinan");
		$d_admin = $q_pimpinan->result();
		
		$a_admin = array();
		foreach($d_admin as $g_admin)
		{
			$a_admin[] = $g_admin->NIP;
		}
		
		$data['pimpinan'] = $this->m_laporan->m_penanda_tangan($this->session->userdata('ID_OPD'));	
    
		$data['OPD'] = $this->session->userdata('OPD');
		
		
		
		//var_dump($staff_arr);
		$filename = str_replace(" ","_",$data['OPD'])."_".date('d_m_y_h_i_s')."_rekap.xls";;
		
		
		$data['page_title'] = 'TPP BULAN '.$bulan.' TAHUN '. date('Y'); // pass data to the view
		 $this->load->view('template/part/laporan_pdf.php',$data);
		 
		 header('Content-type: application/ms-excel');
		header('Content-Disposition: attachment; filename='.$filename);
    
		
		
	}

	public function rekap_laporan()
	{
		
		ini_set('memory_limit', '2048M');
    	$bulan = $this->input->get('bulan', TRUE);
    	$tahun = $this->input->get('tahun', TRUE);
		$data['bulan'] = $bulan;
    	$data['tahun'] = $tahun;
		$data['staff_arr'] = $this->m_laporan->m_staff_by_opd();
		$data['bendahara'] = $this->m_laporan->m_bendahara_opd();
		
		$q_pimpinan = $this->db->query("SELECT * FROM tbl_pimpinan");
		$d_admin = $q_pimpinan->result();
		
		$a_admin = array();
		foreach($d_admin as $g_admin)
		{
			$a_admin[] = $g_admin->NIP;
		}
		
		$data['pimpinan'] = $a_admin;	
    
		$data['OPD'] = $this->session->userdata('OPD');
		
		
		
		//var_dump($staff_arr);
		$filename = str_replace(" ","_",$data['OPD'])."_".date('d_m_y_h_i_s');
		
		// As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
		$pdfFilePath = FCPATH."/downloads/$filename.pdf";
		$data['page_title'] = 'TPP BULAN '.$bulan.' TAHUN '. date('Y'); // pass data to the view
		 //$this->load->view('template/part/laporan_pdf.php',$data);
    
    	//echo json_encode($data);
    	$this->load->view('template/part/laporan_terbaik.php',$data);
    	
    /*
		if (file_exists($pdfFilePath) == FALSE)
		{
			//ini_set('memory_limit','512M'); // boost the memory limit if it's low <img class="emoji" draggable="false" alt="" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
        	ini_set('memory_limit', '2048M');
			//$html = $this->load->view('laporan_mpdf/pdf_report', $data, true); // render the view into HTML
			$html = $this->load->view('template/part/laporan_pdf.php',$data,true);
			 
			$this->load->library('pdf');
			$pdf = $this->pdf->load();
			$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date("YmdHis")."_".$this->session->userdata('FID')); // Add a footer for good measure <img class="emoji" draggable="false" alt="" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'F'); // save to file because we can
		}
		 
		redirect(base_url()."downloads/$filename.pdf","refresh");
        */
		
		
		
		
	}


	
	
	
	
}
