<!DOCTYPE html>
<html>
<?php include ('include/head.php'); ?>
	<body>
<div class="wraper">
	<?php include ('include/top_nav.php'); ?>
	<?php include ('include/side_nav.php'); ?>
	</div>
	<div id="page-wrapper">
        <div id="page-inner" style="margin-top:8%;">   
            <div class="page-header">
                <h1>Edit Data<small> slideshow</small></h1>
            </div>
            <ol class="breadcrumb">
           <?php echo form_open_multipart('Dashboard/Slideshow/SaveUpdate'); ?>
                <button class="btn btn-danger" type="reset">Reset</button>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </ol>
           <div class="panel panel-default" style="margin-top:-1%;">
                    <div class="panel-heading"><a href="<?php echo base_url('index.php/Dashboard/Slideshow');?>" class="link">&laquo; Kembali</a></div>
                    <div class="panel-body">
                    <?php if($this->session->flashdata('message') == TRUE) { ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $this->session->flashdata('message'); ?></div>
                    <?php } ?>
                    <input type="hidden" name="id_slide" value="<?php echo $id_slide; ?>">
                    	<div class="row">
                            <div class="col-md-6">
                                <label>Gambar Lama : </label><br>
                    			<img src="<?php echo base_url('assets/images/slideshow/').$gambar_lama; ?>" width="300px" height="100px" style="border:3px solid grey;">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6" style="margin-top:1%;">
                                <label>Ambil gambar</label>
                                <input type="file" name="gambar_slide">
                            </div>
                            <div class="col-md-6"><br>
                                <p style="color:red;font-style:italic;">*Gambar yang dipakai berukuran 1400pixel X 200pixel</p>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Status Slide</label><br>
                                <?php if ($status == 'publish') {?>
                                    <input type="checkbox" name="status" value="publish" checked> Publish
                                <?php }else{ ?> 
                                    <input type="checkbox" name="status" value="publish" > Publish
                                <?php } ?>
                            </div>
                        </div>
                <?php echo form_close(); ?>
                    </div>
                </div>
        </div>
    </div>
</div> 
		<?php include('include/script.php') ?>		 
	</body>
</html>