-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 28 Feb 2016 la 14:50
-- Versiune server: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `conectare`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `utilizatori_site`
--

CREATE TABLE IF NOT EXISTS `utilizatori_site` (
  `id` int(250) NOT NULL,
  `nume` varchar(250) NOT NULL,
  `parola` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `utilizatori_site`
--

INSERT INTO `utilizatori_site` (`id`, `nume`, `parola`) VALUES
(1, 'baxandrei', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `utilizatori_site`
--
ALTER TABLE `utilizatori_site`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nume` (`nume`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `utilizatori_site`
--
ALTER TABLE `utilizatori_site`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
