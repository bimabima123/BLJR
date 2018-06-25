<!DOCTYPE html>
<html>
<head>
<?php include "include/Header.php"; ?>
</head>
<body>
	<?php include "Navigasi.php"; ?>

	<!-- <div class="container-fluid"> -->
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.4155855681747!2d106.79170701428296!3d-6.595159666303932!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5b7d2e12d0d%3A0x393a0a0f7de45736!2sOffice+of+the+Mayor+of+Bogor!5e0!3m2!1sen!2sid!4v1501656561033" width="100%" height="400" frameborder="0" style="margin-top:50px;"  border:0" allowfullscreen></iframe>
	<!-- </div> -->
	<div class="container">
		<div class="row">
			<div class="col-md-3" align="center">
				<i class="fa fa-home fa-3x" aria-hidden="true" style="color:#920101; margin-top: 15px;"></i>
				<p>Jl. Ir. H. Juanda No. 10 Bogor</p>
			</div>
			<div class="col-md-3" align="center">
				<i class="fa fa-envelope fa-3x" aria-hidden="true" style="color:#920101; margin-top: 15px;"></i>
				<p>siskum@kotabogor.go.id</p>
			</div>
			<div class="col-md-3" align="center">
				<i class="fa fa-phone fa-3x" aria-hidden="true" style="color:#920101; margin-top: 15px;"></i>
				<p>(0251) 83210875</p>
				<p>Ext. 242</p>
			</div>
			<div class="col-md-3" align="center">
				<i class="fa fa-globe fa-3x" aria-hidden="true" style="color:#920101; margin-top: 15px;"></i>
				<p>jdih.kotabogor.go.id</p>
			</div>
		</div>
	</div>
	<form action="<?php echo base_url(). 'index.php/Home/Home/insert_pesan'; ?>" method="post" style="margin-top: 50px;">
		<div class="container">
			<div class="row">
			<?php if($this->session->flashdata('message') == TRUE) { ?>
			    <div class="alert alert-info alert-dismissible" role="alert">
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $this->session->flashdata('message'); ?></div>
			<?php } ?>
				<div class="col-md-6">
				 	<div class="form-group">
				    	<label>Nama:</label>
				    	<input type="text" class="form-control" name="nama" placeholder="Masukan Nama Anda">
				  	</div>
			  	</div>
				<div class="col-md-6">
				 	<div class="form-group">
				    	<label for="Email">Email address:</label>
				    	<input type="email" class="form-control" name="email" placeholder="Masukan Email">
				  	</div>
			  	</div>
		  	</div>
		  	<div class="form-group">
				<label>Komentar</label>
				  	<textarea type="text" class="form-control" name="komentar" placeholder="Masukan Komentar"></textarea>
			</div>
		</div>
		<button type="submit" class="btn btn-danger" style="margin-left: 110px;">KIRIM</button>
	</form>
	 <?php include "include/Footer.php"; ?>
	<?php include "include/Js.php"; ?>
</body>
</html>