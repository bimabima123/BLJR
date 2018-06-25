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
  				<h1>Manajemen<small> peraturan</small></h1>
			</div>		
			<a href="<?php echo base_url('index.php/Dashboard/ListPeraturan/Insert'); ?>" class="btn btn-primary" style="margin-top:-9px;margin-bottom:2%;"><i class="fa fa-plus"></i> Tambah data peraturan</a>
			<table class="table table-striped table-bordered table-hover" id="example1">
                <thead>
                    <tr style="text-align: center;">
						<td>No</td>
						<td>Kategori</td>
						<td>Nomor</td>
						<td>Judul/Subjek</td>
						<td>Tanggal Posting</td>
						<td>ADD (EDIT) BY</td>
						<td>Aksi</td>
					</tr>
                </thead>
                <tbody>
                <?php 
                $no = 1;
                foreach ($tb_peraturan as $h) { ?>
                    <tr class="odd gradeX">
                        <td><?php echo $no; ?></td>
						<td><?php echo $h->nama_kategori; ?></td>
						<td><?php echo $h->nomor; ?></td>
						<td><?php echo $h->subjek; ?></td>
						<td><?php echo $h->tgl_posting; ?></td>
						<td><?php echo $h->add_by; ?>(<?php echo $h->edit_by; ?>)</td>
                        <td style="text-align:center;"><a href="<?php echo base_url('index.php/Dashboard/ListPeraturan/Update/'.$h->id_peraturan); ?>"><i class="fa fa-pencil" title="edit"></i></a>&nbsp;
                        <a href="<?php echo base_url('index.php/Dashboard/ListPeraturan/Delete/'.$h->id_peraturan); ?>" style="color:red;"><i class="fa fa-trash" title="hapus"></i></a>
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