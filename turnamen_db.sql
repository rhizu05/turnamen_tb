-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2025 at 06:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `turnamen_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `detail_img_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `name`, `slug`, `image_path`, `detail_img_path`) VALUES
(1, 'League of Legends', 'lol', 'lol.png', 'detail lol.jpg'),
(2, 'CS:GO', 'csgo', 'csgo.png', 'detail csgo.png'),
(3, 'Valorant', 'valorant', 'valo.png', 'detail valo.png'),
(4, 'PUBG', 'pubg', 'pubg.png', 'detail pubg.jpeg'),
(5, 'Mobile Legends', 'ml', 'mlbb.png', 'detail ml.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` int(11) NOT NULL,
  `tournament_id` int(11) DEFAULT NULL,
  `team1_id` int(11) DEFAULT NULL,
  `team2_id` int(11) DEFAULT NULL,
  `winner_id` int(11) DEFAULT NULL,
  `match_time` datetime DEFAULT NULL,
  `score_team1` int(11) DEFAULT NULL,
  `score_team2` int(11) DEFAULT NULL,
  `status` enum('scheduled','completed') DEFAULT 'scheduled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `tournament_id`, `team1_id`, `team2_id`, `winner_id`, `match_time`, `score_team1`, `score_team2`, `status`) VALUES
(1, 6, 16, 17, 17, '2025-06-16 10:33:04', 10, 15, 'completed'),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'scheduled');

-- --------------------------------------------------------

--
-- Table structure for table `organizers`
--

CREATE TABLE `organizers` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `org_name` varchar(100) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organizers`
--

INSERT INTO `organizers` (`id`, `firstName`, `lastName`, `org_name`, `country`, `email`, `password`, `phone`, `created_at`) VALUES
(1, 'jj', 'jj', 'jj', 'jj', 'xbracaalycia@gmail.com', '$2y$10$AfJqWZECTLCwBzm9kg5vUOH6rFEByfohfHcCYCFWx8YFr2yuQlhBW', '123456', '2025-06-04 18:10:11'),
(2, 'kayy', 'ila', 'apawe', 'indonesiaahh', '2306064@itg.ac.id', '$2y$10$2gw2HyR7z.R9FCzr.qu69e/O308piHWcWAwwyRt6/HFgZ.sOiAvda', '345678', '2025-06-05 01:19:01'),
(3, 'test', 'test', 'test', 'test', 'test@gmail.com', '$2y$10$DoGUPR4KvKukgPZyXt39nOTtrTplQ.do9goawvgrgAFUmAw1IqbDq', '098765432112', '2025-06-15 12:56:26'),
(4, 'Rasyid', 'Oktavian', 'Rasyid', 'Indonesia', 'rasyid@gmail.com', '$2y$10$yVeoVmikEm2RTMqnX5g1R.RsxTFWDFbOqKkqzvrdUQlaD9D3/ffdq', '081212312312', '2025-06-16 04:27:31');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nickname` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `username`, `email`, `password`, `nickname`, `created_at`) VALUES
(1, 'kai', '2306064@itg.ac.id', '$2y$10$PecC/zsv.Wz.ZeWXxJ4ZZ.5qP7jDX1tEBC2d48ryg20t9sZBR1NAa', '', '2025-06-05 05:21:08'),
(2, 'pndlghn', 'test_daftar@gmail.com', '$2y$10$ZUPPwE82n5Dd1umGkt48oeiNWAPTxdgaLiSJRZ1u/xt4K68AZStyq', 'pndlghn', '2025-06-15 13:00:16'),
(3, 'test1', 'test1@gmail.com', '$2y$10$6sqiiW6e.5FTQx3ZPY5j3uNKfm09ufhbgcY4O216CqDcSggVtNHPO', 'test1', '2025-06-15 16:31:22'),
(4, 'test2', 'test2@gmail.com', '$2y$10$z3J8L4fqIfZ/BRViaIh4p.PR.VM6m6f1KEa1Ubgzgbq5vW4oOCynW', 'test2', '2025-06-15 16:31:55'),
(5, 'test3', 'test3@gmail.com', '$2y$10$IucFdpvh4U66wheNVMz9qOqg5.KtTfo3R4hCO1pnC09NoF33dgKhy', 'test3', '2025-06-15 16:32:41'),
(6, 'test4', 'test4@gmail.com', '$2y$10$TA4GsSS.IErtnxcMEuPLkeEYbnfaRL5Q8nO5pJW5JIGIsl9eBOGQi', 'test4', '2025-06-16 03:31:13'),
(7, 'test5', 'test5@gmail.com', '$2y$10$wNbem2Gx6Ve8wZuvNl0nmumSdfcxz/EFZxceLoau.jfqn.yeB0mJe', 'test5', '2025-06-16 03:31:13'),
(8, 'test6', 'test6@gmail.com', '$2y$10$t7CT/jcnczRrVrOynyexnOOSm4XwaQ.UFpb2WiZnX02cXXJj8vSjm', 'test6', '2025-06-16 03:31:13'),
(9, 'test7', 'test7@gmail.com', '$2y$10$e1VyuTa2dHNLsXKdcno83ePPp5QzNNNK663aoE.ttnDSo3Q3fsiP2', 'test7', '2025-06-16 03:31:13'),
(10, 'test8', 'test8@gmail.com', '$2y$10$FfagJkzUnfvzDuFx9nUTTOY4AZ8Nr9djom46Uw3qKRi8WhBjPFaaO', 'test8', '2025-06-16 03:31:13'),
(11, 'testing1', 'testing1@gmail.com', '$2y$10$J0/LvbdpJUzEwe0TUZEjEeZqPwfDaqo2fyyMj.2AtjtHuWOt4WFZq', 'testing1', '2025-06-16 04:20:18'),
(12, 'testing2', 'testing2@gmail.com', '$2y$10$GIjSwnixEmLcpD5e/IdNNep3cjQrfESPLXAWA4wyl/YPc9oSxnOV.', 'testing2', '2025-06-16 04:20:49');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `tournament_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `tournament_id`, `created_by`, `created_at`) VALUES
(14, 'T1', 5, 1, '2025-06-15 16:34:56'),
(16, 'T1', 6, 1, '2025-06-16 03:08:12'),
(17, 'T2', 6, 1, '2025-06-16 03:32:49');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `team_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`team_id`, `player_id`) VALUES
(14, 1),
(14, 2),
(14, 3),
(14, 4),
(14, 5),
(16, 1),
(16, 2),
(16, 3),
(16, 4),
(16, 5),
(17, 6),
(17, 7),
(17, 8),
(17, 9),
(17, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tournaments`
--

CREATE TABLE `tournaments` (
  `id` int(11) NOT NULL,
  `game_id` int(11) DEFAULT NULL,
  `organizer_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `prize_pool` varchar(100) DEFAULT NULL,
  `max_teams` int(11) DEFAULT NULL,
  `registration_fee` decimal(10,2) DEFAULT NULL,
  `registration_deadline` datetime DEFAULT NULL,
  `allow_solo` tinyint(1) DEFAULT 0,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `status` enum('upcoming','ongoing','completed','cancelled') DEFAULT 'upcoming',
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tournaments`
--

INSERT INTO `tournaments` (`id`, `game_id`, `organizer_id`, `name`, `description`, `prize_pool`, `max_teams`, `registration_fee`, `registration_deadline`, `allow_solo`, `start_date`, `end_date`, `status`, `image_path`, `created_at`) VALUES
(5, 3, 3, 'Rookie Champions League', 'Gugu Gaga', '100000000', 2, 5000000.00, '2025-06-16 00:00:00', 0, '2025-06-17 00:00:00', '2025-06-30 00:00:00', 'upcoming', NULL, '2025-06-15 12:59:12'),
(6, 1, 3, 'League Of Legends Champions League', '-', '500000000', 2, 500000.00, '2025-06-16 00:00:00', 0, '2025-06-17 00:00:00', '2025-06-30 00:00:00', 'upcoming', NULL, '2025-06-15 13:28:43');

-- --------------------------------------------------------

--
-- Table structure for table `tournament_registrations`
--

CREATE TABLE `tournament_registrations` (
  `id` int(11) NOT NULL,
  `tournament_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tournament_registrations`
--

INSERT INTO `tournament_registrations` (`id`, `tournament_id`, `team_id`, `registered_at`, `status`) VALUES
(4, 5, 14, '2025-06-15 11:34:56', 'pending'),
(6, 6, 16, '2025-06-15 22:08:12', 'pending'),
(7, 6, 17, '2025-06-15 22:32:49', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tournament_id` (`tournament_id`),
  ADD KEY `team1_id` (`team1_id`),
  ADD KEY `team2_id` (`team2_id`),
  ADD KEY `winner_id` (`winner_id`);

--
-- Indexes for table `organizers`
--
ALTER TABLE `organizers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tournament_id` (`tournament_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`team_id`,`player_id`),
  ADD KEY `player_id` (`player_id`);

--
-- Indexes for table `tournaments`
--
ALTER TABLE `tournaments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `organizer_id` (`organizer_id`);

--
-- Indexes for table `tournament_registrations`
--
ALTER TABLE `tournament_registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tournament_id` (`tournament_id`),
  ADD KEY `team_id` (`team_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `organizers`
--
ALTER TABLE `organizers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tournaments`
--
ALTER TABLE `tournaments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tournament_registrations`
--
ALTER TABLE `tournament_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`),
  ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`team1_id`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `matches_ibfk_3` FOREIGN KEY (`team2_id`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `matches_ibfk_4` FOREIGN KEY (`winner_id`) REFERENCES `teams` (`id`);

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_ibfk_1` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`),
  ADD CONSTRAINT `teams_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `players` (`id`);

--
-- Constraints for table `team_members`
--
ALTER TABLE `team_members`
  ADD CONSTRAINT `team_members_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `team_members_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`);

--
-- Constraints for table `tournaments`
--
ALTER TABLE `tournaments`
  ADD CONSTRAINT `tournaments_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `tournaments_ibfk_2` FOREIGN KEY (`organizer_id`) REFERENCES `organizers` (`id`);

--
-- Constraints for table `tournament_registrations`
--
ALTER TABLE `tournament_registrations`
  ADD CONSTRAINT `tournament_registrations_ibfk_1` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`),
  ADD CONSTRAINT `tournament_registrations_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
