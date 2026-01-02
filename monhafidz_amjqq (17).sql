-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jan 2026 pada 11.01
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.3.22

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
(12, 45, '2025-11-22', 'Sakit', 'sakit demam', '2025-11-22 01:28:16', '2025-11-22 01:28:16'),
(13, 43, '2025-11-22', 'Hadir', 'hadir', '2025-11-22 05:50:50', '2025-11-22 05:50:50'),
(14, 54, '2025-11-22', 'Hadir', 'hadir', '2025-11-22 05:51:57', '2025-11-22 05:51:57'),
(15, 44, '2025-11-22', 'Hadir', 'hadir', '2025-11-22 06:10:18', '2025-11-22 06:10:18'),
(16, 64, '2025-11-23', 'Hadir', 'hadir', '2025-11-22 06:12:28', '2025-11-22 06:12:28'),
(17, 30, '2025-11-22', 'Izin', 'ada keperluan keluarga', '2025-11-22 07:33:00', '2025-11-22 07:33:00'),
(18, 23, '2025-11-22', 'Izin', 'acara keluarga', '2025-11-25 08:54:28', '2025-11-25 08:54:28'),
(20, 24, '2025-12-19', 'Hadir', 'hadir', '2025-12-06 06:14:38', '2025-12-06 06:14:58'),
(21, 25, '2025-12-09', 'Alpa', 'alpa', '2025-12-09 05:19:46', '2025-12-09 05:19:46'),
(22, 28, '2025-12-09', 'Hadir', 'hadir', '2025-12-09 05:20:13', '2025-12-09 05:20:13'),
(23, 23, '2025-12-18', 'Alpa', 'encok', '2025-12-31 01:56:14', '2025-12-31 01:56:14'),
(24, 23, '2026-01-31', 'Alpa', 'tes', '2026-01-01 01:13:58', '2026-01-01 01:13:58'),
(25, 23, '2026-01-01', 'Alpa', 'izin om', '2026-01-01 01:22:23', '2026-01-01 01:22:23'),
(26, 23, '2026-01-02', 'Sakit', 'sakit ni org', '2026-01-01 01:22:28', '2026-01-01 01:22:28');

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
(1, 'ziyadah', 'Senin', '06:00:00', '08:00:00', 1, 2, '2025-10-25 01:26:48', '2025-10-25 07:37:10'),
(2, 'ziyadah', 'Selasa', '06:00:00', '08:00:00', 1, 2, '2025-10-25 01:26:48', '2025-10-25 01:26:48'),
(3, 'ziyadah', 'Rabu', '06:00:00', '08:00:00', 1, 2, '2025-10-25 01:26:48', '2025-10-25 01:26:48'),
(4, 'ziyadah', 'Kamis', '06:00:00', '08:00:00', 1, 2, '2025-10-25 01:26:48', '2025-10-25 01:26:48'),
(6, 'murajaah', 'Sabtu', '18:30:00', '20:00:00', 1, 2, '2025-10-25 01:26:48', '2025-10-25 01:26:48'),
(7, 'murajaah', 'Senin', '18:30:00', '20:00:00', 1, 2, '2025-10-25 01:26:48', '2025-10-25 07:36:53'),
(8, 'murajaah', 'Selasa', '18:30:00', '20:00:00', 1, 2, '2025-10-25 01:26:48', '2025-10-25 01:26:48'),
(9, 'murajaah', 'Rabu', '18:30:00', '20:00:00', 1, 2, '2025-10-25 01:26:48', '2025-10-25 01:26:48'),
(10, 'murajaah', 'Kamis', '18:30:00', '20:00:00', 1, 2, '2025-10-25 01:26:48', '2025-10-25 01:26:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_ujian`
--

CREATE TABLE `jadwal_ujian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `tempat` varchar(255) DEFAULT NULL,
  `is_bertahap` tinyint(1) NOT NULL DEFAULT 0,
  `tahap` varchar(100) DEFAULT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time DEFAULT NULL,
  `pembimbing_putra_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pembimbing_putri_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jenis_ujian` enum('tasmi','ujian_akhir','ziyadah','murajaah') NOT NULL DEFAULT 'tasmi',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jadwal_ujian`
--

INSERT INTO `jadwal_ujian` (`id`, `tanggal`, `tempat`, `is_bertahap`, `tahap`, `jam_mulai`, `jam_selesai`, `pembimbing_putra_id`, `pembimbing_putri_id`, `jenis_ujian`, `created_at`, `updated_at`) VALUES
(24, '2025-11-22', NULL, 0, NULL, '14:40:00', '16:40:00', 1, 2, 'tasmi', '2025-11-22 00:40:35', '2025-11-22 00:40:35'),
(25, '2025-11-22', NULL, 0, NULL, '21:47:00', '22:47:00', 1, 2, 'ujian_akhir', '2025-11-22 07:48:02', '2025-11-22 07:48:02'),
(26, '2025-11-24', NULL, 0, NULL, '10:30:00', '12:30:00', 1, 2, 'tasmi', '2025-11-23 20:30:23', '2025-11-23 20:30:23'),
(27, '2025-11-26', 'madrasah', 1, '1', '18:17:00', '19:17:00', 1, 2, 'ujian_akhir', '2025-11-26 04:17:09', '2025-11-26 04:17:09'),
(28, '2025-11-26', 'madrasah', 1, '1', '19:32:00', NULL, 1, 2, 'ujian_akhir', '2025-11-26 05:32:19', '2025-11-26 05:32:19'),
(29, '2025-11-26', 'madrasah2', 0, NULL, '19:37:00', NULL, 1, 2, 'ziyadah', '2025-11-26 05:38:01', '2025-11-26 05:38:01'),
(30, '2025-11-27', 'madrasah333', 1, '1', '19:46:00', '20:46:00', 1, 2, 'ujian_akhir', '2025-11-27 05:46:31', '2025-11-27 05:46:31'),
(31, '2025-11-27', 'tes', 1, '1', '19:48:00', '21:48:00', 1, 2, 'ujian_akhir', '2025-11-27 05:48:50', '2025-11-27 05:48:50'),
(32, '2025-12-02', 'madrasah 1', 0, NULL, '07:00:00', '21:00:00', 1, 2, 'murajaah', '2025-12-01 02:18:46', '2025-12-01 02:18:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_ujian_tasmi`
--

CREATE TABLE `jadwal_ujian_tasmi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `santri_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal` date NOT NULL,
  `tempat` varchar(255) DEFAULT NULL,
  `is_bertahap` tinyint(1) NOT NULL DEFAULT 0,
  `tahap` varchar(100) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `pembimbing_putra_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pembimbing_putri_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jenis_ujian` enum('tasmi','ujian_akhir','ziyadah','murajaah') NOT NULL DEFAULT 'tasmi',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jadwal_ujian_tasmi`
--

INSERT INTO `jadwal_ujian_tasmi` (`id`, `santri_id`, `tanggal`, `tempat`, `is_bertahap`, `tahap`, `jam_mulai`, `jam_selesai`, `pembimbing_putra_id`, `pembimbing_putri_id`, `jenis_ujian`, `created_at`, `updated_at`) VALUES
(1, 49, '2025-11-27', 'tes2', 1, '1', '19:49:00', '21:49:00', 1, 2, 'ziyadah', '2025-11-27 05:49:52', '2025-11-28 09:47:27'),
(2, 23, '2025-11-27', 'tes', 0, NULL, '19:51:00', NULL, 1, 2, 'ziyadah', '2025-11-27 05:51:08', '2025-11-27 05:51:08'),
(3, 60, '2025-11-28', 'teeee', 1, '1', '19:00:00', NULL, 1, 2, 'tasmi', '2025-11-28 08:20:32', '2025-11-28 08:20:32'),
(4, 59, '2026-12-01', 'tes', 1, '2', '16:39:00', '19:39:00', 1, 1, 'tasmi', '2025-12-31 01:40:01', '2025-12-31 01:40:43');

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
(22, 50, 1, '2025-11-04', 'Murajaah', 'al imran 20-30', 70.00, 68.00, 1, 'perbaiki lagi tajwidnya', 'harus diulang', '2025-11-22 03:01:36', '2025-12-05 16:27:11'),
(29, 23, 1, '2025-01-01', 'Ziyadah', 'al baqarah 20-40', 75.00, 75.00, 1, 'perbaiki tajwidnya terutama gunnah', 'lulus jayyid', '2025-12-05 16:37:03', '2026-01-01 03:18:28'),
(30, 52, 1, '2025-12-18', 'Ziyadah', 'Al-baqarah 1- 10', 80.00, 80.00, 2, NULL, 'lulus jayyid', '2025-12-07 07:08:39', '2025-12-07 07:08:39'),
(31, 48, 1, '2025-12-19', 'Ziyadah', 'Al baqarah 89-123', 80.00, 85.00, 1, 'lancar', 'lulus jayyid', '2025-12-09 00:54:25', '2025-12-09 00:54:25'),
(32, 57, 1, '2025-12-11', 'Ziyadah', 'al Furqon 1-30', 75.00, 78.00, 3, 'perbaiki lagi tajwidnya dalam pengucapan gunnah', 'lulus jayyid', '2025-12-09 05:03:22', '2025-12-09 05:03:22'),
(33, 49, 1, '2025-12-16', 'Ziyadah', 'Ali imran 20-40', 88.00, 90.00, 3, 'lancar', 'lulus mumtaz', '2025-12-09 05:05:29', '2025-12-09 05:05:29'),
(34, 58, 1, '2025-12-19', 'Murajaah', 'Attaubaah 56-70', 70.00, 85.00, 6, 'perbaiki lagi dalam pengucapan ikhfa', 'lulus jayyid', '2025-12-09 05:06:59', '2025-12-09 05:07:59'),
(35, 62, 1, '2025-12-19', 'Murajaah', 'attaubah 70-80', 60.00, 65.00, 6, 'perhatikan dalam pengucapan gunnah', 'harus diulang', '2025-12-09 05:09:14', '2025-12-09 05:09:14'),
(36, 38, 1, '2025-12-11', 'Ziyadah', 'Al-baqarah 1- 10', 70.00, 70.00, 1, 'perbaiki pengucapan gunnah', 'harus diulang', '2025-12-09 05:21:23', '2025-12-09 05:21:23'),
(37, 76, 1, '2025-12-27', 'Murajaah', 'Attaubaah 56-70', 80.00, 89.00, 6, 'lancar', 'lulus jayyid', '2025-12-09 05:22:28', '2025-12-09 05:22:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pencatatan_ujian`
--

CREATE TABLE `pencatatan_ujian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ustadzah_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `santri_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jenis_ujian` enum('ujian_akhir','ziyadah','murajaah') NOT NULL DEFAULT 'ujian_akhir',
  `semester_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jadwal_ujian_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nilai_tajwid` int(11) DEFAULT NULL,
  `nilai_kelancaran` int(11) DEFAULT NULL,
  `kesalahan` int(11) DEFAULT NULL,
  `nilai_akhir` int(11) DEFAULT NULL,
  `nilai_ujian` decimal(5,2) DEFAULT NULL,
  `status_ujian` enum('belum_diuji','lulus','remidi') NOT NULL DEFAULT 'lulus',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pencatatan_ujian`
--

INSERT INTO `pencatatan_ujian` (`id`, `ustadzah_id`, `tanggal`, `santri_id`, `jenis_ujian`, `semester_id`, `jadwal_ujian_id`, `nilai_tajwid`, `nilai_kelancaran`, `kesalahan`, `nilai_akhir`, `nilai_ujian`, `status_ujian`, `created_at`, `updated_at`) VALUES
(20, NULL, '2025-11-25', 23, 'ziyadah', 1, NULL, 88, 78, 2, 88, NULL, 'lulus', '2025-11-25 08:17:35', '2025-12-09 05:23:45'),
(21, NULL, '2025-11-25', 24, 'ziyadah', 1, NULL, 88, 90, 2, 90, NULL, 'lulus', '2025-11-25 08:28:32', '2025-11-29 00:01:28'),
(23, NULL, '2025-11-29', 25, 'murajaah', 1, NULL, 88, 89, 2, 88, NULL, 'lulus', '2025-11-29 00:28:45', '2025-12-09 05:24:29'),
(26, NULL, '2025-12-15', 48, 'ziyadah', 1, NULL, 75, 80, 3, 78, NULL, 'lulus', '2025-12-09 00:57:06', '2025-12-09 00:57:06'),
(27, NULL, '2025-12-21', 45, 'ziyadah', 1, NULL, 80, 80, 4, 80, NULL, 'lulus', '2025-12-09 05:10:45', '2025-12-09 05:10:45'),
(28, NULL, '2025-12-25', 42, 'ziyadah', 1, NULL, 90, 90, 2, 90, NULL, 'lulus', '2025-12-09 05:11:39', '2025-12-09 05:11:39'),
(29, NULL, '2025-12-10', 59, 'murajaah', 1, NULL, 85, 87, 2, 86, NULL, 'lulus', '2025-12-09 05:12:25', '2025-12-09 05:12:25'),
(30, NULL, '2025-12-11', 60, 'murajaah', 1, NULL, 80, 85, 2, 83, NULL, 'lulus', '2025-12-09 05:13:14', '2025-12-09 05:13:14'),
(31, NULL, '2025-12-26', 52, 'ziyadah', 1, NULL, 78, 78, 4, 78, NULL, 'lulus', '2025-12-09 05:14:19', '2025-12-09 05:14:19'),
(32, NULL, '2025-12-29', 49, 'ziyadah', 1, NULL, 93, 92, 3, 93, NULL, 'lulus', '2025-12-09 05:17:20', '2025-12-09 05:17:20'),
(33, NULL, '2025-12-25', 37, 'ziyadah', 1, NULL, 80, 75, 2, 78, NULL, 'lulus', '2025-12-09 05:23:26', '2025-12-09 05:23:26'),
(34, NULL, '2025-12-19', 76, 'murajaah', 1, NULL, 80, 89, 5, 85, NULL, 'lulus', '2025-12-09 05:24:12', '2025-12-09 05:24:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perizinan`
--

CREATE TABLE `perizinan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `santri_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Hadir','Izin','Alpa','Sakit') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Hadir',
  `alasan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bukti_izin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `perizinan`
--

INSERT INTO `perizinan` (`id`, `santri_id`, `tanggal`, `status`, `alasan`, `created_at`, `updated_at`, `bukti_izin`) VALUES
(3, 23, '2026-01-02', 'Izin', 'izin2', '2026-01-01 03:32:57', '2026-01-01 03:32:57', 'qLZXB6tfU8HIDhIFkFFFByMk2h8ajQe2XV3vFUyP.jpg');

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
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `santri`
--

INSERT INTO `santri` (`id`, `nama_lengkap`, `jenis_kelamin`, `nik`, `tanggal_lahir`, `alamat_lengkap`, `no_hp`, `semester_id`, `total_juz_tercapai`, `status_santri`, `created_at`, `updated_at`, `user_id`, `foto`) VALUES
(23, 'kurniawan', 'Laki-laki', '3278867100730411', '2006-05-09', 'Tasikmalaya', '08564441138', 3, 25, 'Lulus', '2025-11-22 01:35:22', '2026-01-01 03:26:58', 7, 'gYjFbKNqml00lG7dLS8qtxfVcgnOlewFGW6rBglc.jpg'),
(24, 'nazar', 'Laki-laki', '3278713909932010', '2012-02-18', 'Sambong pari', '08131492103', 1, 20, 'Aktif', '2025-11-22 01:35:22', '2025-12-09 04:40:53', 8, NULL),
(25, 'ropi', 'Laki-laki', '3278683072452891', '2009-02-07', 'Tasikmalaya - Kecamatan 14', '08581615167', 1, 11, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 9, NULL),
(26, 'nurman', 'Laki-laki', '3278801759597081', '2005-11-19', 'Tasikmalaya - Kecamatan 2', '08168847130', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 10, NULL),
(27, 'haikal', 'Laki-laki', '3278139635219532', '2011-09-16', 'Tasikmalaya - Kecamatan 9', '08874192544', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 11, NULL),
(28, 'putra', 'Laki-laki', '3278591410943610', '2011-09-21', 'Tasikmalaya - Kecamatan 12', '08146101412', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 12, NULL),
(29, 'rahmat', 'Laki-laki', '3278904930280442', '2008-04-05', 'Tasikmalaya - Kecamatan 1', '08475868479', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 13, NULL),
(30, 'jilan', 'Laki-laki', '3278430199505807', '2010-05-16', 'Tasikmalaya - Kecamatan 13', '08956909941', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 14, NULL),
(31, 'asgar', 'Laki-laki', '3278549077626007', '2008-10-31', 'Tasikmalaya - Kecamatan 11', '08557644260', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 15, NULL),
(32, 'palah', 'Laki-laki', '3278362524184540', '2010-11-23', 'Tasikmalaya - Kecamatan 14', '08349357867', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 16, NULL),
(33, 'andi', 'Laki-laki', '3278971317879598', '2008-02-18', 'Tasikmalaya - Kecamatan 7', '08790654821', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 17, NULL),
(34, 'lutfi', 'Laki-laki', '3278306082653243', '2006-12-12', 'Tasikmalaya - Kecamatan 13', '08567610598', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 18, NULL),
(35, 'haisyam', 'Laki-laki', '3278197555502648', '2007-06-17', 'Tasikmalaya - Kecamatan 14', '08828918783', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 19, NULL),
(36, 'rifki', 'Laki-laki', '3278755395514686', '2011-04-30', 'Tasikmalaya - Kecamatan 12', '08300418244', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 20, NULL),
(37, 'habib', 'Laki-laki', '3278547821718482', '2007-03-27', 'Tasikmalaya - Kecamatan 11', '08350975474', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 21, NULL),
(38, 'asep', 'Laki-laki', '3278994026626770', '2006-05-17', 'Tasikmalaya - Kecamatan 10', '08411594849', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 22, NULL),
(39, 'nina', 'Perempuan', '3278311840212954', '2005-09-22', 'Tasikmalaya - Kecamatan 8', '08167078600', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 23, NULL),
(40, 'lia', 'Perempuan', '3278972229247655', '2009-01-16', 'Tasikmalaya - Kecamatan 4', '08964782561', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 24, NULL),
(41, 'nihaya', 'Perempuan', '3278828272346346', '2011-12-09', 'Tasikmalaya - Kecamatan 8', '08879351679', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 25, NULL),
(42, 'balqis', 'Perempuan', '3278873176581417', '2005-03-08', 'Tasikmalaya - Kecamatan 9', '08275211928', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 26, NULL),
(43, 'madinah', 'Perempuan', '3278342558016326', '2011-09-02', 'Tasikmalaya - Kecamatan 2', '08341404860', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 27, NULL),
(44, 'kinara', 'Perempuan', '3278772155679994', '2009-01-08', 'Tasikmalaya - Kecamatan 13', '08231286874', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 28, NULL),
(45, 'puja', 'Perempuan', '3278712612816854', '2008-08-27', 'Tasikmalaya - Kecamatan 1', '08537283523', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 29, NULL),
(46, 'syifa', 'Perempuan', '3278626021051824', '2005-06-01', 'Tasikmalaya - Kecamatan 6', '08295002757', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 30, NULL),
(47, 'rahma', 'Perempuan', '3278741532235382', '2009-04-21', 'Tasikmalaya - Kecamatan 13', '08504680369', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 31, NULL),
(48, 'bunga', 'Perempuan', '3278931612877532', '2008-04-02', 'Tasikmalaya - Kecamatan 8', '08970074458', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 32, NULL),
(49, 'andin', 'Perempuan', '3278515527999833', '2007-04-27', 'Tasikmalaya - Kecamatan 2', '08976947595', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 33, NULL),
(50, 'hani', 'Perempuan', '3278995550624022', '2010-04-01', 'Tasikmalaya - Kecamatan 14', '08415601796', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 34, NULL),
(51, 'intan lulu', 'Perempuan', '3278129099619275', '2008-08-24', 'Tasikmalaya - Kecamatan 1', '08447196825', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 35, NULL),
(52, 'amel', 'Perempuan', '3278921693679164', '2012-05-08', 'Tasikmalaya - Kecamatan 9', '08756174131', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 36, NULL),
(53, 'salbi', 'Perempuan', '3278515570970709', '2007-03-17', 'Tasikmalaya - Kecamatan 14', '08252840895', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 37, NULL),
(54, 'riha', 'Perempuan', '3278587534510477', '2012-02-17', 'Tasikmalaya - Kecamatan 1', '08862014160', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 38, NULL),
(55, 'musliamh', 'Perempuan', '3278653039054050', '2011-07-14', 'Tasikmalaya - Kecamatan 11', '08595002544', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 39, NULL),
(56, 'nayla', 'Perempuan', '3278795752171168', '2008-01-13', 'Tasikmalaya - Kecamatan 11', '08720125991', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 40, NULL),
(57, 'nita', 'Perempuan', '3278490543975117', '2007-10-02', 'Tasikmalaya - Kecamatan 15', '08183719698', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 41, NULL),
(58, 'iis', 'Perempuan', '3278989032702307', '2011-10-13', 'Tasikmalaya - Kecamatan 3', '08882322180', 3, 6, 'Aktif', '2025-11-22 01:35:22', '2025-12-09 05:07:59', 42, NULL),
(59, 'ai rini', 'Perempuan', '3278125235913796', '2007-07-31', 'Tasikmalaya - Kecamatan 15', '08168080349', 3, 10, 'Aktif', '2025-11-22 01:35:22', '2025-11-21 21:44:00', 43, NULL),
(60, 'ai lela', 'Perempuan', '3278488071863221', '2006-05-02', 'Tasikmalaya - Kecamatan 12', '08982413226', 3, 5, 'Aktif', '2025-11-22 01:35:22', '2025-11-21 21:49:27', 44, NULL),
(61, 'neti', 'Perempuan', '3278482600601940', '2012-05-14', 'Tasikmalaya - Kecamatan 7', '08638896450', 3, 6, 'Aktif', '2025-11-22 01:35:22', '2025-12-09 05:06:59', 45, NULL),
(62, 'sinta', 'Perempuan', '3278171662656969', '2011-06-10', 'Tasikmalaya - Kecamatan 10', '08304478789', 3, 6, 'Aktif', '2025-11-22 01:35:22', '2025-12-09 05:09:14', 46, NULL),
(63, 'rani', 'Perempuan', '3278953004410310', '2006-12-29', 'Tasikmalaya - Kecamatan 14', '08620273341', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 47, NULL),
(64, 'nasywa', 'Perempuan', '3278940053225349', '2011-12-28', 'Tasikmalaya - Kecamatan 12', '08598035626', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 48, NULL),
(65, 'lisna', 'Perempuan', '3278373223183267', '2010-10-01', 'Tasikmalaya - Kecamatan 12', '08147316288', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 49, NULL),
(66, 'lilih', 'Perempuan', '3278293167973553', '2007-11-09', 'Tasikmalaya - Kecamatan 1', '08251963080', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 50, NULL),
(67, 'niza', 'Perempuan', '3278862057714554', '2007-03-15', 'Tasikmalaya - Kecamatan 10', '08461784138', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 51, NULL),
(68, 'fatiha', 'Perempuan', '3278444200592365', '2005-04-18', 'Tasikmalaya - Kecamatan 2', '08125250400', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 52, NULL),
(69, 'tiya', 'Perempuan', '3278461472454635', '2006-10-10', 'Tasikmalaya - Kecamatan 13', '08395775390', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 53, NULL),
(70, 'imas', 'Perempuan', '3278867570731970', '2009-12-09', 'Tasikmalaya - Kecamatan 10', '08846666355', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 54, NULL),
(71, 'isma', 'Perempuan', '3278250418598039', '2005-11-04', 'Tasikmalaya - Kecamatan 10', '08753793986', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 55, NULL),
(72, 'husni', 'Laki-laki', '3278752373048383', '2007-02-27', 'Tasikmalaya - Kecamatan 11', '08341690071', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 56, NULL),
(73, 'rizal', 'Laki-laki', '3278276005232228', '2006-03-28', 'Tasikmalaya - Kecamatan 14', '08740986480', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 57, NULL),
(74, 'zaki', 'Laki-laki', '3278332350847257', '2008-07-07', 'Tasikmalaya - Kecamatan 11', '08136477625', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 58, NULL),
(75, 'teguh', 'Laki-laki', '3278464866545688', '2008-02-05', 'Tasikmalaya - Kecamatan 7', '08282031933', 1, 0, 'Aktif', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 59, NULL),
(76, 'basith', 'Laki-laki', '3278946351974642', '2009-10-18', 'Tasikmalaya - Kecamatan 3', '08819098956', 3, 6, 'Aktif', '2025-11-22 01:35:22', '2025-12-09 05:22:28', 60, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `semester`
--

CREATE TABLE `semester` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_semester` varchar(255) NOT NULL,
  `jenis_hafalan` enum('ziyadah','murajaah') NOT NULL DEFAULT 'ziyadah',
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

INSERT INTO `semester` (`id`, `nama_semester`, `jenis_hafalan`, `tahun_ajaran`, `periode_mulai`, `periode_selesai`, `status`, `created_at`, `updated_at`) VALUES
(1, 'semester 1', 'ziyadah', '2025', '2025-01-01', '2025-06-30', 'Aktif', '2025-10-25 04:15:44', '2025-12-09 04:55:44'),
(3, 'semester 2', 'ziyadah', '2025/2026', '2025-07-01', '2025-12-30', 'Aktif', '2025-11-01 02:07:33', '2025-12-09 04:53:00'),
(4, 'semester 3', 'ziyadah', '2026/2027', '2026-01-01', '2026-06-30', 'Aktif', '2025-11-01 02:08:04', '2025-12-09 04:53:17'),
(5, 'semester 4', 'ziyadah', '2026/2027', '2026-07-01', '2026-12-30', 'Aktif', '2025-11-15 02:51:23', '2025-12-09 04:53:38'),
(6, 'semester 5', 'ziyadah', '2027/2028', '2027-01-01', '2027-06-30', 'Aktif', '2025-11-18 09:04:33', '2025-12-09 04:55:09'),
(7, 'semester 6', 'ziyadah', '2027/2028', '2027-07-01', '2027-12-30', 'Aktif', '2025-11-18 09:05:30', '2025-12-09 04:55:23'),
(8, 'semester 1', 'murajaah', '2025', '2025-01-01', '2025-06-30', 'Aktif', '2025-11-18 09:39:05', '2025-12-09 04:58:25'),
(9, 'semester 2', 'murajaah', '2025/2026', '2025-07-01', '2025-12-30', 'Aktif', '2025-11-18 09:55:03', '2025-12-09 04:57:46'),
(10, 'semester 3', 'murajaah', '2026', '2026-01-01', '2026-06-30', 'Aktif', '2025-11-18 09:55:31', '2025-12-09 04:58:43');

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
('brOSTPl3QaP8ja5szHJzBSrV50pbfKNk4083wo8Q', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicGpHaTd6TmNxMksyc2k2OXZDWXhlTUV4TDZRd2owZ2NvbmpsZDVPUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hYnNlbnNpIjt9czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjc7fQ==', 1767263578),
('CKSuTRGO2dQYXNCMUVhPP9KKnTzUMyZg00tigFIs', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidFFVZjlpS1VrdU9xYnZVMDRhS0pobmk4dWJZZmVOajh0cUpGNFQ5TyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hYnNlbnNpIjt9czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1767263584);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujian_tasmi`
--

CREATE TABLE `ujian_tasmi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `santri_id` bigint(20) UNSIGNED DEFAULT NULL,
  `semester_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ustadzah_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jadwal_ujian_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal_tasmi` date DEFAULT NULL,
  `juz_yang_ditasmi` varchar(225) DEFAULT NULL,
  `status_ujian` enum('belum_diuji','selesai','lancar','remidi') NOT NULL DEFAULT 'selesai',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ujian_tasmi`
--

INSERT INTO `ujian_tasmi` (`id`, `tanggal`, `santri_id`, `semester_id`, `ustadzah_id`, `jadwal_ujian_id`, `tanggal_tasmi`, `juz_yang_ditasmi`, `status_ujian`, `created_at`, `updated_at`, `catatan`) VALUES
(7, '2025-12-10', 48, NULL, 2, 26, '2025-11-24', 'juz 1-10', 'selesai', '2025-11-23 20:31:32', '2025-12-08 21:50:04', 'lancar'),
(8, '2025-11-26', 48, 1, 2, NULL, '2025-11-26', 'juz 11-20', 'selesai', '2025-11-26 06:28:14', '2025-12-08 21:49:03', 'lancar'),
(9, '2025-11-29', 48, NULL, 2, NULL, '2025-11-28', 'juz 21-30', 'selesai', '2025-11-28 16:44:51', '2025-12-08 21:54:54', 'lancar'),
(10, '2025-12-27', 59, NULL, 2, NULL, '2025-12-26', 'juz 1-10', 'selesai', '2025-12-09 01:00:27', '2025-12-09 01:00:27', 'lancar'),
(11, '2025-12-11', 23, NULL, 1, NULL, '2025-12-11', 'juz 1-10', 'selesai', '2025-12-09 01:05:07', '2025-12-09 01:05:07', 'lancar'),
(12, '2025-12-27', 58, NULL, 2, NULL, '2025-12-27', 'juz 1-10', 'selesai', '2025-12-09 05:15:55', '2025-12-09 05:15:55', 'lancar'),
(13, '2025-12-12', 23, NULL, 1, NULL, '2025-12-12', 'juz 11-20', 'selesai', '2025-12-09 05:25:09', '2025-12-09 05:25:09', 'lancar'),
(14, NULL, 38, NULL, 1, NULL, '2025-12-31', 'tes', 'selesai', '2025-12-31 01:42:37', '2025-12-31 01:42:37', 'tes'),
(15, NULL, 76, NULL, 1, NULL, '2026-01-01', 'tes', 'selesai', '2025-12-31 01:42:56', '2025-12-31 01:43:13', 'tes');

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
  `status` enum('aktif','diblokir','nonaktif','pending') NOT NULL DEFAULT 'aktif',
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `role`, `password`, `created_at`, `updated_at`, `status`, `foto`) VALUES
(1, 'Administrator', 'admin', 'admin@gmail.com', NULL, 'admin', '$2y$12$t6kRw/5Md5NlOkTHj68RaO90kuMeJS82shzjt8HCy/JgxSkcDM/4K', '2025-10-24 20:47:10', '2025-12-01 08:33:14', 'aktif', '1764603194_WhatsApp Image 2025-11-24 at 19.08.04.jpeg'),
(2, 'Ustadz Sabiq Mujahid', 'ustadsabiq', 'ustadsabiq@gmail.com', NULL, 'ustad', '$2y$12$zwbQb4FR9K59nCHnBN6tjugdQC38.nZ9M2JAjHJ0rHAk04gmFEtYi', '2025-10-24 20:47:10', '2025-12-08 23:17:01', 'aktif', '1765261021_Screenshot 2025-11-22 121018.jpeg'),
(3, 'Ustadzah Nuraisyah', 'ustadnuraisyah', 'ustadzahnuraisyah@gmail.com', NULL, 'ustad', '$2y$12$UO653EhYlnYjS87I8FktpuYETEnVyg4KNKbtWpMl//aybj.Lf8Qdq', '2025-10-24 20:47:11', '2025-12-09 22:49:01', 'aktif', '1764603268_WhatsApp Image 2025-11-24 at 10.51.59 (1).jpeg'),
(6, 'santri baru', 'santri', 'santri369@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-15 00:42:29', '2025-11-15 00:42:29', 'aktif', NULL),
(7, 'kurniawan', 'kurniawan', 'kurniawan609@gmail.com', NULL, 'santri', '$2y$12$3ZvQoKTHl61O2fWA10Vb9Op.QZhtkiOksmMw/fnDBPNQy37RclnzG', '2025-11-22 01:35:21', '2025-12-08 23:51:42', 'aktif', NULL),
(8, 'nazar', 'nazar', 'nazar594@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(9, 'ropi', 'ropi', 'ropi286@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(10, 'nurman', 'nurman', 'nurman314@gmail.com', NULL, 'santri', '$2y$12$Gl1.pKdWK/MkM2hD0ScZien0nSn221NA.modI7cJBnOe8z/9C6xza', '2025-11-22 01:35:21', '2025-12-05 17:38:36', 'aktif', NULL),
(11, 'haikal', 'haikal', 'haikal507@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(12, 'putra', 'putra', 'putra390@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(13, 'rahmat', 'rahmat', 'rahmat245@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(14, 'jilan', 'jilan', 'jilan459@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(15, 'asgar', 'asgar', 'asgar516@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(16, 'palah', 'palah', 'palah488@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(17, 'andi', 'andi', 'andi759@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(18, 'lutfi', 'lutfi', 'lutfi406@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(19, 'haisyam', 'haisyam', 'haisyam507@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(20, 'rifki', 'rifki', 'rifki230@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(21, 'habib', 'habib', 'habib868@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(22, 'asep', 'asep', 'asep861@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(23, 'nina', 'nina', 'nina291@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(24, 'lia', 'lia', 'lia413@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(25, 'nihaya', 'nihaya', 'nihaya907@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(26, 'balqis', 'balqis', 'balqis362@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(27, 'madinah', 'madinah', 'madinah797@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(28, 'kinara', 'kinara', 'kinara494@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(29, 'puja', 'puja', 'puja467@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(30, 'syifa', 'syifa', 'syifa400@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(31, 'rahma', 'rahma', 'rahma856@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(32, 'bunga', 'bunga', 'bunga851@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(33, 'andin', 'andin', 'andin301@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(34, 'hani', 'hani', 'hani588@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(35, 'intan lulu', 'intanlulu', 'intanlulu336@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(36, 'amel', 'amel', 'amel828@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(37, 'salbi', 'salbi', 'salbi518@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(38, 'riha', 'riha', 'riha633@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(39, 'musliamh', 'musliamh', 'musliamh965@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(40, 'nayla', 'nayla', 'nayla886@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(41, 'nita', 'nita', 'nita485@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(42, 'iis', 'iis', 'iis771@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(43, 'ai rini', 'airini', 'airini343@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(44, 'ai lela', 'ailela', 'ailela996@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(45, 'neti', 'neti', 'neti127@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(46, 'sinta', 'sinta', 'sinta343@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(47, 'rani', 'rani', 'rani694@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(48, 'nasywa', 'nasywa', 'nasywa711@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(49, 'lisna', 'lisna', 'lisna858@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(50, 'lilih', 'lilih', 'lilih397@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(51, 'niza', 'niza', 'niza177@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(52, 'fatiha', 'fatiha', 'fatiha517@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(53, 'tiya', 'tiya', 'tiya308@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(54, 'imas', 'imas', 'imas716@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(55, 'isma', 'isma', 'isma413@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(56, 'husni', 'husni', 'husni319@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:21', '2025-11-22 01:35:21', 'aktif', NULL),
(57, 'rizal', 'rizal', 'rizal477@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 'aktif', NULL),
(58, 'zaki', 'zaki', 'zaki559@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 'aktif', NULL),
(59, 'teguh', 'teguh', 'teguh633@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 'aktif', NULL),
(60, 'basith', 'basith', 'basith855@gmail.com', NULL, 'santri', '$2y$12$4yS/zW9ubf/0IKKIKhytOuc6ScGs7atWXR0BLrR6q.aR3RikEUwI.', '2025-11-22 01:35:22', '2025-11-22 01:35:22', 'aktif', NULL),
(115, 'dodi', 'dodi', 'dodi617@gmail.com', NULL, 'walisantri', '$2y$12$XOusV/AuCbBxFZhTJzm7RuI2Bq1nHE9aR82MjmtqclIrRq2xLMz3q', '2025-11-21 23:54:04', '2025-12-09 00:57:43', 'aktif', '1765267063_1764603120_WhatsApp Image 2025-11-24 at 10.51.59 (1).jpeg'),
(116, 'ridwan', 'ridwan', 'ridwan858@gmail.com', NULL, 'walisantri', '$2y$12$o60DUPD0WjY/H/kE1pNOHeyrw..D1ExuS1/FWzKKCAz9iAdOpdA/S', '2025-11-21 23:55:52', '2025-11-21 23:55:52', 'aktif', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ustadzah`
--

CREATE TABLE `ustadzah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
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

INSERT INTO `ustadzah` (`id`, `user_id`, `nama_lengkap`, `jenis_kelamin`, `nik`, `tanggal_lahir`, `alamat_lengkap`, `no_hp`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Ustadz Sabiq mujahid', 'Laki-laki', '12321321456789', '2016-10-13', 'Tasikmalaya', '081220335494', 'Aktif', NULL, '2025-12-09 04:37:21'),
(2, 3, 'Ustadzah Nuraisyah', 'Perempuan', '12312321312', '1990-04-06', 'Tasikmalaya', '0895364633907', 'Aktif', NULL, '2025-12-09 04:39:18');

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `wali_santri`
--

INSERT INTO `wali_santri` (`id`, `nama_lengkap`, `jenis_kelamin`, `nik`, `tanggal_lahir`, `wali_sebagai`, `santri_id`, `alamat_lengkap`, `no_hp`, `status_wali`, `created_at`, `updated_at`, `user_id`) VALUES
(55, 'dodi', 'Laki-laki', '9923132', '2025-11-22', 'ayah', 23, 'Tasikmalaya', '082115917198', 'Aktif', '2025-11-21 23:54:03', '2025-12-09 04:43:08', 115),
(56, 'ridwan', 'Laki-laki', '348388888', '2025-11-22', 'ayah', 24, 'indo', '082262921239', 'Aktif', '2025-11-21 23:55:51', '2025-12-09 04:43:42', 116);

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
  ADD KEY `jadwal_ujian_pembimbing_putra_id_foreign` (`pembimbing_putra_id`),
  ADD KEY `jadwal_ujian_pembimbing_putri_id_foreign` (`pembimbing_putri_id`);

--
-- Indeks untuk tabel `jadwal_ujian_tasmi`
--
ALTER TABLE `jadwal_ujian_tasmi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_ujian_pembimbing_putra_id_foreign` (`pembimbing_putra_id`),
  ADD KEY `jadwal_ujian_pembimbing_putri_id_foreign` (`pembimbing_putri_id`),
  ADD KEY `jadwal_ujian_tasmi_santri_id_foreign` (`santri_id`);

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
  ADD KEY `pencatatan_ujian_ustadzah_id_foreign` (`ustadzah_id`),
  ADD KEY `fk_pencatatan_ujian_santri` (`santri_id`),
  ADD KEY `fk_pencatatan_ujian_semester` (`semester_id`);

--
-- Indeks untuk tabel `perizinan`
--
ALTER TABLE `perizinan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `ujian_tasmi_santri_id_foreign` (`santri_id`),
  ADD KEY `ujian_tasmi_semester_id_foreign` (`semester_id`);

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
  ADD UNIQUE KEY `ustadzah_nik_unique` (`nik`),
  ADD KEY `fk_ustadzah_user` (`user_id`);

--
-- Indeks untuk tabel `wali_santri`
--
ALTER TABLE `wali_santri`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wali_santri_nik_unique` (`nik`),
  ADD KEY `wali_santri_santri_id_foreign` (`santri_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `jadwal_ujian_tasmi`
--
ALTER TABLE `jadwal_ujian_tasmi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `pencatatan_ujian`
--
ALTER TABLE `pencatatan_ujian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `perizinan`
--
ALTER TABLE `perizinan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `santri`
--
ALTER TABLE `santri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT untuk tabel `semester`
--
ALTER TABLE `semester`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `ujian_tasmi`
--
ALTER TABLE `ujian_tasmi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT untuk tabel `ustadzah`
--
ALTER TABLE `ustadzah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `wali_santri`
--
ALTER TABLE `wali_santri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

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
  ADD CONSTRAINT `jadwal_ujian_pembimbing_putri_id_foreign` FOREIGN KEY (`pembimbing_putri_id`) REFERENCES `ustadzah` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `jadwal_ujian_tasmi`
--
ALTER TABLE `jadwal_ujian_tasmi`
  ADD CONSTRAINT `jadwal_ujian_tasmi_santri_id_foreign` FOREIGN KEY (`santri_id`) REFERENCES `santri` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_pencatatan_ujian_santri` FOREIGN KEY (`santri_id`) REFERENCES `santri` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pencatatan_ujian_semester` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pencatatan_ujian_ustadzah_id_foreign` FOREIGN KEY (`ustadzah_id`) REFERENCES `ustadzah` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `santri`
--
ALTER TABLE `santri`
  ADD CONSTRAINT `santri_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `santri_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ujian_tasmi`
--
ALTER TABLE `ujian_tasmi`
  ADD CONSTRAINT `ujian_tasmi_santri_id_foreign` FOREIGN KEY (`santri_id`) REFERENCES `santri` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ujian_tasmi_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ustadzah`
--
ALTER TABLE `ustadzah`
  ADD CONSTRAINT `fk_ustadzah_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `wali_santri`
--
ALTER TABLE `wali_santri`
  ADD CONSTRAINT `fk_wali_santri_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wali_santri_santri_id_foreign` FOREIGN KEY (`santri_id`) REFERENCES `santri` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
