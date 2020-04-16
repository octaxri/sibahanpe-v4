<?php 

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

						GREATEST((TIME_TO_SEC(TIMEDIFF(a.jam_masuk,'08:00:00'))/60),0) AS telat_masuk,
						GREATEST((TIME_TO_SEC(TIMEDIFF('16:00:00',b.jam))/60),0) AS cepat_pulang

						FROM
						hr_staff_info c

						LEFT JOIN
						(
							SELECT f.*,MAX(f.waktu)
							FROM (
									SELECT Fid,Nama_Staff, STR_TO_DATE(DateTime,'%d/%m/%Y') AS tanggal,STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s') AS waktu, Jam_Log AS jam FROM ta_log

									WHERE (
									YEAR(STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s'))<=(YEAR(NOW())) 
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
									SELECT 
										`a`.`Fid` AS `Fid`,										
										str_to_date(`a`.`DateTime`,'%d/%m/%Y') AS `tanggal_masuk`,
										str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s') AS `waktu_masuk`,
										`a`.`Jam_Log` AS `jam_masuk` 
									FROM `ta_log` `a` 
										WHERE 
											
											(cast(`a`.`Jam_Log` as time) between cast('06:00:00' as time) and cast('10:00:00' as time))
                                            AND YEAR(str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s')) <= YEAR(NOW())
											order by str_to_date(`a`.`DateTime`,'%d/%m/%Y %H:%i:%s') DESC

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