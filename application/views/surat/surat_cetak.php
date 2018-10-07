<?php
class PDF extends FPDF
{
	//Page header

    function Header()
	{
             //   $this->setFont('Arial','',10);
             //   $this->setFillColor(255,255,255);
             //   $this->cell(100,6,"Laporan daftar pegawai gubugkoding.com",0,0,'L',1); 
             //   $this->cell(100,6,"Printed date : " . date('d/m/Y'),0,1,'R',1); 
               
                
                if ($this->PageNo()>1) {
                     # code...
                 } else {
                $this->Image(base_url().'assets/dist/img/logo-smk2-128x128.jpg', 180, 10,'20','28','jpeg');
                $this->Image(base_url().'assets/dist/img/dinas.png', 10, 10,'20','28');
                $this->setFillColor(255,255,255);
                $this->cell(5,0,'',0,0,'C',0);
                $this->setFont('Arial','B',14);
                $this->cell(0,8,'PEMERINTAH KABUPATEN BOJONEGORO',0,1,'C',0);  
                $this->cell(0,8,'DINAS PENDIDIKAN',0,1,'C',0);  
                $this->setFont('Arial','B',18);
                $this->cell(0,8,'SMK NEGERI 2 BOJONEGORO',0,1,'C',0); 
                $this->setFont('Arial','',12);
                $this->cell(5,5,'',0,0,'C',0); 
                $this->cell(0,6,"Jl. PATTIMURA NO.03 TELP. (0353) 881912 BOJONEGORO 62115",0,1,'C',0); 
                $this->line(10,41,200,41);
                $this->Line(10,41,200,41);
                $this->Line(10,42,200,42);
                

                 }
                
                
	}
 
	function Content($data)
	{      
            foreach ($data as $key) {
                $this->setFillColor(255,255,255);
                $this->Ln(8);
                $this->setFont('Arial','','B',12);
                $this->cell(0,8,'Bojonegoro, '. date('d F Y', strtotime(date("Y-m-d"))),0,1,'R',0); 
                $this->Ln(8);
                $this->cell(30,5,'Nomor',0,0,'L',1);
                $this->cell(5,5,':',0,0,'L',1);
                $this->cell(80,5,'422/    /412.12/SMKN.2/'. date('Y'),0,0,'L',1);
                $this->Ln(5);
                $this->cell(30,5,'Lampiran',0,0,'L',1);
                $this->cell(5,5,':',0,0,'L',1);
                $this->cell(80,5,$_POST['lampiran'],0,0,'L',1);
                $this->Ln(5);
                $this->cell(30,5,'Hal',0,0,'L',1);
                $this->cell(5,5,':',0,0,'L',1);
                $this->cell(80,5,$_POST['hal'],0,0,'L',1);
                $this->Ln(10);
                $this->cell(70,5,'Kepada',0,0,'L',1);
                $this->Ln(5);
                $this->cell(30,5,'Yth.',0,0,'L',1);
                $this->cell(5,5,':',0,0,'L',1);
                $this->cell(80,5,'Saudara '.$key->nama_ayah_siswa,0,0,'L',1);
                $this->Ln(5);
                $this->cell(35,5,'',0,0,'L',1);
                $this->cell(80,5,'Orang Tua/Wali dari : '.$key->nama_siswa.' kelas : '.$key->kelas_siswa,0,0,'L',1);
                $this->Ln(5);
                $this->cell(35,5,'',0,0,'L',1);
                $this->cell(80,5,$key->alamat_siswa,0,0,'L',1);
                $this->Ln(15);
                $this->cell(30,5,'Dengan Hormat,',0,0,'L',1);
                $this->Ln(5);
                $this->cell(30,5,'Mengharap kehadiran Saudara pada: ',0,0,'L',1);
                $this->Ln(10);
                $this->cell(10,5,'',0,0,'L',1);
                $this->cell(40,5,'Hari / Tanggal',0,0,'L',1);
                $this->cell(5,5,':',0,0,'L',1);
                $this->cell(80,5,$_POST['hari'].' / '.$_POST['tanggal'],0,0,'L',1);
                $this->Ln(8);
                $this->cell(10,5,'',0,0,'L',1);
                $this->cell(40,5,'Waktu',0,0,'L',1);
                $this->cell(5,5,':',0,0,'L',1);
                $this->cell(80,5,$_POST['waktu'],0,0,'L',1);
                $this->Ln(8);
                $this->cell(10,5,'',0,0,'L',1);
                $this->cell(40,5,'Tempat',0,0,'L',1);
                $this->cell(5,5,':',0,0,'L',1);
                $this->cell(80,5,$_POST['tempat'],0,0,'L',1);
                $this->Ln(8);
                $this->cell(10,5,'',0,0,'L',1);
                $this->cell(40,5,'Keperluan',0,0,'L',1);
                $this->cell(5,5,':',0,0,'L',1);
                $this->cell(80,5,$_POST['keperluan'],0,0,'L',1);
                $this->Ln(10);
                $this->cell(30,5,'Atas perhatian Saudara kami ucapkan terima kasih',0,0,'L',1);
                $this->Ln(20);
                $this->cell(130,5,'',0,0,'L',1);
                $this->cell(0,5,'Kepala Sekolah',0,0,'L',1);
                $this->Ln(40);
                $this->setFont('Arial','B',12);
                $this->cell(130,5,'',0,0,'L',1);
                $this->cell(0,5,'HIDAYAT RAHMAN,S.Pd,MM',0,0,'L',1);
                $this->Ln(5);
                $this->cell(130,5,'',0,0,'L',1);
                $this->cell(0,5,'NIP. 19680321 199303 1 004',0,0,'L',1);
            }                 
	}

	function Footer()
	{
		//atur posisi 1.5 cm dari bawah
		$this->SetY(-15);
		//buat garis horizontal
		$this->Line(10,$this->GetY(),210,$this->GetY());
		//Arial italic 9
		$this->SetFont('Arial','I',9);
                $this->Cell(0,10,'Bimbingan dan Konseling SMKN 2 Bojonegoro ' . date('Y'),0,0,'L');
		//nomor halaman
		//$this->Cell(0,10,'Halaman '.$this->PageNo().' dari {nb}',0,0,'R');
	}
}
 
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Content($data);
$pdf->Output();