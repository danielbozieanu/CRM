-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 13, 2017 at 10:24 AM
-- Server version: 5.5.50-MariaDB
-- PHP Version: 5.4.16

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
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `ans_id` int(11) NOT NULL,
  `ans_question` int(11) NOT NULL,
  `ans_value` text NOT NULL,
  `ans_selected` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`ans_id`, `ans_question`, `ans_value`, `ans_selected`) VALUES
(9, 3, 'Not at all satisfied', 0),
(10, 3, 'slightly satisfied ', 0),
(11, 3, 'moderately satisfied', 0),
(12, 3, 'Very satisfied', 0),
(13, 3, 'Extremely satisfied', 0),
(14, 4, 'Poor', 0),
(15, 4, 'Fair', 0),
(16, 4, 'Good', 0),
(17, 4, 'Very good ', 0),
(18, 4, 'Excellent', 0),
(19, 5, 'Eficiency', 0),
(20, 5, 'Quality of the work', 0),
(21, 5, 'Communication', 0),
(22, 5, 'Technical support', 0),
(23, 5, 'Proactivity', 0),
(24, 5, 'Neither one', 0),
(25, 6, 'Not at all satisfied', 0),
(26, 6, 'slightly satisfied', 0),
(27, 6, ' moderately satisfied', 0),
(28, 6, ' Very satisfied', 0),
(29, 6, 'Extremely satisfied', 0),
(30, 7, 'Definitely Not', 0),
(31, 7, 'Probably Not', 0),
(32, 7, 'Probably', 0),
(33, 7, 'Very Probably', 0),
(34, 7, 'Definitely', 0),
(35, 8, 'No', 0),
(36, 8, 'Yes', 0),
(37, 9, 'Not at all satisfied ', 0),
(38, 9, 'slightly satisfied ', 0),
(39, 9, 'moderately satisfied ', 0),
(40, 9, ' Very satisfied ', 0),
(41, 9, 'Extremely satisfied ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE IF NOT EXISTS `forms` (
  `form_id` int(11) NOT NULL,
  `form_name` text NOT NULL,
  `form_project` int(11) NOT NULL,
  `form_status` int(11) NOT NULL,
  `form_slug` text NOT NULL,
  `form_created` date NOT NULL,
  `form_sent_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`form_id`, `form_name`, `form_project`, `form_status`, `form_slug`, `form_created`, `form_sent_date`) VALUES
(3, 'Form general 1', 14, 0, 'yg6G8idrsweUZCQ4', '2017-02-12', '0000-00-00'),
(4, 'Form general 2', 14, 0, 'acRtX2okTrPgUAwG', '2017-02-12', '0000-00-00'),
(5, 'Form general 3', 14, 0, '7PwobM4IelTRBx2S', '2017-02-13', '0000-00-00'),
(6, 'Form general 4', 14, 0, 'B0lvI6U1jaqQ95Px', '2017-02-13', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'account', 'Account'),
(5, 'developers', 'Developer');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `project_id` int(11) NOT NULL,
  `project_name` text NOT NULL,
  `project_client` int(11) NOT NULL,
  `project_status` tinyint(1) NOT NULL,
  `project_estimate` int(11) DEFAULT NULL,
  `project_final_client` varchar(255) DEFAULT NULL,
  `project_value` int(11) DEFAULT NULL,
  `project_costs` int(11) DEFAULT NULL,
  `project_created` date DEFAULT NULL,
  `project_finished` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`, `project_client`, `project_status`, `project_estimate`, `project_final_client`, `project_value`, `project_costs`, `project_created`, `project_finished`) VALUES
(11, 'Proiectul cel nou', 2, -1, 15, 'Telekom', 50000, 54000, '2017-02-24', NULL),
(12, 'Telekom B2B', 2, 0, 25, 'Telekom2', 100, 35, '2017-02-14', NULL),
(13, 'Zambartazeala2', 2, 0, 2, 'ASDAS', 32, 65, '2017-02-25', NULL),
(14, 'Proiect IKEA Sustenabilitate', 2, 1, 123, 'Telekom', 123, 123, '2017-02-28', '2017-02-10');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(11) NOT NULL,
  `question_label` text NOT NULL,
  `question_type` text NOT NULL,
  `question_form` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `question_label`, `question_type`, `question_form`) VALUES
(3, 'With regard to the following aspects, were you satisfied with the efficiency of the programmer?', 'radio', 3),
(4, 'With regard to the following aspects, how was the quality (number of bugs) of the code?', 'radio', 3),
(5, 'Which of the following aspects are important when you work with a programmer?', 'checkbox', 4),
(6, 'How satisfied were you regarding the communication with the programmer?', 'radio', 5),
(7, 'Do you trust the programmer you''ve worked in order to recommend him to others ?', 'radio', 5),
(8, 'Would you want to work with the same programmer on other projects?', 'radio', 5),
(9, 'What is the overall impression?', 'radio', 6),
(10, 'Please share your own personal suggestions, observations, and/or critical remarks. If you think any important aspects have been omitted from this questionnaire, please state this as well.', 'textarea', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, '0H09M29kllsLSD336QXRL.', 1268889823, 1486973928, 1, 'Daniel', 'Bozieanu', 'ADMIN', '0743555586'),
(2, '127.0.0.1', 'administrator2', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'stefan@admin.com', 'dd2a708c95484c91548579331aba5820da123bbe', NULL, NULL, NULL, 1268889823, 1484419582, 0, 'Madalina', 'State', 'KINECTO', '0'),
(3, '127.0.0.1', 'gabi@sdasd.com', '$2y$08$v/M4EK0f1SHmXux2wv0HA.FaB6/VmWkW7ESLntHEirmfF8KSWK1EW', NULL, 'gabi@sdasd.com', NULL, NULL, NULL, NULL, 1484422110, 1486720884, 1, 'Client', 'Gabi', 'The Geeks', '0743555586'),
(4, '192.168.0.176', 'asd@asd.com', '$2y$08$dnYwQtOvUnOSYksyCq1/f.TWDKlNYGBCRjYoq5Cishu711P0.UOpS', NULL, 'asd@asd.com', NULL, NULL, NULL, NULL, 1486715046, NULL, 1, 'Gabri', 'El', 'LAND OF WEB', '743555586'),
(5, '92.85.150.44', 'asdfasd@asdasdsad.com', '$2y$08$ytNtydFsHXUpXrybU5Zgb.O06xSwwhFp9PI8EWS6nk5YEsBOVOpyC', NULL, 'asdfasd@asdasdsad.com', NULL, NULL, NULL, NULL, 1486723992, NULL, 1, 'asdsad', 'fasdfasdf', 'adssadsad', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(72, 1, 1),
(98, 2, 2),
(99, 3, 5),
(97, 4, 5),
(100, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users_proiecte`
--

CREATE TABLE IF NOT EXISTS `users_proiecte` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_proiect` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_proiecte`
--

INSERT INTO `users_proiecte` (`id`, `id_user`, `id_proiect`) VALUES
(8, 3, 11),
(9, 4, 12),
(10, 3, 13),
(11, 3, 14);

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
  MODIFY `ans_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `users_proiecte`
--
ALTER TABLE `users_proiecte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`ans_question`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`question_form`) REFERENCES `forms` (`form_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `users_proiecte`
--
ALTER TABLE `users_proiecte`
  ADD CONSTRAINT `users_proiecte_ibfk_1` FOREIGN KEY (`id_proiect`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
