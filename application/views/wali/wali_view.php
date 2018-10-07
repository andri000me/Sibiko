    <div id="page-wrapper"><br>
  <div class="panel panel-default">
      <div class="panel-heading">
         <h4>Selamat datang <?php echo $this->session->userdata('nama'); ?></h4>
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
                        <form class="form-inline" action="bimbingan/laporan_siswa_semua" target="_blank" method="POST">
                    <input name="nis" hidden type="text" value="<?php echo $row->nis; ?>" >
                    <input type=submit class="btn btn-success btn-block" value="Print">
                  </form>
                        <?php
                        $no++;
                      }}
                   ?>
                 </table>
                 </div>
                  </div>
                  
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
<form class="form-inline" action="pelanggaran/laporan_siswa_semua" target="_blank" method="POST">
                    <input name="nis" hidden type="text" value="<?php echo $row->nis; ?>" >
                    <input type=submit class="btn btn-success btn-block" value="Print">
                  </form>
                 </div>
                  </div>
                  
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
                        <form class="form-inline" action="penghargaan/laporan_siswa_semua" target="_blank" method="POST">
                    <input name="nis" hidden type="text" value="<?php echo $row->nis; ?>" >
                    <input type=submit class="btn btn-success btn-block" value="Print">
                  </form>
                        <?php
                        $no++;
                      }}
                   ?>
                 </table>
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

  <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
 
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->