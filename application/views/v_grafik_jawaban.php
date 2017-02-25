<p>Judul Kuisioner : <?php echo $datakuisioner[0]->nama_kuisioner; ?></p>
<p>Pertanyaan : <?php echo $datapertanyaan[0]->pertanyaan; ?></p>	
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Grafik
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="morris-bar-chart"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <a href="<?php echo site_url('pertanyaan/'); ?>" class="btn btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Kembali</a>                    
        <script type="text/javascript">
        $(function() {
            new Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: '5 Point',
            a: <?php if(isset($datajawaban_5[0])){ echo $datajawaban_5[0]->jumlah; }else{echo 0; } ?>
        }, {
            y: '4 Point',
            a: <?php if(isset($datajawaban_4[0])){ echo $datajawaban_4[0]->jumlah; }else{echo 0; } ?>
        }, {
            y: '3 Point',
            a: <?php if(isset($datajawaban_3[0])){ echo $datajawaban_3[0]->jumlah; }else{echo 0; } ?>
        }, {
            y: '2 Point',
            a: <?php if(isset($datajawaban_2[0])){ echo $datajawaban_2[0]->jumlah; }else{echo 0; } ?>
        }, {
            y: '1 Point',
            a: <?php if(isset($datajawaban_1[0])){ echo $datajawaban_1[0]->jumlah; }else{echo 0; } ?>
        }],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Series A'],
        hideHover: 'auto',
        resize: true
    });
        });
    </script>