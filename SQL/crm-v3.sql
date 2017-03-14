-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 11 Feb 2017 la 12:26
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
(34, 14, '0', 1),
(35, 14, '5', 0),
(36, 14, '10', 0),
(37, 15, 'Web Development', 0),
(38, 15, 'Mobile App', 0),
(39, 15, 'Design', 1),
(40, 18, 'Da', 1),
(41, 18, 'Nu', 0),
(42, 16, 'Ceva la 1', 1),
(43, 17, 'Altceva la 2', 1),
(44, 19, 'da', 1),
(45, 19, 'nu', 0),
(46, 21, 'design', 1),
(47, 21, 'web app', 1),
(48, 21, 'mobile', 1),
(49, 20, 'textul raspunsului', 1);

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
(6, 'Formular 1', 14, 0, '3LZuSDiNP1nYqGEv', '2017-02-10', '2017-02-10'),
(7, 'Formular x', 13, 0, 'E5A7CwJ4Yl63kbOG', '2017-02-10', '2017-02-10');

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
  `project_estimate` int(11) DEFAULT NULL,
  `project_final_client` varchar(255) DEFAULT NULL,
  `project_value` int(11) DEFAULT NULL,
  `project_costs` int(11) DEFAULT NULL,
  `project_created` date DEFAULT NULL,
  `project_finished` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`, `project_client`, `project_status`, `project_estimate`, `project_final_client`, `project_value`, `project_costs`, `project_created`, `project_finished`) VALUES
(11, 'Proiectul cel nou', 2, -1, 15, 'Telekom', 50000, 54000, '2017-02-24', NULL),
(12, 'Telekom B2B', 2, 1, 25, 'Telekom2', 100, 35, '2017-02-14', '2017-02-11'),
(13, 'Zambartazeala2', 2, 1, 25, 'ASDAS', 320, 650, '2017-02-25', '2017-02-11'),
(14, 'Proiect IKEA Sustenabilitate', 2, 1, 123, 'Telekom', 1232, 123, '2017-02-28', '2017-02-11');

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
(14, 'Intrebarea1', 'radio', 6),
(15, 'Intrebarea 2', 'checkbox', 6),
(16, 'Textarea 1', 'textarea', 6),
(17, 'Textarea 2', 'textarea', 6),
(18, 'Altceva??', 'radio', 6),
(19, 'Intrebarea 1', 'radio', 7),
(20, 'intreabrea 2', 'textarea', 7),
(21, 'intrebarea 3', 'checkbox', 7);

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
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, '0H09M29kllsLSD336QXRL.', 1268889823, 1486804872, 1, 'Daniel', 'Bozieanu', 'ADMIN', '0743555586'),
(2, '127.0.0.1', 'administrator2', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'stefan@admin.com', 'dd2a708c95484c91548579331aba5820da123bbe', NULL, NULL, NULL, 1268889823, 1484419582, 0, 'Madalina', 'State', 'KINECTO', '0'),
(3, '127.0.0.1', 'gabi@sdasd.com', '$2y$08$v/M4EK0f1SHmXux2wv0HA.FaB6/VmWkW7ESLntHEirmfF8KSWK1EW', NULL, 'gabi@sdasd.com', NULL, NULL, NULL, NULL, 1484422110, 1486720884, 1, 'Client', 'Gabi', 'The Geeks', '0743555586'),
(4, '192.168.0.176', 'asd@asd.com', '$2y$08$dnYwQtOvUnOSYksyCq1/f.TWDKlNYGBCRjYoq5Cishu711P0.UOpS', NULL, 'asd@asd.com', NULL, NULL, NULL, NULL, 1486715046, NULL, 1, 'Gabri', 'El', 'LAND OF WEB', '743555586');

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
(98, 2, 2),
(99, 3, 5),
(97, 4, 5);

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
  MODIFY `ans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `users_proiecte`
--
ALTER TABLE `users_proiecte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
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
