<?php
class M_terbaik extends CI_model{

		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
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
																cast('10:00:00' as time))) order by str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s') asc

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


}