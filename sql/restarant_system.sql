-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2021 at 01:04 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restarant_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `card_no` varchar(20) NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `card_no`, `member_id`) VALUES
(1, 'C001', 1);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `favorite_no` varchar(20) NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `favorite_details`
--

CREATE TABLE `favorite_details` (
  `id` int(11) NOT NULL,
  `favorite_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `id_member` varchar(13) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `status` enum('IN','NOTIN') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `id_member`, `first_name`, `last_name`, `status`) VALUES
(1, '1234567891011', 'ขจร', 'จัด', 'IN'),
(2, '1361201282239', '', 'gg', 'IN'),
(3, 'gg', '', 'gg', 'IN'),
(4, '1258463210248', 'gg', 'gg', 'IN'),
(5, '1245103584216', '', 'gg', 'IN'),
(6, '1024879652302', 'ซอฟต์แวร์', 'เอนจีเนีย', 'NOTIN');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `menu_image` varchar(200) NOT NULL,
  `menu_code` varchar(30) NOT NULL,
  `food_menu` varchar(100) NOT NULL,
  `food_type` enum('FULLMEALFASTFOOD','SNACKFASTFOOD','REFRESHMENTS') NOT NULL,
  `price` int(11) NOT NULL,
  `status` enum('ACTIVE','DISABLE') NOT NULL,
  `is_delete` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_image`, `menu_code`, `food_menu`, `food_type`, `price`, `status`, `is_delete`) VALUES
(1, 'berries-2277_640.jpg', 'M001', 'พิซซ่าหน้าแซลมอนรมควัน', 'FULLMEALFASTFOOD', 30, 'ACTIVE', 'Y'),
(2, 'pepsi-5152332_1920.jpg', 'M002', 'เป๊ปซี่ 200 ml.', 'REFRESHMENTS', 20, 'ACTIVE', 'N'),
(3, 'coca-cola-6090176_640.jpg', 'M003', 'โค้ก', 'REFRESHMENTS', 20, 'ACTIVE', 'N'),
(4, 'panipuri-74974_640.jpg', 'M003', 'นักเก็ต', 'FULLMEALFASTFOOD', 30, 'ACTIVE', 'N'),
(5, 'fried-chicken-690039_640.jpg', 'M005', 'ไก่ทอด', 'REFRESHMENTS', 40, 'ACTIVE', 'N'),
(6, 'abstract-1238657_640.jpg', 'ggg', 'gg', 'SNACKFASTFOOD', 20, 'ACTIVE', 'N'),
(7, 'churros-2188871_640.jpg', 'gg', 'ปิ้งไก่', 'SNACKFASTFOOD', 50, 'ACTIVE', 'N'),
(8, 'pizza-2000614_640.jpg', 'gg', 'gg', 'REFRESHMENTS', 52, 'ACTIVE', 'N'),
(9, 'bowl-1842294_640.jpg', '123', 'เฟรนฟาย', 'REFRESHMENTS', 29, 'ACTIVE', 'N'),
(10, 'fast-food-2132863_640.jpg', 'ggggg', 'gg', 'REFRESHMENTS', 0, 'ACTIVE', 'N'),
(11, 'berries-2277_640.jpg', 'gg', 'gg', 'REFRESHMENTS', 0, 'ACTIVE', 'N'),
(12, '', 'gg', 'gg', 'FULLMEALFASTFOOD', 50, 'ACTIVE', 'N'),
(13, '', 'gg', 'gg', 'REFRESHMENTS', 50, 'ACTIVE', 'N'),
(14, 'hamburger-1238246_640.jpg', 'M006', 'แฮมเบอร์เกอร์', 'REFRESHMENTS', 120, 'ACTIVE', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_no` varchar(20) NOT NULL,
  `visitor_id` int(11) NOT NULL,
  `total_pice` int(11) NOT NULL,
  `status` enum('TAKEORDER','DOING','SERVED','PAID','ORDER') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_no` varchar(20) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `deat_time_order` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_no`, `menu_id`, `deat_time_order`) VALUES
(1, 'O000', 1, '2021-09-08 02:10:28'),
(2, 'O001', 0, '2021-09-08 02:12:51');

-- --------------------------------------------------------

--
-- Table structure for table `qr_codes`
--

CREATE TABLE `qr_codes` (
  `id` int(11) NOT NULL,
  `qr_code_no` varchar(100) NOT NULL,
  `web_site` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qr_codes`
--

INSERT INTO `qr_codes` (`id`, `qr_code_no`, `web_site`) VALUES
(1, 'qr01', 'www'),
(2, 'qr02', 'www');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` int(11) NOT NULL,
  `receipt_no` varchar(100) NOT NULL,
  `visitor_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `create_at` date DEFAULT NULL,
  `status` enum('PAYED','NOTPAID') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `receipt_no`, `visitor_id`, `total_price`, `create_at`, `status`) VALUES
(1, 'R00000001', 1, 500, '2021-10-04', 'NOTPAID'),
(2, 'R00000002', 2, 230, '2021-10-01', 'NOTPAID'),
(3, 'R00000003', 3, 410, '2021-10-07', 'NOTPAID');

-- --------------------------------------------------------

--
-- Table structure for table `receipt_details`
--

CREATE TABLE `receipt_details` (
  `id` int(11) NOT NULL,
  `receipt_id` varchar(20) NOT NULL,
  `order_id` int(11) NOT NULL,
  `date_issue_receipt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receipt_details`
--

INSERT INTO `receipt_details` (`id`, `receipt_id`, `order_id`, `date_issue_receipt`) VALUES
(1, '1', 1, '2021-09-08 02:15:41'),
(2, '1', 2, '2021-09-08 02:15:41');

-- --------------------------------------------------------

--
-- Table structure for table `suggest`
--

CREATE TABLE `suggest` (
  `id` int(11) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `create_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `table_no` varchar(20) NOT NULL,
  `qr_code_id` int(11) NOT NULL,
  `status` enum('CHECKIN','CHECKOUT') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `table_no`, `qr_code_id`, `status`) VALUES
(1, 'T01', 1, 'CHECKOUT'),
(2, 'T02', 2, 'CHECKOUT');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `user_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `user_role_id`) VALUES
(1, 'admin', '$2y$10$AG.ltxsSn6jfR1wveS7jreu9eWIz.qou9sBjA3OLa3FWUnKKg/5Ta', 'ซอฟเเวร์', 'เอนจีเนีย', 1),
(2, 'table_1', '$2y$10$AG.ltxsSn6jfR1wveS7jreu9eWIz.qou9sBjA3OLa3FWUnKKg/5Ta', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `visitor_no` varchar(20) NOT NULL,
  `card_id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `number_of_people` int(11) NOT NULL,
  `status` enum('CHECKIN','ORDER','PAID','CHECKOUT') NOT NULL,
  `date_check_in` datetime NOT NULL,
  `date_check_out` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `visitor_no`, `card_id`, `table_id`, `number_of_people`, `status`, `date_check_in`, `date_check_out`) VALUES
(1, 'V001', 0, 1, 5, 'CHECKIN', '2021-09-08 02:04:55', '0000-00-00 00:00:00'),
(2, 'V002', 1, 2, 3, 'CHECKIN', '2021-09-08 02:09:15', '0000-00-00 00:00:00'),
(3, 'V00000000000', 0, 0, 4, 'CHECKIN', '2021-10-05 00:13:06', '0000-00-00 00:00:00'),
(4, 'V00000000000', 0, 2, 2, 'CHECKIN', '2021-10-05 00:16:57', '0000-00-00 00:00:00'),
(5, 'V00000000000', 0, 3, 6, 'CHECKIN', '2021-10-05 00:17:44', '0000-00-00 00:00:00'),
(6, '00000000006', 0, 2, 1, 'CHECKIN', '2021-10-05 00:18:52', '0000-00-00 00:00:00'),
(7, 'V00000000007', 0, 1, 3, 'CHECKIN', '2021-10-05 00:19:38', '0000-00-00 00:00:00'),
(8, 'V00000000008', 0, 1, 3, 'CHECKIN', '2021-10-05 00:57:46', '0000-00-00 00:00:00'),
(9, 'V00000000009', 0, 1, 2, 'CHECKIN', '2021-10-05 00:58:22', '0000-00-00 00:00:00'),
(10, 'V00000000010', 0, 1, 2, 'CHECKIN', '2021-10-05 00:59:05', '0000-00-00 00:00:00'),
(11, 'V00000000011', 0, 1, 2, 'CHECKIN', '2021-10-05 01:07:57', '0000-00-00 00:00:00'),
(12, 'V00000000012', 0, 1, 2, 'CHECKIN', '2021-10-05 01:10:20', '0000-00-00 00:00:00'),
(13, 'V00000000013', 0, 1, 2, 'CHECKIN', '2021-10-05 01:12:16', '0000-00-00 00:00:00'),
(14, 'V00000000014', 0, 1, 2, 'CHECKIN', '2021-10-05 01:27:28', '0000-00-00 00:00:00'),
(15, 'V00000000015', 0, 1, 1, 'CHECKIN', '2021-10-05 01:28:18', '0000-00-00 00:00:00'),
(16, 'V00000000016', 0, 3, 4, 'CHECKIN', '2021-10-05 01:29:54', '0000-00-00 00:00:00'),
(17, 'V00000000017', 0, 1, 2, 'CHECKIN', '2021-10-05 01:38:01', '0000-00-00 00:00:00'),
(18, 'V00000000018', 0, 1, 2, 'CHECKIN', '2021-10-05 01:38:51', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `card_no` (`card_no`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favorite_no` (`favorite_no`);

--
-- Indexes for table `favorite_details`
--
ALTER TABLE `favorite_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_number` (`id_member`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_code` (`menu_code`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_no` (`order_no`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_no` (`order_no`);

--
-- Indexes for table `qr_codes`
--
ALTER TABLE `qr_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receipt_no` (`receipt_no`);

--
-- Indexes for table `receipt_details`
--
ALTER TABLE `receipt_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_no` (`table_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_name` (`username`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorite_details`
--
ALTER TABLE `favorite_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `qr_codes`
--
ALTER TABLE `qr_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `receipt_details`
--
ALTER TABLE `receipt_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
