
 
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
		
				
				<div class="table-responsive">
				<table id="tbl_libur" class="table table-bordered">
				<thead>
					<tr>
						<th width="20px">No.</th>
						<th>FID</th>
						<th>NAMA/NIP</th>
						<th>Tanggal</th>
						<th>Masuk/Pulang</th>
						<th>Keterangan</th>
						<th>Status</th>
					</tr>
				</thead>
				
				<tbody>
					<?php
						$no=0;
						foreach($cuti as $lib)	
						{
							$no++;
							
							
							if($lib->status=='pending')
							{
								$status = '<button class="btn btn-xs btn-primary" onclick="setujui('.$lib->id.')">Setujui</button>';
								$status .= '<button class="btn btn-xs btn-danger" onclick="tolak('.$lib->id.')">Tolak</button>';
							}else{
								$status = $lib->status;
							}
							
						echo "
								<tr>
									<td>$no</td>
									<td>$lib->FID</td>
									<td>$lib->Nama <br> <small><i>$lib->NIK</i></small></td>
									<td>".tglindo($lib->tanggal)."</td>
									<td>$lib->masuk_pulang</td>
									<td>$lib->keterangan</td>
									<td>$status</td>
									
									
								</tr>
							";
								
								
						
						}
						
					?>
				</tbody>
				</div>
				
			</table>
		</div>
	</section>
<script>
	$("#tbl_libur").dataTable({"iDisplayLength": 100});
	
	function setujui(id)
	{
		if(confirm("Anda Yakin menyetujui?"))
		{
			$.get("<?php echo base_url()?>index.php/absensi/setujui_ijin_keterangan/"+id,function(e){
				
				eksekusi_controller('index.php/absensi/data_ijin_keterangan');
			});
		}
	}
	
	function tolak(id)
	{
		if(confirm("Anda Yakin menolak?"))
		{
			$.get("<?php echo base_url()?>index.php/absensi/tolak_ijin_keterangan/"+id,function(e){
				
				eksekusi_controller('index.php/absensi/data_ijin_keterangan');
			});
		}
	}
	
	
	
</script>