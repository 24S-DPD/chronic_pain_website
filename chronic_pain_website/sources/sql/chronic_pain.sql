-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 17 juin 2024 à 17:59
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `chronic_pain`
--

-- --------------------------------------------------------

--
-- Structure de la table `affective_factors`
--

CREATE TABLE `affective_factors` (
  `ID` int(11) NOT NULL,
  `affective_factors` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `affective_factors`
--

INSERT INTO `affective_factors` (`ID`, `affective_factors`) VALUES
(0, 'Tiring'),
(1, 'Exhausting'),
(2, 'Unbearable'),
(3, 'Troublesome'),
(4, 'Uncomfortable'),
(5, 'Agonizing'),
(6, 'Punishing'),
(7, 'Miserable'),
(8, 'None of the above');

-- --------------------------------------------------------

--
-- Structure de la table `aggravating_factors`
--

CREATE TABLE `aggravating_factors` (
  `ID` int(11) NOT NULL,
  `aggravative_factors` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `aggravating_factors`
--

INSERT INTO `aggravating_factors` (`ID`, `aggravative_factors`) VALUES
(0, 'Lifting'),
(1, 'Bending Down'),
(2, 'Sitting'),
(3, 'Lying Down'),
(4, 'Driving'),
(5, 'Exercice'),
(6, 'Walking'),
(7, 'Climbing Up/Down the stairs'),
(8, 'None of the above');

-- --------------------------------------------------------

--
-- Structure de la table `easing_factors`
--

CREATE TABLE `easing_factors` (
  `ID` int(11) NOT NULL,
  `easing_factors` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `easing_factors`
--

INSERT INTO `easing_factors` (`ID`, `easing_factors`) VALUES
(0, 'Heat'),
(1, 'Compression'),
(2, 'Medicine'),
(3, 'Rest/Lying down'),
(4, 'Stretching/Gentle of the above'),
(5, 'Movement'),
(6, 'Exercice'),
(7, 'Getting into a comfortable position'),
(8, 'None of the above');

-- --------------------------------------------------------

--
-- Structure de la table `newpain`
--

CREATE TABLE `newpain` (
  `ID` int(11) NOT NULL,
  `ID_user` int(11) NOT NULL,
  `ID_pain_beginning` int(11) NOT NULL,
  `pain_intensity` int(11) NOT NULL,
  `ID_temporal_pattern` int(11) NOT NULL,
  `pain_related_distress` int(11) NOT NULL,
  `pain_related_interference` int(11) NOT NULL,
  `ID_pain_location` varchar(50) NOT NULL,
  `cancer` int(11) NOT NULL,
  `cancer_treatment` int(11) NOT NULL,
  `begin_after_surgery` int(11) NOT NULL,
  `worse_after_surgery` int(11) NOT NULL,
  `spread_of_pain` int(11) NOT NULL,
  `area_of_surgery` int(11) NOT NULL,
  `brain_nerves_illness` int(11) NOT NULL,
  `internal_organs_issues` int(11) NOT NULL,
  `musculoskeletal_pain` int(11) NOT NULL,
  `headaches_pain_face` int(11) NOT NULL,
  `ideas_about_pain` varchar(200) NOT NULL,
  `concerns_about_pain` varchar(200) NOT NULL,
  `expectations` varchar(200) NOT NULL,
  `closing_thoughts` varchar(200) NOT NULL,
  `ID_vertebrae` varchar(50) NOT NULL,
  `affective_factors` int(11) NOT NULL,
  `aggravating_factors` int(11) NOT NULL,
  `easing_factors` int(11) NOT NULL,
  `pain_qualities` int(11) NOT NULL,
  `sensory_symptoms` int(11) NOT NULL,
  `bodychart_image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `newpain`
--

INSERT INTO `newpain` (`ID`, `ID_user`, `ID_pain_beginning`, `pain_intensity`, `ID_temporal_pattern`, `pain_related_distress`, `pain_related_interference`, `ID_pain_location`, `cancer`, `cancer_treatment`, `begin_after_surgery`, `worse_after_surgery`, `spread_of_pain`, `area_of_surgery`, `brain_nerves_illness`, `internal_organs_issues`, `musculoskeletal_pain`, `headaches_pain_face`, `ideas_about_pain`, `concerns_about_pain`, `expectations`, `closing_thoughts`, `ID_vertebrae`, `affective_factors`, `aggravating_factors`, `easing_factors`, `pain_qualities`, `sensory_symptoms`, `bodychart_image`) VALUES
(53, 41, 3, 5, 1, 7, 2, 'OB', 0, 1, 0, 0, 1, 1, 0, 0, 1, 1, '', '', '', '', '?', 0, 0, 0, 0, 0, ''),
(54, 41, 3, 5, 1, 7, 2, 'Saph', 0, 1, 0, 0, 1, 1, 0, 0, 1, 1, '', '', '', '', 'L', 0, 0, 0, 0, 0, ''),
(55, 40, 0, 4, 1, 5, 3, 'ATR', 0, 1, 1, 1, 1, 1, 0, 0, 0, 1, '', '', '', '', 'T', 0, 0, 0, 0, 0, ''),
(56, 40, 0, 4, 1, 5, 3, 'CP', 0, 1, 1, 1, 1, 1, 0, 0, 0, 1, '', '', '', '', 'L', 0, 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `pain_beginning`
--

CREATE TABLE `pain_beginning` (
  `ID` int(11) NOT NULL,
  `pain_beginning` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pain_beginning`
--

INSERT INTO `pain_beginning` (`ID`, `pain_beginning`) VALUES
(0, '0-2 months'),
(1, '2-3 months'),
(2, '3-6 months'),
(3, '6-12 months'),
(4, 'more than 12 months');

-- --------------------------------------------------------

--
-- Structure de la table `pain_location`
--

CREATE TABLE `pain_location` (
  `pain_location` varchar(100) NOT NULL,
  `abreviation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pain_location`
--

INSERT INTO `pain_location` (`pain_location`, `abreviation`) VALUES
('?', '*'),
('?', '+'),
('x', '?'),
('Axillary', 'A'),
('Anterior Thoracic Ramj?', 'ATR'),
('Common Peroneal', 'CP'),
('Deep Peroneal', 'DP'),
('Femoral', 'F'),
('Lateral Antebrachial Cutaneous', 'LAC'),
('Lateral Brachial Cutaneous', 'LBC'),
('Lateral Femoral Cutaneous', 'LFC'),
('Lateral Thoracic Ramj?', 'LTR'),
('Median', 'M'),
('Medial Antebrachial Cutaneous', 'MAC'),
('Mandibular Branch', 'MandB'),
('Maxillary Branch', 'MaxiB'),
('Medial Branchial Cutaneous', 'MBC'),
('Obturator', 'O'),
('Ophtalmic Branch', 'OB'),
('Radial', 'R'),
('Saphenous', 'Saph'),
('Supraclavicular', 'SC'),
('Superpicial Peroneal', 'SP'),
('Sural', 'Sural'),
('Transverse Cervical', 'TC'),
('Ulnar', 'U'),
('?', 'x');

-- --------------------------------------------------------

--
-- Structure de la table `pain_qualities`
--

CREATE TABLE `pain_qualities` (
  `ID` int(11) NOT NULL,
  `pain_qualities` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pain_qualities`
--

INSERT INTO `pain_qualities` (`ID`, `pain_qualities`) VALUES
(0, 'Dull'),
(1, 'Throbbing'),
(2, 'Stabbing'),
(3, 'Gnawing'),
(4, 'Piercing'),
(5, 'Cramping'),
(6, 'Splitting'),
(7, 'Nagging'),
(8, 'Crushing'),
(9, 'Electric-Shock Like'),
(10, 'Shooting'),
(11, 'Sharp'),
(12, 'Radiating'),
(13, 'None of the above');

-- --------------------------------------------------------

--
-- Structure de la table `sensory_symptoms`
--

CREATE TABLE `sensory_symptoms` (
  `ID` int(11) NOT NULL,
  `sensory_symptoms` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sensory_symptoms`
--

INSERT INTO `sensory_symptoms` (`ID`, `sensory_symptoms`) VALUES
(0, 'Heaviness'),
(1, 'Cold / cool'),
(2, 'Hot / warm'),
(3, 'Tight'),
(4, 'Tingling'),
(5, 'Pins and Needles'),
(6, 'Numbness'),
(7, 'Pulling'),
(8, 'Itching'),
(9, 'Tickling'),
(10, 'Crawling'),
(11, 'Wet'),
(12, 'Electric'),
(13, 'Prickling'),
(14, 'None of the above');

-- --------------------------------------------------------

--
-- Structure de la table `temporal_pattern`
--

CREATE TABLE `temporal_pattern` (
  `ID` int(11) NOT NULL,
  `temporal_pattern` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `temporal_pattern`
--

INSERT INTO `temporal_pattern` (`ID`, `temporal_pattern`, `image`) VALUES
(0, 'Persistent', 'sources/images/persistent.jpg'),
(1, 'Recurring with pain-free intervals', 'sources/images/recurring.jpg'),
(2, 'Persistent with overlapping pain attacks', 'sources/images/overlapping.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `userinformation`
--

CREATE TABLE `userinformation` (
  `ID` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `adress` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `userinformation`
--

INSERT INTO `userinformation` (`ID`, `first_name`, `last_name`, `email`, `phone_number`, `birthdate`, `adress`, `password`, `user_role`) VALUES
(39, 'Ivan', 'Rimeur', 'ivan.rimeur@gmail.com', '', '2024-06-04', '', '$2y$10$Kx/TPXEiJE5uWvfBCM1z.udcPKIaqSKamVov4IJ9EUlN0i.lZQ5E2', 1),
(40, 'Elouen', 'Pont', 'elouenpont@gmail.com', '', '2024-05-28', '', '$2y$10$SiX8R6ydg4bBBv59rC5tj.YeMt9oVUzyN9wl2kQ4QwlnI9BKRirjy', 0),
(41, 'Mael', 'Rimeur', 'mael.rimeur@gmail.com', '', '2024-05-28', '', '$2y$10$cR.P6SP8enlT0TEMVklmEOSIR5G3rBvD2B8nzkx1EAdqFwxOrtEzq', 0),
(42, 'Hugo', 'Rimeur', 'hugo.rimeur@gmail.com', '', '2024-05-29', '', '$2y$10$TfQLlfDL1Xt8E8b7Yl6xH.0av3uLdfhWVaS2YSGewIPG7oH66dDL2', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user_role`
--

CREATE TABLE `user_role` (
  `ID` int(11) NOT NULL,
  `user_role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user_role`
--

INSERT INTO `user_role` (`ID`, `user_role`) VALUES
(0, 'patient'),
(1, 'physician');

-- --------------------------------------------------------

--
-- Structure de la table `vertebrea`
--

CREATE TABLE `vertebrea` (
  `ID` varchar(50) NOT NULL,
  `vertebrea` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vertebrea`
--

INSERT INTO `vertebrea` (`ID`, `vertebrea`) VALUES
('?', 'No vertebrae touch'),
('C', 'Cervical vertebrae'),
('L', 'Lumbar vertebrae'),
('S', 'Sacral vertebrae'),
('T', 'Thoracic vertebrae');

-- --------------------------------------------------------

--
-- Structure de la table `yesorno_questions`
--

CREATE TABLE `yesorno_questions` (
  `ID` int(11) NOT NULL,
  `response` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `yesorno_questions`
--

INSERT INTO `yesorno_questions` (`ID`, `response`) VALUES
(0, 'Yes'),
(1, 'No');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `affective_factors`
--
ALTER TABLE `affective_factors`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `aggravating_factors`
--
ALTER TABLE `aggravating_factors`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `easing_factors`
--
ALTER TABLE `easing_factors`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `newpain`
--
ALTER TABLE `newpain`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_description_pain` (`pain_intensity`),
  ADD KEY `fk_pain_related_distress` (`pain_related_distress`),
  ADD KEY `fk_pain_related_interference` (`pain_related_interference`),
  ADD KEY `fk_temporal_pattern` (`ID_temporal_pattern`),
  ADD KEY `fk_cancer` (`cancer`),
  ADD KEY `fk_treatment` (`cancer_treatment`),
  ADD KEY `fk_area_of_surgery` (`area_of_surgery`),
  ADD KEY `fk_begin_after_surgery` (`begin_after_surgery`),
  ADD KEY `fk_worse_after_surgery` (`worse_after_surgery`),
  ADD KEY `fk_spread_of_pain` (`spread_of_pain`),
  ADD KEY `fk_pain_beginning` (`ID_pain_beginning`),
  ADD KEY `fk_userID` (`ID_user`),
  ADD KEY `fk_brain_nerves_illness` (`brain_nerves_illness`),
  ADD KEY `fk_internal_organs_issues` (`internal_organs_issues`),
  ADD KEY `fk_muskuloskeletal_pain` (`musculoskeletal_pain`),
  ADD KEY `fk_headaches_pain_face` (`headaches_pain_face`),
  ADD KEY `fk_pain_location` (`ID_pain_location`),
  ADD KEY `fk_vertrebrea` (`ID_vertebrae`),
  ADD KEY `fk_affective_factors` (`affective_factors`),
  ADD KEY `fk_aggravating_factors` (`aggravating_factors`),
  ADD KEY `fk_easing_factors` (`easing_factors`),
  ADD KEY `fk_pain_qualities` (`pain_qualities`),
  ADD KEY `fk_sensory_symptoms` (`sensory_symptoms`);

--
-- Index pour la table `pain_beginning`
--
ALTER TABLE `pain_beginning`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `pain_location`
--
ALTER TABLE `pain_location`
  ADD PRIMARY KEY (`abreviation`);

--
-- Index pour la table `pain_qualities`
--
ALTER TABLE `pain_qualities`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `sensory_symptoms`
--
ALTER TABLE `sensory_symptoms`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `temporal_pattern`
--
ALTER TABLE `temporal_pattern`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `userinformation`
--
ALTER TABLE `userinformation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_user_role` (`user_role`);

--
-- Index pour la table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `vertebrea`
--
ALTER TABLE `vertebrea`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `yesorno_questions`
--
ALTER TABLE `yesorno_questions`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `newpain`
--
ALTER TABLE `newpain`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pour la table `userinformation`
--
ALTER TABLE `userinformation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `newpain`
--
ALTER TABLE `newpain`
  ADD CONSTRAINT `fk_affective_factors` FOREIGN KEY (`affective_factors`) REFERENCES `affective_factors` (`ID`),
  ADD CONSTRAINT `fk_aggravating_factors` FOREIGN KEY (`aggravating_factors`) REFERENCES `aggravating_factors` (`ID`),
  ADD CONSTRAINT `fk_area_of_surgery` FOREIGN KEY (`area_of_surgery`) REFERENCES `yesorno_questions` (`ID`),
  ADD CONSTRAINT `fk_begin_after_surgery` FOREIGN KEY (`begin_after_surgery`) REFERENCES `yesorno_questions` (`ID`),
  ADD CONSTRAINT `fk_brain_nerves_illness` FOREIGN KEY (`brain_nerves_illness`) REFERENCES `yesorno_questions` (`ID`),
  ADD CONSTRAINT `fk_cancer` FOREIGN KEY (`cancer`) REFERENCES `yesorno_questions` (`ID`),
  ADD CONSTRAINT `fk_easing_factors` FOREIGN KEY (`easing_factors`) REFERENCES `easing_factors` (`ID`),
  ADD CONSTRAINT `fk_headaches_pain_face` FOREIGN KEY (`headaches_pain_face`) REFERENCES `yesorno_questions` (`ID`),
  ADD CONSTRAINT `fk_internal_organs_issues` FOREIGN KEY (`internal_organs_issues`) REFERENCES `yesorno_questions` (`ID`),
  ADD CONSTRAINT `fk_muskuloskeletal_pain` FOREIGN KEY (`musculoskeletal_pain`) REFERENCES `yesorno_questions` (`ID`),
  ADD CONSTRAINT `fk_pain_beginning` FOREIGN KEY (`ID_pain_beginning`) REFERENCES `pain_beginning` (`ID`),
  ADD CONSTRAINT `fk_pain_location` FOREIGN KEY (`ID_pain_location`) REFERENCES `pain_location` (`abreviation`),
  ADD CONSTRAINT `fk_pain_qualities` FOREIGN KEY (`pain_qualities`) REFERENCES `pain_qualities` (`ID`),
  ADD CONSTRAINT `fk_sensory_symptoms` FOREIGN KEY (`sensory_symptoms`) REFERENCES `sensory_symptoms` (`ID`),
  ADD CONSTRAINT `fk_spread_of_pain` FOREIGN KEY (`spread_of_pain`) REFERENCES `yesorno_questions` (`ID`),
  ADD CONSTRAINT `fk_temporal_pattern` FOREIGN KEY (`ID_temporal_pattern`) REFERENCES `temporal_pattern` (`ID`),
  ADD CONSTRAINT `fk_treatment` FOREIGN KEY (`cancer_treatment`) REFERENCES `yesorno_questions` (`ID`),
  ADD CONSTRAINT `fk_userID` FOREIGN KEY (`ID_user`) REFERENCES `userinformation` (`ID`),
  ADD CONSTRAINT `fk_vertrebrea` FOREIGN KEY (`ID_vertebrae`) REFERENCES `vertebrea` (`ID`),
  ADD CONSTRAINT `fk_worse_after_surgery` FOREIGN KEY (`worse_after_surgery`) REFERENCES `yesorno_questions` (`ID`);

--
-- Contraintes pour la table `userinformation`
--
ALTER TABLE `userinformation`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`user_role`) REFERENCES `user_role` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
