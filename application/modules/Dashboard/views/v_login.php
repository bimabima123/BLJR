<!DOCTYPE html>
<html>
<?php include ('include/head.php'); ?>
<body style="background-color:#e0e0e0;">
	<div class="position">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
			<p class="warlogin">Administrator</p>
			<div class="panel panel-default">
			  <div class="panel-body">
			    <form class="col-md-12" action="<?php echo base_url('index.php/Dashboard/Login/aksi_login');?>" method="post">
			    <?php if($this->session->flashdata('message') == TRUE) { ?>
			  		<div class="alert alert-danger alert-dismissible" role="alert">
			  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $this->session->flashdata('message'); ?></div>
			    <?php }else{ ?> 

			    <p style="text-align:center;color:grey;">Sign in to start your session Administrator</p>
			    <?php } ?>
			    <div class="input-group">
				  <span class="input-group-addon" id="sizing-addon2"><i class="fa fa-user"></i></span>
				  <input type="text" class="form-control" name="username" placeholder="Masukan Username" aria-describedby="sizing-addon2">
				</div><br>
				<div class="input-group">
				  <span class="input-group-addon" id="sizing-addon2"><i class="fa fa-lock"></i></span>
				  <input type="password" class="form-control" name="password" placeholder="Masukan Password" aria-describedby="sizing-addon2">
				</div><br>
				  <button class="btn btn-primary" name="login">LOGIN &raquo;</button>
				</form>
				  </div>
			  </div>
			  <p style="text-align:center;">- CopyRight &copy; 2017. All Right Recevied. -</p>
			</div>
		</div>
		</div>
	</div>
	</div>
   <?php include('include/script.php') ?>
</body>
</html>