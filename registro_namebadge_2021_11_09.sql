-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 09, 2021 at 08:38 AM
-- Server version: 5.7.36
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registro_namebadge`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id` int(11) NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `enable_vcard` tinyint(1) NOT NULL DEFAULT '0',
  `enable_qrcode` tinyint(1) NOT NULL DEFAULT '0',
  `enable_barcode` tinyint(1) NOT NULL DEFAULT '0',
  `enable_sync_dashboard` tinyint(1) NOT NULL DEFAULT '0',
  `sync_dashboard_api` varchar(350) DEFAULT NULL,
  `registro_dashboard_url` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_settings`
--

INSERT INTO `app_settings` (`id`, `event_id`, `enable_vcard`, `enable_qrcode`, `enable_barcode`, `enable_sync_dashboard`, `sync_dashboard_api`, `registro_dashboard_url`) VALUES
(1, 3, 0, 1, 0, 1, 'http://dashboard.registella.asia/api/v1/store_namebadge_manual_entry_attendee', 'http://dashboard.registella.asia/'),
(3, 4, 0, 1, 0, 1, 'http://dashboard.registella.asia/api/v1/store_namebadge_manual_entry_attendee', 'http://dashboard.registella.asia/');

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `serial_number` varchar(650) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` int(11) NOT NULL,
  `salutation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` int(11) NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(650) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(350) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_number` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vcard_path` varchar(550) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attendee_live_qr_code` varchar(350) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zone` varchar(350) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_name` varchar(350) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seat` varchar(350) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zone_bg_color` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zone_text_color` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `print_status` tinyint(1) NOT NULL DEFAULT '0',
  `print_date` datetime DEFAULT NULL,
  `add_type` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`id`, `serial_number`, `event_id`, `salutation`, `first_name`, `last_name`, `email`, `type_id`, `country`, `company`, `designation`, `mobile`, `office_number`, `postal_code`, `vcard_path`, `attendee_live_qr_code`, `zone`, `table_name`, `seat`, `zone_bg_color`, `zone_text_color`, `created_by`, `edited_by`, `created_at`, `updated_at`, `print_status`, `print_date`, `add_type`) VALUES
(152, '0003XG1XQA000180', 3, 'Mr.', 'Adrian', 'Teo', 'adrian1@registro.asia', 28, 'Singapore', 'Registro Pte Ltd', '', '', '', '', NULL, '31094.png', '', '', '', '', NULL, 2, 2, '2021-11-08 06:23:02', '2021-11-08 06:23:02', 1, '2021-11-08 22:30:27', 1),
(153, '000344H#SI000181', 3, 'Mr.', 'Adrian', 'Teo', 'adrian2@registro.asia', 27, 'Singapore', 'Registro Pte Ltd', '', '', '', '', NULL, '31095.png', '', '', '', '', NULL, 2, 2, '2021-11-08 06:23:02', '2021-11-08 06:23:03', 1, '2021-11-08 22:28:22', 1),
(154, '0003E9UAZG000182', 3, 'Mr.', 'Adrian', 'Teo', 'adrian3@registro.asia', 26, 'Singapore', 'Registro Pte Ltd', '', '', '', '', NULL, '31096.png', '', '', '', '', NULL, 2, 2, '2021-11-08 06:23:03', '2021-11-08 06:23:04', 1, '2021-11-08 22:29:20', 1),
(155, '0003AKU6L9000183', 3, 'Mr.', 'Adrian', 'Teo', 'adrian4@registro.asia', 25, 'Singapore', 'Registro Pte Ltd', '', '', '', '', NULL, '31097.png', '', '', '', '', NULL, 2, 2, '2021-11-08 06:23:04', '2021-11-08 06:23:04', 1, '2021-11-08 22:28:54', 1),
(156, '0003LYXXYV000184', 3, 'Mr.', 'Adrian', 'Teo', 'adrian5@registro.asia', 24, 'Singapore', 'Registro Pte Ltd', '', '', '', '', NULL, '31098.png', '', '', '', '', NULL, 2, 2, '2021-11-08 06:23:04', '2021-11-08 06:23:07', 1, '2021-11-08 22:29:53', 1),
(157, '0003GBSEHS000185', 3, 'Mr.', 'Adrian', 'Teo', 'adrian6@registro.asia', 23, 'Singapore', 'Registro Pte Ltd', '', '', '', '', NULL, '31099.png', '', '', '', '', NULL, 2, 2, '2021-11-08 06:23:07', '2021-11-08 06:23:08', 1, '2021-11-08 22:29:31', 1),
(158, '0003JDGE3U000186', 3, 'Mr.', 'Adrian', 'Teo', 'adrian7@registro.asia', 22, 'Singapore', 'Registro Pte Ltd', '', '', '', '', NULL, '31100.png', '', '', '', '', NULL, 2, 2, '2021-11-08 06:23:08', '2021-11-08 06:23:08', 1, '2021-11-08 22:29:43', 1),
(159, '0003ZIJPND000187', 3, 'Mr.', 'Adrian', 'Teo', 'adrian8@registro.asia', 20, 'Singapore', 'Registro Pte Ltd', '', '', '', '', NULL, '31101.png', '', '', '', '', NULL, 2, 2, '2021-11-08 06:23:08', '2021-11-08 06:23:09', 1, '2021-11-08 22:30:39', 1),
(160, '0004IVPGC5000002', 4, 'Mr.', 'Adrian', 'Teo', 'adrian9@registro.asia', 21, 'Singapore', 'Registro Pte Ltd', '', '', '', '', NULL, '41102.png', '', '', '', '', NULL, 2, 2, '2021-11-08 06:23:09', '2021-11-08 06:23:09', 1, '2021-11-08 22:31:04', 1),
(161, '00033E4355000188', 3, 'Mr.', 'Adrian', 'Teo', 'adrian10@registro.asia', 29, 'Singapore', 'Registro Pte Ltd', '', '', '', '', NULL, '31103.png', '', '', '', '', NULL, 2, 2, '2021-11-08 06:23:09', '2021-11-08 06:23:10', 1, '2021-11-08 22:24:42', 1),
(162, '0003CIRWOU000189', 3, 'Mr.', 'Adrian', 'Teo', 'adrian11@registro.asia', 30, 'Singapore', 'Registro Pte Ltd', '', '', '', '', NULL, '31104.png', '', '', '', '', NULL, 2, 2, '2021-11-08 06:23:10', '2021-11-08 06:23:10', 1, '2021-11-08 22:29:09', 1),
(163, '0003VB2Q6Y000190', 3, 'Mr.', 'Adrian', 'Teo', 'adrian12@registro.asia', 31, 'Singapore', 'Registro Pte Ltd', '', '', '', '', NULL, '31105.png', '', '', '', '', NULL, 2, 2, '2021-11-08 06:23:10', '2021-11-08 06:23:10', 1, '2021-11-08 22:30:02', 1),
(164, '0003WWE7O9000191', 3, 'Mr.', 'Adrian', 'Teo', 'adrian13@registro.asia', 32, 'Singapore', 'Registro Pte Ltd', '', '', '', '', NULL, '31106.png', '', '', '', '', NULL, 2, 2, '2021-11-08 06:23:10', '2021-11-08 06:23:11', 1, '2021-11-08 22:30:13', 1),
(165, '0004KXKSWJ000003', 4, 'Mr.', 'Adrian', 'Teo', 'adrian14@registro.asia', 33, 'Singapore', 'Registro Pte Ltd', '', '', '', '', NULL, '41107.png', '', '', '', '', NULL, 2, 2, '2021-11-08 06:23:11', '2021-11-08 06:23:11', 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name`) VALUES
(1, 'Afghanistan'),
(2, 'Albania'),
(3, 'Algeria'),
(4, 'American samoa'),
(5, 'Andorra'),
(6, 'Angola'),
(7, 'Anguilla'),
(8, 'Antarctica'),
(9, 'Antigua and barbuda'),
(10, 'Argentina'),
(11, 'Armenia'),
(12, 'Aruba'),
(13, 'Australia'),
(14, 'Austria'),
(15, 'Azerbaijan'),
(16, 'Bahamas'),
(17, 'Bahrain'),
(18, 'Bangladesh'),
(19, 'Barbados'),
(20, 'Belarus'),
(21, 'Belgium'),
(22, 'Belize'),
(23, 'Benin'),
(24, 'Bermuda'),
(25, 'Bhutan'),
(26, 'Bolivia'),
(27, 'Bosnia and herzegowina'),
(28, 'Botswana'),
(29, 'Bouvet island'),
(30, 'Brazil'),
(31, 'British indian ocean territory'),
(32, 'Brunei darussalam'),
(33, 'Bulgaria'),
(34, 'Burkina faso'),
(35, 'Burundi'),
(36, 'Cambodia'),
(37, 'Cameroon'),
(38, 'Canada'),
(39, 'Cape'),
(40, 'Cayman'),
(41, 'Central african republic'),
(42, 'Chad'),
(43, 'Chile'),
(44, 'China'),
(45, 'Christmas island'),
(46, 'Cocos (keeling) islands'),
(47, 'Colombia'),
(48, 'Comoros'),
(49, 'Congo, democratic republic of the'),
(50, 'Congo, republic of the'),
(51, 'Cook islands'),
(52, 'Costa rica'),
(53, 'Cote divoire'),
(54, 'Croatia (hrvatska)'),
(55, 'Cuba'),
(56, 'Cyprus'),
(57, 'Czech republic'),
(58, 'Denmark'),
(59, 'Djibouti'),
(60, 'Dominica'),
(61, 'Dominican republic'),
(62, 'Ecuador'),
(63, 'Egypt'),
(64, 'El salvador'),
(65, 'Equatorial guinea'),
(66, 'Eritrea'),
(67, 'Estonia'),
(68, 'Ethiopia'),
(69, 'Falkland islands (malvinas)'),
(70, 'Faroe islands'),
(71, 'Fiji'),
(72, 'Finland'),
(73, 'France'),
(74, 'Gabon'),
(75, 'Gambia'),
(76, 'Georgia'),
(77, 'Germany'),
(78, 'Ghana'),
(79, 'Gibraltar'),
(80, 'Greece'),
(81, 'Greenland'),
(82, 'Grenada'),
(83, 'Guadeloupe'),
(84, 'Guam'),
(85, 'Guatemala'),
(86, 'Guinea'),
(87, 'Guinea-bissau'),
(88, 'Guyana'),
(89, 'Haiti'),
(90, 'Heard island and mcdonald islands'),
(91, 'Holy see (vatican city state)'),
(92, 'Honduras'),
(93, 'Hong'),
(94, 'Hungary'),
(95, 'Iceland'),
(96, 'India'),
(97, 'Indonesia'),
(98, 'Iran (islamic republic of)'),
(99, 'Iraq'),
(100, 'Ireland'),
(101, 'Israel'),
(102, 'Italy'),
(103, 'Jamaica'),
(104, 'Japan'),
(105, 'Jordan'),
(106, 'Kazakhstan'),
(107, 'Kenya'),
(108, 'Kiribati'),
(109, 'Korea, democratic peoples republic of'),
(110, 'Korea, republic of'),
(111, 'Kuwait'),
(112, 'Kyrgyzstan'),
(113, 'Lao peoples democratic republic'),
(114, 'Latvia'),
(115, 'Lebanon'),
(116, 'Lesotho'),
(117, 'Liberia'),
(118, 'Libyan arab jamahiriya'),
(119, 'Liechtenstein'),
(120, 'Lithuania'),
(121, 'Luxembourg'),
(122, 'Macau'),
(123, 'Macedonia, the former yugoslav republic of'),
(124, 'Madagascar'),
(125, 'Malawi'),
(126, 'Malaysia'),
(127, 'Maldives'),
(128, 'Mali'),
(129, 'Malta'),
(130, 'Marshall'),
(131, 'Martinique'),
(132, 'Mauritania'),
(133, 'Mauritius'),
(134, 'Mayotte'),
(135, 'Mexico'),
(136, 'Micronesia, federated states of'),
(137, 'Moldova, republic of'),
(138, 'Monaco'),
(139, 'Mongolia'),
(140, 'Montenegro'),
(141, 'Montserrat'),
(142, 'Morocco'),
(143, 'Mozambique'),
(144, 'Myanmar'),
(145, 'Namibia'),
(146, 'Nauru'),
(147, 'Nepal'),
(148, 'Netherlands'),
(149, 'Netherlands antilles'),
(150, 'New caledonia'),
(151, 'New zealand'),
(152, 'Nicaragua'),
(153, 'Niger'),
(154, 'Nigeria'),
(155, 'Niue'),
(156, 'Norfolk island'),
(157, 'Norway'),
(158, 'Oman'),
(159, 'Pakistan'),
(160, 'Palau'),
(161, 'Panama'),
(162, 'Papua new guinea'),
(163, 'Paraguay'),
(164, 'Peru'),
(165, 'Philippines'),
(166, 'Pitcairn'),
(167, 'Poland'),
(168, 'Portugal'),
(169, 'Puerto rico'),
(170, 'Qatar'),
(171, 'R�union'),
(172, 'Romania'),
(173, 'Russian federation'),
(174, 'Rwanda'),
(175, 'Saint helena, ascension and tristan da cunha'),
(176, 'Saint kitts and nevis'),
(177, 'Saint lucia'),
(178, 'Aint pierre and miquelon'),
(179, 'Saint vincent and the grenadines'),
(180, 'Samoa'),
(181, 'San marino'),
(182, 'Sao tome and principe'),
(183, 'Saudi arabia'),
(184, 'Senegal'),
(185, 'Serbia'),
(186, 'Seychelles'),
(187, 'Sierra'),
(188, 'Singapore'),
(189, 'Slovakia'),
(190, 'Slovenia'),
(191, 'Solomon islands'),
(192, 'Somalia'),
(193, 'South africa'),
(194, 'South georgia and the south sandwich islands'),
(195, 'Spain'),
(196, 'Sri lanka'),
(197, 'Sudan'),
(198, 'Suriname'),
(199, 'Svalbard and jan mayen'),
(200, 'Swaziland'),
(201, 'Sweden'),
(202, 'Switzerland'),
(203, 'Syrian arab republic'),
(204, 'Taiwan'),
(205, 'Tajikistan'),
(206, 'Tanzania, united republic of'),
(207, 'Thailand'),
(208, 'Timor-leste'),
(209, 'Togo'),
(210, 'Tokelau'),
(211, 'Tonga'),
(212, 'Trinidad and tobago'),
(213, 'Tunisia'),
(214, 'Turkey'),
(215, 'Turkmenistan'),
(216, 'Turks and caicos islands'),
(217, 'Tuvalu'),
(218, 'Uganda'),
(219, 'Ukraine'),
(220, 'United arab emirates'),
(221, 'United kingdom'),
(222, 'United states'),
(223, 'United states minor outlying islands'),
(224, 'Uruguay'),
(225, 'Uzbekistan'),
(226, 'Vanuatu'),
(227, 'Venezuela'),
(228, 'Vietnam'),
(229, 'Virgin islands, british'),
(230, 'Virgin islands, u.s.'),
(231, 'Wallis and futuna islands'),
(232, 'Western sahara'),
(233, 'Yemen'),
(234, 'Zambia'),
(235, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--

CREATE TABLE `custom_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_label` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_validation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_visibility` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_field_dropdown_metas`
--

CREATE TABLE `custom_field_dropdown_metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `custom_fields_id` int(11) NOT NULL,
  `option_label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_field_metas`
--

CREATE TABLE `custom_field_metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_record` int(11) NOT NULL,
  `custom_fields_id` int(11) NOT NULL,
  `field_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_field_metas`
--

INSERT INTO `custom_field_metas` (`id`, `user_id`, `module`, `reference_record`, `custom_fields_id`, `field_value`, `created_at`, `updated_at`) VALUES
(1, 2, 'attendee', 133, 7, 'Arjan Bhai', '2020-03-27 23:03:07', '2020-03-28 02:09:31'),
(2, 2, 'attendee', 133, 8, '03/28/2020 12:00 AM', '2020-03-28 02:09:31', '2020-03-28 02:09:31');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` longtext COLLATE utf8mb4_unicode_ci,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_short_code` varchar(650) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_date` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `edited_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_id`, `name`, `event_short_code`, `event_date`, `created_by`, `edited_by`, `created_at`, `updated_at`) VALUES
(3, '2021000003', 'Cafe Asia 2021', 'CA2021', '2021-11-18 00:00:00', 2, 2, '2021-10-24 00:03:39', '2021-10-24 00:03:39'),
(4, '2021000004', 'Restaurant Asia 2021', 'RA2021', '2021-11-18 00:00:00', 2, 2, '2021-11-03 07:54:48', '2021-11-03 07:54:48');

-- --------------------------------------------------------

--
-- Table structure for table `event_seat_arrangements`
--

CREATE TABLE `event_seat_arrangements` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=zone; 2=table; 3= seat',
  `event_id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `bg_color` varchar(100) DEFAULT NULL,
  `text_color` varchar(100) DEFAULT NULL,
  `custom_id` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 2),
(3, '2020_03_20_112124_create_events_table', 2),
(4, '2020_03_21_043335_create_usertypes_table', 3),
(5, '2020_03_21_092305_create_attendees_table', 4),
(6, '2020_03_23_084056_create_templates_table', 5),
(7, '2020_03_26_121920_create_custom_fields_table', 6),
(8, '2020_03_26_122847_create_custom_field_dropdown_metas_table', 6),
(9, '2020_03_26_123034_create_custom_field_metas_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `print_history`
--

CREATE TABLE `print_history` (
  `id` int(11) NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `attendee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `attendee_email` varchar(600) DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `print_history`
--

INSERT INTO `print_history` (`id`, `event_id`, `attendee_id`, `attendee_email`, `type_id`, `created_at`, `created_by`) VALUES
(87, 3, 161, 'adrian10@registro.asia', 29, '2021-11-08 22:24:42', 2),
(88, 3, 153, 'adrian2@registro.asia', 27, '2021-11-08 22:28:22', 2),
(89, 3, 153, 'adrian2@registro.asia', 27, '2021-11-08 22:28:27', 2),
(90, 3, 153, 'adrian2@registro.asia', 27, '2021-11-08 22:28:33', 2),
(91, 3, 155, 'adrian4@registro.asia', 25, '2021-11-08 22:28:54', 2),
(92, 3, 162, 'adrian11@registro.asia', 30, '2021-11-08 22:29:09', 2),
(93, 3, 154, 'adrian3@registro.asia', 26, '2021-11-08 22:29:20', 2),
(94, 3, 157, 'adrian6@registro.asia', 23, '2021-11-08 22:29:31', 2),
(95, 3, 158, 'adrian7@registro.asia', 22, '2021-11-08 22:29:43', 2),
(96, 3, 156, 'adrian5@registro.asia', 24, '2021-11-08 22:29:53', 2),
(97, 3, 163, 'adrian12@registro.asia', 31, '2021-11-08 22:30:02', 2),
(98, 3, 164, 'adrian13@registro.asia', 32, '2021-11-08 22:30:13', 2),
(99, 3, 152, 'adrian1@registro.asia', 28, '2021-11-08 22:30:27', 2),
(100, 3, 159, 'adrian8@registro.asia', 20, '2021-11-08 22:30:39', 2),
(101, 4, 160, 'adrian9@registro.asia', 21, '2021-11-08 22:31:04', 2),
(102, 3, 164, 'adrian13@registro.asia', 32, '2021-11-08 22:34:20', 2),
(103, 4, 160, 'adrian9@registro.asia', 21, '2021-11-08 22:35:03', 2),
(104, 4, 160, 'adrian9@registro.asia', 21, '2021-11-08 22:35:05', 2);

-- --------------------------------------------------------

--
-- Table structure for table `salutations`
--

CREATE TABLE `salutations` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salutations`
--

INSERT INTO `salutations` (`id`, `name`) VALUES
(1, 'Mr.'),
(2, 'Mrs.'),
(3, 'Mdm'),
(4, 'Dr'),
(5, 'Assoc. Prof'),
(6, 'Prof');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `template_name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `page_height` int(11) NOT NULL,
  `page_width` int(11) NOT NULL,
  `header_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template_data` longtext COLLATE utf8mb4_unicode_ci,
  `namebadge_print_data` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) NOT NULL,
  `edited_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `template_name`, `event_id`, `type_id`, `page_height`, `page_width`, `header_image`, `template_data`, `namebadge_print_data`, `created_by`, `edited_by`, `created_at`, `updated_at`) VALUES
(10, 'CA - Exhibitor', 3, 20, 135, 90, '', '{\"version\":\"3.6.2\",\"objects\":[{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":171.99,\"width\":337.84,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":228.92,\"width\":337.51,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":280.89,\"width\":336.51,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":451.82,\"width\":325.85,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":0.99,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"  Type\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":\"6\",\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":106.73,\"top\":328.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"}]}', '{\"name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":171.99,\"width\":337.84,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"},\"company_name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":228.92,\"width\":337.51,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},\"country_id\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":280.89,\"width\":336.51,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},\"namebadge_user_label\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":451.82,\"width\":325.85,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":0.99,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"  Type\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":\"6\",\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},\"qrcode\":{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":106.73,\"top\":328.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"}}', 2, NULL, '2021-10-24 00:16:17', '2021-10-26 20:32:59'),
(11, 'RA - Exhibitor', 4, 21, 135, 90, '', '{\"version\":\"3.6.2\",\"objects\":[{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":450,\"width\":321.86,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112.38,\"top\":328.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":272.9,\"width\":340.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":223.92,\"width\":337.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-7,\"top\":169.94,\"width\":338.84,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}]}', '{\"namebadge_user_label\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":450,\"width\":321.86,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},\"qrcode\":{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112.38,\"top\":328.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},\"country_id\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":272.9,\"width\":340.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},\"company_name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":223.92,\"width\":337.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},\"name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-7,\"top\":169.94,\"width\":338.84,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}}', 2, NULL, '2021-10-24 00:16:37', '2021-10-31 19:23:52'),
(12, 'SDA', 3, 28, 135, 90, '', '{\"version\":\"3.6.2\",\"objects\":[{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5,\"top\":450,\"width\":327.85,\"height\":22.6,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1.23,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"20\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112.38,\"top\":326.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":277.9,\"width\":346.15,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":229.92,\"width\":344.85,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-7,\"top\":172.94,\"width\":344.84,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}]}', '{\"namebadge_user_label\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5,\"top\":450,\"width\":327.85,\"height\":22.6,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1.23,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"20\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},\"qrcode\":{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112.38,\"top\":326.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},\"country_id\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":277.9,\"width\":346.15,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},\"company_name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":229.92,\"width\":344.85,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},\"name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-7,\"top\":172.94,\"width\":344.84,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}}', 2, NULL, '2021-10-26 07:07:56', '2021-10-31 19:47:46'),
(13, 'CA-Speaker', 3, 27, 135, 90, '', '{\"version\":\"3.6.2\",\"objects\":[{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5,\"top\":450,\"width\":321.85,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112.38,\"top\":327.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5,\"top\":280.89,\"width\":345.16,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5,\"top\":230.66,\"width\":336.85,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-7,\"top\":173.88,\"width\":338.85,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}]}', '{\"namebadge_user_label\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5,\"top\":450,\"width\":321.85,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},\"qrcode\":{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112.38,\"top\":327.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},\"country_id\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5,\"top\":280.89,\"width\":345.16,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},\"company_name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5,\"top\":230.66,\"width\":336.85,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},\"name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-7,\"top\":173.88,\"width\":338.85,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}}', 2, NULL, '2021-10-26 07:19:50', '2021-10-31 19:26:54'),
(14, 'CA-HOST', 3, 26, 135, 90, '', '{\"version\":\"3.6.2\",\"objects\":[{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5,\"top\":450,\"width\":324.85,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":105.73,\"top\":329.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":280.91,\"width\":342.02,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":0.99,\"scaleY\":0.99,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5,\"top\":230.66,\"width\":336.85,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5,\"top\":173.88,\"width\":337.85,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}]}', '{\"namebadge_user_label\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5,\"top\":450,\"width\":324.85,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},\"qrcode\":{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":105.73,\"top\":329.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},\"country_id\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":280.91,\"width\":342.02,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":0.99,\"scaleY\":0.99,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},\"company_name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5,\"top\":230.66,\"width\":336.85,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},\"name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5,\"top\":173.88,\"width\":337.85,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}}', 2, NULL, '2021-10-26 07:24:36', '2021-10-31 19:27:05');
INSERT INTO `templates` (`id`, `template_name`, `event_id`, `type_id`, `page_height`, `page_width`, `header_image`, `template_data`, `namebadge_print_data`, `created_by`, `edited_by`, `created_at`, `updated_at`) VALUES
(15, 'CA-GUEST', 3, 25, 135, 90, '', '{\"version\":\"3.6.2\",\"objects\":[{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5,\"top\":450,\"width\":325.85,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112.38,\"top\":327.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5,\"top\":280.66,\"width\":336.85,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-7,\"top\":230.66,\"width\":339.85,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-7,\"top\":173.88,\"width\":339.85,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}]}', '{\"namebadge_user_label\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5,\"top\":450,\"width\":325.85,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},\"qrcode\":{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112.38,\"top\":327.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},\"country_id\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5,\"top\":280.66,\"width\":336.85,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},\"company_name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-7,\"top\":230.66,\"width\":339.85,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},\"name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-7,\"top\":173.88,\"width\":339.85,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}}', 2, NULL, '2021-10-26 07:27:25', '2021-10-31 19:27:16'),
(16, 'VIP', 3, 24, 135, 90, '', '{\"version\":\"3.6.2\",\"objects\":[{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":450,\"width\":328.85,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"24\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112.38,\"top\":327.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-8,\"top\":280.66,\"width\":340.85,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5,\"top\":230.66,\"width\":337.85,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":173.88,\"width\":339.85,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}]}', '{\"namebadge_user_label\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":450,\"width\":328.85,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"24\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},\"qrcode\":{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112.38,\"top\":327.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},\"country_id\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-8,\"top\":280.66,\"width\":340.85,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},\"company_name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5,\"top\":230.66,\"width\":337.85,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},\"name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":173.88,\"width\":339.85,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}}', 2, NULL, '2021-10-26 07:31:09', '2021-10-31 19:26:34'),
(17, 'CA-MEDIA', 3, 23, 135, 90, '', '{\"version\":\"3.6.2\",\"objects\":[{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-8,\"top\":450,\"width\":325.85,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112.38,\"top\":326.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":280.66,\"width\":324.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":230.66,\"width\":322.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":173.88,\"width\":323.84,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}]}', '{\"namebadge_user_label\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-8,\"top\":450,\"width\":325.85,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},\"qrcode\":{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112.38,\"top\":326.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},\"country_id\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":280.66,\"width\":324.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},\"company_name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":230.66,\"width\":322.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},\"name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":173.88,\"width\":323.84,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}}', 2, NULL, '2021-10-26 07:36:13', '2021-10-31 19:27:49'),
(18, 'CA-ORGANISER', 3, 22, 135, 90, '', '{\"version\":\"3.6.2\",\"objects\":[{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":450,\"width\":324.85,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112.38,\"top\":326.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":280.66,\"width\":323.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":230.66,\"width\":323.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":7.01,\"top\":173.88,\"width\":324.84,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}]}', '{\"namebadge_user_label\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":450,\"width\":324.85,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},\"qrcode\":{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112.38,\"top\":326.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},\"country_id\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":280.66,\"width\":323.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},\"company_name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":230.66,\"width\":323.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},\"name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":7.01,\"top\":173.88,\"width\":324.84,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}}', 2, NULL, '2021-10-26 07:38:23', '2021-10-31 19:28:06'),
(19, 'CA-USHER', 3, 29, 135, 90, '', '{\"version\":\"3.6.2\",\"objects\":[{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":450,\"width\":324.85,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112.38,\"top\":327.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":7.01,\"top\":280.66,\"width\":324.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":230.66,\"width\":323.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":173.88,\"width\":324.84,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}]}', '{\"namebadge_user_label\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":450,\"width\":324.85,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},\"qrcode\":{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112.38,\"top\":327.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},\"country_id\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":7.01,\"top\":280.66,\"width\":324.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},\"company_name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":230.66,\"width\":323.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},\"name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":173.88,\"width\":324.84,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}}', 2, NULL, '2021-10-26 07:40:34', '2021-10-31 19:28:22');
INSERT INTO `templates` (`id`, `template_name`, `event_id`, `type_id`, `page_height`, `page_width`, `header_image`, `template_data`, `namebadge_print_data`, `created_by`, `edited_by`, `created_at`, `updated_at`) VALUES
(20, 'SA-STAFF', 3, 30, 135, 90, '', '{\"version\":\"3.6.2\",\"objects\":[{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":450,\"width\":325.85,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"24\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112.38,\"top\":326.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":280.66,\"width\":324.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":230.66,\"width\":324.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":7.01,\"top\":173.88,\"width\":325.84,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}]}', '{\"namebadge_user_label\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":450,\"width\":325.85,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"24\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},\"qrcode\":{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112.38,\"top\":326.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},\"country_id\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":280.66,\"width\":324.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},\"company_name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":230.66,\"width\":324.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},\"name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":7.01,\"top\":173.88,\"width\":325.84,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}}', 2, NULL, '2021-10-26 07:42:54', '2021-10-31 19:28:35'),
(21, 'SA-SERVICE PROVIDER', 3, 31, 135, 90, '', '{\"version\":\"3.6.2\",\"objects\":[{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-7,\"top\":450,\"width\":326.85,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112.38,\"top\":326.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":7.16,\"top\":278.66,\"width\":325.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":230.66,\"width\":324.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":9.01,\"top\":173.88,\"width\":324.84,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}]}', '{\"namebadge_user_label\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-7,\"top\":450,\"width\":326.85,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},\"qrcode\":{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112.38,\"top\":326.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},\"country_id\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":7.16,\"top\":278.66,\"width\":325.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},\"company_name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":230.66,\"width\":324.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},\"name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":9.01,\"top\":173.88,\"width\":324.84,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}}', 2, NULL, '2021-10-26 07:45:45', '2021-10-31 19:28:55'),
(22, 'CA-ONSITE Reg', 3, 32, 135, 90, '', '{\"version\":\"3.6.2\",\"objects\":[{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":450,\"width\":323.85,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":118.95,\"top\":327.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":280.66,\"width\":323.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":230.66,\"width\":324.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":173.88,\"width\":324.84,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}]}', '{\"namebadge_user_label\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":450,\"width\":323.85,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},\"qrcode\":{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":118.95,\"top\":327.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},\"country_id\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":280.66,\"width\":323.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},\"company_name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":230.66,\"width\":324.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},\"name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":8.01,\"top\":173.88,\"width\":324.84,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}}', 2, NULL, '2021-10-26 07:49:11', '2021-10-31 19:29:13'),
(24, 'Agent', 3, 33, 135, 90, '', '{\"version\":\"3.6.2\",\"objects\":[{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5,\"top\":450,\"width\":332.85,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112.38,\"top\":328.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":280.66,\"width\":337.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5.5,\"top\":228.92,\"width\":339.35,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":173.88,\"width\":337.84,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}]}', '{\"namebadge_user_label\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5,\"top\":450,\"width\":332.85,\"height\":31.64,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Type\",\"fontSize\":\"28\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"namebadge_user_label\"},\"qrcode\":{\"type\":\"rect\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":112.38,\"top\":328.85,\"width\":113.39,\"height\":113.39,\"fill\":\"#fff\",\"stroke\":\"#000\",\"strokeWidth\":2,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"rx\":0,\"ry\":0,\"label_name\":\"qrcode\"},\"country_id\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":280.66,\"width\":337.84,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Country\",\"fontSize\":\"18\",\"fontWeight\":\"normal\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"country_id\"},\"company_name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-5.5,\"top\":228.92,\"width\":339.35,\"height\":20.34,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Company\",\"fontSize\":\"18\",\"fontWeight\":\"\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"company_name\"},\"name\":{\"type\":\"textbox\",\"version\":\"3.6.2\",\"originX\":\"left\",\"originY\":\"top\",\"left\":-6,\"top\":173.88,\"width\":337.84,\"height\":27.12,\"fill\":\"#646161\",\"stroke\":\"#646161\",\"strokeWidth\":1,\"strokeDashArray\":null,\"strokeLineCap\":\"butt\",\"strokeDashOffset\":0,\"strokeLineJoin\":\"miter\",\"strokeMiterLimit\":4,\"scaleX\":1,\"scaleY\":1,\"angle\":0,\"flipX\":false,\"flipY\":false,\"opacity\":1,\"shadow\":null,\"visible\":true,\"clipTo\":null,\"backgroundColor\":\"\",\"fillRule\":\"nonzero\",\"paintFirst\":\"fill\",\"globalCompositeOperation\":\"source-over\",\"transformMatrix\":null,\"skewX\":0,\"skewY\":0,\"text\":\"Name\",\"fontSize\":\"24\",\"fontWeight\":\"bold\",\"fontFamily\":\"Times New Roman\",\"fontStyle\":\"normal\",\"lineHeight\":1.16,\"underline\":false,\"overline\":false,\"linethrough\":false,\"textAlign\":\"center\",\"textBackgroundColor\":\"\",\"charSpacing\":0,\"minWidth\":20,\"splitByGrapheme\":false,\"styles\":{},\"label_name\":\"name\"}}', 2, NULL, '2021-11-08 06:43:43', '2021-11-08 06:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 1, 'Super Admin', 'admin@namebadge.com', NULL, '$2y$10$oimKYdX0/ZXSpwyZebwEWOc08J5iGwvZ7.UlnELnOUEYGQysuQepK', '7ga7FIvq323E4ISY9E1QzvjyTn7WbWGk2st6KXTnHRr5752mS10RthSY5zwy', '2020-03-17 03:03:06', '2020-03-17 03:03:06'),
(3, 2, 'Operator 1', 'operator1@namebadge.com', NULL, '', 'fMMDYyBc1RXaKwlpnF360cpjiCrGkWromHP76MNrwl72IdTI9br4RRSJiT99', '2020-03-17 03:03:06', '2020-03-17 03:03:06');

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE `usertypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `background_color` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_clor` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `edited_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`id`, `event_id`, `type_name`, `background_color`, `text_clor`, `created_by`, `edited_by`, `created_at`, `updated_at`) VALUES
(28, 3, 'SAFE DISTANCING AMBASSADOR', '#fe0001', '#000000', 2, NULL, '2021-10-26 06:51:51', '2021-10-26 06:51:51'),
(27, 3, 'SPEAKER', '#ef1925', '#ffffff', 2, NULL, '2021-10-26 06:51:32', '2021-10-26 06:51:32'),
(26, 3, 'HOST', '#f01a26', '#ffffff', 2, NULL, '2021-10-26 06:51:19', '2021-10-26 06:51:19'),
(25, 3, 'GUEST', '#ef1925', '#ffffff', 2, NULL, '2021-10-26 06:51:05', '2021-10-26 06:51:05'),
(24, 3, 'VIP', '#f01a26', '#ffffff', 2, NULL, '2021-10-26 06:50:51', '2021-10-26 06:50:51'),
(23, 3, 'MEDIA', '#000000', '#ffffff', 2, NULL, '2021-10-26 06:50:36', '2021-10-26 06:50:36'),
(22, 3, 'ORGANISER', '#ef5d2e', '#ffffff', 2, NULL, '2021-10-26 06:50:24', '2021-10-26 06:50:24'),
(20, 3, 'EXHIBITOR', '#405daa', '#ffffff', 2, NULL, '2021-10-24 00:05:36', '2021-10-24 00:05:36'),
(21, 4, 'EXHIBITOR', '#499243', '#ffffff', 2, NULL, '2021-10-24 00:07:01', '2021-10-24 00:12:03'),
(29, 3, 'USHER', '#ffff01', '#000000', 2, NULL, '2021-10-26 06:52:09', '2021-10-26 06:52:09'),
(30, 3, 'STAFF', '#9b9fa0', '#000000', 2, NULL, '2021-10-26 06:52:20', '2021-10-26 06:52:20'),
(31, 3, 'SERVICE PROVIDER', '#ffffff', '#000000', 2, NULL, '2021-10-26 06:52:38', '2021-10-26 06:52:38'),
(32, 3, 'ONSITE', '#5a00a3', '#ffffff', 2, NULL, '2021-10-26 06:52:53', '2021-10-26 06:52:53'),
(33, 3, 'CA -Agent', '#db840a', '#000000', 2, NULL, '2021-11-03 05:45:21', '2021-11-03 05:45:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_field_dropdown_metas`
--
ALTER TABLE `custom_field_dropdown_metas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_field_metas`
--
ALTER TABLE `custom_field_metas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_seat_arrangements`
--
ALTER TABLE `event_seat_arrangements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `print_history`
--
ALTER TABLE `print_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `attendee_id` (`attendee_id`);

--
-- Indexes for table `salutations`
--
ALTER TABLE `salutations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attendees`
--
ALTER TABLE `attendees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT for table `custom_fields`
--
ALTER TABLE `custom_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `custom_field_dropdown_metas`
--
ALTER TABLE `custom_field_dropdown_metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_field_metas`
--
ALTER TABLE `custom_field_metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `event_seat_arrangements`
--
ALTER TABLE `event_seat_arrangements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `print_history`
--
ALTER TABLE `print_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `salutations`
--
ALTER TABLE `salutations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usertypes`
--
ALTER TABLE `usertypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD CONSTRAINT `app_settings_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `print_history`
--
ALTER TABLE `print_history`
  ADD CONSTRAINT `print_history_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `print_history_ibfk_2` FOREIGN KEY (`attendee_id`) REFERENCES `attendees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
