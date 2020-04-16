
 
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Data 
        <small>Ijin Download Rekapitulasi</small>
      </h1>     
    </section>

    <!-- Main content -->
    <section class="content">
      
	  
	   <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        
        <!-- /.box-header -->
        <div class="box-body">
		<button class="btn btn-primary" onclick="buka_tombol()">Buka Ijin Download</button>		
				
				<div class="table-responsive">
				<table id="tbl_libur" class="table table-bordered">
				<thead>
					<tr>
						<th width="20px">No.</th>
						<th>OPD</th>
						<th>TGL UPDATE</th>						
						<th>STATUS</th>
						<th>ACTION</th>
					</tr>
				</thead>
				
				<tbody>
					<?php
						$no=0;
						foreach($all as $lib)	
						{
							$no++;
							
						echo "
								<tr>
									<td>$no</td>
									<td>$lib->OPD</td>									
									<td>".tglindo($lib->tgl_update)."</td>
									<td>Aktif</td>
									<td><button class='btn btn-danger' onclick='tutup($lib->id_opd);return false;'>Tutup</button></td>
									
									
								</tr>
							";
								
								
						
						}
						
					?>
				</tbody>
				
			</table>
			</div>
		</div>
	</section>





<!-- Modal -->
<div id="myModal_ijin_tombol" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form Ijin Download</h4>
      </div>
      <div class="modal-body">
        <form id="form_go_setting">
        	<select id="id_opd" name="id_opd" required="required" class="form-control">
        		<option value="">--- Pilih Opd ---</option>
        		<?php 
        			foreach($all_opd as $opd)
        			{
        				echo "
        					<option value='$opd->ID_OPD'>$opd->OPD</option>
        				";
        			}
        		?>
        	</select>
        	<div id="t4_ok"></div>
        	<button type="submit" class="btn btn-primary">Buka Ijin</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<script>
	
	function tutup(id)
	{
		if(confirm("Anda Yakin menutup?"))
		{
			$.get("<?php echo base_url()?>index.php/ijin_download/tutup/"+id,function(e){
				
				eksekusi_controller('index.php/ijin_download/form');
			});
		}
	}
	
	function buka_tombol()
	{
		$("#myModal_ijin_tombol").modal("show");
	}
	


	$("#form_go_setting").on("submit",function(){

		var id_opd = $("#id_opd").val();
			if(id_opd =='')
			{
				return false;
			}

		$.post("<?php echo base_url()?>index.php/ijin_download/simpan",$(this).serialize(),function(x){
				
			$("#t4_ok").html('<div class="alert alert-success">Berhasil disimpan. ['+x+']</div>').fadeIn().delay(3000).fadeOut();
		})


		return false;
	});


	$('#myModal_ijin_tombol').on('hidden.bs.modal', function () {
	  	eksekusi_controller('index.php/ijin_download/form');		
	});
</script>