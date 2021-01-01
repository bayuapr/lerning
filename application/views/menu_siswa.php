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
        <?php if ($this->session->userdata('akses') == '3') : ?>
            <li class=""><a href="<?php echo base_url() . 'page_siswa' ?>"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
            <li class=""><a href="<?php echo base_url() . 'page_siswa/lists_materi/' ?>"><em class="fa fa-file">&nbsp;</em> Materi</a></li>
            <li class=""><a href="<?php echo base_url() . 'page_siswa/lists_tugas/' ?>"><em class="fa fa-sticky-note">&nbsp;</em> Tugas</a></li>
            <li><a href="<?php echo base_url() . 'page_siswa/pengumuman_lists/' ?>"><em class="fa fa-bullhorn">&nbsp;</em> Pengumuman</a></li>
        <?php endif; ?>
    </ul>

    <ul class="nav menu">
        <li><a href="<?php echo base_url() . 'login_siswa/logout_siswa' ?>"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
    </ul>
</div><!-- /.navbar-collapse -->