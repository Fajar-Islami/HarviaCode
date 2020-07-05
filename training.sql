-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.0.51b-community - MySQL Community Edition (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for training
CREATE DATABASE IF NOT EXISTS `training` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `training`;

-- Dumping structure for table training.peserta
CREATE TABLE IF NOT EXISTS `peserta` (
  `idPeserta` int(11) NOT NULL,
  `nama` varchar(50) default NULL,
  `alamat` varchar(100) default NULL,
  `hp` varchar(15) default NULL,
  PRIMARY KEY  (`idPeserta`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table training.peserta: 2 rows
/*!40000 ALTER TABLE `peserta` DISABLE KEYS */;
INSERT INTO `peserta` (`idPeserta`, `nama`, `alamat`, `hp`) VALUES
	(1, 'Annisa', 'Bekasi Timur Raya', '08156723451'),
	(2, 'Juhari', 'Wanaherang', '0857810387699');
/*!40000 ALTER TABLE `peserta` ENABLE KEYS */;

-- Dumping structure for table training.peserta_training
CREATE TABLE IF NOT EXISTS `peserta_training` (
  `idTraining` int(11) default NULL,
  `idPeserta` int(11) default NULL,
  `statusPembayaran` char(1) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table training.peserta_training: 0 rows
/*!40000 ALTER TABLE `peserta_training` DISABLE KEYS */;
INSERT INTO `peserta_training` (`idTraining`, `idPeserta`, `statusPembayaran`) VALUES
	(1, 2, '1'),
	(1, 1, '2'),
	(2, 1, '2');
/*!40000 ALTER TABLE `peserta_training` ENABLE KEYS */;

-- Dumping structure for table training.training
CREATE TABLE IF NOT EXISTS `training` (
  `idTraining` int(11) NOT NULL,
  `nama` varchar(50) default NULL,
  `jenis` char(2) default NULL,
  `tempat` varchar(50) default NULL,
  `tglMulai` date default NULL,
  `tglAkhir` date default NULL,
  `kapasitas` int(11) default NULL,
  PRIMARY KEY  (`idTraining`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table training.training: 0 rows
/*!40000 ALTER TABLE `training` DISABLE KEYS */;
INSERT INTO `training` (`idTraining`, `nama`, `jenis`, `tempat`, `tglMulai`, `tglAkhir`, `kapasitas`) VALUES
	(1, 'Dasar-Dasar Framework', '1', 'Politeknik STMI Jakarta', '2020-02-03', '2020-05-03', 30),
	(2, 'Framework Laravel', '1', 'Politeknik STMI Jakarta', '2020-04-02', '2020-10-02', 15);
/*!40000 ALTER TABLE `training` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
