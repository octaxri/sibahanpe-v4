<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Form Kehadiran ASN
        
      </h1>     
    </section>

    <!-- Main content -->
    <section class="content">
      
	  
	   <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">NIK</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>            
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
			<form id="go_absen">
			
			
			
			
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
						<option value="2019">2019</option>
                    	<option value="2020">2020</option>
					</select>
				</div>
            
				<div class="col-sm-6">
					<input type="text" class="form-control" id="NIK" required placeholder="NIK" value="<?php echo $this->session->userdata('NIK');?>" >
				</div>
			   <span class="input-group-btn">
					<button class="btn btn-default" type="submit">Go!</button>
                   
                   <button class="btn btn-primary" type="button" id="excel">Excel!</button>
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
	 

	$("#go_absen").submit(function(){
		var nik 	= $("#NIK").val();
		var bulan 	= $("#bulan").val();
    	var tahun 	= $("#tahun").val();
    
		$(".content-wrapper").html("<br><br><center><div class='alert alert-warning' style='padding:5px;width:50%'><b>Loading!!!</b> Mohon menunggu...</div></center>");
		Pace.restart();

		$.post("<?php echo base_url()?>index.php/absensi/absen_by_nik_perorang/",{nik:nik,bulan:bulan,tahun:tahun},function(e){
			//alert(e);
			$(".content-wrapper").html(e);
		});
		
		return false;
		
	})
	
    
    
    $("#excel").on("click",function(){
        var nik 	= $("#NIK").val();
		var bulan 	= $("#bulan").val();
		var tahun 	= $("#tahun").val();
        window.open("<?php echo base_url()?>index.php/absensi/absen_by_nik_perorang_excel/?nik="+nik+"&bulan="+bulan+"&tahun="+tahun);
    })
    
	
</script>