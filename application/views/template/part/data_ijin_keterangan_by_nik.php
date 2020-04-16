

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
			Surat Keterangan
      </h1>     
    </section>

    <!-- Main content -->
    <section class="content">
      
	  
	   <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        
        <!-- /.box-header -->
        <div class="box-body">
		
				
		
		
		
			
			<button class="btn btn-primary" onclick="eksekusi_controller('index.php/absensi/form_ijin_keterangan')" > Ajukan Ijin</button>			
			<br><br>
			
				<div class="table-responsive">
				<table id="tbl_libur" class="table table-bordered">
				<thead>
					<tr>
						<th width="20px">No.</th>
						<th>Tanggal</th>
						<th>Masuk/Pulang</th>
						<th>Keterangan</th>
						<th>Update</th>
						<th>REF</th>
						<th>Status</th>
					</tr>
				</thead>
				
				<tbody>
					<?php
						$no=0;
						foreach($cuti as $lib)	
						{
							$no++;
							
							
							$status = $lib->status;
							
							
						echo "
								<tr>
									<td>$no</td>
									<td>".tglindo($lib->tanggal)."</td>									
									<td>$lib->masuk_pulang</td>									
									<td>$lib->keterangan</td>									
									<td>$lib->tgl_update</td>
									<td>$lib->NIK_REF</td>
									<td>$status</td>
									
									
								</tr>
							";
								
								
						
						}
						
					?>
				</tbody>
				
			</table>
			</div>
		</div>
	</section>
<script>
	$("#tbl_libur").dataTable({"iDisplayLength": 100});
	
</script>