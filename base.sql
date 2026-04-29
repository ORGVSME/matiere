-- Base de données pour SysInfo
-- Table des utilisateurs pour le système de login

CREATE DATABASE IF NOT EXISTS `note` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `note`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(255) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertion de données de test
-- Mots de passe : admin123, user123
INSERT INTO `users` (`email`, `password`, `name`, `created_at`, `updated_at`) VALUES
('admin@sysinfo.mg', '$2y$10$lTMUY0oEuWPvl5knSrOfU.7o/G2.WnH.stF15bbrVQVnDXiYwlxoS', 'Administrateur', NOW(), NOW()),
('user@sysinfo.mg', '$2y$10$Z8FgnhxcB9MjYmIefFXGq.DZDzhBhnC1u.OX6jycPuPVmSOY.mvS.', 'Utilisateur', NOW(), NOW());
