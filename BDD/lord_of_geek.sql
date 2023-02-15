-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 15 fév. 2023 à 15:46
-- Version du serveur : 10.5.18-MariaDB-0+deb11u1
-- Version de PHP : 8.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lord_of_geek`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse_livraison`
--

CREATE TABLE `adresse_livraison` (
  `id` int(11) NOT NULL,
  `adresseRueLivraison` varchar(255) NOT NULL,
  `nomPrenomLivraison` varchar(255) NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateModification` timestamp NULL DEFAULT NULL,
  `ville_id` int(11) NOT NULL,
  `code_postal_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `adresse_livraison`
--

INSERT INTO `adresse_livraison` (`id`, `adresseRueLivraison`, `nomPrenomLivraison`, `dateCreation`, `dateModification`, `ville_id`, `code_postal_id`, `client_id`) VALUES
(4, '537 rue de toto', 'Toto Bolo', '2023-02-09 13:46:00', NULL, 1, 4, 1),
(5, '78 rue de toto 2', 'Toto Kevin', '2023-02-09 13:51:35', NULL, 1, 5, 1),
(7, '45 rue de toto 3', 'Tata Toto', '2023-02-09 13:54:36', NULL, 2, 4, 1),
(8, '48 rue de toto 4', 'Tata Yoyo', '2023-02-15 10:09:55', NULL, 1, 7, 1),
(9, '54 rue de kevin 1', 'Kevin Kevin', '2023-02-15 13:17:35', NULL, 3, 8, 2),
(10, '78 rue de test 1', 'tes test', '2023-02-15 13:18:14', NULL, 4, 9, 4),
(11, '78 rue de antoine 1', 'antoine antoine', '2023-02-15 13:18:52', NULL, 1, 5, 3);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomCategorie` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nomCategorie`) VALUES
(2, 'Aventure'),
(1, 'Combat'),
(3, 'Logique');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `mailClient` varchar(255) NOT NULL,
  `pseudoClient` varchar(20) NOT NULL,
  `motDePasse` varchar(80) NOT NULL,
  `nomPrenomClient` varchar(255) NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateModification` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `mailClient`, `pseudoClient`, `motDePasse`, `nomPrenomClient`, `dateCreation`, `dateModification`) VALUES
(1, 'toto@toto.com', 'toto', '$2y$10$zxYcckpxbviC80lyRNJbAeoheGLcdGEMeq1GDfTQgVyG2ptNqBVEu', 'TotoToto', '2023-02-08 09:25:19', NULL),
(2, 'kevin@kevin.com', 'kevin', '$2y$10$QO1oNFUzzSW2bPS9buMzMOILghKK7O2s7vXW5nl3ySjrISW9U4CEa', 'KevinKevin', '2023-02-08 13:47:01', NULL),
(3, 'antoine@antoine.com', 'antoine', '$2y$10$pLSfYhMHHBDMSDjyNZBt2.KGLeSPASttNg0GBdsyb2Vs7YJ33fCPy', 'Antoine Verlyck', '2023-02-08 15:23:24', NULL),
(4, 'test@exemple.fr', 'test', '$2y$10$JBsTjLMZVX1ozqiIJ7PSFuHtR8PBUITomCIGZSsL0zZvXV6sFbN2W', 'test test', '2023-02-15 10:44:13', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `code_postal`
--

CREATE TABLE `code_postal` (
  `id` int(11) NOT NULL,
  `codePostal` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `code_postal`
--

INSERT INTO `code_postal` (`id`, `codePostal`) VALUES
(4, '34000'),
(5, '34090'),
(7, '34070'),
(8, '93000'),
(9, '25000');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(10) UNSIGNED NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateModification` timestamp NULL DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `adresse_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `dateCreation`, `dateModification`, `client_id`, `adresse_id`) VALUES
(34, '2023-02-15 13:17:04', NULL, 1, 8),
(35, '2023-02-15 13:17:44', NULL, 2, 9),
(36, '2023-02-15 13:18:26', NULL, 4, 10),
(37, '2023-02-15 13:19:02', NULL, 3, 11),
(38, '2023-02-15 13:54:30', NULL, 1, 7),
(39, '2023-02-15 13:54:36', NULL, 1, 7),
(40, '2023-02-15 13:54:43', NULL, 1, 7);

-- --------------------------------------------------------

--
-- Structure de la table `console`
--

CREATE TABLE `console` (
  `id` int(11) NOT NULL,
  `nomConsole` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `console`
--

INSERT INTO `console` (`id`, `nomConsole`) VALUES
(1, 'NES'),
(3, 'PlayStation'),
(2, 'Xbox 360');

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `id` int(11) NOT NULL,
  `descriptionEtat` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`id`, `descriptionEtat`) VALUES
(2, 'Bon'),
(4, 'Mauvais'),
(3, 'Moyen'),
(1, 'Neuf'),
(5, 'Très mauvais');

-- --------------------------------------------------------

--
-- Structure de la table `exemplaire`
--

CREATE TABLE `exemplaire` (
  `id` int(10) UNSIGNED NOT NULL,
  `prixAchat` decimal(10,2) DEFAULT NULL,
  `prixVente` decimal(10,2) NOT NULL,
  `anneeAchat` year(4) DEFAULT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateModification` timestamp NULL DEFAULT NULL,
  `jeux_id` int(11) NOT NULL,
  `console_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `exemplaire`
--

INSERT INTO `exemplaire` (`id`, `prixAchat`, `prixVente`, `anneeAchat`, `dateCreation`, `dateModification`, `jeux_id`, `console_id`, `etat_id`) VALUES
(5, NULL, '30.00', NULL, '2023-02-01 10:01:32', NULL, 1, 1, 1),
(6, NULL, '10.00', NULL, '2023-02-01 10:01:32', NULL, 2, 2, 2),
(7, NULL, '5.00', NULL, '2023-02-01 10:01:32', NULL, 3, 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

CREATE TABLE `jeux` (
  `id` int(11) NOT NULL,
  `nomJeux` varchar(150) NOT NULL,
  `imageJeux` varchar(32) DEFAULT NULL,
  `anneeSortie` year(4) DEFAULT NULL,
  `categorie_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `jeux`
--

INSERT INTO `jeux` (`id`, `nomJeux`, `imageJeux`, `anneeSortie`, `categorie_id`) VALUES
(1, 'The Legend of Zelda', 'zelda-nes.jpeg', 1986, 2),
(2, 'Skyrim', NULL, 2011, 2),
(3, 'Tekken', NULL, 1994, 1);

-- --------------------------------------------------------

--
-- Structure de la table `lignes_commande`
--

CREATE TABLE `lignes_commande` (
  `id` int(10) UNSIGNED NOT NULL,
  `commande_id` int(10) UNSIGNED NOT NULL,
  `exemplaire_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `lignes_commande`
--

INSERT INTO `lignes_commande` (`id`, `commande_id`, `exemplaire_id`) VALUES
(1, 34, 5),
(2, 34, 6),
(3, 34, 7),
(4, 35, 5),
(5, 35, 6),
(6, 35, 7),
(7, 36, 5),
(8, 36, 6),
(9, 36, 7),
(10, 37, 5),
(11, 37, 6),
(12, 37, 7),
(13, 38, 6),
(14, 39, 5),
(15, 40, 7);

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `id` int(11) NOT NULL,
  `nomVille` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`id`, `nomVille`) VALUES
(1, 'Montpellier'),
(2, 'Sète'),
(3, 'Paris'),
(4, 'Besançon');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adresse_livraison`
--
ALTER TABLE `adresse_livraison`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_adresse_livraison_client1` (`client_id`),
  ADD KEY `fk_adresse_livraison_ville1` (`ville_id`),
  ADD KEY `fk_adresse_livraison_code_postal1` (`code_postal_id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomCategorie_UNIQUE` (`nomCategorie`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mailClient_UNIQUE` (`mailClient`),
  ADD UNIQUE KEY `pseudo` (`pseudoClient`);

--
-- Index pour la table `code_postal`
--
ALTER TABLE `code_postal`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_commandes_client1_idx` (`client_id`);

--
-- Index pour la table `console`
--
ALTER TABLE `console`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomConsole_UNIQUE` (`nomConsole`);

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `description_UNIQUE` (`descriptionEtat`);

--
-- Index pour la table `exemplaire`
--
ALTER TABLE `exemplaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_exemplaires_console1_idx` (`console_id`),
  ADD KEY `fk_exemplaires_jeux1_idx` (`jeux_id`),
  ADD KEY `fk_exemplaires_etat1_idx` (`etat_id`);

--
-- Index pour la table `jeux`
--
ALTER TABLE `jeux`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomJeux_UNIQUE` (`nomJeux`),
  ADD KEY `fk_jeux_categories1_idx` (`categorie_id`);

--
-- Index pour la table `lignes_commande`
--
ALTER TABLE `lignes_commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lignes_commande_commande_id_foreign` (`commande_id`),
  ADD KEY `lignes_commande_exemplaire_id_foreign` (`exemplaire_id`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adresse_livraison`
--
ALTER TABLE `adresse_livraison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `code_postal`
--
ALTER TABLE `code_postal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `console`
--
ALTER TABLE `console`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `etat`
--
ALTER TABLE `etat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `exemplaire`
--
ALTER TABLE `exemplaire`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `jeux`
--
ALTER TABLE `jeux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `lignes_commande`
--
ALTER TABLE `lignes_commande`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `ville`
--
ALTER TABLE `ville`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresse_livraison`
--
ALTER TABLE `adresse_livraison`
  ADD CONSTRAINT `fk_adresse_livraison_client1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_adresse_livraison_code_postal1` FOREIGN KEY (`code_postal_id`) REFERENCES `code_postal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_adresse_livraison_ville1` FOREIGN KEY (`ville_id`) REFERENCES `ville` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_commandes_client1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `exemplaire`
--
ALTER TABLE `exemplaire`
  ADD CONSTRAINT `fk_exemplaires_console1` FOREIGN KEY (`console_id`) REFERENCES `console` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_exemplaires_etat1` FOREIGN KEY (`etat_id`) REFERENCES `etat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_exemplaires_jeux1` FOREIGN KEY (`jeux_id`) REFERENCES `jeux` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `jeux`
--
ALTER TABLE `jeux`
  ADD CONSTRAINT `fk_jeux_categories1` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `lignes_commande`
--
ALTER TABLE `lignes_commande`
  ADD CONSTRAINT `lignes_commande_commande_id_foreign` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lignes_commande_exemplaire_id_foreign` FOREIGN KEY (`exemplaire_id`) REFERENCES `exemplaire` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
