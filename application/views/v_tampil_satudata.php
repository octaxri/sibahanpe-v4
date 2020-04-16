<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include "bootstrap.php";?>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>
<body>
	<div class="container">
		<strong>isi tbl_admin_satudata</strong>
		<div>
			<table class="table table-striped table-bordered data-table">
				<tr>
					<th>NO</th>
					<th>NIP</th>
					<th>AKSI</th>
				</tr>
				<?php 
					$no=0;
					foreach($query as $q)
					{
						$no++;
				?>
				<tr>
					<td><?php echo $no ?></td>
					<td><?php echo $q->NIP ?></td>
					<td>
						
						<a href="edit_satu?id=<?php echo $q->id?>" class="btn btn-xs btn-warning">Edit</a>
						<a href="hapus_satu?id=<?php echo $q->id?>" class="btn btn-xs btn-danger">Hapus</a>

					</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</body>
</html>