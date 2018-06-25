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
                <h1>Tambah Data<small> admin</small></h1>
            </div>
            <ol class="breadcrumb">
            <form method="post" action="<?php echo base_url('index.php/Dashboard/DataAdmin/SaveUpdate'); ?>">
                <button class="btn btn-danger" type="reset">Reset</button>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </ol>
           <div class="panel panel-default" style="margin-top:-1%;">
                    <div class="panel-heading"><a href="<?php echo base_url('index.php/Dashboard/DataAdmin');?>" class="link">&laquo; Kembali</a></div>
                    <div class="panel-body">
                    <?php if($this->session->flashdata('message') == TRUE) { ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $this->session->flashdata('message'); ?></div>
                    <?php } ?>
                    <input type="hidden" name="id_admin" value="<?php echo $id_admin; ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control"/ value="<?php echo $username; ?>">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control"/ placeholder="Masukan Password Baru">
                            </div>
                            <div class="col-md-6">
                                <br>
                                <p style="color:red;font-style:italic;">*Jika password baru tidak di isi maka password tidak di perbarui</p>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Pilih Level akses</label>
                                <select class="form-control" name="level">
                                <?php for ($index=0; $index < sizeof($option_level) ; $index++) { 
                                    if ($level_akses == $option_level[$index]){ ?>
                                    <option value="<?php echo $option_level[$index]; ?>" selected><?php echo $option_level[$index]; ?></option>
                                <?php }else{ ?> 
                                    <option value="<?php echo $option_level[$index]; ?>"><?php echo $option_level[$index]; ?></option>
                                <?php }} ?>
                                </select>
                            </div>
                        </div><br>
                </form>
                    </div>
                </div>
        </div>
    </div>
</div> 
        <?php include('include/script.php') ?>       
    </body>
</html>