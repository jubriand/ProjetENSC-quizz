-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 05 mars 2020 à 18:29
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `id12746608_quizzensc`
--

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `ID_QUEST` int(11) NOT NULL,
  `INTITULE` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `TYPE_QUEST` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `MEDIA` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID_THEME` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`ID_QUEST`, `INTITULE`, `TYPE_QUEST`, `MEDIA`, `ID_THEME`) VALUES
(1, 'Quel est le nom du personnage principal?', 'text', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `ID_REPONSE` int(11) NOT NULL,
  `INTITULE` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `IS_TRUE` tinyint(4) NOT NULL DEFAULT 0,
  `ID_QUEST` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`ID_REPONSE`, `INTITULE`, `IS_TRUE`, `ID_QUEST`) VALUES
(1, 'Harry Potter\r\n', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `theme` (
  `ID_THEME` int(11) NOT NULL,
  `NOM_THEME` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `NB_QUESTIONS` int(11) NOT NULL DEFAULT 10,
  `TIMER` int(11) NOT NULL DEFAULT 300,
  `DESC_THEME` text COLLATE utf8_unicode_ci NOT NULL,
  `PHOTOS` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `BEST_SCORE` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`ID_THEME`, `NOM_THEME`, `NB_QUESTIONS`, `TIMER`, `DESC_THEME`, `PHOTOS`, `BEST_SCORE`) VALUES
(1, 'Harry Potter', 10, 300, 'Questions sur le monde d\'Harry Potter', 'Harry-Potter.jpg', 0),
(2, 'Disney', 10, 300, 'Questions sur le monde de Disney', NULL, 0),
(3, 'Marvel', 10, 300, 'Questions sur l\'univers Marvel', NULL, 0),
(4, 'Histoire', 10, 300, 'Questions sur l\'Histoire', NULL, 0),
(5, 'Capitales', 10, 300, 'Vous devez retrouver les capitales de pays donnés', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `PSEUDO` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `MDP` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `IS_ADMIN` tinyint(4) NOT NULL DEFAULT 0,
  `SCORE_TOTAL` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`PSEUDO`, `MDP`, `IS_ADMIN`, `SCORE_TOTAL`) VALUES
('ADMIN', 'ADMIN', 0, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`ID_QUEST`),
  ADD KEY `ID_THEME` (`ID_THEME`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`ID_REPONSE`),
  ADD KEY `ID_QUEST` (`ID_QUEST`);

--
-- Index pour la table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`ID_THEME`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`PSEUDO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
