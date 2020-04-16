<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include "bootstrap.php";?>
</head>
<body>
	<div class="container">
		
		<form action="simpan_satu" method="post">
			<div class="row">
				<div class="col-md-12 text-center">
					<strong><p>Tambah ke tabel tbl_admin_satudata</p></strong>
				</div>
				<div class="col-md-4">
					<label>NIP</label>
				</div>
				<div class="col-md-6">
					<input type="number" name="NIP" required="" class="form-control" maxlength="17" placeholder="NIK">
				</div>
				<div class="col-md-4">
				</div>
				<div class="col-md-6"><br>
					<input type="submit" name="simpan" value="Simpan" class="btn btn-sm btn-success">
				</div>
			</div>
		</form>
		
	</div>
</body>
</html>