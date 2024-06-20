-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 20 juin 2024 à 18:57
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
-- Base de données : `ifpli_bd_projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` bigint(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `photos` varchar(255) NOT NULL,
  `videos` varchar(255) NOT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_date` date NOT NULL DEFAULT current_timestamp(),
  `modified_by` varchar(55) NOT NULL,
  `modified_date` date NOT NULL DEFAULT current_timestamp(),
  `deleted` tinyint(1) NOT NULL DEFAULT 1,
  `modified` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='table des evenements';

-- --------------------------------------------------------

--
-- Structure de la table `levels`
--

CREATE TABLE `levels` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `availability` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='table des formations';

--
-- Déchargement des données de la table `levels`
--

INSERT INTO `levels` (`id`, `name`, `availability`) VALUES
(1, 'niveau1', 'oui'),
(2, 'niveau2', 'non'),
(3, 'niveau3', 'non'),
(4, 'niveau4', 'non');

-- --------------------------------------------------------

--
-- Structure de la table `pre_registrations`
--

CREATE TABLE `pre_registrations` (
  `id` int(11) NOT NULL,
  `modified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='table des pre_inscription';

-- --------------------------------------------------------

--
-- Structure de la table `pre_registration_trainings`
--

CREATE TABLE `pre_registration_trainings` (
  `id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL,
  `pre_registration_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `entrance_degree` varchar(255) NOT NULL,
  `birth_cetificate` varchar(255) NOT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_date` date NOT NULL DEFAULT current_timestamp(),
  `modified_by` varchar(55) NOT NULL,
  `modified_date` date NOT NULL DEFAULT current_timestamp(),
  `deleted` tinyint(1) NOT NULL DEFAULT 1,
  `accademic_year` varchar(9) NOT NULL,
  `modified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='table des inscriptions';

-- --------------------------------------------------------

--
-- Structure de la table `registration_trainings`
--

CREATE TABLE `registration_trainings` (
  `id` int(11) NOT NULL,
  `registration_id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `description` varchar(55) NOT NULL,
  `name` varchar(20) NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `description`, `name`) VALUES
(1, 'student designe les etudiant', 'student'),
(2, 'secretary designe les secretaire', 'secretary'),
(3, 'director designe le directeur', 'director'),
(4, 'visitor désigne l\'inscription fait par des visiteur en ', 'visitor');

-- --------------------------------------------------------

--
-- Structure de la table `trainings`
--

CREATE TABLE `trainings` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `durations` int(2) NOT NULL,
  `modified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='table des formations';

--
-- Déchargement des données de la table `trainings`
--

INSERT INTO `trainings` (`id`, `code`, `description`, `price`, `durations`, `modified`) VALUES
(3, 'DA', 'develloppement d\'application', 0, 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `training_levels`
--

CREATE TABLE `training_levels` (
  `id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `last_name` varchar(55) NOT NULL,
  `first_name` varchar(55) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `phone_number` bigint(9) NOT NULL,
  `birth_date` date NOT NULL,
  `photo_user` varchar(255) NOT NULL,
  `passwords` varchar(255) NOT NULL,
  `registration_number` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'afficher',
  `created_by` varchar(55) NOT NULL,
  `created_date` date NOT NULL DEFAULT current_timestamp(),
  `modifie_by` varchar(55) NOT NULL,
  `modifie_date` date NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `last_name`, `first_name`, `mail`, `phone_number`, `birth_date`, `photo_user`, `passwords`, `registration_number`, `status`, `created_by`, `created_date`, `modifie_by`, `modifie_date`, `deleted`, `role_id`) VALUES
(2, 'fabrice', 'nkeumo', 'nkeumofabrice@gmail.com', 690487232, '0000-00-00', '', '$2y$10$tJiesR22XqH8G9WdIDH33e5C5Ikhp8KZPqhiLRCHAkBT1HpAB7xpm', '', 'afficher', '', '2024-06-12', '', '0000-00-00', 1, 3),
(4, 'fabrice', 'nkeumo', 'nkeumofabrice@gmail.com', 123456789, '0000-00-00', '', '', '', 'afficher', '', '2024-06-12', '', '0000-00-00', 1, 4),
(5, 'fabiola', 'fabiola', 'fabiola@gmail.com', 123456789, '0000-00-00', '', 'fabiola@gmail.com', '', 'afficher', '', '2024-06-12', '', '0000-00-00', 1, 4),
(10, '690487232', 'fab@gmail.com', 'fab@gmail.com', 690487232, '2021-12-27', 'Couleur bouton.PNG', '$2y$10$uPZy8qWpKKEAQuWtygbuH.hkqkI2xbQcZuUeNC9jxoFTDpF9SQuGm', '', 'afficher', '', '2024-06-20', '', '0000-00-00', 0, 1),
(11, '690487232', 'fab@gmail.com', 'fab@gmail.com', 690487232, '2021-12-27', 'Couleur bouton.PNG', '$2y$10$uPZy8qWpKKEAQuWtygbuH.hkqkI2xbQcZuUeNC9jxoFTDpF9SQuGm', '', 'afficher', '', '2024-06-20', '', '0000-00-00', 0, 1),
(12, '690487232', 'fabiola@gmail.com', 'fabiola@gmail.com', 690487232, '2024-05-28', 'gestiondocument.sql', '$2y$10$QwTADgWKdMMufJ091XXsmu3A5ySFiUj9yG9K7rrvsaBncLV28ywRi', '', 'afficher', '', '2024-06-20', '', '0000-00-00', 0, 1),
(13, '690487232', 'fabiola@gmail.com', 'fabiola@gmail.com', 690487232, '2024-05-28', 'gestiondocument.sql', '$2y$10$QwTADgWKdMMufJ091XXsmu3A5ySFiUj9yG9K7rrvsaBncLV28ywRi', '', 'afficher', '', '2024-06-20', '', '0000-00-00', 0, 1),
(14, '670778907', 'nk2@gmail.com', 'nk2@gmail.com', 670778907, '2024-06-20', 'colonneTailwind.PNG', '$2y$10$8gD6C3atsDm9mhaQHiJZX.U4riqz8vItTvdJ9vWs/pJ9.2tTmq1W.', '', 'afficher', '', '2024-06-20', '', '0000-00-00', 0, 1),
(15, '138521856', 'fab10@gmail.com', 'fab10@gmail.com', 138521856, '2024-06-20', 'ColonneEndStart.PNG', '$2y$10$lxg3jyjcJlz47V89359Jg.d.ZIzRT1SQFc89Q0QiWL7EefKxopMgO', '', 'afficher', '', '2024-06-20', '', '0000-00-00', 0, 1),
(16, '6904872355', 'nkeumofabrice@gmail.com', 'nkeumofabrice@gmail.com', 6904872355, '2024-06-20', 'autoload1.PNG', '$2y$10$BuaL4A4wvUjNWBzFq1gv6.JiNpC0neMKhxE9tpdXSyEBqJA1HrMii', 'IFPLI-24-0001', 'afficher', '', '2024-06-20', '', '0000-00-00', 0, 1),
(17, '65588520', 'fab234@gmail.com', 'fab234@gmail.com', 65588520, '2024-06-20', 'Capture.PNG', '$2y$10$MgdmgUG/OrF0.ZXRd6ukS.4llHYGVxvPfRfOFxjmttG4wwbvaTy7K', 'IFPLI-24-0001', 'afficher', '', '2024-06-20', '', '0000-00-00', 0, 1),
(18, '69045852', 'fab210@gmail.com', 'fab210@gmail.com', 69045852, '2024-06-20', 'Capture.PNG', '$2y$10$nB.b6LsuQif.PTOJzpvu3ekG/qbnM2EGHaDTQrY6E28hgWxlqt7BK', 'IFPLI-24-0001', 'afficher', '', '2024-06-20', '', '0000-00-00', 0, 1),
(19, '8520', 'fab20@gmail.com', 'fab20@gmail.com', 8520, '2024-06-20', 'EXCEL.EXE', '$2y$10$g7Jo2S9INkeuG1aB4e1MKutrMINuh5a8EWIJhcAWkDkbeYd6qtdk2', '', 'afficher', '', '2024-06-20', '', '0000-00-00', 0, 1),
(20, '9620410', 'fab33@gmail.com', 'fab33@gmail.com', 9620410, '2024-06-20', 'autoload1.PNG', '$2y$10$V5/i4yGHTAoVDUvTN32obu/FzJmtErWkEc/V6nVpZ5MGxXqROoT1y', '', 'afficher', '', '2024-06-20', '', '0000-00-00', 0, 1),
(21, '8520852', 'fab10@gmail.com', 'fab10@gmail.com', 8520852, '2024-06-20', 'colonneTailwind.PNG', '$2y$10$OqSg.XjtJasGOjbuHtJz/.6/eRbQBDk7Str2qaVOKNpAkWlO8apXa', '', 'afficher', '', '2024-06-20', '', '0000-00-00', 0, 1),
(22, '12385284', 'fab11@gmail.com', 'fab11@gmail.com', 12385284, '2024-06-20', 'Couleur bouton.PNG', '$2y$10$qhImcu0.WOvw7K.0Qd1wuuCuWTOxgbj6SWETlWYZcSInk.ln6t.2e', 'IFPLI-24-0022', 'afficher', '', '2024-06-20', '', '0000-00-00', 0, 1),
(23, '558552', 'fab25@gmail.com', 'fab25@gmail.com', 558552, '2024-06-20', 'colonneTailwind.PNG', '$2y$10$8wH78Yf31zhsmVJgSz8yAuSSyTkHtmPikTus1AH18hRJkuLYQQBYy', 'IFPLI-24-0023', 'afficher', '', '2024-06-20', '', '0000-00-00', 0, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified` (`modified`);

--
-- Index pour la table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pre_registrations`
--
ALTER TABLE `pre_registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified` (`modified`);

--
-- Index pour la table `pre_registration_trainings`
--
ALTER TABLE `pre_registration_trainings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pre_registration_id` (`pre_registration_id`),
  ADD KEY `training_id` (`training_id`);

--
-- Index pour la table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified` (`modified`);

--
-- Index pour la table `registration_trainings`
--
ALTER TABLE `registration_trainings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registration_id` (`registration_id`),
  ADD KEY `training_id` (`training_id`),
  ADD KEY `level_id` (`level_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified` (`modified`);

--
-- Index pour la table `training_levels`
--
ALTER TABLE `training_levels`
  ADD KEY `training_levels_ibfk_1` (`training_id`),
  ADD KEY `training_levels_ibfk_2` (`level_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modified` (`role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `pre_registrations`
--
ALTER TABLE `pre_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pre_registration_trainings`
--
ALTER TABLE `pre_registration_trainings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `registration_trainings`
--
ALTER TABLE `registration_trainings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`modified`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `pre_registrations`
--
ALTER TABLE `pre_registrations`
  ADD CONSTRAINT `pre_registrations_ibfk_1` FOREIGN KEY (`modified`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `pre_registration_trainings`
--
ALTER TABLE `pre_registration_trainings`
  ADD CONSTRAINT `pre_registration_trainings_ibfk_1` FOREIGN KEY (`pre_registration_id`) REFERENCES `pre_registrations` (`id`),
  ADD CONSTRAINT `pre_registration_trainings_ibfk_2` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`);

--
-- Contraintes pour la table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`modified`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `registration_trainings`
--
ALTER TABLE `registration_trainings`
  ADD CONSTRAINT `registration_trainings_ibfk_1` FOREIGN KEY (`registration_id`) REFERENCES `registrations` (`id`),
  ADD CONSTRAINT `registration_trainings_ibfk_2` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`),
  ADD CONSTRAINT `registration_trainings_ibfk_3` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`);

--
-- Contraintes pour la table `trainings`
--
ALTER TABLE `trainings`
  ADD CONSTRAINT `trainings_ibfk_1` FOREIGN KEY (`modified`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `training_levels`
--
ALTER TABLE `training_levels`
  ADD CONSTRAINT `training_levels_ibfk_1` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`),
  ADD CONSTRAINT `training_levels_ibfk_2` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
