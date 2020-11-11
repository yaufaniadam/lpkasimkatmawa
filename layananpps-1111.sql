-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2020 at 02:09 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpelma`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori_surat`
--

CREATE TABLE `kategori_surat` (
  `id` int(3) NOT NULL,
  `kategori_surat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kat_keterangan_surat` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `klien` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodi` int(5) NOT NULL,
  `aktif` tinyint(4) NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tujuan_surat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_semester` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `kategori_surat`
--

INSERT INTO `kategori_surat` (`id`, `kategori_surat`, `kode`, `kat_keterangan_surat`, `klien`, `prodi`, `aktif`, `deskripsi`, `tujuan_surat`, `template`, `min_semester`) VALUES
(1, 'Permohonan Izin Cuti Kuliah', 'CK', '1,2,4,10,11,13', 'm', 0, 1, '<p><span xss=\"removed\">Surat Pengantar Pengajuan Cuti Kuliah ini ditujukan kepada Biro Akademik sebagai keterangan bahwa mahasiswa dapat mengajukan cuti.</span></p><p><span xss=\"removed\">Persyaratan yang harus dilengkapi:</span></p><ol><li>Slip pembayaran biaya cuti kuliah</li><li>Surat keterangan bebas tunggakan SPP</li><li>Surat keterangan bebas pinjaman pustaka</li><li>Kartu Tanda Mahasiswa (KTM)</li></ol><p>Siapkan semua persyaratan di atas dalam format gambar (JPG/JPEG).</p><p><b>Ketentuan lain:</b></p><ol><li>Mahasiswa dapat mengajukan cuti jika telah menempuh semester 2.</li><li>Lama cuti maksimal 1 semester</li><li>Cuti dapat diajukan kembali setelah mahasiswa berstatus aktif </li></ol>', '<p>Rektor</p><p>CQ : <span xss=removed>Biro Akademik</span></p>', 'pengajuan-cuti.php', 2),
(2, 'Pengaktifan Kembali Status Mahasiswa', 'Y', '1,6,7', 'm', 0, 0, '<p>Surat pengajuan Pengaktifan Kembali Status Mahasiswa</p>', '<p>Rektor</p><p>Cq. Biro Akademik</p>', 'aktif-kembali.php', 0),
(3, 'Izin Penelitian Mahasiswa', 'PM', '1,14,16,17,18,20,21,22', 'm', 0, 1, '<p>Surat Izin Penelitian Pengantar Penelitian Mahasiswa</p>', '', 'izin-penelitian.php', 0),
(4, 'Mahasiswa Drop Out', '', '', 'p', 0, 1, NULL, NULL, '', 0),
(5, 'Kuliah Perdana', '', '', 'p', 0, 1, NULL, NULL, '', 0),
(6, 'Pendaftaran dan Pelaksanaan Yudisium', 'Y', '1', 'm', 0, 1, '<p>Pendaftaran dan Pelaksanaan Yudisium</p><p>Syarat :</p><p><br></p>', '<p>Biro Akademik<br></p>', 'yudisium.php', 0),
(7, 'Penanganan Pelanggaran Administrasi dan Etik ', '', '', 'p', 0, 1, NULL, NULL, '', 0),
(8, 'Peminjaman Ruang Pascasarjana', '', '', 'u', 0, 1, NULL, NULL, '', 0),
(9, 'Pengunduran Diri Mahasiswa', 'pdm', '2,8', 'm', 0, 1, '<p>Surat Pengunduran Diri Mahasiswa. syaratnya sebagai berikut<br></p>', '<p>Rektor</p><p>Cq. Biro Akademik</p>', 'pengunduran-diri-mhs.php', 0),
(10, 'Pembuatan Surat Keputusan Direktur', 'skdir', '15', 'p', 0, 1, '<p>Surat Keputusan Direktur</p>', '', 'default-surat.php', 0),
(11, 'Pelaporan SPJ Keuangan', '', '', 'p', 0, 1, NULL, NULL, '', 0),
(12, 'Izin Penelitian Dosen', 'ipd', '11', 'd', 0, 1, '<p>Izin Penelitian Dosen<br></p>', '', 'default-surat.php', 0),
(13, 'Pengantar Uji Etik', 'ue', '8', 'm', 105, 1, 'Pengantar Uji Etik untuk mahasiswa Magister Keperawatan', '', 'uji-etik.php', 0),
(14, 'Pengantar Uji Validitas', 'uv', '8', 'm', 105, 1, 'Pengantar Uji Validitas untuk mahasiswa Magister Keperawatan', '', 'uji-validitas.php', 0),
(15, 'Keterangan Mahasiswa Aktif', 'MA', '1,2,4,10,11', 'm', 0, 1, '<p>Keterangan Mahasiswa Aktif<br></p>', '<p>Rektor</p><p>CQ : <span xss=removed>Biro Akademik</span></p>', 'mahasiswa-aktif.php', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kat_keterangan_surat`
--

CREATE TABLE `kat_keterangan_surat` (
  `id` int(4) NOT NULL,
  `kat_keterangan_surat` varchar(100) NOT NULL,
  `key` varchar(40) NOT NULL,
  `type` varchar(20) NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 1,
  `deskripsi` varchar(100) NOT NULL,
  `placeholder` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kat_keterangan_surat`
--

INSERT INTO `kat_keterangan_surat` (`id`, `kat_keterangan_surat`, `key`, `type`, `required`, `deskripsi`, `placeholder`) VALUES
(1, 'Foto Kartu Tanda Mahasiswa (KTM)', 'ktm', 'image', 1, 'Format JPG, JPEG. Pastikan dapat terbaca dengan jelas.', '0'),
(2, 'Surat Keterangan Bebas Pinjaman Pustaka', 'bebas_pustaka', 'image', 1, 'Format JPG, JPEG. Pastikan dapat terbaca dengan jelas.', '0'),
(3, 'Surat Bebas Perpustakaan Daerah', 'bebas_pustaka_perpusda', 'image', 1, 'Format JPG, JPEG. Pastikan dapat terbaca dengan jelas.', '0'),
(4, 'Slip Pembayaran Biaya Cuti Kuliah', 'slip_bayar_cuti', 'image', 1, 'Format JPG, JPEG. Pastikan dapat terbaca dengan jelas.', '0'),
(5, 'Surat Keterangan dari Biro Keuangan', 'sk_biro_keuangan', 'image', 1, 'Format JPG, JPEG. Pastikan dapat terbaca dengan jelas.', '0'),
(6, 'Surat Keterangan dari Kaprodi', 'sk_kaprodi', 'image', 1, 'Format JPG, JPEG. Pastikan dapat terbaca dengan jelas.', '0'),
(7, 'Surat Keterangan Pembimbing Thesis', 'sk_pembimbing_thesis', 'image', 1, 'Format JPG, JPEG. Pastikan dapat terbaca dengan jelas.', '0'),
(8, 'Keterangan', 'keterangan', 'textarea', 1, '', '0'),
(9, 'Surat Keterangan Bebas Tunggakan SPP', 'sk_bebas_spp', 'image', 1, 'Format JPG, JPEG. Pastikan dapat terbaca dengan jelas.', '0'),
(10, 'Semester', 'semester', 'sem', 1, 'Pilih semester.', '0'),
(11, 'Tahun Akademik', 'thn_akademik', 'ta', 1, 'Pilih tahun akademik.', '0'),
(12, 'Nama Dosen Pembimbing Tesis/Desertasi', 'nama_dosen', 'select_dosen', 1, 'Pilih nama Dosen Pembimbing tesis/desertasi.', '0'),
(13, 'Alasan Cuti', 'alasan_cuti', 'textarea', 1, 'Alasan mengapa cuti kuliah.', '0'),
(14, 'Tujuan Surat', 'tujuan_surat', 'textarea', 1, 'Surat ditujukan kepada. Contoh : \"Pimpinan Perusahaan X\"', '0'),
(15, 'Isi Surat', 'isi_surat', 'textarea', 1, 'Isi surat.', '0'),
(16, 'Lokasi Penelitian', 'lokasi_penelitian', 'text', 1, 'Lokasi tempat mengadakan penelitian.', '0'),
(17, 'Waktu Penelitian', 'waktu_penelitian', 'date_range', 1, 'Tanggal mulai dan tanggal selesai penelitian.', '0'),
(18, 'Pembimbing/Promotor', 'pembimbing', 'select_pembimbing', 1, 'Pilih nama Dosen Pembimbing/Promotor.', '0'),
(19, 'Dosen', 'dosen', 'select_dosen', 1, 'Pilih nama Dosen', '0'),
(20, 'Tujuan Penelitian', 'tujuan_penelitian', 'textarea', 1, 'Tujuan Penelitian. Contoh : \"untuk keperluan tesis, untuk keperluan desertasi\".', '0'),
(21, 'Alamat Mahasiswa', 'alamat_mahasiswa', 'textarea', 1, 'Alamat domisili Saudara.', '0'),
(22, 'Tema Penelitian', 'tema_penelitian', 'textarea', 1, 'Tema penelitian.', '');

-- --------------------------------------------------------

--
-- Table structure for table `kat_tujuan_surat`
--

CREATE TABLE `kat_tujuan_surat` (
  `id` int(2) NOT NULL,
  `kat_tujuan_surat` varchar(50) NOT NULL DEFAULT '0',
  `kode` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kat_tujuan_surat`
--

INSERT INTO `kat_tujuan_surat` (`id`, `kat_tujuan_surat`, `kode`) VALUES
(1, 'Intern Universitas', 'A'),
(2, 'Muhammadiyah', 'B'),
(3, 'Pemerintah', 'C'),
(4, 'Swasta', 'D');

-- --------------------------------------------------------

--
-- Table structure for table `keterangan_surat`
--

CREATE TABLE `keterangan_surat` (
  `id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `id_surat` int(11) NOT NULL,
  `id_kat_keterangan_surat` int(3) NOT NULL,
  `verifikasi` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keterangan_surat`
--

INSERT INTO `keterangan_surat` (`id`, `value`, `id_surat`, `id_kat_keterangan_surat`, `verifikasi`) VALUES
(790, '198', 336, 1, 1),
(791, '198', 336, 2, 1),
(792, '198', 336, 4, 1),
(793, 'Ganjil', 336, 10, 1),
(794, '2020 / 2021', 336, 11, 1),
(795, 'Bekerja', 336, 13, 1),
(818, '198', 340, 1, 1),
(819, 'Pimpinan Perusahaan PG Madukismo', 340, 14, 1),
(820, 'Bantul', 340, 16, 1),
(821, '12/01/2020 - 12/31/2020', 340, 17, 1),
(822, '127', 340, 18, 1),
(823, 'Untuk keperluan thesis', 340, 20, 1),
(824, 'Jl. Bantul KM 4.', 340, 21, 1),
(825, 'Manajemen Pengelolaan Perusahaan Gula di era Modern', 340, 22, 1),
(826, '198', 341, 1, 0),
(827, '198', 341, 2, 0),
(828, '199', 341, 4, 0),
(829, 'Ganjil', 341, 10, 0),
(830, '2021 / 2022', 341, 11, 0),
(831, 'capek', 341, 13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(20) NOT NULL,
  `id_user` varchar(15) NOT NULL,
  `file` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `id_user`, `file`, `thumb`) VALUES
(198, '122', 'uploads/dokumen/lt04027254.png', 'uploads/dokumen/lt04027254_thumb.png'),
(199, '122', 'uploads/dokumen/certification-certificate-template.jpg', 'uploads/dokumen/certification-certificate-template_thumb.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `notif`
--

CREATE TABLE `notif` (
  `id` int(30) NOT NULL,
  `pengirim` int(11) NOT NULL,
  `kepada` int(11) NOT NULL,
  `id_prodi` int(4) NOT NULL,
  `id_surat` int(11) NOT NULL,
  `role` int(1) NOT NULL,
  `id_status_pesan` int(4) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `tanggal` datetime NOT NULL,
  `dibaca` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notif`
--

INSERT INTO `notif` (`id`, `pengirim`, `kepada`, `id_prodi`, `id_surat`, `role`, `id_status_pesan`, `status`, `tanggal`, `dibaca`) VALUES
(1, 122, 122, 102, 336, 3, 1, 1, '0000-00-00 00:00:00', '2020-11-10 15:27:42'),
(2, 122, 122, 102, 336, 2, 3, 1, '0000-00-00 00:00:00', '2020-11-10 15:28:00'),
(3, 122, 122, 102, 336, 3, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 94, 122, 102, 336, 3, 4, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 94, 122, 102, 336, 6, 5, 1, '0000-00-00 00:00:00', '2020-11-10 15:28:22'),
(6, 95, 122, 102, 336, 3, 6, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 95, 122, 102, 336, 5, 7, 1, '0000-00-00 00:00:00', '2020-11-10 15:28:47'),
(8, 106, 122, 11, 336, 3, 8, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 106, 122, 11, 336, 1, 9, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 3, 0, 11, 336, 3, 10, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 3, 0, 11, 336, 1, 11, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 3, 0, 11, 336, 2, 12, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 3, 0, 11, 336, 5, 13, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 3, 0, 11, 336, 6, 14, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 122, 122, 102, 340, 3, 1, 1, '0000-00-00 00:00:00', '2020-11-10 15:53:32'),
(17, 122, 122, 102, 340, 2, 3, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 122, 122, 102, 340, 3, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 94, 122, 102, 340, 3, 4, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 94, 122, 102, 340, 6, 5, 1, '0000-00-00 00:00:00', '2020-11-10 15:55:07'),
(21, 95, 122, 102, 340, 3, 6, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 95, 122, 102, 340, 5, 7, 1, '0000-00-00 00:00:00', '2020-11-10 15:55:31'),
(23, 106, 122, 11, 340, 3, 8, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 106, 122, 11, 340, 1, 9, 1, '0000-00-00 00:00:00', '2020-11-10 15:55:56'),
(25, 3, 0, 11, 340, 3, 10, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 3, 0, 11, 340, 1, 11, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 3, 0, 11, 340, 2, 12, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 3, 0, 11, 340, 5, 13, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 3, 0, 11, 340, 6, 14, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 122, 122, 102, 341, 3, 1, 1, '0000-00-00 00:00:00', '2020-11-11 01:24:44'),
(31, 122, 122, 102, 341, 2, 3, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 122, 122, 102, 341, 3, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `no_surat`
--

CREATE TABLE `no_surat` (
  `id` int(11) NOT NULL,
  `no_surat` int(11) NOT NULL,
  `id_surat` int(5) NOT NULL,
  `id_kategori_surat` int(11) NOT NULL,
  `kat_tujuan_surat` int(2) NOT NULL,
  `tujuan_surat` int(3) NOT NULL,
  `urusan_surat` int(3) NOT NULL,
  `instansi` text NOT NULL,
  `tanggal_terbit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `no_surat`
--

INSERT INTO `no_surat` (`id`, `no_surat`, `id_surat`, `id_kategori_surat`, `kat_tujuan_surat`, `tujuan_surat`, `urusan_surat`, `instansi`, `tanggal_terbit`) VALUES
(30, 1, 334, 3, 4, 23, 0, '<p>Solo</p>', '2020-11-10'),
(31, 1, 336, 1, 1, 1, 0, '<p>Rektor</p><p>CQ : <span xss=removed>Biro Akademik</span></p>', '2020-11-10'),
(32, 2, 340, 3, 4, 23, 0, 'Pimpinan Perusahaan PG Madukismo', '2020-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` int(3) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `singkatan` varchar(10) NOT NULL,
  `nama_di_dbumy` varchar(100) NOT NULL,
  `admin_prodi` varchar(50) NOT NULL,
  `ka_prodi` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `prodi`, `singkatan`, `nama_di_dbumy`, `admin_prodi`, `ka_prodi`) VALUES
(11, 'Pascasarjana', 'PPs', '', '3', 106),
(101, 'Magister Studi Islam', 'msi', 'S2 Magister Studi Islam', '105', 104),
(102, 'Magister Manajemen', 'MM', 'S2 Manajemen', '94', 95),
(103, 'Magister Manajemen Rumah Sakit', 'mmr', 'S2 Administrasi Rumah Sakit', '', 0),
(104, 'Magister Ilmu Pemerintahan', 'mip', 'S2 Ilmu Pemerintahan', '', 0),
(105, 'Magister Keperawatan', 'mkep', 'S2 Magister Keperawatan', '100', 0),
(106, 'Magister Ilmu Hubungan Internasional', 'mihi', 'S2 Hubungan Internasional', '', 0),
(107, 'Magister Ilmu Hukum', 'mih', 'S2 Hukum', '', 0),
(201, 'Program Doktor Psikologi Pendidikan Islam', 'ppi', 'S2 Magister Studi Islam', '', 0),
(202, 'Program Doktor Politik Islam-Ilmu Politik', 'pi', 'S2 Manajemen', '', 0),
(203, 'Program Doktor Manajemen', 'pm', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(2) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Sekretariat Pascasarjana'),
(2, 'TU Prodi'),
(3, 'Mahasiswa'),
(4, 'Dosen'),
(5, 'Direktur Pascasarjana'),
(6, 'Ka Prodi');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id_setting` int(5) NOT NULL,
  `nama_setting` varchar(20) NOT NULL,
  `value_setting` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `badge` varchar(50) DEFAULT NULL,
  `alert` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`, `icon`, `badge`, `alert`) VALUES
(0, 'Belum Memenuhi Syarat', '', 'secondary', ''),
(1, 'Baru', 'fas fa-exclamation-triangle', 'warning', 'Lengkapi formulir di bawah ini'),
(2, 'Tunggu Verifikasi TU', 'fas fa-hourglass-half', 'birutua', 'Menunggu Verifikasi Staf Tata Usaha'),
(3, 'Sudah Diverifikasi TU & Menunggu ACC Kaprodi', '', 'ungutua', ''),
(4, 'Perlu Direvisi', '', 'danger', ''),
(5, 'Tunggu Verifikasi TU (2)', '', 'info', ''),
(6, 'Ditolak', '', 'secondary', ''),
(7, 'Tunggu ACC Kaprodi', '', 'orangepastel', ''),
(8, 'Tunggu ACC Direktur Pasca', '', 'tosca', ''),
(9, 'Proses Penerbitan', '', 'ungu', ''),
(10, 'Selesai', '', 'success', '');

-- --------------------------------------------------------

--
-- Table structure for table `status_pesan`
--

CREATE TABLE `status_pesan` (
  `id` int(3) NOT NULL,
  `id_status` int(2) NOT NULL,
  `role` int(2) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `badge` varchar(15) NOT NULL,
  `alert` varchar(255) NOT NULL,
  `judul_notif` varchar(255) NOT NULL,
  `isi_notif` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_pesan`
--

INSERT INTO `status_pesan` (`id`, `id_status`, `role`, `icon`, `badge`, `alert`, `judul_notif`, `isi_notif`) VALUES
(1, 1, 3, 'fas fa-exclamation-triangle', 'warning', 'Lengkapi formulir di bawah ini', 'Lengkapi formulir surat', 'Lengkapi formulir surat'),
(2, 2, 3, 'fas fa-hourglass-half', 'birutua', 'Menunggu Verifikasi Staf Tata Usaha', 'Menunggu Verifikasi Staf Tata Usaha', 'Menunggu verifikasi staf Tata Usaha'),
(3, 2, 2, 'fas fa-hourglass-half', 'birutua', 'Menunggu Verifikasi Anda', 'Ada surat Menunggu Verifikasi Anda', 'Ada surat Menunggu Verifikasi Anda'),
(4, 7, 3, 'fas fa-check-circle', 'ungutua', 'Surat sudah diverifikasi d', 'Surat sudah diverifikasi oleh Tata Usaha', 'Surat sudah diverifikasi oleh Tata Usaha. Selanjutnya menunggu persetujuan dari kaprodi'),
(5, 7, 6, 'fas fa-hourglass-half', 'ungutua', 'Surat menunggu Persetujuan kaprodi', 'Ada Surat menunggu Persetujuan kaprodi', 'Ada Surat menunggu Persetujuan kaprodi'),
(6, 8, 3, 'fas fa-check-circle', 'tosca', 'Surat sudah disetujui Kaprodi', 'Surat sudah disetujui Kaprodi', 'Surat sudah disetujui KaprodiSelanjutnya menunggu persetujuan Direktur Pascasarjana.'),
(7, 8, 5, 'fas fa-hourglass-half', 'tosca', 'Surat menunggu persetujuan Direktur Pascasarjana', 'Ada surat menunggu persetujuan Direktur Pascasarjana', 'Ada surat menunggu persetujuan Direktur Pascasarjana'),
(8, 9, 3, 'fas fa-check-circle', 'ungu', 'Surat disetujui Direktur Pascasarjana', 'Surat disetujui Direktur Pascasarjana', 'Surat disetujui Direktur Pascasarjana. Selanjutnya surat akan diterbitkan oleh staf TU Pascasarjana'),
(9, 9, 1, 'fas fa-hourglass-half', 'ungu', 'Ada surat menunggu diproses oleh TU Pascasarjana', 'Ada surat menunggu diproses oleh TU Pascasarjana', 'Ada surat menunggu diproses oleh TU Pascasarjana'),
(10, 10, 3, 'fas fa-check-circle', 'success', 'Surat sudah diterbitkan', 'Surat sudah diterbitkan', 'yang Anda ajukan sudah diterbitkan'),
(11, 10, 1, 'fas fa-check-circle', 'success', 'Surat sudah diterbitkan', 'Surat sudah diterbitkan', 'Surat yang Anda ajukan sudah diterbitkan'),
(12, 10, 2, 'fas fa-check-circle', 'success', 'Surat sudah diterbitkan', 'Surat sudah diterbitkan', 'Surat yang Anda ajukan sudah diterbitkan'),
(13, 10, 5, 'fas fa-check-circle', 'success', 'Surat sudah diterbitkan', 'Surat sudah diterbitkan', 'Surat yang Anda ajukan sudah diterbitkan'),
(14, 10, 6, 'fas fa-check-circle', 'success', 'Surat sudah diterbitkan', 'Surat sudah diterbitkan', 'Surat yang Anda ajukan sudah diterbitkan'),
(15, 4, 3, 'fas fa-edit', 'danger', 'Surat perlu direvisi', 'Surat perlu direvisi', 'Surat perlu direvisi'),
(16, 4, 2, 'fas fa-edit', 'danger', 'Surat perlu direvisi', 'Surat perlu direvisi', 'Surat perlu direvisi'),
(17, 5, 2, 'fas fa-hourglass-half', 'info', 'Tunggu Verifikasi TU \r\n', 'Tunggu Verifikasi TU \r\n', 'Tunggu Verifikasi TU \r\n'),
(18, 5, 3, 'fas fa-hourglass-half', 'info', 'Tunggu Verifikasi TU \r\n', 'Tunggu Verifikasi TU \r\n', 'Tunggu Verifikasi TU \r\n'),
(19, 6, 3, 'fas fa-times-circle', 'danger', 'Ditolak', 'Ditolak', 'Ditolak'),
(20, 6, 2, 'fas fa-times-circle', 'danger', 'Ditolak', 'Ditolak', 'Ditolak');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` varchar(15) NOT NULL,
  `id_kategori_surat` int(3) NOT NULL,
  `kode_surat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`id`, `id_mahasiswa`, `id_kategori_surat`, `kode_surat`) VALUES
(336, '122', 1, ''),
(340, '122', 3, ''),
(341, '122', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `surat_status`
--

CREATE TABLE `surat_status` (
  `id` int(12) NOT NULL,
  `id_surat` int(11) NOT NULL,
  `id_status` int(2) NOT NULL,
  `date` datetime NOT NULL,
  `pic` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_status`
--

INSERT INTO `surat_status` (`id`, `id_surat`, `id_status`, `date`, `pic`) VALUES
(617, 336, 1, '2020-11-10 15:27:18', 122),
(618, 336, 2, '2020-11-10 15:27:42', 122),
(619, 336, 7, '2020-11-10 15:28:14', 94),
(620, 336, 8, '2020-11-10 15:28:30', 95),
(621, 336, 9, '2020-11-10 15:28:54', 106),
(622, 336, 10, '2020-11-10 15:33:47', 3),
(626, 340, 1, '2020-11-10 15:41:16', 122),
(627, 340, 2, '2020-11-10 15:53:32', 122),
(628, 340, 7, '2020-11-10 15:54:51', 94),
(629, 340, 8, '2020-11-10 15:55:13', 95),
(630, 340, 9, '2020-11-10 15:55:37', 106),
(631, 340, 10, '2020-11-10 16:44:40', 3),
(632, 341, 1, '2020-11-11 01:24:20', 122),
(633, 341, 2, '2020-11-11 01:24:44', 122);

-- --------------------------------------------------------

--
-- Table structure for table `tujuan_surat`
--

CREATE TABLE `tujuan_surat` (
  `id` int(2) NOT NULL,
  `tujuan_surat` varchar(100) NOT NULL,
  `id_kat_tujuan_surat` int(2) NOT NULL,
  `kode_tujuan` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tujuan_surat`
--

INSERT INTO `tujuan_surat` (`id`, `tujuan_surat`, `id_kat_tujuan_surat`, `kode_tujuan`) VALUES
(1, 'Rektor/Wakil Rektor', 1, '1'),
(2, 'Pimpinan Fakultas/Wakil Dekan', 1, '2'),
(4, 'Dosen', 1, '3'),
(5, 'Mahasiswa', 1, '4'),
(7, 'Bagian-Bagian', 1, '5'),
(8, 'Karyawan', 1, '6'),
(9, 'Lain-lain', 1, '7'),
(10, 'Tingkat Pusat', 2, '1'),
(11, 'Tingkat Wilayah', 2, '2'),
(12, 'Tingkat Daerah', 2, '3'),
(13, 'Ortonom-ortonom', 2, '4'),
(14, 'KOPERTIS', 3, '1'),
(15, 'Pendidikan dan Kebudayaan /Departemen Lain-lain', 3, '2'),
(17, 'Perguruan Tinggi Negeri/Lain-lain', 3, '3'),
(18, 'Pemerintah Daerah Tingkat I', 3, '4'),
(19, 'Pemerintah Daerah Tingkat II', 3, '5'),
(20, 'Instansi Pemerintah', 3, '6'),
(21, 'Luar Negeri', 3, '7'),
(22, 'Perguruan Tinggi Swasta', 4, '1'),
(23, 'Badan Instansi Swasta', 4, '2'),
(24, 'Perorangan', 4, '3');

-- --------------------------------------------------------

--
-- Table structure for table `urusan_surat`
--

CREATE TABLE `urusan_surat` (
  `id` int(1) NOT NULL,
  `urusan` varchar(50) NOT NULL,
  `kode` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `urusan_surat`
--

INSERT INTO `urusan_surat` (`id`, `urusan`, `kode`) VALUES
(1, 'Kemahasiswaan', 'I'),
(2, 'Pendidikan dan Pengajaran', 'II'),
(3, 'Penelitian/Humas', 'III'),
(4, 'Keuangan', 'IV'),
(5, 'Peralatan/Perlengkapan', 'V'),
(6, 'Kepegawaian', 'VI'),
(7, 'Kepustakaan', 'VII'),
(8, 'Lain-lain', 'VIII');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telp` varchar(14) NOT NULL,
  `role` int(3) NOT NULL DEFAULT 3,
  `id_prodi` int(3) NOT NULL,
  `last_ip` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ttd_stempel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `telp`, `role`, `id_prodi`, `last_ip`, `created_at`, `updated_at`, `fullname`, `password`, `ttd_stempel`) VALUES
(3, 'admin', 'admin@ppdsinternasolo.id', '', 1, 11, '', '2017-09-29 10:09:44', '0000-00-00 00:00:00', 'Admin', '$2y$10$gTsXnouzlErdDGbL0sF6Ru3xZC3HiLkyRYsYQRcN7DOwFEyYKoIti', ''),
(94, 'admin_mm', 'mm@umy.ac.id', '', 2, 102, '', '2020-05-18 00:00:00', '2020-09-03 00:00:00', 'Admin MM', '$2y$10$XVGWvDliLj8gojS06hVok.JyrFCExmm4/mxIoBkBFyXhM.QQLFF5m', ''),
(95, 'arnisurwanti@umy.ac.id', 'arnisurwanti@umy.ac.id', '', 6, 102, '', '2020-05-18 00:00:00', '2020-09-29 00:00:00', 'Dr. Arni Surwanti, M.Si', '$2y$10$iPbXTFkHtrb4HfOP5DCZue8lD6VIpJUBECYoEPqDdl1nqL741MByG', ''),
(100, 'admin_mkep', 'mkep@umy.ac.id', '', 2, 0, '', '2020-05-20 00:00:00', '2020-08-19 00:00:00', 'Admin  MKep', '$2y$10$gTsXnouzlErdDGbL0sF6Ru3xZC3HiLkyRYsYQRcN7DOwFEyYKoIti', ''),
(104, 'kaprodi_msi', 'kaprodimsi@umy.ac.id', '', 6, 101, '', '2020-05-21 00:00:00', '2020-09-21 00:00:00', 'Kaprodi MSI', '$2y$10$JTUhWcag7zwo8yucTNJdXumfZ./4kfhi86r0.Hpmg/qG29MMYi6Pq', ''),
(105, 'admin_msi', 'admin_msi@umy.ac.id', '', 2, 101, '', '2020-05-21 00:00:00', '2020-08-20 00:00:00', 'Admin MSI', '$2y$10$iw7kLKfnO8swUBmi2glk5ukwGZSV9ft3zn63urLIMZA9afBsKclRW', ''),
(106, 'sriatmaja@umy.ac.id', 'sriatmaja@umy.ac.id', '', 5, 11, '', '2020-05-22 00:00:00', '2020-11-05 00:00:00', 'Ir.Sri Atmaja P. Rosyidi, M.Sc.Eng., Ph.D., P.Eng.,IPM', '$2y$10$bg3IpuCvgTPRCvOm2ZqkXeVSrnntdqJKQl3/T6yN8HyXzCGtWkjJe', ''),
(119, 'adam', 'yaufaniadam@umy.ac.id', '', 3, 101, '', '2017-09-29 10:09:44', '0000-00-00 00:00:00', 'Yaufani Adam', '$2y$10$gTsXnouzlErdDGbL0sF6Ru3xZC3HiLkyRYsYQRcN7DOwFEyYKoIti', ''),
(122, '20191020011', 'lusiana.dwi.psc19@mail.umy.ac.id', '087838515752', 3, 102, '', '2020-09-03 00:00:00', '0000-00-00 00:00:00', 'Lusiana Dwi Wahyuni', '', ''),
(123, 'susanto@umy.ac.id', 'susanto@umy.ac.id', '', 4, 0, '', '2020-11-10 00:00:00', '2020-11-10 00:00:00', 'Dr. Susanto, SE., MS', '$2y$10$PdAdESEbITwL27ZHKCqUguyps.eO5XlZhY/0i4Q.Qks7yqqCzX.WG', ''),
(124, 'profsiswoyo@umy.ac.id', 'profsiswoyo@umy.ac.id', '', 4, 0, '', '2020-11-10 00:00:00', '2020-11-10 00:00:00', 'Prof. Dr. Siswoyo Haryono, MM', '$2y$10$5xaErsFeuNr8k2GH2qfqJuv5/FWaq6Omhb8BcR82YhEEi5PscmfE6', ''),
(125, 'herukurnianto@umy.ac.id', 'herukurnianto@umy.ac.id', '', 4, 0, '', '2020-11-10 00:00:00', '2020-11-10 00:00:00', 'Prof. Dr. Heru Kurnianto Tjahjono, MM', '$2y$10$TVRqt9cE0XBl1c1aqB149ufv4ne4ANVMxc3GiEnlYDGPXIkSxYUvK', ''),
(126, 'nuryakin@umy.ac.id', 'nuryakin@umy.ac.id', '', 4, 0, '', '2020-11-10 00:00:00', '2020-11-10 00:00:00', 'Dr. Nuryakin, SE., MM', '$2y$10$vruTsIUbEOKhWW2m/RsaV.9SraTc034NsvX94lNqwq.0vZWnaFxrC', ''),
(127, 'r.yaya@umy.ac.id', 'r.yaya@umy.ac.id', '', 4, 0, '', '2020-11-10 00:00:00', '2020-11-10 00:00:00', 'Rizal Yaya, SE., M.Sc., Ph.D., CA., Akt.', '$2y$10$U/nm5Gz/UI4gvrn8H.dcNey.ds9Zy5jSES0MVNKFwqwknBQ/wg/L2', ''),
(128, 'wihandaru@umy.ac.id', 'wihandaru@umy.ac.id', '', 4, 0, '', '2020-11-10 00:00:00', '2020-11-10 00:00:00', 'Dr. Wihandaru, M.Si', '$2y$10$MoQ4Mt3ci1/U7lKMj/kOxuP9b6EhSmeKLMbjusZUPU/gWyUUDiuhO', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori_surat`
--
ALTER TABLE `kategori_surat`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `kat_keterangan_surat`
--
ALTER TABLE `kat_keterangan_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kat_tujuan_surat`
--
ALTER TABLE `kat_tujuan_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keterangan_surat`
--
ALTER TABLE `keterangan_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_dok_persyaratan_kategori_dok_persyaratan` (`id_kat_keterangan_surat`) USING BTREE,
  ADD KEY `FK__surat` (`id_surat`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `no_surat`
--
ALTER TABLE `no_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_no_surat_kategori_surat` (`id_surat`) USING BTREE;

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_pesan`
--
ALTER TABLE `status_pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_surat_kategori_surat` (`id_kategori_surat`);

--
-- Indexes for table `surat_status`
--
ALTER TABLE `surat_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_surat_status_status` (`id_status`),
  ADD KEY `FK_surat_status_surat` (`id_surat`);

--
-- Indexes for table `tujuan_surat`
--
ALTER TABLE `tujuan_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tujuan_surat_kat_tujuan_surat` (`id_kat_tujuan_surat`);

--
-- Indexes for table `urusan_surat`
--
ALTER TABLE `urusan_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_users_role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori_surat`
--
ALTER TABLE `kategori_surat`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kat_keterangan_surat`
--
ALTER TABLE `kat_keterangan_surat`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `kat_tujuan_surat`
--
ALTER TABLE `kat_tujuan_surat`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `keterangan_surat`
--
ALTER TABLE `keterangan_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=832;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `notif`
--
ALTER TABLE `notif`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `no_surat`
--
ALTER TABLE `no_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id_setting` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status_pesan`
--
ALTER TABLE `status_pesan`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=342;

--
-- AUTO_INCREMENT for table `surat_status`
--
ALTER TABLE `surat_status`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=634;

--
-- AUTO_INCREMENT for table `tujuan_surat`
--
ALTER TABLE `tujuan_surat`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `urusan_surat`
--
ALTER TABLE `urusan_surat`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keterangan_surat`
--
ALTER TABLE `keterangan_surat`
  ADD CONSTRAINT `FK__surat` FOREIGN KEY (`id_surat`) REFERENCES `surat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_keterangan_surat_kat_keterangan_surat` FOREIGN KEY (`id_kat_keterangan_surat`) REFERENCES `kat_keterangan_surat` (`id`);

--
-- Constraints for table `surat`
--
ALTER TABLE `surat`
  ADD CONSTRAINT `FK_surat_kategori_surat` FOREIGN KEY (`id_kategori_surat`) REFERENCES `kategori_surat` (`id`);

--
-- Constraints for table `surat_status`
--
ALTER TABLE `surat_status`
  ADD CONSTRAINT `FK_surat_status_status` FOREIGN KEY (`id_status`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `FK_surat_status_surat` FOREIGN KEY (`id_surat`) REFERENCES `surat` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tujuan_surat`
--
ALTER TABLE `tujuan_surat`
  ADD CONSTRAINT `FK_tujuan_surat_kat_tujuan_surat` FOREIGN KEY (`id_kat_tujuan_surat`) REFERENCES `kat_tujuan_surat` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
