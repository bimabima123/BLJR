<!DOCTYPE html>
<html>
<head>

	<?php include "include/Header.php"; ?>

</head>
<body>

	<?php include ('Navigasi.php'); ?>
	<?php include ('Slideshow.php'); ?>
	
	<div')class="container-fluid" style="margin-top: 2%;">
		<div class="row">
			<div class="col-md-3">
			
			<!-- peraturan terbaru -->
				<div class="section" style="margin-top:3.5%;">
					<p style="color:#fff; padding: 5px; text-align: center; font-size: 18px;">Peraturan Terbaru</p>
				</div>
				<ul class="PerBody" style="margin-left: -10%; margin-top:2%;">
				<?php foreach ($terbaru as $key => $t) : ?>
					<li><i class="fa fa-angle-right"><a href="<?php echo base_url(). 'index.php/Home/Home/lookmore/'. $t->id_peraturan_cat; ?>"></i> <?php echo $t->bentuk ?></a></li>
				<?php endforeach; ?>
				</ul>

					<!-- pencarian -->
				<?php include ('PencarianPeraturan.php'); ?>
				<?php include ('PencarianNonPeraturan.php'); ?>
				
			<!-- berita -->
			<div class="col-md-6">
			<div class="section" style="margin-top: 1.5%;">
					<p style="color:#fff; padding: 5px; text-align: center; font-size: 18px;">Berita Kota Bogor</p>
			</div>
			<div class="panel panel-default" style="border-radius:0px 0px 5px 5px;" >
				<div class="panel-body" style="padding: 5px;  ">
				<?php 
				$url = "http://kotabogor.go.id/index.php/json_berita/get?key=kotaBogor2015B15A";
				$jsonUrl = file_get_contents($url);
				$result = json_decode($jsonUrl, true);
								
				function limit_words($string, $word_limit){
				$words = explode(" ",$string);
				return implode(" ",array_splice($words,0,$word_limit));
				}					
				
				for($i=0 ; $i <5 ; $i++){
					foreach ($result as $row) { 
					$id = $row[$i]['postid'];
					$judul = $row[$i]['judul'];
					$konten = $row[$i]['konten'] ."<br/>";
										
					$limited_konten = limit_words($konten, 50);
				?>				
					<h5><a class="link" href="http://kotabogor.go.id/index.php/show_post/detail/<?php echo $id ?>"  target='_blank'><?php echo $judul ?></a></h5>
					<p style="color: black;"><?php echo $limited_konten.' ......... <br>'; ?></p>
				<?php }} ?>
			</div>
			</div>	


			</div>
			<div class="col-md-3";>
					<?php include ('include/Kalender.php');?>
					<?php include ('Banner.php');?>

					<!-- statistik -->
				<div class="section-grid">
					<div class="section">
						<p style="color:#fff; padding: 5px; text-align: center; font-size: 18px;">Statistik</p>
					</div>
					<div class="panel-body">
						<div class="statistik">
							<?php echo $counter; ?>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<?php include ('include/Footer.php'); ?>
	<?php include ('include/Js.php'); ?>
</body>
</html>