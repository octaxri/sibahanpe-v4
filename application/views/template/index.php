<?php
include("part/head.php");
?>




<body class="hold-transition skin-blue-light sidebar-mini">
<div class="wrapper">

<?php
include("part/menu_atas.php");
include("part/menu_kiri.php");
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Selamat datang di Aplikasi
        <small>Sistem Informasi Tambahan Penghasilan Pegawai (SIBAHANPE) Kabupaten Pakpak Bharat</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		
    <div id="info_telat"></div>
		<br>

   
      <div class="row">
        <div class="col-sm-4">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $this->session->userdata('NAMA')?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                <li class="item">
                  Info Login anda: <br>
                   <?php 
                      echo info_login();
                    ?>
                </li>
                <!-- /.item -->
                <li class="item">
                  <?php echo $this->session->userdata('NIK')?>
                </li>
                <!-- /.item -->
                <li class="item">
                  <?php echo $this->session->userdata('FID')?>
                </li>
                <!-- /.item -->
                <li class="item">
                  <?php echo $this->session->userdata('OPD')?>
                </li>
                <!-- /.item -->
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              
            </div>
            <!-- /.box-footer -->
          </div>
        </div>

        <div class="col-sm-4">
        <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $this->session->userdata('NAMA')?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <img src="<?php echo $gambar?>" class="img img-responsive">
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              
            </div>
            <!-- /.box-footer -->
          </div>
        </div>


        <div class="col-sm-4">
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Perkiraan TPP Anda</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="t4_perkiraan_tpp"></div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <div id="info_sinkron"></div>
              <button class="btn btn-info btn-block" onclick="sinkron_ekinnya($(this))"><span class="glyphicon glyphicon-refresh"></span> Sinkon Ekinerja</button>
            </div>
            <!-- /.box-footer -->
          </div>
        </div>



        

      </div>
	  



	   <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Kehadiran Aktual</h3>
            
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>            
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            
          <?php 

          $d_libur = array();
      foreach($tgl_libur as $lib)
      {     
        $d_libur[]  = $lib->tgl_libur; 
      }
      
      
      $d_sakit = array();
      foreach($tgl_sakit as $sak)
      {     
        $d_sakit[]  = $sak->tanggal; 
      }
      
      
      $d_dinas = array();
      foreach($tgl_dinas as $din)
      {     
        $d_dinas[]  = $din->tanggal; 
      }
      
      
      
      $d_cutsak = array();
      foreach($tgl_cut_sak as $cutsak)
      {     
        $d_cutsak[]   = $cutsak->tanggal; 
      }
      
      
      $d_cutlain = array();
      foreach($tgl_cut_la as $cutlain)
      {     
        $d_cutlain[]  = $cutlain->tanggal; 
      }
      
      
      
      $d_ijin_la = array();
      foreach($tbl_surat_ijin_keterangan as $ijin_la)
      {     
        $d_ijin_la[]  = $ijin_la->tanggal; 
      }
      
      
      $d_cuttah = array();
      foreach($tgl_cut_tah as $cuttah)
      {     
        $d_cuttah[]   = $cuttah->tanggal; 
      }
      
      
      
      
      //var_dump($d_sakit);
      
      //$b = '2017-09-05';
      
      //var_dump($v);
      //echo $x[0]['tgl_libur'];
      
      
      ?>
      <div class="table-responsive">
      <table id="tbl_absen" class="table ">
        <thead>
          <tr>
            <th>No.</th>
            <th>NAMA</th>
            <th>NIP</th>
            <th>TANGGAL</th>
            <th>MASUK</th>
            <th>KELUAR</th>
            <th>TERLAMBAT MASUK</th>
            <th>CEPAT PULANG</th>           
            <th>TERLAMBAT</th>            
            <th>POTONGAN</th> 
            <th>PERBUB 2019</th>
          </tr>
        </thead>
        
        <tbody>
          <?php
            $no=0;
            $i=0;
            $total_pot      = 0;
  
            $total_absen    = 0;
            $total_hadir    = 0;
            $tot_telat_masuk  = 0;            
            $tot_dinas_luar   = 0;
            $tot_cutsak     = 0;
            $tot_ijin_ket   = 0;

            $tot_d_cutlain = 0;
                    
                    $arr_hukuman=array();
            
            
              foreach($hasil as $data)
              {
                
              $no++;
              $total_telat = $data->telat_masuk+$data->cepat_pulang;
              
              $jam_masuk = $data->jam_masuk==null?"<font color=red>-</font>":$data->jam_masuk;
              $jam_keluar = $data->jam_keluar==null?"<font color=red>-</font>":$data->jam_keluar;
              
              $cepat_pulang = $data->cepat_pulang;
              $telat_masuk = $data->telat_masuk;
              
              
              $tanggal_get = $data->tanggal;
              
              $note = "";
              $style  = "";
              $potongan ="0%";
                                
                            $info_baru ="";
                            
              
              //cek cuti tahunan 
              if (in_array($tanggal_get, $d_cuttah)) 
              {
                $potongan ="0%";
                $note   ="keterangan";
                $style    = " class='ijin_lain' ";
                $tot_ijin_ket++;
              
              
              //cek surat ijin lainnya 
              }else 
              //cek surat ijin lainnya 
              if (in_array($tanggal_get, $d_ijin_la)) 
              {
                /********** ijin hanya sebelah masuk atau pulang **************/
                $yyy = $this->db->query("SELECT masuk_pulang FROM tbl_surat_ijin_keterangan WHERE NIK='$data->Nik' AND status='approve' AND tanggal='$tanggal_get'");
                foreach ($yyy->result() as $o) {
                
                  $note   ="keterangan";
                  $style    = " class='ijin_lain' ";
                                    
                                    $x=0;
                                    $y=0;
                  if($o->masuk_pulang=='masuk')
                  {
                    $telat_masuk='0%';

                    if($cepat_pulang>0 && $cepat_pulang<=30)
                    {
                      $y="0.5%";                  
                      
                    }else if($cepat_pulang >30 && $cepat_pulang<=60)
                    {
                      $y="1%";
                      
                    }else if($cepat_pulang >60 && $cepat_pulang<=90)
                    {
                      $y="1.25%";
                    
                    }else if($cepat_pulang >90)
                    {
                      $y="1.5%";
                    }
                    $potongan =$y;
                  }else{
                    $cepat_pulang='0%';
                    if($telat_masuk>0 && $telat_masuk<=30)
                    {
                      $x="0.5%";                  
                      
                    }else if($telat_masuk >30 && $telat_masuk<=60)
                    {
                      $x="1%";
                              
                    }else if($telat_masuk >60 && $telat_masuk<=90)
                    {
                      $x="1.25%";
                                    
                    }else if($telat_masuk >90)
                    {
                      $x="1.5%";
                    }
                    $potongan =$x;
                  }
                                    
                  $potongan=$x+$y;
                }
                                /********** ijin hanya sebelah masuk atau pulang **************/


                //$tot_ijin_ket++;
              
              //cek database cuti lain 2%
              }else if (in_array($tanggal_get, $d_cutlain)) 
              {
                
                //jika lebih dari 5 maka potongan 2 %
                //jika tidak maka potongan 0%
                
                              
                $note   ="cuti alasan penting";
                $style    = " class='warning' ";
                $tot_d_cutlain++;
                            
                              if((count($d_cutlain)<=5) )
                                {
                                  
                  $potongan ="0%";  
                                }else if((count($d_cutlain)>5))
                                {
                                  if($tot_d_cutlain > 5)
                                    {
                                      $potongan ="2%";  
                                    }
                                }
                                
                                $info_baru ="2% dari Ekinerja";
                                
                
              
              //cek database cuti sakit 0%              
              }else if (in_array($tanggal_get, $d_cutsak))
              {
                
                $note   ="sakit";
                $style    = " class='warning' ";
                $tot_cutsak++;
                            
                              
                              if((count($d_cutsak)<=3) )
                                {
                                  
                  $potongan ="0%";  
                                }else if((count($d_cutsak)>3))
                                {
                                  if($tot_cutsak > 3)
                                    {
                                      $potongan ="2%";  
                                    }
                                }
                                
                                $info_baru ="1% dari Ekinerja";
                                
                            
                /************* INGAT ********cek sakit adalah ket.sah *******************/
              }else if (in_array($tanggal_get, $d_sakit)) 
              {
                
                
                //$total_absen++;
                
                              //$note   ="sakit";
                //$style    = " class='warning' ";
                
                              /*
                              if((count($d_sakit)<=3) )
                                {
                                  
                  $potongan ="0%";  
                                }else if((count($d_sakit)>3))
                                {
                                  if($tot_cutsak > 3)
                                    {
                                      $potongan ="2%";  
                                    }
                                }
                                */


                                /*
                
                                $note   ="sakit";
                $style    = " class='warning' ";
                $tot_cutsak++;
                            
                              
                              if((count($d_sakit)<=3) )
                                {
                                  
                  $potongan ="0%";  
                                }else if((count($d_sakit)>3))
                                {
                                  if($tot_cutsak > 3)
                                    {
                                      $potongan ="2%";  
                                    }
                                }
                              */

                              $tot_ijin_ket++;
                              $potongan ="2%";  
                                
                                $note   ="sakit";
                $style    = " class='warning' ";
                $tot_cutsak++;
                                $info_baru ="1% dari Ekinerja";
                                
                //cek dinas luar
              }else if (in_array($tanggal_get, $d_dinas)) 
              {
                $potongan ="0%";
                $note   ="dinas";
                $style    = " class='info' ";               
                $tot_dinas_luar++;
                
                //cek database libur
              }else if (in_array($tanggal_get, $d_libur)) 
              {
                $potongan ="0%";
                $note   ="libur";
                $style    = " class='info' ";
                
              }else if($data->jam_masuk==null && $data->jam_keluar==null)
              {
                
                //tanpa alasan
                
                $potongan = "0%";
                
                $style    = " class='danger' ";
                
                $total_absen++;
                                
                                $info_baru = "4% dari TPP";
                
                
              
              }else if($data->jam_masuk==null && $data->jam_keluar!=null)
              {
                                
                $potongan = "1.5%";
                $style    = " class='warning' ";
                $total_hadir++;
                
                $total_telat+=91;
                $telat_masuk+=91;
                
                //nb:tidak absen pulang dianggap lebih dari 60menit
              
              }else if($data->jam_masuk!=null && $data->jam_keluar==null)
              {
                                
                $potongan = "1.5%";
                $style    = " class='warning' ";
                $total_hadir++;               
                $total_telat+=91;
                $cepat_pulang +=91;
                //nb:tidak absen masuk dianggap lebih dari 60menit
              
              }else if($total_telat >0 && $total_telat <=30)
              {
                $potongan="0.5%";
                $style    = " class='warning' ";
                $total_hadir++;
                
                
              }else if($total_telat >30 && $total_telat <61 )
              {
                $potongan="1%";
                $style    = " class='warning' ";
                $total_hadir++;
              
              }else if($total_telat >60 && $total_telat <91 )
              {
                $potongan="1.25%";
                $style    = " class='warning' ";
                $total_hadir++;
              
              }else if($total_telat >90)
              {
                $potongan="1.5%";
                $style    = " class='warning' ";
                $total_hadir++;
              
              }else{
                $potongan="0%";
                $style    = " class='' ";
                $total_hadir++;
              
              }
              
                            
                            

              /***************** solusi untuk persen dijumlahkan *****************/
              if($telat_masuk>0 && $cepat_pulang>0)
              {
                $x =0;
                $y =0;

                
                
                if($telat_masuk>0 && $telat_masuk<=30)
                {
                  $x="0.5%";                  
                  
                }else if($telat_masuk >30 && $telat_masuk<=60)
                {
                  $x="1%";
                  
                }else if($telat_masuk >60)
                {
                  $x="1.5%";
                }

                if($cepat_pulang>0 && $cepat_pulang<=30)
                {
                  $y="0.5%";                  
                  
                }else if($cepat_pulang >30 && $cepat_pulang<=60)
                {
                  $y="1%";

                }else if($cepat_pulang >60 && $cepat_pulang<=61)
                {
                  $y="1.25%";
                  
                }else if($cepat_pulang >90)
                {
                  $y="1.5%";
                }
                $potongan = $x+$y;
                $potongan = $potongan."%";
              
              }
              /***************** solusi untuk persen dijumlahkan *****************/
                            
                            /******penyelesaian masalah*****/
                            $hukumannya = $this->m_absensi->m_hukuman($nik,$tanggal_get);
                            
                            if(count($hukumannya)>0)
                            {
                              $potongan=$hukumannya[0]->hukuman."%";
                $style    = " class='hukuman'";
                              
                              $arr_hukuman[] = $hukumannya[0];
                            }
                            
                            /******penyelesaian masalah*****/
                            
                            
              
              $total_pot+=$potongan;
              
              
              $tot_telat_masuk+=$total_telat;
              
              
              echo "
                <tr $style>
                  <td>$no</td>
                  <td>$data->Nama</td>
                  <td>$nik</td>
                  <td>".tglindo($tanggal_get)."</td>
                  <td>$jam_masuk</td>
                  <td>$jam_keluar</td>
                  <td>".floor($telat_masuk)."</td>
                  <td>".floor($cepat_pulang)."</td>
                  <td>$total_telat</td>
                  <td align='right'>$potongan</td>
                  <td align='right'>$info_baru</td>
                                    
                </tr>
              ";
                
                
              }
              
              $i++;
            
            
          $info_potongan="";
          if($total_absen >= 5)
          {
            $total_pot=100;
            $info_potongan= "<div class='alert alert-info text-center'>PERBUP: Jika tidak hadir lebih besar dari 4 hari <b>( >=5 )</b>, Potongan 100%.</div>";
            
          }
          ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="9"><center><b>Total</b></center></td>
            <td align='right'><b><?php echo $total_pot?> %</b></td>         
          </tr>
        </tfoot>
      
      </table>
    </div>
        </div>
		
        <!-- /.box-body -->
        <div class="box-footer">
          ------
        </div>
		
      </div>
      <!-- /.box -->
	  
	  
	  
	  
	</section>
	
	
	
    
	<section class="content">
	
	
	   <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">NB</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>            
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
			
			
			<pre>
			NB: 
      <img src="https://sibahanpe.pakpakbharatkab.go.id/v4/perbub_2020.jpeg">
			
            
            -----------------------PERUBAHAN PADA PERBUP TPP 2019---------------------
            1. Tidak hadir tanpa keterangan 4 % dari total TPP setiap harinya
            2. Cuti Sakit/sakit 1% dari komponen capaian kinerja setiap harinya
            3. Cuti alasan penting 2% dari kompenen capaian kinerja setiap harinya 
            4. Hilangkan menu Ijin Ket. Sah pada dashboard sibahanpe
			</pre>
		</div>
	
	</section>
    
	
 </div>
<?php
require_once("part/footer.php"); 
?>




<script type="text/javascript">
function sinkron_ekinnya(ini)
{
  var url = "<?php echo base_url()?>index.php/getbynik/go_sinkron?nip=<?php echo($this->session->userdata('NIK'))?>&bulan=<?php echo(date('m'))?>&tahun=<?php echo(date('Y'))?>";
  console.log(url);
  ini.html("Loading...");
  ini.attr("disabled", true);
  $.ajax({
      url: url,
      async:true,
      crossDomain:true, 
      error: function(e){
          console.log(e);
      },
      success: function(){
          info_tpp();
          $("#info_sinkron").html("<div class='alert alert-success' style='padding:5px'><span class='glyphicon glyphicon-ok'> </span> Sukses!!</div>");    
          ini.hide();
          info_tpp();
      },
      timeout: 100000 // sets timeout to 3 seconds
  });
  
}

info_tpp();
function info_tpp()
{
   $.get("<?php echo base_url()?>index.php/getbynik/api_absen_by_nik?nik=<?php echo($this->session->userdata('NIK'))?>&bulan=<?php echo date('m')?>&tahun=<?php echo(date('Y'))?>",function(x){

    console.log("<?php echo base_url()?>index.php/getbynik/api_absen_by_nik?nik=<?php echo($this->session->userdata('NIK'))?>&bulan=<?php echo date('m')?>&tahun=<?php echo(date('Y'))?>");

    var htm = '<ul class="products-list product-list-in-box">'+
                '<li class="item"><a>Pokok </a> <span class="label label-primary pull-right">Rp.'+x[0].pokok+'</span> </li>'+
                '<li class="item"><a>Ekinerja </a> <span class="label label-info pull-right">Rp.'+x[0].ekinerja+'</span></li>'+
                '<li class="item"><a>Total </a> <span class="label label-success pull-right">Rp.'+x[0].total+'</span></li>'+
                
              '</ul>';
    $("#t4_perkiraan_tpp").html(htm);

    var hari_ini = x[0].kehadiran;
    var tgl = "<?php echo date('d-m-Y')?>";
    //var tgl = "09-04-2020";
    console.log("hari_ini:");
    console.log(hari_ini);
    var ada = "";
    var tidak_absen ="";
    $.each(hari_ini,function(a,b){
      console.log(b.total_telat + b.tgl)
      if(b.tgl==tgl)
      {        
        ada = b.total_telat;
        if(b.masuk==null && b.pulang==null)
        {
            tidak_absen="benar";
        }
      }

      

    })

    console.log("tidak_absen="+tidak_absen);
    console.log("ada="+ada);

    if(ada=="0" && tidak_absen=="")
    {
      var info_telat = '<div style="padding: 20px 30px;  z-index: 999999; font-size: 16px; font-weight: 600; color:#fff" class="alert alert-success">Hello <?php echo $this->session->userdata('NAMA')?>... Selamat,  Kamu tidak telat hari ini. </div>';
    }else if(ada==""){
      var info_telat = '<div style="padding: 20px 30px;  z-index: 999999; font-size: 16px; font-weight: 600; color:#fff" class="alert alert-danger">Hello <?php echo $this->session->userdata('NAMA')?>... Sepertinya hari ini Kamu belum absensi... </div>';
    }else if(ada=="0" && tidak_absen=="benar"){
      var info_telat = '<div style="padding: 20px 30px;  z-index: 999999; font-size: 16px; font-weight: 600; color:#fff" class="alert alert-danger">Hello <?php echo $this->session->userdata('NAMA')?>... Sepertinya hari ini Kamu belum absensi... </div>';

    }else{
      var info_telat = '<div style="padding: 20px 30px;  z-index: 999999; font-size: 16px; font-weight: 600; color:#fff" class="alert alert-warning">Hello <?php echo $this->session->userdata('NAMA')?>...  Kamu sepertinya telat '+ada+' menit hari ini... </div>';
    }

    $("#info_telat").html(info_telat);
  })
}

 
</script>