<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Materi</title>
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
                <li><a href="<?php echo base_url() . 'page/tambah_materi' ?>">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Tambah Materi</li>
            </ol>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-sm-9 col-sm-offset-3 col-lg-8 col-lg-offset-2 main">
                <h1 class="page-header">Tambah
                    <small>Materi</small></h1>
                <?php echo $this->session->flashdata('massage'); ?>
                <form action="<?php echo base_url() . 'materi/simpan_materi' ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Judul Materi</label>
                        <input type="text" class="form-control" name="judul_materi" placeholder="Judul Materi" required>
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <select class="form-control" name="materi_kelas_id" id="kelas" required>
                            <option value="">No Selected</option>
                            <?php foreach ($kelas as $row) : ?>
                                <option value="<?php echo $row->id_kelas; ?>"><?php echo $row->nama_kelas; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>file</label>
                        <input type="file" name="filefoto" required><br>
                    </div>
                    <button class="btn btn-success" type="submit">Save Materi</button>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/'); ?>js/jquery-2.1.4.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/') ?>Datatables/DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/') ?>Datatables/DataTables-1.10.20/js/dataTables.bootstrap.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>
</body>

</html>