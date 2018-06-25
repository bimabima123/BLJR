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
  				<h1>Data<small> menu</small></h1>
			</div>
            <a href="<?php echo base_url('index.php/Dashboard/Menu/Insert'); ?>" class="btn btn-primary" style="margin-top:-9px;margin-bottom:2%;"><i class="fa fa-plus"></i> Tambah Menu</a>
           <table class="table table-striped table-bordered table-hover" id="example1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>induk menu</th>
                        <th>menu</th>
                        <th>url</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $no = 1;
                foreach ($menu as $h) { ?>
                    <tr class="odd gradeX">
                        <td><?php echo $no; ?></td>
                        <?php if ($h->induk_menu == 0) { ?>
                            <td>Tidak mempunyai induk menu</td>
                        <?php }else{
                            $induk = $this->db->query('SELECT * FROM tb_menu WHERE id_menu ='.$h->induk_menu);
                            foreach ($induk->result() as $in) { ?>
                                  <td><?php echo $in->menu; ?></td>
                        <?php } ?>
                        <?php } ?>
                        <td><?php echo $h->menu; ?></td>
                        <td><?php echo $h->uri; ?></td>
                        <td style="text-align:center;"><a href="<?php echo base_url('index.php/Dashboard/Menu/Update/'.$h->id_menu); ?>"><i class="fa fa-pencil" title="edit"></i></a>&nbsp;
                        <a href="<?php echo base_url('index.php/Dashboard/Menu/Delete/'.$h->id_menu); ?>" style="color:red;"><i class="fa fa-trash" title="hapus"></i></a>
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