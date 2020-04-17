-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 17 avr. 2020 à 13:52
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

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `ID_QUEST` int(11) NOT NULL,
  `INTITULE` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `TYPE_QUEST` int(11) NOT NULL,
  `MEDIA` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID_THEME` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`ID_QUEST`, `INTITULE`, `TYPE_QUEST`, `MEDIA`, `ID_THEME`) VALUES
(1, 'Quel est le prénom de l&#039;héroïne?', 1, NULL, 1),
(2, 'Qui est le père de Simba', 1, NULL, 2),
(3, 'Qui est le personnage principal?', 1, 'Harry-Potter.jpg', 1),
(14, 'A quelle maison appartient Harry Potter?', 2, '', 1),
(15, 'Harry Potter appartient à la maison Serpentard', 0, '', 1),
(17, 'Quel est le nom du directeur de Poudlard', 2, '', 1),
(19, 'Quel aliment est empoisonné dans Blanche-Neige et les sept nains ?', 2, '', 2),
(20, 'Quel personnage de Disney a le nez qui s&#039;allonge lorsqu&#039;il ment ?', 1, 'Pinnochio1.gif', 2),
(21, 'Quel est le premier film produit par Disney?', 2, 'winny.gif', 2),
(23, 'De quelle année date la première convention de Schengen? ', 2, '', 4),
(24, 'En quelle année le mur de Berlin a-t-il été démoli?', 1, '', 4),
(25, 'Napoléon Bonaparte est le neveu de Napoléon Ier ?', 0, '', 4),
(26, 'Le mur d&#039;Hadrien a été construit en :', 2, '', 4),
(27, 'Quelle est la capitale de la Belgique?', 1, '', 5),
(28, 'Olaf est le nom du renne dans la Reine des neiges?', 0, '', 2),
(29, 'Quel était le métier de Stephen Strange avant de devenir le sorcier suprême?', 1, '', 3),
(36, 'Le bleu et le rouge du drapeau français représentent les couleurs de Paris ?', 0, '', 4),
(37, 'Combien d&#039;horcruxes les héros doivent-ils détruire?', 1, '', 1),
(38, 'Quel age ont les héros lors de leur première année à Poudlard?', 1, '', 1),
(39, 'Neville Londubat et Bellatrix Lestrange ont un lien de parenté ?', 0, '', 1),
(40, 'Qui est l&#039;auteur de la saga?', 2, '', 1),
(41, 'Ron Weasley a un crapaud comme familier ?', 0, '', 1),
(42, 'Il existe plusieurs écoles de magies ?', 0, '', 1),
(43, 'Contre quel chef gaulois s&#039;est battu Jules César à Alésia ?', 1, '', 4),
(44, 'Le plus vieil être humain découvert s&#039;appelle &quot;Lucy&quot; grâce à la musique des Beatles &quot;Lucy in the sky with diamonds&quot; ?', 0, '', 4),
(45, 'Depuis quand les femmes ont le droit de vote en France ?', 2, '', 4),
(46, 'Combien de pays composent la zone euro en 2020 ?', 1, '', 4),
(47, 'La France a-t-elle participé à la guerre du Vietnam ?', 0, '', 4),
(48, 'Combien de temps a duré la Guerre de Cent Ans ?', 2, '', 4),
(49, 'Quel est le surnom de Peter Parker?', 1, '', 3),
(50, 'Il existe une version &quot;années 20&quot; de Spiderman ?', 0, '', 3),
(51, 'Quel a été le premier héros créée dans les comics Marvel ?', 2, '', 3),
(52, 'Quelle fleur Belle demande à son père de ramener?', 2, 'gif_Belle&amp;Bete.gif', 2),
(53, 'Le gardien de Mulan s&#039;appelle Mitchou', 0, 'gif_Mulan_Mushu.gif', 2),
(54, 'Quel objet prend vie dans l&#039;apprenti sorcier de Fantasia', 1, 'Img_Fantasia.jpg', 2),
(55, 'Lequel de ces personnages n&#039;apparaît pas dans le film les Aristochats?', 2, 'Gif_aristochats.gif', 2),
(56, 'Kenai et Koda sont-ils frères?', 0, 'Gif_Frère_Ours.gif', 2),
(57, 'Quelle est la capitale du pays ayant la forme suivante', 1, 'Carte_Suede.png', 5),
(58, 'Quelle est la capitale de l&#039;Australie?', 2, 'Gif_Kangourou.gif', 5),
(59, 'Laquelle de ces capitales est la plus peuplée', 2, '', 5),
(60, 'Quelle ville est surnommée la capitale du poulet?', 2, 'KFC_Gif.gif', 5),
(61, 'Istanbul est la capitale de la Turquie', 0, '', 5),
(62, 'Laquelle de ces capitales est la plus vieille?', 2, '', 5),
(63, 'Shanghai est la capitale de la Chine?', 0, '', 5),
(64, 'Quelle est la capitale du pays ayant ce drapeau?', 1, 'Flag_wales.png', 5),
(65, 'Laquelle de ces capitales ne fait pas partie de l&#039;Union Européenne?', 2, 'FLag_EU.png', 5),
(66, 'Combien vaut 0°C en Kelvin? (donner l&#039;entier en valeur positive)', 1, '', 6),
(67, 'Quel groupe sanguin est donneur universel?', 2, '', 6),
(68, 'La figure de diffraction à l&#039;infini d&#039;une ouverture circulaire éclairée par une onde plane monochromatique est constituée :', 2, '', 6),
(69, 'L&#039;accélération de Coriolis intervient lorsqu&#039;on étudie le mouvement d&#039;un corps se déplaçant dans un référentiel en rotation par rapport à un référentiel galiléen ?', 0, '', 6),
(70, 'Les théorèmes de la dynamique sont valables pour des systèmes ouverts et fermés ?', 0, '', 6),
(71, 'Quelle est l&#039;unité du système international de la résistance ? (&quot;SU&quot; pour sans unité)', 1, '', 6),
(72, 'Qu&#039;implique l&#039;expression &quot;transformation adiabatique&quot; ?', 2, '', 6),
(73, 'Alfred Nobel est à l&#039;origine de l&#039;invention des montres bracelets', 0, '', 6),
(74, 'Par quelle citation Newton a-t-il rendu hommage à ces prédécesseurs?', 2, '', 6),
(75, 'La vitesse de propagation d&#039;une onde sonore dépend de son milieu de propagation ?', 0, '', 6),
(76, 'Le phénomène de diffraction est observable avec des ondes à la surface de l&#039;eau?', 0, '', 6),
(77, 'Quelle est la profession du personnage principale dans Atlantide, L&#039;empire Perdu?', 2, 'Gif_Atlantide.gif', 2),
(78, 'Dans quelle ville se déroule La princesse et la grenouille', 2, 'Gif_princesse_grenouille.gif', 2),
(79, 'Les studios Disney ont produits au moins 1 long métrage d&#039;animation par an depuis 1988', 0, '', 2),
(80, 'Il y a plus de tâches noires dans Les 101 Dalmatiens que d&#039;habitants dans les pays Baltes (Lettonie, Lituanie, Estonie)', 0, 'e569952b51cb563b6bead4c11cc2ce0b.gif', 2),
(81, 'Quel est le nom du lapin qui accompagne Bambi', 1, '', 2),
(82, 'Dans X-men L&#039;affrontement final, qui Wolverine est obligé de tuer', 2, '', 3),
(84, 'Qui est le soldat de l&#039;hiver', 2, '', 3),
(85, 'Quel est le prénom de la compagne d&#039;Iron Man?', 1, '', 3),
(86, 'Qui est le créateur des Sentinelles, les robots tueurs de mutants?', 2, 'sentinelles-les_12.jpg', 3),
(87, 'Quel est le véritable nom de Wolverine?', 2, 'ComfortableIncompatibleAstarte-size_restricted.gif', 3),
(88, 'Comment se nomme le premier Ant Man?', 2, 'Gif_antman.gif', 3);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `ID_REPONSE` int(11) NOT NULL,
  `INTITULE` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `IS_TRUE` tinyint(4) NOT NULL,
  `ID_QUEST` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`ID_REPONSE`, `INTITULE`, `IS_TRUE`, `ID_QUEST`) VALUES
(2, 'Mufasa', 0, 2),
(3, 'Harry Potter', 0, 3),
(24, 'Serpentard', 1, 14),
(25, 'Gryffondor', 0, 14),
(26, 'Serdaigle', 1, 14),
(27, 'Poufsouffle', 1, 14),
(28, 'Poudlard', 1, 14),
(29, 'Hermione', 1, 14),
(30, 'Vrai', 1, 15),
(31, 'Faux', 0, 15),
(34, 'Dumbledore', 0, 17),
(35, 'Dombledore', 1, 17),
(36, 'Dumbledort', 1, 17),
(37, 'Dimbledore', 1, 17),
(38, 'Doumblidor', 1, 17),
(39, 'Dumble dort', 1, 17),
(40, 'Hermione', 0, 1),
(47, 'Du couscous', 1, 19),
(48, 'Une pomme', 0, 19),
(49, 'Une poire', 1, 19),
(50, 'Des amandes', 1, 19),
(51, 'Un poulet roti', 1, 19),
(52, 'Un clafouti', 1, 19),
(53, 'Pinocchio', 0, 20),
(54, 'Fantasia', 1, 21),
(55, 'Pinocchio', 1, 21),
(56, 'Bambi', 1, 21),
(57, 'Blanche-Neige et les sept nains', 0, 21),
(58, 'Cendrillon', 1, 21),
(59, 'Peter Pan', 1, 21),
(61, '1985', 0, 23),
(62, '1990', 1, 23),
(63, '1980', 1, 23),
(64, '1995', 1, 23),
(65, '2000', 1, 23),
(66, '1975', 1, 23),
(67, '1989', 0, 24),
(68, 'Vrai', 0, 25),
(69, 'Faux', 1, 25),
(70, 'Angleterre', 0, 26),
(71, 'France', 1, 26),
(72, 'Italie', 1, 26),
(73, 'Allemagne', 1, 26),
(74, 'Ecosse', 1, 26),
(75, 'Norvège', 1, 26),
(76, 'Bruxelles', 0, 27),
(77, 'Vrai', 1, 28),
(78, 'Faux', 0, 28),
(79, 'Neurochirurgien ', 0, 29),
(116, 'Vrai', 0, 36),
(117, 'Faux', 1, 36),
(118, '7', 0, 37),
(119, '11 ans', 0, 38),
(120, 'Vrai', 1, 39),
(121, 'Faux', 0, 39),
(122, 'Rowling', 0, 40),
(123, 'Tolkien', 1, 40),
(124, 'Shakespeare', 1, 40),
(125, 'Orwell', 1, 40),
(126, 'Caroll', 1, 40),
(127, 'Dahl', 1, 40),
(128, 'Vrai', 1, 41),
(129, 'Faux', 0, 41),
(130, 'Vrai', 0, 42),
(131, 'Faux', 1, 42),
(132, 'Vercingétorix', 0, 43),
(133, 'Vrai', 0, 44),
(134, 'Faux', 1, 44),
(135, '1918', 1, 45),
(136, '1944', 0, 45),
(137, '1968', 1, 45),
(138, '1950', 1, 45),
(139, '1889', 1, 45),
(140, '1929', 1, 45),
(141, '19', 0, 46),
(142, 'Vrai', 1, 47),
(143, 'Faux', 0, 47),
(144, '100', 1, 48),
(145, '96', 1, 48),
(146, '116', 0, 48),
(147, '85', 1, 48),
(148, '120', 1, 48),
(149, '76', 1, 48),
(150, 'Spiderman', 0, 49),
(151, 'Vrai', 0, 50),
(152, 'Faux', 1, 50),
(153, 'Captain America', 1, 51),
(154, 'Hulk', 1, 51),
(155, 'Spiderman', 1, 51),
(156, 'La torche humaine', 0, 51),
(157, 'La veuve noire', 1, 51),
(158, 'Iron Man', 1, 51),
(159, 'Tulipe', 1, 52),
(160, 'Rose', 0, 52),
(161, 'Marguerite', 1, 52),
(162, 'Jonquille', 1, 52),
(163, 'Mimosas', 1, 52),
(164, 'Chrysanthème', 1, 52),
(165, 'Vrai', 1, 53),
(166, 'Faux', 0, 53),
(167, 'Balais', 0, 54),
(168, 'Toulouse', 1, 55),
(169, 'Shun Gon', 1, 55),
(170, 'Oncle Waldo', 1, 55),
(171, 'Napoléon', 1, 55),
(172, 'Roquefort', 1, 55),
(173, 'Meeko', 0, 55),
(174, 'Vrai', 1, 56),
(175, 'Faux', 0, 56),
(176, 'Stockholm', 0, 57),
(177, 'Canberra', 0, 58),
(178, 'Sydney', 1, 58),
(179, 'Perth', 1, 58),
(180, 'Melbourne', 1, 58),
(181, 'Brisbane', 1, 58),
(182, 'Kangaroo Town', 1, 58),
(183, 'Jakarta', 0, 59),
(184, 'New York', 1, 59),
(185, 'Pekin', 1, 59),
(186, 'Lagos', 1, 59),
(187, 'Mexico', 1, 59),
(188, 'Moscou', 1, 59),
(189, 'Toulouse', 1, 60),
(190, 'Agen', 1, 60),
(191, 'Lille', 1, 60),
(192, 'Bourg-en-Bresse', 0, 60),
(193, 'Guéret', 1, 60),
(194, 'Pékin', 1, 60),
(195, 'Vrai', 1, 61),
(196, 'Faux', 0, 61),
(197, 'Beyrouth', 0, 62),
(198, 'Paris', 1, 62),
(199, 'Moscou', 1, 62),
(200, 'Athènes', 1, 62),
(201, 'Rome', 1, 62),
(202, 'Addis-Abeba', 1, 62),
(203, 'Vrai', 1, 63),
(204, 'Faux', 0, 63),
(205, 'Cardiff', 0, 64),
(206, 'Helsinki', 1, 65),
(207, 'Sofia', 1, 65),
(208, 'Nicosie', 1, 65),
(209, 'Talinn', 1, 65),
(210, 'La Valette', 1, 65),
(211, 'Reykjavik', 0, 65),
(212, '273', 0, 66),
(213, 'O-', 0, 67),
(214, 'AB+', 1, 67),
(215, 'B-', 1, 67),
(216, 'A+', 1, 67),
(217, 'AB', 1, 67),
(218, 'O+', 1, 67),
(219, 'd&#039;une tache centrale circulaire suivi d&#039;anneaux concentriques', 0, 68),
(220, 'd&#039;une tache centrale suivi de taches secondaires parallèles et perpendiculaires à la fente (forment une croix)', 1, 68),
(221, 'd&#039;une tache centrale suivi de taches secondaires, toutes parallèles à la fente', 1, 68),
(222, 'd&#039;une tache centrale suivi de taches secondaires, toutes perpendiculaires à la fente', 1, 68),
(223, 'd&#039;une tache centrale uniquement', 1, 68),
(224, 'd&#039;une tâche sombre', 1, 68),
(225, 'Vrai', 0, 69),
(226, 'Faux', 1, 69),
(227, 'Vrai', 1, 70),
(228, 'Faux', 0, 70),
(229, 'ohm', 0, 71),
(230, 'Pas d&#039;échanges thermique avec l&#039;extérieur', 0, 72),
(231, 'Pas de variation de température dans le système', 1, 72),
(232, 'Pas de variation de pression dans le système', 1, 72),
(233, 'Pas de variation de quantité de matière dans le système', 1, 72),
(234, 'Pas de variation de volume au cours de la transformation', 1, 72),
(235, 'Une transformation qui ne nécessite pas d’intervention humaine extérieure ', 1, 72),
(236, 'Vrai', 1, 73),
(237, 'Faux', 0, 73),
(238, '«Je remercie mes parents, Galilée et ma concierge»', 1, 74),
(239, '«Si j&#039;ai pu voir un peu au-delà, c&#039;est que j&#039;étais porté par des épaules de géants»', 0, 74),
(240, '«Tous pour un, un pour tous»', 1, 74),
(241, '&quot;Le fruit le plus agréable et le plus utile au monde est la reconnaissance&quot;', 1, 74),
(242, '&quot;La valeur d’un homme tient dans sa capacité à donner et non dans sa capacité à recevoir&quot;', 1, 74),
(243, '&quot;Sans vous je ne suis rien&quot;', 1, 74),
(244, 'Vrai', 0, 75),
(245, 'Faux', 1, 75),
(246, 'Vrai', 0, 76),
(247, 'Faux', 1, 76),
(248, 'Linguiste', 0, 77),
(249, 'Historien', 1, 77),
(250, 'Archéologue', 1, 77),
(251, 'Explorateur', 1, 77),
(252, 'Plombier', 1, 77),
(253, 'Médecin', 1, 77),
(254, 'La Nouvelle-Orléans', 0, 78),
(255, 'Orléans', 1, 78),
(256, 'Maubeuge', 1, 78),
(257, 'Baton Rouge', 1, 78),
(258, 'Orlando', 1, 78),
(259, 'Lafayette', 1, 78),
(260, 'Vrai', 0, 79),
(261, 'Faux', 1, 79),
(262, 'Vrai', 0, 80),
(263, 'Faux', 1, 80),
(264, 'Panpan', 0, 81),
(265, 'Jean Grey', 0, 82),
(266, 'Charles Xavier', 1, 82),
(267, 'Erik Lehnsherr', 1, 82),
(268, 'Scott Summers', 1, 82),
(269, 'Tornade', 1, 82),
(270, 'Warren Worthington', 1, 82),
(277, 'Sam Wilson', 1, 84),
(278, 'Clint Barton', 1, 84),
(279, 'James Barnes', 0, 84),
(280, 'Steve Rogers', 1, 84),
(281, 'Clint Barton', 1, 84),
(282, 'T&#039;Challa', 1, 84),
(283, 'Pepper', 0, 85),
(284, 'Bolivar Strask', 1, 86),
(285, 'Bolivar Stark', 1, 86),
(286, 'Bolivar Trask', 0, 86),
(287, 'Bolivar Tarsk', 1, 86),
(288, 'Bolivar Karst', 1, 86),
(289, 'Bolivar Sartk', 1, 86),
(290, 'Logan', 1, 87),
(291, 'Wolverine', 1, 87),
(292, 'James Howlett', 0, 87),
(293, 'Jean Grey', 1, 87),
(294, 'Wade Wilson', 1, 87),
(295, 'Victor Creed', 1, 87),
(296, 'Scott Lang', 0, 88),
(297, 'Peter Quill', 1, 88),
(298, 'Hank Pym', 1, 88),
(299, 'Luis', 1, 88),
(300, 'Hope Van Dyme', 1, 88),
(301, 'Stan Lee', 1, 88);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `theme` (
  `ID_THEME` int(11) NOT NULL,
  `NOM_THEME` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `NB_QUESTIONS` int(11) NOT NULL DEFAULT 10,
  `DESC_THEME` text COLLATE utf8_unicode_ci NOT NULL,
  `PHOTOS` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `BEST_SCORE` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`ID_THEME`, `NOM_THEME`, `NB_QUESTIONS`, `DESC_THEME`, `PHOTOS`, `BEST_SCORE`) VALUES
(1, 'Harry Potter', 10, 'Questions sur le monde d\'Harry Potter', 'Harry-Potter.jpg', 65),
(2, 'Disney', 10, 'Questions sur le monde de Disney', 'Disney.jpg', 68),
(3, 'Marvel', 10, 'Questions sur l\'univers Marvel', 'Marvel.jpg', 50),
(4, 'Histoire', 10, 'Questions sur l\'Histoire', 'Histoire.jpg', 71),
(5, 'Capitales', 10, 'Retrouvez les capitales de pays donnés', 'Capitales.jpg', 77),
(6, 'Sciences', 10, 'Découvertes scientifiques et questions générales sur la physique, chimie ou biologie', 'science.png', 28);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `PSEUDO` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `MDP` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `IS_ADMIN` tinyint(4) NOT NULL DEFAULT 1,
  `SCORE_TOTAL` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`PSEUDO`, `MDP`, `IS_ADMIN`, `SCORE_TOTAL`) VALUES
('ADMIN', 'ADMIN', 0, 2375),
('Bob', 'Think!33', 0, 0);

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
