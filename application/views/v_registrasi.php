<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi</title>
    <link href="<?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/datepicker3.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/styles.css" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <div class="pull-left"><img src="<?php echo base_url(); ?>assets/image/logo-logic.png" class="img-responsive" alt="" width="350px"></div>
                <br />
                <div class="pull-right"><a href="<?php echo base_url() . 'login_siswa/' ?>" class="btn btn-primary"><span></span> Login</a></div>
            </div>
        </div>
    </nav>
    </br>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4 mx-auto">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">Silahkan registrasi</div>
                <div class="panel-body">
                    <?php echo $this->session->flashdata('massage'); ?>
                    <form role="form" class="user" method="post" action="<?php echo base_url() . 'index.php/registrasi/auth_registrasi/' ?> ">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" name="username" type="text" autofocus="" id="username" value="<?= set_value('username'); ?>">
                                <?= form_error('username', '<small class="text-danger pl-3" >', '</small>'); ?>
                            </div>
                            <div class=" form-group">
                                <input class="form-control" placeholder="Email" name="email" type="text" value="<?= set_value('pass'); ?>" id="email">
                                <?= form_error('email', '<small class="text-danger pl-3" >', '</small>'); ?>
                            </div>
                            <div class=" form-group">
                                <input class="form-control" placeholder="Password" name="password1" type="password" value="<?= set_value('pass'); ?>" id="password1">
                                <?= form_error('password1', '<small class="text-danger pl-3" >', '</small>'); ?>
                            </div>
                            <div class=" form-group">
                                <input class="form-control" placeholder="Ulang Password" name="password2" type="password" id="password2">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Nama" name="nama" type="text" autofocus="" id="nama" value="<?= set_value('nama'); ?>">
                                <?= form_error('nama', '<small class="text-danger pl-3" >', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Alamat" name="alamat" type="text" autofocus="" id="alamat" value="<?= set_value('alamat'); ?>">
                                <?= form_error('alamat', '<small class="text-danger pl-3" >', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-offset-5 col-sm-3 btn-submit">
                                        <button type="sumbit" class="btn btn-success">Registrasi</button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/'); ?>js/jquery-1.11.1.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/bootstrap.min.js"></script>
</body>

</html>