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
					<h1 style="color:#000; text-align: center;">Peraturan Abstrak</h1><br>
				<!-- </div> -->
			<div class="panel panel-default">
			  <div class="panel-heading">
			  	<a href="<?php echo base_url(). 'index.php/Home/Home/lookmore/'.$id_peraturan_cat?>" style="text-decoration:none;">&laquo; Kembali</a>
			  </div>
			  <div class="panel-body">
				<?php foreach ($peraturan as $key => $c) : ?>
			    <p><b>Subjek  : </b><?php echo $c->subjek_abstrak ?></p>
			    <p><b>Sumber  : </b><?php echo $c->sumber_abstrak ?></p>
			    <p><b>Tentang : </b><?php echo $c->tentang_abstrak ?></p>
			   	<b>Isi : </b>
			   	<p><?php echo $c->isi_abstrak ?></p>
			   	<b>Dasar Hukum : </b>
			   	<p><?php echo $c->dasar_hukum_abstrak ?></p>
			    <p><b>Di atur tentang : </b><?php echo $c->diatur_tentang_abstrak ?></p>
			    <p><b>Catatan abstrak : </b><?php echo $c->catatan_abstrak ?></p>
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