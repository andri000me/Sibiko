<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Laporan Pelangggaran Siswa <?php echo 'Bojonegoro, '. date('d F Y', strtotime(date("Y-m-d"))); ?></title>

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

		<h4 class="text-center"><strong>LAPORAN PELANGGARAN SISWA</strong></h4><br>

	<table class="table table-bordered">
	    <strong>
		    <tr style="background-color: #CECECE">
		       <th class="text-center">No</th>
		       <th width="35%" class="text-center">Nama Siswa</th>
		       <th width="20%" class="text-center">Kelas</th>
		       <th width="30%"class="text-center">Tanggal</th>
		       <th width="15%" class="text-center">Total Point</th>
		    </tr>
	    </strong>
	    <?php
	     $no=1;
	      if(empty($data))
	      {
	        echo "<tr><td colspan=\"6\">Data tidak tersedia</td></tr>";
	      } else{
	       foreach($data as $row)
	      {      
	    ?>

	    <?php 
                    $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu");
                    $bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                    //echo $hari[date("w")].", ".date("j")." ".$bulan[date("n")]." ".date("Y")
	     ?>

	    <tr>
	      <td class="text-center"><?php echo $no;?></td>
	      <td><?php echo $row->nama_siswa;?></td>
	      <td class="text-center"><?php echo $row->kelas;?></td>
	      <td class="text-center"><?php echo date('j', strtotime(date($row->tanggal_pelanggaran))).' '.$bulan[date('n',strtotime(date($row->tanggal_pelanggaran)))].' '.date('Y', strtotime(date($row->tanggal_pelanggaran)));?></td>
	      <td class="text-center"><?php echo $row->total;?></td>
	    </tr>
	     <?php
	     $no++;
	        }}
	     ?>

    </table>
    <br>
    <br>
    <br>
    <table width="100%">
        <th width="30%"></th>
        <th width="30%"></th>
        <th width="40%">
        <center><?php echo 'Bojonegoro, '. date('j').' '.$bulan[date('n')].' '.date('Y'); ?>
        <br>
        Mengetahui,<br>
        Guru Konselor<br><br><br>
        _______________________<br>
        </center>
        &emsp;&emsp;&emsp;Nip.
        </th>
    </table>

</body>

</html>