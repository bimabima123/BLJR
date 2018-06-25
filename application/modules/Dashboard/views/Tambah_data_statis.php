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
            <?php if($this->session->flashdata('message') == TRUE) { ?>
			  		<div class="alert alert-info alert-dismissible" role="alert">
			  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $this->session->flashdata('message'); ?></div>
			 <?php } ?>
            <div class="page-header">
  				<h1>Tambah<small> Data Statis</small></h1>
			</div>
           <div class="panel panel-default">
                    <div class="panel-heading"><a href="<?php echo base_url('index.php/Dashboard/DataStatis');?>" class="link">&laquo; Kembali</a></div>
                    <div class="panel-body">
                        <form action="<?php echo base_url('index.php/Dashboard/DataStatis/SaveInsert'); ?>" method="post">
                        <div class="row">
                            <div class="col-md-9">
                                <label>Pilih menu</label>
                                <select class="form-control" name="induk_menu">
                                    <?php foreach ($menu->result() as $induk_menu){ ?>
                                    <option value="<?php echo $induk_menu->id_menu; ?>"><?php echo $induk_menu->menu; ?></option>
                                    <?php foreach ($this->db->query('SELECT * FROM tb_menu WHERE induk_menu ='.$induk_menu->id_menu)->result() as $sub_menu) { ?>
                                    <option value="<?php echo $sub_menu->id_menu; ?>"><?php echo "....".$sub_menu->menu; ?></option>
                                <?php } ?>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-9" style="margin-top:1%;">
                                <label>Judul Konten</label>
                                <input type="text" name="judul" class="form-control">
                            </div>
                            <div class="col-md-9" style="margin-top:2%;">
                                <label>Isi Konten</label>
                                <textarea type="text" name="isi" class="ckeditor" id="ckeditor">
                                </textarea>
                            </div>
                        </div>
                        <br><button class="btn btn-danger" type="reset">Reset</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div> 
		<?php include('include/script.php') ?>		 
	</body>
</html>