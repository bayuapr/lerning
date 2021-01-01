<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span></button>
            <img src="<?php echo base_url(); ?>assets/image/logo-logic.png" class="img-responsive" alt="" width="350px">
        </div>
    </div>
</nav>
<!-- Collect the nav links, forms, and other content for toggling -->
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-usertitle">
            <div class="profile-usertitle-name"><?php echo $this->session->userdata('ses_nama'); ?></div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <ul class="nav menu">
        <!--Akses Menu Untuk Admin-->
        <?php if ($this->session->userdata('akses') == '1') : ?>
            <li class=""><a href="<?php echo base_url() . 'page' ?>"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
            <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
                    <em class="fa fa-users">&nbsp;</em> User <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-1">
                    <li><a class="" href="<?php echo base_url() . 'page/tabel_admin' ?>">
                            <span class="fa fa-user-plus">&nbsp;</span> Admin
                        </a></li>
                    <li><a class="" href="<?php echo base_url() . 'page/tabel_pengajar' ?>">
                            <span class="fa fa-user">&nbsp;</span> Pengajar
                        </a></li>
                    <li><a class="" href="<?php echo base_url() . 'page/tabel_Siswa' ?>">
                            <span class="fa fa-graduation-cap">&nbsp;</span> Siswa
                        </a></li>
                </ul>
            </li>
            <li><a href="<?php echo base_url() . 'page/tabel_pengumuman' ?>"><em class="fa fa-bullhorn">&nbsp;</em>Data Pengumuman</a></li>
            <li><a href="<?php echo base_url() . 'page/tabel_kelas' ?>"><em class="fa fa-calendar">&nbsp;</em> Kelola Kelas</a></li>


            <!--Akses Menu Untuk pengajar-->
        <?php elseif ($this->session->userdata('akses') == '2') : ?>
            <li class=""><a href="<?php echo base_url() . 'page' ?>"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
            <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
                    <em class="fa fa-graduation-cap">&nbsp;</em> Kelas <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-1">
                    <li><a class="" href="<?php echo base_url() . 'page/post_materi' ?>">
                            <span class="fa fa-file">&nbsp;</span> Materi
                        </a></li>
                    <li><a class="" href="<?php echo base_url() . 'page/post_tugas' ?>">
                            <span class="fa fa-sticky-note">&nbsp;</span> Tugas
                        </a></li>
                    <li><a class="" href="<?php echo base_url() . 'page/post_tugas_masuk' ?>">
                            <span class="fa fa-folder">&nbsp;</span> Tugas Masuk
                        </a></li>
                </ul>
            </li>
        <?php else : ?>
        <?php endif; ?>
    </ul>

    <ul class="nav menu">
        <li><a href="<?php echo base_url() . 'login/logout' ?>"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
    </ul>
</div><!-- /.navbar-collapse -->