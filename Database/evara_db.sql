-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2024 at 03:05 PM
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
-- Database: `evara_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `name`, `price`, `image`, `quantity`, `description`) VALUES
(15, 'SUN WITH BIRTH STONE BRACELET', 900.00, 'gold/g3.jpg', 1, 'Celebrate your birth month with this radiant bracelet, featuring a sun motif and your personal birthstone for a personalized touch.'),
(16, 'FINGER PRINT BRACELET', 1500.00, 'gold/g4.jpg', 2, 'Keep your loved ones close with this unique bracelet that captures their fingerprint on a delicate charm. It’s a heartfelt and intimate accessory.');

-- --------------------------------------------------------

--
-- Table structure for table `customizations`
--

CREATE TABLE `customizations` (
  `customization_id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `material` varchar(50) DEFAULT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `faq_id` int(11) NOT NULL,
  `question` text DEFAULT NULL,
  `answer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`faq_id`, `question`, `answer`) VALUES
(1, 'How can I track my order? ', 'You can track your order by logging into your account and navigating to the Order History section.'),
(3, 'What is your return policy?', 'We accept returns within 30 days of purchase. The items must be in their original condition.'),
(4, 'How can I customize my jewelry?', 'You can customize your jewelry by visiting the Customize page and following the steps to design your piece.'),
(5, 'What payment methods do you accept?', 'We accept all major credit cards, PayPal, and other secure payment methods.');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','shipped','canceled') DEFAULT 'pending',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total`, `status`, `order_date`) VALUES
(1, 1, 5000.00, 'shipped', '2024-09-07 13:18:21'),
(2, 3, 8000.00, 'completed', '2024-09-08 15:49:45');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `material` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `description`, `image`, `category`) VALUES
(1, 'THE LOLA bangle', 1500.00, 'A chic and modern bangle that adds a touch of elegance to any outfit. Its sleek design is perfect for a minimalist look.', 'gold/g1.jpg', 'gold'),
(2, 'SQARE LINK BRACELET', 2500.00, 'This geometric bracelet features square links for a contemporary style. Its a statement piece thats both bold and sophisticated.', 'gold/g2.jpg', 'gold'),
(3, 'SUN WITH BIRTH STONE BRACELET', 900.00, 'Celebrate your birth month with this radiant bracelet, featuring a sun motif and your personal birthstone for a personalized touch.', 'gold/g3.jpg', 'gold'),
(5, 'FINGER PRINT BRACELET', 1500.00, 'Keep your loved ones close with this unique bracelet that captures their fingerprint on a delicate charm. It’s a heartfelt and intimate accessory.', 'gold/g4.jpg', 'gold'),
(6, 'GOLD TWISTED CUFF BRACELET', 4500.00, 'An elegant twisted cuff in lustrous gold that wraps your wrist in luxury. Its versatile enough for day or evening wear.', 'gold/g5.jpg', 'gold'),
(7, 'ASTRA MOONLIGHT BRACELET', 3000.00, 'A dreamy bracelet that captures the enchantment of moonlight with its shimmering design. Perfect for those who love the night sky.', 'gold/g6.jpg', 'gold'),
(8, 'STERLING SILVER NAME BRACELET', 1500.00, 'A personalized sterling silver bracelet that spells out your name in delicate script. Its a timeless piece thats uniquely yours.', 'silver/s1.jpg', 'silver'),
(9, 'SILVER BANGLE', 2500.00, 'A classic silver bangle with a sleek finish that complements any look. Its an essential accessory for any jewelry collection.', 'silver/s2.jpg', 'silver'),
(10, 'ASYMMETRIC TEMPERAMENT CAULIFLOWER BRACELET', 1000.00, 'An artistic bracelet with an asymmetric design inspired by nature’s beauty. It’s a bold and expressive piece.', 'silver/s3.jpg', 'silver'),
(11, 'DOUBLE CHAIN BRACELET', 900.00, 'Double the elegance with this layered chain bracelet. Its fluid design moves gracefully with you.', 'silver/s4.jpg', 'silver'),
(12, 'SUNSHINE BRACELET', 1500.00, 'Bring a little sunshine to your day with this cheerful bracelet. Its bright and sunny charm is sure to lift your spirits.', 'silver/s5.jpg', 'silver'),
(13, ' CRUB CHAIN BRACELET', 1500.00, 'A robust crub chain bracelet that adds an edgy touch to any ensemble. It’s both trendy and timeless. The bracelet is subtle and minimalistic, but it stands out enough to complete your outfit.', 'silver/s6.jpg', 'silver'),
(20, 'FRESH WATER PEARL BRACELET', 1500.00, 'A delicate bracelet adorned with freshwater pearls, offering a touch of classic beauty to your wrist.', 'pearl/p1.jpg', 'pearl'),
(21, 'THE VERY FIRST MENS BRACELET', 700.00, 'A pioneering design for the modern man, this bracelet combines style with masculinity in its first-ever rendition.', 'pearl/p2.jpg', 'pearl'),
(22, 'MINIMALIST STRETCH BRACELET', 1000.00, 'Simplicity at its finest, this stretch bracelet offers effortless style and comfort for everyday wear.', 'pearl/p3.jpg', 'pearl'),
(23, 'AUTHENTIC FRESH WATER CULTURED PEARL BRACELET', 1500.00, 'Experience the elegance of authentic freshwater cultured pearls, strung together in a timeless fashion.', 'pearl/p4.jpg', 'pearl'),
(24, 'FRESH WATER PEARL BRACELET GOLD', 1700.00, 'Elevate your style with this freshwater pearl bracelet, enhanced with gold accents for added sophistication.', 'pearl/p5.jpg', 'pearl'),
(25, 'NATURAL PEARL BRACELET', 800.00, ' Embrace the natural beauty of pearls with this bracelet, featuring genuine pearls in their most organic form.', 'pearl/p6.jpg', 'pearl'),
(26, 'clean neckless', 400.00, 'this gives you clean look !!!', 'pearl/p1.jpg', 'Gold');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Sanuu', 'sanu@gmail.com', '$2y$10$tAqAN8CAWXE.h9ZuBZMjcOHCFo7W6HQ3Js8m5eeKKlYVPFDATDqpO', 'customer', '2024-09-07 07:37:12'),
(2, 'Basnayaka', 'b@gmail.com', '$2y$10$N4/znyiDdr4Y5OJ1g/TvKuUI8CKEqlGKu36nxrBJ7BI1yNNpDSoGu', 'admin', '2024-09-07 07:40:29'),
(3, 'Lasitha', 'l@gmail.com', '$2y$10$AzygP.BpishFYMaRqyP7HOV6HPgqI2qEBTm4tYt4FDUe4P7SkrchO', 'customer', '2024-09-07 12:07:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customizations`
--
ALTER TABLE `customizations`
  ADD PRIMARY KEY (`customization_id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customizations`
--
ALTER TABLE `customizations`
  MODIFY `customization_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
