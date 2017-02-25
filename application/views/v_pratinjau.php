		<?php if ($this->session->flashdata('msg_success')) { ?>
            <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="glyphicon glyphicon-info-sign"></i> <?php echo $this->session->flashdata('msg_success');?>                  
            </div>
        <?php } ?>
        <?php if (validation_errors()) {?>
            <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo validation_errors();?>
            </div>
         <?php } ?> 
<div class="row">
			<?php 
                if ($datakuisioner) {
                	foreach ($datakuisioner as $kuisioner) {
            ?>
                <div class="panel panel-default">
		            <div class="panel-heading">
		                Id Kuisioner : <?php echo $kuisioner->id_kuisioner; ?>
		            </div>
		            <div class="panel-body">
		                <p><b><?php echo $kuisioner->nama_kuisioner; ?></b></p>
                        <?php if ($kuisioner->publish==1) { ?>
                            <p>Jumlah pertanyaan : <b class="text-primary">
                            <?php foreach ($datajumlahpertanyaan as $jumlahpertanyaan) { 
                                if($jumlahpertanyaan->id_kuisioner==$kuisioner->id_kuisioner){
                                    echo $jumlahpertanyaan->jumlah;
                                } 
                            } ?></b> | Jumlah responden : <b class="text-primary">
                            <?php if ($datajumlahresponden) {
                                    foreach ($datajumlahresponden as $jumlahresponden) {
                                        if($jumlahresponden->id_kuisioner==$kuisioner->id_kuisioner){
                                            echo $jumlahresponden->jumlah;
                                        }
                                    }
                                } ?></b> | Status : <b class="text-primary">Kuisioner dibuka</b></p>
                        <?php }else if($kuisioner->publish==2){ ?>
                            <p>Jumlah pertanyaan : <b class="text-primary">
                            <?php foreach ($datajumlahpertanyaan as $jumlahpertanyaan) { 
                                if($jumlahpertanyaan->id_kuisioner==$kuisioner->id_kuisioner){
                                    echo $jumlahpertanyaan->jumlah;
                                    } 
                                } ?></b> | Jumlah responden : <b class="text-primary">
                            <?php if ($datajumlahresponden) {
                                    foreach ($datajumlahresponden as $jumlahresponden) {
                                        if($jumlahresponden->id_kuisioner==$kuisioner->id_kuisioner){
                                            echo $jumlahresponden->jumlah;
                                        }
                                    }
                                } ?></b> | Status : <b class="text-danger">Kuisioner ditutup</b></p> 
                        <?php }else{ ?>
                            <p>Jumlah pertanyaan : <b class="text-primary">
                            <?php 
                            if (isset($datajumlahpertanyaan)) {
                               foreach ($datajumlahpertanyaan as $jumlahpertanyaan) { 
                                if($jumlahpertanyaan->id_kuisioner==$kuisioner->id_kuisioner){
                                    echo $jumlahpertanyaan->jumlah;
                                    } 
                                }
                            }
                             ?></b> | Status : <b class="text-muted">Belum dipublikasi</b></p>
                        <?php } ?>
                        <a href="<?php echo site_url('pratinjau/daftar_pertanyaan/'.$kuisioner->id_kuisioner); ?>" class="btn btn-default"><i class="glyphicon glyphicon-question-sign"></i> Daftar Pertanyaan</a>
		                <button class="btn btn-info" data-toggle="modal" data-target="#edit<?php echo $kuisioner->id_kuisioner; ?>">
						    <i class="glyphicon glyphicon-pencil"></i> Edit
						</button>                     
						<!-- Modal edit -->
						<div class="modal fade" id="edit<?php echo $kuisioner->id_kuisioner; ?>" tabindex="-1" role="dialog" aria-labelledby="labeledit<?php echo $kuisioner->id_kuisioner; ?>" aria-hidden="true">
						    <div class="modal-dialog">
						        <div class="modal-content">
						            <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							                <h4 class="modal-title" id="labeledit<?php echo $kuisioner->id_kuisioner; ?>">Edit Kuisioner</h4>
						            </div>
						                <div class="modal-body">
						                    <form class="form-horizontal" role="form"  action="<?php echo site_url('pratinjau/edit_kuisioner');?>" method="post">
						                    <div class="form-group">
	                                            <input type="hidden" name="id_kuisioner" id="id_kuisioner" value="<?php echo $kuisioner->id_kuisioner; ?>" required>
	                                        </div>
						                    <div class="form-group">
												<label for="nama" class="col-sm-3 control-label">Nama</label>
						                    	<div class="col-sm-8">
						                            <input type="text" name="nama_kuisioner" class="form-control" id="nama_kuisioner" value="<?php echo $kuisioner->nama_kuisioner; ?>" required>
											    </div>
										    </div>                                                
						        	    </div>
						                <div class="modal-footer">
						                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
						                    <button type="submit" class="btn btn-info" name='simpan' value='simpan'><i class="glyphicon glyphicon-pencil"></i> Edit</button>
						                    </form>
							        	</div>
						         </div><!-- /.modal-content -->
						    </div><!-- /.modal-dialog -->
						</div><!-- /.modal -->

                        <?php if ($kuisioner->publish==0) { ?>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#publikasi<?php echo $kuisioner->id_kuisioner; ?>">
                                <i class="glyphicon glyphicon-send"></i> Publikasikan
                                </button>                     
                                <!-- Modal suspend -->
                                <div class="modal fade" id="publikasi<?php echo $kuisioner->id_kuisioner; ?>" tabindex="-1" role="dialog" aria-labelledby="labelpublikasi<?php echo $kuisioner->id_kuisioner; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="labelpublikasi<?php echo $kuisioner->id_kuisioner; ?>">Publikasikan</h4>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo form_open('pratinjau/publikasi_kuisioner/');  
                                                echo form_hidden('id_kuisioner', $kuisioner->id_kuisioner);
                                                ?>                                                
                                                <p align="center">Kuisioner tidak bisa diubah detelah di publikasi, Anda ingin mempublikasikan <strong><?php echo $kuisioner->nama_kuisioner; ?></strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary" name='simpan' value='simpan'><i class="glyphicon glyphicon-send"></i> Publikasikan</button>
                                                <?php echo form_close() ?>
                                            </div>
                                         </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                <?php    } ?>
                <?php if ($kuisioner->publish==1) { ?>
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#publikasi<?php echo $kuisioner->id_kuisioner; ?>">
                                <i class="glyphicon glyphicon-ban-circle"></i> Hentikan Kuisioner
                                </button>                     
                                <!-- Modal suspend -->
                                <div class="modal fade" id="publikasi<?php echo $kuisioner->id_kuisioner; ?>" tabindex="-1" role="dialog" aria-labelledby="labelpublikasi<?php echo $kuisioner->id_kuisioner; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="labelpublikasi<?php echo $kuisioner->id_kuisioner; ?>">Hentikan</h4>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo form_open('pratinjau/hentikan_kuisioner/');  
                                                echo form_hidden('id_kuisioner', $kuisioner->id_kuisioner);
                                                ?>                                                
                                                <p align="center">Responden tidak akan bisa mengisi kuisioner ini, Apakah anda ingin menghentikan kuisioner <strong><?php echo $kuisioner->nama_kuisioner; ?></strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-warning" name='simpan' value='simpan'><i class="glyphicon glyphicon-ban-circle"></i> Hentikan</button>
                                                <?php echo form_close() ?>
                                            </div>
                                         </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                <?php    } ?>    
						<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?php echo $kuisioner->id_kuisioner; ?>">
                                <i class="glyphicon glyphicon-remove"></i> Hapus
                                </button>                     
                                <!-- Modal suspend -->
                                <div class="modal fade" id="hapus<?php echo $kuisioner->id_kuisioner; ?>" tabindex="-1" role="dialog" aria-labelledby="labelhapus<?php echo $kuisioner->id_kuisioner; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="labelhapus<?php echo $kuisioner->id_kuisioner; ?>">Hapus</h4>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo form_open('pratinjau/hapus_kuisioner/');  
                                                echo form_hidden('id_kuisioner', $kuisioner->id_kuisioner);
                                                ?>                                                
                                                <p align="center">Anda ingin menghapus <strong><?php echo $kuisioner->nama_kuisioner; ?></strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger" name='simpan' value='simpan'><i class="glyphicon glyphicon-remove"></i> Hapus</button>
                                                <?php echo form_close() ?>
                                            </div>
                                         </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
		            </div>
		        </div>  
            <?php 	}
            	} ?>
</div>
<button class="btn btn-success pull-right" data-toggle="modal" data-target="#tambah">
    <i class="glyphicon glyphicon-plus"></i> Tambah
</button>                     
<!-- Modal tambah -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="labeltambah" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                <h4 class="modal-title" id="labeltambah">Tambah Kuisioner</h4>
            </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form"  action="<?php echo site_url('pratinjau/tambah_kuisioner');?>" method="post">
                    <div class="form-group">
						<label for="nama" class="col-sm-3 control-label">Nama</label>
                    	<div class="col-sm-8">
                            <input type="text" name="nama_kuisioner" class="form-control" id="nama_kuisioner" required>
					    </div>
				    </div>                                                
        	    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success" name='simpan' value='simpan'><i class="glyphicon glyphicon-plus"></i> Tambah</button>
                    </form>
	        	</div>
         </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php if ($datakuisioner) { ?>
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