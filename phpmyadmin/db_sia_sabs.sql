-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2020 at 11:03 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sia_sabs`
--

-- --------------------------------------------------------

--
-- Table structure for table `bobot_penilaians`
--

CREATE TABLE `bobot_penilaians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user_gurusekolah` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KKM` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ulangan_harian` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uts` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bobot_penilaians`
--

INSERT INTO `bobot_penilaians` (`id`, `id_user_gurusekolah`, `KKM`, `ulangan_harian`, `uts`, `uas`, `created_at`, `updated_at`) VALUES
(7, '18515020', '75', '20', '40', '40', '2020-04-11 01:44:08', '2020-04-11 01:44:08'),
(8, '16515021', '75', '20', '30', '50', '2020-04-11 01:44:08', '2020-04-11 01:44:08'),
(9, '16515020', '75', '30', '30', '40', '2020-05-15 00:22:46', '2020-05-15 00:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gedungs`
--

CREATE TABLE `gedungs` (
  `kode_gedung` int(11) NOT NULL,
  `id_user_guruasrama` varchar(100) NOT NULL,
  `nama_gedung` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gedungs`
--

INSERT INTO `gedungs` (`kode_gedung`, `id_user_guruasrama`, `nama_gedung`) VALUES
(1, '16505020', 'Sulaiman'),
(2, '17515020', 'Lukman 1'),
(3, '', 'Lukman 2'),
(4, '', 'Lukman 3');

-- --------------------------------------------------------

--
-- Table structure for table `gedung_memiliki_siswas`
--

CREATE TABLE `gedung_memiliki_siswas` (
  `kode_gedung` varchar(50) NOT NULL,
  `id_siswa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gedung_memiliki_siswas`
--

INSERT INTO `gedung_memiliki_siswas` (`kode_gedung`, `id_siswa`) VALUES
('1', '151515'),
('1', '155252'),
('1', '167171'),
('1', '165151'),
('1', '192020');

-- --------------------------------------------------------

--
-- Table structure for table `guru_asramas`
--

CREATE TABLE `guru_asramas` (
  `nik_guruasrama` varchar(100) NOT NULL,
  `nama_guru_asrama` varchar(100) NOT NULL,
  `tanggal_lahir` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru_asramas`
--

INSERT INTO `guru_asramas` (`nik_guruasrama`, `nama_guru_asrama`, `tanggal_lahir`, `alamat`, `jenis_kelamin`) VALUES
('16505020', 'Sudirgo Anton', '04/01/1989', 'Jl Candi Blok II A', 'Laki - Laki'),
('17515020', 'Indra Sari', '04/01/1989', 'Alamat siswa', 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `guru_mempunyai_jadwals`
--

CREATE TABLE `guru_mempunyai_jadwals` (
  `id` int(11) NOT NULL,
  `kode_kelas` varchar(100) NOT NULL,
  `id_gurusekolah` varchar(100) NOT NULL,
  `kode_mapel` varchar(50) NOT NULL,
  `hari` varchar(50) NOT NULL,
  `jam` varchar(100) NOT NULL,
  `tahun_ajaran` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru_mempunyai_jadwals`
--

INSERT INTO `guru_mempunyai_jadwals` (`id`, `kode_kelas`, `id_gurusekolah`, `kode_mapel`, `hari`, `jam`, `tahun_ajaran`, `semester`) VALUES
(1, '2', '16515020', 'SIA - 001', 'Senin', '09.40 - 10.00', '2019/2020', '2'),
(2, '1', '16515020', 'SIA - 001', 'Rabu', '10.30 - 11.20', '2019/2020', '2'),
(4, '2', '18515020', 'SIA - 003', 'Senin', '08.00 -09.40', '2019/2020', '2'),
(5, '2', '19515020', 'SIA - 004', 'Senin', '10.00 - 11.30', '2019/2020', '2'),
(6, '2', '17515020', 'SIA - 002', 'Selasa', '08.00 - 09.30', '2019/2020', '2'),
(7, '2', '20515020', 'SIA - 005', 'Selasa', '09.30 - 10.00', '2019/2020', '2'),
(8, '2', '21515020', 'SIA - 006', 'Selasa', '10.00 - 11.30', '2019/2020', '2'),
(9, '2', '19515020', 'SIA - 004', 'Rabu', '09.30 - 10.00', '2019/2020', '2'),
(10, '2', '18515020', 'SIA - 003', 'Rabu', '10.00 - 11.30', '2019/2020', '2'),
(11, '2', '16515020', 'SIA - 001', 'Rabu', '08.00 - 09.30', '2019/2020', '2'),
(12, '2', '20515020', 'SIA - 005', 'Kamis', '08.00 - 09.30', '2019/2020', '2'),
(13, '2', '22515020', 'SIA - 007', 'Kamis', '09.30 - 10.00', '2019/2020', '2'),
(15, '1', '16515021', 'SIA - 001', 'Senin', '09.40 - 10.00', '2019/2020', '2'),
(16, '2', '16515020', 'SIA - 001', 'Senin', '08.00 - 09.30', '2020/2021', '1'),
(17, '2', '17515020', 'SIA - 002', 'Senin', '09.30 - 10.00', '2020/2021', '1'),
(18, '2', '18515020', 'SIA - 003', 'Senin', '10.00 - 11.30', '2020/2021', '1'),
(19, '3', '16515020', 'SIA - 001', 'Senin', '08.00 - 09.30', '2020/2021', '1'),
(20, '3', '17515020', 'SIA - 002', 'Senin', '09.30 - 10.00', '2020/2021', '1'),
(21, '3', '18515020', 'SIA - 003', 'Senin', '10.00 - 11.30', '2020/2021', '1');

-- --------------------------------------------------------

--
-- Table structure for table `guru_sekolahs`
--

CREATE TABLE `guru_sekolahs` (
  `id_user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_mata_pelajaran` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_guru_sekolah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guru_sekolahs`
--

INSERT INTO `guru_sekolahs` (`id_user`, `id_mata_pelajaran`, `nama_guru_sekolah`, `tanggal_lahir`, `alamat`, `jenis_kelamin`, `created_at`, `updated_at`) VALUES
('16515020', 'SIA - 001', 'Miftah Muhammad Farhan', '20-02-1998', '', 'Laki - laki', NULL, NULL),
('16515021', 'SIA - 007', 'Canada', '04/07/1988', 'alamat siswa', 'Laki - laki', NULL, NULL),
('17515020', 'SIA - 002', 'Ahmad Fauzy', '', '', '', NULL, NULL),
('18515020', 'SIA - 003', 'Antari Yuli', '', '', '', NULL, NULL),
('19515020', 'SIA - 004', 'Fery Anggara', '', '', '', NULL, NULL),
('20515020', 'SIA - 005', 'Yuni', '', '', '', NULL, NULL),
('21515020', 'SIA - 006', 'Sri Astriani', '', '', '', NULL, NULL),
('22515020', 'SIA - 007', 'Aji Sukma', '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hari_presensi_sekolahs`
--

CREATE TABLE `hari_presensi_sekolahs` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_siswa` varchar(100) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `tahun_ajaran` varchar(100) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hari_presensi_sekolahs`
--

INSERT INTO `hari_presensi_sekolahs` (`id`, `tanggal`, `id_siswa`, `kelas`, `keterangan`, `tahun_ajaran`, `semester`, `updated_at`, `created_at`) VALUES
(2, '2020-04-21', '151515', 'XB', 'Sakit', '2019/2020', '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '2020-04-20', '151515', 'XB', 'Sakit', '2019/2020', '2', '2020-04-19 19:56:04', '2020-04-19 19:56:04'),
(4, '2020-04-20', '155252', 'XB', 'Hadir', '2019/2020', '2', '2020-04-19 19:56:04', '2020-04-19 19:56:04'),
(5, '2020-04-20', '167171', 'XB', 'Hadir', '2019/2020', '2', '2020-04-19 19:56:04', '2020-04-19 19:56:04'),
(6, '2020-04-20', '165151', 'XA', 'Hadir', '2019/2020', '2', '2020-04-19 20:05:20', '2020-04-19 20:05:20'),
(7, '2020-04-20', '192020', 'XA', 'Hadir', '2019/2020', '2', '2020-04-19 20:05:20', '2020-04-19 20:05:20'),
(8, '2020-04-22', '151515', 'XB', 'Hadir', '2019/2020', '2', '2020-04-22 09:16:33', '2020-04-22 09:16:33'),
(9, '2020-04-22', '155252', 'XB', 'Hadir', '2019/2020', '2', '2020-04-22 09:16:33', '2020-04-22 09:16:33'),
(10, '2020-04-22', '167171', 'XB', 'Hadir', '2019/2020', '2', '2020-04-22 09:16:33', '2020-04-22 09:16:33'),
(11, '2020-04-29', '151515', 'XB', 'Hadir', '2019/2020', '2', '2020-04-28 21:21:55', '2020-04-28 21:21:55'),
(12, '2020-04-29', '155252', 'XB', 'Hadir', '2019/2020', '2', '2020-04-28 21:21:55', '2020-04-28 21:21:55'),
(13, '2020-04-29', '167171', 'XB', 'Hadir', '2019/2020', '2', '2020-04-28 21:21:55', '2020-04-28 21:21:55'),
(14, '2020-04-30', '151515', 'XB', 'Hadir', '2019/2020', '2', '2020-04-30 00:21:06', '2020-04-30 00:21:06'),
(15, '2020-04-30', '155252', 'XB', 'Hadir', '2019/2020', '2', '2020-04-30 00:21:06', '2020-04-30 00:21:06'),
(16, '2020-04-30', '167171', 'XB', 'Hadir', '2019/2020', '2', '2020-04-30 00:21:06', '2020-04-30 00:21:06'),
(17, '2020-05-01', '151515', 'XB', 'Hadir', '2019/2020', '2', '2020-05-01 15:47:13', '2020-05-01 15:47:13'),
(18, '2020-05-01', '155252', 'XB', 'Hadir', '2019/2020', '2', '2020-05-01 15:47:13', '2020-05-01 15:47:13'),
(19, '2020-05-01', '167171', 'XB', 'Hadir', '2019/2020', '2', '2020-05-01 15:47:13', '2020-05-01 15:47:13');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_asramas`
--

CREATE TABLE `kegiatan_asramas` (
  `id` int(11) NOT NULL,
  `id_user_guruasrama` varchar(100) NOT NULL,
  `kode_kelas_asrama` varchar(50) NOT NULL,
  `nama_kegiatan` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_tempat` varchar(50) NOT NULL,
  `jam` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan_asramas`
--

INSERT INTO `kegiatan_asramas` (`id`, `id_user_guruasrama`, `kode_kelas_asrama`, `nama_kegiatan`, `tanggal`, `nama_tempat`, `jam`) VALUES
(1, '16505020', '1', 'Apel 1/3 Malam', '2020-03-13', 'Gedung Serbaguna', '04.30'),
(2, '16505020', '1', 'Ngaji Subuh', '2020-03-13', 'Gedung Serbaguna', '05.30'),
(3, '16505020', '1', 'Ngaji Malam', '2020-03-13', 'Gedung Serbaguna', '19.30'),
(4, '16505020', '4', 'Apel 1/3 Malam', '2020-03-16', 'Gedung Serbaguna', '04.30'),
(5, '16505020', '1', 'Ngaji Subuh', '2020-03-16', 'Gedung Serbaguna', '05.30'),
(6, '16505020', '1', 'Ngaji Malam', '2020-03-16', 'Gedung Serbaguna', '19.30');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kode_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kode_kelas`, `nama_kelas`) VALUES
(1, 'XA'),
(2, 'XB'),
(3, 'XIA');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_asramas`
--

CREATE TABLE `kelas_asramas` (
  `kode_kelas_asrama` int(11) NOT NULL,
  `nama_kelas_asrama` varchar(50) NOT NULL,
  `nama_sub_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas_asramas`
--

INSERT INTO `kelas_asramas` (`kode_kelas_asrama`, `nama_kelas_asrama`, `nama_sub_kelas`) VALUES
(1, '10', 'I/Bacaan(Qira\'ah)'),
(2, '10', 'II/Pegon(Kitabah)'),
(3, '11', 'III/Makna Lambat(Al-Taanni)'),
(4, '11', 'IV/Makna Cepat(Al-Sarii\')'),
(5, '11', 'V/Saringan (Al-Idlafi)'),
(6, '12', 'VI/Hadist Besar'),
(7, 'Umum', 'Umum');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_asrama_memiliki_siswas`
--

CREATE TABLE `kelas_asrama_memiliki_siswas` (
  `kode_kelas_asrama` varchar(50) NOT NULL,
  `id_siswa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas_asrama_memiliki_siswas`
--

INSERT INTO `kelas_asrama_memiliki_siswas` (`kode_kelas_asrama`, `id_siswa`) VALUES
('1', '151515'),
('2', '155252'),
('3', '165151'),
('4', '167171'),
('1', '192020');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_memiliki_siswas`
--

CREATE TABLE `kelas_memiliki_siswas` (
  `kode_kelas` varchar(100) NOT NULL,
  `id_siswa` varchar(100) NOT NULL,
  `tahun_ajaran` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas_memiliki_siswas`
--

INSERT INTO `kelas_memiliki_siswas` (`kode_kelas`, `id_siswa`, `tahun_ajaran`, `semester`) VALUES
('2', '151515', '2019/2020', '2'),
('2', '155252', '2019/2020', '2'),
('1', '165151', '2019/2020', '2'),
('1', '192020', '2019/2020', '2'),
('2', '167171', '2019/2020', '2'),
('3', '151515', '2020/2021', '1');

-- --------------------------------------------------------

--
-- Table structure for table `kritik_dan_sarans`
--

CREATE TABLE `kritik_dan_sarans` (
  `id` int(11) NOT NULL,
  `id_orangtua` varchar(100) NOT NULL,
  `kritik` varchar(200) NOT NULL,
  `saran` varchar(200) NOT NULL,
  `tahun_ajaran` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kritik_dan_sarans`
--

INSERT INTO `kritik_dan_sarans` (`id`, `id_orangtua`, `kritik`, `saran`, `tahun_ajaran`, `semester`, `updated_at`, `created_at`) VALUES
(2, 'p155252', 'Kritik adalah suatu komentar untuk terhadap sekolah contoh sekolah jaman sekarang kurang menarik', 'saran adalah suatu pesan yang menyampaikan kebaikan terhadap sekolah contoh sebaiknya para guru tidak memakai gadget pada saat jam mengajar', '2019/2020', '2', '2020-03-19 10:35:51', '2020-03-19 10:35:51');

-- --------------------------------------------------------

--
-- Table structure for table `kritik_dan_saran_siswas`
--

CREATE TABLE `kritik_dan_saran_siswas` (
  `id` int(11) NOT NULL,
  `id_siswa` varchar(100) NOT NULL,
  `id_guru` varchar(100) NOT NULL,
  `kritik_dan_saran` varchar(300) NOT NULL,
  `tahun_ajaran` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kritik_dan_saran_siswas`
--

INSERT INTO `kritik_dan_saran_siswas` (`id`, `id_siswa`, `id_guru`, `kritik_dan_saran`, `tahun_ajaran`, `semester`, `created_at`, `updated_at`) VALUES
(1, '151515', '16515020', 'Anda akan memberikan kritik dan saran kepada guru sekolah!', '2019/2020', '2', '2020-04-30 09:29:08', '2020-04-30 09:29:08'),
(2, '151515', '18515020', 'Anda akan memberikan kritik', '2019/2020', '2', '2020-04-30 09:29:29', '2020-04-30 09:29:29'),
(3, '151515', '16505020', 'Anda akan memberikan kritik dan saran kepada guru asrama!', '2019/2020', '2', '2020-04-30 09:31:03', '2020-04-30 09:31:03'),
(4, '151515', '22515020', 'Silahkan sampaikan kritik dan saran dengan baik dan sopan agar guru dapat mengevaluasi diri!', '2019/2020', '2', '2020-04-30 22:57:35', '2020-04-30 22:57:35'),
(5, '151515', '16515020', 'Anda akan memberikan kritik dan saran kepada guru sekolah!', '2019/2020', '2', '2020-05-04 05:16:40', '2020-05-04 05:16:40');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajarans`
--

CREATE TABLE `mata_pelajarans` (
  `kode_mapel` varchar(100) NOT NULL,
  `nama_mata_pelajaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_pelajarans`
--

INSERT INTO `mata_pelajarans` (`kode_mapel`, `nama_mata_pelajaran`) VALUES
('SIA - 001', 'Matematika'),
('SIA - 002', 'Fisika'),
('SIA - 003', 'Bahasa Indonesia'),
('SIA - 004', 'Bahasa Inggris'),
('SIA - 005', 'Biologi'),
('SIA - 006', 'Kimia'),
('SIA - 007', 'Ekonomi'),
('SIA - 008', 'Geografi'),
('SIA - 009', 'Kewirausahaan'),
('SIA - 010', 'Bimbingan Konseling');

-- --------------------------------------------------------

--
-- Table structure for table `materi_asramas`
--

CREATE TABLE `materi_asramas` (
  `kode_materi` varchar(100) NOT NULL,
  `kode_kelas_asrama` varchar(50) NOT NULL,
  `kategori_materi` varchar(50) NOT NULL,
  `nama_materi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materi_asramas`
--

INSERT INTO `materi_asramas` (`kode_materi`, `kode_kelas_asrama`, `kategori_materi`, `nama_materi`) VALUES
('ASA - 001', '1', 'Materi Pokok', 'Materi Surat Al-Mulk s/d An-Nas'),
('ASA - 002', '1', 'Materi Pokok', 'Thaharah'),
('ASA - 003', '1', 'Materi Pokok', 'Tajwid'),
('ASA - 004', '1', 'Materi Pokok', 'Adab Pencari Ilmu'),
('ASA - 005', '2', 'Materi Pokok', 'Huruf Hijaiyah'),
('ASA - 006', '2', 'Materi Pokok', 'Khat wa Imla\''),
('ASA - 007', '2', 'Materi Pokok', 'Kitabah Pegon'),
('ASA - 008', '2', 'Materi Pokok', 'Tuntunan Tata Krama'),
('ASA - 009', '3', 'Materi Pokok', 'Al-Quran Juz 18 s/d 30'),
('ASA - 010', '3', 'Materi Pokok', 'Kitab Al-Shalat'),
('ASA - 011', '3', 'Materi Pokok', 'Kitab Al-Shalat Al-Nawafil'),
('ASA - 012', '3', 'Materi Pokok', 'Kitab Al-Shaum'),
('ASA - 013', '3', 'Materi Pokok', 'Kitab Al-Da\'awat'),
('ASA - 014', '3', 'Materi Pokok', 'Kitab Al-Adab'),
('ASA - 015', '3', 'Materi Pokok', 'Kitab Shifat Al-Jannah wa Al-Nar'),
('ASA - 016', '3', 'Materi Pokok', 'Kitab Al-Janaiz'),
('ASA - 017', '3', 'Materi Pokok', 'Kitab Al-Adillah'),
('ASA - 018', '3', 'Materi Pokok', 'Kitab Manasik wa Al-Jihad'),
('ASA - 019', '3', 'Materi Pokok', 'M. Tambahan K. Lambatan **)'),
('ASA - 020', '4', 'Materi Pokok', 'Al-Quran Juz 1 s/d 17'),
('ASA - 021', '4', 'Materi Pokok', 'Kitab Al-Haji'),
('ASA - 022', '4', 'Materi Pokok', 'Kitab Manasik Al-Haji'),
('ASA - 023', '4', 'Materi Pokok', 'Kitab Al-Ahkam'),
('ASA - 024', '4', 'Materi Pokok', 'Kitab Al-Jihad'),
('ASA - 025', '4', 'Materi Pokok', 'Kitab Al-Faraidl'),
('ASA - 026', '4', 'Materi Pokok', 'Kitab Al-Imarah'),
('ASA - 027', '4', 'Materi Pokok', 'Kitab Al-Imarah min Kanzi Al-\'ummal'),
('ASA - 028', '4', 'Materi Pokok', 'Kumpulan Khutbah'),
('ASA - 029', '4', 'Materi Pokok', 'M. Tambahan K. Cepatan **)'),
('ASA - 030', '4', 'Materi Pokok', 'Mukhtarudawat **)'),
('ASA - 031', '5', 'Materi Pokok', 'Al-Quran Juz 1 s/d 30'),
('ASA - 032', '5', 'Materi Pokok', 'Kitab Hidayah Al-Mustafidz fi Al-Tajwid'),
('ASA - 033', '5', 'Materi Pokok', 'Kitab Mabadi Fi al-Sharfi wa al-Nahwi'),
('ASA - 034', '5', 'Materi Pokok', 'Kitab Al-Faroid'),
('ASA - 035', '5', 'Materi Pokok', 'Kitab Al-Jihad'),
('ASA - 036', '5', 'Materi Pokok', 'Doa Setelah Pemakaman Jenazah'),
('ASA - 037', '1', 'Pemahaman Konsep dan Praktikum', 'Qira\'ah Al-Qur\'an'),
('ASA - 038', '1', 'Pemahaman Konsep dan Praktikum', 'Hafalan Surat-surat Pendek'),
('ASA - 039', '1', 'Pemahaman Konsep dan Praktikum', 'Hafalan Do\'a'),
('ASA - 040', '1', 'Pemahaman Konsep dan Praktikum', 'Praktek Penyucian Najis **)'),
('ASA - 041', '1', 'Pemahaman Konsep dan Praktikum', 'Praktek Wudhu **)'),
('ASA - 042', '1', 'Pemahaman Konsep dan Praktikum', 'Praktek Shalat **)'),
('ASA - 043', '2', 'Pemahaman Konsep dan Praktikum', 'Kitabah'),
('ASA - 044', '2', 'Pemahaman Konsep dan Praktikum', 'Hafalan Surat-surat Pendek'),
('ASA - 045', '2', 'Pemahaman Konsep dan Praktikum', 'Hafalan Do\'a'),
('ASA - 046', '3', 'Pemahaman Konsep dan Praktikum', 'Bacaan Al-Quran'),
('ASA - 047', '3', 'Pemahaman Konsep dan Praktikum', 'Makna dan Keterangan'),
('ASA - 048', '3', 'Pemahaman Konsep dan Praktikum', 'Hafalan dan Surat-surat Pendek'),
('ASA - 049', '3', 'Pemahaman Konsep dan Praktikum', 'Hafalan Do\'a'),
('ASA - 050', '3', 'Pemahaman Konsep dan Praktikum', 'Hafalan Dalil-dalil'),
('ASA - 051', '3', 'Pemahaman Konsep dan Praktikum', 'Praktek Peramutan Jenazah **)'),
('ASA - 052', '4', 'Pemahaman Konsep dan Praktikum', 'Bacaan Al-Quran'),
('ASA - 053', '4', 'Pemahaman Konsep dan Praktikum', 'Makna dan Keterangan'),
('ASA - 054', '4', 'Pemahaman Konsep dan Praktikum', 'Hafalan dan Surat-surat Pendek'),
('ASA - 055', '4', 'Pemahaman Konsep dan Praktikum', 'Hafalan Do\'a'),
('ASA - 056', '4', 'Pemahaman Konsep dan Praktikum', 'Hafalan Dalil-dalil'),
('ASA - 057', '4', 'Pemahaman Konsep dan Praktikum', 'Tilawati'),
('ASA - 058', '5', 'Pemahaman Konsep dan Praktikum', 'Latihan Mengajar'),
('ASA - 059', '5', 'Pemahaman Konsep dan Praktikum', 'Bacaan Al-Quran'),
('ASA - 060', '5', 'Pemahaman Konsep dan Praktikum', 'Makna dan Keterangan'),
('ASA - 061', '5', 'Pemahaman Konsep dan Praktikum', 'Hafalan dan Surat-surat Pendek'),
('ASA - 062', '5', 'Pemahaman Konsep dan Praktikum', 'Hafalan Do\'a'),
('ASA - 063', '5', 'Pemahaman Konsep dan Praktikum', 'Hafalan Dalil-dalil'),
('ASA - 064', '5', 'Pemahaman Konsep dan Praktikum', 'Tilawati'),
('ASA - 065', '5', 'Pemahaman Konsep dan Praktikum', 'Khutbah/Ceramah'),
('ASA - 066', '5', 'Pemahaman Konsep dan Praktikum', 'Adzan dan Iqamah'),
('ASA - 067', '7', 'Sikap dan Perilaku', 'Ketaatan'),
('ASA - 068', '7', 'Sikap dan Perilaku', 'Keta\'dhiman'),
('ASA - 069', '7', 'Sikap dan Perilaku', 'Kedisiplinan'),
('ASA - 070', '7', 'Sikap dan Perilaku', 'Kerapian'),
('ASA - 071', '7', 'Sikap dan Perilaku', 'Kesemangatan'),
('ASA - 072', '7', 'Sikap dan Perilaku', 'Partisipasi dalam kegiatan pembelajaran'),
('ASA - 073', '7', 'Sikap dan Perilaku', 'Etika terhadap teman sejawat'),
('ASA - 074', '7', 'Sikap dan Perilaku', 'Kerjasama dalam kelompok'),
('ASA - 075', '7', 'Sikap dan Perilaku', 'Kelengkapan dan kerapian buku dan catatan'),
('ASA - 076', '7', 'Kegiatan Ekstrakulikuler/Pengembangan Diri', 'Pencak Silat'),
('ASA - 077', '7', 'Kegiatan Ekstrakulikuler/Pengembangan Diri', 'Sepakbola/Futsal'),
('ASA - 078', '7', 'Kegiatan Ekstrakulikuler/Pengembangan Diri', 'Senam'),
('ASA - 079', '7', 'Catatan dan Saran Wali Kelas', 'Catatan dan Saran Wali Kelas'),
('ASA - 080', '1', 'Kegiatan Ekstrakulikuler/Pengembangan Diri', 'Penderesan Al-quran');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_02_03_071229_bobot_penilaian', 2),
(5, '2020_02_03_085237_guru_sekolah', 3),
(7, '2020_02_04_032337_siswas', 4),
(8, '2020_02_04_040932_penilaian_sekolahs', 5),
(9, '2020_02_04_045607_jadwal_pelajaran_sekolahs', 6);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_asramas`
--

CREATE TABLE `nilai_asramas` (
  `id` int(11) NOT NULL,
  `id_user_siswa` varchar(100) NOT NULL,
  `id_user_guruasrama` varchar(100) NOT NULL,
  `kode_materi` varchar(100) NOT NULL,
  `kategori_materi` varchar(100) NOT NULL,
  `tipe_nilai` varchar(100) NOT NULL,
  `nilai` varchar(100) NOT NULL,
  `kelas_asrama` varchar(50) NOT NULL,
  `tahun_ajaran` varchar(100) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_asramas`
--

INSERT INTO `nilai_asramas` (`id`, `id_user_siswa`, `id_user_guruasrama`, `kode_materi`, `kategori_materi`, `tipe_nilai`, `nilai`, `kelas_asrama`, `tahun_ajaran`, `semester`, `created_at`, `updated_at`) VALUES
(41, '167171', '16505020', 'ASA - 020', 'Materi Pokok', 'keterangan', 'Khatam', 'IV/Makna Cepat(Al-Sarii\')', '2019/2020', '2', '2020-04-15 23:42:51', '2020-04-15 07:00:39'),
(43, '151515', '16505020', 'ASA - 069', 'Sikap dan Perilaku', 'nilai', '95', 'I/Bacaan(Qira\'ah)', '2019/2020', '2', '2020-05-01 13:07:27', '2020-04-15 07:20:41'),
(44, '165151', '16505020', 'ASA - 075', 'Sikap dan Perilaku', 'nilai', '90', 'III/Makna Lambat(Al-Taanni)', '2019/2020', '2', '2020-04-15 23:44:02', '2020-04-15 07:21:14'),
(45, '151515', '16505020', 'ASA - 076', 'Kegiatan Ekstrakulikuler/Pengembangan Diri', 'Nilai', '90', 'I/Bacaan(Qira\'ah)', '2019/2020', '2', '2020-04-15 23:44:28', '2020-04-15 07:36:06'),
(46, '151515', '16505020', 'ASA - 077', 'Kegiatan Ekstrakulikuler/Pengembangan Diri', 'Nilai', '80', 'I/Bacaan(Qira\'ah)', '2019/2020', '2', '2020-04-15 23:44:34', '2020-04-15 08:26:56'),
(47, '151515', '16505020', 'ASA - 079', 'Catatan dan Saran Wali Kelas', 'Keterangan', 'Silahkan dan saran kepada siswa!', 'I/Bacaan(Qira\'ah)', '2019/2020', '2', '2020-04-16 02:36:16', '2020-04-15 08:27:33'),
(48, '155252', '16505020', 'ASA - 079', 'Catatan dan Saran Wali Kelas', 'Keterangan', 'Silahkan masukkan nama siswa dan berikan catatan dan saran kepada siswa!', 'II/Pegon(Kitabah)', '2019/2020', '2', '2020-04-15 23:44:46', '2020-04-15 08:27:58'),
(49, '165151', '16505020', 'ASA - 079', 'Catatan dan Saran Wali Kelas', 'Keterangan', 'Silahkan masukkan nama siswa dan berikan catatan dan saran kepada siswa!', 'III/Makna Lambat(Al-Taanni)', '2019/2020', '2', '2020-04-15 23:44:48', '2020-04-15 08:31:15'),
(51, '151515', '16505020', 'ASA - 002', 'Materi Pokok', 'Keterangan', 'Khatam', 'I/Bacaan(Qira\'ah)', '2019/2020', '2', '2020-05-01 21:40:30', '2020-04-15 16:33:09'),
(52, '155252', '16505020', 'ASA - 005', 'Materi Pokok', 'Keterangan', 'Khatam', 'II/Pegon(Kitabah)', '2019/2020', '2', '2020-05-01 21:40:44', '2020-04-15 16:36:24'),
(54, '155252', '16505020', 'ASA - 043', 'Pemahaman Konsep dan Praktikum', 'Nilai', '90', 'II/Pegon(Kitabah)', '2019/2020', '2', '2020-04-15 16:42:16', '2020-04-15 16:42:16'),
(55, '167171', '16505020', 'ASA - 079', 'Catatan dan Saran Wali Kelas', 'Keterangan', 'Silahkan masukkan nama siswa dan berikan catatan dan saran kepada siswa!', 'IV/Makna Cepat(Al-Sarii\')', '2019/2020', '2', '2020-04-15 16:45:27', '2020-04-15 16:45:27'),
(57, '151515', '16505020', 'ASA - 037', 'Pemahaman Konsep dan Praktikum', 'Nilai', '90', 'I/Bacaan(Qira\'ah)', '2019/2020', '2', '2020-04-19 20:14:19', '2020-04-19 20:14:19'),
(58, '192020', '16505020', 'ASA - 004', 'Materi Pokok', 'Keterangan', '90', 'I/Bacaan(Qira\'ah)', '2019/2020', '2', '2020-04-27 18:10:45', '2020-04-27 18:10:45'),
(59, '151515', '16505020', 'ASA - 078', 'Kegiatan Ekstrakulikuler/Pengembangan Diri', 'Nilai', '90', 'I/Bacaan(Qira\'ah)', '2019/2020', '2', '2020-04-27 18:20:56', '2020-04-27 18:20:56'),
(103, '151515', '16515020', 'ASA - 001', 'Materi Pokok', 'Keterangan', 'Khatam', 'I/Bacaan(Qira\'ah)', '2019/2020', '2', '2020-04-28 02:56:48', '2020-04-28 02:56:48'),
(104, '192020', '16505020', 'ASA - 067', 'Sikap dan Perilaku', 'Nilai', '90', 'I/Bacaan(Qira\'ah)', '2019/2020', '2', '2020-05-03 23:31:39', '2020-05-03 23:31:39');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_sekolahs`
--

CREATE TABLE `nilai_sekolahs` (
  `id` int(11) NOT NULL,
  `id_user_siswa` varchar(100) NOT NULL,
  `id_user_gurusekolah` varchar(100) NOT NULL,
  `id_mata_pelajaran` varchar(100) NOT NULL,
  `id_kategori` varchar(100) NOT NULL,
  `tipe_nilai` varchar(100) NOT NULL,
  `nilai` varchar(300) NOT NULL,
  `tahun_ajaran` varchar(100) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_sekolahs`
--

INSERT INTO `nilai_sekolahs` (`id`, `id_user_siswa`, `id_user_gurusekolah`, `id_mata_pelajaran`, `id_kategori`, `tipe_nilai`, `nilai`, `tahun_ajaran`, `semester`, `created_at`, `updated_at`) VALUES
(14, '151515', '16515020', 'SIA - 001', 'Sikap', 'Rasa Ingin Tau', '4', '2019/2020', '2', '2020-05-01 09:32:06', '2020-02-14 05:28:23'),
(15, '151515', '16515020', 'SIA - 001', 'Sikap', 'Teliti', '3', '2019/2020', '2', '2020-04-11 03:43:36', '2020-02-14 05:28:23'),
(16, '151515', '16515020', 'SIA - 001', 'Sikap', 'Disiplin', '1', '2019/2020', '2', '2020-04-11 06:07:35', '2020-02-14 05:28:23'),
(17, '151515', '16515020', 'SIA - 001', 'Sikap', 'Tanggung Jawab', '4', '2019/2020', '2', '2020-03-14 07:04:30', '2020-02-14 05:28:23'),
(18, '151515', '16515020', 'SIA - 001', 'Keterampilan', 'Sikap Berpendapat', '5', '2019/2020', '2', '2020-05-01 09:32:25', '2020-02-14 11:07:52'),
(19, '151515', '16515020', 'SIA - 001', 'Keterampilan', 'Presentasi', '4', '2019/2020', '2', '2020-04-22 05:27:01', '2020-02-14 11:07:52'),
(20, '151515', '16515020', 'SIA - 001', 'Keterampilan', 'Menghargai Pendapat', '4', '2019/2020', '2', '2020-04-22 05:27:03', '2020-02-14 11:07:52'),
(21, '151515', '16515020', 'SIA - 001', 'Keterampilan', 'Kebenaran Konsep', '4', '2019/2020', '2', '2020-04-22 05:27:05', '2020-02-14 11:07:52'),
(22, '151515', '16515020', 'SIA - 001', 'Keterampilan', 'Kerjasama', '4', '2019/2020', '2', '2020-04-22 05:27:08', '2020-02-14 11:07:52'),
(23, '151515', '16515020', 'SIA - 001', 'Keterampilan', 'Keaktifan', '4', '2019/2020', '2', '2020-04-22 05:27:10', '2020-02-14 11:07:52'),
(27, '155252', '16515020', 'SIA - 001', 'Pengetahuan', 'UAS', '98', '2019/2020', '2', '2020-03-14 07:04:30', '2020-03-08 10:08:33'),
(29, '155252', '16515020', 'SIA - 001', 'Sikap', 'Rasa Ingin Tau', '6', '2019/2020', '2', '2020-03-14 07:04:30', '2020-03-08 20:29:03'),
(30, '155252', '16515020', 'SIA - 001', 'Sikap', 'Teliti', '4', '2019/2020', '2', '2020-03-14 07:04:30', '2020-03-08 20:29:03'),
(31, '155252', '16515020', 'SIA - 001', 'Sikap', 'Disiplin', '7', '2019/2020', '2', '2020-03-14 07:04:30', '2020-03-08 20:29:03'),
(32, '155252', '16515020', 'SIA - 001', 'Sikap', 'Tanggung Jawab', '2', '2019/2020', '2', '2020-03-14 07:04:30', '2020-03-08 20:29:03'),
(34, '165151', '16515020', 'SIA - 001', 'Pengetahuan', 'Ulangan Harian', '90', '2019/2020', '2', '2020-03-14 07:04:30', '2020-03-11 06:24:24'),
(46, '167171', '16515020', 'SIA - 001', 'Pengetahuan', 'UTS', '75', '2019/2020', '2', '2020-04-07 23:00:54', '2020-04-07 23:00:54'),
(52, '167171', '16515020', 'SIA - 001', 'Pengetahuan', 'UAS', '70', '2019/2020', '2', '2020-04-08 01:26:36', '2020-04-08 01:26:36'),
(64, '151515', '16515020', 'SIA - 001', 'Pengetahuan', 'Ulangan Harian', '70', '2019/2020', '2', '2020-05-01 21:26:27', '2020-04-08 18:56:02'),
(81, '151515', '16515020', 'SIA - 001', 'Pengetahuan', 'Deskripsi', 'Peserta didik sangat mampu mempelajari dan memahami tentang materi bab ayat-ayat Al-quran', '2019/2020', '2', '2020-04-11 07:47:51', '2020-04-11 07:47:51'),
(82, '155252', '16515020', 'SIA - 001', 'Pengetahuan', 'Deskripsi', 'Silahkan isi deskripsi nilai! Deskripsi ini akan ditampilkan pada raport siswa sebagai bahan evaluasi :', '2019/2020', '2', '2020-04-11 21:10:21', '2020-04-11 21:10:21'),
(83, '167171', '16515020', 'SIA - 001', 'Pengetahuan', 'Deskripsi', 'Silahkan isi deskripsi nilai! Deskripsi ini akan ditampilkan pada raport siswa sebagai bahan evaluasi :', '2019/2020', '2', '2020-04-11 21:11:46', '2020-04-11 21:11:46'),
(84, '151515', '16515020', 'SIA - 001', 'Sikap', 'Deskripsi', 'Silahkan isi deskripsi nilai! Deskripsi ini akan ditampilkan pada raport siswa sebagai bahan evaluasi :', '2019/2020', '2', '2020-04-11 21:14:06', '2020-04-11 21:14:06'),
(85, '151515', '16515020', 'SIA - 001', 'Keterampilan', 'Deskripsi', 'Silahkan isi deskripsi nilai! Deskripsi ini akan ditampilkan pada raport siswa sebagai bahan evaluasi :', '2019/2020', '2', '2020-04-11 21:18:51', '2020-04-11 21:18:51'),
(86, '155252', '16515020', 'SIA - 001', 'Pengetahuan', 'UTS', '90', '2019/2020', '2', '2020-04-13 20:59:06', '2020-04-13 20:59:06'),
(87, '151515', '16515020', 'SIA - 001', 'Pengetahuan', 'UTS', '100', '2019/2020', '2', '2020-05-01 09:31:07', '2020-04-18 05:21:14'),
(89, '151515', '16515020', 'SIA - 003', 'Pengetahuan', 'Deskripsi', 'Peserta hari ini melakukan tugasnya dengan baik, dia sangat bagus dalam bahasa indonesia', '2019/2020', '2', '2020-04-11 07:47:51', '2020-04-11 07:47:51'),
(90, '155252', '16515020', 'SIA - 001', 'Pengetahuan', 'Ulangan Harian', '100', '2019/2020', '2', '2020-04-20 08:19:18', '2020-04-19 20:00:55'),
(93, '151515', '16515020', 'SIA - 001', 'Pengetahuan', 'Ulangan Harian', '90', '2019/2020', '2', '2020-04-27 01:31:54', '2020-04-08 18:56:02'),
(94, '151515', '18515020', 'SIA - 003', 'Pengetahuan', 'UTS', '90', '2019/2020', '2', '2020-04-18 05:21:14', '2020-04-18 05:21:14'),
(95, '151515', '18515020', 'SIA - 003', 'Pengetahuan', 'UAS', '50', '2019/2020', '2', '2020-04-18 05:21:14', '2020-04-18 05:21:14'),
(96, '151515', '18515020', 'SIA - 003', 'Pengetahuan', 'Ulangan Harian', '100', '2019/2020', '2', '2020-04-18 05:21:14', '2020-04-18 05:21:14'),
(97, '151515', '16515020', 'SIA - 001', 'Pengetahuan', 'UAS', '90', '2019/2020', '2', '2020-04-25 04:02:38', '2020-04-25 04:02:38'),
(127, '167171', '16515020', 'SIA - 001', 'Keterampilan', 'Sikap Berpendapat', '4', '2019/2020', '2', '2020-05-01 01:32:42', '2020-05-01 01:32:42'),
(128, '167171', '16515020', 'SIA - 001', 'Keterampilan', 'Presentasi', '4', '2019/2020', '2', '2020-05-01 01:32:42', '2020-05-01 01:32:42'),
(129, '167171', '16515020', 'SIA - 001', 'Keterampilan', 'Menghargai Pendapat', '4', '2019/2020', '2', '2020-05-01 01:32:42', '2020-05-01 01:32:42'),
(130, '167171', '16515020', 'SIA - 001', 'Keterampilan', 'Kebenaran Konsep', '4', '2019/2020', '2', '2020-05-01 01:32:42', '2020-05-01 01:32:42'),
(131, '167171', '16515020', 'SIA - 001', 'Keterampilan', 'Kerjasama', '4', '2019/2020', '2', '2020-05-01 01:32:42', '2020-05-01 01:32:42'),
(132, '167171', '16515020', 'SIA - 001', 'Keterampilan', 'Keaktifan', '4', '2019/2020', '2', '2020-05-01 01:32:42', '2020-05-01 01:32:42'),
(141, '167171', '16515020', 'SIA - 001', 'Sikap', 'Rasa Ingin Tau', '4', '2019/2020', '2', '2020-05-01 01:40:49', '2020-05-01 01:40:49'),
(142, '167171', '16515020', 'SIA - 001', 'Sikap', 'Teliti', '4', '2019/2020', '2', '2020-05-01 01:40:49', '2020-05-01 01:40:49'),
(143, '167171', '16515020', 'SIA - 001', 'Sikap', 'Disiplin', '4', '2019/2020', '2', '2020-05-01 01:40:49', '2020-05-01 01:40:49'),
(144, '167171', '16515020', 'SIA - 001', 'Sikap', 'Tanggung Jawab', '4', '2019/2020', '2', '2020-05-01 01:40:49', '2020-05-01 01:40:49'),
(145, '151515', '16515020', 'SIA - 001', 'Pengetahuan', 'Ulangan Harian', '100', '2019/2020', '2', '2020-05-01 01:44:43', '2020-05-01 01:44:43'),
(149, '167171', '16515020', 'SIA - 001', 'Pengetahuan', 'Ulangan Harian', '70.5', '2019/2020', '2', '2020-05-01 02:17:17', '2020-05-01 02:17:17'),
(151, '167171', '16515020', 'SIA - 001', 'Pengetahuan', 'Ulangan Harian', '90', '2019/2020', '2', '2020-05-01 15:00:24', '2020-05-01 15:00:24'),
(152, '165151', '16515021', 'SIA - 007', 'Pengetahuan', 'Ulangan Harian', '91', '2019/2020', '2', '2020-05-03 10:07:36', '2020-05-03 03:07:18'),
(153, '192020', '16515021', 'SIA - 007', 'Pengetahuan', 'Ulangan Harian', '90', '2019/2020', '2', '2020-05-03 03:07:21', '2020-05-03 03:07:21'),
(154, '151515', '16515020', 'SIA - 001', 'Pengetahuan', 'Ulangan Harian', '100', '2020/2021', '1', '2020-06-21 10:58:20', '2020-06-21 10:58:20'),
(155, '151515', '16515020', 'SIA - 001', 'Pengetahuan', 'UAS', '100', '2020/2021', '1', '2020-06-21 11:00:05', '2020-06-21 11:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `orangtua_memiliki_siswas`
--

CREATE TABLE `orangtua_memiliki_siswas` (
  `id_orangtua` varchar(100) NOT NULL,
  `id_siswa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orangtua_memiliki_siswas`
--

INSERT INTO `orangtua_memiliki_siswas` (`id_orangtua`, `id_siswa`) VALUES
('p151515', '151515'),
('p155252', '155252');

-- --------------------------------------------------------

--
-- Table structure for table `orang_tuas`
--

CREATE TABLE `orang_tuas` (
  `id_orangtua` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orang_tuas`
--

INSERT INTO `orang_tuas` (`id_orangtua`, `nama`) VALUES
('p151515', 'Irfan Prayudah'),
('p155252', 'Bruth Force'),
('p192020', 'Greenland');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sekolahs`
--

CREATE TABLE `sekolahs` (
  `id` int(11) NOT NULL,
  `tahun_ajaran` varchar(100) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'tidak aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sekolahs`
--

INSERT INTO `sekolahs` (`id`, `tahun_ajaran`, `semester`, `status`) VALUES
(1, '2019/2020', '2', 'tidak aktif'),
(2, '2019/2020', '1', 'tidak aktif'),
(3, '2020/2021', '1', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `siswas`
--

CREATE TABLE `siswas` (
  `id_user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_orangtua` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_siswa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_masuk` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswas`
--

INSERT INTO `siswas` (`id_user`, `id_orangtua`, `nama_siswa`, `tanggal_lahir`, `alamat`, `jenis_kelamin`, `tahun_masuk`, `created_at`, `updated_at`) VALUES
('151515', 'p151515', 'Faiz Fano FF', '2018-01-03', 'Jl. Locari', 'Laki - laki', '1', NULL, NULL),
('155252', '', 'Adit Fachril', '0000-00-00', '', '', '1', NULL, NULL),
('165151', '', 'Junki', '0000-00-00', '', '', '1', NULL, NULL),
('167171', '', 'Rahmat', '0000-00-00', '', '', '1', NULL, NULL),
('192020', 'p155252', 'Logitech', '02/20/1998', 'Jl. Locari', 'Laki - laki', '1', '2020-04-16 08:50:48', '2020-04-16 08:50:48');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_menghadiri_kegiatan_asramas`
--

CREATE TABLE `siswa_menghadiri_kegiatan_asramas` (
  `id` int(11) NOT NULL,
  `id_kegiatan` varchar(50) NOT NULL,
  `id_user_siswa` varchar(50) NOT NULL,
  `id_user_guruasrama` varchar(100) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa_menghadiri_kegiatan_asramas`
--

INSERT INTO `siswa_menghadiri_kegiatan_asramas` (`id`, `id_kegiatan`, `id_user_siswa`, `id_user_guruasrama`, `keterangan`, `updated_at`, `created_at`) VALUES
(29, '3', '151515', '16505020', 'Hadir', '2020-05-01 23:43:18', '2020-04-17 20:49:48'),
(30, '3', '155252', '16505020', 'Hadir', '2020-04-30 02:18:12', '2020-04-17 20:49:48'),
(31, '3', '192020', '16505020', 'Sakit', '2020-04-30 02:18:12', '2020-04-17 20:49:48'),
(32, '5', '151515', '16505020', 'Hadir', '2020-04-30 02:18:12', '2020-04-17 21:31:21'),
(33, '5', '155252', '16505020', 'Sakit', '2020-04-30 02:18:12', '2020-04-17 21:31:21'),
(34, '5', '192020', '16505020', 'Izin', '2020-04-30 02:18:12', '2020-04-17 21:31:21'),
(35, '6', '151515', '16505020', 'Alpha', '2020-04-30 02:18:12', '2020-04-17 21:51:52'),
(36, '6', '155252', '16505020', 'Hadir', '2020-04-30 02:18:12', '2020-04-17 21:51:52'),
(37, '6', '192020', '16505020', 'Hadir', '2020-04-30 02:18:12', '2020-04-17 21:51:52'),
(38, '1', '151515', '16505020', 'Hadir', '2020-04-30 02:18:12', '2020-04-19 00:05:14'),
(39, '1', '155252', '16505020', 'Hadir', '2020-04-30 02:18:12', '2020-04-19 00:05:14'),
(40, '1', '192020', '16505020', 'Hadir', '2020-04-30 02:18:12', '2020-04-19 00:05:14'),
(47, '2', '151515', '16505020', 'Hadir', '2020-04-30 02:18:12', '2020-04-19 00:08:37'),
(48, '2', '155252', '16505020', 'Hadir', '2020-04-30 02:18:12', '2020-04-19 00:08:37'),
(49, '2', '192020', '16505020', 'Hadir', '2020-04-30 02:18:12', '2020-04-19 00:08:37'),
(60, '4', '167171', '16505020', 'Alpha', '2020-04-30 02:18:12', '2020-04-19 01:18:15'),
(61, '4', '165151', '16505020', 'Hadir', '2020-04-30 02:18:12', '2020-04-19 01:18:15');

-- --------------------------------------------------------

--
-- Table structure for table `surat_sakits`
--

CREATE TABLE `surat_sakits` (
  `id` int(11) NOT NULL,
  `id_user_guruasrama` varchar(100) NOT NULL,
  `id_siswa` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_sakits`
--

INSERT INTO `surat_sakits` (`id`, `id_user_guruasrama`, `id_siswa`, `tanggal`, `keterangan`, `updated_at`, `created_at`) VALUES
(1, '16505020', '151515', '2020-03-20', 'Siswa sakit tipes', '2020-03-20 07:41:27', '2020-03-20 07:41:27'),
(2, '16505020', '155252', '2020-03-20', 'Keterangan', '2020-03-20 08:32:53', '2020-03-20 08:32:53'),
(3, '16505020', '165151', '2020-03-20', 'Keterangan', '2020-03-20 08:33:22', '2020-03-20 08:33:22'),
(4, '16505020', '167171', '2020-03-20', 'Siswa sedang pulang karena ada saudaranya yang sakit', '2020-03-20 09:39:58', '2020-03-20 09:39:58'),
(5, '16505020', '151515', '2020-04-05', 'Siswa sakit demam berbadarah', '2020-04-05 02:00:46', '2020-04-05 02:00:46'),
(6, '16505020', '151515', '2020-04-10', 'Siswa sakit tipes', '2020-04-10 03:21:20', '2020-04-10 03:21:20'),
(7, '16505020', '155252', '2020-04-10', 'Siswa sedang menjalani lomba', '2020-04-10 03:22:06', '2020-04-10 03:22:06'),
(8, '16505020', '151515', '2020-04-11', 'Siswa sakit panas tinggi', '2020-04-10 19:02:00', '2020-04-10 19:02:00'),
(9, '16505020', '155252', '2020-04-11', 'Siswa sedang sakit flu', '2020-04-10 19:02:26', '2020-04-10 19:02:26'),
(10, '16505020', '165151', '2020-04-11', 'Siswa sedang ada acara keluarga', '2020-04-10 19:03:17', '2020-04-10 19:03:17'),
(11, '16505020', '151515', '2020-04-20', 'Siswa sakit tipes', '2020-04-19 20:04:47', '2020-04-19 20:04:47'),
(12, '16505020', '151515', '2020-04-22', 'Siswa sakit demam berdarah', '2020-04-22 09:41:54', '2020-04-22 09:41:54'),
(13, '16505020', '165151', '2020-04-22', 'Siswa sedang menjalani pemulihan patah kaki', '2020-04-22 09:42:14', '2020-04-22 09:42:14'),
(14, '16505020', '155252', '2020-04-30', 'Siswa sakit tipes', '2020-04-29 19:59:41', '2020-04-29 19:59:41'),
(15, '16505020', '151515', '2020-05-01', 'Siswa sakit tipes', '2020-05-01 16:46:24', '2020-05-01 16:46:24'),
(16, '16505020', '151515', '2020-05-15', 'Siswa sakit tipes', '2020-05-15 00:18:25', '2020-05-15 00:18:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'siswa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `id_user`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Miftah Muhammad Farhan', '16515020', '$2y$10$fFfJrLimfQC5oMj1wSfxSOUN7.T1FGHvlwV2g5PKRUAlbP4NnCRDG', 'LPb7XAyHqj97B31IeGEnLKLexAnBgYSK8DTslcFyyWENe9lVGyqF6XqqpjOx', '2019-12-16 22:59:51', '2019-12-16 22:59:51', 'Guru Sekolah'),
(2, 'Faiz Fano FF', '151515', '$2y$10$mff8Ikx4DWInXNbnMgYcdOL0SMtymlPcPliBp7gpV1zQqhKoaXJUq', 'PK9vpIhX0EO2cZqyePgexYQpGTeHb3HItxx96Mt7iwk4XFN5oLH9QWBuq3Pg', '2020-02-03 20:57:00', '2020-02-03 20:57:00', 'Siswa'),
(3, 'Adit Fachril', '155252', '$2y$10$RsnVWSNjb5GzP9n12sdaHObNpVgfbJg7ydDclJ00rA1CEehYPSKUa', '3Py0eaqhyQL0IzY8FmJncfi5IbFsavS7PQJwlqc2l3pcGkXYcJMQuRcb0UgS', '2020-02-03 20:57:59', '2020-02-03 20:57:59', 'Siswa'),
(4, 'Sudirgo Anton', '16505020', '$2y$10$bxUi030bfTaQQ1KdXBngqOjcRva63Zn3Eq/PqhNwY8XQ5dBg91nm.', '964RRQHdS8JRxT7hp3cag0rutFDK29YeVAo0z0BDw2LSGAb78YTh73wmBPi1', '2020-02-17 20:15:03', '2020-02-17 20:15:03', 'Guru Asrama'),
(5, 'Irfan Prayudah', 'p151515', '$2y$10$a63Th5kdpBdYY9Effc6LcO1xPeB3AbNSjPaKAy2qmuPSTSTzYwFbS', NULL, '2020-03-18 21:32:42', '2020-03-18 21:32:42', 'Orang Tua'),
(8, 'Khomarudin', 'admin001', '$2y$10$Hqpaeccvy4ewu7MdKsb.quUpfygnu9kOn9UjBEnHLCc326kZn5PKO', NULL, '2020-04-16 03:24:59', '2020-04-16 03:24:59', 'Admin'),
(13, 'Logitech', '192020', '$2y$10$/73lkoxWMy2gsGB5jQAKheEKv69LVPSjZxdLEUcgNMrgvKT8tri3i', NULL, '2020-04-16 08:50:48', '2020-04-16 08:50:48', 'Siswa'),
(14, 'Kholif', 'admin002', '$2y$10$M2el4Km7OGRpNrlu7Q0FxuT72Q3KUCew.4KBdh/rN.FYcxfxtJJv2', NULL, '2020-04-16 20:47:37', '2020-04-16 20:47:37', 'Admin'),
(15, 'Greenland', 'p192020', '$2y$10$fxoQn/oNjMZ7.SG8CujrvuJMA3Ol439aGJmWUafcS/5908O4qn5gq', NULL, '2020-04-16 21:05:35', '2020-04-16 21:05:35', 'Orang Tua'),
(16, 'Canada', '16515021', '$2y$10$CvaE7IUpRhRK1rLz3BYf9elGvoyKmLo5b6Uq4WfjcpRrPJFPW81qO', NULL, '2020-04-17 04:40:38', '2020-04-17 04:40:38', 'Guru Sekolah'),
(17, 'Indra Sari', '17515020', '$2y$10$hPxNhDOEg03gvOZ0ZdYgsuINwAp49FJYLxs7c52T7Z/h5hpwpsWE6', NULL, '2020-04-17 05:58:13', '2020-04-17 05:58:13', 'Guru Asrama');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bobot_penilaians`
--
ALTER TABLE `bobot_penilaians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gedungs`
--
ALTER TABLE `gedungs`
  ADD PRIMARY KEY (`kode_gedung`);

--
-- Indexes for table `guru_asramas`
--
ALTER TABLE `guru_asramas`
  ADD PRIMARY KEY (`nik_guruasrama`);

--
-- Indexes for table `guru_mempunyai_jadwals`
--
ALTER TABLE `guru_mempunyai_jadwals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guru_sekolahs`
--
ALTER TABLE `guru_sekolahs`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `hari_presensi_sekolahs`
--
ALTER TABLE `hari_presensi_sekolahs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan_asramas`
--
ALTER TABLE `kegiatan_asramas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kode_kelas`);

--
-- Indexes for table `kelas_asramas`
--
ALTER TABLE `kelas_asramas`
  ADD PRIMARY KEY (`kode_kelas_asrama`);

--
-- Indexes for table `kritik_dan_sarans`
--
ALTER TABLE `kritik_dan_sarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kritik_dan_saran_siswas`
--
ALTER TABLE `kritik_dan_saran_siswas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  ADD PRIMARY KEY (`kode_mapel`);

--
-- Indexes for table `materi_asramas`
--
ALTER TABLE `materi_asramas`
  ADD PRIMARY KEY (`kode_materi`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_asramas`
--
ALTER TABLE `nilai_asramas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_sekolahs`
--
ALTER TABLE `nilai_sekolahs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orang_tuas`
--
ALTER TABLE `orang_tuas`
  ADD PRIMARY KEY (`id_orangtua`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `sekolahs`
--
ALTER TABLE `sekolahs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `siswa_menghadiri_kegiatan_asramas`
--
ALTER TABLE `siswa_menghadiri_kegiatan_asramas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_sakits`
--
ALTER TABLE `surat_sakits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bobot_penilaians`
--
ALTER TABLE `bobot_penilaians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gedungs`
--
ALTER TABLE `gedungs`
  MODIFY `kode_gedung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `guru_mempunyai_jadwals`
--
ALTER TABLE `guru_mempunyai_jadwals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `hari_presensi_sekolahs`
--
ALTER TABLE `hari_presensi_sekolahs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kegiatan_asramas`
--
ALTER TABLE `kegiatan_asramas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `kode_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas_asramas`
--
ALTER TABLE `kelas_asramas`
  MODIFY `kode_kelas_asrama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kritik_dan_sarans`
--
ALTER TABLE `kritik_dan_sarans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kritik_dan_saran_siswas`
--
ALTER TABLE `kritik_dan_saran_siswas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `nilai_asramas`
--
ALTER TABLE `nilai_asramas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `nilai_sekolahs`
--
ALTER TABLE `nilai_sekolahs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `sekolahs`
--
ALTER TABLE `sekolahs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `siswa_menghadiri_kegiatan_asramas`
--
ALTER TABLE `siswa_menghadiri_kegiatan_asramas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `surat_sakits`
--
ALTER TABLE `surat_sakits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
