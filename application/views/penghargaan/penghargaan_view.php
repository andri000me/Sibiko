<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Data Penghargaan - SMK Negeri 2 Bojonegoro</title>

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

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data penghargaan</h1>
                </div>
            </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <button class="btn btn-success" onclick="add_penghargaan()"><i class="glyphicon glyphicon-plus"></i> Add penghargaan</button>
      </div>
    </div>



    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th style="width:20px;">No</th>
          <th style="width:100px;">Nama</th>
          <th style="width:50px;">Tanggal</th>
          <th>Deskripsi Penghargaan</th>
          <th style="width:10px;">poin</th>
          <th>Guru</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Tanggal</th>
          <th>Deskripsi Penghargaan</th>
          <th>poin</th>
          <th>Guru</th>
          <th>Action</th>
        </tr>
      </tfoot>
    </table>
  </div>

  <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
  <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.autocomplete.js'></script>
  <link href='<?php echo base_url();?>assets/js/jquery.autocomplete.css' rel='stylesheet' />


  <script type="text/javascript">

    var save_method; //for save method string
    var table;
    $(document).ready(function() {
      table = $('#table').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('penghargaan/ajax_list')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        {
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
        },
        ],

      });
    });

    function add_penghargaan()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Add penghargaan'); // Set Title to Bootstrap modal title
    }

    function edit_penghargaan(id_penghargaan)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('penghargaan/ajax_edit/')?>/" + id_penghargaan,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id_penghargaan"]').val(data.id_penghargaan);
            $('[name="nis"]').val(data.nis);
            $('[name="kelas_siswa"]').val(data.kelas);
            $('[name="tanggal_penghargaan"]').val(data.tanggal_penghargaan);
            $('[name="subkategori_penghargaan"]').val(data.subkategori_penghargaan);
            $('[name="poin_penghargaan"]').val(data.poin_penghargaan);
            $('[name="id_guru"]').val(data.id_guru);

            $('#modal_form_edit').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit penghargaan'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }

    function reload_table()
    {
      table.ajax.reload(null,false); //reload datatable ajax
    }

    function save()
    {
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('penghargaan/ajax_add')?>";
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
      }
      else
      {
        url = "<?php echo site_url('penghargaan/ajax_update')?>";
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form_edit').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form_edit').modal('hide');
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
      }

    }

    function delete_penghargaan(id_penghargaan)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('penghargaan/ajax_delete')?>/"+id_penghargaan,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               //if success reload ajax table
               $('#modal_form').modal('hide');
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });

      }
    }

    function upload_penghargaan()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_upload').modal('show'); // show bootstrap modal
      $('.modal-title').text('Upload penghargaan'); // Set Title to Bootstrap modal title
    }

    var site = "<?php echo site_url();?>";
        $(function(){
            $('.autocomplete').autocomplete({
                // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                serviceUrl: site+'/bimbingan/search',
                // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                onSelect: function (suggestion) {
                    $('#kategori_penghargaan option:first').prop('selected',true);
                    $('#subkategori_penghargaan option:first').prop('selected',true);
                    $('#poin_penghargaan').val("");
                    $('#nis').val(''+suggestion.nis); // membuat id 'v_nim' untuk ditampilkan
                    $('#kelas_siswa').val(''+suggestion.kelas_siswa); // membuat id 'v_jurusan' untuk ditampilkan
                    load_kategori();
                    
                }
            });
        });

  </script>

   <script>
        function load_kategori(){
            $("#kategori_penghargaan").change(function (){
                var url = "<?php echo site_url('penghargaan/add_ajax_sub');?>/"+$(this).val()+"/"+$('#nis').val();
                $('#subkategori_penghargaan').get(0).selectedIndex = 1;
                $('#poin_penghargaan').get(0).selectedIndex = 1;
                $('#subkategori_penghargaan').load(url);
                return false;
            })
        };

        $(document).ready(function(){
            $("#subkategori_penghargaan").change(function (){
                var url = "<?php echo site_url('penghargaan/add_ajax_point');?>/"+$(this).val();
                $('#poin_penghargaan').load(url);
                return false;
            })
        });
    </script>

  <!-- Bootstrap modal -->
  <div>
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">penghargaan Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
        <input type="text" name="id_penghargaan" value="" hidden/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Nama</label>
              <div class="col-md-9">
                <input name="nama_siswa" placeholder="Nama Siswa" id="autocomplete" class="autocomplete form-control" style="width: 418px;" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">NIS</label>
              <div class="col-md-9">
                <input name="nis" placeholder="nis" id="nis" class="form-control" readonly></input>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Kelas</label>
              <div class="col-md-9">
                <input name="kelas_siswa" placeholder="Kelas" id="kelas_siswa" class='form-control' type="text" readonly></input>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Tanggal</label>
              <div class="col-md-9">
                <input name="tanggal_penghargaan" placeholder="Tanggal penghargaan" class="form-control" type="date" value="<?php echo date('Y-m-d') ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Kejadian</label>
              <div class="col-md-9">
                <select name="kategori_penghargaan" class="form-control" id="kategori_penghargaan">
                  <option>- Pilih Kategori -</option>
                  <?php foreach($kategori_penghargaan as $kat){
                    echo '<option value="'.$kat->id_kategori_penghargaan.'">'.$kat->nama_penghargaan.'</option>';
                  } ?>
                </select>
              </div>
            </div>
             <div class="form-group">
              <label class="control-label col-md-3"></label>
              <div class="col-md-9">
                <select name="subkategori_penghargaan" class="form-control" id="subkategori_penghargaan">
                  <option class="form-control" value=''>Pilih Kategori</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3"></label>
              <div class="col-md-9">
                <select name="poin_penghargaan" class="form-control" id="poin_penghargaan" required="required">
                    <option class="form-control" value=''>-</option>
                </select>
              </div>
            </div>
            <div class="form-group">
                 <label class="control-label col-md-3">Guru</label>
                 <div class="col-md-9">
                  <select name="id_guru" class="form-control" id="id_guru" required>
                    <option value="0">- Pilih Guru -</option>
                    <?php foreach($id_guru as $id_guru){
                      echo '<option value="'.$id_guru->id_guru.'">'.$id_guru->nama_guru.'</option>';
                    } ?>
                  </select>
                  </div>
                </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </div>
  <!-- End Bootstrap modal -->

    <!-- Bootstrap modal -->
  <div>
  <div class="modal fade" id="modal_form_edit" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">penghargaan Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form_edit" class="form-horizontal">
        <input type="text" name="id_penghargaan" value="" hidden/>
          <div class="form-body">
            <div class="form-group" hidden>
              <label class="control-label col-md-3">NIS</label>
              <div class="col-md-9">
                <input name="nis" placeholder="Nomor Induk Siswa" id="autocomplete" class='autocomplete form-control 8' type="text">
              </div>
            </div>
            <div class="form-group" hidden>
              <label class="control-label col-md-3">Kelas</label>
              <div class="col-md-9">
                <input name="kelas_siswa" placeholder="Kelas" id="kelas_siswa" class='form-control' type="text" readonly></input>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Tanggal</label>
              <div class="col-md-9">
                <input name="tanggal_penghargaan" placeholder="Tanggal penghargaan" class="form-control" type="date">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Deskripsi Penghargaan</label>
              <div class="col-md-9">
                <textarea name="deskripsi_penghargaan" placeholder="Deskripsi Penghargaan" class="form-control" type="text"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Poin</label>
              <div class="col-md-9">
                <textarea name="poin_penghargaan" placeholder="Poin Penghargaan" class="form-control" type="text"></textarea>
              </div>
            </div>
            <div class="form-group" hidden>
                 <label class="control-label col-md-3">Guru</label>
                 <div class="col-md-9">
                  <select name="id_guru" class="form-control" id="id_guru" required>
                    <option value="0">- Pilih Guru -</option>
                    <?php foreach($id_guru as $id_guru){
                      echo '<option value="'.$id_guru->id_guru.'">'.$id_guru->nama_guru.'</option>';
                    } ?>
                  </select>
                  </div>
                </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </div>
  <!-- End Bootstrap modal -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
