<?php 
			
			$d_libur = array();
			foreach($tgl_libur as $lib)
			{			
				$d_libur[] 	= $lib->tgl_libur; 
			}
			
			
			$d_sakit = array();
			foreach($tgl_sakit as $sak)
			{			
				$d_sakit[] 	= $sak->tanggal; 
			}
			
			
			$d_dinas = array();
			foreach($tgl_dinas as $din)
			{			
				$d_dinas[] 	= $din->tanggal; 
			}
			
			$d_cuttah = array();
			foreach($tgl_cut_tah as $cuttah)
			{			
				$d_cuttah[] 	= $cuttah->tanggal; 
			}
			
			$d_cutsak = array();
			foreach($tgl_cut_sak as $cutsak)
			{			
				$d_cutsak[] 	= $cutsak->tanggal; 
			}
			
			
			$d_cutlain = array();
			foreach($tgl_cut_la as $cutlain)
			{			
				$d_cutlain[] 	= $cutlain->tanggal; 
			}
			
			
			
			$d_ijin_la = array();
			foreach($tbl_surat_ijin_keterangan as $ijin_la)
			{			
				$d_ijin_la[] 	= $ijin_la->tanggal; 
			}
			
			
			

                        $no=0;
						$i=0;
						$total_pot 			= 0;
	
						$total_absen 		= 0;
						$total_hadir 		= 0;
						$tot_telat_masuk 	= 0;						
						$tot_dinas_luar		= 0;
						$tot_cutsak			= 0;
						$tot_ijin_ket		= 0;
						$tot_cuti_tahunan=0;
                
                		$tot_d_cutlain = 0;
						
						 
                		
                			$arr_hukuman=array();
						
						
							foreach($hasil as $data)
							{
								
							$no++;
							$total_telat = $data->telat_masuk+$data->cepat_pulang;
							
							$jam_masuk = $data->jam_masuk==null?"<font color=red>-</font>":$data->jam_masuk;
							$jam_keluar = $data->jam_keluar==null?"<font color=red>-</font>":$data->jam_keluar;
							
							$cepat_pulang = $data->cepat_pulang;
							$telat_masuk = $data->telat_masuk;
							
							
							$tanggal_get = $data->tanggal;
							
							$note	= "";
							$style	= "";
							$potongan ="0%";
                                
                            $info_baru ="";
                            
							
							//cek cuti tahunan 
							if (in_array($tanggal_get, $d_cuttah)) 
							{
								$potongan	="0%";
								$note		="keterangan";
								$style		= " class='ijin_lain' ";
								$tot_ijin_ket++;
							
							
							//cek surat ijin lainnya 
                            }else 
							//cek surat ijin lainnya 
							if (in_array($tanggal_get, $d_ijin_la)) 
							{
								/********** ijin hanya sebelah masuk atau pulang **************/
								$yyy = $this->db->query("SELECT masuk_pulang FROM tbl_surat_ijin_keterangan WHERE NIK='$nik' AND status='approve' AND tanggal='$tanggal_get'");
								foreach ($yyy->result() as $o) {
								
									$note		="keterangan";
									$style		= " class='ijin_lain' ";
                                    
                                    $x=0;
                                    $y=0;
									if($o->masuk_pulang=='masuk')
									{
										$telat_masuk='0%';

										if($cepat_pulang>0 && $cepat_pulang<=30)
										{
											$y="0.5%";									
											
										}else if($cepat_pulang >30 && $cepat_pulang<=60)
										{
											$y="1%";
											
										}else if($cepat_pulang >60)
										{
											$y="1.5%";
										}
										$potongan	=$y;
									}else{
										$cepat_pulang='0%';
										if($telat_masuk>0 && $telat_masuk<=30)
										{
											$x="0.5%";									
											
										}else if($telat_masuk >30 && $telat_masuk<=60)
										{
											$x="1%";
											              
										}else if($telat_masuk >60)
										{
											$x="1.5%";
										}
										$potongan	=$x;
									}
                                    
                                    $potongan=$x+$y;
								}
                                /********** ijin hanya sebelah masuk atau pulang **************/


								//$tot_ijin_ket++;
							
							//cek database cuti lain 2%
							}else if (in_array($tanggal_get, $d_cutlain)) 
							{
								
								//jika lebih dari 5 maka potongan 2 %
								//jika tidak maka potongan 0%
								
                            	
								$note		="cuti alasan penting";
								$style		= " class='warning' ";
								$tot_d_cutlain++;
                            
                            	if((count($d_cutlain)<=5) )
                                {
                                	
									$potongan	="0%";	
                                }else if((count($d_cutlain)>5))
                                {
                                	if($tot_d_cutlain > 5)
                                    {
                                    	$potongan	="2%";	
                                    }
                                }
                                
                                $info_baru ="2% dari Ekinerja";
                                
								
							
							//cek database cuti sakit 0%							
							}else if (in_array($tanggal_get, $d_cutsak))
							{
								
								$note		="sakit";
								$style		= " class='warning' ";
								$tot_cutsak++;
                            
                            	
                            	if((count($d_cutsak)<=3) )
                                {
                                	
									$potongan	="0%";	
                                }else if((count($d_cutsak)>3))
                                {
                                	if($tot_cutsak > 3)
                                    {
                                    	$potongan	="2%";	
                                    }
                                }
                                
                                $info_baru ="1% dari Ekinerja";
                                
                            
								/************* INGAT ********cek sakit adalah ket.sah *******************/
							}else if (in_array($tanggal_get, $d_sakit)) 
							{
								
								
								//$total_absen++;
								
                            	//$note		="sakit";
								//$style		= " class='warning' ";
								
                            	/*
                            	if((count($d_sakit)<=3) )
                                {
                                	
									$potongan	="0%";	
                                }else if((count($d_sakit)>3))
                                {
                                	if($tot_cutsak > 3)
                                    {
                                    	$potongan	="2%";	
                                    }
                                }
                                */


                                /*
								
                                $note		="sakit";
								$style		= " class='warning' ";
								$tot_cutsak++;
                            
                            	
                            	if((count($d_sakit)<=3) )
                                {
                                	
									$potongan	="0%";	
                                }else if((count($d_sakit)>3))
                                {
                                	if($tot_cutsak > 3)
                                    {
                                    	$potongan	="2%";	
                                    }
                                }
                            	*/

                            	$tot_ijin_ket++;
                            	$potongan	="2%";	
                                
                                $note		="sakit";
								$style		= " class='warning' ";
								$tot_cutsak++;
                                $info_baru ="1% dari Ekinerja";
                                
								//cek dinas luar
							}else if (in_array($tanggal_get, $d_dinas)) 
							{
								$potongan	="0%";
								$note		="dinas";
								$style		= " class='info' ";								
								$tot_dinas_luar++;
								
								//cek database libur
							}else if (in_array($tanggal_get, $d_libur)) 
							{
								$potongan	="0%";
								$note		="libur";
								$style		= " class='info' ";
								
							}else if($data->jam_masuk==null && $data->jam_keluar==null)
							{
								
								//tanpa alasan
								
								$potongan	= "0%";
								
								$style		= " class='danger' ";
								
								$total_absen++;
                                
                                $info_baru = "4% dari TPP";
								
								
							
							}else if($data->jam_masuk==null && $data->jam_keluar!=null)
							{
																
								$potongan	= "1.5%";
								$style		= " class='warning' ";
								$total_hadir++;
								
								$total_telat+=61;
								$telat_masuk+=61;
								
								//nb:tidak absen pulang dianggap lebih dari 60menit
							
							}else if($data->jam_masuk!=null && $data->jam_keluar==null)
							{
																
								$potongan	= "1.5%";
								$style		= " class='warning' ";
								$total_hadir++;								
								$total_telat+=61;
								$cepat_pulang +=61;
								//nb:tidak absen masuk dianggap lebih dari 60menit
							
							}else if($total_telat >0 && $total_telat <=30)
							{
								$potongan="0.5%";
								$style		= " class='warning' ";
								$total_hadir++;
								
								
							}else if($total_telat >30 && $total_telat <61 )
							{
								$potongan="1%";
								$style		= " class='warning' ";
								$total_hadir++;
							
							}else if($total_telat >60)
							{
								$potongan="1.5%";
								$style		= " class='warning' ";
								$total_hadir++;
							
							}else{
								$potongan="0%";
								$style		= " class='' ";
								$total_hadir++;
							
							}
							
                            
                            

							/***************** solusi untuk persen dijumlahkan *****************/
							if($telat_masuk>0 && $cepat_pulang>0)
							{
								$x =0;
								$y =0;

								
								
								if($telat_masuk>0 && $telat_masuk<=30)
								{
									$x="0.5%";									
									
								}else if($telat_masuk >30 && $telat_masuk<=60)
								{
									$x="1%";
									
								}else if($telat_masuk >60)
								{
									$x="1.5%";
								}

								if($cepat_pulang>0 && $cepat_pulang<=30)
								{
									$y="0.5%";									
									
								}else if($cepat_pulang >30 && $cepat_pulang<=60)
								{
									$y="1%";
									
								}else if($cepat_pulang >60)
								{
									$y="1.5%";
								}
								$potongan = $x+$y;
								$potongan = $potongan."%";
							
							}
							/***************** solusi untuk persen dijumlahkan *****************/
                            
                            /******penyelesaian masalah*****/
                            $hukumannya = $this->m_absensi->m_hukuman($nik,$tanggal_get);
                            
                            if(count($hukumannya)>0)
                            {
                            	$potongan=$hukumannya[0]->hukuman."%";
								$style		= " class='hukuman'";
                            	
                            	$arr_hukuman[] = $hukumannya[0];
                            }
                            
                            /******penyelesaian masalah*****/
                            
                            
							
							$total_pot+=$potongan;
							
							
							$tot_telat_masuk+=$total_telat;
							
								
							}
							
							$i++;
						
					$info_potongan="";
					if($total_absen >= 5)
					{
						$total_pot=100;
						$info_potongan= "<div class='alert alert-info text-center'>PERBUP: Jika tidak hadir lebih besar dari 4 hari <b>( >=5 )</b>, Potongan 100%.</div>";
                        
                        
						
					}
				
				
				
					//$tpp 					= $this->session->userdata('TPP');					
					$tpp 					= $ekinerja->ekinerja->tpp_full;					
					$tpp_dasar_e			= $ekinerja->ekinerja->tpp_dasar;
					$tpp_dapat_e			= $ekinerja->ekinerja->tpp_dapat<0?0:$ekinerja->ekinerja->tpp_dapat;
					
					$persen_absen 			= round($tpp*30/100);
					
					$setelah_dipotong_absen = round($persen_absen*$total_pot/100);

                    
					$potong_perbub_baru = ($tpp*($total_absen*4)/100);
                    $potong_perbub_baru_sakit = ($tpp_dasar_e*($tot_cutsak*1)/100);
                    $potong_perbub_baru_cuti_lain = ($tpp_dasar_e*($tot_d_cutlain*2)/100);
                            
                            
                        
					$hasil_exclude_ekinerja	= $persen_absen-$setelah_dipotong_absen;
					
					
					//jika absen lebih dari 4
					if($total_absen >= 5)
					{
						$hasil_exclude_ekinerja=0;
                        $hasil_akhir=0;
					}else{
                        $hasil_akhir = $hasil_exclude_ekinerja+$tpp_dapat_e-($potong_perbub_baru)-$potong_perbub_baru_sakit-$potong_perbub_baru_cuti_lain;
                    }

					
					
					
					$ekinerja_akhir = $tpp_dapat_e - $potong_perbub_baru_sakit-$potong_perbub_baru_cuti_lain;
					
					/*
					echo "<div class='col-xs-3'>TPP TOTAL </div><div class='col-xs-3'>: ".rupiah($tpp)."</div><div style='clear:both'></div>";					
					echo "<div class='col-xs-3'>TPP EKINERJA DASAR </div><div class='col-xs-3'>: ".rupiah($tpp_dasar_e)."</div><div style='clear:both'></div>";					
					echo "<div class='col-xs-3'>TPP ABSEN DASAR</div><div class='col-xs-3'>: ".rupiah($persen_absen)."</div><div style='clear:both'></div>";
					echo "<hr>";
					echo "<div class='col-xs-3'>TPP EKINERJA </div><div class='col-xs-3'>: ".rupiah($tpp_dapat_e)."</div><div style='clear:both'></div>";					
					echo "<div class='col-xs-3'>POTONGAN ABSEN </div><div class='col-xs-3'>: ".rupiah($setelah_dipotong_absen)."</div><div style='clear:both'></div>";
					echo "<div class='col-xs-3'>HASIL ABSEN</div><div class='col-xs-3'>: ".rupiah($hasil_exclude_ekinerja)."</div><div style='clear:both'></div>";
					
					echo "<hr>";
					echo "<div class='alert alert-success'><div class='col-xs-3 '><b>HASIL </b></div><div class='col-xs-3'>: <b>Rp.".rupiah($hasil_akhir)."</b></div><div style='clear:both'></div></div>";
					*/
					
					//var_dump($ekinerja);

	$ret = array("tpp"=>array("bulan"=>$bulan,"pokok"=>$tpp,"ekinerja"=>$ekinerja_akhir,"potong_perbub_baru"=>$potong_perbub_baru,"kehadiran"=>$hasil_exclude_ekinerja,"persen_pot_absen"=>$total_pot,"total"=>$hasil_akhir));


	echo json_encode($ret);		
?>
				