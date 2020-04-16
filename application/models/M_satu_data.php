<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_satu_data extends CI_Model{

	function simpan_satudata($data)
	{
		$NIP=$data['NIP'];
		$this->db->query("INSERT INTO tbl_admin_satudata SET NIP='$NIP'");
	}

	function cari_satudata()
	{
		$q=$this->db->query("
				SELECT * FROM tbl_admin_satudata order by id desc
			");
		return $q->result();
	}

	function hapus_satudata($id)
	{
		$this->db->query("DELETE FROM tbl_admin_satudata WHERE id='$id'");
	}

	function cari_id($id)
	{
		$q=$this->db->query("SELECT * FROM tbl_admin_satudata WHERE id='$id'");
		return $q->result();
	}

	function edit_data($id,$NIP)
	{
		$this->db->query("UPDATE tbl_admin_satudata SET NIP='$NIP' WHERE id='$id'");
	}
}