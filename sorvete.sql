-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 04-Dez-2019 às 18:53
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `sorvete`
--
CREATE DATABASE IF NOT EXISTS `sorvete` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sorvete`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acai`
--

CREATE TABLE IF NOT EXISTS `acai` (
  `id_acai` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) NOT NULL,
  `preco` int(11) NOT NULL,
  `recipiente` varchar(50) NOT NULL,
  PRIMARY KEY (`id_acai`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Extraindo dados da tabela `acai`
--

INSERT INTO `acai` (`id_acai`, `tipo`, `preco`, `recipiente`) VALUES
(7, 'acai natural', 11, 'potinho'),
(8, 'acai natural', 12, 'casquinha'),
(9, 'acai c/ frutas vermelhas', 15, 'potnho'),
(10, 'acai c/ frutas vermelhas', 16, 'casquinha'),
(11, 'acai c/ cupuacu', 12, 'potinho'),
(12, 'acai c/ cupuacu', 13, 'casquinha'),
(13, 'acai c/ iogurte', 9, 'potinho'),
(14, 'acai c/ iogurte', 10, 'casquinha'),
(15, 'acai c/ musse de maracuja', 14, 'potinho'),
(16, 'acai c/ musse de maracuja', 15, 'casquinha'),
(17, 'cupuacu natural', 15, 'potinho'),
(18, 'cupuacu natural', 16, 'casquinha'),
(19, 'cupuacu c/ iogurte', 11, 'potinho'),
(20, 'cupuacu c/ iogurte', 12, 'casquinha');

-- --------------------------------------------------------

--
-- Estrutura da tabela `compras`
--

CREATE TABLE IF NOT EXISTS `compras` (
  `id_compras` int(11) NOT NULL AUTO_INCREMENT,
  `cod_usuario` int(11) NOT NULL,
  `cod_picole` int(11) NOT NULL,
  `cod_sorvete` int(11) NOT NULL,
  `cod_acai` int(11) NOT NULL,
  `cod_milkshake` int(11) NOT NULL,
  `quantidade_picole` int(11) NOT NULL,
  `quantidade_sorvete` int(11) NOT NULL,
  `quantidade_acai` int(11) NOT NULL,
  `quantidade_milkshake` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `preco_p` int(11) NOT NULL,
  `preco_s` int(11) NOT NULL,
  `preco_a` int(11) NOT NULL,
  `preco_m` int(11) NOT NULL,
  PRIMARY KEY (`id_compras`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `compras`
--

INSERT INTO `compras` (`id_compras`, `cod_usuario`, `cod_picole`, `cod_sorvete`, `cod_acai`, `cod_milkshake`, `quantidade_picole`, `quantidade_sorvete`, `quantidade_acai`, `quantidade_milkshake`, `total`, `preco_p`, `preco_s`, `preco_a`, `preco_m`) VALUES
(1, 4, 27, 7, 0, 0, 4, 5, 0, 0, 34, 14, 20, 0, 0),
(2, 4, 27, 7, 10, 21, 3, 2, 2, 1, 59, 11, 8, 32, 8),
(3, 2, 11, 15, 10, 25, 4, 1, 3, 5, 85, 2, 5, 48, 30),
(4, 4, 19, 5, 9, 20, 5, 2, 6, 6, 150, 10, 14, 90, 36),
(5, 4, 11, 6, 10, 22, 1, 2, 3, 4, 103, 1, 14, 48, 40),
(6, 2, 1, 5, 10, 20, 5, 4, 3, 5, 119, 13, 28, 48, 30),
(7, 4, 14, 8, 11, 20, 2, 2, 5, 3, 96, 6, 12, 60, 18),
(8, 4, 11, 15, 10, 25, 4, 1, 3, 5, 85, 2, 5, 48, 30),
(9, 4, 11, 15, 10, 25, 4, 1, 3, 5, 85, 2, 5, 48, 30),
(11, 9, 14, 15, 14, 22, 3, 5, 1, 3, 74, 9, 25, 10, 30);

-- --------------------------------------------------------

--
-- Estrutura da tabela `milkshake`
--

CREATE TABLE IF NOT EXISTS `milkshake` (
  `id_milkshake` int(11) NOT NULL AUTO_INCREMENT,
  `sabor_m` varchar(50) NOT NULL,
  `tamanho` varchar(50) NOT NULL,
  `preco` int(11) NOT NULL,
  PRIMARY KEY (`id_milkshake`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Extraindo dados da tabela `milkshake`
--

INSERT INTO `milkshake` (`id_milkshake`, `sabor_m`, `tamanho`, `preco`) VALUES
(2, 'morango', '300', 5),
(3, 'morango', '500', 6),
(4, 'morango', '800', 7),
(5, 'chocolate', '300', 6),
(6, 'chocolate', '500', 8),
(7, 'chocolate', '800', 9),
(8, 'ninho', '300', 8),
(9, 'ninho', '500', 9),
(10, 'ninho', '800', 10),
(11, 'ovomaltine', '300', 9),
(12, 'ovomaltine', '500', 10),
(13, 'ovomaltine', '800', 12),
(14, 'ninho c/ nutella', '300', 8),
(15, 'ninho c/ nutella', '500', 10),
(16, 'ninho c/ nutella', '800', 13),
(17, 'sensacao', '300', 5),
(18, 'sensacao', '500', 7),
(19, 'sensacao', '800', 10),
(20, 'floresta negra', '300', 6),
(21, 'floresta negra', '500', 8),
(22, 'floresta negra', '800', 10),
(23, 'maracuja', '300', 4),
(24, 'maracuja', '500', 5),
(25, 'maracuja', '800', 6),
(26, 'leite condensado', '300', 5),
(27, 'leite condensado', '500', 7),
(28, 'leite condensado', '800', 8),
(29, 'limao', '300', 3),
(30, 'limao', '500', 4),
(31, 'limao', '800', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `picole`
--

CREATE TABLE IF NOT EXISTS `picole` (
  `id_picole` int(11) NOT NULL AUTO_INCREMENT,
  `sabor_picole` varchar(50) NOT NULL,
  `preco` float NOT NULL,
  `categoria` varchar(11) NOT NULL,
  `cod_quantidade` int(11) NOT NULL,
  PRIMARY KEY (`id_picole`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Extraindo dados da tabela `picole`
--

INSERT INTO `picole` (`id_picole`, `sabor_picole`, `preco`, `categoria`, `cod_quantidade`) VALUES
(1, 'chocolate', 2.5, 'leite', 0),
(2, 'morango ', 2.5, 'leite', 0),
(3, 'limao', 3.6, 'agua', 0),
(4, 'limao', 4.6, 'leite', 0),
(9, 'pimenta', 2.2, 'agua', 0),
(10, 'chuchu', 0.7, 'agua', 0),
(11, 'chuchu', 0.5, 'leite', 0),
(13, 'tamarindo', 2.5, 'leite', 0),
(14, 'batata', 3, 'agua', 0),
(15, 'churros', 2.5, 'leite', 0),
(16, 'churros', 2, 'agua', 0),
(17, 'tamarindo', 2, 'agua', 0),
(18, 'picles', 0.5, 'leite', 0),
(19, 'bacon', 3, 'agua', 0),
(21, 'bacon', 5, 'leite', 0),
(22, 'maracuja', 1.5, 'agua', 0),
(23, 'maracuja', 3, 'leite', 0),
(24, 'tomate', 1.2, 'agua', 0),
(25, 'morango', 2, 'agua', 0),
(26, 'picles', 0.2, 'leite', 0),
(27, 'batata', 3, 'leite', 0),
(28, 'chocolate', 2, 'agua', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sorvete`
--

CREATE TABLE IF NOT EXISTS `sorvete` (
  `id_sorvete` int(11) NOT NULL AUTO_INCREMENT,
  `sabor` varchar(50) NOT NULL,
  `preco` int(11) NOT NULL,
  `recipiente` varchar(50) NOT NULL,
  PRIMARY KEY (`id_sorvete`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Extraindo dados da tabela `sorvete`
--

INSERT INTO `sorvete` (`id_sorvete`, `sabor`, `preco`, `recipiente`) VALUES
(1, 'morango', 4, 'casquinha'),
(3, 'chocolate', 2, 'potinho'),
(4, 'napolitano', 6, 'potino'),
(5, 'chocolate', 7, 'potinho'),
(6, 'napolitano', 7, 'casquinha'),
(7, 'flocos', 4, 'potinho'),
(8, 'flocos', 6, 'casquinha'),
(9, 'ninho', 7, 'potinho'),
(10, 'ninho', 7, 'casquinha'),
(11, 'pistache', 2, 'potinho'),
(12, 'pistache', 2, 'casquinha'),
(13, 'nutella', 8, 'potinho'),
(14, 'nutella', 9, 'casquinha'),
(15, 'maracuja', 5, 'potinho'),
(16, 'maracuja', 6, 'casquinha');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` char(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` int(10) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `data_nascimento`, `sexo`, `email`, `telefone`, `senha`) VALUES
(2, 'Vera Cunha', '2000-11-03', 'F', 'vera@gmail.com', 992443428, '12345'),
(4, 'Ana JÃºlia ', '2001-04-22', 'F', 'annaju@hotmail.com', 777777770, '1234'),
(5, 'Graziele', '2019-12-17', 'f', 'graziele@gmail.com', 2147483647, 'graziele'),
(6, 'Graziele', '2019-12-17', 'f', 'graziele@gmail.com', 2147483647, 'graziele'),
(7, 'Graziele', '2019-12-17', 'f', 'graziele@gmail.com', 2147483647, 'graziele'),
(8, 'Graziele', '2019-12-17', 'f', 'graziele@gmail.com', 2147483647, 'graziele'),
(9, 'ana b ', '6200-05-22', 'f', 'ana@gmail.com', 2147483647, '1234');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
