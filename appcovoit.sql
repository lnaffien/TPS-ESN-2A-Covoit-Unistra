-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 16 avr. 2024 à 10:08
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `appcovoit`
--

-- --------------------------------------------------------

--
-- Structure de la table `ami`
--

CREATE TABLE `ami` (
  `idAmi` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idUtilisateurAmi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `idUserFK` int(11) DEFAULT NULL,
  `idTrajetFK` int(11) DEFAULT NULL,
  `note` int(11) DEFAULT NULL,
  `commentaire` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `creneau`
--

CREATE TABLE `creneau` (
  `idCreneau` int(11) NOT NULL,
  `numCalendrier` varchar(100) DEFAULT NULL,
  `matiere` varchar(30) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `heureDebut` time DEFAULT NULL,
  `heureFin` time DEFAULT NULL,
  `disponibilite` varchar(30) DEFAULT NULL,
  `localisation` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `possede`
--

CREATE TABLE `possede` (
  `idUserFK` int(11) NOT NULL,
  `idCreneauFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `idReservation` int(11) NOT NULL,
  `nbPlaceReservees` int(11) NOT NULL,
  `dateReservation` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `idTrajetFK` int(11) DEFAULT NULL,
  `idPassagerFK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `trajet`
--

CREATE TABLE `trajet` (
  `idTrajet` int(11) NOT NULL,
  `villeDepart` varchar(50) DEFAULT NULL,
  `villeArrivee` varchar(50) DEFAULT NULL,
  `dateDepart` date DEFAULT NULL,
  `heureDepart` time DEFAULT NULL,
  `nbPlaces` int(11) DEFAULT NULL,
  `idConducteurFK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUser` int(11) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `motDePasse` varchar(100) DEFAULT NULL,
  `nagenda` int(11) NOT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `dateInscription` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ami`
--
ALTER TABLE `ami`
  ADD PRIMARY KEY (`idAmi`),
  ADD KEY `FK_idUtilisateur` (`idUtilisateur`),
  ADD KEY `FK_idUtilisateurAmi` (`idUtilisateurAmi`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD KEY `idTrajetFK` (`idTrajetFK`),
  ADD KEY `idUserFK` (`idUserFK`);

--
-- Index pour la table `creneau`
--
ALTER TABLE `creneau`
  ADD PRIMARY KEY (`idCreneau`);

--
-- Index pour la table `possede`
--
ALTER TABLE `possede`
  ADD KEY `idUserFK` (`idUserFK`),
  ADD KEY `idCreneauFK` (`idCreneauFK`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`idReservation`),
  ADD KEY `idTrajetFK` (`idTrajetFK`),
  ADD KEY `idPassagerFK` (`idPassagerFK`);

--
-- Index pour la table `trajet`
--
ALTER TABLE `trajet`
  ADD PRIMARY KEY (`idTrajet`),
  ADD KEY `idConducteurFK` (`idConducteurFK`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `creneau`
--
ALTER TABLE `creneau`
  MODIFY `idCreneau` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `idReservation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `trajet`
--
ALTER TABLE `trajet`
  MODIFY `idTrajet` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ami`
--
ALTER TABLE `ami`
  ADD CONSTRAINT `FK_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_idUtilisateurAmi` FOREIGN KEY (`idUtilisateurAmi`) REFERENCES `utilisateur` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`idTrajetFK`) REFERENCES `trajet` (`idTrajet`),
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`idUserFK`) REFERENCES `utilisateur` (`idUser`);

--
-- Contraintes pour la table `possede`
--
ALTER TABLE `possede`
  ADD CONSTRAINT `possede_ibfk_1` FOREIGN KEY (`idUserFK`) REFERENCES `utilisateur` (`idUser`),
  ADD CONSTRAINT `possede_ibfk_2` FOREIGN KEY (`idCreneauFK`) REFERENCES `creneau` (`idCreneau`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`idTrajetFK`) REFERENCES `trajet` (`idTrajet`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`idPassagerFK`) REFERENCES `utilisateur` (`idUser`);

--
-- Contraintes pour la table `trajet`
--
ALTER TABLE `trajet`
  ADD CONSTRAINT `trajet_ibfk_1` FOREIGN KEY (`idConducteurFK`) REFERENCES `utilisateur` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
