-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: db.cs.dal.ca
-- Generation Time: Oct 22, 2022 at 09:24 PM
-- Server version: 10.3.21-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mahindru`
--

-- --------------------------------------------------------

--
-- Table structure for table `Clients022`
--

CREATE TABLE `Clients022` (
  `clientID022` int(11) NOT NULL,
  `clientName022` varchar(45) DEFAULT NULL,
  `clientCity022` varchar(45) DEFAULT NULL,
  `clientCompPassword022` varchar(45) DEFAULT NULL,
  `dollarsOnOrder022` decimal(6,2) DEFAULT NULL,
  `moneyOwed022` decimal(6,2) DEFAULT NULL,
  `clientStatus022` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Clients022`
--

INSERT INTO `Clients022` (`clientID022`, `clientName022`, `clientCity022`, `clientCompPassword022`, `dollarsOnOrder022`, `moneyOwed022`, `clientStatus022`) VALUES
(1, 'Pranav Mahindru', 'Halifax', 'blah123', '750.00', '0.00', 'InActive'),
(2, 'Ritik Roshan', 'Delhi', 'blahb456', '0.00', '159.98', 'InActive'),
(3, 'Rajiv Kumar', 'Georgia', 'blah678', '4270.01', '0.00', 'InActive'),
(4, 'Indu Arora', 'Toronto', 'blah910', '5700.00', '0.00', 'Active'),
(5, 'Alex Tylor', 'Ottawa', 'blah112', '0.00', '500.00', 'InActive'),
(6, 'dr.br rao', 'halifax', 'blash727', '2000.00', '0.00', 'InActive'),
(7, 'David ', 'Georgia', 'blah23221', '1070.01', '0.00', 'InActive'),
(8, 'Shubham', 'punjab', 'asdowni239', '234.13', '0.00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `Lines022`
--

CREATE TABLE `Lines022` (
  `lineNo022` int(11) NOT NULL,
  `poNo022` int(11) NOT NULL,
  `partNo022` int(11) NOT NULL,
  `priceOrdered022` decimal(6,2) DEFAULT NULL,
  `QoH022` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Lines022`
--

INSERT INTO `Lines022` (`lineNo022`, `poNo022`, `partNo022`, `priceOrdered022`, `QoH022`) VALUES
(1, 1, 1, '100.00', 2),
(2, 1, 3, '129.99', 2),
(3, 2, 2, '150.00', 1),
(4, 2, 3, '129.99', 1),
(5, 2, 4, '200.00', 1),
(6, 2, 5, '200.00', 1),
(7, 2, 7, '50.00', 1),
(8, 3, 1, '100.00', 1),
(9, 3, 2, '150.00', 1),
(10, 4, 1, '100.00', 1),
(11, 4, 2, '150.00', 2),
(12, 4, 3, '129.99', 1),
(13, 4, 4, '200.00', 1),
(14, 4, 5, '200.00', 1),
(15, 5, 1, '100.00', 1),
(16, 5, 4, '200.00', 2),
(17, 5, 6, '400.00', 2);

--
-- Triggers `Lines022`
--
DELIMITER $$
CREATE TRIGGER `Lines022_AFTER_INSERT` AFTER INSERT ON `Lines022` FOR EACH ROW BEGIN
    UPDATE
        Clients022
    SET
        Clients022.moneyOwed022 = Clients022.moneyOwed022 +(
            NEW.priceOrdered022 * NEW.QoH022
        )
    WHERE
        Clients022.clientID022 =(
        SELECT
            clientID022
        FROM
            POs022
        WHERE
            POs022.poNo022 = NEW.poNo022
    ) ;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Parts022`
--

CREATE TABLE `Parts022` (
  `partNo022` int(11) NOT NULL,
  `partName022` varchar(45) DEFAULT NULL,
  `partDescription022` varchar(45) DEFAULT NULL,
  `partImgs022` varchar(45) DEFAULT NULL,
  `currentPrice022` decimal(6,2) DEFAULT NULL,
  `QoH022` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Parts022`
--

INSERT INTO `Parts022` (`partNo022`, `partName022`, `partDescription022`, `partImgs022`, `currentPrice022`, `QoH022`) VALUES
(1, 'Nike AirMax', 'Nike Shoes', 'NikeShoes.png', '100.00', 24),
(2, 'Nike Sportswear', 'Nike T-shirt', 'NikeT-shirt.png', '150.00', 24),
(3, 'Adidas Classics', 'Adidas T-shirt', 'AdidasT-shirt.png', '129.99', 25),
(4, 'Adidas Edge', 'Adidas Shoes', 'AdidasShoes.png', '200.00', 22),
(5, 'Nike Sports Shoes', 'Sports Shoes', 'NikeSportsShoes.png', '200.00', 28),
(6, 'classic football', 'classic football for junior player', 'classicfootball.png', '400.00', 26),
(7, 'Badminton Rackets', 'Badminton Rackets Yonex', 'BadmintonRackets.png', '50.00', 29);

-- --------------------------------------------------------

--
-- Table structure for table `POs022`
--

CREATE TABLE `POs022` (
  `poNo022` int(11) NOT NULL,
  `clientID022` int(11) NOT NULL,
  `dateOfPO022` datetime DEFAULT NULL,
  `status022` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `POs022`
--

INSERT INTO `POs022` (`poNo022`, `clientID022`, `dateOfPO022`, `status022`) VALUES
(1, 2, '2022-10-22 19:32:51', 'pending'),
(2, 3, '2022-10-22 19:35:08', 'pending'),
(3, 1, '2022-10-22 19:38:09', 'pending'),
(4, 7, '2022-10-22 20:46:12', 'pending'),
(5, 4, '2022-10-22 21:13:01', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `user_select_parts022`
--

CREATE TABLE `user_select_parts022` (
  `ID022` int(11) NOT NULL,
  `clientID022` int(11) NOT NULL,
  `partNo022` int(11) NOT NULL,
  `user_count` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Clients022`
--
ALTER TABLE `Clients022`
  ADD PRIMARY KEY (`clientID022`);

--
-- Indexes for table `Lines022`
--
ALTER TABLE `Lines022`
  ADD PRIMARY KEY (`lineNo022`,`poNo022`,`partNo022`),
  ADD KEY `poNo022` (`poNo022`),
  ADD KEY `partNo022` (`partNo022`);

--
-- Indexes for table `Parts022`
--
ALTER TABLE `Parts022`
  ADD PRIMARY KEY (`partNo022`),
  ADD UNIQUE KEY `partNo022_UNIQUE` (`partNo022`);

--
-- Indexes for table `POs022`
--
ALTER TABLE `POs022`
  ADD PRIMARY KEY (`poNo022`),
  ADD UNIQUE KEY `poNo022_UNIQUE` (`poNo022`),
  ADD KEY `clientID022` (`clientID022`);

--
-- Indexes for table `user_select_parts022`
--
ALTER TABLE `user_select_parts022`
  ADD PRIMARY KEY (`ID022`),
  ADD KEY `clientID022_add` (`clientID022`),
  ADD KEY `partNO022_add` (`partNo022`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Clients022`
--
ALTER TABLE `Clients022`
  MODIFY `clientID022` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Lines022`
--
ALTER TABLE `Lines022`
  MODIFY `lineNo022` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `Parts022`
--
ALTER TABLE `Parts022`
  MODIFY `partNo022` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `POs022`
--
ALTER TABLE `POs022`
  MODIFY `poNo022` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_select_parts022`
--
ALTER TABLE `user_select_parts022`
  MODIFY `ID022` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Lines022`
--
ALTER TABLE `Lines022`
  ADD CONSTRAINT `partNo022` FOREIGN KEY (`partNo022`) REFERENCES `Parts022` (`partNo022`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `poNo022` FOREIGN KEY (`poNo022`) REFERENCES `POs022` (`poNo022`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `POs022`
--
ALTER TABLE `POs022`
  ADD CONSTRAINT `clientID022` FOREIGN KEY (`clientID022`) REFERENCES `Clients022` (`clientID022`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_select_parts022`
--
ALTER TABLE `user_select_parts022`
  ADD CONSTRAINT `clientID022_add` FOREIGN KEY (`clientID022`) REFERENCES `Clients022` (`clientID022`),
  ADD CONSTRAINT `partNO022_add` FOREIGN KEY (`partNo022`) REFERENCES `Parts022` (`partNo022`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
