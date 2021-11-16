-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 12, 2021 at 02:29 PM
-- Server version: 5.7.32
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `transformers`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `original_filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `filename`, `original_filename`) VALUES
(19, 'ddb3e9f528a8d2bbe8d08fa66dd6a1bffc72719f.png', 'Schermafbeelding 2021-09-01 om 14.52.30.png'),
(20, '6d612edcf613d614e705210ca04bfc31fe5665c1.png', 'Schermafbeelding 2021-06-07 om 15.36.19.png'),
(21, 'f6029998f5b17af6e7cadf0d39d2cd4ada52891d.png', 'Schermafbeelding 2021-05-31 om 11.32.37 (2).png'),
(22, 'f6029998f5b17af6e7cadf0d39d2cd4ada52891d.png', 'Schermafbeelding 2021-05-31 om 11.32.37 (2).png'),
(23, '83537307a6290b14ecc26aa9152bf046a95d2168.png', 'Schermafbeelding 2021-05-31 om 11.32.48.png'),
(24, '5e0cb8e45709434de3f281b7f645dc838ae0826e.jpeg', 'Space.jpeg'),
(25, '883f201d9bc74fe6500091fdf3ba9ec5eefe4c89.jpeg', 'Tree.jpeg'),
(26, '883f201d9bc74fe6500091fdf3ba9ec5eefe4c89.jpeg', 'Tree.jpeg'),
(27, '883f201d9bc74fe6500091fdf3ba9ec5eefe4c89.jpeg', 'Tree.jpeg'),
(28, '883f201d9bc74fe6500091fdf3ba9ec5eefe4c89.jpeg', 'Tree.jpeg'),
(29, '42f475498fb14bab3d37f4b7e782ec7203eb8e46.jpeg', 'Nature.jpeg'),
(30, 'd4db7caca0ea2f996da05f4b2f0bbf6335187965.jpeg', 'Lake.jpeg'),
(31, '856ea121b741da5c7ee326a46341f64423f726e3.jpeg', 'Crying.jpeg'),
(32, '82532bfee1da66dc7207fa4d033274ed81f8d005.jpeg', 'Verdriet.jpeg'),
(33, '883f201d9bc74fe6500091fdf3ba9ec5eefe4c89.jpeg', 'Tree.jpeg'),
(34, '883f201d9bc74fe6500091fdf3ba9ec5eefe4c89.jpeg', 'Tree.jpeg'),
(35, '883f201d9bc74fe6500091fdf3ba9ec5eefe4c89.jpeg', 'Tree.jpeg'),
(36, '883f201d9bc74fe6500091fdf3ba9ec5eefe4c89.jpeg', 'Tree.jpeg'),
(37, '883f201d9bc74fe6500091fdf3ba9ec5eefe4c89.jpeg', 'Tree.jpeg'),
(38, '42f475498fb14bab3d37f4b7e782ec7203eb8e46.jpeg', 'Nature.jpeg'),
(39, 'd4db7caca0ea2f996da05f4b2f0bbf6335187965.jpeg', 'Lake.jpeg'),
(40, '856ea121b741da5c7ee326a46341f64423f726e3.jpeg', 'Crying.jpeg'),
(41, '5e0cb8e45709434de3f281b7f645dc838ae0826e.jpeg', 'Space.jpeg'),
(42, '7d3e19325af1083a6cec486aaa9b427c809fe1ae.jpeg', 'Klusser.jpeg'),
(43, '38652e546a014da1ec34955b7802ec7b6146d018.jpeg', 'Moeder.jpeg'),
(44, 'a8ab44f863647c3689c8de7fac27aca54dd822a4.jpeg', 'Verhaal.jpeg'),
(45, 'ccd6eee5d31ce9e8fbe8c01b6fda84b97d6ec86b.jpeg', 'Meisje.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `image` varchar(255) NOT NULL,
  `title` varchar(30) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`image`, `title`, `id`) VALUES
('997dc422a3ba1a84ff0597b5fafe3af0af247873.jpg', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `text`
--

CREATE TABLE `text` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `title`, `description`, `image_id`, `user_id`) VALUES
(20, 'Hulp met een nieuwe familie', 'Dit is mijn verhaal', 30, 57),
(21, 'Mijn vriendin heeft mij verlaten', 'Wat moet ik nu?', 31, 57),
(22, 'Hoe ga ik om met verdriet', 'Dit is al een tijdje mijn probleem...', 32, 57),
(26, 'Help mijn broer', 'Dit is mijn schreeuw voor hulp.', 40, 59),
(29, 'Hoe help ik mijn moeder', 'Dit is mijn verhaal...', 43, 59),
(30, 'Hoe zorg ik voor mezelf', 'Dit is mijn verhaal..', 44, 59),
(31, 'Help mijn zusje', 'Dit is mijn verhaal', 45, 60);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `code` varchar(32) DEFAULT NULL,
  `password_reset` varchar(32) DEFAULT NULL,
  `admin` int(11) NOT NULL DEFAULT '0',
  `voornaam` varchar(255) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `original_filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `code`, `password_reset`, `admin`, `voornaam`, `achternaam`, `filename`, `original_filename`) VALUES
(20, 'raphael@itc-groep.nl', '$2y$10$f1s35F6aggfhiyyjcN2jleWBnNUBwOgks5zcFNEeP3GLbvn.MlkAW', '362c883c56873f106ab165ab20ef55fe', '', 0, '', '', '', ''),
(42, 'raphael@rebelletjes.nl', '$2y$10$.Nh9Imc8BATDNJritm4ASuagke9pihm4zXPcz3FMefVLXbVOgRd1C', NULL, '', 0, '', '', '', ''),
(45, 'rap@bap.nl', '$2y$10$2beTOGiCyf1akMMxUWNRQuvswE3JVRWSvNvu2CjD2hQoExc7GVMhy', '98815ee011840c47607ac30861bf9922', NULL, 0, '', '', '', ''),
(47, 'henkpiet@email.com', '$2y$10$tAK7d3j/4Hz2LxozQXO7GOlsuix0SOm3KjQuh24.wAz1kSGMloZhu', NULL, NULL, 0, 'piet', 'henk', '', ''),
(48, 'reb@reb.nl', '$2y$10$L.a9ioKu4MnUsfbIfNi/1uPFOpzjTfafJSKfmx0Jc0p3RkoPcsGze', 'f9728f600e4cbfb8d7b4ec5a5f3a2173', NULL, 0, 'Raphael', 'Rebel', '', ''),
(51, 'reb@live.com', '$2y$10$wSpEh6eUYtRV.h/.hmoZu.TVrhTd.kF6Ak25YI0ANZE88llXAmCOa', NULL, NULL, 0, 'raphael', 'rebel', '', ''),
(52, 'rrr@rrr.nl', '$2y$10$8NlbH54eWTNoG4M1N3Js/e7jRTUoT./iKBvv4njLwfLoqUT1PS3aq', '7ed3e0f64c73ffce0c925a20f9d397f2', NULL, 0, 'rrr', 'rrr', '', ''),
(53, 'danny@mail.com', '$2y$10$zRhgawmWiRPvJP9xyryPSessZMeYN.qmeC7i4Q5UVe586QFSlgxJ2', 'eea7a055d63ae7acf693a304b0fe3aa2', NULL, 0, 'Danny', 'van der Zwart', '', ''),
(55, 'jaa@jan.nl', '$2y$10$8x3alFPCybg99MkFitD2ZeQLzJdPUBozq2BTHPc3l8vguv1eNr1SG', '6ad2099da2e4591ab1cc747369f39329', NULL, 0, 'Raphael', 'rebel', '', ''),
(56, 'ra@rebel.nl', '$2y$10$mwT.bJXcEbt.aRX7vj1THOPji/CqOPHzuc6..mD3TdnedMwupJt5a', '318a2ec3e435699d57177dcd5096bdac', NULL, 0, 'Raphael', 'rebel', '', ''),
(57, 'jan@henk.nl', '$2y$10$I5.SoU84FcGdXE/H31QoGuWKh/mSK6o.FaNA18VBAIsaWQ41T5USa', NULL, NULL, 0, 'Jan', 'henk', '', ''),
(58, 'jan@jan.nl', '$2y$10$/FlU5A2LHpnGVZvhEDRmEO1CedHOuyf0eaL2GsB57.4GdMZItrrIO', NULL, NULL, 0, 'jan', 'jan', '82532bfee1da66dc7207fa4d033274ed81f8d005.jpeg', 'Verdriet.jpeg'),
(59, 'raphaelrebel@live.com', '$2y$10$ks/3ssYaZUwSXxAELFXeP.0mjdDFlejpK5QrX4zGUT/2OmN3HBNP.', NULL, NULL, 1, 'Raphael', 'Rebel', '5457e2f940cd866cb935f9cf0432f43359ba8675.JPG', '91efd4a5-b72c-4710-9676-1b61f1bdb300.JPG'),
(60, 'Pieter@gmail.com', '$2y$10$A4TV29nHZcQVuxUVDdoGTOqhJQQrc5kAlw3lqLkKcXzQFgrGnNrw.', NULL, NULL, 0, 'Pieter', 'Wilsma', 'd348e63a9bcc96f78ab4ecda4203465898817891.jpeg', 'Pieter.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `text`
--
ALTER TABLE `text`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `text`
--
ALTER TABLE `text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;