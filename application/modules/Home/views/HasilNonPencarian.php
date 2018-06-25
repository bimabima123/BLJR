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
					<h1 style="color:#000; text-align: center;">Hasil Pencarian Non Peraturan</h1>
				<!-- </div> -->
			<table class="table table-bordered" style="margin-top: 2%;" id="example1">
			<thead>
				<tr>
					<th style="text-align: center;">Nomor</th>
					<th style="text-align: center;">Judul</th>
					<th style="text-align: center;">Pengarang</th>
					<th style="text-align: center;">Penerbit</th>
					<th style="text-align: center;">Kota Terbit</th>
					<th style="text-align: center;">Tahun Terbit</th>
					<th style="text-align: center;">Download Non Peraturan</th>
					<th style="text-align: center;">Katalog</th>
				</tr>
			</thead>
			<tbody>
				<?php if (count($carinon)>0) { ?>
				<?php 
				$nomor = 1;
				foreach ($carinon as $key => $nc) : ?>
				<tr>
					<td style="text-align: center;"><?php echo $nomor ?></td>
					<td style="text-align: center;"><?php echo $nc->judul ?></td>
					<td style="text-align: center;"><?php echo $nc->pengarang_katalog ?></td>
					<td style="text-align: center;"><?php echo $nc->penerbit_katalog ?></td>
					<td style="text-align: center;"><?php echo $nc->kota_katalog ?></td>
					<td style="text-align: center;"><?php echo $nc->tahun_katalog ?></td>
					<td style="text-align: center;"><a href="<?php echo base_url() . 'assets/file/peraturan/'. $nc->file ?>" target='blank' style="text-decoration: none;" style="text-decoration: none;">Download Dokumen</a></td>
					<td style="text-align: center;"><a href="<?php echo base_url(). 'index.php/Home/Home/nonkatalog/'. $nc->id_nonperaturan ?>" style="text-decoration: none;">Lihat Katalog</td>
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