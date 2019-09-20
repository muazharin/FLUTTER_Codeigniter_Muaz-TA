-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2019 at 03:14 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `muaz_ta`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_absen`
--

CREATE TABLE `tb_absen` (
  `id_absen` int(11) NOT NULL,
  `nim` varchar(9) NOT NULL,
  `nama_mhs` varchar(100) NOT NULL,
  `nama_mata_kuliah` varchar(100) NOT NULL,
  `kelas` varchar(12) NOT NULL,
  `per_satu` varchar(5) NOT NULL,
  `tgl_satu` datetime NOT NULL,
  `per_dua` varchar(5) NOT NULL,
  `tgl_dua` datetime NOT NULL,
  `per_tiga` varchar(5) NOT NULL,
  `tgl_tiga` datetime NOT NULL,
  `per_empat` varchar(5) NOT NULL,
  `tgl_empat` datetime NOT NULL,
  `per_lima` varchar(5) NOT NULL,
  `tgl_lima` datetime NOT NULL,
  `per_enam` varchar(5) NOT NULL,
  `tgl_enam` datetime NOT NULL,
  `per_tujuh` varchar(5) NOT NULL,
  `tgl_tujuh` datetime NOT NULL,
  `per_delapan` varchar(5) NOT NULL,
  `tgl_delapan` datetime NOT NULL,
  `per_sembilan` varchar(5) NOT NULL,
  `tgl_sembilan` datetime NOT NULL,
  `per_sepuluh` varchar(5) NOT NULL,
  `tgl_sepuluh` datetime NOT NULL,
  `per_sebelas` varchar(5) NOT NULL,
  `tgl_sebelas` datetime NOT NULL,
  `per_dua_belas` varchar(5) NOT NULL,
  `tgl_dua_belas` datetime NOT NULL,
  `per_tiga_belas` varchar(5) NOT NULL,
  `tgl_tiga_belas` datetime NOT NULL,
  `per_empat_belas` varchar(5) NOT NULL,
  `tgl_empat_belas` datetime NOT NULL,
  `per_lima_belas` varchar(5) NOT NULL,
  `tgl_lima_belas` datetime NOT NULL,
  `per_enam_belas` varchar(5) NOT NULL,
  `tgl_enam_belas` datetime NOT NULL,
  `persentase` varchar(5) NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_absen`
--

INSERT INTO `tb_absen` (`id_absen`, `nim`, `nama_mhs`, `nama_mata_kuliah`, `kelas`, `per_satu`, `tgl_satu`, `per_dua`, `tgl_dua`, `per_tiga`, `tgl_tiga`, `per_empat`, `tgl_empat`, `per_lima`, `tgl_lima`, `per_enam`, `tgl_enam`, `per_tujuh`, `tgl_tujuh`, `per_delapan`, `tgl_delapan`, `per_sembilan`, `tgl_sembilan`, `per_sepuluh`, `tgl_sepuluh`, `per_sebelas`, `tgl_sebelas`, `per_dua_belas`, `tgl_dua_belas`, `per_tiga_belas`, `tgl_tiga_belas`, `per_empat_belas`, `tgl_empat_belas`, `per_lima_belas`, `tgl_lima_belas`, `per_enam_belas`, `tgl_enam_belas`, `persentase`, `ket`) VALUES
(17, 'E1E115074', 'Muazharin Alfan', 'FISIKA', 'ganjil', 'h', '2019-09-19 22:30:26', 'h', '2019-09-19 22:31:50', 'h', '2019-09-20 00:08:00', 'h', '2019-09-20 00:10:33', 'h', '2019-09-20 00:10:43', 'h', '2019-09-20 00:10:50', 'h', '2019-09-20 00:10:57', 'h', '2019-09-20 00:11:04', 'h', '2019-09-20 00:11:14', 'h', '2019-09-20 00:11:24', 'h', '2019-09-20 00:11:35', 'h', '2019-09-20 00:11:45', 'h', '2019-09-20 00:11:59', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '13', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`, `foto`) VALUES
(2, 'muaz', 'e10adc3949ba59abbe56e057f20f883e', 'muaz1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_dosen`
--

CREATE TABLE `tb_dosen` (
  `id_dosen` int(11) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `minat_ajar` varchar(32) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_dosen`
--

INSERT INTO `tb_dosen` (`id_dosen`, `nip`, `nama`, `email`, `minat_ajar`, `foto`, `keterangan`) VALUES
(2, '', 'DR. La Ode Muh. Golok Jaya, S.T., M.T.', 'golok@gmail.com', 'Komputasi Cerdas dan Visualisasi', 'golok.jpg', 'Lektor'),
(3, '', 'Sutardi, S.Kom., M.T.', 'sutardi@gmail.com', 'Rekayasa Perangkat Lunak', 'sutardi.jpg', 'Ketua Jurusan Teknik Informatika'),
(4, '', 'Bambang Pramono, S.Si.,M.T.', 'bambangpramono09@gmail.com', 'Rekayasa Perangkat Lunak', 'bambang.jpg', 'Kepala Laboratorium Rekayasa Perangkat Lunak'),
(5, '', 'Isnawaty, S.Si., M.T.', 'isna.1711@gmail.com', 'Jaringan', 'isnawati.jpg', 'Asisten Ahli'),
(6, '', 'Statiswaty, S.T., M.MSI.', 'statiswaty@gmail.com', 'Rekayasa Perangkat Lunak', 'statiswaty.jpg', 'Asisten Ahli'),
(7, '', 'Ika Purwanti. Ningrum Purnama, S.Kom., M.Cs.', 'ika.purwanti.n@gmail.com', 'Komputasi Cerdas dan Visualisasi', 'ika_purwanti.jpg', 'Kepala Laboratorium Sistem Informasi dan Programming'),
(8, '', 'Muh. Yamin, S.T., M.Eng.', 'putra0683@gmail.com', 'Jaringan', 'yamin.jpg', 'Kepala Laboratorium Computer System and Networking'),
(9, '', 'L.M. Tajidun, S.T., M.Eng.', 'moeh_tajidun@yahoo.com', 'Rekayasa Perangkat Lunak', 'tajidun.jpg', 'Tenaga Pengajar'),
(10, '', 'Subardin, S.T., M.T.', 'mail.bardin@gmail.com', 'Jaringan', 'bardin.jpg', 'Asisten Ahli'),
(11, '', 'L. M. Fid Aksara, S.Kom., M. Kom.', 'fidaksara@gmail.com', 'Jaringan', 'fid.jpg', 'Tenaga Pengajar'),
(12, '', 'Rahmat Ramadhan, S.Si.,M.Cs', 'rahmat.ramadhan@uho.ac.id', 'Rekayasa Perangkat Lunak', 'rahmat.jpg', 'Tenaga Pengajar'),
(13, '', 'Natalis Ransi, S.Si., M.Cs.', 'natalis.ransi@gmail.com', 'Rekayasa Perangkat Lunak', 'natalis.jpg', 'Tenaga Pengajar'),
(14, '', 'Jumadil Nangi, S.Kom., M.T.', 'madilstmikh@yahoo.co.id', 'Rekayasa Perangkat Lunak', 'jumadil.jpg', 'Tenaga Pengajar'),
(15, '', 'Dr. Ir. H. Muhammad Ihsan Sarita, M.Kom.', 'ihsan@gmail.com', 'Komputasi Cerdas dan Visualisasi', 'ihsan.jpg', 'Lektor'),
(16, '', 'La Surimi, S.Si., M.Cs.', 'surimi@gmail.com', 'Jaringan', 'surimi.jpg', 'Tenaga Pengajar'),
(17, '', 'Rizal Adi Saputra, S.T., M.Kom.', 'rizaladisaputraa@gmail.com', 'Komputasi Cerdas dan Visualisasi', 'rizal.jpg', 'Tenaga Pengajar'),
(18, '', 'La Ode Muhammad Bahtiar Aksara, S.T., M.T.', 'bahtiar@gmail.com', 'Komputasi Cerdas dan Visualisasi', 'bahtiar.jpg', 'Tenaga Pengajar'),
(19, '', 'Adha Mashur Sajiah, S.T., M.Eng.', 'adha.m.sajiah@gmail.com', 'Komputasi Cerdas dan Visualisasi', 'adha.jpg', 'Tenaga Pengajar');

-- --------------------------------------------------------

--
-- Table structure for table `tb_list_mk`
--

CREATE TABLE `tb_list_mk` (
  `id_list_mk` int(11) NOT NULL,
  `nama_mata_kuliah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_list_mk`
--

INSERT INTO `tb_list_mk` (`id_list_mk`, `nama_mata_kuliah`) VALUES
(1, 'PRAKTIKUM APLIKASI KOMPUTER'),
(2, 'KALKULUS I'),
(3, 'MATEMATIKA DISKRIT'),
(4, 'ALGORITMA DAN PEMROGRAMAN'),
(5, 'FISIKA'),
(6, 'PEMROGRAMAN WEB'),
(7, 'SISTEM INFORMASI'),
(8, 'SISTEM BASIS DATA LANJUT'),
(9, 'INTERAKSI MANUSIA DAN KOMPUTER'),
(10, 'PROBABILITAS DAN STATISTIKA'),
(11, 'SISTEM BERKAS'),
(12, 'PRAKTIKUM PEMROGRAMAN WEB'),
(13, 'ORGANISASI DAN ARSITEKTUR KOMPUTER'),
(14, 'KOMUNIKASI DATA'),
(19, 'METODE RISET'),
(20, 'SISTEM DIGITAL'),
(22, 'ALJABAR LINEAR'),
(23, 'KALKULUS 2'),
(24, 'SISTEM BASIS DATA'),
(25, 'SISTEM OPERASI'),
(27, 'PEMROGRAMAN DASAR'),
(28, 'PRAKTIKUM JARINGAN KOMPUTER 1'),
(29, 'JARINGAN KOMPUTER'),
(30, 'REKAYASA PERANGKAT LUNAK'),
(31, 'ANALISIS DAN PERANCANGAN SISTEM'),
(32, 'METODE NUMERIK'),
(35, 'KECERDASAN BUATAN'),
(36, 'STRUKTUR DATA'),
(37, 'PRAKTIKUM STRUKTUR DATA'),
(38, 'TEORI GRAF DAN AUTOMATA'),
(40, 'PRAKTIKUM KECERDASAN BUATAN');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mata_kuliah_peminatan`
--

CREATE TABLE `tb_mata_kuliah_peminatan` (
  `id_mata_kuliah_peminatan` int(11) NOT NULL,
  `kode_mata_kuliah` varchar(100) NOT NULL,
  `nama_mata_kuliah` varchar(100) NOT NULL,
  `dosen_satu` varchar(100) NOT NULL,
  `dosen_dua` varchar(100) NOT NULL,
  `hari` varchar(6) NOT NULL,
  `mulai` time NOT NULL,
  `selesai` time NOT NULL,
  `ruang` varchar(100) NOT NULL,
  `kelas` varchar(6) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_mata_kuliah_pengantar`
--

CREATE TABLE `tb_mata_kuliah_pengantar` (
  `id_mata_kuliah_pengantar` int(11) NOT NULL,
  `kode_mata_kuliah` varchar(100) NOT NULL,
  `nama_mata_kuliah` varchar(100) NOT NULL,
  `dosen_satu` varchar(100) NOT NULL,
  `dosen_dua` varchar(100) NOT NULL,
  `hari` varchar(6) NOT NULL,
  `mulai` varchar(15) NOT NULL,
  `selesai` varchar(15) NOT NULL,
  `ruang` varchar(100) NOT NULL,
  `kelas` varchar(12) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mata_kuliah_pengantar`
--

INSERT INTO `tb_mata_kuliah_pengantar` (`id_mata_kuliah_pengantar`, `kode_mata_kuliah`, `nama_mata_kuliah`, `dosen_satu`, `dosen_dua`, `hari`, `mulai`, `selesai`, `ruang`, `kelas`, `semester`) VALUES
(1, 'TIF61019', 'PRAKTIKUM APLIKASI KOMPUTER', 'JUMADIL NANGI, S.Kom, MT', '', 'Senin', '10:01', '10:50', 'LAB. SI & PROGRAMMING', 'genap', 1),
(2, 'TIF61014', 'KALKULUS I', 'NATALIS RANSI, ,', '', 'Senin', '13:01', '15:30', 'IT-3', 'genap', 1),
(3, 'TIF61015', 'MATEMATIKA DISKRIT', 'LA SURIMI, S.Si, M.Cs', '', 'Selesa', '9:30', '12:00', 'IT-2', 'genap', 1),
(4, 'TIF61011', 'ALGORITMA DAN PEMROGRAMAN', 'MT SUTARDI, S.Kom., MT', '', 'Rabu', '7:31', '10:00', 'IT-1', 'genap', 1),
(5, 'TIF61017', 'FISIKA', 'ISNAWATY, S.Si, MT', '', 'Rabu', '9:31', '11:00', 'IT-2', 'ganjil', 1),
(6, 'TIF61019', 'PRAKTIKUM APLIKASI KOMPUTER', 'JUMADIL NANGI, S.Kom, MT', '', 'Rabu', '11:11', '12:00', 'LAB. SI & PROGRAMMING', 'ganjil', 1),
(7, 'TIF61011', 'ALGORITMA DAN PEMROGRAMAN', 'MT SUTARDI, S.Kom., MT', '', 'Kamis', '7:30', '10:50', 'IT-1', 'ganjil', 1),
(8, 'TIF61017', 'FISIKA', 'ISNAWATY, S.Si, MT', '', 'Kamis', '10:01', '11:40', 'IT-2', 'genap', 1),
(9, 'TIF61014', 'KALKULUS I', 'NATALIS RANSI, ,', '', 'Jumat', '7:30', '10:00', 'IT-1', 'ganjil', 1),
(10, 'TIF61015', 'MATEMATIKA DISKRIT', 'LA SURIMI, S.Si, M.Cs', '', 'Jumat', '13:01', '15:30', 'IT-3', 'ganjil', 1),
(11, 'TIF63027', 'PEMROGRAMAN WEB', 'BAMBANG PRAMONO, S.Si, MT', '', 'Senin', '7:31', '9:10', 'IT-2', 'ganjil', 3),
(12, 'TIF63029', 'SISTEM INFORMASI', 'STATISWATY, ST, MMSI', '', 'Senin', '9:31', '12:00', 'IT-3', 'ganjil', 3),
(13, 'TIF63030', 'SISTEM BASIS DATA LANJUT', 'MT SUTARDI, S.Kom., MT', '', 'Senin', '13:01', '14:40', 'LAB. SI & PROGRAMMING', 'genap', 3),
(14, 'TIF63041', 'INTERAKSI MANUSIA DAN KOMPUTER', 'IKA PURWANTI NINGRUM, S.Kom, M.Cs', '', 'Senin', '13:01', '15:30', 'LAB. MULTIMEDIA', 'ganjil', 3),
(15, 'TIF63033', 'PROBABILITAS DAN STATISTIKA', 'NATALIS RANSI, ,', '', 'Selesa', '7:31', '9:10', 'IT-2', 'ganjil', 3),
(16, 'TIF63031', 'SISTEM BERKAS', 'MUH. IHSAN SARITA, Ir., M.Kom Dr.', '', 'Selesa', '10:01', '12:30', 'IT-3', 'genap', 3),
(17, 'TIF63028', 'PRAKTIKUM PEMROGRAMAN WEB', 'BAMBANG PRAMONO, S.Si, MT', '', 'Selesa', '10:01', '10:50', 'LAB. RPL', 'ganjil', 3),
(18, 'TIF63032', 'ORGANISASI DAN ARSITEKTUR KOMPUTER', 'MUH. IHSAN SARITA, Ir., M.Kom Dr.', '', 'Selesa', '13:01', '15:30', 'LAB. MULTIMEDIA', 'genap', 3),
(19, 'TIF63038', 'KOMUNIKASI DATA', 'LM. FID AKSARA, S.KOM, M.KOM', '', 'Rabu', '7:30', '9:10', 'IT-2', 'genap', 3),
(20, 'TIF63027', 'PEMROGRAMAN WEB', 'BAMBANG PRAMONO, S.Si, MT', '', 'Rabu', '10:01', '11:40', 'IT-3', 'genap', 3),
(21, 'TIF63029', 'SISTEM INFORMASI', 'STATISWATY, ST, MMSI', '', 'Rabu', '13:01', '15:30', 'IT-1', 'genap', 3),
(22, 'TIF63032', 'ORGANISASI DAN ARSITEKTUR KOMPUTER', 'MUH. IHSAN SARITA, Ir., M.Kom Dr.', '', 'Kamis', '7:30', '10:00', 'IT-2', 'ganjil', 3),
(23, 'TIF63028', 'PRAKTIKUM PEMROGRAMAN WEB', 'BAMBANG PRAMONO, S.Si, MT', '', 'Kamis', '10:01', '10:50', 'LAB. RPL', 'genap', 3),
(24, 'TIF63030', 'SISTEM BASIS DATA LANJUT', 'MT SUTARDI, S.Kom., MT', '', 'Kamis', '10:01', '11:40', 'IT-3', 'ganjil', 3),
(25, 'TIF63041', 'INTERAKSI MANUSIA DAN KOMPUTER', 'IKA PURWANTI NINGRUM, S.Kom, M.Cs', '', 'Kamis', '13:01', '15:30', 'IT-2', 'genap', 3),
(26, 'TIF63038', 'KOMUNIKASI DATA', 'LM. FID AKSARA, S.KOM, M.KOM', '', 'Jumat', '10:01', '11:40', 'IT-3', 'ganjil', 3),
(27, 'TIF63033', 'PROBABILITAS DAN STATISTIKA', 'NATALIS RANSI, ,', '', 'Jumat', '10:01', '11:40', 'IT-2', 'genap', 3),
(28, 'TIF63031', 'SISTEM BERKAS', 'MUH. IHSAN SARITA, Ir., M.Kom Dr.', '', 'Jumat', '13:01', '15:30', 'IT-2', 'ganjil', 3),
(29, 'TIF62053', 'METODE RISET', 'LAODE M. GOLOK JAYA, Dr., ST, MT., M.T. Dr', '', 'Senin', '07:31', '09:10', 'IT-3', 'ganjil/genap', 2),
(30, 'TIF62025', 'SISTEM DIGITAL', 'ISNAWATY, S.Si, MT', '', 'Senin', '13:01', '15:30', 'IT-1', 'ganjil', 2),
(31, 'TIF62021', 'PRAKTIKUM PEMROGRAMAN DASAR', 'BAMBANG PRAMONO, S.Si, MT', '', 'Senin', '15:30', '17:00', 'LAB. RPL', 'ganjil', 2),
(32, 'TIF62023', 'ALJABAR LINEAR', 'NATALIS RANSI, ,', '', 'Selasa', '10:01', '11:40', 'IT-1', 'ganjil', 2),
(33, 'TIF62022', 'KALKULUS 2', 'JUMADIL NANGI, S.Kom, MT', '', 'Rabu', '7:30', '9:10', 'IT-1', 'ganjil', 2),
(34, 'TIF62024', 'SISTEM BASIS DATA', 'STATISWATY, ST, MMSI', '', 'Kamis', '7:31', '10:00', 'IT-1', 'ganjil', 2),
(35, 'TIF62026', 'SISTEM OPERASI', 'NATALIS RANSI, S.Si., M.Cs.', '', 'Kamis', '10:01', '11:40', 'IT-1', 'ganjil', 2),
(36, 'TIF62053', 'METODE RISET', 'MUH. IHSAN SARITA, Ir., M.Kom Dr.', '', 'Kamis', '13:01', '14:40', 'IT-2', 'genap', 2),
(37, 'TIF62020', 'PEMROGRAMAN DASAR', 'BAMBANG PRAMONO, S.Si, MT', '', 'Kamis', '15:01', '17:40', 'IT-1', 'ganjil', 2),
(38, 'TIF6416', 'PRAKTIKUM JARINGAN KOMPUTER 1', 'MUH.YAMIN, ST., M.Eng,', '', 'Senin', '7:31', '8:40', 'LAB. MULTIMEDIA', 'ganjil', 4),
(39, 'TIF6416', 'PRAKTIKUM JARINGAN KOMPUTER 1', 'MUH.YAMIN, ST., M.Eng,', '', 'Senin', '8:31', '9:20', 'LAB. SI & PROGRAMMING', 'genap', 4),
(40, 'TIF6437', 'JARINGAN KOMPUTER', 'MUH.YAMIN, ST., M.Eng,', '', 'Senin', '10:01', '11:40', 'LAB. MULTIMEDIA', 'ganjil', 4),
(41, 'TIF6440', 'REKAYASA PERANGKAT LUNAK', 'BAMBANG PRAMONO, S.Si, MT', '', 'Senin', '13:01', '15:30', 'IT-2', 'genap', 4),
(42, 'TIF6439', 'ANALISIS DAN PERANCANGAN SISTEM', 'STATISWATY, ST, MMSI', '', 'Selasa', '7:31', '10:00', 'IT-3', 'ganjil', 4),
(43, 'TIF6434', 'METODE NUMERIK', 'JUMADIL NANGI, S.Kom, MT', '', 'Selasa', '7:31', '9:10', 'IT-2', 'genap', 4),
(44, 'TIF6440', 'REKAYASA PERANGKAT LUNAK', 'BAMBANG PRAMONO, S.Si, MT', '', 'Selasa', '10:01', '12:30', 'IT-2', 'ganjil', 4),
(45, 'TIF64045', 'KECERDASAN BUATAN', 'IKA PURWANTI NINGRUM, S.Kom, M.Cs', '', 'Selasa', '10:01', '11:40', 'IT-3', 'genap', 4),
(46, 'TIF64045', 'KECERDASAN BUATAN', 'IKA PURWANTI NINGRUM, S.Kom, M.Cs', '', 'Selasa', '13:01', '15:30', 'IT-3', 'ganjil', 4),
(47, 'TIF6435', 'STRUKTUR DATA', 'BAMBANG PRAMONO, S.Si, MT', '', 'Rabu', '7:30', '10:00', 'IT-2', 'genap', 4),
(48, 'TIF6436', 'PRAKTIKUM STRUKTUR DATA', 'BAMBANG PRAMONO, S.Si, MT', '', 'Rabu', '10:01', '10:50', 'LAB. RPL', 'ganjil', 4),
(49, 'TIF6439', 'ANALISIS DAN PERANCANGAN SISTEM', 'STATISWATY, ST, MMSI', '', 'Rabu', '10:01', '12:30', 'IT-2', 'genap', 4),
(50, 'TIF6435', 'STRUKTUR DATA', 'BAMBANG PRAMONO, S.Si, MT', '', 'Rabu', '10:01', '12:30', 'IT-1', 'ganjil', 4),
(51, 'TIF64046', 'TEORI GRAF DAN AUTOMATA', 'STATISWATY, ST, MMSI', '', 'Rabu', '13:01', '14:40', 'IT-1', 'genap', 4),
(52, 'TIF6434', 'METODE NUMERIK', 'JUMADIL NANGI, S.Kom, MT', '', 'Rabu', '15:01', '16:40', 'IT-2', 'ganjil', 4),
(53, 'TIF64013', 'PRAKTIKUM KECERDASAN BUATAN', 'IKA PURWANTI NINGRUM, S.Kom, M.Cs', '', 'Kamis', '10:01', '11:40', 'LAB. SI & PROGRAMMING', 'ganjil', 4),
(54, 'TIF6437', 'JARINGAN KOMPUTER', 'MUH.YAMIN, ST., M.Eng,', '', 'Kamis', '10:01', '11:40', 'LAB. MULTIMEDIA', 'genap', 4),
(55, 'TIF64046', 'TEORI GRAF DAN AUTOMATA', 'TEORI GRAF DAN AUTOMATA', '', 'Kamis', '13:01', '14:40', 'LAB. RPL', 'ganjil', 4),
(57, 'TIF64013', 'PRAKTIKUM KECERDASAN BUATAN', 'IKA PURWANTI NINGRUM, S.Kom, M.Cs', '', 'Kamis', '13:01', '14:40', 'LAB. SI & PROGRAMMING', 'genap', 4),
(58, 'TIF64013', 'PRAKTIKUM KECERDASAN BUATAN', 'IKA PURWANTI NINGRUM, S.Kom, M.Cs', '', 'Jumat', '14:00', '16:00', 'LAB. RPL', 'ganjil/genap', 4),
(59, 'TIF64046', 'TEORI GRAF DAN AUTOMATA', 'STATISWATY, ST, MMSI', '', 'Jumat', '14:00', '16:00', 'LAB. RPL', 'ganjil/genap', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_mhs`
--

CREATE TABLE `tb_mhs` (
  `id_mhs` int(11) NOT NULL,
  `nim` varchar(9) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tmpt_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `foto` varchar(200) NOT NULL,
  `kode_unik` varchar(100) NOT NULL,
  `qr_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mhs`
--

INSERT INTO `tb_mhs` (`id_mhs`, `nim`, `nama`, `tmpt_lahir`, `tgl_lahir`, `foto`, `kode_unik`, `qr_code`) VALUES
(2, 'E1E115074', 'Muazharin Alfan', 'Raha', '1996-11-07', 'IMG-20190625-WA0020.jpg', 'E1E11996-11-0715074Raha', 'E1E115074.png'),
(3, 'E1E116050', 'Ade Sitti Nur Zainab', 'Kendari', '1998-12-28', 'E1E116050.jpg', 'E1E11998-12-2816050Kendari', 'E1E116050.png'),
(4, 'E1E115083', 'Nur Aulliyah', 'Raha', '1997-08-17', 'nur.jpeg', 'E1E11997-08-1715083Raha', 'E1E115083.png'),
(5, 'E1E117029', 'Elko Dedy Pratama', 'Bau-bau', '1999-12-20', 'E1E117029.jpeg', 'E1E11999-12-2017029Bau-bau', 'E1E117029.png'),
(6, 'E1E117010', 'ICE SETIYAWATI', 'WALAMBENOWITE', '2000-02-22', 'E1E117010.jpg', 'E1E12000-02-2217010WALAMBENOWITE', 'E1E117010.png'),
(7, 'E1E116031', 'Safril', 'kapu', '1998-08-02', 'E1E116031.jpg', 'E1E11998-08-0216031kapu', 'E1E116031.png'),
(8, 'E1E117034', 'Kurniah Patrudin', 'Kendari', '1999-03-04', 'uni.jpg', 'E1E11999-03-0417034Kendari', 'E1E117034.png'),
(9, 'E1E117017', 'Milawati', 'Palangga', '1999-12-20', 'E1E117017.jpg', 'E1E11999-12-2017017Palangga', 'E1E117017.png'),
(10, 'E1E117033', 'Jekson Viktory Purba', 'Haranggaol', '2000-03-20', 'E1E117033.jpg', 'E1E12000-03-2017033Haranggaol', 'E1E117033.png'),
(11, 'E1E117032', 'Ismiranty Hamsar', 'Manado', '1999-11-06', 'E1E117032.jpg', 'E1E11999-11-0617032Manado', 'E1E117032.png'),
(12, 'E1E117064', 'Anggi Jolanda Limbong', 'Kendari', '2000-07-28', 'E1E117064.JPG', 'E1E12000-07-2817064Kendari', 'E1E117064.png'),
(13, 'E1E117035', 'Lan Lan Normawan', 'Wasolangka', '1999-09-09', 'E1E117035.jpg', 'E1E11999-09-0917035Wasolangka', 'E1E117035.png'),
(14, 'E1E116083', 'Muhamad Ade Ichsan Hasibuan', 'Tangerang', '1998-05-03', 'E1E116083.jpg', 'E1E11998-05-0316083Tangerang', 'E1E116083.png'),
(15, 'E1E118002', 'SITTI AISYAH', 'Kendari', '2001-03-07', 'E1E118002.jpg', 'E1E12001-03-0718002Kendari', 'E1E118002.png'),
(16, 'E1E118020', 'Dimas Eka Putra', 'Manado', '2000-03-14', 'E1E118020.jpg', 'E1E12000-03-1418020Manado', 'E1E118020.png'),
(17, 'E1E118050', 'MUHAMMAD SYUKUR ANGGAWUNA', 'Kendari', '2000-09-10', 'E1E118050.jpg', 'E1E12000-09-1018050Kendari', 'E1E118050.png'),
(18, 'E1E118017', 'Asdar', 'Lembah subur', '2000-06-10', 'E1E118017.jpg', 'E1E12000-06-1018017Lembah subur', 'E1E118017.png'),
(19, 'E1E118012', 'Muhammad Ijlal Prayoga', 'Kendari', '2000-08-19', 'E1E118012.jpg', 'E1E12000-08-1918012Kendari', 'E1E118012.png'),
(20, 'E1e117040', 'Muhammad danil', 'Anggalomelai', '2000-01-29', 'E1e117040.jpg', 'E1E12000-01-2917040Anggalomelai', 'E1e117040.png'),
(21, 'E1E117018', 'Muhammad Fadel', 'Makassar', '1999-09-01', 'E1E117018.jpg', 'E1E11999-09-0117018Makassar', 'E1E117018.png'),
(22, 'E1E117043', 'Muhammad Iqbal Tahir', 'Unaaha', '1999-08-17', 'E1E117043.png', 'E1E11999-08-1717043Unaaha', 'E1E117043.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_persentase`
--

CREATE TABLE `tb_persentase` (
  `id_persentase` int(11) NOT NULL,
  `nim` varchar(9) NOT NULL,
  `nama_mata_kuliah` varchar(100) NOT NULL,
  `pertemuan` varchar(100) NOT NULL,
  `kehadiran` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_persentase`
--

INSERT INTO `tb_persentase` (`id_persentase`, `nim`, `nama_mata_kuliah`, `pertemuan`, `kehadiran`) VALUES
(11, 'E1E115074', '', '', ''),
(12, 'E1E115074', 'FISIKA', 'satu', 'h'),
(13, 'E1E115074', 'FISIKA', 'dua', 'h'),
(14, 'E1E115074', 'FISIKA', 'tiga', 'h'),
(15, 'E1E115074', 'FISIKA', 'empat', 'h'),
(16, 'E1E115074', 'FISIKA', 'lima', 'h'),
(17, 'E1E115074', 'FISIKA', 'enam', 'h'),
(18, 'E1E115074', 'FISIKA', 'tujuh', 'h'),
(19, 'E1E115074', 'FISIKA', 'delapan', 'h'),
(20, 'E1E115074', 'FISIKA', 'sembilan', 'h'),
(21, 'E1E115074', 'FISIKA', 'sepuluh', 'h'),
(22, 'E1E115074', 'FISIKA', 'sebelas', 'h'),
(23, 'E1E115074', 'FISIKA', 'dua_belas', 'h'),
(24, 'E1E115074', 'FISIKA', 'tiga_belas', 'h');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_absen`
--
ALTER TABLE `tb_absen`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_dosen`
--
ALTER TABLE `tb_dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indexes for table `tb_list_mk`
--
ALTER TABLE `tb_list_mk`
  ADD PRIMARY KEY (`id_list_mk`);

--
-- Indexes for table `tb_mata_kuliah_pengantar`
--
ALTER TABLE `tb_mata_kuliah_pengantar`
  ADD PRIMARY KEY (`id_mata_kuliah_pengantar`);

--
-- Indexes for table `tb_mhs`
--
ALTER TABLE `tb_mhs`
  ADD PRIMARY KEY (`id_mhs`);

--
-- Indexes for table `tb_persentase`
--
ALTER TABLE `tb_persentase`
  ADD PRIMARY KEY (`id_persentase`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absen`
--
ALTER TABLE `tb_absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_dosen`
--
ALTER TABLE `tb_dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_list_mk`
--
ALTER TABLE `tb_list_mk`
  MODIFY `id_list_mk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tb_mata_kuliah_pengantar`
--
ALTER TABLE `tb_mata_kuliah_pengantar`
  MODIFY `id_mata_kuliah_pengantar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tb_mhs`
--
ALTER TABLE `tb_mhs`
  MODIFY `id_mhs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_persentase`
--
ALTER TABLE `tb_persentase`
  MODIFY `id_persentase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
