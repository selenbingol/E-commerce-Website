-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 06, 2024 at 05:53 PM
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
-- Database: `berkhoca_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `total_price` decimal(10,2) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `address`, `phone_number`, `first_name`, `last_name`, `order_date`, `total_price`, `product_image`, `product_name`, `product_quantity`, `product_price`) VALUES
(1, 1, 18, 'd', '', 'd', 'd', '2024-06-05 16:12:34', 520.00, 'uploads/bracelet.jpeg', 'Heart Shaped Bracelet', 1, 270.00),
(2, 1, 18, 'd', '3', 'd', 'd', '2024-06-05 16:16:44', 520.00, 'uploads/bracelet.jpeg', 'Heart Shaped Bracelet', 1, 270.00),
(3, 1, 15, 'd', '3', 'd', 'd', '2024-06-05 16:16:44', 520.00, 'uploads/clothes1.jpeg', 'Gold Heart Necklace', 1, 250.00),
(4, 1, 15, 'f', '5', 'f', 'f', '2024-06-05 16:17:49', 1000.00, 'uploads/clothes1.jpeg', 'Gold Heart Necklace', 1, 250.00),
(5, 1, 24, 'f', '5', 'f', 'f', '2024-06-05 16:17:49', 1000.00, 'uploads/blush.jpeg', 'Pink Blush', 1, 750.00),
(6, 1, 42, 'tüccarbaşı', '213', 'selen', 'bingöl', '2024-06-06 14:57:56', 3390.00, 'uploads/lipstick.jpeg', 'Burgundy Lipstick', 1, 490.00),
(7, 1, 28, 'tüccarbaşı', '213', 'selen', 'bingöl', '2024-06-06 14:57:56', 3390.00, 'uploads/whiteshoe.jpeg', 'White Shoe for Women', 1, 2900.00),
(8, 1, 22, 'kozyatağı', '789', 'idil', 'öztürk', '2024-06-06 15:58:55', 850.00, 'uploads/dress.jpeg', 'Long Satin Dress', 1, 850.00),
(9, 3, 20, 't', '4', 'idil', 'öztürk', '2024-06-06 16:00:54', 450.00, 'uploads/blueshirt.jpeg', 'Blue Shirt for Women', 1, 450.00),
(10, 3, 20, 'h', '5', 'h', 'h', '2024-06-06 16:06:06', 900.00, 'uploads/blueshirt.jpeg', 'Blue Shirt for Women', 2, 450.00),
(11, 1, 15, 's', '2', 's', 's', '2024-06-06 16:26:12', 250.00, 'uploads/clothes1.jpeg', 'Gold Heart Necklace', 1, 250.00),
(12, 3, 15, 'd', '7', 'd', 'd', '2024-06-06 17:44:10', 790.00, 'uploads/clothes1.jpeg', 'Gold Heart Necklace', 1, 250.00),
(13, 3, 18, 'd', '7', 'd', 'd', '2024-06-06 17:44:10', 790.00, 'uploads/bracelet.jpeg', 'Heart Shaped Bracelet', 2, 270.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
