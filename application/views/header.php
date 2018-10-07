<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title; ?></title>
    <script src="<?php base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('assets//bower_components/metisMenu/dist/metisMenu.min.css')?>" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url('assets/dist/css/timeline.css')?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/dist/css/sb-admin-2.css')?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url('assets/bower_components/morrisjs/morris.css')?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">

  

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
		<?php if ($this->session->userdata('role') == 'super admin'): ?>
			<a class="navbar-brand" href="<?php base_url() ?>beranda">Sistem Bimbingan dan Konseling</a>
			<?php else: ?>
			<a class="navbar-brand">Sistem Bimbingan dan Konseling</a>
			<?php endif ?>
                
            </div>

             <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" >
                        Selamat datang, <?php echo $this->session->userdata('nama'); ?> <i class="fa fa-user fa-fw"></i>
                    </a>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <!-- /.navbar-header -->



            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        

                        <?php if ($this->session->userdata('role') == 'super admin'): ?>
                         <li>
                            <a href="<?php echo base_url(); ?>beranda"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>

                            <li>
                            <a href="#"><i class="glyphicon glyphicon-th-list"></i> Master<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url() ?>siswa"><i class="glyphicon glyphicon-user"></i> Siswa</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>siswa_alumni"><i class="glyphicon glyphicon-user"></i> Alumni</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>guru"><i class="glyphicon glyphicon-user"></i> Guru</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>kelas"><i class="glyphicon glyphicon-list-alt"></i> Kelas</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>catatan"><i class="glyphicon glyphicon-list-alt"></i> Catatan</a>
                                </li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-share"></i> Bimbingan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url() ?>bimbingan" ><i class="glyphicon glyphicon-book"></i>  Data Bimbingan</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>bimbingan/laporan_filter" target="_blank"><i class="glyphicon glyphicon-print"></i>  Laporan</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-edit"></i> Pelanggaran<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url() ?>pelanggaran"><i class="glyphicon glyphicon-book"></i> Data Pelanggaran</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>kategori"><i class="glyphicon glyphicon-tag"></i> Kategori Pelanggaran</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>pelanggaran/laporan_filter" target="_blank"><i class="glyphicon glyphicon-print"></i> Laporan</a>
                                </li>
                            </ul>
                        </li>
                         <li>
                            <a href="#"><i class="glyphicon glyphicon-star"></i> Penghargaan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url() ?>penghargaan" ><i class="glyphicon glyphicon-book"></i> Data Penghargaan</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>kategori_penghargaan"><i class="glyphicon glyphicon-tag"></i> Kategori Penghargaan</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>penghargaan/laporan_filter" target="_blank"><i class="glyphicon glyphicon-print"></i> Laporan</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-envelope"></i> Surat<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url() ?>surat"><i class="glyphicon glyphicon-file"></i> Surat Panggilan</a>
                                </li>
                            </ul>
                        </li>
                       <li>
                       <li>
                            <a href="#"><i class="glyphicon glyphicon-envelope"></i> User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url() ?>user"><i class="glyphicon glyphicon-file"></i> Data Akun</a>
                                </li>
                            </ul>
                        </li>
                    <?php elseif($this->session->userdata('role') == 'admin'): ?>
                         <li>
                            <a href="<?php echo base_url(); ?>beranda"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>

                            <li>
                            <a href="#"><i class="glyphicon glyphicon-th-list"></i> Master<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url() ?>siswa"><i class="glyphicon glyphicon-user"></i> Siswa</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>siswa_alumni"><i class="glyphicon glyphicon-user"></i> Alumni</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>guru"><i class="glyphicon glyphicon-user"></i> Guru</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>kelas"><i class="glyphicon glyphicon-list-alt"></i> Kelas</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>catatan"><i class="glyphicon glyphicon-list-alt"></i> Catatan</a>
                                </li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-share"></i> Bimbingan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url() ?>bimbingan" ><i class="glyphicon glyphicon-book"></i>  Data Bimbingan</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>bimbingan/laporan_filter" target="_blank"><i class="glyphicon glyphicon-print"></i>  Laporan</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-edit"></i> Pelanggaran<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url() ?>pelanggaran"><i class="glyphicon glyphicon-book"></i> Data Pelanggaran</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>kategori"><i class="glyphicon glyphicon-tag"></i> Kategori Pelanggaran</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>pelanggaran/laporan_filter" target="_blank"><i class="glyphicon glyphicon-print"></i> Laporan</a>
                                </li>
                            </ul>
                        </li>
                         <li>
                            <a href="#"><i class="glyphicon glyphicon-star"></i> Penghargaan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url() ?>penghargaan" ><i class="glyphicon glyphicon-book"></i> Data Penghargaan</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>kategori_penghargaan"><i class="glyphicon glyphicon-tag"></i> Kategori Penghargaan</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>penghargaan/laporan_filter" target="_blank"><i class="glyphicon glyphicon-print"></i> Laporan</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-envelope"></i> Surat<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url() ?>surat"><i class="glyphicon glyphicon-file"></i> Surat Panggilan</a>
                                </li>
                            </ul>
                        </li>
                       <li>
                    </ul>
                        <?php elseif($this->session->userdata('role') == 'guru'): ?>

                    <li>
                            <a href="#"><i class="glyphicon glyphicon-share"></i> Bimbingan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="bimbingan" ><i class="glyphicon glyphicon-book"></i>  Data Bimbingan</a>
                                </li>
                                <li>
                                    <a href="bimbingan/laporan_filter" target="_blank"><i class="glyphicon glyphicon-print"></i>  Laporan</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-edit"></i> Pelanggaran<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="pelanggaran"><i class="glyphicon glyphicon-book"></i> Data Pelanggaran</a>
                                </li>
                                <li>
                                    <a href="pelanggaran/laporan_filter" target="_blank"><i class="glyphicon glyphicon-print"></i> Laporan</a>
                                </li>
                            </ul>
                        </li>
                         <li>
                            <a href="#"><i class="glyphicon glyphicon-star"></i> Penghargaan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="penghargaan" ><i class="glyphicon glyphicon-book"></i> Data Penghargaan</a>
                                </li>
                                <li>
                                    <a href="penghargaan/laporan_filter" target="_blank"><i class="glyphicon glyphicon-print"></i> Laporan</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>guru/edit"><i class="glyphicon glyphicon-log-out"></i> Edit Akun</a>
                        </li>

                    <?php elseif($this->session->userdata('role') == 'wali'): ?>
                    <li>
                        <a href="<?php echo base_url(); ?>wali"><i class="glyphicon glyphicon-log-out"></i> Siswa</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>guru/edit"><i class="glyphicon glyphicon-log-out"></i> Edit Akun</a>
                    </li>
                        <?php else: ?>
                     <li>
                        <a href="<?php echo base_url(); ?>siswa/data"><i class="glyphicon glyphicon-log-out"></i> Siswa</a>
                    </li>
                        <?php endif ?>
                    <li>
                        <a href="<?php echo base_url() ?>login/logout/"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
                    </li>
                        
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>