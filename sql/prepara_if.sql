-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 30-Mar-2022 às 15:52
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT ;
!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS ;
!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION ;
!40101 SET NAMES utf8mb4 */;

--
 Banco de dados: `prepara_if`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alternativas`
--

CREATE TABLE `alternativas` (
  `id_alternativa` int(11) NOT NULL,
  `assunto` varchar(20) NOT NULL,
  `alternativa` text NOT NULL,
  `modalidade` varchar(20) NOT NULL,
  `ano` varchar(20) NOT NULL,
  `correta` int(11) NOT NULL,
  `id_questao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
 RELACIONAMENTOS PARA TABELAS `alternativas`:
   `id_questao`
       `questoes` -> `id_questao`
--

--
 Extraindo dados da tabela `alternativas`
--

INSERT INTO `alternativas` (`id_alternativa`, `assunto`, `alternativa`, `modalidade`, `ano`, `correta`, `id_questao`) VALUES
(1, 'Matematica', '25', 'Integrado', '2015', 0, 1),
(2, 'Matematica', '23', 'Integrado', '2015', 0, 1),
(3, 'Matematica', '20', 'Integrado', '2015', 1, 1),
(4, 'Matematica', '18', 'Integrado', '2015', 0, 1),
(5, 'Matematica', 'felina, havia cinco fêmeas a mais do que machos.', 'Integrado', '2015', 1, 2),
(6, 'Matematica', 'felina, o número de machos era igual ao de fêmeas.', 'Integrado', '2015', 0, 2),
(7, 'Matematica', 'canina, havia cinco fêmeas a menos do que machos.', 'Integrado', '2015', 0, 2),
(8, 'Matematica', 'canina, o número de machos era maior do que o de fêmeas.', 'Integrado', '2015', 0, 2),
(9, 'Matematica', '5', 'Integrado', '2015', 0, 3),
(10, 'Matematica', '7', 'Integrado', '2015', 1, 3),
(11, 'Matematica', '8', 'Integrado', '2015', 0, 3),
(12, 'Matematica', '9', 'Integrado', '2015', 0, 3),
(13, 'Matematica', '18 sacos.', 'Integrado', '2015', 0, 4),
(14, 'Matematica', '20 sacos.', 'Integrado', '2015', 0, 4),
(15, 'Matematica', '21 sacos.', 'Integrado', '2015', 0, 4),
(16, 'Matematica', '22 sacos.', 'Integrado', '2015', 1, 4);

-- --------------------------------------------------------

--
 Estrutura da tabela `gabaritos`
--

CREATE TABLE `gabaritos` (
  `id_gabarito` int(11) NOT NULL,
  `gabarito` varchar(100) NOT NULL,
  `modalidade` varchar(20) NOT NULL,
  `ano` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
 RELACIONAMENTOS PARA TABELAS `gabaritos`:
--

--
 Extraindo dados da tabela `gabaritos`
--

INSERT INTO `gabaritos` (`id_gabarito`, `gabarito`, `modalidade`, `ano`) VALUES
(28, 'gabarito-integrado-2015.pdf', 'Integrado', '2015');

-- --------------------------------------------------------

--
 Estrutura da tabela `provas`
--

CREATE TABLE `provas` (
  `id_prova` int(11) NOT NULL,
  `prova` varchar(100) NOT NULL,
  `modalidade` varchar(20) NOT NULL,
  `ano` varchar(20) NOT NULL,
  `id_gabarito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
 RELACIONAMENTOS PARA TABELAS `provas`:
   `id_gabarito`
       `gabaritos` -> `id_gabarito`
--

--
 Extraindo dados da tabela `provas`
--

INSERT INTO `provas` (`id_prova`, `prova`, `modalidade`, `ano`, `id_gabarito`) VALUES
(28, 'prova-integrado-2015.pdf', 'Integrado', '2015', 28);

-- --------------------------------------------------------

--
 Estrutura da tabela `questoes`
--

CREATE TABLE `questoes` (
  `id_questao` int(11) NOT NULL,
  `assunto` varchar(20) NOT NULL,
  `questao` text NOT NULL,
  `modalidade` varchar(20) NOT NULL,
  `ano` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
 RELACIONAMENTOS PARA TABELAS `questoes`:
--

--
 Extraindo dados da tabela `questoes`
--

INSERT INTO `questoes` (`id_questao`, `assunto`, `questao`, `modalidade`, `ano`) VALUES
(1, 'Matematica', 'O Texto 1 faz referência ao artigo 32, da Lei Federal no 9.605 de\r\n1998. Considerando um número x ∈ N , tal que, x, (x + 1) e (x + 2)\r\nsão divisores, respectivamente, de 32, 9.605 e 1998, é correto afirmar\r\nque a soma de todos os valores possíveis de x, é igual a', 'Integrado', '2015'),
(2, 'Matematica', 'Na feira “Patinha Amiga”, entre os filhotes disponíveis para adoção, 60% dos gatos e 60% dos cães eram fêmeas. Sabendo-se que, entre os adultos, 8 gatos e 12 cães eram machos, podemos afirmar que, no citado evento, entre os animais da espécie', 'Integrado', '2015'),
(3, 'Matematica', 'Um grupo de resgate de animais de rua contabilizou, ao final do dia, um total de 17 animais resgatados. Sabe-se que a quantidade de fêmeas foi maior do que a de machos e que a diferença entre a metade do número de fêmeas e o total do número de machos foi 1. Com base nessas informações, a diferença entre o número de fêmeas e de machos, é igual a', 'Integrado', '2015'),
(4, 'Matematica', 'Para ajudar 20 animais abandonados, um grupo de amigos fez uma campanha nas redes sociais para arrecadar ração para os peludinhos. O grupo arrecadou uma quantidade x de ração, em kg, capaz de alimentá-los por 35 dias. Suponha que o consumo médio diário de cada animal é de 110g de ração. Para\r\narmazenar a ração arrecadada em sacos de 3,5 kg, seriam necessários um total de', 'Integrado', '2015');

-- --------------------------------------------------------

--
 Estrutura da tabela `usuarios`
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
 RELACIONAMENTOS PARA TABELAS `usuarios`:
--

--
 Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `senha`, `chave_recuperar_senha`, `nivel`) VALUES
(9, 'valeria', 'valeria321@gmail.com', 'c20ad4d76fe97759aa27a0c99bff6710', NULL, 2),
(32, 'Mateus', 'mateusemanuel107@gmail.com', 'c20ad4d76fe97759aa27a0c99bff6710', NULL, 1);

--
 Índices para tabelas despejadas
--

--
 Índices para tabela `alternativas`
--
ALTER TABLE `alternativas`
  ADD PRIMARY KEY (`id_alternativa`),
  ADD KEY `id_questao` (`id_questao`);

--
 Índices para tabela `gabaritos`
--
ALTER TABLE `gabaritos`
  ADD PRIMARY KEY (`id_gabarito`);

--
 Índices para tabela `provas`
--
ALTER TABLE `provas`
  ADD PRIMARY KEY (`id_prova`),
  ADD KEY `id_gabarito` (`id_gabarito`);

--
 Índices para tabela `questoes`
--
ALTER TABLE `questoes`
  ADD PRIMARY KEY (`id_questao`);

--
 Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
 AUTO_INCREMENT de tabelas despejadas
--

--
 AUTO_INCREMENT de tabela `alternativas`
--
ALTER TABLE `alternativas`
  MODIFY `id_alternativa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
 AUTO_INCREMENT de tabela `gabaritos`
--
ALTER TABLE `gabaritos`
  MODIFY `id_gabarito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
 AUTO_INCREMENT de tabela `provas`
--
ALTER TABLE `provas`
  MODIFY `id_prova` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
 AUTO_INCREMENT de tabela `questoes`
--
ALTER TABLE `questoes`
  MODIFY `id_questao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
 AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
 Restrições para despejos de tabelas
--

--
 Limitadores para a tabela `alternativas`
--
ALTER TABLE `alternativas`
  ADD CONSTRAINT `alternativas_ibfk_1` FOREIGN KEY (`id_questao`) REFERENCES `questoes` (`id_questao`);

--
 Limitadores para a tabela `provas`
--
ALTER TABLE `provas`
  ADD CONSTRAINT `provas_ibfk_1` FOREIGN KEY (`id_gabarito`) REFERENCES `gabaritos` (`id_gabarito`);
COMMIT;

!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT ;
!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS ;
!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION ;
