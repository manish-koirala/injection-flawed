-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2024 at 03:22 AM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'electronics'),
(2, 'games'),
(3, 'books'),
(4, 'rides'),
(5, 'clothing'),
(6, 'toys');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `offer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `product_description` text NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`offer_id`, `user_id`, `product_name`, `product_price`, `product_image`, `product_description`, `is_available`, `category_id`) VALUES
(16, 18, 'Anime T-shirt', 100, '../resources/images/uploads/1714115880_anime-tshirt.jfif', 'A jujutsu kaisen anime tshirt for absolute anime fans.', 1, 5),
(17, 18, 'Arduino UNO', 20, '../resources/images/uploads/1714115916_arduino_UNO.jfif', 'Arduino UNO micro-controller for creating IoT Projects, and DIY electronics.', 1, 1),
(19, 18, 'Tricycle for kids', 200, '../resources/images/uploads/1714116030_cycle.jfif', 'Pink tricycle for younger kids.', 1, 4),
(20, 19, 'Elden Ring Book', 20, '../resources/images/uploads/1714116125_elden-ring-book.jfif', 'This covers the full series of the elden ring story.', 1, 3),
(21, 19, 'Electric Scooter', 1900, '../resources/images/uploads/1714116163_electric-scooter.jfif', 'A second hand lightweight electric scooter for a low price.', 1, 4),
(22, 19, 'Gundam Figurine', 120, '../resources/images/uploads/1714116234_gundam-toy.jfif', 'Gundam Toy Figurine for 120 dollars.', 1, 6),
(23, 19, 'Home Router', 400, '../resources/images/uploads/1714116262_home-router.jpg', 'TP-Link Home router.', 1, 1),
(24, 20, 'Lego City', 500, '../resources/images/uploads/1714116299_lego-city.jfif', 'Lego city toys for kids.', 1, 6),
(25, 20, 'Logitech Mouse', 800, '../resources/images/uploads/1714116336_logitech-mouse.jfif', 'Logitech ray tracking mouse.', 1, 1),
(26, 20, 'Lenovo Legion 5 Pro', 5000, '../resources/images/uploads/1714116388_lenovo legion 5.jpg', 'Lenovo Legion 5 pro gaming laptop RTX 4060 , 8 Cores CPU, 32 GB RAM.', 1, 1),
(27, 21, 'Lord Of The Rings', 500, '../resources/images/uploads/1714116449_lord-of-the-rings-book-full.jfif', 'Full book series of lord of the rings, second hand.', 1, 3),
(28, 21, 'Mechanical keyboard', 1299, '../resources/images/uploads/1714116497_mechanical-keyboard.jfif', 'Super flexible mechanical keyboard with replaceble parts and RGB lighting.', 1, 1),
(29, 21, 'RGB Light Package', 599, '../resources/images/uploads/1714116560_rgb-light-package.jpg', 'Full RGB Lighting Package for small to medium rooms. Can be controlled by mobile phones.', 1, 1),
(30, 21, 'Spiderman PS5 game', 80, '../resources/images/uploads/1714116589_spiderman-ps5-game.webp', 'Recent Sony Playstation Game: Spiderman', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `tracking_id` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`tracking_id`) VALUES
('MmJmYmUyNj'),
('NDA4MDJkMj'),
('OWExYzdkNz');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_list`
--

CREATE TABLE `transaction_list` (
  `id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `purchase_date` datetime NOT NULL DEFAULT current_timestamp(),
  `buyer_id` int(11) NOT NULL,
  `seller_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `creditcard_number` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `phone_number`, `creditcard_number`, `username`) VALUES
(18, 'Walter', 'White', 'walterwhite@gmail.com', '482c811da5d5b4bc6d497ffa98491e38', '1012341234', 'ABCD-EFGH-IJKL-MNOP', 'walterwhyt'),
(19, 'Alice', 'Blue', 'aliceBlue@gmail.com', '0d107d09f5bbe40cade3de5c71e9e9b7', '010123123', 'XXX-YYY-ZZZZ', 'aliceb'),
(20, 'Max', 'Blank', 'maxblank100@gmail.com', 'c6989f06490c4012ede31df60ef3bb25', '100200300', 'uuxx-ppdd-aabb', 'maxblank10'),
(21, 'Harry', 'Potter', 'harrypotter@hogwards.com', '827ccb0eea8a706c4c34a16891f84e7b', 'monkey123', '000-111-222-333', 'wizard500');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`offer_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `transaction_list`
--
ALTER TABLE `transaction_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offer_id` (`offer_id`),
  ADD KEY `user id` (`seller_id`),
  ADD KEY `buy_id` (`buyer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `transaction_list`
--
ALTER TABLE `transaction_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transaction_list`
--
ALTER TABLE `transaction_list`
  ADD CONSTRAINT `buy_id` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `offer_id` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`offer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user id` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
