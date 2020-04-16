<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_apel_pagi extends CI_Model{

	function simpan_apelpagi($data)
	{
		$NIP=$data['NIP'];
		$this->db->query("INSERT INTO tbl_apel_pagi_admin SET NIP='$NIP'");
	}

	function cari_apel()
	{
		$q=$this->db->query("
				SELECT * FROM tbl_apel_pagi_admin order by id desc
			");
		return $q->result();
	}

	function hapus_apelpagi($id)
	{
		$this->db->query("DELETE FROM tbl_apel_pagi_admin WHERE id='$id'");
	}

	function cari_id($id)
	{
		$q=$this->db->query("SELECT * FROM tbl_apel_pagi_admin WHERE id='$id'");
		return $q->result();
	}

	function edit_data($id,$NIP)
	{
		$this->db->query("UPDATE tbl_apel_pagi_admin SET NIP='$NIP' WHERE id='$id'");
	}
}