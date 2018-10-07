<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Laporan Bimbingan dan Konseling <?php echo 'Bojonegoro, '. date('d F Y', strtotime(date("Y-m-d"))); ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('assets//bower_components/metisMenu/dist/metisMenu.min.css')?>" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url('assets/dist/css/timeline.css')?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/dist/css/sb-admin-2.css')?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url('assets/bower_components/morrisjs/morris.css')?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">


</head>
<body onload="window.print()">
	<table width="100%">
		<th width="10%"><img src="<?php echo base_url(); ?>assets/dist/img/logo-smk2-128x128.jpg" alt="Smiley face" height="75" width="60"></th>
		<th width="80%" class="text-center">
		<h3><strong>SMK NEGERI 2 BOJONEGORO</strong></h3>
		<h5>
		Jl. Pattimura No.03 Kel. Sumbang Kec. Bojonegoro 62115<br>
		Telp/Fax. (0353) 881912 Email : smkn2.bojonegoro@yahoo.com
		</h5>
		</th>
		<th width="10%"></th>
	</table>
	<hr>

		<h4 class="text-center"><strong>LAPORAN BIMBINGAN DAN KONSELING SISWA</strong></h4><br>
	<div class="row">
	    <div class="col-xs-12 col-sm-6 col-md-8">
	    	   <table class="table">
	    	    <tr>
                	<h4><strong>Keterangan Tentang Diri Siswa</strong></h4>
                </tr>
                <?php
			       foreach($data2 as $row){
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
                	<td width="160px">Nama</td>
                	<td width="5px">:</td>
                	<td><?php echo $row->nama_siswa;?></td>
                	<td rowspan="4" width="150px"><right><img src="<?php echo base_url(); ?>assets/foto/<?php echo $row->nis; ?>.jpg" onerror="this.src='<?php echo base_url(); ?>assets/foto/default.jpg'" height="150" width="130"></right></td>
                </tr>
                <tr>
                	<td width="160px">NIS</td>
                	<td width="5px">:</td>
                	<td><?php echo $nis1.'/'.$nis2.'.'.$nis3;?></td>
                </tr>
                <tr>
                	<td width="160px">Tempat Tanggal Lahir</td>
                	<td width="5px">:</td>
                	<td>
                		<?php echo $row->tempat_lahir_siswa;?>, 
                		<?php echo date('j', strtotime(date($row->tanggal_lahir_siswa))).' '.$bulan[date('n',strtotime(date($row->tanggal_lahir_siswa)))].' '.date('Y', strtotime(date($row->tanggal_lahir_siswa))); ?>
                	</td>
                </tr>
                <tr>
                	<td width="160px">Agama</td>
                	<td width="5px">:</td>
                	<td><?php echo $row->agama_siswa;?></td>
                </tr>
                <tr>
                	<td width="160px">Kelas</td>
                	<td width="5px">:</td>
                	<td><?php echo $row->kelas_siswa;?></td>
                </tr>
                <tr>
                	<td width="160px">Alamat</td>
                	<td width="5px">:</td>
                	<td><?php echo $row->alamat_siswa;?></td>
                </tr>
                <?php
                
			        }
			     ?>
               	</table>
               	<table class="table">
                 <tr>
                	<h4><strong>Keterangan Bimbingan Konseling</strong></h4>
                </tr>
                <?php
                $no=1;
			      if(empty($data))
			      {
			        echo "<tr><td colspan=\"6\">Data tidak tersedia</td></tr>";
			      } else{
			       foreach($data as $row)
			      {    
			    ?>
                <tr>
                <td width="10px" class="text-center" rowspan="4"><?php echo $no;?>.</td>
                	<td width="160px">Tanggal</td>
                	<td width="5px">:</td>
                	<td><?php echo date('j', strtotime(date($row->tanggal_bimbingan))).' '.$bulan[date('n',strtotime(date($row->tanggal_bimbingan)))].' '.date('Y', strtotime(date($row->tanggal_bimbingan))); ?></td>
                	
                </tr>
                <tr>
                    <td width="160px">Kelas</td>
                    <td width="5px">:</td>
                    <td><?php echo $row->kelas;?></td>
                </tr>
                <tr>
                	<td width="160px">Permasalahan</td>
                	<td width="5px">:</td>
                	<td><?php echo $row->masalah_siswa;?></td>
                </tr>
                <tr>
                	<td width="160px">Solusi dari konselor</td>
                	<td width="10px">:</td>
                	<td><?php echo $row->solusi_bimbingan;?></td>
                </tr>
                <?php
                $no++;
			        }}
			     ?>
               </table>
	</div>

</body>

</html>