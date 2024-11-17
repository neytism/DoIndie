-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: sql12.freesqldatabase.com
-- Generation Time: Oct 03, 2024 at 11:49 PM
-- Server version: 5.5.62-0ubuntu0.14.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sql12732873`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `address_id` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `brgy_id` int(5) DEFAULT NULL,
  `city_id` int(5) DEFAULT NULL,
  `province_id` int(5) DEFAULT NULL,
  `region_id` int(5) DEFAULT NULL,
  `detailed_info` varchar(255) DEFAULT NULL,
  `landmark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `artist_categories`
--

CREATE TABLE `artist_categories` (
  `artist_category_id` int(11) NOT NULL,
  `artist_category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artist_categories`
--

INSERT INTO `artist_categories` (`artist_category_id`, `artist_category_name`) VALUES
(1, '3D Artist'),
(2, 'Graphic Designer'),
(3, 'Multimedia Artist'),
(4, 'Concept Artist'),
(5, 'Digital Illustrator'),
(6, 'Character Designer'),
(7, 'UI/UX Designer'),
(8, 'Motion Graphics Artist'),
(9, 'Storyboard Artist');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_added_to_cart` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `user_id`, `product_id`, `quantity`, `date_added_to_cart`) VALUES
(20, 3, 1, 2, '2024-09-30 16:35:47');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `product_picture_path` varchar(255) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `sale_price` decimal(11,2) DEFAULT NULL,
  `tags` varchar(255) NOT NULL,
  `views` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `title`, `product_category_id`, `product_description`, `product_picture_path`, `artist_id`, `price`, `sale_price`, `tags`, `views`, `date_added`) VALUES
(1, 'The Miles Morales Reaction', 6, 'No description.', '4_the_miles_morales_reaction.png', 4, '69.99', '69.99', 'Miles Morales, Spider-man', 15, '2024-09-29 12:55:42'),
(2, 'The Reaction', 5, 'No description.', '4_the_reaction.png', 4, '69.00', '69.00', 'Meme', 0, '2024-09-29 12:56:19'),
(3, 'No Bitches?', 1, 'No description.', '4_no_bitches.jpg', 4, '1000.00', '1000.00', 'Meme', 1, '2024-09-29 13:06:13'),
(4, 'Last', 2, 'No description.', '4_last.png', 4, '1200.00', '1200.00', 'Flower, Hand, Outline', 0, '2024-09-29 23:09:04'),
(5, 'Lone (WIP)', 2, 'This is a description of a product. This is a description of a product. This is a description of a product. This is a description of a product. This is a description of a product. This is a description of a product. ', '4_lone_wip.png', 4, '69.00', '69.00', 'Animal, Elephant, Unfinished', 2, '2024-09-30 10:23:22'),
(6, 'Not Free', 2, 'Not free artwork for an event.', '5_not_free.png', 5, '10.00', '10.00', 'tag1, tag2, tag3', 0, '2024-09-30 16:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `product_category_id` int(11) NOT NULL,
  `product_category_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`product_category_id`, `product_category_name`) VALUES
(1, 'Pins'),
(2, 'Posters'),
(3, 'Stickers'),
(4, 'Keychains'),
(5, 'Commissions'),
(6, 'Fanart'),
(7, 'Traditional'),
(8, '3D Model'),
(9, '3D Print');

-- --------------------------------------------------------

--
-- Table structure for table `refregion`
--

CREATE TABLE `refregion` (
  `id` int(11) NOT NULL,
  `psgcCode` varchar(255) DEFAULT NULL,
  `regDesc` text,
  `regCode` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `refregion`
--

INSERT INTO `refregion` (`id`, `psgcCode`, `regDesc`, `regCode`) VALUES
(1, '010000000', 'REGION I (ILOCOS REGION)', '01'),
(2, '020000000', 'REGION II (CAGAYAN VALLEY)', '02'),
(3, '030000000', 'REGION III (CENTRAL LUZON)', '03'),
(4, '040000000', 'REGION IV-A (CALABARZON)', '04'),
(5, '170000000', 'REGION IV-B (MIMAROPA)', '17'),
(6, '050000000', 'REGION V (BICOL REGION)', '05'),
(7, '060000000', 'REGION VI (WESTERN VISAYAS)', '06'),
(8, '070000000', 'REGION VII (CENTRAL VISAYAS)', '07'),
(9, '080000000', 'REGION VIII (EASTERN VISAYAS)', '08'),
(10, '090000000', 'REGION IX (ZAMBOANGA PENINSULA)', '09'),
(11, '100000000', 'REGION X (NORTHERN MINDANAO)', '10'),
(12, '110000000', 'REGION XI (DAVAO REGION)', '11'),
(13, '120000000', 'REGION XII (SOCCSKSARGEN)', '12'),
(14, '130000000', 'NATIONAL CAPITAL REGION (NCR)', '13'),
(15, '140000000', 'CORDILLERA ADMINISTRATIVE REGION (CAR)', '14'),
(16, '150000000', 'AUTONOMOUS REGION IN MUSLIM MINDANAO (ARMM)', '15'),
(17, '160000000', 'REGION XIII (Caraga)', '16');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) UNSIGNED NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `voucher_code` varchar(50) DEFAULT NULL,
  `voucher_desc` varchar(100) DEFAULT NULL,
  `payment_method` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `selected_cart_items` text NOT NULL,
  `status` enum('pending','completed','failed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `buyer_id`, `total`, `voucher_code`, `voucher_desc`, `payment_method`, `address`, `selected_cart_items`, `status`, `created_at`) VALUES
(1, 5, '1.00', 'GARY50', '50.00% OFF', 'Cash on Delivery', 'West Ave. Cor. Baler Street 1100, Quezon City', '[{\"product_id\":5,\"current_price\":\"69.00\",\"quantity\":1},{\"product_id\":4,\"current_price\":\"1200.00\",\"quantity\":1},{\"product_id\":3,\"current_price\":\"1000.00\",\"quantity\":1},{\"product_id\":2,\"current_price\":\"69.00\",\"quantity\":1},{\"product_id\":1,\"current_price\":\"69.99\",\"quantity\":3}]', 'pending', '2024-10-02 00:30:46'),
(2, 5, '1.00', 'GARY50', '50.00% OFF', 'Cash on Delivery', 'West Ave. Cor. Baler Street 1100, Quezon City', '[{\"product_id\":5,\"current_price\":\"69.00\",\"quantity\":1},{\"product_id\":4,\"current_price\":\"1200.00\",\"quantity\":1},{\"product_id\":3,\"current_price\":\"1000.00\",\"quantity\":1},{\"product_id\":2,\"current_price\":\"69.00\",\"quantity\":1},{\"product_id\":1,\"current_price\":\"69.99\",\"quantity\":3}]', 'pending', '2024-10-02 00:36:20'),
(3, 5, '1273.99', 'GARY50', '50.00% OFF', 'Cash on Delivery', 'West Ave. Cor. Baler Street 1100, Quezon City', '[{\"product_id\":5,\"current_price\":\"69.00\",\"quantity\":1},{\"product_id\":4,\"current_price\":\"1200.00\",\"quantity\":1},{\"product_id\":3,\"current_price\":\"1000.00\",\"quantity\":1},{\"product_id\":2,\"current_price\":\"69.00\",\"quantity\":1},{\"product_id\":1,\"current_price\":\"69.99\",\"quantity\":3}]', 'pending', '2024-10-02 00:37:57'),
(4, 5, '1273.99', 'GARY50', '50.00% OFF', 'Cash on Delivery', 'West Ave. Cor. Baler Street 1100, Quezon City', '[{\"product_id\":5,\"current_price\":\"69.00\",\"quantity\":1},{\"product_id\":4,\"current_price\":\"1200.00\",\"quantity\":1},{\"product_id\":3,\"current_price\":\"1000.00\",\"quantity\":1},{\"product_id\":2,\"current_price\":\"69.00\",\"quantity\":1},{\"product_id\":1,\"current_price\":\"69.99\",\"quantity\":3}]', 'pending', '2024-10-02 00:47:33'),
(5, 5, '93.99', 'SAVE45', 'LESS â‚± 45.00', 'GCash', 'West Ave. Cor. Baler Street 1100, Quezon City', '[{\"product_id\":2,\"current_price\":\"69.00\",\"quantity\":1},{\"product_id\":1,\"current_price\":\"69.99\",\"quantity\":1}]', 'pending', '2024-10-02 00:54:26'),
(6, 5, '93.99', 'SAVE45', 'LESS â‚± 45.00', 'GCash', 'West Ave. Cor. Baler Street 1100, Quezon City', '[{\"product_id\":2,\"current_price\":\"69.00\",\"quantity\":1},{\"product_id\":1,\"current_price\":\"69.99\",\"quantity\":1}]', 'pending', '2024-10-02 08:38:40'),
(7, 5, '2354.38', 'OFF10', '10.00% OFF', 'GCash', 'West Ave. Cor. Baler Street 1100, Quezon City', '[{\"product_id\":5,\"current_price\":\"69.00\",\"quantity\":3},{\"product_id\":4,\"current_price\":\"1200.00\",\"quantity\":1},{\"product_id\":2,\"current_price\":\"69.00\",\"quantity\":1},{\"product_id\":3,\"current_price\":\"1000.00\",\"quantity\":1},{\"product_id\":1,\"current_price\":\"69.99\",\"quantity\":2}]', 'pending', '2024-10-02 11:10:47'),
(8, 5, '2354.38', 'OFF10', '10.00% OFF', 'GCash', 'West Ave. Cor. Baler Street 1100, Quezon City', '[{\"product_id\":5,\"current_price\":\"69.00\",\"quantity\":3},{\"product_id\":4,\"current_price\":\"1200.00\",\"quantity\":1},{\"product_id\":2,\"current_price\":\"69.00\",\"quantity\":1},{\"product_id\":3,\"current_price\":\"1000.00\",\"quantity\":1},{\"product_id\":1,\"current_price\":\"69.99\",\"quantity\":2}]', 'pending', '2024-10-02 11:11:22'),
(9, 5, '2354.38', 'OFF10', '10.00% OFF', 'GCash', 'West Ave. Cor. Baler Street 1100, Quezon City', '[{\"product_id\":5,\"current_price\":\"69.00\",\"quantity\":3},{\"product_id\":4,\"current_price\":\"1200.00\",\"quantity\":1},{\"product_id\":2,\"current_price\":\"69.00\",\"quantity\":1},{\"product_id\":3,\"current_price\":\"1000.00\",\"quantity\":1},{\"product_id\":1,\"current_price\":\"69.99\",\"quantity\":2}]', 'pending', '2024-10-02 11:14:07'),
(10, 5, '416.97', 'None', '', 'Cash on Delivery', 'West Ave. Cor. Baler Street 1100, Quezon City', '[{\"product_id\":2,\"current_price\":\"69.00\",\"quantity\":3},{\"product_id\":1,\"current_price\":\"69.99\",\"quantity\":3}]', 'pending', '2024-10-02 11:18:17'),
(11, 5, '138.99', 'None', '', 'Cash on Delivery', 'West Ave. Cor. Baler Street 1100, Quezon City', '[{\"product_id\":2,\"current_price\":\"69.00\",\"quantity\":1},{\"product_id\":1,\"current_price\":\"69.99\",\"quantity\":1}]', 'pending', '2024-10-02 12:07:38'),
(12, 5, '1000.00', 'None', '', 'Cash on Delivery', 'West Ave. Cor. Baler Street 1100, Quezon City', '[{\"product_id\":3,\"current_price\":\"1000.00\",\"quantity\":1}]', 'pending', '2024-10-02 12:13:00'),
(13, 5, '139.98', 'None', '', 'Cash on Delivery', 'West Ave. Cor. Baler Street 1100, Quezon City', '[{\"product_id\":1,\"current_price\":\"69.99\",\"quantity\":2}]', 'pending', '2024-10-02 12:19:49'),
(14, 5, '69.00', 'None', '', 'Cash on Delivery', 'West Ave. Cor. Baler Street 1100, Quezon City', '[{\"product_id\":2,\"current_price\":\"69.00\",\"quantity\":1}]', 'pending', '2024-10-02 12:22:05'),
(15, 5, '138.99', 'None', '', 'Cash on Delivery', 'West Ave. Cor. Baler Street 1100, Quezon City', '[{\"product_id\":2,\"current_price\":\"69.00\",\"quantity\":1},{\"product_id\":1,\"current_price\":\"69.99\",\"quantity\":1}]', 'pending', '2024-10-02 12:23:16'),
(16, 4, '30.00', 'None', '', 'Cash on Delivery', 'Antipolo City', '[{\"product_id\":6,\"current_price\":\"10.00\",\"quantity\":3}]', 'pending', '2024-10-03 12:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_verified_email` varchar(11) NOT NULL DEFAULT 'false',
  `password` varchar(255) NOT NULL,
  `artist_display_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `picture_path` varchar(255) NOT NULL,
  `is_artist` varchar(11) NOT NULL DEFAULT 'false',
  `artist_category_id` int(11) NOT NULL,
  `role` int(2) NOT NULL,
  `date_joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `is_verified_email`, `password`, `artist_display_name`, `address`, `first_name`, `last_name`, `picture_path`, `is_artist`, `artist_category_id`, `role`, `date_joined`) VALUES
(3, 'admin000', 'admin000@gmail.com', 'false', '$2y$10$aE6u9qG1Z6RozG2TL0EKRuQnIqCh5Cf3.u/bOq7ssnxvgqDVgEjVi::fbd1fb3743672e341e5fb9d797c8bad1', '', '', 'admin000', NULL, '3.gif', 'false', 0, 1, '2024-09-23 11:10:13'),
(4, 'nateflorendo', 'nate.florendo@ciit.edu.ph', 'true', '$2y$10$.p9WOzDs9Rqexn64xC8t5e3oa.Wa4NPnk4UkSo6zULM2liuZS7CP6::3bbd779118ed13d769e21649c8e3befa', 'Neytism', 'Antipolo City', 'nateflorendo', NULL, '4.png', 'true', 5, 1, '2024-09-23 13:08:20'),
(5, 'natejustine', 'nateodnerolf@gmail.com', 'true', '$2y$10$m4tDFim9p0vYbcYMZnYrK.f.C9ueQXLtxCvghJznK6JgoTAb0kL9i::31cfe6c29059a091c4eb244aa0f15e4e', 'Nate Justine', 'West Ave. Cor. Baler Street 1100, Quezon City', 'natejustine', NULL, '5.jpg', 'true', 7, 1, '2024-09-30 16:37:34');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `voucher_id` int(11) NOT NULL,
  `voucher_code` varchar(50) NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `discount_type` enum('percentage','fixed') NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `usage_limit` int(11) DEFAULT '1',
  `used_count` int(11) DEFAULT '0',
  `applicable_products` text,
  `applicable_categories` text,
  `status` enum('active','expired','disabled') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`voucher_id`, `voucher_code`, `discount_value`, `discount_type`, `start_date`, `end_date`, `usage_limit`, `used_count`, `applicable_products`, `applicable_categories`, `status`, `created_at`) VALUES
(1, 'OFF10', '10.00', 'percentage', '2024-10-01 00:00:00', '2025-10-01 23:59:59', 1, 2, NULL, NULL, 'disabled', '2024-09-30 21:21:35'),
(2, 'OFF20', '20.00', 'percentage', '2024-10-01 00:00:00', '2025-10-01 23:59:59', 1, 0, NULL, NULL, 'active', '2024-09-30 21:21:35'),
(3, 'SAVE45', '45.00', 'fixed', '2024-10-01 00:00:00', '2025-10-01 23:59:59', 1, 2, NULL, NULL, 'active', '2024-09-30 21:21:35'),
(4, 'SAVE100', '100.00', 'fixed', '2024-10-01 00:00:00', '2025-10-01 23:59:59', 1, 0, NULL, NULL, 'active', '2024-09-30 21:21:35'),
(5, 'GARY50', '50.00', 'percentage', '2024-10-01 00:00:00', '2025-10-01 23:59:59', 1, 1, NULL, NULL, 'disabled', '2024-09-30 21:21:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `artist_categories`
--
ALTER TABLE `artist_categories`
  ADD PRIMARY KEY (`artist_category_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`product_category_id`);

--
-- Indexes for table `refregion`
--
ALTER TABLE `refregion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `buyer_id` (`buyer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`voucher_id`),
  ADD UNIQUE KEY `voucher_code` (`voucher_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `artist_categories`
--
ALTER TABLE `artist_categories`
  MODIFY `artist_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `product_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `refregion`
--
ALTER TABLE `refregion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
