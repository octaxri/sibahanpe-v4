

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Master 
        <small>Cuti Penting</small>
      </h1>     
    </section>

    <!-- Main content -->
    <section class="content">
      
	  
	   <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        
        <!-- /.box-header -->
        <div class="box-body">
		
		
			
			<button class="btn btn-primary" onclick="eksekusi_controller('index.php/absensi/form_cuti_lain')" > Ajukan Izin</button>			
			<br><br>
				
				<div class="table-responsive">
				<table id="tbl_libur" class="table table-bordered">
				<thead>
					<tr>
						<th width="20px">No.</th>
						<th>Tanggal</th>
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
	
	function setujui(id)
	{
		if(confirm("Anda Yakin menyetujui?"))
		{
			$.get("<?php echo base_url()?>index.php/absensi/setujui_cuti_lain/"+id,function(e){
				
				eksekusi_controller('index.php/absensi/data_cuti_lain');
			});
		}
	}
	
	function tolak(id)
	{
		if(confirm("Anda Yakin menolak?"))
		{
			$.get("<?php echo base_url()?>index.php/absensi/tolak_cuti_lain/"+id,function(e){
				
				eksekusi_controller('index.php/absensi/data_cuti_lain');
			});
		}
	}
	
	
	
</script>