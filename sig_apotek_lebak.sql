-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jan 2026 pada 04.41
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sig_apotek_lebak`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama`) VALUES
(1, 'admin', '$2y$10$Xi8gpioKAKmf3U8iT8UKIOzFcdWw4UfVnxrgEbH37K8qZtDeQDzj6', 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `apotek`
--

CREATE TABLE `apotek` (
  `id` int(11) NOT NULL,
  `nama_apotek` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `desa` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL DEFAULT 'Pakis Aji',
  `kabupaten` varchar(100) NOT NULL DEFAULT 'Jepara',
  `telepon` varchar(30) DEFAULT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `apotek`
--

INSERT INTO `apotek` (`id`, `nama_apotek`, `alamat`, `desa`, `kecamatan`, `kabupaten`, `telepon`, `latitude`, `longitude`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Apotek Kirana Farma', 'Jl. Raya Lebak 02/01, Desa Lebak, Pakis Aji, Jepara 59452', 'Lebak', 'Pakis Aji', 'Jepara', '0852-1668-2583', -6.6002578, 110.7411462, 'Apotek umum di jalur utama Lebak.', '2026-01-08 03:14:22', '2026-01-08 03:35:49'),
(2, 'Apotek Madinah', 'Jl. Raya Lebak - Suwawal, Desa Lebak, Pakis Aji, Jepara', 'Lebak', 'Pakis Aji', 'Jepara', '0812-1111-2222', -6.5857852, 110.7419666, 'Apotek dekat pertigaan menuju Suwawal.', '2026-01-08 03:14:22', '2026-01-08 03:37:45'),
(3, 'Apotek Mitra Farma', 'Jl. Tanjung - Lebak, Desa Lebak, Pakis Aji, Jepara', 'Lebak', 'Pakis Aji', 'Jepara', '0813-3333-4444', -6.5885989, 110.7445844, 'Dekat kawasan pelayanan kesehatan di Lebak.', '2026-01-08 03:14:22', '2026-01-08 03:37:09');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `apotek`
--
ALTER TABLE `apotek`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `apotek`
--
ALTER TABLE `apotek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
