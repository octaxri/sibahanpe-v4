
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <strong>Tambah Pimpinan</strong>
      </h1>     
    </section>

    <!-- Main content -->
    <section class="content">
      
	  
	   <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        
        <!-- /.box-header -->
        <div class="box-body">
		
					
		
		<form action="tambah_pimpinan" method="post" id="tambah_pimpinan">
			<div class="row">
				
            	<div class="col-md-4">
					<label>ID OPD</label>
				</div>
				<div class="col-md-6">
					<!--<input type="number" name="ID_OPD" required="" class="form-control" maxlength="17" placeholder="ID OPD">-->
                	<select name="ID_OPD" class="form-control" id="id_opd" required>
                    	<option value="">--- Pilih OPD ---</option>                
                    	<?php
                          	foreach($OPD as $val)
                            {
                            	echo "<option value='$val->ID_OPD'>$val->OPD</option>";
                            }
                         ?>
	                </select>
				</div>
            
            	
            	<div class="col-md-4">
					<label>NIP</label>
				</div>
            
            	
				<div class="col-md-6">
					<input type="number" name="NIP" required="" class="form-control" maxlength="17" placeholder="NIP" >                	
				</div>
            	
				
                
				<div class="col-md-4">
					<label>JABATAN SET</label>
				</div>
				<div class="col-md-6">
					<input type="text" name="JABATAN_SET" id="JABATAN_SET" required class="form-control" maxlength="17" placeholder="JABATAN_SET" >
				</div>
				
				
				<div class="col-md-4">
				</div>
				<div class="col-md-6"><br>
					<input type="submit" name="simpan" value="Simpan" class="btn btn-sm btn-success">
				</div>
			</div>
		</form>
      </div>
    </div>
  </section>

<script>
$("#tambah_pimpinan").on("submit",function(){
	
	$.post("<?php echo base_url()?>index.php/pimpinan/tambah_pimpinan",$(this).serialize(),function(){
    	eksekusi_controller("index.php/pimpinan/tampil_pimpinan");
    })
	
return false;
})

/*
$("#id_opd").on("change",function(){
	
	var ID_OPD = $(this).val();
	$("#NIPS").empty();
	$("#NIPS").append('<option value="">--- Pilih NIP ---</option>');
	//alert(ID_OPD);
	$.get("https://sibahanpe.pakpakbharatkab.go.id/api/all_staff_by_opd.php?ID_OPD="+ID_OPD,function(e){
    	
    	//console.log(e);
    	$.each(e,function(a,b){
        	console.log(b.NIP);	
        	$("#NIPS").append("<option value='"+b.NIP+"'>"+b.NIP +" | "+b.NAMA+"</option>");
        })
    
    })

});

$("#NIPS").on("change",function(){

	var NIP = $(this).val();

	$.get("https://sibahanpe.pakpakbharatkab.go.id/api/staff.php?NIP="+NIP,function(z){
    
    	console.log(z.FID);
    	$("#FID").val(z.FID);
    
    })

});
*/


$("#tambah_pimpinan").on("submit",function(){
	$.post("<?php echo base_url()?>index.php/pimpinan/tambah_pimpinan",$(this).serialize(),function(){
    		eksekusi_controller("index.php/pimpinan/tampil_pimpinan");
    });

	return false;
})

</script>