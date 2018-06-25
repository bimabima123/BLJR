<!DOCTYPE html>
<html>
<head>
	<?php include "include/header.php"; ?>
</head>
<body>
	<?php include "navigasi.php"; ?>
	<?php include "slideshow.php"; ?>
	<div class="container-fluid" style="margin-top: 2%;">
		<div class="row">
			<div class="col-md-3">
				<?php include "PencarianPeraturan.php"; ?>
				<?php include "pencarianNonPeraturan.php"; ?>
			<div class="col-md-9" style="height:auto;">
				<!-- <div class="section-struk"> -->
					<h1 style="color:#000; text-align: center;">Non Peraturan Katalog</h1><br>
				<!-- </div> -->
			<div class="panel panel-default">
			  <div class="panel-heading">
				<a href="<?php echo base_url(). 'index.php/home/home/search/?judul=&pengarang_katalog=&penerbit_katalog=&kota_katalog=&tahun_katalog='; ?>" style="text-decoration:none;">&laquo; Kembali</a>
			  </div>
			  <div class="panel-body">
				<?php foreach ($nonperaturan as $key => $c) : ?>
			    <p><b>Col Number Katalog  : </b><?php echo $c->col_number_katalog ?></p>
			    <p><b>Judul  : </b><?php echo $c->judul_katalog ?></p>
			    <p><b>Penerbit : </b><?php echo $c->penerbit_katalog ?></p>
			    <p><b>Jilid : </b><?php echo $c->jilid_katalog ?></p>
			    <p><b>Jumlah : </b><?php echo $c->jumlah_katalog ?></p>
			    <p><b>Tebal : </b><?php echo $c->tebal_katalog ?></p>
			    <p><b>Subjek Pengarang : </b><?php echo $c->subjek_pengarang_katalog ?></p>
			    <p><b>No Induk : </b><?php echo $c->no_induk_katalog ?></p>
			    <p><b>Status : </b><?php echo $c->status_katalog ?></p>
				<?php endforeach; ?>
			  </div>
			</div>
			</div>
			</div>		
		</div>
	</div>
	<?php include "include/footer.php"; ?>
	<?php include "include/js.php"; ?>
</body>
</html>