-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2025 at 06:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eleko_resort`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_cred`
--

CREATE TABLE `admin_cred` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_cred`
--

INSERT INTO `admin_cred` (`id`, `admin_name`, `admin_password`) VALUES
(1, 'admin', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_name` varchar(300) NOT NULL,
  `price` int(11) NOT NULL,
  `total_pay` int(11) NOT NULL,
  `room_no` varchar(100) DEFAULT NULL,
  `user_name` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_id` int(11) NOT NULL,
  `user_name` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `address` varchar(500) NOT NULL,
  `room_name` varchar(200) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `arrival` int(11) NOT NULL DEFAULT 0,
  `refund` int(11) DEFAULT NULL,
  `booking_status` varchar(100) NOT NULL DEFAULT 'pending',
  `trans_id` varchar(300) NOT NULL,
  `price` int(11) NOT NULL,
  `trans_amt` int(11) NOT NULL,
  `trans_status` varchar(200) NOT NULL DEFAULT 'pending',
  `trans_resp_msg` varchar(200) DEFAULT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_order`
--

INSERT INTO `booking_order` (`booking_id`, `user_name`, `email`, `address`, `room_name`, `check_in`, `check_out`, `arrival`, `refund`, `booking_status`, `trans_id`, `price`, `trans_amt`, `trans_status`, `trans_resp_msg`, `datentime`) VALUES
(22, 'Ogbodo Enyinna Eugene', 'magicveekthor@gmail.com', 'Enugu', 'One Bedroom Apartment', '2025-11-26', '2025-11-28', 1, NULL, 'booked', 'T910795174444529', 100000, 200000, 'success', 'Successful', '2025-11-25 11:55:18'),
(23, 'Odoh Victor ', 'victor.odoh@elizadeuniversity.edu.ng', 'Enugu', 'One Bedroom Apartment', '2025-11-26', '2025-11-28', 1, NULL, 'booked', 'T749094021011350', 100000, 200000, 'success', 'Successful', '2025-11-25 12:03:57'),
(25, 'Anosike Chisom', 'opemzy2000@gmail.com', 'Enugu', 'Four Bedroom Duplex', '2025-11-27', '2025-11-28', 1, NULL, 'booked', 'T353619592131524', 400000, 400000, 'success', 'Successful', '2025-11-25 12:48:47'),
(26, 'Odoh Peter Ejike', 'victorodoh7@gmail.com', 'Enugu', 'Two Bedroom Apartment', '2025-12-01', '2025-12-04', 0, 1, 'cancelled', 'T530508913372887', 150000, 450000, 'success', 'Successful', '2025-11-25 13:03:02'),
(27, 'Glory Eke', 'ekeglorykenechukwu@gmail.com', 'Enugu', 'Studio Apartment', '2025-12-03', '2025-12-06', 0, 1, 'cancelled', 'T847257778114078', 70000, 210000, 'success', 'Successful', '2025-11-25 13:43:47');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `id` int(11) NOT NULL,
  `carousel_video` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`id`, `carousel_video`) VALUES
(1, 'VID_36612.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(150) NOT NULL,
  `subject` varchar(300) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `desc_title` varchar(150) NOT NULL,
  `descrip` varchar(5000) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `desc_title`, `descrip`, `status`, `removed`) VALUES
(1, 'Studio Apartment', 8, 70000, 6, 2, 4, 'A cozy retreat designed for comfort and calm', 'Welcome to our charming and vibrant studio short-stay apartment, where comfort meets style in a compact and captivating space! Step into a world of contemporary elegance, where every detail has been thoughtfully designed to make your stay a truly remarkable experience.\r\n\r\nAs you open the door, you\'ll be greeted by a seamless fusion of modern aesthetics and cozy ambiance. The studio\'s clever layout maximizes every inch, creating an inviting atmosphere that embraces you from the moment you arrive. Natural light cascades through large windows, illuminating the sleek furnishings and tasteful décor.', 1, 0),
(2, 'One Bedroom Apartment', 5, 100000, 4, 4, 4, 'Where style meets simplicity — your perfect city escape.', 'Welcome to our captivating one-bedroom short-stay apartment, a sanctuary of sophistication and modern luxury that invites you to indulge in a world of comfort and style. Step into a realm of impeccable design and thoughtful details, where every aspect has been meticulously curated to exceed your expectations.\r\n\r\nThe moment you enter, you\'ll be greeted by an ambiance that seamlessly combines elegance and warmth. Soft lighting dances off the walls, highlighting the contemporary furnishings and exquisite decor, creating an atmosphere that embraces you in its embrace.\r\n\r\nThe living room is a haven of relaxation, adorned with plush seating and adorned with tasteful accents. Sink into the cozy sofa, bask in the soft glow of the designer lighting, and lose yourself in the embrace of a captivating book or your favorite entertainment on the sleek flat-screen TV\r\n\r\nPrepare to unleash your culinary creativity in the fully equipped kitchen, a culinary enthusiast\'s dream. With top-of-the-line appliances, gleaming countertops, and ample space to work your magic, this kitchen is a playground for your gastronomic adventures. Enjoy a culinary masterpiece at the elegant dining table, surrounded by the gentle ambiance that fills the air.', 1, 0),
(3, 'Two Bedroom Apartment', 8, 150000, 2, 4, 4, 'Spacious living made effortless — ideal for comfort and connection', 'Welcome to our extraordinary two-bedroom short-stay apartment, where sophistication meets modern flair in a harmonious blend of style and comfort. Step into a realm of captivating design and impeccable attention to detail, where every element has been thoughtfully crafted to create an unforgettable experience. This spacious haven offers a truly enchanting escape, inviting you to immerse yourself in a world of luxury and relaxation.\r\n\r\nThe expansive living area is a testament to modern elegance, boasting chic furnishings and a contemporary ambiance that exudes charm. Sink into the plush sofas, adorned with vibrant accent pillows, and unwind as natural light cascades through the large windows, casting a warm glow upon the sleek hardwood floors. Whether you gather with loved ones to share stories or simply bask in the serenity of the space, the living area provides an inviting retreat that effortlessly combines comfort and style.\r\n\r\nThe fully equipped gourmet kitchen is a culinary enthusiast\'s dream come true. Embark on culinary adventures with state-of-the-art appliances, gleaming countertops, and ample space to create mouthwatering meals. Share delightful conversations over a delicious feast at the elegant dining table, where memories are made and laughter fills the air. From sizzling aromas to delectable flavors, this kitchen is a playground for your culinary creativity.', 1, 0),
(4, 'Four Bedroom Duplex', 8, 400000, 1, 8, 8, 'A refined space for relaxation, gatherings, and lasting memories.', 'Welcome to our extraordinary three-bedroom short-stay apartment, a haven of grandeur and contemporary elegance that promises an unparalleled experience. Step into a world of spacious luxury, where every detail has been meticulously designed to create a truly remarkable retreat. This opulent sanctuary invites you to indulge in the ultimate blend of style, comfort, and sophistication.\r\n\r\nThe expansive living area is a testament to modern opulence, featuring plush sofas and exquisite furnishings that beckon you to relax and unwind. Natural light streams through the floor-to-ceiling windows, casting a warm glow upon the tasteful decor and sleek hardwood floors. Gather with your loved ones in this generous space, perfect for lively conversations, laughter, and creating lasting memories. Whether you\'re hosting a gathering or simply enjoying a quiet evening in, the living area offers an ambiance of effortless luxury.\r\n\r\nPrepare to be captivated by the fully equipped gourmet kitchen, a culinary masterpiece in its own right. With top-of-the-line appliances, sleek countertops, and ample workspace, this kitchen is a haven for aspiring chefs and food enthusiasts alike. Delight in the art of cooking as you create gastronomic delights, accompanied by the tantalizing aromas that fill the air. Dine in style at the elegant dining table, surrounded by the exquisite ambiance that permeates every corner of this exceptional apartment.', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumbnail` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`id`, `room_id`, `image`, `thumbnail`) VALUES
(9, 1, 'IMG_13909.jpg', 0),
(10, 1, 'IMG_17433.jpg', 0),
(12, 1, 'IMG_33810.jpg', 0),
(13, 1, 'IMG_79114.jpg', 1),
(14, 1, 'IMG_28882.jpg', 0),
(15, 2, 'IMG_76517.jpg', 0),
(16, 2, 'IMG_74727.jpg', 1),
(17, 2, 'IMG_52110.jpg', 0),
(18, 2, 'IMG_44791.jpg', 0),
(19, 2, 'IMG_34772.jpg', 0),
(20, 2, 'IMG_34777.jpg', 0),
(21, 2, 'IMG_87036.jpg', 0),
(22, 3, 'IMG_38865.jpg', 0),
(23, 3, 'IMG_59284.jpg', 0),
(24, 3, 'IMG_56579.jpg', 0),
(25, 3, 'IMG_87844.jpg', 0),
(26, 3, 'IMG_93405.jpg', 0),
(27, 3, 'IMG_94361.jpg', 0),
(28, 3, 'IMG_83992.jpg', 0),
(29, 3, 'IMG_98336.jpg', 0),
(30, 3, 'IMG_66344.jpg', 1),
(31, 4, 'IMG_79971.jpg', 1),
(32, 4, 'IMG_90920.jpg', 0),
(33, 4, 'IMG_86710.jpg', 0),
(34, 4, 'IMG_51832.jpg', 0),
(35, 4, 'IMG_88650.jpg', 0),
(36, 4, 'IMG_67539.jpg', 0),
(37, 4, 'IMG_87902.jpg', 0),
(38, 4, 'IMG_24696.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `team_details`
--

CREATE TABLE `team_details` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `position` varchar(150) NOT NULL,
  `picture` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_details`
--

INSERT INTO `team_details` (`id`, `name`, `position`, `picture`) VALUES
(1, 'Jane Doe', 'Director', 'IMG_45034.JPG'),
(2, 'Magic Veekthor', 'Writer', 'IMG_82829.JPG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_name`),
  ADD KEY `room_id` (`room_name`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `team_details`
--
ALTER TABLE `team_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `team_details`
--
ALTER TABLE `team_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`);

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
