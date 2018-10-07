    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Kategori Penghargaan</h1>
                </div>
            </div>

  <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>


  <ul class="nav nav-tabs nav-justified" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">kategori penghargaan</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Sub Kategori</a></li>
  </ul></br>
    <div class="row">
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="home">
          <div class="col-md-6 col-md-4">
    <div class="panel panel-primary">
      <div class="panel-heading ">Tambah Kategori Penghargaan</div>
        <div class="panel-body">
              <form method="post" action="<?php base_url();?>kategori_penghargaan/add_kategori_penghargaan">
                <div class="form-group" hidden=""></br>
                  <label>Id Kategori</label>
                  <input type="text" class="form-control" name="id_kategori_penghargaan" value="">
                </div>
                <div class="form-group"></br>
                  <label>Nama Kategori</label>
                  <input type="text" class="form-control" name="nama_penghargaan" placeholder="Nama Kategori...">
                </div>
                <button type="submit" class="btn btn-default">Tambah</button>
              </form>
            </div>
          </div>
      </div>

  <div class="col-sm-6 col-md-8">
    <div class="panel panel-primary">
        <div class="panel-heading ">Kategori Penghargaan</div>
          <div class="panel-body">
              <table class="table table-bordered" width="100%">
                <tr>
                 <th>Id</th>
                 <th>Penghargaan</th>
                 <th></th>
                </tr>
                 <?php
                   if(empty($query))
                     {
                       echo "<tr><td colspan=\"6\">Data tidak tersedia</td></tr>";
                       } else
                     {
                      foreach($query as $row)
                     {
                 ?>
                 <tr>
                   <td><?php echo $row->id_kategori_penghargaan;?></td>
                   <td><?php echo $row->nama_penghargaan;?></td>
                   <td>
                     <a href="javascript:void()" title="Edit" onclick="edit_kategori_penghargaan('<?php echo $row->id_kategori_penghargaan; ?>')">Edit</a>
                     <a href="javascript:void()" title="Edit" onclick="delete_kategori_penghargaan('<?php echo $row->id_kategori_penghargaan; ?>')">Hapus</a>
                   </td>
                 </tr>
                 <?php
                 }}
                 ?>
                 </table>
            </div>
          </div>
         </div>
        </div>

        <!-- Tab Subkategori_penghargaan -->
        <div role="tabpanel" class="tab-pane fade" id="profile">
        <div class="col-md-6 col-md-4">
        <div class="panel panel-primary">
        <div class="panel-heading ">Tambah Kategori Penghargaan</div>
        <div class="panel-body">
              <form method="post" action="<?php base_url(); ?>kategori_penghargaan/add_subkategori_penghargaan">
              <div class="form-group" hidden=""></br>
                  <label>Id Sub Kategori</label>
                  <input type="text" class="form-control" name="id_subkategori_penghargaan" value="">
                </div>
                <div class="form-group"></br>
                  <label>Kategori</label>
                  <select name="id_kategori_penghargaan" class="form-control" id="id_kategori_penghargaan" required>
                    <option value="KERAJINAN">- Pilih Kategori -</option>
                    <?php foreach($kategori_penghargaan as $kat){
                      echo '<option value="'.$kat->id_kategori_penghargaan.'">'.$kat->nama_penghargaan.'</option>';
                    } ?>
                  </select>
                </div>
                 <div class="form-group">
                  <label>Sub Kategori</label>
                  <textarea type="" class="form-control" name="deskripsi_penghargaan" placeholder="Deskripsi kategori_penghargaan" required></textarea>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Point</label>
                    <input class="form-control" name="point_penghargaan" type="number" max="100" required>
                  </div>
                <button type="submit" class="btn btn-default">Tambah</button>
              </form>
            </div>
          </div>
        </div>
    <div class="col-xs-12 col-sm-6 col-md-8">
       <div role="tabpanel" class="tab-pane active" id="list_subkategori_penghargaan">
              <div class="panel panel-primary">
                <div class="panel-heading ">Sub Kategori Penghargaan</div>
                <div class="panel-body">
                  <div role="tabpanel" class="tab-pane" id="datasublist_subkategori_penghargaan">
                    <table id="table2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Kategori</th>
                          <th>Deskripsi Penghargaan</th>
                          <th>Point</th>
                          <th width="120"></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
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
    $(document).ready(function() {
      table = $('#table2').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('kategori_penghargaan/ajax_list')?>",
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


    function edit_kategori_penghargaan(id_kategori_penghargaan)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('kategori_penghargaan/edit_kategori_penghargaan/')?>/"+ id_kategori_penghargaan,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
           
            $('[name="id_kategori_penghargaan"]').val(data.id_kategori_penghargaan);
            $('[name="nama_penghargaan"]').val(data.nama_penghargaan);
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Kategori');

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }

    function save_kategori_penghargaan()
    {
      var url;
      if(save_method == 'add') 
      {
          url = "<?php echo site_url('kategori_penghargaan/add_kategori_penghargaan')?>";
      }
      else
      {
        url = "<?php echo site_url('kategori_penghargaan/update_kategori_penghargaan')?>";
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
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }

    function reload_table()
    {
      table.ajax.reload(null,false); //reload datatable ajax 
    }




    function delete_kategori_penghargaan(id_kategori_penghargaan)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('kategori_penghargaan/delete_kategori_penghargaan')?>/"+id_kategori_penghargaan,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               //if success reload ajax table
               $('#modal_form').modal('hide');
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
         
      }
    }


    function edit_subkategori_penghargaan(id_subkategori_penghargaan)
    {
      save_method = 'update';
      $('#form2')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('kategori_penghargaan/edit_subkategori_penghargaan/')?>/"+id_subkategori_penghargaan,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
           
            $('[name="id_subkategori_penghargaan"]').val(data.id_subkategori_penghargaan);
            $('[name="id_kategori_penghargaan"]').val(data.id_kategori_penghargaan);
            $('[name="deskripsi_penghargaan"]').val(data.deskripsi_penghargaan);
            $('[name="point_penghargaan"]').val(data.point_penghargaan);  
            
            $('#modal-subkategori_penghargaan').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Penghargaan'); // Set title to Bootstrap modal title
            
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


    function delete_subkategori_penghargaan(id_subkategori_penghargaan)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('kategori_penghargaan/delete_subkategori_penghargaan')?>/"+id_subkategori_penghargaan,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               //if success reload ajax table
               $('#modal-subkategori_penghargaan').modal('hide');
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
  <div class="modal fade" id="modal_form" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Edit Kategori</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
        <input type="hidden" name="id_kategori_penghargaan" id="id_kategori_penghargaan" />
          <div class="form-body">
             <div class="form-group">
              <label class="control-label col-md-3">Nama Penghargaan</label>
              <div class="col-md-9">
                <input class="form-control" name="nama_penghargaan" id="nama_penghargaan" type="text">
              </div>
            </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_kategori_penghargaan()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </div>
  <!-- End Bootstrap modal -->

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal-subkategori_penghargaan" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Edit Sub Kategori</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form2" class="form-horizontal">
        <input type="hidden" name="id_subkategori_penghargaan" value="" />
          <div class="form-body">
             <div class="form-group">
              <label class="control-label col-md-3">Kategori Penghargaan</label>
              <div class="col-md-9">
                <input class="form-control" name="id_kategori_penghargaan" type="text" readonly="readonly">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Deskripsni Penghargaan</label>
              <div class="col-md-9">
                <textarea class="form-control" name="deskripsi_penghargaan" type="text" autofocus="autofocus"></textarea>
              </div>
            </div>
             <div class="row">
              <label class="control-label col-md-3">Point</label>
              <div class="col-xs-2">
                <input class="form-control" name="point_penghargaan" type="text">
              </div>
            </div>
            </br>
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