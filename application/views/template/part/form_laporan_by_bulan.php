<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         From download rekapitulasi
        
      </h1>     
    </section>

	
    <section class="content">
	
    <div class="alert alert-warning"><b>Perhatian!!!</b> Download Rekapitulasi hanya diperbolehkan tanggal 1 s/d tanggal 5 </div>

		 <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"> Pilih Bulan</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>            
          </div>
        </div>
		
		<div class="box-body">
				
		<form id="go_absen" action="<?php echo base_url()?>index.php/laporan/rekap_pdf/" method="get" target="_blank">
			
			
			
			
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
						
						<!--
						<?php 
							$bul = date('m')-1;
							if($bul==0)
							{
								$bul=12;
							}
						?>
						
						<option value="<?php echo $bul?>"><?php echo $bul?></option>
						-->
					</select>
				</div>
            
            	<div class="col-sm-3">
					<select name="tahun" class="form-control" id="tahun" required>
						<!--
						<option value=""> --- pilih tahun --- </option>
						<option value="2017">2017</option>
                    	<option value="2018">2018</option>
                    	-->
                    	<option value="<?php echo date('Y')-1?>"><?php echo date('Y')-1?></option>
                    	<option value="<?php echo date('Y')?>"><?php echo date('Y')?></option>
					</select>
				</div>
				<span class="input-group-btn">
				<?php 

				$a = strtotime(date('Y-m-')."1");
				$b = strtotime(date('Y-m-')."5");
				$c = strtotime(date('Y-m-d'));

				if (in_array($this->session->userdata('ID_OPD'), $buka)) 
				{
					echo '
							<button class="btn btn-primary" type="submit">Download! <> </button>
					     ';
				}else{

					if($c>=$a && $c<=$b)
					{
						echo '
									<button class="btn btn-default" type="submit">Download!</button>
							   ';
					}else{
						echo '<button class="btn btn-default disabled" type="button">Sudah Tutup</button>';
					}


				}


				?>
				</span>
			     <button class="btn btn-primary" type="button" id="excel">Excel!</button>
			</div>
			</div>
			</form>
		
        
        
        <div style="clear:both"></div>
        <hr>
        
         <h4>HISTORY</h4>
       
        
<script>            	            
$.getJSON( "<?php echo base_url()?>downloads/list_by_opd.php?opd=<?php echo $this->session->userdata('OPD')?>", function( data ) {
  var no = 0;
  $.each( data, function( key, val ) {
  no++;  
  console.log(val.tgl_cetak);
  var a = "<tr><td>"+no+"</td><td>"+val.opd+"</td><td>"+val.bulan+"-"+val.tahun+"</td><td>"+val.tgl_cetak+"</td><td><a href='downloads/"+val.file+"' target='blank'>Download</a></td></tr>";
  	  $("#tbl_history").prepend(a);
  });
}).complete(function() { 

$("#tbl_history").dataTable({"scrollX": true});

});


    $("#excel").on("click",function(){
       
		var bulan 	= $("#bulan").val();
		var tahun 	= $("#tahun").val();
        window.open("<?php echo base_url()?>index.php/laporan/rekap_xl/?bulan="+bulan+"&tahun="+tahun);
    })
    


</script>
        
         <table id="tbl_history" class="table table-bordered">
         	<thead>
            	<th width="20px">No</th>
            	<th>OPD</th>
            	<th>BULAN </th>
            	<th>TANGGAL CETAK</th>
            	<th>FILE</th>
         	</thead>
         	<tbody>
            	
            
         	</tbody>
         </table>
         
		</div>
        <!-- /.box-body -->
        <div class="box-footer">
          ------
		
        </div>
		
      </div>
      <!-- /.box -->
	  
	  
	  
	  
	</section>
	
	
	
	
	