-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 18, 2023 at 04:51 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `film`
--

-- --------------------------------------------------------

--
-- Table structure for table `acteur`
--

CREATE TABLE `acteur` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acteur`
--

INSERT INTO `acteur` (`id`, `nom`, `prenom`) VALUES
(1, 'Cruise', 'Tom'),
(2, 'Foster', 'Jodie'),
(3, 'Irvine', 'Jeremy'),
(10, 'Chaplin', 'Charlie');

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `titre` varchar(300) NOT NULL,
  `anneeProduction` smallint(6) NOT NULL,
  `synopsis` varchar(500) NOT NULL,
  `duree` smallint(6) NOT NULL,
  `nomImage` varchar(100) NOT NULL,
  `genre_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`id`, `titre`, `anneeProduction`, `synopsis`, `duree`, `nomImage`, `genre_id`) VALUES
(1, 'The BFG', 1998, 'The BFG is no ordinary bone-crunching giant. He is far too nice and jumbly. It’s lucky for Sophie that he is. Had she been carried off in the middle of the night by the Bloodbottler, or any of the other giants—rather than the BFG—she would have soon become breakfast. When Sophie hears that the giants are flush-bunking off to England to swollomp a few nice little chiddlers, she decides she must stop them once and for all. And the BFG is going to help her!', 117, 'the-bfg.jpeg', 3),
(2, 'War Horse', 2010, 'Follows a young man named Albert and his horse, Joey, and how their bond is broken when Joey is sold to the cavalry and sent to the trenches of World War One. Despite being too young to enlist, Albert heads to France to save his friend.', 146, 'war-hourse.jpeg', 2),
(3, 'A.I. Artificial Intelligence', 1995, 'David, a robotic boy—the first of his kind programmed to love—is adopted as a test case by a Cybertronics employee and his wife. Though he gradually becomes their child, a series of unexpected circumstances make this life impossible for David. Without final acceptance by humans or machines, David embarks on a journey to discover where he truly belongs, uncovering a world in which the line between robot and machine is both vast and profoundly thin.', 132, 'artificial-intelligence.jpeg', 1),
(4, 'Contact', 1994, 'Contact is a science fiction film about an encounter with alien intelligence. Based on the novel by Carl Sagan the film starred Jodie Foster as the one chosen scientist who must make some difficult decisions between her beliefs, the truth, and reality.', 150, 'contact.jpeg', 1),
(5, 'Modern Times', 1936, 'The Tramp struggles to live in modern industrial society with the help of a young homeless woman.', 87, 'mordern-times.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` tinyint(4) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `nom`) VALUES
(1, 'Science-fiction'),
(2, 'Aventure'),
(3, 'Policier');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `ip` varchar(200) DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `url` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `nom`, `ip`, `date`, `url`) VALUES
(1, 'admin@gmail.com', '::1', '2023-11-17 14:56:10', '/prog-web-avance2-tp3/log'),
(2, 'admin@gmail.com', '::1', '2023-11-17 14:56:13', '/prog-web-avance2-tp3/film'),
(3, 'admin@gmail.com', '::1', '2023-11-17 14:56:14', '/prog-web-avance2-tp3/log');

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE `privilege` (
  `id` int(11) NOT NULL,
  `privilege` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`id`, `privilege`) VALUES
(1, 'Admin'),
(2, 'Usager');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `acteur_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `nom`, `prenom`, `acteur_id`, `film_id`) VALUES
(1, 'Bottler', 'Blood', 1, 1),
(2, 'Narracot', 'Albert', 1, 2),
(3, 'Swington', 'Monica', 2, 3),
(4, 'Tramp', 'the Little', 10, 5),
(5, 'Arroway', 'Dr. Ellie', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(225) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `privilege_id`, `role_id`) VALUES
(2, 'admin@gmail.com', '$2y$10$MFTjiDrMhmicHTodc0nTmunV9.ISsiWbB9SWK7XPq9SeuM78Fa8Ym', 1, NULL),
(6, 'user2@gmail.com', '$2y$10$g0O5byIulASPT4G1cI.K0exbxJvK1MpAtJOZDedUZQBoYb4t3ZjhS', 2, 1),
(7, 'user3@gmail.com', '$2y$10$yWpAFgl/PXx64C3X/vBLGeD/.nWGAeQw6r6EhgVrzjc3YR3EVl2xS', 2, 2),
(8, 'user4@gmail.com', '$2y$10$pbLS9sqR9auMIdRFVBZT/.Lt0zqRJueSlBNTwnOLmME/j5JJFVoOK', 2, 1),
(14, 'user5@gmail.com', '$2y$10$hkbEdp7iq.ehwFEp.K0/8OVH.0b46WXfOdOqMaAjQL8iXCtWzlCLm', 2, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acteur`
--
ALTER TABLE `acteur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_film_genre1_idx` (`genre_id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `privilege_UNIQUE` (`privilege`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_film_has_Acteur_Acteur1_idx` (`acteur_id`),
  ADD KEY `fk_film_has_Acteur_film_idx` (`film_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD KEY `fk_user_privilege1_idx` (`privilege_id`),
  ADD KEY `fk_user_role1_idx` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acteur`
--
ALTER TABLE `acteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `fk_film_genre1` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `fk_film_has_Acteur_Acteur1` FOREIGN KEY (`acteur_id`) REFERENCES `acteur` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_film_has_Acteur_film` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_privilege1` FOREIGN KEY (`privilege_id`) REFERENCES `privilege` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
