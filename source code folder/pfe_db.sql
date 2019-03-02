-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 02 mars 2019 à 10:59
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.1.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pfe_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctors`
--

CREATE TABLE `doctors` (
  `D_id` int(11) NOT NULL,
  `D_name` varchar(255) NOT NULL,
  `D_password` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `office` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `groupID` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `doctors`
--

INSERT INTO `doctors` (`D_id`, `D_name`, `D_password`, `age`, `adress`, `office`, `phone`, `groupID`, `description`) VALUES
(1, 'tidda', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 23, 'chlef-dz', 'chlef 151', '0123456', 1, 'medical specialist in orthopedic surgery'),
(6, 'mohamed', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 0, 'a', 'a', 'a', 0, 'medical specialist in orthopedic surgery'),
(8, 'islam', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, 'chlef-dz', 'chlef', '0123456', 0, 'medical specialist in orthopedic surgery');

-- --------------------------------------------------------

--
-- Structure de la table `mdicines_described`
--

CREATE TABLE `mdicines_described` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dose` double NOT NULL,
  `repeated` int(11) NOT NULL,
  `boxs` int(11) NOT NULL,
  `form` varchar(255) NOT NULL,
  `time_use` varchar(255) NOT NULL,
  `p_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `prescribe_date` date NOT NULL,
  `prescription_id` int(11) DEFAULT NULL,
  `already_added` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mdicines_described`
--

INSERT INTO `mdicines_described` (`id`, `name`, `dose`, `repeated`, `boxs`, `form`, `time_use`, `p_id`, `d_id`, `prescribe_date`, `prescription_id`, `already_added`) VALUES
(38, 'Abacavir Sulfate', 0.5, 2, 2, 'Troches', 'after meal', 5, 1, '2019-03-02', 37, 1),
(39, 'Bacitracin', 1.5, 1, 3, 'Liquid', 'before meal', 5, 1, '2019-03-02', 37, 1);

-- --------------------------------------------------------

--
-- Structure de la table `medicines`
--

CREATE TABLE `medicines` (
  `med_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `medicines`
--

INSERT INTO `medicines` (`med_id`, `name`) VALUES
(1, 'Abacavir Sulfate'),
(2, 'Abarelix\r\n'),
(3, 'Bacitracin'),
(4, 'Bactrim'),
(5, 'Banzel'),
(6, 'Cabergoline'),
(7, 'Cafcit');

-- --------------------------------------------------------

--
-- Structure de la table `patientofdoctor`
--

CREATE TABLE `patientofdoctor` (
  `pOd_id` int(11) NOT NULL,
  `D_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `patientofdoctor`
--

INSERT INTO `patientofdoctor` (`pOd_id`, `D_id`, `p_id`) VALUES
(9, 1, 1),
(10, 1, 4),
(11, 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `patients`
--

CREATE TABLE `patients` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_password` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `phone` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `patients`
--

INSERT INTO `patients` (`p_id`, `p_name`, `p_password`, `birth_date`, `phone`, `adress`) VALUES
(1, 'khaled', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1998-08-15', '1234', 'chlef'),
(2, 'ahmed', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1996-08-15', '987654321', 'chlef-dz'),
(3, 'youcef', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1988-01-10', '987654321', 'chlef-dz'),
(4, 'zaki', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '1995-03-02', '123456', 'chlef'),
(5, 'sohayeb', '1ba36e6200640edd06654522fa1137c8c72b4fb0', '1994-03-08', '123456', 'chlef');

-- --------------------------------------------------------

--
-- Structure de la table `pharmacy`
--

CREATE TABLE `pharmacy` (
  `ph_id` int(11) NOT NULL,
  `ph_name` varchar(255) NOT NULL,
  `ph_password` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `owner_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pharmacy`
--

INSERT INTO `pharmacy` (`ph_id`, `ph_name`, `ph_password`, `adress`, `phone`, `owner_name`) VALUES
(1, 'youcef', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'alger-dz', 'a', 'a');

-- --------------------------------------------------------

--
-- Structure de la table `prescription`
--

CREATE TABLE `prescription` (
  `id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `add_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `prescription`
--

INSERT INTO `prescription` (`id`, `p_id`, `d_id`, `add_time`) VALUES
(12, 4, 1, '2019-03-01'),
(37, 5, 1, '2019-03-02'),
(38, 5, 6, '2018-03-02');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`D_id`);

--
-- Index pour la table `mdicines_described`
--
ALTER TABLE `mdicines_described`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mdicines_described_ibfk_1` (`d_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `mdicines_described_ibfk_3` (`prescription_id`);

--
-- Index pour la table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`med_id`);

--
-- Index pour la table `patientofdoctor`
--
ALTER TABLE `patientofdoctor`
  ADD PRIMARY KEY (`pOd_id`),
  ADD KEY `orders1` (`D_id`),
  ADD KEY `order2` (`p_id`);

--
-- Index pour la table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`p_id`);

--
-- Index pour la table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD PRIMARY KEY (`ph_id`);

--
-- Index pour la table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `d_id` (`d_id`),
  ADD KEY `p_id` (`p_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `D_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `mdicines_described`
--
ALTER TABLE `mdicines_described`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `med_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `patientofdoctor`
--
ALTER TABLE `patientofdoctor`
  MODIFY `pOd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `patients`
--
ALTER TABLE `patients`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `pharmacy`
--
ALTER TABLE `pharmacy`
  MODIFY `ph_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `mdicines_described`
--
ALTER TABLE `mdicines_described`
  ADD CONSTRAINT `mdicines_described_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `doctors` (`D_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mdicines_described_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `patients` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mdicines_described_ibfk_3` FOREIGN KEY (`prescription_id`) REFERENCES `prescription` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `patientofdoctor`
--
ALTER TABLE `patientofdoctor`
  ADD CONSTRAINT `order2` FOREIGN KEY (`p_id`) REFERENCES `patients` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders1` FOREIGN KEY (`D_id`) REFERENCES `doctors` (`D_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `doctors` (`D_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `patients` (`p_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
