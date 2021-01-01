<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengumuman</title>
    <link href="<?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/datepicker3.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/styles.css" rel="stylesheet">
    <!--Custom Font-->
    <link href="<?= base_url('assets/'); ?>https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body>

    <!--/.sidebar-->
    <?php $this->load->view('menu_siswa'); ?>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'page_siswa' ?>">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Pengumuman</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="container">
            <?php
            function limit_words($string, $word_limit)
            {
                $words = explode(" ", $string);
                return implode(" ", array_splice($words, 0, $word_limit));
            }
            foreach ($data->result_array() as $i) :
                $id = $i['id_pengumuman'];
                $judul = $i['judul_pengumuman'];
                $image = $i['image_pengumuman'];
                $isi = $i['isi_pengumuman'];
            ?>
                <div class="col-lg-11">
                    <h2><?php echo $judul; ?></h2>
                    <hr />
                    <img src="<?php echo base_url() . 'assets/images/' . $image; ?>">
                    <?php echo limit_words($isi, 30); ?><a href="<?php echo base_url() . 'page_siswa/pengumuman_view/' . $id; ?>"> Selengkapnya ></a>
                </div>
            <?php endforeach ?>
        </div>

    </div>
    <!--/.main-->

    <script src="<?= base_url('assets/'); ?>js/jquery-2.1.4.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/bootstrap-datepicker.js"></script>
    <script src="<?= base_url('assets/'); ?>js/custom.js"></script>
    <script>
        window.onload = function() {
            var chart1 = document.getElementById("line-chart").getContext("2d");
            window.myLine = new Chart(chart1).Line(lineChartData, {
                responsive: true,
                scaleLineColor: "rgba(0,0,0,.2)",
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleFontColor: "#c5c7cc"
            });
        };
    </script>

</body>

</html>