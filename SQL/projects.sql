-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 17 Feb 2017 la 14:49
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
  `project_finished` date DEFAULT NULL,
  `form_template` int(11) DEFAULT NULL,
  `form_slug` varchar(255) DEFAULT NULL,
  `reminder` int(11) DEFAULT NULL,
  `form_completed` int(11) DEFAULT NULL,
  `form_sent_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD UNIQUE KEY `project_id` (`project_id`),
  ADD KEY `form_template` (`form_template`),
  ADD KEY `form_template_2` (`form_template`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- Restrictii pentru tabele sterse
--

--
-- Restrictii pentru tabele `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`form_template`) REFERENCES `forms` (`form_id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
