-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 03 Feb 2017 la 16:26
-- Versiune server: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `answers`
--

CREATE TABLE `answers` (
  `ans_id` int(11) NOT NULL,
  `ans_question` int(11) NOT NULL,
  `ans_value` text NOT NULL,
  `ans_selected` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `answers`
--

INSERT INTO `answers` (`ans_id`, `ans_question`, `ans_value`, `ans_selected`) VALUES
(3, 3, '0', 1),
(4, 3, '1', 0),
(5, 3, '2', 0),
(6, 3, '3', 0),
(7, 3, '4', 0),
(8, 3, '5', 0),
(9, 3, '6', 0),
(10, 3, '7', 0),
(11, 3, '8', 0),
(12, 3, '9', 0),
(13, 3, '10', 0),
(14, 4, 'Very satisfied', 0),
(15, 4, 'Somewhat satisfied', 1),
(16, 4, 'Neither satisfied nor dissatisfied', 0),
(17, 4, 'Somewhat dissatisfied', 0),
(18, 4, ' Very dissatisfied', 0),
(19, 5, 'Reliable', 0),
(20, 5, 'High quality', 1),
(21, 5, 'Useful', 0),
(22, 5, 'Unique', 1),
(23, 5, 'Good value for money', 1),
(24, 5, 'Overpriced', 0),
(25, 5, 'Impractical', 0),
(26, 5, 'Ineffective', 0),
(27, 5, 'Poor quality', 0),
(28, 5, 'Unreliable', 0),
(29, 6, 'Extremely well', 1),
(30, 6, 'Very well', 0),
(31, 6, 'Somewhat well', 0),
(32, 6, 'Not so well', 0),
(33, 6, 'Not at all well', 0),
(34, 7, 'Very high quality', 1),
(35, 7, 'High quality', 0),
(36, 7, 'Neither high nor low quality', 0),
(37, 7, 'Low quality', 0),
(38, 7, 'Very low quality', 0),
(39, 8, 'Extremely responsive', 1),
(40, 8, 'Very responsive', 0),
(41, 8, 'Somewhat responsive', 0),
(42, 8, 'Not so responsive', 0),
(43, 8, 'Not at all responsive', 0),
(44, 8, 'Not applicable', 0),
(45, 9, 'This is my first purchase', 1),
(46, 9, 'Less than six months', 0),
(47, 9, 'Six months to a year', 0),
(48, 9, '1 - 2 years', 0),
(49, 9, '3 or more years', 0),
(50, 9, 'I haven''t made a purchase yet', 0),
(51, 10, 'Extremely likely', 1),
(52, 10, 'Very likely', 0),
(53, 10, 'Somewhat likely', 0),
(54, 10, 'Not so likely', 0),
(55, 10, 'Not at all likely', 0);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `clienti`
--

CREATE TABLE `clienti` (
  `id_client` int(11) NOT NULL,
  `nume_client` varchar(50) NOT NULL,
  `email_client` varchar(50) NOT NULL,
  `tel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `clienti`
--

INSERT INTO `clienti` (`id_client`, `nume_client`, `email_client`, `tel`) VALUES
(2, 'KINEKTO', 'daniel.bozieanu@gmail.com', '0743555586'),
(5, 'Baba Razvan SRL', 'daniel.bozieanu@gmail.com', '0745555555'),
(6, 'SMKR SRL', 'daniel.bozieanu@gmail.com', '0743555586');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `forms`
--

CREATE TABLE `forms` (
  `form_id` int(11) NOT NULL,
  `form_name` text NOT NULL,
  `form_project` int(11) NOT NULL,
  `form_status` int(11) NOT NULL,
  `form_slug` text NOT NULL,
  `form_created` date NOT NULL,
  `form_sent_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `forms`
--

INSERT INTO `forms` (`form_id`, `form_name`, `form_project`, `form_status`, `form_slug`, `form_created`, `form_sent_date`) VALUES
(95, 'Feedback 1', 36, 1, 'XGpqfmarsRSu8wOT', '2017-02-03', '2017-02-03');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Salvarea datelor din tabel `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'account', 'Account'),
(5, 'developers', 'Developer');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `project_name` text NOT NULL,
  `project_client` int(11) NOT NULL,
  `project_status` tinyint(1) NOT NULL,
  `project_created` date NOT NULL,
  `project_finished` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`, `project_client`, `project_status`, `project_created`, `project_finished`) VALUES
(36, 'Telekom B2B', 2, 1, '2017-02-03', '0000-00-00'),
(37, 'Alt proiect', 3, 0, '2017-02-03', '0000-00-00');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `question_label` text NOT NULL,
  `question_type` text NOT NULL,
  `question_form` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `questions`
--

INSERT INTO `questions` (`question_id`, `question_label`, `question_type`, `question_form`) VALUES
(3, 'How likely is it that you would recommend this company to a friend or colleague?', 'radio', 95),
(4, 'Overall, how satisfied or dissatisfied are you with our company?', 'radio', 95),
(5, 'Which of the following words would you use to describe our products? Select all that apply.', 'checkbox', 95),
(6, 'How well do our products meet your needs?', 'radio', 95),
(7, 'How would you rate the quality of the product?', 'radio', 95),
(8, 'How responsive have we been to your questions or concerns about our products? ', 'radio', 95),
(9, 'How long have you been a customer of our company? ', 'radio', 95),
(10, 'How likely are you to purchase any of our products again?', 'radio', 95);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Salvarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, '0H09M29kllsLSD336QXRL.', 1268889823, 1486134429, 1, 'Daniel', 'Bozieanu', 'ADMIN', '0743555586'),
(2, '127.0.0.1', 'administrator2', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'stefan@admin.com', 'dd2a708c95484c91548579331aba5820da123bbe', NULL, NULL, NULL, 1268889823, 1484419582, 0, 'KINECTO', 'Dipol', 'KINECTO', '0'),
(3, '127.0.0.1', 'gabi@sdasd.com', '$2y$08$3ALwfs4NeIJ4pE6CaJk1Eeqdq7jsa5E6I1QlAx3rwpJRmtwhainOS', NULL, 'gabi@sdasd.com', NULL, NULL, NULL, NULL, 1484422110, 1484564461, 1, 'TheGeeks', 'Gabi', 'The Geeks', '0743555586'),
(4, '127.0.0.1', 'daniel.bozieanu@gmail.com', '$2y$08$WHkrAbkhmBU52pmXI5GbRuOIqyF1osySdszN2xM7yE9/N8RcW/s0K', NULL, 'daniel.bozieanu@gmail.com', NULL, NULL, NULL, NULL, 1484582188, 1485945277, 1, 'Telekom', 'Cotovanu', 'Telekom', '0743555586'),
(5, '127.0.0.1', 'radu@radu.ro', '$2y$08$v4ybtSJnUOGROgbguzMTPu3V1aJVAiRcQpyS4GyeC2/yvs0sfOYJy', NULL, 'radu@radu.ro', NULL, NULL, NULL, NULL, 1484582293, 1484667314, 1, 'Gabi', 'Bozieanu', 'dfssdfsdf', '0743555586'),
(6, '192.168.0.176', 'gabriel.cotovanu@landofweb.ro', '$2y$08$qnUgvHedJaBtTkAPc/Fe7e1UOr/epV3IMvEuWIpr/.lRnn.bAyMWe', NULL, 'gabriel.cotovanu@landofweb.ro', NULL, NULL, NULL, NULL, 1486125952, NULL, 1, 'Gabriel', 'Cotovanu', 'LAND OF WEB', '0743555586');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Salvarea datelor din tabel `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(72, 1, 1),
(73, 2, 2),
(74, 3, 2),
(66, 4, 5),
(58, 5, 5),
(75, 6, 2);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users_proiecte`
--

CREATE TABLE `users_proiecte` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_proiect` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `users_proiecte`
--

INSERT INTO `users_proiecte` (`id`, `id_user`, `id_proiect`) VALUES
(3, 4, 36),
(4, 5, 36),
(5, 4, 37),
(6, 5, 37);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD UNIQUE KEY `ans_id` (`ans_id`),
  ADD KEY `ans_question` (`ans_question`);

--
-- Indexes for table `clienti`
--
ALTER TABLE `clienti`
  ADD UNIQUE KEY `id` (`id_client`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD UNIQUE KEY `form_id` (`form_id`),
  ADD KEY `form_project` (`form_project`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD UNIQUE KEY `project_id` (`project_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD UNIQUE KEY `question_id` (`question_id`),
  ADD KEY `question_form` (`question_form`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `users_proiecte`
--
ALTER TABLE `users_proiecte`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_proiect` (`id_proiect`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `ans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `clienti`
--
ALTER TABLE `clienti`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `users_proiecte`
--
ALTER TABLE `users_proiecte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Restrictii pentru tabele sterse
--

--
-- Restrictii pentru tabele `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`ans_question`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrictii pentru tabele `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`question_form`) REFERENCES `forms` (`form_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrictii pentru tabele `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Restrictii pentru tabele `users_proiecte`
--
ALTER TABLE `users_proiecte`
  ADD CONSTRAINT `users_proiecte_ibfk_1` FOREIGN KEY (`id_proiect`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
