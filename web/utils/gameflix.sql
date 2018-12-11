-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07-Dez-2018 às 02:00
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gameflix`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `preco_locacao` decimal(10,0) NOT NULL,
  `dias_locacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `desenvolvedora`
--

CREATE TABLE `desenvolvedora` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `genero`
--

CREATE TABLE `genero` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogo`
--

CREATE TABLE `jogo` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `desenvolvedora_id` int(11) NOT NULL,
  `genero_id` int(11) NOT NULL,
  `data_lancamento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `locacao`
--

CREATE TABLE `locacao` (
  `id` int(32) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `midia_id` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `data_devolucao` date NOT NULL,
  `data_devolvido` date NOT NULL,
  `valor` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `midia`
--

CREATE TABLE `midia` (
  `id` int(11) NOT NULL,
  `plataforma_id` int(11) NOT NULL,
  `jogo_id` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `data_aquisicao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `operador`
--

CREATE TABLE `operador` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `operador_id` int(11) NOT NULL,
  `data_retirada` date NOT NULL,
  `status` int(1) NOT NULL,
  `valor_total` decimal(10,0) NOT NULL,
  `valor_quitado` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `plataforma`
--

CREATE TABLE `plataforma` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `telefone` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `data_nascimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `desenvolvedora`
--
ALTER TABLE `desenvolvedora`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jogo`
--
ALTER TABLE `jogo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jogo_categoria` (`categoria_id`),
  ADD KEY `jogo_desenvolvedora` (`desenvolvedora_id`),
  ADD KEY `jogo_genero` (`genero_id`);

--
-- Indexes for table `locacao`
--
ALTER TABLE `locacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `locacao_midia` (`midia_id`),
  ADD KEY `locacao_pedido` (`pedido_id`);

--
-- Indexes for table `midia`
--
ALTER TABLE `midia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `midia_jogo` (`jogo_id`),
  ADD KEY `midia_plataforma` (`plataforma_id`);

--
-- Indexes for table `operador`
--
ALTER TABLE `operador`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_operador` (`operador_id`),
  ADD KEY `pedido_usuario` (`usuario_id`);

--
-- Indexes for table `plataforma`
--
ALTER TABLE `plataforma`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `desenvolvedora`
--
ALTER TABLE `desenvolvedora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genero`
--
ALTER TABLE `genero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jogo`
--
ALTER TABLE `jogo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locacao`
--
ALTER TABLE `locacao`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `midia`
--
ALTER TABLE `midia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operador`
--
ALTER TABLE `operador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plataforma`
--
ALTER TABLE `plataforma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `jogo`
--
ALTER TABLE `jogo`
  ADD CONSTRAINT `jogo_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `jogo_desenvolvedora` FOREIGN KEY (`desenvolvedora_id`) REFERENCES `desenvolvedora` (`id`),
  ADD CONSTRAINT `jogo_genero` FOREIGN KEY (`genero_id`) REFERENCES `genero` (`id`);

--
-- Limitadores para a tabela `locacao`
--
ALTER TABLE `locacao`
  ADD CONSTRAINT `locacao_midia` FOREIGN KEY (`midia_id`) REFERENCES `midia` (`id`),
  ADD CONSTRAINT `locacao_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`);

--
-- Limitadores para a tabela `midia`
--
ALTER TABLE `midia`
  ADD CONSTRAINT `midia_jogo` FOREIGN KEY (`jogo_id`) REFERENCES `jogo` (`id`),
  ADD CONSTRAINT `midia_plataforma` FOREIGN KEY (`plataforma_id`) REFERENCES `plataforma` (`id`);

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_operador` FOREIGN KEY (`operador_id`) REFERENCES `operador` (`id`),
  ADD CONSTRAINT `pedido_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
