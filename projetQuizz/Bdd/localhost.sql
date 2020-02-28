-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 28 fév. 2020 à 16:01
-- Version du serveur :  10.3.16-MariaDB
-- Version de PHP : 7.3.12

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
CREATE DATABASE IF NOT EXISTS `id12746608_quizzensc` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id12746608_quizzensc`;

-- --------------------------------------------------------

--
-- Structure de la table `QUESTION`
--

CREATE TABLE `QUESTION` (
  `ID_QUEST` int(11) NOT NULL,
  `INTITULE` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `TYPE_QUEST` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `MEDIA` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID_THEME` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `REPONSE`
--

CREATE TABLE `REPONSE` (
  `ID_REPONSE` int(11) NOT NULL,
  `INTITULE` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `IS_TRUE` tinyint(4) NOT NULL DEFAULT 0,
  `ID_QUEST` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `THEME`
--

CREATE TABLE `THEME` (
  `ID_THEME` int(11) NOT NULL,
  `NOM_THEME` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `NB_QUESTIONS` int(11) NOT NULL DEFAULT 10,
  `TIMER` int(11) NOT NULL DEFAULT 300,
  `DESC_THEME` text COLLATE utf8_unicode_ci NOT NULL,
  `PHOTOS` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `BEST_SCORE` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `UTILISATEUR`
--

CREATE TABLE `UTILISATEUR` (
  `PSEUDO` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `MDP` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `IS_ADMIN` tinyint(4) NOT NULL DEFAULT 0,
  `SCORE_TOTAL` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `QUESTION`
--
ALTER TABLE `QUESTION`
  ADD PRIMARY KEY (`ID_QUEST`),
  ADD KEY `ID_THEME` (`ID_THEME`);

--
-- Index pour la table `REPONSE`
--
ALTER TABLE `REPONSE`
  ADD PRIMARY KEY (`ID_REPONSE`),
  ADD KEY `ID_QUEST` (`ID_QUEST`);

--
-- Index pour la table `THEME`
--
ALTER TABLE `THEME`
  ADD PRIMARY KEY (`ID_THEME`);

--
-- Index pour la table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR`
  ADD PRIMARY KEY (`PSEUDO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
