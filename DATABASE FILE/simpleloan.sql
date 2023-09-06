-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2023 at 04:42 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpleloan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `user`, `pass`) VALUES
(1, 'admin@mail.com', '6812f136d636e737248d365016f8cfd5139e387c');

-- --------------------------------------------------------

--
-- Table structure for table `cash_collection_2020`
--

CREATE TABLE `cash_collection_2020` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `or_num` int(11) DEFAULT NULL,
  `charged_colln` float DEFAULT NULL,
  `charged_total` float DEFAULT NULL,
  `d_sales_for` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `overage` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `c_total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_collection_2020`
--

INSERT INTO `cash_collection_2020` (`id`, `date`, `or_num`, `charged_colln`, `charged_total`, `d_sales_for`, `amount`, `overage`, `total`, `c_total`) VALUES
(1, '2023-09-02', 321313, 0, 0, 0, 0, 0, 0, 0),
(2, '2023-09-03', 54355, 0, 0, 0, 0, 0, 0, 0),
(3, '2023-09-06', 321123313, 31431, 3213, 321321, 32131, 321421, 32131, 32313),
(4, '2023-09-06', 312141, 3211230000, 32113, 3213420, 3213420, 323421, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jenny_fernandez`
--

CREATE TABLE `jenny_fernandez` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `loan_amount` float DEFAULT NULL,
  `payment_amount` float DEFAULT NULL,
  `or_num` int(11) DEFAULT NULL,
  `or_date` date DEFAULT NULL,
  `amount_balance` float DEFAULT NULL,
  `loan_balance` float DEFAULT NULL,
  `sc_starts` varchar(255) DEFAULT NULL,
  `four_percent` float DEFAULT NULL,
  `sc_dates` varchar(255) DEFAULT NULL,
  `months` int(11) DEFAULT NULL,
  `four_percent_sc` float DEFAULT NULL,
  `sc_payments` float DEFAULT NULL,
  `sc_payments_or_num` int(11) DEFAULT NULL,
  `sc_payments_date` date DEFAULT NULL,
  `sc_balance` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenny_fernandez`
--

INSERT INTO `jenny_fernandez` (`id`, `date`, `loan_amount`, `payment_amount`, `or_num`, `or_date`, `amount_balance`, `loan_balance`, `sc_starts`, `four_percent`, `sc_dates`, `months`, `four_percent_sc`, `sc_payments`, `sc_payments_or_num`, `sc_payments_date`, `sc_balance`) VALUES
(2, '2023-09-02', 2100, 100, 21314, '2023-09-02', 2000, 0, '', 84, '', 0, 0, 0, 0, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lilibeth_cruz`
--

CREATE TABLE `lilibeth_cruz` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `loan_amount` float DEFAULT NULL,
  `payment_amount` float DEFAULT NULL,
  `or_num` int(11) DEFAULT NULL,
  `or_date` date DEFAULT NULL,
  `amount_balance` float DEFAULT NULL,
  `loan_balance` float DEFAULT NULL,
  `sc_starts` varchar(255) DEFAULT NULL,
  `four_percent` float DEFAULT NULL,
  `sc_dates` varchar(255) DEFAULT NULL,
  `months` int(11) DEFAULT NULL,
  `four_percent_sc` float DEFAULT NULL,
  `sc_payments` float DEFAULT NULL,
  `sc_payments_or_num` int(11) DEFAULT NULL,
  `sc_payments_date` date DEFAULT NULL,
  `sc_balance` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `loan_id` int(11) NOT NULL,
  `group_id` varchar(50) NOT NULL,
  `loan_come_from` varchar(50) NOT NULL,
  `loan_amount` varchar(50) NOT NULL,
  `loan_interest` varchar(10) NOT NULL,
  `payment_term` varchar(50) NOT NULL,
  `total_payment_with_intereset` varchar(50) NOT NULL,
  `emi_per_month` varchar(50) NOT NULL,
  `payment_schedule` date NOT NULL,
  `due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`loan_id`, `group_id`, `loan_come_from`, `loan_amount`, `loan_interest`, `payment_term`, `total_payment_with_intereset`, `emi_per_month`, `payment_schedule`, `due_date`) VALUES
(6, '5', 'Government', '485000', '10', '7', '824500', '9815.47619047619', '2022-08-27', '2022-09-26'),
(7, '7', 'Public and Private Banks', '250000', '10', '3', '325000', '9027.777777777777', '2022-08-27', '2025-12-11'),
(8, '10', 'Public and Private Banks', '110000', '10', '5', '165000', '2750', '2022-08-27', '2027-07-25');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `name` char(50) NOT NULL,
  `unp-gl` float DEFAULT NULL,
  `c-gl` float DEFAULT NULL,
  `s/c` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `or#` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `name`, `unp-gl`, `c-gl`, `s/c`, `amount`, `or#`, `date`, `remarks`) VALUES
(77, 'Jenny Fernandez', 1000, 0, 0, 0, 2147483647, '2023-09-21', '0'),
(80, 'Lilibeth Cruz', 236000, 40000, 20000, 23456, 56756754, '2023-09-06', '0');

-- --------------------------------------------------------

--
-- Table structure for table `sales_collection_summary`
--

CREATE TABLE `sales_collection_summary` (
  `id` int(11) NOT NULL,
  `table_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_collection_summary`
--

INSERT INTO `sales_collection_summary` (`id`, `table_name`) VALUES
(3, 'Cash Collection 2020'),
(4, 'sample table');

-- --------------------------------------------------------

--
-- Table structure for table `sample_table`
--

CREATE TABLE `sample_table` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `or_num` int(11) DEFAULT NULL,
  `charged_colln` float DEFAULT NULL,
  `charged_total` float DEFAULT NULL,
  `d_sales_for` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `overage` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `c_total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cash_collection_2020`
--
ALTER TABLE `cash_collection_2020`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenny_fernandez`
--
ALTER TABLE `jenny_fernandez`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lilibeth_cruz`
--
ALTER TABLE `lilibeth_cruz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`loan_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `sales_collection_summary`
--
ALTER TABLE `sales_collection_summary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sample_table`
--
ALTER TABLE `sample_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cash_collection_2020`
--
ALTER TABLE `cash_collection_2020`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jenny_fernandez`
--
ALTER TABLE `jenny_fernandez`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `lilibeth_cruz`
--
ALTER TABLE `lilibeth_cruz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `sales_collection_summary`
--
ALTER TABLE `sales_collection_summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sample_table`
--
ALTER TABLE `sample_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
