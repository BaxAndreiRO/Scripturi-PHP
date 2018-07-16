-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 04 Iun 2016 la 21:27
-- Versiune server: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xxxxxxx`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `bx.vizitatori`
--

CREATE TABLE IF NOT EXISTS `bx.vizitatori` (
  `id` int(250) NOT NULL,
  `ip` varchar(250) NOT NULL,
  `timp` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `bx.vizitatori`
--

INSERT INTO `bx.vizitatori` (`id`, `ip`, `timp`) VALUES
(1, '::1', '1465068390');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bx.vizitatori`
--
ALTER TABLE `bx.vizitatori`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bx.vizitatori`
--
ALTER TABLE `bx.vizitatori`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
