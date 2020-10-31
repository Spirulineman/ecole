-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 28 oct. 2020 à 14:25
-- Version du serveur :  5.7.17
-- Version de PHP :  7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bibliotheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE `livre` (
  `ID` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `date_edition` date NOT NULL,
  `resume` text NOT NULL,
  `note` int(11) NOT NULL DEFAULT '5'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`ID`, `titre`, `date_edition`, `resume`, `note`) VALUES
(1, 'Dune', '2020-10-27', '', 5),
(2, 'Bible', '2020-10-27', '', 5),
(3, 'Toto\'s story', '2020-10-21', 'Toto\'s story arnold classic \'\'\'\'\' &amp;&amp;&amp;&amp; &quot;', 10),
(4, 'Toto\'s story', '2020-10-21', 'Toto\'s story arnold classic \'\'\'\'\' &amp;&amp;&amp;&amp; &quot;', 10),
(5, 'Toto\'s story', '2020-10-21', 'Toto\'s story arnold classic \'\'\'\'\' &amp;&amp;&amp;&amp; &quot;\r\n\r\nsighdsigdbfgibdfgdgfgdf\r\n\r\ndsokmghdfsmgj', 100),
(6, 'Livre', '2020-10-15', 'C\'est un super livre !', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
