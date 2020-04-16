

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Data
        <small>Kehadiran</small>
      </h1>     
    </section>

    <!-- Main content -->
    <section class="content">
      
	  
	   <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Kehadiran <?php echo tglindo($tanggal)?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>            
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
		
			<form id="go_absen">
			<div class="col-sm-5">
			<div class="input-group">
			   <input class="form-control" id="tanggal" required value="<?php echo $tanggal?>" >
			   <span class="input-group-btn">
					<button class="btn btn-default" type="submit">Go!</button>
			   </span>
			</div>
			</div>
			</form>
		
			<div style="clear:both"></div>
			<?php 
			if(isWeekend($tanggal))
			{
				echo( "<div class='alert alert-danger text-center'><h4>Bukan hari kerja</h4></div>" );
				
				unset($absen_kemarin); // $foo is gone
				$absen_kemarin = array(); // $foo is here again
				
			}
			?>
			<div class="table-responsive">
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
						<!--<th>POTONGAN</th>-->
					</tr>
				</thead>
				
				<tbody>
					<?php
					$no=0;
					
						
						
					
						foreach($absen_kemarin as $data)
						{
							
							
							
							
							
							
							
							$no++;
							$total_telat = $data->telat_masuk+$data->cepat_pulang;
							
							$jam_masuk = $data->jam_masuk==null?"<font color=red>-</font>":$data->jam_masuk;
							$jam_keluar = $data->jam_keluar==null?"<font color=red>-</font>":$data->jam_keluar;
							
							
							
							$note	= "";
							$style	= "";
						
							
							
							if($data->jam_masuk==null && $data->jam_keluar==null)
							{
								
								//cek database apakah ada sakit pada tanggal itu.
								$potongan	="5%";
								$style		= " class='danger' ";
							
							}else if($data->jam_masuk==null && $data->jam_keluar!=null)
							{
																
								$potongan="1.5%";
								$style		= " class='warning' ";
							
							
							}else if($data->jam_masuk!=null && $data->jam_keluar==null)
							{
																
								$potongan="1.5%";
								$style		= " class='warning' ";
							
							
							}else if($total_telat >0 && $total_telat <=30)
							{
								$potongan="0.5%";
								$style		= " class='warning' ";
								
							}else if($total_telat >30 && $total_telat <61 )
							{
								$potongan="1%";
								$style		= " class='warning' ";
							
							}else if($total_telat >60)
							{
								$potongan="1.5%";
								$style		= " class='warning' ";
							
							}else{
								$potongan="0%";
								$style		= " class='' ";
							}
							
							
							
							
							
							
							echo "
								<tr $style>
									<td>$no</td>
									<td>$data->Nama</td>
									<td>$data->Nik</td>
									<td>$jam_masuk</td>
									<td>$jam_keluar</td>
									<td>".floor($data->telat_masuk)."</td>
									<td>".floor($data->cepat_pulang)."</td>
									<td>$total_telat</td>
									<!--<td>$potongan</td>-->
								</tr>
							";
							
						}
					
					?>
				</tbody>
			
			</table>
			</div>
		
        </div>
		
        <!-- /.box-body -->
        <div class="box-footer">
          ------
        </div>
		
      </div>
      <!-- /.box -->
	  
	  
	  
	</section>


<script>
	 $(function () {
		
		$('#tanggal').datepicker({
			format: 'yyyy-mm-dd',						
		}).on('changeDate', function(e){
			$(this).datepicker('hide');
		});
	});

	$("#go_absen").submit(function(){
		var date = $("#tanggal").val();
		eksekusi_controller('index.php/absensi/absen_by_date/'+date);
	})
</script>