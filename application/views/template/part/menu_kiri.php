  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $gambar?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('NAMA');?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
	  
	  
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
       
	   
		<!--
		<li>
			<a href="#" onclick="eksekusi_controller('absensi/absen_live')">
				<i class="fa fa-folder"></i> <span>Absen Hari Ini</span>            
			</a>
		 </li>
        
		<li>
			<a href="#" onclick="eksekusi_controller('absensi/absen_kemarin')">
				<i class="fa fa-folder"></i> <span>Absen Kemarin</span>            
			</a>
		 </li>
        -->
		
		<li>
			<a href="#" onclick="eksekusi_controller('index.php/absensi/form_absen_by_date')">
				<i class="fa fa-folder"></i> <span>Kehadiran PerTanggal</span>            
			</a>
		 </li>
        
		
        
		<li>
			<a href="#" onclick="eksekusi_controller('index.php/absensi/form_absen_by_nik_perorang')">
				<i class="fa fa-folder"></i> <span>Riwayat Kehadiran</span>            
			</a>
		 </li>
		 
		 
		
		<li>
			<a href="#" onclick="eksekusi_controller('index.php/absensi/data_cuti_lain_by_nik')">
				<i class="fa fa-folder"></i> <span>Cuti Alasan Penting</span>            
			</a>
		 </li>
		 
		 
		<li>
			<a href="#" onclick="eksekusi_controller('index.php/absensi/data_cuti_tahunan_by_nik')">
				<i class="fa fa-folder"></i> <span>Cuti Tahunan</span>            
			</a>
		 </li>
		 
		
		<li>
			<a href="#" onclick="eksekusi_controller('index.php/absensi/data_cuti_sakit_by_nik')">
				<i class="fa fa-folder"></i> <span>Cuti Sakit/Sakit</span>            
			</a>
		 </li>
		 
		<li>
			<a href="#" onclick="eksekusi_controller('index.php/absensi/data_dinas_luar_by_nik')">
				<i class="fa fa-folder"></i> <span>Dinas Luar</span>            
			</a>
		 </li>
		 
				
		<!--
		<li>
			<a href="#" onclick="eksekusi_controller('index.php/absensi/data_sakit_by_nik')">
				<i class="fa fa-folder"></i> <span>Ijin Ket.Sah</span>            
			</a>
		 </li>
        -->
		 
		
		<li>
			<a href="#" onclick="eksekusi_controller('index.php/absensi/data_ijin_keterangan_by_nik')">
				<i class="fa fa-folder"></i> <span>Surat Keterangan</span>            
			</a>
		 </li>
		 
		
		 
		<?php 
			
/*			
if((strlen($this->session->userdata('FID'))==5 && substr($this->session->userdata('FID'),2,3) =='004') || (strlen($this->session->userdata('FID'))==4 && substr($this->session->userdata('FID'),2,2) =='04') )
			{
*/

if (in_array($this->session->userdata('NIK'), $admin)) {
			
		?> 
		 
		 <li>
			<hr>
		 </li>
		
		
		
		
		<li>
			<a href="#" onclick="eksekusi_controller('index.php/absensi/form_absen_by_nik')">
				<i class="fa fa-folder"></i> <span>Kehadiran ASN</span>            
			</a>
		 </li>
        
		<li>
			<a href="#" onclick="eksekusi_controller('index.php/absensi/data_staf_info')">
				<i class="fa fa-folder"></i> <span>Data Staf</span>            
			</a>
		 </li>
        
		
		 
		<li>
			<a href="#" onclick="eksekusi_controller('index.php/absensi/data_cuti_sakit')">
				<i class="fa fa-folder"></i> <span>Req. Cuti Sakit 
															<span class="pull-right-container">
																<span id="t4_notif_tbl_cuti_sakit" class="label label-warning pull-right"></span>
															</span>
												</span>            
			</a>
		 </li>
		 
		 <li>
			<a href="#" onclick="eksekusi_controller('index.php/absensi/data_cuti_lain')">
				<i class="fa fa-folder"></i> <span>Req. Cuti Penting 
													<span class="pull-right-container">
														<span id="t4_notif_tbl_cuti_lain" class="label label-warning pull-right"></span>
													</span>            
											  </span>            
			</a>
		 </li>
		 
		 
        
		<li>
			<a href="#" onclick="eksekusi_controller('index.php/absensi/data_cuti_tahunan')">
				<i class="fa fa-folder"></i> <span>Req. Cuti Tahunan
														<span class="pull-right-container">	
															<span id="t4_notif_tbl_cuti_tahunan" class="label label-warning pull-right"></span>
														</span>            
											</span>            
			</a>
		 </li>
		 
		 
		 
        
		<li>
			<a href="#" onclick="eksekusi_controller('index.php/absensi/data_dinas_luar')">
				<i class="fa fa-folder"></i> <span>Req. Dinas Luar 
														<span class="pull-right-container">	
															<span id="t4_notif_tbl_dinas_luar" class="label label-warning pull-right"></span>
														</span>            
											</span>            
			</a>
		 </li>
		 
		 
		<li>
			<a href="#" onclick="eksekusi_controller('index.php/absensi/data_sakit')">
				<i class="fa fa-folder"></i> <span>Req. Ijin Ket Sah 
														
														<span class="pull-right-container">
															<span id="t4_notif_tbl_surat_sakit" class="label label-warning pull-right"></span>
														</span>            
												</span>            
			</a>
		 </li>
		 
		 
		<li>
			<a href="#" onclick="eksekusi_controller('index.php/absensi/data_ijin_keterangan')">
				<i class="fa fa-folder"></i> <span>Req. Surat Keterangan 
														<span class="pull-right-container">
															<span id="t4_notif_tbl_surat_ijin_keterangan" class="label label-warning pull-right"></span>
														</span>            
											  </span>            
			</a>
		 </li>
		 
		
		<hr>

		<li>
			<!--<a href="#" onclick="eksekusi_controller('index.php/laporan/staff_by_opd/<?php echo date('m')?>')">-->
			<a href="#" onclick="eksekusi_controller('index.php/laporan/sinkronisasi')">
				<i class="fa fa-folder"></i> <span>Sinkronisasi</span>            
			</a>
		 </li>
		 
		 
		<li>
			<!--<a href="#" onclick="eksekusi_controller('index.php/laporan/staff_by_opd/<?php echo date('m')?>')">-->
			<a href="#" onclick="eksekusi_controller('index.php/laporan/form')">
				<i class="fa fa-folder"></i> <span>Cetak Rekapitulasi OPD</span>            
			</a>
		 </li>
		 
		
		<li>
			
			<a href="#" onclick="eksekusi_controller('index.php/absensi/form_print_absen_by_nik')">
				<i class="fa fa-folder"></i> <span>Cetak Rekapitulasi ASN</span>            
			</a>
		 </li>
		 
      
      	<hr>
      
		
		 <?php }?>
      
      
      <?php
      if($this->session->userdata('NIK')=='198303042009032014')
      {
      ?>
      
      	<hr>
		<li>
			<a href="#" onclick="eksekusi_controller('index.php/absensi/data_libur')">
				<i class="fa fa-folder"></i> <span>Data Libur</span>            
			</a>
		 </li>
		 
      	<li>			
			<a href="#" onclick="eksekusi_controller('index.php/apel_pagi/tampil_apel')">
				<i class="fa fa-folder"></i> <span>Admin Apel Pagi</span>            
			</a>
		 </li>
      
      <li>			
			<a href="#" onclick="eksekusi_controller('index.php/pimpinan/tampil_pimpinan')">
				<i class="fa fa-folder"></i> <span>Pimpinan</span>            
			</a>
		 </li>
      
      
      <?php
      }      
      ?>
      
      
      
      	<?php
      if (in_array($this->session->userdata('NIK'), $hukuman)) {
      ?>
      	<hr>
		<li>
			
			<a href="#" onclick="eksekusi_controller('index.php/hukuman/index')">
				<i class="fa fa-folder"></i> <span>Buat Hukuman</span>            
			</a>
		 </li>
		
      
		<li>
			
			<a href="#" onclick="eksekusi_controller('index.php/hukuman/data_hukuman')">
				<i class="fa fa-folder"></i> <span>Data Hukuman</span>            
			</a>
		 </li>
      
      


		<li>
			
			<a href="#" onclick="eksekusi_controller('index.php/ijin_download/form')">
				<i class="fa fa-folder"></i> <span>Izin download rekap</span>            
			</a>
		 </li>
      
      

		 <?php }?>
		
	
		
		
		
		
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
