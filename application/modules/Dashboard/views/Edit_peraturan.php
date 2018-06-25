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
                <h1>Edit Data<small> peraturan</small></h1>
            </div>
            <ol class="breadcrumb">
           <?php echo form_open_multipart('Dashboard/ListPeraturan/SaveUpdate'); ?>
                <button class="btn btn-danger" type="reset">Reset</button>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </ol>
           <div class="panel panel-default" style="margin-top:-1%;">
                    <div class="panel-heading"><a href="<?php echo base_url('index.php/Dashboard/ListPeraturan');?>" class="link">&laquo; Kembali</a></div>
                    <div class="panel-body">
                    <?php if($this->session->flashdata('message') == TRUE) { ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $this->session->flashdata('message'); ?></div>
                     <?php } ?>
                        <input type="hidden" name="id_peraturan" value="<?php echo $id_peraturan; ?>">
                        <div class="row">
                            <div class="col-md-8">
                                <label>Judul/Subjek</label>
                                <input type="text" name="subjek" class="form-control" value="<?php echo $subjek; ?>" required />
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                            <label>Kategori Peraturan</label>
                            <select class="form-control" name="kategori_peraturan">
                            <?php $no=1; 
                            //PARENT
                            foreach ($parent as $h) { 
                                if ($id_peraturan_cat == $h->id_peraturan_cat) { ?>
                                    <option value="<?php echo $h->id_peraturan_cat; ?>" selected><?php echo $no.' '.$h->bentuk; ?></option>
                            <?php }else{ ?>
                                    <option value="<?php echo $h->id_peraturan_cat; ?>"><?php echo $no.' '.$h->bentuk; ?></option>
                            <?php }
                            //SUB PARENT
                            foreach ($this->m_list_peraturan->option_kategori_level(array('level' => 2,'id_peraturan_cat_parent' => $h->id_peraturan_cat))->result() as $h) {
                                    if ($id_peraturan_cat == $h->id_peraturan_cat) { ?>
                                    <option value="<?php echo $h->id_peraturan_cat; ?>" selected><?php echo '... '.$h->bentuk; ?></option>
                                <?php }else{ ?> 
                                    <option value="<?php echo $h->id_peraturan_cat; ?>"><?php echo '... '.$h->bentuk; ?></option>
                            <?php }
                                } 
                            $no++;
                            }?>
                            </select>
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Tahun Peraturan</label>
                                <input type="text" name="tahun_peraturan" class="form-control" value="<?php echo $tahun; ?>" required />
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Nomor Peraturan</label>
                                <input type="text" name="nomor_peraturan" class="form-control" value="<?php echo $nomor; ?>" required />
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>File</label>
                                <input type="file" name="file">
                                <?php if (empty($file)) { ?>
                                    <br>
                                    <p style="color:red;font-style:italic;">*Tidak mempunyai file, silahkan ambil file</p>
                                <?php }else{ ?>
                                    <p style="margin-top:6px;color:red;">File lama : <j style="color:black;"><?php echo $file; ?></j></p>
                                    <p style="color:red;font-style:italic;">*Jangan pilih file jika tidak ingin merubah data file</p>
                                <?php } ?>
                            </div>
                            <div class="col-md-12" style="margin-top:1%;">
                            <div class="col-md-4" style="margin-left:-1.5%;">
                                <label>Status Peraturan</label>
                                <select class="form-control" name="status">
                                <?php for($index = 0; $index < sizeof($status_option); $index++){
                                    if ($status == $status_option[$index]) { ?>
                                    <option value="<?php echo $status_option[$index]; ?>" selected><?php echo $status_option[$index]; ?></option>        
                                <?php }else{ ?>
                                    <option value="<?php echo $status_option[$index]; ?>"><?php echo $status_option[$index]; ?></option>        
                                <?php }}?>
                                </select>
                            </div>  
                            <div class="col-md-4" style="margin-left:-1.5%;">
                                <label>Peraturan Terkait</label>
                                <select class="form-control" name="peraturan_terkait">
                                <?php if (empty($peraturan_terkait_lama)) { ?>
                                <option value="">Pilih peraturan terkait</option>
                                <?php }else{ ?>
                                <option value="<?php echo $peraturan_terkait_lama?>" selected><?php echo $peraturan_terkait_lama; ?></option>
                                <option value="">Pilih peraturan terkait</option>
                                <?php } ?>
                                <?php foreach ($peraturan_terkait as $h) { ?>   
                                    <?php if (empty($h->nomor)) { ?>
                                    <option value="<?php echo $h->bentuk?>"><?php echo $h->bentuk; ?></option>
                                    <?php }else{ ?>
                                    <option value="<?php echo $h->bentuk.' No '.$h->nomor.'/'.$h->tahun; ?>"><?php echo $h->bentuk.' No '.$h->nomor.'/'.$h->tahun; ?></option>
                                    <?php } ?>
                                <?php } ?>
                                </select>
                             </div> 
                            <div class="col-md-8" style="margin-top:1%;margin-left:-1.5%;">
                                <textarea class="ckeditor" id="ckeditor" name="riwayat" /><?php echo $riwayat_status; ?></textarea>
                            </div>
                            </div>  
                            <div class="col-md-12" style="margin-top:1%;">
                            <hr><center>
                                <h4 style="font-weight:bold;color:#920c0c;">Katalog Peraturan</h4>
                            <hr></center>
                            </div>
                            <div class="col-md-8">
                                <label>Tajuk entri utama</label>
                                <input type="text" name="tajuk_katalog" class="form-control" value="<?php echo $tajuk_katalog; ?>">
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Judul seragam</label>
                                <input type="text" name="judul_katalog" class="form-control" value="<?php echo $judul_katalog; ?>" >
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Bentuk, Nomor, Tahun peraturan</label>
                                <input type="text" name="bentuk_katalog" class="form-control" value="<?php echo $bentuk_katalog; ?>" >
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Tanggal, Bulan, dan Tahun peraturan</label>
                                <input type="text" name="tanggal_katalog" class="form-control" value="<?php echo $tanggal_katalog; ?>" >
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Perihal / Tentang</label>
                                <input type="text" name="tentang_katalog" class="form-control" value="<?php echo $tentang_katalog; ?>" >
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Tanggal pengesahan / Penetapan peraturan</label>
                                <input type="text" name="tempat_katalog" class="form-control" value="<?php echo $tempat_katalog; ?>" >
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Tahun peraturan</label>
                                <input type="text" name="tahun_katalog" class="form-control" value="<?php echo $tahun_katalog; ?>" >
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Sumber teks peraturan</label>
                                <input type="text" name="sumber_katalog" class="form-control" value="<?php echo $sumber_katalog; ?>" >
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Subjek peraturan</label>
                                <input type="text" name="subjek_katalog" class="form-control" value="<?php echo $subjek_katalog; ?>" >
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Singkatan bentuk peraturan</label>
                                <input type="text" name="singkatan_katalog" class="form-control" value="<?php echo $singkatan_katalog; ?>" >
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Lokasi peraturan</label>
                                <input type="text" name="lokasi_katalog" class="form-control" value="<?php echo $lokasi_katalog; ?>" >
                            </div>
                            <div class="col-md-12" style="margin-top:1%;">
                            <hr><center>
                                <h4 style="font-weight:bold;color:#920c0c;">Abstrak Peraturan</h4>
                            <hr></center>
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Subjek abstrak peraturan</label>
                                <input type="text" name="subjek_abstrak" class="form-control" value="<?php echo $subjek_abstrak; ?>" >
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Tahun abstrak peraturan</label>
                                <input type="text" name="tahun_abstrak" class="form-control" value="<?php echo $tahun_abstrak; ?>" >
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Singkatan abstrak peraturan</label>
                                <input type="text" name="singkatan_abstrak" class="form-control" value="<?php echo $singkatan_abstrak; ?>" >
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Nomor peraturan</label>
                                <input type="text" name="no_abstrak" class="form-control" value="<?php echo $nomor_abstrak; ?>" >
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Sumber peraturan</label>
                                <input type="text" name="sumber_abstrak" class="form-control" value="<?php echo $sumber_abstrak; ?>" >
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Jumlah halaman peraturan</label>
                                <input type="text" name="jumlah_abstrak" class="form-control" value="<?php echo $jumlah_abstrak; ?>" >
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Jenis/Bentuk peraturan</label>
                                <input type="text" name="bentuk_abstrak" class="form-control" value="<?php echo $bentuk_abstrak; ?>" >
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Tentang peraturan</label>
                                <input type="text" name="tentang_abstrak" class="form-control" value="<?php echo $tentang_abstrak; ?>" >
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Isi Abstrak</label>
                                <textarea class="ckeditor" id="ckeditor" name="isi_abstrak" /><?php echo $isi_abstrak; ?> </textarea>
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Dasar hukum undang-undang</label>
                                <textarea class="ckeditor" id="ckeditor" name="dasar_hukum_abstrak" /><?php echo $dasar_hukum_abstrak; ?></textarea>
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Dalam undang-undang ini di atur tentang</label>
                                <textarea class="ckeditor" id="ckeditor" name="diatur_tentang_abstrak" /><?php echo $diatur_tentang_abstrak; ?> </textarea>  
                            </div>
                            <div class="col-md-8" style="margin-top:1%;">
                                <label>Catatan</label>
                                <textarea class="ckeditor" id="ckeditor" name="catatan_abstrak" /> <?php echo $catatan_abstrak; ?> </textarea>
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