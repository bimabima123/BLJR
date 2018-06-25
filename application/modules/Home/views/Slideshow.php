
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <!-- <li data-target="#carousel-example-generic" data-slide-to="2"></li> -->
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="<?php echo base_url('assets/images/slideshow/default.jpg') ?>" style="width:100%; margin-top:3.5%; padding: 0px; margin-bottom: 0px;" alt="...">
    </div>
    <?php foreach ($slide as $key => $s) : ?>
    <div class="item">
      <img src="<?php echo base_url('assets/images/slideshow/'). $s->gambar_slide ?>" style="width:100%; margin-top:3.5%; padding: 0px; margin-bottom: 0px;" alt="...">
    </div>
    <?php endforeach; ?>
  </div>
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>