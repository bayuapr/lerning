<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Pengumuman</title>
    <link href="<?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/datepicker3.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/styles.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?> Datatables/DataTables-1.10.20/css/jquery.dataTables.css" rel="stylesheet" type="text/css">

</head>

<body>

    <?php $this->load->view('menu'); ?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'page/tabel_pengumuman' ?>">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Data Pengumuman</li>
            </ol>
        </div>
    </div>
    <!--/.row-->


    <!--/.row-->
    <div class="container">
        <div class="col-sm-9 col-sm-offset-7 col-lg-12 col-lg-offset-1 main">
            <div class="row">
                <h1 class="page-header">Data
                    <small>Pengumuman</small>
                    <br />
                    <a class="btn btn-success" href="<?php echo base_url() . 'page/post_pengumuman' ?>"><i class="glyphicon glyphicon-plus"></i> Tambah Pengumuman</a>
                    <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                    <br />
                </h1>
            </div>
            <?php echo $this->session->flashdata('massage'); ?>
            <div class="row">
                <div id="reload">
                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Pengumuman</th>
                                <th> File Gambar</th>
                                <th>Tanggal Posting</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script src="<?= base_url('assets/'); ?>js/jquery-2.1.4.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/') ?>Datatables/DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/') ?>Datatables/DataTables-1.10.20/js/dataTables.bootstrap.js"></script>
    <script type="text/javascript">
        var save_method;
        var table;

        $(document).ready(function() {

            table = $('#table').DataTable({

                processing: true,
                serverSide: true,
                order: [],
                ajax: {
                    url: '<?php echo base_url('tabel_pengumuman/ajax_list') ?>',
                    type: "POST"
                },

                columnDefs: [{
                    targets: [-1],
                    orderable: false,
                }, ],
            });

            $("input").change(function() {
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("textarea").change(function() {
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("select").change(function() {
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });

        });

        function reload_table() {
            table.ajax.reload(null, false);
        }

        function save() {
            $('#btnSave').text('saving...');
            $('#btnSave').attr('disabled', true);
            var url;
            if (save_method == 'add') {
                url = "<?php echo base_url('tabel_pengumuman/ajax_add') ?>";
            } else {
                url = "<?php echo base_url('tabel_pengumuman/ajax_update') ?>";
            }


            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data) {
                    if (data.status) {
                        $('#modal_form').modal('hide');
                        reload_table();
                    } else {
                        for (var i = 0; i < data.inputerror.length; i++) {
                            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
                            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                        }
                    }
                    $('#btnSave').text('save');
                    $('#btnSave').attr('disabled', false);
                },
                error: function(jqXHR, textStatus, errorThrown, passwordStatus) {
                    alert('Error adding / update data');
                    $('#btnSave').text('save');
                    $('#btnSave').attr('disabled', false);

                }
            });
        }

        function delete_pengumuman(id) {
            if (confirm('Anda yakin ingin menghapus data ?')) {

                $.ajax({
                    url: "<?php echo base_url('tabel_pengumuman/ajax_delete') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {

                        $('#modal_form').modal('hide');
                        reload_table();
                    },
                    // error: function(jqXHR, textStatus, errorThrown, passwordStatus) {
                    //     alert('Error deleting data');
                    // }
                });

            }
        }
    </script>



</body>

</html>