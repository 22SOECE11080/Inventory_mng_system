-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2024 at 06:19 AM
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
-- Database: `nvr`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `about_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`about_id`, `title`, `subtitle`, `content`, `image_url`, `created_at`) VALUES
(1, 'About Uss', 'Your Premier Destination for Electronics', 'We are your premier destination for top-quality electronics, offering a wide range of cutting-edge gadgets and devices. Our commitment to excellence ensures that you always get the latest technology with unmatched reliability and performance.', 'p9.jpg', '2024-03-30 13:49:21'),
(2, 'Our Mission', 'Empowering Digital Lifestyles', 'Our mission is to empower your digital lifestyle by providing innovative electronics, exceptional service, and a seamless shopping experience, making us your go-to destination for all things tech-related.', 'p9.jpg', '2024-03-30 13:51:04');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `amin_id` int(20) NOT NULL,
  `admin_username` varchar(200) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`amin_id`, `admin_username`, `Password`, `date`) VALUES
(1, 'rj', '12345', '2024-03-16 16:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `agency`
--

CREATE TABLE `agency` (
  `a_id` int(11) NOT NULL,
  `a_name` varchar(255) DEFAULT NULL,
  `gst_number` varchar(20) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `agency_username` varchar(255) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `pincode` varchar(20) DEFAULT NULL,
  `date` date DEFAULT current_timestamp(),
  `password` varchar(30) NOT NULL,
  `token` varchar(100) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agency`
--

INSERT INTO `agency` (`a_id`, `a_name`, `gst_number`, `phone_number`, `agency_username`, `country`, `state`, `city`, `pincode`, `date`, `password`, `token`, `status`) VALUES
(1, 'ABC Corporation', 'GST123456', '1234567890', 'radheshjoshi02@gmail.com', 'Country', 'Active', 'City', '123456', '2024-03-07', 'RS1510kj*&', '6616de500338f6616de5003391', 'Active'),
(2, 'XYZ Enterprises', 'GST789012', '0987654321', 'xyz@example.com', 'Country', 'State', 'City', '789012', '2024-03-07', '12345', '', 'Active'),
(3, 'LMN Corporation', 'GST345678', '9876543210', 'lmn@example.com', 'Country', 'State', 'City', '345678', '2024-03-07', '12345', '', 'Active'),
(8, 'jk.mango.farm', '222BBBB1111B1Z5', '1111111111', 'rjoshi196@rku.ac.in', 'USA', 'California', 'Los Angeles', '362150', '2024-04-10', 'RS123kj*&', '', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `carousel_slides`
--

CREATE TABLE `carousel_slides` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel_slides`
--

INSERT INTO `carousel_slides` (`id`, `image`, `heading`, `text`) VALUES
(1, 'lab 11.jpg', 'Heading 1', 'Text for slide 1 goes here.'),
(2, 'p8.jpg', 'Heading 2', 'Text for slide 2 goes here.'),
(4, 'istockphoto-1465188429-612x612.jpg', 'Heading 3', 'jekefjkfj');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `c_id` int(11) NOT NULL,
  `p_image` varchar(255) DEFAULT NULL,
  `p_name` varchar(255) DEFAULT NULL,
  `a_name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `discount` decimal(5,2) DEFAULT NULL,
  `date` date DEFAULT current_timestamp(),
  `p_id` int(11) DEFAULT current_timestamp(),
  `a_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`c_id`, `p_image`, `p_name`, `a_name`, `price`, `quantity`, `discount`, `date`, `p_id`, `a_id`) VALUES
(30, '../images/p5.jpeg', 'camara', 'ABC Corporation', 200.00, 1, 12.00, '2024-04-10', 15, 1),
(31, 'p5.jpeg', 'Product C', 'ABC Corporation', 60.00, 1, 12.00, '2024-04-11', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `icons` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `icons`, `title`, `content`, `date`) VALUES
(1, 'bi bi-geo-alt-fill fs-2', 'Address', 'R.K University, Tramba, Rajkot - 360001.', '2024-03-31'),
(2, 'bi bi-telephone-fill fs-2', 'Contact Us.', '+91 7984767883 ', '2024-03-31'),
(3, 'bi bi-envelope-fill fs-2', 'Email Us.', 'rnv1924@gmail.com\r\n\r\n', '2024-03-31'),
(4, 'bi bi-clock-fill fs-2', 'Open Hours', 'Monday-Friday 9:00 AM to 5:00 PM', '2024-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `o_id` int(11) NOT NULL,
  `p_id` int(11) DEFAULT NULL,
  `a_id` int(11) DEFAULT NULL,
  `offer_name` varchar(255) DEFAULT NULL,
  `discount` decimal(5,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`o_id`, `p_id`, `a_id`, `offer_name`, `discount`, `description`, `date`) VALUES
(9, 1, 2, 'Winter Wonderland Sale', 30.00, 'Discount for winter season', '2024-03-07'),
(17, 1, 1, 'diwali sell', 12.00, 'discount per 1 item', '2024-03-14'),
(22, 13, 2, 'HOLI SALE', 10.00, 'The Grand holi sale.', '2024-03-16'),
(23, 13, 2, 'diwali SALE', 20.00, 'it is the sale of pri.', '2024-03-18'),
(25, 15, 1, 'HOLI SALE', 12.00, 'it is the holi sale', '2024-03-20'),
(26, 16, 1, 'HOLI SALE', 20.00, 'it is the sale.', '2024-03-20'),
(28, 6, 3, 'Vaibhav', 22.00, 'Invester', '2024-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `p_image` varchar(255) DEFAULT NULL,
  `p_name` varchar(255) DEFAULT NULL,
  `a_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `p_image`, `p_name`, `a_id`, `price`, `quantity`, `status`, `date`) VALUES
(1, 'p5.jpeg', 'Product C', 1, 60.00, 75, 'Available', '2024-03-07'),
(2, 'p5.jpeg', 'Product D', 2, 90.00, 30, 'Available', '2024-03-07'),
(6, 'p5.jpeg', 'Product 6', 3, 70.00, 120, 'active', '2024-03-07'),
(7, 'p5.jpeg', 'Product 7', 3, 45.00, 90, 'active', '2024-03-07'),
(13, 'p5.jpeg', 'camara', 2, 300.00, 32, 'Available', '2024-03-16'),
(15, 'p5.jpeg', 'camara', 1, 200.00, 20, 'Available', '2024-03-20'),
(16, 'p5.jpeg', 'burds', 1, 500.00, 20, 'Available', '2024-03-20');

-- --------------------------------------------------------

--
-- Table structure for table `retailer`
--

CREATE TABLE `retailer` (
  `r_name` varchar(200) NOT NULL,
  `r_image` varchar(50) NOT NULL,
  `r_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` int(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `token` varchar(200) NOT NULL,
  `date` date DEFAULT current_timestamp(),
  `status` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `retailer`
--

INSERT INTO `retailer` (`r_name`, `r_image`, `r_id`, `email`, `password`, `mobile`, `address`, `gender`, `token`, `date`, `status`, `role`) VALUES
('jenil', '66142815b332e660fd9eb0931apro.webp', 20, 'radheshjoshi02@gmail.com', 'RS1510kj*&', 1111111111, 'R.K University', 'Male', '6614276c545256614276c5452a', '2024-04-08', 'Active', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE `sell` (
  `s_id` int(11) NOT NULL,
  `p_id` int(11) DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `discount` decimal(5,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `c_name` varchar(255) DEFAULT NULL,
  `c_email` varchar(255) DEFAULT NULL,
  `date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `icon_class` varchar(100) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `icon_class`, `heading`, `content`, `link`) VALUES
(1, 'bi bi-gear-fill fs-2', 'Product Range', 'Tech treasures galore, from gadgets to gizmos.', 'singup.php'),
(2, 'bi bi-truck fs-2', 'Fast Delivery', 'Swift tech dispatch, at your doorstep in a flash.', 'singup.php'),
(3, 'bi bi-lock-fill fs-2', 'Secure Payments', 'Shop safe, pay secure, worry-free.', 'singup.php'),
(4, 'bi bi-people-fill fs-2', 'Expert Support', 'Geek squad at your service, tech queries.', 'singup.php');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `M_id` int(11) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  `M_name` varchar(255) NOT NULL,
  `M_info` text DEFAULT NULL,
  `link1` varchar(255) DEFAULT NULL,
  `link2` varchar(255) DEFAULT NULL,
  `link3` varchar(255) DEFAULT NULL,
  `link4` varchar(255) DEFAULT NULL,
  `date_added` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`M_id`, `image_url`, `M_name`, `M_info`, `link1`, `link2`, `link3`, `link4`, `date_added`) VALUES
(1, 'p1.jpeg', 'Radhesh S. Joshi', 'Experienced leader in technology management.', 'link1_value', 'link2_value', 'link3_value', 'link4_value', NULL),
(2, 'p1.jpeg', 'Vaibhav B. Goriya', 'Expert in software development and project management.', 'link1_value', 'link2_value', 'link3_value', 'link4_value', NULL),
(3, 'p1.jpeg', 'Nishant A. Talviya', 'Skilled in data analysis and system optimization.', 'link1_value', 'link2_value', 'link3_value', 'link4_value', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sent_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `token` varchar(256) NOT NULL,
  `otp` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_contact`
--

CREATE TABLE `user_contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_contact`
--

INSERT INTO `user_contact` (`id`, `name`, `email`, `subject`, `description`, `date`) VALUES
(1, 'Vaibhav', 'vgoriya144@gmail.com', 'hello', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2024-04-05 17:33:30'),
(2, 'Vaibhav', 'vgoriya144@gmail.com', 'hello', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2024-04-08 17:05:42'),
(3, '', '', '', '', '2024-04-09 09:37:08'),
(4, '', '', '', '', '2024-04-09 09:37:15'),
(5, '', '', '', '', '2024-04-09 09:38:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`about_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`amin_id`);

--
-- Indexes for table `agency`
--
ALTER TABLE `agency`
  ADD PRIMARY KEY (`a_id`),
  ADD UNIQUE KEY `gst_number` (`gst_number`);

--
-- Indexes for table `carousel_slides`
--
ALTER TABLE `carousel_slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `a_id` (`a_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `a_id` (`a_id`);

--
-- Indexes for table `retailer`
--
ALTER TABLE `retailer`
  ADD PRIMARY KEY (`r_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`M_id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_contact`
--
ALTER TABLE `user_contact`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `amin_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agency`
--
ALTER TABLE `agency`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `carousel_slides`
--
ALTER TABLE `carousel_slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `retailer`
--
ALTER TABLE `retailer`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sell`
--
ALTER TABLE `sell`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `M_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_contact`
--
ALTER TABLE `user_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `products` (`p_id`);

--
-- Constraints for table `offer`
--
ALTER TABLE `offer`
  ADD CONSTRAINT `offer_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `products` (`p_id`),
  ADD CONSTRAINT `offer_ibfk_2` FOREIGN KEY (`a_id`) REFERENCES `agency` (`a_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`a_id`) REFERENCES `agency` (`a_id`);

--
-- Constraints for table `sell`
--
ALTER TABLE `sell`
  ADD CONSTRAINT `sell_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `products` (`p_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
