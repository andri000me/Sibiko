    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">SubKategori Pelanggaran</h1>
                </div>
            </div>

  <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>

    <div class="row">
      <div class="col-md-6 col-md-4">
        <div class="panel panel-primary">
        <div class="panel-heading ">Tambah Data Kategori Pelanggaran</div>
        <div class="panel-body">
              <form method="post" action="<?php base_url(); ?>kategori/add_subkategori">
              <div class="form-group" hidden=""></br>
                  <label>Id Sub Kategori</label>
                  <input type="text" class="form-control" name="id_subkategori">
                </div>
                <div class="form-group"></br>
                  <label>Kategori</label>
                  <select name="nama_pelanggaran" class="form-control" id="nama_pelanggaran">
                    <option>- Pilih Kategori -</option>
                    <?php foreach($kategori as $kat){
                      echo '<option value="'.$kat->nama_pelanggaran.'">'.$kat->nama_pelanggaran.'</option>';
                    } ?>
                  </select>
                </div>
                 <div class="form-group">
                  <label>Sub Kategori</label>
                  <textarea type="" class="form-control" name="deskripsi_pelanggaran" placeholder="Deskripsi kategori"></textarea>
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
                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Nama Pelanggaran</th>
                          <th>Deskripsi Pelanggaran</th>
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
    

  <script type="text/javascript">

    var save_method; //for save method string
    var table;
    $(document).ready(function() {
      table = $('#table').DataTable({ 
        
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

//====================================================//
    function edit_subkategori(id_subkategori)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('kategori/edit_subkategori/')?>"+id_subkategori,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
           
            $('[name="id_subkategori"]').val(data.id_subkategori);
            $('[name="nama_pelanggaran"]').val(data.nama_pelanggaran);
            $('[name="deskripsi_pelanggaran"]').val(data.deskripsi_pelanggaran);
            
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

    function save()
    {
      var url;
      if(save_method == 'add') 
      {
          url = "<?php echo site_url('kategori/add_subkategori')?>";
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
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
            data: $('#form_edit').serialize(),
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
  <div class="modal fade" id="modal-subkategori" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Edit Kategori</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
        <input type="hidden" name="id_kategori" value="" />
          <div class="form-body">
             <div class="form-group">
              <label class="control-label col-md-3">NIS</label>
              <div class="col-md-9">
                <input name="nama_kategori" placeholder="Nomor Induk Siswa" id="autocomplete" class='autocomplete form-control 8' type="text" autofocus="autofocus">
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