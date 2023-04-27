-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Abr-2023 às 23:00
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `comanda`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alimento`
--

CREATE TABLE `alimento` (
  `idAlimento` int(11) NOT NULL,
  `idCatAlimento` int(11) NOT NULL,
  `descAlimento` varchar(255) NOT NULL,
  `nomeAlimento` varchar(255) NOT NULL,
  `valorUnidade` double NOT NULL,
  `fotoAlimento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `alimento`
--

INSERT INTO `alimento` (`idAlimento`, `idCatAlimento`, `descAlimento`, `nomeAlimento`, `valorUnidade`, `fotoAlimento`) VALUES
(1, 1, 'Pão, Hamburguer, Queijo, Presunto', 'X-Burguer', 10.5, ''),
(2, 2, 'Molho de tomate, Calabresa', 'Pizza de calabresa', 20.4, ''),
(3, 1, 'Pão, Hamburguer, Alface, Queijo', 'X-Salada', 44.7, ''),
(5, 2, 'sdad', 'dsad', 55, 'teste'),
(6, 6, 'chinês', 'jorge', 55, 'teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoriaalimento`
--

CREATE TABLE `categoriaalimento` (
  `idCatAlimento` int(11) NOT NULL,
  `nomeCatAlimento` varchar(255) NOT NULL,
  `fotoCatAlimento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categoriaalimento`
--

INSERT INTO `categoriaalimento` (`idCatAlimento`, `nomeCatAlimento`, `fotoCatAlimento`) VALUES
(1, 'Lanches', ''),
(2, 'Pizzas', ''),
(6, 'Chines', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mesa`
--

CREATE TABLE `mesa` (
  `idMesa` int(11) NOT NULL,
  `idStatusMesa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `mesa`
--

INSERT INTO `mesa` (`idMesa`, `idStatusMesa`) VALUES
(1, 1),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `idPedido` int(11) NOT NULL,
  `nomePedido` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`idPedido`, `nomePedido`) VALUES
(23, '6435e4b9a0bf1'),
(24, '6435e4c5df636'),
(25, '6435e4d4bd733'),
(26, '6435e4da85962'),
(27, '6435f22ecc75c'),
(28, '6435fbc3b9918'),
(29, '6435fc6647606'),
(30, '6435fd57b0fa6'),
(31, '6435fd5c3f864'),
(32, '6435fd6007236');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL,
  `idMesa` int(11) NOT NULL,
  `idAlimento` int(11) NOT NULL,
  `idStatusPedido` int(11) NOT NULL,
  `pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `idMesa`, `idAlimento`, `idStatusPedido`, `pedido`) VALUES
(80, 1, 1, 2, 23),
(81, 1, 2, 2, 24),
(82, 1, 5, 2, 24),
(83, 1, 1, 2, 25),
(84, 1, 3, 2, 25),
(85, 1, 6, 2, 25),
(86, 2, 1, 2, 27),
(87, 2, 3, 2, 27),
(88, 1, 6, 2, 28);

-- --------------------------------------------------------

--
-- Estrutura da tabela `statusmesa`
--

CREATE TABLE `statusmesa` (
  `idStatusMesa` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `statusmesa`
--

INSERT INTO `statusmesa` (`idStatusMesa`, `status`) VALUES
(1, 'Disponível'),
(2, 'Ocupado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `statuspedido`
--

CREATE TABLE `statuspedido` (
  `idStatusPedido` int(11) NOT NULL,
  `statusPedido` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `statuspedido`
--

INSERT INTO `statuspedido` (`idStatusPedido`, `statusPedido`) VALUES
(1, 'Pendente'),
(2, 'Pago');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alimento`
--
ALTER TABLE `alimento`
  ADD PRIMARY KEY (`idAlimento`),
  ADD KEY `idCatAlimento` (`idCatAlimento`);

--
-- Índices para tabela `categoriaalimento`
--
ALTER TABLE `categoriaalimento`
  ADD PRIMARY KEY (`idCatAlimento`);

--
-- Índices para tabela `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`idMesa`),
  ADD KEY `idStatusMesa` (`idStatusMesa`);

--
-- Índices para tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idPedido`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `idAlimento` (`idAlimento`),
  ADD KEY `idMesa` (`idMesa`),
  ADD KEY `idStatusPedido` (`idStatusPedido`),
  ADD KEY `pedidos_ibfk_4` (`pedido`);

--
-- Índices para tabela `statusmesa`
--
ALTER TABLE `statusmesa`
  ADD PRIMARY KEY (`idStatusMesa`);

--
-- Índices para tabela `statuspedido`
--
ALTER TABLE `statuspedido`
  ADD PRIMARY KEY (`idStatusPedido`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alimento`
--
ALTER TABLE `alimento`
  MODIFY `idAlimento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `categoriaalimento`
--
ALTER TABLE `categoriaalimento`
  MODIFY `idCatAlimento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de tabela `statusmesa`
--
ALTER TABLE `statusmesa`
  MODIFY `idStatusMesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `statuspedido`
--
ALTER TABLE `statuspedido`
  MODIFY `idStatusPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `alimento`
--
ALTER TABLE `alimento`
  ADD CONSTRAINT `alimento_ibfk_1` FOREIGN KEY (`idCatAlimento`) REFERENCES `categoriaalimento` (`idCatAlimento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `mesa`
--
ALTER TABLE `mesa`
  ADD CONSTRAINT `mesa_ibfk_1` FOREIGN KEY (`idStatusMesa`) REFERENCES `statusmesa` (`idStatusMesa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`idAlimento`) REFERENCES `alimento` (`idAlimento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`idMesa`) REFERENCES `mesa` (`idMesa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`idStatusPedido`) REFERENCES `statuspedido` (`idStatusPedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_4` FOREIGN KEY (`pedido`) REFERENCES `pedido` (`idPedido`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
