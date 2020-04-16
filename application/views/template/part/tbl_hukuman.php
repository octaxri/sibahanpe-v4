 
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Data 
        <small>Hukuman Apel Pagi</small>
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
						<th>JUDUL</th>
						<th>TANGGAL</th>						
						<th>HUKUMAN</th>
						<th>KORBAN</th>
						<th>OLEH</th>
                  		  <th>Action</th>
					</tr>
				</thead>
				
				<tbody>
					<?php
						$no=0;
						foreach($hukuman as $lib)	
						{
							$no++;
							$nip = $lib->NIP*1;
							if($lib->NIP >0)
							{
								$lihat_semua = "<button class='btn btn-xs btn-success' onclick='lihat_nip_tersangka($lib->id)'>Lihat Semua</button>";
							}else{
								$lihat_semua = "";
							}
							
							
							echo "
									<tr>
										<td>$no</td>
										<td>$lib->judul</td>										
										<td>".tglindo($lib->tanggal)."</td>
										<td>$lib->hukuman %</td>
										<td>$nip Orang $lihat_semua</td>
										<td>$lib->NIP_REFF</td>
										<td><button onclick='hapus_hukuman($lib->id)' class='btn btn-xs btn-danger'>Hapus</button>
									</tr>
								";
									
								
						
						}
						
					?>
				</tbody>
				
			</table>
			</div>
		</div>
	</section>
	
	

	
<!-- Modal penolakan-------------------------------------------------------------------->
<div id="modal_tersangka" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" id="modal_isi">
      <div class="modal-header">        
        <h4 class="modal-title">NIP Tersangka</h4>
		
		
      </div>
      <div class="modal-body" id="t4_tersangka">
        
      </div>
      
    </div>

  </div>
</div>
<!-- Modal penolakan-------------------------------------------------------------------->


<script>
function lihat_nip_tersangka(id)
{
	
	$('#modal_tersangka').modal({backdrop: true});
	
	$.get("index.php/hukuman/lihat_semua_nip/"+id,function(e){
			
		$("#t4_tersangka").html('').html(e);				
	})
	
}
function hapus_hukuman(id)
{

	if(confirm("Yakin menghapus hukuman?"))
    {
    	$.get("<?php echo base_url()?>index.php/hukuman/hapus_hukuman/"+id,function(){
        	eksekusi_controller("index.php/hukuman/data_hukuman");
        })
    }

}
</script>



<script>
	$("#tbl_libur").dataTable({"iDisplayLength": 100});
	
	
</script>