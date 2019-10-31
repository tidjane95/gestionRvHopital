-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mer 30 Octobre 2019 à 10:38
-- Version du serveur :  5.7.27-0ubuntu0.18.04.1
-- Version de PHP :  7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestionRv`
--

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

CREATE TABLE `medecin` (
  `Id_Medecin` int(11) NOT NULL,
  `Prenom_Medecin` varchar(100) NOT NULL,
  `Nom_Medecin` varchar(100) NOT NULL,
  `Email_Medecin` varchar(100) NOT NULL,
  `Telephone_Medecin` varchar(100) NOT NULL,
  `Id_Service` int(11) NOT NULL,
  `Id_Specialiter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `medecin`
--

INSERT INTO `medecin` (`Id_Medecin`, `Prenom_Medecin`, `Nom_Medecin`, `Email_Medecin`, `Telephone_Medecin`, `Id_Service`, `Id_Specialiter`) VALUES
(1, 'Ousmane', 'Ba', '773459628', 'ouzbizii95@gmail.com', 1, 1),
(2, 'Astou', 'LO', '779744349', 'astou987@gmail.com', 6, 3),
(3, 'Seck Lo', 'Gueye', '779856874', 'secklo98@gmail.com', 2, 4),
(4, 'Astou', 'Thiadoum', '704569875', 'thiadoum96@gmail.com', 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `Id_Patient` int(11) NOT NULL,
  `Prenom_Patient` varchar(100) NOT NULL,
  `Nom_Patient` varchar(100) NOT NULL,
  `Age` varchar(10) NOT NULL,
  `Sexe` varchar(10) NOT NULL,
  `Adresse` varchar(100) NOT NULL,
  `Telephone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `patient`
--

INSERT INTO `patient` (`Id_Patient`, `Prenom_Patient`, `Nom_Patient`, `Age`, `Sexe`, `Adresse`, `Telephone`) VALUES
(1, 'Dame', 'Loum', '25', 'Homme', 'Malika', '775995696'),
(2, 'Lamine', 'Deme', '36', 'M', 'Mbao', '706982347'),
(3, 'Adja', 'Gaye', '19', 'F', 'Keur Massar', '768968523'),
(4, 'Kadia', 'LY', '29', 'F', 'Pikine', '768967521');

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

CREATE TABLE `planning` (
  `Id_Planning` int(11) NOT NULL,
  `Jours` varchar(100) NOT NULL,
  `Heure` varchar(100) NOT NULL,
  `Id_Medecin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `planning`
--

INSERT INTO `planning` (`Id_Planning`, `Jours`, `Heure`, `Id_Medecin`) VALUES
(1, 'Lundi', '8H-12H', 1),
(2, 'Mecredi', '15h-17h', 2);

-- --------------------------------------------------------

--
-- Structure de la table `RV`
--

CREATE TABLE `RV` (
  `Id_Rv` int(11) NOT NULL,
  `Id_Patient` int(11) NOT NULL,
  `Id_Secreteriat` int(11) NOT NULL,
  `Date_RV` varchar(100) NOT NULL,
  `Heure_Rv` varchar(10) NOT NULL,
  `Durer` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `RV`
--

INSERT INTO `RV` (`Id_Rv`, `Id_Patient`, `Id_Secreteriat`, `Date_RV`, `Heure_Rv`, `Durer`) VALUES
(1, 1, 1, '21/08/2018', '8h', '15min');

-- --------------------------------------------------------

--
-- Structure de la table `secreteriat`
--

CREATE TABLE `secreteriat` (
  `Id_Secreteriat` int(11) NOT NULL,
  `Prenom_Secreteriat` varchar(100) NOT NULL,
  `Nom_Secreteriat` varchar(100) NOT NULL,
  `Email_Secreteriat` varchar(100) NOT NULL,
  `Telephone_Secreteriat` varchar(100) NOT NULL,
  `Id_Service` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `secreteriat`
--

INSERT INTO `secreteriat` (`Id_Secreteriat`, `Prenom_Secreteriat`, `Nom_Secreteriat`, `Email_Secreteriat`, `Telephone_Secreteriat`, `Id_Service`) VALUES
(1, 'Guimar', 'Mbegue', '775998697', 'guisethianta@gmail.com', 2),
(2, 'Mane Diarra', 'Seck', '786985647', 'diarra569@gmail.com', 1),
(3, 'Fatou', 'Diene', '789875698', 'fatou96@gmail.com', 3),
(4, 'Khady', 'Mbaye', '774568963', 'khady89@gmail.com', 4),
(5, 'Diodio', 'Diagne', '778964532', 'diodio989@gmail.com', 1),
(6, 'Nathali', 'Coly', '779855678', 'nathalicoly@gmail.com', 6),
(7, 'Awa', 'Diouf', '774589678', 'awadiouf@gmail.com', 7);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `Id_Service` int(11) NOT NULL,
  `Nom_Service` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `service`
--

INSERT INTO `service` (`Id_Service`, `Nom_Service`) VALUES
(1, 'Neurologie'),
(2, 'Dentisterie'),
(3, 'Ophtalmologie'),
(4, 'Cardiologie'),
(5, 'Radiologie'),
(6, 'Psychiatrie'),
(7, 'Anesthesiologie');

-- --------------------------------------------------------

--
-- Structure de la table `specialiter`
--

CREATE TABLE `specialiter` (
  `Id_Specialiter` int(11) NOT NULL,
  `Nom_Specialiter` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `specialiter`
--

INSERT INTO `specialiter` (`Id_Specialiter`, `Nom_Specialiter`) VALUES
(1, 'Dermatologie'),
(2, 'Cardiologie'),
(3, 'Chirurgie cardiaque'),
(4, 'Chirurgie esthetique');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `medecin`
--
ALTER TABLE `medecin`
  ADD PRIMARY KEY (`Id_Medecin`),
  ADD KEY `medecin_service0_FK` (`Id_Service`),
  ADD KEY `medecin_specialiter1_FK` (`Id_Specialiter`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`Id_Patient`);

--
-- Index pour la table `planning`
--
ALTER TABLE `planning`
  ADD PRIMARY KEY (`Id_Planning`),
  ADD KEY `planning_medecin0_FK` (`Id_Medecin`);

--
-- Index pour la table `RV`
--
ALTER TABLE `RV`
  ADD PRIMARY KEY (`Id_Rv`),
  ADD KEY `RV_patient0_FK` (`Id_Patient`),
  ADD KEY `RV_secreteriat1_FK` (`Id_Secreteriat`);

--
-- Index pour la table `secreteriat`
--
ALTER TABLE `secreteriat`
  ADD PRIMARY KEY (`Id_Secreteriat`),
  ADD KEY `secreteriat_service0_FK` (`Id_Service`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`Id_Service`);

--
-- Index pour la table `specialiter`
--
ALTER TABLE `specialiter`
  ADD PRIMARY KEY (`Id_Specialiter`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `medecin`
--
ALTER TABLE `medecin`
  MODIFY `Id_Medecin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `Id_Patient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `planning`
--
ALTER TABLE `planning`
  MODIFY `Id_Planning` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `RV`
--
ALTER TABLE `RV`
  MODIFY `Id_Rv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `secreteriat`
--
ALTER TABLE `secreteriat`
  MODIFY `Id_Secreteriat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `Id_Service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `specialiter`
--
ALTER TABLE `specialiter`
  MODIFY `Id_Specialiter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `medecin`
--
ALTER TABLE `medecin`
  ADD CONSTRAINT `medecin_service0_FK` FOREIGN KEY (`Id_Service`) REFERENCES `service` (`Id_Service`),
  ADD CONSTRAINT `medecin_specialiter1_FK` FOREIGN KEY (`Id_Specialiter`) REFERENCES `specialiter` (`Id_Specialiter`);

--
-- Contraintes pour la table `planning`
--
ALTER TABLE `planning`
  ADD CONSTRAINT `planning_medecin0_FK` FOREIGN KEY (`Id_Medecin`) REFERENCES `medecin` (`Id_Medecin`);

--
-- Contraintes pour la table `RV`
--
ALTER TABLE `RV`
  ADD CONSTRAINT `RV_patient0_FK` FOREIGN KEY (`Id_Patient`) REFERENCES `patient` (`Id_Patient`),
  ADD CONSTRAINT `RV_secreteriat1_FK` FOREIGN KEY (`Id_Secreteriat`) REFERENCES `secreteriat` (`Id_Secreteriat`);

--
-- Contraintes pour la table `secreteriat`
--
ALTER TABLE `secreteriat`
  ADD CONSTRAINT `secreteriat_ibfk_1` FOREIGN KEY (`Id_Secreteriat`) REFERENCES `service` (`Id_Service`),
  ADD CONSTRAINT `secreteriat_service0_FK` FOREIGN KEY (`Id_Service`) REFERENCES `service` (`Id_Service`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
