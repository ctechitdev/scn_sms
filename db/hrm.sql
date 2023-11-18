-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2023 at 12:07 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company`
--

CREATE TABLE `tbl_company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_company`
--

INSERT INTO `tbl_company` (`company_id`, `company_name`) VALUES
(1, 'ສົມໃຈນຶກກຣຸບ'),
(2, 'ຫວຍສົມໃຈນຶກ'),
(3, 'ສະຖາບັນຫານເງິນ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_depart`
--

CREATE TABLE `tbl_depart` (
  `depart_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `depart_name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_depart`
--

INSERT INTO `tbl_depart` (`depart_id`, `company_id`, `depart_name`) VALUES
(1, 1, 'ການເງິນ'),
(2, 2, 'ໄອທີ'),
(3, 3, 'ກກກ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_header_title`
--

CREATE TABLE `tbl_header_title` (
  `header_title_id` int(11) NOT NULL,
  `header_title_name` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_header_title`
--

INSERT INTO `tbl_header_title` (`header_title_id`, `header_title_name`) VALUES
(1, 'ລະບົບ'),
(2, 'ບຸກຄົນ'),
(3, 'ຄຳຂໍ'),
(4, 'ການເງິນ'),
(5, 'ແຈ້ງບັນຫາ'),
(6, 'ລາຍງານ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page_title`
--

CREATE TABLE `tbl_page_title` (
  `page_title_id` int(11) NOT NULL,
  `page_title_name` varchar(300) DEFAULT NULL,
  `page_title_file_name` varchar(100) DEFAULT NULL,
  `sub_header_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_page_title`
--

INSERT INTO `tbl_page_title` (`page_title_id`, `page_title_name`, `page_title_file_name`, `sub_header_id`) VALUES
(1, 'ພະແນກ', 'depart.php', 1),
(2, 'ໜ້າຟັງຊັ້ນ', 'page-function.php', 1),
(3, 'ສ້າງສິດ', 'roles.php', 1),
(4, 'ຜູ້ໃຊ້', 'user-staff.php', 1),
(5, 'ຈັດການສິດ', 'role-manage.php', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_position`
--

CREATE TABLE `tbl_position` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(150) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `depart_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`role_id`, `role_name`) VALUES
(1, 'ແອັດມີນລະບົບ'),
(2, 'ບັນຊີ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role_use_page`
--

CREATE TABLE `tbl_role_use_page` (
  `role_use_page_id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `header_title_id` int(11) DEFAULT NULL,
  `sub_header_id` int(11) DEFAULT NULL,
  `page_title_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_role_use_page`
--

INSERT INTO `tbl_role_use_page` (`role_use_page_id`, `role_id`, `header_title_id`, `sub_header_id`, `page_title_id`) VALUES
(7, 0, 1, 1, 1),
(8, 0, 1, 1, 2),
(9, 0, 1, 1, 3),
(11, 2, 1, 1, 3),
(17, 1, 1, 1, 1),
(18, 1, 1, 1, 2),
(19, 1, 1, 1, 3),
(20, 1, 1, 1, 4),
(21, 1, 1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_header`
--

CREATE TABLE `tbl_sub_header` (
  `sub_header_id` int(11) NOT NULL,
  `sub_header_name` varchar(300) DEFAULT NULL,
  `icon_code` varchar(100) DEFAULT NULL,
  `header_title_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sub_header`
--

INSERT INTO `tbl_sub_header` (`sub_header_id`, `sub_header_name`, `icon_code`, `header_title_id`) VALUES
(1, 'ຈັດການຂໍ້ມູນ', 'mdi-home-account', 1),
(2, 'ພະນັກງານ', 'mdi-palette-swatch', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(300) DEFAULT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  `user_password` varchar(30) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `depart_id` int(11) DEFAULT NULL,
  `user_status` int(11) DEFAULT NULL,
  `add_by` int(11) DEFAULT NULL,
  `date_add` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `full_name`, `user_name`, `user_password`, `role_id`, `company_id`, `depart_id`, `user_status`, `add_by`, `date_add`) VALUES
(1, 'superadmin', 'admin', '123', 1, 1, 1, 1, 1, '2023-10-26'),
(2, 'ffff', '123', '123', 1, NULL, 1, 1, 1, '2023-10-26'),
(3, 'ffff', 'fffff', '123', 1, 2, 2, 1, 1, '2023-10-26'),
(4, 'test', '123f', '123', 2, 1, 1, 1, 1, '2023-10-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_company`
--
ALTER TABLE `tbl_company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `tbl_depart`
--
ALTER TABLE `tbl_depart`
  ADD PRIMARY KEY (`depart_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `tbl_header_title`
--
ALTER TABLE `tbl_header_title`
  ADD PRIMARY KEY (`header_title_id`);

--
-- Indexes for table `tbl_page_title`
--
ALTER TABLE `tbl_page_title`
  ADD PRIMARY KEY (`page_title_id`);

--
-- Indexes for table `tbl_position`
--
ALTER TABLE `tbl_position`
  ADD PRIMARY KEY (`position_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `depart_id` (`depart_id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_role_use_page`
--
ALTER TABLE `tbl_role_use_page`
  ADD PRIMARY KEY (`role_use_page_id`),
  ADD KEY `page_title_id` (`page_title_id`);

--
-- Indexes for table `tbl_sub_header`
--
ALTER TABLE `tbl_sub_header`
  ADD PRIMARY KEY (`sub_header_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `depart_id` (`depart_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_company`
--
ALTER TABLE `tbl_company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_depart`
--
ALTER TABLE `tbl_depart`
  MODIFY `depart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_header_title`
--
ALTER TABLE `tbl_header_title`
  MODIFY `header_title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_page_title`
--
ALTER TABLE `tbl_page_title`
  MODIFY `page_title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_position`
--
ALTER TABLE `tbl_position`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_role_use_page`
--
ALTER TABLE `tbl_role_use_page`
  MODIFY `role_use_page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_sub_header`
--
ALTER TABLE `tbl_sub_header`
  MODIFY `sub_header_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_depart`
--
ALTER TABLE `tbl_depart`
  ADD CONSTRAINT `tbl_depart_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `tbl_company` (`company_id`);

--
-- Constraints for table `tbl_position`
--
ALTER TABLE `tbl_position`
  ADD CONSTRAINT `tbl_position_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `tbl_company` (`company_id`),
  ADD CONSTRAINT `tbl_position_ibfk_2` FOREIGN KEY (`depart_id`) REFERENCES `tbl_depart` (`depart_id`);

--
-- Constraints for table `tbl_role_use_page`
--
ALTER TABLE `tbl_role_use_page`
  ADD CONSTRAINT `tbl_role_use_page_ibfk_1` FOREIGN KEY (`page_title_id`) REFERENCES `tbl_page_title` (`page_title_id`);

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `tbl_company` (`company_id`),
  ADD CONSTRAINT `tbl_user_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `tbl_roles` (`role_id`),
  ADD CONSTRAINT `tbl_user_ibfk_3` FOREIGN KEY (`depart_id`) REFERENCES `tbl_depart` (`depart_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
