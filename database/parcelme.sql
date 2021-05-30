-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 30, 2021 at 12:03 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `parcelme`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  `admin_password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`) VALUES
(1, 'kafle.safal@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_details`
--

CREATE TABLE `delivery_details` (
  `delivery_details_id` int(11) NOT NULL,
  `delivery_email` varchar(200) NOT NULL,
  `receiver_name` varchar(100) NOT NULL,
  `delivery_country` varchar(200) NOT NULL,
  `delivery_province` varchar(100) NOT NULL,
  `delivery_district` varchar(100) NOT NULL,
  `delivery_zone` varchar(100) NOT NULL,
  `delivery_address` varchar(100) NOT NULL,
  `delivery_phone` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `delivery_details`
--

INSERT INTO `delivery_details` (`delivery_details_id`, `delivery_email`, `receiver_name`, `delivery_country`, `delivery_province`, `delivery_district`, `delivery_zone`, `delivery_address`, `delivery_phone`) VALUES
(2, 'ankitshah2057@gmail.com', 'ankit shah', 'nepal', '3', 'lalitpur', '0', 'shantina', '9842779721'),
(3, 'dfgvhbjn', 'sigh	dfgh', 'dxcffcg', 'dxcfvgbh', 'fcvgbhn', '0', 'fdcgvhbnj', 'dfcgvhbj'),
(4, 'kafle.safal@gmail.com', 'Ankit Shah', 'Nepal', 'Bagmati	', 'Lalitpur', '0', 'Gwarko', '9842779721'),
(5, 'man@gmail.com', 'manish', 'nepal', '3', 'kathmandu', '0', 'suryabinayak', '9841437276'),
(6, 'safal@gmail.com', 'safal', 'nepal', '3', 'kathmandu', '0', 'thimi', '9860905133'),
(7, 'sandhyakoirala@gmail.com', 'Sandhya Koirala', 'nepal', 'Bagmati', 'Kathmandu', '0', 'Kapan', '9860905789'),
(8, 'subina@gmail.com', 'Sunnis sharma', 'nepal', '3', 'Kathmandu', '0', 'baneshwor', '9851044817'),
(9, 'manish@gmail.com', 'Manish Gautam', 'Nepal', 'Bagmati', 'Bhaktapur', '0', 'suryabinyak-04', '9856453433'),
(10, 'satish09@gmail.com', 'Stish Devkota', 'Nepal', 'Bagmati', 'Bhaktapur', '0', 'Suryabinayak', '9841438485');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `users_id` int(11) NOT NULL,
  `delivery_details_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`users_id`, `delivery_details_id`) VALUES
(4, 2),
(4, 3),
(5, 4),
(5, 5),
(6, 6),
(5, 7),
(7, 8),
(8, 9),
(10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `delivery_details_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `users_id`, `delivery_details_id`) VALUES
(1, 4, 2),
(2, 4, 3),
(3, 5, 4),
(4, 5, 5),
(5, 6, 6),
(6, 5, 7),
(7, 7, 8),
(8, 8, 9),
(9, 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `order_status_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `added_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`order_status_id`, `order_id`, `status_id`, `admin_id`, `added_date`) VALUES
(1, 4, 2, NULL, NULL),
(2, 5, 1, NULL, NULL),
(3, 6, 1, NULL, NULL),
(4, 7, 1, NULL, NULL),
(5, 8, 2, NULL, NULL),
(6, 9, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parcel`
--

CREATE TABLE `parcel` (
  `order_id` int(11) NOT NULL,
  `parcel_catagory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parcel`
--

INSERT INTO `parcel` (`order_id`, `parcel_catagory_id`) VALUES
(2, 3),
(3, 4),
(4, 3),
(5, 4),
(6, 3),
(7, 6),
(8, 7),
(9, 8);

-- --------------------------------------------------------

--
-- Table structure for table `parcel_catagory`
--

CREATE TABLE `parcel_catagory` (
  `parcel_catagory_id` int(11) NOT NULL,
  `parcel_type` varchar(200) DEFAULT NULL,
  `parcel_cost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parcel_catagory`
--

INSERT INTO `parcel_catagory` (`parcel_catagory_id`, `parcel_type`, `parcel_cost`) VALUES
(3, 'Document', 100),
(4, 'Small (0-1kg)', 200),
(5, 'Medium (1-2.5kg)', 300),
(6, 'Large(2.5-5kg)', 500),
(7, 'Large +(5kg+)', 1000),
(8, 'Food', 200);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `statu_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `statu_type`) VALUES
(1, 'Approved'),
(2, 'Declined');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_email` varchar(200) NOT NULL,
  `users_password` varchar(200) NOT NULL,
  `users_name` varchar(200) NOT NULL,
  `users_country` varchar(200) DEFAULT NULL,
  `users_province` varchar(100) DEFAULT NULL,
  `users_zone` varchar(100) DEFAULT NULL,
  `users_district` varchar(100) DEFAULT NULL,
  `users_address` varchar(100) DEFAULT NULL,
  `users_phone` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `users_email`, `users_password`, `users_name`, `users_country`, `users_province`, `users_zone`, `users_district`, `users_address`, `users_phone`) VALUES
(2, 'success.kafle1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Safal Kafle', 'Nepal', 'Bagmati', 'Bagmati', 'Kathmandu', 'Newroad, kathmandu', '9860905133'),
(4, 'safal@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Safal Kafle', 'nepal', '3', NULL, 'kathmandu', 'suryabinyaka', '9870609988'),
(5, 'kafle.safal@gmail.com	', '482c811da5d5b4bc6d497ffa98491e38', 'Safal Kafle	', 'Nepal', 'Bagmati', NULL, 'Bhaktapur', 'New thimi', '9860905233'),
(6, 'sandhya@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'sandhya', 'usa', 'ohio', NULL, 'ohio', 'ohio', '9870987654'),
(7, 'susan@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Susan kafle	', 'Nepal', '3', NULL, 'Kathmandu', 'Koteshwor', '9841438485'),
(8, 'sudin@gmail.com', 'd5d36c1481ed4f15245532f30bb20295', 'Sidon Shrestha', 'Nepal', 'Bagmati', NULL, 'Bagmati', 'Koteshwor -04', '9860132537'),
(9, 'Kyle.safal@gmail.com', '0192023a7bbd73250516f069df18b500', 'Safal kafle', '', '', NULL, '', '', ''),
(10, 'subin@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Subin Dhungana', 'Nepal', 'Bagmati', NULL, 'Kathmandu', 'Koteshwor', '9860905133');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `delivery_details`
--
ALTER TABLE `delivery_details`
  ADD PRIMARY KEY (`delivery_details_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD KEY `users_id` (`users_id`),
  ADD KEY `delivery_details_id` (`delivery_details_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `delivery_details_id` (`delivery_details_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`order_status_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `parcel`
--
ALTER TABLE `parcel`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `parcel_catagory_id` (`parcel_catagory_id`);

--
-- Indexes for table `parcel_catagory`
--
ALTER TABLE `parcel_catagory`
  ADD PRIMARY KEY (`parcel_catagory_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD UNIQUE KEY `users_email` (`users_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_details`
--
ALTER TABLE `delivery_details`
  MODIFY `delivery_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `order_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `parcel_catagory`
--
ALTER TABLE `parcel_catagory`
  MODIFY `parcel_catagory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`delivery_details_id`) REFERENCES `delivery_details` (`delivery_details_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`delivery_details_id`) REFERENCES `delivery_details` (`delivery_details_id`);

--
-- Constraints for table `order_status`
--
ALTER TABLE `order_status`
  ADD CONSTRAINT `order_status_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_status_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`),
  ADD CONSTRAINT `order_status_ibfk_3` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `parcel`
--
ALTER TABLE `parcel`
  ADD CONSTRAINT `parcel_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `parcel_ibfk_2` FOREIGN KEY (`parcel_catagory_id`) REFERENCES `parcel_catagory` (`parcel_catagory_id`);
