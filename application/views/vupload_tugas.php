<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload Tugas</title>
    <link href="<?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/datepicker3.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/styles.css" rel="stylesheet">
</head>

<body>
    <?php $this->load->view('menu_siswa'); ?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'page_siswa/upload_tugas' ?>">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Upload Tugas</li>
            </ol>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-sm-9 col-sm-offset-3 col-lg-8 col-lg-offset-2 main">
                <h1 class="page-header">Upload
                    <small>Tugas</small></h1>
                <?php echo $this->session->flashdata('massage'); ?>
                <form action="<?php echo base_url() . 'tugas_masuk/simpan_tugas' ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Judul tugas</label>
                        <input type="text" class="form-control" name="judul" placeholder="Judul tugas" required>
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <select class="form-control" name="kelas_id" id="kelas" required>
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
                    <button class="btn btn-success" type="submit">Save tugas</button>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/'); ?>js/jquery-2.1.4.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/') ?>Datatables/DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/') ?>Datatables/DataTables-1.10.20/js/dataTables.bootstrap.js"></script>
    <script src="<?= base_url('assets/') ?>js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {});
    </script>
</body>

</html>