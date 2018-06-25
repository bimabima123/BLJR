<!DOCTYPE html>
<html>
<?php include ('include/head.php'); ?>
	<body>
	<div class="wraper">
<?php include ('include/top_nav.php'); ?>
<?php include ('include/side_nav.php'); ?>
<div id="page-wrapper" >
            <div id="page-inner" style="margin-top:8%;"> 
            <?php if($this->session->flashdata('message') == TRUE) { ?>
			  		<div class="alert alert-info alert-dismissible" role="alert">
			  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $this->session->flashdata('message'); ?></div>
			 <?php } ?>
            <div class="page-header">
  				<h1>Dashboard<small> Log Aktivitas</small></h1>
			</div>
            <?php
                if ($this->session->userdata('level_akses') == 'admin') {?>
                <a href="<?php echo base_url('index.php/Dashboard/Welcome/DeleteHistory'); ?>" class="btn btn-danger square-btn-adjust"  style="margin-top:-1%; margin-bottom:2%;"><i class="fa fa-trash"> </i> Bersihkan Seluruh Riwayat&nbsp;</a>
            <?php } ?>
           <table class="table table-striped table-bordered table-hover" id="example1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Aktivitas</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $no = 1;
                foreach ($log as $h) { ?>
                    <tr class="odd gradeX">
                        <td><?php echo $no; ?></td>
                        <td><?php echo $h->user; ?></td>
                        <td><?php echo $h->aktivitas; ?></td>
                        <td><?php echo $h->waktu; ?></td>
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