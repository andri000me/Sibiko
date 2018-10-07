    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Guru</h1>
                </div>
            </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <button class="btn btn-success" onclick="add_guru()"><i class="glyphicon glyphicon-plus"></i> Add Guru</button>
        <button class="btn btn-primary" onclick="upload_guru()"><i class="glyphicon glyphicon-upload"></i> Upload</button>
      </div>
    </div>
    

    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th style="width:10px;">ID Guru</th>
          <th style="width:250px;">Nama</th>
          <th>Alamat</th>
          <th style="width:50px;">Jabatan</th>
          <th style="width:50px;">Status</th>
          <th style="width:165px;">Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>

      <tfoot>
        <tr>
          <th>ID Guru</th>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Jabatan</th>
          <th>Status</th>
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
            "url": "<?php echo site_url('guru/ajax_list')?>",
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

    function add_guru()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Add Guru'); // Set Title to Bootstrap modal title
    }

     function upload_guru()
    {
      save_method = 'import';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_upload').modal('show'); // show bootstrap modal
      $('.modal-title').text('Upload Siswa'); // Set Title to Bootstrap modal title
    }

    function edit_guru(id_guru)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('guru/ajax_edit/')?>/" + id_guru,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
           
            $('[name="id_guru"]').val(data.id_guru);
            $('[name="nama_guru"]').val(data.nama_guru);
            $('[name="alamat_guru"]').val(data.alamat_guru);
            $('[name="jabatan_guru"]').val(data.jabatan_guru);
            $('[name="no_telepon_guru"]').val(data.no_telepon_guru);
            $('[name="status"]').val(data.status);
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Guru'); // Set title to Bootstrap modal title
            
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
          url = "<?php echo site_url('guru/ajax_add')?>";
      }
      else
      {
        url = "<?php echo site_url('guru/ajax_update')?>";
      }

       // ajax adding data to database
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

    function delete_guru(id_guru)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('guru/ajax_delete')?>/"+id_guru,
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
  <div>
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Guru Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
        <input type="hidden" name="id_guru" value=""/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Nama</label>
              <div class="col-md-9">
                <input name="nama_guru" placeholder="Nama Guru" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Alamat</label>
              <div class="col-md-9">
                <textarea name="alamat_guru" placeholder="Alamat"class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Jabatan</label>
              <div class="col-md-9">
                <input name="jabatan_guru" placeholder="Jabatan" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">No Telp / Hp</label>
              <div class="col-md-9">
                <input name="no_telepon_guru" placeholder="Nomor Telepon / HP" class="form-control" type="number">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Status</label>
              <div class="col-md-9">
                <select name="status" class="form-control">
                  <option value="PNS">PNS</option>
                  <option value="GTT">GTT</option>
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

  <!-- Bootstrap modal upload-->
   <div class="modal fade" id="modal_upload" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Upload Siswa</h3>
      </div>
      <div class="modal-body form">
        <form action='<?php echo site_url('guru/importcsv')?>' class="form-horizontal" method="POST" enctype="multipart/form-data">
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