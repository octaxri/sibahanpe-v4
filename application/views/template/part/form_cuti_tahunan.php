<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Form Cuti Tahunan
        
      </h1>     
    </section>

    <!-- Main content -->
    <section class="content">
      
	  
	   <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
      
	  
        <!-- /.box-header -->
        <div class="box-body">
			<form id="go_absen">
			
			
			
			
			<div class="col-sm-6">
			
					<input type="hidden" class="form-control" id="FID" readonly placeholder="FID" value="<?php echo $this->session->userdata('FID');?>">
				
					NIP					
					<input type="text" class="form-control" id="NIK" readonly placeholder="NIP" value="<?php echo $this->session->userdata('NIK');?>">
					
					<br>
					Tanggal
					<input type="text" class="form-control" id="tanggal" required placeholder="tanggal">
					
					<br>
					s.d
					<input type="text" class="form-control" id="tanggal_antara" required placeholder="Sampai dengan">
            <font color="red"><b>Perhatian!!!</b> Pengisian tanggal jangan sampai salah!!!</font>
            		<br>
					<br>
					Keterangan
					<textarea class="form-control" name="keterangan" required id="keterangan" placeholder="Keterangan"></textarea>
				
					<br>
					
					<button class="btn btn-info btn-block" type="submit">Go!</button>
			   
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
		$('#tanggal_antara').datepicker({
			format: 'yyyy-mm-dd',
			maxDate: '0'
		}).on('changeDate', function(e){
			$(this).datepicker('hide');
		});
	});

	$("#go_absen").submit(function(){
		var tanggal 	= $("#tanggal").val();
		var tanggal_antara 	= $("#tanggal_antara").val();
		var keterangan 	= $("#keterangan").val();
		var NIK 		= $("#NIK").val();
		var FID 		= $("#FID").val();
		//eksekusi_controller('absensi/absen_by_nik/'+nik);
		
		
		if( (new Date(tanggal).getTime() > new Date(tanggal_antara).getTime()))
		{
			alert("Perhatikan pengisian tanggal. Ada yang salah.");
			return false;
		}
    
    	function daydiff(first, second) 
    	{
 		   	var awal  = new Date(first);
    		var akhir = new Date(second);
    		return Math.round((akhir-awal)/(1000*60*60*24))+1;
		}
    	
    	if(daydiff(tanggal,tanggal_antara) > 8)
        {
        	alert("Perhatikan !!! Pengajuan Cuti Tahunan tidak boleh lebih dari 8 hari. Anda mengajukan Cuti Tahunan "+daydiff(tanggal,tanggal_antara)+" hari.");
			return false;
        }

		
		
		$.post("<?php echo base_url()?>index.php/absensi/set_form_cuti_tahunan/",{FID:FID,NIK:NIK,tanggal_antara:tanggal_antara,tanggal:tanggal,keterangan:keterangan},function(e){
			//alert(e);
			
			//$(".content-wrapper").html(e);
			eksekusi_controller('index.php/absensi/data_cuti_tahunan_by_nik');
		});
		
		return false;
		
	})
	
	
</script>