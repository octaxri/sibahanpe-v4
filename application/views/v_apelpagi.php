
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <strong>Tambah Admin Apel Pagi</strong>
      </h1>     
    </section>

    <!-- Main content -->
    <section class="content">
      
	  
	   <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        
        <!-- /.box-header -->
        <div class="box-body">
		
					
<form action="simpan_apel" method="post" id="simpan_apel">
			<div class="row">
				
				<div class="col-md-4">
					<label>NIP</label>
				</div>
				<div class="col-md-6">
					<input type="number" name="NIP" required="" class="form-control" maxlength="17" placeholder="NIP">
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
$("#simpan_apel").on("submit",function(){
          $.post("<?php echo base_url()?>index.php/apel_pagi/simpan_apel",$(this).serialize(),function(){
          
          	eksekusi_controller("index.php/apel_pagi/tampil_apel");
          
          })

	return false;
 })
</script>
