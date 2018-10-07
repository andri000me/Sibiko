
    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Bimbingan</h1>
                </div>
            </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <button class="btn btn-success" onclick="add_bimbingan()"><i class="glyphicon glyphicon-plus"></i> Add Bimbingan</button>
      </div>
    </div>
    
    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th style="width:20px;">No</th>
          <th style="width:20px;">NIS</th>
          <th style="width:100px;">Nama</th>
          <th style="width:80px;">kelas</th>
          <th style="width:50px;">Tanggal</th>
          <th>Permasalahan</th>
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
          <th>kelas</th>
          <th>Tanggal</th>
          <th>Permasalahan</th>
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
            "url": "<?php echo site_url('bimbingan/ajax_list')?>",
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

    function add_bimbingan()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Add Bimbingan'); // Set Title to Bootstrap modal title
    }

    function edit_bimbingan(id_bimbingan)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('bimbingan/ajax_edit/')?>/" + id_bimbingan,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
           
            $('[name="id_bimbingan"]').val(data.id_bimbingan);
            $('[name="nis"]').val(data.nis);
            $('[name="kelas"]').val(data.kelas);
            $('[name="tanggal_bimbingan"]').val(data.tanggal_bimbingan);
            $('[name="masalah_siswa"]').val(data.masalah_siswa);
            $('[name="solusi_bimbingan"]').val(data.solusi_bimbingan);
            $('[name="keterangan"]').val(data.keterangan);
            
            $('#modal_form_edit').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Bimbingan'); // Set title to Bootstrap modal title
            
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
          url = "<?php echo site_url('bimbingan/ajax_add')?>";
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
        url = "<?php echo site_url('bimbingan/ajax_update')?>";
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

    function delete_bimbingan(id_bimbingan)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('bimbingan/ajax_delete')?>/"+id_bimbingan,
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

    function upload_bimbingan()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_upload').modal('show'); // show bootstrap modal
      $('.modal-title').text('Upload Bimbingan'); // Set Title to Bootstrap modal title
    }

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
  <div>
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Bimbingan Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
        <input type="hidden" name="id_bimbingan" value="" />
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Nama</label>
              <div class="col-md-9">
                <input name="nama_siswa" placeholder="Ketik nama siswa" id="autocomplete" class="autocomplete form-control" style="width: 418px;" type="text">
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
            <div class="form-group">
              <label class="control-label col-md-3">Tanggal</label>
              <div class="col-md-9">
                <input name="tanggal_bimbingan" placeholder="Tanggal Bimbingan" class="form-control" type="date" value="<?php echo date('Y-m-d') ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Permasalahan</label>
              <div class="col-md-9">
                <textarea name="masalah_siswa" placeholder="Permasalahan Siswa" class="form-control" type="text"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Solusi Permasalahan</label>
              <div class="col-md-9">
                <textarea name="solusi_bimbingan" placeholder="Solusi Permasalahan Siswa" class="form-control" type="text"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Keterangan</label>
              <div class="col-md-4">
                <select name="keterangan" class="form-control">
                  <option value="Teratasi">Teratasi</option>
                  <option value="Proses">Proses</option>
                  <option value="Belum Teratasi">Belum Teratasi</option>
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
  <div class="modal fade" id="modal_form_edit" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Bimbingan Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form_edit" class="form-horizontal">
        <input type="hidden" name="id_bimbingan" value="" />
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
                <input name="kelas" placeholder="Kelas" id="kelas_siswa" class='form-control' type="text" readonly></input>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Tanggal</label>
              <div class="col-md-9">
                <input name="tanggal_bimbingan" placeholder="Tanggal Bimbingan" class="form-control" type="date">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Permasalahan</label>
              <div class="col-md-9">
                <textarea name="masalah_siswa" placeholder="Permasalahan Siswa" class="form-control" type="text"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Solusi Permasalahan</label>
              <div class="col-md-9">
                <textarea name="solusi_bimbingan" placeholder="Solusi Permasalahan Siswa" class="form-control" type="text"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Keterangan</label>
              <div class="col-md-4">
                <select name="keterangan" class="form-control">
                  <option value="Teratasi">Teratasi</option>
                  <option value="Proses">Proses</option>
                  <option value="Belum Teratasi">Belum Teratasi</option>
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
  <!-- End Bootstrap modal -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
