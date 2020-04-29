<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');		
		$this->load->helper('custom_func');
		date_default_timezone_set("Asia/jakarta");
	}

	public function index() {
        //die("Maaf.. sedang perbaikan...");
		$data['title']="Login";
		$this->load->helper('url');
		$this->load->helper(array('form'));
		$this->load->view('template/login.php',$data);
        //var_dump($_COOKIE['nip']);
        
        
        if(isset($_COOKIE['nip']) && $_COOKIE['nip']!='')
        {
         //var_dump($_COOKIE['nip']);   
            
                    $NIK=$_COOKIE['nip'];
					$qqq = $this->db->query("SELECT 
													REPLACE(a.NIK, ' ', '') AS Nik,
													a.FID,
													a.COSTUM_1 AS eselon,
													a.COSTUM_2 AS password,
													a.COSTUM_3 AS TPP,
													a.JABATAN,
													a.Nama,
													b.OPD,
													LEFT(a.FID , 2) AS ID_OPD
													
													
												FROM hr_staff_info a 
												
												LEFT JOIN tbl_struktur b 
												ON LEFT(a.FID , 2)=b.ID_OPD 
												
												
												WHERE REPLACE(a.NIK, ' ', '')='$NIK'
												LIMIT 1
												");
		
					if($qqq->num_rows() > 0)
					{
						foreach($qqq->result() as $a)			
						{
									

							$sess_data['NIK'] 		= $NIK;
							$sess_data['FID'] 		= $a->FID;
							$sess_data['ESELON'] 	= $a->eselon;
							$sess_data['JABATAN'] 	= $a->JABATAN;
							$sess_data['NAMA'] 		= $a->Nama;
							$sess_data['OPD'] 		= $a->OPD;
							$sess_data['ID_OPD']	= $a->ID_OPD;
							$sess_data['TPP']		= $a->TPP;
							
							$this->session->set_userdata($sess_data);
							
							//die("1");
                            $base = base_url();
                            header("location:$base");
						}
					}else{
						//die("0");
					}
        }
	}


	private function gas($x)
	{
		$a = stripslashes(strip_tags(htmlspecialchars($x,ENT_QUOTES)));
		$a = str_replace("'", "", $a);
		return $a;
	}

	public function cek_login() {
		
		
        $NIK 		   = $this->gas(trim(str_replace(" ","",$this->input->post('NIK', TRUE))));
        $password    = trim(md5($this->input->post('password', TRUE)));    
        
		$hasil = $this->db->query("SELECT 
													REPLACE(a.NIK, ' ', '') AS Nik,
													a.FID,
													a.COSTUM_1 AS eselon,
													a.COSTUM_2 AS password,
													a.COSTUM_3 AS TPP,
													a.JABATAN,
													a.Nama,
													b.OPD,
													LEFT(a.FID , 2) AS ID_OPD
													
												FROM hr_staff_info a 
												
												LEFT JOIN tbl_struktur b 
												ON LEFT(a.FID , 2)=b.ID_OPD
												
												
												WHERE REPLACE(a.NIK, ' ', '')='$NIK'
												LIMIT 1
												");
		
		
		
		if ($hasil->num_rows() > 0) 
		{
			$qq = $hasil->result();
			foreach($qq as $a)			
			{
				if($a->password=='')
				{
					$new_pass = md5($NIK);
					$this->db->query("UPDATE hr_staff_info SET COSTUM_2='$new_pass' WHERE FID='$a->FID'");
					
					
					
					$sess_data['NIK'] 		= $NIK;
					$sess_data['FID'] 		= $a->FID;
					$sess_data['ESELON'] 	= $a->eselon;
					$sess_data['JABATAN'] 	= $a->JABATAN;
					$sess_data['NAMA'] 		= $a->Nama;
					$sess_data['OPD'] 		= $a->OPD;
					$sess_data['ID_OPD']	= $a->ID_OPD;
					$sess_data['TPP']		= $a->TPP;
					
					$this->session->set_userdata($sess_data);
					
                    setcookie('nip', $sess_data['NIK'], 0, "/",".pakpakbharatkab.go.id"); // 86400 = 1 day ,".pakpakbharatkab.go.id"
                    
					die("1");
					
				}else{
					
					
					$qqq = $this->db->query("SELECT 
													REPLACE(a.NIK, ' ', '') AS Nik,
													a.FID,
													a.COSTUM_1 AS eselon,
													a.COSTUM_2 AS password,
													a.COSTUM_3 AS TPP,
													a.JABATAN,
													a.Nama,
													b.OPD,
													LEFT(a.FID , 2) AS ID_OPD
													
													
												FROM hr_staff_info a 
												
												LEFT JOIN tbl_struktur b 
												ON LEFT(a.FID , 2)=b.ID_OPD 
												
												
												WHERE REPLACE(a.NIK, ' ', '')='$NIK' AND COSTUM_2='$password'
												LIMIT 1
												");
		
					if($qqq->num_rows() > 0)
					{
						foreach($qqq->result() as $a)			
						{
									
							$sess_data['NIK'] 		= $NIK;
							$sess_data['FID'] 		= $a->FID;
							$sess_data['ESELON'] 	= $a->eselon;
							$sess_data['JABATAN'] 	= $a->JABATAN;
							$sess_data['NAMA'] 		= $a->Nama;
							$sess_data['OPD'] 		= $a->OPD;
							$sess_data['ID_OPD']	= $a->ID_OPD;
							$sess_data['TPP']		= $a->TPP;
							
							$this->session->set_userdata($sess_data);
							
                            setcookie('nip', $sess_data['NIK'], 0, "/",".pakpakbharatkab.go.id"); // 86400 = 1 day ,".pakpakbharatkab.go.id"
                            
							die("1");
						}
					}else{
						die("0");
					}
				}
			}
			
		}else{
			die("0");
		}
		
                
		
	}
    
    
    public function cek_login_webview() {
		
		
        
         $NIK 		  = $this->gas(trim(str_replace(" ","",$this->input->get('NIK', TRUE))));
         $password    = trim(md5($this->input->get('password', TRUE)));    
            
		
		$hasil = $this->db->query("SELECT 
													REPLACE(a.NIK, ' ', '') AS Nik,
													a.FID,
													a.COSTUM_1 AS eselon,
													a.COSTUM_2 AS password,
													a.COSTUM_3 AS TPP,
													a.JABATAN,
													a.Nama,
													b.OPD,
													LEFT(a.FID , 2) AS ID_OPD
													
												FROM hr_staff_info a 
												
												LEFT JOIN tbl_struktur b 
												ON LEFT(a.FID , 2)=b.ID_OPD
												
												
												WHERE REPLACE(a.NIK, ' ', '')='$NIK'
												LIMIT 1
												");
		
		
		
		if ($hasil->num_rows() > 0) 
		{
			$qq = $hasil->result();
			foreach($qq as $a)			
			{
				if($a->password=='')
				{
					$new_pass = md5($NIK);
					$this->db->query("UPDATE hr_staff_info SET COSTUM_2='$new_pass' WHERE FID='$a->FID'");
					
					
					
					$sess_data['NIK'] 		= $NIK;
					$sess_data['FID'] 		= $a->FID;
					$sess_data['ESELON'] 	= $a->eselon;
					$sess_data['JABATAN'] 	= $a->JABATAN;
					$sess_data['NAMA'] 		= $a->Nama;
					$sess_data['OPD'] 		= $a->OPD;
					$sess_data['ID_OPD']	= $a->ID_OPD;
					$sess_data['TPP']		= $a->TPP;
					
					$this->session->set_userdata($sess_data);
					
                    setcookie('nip', $sess_data['NIK'], 0, "/",".pakpakbharatkab.go.id"); // 86400 = 1 day ,".pakpakbharatkab.go.id"
                    
                    $url = base_url();
                    header('Location: '.$url);
					die("1");
					
				}else{
					
					
					$qqq = $this->db->query("SELECT 
													REPLACE(a.NIK, ' ', '') AS Nik,
													a.FID,
													a.COSTUM_1 AS eselon,
													a.COSTUM_2 AS password,
													a.COSTUM_3 AS TPP,
													a.JABATAN,
													a.Nama,
													b.OPD,
													LEFT(a.FID , 2) AS ID_OPD
													
													
												FROM hr_staff_info a 
												
												LEFT JOIN tbl_struktur b 
												ON LEFT(a.FID , 2)=b.ID_OPD 
												
												
												WHERE REPLACE(a.NIK, ' ', '')='$NIK' AND COSTUM_2='$password'
												LIMIT 1
												");
		
					if($qqq->num_rows() > 0)
					{
						foreach($qqq->result() as $a)			
						{
									
							$sess_data['NIK'] 		= $NIK;
							$sess_data['FID'] 		= $a->FID;
							$sess_data['ESELON'] 	= $a->eselon;
							$sess_data['JABATAN'] 	= $a->JABATAN;
							$sess_data['NAMA'] 		= $a->Nama;
							$sess_data['OPD'] 		= $a->OPD;
							$sess_data['ID_OPD']	= $a->ID_OPD;
							$sess_data['TPP']		= $a->TPP;
							
							$this->session->set_userdata($sess_data);
							
                            setcookie('nip', $sess_data['NIK'], 0, "/",".pakpakbharatkab.go.id"); // 86400 = 1 day ,".pakpakbharatkab.go.id"
                            
                            $url = base_url();
                            header('Location: '.$url);
							die("1");
						}
					}else{
						die("0");
					}
				}
			}
			
		}else{
			die("0");
		}
		
                
		
	}
	
	public function logout() {
		
		
		$id_admin = $this->session->userdata('id_admin');			
		$this->db->query("INSERT INTO tbl_log_admin SET id_admin='$id_admin', referensi='$id_admin',aktivitas='Logout'");


		
		$this->session->unset_userdata('TPP');	
		$this->session->unset_userdata('NIK');	
		session_destroy();
        
        $this->load->helper('cookie');
        delete_cookie($_COOKIE['nip']);
        unset($_COOKIE[$cookie]);
		setcookie("nip", "", 0, "/",".pakpakbharatkab.go.id");
		redirect('index.php/login');
		//redirect('http://ujicoba.pakpakbharatkab.go.id/sso/login/logout');
        
	}
	
	
	
	
	
	
}