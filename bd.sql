-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.27-0ubuntu0.18.04.1 - (Ubuntu)
-- OS do Servidor:               Linux
-- HeidiSQL Versão:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para goals
CREATE DATABASE IF NOT EXISTS `goals` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `goals`;

-- Copiando estrutura para tabela goals.complexities
DROP TABLE IF EXISTS `complexities`;
CREATE TABLE IF NOT EXISTS `complexities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fibonacci` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela goals.complexities: ~6 rows (aproximadamente)
DELETE FROM `complexities`;
/*!40000 ALTER TABLE `complexities` DISABLE KEYS */;
INSERT INTO `complexities` (`id`, `fibonacci`) VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 5),
	(5, 8),
	(6, 13);
/*!40000 ALTER TABLE `complexities` ENABLE KEYS */;

-- Copiando estrutura para tabela goals.configuration
DROP TABLE IF EXISTS `configuration`;
CREATE TABLE IF NOT EXISTS `configuration` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `config_time` int(1) DEFAULT '0',
  `config_proccess` int(1) DEFAULT '0',
  `config_bugs` int(1) DEFAULT '0',
  `config_impact` int(1) DEFAULT '0',
  `config_member` int(1) DEFAULT '0',
  `config_font` int(1) DEFAULT '0',
  `config_tag` int(1) DEFAULT '0',
  `config_high_impact` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela goals.configuration: ~1 rows (aproximadamente)
DELETE FROM `configuration`;
/*!40000 ALTER TABLE `configuration` DISABLE KEYS */;
INSERT INTO `configuration` (`id`, `config_time`, `config_proccess`, `config_bugs`, `config_impact`, `config_member`, `config_font`, `config_tag`, `config_high_impact`) VALUES
	(1, 5, 2, 5, 60, 50, 100, 30, 300);
/*!40000 ALTER TABLE `configuration` ENABLE KEYS */;

-- Copiando estrutura para tabela goals.dutys
DROP TABLE IF EXISTS `dutys`;
CREATE TABLE IF NOT EXISTS `dutys` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_employee_id` int(11) unsigned NOT NULL,
  `week` varchar(60) NOT NULL,
  `points` int(3) DEFAULT NULL,
  `evaluate` int(1) NOT NULL DEFAULT '0',
  `pay` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_employee_id` (`fk_employee_id`),
  CONSTRAINT `fk_employee_idd` FOREIGN KEY (`fk_employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela goals.dutys: ~0 rows (aproximadamente)
DELETE FROM `dutys`;
/*!40000 ALTER TABLE `dutys` DISABLE KEYS */;
/*!40000 ALTER TABLE `dutys` ENABLE KEYS */;

-- Copiando estrutura para tabela goals.employees
DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela goals.employees: ~10 rows (aproximadamente)
DELETE FROM `employees`;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` (`id`, `name`) VALUES
	(4, 'Brendo Oliveira'),
	(8, 'Priscylla Reis'),
	(10, 'Aline Correa'),
	(11, 'Leonardo Padilha'),
	(12, 'Paola Pereira'),
	(13, 'Marina Rocha'),
	(14, 'Gabriela Nascimento'),
	(15, 'Livia Freitas'),
	(16, 'Sheila Braz'),
	(18, 'Gustavo Rates');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;

-- Copiando estrutura para tabela goals.evaluates
DROP TABLE IF EXISTS `evaluates`;
CREATE TABLE IF NOT EXISTS `evaluates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_user_id` int(11) unsigned NOT NULL,
  `fk_duty_id` int(11) unsigned DEFAULT NULL,
  `fk_task_id` int(11) unsigned DEFAULT NULL,
  `time` int(2) DEFAULT '0',
  `automation` int(1) DEFAULT '0',
  `lighthouse` int(1) DEFAULT '0',
  `trello` int(1) DEFAULT '0',
  `jira` int(1) DEFAULT '0',
  `testrail` int(1) unsigned DEFAULT '0',
  `bugs` int(1) DEFAULT '0',
  `impact` int(1) DEFAULT '0',
  `tag` int(1) DEFAULT '0',
  `member` int(1) DEFAULT '0',
  `font` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`fk_user_id`),
  KEY `fk_task_id` (`fk_task_id`),
  KEY `fk_duty_id` (`fk_duty_id`),
  CONSTRAINT `fk_duty_id` FOREIGN KEY (`fk_duty_id`) REFERENCES `dutys` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_task_id` FOREIGN KEY (`fk_task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_id` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela goals.evaluates: ~0 rows (aproximadamente)
DELETE FROM `evaluates`;
/*!40000 ALTER TABLE `evaluates` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluates` ENABLE KEYS */;

-- Copiando estrutura para tabela goals.payments
DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_task_id` int(11) unsigned DEFAULT NULL,
  `fk_user_id` int(11) unsigned NOT NULL,
  `value` int(60) DEFAULT '0',
  `final_value` int(60) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_user_idd` (`fk_user_id`),
  KEY `fk_task_idd` (`fk_task_id`),
  CONSTRAINT `fk_task_idd` FOREIGN KEY (`fk_task_id`) REFERENCES `tasks` (`id`),
  CONSTRAINT `fk_user_idd` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela goals.payments: ~0 rows (aproximadamente)
DELETE FROM `payments`;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;

-- Copiando estrutura para tabela goals.tasks
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_employee_id` int(11) unsigned NOT NULL,
  `fk_complexity_id` int(11) unsigned NOT NULL,
  `task` varchar(50) DEFAULT NULL,
  `points` int(3) DEFAULT NULL,
  `evaluate` int(1) NOT NULL DEFAULT '0',
  `pay` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_employee_id` (`fk_employee_id`),
  KEY `fk_complexity_id` (`fk_complexity_id`),
  CONSTRAINT `fk_complexity_id` FOREIGN KEY (`fk_complexity_id`) REFERENCES `complexities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_employee_id` FOREIGN KEY (`fk_employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela goals.tasks: ~0 rows (aproximadamente)
DELETE FROM `tasks`;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;

-- Copiando estrutura para tabela goals.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(60) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela goals.users: ~1 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `user`, `password`) VALUES
	(2, 'Brendo', 'e10adc3949ba59abbe56e057f20f883e');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
