
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <strong>Pimpinan</strong>
      <small>Penanda Tangan TPP</small>
      </h1>     
    </section>

    <!-- Main content -->
    <section class="content">
      
	  
	   <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        
        <!-- /.box-header -->
        <div class="box-body">
		
					
			
			<button class="btn btn-primary" onclick="eksekusi_controller('index.php/pimpinan/index')" > Tambah Pimpinan</button>			
			<br><br>
				
				<div class="table-responsive">
			<table class="table table-striped table-bordered data-table">
				<tr>
					<th>NO</th>
					<th>FID</th>
					<th>NIP</th>
					<th>JABATAN TPP</th>
					<th>OPD</th>
					<th>AKSI</th>
				</tr>
				<?php 
					$no=0;
					foreach($query as $q)
					{
						$no++;
				?>
				<tr>
					<td><?php echo $no ?></td>
					<td><?php echo $q->FID ?></td>
                <td><?php echo $q->NIP ?><br><small><?php echo $q->NAMA?></small></td>
					<td><?php echo $q->JABATAN_SET ?></td>
					<td><?php echo $q->OPD ?></td>
					<td>
						
						<a href="#" onclick="hapus('<?php echo $q->id_pimpinan?>')" class="btn btn-xs btn-danger">Hapus</a>

					</td>
				</tr>
				<?php } ?>
			</table>


		</div>
	</div>
    </div>
  </section>

<script type="text/javascript">
	function hapus(id_pimpinan)
	{
		if (confirm("Hapus?"))
		{
			$.get("<?php echo base_url()?>index.php/pimpinan/hapus_pimpinan/"+id_pimpinan,function(e){
				eksekusi_controller("index.php/pimpinan/tampil_pimpinan");
			});
		}
	}
</script>