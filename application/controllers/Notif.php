<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notif extends CI_Controller {


	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');		
		$this->load->model('m_absensi');
		
		$this->load->helper('custom_func');
		
		
		if ($this->session->userdata('FID')=="") 
		{
			redirect('index.php/login');
		}
		
		$this->load->helper('text');
		date_default_timezone_set("Asia/jakarta");
	}


	public function notif_tbl_cuti_sakit()
	{
		
		$ID_OPD = $this->session->userdata('ID_OPD');
		$q = $this->db->query("SELECT COUNT(id) AS jum FROM tbl_cuti_sakit WHERE status='pending' AND YEAR( tanggal ) = YEAR( NOW( ) )  AND LEFT(FID , 2)='$ID_OPD'");
		$a = $q->result();
		
		echo $a[0]->jum;
		
	}
	
	public function notif_tbl_cuti_lain()
	{
		
		$ID_OPD = $this->session->userdata('ID_OPD');
		$q = $this->db->query("SELECT COUNT(id) AS jum FROM tbl_cuti_lain WHERE status='pending' AND LEFT(FID , 2)='$ID_OPD'");
		$a = $q->result();
		
		echo $a[0]->jum;
		
	}
	
	

	public function notif_tbl_cuti_tahunan()
	{
		
		$ID_OPD = $this->session->userdata('ID_OPD');
		$q = $this->db->query("SELECT COUNT(id) AS jum FROM tbl_cuti_tahunan WHERE status='pending' AND YEAR( tanggal ) = YEAR( NOW( ) ) AND LEFT(FID , 2)='$ID_OPD'");
		$a = $q->result();
		
		echo $a[0]->jum;
    	//echo "SELECT COUNT(id) AS jum FROM tbl_cuti_tahunan WHERE status='pending' AND LEFT(FID , 2)='$ID_OPD'";
    
    
		
	}
	


	public function notif_tbl_dinas_luar()
	{
		
		$ID_OPD = $this->session->userdata('ID_OPD');
		$q = $this->db->query("SELECT COUNT(id) AS jum FROM tbl_dinas_luar WHERE status='pending' AND YEAR( tanggal ) = YEAR( NOW( ) ) AND LEFT(FID , 2)='$ID_OPD'");
		$a = $q->result();
		
		echo $a[0]->jum;
    	//echo "SELECT COUNT(id) AS jum FROM tbl_dinas_luar WHERE status='pending' AND LEFT(FID , 2)='$ID_OPD'";
    
    
		
	}
	
	
	
	public function notif_tbl_surat_ijin_keterangan()
	{
		
		$ID_OPD = $this->session->userdata('ID_OPD');
		$q = $this->db->query("SELECT COUNT(id) AS jum FROM tbl_surat_ijin_keterangan WHERE status='pending' AND YEAR( tanggal ) = YEAR( NOW( ) ) AND LEFT(FID , 2)='$ID_OPD'");
		$a = $q->result();
		
		echo $a[0]->jum;
		
	}
	
	
	
	public function notif_tbl_surat_sakit()
	{
		
		$ID_OPD = $this->session->userdata('ID_OPD');
		$q = $this->db->query("SELECT COUNT(id) AS jum FROM tbl_surat_sakit WHERE status='pending' AND YEAR( tanggal ) = YEAR( NOW( ) ) AND LEFT(FID , 2)='$ID_OPD'");
		$a = $q->result();
		
		echo $a[0]->jum;
		
	}
	
	
	
	
}
