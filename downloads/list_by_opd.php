<?php
header('Content-Type: application/json');
date_default_timezone_set("Asia/jakarta");


//penggunaan
//http://202.46.1.36/sibahanpe/downloads/list_by_opd.php?bulan=12&tahun=2017

$myarray = glob("*.pdf");
usort($myarray, create_function('$a,$b', 'return filemtime($b) - filemtime($a);'));

$bu = trim($_GET['bulan']);
$ta = trim($_GET['tahun']);
$op = utf8_decode(urldecode(trim($_GET['opd'])));
$arr = array();

$jumlah =0;
foreach($myarray as $files)
{
	

    	$bulan = str_replace("_","",substr($files,-18,2));    
    	$bulan = sprintf("%02d", $bulan);
    
    	$tahun = substr($files,-15,2);
    	$tahun = substr_replace($tahun, '20', 0, 0);
    	
    	$tgl_cetak 	= substr($files,-21,17);    
    	$tgl_cetak[2] = "-";
    	$tgl_cetak[5] = "-";    	
    	$tgl_cetak[8] = " ";
    	$tgl_cetak[11] = ":";
    	$tgl_cetak[14] = ":";
    	//insert 20 ke tahun
    	$tgl_cetak = substr_replace($tgl_cetak, '20', 6, 0);
    	

		$z = strlen($files)-22;
    	$opd = str_replace("_"," ",substr($files,0-strlen($files),$z));    
    
	//if (!is_numeric($files[0]) && $bu==$bulan && $ta=$tahun)
	if (!is_numeric($files[0]) )
    {
    	//echo $files."<br>";
    	if (strpos($opd, $op) == TRUE || $opd==$op) {
    		
		
    
    	$jumlah++;
    	$all['file']=$files;    
    	$all['bulan'] = $bulan;
    	$all['tahun'] = $tahun;
    	$all['tgl_cetak'] = $tgl_cetak;    	
    	$all['opd']=$opd;
    	
    
    	//echo "<a href='".$files."' target='blank'>".$files."</a> | ".$bulan." | ".$tahun." | ".$tgl_cetak."<br>";
    	array_push($arr,$all);
        
        }
    }


}


echo json_encode($arr);


?>