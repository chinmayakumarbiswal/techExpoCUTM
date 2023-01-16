-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2023 at 08:13 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cutmtechexpo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admindata`
--

CREATE TABLE `admindata` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `campus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admindata`
--

INSERT INTO `admindata` (`id`, `email`, `campus`) VALUES
(1, 'chinmayakumarbiswal16045@gmail.com', 'BBSR'),
(2, 'situ@chinmayakumarbiswal.in', 'Bhubaneswar'),
(4, 'chinmayakumarbiswal45@gmail.com', 'Bhubaneswar');

-- --------------------------------------------------------

--
-- Table structure for table `field`
--

CREATE TABLE `field` (
  `id` int(11) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `nameOfField` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `field`
--

INSERT INTO `field` (`id`, `heading`, `nameOfField`) VALUES
(1, 'Foof Processing', 'Oil Extraction Tech'),
(2, 'Agricultural', 'Agricultural Extension'),
(3, 'IT', 'iOS Developer'),
(4, 'Management', 'B to B Marketing'),
(5, 'IT', 'Cloud Computing Specialist'),
(6, 'Others', 'FMCG Marketing'),
(8, 'Others', 'CNC operation');

-- --------------------------------------------------------

--
-- Table structure for table `registerdata`
--

CREATE TABLE `registerdata` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `regd` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no` varchar(255) NOT NULL,
  `campus` varchar(255) NOT NULL,
  `school` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `expertIn` varchar(255) NOT NULL,
  `tech` varchar(255) NOT NULL,
  `details` varchar(10000) NOT NULL,
  `workUpload` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registerdata`
--

INSERT INTO `registerdata` (`id`, `name`, `regd`, `email`, `no`, `campus`, `school`, `dept`, `expertIn`, `tech`, `details`, `workUpload`) VALUES
(1, 'Chinmaya Kumar Biswal', '234234', 'chinmayakumarbiswal45@gmail.com', '06370183009', 'Bhubaneswar', 'School of Applied Sciences', 'MCA', 'Cloud', '', '<p>Cloud</p>', 'D:xampp	mpphp2267.tmp'),
(2, 'Chinmaya Kumar Biswal', '09', '210720100009@cutm.ac.in', '6370183009', 'Bhubaneswar', 'School of Applied Sciences', 'MCA', 'Cloud', '', '<p>Cloud</p>', 'D:xampp	mpphpAF1.tmp'),
(3, 'Chinmaya Kumar Biswal', '09', 'chinmayakumarbiswal16045@gmail.com', '06370183009', 'Bhubaneswar', 'School of Applied Sciences', 'mca', 'cloud', '', '<p>&nbsp;cloud</p>', 'D:xampp	mpphp9638.tmp'),
(4, 'Chinmaya', '210720100009', '210720100009@cutm.ac.in', '06370183009', 'Bhubaneswar', 'School of Applied Sciences', 'MCA', 'IT', 'Cloud Computing Specialist', '<p>cloud</p>', 'D:xampp	mpphpB60F.tmp'),
(5, 'Chinmaya', '210720100009', '210720100009@cutm.ac.in', '06370183009', 'Bhubaneswar', 'School of Applied Sciences', 'MCA', 'IT', 'Cloud Computing Specialist', '', '13-01-2023-22-03skilledinOdisha.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int(11) NOT NULL,
  `school` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `school`, `dept`) VALUES
(1, 'School of Management', 'MBA'),
(2, 'School of Management', 'BBA'),
(3, 'School of Media and Communication', 'Media'),
(4, 'School of Applied Sciences', 'MCA'),
(5, 'School Of Paramedics & Allied Health Science', 'Radiology'),
(6, 'School of Applied Sciences', 'Physics'),
(7, 'School of Forensic Sciences', 'Digital Forensic '),
(8, 'School of Forensic Sciences', 'Forensic '),
(9, 'School of Applied Sciences', 'CTIS'),
(10, 'School of Applied Sciences', 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `studentdata`
--

CREATE TABLE `studentdata` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `regd` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `campus` varchar(255) NOT NULL,
  `school` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentdata`
--

INSERT INTO `studentdata` (`id`, `name`, `regd`, `email`, `campus`, `school`, `dept`) VALUES
(1, 'situ', '09', 'situ@chinmayakumarbiswal.in', 'BBSR', 'Applied Science', 'MCA'),
(2, 'Chinmaya', '210720100009', '210720100009@cutm.ac.in', 'BBSR', 'School of applied Science', 'MCA'),
(3, 'situ', '180704190006', 'situchinmaya@gmail.com', 'Bhubaneswar', 'School of Applied Science', 'CTIS'),
(4, 'situ', '21', 'chinmayakumarbiswal16045@gmail.com', 'Bhubaneswar', 'School of Applied Sciences', 'MCA'),
(5, 'chinmaya', '210720100009@cutm.ac.in', '210720100009', 'Applied Science', 'mca', 'mca'),
(6, 'chinmaya', '210720100009@cutm.ac.in', '210720100009', 'Applied Science', 'mca', 'mca'),
(7, 'chinmaya', '210720100009@cutm.ac.in', '210720100009', 'BBSR', 'Applied Science', 'mca');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admindata`
--
ALTER TABLE `admindata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `field`
--
ALTER TABLE `field`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registerdata`
--
ALTER TABLE `registerdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentdata`
--
ALTER TABLE `studentdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admindata`
--
ALTER TABLE `admindata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `field`
--
ALTER TABLE `field`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `registerdata`
--
ALTER TABLE `registerdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `studentdata`
--
ALTER TABLE `studentdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
