-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 15 Décembre 2015 à 10:47
-- Version du serveur :  5.6.26
-- Version de PHP :  5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `e_note`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie_frais`
--

CREATE TABLE IF NOT EXISTS `categorie_frais` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categorie_frais`
--

INSERT INTO `categorie_frais` (`id`, `name`) VALUES
(1, 'Avion'),
(2, 'Restaurant'),
(3, 'Train'),
(4, 'Avance'),
(5, 'Carburant'),
(6, 'H&ocirc;tel'),
(7, 'P&eacute;age');

-- --------------------------------------------------------

--
-- Structure de la table `devise`
--

CREATE TABLE IF NOT EXISTS `devise` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `signe` varchar(30) NOT NULL,
  `taux` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `devise`
--

INSERT INTO `devise` (`id`, `name`, `signe`, `taux`) VALUES
(1, 'Euro', '&euro;', 1),
(2, 'Dollar', '$', 0.9093),
(3, 'Livre', '&#163', 1.3797),
(4, 'Yen', '&#165', 0.0074);

-- --------------------------------------------------------

--
-- Structure de la table `frais`
--

CREATE TABLE IF NOT EXISTS `frais` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `montant` float NOT NULL,
  `devise_id` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `frais`
--

INSERT INTO `frais` (`id`, `image`, `date`, `description`, `montant`, `devise_id`, `note_id`, `categorie_id`) VALUES
(1, 'pdg08-12-2015-16-06-48.jpg', '2015-06-10', 'IZI TRADING', 666, 1, 1, 1),
(3, 'pdg08-12-2015-16-08-17.jpg', '2015-08-01', 'COC + BITCH', 300, 1, 6, 6),
(4, 'pdg08-12-2015-16-09-18.jpg', '2015-03-02', '', 234, 1, 1, 4),
(5, 'pdg08-12-2015-16-09-46.jpg', '2015-06-22', 'biff', 2340, 1, 5, 4),
(6, 'pdg08-12-2015-16-10-21.jpg', '2015-08-19', 'LVMH', 92000000, 1, 5, 4),
(7, 'pdg08-12-2015-16-10-46.jpg', '2015-03-22', 'bibi', 900, 1, 5, 3),
(8, 'pdg08-12-2015-16-11-14.jpg', '2015-05-23', 'DoMac', 5000, 1, 5, 2),
(9, 'pdg08-12-2015-16-12-17.jpg', '2015-12-06', 'DOLLADOLLA', 200, 1, 1, 7),
(10, 'pdg08-12-2015-16-12-45.jpg', '2015-02-27', 'IZI MONNAIE', 10000, 1, 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `modification`
--

CREATE TABLE IF NOT EXISTS `modification` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `change_id` int(11) NOT NULL,
  `table_name` text NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `note_frais`
--

CREATE TABLE IF NOT EXISTS `note_frais` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `statut_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `note_frais`
--

INSERT INTO `note_frais` (`id`, `name`, `date`, `user_id`, `statut_id`) VALUES
(1, 'Note 1', '2015-12-06', 1, 1),
(4, 'Note 4', '2015-06-20', 1, 5),
(5, 'Note 5', '2015-08-03', 1, 2),
(6, 'Note 6', '2015-12-08', 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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
  `id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `statut_note`
--

INSERT INTO `statut_note` (`id`, `name`) VALUES
(1, 'Non publi&eacute;e'),
(2, 'En cours'),
(3, 'Refus&eacute;e'),
(4, 'Accept&eacute;e'),
(5, 'Pay&eacute;e');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `name` varchar(99) NOT NULL,
  `login` varchar(75) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(150) NOT NULL,
  `role_id` int(11) NOT NULL,
  `devise_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `name`, `login`, `password`, `mail`, `role_id`, `devise_id`) VALUES
(1, 'Grand chef', 'pdg', 'pwdpdg', '', 1, 1),
(2, 'Chef', 'leader', 'pwdleader', '', 2, 1),
(5, 'Toto', 'toto', 'pwdtoto', '', 3, 1),
(6, 'Titi', 'titi', 'pwdtiti', '', 3, 1),
(7, 'Tata', 'tata', 'pwdtata', '', 3, 1),
(8, 'Tutu', 'tutu', 'pwdtutu', '', 3, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categorie_frais`
--
ALTER TABLE `categorie_frais`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `devise`
--
ALTER TABLE `devise`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `frais`
--
ALTER TABLE `frais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `devise_id` (`devise_id`),
  ADD KEY `note_id` (`note_id`),
  ADD KEY `categorie_id` (`categorie_id`);

--
-- Index pour la table `modification`
--
ALTER TABLE `modification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index` (`author_id`);

--
-- Index pour la table `note_frais`
--
ALTER TABLE `note_frais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie_id` (`statut_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `statut_note`
--
ALTER TABLE `statut_note`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role_id`),
  ADD KEY `devise_id` (`devise_id`),
  ADD KEY `devise_id_2` (`devise_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categorie_frais`
--
ALTER TABLE `categorie_frais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `devise`
--
ALTER TABLE `devise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `frais`
--
ALTER TABLE `frais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `modification`
--
ALTER TABLE `modification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `note_frais`
--
ALTER TABLE `note_frais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `statut_note`
--
ALTER TABLE `statut_note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `frais`
--
ALTER TABLE `frais`
  ADD CONSTRAINT `fk_categoriefrais_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categorie_frais` (`id`),
  ADD CONSTRAINT `fk_fraisdevise_devise` FOREIGN KEY (`devise_id`) REFERENCES `devise` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notefrais_note` FOREIGN KEY (`note_id`) REFERENCES `note_frais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `modification`
--
ALTER TABLE `modification`
  ADD CONSTRAINT `modification_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `note_frais`
--
ALTER TABLE `note_frais`
  ADD CONSTRAINT `fk_statutnote_note` FOREIGN KEY (`statut_id`) REFERENCES `statut_note` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usernote_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_roleuser_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`devise_id`) REFERENCES `devise` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
