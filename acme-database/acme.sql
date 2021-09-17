-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2019 at 03:35 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acme`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(10) UNSIGNED NOT NULL,
  `categoryName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Category classifications of inventory items';

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`) VALUES
(1, 'Cannon'),
(2, 'Explosive'),
(3, 'Misc'),
(4, 'Rocket'),
(5, 'Trap'),
(19, 'Balloon');

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
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comments`) VALUES
(7, 'Destyni', 'Prairie', 'doggo@cat.com', '$2y$10$Ms//NmNIVltTixdnD5iJJO.FI2MNpAb52ujtpCe4W6F4BxCAJKLKC', '1', ''),
(8, 'Dow', 'Shirley', 'dmac@apples.com', '$2y$10$br48rsy5AWt0OVvL6iqeEOe3pPGyodRPGaIEtmLiN.skJBXjUyC52', '1', ''),
(11, 'Flavora', 'Apple', 'appleflav@seeds.com', '$2y$10$cxSo3UoXmmGKUtS71SoAMejkgUXeR30CkGoVn6GpzJxZTmWfC4NGO', '1', ''),
(12, 'Destyni', 'Prairie', 'admin@acme.net', '$2y$10$DkBA1w/wne1BJ9x4aFOT/eoS7ID9cd/Q3zw8fCklh2WLMEP4MmH5e', '3', ''),
(14, 'Test', 'User', 'testuser@test.com', '$2y$10$Wyzeyo5yy.G9WUY2i5sFB.tKTyOUZXAnmr1qxy0T3yBtqHx7LmxKe', '1', ''),
(15, 'Nala', 'Prairie', 'doggo@woof.com', '$2y$10$iH8WBibU6EbU5GyxKpROiOSuGLZOjco0oLSgLxnP5Bay71aorgs5W', '1', ''),
(16, 'Lizbeth', 'Brown', 'skittlecats@gmail.com', '$2y$10$HaM17aIHpiMbUqzR82M39uKi2yModIJyLVQHnZHjQV3AIafGZFt7W', '1', ''),
(17, 'Dow', 'Shirley', 'cat@kitty.com', '$2y$10$PvW3EgXCeS8sQI9rIvg0zey276fdidobOnN1Td9YVQs8oywpK7hHq', '1', ''),
(18, 'Test', 'Fail', 'fail@testme.com', '$2y$10$BbScL7zTaCqzZhUnZzXVc.3ZpZ6SMCe1giW4I2hCSEyVUODwCGXfK', '1', ''),
(19, 'Test', 'Cookie', 'testcookie@gmail.com', '$2y$10$iUSEkJRveHuwKQ3CJhnx1uIjkk7Xz50jViM3yUdJZS3D32OcaG93.', '1', ''),
(20, 'Nala', 'Prairie', 'doggo@prairie.net', '$2y$10$Q99eoUHCznubL8PeJ6w9zukLLHOZflt2AgQoN5FRBBdtSk81tv.BK', '1', ''),
(21, 'Kaqurei', 'Nightcharm', 'skittles@sparkles.com', '$2y$10$/.SUwCYapVfrZyTerMUaHeEBsoHxA.YqS393UvMxB0JJwbpc923Wq', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) NOT NULL,
  `imgPath` varchar(150) NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`) VALUES
(3, 1, 'rocket.png', '/acme/images/products/rocket.png', '2019-11-27 20:34:36'),
(4, 1, 'rocket-tn.png', '/acme/images/products/rocket-tn.png', '2019-11-27 20:34:36'),
(5, 2, 'mortar.jpg', '/acme/images/products/mortar.jpg', '2019-11-27 20:35:07'),
(6, 2, 'mortar-tn.jpg', '/acme/images/products/mortar-tn.jpg', '2019-11-27 20:35:07'),
(7, 3, 'catapult.png', '/acme/images/products/catapult.png', '2019-11-27 20:35:31'),
(8, 3, 'catapult-tn.png', '/acme/images/products/catapult-tn.png', '2019-11-27 20:35:31'),
(9, 4, 'roadrunner.jpg', '/acme/images/products/roadrunner.jpg', '2019-11-27 20:35:44'),
(10, 4, 'roadrunner-tn.jpg', '/acme/images/products/roadrunner-tn.jpg', '2019-11-27 20:35:44'),
(15, 5, 'trap.jpg', '/acme/images/products/trap.jpg', '2019-11-27 20:47:39'),
(16, 5, 'trap-tn.jpg', '/acme/images/products/trap-tn.jpg', '2019-11-27 20:47:39'),
(17, 6, 'hole.png', '/acme/images/products/hole.png', '2019-11-27 21:26:23'),
(18, 6, 'hole-tn.png', '/acme/images/products/hole-tn.png', '2019-11-27 21:26:23'),
(19, 7, 'no-image.png', '/acme/images/products/no-image.png', '2019-11-27 21:26:49'),
(20, 7, 'no-image-tn.png', '/acme/images/products/no-image-tn.png', '2019-11-27 21:26:49'),
(21, 8, 'anvil.png', '/acme/images/products/anvil.png', '2019-11-27 21:27:05'),
(22, 8, 'anvil-tn.png', '/acme/images/products/anvil-tn.png', '2019-11-27 21:27:05'),
(23, 9, 'rubberband.jpg', '/acme/images/products/rubberband.jpg', '2019-11-27 21:27:32'),
(24, 9, 'rubberband-tn.jpg', '/acme/images/products/rubberband-tn.jpg', '2019-11-27 21:27:32'),
(25, 10, 'mallet.png', '/acme/images/products/mallet.png', '2019-11-27 21:27:45'),
(26, 10, 'mallet-tn.png', '/acme/images/products/mallet-tn.png', '2019-11-27 21:27:45'),
(27, 11, 'tnt.png', '/acme/images/products/tnt.png', '2019-11-27 21:27:59'),
(28, 11, 'tnt-tn.png', '/acme/images/products/tnt-tn.png', '2019-11-27 21:27:59'),
(29, 12, 'seed.jpg', '/acme/images/products/seed.jpg', '2019-11-27 21:28:10'),
(30, 12, 'seed-tn.jpg', '/acme/images/products/seed-tn.jpg', '2019-11-27 21:28:10'),
(31, 13, 'piano.jpg', '/acme/images/products/piano.jpg', '2019-11-27 21:28:40'),
(32, 13, 'piano-tn.jpg', '/acme/images/products/piano-tn.jpg', '2019-11-27 21:28:40'),
(33, 14, 'helmet.png', '/acme/images/products/helmet.png', '2019-11-27 21:29:02'),
(34, 14, 'helmet-tn.png', '/acme/images/products/helmet-tn.png', '2019-11-27 21:29:02'),
(35, 15, 'rope.jpg', '/acme/images/products/rope.jpg', '2019-11-27 21:29:20'),
(36, 15, 'rope-tn.jpg', '/acme/images/products/rope-tn.jpg', '2019-11-27 21:29:20'),
(37, 16, 'bomb.png', '/acme/images/products/bomb.png', '2019-11-27 21:29:37'),
(38, 16, 'bomb-tn.png', '/acme/images/products/bomb-tn.png', '2019-11-27 21:29:37'),
(39, 27, 'bubbles.jpg', '/acme/images/products/bubbles.jpg', '2019-11-27 21:30:50'),
(40, 27, 'bubbles-tn.jpg', '/acme/images/products/bubbles-tn.jpg', '2019-11-27 21:30:50'),
(41, 29, 'beartrap.jpg', '/acme/images/products/beartrap.jpg', '2019-11-27 21:37:25'),
(42, 29, 'beartrap-tn.jpg', '/acme/images/products/beartrap-tn.jpg', '2019-11-27 21:37:25'),
(43, 13, 'piano2.jpg', '/acme/images/products/piano2.jpg', '2019-12-01 02:49:50'),
(44, 13, 'piano2-tn.jpg', '/acme/images/products/piano2-tn.jpg', '2019-12-01 02:49:50'),
(45, 27, 'bubbles2.png', '/acme/images/products/bubbles2.png', '2019-12-01 03:10:46'),
(46, 27, 'bubbles2-tn.png', '/acme/images/products/bubbles2-tn.png', '2019-12-01 03:10:46');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invName` varchar(50) NOT NULL DEFAULT '',
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL DEFAULT '',
  `invThumbnail` varchar(50) NOT NULL DEFAULT '',
  `invPrice` decimal(10,2) NOT NULL DEFAULT 0.00,
  `invStock` smallint(6) NOT NULL DEFAULT 0,
  `invSize` smallint(6) NOT NULL DEFAULT 0,
  `invWeight` smallint(6) NOT NULL DEFAULT 0,
  `invLocation` varchar(35) NOT NULL DEFAULT '',
  `categoryId` int(10) UNSIGNED NOT NULL,
  `invVendor` varchar(20) NOT NULL DEFAULT '',
  `invStyle` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Acme Inc. Inventory Table';

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invName`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invSize`, `invWeight`, `invLocation`, `categoryId`, `invVendor`, `invStyle`) VALUES
(1, 'Acme Rocket', 'The Acme Rocket meets multiple purposes. This can be launched independently to deliver a payload or strapped on to help get you to where you want to be FAST!!! Really Fast! Launch stand is included.', '/acme/images/products/rocket.png', '/acme/images/products/rocket-tn.png', '132000.00', 5, 60, 90, 'Albuquerque, New Mexico', 4, 'Goddard', 'metal'),
(2, 'Mortar', 'Our Mortar is very powerful. This cannon can launch a projectile or bomb 3 miles. Made of solid steel and mounted on cement or metal stands [not included].', '/acme/images/products/mortar.jpg', '/acme/images/products/mortar-tn.jpg', '1500.00', 26, 250, 750, 'San Jose', 1, 'Smith & Wesson', 'Metal'),
(3, 'Catapult', 'Our best wooden catapult. Ideal for hurling objects for up to 1000 yards. Payloads of up to 300 lbs.', '/acme/images/products/catapult.png', '/acme/images/products/catapult-tn.png', '2500.00', 4, 1569, 400, 'Cedar Point, IO', 1, 'Wooden Creations', 'Wood'),
(4, 'Female RoadRunner Cutout', 'This carbon fiber backed cutout of a female roadrunner is sure to catch the eye of any male roadrunner.', '/acme/images/products/roadrunner.jpg', '/acme/images/products/roadrunner-tn.jpg', '20.00', 500, 27, 2, 'San Jose', 5, 'Picture Perfect', 'Carbon Fiber'),
(5, 'Giant Mouse Trap', 'Our big mouse trap. This trap is multifunctional. It can be used to catch dogs, mountain lions, road runners or even muskrats. Must be staked for larger varmints [stakes not included] and baited with approptiate bait [sold seperately].\r\n', '/acme/images/products/trap.jpg', '/acme/images/products/trap-tn.jpg', '20.00', 34, 470, 28, 'Cedar Point, IO', 5, 'Rodent Control', 'Wood'),
(6, 'Instant Hole', 'Instant hole - Wonderful for creating the appearance of openings.', '/acme/images/products/hole.png', '/acme/images/products/hole-tn.png', '25.00', 269, 24, 2, 'San Jose', 3, 'Hidden Valley', 'Ether'),
(7, 'Koenigsegg CCX Car', 'This high performance car is sure to get you where you are going fast. It holds the production car land speed record at an amazing 250mph.', '/acme/images/products/no-image.png', '/acme/images/products/no-image.png', '99999999.99', 1, 25000, 3000, 'Stockholm, Sweden', 3, 'Koenigsegg', 'Metal'),
(8, 'Steel Anvil', '50 lb. Anvil - perfect for any task requireing lots of weight. Made of solid, tempered steel.', '/acme/images/products/anvil.png', '/acme/images/products/anvil-tn.png', '150.00', 12, 80, 50, 'San Jose', 5, 'Steel Made', 'Metal'),
(9, 'Monster Rubber Band', 'These are not tiny rubber bands. These are MONSTERS! These bands can stop a train locamotive or be used as a slingshot for cows. Only the best materials are used!', '/acme/images/products/rubberband.jpg', '/acme/images/products/rubberband-tn.jpg', '4.00', 4589, 75, 1, 'Cedar Point, IO', 3, 'Rubbermaid', 'Rubber'),
(10, 'Mallet', 'Ten pound mallet for bonking roadrunners on the head. Can also be used for bunny rabbits.', '/acme/images/products/mallet.png', '/acme/images/products/mallet-tn.png', '25.00', 100, 36, 10, 'Cedar Point, IA', 3, 'Wooden Creations', 'Wood'),
(11, 'TNT', 'The biggest bang for your buck with our nitro-based TNT. Price is per stick.', '/acme/images/products/tnt.png', '/acme/images/products/tnt-tn.png', '10.00', 1000, 25, 2, 'San Jose', 2, 'Nobel Enterprises', 'Plastic'),
(12, 'Custom Bird Seed Mix', 'Our best varmint seed mix - varmints on two or four legs cannot resist this mix. Contains meat, nuts, cereals and our own special ingredient. Guaranteed to bring them in. Can be used with our monster trap.', '/acme/images/products/seed.jpg', '/acme/images/products/seed-tn.jpg', '8.00', 150, 24, 3, 'San Jose', 5, 'Acme', 'Plastic'),
(13, 'Grand Piano', 'This upright grand piano is guaranteed to play well and smash anything beneath it if dropped from a height.', '/acme/images/products/piano.jpg', '/acme/images/products/piano-tn.jpg', '3500.00', 36, 500, 1200, 'Cedar Point, IA', 3, 'Wulitzer', 'Wood'),
(14, 'Crash Helmet', 'This carbon fiber and plastic helmet is the ultimate in protection for your head. comes in assorted colors.', '/acme/images/products/helmet.png', '/acme/images/products/helmet-tn.png', '100.00', 25, 48, 9, 'San Jose', 3, 'Suzuki', 'Carbon Fiber'),
(15, 'Nylon Rope', 'This nylon rope is ideal for all uses. Each rope is the highest quality nylon and comes in 100 foot lengths.', '/acme/images/products/rope.jpg', '/acme/images/products/rope-tn.jpg', '15.00', 200, 200, 6, 'San Jose', 3, 'Marina Sales', 'Nylon'),
(16, 'Small Bomb', 'Bomb with a fuse - A little old fashioned, but highly effective. This bomb has the ability to devistate anything within 30 feet.', '/acme/images/products/bomb.png', '/acme/images/products/bomb-tn.png', '275.00', 58, 30, 12, 'San Jose', 2, 'Nobel Enterprises', 'Metal'),
(23, 'Water Balloon', 'A large water balloon for distracting road runners.', '/acme/images/products/no-image.png', '/acme/images/products/no-image.png', '12.00', 1, 2, 12, 'Kansas', 19, 'Dorothy', 'Water'),
(26, 'Big Joe', 'The largest cannon in store', '/acme/images/products/no-image.png', '/acme/images/products/no-image.png', '22.00', 23, 29, 749, 'Big Joe&#39;s Market', 1, 'Big Joe', 'Paper'),
(27, 'Rainbow Bubbles', 'Distracting bubbles of every color in the rainbow.', '/acme/images/products/bubbles.jpg', '/acme/images/products/bubbles-tn.jpg', '22.00', 12, 12, 19, 'Over the Rainbow', 19, 'Alberto Fu', 'Water'),
(29, 'Bear Trap', 'A little excessive, don&#39;t you think?', '/acme/images/products/beartrap.jpg', '/acme/images/products/beartrap.jpg', '27.00', 20, 3, 1, 'Big Joe&#39;s Market', 5, 'Big Joe', 'Metal');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `invId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(5, 'WOW! Really does include every color of the rainbow! I&#39;m so impressed!', '2019-12-12 18:23:42', 27, 12),
(6, 'Really packs a punch! Will buy again!', '2019-12-12 18:24:24', 2, 12),
(8, 'Now that&#39;s what I call a rocket! Super fast!', '2019-12-12 18:27:58', 1, 12),
(11, 'Good bang for my buck.', '2019-12-13 04:46:00', 11, 12),
(12, 'What a bang! I got what I paid for!', '2019-12-13 04:57:29', 11, 16),
(13, 'It&#39;s truly bottomless!', '2019-12-13 04:57:45', 6, 16),
(14, 'Fastest rocket I&#39;ve ever seen! Roadrunners don&#39;t stand a chance!', '2019-12-13 04:58:09', 1, 16),
(16, 'great product!', '2019-12-17 01:48:17', 3, 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `FK_inv_image` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `categoryId` (`categoryId`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_image` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `FK_inv_categories` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

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
