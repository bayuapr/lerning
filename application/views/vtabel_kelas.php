<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Kelas</title>
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
                <li><a href="<?php echo base_url() . 'index.php/page/tabel_kelas' ?>">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Kelas</li>
            </ol>
        </div>
    </div>


    <div class="container">
        <div class="col-sm-9 col-sm-offset-7 col-lg-12 col-lg-offset-1 main">
            <div class="row">
                <h1 class="page-header">Data
                    <small>Kalas</small>
                    <br />
                    <button class="btn btn-success" onclick="add_kelas()"><i class="glyphicon glyphicon-plus"></i> Tambah Kelas</button>
                    <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                    <br />

                </h1>
            </div>
            <div class="row">
                <div id="reload">
                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap modal -->
    <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Data Kelas</h3>
                </div>
                <div class="modal-body form">
                    <form action="#" id="form" class="form-horizontal">
                        <input type="hidden" value="" name="id_kelas" />
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Nama Kelas</label>
                                <div class="col-md-9">
                                    <input name="nama_kelas" placeholder="Nama Kelas" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->


    <script src="<?= base_url('assets/'); ?>js/jquery-2.1.4.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/') ?>Datatables/DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/') ?>Datatables/DataTables-1.10.20/js/dataTables.bootstrap.js"></script>
    <script type="text/javascript">
        var save_method; //for save method string
        var table;

        $(document).ready(function() {

            //datatables
            table = $('#table').DataTable({

                processing: true,
                serverSide: true,
                order: [],


                ajax: {
                    url: '<?php echo base_url('index.php/tabel_kelas/ajax_list') ?>',
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



        function add_kelas() {
            save_method = 'add';
            $('#form')[0].reset();
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();
            $('#modal_form').modal('show');
            $('.modal-title').text('Add kelas');
        }

        function edit_kelas(id) {
            save_method = 'update';
            $('#form')[0].reset();
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();

            //Ajax Load data from ajax
            $.ajax({
                url: "<?php echo base_url('tabel_kelas/ajax_edit') ?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {

                    $('[name="id_kelas"]').val(data.id_kelas);
                    $('[name="nama_kelas"]').val(data.nama_kelas);
                    $('#modal_form').modal('show');
                    $('.modal-title').text('Edit kelas');

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        }

        function reload_table() {
            table.ajax.reload(null, false);
        }

        function save() {
            $('#btnSave').text('saving...');
            $('#btnSave').attr('disabled', true);
            var url;

            if (save_method == 'add') {
                url = "<?php echo base_url('tabel_kelas/ajax_add') ?>";
            } else {
                url = "<?php echo base_url('tabel_kelas/ajax_update') ?>";
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

        function delete_kelas(id) {
            if (confirm('Anda yakin ingin menghapus data ?')) {

                $.ajax({
                    url: "<?php echo base_url('tabel_kelas/ajax_delete') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {

                        $('#modal_form').modal('hide');
                        reload_table();
                    },
                    error: function(jqXHR, textStatus, errorThrown, passwordStatus) {
                        alert('Error deleting data');
                    }
                });

            }
        }
    </script>



</body>

</html>