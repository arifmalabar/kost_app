-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Agu 2024 pada 08.46
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_kost`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_biodata_penghuni`
--

CREATE TABLE `tb_biodata_penghuni` (
  `NIK` char(255) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `harga` int(20) NOT NULL,
  `no_telp` varchar(200) NOT NULL,
  `tanggal_bergabung` date NOT NULL DEFAULT current_timestamp(),
  `nama_wali` varchar(200) NOT NULL,
  `nama_kampus_kantor` varchar(200) NOT NULL,
  `alamat_kampus_kantor` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `alamat` text NOT NULL,
  `kode_kamar` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_biodata_penghuni`
--

INSERT INTO `tb_biodata_penghuni` (`NIK`, `nama`, `email`, `harga`, `no_telp`, `tanggal_bergabung`, `nama_wali`, `nama_kampus_kantor`, `alamat_kampus_kantor`, `status`, `alamat`, `kode_kamar`) VALUES
('3507240811020002', 'Dimas Rizky P', 'dimas@gmail.com', 350000, '083192962102', '2023-08-01', 'rico', 'ITN 2', 'Tasikmadu', 1, 'Singosari', 'K001'),
('3507240818230002', 'Bahrul Ilmi', 'bahrul@gmail.com', 350000, '083192962102', '2023-08-01', 'rico', 'ITN 2', 'Tasikmadu', 1, 'Singosari', 'K001'),
('3507241212020002', 'Ridho Arif Wicaksono', 'ridhoarif40@gmail.com', 500000, '083192962102', '2023-08-01', 'rico', 'ITN 2', 'Tasikmadu', 1, 'Singosari', 'K001');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_biodata_penghuni`
--
ALTER TABLE `tb_biodata_penghuni`
  ADD PRIMARY KEY (`NIK`),
  ADD KEY `kode_kamar` (`kode_kamar`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_biodata_penghuni`
--
ALTER TABLE `tb_biodata_penghuni`
  ADD CONSTRAINT `tb_biodata_penghuni_ibfk_1` FOREIGN KEY (`kode_kamar`) REFERENCES `tb_kamar` (`kode_kamar`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
