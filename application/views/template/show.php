<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <META HTTP-EQUIV="refresh" CONTENT="12">
  <title>e-AGENDA</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">-->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/iCheck/square/blue.css">
  
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/pace/pace.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
</head>
<body class="hold-transition login-page">

<div class="alert alert-info" style="height:100%">
<div class="col-xs-3">
	<img src="<?php echo base_url()?>assets/img/logopakpak.png" height="150px">
</div>
<div class="col-xs-9">
	<h1>e-AGENDA KAB.PAKPAK BHARAT</h1>
</div>
<div style="clear:both"></div>

<div style="font-size:20px" class="alert alert-danger" id="clock"></div>
<div style="font-size:20px" class="alert alert-warning" id="clock2"></div>

<table class="table table-bordered">
	<thead>
		<th>No.</th>
		<th>Kegiatan</th>
		<th>Mulai</th>
		<th>Selesai</th>
		<th>Tempat</th>
		<th>Pelaksana</th>
		<th>Pejabat</th>
		<th>Peserta</th>
		<th>Status</th>
	</thead>
	<tbody>
		
		<?php 
		$no=0;
		foreach($v_jadwal_approved as $z)
		{
		$no++;
		$status = $z->status=='booking'?"<font color=green>$z->status</font>":"<font color=blue>$z->status</font>";
		echo "
		<tr>
			<td>$no</td>
			<td>$z->kegiatan</td>
			<td>$z->tanggal_kegiatan_mulai</td>
			<td>$z->tanggal_kegiatan_selesai</td>
			<td>$z->tempat_kegiatan</td>
			<td>$z->nama_skpd</td>
			<td>$z->nama_pejabat</td>
			<td>$z->peserta</td>
			<td style='text-transform: uppercase;'><b>$status</b></td>
		</tr>
		";
		}
		?>
	</tbody>
</table>
</div>
<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url()?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url()?>assets/plugins/iCheck/icheck.min.js"></script>

<!-- PACE -->
<script src="<?php echo base_url()?>assets/plugins/pace/pace.min.js"></script>





<!-- custom script sam-->
<script>
 var url = '<?php echo base_url()?>';
</script>
<script src="<?php echo base_url()?>assets/custom.js"></script>
<script src="<?php echo base_url()?>assets/count_down/countdown.js"></script>
<!-- custom script sam-->
<script>
$('#clock').countdown('<?php echo $terdekat[0]->tanggal_kegiatan_mulai;?>', function(event) {
  $(this).html(event.strftime('%D hari %H jam, %M menit %S detik lagi, <br>kegiatan : <u><b><?php echo $terdekat[0]->kegiatan?></b></u> <br> oleh : <?php echo $terdekat[0]->nama_skpd?>'));
});

$('#clock2').countdown('<?php echo $terdekat[1]->tanggal_kegiatan_mulai;?>', function(event) {
  $(this).html(event.strftime('%D hari %H jam, %M menit %S detik lagi, <br>kegiatan : <u><b><?php echo $terdekat[1]->kegiatan?></b></u> <br> oleh : <?php echo $terdekat[1]->nama_skpd?>'));
});

</script>









<!------------fullscreen-------------------------->
<script type="text/javascript">
    window.onload = maxWindow;

    function maxWindow() {
        window.moveTo(0, 0);


        if (document.all) {
            top.window.resizeTo(screen.availWidth, screen.availHeight);
        }

        else if (document.layers || document.getElementById) {
            if (top.window.outerHeight < screen.availHeight || top.window.outerWidth < screen.availWidth) {
                top.window.outerHeight = screen.availHeight;
                top.window.outerWidth = screen.availWidth;
            }
        }
    }

</script> 
</body>
</html>
