<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Laporan Penghargaan - SMK Negeri 2 Bojonegoro</title>

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

</head>

  <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
  <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.autocomplete.js'></script>
  <link href='<?php echo base_url();?>assets/js/jquery.autocomplete.css' rel='stylesheet' />


  <script type="text/javascript">

    $(document).ready(function(){
        $("#modal_form").modal({
            show: true,
            handleupdate: true,
            backdrop: 'static',
            keyboard: false

        })

    });

    var site = "<?php echo site_url();?>";
        $(function(){
            $('.autocomplete').autocomplete({
                // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                serviceUrl: site+'/bimbingan/search',
                // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                onSelect: function (suggestion) {
                    $('#nis').val(''+suggestion.nis); // membuat id 'v_nim' untuk ditampilkan
                    $('#kelas_siswa').val(''+suggestion.kelas_siswa); // membuat id 'v_jurusan' untuk ditampilkan
                }
            });
        });

  </script>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button hidden type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Cetak laporan</h3>
      </div>
      <div class="modal-body form">
        <div>
             <!-- Nav tabs -->
              <ul class="nav nav-tabs nav-justified" role="tablist">
                <li role="presentation" class="active"><a href="#Siswa" aria-controls="Siswa" role="tab" data-toggle="tab">Siswa</a></li>
                <li role="presentation"><a href="#data_perkelas" aria-controls="data_perkelas" role="tab" data-toggle="tab">Data Perkelas</a></li>
                <li role="presentation"><a href="#semuadata" aria-controls="semuadata" role="tab" data-toggle="tab">Semua Data</a></li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="Siswa"></br>
                <form action="<?php base_url(); ?>laporan_siswa" method="POST" class="form-horizontal">
                      <div class="form-body">
                         <div class="form-group">
                          <label class="control-label col-md-3">Nama</label>
                          <div class="col-md-9">
                            <input name="nama_siswa" placeholder="ketik nama siswa" id="autocomplete" class="autocomplete form-control" style="width: 418px;" type="text">
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
                            <input name="kelas" placeholder="Kelas" id="kelas_siswa" class='form-control' type="text" readonly></input>
                          </div>
                        </div>
                        <div class="form-body">
                         <div class="form-group">
                          <label class="control-label col-md-3">Mulai Tanggal : </label>
                          <div class="col-md-9">
                            <input name="date_from" class="form-control" type="date" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Sampai Tanggal :</label>
                          <div class="col-md-9">
                            <input name="date_to" class="form-control" type="date" required="required"></input>
                          </div>
                        </div>
                        </div> 
                        <p class="text-right">
                            <input type=submit class="btn btn-primary" value="Cetak">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        </p>
                    </form>
                </div>
                </div></br>

                <div role="tabpanel" class="tab-pane" id="data_perkelas">
                    <form action="<?php base_url(); ?>laporan_perkelas" method="POST" class="form-horizontal">
                     <div class="form-group">
                          <label class="control-label col-md-3">Kelas</label>
                          <div class="col-md-9">
                            <select name="kelas_siswa" class="form-control" id="kelas_siswa">
                              <option>- Pilih Kategori -</option>
                              <?php foreach($kelas as $kel){
                                echo '<option value="'.$kel->nama_kelas.'">'.$kel->nama_kelas.'</option>';
                              } ?>
                            </select>
                          </div>
                        </div>
                      <div class="form-body">
                         <div class="form-group">
                          <label class="control-label col-md-3">Mulai Tanggal : </label>
                          <div class="col-md-9">
                            <input name="date_from" class="form-control" type="date" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Sampai Tanggal :</label>
                          <div class="col-md-9">
                            <input name="date_to" class="form-control" type="date" value="<?php echo date('Y-m-d') ?>" required="required"></input>
                          </div>
                        </div>
                        <p class="text-right">
                            <input type=submit class="btn btn-primary" value="Cetak">
                        </p>
                    </form>
                    </div>
                    </div>
                    </br>

                <div role="tabpanel" class="tab-pane" id="semuadata">
                    <form action="<?php base_url(); ?>laporan" method="POST" class="form-horizontal">
                      <div class="form-body">
                         <div class="form-group">
                          <label class="control-label col-md-3">Mulai Tanggal : </label>
                          <div class="col-md-9">
                            <input name="date_from" class="form-control" type="date" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Sampai Tanggal :</label>
                          <div class="col-md-9">
                            <input name="date_to" class="form-control" type="date" required="required"></input>
                          </div>
                        </div>
                        <p class="text-right">
                            <input type=submit class="btn btn-primary" value="Cetak">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        </p>
                    </form>
              </div>
          </div>

          <div class="modal-footer">
            
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->