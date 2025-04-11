-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2025 at 10:12 PM
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
-- Database: `officedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `location` varchar(128) NOT NULL,
  `website` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `title`, `location`, `website`) VALUES
(1, 'Outdoors & Shoes', 'Boscofort', 'luettgen-hudson-and-hoeger.com/outdoors-shoes'),
(2, 'Toys', 'Jadonstad', 'luettgen-hudson-and-hoeger.com/toys'),
(3, 'Garden & Shoes', 'South Lisafurt', 'luettgen-hudson-and-hoeger.com/garden-shoes');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `ppsn` varchar(16) NOT NULL,
  `salary` decimal(8,2) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `ppsn`, `salary`, `department_id`) VALUES
(1, 'Lorna Fritsch', '4301048EX', 76591.99, 2),
(2, 'Sunny McLaughlin DDS', '5543516NF', 38553.26, 1),
(3, 'Joaquin Schroeder IV', '4824936PG', 98909.33, 1),
(4, 'Lilian Kessler', '8618242O', 97991.95, 1),
(5, 'Arnoldo Price PhD', '1759248K', 44286.75, 1),
(6, 'Serena Waelchi', '2190308FN', 68474.24, 3),
(7, 'Dr. Johan Friesen PhD', '7190283L', 41622.85, 2),
(8, 'Mr. Israel Crona', '1090813XV', 72977.53, 1),
(9, 'Ms. Roxanne Skiles III', '9324011T', 69835.03, 1),
(10, 'Lorenza Yost', '1235474TA', 73116.74, 2),
(11, 'Karson Kub', '0710953OJ', 59655.58, 3),
(12, 'Katrina Beahan', '6769645V', 54493.90, 3),
(13, 'Jovan Cormier', '5314474XQ', 43873.89, 3),
(14, 'Brigitte Pagac IV', '0527845WF', 88547.59, 1),
(15, 'Desiree Stiedemann', '3355311X', 45672.78, 3),
(16, 'Adalberto Hackett', '2932104OU', 27374.99, 1),
(17, 'Cordelia D\'Amore', '6880417R', 31360.79, 2),
(18, 'Prof. Kelli Schmeler', '7961458UN', 95832.65, 2),
(19, 'Ramon Denesik', '9219225R', 61087.98, 1),
(20, 'Chase Bauch', '9104976X', 60394.89, 3);

-- --------------------------------------------------------

--
-- Table structure for table `employee_project`
--

CREATE TABLE `employee_project` (
  `employee_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_project`
--

INSERT INTO `employee_project` (`employee_id`, `project_id`) VALUES
(1, 3),
(1, 6),
(2, 2),
(2, 10),
(3, 3),
(3, 5),
(3, 7),
(3, 9),
(3, 12),
(4, 2),
(5, 2),
(5, 4),
(5, 10),
(6, 7),
(7, 6),
(8, 3),
(8, 12),
(9, 3),
(9, 6),
(10, 1),
(10, 7),
(10, 8),
(10, 12),
(11, 2),
(11, 11),
(12, 2),
(12, 6),
(12, 8),
(12, 10),
(14, 3),
(14, 7),
(14, 9),
(14, 10),
(15, 11),
(15, 12),
(16, 4),
(16, 10),
(17, 7),
(18, 2),
(18, 4),
(18, 9),
(18, 11),
(19, 8),
(19, 11),
(20, 3),
(20, 5),
(20, 8);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `start_date`, `end_date`) VALUES
(1, 'Exclusive interactive opensystem', 'Odit ex iure possimus voluptatem. Aut dolore iste et dolorem expedita aut consequatur. Rerum praesentium corrupti ex maxime molestiae et.', '2025-01-09', '2025-06-28'),
(2, 'Customer-focused contextually-based contingency', 'Eum modi excepturi ullam voluptatem quo error. Ad itaque ratione vitae nemo quos itaque. Rerum sunt rem molestiae nam distinctio asperiores magnam consequatur.', '2024-12-05', '2025-03-24'),
(3, 'Diverse high-level hardware', 'Excepturi reiciendis tenetur deleniti sequi vel consequatur. Quasi temporibus occaecati quaerat a numquam. Quod necessitatibus incidunt ad quas et voluptatem.', '2024-05-02', '2025-07-08'),
(4, 'Expanded high-level approach', 'Alias similique aut quo quia pariatur. Corrupti omnis aperiam et sint dolorum.', '2024-11-26', '2025-09-27'),
(5, 'Versatile dynamic complexity', 'Id excepturi nemo corporis inventore qui. Qui consequatur explicabo rerum tenetur molestias. Error laboriosam rerum molestiae reprehenderit et et.', '2025-01-28', '2025-04-15'),
(6, 'Streamlined intangible collaboration', 'Laudantium atque omnis est magnam facere molestias. Quis et ipsum cupiditate aut ut.', '2024-03-02', '2025-05-24'),
(7, 'User-centric bandwidth-monitored localareanetwork', 'Fuga fugit nostrum autem molestiae qui sapiente quidem omnis. Sunt doloribus commodi aut nam voluptates eaque. Rerum est occaecati incidunt modi ut dolorem.', '2024-05-09', '2025-03-06'),
(8, 'Proactive global systemengine', 'Veritatis eum id sed ratione rerum itaque quae fugit. Quis ducimus ipsam veniam blanditiis illum porro laborum. Eveniet nihil aliquid corrupti sint culpa veniam.', '2024-10-27', '2025-11-09'),
(9, 'Polarised even-keeled model', 'Quae quasi eius dicta tempore odio. Nobis eum reiciendis asperiores et itaque vel omnis. Occaecati aliquam doloribus aut omnis.', '2024-08-20', '2025-07-09'),
(10, 'Customizable scalable migration', 'Deleniti aliquam minima et sunt iste. Rem expedita et et et blanditiis doloremque ut cumque.', '2024-03-20', '2025-02-14'),
(11, 'Organic multimedia hardware', 'Et ut et enim dolor repellat quae. Magnam dolorum dolores id aut fugiat. Autem velit molestiae aperiam.', '2024-06-04', '2025-08-04'),
(12, 'Reduced fresh-thinking knowledgeuser', 'Sit odio enim voluptas aperiam ut ut. Et et repellendus et rerum dolorum ea dolorum at.', '2024-09-29', '2025-06-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `employee_project`
--
ALTER TABLE `employee_project`
  ADD PRIMARY KEY (`employee_id`,`project_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `employee_project`
--
ALTER TABLE `employee_project`
  ADD CONSTRAINT `employee_project_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `employee_project_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
