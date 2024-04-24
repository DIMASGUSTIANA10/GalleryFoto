-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Apr 2024 pada 13.39
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ff`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin_telp` varchar(20) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_address` text NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`admin_id`, `admin_name`, `username`, `password`, `admin_telp`, `admin_email`, `admin_address`, `role`) VALUES
(2, 'irawan', 'irawan', 'adminirawan', '085774137284', 'irawan@gmail.com', 'Jl. Raya Kadu Seungit', 'user'),
(3, 'Diana', 'diana', '1234', '085788992919', 'Diana@gmail.com', 'Suka Seneng Cikeusik', 'user'),
(4, 'Hazwan', 'hazwan', '123', '085787778811', 'hazwan@gmail.com', 'Cikeusik Pandeglang', 'user'),
(6, 'admin', 'Admin', 'semuasama', 'semuasama', 'admin@gmail.com', 'semuasama', 'admin'),
(7, 'Riyad', 'riyad', '12345', '023', 'riyadsolihagisni@gmail.com', 'Merauke', 'user'),
(9, 'Agus', 'agus kopling', 'agusaja', '09965559996', 'agus@gmail.com', 'Batu', 'user'),
(11, 'Padil', 'padil', 'padil', '09965559996', 'aa@gmail.com', 'Jauh', 'user'),
(12, 'Singa', 'singa', 'sinaja', '03654244', 'aa@gmail.com', 'Batu', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_category`
--

CREATE TABLE `tb_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(25) NOT NULL,
  `category_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_category`
--

INSERT INTO `tb_category` (`category_id`, `category_name`, `category_photo`) VALUES
(14, 'Perjalanan', NULL),
(15, 'Bawah Air', NULL),
(16, 'Hewan Peliharaan', NULL),
(17, 'Satwa Liar', NULL),
(19, 'Olahraga', NULL),
(20, 'Fashion', NULL),
(21, 'Seni Rupa', NULL),
(23, 'Arsitektur', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_image`
--

CREATE TABLE `tb_image` (
  `image_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `image_description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `image_status` tinyint(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `likes` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_image`
--

INSERT INTO `tb_image` (`image_id`, `category_id`, `category_name`, `admin_id`, `admin_name`, `image_name`, `image_description`, `image`, `image_status`, `date_created`, `likes`) VALUES
(34, 23, 'Arsitektur', 2, 'Irawan', 'Merancang Kota Modern', '<p>Foto ini menggambarkan kegiatan desain perencanaan membuat kota yang modern berdasarkan ramah lingkungan</p>\r\n', 'foto1701141777.jpg', 1, '2023-11-28 04:58:19', 0),
(35, 23, 'Arsitektur', 2, 'Irawan', 'Merancang Perumahan Elit', '<p>Foto ini menggambarkan kegiatan desain perencanaan membuat Rumah yang modern, nyaman untuk keluarga</p>\r\n', 'foto1701144257.jpg', 1, '2023-11-28 04:04:17', 0),
(40, 14, 'Perjalanan', 4, 'Hazwan', 'Pantai Carita', 'Pantai Carita merupakan objek wisata yang terletak di Kabupaten Pandeglang. Fasilitas di Pantai Carita cukup lengkap yaitu Banana boat, snorkling, papan seluncur, diving, dan fasilitas lainnya. Banyak juga penginapan-penginapan sepanjang pesisir pantai dan atau rumah-rumah warga yang difungsikan untuk penginapan.', 'foto1701150076.jpg', 1, '2023-11-28 05:41:16', 0),
(41, 14, 'Perjalanan', 4, 'Hazwan', 'Curug Putri', 'Curug Putri Carita Pandeglang ini unik banget karena terbentuk dari lava yang membeku dan kemudian menjadi aliran sungai dengan batuan cantik.', 'foto1701150304.jpg', 1, '2023-11-28 05:45:04', 0),
(53, 15, 'Bawah Air', 9, 'agus kopling', 'bawah air', 'apaja', 'foto1710768573.jpg', 1, '2024-03-18 13:29:33', 0),
(54, 15, 'Bawah Air', 9, 'agus kopling', 'bawah air', 'apalah', 'foto1710768594.jpg', 1, '2024-03-18 13:29:54', 0),
(55, 20, 'Fashion', 9, 'agus kopling', 'fashion', 'outpit', 'foto1710768619.jpg', 1, '2024-03-18 13:30:19', 0),
(56, 20, 'Fashion', 9, 'agus kopling', 'fashion', 'gatau', 'foto1710768643.jpg', 1, '2024-03-18 13:30:43', 0),
(57, 21, 'Seni Rupa', 9, 'agus kopling', 'seni rupa', 'pppp', 'foto1710768690.jpg', 1, '2024-03-18 13:31:30', 0),
(58, 21, 'Seni Rupa', 9, 'agus kopling', 'seni rupa', 'aw', 'foto1710768720.jpg', 1, '2024-03-18 13:32:00', 0),
(59, 23, 'Arsitektur', 9, 'agus kopling', 'arsitektur rumah', 'gambaran rumah', 'foto1710768764.jpg', 1, '2024-03-18 13:32:44', 0),
(60, 19, 'Olahraga', 9, 'agus kopling', 'sepak bola', 'messi vs ronaldo', 'foto1710768819.jpg', 1, '2024-03-18 13:33:39', 0),
(61, 19, 'Olahraga', 9, 'agus kopling', 'berenang', 'berenang', 'foto1710768857.jpg', 1, '2024-03-18 13:34:17', 0),
(62, 19, 'Olahraga', 9, 'agus kopling', 'bola basket', 'olahraga bola basket', 'foto1710768895.png', 1, '2024-03-18 13:34:55', 0),
(63, 19, 'Olahraga', 9, 'agus kopling', 'bola volly', 'olahraga bola volly', 'foto1710768927.png', 1, '2024-03-18 13:35:27', 0),
(64, 14, 'Perjalanan', 9, 'agus kopling', 'perjalanan', 'pemandangan', 'foto1710769072.jpg', 1, '2024-03-18 13:37:52', 0),
(65, 14, 'Perjalanan', 9, 'agus kopling', 'perjalanan', 'aa', 'foto1710769094.jpg', 1, '2024-03-18 13:38:14', 0),
(66, 17, 'Satwa Liar', 9, 'agus kopling', 'macan tutul', 'm', 'foto1710769196.jpg', 1, '2024-03-18 13:39:56', 0),
(67, 17, 'Satwa Liar', 9, 'agus kopling', 'singa', 'bersama anaknya', 'foto1710769233.jpg', 1, '2024-03-18 13:40:33', 0),
(68, 16, 'Hewan Peliharaan', 9, 'agus kopling', 'sapi', 'banyak sapi', 'foto1710769319.jpg', 1, '2024-04-03 02:24:37', 6),
(69, 16, 'Hewan Peliharaan', 9, 'agus kopling', 'kucing', 'kucing lucu', 'foto1710769342.jpg', 1, '2024-04-03 02:22:05', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_image_comments`
--

CREATE TABLE `tb_image_comments` (
  `comment_id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `comment` text,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_image_comments`
--

INSERT INTO `tb_image_comments` (`comment_id`, `image_id`, `admin_id`, `comment`, `comment_date`) VALUES
(1, 68, NULL, 'wow', '2024-04-02 04:45:21'),
(2, 69, NULL, 'waw bagus\r\n', '2024-04-02 05:17:14'),
(3, 69, NULL, 'ada tanduknya', '2024-04-02 06:58:36');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeks untuk tabel `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeks untuk tabel `tb_image`
--
ALTER TABLE `tb_image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indeks untuk tabel `tb_image_comments`
--
ALTER TABLE `tb_image_comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `image_id` (`image_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tb_image`
--
ALTER TABLE `tb_image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT untuk tabel `tb_image_comments`
--
ALTER TABLE `tb_image_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_image_comments`
--
ALTER TABLE `tb_image_comments`
  ADD CONSTRAINT `tb_image_comments_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `tb_image` (`image_id`),
  ADD CONSTRAINT `tb_image_comments_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `tb_admin` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
