<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Rekap Bulan <?php echo $bulan?> - <?php echo date("Y")?>
        
      </h1>     
    </section>

	
	
    <section class="content">
	
		 <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">- </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>            
          </div>
        </div>
		
		<div class="box-body">
				
		<form id="go_absen">
			
			
			
			
			<div class="col-sm-12">
			<div class="input-group">
				<div class="col-sm-3">
					<select name="bulan" class="form-control" id="bulan" required>
						<option value=""> --- pilih bulan --- </option>
						<option value="1">Januari</option>
						<option value="2">Feburari</option>
						<option value="3">Maret</option>
						<option value="4">April</option>
						<option value="5">Mei</option>
						<option value="6">Juni</option>
						<option value="7">Juli</option>
						<option value="8">Agustus</option>
						<option value="9">September</option>
						<option value="10">Oktober</option>
						<option value="11">November</option>
						<option value="12">Desember</option>
					</select>
				</div>
            <div class="col-sm-3">
            	<option value=""> --- pilih tahun --- </option>
						<option value="2017">2017</option>
						<option value="2018">2018</option>
            </div>
				
			   <span class="input-group-btn">
					<button class="btn btn-default" type="submit">Go!</button>
			   </span>
			</div>
			</div>
			</form>
		</div>
	</section>
	
    <!-- Main content -->
    <section class="content">
      
	  
	   <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Laporan </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>            
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
	
	
			<table id="tbl_absen" class="table table-bordered">
				<thead>
					<tr>
						<th>No.</th>
						<th>NAMA</th>
						<th>NIP</th>
						<th>EKINERJA</th>
						<th>KEHADIRAN</th>
						<th>TOTAL</th>
										
					</tr>
				</thead>
				
				<tbody>
					<?php
						$no=0;
						//ambil_data dari e kinerja
						
		
						
						foreach($staff_arr as $data)
						{
							$no++;
							$tpp = json_decode(file_get_contents(base_url()."index.php/getbynik/dapat_absen_by_nik?nik=$data->Nik&bulan=$bulan"));
							
							echo "
								<tr>
									<td>$no</td>
									<td>$data->Nama</td>
									<td>$data->Nik</td>
									<td align='right'>".rupiah($tpp->tpp->ekinerja)."</td>
									<td align='right'>".rupiah($tpp->tpp->kehadiran)."</td>
									<td align='right'>".rupiah($tpp->tpp->total)."</td>
									
								</tr>
							";
								
								
						}
						
					
					?>
				</tbody>
				

			
			</table>
			
			
			<br>
			
		
			
        </div>
		
        <!-- /.box-body -->
        <div class="box-footer">
          ------
		  <a href="<?php echo base_url()?>index.php/laporan/rekap_pdf/<?php echo $bulan?>" target="_blank">Download</a>
        </div>
		
      </div>
      <!-- /.box -->
	  
	  
	  
	  
	</section>
	
	
	
	
	

	
<script>
	 

	$("#go_absen").submit(function(){
		
		var bulan 	= $("#bulan").val();
		eksekusi_controller('laporan/staff_by_opd/'+bulan);
		return false;
	})
	
	
</script>