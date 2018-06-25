<div class="section-grid">
	<div class="section">
		<p style="color:#fff; padding: 5px; text-align: center; font-size: 18px;">Pencarian Peraturan</p>
	</div>
	<form action="<?php echo base_url(). 'index.php/Home/Home/searching/' ?>" method="get">
	<select class="form-control jarform" name="id_peraturan_cat"><!--Name Bentuk dari tabel tb_peraturan_cat -->
		 <option value=""><--- JENIS PERATURAN ---></option>
	<?php
		$no=1;
		foreach ($level1 as $key => $lvl1) :
			echo "<option value='".$lvl1->id_peraturan_cat."'> ". $no.". " .$lvl1->bentuk." </option>";
			foreach ($this->m_home->option_peraturan_level(array(
				'level'=>2,
				'id_peraturan_cat_parent'=>$lvl1->id_peraturan_cat
				))->result() as $key => $lvl2) {
				echo "<option value='".$lvl2->id_peraturan_cat."'> ...".$lvl2->bentuk." </option>";
			foreach ($this->m_home->option_peraturan_level(array(
				'level'=>3,
				'id_peraturan_cat_parent'=>$lvl2->id_peraturan_cat
				))->result() as $key => $lvl3) {
				echo "<option value='".$lvl3->id_peraturan_cat."'> ...".$lvl3->bentuk." </option>";
			}
			foreach ($this->m_home->option_peraturan_level(array(
				'level'=>4,
				'id_peraturan_cat_parent'=>$lvl3->id_peraturan_cat
				))->result() as $key => $lvl4) {
				echo "<option value='".$lvl4->id_peraturan_cat."'> ...".$lvl4->bentuk." </option>";
			}
			foreach ($this->m_home->option_peraturan_level(array(
				'level'=>5,
				'id_peraturan_cat_parent'=>$lvl4->id_peraturan_cat
				))->result() as $key => $lvl5) {
				echo "<option value='".$lvl5->id_peraturan_cat."'> ...".$lvl5->bentuk." </option>";
			}
			foreach ($this->m_home->option_peraturan_level(array(
				'level'=>6,
				'id_peraturan_cat_parent'=>$lvl5->id_peraturan_cat
				))->result() as $key => $lvl6) {
				echo "<option value='".$lvl6->id_peraturan_cat."'> ...".$lvl6->bentuk." </option>";
			}
			foreach ($this->m_home->option_peraturan_level(array(
				'level'=>7,
				'id_peraturan_cat_parent'=>$lvl6->id_peraturan_cat
				))->result() as $key => $lvl7) {
				echo "<option value='".$lvl7->id_peraturan_cat."'> ...".$lvl7->bentuk." </option>";
			}
			}
		$no++;
		endforeach;
	?>
	</select>
		<input type="text" class="form-control jarform" placeholder="Nomor Peraturan.." name="nomor"><!--Name Nomor dari tabel tb_peraturan -->
		<input type="text" class="form-control jarform" placeholder="Tahun Peraturan.." name="tahun"><!--Name Tahun dari tabel tb_peraturan -->
		<input type="text" class="form-control jarform" placeholder="Tentang Peraturan.." name="tentang_katalog"><!--Name tentang dari tabel tb_peraturan_cat antara field tentang_katalog dan tentang abstrak-->
	<select class="form-control jarform" name="status">
			<option value=""><----STATUS PERATURAN----></option>
			<option value="Dicabut">Dicabut</option>
			<option value="Mencabut">Mencabut</option>
			<option value="Diubah">Diubah</option>
			<option value="Mengubah">Mengubah</option>
	</select>
	<button type="submit" class="btn btn-danger jarform " style="width:30%; margin-bottom: 2%;""><i class="fa fa-search"></i> Cari</button>
	</form>
</div>