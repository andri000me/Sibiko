    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Kategori Pelanggaran</h1>
                </div>
            </div>

  <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>


  <ul class="nav nav-tabs nav-justified" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">kategori</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Sub Kategori</a></li>
  </ul></br>
    <div class="row">
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="home">
          <div class="col-md-6 col-md-4">
    <div class="panel panel-primary">
      <div class="panel-heading ">Tambah Kategori Pelanggaran</div>
        <div class="panel-body">
              <form method="post" action="<?php base_url();?>kategori/add_kategori">
                <div class="form-group" hidden=""></br>
                  <label>Id Kategori</label>
                  <input type="text" class="form-control" name="id_kategori" value="">
                </div>
                <div class="form-group"></br>
                  <label>Nama Kategori</label>
                  <input type="text" class="form-control" name="nama_pelanggaran" placeholder="Nama Kategori...">
                </div>
                <button type="submit" class="btn btn-default">Tambah</button>
              </form>
            </div>
          </div>
      </div>

  <div class="col-sm-6 col-md-8">
    <div class="panel panel-primary">
        <div class="panel-heading ">Kategori Pelanggaran</div>
          <div class="panel-body">
              <table class="table table-bordered" width="100%">
                <tr>
                 <th>Id</th>
                 <th>Pelanggaran</th>
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
                   <td><?php echo $row->id_kategori;?></td>
                   <td><?php echo $row->nama_pelanggaran;?></td>
                   <td>
                     <a href="javascript:void()" title="Edit" onclick="edit_kategori('<?php echo $row->id_kategori; ?>')">Edit</a>
                     <a href="javascript:void()" title="Edit" onclick="delete_kategori('<?php echo $row->id_kategori; ?>')">Hapus</a>
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

        <!-- Tab Subkategori -->
        <div role="tabpanel" class="tab-pane fade" id="profile">
        <div class="col-md-6 col-md-4">
        <div class="panel panel-primary">
        <div class="panel-heading ">Tambah Kategori Pelanggaran</div>
        <div class="panel-body">
              <form method="post" action="<?php base_url(); ?>kategori/add_subkategori">
              <div class="form-group" hidden=""></br>
                  <label>Id Sub Kategori</label>
                  <input type="text" class="form-control" name="id_subkategori" value="">
                </div>
                <div class="form-group"></br>
                  <label>Kategori</label>
                  <select name="id_kategori" class="form-control" id="id_kategori" required>
                    <option value="KERAJINAN">- Pilih Kategori -</option>
                    <?php foreach($kategori as $kat){
                      echo '<option value="'.$kat->id_kategori.'">'.$kat->nama_pelanggaran.'</option>';
                    } ?>
                  </select>
                </div>
                 <div class="form-group">
                  <label>Sub Kategori</label>
                  <textarea type="" class="form-control" name="deskripsi_pelanggaran" placeholder="Deskripsi kategori" required></textarea>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Point</label>
                    <input class="form-control" name="point_pelanggaran" type="number" max="100" required>
                  </div>
                <button type="submit" class="btn btn-default">Tambah</button>
              </form>
            </div>
          </div>
        </div>
    <div class="col-xs-12 col-sm-6 col-md-8">
       <div role="tabpanel" class="tab-pane active" id="list_subkategori">
              <div class="panel panel-primary">
                <div class="panel-heading ">Sub Kategori Pelanggaran</div>
                <div class="panel-body">
                  <div role="tabpanel" class="tab-pane" id="datasublist_subkategori">
                    <table id="table2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Kategori</th>
                          <th>Deskripsi Pelanggaran</th>
                          <th>Point</th>
                          <th></th>
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
            "url": "<?php echo site_url('kategori/ajax_list')?>",
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


    function edit_kategori(id_kategori)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('kategori/edit_kategori/')?>/"+ id_kategori,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
           
            $('[name="id_kategori"]').val(data.id_kategori);
            $('[name="nama_pelanggaran"]').val(data.nama_pelanggaran);
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Kategori');

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }

    function save_kategori()
    {
      var url;
      if(save_method == 'add') 
      {
          url = "<?php echo site_url('kategori/add_kategori')?>";
      }
      else
      {
        url = "<?php echo site_url('kategori/update_kategori')?>";
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




    function delete_kategori(id_kategori)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('kategori/delete_kategori')?>/"+id_kategori,
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


    function edit_subkategori(id_subkategori)
    {
      save_method = 'update';
      $('#form2')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('kategori/edit_subkategori/')?>/"+id_subkategori,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
           
            $('[name="id_subkategori"]').val(data.id_subkategori);
            $('[name="id_kategori"]').val(data.id_kategori);
            $('[name="deskripsi_pelanggaran"]').val(data.deskripsi_pelanggaran);
            $('[name="point_pelanggaran"]').val(data.point_pelanggaran);  
            
            $('#modal-subkategori').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Pelanggaran'); // Set title to Bootstrap modal title
            
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

    function save_subkategori()
    {
      var url;
      if(save_method == 'add') 
      {
          url = "<?php echo site_url('kategori/add_subkategori')?>";
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form2').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal-subkategori').modal('hide');
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
        url = "<?php echo site_url('kategori/update_subkategori')?>";
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form2').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal-subkategori').modal('hide');
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


    function delete_subkategori(id_subkategori)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('kategori/delete_subkategori')?>/"+id_subkategori,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               //if success reload ajax table
               $('#modal-subkategori').modal('hide');
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
        <input type="hidden" name="id_kategori" id="id_kategori" />
          <div class="form-body">
             <div class="form-group">
              <label class="control-label col-md-3">Nama Pelanggaran</label>
              <div class="col-md-9">
                <input class="form-control" name="nama_pelanggaran" id="nama_pelanggaran" type="text">
              </div>
            </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_kategori()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </div>
  <!-- End Bootstrap modal -->

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal-subkategori" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Edit Sub Kategori</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form2" class="form-horizontal">
        <input type="hidden" name="id_subkategori" value="" />
          <div class="form-body">
             <div class="form-group">
              <label class="control-label col-md-3">Kategori Pelanggaran</label>
              <div class="col-md-9">
                <input class="form-control" name="id_kategori" type="text" readonly="readonly">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Deskripsni Pelanggaran</label>
              <div class="col-md-9">
                <textarea class="form-control" name="deskripsi_pelanggaran" type="text" autofocus="autofocus"></textarea>
              </div>
            </div>
             <div class="row">
              <label class="control-label col-md-3">Point</label>
              <div class="col-xs-2">
                <input class="form-control" name="point_pelanggaran" type="text">
              </div>
            </div>
            </br>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_subkategori()" class="btn btn-primary">Save</button>
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