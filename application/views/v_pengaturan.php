      <?php if ($this->session->flashdata('message')) { ?>
                  <div class="alert alert-warning">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="glyphicon glyphicon-exclamation-sign"></i> <?php echo $this->session->flashdata('message');?>                  
                  </div>
                <?php } ?> 
      <h4><i class="glyphicon glyphicon-check"></i> Akun</h4>
      	<table class="table table-condensed">
      		<tr>
      		<td>username : <?php foreach ($userdetail as $detail) {echo $detail->username;} ?></td>
      		<td>
	      		<div align="right"> 
		      		<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#username">
		            	<i class="glyphicon glyphicon-user"></i> Ubah username
		            </button>
                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#password">
                  <i class="glyphicon glyphicon-lock"></i> Ubah Password 
                </button>
          <?php if(count($admin_num)>1){ ?>
                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus">
                  <i class="glyphicon glyphicon-remove"></i> Hapus Akun
                </button>
          <?php } ?>
	      		</div>
                <!-- Modal Ganti username -->
                <div class="modal fade" id="username" tabindex="-1" role="dialog" aria-labelledby="labelusername" aria-hidden="true">
                    <div class="modal-dialog">
	                    <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labelusername">Ubah username</h4>
                            </div>
                            <div class="modal-body">
				                <form class="form-horizontal" role="form"  action="<?php echo site_url('pengaturan/ubahusername');?>" method="post">
				                <div class="form-group">
                              <label for="usernamebaru" class="col-sm-3 control-label">Username Baru</label>
					                  <div class="col-sm-8">
					                    <input type="username" name="usernamebaru" class="form-control" id="usernamebaru" placeholder="Masukan username Baru" required>
					                  </div>
					                </div>
				                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" name='simpan' value='simpan'>Ubah username</button>
             					 </form>
 	                       </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <!-- Modal Ganti Password -->
                <div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="labelpassword" aria-hidden="true">
                    <div class="modal-dialog">
	                    <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labelpassword">Ubah Password</h4>
                            </div>
                            <div class="modal-body">
				                <form class="form-horizontal" role="form"  action="<?php echo site_url('pengaturan/ubahpassword');?>" method="post">
				                <div class="form-group">
                          <label for="passwordlama" class="col-sm-3 control-label">Password Lama</label>
					                  <div class="col-sm-8">
					                    <input type="password" name="passwordlama" class="form-control" id="passwordlama" placeholder="Masukan Password Lama" required>
					                  </div>					              
					                </div>
					             <div class="form-group">
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
                                <button type="submit" class="btn btn-primary" name='simpan' value='simpan'>Ubah Password</button>
             					 </form>
 	                       </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <!-- Modal Ganti Password -->
                <div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="labelhapus" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labelhapus">Hapus Akun</h4>
                            </div>
                            <div class="modal-body">
                            <p align="center">
                        Masukan password untuk menghapus akun!</p>
                        <form class="form-horizontal" role="form"  action="<?php echo site_url('pengaturan/hapus');?>" method="post">
                        <div class="form-group">
                          <label for="passwordlama" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-8">
                              <input type="password" name="passwordlama" class="form-control" id="passwordlama" placeholder="Masukan Password" required>
                            </div>                        
                          </div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger" name='simpan' value='simpan'>Hapus</button>
                       </form>
                         </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->                
      		</td>
      	</tr>
      	</table>
      	<h4><i class="glyphicon glyphicon-edit"></i> Data Pengguna</h4>
      	<table class="table table-condensed">
      		<tr>
      		<td>Nama : <?php foreach ($userdetail as $detail) {echo $detail->nama_pengguna;} ?></td>
      		<td>
	      		<div align="right"> 
		      		<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#nama_pengguna">
		            	<i class="glyphicon glyphicon-pencil"></i> Ubah Nama
		            </button>
	      		</div>
                <!-- Modal ganti nama_pengguna -->
                <div class="modal fade" id="nama_pengguna" tabindex="-1" role="dialog" aria-labelledby="labelnama_pengguna" aria-hidden="true">
                    <div class="modal-dialog">
	                    <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="labelnama_pengguna">Ubah Nama</h4>
                            </div>
                            <div class="modal-body">
				                <form class="form-horizontal" role="form"  action="<?php echo site_url('pengaturan/ubahnama_pengguna');?>" method="post">
				                <div class="form-group">
                          <label for="nama_pengguna" class="col-sm-3 control-label">Nama Baru</label>
					                  <div class="col-sm-8">
					                    <input type="text" name="nama_pengguna" class="form-control" id="nama_pengguna" placeholder="Masukan Nama Baru" required>
					                  </div>
					                </div>
				                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" name='simpan' value='simpan'>Ubah Nama</button>
             					 </form>
 	                       </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
      		</td>
      	</tr>
      	</table>