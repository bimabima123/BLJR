<div class="section-grid">
	<div class="section">
		<p style="color:#fff; padding: 5px; text-align: center; font-size: 1	8px;">Pencarian Non Peraturan</p>
	</div>
	<form action="<?php echo base_url() .'index.php/Home/Home/search/' ?>" method="get">
	<!-- Semua name diambil dari tabel tb_non_peraturan -->
	<input type="text" class="form-control jarform" placeholder="Judul.." name="judul">
	<input type="text" class="form-control jarform" placeholder="Pengarang.." name="pengarang_katalog">
	<input type="text" class="form-control jarform" placeholder="Penerbit.." name="penerbit_katalog">
	<input type="text" class="form-control jarform" placeholder="Kota Terbit.." name="kota_katalog">
	<input type="text" class="form-control jarform" placeholder="Tahun Terbit.." name="tahun_katalog">
	<button type="submit" class="btn btn-danger jarform " style="width:30%; margin-bottom: 2%;""><i class="fa fa-search"></i> Cari</button>
	</form>
</div>
</div>