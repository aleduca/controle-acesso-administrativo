# ************************************************************
# Sequel Pro SQL dump
# Versão 4529
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.6.23)
# Base de Dados: controle_acesso
# Tempo de Geração: 2017-11-02 17:44:43 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump da tabela administradores
# ------------------------------------------------------------

DROP TABLE IF EXISTS `administradores`;

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `master` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `administradores` WRITE;
/*!40000 ALTER TABLE `administradores` DISABLE KEYS */;

INSERT INTO `administradores` (`id`, `name`, `email`, `password`, `master`)
VALUES
	(1,'Alexandre','xandecar@hotmail.com','$2y$12$yb9d.65ChqKM3d4kGANcp.GDTo1/ROUfQEchLOzT2KoA6CvdY/oxW',1),
	(2,'Joao','joao@email.com.br','$2y$12$TtVZcwnx/eI9fvPWMxz37OYENYbm7ouM4eJ3HuxvW2trXca5iMeAq',0);

/*!40000 ALTER TABLE `administradores` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela permission
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permission`;

CREATE TABLE `permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` int(11) NOT NULL,
  `controller` varchar(100) NOT NULL,
  `action` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;

INSERT INTO `permission` (`id`, `admin`, `controller`, `action`, `created_at`)
VALUES
	(26,2,'PainelController','update','2017-10-29 02:37:33'),
	(27,2,'AdministradoresController','index','2017-10-29 02:37:38'),
	(28,2,'AdministradoresController','destroy','2017-10-29 02:40:03'),
	(39,2,'AdministradoresController','create','2017-10-29 20:39:01'),
	(55,2,'AdministradoresController','edit','2017-10-31 18:57:00'),
	(56,2,'AdministradoresController','store','2017-10-31 18:57:19');

/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
