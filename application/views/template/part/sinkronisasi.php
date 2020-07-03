
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Master
        <small>Sinkronisasi Ekinerja</small>
      </h1>     
    </section>

    <!-- Main content -->
    <section class="content">
      
	  
	   <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">STAF</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>            
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
				<div class="table-responsive">
				<table id="tbl_sync" class="table table-bordered">
				<thead>
					<tr>
						<th>No.</th>
						<th>FID</th>
						<th>NAMA</th>												
						<th>TPP EKINERJA</th>						
						<th>TPP ABSENSI</th>						
						<th>BULAN</th>						
						<th>Tgl Sinkron</th>												
						<th>ACTION</th>
					</tr>
				</thead>
				
				<tbody>
					<?php
						$no=0;
						foreach($staf as $data)	
						{
						$hasil = @$this->m_laporan->m_hasil_akhir($data->NIK)[0];
						$ekin = @$hasil->dapat_ekin<=0?0:@$hasil->dapat_ekin;
						$absen = @$hasil->dapat_absen<=0?0:@$hasil->dapat_absen;
						$no++;
						echo "
								<tr>
									<td>$no</td>
									<td>$data->FID</td>
									<td>$data->Nama <br> $data->NIK <br> $data->pangkat /$data->golongan</td>
									<td>".rupiah(@$ekin)."</td>
									<td>".rupiah(@$absen)."</td>
									<td>".@$hasil->bulan."-".@$hasil->tahun."</td>
									<td>".@$hasil->tgl_update."</td>
									<td><button class='btn btn-xs btn-block btn-danger' onclick='sync_ekin(\"$data->NIK\")'>Sync</button></td>								
									
								</tr>
							";
								
								
						
						}
						
					?>
				</tbody>
				
			</table>
		</div>

		<button class="btn btn-lg btn-warning" onclick="sync_ekin_all()">Sinkron Kolektif! <small>Munkin akan memakan waktu.</small></button>

		</div>
	</section>




<!-- Modal -->
<div id="myModalDetail" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sinkronisasi ke Ekinerja</h4>
      </div>
      <div class="modal-body" id="modalIsi">
      	  <form id="form_sync">
      	  		<input id="nip_sync" class="form-control" placeholder="NIP" name="nip">
      	  		<br>
  	  		
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
      	  		<br>
      	  		<input type="text" name="tahun" class="form-control" value="<?php echo date('Y')?>">
      	  		<br>
      	  		<div id="t4_info"></div>
      	  		<button type="submit" class="btn btn-primary " id="btn_go">Tarik data Ekinerja</button>
      	  </form>
          <div style="clear: both;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




<!-- Modal -->
<div id="myModalAll" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sinkronisasi ke Ekinerja Keseluruhan</h4>
      </div>
      <div class="modal-body" id="modalIsi">
      	  <form id="form_sync_all">
      	  		
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
      	  		<br>
      	  		<input type="text" name="tahun" class="form-control" value="<?php echo date('Y')?>">
      	  		<br>
      	  		<div id="t4_info_all"></div>
      	  		<button type="submit" class="btn btn-warning " id="btn_go_all">Tarik data Ekinerja</button>
      	  </form>
          <div style="clear: both;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script>
	$("#tbl_sync").dataTable({pageLength:100});
	function form_edit_staf(fid)
	{
		eksekusi_controller("index.php/absensi/form_edit_staf/"+fid);
	}

	function sync_ekin(nik)
	{

		$("#nip_sync").val(nik)
		$("#myModalDetail").modal('show');
	}

	function sync_ekin_all()
	{
		$("#myModalAll").modal('show');
	}

	$("#form_sync").on("submit",function(){
			$("#t4_info").html("<div class='alert alert-info' style='padding:5px'>Loading mohon tunggu, sedang menarik data Ekinerja...</div>");
			$("#btn_go").fadeOut();
			var link = "<?php echo base_url()?>index.php/laporan/go_sinkron?"+$(this).serialize();
			$.get("<?php echo base_url()?>index.php/laporan/go_sinkron",$(this).serialize(),function(e){
				console.log(link);
				console.log(e);
				$("#t4_info").html("<div class='alert alert-success'>Data berhasil ditarik.</div>");
			})
		return false;
	})


	$("#form_sync_all").on("submit",function(){
			$("#t4_info_all").html("<div class='alert alert-warning' style='padding:5px'>Loading mohon tunggu, sedang menarik data Ekinerja, mungkin ini akan memakan waktu beberapa saat...</div>");			
			$("#t4_info_all").append("<center><img src='<?php echo base_url()?>assets/loading.gif'></center>");
			$("#btn_go_all").fadeOut();
			$.get("<?php echo base_url()?>index.php/laporan/go_sinkron_all",$(this).serialize(),function(e){
				console.log(e);
				console.log("<?php echo base_url()?>index.php/laporan/go_sinkron_all"+$(this).serialize());
				$("#t4_info_all").html("<div class='alert alert-success'>Data berhasil ditarik.</div>");
			})
		return false;
	})




	$("#myModalDetail").on("hidden.bs.modal", function () {
	  eksekusi_controller('index.php/laporan/sinkronisasi');
	});

	$("#myModalAll").on("hidden.bs.modal", function () {
	  eksekusi_controller('index.php/laporan/sinkronisasi');
	});

</script>