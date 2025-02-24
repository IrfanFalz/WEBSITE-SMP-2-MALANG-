-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2025 at 10:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website_sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$2YEccPyCJiZ6pqcr9etBbekvaJP5SOw6a1cUBNw0hd65it7AY2jce');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `deskripsi`, `gambar`, `tanggal`) VALUES
(13, 'Penerimaan Peserta Didik Baru', 'SMPN 2 Malang menerima peserta didik baru, dan pendaftaran terdapat 3 tahap :\r\n\r\n1. jalur afirmasi, kepindahan ortu & prestasi lomba (24 juni 2024 - 26 juni 2024)\r\n2. jalur prestasi nilai rapor (5 juli - 6 juli 2024)\r\n3. jalur zonasi (12 juli - 13 juli 2024)', '673bf1bfeba73.png', '2024-06-16'),
(14, 'DEMPO CUP XVIII 2023', 'Tim Dewan Galang SMPN 2 Malang berhasil membawa 2 piala pada acara Dempo Cup XVIII 2023, dan mendapat juara sebagai Pinru terbaik pada tanggal 17 Oktober 2023', '673bf1f3f2dba.png', '2023-10-17'),
(15, 'PURNAWIYATA SISWA KELAS 9 Tahun Pelajaran 2023/2024 SMP NEGERI 2 MALANG', 'Purnawiyata kelas 9 SMPN 2 Malang  Tapel 2023 – 2024 sukses diselenggarakan pada hari Minggu 10 Juni 2024 di Ascent Premiere Hotel and Convention, Kota Malang. Acara yang dimulai pada pukul 07.00 WIB ini mengambil tema  visi SMPN 2 Malang “Unggul Imtaq dan Iptek, berkarakter Pancasila, serta Peduli dan Berbudaya Lingkungan.', '673bf26c37231.png', '2024-06-10'),
(17, 'SMPN 2 Malang Penandatanganan deklarasi anti kekerasan', 'SMPN 2 Malang melakukan penandatangan deklarasi anti kekerasan \r\nyang dilakukan oleh kepala sekolah,  guru, walikota, dan perwakilan siswa pada tanggal 12 Juni 2024 ', '673bf2dfaf961.png', '2024-06-03'),
(18, 'Kemah Blok kelas IX Tahun Pelajaran 2023-2024', 'SMPN 2 Malang  kelas IX melakukan Kemah blok selama 2 hari 1 malam tapel 2023-2024 sebagai syarat nilai pramuka kelas IX', '673bf307896db.png', '2023-10-21'),
(24, 'Pj. Wali Kota Malang Optimis SIMBA ASIA Masuk 5 Besar PKRI', 'Dukungan penuh diutarakan oleh Penjabat (Pj.) Wali Kota Malang Dr. Ir. Wahyu Hidayat, MM atas beragam inovasi yang dikembangkan sekolah dalam memfasilitasi siswa istimewa untuk dapat mengenyam pendidikan setara, seperti salah satunya SIMBA ASIA.', '673e1566d1f2f.png', '2024-07-23');

-- --------------------------------------------------------

--
-- Table structure for table `masukan`
--

CREATE TABLE `masukan` (
  `id_masukan` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `masukan`
--

INSERT INTO `masukan` (`id_masukan`, `nama`, `email`, `pesan`) VALUES
(14, 'King Gojo', 'gojo@gmail.com', 'yowaimo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masukan`
--
ALTER TABLE `masukan`
  ADD PRIMARY KEY (`id_masukan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `masukan`
--
ALTER TABLE `masukan`
  MODIFY `id_masukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
