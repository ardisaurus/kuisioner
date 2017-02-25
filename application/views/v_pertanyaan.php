<p>Judul Kuisioner : <?php echo $datakuisioner[0]->nama_kuisioner; $publish=$datakuisioner[0]->publish; ?></p>
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
                if ($datapertanyaan) {
                	foreach ($datapertanyaan as $pertanyaan) {
            ?>
                <div class="panel panel-default">
		            <div class="panel-heading">
		                Id Pertanyaan : <?php echo $pertanyaan->id_pertanyaan; ?>                         
		            </div>
		            <div class="panel-body">
		                <p><b><?php echo $pertanyaan->pertanyaan; ?></b></p>
                        <?php if (isset($datajawaban) ) { 
                            if ($publish==1 OR $publish==2) { ?>
                        <p>
                            <?php foreach ($datajawaban as $jawaban) {
                                if ($jawaban->id_pertanyaan==$pertanyaan->id_pertanyaan) {
                                    echo "Jumlah Point : ".$jawaban->jumlah;
                                }
                            } ?>
                        </p>
                        <?php }
                            }
                         ?>
                        <?php if ($publish==0) { ?>
                        <button class="btn btn-info" data-toggle="modal" data-target="#edit<?php echo $pertanyaan->id_pertanyaan; ?>">
                            <i class="glyphicon glyphicon-pencil"></i> Edit
                        </button>                     
                        <!-- Modal edit -->
                        <div class="modal fade" id="edit<?php echo $pertanyaan->id_pertanyaan; ?>" tabindex="-1" role="dialog" aria-labelledby="labeledit<?php echo $pertanyaan->id_pertanyaan; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="labeledit<?php echo $pertanyaan->id_pertanyaan; ?>">Edit pertanyaan</h4>
                                    </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" role="form"  action="<?php echo site_url('pertanyaan/edit_pertanyaan');?>" method="post">
                                            <div class="form-group">
                                                <input type="hidden" name="id_pertanyaan" id="id_pertanyaan" value="<?php echo $pertanyaan->id_pertanyaan; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama" class="col-sm-3 control-label">Pertanyaan</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="pertanyaan" class="form-control" id="pertanyaan" value="<?php echo $pertanyaan->pertanyaan; ?>" required>
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
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?php echo $pertanyaan->id_pertanyaan; ?>">
                                <i class="glyphicon glyphicon-remove"></i> Hapus
                                </button>                     
                                <!-- Modal suspend -->
                                <div class="modal fade" id="hapus<?php echo $pertanyaan->id_pertanyaan; ?>" tabindex="-1" role="dialog" aria-labelledby="labelhapus<?php echo $pertanyaan->id_pertanyaan; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="labelhapus<?php echo $pertanyaan->id_pertanyaan; ?>">Hapus</h4>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo form_open('pertanyaan/hapus_pertanyaan/');  
                                                echo form_hidden('id_pertanyaan', $pertanyaan->id_pertanyaan);
                                                ?>                                                
                                                <p align="center">Anda ingin menghapus pertanyaan <?php echo $pertanyaan->id_pertanyaan; ?>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger" name='simpan' value='simpan'><i class="glyphicon glyphicon-remove"></i> Hapus</button>
                                                <?php echo form_close() ?>
                                            </div>
                                         </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                    <?php }else{ ?>	
                        <a href="<?php echo site_url('pertanyaan/grafik_jawaban/'.$pertanyaan->id_pertanyaan); ?>" class="btn btn-default"><i class="glyphicon glyphicon-stats"></i> Grafik</a>
                    <?php } ?>	                
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
	                <h4 class="modal-title" id="labeltambah">Tambah Pertanyaan</h4>
            </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form"  action="<?php echo site_url('pertanyaan/tambah_pertanyaan');?>" method="post">
                    <div class="form-group">
						<label for="nama" class="col-sm-3 control-label">Nama</label>
                    	<div class="col-sm-8">
                            <input type="text" name="pertanyaan" class="form-control" id="pertanyaan" required>
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
<?php if ($datapertanyaan) { ?>
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