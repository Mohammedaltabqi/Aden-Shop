-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2024 at 11:32 PM
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
-- Database: `my_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'Mohammed Altbqi', 'Meedo@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `image`) VALUES
(1, 'مجوهرات', 'Cosmetics are like an artist\'s palette, offering an enchanting array of colors and textures that allow individuals to paint their own unique masterpiece of beauty. These exquisite products are more than just makeup; they are a form of self-expression and ', 'jewelery.png'),
(3, 'مستحضرات تجميل', 'cosmetics is good', 'cosmetics.jpg'),
(6, 'عطور', 'Fragnance and Perfume', 'perfume.jpg'),
(8, 'ملابس شباب', 'احدث الملابس والموضة', '1.webp'),
(9, 'ساعات فاخرة', 'اجمل وارقى الساعات', '2f3723588316062d697ba9e8f755db6e.jpg'),
(11, 'احذية بنات', 'أحذية بنات', 'qa (5).jpg'),
(12, 'ملابس بنات', 'ملابس', 'dcc756168495b3a33f9ec5080e4e1fc8.jpg'),
(13, 'سامسونج', 'جلاكسي', '631287b1-834f-474d-8cfd-1b1b7f65e1cd-thumbnail-770x770-70.jpg'),
(14, 'آيفون', 'Apple', '7a22db7c1aec27804f6018f8bfa45be7.jpg'),
(15, 'حقائب بنات', 'جديد', '977e01cc2c50f1016216e0732c9b2c5b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `work_phone` varchar(15) DEFAULT NULL,
  `cell_phone` varchar(15) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `address`, `email`, `work_phone`, `cell_phone`, `date_of_birth`, `password`) VALUES
(8, 'Ruya Alawlaqi', 'Almansura', 'Roka@gmail.com', '775080738', '775080738', '2002-08-07', '123'),
(9, 'Taiba Alsafi', 'Aden', 'taiba@gmail.com', '+966563987753', '+966563987753', '2001-02-02', '123'),
(11, 'Fatima Bawazir', 'Aden', 'fatima@gmail.com', '776607840', '776607840', '2001-01-01', '123'),
(26, 'Mohammed Altbqi', 'Aden', 'meedo@gmail.com', '0776431647', '0776431647', '2002-04-03', '123'),
(27, 'Mohammed Altbqi', 'Aden', 'mr.mohammedmarwan@gmail.com', '0776431647', '0776431647', '2002-04-03', '123');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `order_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `product_name`, `product_price`, `product_image`, `quantity`, `status`, `order_date`) VALUES
(29, 26, 'Golden Necklace2', 12000, 'necklace1.jpeg', 1, 'delivered', '2024-09-30 17:11:08'),
(30, 26, 'Emerald Watch', 25000, 'emeraldwatch.png', 1, 'approved', '2024-10-01 03:50:34'),
(31, 27, 'a shirt', 14, '8.png', 1, 'approved', '2024-10-01 22:33:58'),
(32, 27, 'T-shirt', 14, 'p4.png', 1, 'approved', '2024-10-01 22:33:58'),
(33, 27, 'Emerald Watch', 25000, 'emeraldwatch.png', 1, 'approved', '2024-10-01 22:33:58'),
(34, 27, 'جاكت', 14, '2.jpg', 1, 'approved', '2024-10-01 22:33:58'),
(35, 27, 'a shirt', 16, '10.png', 5, 'approved', '2024-10-01 22:33:58'),
(36, 26, 'رولكس', 11000, 'rolex5.jpg', 4, 'pending', '2024-10-03 22:50:44'),
(37, 26, 'Divine Perfume', 2500, 'perfume2.jpg', 1, 'pending', '2024-10-03 22:50:44');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `pro_name` varchar(255) NOT NULL,
  `pro_short_info` varchar(255) NOT NULL,
  `pro_price` varchar(255) NOT NULL,
  `pro_description` varchar(255) NOT NULL,
  `pro_image` varchar(255) NOT NULL,
  `cat_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `pro_name`, `pro_short_info`, `pro_price`, `pro_description`, `pro_image`, `cat_type_id`) VALUES
(3, 'Gold watch', 'Gold Watch!! its beautiful', '15000', 'a', 'goldwatchlw.jpeg', 9),
(4, 'Emerald Watch', 'Emerald Watch!! Amazing', '25000', 'b', 'emeraldwatch.png', 9),
(5, 'Makeup_kit', 'Make up kit!! colorful kit beautiful', '2000', 'c', 'makeupkit.jpg', 3),
(6, 'Red Lipstick', 'Lipstick!! Perfect', '500', 'd', 'lipstick.png', 3),
(7, 'Lavender Purple Perfume', 'Smells really good', '3000', 'e', 'Lavenderperfume.jpg', 6),
(9, 'Ruby Ring', 'Ring with Ruby', '10000', 'g', 'ring2.jpeg', 1),
(10, 'Silver Ring', 'Silver ring the coldness of sight', '3000', 'h', 'ring.jpeg', 1),
(11, 'Golden Necklace', 'Neclace made up of pure gold', '50000', 'i', 'necklace2.jpeg', 1),
(12, 'Gold Necklace n Earings', 'Pure Gold Necklace & Earings', '80000', 'j', 'necklace3.jpeg', 1),
(13, 'Golden Necklace2', 'gold', '12000', 'k.', 'necklace1.jpeg', 1),
(14, 'Kashmiri Earings', 'Cultural Earings from a beautiful land kashmir', '1500', 'l', 'earings1.jpg', 1),
(15, 'Divine Perfume', 'Smells beautiful', '2500', 'm', 'perfume2.jpg', 6),
(16, '1881 Perfume', 'Perfume having retro smell reminding of memories', '2000', '1881 Perfume smells really good.A perfume from old times.Perume of your forefathers', 'perfume3.jpg', 6),
(19, 'جاكت', 'جاكت', '14', 'جاكت', '2.jpg', 8),
(20, 'شفرات فلامينجو', 'Dior', '4', 'شفرات فلامينجو', 'IMG-20240825-WA0053.jpg', 3),
(21, 'جل حواجب', 'جل حواجب', '11', 'Dior', 'IMG-20240825-WA0052.jpg', 3),
(23, 'ماسكرا', 'Dior', '6', 'Dior', 'IMG-20240825-WA0041.jpg', 3),
(24, 'روج', 'Dior', '4', 'Dior', 'IMG-20240825-WA0034.jpg', 3),
(25, 'هايلايتر', 'Dior', '11', 'Dior', 'IMG-20240825-WA0018.jpg', 3),
(26, 'كونسيلر', 'Dior', '6', 'Dior', 'IMG-20240825-WA0016.jpg', 3),
(27, 'تنت', 'Dior', '7', 'Dior', 'IMG-20240825-WA0015.jpg', 3),
(28, 'بلاشر', 'Dior', '9', 'Dior', 'IMG-20240825-WA0017.jpg', 3),
(29, 'برايمر', 'Dior', '11', 'Dior', 'IMG-20240825-WA0002.jpg', 3),
(30, 'لب قلوس ', 'Dior', '6', 'Dior', 'IMG-20240825-WA0020.jpg', 3),
(31, 'مزيل مكياج', 'Dior', '12', 'Dior', 'IMG-20240825-WA0022.jpg', 3),
(32, 'اداة تدليك وتنضيف الشعر وفروة الرأس', 'Dior', '13', 'Dior', 'IMG-20240825-WA0027.jpg', 3),
(33, 'عطر سان لوران ', 'Dior', '18', 'Dior', 'IMG-20240825-WA0033.jpg', 3),
(36, 'ايشادو ', 'Dior', '12', 'Dior', 'IMG-20240825-WA0051.jpg', 3),
(37, 'اداة رفع الرموش', 'Dior', '13', 'Dior', 'IMG-20240825-WA0025.jpg', 3),
(38, 'عطر ميس ديور', 'Dior', '15', 'Dior', 'IMG-20240825-WA0021.jpg', 3),
(39, 'لب قلوس', 'Dior', '4', 'Dior', 'IMG-20240825-WA0012.jpg', 3),
(40, 'فاونديشن', 'Dior', '13', 'Dior', 'IMG-20240825-WA0014.jpg', 3),
(41, 'بلاشر', 'Dior', '8', 'Dior', 'IMG-20240825-WA0006.jpg', 3),
(42, 'استشوار', 'Dior', '30', 'Dior', 'IMG-20240825-WA0004.jpg', 3),
(43, 'كونسيلر', 'Dior', '7', 'Dior', 'IMG-20240825-WA0005.jpg', 3),
(44, 'بلاشر', 'Dior', '8', 'Dior', 'IMG-20240825-WA0007.jpg', 3),
(45, 'تونر اورديناردي', 'Dior', '10', 'Dior', 'IMG-20240825-WA0038.jpg', 3),
(46, 'معطر جسم', 'Dior', '14', 'Dior', 'IMG-20240825-WA0043.jpg', 3),
(47, 'ربطة شعر', 'Dior', '5', 'Dior', 'IMG-20240825-WA0040.jpg', 3),
(48, 'لبستيك', 'Dior', '4', 'Dior', 'IMG-20240825-WA0046.jpg', 3),
(49, 'مرطب', 'Dior', '12', 'Dior', 'IMG-20240825-WA0029.jpg', 3),
(50, 'اداة مساج الوجه', 'Dior', '15', 'Dior', 'IMG-20240825-WA0026.jpg', 3),
(51, 'واقي شمس', 'Dior', '16', 'Dior', 'IMG-20240825-WA0023.jpg', 3),
(52, 'اسفنجه لتوزيع لوس باودر', 'Dior', '10', 'Dior', 'IMG-20240825-WA0036.jpg', 3),
(54, 'جاكت', 'جاكت', '17', 'جاكت', '5.jpg', 8),
(56, 'رولكس', 'Rolex', '11000', 'Rolex', 'rolex5.jpg', 9),
(57, 'رولكس', 'Rolex', '12000', 'Rolex', 'rolex8.jpg', 9),
(58, 'رولكس', 'Rolex', '15000', 'Rolex', '12.jpg', 9),
(59, 'رادو', 'رادو', '13000', 'رادو', '3.jpg', 9),
(60, 'رادو', 'رادو', '12000', 'رادو', '15.jpg', 9),
(61, 'جاكت', 'جاكت', '19', 'جاكت', '6.jpg', 8),
(62, 'a shirt', 'a shirt', '14', 'a shirt', '8.png', 8),
(63, 'a shirt', 'a shirt', '15', 'a shirt', '9.png', 8),
(64, 'a shirt', 'a shirt', '16', 'a shirt', '10.png', 8),
(65, 'a shirt', 'a shirt', '16', 'a shirt', 'n7.jpg', 8),
(66, 'a shirt', 'a shirt', '16', 'a shirt', '17.jpg', 8),
(67, 'a shirt', 'a shirt', '13', 'a shirt', '3.png', 8),
(68, 'a shirt', 'a shirt', '17', 'a shirt', '7.png', 8),
(69, 'a shirt', 'a shirt', '16', 'a shirt', '17.jpg', 8),
(70, 'T-shirt', 'T-shirt', '15', 'T-shirt', '11.jpg', 8),
(72, 'T-shirt', 'T-shirt', '14', 'T-shirt', '2.jpg', 8),
(73, 'T-shirt', 'T-shirt', '16', 'T-shirt', '1.jpg', 8),
(74, 'T-shirt', 'T-shirt', '15', 'T-shirt', '4.jpg', 8),
(75, 'T-shirt', 'T-shirt', '14', 'T-shirt', '7.jpg', 8),
(76, 'T-shirt', 'T-shirt', '14', 'T-shirt', 'p4.png', 8),
(77, 'T-shirt', 'T-shirt', '14', 'T-shirt', '9.jpg', 8),
(78, 'T-shirt', 'T-shirt', '14', 'T-shirt', 'p3.png', 8),
(80, 'حذاء', 'shoes', '12', 'shoes', 'qa (2).jpg', 11),
(81, 'حذاء', 'shoes', '11', 'shoes', 'qa (3).jpg', 11),
(82, 'حذاء', 'shoes', '12', 'shoes', 'qa (4).jpg', 11),
(83, 'حذاء', 'shoes', '13', 'shoes', 'qa (5).jpg', 11),
(84, 'حذاء', 'shoes', '14', 'shoes', 'qa (6).jpg', 11),
(85, 'حذاء', 'shoes', '13', 'shoes', 'qa (7).jpg', 11),
(86, 'حذاء', 'shoes', '14', 'shoes', 'qa (8).jpg', 11),
(87, 'حذاء', 'shoes', '15', 'shoes', 'qa (10).jpg', 11),
(88, 'حذاء', 'shoes', '14', 'shoes', 'qa (11).jpg', 11),
(89, 'حذاء', 'shoes', '14', 'shoes', 'qa (12).jpg', 11),
(90, 'حذاء', 'shoes', '16', 'shoes', 'qa (13).jpg', 11),
(91, 'حذاء', 'shoes', '15', 'shoes', 'qa (14).jpg', 11),
(92, 'حذاء', 'shoes', '13', 'shoes', 'qa (15).jpg', 11),
(93, 'حذاء', 'shoes', '13', 'shoes', 'qa (16).jpg', 11),
(94, 'حذاء', 'shoes', '14', 'shoes', 'qa (17).jpg', 11),
(95, 'حذاء', 'shoes', '19', 'shoes', 'wa.jpg', 11),
(98, 'حذاء', 'shoes', '19', 'shoes', 'qa.jpg', 11),
(99, 'رولكس', 'Rolex', '12100', 'Rolex', 'rolex1.png', 9),
(100, 'رولكس', 'Rolex', '12500', 'Rolex', 'rolex3.jpg', 9),
(101, 'فستان', 'فستان', '50', 'فستان', '312f2ee8a9c9ae600545830c5f693785.jpg', 12),
(102, 'فستان', 'فستان', '50', 'فستان', 'ad836c5fdae5f098edfed33ea2106c83.jpg', 12),
(103, 'a shirt', 'a shirt', '22', 'ش', 'e7883d81614b01e88a51cb402d954d17.jpg', 8),
(104, 'فستان', 'فستان', '66', 'فستان', 'e5897703f21ead098b7d70c4298eb3ef.jpg', 12),
(105, 'T-shirt', 'T-shirt', '20', 't', 'ec8d7fb255b93edc283d63aee9ac334d.jpg', 12),
(106, 'عباية', 'عباية', '33', 'عباية', 'cd249c532d3d8896f59c099b3572c0a0.jpg', 12);

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `review_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `review` varchar(255) DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `review_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_type_id` (`cat_type_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `cat_type_id` FOREIGN KEY (`cat_type_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
