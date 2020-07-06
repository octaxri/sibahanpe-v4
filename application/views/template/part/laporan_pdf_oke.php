<?php 
error_reporting(0);
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
						<th>NPWP</th>
                    	<th>POKOK</th>
						<th>EKINERJA</th>
						<th>KEHADIRAN</th>
						<th>POT.TPP</th>
						<th>TOTAL</th>
						<th>Pph 21</th>
						<th>PENERIMAAN</th>
						<th width="100px">Ttd</th>
										
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
								
                                    if(substr($data->FID,2,3) =='004')
                                    {
                                        $kasubag['nama'] 	= $data->Nama;
                                        $kasubag['NIK']		= $data->NIK;

                                    }
                                
                                
							}else if(strlen($data->FID)==4)
							{
                            	
                            	    if(substr($data->FID,2,2) =='04')
                                	{
                                    	$kasubag['nama'] 	= $data->Nama;
                                    	$kasubag['NIK']		= $data->NIK;                                    
                                    }
                                
							}
							
							

							$tpp = $this->m_laporan->m_hasil_by_bulan_nip($data->NIK,$bulan,$tahun)[0];
							$tpp->total_dapat = $tpp->total_dapat<=0?0:$tpp->total_dapat;
							$tpp->dapat_absen = $tpp->dapat_absen<=0?0:$tpp->dapat_absen;
							$tpp->dapat_ekin = $tpp->dapat_ekin<=0?0:$tpp->dapat_ekin;
							$potong_perbub_baru = $tpp->potong_perbub_baru<=0?0:$tpp->potong_perbub_baru;
                            
							$pph=0;
							$bersih=0;
							
                            
                            /************ pengecualian given ********************/
                            $NIP_PREMAN = array("199003302010101001","196712221999011001");
                            if (in_array($data->NIK, $NIP_PREMAN)) 
                            {
                                
                                $$tpp->total_dapat		= $tpp->pokok;
                                $tpp->dapat_absen		= round($tpp->pokok*30/100);
                                $tpp->dapat_ekin		= $tpp->total_dapat - $tpp->dapat_absen;
                                
                            }                            
                            /************ pengecualian given ********************/
                            
                            
							//pph 21
							if(trim($data->golongan)=='III')
							{
								$pph = round($tpp->total_dapat*5/100);
							
							}else if(trim($data->golongan)=='IV')
							{
								$pph = round($tpp->total_dapat*15/100);							
								
							}else if(trim($data->golongan)=='II')
							{
								
								$pph = 0;
							
							}else if(trim($data->golongan)=='I')
							{
								
								$pph = 0;
							}else{
								$pph = 0;
							}
							
							//var_dump($tpp);
                        	//echo base_url()."index.php/getbynik/dapat_absen_by_nik?nik=$data->NIK&bulan=$bulan&tahun=$tahun";
                        	
                        
							$bersih = $tpp->total_dapat - $pph;
							$bersih = $bersih<=0?0:$bersih;
							
							$jum_ber += $bersih;
							$jum_tot += $tpp->total_dapat;
							$jum_pph += $pph;
							
							$no++;
							
							
							echo "
								<tr>
									<td>$no</td>
									<td><u><b>$data->Nama</b></u> <br> $data->NIK <br> $data->JABATAN</td>									
									<td>$data->pangkat <br>/<br> $data->golongan</td>
									<td>$data->npwp</td>
									<td align='right'>".rupiah($tpp->pokok)."</td>
                                    <td align='right'>".rupiah($tpp->dapat_ekin)."</td>
									<td align='right'>".rupiah($tpp->dapat_absen)."</td>
                                    <td align='right'>".rupiah($potong_perbub_baru)."</td>
									<td align='right'>".rupiah($tpp->total_dapat)."</td>									
									<td align='right'>".rupiah($pph)."</td>
									<td align='right'>".rupiah($bersih)."</td>
									<td>$no </td>
								</tr>
							";
								
						}
						
						
							echo "
									<tr>
										<td colspan='8' class='text-center' style='font-weight:bold'>JUMLAH:</td>
										<td align='right' style='font-weight:bold'>".rupiah($jum_tot)."</td>
										<td align='right' style='font-weight:bold'>".rupiah($jum_pph)."</td>
										<td align='right' style='font-weight:bold'>".rupiah($jum_ber)."</td>
										<td></td>
									</tr>
							";
						
					
					?>
				</tbody>
				

			
			</table>
	
	<hr>
	<table width="100%">
	
		<tr>
			<td width="5%">
			</td>
			<td width="35%">
				<br>
				<br>
				Dibayar Oleh:<br>
				<?php echo $bendahara->JABATAN;?>
				<br>
				<br>
				<br>
				<br>
				<u><?php echo $bendahara->NAMA;?></u>
				<br>
				NIP.<?php echo $bendahara->NIP;?>
			</td>
			
			<td width="35%"> </td>
			
			<td>
				<br>
				Salak, <?php echo date("d")?> <?php echo bulanindo(date('m')) ?> <?php echo date("Y")?>
				<br>
				<br>
				Disetujui Oleh:<br>
				<?php echo strtoupper($pimpinan->JABATAN_SET)?> <br><?php echo $OPD?>
				<br>
				<br>
				<br>
				<br>
				<u><?php echo $pimpinan->Nama;?></u>
				<br>
				NIP.<?php echo $pimpinan->NIK;?>
			</td>
		</tr>
	</table>
		
		
</body>