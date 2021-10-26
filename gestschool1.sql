-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 26 oct. 2021 à 06:26
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
-- Base de données : `gestschool1`
--

-- --------------------------------------------------------

--
-- Structure de la table `p2_g3_comptes`
--

CREATE TABLE `p2_g3_comptes` (
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
-- Déchargement des données de la table `p2_g3_comptes`
--

INSERT INTO `p2_g3_comptes` (`id`, `username`, `email`, `type`, `password`, `status`, `famille_id`, `eleve_id`, `enseignant_id`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1, NULL, NULL, NULL),
(105, 'prof de maths', 'profmaths@email.com', 'enseignant', 'acc017392425439be5e3f6409aa1ad2684f4b0c36054c644ca6dd255e8d40162', 1, NULL, NULL, 3),
(106, 'prof anglais', 'profanglais@email.com', 'enseignant', '79c262dde6110f690a6be40f0c99052a268fe22ab70db80688a6c691b0a1a7a9', 1, NULL, NULL, 4),
(107, 'prof de chimie', 'profchimie@email.com', 'enseignant', '43b55e38a19e853f19e947e0e2700982ab2abf4f97c1cbe206386289222385cf', 1, NULL, NULL, 5),
(108, 'prof histoire', 'profhistoire@email.com', 'enseignant', 'd15eec53207e92fd31b2b10523b296153ce6fe362ae1db26b664e9d934789631', 1, NULL, NULL, 6),
(109, 'famille1', 'famille1@email.com', 'famille', 'a43f944950b686f21821aaa91e1949cd297c1fbcd72a97d42c7355e5d11fc9c6', 1, 9, NULL, NULL),
(110, 'eleve1 famille1', 'eleve1famille1@email.com', 'eleve', 'fc85db67fbaf563ed3e16b2f9a48b30b623ddb6b4d12a3091b5009c0769778e0', 1, 9, 47, NULL),
(111, 'eleve2 famille1', 'eleve2famille1@email.com', 'eleve', 'adb55bf01508582797e8668d695b149e81edc98f2846be1a908daedf0ba721ab', 1, 9, 48, NULL),
(112, 'eleve3 famille1', 'eleve3famille1@email.com', 'eleve', '7287248b835339fd5d50f9c15380964a4972fa18f213b57de0cc6a1b6d72d672', 0, 9, 49, NULL),
(113, 'famille 2', 'famille2@email.com', 'famille', '67b4325989780d98c0150e3d1c93bb1f1e2fa1ea983f47a1a71f7e7ea29411e7', 1, 10, NULL, NULL),
(114, 'eleve1 famille2', 'eleve1famille2@email.com', 'eleve', 'fa7b3f45a1038c08b10148f1953aebfc722b5ff90abddbfc82540bd373a92c46', 1, 10, 50, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `p2_g3_controle`
--

CREATE TABLE `p2_g3_controle` (
  `idControle` int(11) NOT NULL,
  `intitule` varchar(100) NOT NULL,
  `note` float NOT NULL,
  `commentaire` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `enseignant_id` int(11) DEFAULT NULL,
  `eleve_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p2_g3_controle`
--

INSERT INTO `p2_g3_controle` (`idControle`, `intitule`, `note`, `commentaire`, `date`, `enseignant_id`, `eleve_id`) VALUES
(5, 'contrôle algèbre', 19, 'Très bien', '2021-10-26', 3, 47);

-- --------------------------------------------------------

--
-- Structure de la table `p2_g3_cursus`
--

CREATE TABLE `p2_g3_cursus` (
  `idCursus` int(11) NOT NULL,
  `matiere` varchar(50) NOT NULL,
  `annee` varchar(100) NOT NULL,
  `frais` varchar(100) NOT NULL,
  `enseignant_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p2_g3_cursus`
--

INSERT INTO `p2_g3_cursus` (`idCursus`, `matiere`, `annee`, `frais`, `enseignant_id`) VALUES
(24, 'maths', '2021-2022', '3000€', 3),
(25, 'anglais', '2021-2022', '2000€', 4),
(26, 'chimie', '2021-2022', '4000€', 6),
(27, 'histoire', '2021-2022', '3500€', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `p2_g3_eleve`
--

CREATE TABLE `p2_g3_eleve` (
  `idEleve` int(11) NOT NULL,
  `eleve` varchar(100) DEFAULT NULL,
  `famille_id` int(11) DEFAULT NULL,
  `cursus_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p2_g3_eleve`
--

INSERT INTO `p2_g3_eleve` (`idEleve`, `eleve`, `famille_id`, `cursus_id`) VALUES
(47, 'eleve', 9, 24),
(48, 'eleve', 9, 27),
(49, 'eleve', 9, NULL),
(50, 'eleve', 10, 24);

-- --------------------------------------------------------

--
-- Structure de la table `p2_g3_enseignant`
--

CREATE TABLE `p2_g3_enseignant` (
  `idEnseignant` int(11) NOT NULL,
  `enseignant` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p2_g3_enseignant`
--

INSERT INTO `p2_g3_enseignant` (`idEnseignant`, `enseignant`) VALUES
(3, 'enseignant'),
(4, 'enseignant'),
(5, 'enseignant'),
(6, 'enseignant');

-- --------------------------------------------------------

--
-- Structure de la table `p2_g3_famille`
--

CREATE TABLE `p2_g3_famille` (
  `idFamille` int(11) NOT NULL,
  `famille` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p2_g3_famille`
--

INSERT INTO `p2_g3_famille` (`idFamille`, `famille`) VALUES
(9, 'famille'),
(10, 'famille');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `p2_g3_comptes`
--
ALTER TABLE `p2_g3_comptes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eleve_id` (`eleve_id`),
  ADD KEY `enseignant_id` (`enseignant_id`),
  ADD KEY `comptes_ibfk_3` (`famille_id`);

--
-- Index pour la table `p2_g3_controle`
--
ALTER TABLE `p2_g3_controle`
  ADD PRIMARY KEY (`idControle`),
  ADD KEY `eleve_id` (`eleve_id`),
  ADD KEY `enseignant_id` (`enseignant_id`);

--
-- Index pour la table `p2_g3_cursus`
--
ALTER TABLE `p2_g3_cursus`
  ADD PRIMARY KEY (`idCursus`),
  ADD KEY `enseignant_id` (`enseignant_id`);

--
-- Index pour la table `p2_g3_eleve`
--
ALTER TABLE `p2_g3_eleve`
  ADD PRIMARY KEY (`idEleve`),
  ADD KEY `cursus_id` (`cursus_id`),
  ADD KEY `famille_id` (`famille_id`);

--
-- Index pour la table `p2_g3_enseignant`
--
ALTER TABLE `p2_g3_enseignant`
  ADD PRIMARY KEY (`idEnseignant`);

--
-- Index pour la table `p2_g3_famille`
--
ALTER TABLE `p2_g3_famille`
  ADD PRIMARY KEY (`idFamille`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `p2_g3_comptes`
--
ALTER TABLE `p2_g3_comptes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT pour la table `p2_g3_controle`
--
ALTER TABLE `p2_g3_controle`
  MODIFY `idControle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `p2_g3_cursus`
--
ALTER TABLE `p2_g3_cursus`
  MODIFY `idCursus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `p2_g3_eleve`
--
ALTER TABLE `p2_g3_eleve`
  MODIFY `idEleve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `p2_g3_enseignant`
--
ALTER TABLE `p2_g3_enseignant`
  MODIFY `idEnseignant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `p2_g3_famille`
--
ALTER TABLE `p2_g3_famille`
  MODIFY `idFamille` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `p2_g3_comptes`
--
ALTER TABLE `p2_g3_comptes`
  ADD CONSTRAINT `p2_g3_comptes_ibfk_1` FOREIGN KEY (`eleve_id`) REFERENCES `p2_g3_eleve` (`idEleve`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `p2_g3_comptes_ibfk_2` FOREIGN KEY (`enseignant_id`) REFERENCES `p2_g3_enseignant` (`idEnseignant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `p2_g3_comptes_ibfk_3` FOREIGN KEY (`famille_id`) REFERENCES `p2_g3_famille` (`idFamille`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `p2_g3_controle`
--
ALTER TABLE `p2_g3_controle`
  ADD CONSTRAINT `p2_g3_controle_ibfk_1` FOREIGN KEY (`eleve_id`) REFERENCES `p2_g3_eleve` (`idEleve`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `p2_g3_controle_ibfk_2` FOREIGN KEY (`enseignant_id`) REFERENCES `p2_g3_enseignant` (`idEnseignant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `p2_g3_cursus`
--
ALTER TABLE `p2_g3_cursus`
  ADD CONSTRAINT `p2_g3_cursus_ibfk_1` FOREIGN KEY (`enseignant_id`) REFERENCES `p2_g3_enseignant` (`idEnseignant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `p2_g3_eleve`
--
ALTER TABLE `p2_g3_eleve`
  ADD CONSTRAINT `p2_g3_eleve_ibfk_6` FOREIGN KEY (`cursus_id`) REFERENCES `p2_g3_cursus` (`idCursus`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `p2_g3_eleve_ibfk_8` FOREIGN KEY (`famille_id`) REFERENCES `p2_g3_famille` (`idFamille`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
