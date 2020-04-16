

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Master 
        <small>STAF</small>
      </h1>     
    </section>

    <!-- Main content -->
    <section class="content">
      
	  
	   <!-- SELECT2 EXAMPLE -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">EDIT STAF</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>            
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
			<form id="go_edit_staf">
				
				
						<div class="form-group">						
							<label>FID</label>

							<div class="input-group">
							  <div class="input-group-addon">
								<i class="fa fa-sticky-note-o"></i>
							  </div>
							  <input class="form-control " name="FID" id="FID" required value="<?php echo $staf->FID?>" readonly>
							</div>
							<!-- /.input group -->
						  </div>
						
				
					<div class="form-group">
							<label>NIP</label>

							<div class="input-group">
							  <div class="input-group-addon">
								<i class="fa fa-sticky-note-o"></i>
							  </div>
							  <input class="form-control " name="NIK" id="NIK" required value="<?php echo $staf->NIK?>">
							</div>
							<!-- /.input group -->
						  </div>
						
						<div class="form-group">						
							<label>NAMA</label>

							<div class="input-group">
							  <div class="input-group-addon">
								<i class="fa fa-sticky-note-o"></i>
							  </div>
							  <input class="form-control " name="NAMA" id="NAMA" required value="<?php echo $staf->Nama?>">
							</div>
							<!-- /.input group -->
						  </div>
						
			
			
			
						<div class="form-group">						
							<label>PANGKAT</label>

							<div class="input-group">
							  <div class="input-group-addon">
								<i class="fa fa-sticky-note-o"></i>
							  </div>
							  <input class="form-control " name="pangkat" id="pangkat" required value="<?php echo $staf->pangkat?>">
							</div>
							<!-- /.input group -->
						  </div>
						
						
			
						<div class="form-group">						
							<label>GOLONGAN</label>

							<div class="input-group">
							  <div class="input-group-addon">
								<i class="fa fa-sticky-note-o"></i>
							  </div>
							  <input class="form-control " name="golongan" id="golongan" required value="<?php echo $staf->golongan?>">
							  
							</div>
							<small>Contoh: I,II,III,IV</small>
							<!-- /.input group -->
						  </div>
						
						
			
						<div class="form-group">						
							<label>NPWP</label>

							<div class="input-group">
							  <div class="input-group-addon">
								<i class="fa fa-sticky-note-o"></i>
							  </div>
							  <input class="form-control " name="npwp" id="npwp" required value="<?php echo $staf->npwp?>">
							</div>
							<!-- /.input group -->
						  </div>
						
						
			
			
						
						
						<div class="form-group">						
							<label>JABATAN</label>

							<div class="input-group">
							  <div class="input-group-addon">
								<i class="fa fa-sticky-note-o"></i>
							  </div>
							  <input class="form-control " name="JABATAN" id="JABATAN" required value="<?php echo $staf->JABATAN?>">
							</div>
							<!-- /.input group -->
						  </div>
						  
						  
						<div class="form-group">						
							<label>BENDAHARA</label>

							<div class="input-group">
							  <div class="input-group-addon">
								<i class="fa fa-sticky-note-o"></i>
							  </div>
							  <input type="checkbox" name="bendahara" value="1" > Bendahara
							</div>
							<small>Tandai jika bendahara</small>
							<!-- /.input group -->
						  </div>
						  
						  <br>
						
						
						<div class="col-sm-6">
							<input type="submit" class="btn btn-danger btn-block btn-sm" value="Simpan">
						</div>
						<div class="col-sm-6">
							<input type="submit" onclick="batal_edit()" class="btn btn-primary btn-block btn-sm" value="Batal">
						</div>
			
			</form>
		</div>
	</section>

<script>
function batal_edit()
{
	if(confirm("Anda yakin batal mengubah?"))
	{
		eksekusi_controller("index.php/absensi/data_staf_info");
	}
}




$("#go_edit_staf").on("submit",function(){
	
	
		if(confirm("Anda yakin merubah data ini?"))
		{
			//alert($(this).serialize());
			var datanya = $(this).serialize();
			$.post("<?php echo base_url()?>index.php/absensi/go_simpan_staf",datanya,function(e){
				
				eksekusi_controller("index.php/absensi/data_staf_info");
				//alert(e);
				
			});
			
		}
		
	
	return false;
})
</script>