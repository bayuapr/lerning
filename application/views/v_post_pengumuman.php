<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Post Pengumuman</title>
    <link href="<?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/datepicker3.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/styles.css" rel="stylesheet">
</head>

<body>
    <?php $this->load->view('menu'); ?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'page/post_pengumuman' ?>">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Pengumuman</li>
            </ol>
        </div>
    </div>

    <div class="container">
        <div class="col-sm-9 col-sm-offset-7 col-lg-12 col-lg-offset-1 main">
            <div class="row">
                <h1 class="page-header">Post
                    <small>Pengumuman</small>
                    <br /></h1>
                <?php echo $this->session->flashdata('massage'); ?>
                <form action="<?php echo base_url() . 'pengumuman/simpan_post' ?>" method="post" enctype="multipart/form-data">
                    <input type="text" name="judul_pengumuman" class="form-control" placeholder="Judul Pengumuman" required /><br />
                    <textarea id="ckeditor" name="isi_pengumuman" class="form-control" required></textarea><br />
                    <input type="file" name="filefoto" required><br>
                    <button class="btn btn-primary " type="submit">Post Pengumuman</button>
                    <button type="reset" class="btn btn-md btn-warning">reset</button>
                </form>
                <br />
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/'); ?>js/jquery-2.1.4.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        $(function() {
            CKEDITOR.replace('ckeditor');
        });
    </script>
</body>

</html>