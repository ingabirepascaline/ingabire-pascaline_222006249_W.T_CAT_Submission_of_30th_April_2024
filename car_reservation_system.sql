-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 09:57 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_reservation_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `id` int(12) NOT NULL,
  `make` varchar(13) NOT NULL,
  `model` varchar(12) NOT NULL,
  `year` int(16) NOT NULL,
  `licence_plate_number` varchar(12) NOT NULL,
  `current_location` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`id`, `make`, `model`, `year`, `licence_plate_number`, `current_location`) VALUES
(1, 'uyiii', 'bnngd', 2025, '123FRT', 'huye'),
(2, 'toyota', 'los angels', 2034, 'ABC12', 'paris'),
(3, 'moto', 'collision', 2025, '123FRT', 'huye');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `address` varchar(20) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `driver_licence_number` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `address`, `email`, `phone_number`, `driver_licence_number`) VALUES
(2, 'lulu', 'rubavu', 'inga@8', '07893567888', 100),
(9, 'teta', 'rulindo', 'ish@2', '078935266', 123),
(9, 'teta', 'rulindo', 'ish@2', '078935266', 123),
(9, 'pierre', 'huye', 'ing@67', '078935677', 897),
(1, 'aime', 'nyamagabe', 'dian@1', '078356788', 123),
(5, 'fideline', 'byumba', 'mpundu@2', '07835466987', 345);

-- --------------------------------------------------------

--
-- Table structure for table `insurance`
--

CREATE TABLE `insurance` (
  `id` int(12) NOT NULL,
  `type` varchar(11) NOT NULL,
  `coverage_limit` int(12) NOT NULL,
  `price` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `insurance`
--

INSERT INTO `insurance` (`id`, `type`, `coverage_limit`, `price`) VALUES
(1, 'maima', 100, 9000),
(1, 'maima', 100, 9000),
(1, 'maima', 100, 9000),
(1, 'maima', 100, 9000),
(1, 'maima', 100, 9000),
(2, 'collision', 1200, 400);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(12) NOT NULL,
  `date` varchar(12) NOT NULL,
  `amount` int(12) NOT NULL,
  `payment_method` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `date`, `amount`, `payment_method`) VALUES
(3, '2020-01-03', 800, 'mobile mone'),
(5, '2020-01-06', 0, 'cash'),
(1, '2024-04-04', 1000, 'credit');

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `id` int(23) NOT NULL,
  `start_date` varchar(12) NOT NULL,
  `end_date` varchar(13) NOT NULL,
  `total_price` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rental`
--

INSERT INTO `rental` (`id`, `start_date`, `end_date`, `total_price`) VALUES
(3, '2020-09-03', '2021-07-93', 700),
(1, '2020-01-09', '2020-01-25', 856000),
(2, '2020-09-03', '2020-01-25', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(12) NOT NULL,
  `date` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `date`) VALUES
(6, '2020-01-03'),
(3, '2020-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(28) NOT NULL,
  `lastname` varchar(12) NOT NULL,
  `email` varchar(12) NOT NULL,
  `password` varchar(11) NOT NULL,
  `username` varchar(12) NOT NULL,
  `telephone` int(12) NOT NULL,
  `reservation_date` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `username`, `telephone`, `reservation_date`) VALUES
(63, 'ingabire', 'pascaline', 'ingabirepasc', 'ingabire@12', 'mytest', 784567898, '2024-04-08'),
(64, 'ingabire', 'pascaline', 'ingabirepasc', 'ingabire@12', 'mytest', 792266787, '2024-04-08'),
(65, 'ingabire', 'pascaline', 'ingabirepasc', 'ingabire@12', 'mytest', 791566778, '2024-04-16'),
(68, 'ingabire', 'paccy', 'ingabirepasc', 'mami', 'paccy', 791177597, '2024-05-01'),
(69, 'ingabire', 'paccy', 'ingabirepasc', 'mami', 'paccy', 791177597, '2024-05-01'),
(70, 'ingabire', 'pascaline', 'ingabirepasc', 'mama', 'paccy', 791177597, '2024-05-02'),
(71, 'ingabire', 'pascaline', 'ingabirepasc', 'mama', 'paccy', 791177597, '2024-04-26'),
(72, 'ingabire', 'pascaline', 'ingabirepasc', 'mama', 'paccy', 791177597, '2024-04-26'),
(73, 'ingabire', 'pascaline', 'ingabirepasc', 'mami', 'paccy', 2147483647, '2024-05-02'),
(74, 'uiyui', 'ghjj', 'ing@6', 'mama', 'paccy', 791177597, '2024-05-02'),
(75, 'nayiturik', 'louise', 'hu@23', 'koko', 'lulu', 791177597, '2024-04-26'),
(76, 'ishim', 'emm', 'ish@2', 'emi', 'man', 791177597, '2024-04-08'),
(77, 'gwiza ', 'anitha', 'gwiza@12', 'pendo', 'paccy', 2147483647, '2024-05-03'),
(78, 'sifa', 'ishimwe', 'ish@23', 'popo', 'sifa', 789642345, '2024-04-17'),
(79, 'ingabire', 'pascaline', 'ingabirepasc', 'ingabire4', 'eme', 789256677, '2024-04-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
