
<html>
<!-- Mirrored from e-tikela.pakpakbharatkab.go.id/index.php/masuk by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Apr 2018 08:14:09 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	
	<title>Sibahanpe</title>
	<link rel="shortcut icon" type="image/x-icon" href="//www.pakpakbharatkab.go.id/favicon.ico" />
	<link href="https://sidahari.pakpakbharatkab.go.id//assets/login/semantic.min.css" rel="stylesheet" type="text/css">
	<link href="https://sidahari.pakpakbharatkab.go.id//assets/login/login.css" rel="stylesheet" type="text/css">
	<script src="https://sidahari.pakpakbharatkab.go.id//assets/login/jquery-2.1.4.min.js" lang="javascript"></script>
	<script src="https://sidahari.pakpakbharatkab.go.id//assets/login/semantic.min.js" lang="javascript"></script>
	<script src="//code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


	<link rel="stylesheet" type="text/css" href="https://sidahari.pakpakbharatkab.go.id/assets/pace/css/flash.css">
	<script type="text/javascript" src="https://sidahari.pakpakbharatkab.go.id/assets/pace/js/pace.js"></script>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/pace/pace.min.css">

</head>
<style type="text/css">
.box_shadow {
	width: 100px;
	height: 100px;
	margin: 100px;
	box-shadow:
	-52px -52px 0px 0px #f65314,
	52px -52px 0px 0px #7cbb00,
	-52px 52px 0px 0px #00a1f1,
	52px 52px 0px 0px #ffbb00;
}
</style>
<body style="background: #bbe2fa">
	<div class="ui page grid">
		<div class="sixteen wide mobile two wide tablet two wide computer column"></div>
		<div class="sixteen wide mobile twelve wide tablet twelve wide computer column">
			<div class="ui segment">
				<div class="ui stackable two column grid">
					<div class="blue center aligned column">
						<h2 class="ui blue inverted center aligned icon header">
							<img src="//www.pakpakbharatkab.go.id/imej/pakpaklogo.png" class="ui image">
							<div class="content">
								SIBAHANPE
								<div class="sub header" style="color: #fff;">
									(Sistem Informasi Tambahan Penghasilan Pegawai)<br>
									<strong>Kab. Pakpak Bharat</strong>
								</div>
							</div>
						</h2>
					</div>
					<div class="column">
						<a class="ui orange right ribbon label">
							<h3>Login User</h3>
						</a>
						<div class="ui basic segment">
							<form action="https://sidahari.pakpakbharatkab.go.id/apps/login/proses" method="POST" id="login_admin" class="ui form">
								<div class="field">
									<label>NIP</label>
									<div class="ui icon input">
										<input type="text" class="form-control" name="NIK" id="NIK" placeholder="NIP">
										
									</div>
								</div>
								<div class="field">
									<label>Password</label>
									<div class="ui icon input">
										<input type="password" name="password" class="form-control" placeholder="Password">
										
									</div>
								</div>
								<div class="inline field">
									<div class="ui checkbox">
										<input type="checkbox" name="remember_me">
										<label>Ingatkan saya</label>
									</div>
								</div>
								<div class="ui one column grid">
									<div class="right aligned column">
										<button type="submit" class="ui blue small icon labeled button">Login</button>
									</div>
                                <!--
								<div class="column">
									<small><a href="http://sso.disdikkota.bandung.go.id/forgot"><i class="question icon"></i>Forgot Password</a></small>
								</div>
							-->
						</div>
						<div class="ui one column grid">
							<div id="info_login"></div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="ui secondary right aligned segment">
		<div align="left">
			<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tentang">Tentang</a> 
			<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#panduan">Panduan</a> 
			<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#faq">FAQ</a> 
			<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#kontak">Kontak</a>
		</div>
		<strong>Sibahanpe v4.0.0 © 2017 - <?php echo date('Y')?> Diskominfo</strong><br><small>Dinas Komunikasi dan Informatika Kab. Pakpak Bharat</small>
	</div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="tentang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tentang Aplikasi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Sibahanpe adalah Sistem Informasi Tambahan Penghasilan Pegawai.
			</div>
			<div class="modal-footer">
				&nbsp;
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="panduan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Panduan Login</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Untuk memulai aplikasi:<br>
			</div>
			<div class="modal-footer">
				&nbsp;
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="kontak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Kontak</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<i class="fa fa-phone"> </i> (0627) 7434047<br>
				<i class="fa fa-envelope"> </i> diskominfo@pakpakbharatkab.go.id<br>
				<i class="fa fa-globe"></i> <a href="http://diskominfo.pakpakbharatkab.go.id/" target="_blank">diskominfo.pakpakbharatkab.go.id</a><br>
				<i class="fa fa-twitter"></i> <a href="https://twitter.com/diskominfo_pb" target="_blank"> twitter/diskominfo_pb</a><br>
				<i class="fa fa-facebook"></i><a href="https://www.facebook.com/diskominfo.pakpakbharat/" target="_blank"> facebook.com/diskominfo.pakpakbharat/</a>
			</div>
			<div class="modal-footer">
				&nbsp;
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="faq" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">FAQ (Frequently Asked Questions)</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
				<!--       =============   Membuat Collapse ========== -->
				<div id="accordion">
					<div class="card">
						<div class="card-header" id="headingOne">
							<h5 class="mb-0">
								<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									Bagaimana jika saya tidak bisa login?
								</button>
							</h5>
						</div>

						<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							<div class="card-body">
								Silahkan menghubungi user pada kontak yang disediakan
							</div>
						</div>
					</div>
					<!--       =============  Akhir Membuat Collapse ========== -->
				</div>
				<div class="modal-footer">
					&nbsp;
				</div>
			</div>
		</div>
	</div>



<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url()?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url()?>assets/plugins/iCheck/icheck.min.js"></script>

<!-- PACE -->
<script src="<?php echo base_url()?>assets/plugins/pace/pace.min.js"></script>


    <script>
$(document).ajaxStart(function() { Pace.restart(); });


 $("#login_admin").on("submit",function(){
	  
	  
	  var NIK = $("#NIK").val();
	  //alert(NIK);
	  
	  
	  $.post("<?php echo base_url()?>index.php/login/cek_login",$(this).serialize(),function(e){
		 
			//alert(e);
			
			if(e=='0')
			{
				$("#info_login").fadeOut().html('<div class="alert alert-danger alert-dismissible"><b>Perhatian!!!</b> NIK atau Password salah.</div>').fadeIn();
				
			}else if(e=='2')
			{
				$("#info_login").fadeOut().html('<div class="alert alert-warning alert-dismissible"><b>Warning!!!</b> Acount non active</div>').fadeIn();
				
			}else if(e=='1')
			{
				$("#info_login").fadeOut().html('<div class="alert alert-success alert-dismissible"><b>Berhasil!!!</b> Mohon tunggu...</div>').fadeIn();
							
				
				window.location.replace("<?php echo base_url()?>");
				
				
				
			}else if(e=='3')
			{
				$("#info_login").fadeOut().html('<div class="alert alert-warning alert-dismissible"><b>Warning!!!</b> Acount <b>'+NIK+'</b> sedang login.</div>').fadeIn();
			}
			
	  });
	  
	  
	 return false; 
  });
</script>

</body>
<!-- Mirrored from e-tikela.pakpakbharatkab.go.id/index.php/masuk by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Apr 2018 08:14:32 GMT -->
</html>