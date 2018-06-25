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
                <h1>Edit Data<small> non peraturan</small></h1>
            </div>
            <ol class="breadcrumb">
           <?php echo form_open_multipart('Dashboard/NonPeraturan/SaveUpdate'); ?>
                <button class="btn btn-danger" type="reset">Reset</button>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </ol>
           <div class="panel panel-default" style="margin-top:-1%;">
                    <div class="panel-heading"><a href="<?php echo base_url('index.php/Dashboard/NonPeraturan');?>" class="link">&laquo; Kembali</a></div>
                    <div class="panel-body">
                    <?php if($this->session->flashdata('message') == TRUE) { ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $this->session->flashdata('message'); ?></div>
                    <?php }else{ ?> 
                    <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>File yang dapat di upload ber ekstensi <c style="font-style:italic;font-weight:bold;">.pdf .doc & .docx</c> <br> Thumbnail yang dapat di upload memiliki ekstensi file <c style="font-style:italic;font-weight:bold;">.jpg .jpeg & .png</c> serta ukuran file tidak lebih dari <c style="font-style:italic;font-weight:bold;">100Mb</c></div>
                    <?php } ?>
                        <input type="hidden" name="id_nonperaturan" value="<?php echo $id_nonperaturan; ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Judul</label>
                                <input type="text" name="judul" class="form-control" value="<?php echo $judul; ?>">
                            </div>
                            <div class="col-md-6" style="">
                                <label>File</label>
                                <p>FILE LAMA : <?php echo $file; ?></p>
                                <input type="file" name="file" class="" value="">
                            </div>
                            <div class="col-md-6" style="">
                                <label>Thubnail</label><br>
                                <img src="<?php echo base_url('assets/images/nonperaturan/'.$thumb); ?>" style="width:35%;height:35%;border:3px solid grey;">
                                <p><?php echo $thumb; ?></p>
                                <input type="file" name="thubnail">
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Col Number</label>
                                <input type="text" name="col_number" class="form-control" value="<?php echo $col_number_katalog; ?>">
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Pengarang Katalog</label>
                                <input type="text" name="pengarang_buku" class="form-control" value="<?php echo $pengarang_katalog; ?>">
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Judul katalog</label>
                                <input type="text" name="judul_buku" class="form-control" value="<?php echo $jumlah_katalog; ?>">
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Kota Terbit</label>
                                <input type="text" name="kota_terbit" class="form-control" value="<?php echo $kota_katalog; ?>">
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Penerbit Buku</label>
                                <input type="text" name="penerbit_buku" class="form-control" value="<?php echo $penerbit_katalog; ?>">
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Tahun Terbit</label>
                                <input type="text" name="tahun_terbit" class="form-control" value="<?php echo $tahun_katalog; ?>">
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Jilid Buku</label>
                                <input type="text" name="jilid_buku" class="form-control" value="<?php echo $jilid_katalog; ?>">
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Jumlah halaman Buku</label>
                                <input type="text" name="jumlah_halaman" class="form-control" value="<?php echo $jumlah_katalog; ?>">
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Tebal Buku</label>
                                <input type="text" name="tebal_buku" class="form-control" value="<?php echo $tebal_katalog; ?>">
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Subjek & Pengarang Buku</label>
                                <textarea class="ckeditor" id="ckeditor" name="subjek"><?php echo $subjek_pengarang_katalog; ?></textarea>
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Nomor induk</label>
                                <input type="text" name="no_induk" class="form-control" value="<?php echo $no_induk_katalog; ?>">
                            </div>
                            <div class="col-md-8" style="margin-top:1%;margin-bottom:4%;">
                                <label>Status Buku</label>
                                <select class="form-control" name="status">
                                    <?php for ($index=0; $index < sizeof($option_status); $index++) { 
                                        if ($status_katalog == $option_status[$index]) { ?>
                                            <option value="<?php echo $option_status[$index]; ?>" selected><?php echo $option_status[$index]; ?></option>
                                    <?php }else{ ?>
                                            <option value="<?php echo $option_status[$index]; ?>"><?php echo $option_status[$index]; ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
        </div>
    </div>
</div> 
		<?php include('include/script.php') ?>		 
	</body>
</html>