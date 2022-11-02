-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.11-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para imobi
CREATE DATABASE IF NOT EXISTS `imobi` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `imobi`;

-- Copiando estrutura para tabela imobi.adm_taxa
CREATE TABLE IF NOT EXISTS `adm_taxa` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `VALOR` float NOT NULL DEFAULT 0,
  `CREATED_ID_USER` int(11) NOT NULL DEFAULT 0,
  `CREATED_DATETIME` datetime NOT NULL,
  `ATIVO` int(1) NOT NULL DEFAULT 1 COMMENT '1=ATIVO (DEFAULT) , 2=INATIVO',
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela imobi.adm_taxa: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `adm_taxa` DISABLE KEYS */;
INSERT INTO `adm_taxa` (`ID`, `VALOR`, `CREATED_ID_USER`, `CREATED_DATETIME`, `ATIVO`) VALUES
	(1, 10, 0, '2022-11-01 09:48:26', 0),
	(2, 6, 0, '2022-11-01 09:50:39', 1);
/*!40000 ALTER TABLE `adm_taxa` ENABLE KEYS */;

-- Copiando estrutura para tabela imobi.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TIPO` int(2) NOT NULL DEFAULT 0 COMMENT '1=LOCADOR , 2=LOCATARIO , 3=AMBOS',
  `NOME` varchar(80) NOT NULL,
  `EMAIL` varchar(150) NOT NULL,
  `TELEFONE` varchar(16) NOT NULL,
  `DIA_REPASSE` int(2) NOT NULL DEFAULT 1,
  `CREATED_ID_USER` int(11) NOT NULL DEFAULT 0,
  `CREATED_DATETIME` datetime NOT NULL,
  `ATIVO` int(1) NOT NULL DEFAULT 1 COMMENT '1=ATIVO (DEFAULT) , 2=INATIVO',
  PRIMARY KEY (`ID`),
  KEY `FK_cliente_cliente_tipo` (`TIPO`),
  CONSTRAINT `FK_cliente_cliente_tipo` FOREIGN KEY (`TIPO`) REFERENCES `cliente_tipo` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela imobi.cliente: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Copiando estrutura para tabela imobi.cliente_tipo
CREATE TABLE IF NOT EXISTS `cliente_tipo` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DESC` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela imobi.cliente_tipo: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `cliente_tipo` DISABLE KEYS */;
INSERT INTO `cliente_tipo` (`ID`, `DESC`) VALUES
	(1, 'LOCADOR'),
	(2, 'LOCATARIO'),
	(3, 'AMBOS');
/*!40000 ALTER TABLE `cliente_tipo` ENABLE KEYS */;

-- Copiando estrutura para tabela imobi.contrato
CREATE TABLE IF NOT EXISTS `contrato` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CLIENTE` int(11) NOT NULL DEFAULT 0 COMMENT 'APENAS CLIENTE TIPO',
  `ID_IMOVEL` int(11) NOT NULL DEFAULT 0,
  `DURACAO_MES` int(11) NOT NULL DEFAULT 1 COMMENT 'DEFAULT=1',
  `DT_INICIO` date NOT NULL,
  `DT_FIM` date NOT NULL COMMENT 'GERAR AUTOMATICAMENTE',
  `VALOR_ALUGUEL` float(12,2) NOT NULL DEFAULT 0.00,
  `VALOR_CONDOMINIO` float(12,2) NOT NULL DEFAULT 0.00,
  `VALOR_IPTU` float(12,2) NOT NULL DEFAULT 0.00,
  `VALOR_TX_ADM` float(12,2) NOT NULL DEFAULT 0.00,
  `CREATED_ID_USER` int(11) NOT NULL DEFAULT 0,
  `CREATED_DATETIME` datetime NOT NULL,
  `ATIVO` int(1) NOT NULL DEFAULT 1 COMMENT '1=ATIVO (DEFAULT) , 2=INATIVO',
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela imobi.contrato: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `contrato` DISABLE KEYS */;
/*!40000 ALTER TABLE `contrato` ENABLE KEYS */;

-- Copiando estrutura para tabela imobi.contrato_parcela
CREATE TABLE IF NOT EXISTS `contrato_parcela` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CONTRATO` int(11) NOT NULL DEFAULT 0,
  `TIPO` int(1) NOT NULL DEFAULT 0 COMMENT '1=MENSALIDADE , 2=REPASSE',
  `PARCELA` int(2) NOT NULL DEFAULT 0,
  `VALOR` float(11,2) NOT NULL DEFAULT 0.00,
  `DT_VENCIMENTO` date NOT NULL,
  `REALIZADO` int(1) NOT NULL DEFAULT 1 COMMENT '1=SIM , 2=NAO',
  `DT_REALIZADO` datetime NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela imobi.contrato_parcela: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `contrato_parcela` DISABLE KEYS */;
/*!40000 ALTER TABLE `contrato_parcela` ENABLE KEYS */;

-- Copiando estrutura para tabela imobi.contrato_parcela_tipo
CREATE TABLE IF NOT EXISTS `contrato_parcela_tipo` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DESC` varchar(12) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela imobi.contrato_parcela_tipo: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `contrato_parcela_tipo` DISABLE KEYS */;
INSERT INTO `contrato_parcela_tipo` (`ID`, `DESC`) VALUES
	(1, 'MENSALIDADE'),
	(2, 'REPASSE');
/*!40000 ALTER TABLE `contrato_parcela_tipo` ENABLE KEYS */;

-- Copiando estrutura para tabela imobi.imovel
CREATE TABLE IF NOT EXISTS `imovel` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CLIENTE` int(11) NOT NULL DEFAULT 0,
  `ENDERECO` varchar(150) NOT NULL DEFAULT '0',
  `CREATED_ID_USER` int(11) NOT NULL DEFAULT 0,
  `CREATED_DATETIME` datetime NOT NULL,
  `ATIVO` int(1) NOT NULL DEFAULT 1 COMMENT '1=ATIVO (DEFAULT) , 2=INATIVO',
  PRIMARY KEY (`ID`) USING BTREE,
  KEY `FK_imovel_cliente` (`ID_CLIENTE`),
  CONSTRAINT `FK_imovel_cliente` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `cliente` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela imobi.imovel: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `imovel` DISABLE KEYS */;
/*!40000 ALTER TABLE `imovel` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
