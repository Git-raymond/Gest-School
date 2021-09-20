-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 20 sep. 2021 à 05:30
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestschool`
--

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

CREATE TABLE `comptes` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `famille_id` int(11) DEFAULT NULL,
  `eleve_id` int(11) DEFAULT NULL,
  `enseignant_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comptes`
--

INSERT INTO `comptes` (`id`, `username`, `email`, `type`, `password`, `status`, `famille_id`, `eleve_id`, `enseignant_id`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `controle`
--

CREATE TABLE `controle` (
  `idControle` int(11) NOT NULL,
  `intitule` varchar(100) NOT NULL,
  `note` float NOT NULL,
  `commentaire` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `enseignant_id` int(11) DEFAULT NULL,
  `eleve_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cursus`
--

CREATE TABLE `cursus` (
  `idCursus` int(11) NOT NULL,
  `matiere` varchar(50) NOT NULL,
  `annee` varchar(100) NOT NULL,
  `frais` varchar(100) NOT NULL,
  `enseignant_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE `eleve` (
  `idEleve` int(11) NOT NULL,
  `eleve` varchar(100) DEFAULT NULL,
  `famille_id` int(11) DEFAULT NULL,
  `cursus_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `idEnseignant` int(11) NOT NULL,
  `enseignant` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `famille`
--

CREATE TABLE `famille` (
  `idFamille` int(11) NOT NULL,
  `famille` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eleve_id` (`eleve_id`),
  ADD KEY `enseignant_id` (`enseignant_id`),
  ADD KEY `comptes_ibfk_3` (`famille_id`);

--
-- Index pour la table `controle`
--
ALTER TABLE `controle`
  ADD PRIMARY KEY (`idControle`),
  ADD KEY `eleve_id` (`eleve_id`),
  ADD KEY `enseignant_id` (`enseignant_id`);

--
-- Index pour la table `cursus`
--
ALTER TABLE `cursus`
  ADD PRIMARY KEY (`idCursus`),
  ADD KEY `enseignant_id` (`enseignant_id`);

--
-- Index pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`idEleve`),
  ADD KEY `cursus_id` (`cursus_id`),
  ADD KEY `famille_id` (`famille_id`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`idEnseignant`);

--
-- Index pour la table `famille`
--
ALTER TABLE `famille`
  ADD PRIMARY KEY (`idFamille`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comptes`
--
ALTER TABLE `comptes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT pour la table `controle`
--
ALTER TABLE `controle`
  MODIFY `idControle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `cursus`
--
ALTER TABLE `cursus`
  MODIFY `idCursus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `eleve`
--
ALTER TABLE `eleve`
  MODIFY `idEleve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `idEnseignant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `famille`
--
ALTER TABLE `famille`
  MODIFY `idFamille` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD CONSTRAINT `comptes_ibfk_1` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`idEleve`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comptes_ibfk_2` FOREIGN KEY (`enseignant_id`) REFERENCES `enseignant` (`idEnseignant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comptes_ibfk_3` FOREIGN KEY (`famille_id`) REFERENCES `famille` (`idFamille`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `controle`
--
ALTER TABLE `controle`
  ADD CONSTRAINT `controle_ibfk_1` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`idEleve`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `controle_ibfk_2` FOREIGN KEY (`enseignant_id`) REFERENCES `enseignant` (`idEnseignant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cursus`
--
ALTER TABLE `cursus`
  ADD CONSTRAINT `cursus_ibfk_1` FOREIGN KEY (`enseignant_id`) REFERENCES `enseignant` (`idEnseignant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD CONSTRAINT `eleve_ibfk_6` FOREIGN KEY (`cursus_id`) REFERENCES `cursus` (`idCursus`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eleve_ibfk_8` FOREIGN KEY (`famille_id`) REFERENCES `famille` (`idFamille`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
