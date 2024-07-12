-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 04-Jun-2024 às 18:12
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dblojinha`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

DROP TABLE IF EXISTS `cadastro`;
CREATE TABLE IF NOT EXISTS `cadastro` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco_usuario` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha_usuario` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_usuario` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cadastro`
--

INSERT INTO `cadastro` (`id_usuario`, `nome_usuario`, `endereco_usuario`, `senha_usuario`, `email_usuario`) VALUES
(6, 'Leonardo', 'rua onde comedia nao se cria', '123', 'leozinhow08@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id_prod` int(11) NOT NULL AUTO_INCREMENT,
  `descricao_produto` text COLLATE utf8_unicode_ci,
  `valor_produto` decimal(10,2) DEFAULT NULL,
  `forma_pgto` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `condicao_pgto` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valor_parcela` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_prod`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id_prod`, `descricao_produto`, `valor_produto`, `forma_pgto`, `condicao_pgto`, `valor_parcela`) VALUES
(4, '(cropped)', '15.00', 'cartao', '3', '5,00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
