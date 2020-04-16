<?php 
	if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_vote extends CI_Model {
		
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
		
		
		


    
		public function m_staff($OPD) 
		{			
			
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
											WHERE LEFT(a.FID , 2)='$OPD'																					
										");
			
			$data 	= $query->result();						
			return $data;
		}
		
		public function m_bendahara_opd($OPD) 
		{			
			
			$query = $this->db->query("
										SELECT * FROM  `tbl_bendahara_gaji` 
											WHERE ID_OPD='$OPD'																					
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
