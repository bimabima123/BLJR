<nav class="navbar navbar-default navbar-cls-top navbar-fixed-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url(); ?>index.php/Dashboard/Welcome">Administator</a> 
    </div>
    <div style="color: white;padding: 15px 50px 5px 50px;float: right;font-size: 16px;">

        <div class="btn-group" style="margin-top:-1%;">
        
        <a href="!#" class=""  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-right:5px;text-decoration:none;color:white;" title="Pemberitahuan">
        <i id="notifi" class="fa fa-bell" style="color:white;"></i>
        <p style="position:absolute;margin-top:-25px;margin-left:15px;font-size:8pt;" id="value"></p>
        &nbsp;Pemberitahuan
        </a>

        <ul class="dropdown-menu" style="padding:2px;">
             <a href="<?php echo base_url(); ?>index.php/Dashboard/KontakMasuk" style="text-decoration:none;"><li class="list-group-item" style="color:black;" id="isi"></li></a>
        </ul>
        </div>
        <i class="fa fa-user"></i>&nbsp;Login as, <?php echo $this->session->userdata('level_akses'); ?>&nbsp;
        <a href="<?php echo base_url('index.php/Dashboard/login/logout'); ?>" class="btn btn-danger square-btn-adjust" >Sign Out</a>
    </div>
</nav> 