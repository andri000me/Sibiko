    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Kelas Siswa</h1>
                </div>
            </div>

  <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>

    <div class="row">
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="home">
          <div class="col-md-6 col-md-4">
    <div class="panel panel-primary">
      <div class="panel-heading ">Tambah Kelas</div>
        <div class="panel-body">
              <form method="post" action="<?php base_url();?>kelas/add_kelas">
                <div class="form-group">
                  <label>Kode Kelas</label>
                  <input type="text" class="form-control" name="kode_kelas" placeholder="Kode kelas">
                </div>
                <div class="form-group">
                  <label>Nama Kelas</label>
                  <input type="text" class="form-control" name="nama_kelas" placeholder="Nama Kelas...">
                </div>
                <div class="form-group">
                  <label>Wali Kelas</label>
                  <select name="wali_kelas" class="form-control" id="wali_kelas">
                    <option value="">- Pilih Guru -</option>
                    <?php foreach($id_guru as $wali){
                      echo '<option value="'.$wali->id_guru.'">'.$wali->nama_guru.'</option>';
                    } ?>
                  </select>
                </div>
                <button type="submit" class="btn btn-default">Tambah</button>
              </form>
            </div>
          </div>
      </div>

  <div class="col-sm-6 col-md-8">
    <div class="panel panel-primary">
        <div class="panel-heading ">Daftar Kelas</div>
          <div class="panel-body">
                  <div role="tabpanel" class="tab-pane" id="datasublist_subkategori">
                    <table id="table2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Kode Kelas</th>
                          <th>Nama Kelas</th>
                          <th>Wali Kelas</th>
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


  <script type="text/javascript">

    var save_method; //for save method string
    var table;
    $(document).ready(function() {
      table = $('#table2').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('kelas/ajax_list')?>",
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


    function edit_kelas(kode_kelas)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('kelas/edit_kelas/')?>/"+ kode_kelas,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
           
            $('[name="kode_kelas"]').val(data.kode_kelas);
            $('[name="nama_kelas"]').val(data.nama_kelas);
            $('[name="wali_kelas"]').val(data.wali_kelas);
            
            $('#modal_form_edit').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Kelas');

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }

    function save_kelas()
    {
      var url;
      if(save_method == 'add') 
      {
          url = "<?php echo site_url('kelas/add_kelas')?>";
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
      else
      {
        url = "<?php echo site_url('kelas/update_kelas')?>";
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
               $('#modal_form_edit').modal('hide');
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

    function delete_kelas(kode_kelas)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('kelas/delete_kelas')?>/"+kode_kelas,
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

  </script>

      <!-- Bootstrap modal -->
</div>
  <div class="modal fade" id="modal_form_edit" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Edit Kelas</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
        <input type="hidden" name="kode_kelas" id="kode_kelas" value="" />
          <div class="form-body">
             <div class="form-group">
              <label class="control-label col-md-3">Nama Kelas</label>
              <div class="col-md-9">
                <input class="form-control" name="nama_kelas" id="nama_kelas" type="text">
              </div>
            </div>
          <div class="form-group">
             <label class="control-label col-md-3">Wali Kelas</label>
              <div class="col-md-9">
               <select name="wali_kelas" class="form-control" id="wali_kelas">
                    <option value="">- Pilih Guru -</option>
                    <?php foreach($id_guru as $wali){
                      echo '<option value="'.$wali->id_guru.'">'.$wali->nama_guru.'</option>';
                    } ?>
                  </select>
              </div>
              </div>
           </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_kelas()" class="btn btn-primary">Save</button>
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