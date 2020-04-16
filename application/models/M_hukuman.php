<?php 
	if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_hukuman extends CI_Model {
		
		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
		}
		
	
		
		public function m_simpan_apel_pagi($arr)
		{
			$q = $this->db->insert('tbl_apel_pagi',$arr);
			
			return $this->db->insert_id();
		}
		
		
		
		public function m_tbl_apel_pagi()
		{
			
			$q = $this->db->query("
									SELECT a.*,b.NIP
										FROM tbl_apel_pagi a 
										LEFT JOIN (
                                        	SELECT COUNT(*) AS NIP,id_apel FROM tbl_apel_pagi_nip GROUP BY id_apel
                                        ) b
										ON a.id=b.id_apel
									ORDER BY tanggal DESC
								");
								
			return $q->result();
		}
		
		
		function m_tbl_apel_pagi_nip($id)
		{
			$q = $this->db->query("SELECT NIP FROM tbl_apel_pagi_nip WHERE id_apel ='$id'");
			return $q->result();
		}
		
		
	}
?>
