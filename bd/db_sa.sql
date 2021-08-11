-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.25 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para db_sa
DROP DATABASE IF EXISTS `db_sa`;
CREATE DATABASE IF NOT EXISTS `db_sa` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_sa`;

-- Copiando estrutura para tabela db_sa.apartamentos
DROP TABLE IF EXISTS `apartamentos`;
CREATE TABLE IF NOT EXISTS `apartamentos` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `torre` varchar(45) NOT NULL,
  `apartamento` varchar(45) NOT NULL,
  `usuario_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_apartamentos_usuarios` (`usuario_id`),
  CONSTRAINT `FK_apartamentos_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela db_sa.apartamentos: ~254 rows (aproximadamente)
DELETE FROM `apartamentos`;
/*!40000 ALTER TABLE `apartamentos` DISABLE KEYS */;
INSERT INTO `apartamentos` (`id`, `torre`, `apartamento`, `usuario_id`) VALUES
	(1, '1', '101', 4),
	(2, '1', '102', 5),
	(3, '1', '103', 6),
	(4, '1', '104', 7),
	(5, '1', '201', 8),
	(6, '1', '202', 9),
	(7, '1', '203', NULL),
	(8, '1', '204', 10),
	(9, '1', '301', 13),
	(10, '1', '302', NULL),
	(11, '1', '303', NULL),
	(12, '1', '304', NULL),
	(13, '1', '401', NULL),
	(14, '1', '402', NULL),
	(15, '1', '403', NULL),
	(16, '1', '404', NULL),
	(17, '1', '501', NULL),
	(18, '1', '502', NULL),
	(19, '1', '503', NULL),
	(20, '1', '504', NULL),
	(21, '1', '601', NULL),
	(22, '1', '602', NULL),
	(23, '1', '603', NULL),
	(24, '1', '604', NULL),
	(25, '1', '701', NULL),
	(26, '1', '702', NULL),
	(27, '1', '703', NULL),
	(28, '1', '704', NULL),
	(29, '1', '801', NULL),
	(30, '1', '802', NULL),
	(31, '1', '803', NULL),
	(32, '1', '804', NULL),
	(33, '2', '101', NULL),
	(34, '2', '102', NULL),
	(35, '2', '103', NULL),
	(36, '2', '104', NULL),
	(37, '2', '201', NULL),
	(38, '2', '202', NULL),
	(39, '2', '203', NULL),
	(40, '2', '204', NULL),
	(41, '2', '301', NULL),
	(42, '2', '302', NULL),
	(43, '2', '303', NULL),
	(44, '2', '304', NULL),
	(45, '2', '401', NULL),
	(46, '2', '402', NULL),
	(47, '2', '403', NULL),
	(48, '2', '404', NULL),
	(49, '2', '501', NULL),
	(50, '2', '502', NULL),
	(51, '2', '503', NULL),
	(52, '2', '504', NULL),
	(53, '2', '601', NULL),
	(54, '2', '602', NULL),
	(55, '2', '603', NULL),
	(56, '2', '604', NULL),
	(57, '2', '701', NULL),
	(58, '2', '702', NULL),
	(59, '2', '703', NULL),
	(60, '2', '704', NULL),
	(61, '2', '801', NULL),
	(62, '2', '802', NULL),
	(63, '2', '803', NULL),
	(64, '2', '804', NULL);
/*!40000 ALTER TABLE `apartamentos` ENABLE KEYS */;

-- Copiando estrutura para tabela db_sa.encomendas
DROP TABLE IF EXISTS `encomendas`;
CREATE TABLE IF NOT EXISTS `encomendas` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `morador_id` int unsigned DEFAULT NULL,
  `destinatario` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `remetente` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `data_recebimento` datetime NOT NULL,
  `data_entrega` datetime DEFAULT NULL,
  `observacao` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `porteiro_recebeu` int unsigned DEFAULT NULL,
  `porteiro_entregou` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_encomendas_porteiro_recebeu` (`porteiro_recebeu`),
  KEY `FK_encomendas_porteiro_entregou` (`porteiro_entregou`),
  KEY `FK_encomendas_moradores` (`morador_id`),
  CONSTRAINT `FK_encomendas_moradores` FOREIGN KEY (`morador_id`) REFERENCES `moradores` (`id`),
  CONSTRAINT `FK_encomendas_porteiro_entregou` FOREIGN KEY (`porteiro_entregou`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `FK_encomendas_porteiro_recebeu` FOREIGN KEY (`porteiro_recebeu`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela db_sa.encomendas: ~2 rows (aproximadamente)
DELETE FROM `encomendas`;
/*!40000 ALTER TABLE `encomendas` DISABLE KEYS */;
INSERT INTO `encomendas` (`id`, `morador_id`, `destinatario`, `remetente`, `data_recebimento`, `data_entrega`, `observacao`, `porteiro_recebeu`, `porteiro_entregou`) VALUES
	(1, NULL, 'Reinaldo Azevedo', 'Correios', '2021-07-26 20:37:00', NULL, '', 1, NULL),
	(2, 1, 'Mark dos Santos', 'Correios', '2021-07-26 20:37:00', NULL, '', 1, NULL),
	(3, 6, 'Leo Larios Varela', 'Mercado Livre', '2021-07-19 20:38:00', NULL, '', 1, NULL),
	(4, 8, 'Caio Varela', 'Amazon', '2021-07-22 20:38:00', NULL, '', 1, NULL),
	(5, 5, 'Jonata Cairres Belmonte', 'Correios', '2021-07-26 20:38:00', NULL, '', 1, NULL),
	(6, NULL, 'Viviane Santos', 'Casas Bahia', '2021-07-15 20:39:00', NULL, '', 1, NULL);
/*!40000 ALTER TABLE `encomendas` ENABLE KEYS */;

-- Copiando estrutura para tabela db_sa.moradores
DROP TABLE IF EXISTS `moradores`;
CREATE TABLE IF NOT EXISTS `moradores` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `documento` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nascimento` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `usuario_id` int unsigned DEFAULT NULL,
  `apartamento_id` int unsigned DEFAULT NULL,
  `data_entrada` date DEFAULT NULL,
  `data_saida` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_moradores_usuarios` (`usuario_id`),
  KEY `FK_moradores_apartamentos` (`apartamento_id`),
  CONSTRAINT `FK_moradores_apartamentos` FOREIGN KEY (`apartamento_id`) REFERENCES `apartamentos` (`id`),
  CONSTRAINT `FK_moradores_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela db_sa.moradores: ~4 rows (aproximadamente)
DELETE FROM `moradores`;
/*!40000 ALTER TABLE `moradores` DISABLE KEYS */;
INSERT INTO `moradores` (`id`, `nome`, `sobrenome`, `documento`, `nascimento`, `email`, `telefone`, `usuario_id`, `apartamento_id`, `data_entrada`, `data_saida`) VALUES
	(1, 'Mark', 'dos Santos', '215.456.487-87', '2005-06-05', 'mark@gmail.com', '(48) 45457-8452', 4, 1, '2021-07-01', NULL),
	(2, 'Aliana', 'dos Santos', '154.213.545-45', '2008-07-14', 'aliana@gmail.com', '(65) 44545-4545', 4, 1, '2021-07-01', NULL),
	(3, 'Anselmo', 'dos Santos', '546.546.546-78', '1978-05-05', 'anselmo@gmail.com', '(22) 11245-4454', 4, 1, '2021-07-01', NULL),
	(4, 'Maria', 'dos Santos', '454.545.487-87', '1988-04-03', 'maria@gmail.com', '(47) 48545-4848', 4, 1, '2021-07-26', NULL),
	(5, 'Jonatã', 'Caires Belmonte', '124.548.787-82', '1988-04-03', 'jonata@gmail.com', '(46) 45646-8465', 13, 9, '2021-07-01', NULL),
	(6, 'Leo', 'Lários Varela', '513.545.454-54', '1990-03-01', 'leo@gmail.com', '(15) 45457-8313', 10, 8, '2021-07-26', NULL),
	(7, 'Eunice', 'Varela', '313.154.548-41', '1995-07-19', 'eunice@gmail.com', '(24) 54846-7864', 10, 8, '2021-07-26', NULL),
	(8, 'Caio', 'Valera', '332.154.656-87', '2020-12-27', 'leo@gmail.com', '(47) 45457-8787', 10, 8, '2021-07-26', NULL),
	(9, 'Leticia', 'Varela', '654.678.784-68', '2021-01-26', 'leo@gmail.com', '(47) 45454-5454', 10, 8, '2021-07-27', NULL);
/*!40000 ALTER TABLE `moradores` ENABLE KEYS */;

-- Copiando estrutura para tabela db_sa.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sobrenome` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tipo` enum('MORADOR','PORTEIRO','SINDICO') NOT NULL DEFAULT 'MORADOR',
  `ativo` enum('ATIVO','INATIVO') DEFAULT 'ATIVO',
  `nascimento` date DEFAULT NULL,
  `telefone` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela db_sa.usuarios: ~5 rows (aproximadamente)
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nome`, `sobrenome`, `email`, `senha`, `tipo`, `ativo`, `nascimento`, `telefone`) VALUES
	(1, 'Usuario', 'Admin', 'admin@admin.com', '$2y$10$vXpUPf6hm636pg5xVkfhYOnwuU2tH.lFv3hihXRwjrdEzSjT41chi', 'SINDICO', 'ATIVO', NULL, NULL),
	(2, 'Simone', 'Brandão', 'simone@gmail.com', '$2y$10$Uyp0p77SjNhtR9gSwTC9fea.iU5aENNLJcx5./9.je2kCnvv9zufC', 'SINDICO', 'ATIVO', '1968-10-03', '(96)40934-0267'),
	(3, 'Heimdall', 'o Guardião', 'porteiro@gmail.com', '$2y$10$vIkTiJXeEjzCK4ULdul1j.5iQgQuGChRgRgCCWoqb8OD9Z9.2qMnm', 'PORTEIRO', 'ATIVO', '1973-06-21', '(32)01657-8720'),
	(4, 'Maria', 'dos Santos', 'maria@gmail.com', '$2y$10$YdFFPgT4aTzmlAnKn2ipcuhdj/aGGHdspeY.8gP0vD6MlgmBcAH9O', 'MORADOR', 'ATIVO', '1974-12-19', '(63)26310-6347'),
	(5, 'Marcela', 'Ferraz', 'marcela@gmail.com', '$2y$10$8tZyZmmMxLdIyLsqKADMtOH.ncE9QhCRpdOuwrJRLJ4nEeSXPvFRG', 'MORADOR', 'ATIVO', NULL, NULL),
	(6, 'Aires', 'Nobre Freitas', 'aires@gmail.com', '$2y$10$1Yxp8PEI/kFEKgAheC3eCuR5IfzcZ55uZgQtoIjVWD9aOYb66NwK2', 'MORADOR', 'ATIVO', NULL, NULL),
	(7, 'Safira', 'Albernaz Caeiro', 'safira@gmail.com', '$2y$10$FBbfwtyeOtZJfApgjM36T.ez3vkSjqmEtJabB6p3htNkr0fNbvwgm', 'MORADOR', 'ATIVO', NULL, NULL),
	(8, 'Laís', 'Cordeiro Vilarinho', 'lais@gmail.com', '$2y$10$GAj.goL3mu7BQuT3wG7e9uK8FAs2.YoBTQEWyZ9CeRv5W8ZqFWBSC', 'MORADOR', 'ATIVO', NULL, NULL),
	(9, 'Zoé', 'Gama Coronel', 'zoe@gmail.com', '$2y$10$GmNOPYvdXkESvrdYU8TUcOpnBjPxgViokIcKA/l7cPo9WacQ8R6Q6', 'MORADOR', 'ATIVO', NULL, NULL),
	(10, 'Leo', 'Lários Varela', 'leo@gmail.com', '$2y$10$0Q7zMM.IQVtoTXcPXodPRu4gS0/DuxTxVYzi/eH9XUDyTXYi0zlkG', 'MORADOR', 'ATIVO', NULL, NULL),
	(11, 'Edna', 'Mirandela', 'edna@gmail.com', '$2y$10$Vwkor5jcwISXnBEk6bSkb.kubfjEcXW8HtkfhjoNCR6TCHSF75H3S', 'MORADOR', 'ATIVO', NULL, NULL),
	(12, 'Lúcia', 'França', 'lucia@gmail.com', '$2y$10$v/neqgjEefZ1K.euvEesoOq3axuRBJ5Zju9oSEJoU6mlXUxM3Ub1e', 'MORADOR', 'ATIVO', NULL, NULL),
	(13, 'Jonatã', 'Caires Belmonte', 'jonata@gmail.com', '$2y$10$22p9sUUyhLsdXjoNplEbU.BdpM0sx8Gbr2h3B47opLh2MQZaclsEa', 'MORADOR', 'ATIVO', NULL, NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
