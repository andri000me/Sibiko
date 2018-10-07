    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Kejadian</h1>
                </div>
            </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <button class="btn btn-success" onclick="add_pelanggaran()"><i class="glyphicon glyphicon-plus"></i> Add Kejadian</button>
      </div>
    </div>


    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th style="width:10px;">No</th>
          <th style="width:10px;">NIS</th>
          <th style="width:170px;">Nama</th>
          <th style="width:50px;">Kelas</th>
          <th style="width:100px;">Tanggal</th>
          <th>Kejadian</th>
          <th style="width:30px;">Point</th>
          <th style="width:165px;">Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <tr>
          <th>No</th>
          <th>NIS</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Tanggal</th>
          <th>Kejadian</th>
          <th>Point</th>
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
            "url": "<?php echo site_url('pelanggaran/ajax_list')?>",
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

    function add_pelanggaran()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Add Pelanggaran'); // Set Title to Bootstrap modal title
    }

    function edit_pelanggaran(id_pelanggaran)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('pelanggaran/ajax_edit/')?>/" + id_pelanggaran,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id_pelanggaran"]').val(data.id_pelanggaran);
            $('[name="nis"]').val(data.nis);
            $('[name="kelas"]').val(data.kelas);
            $('[name="tanggal_pelanggaran"]').val(data.tanggal_pelanggaran);
            $('[name="subkategori"]').val(data.subkategori);
            $('[name="point_pelanggaran"]').val(data.point_pelanggaran);
            $('[name="tindak_lanjut"]').val(data.tindak_lanjut);
            $('[name="keterangan"]').val(data.keterangan);
            $('[name="id_guru"]').val(data.id_guru);

            $('#modal_form_edit').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Kejadian'); // Set title to Bootstrap modal title

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
          url = "<?php echo site_url('pelanggaran/ajax_add')?>";
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
        url = "<?php echo site_url('pelanggaran/ajax_update')?>";
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

       // ajax adding data to database

    }

    function delete_pelanggaran(id_pelanggaran)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('pelanggaran/ajax_delete')?>/"+id_pelanggaran,
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

    function upload_pelanggaran()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_upload').modal('show'); // show bootstrap modal
      $('.modal-title').text('Upload Kejadian'); // Set Title to Bootstrap modal title
    }

    var site = "<?php echo site_url();?>";
        $(function(){
            $('#autocomplete').autocomplete({
                // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                serviceUrl: site+'/bimbingan/search',
                // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                onSelect: function (suggestion) {
                    $('#nis').val(''+suggestion.nis); // membuat id 'v_nim' untuk ditampilkan
                    $('#kelas').val(''+suggestion.kelas_siswa); // membuat id 'v_jurusan' untuk ditampilkan
                }
            });
        });


  </script>

  <script>
        $(document).ready(function(){
            $("#kategori").change(function (){
                var url = "<?php echo site_url('pelanggaran/add_ajax_sub');?>/"+$(this).val();
                $('#subkategori').load(url);
                return false;
            })
        });
        $(document).ready(function(){
            $("#subkategori").change(function (){
                var url = "<?php echo site_url('pelanggaran/add_ajax_point');?>/"+$(this).val();
                $('#point_pelanggaran').load(url);
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
        <h3 class="modal-title">Kejadian Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
        <input type="hidden" name="id_pelanggaran" value="" />
          <div class="form-body">
             <div class="form-group">
              <label class="control-label col-md-3">Nama</label>
              <div class="col-md-9">
                <input name="nama_siswa" id="autocomplete" class="autocomplete form-control" style="width: 418px;" type="text">
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
                <input name="kelas" placeholder="Kelas" id="kelas" class='form-control' type="text" readonly></input>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Tanggal</label>
              <div class="col-md-9">
                <input name="tanggal_pelanggaran" placeholder="Tanggal Kejadian" class="form-control" type="date" value="<?php echo date('Y-m-d') ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Kejadian</label>
              <div class="col-md-9">
                <select name="kategori" class="form-control" id="kategori">
                  <option>- Pilih Kategori -</option>
                  <?php foreach($kategori as $kat){
                    echo '<option value="'.$kat->id_kategori.'">'.$kat->nama_pelanggaran.'</option>';
                  } ?>
                </select>
              </div>
            </div>
             <div class="form-group">
              <label class="control-label col-md-3"></label>
              <div class="col-md-9">
                <select name="subkategori" class="form-control" id="subkategori">
                  <option class="form-control" value=''>Pilih Kategori</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3"></label>
              <div class="col-md-9">
                <select name="point_pelanggaran" class="form-control" id="point_pelanggaran">
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Tindak Lanjut</label>
              <div class="col-md-9">
                <textarea name="tindak_lanjut" class="form-control" type="text"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Keterangan</label>
              <div class="col-md-9">
                <select name="keterangan" class="form-control">
                  <option value="Teratasi">Teratasi</option>
                  <option value="Proses">Proses</option>
                  <option value="Belum Teratasi">Belum Teratasi</option>
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
    </div>
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form_edit" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Kejadian Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form_edit" class="form-horizontal">
        <input type="hidden" name="id_pelanggaran" value="" />
          <div class="form-body">
             <div class="form-group" hidden>
              <label class="control-label col-md-3">NIS</label>
              <div class="col-md-9">
                <input name="nis" placeholder="Nomor Induk Siswa" id="autocomplete" class='autocomplete form-control 8' type="text" autofocus="autofocus">
              </div>
            </div>
            <div class="form-group" hidden>
              <label class="control-label col-md-3">Kelas</label>
              <div class="col-md-9">
                <input name="kelas" id="kelas" class='form-control' type="text"></input>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Tanggal</label>
              <div class="col-md-9">
                <input name="tanggal_pelanggaran" placeholder="Tanggal Kejadian" class="form-control" type="date" autofocus="autofocus">
              </div>
            </div>
             <div class="form-group" hidden>
              <label class="control-label col-md-3"></label>
              <div class="col-md-9">
                <input name="subkategori" id="subkategori" class='form-control' type="text"></input>
              </div>
            </div>
            <div class="form-group" hidden>
              <label class="control-label col-md-3"></label>
              <div class="col-md-9">
                <input name="point_pelanggaran" class="form-control" id="point_pelanggaran"></input>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Tindak Lanjut</label>
              <div class="col-md-9">
                <textarea name="tindak_lanjut" class="form-control" type="text"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Keterangan</label>
              <div class="col-md-9">
                <select name="keterangan" class="form-control">
                  <option value="Teratasi">Teratasi</option>
                  <option value="Proses">Proses</option>
                  <option value="Belum Teratasi">Belum Teratasi</option>
                </select>
              </div>
            </div>
             <div class="form-group" hidden>
                 <label class="control-label col-md-3">Guru</label>
                 <div class="col-md-9">
                  <input name="id_guru" class="form-control" id="id_guru">
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
  <!-- End Bootstrap modal -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
