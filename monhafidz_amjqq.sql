-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Nov 2025 pada 08.04
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
-- Database: `monhafidz_amjqq`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `santri_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Hadir','Izin','Alpa','Sakit') NOT NULL DEFAULT 'Hadir',
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id`, `santri_id`, `tanggal`, `status`, `catatan`, `created_at`, `updated_at`) VALUES
(2, 1, '2025-10-31', 'Hadir', 'tes', '2025-10-30 17:48:02', '2025-10-30 17:48:02'),
(3, 1, '2025-11-01', 'Hadir', NULL, '2025-11-01 04:34:24', '2025-11-01 04:34:24'),
(4, 1, '2025-11-02', 'Izin', NULL, '2025-11-01 04:34:41', '2025-11-01 04:34:41'),
(5, 1, '2025-11-03', 'Hadir', NULL, '2025-11-01 04:34:54', '2025-11-01 04:34:54'),
(6, 7, '2025-11-13', 'Hadir', NULL, '2025-11-12 23:00:42', '2025-11-12 23:00:42'),
(7, 8, '2025-11-13', 'Hadir', NULL, '2025-11-12 23:04:27', '2025-11-12 23:04:27'),
(8, 8, '2025-11-13', 'Izin', NULL, '2025-11-12 23:57:49', '2025-11-12 23:57:49'),
(9, 8, '2025-11-14', 'Sakit', 'demam', '2025-11-12 23:59:24', '2025-11-12 23:59:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_hafalan`
--

CREATE TABLE `jadwal_hafalan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_hafalan` enum('ziyadah','murajaah') NOT NULL,
  `hari` varchar(255) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time DEFAULT NULL,
  `pembimbing_putra_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pembimbing_putri_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jadwal_hafalan`
--

INSERT INTO `jadwal_hafalan` (`id`, `jenis_hafalan`, `hari`, `jam_mulai`, `jam_selesai`, `pembimbing_putra_id`, `pembimbing_putri_id`, `created_at`, `updated_at`) VALUES
(1, 'ziyadah', 'Senin', '08:00:00', NULL, 1, 2, '2025-10-25 01:26:48', '2025-10-25 07:37:10'),
(2, 'ziyadah', 'Selasa', '08:00:00', NULL, 1, 2, '2025-10-25 01:26:48', '2025-10-25 01:26:48'),
(3, 'ziyadah', 'Rabu', '08:00:00', NULL, 1, 2, '2025-10-25 01:26:48', '2025-10-25 01:26:48'),
(4, 'ziyadah', 'Kamis', '08:00:00', NULL, 1, 2, '2025-10-25 01:26:48', '2025-10-25 01:26:48'),
(5, 'ziyadah', 'Sabtu', '08:00:00', NULL, 1, 2, '2025-10-25 01:26:48', '2025-10-25 01:26:48'),
(6, 'murajaah', 'Sabtu', '18:30:00', NULL, 1, 2, '2025-10-25 01:26:48', '2025-10-25 01:26:48'),
(7, 'murajaah', 'Senin', '18:30:00', NULL, 1, 2, '2025-10-25 01:26:48', '2025-10-25 07:36:53'),
(8, 'murajaah', 'Selasa', '18:30:00', NULL, 1, 2, '2025-10-25 01:26:48', '2025-10-25 01:26:48'),
(9, 'murajaah', 'Rabu', '18:30:00', NULL, 1, 2, '2025-10-25 01:26:48', '2025-10-25 01:26:48'),
(10, 'murajaah', 'Kamis', '18:30:00', NULL, 1, 2, '2025-10-25 01:26:48', '2025-10-25 01:26:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_ujian`
--

CREATE TABLE `jadwal_ujian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `santri_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `pembimbing_putra_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pembimbing_putri_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jenis_ujian` enum('tasmi','ujian_akhir','ziyadah','murajaah') NOT NULL DEFAULT 'tasmi',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `semester_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jadwal_ujian`
--

INSERT INTO `jadwal_ujian` (`id`, `santri_id`, `tanggal`, `jam_mulai`, `jam_selesai`, `pembimbing_putra_id`, `pembimbing_putri_id`, `jenis_ujian`, `created_at`, `updated_at`, `semester_id`) VALUES
(17, 3, '2025-11-13', '12:38:00', '13:38:00', 4, 1, 'ziyadah', '2025-11-12 22:38:59', '2025-11-12 22:38:59', 1),
(18, 4, '2025-11-13', '12:40:00', '14:40:00', 4, 1, 'ziyadah', '2025-11-12 22:40:17', '2025-11-12 22:40:17', 1),
(19, 8, '2025-11-13', '13:12:00', '14:12:00', 4, 1, 'ziyadah', '2025-11-12 23:12:48', '2025-11-12 23:12:48', 1),
(20, 6, '2025-11-13', '14:03:00', '15:03:00', 4, 1, 'tasmi', '2025-11-13 00:04:03', '2025-11-13 00:04:03', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_23_073137_create_semesters_table', 1),
(5, '2025_10_23_074557_create_ustadzahs_table', 1),
(6, '2025_10_23_074659_create_santris_table', 1),
(7, '2025_10_23_074727_create_wali_santris_table', 1),
(8, '2025_10_23_075006_create_jadwal_hafalans_table', 1),
(9, '2025_10_23_075236_create_pencatatan_hafalans_table', 1),
(10, '2025_10_23_075933_create_absensis_table', 1),
(11, '2025_10_24_054347_create_jadwal_ujians_table', 2),
(12, '2025_10_24_054618_create_pencatatan_ujians_table', 2),
(13, '2025_11_01_085234_create_personal_access_tokens_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pencatatan_hafalan`
--

CREATE TABLE `pencatatan_hafalan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `santri_id` bigint(20) UNSIGNED NOT NULL,
  `semester_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jenis_hafalan` enum('Ziyadah','Murajaah') NOT NULL,
  `surah_ayat` varchar(255) DEFAULT NULL,
  `nilai_tajwid` decimal(5,2) DEFAULT NULL,
  `nilai_kelancaran` decimal(5,2) DEFAULT NULL,
  `juz_tercapai` int(11) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `status` enum('belum_diuji','lulus jayyid','lulus mumtaz','remidi','harus diulang','Belum Diperiksa','Lulus','Perbaikan') NOT NULL DEFAULT 'Belum Diperiksa',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pencatatan_hafalan`
--

INSERT INTO `pencatatan_hafalan` (`id`, `santri_id`, `semester_id`, `tanggal`, `jenis_hafalan`, `surah_ayat`, `nilai_tajwid`, `nilai_kelancaran`, `juz_tercapai`, `catatan`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-10-25', 'Ziyadah', 'Al-baqarah 1- 10', 90.00, 100.00, 2, 'tes woi', 'Lulus', '2025-10-25 08:04:18', '2025-10-29 08:00:09'),
(2, 3, 1, '2025-02-05', 'Ziyadah', 'Al-baqarah 1- 10', 98.00, 77.00, 1, NULL, 'Lulus', '2025-11-01 02:09:18', '2025-11-01 02:09:18'),
(3, 3, 1, '2025-04-02', 'Ziyadah', 'Al-baqarah 1- 10', 90.00, 90.00, 2, NULL, 'Lulus', '2025-11-01 02:09:44', '2025-11-01 02:09:44'),
(4, 3, 1, '2025-02-07', 'Murajaah', 'Al-baqarah 1- 10', 90.00, 80.00, 3, NULL, 'Lulus', '2025-11-01 03:52:08', '2025-11-01 03:52:08'),
(5, 3, 1, '2025-02-12', 'Murajaah', 'Alfatih- 10', 90.00, 90.00, 1, NULL, 'Lulus', '2025-11-01 03:55:47', '2025-11-01 03:55:47'),
(9, 3, 1, '2025-11-09', 'Ziyadah', 'Alfatih- 10', 99.00, 99.00, 2, NULL, 'Lulus', '2025-11-09 03:34:44', '2025-11-09 03:34:44'),
(10, 3, 3, '2025-11-09', 'Ziyadah', 'Al-baqarah 1- 10', 99.00, 99.00, 5, NULL, 'Lulus', '2025-11-09 03:38:33', '2025-11-09 03:38:33'),
(11, 1, 1, '2025-11-12', 'Ziyadah', 'Al-baqarah 1- 10', 40.00, 40.00, 0, NULL, 'Belum Diperiksa', '2025-11-11 18:59:26', '2025-11-11 18:59:26'),
(12, 3, 4, '2025-11-12', 'Ziyadah', 'Al-baqarah 1- 10', 30.00, 30.00, 0, NULL, 'Belum Diperiksa', '2025-11-11 19:01:44', '2025-11-11 19:01:44'),
(13, 4, 1, '2025-11-12', 'Ziyadah', 'Al-baqarah 1- 10', 30.00, 30.00, 0, NULL, 'Belum Diperiksa', '2025-11-11 19:03:35', '2025-11-11 19:03:35'),
(14, 3, 4, '2025-11-12', 'Ziyadah', 'Al-baqarah 1- 10', 30.00, 30.00, 0, NULL, 'harus diulang', '2025-11-11 19:06:00', '2025-11-11 19:06:00'),
(15, 1, 1, '2025-11-12', 'Ziyadah', 'Al-baqarah 1- 10', 75.00, 75.00, 1, NULL, 'lulus jayyid', '2025-11-11 19:06:27', '2025-11-11 19:06:27'),
(16, 1, 1, '2025-11-12', 'Murajaah', 'Al-baqarah 1- 10', 90.00, 90.00, 0, NULL, 'lulus mumtaz', '2025-11-11 19:07:21', '2025-11-11 19:07:21'),
(17, 8, 1, '2025-11-13', 'Ziyadah', 'al fatihah', 90.00, 90.00, 1, NULL, 'lulus mumtaz', '2025-11-12 23:07:12', '2025-11-12 23:07:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pencatatan_ujian`
--

CREATE TABLE `pencatatan_ujian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ustadzah_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jadwal_ujian_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nilai_ujian` decimal(5,2) DEFAULT NULL,
  `status_ujian` enum('belum_diuji','lulus','remidi') NOT NULL DEFAULT 'belum_diuji',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pencatatan_ujian`
--

INSERT INTO `pencatatan_ujian` (`id`, `ustadzah_id`, `jadwal_ujian_id`, `nilai_ujian`, `status_ujian`, `created_at`, `updated_at`) VALUES
(12, 1, 17, 80.00, 'lulus', '2025-11-12 22:39:33', '2025-11-12 22:39:33'),
(13, 1, 18, 99.00, 'lulus', '2025-11-12 22:40:27', '2025-11-12 22:40:27'),
(14, 1, 19, 88.00, 'lulus', '2025-11-12 23:15:46', '2025-11-12 23:15:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perizinan`
--

CREATE TABLE `perizinan` (
  `id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `santri_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Hadir','Izin','Alpa','Sakit') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Hadir',
  `alasan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `santri`
--

CREATE TABLE `santri` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `nik` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat_lengkap` varchar(255) NOT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `semester_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_juz_tercapai` int(11) NOT NULL DEFAULT 0 COMMENT 'Jumlah juz ziyadah yang telah dicapai',
  `status_santri` enum('Aktif','Tamat Hafalan','Tidak Aktif','Lulus') NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `santri`
--

INSERT INTO `santri` (`id`, `nama_lengkap`, `jenis_kelamin`, `nik`, `tanggal_lahir`, `alamat_lengkap`, `no_hp`, `semester_id`, `total_juz_tercapai`, `status_santri`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'fadil tes', 'Laki-laki', '1231232131', '2025-10-25', 'tasik', '082115917198', 1, 30, 'Lulus', '2025-10-25 04:23:17', '2025-11-11 03:05:24', NULL),
(3, 'dimas', 'Laki-laki', '232', '2025-10-25', 'bogor', '087774487198', 4, 10, 'Aktif', '2025-10-25 08:05:42', '2025-11-11 03:15:48', NULL),
(4, 'Ahmad Fathur Rahman', 'Laki-laki', '7008641065371499', '2009-05-09', 'Desa Muslimin RT 8 RW 3', '0870642072860', 1, 13, 'Aktif', '2025-11-08 07:21:02', '2025-11-08 07:21:02', NULL),
(5, 'Muhammad Yusuf', 'Laki-laki', '2446938493128816', '2007-07-14', 'Desa Muslimin RT 5 RW 4', '0848749942613', 1, 18, 'Aktif', '2025-11-08 07:21:02', '2025-11-08 07:21:02', NULL),
(6, 'Abdullah Al Hafidz', 'Laki-laki', '5557401943687866', '2015-06-30', 'Desa Muslimin RT 4 RW 1', '0866859133792', 1, 25, 'Aktif', '2025-11-08 07:21:02', '2025-11-08 07:21:02', NULL),
(7, 'Rizky Maulana', 'Laki-laki', '5179833158836118', '2008-09-16', 'Desa Muslimin RT 11 RW 9', '0833727756303', 1, 10, 'Aktif', '2025-11-08 07:21:02', '2025-11-08 07:21:02', NULL),
(8, 'Santri Ali', 'Laki-laki', '6179401337085212', '2015-04-18', 'Desa Muslimin RT 1 RW 5', '0875351540254', 1, 5, 'Aktif', '2025-11-08 07:21:02', '2025-11-08 07:21:02', 4),
(9, 'Nabila Zahra', 'Perempuan', '8120306858527924', '2008-05-13', 'Desa Muslimin RT 3 RW 9', '0880978206623', 1, 20, 'Aktif', '2025-11-08 07:21:02', '2025-11-08 07:21:02', NULL),
(10, 'Aisyah Humaira', 'Perempuan', '7495853711349385', '2010-11-05', 'Desa Muslimin RT 7 RW 2', '0815347590666', 1, 15, 'Aktif', '2025-11-08 07:21:02', '2025-11-08 07:21:02', NULL),
(11, 'Nurul Qolbi', 'Perempuan', '3536232852009825', '2008-04-30', 'Desa Muslimin RT 3 RW 5', '0841912137135', 1, 6, 'Aktif', '2025-11-08 07:21:02', '2025-11-08 07:21:02', NULL),
(12, 'Siti Maryam', 'Perempuan', '9446238736548790', '2013-06-07', 'Desa Muslimin RT 7 RW 6', '0893298371080', 1, 28, 'Aktif', '2025-11-08 07:21:02', '2025-11-08 07:21:02', NULL),
(13, 'Fatimah Azzahra', 'Perempuan', '7797246016662739', '2007-09-22', 'Desa Muslimin RT 10 RW 7', '0857607392203', 1, 8, 'Aktif', '2025-11-08 07:21:02', '2025-11-08 07:21:02', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `semester`
--

CREATE TABLE `semester` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_semester` varchar(255) NOT NULL,
  `tahun_ajaran` varchar(255) NOT NULL,
  `periode_mulai` date NOT NULL,
  `periode_selesai` date NOT NULL,
  `status` enum('Aktif','Nonaktif') NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `semester`
--

INSERT INTO `semester` (`id`, `nama_semester`, `tahun_ajaran`, `periode_mulai`, `periode_selesai`, `status`, `created_at`, `updated_at`) VALUES
(1, 'semester 1 tes', '2025', '2025-01-25', '2025-06-25', 'Aktif', '2025-10-25 04:15:44', '2025-10-25 04:22:13'),
(3, 'semester 2', '2025/2026', '2025-06-01', '2025-12-01', 'Aktif', '2025-11-01 02:07:33', '2025-11-01 02:07:33'),
(4, 'semester 3', '2026/2027', '2026-01-01', '2026-06-01', 'Aktif', '2025-11-01 02:08:04', '2025-11-01 02:08:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('21wU2OyQSOrQGmXCSHskOlE08yfMVggt1DnHE4vp', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSVJ1QWpSTTd5ejdXNnJoNzFmQjhQWnlHRWNDWVhzZEI1TWR2VGE1dSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbGFwb3JhbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1763010006),
('LYtsoNJkDi8sA5DfAjqa1rh4eu3ldyuX9cxI9RQY', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMk1iSEVWeUxCNFFzR0ZhcmVZQ3NldUhROVlYeTF1Zjk0RkdzYU1saiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91amlhbi10YXNtaSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1763017475),
('v70F7N7h416OhqKTtC1ZL30cpMaLXoL5ELJBhwYX', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidTZiVml1TWZlaVI5TjNSdnBWZFN1T29XQnNONnR5YmV2UTBJOXFIciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hYnNlbnNpLXNhbnRyaS9wZW5nYWp1YW4taXppbiI7fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O30=', 1763017127);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujian_tasmi`
--

CREATE TABLE `ujian_tasmi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ustadzah_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jadwal_ujian_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal_tasmi` date DEFAULT NULL,
  `juz_yang_ditasmi` varchar(225) DEFAULT NULL,
  `status_ujian` enum('belum_diuji','lancar','remidi') NOT NULL DEFAULT 'belum_diuji',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ujian_tasmi`
--

INSERT INTO `ujian_tasmi` (`id`, `ustadzah_id`, `jadwal_ujian_id`, `tanggal_tasmi`, `juz_yang_ditasmi`, `status_ujian`, `created_at`, `updated_at`, `catatan`) VALUES
(3, 1, 20, '2025-11-13', 'fsdfdsfsa', 'lancar', '2025-11-13 00:04:27', '2025-11-13 00:04:27', 'mantap');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','santri','ustad','walisantri') NOT NULL DEFAULT 'santri',
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('aktif','diblokir','nonaktif','pending') NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `role`, `password`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Administrator', 'admin', 'admin@gmail.com', NULL, 'admin', '$2y$12$t6kRw/5Md5NlOkTHj68RaO90kuMeJS82shzjt8HCy/JgxSkcDM/4K', '2025-10-24 20:47:10', '2025-10-24 20:47:10', 'aktif'),
(2, 'Ustadz Sabiq Mujahid', 'ustadsabiq', 'ustadsabiq@gmail.com', NULL, 'ustad', '$2y$12$zwbQb4FR9K59nCHnBN6tjugdQC38.nZ9M2JAjHJ0rHAk04gmFEtYi', '2025-10-24 20:47:10', '2025-10-24 20:47:10', 'aktif'),
(3, 'Ustadzah Nuraisyah', 'ustadnuraisyah', 'ustadnuraisyah@gmail.com', NULL, 'ustad', '$2y$12$p7EiNqjNSCAxG5z4BJ1cuO0i0E8/TUEo3bRonXBADLdcMx54hYVRO', '2025-10-24 20:47:11', '2025-10-24 20:47:11', 'aktif'),
(4, 'Santri Ali', 'santri1', 'santriali@gmail.com', NULL, 'santri', '$2y$12$cwLCiLO/OSd7Tarfp13GDO3L6/Wlo9zRvFKRH1SVV5ulQYIgF3KXq', '2025-10-24 20:47:11', '2025-10-24 20:47:11', 'aktif'),
(5, 'Wali Santri Ali', 'walisantriali', 'walisantriali@gmail.com', NULL, 'walisantri', '$2y$12$E6/n2DcMgcI1g3zOoNhSlOgu1CPPqu3hiM5UX716/9JMYsqpe9Ex2', '2025-10-24 20:47:11', '2025-10-24 20:47:11', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ustadzah`
--

CREATE TABLE `ustadzah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat_lengkap` text DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ustadzah`
--

INSERT INTO `ustadzah` (`id`, `nama_lengkap`, `jenis_kelamin`, `nik`, `tanggal_lahir`, `alamat_lengkap`, `no_hp`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ustadz Sabiq mujahid', 'Laki-laki', '12321321', '2016-10-13', 'jalan tasik', '312312312', 'Aktif', NULL, NULL),
(2, 'Ustadzah Nuraisyah', 'Perempuan', '12312321312', '2005-06-08', 'jalan tasik', '083123213', 'Aktif', NULL, NULL),
(4, 'tes 2', 'Laki-laki', '2323', '2025-10-25', 'lombok', '2323', 'Aktif', '2025-10-25 08:07:43', '2025-10-25 08:07:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wali_santri`
--

CREATE TABLE `wali_santri` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `wali_sebagai` varchar(255) DEFAULT NULL,
  `santri_id` bigint(20) UNSIGNED NOT NULL,
  `alamat_lengkap` text DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `status_wali` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `wali_santri`
--

INSERT INTO `wali_santri` (`id`, `nama_lengkap`, `jenis_kelamin`, `nik`, `tanggal_lahir`, `wali_sebagai`, `santri_id`, `alamat_lengkap`, `no_hp`, `status_wali`, `created_at`, `updated_at`) VALUES
(2, 'dido', 'Laki-laki', '23232', '2025-10-25', 'wali', 3, 'bali', '087774487198', 'Aktif', '2025-10-25 08:08:20', '2025-11-11 03:26:07');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensi_santri_id_foreign` (`santri_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jadwal_hafalan`
--
ALTER TABLE `jadwal_hafalan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_hafalan_pembimbing_putra_id_foreign` (`pembimbing_putra_id`),
  ADD KEY `jadwal_hafalan_pembimbing_putri_id_foreign` (`pembimbing_putri_id`);

--
-- Indeks untuk tabel `jadwal_ujian`
--
ALTER TABLE `jadwal_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_ujian_santri_id_foreign` (`santri_id`),
  ADD KEY `jadwal_ujian_pembimbing_putra_id_foreign` (`pembimbing_putra_id`),
  ADD KEY `jadwal_ujian_pembimbing_putri_id_foreign` (`pembimbing_putri_id`),
  ADD KEY `jadwal_ujian_semester_id_foreign` (`semester_id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pencatatan_hafalan`
--
ALTER TABLE `pencatatan_hafalan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pencatatan_hafalan_santri_id_foreign` (`santri_id`),
  ADD KEY `pencatatan_hafalan_semester_id_foreign` (`semester_id`);

--
-- Indeks untuk tabel `pencatatan_ujian`
--
ALTER TABLE `pencatatan_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pencatatan_ujian_ustadzah_id_foreign` (`ustadzah_id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indeks untuk tabel `santri`
--
ALTER TABLE `santri`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `santri_nik_unique` (`nik`),
  ADD KEY `santri_semester_id_foreign` (`semester_id`),
  ADD KEY `santri_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `ujian_tasmi`
--
ALTER TABLE `ujian_tasmi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `ustadzah`
--
ALTER TABLE `ustadzah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ustadzah_nik_unique` (`nik`);

--
-- Indeks untuk tabel `wali_santri`
--
ALTER TABLE `wali_santri`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wali_santri_nik_unique` (`nik`),
  ADD KEY `wali_santri_santri_id_foreign` (`santri_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jadwal_hafalan`
--
ALTER TABLE `jadwal_hafalan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `jadwal_ujian`
--
ALTER TABLE `jadwal_ujian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `pencatatan_hafalan`
--
ALTER TABLE `pencatatan_hafalan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `pencatatan_ujian`
--
ALTER TABLE `pencatatan_ujian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `santri`
--
ALTER TABLE `santri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `semester`
--
ALTER TABLE `semester`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ujian_tasmi`
--
ALTER TABLE `ujian_tasmi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `ustadzah`
--
ALTER TABLE `ustadzah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `wali_santri`
--
ALTER TABLE `wali_santri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_santri_id_foreign` FOREIGN KEY (`santri_id`) REFERENCES `santri` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal_hafalan`
--
ALTER TABLE `jadwal_hafalan`
  ADD CONSTRAINT `jadwal_hafalan_pembimbing_putra_id_foreign` FOREIGN KEY (`pembimbing_putra_id`) REFERENCES `ustadzah` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `jadwal_hafalan_pembimbing_putri_id_foreign` FOREIGN KEY (`pembimbing_putri_id`) REFERENCES `ustadzah` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `jadwal_ujian`
--
ALTER TABLE `jadwal_ujian`
  ADD CONSTRAINT `jadwal_ujian_pembimbing_putra_id_foreign` FOREIGN KEY (`pembimbing_putra_id`) REFERENCES `ustadzah` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `jadwal_ujian_pembimbing_putri_id_foreign` FOREIGN KEY (`pembimbing_putri_id`) REFERENCES `ustadzah` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `jadwal_ujian_santri_id_foreign` FOREIGN KEY (`santri_id`) REFERENCES `santri` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_ujian_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pencatatan_hafalan`
--
ALTER TABLE `pencatatan_hafalan`
  ADD CONSTRAINT `pencatatan_hafalan_santri_id_foreign` FOREIGN KEY (`santri_id`) REFERENCES `santri` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pencatatan_hafalan_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `pencatatan_ujian`
--
ALTER TABLE `pencatatan_ujian`
  ADD CONSTRAINT `pencatatan_ujian_ustadzah_id_foreign` FOREIGN KEY (`ustadzah_id`) REFERENCES `ustadzah` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `santri`
--
ALTER TABLE `santri`
  ADD CONSTRAINT `santri_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `santri_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `wali_santri`
--
ALTER TABLE `wali_santri`
  ADD CONSTRAINT `wali_santri_santri_id_foreign` FOREIGN KEY (`santri_id`) REFERENCES `santri` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
