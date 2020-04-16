<?php
class Ijin_download Extends CI_Controller{
	

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');				
		$this->load->helper('custom_func');
		

	}
	public function form()
	{
		$q = $this->db->query("SELECT a.*,b.OPD FROM tbl_setting_download a INNER JOIN (SELECT ID_OPD,OPD FROM `tbl_struktur` GROUP BY ID_OPD)b ON a.id_opd=b.ID_OPD  ");
		$x = $q->result();		

		$z = $this->db->query("SELECT ID_OPD,OPD FROM `tbl_struktur` GROUP BY ID_OPD");
		$y = $z->result();

		$data['all'] = $x;
		$data['all_opd'] = $y;


		$this->load->view('template/part/data_ijin_download',$data);
	}

	public function simpan()
	{
		$id_opd = $this->input->post('id_opd');
		$this->db->query("INSERT INTO tbl_setting_download SET id_opd='$id_opd'");
	}

	public function tutup($id_opd)
	{		
		$this->db->query("DELETE FROM tbl_setting_download WHERE id_opd='$id_opd'");
	}



}