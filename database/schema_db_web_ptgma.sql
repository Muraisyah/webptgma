-- Schema for db_web_ptgma
SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_lengkap` VARCHAR(35) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `no_hp` VARCHAR(15),
  `username` VARCHAR(20) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('Jemaah','Admin','Pimpinan') NOT NULL DEFAULT 'Jemaah',
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `hotel` (
  `id_hotel` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_hotel` VARCHAR(50) NOT NULL,
  `kota` VARCHAR(30) NOT NULL,
  `kategori_hotel` VARCHAR(15),
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `data_passport` (
  `id_passport` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_passport` VARCHAR(35) NOT NULL,
  `nama_tambahan` VARCHAR(35),
  `nomor_passport` CHAR(9) NOT NULL,
  `tempat_lahir_pass` VARCHAR(30),
  `tgl_lahir_pass` DATE,
  `tempat_pembuatan` VARCHAR(30),
  `tgl_pembuatan` DATE,
  `exp_passport` DATE,
  `foto_identitas_pass` VARCHAR(255),
  `foto_nama_tambahan` VARCHAR(255),
  `status_passport` ENUM('Aktif','Expired') DEFAULT 'Aktif',
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `data_visa` (
  `id_visa` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_visa` VARCHAR(35) NOT NULL,
  `nomor_visa` CHAR(15),
  `tgl_berlaku_visa` DATE,
  `tgl_exp_visa` DATE,
  `foto_visa` VARCHAR(255),
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `data_vaksin` (
  `id_vaksin` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_vaksin` VARCHAR(35) NOT NULL,
  `foto_vaksin` VARCHAR(255),
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `paket` (
  `id_paket` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_paket` VARCHAR(50) NOT NULL,
  `durasi_perjalanan` INT,
  `tgl_keberangkatan` DATE,
  `tgl_kepulangan` DATE,
  `kuota_paket` INT,
  `seat_tersedia` INT,
  `harga_paket` BIGINT,
  `maskapai` VARCHAR(30),
  `id_hotel` INT,
  `deskripsi` TEXT,
  `foto_paket` VARCHAR(255),
  `status_paket` ENUM('Aktif','Nonaktif') DEFAULT 'Nonaktif',
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX (`id_hotel`),
  CONSTRAINT `fk_paket_hotel` FOREIGN KEY (`id_hotel`) REFERENCES `hotel`(`id_hotel`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `rekening` (
  `id_rekening` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_bank` VARCHAR(20) NOT NULL,
  `nomor_rekening` VARCHAR(30) NOT NULL,
  `atas_nama` VARCHAR(50) NOT NULL,
  `status` ENUM('Aktif','Nonaktif') DEFAULT 'Aktif',
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `data_jemaah` (
  `id_jemaah` INT AUTO_INCREMENT PRIMARY KEY,
  `id_user` INT NOT NULL,
  `nama_jemaah` VARCHAR(35) NOT NULL,
  `tempat_lahir` VARCHAR(30),
  `tgl_lahir` DATE,
  `nik` CHAR(16),
  `jenis_kelamin` ENUM('Laki-laki','Perempuan'),
  `alamat` TEXT,
  `nama_ayah` VARCHAR(35),
  `status_pernikahan` ENUM('Menikah','Belum Menikah'),
  `kewarganegaraan` VARCHAR(30),
  `foto_ktp` VARCHAR(255),
  `foto_kk` VARCHAR(255),
  `foto_akte` VARCHAR(255),
  `foto_buku_nikah` VARCHAR(255),
  `foto_ktp_ayah` VARCHAR(255),
  `foto_ktp_ibu` VARCHAR(255),
  `id_passport` INT NULL,
  `id_visa` INT NULL,
  `id_vaksin` INT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX (`id_user`),
  INDEX (`id_passport`),
  INDEX (`id_visa`),
  INDEX (`id_vaksin`),
  CONSTRAINT `fk_jemaah_user` FOREIGN KEY (`id_user`) REFERENCES `user`(`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_jemaah_passport` FOREIGN KEY (`id_passport`) REFERENCES `data_passport`(`id_passport`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_jemaah_visa` FOREIGN KEY (`id_visa`) REFERENCES `data_visa`(`id_visa`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_jemaah_vaksin` FOREIGN KEY (`id_vaksin`) REFERENCES `data_vaksin`(`id_vaksin`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `galeri` (
  `id_galeri` INT AUTO_INCREMENT PRIMARY KEY,
  `judul_foto` VARCHAR(100),
  `deskripsi_foto` TEXT,
  `foto_jemaah` VARCHAR(255),
  `id_user` INT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX (`id_user`),
  CONSTRAINT `fk_galeri_user` FOREIGN KEY (`id_user`) REFERENCES `user`(`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `reservasi` (
  `id_reservasi` INT AUTO_INCREMENT PRIMARY KEY,
  `kode_reservasi` VARCHAR(20) NOT NULL UNIQUE,
  `id_user` INT NOT NULL,
  `id_paket` INT NOT NULL,
  `tgl_reservasi` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `jumlah_jemaah` INT,
  `total_biaya` BIGINT,
  `status_reservasi` ENUM('Menunggu Pembayaran','DP','Lunas','Dibatalkan') DEFAULT 'Menunggu Pembayaran',
  `status_keberangkatan` ENUM('Belum Berangkat','Sudah Berangkat','Selesai') DEFAULT 'Belum Berangkat',
  `catatan` TEXT,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX (`id_user`),
  INDEX (`id_paket`),
  CONSTRAINT `fk_reservasi_user` FOREIGN KEY (`id_user`) REFERENCES `user`(`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_reservasi_paket` FOREIGN KEY (`id_paket`) REFERENCES `paket`(`id_paket`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `detail_reservasi` (
  `id_detail` INT AUTO_INCREMENT PRIMARY KEY,
  `id_reservasi` INT NOT NULL,
  `id_jemaah` INT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX (`id_reservasi`),
  INDEX (`id_jemaah`),
  CONSTRAINT `fk_detail_reservasi_reservasi` FOREIGN KEY (`id_reservasi`) REFERENCES `reservasi`(`id_reservasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_detail_reservasi_jemaah` FOREIGN KEY (`id_jemaah`) REFERENCES `data_jemaah`(`id_jemaah`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` INT AUTO_INCREMENT PRIMARY KEY,
  `id_reservasi` INT NOT NULL,
  `kode_transaksi` VARCHAR(20),
  `tgl_transaksi` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `jenis_pembayaran` ENUM('DP','Pelunasan'),
  `id_rekening` INT NOT NULL,
  `nominal_bayar` BIGINT,
  `bukti_transfer` VARCHAR(255),
  `status_verifikasi` ENUM('Menunggu Verifikasi','Diterima','Ditolak') DEFAULT 'Menunggu Verifikasi',
  `tgl_verifikasi` DATETIME NULL,
  `id_admin` INT NULL,
  `keterangan` TEXT,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX (`id_reservasi`),
  INDEX (`id_rekening`),
  INDEX (`id_admin`),
  CONSTRAINT `fk_transaksi_reservasi` FOREIGN KEY (`id_reservasi`) REFERENCES `reservasi`(`id_reservasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_rekening` FOREIGN KEY (`id_rekening`) REFERENCES `rekening`(`id_rekening`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_transaksi_admin` FOREIGN KEY (`id_admin`) REFERENCES `user`(`id_user`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `dokumen_keberangkatan` (
  `id_dokumen` INT AUTO_INCREMENT PRIMARY KEY,
  `id_jemaah` INT NOT NULL,
  `jenis_dokumen` ENUM('Paspor','Visa','Sertifikat Vaksin','Tiket Pesawat','Program Perjalanan'),
  `file_dokumen` VARCHAR(255),
  `status_dokumen` ENUM('Belum Tersedia','Tersedia') DEFAULT 'Belum Tersedia',
  `tgl_upload` DATETIME,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX (`id_jemaah`),
  CONSTRAINT `fk_dokumen_jemaah` FOREIGN KEY (`id_jemaah`) REFERENCES `data_jemaah`(`id_jemaah`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `log_reservasi` (
  `id_log` INT AUTO_INCREMENT PRIMARY KEY,
  `id_reservasi` INT NOT NULL,
  `status_lama` VARCHAR(30),
  `status_baru` VARCHAR(30),
  `id_admin` INT NULL,
  `waktu_update` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX (`id_reservasi`),
  INDEX (`id_admin`),
  CONSTRAINT `fk_log_reservasi_reservasi` FOREIGN KEY (`id_reservasi`) REFERENCES `reservasi`(`id_reservasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_log_reservasi_admin` FOREIGN KEY (`id_admin`) REFERENCES `user`(`id_user`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS=1;
