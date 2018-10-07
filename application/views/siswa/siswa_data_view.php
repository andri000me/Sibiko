    <div id="page-wrapper"><br>
  <div class="panel panel-default">
      <div class="panel-heading">
         <h4>Selamat datang <?php echo $this->session->userdata('nama_siswa'); ?></h4>
      </div>
    </div>
    
   <div class="row">
      <div class="col-lg-4">
        <div class="panel panel-info">
          <div class="panel-heading">
           <i class="fa fa-bell fa-fw"></i> Biodata Siswa
          </div>
          <div class="panel-body">
           <div class="list-group">
          <table class="table">
          
          <?php
             foreach($dataSiswa as $row){
          ?>

                <?php if(strlen($row->nis) != 11) {
                    $nis1 = substr($row->nis, 0,5);
                    $nis2 = substr($row->nis, 5, 4);
                    $nis3 = substr($row->nis, -3);
                } else{
                    $nis1 = substr($row->nis, 0,5);
                    $nis2 = substr($row->nis, 5, 3);
                    $nis3 = substr($row->nis, -3);
                }; ?>

                <?php 
                    $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu");
                    $bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                    //echo $hari[date("w")].", ".date("j")." ".$bulan[date("n")]." ".date("Y");
                 ?>
                <tr>
                  <center><img src="<?php echo base_url(); ?>assets/foto/<?php echo $row->nis; ?>.jpg" onerror="this.src='<?php echo base_url(); ?>assets/foto/default2.jpg'" height="150" width="130"></center><br>
                </tr>
                <tr>
                  <td width="100px">Nama</td>
                  <td width="5px">:</td>
                  <td><?php echo $row->nama_siswa;?></td>
                </tr>
                <tr>
                  <td width="100px">NIS</td>
                  <td width="5px">:</td>
                  <td><?php echo $nis1.'/'.$nis2.'.'.$nis3;?></td>
                </tr>
                <tr>
                  <td width="100px">TTL</td>
                  <td width="5px">:</td>
                  <td>
                    <?php echo $row->tempat_lahir_siswa;?>, 
                    <?php echo date('j', strtotime(date($row->tanggal_lahir_siswa))).' '.$bulan[date('n',strtotime(date($row->tanggal_lahir_siswa)))].' '.date('Y', strtotime(date($row->tanggal_lahir_siswa))); ?>
                  </td>
                </tr>
                <tr>
                  <td width="100px">Agama</td>
                  <td width="5px">:</td>
                  <td><?php echo $row->agama_siswa;?></td>
                </tr>
                <tr>
                  <td width="100px">Kelas</td>
                  <td width="5px">:</td>
                  <td><?php echo $row->kelas_siswa;?></td>
                </tr>
                <tr>
                  <td width="100px">Alamat</td>
                  <td width="5px">:</td>
                  <td><?php echo $row->alamat_siswa;?></td>
                </tr>
                
                <?php
                  }
               ?>
                </table>
                <a class="btn btn-success btn-block" href="javascript:void()" title="Edit" 
                onclick="edit_siswa('<?php echo $row->nis;?>')"><i class="glyphicon glyphicon-pencil"></i></a>
           </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="panel panel-primary">
          <div class="panel-heading">
           <i class="fa fa-bell fa-fw"></i> Data Kejadian Siswa
          </div>
          <div class="panel-body">
           <div class="list-group">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Bimbingan
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                  <div class="pre-scrollable" width="600px">
                    <table class="table">
                      <?php
                        $no=1;
                        if(empty($dataBimbingan))
                        {
                            echo "<tr><td colspan=\"6\">Data tidak tersedia</td></tr>";
                          } else{
                           foreach($dataBimbingan as $row)
                          {    
                        ?>
                        <tr>
                        <td class="text-left" width="10px" rowspan="4"><?php echo $no;?>.</td>
                          <td width="80px">Tanggal</td>
                          <td width="5px">:</td>
                          <td>
                          <?php echo date('j', strtotime(date($row->tanggal_bimbingan))).' '.$bulan[date('n',strtotime(date($row->tanggal_bimbingan)))].' '.date('Y', strtotime(date($row->tanggal_bimbingan))); ?>
                          </td>
                          
                        </tr>
                        <tr>
                            <td width="80px">Kelas</td>
                            <td width="5px">:</td>
                            <td><?php echo $row->kelas;?></td>
                        </tr>
                        <tr>
                          <td width="80px">Permasalahan</td>
                          <td width="5px">:</td>
                          <td><?php echo $row->masalah_siswa;?></td>
                        </tr>
                        <tr>
                          <td width="80px">Solusi</td>
                          <td width="10px">:</td>
                          <td><?php echo $row->solusi_bimbingan;?></td>
                        </tr>
                        <?php
                        $no++;
                      }}
                   ?>
                 </table>
                 </div>
                  </div>
                  <form class="form-inline" action="<?php echo base_url(); ?>bimbingan/laporan_siswa_semua" target="_blank" method="POST">
                    <input name="nis" hidden type="text" value="<?php echo $row->nis; ?>" >
                    <input type=submit class="btn btn-success btn-block" value="Print">
                  </form>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Pelanggaran
                    </a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="panel-body">
                  <div class="pre-scrollable">
                    <table class="table">
                      <?php
                        $no=1;
                        if(empty($dataPelanggaran))
                        {
                            echo "<tr><td colspan=\"6\">Data tidak tersedia</td></tr>";
                          } else{
                           foreach($dataPelanggaran as $row)
                          {    
                        ?>
                        <tr>
                        <td class="text-left" width="10px" rowspan="6"><?php echo $no;?>.</td>
                          <td width="80px">Tanggal</td>
                          <td width="5px">:</td>
                          <td>
                          <?php echo date('j', strtotime(date($row->tanggal_pelanggaran))).' '.$bulan[date('n',strtotime(date($row->tanggal_pelanggaran)))].' '.date('Y', strtotime(date($row->tanggal_pelanggaran))); ?>
                          </td>
                          
                        </tr>
                        <tr>
                            <td width="80px">Kelas</td>
                            <td width="5px">:</td>
                            <td><?php echo $row->kelas;?></td>
                        </tr>
                        <tr>
                          <td width="80px">Pelanggaran</td>
                          <td width="5px">:</td>
                          <td width="500px"><?php echo $row->deskripsi_pelanggaran;?></td>
                        </tr>
                        <tr>
                          <td width="80px">Point</td>
                          <td width="10px">:</td>
                          <td><?php echo $row->point_pelanggaran;?></td>
                        </tr>
                        <tr>
                          <td width="80px">Tindak Lanjut</td>
                          <td width="10px">:</td>
                          <td><?php echo $row->tindak_lanjut;?></td>
                        </tr>
                        <tr>
                          <td width="80px">Guru</td>
                          <td width="10px">:</td>
                          <td><?php echo $row->nama_guru;?></td>
                        </tr>
                        <?php
                        $no++;
                      }}
                   ?>
                 </table>
                 </div>
                  </div>
                  <form class="form-inline" action="<?php echo base_url(); ?>pelanggaran/laporan_siswa_semua" target="_blank" method="POST">
                    <input name="nis" hidden type="text" value="<?php echo $row->nis; ?>" >
                    <input type=submit class="btn btn-success btn-block" value="Print">
                  </form>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Penghargaan
                    </a>
                  </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                  <div class="panel-body">
                  <div class="pre-scrollable">
                    <table class="table">
                      <?php
                        $no=1;
                        if(empty($dataPenghargaan))
                        {
                            echo "<tr><td colspan=\"6\">Data tidak tersedia</td></tr>";
                          } else{
                           foreach($dataPenghargaan as $row)
                          {    
                        ?>
                        <tr>
                        <td class="text-left" width="10px" rowspan="6"><?php echo $no;?>.</td>
                          <td width="80px">Tanggal</td>
                          <td width="5px">:</td>
                          <td>
                          <?php echo date('j', strtotime(date($row->tanggal_penghargaan))).' '.$bulan[date('n',strtotime(date($row->tanggal_penghargaan)))].' '.date('Y', strtotime(date($row->tanggal_penghargaan))); ?>
                          </td>
                          
                        </tr>
                        <tr>
                            <td width="80px">Kelas</td>
                            <td width="5px">:</td>
                            <td><?php echo $row->kelas;?></td>
                        </tr>
                        <tr>
                          <td width="80px">Pelanggaran</td>
                          <td width="5px">:</td>
                          <td><?php echo $row->deskripsi_penghargaan;?></td>
                        </tr>
                        <tr>
                          <td width="80px">Point</td>
                          <td width="10px">:</td>
                          <td><?php echo $row->point_penghargaan;?></td>
                        </tr>
                        <tr>
                          <td width="80px">Guru</td>
                          <td width="10px">:</td>
                          <td><?php echo $row->nama_guru;?></td>
                        </tr>
                        <?php
                        $no++;
                      }}
                   ?>
                 </table>
                 </div>
                  </div>
                  <form class="form-inline" action="<?php echo base_url(); ?>penghargaan/laporan_siswa_semua" target="_blank" method="POST">
                    <input name="nis" hidden type="text" value="<?php echo $row->nis; ?>" >
                    <input type=submit class="btn btn-success btn-block" value="Print">
                  </form>
                </div>
              </div>
            </div>  
           </div>
          </div>
        </div>
      </div>
   </div>
  </div>

  <script type="text/javascript">

    var save_method; //for save method string
    var table;
   function edit_siswa(nis)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('siswa/ajax_edit/')?>/" + nis,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
           
            $('[name="nis"]').val(data.nis);
            $('[name="nama_siswa"]').val(data.nama_siswa);
            $('[name="alamat_siswa"]').val(data.alamat_siswa);
            $('[name="jurusan_siswa"]').val(data.jurusan_siswa);
            $('[name="tempat_lahir_siswa"]').val(data.tempat_lahir_siswa);
            $('[name="tanggal_lahir_siswa"]').val(data.tanggal_lahir_siswa);
            $('[name="jenis_kelamin_siswa"]').val(data.jenis_kelamin_siswa);
            $('[name="agama_siswa"]').val(data.agama_siswa);
            $('[name="asal_sekolah_siswa"]').val(data.asal_sekolah_siswa);
            $('[name="tahun_angkatan_siswa"]').val(data.tahun_angkatan_siswa);
            $('[name="nama_ayah_siswa"]').val(data.nama_ayah_siswa);
            $('[name="pekerjaan_ayah_siswa"]').val(data.pekerjaan_ayah_siswa);
            $('[name="nama_ibu_siswa"]').val(data.nama_ibu_siswa);
            $('[name="pekerjaan_ibu_siswa"]').val(data.pekerjaan_ibu_siswa);
            $('[name="no_telepon_ortu"]').val(data.no_telepon_ortu);
            $('[name="kelas_siswa"]').val(data.kelas_siswa);
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Siswa'); // Set title to Bootstrap modal title
            
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
          url = "<?php echo site_url('siswa/ajax_add')?>";
      }
      else if(save_method == 'import') 
      {
        url = "<?php echo site_url('siswa/importcsv')?>";
      }
      else
      {
        url = "<?php echo site_url('siswa/ajax_update')?>";
      }
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

    function print()
    {
      var url;
        url : "<?php echo site_url('siswa/profil')?>/" + nis,
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

    $(document).ready(function (e) {
    $("#form").on('submit',(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo base_url(); ?>siswa/do_upload",
            type: "POST",
            data:  new FormData(this),
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(data)
            {
            $("#targetLayer").html(data);
            },
            error: function() 
            {
            }           
       });
    }));
});

    function delete_siswa(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('siswa/ajax_delete')?>/"+id,
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

    

  </script>

  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Siswa Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data" method="POST">
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">NIS</label>
              <div class="col-md-9">
                  <input name="nis" placeholder="Nomor Induk Siswa" class="form-control" type="text" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Nama</label>
              <div class="col-md-9">
                <input name="nama_siswa" placeholder="Nama Siswa" class="form-control" type="text" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Alamat</label>
              <div class="col-md-9">
                <textarea name="alamat_siswa" placeholder="Alamat"class="form-control"></textarea>
              </div>
            </div>
           <div class="form-group">
              <label class="control-label col-md-3">Jurusan</label>
              <div class="col-md-9">
                <select name="jurusan_siswa" class="form-control" readonly>
                  <option value="-" selected="select"> -- Pilih Jurusan -- </option>
                  <option value="Teknik Kendaraan Ringan">Teknik Kendaraan Ringan</option>
                  <option value="Teknik Geomatika">Teknik Geomatika</option>
                  <option value="Teknik Elektronika Industri">Teknik Elektronika Industri</option>
                  <option value="Teknik Komputer dan Jaringan">Teknik Komputer dan Jaringan</option>
                  <option value="Teknik Gambar Bangunan">Teknik Gambar Bangunan</option>
                  <option value="Teknik Instalasi Pemanfaatan Tenaga Listrik">Teknik Instalasi Pemanfaatan Tenaga Listrik</option>
                  <option value="Teknik Konstruksi Batu Beton">Teknik Konstruksi Batu Beton</option>
                  <option value="Teknik Konstruksi Kayu">Teknik Konstruksi Kayu</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Tempat Lahir</label>
              <div class="col-md-9">
                <input name="tempat_lahir_siswa" placeholder="Tempat Lahir" class="form-control" type="text" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Tanggal Lahir</label>
              <div class="col-md-9">
                <input name="tanggal_lahir_siswa" placeholder="Last Name" class="form-control" type="date" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Jenis Kelamin</label>
              <div class="col-md-9">
                <select name="jenis_kelamin_siswa" class="form-control" readonly>
                  <option value="L">Laki-Laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Agama</label>
              <div class="col-md-9">
                <select name="agama_siswa" class="form-control" readonly>
                  <option value="Islam">Islam</option>
                  <option value="Kristen">Kristen</option>
                   <option value="Hindu">Hindu</option>
                  <option value="Budha">Budha</option>
                   <option value="Katolik">Katolik</option>
                  <option value="Protestan">Protestan</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Asal Sekolah</label>
              <div class="col-md-9">
                <input name="asal_sekolah_siswa" placeholder="Asal Sekolah" class="form-control" type="text" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Tahun Angkatan</label>
              <div class="col-md-9">
                <input name="tahun_angkatan_siswa" placeholder="Tahun Angkatan" class="form-control" type="text" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Nama Ayah</label>
              <div class="col-md-9">
                <input name="nama_ayah_siswa" placeholder="Nama Ayah" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Pekerjaan Ayah</label>
              <div class="col-md-9">
                <input name="pekerjaan_ayah_siswa" placeholder="Pekerjaan Ayah" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Nama Ibu</label>
              <div class="col-md-9">
                <input name="nama_ibu_siswa" placeholder="Nama Ibu" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Pekerjaan Ibu</label>
              <div class="col-md-9">
                <input name="pekerjaan_ibu_siswa" placeholder="Pekerjaan Ibu" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">No Telp Ortu</label>
              <div class="col-md-9">
                <input name="no_telepon_ortu" placeholder="Nomor Telp" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Kelas</label>
              <div class="col-md-9">
                <input name="kelas_siswa" class="form-control" id="kelas_siswa" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Status</label>
              <div class="col-md-9">
                <select name="status" class="form-control" id="kelas_siswa" readonly>
                  <option value="Aktif" selected="select">Aktif</option>
                  <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
              </div>
            </div>
          </div>
          </div>
          <div class="modal-footer">
            <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->

  <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
 
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->