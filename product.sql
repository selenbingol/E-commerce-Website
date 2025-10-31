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
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_name` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `product_image` text NOT NULL,
  `product_category` text NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_size` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_name`, `product_id`, `product_description`, `product_image`, `product_category`, `product_quantity`, `product_price`, `product_size`) VALUES
('Gold Heart Necklace', 15, 'Elevate your elegance with this exquisite Gold Heart Necklace, a timeless piece that embodies the essence of love and sophistication.', 'uploads/clothes1.jpeg', '2', 42, 250, 'Standart'),
('Heart Shaped Bracelet', 18, 'Add a touch of elegance with our Heart-Shaped Bracelet, featuring beautifully crafted sterling silver heart charms.', 'uploads/bracelet.jpeg', '2', 30, 270, 'Standart'),
('Hoop Earring', 19, 'Crafted from high-quality sterling silver, these earrings feature a sleek, polished finish that radiates sophistication.', 'uploads/earring.jpeg', '2', 78, 310, 'Standart'),
('Blue Shirt for Women', 20, 'Discover effortless style with our Blue Shirt for women, a versatile addition to any wardrobe.', 'uploads/blueshirt.jpeg', '7', 56, 450, 'Medium'),
('Long Satin Dress', 22, 'Step into elegance with our Satin Long Dress, a timeless piece perfect for any special occasion. ', 'uploads/dress.jpeg', '7', 14, 850, 'Small'),
('Unisex Red Sneaker', 23, 'Add a bold touch to your footwear collection with our Red Sneaker, designed for both style and comfort. ', 'uploads/redshoe.jpeg', '5', 27, 3500, '39'),
('Pink Blush', 24, 'Enhance your natural beauty with our Pink Blush, the perfect addition to your makeup collection. ', 'uploads/blush.jpeg', '3', 66, 750, '20 ml'),
('Wired Heaphone', 27, 'Enjoy high-quality sound and comfortable listening with our Wired Headphones, perfect for music lovers and audio enthusiasts. ', 'uploads/headphone.jpeg', '6', 157, 900, '1 meter'),
('White Shoe for Women', 28, 'Step into timeless elegance with our Women’s White Shoe, a versatile addition to any wardrobe.', 'uploads/whiteshoe.jpeg', '6', 49, 2900, '38'),
('Pink Iphone 13', 30, 'Powered by the A15 Bionic chip, the iPhone 13 ensures smooth and fast performance, whether you are multitasking, gaming, or using augmented reality apps.', 'uploads/iphone 13.png', '6', 45, 30000, '6 inches'),
('Highlighter', 39, 'Introducing our radiant and versatile highlighter, specially crafted to accentuate your natural beauty and bring forth a luminous glow that captivates. ', 'uploads/highlighter.jpeg', '3', 65, 580, '10 ml'),
('Green Cargo Pants', 40, 'Crafted for the modern explorer, these pants are designed to take you from urban streets to rugged trails with ease.', 'uploads/greenpants.jpeg', '7', 20, 760, 'Large'),
('Green Flower Heels', 41, 'Elevate your style to new heights with our enchanting Green Flower Heels, where sophistication meets whimsical charm.', 'uploads/highheel.jpeg', '5', 67, 4500, '37'),
('Burgundy Lipstick', 42, 'Indulge in the rich allure of our Burgundy Lipstick, a timeless classic that exudes sophistication and allure. ', 'uploads/lipstick.jpeg', '3', 29, 490, '5 ml'),
('Gray Shirt for Men', 43, 'Elevate your wardrobe essentials with our Gray Shirt for Men, a versatile piece that effortlessly combines style and comfort. ', 'uploads/menshirt.jpeg', '7', 49, 870, 'Medium-Large'),
('White Sneakers for Men', 44, 'Step into timeless style with our White Sneakers for Men, a versatile footwear staple that effortlessly combines comfort and sophistication.', 'uploads/menwhiteshoe.png', '5', 90, 4200, '43'),
('Large Gold Molten Bangle Bracelet', 45, 'Elevate your accessory game with our Large Gold Molten Bangle Bracelet, a statement piece that exudes opulence and sophistication.', 'uploads/largebracelet.jpeg', '2', 79, 780, 'Standart'),
('Colorful Beaded Necklace', 46, 'Introducing our vibrant and captivating Colorful Beaded Necklace, a stunning accessory that adds a pop of color and a touch of bohemian flair to any outfit.', 'uploads/beadednecklace.jpg', '2', 23, 150, 'Standart'),
('Earring Set', 47, 'Introducing our exquisite Earring Set, a curated collection designed to complement every facet of your style journey.', 'uploads/earringset.jpeg', '2', 92, 450, 'Standart');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
