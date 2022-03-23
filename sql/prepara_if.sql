-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 16-Mar-2022 às 18:27
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `prepara_if`
--
CREATE DATABASE IF NOT EXISTS `prepara_if` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `prepara_if`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `gabaritos`
--

CREATE TABLE `gabaritos` (
  `id_gabarito` int(11) NOT NULL,
  `gabarito` varchar(100) NOT NULL,
  `modalidade` varchar(20) NOT NULL,
  `ano` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONAMENTOS PARA TABELAS `gabaritos`:
--

--
-- Extraindo dados da tabela `gabaritos`
--

INSERT INTO `gabaritos` (`id_gabarito`, `gabarito`, `modalidade`, `ano`) VALUES
(10, 'gabarito-integrado-2015.pdf', 'Integrado', '2015'),
(11, 'gabarito-integrado-2016.pdf', 'Integrado', '2016'),
(14, 'gabarito-integrado-2017.pdf', 'Integrado', '2017'),
(15, 'gabarito-integrado-2018.pdf', 'Integrado', '2018'),
(16, 'gabarito-integrado-2019 2020.pdf', 'Integrado', '2019-2020'),
(17, 'gabarito-subsequente-2015.1.pdf', 'Subsequente', '2015.1'),
(18, 'gabarito-subsequente-2016.1.pdf', 'Subsequente', '2016.1'),
(19, 'gabarito-subsequente-2017.2.pdf', 'Subsequente', '2017.2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `provas`
--

CREATE TABLE `provas` (
  `id_prova` int(11) NOT NULL,
  `prova` varchar(100) NOT NULL,
  `modalidade` varchar(20) NOT NULL,
  `ano` varchar(50) NOT NULL,
  `id_gabarito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONAMENTOS PARA TABELAS `provas`:
--   `id_gabarito`
--       `gabaritos` -> `id_gabarito`
--

--
-- Extraindo dados da tabela `provas`
--

INSERT INTO `provas` (`id_prova`, `prova`, `modalidade`, `ano`, `id_gabarito`) VALUES
(10, 'prova-integrado-2015.pdf', 'Integrado', '2015', 10),
(11, 'prova-integrado-2016.pdf', 'Integrado', '2016', 11),
(14, 'prova-integrado-2017.pdf', 'Integrado', '2017', 14),
(15, 'prova-integrado-2018.pdf', 'Integrado', '2018', 15),
(16, 'prova-integrado-2019-2020.pdf', 'Integrado', '2019-2020', 16),
(17, 'prova-subsequente-2015.1.pdf', 'Subsequente', '2015.1', 17),
(18, 'prova-subsequente-2016.1.pdf', 'Subsequente', '2016.1', 18),
(19, 'prova-subsequente-2017.2.pdf', 'Subsequente', '2017.2', 19);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `chave_recuperar_senha` varchar(32) DEFAULT NULL,
  `nivel` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONAMENTOS PARA TABELAS `usuarios`:
--

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `senha`, `chave_recuperar_senha`, `nivel`) VALUES
(3, 'mateus', 'mateusemanuel107@gmail.com', '202cb962ac59075b964b07152d234b70', 'NULL', 1),
(9, 'valeria', 'valeria321@gmail.com', 'c20ad4d76fe97759aa27a0c99bff6710', NULL, 2),
(10, 'Marcos', 'marcosemanuel806@gmail.com', '1a2c5ef5804a1751bbb9da4b9d767b25', NULL, 1),
(12, 'Mateus Macedo', 'mateusemanuel198@gmail.com', '202cb962ac59075b964b07152d234b70', 'NULL', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `gabaritos`
--
ALTER TABLE `gabaritos`
  ADD PRIMARY KEY (`id_gabarito`);

--
-- Índices para tabela `provas`
--
ALTER TABLE `provas`
  ADD PRIMARY KEY (`id_prova`),
  ADD KEY `id_gabarito` (`id_gabarito`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `gabaritos`
--
ALTER TABLE `gabaritos`
  MODIFY `id_gabarito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `provas`
--
ALTER TABLE `provas`
  MODIFY `id_prova` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `provas`
--
ALTER TABLE `provas`
  ADD CONSTRAINT `provas_ibfk_1` FOREIGN KEY (`id_gabarito`) REFERENCES `gabaritos` (`id_gabarito`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
