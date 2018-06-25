<!DOCTYPE html>
<html>
<head>
	<?php include "include/Header.php"; ?>
</head>
<body>
	<?php include "Navigasi.php"; ?>
	<?php include "Slideshow.php"; ?>

	<!-- <div class="container-fluid section-slide">
		<img src="image/20170411159.png" style="width:100%; margin:0px; padding: 0px; margin-bottom: 5px;">
	</div> -->
	<div class="container-fluid" style="margin-top: 2%;">
		<?php if ($stat == 'available') { ?>
		<div class="row">
			<?php foreach ($menu as $key => $m) : ?>
				<div class="col-md-9" style="height:auto;">
						<div class="judul">
						<h2 style="color:#fff;">&nbsp;<?php echo $m->nama_content ?></h2>
						</div>
						<br>
						<p><?php echo $m->isi_content ?> </p>
				</div>
			<?php endforeach; ?>
				<div class="col-md-3">
					<?php include "include/Kalender.php"; ?>
					<?php include "Banner.php"; ?>
				</div>
			</div>
		<?php }else{ ?>
			<div class="row">
				<div class="col-md-9" style="height:auto;">
						<div class="judul">
						<h2 style="color:#fff;">&nbsp;Belum mempunyai isi konten</h2>
						</div>
						<br>
						<p>&nbsp;Belum mempunyai isi konten</p>
				</div>
				<div class="col-md-3">
					<?php include "include/Kalender.php"; ?>
					<?php include "Banner.php"; ?>
				</div>
			</div>
		<?php } ?>
	</div>
	<?php include "include/Footer.php"; ?>
	<?php include "include/Js.php"; ?>
</body>
</html>