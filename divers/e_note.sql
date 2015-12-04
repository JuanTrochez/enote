-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 04 Décembre 2015 à 14:19
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `e_note`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie_note_frais`
--

CREATE TABLE IF NOT EXISTS `categorie_note_frais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `categorie_note_frais`
--

INSERT INTO `categorie_note_frais` (`id`, `name`) VALUES
(1, 'Avion'),
(2, 'Restaurant'),
(3, 'Train'),
(4, 'Avance'),
(5, 'Carburant'),
(6, 'Hôtel'),
(7, 'Péage');

-- --------------------------------------------------------

--
-- Structure de la table `devise`
--

CREATE TABLE IF NOT EXISTS `devise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `devise`
--

INSERT INTO `devise` (`id`, `name`) VALUES
(1, '€'),
(2, '$');

-- --------------------------------------------------------

--
-- Structure de la table `frais`
--

CREATE TABLE IF NOT EXISTS `frais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `montant` float NOT NULL,
  `devise_id` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `devise_id` (`devise_id`),
  KEY `note_id` (`note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `note_frais`
--

CREATE TABLE IF NOT EXISTS `note_frais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `total` float NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `statut_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categorie_id` (`statut_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Manager'),
(3, 'Employee');

-- --------------------------------------------------------

--
-- Structure de la table `statut_note`
--

CREATE TABLE IF NOT EXISTS `statut_note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `statut_note`
--

INSERT INTO `statut_note` (`id`, `name`) VALUES
(1, 'En cours'),
(2, 'Payee'),
(3, 'Refusee'),
(4, 'Acceptee'),
(5, 'Signee');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `devise_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role` (`role_id`),
  KEY `devise_id` (`devise_id`),
  KEY `devise_id_2` (`devise_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `role_id`, `name`, `devise_id`) VALUES
(1, 'pdg', 'pwdpdg', 1, 'Grand chef', 0),
(2, 'leader', 'pwdleader', 2, 'Chef', 0),
(3, 'pdg', 'pwdpdg', 1, 'Grand chef', 0),
(4, 'leader', 'pwdleader', 2, 'Chef', 0),
(5, 'toto', 'pwdtoto', 3, 'Toto', 0),
(6, 'titi', 'pwdtiti', 3, 'Titi', 0),
(7, 'tata', 'pwdtata', 3, 'Tata', 0),
(8, 'tutu', 'pwdtutu', 3, 'Tutu', 0);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `frais`
--
ALTER TABLE `frais`
  ADD CONSTRAINT `fk_fraisdevise_devise` FOREIGN KEY (`devise_id`) REFERENCES `devise` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notefrais_note` FOREIGN KEY (`note_id`) REFERENCES `note_frais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `note_frais`
--
ALTER TABLE `note_frais`
  ADD CONSTRAINT `fk_statutnote_note` FOREIGN KEY (`statut_id`) REFERENCES `statut_note` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usernote_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_roleuser_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`devise_id`) REFERENCES `devise` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
