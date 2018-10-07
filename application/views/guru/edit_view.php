    <div id="page-wrapper"><br>
    
   <div class="row">
      <div class="col-lg-4">
        <div class="panel panel-info">
          <div class="panel-heading">
           <i class="fa fa-bell fa-fw"></i> Edit Akun
          </div>
          <div class="panel-body">
           <div class="list-group">
          <table class="table">
          
          <?php
             foreach($dataguru as $row){
          ?>

                <?php 
                    $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu");
                    $bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                    //echo $hari[date("w")].", ".date("j")." ".$bulan[date("n")]." ".date("Y");
                 ?>
                <tr>                </tr>
                <tr>
                  <td width="100px">Id User</td>
                  <td width="5px">:</td>
                  <td><?php echo $row->u_id;?></td>
                </tr>
                <tr>
                  <td width="100px">Nama</td>
                  <td width="5px">:</td>
                  <td><?php echo $row->nama;?></td>
                </tr>
                <tr>
                  <td width="100px">username</td>
                  <td width="5px">:</td>
                  <td><?php echo $row->username;?></td>
                </tr>
                <tr>
                  <td width="100px">Role</td>
                  <td width="5px">:</td>
                  <td><?php echo $row->role;?></td>
                </tr>
                
                <?php
                  }
               ?>
                </table>
                <a class="btn btn-success btn-block" href="javascript:void()" title="Edit" 
                onclick="edit_user('<?php echo $row->u_id;?>')"><i class="glyphicon glyphicon-pencil"></i></a>
           </div>
          </div>
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
   function edit_user(u_id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('user/ajax_edit/')?>/" + u_id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
           
            $('[name="u_id"]').val(data.u_id);
            $('[name="nama"]').val(data.nama);
            $('[name="username"]').val(data.username);
            $('[name="password"]').val(data.password);
            $('[name="role"]').val(data.role);
            
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
          url = "<?php echo site_url('user/ajax_add')?>";
      }
      else if(save_method == 'import') 
      {
        url = "<?php echo site_url('user/importcsv')?>";
      }
      else
      {
        url = "<?php echo site_url('user/ajax_update')?>";
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

    function delete_user(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('user/ajax_delete')?>/"+id,
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
              <label class="control-label col-md-3">Id</label>
              <div class="col-md-9">
                  <input name="u_id" placeholder="Nomor Induk Siswa" class="form-control" type="text" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Nama</label>
              <div class="col-md-9">
                <input name="nama" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Username</label>
              <div class="col-md-9">
                <input name="username" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Password</label>
              <div class="col-md-9">
                <input name="password" placeholder="Tempat Lahir" class="form-control" type="password">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Role</label>
              <div class="col-md-9">
                <input name="role" placeholder="Last Name" class="form-control" type="text" readonly>
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