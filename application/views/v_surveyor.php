<!-- Main content -->
    <section class="content">
      <!-- Default box -->

        <?php if ($this->session->flashdata('msg_success')) { ?>
            <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="glyphicon glyphicon-info-sign"></i> <?php echo $this->session->flashdata('msg_success');?>                  
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
                    </tr>
                </thead>
                    <tbody>
                        <?php 
                            $no=1;
                            if ($dataadmin) {
                            foreach ($dataadmin as $admin) {
                        ?>
                        <tr>
                            <td  align="center"><?php echo $no++; ?></td>                       
                            <td><?php echo $admin->username; ?></td>
                            <td align="center"><?php echo $admin->nama_pengguna; ?></td>
                        </tr>
                        <?php }
                        } ?>
                        <tr>
                            <td colspan="3">
                                <a href="<?php echo site_url('surveyor/tambah'); ?>" class="btn btn-success pull-right"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
                            </td>
                        </tr>
                    </tbody>
            </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      <?php if ($dataadmin) { ?>
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
    <!-- /.content -->