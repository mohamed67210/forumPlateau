-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 08 déc. 2022 à 15:07
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `nomCategory` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id_category`, `nomCategory`) VALUES
(1, 'sport'),
(2, 'politique'),
(3, 'jeux video');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `contenue` text NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `contenue`, `dateCreation`, `user_id`, `topic_id`) VALUES
(19, 'match maroc', '2022-12-05 14:22:23', 1, 20),
(21, 'vos pronostics', '2022-12-05 16:31:33', 12, 20),
(23, 'qu&#39;est ce qui se passe en tunisie en ce moment ?', '2022-12-06 09:04:20', 12, 21),
(24, 'rien frero pq ?', '2022-12-06 09:05:29', 11, 21),
(25, 'qui est chaud pour un match ?', '2022-12-06 09:12:56', 11, 22),
(26, '3-1 portugal', '2022-12-06 09:19:32', 11, 23),
(27, '4-1 maroc', '2022-12-06 10:57:29', 11, 20);

-- --------------------------------------------------------

--
-- Structure de la table `topic`
--

CREATE TABLE `topic` (
  `id_topic` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `creationdate` datetime NOT NULL DEFAULT current_timestamp(),
  `closed` tinyint(1) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `topic`
--

INSERT INTO `topic` (`id_topic`, `title`, `description`, `creationdate`, `closed`, `category_id`, `user_id`) VALUES
(20, 'word cup', NULL, '2022-12-05 14:22:23', 0, 1, 1),
(21, 'la tunisie', NULL, '2022-12-06 09:04:19', 0, 2, 12),
(22, 'Fifa 2022', NULL, '2022-12-06 09:12:55', 0, 3, 11),
(23, 'pronostic portugal vs suisse', NULL, '2022-12-06 09:19:32', 0, 1, 11);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'membre',
  `dateCreation` datetime NOT NULL DEFAULT current_timestamp(),
  `isBanish` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `pseudo`, `mail`, `password`, `role`, `dateCreation`, `isBanish`) VALUES
(1, 'mohamed67', 'mohamed@gmail.com', 'kakaka12', 'admin', '2022-11-29 10:58:02', 0),
(8, 'koko', 'rii@hjg.fr', '$2y$10$k4BI7tsRM5XJcvP0Q22pJOjOPxKmjT6bD2S55PBso3Qa7B33p4cAi', '', '2022-12-04 12:59:23', 0),
(9, 'm45', 'ppp@hhh.ccc', '$2y$10$YsrxdNLhoZm/76vv1tFbmOrgN/E/py5TRT75RZoFKayeyGoN4uSOu', '', '2022-12-05 09:09:52', 0),
(10, 'joujou87', 'joujou@gogo.sis', '$2y$10$NN/wNsi3r6SirgaDlyzppueAzGLgajHBV0TAZRPoxfGdbPqzA20Nu', '', '2022-12-05 09:19:47', NULL),
(11, 'mbappe', 'mbappe@hotmail.com', '$2y$10$frDHmGlpZWunRw9fYDNUWu0Wn2H2K6cyuuok3xtC8xO1G/aATId.G', 'admin', '2022-12-05 11:05:42', NULL),
(12, 'kha56', 'khazri@hhh.com', '$2y$10$ovZzC12bfCn2oH23VcfdkO95TL9FQLRtyxjT6UlttirUdD.dSbXve', 'membre', '2022-12-05 11:25:08', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `user_id` (`user_id`,`topic_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Index pour la table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id_topic`),
  ADD KEY `category_id` (`category_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `topic`
--
ALTER TABLE `topic`
  MODIFY `id_topic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`);

--
-- Contraintes pour la table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  ADD CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
