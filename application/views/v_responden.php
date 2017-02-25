    <section class="content">
      <!-- Default box -->
        <?php if ($this->session->flashdata('msg_success')) { ?>
            <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="glyphicon glyphicon-info-sign"></i> <?php echo $this->session->flashdata('msg_success');?>                  
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('message')) { ?>
            <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="glyphicon glyphicon-info-sign"></i> <?php echo $this->session->flashdata('message');?>                  
            </div>
        <?php } ?>
      <div class="box box-success">
        <div class="box-body no-padding">
        <table class="table table-hover table-condensed table-striped table-bordered">
                <thead>
                    <tr class="success">
                        <th class="text-center">No</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                    <tbody>
                        <?php 
                            $no=1;
                            if ($dataresponden) {
                            foreach ($dataresponden as $responden) {
                        ?>
                        <tr>
                            <td  align="center"><?php echo $no++; ?></td>                       
                            <td><?php echo $responden->username; ?></td>
                            <td align="center"><?php echo $responden->nama_pengguna; ?></td>
                            <td width="180px" align="center">
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit<?php echo $no; ?>">
                                <i class="glyphicon glyphicon-pencil"></i> Ubah
                                </button>                                
                                <!-- Modal Ganti Email -->
                                <div class="modal fade" id="edit<?php echo $no; ?>" tabindex="-1" role="dialog" aria-labelledby="labeledit<?php echo $no; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="labeledit<?php echo $no; ?>">Ubah</h4>
                                            </div>
                                        <div class="modal-body">
                                        <form class="form-horizontal" role="form"  action="<?php echo site_url('responden/ubah');?>" method="post">
                                        <div class="form-group">
                                            <input type="hidden" name="usernamelama" id="usernamelama" value="<?php echo $responden->username; ?>" required>
                                        </div>
                                        <div class="form-group">
                                              <label for="username" class="col-sm-3 control-label">Username</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="usernamebaru" class="form-control" id="usernamebaru" value="<?php echo $responden->username; ?>" required>                                              
                                            </div>
                                        </div>
                                        <div class="form-group">
                                              <label for="nama" class="col-sm-3 control-label">Nama</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nama_pengguna" class="form-control" id="nama_pengguna" value="<?php echo $responden->nama_pengguna; ?>" required>
                                            </div>
                                          </div>
                                        </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                                <button type="button" class="btn pull-left btn-warning" data-dismiss="modal" data-toggle="modal" data-target="#password<?php echo $no; ?>"><i class="glyphicon glyphicon-lock"></i> Ubah Password</button>
                                                <button type="submit" class="btn btn-info" name='simpan' value='simpan'><i class="glyphicon glyphicon-pencil"></i> Ubah</button>
                                       </form>
                                         </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <!-- Modal Ganti Password -->
                                <div class="modal fade" id="password<?php echo $no; ?>" tabindex="-1" role="dialog" aria-labelledby="labelpassword<?php echo $no; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="labelpassword<?php echo $no; ?>">Ubah Password</h4>
                                            </div>
                                            <div class="modal-body">
                                        <form class="form-horizontal" role="form"  action="<?php echo site_url('responden/ubah_password');?>" method="post">
                                        <div class="form-group">
                                            <input type="hidden" name="username" id="username" value="<?php echo $responden->username; ?>" required>
                                        </div>
                                       <div class="form-group" align="left">
                                          <label for="passwordbaru" class="col-sm-3 control-label">Password Baru</label>
                                            <div class="col-sm-8">
                                              <input type="password" name="passwordbaru" class="form-control" id="passwordbaru" placeholder="Masukan Password Baru" required>
                                                <small class="text-muted"><i class="glyphicon glyphicon-info-sign"></i> Masukan kombinasi antara 6-12 karakter.</small>
                                            </div>                        
                                          </div>
                                       <div class="form-group">
                                          <label for="passwordbaru2" class="col-sm-3 control-label"></label>
                                            <div class="col-sm-8">
                                              <input type="password" name="passwordbaru2" class="form-control" id="passwordbaru2" placeholder="Masukan Kembali Password baru" required>
                                            </div>                        
                                          </div>
                                        </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-warning" name='simpan' value='simpan'><i class="glyphicon glyphicon-lock"></i> Ubah Password</button>
                                       </form>
                                         </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->   

                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?php echo $no; ?>">
                                <i class="glyphicon glyphicon-remove"></i> Hapus
                                </button>                     
                                <!-- Modal suspend -->
                                <div class="modal fade" id="hapus<?php echo $no; ?>" tabindex="-1" role="dialog" aria-labelledby="labelhapus<?php echo $no; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="labelhapus<?php echo $no; ?>">Hapus</h4>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo form_open('responden/hapus/');  
                                                echo form_hidden('username', $responden->username);
                                                ?>                                                
                                                Anda ingin menghapus <strong><?php echo $responden->username; ?></strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger" name='simpan' value='simpan'><i class="glyphicon glyphicon-remove"></i> Hapus</button>
                                                <?php echo form_close() ?>
                                            </div>
                                         </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </td>
                        </tr>
                        <?php }
                        } ?>
                        <tr>
                            <td colspan="4">
                                <a href="<?php echo site_url('responden/tambah'); ?>" class="btn btn-success pull-right"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
                            </td>
                        </tr>
                    </tbody>
            </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      <?php if ($dataresponden) { ?>
        <div class="clearfix text-center">
            <ul class="pagination pagination-md no-margin">
                <?php
                    echo $this->pagination->create_links();
                ?>
            </ul>
        </div>
        <?php 
            }
         ?>
    </section>
    <!-- /.content