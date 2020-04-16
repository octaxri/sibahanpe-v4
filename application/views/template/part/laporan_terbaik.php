<?php 
//error_reporting(0);
?>

<link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css">
<style>
body{
	font-size: 12px;
}

table tr td, th  { 
	
	font-size: 12px; padding:3px;

}
</style>
<body>	
          <table width="100%">
			<tr>
				<td width="20%">
					<img src="<?php echo base_url()?>assets/img/logo.jpg" width="50px">
				</td>
				<td width="60%" class="text-center">
					<div style="font-size: 20px;"> 
						<?php echo $OPD?>
						<br>
						KABUPATEN PAKPAK BHARAT
					</div>
					
				</td>
				<td width="20%">
				</td>
				
			</tr>
		  </table>
		  
		  
		  <hr>
		  
			<div class="text-center" style="font-weight:bold;">
				REKAPITULASI TAMBAHAN PENGHASILAN PEGAWAI (TPP)<br>
				<?php echo $OPD?><br>
						UNTUK BULAN <?php echo strtoupper(bulanindo($bulan))?> TA.<?php echo $tahun?>
						
			</div>
			<br>
			<table id="tbl_absen" class="table table-bordered">
				<thead>
					<tr>
						<th width="17px">No.</th>
						<th width="250px">NAMA/NIP</th>						
						<th width="150px">PANGKAT/GOL.</th>						
                    	<th>capaian_skp</th>
						<th>capaian_bulanan</th>
						<th>capaian_rata_rata</th>
                    	<th>potongan_absen</th>
						
										
					</tr>
				</thead>
				
				<tbody>
					<?php
						$no=0;
						
						
						$kepala 	=array();
						$kasubag 	=array();
						
						$jum_tot =0;
						$jum_ber =0;
						$jum_pph =0;
						
						
						foreach($staff_arr as $data)
						{
								
							//karna ada 5 digit dan 4 digit FID
							if(strlen($data->FID)==5)
							{
								
                            	if (in_array($data->NIK, $pimpinan)) 
                                {
                                		$kepala['nama'] = $data->Nama;
                                    	$kepala['NIK'] 	= $data->NIK;
                                		$kepala['JABATAN'] = $data->JABATAN;
                                }else{
                            	if(substr($data->FID,2,3) =='001')
								{
									$kepala['nama'] = $data->Nama;
									$kepala['NIK'] 	= $data->NIK;
                                	$kepala['JABATAN'] = $data->JABATAN;
								}else if(substr($data->FID,2,3) =='004')
								{
									$kasubag['nama'] 	= $data->Nama;
									$kasubag['NIK']		= $data->NIK;
                                	
								}
                                }
							}else if(strlen($data->FID)==4)
							{
                            	//jika ada di tbl_pimpinan
                            	if (in_array($data->NIK, $pimpinan)) 
                                {
                                		$kepala['nama'] = $data->Nama;
                                    	$kepala['NIK'] 	= $data->NIK;
                                		$kepala['JABATAN'] = $data->JABATAN;
                                }else{
                                	if(substr($data->FID,2,2) =='01')
                                	{
                                    	$kepala['nama'] = $data->Nama;
                                    	$kepala['NIK'] 	= $data->NIK;
                                    	$kepala['JABATAN'] = $data->JABATAN;
                                	}else if(substr($data->FID,2,2) =='04')
                                	{
                                    	$kasubag['nama'] 	= $data->Nama;
                                    	$kasubag['NIK']		= $data->NIK;
                                    	
                                	}
                                }
							}
							
							
							
							$tpp = json_decode(file_get_contents(base_url()."index.php/getbynik/dapat_lap_by_nik?nik=$data->NIK&bulan=$bulan&tahun=$tahun"));
							
							$pph=0;
							$bersih=0;
							
							
							//var_dump($tpp);
                        	//echo base_url()."index.php/getbynik/dapat_absen_by_nik?nik=$data->NIK&bulan=$bulan&tahun=$tahun";
                        
                        //echo base_url()."index.php/getbynik/dapat_lap_by_nik?nik=$data->NIK&bulan=$bulan&tahun=$tahun";
                        	

		$ID_OPD = $OPD;
		$NAMA=$data->Nama;
		$NIP=$data->NIK;
		$JABATAN=$data->JABATAN;
		$PANGKAT=$data->pangkat;
		$GOL=$data->golongan;
		$CAPAIAN_SKP=$tpp->tpp->capaian_skp;
		$CAPAIAN_BULANAN=$tpp->tpp->capaian_bulanan;
		$CAPAIAN_RATA_RATA=$tpp->tpp->capaian_rata_rata;
		$POTONGAN_ABSEN=$tpp->tpp->potongan_absen;
        $bulan=$bulan;
        $tahun=$tahun;
                        
                        
$this->db->query("DELETE FROM tbl_vote WHERE NIP='$NIP' AND bulan='$bulan' AND tahun='$tahun'");
$this->db->query("
                        INSERT INTO tbl_vote
                        SET
                        ID_OPD='$ID_OPD',
                        NAMA='$NAMA',
                        NIP='$NIP',
                        JABATAN='$JABATAN',
                        PANGKAT='$PANGKAT',
                        GOL='$GOL',
                        CAPAIAN_SKP='$CAPAIAN_SKP',
                        CAPAIAN_BULANAN='$CAPAIAN_BULANAN',
                        CAPAIAN_RATA_RATA='$CAPAIAN_RATA_RATA',
                        POTONGAN_ABSEN='$POTONGAN_ABSEN',
                        bulan='$bulan',
                        tahun='$tahun'
                 ");

							
							$no++;
							
							
							echo "
								<tr>
									<td>$no</td>
									<td><u><b>$data->Nama</b></u> <br> $data->NIK <br> $data->JABATAN</td>									
									<td>$data->pangkat <br>/<br> $data->golongan</td>									
									<td align='right'>".($tpp->tpp->capaian_skp)."</td>
                                    <td align='right'>".($tpp->tpp->capaian_bulanan)."</td>
									<td align='right'>".($tpp->tpp->capaian_rata_rata)."</td>	
                                    <td align='right'>".($tpp->tpp->potongan_absen)."</td>	
								</tr>
							";
								
						}
						
						
					
					?>
				</tbody>
				

			
			</table>
	
	<hr>
	

		
		
</body>