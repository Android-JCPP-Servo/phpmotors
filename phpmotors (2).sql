-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2021 at 09:42 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int(11) NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used'),
(7, 'Lemons'),
(8, 'Crossover'),
(9, 'Vintage');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(1, 'Warner', 'Valsain', 'wvalsain@eblades.com', '$2y$10$389GkcQaAgw9k/XljGlWreNh.OoBrlT.W8Cl2S2jUV5bUkAXBjVWG', '1', NULL),
(2, 'Emma', 'Sodergren', 'esodergren@eblades.com', '$2y$10$8DeEQq5d801M48W7ezMy7.DkewTr1iqd7VjTwcTl0xd3fXueICcPe', '1', NULL),
(3, 'Andersen', 'Stewart', 'astewart1138@gmail.com', '$2y$10$mNOiP7fnScqxaiyqVAEuvuBYNP2uOqzujVImhTjPcJancyNS0bin6', '1', NULL),
(5, 'Jessica', 'Valsain', 'jvalsain@eblades.com', '$2y$10$7uVJRqhdfR8wIYaAt1jbWesTD0NtMfGIJ8ANR9MabonmcVubiObiu', '1', NULL),
(6, 'Ryan', 'Snowden', 'rsnowden@eblades.com', '$2y$10$TpZufzZSLu7SvYOZh2NONOSrFTCFSBbwAxer9CToEQqJmHHhJb0pa', '1', NULL),
(7, 'Chico', 'Shady', 'cshady@eblades.com', '$2y$10$QpWhWTgTlUydGSSAEuGy4.kgz4V0Hp9ysln4ZsY0ZKeaDznnpRbOG', '1', NULL),
(9, 'Admin', 'User', 'admin@cse340.net', '$2y$10$WlXhYXe9BsMSTaekBVDdBeIp2qPTGUf/aOobWcMHHSQvY64aKPTdC', '3', NULL),
(10, 'Sidd', 'Shady', 'sshady@eblades.com', '$2y$10$hlkl/tc80m.lbf.KkOv5FefijB7nEcfNRY/OCg7r9KTggYlrXKGiq', '1', NULL),
(11, 'Charlotte', 'Hunter', 'chunter@eblades.com', '$2y$10$HJPQpKkiDNegJHmiePFf9.IVco5p7sbrx/n08dIo7nZwCcUbv6L76', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(11) NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,0) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. It is great for everyday driving as well as off-roading whether that be on the rocks or in the mud!', '/phpmotors/images/vehicles/wrangler.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '28045', 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want if it is black.', '/phpmotors/images/vehicles/model-t.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '30000', 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.', '/phpmotors/images/vehicles/adventador.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '417650', 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. This beast comes with 60 inch tires giving you the traction needed to jump and roll in the mud.', '/phpmotors/images/vehicles/monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '150000', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. However, with a little tender loving care it will run as good a new.', '/phpmotors/images/vehicles/mechanic.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '100', 1, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a superhero? Now you can with the bat mobile. This car allows you to switch to bike mode allowing for easy maneuvering through traffic during rush hour.', '/phpmotors/images/vehicles/batmobile.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '65000', 1, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of their 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/vehicles/mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '10000', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000-gallon tank.', '/phpmotors/images/vehicles/fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '50000', 1, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equipped with the siren which is convenient for college students running late to class.', '/phpmotors/images/vehicles/crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '10000', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the car you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/vehicles/camaro.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '25000', 10, 'Silver', 3),
(11, 'Cadillac', 'Escalade', 'This styling car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/vehicles/escalade.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '75195', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go off-roading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/vehicles/hummer.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '58800', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rush hour traffic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get this one while it lasts!', '/phpmotors/images/vehicles/aerocar.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '1000000', 1, 'Red', 2),
(14, 'FBI', 'Surveillance Van', 'Do you like police shows? You will feel right at home driving this van. Comes complete with surveillance equipment for an extra fee of $2,000 a month.', '/phpmotors/images/vehicles/van.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '20000', 1, 'Green', 1),
(15, 'Dog', 'Car', 'Do you like dogs? Well, this car is for you straight from the 90s from Aspen, Colorado we have the original Dog Car complete with fluffy ears.', '/phpmotors/images/vehicles/dog-car.jpg', '/phpmotors/images/vehicles/dog-car-tn.jpg', '35000', 1, 'Brown', 2),
(20, 'AUBURN', '12 160A', 'This outstanding classic is great for collecting, cruising, or staring up into the night sky with its convertible roof. Enjoy summer evenings in the 1930&#39;s way!', '/phpmotors/images/vehicles/auburn.jpg', '/phpmotors/images/vehicles/auburn-tn.jpg', '258415', 1, 'Blue', 9),
(21, 'Oldsmobile', 'Alero', 'In need of secret speed? This car will travel much faster than you think. But beware, you may make more trips to the mechanic than you think, too.', '/phpmotors/images/vehicles/alero.jpg', '/phpmotors/images/vehicles/alero-tn.jpg', '1000', 1, 'Silver', 9),
(22, 'Oscar Meyer©', 'Wienermobile©', 'Want to be invited to every BBQ in the neighborhood? Want to bring some flavor to your next road-trip? For the right price, this hot dog could be yours!', '/phpmotors/images/vehicles/wienermobile.jpg', '/phpmotors/images/vehicles/wienermobile-tn.jpg', '60000', 1, 'Mustard yellow', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `invId` int(11) NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(14, 'Love this car!', '2021-12-04 16:12:04', 2, 1),
(15, 'This car is deceivingly fast!', '2021-12-04 16:58:52', 21, 3),
(17, 'I&#39;ve always wanted to drive one of these. Love it!', '2021-12-04 17:42:20', 3, 3),
(18, 'Super fast! Hard to hold onto.', '2021-12-04 17:48:17', 3, 1),
(22, 'Used to be my high school car. This&#39; car&#39;s description is no lie!', '2021-12-04 17:52:56', 21, 2),
(24, 'Perfect for an off-roading adventure!', '2021-12-04 17:54:07', 1, 2),
(26, 'Went on an off-roading date in this Jeep. Never regretted it since! This Jeep is outstanding!', '2021-12-05 11:25:04', 1, 1),
(27, 'Not my first choice of a truck, but I reckon it&#39;ll get you places!', '2021-12-05 18:05:46', 4, 10),
(28, 'Grandma had a car like that once. I&#39;m always ready for a mechanical challenge!', '2021-12-05 11:33:54', 5, 1),
(29, 'What a high flyer!', '2021-12-05 18:42:21', 13, 1),
(33, 'I love the slick design.', '2021-12-05 12:44:35', 21, 1),
(34, 'I love the creativity behind this car!', '2021-12-11 14:28:52', 15, 1),
(36, 'Awesome car for a speeding adventure!', '2021-12-11 11:21:11', 6, 1),
(38, 'Great for water fights, especially in winter!', '2021-12-11 14:43:01', 8, 9),
(39, 'Awesome car!', '2021-12-11 14:41:49', 9, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`),
  ADD UNIQUE KEY `clientEmail` (`clientEmail`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_reviews_clients` (`clientId`),
  ADD KEY `FK_reviews_inventory` (`invId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
