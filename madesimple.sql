SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `madesimple` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `madesimple`;

CREATE TABLE `albums` (
  `id` int(9) NOT NULL,
  `id_artista` int(9) NOT NULL,
  `album` varchar(255) NOT NULL,
  `ano` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

TRUNCATE TABLE `albums`;
INSERT INTO `albums` (`id`, `id_artista`, `album`, `ano`) VALUES
(1, 2, 'Breakn Rules', 1978),
(2, 1, 'Black Cat', 1981),
(3, 3, 'After School Guys', 1992),
(4, 3, 'Heys', 1900);

CREATE TABLE `artists` (
  `id` int(9) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `twitter` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

TRUNCATE TABLE `artists`;
INSERT INTO `artists` (`id`, `nome`, `twitter`) VALUES
(1, 'Pantera', 'aHR0cHM6Ly90d2l0dGVyLmNvbS9ob21l'),
(2, 'Thundera', 'aHR0cHM6Ly90d2l0dGVyLmNvbS9ob21l'),
(3, 'Chilli Pops', 'aHR0cHM6Ly90d2l0dGVyLmNvbS9ob21l');

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `login` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `senha` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nivel` int(2) DEFAULT '1',
  `status` int(1) DEFAULT '0',
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fone` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `depto` int(3) DEFAULT '0',
  `deletado` int(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

TRUNCATE TABLE `login`;
INSERT INTO `login` (`id`, `login`, `senha`, `token`, `nome`, `nivel`, `status`, `email`, `fone`, `depto`, `deletado`) VALUES
(1, 'fbranco76', 'b2c7b270565715f3de5b60e59657f0e2', '', 'Fábio Branco da Silva', 3, 1, 'fbranco@adlux.com.br', '(15) 99611-2103', 13, 0),
(29, 'jhonsnow', '75cc815aba77c01af41fe20138617e9c', NULL, 'Jhon Snow', 2, 1, 'jhonsnow@starks.com.br', NULL, 1, 0),
(28, 'joao', 'd63ffc60bed32ef99f91c77192379a33', NULL, 'joao', 2, 1, 'joao@adlux.com.br', NULL, 1, 0),
(27, 'roger', '61687225e3af5ca13fa484b4424b03ee', NULL, 'Mark Roger', 2, 1, 'roger@madesimple.com.br', NULL, 1, 1);


ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_artistab` (`id_artista`);

ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `removidos-logins` (`deletado`);


ALTER TABLE `albums`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
ALTER TABLE `artists`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
