-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2025 at 12:12 PM
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
-- Database: `crm_system`
--

-- --------------------------------------------------------

CREATE TABLE `crm_system`.`opportunities` (
  `id` INT(11) NOT NULL AUTO_INCREMENT , 
  `lead_id` INT(11) NOT NULL , 
  `title` TEXT NOT NULL , 
  `amount` TEXT NOT NULL , 
  `stage` TEXT NOT NULL , 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `crm_system`.`tasks` (
  `id` INT(11) NOT NULL AUTO_INCREMENT , 
  `lead_id` INT(11) NOT NULL , 
  `label` TEXT NOT NULL , 
  `description` TEXT NOT NULL , 
  `due_date` DATE NOT NULL , 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;