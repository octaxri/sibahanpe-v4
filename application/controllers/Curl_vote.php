<?php
class Curl_vote extends CI_controller{



	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');		
		$this->load->model('m_laporan');
		$this->load->helper('custom_func');
		
		
		$this->load->helper('text');
		date_default_timezone_set("Asia/jakarta");
	}


	public function go()
    {
    	$q = $this->db->query("SELECT * 
								FROM  `tbl_struktur` 
								GROUP BY ID_OPD");
    	$x = $q->result();
    	$tahun = date('Y');
    	
    	$datestring=date('Y-m-d').' first day of last month';
		$dt=date_create($datestring);
		$bulan = $dt->format('m'); //2011-02

    	foreach($x as $data)
        {
        	$url = "https://sibahanpe.pakpakbharatkab.go.id/sibahanpe/index.php/vote/rekap_laporan/?bulan=$bulan&tahun=$tahun&OPD=$data->ID_OPD";
        	exec_url($url);
        }
    }


	public function send()
    {
    
    	$tahun = date('Y');
    	
    	$datestring=date('Y-m-d').' first day of last month';
		$dt=date_create($datestring);
		$bulan = $dt->format('m'); //2011-02

    	$q = $this->db->query("SELECT * FROM tbl_vote WHERE bulan='$bulan' AND tahun='$tahun'");
    	$data = $q->result();
        
        //echo "SELECT * FROM tbl_vote WHERE bulan='$bulan' AND tahun='$tahun'";
    	
    	echo json_encode($data);
    
    }




}