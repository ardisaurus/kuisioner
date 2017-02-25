-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2017 at 12:27 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_kuisioner`
--

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE IF NOT EXISTS `jawaban` (
  `id_pertanyaan` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `jawaban` int(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id_pertanyaan`, `username`, `jawaban`, `status`) VALUES
(26, 'responden', 2, 1),
(27, 'responden', 0, 0),
(24, 'responden', 4, 1),
(25, 'responden', 1, 1),
(21, 'responden', 0, 0),
(22, 'responden', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kuisioner`
--

CREATE TABLE IF NOT EXISTS `kuisioner` (
  `id_kuisioner` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kuisioner` varchar(250) NOT NULL,
  `publish` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kuisioner`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `kuisioner`
--

INSERT INTO `kuisioner` (`id_kuisioner`, `nama_kuisioner`, `publish`) VALUES
(9, 'Lab Fisika', 2),
(10, 'Lab Kimia', 1),
(11, 'Lab Biologi', 1),
(12, 'Lab Elektronika', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE IF NOT EXISTS `pertanyaan` (
  `id_kuisioner` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan` text NOT NULL,
  PRIMARY KEY (`id_pertanyaan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`id_kuisioner`, `id_pertanyaan`, `pertanyaan`) VALUES
(11, 21, 'Kebersihan ruangan'),
(11, 22, 'Pencahayaan ruangan'),
(10, 24, 'Pencahayaan ruangan'),
(10, 25, 'Kebersihan ruangan'),
(9, 26, 'Pencahayaan ruangan'),
(9, 27, 'Kebersihan ruangan'),
(12, 28, 'Pencahayaan ruangan'),
(12, 29, 'Kebersihan ruangan');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(60) NOT NULL,
  `password` text NOT NULL,
  `nama_pengguna` varchar(100) NOT NULL,
  `level` tinyint(1) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama_pengguna`, `level`) VALUES
('admin', '0192023a7bbd73250516f069df18b500', 'Administrator', 1),
('member', 'a510166163833c79aa703646f59c04bb', 'Member', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
