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
-- Banco de dados: `usuarios`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `data_cadastro`) VALUES
(3, 'marina', 'ma.marina@gmail.com', '$2y$10$E6WG/.X7D0zpiuyxpyWSOOve/xIBJ19Fpfdqok0jVa1.Qnj9pPpYK', '2025-05-21 14:39:34'),
(4, 'alexandre souza', 'alexandre.madaleno@gmail.com', '$2y$10$G0v28NTi7lSRhoH0tfUFIu.huFH3P32drmfrkOVgYA.8WNldNhp52', '2025-05-21 14:44:19'),
(5, 'IPDA', 'ipdacandagolandia@gmail.com', '$2y$10$PFT3Tt8rhEO3Zoe06wCDjejr//cublEr0nR5M31jo/4U0/JeCb4aW', '2025-06-23 23:37:47'),
(6, 'Administrador', 'admin@ipda.com', '$2y$10$oGtBZgZxN8YIqy77Zwm1Ceor/yg0MN0I89XGra1hcbDPYjNMcJ5Oy', '2025-07-16 12:16:31'),
(7, 'IPDA Sede', 'ipdasedetaguatinga@gmail.com', '$2y$10$jSKspu5touOFiwhNqebWi.qdT5k4Xgmv5PtlocH5BIPTeOlXyI12y', '2026-04-11 18:26:16');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
