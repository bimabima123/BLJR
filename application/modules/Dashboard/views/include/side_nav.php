<nav class="navbar-default navbar-side" role="navigation" style="height:100%;">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
		<li class="text-center">
            <img src="<?php echo base_url('assets/images/user-icon2.png'); ?>" class="user-image img-responsive"/>
            <div style="padding:0px 5% 0px 5%; margin-top:-9%;">
            <p style="color:white" style="margin-top:-2%;">JARINGAN DOKUMENTASI & INFORMASI HUKUM KOTA BOGOR</p>
			</div>
            </li>
            <li>
                <a class="active-menu"  href="<?php echo base_url(). 'index.php/Dashboard/Welcome'; ?>"><i class="fa fa-dashboard fa-2x"></i> Dashboard</a>
            </li> 
            <?php if ($this->session->userdata('level_akses') == 'admin') { ?>
                <li>
                    <a href="<?php echo base_url(). 'index.php/Dashboard/DataAdmin'; ?>"><i class="fa fa-user"></i>Pengelola Web</a>
                </li>
            <?php } ?>
            <li>
                <a href="<?php echo base_url(). 'index.php/Dashboard/Menu'; ?>"><i class="fa fa-bars"></i>Menu</a>
            </li>
            <li>
                <a href="<?php echo base_url(). 'index.php/Dashboard/DataStatis'; ?>"><i class="fa fa-book "></i>Konten</a>
            </li>    
            <li class="link">
            <a href="#collapkategori" type="button" data-toggle="collapse" data-target="#collapkategori" aria-expanded="false" aria-controls="collapsegambar""><i class="fa fa-sitemap fa"></i>Peraturan <i class="fa fa-chevron-circle-down fa" style="float:right;"></i></a>
              <ul class="collapse collapseable" id="collapkategori" style="background-color:#3c3b3b;">
                <li class="nav-drop"><a href="<?php echo base_url(). 'index.php/Dashboard/KategoriPeraturan'; ?>"><i class="fa fa-fw fa-table"></i> Kategori Peraturan</a></li>
                <li class="nav-drop"><a href="<?php echo base_url(). 'index.php/Dashboard/ListPeraturan'; ?>"><i class="fa fa-fw fa-edit"></i> List Peraturan</a> </li>
             </ul>
            <li>
                <a href="<?php echo base_url(). 'index.php/Dashboard/NonPeraturan'; ?>"><i class="fa fa-university"></i>Non Peraturan</a>
            </li>
            <li>
                <a href="<?php echo base_url(). 'index.php/Dashboard/Slideshow'; ?>"><i class="fa fa-image"></i>Slide Show</a>
            </li>
            <li>
                <a href="<?php echo base_url(). 'index.php/Dashboard/Banner'; ?>"><i class="fa fa-image"></i>Banner</a>
            </li>
            <li>
                <a href="<?php echo base_url(). 'index.php/Dashboard/KontakMasuk'; ?>"><i class="fa fa-envelope"></i> Kontak Masuk</a>
            </li>
   </li>                
    </div> 
</nav>