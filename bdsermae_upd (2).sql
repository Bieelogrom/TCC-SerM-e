-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/11/2023 às 23:09
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdsermae_upd`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbcomentarios`
--

CREATE TABLE `tbcomentarios` (
  `idComentario` int(11) NOT NULL,
  `comentario` varchar(200) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idPublicacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbcurtidas`
--

CREATE TABLE `tbcurtidas` (
  `idCurtida` int(11) NOT NULL,
  `idPublicacao` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `dataCurtida` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbdenuncias`
--

CREATE TABLE `tbdenuncias` (
  `idDenuncia` int(11) NOT NULL,
  `tipoDenuncia` varchar(20) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idPublicacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbnivelconta`
--

CREATE TABLE `tbnivelconta` (
  `idNivelConta` int(11) NOT NULL,
  `nivelConta` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbnivelconta`
--

INSERT INTO `tbnivelconta` (`idNivelConta`, `nivelConta`) VALUES
(1, 'Comum'),
(2, 'Verificado'),
(3, 'Admin');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbpublicacao`
--

CREATE TABLE `tbpublicacao` (
  `idPublicacao` int(11) NOT NULL,
  `legendaPublicacao` text NOT NULL,
  `imgPublicacao` text NOT NULL,
  `dataPublicacao` datetime NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbsalvos`
--

CREATE TABLE `tbsalvos` (
  `idSalvos` int(11) NOT NULL,
  `idPublicacao` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbstatusconta`
--

CREATE TABLE `tbstatusconta` (
  `idStatusConta` int(11) NOT NULL,
  `statusConta` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbstatusconta`
--

INSERT INTO `tbstatusconta` (`idStatusConta`, `statusConta`) VALUES
(1, 'Ativo'),
(2, 'Suspenso'),
(3, 'Banido');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbtipoperfil`
--

CREATE TABLE `tbtipoperfil` (
  `idTipo` int(11) NOT NULL,
  `tipoConta` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbtipoperfil`
--

INSERT INTO `tbtipoperfil` (`idTipo`, `tipoConta`) VALUES
(1, 'Mãe Convencional '),
(2, 'Gestante'),
(3, 'Tentante'),
(4, 'Mãe Solo'),
(5, '-');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbusuario`
--

CREATE TABLE `tbusuario` (
  `idUsuario` int(11) NOT NULL,
  `nomeUsuario` varchar(100) NOT NULL,
  `apelidoUsuario` varchar(30) DEFAULT NULL,
  `emailUsuario` varchar(125) NOT NULL,
  `telefoneUsuario` varchar(22) NOT NULL,
  `senhaUsuario` varchar(100) NOT NULL,
  `bioUsuario` varchar(125) NOT NULL DEFAULT 'Olá, eu sou novo no SerMãe!',
  `nascUsuario` date NOT NULL,
  `fotoUsuario` text NOT NULL,
  `capaUsuario` text NOT NULL,
  `statusConta` int(10) NOT NULL DEFAULT 1,
  `nivelConta` int(10) NOT NULL DEFAULT 1,
  `tipoConta` int(10) NOT NULL DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tbcomentarios`
--
ALTER TABLE `tbcomentarios`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idPublicacao` (`idPublicacao`);

--
-- Índices de tabela `tbcurtidas`
--
ALTER TABLE `tbcurtidas`
  ADD PRIMARY KEY (`idCurtida`),
  ADD KEY `idPublicacao` (`idPublicacao`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices de tabela `tbdenuncias`
--
ALTER TABLE `tbdenuncias`
  ADD PRIMARY KEY (`idDenuncia`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idPublicacao` (`idPublicacao`);

--
-- Índices de tabela `tbnivelconta`
--
ALTER TABLE `tbnivelconta`
  ADD PRIMARY KEY (`idNivelConta`);

--
-- Índices de tabela `tbpublicacao`
--
ALTER TABLE `tbpublicacao`
  ADD PRIMARY KEY (`idPublicacao`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices de tabela `tbsalvos`
--
ALTER TABLE `tbsalvos`
  ADD PRIMARY KEY (`idSalvos`),
  ADD KEY `idPublicacao` (`idPublicacao`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices de tabela `tbstatusconta`
--
ALTER TABLE `tbstatusconta`
  ADD PRIMARY KEY (`idStatusConta`);

--
-- Índices de tabela `tbtipoperfil`
--
ALTER TABLE `tbtipoperfil`
  ADD PRIMARY KEY (`idTipo`);

--
-- Índices de tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `unique_emailUsuario` (`emailUsuario`),
  ADD UNIQUE KEY `unique_senhaUsuario` (`senhaUsuario`),
  ADD UNIQUE KEY `unique_telefoneUsuario` (`telefoneUsuario`),
  ADD KEY `tipoConta` (`tipoConta`),
  ADD KEY `statusConta` (`statusConta`),
  ADD KEY `nivelConta` (`nivelConta`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbcomentarios`
--
ALTER TABLE `tbcomentarios`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbcurtidas`
--
ALTER TABLE `tbcurtidas`
  MODIFY `idCurtida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbdenuncias`
--
ALTER TABLE `tbdenuncias`
  MODIFY `idDenuncia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbnivelconta`
--
ALTER TABLE `tbnivelconta`
  MODIFY `idNivelConta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tbpublicacao`
--
ALTER TABLE `tbpublicacao`
  MODIFY `idPublicacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbsalvos`
--
ALTER TABLE `tbsalvos`
  MODIFY `idSalvos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbstatusconta`
--
ALTER TABLE `tbstatusconta`
  MODIFY `idStatusConta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tbtipoperfil`
--
ALTER TABLE `tbtipoperfil`
  MODIFY `idTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tbcomentarios`
--
ALTER TABLE `tbcomentarios`
  ADD CONSTRAINT `tbcomentarios_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`),
  ADD CONSTRAINT `tbcomentarios_ibfk_2` FOREIGN KEY (`idPublicacao`) REFERENCES `tbpublicacao` (`idPublicacao`);

--
-- Restrições para tabelas `tbcurtidas`
--
ALTER TABLE `tbcurtidas`
  ADD CONSTRAINT `tbcurtidas_ibfk_1` FOREIGN KEY (`idPublicacao`) REFERENCES `tbpublicacao` (`idPublicacao`),
  ADD CONSTRAINT `tbcurtidas_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`);

--
-- Restrições para tabelas `tbdenuncias`
--
ALTER TABLE `tbdenuncias`
  ADD CONSTRAINT `tbdenuncias_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`),
  ADD CONSTRAINT `tbdenuncias_ibfk_2` FOREIGN KEY (`idPublicacao`) REFERENCES `tbpublicacao` (`idPublicacao`);

--
-- Restrições para tabelas `tbpublicacao`
--
ALTER TABLE `tbpublicacao`
  ADD CONSTRAINT `tbpublicacao_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`);

--
-- Restrições para tabelas `tbsalvos`
--
ALTER TABLE `tbsalvos`
  ADD CONSTRAINT `tbsalvos_ibfk_1` FOREIGN KEY (`idPublicacao`) REFERENCES `tbpublicacao` (`idPublicacao`),
  ADD CONSTRAINT `tbsalvos_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`);

--
-- Restrições para tabelas `tbusuario`
--
ALTER TABLE `tbusuario`
  ADD CONSTRAINT `tbusuario_ibfk_1` FOREIGN KEY (`tipoConta`) REFERENCES `tbtipoperfil` (`idTipo`),
  ADD CONSTRAINT `tbusuario_ibfk_2` FOREIGN KEY (`statusConta`) REFERENCES `tbstatusconta` (`idStatusConta`),
  ADD CONSTRAINT `tbusuario_ibfk_3` FOREIGN KEY (`nivelConta`) REFERENCES `tbnivelconta` (`idNivelConta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
