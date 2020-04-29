<?php 
	if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_laporan extends CI_Model {
		
		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
		}
		
	
		
		public function m_opd()
		{
			$query = $this->db->query("SELECT * FROM `tbl_struktur` GROUP BY ID_OPD");
			$data 	= $query->result();			
			$row 	= $data;
			
			return $row;
		}
		
		
		public function m_hasil_akhir($nip)
		{
			$q = $this->db->query("SELECT * FROM `tbl_hasil_absen` WHERE nip='$nip' ORDER BY id DESC LIMIT 1");
			return $q->result();

		}

		

		public function m_hasil_by_bulan_nip($nip,$bulan,$tahun)
		{
			$q = $this->db->query("SELECT * FROM `tbl_hasil_absen` WHERE nip='$nip' AND bulan=('$bulan')*1 AND tahun='$tahun' ORDER BY id DESC LIMIT 1");
			return $q->result();

		}



		public function m_hasil_ekin($nip,$bulan,$tahun)
		{
			$q = $this->db->query("SELECT * FROM `tbl_hasil_ekin` WHERE nip='$nip' AND bulan=('$bulan')*1 AND tahun='$tahun' ORDER BY id DESC LIMIT 1");
			return $q->result();

		}


		public function m_staff_by_opd() 
		{			
			
			$id_opd=$this->session->userdata('ID_OPD');
			$query = $this->db->query("
										SELECT 
												a.FID,
												a.Nama,
												REPLACE(a.NIK, ' ', '') AS NIK,
												a.JABATAN,
												a.COSTUM_3 AS pangkat,
												a.COSTUM_4 AS golongan, 
												a.COSTUM_5 AS npwp  
											
												
											FROM hr_staff_info a
											WHERE LEFT(a.FID , 2)='$id_opd'																					
										");
			
			$data 	= $query->result();						
			return $data;
		}
        
        public function m_penanda_tangan($ID_OPD)
        {
            $q = $this->db->query("SELECT a.*,
                                            b.FID,
                                            b.Nama,
                                            REPLACE(b.NIK, ' ', '') AS NIK,
                                            b.JABATAN,
                                            b.COSTUM_3 AS pangkat,
                                            b.COSTUM_4 AS golongan, 
                                            b.COSTUM_5 AS npwp  

                                            FROM tbl_pimpinan a 
                                            LEFT JOIN 
                                            hr_staff_info b 
                                            ON a.NIP=REPLACE(b.NIK, ' ', '')
                                            WHERE a.ID_OPD='$ID_OPD'
                                    ");
            $x = $q->result();
            return $x[0];
        }
		
		public function m_bendahara_opd() 
		{			
			
			$id_opd=$this->session->userdata('ID_OPD');
			$query = $this->db->query("
										SELECT * FROM  `tbl_bendahara_gaji` 
											WHERE ID_OPD='$id_opd'																					
										");
			
			$data 	= $query->result();						
			$ret 	= $data[0];						
			return $ret;
		}
		
		
		




		public function m_staff_by_fid($Fid) 
		{			
						
			$query = $this->db->query("SELECT
												c.Fid,
												c.Nama,												
												REPLACE(c.NIK, ' ', '') AS Nik
										FROM hr_staff_info c
										WHERE Fid='$Fid'
												ORDER BY
												c.Fid ASC
											");
			
			$data 	= $query->result();						
			$ret 	= $data[0];						
			return $ret;
		}
		














	}



?>
