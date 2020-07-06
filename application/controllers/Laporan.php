<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {


	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');		
		$this->load->model('m_laporan');
		$this->load->model('m_absensi');
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
	
	public function sinkronisasi()
	{
		$ID_OPD = $this->session->userdata('ID_OPD');
		$staf = $this->m_absensi->m_staf_info($ID_OPD);		
		
		$data['staf']=$staf;
		
		$this->load->view('template/part/sinkronisasi.php',$data);

	}

	public function go_sinkron_all()
	{
		$ID_OPD = $this->session->userdata('ID_OPD');
		$staf = $this->m_absensi->m_staf_info($ID_OPD);		
		$bulan = $this->input->get('bulan');
		$tahun = $this->input->get('tahun');
		$url_ekinerja = "https://ekinerja.pakpakbharatkab.go.id/res/get_json_hasil.php";
		foreach($staf as $data)	
		{
			$nip = $data->NIK;

			$ekinerja = json_decode(exec_url($url_ekinerja."?menu=laporan_bulanan&judul=Laporan%20Bulanan&aksi=cari&bulan=$bulan&keywords=$tahun&nip=$nip"));

			$hasil = $ekinerja->ekinerja;
			$ser = array(
						"nip"=>$nip,
						"bulan"=>$bulan,
						"tahun"=>$tahun,
						"tpp_full"=>$hasil->tpp_full,
						"tpp_dasar"=>$hasil->tpp_dasar,
						"tpp_dapat"=>$hasil->tpp_dapat
						);
			$this->db->insert('tbl_hasil_ekin',$ser);

			$url_absensi = base_url()."index.php/getbynik/api_absen_by_nik?nik=$nip&bulan=$bulan&tahun=$tahun";

			$absensi = json_decode(exec_url($url_absensi));
			$ser_absensi = array(
						"nip"=>$nip,
						"bulan"=>$bulan,
						"tahun"=>$tahun,
						"total_dapat"=>round($absensi[0]->total),
						"dapat_ekin"=>round($hasil->tpp_dapat),
						"dapat_absen"=>round($absensi[0]->total) - round($hasil->tpp_dapat),
						"potong_perbub_baru"=>$absensi[0]->potong_perbub_baru,
						"pokok"=>$hasil->tpp_full
						);		
			$this->db->insert('tbl_hasil_absen',$ser_absensi);
		}
	}

	public function go_sinkron()
	{
		//$url_ekinerja = "http://192.168.43.45/coba/get_json_hasil.json";
		$url_ekinerja = "https://ekinerja.pakpakbharatkab.go.id/res/get_json_hasil.php";
		$bulan = $this->input->get('bulan');
		$tahun = $this->input->get('tahun');
		$nip = $this->input->get('nip');

		//ambil_data dari e kinerja
		$ekinerja = json_decode(exec_url($url_ekinerja."?menu=laporan_bulanan&judul=Laporan%20Bulanan&aksi=cari&bulan=$bulan&keywords=$tahun&nip=$nip"));

		$hasil = $ekinerja->ekinerja;

		$ser_ekin = array(
					"nip"=>$nip,
					"bulan"=>$bulan,
					"tahun"=>$tahun,
					"tpp_full"=>$hasil->tpp_full,
					"tpp_dasar"=>round($hasil->tpp_dasar),
					"tpp_dapat"=>round($hasil->tpp_dapat)					
					);
		$this->db->insert('tbl_hasil_ekin',$ser_ekin);


		$url_absensi = base_url()."index.php/getbynik/api_absen_by_nik?nik=$nip&bulan=$bulan&tahun=$tahun";

		$absensi = json_decode(exec_url($url_absensi));
		$ser_absensi = array(
					"nip"=>$nip,
					"bulan"=>$bulan,
					"tahun"=>$tahun,
					"total_dapat"=>round($absensi[0]->total),
					"dapat_ekin"=>round($hasil->tpp_dapat),
					"dapat_absen"=>round($absensi[0]->absensi),
					"potong_perbub_baru"=>$absensi[0]->potong_perbub_baru,
					"pokok"=>$hasil->tpp_full
					);		
		$this->db->insert('tbl_hasil_absen',$ser_absensi);
		
		
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
			$html = $this->load->view('template/part/laporan_pdf_oke.php',$data,true);
			 
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
		 $this->load->view('template/part/laporan_pdf_oke.php',$data);
		 
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
