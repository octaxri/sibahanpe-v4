
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
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">STAF</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>            
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
		
				<table id="tbl_libur" class="table table-bordered">
				<thead>
					<tr>
						<th>No.</th>
						<th>FID</th>
						<th>NAMA</th>
						<th>NIP</th>
						<th>PANGKAT/GOL.</th>
						<th>NPWP</th>
						<th>JABATAN</th>
						
						<th>ACTION</th>
					</tr>
				</thead>
				
				<tbody>
					<?php
						$no=0;
						foreach($staf as $data)	
						{
							$no++;
						echo "
								<tr>
									<td>$no</td>
									<td>$data->FID</td>
									<td>$data->Nama</td>
									<td>$data->NIK</td>
									<td>$data->pangkat /$data->golongan</td>
									<td>$data->npwp</td>
									<td>$data->JABATAN</td>
								
									<td><button class='btn btn-xs btn-block btn-danger' onclick='form_edit_staf(\"$data->FID\")'>EDIT</button></td>								
									
								</tr>
							";
								
								
						
						}
						
					?>
				</tbody>
				
			</table>
		</div>
	</section>
<script>
	$("#tbl_libur").dataTable();
	function form_edit_staf(fid)
	{
		eksekusi_controller("index.php/absensi/form_edit_staf/"+fid);
	}
</script>