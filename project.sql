-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2021 at 10:23 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` int(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `likes` bigint(255) NOT NULL DEFAULT 0,
  `dislikes` bigint(255) NOT NULL DEFAULT 0,
  `img1` text DEFAULT NULL,
  `img2` text DEFAULT NULL,
  `img3` text DEFAULT NULL,
  `recommended` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `category`, `name`, `description`, `location`, `likes`, `dislikes`, `img1`, `img2`, `img3`, `recommended`) VALUES
(1, 'restaurants', 'القرية النجدية', 'مطعم نجدي شعبي يقدم الاكلات النجدية الشعبية', 'حي الواحة - طريق ابو بكر الصديق', 7, 2, '1_1.png', '1_2.png', '1_3.png', 1),
(2, 'restaurants', 'بنيهانا', 'مطعم يقدم الاكلات الاسوية اليابانية', 'حي التعاون - طريق الدائري الشمالي', 5, 16, '2_1.png', '2_2.png', '2_3.png', 0),
(3, 'cafes', 'كوفي تيل', 'مقهى يقدم القهوة وش تبي بعد', 'عند بيتنا مدرري', 20, 4, '3_1.png', '3_2.png', '3_3.png', 1),
(4, 'cafes', 'قدح', 'قدح محل قهوة', 'هناك مدري', 12, 1, '4_1.png', '4_2.png', '4_3.png', 0),
(28, 'malls', 'حياة مول', 'مكان تسوق', 'طريق الملك عبدالعزيز', 0, 0, '639aa8687f22904a714fcf73ca8c5ec1.png', '4214d0170496ecfb1973a47991e0bff8.png', 'f57f1e99ce139392af21a5901a5cbd43.png', 0),
(29, 'restaurants', 'اوف وايت لاونج', 'مطعم ستيكات-', 'في الرياض', 0, 0, 'e46b9bc4566b3d2504ea84144c29a13c20.png', 'D985D982D8A8D984D8A7D8AA-D8A7D988D981-D988D8A7D98AD8AA.png', 'b8fd7f953037adc5bd3fd62b006f48f4.png', 1),
(31, 'malls', 'النخيل مول', 'مكان تسوق تابع للماجد', 'حي المغرزات - طريق عثمان بن عفان', 0, 0, '0bd718e6be3792b5ce3da37e6f870e42.png', '8fae3e61b32244dc5e96f0213b5fc382.png', '9f6b80e696a3d35b162897d562cd4db1.png', 1),
(32, 'malls', 'رياض جالاري', 'مكان للتسوق', 'في مكان ما', 0, 0, 'df3968ff44bac5fad4a5382de60d01ad.png', '524867bd39a7cfb99e0480be34617524.png', 'edfa225ef87dd3bd13fcd414444a482c.png', 0),
(33, 'malls', 'بانوراما مول', 'مكان للتسوق', 'في الرياض', 0, 0, '93f1d92b4f0436f291cd081d5ae76c6e.png', '282731cbc0e754227b7e9a3e3fa93791.png', 'db9b8e8c0a7a600b171e66d628984b1a.png', 0),
(34, 'cafes', 'بلاتو', 'كافيه بطراز حديث', 'في الرياض', 0, 0, '80698d23bb62b982bc6cf6b4d8db5629.png', 'bd2381724f646b2b46448061b8f4869a.png', '4bde6e6afc8f264f523f2654a6a25148.png', 1),
(35, 'cafes', 'اطياف الكيف', 'كافيه بطراز حديث وتصميم عجيب', 'في الرياض', 0, 0, 'ba453dbf600d1812e3180b9d1430113c.png', '446432c92b65abd37a0b362580684a95.png', '50ea7739cfe3ff7b760ca72a53f28edb.png', 1),
(36, 'parks', 'حديقة الحيوان', 'حديقة مكونة من حيوانات للتعرف عليها في ارض الواقع', 'في الرياض', 0, 0, 'e46b9bc4566b3d2504ea84144c29a13c.png', '67d54bf65bfe849541dfcca8abff9ce6.png', 'b6bbc878f3f0b444db2771aa10053baf.png', 1),
(37, 'parks', 'منتزه الملك عبدالله', 'منتزه للعوائل فقط', 'في الرياض', 0, 0, '0e2934bde5f28006f3a2d0d8f8b1708d.png', '132b985ef2258216537bfbe527ae6bad.png', 'bb9dd4dd67ad217e266ceaed875885e4.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(255) NOT NULL,
  `commenter` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `rate` tinyint(1) NOT NULL,
  `placeid` int(255) NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `commenter`, `message`, `rate`, `placeid`, `comment_date`) VALUES
(16, 'beeshi', 'nice', 1, 4, '2021-04-13 00:55:48'),
(25, 'beeshi', 'very cool', 1, 3, '2021-04-13 18:00:25'),
(31, 'beeshi', 'not cool', 0, 24, '2021-04-13 20:39:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `passwrd` varchar(255) NOT NULL,
  `register_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_banned` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `passwrd`, `register_time`, `is_admin`, `is_banned`) VALUES
(14, 'test', '$2y$10$mW8S8idF1UbaqEBaxxKnF.KifaqQVtjXR/UG9FB9XHWsQiKHuSDgG', '2021-04-12 17:58:01', 0, 1),
(15, 'beeshi', '$2y$10$dp.hJ0aRipWKHOxDuAExeu9IxA/CdBdBEKicw3rerqcHkLKk94liG', '2021-04-12 17:59:39', 1, 0),
(16, 'khalid', '$2y$10$6UkRMwiByJyGJaiZrqD67uUl02Veln4.ExwcL7BY6Qovddj2eM7I2', '2021-04-12 19:27:29', 0, 0),
(17, 'sd612', '$2y$10$6UkRMwiByJyGJaiZrqD67uUl02Veln4.ExwcL7BY6Qovddj2eM7I2', '2021-04-12 19:28:15', 0, 0),
(18, 'realadmin', '$2y$10$YalBr55IeA7vV9/PH7UZt.d28pksq3iKA9zFg3Rpwz6xIwgJL.BX2', '2021-04-13 16:48:10', 1, 0),
(19, 'm7ya', '$2y$10$jGPnIAscMNIB8Npha/1IL.apPInIekRYxeUm48acVgVqfKs4HI4.C', '2021-04-13 20:35:13', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usernames` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
