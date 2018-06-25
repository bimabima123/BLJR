<!DOCTYPE html>
<html>
<head>
	<?php include "include/Header.php"; ?>
</head>
<body>
	<?php include "Navigasi.php"; ?>
	<?php include "Slideshow.php"; ?>
	<div class="container-fluid" style="margin-top: 2%;">
		<div class="row">
			<div class="col-md-3">
				<?php include "PencarianPeraturan.php"; ?>
				<?php include "PencarianNonPeraturan.php"; ?>
			<div class="col-md-9" style="height:auto;">
				<!-- <div class="section-struk"> -->
					<h1 style="color:#000; text-align: center;">Peraturan Katalog</h1><br>
				<!-- </div> -->
			<div class="panel panel-default">
			  <div class="panel-heading">
				<a href="<?php echo base_url(). 'index.php/Home/Home/lookmore/'.$id_peraturan_cat?>" style="text-decoration:none;">&laquo; Kembali</a>
			  </div>
			  <div class="panel-body">
				<?php foreach ($peraturan as $key => $c) : ?>
			    <p><b>Tajuk  : </b><?php echo $c->tajuk_katalog ?></p>
			    <p><b>Judul  : </b><?php echo $c->judul_katalog ?></p>
			    <p><b>Bentuk katalog : </b><?php echo $c->bentuk_katalog ?></p>
			    <p><b>Tanggal katalog : </b><?php echo $c->tanggal_katalog ?></p>
			    <p><b>Tentang katalog : </b><?php echo $c->tentang_katalog ?></p>
			    <p><b>Tempat katalog : </b><?php echo $c->tempat_katalog ?></p>
			    <p><b>Suber katalog : </b><?php echo $c->sumber_katalog ?></p>
			    <p><b>Subjek katalog : </b><?php echo $c->subjek_katalog ?></p>
			    <p><b>Lokasi katalog : </b><?php echo $c->lokasi_katalog ?></p>
				<?php endforeach; ?>
			  </div>
			</div>
			</div>
			</div>		
		</div>
	</div>
	<?php include "include/Footer.php"; ?>
	<?php include "include/Js.php"; ?>
</body>
</html>