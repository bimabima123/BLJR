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
  				<h1>Manajemen<small> Non Peraturan</small></h1>
			</div>		
			<a href="<?php echo base_url('index.php/Dashboard/NonPeraturan/Insert'); ?>" class="btn btn-primary" style="margin-top:-9px;margin-bottom:2%;"><i class="fa fa-plus"></i> Tambah data non peraturan</a>
			<table class="table table-striped table-bordered table-hover" id="example1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Tanggal Posting</th>
                        <th>Add (Edit) By</th>
                        <th>Pengarang Katalog</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $no = 1;
                foreach ($tb_nonperaturan as $h) { ?>
                    <tr class="odd gradeX">
                        <td><?php echo $no; ?></td>
                        <td><?php echo $h->judul; ?></td>
                        <td><?php echo $h->tgl_posting; ?></td>
                        <td><?php echo $h->add_by.'('.$h->edit_by.')'; ?></td>
                        <td><?php echo $h->pengarang_katalog; ?></td>
                        <td style="text-align:center;"><a href="<?php echo base_url('index.php/Dashboard/NonPeraturan/Update/'.$h->id_nonperaturan); ?>"><i class="fa fa-pencil" title="edit"></i></a>&nbsp;
                        <a href="<?php echo base_url('index.php/Dashboard/NonPeraturan/Delete/'.$h->id_nonperaturan); ?>" style="color:red;"><i class="fa fa-trash" title="hapus"></i></a>
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