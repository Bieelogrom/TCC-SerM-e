-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Nov-2023 às 11:53
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

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
-- Estrutura da tabela `tbcomentarios`
--

CREATE TABLE `tbcomentarios` (
  `idComentario` int(11) NOT NULL,
  `comentario` varchar(200) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idPublicacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcomunidade`
--

CREATE TABLE `tbcomunidade` (
  `idComunidade` int(11) NOT NULL,
  `nomeComunidade` varchar(255) NOT NULL,
  `assuntoComunidade` varchar(255) NOT NULL,
  `linkComunidade` varchar(399) NOT NULL,
  `imgComunidade` varchar(255) NOT NULL,
  `situacaoComunidade` int(11) NOT NULL,
  `dataComunidade` datetime NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tbcomunidade`
--

INSERT INTO `tbcomunidade` (`idComunidade`, `nomeComunidade`, `assuntoComunidade`, `linkComunidade`, `imgComunidade`, `situacaoComunidade`, `dataComunidade`, `idUsuario`) VALUES
(10, 'dada', 'Saúde física', 'dsadsadas', '655d863da886ainstagram_logo_icon_214683.png', 2, '2023-11-22 01:40:29', 2),
(11, 'Anitta lovers', 'Maternidade', 'dsadasdas', '655e929b1d3efCaptura de tela 2023-11-15 120333.png', 2, '2023-11-22 20:45:31', 1),
(12, 'Anitta lovers', 'Filhos (criação)', 'dddddddddddddddddddd', '655e9d3a4b2feCaptura de tela 2023-10-30 161659.png', 1, '2023-11-22 21:30:50', 1),
(14, 'Mães Solo', 'Maternidade', 'https://t.me/+UDDckBvCtyg5Yjdh', '655eb8f460a6emaes solo.jpg', 1, '2023-11-22 23:29:08', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcurtidas`
--

CREATE TABLE `tbcurtidas` (
  `idCurtida` int(11) NOT NULL,
  `idPublicacao` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `dataCurtida` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdenuncias`
--

CREATE TABLE `tbdenuncias` (
  `idDenuncia` int(11) NOT NULL,
  `tipoDenuncia` varchar(20) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idPublicacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbnivelconta`
--

CREATE TABLE `tbnivelconta` (
  `idNivelConta` int(11) NOT NULL,
  `nivelConta` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tbnivelconta`
--

INSERT INTO `tbnivelconta` (`idNivelConta`, `nivelConta`) VALUES
(1, 'Comum'),
(2, 'Verificado'),
(3, 'Admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpublicacao`
--

CREATE TABLE `tbpublicacao` (
  `idPublicacao` int(11) NOT NULL,
  `legendaPublicacao` text NOT NULL,
  `imgPublicacao` text NOT NULL,
  `dataPublicacao` datetime NOT NULL,
  `numCurtidasPublicacao` int(11) NOT NULL,
  `numCompartPublicacao` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tbpublicacao`
--

INSERT INTO `tbpublicacao` (`idPublicacao`, `legendaPublicacao`, `imgPublicacao`, `dataPublicacao`, `numCurtidasPublicacao`, `numCompartPublicacao`, `idUsuario`) VALUES
(2, 'kk', '655ef891268eamaes solo.jpg', '2023-11-23 04:00:33', 0, 0, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbsalvos`
--

CREATE TABLE `tbsalvos` (
  `idSalvos` int(11) NOT NULL,
  `idPublicacao` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbstatusconta`
--

CREATE TABLE `tbstatusconta` (
  `idStatusConta` int(11) NOT NULL,
  `statusConta` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tbstatusconta`
--

INSERT INTO `tbstatusconta` (`idStatusConta`, `statusConta`) VALUES
(1, 'Ativo'),
(2, 'Suspenso'),
(3, 'Banido');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbtipoperfil`
--

CREATE TABLE `tbtipoperfil` (
  `idTipo` int(11) NOT NULL,
  `tipoConta` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tbtipoperfil`
--

INSERT INTO `tbtipoperfil` (`idTipo`, `tipoConta`) VALUES
(1, 'Mãe Convencional '),
(2, 'Gestante'),
(3, 'Tentante'),
(4, 'Mãe Solo'),
(5, 'Nenhum dos anteriore');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuario`
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
-- Extraindo dados da tabela `tbusuario`
--

INSERT INTO `tbusuario` (`idUsuario`, `nomeUsuario`, `apelidoUsuario`, `emailUsuario`, `telefoneUsuario`, `senhaUsuario`, `bioUsuario`, `nascUsuario`, `fotoUsuario`, `capaUsuario`, `statusConta`, `nivelConta`, `tipoConta`) VALUES
(1, 'Cristina Souza', '@MomLife92', 'cristina@gmail.com', '(11) 95327-1031', '$2y$10$2pPsVDybOG8kva/cQ9NZGuUHNjJxXaJb0bgl33yXQI2a63aQtCTDW', 'Olá, eu sou novo no SerMãe!', '2000-09-19', '655d71e5b7f5cfoto-perfil.jpg', '', 1, 3, 2),
(2, 'Arlequina Palhaçinha', '@MomStrong23', 'arlequina@gmail.com', '(11) 94888-1078', '$2y$10$Z0sALPJDh1MYWKCuI8ohfunV0NGjDQHG7SrmKkp.0z91gfsA6LjHS', 'Olá, eu sou novo no SerMãe!', '1990-11-12', '655d855e3bacbvista-frontal-mulher-comemorando-aniversario-juntos.jpg', '', 1, 3, 4),
(3, 'Aline Cordeiro', '@MommaMagic81', 'aline@gmail.com', '(11) 98338-5268', '$2y$10$z7xgj/kfcDuwu8KO1XDRxu9iN63BXP2mXq39a.AF4HdyFzMCmpxBi', 'Olá, eu sou novo no SerMãe!', '1212-12-12', '655f2e951326aaline.jpg', '', 1, 1, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tbcomunidade`
--
ALTER TABLE `tbcomunidade`
  ADD PRIMARY KEY (`idComunidade`),
  ADD KEY `idUsuario` (`idUsuario`) USING BTREE;

--
-- Índices para tabela `tbpublicacao`
--
ALTER TABLE `tbpublicacao`
  ADD PRIMARY KEY (`idPublicacao`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices para tabela `tbtipoperfil`
--
ALTER TABLE `tbtipoperfil`
  ADD PRIMARY KEY (`idTipo`);

--
-- Índices para tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `unique_emailUsuario` (`emailUsuario`),
  ADD UNIQUE KEY `unique_senhaUsuario` (`senhaUsuario`),
  ADD UNIQUE KEY `unique_telefoneUsuario` (`telefoneUsuario`),
  ADD KEY `tipoConta` (`tipoConta`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbcomunidade`
--
ALTER TABLE `tbcomunidade`
  MODIFY `idComunidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `tbpublicacao`
--
ALTER TABLE `tbpublicacao`
  MODIFY `idPublicacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbtipoperfil`
--
ALTER TABLE `tbtipoperfil`
  MODIFY `idTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tbpublicacao`
--
ALTER TABLE `tbpublicacao`
  ADD CONSTRAINT `tbpublicacao_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`);

--
-- Limitadores para a tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  ADD CONSTRAINT `tbusuario_ibfk_1` FOREIGN KEY (`tipoConta`) REFERENCES `tbtipoperfil` (`idTipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
