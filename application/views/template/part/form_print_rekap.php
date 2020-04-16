<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Form Rekapitulasi ASN
        
      </h1>     
    </section>

    <!-- Main content -->
    <section class="content">
      
	  
	   <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Pilih bulan dan NIP</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>            
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
			<form id="go_absen" action="<?php echo base_url()?>index.php/absensi/print_absen_by_nik/" method="get" target="_blank">
			
			
			<div class="col-sm-12">
			<div class="input-group">
				
            <div class="col-sm-3">
					<select name="bulan" class="form-control" id="bulan" required>
						<option value=""> --- pilih bulan --- </option>
						<option value="1">Januari</option>
						<option value="2">Feburari</option>
						<option value="3">Maret</option>
						<option value="4">April</option>
						<option value="5">Mei</option>
						<option value="6">Juni</option>
						<option value="7">Juli</option>
						<option value="8">Agustus</option>
						<option value="9">September</option>
						<option value="10">Oktober</option>
						<option value="11">November</option>
						<option value="12">Desember</option>
					</select>
				</div>
            
            	<div class="col-sm-3">
					<select name="tahun" class="form-control" id="tahun" required>
						<option value=""> --- pilih tahun --- </option>
						<!--
                        <option value="2017">2017</option>
                    	<option value="2018">2018</option>
                    	<option value="2019">2019</option>
                        -->
                        <option value="<?php echo date('Y')-1?>"><?php echo date('Y')-1?></option>
                    	<option value="<?php echo date('Y')?>"><?php echo date('Y')?></option>
                        
					</select>
				</div>
            
            
				<div class="col-sm-6">
					<input type="text" class="form-control" id="NIK" required placeholder="NIP" name="nik">
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
