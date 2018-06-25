<!DOCTYPE html>
<html>
<?php include ('include/head.php'); ?>
	<body>
<div class="wraper">
	<?php include ('include/top_nav.php'); ?>
	<?php include ('include/side_nav.php'); ?>
	</div>
	<div id="page-wrapper" >
        <div id="page-inner" style="margin-top:8%;">   
            <div class="page-header">
                <h1>Tambah Data<small> kategori peraturan</small></h1>
            </div>
            <ol class="breadcrumb">
           <form action="<?php echo base_url('index.php/Dashboard/KategoriPeraturan/SaveInsert'); ?>" method="post">
                <button class="btn btn-danger" type="reset">Reset</button>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </ol>
           <div class="panel panel-default" style="margin-top:-1%;">
                    <div class="panel-heading"><a href="<?php echo base_url('index.php/Dashboard/KategoriPeraturan');?>" class="link">&laquo; Kembali</a></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Kategori parent</label>
                                <select class="form-control" name="kategori_parent">
                                    <option value="NULL">Kosongkan parent kategori</option>
                                    <?php foreach ($kategori_peraturan_parent as $h) { ?>    
                                    <option value="<?php echo $h->id_peraturan_cat; ?>"><?php echo $h->id_peraturan_cat.' || '.$h->bentuk; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6"><br>
                                <p style="color:red;font-style:italic;">*jika kategori parent tidak di pilih data kategori ini akan menjadi parent kategori</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="margin-top:1%;">
                                <label>Bentuk</label>
                                <input type="text" name="bentuk" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="margin-top:1%;">
                                <label>Level</label>
                                <input type="text" name="level" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="margin-top:1%;">
                                <label>Urutan</label>
                                <input type="text" name="urutan" class="form-control">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div> 
		<?php include('include/script.php') ?>		 
	</body>
</html>