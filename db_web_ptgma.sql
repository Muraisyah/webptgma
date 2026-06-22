-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 20, 2026 at 02:51 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_web_ptgma`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_jemaah`
--

CREATE TABLE `data_jemaah` (
  `id_jemaah` int NOT NULL,
  `id_user` int NOT NULL,
  `nama_jemaah` varchar(35) NOT NULL,
  `tempat_lahir` varchar(30) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `nik` char(16) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `alamat` text,
  `nama_ayah` varchar(35) DEFAULT NULL,
  `status_pernikahan` enum('Menikah','Belum Menikah') DEFAULT NULL,
  `kewarganegaraan` varchar(30) DEFAULT NULL,
  `foto_ktp` varchar(255) DEFAULT NULL,
  `foto_kk` varchar(255) DEFAULT NULL,
  `foto_akte` varchar(255) DEFAULT NULL,
  `foto_buku_nikah` varchar(255) DEFAULT NULL,
  `foto_ktp_ayah` varchar(255) DEFAULT NULL,
  `foto_ktp_ibu` varchar(255) DEFAULT NULL,
  `id_passport` int DEFAULT NULL,
  `id_visa` int DEFAULT NULL,
  `id_vaksin` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_passport`
--

CREATE TABLE `data_passport` (
  `id_passport` int NOT NULL,
  `nama_passport` varchar(35) NOT NULL,
  `nama_tambahan` varchar(35) DEFAULT NULL,
  `nomor_passport` char(9) NOT NULL,
  `tempat_lahir_pass` varchar(30) DEFAULT NULL,
  `tgl_lahir_pass` date DEFAULT NULL,
  `tempat_pembuatan` varchar(30) DEFAULT NULL,
  `tgl_pembuatan` date DEFAULT NULL,
  `exp_passport` date DEFAULT NULL,
  `foto_identitas_pass` varchar(255) DEFAULT NULL,
  `foto_nama_tambahan` varchar(255) DEFAULT NULL,
  `status_passport` enum('Aktif','Expired') DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_vaksin`
--

CREATE TABLE `data_vaksin` (
  `id_vaksin` int NOT NULL,
  `nama_vaksin` varchar(35) NOT NULL,
  `foto_vaksin` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_visa`
--

CREATE TABLE `data_visa` (
  `id_visa` int NOT NULL,
  `nama_visa` varchar(35) NOT NULL,
  `nomor_visa` char(15) DEFAULT NULL,
  `tgl_berlaku_visa` date DEFAULT NULL,
  `tgl_exp_visa` date DEFAULT NULL,
  `foto_visa` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_reservasi`
--

CREATE TABLE `detail_reservasi` (
  `id_detail` int NOT NULL,
  `id_reservasi` int NOT NULL,
  `id_jemaah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_keberangkatan`
--

CREATE TABLE `dokumen_keberangkatan` (
  `id_dokumen` int NOT NULL,
  `id_jemaah` int NOT NULL,
  `jenis_dokumen` enum('Paspor','Visa','Sertifikat Vaksin','Tiket Pesawat','Program Perjalanan') DEFAULT NULL,
  `file_dokumen` varchar(255) DEFAULT NULL,
  `status_dokumen` enum('Belum Tersedia','Tersedia') DEFAULT 'Belum Tersedia',
  `tgl_upload` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int NOT NULL,
  `judul_foto` varchar(100) DEFAULT NULL,
  `deskripsi_foto` text,
  `foto_jemaah` varchar(255) DEFAULT NULL,
  `id_user` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `id_hotel` int NOT NULL,
  `nama_hotel` varchar(50) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `kategori_hotel` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id_hotel`, `nama_hotel`, `kota`, `kategori_hotel`, `created_at`, `updated_at`) VALUES
(1, 'Hotel Mekkah', 'Mekkah', 'Bintang 4', '2026-06-19 08:59:51', '2026-06-19 08:59:51'),
(2, 'Hotel Madinah', 'Madinah', 'Bintang 3', '2026-06-19 08:59:51', '2026-06-19 08:59:51');

-- --------------------------------------------------------

--
-- Table structure for table `log_reservasi`
--

CREATE TABLE `log_reservasi` (
  `id_log` int NOT NULL,
  `id_reservasi` int NOT NULL,
  `status_lama` varchar(30) DEFAULT NULL,
  `status_baru` varchar(30) DEFAULT NULL,
  `id_admin` int DEFAULT NULL,
  `waktu_update` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_06_19_000001_create_hotel_table', 2),
(6, '2026_06_19_000002_create_rekening_table', 2),
(7, '2026_06_19_000003_create_paket_table', 2),
(8, '2026_06_19_000004_create_data_passport_table', 2),
(9, '2026_06_19_000005_create_data_visa_table', 2),
(10, '2026_06_19_000006_create_data_vaksin_table', 2),
(11, '2026_06_19_000007_create_data_jemaah_table', 2),
(12, '2026_06_19_000008_create_galeri_table', 2),
(13, '2026_06_19_000009_create_reservasi_table', 2),
(14, '2026_06_19_000010_create_detail_reservasi_table', 2),
(15, '2026_06_19_000011_create_transaksi_table', 2),
(16, '2026_06_19_000012_create_dokumen_keberangkatan_table', 2),
(17, '2026_06_19_000013_create_log_reservasi_table', 2),
(18, '2026_06_19_000001_add_remember_token_to_user_table', 3),
(19, '2026_06_20_000000_create_paket_hotel_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id_paket` int NOT NULL,
  `nama_paket` varchar(50) NOT NULL,
  `durasi_perjalanan` int DEFAULT NULL,
  `tgl_keberangkatan` date DEFAULT NULL,
  `tgl_kepulangan` date DEFAULT NULL,
  `kuota_paket` int DEFAULT NULL,
  `seat_tersedia` int DEFAULT NULL,
  `harga_paket` bigint DEFAULT NULL,
  `maskapai` varchar(30) DEFAULT NULL,
  `id_hotel` int DEFAULT NULL,
  `deskripsi` text,
  `foto_paket` varchar(255) DEFAULT NULL,
  `status_paket` enum('Aktif','Nonaktif') DEFAULT 'Nonaktif',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`, `durasi_perjalanan`, `tgl_keberangkatan`, `tgl_kepulangan`, `kuota_paket`, `seat_tersedia`, `harga_paket`, `maskapai`, `id_hotel`, `deskripsi`, `foto_paket`, `status_paket`, `created_at`, `updated_at`) VALUES
(2, 'PAKET UMROH 20', 10, '2026-06-20', '2026-06-24', 20, 15, 100000, 'GARUDA', 1, NULL, '/storage/uploads/nu72rqHJHzTvpozgkbJAfnUZGP83n9osZsiEF2FN.png', 'Aktif', '2026-06-20 07:28:20', '2026-06-20 07:39:42');

-- --------------------------------------------------------

--
-- Table structure for table `paket_hotel`
--

CREATE TABLE `paket_hotel` (
  `id_paket` int UNSIGNED NOT NULL,
  `id_hotel` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paket_hotel`
--

INSERT INTO `paket_hotel` (`id_paket`, `id_hotel`) VALUES
(2, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `id_rekening` int NOT NULL,
  `nama_bank` varchar(20) NOT NULL,
  `nomor_rekening` varchar(30) NOT NULL,
  `atas_nama` varchar(50) NOT NULL,
  `status` enum('Aktif','Nonaktif') DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`id_rekening`, `nama_bank`, `nomor_rekening`, `atas_nama`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BCA', '1234567890', 'PT Contoh', 'Aktif', '2026-06-19 08:59:51', '2026-06-19 08:59:51'),
(2, 'Mandiri', '9876543210', 'PT Contoh', 'Aktif', '2026-06-19 08:59:51', '2026-06-19 08:59:51');

-- --------------------------------------------------------

--
-- Table structure for table `reservasi`
--

CREATE TABLE `reservasi` (
  `id_reservasi` int NOT NULL,
  `kode_reservasi` varchar(20) NOT NULL,
  `id_user` int NOT NULL,
  `id_paket` int NOT NULL,
  `tgl_reservasi` datetime DEFAULT CURRENT_TIMESTAMP,
  `jumlah_jemaah` int DEFAULT NULL,
  `total_biaya` bigint DEFAULT NULL,
  `status_reservasi` enum('Menunggu Pembayaran','DP','Lunas','Dibatalkan') DEFAULT 'Menunggu Pembayaran',
  `status_keberangkatan` enum('Belum Berangkat','Sudah Berangkat','Selesai') DEFAULT 'Belum Berangkat',
  `catatan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int NOT NULL,
  `id_reservasi` int NOT NULL,
  `kode_transaksi` varchar(20) DEFAULT NULL,
  `tgl_transaksi` datetime DEFAULT CURRENT_TIMESTAMP,
  `jenis_pembayaran` enum('DP','Pelunasan') DEFAULT NULL,
  `id_rekening` int NOT NULL,
  `nominal_bayar` bigint DEFAULT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `status_verifikasi` enum('Menunggu Verifikasi','Diterima','Ditolak') DEFAULT 'Menunggu Verifikasi',
  `tgl_verifikasi` datetime DEFAULT NULL,
  `id_admin` int DEFAULT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama_lengkap` varchar(35) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role` enum('Jemaah','Admin','Pimpinan') NOT NULL DEFAULT 'Jemaah',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `email`, `no_hp`, `username`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@example.com', '081234567890', 'admin', '$2y$10$bWD4y/6N2Tbc7UVjetL08uoZNYJC9WmJ1Zug8.xyWJm2sFUbuChjG', 'CAz2ENFTr1SfwKR9txWurniOAQhJzFfXlBmNbx0hwnOhmmXeFm3cqBE9trSk', 'Admin', '2026-06-19 08:54:36', '2026-06-20 13:58:19'),
(2, 'Pimpinan', 'pimpinan@example.com', '081298765432', 'pimpinan', '$2y$10$5YW1jEllBQy4ZZSTcs7C7e/SgC4MVGLgCIceFSVu4lojj35LnP4Tm', NULL, 'Pimpinan', '2026-06-19 08:54:36', '2026-06-19 08:54:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_jemaah`
--
ALTER TABLE `data_jemaah`
  ADD PRIMARY KEY (`id_jemaah`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_passport` (`id_passport`),
  ADD KEY `id_visa` (`id_visa`),
  ADD KEY `id_vaksin` (`id_vaksin`);

--
-- Indexes for table `data_passport`
--
ALTER TABLE `data_passport`
  ADD PRIMARY KEY (`id_passport`);

--
-- Indexes for table `data_vaksin`
--
ALTER TABLE `data_vaksin`
  ADD PRIMARY KEY (`id_vaksin`);

--
-- Indexes for table `data_visa`
--
ALTER TABLE `data_visa`
  ADD PRIMARY KEY (`id_visa`);

--
-- Indexes for table `detail_reservasi`
--
ALTER TABLE `detail_reservasi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_reservasi` (`id_reservasi`),
  ADD KEY `id_jemaah` (`id_jemaah`);

--
-- Indexes for table `dokumen_keberangkatan`
--
ALTER TABLE `dokumen_keberangkatan`
  ADD PRIMARY KEY (`id_dokumen`),
  ADD KEY `id_jemaah` (`id_jemaah`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id_hotel`);

--
-- Indexes for table `log_reservasi`
--
ALTER TABLE `log_reservasi`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_reservasi` (`id_reservasi`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`),
  ADD KEY `id_hotel` (`id_hotel`);

--
-- Indexes for table `paket_hotel`
--
ALTER TABLE `paket_hotel`
  ADD PRIMARY KEY (`id_paket`,`id_hotel`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indexes for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id_reservasi`),
  ADD UNIQUE KEY `kode_reservasi` (`kode_reservasi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_reservasi` (`id_reservasi`),
  ADD KEY `id_rekening` (`id_rekening`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_jemaah`
--
ALTER TABLE `data_jemaah`
  MODIFY `id_jemaah` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_passport`
--
ALTER TABLE `data_passport`
  MODIFY `id_passport` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_vaksin`
--
ALTER TABLE `data_vaksin`
  MODIFY `id_vaksin` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_visa`
--
ALTER TABLE `data_visa`
  MODIFY `id_visa` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_reservasi`
--
ALTER TABLE `detail_reservasi`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokumen_keberangkatan`
--
ALTER TABLE `dokumen_keberangkatan`
  MODIFY `id_dokumen` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id_hotel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log_reservasi`
--
ALTER TABLE `log_reservasi`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_rekening` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id_reservasi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_jemaah`
--
ALTER TABLE `data_jemaah`
  ADD CONSTRAINT `fk_jemaah_passport` FOREIGN KEY (`id_passport`) REFERENCES `data_passport` (`id_passport`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jemaah_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jemaah_vaksin` FOREIGN KEY (`id_vaksin`) REFERENCES `data_vaksin` (`id_vaksin`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jemaah_visa` FOREIGN KEY (`id_visa`) REFERENCES `data_visa` (`id_visa`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `detail_reservasi`
--
ALTER TABLE `detail_reservasi`
  ADD CONSTRAINT `fk_detail_reservasi_jemaah` FOREIGN KEY (`id_jemaah`) REFERENCES `data_jemaah` (`id_jemaah`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_reservasi_reservasi` FOREIGN KEY (`id_reservasi`) REFERENCES `reservasi` (`id_reservasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dokumen_keberangkatan`
--
ALTER TABLE `dokumen_keberangkatan`
  ADD CONSTRAINT `fk_dokumen_jemaah` FOREIGN KEY (`id_jemaah`) REFERENCES `data_jemaah` (`id_jemaah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `galeri`
--
ALTER TABLE `galeri`
  ADD CONSTRAINT `fk_galeri_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log_reservasi`
--
ALTER TABLE `log_reservasi`
  ADD CONSTRAINT `fk_log_reservasi_admin` FOREIGN KEY (`id_admin`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_log_reservasi_reservasi` FOREIGN KEY (`id_reservasi`) REFERENCES `reservasi` (`id_reservasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `paket`
--
ALTER TABLE `paket`
  ADD CONSTRAINT `fk_paket_hotel` FOREIGN KEY (`id_hotel`) REFERENCES `hotel` (`id_hotel`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD CONSTRAINT `fk_reservasi_paket` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservasi_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_admin` FOREIGN KEY (`id_admin`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaksi_rekening` FOREIGN KEY (`id_rekening`) REFERENCES `rekening` (`id_rekening`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaksi_reservasi` FOREIGN KEY (`id_reservasi`) REFERENCES `reservasi` (`id_reservasi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
