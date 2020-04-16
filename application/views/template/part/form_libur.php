<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Form Setting Libur
        
      </h1>     
    </section>

    <!-- Main content -->
    <section class="content">
      
	  
	   <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Libur</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>            
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
			<form id="go_absen">
			
			
			
			
			<div class="col-sm-12">
			<div class="input-group">
				
				<div class="col-sm-6">
					<input type="text" class="form-control" id="tanggal" required placeholder="tanggal">
				</div>
				<div class="col-sm-6">
					<textarea class="form-control" name="keterangan" required id="keterangan" placeholder="Keterangan"></textarea>
				</div>
			   <span class="input-group-btn">
					<button class="btn btn-default" type="submit">Go!</button>
			   </span>
			</div>
			</div>
			</form>
        </div>
		
        <!-- /.box-body -->
        <div class="box-footer">
          Required harus diisi.
        </div>
		
      </div>
      <!-- /.box -->
	  
	  
	  
	</section>


<script>
	 $(function () {
		//$('#tanggal').datepicker({format: 'Y-m-d'});
		$('#tanggal').datepicker({
			format: 'yyyy-mm-dd',
			maxDate: '0'
		}).on('changeDate', function(e){
			$(this).datepicker('hide');
		});
	});

	$("#go_absen").submit(function(){
		var tanggal 	= $("#tanggal").val();
		var keterangan 	= $("#keterangan").val();
		//eksekusi_controller('absensi/absen_by_nik/'+nik);
		
		$.post("<?php echo base_url()?>index.php/absensi/set_libur/",{tanggal:tanggal,keterangan:keterangan},function(e){
			//alert(e);
			$(".content-wrapper").html(e);
		});
		
		return false;
		
	})
	
	
</script>