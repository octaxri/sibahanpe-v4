
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <strong>Admin Apel Pagi</strong>
      </h1>     
    </section>

    <!-- Main content -->
    <section class="content">
      
	  
	   <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        
        <!-- /.box-header -->
        <div class="box-body">
		
					
			
			<button class="btn btn-primary" onclick="eksekusi_controller('index.php/apel_pagi/index')" > Tambah Admin</button>			
			<br><br>
				
				<div class="table-responsive">
		
			<table class="table table-striped table-bordered data-table">
				<tr>
					<th>NO</th>
					<th>NIP</th>
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
					<td><?php echo $q->NIP ?></td>
					<td>
						
						<a href="#hapus_apel?id=<?php echo $q->id?>" onclick="hapus('<?php echo $q->id?>')" class="btn btn-xs btn-danger">Hapus</a>

					</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
    </div>
  </section>


<script>
function hapus(id)
{
	if(confirm("Anda yakin?"))
    {
		
    	$.get("<?php echo base_url()?>index.php/apel_pagi/hapus/"+id,function(){
        
        	eksekusi_controller("index.php/apel_pagi/tampil_apel");
        
        })
    
    }
}
</script>
