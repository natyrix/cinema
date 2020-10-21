-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 21, 2020 at 11:40 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `cinetest_cinema`
--

CREATE TABLE `cinetest_cinema` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` longtext,
  `img_location` varchar(100) NOT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `deleted_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `cinetest_guest`
--

CREATE TABLE `cinetest_guest` (
  `id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `deleted_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `cinetest_movie`
--

CREATE TABLE `cinetest_movie` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `img_location` varchar(100) NOT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `deleted_at` datetime(6) DEFAULT NULL,
  `cinema_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `cinetest_price`
--

CREATE TABLE `cinetest_price` (
  `id` int(11) NOT NULL,
  `price` double NOT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `deleted_at` datetime(6) DEFAULT NULL,
  `cinema_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `cinetest_reservations`
--

CREATE TABLE `cinetest_reservations` (
  `id` int(11) NOT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `deleted_at` datetime(6) DEFAULT NULL,
  `guest_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
  `is_valid` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `cinetest_schedule`
--

CREATE TABLE `cinetest_schedule` (
  `id` int(11) NOT NULL,
  `start_time` varchar(10) NOT NULL,
  `end_time` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `deleted_at` datetime(6) DEFAULT NULL,
  `cinema_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `cinetest_seat`
--

CREATE TABLE `cinetest_seat` (
  `id` int(11) NOT NULL,
  `seat_no` varchar(11) NOT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `deleted_at` datetime(6) DEFAULT NULL,
  `price_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `cinetest_cinema`
--
ALTER TABLE `cinetest_cinema`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cinetest_guest`
--
ALTER TABLE `cinetest_guest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cinetest_movie`
--
ALTER TABLE `cinetest_movie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cinetest_movie_cinema_id_02621af8_fk_cinetest_cinema_id` (`cinema_id`);

--
-- Indexes for table `cinetest_price`
--
ALTER TABLE `cinetest_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cinetest_price_cinema_id_e7bb5789_fk_cinetest_cinema_id` (`cinema_id`);

--
-- Indexes for table `cinetest_reservations`
--
ALTER TABLE `cinetest_reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cinetest_reservations_guest_id_91e06604_fk_cinetest_guest_id` (`guest_id`),
  ADD KEY `cinetest_reservation_schedule_id_d8605d88_fk_cinetest_` (`schedule_id`),
  ADD KEY `cinetest_reservations_seat_id_eade2fad_fk_cinetest_seat_id` (`seat_id`);

--
-- Indexes for table `cinetest_schedule`
--
ALTER TABLE `cinetest_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cinetest_schedule_cinema_id_864168a4_fk_cinetest_cinema_id` (`cinema_id`),
  ADD KEY `cinetest_schedule_movie_id_fb0c3bbe_fk_cinetest_movie_id` (`movie_id`);

--
-- Indexes for table `cinetest_seat`
--
ALTER TABLE `cinetest_seat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cinetest_seat_price_id_af7e45ab_fk_cinetest_price_id` (`price_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cinetest_cinema`
--
ALTER TABLE `cinetest_cinema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cinetest_guest`
--
ALTER TABLE `cinetest_guest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cinetest_movie`
--
ALTER TABLE `cinetest_movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cinetest_price`
--
ALTER TABLE `cinetest_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cinetest_reservations`
--
ALTER TABLE `cinetest_reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cinetest_schedule`
--
ALTER TABLE `cinetest_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `cinetest_seat`
--
ALTER TABLE `cinetest_seat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cinetest_movie`
--
ALTER TABLE `cinetest_movie`
  ADD CONSTRAINT `cinetest_movie_cinema_id_02621af8_fk_cinetest_cinema_id` FOREIGN KEY (`cinema_id`) REFERENCES `cinetest_cinema` (`id`);

--
-- Constraints for table `cinetest_price`
--
ALTER TABLE `cinetest_price`
  ADD CONSTRAINT `cinetest_price_cinema_id_e7bb5789_fk_cinetest_cinema_id` FOREIGN KEY (`cinema_id`) REFERENCES `cinetest_cinema` (`id`);

--
-- Constraints for table `cinetest_reservations`
--
ALTER TABLE `cinetest_reservations`
  ADD CONSTRAINT `cinetest_reservation_schedule_id_d8605d88_fk_cinetest_` FOREIGN KEY (`schedule_id`) REFERENCES `cinetest_schedule` (`id`),
  ADD CONSTRAINT `cinetest_reservations_guest_id_91e06604_fk_cinetest_guest_id` FOREIGN KEY (`guest_id`) REFERENCES `cinetest_guest` (`id`),
  ADD CONSTRAINT `cinetest_reservations_seat_id_eade2fad_fk_cinetest_seat_id` FOREIGN KEY (`seat_id`) REFERENCES `cinetest_seat` (`id`);

--
-- Constraints for table `cinetest_schedule`
--
ALTER TABLE `cinetest_schedule`
  ADD CONSTRAINT `cinetest_schedule_cinema_id_864168a4_fk_cinetest_cinema_id` FOREIGN KEY (`cinema_id`) REFERENCES `cinetest_cinema` (`id`),
  ADD CONSTRAINT `cinetest_schedule_movie_id_fb0c3bbe_fk_cinetest_movie_id` FOREIGN KEY (`movie_id`) REFERENCES `cinetest_movie` (`id`);

--
-- Constraints for table `cinetest_seat`
--
ALTER TABLE `cinetest_seat`
  ADD CONSTRAINT `cinetest_seat_price_id_af7e45ab_fk_cinetest_price_id` FOREIGN KEY (`price_id`) REFERENCES `cinetest_price` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
