<?php 

SELECT 
	a.tanggal,
	b.Fid,
	b.waktu_masuk,
	b.jam_masuk,
	c.jam AS jam_keluar,
	c.waktu AS waktu_keluar,
	d.NIK,
	d.Nama,

	FLOOR(GREATEST((TIME_TO_SEC(TIMEDIFF(b.jam_masuk,'08:00:00'))/60),0)) AS telat_masuk,
	FLOOR(GREATEST((TIME_TO_SEC(TIMEDIFF('16:00:00',c.jam))/60),0)) AS cepat_pulang
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
			MONTH(STR_TO_DATE(DateTime,'%d/%m/%Y')) = '02' AND YEAR(STR_TO_DATE(DateTime,'%d/%m/%Y'))='2020'
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
						MONTH(STR_TO_DATE(DateTime,'%d/%m/%Y')) = '02' 
						AND 
						YEAR(STR_TO_DATE(DateTime,'%d/%m/%Y'))='2020'
					)
					AND Fid='1213'
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
								MONTH(STR_TO_DATE(DateTime,'%d/%m/%Y')) = '02' 
								AND 
								YEAR(STR_TO_DATE(DateTime,'%d/%m/%Y'))='2020'
							)
						AND Fid='1213'
						AND TIME(Jam_Log) BETWEEN TIME('15:00:00') AND TIME('23:00:00')
						
						ORDER BY waktu DESC
					 )f
					
						
				GROUP BY Fid,tanggal
				ORDER BY tanggal DESC,(Fid*1) ASC
	)c 
	ON a.tanggal=c.tanggal

	LEFT JOIN hr_staff_info d ON d.FID='1213'




