<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Show extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');		
		$this->load->helper('custom_func');
		date_default_timezone_set("Asia/jakarta");
	}

	public function index() 
	{
		$data['title']="e-Agenda";		
		
		$qquery = $this->db->query("SELECT * FROM v_jadwal_approved ORDER BY tanggal_kegiatan_mulai ASC LIMIT 7");
		$qq 	= $qquery->result();						
		$data['v_jadwal_approved'] = $qq;
		
		
		$query = $this->db->query("SELECT * FROM v_jadwal_approved WHERE tanggal_kegiatan_mulai > NOW() ORDER BY tanggal_kegiatan_mulai ASC");
		$q 	= $query->result();						
		$data['terdekat'] = $q;
		
		$this->load->view('template/show.php',$data);
	}
	

	
}