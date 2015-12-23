-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 23 Décembre 2015 à 11:25
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
(6, 'Hôtel'),
(7, 'Péage');

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `frais`
--

INSERT INTO `frais` (`id`, `image`, `date`, `description`, `montant`, `devise_id`, `note_id`, `categorie_id`) VALUES
(1, 'pdg08-12-2015-16-06-48.jpg', '2015-06-10', 'IZI TRADING', 666, 1, 1, 1),
(3, 'pdg08-12-2015-16-08-17.jpg', '2015-08-01', 'COC + BITCH', 300, 1, 6, 6),
(4, 'pdg08-12-2015-16-09-18.jpg', '2015-03-02', '', 234, 1, 1, 4),
(5, 'pdg08-12-2015-16-09-46.jpg', '2015-06-22', 'biff', 2340, 1, 5, 4),
(6, 'pdg08-12-2015-16-10-21.jpg', '2015-08-19', 'LVMH', 920, 1, 5, 4),
(7, 'pdg08-12-2015-16-10-46.jpg', '2015-03-22', 'bibi', 900, 1, 5, 3),
(8, 'pdg08-12-2015-16-11-14.jpg', '2015-05-23', 'DoMac', 5000, 1, 5, 2),
(9, 'pdg08-12-2015-16-12-17.jpg', '2015-12-06', 'DOLLADOLLA', 200, 1, 1, 7),
(10, 'pdg15-12-2015-10-58-42.jpg', '2015-02-27', 'IZI MONNAIE', 1000, 1, 1, 4),
(11, '#', '2015-12-16', 'Frais avion', 348, 1, 4, 1),
(12, 'pdg17-12-2015-15-44-40.png', '2015-12-10', 'Avion', 750.32, 3, 1, 1),
(13, 'pdg-22-12-2015-19-24-34.jpg', '2015-12-01', 'Billet d''avion', 585, 1, 7, 1),
(14, 'pdg-22-12-2015-19-26-12.jpg', '2015-12-05', 'Hotel', 137, 2, 7, 6),
(15, 'pdg-22-12-2015-23-13-14.jpg', '2015-11-04', 'Resto Toulouse', 110, 1, 8, 2),
(16, 'pdg-22-12-2015-23-13-49.jpg', '2015-11-04', 'Péage', 55, 1, 8, 7),
(17, 'pdg-22-12-2015-23-14-14.jpg', '2015-11-04', 'Carburant Toulouse', 75, 1, 8, 5),
(18, 'pdg-22-12-2015-23-15-31.jpg', '2015-11-18', 'Resto', 255, 1, 9, 2),
(19, 'pdg-22-12-2015-23-16-20.jpg', '2015-11-27', 'hotel', 400, 1, 9, 6),
(20, 'pdg-22-12-2015-23-23-13.jpg', '2015-12-04', 'Resto client', 209.5, 1, 10, 2),
(21, 'pdg-22-12-2015-23-24-44.jpg', '2015-10-09', 'essence', 150, 1, 11, 5),
(22, 'pdg-22-12-2015-23-25-08.jpg', '2015-10-09', 'péage', 67.9, 1, 11, 7),
(23, 'pdg-22-12-2015-23-26-01.png', '2015-10-09', 'Train', 87.75, 1, 11, 3),
(24, 'leader-23-12-2015-10-49-34.jpg', '2015-10-14', 'sf', 25.85, 3, 12, 3),
(25, 'leader-23-12-2015-10-50-00.png', '2015-10-14', 'sdf qefervzer sf', 45.65, 1, 12, 6),
(26, 'leader-23-12-2015-10-50-43.jpg', '2015-10-15', 'lorem ipsum bla bla bla', 68.45, 1, 12, 7),
(27, 'leader-23-12-2015-10-52-15.jpg', '2015-12-16', 'slkghl', 12000, 4, 13, 2),
(28, 'leader-23-12-2015-10-52-40.jpg', '2015-12-17', 'sesfsdf dsfs hl', 42000, 1, 13, 6),
(29, 'leader-23-12-2015-10-54-45.jpg', '2015-12-17', 'bla bla bla', 209.75, 1, 14, 2),
(30, 'toto-23-12-2015-11-02-07.jpg', '2015-09-11', 'skjefh qsdf', 255, 1, 15, 1),
(31, 'titi-23-12-2015-11-13-32.png', '2015-12-04', 'kgrjhqerl segnsg', 120.65, 2, 16, 7),
(32, 'titi-23-12-2015-11-14-03.jpg', '2015-12-04', 'sdlig dsf segnsg', 300, 1, 16, 4),
(33, 'titi-23-12-2015-11-15-38.jpg', '2015-10-16', 'ldfgh sdfrf', 680, 1, 16, 3);

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `modification`
--

INSERT INTO `modification` (`id`, `date`, `change_id`, `table_name`, `author_id`) VALUES
(1, '2015-12-17', 4, 'note_frais', 1),
(2, '2015-12-22', 13, 'frais', 1),
(3, '2015-12-22', 8, 'note_frais', 1),
(4, '2015-12-22', 9, 'note_frais', 1),
(5, '2015-12-22', 1, 'note_frais', 1),
(6, '2015-12-22', 11, 'note_frais', 1),
(7, '2015-12-22', 5, 'user', 1),
(8, '2015-12-23', 29, 'frais', 2),
(9, '2015-12-23', 12, 'note_frais', 2),
(10, '2015-12-23', 13, 'note_frais', 2),
(11, '2015-12-23', 15, 'note_frais', 5),
(12, '2015-12-23', 16, 'note_frais', 6),
(13, '2015-12-23', 6, 'user', 6),
(14, '2015-12-23', 15, 'note_frais', 2),
(15, '2015-12-23', 13, 'note_frais', 1),
(16, '2015-12-23', 10, 'note_frais', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `note_frais`
--

INSERT INTO `note_frais` (`id`, `name`, `date`, `user_id`, `statut_id`) VALUES
(1, 'Note 1 modif', '2015-12-06', 1, 2),
(4, 'Note 4', '2015-06-20', 5, 2),
(5, 'Note 5', '2015-08-03', 7, 2),
(6, 'Note 6', '2015-12-08', 1, 4),
(7, 'Voyage Russie', '2015-12-22', 1, 1),
(8, 'D&eacute;placement Toulouse', '2015-12-22', 1, 4),
(9, 'Playa', '2015-12-22', 1, 3),
(10, 'Prospection client X', '2015-12-22', 1, 2),
(11, 'Transport UK', '2015-12-22', 1, 5),
(12, 'lolo', '2015-12-23', 2, 2),
(13, 'Japon', '2015-12-23', 2, 5),
(14, 'Marseille', '2015-12-23', 2, 1),
(15, 'UK', '2015-12-23', 5, 4),
(16, 'slghesrk', '2015-12-23', 6, 2);

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
(1, 'En cours'),
(2, 'En traitement'),
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
  `devise_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `name`, `login`, `password`, `mail`, `role_id`, `devise_id`, `manager_id`) VALUES
(1, 'Grand chef', 'pdg', '016ed176be41ad0d8c1bf473b41f0cc233952f80', 'pdg@enote.fr', 1, 1, 1),
(2, 'Chef', 'leader', 'e82539751581312ebea51727cd35a8afc494968b', '', 2, 1, 1),
(5, 'Toto', 'toto', '75dd004caed2daadeb8a3acbce348ea5837b7da8', 'toto@enote.fr', 3, 1, 2),
(6, 'Titi', 'titi', '17b68e10df76d44ac7a54cc8be5c0ea8b5182f38', 'titi@enote.fr', 3, 1, 2),
(7, 'Tata', 'tata', '9e9b82c1ebdece4d5d75cf2020cdf01854395b5b', '', 2, 1, 1),
(8, 'Tutu', 'tutu', '85979612d70c83b49ea7acc89c9c035902f9e618', '', 3, 1, 7);

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
  ADD KEY `devise_id_2` (`devise_id`),
  ADD KEY `manager_id` (`manager_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT pour la table `modification`
--
ALTER TABLE `modification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `note_frais`
--
ALTER TABLE `note_frais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
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
