<!DOCTYPE html>
<html>
<head>
	<?php include ('include/Header.php'); ?>	
</head>
<body>
	<?php include ('Navigasi.php'); ?>
	<?php include ('Slideshow.php'); ?>
		<div class="container-fluid" style="margin-top: 2%;">
		<div class="row">
			<div class="col-md-9" style="height:auto;">
				<div class="panel panel-default" >
					<div class="panel-body">
						<div class="row">
							<?php foreach ($peraturan as $key => $p) : ?>
							<div class="col-md-3">
								<p style="text-align: center; font-weight: bold;"><?php echo $p->bentuk ?></p>
								<?php foreach ($this->m_home->peraturan(array(
								'level'=>2,
								'id_peraturan_cat_parent'=>$p->id_peraturan_cat
								))->result() as $key => $a) { ?>
								<ul class="PerBody">
									<li><i class="fa fa-angle-right "><a href="<?php echo base_url(). 'index.php/Home/Home/lookmore/'. $a->id_peraturan_cat; ?>"></i> <?php echo $a->bentuk ?></a></li>
								</ul>
								<?php } ?>
							</div>
							<?php endforeach; ?>
						</div>
					</div>	
				</div>
			</div>
			<div class="col-md-3">
					<?php include ('include/Kalender.php'); ?>
					<?php include ('Banner.php'); ?>
			</div>		
		</div>
	</div>
	<?php include ('include/Footer.php'); ?>
	<?php include ('include/Js.php'); ?>

</body>
</html>