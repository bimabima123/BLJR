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
            <?php if($this->session->flashdata('message') == TRUE) { ?>
                    <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $this->session->flashdata('message'); ?></div>
             <?php } ?>
            <div class="page-header">
                <h1>Data<small> slide show</small></h1>
            </div>      
            <a href="<?php echo base_url('index.php/Dashboard/Slideshow/Insert'); ?>" class="btn btn-primary" style="margin-top:-9px;margin-bottom:2%;"><i class="fa fa-plus"></i> Tambah slide show</a>
           <table class="table table-striped table-bordered table-hover" id="example1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $no = 1;
                foreach ($tb_slideshow->result() as $h) { ?>
                    <tr class="odd gradeX">
                        <td><?php echo $no; ?></td>
                        <td><img src="<?php echo base_url('assets/images/slideshow/').$h->gambar_slide; ?>" width="300px" height="90px"></td>
                        <td><?php echo $h->status; ?></td>
                        <td style="text-align:center;"><a href="<?php echo base_url('index.php/Dashboard/Slideshow/Update/'.$h->id_slide); ?>"><i class="fa fa-pencil" title="edit"></i></a>&nbsp;
                        <a href="<?php echo base_url('index.php/Dashboard/Slideshow/Delete/'.$h->id_slide); ?>" style="color:red;"><i class="fa fa-trash" title="hapus"></i></a>
                        </td>
                    </tr>
                <?php $no++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 
		<?php include('include/script.php') ?>		 
	</body>
</html>