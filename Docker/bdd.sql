-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db:3306
-- Généré le : jeu. 18 juil. 2024 à 22:38
-- Version du serveur : 8.0.36
-- Version de PHP : 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `auto2`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
                             `id` int NOT NULL,
                             `libelle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                             `prix` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
                                               `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
                                               `executed_at` datetime DEFAULT NULL,
                                               `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
    ('DoctrineMigrations\\Version20240706233236', '2024-07-07 00:56:57', 438);

-- --------------------------------------------------------

--
-- Structure de la table `lecon`
--

CREATE TABLE `lecon` (
                         `id` int NOT NULL,
                         `code_moniteur_id` int DEFAULT NULL,
                         `code_eleve_id` int DEFAULT NULL,
                         `immatriculation_id` int DEFAULT NULL,
                         `reglee` tinyint(1) DEFAULT NULL,
                         `rdv` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `licence`
--

CREATE TABLE `licence` (
                           `id` int NOT NULL,
                           `code_categorie_id` int DEFAULT NULL,
                           `code_moniteur_id` int DEFAULT NULL,
                           `date_obtention` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
                                      `id` bigint NOT NULL,
                                      `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                                      `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                                      `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
                                      `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
                                      `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
                                      `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
                        `id` int NOT NULL,
                        `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
                        `roles` json NOT NULL,
                        `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                        `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                        `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                        `sexe` tinyint(1) DEFAULT NULL,
                        `birthday_date` date DEFAULT NULL,
                        `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                        `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                        `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                        `phone` int DEFAULT NULL,
                        `type_compte` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                        `discr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `sexe`, `birthday_date`, `adresse`, `postal_code`, `city`, `phone`, `type_compte`, `discr`) VALUES
                                                                                                                                                                         (1, 'eleve@test.com', '[\"ROLE_ELEVE\"]', '$2y$13$OoF/yKCwTwt4hFDGhh3vnesu0CWI2bA7oQAhOs0ZUGvXMqkPbMw7m', 'Heller', 'Reginald', 0, '2006-05-16', '3114 McCullough Squares Apt. 329\nCraigbury, KS 51278', '18359', 'Zeldaview', 0, 'eleve', 'user'),
                                                                                                                                                                         (2, 'moniteur@test.com', '[\"ROLE_MONITEUR\"]', '$2y$13$Msk7dsKxJWSuMGCwyXFPK.qx3M4yXUzz3mQdwwbAN4oZma8mdKvUe', 'Abernathy', 'Kole', 0, '2000-05-30', '208 O\'Reilly Circle Suite 247\nSonnymouth, AZ 33299-3946', '58562-9564', 'North Yasminbury', NULL, 'moniteur', 'user');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
                            `id` int NOT NULL,
                            `code_categorie_id` int DEFAULT NULL,
                            `marque` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `modele` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `annee` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
    ADD PRIMARY KEY (`version`);

--
-- Index pour la table `lecon`
--
ALTER TABLE `lecon`
    ADD PRIMARY KEY (`id`),
    ADD KEY `IDX_94E6242EEB754C63` (`code_moniteur_id`),
    ADD KEY `IDX_94E6242EF3EDBF99` (`code_eleve_id`),
    ADD KEY `IDX_94E6242E5FD1A365` (`immatriculation_id`);

--
-- Index pour la table `licence`
--
ALTER TABLE `licence`
    ADD PRIMARY KEY (`id`),
    ADD KEY `IDX_1DAAE64877DD1548` (`code_categorie_id`),
    ADD KEY `IDX_1DAAE648EB754C63` (`code_moniteur_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
    ADD PRIMARY KEY (`id`),
    ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
    ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
    ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
    ADD PRIMARY KEY (`id`),
    ADD KEY `IDX_292FFF1D77DD1548` (`code_categorie_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lecon`
--
ALTER TABLE `lecon`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `licence`
--
ALTER TABLE `licence`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
    MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `lecon`
--
ALTER TABLE `lecon`
    ADD CONSTRAINT `FK_94E6242E5FD1A365` FOREIGN KEY (`immatriculation_id`) REFERENCES `vehicule` (`id`),
    ADD CONSTRAINT `FK_94E6242EEB754C63` FOREIGN KEY (`code_moniteur_id`) REFERENCES `user` (`id`),
    ADD CONSTRAINT `FK_94E6242EF3EDBF99` FOREIGN KEY (`code_eleve_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `licence`
--
ALTER TABLE `licence`
    ADD CONSTRAINT `FK_1DAAE64877DD1548` FOREIGN KEY (`code_categorie_id`) REFERENCES `categorie` (`id`),
    ADD CONSTRAINT `FK_1DAAE648EB754C63` FOREIGN KEY (`code_moniteur_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `vehicule`
--
ALTER TABLE `vehicule`
    ADD CONSTRAINT `FK_292FFF1D77DD1548` FOREIGN KEY (`code_categorie_id`) REFERENCES `categorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
