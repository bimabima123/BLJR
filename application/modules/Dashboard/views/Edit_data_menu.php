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
                <h1>Edit Data<small> menu</small></h1>
            </div>
            <ol class="breadcrumb">
            <form method="post" action="<?php echo base_url('index.php/Dashboard/Menu/SaveUpdate'); ?>">
                <button class="btn btn-danger" type="reset">Reset</button>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </ol>
           <div class="panel panel-default" style="margin-top:-1%;">
                    <div class="panel-heading"><a href="<?php echo base_url('index.php/Dashboard/Menu');?>" class="link">&laquo; Kembali</a></div>
                    <div class="panel-body">
                    <?php if($this->session->flashdata('message') == TRUE) { ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $this->session->flashdata('message'); ?></div>
                    <?php } ?>
                        <input type="hidden" name="id_menu" value="<?php echo $id_menu; ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Pilih induk menu</label>
                                <select class="form-control" name="induk_menu">
                                    <option value="NULL">Pilih induk menu</option>
                                    <?php foreach ($parent as $h){ 
                                        if ($induk_menu == $h->id_menu) { ?>
                                            <option value="<?php echo $h->id_menu; ?>" selected><?php echo $h->menu; ?></option>
                                    <?php }else{ ?>
                                            <option value="<?php echo $h->id_menu; ?>"><?php echo $h->menu; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6"><br>
                                <p style="color:red;font-style: italic">*Jika Induk menu dikosongkan maka menu ini menjadi induk menu</p>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Menu</label>
                                <input type="text" name="menu" class="form-control"/ value="<?php echo $menu; ?>">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Url</label>
                                <input type="text" name="url" class="form-control"/ value="<?php echo $url; ?>">
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