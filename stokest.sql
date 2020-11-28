-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 28-Nov-2020 às 12:36
-- Versão do servidor: 5.6.41-84.1
-- versão do PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `info5714_tcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `entradas`
--

CREATE TABLE `entradas` (
  `id` int(11) NOT NULL,
  `idMotivo` int(11) NOT NULL,
  `dataEntrada` date NOT NULL,
  `idProduto` int(11) NOT NULL,
  `qtdProduto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `motivoentrada`
--

CREATE TABLE `motivoentrada` (
  `id` int(11) NOT NULL,
  `nomeMotivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `motivoentrada`
--

INSERT INTO `motivoentrada` (`id`, `nomeMotivo`) VALUES
(1, 'Compra de suprimentos'),
(2, 'Acerto de Estoque');

-- --------------------------------------------------------

--
-- Estrutura da tabela `motivosaida`
--

CREATE TABLE `motivosaida` (
  `id` int(11) NOT NULL,
  `nomeMotivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `motivosaida`
--

INSERT INTO `motivosaida` (`id`, `nomeMotivo`) VALUES
(1, 'Utilização interna'),
(2, 'Conserto de Estoque');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nomeProduto` varchar(255) NOT NULL,
  `estoqueAtual` int(11) NOT NULL,
  `estoqueMinimo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nomeProduto`, `estoqueAtual`, `estoqueMinimo`) VALUES
(1, 'Caneta Azul', 35, 50),
(2, 'Lápis 2B', 38, 40),
(3, 'Produto Teste', 15, 50),
(4, 'Borracha', 46, 80),
(5, 'Pacote Sulfite', 50, 20),
(6, 'Envelope Pardo A4', -15, 30),
(7, 'produto teste', 450, 100);

-- --------------------------------------------------------

--
-- Estrutura da tabela `saidas`
--

CREATE TABLE `saidas` (
  `id` int(11) NOT NULL,
  `idMotivo` int(11) NOT NULL,
  `dataSaida` date NOT NULL,
  `idProduto` int(11) NOT NULL,
  `qtdProduto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nivelAcesso` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `username`, `password`, `nivelAcesso`, `status`) VALUES
(1, 'Gustavo Adami', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 1),
(2, 'Usuário Teste', 'teste', '2e6f9b0d5885b6010f9167787445617f553a735f', 1, 1),
(3, 'Usuário Estoque', 'estoque', 'd05e3079eacf4d425d6153e7648103a1da0976a8', 3, 1),
(4, 'Usuário Atendente', 'atendente', '628383eee21d725aa4e829bd52f571784449a418', 4, 1),
(5, 'Usuário Gerente', 'gerente', 'e0ffb90b074691c42ebd7b3cc39771b344c0083b', 2, 1),
(15, 'Rafael A. Florindo', 'rafael.florindo', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios__grupos`
--

CREATE TABLE `usuarios__grupos` (
  `id` int(11) NOT NULL,
  `nomeGrupo` varchar(150) NOT NULL,
  `nivelGrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios__grupos`
--

INSERT INTO `usuarios__grupos` (`id`, `nomeGrupo`, `nivelGrupo`) VALUES
(1, 'Administrador', 1),
(2, 'Gerente', 2),
(3, 'Estoque', 3),
(4, 'Atendente', 4);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `motivoentrada`
--
ALTER TABLE `motivoentrada`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `motivosaida`
--
ALTER TABLE `motivosaida`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `saidas`
--
ALTER TABLE `saidas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_level` (`nivelAcesso`);

--
-- Índices para tabela `usuarios__grupos`
--
ALTER TABLE `usuarios__grupos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_level` (`nivelGrupo`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `motivoentrada`
--
ALTER TABLE `motivoentrada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `motivosaida`
--
ALTER TABLE `motivosaida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `saidas`
--
ALTER TABLE `saidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
