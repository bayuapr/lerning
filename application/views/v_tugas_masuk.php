<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tugas Masuk</title>
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
                <li><a href="<?php echo base_url() . 'page/' ?>">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Lists Tugas Masuk</li>
            </ol>
        </div>
    </div>

    <div class="container">

        <div class="row justify-content-md-center">
            <div class="col-sm-32 col-sm-offset-0 col-lg-12 col-lg-offset-1 main">
                <h1 class="page-header">Lists
                    <small>Tugas Masuk</small></h1>
                <hr />
                <table class="table table-striped" id="mytable" style="font-size: 14px;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>File Tugas</th>
                            <th>Kelas</th>
                            <th>Tanggal Upload</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($instgs->result() as $row) :
                            $no++;
                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $row->judul; ?></td>
                                <td><?php echo $row->file; ?></td>
                                <td><?php echo $row->nama_kelas; ?></td>
                                <td><?php echo $row->tgl_upload; ?></td>
                                <td>
                                    <a href="<?php echo base_url('tugas_masuk/download/' . $row->id_instgs); ?>" class="btn btn-primary">Download</a>
                                </td>
                                <td>
                                    <a href="<?php echo base_url('tugas_masuk/delete/' . $row->id_instgs); ?>" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr> <?php endforeach; ?> </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/'); ?>js/jquery-2.1.4.min.js">
    </script>
    <script src="<?= base_url('assets/'); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/') ?>Datatables/DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/') ?>Datatables/DataTables-1.10.20/js/dataTables.bootstrap.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('table.display').DataTable();
        });
    </script>
</body>

</html>