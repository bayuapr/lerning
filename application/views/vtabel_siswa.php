<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Siswa</title>
    <link href="<?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/datepicker3.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/styles.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?> Datatables/DataTables-1.10.20/css/jquery.dataTables.css" rel="stylesheet" type="text/css">


    <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body>

    <?php $this->load->view('menu'); ?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'page/tabel_siswa' ?>">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Siswa</li>
            </ol>
        </div>
    </div>
    <!--/.row-->


    <!--/.row-->
    <div class="container">
        <div class="col-sm-9 col-sm-offset-7 col-lg-12 col-lg-offset-1 main">
            <div class="row">
                <h1 class="page-header">Data
                    <small>Siswa</small>
                    <br />
                    <button class="btn btn-success" onclick="add_siswa()"><i class="glyphicon glyphicon-plus"></i> Tambah Siswa</button>
                    <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                    <br />
                </h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="col-sm-9 col-sm-offset-7 col-lg-12 col-lg-offset-1 main">
            <form class="form-inline" method="post" id="import_form" enctype="multipart/form-data">
                <label>Pilih File Excel</label>
                <br />
                <input class="form-control" type="file" name="file" id="file" required accept=".xls, .xlsx" />
                <input type="submit" id="import" name="sumbit" value="Import" class="btn btn-info form-control" />
            </form>
            <br /> <br />
        </div>
    </div>

    <div class="container">
        <div class="col-sm-9 col-sm-offset-7 col-lg-12 col-lg-offset-1 main">
            <div class="row">
                <div id="reload">
                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Alamat</th>
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
                    <h3 class="modal-title">Data Pengajar</h3>
                </div>
                <div class="modal-body form">
                    <form action="#" id="form" class="form-horizontal">
                        <input type="hidden" value="" name="id_siswa" />
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Username</label>
                                <div class="col-md-9">
                                    <input name="username" placeholder="Username" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Nama</label>
                                <div class="col-md-9">
                                    <input name="nama" placeholder="Name" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Email</label>
                                <div class="col-md-9">
                                    <input name="email" placeholder="Email" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Password</label>
                                <div class="col-md-9">
                                    <input name="password" placeholder="Password" class="form-control" type="password">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Alamat</label>
                                <div class="col-md-9">
                                    <textarea name="alamat" placeholder="Alamat" class="form-control"></textarea>
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

                processing: true, //Feature control the processing indicator.
                serverSide: true, //Feature control DataTables' server-side processing mode.
                order: [], //Initial no order.

                // Load data for the table's content from an Ajax source
                ajax: {
                    url: '<?php echo base_url('index.php/tabel_siswa/ajax_list') ?>',
                    type: "POST"
                },

                //Set column definition initialisation properties.
                columnDefs: [{
                    targets: [-1], //last column
                    orderable: false, //set not orderable
                }, ],

            });



            //set input/textarea/select event when change value, remove class error and remove text help block 
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



        function add_siswa() {
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('Add siswa'); // Set Title to Bootstrap modal title
        }

        function edit_siswa(id) {
            save_method = 'update';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string

            //Ajax Load data from ajax
            $.ajax({
                url: "<?php echo base_url('index.php/tabel_siswa/ajax_edit') ?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {

                    $('[name="id_siswa"]').val(data.id_siswa);
                    $('[name="username"]').val(data.username);
                    $('[name="nama"]').val(data.nama);
                    $('[name="email"]').val(data.email);
                    $('[name="password"]').val(data.password);
                    $('[name="alamat"]').val(data.alamat);
                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit siswa'); // Set title to Bootstrap modal title

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        }

        function reload_table() {
            table.ajax.reload(null, false); //reload datatable ajax 
        }

        function save() {
            $('#btnSave').text('saving...'); //change button text
            $('#btnSave').attr('disabled', true); //set button disable 
            var url;

            if (save_method == 'add') {
                url = "<?php echo base_url('tabel_siswa/ajax_add') ?>";
            } else {
                url = "<?php echo base_url('tabel_siswa/ajax_update') ?>";
            }

            // ajax adding data to database
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data) {

                    if (data.status) //if success close modal and reload ajax table
                    {
                        $('#modal_form').modal('hide');
                        reload_table();
                    } else {
                        for (var i = 0; i < data.inputerror.length; i++) {
                            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
                    }
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled', false); //set button enable 


                },
                error: function(jqXHR, textStatus, errorThrown, passwordStatus) {
                    alert('Error adding / update data');
                    $('#btnSave').text('save'); //change button tpasswordStatusext
                    $('#btnSave').attr('disabled', false); //set button enable 

                }
            });
        }

        function delete_siswa(id) {
            if (confirm('Apakah anda yakin ingin menghapus data ini?')) {
                // ajax delete data to database
                $.ajax({
                    url: "<?php echo base_url('tabel_siswa/ajax_delete') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        //if success reload ajax table
                        $('#modal_form').modal('hide');
                        reload_table();
                    },
                    error: function(jqXHR, textStatus, errorThrown, passwordStatus) {
                        alert('Error deleting data');
                    }
                });

            }
        }

        $('#import_form').on('submit', function(event) {

            event.preventDefault();

            $.ajax({

                url: "<?php echo base_url('tabel_siswa/import') ?> ",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#file').val('');
                    load_data();
                    alert(data)
                }
            })
        });
    </script>



</body>

</html>