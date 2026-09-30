-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/04/2026 às 21:55
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cadastro_de_membros`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `membros`
--

CREATE TABLE `membros` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `foto_path` varchar(255) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `ender` varchar(255) NOT NULL,
  `nascimento` varchar(255) DEFAULT NULL,
  `tipo_membro` varchar(255) NOT NULL,
  `batismo` varchar(255) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `setor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `membros`
--

INSERT INTO `membros` (`id`, `nome`, `email`, `foto_path`, `tel`, `ender`, `nascimento`, `tipo_membro`, `batismo`, `cargo`, `setor`) VALUES
(15, 'Alexandre Souza', 'alexandremadaleno22@gmail.com', 'uploads/IMG_20250116_170422_HDR.jpg', '61996879133', 'SHA Conjunto 5 Chácara 37', '23/08/1979', 'Membro', '24/04/2000', 'Operador de áudio/video', '-----'),
(17, 'Marina de Jesus Braga', 'alexandremarina@msn.com', 'uploads/17478448612666662501043817757900.jpg', '61992522723', 'SHA Conjunto 5 Chácara 37', '2025-05-21', 'Membro', '21/04/2000', 'Voluntária ', 'Reviver'),
(18, 'arthur', 'art@gmail.com', 'uploads/alexandre.png', '321654987', 'Q QR 1, 4568', '17/01/1983', 'Membro', '27/04/2000', 'Mídia', 'Expansão'),
(19, 'arthur braga', 'art@gmail.com', 'uploads/684c31efe6993_arlindo2.png', '61996879133', 'Q QR 1, 4568', '17/01/1983', 'Membro', '27/04/2000', 'Midia', ''),
(20, 'arthur braga madaleno', 'art@gmail.com', 'uploads/684c32a426711_arlindo.png', '61996879133', 'Q QR 1, 4568', '17/01/1983', 'Membro', '27/04/2000', 'Midia', ''),
(21, 'souza braga madaleno', 'art@gmail.com', 'uploads/edvaldo.png', '61996879133', 'Q QR 1, 4568', '17/01/1983', 'Membro', '27/04/2000', 'Midia', 'Expansão');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `membros`
--
ALTER TABLE `membros`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `membros`
--
ALTER TABLE `membros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
