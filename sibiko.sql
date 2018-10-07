-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 12, 2018 at 08:58 PM
-- Server version: 5.6.36-log
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sibiko`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bimbingan`
--

CREATE TABLE `tbl_bimbingan` (
  `id_bimbingan` int(5) NOT NULL,
  `nis` varchar(16) NOT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `tanggal_bimbingan` date DEFAULT NULL,
  `masalah_siswa` varchar(200) DEFAULT NULL,
  `solusi_bimbingan` varchar(200) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_catatan`
--

CREATE TABLE `tbl_catatan` (
  `id_catatan` int(11) NOT NULL,
  `nis` varchar(16) NOT NULL,
  `kelas` varchar(12) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_catatan`
--

INSERT INTO `tbl_catatan` (`id_catatan`, `nis`, `kelas`, `tanggal`, `keterangan`) VALUES
(2, '13903141007', 'XI GEO 1 - A', '2017-02-01', 'lswkjad kadkjash dkjas'),
(3, '13326066007', 'XII GEO 1', '2016-08-02', 'tdk naek');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guru`
--

CREATE TABLE `tbl_guru` (
  `id_guru` int(10) NOT NULL,
  `nama_guru` varchar(100) DEFAULT NULL,
  `alamat_guru` varchar(200) DEFAULT NULL,
  `jabatan_guru` varchar(20) DEFAULT NULL,
  `no_telepon_guru` varchar(12) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_guru`
--

INSERT INTO `tbl_guru` (`id_guru`, `nama_guru`, `alamat_guru`, `jabatan_guru`, `no_telepon_guru`, `status`) VALUES
(1, 'Drs. MOH. HAMIM, M.MPd', '', 'GURU', '', 'PNS'),
(2, 'Drs. MOCHTAR EFFENDI, M.M.Pd', '', 'GURU', '', 'PNS'),
(3, 'Drs. MARSUDI, M MPd', '', 'GURU', '', 'PNS'),
(4, 'Dra. WIWIK SUWARSI', '', 'GURU', '', 'PNS'),
(5, 'MOH. ARIFIN NURHIDAYAT,S.Pd', '', 'GURU', '', 'PNS'),
(6, 'Drs. SRI  HONO, MA M.Pd', '', 'GURU', '', 'PNS'),
(7, 'Drs. JUDA RISWANTO', '', 'GURU', '', 'PNS'),
(8, 'Drs. BUDI ISTIYONO', '', 'GURU', '', 'PNS'),
(9, 'Drs. SIGIT HERDYANTO', '', 'GURU', '', 'PNS'),
(10, 'Drs. MISWAN', '', 'GURU', '', 'PNS'),
(11, 'Dra. SRI LESTARI', '', 'GURU', '', 'PNS'),
(12, 'Drs. PUDJIJONO', '', 'GURU', '', 'PNS'),
(13, 'Drs. S U N O T O', '', 'GURU', '', 'PNS'),
(14, 'UMI KULSUM, S.Pd MM', '', 'GURU', '', 'PNS'),
(15, 'Drs. ANANG SURYA PUTRA', '', 'GURU', '', 'PNS'),
(16, 'Drs. HERY PRIJAMBODO', '', 'GURU', '', 'PNS'),
(17, 'Dra. HERMIN MULYANINGSIH, M Pd', '', 'GURU', '', 'PNS'),
(18, 'MOCHAMAD ASHADI, S.Pd, MM', '', 'GURU', '', 'PNS'),
(19, 'SRI BUDAYANI, S.Pd', '', 'GURU', '', 'PNS'),
(20, 'Drs. MATASAN', '', 'GURU', '', 'PNS'),
(21, 'Drs. MOCHAMAD YULIANTO', '', 'GURU', '', 'PNS'),
(22, 'Drs. ARIF GIJANDONO, MT', '', 'GURU', '', 'PNS'),
(23, 'ABU HAMID, S.Pd.I', '', 'GURU', '', 'PNS'),
(24, 'SULASTRI, S.Pd MM', '', 'GURU', '', 'PNS'),
(25, 'SITI AMINAH, S.Pd MM', '', 'GURU', '', 'PNS'),
(26, 'SUSILOWATI, S.Pd', '', 'GURU', '', 'PNS'),
(27, 'RINA JUNIARTI, S.Pd', '', 'GURU', '', 'PNS'),
(28, 'Drs. S U  J A K', '', 'GURU', '', 'PNS'),
(29, 'Dra. DIDIN SUDARWATI', '', 'GURU', '', 'PNS'),
(30, 'NURUL ROSYIDI, S.Pd', '', 'GURU', '', 'PNS'),
(31, 'TOTOK KARYANTO WIBOWO, S.Pd', '', 'GURU', '', 'PNS'),
(32, 'SUYATNO,  S.Pd', '', 'GURU', '', 'PNS'),
(33, 'DJOKO SUWITO, S.Pd, MT', '', 'GURU', '', 'PNS'),
(34, 'EKO TUGAS SUKALIMANTONO, S.Pd', '', 'GURU', '', 'PNS'),
(35, 'DARTA PRASETIYA SUKMA W, S.Pd', '', 'GURU', '', 'PNS'),
(36, 'Drs. MOH. KHISNULLAH', '', 'GURU', '', 'PNS'),
(37, 'PRIYO JOKO SAKSONO, S.Pd', '', 'GURU', '', 'PNS'),
(38, 'A S M U \'I, S.Pd', '', 'GURU', '', 'PNS'),
(39, 'TOTOK SUJATMIKO, S.Pd', '', 'GURU', '', 'PNS'),
(40, 'TRI ANDAYANI, S.Pd MM', '', 'GURU', '', 'PNS'),
(41, 'SUGIARTI, S.Pd', '', 'GURU', '', 'PNS'),
(42, 'ITUT KARTIKA DEWI, S.Pd', '', 'GURU', '', 'PNS'),
(43, 'SRI PANGESTUTIK, S.Pd', '', 'GURU', '', 'PNS'),
(44, 'AGUS HARIYANTO, S.Pd', '', 'GURU', '', 'PNS'),
(45, 'AGUS JUNIANTO, S.Pd', '', 'GURU', '', 'PNS'),
(46, 'Dra. SRI AMBARWATI', '', 'GURU', '', 'PNS'),
(47, 'TUTIK DIAH MEI M, S.Pd', '', 'GURU', '', 'PNS'),
(48, 'ENDANG JULIANA, S.Pd', '', 'GURU', '', 'PNS'),
(49, 'Drs.FAUZAN JAUHARI', '', 'GURU', '', 'PNS'),
(50, 'LILIK WULANDARI, S.Pd', '', 'GURU', '', 'PNS'),
(51, 'TRI WAHJUNI, S.Pd M.Si', '', 'GURU', '', 'PNS'),
(52, 'ALIM SUWANTONO, S.Pd', '', 'GURU', '', 'PNS'),
(53, 'MOH DOWI, S.Pd, M.Pd', '', 'GURU', '', 'PNS'),
(54, 'DYAH PERDANA W, S.Pd', '', 'GURU', '', 'PNS'),
(55, 'SITI ARIYANI, S.Pd MM', '', 'GURU', '', 'PNS'),
(56, 'ISNA NI\'MATUS SHOLIKHAH, S.Pd M.Si', '', 'GURU', '', 'PNS'),
(57, 'CHAKIM ROMLI, S.Ag', '', 'GURU', '', 'PNS'),
(58, 'R U S M A N I, S.Pd', '', 'GURU', '', 'PNS'),
(59, 'MUCHAMAD SUBKHI, S.Ag', '', 'GURU', '', 'PNS'),
(60, 'MOCHAMAD LUTFI ZAKI, S.Pd', '', 'GURU', '', 'PNS'),
(61, 'SRI SULASTRI, S.Pd', '', 'GURU', '', 'PNS'),
(62, 'SAUMA ROMADHAN, S.Pd', '', 'GURU', '', 'PNS'),
(63, 'NOER OLIVIA, S.Pd', '', 'GURU', '', 'PNS'),
(64, 'MOH. NAWAWI KUSNUL MURTADHO,S.Pd.I', '', 'GURU', '', 'GTT'),
(65, 'MUZAKI, S.Pd', '', 'GURU', '', 'GTT'),
(66, 'SEPTINA MUSTIKASARI, S.Pd', '', 'GURU', '', 'GTT'),
(67, 'EMAN AGUS TUGGAL P, S.Pd, MT', '', 'GURU', '', 'GTT'),
(68, 'ANGELA RAHMA PURWITASARI,S.Pd', '', 'GURU', '', 'GTT'),
(69, 'KHOIRUL ANWAR, S.Th.I', '', 'GURU', '', 'GTT'),
(70, 'ZAINUDIN, S.Pd', '', 'GURU', '', 'GTT'),
(71, 'RINANINGSIH, S.Pd', '', 'GURU', '', 'GTT'),
(72, 'NURFA\'IDA WAHYU PUSPITA, S.Pd', '', 'GURU', '', 'GTT'),
(73, 'METHA INDRIANA KUSTININGRUM, S.Si', '', 'GURU', '', 'GTT'),
(74, 'IRWAN WIBISONO, ST, MT', '', 'GURU', '', 'GTT'),
(75, 'FIERLA NURITA W, S.Pd', '', 'GURU', '', 'GTT'),
(76, 'AGUS BUDIONO, S.Pd', '', 'GURU', '', 'GTT'),
(77, 'ASTY DIANTY, S.Pd', '', 'GURU', '', 'GTT'),
(78, 'TEGUH RAHARJA, S.Pd, MT', '', 'GURU', '', 'GTT'),
(79, 'AHMAD ALEX ALATAS, S.Pd', '', 'GURU', '', 'GTT'),
(80, 'FIRA ZULIA SUKRIYANTI, S.Pd', '', 'GURU', '', 'GTT'),
(81, 'BAMBANG IRAWAN, S.KOM', '', 'GURU', '', 'GTT'),
(82, 'SRI LESTARI NINGSIH,ST', '', 'GURU', '', 'GTT'),
(83, 'ARIES SETIYARI, ST', '', 'GURU', '', 'GTT'),
(84, 'ROSICH ANGGARA, S.Pd', '', 'GURU', '', 'GTT'),
(85, 'SONY LUC MERENDA, SS', '', 'GURU', '', 'GTT'),
(86, 'DWI PRATIWI PUJI ASTUTIK, S.Pd', '', 'GURU', '', 'GTT'),
(87, 'ANDHI SETIAWAN, S.Pd', '', 'GURU', '', 'GTT'),
(88, 'PUTRI AYU RACHMAWATI, S.Pd', '', 'GURU', '', 'GTT'),
(89, 'YANITA ASIKASARI, S.Pd', '', 'GURU', '', 'GTT'),
(90, 'LILIK NURMALIA HIDAYATI, S.Pd', '', 'GURU', '', 'GTT'),
(91, 'DANI BUDI PRASETYA, S.Pd', '', 'GURU', '', 'GTT'),
(92, 'HANUM ULFA OKTAFIANA, S.Pd', '', 'GURU', '', 'GTT'),
(93, 'MEITA RINI ISMALASARI, S.Pd', '', 'GURU', '', 'GTT'),
(94, 'AGUNG PRIA AMBARA, S.Pd', '', 'GURU', '', 'GTT'),
(95, 'SEFETIYANA WIDYAWATI, S.Pd', '', 'GURU', '', 'GTT'),
(96, 'INDRA NUR MAULANA P, S.Pd', '', 'GURU', '', 'GTT'),
(97, 'SOFIYATI NINGRUM, S Pd', '', 'GURU', '', 'GTT'),
(98, 'DHINI APRILIA BUDIARTI, ST', '', 'GURU', '', 'GTT'),
(99, 'MOCHAMAD DWI CAHYO, S.Pd', '', 'GURU', '', 'GTT'),
(100, 'FETRIKA ANGGRAINI, M.Pd', '', 'GURU', '', 'GTT'),
(101, 'DEVI KARTIKA DIAN PERMATA S, S.Pd', '', 'GURU', '', 'GTT'),
(102, 'DWI MUDAWAMATUN N, S.Pd', '', 'GURU', '', 'GTT'),
(103, 'SURYA ANITA RACHMAWATI, S.Pd', '', 'GURU', '', 'GTT'),
(104, 'VIKA YANITA, S.Pd', '', 'GURU', '', 'GTT'),
(105, 'DEFRI PRASETYO, S.Pd', '', 'GURU', '', 'GTT'),
(106, 'IMAM AFDUL MUNIP, S.Pd', '', 'GURU', '', 'GTT'),
(107, 'DEBY PRISMADI KURNIAWAN', '', 'GURU', '', 'GTT');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(3) NOT NULL,
  `nama_pelanggaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_pelanggaran`) VALUES
(2, 'Kerajinan'),
(3, 'Kerapian'),
(1, 'Sikap Perilaku');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori_penghargaan`
--

CREATE TABLE `tbl_kategori_penghargaan` (
  `id_kategori_penghargaan` int(3) NOT NULL DEFAULT '0',
  `nama_penghargaan` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori_penghargaan`
--

INSERT INTO `tbl_kategori_penghargaan` (`id_kategori_penghargaan`, `nama_penghargaan`) VALUES
(1, 'Berprestasi Akademik & Non Akademik'),
(2, 'Tidak Berprestasi Akademik & Non Akademik');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kelassiswa`
--

CREATE TABLE `tbl_kelassiswa` (
  `kode_kelas` varchar(12) NOT NULL,
  `nama_kelas` varchar(20) DEFAULT NULL,
  `wali_kelas` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggaransiswa`
--

CREATE TABLE `tbl_pelanggaransiswa` (
  `id_pelanggaran` int(10) NOT NULL,
  `nis` varchar(16) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `tanggal_pelanggaran` date DEFAULT NULL,
  `subkategori` int(3) DEFAULT NULL,
  `point_pelanggaran` int(3) NOT NULL,
  `tindak_lanjut` varchar(200) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `id_guru` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penghargaan`
--

CREATE TABLE `tbl_penghargaan` (
  `id_penghargaan` int(4) NOT NULL,
  `nis` varchar(16) CHARACTER SET utf8 NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `subkategori_penghargaan` int(3) DEFAULT NULL,
  `tanggal_penghargaan` date DEFAULT NULL,
  `poin_penghargaan` int(3) DEFAULT NULL,
  `id_guru` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `nis` varchar(16) NOT NULL,
  `nama_siswa` varchar(100) DEFAULT NULL,
  `alamat_siswa` varchar(200) DEFAULT NULL,
  `jurusan_siswa` varchar(50) NOT NULL,
  `tempat_lahir_siswa` varchar(50) DEFAULT NULL,
  `tanggal_lahir_siswa` date DEFAULT NULL,
  `jenis_kelamin_siswa` varchar(10) DEFAULT NULL,
  `agama_siswa` varchar(20) DEFAULT NULL,
  `asal_sekolah_siswa` varchar(50) DEFAULT NULL,
  `tahun_angkatan_siswa` varchar(4) DEFAULT NULL,
  `nama_ayah_siswa` varchar(100) DEFAULT NULL,
  `pekerjaan_ayah_siswa` varchar(100) DEFAULT NULL,
  `nama_ibu_siswa` varchar(100) DEFAULT NULL,
  `pekerjaan_ibu_siswa` varchar(100) DEFAULT NULL,
  `no_telepon_ortu` varchar(12) DEFAULT NULL,
  `kelas_siswa` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subkategori`
--

CREATE TABLE `tbl_subkategori` (
  `id_subkategori` int(3) NOT NULL,
  `id_kategori` int(3) DEFAULT NULL,
  `deskripsi_pelanggaran` varchar(200) DEFAULT NULL,
  `point_pelanggaran` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_subkategori`
--

INSERT INTO `tbl_subkategori` (`id_subkategori`, `id_kategori`, `deskripsi_pelanggaran`, `point_pelanggaran`) VALUES
(1, 1, 'Tidak membawa buku sesuai jadwal.', 10),
(2, 1, 'Membuat kegaduhan di kelas atau di sekolah.', 10),
(3, 1, 'Mencoret-coret atau mengotori dinding, pintu, meja, kursi, pagar sekolah.', 10),
(4, 1, 'Membawa atau bermain kartu remi dan domino di sekolah.', 10),
(5, 1, 'Memparkir sepeda/motor tidak pada tempatnya.', 10),
(6, 1, 'Bermain bola di koridor dan di dalam kelas.', 10),
(7, 1, 'Menyontek', 10),
(8, 1, 'Melindungi teman yang bersalah.', 15),
(9, 1, 'Menghidupkan handphone waktu KBM.', 20),
(10, 1, 'Berpacaran di Sekolah.', 20),
(11, 1, 'Berperilaku jorok atau asusila baik didalam maupun diluar sekolah', 20),
(12, 1, 'Merayakan ulang tahun berlebihan', 20),
(13, 1, 'Menyalahgunakan uang SPP atau uang sekolah.', 25),
(14, 1, 'Membawa atau membunyikan petasan.', 30),
(15, 1, 'Membuat surat izin palsu.', 40),
(16, 1, 'Meloncat jendela dan pagar sekolah.', 40),
(17, 1, 'Merusak sarana dan prasarana sekolah.', 40),
(18, 1, 'Bertindak tidak sopan/ melecehkan Kepala Sekolah, dan karyawan sekolah.', 50),
(19, 1, 'Mengancam / mengintimidasi teman sekelas / teman sekolah', 75),
(20, 1, 'Mengancam / mengintimidasi Kepala Sekolah, guru dan karyawan.', 100),
(21, 1, 'Membawa / merokok saat masih mengenakan seragam sekolah', 100),
(22, 1, 'Menyalahgunakan  media sosial yang merugikan pihak lain yang berhubungan dengan sekolah', 100),
(23, 1, 'Berjudi dalam bentuk apapun di sekolah.', 150),
(24, 1, 'Membawa senjata tajam, senjata api dsb. di sekolah.', 150),
(25, 1, 'Terlibat langsung maupun tidak langsung perkelahian/tawuran di sekolah, di luar sekolah atau antar sekolah.', 150),
(26, 1, 'Mengikuti aliran/perkumpulan/geng terlarang/Komunitas LGBT dan radikalisme', 150),
(27, 1, 'Membawa, menggunakan atau mengedarkan miras dan narkoba', 250),
(28, 1, 'Membawa dan/atau membuat VCD Porno, buku porno, majalah porno atau sesuatu yang berbau pornografi dan pornoaksi.', 200),
(29, 1, 'Mencuri di sekolah dan di luar sekolah.', 200),
(30, 1, 'Memalsukan stempel sekolah, edaran sekolah atau tanda tangan Kepala Sekolah, guru dan karyawan sekolah.', 250),
(31, 1, 'Terlibat tindakan kriminal, mencemarkan nama baik sekolah.', 250),
(32, 1, 'Terbukti hamil atau menghamili', 250),
(33, 1, 'Terbukti menikah', 250),
(34, 2, 'Datang terlambat.', 10),
(35, 2, 'Tidak mengikuti pelajaran tanpa izin.', 10),
(36, 2, 'Meninggalkan kelas tanpa izin.', 10),
(37, 2, 'Di kantin saat jam pelajaran.', 10),
(38, 2, 'Tidak mengikuti dan melaksanakan piket 7K.', 10),
(39, 2, 'Tidur di kelas saat pelajaran berlangsung', 10),
(40, 2, 'Tidak membawa buku yang berkaitan dengan pelajaran.', 10),
(41, 2, 'Pulang sebelum waktunya tanpa izin dari sekolah', 20),
(42, 2, 'Tidak masuk sekolah tanpa keterangan.', 20),
(43, 2, 'Tidak mengikuti upacara', 20),
(44, 2, 'Tidak mengikuti kegiatan sekolah', 20),
(45, 2, 'Tidak mengikuti kegiatan ekstrakurikuler', 20),
(46, 3, 'Tidak berseragam sesuai dengan ketentuan.', 10),
(47, 3, 'Tidak memasukkan baju.', 10),
(48, 3, 'Melipat lengan baju, baju tidak dikancingkan.', 10),
(49, 3, 'Seragam yang dicoret-coret.', 10),
(50, 3, 'Berambut panjang terurai (peserta didik putri ).', 10),
(51, 3, 'Celana atau rok sobek', 10),
(52, 3, 'Tidak memakai kaos kaki.', 10),
(53, 3, 'Memakai kaos kaki tidak sesuai ketentuan', 10),
(54, 3, 'Tidak memakai ikat pinggang.', 10),
(55, 3, 'Memakai ikat pinggang tidak sesuai dengan ketentuan (hitam)', 10),
(56, 3, 'Seragam atribut tidak lengkap.', 10),
(57, 3, 'Tidak memakai sepatu hitam ( selain olah raga ).', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subkategori_penghargaan`
--

CREATE TABLE `tbl_subkategori_penghargaan` (
  `id_subkategori_penghargaan` int(3) NOT NULL DEFAULT '0',
  `id_kategori_penghargaan` int(3) DEFAULT NULL,
  `deskripsi_penghargaan` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `point_penghargaan` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subkategori_penghargaan`
--

INSERT INTO `tbl_subkategori_penghargaan` (`id_subkategori_penghargaan`, `id_kategori_penghargaan`, `deskripsi_penghargaan`, `point_penghargaan`) VALUES
(1, 1, 'Tingkat Nasional', 100),
(2, 1, 'Tingkat Provinsi', 75),
(3, 1, 'Tingkat kota/kabupaten', 50),
(4, 1, 'Tingkat kecamatan', 25),
(5, 1, 'Mengikuti lomba sebagai peserta (tidak\r\njuara)', 10),
(6, 1, 'Mengikuti pelatihan LDKMS', 15),
(7, 1, 'Diangkat menjadi ketua OSIS', 25),
(8, 1, 'Diangkat menjadi pengurus OSIS', 20),
(9, 2, 'Tidak pernah alpa (bagi peserta didik yang mempunyai catatan pelanggaran).', 25),
(10, 2, 'Tidak pernah terlambat selama 1 bulan berturut-turut (bagi peserta didik yang mempunyai catatan pelanggaran).', 15),
(11, 2, 'Mampu menunjukkan catatan pelajaran lengkap dalam waktu yang telah ditentukan.', 30);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` varchar(16) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `nama`, `username`, `password`, `role`) VALUES
('1', 'Administrator', 'andhis', 'd94d7420d35db456be3208e4722152f1', 'super admin'),
('10', 'Drs. BUDI ISTIYONO', 'guru008', 'fbc115595c0f50ef7eaa8d738e561a87', 'guru'),
('100', 'DHINI APRILIA BUDIARTI, ST', 'guru098', 'e389870ba6542a6dc55882fd7693d07d', 'guru'),
('101', 'MOCHAMAD DWI CAHYO, S.Pd', 'guru099', '3f500d506f643f3d5da3e5021579e441', 'guru'),
('102', 'FETRIKA ANGGRAINI, M.Pd', 'guru100', '64e735c9263d7f59198a26eb488f898e', 'guru'),
('103', 'DEVI KARTIKA DIAN PERMATA S, S.Pd', 'guru101', '2b35f80c28d490e97faeb581aaa629c9', 'guru'),
('104', 'DWI MUDAWAMATUN N, S.Pd', 'guru102', 'ca07993b8cdc7b46ca29dc764d5c0d2b', 'guru'),
('105', 'SURYA ANITA RACHMAWATI, S.Pd', 'guru103', 'cbef149d9cbcf7c92de21177216a50c8', 'guru'),
('106', 'VIKA YANITA, S.Pd', 'guru104', '310d16d78a9dd8c7f5e78e3332ccdf8c', 'guru'),
('107', 'DEFRI PRASETYO', 'guru105', '8b019a532b16db3cd354c573b22e8dc0', 'guru'),
('108', 'IMAM AFDUL MUNIF', 'guru106', '0e23753f6d9df730bf72907d2508ecab', 'guru'),
('109', 'DEBY PRISMADI KURNIAWAN', 'guru107', '368a09289b64f71f39e6159bee75330a', 'guru'),
('11', 'Drs. SIGIT HERDYANTO', 'guru009', '2bc0b01c142e47ff78172c70ede83cdd', 'guru'),
('12', 'Drs. MISWAN', 'guru010', 'b6de1a69cfdb90d749b30b4228bd79c4', 'guru'),
('123456789', 'Haris Setiyono', 'superadmin', '3be11b63a37cf77a80654ddf8cb81949', 'super admin'),
('13', 'Dra. SRI LESTARI', 'guru011', 'cfa1b6ad07f07077c4258f3e7e58f55f', 'guru'),
('13593312011', 'SUTRISNO', 'sutrisno', '82e29bc26cd3dd9eff684bb064f1855b', 'wali'),
('1381895802', 'Didik Hadi ', 'didik', '2ff462bc49e322708a48d3d5e3ca4bab', 'wali'),
('14', 'Drs. PUDJIJONO', 'guru012', '8f59205897a71356ced357f47444f955', 'guru'),
('143631060586', 'Abdul Choliq', 'abdul', '82027888c5bb8fc395411cb6804a066c', 'wali'),
('15', 'Drs. S U N O T O', 'guru013', '3ec25f5539882e10cb8b3a28916f0ba1', 'guru'),
('16', 'UMI KULSUM, S.Pd MM', 'guru014', 'fce66d0a33b06c72ba96d280452459ed', 'guru'),
('17', 'Drs. ANANG SURYA PUTRA', 'guru015', '53304d59030c121bf285ef6e6f62654d', 'guru'),
('18', 'Drs. HERY PRIJAMBODO', 'guru016', '6a1514ffc453f72f7652b67d4381eaa1', 'guru'),
('19', 'Dra. HERMIN MULYANINGSIH, M Pd', 'guru017', '5500800d0dbf6d665beb6847fc88ed63', 'guru'),
('2', 'Andhi Setiawan, S.Pd', 'andhis', '9310f83135f238b04af729fec041cca8', 'guru'),
('20', 'MOCHAMAD ASHADI, S.Pd, MM', 'guru018', '4b307eeb399d24086bcff1f2ea8bb392', 'guru'),
('21', 'SRI BUDAYANI, S.Pd', 'guru019', 'dac6e8ff4362d4cc9f3b8836bf2b6c8a', 'guru'),
('22', 'Drs. MATASAN', 'guru020', '26b56cf43a08f6c6c601aa5e2dcab2bf', 'guru'),
('23', 'Drs. MOCHAMAD YULIANTO', 'guru021', '917865db78119523f418474f03df145b', 'guru'),
('24', 'Drs. ARIF GIJANDONO, MT', 'guru022', 'bb09a46c86e4808f4adbfa9bda9a603f', 'guru'),
('25', 'ABU HAMID, S.Pd.I', 'guru023', '1ceb059bf11dad276cc5321911b4bfa2', 'guru'),
('26', 'SULASTRI, S.Pd MM', 'guru024', '7cc1c7fdd0f32cc67383b8fe74c3676a', 'guru'),
('27', 'SITI AMINAH, S.Pd MM', 'guru025', 'a5547e5abf1093003e62d2cd58c4bd80', 'guru'),
('28', 'SUSILOWATI, S.Pd', 'guru026', '09df56a957c95a47d19d960946143eee', 'guru'),
('29', 'RINA JUNIARTI, S.Pd', 'guru027', '5524656995635db6f9f0cf459112bceb', 'guru'),
('3', 'Drs. MOH. HAMIM, M.MPd', 'guru001', 'a732186fb329832490f9d09d572b1eb4', 'guru'),
('30', 'Drs. S U  J A K', 'guru028', 'b5cfa1157797f9de07961880f437322c', 'guru'),
('31', 'Dra. DIDIN SUDARWATI', 'guru029', '922e3307353eacaa2cdeaa7e7dc4fdca', 'guru'),
('32', 'NURUL ROSYIDI, S.Pd', 'guru030', 'f4a30cb20e438492eb272e3f348fb9b4', 'guru'),
('33', 'TOTOK KARYANTO WIBOWO, S.Pd', 'guru031', 'cd7a357d638fca18ab438565575e6d4e', 'guru'),
('34', 'SUYATNO,  S.Pd', 'guru032', '22754de330ccaa8469a2a6a6c474ee9a', 'guru'),
('35', 'DJOKO SUWITO, S.Pd, MT', 'guru033', '73e9e3272606f1e43948beb89f8fd720', 'guru'),
('36', 'EKO TUGAS SUKALIMANTONO, S.Pd', 'guru034', '80f6d06b6c67a50df573e345111e84a0', 'guru'),
('37', 'DARTA PRASETIYA SUKMA W, S.Pd', 'guru035', '0e68c6d60c32db822395aa996f32b652', 'guru'),
('38', 'Drs. MOH. KHISNULLAH', 'guru036', 'fc1d515570589ec7cbeb7bf61af942cb', 'guru'),
('39', 'PRIYO JOKO SAKSONO, S.Pd', 'guru037', '0a191ffca57f6606c8e80400e3764e02', 'guru'),
('4', 'Drs. MOCHTAR EFFENDI, M.M.Pd', 'guru002', 'c852632073cd12e371edb1584825423c', 'guru'),
('40', 'A S M U \'I, S.Pd', 'guru038', '45707d568aac27f4724fe86c27fa0129', 'guru'),
('41', 'TOTOK SUJATMIKO, S.Pd', 'guru039', '2820aba719fdd7bb41c2460c4e4604f0', 'guru'),
('42', 'TRI ANDAYANI, S.Pd MM', 'guru040', '220ae3b4c5b05645ed737b85105dffba', 'guru'),
('43', 'SUGIARTI, S.Pd', 'guru041', 'fcc5b883e866f0c23fbe52639d480800', 'guru'),
('44', 'ITUT KARTIKA DEWI, S.Pd', 'guru042', '9ca4c88b65623ee5e4c907a1d7b33571', 'guru'),
('45', 'SRI PANGESTUTIK, S.Pd', 'guru043', '8d14c7687164519099e1103c99c41188', 'guru'),
('46', 'AGUS HARIYANTO, S.Pd', 'guru044', '3790ffcc757ab5688eadc6fc6702c549', 'guru'),
('47', 'AGUS JUNIANTO, S.Pd', 'guru045', 'b8c4344571a808ec6ca4eab4543c2e1c', 'guru'),
('48', 'Dra. SRI AMBARWATI', 'guru046', '4bed4111e6ceb42c2cee1574999ac371', 'guru'),
('49', 'TUTIK DIAH MEI M, S.Pd', 'guru047', '5a1674c1e5c676b53d08d218407572ea', 'guru'),
('5', 'Drs. MARSUDI, M MPd', 'guru003', '4e02bbec24574cfae0866a68dae67650', 'guru'),
('50', 'ENDANG JULIANA, S.Pd', 'guru048', 'e815aef1f622f1c2513d3d47d0c98ade', 'guru'),
('51', 'Drs.FAUZAN JAUHARI', 'guru049', '155fc71d3576a6ef9b9d3c933ff18163', 'guru'),
('52', 'LILIK WULANDARI, S.Pd', 'guru050', '37385c5b44ef07605887db31f881bed5', 'guru'),
('53', 'TRI WAHJUNI, S.Pd M.Si', 'guru051', '44e20df0ed9637ef808ffb5838f52a4a', 'guru'),
('54', 'ALIM SUWANTONO, S.Pd', 'guru052', 'b0ba7b8b87d10b9b921eb5320b05ef57', 'guru'),
('55', 'MOH DOWI, S.Pd', 'guru053', 'ac25a77dc44b3adbeae7cefacdc06fae', 'guru'),
('56', 'DYAH PERDANA W, S.Pd', 'guru054', 'a57a62b148660d356b41555e9eeaacf0', 'guru'),
('57', 'SITI ARIYANI, S.Pd MM', 'guru055', 'cbb4eb50621d2d3067736d874bd7b0d0', 'guru'),
('58', 'ISNA NI\'MATUS SHOLIKHAH, S.Pd M.Si', 'guru056', '918e2ce8cff88918bb603f2a200e02f2', 'guru'),
('59', 'CHAKIM ROMLI, S.Ag', 'guru057', '26a26be1578da0e3abd01be1809dbc7e', 'guru'),
('6', 'Dra. WIWIK SUWARSI', 'guru004', '0a6fc0d39dc34c794244244ec297a0f7', 'guru'),
('60', 'R U S M A N I, S.Pd', 'guru058', '95f5f04028003b9686bf25af86dea183', 'guru'),
('61', 'MUCHAMAD SUBKHI, S.Ag', 'guru059', '341a023dd815a3c0ed07fbb33178cdf6', 'guru'),
('62', 'MOCHAMAD LUTFI ZAKI, S.Pd', 'guru060', '37548bb9a990717f05ca4664907806b4', 'guru'),
('63', 'SRI SULASTRI, S.Pd', 'guru061', 'a6c05b51949b9263905689ecdcc5be62', 'guru'),
('64', 'SAUMA ROMADHAN, S.Pd', 'guru062', 'fc28f473c98af0e47c6f93e8bf72a35b', 'guru'),
('65', 'NOER OLIVIA, S.Pd', 'guru063', 'c603ad83e332914d1ed4bbfe017f24c4', 'guru'),
('66', 'MOH. NAWAWI KUSNUL MURTADHO,S.Pd.I', 'guru064', '2f6f9a8daccc9c9d4f6ea52a9e3266b6', 'guru'),
('67', 'MUZAKI, S.Pd', 'guru065', 'bc1fecf2cf3aaa7c328133fa147010d0', 'guru'),
('68', 'SEPTINA MUSTIKASARI, S.Pd', 'guru066', '392b8b880c787fad32327767edb391d3', 'guru'),
('69', 'EMAN AGUS TUGGAL P, S.Pd', 'guru067', 'daa0913dad748ac6bdd1a933b4c2e638', 'guru'),
('7', 'MOH. ARIFIN NURHIDAYAT,S.Pd', 'guru005', '7b9d0f5ac24996598261c86468a39546', 'guru'),
('70', 'ANGELA RAHMA PURWITASARI,S.Pd', 'guru068', 'c32d8beca70dc1305ba397370b1a0477', 'guru'),
('71', 'KHOIRUL ANWAR, S.Th.I', 'guru069', '46ddf90cada531e6f49bb9b0a7c9c32c', 'guru'),
('72', 'ZAINUDIN, S.Pd', 'guru070', '3bf4339599e641473d80cfe15fecefb2', 'guru'),
('73', 'RINANINGSIH, S.Pd', 'guru071', 'da833cb836369d60d07cd266435f12e4', 'guru'),
('74', 'NURFA\'IDA WAHYU PUSPITA, S.Pd', 'guru072', '36e9168f42f798dbab93c0d73b0d95af', 'guru'),
('75', 'METHA INDRIANA KUSTININGRUM, S.Si', 'guru073', '5e47ed4b4c0672bf3f8bc9da08f11897', 'guru'),
('76', 'IRWAN WIBISONO, ST', 'guru074', '78cc5ace4166f6cdca26132d3ee6d7e8', 'guru'),
('77', 'FIERLA NURITA W, S.Pd', 'guru075', '68f3c7a23ad8faeaf10b70fe4f39433c', 'guru'),
('78', 'AGUS BUDIONO, S.Pd', 'guru076', '6fe070229051f3fbe614575abbb36772', 'guru'),
('79', 'ASTY DIANTY, S.Pd', 'guru077', '90eb48dcf0e97b72ebf0a3a0a4622a5d', 'guru'),
('8', 'Drs. SRI  HONO, MA M.Pd', 'guru006', '90e6d0038ab9909be807b1edba40af48', 'guru'),
('80', 'TEGUH RAHARJA, S.Pd', 'guru078', '9ef2f9114c2f9b53066562090fcf0700', 'guru'),
('81', 'AHMAD ALEX ALATAS, S.Pd', 'guru079', 'ea212da4c5325af403bcb5b27d85f0f5', 'guru'),
('82', 'FIRA ZULIA SUKRIYANTI, S.Pd', 'guru080', 'ea501dd1deca65474f8fe46ded05340a', 'guru'),
('83', 'BAMBANG IRAWAN, ST', 'guru081', 'e6e061ebb839147713d7aa45671f2f5d', 'guru'),
('84', 'SRI LESTARI NINGSIH,ST', 'guru082', '0af437a2061fc5e7c3a85dae9e55147d', 'guru'),
('85', 'ARIES SETIYARI, ST', 'guru083', 'dac77907e39d9dde0fbb94d25edb769b', 'guru'),
('86', 'ROSICH ANGGARA, S.Pd', 'guru084', '61ef2508fde70ac04ab33e73eef29e5b', 'guru'),
('87', 'SONY LUC MERENDA, SS', 'guru085', '9937ade128c5cab21d5282f459110920', 'guru'),
('88', 'DWI PRATIWI PUJI ASTUTIK, S.Pd', 'guru086', 'eda072e64c4f7033ef31a21464d86508', 'guru'),
('89', 'ANDHI SETIAWAN, S.Pd', 'guru087', '3de3d2371a34b4f4f09e3a9ccbe63dc4', 'guru'),
('9', 'Drs. JUDA RISWANTO', 'guru007', 'b2303f4b88bb113b78313617582b225f', 'guru'),
('90', 'PUTRI AYU RACHMAWATI, S.Pd', 'guru088', 'fcdad0faa6b2b020c568c264fb72ff4d', 'guru'),
('900', 'Imam Abdul Munip', 'imam', '82027888c5bb8fc395411cb6804a066c', 'admin'),
('91', 'YANITA ASIKASARI, S.Pd', 'guru089', 'aaad0693d7478b15e8fd33a559563058', 'guru'),
('92', 'LILIK NURMALIA HIDAYATI, S.Pd', 'guru090', '5d8b782fa970112048a851b9f8fc88ab', 'guru'),
('93', 'DANI BUDI PRASETYA, S.Pd', 'guru091', '53d4548c83f436545970b73c3f069e59', 'guru'),
('94', 'HANUM ULFA OKTAFIANA, S.Pd', 'guru092', '86f15f802ab5c0ae28655c018611a080', 'guru'),
('95', 'MEITA RINI ISMALASARI, S.Pd', 'guru093', 'f228fb821f95cac699b320cdc7feaffc', 'guru'),
('96', 'AGUNG PRIA AMBARA, S.Pd', 'guru094', '4436f552eaded2aec5208ef07310113f', 'guru'),
('97', 'SEFETIYANA WIDYAWATI, S.Pd', 'guru095', '7dcf6bc27c392f6290f132224992d903', 'guru'),
('98', 'INDRA NUR MAULANA P, S.Pd', 'guru096', 'e79ae3b0314fcb70b37ee0ba643fde75', 'guru'),
('99', 'SOFIYATI NINGRUM, S Pd', 'guru097', '475a600ed50ac2c67343ecdc945472aa', 'guru');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `tbl_bimbingan`
--
ALTER TABLE `tbl_bimbingan`
  ADD PRIMARY KEY (`id_bimbingan`),
  ADD KEY `nis_idx` (`nis`),
  ADD KEY `kelas_siswa_idx` (`kelas`);

--
-- Indexes for table `tbl_catatan`
--
ALTER TABLE `tbl_catatan`
  ADD PRIMARY KEY (`id_catatan`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `tbl_guru`
--
ALTER TABLE `tbl_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `nama_pelanggaran` (`nama_pelanggaran`);

--
-- Indexes for table `tbl_kategori_penghargaan`
--
ALTER TABLE `tbl_kategori_penghargaan`
  ADD PRIMARY KEY (`id_kategori_penghargaan`);

--
-- Indexes for table `tbl_kelassiswa`
--
ALTER TABLE `tbl_kelassiswa`
  ADD PRIMARY KEY (`kode_kelas`),
  ADD KEY `wali_kelas` (`wali_kelas`),
  ADD KEY `nama_kelas` (`nama_kelas`);

--
-- Indexes for table `tbl_pelanggaransiswa`
--
ALTER TABLE `tbl_pelanggaransiswa`
  ADD PRIMARY KEY (`id_pelanggaran`),
  ADD KEY `nis` (`nis`),
  ADD KEY `subkategori` (`subkategori`);

--
-- Indexes for table `tbl_penghargaan`
--
ALTER TABLE `tbl_penghargaan`
  ADD PRIMARY KEY (`id_penghargaan`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `nis` (`nis`),
  ADD KEY `subkategori_penghargaan` (`subkategori_penghargaan`);

--
-- Indexes for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `nama_siswa` (`nama_siswa`),
  ADD KEY `kelas_siswa` (`kelas_siswa`);

--
-- Indexes for table `tbl_subkategori`
--
ALTER TABLE `tbl_subkategori`
  ADD PRIMARY KEY (`id_subkategori`),
  ADD KEY `point_pelanggaran` (`point_pelanggaran`);

--
-- Indexes for table `tbl_subkategori_penghargaan`
--
ALTER TABLE `tbl_subkategori_penghargaan`
  ADD PRIMARY KEY (`id_subkategori_penghargaan`),
  ADD KEY `id_kategori` (`id_kategori_penghargaan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bimbingan`
--
ALTER TABLE `tbl_bimbingan`
  MODIFY `id_bimbingan` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_catatan`
--
ALTER TABLE `tbl_catatan`
  MODIFY `id_catatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_guru`
--
ALTER TABLE `tbl_guru`
  MODIFY `id_guru` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_pelanggaransiswa`
--
ALTER TABLE `tbl_pelanggaransiswa`
  MODIFY `id_pelanggaran` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_penghargaan`
--
ALTER TABLE `tbl_penghargaan`
  MODIFY `id_penghargaan` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_subkategori`
--
ALTER TABLE `tbl_subkategori`
  MODIFY `id_subkategori` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bimbingan`
--
ALTER TABLE `tbl_bimbingan`
  ADD CONSTRAINT `nis` FOREIGN KEY (`nis`) REFERENCES `tbl_siswa` (`nis`);

--
-- Constraints for table `tbl_kelassiswa`
--
ALTER TABLE `tbl_kelassiswa`
  ADD CONSTRAINT `wali_kelas` FOREIGN KEY (`wali_kelas`) REFERENCES `tbl_guru` (`id_guru`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pelanggaransiswa`
--
ALTER TABLE `tbl_pelanggaransiswa`
  ADD CONSTRAINT `nis_pelanggaran` FOREIGN KEY (`nis`) REFERENCES `tbl_siswa` (`nis`),
  ADD CONSTRAINT `subkategori` FOREIGN KEY (`subkategori`) REFERENCES `tbl_subkategori` (`id_subkategori`);

--
-- Constraints for table `tbl_penghargaan`
--
ALTER TABLE `tbl_penghargaan`
  ADD CONSTRAINT `tbl_penghargaan_ibfk_1` FOREIGN KEY (`subkategori_penghargaan`) REFERENCES `tbl_subkategori_penghargaan` (`id_subkategori_penghargaan`);

--
-- Constraints for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD CONSTRAINT `kelas_siswa` FOREIGN KEY (`kelas_siswa`) REFERENCES `tbl_kelassiswa` (`nama_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
