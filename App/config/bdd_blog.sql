-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 26 jan. 2023 à 16:15
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog_oc`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(70) NOT NULL,
  `content` longtext NOT NULL,
  `date` datetime NOT NULL,
  `chapo` text NOT NULL,
  `author_id` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `date`, `chapo`, `author_id`) VALUES
(7, 'Ceci est un Article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra dolor ex, id rutrum dui volutpat sed. Fusce leo libero, vehicula et vehicula vitae, laoreet ac erat. Quisque nec dolor congue mauris accumsan sollicitudin vitae ac neque. Aenean id placerat tellus, eget venenatis nisl. Quisque a massa quis augue lobortis congue. Donec eget molestie est. Cras orci mauris, sollicitudin in dui non, tristique sagittis nunc. Aenean sem sapien, auctor id viverra facilisis, vestibulum id velit. Proin faucibus lorem ac leo cursus, in dapibus lectus scelerisque. Vivamus orci dui, varius sed ipsum id, accumsan auctor leo. Quisque posuere imperdiet justo vel convallis.\r\n\r\nDonec in est libero. Cras ut tempus massa. Integer ex orci, viverra vitae lacus ac, lacinia porttitor lacus. Nunc libero neque, feugiat ac varius ut, aliquam sit amet risus. Vivamus facilisis nisl eget tincidunt egestas. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer ut felis vestibulum, porttitor tellus eget, scelerisque tellus. Nullam finibus dictum placerat.', '2023-01-26 14:46:20', 'Voici le chapo qui rÃ©sume l\'article, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra dolor ex, id rutrum dui volutpat sed. ', 23),
(8, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra dolor ex, id rutrum dui volutpat sed. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra dolor ex, id rutrum dui volutpat sed. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra dolor ex, id rutrum dui volutpat sed. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra dolor ex, id rutrum dui volutpat sed. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra dolor ex, id rutrum dui volutpat sed. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra dolor ex, id rutrum dui volutpat sed. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra dolor ex, id rutrum dui volutpat sed. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra dolor ex, id rutrum dui volutpat sed. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra dolor ex, id rutrum dui volutpat sed. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra dolor ex, id rutrum dui volutpat sed. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra dolor ex, id rutrum dui volutpat sed. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra dolor ex, id rutrum dui volutpat sed. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra dolor ex, id rutrum dui volutpat sed. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra dolor ex, id rutrum dui volutpat sed. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra dolor ex, id rutrum dui volutpat sed. ', '2023-01-26 14:47:06', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra dolor ex, id rutrum dui volutpat sed. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra dolor ex, id rutrum dui volutpat sed. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra dolor ex, id rutrum dui volutpat sed. ', 24);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `contentCom` varchar(255) NOT NULL,
  `dateComment` datetime NOT NULL,
  `isChecked` tinyint(1) NOT NULL DEFAULT '0',
  `author_id` tinyint(4) NOT NULL,
  `article_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `contentCom`, `dateComment`, `isChecked`, `author_id`, `article_id`) VALUES
(41, 'TrÃ¨s intÃ©ressant !', '2023-01-26 14:49:28', 1, 23, 8),
(42, 'Super !', '2023-01-26 14:50:04', 1, 24, 7),
(43, 'Merci !', '2023-01-26 14:50:13', 0, 24, 8),
(44, 'Merci !!', '2023-01-26 14:50:24', 0, 24, 8);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `password` varchar(70) DEFAULT NULL,
  `role` varchar(50) DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `email`, `password`, `role`) VALUES
(23, 'Admin', 'admin@juliennadal.com', '$2y$10$WAAEfrqXspw0BFt/HEdqDuaJSB6H4/VrdYpUp/XCqeSVnWu6L0Qo.', 'Admin'),
(24, 'User', 'user@juliennadal.com', '$2y$10$v9KUHF//CZM/r4tzo3YvRePPbU6MGfazuU3KQlhWXoJzdpQ8td.tC', 'user');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
