<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Getbynik extends CI_Controller {


	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');		
		$this->load->model('m_absensi');
		$this->load->model('m_laporan');
		$this->load->helper('custom_func');
		
		$this->load->helper('text');
		date_default_timezone_set("Asia/jakarta");
		header('Content-Type: application/json');
	}
	
	
	
	public function dapat_absen_by_nik()
	{
		
		$nik = $this->input->get('nik', TRUE);
		$bulan = $this->input->get('bulan', TRUE);
		$tahun = $this->input->get('tahun', TRUE);
		
		$data['hasil'] 	= $this->m_absensi->m_absen_by_fid($nik,$bulan,$tahun);
    	$data['nik']	= $nik;
    	$data['bulan']	= $bulan;
    	$data['tahun']	= $tahun;

    	$data['tgl_libur']=$this->m_absensi->m_tbl_libur($bulan,$tahun);
		$data['tgl_sakit']=$this->m_absensi->m_tbl_surat_sakit($nik,$bulan,$tahun);
		$data['tgl_dinas']=$this->m_absensi->m_tbl_dinas_luar($nik,$bulan,$tahun);
		$data['tgl_cut_sak']=$this->m_absensi->m_tbl_cuti_sakit($nik,$bulan,$tahun);
		$data['tgl_cut_la']=$this->m_absensi->m_tbl_cuti_lain($nik,$bulan,$tahun);
    	$data['tgl_cut_tah']=$this->m_absensi->m_tbl_cuti_tahunan($nik,$bulan,$tahun);
		$data['tbl_surat_ijin_keterangan']=$this->m_absensi->m_tbl_surat_ijin_keterangan($nik,$bulan,$tahun);

		
		//$data['ekinerja'] = json_decode(exec_url("https://ekinerja.pakpakbharatkab.go.id/res/get_json_hasil.php?menu=laporan_bulanan&judul=Laporan%20Bulanan&aksi=cari&bulan=$bulan&keywords=$tahun&nip=$nik"));


		/********** sekarang tarik dari db aja *********/
		$ekinerja = new stdClass();
		$ekinerja->ekinerja = new stdClass();		
		$q = $this->m_laporan->m_hasil_ekin($nik,$bulan,$tahun);				
		if(count($q)==0)
		{
			$ekinerja->ekinerja->tpp_full=0;
			$ekinerja->ekinerja->tpp_dasar=0;
			$ekinerja->ekinerja->tpp_dapat=0;
		}else{
			$ekinerja->ekinerja->tpp_full=$q[0]->tpp_full;
			$ekinerja->ekinerja->tpp_dasar=$q[0]->tpp_dasar;
			$ekinerja->ekinerja->tpp_dapat=$q[0]->tpp_dapat;
		}
		$data['ekinerja'] = $ekinerja;
		/********** sekarang tarik dari db aja *********/
		
		
		
		$data['bulan'] = $bulan;
		$this->load->view('template/part/dapat_absen_by_nik.php',$data);
	}
	
	
	
	public function dapat_lap_by_nik()
	{
		
		$nik = $this->input->get('nik', TRUE);
		$bulan = $this->input->get('bulan', TRUE);
		$tahun = $this->input->get('tahun', TRUE);
		$q_tgl_bulan_ini = $this->m_absensi->m_tanggal_berisi_bulan($bulan,$tahun);
		
		
		
		
		$a = array();		
		$b = array();		
		foreach($q_tgl_bulan_ini as $tgl)
		{
			$a[] = $this->m_absensi->m_absen_by_nik($nik,$tgl->tanggal);			
			$b[] = $tgl->tanggal;
		}
		$data['absen_by_nik']=$a;
		$data['tgl']=$b;
		$data['tgl_libur']=$this->m_absensi->m_tbl_libur($bulan,$tahun);
		$data['tgl_sakit']=$this->m_absensi->m_tbl_surat_sakit($nik,$bulan);
		$data['tgl_dinas']=$this->m_absensi->m_tbl_dinas_luar($nik,$bulan);
		$data['tgl_cut_sak']=$this->m_absensi->m_tbl_cuti_sakit($nik,$bulan);
		$data['tgl_cut_la']=$this->m_absensi->m_tbl_cuti_lain($nik,$bulan);
    	$data['tgl_cut_tah']=$this->m_absensi->m_tbl_cuti_tahunan($nik,$bulan);
		$data['tbl_surat_ijin_keterangan']=$this->m_absensi->m_tbl_surat_ijin_keterangan($nik,$bulan);
		


		//$data['ekinerja'] = json_decode(exec_url("https://ekinerja.pakpakbharatkab.go.id/res/get_json_hasil2.php?menu=laporan_bulanan&judul=Laporan%20Bulanan&aksi=cari&bulan=$bulan&keywords=$tahun&nip=$nik"));

		/********** sekarang tarik dari db aja *********/
		$ekinerja = new stdClass();
		$ekinerja->ekinerja = new stdClass();		
		$q = $this->m_laporan->m_hasil_ekin($nik,$bulan,$tahun);				
		if(count($q)==0)
		{
			$ekinerja->ekinerja->tpp_full=0;
			$ekinerja->ekinerja->tpp_dasar=0;
			$ekinerja->ekinerja->tpp_dapat=0;
		}else{
			$ekinerja->ekinerja->tpp_full=$q[0]->tpp_full;
			$ekinerja->ekinerja->tpp_dasar=$q[0]->tpp_dasar;
			$ekinerja->ekinerja->tpp_dapat=$q[0]->tpp_dapat;
		}
		$data['ekinerja'] = $ekinerja;
		/********** sekarang tarik dari db aja *********/
		
		
		
		$data['bulan'] = $bulan;
		$this->load->view('template/part/dapat_lap_by_nik.php',$data);
	}
	
	
	
	
	public function api_absen_by_nik()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header('Content-Type: application/json');
		ini_set('memory_limit', '2048M');
		$nik = $this->input->get('nik', TRUE);
		$bulan = $this->input->get('bulan', TRUE);
		$tahun = $this->input->get('tahun', TRUE);
		
		$data['hasil'] 	= $this->m_absensi->m_absen_by_fid($nik,$bulan,$tahun);
    	$data['nik']	= $nik;
    	$data['bulan']	= $bulan;
    	$data['tahun']	= $tahun;

    	$data['tgl_libur']=$this->m_absensi->m_tbl_libur($bulan,$tahun);
		$data['tgl_sakit']=$this->m_absensi->m_tbl_surat_sakit($nik,$bulan,$tahun);
		$data['tgl_dinas']=$this->m_absensi->m_tbl_dinas_luar($nik,$bulan,$tahun);
		$data['tgl_cut_sak']=$this->m_absensi->m_tbl_cuti_sakit($nik,$bulan,$tahun);
		$data['tgl_cut_la']=$this->m_absensi->m_tbl_cuti_lain($nik,$bulan,$tahun);
    	$data['tgl_cut_tah']=$this->m_absensi->m_tbl_cuti_tahunan($nik,$bulan,$tahun);
		$data['tbl_surat_ijin_keterangan']=$this->m_absensi->m_tbl_surat_ijin_keterangan($nik,$bulan,$tahun);
		
		
		/********** sekarang tarik dari db aja *********/
		$ekinerja = new stdClass();
		$ekinerja->ekinerja = new stdClass();		
		$q = $this->m_laporan->m_hasil_ekin($nik,$bulan,$tahun);				
		if(count($q)==0)
		{
			$ekinerja->ekinerja->tpp_full=0;
			$ekinerja->ekinerja->tpp_dasar=0;
			$ekinerja->ekinerja->tpp_dapat=0;
		}else{
			$ekinerja->ekinerja->tpp_full=$q[0]->tpp_full;
			$ekinerja->ekinerja->tpp_dasar=$q[0]->tpp_dasar;
			$ekinerja->ekinerja->tpp_dapat=$q[0]->tpp_dapat;
		}
		$data['ekinerja'] = $ekinerja;
		/********** sekarang tarik dari db aja *********/

		//$data['ekinerja'] = json_decode(exec_url("https://ekinerja.pakpakbharatkab.go.id/res/get_json_hasil.php?menu=laporan_bulanan&judul=Laporan%20Bulanan&aksi=cari&bulan=$bulan&keywords=$tahun&nip=$nik"));
		
		
		
		
		$data['bulan'] = $bulan;
		$this->load->view('template/part/api_absen_by_nik.php',$data);
	}
	
	
	public function go_sinkron()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header('Content-Type: application/json');
		ini_set('memory_limit', '2048M');
		$bulan = $this->input->get('bulan');
		$tahun = $this->input->get('tahun');
		$nip = $this->input->get('nip');


		$url_ekinerja = "https://ekinerja.pakpakbharatkab.go.id/res/get_json_hasil.php";		
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
					"dapat_absen"=>round($absensi[0]->total) - round($hasil->tpp_dapat),
					"pokok"=>$hasil->tpp_full
					);		
		$this->db->insert('tbl_hasil_absen',$ser_absensi);
		echo json_encode(array("msg"=>"ok"));
		
	}
}
