-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 31, 2024 at 02:48 AM
-- Server version: 8.0.26
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dev92agents`
--
CREATE DATABASE IF NOT EXISTS `dev92agents` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `dev92agents`;

-- --------------------------------------------------------

--
-- Table structure for table `agents_advertise`
--

CREATE TABLE `agents_advertise` (
  `id` int NOT NULL,
  `package_id` int NOT NULL,
  `agent_id` int NOT NULL,
  `ad_place` int NOT NULL,
  `receipt_url` mediumtext NOT NULL,
  `ad_title` varchar(40) NOT NULL,
  `ad_link` varchar(500) NOT NULL,
  `ad_banner` varchar(100) DEFAULT NULL,
  `ad_content` varchar(1000) DEFAULT NULL,
  `clicks` int NOT NULL,
  `created_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_ts` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` bit(1) NOT NULL DEFAULT b'0',
  `payment_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `agents_answers`
--

CREATE TABLE `agents_answers` (
  `answers_id` int DEFAULT NULL,
  `answers` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `question_id` int DEFAULT NULL,
  `from_id` int DEFAULT NULL,
  `from_role` int DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `post_id` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_answers`
--

INSERT INTO `agents_answers` (`answers_id`, `answers`, `question_id`, `from_id`, `from_role`, `is_deleted`, `created_at`, `updated_at`, `post_id`) VALUES
(NULL, 'hi done test', 168, 905, 4, '0', '2022-12-30 02:58:53', '2024-05-04 18:08:00', 201),
(NULL, 'hi done test', 168, 905, 4, '0', '2022-12-30 02:59:04', '2024-05-04 18:08:00', 201),
(NULL, 'hi done test', 168, 905, 4, '0', '2023-01-16 18:01:28', '2024-05-04 18:08:00', 201),
(NULL, 'hi done test', 168, 905, 4, '0', '2023-01-31 18:10:53', '2024-05-04 18:08:00', 201),
(NULL, 'hi done test', 168, 905, 4, '0', '2023-03-16 22:37:38', '2024-05-04 18:08:00', 201),
(NULL, 'hi done test', 168, 905, 4, '0', '2023-04-05 00:57:25', '2024-05-04 18:08:00', 201),
(NULL, 'hi done test', 168, 905, 4, '0', '2023-06-03 15:06:20', '2024-05-04 18:08:00', 201),
(NULL, 'hi done test', 168, 905, 4, '0', '2023-06-03 16:07:48', '2024-05-04 18:08:00', 201),
(NULL, 'hi done test', 168, 905, 4, '0', '2023-07-10 12:49:41', '2024-05-04 18:08:00', 201),
(NULL, 'hi done test', 168, 905, 4, '0', '2023-07-19 12:49:02', '2024-05-04 18:08:00', 201),
(NULL, 'hi done test', 168, 905, 4, '0', '2023-07-19 13:25:03', '2024-05-04 18:08:00', 201),
(NULL, 'hi done test', 168, 905, 4, '0', '2023-07-21 11:10:17', '2024-05-04 18:08:00', 201),
(NULL, 'hi done test', 168, 905, 4, '0', '2023-07-21 11:14:37', '2024-05-04 18:08:00', 201),
(NULL, 'hi done test', 168, 905, 4, '0', '2023-07-21 11:28:21', '2024-05-04 18:08:00', 201),
(NULL, 'hi done test', 168, 905, 4, '0', '2023-07-21 11:29:16', '2024-05-04 18:08:00', 201),
(NULL, 'hi done test', 168, 905, 4, '0', '2024-01-27 17:50:41', '2024-05-04 18:08:00', 201),
(NULL, 'hi done test', 168, 905, 4, '0', '2024-01-27 17:51:50', '2024-05-04 18:08:00', 201),
(NULL, 'hi done test', 168, 905, 4, '0', '2024-02-04 14:20:28', '2024-05-04 18:08:00', 201),
(NULL, 'hi done test', 168, 905, 4, '0', '2024-02-04 14:29:27', '2024-05-04 18:08:00', 201),
(NULL, 'hi done test', 168, 905, 4, '0', '2024-03-07 12:06:26', '2024-05-04 18:08:00', 201),
(NULL, 'hi done test', 168, 905, 4, '0', '2024-03-07 12:06:45', '2024-05-04 18:08:00', 201),
(NULL, 'hi done test', 168, 905, 4, '0', '2024-05-04 13:00:12', '2024-05-04 18:08:00', 201);

-- --------------------------------------------------------

--
-- Table structure for table `agents_area`
--

CREATE TABLE `agents_area` (
  `area_id` int NOT NULL,
  `area_name` varchar(50) NOT NULL,
  `is_deleted` enum('0','1') NOT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '0="De-active", 1="active"',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_area`
--

INSERT INTO `agents_area` (`area_id`, `area_name`, `is_deleted`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Akone', '0', 1, '2017-11-01 09:10:34', '2020-12-21 04:48:46'),
(2, 'CA', '1', 1, '2017-11-01 09:10:34', '2017-12-30 10:49:17'),
(3, 'OR', '0', 1, '2017-11-01 09:12:36', '2020-12-08 14:51:19'),
(4, 'Usa', '1', 1, '2017-12-29 19:44:18', '2017-12-29 19:44:18'),
(5, 'Usa', '1', 1, '2017-12-29 19:44:22', '2017-12-29 19:44:22'),
(6, 'Usaa', '1', 1, '2017-12-29 19:44:40', '2020-12-06 18:36:35'),
(7, 'CA', '0', 1, '2018-06-10 14:11:52', '2018-06-10 14:11:52'),
(8, 'AR', '0', 1, '2018-06-10 14:46:13', '2018-06-10 14:46:13'),
(9, 'new area', '0', 1, '2020-12-08 14:52:47', '2020-12-08 14:52:47'),
(10, 'Test', '1', 1, '2022-04-03 12:04:31', '2022-04-03 12:05:59'),
(11, 'test area', '0', 1, '2023-02-05 01:21:41', '2023-02-05 01:21:41'),
(12, 'florida', '0', 1, '2023-03-03 20:34:32', '2023-03-03 20:34:32');

-- --------------------------------------------------------

--
-- Table structure for table `agents_bad_contents`
--

CREATE TABLE `agents_bad_contents` (
  `id` int NOT NULL,
  `words` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `agents_blog`
--

CREATE TABLE `agents_blog` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `cat_id` int DEFAULT NULL,
  `description` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int DEFAULT NULL,
  `view` int DEFAULT NULL,
  `viewer_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `added_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_blog`
--

INSERT INTO `agents_blog` (`id`, `title`, `cat_id`, `description`, `created_date`, `status`, `view`, `viewer_id`, `added_by`) VALUES
(1, 'TITLE', 4, '<p>ABC</p>', '2022-12-28 19:18:32', 0, NULL, NULL, 550),
(2, 'Test', 1, '<p style=\"margin-bottom: 20px; font-size: 14px; line-height: 24px; color: rgb(25, 23, 23); font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; text-align: center; background-color: rgb(232, 238, 235);\"><span class=\"head\" style=\"font-weight: 700; color: rgb(0, 72, 34);\">Master Bedrooms</span><br>Flooring : Vitrified tile<br>Walls : Putty / POP<br>Ceiling : Putty / POP</p><p style=\"margin-bottom: 20px; font-size: 14px; line-height: 24px; color: rgb(25, 23, 23); font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; text-align: center; background-color: rgb(232, 238, 235);\"><span class=\"head\" style=\"font-weight: 700; color: rgb(0, 72, 34);\">Balcony</span><br>Flooring : Anti Skid Tiles<br>Ceiling : Putty / POP<br>Walls : Putty / POP<br></p><p style=\"margin-bottom: 20px; font-size: 14px; line-height: 24px; color: rgb(25, 23, 23); font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; text-align: center; background-color: rgb(232, 238, 235);\"><span class=\"head\" style=\"font-weight: 700; color: rgb(0, 72, 34);\">Kitchen</span><br>Flooring : Anti Skid Tiles<br>Ceiling : Putty / POP<br>Walls : Putty / POP, Ceramic tiles-dado up to 2 feet above working platform<br>Granite counter with stainless steel sink</p>', '2023-01-09 08:55:45', 0, NULL, NULL, 707),
(3, 'Estate Blogs FOR aGENTS', 10, '<p>HERE, WE ARE PRESENTING THE AREA WHERE WE HAVE SO MANY LAND AREA FOR FAMILY HOUSES.&nbsp;</p><hr><p>THANKS,&nbsp;</p>', '2023-01-10 09:19:42', 1, NULL, NULL, 645),
(4, 'Test', 1, '<p>Tets</p>', '2023-01-11 07:54:54', 1, NULL, NULL, 709),
(5, 'asdasdasd', 3, '<p>asdasdasdasdas</p>', '2023-02-04 22:08:18', 1, NULL, NULL, 735),
(6, 'ASDASD', 4, '<p>ASDKSDJKJKASD</p>', '2023-02-05 10:06:00', 1, NULL, NULL, 739),
(7, 'wdmpwoefjpweofj', 3, '<p>wdqmWFJOweufpoe&nbsp; &nbsp; po&nbsp;&nbsp;&nbsp;&nbsp;</p>', '2023-02-05 19:56:17', 1, NULL, NULL, 744),
(8, 'testblog', 4, '<p>asdkjaskdjaklsdasdadsa</p>', '2023-03-03 09:06:31', 1, NULL, NULL, 762),
(9, 'sale', 2, '<p>fjoqjjlsmfppwkq</p>', '2023-03-03 11:50:01', 1, NULL, NULL, 763),
(10, 'asdasd', 2, '<p>asdasdasdasdasd</p>', '2023-04-13 10:46:45', 1, NULL, NULL, 784),
(11, 'asdasd', 3, '<p>asdasdasdkasasdkasdskasasdassd</p>', '2023-04-13 12:11:56', 1, NULL, NULL, 786),
(16, 'Test', 4, '<p>Test</p>', '2023-08-01 09:43:27', 1, NULL, NULL, 840),
(17, 'newBlog', 2, '<p>NXSJHUBDBjhx sdbfmxhzcjx</p>', '2023-08-17 12:09:54', 1, NULL, NULL, 839),
(18, 'TitleNEW', 2, '<p><span style=\"background-color: rgb(255, 255, 0);\">uygdyugsydjsdhj</span></p>', '2023-08-18 05:54:41', 1, NULL, NULL, 839),
(19, 'Title', 4, '<p>qwertyui</p>', '2023-08-18 07:05:42', 1, NULL, NULL, 832),
(20, 'Embracing the Art of Selling: Connecting Through Commerce', 1, '<p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-top: 1.25em; margin-bottom: 1.25em; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; white-space-collapse: preserve;\">In the world of commerce, sellers are the architects of connections, the conduits through which products and dreams find their way into the hands and hearts of customers. Behind every sale lies a narrative, a journey woven by sellers who bridge the gap between supply and demand, necessity and desire.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-top: 1.25em; margin-bottom: 1.25em; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; white-space-collapse: preserve;\"><em style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ;\">Selling as a Craft</em></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-top: 1.25em; margin-bottom: 1.25em; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; white-space-collapse: preserve;\">At its core, selling is an art form, an intricate dance between understanding needs and offering solutions. It\'s about more than transactions; it\'s the cultivation of relationships built on trust, expertise, and empathy. A seller isn’t merely a purveyor of goods but a curator of experiences, aiming to delight and fulfill the aspirations of their customers.</p>', '2023-12-06 06:42:43', 1, NULL, NULL, 859),
(21, 'Anti-theft Travel Purse or Backpack', 1, '<p style=\"box-sizing: inherit; margin-right: auto; margin-bottom: 20px; margin-left: auto; padding: 0px 20px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-variant-alternates: inherit; font-variant-position: inherit; font-stretch: inherit; line-height: inherit; font-family: Georgia, Times, &quot;Times New Roman&quot;, serif; font-optical-sizing: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; font-size: 22px; vertical-align: baseline; width: 728px; max-width: 1200px; color: rgb(30, 30, 30);\"><br>Most of the places you travel are pretty much safe, but there are always some exceptions. Let me tell you a quick story about a girl who stayed in the same hostel as me in Seam Reap, Cambodia.</p><p data-slot-rendered-content=\"true\" style=\"box-sizing: inherit; margin-right: auto; margin-bottom: 20px; margin-left: auto; padding: 0px 20px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-variant-alternates: inherit; font-variant-position: inherit; font-stretch: inherit; line-height: inherit; font-family: Georgia, Times, &quot;Times New Roman&quot;, serif; font-optical-sizing: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; font-size: 22px; vertical-align: baseline; width: 728px; max-width: 1200px; color: rgb(30, 30, 30);\">She was robbed twice on the same day. In the morning, she went for a walk to discover the city, and some guy on a moped stole her golden chain. Later in the day, she was robbed a second time by another guy in a snatch-and-grab attack.</p><div class=\"mv-ad-box\" data-slotid=\"content_btf\" data-gyg-scraped=\"1703740179116\" style=\"box-sizing: inherit; margin: 0px auto 10px; padding: 0px 20px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-variant-alternates: inherit; font-variant-position: inherit; font-stretch: inherit; line-height: inherit; font-family: Georgia, Times, &quot;Times New Roman&quot;, serif; font-optical-sizing: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; font-size: 22px; vertical-align: baseline; justify-content: center; position: relative; display: flex; flex-direction: column; align-items: center; background-color: rgb(250, 250, 250); max-width: 1200px; color: rgb(30, 30, 30); height: 440px; width: 728px; overflow: visible !important;\"><div class=\"mv-rail-frame-440\" data-slotid=\"content_btf\" style=\"box-sizing: inherit; margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; font-optical-sizing: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; vertical-align: baseline; position: relative; display: flex; flex-direction: column; justify-content: flex-start; align-items: center; height: 440px; clear: both; z-index: 1; overflow: visible !important;\"><div class=\"mv-rail-slide-440\" data-slotid=\"content_btf\" style=\"box-sizing: inherit; margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; font-optical-sizing: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; vertical-align: baseline; display: flex; place-content: center; flex-wrap: wrap; width: 320px; height: 440px; overflow: visible !important;\"></div></div></div>', '2023-12-28 05:10:15', 1, NULL, NULL, 861),
(22, 'OTPL TEST PROD 1', 1, '<p>try it for blog<br></p>', '2024-05-04 07:56:28', 1, NULL, NULL, 905);

-- --------------------------------------------------------

--
-- Table structure for table `agents_blog_comment`
--

CREATE TABLE `agents_blog_comment` (
  `com_id` int NOT NULL,
  `blog_id` varchar(45) NOT NULL,
  `comment_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `comment` varchar(255) NOT NULL,
  `com_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `agents_bookmark`
--

CREATE TABLE `agents_bookmark` (
  `bookmark_id` int NOT NULL,
  `bookmark_type` enum('1','2','3','4','5') NOT NULL COMMENT '1=''question'',2=''sz/bz/az '',3=''message'',4=''answers'',5=''proposal''',
  `bookmark_item_id` int DEFAULT NULL,
  `bookmark_item_parent_id` int DEFAULT NULL,
  `sender_id` int DEFAULT NULL,
  `sender_role` int DEFAULT NULL,
  `receiver_id` int DEFAULT NULL,
  `receiver_role` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_bookmark`
--

INSERT INTO `agents_bookmark` (`bookmark_id`, `bookmark_type`, `bookmark_item_id`, `bookmark_item_parent_id`, `sender_id`, `sender_role`, `receiver_id`, `receiver_role`, `created_at`, `updated_at`) VALUES
(9, '2', 597, 32, 614, 3, 597, 4, '2022-11-25 17:52:45', '2024-02-02 18:19:47'),
(11, '2', 601, 322, 656, 3, 625, 4, '2022-12-17 02:18:22', '2022-12-17 02:18:22'),
(12, '2', 601, 32, 656, 3, 625, 4, '2022-12-17 02:19:00', '2022-12-17 02:19:00'),
(13, '2', 550, 48, 656, 3, 550, 4, '2022-12-26 13:04:46', '2022-12-26 13:04:46'),
(14, '2', 672, 50, 671, 3, 672, 4, '2022-12-27 13:19:09', '2022-12-27 13:19:09'),
(15, '2', 672, 52, 671, 2, 672, 4, '2022-12-27 13:28:38', '2022-12-27 13:28:38'),
(16, '2', 671, 52, 672, 4, 671, 2, '2022-12-27 14:04:49', '2022-12-27 14:04:49'),
(18, '2', 709, 68, 656, 3, 709, 4, '2023-01-11 14:09:58', '2023-01-11 14:09:58'),
(19, '2', 625, 75, 707, 3, 625, 4, '2023-01-30 13:51:17', '2023-01-30 13:51:17'),
(20, '2', 707, 75, 709, 4, 707, 3, '2023-01-31 18:10:34', '2023-01-31 18:10:34'),
(21, '2', 774, 124, 767, 3, 774, 4, '2023-03-16 22:43:53', '2023-03-16 22:43:53'),
(22, '2', 769, 118, 767, 3, 769, 4, '2023-03-18 17:23:45', '2023-03-18 17:23:45'),
(24, '2', 830, 137, 828, 3, 830, 4, '2023-06-03 14:40:33', '2023-06-03 14:40:33'),
(25, '2', 828, 137, 830, 4, 828, 3, '2023-06-03 15:11:33', '2023-06-03 15:11:33'),
(26, '2', 834, 147, 839, 3, 834, 4, '2023-07-27 11:04:42', '2023-07-27 12:49:42'),
(28, '2', 842, 153, 841, 2, 842, 4, '2023-08-02 12:32:21', '2023-08-02 12:32:21'),
(29, '2', 841, 153, 842, 4, 841, 2, '2023-08-02 12:38:54', '2023-08-02 12:38:54'),
(34, '2', 853, 164, 861, 2, 853, 4, '2023-12-12 15:43:29', '2023-12-12 15:43:29'),
(35, '2', 860, 161, 859, 3, 860, 4, '2023-12-28 11:31:16', '2023-12-28 11:31:16'),
(36, '2', 891, 193, 896, 2, 891, 4, '2024-03-24 03:16:18', '2024-03-24 03:16:18'),
(37, '2', 904, 200, 905, 4, 904, 2, '2024-05-04 12:54:43', '2024-05-04 12:54:43');

-- --------------------------------------------------------

--
-- Table structure for table `agents_category`
--

CREATE TABLE `agents_category` (
  `id` int NOT NULL,
  `cat_name` varchar(150) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_category`
--

INSERT INTO `agents_category` (`id`, `cat_name`, `created_at`, `updated_at`) VALUES
(1, 'ffffg', '2019-09-19 02:13:38', NULL),
(2, 'dfdfsd', '2019-09-19 02:24:38', NULL),
(3, 'fg', '2019-09-19 02:25:14', NULL),
(4, 'asdfdd', '2019-09-19 02:25:55', NULL),
(5, 'dfgd', '2019-09-19 02:27:11', NULL),
(6, 'sdfdsf', '2019-09-19 02:31:06', NULL),
(7, 'sdfd', '2019-09-19 02:33:58', NULL),
(8, 'dd', '2019-09-19 02:35:09', NULL),
(9, 'adsfd', '2019-09-19 02:49:50', NULL),
(10, 'adsfdfasdf asdf asdf', '2019-09-19 02:50:10', NULL),
(11, 'llll', '2019-09-19 17:04:12', NULL),
(12, 'adsfd sfsf', '2019-09-19 17:18:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `agents_certifications`
--

CREATE TABLE `agents_certifications` (
  `certifications_id` int NOT NULL,
  `certifications_name` varchar(50) NOT NULL,
  `certifications_description` varchar(250) NOT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1' COMMENT '0="De-active", 1="active"',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_certifications`
--

INSERT INTO `agents_certifications` (`certifications_id`, `certifications_name`, `certifications_description`, `is_deleted`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'Test', '0', 1, '2022-08-10 08:12:41', '2022-12-09 13:21:04'),
(2, 'Test', 'Test', '0', 1, '2023-02-05 01:15:08', '2023-02-05 01:15:08'),
(3, 'j', 'ij', '0', 1, '2023-02-08 04:27:26', '2023-02-08 04:27:26'),
(4, 'j', 'ij', '0', 1, '2023-03-03 20:27:51', '2023-03-03 20:27:51'),
(5, 'kjk', 'jjj', '0', 1, '2023-03-03 20:29:10', '2023-03-03 20:29:10'),
(6, 'new', 'asdasd', '0', 1, '2023-04-13 17:59:51', '2023-04-13 17:59:51'),
(7, 'new', 'asdasd', '0', 1, '2023-04-13 18:00:27', '2023-04-13 18:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `agents_city`
--

CREATE TABLE `agents_city` (
  `city_id` int NOT NULL,
  `city_name` varchar(50) DEFAULT NULL,
  `state_id` int DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL COMMENT '0=no,1=yes',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_city`
--

INSERT INTO `agents_city` (`city_id`, `city_name`, `state_id`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Sitka', 1, '0', '2017-11-01 08:58:04', '2017-11-01 08:58:04'),
(2, 'Juneau', 1, '0', '2017-11-01 09:04:47', '2018-06-10 14:41:13'),
(3, 'Wrangell', 1, '1', '2017-11-01 09:04:47', '2017-11-01 09:04:47'),
(4, 'Juneausss', 2, '0', '2017-12-30 12:11:49', '2017-12-30 12:11:49'),
(5, 'indore1312', 2, '0', '2018-01-02 07:57:01', '2022-12-09 13:34:58'),
(6, 'Springfield', 3, '0', '2018-06-10 14:13:34', '2018-06-10 14:13:34'),
(8, 'Topeka', 7, '0', '2018-09-06 13:30:49', '2018-09-06 13:30:49'),
(9, 'uhdtgv', 1, '0', '2019-01-14 02:56:18', '2019-01-14 02:56:18'),
(10, 'Indore', 2, '0', '2020-12-21 04:53:47', '2020-12-21 04:53:47'),
(11, 'indore', 2, '0', '2020-12-21 16:35:29', '2020-12-21 16:35:29'),
(12, 'Test', 5, '1', '2022-04-03 12:08:07', '2022-04-03 12:08:07'),
(13, 'florida', 12, '0', '2023-02-05 01:23:24', '2023-02-05 01:23:24'),
(14, 'nj2', 5, '0', '2023-03-03 20:35:22', '2023-03-03 20:35:22');

-- --------------------------------------------------------

--
-- Table structure for table `agents_compare`
--

CREATE TABLE `agents_compare` (
  `compare_id` int NOT NULL,
  `compare_item_id` text NOT NULL COMMENT 'agents id',
  `post_id` int NOT NULL,
  `sender_id` int NOT NULL,
  `sender_role` int NOT NULL,
  `compare_json` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `agents_conversation`
--

CREATE TABLE `agents_conversation` (
  `conversation_id` int NOT NULL,
  `post_id` int NOT NULL,
  `sender_id` int NOT NULL,
  `sender_role_id` int NOT NULL,
  `receiver_id` int NOT NULL,
  `receiver_role_id` int NOT NULL,
  `tags_read` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1=unread,2=read',
  `tags_user_id` int NOT NULL DEFAULT '0',
  `tags_user_role` int NOT NULL,
  `last_sender_msg` text,
  `last_sender_da` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_receiver_msg` text,
  `last_receiver_da` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `snippet` text,
  `unread_count` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_conversation`
--

INSERT INTO `agents_conversation` (`conversation_id`, `post_id`, `sender_id`, `sender_role_id`, `receiver_id`, `receiver_role_id`, `tags_read`, `tags_user_id`, `tags_user_role`, `last_sender_msg`, `last_sender_da`, `last_receiver_msg`, `last_receiver_da`, `snippet`, `unread_count`, `created_at`, `updated_at`) VALUES
(1, 18, 550, 3, 550, 4, '1', 550, 4, 'Hi', '2024-02-01 15:01:29', 'Hi', '2023-02-06 00:43:56', 'Hi', 9, '2024-02-01 15:01:29', '2024-02-01 15:01:29'),
(2, 26, 550, 4, 549, 3, '1', 549, 3, 'hi', '2022-11-02 02:22:19', NULL, '2022-11-01 19:21:52', 'hi', 2, '2022-11-02 02:22:19', '2022-11-02 02:22:19'),
(3, 38, 656, 2, 549, 3, '1', 625, 4, 'hello this is latest message to ahmad', '2022-12-17 22:34:17', 'hello this is latest message to ahmad', '2022-12-04 12:44:01', 'hello this is latest message to ahmad', 12, '2022-12-17 22:34:17', '2022-12-17 22:34:17'),
(4, 26, 558, 2, 545, 3, '1', 545, 3, NULL, '2022-11-01 19:47:53', NULL, '2022-11-01 19:47:53', 'You are now connected on Messenger.', 1, '2022-11-02 02:47:53', '2022-11-02 02:47:53'),
(5, 32, 614, 3, 597, 4, '1', 597, 4, 'hhhhhhhhuuuuuuuuuuuu', '2022-11-25 17:31:33', NULL, '2022-11-25 11:18:33', 'hhhhhhhhuuuuuuuuuuuu', 2, '2022-11-25 17:31:33', '2022-11-25 17:31:33'),
(6, 32, 614, 3, 601, 4, '2', 0, 0, 'HI', '2022-11-25 17:23:45', 'hii', '2022-11-25 17:24:46', 'hii', 0, '2022-11-25 17:24:46', '2022-11-25 17:24:46'),
(7, 32, 614, 3, 542, 4, '1', 542, 4, 'Hello,', '2022-11-25 17:29:44', NULL, '2022-11-25 11:29:24', 'Hello,', 2, '2022-11-25 17:29:44', '2022-11-25 17:29:44'),
(8, 35, 625, 3, 625, 4, '2', 0, 0, 'Hi', '2022-12-08 19:49:42', 'dbbsjdjd\nznznxnndnx\nbdndnxnxnd\nhdhdbdndn\ndjjdjdjdndn\nndndndndndn\nbdndjdjdjdjjdjdjdjdjdjdjxn n     djdjjdjdjdjdjdjdjdjdjdjxjdjdj', '2022-12-18 01:30:53', 'dbbsjdjd\nznznxnndnx\nbdndnxnxnd\nhdhdbdndn\ndjjdjdjdndn\nndndndndndn\nbdndjdjdjdjjdjdjdjdjdjdjxn n     djdjjdjdjdjdjdjdjdjdjdjxjdjdj', 0, '2022-12-18 01:30:53', '2022-12-18 01:30:53'),
(9, 38, 656, 2, 625, 4, '2', 0, 0, 'I am also good', '2022-12-18 18:05:50', 'and you', '2022-12-18 18:05:37', 'I am also good', 0, '2022-12-18 18:05:50', '2022-12-18 18:05:50'),
(10, 38, 656, 4, 625, 4, '2', 0, 0, 'hello this is latest message to ahmad', '2022-12-17 22:34:38', NULL, '2022-12-16 13:13:42', 'hello this is latest message to ahmad', 0, '2022-12-17 22:34:38', '2022-12-17 22:34:38'),
(11, 38, 656, 4, 656, 3, '1', 656, 4, NULL, '2022-12-21 07:07:45', 'Hi', '2023-01-04 08:23:07', 'Hi', 3, '2023-01-04 08:23:07', '2023-01-04 08:23:07'),
(12, 45, 625, 3, 625, 4, '1', 666, 3, 'hello ?????', '2022-12-21 19:08:25', 'Hi', '2022-12-22 00:44:09', 'Hi', 8, '2022-12-22 00:44:09', '2022-12-22 00:44:09'),
(13, 44, 625, 2, 625, 4, '2', 0, 0, 'Hello ?????????????????', '2022-12-21 19:11:24', 'hello', '2022-12-22 00:39:02', 'hello', 0, '2022-12-22 00:39:02', '2022-12-22 00:39:02'),
(14, 35, 625, 3, 625, 4, '1', 645, 3, 'How are you?', '2022-12-22 00:09:03', 'What about you?', '2022-12-22 00:19:48', 'What about you?', 6, '2022-12-22 00:19:48', '2022-12-22 00:19:48'),
(15, 45, 625, 4, 625, 4, '2', 0, 0, 'Hdhshs', '2022-12-28 01:08:46', NULL, '2022-12-22 05:25:51', 'Hdhshs', 0, '2022-12-28 01:08:46', '2022-12-28 01:08:46'),
(16, 45, 625, 4, 666, 3, '1', 666, 3, NULL, '2022-12-22 05:26:27', NULL, '2022-12-22 05:26:27', 'You are now connected on Messenger.', 1, '2022-12-22 11:26:27', '2022-12-22 11:26:27'),
(17, 50, 671, 3, 672, 4, '1', 672, 4, 'Hi', '2022-12-27 13:19:19', NULL, '2022-12-27 07:19:12', 'Hi', 2, '2022-12-27 13:19:19', '2022-12-27 13:19:19'),
(18, 52, 671, 2, 672, 4, '1', 671, 2, 'sdfsdfsdf', '2022-12-27 13:28:57', 'Hi', '2022-12-27 13:37:11', 'Hi', 1, '2022-12-27 13:37:11', '2022-12-27 13:37:11'),
(19, 38, 625, 2, 625, 4, '1', 625, 2, 'Hello', '2022-12-27 18:47:38', 'How are u?', '2022-12-28 16:41:53', 'How are u?', 7, '2022-12-28 16:41:53', '2022-12-28 16:41:53'),
(20, 44, 645, 2, 625, 4, '1', 645, 2, 'jdac  jasd jas  n c jccjuc janmca jcamc kcc kjijca ikjas', '2023-01-03 16:41:55', 'sjfoIHVhvoh', '2023-02-14 15:37:50', 'sjfoIHVhvoh', 2, '2023-02-14 15:37:50', '2023-02-14 15:37:50'),
(21, 35, 625, 3, 625, 4, '1', 645, 3, 'jytdfx hggfddsss', '2022-12-28 18:59:13', 'Hd7ge7hdihefihefihiefh', '2022-12-28 19:14:35', 'Hd7ge7hdihefihefihiefh', 16, '2022-12-28 19:14:35', '2022-12-28 19:14:35'),
(22, 38, 651, 2, 625, 4, '1', 651, 2, 'bfcytcityditdiyt', '2022-12-28 19:38:10', 'thik hai', '2023-02-14 15:38:03', 'thik hai', 1, '2023-02-14 15:38:03', '2023-02-14 15:38:03'),
(23, 61, 645, 2, 601, 4, '1', 645, 2, 'Ufyuviviuc', '2023-01-04 11:06:44', NULL, '2023-01-03 10:42:52', 'Ufyuviviuc', 5, '2023-01-04 11:06:44', '2023-01-04 11:06:44'),
(24, 64, 707, 2, 670, 4, '1', 707, 2, 'Hi', '2023-01-09 14:40:39', 'Hi', '2023-08-10 15:06:22', 'Hi', 2, '2023-08-10 15:06:22', '2023-08-10 15:06:22'),
(25, 68, 656, 3, 709, 4, '2', 0, 0, 'How are you', '2023-01-11 14:10:18', NULL, '2023-01-11 08:10:07', 'How are you', 0, '2023-01-11 14:10:18', '2023-01-11 14:10:18'),
(26, 73, 710, 3, 625, 4, '1', 710, 3, 'Kiya dekh raha hai', '2023-01-16 12:47:35', 'tu kiya dekh raha hai', '2023-02-14 15:36:54', 'tu kiya dekh raha hai', 6, '2023-02-14 15:36:54', '2023-02-14 15:36:54'),
(27, 74, 714, 3, 709, 4, '2', 0, 0, 'Hi This is Guru', '2023-01-16 18:00:54', NULL, '2023-01-16 12:00:44', 'Hi This is Guru', 0, '2023-01-16 18:00:54', '2023-01-16 18:00:54'),
(28, 75, 707, 3, 625, 4, '2', 0, 0, '?/?/?', '2023-01-19 13:35:54', NULL, '2023-01-19 07:35:34', '?/?/?', 0, '2023-01-19 13:35:54', '2023-01-19 13:35:54'),
(29, 66, 707, 3, 659, 4, '1', 659, 4, 'ooue', '2023-01-19 15:05:11', NULL, '2023-01-19 09:05:03', 'ooue', 2, '2023-01-19 15:05:11', '2023-01-19 15:05:11'),
(30, 76, 716, 3, 692, 4, '1', 692, 4, 'hello', '2023-07-31 09:58:51', NULL, '2023-01-20 20:34:18', 'hello', 1, '2023-07-31 09:58:51', '2023-07-31 09:58:51'),
(31, 76, 716, 3, 716, 3, '2', 0, 0, 'Hello again', '2023-07-31 09:59:14', NULL, '2023-01-20 20:41:15', 'Hello again', 0, '2023-07-31 09:59:14', '2023-07-31 09:59:14'),
(32, 75, 709, 4, 707, 3, '1', 707, 3, 'How are you. This is Guru', '2023-01-31 18:08:29', NULL, '2023-01-31 12:08:05', 'How are you. This is Guru', 3, '2023-01-31 18:08:29', '2023-01-31 18:08:29'),
(33, 103, 739, 2, 735, 4, '1', 735, 4, NULL, '2023-02-05 09:51:28', NULL, '2023-02-05 09:51:28', 'You are now connected on Messenger.', 1, '2023-02-05 15:51:28', '2023-02-05 15:51:28'),
(34, 38, 625, 4, 656, 3, '1', 656, 3, 'hi', '2023-02-14 15:37:22', NULL, '2023-02-14 09:37:03', 'hi', 2, '2023-02-14 15:37:22', '2023-02-14 15:37:22'),
(35, 35, 625, 4, 645, 2, '1', 645, 2, 'Hey', '2023-02-22 19:19:32', NULL, '2023-02-22 13:14:23', 'Hey', 2, '2023-02-22 19:19:32', '2023-02-22 19:19:32'),
(36, 102, 550, 4, 739, 2, '1', 739, 2, NULL, '2023-02-26 17:30:38', NULL, '2023-02-26 17:30:38', 'You are now connected on Messenger.', 1, '2023-02-26 23:30:38', '2023-02-26 23:30:38'),
(37, 100, 550, 4, 737, 3, '1', 737, 3, NULL, '2023-02-27 10:30:47', NULL, '2023-02-27 10:30:47', 'You are now connected on Messenger.', 1, '2023-02-27 16:30:47', '2023-02-27 16:30:47'),
(38, 118, 769, 2, 769, 4, '1', 767, 2, 'Bxjbdjd', '2023-03-13 21:15:36', 'Only for testing purpose', '2023-03-13 21:17:05', 'Only for testing purpose', 5, '2023-03-13 21:17:05', '2023-03-13 21:17:05'),
(39, 118, 769, 4, 767, 2, '1', 767, 2, NULL, '2023-03-16 17:50:48', NULL, '2023-03-16 17:50:48', 'You are now connected on Messenger.', 1, '2023-03-16 22:50:48', '2023-03-16 22:50:48'),
(40, 118, 769, 4, 767, 3, '1', 769, 4, NULL, '2023-03-16 17:51:10', 'This is only for testing purpose', '2023-03-18 17:25:02', 'This is only for testing purpose', 4, '2023-03-18 17:25:02', '2023-03-18 17:25:02'),
(41, 124, 767, 3, 774, 4, '1', 774, 4, 'Hi', '2023-03-16 22:51:51', NULL, '2023-03-16 17:51:46', 'Hi', 2, '2023-03-16 22:51:51', '2023-03-16 22:51:51'),
(42, 38, 549, 3, 558, 2, '1', 558, 2, NULL, '2023-04-04 21:27:34', NULL, '2023-04-04 21:27:34', 'You are now connected on Messenger.', 1, '2023-04-05 02:27:34', '2023-04-05 02:27:34'),
(43, 137, 828, 3, 830, 4, '2', 0, 0, 'abcd', '2023-06-03 14:21:09', 'hello', '2023-06-03 14:10:09', 'abcd', 0, '2023-06-03 14:21:09', '2023-06-03 14:21:09'),
(44, 144, 810, 3, 830, 4, '1', 830, 4, NULL, '2023-07-08 12:45:45', NULL, '2023-07-08 12:45:45', 'You are now connected on Messenger.', 1, '2023-07-08 17:45:45', '2023-07-08 17:45:45'),
(45, 153, 841, 2, 842, 4, '2', 0, 0, NULL, '2023-08-02 07:29:12', 'Hi', '2023-08-02 12:31:07', 'Hi', 0, '2023-08-02 12:31:07', '2023-08-02 12:31:07'),
(46, 111, 670, 4, 762, 3, '1', 762, 3, NULL, '2023-08-10 10:16:26', NULL, '2023-08-10 10:16:26', 'You are now connected on Messenger.', 1, '2023-08-10 15:16:26', '2023-08-10 15:16:26'),
(47, 156, 851, 3, 852, 4, '2', 0, 0, 'can you see this message ?', '2023-09-14 23:54:53', NULL, '2023-09-14 18:54:01', 'can you see this message ?', 0, '2023-09-14 23:54:53', '2023-09-14 23:54:53'),
(48, 158, 855, 2, 853, 4, '1', 853, 4, NULL, '2023-11-11 12:48:15', NULL, '2023-11-11 12:48:15', 'You are now connected on Messenger.', 1, '2023-11-11 18:48:15', '2023-11-11 18:48:15'),
(49, 162, 859, 3, 860, 4, '2', 0, 0, 'From compact travel adapters to durable luggage organizers and everything in between, we\'re committed to providing you with high-quality products that cater to your travel comfort and convenience.', '2023-12-06 12:22:27', NULL, '2023-12-06 06:10:55', 'From compact travel adapters to durable luggage organizers and everything in between, we\'re committed to providing you with high-quality products that cater to your travel comfort and convenience.', 0, '2023-12-06 12:22:27', '2023-12-06 12:22:27'),
(50, 161, 859, 3, 860, 4, '2', 0, 0, NULL, '2023-12-28 05:29:15', NULL, '2023-12-28 05:29:15', 'You are now connected on Messenger.', 0, '2023-12-28 11:29:15', '2023-12-28 11:29:15'),
(51, 164, 861, 2, 860, 4, '1', 860, 4, 'Hi', '2024-01-11 23:11:14', NULL, '2024-01-11 17:11:09', 'Hi', 2, '2024-01-11 23:11:14', '2024-01-11 23:11:14'),
(52, 26, 550, 4, 549, 4, '1', 549, 4, NULL, '2024-02-04 16:49:43', NULL, '2024-02-04 16:49:43', 'You are now connected on Messenger.', 1, '2024-02-04 22:49:43', '2024-02-04 22:49:43'),
(53, 174, 876, 3, 879, 4, '1', 879, 4, NULL, '2024-02-08 08:30:38', NULL, '2024-02-08 08:30:38', 'You are now connected on Messenger.', 1, '2024-02-08 14:30:38', '2024-02-08 14:30:38'),
(54, 178, 876, 3, 881, 4, '1', 881, 4, 'hi', '2024-02-08 18:43:42', NULL, '2024-02-08 12:43:24', 'hi', 3, '2024-02-08 18:43:42', '2024-02-08 18:43:42'),
(55, 194, 895, 3, 891, 4, '1', 891, 4, 'Hi', '2024-03-26 13:29:24', NULL, '2024-03-26 08:29:10', 'Hi', 2, '2024-03-26 13:29:24', '2024-03-26 13:29:24'),
(56, 200, 904, 2, 905, 4, '2', 0, 0, 'hello', '2024-05-04 12:52:10', 'hi', '2024-05-04 12:52:47', 'hi', 0, '2024-05-04 12:52:47', '2024-05-04 12:52:47'),
(57, 203, 907, 2, 899, 4, '1', 899, 4, NULL, '2024-05-16 04:32:20', NULL, '2024-05-16 04:32:20', 'You are now connected on Messenger.', 1, '2024-05-16 09:32:20', '2024-05-16 09:32:20');

-- --------------------------------------------------------

--
-- Table structure for table `agents_conversation_message`
--

CREATE TABLE `agents_conversation_message` (
  `messages_id` int NOT NULL,
  `conversation_id` int NOT NULL,
  `post_id` int NOT NULL DEFAULT '0',
  `sender_id` int NOT NULL,
  `sender_role` int NOT NULL,
  `receiver_id` int NOT NULL,
  `receiver_role` int NOT NULL,
  `message_text` longtext,
  `tags_read` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1=unread,2=read',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_conversation_message`
--

INSERT INTO `agents_conversation_message` (`messages_id`, `conversation_id`, `post_id`, `sender_id`, `sender_role`, `receiver_id`, `receiver_role`, `message_text`, `tags_read`, `created_at`, `updated_at`) VALUES
(1, 1, 18, 549, 3, 550, 4, 'ok', '2', '2022-09-18 04:01:53', '2022-09-18 04:01:53'),
(2, 1, 18, 550, 4, 549, 3, 'yes', '2', '2022-09-18 04:02:09', '2022-09-18 04:02:09'),
(3, 1, 18, 549, 3, 550, 4, 'gud luck for the work', '2', '2022-09-18 04:03:04', '2022-09-18 04:03:04'),
(4, 1, 18, 550, 4, 549, 3, 'ok', '1', '2022-09-18 04:03:42', '2022-09-18 04:03:42'),
(5, 2, 26, 550, 4, 549, 3, 'hi', '1', '2022-11-02 02:22:19', '2022-11-02 02:22:19'),
(6, 3, 26, 558, 2, 549, 2, 'hello this is latest message to ahmad', '1', '2022-11-05 04:50:14', '2022-11-05 04:50:14'),
(7, 3, 26, 558, 2, 549, 2, 'hello this is latest message to ahmad', '1', '2022-11-05 04:52:00', '2022-11-05 04:52:00'),
(8, 6, 32, 614, 3, 601, 4, 'HI', '2', '2022-11-25 17:23:45', '2022-11-25 17:23:45'),
(9, 6, 32, 601, 4, 614, 3, 'hii', '2', '2022-11-25 17:24:46', '2022-11-25 17:24:46'),
(10, 7, 32, 614, 3, 542, 4, 'Hello,', '1', '2022-11-25 17:29:44', '2022-11-25 17:29:44'),
(11, 5, 32, 614, 3, 597, 4, 'hhhhhhhhuuuuuuuuuuuu', '1', '2022-11-25 17:31:33', '2022-11-25 17:31:33'),
(12, 3, 26, 558, 2, 549, 2, 'hello this is latest message to ahmad', '1', '2022-12-04 12:43:26', '2022-12-04 12:43:26'),
(13, 3, 26, 629, 2, 549, 2, 'hello this is latest message to ahmad', '1', '2022-12-04 12:44:01', '2022-12-04 12:44:01'),
(14, 8, 35, 645, 3, 625, 4, 'Hi', '2', '2022-12-08 19:48:19', '2022-12-08 19:48:19'),
(15, 8, 35, 645, 3, 625, 4, 'Hi', '2', '2022-12-08 19:49:42', '2022-12-08 19:49:42'),
(16, 8, 35, 625, 4, 625, 4, 'hello', '2', '2022-12-16 01:15:04', '2022-12-16 01:15:04'),
(17, 8, 35, 645, 3, 625, 4, 'hello', '2', '2022-12-16 01:26:09', '2022-12-16 01:26:09'),
(18, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:33:18', '2022-12-16 12:33:18'),
(19, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:33:21', '2022-12-16 12:33:21'),
(20, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:33:22', '2022-12-16 12:33:22'),
(21, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:33:23', '2022-12-16 12:33:23'),
(22, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:33:24', '2022-12-16 12:33:24'),
(23, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:33:24', '2022-12-16 12:33:24'),
(24, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:33:24', '2022-12-16 12:33:24'),
(25, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:33:25', '2022-12-16 12:33:25'),
(26, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:33:25', '2022-12-16 12:33:25'),
(27, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:33:25', '2022-12-16 12:33:25'),
(28, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:33:25', '2022-12-16 12:33:25'),
(29, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:33:25', '2022-12-16 12:33:25'),
(30, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:33:25', '2022-12-16 12:33:25'),
(31, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:33:25', '2022-12-16 12:33:25'),
(32, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:33:25', '2022-12-16 12:33:25'),
(33, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:33:25', '2022-12-16 12:33:25'),
(34, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:33:26', '2022-12-16 12:33:26'),
(35, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:10', '2022-12-16 12:34:10'),
(36, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:12', '2022-12-16 12:34:12'),
(37, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:12', '2022-12-16 12:34:12'),
(38, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:12', '2022-12-16 12:34:12'),
(39, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:12', '2022-12-16 12:34:12'),
(40, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:13', '2022-12-16 12:34:13'),
(41, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:13', '2022-12-16 12:34:13'),
(42, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:14', '2022-12-16 12:34:14'),
(43, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:14', '2022-12-16 12:34:14'),
(44, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:15', '2022-12-16 12:34:15'),
(45, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:15', '2022-12-16 12:34:15'),
(46, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:15', '2022-12-16 12:34:15'),
(47, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:21', '2022-12-16 12:34:21'),
(48, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:21', '2022-12-16 12:34:21'),
(49, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:21', '2022-12-16 12:34:21'),
(50, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:22', '2022-12-16 12:34:22'),
(51, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:22', '2022-12-16 12:34:22'),
(52, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:22', '2022-12-16 12:34:22'),
(53, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:23', '2022-12-16 12:34:23'),
(54, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:23', '2022-12-16 12:34:23'),
(55, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:23', '2022-12-16 12:34:23'),
(56, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:24', '2022-12-16 12:34:24'),
(57, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:24', '2022-12-16 12:34:24'),
(58, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:24', '2022-12-16 12:34:24'),
(59, 8, 35, 645, 3, 625, 4, 'Hii', '2', '2022-12-16 12:34:24', '2022-12-16 12:34:24'),
(60, 8, 35, 645, 3, 625, 4, 'Hi', '2', '2022-12-16 13:38:43', '2022-12-16 13:38:43'),
(61, 8, 35, 645, 3, 625, 4, 'Hi', '2', '2022-12-16 13:38:45', '2022-12-16 13:38:45'),
(62, 9, 33, 651, 2, 625, 4, 'hello there...!', '2', '2022-12-16 14:05:05', '2022-12-16 14:05:05'),
(63, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:05:48', '2022-12-16 14:05:48'),
(64, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:05:49', '2022-12-16 14:05:49'),
(65, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:05:49', '2022-12-16 14:05:49'),
(66, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:05:50', '2022-12-16 14:05:50'),
(67, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:05:50', '2022-12-16 14:05:50'),
(68, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:05:51', '2022-12-16 14:05:51'),
(69, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:05:51', '2022-12-16 14:05:51'),
(70, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:05:51', '2022-12-16 14:05:51'),
(71, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:05:51', '2022-12-16 14:05:51'),
(72, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:05:51', '2022-12-16 14:05:51'),
(73, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:05:52', '2022-12-16 14:05:52'),
(74, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:05:52', '2022-12-16 14:05:52'),
(75, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:05:52', '2022-12-16 14:05:52'),
(76, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:26', '2022-12-16 14:06:26'),
(77, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:33', '2022-12-16 14:06:33'),
(78, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:33', '2022-12-16 14:06:33'),
(79, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:33', '2022-12-16 14:06:33'),
(80, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:34', '2022-12-16 14:06:34'),
(81, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:34', '2022-12-16 14:06:34'),
(82, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:34', '2022-12-16 14:06:34'),
(83, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:34', '2022-12-16 14:06:34'),
(84, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:34', '2022-12-16 14:06:34'),
(85, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:35', '2022-12-16 14:06:35'),
(86, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:35', '2022-12-16 14:06:35'),
(87, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:36', '2022-12-16 14:06:36'),
(88, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:36', '2022-12-16 14:06:36'),
(89, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:36', '2022-12-16 14:06:36'),
(90, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:36', '2022-12-16 14:06:36'),
(91, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:36', '2022-12-16 14:06:36'),
(92, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:37', '2022-12-16 14:06:37'),
(93, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:37', '2022-12-16 14:06:37'),
(94, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:37', '2022-12-16 14:06:37'),
(95, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:37', '2022-12-16 14:06:37'),
(96, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:37', '2022-12-16 14:06:37'),
(97, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:38', '2022-12-16 14:06:38'),
(98, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:38', '2022-12-16 14:06:38'),
(99, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:38', '2022-12-16 14:06:38'),
(100, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:38', '2022-12-16 14:06:38'),
(101, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:39', '2022-12-16 14:06:39'),
(102, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:39', '2022-12-16 14:06:39'),
(103, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:39', '2022-12-16 14:06:39'),
(104, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:39', '2022-12-16 14:06:39'),
(105, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:39', '2022-12-16 14:06:39'),
(106, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:40', '2022-12-16 14:06:40'),
(107, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:43', '2022-12-16 14:06:43'),
(108, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:44', '2022-12-16 14:06:44'),
(109, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:44', '2022-12-16 14:06:44'),
(110, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:44', '2022-12-16 14:06:44'),
(111, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:44', '2022-12-16 14:06:44'),
(112, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:44', '2022-12-16 14:06:44'),
(113, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:45', '2022-12-16 14:06:45'),
(114, 9, 33, 651, 2, 625, 4, 'Hiiii', '2', '2022-12-16 14:06:45', '2022-12-16 14:06:45'),
(115, 9, 33, 651, 2, 625, 4, 'Hieeeeeee3', '2', '2022-12-16 14:10:45', '2022-12-16 14:10:45'),
(116, 9, 33, 651, 2, 625, 4, 'Hieeeeeee3', '2', '2022-12-16 14:10:46', '2022-12-16 14:10:46'),
(117, 9, 33, 651, 2, 625, 4, 'Nnnnnnnn', '2', '2022-12-16 14:10:52', '2022-12-16 14:10:52'),
(118, 9, 33, 651, 2, 625, 4, 'Nnnnnnnn', '2', '2022-12-16 14:10:53', '2022-12-16 14:10:53'),
(119, 9, 33, 651, 2, 625, 4, 'Nnnnnnnn', '2', '2022-12-16 14:10:54', '2022-12-16 14:10:54'),
(120, 9, 33, 651, 2, 625, 4, 'Ssssssss', '2', '2022-12-16 14:10:58', '2022-12-16 14:10:58'),
(121, 9, 33, 651, 2, 625, 4, 'Ssssssss', '2', '2022-12-16 14:10:59', '2022-12-16 14:10:59'),
(122, 9, 33, 651, 2, 625, 4, 'Ssssssss', '2', '2022-12-16 14:10:59', '2022-12-16 14:10:59'),
(123, 9, 33, 651, 2, 625, 4, 'Ssssssss', '2', '2022-12-16 14:11:00', '2022-12-16 14:11:00'),
(124, 9, 33, 651, 2, 625, 4, 'Ppppppppp', '2', '2022-12-16 14:11:03', '2022-12-16 14:11:03'),
(125, 9, 33, 651, 2, 625, 4, 'Ppppppppp', '2', '2022-12-16 14:11:04', '2022-12-16 14:11:04'),
(126, 9, 33, 651, 2, 625, 4, 'Hello There..', '2', '2022-12-16 14:11:06', '2022-12-16 14:11:06'),
(127, 9, 33, 651, 2, 625, 4, 'Kkkkkkkkkkk', '2', '2022-12-16 14:11:09', '2022-12-16 14:11:09'),
(128, 9, 33, 651, 2, 625, 4, 'Kkkkkkkkkkk', '2', '2022-12-16 14:11:10', '2022-12-16 14:11:10'),
(129, 9, 33, 651, 2, 625, 4, 'Vvvvvvbv', '2', '2022-12-16 14:11:16', '2022-12-16 14:11:16'),
(130, 9, 33, 651, 2, 625, 4, 'Vvvvvvbv', '2', '2022-12-16 14:11:17', '2022-12-16 14:11:17'),
(131, 9, 33, 651, 2, 625, 4, 'Bbbbbbbbbbbbb', '2', '2022-12-16 14:11:24', '2022-12-16 14:11:24'),
(132, 9, 33, 651, 2, 625, 4, 'Bbbbbbbbbbbbb', '2', '2022-12-16 14:11:24', '2022-12-16 14:11:24'),
(133, 9, 33, 651, 2, 625, 4, 'Bbbbbbbbbbbbb', '2', '2022-12-16 14:11:26', '2022-12-16 14:11:26'),
(134, 9, 33, 651, 2, 625, 4, 'Bbbbbbbbbbbbb', '2', '2022-12-16 14:11:26', '2022-12-16 14:11:26'),
(135, 9, 33, 651, 2, 625, 4, 'Bbbbbbbbbbbbb', '2', '2022-12-16 14:11:26', '2022-12-16 14:11:26'),
(136, 9, 33, 651, 2, 625, 4, 'Bbbbbbbbbbbbb', '2', '2022-12-16 14:11:26', '2022-12-16 14:11:26'),
(137, 9, 33, 651, 2, 625, 4, 'Bbbbbbbbbbbbb', '2', '2022-12-16 14:11:27', '2022-12-16 14:11:27'),
(138, 9, 33, 651, 2, 625, 4, 'Bbbbbbbbbbbbb', '2', '2022-12-16 14:11:27', '2022-12-16 14:11:27'),
(139, 9, 33, 651, 2, 625, 4, 'Bbbbbbbbbbbbb', '2', '2022-12-16 14:11:27', '2022-12-16 14:11:27'),
(140, 9, 33, 651, 2, 625, 4, 'Hii Grayson there...', '2', '2022-12-16 14:11:27', '2022-12-16 14:11:27'),
(141, 9, 33, 651, 2, 625, 4, 'hi', '2', '2022-12-17 22:10:35', '2022-12-17 22:10:35'),
(142, 10, 35, 625, 4, 625, 4, 'Heelllloooo', '2', '2022-12-17 22:19:54', '2022-12-17 22:19:54'),
(143, 9, 33, 651, 2, 625, 4, 'hiii', '2', '2022-12-17 22:20:22', '2022-12-17 22:20:22'),
(144, 9, 33, 651, 2, 625, 4, 'H', '2', '2022-12-17 22:23:29', '2022-12-17 22:23:29'),
(145, 9, 33, 651, 2, 625, 4, 'Hff', '2', '2022-12-17 22:23:50', '2022-12-17 22:23:50'),
(146, 9, 33, 651, 2, 625, 4, 'Hff', '2', '2022-12-17 22:24:40', '2022-12-17 22:24:40'),
(147, 9, 33, 651, 2, 625, 4, 'Hff', '2', '2022-12-17 22:25:33', '2022-12-17 22:25:33'),
(148, 9, 33, 651, 2, 625, 4, 'hi', '2', '2022-12-17 22:26:26', '2022-12-17 22:26:26'),
(149, 10, 35, 625, 4, 625, 4, 'hi', '2', '2022-12-17 22:26:55', '2022-12-17 22:26:55'),
(150, 8, 35, 645, 3, 625, 4, 'hello', '2', '2022-12-17 22:27:17', '2022-12-17 22:27:17'),
(151, 8, 35, 645, 3, 625, 4, 'g', '2', '2022-12-17 22:27:57', '2022-12-17 22:27:57'),
(152, 8, 35, 625, 4, 645, 3, 'hi', '1', '2022-12-17 22:28:57', '2022-12-17 22:28:57'),
(153, 9, 33, 625, 4, 651, 2, 'hello', '1', '2022-12-17 22:29:24', '2022-12-17 22:29:24'),
(154, 8, 35, 625, 4, 625, 3, 'How are you?', '1', '2022-12-17 22:30:36', '2022-12-17 22:30:36'),
(155, 8, 35, 625, 4, 625, 3, 'i am fine and u', '1', '2022-12-17 22:32:23', '2022-12-17 22:32:23'),
(156, 3, 38, 656, 3, 625, 4, 'hello this is latest message to ahmad', '1', '2022-12-17 22:34:17', '2022-12-17 22:34:17'),
(157, 10, 38, 656, 3, 625, 4, 'hello this is latest message to ahmad', '2', '2022-12-17 22:34:38', '2022-12-17 22:34:38'),
(158, 9, 38, 656, 3, 625, 4, 'hello this is latest message to ahmad', '2', '2022-12-17 22:35:14', '2022-12-17 22:35:14'),
(159, 9, 38, 656, 3, 625, 4, 'how are you?', '2', '2022-12-17 22:35:33', '2022-12-17 22:35:33'),
(160, 9, 38, 656, 3, 625, 4, 'what are you doing ?', '2', '2022-12-17 22:36:49', '2022-12-17 22:36:49'),
(161, 8, 35, 625, 4, 625, 3, 'dbbsjdjd\nznznxnndnx\nbdndnxnxnd\nhdhdbdndn\ndjjdjdjdndn\nndndndndndn\nbdndjdjdjdjjdjdjdjdjdjdjxn n     djdjjdjdjdjdjdjdjdjdjdjxjdjdj', '1', '2022-12-18 01:30:53', '2022-12-18 01:30:53'),
(162, 9, 38, 656, 3, 625, 4, 'what\'s going on ?', '2', '2022-12-18 01:39:32', '2022-12-18 01:39:32'),
(163, 9, 38, 625, 4, 656, 2, 'nothing', '1', '2022-12-18 01:39:55', '2022-12-18 01:39:55'),
(164, 9, 38, 625, 4, 656, 2, 'what about you?', '1', '2022-12-18 01:40:04', '2022-12-18 01:40:04'),
(165, 9, 38, 656, 3, 625, 4, 'hello this is latest message to ahmad', '2', '2022-12-18 18:04:49', '2022-12-18 18:04:49'),
(166, 9, 38, 656, 3, 625, 4, 'Hello', '2', '2022-12-18 18:05:07', '2022-12-18 18:05:07'),
(167, 9, 38, 625, 4, 625, 2, 'hi', '1', '2022-12-18 18:05:13', '2022-12-18 18:05:13'),
(168, 9, 38, 656, 3, 625, 4, 'how are you ?', '2', '2022-12-18 18:05:26', '2022-12-18 18:05:26'),
(169, 9, 38, 625, 4, 625, 2, 'i am fine', '1', '2022-12-18 18:05:33', '2022-12-18 18:05:33'),
(170, 9, 38, 625, 4, 625, 2, 'and you', '1', '2022-12-18 18:05:37', '2022-12-18 18:05:37'),
(171, 9, 38, 656, 3, 625, 4, 'I am also good', '2', '2022-12-18 18:05:50', '2022-12-18 18:05:50'),
(172, 12, 45, 666, 3, 625, 4, 'hiii', '1', '2022-12-21 19:06:43', '2022-12-21 19:06:43'),
(173, 12, 45, 666, 3, 625, 4, 'hello', '1', '2022-12-21 19:07:02', '2022-12-21 19:07:02'),
(174, 12, 45, 666, 3, 625, 4, 'is there anybody', '1', '2022-12-21 19:07:12', '2022-12-21 19:07:12'),
(175, 12, 45, 666, 3, 625, 4, '??', '1', '2022-12-21 19:07:22', '2022-12-21 19:07:22'),
(176, 12, 45, 666, 3, 625, 4, 'hello ?????', '1', '2022-12-21 19:08:25', '2022-12-21 19:08:25'),
(177, 13, 44, 645, 2, 625, 4, 'hiiiiiiii', '2', '2022-12-21 19:11:00', '2022-12-21 19:11:00'),
(178, 13, 44, 645, 2, 625, 4, '??????????????????????????????', '2', '2022-12-21 19:11:11', '2022-12-21 19:11:11'),
(179, 13, 44, 645, 2, 625, 4, 'Hello ?????????????????', '2', '2022-12-21 19:11:24', '2022-12-21 19:11:24'),
(180, 14, 35, 645, 3, 625, 4, 'Hi', '2', '2022-12-22 00:04:07', '2022-12-22 00:04:07'),
(181, 14, 35, 645, 3, 625, 4, 'How are you?', '2', '2022-12-22 00:09:03', '2022-12-22 00:09:03'),
(182, 14, 35, 625, 4, 645, 3, 'Hello', '1', '2022-12-22 00:19:36', '2022-12-22 00:19:36'),
(183, 14, 35, 625, 4, 645, 3, 'I am good', '1', '2022-12-22 00:19:42', '2022-12-22 00:19:42'),
(184, 14, 35, 625, 4, 645, 3, 'What about you?', '1', '2022-12-22 00:19:48', '2022-12-22 00:19:48'),
(185, 13, 44, 625, 4, 645, 2, 'hi', '1', '2022-12-22 00:26:42', '2022-12-22 00:26:42'),
(186, 13, 44, 625, 2, 625, 4, 'hello', '2', '2022-12-22 00:39:02', '2022-12-22 00:39:02'),
(187, 12, 45, 625, 4, 625, 4, 'yes', '1', '2022-12-22 00:42:52', '2022-12-22 00:42:52'),
(188, 12, 45, 625, 4, 666, 3, 'Hi', '1', '2022-12-22 00:44:09', '2022-12-22 00:44:09'),
(189, 17, 50, 671, 3, 672, 4, 'Hi', '1', '2022-12-27 13:19:19', '2022-12-27 13:19:19'),
(190, 18, 52, 671, 2, 672, 4, 'sfdsfsd', '2', '2022-12-27 13:28:44', '2022-12-27 13:28:44'),
(191, 18, 52, 671, 2, 672, 4, 'sdfsdfsdf', '2', '2022-12-27 13:28:57', '2022-12-27 13:28:57'),
(192, 18, 52, 672, 4, 671, 2, 'Hi', '1', '2022-12-27 13:37:11', '2022-12-27 13:37:11'),
(193, 19, 38, 651, 2, 625, 4, 'hiee', '1', '2022-12-27 16:12:43', '2022-12-27 16:12:43'),
(194, 19, 38, 651, 2, 651, 2, 'Hello', '1', '2022-12-27 18:47:38', '2022-12-27 18:47:38'),
(195, 15, 45, 625, 4, 625, 4, 'hello', '2', '2022-12-28 01:07:57', '2022-12-28 01:07:57'),
(196, 15, 45, 625, 4, 625, 4, 'hi', '2', '2022-12-28 01:08:38', '2022-12-28 01:08:38'),
(197, 15, 45, 625, 4, 625, 4, 'how are you', '2', '2022-12-28 01:08:43', '2022-12-28 01:08:43'),
(198, 15, 45, 625, 4, 625, 4, 'Hdhshs', '2', '2022-12-28 01:08:46', '2022-12-28 01:08:46'),
(199, 19, 38, 625, 4, 651, 2, 'hello', '1', '2022-12-28 01:09:21', '2022-12-28 01:09:21'),
(200, 19, 38, 625, 4, 625, 2, 'hi', '1', '2022-12-28 16:41:45', '2022-12-28 16:41:45'),
(201, 19, 38, 625, 4, 625, 2, 'graysob', '1', '2022-12-28 16:41:48', '2022-12-28 16:41:48'),
(202, 19, 38, 625, 4, 625, 2, 'How are u?', '1', '2022-12-28 16:41:53', '2022-12-28 16:41:53'),
(203, 20, 44, 645, 2, 625, 4, 'ooye heelooo', '2', '2022-12-28 18:56:48', '2022-12-28 18:56:48'),
(204, 20, 44, 645, 2, 625, 4, 'heeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '2', '2022-12-28 18:56:58', '2022-12-28 18:56:58'),
(205, 20, 44, 645, 2, 625, 4, ';oina;KJBC .J JKcna ;lygcuhvacsb,jhcs   kjsacv kjvsX', '2', '2022-12-28 18:57:09', '2022-12-28 18:57:09'),
(206, 21, 35, 645, 3, 625, 4, 'OOYYYEEEEEEEEEEEEEEEEEEEEEEEEEEEEE', '1', '2022-12-28 18:59:07', '2022-12-28 18:59:07'),
(207, 21, 35, 645, 3, 625, 4, 'jytdfx hggfddsss', '1', '2022-12-28 18:59:13', '2022-12-28 18:59:13'),
(208, 21, 35, 625, 4, 645, 3, 'Hghftyhghhu', '1', '2022-12-28 19:14:14', '2022-12-28 19:14:14'),
(209, 21, 35, 625, 4, 645, 3, 'Hxhshsjidios', '1', '2022-12-28 19:14:25', '2022-12-28 19:14:25'),
(210, 21, 35, 625, 4, 645, 3, 'Jxjjsjkxkdi', '1', '2022-12-28 19:14:27', '2022-12-28 19:14:27'),
(211, 21, 35, 625, 4, 645, 3, 'Jxjjsjkxkdizjdbxjxjdjjd', '1', '2022-12-28 19:14:28', '2022-12-28 19:14:28'),
(212, 21, 35, 625, 4, 645, 3, 'Jxjjsjkxkdizjdbxjxjdjjd', '1', '2022-12-28 19:14:28', '2022-12-28 19:14:28'),
(213, 21, 35, 625, 4, 645, 3, 'Jxjjsjkxkdizjdbxjxjdjjddhdhjdid', '1', '2022-12-28 19:14:29', '2022-12-28 19:14:29'),
(214, 21, 35, 625, 4, 645, 3, 'Jxjjsjkxkdizjdbxjxjdjjd', '1', '2022-12-28 19:14:29', '2022-12-28 19:14:29'),
(215, 21, 35, 625, 4, 645, 3, 'Jxjjsjkxkdizjdbxjxjdjjddhdhjdid', '1', '2022-12-28 19:14:30', '2022-12-28 19:14:30'),
(216, 21, 35, 625, 4, 645, 3, 'Jxjjsjkxkdizjdbxjxjdjjddhdhjdid', '1', '2022-12-28 19:14:30', '2022-12-28 19:14:30'),
(217, 21, 35, 625, 4, 645, 3, 'Jxjjsjkxkdizjdbxjxjdjjddhdhjdid', '1', '2022-12-28 19:14:30', '2022-12-28 19:14:30'),
(218, 21, 35, 625, 4, 645, 3, 'Jxjjsjkxkdizjdbxjxjdjjddhdhjdid', '1', '2022-12-28 19:14:30', '2022-12-28 19:14:30'),
(219, 21, 35, 625, 4, 645, 3, 'Jxjjsjkxkdizjdbxjxjdjjddhdhjdid', '1', '2022-12-28 19:14:30', '2022-12-28 19:14:30'),
(220, 21, 35, 625, 4, 645, 3, 'Hd7ge7hdihefihefihiefh', '1', '2022-12-28 19:14:35', '2022-12-28 19:14:35'),
(221, 21, 35, 625, 4, 645, 3, 'Hd7ge7hdihefihefihiefh', '1', '2022-12-28 19:14:35', '2022-12-28 19:14:35'),
(222, 22, 38, 651, 2, 625, 4, 'iubbggg', '2', '2022-12-28 19:38:04', '2022-12-28 19:38:04'),
(223, 22, 38, 651, 2, 625, 4, 'hgcdrdssd', '2', '2022-12-28 19:38:07', '2022-12-28 19:38:07'),
(224, 22, 38, 651, 2, 625, 4, 'bfcytcityditdiyt', '2', '2022-12-28 19:38:10', '2022-12-28 19:38:10'),
(225, 20, 44, 645, 2, 645, 2, 'Hb,ibedihdie', '2', '2023-01-03 16:39:08', '2023-01-03 16:39:08'),
(226, 20, 44, 645, 2, 645, 2, 'Hb,ibedihdieusxheuxhihex', '2', '2023-01-03 16:39:10', '2023-01-03 16:39:10'),
(227, 20, 44, 645, 2, 645, 2, 'Hb,ibedihdieusxheuxhihex', '2', '2023-01-03 16:39:10', '2023-01-03 16:39:10'),
(228, 20, 44, 645, 2, 645, 2, 'Hb,ibedihdieusxheuxhihex', '2', '2023-01-03 16:39:10', '2023-01-03 16:39:10'),
(229, 20, 44, 645, 2, 645, 2, NULL, '2', '2023-01-03 16:39:11', '2023-01-03 16:39:11'),
(230, 20, 44, 645, 2, 645, 2, 'Xhuhxe8ehd', '2', '2023-01-03 16:39:13', '2023-01-03 16:39:13'),
(231, 20, 44, 645, 2, 645, 2, 'Xhuhxe8ehduvxuebixe', '2', '2023-01-03 16:39:14', '2023-01-03 16:39:14'),
(232, 20, 44, 645, 2, 645, 2, 'Xhuhxe8ehduvxuebixenx8ebd8eh', '2', '2023-01-03 16:39:15', '2023-01-03 16:39:15'),
(233, 20, 44, 645, 2, 645, 2, 'Xhuhxe8ehduvxuebixenx8ebd8eheu0xbeibd', '2', '2023-01-03 16:39:16', '2023-01-03 16:39:16'),
(234, 20, 44, 645, 2, 645, 2, 'Bd8ehd', '2', '2023-01-03 16:39:20', '2023-01-03 16:39:20'),
(235, 20, 44, 645, 2, 625, 4, 'jhiwfc', '2', '2023-01-03 16:41:43', '2023-01-03 16:41:43'),
(236, 20, 44, 645, 2, 625, 4, 'jdac  jasd jas  n c jccjuc janmca jcamc kcc kjijca ikjas', '2', '2023-01-03 16:41:55', '2023-01-03 16:41:55'),
(237, 23, 61, 645, 2, 601, 4, 'bosDFCV', '1', '2023-01-03 16:42:56', '2023-01-03 16:42:56'),
(238, 23, 61, 645, 2, 601, 4, 'HCVADLUYfL', '1', '2023-01-03 16:42:58', '2023-01-03 16:42:58'),
(239, 23, 61, 645, 2, 601, 4, 'MXYDNXYTXXMNGSB7SDSGS', '1', '2023-01-03 16:43:02', '2023-01-03 16:43:02'),
(240, 11, 38, 656, 3, 625, 4, 'Hi', '1', '2023-01-04 08:22:43', '2023-01-04 08:22:43'),
(241, 11, 38, 656, 3, 625, 4, 'How are things going', '1', '2023-01-04 08:22:54', '2023-01-04 08:22:54'),
(242, 11, 38, 656, 3, 656, 4, 'Hi', '1', '2023-01-04 08:23:07', '2023-01-04 08:23:07'),
(243, 23, 61, 645, 2, 645, 2, 'Ufyuviviuc', '1', '2023-01-04 11:06:44', '2023-01-04 11:06:44'),
(244, 24, 64, 707, 2, 670, 4, 'Hi', '2', '2023-01-09 14:40:39', '2023-01-09 14:40:39'),
(245, 25, 68, 656, 3, 709, 4, 'Hi', '2', '2023-01-11 14:10:15', '2023-01-11 14:10:15'),
(246, 25, 68, 656, 3, 709, 4, 'How are you', '2', '2023-01-11 14:10:18', '2023-01-11 14:10:18'),
(247, 26, 73, 710, 3, 625, 4, 'oooyyyeeeeeee', '2', '2023-01-16 12:46:56', '2023-01-16 12:46:56'),
(248, 26, 73, 710, 3, 625, 4, 'helleuououououououououo', '2', '2023-01-16 12:47:11', '2023-01-16 12:47:11'),
(249, 26, 73, 710, 3, 710, 3, 'Kiya be', '1', '2023-01-16 12:47:27', '2023-01-16 12:47:27'),
(250, 26, 73, 710, 3, 710, 3, 'Kiya dekh raha hai', '1', '2023-01-16 12:47:35', '2023-01-16 12:47:35'),
(251, 27, 74, 714, 3, 709, 4, 'Hi This is Guru', '2', '2023-01-16 18:00:54', '2023-01-16 18:00:54'),
(252, 28, 75, 707, 3, 625, 4, 'oye hello', '2', '2023-01-19 13:35:43', '2023-01-19 13:35:43'),
(253, 28, 75, 707, 3, 625, 4, '?/?/?', '2', '2023-01-19 13:35:54', '2023-01-19 13:35:54'),
(254, 29, 66, 707, 3, 659, 4, 'ooue', '1', '2023-01-19 15:05:11', '2023-01-19 15:05:11'),
(255, 24, 64, 670, 4, 707, 2, 'hi', '1', '2023-01-19 15:38:51', '2023-01-19 15:38:51'),
(256, 30, 76, 716, 3, 692, 4, 'Hello Agent', '1', '2023-01-21 02:34:26', '2023-01-21 02:34:26'),
(257, 30, 76, 716, 3, 716, 3, 'Good morning', '2', '2023-01-21 02:38:40', '2023-01-21 02:38:40'),
(258, 30, 76, 716, 3, 692, 4, 'good afternoon', '1', '2023-01-21 02:39:01', '2023-01-21 02:39:01'),
(259, 30, 76, 716, 3, 716, 3, 'Are you available', '2', '2023-01-21 02:41:53', '2023-01-21 02:41:53'),
(260, 30, 76, 716, 3, 716, 3, 'For a call', '2', '2023-01-21 02:42:59', '2023-01-21 02:42:59'),
(261, 30, 76, 716, 3, 692, 4, 'a test message', '1', '2023-01-21 11:29:44', '2023-01-21 11:29:44'),
(262, 30, 76, 716, 3, 716, 3, 'another test', '2', '2023-01-21 11:29:59', '2023-01-21 11:29:59'),
(263, 32, 75, 709, 4, 707, 3, 'Hi This is Guru', '1', '2023-01-31 18:08:14', '2023-01-31 18:08:14'),
(264, 32, 75, 709, 4, 707, 3, 'How are you. This is Guru', '1', '2023-01-31 18:08:29', '2023-01-31 18:08:29'),
(265, 1, 18, 550, 4, 549, 3, 'Hi', '1', '2023-02-06 00:43:56', '2023-02-06 00:43:56'),
(266, 26, 73, 625, 4, 710, 3, 'tu kiya dekh raha hai', '1', '2023-02-14 15:36:54', '2023-02-14 15:36:54'),
(267, 34, 38, 625, 4, 656, 3, 'hi', '1', '2023-02-14 15:37:22', '2023-02-14 15:37:22'),
(268, 20, 44, 625, 4, 645, 2, 'qburnapmcgucrioghignah', '1', '2023-02-14 15:37:40', '2023-02-14 15:37:40'),
(269, 20, 44, 625, 4, 645, 2, 'sjfoIHVhvoh', '1', '2023-02-14 15:37:50', '2023-02-14 15:37:50'),
(270, 22, 38, 625, 4, 651, 2, 'thik hai', '1', '2023-02-14 15:38:03', '2023-02-14 15:38:03'),
(271, 35, 35, 625, 4, 645, 2, 'Hey', '1', '2023-02-22 19:19:32', '2023-02-22 19:19:32'),
(272, 38, 118, 767, 2, 769, 4, 'hii , this side ritu', '1', '2023-03-12 13:39:25', '2023-03-12 13:39:25'),
(273, 38, 118, 767, 2, 769, 4, 'Hello', '1', '2023-03-12 13:39:42', '2023-03-12 13:39:42'),
(274, 38, 118, 767, 2, 767, 2, 'Bxjbdjd', '1', '2023-03-13 21:15:36', '2023-03-13 21:15:36'),
(275, 38, 118, 769, 4, 767, 2, 'Only for testing purpose', '1', '2023-03-13 21:17:05', '2023-03-13 21:17:05'),
(276, 41, 124, 767, 3, 774, 4, 'Hi', '1', '2023-03-16 22:51:51', '2023-03-16 22:51:51'),
(277, 40, 118, 767, 3, 769, 4, NULL, '1', '2023-03-18 17:24:18', '2023-03-18 17:24:18'),
(278, 40, 118, 767, 3, 769, 4, 'ewmnsf', '1', '2023-03-18 17:24:24', '2023-03-18 17:24:24'),
(279, 40, 118, 767, 3, 769, 4, NULL, '1', '2023-03-18 17:24:33', '2023-03-18 17:24:33'),
(280, 40, 118, 767, 3, 769, 4, 'This is only for testing purpose', '1', '2023-03-18 17:25:02', '2023-03-18 17:25:02'),
(281, 43, 137, 828, 3, 830, 4, 'hello', '2', '2023-06-03 14:09:06', '2023-06-03 14:09:06'),
(282, 43, 137, 830, 4, 828, 3, 'hello', '2', '2023-06-03 14:10:09', '2023-06-03 14:10:09'),
(283, 43, 137, 828, 3, 830, 4, 'hii', '2', '2023-06-03 14:12:52', '2023-06-03 14:12:52'),
(284, 43, 137, 828, 3, 830, 4, 'hello', '2', '2023-06-03 14:20:31', '2023-06-03 14:20:31'),
(285, 43, 137, 828, 3, 830, 4, 'abcd', '2', '2023-06-03 14:21:09', '2023-06-03 14:21:09'),
(286, 30, 76, 716, 3, 692, 4, 'hello', '1', '2023-07-31 09:58:51', '2023-07-31 09:58:51'),
(287, 31, 76, 716, 3, 716, 3, 'Hello again', '1', '2023-07-31 09:59:14', '2023-07-31 09:59:14'),
(288, 45, 153, 842, 4, 841, 2, 'Hi', '2', '2023-08-02 12:30:02', '2023-08-02 12:30:02'),
(289, 45, 153, 842, 4, 841, 2, 'Hi', '2', '2023-08-02 12:31:07', '2023-08-02 12:31:07'),
(290, 24, 64, 670, 4, 707, 2, 'Hi', '1', '2023-08-10 15:06:22', '2023-08-10 15:06:22'),
(291, 47, 156, 851, 3, 852, 4, 'hello', '2', '2023-09-14 23:54:07', '2023-09-14 23:54:07'),
(292, 47, 156, 851, 3, 852, 4, 'can you see this message ?', '2', '2023-09-14 23:54:53', '2023-09-14 23:54:53'),
(293, 49, 162, 859, 3, 860, 4, 'Hi,', '2', '2023-12-06 12:22:24', '2023-12-06 12:22:24'),
(294, 49, 162, 859, 3, 860, 4, 'From compact travel adapters to durable luggage organizers and everything in between, we\'re committed to providing you with high-quality products that cater to your travel comfort and convenience.', '2', '2023-12-06 12:22:27', '2023-12-06 12:22:27'),
(295, 51, 164, 861, 2, 860, 4, 'Hi', '1', '2024-01-11 23:11:14', '2024-01-11 23:11:14'),
(296, 1, 18, 550, 3, 550, 4, 'Hi', '1', '2024-02-01 14:52:06', '2024-02-01 14:52:06'),
(297, 1, 18, 550, 3, 550, 4, 'Hi', '1', '2024-02-01 15:01:29', '2024-02-01 15:01:29'),
(298, 54, 178, 876, 3, 881, 4, 'hi', '1', '2024-02-08 18:43:29', '2024-02-08 18:43:29'),
(299, 54, 178, 876, 3, 881, 4, 'hi', '1', '2024-02-08 18:43:42', '2024-02-08 18:43:42'),
(300, 55, 194, 895, 3, 891, 4, 'Hi', '1', '2024-03-26 13:29:24', '2024-03-26 13:29:24'),
(301, 56, 200, 904, 2, 905, 4, 'hello', '2', '2024-05-04 12:52:11', '2024-05-04 12:52:11'),
(302, 56, 200, 905, 4, 904, 2, 'hi', '2', '2024-05-04 12:52:47', '2024-05-04 12:52:47');

-- --------------------------------------------------------

--
-- Table structure for table `agents_employee`
--

CREATE TABLE `agents_employee` (
  `id` int NOT NULL,
  `empname` varchar(250) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `agentread` int NOT NULL DEFAULT '0',
  `agentchange` int NOT NULL DEFAULT '0',
  `bsread` int NOT NULL DEFAULT '0',
  `bschange` int NOT NULL DEFAULT '0',
  `empread` int NOT NULL DEFAULT '0',
  `empchange` int NOT NULL DEFAULT '0',
  `postlistread` int NOT NULL DEFAULT '0',
  `postlistchange` int NOT NULL DEFAULT '0',
  `badpostread` int NOT NULL DEFAULT '0',
  `badpostchange` int NOT NULL DEFAULT '0',
  `quesread` int NOT NULL DEFAULT '0',
  `queschange` int NOT NULL DEFAULT '0',
  `squesread` int NOT NULL DEFAULT '0',
  `squeschange` int NOT NULL DEFAULT '0',
  `skillread` int NOT NULL DEFAULT '0',
  `skillchange` int NOT NULL DEFAULT '0',
  `franchread` int NOT NULL DEFAULT '0',
  `franchchange` int NOT NULL DEFAULT '0',
  `certificationread` int NOT NULL DEFAULT '0',
  `certificationchange` int NOT NULL DEFAULT '0',
  `stateread` int NOT NULL DEFAULT '0',
  `statechange` int NOT NULL DEFAULT '0',
  `arearead` int NOT NULL DEFAULT '0',
  `areachange` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_ate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int NOT NULL DEFAULT '0',
  `_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `agents_franchise`
--

CREATE TABLE `agents_franchise` (
  `franchise_id` int NOT NULL,
  `franchise_name` varchar(250) DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=no,1=yes',
  `status` int NOT NULL DEFAULT '1' COMMENT '0="De-active", 1="active"',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `agents_franchise`
--

INSERT INTO `agents_franchise` (`franchise_id`, `franchise_name`, `is_deleted`, `status`, `created_at`, `updated_at`) VALUES
(1, 'hfvhc u', '0', 1, '2023-01-11 13:38:44', '2023-01-11 13:38:44'),
(2, 'test2', '0', 1, '2023-02-05 01:19:53', '2023-02-05 01:19:53'),
(3, 'asdafgg', '0', 1, '2023-03-03 20:32:33', '2023-03-03 20:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `agents_importance`
--

CREATE TABLE `agents_importance` (
  `importance_id` int NOT NULL,
  `agents_user_id` int DEFAULT NULL,
  `agents_users_role_id` int DEFAULT NULL,
  `importance_item_id` int DEFAULT NULL,
  `importance_type` enum('1') NOT NULL COMMENT '1=question',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=no,1=yes',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `agents_importance`
--

INSERT INTO `agents_importance` (`importance_id`, `agents_user_id`, `agents_users_role_id`, `importance_item_id`, `importance_type`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 549, 3, 46, '1', '0', '2022-12-30 02:42:48', '2022-12-30 02:42:48'),
(2, 549, 3, 47, '1', '0', '2022-12-30 02:43:38', '2022-12-30 02:43:38'),
(3, 549, 3, 48, '1', '0', '2022-12-30 02:44:07', '2022-12-30 02:44:07'),
(4, 707, 2, 49, '1', '0', '2023-01-09 14:42:13', '2023-01-09 14:42:13'),
(5, 707, 2, 50, '1', '0', '2023-01-09 14:42:28', '2023-01-09 14:42:28'),
(6, 707, 2, 51, '1', '0', '2023-01-09 14:43:07', '2023-01-09 14:43:07'),
(7, 656, 3, 61, '1', '0', '2023-01-11 14:12:00', '2023-01-11 14:12:00'),
(8, 656, 3, 62, '1', '0', '2023-01-11 14:12:07', '2023-01-11 14:12:07'),
(9, 656, 3, 63, '1', '0', '2023-01-11 14:13:36', '2023-01-11 14:13:36'),
(10, 656, 3, 64, '1', '0', '2023-01-11 14:20:14', '2023-01-11 14:20:14'),
(11, 716, 3, 65, '1', '0', '2023-01-21 11:58:25', '2023-01-21 11:58:25'),
(12, 707, 3, 66, '1', '0', '2023-01-31 13:06:55', '2023-01-31 13:06:55'),
(13, 707, 3, 67, '1', '0', '2023-01-31 13:07:27', '2023-01-31 13:07:27'),
(14, 739, 2, 73, '1', '0', '2023-02-05 15:53:41', '2023-02-05 15:53:41'),
(15, 739, 2, 74, '1', '0', '2023-02-05 15:54:11', '2023-02-05 15:54:11'),
(16, 762, 3, 75, '1', '0', '2023-03-03 14:46:49', '2023-03-03 14:46:49'),
(17, 762, 3, 76, '1', '0', '2023-03-03 14:50:58', '2023-03-03 14:50:58'),
(18, 767, 3, 81, '1', '0', '2023-03-16 22:41:27', '2023-03-16 22:41:27'),
(19, 784, 3, 83, '1', '0', '2023-04-13 15:42:45', '2023-04-13 15:42:45'),
(20, 810, 3, 97, '1', '0', '2023-05-20 10:21:25', '2023-05-20 10:21:25'),
(21, 810, 3, 98, '1', '0', '2023-05-22 14:52:10', '2023-05-22 14:52:10'),
(22, 828, 3, 101, '1', '0', '2023-06-03 14:43:55', '2023-06-03 14:43:55'),
(23, 828, 3, 102, '1', '0', '2023-06-03 14:46:30', '2023-06-03 14:46:30'),
(24, 828, 3, 103, '1', '0', '2023-06-03 14:46:45', '2023-06-03 14:46:45'),
(25, 839, 3, 109, '1', '0', '2023-07-18 15:43:34', '2023-07-18 15:43:34'),
(26, 839, 3, 110, '1', '0', '2023-07-18 15:44:48', '2023-07-18 15:44:48'),
(27, 840, 3, 112, '1', '0', '2023-08-01 06:57:38', '2023-08-01 06:57:38'),
(29, 841, 2, 120, '1', '0', '2023-08-01 16:01:28', '2023-08-01 16:01:28'),
(30, 841, 2, 121, '1', '0', '2023-08-01 16:01:38', '2023-08-01 16:01:38'),
(31, 841, 2, 122, '1', '0', '2023-08-01 16:01:55', '2023-08-01 16:01:55'),
(32, 841, 2, 123, '1', '0', '2023-08-01 16:02:05', '2023-08-01 16:02:05'),
(33, 846, 3, 124, '1', '0', '2023-08-09 10:41:48', '2023-08-09 10:41:48'),
(34, 846, 3, 124, '1', '0', '2023-08-09 10:41:56', '2023-08-09 10:41:56'),
(35, 846, 3, 125, '1', '0', '2023-08-09 10:44:18', '2023-08-09 10:44:18'),
(36, 846, 3, 125, '1', '0', '2023-08-09 10:44:25', '2023-08-09 10:44:25'),
(37, 846, 3, 126, '1', '0', '2023-08-09 15:47:09', '2023-08-09 15:47:09'),
(38, 846, 3, 127, '1', '0', '2023-08-09 15:52:08', '2023-08-09 15:52:08'),
(39, 846, 3, 129, '1', '0', '2023-08-09 15:53:20', '2023-08-09 15:53:20'),
(51, 840, 3, 115, '1', '0', '2023-08-17 14:38:54', '2023-08-17 14:38:54'),
(53, 839, 3, 148, '1', '0', '2023-08-17 15:22:02', '2023-08-17 15:22:02'),
(54, 840, 3, 149, '1', '0', '2023-08-17 15:26:24', '2023-08-17 15:26:24'),
(55, 840, 3, 152, '1', '0', '2023-08-17 15:27:40', '2023-08-17 15:27:40'),
(56, 840, 3, 154, '1', '0', '2023-08-17 15:28:30', '2023-08-17 15:28:30'),
(59, 840, 3, 157, '1', '0', '2023-08-17 15:29:05', '2023-08-17 15:29:05'),
(60, 876, 3, 166, '1', '0', '2024-02-08 18:48:13', '2024-02-08 18:48:13'),
(61, 884, 2, 167, '1', '0', '2024-03-07 14:07:48', '2024-03-07 14:07:48');

-- --------------------------------------------------------

--
-- Table structure for table `agents_notes`
--

CREATE TABLE `agents_notes` (
  `notes_id` int NOT NULL,
  `notes` longtext,
  `notes_type` enum('1','2','3','4','5') DEFAULT NULL COMMENT '1=messages_notes,2=asked_question_notes,3=return_answer_notes,4=asked proposal  yani ki agar ksine az ne b/s ko propsal share kiya h to buyer/seller unhe note de sakta h,5=s/b/az',
  `notes_item_id` int DEFAULT NULL,
  `notes_item_parent_id` int DEFAULT NULL,
  `sender_id` int DEFAULT NULL,
  `sender_role` int DEFAULT NULL,
  `receiver_id` int DEFAULT NULL,
  `receiver_role` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_notes`
--

INSERT INTO `agents_notes` (`notes_id`, `notes`, `notes_type`, `notes_item_id`, `notes_item_parent_id`, `sender_id`, `sender_role`, `receiver_id`, `receiver_role`, `created_at`, `updated_at`) VALUES
(6, 'Heellllooooo\nTesting Notes \nthanks', NULL, NULL, NULL, 653, 3, NULL, NULL, '2022-12-10 15:27:23', '2022-12-10 15:27:23'),
(7, NULL, NULL, NULL, NULL, 656, 3, NULL, NULL, '2022-12-12 12:24:43', '2022-12-12 12:24:43'),
(8, NULL, NULL, NULL, NULL, 656, 3, NULL, NULL, '2022-12-12 14:24:05', '2022-12-12 14:24:05'),
(9, 'null', NULL, NULL, NULL, 656, 3, NULL, NULL, '2022-12-12 15:00:36', '2022-12-12 15:00:36'),
(10, 'Heelo', NULL, NULL, NULL, 646, 3, NULL, NULL, '2022-12-16 11:54:08', '2022-12-16 11:54:08'),
(11, 'Hello vemroo', NULL, NULL, NULL, 646, 3, NULL, NULL, '2022-12-16 11:55:53', '2022-12-16 11:55:53'),
(12, 'Hello vemroo', NULL, NULL, NULL, 646, 3, NULL, NULL, '2022-12-16 11:55:54', '2022-12-16 11:55:54'),
(13, 'Hello, is there any body', NULL, NULL, NULL, 625, 3, NULL, NULL, '2022-12-16 13:15:39', '2022-12-16 13:15:39'),
(14, 'null', NULL, NULL, NULL, 625, 3, NULL, NULL, '2022-12-16 13:15:43', '2022-12-16 13:15:43'),
(16, 'edit hello23', NULL, NULL, NULL, 558, 2, NULL, NULL, '2022-12-20 01:03:09', '2022-12-20 01:06:35'),
(17, 'hello, i am priya', NULL, NULL, NULL, 656, 3, NULL, NULL, '2022-12-20 01:41:58', '2022-12-20 01:41:58'),
(18, 'Hello Priya\nHow are you', NULL, NULL, NULL, 656, 3, NULL, NULL, '2022-12-20 02:16:53', '2022-12-20 02:16:53'),
(19, 'Hello', NULL, NULL, NULL, 625, 3, NULL, NULL, '2022-12-21 15:05:33', '2022-12-21 15:05:33'),
(20, NULL, NULL, NULL, NULL, 656, 3, NULL, NULL, '2022-12-21 15:24:11', '2022-12-21 15:24:11'),
(21, 'Tgbb', NULL, NULL, NULL, 656, 3, NULL, NULL, '2022-12-21 15:24:19', '2022-12-21 15:24:19'),
(22, '1712 E Mason St, Green Bay, West Virginia', NULL, NULL, NULL, 645, 3, NULL, NULL, '2022-12-22 11:31:54', '2022-12-22 11:31:54'),
(23, 'Hi Guru', NULL, NULL, NULL, 656, 3, NULL, NULL, '2022-12-26 12:27:31', '2022-12-26 12:27:31'),
(24, NULL, NULL, NULL, NULL, 656, 3, NULL, NULL, '2022-12-26 12:28:00', '2022-12-26 12:28:00'),
(25, 'This is Notes', '5', 550, 48, 656, 3, 550, 4, '2022-12-26 13:04:56', '2022-12-26 13:04:56'),
(26, '<b>Testsetrtwerwerwe</b>', '5', 672, 50, 671, 3, 672, 4, '2022-12-27 13:19:00', '2022-12-27 13:19:00'),
(27, 'sfsfdsfsdfdsfdsf', '5', 672, 52, 671, 2, 672, 4, '2022-12-27 13:28:27', '2022-12-27 13:28:27'),
(28, 'Gshshsh', NULL, NULL, NULL, 651, 3, NULL, NULL, '2022-12-27 18:46:59', '2022-12-27 18:46:59'),
(29, 'Hi \nI am Ahmad\nI am a react native developer', NULL, NULL, NULL, 625, 3, NULL, NULL, '2022-12-28 00:48:34', '2022-12-28 00:48:34'),
(30, 'hello, Grayson', NULL, NULL, NULL, 625, 4, NULL, NULL, '2022-12-28 00:58:42', '2022-12-28 00:58:42'),
(31, 'Hello\nAhmad\nI am a react native developer\nI have 2 years experience\nI make various Applications', NULL, NULL, NULL, 625, 4, NULL, NULL, '2022-12-28 01:00:13', '2022-12-28 01:00:13'),
(32, 'get notes issue is fixed\nNow what next', NULL, NULL, NULL, 625, 4, NULL, NULL, '2022-12-28 01:01:48', '2022-12-28 01:01:48'),
(33, 'Change password issue from backend', NULL, NULL, NULL, 625, 4, NULL, NULL, '2022-12-28 01:02:02', '2022-12-28 01:02:02'),
(34, 'Now whats your plan', NULL, NULL, NULL, 625, 4, NULL, NULL, '2022-12-28 01:02:10', '2022-12-28 01:02:10'),
(35, 'hshsjdjdjdkkdkdkdkdjdjdjjdjdjdjdjsjsjkskskskskmsmdmdndndndndnndndndndndndndnndnsnsnznxbbxbxbxbbxx', NULL, NULL, NULL, 625, 4, NULL, NULL, '2022-12-28 01:02:45', '2022-12-28 01:02:45'),
(36, 'Hello , here I am going to start my business', NULL, NULL, NULL, 651, 2, NULL, NULL, '2022-12-28 12:35:25', '2022-12-28 12:35:25'),
(37, 'Hello..Seller there.. I\'m trying to save this note..', NULL, NULL, NULL, 647, 3, NULL, NULL, '2022-12-28 13:23:54', '2022-12-28 13:23:54'),
(38, 'Hello....buyer here .I am trying to save my note', NULL, NULL, NULL, 645, 2, NULL, NULL, '2022-12-28 13:52:52', '2022-12-28 13:52:52'),
(39, 'Hii...buyer here...I want to save this note..', NULL, NULL, NULL, 651, 2, NULL, NULL, '2022-12-28 14:38:11', '2022-12-28 14:38:11'),
(40, 'Hii there...I\'m trying to save note', NULL, NULL, NULL, 627, 4, NULL, NULL, '2022-12-28 15:05:22', '2022-12-28 15:05:22'),
(41, 'Hello\nHow are you grayson', NULL, NULL, NULL, 625, 4, NULL, NULL, '2022-12-28 16:41:13', '2022-12-28 16:41:13'),
(42, 'Hdhfditsigxjtr6icy jfsjgsjtz', NULL, NULL, NULL, 651, 2, NULL, NULL, '2022-12-28 18:39:20', '2022-12-28 18:39:20'),
(43, 'Jdhshdhdhdhdsjsj', NULL, NULL, NULL, 651, 2, NULL, NULL, '2022-12-29 19:59:34', '2022-12-29 19:59:34'),
(44, 'Test notes', NULL, NULL, NULL, 675, 2, NULL, NULL, '2022-12-30 16:28:29', '2022-12-30 16:28:29'),
(45, 'Trstgbb', NULL, NULL, NULL, 656, 3, NULL, NULL, '2023-01-01 16:07:22', '2023-01-01 16:07:22'),
(46, 'This is test note', NULL, NULL, NULL, 656, 3, NULL, NULL, '2023-01-01 16:08:45', '2023-01-01 16:08:45'),
(47, NULL, NULL, NULL, NULL, 656, 3, NULL, NULL, '2023-01-03 11:51:50', '2023-01-03 11:51:50'),
(48, 'null', NULL, NULL, NULL, 656, 3, NULL, NULL, '2023-01-03 11:52:15', '2023-01-03 11:52:15'),
(49, 'Ucuvjbv', NULL, NULL, NULL, 645, 2, NULL, NULL, '2023-01-03 16:37:40', '2023-01-03 16:37:40'),
(50, 'Heleljslsmellssjsls.  Slns absla s js a j thegexy8x3h7shx8whduwbx7hed7cexuwvzvwd6b2s. STAY shama snja as z hsnsiwbwy hsnsiwbwy b bis and 37u3being 82 w2 8g', NULL, NULL, NULL, 645, 2, NULL, NULL, '2023-01-03 16:38:10', '2023-01-03 16:38:10'),
(51, 'Gdhdjdbzbdbzbdbxhdbd', NULL, NULL, NULL, 645, 2, NULL, NULL, '2023-01-03 17:03:49', '2023-01-03 17:03:49'),
(52, 'Hzhsjhsvsbdisjsbs', NULL, NULL, NULL, 645, 2, NULL, NULL, '2023-01-03 17:15:45', '2023-01-03 17:15:45'),
(53, 'Hzjsijs jsgwjwhsh. Kqkwoqlqjs kskanwbs mabw w wmaksbs.  Sksjsbsbjsbsd.', NULL, NULL, NULL, 645, 2, NULL, NULL, '2023-01-03 17:16:05', '2023-01-03 17:16:05'),
(54, 'Jsusuevsjshs.  Skakwn wsbjsbsvbsbsvsvsgsvshz zbjz s sjsksb s sjsbs', NULL, NULL, NULL, 645, 2, NULL, NULL, '2023-01-03 17:16:21', '2023-01-03 17:16:21'),
(55, 'Ghgvvvvbb', NULL, NULL, NULL, 692, 4, NULL, NULL, '2023-01-04 08:11:02', '2023-01-04 08:11:02'),
(56, 'Bbbbnnnnn', NULL, NULL, NULL, 692, 4, NULL, NULL, '2023-01-04 08:11:18', '2023-01-04 08:11:18'),
(57, NULL, NULL, NULL, NULL, 656, 3, NULL, NULL, '2023-01-04 08:22:16', '2023-01-04 08:22:16'),
(58, 'Bs synwynyw. Again. Gq. We. Ag qg gwg. Wg', NULL, NULL, NULL, 645, 2, NULL, NULL, '2023-01-04 11:08:28', '2023-01-04 11:08:28'),
(59, '<p>This is a Test Notes</p><p><br></p><p style=\"margin-bottom: 20px; font-size: 14px; line-height: 24px; color: rgb(25, 23, 23); font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; text-align: center; background-color: rgb(232, 238, 235);\"><span class=\"head\" style=\"font-weight: 700; color: rgb(0, 72, 34);\">Master Bedrooms</span><br>Flooring : Vitrified tile<br>Walls : Putty / POP<br>Ceiling : Putty / POP</p><p style=\"margin-bottom: 20px; font-size: 14px; line-height: 24px; color: rgb(25, 23, 23); font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; text-align: center; background-color: rgb(232, 238, 235);\"><span class=\"head\" style=\"font-weight: 700; color: rgb(0, 72, 34);\">Balcony</span><br>Flooring : Anti Skid Tiles<br>Ceiling : Putty / POP<br>Walls : Putty / POP<br></p><p style=\"margin-bottom: 20px; font-size: 14px; line-height: 24px; color: rgb(25, 23, 23); font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; text-align: center; background-color: rgb(232, 238, 235);\"><span class=\"head\" style=\"font-weight: 700; color: rgb(0, 72, 34);\">Kitchen</span><br>Flooring : Anti Skid Tiles<br>Ceiling : Putty / POP<br>Walls : Putty / POP, Ceramic tiles-dado up to 2 feet above working platform<br>Granite counter with stainless steel sink</p>', '5', 670, 64, 707, 2, 670, 4, '2023-01-09 14:39:20', '2023-01-09 14:39:20'),
(60, '<p>This is a Test Notes</p><p><br></p><p style=\"margin-bottom: 20px; font-size: 14px; line-height: 24px; color: rgb(25, 23, 23); font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; text-align: center; background-color: rgb(232, 238, 235);\"><span class=\"head\" style=\"font-weight: 700; color: rgb(0, 72, 34);\">Master Bedrooms</span><br>Flooring : Vitrified tile<br>Walls : Putty / POP<br>Ceiling : Putty / POP</p><p style=\"margin-bottom: 20px; font-size: 14px; line-height: 24px; color: rgb(25, 23, 23); font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; text-align: center; background-color: rgb(232, 238, 235);\"><span class=\"head\" style=\"font-weight: 700; color: rgb(0, 72, 34);\">Balcony</span><br>Flooring : Anti Skid Tiles<br>Ceiling : Putty / POP<br>Walls : Putty / POP<br></p><p style=\"margin-bottom: 20px; font-size: 14px; line-height: 24px; color: rgb(25, 23, 23); font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; text-align: center; background-color: rgb(232, 238, 235);\"><span class=\"head\" style=\"font-weight: 700; color: rgb(0, 72, 34);\">Kitchen</span><br>Flooring : Anti Skid Tiles<br>Ceiling : Putty / POP<br>Walls : Putty / POP, Ceramic tiles-dado up to 2 feet above working platform<br>Granite counter with stainless steel sink</p>', '5', 670, 64, 707, 2, 670, 4, '2023-01-09 14:39:57', '2023-01-09 14:39:57'),
(61, '<span style=\"font-family: muli, Helvetica, Arial, sans-serif; font-size: 14.336px; letter-spacing: 0.384px; text-align: justify;\">Prestige Group has firmly established itself as one of the leading and most successful developers of real estate in India by imprinting its indelible mark across all asset classes. Founded in 1986, the group’s turnover is today in excess of Rs 3518 Cr (for FY 15); a leap that has been inspired by CMD Irfan Razack and marshaled by his brothers Rezwan Razack and Noaman Razack. Having completed 210 projects covering over 80 million sq ft, currently the company has 53 ongoing projects spanning 54 million sq ft and 35 upcoming projects aggregating to 48 million sq ft of world-class real estate space across asset classes. In October 2010, the Prestige Group also successfully entered the Capital Market with an Initial Public Offering of Rs 1200 cr.</span>', '5', 709, 68, 656, 3, 709, 4, '2023-01-11 14:10:04', '2023-01-11 14:10:04'),
(62, 'Aur baki sabbb ..........', NULL, NULL, NULL, 645, 2, NULL, NULL, '2023-01-14 11:17:46', '2023-01-14 11:17:46'),
(63, 'Hmmmmm', NULL, NULL, NULL, 710, 3, NULL, NULL, '2023-01-16 12:20:57', '2023-01-16 12:20:57'),
(64, '<span style=\"color: rgb(5, 107, 235); font-family: CircularXX, &quot;Circular Pro&quot;, &quot;Helvetica Neue&quot;, Arial, sans-serif; font-size: 16px;\">038252</span>', '5', 709, 74, 714, 3, 709, 4, '2023-01-16 18:00:40', '2023-01-16 18:00:40'),
(65, 'Oouueyeyyeuwuwt', NULL, NULL, NULL, 707, 3, NULL, NULL, '2023-01-19 12:52:57', '2023-01-19 12:52:57'),
(66, 'Bahhw suqbauq baha baha baha naha. Baha. Bahab Abba a bahaba. Abba a bAbbaabha a Abba abababba abab a a Ababa a aba a ababq aha aha baha b', NULL, NULL, NULL, 670, 4, NULL, NULL, '2023-01-19 15:12:25', '2023-01-19 15:12:25'),
(67, 'Hello my 1st notes', NULL, NULL, NULL, 716, 3, NULL, NULL, '2023-01-21 02:05:16', '2023-01-21 02:05:16'),
(68, 'My 2nd notes 1/20/2023', NULL, NULL, NULL, 716, 3, NULL, NULL, '2023-01-21 02:08:53', '2023-01-21 02:08:53'),
(69, '3rd notes', NULL, NULL, NULL, 716, 3, NULL, NULL, '2023-01-21 11:22:36', '2023-01-21 11:22:36'),
(70, 'This is test notes.', NULL, NULL, NULL, 656, 3, NULL, NULL, '2023-01-30 06:52:21', '2023-01-30 06:52:21'),
(71, 'This is test post...created on 30th jan 2023', NULL, NULL, NULL, 707, 3, NULL, NULL, '2023-01-30 16:39:57', '2023-01-30 16:39:57'),
(72, 'This is Post by Pindi', '5', 707, 75, 709, 4, 707, 3, '2023-01-31 18:08:56', '2023-01-31 18:08:56'),
(73, NULL, NULL, NULL, NULL, 724, 2, NULL, NULL, '2023-02-01 02:30:34', '2023-02-01 02:30:34'),
(74, 'ASDHIASDH', '5', 735, 103, 739, 2, 735, 4, '2023-02-05 15:43:06', '2023-02-05 15:43:06'),
(75, NULL, NULL, NULL, NULL, 724, 2, NULL, NULL, '2023-02-06 00:03:56', '2023-02-06 00:03:56'),
(76, 'App', NULL, NULL, NULL, 724, 2, NULL, NULL, '2023-02-06 00:04:01', '2023-02-06 00:04:01'),
(77, 'Jsjdjddk', NULL, NULL, NULL, 724, 2, NULL, NULL, '2023-02-06 00:26:08', '2023-02-06 00:26:08'),
(78, 'Test', NULL, NULL, NULL, 744, 2, NULL, NULL, '2023-02-06 01:48:15', '2023-02-06 01:48:15'),
(79, 'Xjfyjfhxjffngdjfg gjfhgcf', NULL, NULL, NULL, 651, 2, NULL, NULL, '2023-02-13 14:15:38', '2023-02-13 14:15:38'),
(80, 'heosdjlsmsm,', '5', 670, 111, 762, 3, 670, 4, '2023-03-03 14:42:48', '2023-03-03 14:42:48'),
(81, 'Yeyggdhjjdbvghdnk', NULL, NULL, NULL, 762, 3, NULL, NULL, '2023-03-04 18:05:46', '2023-03-04 18:05:46'),
(82, 'Fhhtg', NULL, NULL, NULL, 762, 3, NULL, NULL, '2023-03-04 21:24:12', '2023-03-04 21:24:12'),
(83, 'This is only for testing purpose', NULL, NULL, NULL, 767, 2, NULL, NULL, '2023-03-13 21:08:17', '2023-03-13 21:08:17'),
(84, 'Ufiyf ifyif oydiyf udiy guru jgu jguf jgug hg7gu jgug jgurgih vtfihi ufug8vif6t8.  Vug78t.  Ug7y8', NULL, NULL, NULL, 767, 2, NULL, NULL, '2023-03-13 21:08:46', '2023-03-13 21:08:46'),
(85, NULL, NULL, NULL, NULL, 767, 2, NULL, NULL, '2023-03-13 21:38:49', '2023-03-13 21:38:49'),
(86, 'null', NULL, NULL, NULL, 767, 2, NULL, NULL, '2023-03-13 21:38:51', '2023-03-13 21:38:51'),
(87, 'null', NULL, NULL, NULL, 767, 2, NULL, NULL, '2023-03-13 21:44:14', '2023-03-13 21:44:14'),
(88, NULL, NULL, NULL, NULL, 774, 4, NULL, NULL, '2023-03-16 22:09:29', '2023-03-16 22:09:29'),
(89, 'Need to understand the basic selling process through santosh', '5', 774, 124, 767, 3, 774, 4, '2023-03-16 22:43:42', '2023-03-16 22:43:42'),
(90, 'Looking for experienced agent', '5', 767, 118, 769, 4, 767, 3, '2023-03-16 22:50:40', '2023-03-16 22:50:40'),
(91, 'Hu', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-03-26 17:06:11', '2023-03-26 17:06:11'),
(92, 'Hjejjdjdjdjjdjjdjdjdjjdjdjdjdjdjdjdjjdjdjdjdjjdjdjdjdjdjjdjdjdjjdjdjdjdjfjdjdjjdhdhfjrjdjdjdjjdjdjfjfjfjjfjfjfjfjfjjfjfjfjjfjfjfjjfjfjfjfjfjjfnfjfjfjfjfjjfjfjfjfjjfjfjrj', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-03-26 17:06:34', '2023-03-26 17:06:34'),
(93, 'Ndjdjdjdjjdjdjdjdjdj Ndjjdjdjjdjrjdhrhdhrhrhhrhdhrhrhrhrhrhgsfsfwjkwkkekehebdbdbndndjdjdjrhveceechejeieieikejeheggdhriowowowjehdhgdndkslkdndhdghdudieoeejjjdjdjdjjdjdjdjdjdjdjjejdjdjjdjfjjfjfjdjjfjfhfhfhfhfhhfhfhfhfhhdhdhdhhdhrhrhrhhdhrhhrhrhrhrhhrhrhrhrhrhrhrhhrhrhrhrhrhhrhrhfhrhhrhrhfhrhrhrhhrhrhrhrhrhhrhfhrhhdhrhdhdhjjjdjhdhdhhddhhdhdhhrhffhrgrhrhrjhrhrhrhrhrhhrhrhrhrhhrhrhrhrhhrhrhhrhrhrhrhhrhrhrhrhrhrhthrhrhrhrhrhhrhrhrhrhrhrhrhrhhrhrhrhrhrhhrhrhfhrhhrhdhhdhdhrhhrhrhfhrhrhrhh', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-03-26 17:07:50', '2023-03-26 17:07:50'),
(94, 'null', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-03-26 17:17:13', '2023-03-26 17:17:13'),
(95, 'null', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-03-26 17:17:23', '2023-03-26 17:17:23'),
(96, 'null', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-03-26 17:20:50', '2023-03-26 17:20:50'),
(97, 'null', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-03-26 17:23:41', '2023-03-26 17:23:41'),
(98, 'null', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-03-26 17:23:46', '2023-03-26 17:23:46'),
(99, 'null', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-03-26 17:23:52', '2023-03-26 17:23:52'),
(100, 'null', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-03-26 17:24:21', '2023-03-26 17:24:21'),
(101, 'null', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-03-26 17:24:59', '2023-03-26 17:24:59'),
(102, 'null', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-03-26 17:25:14', '2023-03-26 17:25:14'),
(103, 'null', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-03-26 17:25:19', '2023-03-26 17:25:19'),
(104, 'Hu', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-03-26 17:26:11', '2023-03-26 17:26:11'),
(105, 'Hey', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-03-26 17:26:34', '2023-03-26 17:26:34'),
(106, 'Byee', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-03-26 17:26:42', '2023-03-26 17:26:42'),
(107, 'Nn', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-03-26 17:33:55', '2023-03-26 17:33:55'),
(109, 'HELLO NOTES THERE', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-05-16 15:02:00', '2023-05-16 15:02:00'),
(110, '123456', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-05-16 16:22:59', '2023-05-16 16:22:59'),
(111, '123456', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-05-16 16:22:59', '2023-05-16 16:22:59'),
(112, '123456', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-05-16 16:22:59', '2023-05-16 16:22:59'),
(113, '123456', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-05-16 16:23:00', '2023-05-16 16:23:00'),
(114, '123456', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-05-16 16:23:00', '2023-05-16 16:23:00'),
(115, '123456', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-05-16 16:23:00', '2023-05-16 16:23:00'),
(116, '123456', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-05-16 16:23:00', '2023-05-16 16:23:00'),
(117, '123456', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-05-18 10:22:22', '2023-05-18 10:22:22'),
(118, '123456', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-05-18 10:23:08', '2023-05-18 10:23:08'),
(119, '123456', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-05-18 10:23:08', '2023-05-18 10:23:08'),
(120, '123456', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-05-18 10:23:08', '2023-05-18 10:23:08'),
(121, 'HELLO NOTES THERE', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-05-19 16:07:44', '2023-05-19 16:07:44'),
(122, 'hello', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-25 12:20:02', '2023-05-25 12:20:02'),
(123, 'hello', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-25 12:20:04', '2023-05-25 12:20:04');
INSERT INTO `agents_notes` (`notes_id`, `notes`, `notes_type`, `notes_item_id`, `notes_item_parent_id`, `sender_id`, `sender_role`, `receiver_id`, `receiver_role`, `created_at`, `updated_at`) VALUES
(124, '<p>Hello Agent this is a note for you&nbsp;</p>', '5', 830, 137, 828, 3, 830, 4, '2023-06-03 14:24:21', '2023-06-03 14:24:21');
INSERT INTO `agents_notes` (`notes_id`, `notes`, `notes_type`, `notes_item_id`, `notes_item_parent_id`, `sender_id`, `sender_role`, `receiver_id`, `receiver_role`, `created_at`, `updated_at`) VALUES
(125, '<p>Hello Agent this is a note for you&nbsp;</p>', '5', 830, 137, 828, 3, 830, 4, '2023-06-03 14:25:45', '2023-06-03 14:25:45');
INSERT INTO `agents_notes` (`notes_id`, `notes`, `notes_type`, `notes_item_id`, `notes_item_parent_id`, `sender_id`, `sender_role`, `receiver_id`, `receiver_role`, `created_at`, `updated_at`) VALUES
(126, '<p>Hello Agent this is a note for you&nbsp;</p>', '5', 830, 137, 828, 3, 830, 4, '2023-06-03 14:26:39', '2023-06-03 14:26:39');
INSERT INTO `agents_notes` (`notes_id`, `notes`, `notes_type`, `notes_item_id`, `notes_item_parent_id`, `sender_id`, `sender_role`, `receiver_id`, `receiver_role`, `created_at`, `updated_at`) VALUES
(127, '<p>Hello Agent this is a note for you&nbsp;</p>', '5', 830, 137, 828, 3, 830, 4, '2023-06-03 14:34:38', '2023-06-03 14:34:38'),
(128, 'Helloheheheh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-12 10:52:54', '2023-07-12 10:52:54'),
(129, 'Hello', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-12 11:05:22', '2023-07-12 11:05:22'),
(130, 'Hello', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-12 11:05:28', '2023-07-12 11:05:28'),
(131, 'hi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-12 11:05:39', '2023-07-12 11:05:39'),
(132, 'HELLO NOTES THERE', NULL, NULL, NULL, 834, 3, NULL, NULL, '2023-07-13 14:41:30', '2023-07-13 14:41:30'),
(133, 'hello', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-13 14:47:57', '2023-07-13 14:47:57'),
(134, 'HELLO NOTES THERE', NULL, NULL, NULL, 834, 4, NULL, NULL, '2023-07-13 15:03:03', '2023-07-13 15:03:03'),
(135, 'HELLO NOTES THERE', NULL, NULL, NULL, 755, 3, NULL, NULL, '2023-07-17 11:42:37', '2023-07-17 11:42:37'),
(137, 'Hello thius is note', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-18 13:33:51', '2023-07-18 13:33:51'),
(138, 'Hello thius is note', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-18 13:34:58', '2023-07-18 13:34:58'),
(146, 'note 1', NULL, NULL, NULL, 835, 3, NULL, NULL, '2023-07-19 11:59:00', '2023-07-19 12:02:00'),
(147, 'this is dummy note', NULL, NULL, NULL, 835, 3, NULL, NULL, '2023-07-19 12:00:29', '2023-07-19 12:00:29'),
(148, 'hey its working', NULL, NULL, NULL, 835, 3, NULL, NULL, '2023-07-19 12:00:43', '2023-07-19 12:00:43'),
(149, 'is that true that earth is round', NULL, NULL, NULL, 835, 3, NULL, NULL, '2023-07-19 12:01:08', '2023-07-19 12:06:57'),
(151, 'qwertyui updated', NULL, NULL, NULL, 835, 3, NULL, NULL, '2023-07-19 12:07:17', '2023-07-19 12:12:45'),
(152, 'Please connect', '5', 842, 153, 841, 2, 842, 4, '2023-08-02 12:32:36', '2023-08-02 12:32:36'),
(153, 'P<b><u><font face=\"Courier New\" style=\"background-color: rgb(255, 255, 0);\">lease connect ASAP</font></u></b>', '5', 842, 153, 841, 2, 842, 4, '2023-08-02 17:11:04', '2023-08-02 17:11:04'),
(154, 'P<b><u><font face=\"Courier New\" style=\"background-color: rgb(255, 255, 0);\">lease connect ASAP</font></u></b>', '5', 842, 153, 841, 2, 842, 4, '2023-08-02 17:11:18', '2023-08-02 17:11:18'),
(155, 'P<b><u><font face=\"Courier New\" style=\"background-color: rgb(255, 255, 0);\">lease connect ASAP</font></u></b>', '5', 842, 153, 841, 2, 842, 4, '2023-08-08 10:25:44', '2023-08-08 10:25:44'),
(156, 'P<b><u><font face=\"Courier New\" style=\"background-color: rgb(255, 255, 0);\">lease connect ASAPasd</font></u></b>', '5', 842, 153, 841, 2, 842, 4, '2023-08-09 09:34:27', '2023-08-09 09:34:27'),
(157, 'ASDhgasgdgasgdasdasd', '5', 762, 111, 670, 4, 762, 3, '2023-08-10 15:15:46', '2023-08-10 15:15:46'),
(158, 'Test', '5', 762, 111, 670, 4, 762, 3, '2023-08-10 15:15:58', '2023-08-10 15:15:58'),
(159, 'qweqwe', '5', 762, 111, 670, 4, 762, 3, '2023-08-17 11:55:26', '2023-08-17 11:55:26'),
(160, 'fsfsfsfsfsd', '5', 762, 111, 670, 4, 762, 3, '2023-08-17 16:03:06', '2023-08-17 16:03:06'),
(161, 'asfafsd', '5', 762, 111, 670, 4, 762, 3, '2023-08-17 16:03:43', '2023-08-17 16:03:43'),
(162, 'sdfsdfdsf', '5', 762, 111, 670, 4, 762, 3, '2023-08-17 16:10:23', '2023-08-17 16:10:23'),
(163, 'csdfsdf', '5', 762, 111, 670, 4, 762, 3, '2023-08-17 16:10:34', '2023-08-17 16:10:34'),
(164, 'safafsfdsgfdgfgf', '5', 762, 111, 670, 4, 762, 3, '2023-08-17 16:36:12', '2023-08-17 16:36:12'),
(165, 'fhjgfjhjfghjgfhgg', '5', 762, 111, 670, 4, 762, 3, '2023-08-17 16:36:23', '2023-08-17 16:36:23'),
(166, 'Hello 1244', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-23 07:15:38', '2023-09-23 07:15:38'),
(167, 'Hello 1244', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-23 07:15:38', '2023-09-23 07:15:38'),
(168, 'Hello 1244', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-23 07:15:39', '2023-09-23 07:15:39'),
(169, 'Hello 1244', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-23 07:15:39', '2023-09-23 07:15:39'),
(170, 'Hello 1244', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-23 07:15:40', '2023-09-23 07:15:40'),
(171, 'Hello 1244', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-23 07:15:40', '2023-09-23 07:15:40'),
(172, 'Hello 1244', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-23 07:15:41', '2023-09-23 07:15:41');
INSERT INTO `agents_notes` (`notes_id`, `notes`, `notes_type`, `notes_item_id`, `notes_item_parent_id`, `sender_id`, `sender_role`, `receiver_id`, `receiver_role`, `created_at`, `updated_at`) VALUES
(173, 'Hello 1244', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-23 07:15:41', '2023-09-23 07:15:41'),
(174, 'Notes', '5', 860, 161, 859, 3, 860, 4, '2023-12-28 11:29:04', '2023-12-28 11:29:04'),
(175, '<p>Notes section</p><p><br></p>', '5', 860, 161, 859, 3, 860, 4, '2023-12-28 11:38:15', '2023-12-28 11:38:15'),
(177, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-26 23:30:05', '2024-01-26 23:30:05'),
(178, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-26 23:33:41', '2024-01-26 23:33:41'),
(179, 'dfasfs', '1', 1, 1, 827, 2, 23, 1, '2024-01-26 23:35:03', '2024-01-26 23:42:49'),
(180, 'Test', '5', 891, 193, 896, 2, 891, 4, '2024-03-24 03:17:15', '2024-03-24 03:17:15'),
(181, 'Test note<br>', '5', 906, 202, 905, 4, 906, 3, '2024-05-04 18:19:36', '2024-05-04 18:19:36');

-- --------------------------------------------------------

--
-- Table structure for table `agents_notification`
--

CREATE TABLE `agents_notification` (
  `notification_id` int NOT NULL,
  `notification_type` enum('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16') NOT NULL COMMENT '1=agent share ask question,2=agent share upload and share,3=agent share default proposal,4=b/s  share ask question,5=b/s share upload and share,6=join messaging and chating,7=send new msg,8=answer rating,9=message rating,10=asked question return answer any user,11=new s/a/b send connection ->notification_item_id is m connection_id rahe gi or ->notification_child_item_id is me post ki id rahe gi 12 = b/s ke conected user ko new post add hoti h to notification jaye ga ki es buyer n new post ki h ,13=post applied agents selecte, 14=buyer/seller give a reviwe or rating for agent ye notification agent ko dikhe ga , 15=agent give a reviwe or rating for buyer/seller post  ko ye notification  buyer/seller ko dikhe ga ,16=agent payment done thene give a rating s/b post pr ',
  `notification_message` varchar(1000) DEFAULT NULL,
  `notification_item_id` int DEFAULT NULL,
  `notification_child_item_id` int DEFAULT NULL,
  `notification_post_id` int DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1=unread,2=read',
  `sender_id` int DEFAULT NULL,
  `sender_role` int DEFAULT NULL,
  `receiver_id` int DEFAULT NULL,
  `receiver_role` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `show` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1=show,2=hide'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_notification`
--

INSERT INTO `agents_notification` (`notification_id`, `notification_type`, `notification_message`, `notification_item_id`, `notification_child_item_id`, `notification_post_id`, `status`, `sender_id`, `sender_role`, `receiver_id`, `receiver_role`, `created_at`, `updated_at`, `show`) VALUES
(1, '6', 'hamza buyer just joined you on Messag!', 1, 18, NULL, '2', 549, 3, 550, 4, '2022-09-18 03:56:04', '2022-09-18 03:56:40', '1'),
(2, '7', 'hamza buyer send a message: ok', 1, 1, NULL, '2', 549, 3, 550, 4, '2022-09-18 04:01:53', '2022-09-18 04:02:10', '1'),
(3, '7', 'test agent send a message: yes', 2, 1, NULL, '2', 550, 4, 549, 3, '2022-09-18 04:02:09', '2023-07-18 15:32:30', '1'),
(4, '7', 'hamza buyer send a message: gud luck for the work', 3, 1, NULL, '2', 549, 3, 550, 4, '2022-09-18 04:03:04', '2022-09-18 04:03:43', '1'),
(5, '7', 'test agent send a message: ok', 4, 1, NULL, '1', 550, 4, 549, 3, '2022-09-18 04:03:42', '2022-09-18 04:03:42', '1'),
(6, '13', 'Hamza Seller select you for post (One old house)', 19, 550, 19, '1', 549, 3, 550, 4, '2022-09-18 05:33:46', '2022-09-18 05:33:46', '1'),
(7, '11', 'test agent contact related to post(Illo doloremque quid)', 1, 20, NULL, '1', 550, 4, 549, 3, '2022-09-18 20:07:01', '2022-09-19 03:07:01', '1'),
(8, '3', 'test agent share a proposal related to your post `Illo doloremque quid`', 1, 1, NULL, '2', 550, 4, 549, 3, '2022-09-18 20:08:32', '2022-09-19 03:09:40', '1'),
(9, '13', 'Hamza Seller select you for post (Illo doloremque quid)', 20, 550, 20, '1', 549, 3, 550, 4, '2022-09-19 03:10:01', '2022-09-19 03:10:01', '1'),
(10, '13', 'Hamza Seller select you for post (Illo doloremque quid)', 20, 550, 20, '2', 549, 3, 550, 4, '2022-09-19 03:10:41', '2024-02-04 23:22:36', '1'),
(11, '13', 'Hamza Seller select you for post (Illo doloremque quid)', 20, 550, 20, '1', 549, 3, 550, 4, '2022-09-19 03:14:18', '2022-09-19 03:14:18', '1'),
(12, '12', 'Hamza Seller upload a new post(Expedita deserunt am)', 21, 550, NULL, '1', 549, 3, 550, 4, '2022-09-18 20:40:59', '2022-09-19 03:40:59', '1'),
(13, '11', 'test agent contact related to post(Expedita deserunt am)', 2, 21, NULL, '1', 550, 4, 549, 3, '2022-09-18 20:43:04', '2022-09-19 03:43:04', '1'),
(14, '3', 'test agent share a proposal related to your post `Expedita deserunt am`', 2, 1, NULL, '2', 550, 4, 549, 3, '2022-09-18 20:43:04', '2022-09-19 10:58:53', '1'),
(15, '13', 'Hamza Seller select you for post (Expedita deserunt am)', 21, 550, 21, '1', 549, 3, 550, 4, '2022-09-19 03:43:32', '2022-09-19 03:43:32', '1'),
(16, '13', 'Hamza Seller select you for post (Expedita deserunt am)', 21, 550, 21, '1', 549, 3, 550, 4, '2022-09-19 03:43:57', '2022-09-19 03:43:57', '1'),
(17, '12', 'Hamza Seller upload a new post(Excepturi odio excep)', 22, 550, NULL, '1', 549, 3, 550, 4, '2022-09-18 21:05:08', '2022-09-19 04:05:08', '1'),
(18, '11', 'test agent contact related to post(Excepturi odio excep)', 3, 22, NULL, '1', 550, 4, 549, 3, '2022-09-18 21:06:26', '2022-09-19 04:06:26', '1'),
(19, '3', 'test agent share a proposal related to your post `Excepturi odio excep`', 3, 1, NULL, '2', 550, 4, 549, 3, '2022-09-18 21:06:26', '2022-09-19 10:58:53', '1'),
(20, '13', 'Hamza Seller select you for post (Excepturi odio excep)', 22, 550, 22, '1', 549, 3, 550, 4, '2022-09-19 04:07:36', '2022-09-19 04:07:36', '1'),
(21, '12', 'Hamza Seller upload a new post(Commodi nulla et ven)', 23, 550, NULL, '1', 549, 3, 550, 4, '2022-09-18 21:26:51', '2022-09-19 04:26:51', '1'),
(22, '11', 'test agent contact related to post(Commodi nulla et ven)', 4, 23, NULL, '1', 550, 4, 549, 3, '2022-09-18 21:27:23', '2022-09-19 04:27:23', '1'),
(23, '3', 'test agent share a proposal related to your post `Commodi nulla et ven`', 4, 1, NULL, '2', 550, 4, 549, 3, '2022-09-18 21:27:23', '2022-09-19 10:58:53', '1'),
(24, '13', 'Hamza Seller select you for post (Commodi nulla et ven)', 23, 550, 23, '1', 549, 3, 550, 4, '2022-09-19 04:37:03', '2022-09-19 04:37:03', '1'),
(25, '13', 'Hamza Seller select you for post (Commodi nulla et ven)', 23, 550, 23, '1', 549, 3, 550, 4, '2022-09-19 04:37:13', '2022-09-19 04:37:13', '1'),
(26, '12', 'Hamza Seller upload a new post(Labore voluptatibus)', 24, 550, NULL, '1', 549, 3, 550, 4, '2022-09-18 21:39:34', '2022-09-19 04:39:34', '1'),
(30, '11', 'test agent contact related to post(Labore voluptatibus)', 5, 24, NULL, '1', 550, 4, 549, 3, '2022-09-18 22:09:30', '2022-09-19 05:09:30', '1'),
(34, '3', 'test agent share a proposal related to your post `Labore voluptatibus`', 11, 1, NULL, '2', 550, 4, 549, 3, '2022-09-18 22:15:01', '2022-09-19 10:58:53', '1'),
(35, '13', 'Hamza Seller select you for post (Labore voluptatibus)', 24, 550, 24, '1', 549, 3, 550, 4, '2022-09-19 05:24:50', '2022-09-19 05:24:50', '1'),
(36, '13', 'Hamza Seller select you for post (Labore voluptatibus)', 24, 550, 24, '1', 549, 3, 550, 4, '2022-09-19 05:24:59', '2022-09-19 05:24:59', '1'),
(37, '13', 'Hamza Seller select you for post (Labore voluptatibus)', 24, 550, 24, '1', 549, 3, 550, 4, '2022-09-19 05:25:08', '2022-09-19 05:25:08', '1'),
(38, '13', 'Hamza Seller select you for post (Labore voluptatibus)', 24, 550, 24, '1', 549, 3, 550, 4, '2022-09-19 05:25:17', '2022-09-19 05:25:17', '1'),
(39, '12', 'Hamza Seller upload a new post(Molestias et in volu)', 25, 550, NULL, '1', 549, 3, 550, 4, '2022-09-19 03:47:50', '2022-09-19 10:47:50', '1'),
(43, '11', 'test agent contact related to post(Molestias et in volu)', 6, 25, NULL, '1', 550, 4, 549, 3, '2022-09-19 03:55:10', '2022-09-19 10:55:10', '1'),
(46, '13', 'Hamza Seller select you for post (Molestias et in volu)', 25, 550, 25, '1', 549, 3, 550, 4, '2022-09-19 10:59:11', '2022-09-19 10:59:11', '1'),
(47, '3', 'test agent share a proposal related to your post `new home`', 17, 1, NULL, '1', 550, 4, 549, 3, '2022-09-29 21:03:24', '2022-09-30 04:03:24', '1'),
(48, '12', 'Hamza Seller upload a new post(last post)', 26, 550, NULL, '1', 549, 3, 550, 4, '2022-09-29 21:24:22', '2022-09-30 04:24:22', '1'),
(49, '11', 'Hamza Seller contact related to post(last post)', 7, 26, NULL, '1', 549, 3, 550, 4, '2022-09-29 21:24:59', '2022-09-30 04:24:59', '1'),
(50, '13', 'Hamza Seller select you for post (last post)', 26, 550, 26, '1', 549, 3, 550, 4, '2022-09-30 04:25:32', '2022-09-30 04:25:32', '1'),
(51, '3', 'test agent share a proposal related to your post `Molestias et in volu`', 18, 1, NULL, '1', 550, 4, 549, 3, '2022-09-29 21:51:18', '2022-09-30 04:51:18', '1'),
(52, '6', 'test agent just joined you on Messag!', 2, 26, NULL, '1', 550, 4, 549, 3, '2022-11-02 02:21:52', '2022-11-02 02:21:52', '1'),
(53, '7', 'test agent send a message: hi', 5, 2, NULL, '1', 550, 4, 549, 3, '2022-11-02 02:22:19', '2022-11-02 02:22:19', '1'),
(54, '6', 'hamzalast just joined you on Messag!', 3, 26, NULL, '2', 558, 2, 549, 3, '2022-11-02 02:39:38', '2023-04-05 02:27:33', '1'),
(55, '6', 'hamzalast just joined you on Messag!', 4, 26, NULL, '1', 558, 2, 545, 3, '2022-11-02 02:47:53', '2022-11-02 02:47:53', '1'),
(56, '7', ' send a message: hello this is latest message to ahmad', 6, 3, NULL, '1', 558, 2, 549, 2, '2022-11-05 04:50:14', '2022-11-05 04:50:14', '1'),
(57, '7', ' send a message: hello this is latest message to ahmad', 7, 3, NULL, '1', 558, 2, 549, 2, '2022-11-05 04:52:00', '2022-11-05 04:52:00', '1'),
(58, '6', 'joy jinda just joined you on Messag!', 5, 32, NULL, '1', 614, 3, 597, 4, '2022-11-25 17:18:33', '2022-11-25 17:18:33', '1'),
(59, '11', 'joy jinda contact related to post(palwalgu)', 8, 32, NULL, '1', 614, 3, 597, 4, '2022-11-25 11:18:33', '2022-11-25 17:18:33', '1'),
(60, '6', 'joy jinda just joined you on Messag!', 6, 32, NULL, '2', 614, 3, 601, 4, '2022-11-25 17:23:30', '2022-11-25 17:23:51', '1'),
(61, '11', 'joy jinda contact related to post(palwalgu)', 9, 32, NULL, '1', 614, 3, 601, 4, '2022-11-25 11:23:30', '2022-11-25 17:23:30', '1'),
(62, '7', 'joy jinda send a message: HI', 8, 6, NULL, '2', 614, 3, 601, 4, '2022-11-25 17:23:45', '2022-11-25 17:23:54', '1'),
(63, '7', 'HANARAY WANE send a message: hii', 9, 6, NULL, '2', 601, 4, 614, 3, '2022-11-25 17:24:46', '2022-11-25 17:25:41', '1'),
(64, '6', 'joy jinda just joined you on Messag!', 7, 32, NULL, '1', 614, 3, 542, 4, '2022-11-25 17:29:24', '2022-11-25 17:29:24', '1'),
(65, '11', 'joy jinda contact related to post(palwalgu)', 10, 32, NULL, '1', 614, 3, 542, 4, '2022-11-25 11:29:24', '2022-11-25 17:29:24', '1'),
(66, '7', 'joy jinda send a message: Hello,', 10, 7, NULL, '1', 614, 3, 542, 4, '2022-11-25 17:29:44', '2022-11-25 17:29:44', '1'),
(67, '7', 'joy jinda send a message: hhhhhhhhuuuuuuuuuuuu', 11, 5, NULL, '1', 614, 3, 597, 4, '2022-11-25 17:31:33', '2022-11-25 17:31:33', '1'),
(68, '7', ' send a message: hello this is latest message to ahmad', 12, 3, NULL, '1', 558, 2, 549, 2, '2022-12-04 12:43:26', '2022-12-04 12:43:26', '1'),
(69, '7', ' send a message: hello this is latest message to ahmad', 13, 3, NULL, '1', 629, 2, 549, 2, '2022-12-04 12:44:01', '2022-12-04 12:44:01', '1'),
(70, '11', 'Rosanna Senger contact related to post(Property Sell)', 11, 35, NULL, '1', 645, 3, 625, 4, '2022-12-08 13:47:32', '2022-12-08 19:47:32', '1'),
(71, '13', 'Rosanna Senger select you for post (Property Sell)', 35, 625, 35, '1', 645, 3, 625, 4, '2022-12-08 19:47:36', '2022-12-08 19:47:36', '1'),
(72, '6', 'Rosanna Senger just joined you on Messag!', 8, 35, NULL, '2', 645, 3, 625, 4, '2022-12-08 19:48:00', '2022-12-08 19:53:58', '1'),
(73, '7', 'Rosanna Senger send a message: Hi', 14, 8, NULL, '2', 645, 3, 625, 4, '2022-12-08 19:48:19', '2022-12-08 19:53:58', '1'),
(74, '7', 'Rosanna Senger send a message: Hi', 15, 8, NULL, '2', 645, 3, 625, 4, '2022-12-08 19:49:42', '2022-12-08 19:53:56', '1'),
(75, '4', 'Rosanna Senger asked questions related to your post `Property Sell`', 19, 6, NULL, '2', 645, 3, 625, 4, '2022-12-08 14:20:55', '2022-12-16 19:08:24', '1'),
(76, '11', 'Priya Kandaswamy contact related to post(Selling Duplex house 1)', 12, 37, NULL, '1', 656, 3, 550, 4, '2022-12-12 05:37:49', '2022-12-12 11:37:49', '1'),
(77, '13', 'Priya Kandaswamy select you for post (Selling Duplex house 1)', 37, 550, 37, '1', 656, 3, 550, 4, '2022-12-12 11:37:53', '2022-12-12 11:37:53', '1'),
(78, '7', ' send a message: hello', 16, 8, NULL, '2', 625, 4, 625, 4, '2022-12-16 01:15:04', '2022-12-16 19:13:41', '1'),
(79, '7', ' send a message: hello', 17, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 01:26:09', '2022-12-16 19:06:39', '1'),
(80, '7', ' send a message: Hii', 18, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:33:18', '2022-12-16 19:06:39', '1'),
(81, '7', ' send a message: Hii', 19, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:33:21', '2022-12-16 19:06:39', '1'),
(82, '7', ' send a message: Hii', 20, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:33:22', '2022-12-16 19:06:39', '1'),
(83, '7', ' send a message: Hii', 21, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:33:23', '2022-12-16 19:06:39', '1'),
(84, '7', ' send a message: Hii', 22, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:33:24', '2022-12-16 19:06:39', '1'),
(85, '7', ' send a message: Hii', 23, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:33:24', '2022-12-16 19:06:39', '1'),
(86, '7', ' send a message: Hii', 24, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:33:24', '2022-12-16 19:06:39', '1'),
(87, '7', ' send a message: Hii', 25, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:33:25', '2022-12-16 19:06:39', '1'),
(88, '7', ' send a message: Hii', 26, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:33:25', '2022-12-16 19:06:39', '1'),
(89, '7', ' send a message: Hii', 27, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:33:25', '2022-12-16 19:06:39', '1'),
(90, '7', ' send a message: Hii', 28, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:33:25', '2022-12-16 19:06:39', '1'),
(91, '7', ' send a message: Hii', 29, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:33:25', '2022-12-16 19:06:39', '1'),
(92, '7', ' send a message: Hii', 30, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:33:25', '2022-12-16 19:06:39', '1'),
(93, '7', ' send a message: Hii', 31, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:33:25', '2022-12-16 19:06:39', '1'),
(94, '7', ' send a message: Hii', 32, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:33:25', '2022-12-16 19:06:39', '1'),
(95, '7', ' send a message: Hii', 33, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:33:25', '2022-12-16 19:06:39', '1'),
(96, '7', ' send a message: Hii', 34, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:33:26', '2022-12-16 19:06:39', '1'),
(97, '7', ' send a message: Hii', 35, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:10', '2022-12-16 19:06:39', '1'),
(98, '7', ' send a message: Hii', 36, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:12', '2022-12-16 19:06:39', '1'),
(99, '7', ' send a message: Hii', 37, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:12', '2022-12-16 19:06:39', '1'),
(100, '7', ' send a message: Hii', 38, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:12', '2022-12-16 19:06:39', '1'),
(101, '7', ' send a message: Hii', 39, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:12', '2022-12-16 19:06:39', '1'),
(102, '7', ' send a message: Hii', 40, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:13', '2022-12-16 19:06:39', '1'),
(103, '7', ' send a message: Hii', 41, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:13', '2022-12-16 19:06:39', '1'),
(104, '7', ' send a message: Hii', 42, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:14', '2022-12-16 19:06:39', '1'),
(105, '7', ' send a message: Hii', 43, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:14', '2022-12-16 19:06:39', '1'),
(106, '7', ' send a message: Hii', 44, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:15', '2022-12-16 19:06:39', '1'),
(107, '7', ' send a message: Hii', 45, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:15', '2022-12-16 19:06:39', '1'),
(108, '7', ' send a message: Hii', 46, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:15', '2022-12-16 19:06:39', '1'),
(109, '7', ' send a message: Hii', 47, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:21', '2022-12-16 19:06:39', '1'),
(110, '7', ' send a message: Hii', 48, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:21', '2022-12-16 19:06:39', '1'),
(111, '7', ' send a message: Hii', 49, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:21', '2022-12-16 19:06:39', '1'),
(112, '7', ' send a message: Hii', 50, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:22', '2022-12-16 19:06:39', '1'),
(113, '7', ' send a message: Hii', 51, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:22', '2022-12-16 19:06:39', '1'),
(114, '7', ' send a message: Hii', 52, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:22', '2022-12-16 19:06:39', '1'),
(115, '7', ' send a message: Hii', 53, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:23', '2022-12-16 19:06:39', '1'),
(116, '7', ' send a message: Hii', 54, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:23', '2022-12-16 19:06:39', '1'),
(117, '7', ' send a message: Hii', 55, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:23', '2022-12-16 19:06:39', '1'),
(118, '7', ' send a message: Hii', 56, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:24', '2022-12-16 19:06:39', '1'),
(119, '7', ' send a message: Hii', 57, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:24', '2022-12-16 19:06:39', '1'),
(120, '7', ' send a message: Hii', 58, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:24', '2022-12-16 19:06:39', '1'),
(121, '7', ' send a message: Hii', 59, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 12:34:24', '2022-12-16 19:06:39', '1'),
(122, '7', ' send a message: Hi', 60, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 13:38:43', '2022-12-16 19:06:39', '1'),
(123, '7', ' send a message: Hi', 61, 8, NULL, '2', 645, 3, 625, 4, '2022-12-16 13:38:45', '2022-12-16 19:06:39', '1'),
(124, '6', 'Aditya Kertzamann just joined you on Messag!', 9, 33, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:04:55', '2022-12-16 19:10:24', '1'),
(125, '11', 'Aditya Kertzamann contact related to post(Providing the features)', 13, 33, NULL, '1', 651, 2, 625, 4, '2022-12-16 08:04:55', '2022-12-16 14:04:55', '1'),
(126, '7', 'Aditya Kertzamann send a message: hello there...!', 62, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:05:05', '2022-12-16 19:10:24', '1'),
(127, '7', ' send a message: Hiiii', 63, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:05:48', '2022-12-16 19:10:24', '1'),
(128, '7', ' send a message: Hiiii', 64, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:05:49', '2022-12-16 19:10:24', '1'),
(129, '7', ' send a message: Hiiii', 65, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:05:49', '2022-12-16 19:10:24', '1'),
(130, '7', ' send a message: Hiiii', 66, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:05:50', '2022-12-16 19:10:24', '1'),
(131, '7', ' send a message: Hiiii', 67, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:05:50', '2022-12-16 19:10:24', '1'),
(132, '7', ' send a message: Hiiii', 68, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:05:51', '2022-12-16 19:10:24', '1'),
(133, '7', ' send a message: Hiiii', 69, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:05:51', '2022-12-16 19:10:24', '1'),
(134, '7', ' send a message: Hiiii', 70, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:05:51', '2022-12-16 19:10:24', '1'),
(135, '7', ' send a message: Hiiii', 71, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:05:51', '2022-12-16 19:10:24', '1'),
(136, '7', ' send a message: Hiiii', 72, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:05:51', '2022-12-16 19:10:24', '1'),
(137, '7', ' send a message: Hiiii', 73, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:05:52', '2022-12-16 19:10:24', '1'),
(138, '7', ' send a message: Hiiii', 74, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:05:52', '2022-12-16 19:10:24', '1'),
(139, '7', ' send a message: Hiiii', 75, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:05:52', '2022-12-16 19:10:24', '1'),
(140, '7', ' send a message: Hiiii', 76, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:26', '2022-12-16 19:10:24', '1'),
(141, '7', ' send a message: Hiiii', 77, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:33', '2022-12-16 19:10:24', '1'),
(142, '7', ' send a message: Hiiii', 78, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:33', '2022-12-16 19:10:24', '1'),
(143, '7', ' send a message: Hiiii', 79, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:34', '2022-12-16 19:10:24', '1'),
(144, '7', ' send a message: Hiiii', 80, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:34', '2022-12-16 19:10:24', '1'),
(145, '7', ' send a message: Hiiii', 81, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:34', '2022-12-16 19:10:24', '1'),
(146, '7', ' send a message: Hiiii', 82, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:34', '2022-12-16 19:10:24', '1'),
(147, '7', ' send a message: Hiiii', 83, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:34', '2022-12-16 19:10:24', '1'),
(148, '7', ' send a message: Hiiii', 84, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:34', '2022-12-16 19:10:24', '1'),
(149, '7', ' send a message: Hiiii', 85, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:35', '2022-12-16 19:10:24', '1'),
(150, '7', ' send a message: Hiiii', 86, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:35', '2022-12-16 19:10:24', '1'),
(151, '7', ' send a message: Hiiii', 87, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:36', '2022-12-16 19:10:24', '1'),
(152, '7', ' send a message: Hiiii', 88, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:36', '2022-12-16 19:10:24', '1'),
(153, '7', ' send a message: Hiiii', 89, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:36', '2022-12-16 19:10:24', '1'),
(154, '7', ' send a message: Hiiii', 90, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:36', '2022-12-16 19:10:24', '1'),
(155, '7', ' send a message: Hiiii', 91, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:36', '2022-12-16 19:10:24', '1'),
(156, '7', ' send a message: Hiiii', 92, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:37', '2022-12-16 19:10:24', '1'),
(157, '7', ' send a message: Hiiii', 93, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:37', '2022-12-16 19:10:24', '1'),
(158, '7', ' send a message: Hiiii', 94, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:37', '2022-12-16 19:10:24', '1'),
(159, '7', ' send a message: Hiiii', 95, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:37', '2022-12-16 19:10:24', '1'),
(160, '7', ' send a message: Hiiii', 96, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:37', '2022-12-16 19:10:24', '1'),
(161, '7', ' send a message: Hiiii', 97, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:38', '2022-12-16 19:10:24', '1'),
(162, '7', ' send a message: Hiiii', 98, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:38', '2022-12-16 19:10:24', '1'),
(163, '7', ' send a message: Hiiii', 99, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:38', '2022-12-16 19:10:24', '1'),
(164, '7', ' send a message: Hiiii', 100, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:38', '2022-12-16 19:10:24', '1'),
(165, '7', ' send a message: Hiiii', 101, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:39', '2022-12-16 19:10:24', '1'),
(166, '7', ' send a message: Hiiii', 102, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:39', '2022-12-16 19:10:24', '1'),
(167, '7', ' send a message: Hiiii', 103, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:39', '2022-12-16 19:10:24', '1'),
(168, '7', ' send a message: Hiiii', 104, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:39', '2022-12-16 19:10:24', '1'),
(169, '7', ' send a message: Hiiii', 105, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:39', '2022-12-16 19:10:24', '1'),
(170, '7', ' send a message: Hiiii', 106, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:40', '2022-12-16 19:10:24', '1'),
(171, '7', ' send a message: Hiiii', 107, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:43', '2022-12-16 19:10:24', '1'),
(172, '7', ' send a message: Hiiii', 108, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:44', '2022-12-16 19:10:24', '1'),
(173, '7', ' send a message: Hiiii', 109, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:44', '2022-12-16 19:10:24', '1'),
(174, '7', ' send a message: Hiiii', 110, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:44', '2022-12-16 19:10:24', '1'),
(175, '7', ' send a message: Hiiii', 111, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:44', '2022-12-16 19:10:24', '1'),
(176, '7', ' send a message: Hiiii', 112, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:44', '2022-12-16 19:10:24', '1'),
(177, '7', ' send a message: Hiiii', 113, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:45', '2022-12-16 19:10:24', '1'),
(178, '7', ' send a message: Hiiii', 114, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:06:45', '2022-12-16 19:10:24', '1'),
(179, '7', ' send a message: Hieeeeeee3', 115, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:10:45', '2022-12-16 19:10:24', '1'),
(180, '7', ' send a message: Hieeeeeee3', 116, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:10:46', '2022-12-16 19:10:24', '1'),
(181, '7', ' send a message: Nnnnnnnn', 117, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:10:52', '2022-12-16 19:10:24', '1'),
(182, '7', ' send a message: Nnnnnnnn', 118, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:10:53', '2022-12-16 19:10:24', '1'),
(183, '7', ' send a message: Nnnnnnnn', 119, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:10:54', '2022-12-16 19:10:24', '1'),
(184, '7', ' send a message: Ssssssss', 120, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:10:58', '2022-12-16 19:10:24', '1'),
(185, '7', ' send a message: Ssssssss', 121, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:10:59', '2022-12-16 19:10:24', '1'),
(186, '7', ' send a message: Ssssssss', 122, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:10:59', '2022-12-16 19:10:24', '1'),
(187, '7', ' send a message: Ssssssss', 123, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:11:00', '2022-12-16 19:10:24', '1'),
(188, '7', ' send a message: Ppppppppp', 124, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:11:03', '2022-12-16 19:10:24', '1'),
(189, '7', ' send a message: Ppppppppp', 125, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:11:04', '2022-12-16 19:10:24', '1'),
(190, '7', 'Aditya Kertzamann send a message: Hello There..', 126, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:11:06', '2022-12-16 19:10:24', '1'),
(191, '7', ' send a message: Kkkkkkkkkkk', 127, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:11:09', '2022-12-16 19:10:24', '1'),
(192, '7', ' send a message: Kkkkkkkkkkk', 128, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:11:10', '2022-12-16 19:10:24', '1'),
(193, '7', ' send a message: Vvvvvvbv', 129, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:11:16', '2022-12-16 19:10:24', '1'),
(194, '7', ' send a message: Vvvvvvbv', 130, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:11:17', '2022-12-16 19:10:24', '1'),
(195, '7', ' send a message: Bbbbbbbbbbbbb', 131, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:11:24', '2022-12-16 19:10:24', '1'),
(196, '7', ' send a message: Bbbbbbbbbbbbb', 132, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:11:24', '2022-12-16 19:10:24', '1'),
(197, '7', ' send a message: Bbbbbbbbbbbbb', 133, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:11:26', '2022-12-16 19:10:24', '1'),
(198, '7', ' send a message: Bbbbbbbbbbbbb', 134, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:11:26', '2022-12-16 19:10:24', '1'),
(199, '7', ' send a message: Bbbbbbbbbbbbb', 135, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:11:26', '2022-12-16 19:10:24', '1'),
(200, '7', ' send a message: Bbbbbbbbbbbbb', 136, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:11:26', '2022-12-16 19:10:24', '1'),
(201, '7', ' send a message: Bbbbbbbbbbbbb', 137, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:11:27', '2022-12-16 19:10:24', '1'),
(202, '7', ' send a message: Bbbbbbbbbbbbb', 138, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:11:27', '2022-12-16 19:10:24', '1'),
(203, '7', ' send a message: Bbbbbbbbbbbbb', 139, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:11:27', '2022-12-16 19:10:24', '1'),
(204, '7', 'Aditya Kertzamann send a message: Hii Grayson there...', 140, 9, NULL, '2', 651, 2, 625, 4, '2022-12-16 14:11:27', '2022-12-16 19:10:22', '1'),
(205, '6', 'Grayson Kub just joined you on Messag!', 10, 35, NULL, '2', 625, 4, 625, 4, '2022-12-16 19:13:42', '2022-12-16 19:13:44', '1'),
(206, '7', ' send a message: hi', 141, 9, NULL, '2', 651, 2, 625, 4, '2022-12-17 22:10:35', '2023-02-14 15:37:56', '1'),
(207, '7', ' send a message: Heelllloooo', 142, 10, NULL, '2', 625, 4, 625, 4, '2022-12-17 22:19:54', '2022-12-22 11:25:53', '1'),
(208, '7', ' send a message: hiii', 143, 9, NULL, '2', 651, 2, 625, 4, '2022-12-17 22:20:22', '2023-02-14 15:37:56', '1'),
(209, '7', ' send a message: H', 144, 9, NULL, '2', 651, 2, 625, 4, '2022-12-17 22:23:29', '2023-02-14 15:37:56', '1'),
(210, '7', ' send a message: Hff', 145, 9, NULL, '2', 651, 2, 625, 4, '2022-12-17 22:23:50', '2023-02-14 15:37:56', '1'),
(211, '7', ' send a message: Hff', 146, 9, NULL, '2', 651, 2, 625, 4, '2022-12-17 22:24:40', '2023-02-14 15:37:56', '1'),
(212, '7', ' send a message: Hff', 147, 9, NULL, '2', 651, 2, 625, 4, '2022-12-17 22:25:33', '2023-02-14 15:37:56', '1'),
(213, '7', ' send a message: hi', 148, 9, NULL, '2', 651, 2, 625, 4, '2022-12-17 22:26:26', '2023-02-14 15:37:56', '1'),
(214, '7', ' send a message: hi', 149, 10, NULL, '2', 625, 4, 625, 4, '2022-12-17 22:26:55', '2022-12-22 11:25:53', '1'),
(215, '7', ' send a message: hello', 150, 8, NULL, '1', 645, 3, 625, 4, '2022-12-17 22:27:17', '2022-12-17 22:27:17', '1'),
(216, '7', ' send a message: g', 151, 8, NULL, '1', 645, 3, 625, 4, '2022-12-17 22:27:57', '2022-12-17 22:27:57', '1'),
(217, '7', ' send a message: hi', 152, 8, NULL, '2', 625, 4, 645, 3, '2022-12-17 22:28:57', '2022-12-22 00:03:53', '1'),
(218, '7', ' send a message: hello', 153, 9, NULL, '2', 625, 4, 651, 2, '2022-12-17 22:29:24', '2022-12-27 16:12:18', '1'),
(219, '7', ' send a message: How are you?', 154, 8, NULL, '1', 625, 4, 625, 3, '2022-12-17 22:30:36', '2022-12-17 22:30:36', '1'),
(220, '7', ' send a message: i am fine and u', 155, 8, NULL, '1', 625, 4, 625, 3, '2022-12-17 22:32:23', '2022-12-17 22:32:23', '1'),
(221, '7', ' send a message: hello this is latest message to ahmad', 156, 3, NULL, '2', 656, 3, 625, 4, '2022-12-17 22:34:18', '2022-12-21 13:07:47', '1'),
(222, '7', ' send a message: hello this is latest message to ahmad', 157, 10, NULL, '2', 656, 3, 625, 4, '2022-12-17 22:34:38', '2022-12-21 13:07:47', '1'),
(223, '7', ' send a message: hello this is latest message to ahmad', 158, 9, NULL, '2', 656, 3, 625, 4, '2022-12-17 22:35:14', '2022-12-21 13:07:47', '1'),
(224, '7', ' send a message: how are you?', 159, 9, NULL, '2', 656, 3, 625, 4, '2022-12-17 22:35:33', '2022-12-21 13:07:47', '1'),
(225, '7', ' send a message: what are you doing ?', 160, 9, NULL, '2', 656, 3, 625, 4, '2022-12-17 22:36:49', '2022-12-21 13:07:47', '1'),
(226, '7', ' send a message: dbbsjdjd\nznznxnndnx\nbdndnxnxnd\nhdhdbdndn\ndjjdjdjdndn\nndndndndndn\nbdndjdjdjdjjdjdjdjdjdjdjxn n     djdjjdjdjdjdjdjdjdjdjdjxjdjdj', 161, 8, NULL, '1', 625, 4, 625, 3, '2022-12-18 01:30:53', '2022-12-18 01:30:53', '1'),
(227, '7', ' send a message: what\'s going on ?', 162, 9, NULL, '2', 656, 3, 625, 4, '2022-12-18 01:39:32', '2022-12-21 13:07:47', '1'),
(228, '7', ' send a message: nothing', 163, 9, NULL, '1', 625, 4, 656, 2, '2022-12-18 01:39:55', '2022-12-18 01:39:55', '1'),
(229, '7', ' send a message: what about you?', 164, 9, NULL, '1', 625, 4, 656, 2, '2022-12-18 01:40:04', '2022-12-18 01:40:04', '1'),
(230, '7', ' send a message: hello this is latest message to ahmad', 165, 9, NULL, '2', 656, 3, 625, 4, '2022-12-18 18:04:49', '2022-12-21 13:07:47', '1'),
(231, '7', ' send a message: Hello', 166, 9, NULL, '2', 656, 3, 625, 4, '2022-12-18 18:05:07', '2022-12-21 13:07:47', '1'),
(232, '7', ' send a message: hi', 167, 9, NULL, '1', 625, 4, 625, 2, '2022-12-18 18:05:13', '2022-12-18 18:05:13', '1'),
(233, '7', ' send a message: how are you ?', 168, 9, NULL, '2', 656, 3, 625, 4, '2022-12-18 18:05:26', '2022-12-21 13:07:47', '1'),
(234, '7', ' send a message: i am fine', 169, 9, NULL, '1', 625, 4, 625, 2, '2022-12-18 18:05:33', '2022-12-18 18:05:33', '1'),
(235, '7', ' send a message: and you', 170, 9, NULL, '1', 625, 4, 625, 2, '2022-12-18 18:05:37', '2022-12-18 18:05:37', '1'),
(236, '7', ' send a message: I am also good', 171, 9, NULL, '2', 656, 3, 625, 4, '2022-12-18 18:05:50', '2022-12-21 13:07:44', '1'),
(237, '6', 'Grayson Kub just joined you on Messag!', 11, 38, NULL, '2', 625, 4, 656, 3, '2022-12-21 13:07:45', '2022-12-26 12:46:35', '1'),
(238, '6', 'Abbigail Schultz just joined you on Messag!', 12, 45, NULL, '2', 666, 3, 625, 4, '2022-12-21 19:06:38', '2022-12-22 11:26:28', '1'),
(239, '11', 'Abbigail Schultz contact related to post(Gray down works)', 14, 45, NULL, '1', 666, 3, 625, 4, '2022-12-21 13:06:38', '2022-12-21 19:06:38', '1'),
(240, '7', 'Abbigail Schultz send a message: hiii', 172, 12, NULL, '2', 666, 3, 625, 4, '2022-12-21 19:06:43', '2022-12-22 11:26:29', '1'),
(241, '7', 'Abbigail Schultz send a message: hello', 173, 12, NULL, '2', 666, 3, 625, 4, '2022-12-21 19:07:02', '2022-12-22 11:26:29', '1'),
(242, '7', 'Abbigail Schultz send a message: is there anybody', 174, 12, NULL, '2', 666, 3, 625, 4, '2022-12-21 19:07:12', '2022-12-22 11:26:29', '1'),
(243, '7', 'Abbigail Schultz send a message: ??', 175, 12, NULL, '2', 666, 3, 625, 4, '2022-12-21 19:07:22', '2022-12-22 11:26:29', '1'),
(244, '7', 'Abbigail Schultz send a message: hello ?????', 176, 12, NULL, '2', 666, 3, 625, 4, '2022-12-21 19:08:25', '2022-12-22 11:26:26', '1'),
(245, '6', 'Rosanna Senger just joined you on Messag!', 13, 44, NULL, '2', 645, 2, 625, 4, '2022-12-21 19:10:55', '2023-02-14 15:37:30', '1'),
(246, '11', 'Rosanna Senger contact related to post(For GRAYSON)', 15, 44, NULL, '1', 645, 2, 625, 4, '2022-12-21 13:10:55', '2022-12-21 19:10:55', '1'),
(247, '7', 'Rosanna Senger send a message: hiiiiiiii', 177, 13, NULL, '2', 645, 2, 625, 4, '2022-12-21 19:11:00', '2023-02-14 15:37:30', '1'),
(248, '7', 'Rosanna Senger send a message: ??????????????????????????????', 178, 13, NULL, '2', 645, 2, 625, 4, '2022-12-21 19:11:11', '2023-02-14 15:37:30', '1'),
(249, '7', 'Rosanna Senger send a message: Hello ?????????????????', 179, 13, NULL, '2', 645, 2, 625, 4, '2022-12-21 19:11:24', '2023-02-14 15:37:30', '1'),
(250, '6', 'Rosanna Senger just joined you on Messag!', 14, 35, NULL, '1', 645, 3, 625, 4, '2022-12-22 00:03:53', '2022-12-22 00:03:53', '1'),
(251, '7', 'Rosanna Senger send a message: Hi', 180, 14, NULL, '1', 645, 3, 625, 4, '2022-12-22 00:04:07', '2022-12-22 00:04:07', '1'),
(252, '7', 'Rosanna Senger send a message: How are you?', 181, 14, NULL, '1', 645, 3, 625, 4, '2022-12-22 00:09:03', '2022-12-22 00:09:03', '1'),
(253, '7', ' send a message: Hello', 182, 14, NULL, '2', 625, 4, 645, 3, '2022-12-22 00:19:36', '2022-12-28 18:59:00', '1'),
(254, '7', ' send a message: I am good', 183, 14, NULL, '2', 625, 4, 645, 3, '2022-12-22 00:19:42', '2022-12-28 18:59:00', '1'),
(255, '7', ' send a message: What about you?', 184, 14, NULL, '2', 625, 4, 645, 3, '2022-12-22 00:19:48', '2022-12-28 18:59:00', '1'),
(256, '7', ' send a message: hi', 185, 13, NULL, '2', 625, 4, 645, 2, '2022-12-22 00:26:42', '2022-12-28 18:56:34', '1'),
(257, '7', ' send a message: hello', 186, 13, NULL, '2', 625, 2, 625, 4, '2022-12-22 00:39:02', '2022-12-22 11:26:56', '1'),
(258, '7', ' send a message: yes', 187, 12, NULL, '2', 625, 4, 625, 4, '2022-12-22 00:42:52', '2022-12-22 11:25:51', '1'),
(259, '7', ' send a message: Hi', 188, 12, NULL, '1', 625, 4, 666, 3, '2022-12-22 00:44:09', '2022-12-22 00:44:09', '1'),
(260, '6', 'Grayson Kub just joined you on Messag!', 15, 45, NULL, '2', 625, 4, 625, 4, '2022-12-22 11:25:51', '2022-12-22 11:25:53', '1'),
(261, '6', 'Grayson Kub just joined you on Messag!', 16, 45, NULL, '1', 625, 4, 666, 3, '2022-12-22 11:26:27', '2022-12-22 11:26:27', '1'),
(262, '12', 'Priya Kandaswamy upload a new post(This is post from Seller Smitha)', 48, 550, NULL, '1', 656, 3, 550, 4, '2022-12-26 07:03:33', '2022-12-26 13:03:33', '1'),
(263, '11', 'Priya Kandaswamy contact related to post(This is post from Seller Smitha)', 16, 48, NULL, '1', 656, 3, 550, 4, '2022-12-26 07:04:32', '2022-12-26 13:04:32', '1'),
(264, '13', 'Priya Kandaswamy select you for post (This is post from Seller Smitha)', 48, 550, 48, '1', 656, 3, 550, 4, '2022-12-26 13:04:35', '2022-12-26 13:04:35', '1'),
(265, '11', 'Rajani Joshi contact related to post(Post Title for Seller)', 17, 50, NULL, '1', 671, 3, 672, 4, '2022-12-27 07:18:17', '2022-12-27 13:18:17', '1'),
(266, '13', 'Rajani Joshi select you for post (Post Title for Seller)', 50, 672, 50, '1', 671, 3, 672, 4, '2022-12-27 13:18:19', '2022-12-27 13:18:19', '1'),
(267, '6', 'Rajani Joshi just joined you on Messag!', 17, 50, NULL, '1', 671, 3, 672, 4, '2022-12-27 13:19:12', '2022-12-27 13:19:12', '1'),
(268, '7', 'Rajani Joshi send a message: Hi', 189, 17, NULL, '1', 671, 3, 672, 4, '2022-12-27 13:19:19', '2022-12-27 13:19:19', '1'),
(269, '11', 'Rajani Joshi contact related to post(Test Post Title Buyer)', 18, 52, NULL, '1', 671, 2, 672, 4, '2022-12-27 07:28:29', '2022-12-27 13:28:29', '1'),
(270, '13', 'Rajani Joshi select you for post (Test Post Title Buyer)', 52, 672, 52, '1', 671, 2, 672, 4, '2022-12-27 13:28:31', '2022-12-27 13:28:31', '1'),
(271, '6', 'Rajani Joshi just joined you on Messag!', 18, 52, NULL, '2', 671, 2, 672, 4, '2022-12-27 13:28:39', '2022-12-27 13:37:05', '1'),
(272, '7', 'Rajani Joshi send a message: sfdsfsd', 190, 18, NULL, '2', 671, 2, 672, 4, '2022-12-27 13:28:44', '2022-12-27 13:37:05', '1'),
(273, '7', 'Rajani Joshi send a message: sdfsdfsdf', 191, 18, NULL, '2', 671, 2, 672, 4, '2022-12-27 13:28:57', '2022-12-27 13:37:05', '1'),
(274, '7', 'Nirmal Bagrecha send a message: Hi', 192, 18, NULL, '1', 672, 4, 671, 2, '2022-12-27 13:37:11', '2022-12-27 13:37:11', '1'),
(275, '11', 'Rajani Joshi contact related to post(Welcome Back Good news! Our algorithm found a new)', 19, 49, NULL, '1', 671, 3, 670, 4, '2022-12-27 08:08:18', '2022-12-27 14:08:18', '1'),
(276, '13', 'Rajani Joshi select you for post (Welcome Back Good news! Our algorithm found a new)', 49, 670, 49, '1', 671, 3, 670, 4, '2022-12-27 14:08:20', '2022-12-27 14:08:20', '1'),
(277, '6', 'Aditya Kertzamann just joined you on Messag!', 19, 38, NULL, '2', 651, 2, 625, 4, '2022-12-27 16:12:19', '2023-02-14 15:37:56', '1'),
(278, '7', 'Aditya Kertzamann send a message: hiee', 193, 19, NULL, '2', 651, 2, 625, 4, '2022-12-27 16:12:43', '2023-02-14 15:37:56', '1'),
(279, '12', 'Aditya Kertzamann upload a new post(https://dev.92agents.com/profile/buyer/posts .)', 53, 625, NULL, '1', 651, 2, 625, 4, '2022-12-27 10:44:50', '2022-12-27 16:44:50', '1'),
(280, '7', ' send a message: Hello', 194, 19, NULL, '1', 651, 2, 651, 2, '2022-12-27 18:47:38', '2022-12-27 18:47:38', '1'),
(281, '7', ' send a message: hello', 195, 15, NULL, '2', 625, 4, 625, 4, '2022-12-28 01:07:57', '2023-02-14 15:38:17', '1'),
(282, '7', ' send a message: hi', 196, 15, NULL, '2', 625, 4, 625, 4, '2022-12-28 01:08:38', '2023-02-14 15:38:17', '1'),
(283, '7', ' send a message: how are you', 197, 15, NULL, '2', 625, 4, 625, 4, '2022-12-28 01:08:43', '2023-02-14 15:38:17', '1'),
(284, '7', ' send a message: Hdhshs', 198, 15, NULL, '2', 625, 4, 625, 4, '2022-12-28 01:08:46', '2023-02-14 15:38:15', '1'),
(285, '7', ' send a message: hello', 199, 19, NULL, '2', 625, 4, 651, 2, '2022-12-28 01:09:21', '2022-12-28 19:36:52', '1'),
(286, '7', ' send a message: hi', 200, 19, NULL, '1', 625, 4, 625, 2, '2022-12-28 16:41:45', '2022-12-28 16:41:45', '1'),
(287, '7', ' send a message: graysob', 201, 19, NULL, '1', 625, 4, 625, 2, '2022-12-28 16:41:48', '2022-12-28 16:41:48', '1'),
(288, '7', ' send a message: How are u?', 202, 19, NULL, '1', 625, 4, 625, 2, '2022-12-28 16:41:53', '2022-12-28 16:41:53', '1'),
(289, '12', 'Rosanna Senger upload a new post(Email: Support@92agents.com)', 56, 625, NULL, '1', 645, 2, 625, 4, '2022-12-28 12:55:57', '2022-12-28 18:55:57', '1'),
(290, '6', 'Rosanna Senger just joined you on Messag!', 20, 44, NULL, '2', 645, 2, 625, 4, '2022-12-28 18:56:34', '2023-02-14 15:37:30', '1'),
(291, '7', 'Rosanna Senger send a message: ooye heelooo', 203, 20, NULL, '2', 645, 2, 625, 4, '2022-12-28 18:56:48', '2023-02-14 15:37:30', '1'),
(292, '7', 'Rosanna Senger send a message: heeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', 204, 20, NULL, '2', 645, 2, 625, 4, '2022-12-28 18:56:58', '2023-02-14 15:37:30', '1'),
(293, '7', 'Rosanna Senger send a message: ;oina;KJBC .J JKcna ;lygcuhvacsb,jhcs   kjsacv kjvsX', 205, 20, NULL, '2', 645, 2, 625, 4, '2022-12-28 18:57:09', '2023-02-14 15:37:30', '1'),
(294, '6', 'Rosanna Senger just joined you on Messag!', 21, 35, NULL, '1', 645, 3, 625, 4, '2022-12-28 18:58:58', '2022-12-28 18:58:58', '1'),
(295, '7', 'Rosanna Senger send a message: OOYYYEEEEEEEEEEEEEEEEEEEEEEEEEEEEE', 206, 21, NULL, '1', 645, 3, 625, 4, '2022-12-28 18:59:07', '2022-12-28 18:59:07', '1'),
(296, '7', 'Rosanna Senger send a message: jytdfx hggfddsss', 207, 21, NULL, '1', 645, 3, 625, 4, '2022-12-28 18:59:13', '2022-12-28 18:59:13', '1'),
(297, '12', 'Rosanna Senger upload a new post(Selling a waste cricket ground)', 57, 625, NULL, '1', 645, 3, 625, 4, '2022-12-28 13:02:41', '2022-12-28 19:02:41', '1'),
(298, '7', ' send a message: Hghftyhghhu', 208, 21, NULL, '1', 625, 4, 645, 3, '2022-12-28 19:14:14', '2022-12-28 19:14:14', '1'),
(299, '7', ' send a message: Hxhshsjidios', 209, 21, NULL, '1', 625, 4, 645, 3, '2022-12-28 19:14:25', '2022-12-28 19:14:25', '1'),
(300, '7', ' send a message: Jxjjsjkxkdi', 210, 21, NULL, '1', 625, 4, 645, 3, '2022-12-28 19:14:27', '2022-12-28 19:14:27', '1'),
(301, '7', ' send a message: Jxjjsjkxkdizjdbxjxjdjjd', 211, 21, NULL, '1', 625, 4, 645, 3, '2022-12-28 19:14:28', '2022-12-28 19:14:28', '1'),
(302, '7', ' send a message: Jxjjsjkxkdizjdbxjxjdjjd', 212, 21, NULL, '1', 625, 4, 645, 3, '2022-12-28 19:14:28', '2022-12-28 19:14:28', '1'),
(303, '7', ' send a message: Jxjjsjkxkdizjdbxjxjdjjddhdhjdid', 213, 21, NULL, '1', 625, 4, 645, 3, '2022-12-28 19:14:29', '2022-12-28 19:14:29', '1'),
(304, '7', ' send a message: Jxjjsjkxkdizjdbxjxjdjjd', 214, 21, NULL, '1', 625, 4, 645, 3, '2022-12-28 19:14:29', '2022-12-28 19:14:29', '1'),
(305, '7', ' send a message: Jxjjsjkxkdizjdbxjxjdjjddhdhjdid', 215, 21, NULL, '1', 625, 4, 645, 3, '2022-12-28 19:14:30', '2022-12-28 19:14:30', '1'),
(306, '7', ' send a message: Jxjjsjkxkdizjdbxjxjdjjddhdhjdid', 216, 21, NULL, '1', 625, 4, 645, 3, '2022-12-28 19:14:30', '2022-12-28 19:14:30', '1'),
(307, '7', ' send a message: Jxjjsjkxkdizjdbxjxjdjjddhdhjdid', 217, 21, NULL, '1', 625, 4, 645, 3, '2022-12-28 19:14:30', '2022-12-28 19:14:30', '1'),
(308, '7', ' send a message: Jxjjsjkxkdizjdbxjxjdjjddhdhjdid', 218, 21, NULL, '1', 625, 4, 645, 3, '2022-12-28 19:14:30', '2022-12-28 19:14:30', '1'),
(309, '7', ' send a message: Jxjjsjkxkdizjdbxjxjdjjddhdhjdid', 219, 21, NULL, '1', 625, 4, 645, 3, '2022-12-28 19:14:30', '2022-12-28 19:14:30', '1'),
(310, '7', ' send a message: Hd7ge7hdihefihefihiefh', 220, 21, NULL, '1', 625, 4, 645, 3, '2022-12-28 19:14:35', '2022-12-28 19:14:35', '1'),
(311, '7', ' send a message: Hd7ge7hdihefihefihiefh', 221, 21, NULL, '1', 625, 4, 645, 3, '2022-12-28 19:14:35', '2022-12-28 19:14:35', '1'),
(312, '6', 'Aditya Kertzamann just joined you on Messag!', 22, 38, NULL, '2', 651, 2, 625, 4, '2022-12-28 19:36:52', '2023-02-14 15:37:56', '1'),
(313, '7', 'Aditya Kertzamann send a message: iubbggg', 222, 22, NULL, '2', 651, 2, 625, 4, '2022-12-28 19:38:04', '2023-02-14 15:37:56', '1'),
(314, '7', 'Aditya Kertzamann send a message: hgcdrdssd', 223, 22, NULL, '2', 651, 2, 625, 4, '2022-12-28 19:38:07', '2023-02-14 15:37:56', '1'),
(315, '7', 'Aditya Kertzamann send a message: bfcytcityditdiyt', 224, 22, NULL, '2', 651, 2, 625, 4, '2022-12-28 19:38:11', '2023-02-14 15:37:54', '1'),
(316, '10', NULL, 0, 8, NULL, '1', 549, 3, NULL, NULL, '2022-12-30 02:58:53', '2022-12-30 02:58:53', '1'),
(317, '10', NULL, 0, 9, NULL, '1', 549, 3, NULL, NULL, '2022-12-30 02:59:04', '2022-12-30 02:59:04', '1'),
(318, '12', 'Rosanna Senger upload a new post(Gersman services)', 60, 625, NULL, '1', 645, 2, 625, 4, '2023-01-02 11:46:54', '2023-01-02 17:46:54', '1'),
(319, '12', 'Rosanna Senger upload a new post(our team is committed to creating the number one online platform and rendering impeccable services to both buyers, sellers, and agents. Making a difference in the real estate industry.)', 61, 625, NULL, '1', 645, 2, 625, 4, '2023-01-02 11:54:23', '2023-01-02 17:54:23', '1'),
(320, '7', ' send a message: Hb,ibedihdie', 225, 20, NULL, '1', 645, 2, 645, 2, '2023-01-03 16:39:08', '2023-01-03 16:39:08', '1'),
(321, '7', ' send a message: Hb,ibedihdieusxheuxhihex', 226, 20, NULL, '1', 645, 2, 645, 2, '2023-01-03 16:39:10', '2023-01-03 16:39:10', '1'),
(322, '7', ' send a message: Hb,ibedihdieusxheuxhihex', 227, 20, NULL, '1', 645, 2, 645, 2, '2023-01-03 16:39:10', '2023-01-03 16:39:10', '1'),
(323, '7', ' send a message: Hb,ibedihdieusxheuxhihex', 228, 20, NULL, '1', 645, 2, 645, 2, '2023-01-03 16:39:10', '2023-01-03 16:39:10', '1'),
(324, '7', ' send a message: ', 229, 20, NULL, '1', 645, 2, 645, 2, '2023-01-03 16:39:11', '2023-01-03 16:39:11', '1'),
(325, '7', ' send a message: Xhuhxe8ehd', 230, 20, NULL, '1', 645, 2, 645, 2, '2023-01-03 16:39:13', '2023-01-03 16:39:13', '1'),
(326, '7', ' send a message: Xhuhxe8ehduvxuebixe', 231, 20, NULL, '1', 645, 2, 645, 2, '2023-01-03 16:39:14', '2023-01-03 16:39:14', '1'),
(327, '7', ' send a message: Xhuhxe8ehduvxuebixenx8ebd8eh', 232, 20, NULL, '1', 645, 2, 645, 2, '2023-01-03 16:39:15', '2023-01-03 16:39:15', '1'),
(328, '7', ' send a message: Xhuhxe8ehduvxuebixenx8ebd8eheu0xbeibd', 233, 20, NULL, '1', 645, 2, 645, 2, '2023-01-03 16:39:16', '2023-01-03 16:39:16', '1'),
(329, '7', ' send a message: Bd8ehd', 234, 20, NULL, '1', 645, 2, 645, 2, '2023-01-03 16:39:20', '2023-01-03 16:39:20', '1'),
(330, '7', 'Rosanna Senger send a message: jhiwfc', 235, 20, NULL, '2', 645, 2, 625, 4, '2023-01-03 16:41:43', '2023-02-14 15:37:28', '1'),
(331, '7', 'Rosanna Senger send a message: jdac  jasd jas  n c jccjuc janmca jcamc kcc kjijca ikjas', 236, 20, NULL, '2', 645, 2, 625, 4, '2023-01-03 16:41:55', '2023-02-14 15:37:30', '1'),
(332, '6', 'Rosanna Senger just joined you on Messag!', 23, 61, NULL, '1', 645, 2, 601, 4, '2023-01-03 16:42:52', '2023-01-03 16:42:52', '1'),
(333, '11', 'Rosanna Senger contact related to post(our team is committed to creating the number one online platform and rendering impeccable services to both buyers, sellers, and agents. Making a difference in the real estate industry.)', 20, 61, NULL, '1', 645, 2, 601, 4, '2023-01-03 10:42:52', '2023-01-03 16:42:52', '1'),
(334, '7', 'Rosanna Senger send a message: bosDFCV', 237, 23, NULL, '1', 645, 2, 601, 4, '2023-01-03 16:42:56', '2023-01-03 16:42:56', '1'),
(335, '7', 'Rosanna Senger send a message: HCVADLUYfL', 238, 23, NULL, '1', 645, 2, 601, 4, '2023-01-03 16:42:58', '2023-01-03 16:42:58', '1'),
(336, '7', 'Rosanna Senger send a message: MXYDNXYTXXMNGSB7SDSGS', 239, 23, NULL, '1', 645, 2, 601, 4, '2023-01-03 16:43:02', '2023-01-03 16:43:02', '1'),
(337, '7', ' send a message: Hi', 240, 11, NULL, '2', 656, 3, 625, 4, '2023-01-04 08:22:43', '2023-02-14 15:37:05', '1'),
(338, '7', ' send a message: How are things going', 241, 11, NULL, '2', 656, 3, 625, 4, '2023-01-04 08:22:54', '2023-02-14 15:37:03', '1'),
(339, '7', ' send a message: Hi', 242, 11, NULL, '1', 656, 3, 656, 4, '2023-01-04 08:23:07', '2023-01-04 08:23:07', '1'),
(340, '7', ' send a message: Ufyuviviuc', 243, 23, NULL, '1', 645, 2, 645, 2, '2023-01-04 11:06:44', '2023-01-04 11:06:44', '1'),
(341, '11', 'Raghavendra Rao contact related to post(Read to Buy a House)', 21, 65, NULL, '1', 707, 2, 670, 4, '2023-01-09 08:02:45', '2023-01-09 14:02:45', '1'),
(342, '13', 'Raghavendra Rao select you for post (Read to Buy a House)', 65, 670, 65, '1', 707, 2, 670, 4, '2023-01-09 14:04:51', '2023-01-09 14:04:51', '1'),
(343, '11', 'Raghavendra Rao contact related to post(Ready to Buy a house immediately)', 22, 64, NULL, '1', 707, 2, 670, 4, '2023-01-09 08:26:12', '2023-01-09 14:26:12', '1'),
(344, '13', 'Raghavendra Rao select you for post (Ready to Buy a house immediately)', 64, 670, 64, '1', 707, 2, 670, 4, '2023-01-09 14:26:18', '2023-01-09 14:26:18', '1'),
(345, '6', 'Raghavendra Rao just joined you on Messag!', 24, 64, NULL, '2', 707, 2, 670, 4, '2023-01-09 14:40:13', '2023-01-19 15:38:42', '1'),
(346, '7', 'Raghavendra Rao send a message: Hi', 244, 24, NULL, '2', 707, 2, 670, 4, '2023-01-09 14:40:39', '2023-01-19 15:38:40', '1'),
(352, '4', 'Raghavendra Rao asked questions related to Buying Home', 25, 51, NULL, '1', 707, 2, 670, 4, '2023-01-09 08:44:13', '2023-01-09 14:44:13', '1'),
(353, '4', 'Raghavendra Rao asked questions related to Buying Home', 26, 49, NULL, '1', 707, 2, 670, 4, '2023-01-09 08:45:01', '2023-01-09 14:45:01', '1'),
(354, '4', 'Raghavendra Rao asked questions related to your post `Ready to Buy a house immediately`', 27, 50, NULL, '1', 707, 2, 707, 4, '2023-01-09 09:00:19', '2023-01-09 15:00:19', '1'),
(355, '4', 'Raghavendra Rao asked questions related to your post `Ready to Buy a house immediately`', 28, 50, NULL, '1', 707, 2, 670, 4, '2023-01-09 09:00:28', '2023-01-09 15:00:28', '1'),
(356, '11', 'Raghavendra Rao contact related to post(This is Post for Selling the house)', 23, 66, NULL, '1', 707, 3, 659, 4, '2023-01-09 09:13:55', '2023-01-09 15:13:55', '1'),
(357, '13', 'Raghavendra Rao select you for post (This is Post for Selling the house)', 66, 659, 66, '1', 707, 3, 659, 4, '2023-01-09 15:13:57', '2023-01-09 15:13:57', '1'),
(358, '12', 'Rosanna Senger upload a new post(Rosanna.Senger ( Buyer ))', 67, 601, NULL, '1', 645, 2, 601, 4, '2023-01-10 08:47:53', '2023-01-10 14:47:53', '1'),
(359, '12', 'Rosanna Senger upload a new post(Rosanna.Senger ( Buyer ))', 67, 625, NULL, '1', 645, 2, 625, 4, '2023-01-10 08:47:53', '2023-01-10 14:47:53', '1'),
(360, '12', 'Priya Kandaswamy upload a new post(This is a post for sellling a villa)', 68, 550, NULL, '1', 656, 3, 550, 4, '2023-01-11 08:09:26', '2023-01-11 14:09:26', '1'),
(361, '11', 'Priya Kandaswamy contact related to post(This is a post for sellling a villa)', 24, 68, NULL, '1', 656, 3, 709, 4, '2023-01-11 08:09:58', '2023-01-11 14:09:58', '1'),
(362, '6', 'Priya Kandaswamy just joined you on Messag!', 25, 68, NULL, '2', 656, 3, 709, 4, '2023-01-11 14:10:07', '2023-01-31 13:35:45', '1'),
(363, '7', 'Priya Kandaswamy send a message: Hi', 245, 25, NULL, '2', 656, 3, 709, 4, '2023-01-11 14:10:15', '2023-01-31 13:35:45', '1'),
(364, '7', 'Priya Kandaswamy send a message: How are you', 246, 25, NULL, '2', 656, 3, 709, 4, '2023-01-11 14:10:18', '2023-01-31 13:35:45', '1'),
(365, '13', 'Priya Kandaswamy select you for post (This is a post for sellling a villa)', 68, 709, 68, '1', 656, 3, 709, 4, '2023-01-11 14:11:09', '2023-01-11 14:11:09', '1'),
(368, '5', 'Priya Kandaswamy share a files related to Selling Home', 31, 5, NULL, '1', 656, 3, 709, 4, '2023-01-11 08:11:35', '2023-01-11 14:11:35', '1'),
(369, '4', 'Priya Kandaswamy asked questions related to Selling Home', 32, 14, NULL, '1', 656, 3, 709, 4, '2023-01-11 08:11:46', '2023-01-11 14:11:46', '1'),
(370, '4', 'Priya Kandaswamy asked questions related to Selling Home', 33, 13, NULL, '1', 656, 3, 709, 4, '2023-01-11 08:11:48', '2023-01-11 14:11:48', '1'),
(371, '4', 'Priya Kandaswamy asked questions related to Selling Home', 34, 61, NULL, '1', 656, 3, 709, 4, '2023-01-11 08:12:01', '2023-01-11 14:12:01', '1'),
(375, '4', 'Priya Kandaswamy asked questions related to Selling Home', 38, 62, NULL, '1', 656, 3, 709, 4, '2023-01-11 08:20:03', '2023-01-11 14:20:03', '1'),
(376, '4', 'Priya Kandaswamy asked questions related to Selling Home', 39, 63, NULL, '1', 656, 3, 709, 4, '2023-01-11 08:20:07', '2023-01-11 14:20:07', '1'),
(377, '4', 'Priya Kandaswamy asked questions related to Selling Home', 40, 64, NULL, '1', 656, 3, 709, 4, '2023-01-11 08:20:15', '2023-01-11 14:20:15', '1'),
(378, '11', 'Kiran Kumar contact related to post(This is Buyer post for buying a Villa)', 25, 70, NULL, '1', 714, 2, 715, 4, '2023-01-16 06:03:33', '2023-01-16 12:03:33', '1'),
(379, '13', 'Kiran Kumar select you for post (This is Buyer post for buying a Villa)', 70, 715, 70, '1', 714, 2, 715, 4, '2023-01-16 12:03:37', '2023-01-16 12:03:37', '1'),
(380, '11', 'Kiran Kumar contact related to post(Interested in Buying a Villa)', 26, 71, NULL, '1', 714, 2, 715, 4, '2023-01-16 06:09:56', '2023-01-16 12:09:56', '1');
INSERT INTO `agents_notification` (`notification_id`, `notification_type`, `notification_message`, `notification_item_id`, `notification_child_item_id`, `notification_post_id`, `status`, `sender_id`, `sender_role`, `receiver_id`, `receiver_role`, `created_at`, `updated_at`, `show`) VALUES
(381, '13', 'Kiran Kumar select you for post (Interested in Buying a Villa)', 71, 715, 71, '1', 714, 2, 715, 4, '2023-01-16 12:09:58', '2023-01-16 12:09:58', '1'),
(382, '6', 'Ankit just joined you on Messag!', 26, 73, NULL, '2', 710, 3, 625, 4, '2023-01-16 12:46:36', '2023-02-14 15:36:25', '1'),
(383, '11', 'Ankit contact related to post(Adumar Works for Estate and lands --)', 27, 73, NULL, '1', 710, 3, 625, 4, '2023-01-16 06:46:36', '2023-01-16 12:46:36', '1'),
(384, '7', 'Ankit send a message: oooyyyeeeeeee', 247, 26, NULL, '2', 710, 3, 625, 4, '2023-01-16 12:46:56', '2023-02-14 15:36:25', '1'),
(385, '7', 'Ankit send a message: helleuououououououououo', 248, 26, NULL, '2', 710, 3, 625, 4, '2023-01-16 12:47:11', '2023-02-14 15:36:34', '1'),
(386, '7', ' send a message: Kiya be', 249, 26, NULL, '1', 710, 3, 710, 3, '2023-01-16 12:47:27', '2023-01-16 12:47:27', '1'),
(387, '7', ' send a message: Kiya dekh raha hai', 250, 26, NULL, '1', 710, 3, 710, 3, '2023-01-16 12:47:35', '2023-01-16 12:47:35', '1'),
(388, '11', 'Bobby Stewart contact related to post(Selling Duplex house with fully furnished 2 bk house located in the heart of the city and good transportation facility)', 28, 74, NULL, '1', 714, 3, 709, 4, '2023-01-16 12:00:17', '2023-01-16 18:00:17', '1'),
(389, '13', 'Bobby Stewart select you for post (Selling Duplex house with fully furnished 2 bk house located in the heart of the city and good transportation facility)', 74, 709, 74, '1', 714, 3, 709, 4, '2023-01-16 18:00:19', '2023-01-16 18:00:19', '1'),
(390, '6', 'Bobby Stewart just joined you on Messag!', 27, 74, NULL, '2', 714, 3, 709, 4, '2023-01-16 18:00:44', '2023-01-31 13:35:30', '1'),
(391, '7', 'Bobby Stewart send a message: Hi This is Guru', 251, 27, NULL, '2', 714, 3, 709, 4, '2023-01-16 18:00:54', '2023-01-31 13:35:31', '1'),
(392, '10', NULL, 0, 11, NULL, '1', 714, 3, NULL, NULL, '2023-01-16 18:01:28', '2023-01-16 18:01:28', '1'),
(393, '10', NULL, NULL, 11, NULL, '1', 714, 3, NULL, NULL, '2023-01-16 18:01:43', '2023-01-16 18:01:43', '1'),
(394, '12', 'Raghavendra Rao upload a new post(our team is committed to creating the number one online platform and rendering impeccable services to both buyers, sellers, and agents. Making a difference in the real estate industry.)', 75, 659, NULL, '1', 707, 3, 659, 4, '2023-01-19 07:34:19', '2023-01-19 13:34:19', '1'),
(395, '6', 'Raghavendra Rao just joined you on Messag!', 28, 75, NULL, '2', 707, 3, 625, 4, '2023-01-19 13:35:34', '2023-02-13 18:58:32', '1'),
(396, '11', 'Raghavendra Rao contact related to post(our team is committed to creating the number one online platform and rendering impeccable services to both buyers, sellers, and agents. Making a difference in the real estate industry.)', 29, 75, NULL, '1', 707, 3, 625, 4, '2023-01-19 07:35:34', '2023-01-19 13:35:34', '1'),
(397, '7', 'Raghavendra Rao send a message: oye hello', 252, 28, NULL, '2', 707, 3, 625, 4, '2023-01-19 13:35:43', '2023-02-13 18:58:32', '1'),
(398, '7', 'Raghavendra Rao send a message: ?/?/?', 253, 28, NULL, '2', 707, 3, 625, 4, '2023-01-19 13:35:54', '2023-02-13 18:58:32', '1'),
(399, '6', 'Raghavendra Rao just joined you on Messag!', 29, 66, NULL, '1', 707, 3, 659, 4, '2023-01-19 15:05:03', '2023-01-19 15:05:03', '1'),
(400, '7', 'Raghavendra Rao send a message: ooue', 254, 29, NULL, '1', 707, 3, 659, 4, '2023-01-19 15:05:11', '2023-01-19 15:05:11', '1'),
(401, '7', 'Shiva Kumar send a message: hi', 255, 24, NULL, '1', 670, 4, 707, 2, '2023-01-19 15:38:51', '2023-01-19 15:38:51', '1'),
(402, '11', 'jack tompkins contact related to post(Need to sell my home in bellevue, asap)', 30, 76, NULL, '1', 716, 3, 692, 4, '2023-01-20 20:34:18', '2023-01-21 02:34:18', '1'),
(403, '6', 'jack tompkins just joined you on Messag!', 30, 76, NULL, '1', 716, 3, 692, 4, '2023-01-21 02:34:18', '2023-01-21 02:34:18', '1'),
(404, '7', 'jack tompkins send a message: Hello Agent', 256, 30, NULL, '1', 716, 3, 692, 4, '2023-01-21 02:34:26', '2023-01-21 02:34:26', '1'),
(405, '7', ' send a message: Good morning', 257, 30, NULL, '2', 716, 3, 716, 3, '2023-01-21 02:38:40', '2023-01-21 02:41:15', '1'),
(406, '7', 'jack tompkins send a message: good afternoon', 258, 30, NULL, '1', 716, 3, 692, 4, '2023-01-21 02:39:01', '2023-01-21 02:39:01', '1'),
(407, '6', 'jack tompkins just joined you on Messag!', 31, 76, NULL, '2', 716, 3, 716, 3, '2023-01-21 02:41:15', '2023-01-21 02:41:17', '1'),
(408, '7', ' send a message: Are you available', 259, 30, NULL, '2', 716, 3, 716, 3, '2023-01-21 02:41:53', '2023-01-21 02:43:35', '1'),
(409, '7', ' send a message: For a call', 260, 30, NULL, '2', 716, 3, 716, 3, '2023-01-21 02:42:59', '2023-01-21 02:43:37', '1'),
(410, '5', 'jack tompkins share a files related to Selling Home', 41, 20, NULL, '1', 716, 3, 692, 4, '2023-01-20 20:43:23', '2023-01-21 02:43:23', '1'),
(411, '7', 'jack tompkins send a message: a test message', 261, 30, NULL, '1', 716, 3, 692, 4, '2023-01-21 11:29:44', '2023-01-21 11:29:44', '1'),
(412, '7', ' send a message: another test', 262, 30, NULL, '2', 716, 3, 716, 3, '2023-01-21 11:29:59', '2023-07-31 09:55:58', '1'),
(413, '4', 'jack tompkins asked questions related to your post `Need to sell my home in bellevue, asap`', 42, 65, NULL, '1', 716, 3, 692, 4, '2023-01-21 05:58:31', '2023-01-21 11:58:31', '1'),
(414, '12', 'Hamza Seller upload a new post(test api)', 81, 550, NULL, '1', 549, 3, 550, 4, '2023-01-27 20:21:29', '2023-01-28 02:21:29', '1'),
(415, '12', 'Priya Kandaswamy upload a new post(This is post titel)', 88, 709, NULL, '1', 656, 3, 709, 4, '2023-01-30 00:55:30', '2023-01-30 06:55:30', '1'),
(416, '12', 'Priya Kandaswamy upload a new post(This is post titel)', 88, 550, NULL, '1', 656, 3, 550, 4, '2023-01-30 00:55:30', '2023-01-30 06:55:30', '1'),
(417, '12', 'Priya Kandaswamy upload a new post(This is post titel)', 88, 550, NULL, '1', 656, 3, 550, 4, '2023-01-30 00:55:30', '2023-01-30 06:55:30', '1'),
(418, '12', 'Raghavendra Rao upload a new post(mobile tes post)', 89, 625, NULL, '1', 707, 3, 625, 4, '2023-01-30 10:23:12', '2023-01-30 16:23:12', '1'),
(419, '12', 'Raghavendra Rao upload a new post(mobile tes post)', 89, 659, NULL, '1', 707, 3, 659, 4, '2023-01-30 10:23:12', '2023-01-30 16:23:12', '1'),
(420, '11', 'Raghavendra Rao contact related to post(mobile tes post)', 31, 89, NULL, '1', 707, 3, 660, 4, '2023-01-31 06:56:23', '2023-01-31 12:56:23', '1'),
(421, '13', 'Raghavendra Rao select you for post (mobile tes post)', 89, 660, 89, '1', 707, 3, 660, 4, '2023-01-31 12:56:24', '2023-01-31 12:56:24', '1'),
(422, '11', 'Raghavendra Rao contact related to post(our team is committed to creating the number one online platform and rendering impeccable services to both buyers, sellers, and agents. Making a difference in the real estate industry.)', 32, 75, NULL, '1', 707, 3, 709, 4, '2023-01-31 06:56:55', '2023-01-31 12:56:55', '1'),
(423, '13', 'Raghavendra Rao select you for post (our team is committed to creating the number one online platform and rendering impeccable services to both buyers, sellers, and agents. Making a difference in the real estate industry.)', 75, 709, 75, '1', 707, 3, 709, 4, '2023-01-31 12:56:58', '2023-01-31 12:56:58', '1'),
(424, '4', 'Raghavendra Rao asked questions related to your post `our team is committed to creating the number one online platform and rendering impeccable services to both buyers, sellers, and agents. Making a difference in the real estate industry.`', 43, 69, NULL, '2', 707, 3, 709, 4, '2023-01-31 07:09:29', '2023-01-31 18:10:45', '1'),
(425, '4', 'Raghavendra Rao asked questions related to your post `This is Post for Selling the house`', 44, 69, NULL, '1', 707, 3, 659, 4, '2023-01-31 07:09:37', '2023-01-31 13:09:37', '1'),
(426, '4', 'Raghavendra Rao asked questions related to your post `our team is committed to creating the number one online platform and rendering impeccable services to both buyers, sellers, and agents. Making a difference in the real estate industry.`', 45, 68, NULL, '2', 707, 3, 709, 4, '2023-01-31 07:09:57', '2023-01-31 18:10:45', '1'),
(427, '4', 'Raghavendra Rao asked questions related to your post `This is Post for Selling the house`', 46, 68, NULL, '1', 707, 3, 659, 4, '2023-01-31 07:10:01', '2023-01-31 13:10:01', '1'),
(428, '1', 'Purnima Pindi asked questions related to your post `our team is committed to creating the number one online platform and rendering impeccable services to both buyers, sellers, and agents. Making a difference in the real estate industry.`', 47, 59, NULL, '1', 709, 4, 707, 3, '2023-01-31 12:03:49', '2023-01-31 18:03:49', '1'),
(429, '1', 'Purnima Pindi asked questions related to your post `our team is committed to creating the number one online platform and rendering impeccable services to both buyers, sellers, and agents. Making a difference in the real estate industry.`', 48, 58, NULL, '1', 709, 4, 707, 3, '2023-01-31 12:03:52', '2023-01-31 18:03:52', '1'),
(432, '1', 'Purnima Pindi asked questions related to your post `our team is committed to creating the number one online platform and rendering impeccable services to both buyers, sellers, and agents. Making a difference in the real estate industry.`', 51, 70, NULL, '1', 709, 4, 707, 3, '2023-01-31 12:06:51', '2023-01-31 18:06:51', '1'),
(433, '3', 'Purnima Pindi share a proposal related to your post `our team is committed to creating the number one online platform and rendering impeccable services to both buyers, sellers, and agents. Making a difference in the real estate industry.`', 52, 6, NULL, '1', 709, 4, 707, 3, '2023-01-31 12:07:10', '2023-01-31 18:07:10', '1'),
(434, '3', 'Purnima Pindi share a proposal related to your post `our team is committed to creating the number one online platform and rendering impeccable services to both buyers, sellers, and agents. Making a difference in the real estate industry.`', 53, 5, NULL, '1', 709, 4, 707, 3, '2023-01-31 12:07:16', '2023-01-31 18:07:16', '1'),
(435, '6', 'Purnima Pindi just joined you on Messag!', 32, 75, NULL, '1', 709, 4, 707, 3, '2023-01-31 18:08:05', '2023-01-31 18:08:05', '1'),
(436, '7', 'Purnima Pindi send a message: Hi This is Guru', 263, 32, NULL, '1', 709, 4, 707, 3, '2023-01-31 18:08:14', '2023-01-31 18:08:14', '1'),
(437, '7', 'Purnima Pindi send a message: How are you. This is Guru', 264, 32, NULL, '1', 709, 4, 707, 3, '2023-01-31 18:08:29', '2023-01-31 18:08:29', '1'),
(438, '10', 'Purnima Pindi replied ( jjjj ). your question ( Place of Birth )', 0, 68, NULL, '1', 709, 4, 707, 3, '2023-01-31 18:10:53', '2023-01-31 18:10:53', '1'),
(439, '11', 'brody brickle contact related to post(need plumber)', 33, 103, NULL, '1', 739, 2, 735, 4, '2023-02-05 09:25:25', '2023-02-05 15:25:25', '1'),
(440, '13', 'brody brickle select you for post (need plumber)', 103, 735, 103, '1', 739, 2, 735, 4, '2023-02-05 15:27:45', '2023-02-05 15:27:45', '1'),
(441, '13', 'brody brickle select you for post (need plumber)', 103, 735, 103, '1', 739, 2, 735, 4, '2023-02-05 15:27:47', '2023-02-05 15:27:47', '1'),
(442, '13', 'brody brickle select you for post (need plumber)', 103, 735, 103, '1', 739, 2, 735, 4, '2023-02-05 15:27:49', '2023-02-05 15:27:49', '1'),
(443, '6', 'brody brickle just joined you on Messag!', 33, 103, NULL, '1', 739, 2, 735, 4, '2023-02-05 15:51:28', '2023-02-05 15:51:28', '1'),
(446, '4', 'brody brickle asked questions related to your post `need plumber`', 56, 74, NULL, '1', 739, 2, 735, 4, '2023-02-05 10:39:37', '2023-02-05 16:39:37', '1'),
(447, '7', ' send a message: Hi', 265, 1, NULL, '1', 550, 4, 549, 3, '2023-02-06 00:43:56', '2023-02-06 00:43:56', '1'),
(448, '7', 'Grayson Kub send a message: tu kiya dekh raha hai', 266, 26, NULL, '1', 625, 4, 710, 3, '2023-02-14 15:36:54', '2023-02-14 15:36:54', '1'),
(449, '6', 'Grayson Kub just joined you on Messag!', 34, 38, NULL, '1', 625, 4, 656, 3, '2023-02-14 15:37:03', '2023-02-14 15:37:03', '1'),
(450, '7', 'Grayson Kub send a message: hi', 267, 34, NULL, '1', 625, 4, 656, 3, '2023-02-14 15:37:22', '2023-02-14 15:37:22', '1'),
(451, '7', 'Grayson Kub send a message: qburnapmcgucrioghignah', 268, 20, NULL, '1', 625, 4, 645, 2, '2023-02-14 15:37:40', '2023-02-14 15:37:40', '1'),
(452, '7', 'Grayson Kub send a message: sjfoIHVhvoh', 269, 20, NULL, '1', 625, 4, 645, 2, '2023-02-14 15:37:50', '2023-02-14 15:37:50', '1'),
(453, '7', 'Grayson Kub send a message: thik hai', 270, 22, NULL, '1', 625, 4, 651, 2, '2023-02-14 15:38:03', '2023-02-14 15:38:03', '1'),
(454, '6', 'Grayson Kub just joined you on Messag!', 35, 35, NULL, '1', 625, 4, 645, 2, '2023-02-22 19:14:23', '2023-02-22 19:14:23', '1'),
(455, '7', 'Grayson Kub send a message: Hey', 271, 35, NULL, '1', 625, 4, 645, 2, '2023-02-22 19:19:32', '2023-02-22 19:19:32', '1'),
(456, '6', 'test agent just joined you on Messag!', 36, 102, NULL, '1', 550, 4, 739, 2, '2023-02-26 23:30:38', '2023-02-26 23:30:38', '1'),
(457, '6', 'test agent just joined you on Messag!', 37, 100, NULL, '1', 550, 4, 737, 3, '2023-02-27 16:30:47', '2023-02-27 16:30:47', '1'),
(458, '11', 'patric test contact related to post(test 01)', 34, 111, NULL, '1', 762, 3, 670, 4, '2023-03-03 08:36:29', '2023-03-03 14:36:29', '1'),
(459, '13', 'patric test select you for post (test 01)', 111, 670, 111, '1', 762, 3, 670, 4, '2023-03-03 14:37:29', '2023-03-03 14:37:29', '1'),
(462, '12', 'patric test upload a new post(test02)', 112, 670, NULL, '1', 762, 3, 670, 4, '2023-03-03 08:56:45', '2023-03-03 14:56:45', '1'),
(463, '12', 'patric test upload a new post(test03)', 114, 670, NULL, '1', 762, 3, 670, 4, '2023-03-03 12:11:30', '2023-03-03 18:11:30', '1'),
(464, '11', 'patric test contact related to post(test03)', 35, 114, NULL, '1', 762, 3, 763, 4, '2023-03-03 12:17:36', '2023-03-03 18:17:36', '1'),
(465, '13', 'patric test select you for post (test03)', 114, 763, 114, '1', 762, 3, 763, 4, '2023-03-03 18:17:38', '2023-03-03 18:17:38', '1'),
(466, '11', 'patric test contact related to post(test02)', 36, 112, NULL, '1', 762, 3, 763, 4, '2023-03-03 12:19:17', '2023-03-03 18:19:17', '1'),
(467, '13', 'patric test select you for post (test02)', 112, 763, 112, '1', 762, 3, 763, 4, '2023-03-03 18:19:20', '2023-03-03 18:19:20', '1'),
(468, '6', 'Test Ritz just joined you on Messag!', 38, 118, NULL, '2', 767, 2, 769, 4, '2023-03-12 13:39:07', '2023-03-16 22:50:50', '1'),
(469, '11', 'Test Ritz contact related to post(Home_Test)', 37, 118, NULL, '1', 767, 2, 769, 4, '2023-03-12 08:39:07', '2023-03-12 13:39:07', '1'),
(470, '7', 'Test Ritz send a message: hii , this side ritu', 272, 38, NULL, '2', 767, 2, 769, 4, '2023-03-12 13:39:25', '2023-03-16 22:50:48', '1'),
(471, '7', 'Test Ritz send a message: Hello', 273, 38, NULL, '2', 767, 2, 769, 4, '2023-03-12 13:39:42', '2023-03-16 22:50:50', '1'),
(472, '13', 'Test Ritz select you for post (Home_Test)', 118, 769, 118, '1', 767, 2, 769, 4, '2023-03-12 13:43:54', '2023-03-12 13:43:54', '1'),
(473, '12', 'Test Ritz upload a new post(Testing)', 120, 769, NULL, '1', 767, 2, 769, 4, '2023-03-13 16:14:54', '2023-03-13 21:14:54', '1'),
(474, '7', ' send a message: Bxjbdjd', 274, 38, NULL, '1', 767, 2, 767, 2, '2023-03-13 21:15:36', '2023-03-13 21:15:36', '1'),
(475, '7', ' send a message: Only for testing purpose', 275, 38, NULL, '1', 769, 4, 767, 2, '2023-03-13 21:17:05', '2023-03-13 21:17:05', '1'),
(476, '10', NULL, 0, 9, NULL, '1', 767, 3, NULL, NULL, '2023-03-16 22:37:38', '2023-03-16 22:37:38', '1'),
(477, '10', NULL, NULL, 9, NULL, '1', 767, 3, NULL, NULL, '2023-03-16 22:37:45', '2023-03-16 22:37:45', '1'),
(478, '11', 'Test Ritz contact related to post(Test)', 38, 124, NULL, '1', 767, 3, 774, 4, '2023-03-16 17:43:53', '2023-03-16 22:43:53', '1'),
(479, '13', 'Test Ritz select you for post (Test)', 124, 774, 124, '1', 767, 3, 774, 4, '2023-03-16 22:44:01', '2023-03-16 22:44:01', '1'),
(480, '4', 'Test Ritz asked questions related to Selling Home', 59, 82, NULL, '1', 767, 3, 774, 4, '2023-03-16 17:44:09', '2023-03-16 22:44:09', '1'),
(481, '4', 'Test Ritz asked questions related to Selling Home', 60, 81, NULL, '1', 767, 3, 774, 4, '2023-03-16 17:44:11', '2023-03-16 22:44:11', '1'),
(482, '6', 'RituK Tester just joined you on Messag!', 39, 118, NULL, '1', 769, 4, 767, 2, '2023-03-16 22:50:48', '2023-03-16 22:50:48', '1'),
(483, '6', 'RituK Tester just joined you on Messag!', 40, 118, NULL, '2', 769, 4, 767, 3, '2023-03-16 22:51:10', '2023-03-16 22:52:01', '1'),
(484, '6', 'Test Ritz just joined you on Messag!', 41, 124, NULL, '1', 767, 3, 774, 4, '2023-03-16 22:51:46', '2023-03-16 22:51:46', '1'),
(485, '7', 'Test Ritz send a message: Hi', 276, 41, NULL, '1', 767, 3, 774, 4, '2023-03-16 22:51:51', '2023-03-16 22:51:51', '1'),
(486, '12', 'Test Ritz upload a new post(Only for test)', 125, 774, NULL, '1', 767, 3, 774, 4, '2023-03-16 17:54:24', '2023-03-16 22:54:24', '1'),
(487, '11', 'Ritu_Test bhfbjfhj wewnewmnwe em,em,me ewm,ewm,m, qmnqmnmq emnemnemn ememenm ewmnemne  wemnemnwemn qw,mq,m,mq ewmnwemnwmn wemnewmnmne qmnqmm wm,ewm,ew,m qm,we,mwe,m qe,mewmnewnm q,mewmenwm ,me wemewmn we,mrmnr e mewmew ewm,ew,m,mew wmewm,mweklemne e,m,me contact related to post(Home_Test)', 39, 118, NULL, '1', 767, 3, 769, 4, '2023-03-18 12:23:45', '2023-03-18 17:23:45', '1'),
(488, '7', 'Ritu_Test bhfbjfhj wewnewmnwe em,em,me ewm,ewm,m, qmnqmnmq emnemnemn ememenm ewmnemne  wemnemnwemn qw,mq,m,mq ewmnwemnwmn wemnewmnmne qmnqmm wm,ewm,ew,m qm,we,mwe,m qe,mewmnewnm q,mewmenwm ,me wemewmn we,mrmnr e mewmew ewm,ew,m,mew wmewm,mweklemne e,m,me send a message: ', 277, 40, NULL, '1', 767, 3, 769, 4, '2023-03-18 17:24:18', '2023-03-18 17:24:18', '1'),
(489, '7', 'Ritu_Test bhfbjfhj wewnewmnwe em,em,me ewm,ewm,m, qmnqmnmq emnemnemn ememenm ewmnemne  wemnemnwemn qw,mq,m,mq ewmnwemnwmn wemnewmnmne qmnqmm wm,ewm,ew,m qm,we,mwe,m qe,mewmnewnm q,mewmenwm ,me wemewmn we,mrmnr e mewmew ewm,ew,m,mew wmewm,mweklemne e,m,me send a message: ewmnsf', 278, 40, NULL, '1', 767, 3, 769, 4, '2023-03-18 17:24:24', '2023-03-18 17:24:24', '1'),
(490, '7', 'Ritu_Test bhfbjfhj wewnewmnwe em,em,me ewm,ewm,m, qmnqmnmq emnemnemn ememenm ewmnemne  wemnemnwemn qw,mq,m,mq ewmnwemnwmn wemnewmnmne qmnqmm wm,ewm,ew,m qm,we,mwe,m qe,mewmnewnm q,mewmenwm ,me wemewmn we,mrmnr e mewmew ewm,ew,m,mew wmewm,mweklemne e,m,me send a message: ', 279, 40, NULL, '1', 767, 3, 769, 4, '2023-03-18 17:24:33', '2023-03-18 17:24:33', '1'),
(491, '7', 'Ritu_Test bhfbjfhj wewnewmnwe em,em,me ewm,ewm,m, qmnqmnmq emnemnemn ememenm ewmnemne  wemnemnwemn qw,mq,m,mq ewmnwemnwmn wemnewmnmne qmnqmm wm,ewm,ew,m qm,we,mwe,m qe,mewmnewnm q,mewmenwm ,me wemewmn we,mrmnr e mewmew ewm,ew,m,mew wmewm,mweklemne e,m,me send a message: This is only for testing purpose', 280, 40, NULL, '1', 767, 3, 769, 4, '2023-03-18 17:25:02', '2023-03-18 17:25:02', '1'),
(492, '12', 'Ritu_Test bhfbjfhj wewnewmnwe em,em,me ewm,ewm,m, qmnqmnmq emnemnemn ememenm ewmnemne  wemnemnwemn qw,mq,m,mq ewmnwemnwmn wemnewmnmne qmnqmm wm,ewm,ew,m qm,we,mwe,m qe,mewmnewnm q,mewmenwm ,me wemewmn we,mrmnr e mewmew ewm,ew,m,mew wmewm,mweklemne e,m,me upload a new post(This is testing two)', 126, 769, NULL, '1', 767, 3, 769, 4, '2023-03-18 12:45:34', '2023-03-18 17:45:34', '1'),
(493, '12', 'Ritu_Test bhfbjfhj wewnewmnwe em,em,me ewm,ewm,m, qmnqmnmq emnemnemn ememenm ewmnemne  wemnemnwemn qw,mq,m,mq ewmnwemnwmn wemnewmnmne qmnqmm wm,ewm,ew,m qm,we,mwe,m qe,mewmnewnm q,mewmenwm ,me wemewmn we,mrmnr e mewmew ewm,ew,m,mew wmewm,mweklemne e,m,me upload a new post(This is testing two)', 126, 774, NULL, '1', 767, 3, 774, 4, '2023-03-18 12:45:34', '2023-03-18 17:45:34', '1'),
(494, '10', NULL, 0, 52, NULL, '1', 549, 3, NULL, NULL, '2023-04-05 00:57:25', '2023-04-05 00:57:25', '1'),
(495, '6', 'Hamza Seller dssdsssssssssssssssssssssssssssssssss just joined you on Messag!', 42, 38, NULL, '1', 549, 3, 558, 2, '2023-04-05 02:27:34', '2023-04-05 02:27:34', '1'),
(496, '11', 'seller test contact related to post(test sell 2)', 40, 135, NULL, '1', 784, 3, 781, 4, '2023-04-13 10:36:24', '2023-04-13 15:36:24', '1'),
(497, '13', 'seller test select you for post (test sell 2)', 135, 781, 135, '1', 784, 3, 781, 4, '2023-04-13 15:37:17', '2023-04-13 15:37:17', '1'),
(498, '13', 'seller test select you for post (test sell 2)', 135, 781, 135, '1', 784, 3, 781, 4, '2023-04-13 15:37:18', '2023-04-13 15:37:18', '1'),
(499, '4', 'seller test asked questions related to Selling Home', 61, 83, NULL, '1', 784, 3, 781, 4, '2023-04-13 10:42:46', '2023-04-13 15:42:46', '1'),
(500, '11', 'seller test contact related to post(test selling 1)', 41, 134, NULL, '1', 784, 3, 786, 4, '2023-04-13 12:17:52', '2023-04-13 17:17:52', '1'),
(501, '4', 'seller test asked questions related to Selling Home', 62, 86, NULL, '1', 784, 3, 786, 4, '2023-04-13 12:17:52', '2023-04-13 17:17:52', '1'),
(502, '4', 'seller test asked questions related to Selling Home', 63, 87, NULL, '1', 784, 3, 786, 4, '2023-04-13 12:18:23', '2023-04-13 17:18:23', '1'),
(503, '4', 'seller test asked questions related to Selling Home', 64, 88, NULL, '1', 784, 3, 786, 4, '2023-04-13 12:18:37', '2023-04-13 17:18:37', '1'),
(504, '13', 'seller test select you for post (test selling 1)', 134, 786, 134, '1', 784, 3, 786, 4, '2023-04-13 17:23:14', '2023-04-13 17:23:14', '1'),
(505, '1', 'newagent newnew asked questions related to your post `test selling 1`', 65, 94, NULL, '1', 809, 4, 784, 4, '2023-05-15 10:12:36', '2023-05-15 15:12:36', '1'),
(506, '1', 'newagent newnew asked questions related to your post `test selling 1`', 65, 94, NULL, '1', 809, 4, 784, 4, '2023-05-15 10:13:09', '2023-05-15 15:13:09', '1'),
(507, '1', 'newagent newnew asked questions related to your post `test selling 1`', 66, 94, NULL, '1', 809, 4, 786, 4, '2023-05-15 10:16:12', '2023-05-15 15:16:12', '1'),
(508, '11', 'ashish mishra contact related to post(i want to sell my home in 30 days)', 42, 137, NULL, '1', 828, 3, 830, 4, '2023-06-03 09:08:59', '2023-06-03 14:08:59', '1'),
(509, '6', 'ashish mishra just joined you on Messag!', 43, 137, NULL, '2', 828, 3, 830, 4, '2023-06-03 14:09:00', '2023-06-03 14:09:57', '1'),
(510, '7', 'ashish mishra send a message: hello', 281, 43, NULL, '2', 828, 3, 830, 4, '2023-06-03 14:09:06', '2023-06-03 14:09:53', '1'),
(511, '7', 'agent testing send a message: hello', 282, 43, NULL, '2', 830, 4, 828, 3, '2023-06-03 14:10:09', '2023-06-03 14:12:47', '1'),
(512, '7', 'ashish mishra send a message: hii', 283, 43, NULL, '2', 828, 3, 830, 4, '2023-06-03 14:12:52', '2023-06-03 14:13:16', '1'),
(513, '7', 'ashish mishra send a message: hello', 284, 43, NULL, '2', 828, 3, 830, 4, '2023-06-03 14:20:31', '2023-06-03 14:25:12', '1'),
(514, '7', 'ashish mishra send a message: abcd', 285, 43, NULL, '2', 828, 3, 830, 4, '2023-06-03 14:21:09', '2023-06-03 14:25:02', '1'),
(516, '4', 'ashish mishra asked questions related to Selling Home', 68, 101, NULL, '2', 828, 3, 830, 4, '2023-06-03 09:45:41', '2023-06-03 15:05:58', '1'),
(517, '4', 'ashish mishra asked questions related to Selling Home', 69, 102, NULL, '2', 828, 3, 830, 4, '2023-06-03 09:46:31', '2023-06-03 15:05:58', '1'),
(518, '4', 'ashish mishra asked questions related to Selling Home', 70, 103, NULL, '2', 828, 3, 830, 4, '2023-06-03 09:46:46', '2023-06-03 15:05:52', '1'),
(519, '13', 'ashish mishra select you for post (i want to sell my home in 30 days)', 137, 830, 137, '1', 828, 3, 830, 4, '2023-06-03 15:03:03', '2023-06-03 15:03:03', '1'),
(520, '10', 'agent testing replied ( hello ). your question ( question 3 )', 0, 103, NULL, '1', 830, 4, 828, 3, '2023-06-03 15:06:20', '2023-06-03 15:06:20', '1'),
(521, '10', NULL, 0, 52, NULL, '1', 828, 3, NULL, NULL, '2023-06-03 16:07:48', '2023-06-03 16:07:48', '1'),
(522, '12', 'ashish mishra upload a new post(image post)', 141, 830, NULL, '1', 828, 3, 830, 4, '2023-06-03 11:15:44', '2023-06-03 16:15:44', '1'),
(523, '6', 'lala just joined you on Messag!', 44, 144, NULL, '1', 810, 3, 830, 4, '2023-07-08 17:45:45', '2023-07-08 17:45:45', '1'),
(524, '11', 'lala contact related to post(developer2)', 43, 144, NULL, '1', 810, 3, 830, 4, '2023-07-08 12:45:45', '2023-07-08 17:45:45', '1'),
(525, '10', NULL, 0, 52, NULL, '1', 810, 3, NULL, NULL, '2023-07-10 12:49:41', '2023-07-10 12:49:41', '1'),
(526, '10', NULL, 0, 52, NULL, '1', 839, 3, NULL, NULL, '2023-07-19 12:49:02', '2023-07-19 12:49:02', '1'),
(527, '10', NULL, NULL, 52, NULL, '1', 839, 3, NULL, NULL, '2023-07-19 13:22:58', '2023-07-19 13:22:58', '1'),
(528, '10', NULL, NULL, 9, NULL, '1', 839, 3, NULL, NULL, '2023-07-19 13:32:49', '2023-07-19 13:32:49', '1'),
(529, '10', NULL, NULL, 9, NULL, '1', 839, 3, NULL, NULL, '2023-07-19 13:49:20', '2023-07-19 13:49:20', '1'),
(530, '10', NULL, NULL, 9, NULL, '1', 839, 3, NULL, NULL, '2023-07-20 12:30:31', '2023-07-20 12:30:31', '1'),
(531, '10', NULL, 0, 52, NULL, '1', 835, 3, NULL, NULL, '2023-07-21 11:10:17', '2023-07-21 11:10:17', '1'),
(532, '10', NULL, NULL, 52, NULL, '1', 835, 3, NULL, NULL, '2023-07-21 11:11:11', '2023-07-21 11:11:11', '1'),
(533, '10', NULL, NULL, 52, NULL, '1', 835, 3, NULL, NULL, '2023-07-21 11:14:18', '2023-07-21 11:14:18', '1'),
(534, '10', NULL, NULL, 52, NULL, '1', 835, 3, NULL, NULL, '2023-07-21 11:14:26', '2023-07-21 11:14:26', '1'),
(535, '10', NULL, 0, 9, NULL, '1', 835, 3, NULL, NULL, '2023-07-21 11:14:37', '2023-07-21 11:14:37', '1'),
(536, '10', NULL, NULL, 52, NULL, '1', 835, 3, NULL, NULL, '2023-07-21 11:24:48', '2023-07-21 11:24:48', '1'),
(537, '10', NULL, 0, 9, NULL, '1', 835, 3, NULL, NULL, '2023-07-21 11:28:21', '2023-07-21 11:28:21', '1'),
(538, '10', NULL, NULL, 9, NULL, '1', 835, 3, NULL, NULL, '2023-07-21 11:28:35', '2023-07-21 11:28:35', '1'),
(539, '10', NULL, NULL, 9, NULL, '1', 835, 3, NULL, NULL, '2023-07-21 11:28:43', '2023-07-21 11:28:43', '1'),
(540, '10', NULL, 0, 52, NULL, '1', 835, 3, NULL, NULL, '2023-07-21 11:29:16', '2023-07-21 11:29:16', '1'),
(541, '10', NULL, NULL, 52, NULL, '1', 835, 3, NULL, NULL, '2023-07-21 11:33:38', '2023-07-21 11:33:38', '1'),
(542, '11', 'qwer qwert contact related to post(NEw home)', 44, 147, NULL, '1', 839, 3, 834, 4, '2023-07-27 06:04:42', '2023-07-27 11:04:42', '1'),
(543, '12', 'qwer qwert upload a new post(NEWJSJJ)', 148, 834, NULL, '1', 839, 3, 834, 4, '2023-07-27 08:27:50', '2023-07-27 13:27:50', '1'),
(544, '12', 'qwer qwert upload a new post(NEWJSJJ)', 149, 834, NULL, '1', 839, 3, 834, 4, '2023-07-27 08:35:02', '2023-07-27 13:35:02', '1'),
(545, '7', 'jack tompkins send a message: hello', 286, 30, NULL, '1', 716, 3, 692, 4, '2023-07-31 09:58:51', '2023-07-31 09:58:51', '1'),
(546, '7', 'jack tompkins send a message: Hello again', 287, 31, NULL, '2', 716, 3, 716, 3, '2023-07-31 09:59:14', '2023-07-31 09:59:14', '1'),
(547, '6', 'Satish Pai just joined you on Messag!', 45, 153, NULL, '2', 841, 2, 842, 4, '2023-08-02 12:29:12', '2023-08-02 12:29:48', '1'),
(548, '11', 'Satish Pai contact related to post(Buyer Post)', 45, 153, NULL, '1', 841, 2, 842, 4, '2023-08-02 07:29:12', '2023-08-02 12:29:12', '1'),
(549, '7', 'Seena Nayak send a message: Hi', 288, 45, NULL, '2', 842, 4, 841, 2, '2023-08-02 12:30:02', '2023-08-02 12:30:14', '1'),
(550, '7', 'Seena Nayak send a message: Hi', 289, 45, NULL, '2', 842, 4, 841, 2, '2023-08-02 12:31:07', '2023-08-08 10:24:48', '1'),
(551, '13', 'Satish Pai select you for post (Buyer Post)', 153, 842, 153, '1', 841, 2, 842, 4, '2023-08-02 12:31:57', '2023-08-02 12:31:57', '1'),
(556, '5', 'Satish Pai share a files related to Buying Home', 75, 53, NULL, '1', 841, 2, 842, 4, '2023-08-09 11:27:13', '2023-08-09 16:27:13', '1'),
(557, '7', 'Shiva Kumar send a message: Hi', 290, 24, NULL, '1', 670, 4, 707, 2, '2023-08-10 15:06:22', '2023-08-10 15:06:22', '1'),
(558, '6', 'Shiva Kumar just joined you on Messag!', 46, 111, NULL, '1', 670, 4, 762, 3, '2023-08-10 15:16:26', '2023-08-10 15:16:26', '1'),
(559, '1', 'Shiva Kumar asked questions related to your post `test 01`', 76, 130, NULL, '1', 670, 4, 762, 3, '2023-08-10 10:17:19', '2023-08-10 15:17:19', '1'),
(560, '1', 'Shiva Kumar asked questions related to your post `test 01`', 77, 131, NULL, '1', 670, 4, 762, 3, '2023-08-10 10:17:31', '2023-08-10 15:17:31', '1'),
(561, '1', 'Shiva Kumar asked questions related to your post `test 01`', 78, 132, NULL, '1', 670, 4, 762, 3, '2023-08-10 10:17:41', '2023-08-10 15:17:41', '1'),
(562, '1', 'Shiva Kumar asked questions related to your post `test 01`', 79, 133, NULL, '1', 670, 4, 762, 3, '2023-08-10 10:19:36', '2023-08-10 15:19:36', '1'),
(563, '1', 'Shiva Kumar asked questions related to your post `test 01`', 80, 134, NULL, '1', 670, 4, 762, 3, '2023-08-10 10:23:22', '2023-08-10 15:23:22', '1'),
(564, '1', 'Shiva Kumar asked questions related to your post `test 01`', 81, 140, NULL, '1', 670, 4, 762, 3, '2023-08-17 07:04:26', '2023-08-17 12:04:26', '1'),
(565, '1', 'Shiva Kumar asked questions related to your post `test 01`', 82, 141, NULL, '1', 670, 4, 762, 3, '2023-08-17 07:16:10', '2023-08-17 12:16:10', '1'),
(566, '1', 'Shiva Kumar asked questions related to your post `test 01`', 83, 142, NULL, '1', 670, 4, 762, 3, '2023-08-17 07:17:57', '2023-08-17 12:17:57', '1'),
(567, '1', 'Shiva Kumar asked questions related to your post `test 01`', 84, 143, NULL, '1', 670, 4, 762, 3, '2023-08-17 07:23:00', '2023-08-17 12:23:00', '1'),
(568, '1', 'Shiva Kumar asked questions related to your post `test 01`', 85, 144, NULL, '1', 670, 4, 762, 3, '2023-08-17 07:23:24', '2023-08-17 12:23:24', '1'),
(569, '1', 'Shiva Kumar asked questions related to your post `test 01`', 86, 158, NULL, '1', 670, 4, 762, 3, '2023-08-17 11:12:05', '2023-08-17 16:12:05', '1'),
(570, '1', 'Shiva Kumar asked questions related to your post `test 01`', 87, 159, NULL, '1', 670, 4, 762, 3, '2023-08-17 11:12:13', '2023-08-17 16:12:13', '1'),
(571, '1', 'Shiva Kumar asked questions related to your post `test 01`', 88, 160, NULL, '1', 670, 4, 762, 3, '2023-08-17 11:12:21', '2023-08-17 16:12:21', '1'),
(572, '1', 'Shiva Kumar asked questions related to your post `test 01`', 89, 161, NULL, '1', 670, 4, 762, 3, '2023-08-17 11:12:30', '2023-08-17 16:12:30', '1'),
(573, '1', 'ndjbs hjgh asked questions related to your post `test 01`', 90, 162, NULL, '1', 832, 4, 762, 3, '2023-08-17 11:20:46', '2023-08-17 16:20:46', '1'),
(574, '6', 'SAVAN RATHOD just joined you on Messag!', 47, 156, NULL, '2', 851, 3, 852, 4, '2023-09-14 23:54:01', '2023-09-14 23:54:28', '1'),
(575, '11', 'SAVAN RATHOD contact related to post(test for db test)', 48, 156, NULL, '1', 851, 3, 852, 4, '2023-09-14 18:54:01', '2023-09-14 23:54:01', '1'),
(576, '7', 'SAVAN RATHOD send a message: hello', 291, 47, NULL, '2', 851, 3, 852, 4, '2023-09-14 23:54:07', '2023-09-14 23:54:25', '1'),
(577, '7', 'SAVAN RATHOD send a message: can you see this message ?', 292, 47, NULL, '2', 851, 3, 852, 4, '2023-09-14 23:54:53', '2023-09-14 23:55:37', '1'),
(578, '11', 'Vignesh Selvan contact related to post(House)', 49, 158, NULL, '1', 855, 2, 853, 4, '2023-11-11 12:48:15', '2023-11-11 18:48:15', '1'),
(579, '6', 'Vignesh Selvan just joined you on Messag!', 48, 158, NULL, '1', 855, 2, 853, 4, '2023-11-11 18:48:15', '2023-11-11 18:48:15', '1'),
(580, '6', 'Abi Abi just joined you on Messag!', 49, 162, NULL, '2', 859, 3, 860, 4, '2023-12-06 12:10:55', '2023-12-08 12:42:22', '1'),
(581, '11', 'Abi Abi contact related to post(Travel Accessories)', 50, 162, NULL, '1', 859, 3, 860, 4, '2023-12-06 06:10:55', '2023-12-06 12:10:55', '1'),
(582, '13', 'Abi Abi select you for post (Travel Accessories)', 162, 860, 162, '1', 859, 3, 860, 4, '2023-12-06 12:14:31', '2023-12-06 12:14:31', '1'),
(583, '7', 'Abi Abi send a message: Hi,', 293, 49, NULL, '2', 859, 3, 860, 4, '2023-12-06 12:22:24', '2023-12-08 12:42:22', '1'),
(584, '7', 'Abi Abi send a message: From compact travel adapters to durable luggage organizers and everything in between, we\'re committed to providing you with high-quality products that cater to your travel comfort and convenience.', 294, 49, NULL, '2', 859, 3, 860, 4, '2023-12-06 12:22:27', '2023-12-08 12:42:19', '1'),
(585, '11', 'Anu Anu contact related to post(Travel accessories)', 51, 163, NULL, '1', 861, 2, 860, 4, '2023-12-07 10:26:35', '2023-12-07 16:26:35', '1'),
(586, '13', 'Anu Anu select you for post (Travel accessories)', 163, 860, 163, '1', 861, 2, 860, 4, '2023-12-07 16:26:37', '2023-12-07 16:26:37', '1'),
(587, '11', 'Anu Anu contact related to post(Ultimate Noise-Canceling Headphones for Pure Musical Bliss)', 52, 164, NULL, '1', 861, 2, 853, 4, '2023-12-12 09:43:27', '2023-12-12 15:43:27', '1'),
(588, '6', 'Abi Abi just joined you on Messag!', 50, 161, NULL, '2', 859, 3, 860, 4, '2023-12-28 11:29:15', '2024-02-10 15:58:51', '1'),
(589, '11', 'Abi Abi contact related to post(Travel accessories)', 53, 161, NULL, '1', 859, 3, 860, 4, '2023-12-28 05:29:15', '2023-12-28 11:29:15', '1'),
(590, '13', 'Abi Abi select you for post (Travel accessories)', 161, 860, 161, '1', 859, 3, 860, 4, '2023-12-28 11:30:41', '2023-12-28 11:30:41', '1'),
(591, '11', 'Udit Narayan contact related to post(I want to sale 2 bhk property)', 54, 167, NULL, '1', 863, 3, 853, 4, '2024-01-09 10:15:00', '2024-01-09 16:15:00', '1'),
(592, '13', 'Udit Narayan select you for post (I want to sale 2 bhk property)', 167, 853, 167, '1', 863, 3, 853, 4, '2024-01-09 16:15:02', '2024-01-09 16:15:02', '1'),
(593, '6', 'Anu Anu just joined you on Messag!', 51, 164, NULL, '1', 861, 2, 860, 4, '2024-01-11 23:11:09', '2024-01-11 23:11:09', '1'),
(594, '11', 'Anu Anu contact related to post(Ultimate Noise-Canceling Headphones for Pure Musical Bliss)', 55, 164, NULL, '1', 861, 2, 860, 4, '2024-01-11 17:11:09', '2024-01-11 23:11:09', '1'),
(595, '7', 'Anu Anu send a message: Hi', 295, 51, NULL, '1', 861, 2, 860, 4, '2024-01-11 23:11:14', '2024-01-11 23:11:14', '1'),
(596, '13', 'Anu Anu select you for post (Ultimate Noise-Canceling Headphones for Pure Musical Bliss)', 164, 860, 164, '1', 861, 2, 860, 4, '2024-01-11 23:12:40', '2024-01-11 23:12:40', '1'),
(597, '10', NULL, 0, NULL, NULL, '1', 548, 2, NULL, NULL, '2024-01-27 17:51:50', '2024-01-27 17:51:50', '1'),
(598, '7', ' send a message: Hi', 296, 1, NULL, '1', 550, 3, 550, 4, '2024-02-01 14:52:06', '2024-02-01 14:52:06', '1'),
(599, '7', ' send a message: Hi', 297, 1, NULL, '1', 550, 3, 550, 4, '2024-02-01 15:01:29', '2024-02-01 15:01:29', '1'),
(600, '6', 'test agent just joined you on Messag!', 52, 26, NULL, '1', 550, 4, 549, 4, '2024-02-04 22:49:43', '2024-02-04 22:49:43', '1'),
(601, '6', 'rehan anim just joined you on Messag!', 53, 174, NULL, '1', 876, 3, 879, 4, '2024-02-08 14:30:38', '2024-02-08 14:30:38', '1'),
(602, '11', 'rehan anim contact related to post(House Test)', 56, 174, NULL, '1', 876, 3, 879, 4, '2024-02-08 08:30:38', '2024-02-08 14:30:38', '1'),
(603, '13', 'rehan anim select you for post (House Test)', 174, 879, 174, '1', 876, 3, 879, 4, '2024-02-08 14:31:15', '2024-02-08 14:31:15', '1'),
(604, '12', 'rehan anim upload a new post(post 2)', 178, 879, NULL, '1', 876, 3, 879, 4, '2024-02-08 12:42:33', '2024-02-08 18:42:33', '1'),
(605, '6', 'rehan anim just joined you on Messag!', 54, 178, NULL, '1', 876, 3, 881, 4, '2024-02-08 18:43:24', '2024-02-08 18:43:24', '1'),
(606, '11', 'rehan anim contact related to post(post 2)', 57, 178, NULL, '1', 876, 3, 881, 4, '2024-02-08 12:43:24', '2024-02-08 18:43:24', '1'),
(607, '7', 'rehan anim send a message: hi', 298, 54, NULL, '1', 876, 3, 881, 4, '2024-02-08 18:43:29', '2024-02-08 18:43:29', '1'),
(608, '7', 'rehan anim send a message: hi', 299, 54, NULL, '1', 876, 3, 881, 4, '2024-02-08 18:43:42', '2024-02-08 18:43:42', '1'),
(609, '13', 'rehan anim select you for post (post 2)', 178, 881, 178, '1', 876, 3, 881, 4, '2024-02-08 18:44:13', '2024-02-08 18:44:13', '1'),
(610, '12', 'rehan anim upload a new post(post 3)', 179, 881, NULL, '1', 876, 3, 881, 4, '2024-02-08 12:46:29', '2024-02-08 18:46:29', '1'),
(611, '12', 'rehan anim upload a new post(post 3)', 179, 879, NULL, '1', 876, 3, 879, 4, '2024-02-08 12:46:29', '2024-02-08 18:46:29', '1'),
(612, '11', 'rehan anim contact related to post(post 3)', 58, 179, NULL, '1', 876, 3, 878, 4, '2024-02-08 12:48:14', '2024-02-08 18:48:14', '1'),
(614, '4', 'rehan anim asked questions related to Selling Home', 92, 166, NULL, '1', 876, 3, 878, 4, '2024-02-08 12:48:20', '2024-02-08 18:48:20', '1'),
(615, '11', 'rehan anim contact related to post(post 3)', 59, 179, NULL, '1', 876, 3, 879, 4, '2024-02-08 12:51:02', '2024-02-08 18:51:02', '1'),
(616, '11', 'rehan anim contact related to post(Test Ish)', 60, 177, NULL, '1', 876, 2, 881, 4, '2024-02-08 12:53:09', '2024-02-08 18:53:09', '1'),
(617, '11', 'sell das contact related to post(asfasf)', 61, 180, NULL, '1', 882, 3, 865, 4, '2024-02-13 19:09:48', '2024-02-14 01:09:48', '1'),
(618, '10', NULL, 0, 52, NULL, '1', 884, 3, NULL, NULL, '2024-03-07 12:06:26', '2024-03-07 12:06:26', '1'),
(619, '10', NULL, 0, 9, NULL, '1', 884, 3, NULL, NULL, '2024-03-07 12:06:45', '2024-03-07 12:06:45', '1'),
(620, '11', 'Virali Shah contact related to post(Test2)', 62, 193, NULL, '1', 896, 2, 891, 4, '2024-03-23 22:16:18', '2024-03-24 03:16:18', '1'),
(621, '6', 'Sankar Dey just joined you on Messag!', 55, 194, NULL, '1', 895, 3, 891, 4, '2024-03-26 13:29:10', '2024-03-26 13:29:10', '1'),
(622, '11', 'Sankar Dey contact related to post(Good House)', 63, 194, NULL, '1', 895, 3, 891, 4, '2024-03-26 08:29:10', '2024-03-26 13:29:10', '1'),
(623, '7', 'Sankar Dey send a message: Hi', 300, 55, NULL, '1', 895, 3, 891, 4, '2024-03-26 13:29:24', '2024-03-26 13:29:24', '1'),
(624, '11', 'Projjwal SENGUPTA contact related to post(new23)', 64, 200, NULL, '1', 904, 2, 905, 4, '2024-05-04 07:52:04', '2024-05-04 12:52:04', '1'),
(625, '6', 'Projjwal SENGUPTA just joined you on Messag!', 56, 200, NULL, '2', 904, 2, 905, 4, '2024-05-04 12:52:04', '2024-05-04 12:52:18', '1'),
(626, '7', 'Projjwal SENGUPTA send a message: hello', 301, 56, NULL, '2', 904, 2, 905, 4, '2024-05-04 12:52:11', '2024-05-04 12:52:20', '1'),
(627, '7', 'Test Kbtest send a message: hi', 302, 56, NULL, '2', 905, 4, 904, 2, '2024-05-04 12:52:47', '2024-05-04 12:52:59', '1'),
(628, '13', 'Projjwal SENGUPTA select you for post (new23)', 200, 905, 200, '1', 904, 2, 905, 4, '2024-05-04 12:53:17', '2024-05-04 12:53:17', '1'),
(629, '12', 'Projjwal SENGUPTA upload a new post(property 1)', 201, 905, NULL, '1', 904, 2, 905, 4, '2024-05-04 07:56:09', '2024-05-04 12:56:09', '1'),
(630, '11', 'Projjwal SENGUPTA contact related to post(property 1)', 65, 201, NULL, '1', 904, 2, 905, 4, '2024-05-04 07:56:59', '2024-05-04 12:56:59', '1'),
(631, '13', 'Projjwal SENGUPTA select you for post (property 1)', 201, 905, 201, '1', 904, 2, 905, 4, '2024-05-04 12:57:02', '2024-05-04 12:57:02', '1'),
(633, '10', 'Test Kbtest replied ( hi done ). your question ( how are you ? )', 0, 168, NULL, '2', 905, 4, 904, 2, '2024-05-04 13:00:12', '2024-05-04 13:00:17', '1'),
(634, '4', 'Projjwal SENGUPTA asked questions related to Buying Home', 94, 168, NULL, '2', 904, 2, 905, 4, '2024-05-04 08:00:42', '2024-05-04 18:07:33', '1'),
(635, '10', 'Test Kbtest replied ( hi done ). your question ( how are you ? )', NULL, 168, NULL, '1', 905, 4, 904, 2, '2024-05-04 18:07:44', '2024-05-04 18:07:44', '1'),
(636, '10', 'Test Kbtest replied ( hi done test ). your question ( how are you ? )', NULL, 168, NULL, '1', 905, 4, 904, 2, '2024-05-04 18:08:00', '2024-05-04 18:08:00', '1'),
(637, '11', 'test seller contact related to post(Test Sell)', 66, 202, NULL, '1', 906, 3, 905, 4, '2024-05-04 13:17:08', '2024-05-04 18:17:08', '1'),
(638, '13', 'test seller select you for post (Test Sell)', 202, 905, 202, '1', 906, 3, 905, 4, '2024-05-04 18:17:11', '2024-05-04 18:17:11', '1'),
(639, '6', 'Harry Singh just joined you on Messag!', 57, 203, NULL, '1', 907, 2, 899, 4, '2024-05-16 09:32:20', '2024-05-16 09:32:20', '1'),
(640, '11', 'Harry Singh contact related to post(Testing)', 67, 203, NULL, '1', 907, 2, 899, 4, '2024-05-16 04:32:20', '2024-05-16 09:32:20', '1');

-- --------------------------------------------------------

--
-- Table structure for table `agents_notification_type`
--

CREATE TABLE `agents_notification_type` (
  `type_id` int NOT NULL,
  `title` text NOT NULL,
  `slug` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=active,1=inactive',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `agents_package`
--

CREATE TABLE `agents_package` (
  `package_id` int NOT NULL,
  `title` varchar(155) NOT NULL,
  `details` mediumtext NOT NULL,
  `package_type` varchar(55) NOT NULL,
  `price` float(10,2) NOT NULL,
  `type` enum('HORIZONTAL','SQUARE') NOT NULL,
  `image` tinyint(1) NOT NULL,
  `content` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `agents_payment`
--

CREATE TABLE `agents_payment` (
  `payment_id` int NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `discount` decimal(11,2) NOT NULL,
  `taxes` decimal(11,2) NOT NULL,
  `payment` varchar(250) DEFAULT NULL,
  `post_id` varchar(240) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `stripe_id` varchar(250) DEFAULT NULL,
  `transaction_id` varchar(250) DEFAULT NULL,
  `stripe_order_no` varchar(255) DEFAULT NULL,
  `stripeToken` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_payment`
--

INSERT INTO `agents_payment` (`payment_id`, `amount`, `discount`, `taxes`, `payment`, `post_id`, `user_id`, `stripe_id`, `transaction_id`, `stripe_order_no`, `stripeToken`, `created_at`, `updated_at`) VALUES
(1, '0.00', '0.00', '0.00', 'Stripe', '20', 550, NULL, '15376043742055032151', '', NULL, '2022-09-18 15:19:34', '2022-09-18 15:19:34'),
(2, '0.06', '0.00', '0.00', 'Stripe', NULL, 550, NULL, NULL, NULL, 'tok_1LluXgGmB1eN3uZAw1lBdQUc', '2022-09-25 13:06:47', '2022-09-25 13:06:47'),
(3, '6.00', '0.00', '0.00', 'Stripe', NULL, 550, NULL, 'txn_1LlubbGmB1eN3uZAHeMRXHwG', 'ch_1LlubaGmB1eN3uZAZ4TpXQKd', 'tok_1LlubZGmB1eN3uZAkPYt20d8', '2022-09-25 13:10:47', '2022-09-25 08:10:48'),
(4, '6.00', '0.00', '0.00', 'Stripe', NULL, 550, NULL, NULL, NULL, 'tok_1LlubZGmB1eN3uZAkPYt20d8', '2022-09-25 13:11:45', '2022-09-25 13:11:45'),
(5, '6.00', '0.00', '0.00', 'Stripe', NULL, 550, NULL, 'txn_1Llud7GmB1eN3uZAkQeTEpNh', 'ch_1Llud6GmB1eN3uZA0IH9ZNoX', 'tok_1Llud2GmB1eN3uZAtidYlJJl', '2022-09-25 13:12:17', '2022-09-25 08:12:22'),
(6, '60.00', '0.00', '0.00', 'Stripe', NULL, 550, NULL, 'txn_1LmiMWGmB1eN3uZAJVsinisP', 'ch_1LmiMVGmB1eN3uZA5wWVIbRp', 'tok_1LmiMNGmB1eN3uZAcPgGU32k', '2022-09-27 18:18:23', '2022-09-27 13:18:32'),
(7, '0.09', '0.00', '0.00', 'Stripe', NULL, 550, NULL, NULL, NULL, 'tok_1LmiNbGmB1eN3uZAQtHAskdM', '2022-09-27 18:19:39', '2022-09-27 18:19:39'),
(8, '0.00', '0.00', '0.00', 'Stripe', '25', 549, NULL, '18847627572554951244', '', NULL, '2022-09-29 16:12:37', '2022-09-29 16:12:37'),
(9, '0.00', '0.00', '0.00', 'Stripe', '23', 549, NULL, '18847629112354970521', '', NULL, '2022-09-29 16:15:11', '2022-09-29 16:15:11'),
(10, '0.00', '0.00', '0.00', 'Stripe', '24', 549, NULL, '18847657612454923193', '', NULL, '2022-09-29 17:02:41', '2022-09-29 17:02:41'),
(11, '9.60', '0.00', '0.00', 'Stripe', NULL, 550, NULL, 'txn_1Lz4dAGmB1eN3uZAeJVn6QaY', 'ch_1Lz4d9GmB1eN3uZA9WNq3gVu', 'tok_1Lz4d8GmB1eN3uZANo0OQTWo', '2022-10-31 20:30:45', '2022-10-31 15:30:46'),
(12, '0.00', '0.00', '0.00', 'Stripe', '35', 625, NULL, '16401563573562525384', '', NULL, '2022-12-21 12:59:17', '2022-12-21 12:59:17'),
(13, '0.00', '0.00', '0.00', 'Stripe', '52', 672, NULL, '18294611375267248098', '', NULL, '2022-12-27 13:38:57', '2022-12-27 13:38:57'),
(14, '0.00', '0.00', '0.00', 'Stripe', NULL, 550, NULL, NULL, NULL, 'tok_1Mg9kZGmB1eN3uZAXUT2EYfG', '2023-02-27 16:40:32', '2023-02-27 16:40:32'),
(15, '0.00', '0.00', '0.00', 'Stripe', NULL, 550, NULL, NULL, NULL, 'tok_1Mg9nXGmB1eN3uZAKIlF2g18', '2023-02-27 16:43:36', '2023-02-27 16:43:36'),
(16, '0.00', '0.00', '0.00', 'Stripe', NULL, 550, NULL, NULL, NULL, 'tok_1Mg9sLGmB1eN3uZAfJQFklta', '2023-02-27 16:48:34', '2023-02-27 16:48:34'),
(17, '360.00', '0.00', '0.00', 'Stripe', NULL, 550, NULL, NULL, NULL, 'tok_1MgA4aGmB1eN3uZAjnz7MLmP', '2023-02-27 17:01:13', '2023-02-27 17:01:13'),
(18, '0.00', '0.00', '0.00', 'Stripe', NULL, 550, NULL, NULL, NULL, 'tok_1MgDatGmB1eN3uZAbLJUQ5QK', '2023-02-27 20:46:48', '2023-02-27 20:46:48'),
(19, '0.00', '0.00', '0.00', 'Stripe', NULL, 550, NULL, NULL, NULL, 'tok_1MgDbyGmB1eN3uZAPTMkX7n9', '2023-02-27 20:47:55', '2023-02-27 20:47:55'),
(20, '0.00', '0.00', '0.00', 'Stripe', NULL, 550, NULL, NULL, NULL, 'tok_1MgDfSGmB1eN3uZAhEk3xNut', '2023-02-27 20:51:30', '2023-02-27 20:51:30'),
(21, '0.00', '0.00', '0.00', 'Stripe', NULL, 550, NULL, NULL, NULL, 'tok_1MgDpAGmB1eN3uZABr44yWr3', '2023-02-27 21:01:32', '2023-02-27 21:01:32'),
(22, '0.09', '0.00', '0.00', 'Stripe', NULL, 550, NULL, NULL, NULL, 'tok_1MgF7GGmB1eN3uZAfonmPCqX', '2023-02-27 22:24:19', '2023-02-27 22:24:19'),
(23, '0.09', '0.00', '0.00', 'Stripe', NULL, 550, NULL, NULL, NULL, 'tok_1MgF7HGmB1eN3uZATzVKwIi2', '2023-02-27 22:24:19', '2023-02-27 22:24:19'),
(24, '0.09', '0.00', '0.00', 'Stripe', NULL, 550, NULL, NULL, NULL, 'tok_1MgF9hGmB1eN3uZA6wLZBsr1', '2023-02-27 22:26:50', '2023-02-27 22:26:50'),
(25, '0.09', '0.00', '0.00', 'Stripe', NULL, 550, NULL, NULL, NULL, 'tok_1MgFAQGmB1eN3uZAZZXfTCwW', '2023-02-27 22:27:35', '2023-02-27 22:27:35'),
(26, '690.09', '0.00', '0.00', 'Stripe', NULL, 550, NULL, NULL, NULL, 'tok_1MgFgyGmB1eN3uZAvkOMJPiz', '2023-02-27 23:01:13', '2023-02-27 23:01:13'),
(27, '0.00', '0.00', '0.00', 'Stripe', '118', 769, NULL, '145871206611876995122', '', NULL, '2023-03-16 10:47:46', '2023-03-16 10:47:46'),
(28, '0.00', '0.00', '0.00', 'Stripe', '153', 842, NULL, '103008830715384276897', '', NULL, '2023-08-02 12:38:27', '2023-08-02 12:38:27'),
(29, '0.00', '0.00', '0.00', 'Stripe', '111', 670, NULL, '121949367811167041049', '', NULL, '2023-08-08 17:14:38', '2023-08-08 17:14:38'),
(30, '3.60', '0.00', '0.00', 'Stripe', NULL, 670, NULL, NULL, NULL, 'tok_1NdYJEGmB1eN3uZAv972SNKj', '2023-08-10 12:49:49', '2023-08-10 12:49:49'),
(31, '3.60', '0.00', '0.00', 'Stripe', NULL, 670, NULL, NULL, NULL, 'tok_1NdYUrGmB1eN3uZADEvVLDi4', '2023-08-10 13:01:50', '2023-08-10 13:01:50'),
(32, '3.60', '0.00', '0.00', 'Stripe', NULL, 670, NULL, NULL, NULL, 'tok_1NgR5qGmB1eN3uZACDWJLxyZ', '2023-08-18 11:43:55', '2023-08-18 11:43:55'),
(33, '3.60', '0.00', '0.00', 'Stripe', NULL, 670, NULL, NULL, NULL, 'tok_1NgR6bGmB1eN3uZAbeIZIyiB', '2023-08-18 11:44:41', '2023-08-18 11:44:41'),
(34, '3.60', '0.00', '0.00', 'Stripe', NULL, 670, NULL, NULL, NULL, 'tok_1NgR85GmB1eN3uZAJ62dJQQD', '2023-08-18 11:47:05', '2023-08-18 11:47:05'),
(35, '3.60', '0.00', '0.00', 'Stripe', NULL, 670, NULL, NULL, NULL, 'tok_1NgRDHGmB1eN3uZApgWlGPj5', '2023-08-18 11:51:36', '2023-08-18 11:51:36'),
(36, '3.60', '0.00', '0.00', 'Stripe', NULL, 670, NULL, NULL, NULL, 'tok_1NgRGNGmB1eN3uZA9zBhl9iO', '2023-08-18 11:54:48', '2023-08-18 11:54:48'),
(37, '3.60', '0.00', '0.00', 'Stripe', NULL, 670, NULL, NULL, NULL, 'tok_1NgRGNGmB1eN3uZA9zBhl9iO', '2023-08-18 12:01:24', '2023-08-18 12:01:24'),
(38, '3.60', '0.00', '0.00', 'Stripe', NULL, 670, NULL, NULL, NULL, 'tok_1NgRGNGmB1eN3uZA9zBhl9iO', '2023-08-18 12:02:40', '2023-08-18 12:02:40'),
(39, '3.60', '0.00', '0.00', 'Stripe', NULL, 670, NULL, NULL, NULL, 'tok_1NgRGNGmB1eN3uZA9zBhl9iO', '2023-08-18 12:03:03', '2023-08-18 12:03:03'),
(40, '3.60', '0.00', '0.00', 'Stripe', NULL, 670, NULL, NULL, NULL, 'tok_1NgRGNGmB1eN3uZA9zBhl9iO', '2023-08-18 12:18:52', '2023-08-18 12:18:52'),
(41, '3.60', '0.00', '0.00', 'Stripe', NULL, 670, NULL, NULL, NULL, 'tok_1NgRGNGmB1eN3uZA9zBhl9iO', '2023-08-18 12:20:22', '2023-08-18 12:20:22'),
(42, '3.60', '0.00', '0.00', 'Stripe', NULL, 670, NULL, NULL, NULL, 'tok_1Ngh8eGmB1eN3uZA5ymUk3Jq', '2023-08-19 04:51:52', '2023-08-19 04:51:52'),
(43, '0.00', '0.00', '0.00', 'Stripe', '162', 860, NULL, '139054416716286049604', '', NULL, '2024-01-14 12:16:07', '2024-01-14 12:16:07'),
(44, '0.00', '0.00', '0.00', 'Stripe', '178', 881, NULL, '120385780417888173845', '', NULL, '2024-02-08 18:56:44', '2024-02-08 18:56:44');

-- --------------------------------------------------------

--
-- Table structure for table `agents_posts`
--

CREATE TABLE `agents_posts` (
  `post_id` int NOT NULL,
  `agents_user_id` int NOT NULL,
  `agents_users_role_id` int NOT NULL,
  `posttitle` text,
  `details` longtext COMMENT 'buyer,seller',
  `address1` varchar(100) DEFAULT NULL COMMENT 'seller',
  `address2` varchar(100) DEFAULT NULL COMMENT 'seller',
  `city` int DEFAULT NULL COMMENT 'buyer,seller',
  `state` int DEFAULT '0' COMMENT 'buyer,seller',
  `status` int NOT NULL DEFAULT '1',
  `area` varchar(250) DEFAULT NULL COMMENT 'buyer',
  `zip` varchar(100) DEFAULT NULL COMMENT 'seller',
  `when_do_you_want_to_sell` varchar(50) DEFAULT NULL COMMENT 'buyer,seller, = now , within 30days , within 90 days , undecided',
  `need_Cash_back` enum('0','1') DEFAULT NULL COMMENT 'buyer,seller 0=no,1=yes',
  `interested_short_sale` enum('0','1') DEFAULT NULL COMMENT 'seller 0=no,1=yes',
  `got_lender_approval_for_short_sale` enum('0','1') DEFAULT NULL COMMENT 'seller 0=no,1=yes',
  `home_type` varchar(50) DEFAULT NULL COMMENT 'buyer,seller Single Family,    Condo/Townhome,    Multi Family,    Manufactured,    Lots/Land',
  `best_features` longtext COMMENT 'seller',
  `price_range` varchar(50) DEFAULT NULL COMMENT 'buyer',
  `firsttime_home_buyer` int DEFAULT NULL COMMENT 'buyer',
  `do_u_have_a_home_to_sell` int DEFAULT NULL COMMENT 'buyer',
  `if_so_do_you_need_help_selling` int DEFAULT NULL COMMENT 'buyer',
  `interested_in_buying` int DEFAULT NULL COMMENT 'buyer',
  `bids_emailed` varchar(50) DEFAULT NULL COMMENT 'buyer',
  `do_you_need_financing` varchar(50) DEFAULT NULL COMMENT 'buyer',
  `is_deleted` enum('0','1') DEFAULT '0' COMMENT '0=no,1=yes',
  `applied_post` enum('1','2') NOT NULL DEFAULT '2' COMMENT '1=yes,2=no',
  `applied_user_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `post_type` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `agent_select_date` datetime DEFAULT NULL,
  `agent_send_review` enum('1','2') NOT NULL DEFAULT '2',
  `buyer_seller_send_review` enum('1','2') NOT NULL DEFAULT '2',
  `mark_complete` enum('1','2') NOT NULL DEFAULT '2',
  `closing_date` datetime DEFAULT NULL,
  `agent_payment` varchar(50) DEFAULT NULL,
  `final_status` int NOT NULL DEFAULT '0' COMMENT '0="Pending", 1="in-progress",2="closed"',
  `cron_time` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_posts`
--

INSERT INTO `agents_posts` (`post_id`, `agents_user_id`, `agents_users_role_id`, `posttitle`, `details`, `address1`, `address2`, `city`, `state`, `status`, `area`, `zip`, `when_do_you_want_to_sell`, `need_Cash_back`, `interested_short_sale`, `got_lender_approval_for_short_sale`, `home_type`, `best_features`, `price_range`, `firsttime_home_buyer`, `do_u_have_a_home_to_sell`, `if_so_do_you_need_help_selling`, `interested_in_buying`, `bids_emailed`, `do_you_need_financing`, `is_deleted`, `applied_post`, `applied_user_id`, `created_at`, `post_type`, `updated_at`, `agent_select_date`, `agent_send_review`, `buyer_seller_send_review`, `mark_complete`, `closing_date`, `agent_payment`, `final_status`, `cron_time`) VALUES
(1, 518, 3, 'Test Title', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-08-10 03:59:35', NULL, '2022-08-10 03:59:35', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(2, 519, 3, 'Post Test', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-08-10 05:46:54', NULL, '2022-08-10 05:46:54', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(3, 520, 2, 'Buyer Folly', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-08-10 06:17:38', NULL, '2022-08-10 06:17:38', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(4, 521, 2, 'Florance Buyer', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-08-10 10:38:02', NULL, '2022-08-10 10:38:02', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(5, 524, 3, 'TestingPoosottts', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-08-15 13:32:59', NULL, '2022-08-15 13:32:59', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(6, 531, 3, 'Krunal Seller', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-08-15 13:18:58', NULL, '2022-08-15 13:18:58', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(7, 532, 2, 'Krunal Buyer', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-08-15 13:36:01', NULL, '2022-08-15 13:36:01', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(8, 517, 3, 'Test', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(9, 535, 3, 'Test Post', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-08-17 11:24:23', NULL, '2022-08-17 11:24:23', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(10, 536, 2, 'i want to byu', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-08-17 12:28:07', NULL, '2022-08-17 12:28:07', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(11, 540, 3, 'Seller Post', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-08-22 02:19:38', NULL, '2022-08-22 02:19:38', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(12, 541, 2, 'Buyer Post', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-08-22 02:25:46', NULL, '2022-08-22 02:25:46', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(13, 546, 3, 'A brand new house', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-09-04 04:22:30', NULL, '2022-09-04 04:22:30', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(14, 547, 3, 'oknyc post', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-09-04 04:30:48', NULL, '2022-09-04 04:30:48', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(17, 548, 2, 'oknyc post', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(18, 549, 3, 'I wan to sell brand new home', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 550, NULL, NULL, '2022-09-17 20:40:56', '2022-09-17 20:40:56', '2', '2', '2', NULL, NULL, 1, '2022-09-17 20:40:56'),
(19, 549, 3, 'One old house', '<p><br></p>', 'aaaa', 'bbbbbb', 4, 2, 1, NULL, '32113', 'now', '0', '0', NULL, 'single_family', '{\"best_features_1\":\"Secure Gated subdivisiondd\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 550, '2022-09-17 22:32:51', 3, '2022-09-17 22:33:46', '2022-09-17 22:33:46', '2', '2', '2', NULL, NULL, 1, '2022-09-17 22:33:46'),
(20, 549, 3, 'Illo doloremque quid', '<p>abc kithy gai&nbsp; c</p><p><br></p>', '18 Cowley Road', 'Earum consequatur M', 8, 7, 1, NULL, '59096', 'now', '1', '1', '0', 'lots_land', '{\"best_features_1\":\"Voluptas adipisicing\",\"best_features_2\":\"Voluptatum dolores s\",\"best_features_3\":\"Ab ullam Nam animi\",\"best_features_4\":\"Fuga Sunt eveniet\",\"best_features_5\":\"Libero enim aspernat\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 550, '2022-09-18 18:34:18', 3, '2022-09-18 20:19:34', '2022-09-18 20:14:18', '2', '2', '2', '2022-09-18 00:00:00', NULL, 1, '2022-09-18 20:14:18'),
(21, 549, 3, 'Expedita deserunt am', 'weregfddf', '707 Milton Parkway', 'Illum in consequatu', 4, 2, 1, NULL, '53022', 'now', '0', '1', '1', 'condo_townhome', '{\"best_features_1\":\"Mollitia non vel ill\",\"best_features_2\":\"Lorem doloremque mag\",\"best_features_3\":\"Nihil dolor ab sint\",\"best_features_4\":\"Elit voluptatem vel\",\"best_features_5\":\"Vitae Nam quibusdam\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 550, '2022-09-18 20:40:59', 3, '2022-09-18 20:43:56', '2022-09-18 20:43:56', '2', '2', '2', NULL, NULL, 1, '2022-09-18 20:43:56'),
(22, 517, 2, 'Excepturi odio excep', 'pokookd', '53 South First Freeway', 'Quo harum tempora ip', 5, 2, 1, NULL, '12606', 'now', '0', '1', '0', 'single_family', '{\"best_features_1\":\"Excepteur earum minu\",\"best_features_2\":\"Hic aliqua Consequa\",\"best_features_3\":\"Mollit sapiente libe\",\"best_features_4\":\"Enim ex in inventore\",\"best_features_5\":\"Aut rem voluptas qui\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 550, '2022-09-18 21:05:08', 3, '2024-02-02 16:00:46', '2022-09-18 21:07:36', '2', '2', '2', NULL, NULL, 1, '2022-09-18 21:07:36'),
(23, 517, 3, 'Commodi nulla et ven', 'fdfdf', '699 North Clarendon Extension', 'Dolorum tenetur sunt', 6, 3, 1, NULL, '28404', 'now', '0', '1', '1', 'single_family', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 550, '2022-09-18 21:26:51', 3, '2024-02-02 17:51:48', '2022-09-18 21:37:13', '2', '2', '2', '2022-09-29 00:00:00', NULL, 1, '2022-09-18 21:37:13'),
(24, 549, 3, 'Labore voluptatibus', 'sdsd', '419 South Nobel Freeway', 'Eos nobis doloremque', 6, 3, 1, NULL, '27685', 'now', '0', '0', NULL, 'multi_family', '{\"best_features_1\":\"Sit et enim nostrud\",\"best_features_2\":\"Soluta laboris id si\",\"best_features_3\":\"Est ex neque aliqua\",\"best_features_4\":\"Quod sunt exercitati\",\"best_features_5\":\"Ipsum numquam qui di\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 550, '2022-09-18 21:39:34', 3, '2022-09-29 22:02:41', '2022-09-18 22:25:17', '2', '2', '2', '2022-09-29 00:00:00', NULL, 1, '2022-09-18 22:25:17'),
(25, 549, 3, 'Molestias et in volu', 'ewew', '34 Nobel Road', 'Architecto voluptate', 6, 3, 1, NULL, '51271', 'now', '1', '0', NULL, 'condo_townhome', '{\"best_features_1\":\"Atque in necessitati\",\"best_features_2\":\"Aliquam aliqua Magn\",\"best_features_3\":\"Enim aspernatur volu\",\"best_features_4\":\"Cumque nihil quia en\",\"best_features_5\":\"Minim qui magna quib\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 550, '2022-09-19 03:47:50', 3, '2022-09-29 21:12:37', '2022-09-19 03:59:11', '2', '2', '2', '2022-09-29 00:00:00', NULL, 1, '2022-09-19 03:59:11'),
(26, 549, 3, 'last post', 'ew', '707 Milton Parkway', 'Illum in consequatu', 5, 2, 1, NULL, '32233', 'now', '0', '0', NULL, 'single_family', '{\"best_features_1\":\"Secure Gated subdivision\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 550, '2022-09-29 21:24:22', 3, '2022-11-07 19:24:30', '2022-09-29 21:25:32', '2', '2', '1', '2022-11-07 19:24:30', '100', 1, '2022-09-29 21:25:32'),
(27, 551, 2, 'my first post', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-10-02 11:23:46', NULL, '2022-10-02 11:23:46', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(28, 573, 3, 'new postttttttt', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-11-19 22:23:07', NULL, '2022-11-19 22:23:07', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(29, 598, 2, 'Byer', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-11-23 07:40:14', NULL, '2022-11-23 07:40:14', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(30, 609, 2, 'Palwal', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-11-25 07:15:14', NULL, '2022-11-25 07:15:14', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(31, 611, 3, 'panipat', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-11-25 09:01:26', NULL, '2022-11-25 09:01:26', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(32, 614, 3, 'palwalgu', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-11-25 10:42:37', NULL, '2022-11-25 10:42:37', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(33, 651, 2, 'Providing the features', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(34, 646, 2, 'Buy A property', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(35, 645, 3, 'Property Sell', 'need to sell the property', '702 Main St', NULL, 4, 2, 1, NULL, '29170', 'now', '1', '1', NULL, 'lots_land', '{\"best_features_1\":\"Secure Gated subdivision\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 625, NULL, 3, '2022-12-21 06:59:17', '2022-12-08 13:47:36', '2', '2', '2', '2022-12-21 00:00:00', NULL, 1, '2022-12-08 13:47:36'),
(36, 655, 3, 'Selling Duplex house', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-12-09 12:37:16', NULL, '2022-12-09 12:37:16', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(37, 656, 3, 'Selling Duplex house 1', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 550, '2022-12-12 05:16:00', NULL, '2022-12-12 05:37:53', '2022-12-12 05:37:53', '2', '2', '2', NULL, NULL, 1, '2022-12-12 05:37:53'),
(38, 656, 3, 'mmm', 'mmm', 'mm', NULL, 6, 3, 1, NULL, '99899', 'now', '0', '1', '1', 'manufactured', '{\"best_features_1\":\"Secure Gated subdivision\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-12-12 05:33:03', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(39, 656, 2, 'nhnn', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(40, 657, 2, 'Interested in Buying Duplex house', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-12-12 12:20:20', NULL, '2022-12-12 12:20:20', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(41, 658, 2, 'Interested in Buying a duplex house', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-12-12 12:22:33', NULL, '2022-12-12 12:22:33', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(42, 650, 2, 'Buying a flat', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(43, 646, 2, 'Buying a property for sell', 'I need to buy a property', NULL, NULL, 4, 2, 1, 'Burlington', '41001,14102,13642,10160,10013', 'undecided', '0', NULL, NULL, 'lots_land', NULL, '75-150', 1, 0, 0, 1, NULL, NULL, '0', '2', NULL, '2022-12-18 08:01:31', 2, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(44, 645, 2, 'For GRAYSON', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(45, 666, 3, 'Gray down works', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-12-21 07:57:30', NULL, '2022-12-21 07:57:30', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(46, 666, 3, 'HOW FAST CAN YOU SELL ? 3 DAYS OR LESS', '<span style=\"color: rgb(66, 78, 90); font-family: Poppins; font-size: 14px;\">Are you facing difficulties buying or selling your properties? Are you looking for the best agents to help you with the process? 92 Agents is here for you.</span>', 'N56w15475 Silver Spring Dr', 'N56w15475 Silver Spring Dr', 6, 3, 1, NULL, '53051', 'within 30 days', '1', NULL, NULL, 'single_family', '{\"best_features_1\":\"Secure Gated subdivision\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-12-21 08:06:19', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(47, 666, 2, 'Buy a property', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(48, 656, 3, 'This is post from Seller Smitha', '<h1 class=\"MuiTypography-root MuiTypography-h5 MuiTypography-colorPrimary\" style=\"margin-top: 0px; margin-bottom: 0px; font-size: 1.4993rem; font-family: &quot;Noto Sans&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; line-height: 1.334; color: rgb(0, 40, 150);\"><span style=\"font-weight: 700;\">Invite &amp; Earn</span></h1><div class=\"MuiBox-root jss630\" style=\"width: 895.333px; color: rgba(0, 0, 0, 0.87); font-family: &quot;Noto Sans&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 14px;\"><div class=\"MuiCollapse-container MuiCollapse-hidden\" style=\"height: 0px; overflow: hidden; transition: height 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms; visibility: hidden; min-height: 0px;\"><div class=\"MuiCollapse-wrapper\" style=\"display: flex;\"><div class=\"MuiCollapse-wrapperInner\" style=\"width: 895.333px;\"><div class=\"MuiBox-root jss631\" style=\"margin-top: 8px; margin-bottom: 8px;\"><div class=\"MuiBox-root jss632\" style=\"display: flex; align-items: center; font-weight: bold; flex-direction: column;\"><div class=\"MuiPaper-root MuiAlert-root MuiAlert-standardError jss387 MuiPaper-elevation0\" role=\"alert\" style=\"color: rgb(76, 0, 0); transition: box-shadow 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms; background-color: rgb(248, 229, 229); box-shadow: none; width: 895.333px; display: flex; padding: 6px 16px; font-size: 0.875rem; font-weight: 400; line-height: 1.43; border-radius: 4px;\"><div class=\"MuiAlert-icon\" style=\"display: flex; opacity: 0.9; padding: 7px 0px; font-size: 22px; margin-right: 12px; color: rgb(191, 0, 0);\"><svg class=\"MuiSvgIcon-root MuiSvgIcon-fontSizeInherit\" focusable=\"false\" viewBox=\"0 0 24 24\" aria-hidden=\"true\"><path d=\"M11 15h2v2h-2zm0-8h2v6h-2zm.99-5C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z\"></path></svg></div><div class=\"MuiAlert-message\" style=\"padding: 8px 0px;\"></div></div></div></div></div></div></div></div><div class=\"MuiBox-root jss633\" style=\"width: 895.333px; color: rgba(0, 0, 0, 0.87); font-family: &quot;Noto Sans&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 14px;\"><div class=\"MuiCollapse-container MuiCollapse-hidden\" style=\"height: 0px; overflow: hidden; transition: height 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms; visibility: hidden; min-height: 0px;\"><div class=\"MuiCollapse-wrapper\" style=\"display: flex;\"><div class=\"MuiCollapse-wrapperInner\" style=\"width: 895.333px;\"><div class=\"MuiBox-root jss634\" style=\"margin-top: 8px; margin-bottom: 8px;\"><div class=\"MuiBox-root jss635\" style=\"display: flex; align-items: center; font-weight: bold; flex-direction: column;\"><div class=\"MuiPaper-root MuiAlert-root MuiAlert-standardError jss387 MuiPaper-elevation0\" role=\"alert\" style=\"color: rgb(76, 0, 0); transition: box-shadow 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms; background-color: rgb(248, 229, 229); box-shadow: none; width: 895.333px; display: flex; padding: 6px 16px; font-size: 0.875rem; font-weight: 400; line-height: 1.43; border-radius: 4px;\"><div class=\"MuiAlert-icon\" style=\"display: flex; opacity: 0.9; padding: 7px 0px; font-size: 22px; margin-right: 12px; color: rgb(191, 0, 0);\"><svg class=\"MuiSvgIcon-root MuiSvgIcon-fontSizeInherit\" focusable=\"false\" viewBox=\"0 0 24 24\" aria-hidden=\"true\"><path d=\"M11 15h2v2h-2zm0-8h2v6h-2zm.99-5C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z\"></path></svg></div><div class=\"MuiAlert-message\" style=\"padding: 8px 0px;\"></div></div></div></div></div></div></div></div><div class=\"MuiBox-root jss636\" style=\"width: 895.333px; color: rgba(0, 0, 0, 0.87); font-family: &quot;Noto Sans&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 14px;\"><div class=\"MuiCollapse-container MuiCollapse-hidden\" style=\"height: 0px; overflow: hidden; transition: height 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms; visibility: hidden; min-height: 0px;\"><div class=\"MuiCollapse-wrapper\" style=\"display: flex;\"><div class=\"MuiCollapse-wrapperInner\" style=\"width: 895.333px;\"><div class=\"MuiBox-root jss637\" style=\"margin-top: 8px; margin-bottom: 8px;\"><div class=\"MuiBox-root jss638\" style=\"display: flex; align-items: center; font-weight: bold; flex-direction: column;\"><div class=\"MuiPaper-root MuiAlert-root MuiAlert-standardError jss387 MuiPaper-elevation0\" role=\"alert\" style=\"color: rgb(76, 0, 0); transition: box-shadow 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms; background-color: rgb(248, 229, 229); box-shadow: none; width: 895.333px; display: flex; padding: 6px 16px; font-size: 0.875rem; font-weight: 400; line-height: 1.43; border-radius: 4px;\"><div class=\"MuiAlert-icon\" style=\"display: flex; opacity: 0.9; padding: 7px 0px; font-size: 22px; margin-right: 12px; color: rgb(191, 0, 0);\"><svg class=\"MuiSvgIcon-root MuiSvgIcon-fontSizeInherit\" focusable=\"false\" viewBox=\"0 0 24 24\" aria-hidden=\"true\"><path d=\"M11 15h2v2h-2zm0-8h2v6h-2zm.99-5C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z\"></path></svg></div><div class=\"MuiAlert-message\" style=\"padding: 8px 0px;\"></div></div></div></div></div></div></div></div><div class=\"MuiBox-root jss639\" style=\"margin-top: 8px; margin-bottom: 24px; color: rgba(0, 0, 0, 0.87); font-family: &quot;Noto Sans&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 14px;\"><p class=\"MuiTypography-root MuiTypography-body1\" style=\"font-size: 1rem; line-height: 1.5;\">Earn bonus Points for inviting your friends!</p></div><div class=\"MuiBox-root jss640\" style=\"padding-left: 32px; padding-right: 32px; color: rgba(0, 0, 0, 0.87); font-family: &quot;Noto Sans&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 14px;\"><div class=\"MuiBox-root jss644\" style=\"padding-left: 24px; padding-right: 24px;\"><div class=\"MuiGrid-root MuiGrid-container\" style=\"width: 783.333px; display: flex; flex-wrap: wrap;\"><div class=\"MuiGrid-root jss641 MuiGrid-container MuiGrid-item MuiGrid-align-items-xs-center MuiGrid-justify-xs-center\" style=\"width: 783.333px; display: flex; flex-wrap: wrap; margin: 0px; align-items: center; justify-content: center;\"><div class=\"MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12 MuiGrid-grid-sm-6\" style=\"margin: 0px; flex-grow: 0; max-width: 50%; flex-basis: 50%;\"><div class=\"MuiBox-root jss645\" style=\"display: flex; padding: 16px; text-align: center; flex-direction: column;\"><div class=\"MuiBox-root jss646\" style=\"margin-bottom: 24px;\"><div class=\"MuiTypography-root jss643 MuiTypography-h6 MuiTypography-colorPrimary\" style=\"margin: 0px; font-size: 1.25rem; font-weight: 700; line-height: 1.6; color: rgb(0, 40, 150);\">Share your invitation link</div></div><div class=\"MuiTypography-root MuiTypography-body1\" style=\"margin: 0px; font-size: 1rem; line-height: 1.5;\">Copy and share your unique invitation with your friends, via chat or social media</div></div></div></div></div></div></div>', 'Door No y67', NULL, 4, 2, 1, NULL, '21388', 'now', '1', '1', '1', 'multi_family', '{\"best_features_1\":\"Secure Gated subdivision\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 550, '2022-12-26 07:03:33', 3, '2022-12-26 07:04:35', '2022-12-26 07:04:35', '2', '2', '2', NULL, NULL, 1, '2022-12-26 07:04:35');
INSERT INTO `agents_posts` (`post_id`, `agents_user_id`, `agents_users_role_id`, `posttitle`, `details`, `address1`, `address2`, `city`, `state`, `status`, `area`, `zip`, `when_do_you_want_to_sell`, `need_Cash_back`, `interested_short_sale`, `got_lender_approval_for_short_sale`, `home_type`, `best_features`, `price_range`, `firsttime_home_buyer`, `do_u_have_a_home_to_sell`, `if_so_do_you_need_help_selling`, `interested_in_buying`, `bids_emailed`, `do_you_need_financing`, `is_deleted`, `applied_post`, `applied_user_id`, `created_at`, `post_type`, `updated_at`, `agent_select_date`, `agent_send_review`, `buyer_seller_send_review`, `mark_complete`, `closing_date`, `agent_payment`, `final_status`, `cron_time`) VALUES
(49, 671, 3, 'Welcome Back Good news! Our algorithm found a new', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 670, '2022-12-27 06:32:51', NULL, '2022-12-27 08:08:20', '2022-12-27 08:08:20', '2', '2', '2', NULL, NULL, 1, '2022-12-27 08:08:20');
INSERT INTO `agents_posts` (`post_id`, `agents_user_id`, `agents_users_role_id`, `posttitle`, `details`, `address1`, `address2`, `city`, `state`, `status`, `area`, `zip`, `when_do_you_want_to_sell`, `need_Cash_back`, `interested_short_sale`, `got_lender_approval_for_short_sale`, `home_type`, `best_features`, `price_range`, `firsttime_home_buyer`, `do_u_have_a_home_to_sell`, `if_so_do_you_need_help_selling`, `interested_in_buying`, `bids_emailed`, `do_you_need_financing`, `is_deleted`, `applied_post`, `applied_user_id`, `created_at`, `post_type`, `updated_at`, `agent_select_date`, `agent_send_review`, `buyer_seller_send_review`, `mark_complete`, `closing_date`, `agent_payment`, `final_status`, `cron_time`) VALUES
(50, 671, 3, 'Post Title for Seller', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><h2 style=\"font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-feature-settings: revert; font-kerning: revert; font-optical-sizing: revert; font-palette: revert; font-size: revert; font-stretch: revert; font-synthesis: revert; font-variant-east-asian: revert; font-variant-numeric: revert; font-variation-settings: revert; forced-color-adjust: revert; text-orientation: revert; text-rendering: revert; -webkit-font-smoothing: revert; -webkit-locale: revert; -webkit-text-orientation: revert; -webkit-writing-mode: revert; writing-mode: revert; zoom: revert; accent-color: revert; place-content: revert; place-items: revert; place-self: revert; alignment-baseline: revert; animation: revert; app-region: revert; appearance: revert; aspect-ratio: revert; backdrop-filter: revert; backface-visibility: revert; background: revert; background-blend-mode: revert; baseline-shift: revert; block-size: revert; border-block: revert; border: revert; border-radius: revert; border-collapse: revert; border-end-end-radius: revert; border-end-start-radius: revert; border-inline: revert; border-start-end-radius: revert; border-start-start-radius: revert; inset: revert; box-shadow: revert; box-sizing: revert; break-after: revert; break-before: revert; break-inside: revert; buffered-rendering: revert; caption-side: revert; caret-color: revert; clear: revert; clip: revert; clip-path: revert; clip-rule: revert; color-interpolation: revert; color-interpolation-filters: revert; color-rendering: revert; color-scheme: revert; columns: revert; column-fill: revert; gap: revert; column-rule: revert; column-span: revert; contain: revert; contain-intrinsic-block-size: revert; contain-intrinsic-size: revert; contain-intrinsic-inline-size: revert; container: revert; content: revert; content-visibility: revert; counter-increment: revert; counter-reset: revert; counter-set: revert; cursor: revert; cx: revert; cy: revert; d: revert; display: revert; dominant-baseline: revert; empty-cells: revert; fill: revert; fill-opacity: revert; fill-rule: revert; filter: revert; flex: revert; flex-flow: revert; float: revert; flood-color: revert; flood-opacity: revert; grid: revert; grid-area: revert; height: revert; hyphenate-character: revert; hyphens: revert; image-orientation: revert; image-rendering: revert; inline-size: revert; inset-block: revert; inset-inline: revert; isolation: revert; lighting-color: revert; line-break: revert; line-height: 30px; list-style: revert; margin-block: revert; margin: revert; margin-inline: revert; marker: revert; mask: revert; mask-type: revert; max-block-size: revert; max-height: revert; max-inline-size: revert; max-width: revert; min-block-size: revert; min-height: revert; min-inline-size: revert; min-width: revert; mix-blend-mode: revert; object-fit: revert; object-position: revert; object-view-box: revert; offset: revert; opacity: revert; order: revert; outline: revert; outline-offset: revert; overflow-anchor: revert; overflow-clip-margin: revert; overflow-wrap: revert; overflow: revert; overscroll-behavior-block: revert; overscroll-behavior-inline: revert; overscroll-behavior: revert; padding-block: revert; padding: revert; padding-inline: revert; page: revert; page-orientation: revert; paint-order: revert; perspective: revert; perspective-origin: revert; pointer-events: revert; position: revert; quotes: revert; r: revert; resize: revert; rotate: revert; ruby-position: revert; rx: revert; ry: revert; scale: revert; scroll-behavior: revert; scroll-margin-block: revert; scroll-margin: revert; scroll-margin-inline: revert; scroll-padding-block: revert; scroll-padding: revert; scroll-padding-inline: revert; scroll-snap-align: revert; scroll-snap-stop: revert; scroll-snap-type: revert; scrollbar-gutter: revert; shape-image-threshold: revert; shape-margin: revert; shape-outside: revert; shape-rendering: revert; size: revert; speak: revert; stop-color: revert; stop-opacity: revert; stroke: revert; stroke-dasharray: revert; stroke-dashoffset: revert; stroke-linecap: revert; stroke-linejoin: revert; stroke-miterlimit: revert; stroke-opacity: revert; stroke-width: revert; tab-size: revert; table-layout: revert; text-align: revert; text-align-last: revert; text-anchor: revert; text-combine-upright: revert; text-decoration: revert; text-decoration-skip-ink: revert; text-emphasis: revert; text-emphasis-position: revert; text-overflow: revert; text-shadow: revert; text-size-adjust: revert; text-underline-offset: revert; text-underline-position: revert; touch-action: revert; transform: revert; transform-box: revert; transform-origin: revert; transform-style: revert; transition: revert; translate: revert; user-select: revert; vector-effect: revert; vertical-align: revert; visibility: revert; border-spacing: revert; -webkit-box-align: revert; -webkit-box-decoration-break: revert; -webkit-box-direction: revert; -webkit-box-flex: revert; -webkit-box-ordinal-group: revert; -webkit-box-orient: revert; -webkit-box-pack: revert; -webkit-box-reflect: revert; -webkit-highlight: revert; -webkit-line-break: revert; -webkit-line-clamp: revert; -webkit-mask-box-image: revert; -webkit-mask: revert; -webkit-mask-composite: revert; -webkit-print-color-adjust: revert; -webkit-rtl-ordering: revert; -webkit-ruby-position: revert; -webkit-tap-highlight-color: revert; -webkit-text-combine: revert; -webkit-text-decorations-in-effect: revert; -webkit-text-fill-color: revert; -webkit-text-security: revert; -webkit-text-stroke-color: revert; -webkit-user-drag: revert; -webkit-user-modify: revert; width: revert; will-change: revert; word-break: revert; x: revert; y: revert; z-index: revert;\"><b></b></h2><p style=\"color: rgb(55, 55, 55); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 17px; text-align: center;\"><b></b></p>', 'Hyd', 'sfsdf', 4, 2, 1, NULL, '12381', 'now', '1', '1', '1', 'condo_townhome', '{\"best_features_1\":\"Secure Gated subdivision\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 672, '2022-12-27 07:13:20', 3, '2022-12-27 07:18:19', '2022-12-27 07:18:19', '2', '2', '2', NULL, NULL, 1, '2022-12-27 07:18:19');
INSERT INTO `agents_posts` (`post_id`, `agents_user_id`, `agents_users_role_id`, `posttitle`, `details`, `address1`, `address2`, `city`, `state`, `status`, `area`, `zip`, `when_do_you_want_to_sell`, `need_Cash_back`, `interested_short_sale`, `got_lender_approval_for_short_sale`, `home_type`, `best_features`, `price_range`, `firsttime_home_buyer`, `do_u_have_a_home_to_sell`, `if_so_do_you_need_help_selling`, `interested_in_buying`, `bids_emailed`, `do_you_need_financing`, `is_deleted`, `applied_post`, `applied_user_id`, `created_at`, `post_type`, `updated_at`, `agent_select_date`, `agent_send_review`, `buyer_seller_send_review`, `mark_complete`, `closing_date`, `agent_payment`, `final_status`, `cron_time`) VALUES
(51, 671, 2, 'Buyer Post title', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL);
INSERT INTO `agents_posts` (`post_id`, `agents_user_id`, `agents_users_role_id`, `posttitle`, `details`, `address1`, `address2`, `city`, `state`, `status`, `area`, `zip`, `when_do_you_want_to_sell`, `need_Cash_back`, `interested_short_sale`, `got_lender_approval_for_short_sale`, `home_type`, `best_features`, `price_range`, `firsttime_home_buyer`, `do_u_have_a_home_to_sell`, `if_so_do_you_need_help_selling`, `interested_in_buying`, `bids_emailed`, `do_you_need_financing`, `is_deleted`, `applied_post`, `applied_user_id`, `created_at`, `post_type`, `updated_at`, `agent_select_date`, `agent_send_review`, `buyer_seller_send_review`, `mark_complete`, `closing_date`, `agent_payment`, `final_status`, `cron_time`) VALUES
(52, 671, 2, 'Test Post Title Buyer', '<p><b>Test Post&nbsp;&nbsp;&nbsp;&nbsp;</b></p>', NULL, NULL, 6, 3, 1, 'Kent', '12345,12349,12090,12301,12388', 'now', '0', NULL, NULL, 'single_family', NULL, '75', 0, 0, 0, 0, NULL, NULL, '0', '1', 672, '2022-12-27 07:27:20', 2, '2022-12-27 07:38:57', '2022-12-27 07:28:31', '2', '2', '2', '2022-12-27 00:00:00', NULL, 1, '2022-12-27 07:28:31');
INSERT INTO `agents_posts` (`post_id`, `agents_user_id`, `agents_users_role_id`, `posttitle`, `details`, `address1`, `address2`, `city`, `state`, `status`, `area`, `zip`, `when_do_you_want_to_sell`, `need_Cash_back`, `interested_short_sale`, `got_lender_approval_for_short_sale`, `home_type`, `best_features`, `price_range`, `firsttime_home_buyer`, `do_u_have_a_home_to_sell`, `if_so_do_you_need_help_selling`, `interested_in_buying`, `bids_emailed`, `do_you_need_financing`, `is_deleted`, `applied_post`, `applied_user_id`, `created_at`, `post_type`, `updated_at`, `agent_select_date`, `agent_send_review`, `buyer_seller_send_review`, `mark_complete`, `closing_date`, `agent_payment`, `final_status`, `cron_time`) VALUES
(53, 651, 2, 'https://dev.92agents.com/profile/buyer/posts .', '<p><a href=\"https://dev.92agents.com/profile/buyer/posts\">https://dev.92agents.com/profile/buyer/posts</a></p><p><a href=\"https://dev.92agents.com/profile/buyer/posts\">https://dev.92agents.com/profile/buyer/posts</a></p><p><a href=\"https://dev.92agents.com/profile/buyer/posts\">https://dev.92agents.com/profile/buyer/posts</a></p><p><a href=\"https://dev.92agents.com/profile/buyer/posts\">https://dev.92agents.com/profile/buyer/posts</a></p><p>https://dev.92agents.com/profile/buyer/posts<br></p>', NULL, NULL, 4, 2, 1, '11 Norbrik Dr, 11 Norbrik Dr, New South Wales,', '74656,95478,73524,87874,65635', 'within 30 days', '0', NULL, NULL, 'single_family', NULL, '75-150', 0, 0, 0, 0, 'As it arrives', '1', '0', '2', NULL, '2022-12-27 10:44:50', 2, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(54, 651, 3, 'Project land/Estate', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(55, 651, 3, 'agents team', '<span style=\"color: rgb(238, 238, 238); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; background-color: rgb(23, 33, 56);\">Address: Zippy Infotech inc30 N Gould st,</span><br style=\"color: rgb(238, 238, 238); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; background-color: rgb(23, 33, 56);\"><span style=\"color: rgb(238, 238, 238); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; background-color: rgb(23, 33, 56);\">Suite Rsheridn, WY, 82801 Sheridan</span><br style=\"color: rgb(238, 238, 238); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; background-color: rgb(23, 33, 56);\"><span style=\"color: rgb(238, 238, 238); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; background-color: rgb(23, 33, 56);\">Phone: (615)594-3903</span>', '11 Norbrik Dr, Sydney, New South Wales,', '11 Norbrik Dr, Sydney, New South Wales,', 4, 2, 1, NULL, '65639', 'within 30 days', '0', '0', NULL, 'condo_townhome', '{\"best_features_1\":\"Secure Gated subdivision\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\",\"best_features_5\":\"With big balkony\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-12-27 12:22:33', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(56, 645, 2, 'Email: Support@92agents.com', '<p><span style=\"color: rgb(238, 238, 238); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; background-color: rgb(23, 33, 56);\">Email:&nbsp;</span><a href=\"mailto:Support@92agents.com\" class=\"\" style=\"background-color: rgb(23, 33, 56); color: rgb(114, 192, 44); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\">Support@92agents.com</a></p><p><span style=\"color: rgb(238, 238, 238); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; background-color: rgb(23, 33, 56);\">Email:&nbsp;</span><a href=\"mailto:Support@92agents.com\" class=\"\" style=\"background-color: rgb(23, 33, 56); color: rgb(114, 192, 44); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\">Support@92agents.com</a></p><p><span style=\"color: rgb(238, 238, 238); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; background-color: rgb(23, 33, 56);\">Email:&nbsp;</span><a href=\"mailto:Support@92agents.com\" class=\"\" style=\"background-color: rgb(23, 33, 56); color: rgb(114, 192, 44); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\">Support@92agents.com</a></p><p><span style=\"color: rgb(238, 238, 238); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; background-color: rgb(23, 33, 56);\">Email:&nbsp;</span><a href=\"mailto:Support@92agents.com\" class=\"\" style=\"background-color: rgb(23, 33, 56); color: rgb(114, 192, 44); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\">Support@92agents.com</a></p><p><span style=\"color: rgb(238, 238, 238); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; background-color: rgb(23, 33, 56);\">Email:&nbsp;</span><a href=\"mailto:Support@92agents.com\" class=\"\" style=\"background-color: rgb(23, 33, 56); color: rgb(114, 192, 44); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\">Support@92agents.com</a></p><p>Nothing special&nbsp;<br><br><br><br><br></p>', NULL, NULL, 4, 2, 1, '5719 E Beck Ave City/Town	Fresno State/Province/Region	California Zip/Postal Code	93727', '65653,68765,25979,64521,68492', 'within 30 days', '0', NULL, NULL, 'condo_townhome', NULL, '75-150', 0, 0, 0, 0, 'As it arrives', '1', '0', '2', NULL, '2022-12-28 12:55:57', 2, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(57, 645, 3, 'Selling a waste cricket ground', '<table class=\"table\" style=\"width: 748px; margin-bottom: 20px; color: rgb(37, 42, 52); font-family: -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, &quot;PingFang SC&quot;, &quot;Microsoft YaHei&quot;, &quot;Source Han Sans SC&quot;, &quot;Noto Sans CJK SC&quot;, &quot;WenQuanYi Micro Hei&quot;, sans-serif; font-size: 16px; margin-top: 35px;\"><tbody><tr><td style=\"line-height: 1.42857; border-bottom: 1px solid rgb(219, 237, 243);\">5719 E Beck Ave</td></tr><tr><td style=\"line-height: 1.42857; border-bottom: 1px solid rgb(219, 237, 243);\">City/Town</td><td style=\"line-height: 1.42857; border-bottom: 1px solid rgb(219, 237, 243);\">Fresno</td></tr><tr><td style=\"line-height: 1.42857; border-bottom: 1px solid rgb(219, 237, 243);\">State/Province/Region</td><td style=\"line-height: 1.42857; border-bottom: 1px solid rgb(219, 237, 243);\">California</td></tr><tr><td style=\"line-height: 1.42857; border-bottom: 1px solid rgb(219, 237, 243);\">Zip/Postal Code</td><td style=\"line-height: 1.42857; border-bottom: 1px solid rgb(219, 237, 243);\"><p>93727</p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p>So here is addresss</p><p><br></p></td></tr></tbody></table>', '5719 E Beck Ave, Fresno, California, 93727', '5719 E Beck Ave, Fresno, California, 93727', 4, 2, 1, NULL, '93727', 'within 30 days', '0', '0', NULL, 'condo_townhome', '{\"best_features_1\":\"Secure Gated subdivision\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-12-28 13:02:41', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(58, 674, 3, 'abc', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2022-12-29 19:47:49', NULL, '2022-12-29 19:47:49', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(59, 675, 2, 'Madison.Leannon', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(60, 645, 2, 'Gersman services', 'Here , we are going to interduce our service to our regular costumors, who always support us&nbsp;', NULL, NULL, 4, 2, 1, 'Main St, Fiskerton, Nottinghamshire, NG25 0UL', '87576,93445,74758,93748,94757', 'within 30 days', '0', NULL, NULL, 'single_family', NULL, '75-150', 0, 0, 0, 0, 'As it arrives', '2', '0', '2', NULL, '2023-01-02 11:46:54', 2, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(61, 645, 2, 'our team is committed to creating the number one online platform and rendering impeccable services to both buyers, sellers, and agents. Making a difference in the real estate industry.', '<p><span style=\"color: rgb(238, 238, 238); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; text-align: justify; background-color: rgb(23, 33, 56);\">our team is committed to creating the number one online platform and rendering impeccable services to both buyers, sellers, and agents. Making a difference in the real estate industry.&nbsp;</span></p><hr><p><span style=\"color: rgb(238, 238, 238); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; text-align: justify; background-color: rgb(23, 33, 56);\">our team is committed to creating the number one online platform and rendering impeccable services to both buyers, sellers, and agents. Making a difference in the real estate industry.</span></p><hr><p><span style=\"color: rgb(238, 238, 238); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; text-align: justify; background-color: rgb(23, 33, 56);\">our team is committed to creating the number one online platform and rendering impeccable services to both buyers, sellers, and agents. Making a difference in the real estate industry.</span><span style=\"color: rgb(238, 238, 238); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; text-align: justify; background-color: rgb(23, 33, 56);\"><br></span><span style=\"color: rgb(238, 238, 238); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; text-align: justify; background-color: rgb(23, 33, 56);\"><br></span></p>', NULL, NULL, 8, 7, 1, '500 W Madison St #2,  Chicago,	Indiana,  60661', '56426,78542,75735,34214,53324', 'within 90 days', '0', NULL, NULL, 'multi_family', NULL, '400', 0, 0, 0, 0, 'Once a day', '1', '0', '2', 550, '2023-01-02 11:54:23', 2, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(62, 705, 3, 'Ready to sell Bungalow with all furnished items', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-01-09 06:03:10', NULL, '2023-01-09 06:03:10', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(63, 706, 2, 'Ready to Buy a House', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-01-09 06:28:50', NULL, '2023-01-09 06:28:50', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(64, 707, 2, 'Ready to Buy a house immediately', '<p style=\"margin-bottom: 20px; font-size: 14px; line-height: 24px; color: rgb(25, 23, 23); font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; text-align: center; background-color: rgb(235, 245, 248);\"><span class=\"head\" style=\"font-weight: 700; color: rgb(0, 72, 34);\">Structure</span><br>Pile foundation for durability and stability<br>Earthquake Resistant RCC Superstructure</p><p style=\"margin-bottom: 20px; font-size: 14px; line-height: 24px; color: rgb(25, 23, 23); font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; text-align: center; background-color: rgb(235, 245, 248);\"><span class=\"head\" style=\"font-weight: 700; color: rgb(0, 72, 34);\">Wall finish</span><br>Internal Walls - Putty / POP<br>External Walls - Weather shield paint and / or textured coating finish</p><p style=\"margin-bottom: 20px; font-size: 14px; line-height: 24px; color: rgb(25, 23, 23); font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; text-align: center; background-color: rgb(235, 245, 248);\"><span class=\"head\" style=\"font-weight: 700; color: rgb(0, 72, 34);\">Living/Dining</span><br>Flooring : Vitrified tile<br>Ceiling : Putty / POP</p><p style=\"margin-bottom: 20px; font-size: 14px; line-height: 24px; color: rgb(25, 23, 23); font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; text-align: center; background-color: rgb(235, 245, 248);\"><span class=\"head\" style=\"font-weight: 700; color: rgb(0, 72, 34);\">Bedrooms</span><br>Flooring : Vitrified tile<br>Walls : Putty / POP<br>Ceiling : Putty / POP</p>', NULL, NULL, 4, 2, 1, 'Kanpur', '12311,13456,23432,23445,34543', 'now', '1', NULL, NULL, 'lots_land', NULL, '400', 1, 1, 1, 1, 'Once a day', '20000', '0', '1', 670, '2023-01-09 06:31:19', 2, '2023-01-09 08:26:18', '2023-01-09 08:26:18', '2', '2', '2', NULL, NULL, 1, '2023-01-09 08:26:18');
INSERT INTO `agents_posts` (`post_id`, `agents_user_id`, `agents_users_role_id`, `posttitle`, `details`, `address1`, `address2`, `city`, `state`, `status`, `area`, `zip`, `when_do_you_want_to_sell`, `need_Cash_back`, `interested_short_sale`, `got_lender_approval_for_short_sale`, `home_type`, `best_features`, `price_range`, `firsttime_home_buyer`, `do_u_have_a_home_to_sell`, `if_so_do_you_need_help_selling`, `interested_in_buying`, `bids_emailed`, `do_you_need_financing`, `is_deleted`, `applied_post`, `applied_user_id`, `created_at`, `post_type`, `updated_at`, `agent_select_date`, `agent_send_review`, `buyer_seller_send_review`, `mark_complete`, `closing_date`, `agent_payment`, `final_status`, `cron_time`) VALUES
(65, 707, 2, 'Read to Buy a House', '<p style=\"margin-bottom: 20px; font-size: 14px; line-height: 24px; color: rgb(25, 23, 23); font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; text-align: center; background-color: rgb(232, 238, 235);\"><span class=\"head\" style=\"font-weight: 700; color: rgb(0, 72, 34);\">Master Bedrooms</span><br>Flooring : Vitrified tile<br>Walls : Putty / POP<br>Ceiling : Putty / POP</p><p style=\"margin-bottom: 20px; font-size: 14px; line-height: 24px; color: rgb(25, 23, 23); font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; text-align: center; background-color: rgb(232, 238, 235);\"><span class=\"head\" style=\"font-weight: 700; color: rgb(0, 72, 34);\">Balcony</span><br>Flooring : Anti Skid Tiles<br>Ceiling : Putty / POP<br>Walls : Putty / POP<br></p><p style=\"margin-bottom: 20px; font-size: 14px; line-height: 24px; color: rgb(25, 23, 23); font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; text-align: center; background-color: rgb(232, 238, 235);\"><span class=\"head\" style=\"font-weight: 700; color: rgb(0, 72, 34);\">Kitchen</span><br>Flooring : Anti Skid Tiles<br>Ceiling : Putty / POP<br>Walls : Putty / POP, Ceramic tiles-dado up to 2 feet above working platform<br>Granite counter with stainless steel sink</p>', NULL, NULL, 6, 3, 1, 'Texas', '84832,28343,37347,34656,34651', 'within 90 days', '1', NULL, NULL, 'multi_family', NULL, '250-400', 0, 0, 0, 0, 'As it arrives', '8000000', '0', '1', 670, '2023-01-09 07:39:43', 2, '2023-01-09 08:04:51', '2023-01-09 08:04:51', '2', '2', '2', NULL, NULL, 1, '2023-01-09 08:04:51');
INSERT INTO `agents_posts` (`post_id`, `agents_user_id`, `agents_users_role_id`, `posttitle`, `details`, `address1`, `address2`, `city`, `state`, `status`, `area`, `zip`, `when_do_you_want_to_sell`, `need_Cash_back`, `interested_short_sale`, `got_lender_approval_for_short_sale`, `home_type`, `best_features`, `price_range`, `firsttime_home_buyer`, `do_u_have_a_home_to_sell`, `if_so_do_you_need_help_selling`, `interested_in_buying`, `bids_emailed`, `do_you_need_financing`, `is_deleted`, `applied_post`, `applied_user_id`, `created_at`, `post_type`, `updated_at`, `agent_select_date`, `agent_send_review`, `buyer_seller_send_review`, `mark_complete`, `closing_date`, `agent_payment`, `final_status`, `cron_time`) VALUES
(66, 707, 3, 'This is Post for Selling the house', '<p style=\"margin-bottom: 20px; font-size: 14px; line-height: 24px; color: rgb(25, 23, 23); font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; text-align: center; background-color: rgb(232, 238, 235);\"><span class=\"head\" style=\"font-weight: 700; color: rgb(0, 72, 34);\">Master Bedrooms</span><br>Flooring : Vitrified tile<br>Walls : Putty / POP<br>Ceiling : Putty / POP</p><p style=\"margin-bottom: 20px; font-size: 14px; line-height: 24px; color: rgb(25, 23, 23); font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; text-align: center; background-color: rgb(232, 238, 235);\"><span class=\"head\" style=\"font-weight: 700; color: rgb(0, 72, 34);\">Balcony</span><br>Flooring : Anti Skid Tiles<br>Ceiling : Putty / POP<br>Walls : Putty / POP<br></p><p style=\"margin-bottom: 20px; font-size: 14px; line-height: 24px; color: rgb(25, 23, 23); font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; text-align: center; background-color: rgb(232, 238, 235);\"><span class=\"head\" style=\"font-weight: 700; color: rgb(0, 72, 34);\">Kitchen</span><br>Flooring : Anti Skid Tiles<br>Ceiling : Putty / POP<br>Walls : Putty / POP, Ceramic tiles-dado up to 2 feet above working platform<br>Granite counter with stainless steel sink</p>', 'Wellington', 'New Zealand', 4, 2, 1, NULL, '12312', 'within 90 days', '1', '1', '1', 'single_family', '{\"best_features_1\":\"Huge balcony\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 659, NULL, 3, '2023-01-09 09:13:57', '2023-01-09 09:13:57', '2', '2', '2', NULL, NULL, 1, '2023-01-09 09:13:57'),
(67, 645, 2, 'Rosanna.Senger ( Buyer )', '<p>Here,</p><p>i am Rosanna&nbsp;</p><p>a buyer for estate&nbsp;</p><p><br></p><p>hello,&nbsp;</p><p><br></p><p>I wnat a house or a flat to live. and that place should be near to hospitals and malls.&nbsp;</p><p>And that locatiob also should be a family area with good types of nabours.&nbsp;</p><p>Thnks.</p><p><br></p>', NULL, NULL, 6, 3, 1, '110 E Karns Ave, Jackson, Wyoming, 83001', '76474,42565,78431,93746,73644', 'within 30 days', '0', NULL, NULL, 'multi_family', NULL, '250-400', 0, 0, 0, 0, 'As it arrives', '1', '0', '2', NULL, '2023-01-10 08:47:53', 2, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(68, 656, 3, 'This is a post for sellling a villa', '<span style=\"font-family: muli, Helvetica, Arial, sans-serif; font-size: 14.336px; letter-spacing: 0.384px; text-align: justify;\">Prestige Group has firmly established itself as one of the leading and most successful developers of real estate in India by imprinting its indelible mark across all asset classes. Founded in 1986, the group’s turnover is today in excess of Rs 3518 Cr (for FY 15); a leap that has been inspired by CMD Irfan Razack and marshaled by his brothers Rezwan Razack and Noaman Razack. Having completed 210 projects covering over 80 million sq ft, currently the company has 53 ongoing projects spanning 54 million sq ft and 35 upcoming projects aggregating to 48 million sq ft of world-class real estate space across asset classes. In October 2010, the Prestige Group also successfully entered the Capital Market with an Initial Public Offering of Rs 1200 cr.</span>', 'Mumbai', NULL, 4, 2, 1, NULL, '88881', 'now', '1', '1', '1', 'multi_family', '{\"best_features_1\":\"subdivision\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 709, '2023-01-11 08:09:26', 3, '2023-01-11 08:11:09', '2023-01-11 08:11:09', '2', '2', '2', NULL, NULL, 1, '2023-01-11 08:11:09'),
(69, 713, 3, 'This a Seller Post for selling a Villa in Bangalor', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-01-16 05:45:39', NULL, '2023-01-16 05:45:39', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(70, 714, 2, 'This is Buyer post for buying a Villa', '<ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 14px; line-height: inherit; font-family: Roboto-Light, sans-serif; vertical-align: baseline; list-style: none; position: relative; color: rgb(102, 102, 102);\"><li style=\"margin: 0px; padding: 0px 0px 15px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: Roboto-Regular; vertical-align: baseline; float: left; width: 282.49px; color: rgb(102, 102, 102); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; position: relative; left: 0px; list-style-type: none !important;\"><span class=\"icon-club_house\" style=\"margin: 0px 5px 0px 0px; padding: 0px; border: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: inherit; font-size: 22px; line-height: 22px; vertical-align: baseline; speak: none; -webkit-font-smoothing: antialiased; position: relative; top: 3px; left: 0px; color: rgb(51, 51, 51); font-family: icomoon !important;\">&nbsp;</span>Club House</li><li style=\"margin: 0px; padding: 0px 0px 15px; border: 0px; font: inherit; vertical-align: baseline; float: left; width: 282.49px; color: rgb(102, 102, 102); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; list-style-type: none !important;\"><span class=\"icon-security\" style=\"margin: 0px 5px 0px 0px; padding: 0px; border: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: inherit; font-size: 22px; line-height: 22px; vertical-align: baseline; speak: none; -webkit-font-smoothing: antialiased; position: relative; top: 3px; left: 0px; color: rgb(51, 51, 51); font-family: icomoon !important;\">&nbsp;</span>Security</li><li style=\"margin: 0px; padding: 0px 0px 15px; border: 0px; font: inherit; vertical-align: baseline; float: left; width: 282.49px; color: rgb(102, 102, 102); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; list-style-type: none !important;\"><span class=\"icon-24hr_electricity_backup\" style=\"margin: 0px 5px 0px 0px; padding: 0px; border: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: inherit; font-size: 22px; line-height: 22px; vertical-align: baseline; speak: none; -webkit-font-smoothing: antialiased; position: relative; top: 3px; left: 0px; color: rgb(51, 51, 51); font-family: icomoon !important;\">&nbsp;</span>24Hr Backup</li><li style=\"margin: 0px; padding: 0px 0px 15px; border: 0px; font: inherit; vertical-align: baseline; float: left; width: 282.49px; color: rgb(102, 102, 102); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; list-style-type: none !important;\"><span class=\"icon-rainwater_harvesting\" style=\"margin: 0px 5px 0px 0px; padding: 0px; border: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: inherit; font-size: 22px; line-height: 22px; vertical-align: baseline; speak: none; -webkit-font-smoothing: antialiased; position: relative; top: 3px; left: 0px; color: rgb(51, 51, 51); font-family: icomoon !important;\">&nbsp;</span>Rain Water Harvesting</li><li style=\"margin: 0px; padding: 0px 0px 15px; border: 0px; font: inherit; vertical-align: baseline; float: left; width: 282.49px; color: rgb(102, 102, 102); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; list-style-type: none !important;\"><span class=\"icon-maintenance_staff\" style=\"margin: 0px 5px 0px 0px; padding: 0px; border: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: inherit; font-size: 22px; line-height: 22px; vertical-align: baseline; speak: none; -webkit-font-smoothing: antialiased; position: relative; top: 3px; left: 0px; color: rgb(51, 51, 51); font-family: icomoon !important;\">&nbsp;</span>Maintenance Staff</li><li style=\"margin: 0px; padding: 0px 0px 15px; border: 0px; font: inherit; vertical-align: baseline; float: left; width: 282.49px; color: rgb(102, 102, 102); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; list-style-type: none !important;\"><span class=\"icon-landscaped_garden\" style=\"margin: 0px 5px 0px 0px; padding: 0px; border: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: inherit; font-size: 22px; line-height: 22px; vertical-align: baseline; speak: none; -webkit-font-smoothing: antialiased; position: relative; top: 3px; left: 0px; color: rgb(51, 51, 51); font-family: icomoon !important;\">&nbsp;</span>Garden</li><li style=\"margin: 0px; padding: 0px 0px 15px; border: 0px; font: inherit; vertical-align: baseline; float: left; width: 282.49px; color: rgb(102, 102, 102); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; list-style-type: none !important;\"><span class=\"icon-community_hall\" style=\"margin: 0px 5px 0px 0px; padding: 0px; border: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: inherit; font-size: 22px; line-height: 22px; vertical-align: baseline; speak: none; -webkit-font-smoothing: antialiased; position: relative; top: 3px; left: 0px; color: rgb(51, 51, 51); font-family: icomoon !important;\">&nbsp;</span>Community Hall</li><li style=\"margin: 0px; padding: 0px 0px 15px; border: 0px; font: inherit; vertical-align: baseline; float: left; width: 282.49px; color: rgb(102, 102, 102); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; list-style-type: none !important;\"><span class=\"icon-24hr_electricity_backup\" style=\"margin: 0px 5px 0px 0px; padding: 0px; border: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: inherit; font-size: 22px; line-height: 22px; vertical-align: baseline; speak: none; -webkit-font-smoothing: antialiased; position: relative; top: 3px; left: 0px; color: rgb(51, 51, 51); font-family: icomoon !important;\">&nbsp;</span>Electricity Full</li><li style=\"margin: 0px; padding: 0px 0px 15px; border: 0px; font: inherit; vertical-align: baseline; float: left; width: 282.49px; color: rgb(102, 102, 102); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; list-style-type: none !important;\"><span class=\"icon-badminton_court\" style=\"margin: 0px 5px 0px 0px; padding: 0px; border: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: inherit; font-size: 22px; line-height: 22px; vertical-align: baseline; speak: none; -webkit-font-smoothing: antialiased; position: relative; top: 3px; left: 0px; color: rgb(51, 51, 51); font-family: icomoon !important;\">&nbsp;</span>Badminton Court</li></ul>', NULL, NULL, 5, 2, 1, 'Kanakapura', '89991,89992,89993,89994,89995', 'within 30 days', '1', NULL, NULL, 'multi_family', NULL, '75', 1, 1, 1, 1, 'Once a day', '828218121', '1', '1', 715, '2023-01-16 05:47:47', 2, '2023-01-16 06:03:37', '2023-01-16 06:03:37', '2', '2', '2', NULL, NULL, 1, '2023-01-16 06:03:37'),
(71, 714, 2, 'Interested in Buying a Villa', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 715, NULL, NULL, '2023-01-16 06:09:58', '2023-01-16 06:09:58', '2', '2', '2', NULL, NULL, 1, '2023-01-16 06:09:58'),
(72, 710, 3, 'audumar0304', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(73, 710, 3, 'Adumar Works for Estate and lands --', '<p><br></p><p>Hi there</p><p>here, I am a seller of / for estate and lands.&nbsp;</p><p>we provide houses and flats for living and best qualitys.&nbsp;</p><p>and we provide the best class of thing in houses, lands and for flats also.&nbsp;</p><p><br></p><p>Thanks.</p>', '1646 Ravine Ln, Carpentersville, Indiana, 60110', '1646 Ravine Ln, Carpentersville, Indiana, 60110', 6, 3, 1, NULL, '60110', 'within 90 days', '0', '0', NULL, 'lots_land', '{\"best_features_1\":\"Secure Gated subdivision\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-01-16 06:45:10', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(74, 714, 3, 'Selling Duplex house with fully furnished 2 bk house located in the heart of the city and good transportation facility', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 709, NULL, NULL, '2023-01-16 12:00:19', '2023-01-16 12:00:19', '2', '2', '2', NULL, NULL, 1, '2023-01-16 12:00:19'),
(75, 707, 3, 'our team is committed to creating the number one online platform and rendering impeccable services to both buyers, sellers, and agents. Making a difference in the real estate industry.', '<p>hi, here we are representing to land and houses options to sell.&nbsp;</p><p>we have the best places and very good quality and design of houses.</p><p><span style=\"color: rgb(238, 238, 238); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; text-align: justify; background-color: rgb(23, 33, 56);\">our team is committed to creating the number one online platform and rendering impeccable services to both buyers, sellers, and agents. Making a difference in the real estate industry.&nbsp;</span></p><p>\r\n<br style=\"box-sizing: border-box; border-radius: 0px; color: rgb(238, 238, 238); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 13px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 500; letter-spacing: normal; orphans: 2; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><br></p>', '12236 E 60th St, Tulsa, Oklahoma, 74134', '12236 E 60th St, Tulsa, Oklahoma, 74134', 8, 7, 1, NULL, '74134', 'within 90 days', '0', '0', NULL, 'manufactured', '{\"best_features_1\":\"Secure Gated subdivision\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 709, '2023-01-19 07:34:19', 3, '2023-01-31 06:56:58', '2023-01-31 06:56:58', '2', '2', '2', NULL, NULL, 1, '2023-01-31 06:56:58'),
(76, 716, 3, 'Need to sell my home in bellevue, asap', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(77, 719, 3, 'Testing', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-01-27 16:00:08', NULL, '2023-01-27 16:00:08', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(78, 724, 3, 'Testing', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(79, 724, 2, 'nonexydydy', 'Erickson', NULL, NULL, 4, 2, 1, NULL, NULL, 'Within 90 days', '1', NULL, NULL, 'Condo/Townhome', NULL, '75k - 150k', 1, 1, 1, 1, NULL, NULL, '0', '2', NULL, NULL, 2, '2023-01-29 00:25:38', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(80, 724, 2, 'Farooq qarzae', 'testing3eer', NULL, NULL, 4, 2, 1, NULL, '54500,54501,54502,54503,54504', 'now', '1', NULL, NULL, 'single_family', NULL, '75-150', 1, 0, 1, 1, 'Once a day', '5000', '0', '2', NULL, '2023-01-27 16:47:30', 2, '2023-01-28 23:52:52', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(81, 549, 3, 'test api', 'des test', 'des add', 'des add2', 5, 2, 1, NULL, '23452', 'within 30 days', '1', '1', '1', 'single_family', '{\"best_features_1\":\"Secure Gated subdivision ds\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\",\"best_features_5\":\"ds\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-01-27 20:21:29', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(82, 724, 2, 'Test1', 'dckwldfkwef', NULL, NULL, 4, 2, 1, NULL, NULL, '2112', '1', NULL, NULL, 'Single Family', NULL, '75k - 150k', 1, 1, 1, 1, 'Once a day', '5000', '0', '2', NULL, '2023-01-28 19:31:04', 2, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(83, 724, 2, 'Testfucycy', 'Anser Nawaz', NULL, NULL, 4, 2, 1, NULL, NULL, '2112', '1', NULL, NULL, 'Single Family', NULL, '75k - 150k', 1, 0, 1, 1, 'Once a day', '5000', '0', '2', NULL, '2023-01-28 20:03:26', 2, '2023-01-29 00:24:51', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(84, 724, 2, 'Anser', 'jsjsje', NULL, NULL, 4, 2, 1, NULL, NULL, 'Within 30days', '1', NULL, NULL, 'Single Family', NULL, '75k - 150k', 1, 1, 1, 1, 'As it arrives', '5000', '0', '2', NULL, '2023-01-28 20:10:11', 2, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(85, 724, 2, 'Seth qarzae', 'shemale', NULL, NULL, 4, 2, 1, NULL, NULL, 'Within 30days', '0', NULL, NULL, 'Single Family', NULL, 'Less than 75k', 1, 0, 1, 1, NULL, '5000', '0', '2', NULL, '2023-01-28 20:38:52', 2, '2023-01-28 20:46:02', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(86, 724, 2, 'umar qarzae', 'msmsks', NULL, NULL, 4, 2, 1, NULL, NULL, 'Within 90 days', '0', NULL, NULL, 'Multi Family', NULL, '250k - 400k', 1, 0, 1, 0, 'As it arrives', '5000', '0', '2', NULL, '2023-01-28 20:44:11', 2, '2023-01-29 02:11:39', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(87, 724, 2, 'Final', 'testingshsjsjje', NULL, NULL, 4, 2, 1, NULL, NULL, 'Within 30days', '0', NULL, NULL, 'Manufactured', NULL, '250k - 400k', 0, 0, 0, 0, NULL, '200', '0', '2', NULL, '2023-01-29 00:10:14', 2, '2023-01-29 02:00:17', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(88, 656, 3, 'This is post titel', 'looking for duplex', 'Armed Forces', NULL, 4, 2, 1, NULL, '67756', 'Within 30days', '1', NULL, NULL, 'Condo/Townhome', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-01-30 00:55:30', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(89, 707, 3, 'mobile tes post', 'test', 'Armed Forces Pacific', NULL, 4, 2, 1, NULL, '56678', 'Now', '1', NULL, NULL, 'Condo/Townhome', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 660, '2023-01-30 10:23:12', 3, '2023-01-31 06:56:24', '2023-01-31 06:56:24', '2', '2', '2', NULL, NULL, 1, '2023-01-31 06:56:24'),
(90, 724, 3, 'test2', 'testing', 'Hey', 'Hey 2', 5, 2, 1, NULL, '54500', 'within 30 days', '1', '1', NULL, 'condo_townhome', '{\"best_features_1\":\"Secure Gated subdivision\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\",\"best_features_5\":\"Beautiful View From The Home 2\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-01-31 20:34:40', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(91, 724, 2, 'welcome', 'jsdkjd', NULL, NULL, 4, 2, 1, NULL, NULL, 'Within 30days', '1', NULL, NULL, 'Manufactured', NULL, 'Above 400k', 0, 0, 0, 0, NULL, NULL, '0', '2', NULL, '2023-01-31 21:17:26', 2, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(92, 724, 3, 'app', 'apptest', 'ad1', 'ad2', 10, 6, 1, NULL, '54500', 'Within 30days', '1', '1', NULL, 'Manufactured', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-01-31 22:50:58', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(93, 724, 3, 'app', 'apptest', 'ad1', 'ad2', 10, 6, 1, NULL, '54500', 'Within 30days', '1', '1', NULL, 'Manufactured', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-01-31 22:50:59', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(94, 724, 3, 'app', 'apptest', 'ad1', 'ad2', 10, 6, 1, NULL, '54500', 'Within 30days', '1', '1', NULL, 'Manufactured', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-01-31 22:51:00', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(95, 724, 3, 'app', 'apptest', 'ad1', 'ad2', 10, 6, 1, NULL, '54500', 'Within 30days', '1', '1', NULL, 'Manufactured', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-01-31 22:51:36', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(96, 724, 3, 'app', 'apptest', 'ad1', 'ad2', 10, 6, 1, NULL, '54500', 'Within 30days', '1', '1', NULL, 'Manufactured', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-01-31 22:51:37', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(97, 724, 3, 'app', 'apptest', 'ad1', 'ad2', 10, 6, 1, NULL, '54500', 'Within 30days', '1', '1', NULL, 'Manufactured', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-01-31 22:51:44', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(98, 724, 3, 'appNow', 'apptest', 'ad1', 'ad2', 10, 6, 1, NULL, '54500', 'Within 30days', '1', '1', NULL, 'Manufactured', '{\"best_features_1\":\"Secure Gated Subdivision\",\"best_features_2\":\"Secure Gated Subdivision\",\"best_features_3\":\"Huge Flat Backyard\",\"best_features_4\":\"Beautiful View From The Home\",\"best_features_5\":\"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-01-31 22:52:35', 3, '2023-02-03 21:54:03', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(99, 734, 2, 'testing123', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-02-04 17:55:11', NULL, '2023-02-04 17:55:11', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(100, 737, 3, 'sell home', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-02-04 22:12:32', NULL, '2023-02-04 22:12:32', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(101, 549, 2, 'a', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(102, 739, 3, 'teste 123', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-02-05 09:08:47', NULL, '2023-02-05 09:08:47', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(103, 739, 2, 'need plumber', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 735, NULL, NULL, '2023-02-05 09:27:49', '2023-02-05 09:27:49', '2', '2', '2', NULL, NULL, 1, '2023-02-05 09:27:49'),
(104, 744, 2, 'test', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(105, 548, 3, 'abc', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(106, 646, 3, 'vmuu5yhyvuh35e', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(107, 755, 2, 'test', 'isieiei', NULL, NULL, 4, 2, 1, NULL, NULL, 'Within 30days', '1', NULL, NULL, 'Condo/Townhome', NULL, '75k - 150k', 1, 1, 1, 1, 'As it arrives', '161631', '0', '2', NULL, '2023-02-27 23:16:48', 2, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(108, 759, 3, 'test', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(109, 760, 3, 'tester post 1', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-03-02 16:08:41', NULL, '2023-03-02 16:08:41', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(110, 761, 3, 'kev test 1', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-03-02 19:02:51', NULL, '2023-03-02 19:02:51', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(111, 762, 3, 'test 01', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 670, '2023-03-03 08:10:19', NULL, '2023-08-08 12:14:38', '2023-03-03 08:37:29', '2', '2', '2', '2023-08-08 00:00:00', NULL, 1, '2023-03-03 08:37:29'),
(112, 762, 3, 'test02', 'jjjkasjkdhakjdsjkashd', 'lkjlkj', NULL, 6, 3, 1, NULL, '54658', 'within 30 days', '0', NULL, NULL, NULL, '{\"best_features_1\":\"Secure Gated subdivision\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 763, '2023-03-03 08:56:45', 3, '2023-03-03 12:19:20', '2023-03-03 12:19:20', '2', '2', '2', NULL, NULL, 1, '2023-03-03 12:19:20'),
(113, 762, 2, 'buyer post 1', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(114, 762, 3, 'test03', 'dowdlma;', 'cks', 'clm;s', 4, 2, 1, NULL, '25895', 'within 30 days', '1', '1', NULL, 'single_family', '{\"best_features_1\":\"Secure Gated subdivision\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 763, '2023-03-03 12:11:30', 3, '2023-03-03 12:17:38', '2023-03-03 12:17:38', '2', '2', '2', NULL, NULL, 1, '2023-03-03 12:17:38'),
(115, 764, 2, 'test', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-03-04 15:15:57', NULL, '2023-03-04 15:15:57', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(116, 764, 2, 'mobtestbuy', 'bsvghs', NULL, NULL, 4, 2, 1, NULL, NULL, 'Within 30days', '1', NULL, NULL, 'Condo/Townhome', NULL, '150k - 250k', 1, 0, 0, 0, NULL, NULL, '0', '2', NULL, '2023-03-04 19:26:52', 2, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(117, 765, 3, 'Seller', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-03-04 19:49:28', NULL, '2023-03-04 19:49:28', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(118, 767, 2, 'Home_Test', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 769, '2023-03-12 07:52:06', NULL, '2023-03-16 17:47:46', '2023-03-12 08:43:54', '2', '2', '2', '2023-03-16 00:00:00', NULL, 1, '2023-03-12 08:43:54'),
(119, 768, 3, 'Home Sell_Test', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-03-12 07:57:38', NULL, '2023-03-12 07:57:38', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(120, 767, 2, 'Testing', 'only testing home', NULL, NULL, 4, 2, 1, NULL, NULL, 'Within 30days', '0', NULL, NULL, 'Single Family', NULL, '75k - 150k', 1, 0, 0, 0, 'Once a day', NULL, '0', '2', NULL, '2023-03-13 16:14:54', 2, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(121, 771, 3, 'Seller', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-03-14 09:32:41', NULL, '2023-03-14 09:32:41', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(122, 768, 2, 'Seller', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(123, 773, 3, 'gdfg', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-03-16 05:51:11', NULL, '2023-03-16 05:51:11', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(124, 767, 3, 'Test', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 774, NULL, NULL, '2023-03-16 17:44:01', '2023-03-16 17:44:01', '2', '2', '2', NULL, NULL, 1, '2023-03-16 17:44:01'),
(125, 767, 3, 'Only for test', 'Testing is going on', 'Cweg', 'webjhb', 6, 3, 1, NULL, '65199', 'within 30 days', '1', '1', NULL, NULL, '{\"best_features_1\":\"Secure Gated subdivision\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-03-16 17:54:24', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL);
INSERT INTO `agents_posts` (`post_id`, `agents_user_id`, `agents_users_role_id`, `posttitle`, `details`, `address1`, `address2`, `city`, `state`, `status`, `area`, `zip`, `when_do_you_want_to_sell`, `need_Cash_back`, `interested_short_sale`, `got_lender_approval_for_short_sale`, `home_type`, `best_features`, `price_range`, `firsttime_home_buyer`, `do_u_have_a_home_to_sell`, `if_so_do_you_need_help_selling`, `interested_in_buying`, `bids_emailed`, `do_you_need_financing`, `is_deleted`, `applied_post`, `applied_user_id`, `created_at`, `post_type`, `updated_at`, `agent_select_date`, `agent_send_review`, `buyer_seller_send_review`, `mark_complete`, `closing_date`, `agent_payment`, `final_status`, `cron_time`) VALUES
(126, 767, 3, 'This is testing two', '<p><br></p>', 'One', NULL, 4, 2, 1, NULL, '66011', 'within 30 days', '0', '1', '0', 'multi_family', '{\"best_features_1\":\"Secure Gated subdivision\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\",\"best_features_5\":\"wjefjehrfjer\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-03-18 12:45:34', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(127, 775, 2, 'need to repair my ac', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-03-22 02:34:51', NULL, '2023-03-22 02:34:51', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(128, 775, 3, 'ABC post', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(129, 776, 3, 'Need a plot', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-03-27 02:24:05', NULL, '2023-03-27 02:24:05', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(130, 777, 2, 'abc', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-03-27 02:52:22', NULL, '2023-03-27 02:52:22', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(131, 779, 3, 'test', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-04-13 05:01:30', NULL, '2023-04-13 05:01:30', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(132, 779, 3, 'test 1', 'ttrjfio', 'bellari', 'south ex', 4, 2, 1, NULL, '56685', 'within 30 days', '0', '1', '0', 'single_family', '{\"best_features_1\":\"Secure Gated subdivision\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-04-13 05:12:24', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(133, 783, 3, 'testing post 004', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-04-13 10:08:09', NULL, '2023-04-13 10:08:09', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(134, 784, 3, 'test selling 1', 'sdfsdfsdf', 'asdasd', NULL, 4, 2, 1, NULL, '45215', 'within 30 days', '0', NULL, NULL, NULL, '{\"best_features_1\":\"Secure Gated subdivision\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 786, '2023-04-13 10:19:09', 3, '2023-04-13 12:23:14', '2023-04-13 12:23:14', '2', '2', '2', NULL, NULL, 1, '2023-04-13 12:23:14'),
(135, 784, 3, 'test sell 2', 'sddsdfsdfsdfsd', 'asdasd', NULL, 6, 3, 1, NULL, '45454', 'within 90 days', '0', NULL, NULL, NULL, '{\"best_features_1\":\"Secure Gated subdivision\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 781, '2023-04-13 10:34:29', 3, '2023-04-13 10:37:18', '2023-04-13 10:37:18', '2', '2', '2', NULL, NULL, 1, '2023-04-13 10:37:18'),
(136, 810, 3, 'Developer', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(137, 828, 3, 'i want to sell my home in 30 days', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 830, '2023-06-02 17:32:03', NULL, '2023-06-03 10:03:03', '2023-06-03 10:03:03', '2', '2', '2', NULL, NULL, 1, '2023-06-03 10:03:03'),
(138, 828, 3, '2nd post', 'abcsderfsdsdaksfjalk', 'asdkasdlk', 'asdkad', 6, 3, 1, NULL, '45784', 'within 90 days', '1', '1', '1', 'single_family', '{\"best_features_1\":\"Secure Gated subdivision\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\",\"best_features_5\":\"abcderfgh\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-06-03 08:15:39', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL);
INSERT INTO `agents_posts` (`post_id`, `agents_user_id`, `agents_users_role_id`, `posttitle`, `details`, `address1`, `address2`, `city`, `state`, `status`, `area`, `zip`, `when_do_you_want_to_sell`, `need_Cash_back`, `interested_short_sale`, `got_lender_approval_for_short_sale`, `home_type`, `best_features`, `price_range`, `firsttime_home_buyer`, `do_u_have_a_home_to_sell`, `if_so_do_you_need_help_selling`, `interested_in_buying`, `bids_emailed`, `do_you_need_financing`, `is_deleted`, `applied_post`, `applied_user_id`, `created_at`, `post_type`, `updated_at`, `agent_select_date`, `agent_send_review`, `buyer_seller_send_review`, `mark_complete`, `closing_date`, `agent_payment`, `final_status`, `cron_time`) VALUES
(139, 828, 3, '3rd post', '<p>askdjakldjii&nbsp;&nbsp;&nbsp;&nbsp;</p>', 'asdasd', 'asdasdasdasd', 4, 2, 1, NULL, '12454', 'undecided', '1', '0', NULL, 'multi_family', '{\"best_features_1\":\"Secure Gated subdivision\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-06-03 08:16:59', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL);
INSERT INTO `agents_posts` (`post_id`, `agents_user_id`, `agents_users_role_id`, `posttitle`, `details`, `address1`, `address2`, `city`, `state`, `status`, `area`, `zip`, `when_do_you_want_to_sell`, `need_Cash_back`, `interested_short_sale`, `got_lender_approval_for_short_sale`, `home_type`, `best_features`, `price_range`, `firsttime_home_buyer`, `do_u_have_a_home_to_sell`, `if_so_do_you_need_help_selling`, `interested_in_buying`, `bids_emailed`, `do_you_need_financing`, `is_deleted`, `applied_post`, `applied_user_id`, `created_at`, `post_type`, `updated_at`, `agent_select_date`, `agent_send_review`, `buyer_seller_send_review`, `mark_complete`, `closing_date`, `agent_payment`, `final_status`, `cron_time`) VALUES
(140, 829, 2, 'I want to buy a house for my family within a month', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-06-03 08:43:36', NULL, '2023-06-03 08:43:36', NULL, '2', '2', '2', NULL, NULL, 0, NULL);
INSERT INTO `agents_posts` (`post_id`, `agents_user_id`, `agents_users_role_id`, `posttitle`, `details`, `address1`, `address2`, `city`, `state`, `status`, `area`, `zip`, `when_do_you_want_to_sell`, `need_Cash_back`, `interested_short_sale`, `got_lender_approval_for_short_sale`, `home_type`, `best_features`, `price_range`, `firsttime_home_buyer`, `do_u_have_a_home_to_sell`, `if_so_do_you_need_help_selling`, `interested_in_buying`, `bids_emailed`, `do_you_need_financing`, `is_deleted`, `applied_post`, `applied_user_id`, `created_at`, `post_type`, `updated_at`, `agent_select_date`, `agent_send_review`, `buyer_seller_send_review`, `mark_complete`, `closing_date`, `agent_payment`, `final_status`, `cron_time`) VALUES
(141, 828, 3, 'image post', '<p>asdasdasdasd</p>', 'asdasd', NULL, 13, 12, 1, NULL, '45454', 'within 30 days', '1', '1', '0', 'condo_townhome', '{\"best_features_1\":\"Secure Gated subdivision\",\"best_features_2\":\"Secure Gated subdivision\",\"best_features_3\":\"Huge flat backyard\",\"best_features_4\":\"Beautiful view from the home\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-06-03 11:15:44', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL);
INSERT INTO `agents_posts` (`post_id`, `agents_user_id`, `agents_users_role_id`, `posttitle`, `details`, `address1`, `address2`, `city`, `state`, `status`, `area`, `zip`, `when_do_you_want_to_sell`, `need_Cash_back`, `interested_short_sale`, `got_lender_approval_for_short_sale`, `home_type`, `best_features`, `price_range`, `firsttime_home_buyer`, `do_u_have_a_home_to_sell`, `if_so_do_you_need_help_selling`, `interested_in_buying`, `bids_emailed`, `do_you_need_financing`, `is_deleted`, `applied_post`, `applied_user_id`, `created_at`, `post_type`, `updated_at`, `agent_select_date`, `agent_send_review`, `buyer_seller_send_review`, `mark_complete`, `closing_date`, `agent_payment`, `final_status`, `cron_time`) VALUES
(142, 831, 3, 'seller 1', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-06-08 06:34:59', NULL, '2023-06-08 06:34:59', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(143, 831, 3, 'wert', '<p>ertj&nbsp; &nbsp; sdfghj&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>', 'ertyu', 'ertyui', 6, 3, 1, NULL, '30201', 'within 30 days', '1', '0', NULL, 'single_family', '{\"best_features_2\":\"ffsdfhgdmbmxd\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-06-08 13:09:23', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(144, 810, 3, 'developer2', '<p>qwertyuisdfghjk&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>', 'wertyuit', 'qwertyu', 14, 5, 1, NULL, '30201', 'within 30 days', '1', '0', NULL, 'condo_townhome', '{\"best_features_1\":\"qwertyu\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-07-08 10:45:42', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(145, 835, 3, 'new sell', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(146, 835, 2, 'seller', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(147, 839, 3, 'NEw home', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(148, 839, 3, 'NEWJSJJ', 'qwertyuiuytrasdfgh', 'A-23456', 'qwertygv', 8, 7, 1, NULL, '30200', 'within 30 days', '1', '1', '1', 'multi_family', '{\"best_features_1\":\"qwertyu\",\"best_features_2\":\"qwertyu\",\"best_features_3\":\"wert\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-07-27 08:27:50', 3, '2023-07-27 09:36:12', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(149, 839, 3, 'NEWJSJJ', 'qwertyuiuytr', 'A-23456', 'qwertygv', 8, 7, 1, NULL, '30200', 'within 30 days', '1', '1', '1', 'multi_family', '{\"best_features_1\":\"qwertyu\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-07-27 08:35:02', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(150, 840, 3, 'This is seller post', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-07-31 07:09:47', NULL, '2023-07-31 07:09:47', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(151, 840, 3, '3 BHK for Sale', '<p><b><u><span style=\"color: rgb(66, 82, 110); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; font-size: 12px; white-space-collapse: preserve;\">Raymond has launched the epitome of luxury living in the name of Raymond Realty Ten X Era, to offer luxurious and exclusive residences in the heart of Thane. Raymond Realty Ten X Era Pokharan Road redefines the comfort living by offering stylish homes in the form of luxury apartments. It is a new launch project. Carefully crafted by its makers to set a new benchmark of exquisiteness and well-being, Raymond Realty Ten X Era is going to be the most desirable address in Thane. This project ensures a stress-free life for its residents through its thoughtfully designed floor plans that promise extreme privacy and freedom. Raymond Realty Ten X Era Pokharan Road has 2 towers, with 38 floors each and  just 603 units to offer, making it a unique investment opportunity for a select few in Thane property market. The society will be completely ready for possession in Jan, 2026.</span><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"></u></b><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><span style=\"color: rgb(66, 82, 110); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; font-size: 12px; white-space-collapse: preserve;\">Raymond Realty Ten X Era will be an upscale address as it will be spread over an area of 3.74 acres, making it one of the most lavishly built projects in the Thane region.</span><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><span style=\"color: rgb(66, 82, 110); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; font-size: 12px; white-space-collapse: preserve;\">Not just an impressive range of conveniences, each home at Raymond Realty Ten X Era will also have a beautiful view ensuring a relaxing atmosphere for its owners after a taxing day at work.</span><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><b style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 0px; font-size: 12px; line-height: normal; outline: 0px; vertical-align: baseline; color: rgb(66, 82, 110); white-space-collapse: preserve;\">Raymond Realty Ten X Era Price List</b><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><span style=\"color: rgb(66, 82, 110); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; font-size: 12px; white-space-collapse: preserve;\">Raymond Realty Ten X Era is an exciting investment opportunity and a chance to own a luxurious pincode in the making. As per Raymond Realty Ten X Era Price List, a 2BHK Apartment is available at a starting price of Rs. 1.25 Cr  while a 3BHK Apartment is offered at Rs. 1.62 Cr onwards. </span><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"></p><table style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: 1px solid black; font-size: 12px; line-height: normal; outline: 0px; vertical-align: baseline; color: rgb(66, 82, 110); white-space-collapse: preserve;\"><thead style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 0px; font-size: inherit; line-height: normal; outline: 0px; vertical-align: baseline; font-weight: inherit;\"><tr style=\"margin: 0px; padding: 8px; vertical-align: baseline; border: 1px solid black; -webkit-tap-highlight-color: transparent; background: 0px 0px; font-size: inherit; line-height: normal; outline: 0px; font-weight: inherit;\"><th style=\"margin: 0px; padding: 8px; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 1px solid black; font-size: inherit; line-height: normal; outline: 0px; vertical-align: baseline; font-weight: inherit;\">Configuration</th><th style=\"margin: 0px; padding: 8px; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 1px solid black; font-size: inherit; line-height: normal; outline: 0px; vertical-align: baseline; font-weight: inherit;\">Size</th><th style=\"margin: 0px; padding: 8px; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 1px solid black; font-size: inherit; line-height: normal; outline: 0px; vertical-align: baseline; font-weight: inherit;\">Price</th></tr><tr style=\"margin: 0px; padding: 8px; vertical-align: baseline; border: 1px solid black; -webkit-tap-highlight-color: transparent; background: 0px 0px; font-size: inherit; line-height: normal; outline: 0px; font-weight: inherit;\"><td style=\"margin: 0px; padding: 8px; font-size: inherit; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 1px solid black; line-height: normal; outline: 0px; vertical-align: baseline; font-weight: inherit;\">2BHK Apartment</td><td style=\"margin: 0px; padding: 8px; font-size: inherit; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 1px solid black; line-height: normal; outline: 0px; vertical-align: baseline; font-weight: inherit;\"> 615 sq.ft.</td><td style=\"margin: 0px; padding: 8px; font-size: inherit; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 1px solid black; line-height: normal; outline: 0px; vertical-align: baseline; font-weight: inherit;\"> Rs. 1.25 Cr</td></tr><tr style=\"margin: 0px; padding: 8px; vertical-align: baseline; border: 1px solid black; -webkit-tap-highlight-color: transparent; background: 0px 0px; font-size: inherit; line-height: normal; outline: 0px; font-weight: inherit;\"><td style=\"margin: 0px; padding: 8px; font-size: inherit; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 1px solid black; line-height: normal; outline: 0px; vertical-align: baseline; font-weight: inherit;\">3BHK Apartment</td><td style=\"margin: 0px; padding: 8px; font-size: inherit; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 1px solid black; line-height: normal; outline: 0px; vertical-align: baseline; font-weight: inherit;\"> 814 sq.ft.</td><td style=\"margin: 0px; padding: 8px; font-size: inherit; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 1px solid black; line-height: normal; outline: 0px; vertical-align: baseline; font-weight: inherit;\"> Rs. 1.62 Cr</td></tr></thead></table><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><span style=\"color: rgb(66, 82, 110); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; font-size: 12px; white-space-collapse: preserve;\">In addition to luxury living, Raymond Realty Ten X Era assures to be a safe investment opportunity.Raymond Realty Ten X Era Thane is a RERA-registered project with registration number P51700049520.</span><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><b style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 0px; font-size: 12px; line-height: normal; outline: 0px; vertical-align: baseline; color: rgb(66, 82, 110); white-space-collapse: preserve;\">How is Pokharan Road for property investment?</b><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><span style=\"color: rgb(66, 82, 110); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; font-size: 12px; white-space-collapse: preserve;\">There could not be a better destination than Pokharan Road to own something as chic as Raymond Realty Ten X Era. Pokharan Road is one of the promising locations to buy a home in Thane with a promising social and physical infrastructure. Some of the important landmarks near Pokharan Road are Korum Mall, Mumbai - Agra National Highway and Fortune Park Lake City and so on. Pokharan Road is already well-known for its offerings and Raymond Realty Ten X Era will be an added feather in its cap. With Raymond Realty Ten X Era being a luxury address, owners can enjoy several locational advantages of staying in a locality like Pokharan Road:</span><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><span style=\"color: rgb(66, 82, 110); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; font-size: 12px; white-space-collapse: preserve;\">Here are some of the locational advantages of Pokharan Road</span><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 20px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; list-style-position: initial; list-style-image: initial; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 0px; font-size: 12px; line-height: normal; outline: 0px; vertical-align: baseline; color: rgb(66, 82, 110); white-space-collapse: preserve;\"><li style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;; list-style: disc; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 0px; font-size: inherit; line-height: normal; outline: 0px; vertical-align: baseline; font-weight: inherit;\">Aayush Multispecialty Hospital, 2.4 Km</li><li style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;; list-style: disc; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 0px; font-size: inherit; line-height: normal; outline: 0px; vertical-align: baseline; font-weight: inherit;\">Tikuji-ni-Wadi, 3 Km</li><li style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;; list-style: disc; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 0px; font-size: inherit; line-height: normal; outline: 0px; vertical-align: baseline; font-weight: inherit;\">Ashar IT Park, 3.2 Km</li><li style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;; list-style: disc; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 0px; font-size: inherit; line-height: normal; outline: 0px; vertical-align: baseline; font-weight: inherit;\">C.P. Goenka International School, 3.4 Km</li><li style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;; list-style: disc; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 0px; font-size: inherit; line-height: normal; outline: 0px; vertical-align: baseline; font-weight: inherit;\">Dadoji Kondadev Stadium, 4.1 Km</li><li style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;; list-style: disc; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 0px; font-size: inherit; line-height: normal; outline: 0px; vertical-align: baseline; font-weight: inherit;\">University of Mumbai Thane Sub-Campus, 4.2 Km</li><li style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;; list-style: disc; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 0px; font-size: inherit; line-height: normal; outline: 0px; vertical-align: baseline; font-weight: inherit;\">Thane Railway Station, 4.3 Km</li><li style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;; list-style: disc; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 0px; font-size: inherit; line-height: normal; outline: 0px; vertical-align: baseline; font-weight: inherit;\">Golden Swan Country Club, 4.5 Km</li><li style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;; list-style: disc; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 0px; font-size: inherit; line-height: normal; outline: 0px; vertical-align: baseline; font-weight: inherit;\">Chhatrapati Shivaji Maharaj Int. Airport, 21.9 Km</li></ul><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><b style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; background: 0px 0px; border: 0px; font-size: 12px; line-height: normal; outline: 0px; vertical-align: baseline; color: rgb(66, 82, 110); white-space-collapse: preserve;\">How is the future of Thane property market?</b><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><br style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; -webkit-tap-highlight-color: transparent; color: rgb(66, 82, 110); font-size: 12px; white-space-collapse: preserve;\"><span style=\"color: rgb(66, 82, 110); font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; font-size: 12px; white-space-collapse: preserve;\">Thane real estate market has a range of property options in a higher price bracket. Pokharan Road in Thane is one of the localities known for housing some of the well-known, branded residential projects which makes it one of the suitable destinations for homebuyers looking for a property for self-use or investment purposes. One thing that makes Thane different from any other city in this region is its potential to attract investors through its flourishing economy and business environment. In addition to this, there are some major infrastructure projects planned in Thane, which are expected to improve the quality of life, in the city, affecting the property prices here extensively.</span><br><iframe frameborder=\"0\" src=\"//www.youtube.com/embed/rGX1Ch6OyUs\" width=\"640\" height=\"360\" class=\"note-video-clip\"></iframe><p></p>', 'Trishul Building Bandra West, Mumbai South West', NULL, 5, 2, 1, NULL, '12321', 'now', '1', '1', '0', 'single_family', '{\"best_features_1\":\"Duplex\",\"best_features_2\":\"Swimming pool\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-08-01 10:48:50', 3, '2023-08-01 10:52:26', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(152, 840, 2, '2 bhk for sale', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(153, 841, 2, 'Buyer Post', '<span id=\"address\" style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, Helvetica, sans-serif; border: 0px; vertical-align: baseline; font-size: 14px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); display: inline-block; background: transparent; line-height: normal; outline: 0px; color: rgb(102, 102, 102);\">101, Bandra West, Mumbai South West, Mumbai</span>', NULL, NULL, 6, 3, 1, 'Texas', '83881,34774,98999,12441,67777', 'within 30 days', '1', NULL, NULL, 'single_family', NULL, '75', 1, 1, 1, 1, 'Once a day', '3000000', '0', '1', 842, '2023-08-01 10:55:52', 2, '2023-08-02 07:38:27', '2023-08-02 07:31:57', '2', '2', '2', '2023-08-02 00:00:00', NULL, 1, '2023-08-02 07:31:57'),
(154, 846, 3, 'Title Post', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-08-09 10:38:59', NULL, '2023-08-09 10:38:59', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(155, 848, 2, 'New Home to buy', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-08-18 07:17:34', NULL, '2023-08-18 07:17:34', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(156, 851, 3, 'test for db test', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-09-14 18:21:49', NULL, '2023-09-14 18:21:49', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(157, 851, 2, 'create test', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(158, 855, 2, 'House', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2023-11-10 08:53:20', NULL, '2023-11-10 08:53:20', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(159, 855, 3, 'ACD', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(160, 716, 2, 'Need to sell my home in bellevue, crocket park, asap', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(161, 859, 3, 'Travel accessories', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 860, '2023-12-02 08:19:02', NULL, '2023-12-28 05:30:41', '2023-12-28 05:30:41', '2', '2', '2', NULL, NULL, 1, '2023-12-28 05:30:41'),
(162, 859, 3, 'Travel Accessories', '<span style=\"color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; white-space-collapse: preserve;\">Say goodbye to chaotic luggage! Keep your clothes neatly organized and easily accessible with our durable packing cubes. Whether it\'s a weekend getaway or a month-long adventure, these cubes are a game-changer.</span>', 'Kirkland', NULL, 14, 5, 1, NULL, '98033', 'within 30 days', '1', '1', '1', 'single_family', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 860, '2023-12-02 08:32:49', 3, '2024-01-14 06:16:07', '2023-12-06 06:14:31', '2', '2', '2', '2024-01-03 00:00:00', NULL, 1, '2023-12-06 06:14:31'),
(163, 861, 2, 'Travel accessories', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 860, '2023-12-07 09:34:38', NULL, '2023-12-07 10:26:37', '2023-12-07 10:26:37', '2', '2', '2', NULL, NULL, 1, '2023-12-07 10:26:37'),
(164, 861, 2, 'Ultimate Noise-Canceling Headphones for Pure Musical Bliss', '<p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-top: 1.25em; margin-bottom: 1.25em; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; white-space-collapse: preserve;\"><b>Immerse yourself in unparalleled audio perfection with our latest noise-canceling headphones. Engineered with cutting-edge technology, these headphones elevate your listening experience by blocking out external noise, allowing you to dive deep into your favorite tunes without any distractions.</b></p><div><br></div>', NULL, NULL, 8, 7, 1, 'FSdfsd', '66846,66064,66845,66848,66849', 'within 30 days', '1', NULL, NULL, 'single_family', NULL, '150-250', 1, 1, 1, 1, 'Once a day', '0', '0', '1', 860, '2023-12-07 09:41:50', 2, '2024-01-11 17:12:40', '2024-01-11 17:12:40', '2', '2', '2', NULL, NULL, 1, '2024-01-11 17:12:40'),
(165, 861, 3, 'Travel accessories', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(166, 862, 2, 'jkkjk', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-01-05 11:11:20', NULL, '2024-01-05 11:11:20', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(167, 863, 3, 'I want to sale 2 bhk property', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 853, '2024-01-09 09:55:43', NULL, '2024-01-09 10:15:02', '2024-01-09 10:15:02', '2', '2', '2', NULL, NULL, 1, '2024-01-09 10:15:02'),
(168, 864, 2, 'I want to buy 2 bhk property', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-01-09 10:21:03', NULL, '2024-01-09 10:21:03', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(169, 865, 2, 'A new post by buyer', 'Lorem ipsum dollar sit', NULL, NULL, 0, 1, 1, 'abc', NULL, 'within 30 days', '1', NULL, NULL, 'single_family', NULL, '75-150', 0, 0, 0, 0, NULL, NULL, '0', '2', NULL, '2024-01-09 13:06:47', 2, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(170, 865, 4, 'A new post by buyer', 'Lorem ipsum dollar sit', NULL, NULL, 0, 1, 1, 'abc', NULL, 'within 30 days', '1', NULL, NULL, 'single_family', NULL, '75-150', 0, 0, 0, 0, NULL, NULL, '0', '2', NULL, '2024-01-09 13:41:13', 4, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(171, 868, 3, 'testing sell post', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-01-24 05:27:31', NULL, '2024-01-24 05:27:31', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(172, 873, 3, '123123', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-02-04 11:39:13', NULL, '2024-02-04 11:39:13', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(173, 874, 3, 'Need to sell my home in bellevue 123, asap', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-02-05 06:10:17', NULL, '2024-02-05 06:10:17', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(174, 876, 3, 'House Test', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 879, '2024-02-05 06:22:08', NULL, '2024-02-08 08:31:15', '2024-02-08 08:31:15', '2', '2', '2', NULL, NULL, 1, '2024-02-08 08:31:15'),
(175, 877, 2, 'Buy', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-02-06 09:28:40', NULL, '2024-02-06 09:28:40', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(176, 880, 2, 'Hello World', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-02-07 03:35:58', NULL, '2024-02-07 03:35:58', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(177, 876, 2, 'Test Ish', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(178, 876, 3, 'post 2', 'asddas', 'sadfs', NULL, 4, 2, 1, NULL, '53456', 'now', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 881, '2024-02-08 12:42:33', 3, '2024-02-08 12:56:44', '2024-02-08 12:44:13', '2', '2', '2', '2024-02-08 00:00:00', NULL, 1, '2024-02-08 12:44:13'),
(179, 876, 3, 'post 3', 'asdas', 'sadfs', NULL, 6, 3, 1, NULL, '21313', 'within 30 days', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-02-08 12:46:29', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(180, 882, 3, 'asfasf', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-02-13 17:53:30', NULL, '2024-02-13 17:53:30', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(181, 883, 2, 'fhasfhAWYHRS', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-02-13 22:28:03', NULL, '2024-02-13 22:28:03', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(182, 859, 2, 'Travel accessories', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(183, 884, 3, 'Sell Post', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-02-20 05:35:29', NULL, '2024-02-20 05:35:29', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(184, 885, 2, 'bUYER pOST', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-02-20 05:37:56', NULL, '2024-02-20 05:37:56', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(185, 884, 2, 'Buyerpost', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(186, 889, 2, 'Test', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-03-09 07:48:07', NULL, '2024-03-09 07:48:07', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(187, 890, 3, 'YPpVaDDcL2', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-03-09 08:06:47', NULL, '2024-03-09 08:06:47', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(188, 889, 3, 'Test', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(189, 892, 3, 'Good House', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-03-22 07:12:18', NULL, '2024-03-22 07:12:18', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(190, 894, 2, 'Buy Home', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-03-23 07:25:07', NULL, '2024-03-23 07:25:07', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(191, 895, 2, 'Buy Home2', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-03-23 07:29:21', NULL, '2024-03-23 07:29:21', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(192, 896, 2, 'Test', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-03-23 21:43:01', NULL, '2024-03-23 21:43:01', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(193, 896, 2, 'Test2', 'abcbakfbkscs ajdbewjkrektj djtpohjtpjphjfpohj hkopjkytopjktp 1232322323232', NULL, NULL, 4, 2, 1, 'asdasd', '91709,92701,92707,92706,93705', 'within 30 days', '1', NULL, NULL, 'condo_townhome', NULL, '400', 1, 0, 0, 0, 'As it arrives', NULL, '0', '2', NULL, '2024-03-23 22:14:31', 2, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(194, 895, 3, 'Good House', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(195, 897, 3, 'My testflats', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-03-26 14:16:30', NULL, '2024-03-26 14:16:30', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(196, 901, 3, 'test', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-04-09 06:22:18', NULL, '2024-04-09 06:22:18', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(197, 902, 2, 'hfhfhy', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-04-24 07:06:25', NULL, '2024-04-24 07:06:25', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(198, 903, 3, 'First post', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-04-24 14:07:43', NULL, '2024-04-24 14:07:43', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(199, 903, 3, 'second post', 'dsdffdffdscschsd ig sg yg g dsg idsigusg fui gsif giuf gi', '11 b pearl road', 'kolkata', 14, 5, 1, NULL, '30224', 'now', '1', '1', '1', 'single_family', '{\"best_features_1\":\"car garage\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-04-24 14:10:09', 3, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(200, 904, 2, 'new23', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 905, '2024-05-04 07:45:31', NULL, '2024-05-04 07:53:17', '2024-05-04 07:53:17', '2', '2', '2', NULL, NULL, 1, '2024-05-04 07:53:17'),
(201, 904, 2, 'property 1', 'some requirement&nbsp;', NULL, NULL, 4, 2, 1, 'asd', '45455,45451,12200,45450,74110', 'within 90 days', '0', NULL, NULL, 'single_family', NULL, '150-250', 1, 0, 1, 1, 'Once a day', NULL, '0', '1', 905, '2024-05-04 07:56:09', 2, '2024-05-04 07:57:02', '2024-05-04 07:57:02', '2', '2', '2', NULL, NULL, 1, '2024-05-04 07:57:02'),
(202, 906, 3, 'Test Sell', 'test sell for system flow <br>', 'SADSDAS', NULL, 4, 2, 1, NULL, '12232', 'undecided', '1', '1', '1', 'single_family', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 905, '2024-05-04 13:11:46', 3, '2024-05-04 13:17:11', '2024-05-04 13:17:11', '2', '2', '2', NULL, NULL, 1, '2024-05-04 13:17:11'),
(203, 907, 2, 'Testing', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, '2024-05-16 04:28:21', NULL, '2024-05-16 04:28:21', NULL, '2', '2', '2', NULL, NULL, 0, NULL),
(204, 907, 3, 'First Post TItle', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2', NULL, NULL, NULL, NULL, NULL, '2', '2', '2', NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `agents_proposals`
--

CREATE TABLE `agents_proposals` (
  `proposals_id` int NOT NULL,
  `agents_user_id` int NOT NULL,
  `agents_users_role_id` int NOT NULL,
  `proposals_title` varchar(100) NOT NULL,
  `proposals_attachments` varchar(200) NOT NULL,
  `type` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1=''files'',2=''html text''',
  `proposals_html` longtext,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=no,1=yes',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_proposals`
--

INSERT INTO `agents_proposals` (`proposals_id`, `agents_user_id`, `agents_users_role_id`, `proposals_title`, `proposals_attachments`, `type`, `proposals_html`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 550, 4, 'proposal not', 'http://127.0.0.1:8000/assets/img/proposale/1663531351.pdf', '1', NULL, '1', '2022-09-18 20:02:31', '2024-02-01 12:10:12'),
(2, 672, 4, 'Test Proposal', 'https://dev.92agents.com/assets/img/proposale/1672126830.pdf', '1', NULL, '0', '2022-12-27 07:40:30', '2022-12-27 07:40:30'),
(3, 672, 4, 'Test123123', 'https://dev.92agents.com/assets/img/proposale/1672126847.pdf', '2', '<b>efwerwrwerwe</b>', '0', '2022-12-27 07:40:47', '2022-12-27 07:40:47'),
(4, 672, 4, 'PROP', 'https://dev.92agents.com/assets/img/proposale/1672349412.pdf', '2', 'DDDFDFD', '0', '2022-12-29 21:30:12', '2022-12-29 21:30:12'),
(5, 709, 4, 'Test Proposal', 'https://dev.92agents.com/assets/img/proposale/1673417294.pdf', '1', NULL, '0', '2023-01-11 06:08:14', '2023-01-11 06:08:14');
INSERT INTO `agents_proposals` (`proposals_id`, `agents_user_id`, `agents_users_role_id`, `proposals_title`, `proposals_attachments`, `type`, `proposals_html`, `is_deleted`, `created_at`, `updated_at`) VALUES
(6, 709, 4, 'Test Proposal', 'https://dev.92agents.com/assets/img/proposale/1673417395.pdf', '2', '<h3 style=\"color: rgb(55, 55, 55); font-size: 17px; text-align: center;\"><span style=\"background-color: rgb(181, 214, 165);\">You\'ve successfully signed up to 92Agents agent.<br></span><span style=\"background-color: rgb(181, 214, 165);\">Your 92Agents agent Account details.<br></span><span style=\"background-color: rgb(181, 214, 165);\">Email - smitha_009@yopmail.com<br></span><span style=\"background-color: rgb(181, 214, 165);\">To activate your account please click&nbsp;<a href=\"https://dev.92agents.com/login?usertype=agent&amp;activation_link=63be4fbf96ae3\" style=\"\">Here</a></span></h3><h2 style=\"font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-feature-settings: revert; font-kerning: revert; font-optical-sizing: revert; font-palette: revert; font-size: revert; font-stretch: revert; font-synthesis: revert; font-variant-east-asian: revert; font-variant-numeric: revert; font-variation-settings: revert; font-weight: revert; forced-color-adjust: revert; text-orientation: revert; text-rendering: revert; -webkit-font-smoothing: revert; -webkit-locale: revert; -webkit-text-orientation: revert; -webkit-writing-mode: revert; writing-mode: revert; zoom: revert; accent-color: revert; place-content: revert; place-items: revert; place-self: revert; alignment-baseline: revert; animation: revert; app-region: revert; appearance: revert; aspect-ratio: revert; backdrop-filter: revert; backface-visibility: revert; background: revert; background-blend-mode: revert; baseline-shift: revert; block-size: revert; border-block: revert; border: revert; border-radius: revert; border-collapse: revert; border-end-end-radius: revert; border-end-start-radius: revert; border-inline: revert; border-start-end-radius: revert; border-start-start-radius: revert; inset: revert; box-shadow: revert; box-sizing: revert; break-after: revert; break-before: revert; break-inside: revert; buffered-rendering: revert; caption-side: revert; caret-color: revert; clear: revert; clip: revert; clip-path: revert; clip-rule: revert; color-interpolation: revert; color-interpolation-filters: revert; color-rendering: revert; color-scheme: revert; columns: revert; column-fill: revert; gap: revert; column-rule: revert; column-span: revert; contain: revert; contain-intrinsic-block-size: revert; contain-intrinsic-size: revert; contain-intrinsic-inline-size: revert; container: revert; content: revert; content-visibility: revert; counter-increment: revert; counter-reset: revert; counter-set: revert; cursor: revert; cx: revert; cy: revert; d: revert; display: revert; dominant-baseline: revert; empty-cells: revert; fill: revert; fill-opacity: revert; fill-rule: revert; filter: revert; flex: revert; flex-flow: revert; float: revert; flood-color: revert; flood-opacity: revert; grid: revert; grid-area: revert; height: revert; hyphenate-character: revert; hyphens: revert; image-orientation: revert; image-rendering: revert; inline-size: revert; inset-block: revert; inset-inline: revert; isolation: revert; lighting-color: revert; line-break: revert; line-height: 30px; list-style: revert; margin-block: revert; margin: revert; margin-inline: revert; marker: revert; mask: revert; mask-type: revert; max-block-size: revert; max-height: revert; max-inline-size: revert; max-width: revert; min-block-size: revert; min-height: revert; min-inline-size: revert; min-width: revert; mix-blend-mode: revert; object-fit: revert; object-position: revert; object-view-box: revert; offset: revert; opacity: revert; order: revert; outline: revert; outline-offset: revert; overflow-anchor: revert; overflow-clip-margin: revert; overflow-wrap: revert; overflow: revert; overscroll-behavior-block: revert; overscroll-behavior-inline: revert; overscroll-behavior: revert; padding-block: revert; padding: revert; padding-inline: revert; page: revert; page-orientation: revert; paint-order: revert; perspective: revert; perspective-origin: revert; pointer-events: revert; position: revert; quotes: revert; r: revert; resize: revert; rotate: revert; ruby-position: revert; rx: revert; ry: revert; scale: revert; scroll-behavior: revert; scroll-margin-block: revert; scroll-margin: revert; scroll-margin-inline: revert; scroll-padding-block: revert; scroll-padding: revert; scroll-padding-inline: revert; scroll-snap-align: revert; scroll-snap-stop: revert; scroll-snap-type: revert; scrollbar-gutter: revert; shape-image-threshold: revert; shape-margin: revert; shape-outside: revert; shape-rendering: revert; size: revert; speak: revert; stop-color: revert; stop-opacity: revert; stroke: revert; stroke-dasharray: revert; stroke-dashoffset: revert; stroke-linecap: revert; stroke-linejoin: revert; stroke-miterlimit: revert; stroke-opacity: revert; stroke-width: revert; tab-size: revert; table-layout: revert; text-align: revert; text-align-last: revert; text-anchor: revert; text-combine-upright: revert; text-decoration: revert; text-decoration-skip-ink: revert; text-emphasis: revert; text-emphasis-position: revert; text-overflow: revert; text-shadow: revert; text-size-adjust: revert; text-underline-offset: revert; text-underline-position: revert; touch-action: revert; transform: revert; transform-box: revert; transform-origin: revert; transform-style: revert; transition: revert; translate: revert; user-select: revert; vector-effect: revert; vertical-align: revert; visibility: revert; border-spacing: revert; -webkit-box-align: revert; -webkit-box-decoration-break: revert; -webkit-box-direction: revert; -webkit-box-flex: revert; -webkit-box-ordinal-group: revert; -webkit-box-orient: revert; -webkit-box-pack: revert; -webkit-box-reflect: revert; -webkit-highlight: revert; -webkit-line-break: revert; -webkit-line-clamp: revert; -webkit-mask-box-image: revert; -webkit-mask: revert; -webkit-mask-composite: revert; -webkit-print-color-adjust: revert; -webkit-rtl-ordering: revert; -webkit-ruby-position: revert; -webkit-tap-highlight-color: revert; -webkit-text-combine: revert; -webkit-text-decorations-in-effect: revert; -webkit-text-fill-color: revert; -webkit-text-security: revert; -webkit-text-stroke-color: revert; -webkit-user-drag: revert; -webkit-user-modify: revert; width: revert; will-change: revert; word-break: revert; x: revert; y: revert; z-index: revert;\"><br></h2><h2 style=\"font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-feature-settings: revert; font-kerning: revert; font-optical-sizing: revert; font-palette: revert; font-size: revert; font-stretch: revert; font-synthesis: revert; font-variant-east-asian: revert; font-variant-numeric: revert; font-variation-settings: revert; font-weight: revert; forced-color-adjust: revert; text-orientation: revert; text-rendering: revert; -webkit-font-smoothing: revert; -webkit-locale: revert; -webkit-text-orientation: revert; -webkit-writing-mode: revert; writing-mode: revert; zoom: revert; accent-color: revert; place-content: revert; place-items: revert; place-self: revert; alignment-baseline: revert; animation: revert; app-region: revert; appearance: revert; aspect-ratio: revert; backdrop-filter: revert; backface-visibility: revert; background: revert; background-blend-mode: revert; baseline-shift: revert; block-size: revert; border-block: revert; border: revert; border-radius: revert; border-collapse: revert; border-end-end-radius: revert; border-end-start-radius: revert; border-inline: revert; border-start-end-radius: revert; border-start-start-radius: revert; inset: revert; box-shadow: revert; box-sizing: revert; break-after: revert; break-before: revert; break-inside: revert; buffered-rendering: revert; caption-side: revert; caret-color: revert; clear: revert; clip: revert; clip-path: revert; clip-rule: revert; color-interpolation: revert; color-interpolation-filters: revert; color-rendering: revert; color-scheme: revert; columns: revert; column-fill: revert; gap: revert; column-rule: revert; column-span: revert; contain: revert; contain-intrinsic-block-size: revert; contain-intrinsic-size: revert; contain-intrinsic-inline-size: revert; container: revert; content: revert; content-visibility: revert; counter-increment: revert; counter-reset: revert; counter-set: revert; cursor: revert; cx: revert; cy: revert; d: revert; display: revert; dominant-baseline: revert; empty-cells: revert; fill: revert; fill-opacity: revert; fill-rule: revert; filter: revert; flex: revert; flex-flow: revert; float: revert; flood-color: revert; flood-opacity: revert; grid: revert; grid-area: revert; height: revert; hyphenate-character: revert; hyphens: revert; image-orientation: revert; image-rendering: revert; inline-size: revert; inset-block: revert; inset-inline: revert; isolation: revert; lighting-color: revert; line-break: revert; line-height: 30px; list-style: revert; margin-block: revert; margin: revert; margin-inline: revert; marker: revert; mask: revert; mask-type: revert; max-block-size: revert; max-height: revert; max-inline-size: revert; max-width: revert; min-block-size: revert; min-height: revert; min-inline-size: revert; min-width: revert; mix-blend-mode: revert; object-fit: revert; object-position: revert; object-view-box: revert; offset: revert; opacity: revert; order: revert; outline: revert; outline-offset: revert; overflow-anchor: revert; overflow-clip-margin: revert; overflow-wrap: revert; overflow: revert; overscroll-behavior-block: revert; overscroll-behavior-inline: revert; overscroll-behavior: revert; padding-block: revert; padding: revert; padding-inline: revert; page: revert; page-orientation: revert; paint-order: revert; perspective: revert; perspective-origin: revert; pointer-events: revert; position: revert; quotes: revert; r: revert; resize: revert; rotate: revert; ruby-position: revert; rx: revert; ry: revert; scale: revert; scroll-behavior: revert; scroll-margin-block: revert; scroll-margin: revert; scroll-margin-inline: revert; scroll-padding-block: revert; scroll-padding: revert; scroll-padding-inline: revert; scroll-snap-align: revert; scroll-snap-stop: revert; scroll-snap-type: revert; scrollbar-gutter: revert; shape-image-threshold: revert; shape-margin: revert; shape-outside: revert; shape-rendering: revert; size: revert; speak: revert; stop-color: revert; stop-opacity: revert; stroke: revert; stroke-dasharray: revert; stroke-dashoffset: revert; stroke-linecap: revert; stroke-linejoin: revert; stroke-miterlimit: revert; stroke-opacity: revert; stroke-width: revert; tab-size: revert; table-layout: revert; text-align: revert; text-align-last: revert; text-anchor: revert; text-combine-upright: revert; text-decoration: revert; text-decoration-skip-ink: revert; text-emphasis: revert; text-emphasis-position: revert; text-overflow: revert; text-shadow: revert; text-size-adjust: revert; text-underline-offset: revert; text-underline-position: revert; touch-action: revert; transform: revert; transform-box: revert; transform-origin: revert; transform-style: revert; transition: revert; translate: revert; user-select: revert; vector-effect: revert; vertical-align: revert; visibility: revert; border-spacing: revert; -webkit-box-align: revert; -webkit-box-decoration-break: revert; -webkit-box-direction: revert; -webkit-box-flex: revert; -webkit-box-ordinal-group: revert; -webkit-box-orient: revert; -webkit-box-pack: revert; -webkit-box-reflect: revert; -webkit-highlight: revert; -webkit-line-break: revert; -webkit-line-clamp: revert; -webkit-mask-box-image: revert; -webkit-mask: revert; -webkit-mask-composite: revert; -webkit-print-color-adjust: revert; -webkit-rtl-ordering: revert; -webkit-ruby-position: revert; -webkit-tap-highlight-color: revert; -webkit-text-combine: revert; -webkit-text-decorations-in-effect: revert; -webkit-text-fill-color: revert; -webkit-text-security: revert; -webkit-text-stroke-color: revert; -webkit-user-drag: revert; -webkit-user-modify: revert; width: revert; will-change: revert; word-break: revert; x: revert; y: revert; z-index: revert;\"></h2><p style=\"color: rgb(55, 55, 55); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 17px; text-align: center;\"></p>', '0', '2023-01-11 06:08:54', '2023-01-11 12:09:55');
INSERT INTO `agents_proposals` (`proposals_id`, `agents_user_id`, `agents_users_role_id`, `proposals_title`, `proposals_attachments`, `type`, `proposals_html`, `is_deleted`, `created_at`, `updated_at`) VALUES
(7, 778, 4, 'Plot', 'https://dev.92agents.com/assets/img/proposale/1679886648.pdf', '2', '<p>sdfsfdsf</p>', '0', '2023-03-27 03:10:48', '2023-03-27 03:10:48'),
(8, 787, 4, 'HWDBS', 'https://dev.92agents.com/assets/img/proposale/1682939257.pdf', '1', NULL, '1', '2023-05-01 11:07:37', '2023-05-01 16:32:27'),
(9, 809, 4, 'bhbhjjhb', 'https://dev.92agents.com/assets/img/proposale/1684146042.pdf', '2', '&lt;h1&gt;Dheeraj&lt;/h1&gt;', '0', '2023-05-15 10:20:42', '2023-05-15 10:20:42'),
(10, 670, 4, 'Test Proposal', 'https://dev.92agents.com/assets/img/proposale/1691649775.pdf', '2', 'This is Test proposal', '1', '2023-08-10 06:42:55', '2023-08-17 15:22:11'),
(11, 670, 4, 'https://drive.google.com/file/d/1tkPyHCuEAcNjSex7wJIlo6ikw2OleQY-/view?usp=drive_link', 'https://dev.92agents.com/assets/img/proposale/1691650290.pdf', '2', 'https://drive.google.com/file/d/1tkPyHCuEAcNjSex7wJIlo6ikw2OleQY-/view?usp=drive_link', '1', '2023-08-10 06:51:30', '2023-08-10 11:51:40'),
(12, 670, 4, 'Test', 'https://dev.92agents.com/assets/img/proposale/1691652918.pdf', '2', 'Test', '1', '2023-08-10 07:35:18', '2023-08-17 15:21:58'),
(13, 832, 4, 'iuytrertyuioiuytrertyuiooiuyqwertyuioploruni the big brown fox jumps ovwr to th elittle lazy dog', 'https://dev.92agents.com/assets/img/proposale/1692250580.pdf', '2', 'nckusdfbcjhbesmfbmhdbfhbcdmmhd', '1', '2023-08-17 05:36:20', '2023-08-17 15:33:30'),
(14, 670, 4, '1. Open the URL\' https://d', 'https://dev.92agents.com/assets/img/proposale/1692268652.pdf', '2', '<span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">1. Open the URL\' </span><a href=\"https://dev.92agents.com/\" class=\"waffle-rich-text-link\" style=\"text-decoration-line: underline; color: rgb(17, 85, 204); font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">https://dev.92agents.com/</a><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">\' in a browser.\r\n2. Click on Sign In and click on Login as an Agent.\r\n3. Click on the \'Proposals\' appearing under \'Other Resources\'.\r\n4. Click on Upload New Proposal.\r\n5. Enter the larger text in Proposal Title and Type Text field (selected Text HTML).\r\n6. Click on Save.\r\n7. Internal Server error appears.\r\n8. No view of any already added proposal.\r\n9. Proposal is displayed in View mode.\r\n10. Now click on Edit and observe the issue.</span><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">1. Open the URL\' </span><a href=\"https://dev.92agents.com/\" class=\"waffle-rich-text-link\" style=\"text-decoration-line: underline; color: rgb(17, 85, 204); font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">https://dev.92agents.com/</a><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">\' in a browser.\r\n2. Click on Sign In and click on Login as an Agent.\r\n3. Click on the \'Proposals\' appearing under \'Other Resources\'.\r\n4. Click on Upload New Proposal.\r\n5. Enter the larger text in Proposal Title and Type Text field (selected Text HTML).\r\n6. Click on Save.\r\n7. Internal Server error appears.\r\n8. No view of any already added proposal.\r\n9. Proposal is displayed in View mode.\r\n10. Now click on Edit and observe the issue.</span><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">1. Open the URL\' </span><a href=\"https://dev.92agents.com/\" class=\"waffle-rich-text-link\" style=\"text-decoration-line: underline; color: rgb(17, 85, 204); font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">https://dev.92agents.com/</a><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">\' in a browser.\r\n2. Click on Sign In and click on Login as an Agent.\r\n3. Click on the \'Proposals\' appearing under \'Other Resources\'.\r\n4. Click on Upload New Proposal.\r\n5. Enter the larger text in Proposal Title and Type Text field (selected Text HTML).\r\n6. Click on Save.\r\n7. Internal Server error appears.\r\n8. No view of any already added proposal.\r\n9. Proposal is displayed in View mode.\r\n10. Now click on Edit and observe the issue.</span><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">1. Open the URL\' </span><a href=\"https://dev.92agents.com/\" class=\"waffle-rich-text-link\" style=\"text-decoration-line: underline; color: rgb(17, 85, 204); font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">https://dev.92agents.com/</a><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">\' in a browser.\r\n2. Click on Sign In and click on Login as an Agent.\r\n3. Click on the \'Proposals\' appearing under \'Other Resources\'.\r\n4. Click on Upload New Proposal.\r\n5. Enter the larger text in Proposal Title and Type Text field (selected Text HTML).\r\n6. Click on Save.\r\n7. Internal Server error appears.\r\n8. No view of any already added proposal.\r\n9. Proposal is displayed in View mode.\r\n10. Now click on Edit and observe the issue.</span><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">1. Open the URL\' </span><a href=\"https://dev.92agents.com/\" class=\"waffle-rich-text-link\" style=\"text-decoration-line: underline; color: rgb(17, 85, 204); font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">https://dev.92agents.com/</a><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">\' in a browser.\r\n2. Click on Sign In and click on Login as an Agent.\r\n3. Click on the \'Proposals\' appearing under \'Other Resources\'.\r\n4. Click on Upload New Proposal.\r\n5. Enter the larger text in Proposal Title and Type Text field (selected Text HTML).\r\n6. Click on Save.\r\n7. Internal Server error appears.\r\n8. No view of any already added proposal.\r\n9. Proposal is displayed in View mode.\r\n10. Now click on Edit and observe the issue.</span><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">1. Open the URL\' </span><a href=\"https://dev.92agents.com/\" class=\"waffle-rich-text-link\" style=\"text-decoration-line: underline; color: rgb(17, 85, 204); font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">https://dev.92agents.com/</a><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">\' in a browser.\r\n2. Click on Sign In and click on Login as an Agent.\r\n3. Click on the \'Proposals\' appearing under \'Other Resources\'.\r\n4. Click on Upload New Proposal.\r\n5. Enter the larger text in Proposal Title and Type Text field (selected Text HTML).\r\n6. Click on Save.\r\n7. Internal Server error appears.\r\n8. No view of any already added proposal.\r\n9. Proposal is displayed in View mode.\r\n10. Now click on Edit and observe the issue.</span><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">1. Open the URL\' </span><a href=\"https://dev.92agents.com/\" class=\"waffle-rich-text-link\" style=\"text-decoration-line: underline; color: rgb(17, 85, 204); font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">https://dev.92agents.com/</a><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">\' in a browser.\r\n2. Click on Sign In and click on Login as an Agent.\r\n3. Click on the \'Proposals\' appearing under \'Other Resources\'.\r\n4. Click on Upload New Proposal.\r\n5. Enter the larger text in Proposal Title and Type Text field (selected Text HTML).\r\n6. Click on Save.\r\n7. Internal Server error appears.\r\n8. No view of any already added proposal.\r\n9. Proposal is displayed in View mode.\r\n10. Now click on Edit and observe the issue.</span><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">1. Open the URL\' </span><a href=\"https://dev.92agents.com/\" class=\"waffle-rich-text-link\" style=\"text-decoration-line: underline; color: rgb(17, 85, 204); font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">https://dev.92agents.com/</a><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">\' in a browser.\r\n2. Click on Sign In and click on Login as an Agent.\r\n3. Click on the \'Proposals\' appearing under \'Other Resources\'.\r\n4. Click on Upload New Proposal.\r\n5. Enter the larger text in Proposal Title and Type Text field (selected Text HTML).\r\n6. Click on Save.\r\n7. Internal Server error appears.\r\n8. No view of any already added proposal.\r\n9. Proposal is displayed in View mode.\r\n10. Now click on Edit and observe the issue.</span><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">1. Open the URL\' </span><a href=\"https://dev.92agents.com/\" class=\"waffle-rich-text-link\" style=\"text-decoration-line: underline; color: rgb(17, 85, 204); font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">https://dev.92agents.com/</a><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">\' in a browser.\r\n2. Click on Sign In and click on Login as an Agent.\r\n3. Click on the \'Proposals\' appearing under \'Other Resources\'.\r\n4. Click on Upload New Proposal.\r\n5. Enter the larger text in Proposal Title and Type Text field (selected Text HTML).\r\n6. Click on Save.\r\n7. Internal Server error appears.\r\n8. No view of any already added proposal.\r\n9. Proposal is displayed in View mode.\r\n10. Now click on Edit and observe the issue.</span><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">1. Open the URL\' </span><a href=\"https://dev.92agents.com/\" class=\"waffle-rich-text-link\" style=\"text-decoration-line: underline; color: rgb(17, 85, 204); font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">https://dev.92agents.com/</a><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">\' in a browser.\r\n2. Click on Sign In and click on Login as an Agent.\r\n3. Click on the \'Proposals\' appearing under \'Other Resources\'.\r\n4. Click on Upload New Proposal.\r\n5. Enter the larger text in Proposal Title and Type Text field (selected Text HTML).\r\n6. Click on Save.\r\n7. Internal Server error appears.\r\n8. No view of any already added proposal.\r\n9. Proposal is displayed in View mode.\r\n10. Now click on Edit and observe the issue.</span><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">1. Open the URL\' </span><a href=\"https://dev.92agents.com/\" class=\"waffle-rich-text-link\" style=\"text-decoration-line: underline; color: rgb(17, 85, 204); font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">https://dev.92agents.com/</a><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">\' in a browser.\r\n2. Click on Sign In and click on Login as an Agent.\r\n3. Click on the \'Proposals\' appearing under \'Other Resources\'.\r\n4. Click on Upload New Proposal.\r\n5. Enter the larger text in Proposal Title and Type Text field (selected Text HTML).\r\n6. Click on Save.\r\n7. Internal Server error appears.\r\n8. No view of any already added proposal.\r\n9. Proposal is displayed in View mode.\r\n10. Now click on Edit and observe the issue.</span><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">1. Open the URL\' </span><a href=\"https://dev.92agents.com/\" class=\"waffle-rich-text-link\" style=\"text-decoration-line: underline; color: rgb(17, 85, 204); font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">https://dev.92agents.com/</a><span style=\"font-family: docs-Calibri; font-size: 15px; white-space-collapse: preserve; text-decoration-skip-ink: none;\">\' in a browser.\r\n2. Click on Sign In and click on Login as an Agent.\r\n3. Click on the \'Proposals\' appearing under \'Other Resources\'.\r\n4. Click on Upload New Proposal.\r\n5. Enter the larger text in Proposal Title and Type Text field (selected Text HTML).\r\n6. Click on Save.\r\n7. Internal Server error appears.\r\n8. No view of any already added proposal.\r\n9. Proposal is displayed in View mode.\r\n10. Now click on Edit and observe the issue.</span>', '1', '2023-08-17 10:34:31', '2023-08-17 15:39:59'),
(15, 670, 4, 'It is a long established fact tha', 'https://dev.92agents.com/assets/img/proposale/1692361999.pdf', '1', NULL, '0', '2023-08-18 12:33:19', '2023-08-18 12:33:19'),
(16, 843, 4, 'Test', 'https://dev.92agents.com/assets/img/proposale/1692422569.pdf', '1', NULL, '0', '2023-08-19 05:22:49', '2023-08-19 05:22:49');

-- --------------------------------------------------------

--
-- Table structure for table `agents_question`
--

CREATE TABLE `agents_question` (
  `question_id` int NOT NULL,
  `question` longtext NOT NULL,
  `add_by` int NOT NULL COMMENT 'id',
  `add_by_role` int NOT NULL COMMENT 'role id',
  `question_type` enum('1','2','3','4','5') NOT NULL COMMENT '1=admin,2=Buyer,3=seller,4=Agent,5=New User',
  `importance` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=no,1=yes',
  `survey` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=no,1=yes',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1' COMMENT '0="De-active", 1="active"',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_question`
--

INSERT INTO `agents_question` (`question_id`, `question`, `add_by`, `add_by_role`, `question_type`, `importance`, `survey`, `is_deleted`, `status`, `created_at`, `updated_at`) VALUES
(1, 'test ok', 548, 2, '4', '0', '0', '0', 1, '2022-09-16 03:34:41', '2024-01-31 16:28:42'),
(2, 'http://127.0.0.1:8000sdssd', 548, 2, '4', '0', '1', '0', 1, '2022-09-16 03:36:08', '2022-09-16 04:09:46'),
(3, 'test2', 548, 2, '4', '0', '0', '0', 1, '2022-09-16 03:39:19', '2022-09-16 03:39:19'),
(4, 'test3 ewwrwrwerd dd', 548, 2, '4', '0', '0', '0', 1, '2022-09-16 03:41:27', '2022-09-16 04:04:13'),
(5, 'add question', 548, 2, '4', '0', '0', '0', 1, '2022-09-16 04:30:29', '2022-09-16 04:30:29'),
(6, 'Test Question', 645, 3, '4', '0', '1', '0', 1, '2022-12-08 20:20:13', '2022-12-08 20:20:25'),
(7, 'sad', 1, 1, '2', '0', '0', '1', 1, '2022-12-09 12:16:22', '2022-12-09 12:16:56'),
(8, 'Test', 1, 1, '3', '0', '0', '1', 1, '2022-12-09 12:17:54', '2022-12-09 12:17:54'),
(9, 'Test3', 1, 1, '3', '0', '0', '0', 1, '2022-12-09 12:22:18', '2022-12-09 12:22:18'),
(10, 'test4', 1, 1, '2', '0', '0', '0', 1, '2022-12-09 12:22:29', '2022-12-09 12:22:29'),
(11, 'test44', 1, 1, '3', '0', '1', '1', 1, '2022-12-09 12:22:51', '2023-01-10 03:47:07'),
(12, 'how are you', 548, 2, '3', '0', '0', '1', 1, '2022-12-09 12:23:00', '2024-01-27 14:48:03'),
(13, 'mmm', 656, 3, '4', '0', '1', '0', 1, '2022-12-12 11:30:59', '2022-12-12 11:30:59'),
(14, ',,,,', 656, 3, '4', '0', '1', '0', 1, '2022-12-12 11:31:13', '2022-12-12 11:31:13'),
(15, 'fdfhdfhdf', 651, 2, '4', '1', '0', '0', 1, '2022-12-16 14:49:16', '2022-12-16 15:15:56'),
(16, 'I have an property if won to buy?', 625, 4, '2', '0', '0', '0', 1, '2022-12-16 19:11:28', '2022-12-16 19:11:28'),
(17, 'Test12321312', 671, 3, '4', '1', '1', '0', 1, '2022-12-27 13:00:23', '2022-12-27 13:00:23'),
(18, 'Test123123', 671, 3, '4', '1', '1', '0', 1, '2022-12-27 13:00:37', '2022-12-27 13:00:37'),
(19, 'Test123123', 671, 3, '4', '1', '1', '0', 1, '2022-12-27 13:01:06', '2022-12-27 13:01:06'),
(20, 'Test12321', 671, 3, '4', '0', '0', '0', 1, '2022-12-27 13:01:24', '2022-12-27 13:01:24'),
(21, 'Test12312', 671, 3, '4', '1', '1', '0', 1, '2022-12-27 13:02:20', '2022-12-27 13:02:20'),
(22, 'Add Question To Importance ListAdd Question To Importance ListAdd Question To Importance ListAdd Question To Importance ListAdd Question To Importance ListAdd Question To Importance ListAdd Question To Importance ListAdd Question To Importance ListAdd Question To Importance ListAdd Question To Importance ListAdd Question To Importance List', 671, 3, '4', '1', '0', '0', 1, '2022-12-27 13:02:55', '2024-02-04 14:34:34'),
(23, 'xdsdfsdfds', 671, 3, '4', '1', '1', '0', 1, '2022-12-27 13:03:55', '2022-12-27 13:04:27'),
(24, 'Teststewrwere', 671, 3, '4', '1', '1', '0', 1, '2022-12-27 13:08:58', '2022-12-27 13:08:58'),
(25, 'Teststewrwere', 671, 3, '4', '1', '1', '0', 1, '2022-12-27 13:09:38', '2022-12-27 13:09:38'),
(26, 'Teststewrwere', 671, 3, '4', '0', '0', '0', 1, '2022-12-27 13:09:42', '2022-12-27 13:10:06'),
(27, 'Test12312312', 671, 3, '4', '1', '0', '0', 1, '2022-12-27 13:10:22', '2022-12-27 13:10:22'),
(28, 'Test12312312', 671, 3, '4', '1', '0', '0', 1, '2022-12-27 13:10:53', '2022-12-27 13:10:53'),
(29, 'Test12312312', 671, 3, '4', '1', '1', '0', 1, '2022-12-27 13:11:26', '2022-12-27 13:11:26'),
(30, 'Test1231231', 671, 3, '4', '1', '1', '0', 1, '2022-12-27 13:11:34', '2022-12-27 13:11:34'),
(31, 'Tewtrewasadasdasd', 672, 4, '2', '0', '1', '0', 1, '2022-12-27 13:43:06', '2022-12-27 13:43:57'),
(32, 'ewrewrew', 672, 4, '3', '0', '0', '0', 1, '2022-12-27 13:43:23', '2022-12-27 13:45:00'),
(33, 'asdasda', 672, 4, '2', '0', '1', '0', 1, '2022-12-27 13:45:49', '2022-12-27 13:45:49'),
(34, 'asdasdasd', 672, 4, '2', '0', '1', '0', 1, '2022-12-27 13:46:01', '2022-12-27 13:46:01'),
(35, 'sdasdas', 672, 4, '3', '0', '1', '0', 1, '2022-12-27 13:46:17', '2022-12-27 13:46:17'),
(36, 'fd', 672, 4, '2', '0', '1', '0', 1, '2022-12-30 02:16:34', '2022-12-30 02:16:34'),
(37, 'fdd', 672, 4, '3', '0', '1', '0', 1, '2022-12-30 02:16:59', '2022-12-30 02:16:59'),
(38, 'ddddddd', 672, 4, '2', '0', '0', '0', 1, '2022-12-30 02:17:25', '2022-12-30 02:32:33'),
(39, 'hamza dev test', 672, 4, '2', '0', '0', '0', 1, '2022-12-30 02:21:10', '2022-12-30 02:21:27'),
(40, 'dsssssassasa', 672, 4, '2', '0', '0', '0', 1, '2022-12-30 02:22:16', '2022-12-30 02:22:16'),
(41, 'f', 672, 4, '2', '0', '0', '0', 1, '2022-12-30 02:33:43', '2022-12-30 02:33:51'),
(42, 'add q', 549, 3, '4', '1', '1', '0', 1, '2022-12-30 02:36:55', '2022-12-30 02:36:55'),
(43, 'add q', 549, 3, '4', '1', '1', '0', 1, '2022-12-30 02:39:51', '2022-12-30 02:39:51'),
(44, 'add q', 549, 3, '4', '1', '1', '0', 1, '2022-12-30 02:40:12', '2022-12-30 02:40:12'),
(45, 'ok', 549, 3, '4', '1', '1', '0', 1, '2022-12-30 02:40:30', '2022-12-30 02:40:30'),
(46, 'ok', 549, 3, '4', '1', '1', '0', 1, '2022-12-30 02:42:48', '2022-12-30 02:42:48'),
(47, 'n', 549, 3, '4', '1', '1', '0', 1, '2022-12-30 02:43:38', '2022-12-30 02:43:38'),
(48, 'v', 549, 3, '4', '1', '1', '0', 1, '2022-12-30 02:44:07', '2022-12-30 02:44:07'),
(49, 'Thus is Question No.1', 707, 2, '4', '1', '1', '0', 1, '2023-01-09 14:42:13', '2023-01-09 14:42:13'),
(50, 'This is Question No.2', 707, 2, '4', '1', '1', '0', 1, '2023-01-09 14:42:28', '2023-01-09 14:42:28'),
(51, 'This is Question No. 3', 707, 2, '4', '1', '1', '0', 1, '2023-01-09 14:43:07', '2023-01-09 14:43:07'),
(52, 'test6623', 1, 1, '3', '0', '1', '0', 1, '2023-01-10 02:57:11', '2023-04-29 16:03:47'),
(53, 'Test Question2', 709, 4, '2', '0', '0', '0', 1, '2023-01-11 12:13:57', '2023-01-11 12:51:18'),
(54, 'Test Question2', 709, 4, '2', '0', '1', '0', 1, '2023-01-11 12:14:22', '2023-01-11 12:14:22'),
(55, 'Test Question3', 709, 4, '2', '0', '1', '0', 1, '2023-01-11 12:14:35', '2023-01-11 12:14:35'),
(56, 'Test Question11', 709, 4, '2', '0', '1', '0', 1, '2023-01-11 12:16:32', '2023-01-11 12:16:32'),
(57, 'Test Question2', 709, 4, '2', '0', '0', '0', 1, '2023-01-11 12:16:55', '2023-01-11 12:54:35'),
(58, 'Test QUestion21', 709, 4, '3', '0', '1', '0', 1, '2023-01-11 12:17:22', '2023-01-11 12:17:22'),
(59, 'Test Question22', 709, 4, '3', '0', '1', '0', 1, '2023-01-11 12:17:38', '2023-01-11 12:17:38'),
(60, 'Favorite Movie', 709, 4, '2', '0', '1', '0', 1, '2023-01-11 12:18:22', '2023-01-11 12:18:22'),
(61, 'aDaAD', 656, 3, '4', '1', '1', '0', 1, '2023-01-11 14:12:00', '2023-01-11 14:12:00'),
(62, 'Test', 656, 3, '4', '1', '1', '0', 1, '2023-01-11 14:12:07', '2023-01-11 14:12:07'),
(63, 'test', 656, 3, '4', '1', '1', '0', 1, '2023-01-11 14:13:36', '2023-01-11 14:13:36'),
(64, 'asddadasd', 656, 3, '4', '1', '1', '0', 1, '2023-01-11 14:20:14', '2023-01-11 14:20:14'),
(65, 'can you reduce the commission', 716, 3, '4', '1', '0', '0', 1, '2023-01-21 11:58:25', '2023-01-21 11:58:25'),
(66, 'Favorite Place to visit', 707, 3, '4', '1', '1', '0', 1, '2023-01-31 13:06:55', '2023-01-31 13:06:55'),
(67, 'Field of Occupation', 707, 3, '4', '1', '1', '0', 1, '2023-01-31 13:07:27', '2023-01-31 13:07:27'),
(68, 'Place of Birth', 707, 3, '4', '0', '1', '0', 1, '2023-01-31 13:07:51', '2023-01-31 13:07:51'),
(69, 'First Name', 707, 3, '4', '0', '0', '0', 1, '2023-01-31 13:08:22', '2023-01-31 13:09:06'),
(70, 'This is Guru', 709, 4, '3', '0', '1', '0', 1, '2023-01-31 18:06:51', '2023-01-31 18:06:51'),
(71, 'hello', 735, 4, '2', '0', '0', '0', 1, '2023-02-05 03:17:54', '2023-02-05 03:25:17'),
(72, 'helo3', 735, 4, '2', '0', '0', '0', 1, '2023-02-05 03:22:49', '2023-02-05 03:25:26'),
(73, 'TEST QUESTION 1', 739, 2, '4', '1', '0', '0', 1, '2023-02-05 15:53:41', '2023-02-05 15:53:41'),
(74, 'TEST2', 739, 2, '4', '1', '0', '0', 1, '2023-02-05 15:54:11', '2023-02-05 15:54:11'),
(75, 'how to sell my home instantly', 762, 3, '4', '1', '1', '0', 1, '2023-03-03 14:46:49', '2023-03-03 14:46:49'),
(76, 'what is agent commission rate', 762, 3, '4', '1', '1', '0', 1, '2023-03-03 14:50:58', '2023-03-03 14:50:58'),
(77, 'test10', 763, 4, '2', '0', '0', '0', 1, '2023-03-03 16:43:03', '2023-03-03 16:46:47'),
(78, 'iekkdl,vd', 763, 4, '2', '0', '0', '0', 1, '2023-03-03 16:45:18', '2023-03-03 16:46:39'),
(79, 'foeiowpmf', 763, 4, '2', '0', '0', '0', 1, '2023-03-03 16:47:55', '2023-03-03 16:48:03'),
(80, 'ghieoewkrpwe', 763, 4, '2', '0', '1', '0', 1, '2023-03-03 16:49:25', '2023-03-03 16:49:25'),
(81, 'How many years of experience in this field?', 767, 3, '4', '1', '1', '0', 1, '2023-03-16 22:41:27', '2023-03-16 22:41:27'),
(82, 'Do you have any idea about the MLS ?', 767, 3, '4', '0', '1', '0', 1, '2023-03-16 22:42:28', '2023-03-16 22:42:28'),
(83, 'test ques 1', 784, 3, '4', '1', '1', '0', 1, '2023-04-13 15:42:45', '2023-04-13 15:42:45'),
(84, 'asdasd', 784, 3, '4', '0', '0', '0', 1, '2023-04-13 15:55:07', '2023-04-13 15:55:07'),
(85, 'test 1 quest', 786, 4, '3', '0', '1', '0', 1, '2023-04-13 16:29:14', '2023-04-13 16:29:14'),
(86, 'zczxczxczxc', 784, 3, '4', '0', '0', '0', 1, '2023-04-13 17:17:51', '2023-04-13 17:17:51'),
(87, '123asdaw', 784, 3, '4', '0', '0', '0', 1, '2023-04-13 17:18:22', '2023-04-13 17:18:22'),
(88, 'asdcvbf', 784, 3, '4', '0', '0', '0', 1, '2023-04-13 17:18:37', '2023-04-13 17:18:37'),
(89, 'New Book?', 787, 4, '2', '0', '1', '0', 1, '2023-05-02 10:25:39', '2023-05-02 10:25:39'),
(90, 'NEWJE', 787, 4, '3', '0', '0', '0', 1, '2023-05-02 10:26:02', '2023-05-02 10:26:02'),
(91, 'hwyje', 787, 4, '2', '0', '0', '0', 1, '2023-05-02 10:28:15', '2023-05-13 11:50:08'),
(92, 'ds', 787, 4, '3', '0', '0', '0', 1, '2023-05-13 11:50:24', '2023-05-13 11:50:24'),
(93, 'text', 548, 2, '1', '0', '0', '0', 1, '2023-05-15 12:15:33', '2023-05-15 12:15:33'),
(94, 'JDnsh', 809, 4, '2', '0', '0', '0', 1, '2023-05-15 14:31:34', '2023-05-15 15:17:52'),
(95, 'nw', 809, 4, '3', '0', '1', '0', 1, '2023-05-15 15:17:29', '2023-05-15 15:17:29'),
(96, 'fdcsf', 809, 4, '2', '0', '0', '0', 1, '2023-05-15 15:17:45', '2023-05-15 15:18:07'),
(97, 'Is black dark?', 810, 3, '4', '1', '0', '0', 1, '2023-05-20 10:21:25', '2023-05-20 10:21:25'),
(98, 'What is your name?', 810, 3, '4', '1', '1', '0', 1, '2023-05-22 14:52:10', '2023-05-22 14:52:10'),
(99, 'HOWZ YOUR pricessissac', 787, 4, '2', '0', '1', '0', 1, '2023-05-25 17:12:08', '2023-05-25 17:39:04'),
(100, 'HOWZ your Prince charlie', 787, 4, '3', '0', '0', '0', 1, '2023-05-25 17:23:19', '2023-05-25 17:41:44'),
(101, 'this is first question for post', 828, 3, '4', '1', '1', '0', 1, '2023-06-03 14:43:55', '2023-06-03 14:43:55'),
(102, 'Question 2', 828, 3, '4', '1', '1', '0', 1, '2023-06-03 14:46:30', '2023-06-03 14:46:30'),
(103, 'question 3', 828, 3, '4', '1', '1', '0', 1, '2023-06-03 14:46:45', '2023-06-03 14:46:45'),
(104, 'text', 834, 2, '1', '0', '0', '0', 1, '2023-07-17 11:44:25', '2023-07-17 11:44:25'),
(105, 'text', 548, 2, '1', '0', '0', '0', 1, '2023-07-17 12:06:38', '2023-07-17 12:06:38'),
(106, 'text', 548, 2, '1', '0', '0', '0', 1, '2023-07-18 13:32:52', '2023-07-18 13:32:52'),
(107, 'Question 1', 839, 3, '1', '0', '1', '0', 1, '2023-07-18 14:49:13', '2023-07-18 14:51:58'),
(108, 'Question 2', 839, 3, '', '0', '0', '0', 1, '2023-07-18 15:00:55', '2023-07-18 15:00:55'),
(109, 'qwert', 839, 3, '4', '1', '0', '0', 1, '2023-07-18 15:43:34', '2023-07-18 15:43:34'),
(110, 'qwert', 839, 3, '4', '1', '0', '0', 1, '2023-07-18 15:44:48', '2023-07-18 15:44:48'),
(111, 'Question 2', 839, 3, '', '0', '0', '0', 1, '2023-07-18 15:45:19', '2023-07-18 15:45:19'),
(112, 'Mirando mi casa, ¿qué impedimentos ven para vender? ¿Hay alguna mejora que crea que podamos hacer que nos ayude a vender más rápido o por más dinero?', 840, 3, '4', '0', '1', '0', 1, '2023-08-01 11:39:44', '2023-08-10 16:18:32'),
(113, 'How long have you been selling real estate?', 840, 3, '4', '0', '0', '0', 1, '2023-08-01 11:41:06', '2023-08-01 11:41:24'),
(114, 'Test', 840, 3, '4', '0', '0', '0', 1, '2023-08-01 11:45:11', '2023-08-17 14:40:06'),
(115, 'fsfsd', 840, 3, '4', '1', '0', '0', 1, '2023-08-01 14:16:12', '2023-08-17 14:38:54'),
(116, 'sdfhhdsf', 840, 3, '4', '0', '0', '0', 1, '2023-08-01 14:16:55', '2023-08-17 14:36:21'),
(117, 'yewyr', 840, 3, '4', '0', '1', '0', 1, '2023-08-01 14:20:43', '2023-08-17 14:39:05'),
(118, 'Test123', 840, 3, '4', '0', '0', '0', 1, '2023-08-01 14:21:24', '2023-08-01 14:24:37'),
(119, 'Rersr', 840, 3, '4', '0', '0', '0', 1, '2023-08-01 14:26:05', '2023-08-10 16:20:56'),
(120, 'a', 841, 2, '4', '1', '1', '0', 1, '2023-08-01 16:01:28', '2023-08-01 16:01:28'),
(121, 'B', 841, 2, '4', '1', '1', '0', 1, '2023-08-01 16:01:38', '2023-08-01 16:01:38'),
(122, 'asd', 841, 2, '4', '1', '1', '0', 1, '2023-08-01 16:01:55', '2023-08-01 16:01:55'),
(123, 'adsada', 841, 2, '4', '1', '1', '0', 1, '2023-08-01 16:02:05', '2023-08-01 16:02:05'),
(124, 'Test', 846, 3, '4', '1', '1', '0', 1, '2023-08-09 15:40:59', '2023-08-09 15:41:56'),
(125, 'Testweewe', 846, 3, '4', '1', '1', '0', 1, '2023-08-09 15:44:04', '2023-08-09 15:44:25'),
(126, 'sffsaf', 846, 3, '4', '1', '1', '0', 1, '2023-08-09 15:47:09', '2023-08-09 15:48:29'),
(127, 'ad', 846, 3, '4', '1', '1', '0', 1, '2023-08-09 15:52:08', '2023-08-09 15:52:08'),
(128, 'ad', 846, 3, '4', '0', '1', '0', 1, '2023-08-09 15:52:22', '2023-08-09 15:52:22'),
(129, 'Test', 846, 3, '4', '1', '0', '0', 1, '2023-08-09 15:53:20', '2024-02-04 14:35:47'),
(130, 'twetwtew', 670, 4, '3', '0', '1', '0', 1, '2023-08-10 15:17:18', '2023-08-10 15:17:18'),
(131, 'Testtsd', 670, 4, '3', '0', '1', '0', 1, '2023-08-10 15:17:31', '2023-08-10 15:17:31'),
(132, 'sdfsdfsd', 670, 4, '3', '0', '1', '0', 1, '2023-08-10 15:17:41', '2023-08-10 15:17:41'),
(133, 'Test Question', 670, 4, '3', '0', '0', '0', 1, '2023-08-10 15:19:36', '2023-08-10 15:19:36'),
(134, 'sdas', 670, 4, '3', '0', '0', '0', 1, '2023-08-10 15:23:21', '2023-08-10 15:23:21'),
(135, 'y54wertyu', 839, 3, '4', '0', '1', '0', 1, '2023-08-17 10:20:11', '2023-08-17 10:23:04'),
(136, 'kytdfgh', 839, 3, '4', '0', '1', '0', 1, '2023-08-17 10:23:12', '2023-08-17 10:29:55'),
(137, 'uytrewerty', 839, 3, '4', '0', '1', '0', 1, '2023-08-17 10:28:51', '2023-08-17 10:29:50'),
(138, 'kjhgfdfgh', 839, 3, '4', '0', '1', '0', 1, '2023-08-17 10:29:20', '2023-08-17 10:29:45'),
(139, 'jtrertyu', 839, 3, '4', '0', '0', '0', 1, '2023-08-17 10:29:31', '2023-08-17 10:29:39'),
(140, 'qwerty', 670, 4, '3', '0', '0', '0', 1, '2023-08-17 12:04:26', '2023-08-17 12:04:26'),
(141, 'qwert', 670, 4, '3', '0', '0', '0', 1, '2023-08-17 12:16:09', '2023-08-17 12:16:09'),
(142, 'qwert', 670, 4, '3', '0', '1', '0', 1, '2023-08-17 12:17:56', '2023-08-17 12:17:56'),
(143, 'qwewqwewq', 670, 4, '3', '0', '1', '0', 1, '2023-08-17 12:22:59', '2023-08-17 12:22:59'),
(144, 'qwerewqwe', 670, 4, '3', '0', '1', '0', 1, '2023-08-17 12:23:23', '2023-08-17 12:23:23'),
(145, 'Test', 670, 4, '2', '0', '1', '0', 1, '2023-08-17 15:18:57', '2023-08-17 15:18:57'),
(146, 'Test', 670, 4, '2', '0', '1', '0', 1, '2023-08-17 15:19:21', '2023-08-17 15:19:21'),
(147, 'Tst', 670, 4, '2', '0', '1', '0', 1, '2023-08-17 15:19:42', '2023-08-17 15:19:42'),
(148, 'qwert', 839, 3, '4', '1', '0', '0', 1, '2023-08-17 15:22:02', '2023-08-17 15:22:02'),
(149, 'Test', 840, 3, '4', '1', '1', '0', 1, '2023-08-17 15:26:24', '2023-08-17 15:26:24'),
(150, 'Testt', 840, 3, '4', '0', '0', '0', 1, '2023-08-17 15:26:37', '2023-08-17 15:26:37'),
(151, 'Testt', 840, 3, '4', '0', '0', '0', 1, '2023-08-17 15:27:27', '2023-08-17 15:27:27'),
(152, 'sdfkhshfhds', 840, 3, '4', '1', '1', '0', 1, '2023-08-17 15:27:40', '2023-08-17 15:27:40'),
(153, 'sdfdfbgdfgfd', 840, 3, '4', '0', '0', '0', 1, '2023-08-17 15:27:51', '2023-08-17 15:27:51'),
(154, 'Testd', 840, 3, '4', '1', '1', '0', 1, '2023-08-17 15:28:30', '2023-08-17 15:28:30'),
(155, 'sdfhdshfs', 840, 3, '4', '0', '1', '0', 1, '2023-08-17 15:28:40', '2023-08-19 10:02:08'),
(156, 'dfjgjfd', 840, 3, '4', '0', '1', '0', 1, '2023-08-17 15:28:54', '2023-08-19 10:01:43'),
(157, 'dfhdhgd', 840, 3, '4', '1', '0', '0', 1, '2023-08-17 15:29:05', '2023-08-17 15:29:33'),
(158, 'asdasd', 670, 4, '3', '0', '1', '0', 1, '2023-08-17 16:12:05', '2023-08-17 16:12:05'),
(159, 'Test', 670, 4, '3', '0', '1', '0', 1, '2023-08-17 16:12:13', '2023-08-17 16:12:13'),
(160, 'Guru', 670, 4, '3', '0', '1', '0', 1, '2023-08-17 16:12:21', '2023-08-17 16:12:21'),
(161, 'Guru', 670, 4, '3', '0', '1', '0', 1, '2023-08-17 16:12:29', '2023-08-17 16:12:29'),
(162, 'qwerty', 832, 4, '3', '0', '0', '0', 1, '2023-08-17 16:20:46', '2023-08-17 16:20:46'),
(163, 'how are you', 548, 2, '2', '0', '0', '0', 1, '2024-01-27 14:51:15', '2024-01-27 14:51:15'),
(164, 'test ok', 548, 2, '4', '0', '0', '0', 1, '2024-01-31 17:23:06', '2024-01-31 17:23:06'),
(165, 'test ok', 548, 2, '4', '0', '1', '0', 1, '2024-01-31 17:23:18', '2024-01-31 17:23:18'),
(166, 'question1', 876, 3, '4', '1', '0', '0', 1, '2024-02-08 18:48:13', '2024-02-08 18:48:13'),
(167, 'Qa1', 884, 2, '4', '1', '1', '0', 1, '2024-03-07 14:07:48', '2024-03-07 14:07:48'),
(168, 'how are you ?', 904, 2, '4', '0', '0', '0', 1, '2024-05-04 12:57:40', '2024-05-04 12:57:40');

-- --------------------------------------------------------

--
-- Table structure for table `agents_rating`
--

CREATE TABLE `agents_rating` (
  `rating_id` int NOT NULL,
  `rating` varchar(11) NOT NULL,
  `review` text,
  `rating_type` enum('1','2','3','4') NOT NULL COMMENT '1=answers,2=messaging,3=agent,4=post',
  `rating_item_id` int NOT NULL,
  `rating_item_parent_id` int NOT NULL,
  `sender_id` int NOT NULL,
  `sender_role` int NOT NULL,
  `receiver_id` int NOT NULL,
  `receiver_role` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `agents_review`
--

CREATE TABLE `agents_review` (
  `id` int NOT NULL,
  `agent_id` int DEFAULT NULL,
  `sender_id` int DEFAULT NULL,
  `star` int DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `agents_securty_question`
--

CREATE TABLE `agents_securty_question` (
  `securty_question_id` int NOT NULL,
  `question` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=no,1=yes',
  `status` int NOT NULL DEFAULT '1' COMMENT '0="De-active", 1="active"',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_securty_question`
--

INSERT INTO `agents_securty_question` (`securty_question_id`, `question`, `is_deleted`, `status`, `created_at`, `updated_at`) VALUES
(1, 'What is your place of birth?', '1', 1, '2022-08-22 02:21:45', '2022-08-22 02:21:45'),
(2, 'What is your date  of birth and place of birth?', '1', 1, '2022-08-22 02:21:52', '2022-12-09 12:55:42'),
(3, 'Food', '1', 1, '2023-01-02 13:51:16', '2023-01-02 13:51:16'),
(4, 'Place Of Birth ?', '1', 1, '2023-01-04 11:43:50', '2023-01-06 11:27:23'),
(7, 'Favorite Dish', '1', 1, '2023-01-08 19:13:25', '2023-01-08 19:13:25'),
(8, 'What is your Nick Name?', '0', 1, '2023-01-09 12:04:38', '2023-04-28 18:04:35'),
(9, 'Do you want to become Agent of 92agents', '1', 1, '2023-01-09 19:19:41', '2023-01-09 19:19:41'),
(10, 'what is your  date of birth', '1', 1, '2023-02-05 01:00:17', '2023-02-05 01:00:17'),
(11, 'What Is Your Date Of Birth And Place Of Birth?', '0', 1, '2023-02-05 01:01:08', '2023-02-05 01:01:08'),
(12, 'What Is Your Date Of Birth', '1', 1, '2023-02-05 01:12:43', '2023-02-05 01:12:43'),
(13, 'What is your date of birth?', '1', 1, '2023-02-05 14:42:59', '2023-03-03 20:18:57'),
(14, 'hi', '1', 1, '2023-02-08 04:25:13', '2023-02-08 04:25:13'),
(15, 'test security question add', '1', 1, '2023-03-02 21:42:35', '2023-03-02 21:42:35'),
(16, 'tester question', '1', 1, '2023-03-02 21:47:47', '2023-03-02 21:47:47'),
(17, 'tester ques3', '1', 1, '2023-03-02 21:58:27', '2023-03-02 21:58:27'),
(18, 'test q1', '1', 1, '2023-04-13 14:56:57', '2023-04-13 14:56:57'),
(19, 'test q 2', '0', 1, '2023-04-13 14:57:07', '2023-04-28 17:59:17'),
(20, 'test 112', '1', 1, '2023-04-13 17:57:40', '2023-04-13 17:57:40'),
(21, 'What Is Your Locality', '0', 1, '2023-04-29 16:20:16', '2023-04-29 17:26:09'),
(22, 'What is your date  of birth and place of birth?', '0', 1, '2023-04-29 17:26:52', '2023-04-29 17:26:52');

-- --------------------------------------------------------

--
-- Table structure for table `agents_selldetails`
--

CREATE TABLE `agents_selldetails` (
  `id` int NOT NULL,
  `sellers_name` varchar(100) NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `sale_date` datetime DEFAULT NULL,
  `sale_price` float(10,2) DEFAULT NULL,
  `post_id` int NOT NULL,
  `agent_id` int NOT NULL,
  `agent_comission` int NOT NULL DEFAULT '3',
  `comission_92agent` int NOT NULL DEFAULT '3',
  `payment_status` tinyint(1) DEFAULT '0',
  `payment_id` int DEFAULT NULL,
  `receipt_url` varchar(300) DEFAULT NULL,
  `created_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_selldetails`
--

INSERT INTO `agents_selldetails` (`id`, `sellers_name`, `address`, `sale_date`, `sale_price`, `post_id`, `agent_id`, `agent_comission`, `comission_92agent`, `payment_status`, `payment_id`, `receipt_url`, `created_ts`, `updated_ts`, `status`, `deleted`) VALUES
(1, 'Hamza Seller', 'Anser', '2024-01-31 12:11:43', 2000.00, 24, 550, 4, 1, 1, 6, 'https://pay.stripe.com/receipts/payment/CAcaFwoVYWNjdF8xR2VZUFRHbUIxZU4zdVpBKPj8zJkGMga_VMyeP1Q6LBaVTyXOVOd5z4fRY3fOvwY9MUH_poPpOHNHB2BF21-Jd5TfFolahGj9Ochl', '2022-09-18 22:24:43', '2022-09-27 13:18:32', 1, NULL),
(3, 'Hamza Seller', 'lahore', '2022-10-06 21:28:29', 30.00, 25, 550, 3, 1, 0, NULL, NULL, '2022-09-19 03:58:50', '2022-09-19 03:58:50', 1, NULL),
(6, 'Hamza Seller', 'home home2', '2023-02-27 21:35:02', 120000.00, 21, 550, 3, 3, 0, NULL, NULL, '2022-09-29 21:05:43', '2022-09-29 21:05:43', 1, NULL),
(7, 'Hamza Seller', 'Non commodi in sed i', '2022-09-29 12:00:00', 110000.00, 22, 550, 3, 3, 0, NULL, NULL, '2022-09-29 21:08:33', '2022-09-29 21:08:33', 1, NULL),
(8, 'Hamza Seller', 'Id amet quidem face', '2022-10-31 20:30:09', 3200.00, 26, 550, 3, 1, 1, 11, 'https://pay.stripe.com/receipts/payment/CAcaFwoVYWNjdF8xR2VZUFRHbUIxZU4zdVpBKPjggJsGMgZXD_2TM546LBa8yo_YRoihwSmGqeS3L9lt-YbtSK9_Y9ij3BUxjtyPoBndazWdxrPdaqUg', '2022-09-29 21:25:00', '2022-10-31 15:30:46', 1, NULL),
(9, 'joy jinda', '', NULL, NULL, 32, 597, 3, 1, 0, NULL, NULL, '2022-11-25 11:18:33', '2022-11-25 11:18:33', 1, NULL),
(10, 'joy jinda', '', NULL, NULL, 32, 597, 3, 1, 0, NULL, NULL, '2022-11-25 11:18:38', '2022-11-25 11:18:38', 1, NULL),
(11, 'joy jinda', '', NULL, NULL, 32, 597, 3, 1, 0, NULL, NULL, '2022-11-25 11:18:55', '2022-11-25 11:18:55', 1, NULL),
(12, 'joy jinda', '', NULL, NULL, 32, 601, 3, 1, 0, NULL, NULL, '2022-11-25 11:23:30', '2022-11-25 11:23:30', 1, NULL),
(13, 'joy jinda', '', NULL, NULL, 32, 542, 3, 1, 0, NULL, NULL, '2022-11-25 11:29:24', '2022-11-25 11:29:24', 1, NULL),
(14, 'joy jinda', '', NULL, NULL, 32, 597, 3, 1, 0, NULL, NULL, '2022-11-25 11:52:46', '2022-11-25 11:52:46', 1, NULL),
(15, 'joy jinda', '', NULL, NULL, 32, 601, 3, 1, 0, NULL, NULL, '2022-11-25 11:53:09', '2022-11-25 11:53:09', 1, NULL),
(16, 'Rosanna Senger', '702n St', '2023-02-26 05:52:24', NULL, 35, 625, 3, 1, 0, NULL, NULL, '2022-12-08 13:47:32', '2022-12-08 13:47:32', 1, NULL),
(17, 'Rosanna Senger', '702 Main St', '2023-02-26 05:52:15', NULL, 35, 625, 3, 1, 0, NULL, NULL, '2022-12-08 13:48:00', '2022-12-08 13:48:00', 1, NULL),
(18, 'Rosanna Senger', '702 Main St', '2023-02-26 05:51:52', NULL, 35, 625, 3, 1, 0, NULL, NULL, '2022-12-08 13:48:14', '2022-12-08 13:48:14', 1, NULL),
(19, 'Priya Kandaswamy', 'fd', '2023-02-27 11:17:50', NULL, 37, 550, 4, 1, 0, NULL, NULL, '2022-12-12 05:37:49', '2022-12-12 05:37:49', 1, NULL),
(20, 'Aditya Kertzamann', '', NULL, NULL, 33, 625, 3, 1, 0, NULL, NULL, '2022-12-16 08:04:55', '2022-12-16 08:04:55', 1, NULL),
(21, 'Aditya Kertzamann', '', NULL, NULL, 33, 625, 3, 1, 0, NULL, NULL, '2022-12-16 08:10:56', '2022-12-16 08:10:56', 1, NULL),
(22, 'Abbigail Schultz', '', NULL, NULL, 45, 625, 3, 1, 0, NULL, NULL, '2022-12-21 13:06:39', '2022-12-21 13:06:39', 1, NULL),
(23, 'Abbigail Schultz', '', NULL, NULL, 45, 625, 3, 1, 0, NULL, NULL, '2022-12-21 13:07:42', '2022-12-21 13:07:42', 1, NULL),
(24, 'Rosanna Senger', '702 Main St', NULL, NULL, 44, 625, 3, 1, 0, NULL, NULL, '2022-12-21 13:10:55', '2022-12-21 13:10:55', 1, NULL),
(25, 'Rosanna Senger', '702 Main St', NULL, NULL, 44, 625, 3, 1, 0, NULL, NULL, '2022-12-21 13:11:03', '2022-12-21 13:11:03', 1, NULL),
(26, 'Priya Kandaswamy', '', NULL, NULL, 48, 550, 3, 1, 0, NULL, NULL, '2022-12-26 07:04:32', '2022-12-26 07:04:32', 1, NULL),
(27, 'Priya Kandaswamy', '', NULL, NULL, 48, 550, 3, 1, 0, NULL, NULL, '2022-12-26 07:04:46', '2022-12-26 07:04:46', 1, NULL),
(28, 'Rajani Joshi', 'Door No. 12', '2023-01-01 10:28:02', 100.00, 50, 672, 3, 1, 0, NULL, NULL, '2022-12-27 07:18:17', '2022-12-27 07:18:17', 1, NULL),
(29, 'Rajani Joshi', '', NULL, NULL, 50, 672, 3, 1, 0, NULL, NULL, '2022-12-27 07:19:09', '2022-12-27 07:19:09', 1, NULL),
(30, 'Rajani Joshi', '', NULL, NULL, 50, 672, 3, 1, 0, NULL, NULL, '2022-12-27 07:19:12', '2022-12-27 07:19:12', 1, NULL),
(31, 'Rajani Joshi', '', NULL, NULL, 50, 672, 3, 1, 0, NULL, NULL, '2022-12-27 07:19:25', '2022-12-27 07:19:25', 1, NULL),
(32, 'Rajani Joshi', '', NULL, NULL, 52, 672, 3, 1, 0, NULL, NULL, '2022-12-27 07:28:29', '2022-12-27 07:28:29', 1, NULL),
(33, 'Rajani Joshi', '', NULL, NULL, 52, 672, 3, 1, 0, NULL, NULL, '2022-12-27 07:28:38', '2022-12-27 07:28:38', 1, NULL),
(34, 'Rajani Joshi', '', NULL, NULL, 52, 672, 3, 1, 0, NULL, NULL, '2022-12-27 07:28:39', '2022-12-27 07:28:39', 1, NULL),
(35, 'Rajani Joshi', '', NULL, NULL, 52, 672, 3, 1, 0, NULL, NULL, '2022-12-27 07:28:51', '2022-12-27 07:28:51', 1, NULL),
(36, 'Rajani Joshi', 'test change address 222', '2023-02-26 18:16:39', 1200.00, 49, 670, 3, 1, 0, NULL, NULL, '2022-12-27 08:08:18', '2022-12-27 08:08:18', 1, NULL),
(37, 'Rosanna Senger', '702 Main St', NULL, NULL, 44, 625, 3, 1, 0, NULL, NULL, '2022-12-28 12:56:34', '2022-12-28 12:56:34', 1, NULL),
(38, 'Rosanna Senger', '702 Main St', NULL, NULL, 44, 625, 3, 1, 0, NULL, NULL, '2022-12-28 12:56:38', '2022-12-28 12:56:38', 1, NULL),
(39, 'Rosanna Senger', '702 Main St', '2023-02-27 21:34:28', NULL, 61, 601, 3, 1, 0, NULL, NULL, '2023-01-03 10:42:52', '2023-01-03 10:42:52', 1, NULL),
(40, 'Raghavendra Rao', '', NULL, NULL, 65, 670, 3, 1, 0, NULL, NULL, '2023-01-09 08:02:45', '2023-01-09 08:02:45', 1, NULL),
(41, 'Raghavendra Rao', '', NULL, NULL, 65, 670, 3, 1, 0, NULL, NULL, '2023-01-09 08:03:43', '2023-01-09 08:03:43', 1, NULL),
(42, 'Raghavendra Rao', '', NULL, NULL, 64, 670, 3, 1, 0, NULL, NULL, '2023-01-09 08:26:12', '2023-01-09 08:26:12', 1, NULL),
(43, 'Raghavendra Rao', '', NULL, NULL, 64, 670, 3, 1, 0, NULL, NULL, '2023-01-09 08:40:01', '2023-01-09 08:40:01', 1, NULL),
(44, 'Raghavendra Rao', 'null', '2023-02-26 07:20:53', NULL, 64, 670, 3, 1, 0, NULL, NULL, '2023-01-09 08:40:13', '2023-01-09 08:40:13', 1, NULL),
(45, 'Raghavendra Rao', '', NULL, NULL, 64, 670, 3, 1, 0, NULL, NULL, '2023-01-09 08:40:46', '2023-01-09 08:40:46', 1, NULL),
(46, 'Raghavendra Rao', '', NULL, NULL, 64, 670, 3, 1, 0, NULL, NULL, '2023-01-09 08:42:13', '2023-01-09 08:42:13', 1, NULL),
(47, 'Raghavendra Rao', '', NULL, NULL, 64, 670, 3, 1, 0, NULL, NULL, '2023-01-09 08:42:28', '2023-01-09 08:42:28', 1, NULL),
(48, 'Raghavendra Rao', NULL, '2023-02-26 12:29:52', NULL, 64, 670, 3, 1, 0, NULL, NULL, '2023-01-09 08:43:08', '2023-01-09 08:43:08', 1, NULL),
(49, 'Raghavendra Rao', '', NULL, NULL, 64, 670, 3, 1, 0, NULL, NULL, '2023-01-09 08:44:07', '2023-01-09 08:44:07', 1, NULL),
(50, 'Raghavendra Rao', '', NULL, NULL, 64, 670, 3, 1, 0, NULL, NULL, '2023-01-09 08:44:10', '2023-01-09 08:44:10', 1, NULL),
(51, 'Raghavendra Rao', '', NULL, NULL, 64, 670, 3, 1, 0, NULL, NULL, '2023-01-09 08:44:13', '2023-01-09 08:44:13', 1, NULL),
(52, 'Raghavendra Rao', '', NULL, NULL, 64, 670, 3, 1, 0, NULL, NULL, '2023-01-09 08:45:01', '2023-01-09 08:45:01', 1, NULL),
(53, 'Raghavendra Rao', '', NULL, NULL, 66, 659, 3, 1, 0, NULL, NULL, '2023-01-09 09:13:55', '2023-01-09 09:13:55', 1, NULL),
(54, 'Priya Kandaswamy', '', NULL, NULL, 68, 709, 3, 1, 0, NULL, NULL, '2023-01-11 08:09:58', '2023-01-11 08:09:58', 1, NULL),
(55, 'Priya Kandaswamy', '', NULL, NULL, 68, 709, 3, 1, 0, NULL, NULL, '2023-01-11 08:10:07', '2023-01-11 08:10:07', 1, NULL),
(56, 'Priya Kandaswamy', '', NULL, NULL, 68, 709, 3, 1, 0, NULL, NULL, '2023-01-11 08:11:08', '2023-01-11 08:11:08', 1, NULL),
(57, 'Priya Kandaswamy', '', NULL, NULL, 68, 709, 3, 1, 0, NULL, NULL, '2023-01-11 08:11:21', '2023-01-11 08:11:21', 1, NULL),
(58, 'Priya Kandaswamy', '', NULL, NULL, 68, 709, 3, 1, 0, NULL, NULL, '2023-01-11 08:11:29', '2023-01-11 08:11:29', 1, NULL),
(59, 'Priya Kandaswamy', '', NULL, NULL, 68, 709, 3, 1, 0, NULL, NULL, '2023-01-11 08:11:35', '2023-01-11 08:11:35', 1, NULL),
(60, 'Priya Kandaswamy', '', NULL, NULL, 68, 709, 3, 1, 0, NULL, NULL, '2023-01-11 08:11:46', '2023-01-11 08:11:46', 1, NULL),
(61, 'Priya Kandaswamy', '', NULL, NULL, 68, 709, 3, 1, 0, NULL, NULL, '2023-01-11 08:11:48', '2023-01-11 08:11:48', 1, NULL),
(62, 'Priya Kandaswamy', '', NULL, NULL, 68, 709, 3, 1, 0, NULL, NULL, '2023-01-11 08:12:01', '2023-01-11 08:12:01', 1, NULL),
(63, 'Priya Kandaswamy', '', NULL, NULL, 68, 709, 3, 1, 0, NULL, NULL, '2023-01-11 08:12:07', '2023-01-11 08:12:07', 1, NULL),
(64, 'Priya Kandaswamy', 'test change address 222', '2023-02-26 12:41:29', 1200.00, 68, 709, 3, 1, 0, NULL, NULL, '2023-01-11 08:13:36', '2023-01-11 08:13:36', 1, NULL),
(65, 'Priya Kandaswamy', '', NULL, NULL, 68, 709, 3, 1, 0, NULL, NULL, '2023-01-11 08:20:00', '2023-01-11 08:20:00', 1, NULL),
(66, 'Priya Kandaswamy', '', NULL, NULL, 68, 709, 3, 1, 0, NULL, NULL, '2023-01-11 08:20:03', '2023-01-11 08:20:03', 1, NULL),
(67, 'Priya Kandaswamy', '', NULL, NULL, 68, 709, 3, 1, 0, NULL, NULL, '2023-01-11 08:20:07', '2023-01-11 08:20:07', 1, NULL),
(68, 'Priya Kandaswamy', '', NULL, NULL, 68, 709, 3, 1, 0, NULL, NULL, '2023-01-11 08:20:15', '2023-01-11 08:20:15', 1, NULL),
(69, 'Kiran Kumar', '', NULL, NULL, 70, 715, 3, 1, 0, NULL, NULL, '2023-01-16 06:03:33', '2023-01-16 06:03:33', 1, NULL),
(70, 'Kiran Kumar', '', NULL, NULL, 71, 715, 3, 1, 0, NULL, NULL, '2023-01-16 06:09:56', '2023-01-16 06:09:56', 1, NULL),
(71, 'Ankit', '', NULL, NULL, 73, 625, 3, 1, 0, NULL, NULL, '2023-01-16 06:46:36', '2023-01-16 06:46:36', 1, NULL),
(72, 'Ankit', '', NULL, NULL, 73, 625, 3, 1, 0, NULL, NULL, '2023-01-16 06:46:41', '2023-01-16 06:46:41', 1, NULL),
(73, 'Bobby Stewart', '', NULL, NULL, 74, 709, 3, 1, 0, NULL, NULL, '2023-01-16 12:00:17', '2023-01-16 12:00:17', 1, NULL),
(74, 'Bobby Stewart', '', NULL, NULL, 74, 709, 3, 1, 0, NULL, NULL, '2023-01-16 12:00:44', '2023-01-16 12:00:44', 1, NULL),
(75, 'Raghavendra Rao', NULL, '2023-02-26 07:31:50', NULL, 75, 625, 3, 1, 0, NULL, NULL, '2023-01-19 07:35:34', '2023-01-19 07:35:34', 1, NULL),
(76, 'jack tompkins', '', NULL, NULL, 76, 692, 3, 1, 0, NULL, NULL, '2023-01-20 20:34:18', '2023-01-20 20:34:18', 1, NULL),
(77, 'jack tompkins', '', NULL, NULL, 76, 692, 3, 1, 0, NULL, NULL, '2023-01-20 20:43:23', '2023-01-20 20:43:23', 1, NULL),
(78, 'Raghavendra Rao', '', NULL, NULL, 75, 625, 3, 1, 0, NULL, NULL, '2023-01-30 07:51:17', '2023-01-30 07:51:17', 1, NULL),
(79, 'Raghavendra Rao', '', NULL, NULL, 89, 660, 3, 1, 0, NULL, NULL, '2023-01-31 06:56:23', '2023-01-31 06:56:23', 1, NULL),
(80, 'Raghavendra Rao', '', NULL, NULL, 75, 709, 3, 1, 0, NULL, NULL, '2023-01-31 06:56:55', '2023-01-31 06:56:55', 1, NULL),
(81, 'brody brickle', '', NULL, NULL, 103, 735, 3, 1, 0, NULL, NULL, '2023-02-05 09:25:25', '2023-02-05 09:25:25', 1, NULL),
(82, 'brody brickle', '', NULL, NULL, 103, 735, 3, 1, 0, NULL, NULL, '2023-02-05 09:26:02', '2023-02-05 09:26:02', 1, NULL),
(83, 'brody brickle', '', NULL, NULL, 103, 735, 3, 1, 0, NULL, NULL, '2023-02-05 09:27:43', '2023-02-05 09:27:43', 1, NULL),
(84, 'brody brickle', '', NULL, NULL, 103, 735, 3, 1, 0, NULL, NULL, '2023-02-05 09:53:42', '2023-02-05 09:53:42', 1, NULL),
(85, 'brody brickle', '', NULL, NULL, 103, 735, 3, 1, 0, NULL, NULL, '2023-02-05 09:54:11', '2023-02-05 09:54:11', 1, NULL),
(86, 'patric test', '', NULL, NULL, 111, 670, 3, 1, 0, NULL, NULL, '2023-03-03 08:36:29', '2023-03-03 08:36:29', 1, NULL),
(87, 'patric test', '', NULL, NULL, 111, 670, 3, 1, 0, NULL, NULL, '2023-03-03 08:46:49', '2023-03-03 08:46:49', 1, NULL),
(88, 'patric test', '', NULL, NULL, 111, 670, 3, 1, 0, NULL, NULL, '2023-03-03 08:50:58', '2023-03-03 08:50:58', 1, NULL),
(89, 'patric test', '', NULL, NULL, 114, 763, 3, 1, 0, NULL, NULL, '2023-03-03 12:17:36', '2023-03-03 12:17:36', 1, NULL),
(90, 'patric test', '', NULL, NULL, 112, 763, 3, 1, 0, NULL, NULL, '2023-03-03 12:19:17', '2023-03-03 12:19:17', 1, NULL),
(91, 'Test Ritz', '', NULL, NULL, 118, 769, 3, 1, 0, NULL, NULL, '2023-03-12 08:39:07', '2023-03-12 08:39:07', 1, NULL),
(92, 'Test Ritz', '', NULL, NULL, 118, 769, 3, 1, 0, NULL, NULL, '2023-03-12 08:39:30', '2023-03-12 08:39:30', 1, NULL),
(93, 'Test Ritz', '', NULL, NULL, 118, 769, 3, 1, 0, NULL, NULL, '2023-03-12 08:43:52', '2023-03-12 08:43:52', 1, NULL),
(94, 'Test Ritz', '', NULL, NULL, 124, 774, 3, 1, 0, NULL, NULL, '2023-03-16 17:43:53', '2023-03-16 17:43:53', 1, NULL),
(95, 'Test Ritz', '', NULL, NULL, 124, 774, 3, 1, 0, NULL, NULL, '2023-03-16 17:43:58', '2023-03-16 17:43:58', 1, NULL),
(96, 'Test Ritz', '', NULL, NULL, 124, 774, 3, 1, 0, NULL, NULL, '2023-03-16 17:44:09', '2023-03-16 17:44:09', 1, NULL),
(97, 'Test Ritz', '', NULL, NULL, 124, 774, 3, 1, 0, NULL, NULL, '2023-03-16 17:44:11', '2023-03-16 17:44:11', 1, NULL),
(98, 'Test Ritz', '', NULL, NULL, 124, 774, 3, 1, 0, NULL, NULL, '2023-03-16 17:51:46', '2023-03-16 17:51:46', 1, NULL),
(99, 'seller test', 'asdasd', NULL, NULL, 135, 781, 3, 1, 0, NULL, NULL, '2023-04-13 10:36:24', '2023-04-13 10:36:24', 1, NULL),
(100, 'seller test', 'asdasd', NULL, NULL, 135, 781, 3, 1, 0, NULL, NULL, '2023-04-13 10:37:14', '2023-04-13 10:37:14', 1, NULL),
(101, 'seller test', 'asdasd', NULL, NULL, 135, 781, 3, 1, 0, NULL, NULL, '2023-04-13 10:42:46', '2023-04-13 10:42:46', 1, NULL),
(102, 'seller test', 'asdasd', NULL, NULL, 134, 786, 3, 1, 0, NULL, NULL, '2023-04-13 12:17:52', '2023-04-13 12:17:52', 1, NULL),
(103, 'seller test', 'asdasd', NULL, NULL, 134, 786, 3, 1, 0, NULL, NULL, '2023-04-13 12:18:23', '2023-04-13 12:18:23', 1, NULL),
(104, 'seller test', 'asdasd', NULL, NULL, 134, 786, 3, 1, 0, NULL, NULL, '2023-04-13 12:18:37', '2023-04-13 12:18:37', 1, NULL),
(105, 'seller test', 'asdasd', NULL, NULL, 134, 786, 3, 1, 0, NULL, NULL, '2023-04-13 12:23:10', '2023-04-13 12:23:10', 1, NULL),
(106, 'ashish mishra', '', NULL, NULL, 137, 830, 3, 1, 0, NULL, NULL, '2023-06-03 09:08:59', '2023-06-03 09:08:59', 1, NULL),
(107, 'ashish mishra', '', NULL, NULL, 137, 830, 3, 1, 0, NULL, NULL, '2023-06-03 09:12:46', '2023-06-03 09:12:46', 1, NULL),
(108, 'ashish mishra', '', NULL, NULL, 137, 830, 3, 1, 0, NULL, NULL, '2023-06-03 09:34:49', '2023-06-03 09:34:49', 1, NULL),
(109, 'ashish mishra', '', NULL, NULL, 137, 830, 3, 1, 0, NULL, NULL, '2023-06-03 09:40:22', '2023-06-03 09:40:22', 1, NULL),
(110, 'ashish mishra', '', NULL, NULL, 137, 830, 3, 1, 0, NULL, NULL, '2023-06-03 09:40:33', '2023-06-03 09:40:33', 1, NULL),
(111, 'ashish mishra', '', NULL, NULL, 137, 830, 3, 1, 0, NULL, NULL, '2023-06-03 09:43:56', '2023-06-03 09:43:56', 1, NULL),
(112, 'ashish mishra', '', NULL, NULL, 137, 830, 3, 1, 0, NULL, NULL, '2023-06-03 09:45:40', '2023-06-03 09:45:40', 1, NULL),
(113, 'ashish mishra', '', NULL, NULL, 137, 830, 3, 1, 0, NULL, NULL, '2023-06-03 09:46:31', '2023-06-03 09:46:31', 1, NULL),
(114, 'ashish mishra', '', NULL, NULL, 137, 830, 3, 1, 0, NULL, NULL, '2023-06-03 09:46:46', '2023-06-03 09:46:46', 1, NULL),
(115, 'ashish mishra', '', NULL, NULL, 137, 830, 3, 1, 0, NULL, NULL, '2023-06-03 10:02:54', '2023-06-03 10:02:54', 1, NULL),
(116, 'lala', '', NULL, NULL, 144, 830, 3, 1, 0, NULL, NULL, '2023-07-08 12:45:45', '2023-07-08 12:45:45', 1, NULL),
(117, 'lala', '', NULL, NULL, 144, 830, 3, 1, 0, NULL, NULL, '2023-07-10 05:19:01', '2023-07-10 05:19:01', 1, NULL),
(118, 'lala', '', NULL, NULL, 144, 830, 3, 1, 0, NULL, NULL, '2023-07-10 05:19:04', '2023-07-10 05:19:04', 1, NULL),
(119, 'lala', '', NULL, NULL, 144, 830, 3, 1, 0, NULL, NULL, '2023-07-10 05:19:22', '2023-07-10 05:19:22', 1, NULL),
(120, 'lala', '', NULL, NULL, 144, 830, 3, 1, 0, NULL, NULL, '2023-07-10 05:19:47', '2023-07-10 05:19:47', 1, NULL),
(121, 'lala', '', NULL, NULL, 144, 830, 3, 1, 0, NULL, NULL, '2023-07-10 05:21:16', '2023-07-10 05:21:16', 1, NULL),
(122, 'qwer qwert', '', NULL, NULL, 147, 834, 3, 1, 0, NULL, NULL, '2023-07-27 06:04:42', '2023-07-27 06:04:42', 1, NULL),
(123, 'Satish Pai', '', NULL, NULL, 153, 842, 3, 1, 0, NULL, NULL, '2023-08-02 07:29:12', '2023-08-02 07:29:12', 1, NULL),
(124, 'Satish Pai', '', NULL, NULL, 153, 842, 3, 1, 0, NULL, NULL, '2023-08-02 07:31:52', '2023-08-02 07:31:52', 1, NULL),
(125, 'Satish Pai', '', NULL, NULL, 153, 842, 3, 1, 0, NULL, NULL, '2023-08-02 07:32:22', '2023-08-02 07:32:22', 1, NULL),
(126, 'Satish Pai', '', NULL, NULL, 153, 842, 3, 1, 0, NULL, NULL, '2023-08-02 12:16:21', '2023-08-02 12:16:21', 1, NULL),
(127, 'Satish Pai', '', NULL, NULL, 153, 842, 3, 1, 0, NULL, NULL, '2023-08-02 12:16:39', '2023-08-02 12:16:39', 1, NULL),
(128, 'Satish Pai', '', NULL, NULL, 153, 842, 3, 1, 0, NULL, NULL, '2023-08-08 05:40:01', '2023-08-08 05:40:01', 1, NULL),
(129, 'Satish Pai', '', NULL, NULL, 153, 842, 3, 1, 0, NULL, NULL, '2023-08-09 11:27:05', '2023-08-09 11:27:05', 1, NULL),
(130, 'Satish Pai', '', NULL, NULL, 153, 842, 3, 1, 0, NULL, NULL, '2023-08-09 11:27:13', '2023-08-09 11:27:13', 1, NULL),
(131, 'SAVAN RATHOD', '', NULL, NULL, 156, 852, 3, 1, 0, NULL, NULL, '2023-09-14 18:54:01', '2023-09-14 18:54:01', 1, NULL),
(132, 'SAVAN RATHOD', '', NULL, NULL, 156, 852, 3, 1, 0, NULL, NULL, '2023-09-14 18:54:38', '2023-09-14 18:54:38', 1, NULL),
(133, 'Vignesh Selvan', '', NULL, NULL, 158, 853, 3, 1, 0, NULL, NULL, '2023-11-11 12:48:15', '2023-11-11 12:48:15', 1, NULL),
(134, 'Vignesh Selvan', '', NULL, NULL, 158, 853, 3, 1, 0, NULL, NULL, '2023-11-11 12:48:18', '2023-11-11 12:48:18', 1, NULL),
(135, 'Abi Abi', '', NULL, NULL, 162, 860, 3, 1, 0, NULL, NULL, '2023-12-06 06:10:55', '2023-12-06 06:10:55', 1, NULL),
(136, 'Abi Abi', '', NULL, NULL, 162, 860, 3, 1, 0, NULL, NULL, '2023-12-06 06:12:15', '2023-12-06 06:12:15', 1, NULL),
(137, 'Abi Abi', '', NULL, NULL, 162, 860, 3, 1, 0, NULL, NULL, '2023-12-06 06:14:28', '2023-12-06 06:14:28', 1, NULL),
(138, 'Anu Anu', '', NULL, NULL, 163, 860, 3, 1, 0, NULL, NULL, '2023-12-07 10:26:35', '2023-12-07 10:26:35', 1, NULL),
(139, 'Anu Anu', '', NULL, NULL, 164, 853, 3, 1, 0, NULL, NULL, '2023-12-12 09:43:27', '2023-12-12 09:43:27', 1, NULL),
(140, 'Anu Anu', '', NULL, NULL, 164, 853, 3, 1, 0, NULL, NULL, '2023-12-12 09:43:27', '2023-12-12 09:43:27', 1, NULL),
(141, 'Anu Anu', '', NULL, NULL, 164, 853, 3, 1, 0, NULL, NULL, '2023-12-12 09:43:29', '2023-12-12 09:43:29', 1, NULL),
(142, 'Abi Abi', '', NULL, NULL, 161, 860, 3, 1, 0, NULL, NULL, '2023-12-28 05:29:15', '2023-12-28 05:29:15', 1, NULL),
(143, 'Abi Abi', '', NULL, NULL, 161, 860, 3, 1, 0, NULL, NULL, '2023-12-28 05:29:19', '2023-12-28 05:29:19', 1, NULL),
(144, 'Abi Abi', '', NULL, NULL, 161, 860, 3, 1, 0, NULL, NULL, '2023-12-28 05:30:38', '2023-12-28 05:30:38', 1, NULL),
(145, 'Abi Abi', '', NULL, NULL, 161, 860, 3, 1, 0, NULL, NULL, '2023-12-28 05:31:16', '2023-12-28 05:31:16', 1, NULL),
(146, 'Abi Abi', '', NULL, NULL, 161, 860, 3, 1, 0, NULL, NULL, '2023-12-28 05:32:24', '2023-12-28 05:32:24', 1, NULL),
(147, 'Abi Abi', '', NULL, NULL, 161, 860, 3, 1, 0, NULL, NULL, '2023-12-28 05:32:55', '2023-12-28 05:32:55', 1, NULL),
(148, 'Abi Abi', '', NULL, NULL, 161, 860, 3, 1, 0, NULL, NULL, '2023-12-28 05:34:00', '2023-12-28 05:34:00', 1, NULL),
(149, 'Udit Narayan', '', NULL, NULL, 167, 853, 3, 1, 0, NULL, NULL, '2024-01-09 10:15:00', '2024-01-09 10:15:00', 1, NULL),
(150, 'Anu Anu', '', NULL, NULL, 164, 860, 3, 1, 0, NULL, NULL, '2024-01-11 17:11:09', '2024-01-11 17:11:09', 1, NULL),
(151, 'Anu Anu', '', NULL, NULL, 164, 860, 3, 1, 0, NULL, NULL, '2024-01-11 17:12:36', '2024-01-11 17:12:36', 1, NULL),
(152, 'rehan anim', '', NULL, NULL, 174, 879, 3, 1, 0, NULL, NULL, '2024-02-08 08:30:38', '2024-02-08 08:30:38', 1, NULL),
(153, 'rehan anim', '', NULL, NULL, 174, 879, 3, 1, 0, NULL, NULL, '2024-02-08 08:30:51', '2024-02-08 08:30:51', 1, NULL),
(154, 'rehan anim', '', NULL, NULL, 174, 879, 3, 1, 0, NULL, NULL, '2024-02-08 08:31:07', '2024-02-08 08:31:07', 1, NULL),
(155, 'rehan anim', '', NULL, NULL, 178, 881, 3, 1, 0, NULL, NULL, '2024-02-08 12:43:24', '2024-02-08 12:43:24', 1, NULL),
(156, 'rehan anim', '', NULL, NULL, 178, 881, 3, 1, 0, NULL, NULL, '2024-02-08 12:43:32', '2024-02-08 12:43:32', 1, NULL),
(157, 'rehan anim', '', NULL, NULL, 178, 881, 3, 1, 0, NULL, NULL, '2024-02-08 12:44:05', '2024-02-08 12:44:05', 1, NULL),
(158, 'rehan anim', '', NULL, NULL, 179, 878, 3, 1, 0, NULL, NULL, '2024-02-08 12:48:14', '2024-02-08 12:48:14', 1, NULL),
(159, 'rehan anim', '', NULL, NULL, 179, 878, 3, 1, 0, NULL, NULL, '2024-02-08 12:48:20', '2024-02-08 12:48:20', 1, NULL),
(160, 'rehan anim', '', NULL, NULL, 179, 879, 3, 1, 0, NULL, NULL, '2024-02-08 12:51:02', '2024-02-08 12:51:02', 1, NULL),
(161, 'rehan anim', '', NULL, NULL, 177, 881, 3, 1, 0, NULL, NULL, '2024-02-08 12:53:09', '2024-02-08 12:53:09', 1, NULL),
(162, 'sell das', '', NULL, NULL, 180, 865, 3, 1, 0, NULL, NULL, '2024-02-13 19:09:48', '2024-02-13 19:09:48', 1, NULL),
(163, 'Virali Shah', '', NULL, NULL, 193, 891, 3, 1, 0, NULL, NULL, '2024-03-23 22:16:18', '2024-03-23 22:16:18', 1, NULL),
(164, 'Sankar Dey', '', NULL, NULL, 194, 891, 3, 1, 0, NULL, NULL, '2024-03-26 08:29:10', '2024-03-26 08:29:10', 1, NULL),
(165, 'Sankar Dey', '', NULL, NULL, 194, 891, 3, 1, 0, NULL, NULL, '2024-03-26 08:29:54', '2024-03-26 08:29:54', 1, NULL),
(166, 'Sankar Dey', '', NULL, NULL, 194, 891, 3, 1, 0, NULL, NULL, '2024-03-26 08:29:57', '2024-03-26 08:29:57', 1, NULL),
(167, 'Sankar Dey', '', NULL, NULL, 194, 891, 3, 1, 0, NULL, NULL, '2024-03-26 08:30:00', '2024-03-26 08:30:00', 1, NULL),
(168, 'Sankar Dey', '', NULL, NULL, 194, 891, 3, 1, 0, NULL, NULL, '2024-03-26 08:30:07', '2024-03-26 08:30:07', 1, NULL),
(169, 'Sankar Dey', '', NULL, NULL, 194, 891, 3, 1, 0, NULL, NULL, '2024-03-26 08:30:09', '2024-03-26 08:30:09', 1, NULL),
(170, 'Sankar Dey', '', NULL, NULL, 194, 891, 3, 1, 0, NULL, NULL, '2024-03-26 08:30:09', '2024-03-26 08:30:09', 1, NULL),
(171, 'Sankar Dey', '', NULL, NULL, 194, 891, 3, 1, 0, NULL, NULL, '2024-03-26 08:30:10', '2024-03-26 08:30:10', 1, NULL),
(172, 'Sankar Dey', '', NULL, NULL, 194, 891, 3, 1, 0, NULL, NULL, '2024-03-26 08:30:10', '2024-03-26 08:30:10', 1, NULL),
(173, 'Sankar Dey', '', NULL, NULL, 194, 891, 3, 1, 0, NULL, NULL, '2024-03-26 08:30:10', '2024-03-26 08:30:10', 1, NULL),
(174, 'Sankar Dey', '', NULL, NULL, 194, 891, 3, 1, 0, NULL, NULL, '2024-03-26 08:30:11', '2024-03-26 08:30:11', 1, NULL),
(175, 'Projjwal SENGUPTA', '', NULL, NULL, 200, 905, 3, 1, 0, NULL, NULL, '2024-05-04 07:52:04', '2024-05-04 07:52:04', 1, NULL),
(176, 'Projjwal SENGUPTA', '', NULL, NULL, 200, 905, 3, 1, 0, NULL, NULL, '2024-05-04 07:52:56', '2024-05-04 07:52:56', 1, NULL),
(177, 'Projjwal SENGUPTA', '', NULL, NULL, 200, 905, 3, 1, 0, NULL, NULL, '2024-05-04 07:53:12', '2024-05-04 07:53:12', 1, NULL),
(178, 'Projjwal SENGUPTA', 'SADSDAS', '2024-05-04 13:25:57', 100.00, 201, 905, 10, 1, 0, NULL, NULL, '2024-05-04 07:56:59', '2024-05-04 07:56:59', 1, NULL),
(179, 'Projjwal SENGUPTA', '', NULL, NULL, 201, 905, 3, 1, 0, NULL, NULL, '2024-05-04 07:57:40', '2024-05-04 07:57:40', 1, NULL),
(180, 'Projjwal SENGUPTA', '', NULL, NULL, 201, 905, 3, 1, 0, NULL, NULL, '2024-05-04 08:00:42', '2024-05-04 08:00:42', 1, NULL),
(181, 'test seller', 'SADSDAS', '2024-05-04 13:28:21', 1000000.00, 202, 905, 3, 1, 0, NULL, NULL, '2024-05-04 13:17:08', '2024-05-04 13:17:08', 1, NULL),
(182, 'Harry Singh', '', NULL, NULL, 203, 899, 3, 1, 0, NULL, NULL, '2024-05-16 04:32:20', '2024-05-16 04:32:20', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `agents_shared`
--

CREATE TABLE `agents_shared` (
  `shared_id` int NOT NULL,
  `shared_type` enum('1','2','3','4') NOT NULL COMMENT '1=ask_question,2=upload and share,3=default proposal,4=no value',
  `shared_item_id` int NOT NULL,
  `shared_item_type` enum('1','2') NOT NULL COMMENT '1=post,2=agents',
  `shared_item_type_id` varchar(11) NOT NULL,
  `sender_id` int NOT NULL,
  `sender_role` int NOT NULL,
  `receiver_id` int NOT NULL,
  `receiver_role` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_shared`
--

INSERT INTO `agents_shared` (`shared_id`, `shared_type`, `shared_item_id`, `shared_item_type`, `shared_item_type_id`, `sender_id`, `sender_role`, `receiver_id`, `receiver_role`, `created_at`, `updated_at`) VALUES
(1, '3', 1, '1', '20', 550, 4, 549, 3, '2022-09-19 03:08:32', '2022-09-19 03:08:32'),
(2, '3', 1, '1', '21', 550, 4, 549, 3, '2022-09-19 03:43:04', '2022-09-19 03:43:04'),
(3, '3', 1, '1', '22', 550, 4, 549, 3, '2022-09-19 04:06:26', '2022-09-19 04:06:26'),
(4, '3', 1, '1', '23', 550, 4, 549, 3, '2022-09-19 04:27:23', '2022-09-19 04:27:23'),
(11, '3', 1, '1', '24', 550, 4, 549, 3, '2022-09-19 05:15:01', '2022-09-19 05:15:01'),
(17, '3', 1, '1', '16', 550, 4, 549, 3, '2022-09-30 04:03:24', '2022-09-30 04:03:24'),
(18, '3', 1, '1', '25', 550, 4, 549, 3, '2022-09-30 04:51:18', '2022-09-30 04:51:18'),
(19, '1', 6, '2', '35', 645, 3, 625, 4, '2022-12-08 20:20:55', '2022-12-08 20:20:55'),
(25, '1', 51, '2', '64', 707, 2, 670, 4, '2023-01-09 14:44:13', '2023-01-09 14:44:13'),
(26, '1', 49, '2', '64', 707, 2, 670, 4, '2023-01-09 14:45:01', '2023-01-09 14:45:01'),
(27, '1', 50, '2', '64', 707, 2, 707, 4, '2023-01-09 15:00:19', '2023-01-09 15:00:19'),
(28, '1', 50, '2', '64', 707, 2, 670, 4, '2023-01-09 15:00:28', '2023-01-09 15:00:28'),
(31, '2', 5, '2', '68', 656, 3, 709, 4, '2023-01-11 14:11:35', '2023-01-11 14:11:35'),
(32, '1', 14, '2', '68', 656, 3, 709, 4, '2023-01-11 14:11:46', '2023-01-11 14:11:46'),
(33, '1', 13, '2', '68', 656, 3, 709, 4, '2023-01-11 14:11:48', '2023-01-11 14:11:48'),
(34, '1', 61, '2', '68', 656, 3, 709, 4, '2023-01-11 14:12:01', '2023-01-11 14:12:01'),
(38, '1', 62, '2', '68', 656, 3, 709, 4, '2023-01-11 14:20:03', '2023-01-11 14:20:03'),
(39, '1', 63, '2', '68', 656, 3, 709, 4, '2023-01-11 14:20:07', '2023-01-11 14:20:07'),
(40, '1', 64, '2', '68', 656, 3, 709, 4, '2023-01-11 14:20:15', '2023-01-11 14:20:15'),
(41, '2', 20, '2', '76', 716, 3, 692, 4, '2023-01-21 02:43:23', '2023-01-21 02:43:23'),
(42, '1', 65, '2', '76', 716, 3, 692, 4, '2023-01-21 11:58:31', '2023-01-21 11:58:31'),
(43, '1', 69, '2', '75', 707, 3, 709, 4, '2023-01-31 13:09:29', '2023-01-31 13:09:29'),
(44, '1', 69, '2', '66', 707, 3, 659, 4, '2023-01-31 13:09:37', '2023-01-31 13:09:37'),
(45, '1', 68, '2', '75', 707, 3, 709, 4, '2023-01-31 13:09:57', '2023-01-31 13:09:57'),
(46, '1', 68, '2', '66', 707, 3, 659, 4, '2023-01-31 13:10:01', '2023-01-31 13:10:01'),
(47, '1', 59, '1', '75', 709, 4, 707, 3, '2023-01-31 18:03:49', '2023-01-31 18:03:49'),
(48, '1', 58, '1', '75', 709, 4, 707, 3, '2023-01-31 18:03:52', '2023-01-31 18:03:52'),
(51, '1', 70, '1', '75', 709, 4, 707, 3, '2023-01-31 18:06:51', '2023-01-31 18:06:51'),
(52, '3', 6, '1', '75', 709, 4, 707, 3, '2023-01-31 18:07:10', '2023-01-31 18:07:10'),
(53, '3', 5, '1', '75', 709, 4, 707, 3, '2023-01-31 18:07:16', '2023-01-31 18:07:16'),
(56, '1', 74, '2', '103', 739, 2, 735, 4, '2023-02-05 16:39:37', '2023-02-05 16:39:37'),
(59, '1', 82, '2', '124', 767, 3, 774, 4, '2023-03-16 22:44:09', '2023-03-16 22:44:09'),
(60, '1', 81, '2', '124', 767, 3, 774, 4, '2023-03-16 22:44:11', '2023-03-16 22:44:11'),
(61, '1', 83, '2', '135', 784, 3, 781, 4, '2023-04-13 15:42:46', '2023-04-13 15:42:46'),
(62, '1', 86, '2', '134', 784, 3, 786, 4, '2023-04-13 17:17:52', '2023-04-13 17:17:52'),
(63, '1', 87, '2', '134', 784, 3, 786, 4, '2023-04-13 17:18:23', '2023-04-13 17:18:23'),
(64, '1', 88, '2', '134', 784, 3, 786, 4, '2023-04-13 17:18:37', '2023-04-13 17:18:37'),
(65, '1', 94, '1', '134', 809, 4, 784, 4, '2023-05-15 15:12:36', '2023-05-15 15:13:09'),
(66, '1', 94, '1', '134', 809, 4, 786, 4, '2023-05-15 15:16:12', '2023-05-15 15:16:12'),
(68, '1', 101, '2', '137', 828, 3, 830, 4, '2023-06-03 14:45:41', '2023-06-03 14:45:41'),
(69, '1', 102, '2', '137', 828, 3, 830, 4, '2023-06-03 14:46:31', '2023-06-03 14:46:31'),
(70, '1', 103, '2', '137', 828, 3, 830, 4, '2023-06-03 14:46:46', '2023-06-03 14:46:46'),
(75, '2', 53, '2', '153', 841, 2, 842, 4, '2023-08-09 16:27:13', '2023-08-09 16:27:13'),
(76, '1', 130, '1', '111', 670, 4, 762, 3, '2023-08-10 15:17:19', '2023-08-10 15:17:19'),
(77, '1', 131, '1', '111', 670, 4, 762, 3, '2023-08-10 15:17:31', '2023-08-10 15:17:31'),
(78, '1', 132, '1', '111', 670, 4, 762, 3, '2023-08-10 15:17:41', '2023-08-10 15:17:41'),
(79, '1', 133, '1', '111', 670, 4, 762, 3, '2023-08-10 15:19:36', '2023-08-10 15:19:36'),
(80, '1', 134, '1', '111', 670, 4, 762, 3, '2023-08-10 15:23:22', '2023-08-10 15:23:22'),
(81, '1', 140, '1', '111', 670, 4, 762, 3, '2023-08-17 12:04:26', '2023-08-17 12:04:26'),
(82, '1', 141, '1', '111', 670, 4, 762, 3, '2023-08-17 12:16:10', '2023-08-17 12:16:10'),
(83, '1', 142, '1', '111', 670, 4, 762, 3, '2023-08-17 12:17:57', '2023-08-17 12:17:57'),
(84, '1', 143, '1', '111', 670, 4, 762, 3, '2023-08-17 12:23:00', '2023-08-17 12:23:00'),
(85, '1', 144, '1', '111', 670, 4, 762, 3, '2023-08-17 12:23:24', '2023-08-17 12:23:24'),
(86, '1', 158, '1', '111', 670, 4, 762, 3, '2023-08-17 16:12:05', '2023-08-17 16:12:05'),
(87, '1', 159, '1', '111', 670, 4, 762, 3, '2023-08-17 16:12:13', '2023-08-17 16:12:13'),
(88, '1', 160, '1', '111', 670, 4, 762, 3, '2023-08-17 16:12:21', '2023-08-17 16:12:21'),
(89, '1', 161, '1', '111', 670, 4, 762, 3, '2023-08-17 16:12:30', '2023-08-17 16:12:30'),
(90, '1', 162, '1', '111', 832, 4, 762, 3, '2023-08-17 16:20:46', '2023-08-17 16:20:46'),
(92, '1', 166, '2', '179', 876, 3, 878, 4, '2024-02-08 18:48:20', '2024-02-08 18:48:20'),
(94, '1', 168, '2', '201', 904, 2, 905, 4, '2024-05-04 13:00:42', '2024-05-04 13:00:42');

-- --------------------------------------------------------

--
-- Table structure for table `agents_state`
--

CREATE TABLE `agents_state` (
  `state_id` int NOT NULL,
  `state_name` varchar(250) NOT NULL,
  `state_code` varchar(250) NOT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=no,1=yes',
  `status` int NOT NULL DEFAULT '1' COMMENT '0="De-active", 1="active"',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_state`
--

INSERT INTO `agents_state` (`state_id`, `state_name`, `state_code`, `is_deleted`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Alaska', 'AA', '1', 1, '2017-10-28 14:41:59', '2017-11-01 09:05:15'),
(2, 'Armed Forces', 'AE', '0', 1, '2017-10-28 14:42:08', '2017-10-28 14:42:08'),
(3, 'Armed Forces Pacific', 'AP', '0', 1, '2017-10-28 14:42:18', '2017-12-30 11:42:09'),
(4, 'California', 'CA', '0', 1, '2017-10-28 14:42:42', '2017-10-28 14:42:42'),
(5, 'Washington DC (District of Columbia)', 'DC ', '0', 1, '2017-10-28 14:42:42', '2017-10-28 14:42:42'),
(6, 'Indiana', 'IN', '0', 1, '2017-10-28 14:42:59', '2017-10-28 14:42:59'),
(7, 'Kansas', 'KS', '0', 1, '2017-10-28 14:43:10', '2017-10-28 14:43:10'),
(8, 'Florida', 'FA', '1', 1, '2017-12-30 11:43:02', '2017-12-30 11:43:02'),
(9, 'MP', 'mp', '1', 1, '2018-01-02 07:57:34', '2018-01-02 07:57:34'),
(10, 'Arizonaa', 'AK', '1', 1, '2018-06-10 14:14:57', '2020-12-08 04:32:17'),
(11, 'my state', 'bs', '1', 1, '2020-12-06 17:58:28', '2020-12-06 17:58:28'),
(12, 'Arizona', 'AK', '0', 1, '2020-12-08 04:32:54', '2020-12-08 04:32:54'),
(13, 'nevada', '32', '0', 1, '2023-02-05 01:25:09', '2023-02-05 01:25:09'),
(14, 'new jersey', '87545', '0', 1, '2023-03-03 20:36:26', '2023-03-03 20:36:26');

-- --------------------------------------------------------

--
-- Table structure for table `agents_survey`
--

CREATE TABLE `agents_survey` (
  `survey_id` int NOT NULL,
  `agents_user_id` int NOT NULL,
  `agents_users_role_id` int NOT NULL,
  `question_id` int NOT NULL,
  `is_deleted` enum('0','1') NOT NULL COMMENT '0=no,1=yes',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `agents_survey`
--

INSERT INTO `agents_survey` (`survey_id`, `agents_user_id`, `agents_users_role_id`, `question_id`, `is_deleted`, `created_at`, `updated_at`) VALUES
(2, 645, 3, 6, '0', '2022-12-08 20:20:13', '2022-12-08 20:20:13'),
(4, 656, 3, 13, '0', '2022-12-12 11:30:59', '2022-12-12 11:30:59'),
(5, 656, 3, 14, '0', '2022-12-12 11:31:13', '2022-12-12 11:31:13'),
(7, 671, 3, 17, '0', '2022-12-27 13:00:23', '2022-12-27 13:00:23'),
(8, 671, 3, 18, '0', '2022-12-27 13:00:37', '2022-12-27 13:00:37'),
(9, 671, 3, 19, '0', '2022-12-27 13:01:06', '2022-12-27 13:01:06'),
(10, 671, 3, 21, '0', '2022-12-27 13:02:20', '2022-12-27 13:02:20'),
(12, 671, 3, 23, '0', '2022-12-27 07:04:15', '2022-12-27 07:04:15'),
(13, 671, 3, 24, '0', '2022-12-27 13:08:58', '2022-12-27 13:08:58'),
(14, 671, 3, 25, '0', '2022-12-27 13:09:38', '2022-12-27 13:09:38'),
(16, 671, 3, 29, '0', '2022-12-27 13:11:26', '2022-12-27 13:11:26'),
(17, 671, 3, 30, '0', '2022-12-27 13:11:34', '2022-12-27 13:11:34'),
(20, 672, 4, 31, '0', '2022-12-27 07:43:57', '2022-12-27 07:43:57'),
(21, 672, 4, 33, '0', '2022-12-27 13:45:49', '2022-12-27 13:45:49'),
(23, 672, 4, 35, '0', '2022-12-27 13:46:17', '2022-12-27 13:46:17'),
(24, 672, 4, 36, '0', '2022-12-30 02:16:34', '2022-12-30 02:16:34'),
(25, 672, 4, 37, '0', '2022-12-30 02:16:59', '2022-12-30 02:16:59'),
(29, 549, 3, 42, '0', '2022-12-30 02:36:55', '2022-12-30 02:36:55'),
(30, 549, 3, 43, '0', '2022-12-30 02:39:51', '2022-12-30 02:39:51'),
(31, 549, 3, 44, '0', '2022-12-30 02:40:12', '2022-12-30 02:40:12'),
(32, 549, 3, 45, '0', '2022-12-30 02:40:30', '2022-12-30 02:40:30'),
(33, 549, 3, 46, '0', '2022-12-30 02:42:48', '2022-12-30 02:42:48'),
(34, 549, 3, 47, '0', '2022-12-30 02:43:38', '2022-12-30 02:43:38'),
(35, 549, 3, 48, '0', '2022-12-30 02:44:07', '2022-12-30 02:44:07'),
(36, 707, 2, 49, '0', '2023-01-09 14:42:13', '2023-01-09 14:42:13'),
(37, 707, 2, 50, '0', '2023-01-09 14:42:28', '2023-01-09 14:42:28'),
(38, 707, 2, 51, '0', '2023-01-09 14:43:07', '2023-01-09 14:43:07'),
(39, 1, 1, 11, '0', '2023-01-10 03:43:49', '2023-01-10 03:47:07'),
(41, 709, 4, 54, '0', '2023-01-11 12:14:22', '2023-01-11 12:14:22'),
(42, 709, 4, 55, '0', '2023-01-11 12:14:35', '2023-01-11 12:14:35'),
(43, 709, 4, 56, '0', '2023-01-11 12:16:32', '2023-01-11 12:16:32'),
(45, 709, 4, 58, '0', '2023-01-11 12:17:22', '2023-01-11 12:17:22'),
(46, 709, 4, 59, '0', '2023-01-11 12:17:38', '2023-01-11 12:17:38'),
(47, 709, 4, 60, '0', '2023-01-11 12:18:22', '2023-01-11 12:18:22'),
(49, 656, 3, 61, '0', '2023-01-11 14:12:00', '2023-01-11 14:12:00'),
(50, 656, 3, 62, '0', '2023-01-11 14:12:07', '2023-01-11 14:12:07'),
(51, 656, 3, 63, '0', '2023-01-11 14:13:36', '2023-01-11 14:13:36'),
(52, 656, 3, 64, '0', '2023-01-11 14:20:14', '2023-01-11 14:20:14'),
(53, 1, 1, 52, '0', '2023-01-16 18:02:47', '2023-04-29 16:03:47'),
(54, 707, 3, 66, '0', '2023-01-31 13:06:55', '2023-01-31 13:06:55'),
(55, 707, 3, 67, '0', '2023-01-31 13:07:27', '2023-01-31 13:07:27'),
(56, 707, 3, 68, '0', '2023-01-31 13:07:51', '2023-01-31 13:07:51'),
(57, 709, 4, 70, '0', '2023-01-31 18:06:51', '2023-01-31 18:06:51'),
(61, 762, 3, 75, '0', '2023-03-03 14:46:49', '2023-03-03 14:46:49'),
(62, 762, 3, 76, '0', '2023-03-03 14:50:58', '2023-03-03 14:50:58'),
(66, 763, 4, 80, '0', '2023-03-03 16:49:25', '2023-03-03 16:49:25'),
(67, 767, 3, 81, '0', '2023-03-16 22:41:27', '2023-03-16 22:41:27'),
(68, 767, 3, 82, '0', '2023-03-16 22:42:28', '2023-03-16 22:42:28'),
(69, 784, 3, 83, '0', '2023-04-13 15:42:45', '2023-04-13 15:42:45'),
(70, 786, 4, 85, '0', '2023-04-13 16:29:14', '2023-04-13 16:29:14'),
(71, 787, 4, 89, '0', '2023-05-02 10:25:39', '2023-05-02 10:25:39'),
(73, 519, 3, 1, '0', '2023-05-15 06:59:08', '2023-05-15 06:59:08'),
(74, 519, 3, 1, '0', '2023-05-15 07:15:17', '2023-05-15 07:15:17'),
(75, 519, 3, 1, '0', '2023-05-15 07:27:38', '2023-05-15 07:27:38'),
(77, 809, 4, 95, '0', '2023-05-15 15:17:29', '2023-05-15 15:17:29'),
(79, 810, 3, 98, '0', '2023-05-22 14:52:10', '2023-05-22 14:52:10'),
(80, 787, 4, 99, '0', '2023-05-25 17:12:08', '2023-05-25 17:12:08'),
(81, 828, 3, 101, '0', '2023-06-03 14:43:55', '2023-06-03 14:43:55'),
(82, 828, 3, 102, '0', '2023-06-03 14:46:30', '2023-06-03 14:46:30'),
(83, 828, 3, 103, '0', '2023-06-03 14:46:45', '2023-06-03 14:46:45'),
(84, 834, 4, 1, '0', '2023-07-14 09:51:38', '2023-07-14 09:51:38'),
(85, 834, 4, 1, '0', '2023-07-17 06:43:30', '2023-07-17 06:43:30'),
(86, 839, 3, 107, '0', '2023-07-18 09:51:58', '2023-07-18 09:51:58'),
(87, 840, 3, 112, '0', '2023-08-01 11:39:44', '2023-08-01 11:39:44'),
(93, 841, 2, 120, '0', '2023-08-01 16:01:28', '2023-08-01 16:01:28'),
(94, 841, 2, 121, '0', '2023-08-01 16:01:38', '2023-08-01 16:01:38'),
(95, 841, 2, 122, '0', '2023-08-01 16:01:55', '2023-08-01 16:01:55'),
(96, 841, 2, 123, '0', '2023-08-01 16:02:05', '2023-08-01 16:02:05'),
(97, 846, 3, 124, '0', '2023-08-09 15:40:59', '2023-08-09 15:40:59'),
(98, 846, 3, 125, '0', '2023-08-09 15:44:04', '2023-08-09 15:44:04'),
(99, 846, 3, 126, '0', '2023-08-09 15:47:09', '2023-08-09 15:47:09'),
(100, 846, 3, 127, '0', '2023-08-09 15:52:08', '2023-08-09 15:52:08'),
(101, 846, 3, 128, '0', '2023-08-09 15:52:22', '2023-08-09 15:52:22'),
(102, 846, 3, 129, '0', '2023-08-09 15:53:20', '2023-08-09 15:53:20'),
(103, 670, 4, 130, '0', '2023-08-10 15:17:18', '2023-08-10 15:17:18'),
(104, 670, 4, 131, '0', '2023-08-10 15:17:31', '2023-08-10 15:17:31'),
(105, 670, 4, 132, '0', '2023-08-10 15:17:41', '2023-08-10 15:17:41'),
(106, 839, 3, 135, '0', '2023-08-17 10:20:11', '2023-08-17 10:20:11'),
(107, 839, 3, 136, '0', '2023-08-17 10:23:12', '2023-08-17 10:23:12'),
(108, 839, 3, 137, '0', '2023-08-17 10:28:51', '2023-08-17 10:28:51'),
(109, 839, 3, 138, '0', '2023-08-17 10:29:20', '2023-08-17 10:29:20'),
(110, 670, 4, 142, '0', '2023-08-17 12:17:56', '2023-08-17 12:17:56'),
(111, 670, 4, 143, '0', '2023-08-17 12:22:59', '2023-08-17 12:22:59'),
(112, 670, 4, 144, '0', '2023-08-17 12:23:23', '2023-08-17 12:23:23'),
(114, 840, 3, 117, '0', '2023-08-17 09:39:05', '2023-08-17 09:39:05'),
(115, 670, 4, 145, '0', '2023-08-17 15:18:57', '2023-08-17 15:18:57'),
(116, 670, 4, 146, '0', '2023-08-17 15:19:21', '2023-08-17 15:19:21'),
(117, 670, 4, 147, '0', '2023-08-17 15:19:42', '2023-08-17 15:19:42'),
(118, 840, 3, 149, '0', '2023-08-17 15:26:24', '2023-08-17 15:26:24'),
(119, 840, 3, 152, '0', '2023-08-17 15:27:40', '2023-08-17 15:27:40'),
(120, 840, 3, 154, '0', '2023-08-17 15:28:30', '2023-08-17 15:28:30'),
(121, 840, 3, 155, '0', '2023-08-17 15:28:40', '2023-08-17 15:28:40'),
(122, 840, 3, 156, '0', '2023-08-17 15:28:54', '2023-08-17 15:28:54'),
(124, 670, 4, 158, '0', '2023-08-17 16:12:05', '2023-08-17 16:12:05'),
(125, 670, 4, 159, '0', '2023-08-17 16:12:13', '2023-08-17 16:12:13'),
(126, 670, 4, 160, '0', '2023-08-17 16:12:21', '2023-08-17 16:12:21'),
(127, 670, 4, 161, '0', '2023-08-17 16:12:29', '2023-08-17 16:12:29'),
(128, 548, 2, 165, '0', '2024-01-31 17:23:18', '2024-01-31 17:23:18'),
(130, 884, 2, 167, '0', '2024-03-07 14:07:48', '2024-03-07 14:07:48');

-- --------------------------------------------------------

--
-- Table structure for table `agents_survey_send`
--

CREATE TABLE `agents_survey_send` (
  `survey_send_id` int NOT NULL,
  `survey_id` int DEFAULT NULL,
  `question_id` int DEFAULT NULL,
  `agents_user_id` int DEFAULT NULL,
  `agents_users_role_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `agents_upload_share_all`
--

CREATE TABLE `agents_upload_share_all` (
  `upload_share_id` int NOT NULL,
  `agents_user_id` int NOT NULL,
  `agents_users_role_id` int NOT NULL,
  `attachments` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=no,1=yes',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_upload_share_all`
--

INSERT INTO `agents_upload_share_all` (`upload_share_id`, `agents_user_id`, `agents_users_role_id`, `attachments`, `name`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 549, 2, 'http://127.0.0.1:8000/assets/img/upload_and_share/1663103323.PNG', 'again new test update', '1', '2022-09-13 21:05:36', '2024-01-27 18:44:09'),
(2, 548, 2, 'http://127.0.0.1:8000/assets/img/upload_and_share/1663277856.pdf', 'pdf', '0', '2022-09-15 21:37:36', '2022-09-15 21:37:36'),
(3, 548, 2, 'http://127.0.0.1:8000/assets/img/upload_and_share/1663278358.pdf', 'dssd', '0', '2022-09-15 21:45:58', '2022-09-15 21:45:58'),
(4, 645, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1670509025.pdf', 'test file', '0', '2022-12-08 14:17:05', '2022-12-08 14:17:05'),
(5, 656, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1670823397.png', 'm', '0', '2022-12-12 05:36:37', '2022-12-12 05:36:37'),
(6, 651, 2, 'https://dev.92agents.com/assets/img/upload_and_share/1671180522.pdf', 'Eula Blanda', '1', '2022-12-16 08:48:42', '2022-12-16 14:48:56'),
(7, 671, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1672123953.png', 'Seller File', '0', '2022-12-27 06:52:09', '2022-12-27 12:52:33'),
(8, 671, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1672123980.png', 'Seller File1', '0', '2022-12-27 06:53:00', '2022-12-27 06:53:00'),
(9, 671, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1672124000.pdf', 'Seller PDF', '0', '2022-12-27 06:53:20', '2022-12-27 06:53:20'),
(10, 672, 4, 'https://dev.92agents.com/assets/img/upload_and_share/1672126940.pdf', 'Rstretwr', '0', '2022-12-27 07:42:20', '2022-12-27 07:42:20'),
(11, 672, 4, 'https://dev.92agents.com/assets/img/upload_and_share/1672126962.pdf', 'sdfdsf', '0', '2022-12-27 07:42:42', '2022-12-27 07:42:42'),
(12, 646, 2, 'https://dev.92agents.com/assets/img/upload_and_share/1672136489.jpg', 'Project Land', '0', '2022-12-27 10:21:29', '2022-12-27 10:21:29'),
(13, 707, 2, 'https://dev.92agents.com/assets/img/upload_and_share/1673254049.png', 'File', '0', '2023-01-09 08:47:29', '2023-01-09 08:47:29'),
(14, 707, 2, 'https://dev.92agents.com/assets/img/upload_and_share/1673254092.docx', 'Video', '0', '2023-01-09 08:48:12', '2023-01-09 08:48:12'),
(15, 707, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1673256594.docx', 'file1', '0', '2023-01-09 09:29:54', '2023-01-09 09:29:54'),
(16, 707, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1673256643.pdf', 'dgdfg', '0', '2023-01-09 09:30:43', '2023-01-09 09:30:43'),
(17, 709, 4, 'https://dev.92agents.com/assets/img/upload_and_share/1673417523.pdf', 'Test Document', '0', '2023-01-11 06:12:03', '2023-01-11 06:12:03'),
(18, 709, 4, 'https://dev.92agents.com/assets/img/upload_and_share/1673417581.pdf', 'Test Document1', '0', '2023-01-11 06:13:01', '2023-01-11 06:13:01'),
(19, 714, 2, 'https://dev.92agents.com/assets/img/upload_and_share/1673870039.pdf', 'Test121', '0', '2023-01-16 11:53:59', '2023-01-16 11:53:59'),
(20, 716, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1674247255.pdf', 'testfile', '0', '2023-01-20 20:40:55', '2023-01-20 20:40:55'),
(21, 735, 4, 'https://dev.92agents.com/assets/img/upload_and_share/1675546234.pdf', 'abcd', '0', '2023-02-04 21:30:34', '2023-02-04 21:30:34'),
(22, 739, 2, 'https://dev.92agents.com/assets/img/upload_and_share/1675593671.pdf', 'How to Make Your Roofing Career a Success', '0', '2023-02-05 10:41:11', '2023-02-05 10:41:11'),
(23, 651, 2, 'https://dev.92agents.com/assets/img/upload_and_share/1676276273.jpg', 'dfgdgar', '0', '2023-02-13 08:17:53', '2023-02-13 08:17:53'),
(24, 651, 2, 'https://dev.92agents.com/assets/img/upload_and_share/1676276302.jpg', 'building', '0', '2023-02-13 08:18:22', '2023-02-13 08:18:22'),
(25, 756, 4, 'https://dev.92agents.com/assets/img/upload_and_share/1677833671.pdf', 'Development eco', '0', '2023-03-03 08:54:31', '2023-03-03 08:54:31'),
(26, 762, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1677835916.pdf', 'test123', '0', '2023-03-03 09:31:56', '2023-03-03 09:31:56'),
(27, 767, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1679140651.pdf', 'Tech', '1', '2023-03-18 11:57:31', '2023-03-18 16:58:26'),
(28, 778, 4, 'https://dev.92agents.com/assets/img/upload_and_share/1679886662.pdf', 'asdad', '0', '2023-03-27 03:11:02', '2023-03-27 03:11:02'),
(29, 784, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1681383419.pdf', 'asdasd', '0', '2023-04-13 10:56:59', '2023-04-13 10:56:59'),
(30, 786, 4, 'https://dev.92agents.com/assets/img/upload_and_share/1681385711.pdf', 'dfsdf', '1', '2023-04-13 11:35:11', '2023-04-13 16:35:34'),
(31, 786, 4, 'https://dev.92agents.com/assets/img/upload_and_share/1681385825.pdf', 'sdasdasd', '0', '2023-04-13 11:37:05', '2023-04-13 11:37:05'),
(32, 810, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1685353165.pdf', 'NEW', '0', '2023-05-29 09:39:25', '2023-05-29 09:39:25'),
(33, 828, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1685788455.png', 'test', '0', '2023-06-03 10:34:15', '2023-06-03 10:34:15'),
(34, 829, 2, 'https://dev.92agents.com/assets/img/upload_and_share/1685789550.pdf', 'asdasd', '0', '2023-06-03 10:52:30', '2023-06-03 10:52:30'),
(35, 839, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1689759562.pdf', 'qwer', '1', '2023-07-19 09:39:22', '2023-07-19 15:10:11'),
(36, 839, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1689761153.pdf', 'qwert', '1', '2023-07-19 09:56:26', '2023-07-19 15:13:03'),
(37, 839, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1689760704.pdf', 'qwert', '0', '2023-07-19 09:58:24', '2023-07-19 09:58:24'),
(38, 835, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1689923257.png', 'qwe', '1', '2023-07-21 07:07:37', '2023-07-21 12:12:54'),
(39, 835, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1689923276.png', 'ert', '1', '2023-07-21 07:07:56', '2023-07-21 12:12:45'),
(40, 835, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1689923531.pdf', 'rgf', '1', '2023-07-21 07:12:11', '2023-07-28 12:44:02'),
(41, 835, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1690527574.pdf', 'demo pdf', '1', '2023-07-28 06:59:34', '2023-07-28 12:43:41'),
(42, 835, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1690527609.pdf', 'demo pdf', '1', '2023-07-28 07:00:09', '2023-07-28 12:43:00'),
(43, 835, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1690527708.pdf', 'demo file 2', '1', '2023-07-28 07:01:48', '2023-07-28 12:56:10'),
(44, 835, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1690528067.pdf', '3rd demo', '1', '2023-07-28 07:07:47', '2023-07-28 12:41:43'),
(45, 835, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1690528143.pdf', '4th upload', '1', '2023-07-28 07:09:03', '2023-07-28 12:56:14'),
(46, 835, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1690528226.jpeg', 'file name', '1', '2023-07-28 07:10:26', '2023-07-28 12:42:54'),
(47, 835, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1690537176.pdf', 'Demo', '1', '2023-07-28 09:39:36', '2023-07-28 14:48:38'),
(48, 835, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1690537705.pdf', 'hajsvcj', '0', '2023-07-28 09:48:25', '2023-07-28 09:48:25'),
(49, 840, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1690790297.png', 'Test', '1', '2023-07-31 07:58:17', '2023-07-31 12:58:39'),
(50, 840, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1690790443.png', 'g', '0', '2023-07-31 07:59:23', '2023-07-31 13:00:43'),
(51, 840, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1690790491.docx', 'a', '0', '2023-07-31 08:01:31', '2023-07-31 08:01:31'),
(52, 840, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1690790532.pdf', 'g1', '0', '2023-07-31 08:02:12', '2023-07-31 08:02:12'),
(53, 841, 2, 'https://dev.92agents.com/assets/img/upload_and_share/1690887676.pdf', 'Test', '0', '2023-08-01 11:01:16', '2023-08-01 11:01:16'),
(54, 670, 4, 'https://dev.92agents.com/assets/img/upload_and_share/1691652743.png', 'Test', '1', '2023-08-10 07:32:23', '2023-08-10 12:33:51'),
(55, 670, 4, 'https://dev.92agents.com/assets/img/upload_and_share/1691652955.png', 'Tst', '1', '2023-08-10 07:35:55', '2023-08-10 12:36:07'),
(56, 670, 4, 'https://dev.92agents.com/assets/img/upload_and_share/1691653013.png', 'Test1', '1', '2023-08-10 07:36:29', '2023-08-17 15:42:47'),
(57, 670, 4, 'https://dev.92agents.com/assets/img/upload_and_share/1691653122.png', 'https://drive.google.com/file/d/16ZlbTuxGkTKCMpANMiBaup0nMPBx7nfc/view?usp=drive_linkhttps://drive.google.com/file/d/16ZlbTuxGkTKCMpANMiBaup0nMPBx7nfc/view?usp=drive_linkhttps://drive.google.com/file/d/16ZlbTuxGkTKCMpANMiBaup0nMPBx7nfc/view?usp=drive_link', '1', '2023-08-10 07:38:42', '2023-08-17 15:42:37'),
(58, 832, 4, 'https://dev.92agents.com/assets/img/upload_and_share/1692253485.pdf', 'Dheeraj Kumawat', '1', '2023-08-17 06:24:45', '2023-08-17 15:40:03'),
(59, 859, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1701843983.png', 'Sample file', '1', '2023-12-06 06:26:23', '2023-12-06 12:32:35'),
(60, 859, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1701844411.jpg', 'Accessories', '0', '2023-12-06 06:33:31', '2023-12-06 06:33:31'),
(61, 861, 2, 'https://dev.92agents.com/assets/img/upload_and_share/1701944990.jpg', 'Sample file', '0', '2023-12-07 10:29:50', '2023-12-07 10:29:50'),
(62, 548, 2, 'https://dev.92agents.com/assets/img/upload_and_share/1706359693.png', '99ff', '0', '2024-01-27 12:48:13', '2024-01-27 12:48:13'),
(63, 873, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1707198443.pdf', 'Test', '0', '2024-02-06 05:47:23', '2024-02-06 05:47:23'),
(64, 876, 3, 'https://dev.92agents.com/assets/img/upload_and_share/1707397255.pdf', 'test', '0', '2024-02-08 13:00:55', '2024-02-08 13:00:55');

-- --------------------------------------------------------

--
-- Table structure for table `agents_users`
--

CREATE TABLE `agents_users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `activation_link` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `forgot_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `agents_users_role_id` enum('1','2','3','4','5','6') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `agent_status` enum('1','0','2','3') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=no,1=yes, 2=Temp Suspension for closing date,3=Permanent Suspension for closing date',
  `step` enum('0','1','2','3') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'step level',
  `language` enum('en','dk') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en',
  `status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '1 = active, 0= deactive',
  `first_login` enum('1','2') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=yes,2=no',
  `login_status` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'online',
  `api_token` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT ' ',
  `is_deleted` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0 = no, 1= yes',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `card_number` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_on_card` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cvc` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_expiry_year` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_id` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_expiry_month` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `package` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fcm_token` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `device_type` varchar(24) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `agents_users`
--

INSERT INTO `agents_users` (`id`, `email`, `password`, `remember_token`, `activation_link`, `forgot_token`, `agents_users_role_id`, `agent_status`, `step`, `language`, `status`, `first_login`, `login_status`, `api_token`, `is_deleted`, `created_at`, `updated_at`, `card_number`, `name_on_card`, `cvc`, `card_expiry_year`, `customer_id`, `card_expiry_month`, `package`, `fcm_token`, `device_type`) VALUES
(1, 'admin@admin.com', '$2y$10$PVDWm4Ofj6VjMiUQOI5OXu9pDhN5GZEjVc3peEPvmZ2w5o8j/TuXW', 'H21KSzS3jjr8LL7lc5x0ps3lUa2RGim6nZzHKqzzJq7ztYU7jwNcrt6Qy18q', NULL, NULL, '1', '0', '3', 'en', '1', '2', 'Online', '', '0', '2017-12-28 00:00:00', '2024-03-23 21:28:11', '702310816082', 'pan', '55', '2050', NULL, '55', NULL, NULL, NULL),
(517, 'abc@yopmail.com', '$2y$10$LiOBHrfIR0Xd1wUMBfOKjugTSIwFfyrT6uPOlRURkaDEMR3o.VyW.', '5Xu6jV9RbXukAhaw2F4VG5bcibu2oPTpWyz80tCjc4W6n3pM34xP6z0ZCf09', '62ee416135404', '$2y$10$WKHB9jSVckiS2jt0O3zIm.xsT1dcR77xVqgw0ew5NjGfS1xgitPmq', '2', '0', '1', 'en', '1', '1', 'Offline', '2022-08-15 13:59:01', '0', '2022-08-06 10:24:33', '2024-02-02 12:14:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(518, 'smitha501@yopmail.com', '$2y$10$xXyX/Rv5gkf06VS5y2xP5ON9n4spFJFLgDGJZOKyDBUw05sfgiwLu', NULL, '62f32d079b0a9', NULL, '3', '0', '3', 'en', '1', '1', 'online', '$2y$10$htRlgDSxL2FZ9if1jFDlFOhSnZozMk/yP6MM44n/6aknJjCS8.8eG', '1', '2022-08-10 03:59:03', '2022-08-10 03:59:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(519, 'smitha502@yopmail.com', '$2y$10$N3q7xOFnREdksvxPkDuN6O7eP.d4gNzXYy26S11M9sWSJqVF1mS9K', NULL, '62f3463ccbe4e', '$2y$10$RhaWa.GpoArCTmR8qs8c6O8j30bNH6t1uPKBoK3ZVOTtDM46urO', '3', '0', '3', 'en', '1', '1', 'Online', '2022-08-10 08:10:55', '0', '2022-08-10 05:46:36', '2023-07-18 07:00:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(520, 'folly@mailinator.com', '$2y$10$xvLT0y4IhGubrmL9GAeSa.IZ2Re8BisR2qlS.6QWRyJc1Fq/a9zS6', NULL, '62f34d33ed7eb', '$2y$10$DjXVafCFnRoRqglLPgz1YulZhLRraoCmlU31WCGVSBMqvjh.XdX12', '2', '0', '3', 'en', '0', '1', 'online', '$2y$10$LUeiNL.rTK5TkL3ItcIde.m4DX3l/6GtXh210axG7rcWdgDbd.Mmy', '1', '2022-08-10 06:16:20', '2022-08-10 10:33:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(521, 'florance@mailinator.com', '$2y$10$dNZX/PxJfby/EUbUX31pL.QJo25jZoq.NwI1LVOmHE3M2dhVmcbjm', 'X4uaF45VyshHzPfW0ipeqFIS1jwlbn7wM59ca6kOScAaECI0T1DIMpoon55J', '62f38a4fe60cb', NULL, '2', '0', '3', 'en', '1', '1', 'Online', '2022-08-10 18:54:11', '0', '2022-08-10 10:37:04', '2022-08-10 18:54:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(522, 'testing@test.com', '$2y$10$dF5Iw3Bp4MMW7RAksvB9P.KZqgPNmAak8tnt.F7C7W5ByJm/fOrzq', NULL, '62f90b6a99dc8', NULL, '3', '0', '1', 'en', '0', '1', 'online', '$2y$10$XWAWB/nP/CsiP5IfNzQ3fe/gZ3F2JiGbF2PqIB3f82jK8DolEKP26', '0', '2022-08-14 14:49:14', '2022-08-14 14:49:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(523, 'abc@testing.com', '$2y$10$FkmxJbmV8GFaS4TrKqMotezfpqqfbnas/dPCJlx0u4bsSkNIjs53S', NULL, '62f90d3aa8bc1', NULL, '3', '0', '1', 'en', '1', '1', 'Online', '$2y$10$lllEBljNBlMDqAhQXs6ogusvDuow.KNUL0LdBcW0/QIJ1g/CVhbDi', '0', '2022-08-14 14:56:58', '2023-07-17 08:10:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(524, 'file@testing.om', '$2y$10$smT5T8dIhBgkAP4zIoi1.OVDj8o72XjnHX9iH2/h./iwtPqlcMmya', NULL, '62f90d65a464c', NULL, '3', '0', '3', 'en', '0', '1', 'online', '$2y$10$BzYrCxykzWsd05Tfe4R68uCCZ1Gjk91UDLDE8GJvvp13XCs1mUSDK', '0', '2022-08-14 14:57:41', '2022-08-15 13:32:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(525, 'kpujara26@gmail.com', '$2y$10$eHsIrRwHStdIFlU/GXW.M.pt9uQi0dgXPugaBUEh.mprdzjFRe8rC', NULL, '62f9e59eee650', NULL, '3', '0', '2', 'en', '0', '1', 'online', '$2y$10$pGz5Y3k/0RnEYk7T95qIceCUkHvg4mA1ePZ5XLjVmzPCS3g/E92EC', '0', '2022-08-15 06:20:15', '2022-08-15 06:20:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(526, 'kpujara27@gmail.com', '$2y$10$aALdFlJfDrcSIkg8ejbvlOlEUPZZ4EV2ZjSJuYc4jcxBfkCM9XYKG', NULL, '62f9e609a9dc0', NULL, '2', '0', '2', 'en', '0', '1', 'online', '$2y$10$wsY1OMbTSTpkuDxg5PM9ZO2Mn4D1J11a.C/LDaPnvgchS3z.MAL8a', '0', '2022-08-15 06:22:01', '2022-08-15 06:22:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(527, 'kpujara28@gmail.com', '$2y$10$4KTxAV8MNUL946bc5RYcleN148Trz8H7vtT.j50vjLUz0KCH0bh0O', NULL, '62f9e63eac18b', NULL, '4', '0', '2', 'en', '0', '1', 'online', '$2y$10$UjhXEMPw7Fr.eSwcHP0GQuPbuJdZkAMlrbCh7Jq6Zsojh2UCmbrB.', '0', '2022-08-15 06:22:54', '2022-08-15 06:23:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(528, 'abcd@testing.com', '$2a$12$c5ZFEifQclxvUUOccdfEQ.GzCbbyvJ9Jf7kJbWc.zEa/T7JtKaRTW', NULL, '62f9e81a1c599', NULL, '3', '0', '1', 'en', '0', '1', 'online', '$2y$10$t4RjTKNwGF483snWB0skUuC/1orDCKy3wODKNPVQfIPeJI2AxhLMe', '0', '2022-08-15 06:30:50', '2022-08-15 06:30:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(529, 'abcdd@testing.com', '$2y$10$ysb0OuGexEhg8H8Li3N7IeFMCKS3beaq8ajcl5I5fU8NuDicRMjDe', NULL, '62fa3d730b2a6', NULL, '3', '0', '1', 'en', '0', '1', 'online', '$2y$10$bj8ZZskSC7FkTmfxpQVMxeeEeRaqZbfShoUc6DUC1glHXtvuwIaOq', '0', '2022-08-15 12:34:59', '2022-08-15 12:34:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(530, 'kpujara265@gmail.com', '$2y$10$St72hFnmsSgYyTPZGHLy2OqDsbuRYXtp1LHegOKca4NBqXbw4rYCa', NULL, '62fa4732526ac', NULL, '3', '0', '2', 'en', '0', '1', 'online', '$2y$10$XQWUziKBy8czZbzIpr1KIOR5DO6O5w7jtiGITOcTQFlbcpTevMMoy', '0', '2022-08-15 13:16:34', '2022-08-15 13:17:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(531, 'seller@gmail.com', '$2y$10$VSWb7Ao0mqVmM0IcyKrZP.D512MtWxwrW9GC6zXx.KOcSw/dZFbz.', NULL, '62fa47a2344ec', NULL, '3', '0', '3', 'en', '0', '1', 'online', '$2y$10$ODyGC6/A2zYeOBt9X/.GZ.yGovXolNOho7GLxBvLoH4D1d/nTDYQ6', '0', '2022-08-15 13:18:26', '2022-08-15 13:18:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(532, 'buyer@gmail.com', '$2y$10$O.O0IUm.qwMoeYjNTcjHAeXdorpFKyN7mrzmx4DUVUfi9rm.9vbiC', NULL, '62fa4baa4d79e', NULL, '2', '0', '3', 'en', '0', '1', 'online', '$2y$10$2N8udIZVsdH0okqT5d4U9eEjwj2RKVbluFy3oBx2j1p9E7sHMMXzi', '0', '2022-08-15 13:35:38', '2022-08-15 13:36:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(533, 'agent@gmail.com', '$2y$10$npHpowHOa7iweLKbT0fJVueraDvA3Iz0NEA2JdjDxNeTL9sp.TXrO', NULL, '62fa4ca67673e', NULL, '4', '0', '3', 'en', '0', '1', 'online', '$2y$10$bsCF8ihbajUi3oBOatF.8ugUFiQSvbWdD026iMeBYvLii5fzYB5iG', '0', '2022-08-15 13:39:50', '2022-08-15 13:40:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(534, 'kpujara26@gmail.co.in', '$2y$10$yzCsQPJjapVSztnyoc7/FOs8YCTL5uavrasCj.4NmdL0Y1ll8YZlS', NULL, '62fa4d18b8b45', NULL, '4', '0', '1', 'en', '0', '1', 'online', '$2y$10$uqrTpaLk1NhMg0XdKa7dUe.3kJh825Mw6zbN9IP6udeIaY7XtWThS', '0', '2022-08-15 13:41:44', '2022-08-15 13:41:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(535, 'pravasini.sahoo@utkallabs.com', '$2y$10$LMOFcgX4MssJ.qCj5RVirO4lnLaaCkaWAJHbAatb/RECHdD4ednVq', NULL, '62fccfa4dc1af', NULL, '3', '0', '3', 'en', '0', '1', 'online', '$2y$10$RRaYzV9ElPNQWkjgFnsMw.h68A9eZT6yH2NEvUcnMAs8rqYej7ppS', '0', '2022-08-17 11:23:17', '2022-08-17 11:24:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(536, 'pravat.behera45@gmail.com', '$2y$10$1jOHvDq5sUEhGXK.D4YS2O/V8BbLcGe7/m0PQf1.RRiFXhEpl0ovG', NULL, '62fcde46c7f3e', NULL, '2', '0', '3', 'en', '0', '1', 'online', '$2y$10$HxxSdYcpXTJ271oKGXbtD.bggW9Qujv2ExEmtFtMqGxk6wrsRSco6', '0', '2022-08-17 12:25:42', '2022-08-17 12:28:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(537, 'cool@yopmail.com', '$2y$10$eBgI//YuTQWr.s1RdSgGbODTXnLbYkLPqNhC90EpgMwq2ehqFY1Pe', NULL, '62ff571dc78b8', NULL, '3', '0', '1', 'en', '0', '1', 'online', '$2y$10$3iuuSzywV63AgzB3F0gOrurEgYO1.PJ5djKeKDiFlkjEKeSWPwm7.', '0', '2022-08-19 09:25:49', '2022-08-19 09:25:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(538, 'coolman@yopmail.com', '$2y$10$rX99iz/v0y..Yz5Kw5g4PelEzWVGW0roXdsw7oeRSQZUF9sHRNbqi', NULL, '62ff72d65a84d', NULL, '2', '0', '1', 'en', '0', '1', 'online', '$2y$10$wdHtpQwMX1AJELCVeKbmFO9PHzRs8uXPBr5jbIE9vqygAt9bVQ1Su', '0', '2022-08-19 11:24:06', '2022-08-19 11:24:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(539, 'crystaltechlab@gmail.com', '$2y$10$bpIgjVuW9gD7DePCnPfPU.BezSW/sXutpRVPGbxZJRLlpTSjGibIK', NULL, '6300e8dcb69b6', NULL, '4', '0', '3', 'en', '1', '1', 'online', '$2y$10$XjTZxLMPvLLAHDdxFQxPrODqE.44yjTC56BwjSGOAz.16I0LrYpUm', '0', '2022-08-20 13:59:56', '2022-08-20 14:00:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(540, 'smitha901@yopmail.com', '$2y$10$e17/IbG81XaWjq2M.Aj3f.aUq6bYPn6Mda8LaIwAX/PxM33hOHQUO', 'P2oMJ6Wc5GGIDswARRrQe1dYQ6BCRzaVEazu7l2VsYQ6bLgPQu02ynTnGpqP', '', '', '3', '0', '3', 'en', '1', '2', 'Offline', '2022-08-22 02:24:19', '0', '2022-08-22 02:19:03', '2022-08-22 02:24:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(541, 'smitha902@yopmail.com', '$2y$10$kNIAUZy6HVVm5yZcUvs5G.tzc2MqoS4z1SvqxYjQDo1fH1u6k3IK2', NULL, '', '$2y$10$BQJQeK6QLbfluNQOrlHnR.A.FEG6FslyC1.WAMsdDXyCPoqM59f7u', '2', '0', '3', 'en', '1', '2', 'Offline', '2022-08-22 02:26:41', '0', '2022-08-22 02:25:12', '2023-03-03 12:31:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(542, 'smitha903@yopmail.com', '$2y$10$FpzXrc3TVE4nGLkUwxMvaO5bQUqUwcWaZWt36JjjNd4eEpl6et4se', NULL, '', NULL, '4', '0', '3', 'en', '0', '1', 'online', '$2y$10$gTtwYPv5wRRvgmru5jjTQOfOhNa4fa2xFpTTgOLVGAIDkXdZsbWF6', '0', '2022-08-22 02:27:48', '2022-08-22 02:28:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(543, 'smitha904@yopmail.com', '$2y$10$edSJskz488ZBjme4QWHR2.GJx7nQFyaJFKT/a7sfZJQ.aEE6K6Ppi', NULL, '', NULL, '4', '0', '3', 'en', '1', '1', 'online', '$2y$10$UZ0v6o5Hzm9UZYbAz05c2O2hBo0IViPZSnxGpHpDU3LXgVyxEwiD.', '0', '2022-08-22 02:30:28', '2022-08-22 02:31:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(544, 'smitha906@yopmail.com', '$2y$10$rSqcqyqQfvGWib9mAsZyBuRIn5emdWQX8uQCUmMTM8/Wmn2xTT2hy', NULL, '', NULL, '4', '0', '3', 'en', '1', '1', 'Offline', '2022-12-08 13:38:52', '1', '2022-08-22 04:13:02', '2022-12-08 13:38:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(545, 'user@itsolutionstuff.com', '$2y$10$BJYPctIjwZMwItwIvMDORefXohGOl2qlRp5tnql9j3lpJDcFHIpLi', NULL, '6313745d2ccb6', NULL, '3', '0', '1', 'en', '0', '1', 'online', '$2y$10$eMD6527yy5VNyI96erq2YeLt/GiQ/SLr8yFJCTyXEjc0HgZNWHtZG', '0', '2022-09-03 15:35:57', '2022-09-03 15:35:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(546, 'usertest@itsolutionstuff.com', '$2y$10$Cic/d8yUafp6N3iDjBo8jeHplCEEUnXO9Dy7asdBUjD9sHEe9aVMy', NULL, '631424593ab55', NULL, '3', '0', '3', 'en', '0', '1', 'online', '$2y$10$6x5Fx4TjE/CUOJ.7s3g/k.lg/oyxC4ZuqWi6y/x/vtrGgY30CsyQ2', '0', '2022-09-04 04:06:49', '2022-09-04 04:22:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(547, 'kegaxy@mailinator.com', '$2y$10$tr5fRIMHxZrqlNFWN6b7LedRs.kU.xHuaYFTx3sKVBf33686WHmf2', NULL, '6314296fb65c5', NULL, '3', '0', '3', 'en', '0', '1', 'online', '$2y$10$x9IOGjq3bBpCCkF.iYsrrewTjZMYh.Km7EUBYSUMDFvos8i/5GQWe', '0', '2022-09-04 04:28:32', '2022-09-04 04:30:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(548, 'hamza.ali220554@gmail.com', '$2y$10$YoNYcXGIwe/K1CjBym4HKehEnDSt0cbQNPBfJouu1JnLstrI9yhvG', 'UtV5VHAI5NZboUo9ybGDGjVkoduqzk71ndKlmSdB1ScZRFeqT5TJFKW2mjpk', '', '', '2', '0', '3', 'en', '1', '1', 'Online', '2023-02-07 20:57:02', '0', '2022-09-04 04:34:04', '2023-04-15 11:01:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(549, 'ha220554@gmail.com', '$2y$10$3wwV42DCO8ypVlk3WX93bOoIHoEg9VaVRltju1/6HKaQc63QeXvC2', 'rzXGpBqZzYQX4iCElP3m2U0dA1xJ5DO4YdDIm5fStFP0io6T58q0Malcwu7u', '', NULL, '3', '0', '3', 'en', '1', '2', 'Online', '2023-04-04 21:31:56', '0', '2022-09-04 14:07:31', '2023-04-04 21:31:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(550, 'hemant@gmail.com', '$2a$12$Bt8Oxcw6Y7E8vuUlFNxtMuiE3N4.lwqlhHPbhGZIv6N25VNEKRWBq', 'gAzanqLmBq1DYVAgs6bZS2CJJvKziqEKhyB1DWmofM7LmAO73ttaCprwPddt', '', NULL, '4', '1', '3', 'en', '1', '2', 'Offline', '2023-03-26 12:30:45', '0', '2022-09-17 19:55:10', '2023-03-26 12:30:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(551, 'bcsm-f18-204@superior.edu.pk', '$2y$10$EkXxQXFIDu8tHZ5vNtscT.ijxSbnQgwdh1fHQuIf7HOLJLfyfk6eK', NULL, '633971a789359', NULL, '2', '0', '2', 'en', '0', '1', 'online', ' ', '0', '2022-10-02 11:10:31', '2022-10-12 22:11:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(552, 'bcsm-f18-207@superior.edu.pk', '$2y$10$7Bwih2.fLkMPWGg.EHAmJOFxHwgq95dNUBLPW8bbovr6qEv99vERO', NULL, '634734772a588', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-10-12 21:41:11', '2022-10-12 21:41:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(553, 'bcsm-f18-208@superior.edu.pk', '$2y$10$3ynJwj/3/PSPFyDAor9tL.j.d5jVN14HeMfOETilbk1BsoI.Z96PK', NULL, '634735f2af670', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-10-12 21:47:30', '2022-10-12 21:47:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(554, 'bcsm-f18-200@superior.edu.pk', '$2y$10$MSSbgoco7mDKplEG4EpHOuLZJ0/Gk7nPmcOh0oVaj4ZIYDZE.Bcoi', NULL, '6347399b7e4e3', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-10-12 22:03:07', '2022-10-12 22:03:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(555, 'bcsm-f18-202@superior.edu.pk', '$2y$10$6folcRnllvOVNtsNeOMzvuA7zMD8eNqaER7Y9rNsS8f4rv1TPBmhu', NULL, '634db145e1023', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-10-17 19:47:18', '2022-10-17 19:47:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(556, 'bcsm-f18-203@superior.edu.pk', '$2y$10$Ez2cAKodl/TYkXA96bMM4ugFxkJFTFm0bdAh3ScTE84sIEt9j//4m', NULL, '634db53b7e962', NULL, '2', '0', '3', 'en', '0', '1', 'online', ' ', '0', '2022-10-17 20:04:11', '2022-10-17 20:08:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(557, 'bcsm-f18-205@superior.edu.pk', '$2y$10$vYTUviHhNuosr8C9DgjhMeqV4qDzaZjYf978b5y4uo0x21cnXKum6', NULL, '634dbcceb3cda', NULL, '2', '0', '2', 'en', '1', '1', 'Online', ' ', '0', '2022-10-17 20:36:30', '2022-11-16 21:24:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(558, 'bcsm-f18-200@superior.edu.pk', '$2y$10$1ts90ab714GubxclDTTx3eCJsWT8CPwzokn10GWF/928uR9uYQ1NG', NULL, '634dc04a4a639', NULL, '2', '0', '2', 'en', '1', '2', 'Online', ' ', '0', '2022-10-17 20:51:22', '2022-11-07 20:02:19', '4242424242424242', 'hamza ali', '314', '2023', 'cus_Ml72R45Cy5Lwyb', '11', NULL, NULL, NULL),
(559, 'bcsm-f18-288@superior.edu.pk', '$2y$10$DUFQPh//SltExP7VwbpgiOPWgbblDhNL.mtZKeVUDV5md0xR1eixy', NULL, '63768a1f96d65', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-17 19:23:11', '2022-11-17 19:23:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(560, 'bcsm-f18-299@superior.edu.pk', '$2y$10$J6b9EqsQTeqFpxR9VIdM7uraOHYiPgaZCQw9M0O5SssTMkjDFcgiu', NULL, '63768aa1038ba', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-17 19:25:21', '2022-11-17 19:25:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(561, 'bcsm-f18-289@superior.edu.pk', '$2y$10$K0QTBqh4iBuyVaBZqPvWt.GdjFfcSHvy4l9RtoKvK37m5RryIvXfm', NULL, '63768ab948303', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-17 19:25:45', '2022-11-17 19:25:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(563, 'bcsm-f18-2222@superior.edu.pk', '$2y$10$c8Xz7RgRaIjD1zN6Bh5PseoUTqqfcqEVMJjTo.xcbQz.m3QoaWlf2', NULL, '63768b0314d3c', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-17 19:26:59', '2022-11-17 19:26:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(573, 'revoky@mailinator.com', '$2y$10$ht9Gh3x8StlV.eDXV0KQ4.mlnzG4uuxcEQ/TsZYh4nEgXdsysnqkq', NULL, '637957297a43b', NULL, '3', '0', '3', 'en', '0', '1', 'online', '$2y$10$O3xhtxcKngVr8tHRPHW4PeuOf05ZX5.WsMmOMZsULjbnYoqybTo2q', '0', '2022-11-19 22:22:33', '2022-11-19 22:23:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(583, 'bcsm-f18-016@superior.edu.pk', '$2y$10$NMNx.ENVZ6jPglcMdi/C.uNlCWV0z7oCBJP5S/cv0VVIAT5zGXT3K', NULL, '637d21f7a608f', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-22 19:24:39', '2022-11-22 19:24:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(584, 'bcsm-f18-010@superior.edu.pk', '$2y$10$OIXlviXv43tSCJ6QOelLceXjXvyXmuYphJNiOL/Q1YYdj5t0HCS7a', NULL, '637d227e8f117', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-22 19:26:54', '2022-11-22 19:26:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(585, 'bcsm-f18-0100@superior.edu.pk', '$2y$10$59dFw9gYI2rQq3dzBBXbd.Wv2Wohx2buVXjKYAXGTJIt0oOqBSZyW', NULL, '637d23e37ca6e', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-22 19:32:51', '2022-11-22 19:32:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(586, 'bcsm-f18-01000@superior.edu.pk', '$2y$10$rN8Kgm.D0ZloD29EAbU3w.KQSjcjn3pvysjL5YdBJKY.UusuhtITa', NULL, '637d243179a77', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-22 19:34:09', '2022-11-22 19:34:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(589, 'mitansh@2345gmail.com', '$2y$10$5DGfCqxp519bzJ9.UQDBPO1EXL6BJW69ZcKI.ReWhW1LpAkCJ2bYu', NULL, '637dc121c6414', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-23 06:43:45', '2022-11-23 06:43:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(590, '089test@rayen.mailinator.com', '$2y$10$qwmC2jeI2HwXS5yITPkLaOfcFKtTukdPsi1yjXrxE699.qDjYEuHG', NULL, '637dc16b84937', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-23 06:44:59', '2022-11-23 06:44:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(591, '089test@rayan.mailinator.com', '$2y$10$1xgJdd/IoOCDZe23ege0MujXL2cQwZn5eWGFdrukmRXku5dToyvi.', NULL, '637dc20032db6', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-23 06:47:28', '2022-11-23 06:47:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(592, 'arun@gmail.com', '$2y$10$P7BfeGgMHBug2IeB4LUJaeqLRvSjXET0WARb4kqqjgaUc4IlTI//q', NULL, '637dc245cd372', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-23 06:48:37', '2022-11-23 06:48:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(593, 'arundati@gmail.com', '$2y$10$WjC6CqQKDql5sTaxlrLGjuoq0PZ.2rm4qodNvoz4XK8WtXabqo2g6', NULL, '637dc26c4fcca', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-23 06:49:16', '2022-11-23 06:49:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(594, 'hanary.cavill@mailinator.com', '$2y$10$a3D7AYiCSxD7eo5Prcp9j.Xmw9FS9nqnX5COQ4vPhindZ3MguhiX6', NULL, '637dc35dc4955', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-23 06:53:17', '2022-11-23 06:53:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(595, 'superman.hanary@mailinator.com', '$2y$10$H8qGlzfSBvxp3K355mFPhu3fhhRkGwO9Rz/2M9wu30teisKN6.SWO', NULL, '637dc398f3e3d', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-23 06:54:17', '2022-11-23 06:54:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(596, 'superman.cavill@mailinator.com', '$2y$10$kx4Z3OQMN8mY7q3a0bU9Fe06frrM0aMst.OF1GuRYaRkPlZ3UN3Xi', NULL, '637dc3c66722e', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-23 06:55:02', '2022-11-23 06:55:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(597, 'bruce.wane@mailinator.com', '$2y$10$tJI0hbrFq3CVnsViDL/JYOTjn6NZ49uNe1yHq9ag/xIyrWmLfPmzq', NULL, '', NULL, '4', '0', '3', 'en', '1', '1', 'online', '$2y$10$hZaqxHthiM1JZZ.pv14YnO3/kZWu06Mgke5DDeQo8LugS/NS3jpmq', '0', '2022-11-23 07:07:54', '2022-11-23 07:19:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(598, 'kupha@gmail.com', '$2y$10$2U4Wij87.mnxavv1Rcn7mO.LFwBcBcHrq2gJ3Dy0O2IDny1pv4O4u', NULL, '637dcc96284ae', NULL, '2', '0', '3', 'en', '0', '1', 'online', '$2y$10$ybAcDODj8G8f7mSrsnkU/.J77Sj.X.gHlNSiYmbnoF8NK5fml.R5G', '0', '2022-11-23 07:32:38', '2022-11-23 07:40:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(599, 'hanary.wane@mailinator.com', '$2y$10$0roSgNK.5QuFNmqWH/9s0e8HVmfRVD81riCpIZLRVP0pUjWY/2lXu', NULL, '637dcd0dcdf7f', NULL, '4', '0', '1', 'en', '1', '1', 'online', '$2y$10$8F9BbOfW8NeBt3tUha2ko..E7FYltGCih6kUy889Fn2YmM/w4rST6', '0', '2022-11-23 07:34:37', '2022-11-23 07:34:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(600, 'test.caivilll@mailinator.com', '$2y$10$TbDQW4jooZGxboAFXNh0M.8kvPd3PbAJuIQh.tE.S0jKgWznlPCEG', NULL, '637dcf739ac75', '', '4', '0', '3', 'en', '1', '2', 'Offline', '2023-01-10 07:28:39', '0', '2022-11-23 07:44:51', '2023-01-10 07:28:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(601, 'hanary.cavilll@mailinator.com', '$2y$10$0GuSCNCbQKZF14xBDteFguksXHlfbk5.0NQJLssciCwG4AfIYWmz6', NULL, '', NULL, '4', '0', '3', 'en', '1', '2', 'Online', '2022-11-25 12:56:08', '0', '2022-11-23 08:09:40', '2022-11-25 12:56:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(603, 'dgr01371@xcoxc.com', '$2y$10$.IMKNYHJuW4ODNaT.N7CnuCjrFXzfcUg9sMCl7p.i0IYfLvvk5GC.', NULL, '637e6220f141d', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-23 18:10:41', '2022-11-23 18:10:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(607, 'Hanary.cavill@hanary.mailinator.com', '$2y$10$1XD9U0vVSKGJB9ymEsGdgeBy8WV24VN0ClAyBxTRoJYbsvbY2MxS2', NULL, '63805480ceca1', NULL, '4', '0', '1', 'en', '1', '1', 'online', '$2y$10$.EgAxlqjlFgNQkcvLkjbf..wpvzHgJarqJswbjn57D8bY.mf7ojj2', '0', '2022-11-25 05:37:04', '2022-11-25 05:37:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(608, 'Hanarycavill@hanary.mailinator.com', '$2y$10$avAxjtwtfJUY3Kmd7D6MB.Anc5.6Bjm9Wr4iTiiB9SXhnf544lmMa', NULL, '638057889af70', NULL, '4', '0', '2', 'en', '1', '1', 'online', '$2y$10$hW1fjzWO0dn8QDR8kqlV3ewJ5KNZGxiKy./Zo3GIgLW93R4vl0Kv2', '0', '2022-11-25 05:50:00', '2022-11-25 05:56:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(609, 'Mitansh@vats.com', '$2y$10$m/zb61Lb0REiwBUu9FuzleGtzJlQpOIGl4PcrvQ0dTDk.VBGHCdZa', NULL, '63806a8094324', NULL, '2', '0', '3', 'en', '0', '1', 'online', '$2y$10$zK2nxzCq.ssbdfJHKAPnf.cLuDXJCgwNmd46vNic1nRG.ZSh2EyDW', '0', '2022-11-25 07:10:56', '2022-11-25 07:15:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(610, 'Bruce.Wane@bruce.mailinator.com', '$2y$10$4GjKy03U4d.ezKVj8zm9JuGS8WXBGft3O5kmaWkpX/pcif2Zah/ny', NULL, '63806c6fd24f3', NULL, '4', '0', '3', 'en', '1', '1', 'online', '$2y$10$hQffbaFmB7..dqoAILovcubslgTvHNjVCnt5LpPIApjSw65/TNlj2', '0', '2022-11-25 07:19:11', '2022-11-25 07:23:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(611, 'aarti@mailintor.com', '$2y$10$amq5gu.CYjiAzBHUeMmPdObE6gfncJYV7div7KxD0/IDr9RBOTjkO', NULL, '638081cd8eed8', NULL, '3', '0', '3', 'en', '0', '1', 'online', '$2y$10$TYu7gdORpiawm5bUwtilReZf3yRQzGSVfam74Xi5y.9O2u4oHfrH6', '0', '2022-11-25 08:50:21', '2022-11-25 09:01:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(612, 'Bruce.wane@wane.mailinator.com', '$2y$10$TTFXNeSTpuo7Uk0m8.2OGeGY57nJGwPOWcUya6OUrNh5kNaUu/XZO', NULL, '63808373e9e8b', NULL, '4', '0', '3', 'en', '1', '1', 'online', '$2y$10$YhQ00xPmFNqpVyXzJcttve6xezRw0JuCEsVWwawXUzEuhtZWNg/ji', '0', '2022-11-25 08:57:24', '2022-11-25 08:59:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(613, 'Rahul@mailinator.com', '$2y$10$xCeoAFlXBD0Ygr3JJpZcoOijo4AOsvEcaGBCszihgtxC66urCMz0y', NULL, '', NULL, '4', '0', '3', 'en', '1', '1', 'online', '$2y$10$msRsXrCNg8oMCQTx8BAvB.rfLx3nymSVJ8zUpan7gr/1ecNh9zg1W', '0', '2022-11-25 09:16:28', '2022-11-25 10:15:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(614, 'joy@mailinator.com', '$2y$10$uTkdhvkthPHtB/uHq6iD1O9.SSZK0E0q9AA9hoaZo0G4X/pRiokom', NULL, '', NULL, '3', '0', '3', 'en', '1', '1', 'Online', '2022-11-25 12:29:40', '0', '2022-11-25 10:40:26', '2022-11-25 12:29:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(616, 'nouman.mughal@appcrates.com', '$2y$10$B7ssG/o.VHD5m5dhRN5DzeutO2AeSgrszuniA5OTYcTNu4fGIa2qK', NULL, '6380c51bd99ea', NULL, '1', '0', '1', 'en', '1', '1', 'Online', ' ', '0', '2022-11-25 13:37:31', '2022-11-25 20:27:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(617, 'shahzainsohail29@gmail.com', '$2y$10$DiItaDYSnTsoncpeUJ2MX.RDvF2jMDhgoe1wqKJ/LDZ7MjltGEiVK', NULL, '6380c7a159641', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-25 13:48:17', '2022-11-25 13:48:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(619, 'shazain.sohail@appcrates.com', '$2y$10$Qab.wVEJF/YQkw3Ea2RXb.daVlAEOfU.Mmhpzvxz5XPEYy16FPwTO', NULL, '6380caf6962ad', NULL, '3', '0', '1', 'en', '1', '1', 'Online', ' ', '0', '2022-11-25 14:02:30', '2022-12-03 14:20:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(621, 'ahmisheikh2356@gmail.com', '$2y$10$/4vr0wtDXsIlwWObLZgyaOi7JRBFsV0BOkTC0.VBJRA3LsvHhNdUO', NULL, '63812ba64b78f', NULL, '3', '0', '1', 'en', '1', '1', 'Online', ' ', '0', '2022-11-25 20:55:02', '2022-12-05 14:22:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(622, 'raymond@mailinator.com', '$2y$10$fspqA9SXh4stZDpGeHESB.7BBEVLUq0Jh2S6JdqjEiOuZHzscGxPa', NULL, '638476845d3db', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-28 08:51:16', '2022-11-28 08:51:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(623, 'kamille.d@mailinator.com', '$2y$10$WsCSmFULk/rW5l9wucXlbuQ950wQLkuko.ZYO1yKH6SGDqMPgx9LG', NULL, '63847ea8228b8', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-28 09:26:00', '2022-11-28 09:26:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(624, 'hanary.cavi@mailinator.com', '$2y$10$BX.mEWsq8zzVsvGAyMb7C.ACF7l7gUlhNGMy113zsR.1pQR0K22Nm', NULL, '63848b2318406', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-28 10:19:15', '2022-11-28 10:19:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(625, 'Grayson.k@mailinator.com', '$2y$10$z.b7qGoofGqlu8JS/lTuUOd0YiXWb2OndywzJRDNDtC9tKfwgPFTe', 'Pa0jko8HWh5aFf04AGQUH3yv24KCu5aIRVhHIsWIRZNEM70os9HZLETtngbV', '6384951b83c62', NULL, '4', '0', '1', 'en', '1', '2', 'Online', '2023-02-26 08:55:03', '0', '2022-11-28 11:01:47', '2023-02-26 08:55:03', 'null', 'null', 'null', 'null', NULL, 'null', NULL, NULL, NULL),
(626, 'Bruce.batman@mailinator.com', '$2y$10$PS086ownjbApd.cDzxGZ4ekHBHup.vgO.0c1.DbopgmwapUI2BKmK', NULL, '6384956f2ae48', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-28 11:03:11', '2022-11-28 11:03:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(627, 'Steev.cavill@mailinator.com', '$2y$10$iAQ2Yplo/bBRyJXVDrVIvuA3N1gParY/1NrCwrJThvLudTIWWAqS6', NULL, '638496e6177bf', '', '4', '0', '1', 'en', '1', '1', 'Online', '2023-01-14 08:14:39', '0', '2022-11-28 11:09:26', '2023-01-14 08:14:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(630, 'Annu@mailinator.com', '$2y$10$t2GZ0mslP76F.M0EIUSGcexfuu/D.3OZtjCx0gvc3ZmRz1TQGYeCW', NULL, '638593866f66a', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-29 05:07:18', '2022-11-29 05:07:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(631, 'Annu1@mailinator.com', '$2y$10$6.y7D8WIJ2KGJ6CVDlM6QO/N3DvKA9CX55NHnUonlUuFinI4TB0XW', NULL, '638593b250fab', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-29 05:08:02', '2022-11-29 05:08:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(632, 'Aarti1@mailinator.com', '$2y$10$4HeaMbK//ei1z8JGyt2Voe2RFbyitqZ4.shJbGNouwrMW9VEySOQG', NULL, '638593dea0008', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-29 05:08:46', '2022-11-29 05:08:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(633, 'Aarti@mailinator.com', '$2y$10$nsCERK0cDv33tsiFGcs7VebTXlFjAvBlF2oXjzlvBnfZry1TyXCl.', NULL, '638594e9d7d48', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-29 05:13:13', '2022-11-29 05:13:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(634, 'maitry@mailinator.com', '$2y$10$FvVFF/Tgvj3o/7b3sWTX7ucE4r6/IN9oBbQlAwuwSwsUGKd/yNT1K', NULL, '638599644c2c5', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-29 05:32:20', '2022-11-29 05:32:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(635, 'maitry.123@mailinator.com', '$2y$10$V9RN5iFwsO.nUz6q2aVHfeSjb3jfJ1A9QgIMrRvkjdr74bTLbxD.e', NULL, '63859b7785889', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-29 05:41:11', '2022-11-29 05:41:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(636, 'pihu.123@mailinator.com', '$2y$10$AlbmYKlAGzsfeS74PWJwXuX4bV7qnYfYsQJSGMt24E8bpT.QV8cEm', NULL, '6385ad4cc68e2', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-29 06:57:16', '2022-11-29 06:57:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(637, 'pihu.sharma@mailinator.com', '$2y$10$OzY.1gZxmj83dl2bbDLgW.c.gRv6.fRH/qeCgXXRWw.Ul2kr0BLVS', NULL, '6385ae41eb559', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-29 07:01:22', '2022-11-29 07:01:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(638, 'Pritam.sharma@mailinator.com', '$2y$10$kNas0IIvPlYGTB6MTaq1cO1iaMutUnUZE3EFKQMkhEynMp1prvH2S', NULL, '6385aeae1b75f', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-29 07:03:10', '2022-11-29 07:03:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(639, 'Anjali.moshra@r.mailitnator.com', '$2y$10$RBBQKvr0ebiy39Mj8oaWj.fZT7GX.S4FiDH13G9nl6PPN3hdRe..m', NULL, '6385b1794f783', NULL, '4', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-29 07:15:05', '2022-11-29 07:25:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(640, 'Anjali.moshra@mailitnator.com', '$2y$10$w8Vc.iCO.On9P37oTZ8mxe0DslgGqPrwObk5kE573fQRuzFPfsdvu', NULL, '6385b47d78400', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-29 07:27:57', '2022-11-29 07:27:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(641, 'Charles.ll@mailinator.com', '$2y$10$TQI5yJsGFeu7Z2MbrvS0R.wt4A0Qf/S0KyElrmndTrw.C/CUWMeIC', NULL, '6385b7116c196', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-29 07:38:57', '2022-11-29 07:38:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(642, 'bakshi.rs@mailinator.com', '$2y$10$n9zKwaajlWghL2bg8Dju.uw.W8yW/BB6CtqsxhOGjXsiibJHMe5tm', NULL, '6385b7a94a57e', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-29 07:41:29', '2022-11-29 07:41:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(643, 'Kathryn.powlowski@mailinator.com', '$2y$10$4PTDwS8QwhH7dcth7jxBmO.ehWxXg8iajwUvgagwXrDN2Dyxtv6qS', NULL, '6385c42e42240', NULL, '3', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-29 08:34:54', '2022-11-29 08:47:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(644, 'Amaya.Kuvalos@mailinator.com', '$2y$10$k5F4haQ3in9veygWK.le5OPK9ii7GcMZ7F7mnykqJ4ZxN2QAIb.f.', NULL, '6385c7ecde15c', NULL, '3', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-29 08:50:52', '2022-11-29 08:51:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(645, 'Rosanna.Senger@mailinator.com', '$2y$10$VLUS.gnXV/ny6XdAYlT.7OZaC7THisiWJTiuWff7KA4CXhGhIQ1fS', NULL, '6385cdb25c590', NULL, '2', '0', '1', 'en', '1', '2', 'Online', '2023-01-16 05:46:04', '0', '2022-11-29 09:15:30', '2023-01-19 08:44:17', '444411111111111', 'Rosanna Senger', '123', '2030', NULL, '8', NULL, NULL, NULL),
(646, 'Lucien.Mertz@mailinator.com', '$2y$10$WJY2bhEh3uK9G9wmQnqg6.vK7nza3KEfPuiODvVO8dJy3XQcyWFI.', NULL, '6385ed0631ddc', NULL, '3', '0', '1', 'en', '1', '2', 'Online', '2023-02-27 08:37:24', '0', '2022-11-29 11:29:10', '2023-02-27 08:37:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(647, 'Erika.Pagac@mailinator.com', '$2y$10$a2XWVQiRZ./iXHeCsVamfOAv4jVFNjGouaisoe2y9Fuzs8uk3DmIW', NULL, '6385efb4f2548', NULL, '3', '0', '1', 'en', '1', '1', 'Online', ' ', '0', '2022-11-29 11:40:37', '2022-12-28 07:23:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(648, 'Eladio.Becker@mailinator.com', '$2y$10$5mKeVXv7dykfVzVhkxsAIeiXcT3JWJFHkgS/QDdx/jdnm2KSEPzCS', NULL, '6385f51e07817', NULL, '2', '0', '1', 'en', '1', '1', 'online', ' ', '0', '2022-11-29 12:03:42', '2022-11-29 12:04:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(649, 'Benedict.Nicolas@mailinator.com', '$2y$10$wt1X0CwDhAtuv.5XZ3tBiuvz1lM/8w9btUUUiSNpaJbiytYg9AmEC', NULL, '6385f5f85bd47', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-11-29 12:07:20', '2022-11-29 12:07:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(650, 'Alvin.Walker@mailinator.com', '$2y$10$RjOlkMKsAtCnsrUA35J30ujHPvQrl2x4nphnnkBux7Q4wYaC2X1La', NULL, '6385f6b847356', NULL, '2', '0', '1', 'en', '1', '1', 'Online', '2022-12-16 13:45:35', '0', '2022-11-29 12:10:32', '2022-12-28 07:14:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(651, 'Aditya.Kertzamann@mailinator.com', '$2y$10$FU24kM./TbmWyndqUQG8TuU6rrA5JT2wyJgWdN/TGQvaxwTQ.02xq', NULL, '6385f9f6d5ae3', NULL, '2', '0', '1', 'en', '1', '2', 'Online', '2023-02-13 09:12:17', '0', '2022-11-29 12:24:22', '2023-02-13 09:12:17', 'null', 'null', 'null', 'null', NULL, 'null', NULL, NULL, NULL),
(653, 'ahmad.amir@appcrates.com', '$2y$10$0pDZbY8DsfNJcJ0Y6l0rhe9VrJuEqb2nMInYLqpqRGRMqLF7L/1/m', NULL, '638c4503bbd6b', NULL, '3', '0', '1', 'en', '1', '1', 'Online', ' ', '0', '2022-12-04 06:58:11', '2022-12-10 18:48:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(654, 'ahmisheikh2345@gmail.com', '$2y$10$z1HcLVoiRvMejurvPpqnH.dWJhANDIueNlnBiu.V3Wfhyv7ivMuhy', NULL, '638c46996b1fb', NULL, '3', '0', '1', 'en', '1', '1', 'Online', ' ', '0', '2022-12-04 07:04:57', '2022-12-04 07:09:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(655, 'smitha801@yopmail.com', '$2y$10$kWcD5l7qREGk2A9stdiJY.KoBwc.s61piEhkLyRglFA3JDTUOOAOW', NULL, '', NULL, '3', '0', '3', 'en', '1', '1', 'Online', '2022-12-09 14:39:14', '0', '2022-12-09 12:34:48', '2022-12-09 14:39:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(656, 'smitha1001@yopmail.com', '$2y$10$IRwkB5Lc0x91b3nQLIHeF.z7x0J4Ch/zWLgQUcFcoLVB/akr0eb1i', 'QrXsEmfPCJLvUUWTxB4FcbfpMTY7ro8591ITZL6enEVmDjVzozHEJVEgUL6L', '', '$2y$10$iCVE.AnEHdrDG27BPQ67Rubp3Dk.revh9DNNklAjqWBY.693v9u6', '3', '0', '3', 'en', '1', '2', 'Online', '2023-01-15 02:20:33', '0', '2022-12-12 05:15:19', '2023-01-30 00:51:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(657, 'smitha1002@yopmaill.com', '$2y$10$tnG6dc8XINGloN7KGVnqGeZEDk..vTkBXH.Tg.iJh9flEZISxrOh.', NULL, '63971c520dea2', NULL, '2', '0', '3', 'en', '0', '1', 'online', '$2y$10$Nr7qy1HwvZSUvtk7FYwGmOqv3xUraMDEaaT9lzmtxYrbFNmjF2w9y', '0', '2022-12-12 12:19:30', '2022-12-12 12:20:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(658, 'smitha1002@yopmail.com', '$2y$10$mFUIpijSGzASes7LrGBBqelEnqt/pcQlflBXCW8OKEvMLqL5wFxxK', NULL, '', NULL, '2', '0', '3', 'en', '1', '1', 'Offline', '2022-12-12 12:23:28', '0', '2022-12-12 12:21:59', '2022-12-12 12:23:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(659, 'smitha1003@yopmail.com', '$2y$10$oLomisGXfXP87I.2nVrNtOsepXQfsBTE9cmcZqaqzuM5QwiK6HdWy', NULL, '', NULL, '4', '0', '3', 'en', '1', '1', 'online', '$2y$10$oCXRCbFe0Rs50x/m.bhUceysFFslgqeU/QDFRMJvjuAztX2QFtrX.', '0', '2022-12-12 12:24:13', '2022-12-12 12:25:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(660, 'smitha1004@yopmail.com', '$2y$10$8C8A10F0rHA5GxiNaiEjr.mfZDR4k28r1SWx.HrhsrM9MjmUJ1XJm', NULL, '', NULL, '4', '0', '3', 'en', '1', '1', 'online', '$2y$10$yaq5P7IOaKtdkT.7RWJmq.e5IC.XPzwTmWQN5JRUlmLgW9LYPVRmC', '0', '2022-12-12 12:26:53', '2022-12-12 12:27:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(661, 'smitha1006@yopmail.com', '$2y$10$/8HwY6IUPrEhOFGwD4MWT.uhVlT.M6TF51N2bKYMW3jlw7LgMe/aS', NULL, '6397203023a61', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-12-12 12:36:00', '2022-12-12 12:36:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(662, 'smitha1007@yopmail.com', '$2y$10$5JT11DVFkHH14v3ZTKGBDemeuSHVsdbqXjYSg/sPYecE9IFdi022m', NULL, '639720dccf82e', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-12-12 12:38:52', '2022-12-12 12:38:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(663, 'smitha1010@yopmail.com', '$2y$10$88U10fziNVf9r9utiUx15ud3WIbovPB6KwTrvsbioN88q7vEcgkMi', NULL, '63997577454c8', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-12-14 07:04:23', '2022-12-14 07:04:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(664, 'Glenda.Ruecker@mailinator.com', '$2y$10$yDUTEuG6389Vj3TrlCVTRuledhe.PqYfw8o6JWjB.7xz.UC2EccRC', NULL, '639c0b3f13c9b', NULL, '4', '0', '3', 'en', '0', '1', 'online', '$2y$10$RM2k5DzSFJKqJNmU9CvVhOSSYv6DScbHXwGU.QHPRgbyIp2hP7.76', '0', '2022-12-16 06:07:59', '2022-12-16 06:10:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(665, 'Leopoldo.Nader@mailinator.com', '$2y$10$l5O6TFwgc9cT2AasGLSt.uUvDdt3G2MnHY7PSAu3q.bFZTy9owIzG', NULL, '639c0dd177b90', NULL, '4', '0', '3', 'en', '1', '1', 'online', '$2y$10$1Dg/uVMGUTW21rnCnVaNo.8t/kgtvF2tvBWcjlslgAGYcydfNYOTO', '0', '2022-12-16 06:18:57', '2022-12-16 06:21:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(666, 'Abbigail.Schultz@mailinator.com', '$2y$10$Zoggin1HSI/9QgPhrGaNV.9ZTt4RxWFqi92kYwM3UGzYYfHEznYMq', NULL, '', NULL, '2', '0', '3', 'en', '1', '1', 'Offline', '2022-12-29 06:10:50', '0', '2022-12-21 07:55:56', '2022-12-29 06:10:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(667, 'smitha50@yopmail.com', '$2y$10$NhmBuewkOR6ZKWm/mq9J6.m2S3TgtlkxZDlbb.ZADuW6mVNG.q922', NULL, '63a2df370b6d7', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-12-21 10:25:59', '2022-12-21 10:25:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(668, 'swathi100@yopmail.com', '$2y$10$zTsFWlvouvTBpa5oyE1GmOLCuQ2OJ8wwgfbhGCvzADCLQ.7n03tsG', NULL, '63a85ff39703a', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-12-25 14:36:35', '2022-12-25 14:36:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(669, 'swathi101@yopmail.com', '$2y$10$mk4T8IWDtI4quQoLL8n22OdXBr3xnAF8pIYDKoS7DvMU08jm.fqKm', NULL, '63a86093536dc', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-12-25 14:39:15', '2022-12-25 14:39:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(670, 'smitha1100@yopmail.com', '$2y$10$xUXifJbJkGzBP7y7k2GbSuwkpdNVuH9Q07e09cOHU3ux/.mbqcLJ.', 'J1gzpDrdURub2FHpjQ4gbeovQJoEynybeu83uER9C5XU9gnoSvVSGJI4xjmo', '', '', '4', '0', '3', 'en', '1', '2', 'Online', '2023-08-19 07:02:08', '0', '2022-12-26 07:10:51', '2023-08-19 07:02:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(671, 'smitha11@yopmail.com', '$2y$10$rKyWrvY4erMiF6EdqV95iebetsZBMON.80q9D7CBnO6QAKq1L4uCy', NULL, '', NULL, '3', '0', '3', 'en', '1', '1', 'Online', '2022-12-27 08:11:23', '0', '2022-12-27 06:28:50', '2022-12-27 08:11:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(672, 'smitha13@yopmail.com', '$2y$10$Auh.PoxcxqAa5P/nCDUafOC94Ew7LJlSlLFKHcS.qVkVvuBZCUMGy', 'bbU3MgdB1TPvIq1HgBdJf1W5hpaUebCcYtWzt8sk77H0xRgK9ocHBgVwqFLJ', '63aa9328872d4', NULL, '4', '0', '3', 'en', '1', '1', 'Online', '2023-01-01 13:47:38', '0', '2022-12-27 06:39:36', '2023-01-30 14:08:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(673, 'bcsm-f18-20888@superior.edu.pk', '$2y$10$AK5l5k2sJjRpMFdj9JKOl.xVZ/bL3YC6dm9w1ylM5OHmTjW4W3yVa', NULL, '63adedb5d2e71', NULL, '3', '0', '2', 'en', '0', '1', 'online', '$2y$10$lwm3puOLUB7qmhjDMdYibuM2s4e44E.QubeHQURje/D.eMq2jJ3Qq', '0', '2022-12-29 19:42:45', '2022-12-29 19:43:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(674, 'bcsm-f18-20444444@superior.edu.pk', '$2y$10$TvJtmuuS34DJUqmJXMPju.XexzrAHP9D4YwtACcPxKdFHg.aej/d2', NULL, '63adeebd54c3d', NULL, '3', '0', '3', 'en', '0', '1', 'online', '$2y$10$if0wlr4kSo6PzObXky2sEeBm3aZIi7qcxE3rgoVw4wffXUMwYZDNK', '0', '2022-12-29 19:47:09', '2022-12-29 19:47:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(675, 'Madison.Leannon@mailinator.com', '$2y$10$GPeB3AAkIGy4u3J8beuSQOePsPH0Q9vIKbk6cJxr/4T0FFv/cTw2y', NULL, '63ae84dd1957d', NULL, '2', '0', '1', 'en', '1', '1', 'Offline', '2022-12-30 14:03:54', '0', '2022-12-30 06:27:41', '2022-12-30 14:03:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(676, 'smitha151@yopmail.com', '$2y$10$3prip9zMXsLBQoTkikhlruceL91KnMPWn4Hl6terky86ooYtvM.PK', NULL, '63b0061ca7c0d', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-12-31 09:51:24', '2022-12-31 09:51:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(677, 'smitha678@yopmail.com', '$2y$10$RjbG9A8mQE3g92F/FvnJF.HMYupumCY0ttKfJ7.lIIaiPqDoPvheC', NULL, '63b007b481dc7', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2022-12-31 09:58:12', '2022-12-31 09:58:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(678, 'Tyrique.Bauch@mailinator.com', '$2y$10$71vhNzn9A/EunKfTZovmVeEOv/MA6oHmpXmcjjoumJLLrPEEi1f7C', NULL, '63b051fff3de9', NULL, '3', '0', '1', 'en', '1', '1', 'Online', ' ', '0', '2022-12-31 15:15:12', '2022-12-31 15:18:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(679, 'Adrien.Dach@mailinator.com', '$2y$10$tie/seCHHRxUpQ2HampWp.R8W2uG8tPngSQoasYlAGdLQzVkRc0BC', NULL, '63b054ceb66e6', NULL, '3', '0', '1', 'en', '1', '1', 'Online', ' ', '0', '2022-12-31 15:27:10', '2022-12-31 15:28:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(680, 'smitharanga01@yopmail.com', '$2y$10$tssUnT73RrW.ATGp8LciZuiP1bjdi3bIYS7Cx6hTEoAYQMu3fxGZa', NULL, '63b0dfdc13898', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-01-01 01:20:28', '2023-01-01 01:20:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(681, 'smitharanga02@yopmail.com', '$2y$10$JNvIPx5u3oUo0cKaSSD7de8Rpg6ooWYXb6mZvJTCxePjpnI50VbGO', NULL, '63b0e1b826ed2', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-01-01 01:28:24', '2023-01-01 01:28:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(682, 'smitharanga03@yopmail.com', '$2y$10$JXCzz0ZDEkhH4HhNI9tG7eohvYR.AAQZs4ApCQevcbeNwjTXLDtAO', NULL, '63b0f70318c91', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-01-01 02:59:15', '2023-01-01 02:59:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(683, 'smitharanga11@yopmail.com', '$2y$10$8ObkcKSuGNsves4XJHyPI.A0bwnPYoYCqaQn02RpOinAZ9wFGDUi.', NULL, '63b158b307cce', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-01-01 09:56:03', '2023-01-01 09:56:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(684, 'gururaj.havinal@gmail.com', '$2y$10$6ipFvPuVvVysjgnWTJHNHugljuxPMgdoV4xiZPY67Aq8/bRBsk0Ua', NULL, '63b250f1bf5a1', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-01-02 03:35:13', '2023-01-02 03:35:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(685, 'HGURU_121raj@yahoo.com', '$2y$10$KYVKSG1ChLf80LFymQRxOu5AxeA7tWgoASH7YfaiP1WeGSUVe9jWS', NULL, '63b2513721a8b', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-01-02 03:36:23', '2023-01-02 03:36:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(686, 'smitha10001@yopmail.com', '$2y$10$TBvkKdy6qTEEwZ9Z7pLt9ONRs8dBtaC1bPkhmGNPrB7G13ro.1GQ6', NULL, '63b284c959587', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-01-02 07:16:25', '2023-01-02 07:16:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(687, 'smitha10002@yopmail.com', '$2y$10$hbN3odxpSeE5HhosW8Ce3OHnLH4cZC7D2VC0FvYQmKKnwSZMtjBxC', NULL, '63b284f61a188', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-01-02 07:17:10', '2023-01-02 07:17:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(688, 'smitha20001@yopmail.com', '$2y$10$F9jfBtFChj5ZRUkn6itsLOTQH.1l.U2NoiJHZN7/yamxTUAY921x.', NULL, '63b2856167f8a', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-01-02 07:18:57', '2023-01-02 07:18:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(689, 'smith3001@yopmail.com', '$2y$10$4JJndRhIboAWNf5KemV.E.AKUxivFIJxmXFmxsRXG0L8KLPhXKgA2', NULL, '63b28606c8bd6', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-01-02 07:21:42', '2023-01-02 07:21:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(690, 'smith3002@yopmail.com', '$2y$10$NmhmBPbZriohQhiGsSwD0OVQfEkhsZ3jcs/2R7/lUGfY30rR90iTi', NULL, '63b28638c772b', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-01-02 07:22:32', '2023-01-02 07:22:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(691, 'hammadkhan.tech@gmail.com', '$2y$10$aTUOiGel3TFiEA3gfsKBReUdc7KulH11V3EFPGO8fNQiAEnjIDZ1e', NULL, '63b2b6f393270', NULL, '4', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-01-02 10:50:27', '2023-01-02 10:50:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(692, 'avi_raj121@yahoo.com', '$2y$10$vNVDMcMlWuwXzI6mhwoGX.d2MxSeWE5fFQ4z9m72whXkpkoQ7wi9C', NULL, '63b3c33d7979e', NULL, '4', '0', '1', 'en', '1', '1', 'Online', '2023-01-03 09:50:53', '1', '2023-01-03 05:55:09', '2023-01-03 12:58:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(693, 'avi_raj121@outlook.com', '$2y$10$CeKjS9xwu08Arbsp9WbRCu412gEC4MNHylWsU7cySrCIb7QRzCMr6', NULL, '63b3c3df93420', NULL, '3', '0', '1', 'en', '1', '1', 'Online', ' ', '0', '2023-01-03 05:57:51', '2023-01-03 07:57:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(694, 'smitha10110@yopmail.com', '$2y$10$JZn3JZXtIBCv.mlsV8WS9ud0jH7KLr19/Z65lT2rY08XO7HU01kG.', NULL, '63b3ebc3d700b', NULL, '2', '0', '1', 'en', '1', '1', 'online', ' ', '1', '2023-01-03 08:48:03', '2023-01-03 08:48:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(695, 'avi_raj124@yahoo.com', '$2y$10$a5Uc7DD6dqNlInsJeknooeQ00mnkF9RmjwrIzOe/g.cixUzo/LCRa', NULL, '63b4e3cd1bd1c', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-01-04 02:26:21', '2023-01-04 02:26:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(696, 'smitha56789@yopmail.com', '$2y$10$.Gkgor1lsGW3otBfEcfHiuaFcgXPDUaL6UF1LX5ZEf6tjD9GVOkkK', NULL, '63b4e42e4b03d', NULL, '4', '0', '1', 'en', '0', '1', 'online', ' ', '1', '2023-01-04 02:27:58', '2023-01-04 02:28:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(697, 'sellerz1002@gmail.com', '$2y$10$DlnUCAU2ap79lD1ujvpyEOpuEjDTT71y/Pv84IHjV.qMokCm5E1M.', NULL, '63b5a7816ea0d', '', '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-01-04 16:21:21', '2023-05-11 22:09:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(698, 'Jennifer.k@mailinator.com', '$2y$10$opAbC.gfi6I.1M8A0gxLh.c4TSfpaFT9qQwQdZZikUTfYZqg0G5C6', NULL, '63b5b1cab4a99', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-01-04 17:05:14', '2023-01-04 17:05:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(699, 'sanil456@yopmail.com', '$2y$10$otUHVf2I.rg4OzBEh2IJY.kP6u5w4o68atEsJnd3YtXXHNCwgPW3m', NULL, '63b6db44deafd', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-01-05 14:14:28', '2023-01-05 14:14:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(700, 'sanil457@yopmail.com', '$2y$10$izUwF4lBTLkQNF5BRy68gOGXwNa8l8O8U0pIuHVndAbW9ewYJAlwy', NULL, '63b6db685e6c6', NULL, '3', '0', '1', 'en', '1', '1', 'online', ' ', '0', '2023-01-05 14:15:04', '2023-01-05 14:15:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(701, 'sanil458@yopmail.com', '$2y$10$7Cvs.Jo/p.iKuGJL7.rlFe9zm/kDc/L.DRGUJLl2w8Ge7VEfK2vum', NULL, '63b6dc5b620c2', '$2y$10$nSCgdk6OF9PJSdSaiAxO4eGaBghFWbMHn807r24qLOSU7a9CJQf2', '2', '0', '1', 'en', '1', '1', 'online', ' ', '1', '2023-01-05 14:19:07', '2023-01-07 05:51:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(702, 'Reba.Cassin@mailinator.com', '$2y$10$CSvipjMkHLcmgDKKGzzfiOK3wvUI4CqdVdzHb0i1wGoMFvARGrg/a', NULL, NULL, NULL, '1', '0', '0', 'en', '1', '1', 'online', ' ', '0', '2023-01-06 07:47:09', '2023-01-06 07:47:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(703, 'Anabelle.Ankunding@mailinator.com', '$2y$10$3fYsJqZZ.g9BjK3vVnBuM.uMS3aJ5FoFeumSclL1Dx5FzbOXCR.gm', NULL, NULL, NULL, '1', '0', '0', 'en', '1', '1', 'online', ' ', '0', '2023-01-06 08:33:46', '2023-01-06 08:33:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(704, 'Anabelle.Ankunding@mailinator.com', '$2y$10$xSdN5QZtbdIMKizslyveYOXaUoyT3d2/cYzB5qlKoaSKaOnaB82FC', NULL, NULL, NULL, '1', '0', '0', 'en', '1', '1', 'online', ' ', '0', '2023-01-06 09:27:01', '2023-01-06 09:27:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(705, 'smitha_001@yopmail.com', '$2y$10$1Z9shPHWmgHGS0BCw0anVOcGZDJkwmubqehV6vT7c5S91f9dsmZM2', NULL, '', NULL, '3', '0', '3', 'en', '1', '2', 'Offline', '2023-01-09 06:24:27', '1', '2023-01-09 06:00:24', '2023-01-09 06:24:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(706, 'smitha_005@yopmail.com', '$2y$10$TIeaW4wWY6x3zrWA87boweGmuZlWEBy6U9cU2sx2SNH6KS7sWQ30a', NULL, '63bbb3f412a9f', NULL, '2', '0', '3', 'en', '0', '1', 'online', '$2y$10$oU.jrEBy1wgAfMt9XQ0MBuv.juj.p6plL2MBHOMLBZt29fJ/1frDu', '0', '2023-01-09 06:28:04', '2023-01-09 06:28:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(707, 'smitha_006@yopmail.com', '$2y$10$0MlHYXXm50sY8bFBSxlJJeUE/AUa.0oTq0009v3siNPl/pbC6mpvW', NULL, '', NULL, '3', '0', '3', 'en', '1', '2', 'Online', '2024-01-23 10:09:12', '0', '2023-01-09 06:30:04', '2024-01-23 10:09:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(708, 'Test.caivilll@mailinator.com', '$2y$10$mHRnYsLZ3yBSeYe81qcGWuDB5iC1vdZZqg/Y0JTpCH9eqkSVNNHyq', NULL, NULL, NULL, '1', '0', '0', 'en', '1', '1', 'online', ' ', '0', '2023-01-09 11:55:16', '2023-01-09 11:55:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(709, 'smitha_009@yopmail.com', '$2a$12$2z9moKKLi..sLiBoPvPv1.oOQqNpamSEW9Kn51ZmOG2nnD7sZWNES', 'ZXUvgBQO63BclhunpbMGMVnKngT2iP6SVlNBm1xKHC5hkCM6oq85knTjobhT', '', NULL, '4', '0', '3', 'en', '1', '2', 'Offline', '2023-05-18 05:45:54', '0', '2023-01-11 05:57:19', '2023-05-18 05:45:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(710, 'adumar0304@gmail.com', '$2y$10$iB5/XH/XziQGgcuQyQKZ3uwIfhO5sVczPIw9QJz16RHhbwEMEIP8O', NULL, '63c0005ad24b9', NULL, '3', '0', '1', 'en', '1', '1', 'Online', '2023-01-16 10:52:53', '0', '2023-01-12 12:43:06', '2023-01-16 10:52:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `agents_users` (`id`, `email`, `password`, `remember_token`, `activation_link`, `forgot_token`, `agents_users_role_id`, `agent_status`, `step`, `language`, `status`, `first_login`, `login_status`, `api_token`, `is_deleted`, `created_at`, `updated_at`, `card_number`, `name_on_card`, `cvc`, `card_expiry_year`, `customer_id`, `card_expiry_month`, `package`, `fcm_token`, `device_type`) VALUES
(711, 'smitha0800@yopmail.com', '$2y$10$JDgE7cpB4zPkoTCn2mlD6..3Qe8IqojYCoH7rHV5/cBJ9V8KpQP46', NULL, '63c00ddc4da99', NULL, '4', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-01-12 13:40:44', '2023-01-12 13:40:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(712, 'smitha0801@yopmail.com', '$2y$10$eYsM5iQV7J7QpW52pxszzuguUuKSNcdj4kgBDaFRs1O6nYqryWVYW', NULL, '63c00e63e02f5', NULL, '4', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-01-12 13:42:59', '2023-01-12 13:43:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(713, 'smitha_0001@yopmail.com', '$2y$10$Y9ioFIPtM.rk8CH103dkVuhrl24sTWrMdiGGlTixtO0cWplZbIjVC', NULL, '', NULL, '3', '0', '3', 'en', '1', '2', 'Offline', '2023-01-16 05:56:41', '0', '2023-01-16 05:44:53', '2023-01-16 05:56:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(714, 'smitha_002@yopmail.com', '$2y$10$5UHj4jePUlfFBfvtjE40CuAwLNTNcWege3WBF6kUsAVqAPl69xZD2', NULL, '', NULL, '3', '0', '3', 'en', '1', '2', 'Online', '2023-01-16 19:48:07', '0', '2023-01-16 05:46:58', '2023-01-16 19:48:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(715, 'smitha_0003@yopmail.com', '$2y$10$GaPeZDb82trZrXvwO6ySn.I0OKQVupuXY0jZVhJHlsReKAS.I9v3S', NULL, '', NULL, '4', '0', '3', 'en', '1', '2', 'Offline', '2023-01-16 05:52:20', '1', '2023-01-16 05:49:19', '2023-01-16 05:52:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(716, 'wesleynorm261@gmail.com', '$2y$10$PVDWm4Ofj6VjMiUQOI5OXu9pDhN5GZEjVc3peEPvmZ2w5o8j/TuXW', 'IepQDGwSay3YReltzTm9XaBvAnSkw3XwLglLDjcGF8yQXejMGbFNko9Rimwa', '63caf3ac96fc8', '', '2', '0', '1', 'en', '1', '2', 'Offline', '2023-11-29 17:23:09', '0', '2023-01-20 20:03:56', '2023-11-29 17:23:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(725, 'smitha0710@yopmail.com', '$2y$10$EnVS/7jLaKqQeD7rqXfPdOYfqpOcxoekWVRt5pQioL47GsTb/Cg8i', NULL, '63d72289c872b', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-01-30 01:51:05', '2023-01-30 01:51:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(726, 'smitha.001@yopmail.com', '$2y$10$XTY3jtwqLEjFQf7sp9uIXeaAW5CMyK0MekZod3PJQBlEzX1KKGE4W', NULL, '63d723462159e', NULL, '3', '0', '1', 'en', '0', '1', 'online', ' ', '1', '2023-01-30 01:54:14', '2023-01-30 01:54:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(727, 'smithar001@yopmail.com', '$2y$10$2UQ4xB0bI5e9FNWzRtYYo.NFLw12H63fUbtWnJSPAS2wRBxaAVFpu', NULL, '63d75ebcc9d4c', NULL, '2', '0', '1', 'en', '0', '1', 'online', ' ', '1', '2023-01-30 06:07:56', '2023-01-30 06:07:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(728, 'smithar002@yopmail.com', '$2y$10$EsFOixVHHe9/l0U9a10A1u9BW9IzY3/1CkgmJRFr148AChmvF2UL2', NULL, '63d75ef5a7775', NULL, '3', '0', '1', 'en', '0', '1', 'online', ' ', '1', '2023-01-30 06:08:53', '2023-01-30 06:08:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(729, 'smithar005@yopmail.com', '$2y$10$8A3cxZBhkA7m4gzwjkTY7.5iRORxIVYjn4A8h8vgWZNna54uKPsl6', NULL, '63d75fa701118', NULL, '3', '0', '1', 'en', '0', '1', 'online', ' ', '1', '2023-01-30 06:11:51', '2023-01-30 06:11:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(730, 'smithar006@yopmail.com', '$2y$10$FzSAnnaJ0MdcLGGwmyBVW.wXcT6ELFfl6FrJRHylU6nx5BMnkjZIK', NULL, '63d760c9720a7', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-01-30 06:16:41', '2023-01-30 06:16:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(731, 'smithas001@yopmail.com', '$2y$10$/aJM6dqbBgfcOvYaCFJMd./79RlP4nNoEyAF53ZR2.pZLxklsLI5i', NULL, '63d7610b9603f', NULL, '4', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-01-30 06:17:47', '2023-01-30 06:17:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(732, 'smithas002@yopmail.com', '$2y$10$9xYA9Fde4yUceBzuHclM2O5Wkxzx8SCdtA3V34DmjIiHu9zcvJRXW', NULL, '63d771a546f4e', '$2y$10$CJNMkyIwULjNaB08x.lZq.LxCM6VOsRQ3m11JxD.5n5F95leh5FS', '2', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-01-30 07:28:37', '2023-02-04 17:48:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(733, 'haider786@gmail.com', '$2y$10$XXKGIjrX8WyFtr.BCA5TBOLSRlE3LY9ChB5Rlw1Ist1KXsC59mK8G', NULL, '63dd6542e2432', NULL, '2', '0', '1', 'en', '1', '1', 'Online', ' ', '0', '2023-02-03 19:49:22', '2023-02-03 19:50:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(734, 'garsvtgarima@gmail.com', '$2y$10$06L231/NpV/EkJO02Czseet.QwZ1ExwfnJe4ZnklTD6P0aeyLVKzu', 'Wa7oqdkSIc7OOgVxygj5TDoKu2bhQLuf4GJR67dbZeNP4YXqvVYYIDxIrQCp', '', '$2y$10$MXqyNTVYneq0k3L9NMWtYu0ePd8Q6BMqEHOpLkyJjyJhs1Bp5kTG', '2', '0', '3', 'en', '1', '1', 'Offline', '2023-02-05 08:56:00', '1', '2023-02-04 17:53:25', '2023-02-05 08:56:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(735, 'svt.bajya@gmail.com', '$2y$10$YonZZH1A.588PaIBQ1R2zOvgcjJnZ3GZl3gRZoS24u/qtDJAeIHg6', 'mhjSfdoqKVRAPpSC2fv3CfAypj5uraFDTyyr7er01h1aD5qjp7AtCaKJ0Y27', '', NULL, '4', '0', '3', 'en', '1', '2', 'Offline', '2023-03-02 16:30:22', '1', '2023-02-04 20:17:20', '2023-03-02 16:30:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(736, 'tony877wanglive@gmail.com', '$2y$10$ICP61L5x3Av4A7MP2gt58OlW.nNiMnrwYzU9lnzH1AvX6VylpriIS', NULL, '63debe736f174', NULL, '4', '0', '2', 'en', '0', '1', 'online', '$2y$10$Mbur8PXf4Wf49MhIiGLVm.Uv4pRT04MNjxhnH5o7RnUkNZpo9Szu.', '1', '2023-02-04 20:22:11', '2023-02-04 20:22:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(737, 'sam.copperstan@gmail.com', '$2y$10$4Vw.wwa1rGg1pDzJZBvJ8uNNOxRDBj6nuOrQ53t0a/irUuXVi3OXi', NULL, '', NULL, '3', '0', '3', 'en', '1', '2', 'Online', '2023-02-04 22:38:04', '1', '2023-02-04 22:11:50', '2023-02-04 22:38:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(738, 'asdabds@gmail.com', '$2y$10$fCtgLrmVtnDwYXwIuRyMUeL/jpFikBUczEKdVJfU0FwR91lmcHunq', NULL, '63df6cdb3bf30', NULL, '3', '0', '1', 'en', '0', '1', 'online', '$2y$10$Xq2/ovw74q2XI2yt9pLUIOpVWIJIVSH6mHxHEAwwChH4D2GRKrbDi', '0', '2023-02-05 08:46:19', '2023-02-05 08:46:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(739, 'brodychatbrckle@gmail.com', '$2y$10$VTHhG2MGt7TUnbHsDRTm1./OwzQ8BZRPZmhEio94WTcTC/3W6sypG', NULL, '', NULL, '2', '0', '3', 'en', '1', '2', 'Offline', '2023-03-02 13:07:38', '1', '2023-02-05 09:06:43', '2023-03-02 13:07:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(752, 'bcsm-f18-0100000@superior.edu.pk', '$2y$10$SLx.0XSn6lxahz3i7x/gF.riTaVFc92BiT2wjBmtKfhY1CT2e9u5.', NULL, '63fbacffd5311', NULL, '4', '0', '2', 'en', '0', '1', 'online', ' ', '0', '2023-02-26 19:03:27', '2023-02-26 19:07:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(753, 'bcsm-f18-4330@superior.edu.pk', '$2y$10$EYJqsZOQk9b8g.U8Qe7O9upsDrlVI4yzWpIAXQmkB4z2/Z3TIpN0a', NULL, '63fbae9d064a7', NULL, '4', '0', '2', 'en', '0', '1', 'online', ' ', '0', '2023-02-26 19:10:21', '2023-02-26 19:13:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(754, 'bcsm-f18-43300@superior.edu.pk', '$2y$10$F8R5ZijJTVU9ooFZ9HiYLenXrupZoHjrT0EOBfjsuhpHxDIfjGIW.', NULL, '63fbb060a732f', NULL, '4', '0', '3', 'en', '0', '1', 'online', ' ', '0', '2023-02-26 19:17:52', '2023-02-26 19:26:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(755, 'ansernawaz22@gmail.com', '$2y$10$4EUG5N6XN.NLe.UUROwSreYJigqfX0Jw6MsrfTmTaUHRszsehcdT6', NULL, '63fd3718e9bcb', '$2y$10$xKK0.ck0wpGgOKsSTWvW.dwiMRzU1mXIkngysW8sBs.ZbbQRnNOW', '2', '0', '1', 'en', '1', '1', 'Online', '2023-03-26 14:23:49', '0', '2023-02-27 23:04:57', '2023-03-26 14:23:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(756, 'alishbaaftab26@gmail.com', '$2y$10$IX9x7ND0.ocU4RwNzryFrOdSExpj3qaM0LSocsLuNr.uaD4/3IDzu', NULL, '', NULL, '4', '0', '1', 'en', '1', '2', 'Online', '2023-03-04 13:18:42', '0', '2023-03-01 12:41:04', '2023-03-04 13:18:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(757, 'alishbaaftab223@gmail.com', '$2y$10$Yr33sPXysqx2X.mPDYeonOyqiNQ06nnz7DWaHj2.rrf0/xd982gZu', NULL, '63ff591e95ffd', NULL, '4', '0', '3', 'en', '0', '1', 'online', '$2y$10$2.sk9/1Oxj2wHK3BwlCiFeaKDBZ0M.Z2Vf6gVb1hPuqT3erW/7TZu', '0', '2023-03-01 13:54:38', '2023-03-01 13:57:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(758, 'alishbaaftab22@gmail.com', '$2y$10$pn/OJooJ3PDI/RIInbAfMOOtwWQrsCMpdrZZD4MAe7O17JQgQntKu', NULL, '63ff8f4db3874', NULL, '4', '0', '3', 'en', '0', '1', 'online', '$2y$10$Bc6Jfuy8MwZCcoGH5hBrcOe7ib33bMuTWKopFiOgVu4JGXKeBqwyG', '0', '2023-03-01 17:45:49', '2023-03-01 17:46:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(759, 'adv.srivastavagarima@gmail.com', '$2y$10$n1zydeJMuNsWll5H72FKU.gEfSXPitlV2BAgDpfrLbWH2Uq2gi4IS', '5O9tPF0ULlNpWlp6wiJrrhWcchz6OQcI2cz6595s1vJplJURDEGu0JvY9KZ6', '', NULL, '3', '0', '1', 'en', '1', '1', 'Offline', '2023-03-02 13:04:38', '1', '2023-03-02 07:21:36', '2023-03-02 13:04:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(760, 'richgary123note@gmail.com', '$2y$10$IZK540Zg/dsrSZhS6hMa2OEKvxpcBqqb9NubrrZIB5zG/a23DwkDe', NULL, '', NULL, '3', '0', '3', 'en', '1', '1', 'Offline', '2023-03-02 16:13:55', '1', '2023-03-02 16:05:38', '2023-03-02 16:13:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(761, 'kev88wang@gmail.com', '$2y$10$lgz4kIrRHe1VWRY7lv8qju6K666Xq4f7CDSlK9GFBd/II1nNRQkpK', NULL, '', NULL, '3', '0', '3', 'en', '1', '2', 'Online', '2023-03-02 19:35:00', '1', '2023-03-02 19:02:12', '2023-03-02 19:35:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(762, 'pj1494156@gmail.com', '$2y$10$OC7lHzuLny0Om2GY3SwZTOEH18t8.8UrMfJdR2Uqledjp6zQES3li', NULL, '', '$2y$10$IrojaMrGNQ6EyMl8Ut9gOnRm5WLiGVsPZNoNR0up1LgsJS6hNS', '3', '0', '3', 'en', '1', '2', 'Online', '2023-03-03 12:20:13', '1', '2023-03-03 08:09:16', '2023-03-04 15:23:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(763, 'john2781.maria@gmail.com', '$2y$10$PLmGsJFmrjo3my6WcekT2OZFa4grv3oLDJZeN6Mqeqzie/AQXNuXa', NULL, '', NULL, '4', '0', '3', 'en', '1', '2', 'Online', '2023-03-04 20:36:47', '0', '2023-03-03 09:47:56', '2023-03-04 20:36:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(764, 'lutharamartin1@gmail.com', '$2y$10$bPfxMshdJVseebxAtW6KxO44ERyISwq5jw2jkavweUshOh0yV6L3.', NULL, '', NULL, '2', '0', '3', 'en', '1', '2', 'Offline', '2023-03-04 20:09:33', '1', '2023-03-04 15:15:08', '2023-03-04 20:09:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(765, 'alishbaaftba26@gmail.com', '$2y$10$IFmL5ykCyMU.C0Ya2GZ8a.tLd9GdJC2tplw4plhuDNSD0Y7LXEexi', NULL, '6403a0b114f60', NULL, '3', '0', '3', 'en', '0', '1', 'online', '$2y$10$eihMLA8FzXpp8JL4sbHJU.jpCte2SyBXlRo5gpny.X4TAKxCB3pri', '0', '2023-03-04 19:49:05', '2023-03-04 19:49:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(766, 'jporsche08@gmail.com', '$2y$10$1mpdY5MK6ysu04SMpQWSCeYqmevrc7hv56oM32K814IxEIZyDbudy', NULL, '640d176ca87d2', '$2y$10$jVk4pOrTgPWf86GFRSvg5eeRnqN352ob3pdCyLcMf.J8gTjtx8weu', '2', '0', '1', 'en', '1', '1', 'Online', ' ', '0', '2023-03-12 00:06:04', '2023-03-12 02:22:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(767, 'kritu9654@gmail.com', '$2y$10$A3glpFTMl0qDcIXq9fUGFO3wROIY/.YG1Bj9/mlqYoo/85dhZdTvO', 'HpKBOPoRGeHcSMRCPzwg0gNCkUorTT89dXLkxI09xwE7rXFNZUw4OFO3F46O', '', '$2y$10$lUqwHtVk0xTs.kRQkYPdkujFzEGomSSfjkLsExSlQMOBfh2b.h5y', '3', '0', '3', 'en', '1', '2', 'Offline', '2023-03-18 13:07:39', '0', '2023-03-12 07:50:41', '2023-03-18 13:07:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(768, 'ritucute9654@gmail.com', '$2y$10$koHngWYzZrjUgKVQV4mY3OhU7OrHl19iMO./0Gb4MgyYVCH5K6AEW', 'ElfRdjTih6ShmTzedyElNbFJ3CQiD041BtB7dul1MF9qrJ47DgdsbkCfA9sR', '', NULL, '2', '0', '3', 'en', '1', '1', 'Offline', '2023-03-15 14:13:11', '0', '2023-03-12 07:56:39', '2023-03-15 14:13:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(769, 'sumitsinghchauhan9654@gmail.com', '$2y$10$GqAXpTRbuFjE/Zcz2R60euUElijMmejlkeudDhSsmkUYhIJLO3f2y', 'FL867UWJZSOxPUl8KjPjUj6kbtB9N7bW27TkVT3X0B9yuS2tA4EJ29ONO83g', '', NULL, '4', '0', '3', 'en', '1', '2', 'Online', '2023-03-18 13:18:30', '0', '2023-03-12 08:07:53', '2023-03-18 13:18:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(770, 'hdjdh@gmail.com', '$2y$10$FN5.vtAjUNQ5olQ.egYKyOykbZBEYPuHOJvaurw/XM5x051BIALce', NULL, '640f5b18c673e', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-03-13 17:19:20', '2023-03-13 17:19:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(771, 'alishbajutt1@gmail.com', '$2y$10$j9bkm/M1ANGgbx8di.80Ye78d8/hNh4ksj62CMo6Ey2xmaBWUAbae', NULL, '64103f27ecde3', NULL, '3', '0', '3', 'en', '0', '1', 'online', '$2y$10$G2mARH/FJLdhiZ/VJlXjT.FTmiC4P5uh4z/IXnAE7Bl7K/IEkBFjW', '0', '2023-03-14 09:32:24', '2023-03-14 09:32:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(772, 'Test@gmail.com', '$2y$10$3bplAzdlyyMIdwN.IhK7UeD8W9BM5tq2MnPzmNSO6GgZE2QHwNSzO', NULL, '6411d9199d202', NULL, '3', '0', '1', 'en', '0', '1', 'online', '$2y$10$PQpR00kcbUdjM27qrMToJujYUnwG0cPBGuSN5MGPQdiqEkKOHuYeW', '0', '2023-03-15 14:41:29', '2023-03-15 14:41:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(773, 'anu@mailinator.com', '$2y$10$B.mM5LyRmAROjmDwPlvyeOa/.zxRC.fTN0r4hkFWfi.K/dcNKztWq', NULL, '', NULL, '3', '0', '3', 'en', '1', '2', 'Offline', '2023-03-16 09:41:11', '0', '2023-03-16 05:49:53', '2023-03-16 09:41:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(774, 'santoshsingh9560161178@gmail.com', '$2y$10$.H7cNQZ2GjZpSZ8tW72lYOy7pSQ3ojqRy3iSbiaAmb0NeTZGFz3o.', NULL, '', NULL, '4', '0', '3', 'en', '1', '1', 'Online', '$2y$10$z8JJ2emZfm17AwF.BEnkMewM.mlFIeMNMJE1aG0am31Bhz40Mvbhq', '0', '2023-03-16 17:07:00', '2023-03-16 17:09:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(775, 'manojmht45@gmail.com', '$2y$10$r3dRkAw0fQfCbwdzjrVcwOEh/r/lqGkvh3iBNupLh/7Pe3Jd.c6Mu', 'mI00d8A8wehRagjdiM6dxNU7GoCPQ3Aluz7OaGIvK5PRSwybl39QV11cAxU8', '', NULL, '3', '0', '3', 'en', '1', '2', 'Offline', '2023-03-22 02:57:28', '0', '2023-03-22 02:33:27', '2023-03-22 02:57:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(776, 'dev.react45@gmail.com', '$2y$10$TQ2E7C4niJ18BHcgRJULaOHR9BxnIBAQ1qjGa8GkWIwa60r4DMOR.', NULL, '', NULL, '3', '0', '3', 'en', '1', '2', 'Online', '2023-03-27 04:57:32', '0', '2023-03-27 02:23:15', '2023-03-27 04:57:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(777, 'dev.laravel45@gmail.com', '$2a$12$WF8//Ikg23yqjmjLeo6zSOVKD0SNiKiUSrsrRy2KGVleoZkIfG5v2', NULL, '', '$2y$10$lHw.1bQReaMG90CR4Zce.Rmib8YIhuMj7lGKIwKrXlVMpxmk.Dy', '2', '0', '3', 'en', '1', '2', 'Online', '2023-03-27 17:43:33', '0', '2023-03-27 02:51:53', '2023-04-28 11:39:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(778, 'hybridplus22@gmail.com', '$2y$10$SKmyCxoXxOaXEUlMcDYkTOLiaKR8j/VCxsUQwMgtWb2evyarbReiq', NULL, '', NULL, '4', '0', '3', 'en', '1', '2', 'Online', '2023-03-27 05:15:42', '0', '2023-03-27 03:03:04', '2023-03-27 05:15:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(779, 'pruminneimmoillau-8032@c-eric.fr.cr', '$2y$10$4ISLHnLJghRmA6FuUHfsV.n2/7epZkoJgKdiugGTZN518GO7nT4t6', 'sWbWxqkuUVX7mz1MIM5zNZ5Z7j6yvZjWcBNxGdAIWPlhXFSw8kXctKBeO0sk', '', NULL, '3', '0', '3', 'en', '1', '2', 'Offline', '2023-04-13 09:22:11', '0', '2023-04-13 05:00:09', '2023-04-13 09:22:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(780, 'testagent004@yopmail.com', '$2y$10$G9vEHBPW9NT8eXZizYNTee7fLf/ShPsSkk.Wung4VbhlAuxcL6MfG', NULL, '', NULL, '4', '0', '1', 'en', '1', '1', 'online', '$2y$10$RJLK9fPAn6LD6d9S1g1KrexSEf53i7WoOetHP0GI/bcE2TdE/idC6', '0', '2023-04-13 09:23:13', '2023-04-13 09:25:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(781, 'testagent0044@yopmail.com', '$2y$10$xtsa6KwAAv7wKgqD/lITDOTOy1mK1hxYrj5aLtLs5nvdtD9EdPh..', NULL, '', NULL, '4', '0', '2', 'en', '1', '1', 'online', '$2y$10$nzOYnXfIe9Cu18TQ4QqtFOVnwFAdSxAvEM2T8ipXok2WX8dWJv3Ca', '0', '2023-04-13 09:33:38', '2023-04-13 09:41:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(782, 'testagent00445@yopmail.com', '$2y$10$3Elm58tRgL97zY27FCXJuOj9SZBSsUqbQ/dGHMFKw.hiwAeNSNYZC', NULL, '', NULL, '4', '0', '3', 'en', '1', '2', 'Offline', '2023-04-13 10:04:48', '0', '2023-04-13 09:47:50', '2023-04-13 10:04:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(783, 'sellertes004@yopmail.com', '$2y$10$Z0Nh0AoLxHIWlAX3ac20q.1.TzKPWN0vaoNzblcMa8mBV8mltEuie', NULL, '', NULL, '3', '0', '3', 'en', '1', '2', 'Offline', '2023-04-13 10:09:54', '1', '2023-04-13 10:05:35', '2023-04-13 10:09:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(784, 'seller@gmail.com', '$2a$12$qftooVUZ3720yK2eTAy/8.iIG5Sq5Fii.C45HlFD5xfekMgn//dya', NULL, '', '$2y$10$FcGuuT3enKgAU0.TdsJg4u8rxONNJKI2sYoEgEz1rnTan2sofP7O', '3', '0', '3', 'en', '1', '2', 'Online', '2023-04-13 12:51:08', '0', '2023-04-13 10:18:43', '2023-04-29 05:42:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(785, 'agent0044@yopmail.com', '$2y$10$c7rPAmCyRuPAebMU4s3xRO9q/bpy7vhBzNO5CsvSr8U1jLNSUCwXi', NULL, '', NULL, '4', '0', '3', 'en', '1', '1', 'online', '$2y$10$h/GF5ww9RuERf8ktsvGE3OEYe9nQuJtpOseUZ17qHopgwW3VZmK46', '0', '2023-04-13 11:03:12', '2023-04-13 11:03:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(786, 'agent00445@yopmail.com', '$2y$10$oY3Cp6OBfeTRWO.N1W9cROKv9LGEqzIkIVJfyIk7zqZUQOSxqZZrm', NULL, '', NULL, '4', '0', '3', 'en', '1', '2', 'Online', '2023-04-13 13:10:16', '0', '2023-04-13 11:05:30', '2023-04-13 13:10:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(787, 'akashagent@gmail.com', '\n$2a$12$cfne9W/0GFKvPAW8dsFBS.OiMRFA7utQlkNX077bj0p0gmFihcGr6', 'UGinUOIPgx1Z8wif5SuVnV2HeecqAKWEvadPDGpfCF4sgZ2EHH2QoAjTHvib', '644baa465a93e', NULL, '4', '0', '3', 'en', '1', '2', 'Offline', '2023-05-29 04:59:13', '0', '2023-04-28 11:13:10', '2023-05-29 04:59:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(788, 'dk71275800@gmail.com', '$2y$10$oHgql98IQjp8nT.gAT8tAuEVPqdnJ/Iq72JIg0.gyFH8i51OBD3om', NULL, '644f64ae041a2', NULL, '4', '0', '3', 'en', '0', '1', 'online', '$2y$10$kEGLHIQMVL/mVOdrLkag5u9nPdYtdTo1T6e/AeCSYU.2bK.s3.NZy', '0', '2023-05-01 07:05:18', '2023-05-01 07:13:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(789, 'absd@gmail.com', '$2y$10$nTof7PYMi//wLqB25A9QduSvA3KTc.XB66kPdE7o6T4C4VEyI1kw2', NULL, '645dd2c341205', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-05-12 05:46:43', '2023-05-12 05:46:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(790, 'rajesh@123', '$2y$10$UUBFCDVIICXqXhdHHYuukeyI5f7rElpxl3q0UoFmgMXFUBCJfkMFe', NULL, '645de5a70b9c0', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-05-12 07:07:19', '2023-05-12 07:07:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(791, 'nunu11@gmail.com', '$2y$10$MgldmXYTlPOq.gtfBGL5Ne0WUWnkGAzRF1bGeMI.7x5KKwrWOO41a', NULL, '645deace205cf', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-05-12 07:29:18', '2023-05-12 07:29:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(792, 'gm123@gmail.com', '$2y$10$UpwMQiKhBMZzTw7Sg2TbIeIebPDx9kAEsunDZkFLMl.kJ1YpQq/BO', NULL, '645debc68d16c', NULL, '1', '0', '1', 'en', '1', '1', 'online', ' ', '0', '2023-05-12 07:33:26', '2023-05-12 07:33:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(793, 'nel@gmail.com', '$2y$10$MityYmjhwbSN4Xp1NkloMupgqEvfKsx4W.sTCoDN3gI6h93EydLzu', NULL, '645ded4279fb4', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-05-12 07:39:46', '2023-05-12 07:39:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(794, 'absdqqqqq@gmail.com', '$2y$10$F49te9/497wfxdN3nVV3PefMPaC/zxkqYvgXWr5JplGbkZAaXEruu', NULL, '645deee7a210c', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-05-12 07:46:47', '2023-05-12 07:46:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(795, 'absdqqqqqqq@gmail.com', '$2y$10$AKDUCvYiZC/2SoWJfry0D./Gce6AVSX/GXPjGeSEZXGAMnwI8RTke', NULL, '645defa937b22', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-05-12 07:50:01', '2023-05-12 07:50:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(796, 'lolu@gmail.com', '$2y$10$ZVKU6ORQllub/RlrADeAxOCM11i7nruvJZifLAmXhnb94Gw3ZvIae', NULL, '645df03351bf5', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-05-12 07:52:19', '2023-05-12 07:52:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(797, 'absdqqqqqqqqqq@gmail.com', '$2y$10$4UDVth9bQSw9e3cD7dXzquqzJikCF9RXCzr4Fbe4JVC4lAQ4xrCgG', NULL, '645df167e2a72', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-05-12 07:57:27', '2023-05-12 07:57:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(798, 'vv123@gmail.com', '$2y$10$7OEPtgcED0GNU9CP3kmbTePb2mD8u/m2t0iB/pCv7LyPJziqUqf7q', NULL, '645df17ce6c16', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-05-12 07:57:49', '2023-05-12 07:57:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(799, 'v123@gmail.com', '$2y$10$HxSv8h/hk6wZp993AwAlau3MUnRxXMaAfHX6hFGJOppIBwBjhqRCm', NULL, '645df286e7737', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-05-12 08:02:15', '2023-05-12 08:02:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(800, 'vr123@gmail.com', '$2y$10$JEhmHlr3IZ5FGYFMFJfRWuGNY873puILCOHWexpcLx/nv7z0YOW7e', NULL, '645df2d918f78', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-05-12 08:03:37', '2023-05-12 08:03:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(801, 'vrq123@gmail.com', '$2y$10$jfKvgeN.NQzaBPjoo7jwMeqB7.jifJ5EZQWIfFgm48P3U2.6Mya7u', NULL, '645df37074c10', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-05-12 08:06:08', '2023-05-12 08:06:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(802, 'vrqp123@gmail.com', '$2y$10$.dw9TtBfkciu5uM7jLYj2uwMYAAula7iaU4PbGwYkbWWDVxmWTwpm', NULL, '645df3df10f28', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-05-12 08:07:59', '2023-05-12 08:07:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(803, 'qp123@gmail.com', '$2y$10$p/wJ5jnQ0BX0PppGsrUbS.07iFPSG72O.cOmmgRynsttaDCvHaPX2', NULL, '645df63b62c65', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-05-12 08:18:03', '2023-05-12 08:18:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(804, 'qp12@gmail.com', '$2y$10$rFkvPUdNRe6TiXG8HMrk5ema0gnG4D2qyHL78D5h6RGauB4vJ4EMq', NULL, '645df7f0328e2', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-05-12 08:25:20', '2023-05-12 08:25:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(805, 'qpp12@gmail.com', '$2y$10$01mQEeLR9AES./ltcteSJuMhZUqbvTkU2EuidpPSV3RdSQk.Yuo.q', NULL, '645df8874fd1e', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-05-12 08:27:51', '2023-05-12 08:27:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(806, 'aa@gmail.com', '$2y$10$fDt89KvXTZR.yHCXk83BceH2GIE10dopVzqODw3DmF7fHvfI3Ebp2', NULL, '645df8eab20d7', NULL, '1', '0', '1', 'en', '1', '1', 'Online', ' ', '0', '2023-05-12 08:29:30', '2023-05-12 11:01:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(807, 'viki12@gmail.com', '$2y$10$baDbcisjOqL6DZFLX0FzkuSR5KZ8XsaWd41cPAsQz0mwI8u.af6He', NULL, '645e1b5fab860', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-05-12 10:56:31', '2023-05-12 10:56:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(808, 'viki123@gmail.com', '$2y$10$7eOp/oAk5oKF.Fp9lm0/gebdG9wQbDTOtn9w7HbvdCFVHtPEpRYEq', NULL, '645f2539eeba1', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-05-13 05:50:50', '2023-05-13 05:50:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(809, 'dhirajnew@gmail.com', '$2y$10$UTLiXFCsZ0aICr2ceqFxauLG/kCO3GCxzIr/QivlwesVk7E4laoj6', 'WTXRy5vLw5aobBOUP9QMZIpIsMz73jvUYIdNruqyKmrflUhCXyNR4ycFStbu', '645f7df2c40c0', NULL, '4', '0', '3', 'en', '1', '1', 'Offline', '2023-05-15 10:38:17', '0', '2023-05-13 12:09:22', '2023-05-15 10:38:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(810, 'lala123@gmail.com', '$2a$12$WF8//Ikg23yqjmjLeo6zSOVKD0SNiKiUSrsrRy2KGVleoZkIfG5v2', 'zZXsGVD4m7GK2SgjdXBKUbjAYLZghKms5onn0ErF5iLKUnwwjhBZ6Mmgh7qX', '6461e05287317', '$2y$10$TGBODcmbWqdrDObYzHsouKke7qQVIozAD9h5XYdZXXcedCYvjwZK', '3', '0', '1', 'en', '1', '2', 'Offline', '2023-07-10 09:11:23', '0', '2023-05-15 07:33:38', '2023-07-10 09:11:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(811, 'rs9549712232@gmail.com', '$2y$10$VrOEpR1oBRG4AZpOQk7YOOofN3QIVSKISJiXze1XtXwl18ClXj95u', NULL, '6461e19b49ece', '$2y$10$.gr9ClyEa1Sjt9HqaTFwVON92s5eyazEAsek.vpezNjSeS9v02OW', '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-05-15 07:39:07', '2023-07-18 08:21:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(812, 'bilu@gmail.com', '$2y$10$VLzdm.dHlewucLGio9H60e5U4LKLtCvD2qAgRDCQDekT4jyDcs15m', NULL, '6461e223676d7', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-05-15 07:41:23', '2023-05-15 07:41:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(813, 'abssssd@gmail.com', '$2y$10$tQe923z8cAKdJmVNhCBPGOieLSaAmBuEDRfht1swif8hF9zktiqty', NULL, '6461e296df96a', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-05-15 07:43:18', '2023-05-15 07:43:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(814, 'abssssssssd@gmail.com', '$2y$10$RSv7veS35WEjbARX/iOnSea3vOuOYPJ1YsNdb.fyl378zDXx/1pry', NULL, '6465d832435a9', NULL, '1', '0', '1', 'en', '0', '1', 'online', ' ', '0', '2023-05-18 07:48:02', '2023-05-18 07:48:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(815, 'absssssssd@gmail.com', '$2y$10$oKJa3R..sq5BNhmPMGooJuY0X4bd/MDJciQDuJd0qrMqGuygnXE82', NULL, '6465d85b32b49', NULL, '1', '0', '3', 'en', '0', '1', 'online', ' ', '0', '2023-05-18 07:48:43', '2023-05-18 07:48:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(816, 'absjdgfssssd@gmail.com', '$2y$10$nDi0wl1bXrkmnafhQmOn4OHIfcCSPXbV5YTaIkJ5HzU3ZaRfl6l6q', NULL, '6465db89c554e', NULL, '1', '0', '3', 'en', '0', '1', 'online', ' ', '0', '2023-05-18 08:02:17', '2023-05-18 08:02:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(817, 'user1@gmail.com', '$2y$10$xT./ltB.rA/vpQWkMjnMouoWttalIYZUnT.OYQkUKsInAsfBS1jRS', NULL, '6465e25eaa3f1', NULL, '1', '0', '3', 'en', '0', '1', 'online', ' ', '0', '2023-05-18 08:31:26', '2023-05-18 08:31:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(818, 'viki@gmail.com', '$2y$10$yrAiPvLdFQc1xll0Fca6HO6.YB5YJvcI4V20qCH4BNje1Fx35CiBS', NULL, '6465f9abdb1fd', NULL, '1', '0', '3', 'en', '0', '1', 'online', ' ', '0', '2023-05-18 10:10:51', '2023-05-18 10:10:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(819, 'vii@gmail.com', '$2y$10$shsqlOaGzq9viqmosQIVieE9ZTTMUsjcM4nT2Vi14HQSM084LwD5y', NULL, '6465fa5edc1ef', NULL, '1', '0', '3', 'en', '0', '1', 'online', ' ', '0', '2023-05-18 10:13:50', '2023-05-18 10:13:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(820, 'vi@gmail.com', '$2y$10$O/J3SbHfV/0TR7wU03DG4.4TIxr7.3PnF3oX11tMQfRovfNMeK8w2', NULL, '6465faeb810dd', NULL, '1', '0', '3', 'en', '0', '1', 'online', ' ', '0', '2023-05-18 10:16:11', '2023-05-18 10:16:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(821, 'ki@gmail.com', '$2y$10$cL/LYm2Vffsa3LYQ36K2ROOflsL8yqAuLnRkwPZ6aIRNJJWqBd1sS', NULL, '6465fb8140d8e', NULL, '1', '0', '3', 'en', '0', '1', 'online', ' ', '0', '2023-05-18 10:18:41', '2023-05-18 10:18:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(822, 'mi@gmail.com', '$2y$10$pAIVAk7RmfM/NPHjYxkMfupRbZyht8lQEVCylQpUSA1BYwbGX6SK2', NULL, '64660ddb99837', NULL, '1', '0', '3', 'en', '0', '1', 'online', ' ', '0', '2023-05-18 11:36:59', '2023-05-18 11:36:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(823, 'user@gmail.com', '$2y$10$MptcaRKE6Yc1yaQknroVfOQyNtynb4sXhcEQijUCFPia9rx657Z0u', NULL, '646610259dee8', NULL, '1', '0', '3', 'en', '0', '1', 'online', ' ', '0', '2023-05-18 11:46:45', '2023-05-18 11:46:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(824, 'q@gmail.com', '$2y$10$hBO8o9BCMgzWJ3TYQx9NCOWEcG3JXZi/Qj0QsHyxdjtM4lkHwsNxK', NULL, '6466111e539a5', NULL, '1', '0', '3', 'en', '0', '1', 'online', ' ', '0', '2023-05-18 11:50:54', '2023-05-18 11:50:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(825, 'user3@gmail.com', '$2y$10$rDIX4SEx3nXAv537PrSKM.FBkmbFQfsgKMRXH9xR9KwMfOcIw9Nm6', NULL, '6466140ef0f8a', '$2y$10$v5hPi9fmsvmF45rQzaDYseWSJTmpt.OaeER6nsNmtfrWc.QiRPzAu', '1', '0', '3', 'en', '1', '1', 'online', ' ', '0', '2023-05-18 12:03:27', '2023-05-18 13:02:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(826, 'user4@gmail.com', '$2y$10$FOd4gBkEUrbIElgQ7YA8uux0HzULPJJLhbwxAQeu6vjZ9jR.5.0Fe', NULL, '646614cb8c6b5', NULL, '1', '0', '3', 'en', '0', '1', 'online', ' ', '0', '2023-05-18 12:06:35', '2023-05-18 12:06:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(827, 'new1@gmail.com', '$2y$10$R0yYoxnG393Ua9Z8PAKEauTKFatk5lZEiqztZAnbgKyAFfg15hx0.', NULL, '64671a2ba0457', NULL, '4', '0', '3', 'en', '0', '1', 'online', ' ', '0', '2023-05-19 06:41:47', '2023-05-19 06:41:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(828, '89ashi@gmail.com', '$2y$10$Ft5C0j6I1PX97dgvO9MZVO17S0QGHOBLdlDkShnjcegoxZUTx4pQK', 'ZNFMhn9euFFR3dyHD0T3jUhtAf8C45hXVncnJZWgWGDt3mltntenKF65bHkb', '', NULL, '3', '0', '3', 'en', '1', '2', 'Offline', '2023-06-03 11:24:42', '0', '2023-06-02 17:31:04', '2023-06-03 11:24:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(829, 'buyertestingid1@yopmail.com', '$2y$10$JXzvNGNLGd6b2gamKGNUI.0tqDBqysyt.9eEFmVlYy6Q./PngoLKK', NULL, '', NULL, '2', '0', '3', 'en', '1', '2', 'Online', '2023-06-03 11:12:50', '0', '2023-06-03 08:42:49', '2023-06-03 11:12:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(830, 'agenttesting92a@yopmail.com', '$2y$10$qJV7pTpimm8FDfzXdS/DRemEoR7rtixq7WfZQqF/7VaPAhI/drlkG', NULL, '', NULL, '4', '0', '3', 'en', '1', '2', 'Online', '2023-06-03 11:38:05', '0', '2023-06-03 08:54:24', '2023-06-03 11:38:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(831, 'seller123@gmail.com', '$2y$10$gTmXTMxCpHRAMfRT5lNS.OcEt.f/8VRVS05RYoxugbzbHb4cHK0f2', 'ypitzVRxrhPlvVpZy13ijRn8zvRZ9wXPOvRMaHJOW6RsPWiefCZ6jl0UcfCY', '64817652c38cb', NULL, '3', '0', '3', 'en', '1', '1', 'Online', '2023-06-08 13:12:03', '0', '2023-06-08 06:33:54', '2023-06-08 13:12:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(832, 'hagent123@gmail.com', '$2y$10$GHyQ2hCp6hWgyFcIB0dMpO1DGKslthfDdjwnw6F93LTsptp.2mSUm', 'z2vGCZxPINRJFUFcpRLO8A9h97Smq495eMEQN2n4WjpS3S51ahYjtwa8t3Xy', '64abccde46f95', NULL, '4', '0', '1', 'en', '1', '1', 'Online', '2024-05-16 09:17:36', '0', '2023-07-10 09:18:22', '2024-05-16 09:17:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(833, 'demo1@gmail.com', '$2y$10$TOnK9mmwe2v1WIOhvIuJyu7zKdn7na36UrDClx/wQOSI4ydPWzLwG', NULL, '64af99df1c09d', NULL, '3', '0', '1', 'en', '0', '1', 'online', '$2y$10$iobo8gDWGXIJAR9vkEMaUu91yJS37PC88TTiBCGFPw2OLS5X03Sge', '1', '2023-07-13 06:29:51', '2023-07-13 06:29:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(834, 'demo2@gmail.com', '$2y$10$vb6fDn/D3eHIu.EJe0jgpeogIeVB1oTuxyPRyqwwRAYD6LhdHeAiO', NULL, '64afad3321d2f', NULL, '4', '0', '3', 'en', '1', '1', 'Offline', '2023-07-19 10:51:31', '0', '2023-07-13 07:52:19', '2023-07-19 10:51:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(835, 'demo12@gmail.com', '$2y$10$DjUlMydG1VaEeV2.mX9YbuoNnXU9tHEnWpxVorvtROB30MVqgVfNq', '1J1TZZEWt5pnfaEUSkyAeMPvTxs0QkW1SfUUpEj61ta74j031QW7AVKp85Gc', '64b0f0196272e', NULL, '3', '0', '3', 'en', '1', '2', 'Online', '2023-08-17 20:11:56', '0', '2023-07-14 06:50:01', '2023-08-17 20:11:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(836, 'demo13@gmail.com', '$2y$10$z.a9eSsxPAerNc/BoNFI9uvCC7KdS6alm30Q0z2o0Cld8ARFHKEre', NULL, '64b4e1d9ac35c', NULL, '3', '0', '3', 'en', '0', '1', 'online', ' ', '0', '2023-07-17 06:38:17', '2023-07-17 06:38:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(837, 'demo14@gmail.com', '$2y$10$B9Vf4PiMsotThhvC3uYY4OIw4.vP6HH5be3L9JB6JRmnoD.U7guZe', NULL, '64b4e8572d6df', NULL, '2', '0', '1', 'en', '0', '1', 'online', '$2y$10$qR1UhIyX9GWkwvaT97bzguvTg7sSHeow/KxOPv3RHMreE/D4W/Epu', '0', '2023-07-17 07:05:59', '2023-07-17 07:05:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(838, 'wertewr@gmail.com', '$2y$10$p1AhIs0DAc.WOSCZbk.X4usS6y4MejDdlE7ovg74MOit4jQ/cdZBG', NULL, '64b4ea47be1e3', NULL, '3', '0', '1', 'en', '0', '1', 'online', '$2y$10$Gi55MhRPCG9geq2ahfJhaesHy/IXuo2evLgu/bkIUrgxVr3ieXtgy', '0', '2023-07-17 07:14:15', '2023-07-17 07:14:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(839, 'demoseller_rs@gmail.com', '$2y$10$1vEaXgqL7CZotuZH5FzuOup34bHmf6.Nr1AqDGHFocwsB6q5NZWB2', '1TM8bqJsWmSocSbbmzBl0ZxcmegLhNVCK0DW2d7GlH2Yrg8IFhGwK36ALaAj', '64b4f325e6a85', '', '3', '0', '1', 'en', '1', '2', 'Online', '2023-08-21 06:02:01', '0', '2023-07-17 07:52:06', '2023-08-21 06:02:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(840, 'raj121seller@yopmail.com', '$2y$10$xC4m8hoR7ZD52WSEserfVuXUmj9qhL8KKRpa30EkwP3xrFg28k2a2', 'qqEFRkNrGFxhGSreMBSlfPKYOIVYIbRC5ztBqPTF8Se02kVQQ6hPm5thl83K', '', NULL, '3', '0', '3', 'en', '1', '2', 'Offline', '2023-08-19 05:15:05', '0', '2023-07-31 07:08:56', '2023-08-19 05:15:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(841, 'raj121buyer@yopmail.com', '$2y$10$2Lpr1tOK42i/gNn1m4Huv.mK/Orx8sNtR6cK7MekbS6vamuuqiFEW', '8HnTakFNMLltVtIpnBjq2YdT0H4gI3Oc41DghOtAnHkuCbP6zylbvM5NbNrt', '', NULL, '2', '0', '3', 'en', '1', '2', 'Offline', '2023-08-09 11:28:40', '0', '2023-08-01 10:55:09', '2023-08-09 11:28:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(842, 'raj121agent@yopmail.com', '$2y$10$ZmPRUZtx0DN4iekywnaW7.MReK4s/O8qdvlDMikbmMy6kVLjFwQGm', NULL, '', NULL, '4', '0', '3', 'en', '1', '2', 'Online', '2023-08-02 13:37:28', '0', '2023-08-01 11:03:05', '2023-08-02 13:37:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(843, 'raj121agent1@yopmail.com', '$2y$10$0h.GaFlhCbwWkNMBu4zMDuMeoNQ7MsvUjrLxRYZBZbaYofeoNF3P2', 'tALHMVEYRWZwNhmXgy3sSRYb7WRut6yOfMzgA6730qy0CAsoBGyTKIqKptb1', '', '$2y$10$TJfBF7WjXPTKq.QTB7L2uMB96U626NmxtD64sjZdbPqxxsteLzS', '4', '0', '3', 'en', '1', '2', 'Online', '2023-08-19 09:25:05', '0', '2023-08-01 11:06:19', '2023-08-19 09:25:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(844, 'raj121agent2@yopmail.com', '$2y$10$T0HAZPPqHO6uBLE9xo0RreMqSTeWaaSYwTORome0YyANn0s1swwVS', NULL, '', NULL, '4', '0', '3', 'en', '1', '1', 'Offline', '2023-08-01 12:10:16', '0', '2023-08-01 12:08:42', '2023-08-01 12:10:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(845, 'raj121agent11@yopmail.com', '$2y$10$fPvfNwuHOqR59lSIaAHOa.LwwxX9.OA7VyK7UfDW1Mg4cHizrT19m', NULL, '', NULL, '4', '0', '3', 'en', '1', '2', 'Online', '2023-08-09 14:05:39', '0', '2023-08-09 04:20:24', '2023-08-09 14:05:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(846, 'raj121seller11@yopmail.com', '$2y$10$0CPDoMTj3IOT1bXhZlxIiuSM3edqCcksb9jvRBcDlB0Y5eKeDhJcy', NULL, '', NULL, '3', '0', '3', 'en', '1', '2', 'Offline', '2023-08-09 11:24:15', '0', '2023-08-09 10:38:35', '2023-08-09 11:24:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(847, 'test121@yopmail.com', '$2y$10$XrD/epoCDc6DNzZUDy7X3eXpHNzIZdMGq6JGqW/PxxfS41WVQkU.G', NULL, '', '$2y$10$erf1Ga9uDL4FHPxvkIIuu1gvAF1eDUlk46hBS5HCq.quA5dX1Ca', '4', '0', '3', 'en', '1', '2', 'Offline', '2023-08-17 10:06:36', '0', '2023-08-17 10:01:39', '2023-08-17 10:07:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(848, 'demobuyer_rs@gmail.com', '$2y$10$Js197t0uPnJFWJcA85Qo1.gWu0AR9mzLP4nsoeOUSeZxBmJugKAT6', NULL, '64df1ade6be13', NULL, '2', '0', '3', 'en', '1', '1', 'Offline', '2023-08-18 07:19:19', '0', '2023-08-18 07:16:46', '2023-08-18 07:19:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(849, 'demoagent_rs@gmail.com', '$2y$10$8q5Ol.fo2EFWzVNzkrm3uO37mNcj1BQvIHt1m8IfQfqb2xC5yhyh2', NULL, '64df1ba3162d0', NULL, '4', '0', '3', 'en', '1', '1', 'Offline', '2023-08-18 11:42:19', '0', '2023-08-18 07:20:03', '2023-08-18 11:42:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(850, 'srinivas.ma03@gmail.com', '$2y$10$F6cBE6TBnmKgpgaDDR5D9u5Af88N6VAZZdaq2bBhgfho6b90QYTai', NULL, '64ef37f52ed08', NULL, '4', '0', '1', 'en', '0', '1', 'online', '$2y$10$Nl2WrDyguBHMXdJS9DxZSe1cDXU.Fa0.4f.U7rMeEa5zsuqLpBtxe', '0', '2023-08-30 12:37:09', '2023-08-30 12:37:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(851, 'alt.d4-90v23zs@yopmail.com', '$2y$10$Ei4ZgqFyi5Ug0NHFI6gW6eEvbNelJfxrWbKOQ/7rDWygdg0nvVdgu', NULL, '65034ef75c824', NULL, '2', '0', '3', 'en', '1', '1', 'Online', '2023-09-14 19:37:03', '0', '2023-09-14 18:20:39', '2023-09-14 19:37:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(852, 'jinal@yopmail.com', '$2y$10$Ag.E.BLXdwzrjJsnACml8eJ.j6/kEumrrjPxdooFOki1YJZKHcPha', '3mkT2N0ITWRm1gpAQlsYGHgRCUHhH3s392gJPu9satoWGOStsXbbl8lXIjiC', '', NULL, '4', '0', '3', 'en', '1', '2', 'Online', '2023-09-14 19:36:49', '0', '2023-09-14 18:52:40', '2023-09-14 19:36:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(853, 'sarah.johnson421@outlook.com', '$2y$10$rfLARWtZcd1rBqmH4KYib.VauEPJz6zVCc/h.UOXWNfLQkQBvlDkK', NULL, '', '', '4', '0', '1', 'en', '1', '2', 'Offline', '2023-09-30 15:15:50', '0', '2023-09-18 05:08:36', '2023-09-30 15:15:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(854, 'adotsdotvignesh@gmail.com', '$2y$10$qqwJMWRLBmNRwKGl2ziuk.Y/kMSiGWKcnHyLVzba6CtdN.cNGTdJW', NULL, '654def05dde36', NULL, '2', '0', '1', 'en', '0', '1', 'online', '$2y$10$I9DSYT2mIsgg8IeWzNOVluW2kybl9h7kvLbMJEMlMYxopesg2tgZO', '0', '2023-11-10 08:51:18', '2023-11-10 08:51:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(855, '373.2designer@gmail.com', '$2y$10$pM/KhzRZdqFJE.u00jL0uuF1toYmYL9T/M9bA9FRiKyr4eAL7gH0e', 'RnKDQfhvrxDul2jfNThFI2RpsthBItNtmuVRjw02ONRWyFSb7Y4VpxC9dUyT', '', NULL, '2', '0', '3', 'en', '1', '2', 'Online', '2023-11-16 09:57:38', '0', '2023-11-10 08:52:54', '2023-11-16 09:57:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(856, 'anu@yopmail.com', '$2y$10$HouKk24uhw5Qdf7K5QREnulRILDC./TP5PD7P0q6Z7OXIDgyVAL4a', NULL, '65687665959bd', NULL, '2', '0', '1', 'en', '0', '1', 'online', '$2y$10$ATUvQk6GZ3bSI5L..FWAF.ORoIHpn2O1TP5Kq5jbX7K3/D8jAo1ji', '0', '2023-11-30 11:47:49', '2023-11-30 11:47:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(857, 'anuu@yopmail.com', '$2y$10$6NjJ4B6aItWJQSBSlhmmPOaGMsF64HAxgvMqjpocDoMAyikdmoeDu', NULL, '656ad386e04e6', NULL, '2', '0', '1', 'en', '0', '1', 'online', '$2y$10$Frn1nioi2thzZYCAB68sw.xLLxlUgL4LNbA3iW1rJ51BeoIQdePsC', '0', '2023-12-02 06:49:43', '2023-12-02 06:49:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(858, 'anu1@yopmail.com', '$2y$10$mNb9WVJMVXClf99xwj8Yt.KfPuildr7IFcZp0G4H4I17tP6uMgsVy', NULL, '656ad4cb4faec', NULL, '2', '0', '1', 'en', '0', '1', 'online', '$2y$10$nJu38RUOqRbO1hSVTt.1OuobrQ6u9KaDvLAmHsgeYArvZAgCjOXZu', '0', '2023-12-02 06:55:07', '2023-12-02 06:55:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(859, 'Abi@yopmail.com', '$2y$10$q0W5md44bEiJc6.F68issuNaJCDAbM4FPYM6QicyJTTWGEvQZTMSK', 'w2Rb3g56AnosJWH2kG6hYUjmAT34LWhZ6MfQJoeu2DkkWPWoLsjRvP1xv7Nh', '', NULL, '2', '0', '3', 'en', '1', '2', 'Offline', '2024-02-15 12:21:19', '0', '2023-12-02 08:14:44', '2024-02-15 12:21:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(860, 'Aji@yopmail.com', '$2y$10$4ze5kUrorHkNsLIDNWNzleManuSi7Ct0YyCZiYevxWmgKL.M1Fq6i', 'k2mtHbQu4XXWh44bjyDsSaRru6AGkdrCpAym0Jnx5TniHxwZCGZNRiSM8f0p', '', NULL, '4', '0', '3', 'en', '1', '2', 'Offline', '2024-02-16 14:13:13', '0', '2023-12-02 08:38:10', '2024-02-16 14:13:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(861, 'Sri@yopmail.com', '$2y$10$apeVIUnJi6fbeQVo55TGLutw22onoLOCSte1nu3u7bc0Zd3.teWie', 'zUvAZflkeE8cTpnin9tejKA16P28j3FkEZRPhETpGX5ScGXlVEHrAiTTnnLM', '', NULL, '3', '0', '3', 'en', '1', '2', 'Online', '2024-03-06 04:31:44', '0', '2023-12-07 09:32:59', '2024-03-06 04:31:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(862, 'ghgh@ffg.gg', '$2y$10$IUuURZhL0i1RQ818IbsSvuyMjOLH4R/iw/ZgQ6ym08Ad4n3v1RBNC', NULL, '6597e3b52d441', NULL, '2', '0', '3', 'en', '0', '1', 'online', '$2y$10$tWJiWDS/XfP8VcF.P40lkexpF3jY3pT5FkTu1fe96w29SGiVvszLK', '0', '2024-01-05 11:10:45', '2024-01-05 11:11:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(863, 'narayan.udit4u@gmail.com', '$2y$10$Mp45R08I4o2Rc9Y2M54Q8OWZajAYdmewXOo2aZ.h7rejzuBw558Km', NULL, '', NULL, '3', '0', '3', 'en', '1', '2', 'Online', '2024-01-09 10:20:13', '0', '2024-01-09 09:54:44', '2024-01-09 11:44:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(864, 'narayanudit04@gmail.com', '$2y$10$JkoSCdS9r1h8pC/iVdUNZObAYbeETMN//OmmFmHRsqnlZzROoQuJm', NULL, '', NULL, '2', '0', '3', 'en', '1', '2', 'Online', '2024-01-09 10:28:23', '0', '2024-01-09 10:20:36', '2024-01-09 12:51:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(865, 'imsmpth@gmail.com', '$2y$10$k3806O189shdokMZdEXzlewoakSKxNz8jzSQGhNXVgkC/LPt/YNfC', NULL, '', NULL, '4', '0', '3', 'en', '1', '2', 'Online', '2024-01-09 10:46:42', '0', '2024-01-09 10:28:49', '2024-01-09 13:31:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(866, 'savan101294@gmail.com', '$2y$10$ffrWdLKAFxXfWEqhuTqFwOUqquF3k6ZDQswyZ5.tGZf24l/MEsqgm', NULL, '', NULL, '1', '1', '1', 'en', '1', '2', 'Online', '$2y$10$IaX730sTjJDsdMLg4UQH3e.M.uqW/INu/qlESMcE5RrPpgHz5ZnCi', '0', '2024-01-19 04:44:00', '2024-03-12 16:06:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(867, 'sdfsf@dfsd.com', '$2y$10$3VqeiUABVbjsv5hGgFi00OEzMfTHSI3ioVbOil/akIfDa.5WsTh.y', NULL, '65ae77db26aad', NULL, '4', '0', '3', 'en', '0', '1', 'online', '$2y$10$3TeOiCvxUJEvZMrUze/BVOTU1GTllwE/QJrB4mVxrk5c0hBDnJM4G', '0', '2024-01-22 14:12:43', '2024-01-22 14:13:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(868, 'swapneel@gmail.com', '$2y$10$QhwvthSByqQsQrzt3QmN.OcDWpuvx6Nizgp4YWm4c3M5Y1G1eWSGK', NULL, '65b09f9020fbd', NULL, '3', '0', '3', 'en', '0', '1', 'online', '$2y$10$6a8PNriRDpU.feebgB1smO/W8u48VgocI8Z/NBt7s7Jyw8AXESbqS', '0', '2024-01-24 05:26:40', '2024-01-24 05:27:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(869, 'hemant@gmail.com', '$2y$10$9DRIvKqBmTGNGOVQVjAdVuVBY0PO2dG45ouUc9DXCTC0Wc75/unO6', NULL, '65b3992510cef', NULL, '4', '0', '1', 'en', '0', '1', 'online', '$2y$10$6PWXTx6xYA5p0ubRF1kOAe1OQJZh0BFJcbAQAiBs/XobQTaTkPYku', '0', '2024-01-26 11:36:05', '2024-01-26 11:36:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(870, 'ankit@gmail.com', '$2y$10$Ou8iYK1XFR2bud9ElLvj6.YLJsRvImQVT0zz3sh.NJzRq0PrCAmJS', NULL, '65b39be3e3f80', NULL, '1', '0', '2', 'en', '0', '1', 'online', '$2y$10$2VkoDfpBcL01YD1qHnZHhOHhwDklevjHxhNBj5c/KIPMfHabYKxO.', '0', '2024-01-26 11:47:48', '2024-01-26 11:51:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(871, 'hemantprajapat8844@gmail.com', '$2y$10$mN5OVAlH.NRpAMEkTKUyjOLXzGBo/LhvDjv.7H7ruohvh1UEXdBu2', NULL, '65b39dcd19e8f', NULL, '1', '0', '2', 'en', '0', '1', 'online', '$2y$10$wWuur9DpE97lXJneQKhgxOlTS1DCSWXwaHVu8uaOTe7JgVTf.vHzS', '0', '2024-01-26 11:55:57', '2024-01-26 11:56:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(872, 'fari@gmail.com', '$2y$10$ihvzPb9KyAhwrpGTSJLofeIm5NsL/jmhgmk43ugXU5yNVn6/9l5QW', NULL, '65b3bd1413327', NULL, '1', '0', '1', 'en', '0', '2', 'online', '$2y$10$2.MTkF8cDY.18clMWb7.aOXy.b8Lcj1UtCbTl/B2.XTEpfZJAJAY.', '0', '2024-01-26 14:09:24', '2024-01-26 17:07:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(873, 'avi121@yopmail.com', '$2y$10$CqPFNU0urcdlHthB7r.iJOvqUMeFCv.F0q23fH457wicIwDwIUlx6', 'wMbOdap4yd8w5vQWBGMJktOy3JntzWSAm70HmcelCyWoplCDFmSFnYo9q1kc', '', NULL, '3', '0', '3', 'en', '1', '2', 'Offline', '2024-02-06 09:26:04', '0', '2024-02-04 11:37:56', '2024-02-06 09:26:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(874, 'sellerz1001@gmail.com', '$2y$10$mLf1zEjMeTfXHD4rIFNE8u0OMN4lmjJ7zIIPMszmdQSfXJ0uxntWW', NULL, '65c07b1474f00', NULL, '3', '0', '3', 'en', '0', '1', 'online', '$2y$10$iYnm2tfZnbpqjVy/JhnaquUyFAfX0XwbWEUcp5OK.zF21t0VsExQe', '0', '2024-02-05 06:07:16', '2024-02-05 06:10:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(875, 'zainrehan73@gmail.com', '$2y$10$zOYZAq5nfTCovR0OVCbTE.eBaOm2k0F4GZYZx4zs6iafxpyVstWo6', NULL, '65c07de673e9f', NULL, '3', '0', '1', 'en', '0', '1', 'online', '$2y$10$EKYOmsi69.IDOfwhAvPveeGTM.ysWSy5JZqnFBHZJ7nci1Ap5UXNi', '0', '2024-02-05 06:19:18', '2024-02-05 06:19:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(876, 'animerehan7@gmail.com', '$2y$10$Qc36lc.Nfa/jwM8Svbh0JOjLTF19wLPfvx5pqR84Ky.h/8E0ImKca', '69qwDwiOQCCIl7DBfU4E77yp6KR9D18JyTxJToAoBdaTIlBaF6Wy1nkptVp5', '', NULL, '3', '0', '3', 'en', '1', '1', 'Online', '2024-02-08 19:00:10', '0', '2024-02-05 06:20:34', '2024-02-08 19:00:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(877, 'avi122@yopmail.com', '$2y$10$fwIKt0.6UEfmbI4mYEOAeOpWvJB7nXkbPTat9y7Wjllffs/uozf.u', NULL, '', NULL, '2', '0', '3', 'en', '1', '2', 'Offline', '2024-02-06 13:02:51', '0', '2024-02-06 09:28:20', '2024-02-06 13:02:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(878, 'avi123@yopmail.com', '$2y$10$gajHP1JrzacsSWOmiWRjhOSZdY5U2MTmLolfwxtYrG7vyRvOeqgM6', NULL, '', NULL, '4', '0', '3', 'en', '1', '2', 'Online', '2024-02-07 10:29:49', '0', '2024-02-06 13:03:26', '2024-02-07 10:29:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(879, 'buyer@yopmail.com', '$2y$10$I1mugfuHfB6pJiTV.vbSb.bMRqZpDN5NZ0Y.tJiVUbMoVJnIplul6', 'qKxXE0I0CZm0izXV5IA4COwfoYKF79kcSx9fysCakQRnRKuBcOSGIXJxpLAa', '', NULL, '4', '0', '3', 'en', '1', '1', 'Offline', '2024-03-06 15:36:08', '0', '2024-02-06 16:19:27', '2024-03-06 15:36:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(880, 'lolukeinulo-9611@yopmail.com', '$2y$10$RfZL8Q27fnXMMQ5HGiIsZeWTpkS9SwBv50kjhzEVQnN6LQQFMby/S', 'h4qZQCGKpDVbROIajp5HOlxYUrDhcZijh3VTDfV2nLvbGFXC839m3px7oz8o', '', NULL, '2', '0', '3', 'en', '1', '1', 'Online', '2024-02-07 03:44:12', '0', '2024-02-07 03:35:31', '2024-02-07 03:44:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(881, 'ishbizgroup@gmail.com', '$2y$10$kPeIcpI/mVEsJ6FnAOTJ6ePFeNkCBnk/4z0xxCJ1uoZUTy0Ud06BO', NULL, '', NULL, '4', '0', '3', 'en', '1', '1', 'Offline', '2024-02-08 13:00:28', '0', '2024-02-08 09:13:01', '2024-02-08 13:00:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(882, 'selld@yopmail.com', '$2y$10$hAbMmBAS9Qznfs5QXUG09eGF94eUeQt8DBhfIjlsq5Sq6lHd9q0zu', 'lhxjubc5uoM1IpT339RcUlAZH9mqSpbfbtQQyBTL6sxlbHPh3PUBjos0gcDG', '', NULL, '3', '0', '3', 'en', '1', '1', 'Online', '2024-02-14 00:07:42', '0', '2024-02-13 17:53:04', '2024-02-14 00:07:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(883, 'buyerd@yopmail.com', '$2y$10$F7JnxtrCvB9wau9zpq6BOeFf0384Z.sQySGHM16t.scAizq6w2.C6', 'ZHaPKQGc1HcR3gL3v4ee4yJH0G1jb7sJ4qYxBfR45zJIdXqmW8E9YPmubEhH', '', NULL, '2', '0', '3', 'en', '1', '2', 'Online', '2024-03-12 19:28:50', '0', '2024-02-13 22:27:41', '2024-03-12 19:28:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(884, 'raj121@yopmail.com', '$2y$10$vNbXqnhgS6jBXypMDRN3ROsew6LviGpXZDj/WXcNSYdU4HG5K1GQm', 'Gk5Rc5cHxRTD03BSduul8kk3CEy89GVrtii6inCXJ8GHXIpzBu8Lya9e0ApJ', '', NULL, '2', '0', '3', 'en', '1', '2', 'Offline', '2024-04-10 19:30:19', '0', '2024-02-20 05:35:08', '2024-04-10 19:30:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(885, 'raj122@yopmail.com', '$2y$10$p5U.kg0oS5UBHcSed1aQ1OKCdaSLMywcVU5FmYhWVv2wWQyLeA7am', NULL, '', NULL, '2', '0', '3', 'en', '1', '1', 'Offline', '2024-02-26 05:51:03', '0', '2024-02-20 05:37:29', '2024-02-26 05:51:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(886, 'raj123@yopmail.com', '$2y$10$UFXdj5i2E4xbLxD/oeJjcumUfXSVcWUHOSHInVO7bl9oHMS9itO7O', NULL, '', NULL, '4', '0', '3', 'en', '1', '1', 'Online', '2024-03-14 09:35:18', '0', '2024-02-20 05:39:26', '2024-03-14 09:35:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(887, 'soumyajitmondal2004@gmail.com', '$2y$10$/epGzcUwz9dvnxOBGWDW0Ocem.5aE7962a5nvEcIQAOYO3XTZckNC', NULL, '65d7f532443a8', NULL, '3', '0', '1', 'en', '0', '1', 'online', '$2y$10$G38PEjTa5KK0W/D7OHtH7uQidzIt8WO8pt8zchC0WIi30zfLeSQS2', '0', '2024-02-23 01:30:26', '2024-02-23 01:30:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(888, 'rincy90115@gmail.com', '$2y$10$P/Aj.wd/EPfrFTgZhivs3eXhpy6eNZfnqFUfWI/TDuZb/Z6dNZKta', NULL, '', NULL, '3', '0', '1', 'en', '1', '1', 'online', '$2y$10$h9VDgRJxnDP3Jrjpw1ULq.a97506at4Jvz7K4IPvKDRKs7h9.hrwC', '0', '2024-03-03 08:41:46', '2024-03-03 17:42:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(889, 'vikrant.slg@gmail.com', '$2y$10$l0FyyjDqaS5waoI2Y3AzruJbDmwpqSNupb2jnkI9Rp5WSvLmiVuf2', 'hxdkNMHSRCdVAlNKyGk041P97pGI6kGhAXkfTE06TYVW0TWjAeN1jZBuqgfS', '65ec140355495', NULL, '3', '0', '3', 'en', '1', '1', 'Offline', '2024-03-20 13:21:26', '0', '2024-03-09 07:47:15', '2024-03-20 13:21:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(890, 'vikrantt.slg@gmail.com', '$2y$10$s0Ohktl0dywj8oArf0iUpeeHDlFo1N/7HSr5LdQ.HA0X5WGCPb.Hu', 'hgHoerAnU5fyCvOPek9btNsChwuUb5rhqNaekrZbRRh4IAm3R30CNyIt6GAk', '65ec187040952', NULL, '3', '0', '3', 'en', '1', '1', 'Offline', '2024-03-11 19:03:56', '0', '2024-03-09 08:06:08', '2024-03-11 19:03:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(891, 'vikranttt.slg@gmail.com', '$2y$10$uoUHnTc6C5RkT0U.Kd6jt.LFQ7JJH5Fq3EobaZhlczS32EobJKppC', 'e7K0jLuiEPAkIRSVZvTxbgW6eYuDJTy5RTv96DfiXMPd9ihazZySaSm5wCnf', '65ec19046bfee', NULL, '4', '0', '3', 'en', '1', '1', 'Offline', '2024-03-11 19:07:07', '0', '2024-03-09 08:08:36', '2024-03-11 19:07:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(892, 'buyer1@yopmail.com', '$2y$10$k8rhuBEcN/fLVfCc730ZHeKDitDSf0IxxsLr01KyQn2/JX.2tG3hq', NULL, '65fd2f11d27dc', NULL, '3', '0', '3', 'en', '0', '1', 'online', '$2y$10$.lJXg5pEPlNzrZh5W5u.f.VbLhKRiRbqcyjpCleLlALX0UkfjvZOK', '0', '2024-03-22 07:11:13', '2024-03-22 07:12:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `agents_users` (`id`, `email`, `password`, `remember_token`, `activation_link`, `forgot_token`, `agents_users_role_id`, `agent_status`, `step`, `language`, `status`, `first_login`, `login_status`, `api_token`, `is_deleted`, `created_at`, `updated_at`, `card_number`, `name_on_card`, `cvc`, `card_expiry_year`, `customer_id`, `card_expiry_month`, `package`, `fcm_token`, `device_type`) VALUES
(893, 'sankar@yopmail.com', '$2y$10$1Dw2okyggeQdl2TZvxff1OGgCmHyub/nZQfaoBlWv388/w8LIEkJW', NULL, '65fe82d46fa8c', NULL, '2', '0', '1', 'en', '1', '1', 'online', '$2y$10$3.1XOmrEWyb/ggs.CGDlP.nC/6eHs34jK5BplZ7XWR9FAmV62Tur2', '0', '2024-03-23 07:20:52', '2024-03-23 07:20:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(894, 'sankarde@yopmail.com', '$2y$10$HOllcykuBYuK5xNnmvKse.3WKwJdW.RsDGP5R6fMDXfn3fuDXQriS', NULL, '65fe839067fb3', NULL, '2', '0', '3', 'en', '1', '1', 'online', '$2y$10$gLB6IQ/JE1K2UkOMTQ1uPOFmzznayGqxXTWrBYRwxSsvMH49f70aa', '0', '2024-03-23 07:24:00', '2024-03-23 07:25:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(895, 'sankarde2007@yopmail.com', '$2y$10$2LeC9DKg7n1gZ0zMr5ZlKOwcoQ8ZrIvZXfCzTSTxeSKlPWJ2jQU9S', '0NhwaMbbkm2z1f15x6B09vJKHBoMZHfksAbFjMdF5pryo50eue1Q30eftvPX', '65fe84b206aea', NULL, '3', '0', '3', 'en', '1', '2', 'Online', '2024-03-26 08:32:50', '0', '2024-03-23 07:28:50', '2024-03-26 08:32:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(896, 'vshah.focus@gmail.com', '$2y$10$UcTy0BpGGk.0CWD8L.MdeOfYPyI80i842jc0vbtL0NP3kpbK8Tuny', NULL, '', NULL, '2', '0', '3', 'en', '1', '2', 'Online', '2024-03-24 07:10:06', '0', '2024-03-23 21:41:30', '2024-03-24 07:10:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(897, 'satish.mendapara@tech4biz.io', '$2y$10$iifepfOhaSbwq2gWNPgE3.O2JSWu2wO40Vf9FHcvLU1uxQyRzJwGu', NULL, '', NULL, '3', '0', '3', 'en', '1', '1', 'Online', '2024-03-26 14:37:17', '0', '2024-03-26 14:14:34', '2024-03-26 14:37:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(898, 'agentzero@yopmail.com', '$2y$10$obbvG1Xnhc8I6byX.lx3EOdY4gbo3y2DG5R4zqMg/q59ffi/AfLTu', '9HY0MbF0Foekj3mDey4PJbY5B8dSnuDfvUwlAK66YgH94j5LzQf9wd9U96T1', '', NULL, '4', '0', '3', 'en', '1', '2', 'Online', '2024-04-29 13:44:03', '0', '2024-03-27 17:01:05', '2024-04-29 13:44:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(899, 'agent47@yopmail.com', '$2y$10$OMM/GpvGiN7JDyhiBdU0veIe8zqypvBZtUS32NRDsVWHPL.Wj0QoC', 'xetJsgVsGAWS1HzXE6cUDM39C87l620V1OLw5b84OaOTLhIS7Z7krcJd7wr7', '', NULL, '4', '0', '1', 'en', '1', '1', 'Online', '2024-03-28 16:24:24', '0', '2024-03-28 14:37:53', '2024-03-28 16:24:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(900, 'test12@gmail.com', '$2y$10$r9v6inJSEUgtqbZk7msYsOPiRP.MKEudGQ9UNgKAKM2O6sxWWurum', NULL, '6612d8dacd29d', NULL, '4', '0', '3', 'en', '0', '1', 'online', '$2y$10$vSRO7JCpSgEqBBoPTGmst.MNXAyhCJzfjV9YaNA9PaseiTcowpetG', '0', '2024-04-07 17:33:14', '2024-04-07 17:34:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(901, 'kicokay527@agromgt.com', '$2y$10$hZ41HeVHZIhkMg/0rdD57u99jBl/uxTxuc0rNw6iChH.uTgF6Wfx6', '5EyJfp2wM8azAkAdKuStiFTrWgwajJa6pCdLmhB4lk6Hq84agcz7NaocdNyi', '', NULL, '3', '0', '3', 'en', '1', '2', 'Offline', '2024-04-09 06:24:59', '0', '2024-04-09 06:21:54', '2024-04-09 06:24:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(902, 'arup2ganesh@gmail.com', '$2y$10$wBeCeqQ/6xVseh58JkMqwu9zu73K8KMEVHzu1hZmQU525iZxJgtiC', NULL, '6628af24155e1', NULL, '2', '0', '3', 'en', '0', '1', 'online', '$2y$10$Ib7.8OUU2B7uYJTFI9xbIOCVz.BwtIYdnUcFMo.kr1Iap6AH0Xi8a', '0', '2024-04-24 07:05:08', '2024-04-24 07:06:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(903, 'bamoji1406@funvane.com', '$2y$10$mNW8WuRHqqYJ6gR0H2na3OpCeoY/LNdP4AyjSw7ykDjhinKrSyFdy', '9SJlpfHa3SkU2O6qYHy4c5ZZiO0QltVBlsoGiexY8JW0ZybTqHgs5N86QEYb', '', NULL, '3', '0', '3', 'en', '1', '2', 'Online', '2024-04-24 14:11:01', '0', '2024-04-24 14:07:02', '2024-04-24 14:11:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(904, 'projjwalsen@gmail.com', '$2y$10$BiMeVwAL9Ti/f97DFYaPpOcC./D2j.fe4BWs3DcldVtODWuf4Xd32', NULL, '', NULL, '2', '0', '3', 'en', '1', '2', 'Online', '2024-05-06 19:29:42', '0', '2024-05-04 07:44:47', '2024-05-06 19:29:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(905, 'lipivov193@rehezb.com', '$2y$10$hb8/ASR.Amy3GZbEKRIZJuRh3w031ZQpn.QxttKtDbicABxMRs5bS', NULL, '', NULL, '4', '0', '3', 'en', '1', '2', 'Online', '2024-05-06 19:29:42', '0', '2024-05-04 07:47:28', '2024-05-06 19:29:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(906, 'coconik990@shanreto.com', '$2y$10$8Nh8Ck3HNrNElvrAHuD99OKVg2GINjy6XD7SYBKZZoIGhPWtan5Ae', NULL, '', NULL, '3', '0', '3', 'en', '1', '2', 'Online', '2024-05-04 18:18:29', '0', '2024-05-04 13:10:49', '2024-05-04 18:18:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(907, 'singharry2705@gmail.com', '$2y$10$GPaor7nydungES.uFZl8Se8z/SM3BupgePz971zQeNryKyYk4bS6a', 'BtCCl5ahTkLLBkvnTsf1ml6im6DnKgJI9HEOqO88FeO15NVjzZpKN8YP9zuQ', '', NULL, '3', '0', '3', 'en', '1', '2', 'Online', '2024-05-18 19:21:53', '0', '2024-05-16 04:27:23', '2024-05-18 19:21:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(908, 'vireshgupta206@gmail.com', '$2y$10$Gg/bOxh6MK/A5C.L3o8NY.1sjASxswCEtSyykJZV90Sm5oP6g8PXi', NULL, '', NULL, '4', '0', '3', 'en', '1', '1', 'Online', '2024-07-15 03:38:47', '0', '2024-07-14 16:34:12', '2024-07-15 03:38:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `agents_users_agent_skills`
--

CREATE TABLE `agents_users_agent_skills` (
  `skill_id` int NOT NULL,
  `skill` varchar(255) NOT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 = no, 1= yes',
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_users_agent_skills`
--

INSERT INTO `agents_users_agent_skills` (`skill_id`, `skill`, `is_deleted`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Foreclosure', '0', 1, '2017-10-05 10:25:43', '2017-10-05 10:27:15'),
(2, 'Pre-Foreclosure', '0', 1, '2017-10-05 10:25:43', '2017-10-05 10:27:15'),
(3, 'FSBO', '0', 1, '2017-10-05 10:25:43', '2017-10-05 10:27:15'),
(4, 'Eviction', '0', 1, '2017-10-05 10:25:43', '2017-10-05 10:27:15'),
(5, 'Codes Issue', '0', 1, '2017-10-05 10:25:43', '2017-10-05 10:27:15'),
(6, 'Probate', '0', 1, '2017-10-05 10:25:43', '2017-10-05 10:27:15'),
(7, 'Motivates seller specialist', '0', 1, '2017-10-05 10:25:43', '2017-10-05 10:27:15'),
(8, 'TLC properties', '0', 1, '2017-10-05 10:25:43', '2017-10-05 10:27:15'),
(9, 'Investors', '0', 1, '2017-10-05 10:25:43', '2017-10-05 10:27:15'),
(10, 'Fast Sale', '0', 1, '2017-10-05 10:25:43', '2017-10-05 10:27:15'),
(11, 'Low Commision', '0', 1, '2017-10-05 10:25:43', '2017-10-05 10:27:15'),
(12, 'Guranteed', '0', 1, '2017-10-05 10:25:43', '2017-10-05 10:27:15'),
(13, 'Motivated buyer specialist', '0', 1, '2017-10-05 10:25:43', '2017-10-05 10:27:15'),
(14, 'Condo/Town home specialist', '0', 1, '2017-10-05 10:25:43', '2017-10-05 10:27:15'),
(15, 'Land specialist', '0', 1, '2017-10-05 10:25:43', '2017-10-05 10:27:15'),
(16, 'Farm specilist', '0', 1, '2017-10-05 10:25:43', '2017-10-05 10:27:15'),
(17, 'php specilist', '0', 1, '2017-10-05 10:25:43', '2018-06-14 18:49:42'),
(18, 'luxury hom specialist', '0', 1, '2017-10-05 10:25:43', '2017-10-05 10:27:15'),
(19, 'Distressed property speciality', '0', 1, '2017-10-05 10:25:43', '2017-10-05 10:27:15'),
(20, 'Multifamily', '0', 1, '2017-10-05 10:25:43', '2017-10-05 10:27:15'),
(21, 'Commercial', '0', 1, '2017-10-05 10:26:16', '2017-10-05 10:27:15'),
(22, 'Free staging', '0', 1, '2017-10-05 10:26:16', '2017-10-05 10:27:15'),
(23, '56gfhgh', '1', 1, '2018-01-02 13:04:58', '2018-01-02 13:07:32'),
(24, 'career', '0', 1, '2018-06-10 14:33:37', '2018-06-10 14:33:37'),
(25, 'abc', '1', 1, '2018-06-12 17:23:56', '2018-06-12 17:23:56'),
(26, 'J2ee', '0', 1, '2018-06-14 18:50:08', '2018-06-14 18:52:07');

-- --------------------------------------------------------

--
-- Table structure for table `agents_users_conections`
--

CREATE TABLE `agents_users_conections` (
  `connection_id` int NOT NULL,
  `post_id` int NOT NULL,
  `to_id` int NOT NULL,
  `to_role` int NOT NULL,
  `from_id` int NOT NULL,
  `from_role` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `closing_date` datetime DEFAULT NULL,
  `post_done` enum('1','2') NOT NULL DEFAULT '2' COMMENT '1=yes,2=no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_users_conections`
--

INSERT INTO `agents_users_conections` (`connection_id`, `post_id`, `to_id`, `to_role`, `from_id`, `from_role`, `created_at`, `updated_at`, `closing_date`, `post_done`) VALUES
(1, 20, 550, 4, 549, 3, '2022-09-18 20:07:01', '2022-09-19 03:14:13', NULL, '2'),
(2, 21, 550, 4, 549, 3, '2022-09-18 20:43:03', '2022-09-19 03:43:56', NULL, '2'),
(3, 22, 550, 4, 549, 3, '2022-09-18 21:06:26', '2022-09-19 04:07:35', NULL, '2'),
(4, 23, 550, 4, 549, 3, '2022-09-18 21:27:22', '2022-09-19 04:36:45', NULL, '2'),
(5, 24, 550, 4, 549, 3, '2022-09-18 22:09:30', '2022-09-19 05:24:43', NULL, '2'),
(6, 25, 550, 4, 549, 3, '2022-09-19 03:55:09', '2022-09-19 10:59:41', NULL, '2'),
(7, 26, 549, 3, 550, 4, '2022-09-29 21:24:59', '2022-09-30 04:24:59', NULL, '2'),
(8, 32, 614, 3, 597, 4, '2022-11-25 11:18:33', '2022-11-25 17:52:46', NULL, '2'),
(9, 32, 614, 3, 601, 4, '2022-11-25 11:23:30', '2022-11-25 17:53:09', NULL, '2'),
(10, 32, 614, 3, 542, 4, '2022-11-25 11:29:24', '2022-11-25 17:29:24', NULL, '2'),
(11, 35, 645, 3, 625, 4, '2022-12-08 13:47:32', '2022-12-08 19:48:14', NULL, '2'),
(12, 37, 656, 3, 550, 4, '2022-12-12 05:37:49', '2022-12-12 11:37:49', NULL, '2'),
(13, 33, 651, 2, 625, 4, '2022-12-16 08:04:55', '2022-12-16 14:10:56', NULL, '2'),
(14, 45, 666, 3, 625, 4, '2022-12-21 13:06:38', '2022-12-21 19:07:42', NULL, '2'),
(15, 44, 645, 2, 625, 4, '2022-12-21 13:10:55', '2022-12-28 18:56:38', NULL, '2'),
(16, 48, 656, 3, 550, 4, '2022-12-26 07:04:32', '2022-12-26 13:04:46', NULL, '2'),
(17, 50, 671, 3, 672, 4, '2022-12-27 07:18:17', '2022-12-27 13:19:25', NULL, '2'),
(18, 52, 671, 2, 672, 4, '2022-12-27 07:28:29', '2022-12-27 13:28:51', NULL, '2'),
(19, 49, 671, 3, 670, 4, '2022-12-27 08:08:18', '2022-12-27 14:08:18', NULL, '2'),
(20, 61, 645, 2, 601, 4, '2023-01-03 10:42:52', '2023-01-03 16:42:52', NULL, '2'),
(21, 65, 707, 2, 670, 4, '2023-01-09 08:02:45', '2023-01-09 14:03:43', NULL, '2'),
(22, 64, 707, 2, 670, 4, '2023-01-09 08:26:12', '2023-01-09 14:45:01', NULL, '2'),
(23, 66, 707, 3, 659, 4, '2023-01-09 09:13:55', '2023-01-09 15:13:55', NULL, '2'),
(24, 68, 656, 3, 709, 4, '2023-01-11 08:09:58', '2023-01-11 14:20:15', NULL, '2'),
(25, 70, 714, 2, 715, 4, '2023-01-16 06:03:33', '2023-01-16 12:03:33', NULL, '2'),
(26, 71, 714, 2, 715, 4, '2023-01-16 06:09:56', '2023-01-16 12:09:56', NULL, '2'),
(27, 73, 710, 3, 625, 4, '2023-01-16 06:46:36', '2023-01-16 12:46:41', NULL, '2'),
(28, 74, 714, 3, 709, 4, '2023-01-16 12:00:17', '2023-01-16 18:00:44', NULL, '2'),
(29, 75, 707, 3, 625, 4, '2023-01-19 07:35:34', '2023-01-30 13:51:17', NULL, '2'),
(30, 76, 716, 3, 692, 4, '2023-01-20 20:34:18', '2023-01-21 02:43:23', NULL, '2'),
(31, 89, 707, 3, 660, 4, '2023-01-31 06:56:23', '2023-01-31 12:56:23', NULL, '2'),
(32, 75, 707, 3, 709, 4, '2023-01-31 06:56:55', '2023-01-31 12:56:55', NULL, '2'),
(33, 103, 739, 2, 735, 4, '2023-02-05 09:25:25', '2023-02-05 15:54:11', NULL, '2'),
(34, 111, 762, 3, 670, 4, '2023-03-03 08:36:29', '2023-03-03 14:50:58', NULL, '2'),
(35, 114, 762, 3, 763, 4, '2023-03-03 12:17:36', '2023-03-03 18:17:36', NULL, '2'),
(36, 112, 762, 3, 763, 4, '2023-03-03 12:19:17', '2023-03-03 18:19:17', NULL, '2'),
(37, 118, 767, 2, 769, 4, '2023-03-12 08:39:07', '2023-03-12 13:43:52', NULL, '2'),
(38, 124, 767, 3, 774, 4, '2023-03-16 17:43:53', '2023-03-16 22:51:46', NULL, '2'),
(39, 118, 767, 3, 769, 4, '2023-03-18 12:23:45', '2023-03-18 17:23:52', NULL, '2'),
(40, 135, 784, 3, 781, 4, '2023-04-13 10:36:24', '2023-04-13 15:42:46', NULL, '2'),
(41, 134, 784, 3, 786, 4, '2023-04-13 12:17:52', '2023-04-13 17:23:10', NULL, '2'),
(42, 137, 828, 3, 830, 4, '2023-06-03 09:08:59', '2023-06-03 15:02:54', NULL, '2'),
(43, 144, 810, 3, 830, 4, '2023-07-08 12:45:45', '2023-07-10 10:21:16', NULL, '2'),
(44, 147, 839, 3, 834, 4, '2023-07-27 06:04:42', '2023-07-27 11:04:42', NULL, '2'),
(45, 153, 841, 2, 842, 4, '2023-08-02 07:29:12', '2023-08-09 16:27:13', NULL, '2'),
(46, 154, 670, 4, 848, 2, '2023-08-02 07:29:12', '2023-08-09 16:27:13', NULL, '2'),
(47, 155, 848, 2, 670, 4, '2023-08-02 07:29:12', '2023-08-09 16:27:13', NULL, '2'),
(48, 156, 851, 3, 852, 4, '2023-09-14 18:54:01', '2023-09-14 23:54:38', NULL, '2'),
(49, 158, 855, 2, 853, 4, '2023-11-11 12:48:15', '2023-11-11 18:48:18', NULL, '2'),
(50, 162, 859, 3, 860, 4, '2023-12-06 06:10:55', '2023-12-06 12:14:28', NULL, '2'),
(51, 163, 861, 2, 860, 4, '2023-12-07 10:26:35', '2023-12-07 16:26:35', NULL, '2'),
(52, 164, 861, 2, 853, 4, '2023-12-12 09:43:27', '2023-12-12 15:43:29', NULL, '2'),
(53, 161, 859, 3, 860, 4, '2023-12-28 05:29:15', '2023-12-28 11:34:00', NULL, '2'),
(54, 167, 863, 3, 853, 4, '2024-01-09 10:15:00', '2024-01-09 16:15:00', NULL, '2'),
(55, 164, 861, 2, 860, 4, '2024-01-11 17:11:09', '2024-01-11 23:12:36', NULL, '2'),
(56, 174, 876, 3, 879, 4, '2024-02-08 08:30:38', '2024-02-08 14:31:07', NULL, '2'),
(57, 178, 876, 3, 881, 4, '2024-02-08 12:43:24', '2024-02-08 18:44:05', NULL, '2'),
(58, 179, 876, 3, 878, 4, '2024-02-08 12:48:14', '2024-02-08 18:48:20', NULL, '2'),
(59, 179, 876, 3, 879, 4, '2024-02-08 12:51:02', '2024-02-08 18:51:02', NULL, '2'),
(60, 177, 876, 2, 881, 4, '2024-02-08 12:53:09', '2024-02-08 18:53:09', NULL, '2'),
(61, 180, 882, 3, 865, 4, '2024-02-13 19:09:48', '2024-02-14 01:09:48', NULL, '2'),
(62, 193, 896, 2, 891, 4, '2024-03-23 22:16:18', '2024-03-24 03:16:18', NULL, '2'),
(63, 194, 895, 3, 891, 4, '2024-03-26 08:29:10', '2024-03-26 13:30:11', NULL, '2'),
(64, 200, 904, 2, 905, 4, '2024-05-04 07:52:04', '2024-05-04 12:53:12', NULL, '2'),
(65, 201, 904, 2, 905, 4, '2024-05-04 07:56:59', '2024-05-04 13:00:42', NULL, '2'),
(66, 202, 906, 3, 905, 4, '2024-05-04 13:17:08', '2024-05-04 18:17:08', NULL, '2'),
(67, 203, 907, 2, 899, 4, '2024-05-16 04:32:20', '2024-05-16 09:32:20', NULL, '2');

-- --------------------------------------------------------

--
-- Table structure for table `agents_users_details`
--

CREATE TABLE `agents_users_details` (
  `details_id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `fname` varchar(32) DEFAULT NULL,
  `lname` varchar(32) DEFAULT NULL,
  `address` text,
  `address2` varchar(100) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone_home` varchar(20) DEFAULT NULL,
  `phone_work` varchar(20) DEFAULT NULL,
  `state_id` varchar(11) DEFAULT NULL,
  `city_id` text,
  `area` varchar(11) DEFAULT NULL,
  `fax_no` varchar(50) DEFAULT NULL,
  `zip_code` varchar(250) DEFAULT NULL,
  `description` longtext,
  `photo` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `education` longtext,
  `employment` longtext,
  `skills` varchar(255) DEFAULT NULL,
  `licence_number` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `state_licence` varchar(30) DEFAULT NULL,
  `default_proposals` longtext,
  `question_1` int DEFAULT NULL,
  `answer_1` varchar(250) DEFAULT NULL,
  `question_2` int DEFAULT NULL,
  `answer_2` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `franchise` varchar(250) DEFAULT NULL,
  `other_franchise` varchar(50) DEFAULT NULL,
  `company_name` varchar(50) DEFAULT NULL,
  `years_of_expreience` varchar(50) DEFAULT NULL,
  `office_address` varchar(50) DEFAULT NULL,
  `brokers_name` varchar(50) DEFAULT NULL,
  `MLS_public_id` varchar(50) DEFAULT NULL,
  `MLS_office_id` varchar(50) DEFAULT NULL,
  `real_estate_education` longtext,
  `certifications` varchar(250) DEFAULT NULL,
  `industry_experience` longtext,
  `specialization` varchar(250) DEFAULT NULL,
  `show_individual_yearly_figures` enum('0','1') DEFAULT '0' COMMENT '1=yes,0=no',
  `sales_history` longtext,
  `total_sales` int NOT NULL DEFAULT '0',
  `associations_awards` varchar(250) DEFAULT NULL,
  `publications` varchar(250) DEFAULT NULL,
  `community_involvement` varchar(250) DEFAULT NULL,
  `language_proficiency` longtext,
  `additional_details` varchar(1000) DEFAULT NULL,
  `when_u_want_to_buy` varchar(50) DEFAULT NULL,
  `price_range` varchar(50) DEFAULT NULL,
  `property_type` varchar(50) DEFAULT NULL,
  `firsttime_home_buyer` int DEFAULT NULL,
  `specific_requirements` longtext,
  `do_u_have_a_home_to_sell` int DEFAULT NULL,
  `if_so_do_you_need_help_selling` int DEFAULT NULL,
  `interested_buying` int DEFAULT NULL COMMENT 'buyer,seller',
  `got_lender_approval_for_short_sale` int NOT NULL DEFAULT '0' COMMENT 'seller',
  `bids_emailed` varchar(50) DEFAULT NULL,
  `do_you_need_financing` varchar(50) DEFAULT NULL,
  `need_Cash_back` int DEFAULT NULL COMMENT 'buyer,seller',
  `terms_and_conditions` int NOT NULL DEFAULT '0',
  `statement_document` varchar(250) DEFAULT NULL,
  `agent_rating` varchar(50) DEFAULT NULL,
  `buyer_rating` varchar(50) DEFAULT NULL,
  `seller_rating` varchar(50) DEFAULT NULL,
  `contract_verification` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_users_details`
--

INSERT INTO `agents_users_details` (`details_id`, `name`, `fname`, `lname`, `address`, `address2`, `phone`, `phone_home`, `phone_work`, `state_id`, `city_id`, `area`, `fax_no`, `zip_code`, `description`, `photo`, `company`, `website`, `education`, `employment`, `skills`, `licence_number`, `state_licence`, `default_proposals`, `question_1`, `answer_1`, `question_2`, `answer_2`, `created_at`, `updated_at`, `franchise`, `other_franchise`, `company_name`, `years_of_expreience`, `office_address`, `brokers_name`, `MLS_public_id`, `MLS_office_id`, `real_estate_education`, `certifications`, `industry_experience`, `specialization`, `show_individual_yearly_figures`, `sales_history`, `total_sales`, `associations_awards`, `publications`, `community_involvement`, `language_proficiency`, `additional_details`, `when_u_want_to_buy`, `price_range`, `property_type`, `firsttime_home_buyer`, `specific_requirements`, `do_u_have_a_home_to_sell`, `if_so_do_you_need_help_selling`, `interested_buying`, `got_lender_approval_for_short_sale`, `bids_emailed`, `do_you_need_financing`, `need_Cash_back`, `terms_and_conditions`, `statement_document`, `agent_rating`, `buyer_rating`, `seller_rating`, `contract_verification`) VALUES
(517, 'hemant', 'sanjeev', 'sanjeev', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-06 10:24:33', '2024-02-03 01:41:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(518, 'Praneet Joshi', 'Praneet', 'Joshi', 'Dallas', 'Kentucky', '7678908900', NULL, NULL, '2', '4', NULL, NULL, '89999', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-10 03:59:03', '2024-01-31 14:08:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(519, 'Peter Moses', 'Peter', 'Moses', 'dsfsdgfs', 'sdgfsdfs', '2737834783', NULL, NULL, '2', '4', NULL, NULL, '12312', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-10 05:46:36', '2022-08-10 05:46:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(520, 'Folly Mercy', 'Folly', 'Mercy', 'Add1', 'Add2', '8238446190', NULL, NULL, '2', '5', NULL, NULL, '38000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-10 06:16:20', '2022-08-10 06:16:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(521, 'Florance Bought', 'Florance', 'Bought', 'Test add 1', 'Test add 2', '8238446190', NULL, NULL, '2', '5', NULL, NULL, '38000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-10 10:37:04', '2022-08-10 10:37:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(522, 'testing testing', 'testing', 'testing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-14 14:49:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(523, 'abc test', 'abc', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-14 14:56:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(524, 'daf dafsdf', 'daf', 'dafsdf', 'abc', 'abc', '90888888', NULL, NULL, '7', '8', NULL, NULL, '3333', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-14 14:57:41', '2022-08-15 13:00:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(525, 'Krunal Pujara', 'Krunal', 'Pujara', '43, Devikrupa Society', 'CTM', '8460896891', NULL, NULL, '7', '8', NULL, NULL, '38008', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-15 06:20:15', '2022-08-15 06:20:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(526, 'Krunal Pujara', 'Krunal', 'Pujara', '43, Devikrupa Society', 'CTM', '8460896891', NULL, NULL, '7', '8', NULL, NULL, '38008', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-15 06:22:01', '2022-08-15 06:22:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(527, 'Krunal Pujara', 'Krunal', 'Pujara', '43, Devikrupa Society', 'CTM', '8460896891', NULL, NULL, '7', '8', NULL, NULL, '38008', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-15 06:22:54', '2022-08-15 06:23:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(528, 'abc test', 'abc', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-15 06:30:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(529, 'test test', 'test', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-15 12:34:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(530, 'Krunal Pujara', 'Krunal', 'Pujara', 'CTM Cross Rd', '', '8460896891', NULL, NULL, '7', '8', NULL, NULL, '38008', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-15 13:16:34', '2022-08-15 13:17:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(531, 'Krunal Pujara', 'Krunal', 'Pujara', 'CTM Cross Rd', 'Ahmedabad', '8460896891', NULL, NULL, '7', '8', NULL, NULL, '38003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-15 13:18:26', '2022-08-15 13:18:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(532, 'Krunal Pujara', 'Krunal', 'Pujara', 'CTM Cross Rd', 'Ahmedabad', '8460896891', NULL, NULL, '7', '8', NULL, NULL, '38003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-15 13:35:38', '2022-08-15 13:35:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(533, 'Krunal Pujara', 'Krunal', 'Pujara', 'CTM Cross Rd', 'Ahmedabad', '8460896891', NULL, NULL, '7', '8', NULL, NULL, '38008', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GJ27', NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-15 13:39:50', '2022-08-15 13:40:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(534, 'Krunal Pujara', 'Krunal', 'Pujara', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-15 13:41:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(535, 'pravasini sahoo', 'pravasini', 'sahoo', 'D 110', 'Maruti Residency', '9658786196', NULL, NULL, '2', '4', NULL, NULL, '99801', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-17 11:23:17', '2022-08-17 11:24:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(536, 'pravat behera', 'pravat', 'behera', 'Koel Bank, Newar Chhoti Masjid, Industrial Estate', '', '7008536167', NULL, NULL, '3', '6', NULL, NULL, '62629', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-17 12:25:42', '2022-08-17 12:27:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(537, 'abc xyz', 'abc', 'xyz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-19 09:25:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(538, 'coolman coolman', 'coolman', 'coolman', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-19 11:24:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(539, 'Crystal Tech Lab', 'Crystal Tech', 'Lab', '40 anjangarh birati', '', '2423432444', NULL, NULL, '2', '4', NULL, NULL, '45321', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aefefef', NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-20 13:59:56', '2022-08-20 14:00:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(540, 'Gina Lokino', 'Gina', 'Lokino', 'Darwin House', 'Texas', '9888812312', NULL, NULL, '2', '4', NULL, NULL, '98789', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'India', 2, '1975', '2022-08-22 02:19:03', '2022-08-22 02:22:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(541, 'Mrinal Sri', 'Mrinal', 'Sri', 'Dallas Building', 'Dallas', '8787678909', NULL, NULL, '2', '4', NULL, NULL, '90890', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'India', 2, '1975', '2022-08-22 02:25:12', '2022-08-22 02:26:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(542, 'Ganesh Jaibhay', 'Ganesh', 'Jaibhay', 'Texas Building', 'Florida', '8798999991', NULL, NULL, '2', '4', NULL, NULL, '56778', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8787888818', NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-22 02:27:48', '2022-08-22 02:28:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(543, 'Bijay Kumar', 'Bijay', 'Kumar', 'Liberty', 'New York', '8767889997', NULL, NULL, '2', '4', NULL, NULL, '87678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '89766748321', NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-22 02:30:28', '2022-08-22 02:30:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(544, 'Mark Waugh', 'Mark', 'Waugh', 'Milano', 'Milan', '8988393988', NULL, NULL, '2', '4', NULL, NULL, '89089', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '123771231', NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-22 04:13:02', '2022-08-22 04:14:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(545, 'hamza Ali', 'hamza', 'Ali', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-03 15:35:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(546, 'hamza Ali', 'hamza', 'Ali', 'house 5 green street house uk', 'house 5 green street house uk', '1924334322', NULL, NULL, '2', '5', NULL, NULL, '12232', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-04 04:06:49', '2022-09-04 11:08:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(547, 'Adena Rowland', 'Adena', 'Rowland', 'house 5 green street house uk', 'house 5 green street house uk', '0301234559', NULL, NULL, '2', '5', NULL, NULL, '23223', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-04 04:28:32', '2022-09-04 11:30:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(548, 'hamza TEST', 'hamza', 'TEST', 'house 5 green street house uk', 'house 5 green street house uk', '0301234559', NULL, NULL, '2', '4', NULL, NULL, '12344', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-04 04:34:04', '2022-09-04 11:34:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(549, 'Hamza Seller dssdsssssssssssssssssssssssssssssssss', 'hamza', 'buyer', 'house 5 green street house uk', 'house 5 green street house uk', '0301234559', NULL, NULL, '3', '6', NULL, NULL, '23423', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'dssd', 4, 'fds', '2022-09-04 14:07:31', '2023-04-05 02:13:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(550, 'test agent', 'hemant', 'agent', 'rajawasja', 'jaipur', '0301234559', NULL, NULL, '2', '1', NULL, '123', '32134,23223', NULL, '1675622533.jpg', NULL, NULL, NULL, NULL, '1,2,9,25', '12344', NULL, NULL, 3, '1212', 2, 'sddsd', '2022-09-17 19:55:10', '2024-02-04 13:38:44', NULL, NULL, 'abc', '12', 'rajawa', 'aitnic', '3213', '644fd', NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 'https://dev.92agents.com/assets/img/agents_pdf/1707032322.pdf', NULL, NULL, NULL, 2),
(551, 'hamzzzza Allli', 'hamzzzza', 'Allli', 'channan street 2', '', '01234567897', NULL, NULL, 'llondon', 'lahoew', NULL, NULL, '54321', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-02 11:10:31', '2022-10-02 18:19:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(552, 'hamzzzza', 'hamzzzza', 'hamzzzza', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-12 21:41:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(553, 'hamzzzza', 'hamzzzza', 'hamzzzza', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-12 21:47:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(554, 'hamzzzza', 'hamzzzza', 'hamzzzza', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-12 22:03:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(555, 'hamzzzza', 'hamzzzza', 'hamzzzza', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-17 19:47:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(556, 'hamzzzza', 'hamzzzza', 'hamzzzza', NULL, NULL, '+923174888016', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-17 20:04:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(557, 'hamzzzza', 'hamzzzza', 'hamzzzza', NULL, NULL, '+923174888016', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-17 20:36:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(558, 'hamzalast', 'profile Settings', 'hamzalast', 'ddf sdfsdfsd', 'gfghgfdsdwed dscsd', '+923012345595', NULL, NULL, '2', '1', NULL, NULL, NULL, NULL, '1670100240.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'no pta', 2, 'no idea', '2022-10-17 20:51:22', '2022-12-22 00:53:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(559, 'hamzalast', 'hamzalast', 'hamzalast', NULL, NULL, '+923012345595', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-17 19:23:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(560, 'hamzalast', 'hamzalast', 'hamzalast', NULL, NULL, '+923012345596', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-17 19:25:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(561, 'hamzalast', 'hamzalast', 'hamzalast', NULL, NULL, '+923012345596', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-17 19:25:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(563, 'hamzalast', 'hamzalast', 'hamzalast', NULL, NULL, '+923012345593', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-17 19:26:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(571, 'Michael Anderson', 'Michael Anderson', 'Michael Anderson', NULL, NULL, '16155943902', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-18 07:48:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(573, 'hamza ssaller', 'hamza', 'ssaller', 'house 5 green street house uk', 'house 5 green street house uk', '0301234559', NULL, NULL, '2', '4', NULL, NULL, '54321', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-19 22:22:33', '2022-11-20 04:22:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(583, 'hamzalast', 'hamzalast', 'hamzalast', NULL, NULL, '+923174888000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-22 19:24:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(584, 'hamzalast', 'hamzalast', 'hamzalast', NULL, NULL, '+92317488800', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-22 19:26:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(585, 'hamzalast', 'hamzalast', 'hamzalast', NULL, NULL, '+92317488800666', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-22 19:32:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(586, 'hamzalast', 'hamzalast', 'hamzalast', NULL, NULL, '+923174888816', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-22 19:34:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(589, 'Mitansh', 'Mitansh', 'Mitansh', NULL, NULL, '929456781234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-23 06:43:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(590, 'Rayen Wane', 'Rayen Wane', 'Rayen Wane', NULL, NULL, '926201656799', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-23 06:44:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(591, 'Rayen Wane', 'Rayen Wane', 'Rayen Wane', NULL, NULL, '92+916201656799', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-23 06:47:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(592, 'Arun', 'Arun', 'Arun', NULL, NULL, '929345567891', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-23 06:48:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(593, 'Arun', 'Arun', 'Arun', NULL, NULL, '929345567457', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-23 06:49:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(594, 'HANARY CAVILL', 'HANARY CAVILL', 'HANARY CAVILL', NULL, NULL, '92+91 6201656799', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-23 06:53:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(595, 'HANARY CAVILL', 'HANARY CAVILL', 'HANARY CAVILL', NULL, NULL, '92+91 9900344546', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-23 06:54:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(596, 'HANARY CAVILL', 'HANARY CAVILL', 'HANARY CAVILL', NULL, NULL, '92+91 9098979695', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-23 06:55:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(597, 'Bruce Wane', 'Bruce', 'Wane', '42 N 1st St', '', '2485795654', NULL, NULL, '3', '6', NULL, NULL, '54615', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '873908293', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-23 07:07:54', '2022-11-23 13:17:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(598, 'Louis Kupha', 'Louis', 'Kupha', 'tilpat', '', '3644627056', NULL, NULL, '7', '8', NULL, NULL, '89568', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-23 07:32:38', '2022-11-23 13:38:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(599, 'Bruce Wane', 'Bruce', 'Wane', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-23 07:34:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(600, 'hanary wane', 'hanary', 'wane', '1937 Wentzville Pkwy', '1937 Wentzville Pkwy', '6201656799', NULL, NULL, '2', '4', NULL, NULL, '63385', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '794262604', NULL, NULL, 9, 'yes', 8, 'Kio Chan', '2022-11-23 07:44:51', '2023-01-10 13:27:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(601, 'HANARAY WANE', 'hanary', 'wane', '385 S Broadway', '', '7817817817', NULL, NULL, '2', '4', NULL, NULL, '03079', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '564739560', NULL, NULL, 1, 'Washingtn DC', 2, '09/11/2011 , Shashingtn DC', '2022-11-23 08:09:40', '2022-11-25 17:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(607, 'Hanary Cavill', 'Hanary', 'Cavill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-25 05:37:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(608, 'Hanary Cavill', 'Hanary', 'Cavill', '4 Mohawk Rd, 	Canton', '', '1865432680', NULL, NULL, '2', '4', NULL, NULL, '02021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-25 05:50:00', '2022-11-25 11:56:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(609, 'Mitansh Vats', 'Mitansh', 'Vats', '456, kakdipur', '', '3124598647', NULL, NULL, '2', '5', NULL, NULL, '45666', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-25 07:10:56', '2022-11-25 13:13:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(610, 'Bruce Wane', 'Bruce', 'Wane', '735, ufsiygfs, new yourk, usa', '', '8472897429', NULL, NULL, '2', '4', NULL, NULL, '84937', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0123456789', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-25 07:19:11', '2022-11-25 13:23:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(611, 'Aarti sharma', 'Aarti', 'sharma', 'kakdipur', '', '7894566126', NULL, NULL, '2', '4', NULL, NULL, '45678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-25 08:50:21', '2022-11-25 15:00:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(612, 'Bruce Wane', 'Bruce', 'Wane', '7665, new yourkdaston', '', '9403409332', NULL, NULL, '2', '4', NULL, NULL, '64537', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hfgdjksla', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-25 08:57:24', '2022-11-25 14:59:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(613, 'Rahul parasher', 'Rahul', 'parasher', 'sector 10', '', '9154236785', NULL, NULL, '2', '4', NULL, NULL, '45678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '123456789', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-25 09:16:28', '2022-11-25 16:13:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(614, 'joy jinda', 'joy', 'jinda', 'hedrabad', '', '7894561230', NULL, NULL, '2', '4', NULL, NULL, '45612', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-25 10:40:26', '2022-11-25 16:42:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(616, 'Nouman Masood', 'Nouman Masood', 'Nouman Masood', NULL, NULL, '+923246465219', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-25 13:37:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(617, 'shahzain', 'shahzain', 'shahzain', NULL, NULL, '+923105977335', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-25 13:48:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(622, 'Raymond feil', 'Raymond feil', 'Raymond feil', NULL, NULL, '9794293446', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-28 08:51:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(623, 'Kamille Daughterty', 'Kamille Daughterty', 'Kamille Daughterty', NULL, NULL, '4133248551', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-28 09:26:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(624, 'HANARY CAVILL', 'HANARY CAVILL', 'HANARY CAVILL', NULL, NULL, '991100334545', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-28 10:19:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(625, 'Grayson Kub', 'Grayson Kub', 'Grayson Kub', '9th Main Rd, Jayanagar 4 Block, Jayanagar', '9th Main Rd, Jayanagar 4 Block, Jayan', '+1 2763252467', NULL, NULL, '6', '8', NULL, '87825436', '74533', NULL, '1671694689.jpg', NULL, NULL, NULL, NULL, NULL, '826452976419', NULL, NULL, 1, 'Grand Forks', 2, '1975-05-05', '2022-11-28 11:01:47', '2023-02-26 11:36:11', '1', NULL, 'Gary.K', '1 - 5', '800 Richmond Ave, Pt Pleasant Bch, New Mexico', 'Grayson', 'Gray.k', 'Gray.K', '[{\"degree\":\"gfuvtrdutfoyg\",\"school\":\"y dtird tyfou\",\"from\":\"2015\",\"to\":\"2017\",\"description\":\"<p>yrdrdityfiytdiyt<\\/p>\"}]', '1', '[{\"post\":\"ytcutei\",\"organization\":\"vdgswfzbxg.yv\",\"from\":\"2017\",\"to\":\"2018\",\"description\":\"jfjfryre646efsxdsxsdzvd\"}]', '5', '0', '[{\"year\":\"2017\",\"sellers_represented\":\"665655\",\"buyers_represented\":\"76533\",\"total_dollar_sales\":\"65560\"}]', 65560, '7675bbvbv cvc   v gv  cg', '67574', '757443322', '[{\"language\":\"7\",\"speak\":\"Y\",\"read\":\"Y\",\"write\":\"Y\"}]', '<p>uygc75s7z4r8okpu0m98j</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 'https://dev.92agents.com/assets/img/agents_pdf/1676291146.pdf', NULL, NULL, NULL, 1),
(626, 'Bruce Batman', 'Bruce Batman', 'Bruce Batman', NULL, NULL, '+44916201656799', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-28 11:03:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(627, 'Bruce Batman', 'Bruce Batman', 'Bruce Batman', NULL, NULL, '+1 9794293446', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-28 11:09:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(630, 'Annu', 'Annu', 'Annu', NULL, NULL, '2025550153', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-29 05:07:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(631, 'Annu', 'Annu', 'Annu', NULL, NULL, '2025550154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-29 05:08:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(632, 'Annu', 'Annu', 'Annu', NULL, NULL, '2025550255', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-29 05:08:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(633, 'Annu', 'Annu', 'Annu', NULL, NULL, '+1918882442934', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-29 05:13:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(634, 'Aarti', 'Aarti', 'Aarti', NULL, NULL, '+9786431878', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-29 05:32:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(635, 'maitry', 'maitry', 'maitry', NULL, NULL, '+12999265646', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-29 05:41:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(636, 'Pihu', 'Pihu', 'Pihu', NULL, NULL, '+12457382508', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-29 06:57:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(637, 'Pihu', 'Pihu', 'Pihu', NULL, NULL, '+12443515462', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-29 07:01:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(638, 'Pihu', 'Pihu', 'Pihu', NULL, NULL, '+12963889720', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-29 07:03:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(639, 'Anjali Mishra', 'Anjali Mishra', 'Anjali Mishra', NULL, NULL, '+19786431878', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-29 07:15:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(640, 'Anjali Mishra', 'Anjali Mishra', 'Anjali Mishra', NULL, NULL, '+12901361962', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-29 07:27:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(641, 'Charles LL', 'Charles LL', 'Charles LL', NULL, NULL, '+12448884705', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-29 07:38:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(642, 'Raj bakshi', 'Raj bakshi', 'Raj bakshi', NULL, NULL, '+12599518673', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-29 07:41:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(643, 'Kathryn Powlowski', 'Kathryn Powlowski', 'Kathryn Powlowski', NULL, NULL, '+12402673462', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-29 08:34:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(644, 'Amaya Kuvalis', 'Amaya Kuvalis', 'Amaya Kuvalis', NULL, NULL, '+12602268274', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-29 08:50:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(645, 'Rosanna Senger', 'Rosanna Senger', 'Rosanna Senger', '1712 E Mason St, Green Bay, West Virginia', '1712 E Mason St, Green Bay, West Virginia', '+18332403627', NULL, NULL, 'Maharashtra', 'pune', NULL, NULL, NULL, NULL, '1671631228.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'West Columbia', 2, '2000-11-06', '2022-11-29 09:15:30', '2022-12-22 11:54:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(646, 'Lucien Mertz', 'Lucien Mertz', 'Lucien Mertz', NULL, NULL, '+16156823765', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Orange Park', 2, '1992-09-17', '2022-11-29 11:29:10', '2022-12-08 19:30:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(647, 'Erika Pagac', 'Erika Pagac', 'Erika Pagac', NULL, NULL, '+18142772491', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-29 11:40:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(648, 'Eladio Becker', 'Eladio Becker', 'Eladio Becker', NULL, NULL, '+19492883523', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-29 12:03:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(649, 'Benedict Nicolas', 'Benedict Nicolas', 'Benedict Nicolas', NULL, NULL, '+161631938556', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-29 12:07:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(650, 'Alvina Walker', 'Alvina Walker', 'Alvina Walker', NULL, NULL, '+13312762635', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-29 12:10:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(651, 'Aditya Kertzamann', 'Aditya Kertzamann', 'Aditya Kertzamann', '56377,Twentynine street', 'sector-35', '+15625678429', NULL, NULL, 'State', 'City', NULL, NULL, NULL, NULL, '1672231307.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'no pta', 2, 'no idea', '2022-11-29 12:24:22', '2022-12-30 16:09:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(653, 'Ahmad Sheikh', 'Ahmad Sheikh', 'Ahmad Sheikh', NULL, NULL, '+923428389005', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1670666202.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-04 06:58:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0);
INSERT INTO `agents_users_details` (`details_id`, `name`, `fname`, `lname`, `address`, `address2`, `phone`, `phone_home`, `phone_work`, `state_id`, `city_id`, `area`, `fax_no`, `zip_code`, `description`, `photo`, `company`, `website`, `education`, `employment`, `skills`, `licence_number`, `state_licence`, `default_proposals`, `question_1`, `answer_1`, `question_2`, `answer_2`, `created_at`, `updated_at`, `franchise`, `other_franchise`, `company_name`, `years_of_expreience`, `office_address`, `brokers_name`, `MLS_public_id`, `MLS_office_id`, `real_estate_education`, `certifications`, `industry_experience`, `specialization`, `show_individual_yearly_figures`, `sales_history`, `total_sales`, `associations_awards`, `publications`, `community_involvement`, `language_proficiency`, `additional_details`, `when_u_want_to_buy`, `price_range`, `property_type`, `firsttime_home_buyer`, `specific_requirements`, `do_u_have_a_home_to_sell`, `if_so_do_you_need_help_selling`, `interested_buying`, `got_lender_approval_for_short_sale`, `bids_emailed`, `do_you_need_financing`, `need_Cash_back`, `terms_and_conditions`, `statement_document`, `agent_rating`, `buyer_rating`, `seller_rating`, `contract_verification`) VALUES
(654, 'Testing User', 'Testing User', 'Testing User', NULL, NULL, '+923088389005', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-04 07:04:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(655, 'Roger Moses', 'Roger', 'Moses', '1 Crossgates Mall Road', '', '9448569625', NULL, NULL, '7', '8', NULL, NULL, '12203', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-09 12:34:48', '2022-12-09 18:37:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(656, 'Priya Kandaswamy', 'Priya', 'Kandaswamy', 'Door No. 3566', 'Basaveshwara Nagar', '9448569625', NULL, NULL, 'Karnataka', 'houston', NULL, NULL, '12321', NULL, '1671617434.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'Apple', 9, 'Yes', '2022-12-12 05:15:19', '2023-01-30 06:56:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(657, 'Partick Shaw', 'Partick', 'Shaw', 'Minnesota Towers', 'Ottawa', '9345679087', NULL, NULL, '3', '6', NULL, NULL, '98709', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-12 12:19:30', '2022-12-12 18:20:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(658, 'Vikram Shaw', 'Vikram', 'Shaw', 'Shoba Towers', 'Washington', '8768998719', NULL, NULL, '2', '4', NULL, NULL, '87689', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-12 12:21:59', '2022-12-12 18:22:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(659, 'Pranjali Bahadarpurkar', 'Pranjali', 'Bahadarpurkar', 'Prestige Towers, Salarpuria Sattva', 'Knowledge City', '5675689076', NULL, NULL, '2', '4', NULL, NULL, '67856', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '73263217371', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-12 12:24:13', '2022-12-12 18:25:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(660, 'Kinnari Mehta', 'Kinnari', 'Mehta', 'Mindspace', 'Tower 2', '7876899978', NULL, NULL, '2', '4', NULL, NULL, '87688', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2386637', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-12 12:26:53', '2022-12-12 18:27:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(661, 'Revanth', 'Revanth', 'Revanth', NULL, NULL, '654789690', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-12 12:36:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(662, 'Revanth1', 'Revanth1', 'Revanth1', NULL, NULL, '453567890', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-12 12:38:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(663, 'Vikranth rona', 'Vikranth rona', 'Vikranth rona', NULL, NULL, '76785687557', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-14 07:04:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(664, 'Glenda Ruecker', 'Glenda', 'Ruecker', '2002 Soldier Hollow Dr', 'Midway,United States', '6542002020', NULL, NULL, '2', '10', NULL, NULL, '84049', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1234567895412', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-16 06:07:59', '2022-12-16 12:10:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(665, 'Leopoldo Nader', 'Leopoldo', 'Nader', '230 Warren Mason Blvd', 'United States', '7845963254', NULL, NULL, '3', '6', NULL, NULL, '31520', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4521366897458', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-16 06:18:57', '2022-12-16 12:21:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(666, 'Abbigail Schultz', 'Abbigail', 'Schultz', 'N56w15475 Silver Spring Dr', 'N56w15475 Silver Spring Dr', '9977564646', NULL, NULL, '3', '6', NULL, NULL, '86857', NULL, '1671645239.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-21 07:55:56', '2022-12-21 13:57:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(667, 'Satish Pai', 'Satish Pai', 'Satish Pai', NULL, NULL, '865678888', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-21 10:25:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(668, 'Chandan shetty', 'Chandan shetty', 'Chandan shetty', NULL, NULL, '9878968878', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-25 14:36:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(669, 'Pramod', 'Pramod', 'Pramod', NULL, NULL, '85785678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-25 14:39:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(670, 'Shiva Kumar', 'Shiva', 'Kumar', 'Mindspace', 'Hyderabad', '9832848432', '3453453453', '9129192391', '2', '5', NULL, NULL, '39391', 'Enter about you.', NULL, NULL, NULL, NULL, NULL, NULL, '8789991991', NULL, NULL, 2, 'Apple', 7, 'Pizza', '2022-12-26 07:10:51', '2023-08-10 17:15:13', NULL, NULL, 'Sipuranko', '1 - 5', '850 Squirrel Rd, Las Cruces, New York, 88007', 'Supior kento', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 'https://dev.92agents.com/assets/img/agents_pdf/1674120593.pdf', NULL, NULL, NULL, 1);
INSERT INTO `agents_users_details` (`details_id`, `name`, `fname`, `lname`, `address`, `address2`, `phone`, `phone_home`, `phone_work`, `state_id`, `city_id`, `area`, `fax_no`, `zip_code`, `description`, `photo`, `company`, `website`, `education`, `employment`, `skills`, `licence_number`, `state_licence`, `default_proposals`, `question_1`, `answer_1`, `question_2`, `answer_2`, `created_at`, `updated_at`, `franchise`, `other_franchise`, `company_name`, `years_of_expreience`, `office_address`, `brokers_name`, `MLS_public_id`, `MLS_office_id`, `real_estate_education`, `certifications`, `industry_experience`, `specialization`, `show_individual_yearly_figures`, `sales_history`, `total_sales`, `associations_awards`, `publications`, `community_involvement`, `language_proficiency`, `additional_details`, `when_u_want_to_buy`, `price_range`, `property_type`, `firsttime_home_buyer`, `specific_requirements`, `do_u_have_a_home_to_sell`, `if_so_do_you_need_help_selling`, `interested_buying`, `got_lender_approval_for_short_sale`, `bids_emailed`, `do_you_need_financing`, `need_Cash_back`, `terms_and_conditions`, `statement_document`, `agent_rating`, `buyer_rating`, `seller_rating`, `contract_verification`) VALUES
(671, 'Rajani Joshi', 'Rajani', 'Joshi', 'Cyber Village', 'Hyderabad', '9832848234', '(929) 391-2391', '(123) 123-1231', '2', '4', NULL, '123213123', '89001', '<p>I am seller</p><p><br></p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-27 06:28:50', '2022-12-27 12:57:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0);
INSERT INTO `agents_users_details` (`details_id`, `name`, `fname`, `lname`, `address`, `address2`, `phone`, `phone_home`, `phone_work`, `state_id`, `city_id`, `area`, `fax_no`, `zip_code`, `description`, `photo`, `company`, `website`, `education`, `employment`, `skills`, `licence_number`, `state_licence`, `default_proposals`, `question_1`, `answer_1`, `question_2`, `answer_2`, `created_at`, `updated_at`, `franchise`, `other_franchise`, `company_name`, `years_of_expreience`, `office_address`, `brokers_name`, `MLS_public_id`, `MLS_office_id`, `real_estate_education`, `certifications`, `industry_experience`, `specialization`, `show_individual_yearly_figures`, `sales_history`, `total_sales`, `associations_awards`, `publications`, `community_involvement`, `language_proficiency`, `additional_details`, `when_u_want_to_buy`, `price_range`, `property_type`, `firsttime_home_buyer`, `specific_requirements`, `do_u_have_a_home_to_sell`, `if_so_do_you_need_help_selling`, `interested_buying`, `got_lender_approval_for_short_sale`, `bids_emailed`, `do_you_need_financing`, `need_Cash_back`, `terms_and_conditions`, `statement_document`, `agent_rating`, `buyer_rating`, `seller_rating`, `contract_verification`) VALUES
(672, 'Nirmal Bagrecha', 'Nirmal', 'Bagrecha', 'Madhapur', 'Hyderabad', '1237712371', '2131231231', '1231231231', '2', '10', NULL, NULL, '82828', '<p>Agent with 8&nbsp; years expe</p>', NULL, NULL, NULL, '[{\"degree\":\"asdgadsg\",\"school\":\"asgdgasd\",\"from\":\"2022\",\"to\":\"2023\",\"description\":\"sfsfd\"}]', '[{\"post\":\"Dev\",\"organization\":\"Test\",\"from\":\"2005\",\"to\":\"currently_work\",\"description\":\"asdasd\"}]', '1,2,3', '127371277123', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-27 06:39:36', '2022-12-27 13:50:47', 'other', '213123', '12312312', '5 -10', 'Kent', '1231231', '123123', '123123', '[{\"degree\":\"qweqweq\",\"school\":\"23123123\",\"from\":\"2005\",\"to\":\"2007\",\"description\":\"<p>123213<\\/p>\"}]', '1', '[{\"post\":\"21312\",\"organization\":\"1231231\",\"from\":\"currently_work\",\"to\":\"currently_work\",\"description\":\"1231232\"}]', '1,2', '1', '[{\"year\":\"2006\",\"sellers_represented\":\"12312\",\"buyers_represented\":\"123123\",\"total_dollar_sales\":\"123123123\"}]', 123123123, '12312', '123123', '1231231', '[{\"language\":\"12312\",\"speak\":\"Y\",\"read\":\"Y\",\"write\":\"Y\"}]', '<p>12312</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 'https://dev.92agents.com/assets/img/agents_pdf/1672127445.pdf', NULL, NULL, NULL, 1),
(673, 'hamza Ali seller bro', 'hamza Ali', 'seller bro', 'house 5 green street house uk', 'house 5 green street house uk', '0301234559', NULL, NULL, '2', '4', NULL, NULL, '12333', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-29 19:42:46', '2022-12-30 01:43:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(674, 'hamza SELLER bro', 'hamza', 'SELLER bro', 'house 5 green street house uk', 'house 5 green street house uk', '0301234559', NULL, NULL, '2', '5', NULL, NULL, '12212', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-29 19:47:09', '2022-12-30 01:47:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(675, 'Madison Leannon', 'Madison Leannon', 'Madison Leannon', 'null', 'ghjj', '+16465780322', NULL, NULL, '6', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-30 06:27:41', '2022-12-30 16:10:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(676, 'Naresh reddy', 'Naresh reddy', 'Naresh reddy', NULL, NULL, '8788788i77i7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-31 09:51:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(677, 'Prabhu reddy', 'Prabhu reddy', 'Prabhu reddy', NULL, NULL, '7689086781', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-31 09:58:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(678, 'Tyriyue Baucj', 'Tyriyue Baucj', 'Tyriyue Baucj', NULL, NULL, '+13134048290', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-31 15:15:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(679, 'Adrien Dach', 'Adrien Dach', 'Adrien Dach', NULL, NULL, '+447940410985', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-31 15:27:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(680, 'Dheeraj', 'Dheeraj', 'Dheeraj', NULL, NULL, '6547896780', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-01 01:20:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(681, 'Divya', 'Divya', 'Divya', NULL, NULL, '6578906759', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-01 01:28:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(682, 'Deepa', 'Deepa', 'Deepa', NULL, NULL, '657894560', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-01 02:59:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(683, 'Srushti Joshi', 'Srushti Joshi', 'Srushti Joshi', NULL, NULL, '9768956789', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-01 09:56:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(684, 'shankar', 'shankar', 'shankar', NULL, NULL, '9449389610', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-02 03:35:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(685, 'shankar', 'shankar', 'shankar', NULL, NULL, '9886408105', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-02 03:36:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(686, 'Veerendra', 'Veerendra', 'Veerendra', NULL, NULL, '9448523456', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-02 07:16:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(687, 'Veerendra', 'Veerendra', 'Veerendra', NULL, NULL, '9448523459', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-02 07:17:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(688, 'Vishal', 'Vishal', 'Vishal', NULL, NULL, '5674578906', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-02 07:18:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(689, 'Anil kulkarni', 'Anil kulkarni', 'Anil kulkarni', NULL, NULL, '9341081371', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-02 07:21:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(690, 'Anil kulkarni', 'Anil kulkarni', 'Anil kulkarni', NULL, NULL, '9449689567', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-02 07:22:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(691, 'Hammad khan', 'Hammad khan', 'Hammad khan', NULL, NULL, '+923124936726', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-02 10:50:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(692, 'Sarthak joshi', 'Sarthak joshi', 'Sarthak joshi', 'Door No. 67', 'Sanganakal road', '+919880870505', NULL, NULL, 'Karnataka', 'bellary', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-03 05:55:09', '2023-01-03 14:32:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(693, 'Pushkar joshi', 'Pushkar joshi', 'Pushkar joshi', NULL, NULL, '+919448569625', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-03 05:57:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(694, 'Prasanna joshi', 'Prasanna joshi', 'Prasanna joshi', NULL, NULL, '+919886408105', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-03 08:48:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(695, 'angadi', 'angadi', 'angadi', NULL, NULL, '+91988546789', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-04 02:26:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(696, 'Manoj', 'Manoj', 'Manoj', NULL, NULL, '+919449389610', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-04 02:27:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(697, 'Angela parker', 'Angela parker', 'Angela parker', NULL, NULL, '6155943903', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-04 16:21:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(698, 'Jennifer Kreiger', 'Jennifer Kreiger', 'Jennifer Kreiger', NULL, NULL, '919650920489', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-04 17:05:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(699, 'sanil', 'sanil', 'sanil', NULL, NULL, '9766888987', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-05 14:14:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(700, 'sanil', 'sanil', 'sanil', NULL, NULL, '+919766888986', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-05 14:15:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(701, 'sanil', 'sanil', 'sanil', NULL, NULL, '+918217390623', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-05 14:19:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0);
INSERT INTO `agents_users_details` (`details_id`, `name`, `fname`, `lname`, `address`, `address2`, `phone`, `phone_home`, `phone_work`, `state_id`, `city_id`, `area`, `fax_no`, `zip_code`, `description`, `photo`, `company`, `website`, `education`, `employment`, `skills`, `licence_number`, `state_licence`, `default_proposals`, `question_1`, `answer_1`, `question_2`, `answer_2`, `created_at`, `updated_at`, `franchise`, `other_franchise`, `company_name`, `years_of_expreience`, `office_address`, `brokers_name`, `MLS_public_id`, `MLS_office_id`, `real_estate_education`, `certifications`, `industry_experience`, `specialization`, `show_individual_yearly_figures`, `sales_history`, `total_sales`, `associations_awards`, `publications`, `community_involvement`, `language_proficiency`, `additional_details`, `when_u_want_to_buy`, `price_range`, `property_type`, `firsttime_home_buyer`, `specific_requirements`, `do_u_have_a_home_to_sell`, `if_so_do_you_need_help_selling`, `interested_buying`, `got_lender_approval_for_short_sale`, `bids_emailed`, `do_you_need_financing`, `need_Cash_back`, `terms_and_conditions`, `statement_document`, `agent_rating`, `buyer_rating`, `seller_rating`, `contract_verification`) VALUES
(705, 'Prashant Darshi', 'Prashant', 'Darshi', 'Majestic', 'Bangalore', '3812831823', NULL, NULL, '2', '4', NULL, NULL, '3221', '<p>Ready to sell House</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'Bellary', 8, 'Smitha ranga', '2023-01-09 06:00:24', '2023-01-09 12:06:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0);
INSERT INTO `agents_users_details` (`details_id`, `name`, `fname`, `lname`, `address`, `address2`, `phone`, `phone_home`, `phone_work`, `state_id`, `city_id`, `area`, `fax_no`, `zip_code`, `description`, `photo`, `company`, `website`, `education`, `employment`, `skills`, `licence_number`, `state_licence`, `default_proposals`, `question_1`, `answer_1`, `question_2`, `answer_2`, `created_at`, `updated_at`, `franchise`, `other_franchise`, `company_name`, `years_of_expreience`, `office_address`, `brokers_name`, `MLS_public_id`, `MLS_office_id`, `real_estate_education`, `certifications`, `industry_experience`, `specialization`, `show_individual_yearly_figures`, `sales_history`, `total_sales`, `associations_awards`, `publications`, `community_involvement`, `language_proficiency`, `additional_details`, `when_u_want_to_buy`, `price_range`, `property_type`, `firsttime_home_buyer`, `specific_requirements`, `do_u_have_a_home_to_sell`, `if_so_do_you_need_help_selling`, `interested_buying`, `got_lender_approval_for_short_sale`, `bids_emailed`, `do_you_need_financing`, `need_Cash_back`, `terms_and_conditions`, `statement_document`, `agent_rating`, `buyer_rating`, `seller_rating`, `contract_verification`) VALUES
(706, 'Rajesh Shetty', 'Rajesh', 'Shetty', 'Malleshwaram', 'Bangalore', '8321831111', NULL, NULL, '2', '4', NULL, NULL, '77711', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-09 06:28:04', '2023-01-09 12:28:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(707, 'Raghavendra Rao', 'Raghavendra', 'Rao', '12236 E 60th St, Tulsa, Oklahoma, 74134', '12236 E 60th St, Tulsa, Oklahoma, 74134', '1263261631', '(312) 312-3123', '(121) 313-1231', 'Oklahoma', 'Texas', NULL, '12313132', '67777', '<p style=\"margin-bottom: 20px; font-size: 14px; line-height: 24px; color: rgb(25, 23, 23); font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; text-align: center; background-color: rgb(232, 238, 235);\"><span class=\"head\" style=\"font-weight: 700; color: rgb(0, 72, 34);\">Master Bedrooms</span><br>Flooring : Vitrified tile<br>Walls : Putty / POP<br>Ceiling : Putty / POP</p><p style=\"margin-bottom: 20px; font-size: 14px; line-height: 24px; color: rgb(25, 23, 23); font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; text-align: center; background-color: rgb(232, 238, 235);\"><span class=\"head\" style=\"font-weight: 700; color: rgb(0, 72, 34);\">Balcony</span><br>Flooring : Anti Skid Tiles<br>Ceiling : Putty / POP<br>Walls : Putty / POP<br></p><p style=\"margin-bottom: 20px; font-size: 14px; line-height: 24px; color: rgb(25, 23, 23); font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; text-align: center; background-color: rgb(232, 238, 235);\"><span class=\"head\" style=\"font-weight: 700; color: rgb(0, 72, 34);\">Kitchen</span><br>Flooring : Anti Skid Tiles<br>Ceiling : Putty / POP<br>Walls : Putty / POP, Ceramic tiles-dado up to 2 feet above working platform<br>Granite counter with stainless steel sink</p>', '1675074980.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'Challakere', 8, 'Smitha', '2023-01-09 06:30:04', '2023-01-30 16:27:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0);
INSERT INTO `agents_users_details` (`details_id`, `name`, `fname`, `lname`, `address`, `address2`, `phone`, `phone_home`, `phone_work`, `state_id`, `city_id`, `area`, `fax_no`, `zip_code`, `description`, `photo`, `company`, `website`, `education`, `employment`, `skills`, `licence_number`, `state_licence`, `default_proposals`, `question_1`, `answer_1`, `question_2`, `answer_2`, `created_at`, `updated_at`, `franchise`, `other_franchise`, `company_name`, `years_of_expreience`, `office_address`, `brokers_name`, `MLS_public_id`, `MLS_office_id`, `real_estate_education`, `certifications`, `industry_experience`, `specialization`, `show_individual_yearly_figures`, `sales_history`, `total_sales`, `associations_awards`, `publications`, `community_involvement`, `language_proficiency`, `additional_details`, `when_u_want_to_buy`, `price_range`, `property_type`, `firsttime_home_buyer`, `specific_requirements`, `do_u_have_a_home_to_sell`, `if_so_do_you_need_help_selling`, `interested_buying`, `got_lender_approval_for_short_sale`, `bids_emailed`, `do_you_need_financing`, `need_Cash_back`, `terms_and_conditions`, `statement_document`, `agent_rating`, `buyer_rating`, `seller_rating`, `contract_verification`) VALUES
(709, 'Purnima Pindi', 'Purnima', 'Pindi', 'Main Street T Nagar', 'Chennai', '1234567670', '2312324324', '4567546745', '2', '4', NULL, '942347828734', '31271', '<p style=\"margin-left: 25px;\"><b><u><font face=\"Impact\" style=\"background-color: rgb(74, 123, 140);\">Agent with 12 ye</font></u></b><br><\\/p>\"}]', '1', '[{\"post\":\"Test\",\"organization\":\"Test\",\"from\":\"2021\",\"to\":\"2004\",\"description\":\"Test\"}]', '1,2,3', '0', '[{\"year\":\"2019\",\"sellers_represented\":\"90\",\"buyers_represented\":\"90\",\"total_dollar_sales\":\"900000\"}]', 900000, 'Test', 'test', 'Test', '[{\"language\":\"Test\",\"speak\":\"Y\",\"read\":\"Y\",\"write\":\"Y\"}]', '<p>Test</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 'https://dev.92agents.com/assets/img/agents_pdf/1673420971.pdf', NULL, NULL, NULL, 1);
INSERT INTO `agents_users_details` (`details_id`, `name`, `fname`, `lname`, `address`, `address2`, `phone`, `phone_home`, `phone_work`, `state_id`, `city_id`, `area`, `fax_no`, `zip_code`, `description`, `photo`, `company`, `website`, `education`, `employment`, `skills`, `licence_number`, `state_licence`, `default_proposals`, `question_1`, `answer_1`, `question_2`, `answer_2`, `created_at`, `updated_at`, `franchise`, `other_franchise`, `company_name`, `years_of_expreience`, `office_address`, `brokers_name`, `MLS_public_id`, `MLS_office_id`, `real_estate_education`, `certifications`, `industry_experience`, `specialization`, `show_individual_yearly_figures`, `sales_history`, `total_sales`, `associations_awards`, `publications`, `community_involvement`, `language_proficiency`, `additional_details`, `when_u_want_to_buy`, `price_range`, `property_type`, `firsttime_home_buyer`, `specific_requirements`, `do_u_have_a_home_to_sell`, `if_so_do_you_need_help_selling`, `interested_buying`, `got_lender_approval_for_short_sale`, `bids_emailed`, `do_you_need_financing`, `need_Cash_back`, `terms_and_conditions`, `statement_document`, `agent_rating`, `buyer_rating`, `seller_rating`, `contract_verification`) VALUES
(710, 'Ankit', 'Ankit', 'Ankit', '80 Feet Rd, Mohan Nagar, Maniyawas, Jaipur, RAJISTHAN, 302020', '80 Feet Rd, Mohan Nagar, Maniyawas, Jaipur, RAJISTHAN, 302020', '+919540915536', NULL, NULL, 'RAJISTHAN', 'Jaipur', NULL, NULL, NULL, NULL, '1673850130.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-12 12:43:06', '2023-01-16 13:27:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(711, 'Prakash', 'Prakash', 'Prakash', NULL, NULL, '+919448569635', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-12 13:40:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(712, 'Prakash', 'Prakash', 'Prakash', NULL, NULL, '+919481862834', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-12 13:42:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(713, 'Madan Singh', 'Madan', 'Singh', 'Apple Street', 'Kanasa', '9880870501', NULL, NULL, '2', '4', NULL, NULL, '78881', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'Bellary', 8, 'Ranga', '2023-01-16 05:44:53', '2023-01-16 11:56:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(714, 'Bobby Stewart', 'Kiran', 'Kumar', 'Anna Nagar', 'Chennai', '9880870502', NULL, NULL, '2', '10', NULL, NULL, '98991', '<p><span style=\"color: rgb(5, 107, 235); font-family: CircularXX, &quot;Circular Pro&quot;, &quot;Helvetica Neue&quot;, Arial, sans-serif; font-size: 16px;\">038252</span><br></p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'Bellary', 8, 'Ranga', '2023-01-16 05:46:58', '2023-01-16 17:58:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(715, 'Shalini Deshpande', 'Shalini', 'Deshpande', 'Adyar Junction', 'Bangalore', '9880870503', NULL, NULL, '3', '6', NULL, NULL, '87891', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '933121', NULL, NULL, 2, 'Bellary', 8, 'Ranga', '2023-01-16 05:49:19', '2023-01-16 11:51:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(716, 'jack tompkins', 'jack tompkins', 'jack tompkins', NULL, NULL, '+16155943903', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'jack', 2, 'jack2', '2023-01-20 20:03:56', '2023-01-21 02:07:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(725, 'Pramila', 'Pramila', 'Pramila', NULL, NULL, '+919341081371', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-30 01:51:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(726, 'Pramila', 'Pramila', 'Pramila', NULL, NULL, '+916578974561', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-30 01:54:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(727, 'Mark Waugh', 'Mark Waugh', 'Mark Waugh', NULL, NULL, '+919449389608', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-30 06:07:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(728, 'Mark Waugh', 'Mark Waugh', 'Mark Waugh', NULL, NULL, '+919449389609', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-30 06:08:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(729, 'Mark Waugh', 'Mark Waugh', 'Mark Waugh', NULL, NULL, '+919448969625', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-30 06:11:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(730, 'Mark Waugh', 'Mark Waugh', 'Mark Waugh', NULL, NULL, '+91+919448569625', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-30 06:16:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(731, 'Mark Waugh', 'Mark Waugh', 'Mark Waugh', NULL, NULL, '+9109448569625', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-30 06:17:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(732, 'Chris morris', 'Chris morris', 'Chris morris', NULL, NULL, '+9109448569628', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-30 07:28:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(733, 'haider', 'haider', 'haider', NULL, NULL, '+92324 4109508', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-03 19:49:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(734, 'garima srivastava', 'garima', 'srivastava', 'test1', 'tst 2', '6545213256', NULL, NULL, '7', '8', NULL, NULL, '66546', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-04 17:53:25', '2023-02-04 23:54:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(735, 'agentG srivastava', 'agentG', 'srivastava', 'test1', 'test2', '6465465464', NULL, NULL, '2', '5', NULL, NULL, '66545', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5456654541238887773', NULL, NULL, 13, 'orange', 11, 'orange', '2023-02-04 20:17:20', '2023-03-02 22:24:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"degree\":\"bsc\",\"school\":\"asdaa\",\"from\":\"2007\",\"to\":\"2013\",\"description\":\"<p>asdasd<\\/p>\"}]', '1', '[{\"post\":\"asda\",\"organization\":\"asda\",\"from\":\"2021\",\"to\":\"2015\",\"description\":\"asdasd\"}]', '1', '0', '[{\"year\":\"2021\",\"sellers_represented\":\"22\",\"buyers_represented\":\"22\",\"total_dollar_sales\":\"22222\"}]', 22222, '', '', '', '[{\"language\":\"egnls\",\"speak\":\"Y\",\"read\":\"Y\",\"write\":\"Y\"}]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(736, 'tony tester', 'tony', 'tester', 'ad1', 'ad2', '5454554556', NULL, NULL, '2', '4', NULL, NULL, '56455', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-04 20:22:11', '2023-02-05 02:22:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(737, 'sellerG svt', 'sellerG', 'svt', 'asda', 'asd', '5465545455', NULL, NULL, '2', '4', NULL, NULL, '45754', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'asda', 11, '02/02/2022 florida', '2023-02-04 22:11:50', '2023-02-05 04:15:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(738, 'asd asd', 'asd', 'asd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-05 08:46:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(739, 'brody brickle', 'brody', 'brickle', 'sjsdf', 'asdaa', '4588855545', NULL, NULL, '2', '5', NULL, NULL, '45654', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'asda', 8, 'asdasd', '2023-02-05 09:06:43', '2023-02-05 16:10:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(752, 'hamzalast', 'hamzalast', 'hamzalast', NULL, NULL, '+923164877876', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-26 19:03:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(753, 'hamzalasts', 'hamzalasts', 'hamzalasts', NULL, NULL, '+923091141790', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-26 19:10:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(754, 'hamzalasts', 'hamzalasts', 'hamzalasts', NULL, NULL, '+923554766565', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-26 19:17:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(755, 'Anser Nawaz', 'Anser', 'Anser', NULL, NULL, '+923054100126', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-27 23:04:57', '2023-03-26 17:32:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(756, 'Alishba Aftab', 'Alishba', 'Aftab', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1677771980.jpg', NULL, NULL, '[{\"degree\":\"BS Economics\",\"school\":\"LCWU\",\"from\":\"2018\",\"to\":\"2022\",\"description\":null}]', '[{\"post\":\"BS Economics\",\"organization\":\"LCWU\",\"from\":\"2018\",\"to\":\"2022\",\"description\":null}]', '20', NULL, NULL, NULL, 8, 'Aleeshy', 13, '26091999', '2023-03-01 12:41:04', '2023-03-03 14:52:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(757, 'Alishba Aftab', 'Alishba', 'Aftab', 'Zubaida park multan road lahore', 'Zubaida park multan road lahore', '0319713773', NULL, NULL, '2', '10', NULL, NULL, '25800', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2580', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-01 13:54:38', '2023-03-01 19:57:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(758, 'Alishba Aftab', 'Alishba', 'Aftab', 'Zubaida park multan road lahore', 'Zubaida park multan road lahore', '0319713773', NULL, NULL, '2', '11', NULL, NULL, '25800', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2580', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-01 17:45:49', '2023-03-01 23:46:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(759, 'garima srivastava', 'garima', 'srivastava', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-02 07:21:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(760, 'richard tester', 'richard', 'tester', 'testt', 'testt2', '5214565452', NULL, NULL, '3', '6', NULL, NULL, '32154', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-02 16:05:38', '2023-03-02 22:08:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(761, 'kevin tester', 'kevin', 'tester', 'test', 'test 234', '2541542145', NULL, NULL, '2', '4', NULL, NULL, '25412', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'k', 13, 'k2', '2023-03-02 19:02:12', '2023-03-03 01:04:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(762, 'patric test', 'patric', 'test', 'jeter', 'jeosnndei', '8823569912', NULL, NULL, '2', '4', NULL, NULL, '23598', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'patric', 11, '2012', '2023-03-03 08:09:16', '2023-03-03 17:58:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(763, 'maria john', 'maria', 'john', 'jdfkfld', 'joekkld,cggfg', '7892586321', NULL, NULL, '2', '4', NULL, NULL, '25891', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '152979', NULL, NULL, 8, 'maria', 11, '2012', '2023-03-03 09:47:56', '2023-03-04 19:48:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"degree\":\"BE\",\"school\":\"test\",\"from\":\"2020\",\"to\":\"2011\",\"description\":\"test\"}]', '2', '[{\"post\":\"test\",\"organization\":\"test t\",\"from\":\"2009\",\"to\":\"2017\",\"description\":\"test\"}]', '1', '0', '[{\"year\":\"2009\",\"sellers_represented\":\"2\",\"buyers_represented\":\"2\",\"total_dollar_sales\":\"14\"}]', 14, '', '', '', '[{\"language\":\"english\",\"speak\":\"Y\",\"read\":\"Y\",\"write\":\"Y\"}]', '<p>test</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(764, 'luthra tester', 'luthra', 'tester', 'hytr', 'higui', '5896598475', NULL, NULL, '2', '4', NULL, NULL, '25987', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'asdasd', 11, 'asa', '2023-03-04 15:15:08', '2023-03-05 01:51:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(765, 'Alishba Aftab', 'Alishba', 'Aftab', 'Zubaida park multan road lahore', 'Zubaida park multan road lahore', '0319713773', NULL, NULL, '2', '11', NULL, NULL, '25800', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-04 19:49:05', '2023-03-05 01:49:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(766, 'Jessica Porsche', 'Jessica Porsche', 'Jessica Porsche', NULL, NULL, '+1615-594-3903', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-12 00:06:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(767, 'Ritu_Test bhfbjfhj wewnewmnwe em,em,me ewm,ewm,m, qmnqmnmq emnemnemn ememenm ewmnemne  wemnemnwemn qw,mq,m,mq ewmnwemnwmn wemnewmnmne qmnqmm wm,ewm,ew,m qm,we,mwe,m qe,mewmnewnm q,mewmenwm ,me wemewmn we,mrmnr e mewmew ewm,ew,m,mew wmewm,mweklemne e,m,me', 'Test', 'Ritz', 'nebf jwebfjsf qkefows kwnef qknwe semnfse mwkwer msndv wkenf dlkweewi slwelkwn weoow3o vlkvmvb wldkkir gvk', '', '8920703985', NULL, NULL, '7', '8', NULL, NULL, '66012', 'ew efwhffffffff fwewbhhhhwfeee  enen ewnewn wemnew wemnew wemme wm,we mw', '1678726024.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'Ritu', 11, '15/09/1996', '2023-03-12 07:50:41', '2023-03-18 17:22:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(768, 'Ritu Tester', 'Ritu', 'Tester', 'Kansan', '', '7894561236', NULL, NULL, '7', '8', NULL, NULL, '66012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-12 07:56:39', '2023-03-12 12:57:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(769, 'RituK Tester', 'RituK', 'Tester', 'XTe', '', '7845123698', NULL, NULL, '7', '8', NULL, '0121858112', '66012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7F864D85D', NULL, NULL, 8, 'Ritu', 11, '15/09/1980', '2023-03-12 08:07:53', '2023-03-18 18:17:53', '2', NULL, 'FR$V', '5 -10', 'Time Building', 'Sumit', '7895676', '54548776', '[{\"degree\":\"jhjg\",\"school\":\"jhjugjug\",\"from\":\"2011\",\"to\":\"2018\",\"description\":\"<p>fdffg vcvbgv bnfgf bvfdrt waesrdtfgyuhijokpl szzxcgvhbjnkml, sedrftyguhjk sedfghbjnkm, xdcfvghbjnkm,<\\/p>\"}]', '2', '[{\"post\":\"dfghjk\",\"organization\":\"dfghjk\",\"from\":\"2010\",\"to\":\"2016\",\"description\":\"resdfg;lkhgfckjl;kjhgx\"}]', '2,19', '0', '[{\"year\":\"2015\",\"sellers_represented\":\"3\",\"buyers_represented\":\"98\",\"total_dollar_sales\":\"123456\"}]', 123456, '', '', '', '[{\"language\":\"Eng\",\"speak\":\"Y\",\"read\":\"Y\",\"write\":\"Y\"}]', '<p>esdfghjkl; fdghjnkm,.</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 'https://dev.92agents.com/assets/img/agents_pdf/1678608636.pdf', NULL, NULL, NULL, 1),
(770, 'hdjdj', 'hdjdj', 'hdjdj', NULL, NULL, '+9282888282882', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-13 17:19:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(771, 'Alishba Aftab', 'Alishba', 'Aftab', 'Zubaida park multan road lahore', 'Zubaida park multan road lahore', '0319713773', NULL, NULL, '2', '11', NULL, NULL, '25800', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-14 09:32:24', '2023-03-14 14:32:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(772, 'Test Bsg', 'Test', 'Bsg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-15 14:41:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(773, 'Anuradha Bansal', 'Anuradha', 'Bansal', 'sgfd', 'sad sd', '0987654321', NULL, NULL, '2', '4', NULL, NULL, '11121', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'Anu', 11, 'delhi', '2023-03-16 05:49:53', '2023-03-16 10:55:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(774, 'Santosh Singh', 'Santosh', 'Singh', 'Delhi', '', '8952634178', NULL, NULL, '12', '13', NULL, NULL, '32818', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FCRW5793', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-16 17:07:00', '2023-03-16 22:08:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(775, 'manoj mehta', 'manoj', 'mehta', 'jaipur', 'vashli nagar', '9024266200', NULL, NULL, '2', '4', NULL, NULL, '30202', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'manoj', 11, 'jaipur', '2023-03-22 02:33:27', '2023-03-22 07:36:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(776, 'manoj mehta', 'manoj', 'mehta', 'abc', 'abc', '9024266200', NULL, NULL, '2', '4', NULL, NULL, '22222', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'manoj', 11, 'jaipur', '2023-03-27 02:23:15', '2023-03-27 07:31:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(777, 'manojk mehta', 'manojk', 'mehta', 'abc', 'abc', '9024266200', NULL, NULL, '2', '4', NULL, NULL, '22222', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'manoj', 11, 'jaipur', '2023-03-27 02:51:53', '2023-03-27 07:58:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(778, 'manojagent mehta', 'manojagent', 'mehta', 'abc', 'abc', '9024266200', NULL, NULL, '2', '4', NULL, NULL, '30202', NULL, NULL, NULL, NULL, '[{\"degree\":\"btech\",\"school\":\"asdad\",\"from\":\"2012\",\"to\":\"2020\",\"description\":\"asdads\"}]', '[{\"post\":\"asdasd\",\"organization\":\"sdads\",\"from\":\"2009\",\"to\":\"2012\",\"description\":\"adsad\"}]', '1,2,3,4,5,6', 'abc123', NULL, NULL, 8, 'manoj', 11, 'jaipur', '2023-03-27 03:03:04', '2023-03-27 08:12:23', NULL, NULL, 'hybridplus', '1 - 5', 'abc', 'manoj broker', 'mls123', 'Mls123', '[{\"degree\":\"b.tech\",\"school\":\"rtu\",\"from\":\"2013\",\"to\":\"2017\",\"description\":\"<p>abc<\\/p>\"}]', '1', '[{\"post\":\"dfsf\",\"organization\":\"hgfhgv\",\"from\":\"2015\",\"to\":\"2023\",\"description\":\"sdfsdf\"}]', '1', '0', '[{\"year\":\"2014\",\"sellers_represented\":\"2\",\"buyers_represented\":\"2\",\"total_dollar_sales\":\"99998\"}]', 99998, 'dfsfsdfs', 'sdfsdf', 'sdfsdf,==,sdfsdf', '[{\"language\":\"english\",\"speak\":\"Y\",\"read\":\"Y\",\"write\":\"Y\"}]', '<p>adasfsdfsf</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 'https://dev.92agents.com/assets/img/agents_pdf/1679886402.pdf', NULL, NULL, NULL, 1),
(779, 'prumin stain', 'prumin', 'stain', 'bellari', 'south ex', '5896546622', NULL, NULL, '2', '4', NULL, NULL, '58965', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'puru', 11, '20dec', '2023-04-13 05:00:09', '2023-04-13 10:05:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(780, 'tester agent', 'tester', 'agent', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-13 09:23:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(781, 'test aagent', 'test', 'aagent', 'asdjashdasd', 'ashaha', '4521325656', NULL, NULL, '5', '8', NULL, NULL, '45854', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-13 09:33:38', '2023-04-13 14:34:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(782, 'testing agent', 'testing', 'agent', 'asdasda', 'asdasda', '4564545444', NULL, NULL, '7', '8', NULL, NULL, '21325', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5454655454564565645646554564', NULL, NULL, 8, 'asdf', 18, 'asdasd', '2023-04-13 09:47:50', '2023-04-13 14:57:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(783, 'sellertest sellerz', 'sellertest', 'sellerz', 'asdasd', 'asdasj', '4546545545', NULL, NULL, '2', '5', NULL, NULL, '45454', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, 'asdas', 8, 'asdasdasd', '2023-04-13 10:05:35', '2023-04-13 15:09:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(784, 'seller test', 'seller', 'test', 'asdasd', 'asdasd', '4584556564', NULL, NULL, '3', '6', NULL, NULL, '45545', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, 'abc', 19, 'abca', '2023-04-13 10:18:43', '2023-04-13 15:21:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(785, 'agent test', 'agent', 'test', 'asdasdasd', '', '4545455251', NULL, NULL, '3', '6', NULL, NULL, '45412', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4512545221333566487951586655', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-13 11:03:12', '2023-04-13 16:03:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(786, 'agent testing ida', 'agent testing', 'ida', 'asadasd', 'dsasd', '4541254545', NULL, NULL, '2', '10', NULL, NULL, '12541', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '554564856', NULL, NULL, 8, 'asdasd', 11, 'anv', '2023-04-13 11:05:30', '2023-04-13 16:57:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"degree\":\"bsc\",\"school\":\"asdasd\",\"from\":\"2020\",\"to\":\"2017\",\"description\":\"<p>asdasdasdasd<\\/p>\"}]', '2', '[{\"post\":\"asdasd\",\"organization\":\"asdasd\",\"from\":\"2017\",\"to\":\"2023\",\"description\":\"asdasd\"}]', '1', '0', '[{\"year\":\"2009\",\"sellers_represented\":\"1000\",\"buyers_represented\":\"100000\",\"total_dollar_sales\":\"123232\"}]', 123232, '', '', '', '[{\"language\":\"english\",\"speak\":\"Y\",\"read\":\"Y\",\"write\":\"Y\"}]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(787, 'Akash agent', 'Akash', 'agent', 'jaipur', 'jaipur', '9729280110', NULL, NULL, '3', '6', NULL, NULL, '32145', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5456555', NULL, NULL, 21, 'Jhunjuhu', 8, 'akki', '2023-04-28 11:13:10', '2023-05-01 12:02:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[1,2]', NULL, '1', '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(788, 'Dheeraj Kumawat', 'Dheeraj', 'Kumawat', 'A-37 PANI KI TANKI', 'SHASTRI NAGAR JAIPUR', '8619052626', NULL, NULL, '3', '6', NULL, NULL, '45678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1234567asdfghj', NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-01 07:05:18', '2023-05-01 12:13:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(789, 'gdhd', 'gdhd', 'gdhd', NULL, NULL, '12345678976', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-12 05:46:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(790, 'Rajesh', 'Rajesh', 'Rajesh', NULL, NULL, '9549712232', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-12 07:07:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(791, 'nunu', 'nunu', 'nunu', NULL, NULL, '9922336655', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-12 07:29:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(792, 'gm', 'gm', 'gm', NULL, NULL, '1234543211', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-12 07:33:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(793, 'nel', 'nel', 'nel', NULL, NULL, '3466775433', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-12 07:39:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(794, 'gdhd1234', 'gdhd1234', 'gdhd1234', NULL, NULL, '1465788765', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-12 07:46:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(795, 'gdhd123', 'gdhd123', 'gdhd123', NULL, NULL, '9829115634', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-12 07:50:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(796, 'lolu', 'lolu', 'lolu', NULL, NULL, '1122334455', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-12 07:52:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(797, 'gdhd123', 'gdhd123', 'gdhd123', NULL, NULL, '9829115636', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-12 07:57:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(798, 'vv', 'vv', 'vv', NULL, NULL, '123457890', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-12 07:57:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(799, 'v', 'v', 'v', NULL, NULL, '12345790', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-12 08:02:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(800, 'vr', 'vr', 'vr', NULL, NULL, '123457901', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-12 08:03:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(801, 'vrq', 'vrq', 'vrq', NULL, NULL, '1234579011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-12 08:06:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(802, 'vrqp', 'vrqp', 'vrqp', NULL, NULL, '12345790116', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-12 08:07:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(803, 'qp', 'qp', 'qp', NULL, NULL, '345790116', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-12 08:18:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(804, 'qp', 'qp', 'qp', NULL, NULL, '34570116', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-12 08:25:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(805, 'qpp', 'qpp', 'qpp', NULL, NULL, '3457011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-12 08:27:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(806, 'aa', 'aa', 'aa', NULL, NULL, '34570111', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-12 08:29:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(807, 'vikas', 'vikas', 'vikas', NULL, NULL, '434334334334', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-12 10:56:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(808, 'vikass', 'vikass', 'vikass', NULL, NULL, '4457766445', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-13 05:50:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(809, 'newagent newnew', 'newagent', 'newnew', 'India in india in india', 'from idia to india', '6789054320', NULL, NULL, '3', '6', NULL, NULL, '65789', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '77777777777777777777777777777777777777777777777777', NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-13 12:09:22', '2023-05-15 15:36:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(810, 'lala', 'lala', 'lala', NULL, NULL, '9988776655', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'Sunit', 21, 'Jaipur', '2023-05-15 07:33:38', '2023-05-19 16:45:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(811, 'lal', 'lal', 'lal', NULL, NULL, '988776655', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-15 07:39:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(812, 'bilu', 'bilu', 'bilu', NULL, NULL, '1111222233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-15 07:41:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(813, 'gderttyy', 'gderttyy', 'gderttyy', NULL, NULL, '7878790787', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-15 07:43:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(814, 'gderttyy', 'gderttyy', 'gderttyy', NULL, NULL, '7878790734', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-18 07:48:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(815, 'gderttyy', 'gderttyy', 'gderttyy', NULL, NULL, '7878790733', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-18 07:48:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(816, 'gderttyy', 'gderttyy', 'gderttyy', NULL, NULL, '7878790722', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-18 08:02:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(817, 'user1', 'user1', 'user1', NULL, NULL, '6949484757', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-18 08:31:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(818, 'viki', 'viki', 'viki', NULL, NULL, '2233445566', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-18 10:10:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(819, 'vi', 'vi', 'vi', NULL, NULL, '22334455', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-18 10:13:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(820, 'v', 'v', 'v', NULL, NULL, '2233445', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-18 10:16:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(821, 'ki', 'ki', 'ki', NULL, NULL, '0909090909', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-18 10:18:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(822, 'mi', 'mi', 'mi', NULL, NULL, '2211221122', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-18 11:36:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(823, 'user', 'user', 'user', NULL, NULL, '1122112211', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-18 11:46:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(824, 'q', 'q', 'q', NULL, NULL, '1234512345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-18 11:50:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(825, 'user3', 'user3', 'user3', NULL, NULL, '000999888', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-18 12:03:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(826, 'user4', 'user4', 'user4', NULL, NULL, '00099988', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-18 12:06:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(827, 'gderttyy', 'gderttyy', 'gderttyy', NULL, NULL, '9093593511', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-19 06:41:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(828, 'ashish mishra', 'ashish', 'mishra', 'testing address1', 'test seller add 2', '5484545545', NULL, NULL, '3', '6', NULL, NULL, '52145', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'abcd', 11, 'india', '2023-06-02 17:31:04', '2023-06-02 22:33:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(829, 'buyer tester', 'buyer', 'tester', 'asdjadakjsda', 'asdadhasd', '5454545454', NULL, NULL, '7', '8', NULL, NULL, '42145', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, 'abcd', 21, 'njd', '2023-06-03 08:42:49', '2023-06-03 14:00:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0);
INSERT INTO `agents_users_details` (`details_id`, `name`, `fname`, `lname`, `address`, `address2`, `phone`, `phone_home`, `phone_work`, `state_id`, `city_id`, `area`, `fax_no`, `zip_code`, `description`, `photo`, `company`, `website`, `education`, `employment`, `skills`, `licence_number`, `state_licence`, `default_proposals`, `question_1`, `answer_1`, `question_2`, `answer_2`, `created_at`, `updated_at`, `franchise`, `other_franchise`, `company_name`, `years_of_expreience`, `office_address`, `brokers_name`, `MLS_public_id`, `MLS_office_id`, `real_estate_education`, `certifications`, `industry_experience`, `specialization`, `show_individual_yearly_figures`, `sales_history`, `total_sales`, `associations_awards`, `publications`, `community_involvement`, `language_proficiency`, `additional_details`, `when_u_want_to_buy`, `price_range`, `property_type`, `firsttime_home_buyer`, `specific_requirements`, `do_u_have_a_home_to_sell`, `if_so_do_you_need_help_selling`, `interested_buying`, `got_lender_approval_for_short_sale`, `bids_emailed`, `do_you_need_financing`, `need_Cash_back`, `terms_and_conditions`, `statement_document`, `agent_rating`, `buyer_rating`, `seller_rating`, `contract_verification`) VALUES
(830, 'agent testing', 'agent', 'testing', 'asdasda', 'asdasdjasd', '4545121542', '5455454545', '9125555545', '5', '14', NULL, NULL, '12457', 'asdasdasdasdasdasd', NULL, NULL, NULL, NULL, NULL, NULL, '1235512555125512551255125512', NULL, NULL, 8, 'abcd', 8, 'abcd', '2023-06-03 08:54:24', '2023-06-03 15:46:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(831, 'seller bazar', 'seller', 'bazar', 'asdfghgfd', 'sdfghjjhgfd', '9780654321', NULL, NULL, '6', '14', NULL, NULL, '30201', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-08 06:33:54', '2023-06-08 11:34:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(832, 'ndjbs hjgh', 'ndjbs', 'hjgh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-10 09:18:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, '5', '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(833, 'demo user', 'demo', 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-13 06:29:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(834, 'demo2', 'demo2', 'demo2', NULL, NULL, '7744558899', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-13 07:52:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(835, 'demo12', 'demo12', 'demo12', 'address one', 'address two', '9564585455', NULL, NULL, '5', '14', NULL, NULL, '989878', 'this is a demo discreption', '1689769218.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'sunit', 21, 'jaipur', '2023-07-14 06:50:01', '2023-07-28 17:35:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(836, 'demo13', 'demo13', 'demo13', NULL, NULL, '8588848889', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-17 06:38:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(837, 'Demo new', 'Demo', 'new', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-17 07:05:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(838, 'qwer qwert', 'qwer', 'qwert', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-17 07:14:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(839, 'qwer qwert', 'qwer', 'qwert', 'a-37 hatri nagar jaipur', NULL, '9876545690', '9870654321', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1689667007.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21, 'Jaipur', 22, 'Jaipur', '2023-07-17 07:52:06', '2023-07-27 11:18:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(840, 'Jaidev Patel', 'Jaidev', 'Patel', 'Street No.2', 'Sanganakal road', '9880870505', NULL, NULL, '7', '8', NULL, NULL, '89011', '<h2><span style=\"background-color: rgb(156, 0, 255);\"><b>Seller with 20 years of selling experience.</b></span></h2>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'Smitha Q', 8, 'Smitha    q', '2023-07-31 07:08:56', '2023-08-16 12:03:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(841, 'Satish Pai', 'Satish', 'Pai', 'Apt No.11', 'Srinivasanagar', '9448569625', NULL, NULL, '2', '5', NULL, NULL, '12312', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'Sanil', 21, 'Bellary', '2023-08-01 10:55:09', '2023-08-01 15:58:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(842, 'Seena Nayak', 'Seena', 'Nayak', 'Flat No. 34', 'Bandra', '9341081371', NULL, NULL, '2', '4', NULL, NULL, '99911', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '89900210301', NULL, NULL, 8, 'srusthi', 21, 'bellary', '2023-08-01 11:03:05', '2023-08-01 16:05:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(843, 'Kamala Jain', 'Kamala', 'Jain', 'Apt No.890', 'Texas', '8909012312', NULL, NULL, '2', '4', NULL, '293912391', '90121', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '219312932912', NULL, NULL, 8, 'smitha', 11, 'Bellary', '2023-08-01 11:06:19', '2023-08-08 10:45:21', '1', NULL, 'Rently', 'greater than 10', 'Apt No.122', 'Robert', '1283128381283', '12838128312', NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 'https://dev.92agents.com/assets/img/agents_pdf/1691392025.pdf', NULL, NULL, NULL, 1),
(844, 'Robert Broad', 'Robert', 'Broad', 'Apt No.3', 'Kent', '8123812831', NULL, NULL, '2', '4', NULL, NULL, '83219', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23812831283', NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-01 12:08:42', '2023-08-01 17:09:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(845, 'Radha Vishal', 'Radha', 'Vishal', 'Kent', 'UK', '7873721883', NULL, NULL, '2', '4', NULL, NULL, '13281', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3473274732234', NULL, NULL, 8, 'Smitha', 11, 'Raj', '2023-08-09 04:20:24', '2023-08-09 16:29:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(846, 'Raj Singh', 'Raj', 'Singh', 'Ap No. 34', '', '1283821381', NULL, NULL, '3', '4', NULL, NULL, '12312', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'Smitha', 11, 'Smitha1', '2023-08-09 10:38:35', '2023-08-09 15:40:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(847, 'Alan Lam', 'Alan', 'Lam', '23123', '', '2942394923', NULL, NULL, '7', '8', NULL, NULL, '12312', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13123123123', NULL, NULL, 8, 'smitha', 21, 'bellary', '2023-08-17 10:01:39', '2023-08-17 15:06:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(848, 'Buyer Buyer', 'Buyer', 'Buyer', 'A-37 PANI KI TANKI new nirmaJAIPUR', 'qwereqfd234543', '8619052612', NULL, NULL, '3', '6', NULL, NULL, '30201', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-18 07:16:46', '2023-08-18 12:17:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(849, 'Agent Agent', 'Agent', 'Agent', 'A-37 PANI KI TANKI QWERTYUI', 'WERBNMHJK', '8619053333', NULL, NULL, '3', '6', NULL, NULL, '30201', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QWER456LLO908', NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-18 07:20:03', '2023-08-18 12:20:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(850, 'srinivas Manchikatla', 'srinivas', 'Manchikatla', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-30 12:37:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(851, 'SAVAN RATHOD', 'SAVAN', 'RATHOD', '4308,KUMBHAR STREET, RUPAPARI\'S POLE, DARIYAPUR', 'Dariyapur', '6353671482', NULL, NULL, '2', '5', NULL, NULL, '12345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-14 18:20:39', '2023-09-14 23:21:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(852, 'jinal rathod', 'jinal', 'rathod', 'test', 'test', '1234567897', NULL, NULL, '2', '4', NULL, NULL, '12345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1235dfdsfkj', NULL, NULL, 8, '1234', 19, '12345', '2023-09-14 18:52:40', '2023-09-15 00:17:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(853, 'Sarah Johnson', 'Sarah', 'Johnson', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'sarah', 21, 'US', '2023-09-18 05:08:36', '2023-09-30 19:57:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(854, 'Vignesh Selvan', 'Vignesh', 'Selvan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-10 08:51:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(855, 'Vignesh Selvan', 'Vignesh', 'Selvan', 'Ayanavaram', '', '8667680532', NULL, NULL, '2', '10', NULL, NULL, '60002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'Vicky', 11, 'Chennai 12 Dec', '2023-11-10 08:52:54', '2023-11-10 15:13:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(856, 'Anu Anu', 'Anu', 'Anu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-30 11:47:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(857, 'Anu Anu', 'Anu', 'Anu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-02 06:49:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(858, 'Anu Anu', 'Anu', 'Anu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-02 06:55:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(859, 'Abi Abi', 'Abi', 'Abi', 'Kirkland', '', '9987654321', NULL, NULL, '5', '14', NULL, NULL, '98033', '<p><span style=\"color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, Ubuntu, Cantarell, &quot;Noto Sans&quot;, sans-serif, &quot;Helvetica Neue&quot;, Arial, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; white-space-collapse: preserve;\">Join our community of travelers and discover a world of convenience and comfort. Let\'s embark on a journey together, where the right accessories transform ordinary trips into extraordinary adventures.</span><br></p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'Gayu', 21, 'Chennai', '2023-12-02 08:14:44', '2023-12-06 12:27:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(860, 'Aji Aji', 'Aji', 'Aji', 'Maple Valley', '', '5678904321', NULL, NULL, '5', '14', NULL, NULL, '98038', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1234567890', NULL, NULL, 8, 'Gayu', 21, 'Chennai', '2023-12-02 08:38:10', '2023-12-02 14:41:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(861, 'Anu Anu', 'Anu', 'Anu', 'council grove', '', '6780987600', NULL, NULL, '7', '8', NULL, NULL, '66846', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'Gayu', 21, 'Chennai', '2023-12-07 09:32:59', '2023-12-07 15:35:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(862, 'ghg hgh', 'ghg', 'hgh', '11', '11', '1212121212', NULL, NULL, '2', '4', NULL, NULL, '11111', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-05 11:10:45', '2024-01-05 17:11:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(863, 'Udit Narayan', 'Udit', 'Narayan', 'c 1210 kailas business park', '', '7977949488', NULL, NULL, '2', '10', NULL, NULL, '45678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'Udit', 21, 'Alaska', '2024-01-09 09:54:44', '2024-01-09 16:08:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(864, 'Dheeraj Kumar', 'Dheeraj', 'Kumar', 'Raghopur', '', '8699661073', NULL, NULL, '2', '5', NULL, NULL, '85211', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'Udit', 21, 'Alaska', '2024-01-09 10:20:36', '2024-01-09 16:26:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(865, 'Dheeraj Kumar', 'Dheeraj', 'Kumar', 'c 1210 kailas business park', '', '7977949488', NULL, NULL, '2', '4', NULL, NULL, '40007', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AL90876', NULL, NULL, 8, 'Udit', 21, 'Alaska', '2024-01-09 10:28:49', '2024-01-09 16:46:08', '1', NULL, 'avc', '5 -10', 'c 1210 kailas business park', 'acl kj', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 'https://dev.92agents.com/assets/img/agents_pdf/1704797167.pdf', NULL, NULL, NULL, 1),
(866, 'API Test user fname API Test user lname', 'API Test user fname', 'API Test user lname', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Sam', 2, 'Ahmedabad', '2024-01-19 04:44:00', '2024-01-19 12:31:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(867, 'dsff dsfsdf', 'dsff', 'dsfsdf', '1500 PACKING HOUSE RD TALBOTTON GA 31827-9008 USA', '', '2025550104', NULL, NULL, '2', '5', NULL, NULL, '30010', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4234', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-22 14:12:43', '2024-01-22 20:13:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(868, 'swapneel thakor', 'swapneel', 'thakor', 'testing address', 'testing address', '9090909090', NULL, NULL, '2', '4', NULL, NULL, '38000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-24 05:26:40', '2024-01-24 11:27:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(869, 'hemant ganesh', 'hemant', 'ganesh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-26 11:36:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(870, 'hemant ganesh', 'hemant', 'ganesh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-26 11:47:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(871, 'hemant ganesh', 'hemant', 'ganesh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-26 11:55:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(872, 'babu', 'tester', 'test2', 'fadsfsd', 'dfasd', 'fdasfsfs', 'dsaf', 'fasfs', '2', '2', NULL, 'fas', 'fas', 'hemant', '1706288481.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-26 14:09:24', '2024-01-26 22:50:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(873, 'Poonam Divedi', 'Poonam', 'Divedi', 'uqeuwuerew', '', '8789999999', NULL, NULL, '7', '8', NULL, NULL, '12312', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'smitha', 11, 'Bellary', '2024-02-04 11:37:56', '2024-02-06 11:08:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(874, 'jess porsche', 'jess', 'porsche', '813 somewhere st', '', '6155943903', NULL, NULL, '5', '14', NULL, NULL, '37211', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-05 06:07:16', '2024-02-05 12:10:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(875, 'rehan anim', 'rehan', 'anim', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-05 06:19:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(876, 'rehan anim', 'rehan', 'anim', 'Ecity', '', '9513804613', NULL, NULL, '2', '5', NULL, NULL, '08400', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-05 06:20:34', '2024-02-05 12:21:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(877, 'Shariff Rizwan', 'Shariff', 'Rizwan', 'wyryewrywey', 'weyryewyrywe', '1293912391', NULL, NULL, '2', '4', NULL, NULL, '21312', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'smitha', 11, 'Bellary', '2024-02-06 09:28:20', '2024-02-06 15:29:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(878, 'Kasi Ravi', 'Kasi', 'Ravi', '12381238182', '1283812381', '9888912991', NULL, NULL, '2', '4', NULL, 'asda1', '12312', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '667777777', NULL, NULL, 11, 'bellary', 8, 'guru', '2024-02-06 13:03:26', '2024-02-07 13:21:29', NULL, NULL, 'asa', '1 - 5', 'asasdsaf', '12312', '12312', '12312', NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 'https://dev.92agents.com/assets/img/agents_pdf/1707290488.pdf', NULL, NULL, NULL, 1),
(879, 'Buyer Person', 'Buyer', 'Person', '91/A Old Jenyns Road Liluah Railway Colony', '', '9038294698', NULL, NULL, '2', '4', NULL, NULL, '71120', NULL, NULL, NULL, NULL, NULL, NULL, '1', 'asdafsa', NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-06 16:19:27', '2024-02-26 19:56:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(880, 'Buyer Test', 'Buyer', 'Test', 'saf', '', '1234567890', NULL, NULL, '2', '4', NULL, NULL, '12345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-07 03:35:31', '2024-02-07 09:35:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(881, 'rehan anim', 'rehan', 'anim', 'Flat 301', '', '9451384623', NULL, NULL, '2', '5', NULL, NULL, '56212', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AGH135', NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-08 09:13:01', '2024-02-08 15:13:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(882, 'sell das', 'sell', 'das', 'asfdasf', 'asfasfasf', '9036245612', NULL, NULL, '2', '4', NULL, NULL, '12345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-13 17:53:04', '2024-02-13 23:53:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(883, 'buyer das', 'buyer', 'das', 'safgag', 'asfasf', '0123456789', NULL, NULL, '2', '4', NULL, NULL, '12345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'sfaf', 11, 'sfa', '2024-02-13 22:27:41', '2024-02-23 19:33:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(884, 'Modrich Kevin', 'Modrich', 'Kevin', '12312321', '121', '1831281232', NULL, NULL, '2', '4', NULL, NULL, '12312', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19, 'ad', 21, 'sdad', '2024-02-20 05:35:08', '2024-02-21 15:46:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(885, 'Pavan Kumar', 'Pavan', 'Kumar', 'dsbfsdfhsdH', 'SHHSHFDS', '8218128283', NULL, NULL, '3', '6', NULL, NULL, '28282', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-20 05:37:29', '2024-02-20 11:37:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(886, 'Lakshmikant Pavan', 'Lakshmikant', 'Pavan', '273747732', '', '3248238421', NULL, NULL, '2', '4', NULL, NULL, '23321', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23487328748723', NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-20 05:39:26', '2024-02-20 11:39:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(887, 'Soumen Mondal', 'Soumen', 'Mondal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-23 01:30:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(888, 'Rseller Rseller', 'Rseller', 'Rseller', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-03 08:41:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(889, 'vikrant singh', 'vikrant', 'singh', 'abcd', '', '7384134971', NULL, NULL, '2', '5', NULL, NULL, '73400', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-09 07:47:15', '2024-03-09 13:47:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(890, 'vikrant singh', 'vikrant', 'singh', 'iOygdyfh6j', 'CaTGEwgiFx', '0667991649', NULL, NULL, '5', '14', NULL, NULL, '94464', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-09 08:06:08', '2024-03-09 14:06:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(891, 'vikrant singh', 'vikrant', 'singh', 'dWpYIWdCdm', 'cvbYRrzmLt', '7926049369', NULL, NULL, '7', '8', NULL, NULL, '94464', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5234553980', NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-09 08:08:36', '2024-03-09 14:09:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(892, 'Test Buyer', 'Test', 'Buyer', 'Test House', 'Test Address', '9123456789', NULL, NULL, '5', '14', NULL, NULL, '70011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-22 07:11:14', '2024-03-22 12:12:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(893, 'Sankar Dey', 'Sankar', 'Dey', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-23 07:20:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(894, 'Sankar Dey', 'Sankar', 'Dey', 'Akshya Nagar 1st Block 1st Cross, Rammurthy nagar', '', '9830742823', NULL, NULL, '2', '4', NULL, NULL, '70005', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-23 07:24:00', '2024-03-23 12:24:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(895, 'Sankar Dey', 'Sankar', 'Dey', 'Akshya Nagar 1st Block 1st Cross, Rammurthy nagar', '', '9830742823', NULL, NULL, '2', '10', NULL, NULL, '70005', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'Sankar', 11, 'Kolkata', '2024-03-23 07:28:50', '2024-03-26 13:28:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(896, 'Virali Shah', 'Virali', 'Shah', '6430 abcabcabc', '', '1234567891', NULL, NULL, '12', '13', NULL, NULL, '92707', 'Hi Lorem Ipsum', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'testcan', 21, 'CA', '2024-03-23 21:41:30', '2024-03-24 03:12:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(897, 'satish Mendapara', 'satish', 'Mendapara', 'san fransisco', 'SF', '9898989889', NULL, NULL, '2', '4', NULL, NULL, '12345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-26 14:14:34', '2024-03-26 19:16:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(898, 'Agent Zero', 'Agent', 'Zero', 'Text Address', '', '9876543210', NULL, NULL, '3', '6', NULL, NULL, '12345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '123', NULL, NULL, 11, '31051994', 8, 'Humpty', '2024-03-27 17:01:05', '2024-03-27 22:08:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(899, 'Agent FortySeven', 'Agent', 'FortySeven', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-28 14:37:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(900, 'test test', 'test', 'test', 'test address', 'test address test', '9876543210', NULL, NULL, '2', '5', NULL, NULL, '12345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '123456', NULL, NULL, NULL, NULL, NULL, NULL, '2024-04-07 17:33:14', '2024-04-07 22:34:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(901, 'test test', 'test', 'test', 'test', 'test', '9876543210', NULL, NULL, '2', '5', NULL, NULL, '12345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'test', 21, 'test1', '2024-04-09 06:21:54', '2024-04-09 11:23:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(902, 'Arup mondal', 'Arup', 'mondal', 'kbkj;k;kkpok', '', '9831146486', NULL, NULL, '5', '14', NULL, NULL, '98001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-04-24 07:05:08', '2024-04-24 12:06:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(903, 'kaktua tester', 'kaktua', 'tester', '11 b pearl road', 'kolkata', '9153336581', NULL, NULL, '5', '14', NULL, NULL, '30224', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'sdff', 11, '34535', '2024-04-24 14:07:02', '2024-04-24 19:08:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(904, 'Projjwal SENGUPTA', 'Projjwal', 'SENGUPTA', '64 M M GHOSH STREET(Genesis Infotech)', '', '9932122999', NULL, NULL, '2', '4', NULL, NULL, '45455', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'tuya', 11, 'krishnagar', '2024-05-04 07:44:47', '2024-05-04 12:54:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(905, 'Test Kbtest', 'Test', 'Kbtest', 'adsds dsjd asjhajs', '', '9999999999', NULL, NULL, '2', '4', NULL, NULL, '12343', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'asasas22121122121', NULL, NULL, 8, 'kb', 11, 'stp', '2024-05-04 07:47:28', '2024-05-04 12:52:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(906, 'test seller', 'test', 'seller', 'fftfgfgfg', '', '9999999999', NULL, NULL, '2', '4', NULL, NULL, '12233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'ts', 11, 'stp', '2024-05-04 13:10:49', '2024-05-04 18:13:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(907, 'Harry Singh', 'Harry', 'Singh', '152 dfdsfdfs', 'sdfsdfsfewdf', '7894651325', NULL, NULL, '12', '13', NULL, NULL, '15262', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 'None', 21, 'None2', '2024-05-16 04:27:23', '2024-05-16 09:30:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0),
(908, 'Viresh Gupta', 'Viresh', 'Gupta', 'Haryana', '', '1236547890', NULL, NULL, '5', '14', NULL, NULL, '32145', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9865207852023', NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-14 16:34:12', '2024-07-14 21:38:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `agents_users_roles`
--

CREATE TABLE `agents_users_roles` (
  `role_id` int NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '1 = active, 0= deactive',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 = no, 1= yes',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents_users_roles`
--

INSERT INTO `agents_users_roles` (`role_id`, `role_name`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '1', '0', '2017-10-05 08:50:09', '2017-10-05 08:50:09'),
(2, 'Buyer', '1', '0', '2017-10-05 08:50:09', '2017-10-05 08:50:39'),
(3, 'Seller', '1', '0', '2017-10-05 08:50:09', '2017-10-05 08:50:48'),
(4, 'Agent', '1', '0', '2017-10-05 08:50:09', '2017-10-05 08:50:54'),
(5, 'New User', '1', '0', '2017-10-05 08:50:09', '2017-10-05 08:50:09'),
(6, 'Employee', '1', '0', '2019-09-10 08:50:10', '2019-09-10 08:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `closingdate_queries`
--

CREATE TABLE `closingdate_queries` (
  `id` int NOT NULL,
  `post_id` int NOT NULL,
  `agent_id` int NOT NULL,
  `sellerorbuyer_id` int NOT NULL,
  `sellerorbuyer_role` int NOT NULL,
  `agent_role` int NOT NULL,
  `select_date` varchar(255) NOT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '0="De-active",1="Active"',
  `closing_date` varchar(255) DEFAULT NULL,
  `comments` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `client_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `scopes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `client_id` int NOT NULL,
  `scopes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `redirect` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `provider` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`, `provider`) VALUES
(1, NULL, '92Agents Personal Access Client', 'ADfxEB234C5YI77seozIZt7ryJm9Y68omwrO3pRV', 'http://localhost', 1, 0, 0, '2022-10-02 16:57:16', '2022-10-02 16:57:16', NULL),
(2, NULL, '92Agents Personal Access Client', 'TpqmY9Th7a9wi0OlZe4WKhlXKo9KSX7zEbjrTpVc', 'http://localhost', 1, 0, 0, '2022-10-02 17:14:23', '2022-10-02 17:14:23', NULL),
(3, NULL, '92Agents Personal Access Client', 'GfNlD66OaB10nN0bAw8LS3FV7OhakAyzito9tKHz', 'http://localhost', 1, 0, 0, '2022-10-02 17:15:05', '2022-10-02 17:15:05', NULL),
(4, NULL, '92Agents Password Grant Client', '08TCFmIa4NDLdRFvJEY0ZZjJJPGeFS9Ij6fweHrx', 'http://localhost', 0, 1, 0, '2022-10-02 17:15:05', '2022-10-02 17:15:05', 'users');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int UNSIGNED NOT NULL,
  `client_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 3, '2022-10-02 17:15:05', '2022-10-02 17:15:05');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents_area`
--
ALTER TABLE `agents_area`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `agents_blog`
--
ALTER TABLE `agents_blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agents_bookmark`
--
ALTER TABLE `agents_bookmark`
  ADD PRIMARY KEY (`bookmark_id`);

--
-- Indexes for table `agents_certifications`
--
ALTER TABLE `agents_certifications`
  ADD PRIMARY KEY (`certifications_id`);

--
-- Indexes for table `agents_city`
--
ALTER TABLE `agents_city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `agents_conversation`
--
ALTER TABLE `agents_conversation`
  ADD PRIMARY KEY (`conversation_id`);

--
-- Indexes for table `agents_conversation_message`
--
ALTER TABLE `agents_conversation_message`
  ADD PRIMARY KEY (`messages_id`);

--
-- Indexes for table `agents_franchise`
--
ALTER TABLE `agents_franchise`
  ADD PRIMARY KEY (`franchise_id`);

--
-- Indexes for table `agents_importance`
--
ALTER TABLE `agents_importance`
  ADD PRIMARY KEY (`importance_id`);

--
-- Indexes for table `agents_notes`
--
ALTER TABLE `agents_notes`
  ADD PRIMARY KEY (`notes_id`);

--
-- Indexes for table `agents_notification`
--
ALTER TABLE `agents_notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `agents_payment`
--
ALTER TABLE `agents_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `agents_posts`
--
ALTER TABLE `agents_posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `agents_proposals`
--
ALTER TABLE `agents_proposals`
  ADD PRIMARY KEY (`proposals_id`);

--
-- Indexes for table `agents_question`
--
ALTER TABLE `agents_question`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `agents_securty_question`
--
ALTER TABLE `agents_securty_question`
  ADD PRIMARY KEY (`securty_question_id`);

--
-- Indexes for table `agents_selldetails`
--
ALTER TABLE `agents_selldetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agents_shared`
--
ALTER TABLE `agents_shared`
  ADD PRIMARY KEY (`shared_id`);

--
-- Indexes for table `agents_state`
--
ALTER TABLE `agents_state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `agents_survey`
--
ALTER TABLE `agents_survey`
  ADD PRIMARY KEY (`survey_id`);

--
-- Indexes for table `agents_upload_share_all`
--
ALTER TABLE `agents_upload_share_all`
  ADD PRIMARY KEY (`upload_share_id`);

--
-- Indexes for table `agents_users`
--
ALTER TABLE `agents_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agents_users_conections`
--
ALTER TABLE `agents_users_conections`
  ADD PRIMARY KEY (`connection_id`);

--
-- Indexes for table `agents_users_details`
--
ALTER TABLE `agents_users_details`
  ADD PRIMARY KEY (`details_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents_area`
--
ALTER TABLE `agents_area`
  MODIFY `area_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `agents_blog`
--
ALTER TABLE `agents_blog`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `agents_bookmark`
--
ALTER TABLE `agents_bookmark`
  MODIFY `bookmark_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `agents_certifications`
--
ALTER TABLE `agents_certifications`
  MODIFY `certifications_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `agents_city`
--
ALTER TABLE `agents_city`
  MODIFY `city_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `agents_conversation`
--
ALTER TABLE `agents_conversation`
  MODIFY `conversation_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `agents_conversation_message`
--
ALTER TABLE `agents_conversation_message`
  MODIFY `messages_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=303;

--
-- AUTO_INCREMENT for table `agents_franchise`
--
ALTER TABLE `agents_franchise`
  MODIFY `franchise_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `agents_importance`
--
ALTER TABLE `agents_importance`
  MODIFY `importance_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `agents_notes`
--
ALTER TABLE `agents_notes`
  MODIFY `notes_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `agents_notification`
--
ALTER TABLE `agents_notification`
  MODIFY `notification_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=641;

--
-- AUTO_INCREMENT for table `agents_payment`
--
ALTER TABLE `agents_payment`
  MODIFY `payment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `agents_posts`
--
ALTER TABLE `agents_posts`
  MODIFY `post_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `agents_proposals`
--
ALTER TABLE `agents_proposals`
  MODIFY `proposals_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `agents_question`
--
ALTER TABLE `agents_question`
  MODIFY `question_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `agents_securty_question`
--
ALTER TABLE `agents_securty_question`
  MODIFY `securty_question_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `agents_selldetails`
--
ALTER TABLE `agents_selldetails`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `agents_shared`
--
ALTER TABLE `agents_shared`
  MODIFY `shared_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `agents_state`
--
ALTER TABLE `agents_state`
  MODIFY `state_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `agents_survey`
--
ALTER TABLE `agents_survey`
  MODIFY `survey_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `agents_upload_share_all`
--
ALTER TABLE `agents_upload_share_all`
  MODIFY `upload_share_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `agents_users`
--
ALTER TABLE `agents_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=909;

--
-- AUTO_INCREMENT for table `agents_users_conections`
--
ALTER TABLE `agents_users_conections`
  MODIFY `connection_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `agents_users_details`
--
ALTER TABLE `agents_users_details`
  MODIFY `details_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=909;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
