<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {


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

		/***********log firebase*********/
			//$this->log_firebase();
		/***********log firebase*********/
        /*
        if(!isset($_COOKIE['nip']) || $_COOKIE['nip']=='')
        {
            redirect('index.php/login');
        }
        */
        
        
        /******** aksi penutupan sementara ****/
          //echo $this->session->userdata('ID_OPD')."--";

        /*
          if(substr($this->session->userdata('FID'), 0, 2)!='86')
          {
              echo "Mohon maaf, Sibahanpe sedang dalam pemeliharaan sementara waktu, Aksi ini hanya sebentar, mohon pengertiannya. Terimakasih.";
              die();
          }
          */
        /******** aksi penutupan sementara ****/

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
	
	public function index()
	{
		
		$fid=$this->session->userdata('FID');
		if(count($this->m_absensi->ambil_gambar($fid))>0)
		{
			//$data['gambar'] = base_url().$this->m_absensi->ambil_gambar($fid)[0]->image;
			$data['gambar'] = base_url().$this->m_absensi->ambil_gambar($fid)[0]->image;
		}else{
			$data['gambar'] = "https://sibahanpe.pakpakbharatkab.go.id/sibahanpe/assets/dist/img/avatar5.png";
		}
        
        
		$nik 	= $this->session->userdata('NIK');
		$bulan 	= date('m');
        $tahun = date('Y');
		
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

		/*---------admin----------*/
    	$q_admin = $this->db->query("SELECT * FROM tbl_admin");
		$d_admin = $q_admin->result();
		
		$a_admin = array();
		foreach($d_admin as $g_admin)
		{
			$a_admin[] = $g_admin->NIP;
		}
		
		$data['admin'] = $a_admin;		
    	/*---------admin----------*/
    
    	/*---------admin_hukuman----------*/
    	$q_adm_hukuman = $this->db->query("SELECT * FROM tbl_apel_pagi_admin");
    	$d_adm_hukuman = $q_adm_hukuman->result();
    	$a_hukuman = array();
    	foreach($d_adm_hukuman as $g_hukuman)
        {
        	$a_hukuman[] = $g_hukuman->NIP;
        }
    	$data['hukuman'] = $a_hukuman;
    	//var_dump($a_hukuman);
    	/*---------admin_hukuman----------*/
     
    
		
		$this->load->view('template/index.php',$data);
	}

	
	
	public function profil_admin()
	{
		
		$this->load->view('template/part/profil_admin.php');
	}
	
	
	
	public function go_profil_admin()
	{
		$data_update =  md5($this->input->post('password', TRUE));		
		$cetak 		= $this->input->post('password', TRUE);		
		$NIK 		= $this->input->post('NIK', TRUE);
		$this->m_absensi->update_data_session_user($data_update,$cetak,$NIK);


	}
	
	
	
	public function absen_kemarin()
	{
		
		$data['absen_kemarin'] = $this->m_absensi->m_absen_kemarin();
		
		$this->load->view('template/part/absen_kemarin.php',$data);
	}
	
	
	public function absen_live()
	{
		
		$data['absen_live'] = $this->m_absensi->m_absen_hari_ini();
		
		$this->load->view('template/part/absen_live.php',$data);
	}
	
	
	public function absen_by_date($date)
	{
		
		$data['absen_kemarin'] = $this->m_absensi->m_absen_by_date_in_opd($date);
		$data['tanggal'] = $date;
		
		$this->load->view('template/part/absen_by_date.php',$data);
	}
	
	
	
	public function form_absen_by_date()
	{
		
		$this->load->view('template/part/form_absen_by_date.php');
	}
	
	public function tanggal_berisi_bulan_ini()
	{
		
		$data['m_tanggal_berisi_bulan_ini'] = $this->m_absensi->m_tanggal_berisi_bulan_ini();
		
		$this->load->view('template/part/tanggal_berisi_bulan_ini.php',$data);
	}
	
	
	
	
	public function form_absen_by_nik()
	{
		
		$this->load->view('template/part/form_absen_by_nik.php');
	}
	
	
	public function form_absen_by_nik_perorang()
	{
		
		$this->load->view('template/part/form_absen_by_nik_perorang.php');
	}
	
	
	public function form_libur()
	{
		
		$this->load->view('template/part/form_libur.php');
	}
	
	
	
	
	
	/*****************************************************************************cuti sakit*****************************************/
	
	public function form_cuti_sakit()
	{
		
		$this->load->view('template/part/form_cuti_sakit.php');
	}
	
	
	
	public function set_form_cuti_sakit()
	{
		
		$NIK 		= $this->input->post('NIK', TRUE);
		$FID 		= $this->input->post('FID', TRUE);
		$tanggal 	= $this->input->post('tanggal', TRUE);
		$keterangan	= $this->input->post('keterangan', TRUE);
		
		
		
		$serialize = array(
				'FID'			=> $FID,
				'NIK'			=> $NIK,
				'tanggal'		=> $tanggal,
				'keterangan'	=> $keterangan				
			);
		
		$libur = $this->m_absensi->m_set_form_cuti_sakit($serialize);
		
	}
	
	
	public function data_cuti_sakit()
	{
				
		$cuti = $this->m_absensi->m_data_cuti_sakit();
		
		
		$data['cuti']=$cuti;
		
		$this->load->view('template/part/data_cuti_sakit.php',$data);
	}
	
	public function data_cuti_sakit_by_nik()
	{
				
		$cuti = $this->m_absensi->m_data_cuti_sakit_by_nik();
		
		$data['cuti']=$cuti;
		
		$this->load->view('template/part/data_cuti_sakit_by_nik.php',$data);
	}
	
	
	
	public function setujui_cuti_sakit($id)
	{
				
		$NIK=$this->session->userdata('NIK');
		$this->db->query("UPDATE tbl_cuti_sakit SET status='approve', NIK_REF='$NIK' WHERE id='$id'");
	}
	
	
	public function tolak_cuti_sakit($id)
	{
				
		$NIK=$this->session->userdata('NIK');
		$this->db->query("UPDATE tbl_cuti_sakit SET status='cancel', NIK_REF='$NIK' WHERE id='$id'");
	}
	
	/*****************************************************************************cuti sakit*****************************************/
	
	
	
	
	
	/*****************************************************************************cuti lain*****************************************/
	
	public function form_cuti_lain()
	{
		
		$this->load->view('template/part/form_cuti_lain.php');
	}
	
	
	
	public function set_form_cuti_lain()
	{
		
		$NIK 		= $this->input->post('NIK', TRUE);
		$FID 		= $this->input->post('FID', TRUE);
		$tanggal 	= $this->input->post('tanggal', TRUE);
		$keterangan	= $this->input->post('keterangan', TRUE);
		
		
		
		$serialize = array(
				'FID'			=> $FID,
				'NIK'			=> $NIK,
				'tanggal'		=> $tanggal,
				'keterangan'	=> $keterangan				
			);
		
		$libur = $this->m_absensi->m_set_form_cuti_lain($serialize);
		
	}
	
	
	public function data_cuti_lain()
	{
				
		$cuti = $this->m_absensi->m_data_cuti_lain();
		
		
		$data['cuti']=$cuti;
		
		$this->load->view('template/part/data_cuti_lain.php',$data);
	}
	
	public function data_cuti_lain_by_nik()
	{
				
		$cuti = $this->m_absensi->m_data_cuti_lain_by_nik();
		
		$data['cuti']=$cuti;
		
		$this->load->view('template/part/data_cuti_lain_by_nik.php',$data);
	}
	
	
	
	public function setujui_cuti_lain($id)
	{
				
		$NIK=$this->session->userdata('NIK');
		$this->db->query("UPDATE tbl_cuti_lain SET status='approve', NIK_REF='$NIK' WHERE id='$id'");
	}
	
	
	public function tolak_cuti_lain($id)
	{
				
		$NIK=$this->session->userdata('NIK');
		$this->db->query("UPDATE tbl_cuti_lain SET status='cancel', NIK_REF='$NIK' WHERE id='$id'");
	}
	
	/*****************************************************************************cuti lain*****************************************/
	
	
	
	/*****************************************************************************dinas luar*****************************************/
	
	public function form_dinas_luar()
	{
		
		$this->load->view('template/part/form_dinas_luar.php');
	}
	
	
	


	
	public function set_form_dinas_luar()
	{
		
		$NIK 		= $this->input->post('NIK', TRUE);
		$FID 		= $this->input->post('FID', TRUE);
		$tanggal 	= $this->input->post('tanggal', TRUE);
		$tanggal_antara	= $this->input->post('tanggal_antara', TRUE);
		$keterangan	= $this->input->post('keterangan', TRUE);
		
		
		
		$arr_tgl = tanggal_antara($tanggal,$tanggal_antara);
		
		
		
		foreach($arr_tgl as $z)
		{
			
			$serialize = array(
					'FID'			=> $FID,
					'NIK'			=> $NIK,
					'tanggal'		=> $z,
					'keterangan'	=> $keterangan				
				);
			
			//cek kesalahan tanggal
            $datenya = DateTime::createFromFormat("Y-m-d", $z);
            if($datenya->format("Y")==date('Y'))
            {
                $libur = $this->m_absensi->m_set_form_dinas_luar($serialize);    
            }
			
			
		}
		
		
		
	}
	
	


	
	
	public function data_dinas_luar()
	{
				
		$cuti = $this->m_absensi->m_data_dinas_luar();
		
		
		$data['cuti']=$cuti;
		
		$this->load->view('template/part/data_dinas_luar.php',$data);
	}
	
	public function data_dinas_luar_by_nik()
	{
				
		$cuti = $this->m_absensi->m_data_dinas_luar_by_nik();
        //var_dump($cuti);
		
		$data['cuti']=$cuti;
		
		$this->load->view('template/part/data_dinas_luar_by_nik.php',$data);
	}
	
	
	
	public function setujui_dinas_luar($id)
	{
				
		$NIK=$this->session->userdata('NIK');
		$this->db->query("UPDATE tbl_dinas_luar SET status='approve', NIK_REF='$NIK' WHERE id='$id'");
	}
	
	
	public function tolak_dinas_luar($id)
	{
				
		$NIK=$this->session->userdata('NIK');
		$this->db->query("UPDATE tbl_dinas_luar SET status='cancel', NIK_REF='$NIK' WHERE id='$id'");
	}
	
	/*****************************************************************************dinas luar*****************************************/
	
	
	
	
	/*****************************************************************************cuti_tahunan*****************************************/
	
	public function form_cuti_tahunan()
	{
		
		$this->load->view('template/part/form_cuti_tahunan.php');
	}
	
	
	


	
	public function set_form_cuti_tahunan()
	{
		
		$NIK 		= $this->input->post('NIK', TRUE);
		$FID 		= $this->input->post('FID', TRUE);
		$tanggal 	= $this->input->post('tanggal', TRUE);
		$tanggal_antara	= $this->input->post('tanggal_antara', TRUE);
		$keterangan	= $this->input->post('keterangan', TRUE);
		
		
		
		$arr_tgl = tanggal_antara($tanggal,$tanggal_antara);
		
		
		
		foreach($arr_tgl as $z)
		{
			
			$serialize = array(
					'FID'			=> $FID,
					'NIK'			=> $NIK,
					'tanggal'		=> $z,
					'keterangan'	=> $keterangan				
				);
			
			
			
			$libur = $this->m_absensi->m_set_form_cuti_tahunan($serialize);
		}
		
		
		
	}
	
	


	
	
	public function data_cuti_tahunan()
	{
				
		$cuti = $this->m_absensi->m_data_cuti_tahunan();
		
		
		$data['cuti']=$cuti;
		
		$this->load->view('template/part/data_cuti_tahunan.php',$data);
	}
	
	public function data_cuti_tahunan_by_nik()
	{
				
		$cuti = $this->m_absensi->m_data_cuti_tahunan_by_nik();
		
		$data['cuti']=$cuti;
		
		$this->load->view('template/part/data_cuti_tahunan_by_nik.php',$data);
	}
	
	
	
	public function setujui_cuti_tahunan($id)
	{
				
		$NIK=$this->session->userdata('NIK');
		$this->db->query("UPDATE tbl_cuti_tahunan SET status='approve', NIK_REF='$NIK' WHERE id='$id'");
	}
	
	
	public function tolak_cuti_tahunan($id)
	{
				
		$NIK=$this->session->userdata('NIK');
		$this->db->query("UPDATE tbl_cuti_tahunan SET status='cancel', NIK_REF='$NIK' WHERE id='$id'");
	}
	
	/*****************************************************************************cuti_tahunan*****************************************/
	
	
	
	
	
	/*****************************************************************************sakit*****************************************/
	
	public function form_sakit()
	{
		
		$this->load->view('template/part/form_sakit.php');
	}
	
	
	
	public function set_form_sakit()
	{
		
		$NIK 		= $this->input->post('NIK', TRUE);
		$FID 		= $this->input->post('FID', TRUE);
		$tanggal 	= $this->input->post('tanggal', TRUE);
		$keterangan	= $this->input->post('keterangan', TRUE);
		
		
		
		$serialize = array(
				'FID'			=> $FID,
				'NIK'			=> $NIK,
				'tanggal'		=> $tanggal,
				'keterangan'	=> $keterangan				
			);
		
		$libur = $this->m_absensi->m_set_form_sakit($serialize);
		
	}
	
	
	public function data_sakit()
	{
				
		$cuti = $this->m_absensi->m_data_sakit();
		
		
		$data['cuti']=$cuti;
		
		$this->load->view('template/part/data_sakit.php',$data);
	}
	
	public function data_sakit_by_nik()
	{
				
		$cuti = $this->m_absensi->m_data_sakit_by_nik();
		
		$data['cuti']=$cuti;
		
		$this->load->view('template/part/data_sakit_by_nik.php',$data);
	}
	
	
	
	public function setujui_sakit($id)
	{
				
		$NIK=$this->session->userdata('NIK');
		$this->db->query("UPDATE tbl_surat_sakit SET status='approve', NIK_REF='$NIK' WHERE id='$id'");
	}
	
	
	public function tolak_sakit($id)
	{
				
		$NIK=$this->session->userdata('NIK');
		$this->db->query("UPDATE tbl_surat_sakit SET status='cancel', NIK_REF='$NIK' WHERE id='$id'");
	}
	
	/*****************************************************************************sakit*****************************************/
	
	
	
	
	
	
	
	
	
	/*****************************************************************************ijin_keterangan*****************************************/
	
	public function form_ijin_keterangan()
	{
		
		$this->load->view('template/part/form_ijin_keterangan.php');
	}
	
	
	
	public function set_form_ijin_keterangan()
	{
		
		$NIK 		= $this->input->post('NIK', TRUE);
		$FID 		= $this->input->post('FID', TRUE);
		$tanggal 	= $this->input->post('tanggal', TRUE);
		$keterangan	= $this->input->post('keterangan', TRUE);
		$masuk_pulang	= $this->input->post('masuk_pulang', TRUE);
		
		
		
		$serialize = array(
				'FID'			=> $FID,
				'NIK'			=> $NIK,
				'tanggal'		=> $tanggal,
				'masuk_pulang'	=> $masuk_pulang,
				'keterangan'	=> $keterangan				
			);
		
		$libur = $this->m_absensi->m_set_form_ijin_keterangan($serialize);
		
	}
	
	
	public function data_ijin_keterangan()
	{
				
		$cuti = $this->m_absensi->m_data_ijin_keterangan();
		
		
		$data['cuti']=$cuti;
		
		$this->load->view('template/part/data_ijin_keterangan.php',$data);
	}
	
	public function data_ijin_keterangan_by_nik()
	{
				
		$cuti = $this->m_absensi->m_data_ijin_keterangan_by_nik();
		
		$data['cuti']=$cuti;
		
		$this->load->view('template/part/data_ijin_keterangan_by_nik.php',$data);
	}
	
	
	
	public function setujui_ijin_keterangan($id)
	{
				
		$NIK=$this->session->userdata('NIK');
		$this->db->query("UPDATE tbl_surat_ijin_keterangan SET status='approve', NIK_REF='$NIK' WHERE id='$id'");
	}
	
	
	public function tolak_ijin_keterangan($id)
	{
				
		$NIK=$this->session->userdata('NIK');
		$this->db->query("UPDATE tbl_surat_ijin_keterangan SET status='cancel', NIK_REF='$NIK' WHERE id='$id'");
	}
	
	/*****************************************************************************ijin_keterangan*****************************************/
	
	
	
	
	
	public function absen_by_nik()
	{
		
		$nik = $this->input->post('nik', TRUE);
		$bulan = $this->input->post('bulan', TRUE);
        $tahun=date('Y');
		
		$q_tgl_bulan_ini = $this->m_absensi->m_tanggal_berisi_bulan($bulan);
			
		
		
		
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
    	$data['tgl_cut_tah']=$this->m_absensi->m_tbl_cuti_tahunan($nik,$bulan);
		$data['tgl_cut_sak']=$this->m_absensi->m_tbl_cuti_sakit($nik,$bulan);
		$data['tgl_cut_la']=$this->m_absensi->m_tbl_cuti_lain($nik,$bulan);
		$data['tbl_surat_ijin_keterangan']=$this->m_absensi->m_tbl_surat_ijin_keterangan($nik,$bulan);
		
		//ekinerja
		//$data['ekinerja'] = json_decode(exec_url("https://ekinerja.pakpakbharatkab.go.id/res/get_json_hasil.php?menu=laporan_bulanan&judul=Laporan%20Bulanan&aksi=cari&bulan=$bulan&nip=$nik"));
		$dat_ekinerja		= json_decode(exec_url("https://ekinerja.pakpakbharatkab.go.id/res/get_json_hasil.php?menu=laporan_bulanan&judul=Laporan%20Bulanan&aksi=cari&bulan=$bulan&nip=$nik"));
		
		if(isset($dat_ekinerja))
		{
			$data['ekinerja'] 	= $dat_ekinerja;
		}else{
			//$data['ekinerja'] 	= $dat_ekinerja;
			die("<script>alert('Server E-kinerja Sedang Overload. Cobalah beberapa saat lagi.')</script>");
		}
		
		
		$this->load->view('template/part/absen_by_nik_perorangan.php',$data);
	}
	
	
	
	public function form_print_absen_by_nik()
	{
		$this->load->view('template/part/form_print_rekap.php');
	}
	
	public function rekap_excel()
	{
		
	}
	
	public function print_absen_by_nik()
	{
		
		$nik = $this->input->get('nik', TRUE);
		$bulan = $this->input->get('bulan', TRUE);
    	$tahun = $this->input->get('tahun', TRUE);
		
		$q_tgl_bulan_ini = $this->m_absensi->m_tanggal_berisi_bulan($bulan,$tahun);
			

    	$data['hasil'] 	= $this->m_absensi->m_absen_by_fid($nik,$bulan,$tahun);
    	$data['nik']	= $nik;
    	$data['bulan']	= $bulan;
    	$data['tahun']	= $tahun;
		
		$data['info'] = $this->m_absensi->m_staf_info_by_nik_all($nik);
		

		$data['tgl_libur']=$this->m_absensi->m_tbl_libur($bulan,$tahun);
		$data['tgl_sakit']=$this->m_absensi->m_tbl_surat_sakit($nik,$bulan,$tahun);
		$data['tgl_dinas']=$this->m_absensi->m_tbl_dinas_luar($nik,$bulan,$tahun);
		$data['tgl_cut_sak']=$this->m_absensi->m_tbl_cuti_sakit($nik,$bulan,$tahun);
		$data['tgl_cut_la']=$this->m_absensi->m_tbl_cuti_lain($nik,$bulan,$tahun);
    	$data['tgl_cut_tah']=$this->m_absensi->m_tbl_cuti_tahunan($nik,$bulan,$tahun);
		$data['tbl_surat_ijin_keterangan']=$this->m_absensi->m_tbl_surat_ijin_keterangan($nik,$bulan,$tahun);
		//ekinerja
		//$data['ekinerja'] = json_decode(exec_url("https://ekinerja.pakpakbharatkab.go.id/res/get_json_hasil.php?menu=laporan_bulanan&judul=Laporan%20Bulanan&aksi=cari&bulan=$bulan&nip=$nik"));
		$dat_ekinerja		= json_decode(exec_url("https://ekinerja.pakpakbharatkab.go.id/res/get_json_hasil.php?menu=laporan_bulanan&judul=Laporan%20Bulanan&aksi=cari&bulan=$bulan&nip=$nik&keywords=$tahun"));
		
		if(isset($dat_ekinerja))
		{
			$data['ekinerja'] 	= $dat_ekinerja;
		}else{
			//$data['ekinerja'] 	= $dat_ekinerja;
			die("<script>alert('Server E-kinerja Sedang Overload. Cobalah beberapa saat lagi.')</script>");
		}
		
		
		
		$this->load->view('template/part/print_absen_by_nik.php',$data);
		
    
    	
    	//var_dump($q_tgl_bulan_ini);
		
		//var_dump($staff_arr);
		$filename = $nik."_".$bulan."_".date('d_m_y_h_i_s');
		
		// As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
		$pdfFilePath = FCPATH."downloads/$filename.pdf";
		$data['page_title'] = 'TPP BULAN '.$bulan.' TAHUN '. $tahun; // pass data to the view
		 
		if (file_exists($pdfFilePath) == FALSE)
		{
			ini_set('memory_limit', '2048M');
			//ini_set('memory_limit', '-1');
			//ini_set('memory_limit','32M'); // boost the memory limit if it's low <img class="emoji" draggable="false" alt="" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
			//$html = $this->load->view('laporan_mpdf/pdf_report', $data, true); // render the view into HTML
			$html = $this->load->view('template/part/print_absen_by_nik.php',$data,true);
			 
			$this->load->library('pdf_potrait');
			$pdf = $this->pdf_potrait->load();
			$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img class="emoji" draggable="false" alt="" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'F'); // save to file because we can
		}
		 
		redirect(base_url()."downloads/$filename.pdf","refresh");
		
		
		
		
	}
	
    
	
	public function absen_by_nik_perorang_excel()
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
		$dat_ekinerja		= json_decode(exec_url("https://ekinerja.pakpakbharatkab.go.id/res/get_json_hasil.php?menu=laporan_bulanan&judul=Laporan%20Bulanan&aksi=cari&bulan=$bulan&nip=$nik&keywords=$tahun"));
		
		if(isset($dat_ekinerja))
		{
			$data['ekinerja'] 	= $dat_ekinerja;
		}else{
			//$data['ekinerja'] 	= $dat_ekinerja;
			die("<script>alert('Server E-kinerja Sedang Overload. Cobalah beberapa saat lagi.')</script>");
		}
		
		
		
		$this->load->view('template/part/absen_by_nik_perorang_excel.php',$data);
	}
	
	
	public function absen_by_nik_perorang()
	{
		
		$nik = $this->input->post('nik', TRUE);
		$bulan = $this->input->post('bulan', TRUE);
    	$tahun = $this->input->post('tahun', TRUE);
		
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
		$dat_ekinerja		= json_decode(exec_url("https://ekinerja.pakpakbharatkab.go.id/res/get_json_hasil.php?menu=laporan_bulanan&judul=Laporan%20Bulanan&aksi=cari&bulan=$bulan&nip=$nik&keywords=$tahun"));
		
		if(isset($dat_ekinerja))
		{
			$data['ekinerja'] 	= $dat_ekinerja;
		}else{
			//$data['ekinerja'] 	= $dat_ekinerja;
			die("<script>alert('Server E-kinerja Sedang Overload. Cobalah beberapa saat lagi.')</script>");
		}
		
		
		
		
		
		$this->load->view('template/part/absen_by_nik_perorang.php',$data);
	}
	
	
    public function get_bulan_puasa()
    {
        $q = $this->db->query("SELECT * FROM  `tbl_bulan_puasa` ORDER BY id DESC LIMIT 1");
        $variable = $q->result();

        if($q->num_rows()>0)
        {

            $period = new DatePeriod(
                 new DateTime($variable[0]->tgl_mulai),
                 new DateInterval('P1D'),
                 new DateTime($variable[0]->tgl_selesai)
            );

        }

    
        foreach ($period as $key => $value) {
            $x[]= $value->format('Y-m-d');
        }
    
    	return $x;
    }

	
	
	public function set_libur()
	{
		
		$tanggal 	= $this->input->post('tanggal', TRUE);
		$keterangan	= $this->input->post('keterangan', TRUE);
		
		
		
		$serialize = array(
				'tgl_libur'		=> $tanggal,
				'desc_libur'	=> $keterangan				
			);
		
		$libur = $this->m_absensi->m_set_libur($serialize);
		
		
		$data['libur']=$libur;
		
		$this->load->view('template/part/all_libur.php',$data);
	}
	
	
	
	
	public function data_libur()
	{
				
		$libur = $this->m_absensi->m_data_libur();
		
		
		$data['libur']=$libur;
		
		$this->load->view('template/part/data_libur.php',$data);
	}
	
	
	
	
	
	public function data_staf_info()
	{
				
		$ID_OPD = $this->session->userdata('ID_OPD');
		$staf = $this->m_absensi->m_staf_info($ID_OPD);		
		
		$data['staf']=$staf;
		
		$this->load->view('template/part/data_staf.php',$data);
	}
	
	
	
	public function form_edit_staf($fid)
	{
				
		
		$staf = $this->m_absensi->m_staf_info_by_fid($fid);
		
		$data['staf']=$staf;
		
		$this->load->view('template/part/form_edit_staf.php',$data);
	}
	
	
	
	
	public function go_simpan_staf()
	{
				
		$FID = $this->input->post("FID");
		
		$serialize = array(
			'Nama' 		=> $this->input->post("NAMA"),
			'NIK' 		=> hanya_nomor($this->input->post("NIK")),
			'COSTUM_3' 	=> strtoupper($this->input->post("pangkat")),
			'COSTUM_4' 	=> strtoupper($this->input->post("golongan")),
			'COSTUM_5' 	=> hanya_nomor($this->input->post("npwp")),
			'JABATAN' 	=> $this->input->post("JABATAN")			
			
		);
		
		$a = $this->m_absensi->m_go_edit_staf($FID,$serialize);
		
		
		//bendahara gaji
		if((int)($this->input->post("bendahara"))==1)
		{
			$ID_OPD=$this->session->userdata('ID_OPD');			
			$this->db->query("DELETE FROM tbl_bendahara_gaji WHERE ID_OPD='$ID_OPD'");
			
			$serbend = array(
				'NAMA' 		=> $this->input->post("NAMA"),
				'NIP' 		=> hanya_nomor($this->input->post("NIK")),
				'FID' 		=> hanya_nomor($this->input->post("FID")),
				'PANGKAT' 	=> strtoupper($this->input->post("pangkat")),
				'GOLONGAN' 	=> strtoupper($this->input->post("golongan")),
				'ID_OPD' 	=> $ID_OPD,
				'JABATAN' 	=> $this->input->post("JABATAN")			
				
			);
			
			$this->db->insert('tbl_bendahara_gaji', $serbend);
			
		}
		
		print_r($serialize);
		
		
	}
	
	
}
