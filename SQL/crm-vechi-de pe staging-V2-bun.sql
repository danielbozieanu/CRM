-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 17, 2017 at 03:48 PM
-- Server version: 5.5.50-MariaDB
-- PHP Version: 5.5.38

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
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`ans_id`, `ans_question`, `ans_value`, `ans_selected`) VALUES
(55, 83, 'Not at all satisfied', 0),
(56, 83, 'Slightly satisfied', 0),
(57, 83, 'Moderately satisfied', 0),
(58, 83, 'Very satisfied', 0),
(59, 83, 'Extremely satisfied', 0),
(60, 84, 'Poor', 0),
(61, 84, 'Fair', 0),
(62, 84, 'Good', 0),
(63, 84, 'Very good', 0),
(64, 84, 'Excellent', 0),
(65, 85, 'Eficiency', 0),
(66, 85, 'Quality of the work', 0),
(67, 85, 'Communication', 0),
(68, 85, 'Technical support', 0),
(69, 85, 'Proactivity', 0),
(70, 85, 'Neither one', 0),
(71, 86, 'Not at all satisfied', 0),
(72, 86, 'Slightly satisfied', 0),
(73, 86, 'Moderately satisfied', 0),
(74, 86, 'Very satisfied', 0),
(75, 86, 'Extremely satisfied', 0),
(76, 86, 'Definitely', 0),
(77, 87, 'No', 0),
(78, 87, 'Yes', 0),
(79, 88, 'Not at all satisfied', 0),
(80, 88, 'Slightly satisfied', 0),
(81, 88, 'Moderately satisfied', 0),
(82, 88, 'Very satisfied', 0),
(83, 88, 'Extremely satisfied', 0);

-- --------------------------------------------------------

--
-- Table structure for table `answers_project`
--

CREATE TABLE IF NOT EXISTS `answers_project` (
  `id` int(11) NOT NULL,
  `answer_question` int(11) NOT NULL,
  `answer_project` int(11) NOT NULL,
  `answer_value` varchar(255) NOT NULL,
  `answer_selected` int(11) NOT NULL,
  `feedback_text` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=320 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE IF NOT EXISTS `forms` (
  `form_id` int(11) NOT NULL,
  `form_name` text NOT NULL,
  `form_status` int(11) NOT NULL,
  `form_created` date NOT NULL,
  `form_sent_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`form_id`, `form_name`, `form_status`, `form_created`, `form_sent_date`) VALUES
(38, 'Form general', 0, '2017-02-17', '0000-00-00');

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
  `project_finished` date DEFAULT NULL,
  `form_template` int(11) DEFAULT NULL,
  `form_slug` varchar(255) DEFAULT NULL,
  `form_completed` int(11) DEFAULT NULL,
  `form_sent_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(11) NOT NULL,
  `question_label` text NOT NULL,
  `question_type` text NOT NULL,
  `question_form` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `question_label`, `question_type`, `question_form`) VALUES
(83, 'With regard to the following aspects, were you satisfied with the efficiency of the programmer?', 'radio', 38),
(84, 'With regard to the following aspects, how was the quality (number of bugs) of the code?', 'radio', 38),
(85, 'Which of the following aspects are important when you work with a programmer?', 'checkbox', 38),
(86, 'How satisfied were you regarding the communication with the programmer?', 'radio', 38),
(87, 'Would you want to work with the same programmer on other projects?', 'radio', 38),
(88, 'What is the overall impression?', 'radio', 38),
(89, 'Please share your own personal suggestions, observations, and/or critical remarks. If you think any important aspects have been omitted from this questionnaire, please state this as well.', 'textarea', 38);

-- --------------------------------------------------------

--
-- Table structure for table `questions_project`
--

CREATE TABLE IF NOT EXISTS `questions_project` (
  `id` int(11) NOT NULL,
  `question_project` int(11) NOT NULL,
  `question_label` varchar(255) NOT NULL,
  `question_type` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, '0H09M29kllsLSD336QXRL.', 1268889823, 1487338677, 1, 'Daniel', 'Bozieanu', 'ADMIN', '0743555586'),
(2, '127.0.0.1', 'administrator2', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'daniel.bozieanu@gmail.com', NULL, NULL, NULL, NULL, 1268889823, 1484419582, 1, 'Madalina', 'State', 'KINECTO', '0'),
(3, '127.0.0.1', 'gabi@sdasd.com', '$2y$08$v/M4EK0f1SHmXux2wv0HA.FaB6/VmWkW7ESLntHEirmfF8KSWK1EW', NULL, 'gabi@sdasd.com', NULL, NULL, NULL, NULL, 1484422110, 1486720884, 1, 'Gabriel', 'Cotovanu', 'Land of web', '0743555586'),
(4, '192.168.0.176', 'asd@asd.com', '$2y$08$dnYwQtOvUnOSYksyCq1/f.TWDKlNYGBCRjYoq5Cishu711P0.UOpS', NULL, 'asd@asd.com', NULL, NULL, NULL, NULL, 1486715046, NULL, 1, 'Stefan', 'Dragoi', 'LAND OF WEB', '743555586');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(72, 1, 1),
(98, 2, 2),
(100, 3, 5),
(101, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users_proiecte`
--

CREATE TABLE IF NOT EXISTS `users_proiecte` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_proiect` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

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
-- Indexes for table `answers_project`
--
ALTER TABLE `answers_project`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `answer_question` (`answer_question`),
  ADD KEY `answer_project` (`answer_project`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD UNIQUE KEY `form_id` (`form_id`);

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
  ADD UNIQUE KEY `project_id` (`project_id`),
  ADD KEY `form_template` (`form_template`),
  ADD KEY `form_template_2` (`form_template`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD UNIQUE KEY `question_id` (`question_id`),
  ADD KEY `question_form` (`question_form`);

--
-- Indexes for table `questions_project`
--
ALTER TABLE `questions_project`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `question_project` (`question_project`);

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
  MODIFY `ans_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT for table `answers_project`
--
ALTER TABLE `answers_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=320;
--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
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
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT for table `questions_project`
--
ALTER TABLE `questions_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `users_proiecte`
--
ALTER TABLE `users_proiecte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`ans_question`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `answers_project`
--
ALTER TABLE `answers_project`
  ADD CONSTRAINT `answers_project_ibfk_1` FOREIGN KEY (`answer_project`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `answers_project_ibfk_2` FOREIGN KEY (`answer_question`) REFERENCES `questions_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`form_template`) REFERENCES `forms` (`form_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`question_form`) REFERENCES `forms` (`form_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions_project`
--
ALTER TABLE `questions_project`
  ADD CONSTRAINT `questions_project_ibfk_1` FOREIGN KEY (`question_project`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
