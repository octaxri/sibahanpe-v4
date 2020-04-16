<?php 
LEFT JOIN
						(
							SELECT f.*,MAX(f.waktu)
							FROM (
									SELECT Fid, STR_TO_DATE(DateTime,'%d/%m/%Y') AS tanggal,STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s') AS waktu, Jam_Log AS jam 
									FROM ta_log

									WHERE (
									STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s')<=NOW()
										AND 											
									STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s') >= DATE_SUB(NOW(),INTERVAL 2 YEAR)
										AND 
									TIME(Jam_Log) BETWEEN TIME('15:00:00') AND TIME('23:00:00')
									) 
									ORDER BY waktu DESC
								 )f
								
									
							GROUP BY Fid,tanggal
							ORDER BY tanggal DESC,(Fid*1) ASC

						) b
							ON b.Fid=c.Fid
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
									STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s')<=NOW()
										AND 											
									STR_TO_DATE(DateTime,'%d/%m/%Y %H:%i:%s') >= DATE_SUB(NOW(),INTERVAL 2 YEAR)
										AND
									TIME(Jam_Log) BETWEEN TIME('06:00:00') AND TIME('11:00:00')
										
	                                                                     
								ORDER BY waktu_masuk ASC

									)y
								
							GROUP BY Fid,tanggal_masuk
							ORDER BY tanggal_masuk DESC,(Fid*1) ASC

						) a
						ON c.Fid=a.Fid