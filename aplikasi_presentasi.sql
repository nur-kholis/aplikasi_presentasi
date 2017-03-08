-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 08. Maret 2017 jam 09:20
-- Versi Server: 5.5.16
-- Versi PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aplikasi_presentasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `presentasi`
--

CREATE TABLE IF NOT EXISTS `presentasi` (
  `id_presentasi` int(11) NOT NULL AUTO_INCREMENT,
  `judul_presentasi` varchar(50) NOT NULL,
  `status_presentasi` int(11) NOT NULL,
  PRIMARY KEY (`id_presentasi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `presentasi`
--

INSERT INTO `presentasi` (`id_presentasi`, `judul_presentasi`, `status_presentasi`) VALUES
(1, 'null', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `slide`
--

CREATE TABLE IF NOT EXISTS `slide` (
  `id_slide` int(11) NOT NULL AUTO_INCREMENT,
  `id_presentasi` int(11) NOT NULL,
  `part` int(11) NOT NULL,
  `judul_slide` text NOT NULL,
  `konten_slide` text NOT NULL,
  `foto_slide` text NOT NULL,
  `video_slide` text NOT NULL,
  `status_slide` int(11) NOT NULL,
  PRIMARY KEY (`id_slide`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `slide`
--

INSERT INTO `slide` (`id_slide`, `id_presentasi`, `part`, `judul_slide`, `konten_slide`, `foto_slide`, `video_slide`, `status_slide`) VALUES
(1, 1, 1, 'part 1', '<p><em>ini isi part i</em></p>', 'null', 'null', 0),
(2, 1, 2, 'part 2', '<p>kenapa pilih part 2</p><ul><li>saya</li><li>kamu</li><li>dia</li></ul>', '', '', 0),
(3, 1, 3, 'part 3', '<ol><li><strong>miring', '', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
