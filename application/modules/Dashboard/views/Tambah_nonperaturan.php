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
                <h1>Tambah Data<small> non peraturan</small></h1>
            </div>
            <ol class="breadcrumb">
           <?php echo form_open_multipart('Dashboard/NonPeraturan/SaveInsert'); ?>
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
                        <input type="hidden" name="id_konten" value="">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Judul</label>
                                <input type="text" name="judul" class="form-control" placeholder="wajib di isikan" required />
                            </div>
                            <div class="col-md-6" style="">
                                <label>File</label>
                                <p style="color:red;"> *wajib di isikan</p>
                                <input type="file" name="file">
                            </div>
                            <div class="col-md-6">
                                <label>Thumbnail</label>
                                <p style="color:red;"> *wajib di isikan</p>
                                <input type="file" name="thubnail" accept="">
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Col Number</label>
                                <input type="text" name="col_number" class="form-control">
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Pengarang Buku</label>
                                <input type="text" name="pengarang_buku" placeholder="Wajib di isikan" class="form-control" required/>
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Judul katalog</label>
                                <input type="text" name="judul_buku" class="form-control">
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Kota Terbit</label>
                                <input type="text" name="kota_terbit" class="form-control">
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Penerbit Buku</label>
                                <input type="text" name="penerbit_buku" class="form-control">
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Tahun Terbit</label>
                                <input type="text" name="tahun_terbit" class="form-control">
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Jilid Buku</label>
                                <input type="text" name="jilid_buku" class="form-control">
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Jumlah halaman Buku</label>
                                <input type="text" name="jumlah_halaman" class="form-control">
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Tebal Buku</label>
                                <input type="text" name="tebal_buku" class="form-control">
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Subjek & Pengarang Buku</label>
                                <textarea class="ckeditor" id="ckeditor" name="subjek"></textarea>

                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Nomor induk</label>
                                <input type="text" name="no_induk" class="form-control">
                            </div>
                            <div class="col-md-8" style="margin-top:1%;margin-bottom:4%;">
                                <label>Status Buku</label>
                                <select class="form-control" name="status">
                                    <option value="Dipinjam">Dipinjam</option>
                                    <option value="Tersedia">Tersedia</option>
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