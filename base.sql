-- Base de données pour SysInfo
-- Table des utilisateurs pour le système de login
DROP DATABASE IF EXISTS `note`;
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

CREATE TABLE Option (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255)
);

CREATE TABLE parcours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255),
    responsable VARCHAR(255)
);

CREATE TABLE matiere (
    id INT AUTO_INCREMENT PRIMARY KEY,
    num_matiere VARCHAR(50),
    id_option INT,
    id_parcours INT,
    nom VARCHAR(255),
    FOREIGN KEY (id_option) REFERENCES Option(id),
    FOREIGN KEY (id_parcours) REFERENCES parcours(id)
);

CREATE TABLE groupe (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255)
);

CREATE TABLE groupe_matiere (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_groupe INT,
    id_matiere INT,
    FOREIGN KEY (id_groupe) REFERENCES groupe(id),
    FOREIGN KEY (id_matiere) REFERENCES matiere(id)
);

CREATE TABLE credit (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_groupe_matiere INT,
    credits INT,
    FOREIGN KEY (id_groupe_matiere) REFERENCES groupe_matiere(id)
);

CREATE TABLE etudiant (
    id INT AUTO_INCREMENT PRIMARY KEY,
    num_matiere VARCHAR(50),
    nom VARCHAR(255),
    prenom VARCHAR(255),
    matricule VARCHAR(50),
    note FLOAT,
    result VARCHAR(50)
);

INSERT INTO Option (nom) VALUES ('Semestre 3');
INSERT INTO Option (nom) VALUES ('Semestre 4');

INSERT INTO parcours (nom, responsable) VALUES 
('Développement', 'Razafinjoelina Tahina'),
('Bases de Données et Réseaux', 'Rakotomalala Vahatriniaina'),
('Web et Design', 'Rabenanahary Rojo');

INSERT INTO matiere (num_matiere, id_option, id_parcours, nom) VALUES
('INF201', 1, NULL, 'Programmation orientée objet'),
('INF202', 1, NULL, 'Bases de données objets'),
('INF203', 1, NULL, 'Programmation système'),
('INF208', 1, NULL, 'Réseaux informatiques'),
('MTH201', 1, NULL, 'Méthodes numériques'),
('ORG201', 1, NULL, 'Bases de gestion');

INSERT INTO matiere (num_matiere, id_option, id_parcours, nom) VALUES
('INF204', 2, 1, 'Systeme d\'information géographique'),
('INF205', 2, 1, 'Systeme d\'information'),
('INF206', 2, 1, 'Interface Homme/Machine'),
('INF207', 2, 1, 'Elements d algorithmique'),
('INF210', 2, 1, 'Mini-projet de developpement'),
('MTH204', 2, 1, 'Geometrie'),
('MTH205', 2, 1, 'Equations differentielles'),
('MTH206', 2, 1, 'Optimisation'),
('MTH203', 2, 1, 'MAO');

INSERT INTO matiere (num_matiere, id_option, id_parcours, nom) VALUES
('INF205', 2, 2, 'Système d’information'),
('INF204', 2, 2, 'Système d’information géographique'),
('INF206', 2, 2, 'Interface Homme/Machine'),
('INF207', 2, 2, 'Éléments d’algorithmique'),
('INF211', 2, 2, 'Mini-projet de bases de données et/ou de réseaux'),
('MTH202', 2, 2, 'Analyse des données'),
('MTH205', 2, 2, 'Équations différentielles'),
('MTH206', 2, 2, 'Optimisation'),
('MTH203', 2, 2, 'MAO');

INSERT INTO matiere (num_matiere, id_option, id_parcours, nom) VALUES
('INF204', 2, 3, 'Système d’information géographique'),
('INF205', 2, 3, 'Système d’information'),
('INF206', 2, 3, 'Interface Homme/Machine'),
('INF209', 2, 3, 'Web dynamique'),
('INF212', 2, 3, 'Mini-projet de Web et design'),
('MTH202', 2, 3, 'Analyse des données'),
('MTH204', 2, 3, 'Géométrie'),
('MTH206', 2, 3, 'Optimisation'),
('MTH203', 2, 3, 'MAO');

INSERT INTO groupe (nom) VALUES
('groupe 1'),
('groupe 2'),
('groupe 3'),
('groupe 4'),
('groupe 5'),
('groupe 6'),
('groupe 7'),
('groupe 8'),
('groupe 9'),
('groupe 10'),
('groupe 11'),
('groupe 12'),
('groupe 13'),
('groupe 14'),
('groupe 15'),
('groupe 16'),
('groupe 17'),
('groupe 18'),
('groupe 19'),
('groupe 20'),
('groupe 21');

INSERT INTO groupe_matiere (id_groupe, id_matiere) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6);

INSERT INTO groupe_matiere (id_groupe, id_matiere) VALUES
(7, 7),
(7, 8),
(7, 9);

INSERT INTO groupe_matiere (id_groupe, id_matiere) VALUES
(8, 10),
(9, 11);

INSERT INTO groupe_matiere (id_groupe, id_matiere) VALUES
(10, 12),
(10, 13),
(10, 14);

INSERT INTO groupe_matiere (id_groupe, id_matiere) VALUES
(11, 15),
(12, 16);

INSERT INTO groupe_matiere (id_groupe, id_matiere) VALUES
(13, 17),
(13, 18),
(13, 19);

INSERT INTO groupe_matiere (id_groupe, id_matiere) VALUES
(14, 20);

INSERT INTO groupe_matiere (id_groupe, id_matiere) VALUES
(15, 21),
(15, 22),
(15, 23);

INSERT INTO groupe_matiere (id_groupe, id_matiere) VALUES
(16, 24);

INSERT INTO groupe_matiere (id_groupe, id_matiere) VALUES
(17, 25),
(17, 26),
(17, 27);

INSERT INTO groupe_matiere (id_groupe, id_matiere) VALUES
(18, 28),
(19, 29);

INSERT INTO groupe_matiere (id_groupe, id_matiere) VALUES
(20, 30),
(20, 31),
(20, 32);

INSERT INTO groupe_matiere (id_groupe, id_matiere) VALUES
(21, 33);

INSERT INTO credit (id_groupe_matiere, credits) VALUES
(1, 6),
(2, 6),
(3, 4),
(4, 6),
(5, 4),
(6, 4);

INSERT INTO credit (id_groupe_matiere, credits) VALUES
(7, 6),
(8, 6),
(9, 10),
(10, 4),
(11, 4);

INSERT INTO credit (id_groupe_matiere, credits) VALUES
(12, 6),
(13, 6),
(14, 10),
(15, 4),
(16, 4);

INSERT INTO credit (id_groupe_matiere, credits) VALUES
(17, 6),
(18, 6),
(19, 10),
(20, 4),
(21, 4);