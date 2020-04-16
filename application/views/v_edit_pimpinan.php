<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include "bootstrap.php";?>
</head>
<body>
	<div class="container">
		
		<form action="simpan_edit_pimpinan" method="post">
			<div class="row">
				<div class="col-md-12 text-center">
					<strong><p>Insert tabel tbl_pimpinan</p></strong>
				</div>
				<div class="col-md-4">
					<label>ID PIMPINAN</label>
				</div>
				<div class="col-md-6">
					<input type="number" name="id_pimpinan" required="" class="form-control" readonly value="<?php echo $query[0]->id_pimpinan ?>">
				</div>
				<div class="col-md-4">
					<label>FID</label>
				</div>
				<div class="col-md-6">
					<input type="number" name="FID" required="" class="form-control" maxlength="17" placeholder="FID"  value="<?php echo $query[0]->FID ?>">
				</div>
				<div class="col-md-4">
					<label>NIP</label>
				</div>
				<div class="col-md-6">
					<input type="number" name="NIP" required="" class="form-control" maxlength="17" placeholder="NIP"  value="<?php echo $query[0]->NIP ?>">
				</div>
				<div class="col-md-4">
					<label>ID OPD</label>
				</div>
				<div class="col-md-6">
					<input type="number" name="ID_OPD" required="" class="form-control" maxlength="17" placeholder="ID OPD"  value="<?php echo $query[0]->ID_OPD ?>">
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