<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pimpinan extends CI_Model {

	function simpan_pimpinan($data,$table)
	{
		$this->db->insert($table,$data);
	}

	function pimpinan()
	{
		$q=$this->db->query("SELECT a.*,b.OPD,c.NAMA,c.FID 
        						FROM 
                              tbl_pimpinan a 
                              INNER JOIN 
                              	(
                                	SELECT  `ID_OPD` ,  `OPD` FROM  `tbl_struktur` GROUP BY ID_OPD
                                )b
                               ON a.ID_OPD=b.ID_OPD
                               INNER JOIN 
                               	(
                                	SELECT Nama AS NAMA ,FID,NIK FROM  `hr_staff_info`
                                )c
								ON a.NIP=REPLACE(c.NIK, ' ', '')
                              order by id_pimpinan desc");

		return $q->result();
	}

	function cari_id($id_pimpinan)
	{
		$q=$this->db->query("SELECT * FROM tbl_pimpinan WHERE id_pimpinan='$id_pimpinan'");

		return $q->result();
	}

	function simpan_edit($data,$id,$table)
	{
		$this->db->where($id);
		$this->db->update($table,$data);
	}

	function hapus($id_pimpinan)
	{
		$this->db->query("DELETE FROM tbl_pimpinan WHERE id_pimpinan='$id_pimpinan'");
	}
}