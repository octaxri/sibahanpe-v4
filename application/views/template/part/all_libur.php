

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Master 
        <small>Libur</small>
      </h1>     
    </section>

    <!-- Main content -->
    <section class="content">
      
	  
	   <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">LIBUR</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>            
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
		
				<button onclick="eksekusi_controller('absensi/form_libur')" class="btn btn-primary">Tambah Libur</button>
		
				<table id="tbl_absen" class="table table-bordered">
				<thead>
					<tr>
						<th>No.</th>
						<th>Tanggal</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				
				<tbody>
					<?php
						$no=0;
						foreach($libur as $lib)	
						{
							$no++;
						echo "
								<tr>
									<td>$no</td>
									<td>$lib->tgl_libur</td>
									<td>$lib->desc_libur</td>
									
									
								</tr>
							";
								
								
						
						}
						
					?>
				</tbody>
				
			</table>
		</div>
	</section>
			