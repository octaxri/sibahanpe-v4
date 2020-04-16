<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Master 
        <small>Jadwal</small>
      </h1>     
    </section>

    <!-- Main content -->
    <section class="content">
      
	  
	   <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Jadwal <?php echo date('d-m-Y',strtotime("-1 days"));?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>            
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" id="t4_form_tambah">
		
			<table id="tbl_absen" class="table table-bordered">
				<thead>
					<tr>
						<th>No.</th>
						<th>NAMA</th>
						<th>NIK</th>
						<th>MASUK</th>
						<th>KELUAR</th>
						<th>TERLAMBAT MASUK</th>
						<th>CEPAT PULANG</th>						
						<th>TERLAMBAT</th>						
						<th>POTONGAN</th>						
					</tr>
				</thead>
				
				<tbody>
					<?php
					$no=0;
					
						foreach($absen_kemarin as $data)
						{
							$no++;
							$total_telat = $data->telat_masuk+$data->cepat_pulang;
							
							$jam_masuk = $data->jam_masuk==null?"<font color=red>A</font>":$data->jam_masuk;
							$jam_keluar = $data->jam_keluar==null?"<font color=red>A</font>":$data->jam_keluar;
							
							
							
							if($data->jam_masuk==null && $data->jam_keluar==null)
							{
								
								//cek database apakah ada sakit pada tanggal itu.
								$potongan="5%";
							
							}else if($data->jam_masuk!=null && $data->jam_keluar==null)
							{
																
								$potongan="1.5%";
							
							
							}else if($total_telat >0 && $total_telat <=30)
							{
								$potongan="0.5%";
								
							}else if($total_telat >30 && $total_telat <61 )
							{
								$potongan="1%";
							
							}else if($total_telat >60)
							{
								$potongan="1.5%";
							
							}
							
							
							echo "
								<tr>
									<td>$no</td>
									<td>$data->Nama</td>
									<td>$data->Nik</td>
									<td>$jam_masuk</td>
									<td>$jam_keluar</td>
									<td>".floor($data->telat_masuk)."</td>
									<td>".floor($data->cepat_pulang)."</td>
									<td>$total_telat</td>
									<td>$potongan</td>
								</tr>
							";
							
						}
					
					?>
				</tbody>
			
			</table>
		
        </div>
		
        <!-- /.box-body -->
        <div class="box-footer">
          ------
        </div>
		
      </div>
      <!-- /.box -->
	  
	  
	  
	</section>

