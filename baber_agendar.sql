-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 05-Dez-2023 às 02:41
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `baber_agendar`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamentos`
--

DROP TABLE IF EXISTS `agendamentos`;
CREATE TABLE IF NOT EXISTS `agendamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date DEFAULT NULL,
  `horario` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `agendamentos`
--

INSERT INTO `agendamentos` (`id`, `data`, `horario`) VALUES
(1, '2023-10-10', '09:00:00'),
(2, '2023-10-10', '09:00:00'),
(3, '2023-10-07', '09:00:00'),
(4, '2023-10-07', '10:00:00'),
(5, '2023-10-10', '13:30:00'),
(6, '2023-10-11', '08:00:00'),
(7, '2023-10-07', '11:30:00'),
(8, '2023-10-10', '14:00:00'),
(9, '2023-10-10', '15:00:00'),
(10, '2023-10-10', '11:00:00'),
(11, '2023-10-10', '17:00:00'),
(12, '2023-10-10', '16:00:00'),
(13, '2023-10-10', '13:00:00'),
(14, '2023-10-08', '07:30:00'),
(15, '2023-10-08', '13:30:00'),
(16, '2023-10-12', '08:30:00'),
(17, '2023-10-10', '07:00:00'),
(18, '2023-10-10', '07:30:00'),
(19, '2023-02-07', '07:30:00'),
(20, '2023-10-09', '16:30:00'),
(21, '2023-10-08', '17:00:00'),
(22, '2023-10-12', '10:30:00'),
(23, '2023-10-07', '07:00:00'),
(24, '2023-10-07', '13:00:00'),
(25, '2023-10-13', '07:30:00'),
(26, '2023-12-08', '07:30:00'),
(27, '2023-12-07', '09:30:00'),
(28, '2023-12-08', '10:00:00'),
(29, '2023-12-05', '09:00:00'),
(30, '2023-12-08', '09:30:00'),
(31, '2023-12-08', '08:30:00'),
(32, '2023-12-08', '08:00:00'),
(33, '2023-12-08', '07:00:00'),
(34, '2023-12-08', '09:00:00'),
(35, '2023-12-08', '10:30:00'),
(36, '2023-12-08', '11:00:00'),
(37, '2023-12-08', '11:30:00'),
(38, '2023-12-08', '13:00:00'),
(39, '2023-12-08', '15:30:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fotos_cortes`
--

DROP TABLE IF EXISTS `fotos_cortes`;
CREATE TABLE IF NOT EXISTS `fotos_cortes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
