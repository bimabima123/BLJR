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
					<h1 style="color:#000; text-align: center;">Hasil Pencarian Peraturan</h1>
				<!-- </div> -->
			<table class="table table-bordered" style="margin-top: 2%;" id="example1">
			<thead>
				<tr>
					<th style="text-align: center;">Nomor</th>
					<th style="text-align: center;">Jenis</th>
					<th style="text-align: center;">Nomor peraturan</th>
					<th style="text-align: center;">Judul/subject</th>
					<th style="text-align: center;">Katalog</th>
					<th style="text-align: center;">Abstrak</th>
					<th style="text-align: center;">Download peraturan</th>
					<th style="text-align: center;">Status</th>
				</tr>
			</thead>
			<tbody>
				<?php if (count($cari)>0) { ?>
				<?php
				$nomor = 1;
				foreach ($cari as $key => $c) : ?>
				<tr>
					<td style="text-align: center;"><?php echo $nomor ?></td>
					<td style="text-align: center;"><?php echo $c->bentuk ?></td>
					<td style="text-align: center;"><?php echo $c->nomor ?></td>
					<td style="text-align: center;"><?php echo $c->subjek ?></td>
					<td style="text-align: center;"><a href="<?php echo base_url(). 'index.php/Home/Home/katalog/'. $c->id_peraturan_cat.'/'.$c->id_peraturan ?>" style="text-decoration: none;">Lihat Katalog</td>
					<td style="text-align: center;"><a href="<?php echo base_url(). 'index.php/Home/Home/abstrak/'. $c->id_peraturan_cat.'/'.$c->id_peraturan ?>" style="text-decoration: none;">Lihat Abstrak</td>
					<td style="text-align: center;"><a href="<?php echo base_url() . 'assets/file/peraturan/'. $c->file ?>" target='blank' style="text-decoration: none;" style="text-decoration: none;">Download Dokumen</a></td>
					<td style="text-align: center;"><?php echo $c->status ?></td>
				</tr>
				<?php 
				$nomor++;
				endforeach; ?>
				<?php 
				}else{ ?>
					<br>
					<div class="alert alert-danger alert-dismissible" role="alert">
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Data yang anda cari tidak di temukan!!!</div>
				<?php } ?>
			</tbody>
			</table>
			</div>
			</div>		
		</div>
	</div>
	<?php include "include/Footer.php"; ?>
	<?php include "include/Js.php"; ?>
</body>
</html>