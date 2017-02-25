<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="panel panel-default">
            <div class="panel-heading">
              <i class="glyphicon glyphicon-plus"></i>
            </div>
            <!-- /.panel-header -->
            <div class="panel-body">
            <!-- form start -->
            <form class="form-horizontal" role="form" action="<?php echo site_url('responden/tambah_responden');?>" method="post">
                <?php if (validation_errors()) {?>
                    <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo validation_errors();?>
                  </div>
                <?php } ?>                
                <div class="form-group">
                <label for="username" class="col-sm-3 control-label">Username</label>
                  <div class="col-sm-7">
                    <input type="username" name="username" class="form-control" id="username" placeholder="username" value="<?php echo set_value('username'); ?>" required autofocus>
                  </div>
                </div>                
                <div class="form-group">
                <label for="password" class="col-sm-3 control-label">Password</label>
                  <div class="col-sm-7">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Masukan Password" maxlength="12" value="<?php echo set_value('password'); ?>" required>                    
                    <small class="text-muted"><i class="glyphicon glyphicon-info-sign"></i> Masukan kombinasi antara 6-12 karakter.</small>
                  </div>
                </div>
                <div class="form-group">
                <label for="password" class="col-sm-3 control-label"></label>
                  <div class="col-sm-7">
                    <input type="password" name="passwordconf" class="form-control" id="passwordconf" placeholder="Masukan Kembali Password" maxlength="12" value="<?php echo set_value('passwordconf'); ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="nama_pengguna" class="col-sm-3 control-label">Nama</label>
                  <div class="col-sm-7">
                    <input type="text" name="nama_pengguna" class="form-control" id="nama_pengguna" placeholder="Nama" value="<?php echo set_value('nama_pengguna'); ?>" required>
                  </div>
                </div>
                  <button type="submit" class="btn btn-success pull-right"><i class="glyphicon glyphicon-plus"></i> Tambah</button>
                </form>
          </div>
          <!-- /.panel -->
        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->