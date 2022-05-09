-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 09 mai 2022 à 13:03
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `photoforyou`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `stat_credit_photo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `stat_credit_photo` ()  BEGIN
INSERT INTO statistique values (now(), "Moyenne_Credit_Photographe ", 4) ;
END$$

--
-- Fonctions
--
DROP FUNCTION IF EXISTS `client_sans_credit`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `client_sans_credit` () RETURNS INT Begin
	declare nbClient int;
	Select count(*) into nbClient
	from users
	where type ="client"
    and users.credit=0;
	return nbClient;
End$$

DROP FUNCTION IF EXISTS `InitCap`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `InitCap` (`chaine` VARCHAR(20)) RETURNS VARCHAR(20) CHARSET utf8 BEGIN
DECLARE machaine varchar(20);
set machaine = concat(upper(substr(chaine,1,1)),lower(substr(chaine,2)));
RETURN machaine;
END$$

DROP FUNCTION IF EXISTS `nbrbis`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `nbrbis` () RETURNS INT Begin
	declare res int;
    Select Count(*) into res from users,photos
    where users.idUsers=photos.id_users;
    return res;
End$$

DROP FUNCTION IF EXISTS `nbrphoto`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `nbrphoto` (`id` INTEGER) RETURNS INT BEGIN
	declare res int;
    if (select idUsers where users.idUser=id and type='photographe')is null then return -1;
    end if;
    Select Count(*) into res from users,photos
    where users.idUsers=photos.id_users;
    return res;
    END$$

DROP FUNCTION IF EXISTS `nbrphotobis`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `nbrphotobis` () RETURNS INT BEGIN
declare res int;
 Select Count(*) into res from users,photos where users.id_user=photos.id_user and users.id_user=id;
return 1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) DEFAULT NULL,
  `lien` varchar(255) DEFAULT NULL,
  `credit_image` int NOT NULL,
  `statut` int NOT NULL,
  `id_proprio` int NOT NULL,
  `id_photographe` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `titre`, `lien`, `credit_image`, `statut`, `id_proprio`, `id_photographe`) VALUES
(116, 'photo', 'images/FD 8.jpg', 4500, 0, 0, 18),
(117, 'fairy tail', 'images/ft1.png', 786, 0, 0, 18),
(114, 'test', 'images/bleach1.jpg', 500, 0, 0, 18);

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int NOT NULL,
  `nom_menu` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `lien` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `habilitation` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statistique`
--

DROP TABLE IF EXISTS `statistique`;
CREATE TABLE IF NOT EXISTS `statistique` (
  `dates` date DEFAULT NULL,
  `champs` varchar(40) DEFAULT NULL,
  `valeurs` decimal(6,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `statistique`
--

INSERT INTO `statistique` (`dates`, `champs`, `valeurs`) VALUES
('0000-00-00', 'moyenne_credit_photographe', '9.99'),
('2022-01-07', 'Moyenne_Credit_Photographe ', '4.00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prenom` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mail` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `type` varchar(25) NOT NULL,
  `credit` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_users`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_users`, `nom`, `prenom`, `mail`, `mdp`, `type`, `credit`) VALUES
(17, 'client', 'client', 'client@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'client', 286900),
(18, 'photographe', 'photographe', 'photographe@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'photographe', 50000),
(1, 'admin', 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
