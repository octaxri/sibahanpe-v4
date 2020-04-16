<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Form Absen Apel Gabungan/Upacara
        
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
			
					
					
				
						
					<input type="hidden" class="form-control" name="NIP_REFF" readonly placeholder="NIP_REF" value="<?php echo $this->session->userdata('NIK');?>">
					
					<br>
					Tanggal
					<input type="text" class="form-control" id="tanggal" required placeholder="tanggal" name="tanggal">
					
				
					<br>
					Judul
					<input class="form-control" name="judul" required id="judul" placeholder="Mis:Apel Gabungan">
					
					<br>
					Persentase Hukuman (disi 1-100 hanya angka saja) 
					<input class="form-control" type="number" name="hukuman" required id="hukuman" placeholder="Persen Hukuman" min="1" max="100">
				
					
					<hr>
					<font color="red"> Isikan NIP yang tidak hadir dibawah ini.</font>
					<br>
					<div id="t4_NIP"></div>
					<button class="btn btn-primary" id="tambah_nip"><span class="fa  fa-plus" ></span> Tambah NIP</button>
					<br>
					<br>
					
					
					<br>
					<font color="red"><b>Perhatian!!!</b>Sebelum anda menekan tombol hukum, pastikan sudah benar datanya.</font>
					<button class="btn btn-danger btn-block" type="submit">Hukum!</button>
			   
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

	
 function tambah_nip()
 {
	
		
		var $aa = $("<div class=''><input type='number' class='form-control obat' id='NIP' value='' name='NIP[]' placeholder='NIP'></div>");
		$aa.appendTo("div#t4_NIP");
		
 }

 tambah_nip();
 tambah_nip();
 $("#tambah_nip").click(function(){
	 tambah_nip();
	 return false;
 })
	
	
	
$("#go_absen").submit(function(){
	
	if(confirm("Anda sudah yakin dengan Hukuman ini? Karena akan langsung diterapkan"))
	{
			
		$.post("<?php echo base_url()?>index.php/hukuman/simpan_hukuman/",$(this).serialize(),function(e){
			//alert(e);
			
			//$(".content-wrapper").html(e);
			eksekusi_controller('index.php/hukuman/data_hukuman');
		});
		
		
	
	}
	return false;
	
})

	
</script>