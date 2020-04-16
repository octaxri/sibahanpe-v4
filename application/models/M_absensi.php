<?php 
	if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_absensi extends CI_Model {
		
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
		
		
		public function ambil_gambar($fid)
		{
			$q = $this->db->query("SELECT image,Fid 
									FROM `ta_log` 
									WHERE image <> '' AND Fid='$fid'									
									ORDER BY id DESC
								");
			return $q->result();
		}
		
		
		public function update_data_session_user($data_update,$cetak,$NIK) 
		{			
			$this->db->query("UPDATE hr_staff_info SET COSTUM_2='$data_update', COSTUM_6='$cetak' WHERE REPLACE(NIK, ' ', '')='$NIK'");			
			
		}
		
		
		public function m_absen_kemarin() 
		{			
			$query = $this->db->query("SELECT
												c.Fid,
												c.Nama,												
												REPLACE(c.NIK, ' ', '') AS Nik,
												a.tanggal_masuk,
												a.waktu_masuk,
												a.jam_masuk,
												b.tanggal AS tanggal_keluar,
												b.jam AS jam_keluar,
												b.waktu AS waktu_keluar,

												GREATEST((TIME_TO_SEC(TIMEDIFF(a.jam_masuk,'07:30:00'))/60),0) AS telat_masuk,
												GREATEST((TIME_TO_SEC(TIMEDIFF('16:00:00',b.jam))/60),0) AS cepat_pulang

												FROM
												hr_staff_info c

												LEFT JOIN
												(
													SELECT f.*,MAX(f.waktu)
													FROM (
															SELECT Fid,Nama_Staff, STR_TO_DATE(DateTime,'%d/%m/%Y') AS tanggal,STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s') AS waktu, Jam_Log AS jam FROM ta_log

															WHERE (MONTH(STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s'))=MONTH(NOW()) AND YEAR(STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s'))=YEAR(NOW()) AND TIME(Jam_Log) BETWEEN TIME('15:00:00') and TIME('23:00:00')) ORDER BY waktu DESC
														 )f
													WHERE
													DAY(tanggal)=DAY(NOW() - INTERVAL 1 DAY)
													GROUP BY Fid
													ORDER BY (Fid*1)

												) b
													ON b.Fid=c.Fid
												LEFT JOIN
												(

													SELECT y.*,MIN(y.waktu_masuk)
													FROM (
															select `a`.`Fid` AS `Fid`,`a`.`Nama_Staff` AS `Nama_Staff`,str_to_date(`a`.`DateTime`,'%d/%m/%Y') AS `tanggal_masuk`,str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s') AS `waktu_masuk`,`a`.`Jam_Log` AS `jam_masuk` from `ta_log` `a` where ((month(str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s')) = month(now())) and (year(str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s')) = year(now())) and (cast(`a`.`Jam_Log` as time) between cast('06:00:00' as time) and cast('11:00:00' as time))) order by str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s') desc

														)y
													WHERE
													DAY(tanggal_masuk)=DAY(NOW() - INTERVAL 1 DAY)
													GROUP BY Fid
													ORDER BY (Fid*1)

												) a
												ON c.Fid=a.Fid

												ORDER BY
												c.Fid ASC
											");
			$data 	= $query->result();						
			return $data;
		}
		
		public function m_absen_hari_ini() 
		{			
			$query = $this->db->query("SELECT
												c.Fid,
												c.Nama,												
												REPLACE(c.NIK, ' ', '') AS Nik,
												a.tanggal_masuk,
												a.waktu_masuk,
												a.jam_masuk,
												b.tanggal AS tanggal_keluar,
												b.jam AS jam_keluar,
												b.waktu AS waktu_keluar,

												GREATEST((TIME_TO_SEC(TIMEDIFF(a.jam_masuk,'07:30:00'))/60),0) AS telat_masuk,
												GREATEST((TIME_TO_SEC(TIMEDIFF('16:00:00',b.jam))/60),0) AS cepat_pulang

												FROM
												hr_staff_info c

												LEFT JOIN
												(
													SELECT f.*,MAX(f.waktu)
													FROM (
															SELECT Fid,Nama_Staff, STR_TO_DATE(DateTime,'%d/%m/%Y') AS tanggal,STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s') AS waktu, Jam_Log AS jam FROM ta_log

															WHERE (MONTH(STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s'))=MONTH(NOW()) AND YEAR(STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s'))=YEAR(NOW()) AND TIME(Jam_Log) BETWEEN TIME('15:00:00') and TIME('23:00:00')) ORDER BY waktu DESC
														 )f
													WHERE
													DAY(tanggal)=DAY(NOW())
													GROUP BY Fid
													ORDER BY (Fid*1)

												) b
													ON b.Fid=c.Fid
												LEFT JOIN
												(

													SELECT y.*,MIN(y.waktu_masuk)
													FROM (
															select `a`.`Fid` AS `Fid`,`a`.`Nama_Staff` AS `Nama_Staff`,str_to_date(`a`.`DateTime`,'%d/%m/%Y') AS `tanggal_masuk`,str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s') AS `waktu_masuk`,`a`.`Jam_Log` AS `jam_masuk` from `ta_log` `a` where ((month(str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s')) = month(now())) and (year(str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s')) = year(now())) and (cast(`a`.`Jam_Log` as time) between cast('06:00:00' as time) and cast('11:00:00' as time))) order by str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s') desc

														)y
													WHERE
													DAY(tanggal_masuk)=DAY(NOW())
													GROUP BY Fid
													ORDER BY (Fid*1)

												) a
												ON c.Fid=a.Fid

												ORDER BY
												c.Fid ASC
											");
			$data 	= $query->result();						
			return $data;
		}
		
		public function m_absen_by_date_in_opd($date)
		{			
			
			$id_opd=$this->session->userdata('ID_OPD');
			

			$tgl_puasa = $this->get_bulan_puasa();

			if(in_array($date, $tgl_puasa))
			{

				//jumat puasa
				if(date('D', strtotime($date)) =='Fri')
				{
					$jam_masuk = '08:00:00';
					$jam_keluar= '16:00:00';
				}else{
					$jam_masuk = '08:00:00';
					$jam_keluar= '15:30:00';
				}

			}else{
				
				//jumat biasa
				if(date('D', strtotime($date)) =='Fri')
				{
					$jam_masuk = '07:30:00';
					$jam_keluar= '16:30:00';
				}else{
					$jam_masuk = '07:30:00';
					$jam_keluar= '16:00:00';
				}
			}


			
			$query = $this->db->query("SELECT
												c.Fid,
												c.Nama,												
												REPLACE(c.NIK, ' ', '') AS Nik,
												a.tanggal_masuk,
												a.waktu_masuk,
												a.jam_masuk,
												b.tanggal AS tanggal_keluar,
												b.jam AS jam_keluar,
												b.waktu AS waktu_keluar,

												GREATEST((TIME_TO_SEC(TIMEDIFF(a.jam_masuk,'$jam_masuk'))/60),0) AS telat_masuk,
												GREATEST((TIME_TO_SEC(TIMEDIFF('$jam_keluar',b.jam))/60),0) AS cepat_pulang

												FROM
												hr_staff_info c

												LEFT JOIN
												(
													SELECT f.*,MAX(f.waktu)
													FROM (
															SELECT Fid,Nama_Staff, STR_TO_DATE(DateTime,'%d/%m/%Y') AS tanggal,STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s') AS waktu, Jam_Log AS jam FROM ta_log

															WHERE (MONTH(STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s'))=MONTH('$date') AND YEAR(STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s'))=YEAR('$date') AND TIME(Jam_Log) BETWEEN TIME('15:00:00') and TIME('20:00:00')) ORDER BY waktu DESC
														 )f
													WHERE
													tanggal='$date'
													GROUP BY Fid
													ORDER BY (Fid*1)

												) b
													ON b.Fid=c.Fid
												LEFT JOIN
												(

													SELECT y.*,MIN(y.waktu_masuk)
													FROM (
															select `a`.`Fid` AS `Fid`,`a`.`Nama_Staff` AS `Nama_Staff`,str_to_date(`a`.`DateTime`,'%d/%m/%Y') AS `tanggal_masuk`,str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s') AS `waktu_masuk`,`a`.`Jam_Log` AS `jam_masuk` from `ta_log` `a` where ((month(str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s')) = MONTH('$date')) and (year(str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s')) = year('$date')) and (cast(`a`.`Jam_Log` as time) between cast('06:00:00' as time) and cast('11:00:00' as time))) order by str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s') asc

														)y
													WHERE													
													tanggal_masuk='$date'
													GROUP BY Fid
													ORDER BY (Fid*1)

												) a
												ON c.Fid=a.Fid
												WHERE LEFT(c.Fid , 2)='$id_opd'
												ORDER BY
												c.Fid ASC
										");
			$data 	= $query->result();						
			return $data;
		}
		
		public function m_absen_by_date($date)
		{			
			
			$query = $this->db->query("SELECT
												c.Fid,
												c.Nama,												
												REPLACE(c.NIK, ' ', '') AS Nik,
												a.tanggal_masuk,
												a.waktu_masuk,
												a.jam_masuk,
												b.tanggal AS tanggal_keluar,
												b.jam AS jam_keluar,
												b.waktu AS waktu_keluar,

												GREATEST((TIME_TO_SEC(TIMEDIFF(a.jam_masuk,'07:30:00'))/60),0) AS telat_masuk,
												GREATEST((TIME_TO_SEC(TIMEDIFF('16:00:00',b.jam))/60),0) AS cepat_pulang

												FROM
												hr_staff_info c

												LEFT JOIN
												(
													SELECT f.*,MAX(f.waktu)
													FROM (
															SELECT Fid,Nama_Staff, STR_TO_DATE(DateTime,'%d/%m/%Y') AS tanggal,STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s') AS waktu, Jam_Log AS jam FROM ta_log

															WHERE (MONTH(STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s'))=MONTH('$date') AND YEAR(STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s'))=YEAR('$date') AND TIME(Jam_Log) BETWEEN TIME('15:00:00') and TIME('20:00:00')) ORDER BY waktu DESC
														 )f
													WHERE
													tanggal='$date'
													GROUP BY Fid
													ORDER BY (Fid*1)

												) b
													ON b.Fid=c.Fid
												LEFT JOIN
												(

													SELECT y.*,MIN(y.waktu_masuk)
													FROM (
															select `a`.`Fid` AS `Fid`,`a`.`Nama_Staff` AS `Nama_Staff`,str_to_date(`a`.`DateTime`,'%d/%m/%Y') AS `tanggal_masuk`,str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s') AS `waktu_masuk`,`a`.`Jam_Log` AS `jam_masuk` from `ta_log` `a` where ((month(str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s')) = MONTH('$date')) and (year(str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s')) = year('$date')) and (cast(`a`.`Jam_Log` as time) between cast('06:00:00' as time) and cast('11:00:00' as time))) order by str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s') desc

														)y
													WHERE													
													tanggal_masuk='$date'
													GROUP BY Fid
													ORDER BY (Fid*1)

												) a
												ON c.Fid=a.Fid												
												ORDER BY
												c.Fid ASC
										");
			$data 	= $query->result();						
			return $data;
		}
		
		public function m_absen_by_nik($nik,$date)
		{			

			
			$tgl_puasa = $this->get_bulan_puasa();

			if(in_array($date, $tgl_puasa))
			{

				//jumat puasa
				if(date('D', strtotime($date)) =='Fri')
				{
					$jam_masuk = '08:00:00';
					$jam_keluar= '16:00:00';
				}else{
					$jam_masuk = '08:00:00';
					$jam_keluar= '15:30:00';
				}

			}else{
				
				//jumat biasa
				if(date('D', strtotime($date)) =='Fri')
				{
					$jam_masuk = '07:30:00';
					$jam_keluar= '16:30:00';
				}else{
					$jam_masuk = '07:30:00';
					$jam_keluar= '16:00:00';
				}
			}


			
			
			$query = $this->db->query("	SELECT
												c.Fid,
												c.Nama,												
												REPLACE(c.NIK, ' ', '') AS Nik,
												a.tanggal_masuk,
												a.waktu_masuk,
												a.jam_masuk,
												b.tanggal AS tanggal_keluar,
												b.jam AS jam_keluar,
												b.waktu AS waktu_keluar,

												GREATEST((TIME_TO_SEC(TIMEDIFF(a.jam_masuk,'$jam_masuk'))/60),0) AS telat_masuk,
												GREATEST((TIME_TO_SEC(TIMEDIFF('$jam_keluar',b.jam))/60),0) AS cepat_pulang

												FROM
												hr_staff_info c

												LEFT JOIN
												(
													SELECT f.*,MAX(f.waktu)
													FROM (
															SELECT 
																Fid,
																Nama_Staff, 
																STR_TO_DATE(DateTime,'%d/%m/%Y') AS tanggal,
																STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s') AS waktu, 
																Jam_Log AS jam FROM ta_log

															WHERE 
																(
																	MONTH(STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s'))=MONTH('$date') 
																	AND 
																	YEAR(STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s'))=YEAR('$date') 
																	AND 
																	TIME(Jam_Log) BETWEEN TIME('15:00:00') 
																	AND 
																	TIME('23:00:00')) ORDER BY waktu DESC
														 )f
													WHERE
															tanggal = '$date' 
														
															
													GROUP BY Fid
													ORDER BY (Fid*1)

												) b
													ON b.Fid=c.Fid
												LEFT JOIN
												(

													SELECT y.*,MIN(y.waktu_masuk)
													FROM (
															SELECT 
																`a`.`Fid` AS `Fid`,
																`a`.`Nama_Staff` AS `Nama_Staff`,
																str_to_date(`a`.`DateTime`,'%d/%m/%Y') AS `tanggal_masuk`,
																str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s') AS `waktu_masuk`,
																`a`.`Jam_Log` AS `jam_masuk` from `ta_log` `a` 
																where ((month(str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s')) = MONTH('$date')) 
																	AND 
																(year(str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s')) = year('$date')) 
																	AND 
																(cast(`a`.`Jam_Log` as time) between cast('06:00:00' as time) 
																	AND 
																cast('11:00:00' as time))) order by str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s') asc

														)y
													WHERE													
														tanggal_masuk='$date'
														
													GROUP BY Fid
													ORDER BY (Fid*1)

												) a
												ON c.Fid=a.Fid
												
												WHERE REPLACE(c.NIK, ' ', '')='$nik' 
												
												ORDER BY
												c.Fid ASC
										");
										
			$data 	= $query->result();						
			return $data;
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


	    private function fid_by_nik($nik)
	    {
	    	$q = $this->db->query("SELECT FID FROM hr_staff_info WHERE NIK='$nik'");
	    	$a = $q->result();
	    	return $a[0]->FID;
	    }


	    public function m_absen_by_fid($nik,$bulan,$tahun)
	    {

	    	$fid = $this->fid_by_nik($nik);

				$jam_masuk_puasa = '08:00:00';
				$jam_keluar_jumat_puasa= '16:00:00';
				$jam_keluar_puasa= '15:30:00';
			
				$jam_masuk = '07:30:00';
				$jam_keluar_jumat= '16:30:00';
				$jam_keluar= '16:00:00';
			
			$tgl_awal_puasa = '0000-00-00';
			$tgl_akhir_puasa = '0000-00-00';
			$puasa = $this->db->query("SELECT * FROM `tbl_bulan_puasa` ORDER BY id DESC LIMIT 1");
			foreach ($puasa->result() as $pu) {
				$tgl_awal_puasa = $pu->tgl_mulai;
				$tgl_akhir_puasa = $pu->tgl_selesai;
			}


	    	$q = "SELECT 
						a.tanggal,
						'$fid' AS Fid,
						b.waktu_masuk,
						b.jam_masuk,
						c.jam AS jam_keluar,
						c.waktu AS waktu_keluar,
						d.NIK,
						d.Nama,

											
					/******* jam masuk jika puasa *******/
					CASE 
						WHEN a.tanggal BETWEEN '$tgl_awal_puasa' AND '$tgl_akhir_puasa' 
						THEN FLOOR(GREATEST((TIME_TO_SEC(TIMEDIFF(b.jam_masuk,'$jam_masuk_puasa'))/60),0)) 
						ELSE FLOOR(GREATEST((TIME_TO_SEC(TIMEDIFF(b.jam_masuk,'$jam_masuk'))/60),0)) 
						END AS telat_masuk,


					CASE 
						WHEN a.tanggal BETWEEN '$tgl_awal_puasa' AND '$tgl_akhir_puasa' AND DAYNAME(a.tanggal)='Friday'
						THEN FLOOR(GREATEST((TIME_TO_SEC(TIMEDIFF('$jam_keluar_jumat_puasa',c.jam))/60),0))

						WHEN a.tanggal BETWEEN '$tgl_awal_puasa' AND '$tgl_akhir_puasa' AND DAYNAME(a.tanggal)<>'Friday'
						THEN FLOOR(GREATEST((TIME_TO_SEC(TIMEDIFF('$jam_keluar_puasa',c.jam))/60),0))

						ELSE FLOOR(GREATEST((TIME_TO_SEC(TIMEDIFF('$jam_keluar',c.jam))/60),0))
						END AS cepat_pulang

						FROM
						(
							SELECT STR_TO_DATE(DateTime,'%d/%m/%Y') AS tanggal 
							FROM ta_log 
							WHERE 
								(
									DAYOFWEEK(STR_TO_DATE(DateTime,'%d/%m/%Y')) <> 1 AND DAYOFWEEK(STR_TO_DATE(DateTime,'%d/%m/%Y')) <> 7  
									AND STR_TO_DATE(DateTime,'%d/%m/%Y') <= CURDATE()
								)
								AND 
								MONTH(STR_TO_DATE(DateTime,'%d/%m/%Y')) = '$bulan' AND YEAR(STR_TO_DATE(DateTime,'%d/%m/%Y'))='$tahun'
							GROUP BY tanggal
							ORDER BY tanggal ASC
						)a 

						LEFT JOIN 
						(
							SELECT y.*,MIN(y.waktu_masuk)
								FROM (
									
									SELECT 
										Fid, 
										STR_TO_DATE(DateTime,'%d/%m/%Y') AS tanggal_masuk,
										STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s') AS waktu_masuk, 
										Jam_Log AS jam_masuk 
									FROM ta_log
								
									WHERE 
										(
											MONTH(STR_TO_DATE(DateTime,'%d/%m/%Y')) = '$bulan' 
											AND 
											YEAR(STR_TO_DATE(DateTime,'%d/%m/%Y'))='$tahun'
										)
										AND Fid='$fid'
										AND TIME(Jam_Log) BETWEEN TIME('06:00:00') AND TIME('11:00:00')
										
					                                                         
									ORDER BY waktu_masuk ASC

										)y
									
								GROUP BY Fid,tanggal_masuk
								ORDER BY tanggal_masuk DESC,(Fid*1) ASC

						)b ON a.tanggal=b.tanggal_masuk

						LEFT JOIN 
						(
							SELECT f.*,MAX(f.waktu)
									FROM (
											SELECT Fid, STR_TO_DATE(DateTime,'%d/%m/%Y') AS tanggal,STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s') AS waktu, Jam_Log AS jam 
											FROM ta_log

											WHERE 
											
												(
													MONTH(STR_TO_DATE(DateTime,'%d/%m/%Y')) = '$bulan' 
													AND 
													YEAR(STR_TO_DATE(DateTime,'%d/%m/%Y'))='$tahun'
												)
											AND Fid='$fid'
											AND TIME(Jam_Log) BETWEEN TIME('15:00:00') AND TIME('23:00:00')
											
											ORDER BY waktu DESC
										 )f
										
											
									GROUP BY Fid,tanggal
									ORDER BY tanggal DESC,(Fid*1) ASC
						)c 
						ON a.tanggal=c.tanggal

						LEFT JOIN hr_staff_info d ON d.FID='$fid'
						";

			$query = $this->db->query($q);
			return $query->result();
	    }

		public function m_absen_by_nik_in_opd($nik,$date)
		{			
			$id_opd=$this->session->userdata('ID_OPD');

			
			$tgl_puasa = $this->get_bulan_puasa();

			if(in_array($date, $tgl_puasa))
			{

				//jumat puasa
				if(date('D', strtotime($date)) =='Fri')
				{
					$jam_masuk = '08:00:00';
					$jam_keluar= '16:00:00';
				}else{
					$jam_masuk = '08:00:00';
					$jam_keluar= '15:30:00';
				}

			}else{
				
				//jumat biasa
				if(date('D', strtotime($date)) =='Fri')
				{
					$jam_masuk = '07:30:00';
					$jam_keluar= '16:30:00';
				}else{
					$jam_masuk = '07:30:00';
					$jam_keluar= '16:00:00';
				}
			}



			$query = $this->db->query("					
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

						GREATEST((TIME_TO_SEC(TIMEDIFF(a.jam_masuk,'$jam_masuk'))/60),0) AS telat_masuk,
						GREATEST((TIME_TO_SEC(TIMEDIFF('$jam_keluar',b.jam))/60),0) AS cepat_pulang

						FROM
						hr_staff_info c

						LEFT JOIN
						(
							SELECT f.*,MAX(f.waktu)
							FROM (
									SELECT Fid,Nama_Staff, STR_TO_DATE(DateTime,'%d/%m/%Y') AS tanggal,STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s') AS waktu, Jam_Log AS jam FROM ta_log

									WHERE (
										MONTH(STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s'))=MONTH('$date') 
											AND 
									YEAR(STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s'))=YEAR('$date') 
											AND 
									TIME(Jam_Log) BETWEEN TIME('15:00:00') and TIME('23:00:00')) 
									ORDER BY waktu DESC
								 )f
							WHERE
									tanggal = '$date' 
								
									
							GROUP BY Fid
							ORDER BY (Fid*1)

						) b
							ON b.Fid=c.Fid
						LEFT JOIN
						(

							SELECT y.*,MIN(y.waktu_masuk)
							FROM (
									select 
										`a`.`Fid` AS `Fid`,
										`a`.`Nama_Staff` AS `Nama_Staff`,
										str_to_date(`a`.`DateTime`,'%d/%m/%Y') AS `tanggal_masuk`,
										str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s') AS `waktu_masuk`,
										`a`.`Jam_Log` AS `jam_masuk` 
									from `ta_log` `a` 
										where (
											(month(str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s')) = MONTH('$date')) 
												and 
											(year(str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s')) = year('$date')) 
												and 
											(cast(`a`.`Jam_Log` as time) between cast('06:00:00' as time) and cast('11:00:00' as time))) 
											order by str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s') ASC

								)y
							WHERE													
								tanggal_masuk='$date'
								
							GROUP BY Fid
							ORDER BY (Fid*1)

						) a
						ON c.Fid=a.Fid
						
						WHERE REPLACE(c.NIK, ' ', '')='$nik' AND LEFT(c.Fid , 2)='$id_opd'
						
						ORDER BY
						c.Fid ASC
										");
			$data 	= $query->result();						
			return $data;
		}
		
		
		public function m_tanggal_berisi_bulan_ini()
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
									WHERE (MONTH(tgl_berisi.tanggal) = MONTH(NOW()) AND YEAR(tgl_berisi.tanggal)=YEAR(NOW()))
									");
									
			$data 	= $q->result();						
			return $data;
		}
		
		
		public function m_tanggal_berisi_bulan($bulan,$tahun=null)
		{
			if($tahun==null)
            {
            	$tahun=date('Y');
            }
        
        	$q = $this->db->query("SELECT tgl_berisi.tanggal 
									FROM (
											SELECT STR_TO_DATE(DateTime,'%d/%m/%Y') AS tanggal 
											FROM ta_log 
											WHERE 
												
												(
													DAYOFWEEK(STR_TO_DATE(DateTime,'%d/%m/%Y')) <> 1 AND DAYOFWEEK(STR_TO_DATE(DateTime,'%d/%m/%Y')) <> 7  
													AND STR_TO_DATE(DateTime,'%d/%m/%Y') <= CURDATE()
												)
												
												
											GROUP BY tanggal
										)tgl_berisi
									WHERE (MONTH(tgl_berisi.tanggal) = '$bulan' AND YEAR(tgl_berisi.tanggal)='$tahun')
									");
									
			$data 	= $q->result();						
			return $data;
		}
		
    	public function m_hukuman($NIP,$tanggal)
        {
        	$q = $this->db->query("SELECT 
                            a.id,
                            a.judul,
                            a.tanggal,
                            a.hukuman,
                            a.NIP_REFF,
                            b.NIP
                            
                            FROM tbl_apel_pagi a 
                            INNER JOIN(
                                SELECT NIP,id_apel FROM `tbl_apel_pagi_nip` 
                                WHERE NIP ='$NIP'
                                GROUP BY id_apel
                                )b 
                                
                            ON a.id=b.id_apel
                            WHERE tanggal='$tanggal'
                            ");
        					
			$data 	= $q->result();						
			return $data;
        }
		
		public function m_tbl_libur($bulan,$tahun)
		{
			$q = $this->db->query("SELECT * FROM `tbl_libur` WHERE MONTH(tgl_libur)='$bulan' AND YEAR(tgl_libur)='$tahun'");
									
			$data 	= $q->result();						
			return $data;
		}
		
		public function m_tbl_surat_sakit($nik,$bulan)
		{
			$q = $this->db->query("SELECT * FROM `tbl_surat_sakit` WHERE NIK='$nik' AND MONTH(tanggal)='$bulan' AND status='approve'");
									
			$data 	= $q->result();						
			return $data;
		}
		
		
		public function m_tbl_dinas_luar($nik,$bulan,$tahun)
		{
			$q = $this->db->query("SELECT * FROM `tbl_dinas_luar` WHERE NIK='$nik' AND (MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun') AND status='approve'");
									
			$data 	= $q->result();						
			return $data;
		}
		
		
		public function m_tbl_cuti_tahunan($nik,$bulan,$tahun)
		{
			$q = $this->db->query("SELECT * FROM `tbl_cuti_tahunan` WHERE NIK='$nik' AND (MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun') AND status='approve'");
									
			$data 	= $q->result();						
			return $data;
		}
		
		public function m_tbl_cuti_sakit($nik,$bulan,$tahun)
		{
			$q = $this->db->query("SELECT * FROM `tbl_cuti_sakit` WHERE NIK='$nik' AND (MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun') AND status='approve'");
									
			$data 	= $q->result();						
			return $data;
		}
		
		public function m_tbl_surat_ijin_keterangan($nik,$bulan,$tahun)
		{
			$q = $this->db->query("SELECT * FROM `tbl_surat_ijin_keterangan` WHERE NIK='$nik' AND (MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun')  AND status='approve'");
									
			$data 	= $q->result();						
			return $data;
		}
		
		
		
		public function m_tbl_cuti_lain($nik,$bulan,$tahun)
		{
			$q = $this->db->query("SELECT * FROM `tbl_cuti_lain` WHERE NIK='$nik' AND (MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun')  AND status='approve'");
									
			$data 	= $q->result();						
			return $data;
		}
		
		public function m_set_libur($serialize)
		{	
			
			if($this->db->insert('tbl_libur', $serialize))
			{
				$q = $this->db->query("SELECT * FROM `tbl_libur` WHERE YEAR(tgl_libur)=YEAR(NOW()) ORDER BY id_libur DESC");
										
				$data 	= $q->result();						
				return $data;
			}
			
		}

		
		
		
		/** cuti sakit **/
		public function m_set_form_cuti_sakit($serialize)
		{	
			
			$this->db->insert('tbl_cuti_sakit', $serialize);
		}

		
		
		public function m_data_cuti_sakit()
		{	
			
			$ID_OPD=$this->session->userdata('ID_OPD');
			
			$q = $this->db->query("
									SELECT a.*,b.Nama FROM tbl_cuti_sakit a 
										INNER JOIN 
										hr_staff_info b ON a.NIK=b.NIK
										WHERE YEAR(a.tanggal)=YEAR(NOW()) AND LEFT(a.FID , 2)='$ID_OPD' 
										ORDER BY a.tanggal DESC
				");
										
			$data 	= $q->result();						
			return $data;
			
		}

		
		
		public function m_data_cuti_sakit_by_nik()
		{	
			
			$NIK=$this->session->userdata('NIK');
			
			$q = $this->db->query("SELECT * FROM `tbl_cuti_sakit` WHERE YEAR(tanggal)=YEAR(NOW()) AND NIK='$NIK' ORDER BY tanggal DESC");
										
			$data 	= $q->result();						
			return $data;
			
		}
		/** cuti sakit **/
		
		
		/** cuti lain **/
		public function m_set_form_cuti_lain($serialize)
		{	
			
			$this->db->insert('tbl_cuti_lain', $serialize);
		}

		
		
		public function m_data_cuti_lain()
		{	
			
			$ID_OPD=$this->session->userdata('ID_OPD');
			
			$q = $this->db->query("SELECT a.*,b.Nama FROM tbl_cuti_lain a 
										INNER JOIN 
										hr_staff_info b ON a.NIK=b.NIK
										WHERE YEAR(a.tanggal)=YEAR(NOW()) AND LEFT(a.FID , 2)='$ID_OPD' 
										ORDER BY a.tanggal DESC");
										
			$data 	= $q->result();						
			return $data;
			
		}

		
		
		public function m_data_cuti_lain_by_nik()
		{	
			
			$NIK=$this->session->userdata('NIK');
			
			$q = $this->db->query("SELECT * FROM `tbl_cuti_lain` WHERE YEAR(tanggal)=YEAR(NOW()) AND NIK='$NIK' ORDER BY tanggal DESC");
										
			$data 	= $q->result();						
			return $data;
			
		}
		/** cuti lain **/
		
		
		
		/** ******************* cuti_tahunan ****************** **/
		public function m_set_form_cuti_tahunan($serialize)
		{	
			
			$this->db->insert('tbl_cuti_tahunan', $serialize);
		}

		
		
		public function m_data_cuti_tahunan()
		{	
			
			$ID_OPD=$this->session->userdata('ID_OPD');
			
			$q = $this->db->query("
									SELECT a.*,b.Nama FROM tbl_cuti_tahunan a 
										INNER JOIN 
										hr_staff_info b ON a.NIK=b.NIK
										WHERE YEAR(a.tanggal)=YEAR(NOW()) AND LEFT(a.FID , 2)='$ID_OPD' 
										ORDER BY a.tanggal DESC

				");
										
			$data 	= $q->result();						
			return $data;
			
		}

		
		
		public function m_data_cuti_tahunan_by_nik()
		{	
			
			$NIK=$this->session->userdata('NIK');
			
			$q = $this->db->query("SELECT * FROM `tbl_cuti_tahunan` WHERE YEAR(tanggal)=YEAR(NOW()) AND NIK='$NIK' ORDER BY tanggal DESC");
										
			$data 	= $q->result();						
			return $data;
			
		}
		/** ******************* cuti_tahunan ****************** **/
		
		
		
		/** dinas luar **/
		public function m_set_form_dinas_luar($serialize)
		{	
			
			$this->db->insert('tbl_dinas_luar', $serialize);
		}

		
		
		public function m_data_dinas_luar()
		{	
			
			$ID_OPD=$this->session->userdata('ID_OPD');
			
			
            $q = $this->db->query("SELECT a.*,b.Nama FROM tbl_dinas_luar a 
										INNER JOIN 
										hr_staff_info b ON a.NIK=b.NIK
										WHERE YEAR(a.tanggal)=YEAR(NOW()) AND LEFT(a.FID , 2)='$ID_OPD' 
										ORDER BY a.tanggal DESC");
            
            
            /*
            $q = $this->db->query("SELECT a.*,b.Nama FROM tbl_dinas_luar a 
										INNER JOIN 
										hr_staff_info b ON a.NIK=b.NIK
										WHERE a.status='pending' AND LEFT(a.FID , 2)='$ID_OPD' 
										ORDER BY a.tanggal DESC");
			
			*/							
			$data 	= $q->result();						
			return $data;
			
		}

		
		
		public function m_data_dinas_luar_by_nik()
		{	
			
			$NIK=$this->session->userdata('NIK');
            //var_dump($NIK);
			
			$q = $this->db->query("SELECT * FROM `tbl_dinas_luar` WHERE YEAR(tanggal)=YEAR(NOW()) AND NIK='$NIK' ORDER BY tanggal DESC");
										
			$data 	= $q->result();						
			return $data;
			
		}
		/** dinas luar **/
		
		
		/** sakit **/
		public function m_set_form_sakit($serialize)
		{	
			
			$this->db->insert('tbl_surat_sakit', $serialize);
		}

		
		
		public function m_data_sakit()
		{	
			
			$ID_OPD=$this->session->userdata('ID_OPD');
			
			$q = $this->db->query("
									SELECT a.*,b.Nama FROM tbl_surat_sakit a 
										INNER JOIN 
										hr_staff_info b ON a.NIK=b.NIK
										WHERE YEAR(a.tanggal)=YEAR(NOW()) AND LEFT(a.FID , 2)='$ID_OPD' 
										ORDER BY a.tanggal DESC
								");
										
			$data 	= $q->result();						
			return $data;
			
		}

		
		
		public function m_data_sakit_by_nik()
		{	
			
			$NIK=$this->session->userdata('NIK');
			
			$q = $this->db->query("SELECT * FROM `tbl_surat_sakit` WHERE YEAR(tanggal)=YEAR(NOW()) AND NIK='$NIK' ORDER BY tanggal DESC");
										
			$data 	= $q->result();						
			return $data;
			
		}
		/** sakit **/
		
		
		
		
		/** ijin_keterangan **/
		public function m_set_form_ijin_keterangan($serialize)
		{	
			
			$this->db->insert('tbl_surat_ijin_keterangan', $serialize);
		}

		
		
		public function m_data_ijin_keterangan()
		{	
			
			$ID_OPD=$this->session->userdata('ID_OPD');
			
			$q = $this->db->query("
							SELECT a.*,b.Nama FROM tbl_surat_ijin_keterangan a 
										INNER JOIN 
										hr_staff_info b ON a.NIK=b.NIK
										WHERE YEAR(a.tanggal)=YEAR(NOW()) AND LEFT(a.FID , 2)='$ID_OPD' 
										ORDER BY a.tanggal DESC
				");
										
			$data 	= $q->result();						
			return $data;
			
		}

		
		
		public function m_data_ijin_keterangan_by_nik()
		{	
			
			$NIK=$this->session->userdata('NIK');
			
			$q = $this->db->query("SELECT * FROM `tbl_surat_ijin_keterangan` WHERE YEAR(tanggal)=YEAR(NOW()) AND NIK='$NIK' ORDER BY tanggal DESC");
										
			$data 	= $q->result();						
			return $data;
			
		}
		/** ijin_keterangan **/
		
		
		
		
		public function m_data_libur()
		{	
			$q = $this->db->query("SELECT * FROM `tbl_libur` ORDER BY tgl_libur DESC");
										
			$data 	= $q->result();						
			return $data;
			
		}

		
		public function m_staf_info($ID_OPD)
		{	
			$q = $this->db->query("SELECT `FID`,`Nama`,REPLACE(NIK, ' ', '') AS NIK,`JABATAN`,COSTUM_3 AS pangkat,COSTUM_4 AS golongan, COSTUM_5 AS npwp  FROM `hr_staff_info` WHERE LEFT(FID , 2)='$ID_OPD'");
										
			$data 	= $q->result();						
			return $data;
			
		}

		
		public function m_staf_info_by_nik($NIK)
		{	
			$q = $this->db->query("SELECT `FID`,`Nama`,NIK,`JABATAN`,`COSTUM_3` FROM `hr_staff_info` WHERE REPLACE(NIK, ' ', '')='$NIK'");
										
			$data 	= $q->result();						
			return $data[0];
			
		}
		
		
		public function m_staf_info_by_nik_all($NIK)
		{	
			$q = $this->db->query("
									SELECT 
											a.FID,
											a.Nama,
											REPLACE(a.NIK, ' ', '') AS NIK,
											a.JABATAN,
											a.COSTUM_3 AS pangkat,
											a.COSTUM_4 AS golongan, 
											a.COSTUM_5 AS npwp ,
											b.ID_OPD,b.OPD
										FROM 
											hr_staff_info a 
										LEFT JOIN 
											tbl_struktur b 
										ON LEFT(a.Fid , 2)=b.ID_OPD
									WHERE REPLACE(a.NIK, ' ', '')='$NIK'");
										
			$data 	= $q->result();						
			return $data[0];
			
		}
		
		
		
		
		public function m_staf_info_by_fid($FID)
		{	
			$q = $this->db->query("SELECT `FID`,`Nama`,REPLACE(NIK, ' ', '') AS NIK,`JABATAN`,COSTUM_3 AS pangkat,COSTUM_4 AS golongan, COSTUM_5 AS npwp  FROM `hr_staff_info` WHERE FID='$FID'");
										
			$data 	= $q->result();						
			return $data[0];
			
		}
		
		

		
		public function m_go_edit_staf($FID,$serialize)
		{			
			
			$this->db->where('FID', $FID);
			$this->db->update('hr_staff_info', $serialize);           
			
		}

		
	}
?>
