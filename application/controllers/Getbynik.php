<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Getbynik extends CI_Controller {


	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');		
		$this->load->model('m_absensi');
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

		//ambil_data dari e kinerja
		$data['ekinerja'] = json_decode(exec_url("https://ekinerja.pakpakbharatkab.go.id/res/get_json_hasil.php?menu=laporan_bulanan&judul=Laporan%20Bulanan&aksi=cari&bulan=$bulan&keywords=$tahun&nip=$nik"));
		
		
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
		//ambil_data dari e kinerja
		$data['ekinerja'] = json_decode(exec_url("https://ekinerja.pakpakbharatkab.go.id/res/get_json_hasil2.php?menu=laporan_bulanan&judul=Laporan%20Bulanan&aksi=cari&bulan=$bulan&keywords=$tahun&nip=$nik"));
		
		
		$data['bulan'] = $bulan;
		$this->load->view('template/part/dapat_lap_by_nik.php',$data);
	}
	
	
	
	
	public function api_absen_by_nik()
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
		
		//ambil_data dari e kinerja
		$data['ekinerja'] = json_decode(exec_url("https://ekinerja.pakpakbharatkab.go.id/res/get_json_hasil.php?menu=laporan_bulanan&judul=Laporan%20Bulanan&aksi=cari&bulan=$bulan&keywords=$tahun&nip=$nik"));
		
		
		$data['bulan'] = $bulan;
		$this->load->view('template/part/api_absen_by_nik.php',$data);
	}
	
	
}
