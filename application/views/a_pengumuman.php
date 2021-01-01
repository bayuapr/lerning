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
    <?php $this->load->view('menu'); ?>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'index.php/page/data_pengumuman' ?>"><em class="fa fa-calendar">&nbsp;</em></a></li>
                <li class="active">Pengumuman</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Pengumuman</h1>
            </div>
        </div>
        <!--/.row-->


        <div class="rowr">
            <div class="col-lg-12">
                <h2>Selamat datang <?php echo $this->session->userdata('ses_nama'); ?></h2>
            </div>
        </div>

    </div>
    <!--/.main-->

    <script src="<?= base_url('assets/'); ?>js/jquery-1.11.1.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/chart.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/chart-data.js"></script>
    <script src="<?= base_url('assets/'); ?>js/easypiechart.js"></script>
    <script src="<?= base_url('assets/'); ?>js/easypiechart-data.js"></script>
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