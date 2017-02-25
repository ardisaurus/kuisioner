<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">    
    <title>Kuisioner | <?php echo $title; ?></title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <style type='text/css'>
		body {
  		padding-top: 30px;
		}
		.starter-template {
  		padding: 10px 0px;
  		text-align: left;
		}

	    .putih{
	      color: #FFFFFF;
	    }
	</style>
  </head>
  <body>  
  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#"><i class="glyphicon glyphicon-screenshot"></i> Kuisioner</a>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="starter-template">
  <h2><?php echo $title; ?></h2>
  <!-- =============================================== -->
  <?php if (validation_errors()) {?>
    <div class="alert alert-danger">
      <?php echo validation_errors();?>
    </div>
  <?php } ?>
  <?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-danger">
      <i class="glyphicon glyphicon-remove"></i> <?php echo $this->session->flashdata('message');?>                  
    </div>
  <?php } ?>
  <?php echo form_open('login/proses', 'class="form-horizontal"');?>

  <div class="row col-sm-5">    
    <div class="panel panel-default">
            <div class="panel-heading">
                Selamat datang, Silahkan login untuk melanjutkan.
            </div>
            <div class="panel-body">  
              <div class="form-group">
                  <label for="username" class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control required" id="username" name='username' placeholder="Id Pengguna">
                  </div>
              </div>
              <div class="form-group">
                  <label for="password" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control required" id="password" name='password' placeholder="Password">
                  </div>
              </div>
                  <?php echo form_submit('submit','Masuk', 'class="btn btn-primary btn-block"');?>
                  <?php
                  echo form_close();
                  ?>
              </div>
      </div>
  </div>

  <!-- =============================================== -->
  </div>
    </div><!-- /.container --></div>

    <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <!-- Angular.js Core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/angular.min.js'); ?>"></script>
  </body>
</html>