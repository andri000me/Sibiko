
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $jumlah_siswa; ?></div>
                                    <div>Siswa</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php base_url() ?>siswa">
                            <div class="panel-footer">
                                <span class="pull-left">Lihat</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-share fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $jumlah_bimbingan; ?></div>
                                    <div>Bimbingan</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php base_url() ?>bimbingan">
                            <div class="panel-footer">
                                <span class="pull-left">Lihat</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-edit fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $jumlah_kejadian; ?></div>
                                    <div>Kejadian</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php base_url() ?>pelanggaran">
                            <div class="panel-footer">
                                <span class="pull-left">Lihat</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-star fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $jumlah_penghargaan; ?></div>
                                    <div>Penghargaan</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php base_url() ?>penghargaan">
                            <div class="panel-footer">
                                <span class="pull-left">Lihat</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                        <!-- /.panel-heading -->
                <div class="col-lg-8">
                <div class="panel panel-danger">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Siswa dengan Total Point kejadian terbanyak Tahun <?php echo date("Y"); ?>
                        </div>
                    <table class="table table-bordered">
                <tr>
                 <th width="10">No</th>
                 <th style="text-align: center;">NIS</th>
                 <th style="text-align: center;">Nama Siswa</th>
                 <th style="text-align: center;">Kelas</th>
                 <th style="text-align: center;" width="100">Foto</th>
                 <th width="20">Point</th>
                </tr>
                 <?php
                 $no = 1;
                   if(empty($query))
                     {
                       echo "<tr><td colspan=\"6\">Data tidak tersedia</td></tr>";
                       } else
                     {
                      foreach($kejadian as $row)
                     { 
                 ?>

                 <tr>
                   <td style="vertical-align:middle" align="center"><?php echo $no;?></td>
                   <td style="vertical-align:middle"><?php echo $row->nis;?></td>
                   <td style="vertical-align:middle"><?php echo $row->nama_siswa;?></td>
                   <td style="vertical-align:middle" align="center"><?php echo $row->kelas_siswa;?></td>
                   <td>
                    <img src="<?php echo base_url(); ?>assets/foto/<?php echo $row->nis; ?>.jpg" onerror="this.src='<?php echo base_url(); ?>assets/foto/default.jpg'" height="100" width="80">
                   </td>
                   <td style="vertical-align:middle" align="center"><?php echo $row->total;?></td>
                 </tr>

                 

                 <?php
                 $no++;
                 }}
                 ?>
                 </table>
                </div>
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-gift fa-fw"></i> Ranking Point Penghargaan Tahun <?php echo date("Y") ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <table class="table table-bordered">
                <tr>
                 <th style="text-align: center;">Nama Siswa</th>
                 <th style="text-align: center;">Kelas</th>
                 <th style="text-align: center;" width="100">Foto</th>
                 <th width="20">Point</th>
                </tr>
                    
                 <?php
                 $no = 1;
                   if(empty($query))
                     {
                       echo "<tr><td colspan=\"6\">Data tidak tersedia</td></tr>";
                       } else
                     {
                      foreach($penghargaan as $row)
                     { 
                 ?>

                 
                 <tr>
                   <td style="vertical-align:middle"><?php echo $row->nama_siswa;?></td>
                   <td style="vertical-align:middle" align="center"><?php echo $row->kelas_siswa;?></td>
                   <td>
                   <img src="<?php echo base_url(); ?>assets/foto/<?php echo $row->nis; ?>.jpg" onerror="this.src='<?php echo base_url(); ?>assets/foto/default.jpg'" height="100" width="80">
                   </td>
                   <td style="vertical-align:middle" align="center"><?php echo $row->total_penghargaan;?></td>
                 </tr>
                 <?php
                 $no++;
                 }}
                 ?>
                 </table>
                            </div>
                            <!-- /.list-group -->
                            <a href="<?php base_url(); ?>penghargaan" class="btn btn-default btn-block">Lihat Semua Data</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
