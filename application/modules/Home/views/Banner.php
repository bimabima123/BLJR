<div class="section-grid" style="padding-bottom:2%;">
	<div class="section">
		<p style="color:#fff; padding: 5px; text-align: center; font-size: 18px;">Banner</p>
	</div>
	<?php foreach ($banner as $key => $b) : ?>
	<a href="<?php echo 'http://'.$b->url ?>" target="blank">
		<img src="<?php echo base_url('assets/images/banner/'). $b->gambar_banner ?>" style="width:100%; height:100%; margin-top: 2%;">
	</a>
	<?php endforeach; ?>
</div>