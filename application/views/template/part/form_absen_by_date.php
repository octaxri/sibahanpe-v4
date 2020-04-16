<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Form Lihat Jadwal
        
      </h1>     
    </section>

    <!-- Main content -->
    <section class="content">
      
	  
	   <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Pilih Tanggal</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>            
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
			<form id="go_absen">
			<div class="col-sm-5">
			<div class="input-group">
			   <input type="text" class="form-control" id="tanggal" required>
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
		var date = $("#tanggal").val();
		eksekusi_controller('index.php/absensi/absen_by_date/'+date);
	})
</script>