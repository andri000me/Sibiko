    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Siswa</h1>
                </div>
            </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <button class="btn btn-success" onclick="add_siswa()"><i class="glyphicon glyphicon-plus"></i> Add Siswa</button>
        <button class="btn btn-primary" onclick="upload_siswa()"><i class="glyphicon glyphicon-upload"></i> Upload</button>
      </div>
    </div>
    
    <p class="bg-success">
      <?php echo $this->session->flashdata('success'); ?>
      <?php echo $this->session->flashdata('failed'); ?>
    </p>

    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>NIS</th>
          <th style="width:165px;">Nama</th>
          <th>Alamat</th>
          <th>Jurusan</th>
          <th>Tahun Angkatan</th>
          <th style="width:165px;">Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>

      <tfoot>
        <tr>
          <th>NIS</th>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Jurusan</th>
          <th>Tahun Angkatan</th>
          <th>Action</th>
        </tr>
      </tfoot>
    </table>
  </div>

  <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>


  <script type="text/javascript">

    var save_method; //for save method string
    var table;
    $(document).ready(function() {
      table = $('#table').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('siswa/ajax_list')?>",
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

    function add_siswa()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Add Siswa'); // Set Title to Bootstrap modal title
    }

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

    function upload_siswa()
    {
      save_method = 'import';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_upload').modal('show'); // show bootstrap modal
      $('.modal-title').text('Upload Siswa'); // Set Title to Bootstrap modal title
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

  <!-- Bootstrap modal -->
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
                  <input name="nis" placeholder="Nomor Induk Siswa" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Nama</label>
              <div class="col-md-9">
                <input name="nama_siswa" placeholder="Nama Siswa" class="form-control" type="text">
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
                <select name="jurusan_siswa" class="form-control">
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
                <input name="tempat_lahir_siswa" placeholder="Tempat Lahir" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Tanggal Lahir</label>
              <div class="col-md-9">
                <input name="tanggal_lahir_siswa" placeholder="Last Name" class="form-control" type="date">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Jenis Kelamin</label>
              <div class="col-md-9">
                <select name="jenis_kelamin_siswa" class="form-control">
                  <option value="L">Laki-Laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Agama</label>
              <div class="col-md-9">
                <select name="agama_siswa" class="form-control">
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
                <input name="asal_sekolah_siswa" placeholder="Asal Sekolah" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Tahun Angkatan</label>
              <div class="col-md-9">
                <input name="tahun_angkatan_siswa" placeholder="Tahun Angkatan" class="form-control" type="text">
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
                <select name="kelas_siswa" class="form-control" id="kelas_siswa">
                    <option value="0" selected="select">- Pilih Kelas -</option>
                    <?php foreach($kelas_siswa as $kelas_siswa){
                      echo '<option value="'.$kelas_siswa->nama_kelas.'">'.$kelas_siswa->nama_kelas.'</option>';
                    } ?>
                  </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Status</label>
              <div class="col-md-9">
                <select name="status" class="form-control" id="kelas_siswa">
                  <option value="Aktif" selected="select">Aktif</option>
                  <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Foto</label>
              <div class="col-md-9">
                <input name="userfile" class="form-control" type="file">
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

  <!-- Bootstrap modal upload-->
  <div class="modal fade" id="modal_upload" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Upload Siswa</h3>
      </div>
      <div class="modal-body form">
        <form action='<?php echo site_url('siswa/importcsv')?>' class="form-horizontal" method="POST" enctype="multipart/form-data">
          <div class="alert alert-info" role="alert">
            <h5>Pastikan Format Data yang akan di Upload dengan format file .CSV</h5>
          </div>
        <div class="form-group">
              <label class="control-label col-md-3">Upload FIle</label>
              <div class="col-md-9">
                <input name="userfile" class="form-control" type="file"></br>
                <button type="submit" class="btn btn-primary">Upload</button>
              </div>
            </div>
        </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->