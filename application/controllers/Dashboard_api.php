<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_api extends CI_Controller {


	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');		
		$this->load->model('m_absensi');
		$this->load->helper('custom_func');		
		$this->load->helper('text');
		date_default_timezone_set("Asia/jakarta");
		header("Acces-Control-Allow-Origin:*");
		header("Acces-Control-Allow-Headers:*");
		header('Content-Type:application/json');



	}

	public function index()
	{
		echo "hash(algo, data)";
	}

	public function m_tanggal_berisi_bulan_ini($bulan)
	{

				$q = $this->db->query("SELECT tgl_berisi.tanggal 
										FROM (
												SELECT STR_TO_DATE(DateTime,'%d/%m/%Y') AS tanggal 
												FROM ta_log 
												WHERE 
													
													(
														DAYOFWEEK(STR_TO_DATE(DateTime,'%d/%m/%Y')) <> 1 AND DAYOFWEEK(STR_TO_DATE(DateTime,'%d/%m/%Y')) <> 7
													)
												
												
												GROUP BY tanggal
											)tgl_berisi
										WHERE (MONTH(tgl_berisi.tanggal) = '$bulan' AND YEAR(tgl_berisi.tanggal)=YEAR(NOW()))
										");
										
				$data 	= $q->result();						
				return $data;
	}

	public function xxx($id_opd,$date)
	{
			//$id_opd='12';
			//$date = '2018-09-12';

			
			//jumat biasa
			if(date('D', strtotime($date)) =='Fri')
			{
				$jam_masuk = '07:30:00';
				$jam_keluar= '16:30:00';
			}else{
				$jam_masuk = '07:30:00';
				$jam_keluar= '16:00:00';
			}
		


			
			$query = ("

				SELECT a.*, 
						CASE WHEN(b.keterangan IS NULL) THEN '0' ELSE '1' END AS is_dinas_luar,
						b.keterangan AS ket_dinas_luar 
				FROM (

					/*******************************************************************************/
						SELECT 
								a.*,
								CASE WHEN (a.waktu_masuk IS NULL AND a.waktu_keluar IS NULL) THEN '0' ELSE '1' END AS is_hadir,
								CASE 
									WHEN (a.waktu_masuk IS NULL AND a.waktu_keluar IS NULL) THEN '0'
									WHEN (a.cepat_pulang > 0) OR (a.telat_masuk > 0) THEN '1' 						
									ELSE '0' END AS is_telat
				 				FROM (

									SELECT
										c.Fid,
										c.Nama,												
										REPLACE(c.NIK, ' ', '') AS Nik,
										a.tanggal_masuk,
										a.waktu_masuk,
										a.jam_masuk,
										b.tanggal AS tanggal_keluar,
										b.jam AS jam_keluar,
										b.waktu AS waktu_keluar,

										/***** jika tidak finger berarti dianggap 61 telat ********/
										CASE WHEN (GREATEST((TIME_TO_SEC(TIMEDIFF(a.jam_masuk,'$jam_masuk'))/60),0)) IS NULL THEN 61 ELSE GREATEST((TIME_TO_SEC(TIMEDIFF(a.jam_masuk,'$jam_masuk'))/60),0) END  AS telat_masuk,
										CASE WHEN (GREATEST((TIME_TO_SEC(TIMEDIFF('$jam_keluar',b.jam))/60),0)) IS NULL THEN 61 ELSE GREATEST((TIME_TO_SEC(TIMEDIFF('$jam_keluar',b.jam))/60),0) END AS cepat_pulang


										FROM
										hr_staff_info c

										LEFT JOIN
										(
											SELECT f.*,MAX(f.waktu)
											FROM (
													SELECT Fid,Nama_Staff, STR_TO_DATE(DateTime,'%d/%m/%Y') AS tanggal,STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s') AS waktu, Jam_Log AS jam FROM ta_log

													WHERE (MONTH(STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s'))=MONTH('$date') AND YEAR(STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s'))=YEAR('$date') AND TIME(Jam_Log) BETWEEN TIME('15:00:00') and TIME('20:00:00')) ORDER BY waktu DESC
												 )f
											
											
											WHERE tanggal='$date'
											GROUP BY Fid

											ORDER BY (Fid*1)

										) b
											ON b.Fid=c.Fid
										LEFT JOIN
										(

											SELECT y.*,MIN(y.waktu_masuk)
											FROM (
													select `a`.`Fid` AS `Fid`,`a`.`Nama_Staff` AS `Nama_Staff`,str_to_date(`a`.`DateTime`,'%d/%m/%Y') AS `tanggal_masuk`,str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s') AS `waktu_masuk`,`a`.`Jam_Log` AS `jam_masuk` from `ta_log` `a` where ((month(str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s')) = MONTH('$date')) and (year(str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s')) = year('$date')) and (cast(`a`.`Jam_Log` as time) between cast('06:00:00' as time) and cast('10:00:00' as time))) order by str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s') asc

												)y
											
											WHERE tanggal_masuk='$date'
											GROUP BY Fid
											
											ORDER BY (Fid*1)

										) a
										ON c.Fid=a.Fid
										WHERE LEFT(c.Fid , 2)='$id_opd'
										ORDER BY
										c.Fid ASC
								)a
					/*******************************************************************************/

				)a

				LEFT JOIN 
				(
					SELECT * FROM tbl_dinas_luar WHERE status='approve' AND tanggal='$date'
				)b 

				ON a.Nik=b.NIK


				");

			$x = $this->db->query($query);
			//echo json_encode($x->result());

			return $x->result();
	}



	public function api()
	{
		header("Acces-Control-Allow-Origin:*");
		header("Acces-Control-Allow-Headers:*");
		header('Content-Type:application/json');

		$bulan = $this->input->get('bulan');
		$id_opd = $this->input->get('id_opd');

		$a = $this->m_tanggal_berisi_bulan_ini($bulan);
		$data = array();
		foreach ($a as $value) {
			# code...
			$data[$value->tanggal] = $this->xxx($id_opd,$value->tanggal);
			//$data[$value->tanggal] =  array($id_opd=>$value->tanggal);
		}

		echo json_encode($data);
	}

	public function opd()
	{
		$q = $this->db->query("SELECT * FROM  `v_tbl_opd_fix`");
		echo json_encode($q->result());
	}





	public function tester()
	{
			$id_opd='10';
			$date = '2018-09-12';

			
			//jumat biasa
			if(date('D', strtotime($date)) =='Fri')
			{
				$jam_masuk = '07:30:00';
				$jam_keluar= '16:30:00';
			}else{
				$jam_masuk = '07:30:00';
				$jam_keluar= '16:00:00';
			}
		


			
			$query = ("

				SELECT a.*, 
						CASE WHEN(b.keterangan IS NULL) THEN '0' ELSE '1' END AS is_dinas_luar,
						b.keterangan AS ket_dinas_luar 
				FROM (

					/*******************************************************************************/
						SELECT 
								a.*,
								CASE WHEN (a.waktu_masuk IS NULL AND a.waktu_keluar IS NULL) THEN '0' ELSE '1' END AS is_hadir,
								CASE 
									WHEN (a.waktu_masuk IS NULL AND a.waktu_keluar IS NULL) THEN '0'
									WHEN (a.cepat_pulang > 0) OR (a.telat_masuk > 0) THEN '1' 						
									ELSE '0' END AS is_telat
				 				FROM (

									SELECT
										c.Fid,
										c.Nama,												
										REPLACE(c.NIK, ' ', '') AS Nik,
										a.tanggal_masuk,
										a.waktu_masuk,
										a.jam_masuk,
										b.tanggal AS tanggal_keluar,
										b.jam AS jam_keluar,
										b.waktu AS waktu_keluar,

										/***** jika tidak finger berarti dianggap 61 telat ********/
										CASE WHEN (GREATEST((TIME_TO_SEC(TIMEDIFF(a.jam_masuk,'$jam_masuk'))/60),0)) IS NULL THEN 61 ELSE GREATEST((TIME_TO_SEC(TIMEDIFF(a.jam_masuk,'$jam_masuk'))/60),0) END  AS telat_masuk,
										CASE WHEN (GREATEST((TIME_TO_SEC(TIMEDIFF('$jam_keluar',b.jam))/60),0)) IS NULL THEN 61 ELSE GREATEST((TIME_TO_SEC(TIMEDIFF('$jam_keluar',b.jam))/60),0) END AS cepat_pulang


										FROM
										hr_staff_info c

										LEFT JOIN
										(
											SELECT f.*,MAX(f.waktu)
											FROM (
													SELECT Fid,Nama_Staff, STR_TO_DATE(DateTime,'%d/%m/%Y') AS tanggal,STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s') AS waktu, Jam_Log AS jam FROM ta_log

													WHERE (MONTH(STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s'))=MONTH('$date') AND YEAR(STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s'))=YEAR('$date') AND TIME(Jam_Log) BETWEEN TIME('15:00:00') and TIME('20:00:00')) ORDER BY waktu DESC
												 )f
											
											
											WHERE tanggal='$date'
											GROUP BY Fid

											ORDER BY (Fid*1)

										) b
											ON b.Fid=c.Fid
										LEFT JOIN
										(

											SELECT y.*,MIN(y.waktu_masuk)
											FROM (
													select `a`.`Fid` AS `Fid`,`a`.`Nama_Staff` AS `Nama_Staff`,str_to_date(`a`.`DateTime`,'%d/%m/%Y') AS `tanggal_masuk`,str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s') AS `waktu_masuk`,`a`.`Jam_Log` AS `jam_masuk` from `ta_log` `a` where ((month(str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s')) = MONTH('$date')) and (year(str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s')) = year('$date')) and (cast(`a`.`Jam_Log` as time) between cast('06:00:00' as time) and cast('10:00:00' as time))) order by str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s') asc

												)y
											
											WHERE tanggal_masuk='$date'
											GROUP BY Fid
											
											ORDER BY (Fid*1)

										) a
										ON c.Fid=a.Fid
										WHERE LEFT(c.Fid , 2)='$id_opd'
										ORDER BY
										c.Fid ASC
								)a
					/*******************************************************************************/

				)a

				LEFT JOIN 
				(
					SELECT * FROM tbl_dinas_luar WHERE status='approve' AND tanggal='$date'
				)b 

				ON a.Nik=b.NIK


				");

			
			echo $query;
	}
	
}
