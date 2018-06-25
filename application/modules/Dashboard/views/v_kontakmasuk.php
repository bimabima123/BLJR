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
  				<h1>Kontak<small> masuk</small></h1>
			</div>
            <?php
                if ($this->session->userdata('level_akses') == 'admin') {?>
                <a href="<?php echo base_url('index.php/Dashboard/KontakMasuk/DeleteMessage'); ?>" class="btn btn-danger square-btn-adjust"  style="margin-top:-1%; margin-bottom:2%;"><i class="fa fa-trash"> </i> Hapus semua pesan&nbsp;</a>
            <?php } ?>
           <table class="table table-striped table-bordered table-hover" id="example1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pengirim</th>
                        <th>Pesan</th>
                        <th>Email</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $no = 1;
                foreach ($kontakmasuk as $h) { ?>
                    <tr class="odd gradeX" id="delive">
                        <td><?php echo $no; ?></td>
                        <td><?php echo $h->nama; ?></td>
                        <td>
                            <div style="background-color:#e0e0e0;padding:2%;border-radius:3px 3px;">
                            <?php echo $h->komentar; ?>
                            </div>
                        </td>
                        <td><?php echo $h->email; ?></td>
                        <td><?php echo $h->tanggal_masuk; ?></td>
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