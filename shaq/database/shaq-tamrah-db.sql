-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 19, 2017 at 11:07 AM
-- Server version: 5.7.17-0ubuntu0.16.04.2
-- PHP Version: 7.1.4-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shaq-tamrah-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_authorization`
--

CREATE TABLE `admin_authorization` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Admin Authorization ID',
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(128) NOT NULL DEFAULT '',
  `status` enum('On Hold','Active','Blocked','Deleted') NOT NULL DEFAULT 'On Hold',
  `admin_authorization_role_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Role ID',
  `last_login_date` datetime NOT NULL,
  `last_login_ip` varchar(15) NOT NULL DEFAULT '',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Token creation timestamp',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Admin Authorization';

--
-- Dumping data for table `admin_authorization`
--

INSERT INTO `admin_authorization` (`id`, `username`, `password`, `status`, `admin_authorization_role_id`, `last_login_date`, `last_login_ip`, `organization_id`, `organization_user_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'admin', '3ASm2k4+8WCBU3q97k8zya8q5fuk2/axszTPSHztWEw=', 'Active', 0, '0000-00-00 00:00:00', '', 0, 0, 0, 0, '2017-04-15 13:30:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_authorization_organization_relation`
--

CREATE TABLE `admin_authorization_organization_relation` (
  `id` int(11) UNSIGNED NOT NULL,
  `status` enum('Initiated','Established','Refused','Broken','Canceled') NOT NULL DEFAULT 'Initiated',
  `initiator_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `initiator_organization_user_id` int(11) UNSIGNED NOT NULL,
  `target_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `target_organization_user_id` int(11) UNSIGNED NOT NULL,
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admin_authorization_organization_relation_role`
--

CREATE TABLE `admin_authorization_organization_relation_role` (
  `id` int(11) UNSIGNED NOT NULL,
  `status` enum('Initiated','Established','Refused','Broken','Canceled') NOT NULL DEFAULT 'Initiated',
  `admin_authorization_role_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Role ID',
  `admin_authorization_organization_relation_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admin_authorization_relation`
--

CREATE TABLE `admin_authorization_relation` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Admin Authorization Relation ID',
  `admin_authorization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `admin_authorization_organization_relation_role_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Role ID',
  `status` enum('Pending','Active','Blocked','Deleted') NOT NULL DEFAULT 'Pending',
  `last_login_date` datetime NOT NULL,
  `last_login_ip` varchar(15) NOT NULL DEFAULT '',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Token creation timestamp',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Admin Authorization';

-- --------------------------------------------------------

--
-- Table structure for table `admin_authorization_resource`
--

CREATE TABLE `admin_authorization_resource` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Rule ID',
  `name` varchar(50) DEFAULT NULL COMMENT 'Resource Name',
  `description` varchar(512) DEFAULT NULL COMMENT 'Role Name',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Token creation timestamp',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Admin Rule Table';

-- --------------------------------------------------------

--
-- Table structure for table `admin_authorization_role`
--

CREATE TABLE `admin_authorization_role` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Role ID',
  `name` varchar(255) DEFAULT NULL COMMENT 'Role Name',
  `type` enum('Default','Custom','Temp','Relation') DEFAULT NULL COMMENT 'Custom',
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Parent Role ID',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Token creation timestamp',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Admin Role Table';

-- --------------------------------------------------------

--
-- Table structure for table `admin_authorization_rule`
--

CREATE TABLE `admin_authorization_rule` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Rule ID',
  `admin_authorization_role_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Role ID',
  `authorization_resource_id` varchar(255) DEFAULT NULL COMMENT 'Resource ID',
  `permission` enum('allow','deny') DEFAULT NULL COMMENT 'Permission',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Token creation timestamp',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Admin Rule Table';

-- --------------------------------------------------------

--
-- Table structure for table `admin_authorization_token`
--

CREATE TABLE `admin_authorization_token` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Entity ID',
  `token` varchar(32) NOT NULL COMMENT 'Token',
  `type` varchar(16) NOT NULL COMMENT 'session id, csrf, reset password link, sms verification, email verification',
  `revoked` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Is Token revoked',
  `authorized` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Is Token authorized',
  `expiry` datetime DEFAULT NULL,
  `admin_authorization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Token creation timestamp',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Admin Tokens';

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `id` int(11) UNSIGNED NOT NULL,
  `sequence` int(11) UNSIGNED NOT NULL,
  `ssn` varchar(32) NOT NULL DEFAULT '',
  `title` enum('Mr.','Mrs.','Miss','Ms.') NOT NULL DEFAULT 'Mr.',
  `gender` enum('Male','Female') NOT NULL DEFAULT 'Male',
  `email` varchar(255) NOT NULL DEFAULT '',
  `mobile_number` varchar(17) NOT NULL DEFAULT '',
  `mobile_number_2` varchar(17) NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:12, Max: 14',
  `phone_number` varchar(17) NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:12, Max: 14',
  `fax` varchar(17) NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:12, Max: 14',
  `country_id` int(11) UNSIGNED NOT NULL,
  `city_id` int(11) UNSIGNED NOT NULL,
  `avatar` varchar(1024) NOT NULL DEFAULT '',
  `bank_name` varchar(255) NOT NULL DEFAULT '',
  `bank_branch_name` varchar(255) NOT NULL DEFAULT '',
  `bank_branch_number` varchar(255) NOT NULL DEFAULT '',
  `bank_swift_code` varchar(32) NOT NULL DEFAULT '',
  `bank_account_number` varchar(255) NOT NULL DEFAULT '',
  `bank_iban_code` varchar(32) NOT NULL DEFAULT '',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `agent_locale`
--

CREATE TABLE `agent_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `second_name` varchar(255) NOT NULL DEFAULT '',
  `third_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `company_name` varchar(255) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `agent_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `id` int(11) UNSIGNED NOT NULL,
  `asset_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `cost` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `tax_type` enum('Fixed','Percent','None') NOT NULL DEFAULT 'None',
  `tax_value` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `currency` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'USD',
  `currency_exchange_rate_id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `asset_condition`
--

CREATE TABLE `asset_condition` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `asset_condition`
--

INSERT INTO `asset_condition` (`id`, `published`, `country_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Yes', 1, 1, 1, NULL, '2017-05-15 07:59:27'),
(2, 'No', 1, 1, 1, NULL, '2017-05-15 06:56:07'),
(3, 'Yes', 1, 1, 1, NULL, '2017-05-15 06:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `asset_condition_locale`
--

CREATE TABLE `asset_condition_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `asset_condition_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `asset_condition_locale`
--

INSERT INTO `asset_condition_locale` (`id`, `name`, `description`, `locale_id`, `asset_condition_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Conditions', 'Conditions', 1, 1, 1, 1, NULL, '2017-05-15 07:59:27'),
(2, 'Conditions', '', 2, 1, 1, 1, NULL, '2017-05-15 07:59:27'),
(3, 'Asset', 'Asset', 1, 2, 1, 1, NULL, '2017-05-15 06:56:07'),
(4, 'Asset', 'Asset', 2, 2, 1, 1, NULL, '2017-05-15 06:56:07'),
(5, 'test', 'test', 1, 3, 1, 1, NULL, '2017-05-15 06:58:53'),
(6, 'test', 'test', 2, 3, 1, 1, NULL, '2017-05-15 06:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `asset_locale`
--

CREATE TABLE `asset_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:3, Max: 50',
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:3, Max: 50',
  `photo` varchar(1024) NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:3, Max: 50',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `asset_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `asset_storage_type`
--

CREATE TABLE `asset_storage_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `asset_storage_type`
--

INSERT INTO `asset_storage_type` (`id`, `published`, `country_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Yes', 1, 1, 1, '2017-05-13 06:29:32', '2017-05-13 06:49:53'),
(3, 'No', 1, 1, 1, '2017-05-13 06:38:50', '2017-05-13 06:49:53'),
(4, 'No', 1, 1, 1, '2017-05-13 06:40:09', NULL),
(5, 'Yes', 1, 1, 1, '2017-05-13 06:49:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `asset_storage_type_locale`
--

CREATE TABLE `asset_storage_type_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `asset_storage_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `asset_storage_type_locale`
--

INSERT INTO `asset_storage_type_locale` (`id`, `name`, `description`, `locale_id`, `asset_storage_type_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Asset Storage Types', 'Asset Storage Types', 1, 1, 1, 1, '2017-05-13 06:29:32', '2017-05-13 06:49:53'),
(2, 'Asset Storage Types', 'Asset Storage Types', 2, 1, 1, 1, '2017-05-13 06:29:32', '2017-05-13 06:49:53'),
(5, 'Asset', 'Asset', 1, 3, 1, 1, '2017-05-13 06:38:50', '2017-05-13 06:49:53'),
(6, 'Asset', 'asset-storage-types', 2, 3, 1, 1, '2017-05-13 06:38:50', '2017-05-13 06:49:53'),
(7, 'Storage', 'Storage', 1, 4, 1, 1, '2017-05-13 06:40:09', NULL),
(8, 'Storage', 'Storage', 2, 4, 1, 1, '2017-05-13 06:40:09', NULL),
(9, 'Asset11', 'Asset', 1, 5, 1, 1, '2017-05-13 06:49:53', NULL),
(10, 'Asset', 'asset-storage-types', 2, 5, 1, 1, '2017-05-13 06:49:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `asset_type_condition`
--

CREATE TABLE `asset_type_condition` (
  `id` int(11) UNSIGNED NOT NULL,
  `asset_type_id` int(11) UNSIGNED NOT NULL,
  `asset_condition_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `asset_type_locale`
--

CREATE TABLE `asset_type_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `asset_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `asset_type_storage_type`
--

CREATE TABLE `asset_type_storage_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `asset_type_id` int(11) UNSIGNED NOT NULL,
  `asset_storage_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `asset_type_unit_type`
--

CREATE TABLE `asset_type_unit_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `asset_type_id` int(11) UNSIGNED NOT NULL,
  `asset_unit_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `asset_unit_type`
--

CREATE TABLE `asset_unit_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `asset_unit_type`
--

INSERT INTO `asset_unit_type` (`id`, `published`, `country_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Yes', 1, 1, 1, '2017-05-13 05:06:49', '2017-05-13 06:54:36'),
(2, 'No', 1, 1, 1, '2017-05-13 05:13:00', '2017-05-13 05:30:51'),
(3, 'No', 1, 1, 1, '2017-05-13 05:29:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `asset_unit_type_locale`
--

CREATE TABLE `asset_unit_type_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `asset_unit_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `asset_unit_type_locale`
--

INSERT INTO `asset_unit_type_locale` (`id`, `name`, `description`, `locale_id`, `asset_unit_type_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, ' Asset unit types', 'Asset unit types', 1, 1, 1, 1, '2017-05-13 05:06:49', '2017-05-13 06:54:36'),
(2, ' Asset unit types', 'Asset unit types', 2, 1, 1, 1, '2017-05-13 05:06:49', '2017-05-13 06:54:36'),
(3, 'Asset unit types2', 'Asset unit types', 1, 2, 1, 1, '2017-05-13 05:13:00', '2017-05-13 05:30:51'),
(4, 'Asset unit types2', 'Asset unit types', 2, 2, 1, 1, '2017-05-13 05:13:00', '2017-05-13 05:30:51'),
(5, 'Asset unit types1', 'Asset unit types', 1, 3, 1, 1, '2017-05-13 05:29:09', NULL),
(6, 'Asset unit types1', 'Asset unit types', 2, 3, 1, 1, '2017-05-13 05:29:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary`
--

CREATE TABLE `beneficiary` (
  `id` int(11) UNSIGNED NOT NULL,
  `sequence` varchar(32) NOT NULL DEFAULT '',
  `family_book_number` varchar(32) NOT NULL DEFAULT '',
  `status` enum('New','Draft','In Review','Moved','Approved','Rejected','Duplicate','Deleted') NOT NULL DEFAULT 'New',
  `visibility` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `notes` varchar(1024) NOT NULL DEFAULT '' COMMENT 'Optional, Textarea, Min:10, Max:500',
  `options` varchar(1024) NOT NULL DEFAULT '' COMMENT 'Optional, Any other-future info will be saved serialize array key=>value'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary`
--

INSERT INTO `beneficiary` (`id`, `sequence`, `family_book_number`, `status`, `visibility`, `country_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`, `notes`, `options`) VALUES
(1, '1', '2', 'In Review', 'Yes', 1, 1, 1, '2017-05-15 14:00:09', '2017-05-16 09:50:28', 'Family', 'Family'),
(2, '1', '1', 'Draft', 'No', 1, 1, 1, '2017-05-16 09:47:48', NULL, 'Family1', 'Family1'),
(3, '9', '4', 'In Review', 'Yes', 1, 1, 1, '2017-05-16 09:50:28', NULL, 'Family', 'Family');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_duplicate`
--

CREATE TABLE `beneficiary_duplicate` (
  `id` int(11) UNSIGNED NOT NULL,
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `duplicate_beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_group`
--

CREATE TABLE `beneficiary_group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_group_member`
--

CREATE TABLE `beneficiary_group_member` (
  `id` int(11) NOT NULL,
  `beneficiary_group_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_has_profile`
--

CREATE TABLE `beneficiary_has_profile` (
  `id` int(11) UNSIGNED NOT NULL,
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `beneficiary_profile_id` int(11) UNSIGNED NOT NULL,
  `status` enum('Draft','In Progress','Completed') NOT NULL DEFAULT 'Draft',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_locale`
--

CREATE TABLE `beneficiary_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `family_name` varchar(255) NOT NULL DEFAULT '',
  `intro_text` mediumtext NOT NULL,
  `locale_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_locale`
--

INSERT INTO `beneficiary_locale` (`id`, `family_name`, `intro_text`, `locale_id`, `beneficiary_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Family', 'Family', 1, 1, 1, 1, '2017-05-15 14:00:09', '2017-05-16 09:50:28'),
(2, 'Family', 'Family', 2, 1, 1, 1, '2017-05-15 14:00:09', '2017-05-16 09:50:28'),
(3, 'Family1', 'Family1', 1, 2, 1, 1, '2017-05-16 09:47:48', NULL),
(4, 'Family1', 'Family1', 2, 2, 1, 1, '2017-05-16 09:47:48', NULL),
(5, 'Family Test', 'Family Test', 1, 3, 1, 1, '2017-05-16 09:50:28', NULL),
(6, 'Family Test', 'Family Test', 2, 3, 1, 1, '2017-05-16 09:50:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_media_gallery`
--

CREATE TABLE `beneficiary_media_gallery` (
  `id` int(11) UNSIGNED NOT NULL,
  `size` int(11) UNSIGNED NOT NULL,
  `mime_type` varchar(32) NOT NULL,
  `path` varchar(1024) NOT NULL DEFAULT '',
  `media_type_id` tinyint(3) UNSIGNED DEFAULT '0',
  `media_filetype_id` tinyint(3) UNSIGNED DEFAULT '0',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `media_status_id` tinyint(3) UNSIGNED DEFAULT '0',
  `sequence` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `beneficiary_profile_family_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_media_gallery_locale`
--

CREATE TABLE `beneficiary_media_gallery_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `intro_text` mediumtext NOT NULL,
  `locale_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_media_gallery_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_media_youtube_gallery`
--

CREATE TABLE `beneficiary_media_youtube_gallery` (
  `id` int(11) UNSIGNED NOT NULL,
  `youtube_link` varchar(255) NOT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `media_status_id` tinyint(3) UNSIGNED DEFAULT '0',
  `sequence` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `beneficiary_profile_family_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_media_youtube_gallery_locale`
--

CREATE TABLE `beneficiary_media_youtube_gallery_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `intro_text` mediumtext NOT NULL,
  `locale_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_media_youtube_gallery_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_message_email`
--

CREATE TABLE `beneficiary_message_email` (
  `id` int(11) NOT NULL,
  `message_type_id` int(11) UNSIGNED NOT NULL,
  `from_name` varchar(255) NOT NULL DEFAULT '',
  `from_email` varchar(255) NOT NULL DEFAULT '',
  `to_name` varchar(255) NOT NULL DEFAULT '',
  `to_email` varchar(255) NOT NULL DEFAULT '',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `message_template_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_sent` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_read` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_message_sms`
--

CREATE TABLE `beneficiary_message_sms` (
  `id` int(11) NOT NULL,
  `message_type_id` int(11) UNSIGNED NOT NULL,
  `from_name` varchar(255) NOT NULL DEFAULT '',
  `from_mobile_number` varchar(255) NOT NULL DEFAULT '',
  `to_name` varchar(255) NOT NULL DEFAULT '',
  `to_mobile_number` varchar(255) NOT NULL DEFAULT '',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `message_template_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_sent` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_read` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_movement`
--

CREATE TABLE `beneficiary_movement` (
  `id` int(11) UNSIGNED NOT NULL,
  `status` enum('Initiated','Accepted','Refused','Canceled') NOT NULL DEFAULT 'Initiated',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `target_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `beneficiary_current_status` varchar(255) NOT NULL DEFAULT '',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile`
--

CREATE TABLE `beneficiary_profile` (
  `id` int(11) UNSIGNED NOT NULL,
  `details` enum('Yes','No') NOT NULL DEFAULT 'No' COMMENT 'Optional, DropDownList',
  `family` enum('Yes','No') NOT NULL DEFAULT 'No' COMMENT 'Optional, DropDownList',
  `family_flag` enum('Yes','No') NOT NULL DEFAULT 'No' COMMENT 'Optional, DropDownList',
  `income` enum('Yes','No') NOT NULL DEFAULT 'No' COMMENT 'Optional, DropDownList',
  `spending` enum('Yes','No') NOT NULL DEFAULT 'No' COMMENT 'Optional, DropDownList',
  `home` enum('Yes','No') NOT NULL DEFAULT 'No' COMMENT 'Optional, DropDownList',
  `asset` enum('Yes','No') NOT NULL DEFAULT 'No' COMMENT 'Optional, DropDownList',
  `asset_required` enum('Yes','No') NOT NULL DEFAULT 'No' COMMENT 'Optional, DropDownList',
  `education` enum('Yes','No') NOT NULL DEFAULT 'No' COMMENT 'Optional, DropDownList',
  `medical` enum('Yes','No') NOT NULL DEFAULT 'No' COMMENT 'Optional, DropDownList',
  `medical_examination` enum('Yes','No') NOT NULL DEFAULT 'No' COMMENT 'Optional, DropDownList',
  `disabled` enum('Yes','No') NOT NULL DEFAULT 'No' COMMENT 'Optional, DropDownList',
  `volunteer` enum('Yes','No') NOT NULL DEFAULT 'No' COMMENT 'Optional, DropDownList',
  `gallery` enum('Yes','No') NOT NULL DEFAULT 'No' COMMENT 'Optional, DropDownList',
  `research_notes` enum('Yes','No') NOT NULL DEFAULT 'No' COMMENT 'Optional, DropDownList',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No' COMMENT 'Optional, DropDownList',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_profile`
--

INSERT INTO `beneficiary_profile` (`id`, `details`, `family`, `family_flag`, `income`, `spending`, `home`, `asset`, `asset_required`, `education`, `medical`, `medical_examination`, `disabled`, `volunteer`, `gallery`, `research_notes`, `published`, `country_id`, `beneficiary_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Yes', 'No', 'Yes', 'No', 'Yes', 'No', 'Yes', 'Yes', 'No', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 1, 3, 1, 1, '2017-05-16 12:21:11', '2017-05-18 11:32:10'),
(2, 'Yes', 'No', 'Yes', 'No', 'Yes', 'No', 'Yes', 'Yes', 'No', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'No', 1, 2, 1, 1, '2017-05-18 10:30:32', '2017-05-18 10:46:34'),
(3, 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'No', 'No', 'No', 'Yes', 1, 1, 1, 1, '2017-05-18 10:43:11', '2017-05-18 10:46:22');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_asset`
--

CREATE TABLE `beneficiary_profile_asset` (
  `id` int(11) UNSIGNED NOT NULL,
  `asset_type_id` int(11) UNSIGNED NOT NULL,
  `asset_id` int(11) UNSIGNED NOT NULL,
  `asset_condition_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_asset_received`
--

CREATE TABLE `beneficiary_profile_asset_received` (
  `id` int(11) UNSIGNED NOT NULL,
  `asset_id` int(11) UNSIGNED NOT NULL,
  `asset_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `asset_unit_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `asset_quantity` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `asset_condition_id` int(11) UNSIGNED NOT NULL,
  `asset_value` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `receipt_number` varchar(50) DEFAULT NULL,
  `status` enum('Pending','Out For Delivery','Received') DEFAULT 'Pending',
  `donor_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_asset_required`
--

CREATE TABLE `beneficiary_profile_asset_required` (
  `id` int(11) UNSIGNED NOT NULL,
  `asset_id` int(11) UNSIGNED NOT NULL,
  `asset_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `asset_unit_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `asset_condition_id` int(11) UNSIGNED NOT NULL,
  `asset_quantity` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `status` enum('Pending','Approved','Rejected','Out of Stock','Received') DEFAULT 'Pending',
  `beneficiary_profile_asset_received_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `beneficiary_profile_asset_received_date` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_details`
--

CREATE TABLE `beneficiary_profile_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `has_paterfamilias` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `has_family_members` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `is_father_alive` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `is_mother_alive` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `number_of_sons` tinyint(3) UNSIGNED DEFAULT '0',
  `number_of_daughters` tinyint(3) UNSIGNED DEFAULT '0',
  `has_supplies_card` enum('Yes','No') NOT NULL DEFAULT 'No',
  `income_total` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:1',
  `spending_total` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:1',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_disabled`
--

CREATE TABLE `beneficiary_profile_disabled` (
  `id` int(11) UNSIGNED NOT NULL,
  `beneficiary_profile_disabled_type_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_profile_disabled_reason_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_profile_family_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_disabled_reason`
--

CREATE TABLE `beneficiary_profile_disabled_reason` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_profile_disabled_reason`
--

INSERT INTO `beneficiary_profile_disabled_reason` (`id`, `published`, `country_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Yes', 1, 1, 1, '2017-05-18 12:29:33', '2017-05-18 12:37:26'),
(2, 'No', 1, 1, 1, '2017-05-18 12:31:17', '2017-05-18 12:37:26'),
(3, 'Yes', 1, 1, 1, '2017-05-18 12:33:39', '2017-05-18 12:37:26'),
(4, 'No', 1, 1, 1, '2017-05-18 12:35:16', '2017-05-18 12:36:57');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_disabled_reason_locale`
--

CREATE TABLE `beneficiary_profile_disabled_reason_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_profile_disabled_reason_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_profile_disabled_reason_locale`
--

INSERT INTO `beneficiary_profile_disabled_reason_locale` (`id`, `name`, `description`, `locale_id`, `beneficiary_profile_disabled_reason_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Disabled', 'Disabled', 1, 1, 1, 1, '2017-05-18 12:29:33', '2017-05-18 12:37:26'),
(2, 'Disabled', 'Disabled', 2, 1, 1, 1, '2017-05-18 12:29:33', '2017-05-18 12:37:26'),
(3, 'Reason', 'Reason', 1, 2, 1, 1, '2017-05-18 12:31:17', '2017-05-18 12:37:26'),
(4, 'Reason', 'Reason', 2, 2, 1, 1, '2017-05-18 12:31:17', '2017-05-18 12:37:26'),
(5, 'Disabled Reason', 'Disabled Reason', 1, 3, 1, 1, '2017-05-18 12:33:39', '2017-05-18 12:37:26'),
(6, 'Disabled Reason', 'Disabled Reason', 2, 3, 1, 1, '2017-05-18 12:33:39', '2017-05-18 12:37:26'),
(7, 'Disabled Reason11', 'Disabled Reason11', 1, 4, 1, 1, '2017-05-18 12:35:16', '2017-05-18 12:36:57'),
(8, 'Disabled Reason11', 'Disabled Reason11', 2, 4, 1, 1, '2017-05-18 12:35:16', '2017-05-18 12:36:57');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_disabled_type`
--

CREATE TABLE `beneficiary_profile_disabled_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_profile_disabled_type`
--

INSERT INTO `beneficiary_profile_disabled_type` (`id`, `published`, `country_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'No', 1, 1, 1, NULL, '2017-05-18 11:17:22'),
(2, 'No', 1, 1, 1, NULL, '2017-05-18 11:17:22'),
(3, 'Yes', 1, 1, 1, NULL, '2017-05-18 11:17:22'),
(5, 'Yes', 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_disabled_type_locale`
--

CREATE TABLE `beneficiary_profile_disabled_type_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_profile_disabled_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_profile_disabled_type_locale`
--

INSERT INTO `beneficiary_profile_disabled_type_locale` (`id`, `name`, `description`, `locale_id`, `beneficiary_profile_disabled_type_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'disabled11', 'dfdf', 1, 1, 1, 1, NULL, '2017-05-18 11:17:22'),
(2, 'disabled11', 'fdfdf', 2, 1, 1, 1, NULL, '2017-05-18 11:17:22'),
(3, 'test', 'test', 1, 2, 1, 1, NULL, '2017-05-18 11:17:22'),
(4, 'test', 'est', 2, 2, 1, 1, NULL, '2017-05-18 11:17:22'),
(5, 'admin2', 'dfdfdf1', 1, 3, 1, 1, NULL, '2017-05-18 11:17:22'),
(6, 'admin1', 'sdsdsd', 2, 3, 1, 1, NULL, '2017-05-18 11:17:22'),
(9, 'admin3', 'dfdfdf1', 1, 5, 1, 1, NULL, NULL),
(10, 'admin1', 'sdsdsd', 2, 5, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_education_level`
--

CREATE TABLE `beneficiary_profile_education_level` (
  `id` int(11) UNSIGNED NOT NULL,
  `school_type` enum('Pre KG','KG','Elementary School','Intermediate School','High School','Industrial Education','Diploma','University','Academy') NOT NULL DEFAULT 'Diploma',
  `start_at` date NOT NULL COMMENT 'Optional, Calender',
  `end_at` date NOT NULL COMMENT 'Optional, Calender',
  `beneficiary_profile_family_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_education_level_locale`
--

CREATE TABLE `beneficiary_profile_education_level_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `institute_name` varchar(255) NOT NULL DEFAULT '',
  `school_name` varchar(255) NOT NULL DEFAULT '',
  `level_name` varchar(255) NOT NULL DEFAULT '',
  `major_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:3, Max: 50',
  `class_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:3, Max: 50',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT 'Optional, Textarea, Min:3, Max: 50',
  `final_grade` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `beneficiary_profile_education_level_id` int(11) UNSIGNED NOT NULL,
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_family`
--

CREATE TABLE `beneficiary_profile_family` (
  `id` int(11) UNSIGNED NOT NULL,
  `ssn` varchar(32) NOT NULL DEFAULT '',
  `phone_number` varchar(17) NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:12, Max: 14',
  `mobile_number` varchar(17) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `nationality_id` int(11) UNSIGNED NOT NULL,
  `country_id` int(11) UNSIGNED NOT NULL,
  `city_id` int(11) UNSIGNED NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `avatar` varchar(1024) NOT NULL DEFAULT '',
  `beneficiary_relation_id` int(11) UNSIGNED NOT NULL,
  `marital_status_id` tinyint(3) UNSIGNED DEFAULT '0',
  `education_level_id` tinyint(3) UNSIGNED DEFAULT '0',
  `medical_condition_id` tinyint(3) UNSIGNED DEFAULT '0',
  `beneficiary_profile_family_profession_id` tinyint(3) UNSIGNED DEFAULT '0',
  `death_date` date DEFAULT NULL COMMENT 'Optional, Calender',
  `death_reason_id` tinyint(3) UNSIGNED DEFAULT '0',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_family_flag`
--

CREATE TABLE `beneficiary_profile_family_flag` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_profile_family_flag`
--

INSERT INTO `beneficiary_profile_family_flag` (`id`, `published`, `country_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Yes', 1, 1, 1, '2017-05-18 13:14:54', '2017-05-18 13:54:00'),
(2, 'No', 1, 1, 1, '2017-05-18 13:20:21', NULL),
(3, 'No', 1, 1, 1, '2017-05-18 13:36:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_family_flag_locale`
--

CREATE TABLE `beneficiary_profile_family_flag_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `flag_name` varchar(255) NOT NULL DEFAULT '',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_profile_family_flag_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_profile_family_flag_locale`
--

INSERT INTO `beneficiary_profile_family_flag_locale` (`id`, `flag_name`, `locale_id`, `beneficiary_profile_family_flag_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Flag', 1, 1, 1, 1, '2017-05-18 13:14:54', '2017-05-18 13:54:00'),
(2, 'Flag', 2, 1, 1, 1, '2017-05-18 13:14:54', '2017-05-18 13:54:00'),
(3, 'Flag1', 1, 2, 1, 1, '2017-05-18 13:20:21', NULL),
(4, 'Flag1', 2, 2, 1, 1, '2017-05-18 13:20:21', NULL),
(5, 'test', 1, 3, 1, 1, '2017-05-18 13:36:49', NULL),
(6, 'test', 2, 3, 1, 1, '2017-05-18 13:36:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_family_has_flag`
--

CREATE TABLE `beneficiary_profile_family_has_flag` (
  `id` int(11) UNSIGNED NOT NULL,
  `beneficiary_profile_family_flag_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `flag_value` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `beneficiary_profile_family_id` tinyint(3) UNSIGNED DEFAULT '0',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_family_locale`
--

CREATE TABLE `beneficiary_profile_family_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `second_name` varchar(255) NOT NULL DEFAULT '',
  `third_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `beneficiary_profile_family_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_family_profession`
--

CREATE TABLE `beneficiary_profile_family_profession` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_profile_family_profession`
--

INSERT INTO `beneficiary_profile_family_profession` (`id`, `published`, `country_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'No', 1, 1, 1, '2017-05-18 14:10:14', '2017-05-18 14:12:25'),
(2, 'Yes', 1, 1, 1, '2017-05-18 14:11:58', '2017-05-18 14:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_family_profession_locale`
--

CREATE TABLE `beneficiary_profile_family_profession_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_profile_family_profession_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_profile_family_profession_locale`
--

INSERT INTO `beneficiary_profile_family_profession_locale` (`id`, `name`, `description`, `locale_id`, `beneficiary_profile_family_profession_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Profession ', 'Profession ', 1, 1, 1, 1, '2017-05-18 14:10:14', '2017-05-18 14:12:25'),
(2, 'Profession ', 'Profession ', 2, 1, 1, 1, '2017-05-18 14:10:14', '2017-05-18 14:12:25'),
(3, 'Profession 1', 'Profession ', 1, 2, 1, 1, '2017-05-18 14:11:58', '2017-05-18 14:12:31'),
(4, 'Profession ', 'Profession ', 2, 2, 1, 1, '2017-05-18 14:11:58', '2017-05-18 14:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_family_sponsorship`
--

CREATE TABLE `beneficiary_profile_family_sponsorship` (
  `id` int(11) UNSIGNED NOT NULL,
  `beneficiary_profile_family_id` tinyint(3) UNSIGNED DEFAULT '0',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `donor_id` int(11) UNSIGNED NOT NULL,
  `frequency` enum('One Time','Daily','Weekly','Monthly','Quarterly','Annual') DEFAULT 'One Time',
  `amount` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `currency` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'USD',
  `currency_exchange_rate_id` int(11) UNSIGNED NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_home`
--

CREATE TABLE `beneficiary_profile_home` (
  `id` int(11) UNSIGNED NOT NULL,
  `building_owner_phone_number` varchar(17) NOT NULL DEFAULT '',
  `beneficiary_profile_home_construction_type_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_profile_home_contract_type_id` int(11) UNSIGNED NOT NULL,
  `construction_area_in_square_meter` float UNSIGNED NOT NULL,
  `number_of_floors` tinyint(3) UNSIGNED NOT NULL,
  `number_of_rooms` tinyint(3) UNSIGNED NOT NULL,
  `number_of_residents` tinyint(3) UNSIGNED NOT NULL,
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_home_construction_type`
--

CREATE TABLE `beneficiary_profile_home_construction_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_profile_home_construction_type`
--

INSERT INTO `beneficiary_profile_home_construction_type` (`id`, `published`, `country_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Yes', 1, 1, 1, '2017-05-19 05:03:10', '2017-05-19 05:34:04'),
(2, 'No', 1, 1, 1, '2017-05-19 05:04:45', '2017-05-19 05:34:25');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_home_construction_type_locale`
--

CREATE TABLE `beneficiary_profile_home_construction_type_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_profile_home_construction_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_profile_home_construction_type_locale`
--

INSERT INTO `beneficiary_profile_home_construction_type_locale` (`id`, `name`, `description`, `locale_id`, `beneficiary_profile_home_construction_type_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Tent', 'Tent', 1, 1, 1, 1, '2017-05-19 05:03:10', '2017-05-19 05:34:04'),
(2, 'Tent', 'Tent', 2, 1, 1, 1, '2017-05-19 05:03:10', '2017-05-19 05:34:04'),
(3, 'Rock', 'Rock', 1, 2, 1, 1, '2017-05-19 05:04:45', '2017-05-19 05:34:25'),
(4, 'Rock', 'Rock', 2, 2, 1, 1, '2017-05-19 05:04:45', '2017-05-19 05:34:25');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_home_contract_type`
--

CREATE TABLE `beneficiary_profile_home_contract_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_profile_home_contract_type`
--

INSERT INTO `beneficiary_profile_home_contract_type` (`id`, `published`, `country_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Yes', 1, 1, 1, '2017-05-19 05:23:02', '2017-05-19 05:33:06'),
(2, 'No', 1, 1, 1, '2017-05-19 05:26:47', '2017-05-19 05:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_home_contract_type_locale`
--

CREATE TABLE `beneficiary_profile_home_contract_type_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_profile_home_contract_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_profile_home_contract_type_locale`
--

INSERT INTO `beneficiary_profile_home_contract_type_locale` (`id`, `name`, `description`, `locale_id`, `beneficiary_profile_home_contract_type_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Rental', 'Rental', 1, 1, 1, 1, '2017-05-19 05:23:02', '2017-05-19 05:33:06'),
(2, 'Rental', 'Rental', 2, 1, 1, 1, '2017-05-19 05:23:02', '2017-05-19 05:33:06'),
(3, 'Owned', 'Owned', 1, 2, 1, 1, '2017-05-19 05:26:47', '2017-05-19 05:33:32'),
(4, 'Owned', 'Owned', 2, 2, 1, 1, '2017-05-19 05:26:47', '2017-05-19 05:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_home_locale`
--

CREATE TABLE `beneficiary_profile_home_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `building_owner_name` varchar(255) NOT NULL DEFAULT '',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `beneficiary_profile_home_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_income`
--

CREATE TABLE `beneficiary_profile_income` (
  `id` int(11) UNSIGNED NOT NULL,
  `beneficiary_profile_income_type_id` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:1',
  `amount` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:1',
  `currency` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'USD',
  `currency_exchange_rate_id` int(11) UNSIGNED NOT NULL,
  `frequency` enum('Daily','Weekly','Monthly','Quarterly','Annual') DEFAULT 'Monthly',
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_income_type`
--

CREATE TABLE `beneficiary_profile_income_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_profile_income_type`
--

INSERT INTO `beneficiary_profile_income_type` (`id`, `published`, `country_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'No', 1, 1, 1, '2017-05-18 14:26:20', '2017-05-18 14:29:14'),
(2, 'Yes', 1, 1, 1, '2017-05-18 14:27:43', NULL),
(3, 'Yes', 1, 1, 1, '2017-05-18 14:28:42', '2017-05-18 14:32:08');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_income_type_locale`
--

CREATE TABLE `beneficiary_profile_income_type_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_profile_income_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_profile_income_type_locale`
--

INSERT INTO `beneficiary_profile_income_type_locale` (`id`, `name`, `description`, `locale_id`, `beneficiary_profile_income_type_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Income test', 'Income', 1, 1, 1, 1, '2017-05-18 14:26:20', '2017-05-18 14:29:14'),
(2, 'Income test', 'Income', 2, 1, 1, 1, '2017-05-18 14:26:20', '2017-05-18 14:29:14'),
(3, 'Income1', 'Income', 1, 2, 1, 1, '2017-05-18 14:27:43', NULL),
(4, 'Income', 'Income', 2, 2, 1, 1, '2017-05-18 14:27:43', NULL),
(5, 'Income2', 'Income', 1, 3, 1, 1, '2017-05-18 14:28:42', '2017-05-18 14:32:08'),
(6, 'Income2', 'Income2', 2, 3, 1, 1, '2017-05-18 14:28:42', '2017-05-18 14:32:08');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_locale`
--

CREATE TABLE `beneficiary_profile_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_profile_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_profile_locale`
--

INSERT INTO `beneficiary_profile_locale` (`id`, `name`, `description`, `locale_id`, `beneficiary_profile_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Profile', 'Profile', 1, 1, 1, 1, '2017-05-16 12:21:11', '2017-05-18 11:32:10'),
(2, 'Profile', 'Profile', 2, 1, 1, 1, '2017-05-16 12:21:11', '2017-05-18 11:32:10'),
(3, 'Profile1', 'Profile1', 1, 2, 1, 1, '2017-05-18 10:30:32', '2017-05-18 10:46:34'),
(4, 'Profile1', 'Profile1', 2, 2, 1, 1, '2017-05-18 10:30:32', '2017-05-18 10:46:34'),
(5, 'Beneficiary', 'Beneficiary', 1, 3, 1, 1, '2017-05-18 10:43:11', '2017-05-18 10:46:22'),
(6, 'Beneficiary', 'Beneficiary', 2, 3, 1, 1, '2017-05-18 10:43:11', '2017-05-18 10:46:22');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_medical`
--

CREATE TABLE `beneficiary_profile_medical` (
  `id` int(11) UNSIGNED NOT NULL,
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `beneficiary_profile_family_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_medical_examination`
--

CREATE TABLE `beneficiary_profile_medical_examination` (
  `id` int(11) UNSIGNED NOT NULL,
  `doctor_mobile_number` varchar(17) NOT NULL DEFAULT '' COMMENT 'Optional, Textarea, Min:3, Max: 50',
  `doctor_phone_number` varchar(17) NOT NULL DEFAULT '' COMMENT 'Optional, Textarea, Min:3, Max: 50',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `beneficiary_profile_family_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_medical_examination_locale`
--

CREATE TABLE `beneficiary_profile_medical_examination_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `doctor_name` varchar(255) NOT NULL DEFAULT '',
  `doctor_address` varchar(1024) NOT NULL DEFAULT '' COMMENT 'Optional, Textarea, Min:3, Max: 50',
  `complaint` mediumtext NOT NULL,
  `examination` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:3, Max: 50',
  `treatment` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:3, Max: 50',
  `lab_results` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:3, Max: 50',
  `prescription` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:3, Max: 50',
  `procedure` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:3, Max: 50',
  `comment` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:3, Max: 50',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `beneficiary_profile_family_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `beneficiary_profile_medical_examination_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_medical_locale`
--

CREATE TABLE `beneficiary_profile_medical_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `current_medical_condition` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:3, Max: 50',
  `medical_history` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:3, Max: 50',
  `surgical_history` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:3, Max: 50',
  `family_history` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:3, Max: 50',
  `treatment_history` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:3, Max: 50',
  `lab_results_history` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:3, Max: 50',
  `prescription_history` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:3, Max: 50',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `beneficiary_profile_family_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `beneficiary_profile_medical_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_research_notes`
--

CREATE TABLE `beneficiary_profile_research_notes` (
  `id` int(11) UNSIGNED NOT NULL,
  `support_type` enum('Frequent','Emergency','Medical','Educational','Other') NOT NULL DEFAULT 'Frequent',
  `support_period` enum('Permanent','Once','Until healing','Until graduate') NOT NULL DEFAULT 'Permanent',
  `expected_support_period` enum('Permanent','Once','Until healing','Until graduate') NOT NULL DEFAULT 'Permanent',
  `support_modality` enum('Money','In-kind','Money and in-kind','Volunteer','By hand','Educate a family member','Employ a family member','Other') NOT NULL DEFAULT 'Money',
  `information_source` enum('Official documents','Work visit','Home visit','Trusted neighbors') NOT NULL DEFAULT 'Official documents',
  `has_small_business_idea` enum('Yes','No') NOT NULL DEFAULT 'No' COMMENT 'Optional, DropDownList',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_research_notes_locale`
--

CREATE TABLE `beneficiary_profile_research_notes_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `small_business_idea_description` varchar(255) NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:3, Max: 100',
  `researcher_recommendations` varchar(512) NOT NULL DEFAULT '',
  `researcher_name` varchar(255) NOT NULL DEFAULT '',
  `notes` varchar(512) NOT NULL DEFAULT '' COMMENT 'Optional, Textarea, Min:10, Max: 250',
  `committee_recommendations` varchar(512) NOT NULL DEFAULT '' COMMENT 'Optional, Textarea, Min:10, Max: 250',
  `committee_member_name` varchar(512) NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:8, Max: 50',
  `committee_manager_name` varchar(512) NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:8, Max: 50',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `beneficiary_profile_research_notes_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_spending`
--

CREATE TABLE `beneficiary_profile_spending` (
  `id` int(11) UNSIGNED NOT NULL,
  `beneficiary_profile_spending_type_id` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:1',
  `amount` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:1',
  `currency` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'USD',
  `currency_exchange_rate_id` int(11) UNSIGNED NOT NULL,
  `frequency` enum('Daily','Weekly','Monthly','Quarterly','Annual') DEFAULT 'Monthly',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_spending_type`
--

CREATE TABLE `beneficiary_profile_spending_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_profile_spending_type`
--

INSERT INTO `beneficiary_profile_spending_type` (`id`, `published`, `country_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'No', 1, 1, 1, '2017-05-19 05:51:35', '2017-05-19 11:05:54'),
(2, 'Yes', 1, 1, 1, '2017-05-19 06:05:53', '2017-05-19 11:05:54'),
(3, 'No', 1, 1, 1, '2017-05-19 06:15:39', '2017-05-19 11:05:54');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_spending_type_locale`
--

CREATE TABLE `beneficiary_profile_spending_type_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_profile_spending_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_profile_spending_type_locale`
--

INSERT INTO `beneficiary_profile_spending_type_locale` (`id`, `name`, `description`, `locale_id`, `beneficiary_profile_spending_type_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'test', 'sdsdd', 1, 1, 1, 1, '2017-05-19 05:51:35', '2017-05-19 11:05:54'),
(2, 'test', 'sdsds', 2, 1, 1, 1, '2017-05-19 05:51:35', '2017-05-19 11:05:54'),
(3, 'hello', 'fgfg', 1, 2, 1, 1, '2017-05-19 06:05:53', '2017-05-19 11:05:54'),
(4, 'hello', 'fdsff', 2, 2, 1, 1, '2017-05-19 06:05:53', '2017-05-19 11:05:54'),
(5, '124', 'dfdf', 1, 3, 1, 1, '2017-05-19 06:15:39', '2017-05-19 11:05:54'),
(6, '555', 'fdff', 2, 3, 1, 1, '2017-05-19 06:15:39', '2017-05-19 11:05:54'),
(7, 'test121', 'fdff', 2, 4, 1, 1, '2017-05-19 11:05:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_volunteer`
--

CREATE TABLE `beneficiary_profile_volunteer` (
  `id` int(11) UNSIGNED NOT NULL,
  `volunteer_type_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_volunteer_activity`
--

CREATE TABLE `beneficiary_profile_volunteer_activity` (
  `id` int(11) UNSIGNED NOT NULL,
  `sequence` tinyint(11) UNSIGNED NOT NULL DEFAULT '1',
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `beneficiary_profile_volunteer_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_volunteer_activity_locale`
--

CREATE TABLE `beneficiary_profile_volunteer_activity_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `beneficiary_profile_volunteer_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `beneficiary_profile_volunteer_activity_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_volunteer_locale`
--

CREATE TABLE `beneficiary_profile_volunteer_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `details` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT 'Optional, Textarea, Min:3, Max: 50',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `beneficiary_profile_volunteer_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_volunteer_type`
--

CREATE TABLE `beneficiary_profile_volunteer_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_profile_volunteer_type`
--

INSERT INTO `beneficiary_profile_volunteer_type` (`id`, `published`, `country_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(2, 'Yes', 1, 1, 1, '2017-05-18 05:45:24', '2017-05-18 09:24:59'),
(4, 'Yes', 1, 1, 1, '2017-05-18 09:22:21', '2017-05-18 09:24:59');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_profile_volunteer_type_locale`
--

CREATE TABLE `beneficiary_profile_volunteer_type_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_profile_volunteer_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_profile_volunteer_type_locale`
--

INSERT INTO `beneficiary_profile_volunteer_type_locale` (`id`, `name`, `description`, `locale_id`, `beneficiary_profile_volunteer_type_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(3, 'Volunteer 1', 'Volunteer1', 1, 2, 1, 1, '2017-05-18 05:45:24', '2017-05-18 09:24:59'),
(4, 'Volunteer', 'Volunteer', 2, 2, 1, 1, '2017-05-18 05:45:24', '2017-05-18 09:24:59'),
(7, 'Disabled', 'sdsdsd', 1, 4, 1, 1, '2017-05-18 09:22:21', '2017-05-18 09:24:59'),
(8, 'disabled', 'dsdsd', 2, 4, 1, 1, '2017-05-18 09:22:21', '2017-05-18 09:24:59');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_relation`
--

CREATE TABLE `beneficiary_relation` (
  `id` int(11) UNSIGNED NOT NULL,
  `allow_recurrence` enum('Yes','No') NOT NULL DEFAULT 'Yes' COMMENT 'Optional, DropDownList. For example, the father should not be allowed to be repeated for the same beneficiary',
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_relation`
--

INSERT INTO `beneficiary_relation` (`id`, `allow_recurrence`, `published`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'No', 'Yes', 1, 1, '2017-05-19 07:43:40', '2017-05-19 08:01:20'),
(2, 'Yes', 'No', 1, 1, '2017-05-19 08:01:20', '2017-05-19 08:01:29');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary_relation_locale`
--

CREATE TABLE `beneficiary_relation_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `locale_id` int(11) UNSIGNED NOT NULL,
  `beneficiary_relation_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beneficiary_relation_locale`
--

INSERT INTO `beneficiary_relation_locale` (`id`, `name`, `locale_id`, `beneficiary_relation_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Father', 1, 1, 1, 1, '2017-05-19 07:43:40', '2017-05-19 08:01:20'),
(2, 'Father', 2, 1, 1, 1, '2017-05-19 07:43:40', '2017-05-19 08:01:20'),
(3, 'Mother', 1, 2, 1, 1, '2017-05-19 08:01:20', '2017-05-19 08:01:29'),
(4, 'Mother', 2, 2, 1, 1, '2017-05-19 08:01:20', '2017-05-19 08:01:29');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) UNSIGNED NOT NULL,
  `country_id` int(11) UNSIGNED NOT NULL,
  `population_count` int(11) UNSIGNED DEFAULT NULL COMMENT 'Optional: Text Field, Min:1',
  `houses_count` int(11) UNSIGNED DEFAULT NULL COMMENT 'Optional: Text Field, Min:1',
  `distance_to_capital` int(11) UNSIGNED DEFAULT NULL COMMENT 'Optional: Text Field, Min:1',
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `country_id`, `population_count`, `houses_count`, `distance_to_capital`, `published`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 1, 1, 1, 1, 'Yes', 1, 1, '2017-05-11 14:32:06', '2017-05-12 07:50:35'),
(2, 1, 1, 1, 1, 'No', 1, 1, '2017-05-11 14:35:50', '2017-05-12 07:50:35'),
(3, 1, 1, 2, 3, 'Yes', 1, 1, '2017-05-12 05:17:55', '2017-05-12 07:50:35'),
(4, 1, 3, 2, 5, 'No', 1, 1, '2017-05-12 07:21:46', '2017-05-12 07:50:35'),
(5, 1, 4, 2, 5, 'Yes', 1, 1, '2017-05-12 07:50:35', '2017-05-13 06:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `city_locale`
--

CREATE TABLE `city_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `locale_id` int(11) UNSIGNED NOT NULL,
  `city_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `city_locale`
--

INSERT INTO `city_locale` (`id`, `name`, `locale_id`, `city_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'RAJKOT', 1, 1, 1, 1, '2017-05-11 14:32:06', '2017-05-12 07:50:35'),
(2, 'RAJKOT', 2, 1, 1, 1, '2017-05-11 14:32:06', '2017-05-12 07:50:35'),
(3, 'RAJKOT', 17, 1, 1, 1, '2017-05-11 14:32:06', NULL),
(4, 'RAJKOT', 18, 1, 1, 1, '2017-05-11 14:32:06', NULL),
(5, 'RAJKOT', 19, 1, 1, 1, '2017-05-11 14:32:06', NULL),
(6, 'AHEMDABAD', 1, 2, 1, 1, '2017-05-11 14:35:50', '2017-05-12 07:50:35'),
(7, 'AHEMDABAD', 2, 2, 1, 1, '2017-05-11 14:35:50', '2017-05-12 07:50:35'),
(8, 'AHEMDABAD', 17, 2, 1, 1, '2017-05-11 14:35:50', NULL),
(9, 'AHEMDABAD', 18, 2, 1, 1, '2017-05-11 14:35:50', NULL),
(10, 'AHEMDABAD', 19, 2, 1, 1, '2017-05-11 14:35:50', NULL),
(11, 'Rajkot', 1, 3, 1, 1, '2017-05-12 05:17:55', '2017-05-12 07:50:35'),
(12, 'Rajkot', 2, 3, 1, 1, '2017-05-12 05:17:55', '2017-05-12 07:50:35'),
(13, 'RAJKOT', 1, 4, 1, 1, '2017-05-12 07:21:46', '2017-05-12 07:50:35'),
(14, 'RAJKOT', 2, 4, 1, 1, '2017-05-12 07:21:46', '2017-05-12 07:50:35'),
(15, 'Morbi', 1, 5, 1, 1, '2017-05-12 07:50:35', '2017-05-13 06:53:54'),
(16, 'RAJKOT', 2, 5, 1, 1, '2017-05-12 07:50:35', '2017-05-13 06:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE `configuration` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `config_key` varchar(512) NOT NULL,
  `config_value` varchar(2048) NOT NULL,
  `config_type` enum('System','Website','Organization','Beneficiary','Donor','Payment','Agent','Project','Post') NOT NULL DEFAULT 'System',
  `allow_override` enum('Yes','No') NOT NULL DEFAULT 'No',
  `force` enum('Yes','No') NOT NULL DEFAULT 'No',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `environment` enum('DEV','STG','LIVE') NOT NULL DEFAULT 'LIVE',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`id`, `name`, `description`, `config_key`, `config_value`, `config_type`, `allow_override`, `force`, `published`, `environment`, `organization_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, ' Configurations', 'Configurations', ' Configurations', ' Configurations', 'System', 'Yes', 'No', 'Yes', 'DEV', 1, 1, 1, '2017-05-12 05:14:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) UNSIGNED NOT NULL,
  `iso_code_2` varchar(2) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:2, Max:2',
  `iso_code_3` varchar(3) COLLATE utf8_bin NOT NULL DEFAULT '',
  `default_currency` varchar(3) COLLATE utf8_bin NOT NULL DEFAULT 'USD',
  `published` enum('Yes','No') COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `iso_code_2`, `iso_code_3`, `default_currency`, `published`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'US', 'US', 'USD', 'Yes', 1, 1, '2017-05-12 04:37:38', '2017-05-15 09:12:05');

-- --------------------------------------------------------

--
-- Table structure for table `country_locale`
--

CREATE TABLE `country_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `locale_id` int(11) UNSIGNED NOT NULL,
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country_locale`
--

INSERT INTO `country_locale` (`id`, `name`, `locale_id`, `country_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'INDIA', 1, 1, 1, 1, '2017-05-12 04:38:06', '2017-05-15 09:12:05');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) UNSIGNED NOT NULL,
  `currency` varchar(3) NOT NULL COMMENT 'currency short code like JOD, USD',
  `name` varchar(255) NOT NULL COMMENT 'Language representation in English language only like US Dollar',
  `currency_title` varchar(255) DEFAULT NULL COMMENT 'Language representation in orginal language like دينار أردني',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `sequence` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `currency_exchange_rate`
--

CREATE TABLE `currency_exchange_rate` (
  `id` int(11) UNSIGNED NOT NULL,
  `from_currency` varchar(3) NOT NULL COMMENT 'currency_exchange_rate short code like JOD, USD',
  `to_currency` varchar(255) DEFAULT NULL COMMENT 'Language representation in orginal language like دينار أردني',
  `exchange_rate` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `death_reason`
--

CREATE TABLE `death_reason` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `death_reason`
--

INSERT INTO `death_reason` (`id`, `published`, `country_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Yes', 1, 1, 1, '2017-05-12 05:07:00', '2017-05-15 09:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `death_reason_locale`
--

CREATE TABLE `death_reason_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `death_reason_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `death_reason_locale`
--

INSERT INTO `death_reason_locale` (`id`, `name`, `description`, `locale_id`, `death_reason_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Death1', 'Death1', 1, 1, 1, 1, '2017-05-12 05:07:00', '2017-05-15 09:10:54'),
(2, 'Death1', 'Death1', 2, 1, 1, 1, '2017-05-12 05:07:00', '2017-05-15 09:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `id` int(11) UNSIGNED NOT NULL,
  `sequence` int(11) UNSIGNED NOT NULL,
  `ssn` varchar(32) NOT NULL DEFAULT '',
  `title` enum('Mr.','Mrs.','Miss','Ms.') NOT NULL DEFAULT 'Mr.',
  `gender` enum('Male','Female') NOT NULL DEFAULT 'Male',
  `email` varchar(255) NOT NULL DEFAULT '',
  `date_of_birth` date NOT NULL,
  `phone_number` varchar(17) NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:12, Max: 14',
  `mobile_number` varchar(17) NOT NULL DEFAULT '',
  `mobile_number_2` varchar(17) NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:12, Max: 14',
  `avatar` varchar(1024) NOT NULL DEFAULT '',
  `visibility` enum('Anonymous','Visible') NOT NULL DEFAULT 'Visible',
  `nationality_id` int(11) UNSIGNED NOT NULL,
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `notes` varchar(1024) NOT NULL DEFAULT '' COMMENT 'Optional, Textarea, Min:10, Max:500',
  `options` varchar(1024) NOT NULL DEFAULT '' COMMENT 'Optional, Any other-future info will be saved serialize array key=>value'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `donor_locale`
--

CREATE TABLE `donor_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `second_name` varchar(255) NOT NULL DEFAULT '',
  `third_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `donor_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `education_level`
--

CREATE TABLE `education_level` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `education_level`
--

INSERT INTO `education_level` (`id`, `published`, `country_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'No', 1, 1, 1, '2017-05-12 05:04:52', '2017-05-16 05:10:41');

-- --------------------------------------------------------

--
-- Table structure for table `education_level_locale`
--

CREATE TABLE `education_level_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `education_level_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `education_level_locale`
--

INSERT INTO `education_level_locale` (`id`, `name`, `description`, `locale_id`, `education_level_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Level1', 'Level1', 1, 1, 1, 1, '2017-05-12 05:04:52', '2017-05-16 05:10:41'),
(2, 'Level1', 'Level1', 2, 1, 1, 1, '2017-05-12 05:04:52', '2017-05-16 05:10:41');

-- --------------------------------------------------------

--
-- Table structure for table `gl_account`
--

CREATE TABLE `gl_account` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sequence` int(11) UNSIGNED NOT NULL,
  `gl_account_type_id` int(11) UNSIGNED NOT NULL,
  `transaction_type` enum('D','C') NOT NULL DEFAULT 'D',
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `current_balance` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `is_main` tinyint(3) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `is_leaf` tinyint(3) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gl_account_locale`
--

CREATE TABLE `gl_account_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `gl_account_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gl_account_type`
--

CREATE TABLE `gl_account_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gl_account_type_locale`
--

CREATE TABLE `gl_account_type_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `gl_account_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `homepage_slider`
--

CREATE TABLE `homepage_slider` (
  `id` int(11) UNSIGNED NOT NULL,
  `sequence` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `animation_type_id` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'slide, fade, bars',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `homepage_slider_locale`
--

CREATE TABLE `homepage_slider_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `intro_text` mediumtext NOT NULL,
  `more_link` mediumtext NOT NULL,
  `locale_id` int(11) UNSIGNED NOT NULL,
  `organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `homepage_slider_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `locale`
--

CREATE TABLE `locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `locale` varchar(6) NOT NULL COMMENT 'Locale short code like ar-SA',
  `name` varchar(255) NOT NULL COMMENT 'Language representation in English language only like Arabic - Saudi Arabia',
  `locale_title` varchar(255) DEFAULT NULL COMMENT 'Language representation in orginal language like العربية',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `status` enum('Draft','Pending','Active','Blocked','Deleted') NOT NULL DEFAULT 'Draft',
  `sequence` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `icon` varchar(1024) NOT NULL DEFAULT '',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locale`
--

INSERT INTO `locale` (`id`, `locale`, `name`, `locale_title`, `published`, `status`, `sequence`, `country_id`, `icon`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'US', 'English', 'English', 'Yes', 'Active', 1, 1, '', 1, 1, '2017-05-12 05:09:58', NULL),
(2, 'AR', 'Arabic', 'Arabic', 'Yes', 'Active', 1, 1, '', 1, 1, '2017-05-12 05:11:33', '2017-05-13 06:53:15');

-- --------------------------------------------------------

--
-- Table structure for table `marital_status`
--

CREATE TABLE `marital_status` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marital_status`
--

INSERT INTO `marital_status` (`id`, `published`, `country_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Yes', 1, 1, 1, '2017-05-12 05:04:06', '2017-05-18 12:27:04'),
(2, 'No', 1, 1, 1, '2017-05-13 06:42:08', NULL),
(3, 'Yes', 1, 1, 1, '2017-05-15 06:28:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `marital_status_locale`
--

CREATE TABLE `marital_status_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `marital_status_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marital_status_locale`
--

INSERT INTO `marital_status_locale` (`id`, `name`, `description`, `locale_id`, `marital_status_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Single', 'Single', 1, 1, 1, 1, NULL, '2017-05-18 12:27:04'),
(2, 'Single', 'Single', 2, 1, 1, 1, NULL, '2017-05-18 12:27:04'),
(3, 'single1', 'single1', 1, 2, 1, 1, NULL, NULL),
(4, 'single1', '', 2, 2, 1, 1, NULL, NULL),
(5, 'Merried', 'Merried', 1, 3, 1, 1, NULL, NULL),
(6, 'Merried', 'Merried', 2, 3, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media_category`
--

CREATE TABLE `media_category` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `media_category`
--

INSERT INTO `media_category` (`id`, `name`, `published`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Media', 'No', 1, 1, NULL, '2017-05-13 10:03:40'),
(2, 'Media Categories', 'Yes', 1, 1, NULL, '2017-05-13 10:03:40');

-- --------------------------------------------------------

--
-- Table structure for table `media_filetype`
--

CREATE TABLE `media_filetype` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `media_filetype`
--

INSERT INTO `media_filetype` (`id`, `published`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Yes', 1, 1, NULL, '2017-05-15 09:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `media_filetype_locale`
--

CREATE TABLE `media_filetype_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `media_filetype_id` int(11) UNSIGNED NOT NULL,
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `media_filetype_locale`
--

INSERT INTO `media_filetype_locale` (`id`, `name`, `description`, `locale_id`, `media_filetype_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Media1', 'Media1', 1, 1, 1, 1, NULL, '2017-05-15 09:11:03'),
(2, 'Media1', 'Media1', 2, 1, 1, 1, NULL, '2017-05-15 09:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `media_status`
--

CREATE TABLE `media_status` (
  `id` int(11) UNSIGNED NOT NULL,
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `media_status`
--

INSERT INTO `media_status` (`id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 1, 1, NULL, '2017-05-13 07:47:20'),
(2, 1, 1, '2017-05-13 07:45:51', '2017-05-13 08:04:41');

-- --------------------------------------------------------

--
-- Table structure for table `media_status_locale`
--

CREATE TABLE `media_status_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `media_status_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `media_status_locale`
--

INSERT INTO `media_status_locale` (`id`, `name`, `description`, `locale_id`, `media_status_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Media Statuses', 'Media Statuses', 1, 1, 1, 1, NULL, '2017-05-13 07:47:20'),
(2, 'Media Statuses', 'Media Statuses', 2, 1, 1, 1, NULL, '2017-05-13 07:47:20'),
(3, 'Media Statuses1', 'Media Statuses1', 1, 2, 1, 1, '2017-05-13 07:45:51', '2017-05-13 08:04:41'),
(4, 'Media Statuses1', 'Media Statuses1', 2, 2, 1, 1, '2017-05-13 07:45:51', '2017-05-13 08:04:41');

-- --------------------------------------------------------

--
-- Table structure for table `media_type`
--

CREATE TABLE `media_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `media_category_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `media_type`
--

INSERT INTO `media_type` (`id`, `media_category_id`, `published`, `country_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 2, 'No', 1, 1, 1, '2017-05-13 11:04:28', '2017-05-13 11:25:23'),
(2, 1, 'Yes', 1, 1, 1, '2017-05-13 11:11:27', '2017-05-13 11:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `media_type_locale`
--

CREATE TABLE `media_type_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `media_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `media_type_locale`
--

INSERT INTO `media_type_locale` (`id`, `name`, `description`, `locale_id`, `media_type_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Media', 'Media', 1, 1, 1, 1, '2017-05-13 11:04:28', '2017-05-13 11:25:23'),
(2, 'Media', 'Media', 2, 1, 1, 1, '2017-05-13 11:04:28', '2017-05-13 11:25:23'),
(3, 'media11', 'media', 1, 2, 1, 1, '2017-05-13 11:11:27', '2017-05-13 11:26:09'),
(4, 'media11', 'media', 2, 2, 1, 1, '2017-05-13 11:11:27', '2017-05-13 11:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `medical_condition`
--

CREATE TABLE `medical_condition` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medical_condition`
--

INSERT INTO `medical_condition` (`id`, `published`, `country_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Yes', 1, 1, 1, '2017-05-12 05:06:32', '2017-05-13 06:52:32');

-- --------------------------------------------------------

--
-- Table structure for table `medical_condition_locale`
--

CREATE TABLE `medical_condition_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `medical_condition_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medical_condition_locale`
--

INSERT INTO `medical_condition_locale` (`id`, `name`, `description`, `locale_id`, `medical_condition_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Medical1', 'Medical1', 1, 1, 1, 1, '2017-05-12 05:06:32', '2017-05-13 06:52:32'),
(2, 'Medical1', 'Medical1', 2, 1, 1, 1, '2017-05-12 05:06:32', '2017-05-13 06:52:32');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('Draft','Pending','Active','Blocked','Deleted') NOT NULL DEFAULT 'Draft',
  `sequence` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `menu_category_id` int(11) UNSIGNED NOT NULL,
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_branch_id` int(11) UNSIGNED NOT NULL,
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menu_category`
--

CREATE TABLE `menu_category` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `status` enum('Draft','Pending','Active','Inactive','Deleted') NOT NULL DEFAULT 'Draft',
  `sequence` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_category`
--

INSERT INTO `menu_category` (`id`, `published`, `status`, `sequence`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'No', 'Active', 1, 1, 1, '2017-05-12 04:58:45', '2017-05-12 05:03:06');

-- --------------------------------------------------------

--
-- Table structure for table `menu_category_locale`
--

CREATE TABLE `menu_category_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `menu_category_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_category_locale`
--

INSERT INTO `menu_category_locale` (`id`, `name`, `description`, `locale_id`, `menu_category_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Top Menu', 'Top Menu', 1, 1, 1, 1, '2017-05-12 04:58:45', '2017-05-12 05:03:06'),
(2, 'Top Menu', 'Top Menu', 2, 1, 1, 1, '2017-05-12 04:58:45', '2017-05-12 05:03:06');

-- --------------------------------------------------------

--
-- Table structure for table `menu_item`
--

CREATE TABLE `menu_item` (
  `id` int(11) UNSIGNED NOT NULL,
  `menu_id` int(11) UNSIGNED NOT NULL,
  `parent_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `sequence` int(11) UNSIGNED DEFAULT '0',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menu_item_locale`
--

CREATE TABLE `menu_item_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` mediumtext NOT NULL,
  `locale_id` int(11) UNSIGNED NOT NULL,
  `menu_item_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `message_inbox`
--

CREATE TABLE `message_inbox` (
  `id` int(11) NOT NULL,
  `message_type_id` int(11) UNSIGNED NOT NULL,
  `number` varchar(255) NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:1, Max: 50',
  `from_name` varchar(255) NOT NULL DEFAULT '',
  `from_department` varchar(255) NOT NULL DEFAULT '',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `received_at` datetime NOT NULL COMMENT 'Optional, Calender',
  `organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_branch_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `message_media_gallery`
--

CREATE TABLE `message_media_gallery` (
  `id` int(11) UNSIGNED NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `intro_text` mediumtext NOT NULL,
  `size` int(11) UNSIGNED NOT NULL,
  `mime_type` varchar(32) NOT NULL,
  `path` varchar(1024) NOT NULL DEFAULT '',
  `media_type_id` tinyint(3) UNSIGNED DEFAULT '0',
  `media_filetype_id` tinyint(3) UNSIGNED DEFAULT '0',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `media_status_id` tinyint(3) UNSIGNED DEFAULT '0',
  `sequence` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `message_id` int(11) UNSIGNED NOT NULL,
  `organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `message_media_youtube_gallery`
--

CREATE TABLE `message_media_youtube_gallery` (
  `id` int(11) UNSIGNED NOT NULL,
  `youtube_link` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `intro_text` mediumtext NOT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `media_status_id` tinyint(3) UNSIGNED DEFAULT '0',
  `sequence` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `message_id` int(11) UNSIGNED NOT NULL,
  `organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `message_outbox`
--

CREATE TABLE `message_outbox` (
  `id` int(11) NOT NULL,
  `message_type_id` int(11) UNSIGNED NOT NULL,
  `message_template_id` int(11) UNSIGNED NOT NULL,
  `number` varchar(255) NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:1, Max: 50',
  `from_mail` varchar(255) NOT NULL DEFAULT '',
  `from_name` varchar(255) NOT NULL DEFAULT '',
  `from_department` varchar(255) NOT NULL DEFAULT '',
  `to_mail` varchar(255) NOT NULL DEFAULT '',
  `to_name` varchar(255) NOT NULL DEFAULT '',
  `to_department` varchar(255) NOT NULL DEFAULT '',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `send_at` datetime NOT NULL COMMENT 'Optional, Calender',
  `organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_branch_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `message_template`
--

CREATE TABLE `message_template` (
  `id` int(11) NOT NULL,
  `message_type_id` int(11) UNSIGNED NOT NULL,
  `message_type` enum('Organization','Donor','Beneficiary') NOT NULL COMMENT 'From session',
  `from_mobile_number` varchar(255) NOT NULL DEFAULT '',
  `from_email` varchar(255) NOT NULL DEFAULT '',
  `to_mobile_number` varchar(255) NOT NULL DEFAULT '',
  `to_email` varchar(255) NOT NULL DEFAULT '',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message_template`
--

INSERT INTO `message_template` (`id`, `message_type_id`, `message_type`, `from_mobile_number`, `from_email`, `to_mobile_number`, `to_email`, `published`, `organization_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 2, 'Donor', '1234567890', 'test@gmail.com', '9876543210', 'test1@gmail.com', 'Yes', 1, 1, 1, '2017-05-13 13:34:00', NULL),
(2, 1, 'Organization', 'hjkhjk', 'hjkjhk', 'jhkhj', 'jhkjhkjh', 'Yes', 1, 1, 1, '2017-05-13 13:37:40', NULL),
(3, 1, 'Organization', 'hjkhjk', 'hjkjhk', 'jhkhj', 'jhkjhkjh', 'Yes', 1, 1, 1, '2017-05-13 13:37:45', NULL),
(4, 1, 'Organization', 'hjkhjk', 'hjkjhk', 'jhkhj', 'jhkjhkjh', 'Yes', 1, 1, 1, '2017-05-13 13:42:32', NULL),
(5, 1, 'Organization', 'hjkhjk', 'hjkjhk', 'jhkhj', 'jhkjhkjh', 'Yes', 1, 1, 1, '2017-05-13 13:45:42', NULL),
(6, 1, 'Organization', 'hjkhjk', 'hjkjhk', 'jhkhj', 'jhkjhkjh', 'Yes', 1, 1, 1, '2017-05-13 13:45:44', NULL),
(7, 1, 'Organization', 'hjkhjk', 'hjkjhk', 'jhkhj', 'jhkjhkjh', 'Yes', 1, 1, 1, '2017-05-13 13:46:56', NULL),
(8, 1, 'Organization', 'hjkhjk', 'hjkjhk', 'jhkhj', 'jhkjhkjh', 'Yes', 1, 1, 1, '2017-05-13 13:47:36', NULL),
(9, 1, 'Donor', 'vbnvbn', 'vbnvbnbv', 'bvnbvnbv', 'bnbvnbv', 'Yes', 1, 1, 1, '2017-05-13 13:49:41', NULL),
(10, 1, 'Donor', 'vbnvbn', 'vbnvbnbv', 'bvnbvnbv', 'bnbvnbv', 'Yes', 1, 1, 1, '2017-05-13 13:50:58', NULL),
(11, 2, 'Donor', 'gfhgfhf', 'hghg', 'ghgfhfg', 'fhgfhgfh', 'No', 1, 1, 1, '2017-05-13 13:56:46', '2017-05-15 05:58:18'),
(12, 2, 'Donor', 'gfhgfhf', 'hghg', 'ghgfhfg', 'fhgfhgfh', 'Yes', 1, 1, 1, '2017-05-13 13:58:38', '2017-05-15 05:53:58'),
(13, 2, 'Donor', '123546535', 'test@gmail.com', '52754421354', 'test@gmail.com', 'Yes', 1, 1, 1, '2017-05-13 14:02:05', '2017-05-15 09:11:36'),
(14, 2, 'Donor', '123546535', 'test@gmail.com', '52754421354', 'test@gmail.com', 'No', 1, 1, 1, '2017-05-15 05:52:28', '2017-05-15 05:53:58');

-- --------------------------------------------------------

--
-- Table structure for table `message_template_locale`
--

CREATE TABLE `message_template_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `from_name` varchar(255) NOT NULL DEFAULT '',
  `to_name` varchar(255) NOT NULL DEFAULT '',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `message_template_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message_template_locale`
--

INSERT INTO `message_template_locale` (`id`, `from_name`, `to_name`, `subject`, `description`, `locale_id`, `message_template_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'sdfdsf1', 'dsfdsf', 'dsfdsf', 'dsfdsfds', 1, 11, 1, 1, '2017-05-13 13:56:46', '2017-05-15 05:58:18'),
(2, 'gfhgfhgfh', 'hgfhgf', 'gfhgfh', 'gfhgf', 2, 11, 1, 1, '2017-05-13 13:56:46', '2017-05-15 05:58:18'),
(3, 'sdfdsf', 'dsfdsf', 'dsfdsf', 'dsfdsfds', 1, 12, 1, 1, '2017-05-13 13:58:38', '2017-05-15 05:53:58'),
(4, 'gfhgfhgfh', 'hgfhgf', 'gfhgfh', 'gfhgf', 2, 12, 1, 1, '2017-05-13 13:58:38', '2017-05-15 05:53:58'),
(5, 'test', 'test', 'test1', 'test', 1, 13, 1, 1, '2017-05-13 14:02:05', '2017-05-15 09:11:36'),
(6, 'test2', 'test2', 'test2', 'test2', 2, 13, 1, 1, '2017-05-13 14:02:05', '2017-05-15 09:11:36'),
(7, 'test1', 'test', 'test1', 'test', 1, 14, 1, 1, '2017-05-15 05:52:28', '2017-05-15 05:53:58'),
(8, 'test2', 'test2', 'test2', 'test2', 2, 14, 1, 1, '2017-05-15 05:52:28', '2017-05-15 05:53:58');

-- --------------------------------------------------------

--
-- Table structure for table `message_type`
--

CREATE TABLE `message_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message_type`
--

INSERT INTO `message_type` (`id`, `published`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'No', 1, 1, '2017-05-13 09:03:25', '2017-05-15 09:11:20'),
(2, 'Yes', 1, 1, '2017-05-13 09:09:22', '2017-05-13 09:09:34');

-- --------------------------------------------------------

--
-- Table structure for table `message_type_locale`
--

CREATE TABLE `message_type_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `message_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message_type_locale`
--

INSERT INTO `message_type_locale` (`id`, `name`, `description`, `locale_id`, `message_type_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Message Types', 'Message Types', 1, 1, 1, 1, '2017-05-13 09:03:25', '2017-05-15 09:11:20'),
(2, 'Message Types', 'Message Types', 2, 1, 1, 1, '2017-05-13 09:03:25', '2017-05-15 09:11:20'),
(3, 'Message ', 'Message ', 1, 2, 1, 1, '2017-05-13 09:09:22', '2017-05-13 09:09:34'),
(4, 'Message ', 'Message ', 2, 2, 1, 1, '2017-05-13 09:09:22', '2017-05-13 09:09:34');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `id` int(11) UNSIGNED NOT NULL,
  `organization_type_id` int(11) UNSIGNED NOT NULL,
  `status` enum('Draft','Approved','In Review','Duplicate','Deleted') NOT NULL DEFAULT 'Draft',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `notes` varchar(1024) NOT NULL DEFAULT '' COMMENT 'Optional, Textarea, Min:10, Max:500',
  `options` varchar(1024) NOT NULL DEFAULT '' COMMENT 'Optional, Any other-future info will be saved serialize array key=>value'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_asset`
--

CREATE TABLE `organization_asset` (
  `id` int(11) UNSIGNED NOT NULL,
  `asset_id` int(11) UNSIGNED NOT NULL,
  `asset_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `asset_unit_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `cost` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `tax_value` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `tax_type` enum('Fixed','Percent','None') NOT NULL DEFAULT 'None',
  `currency` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'USD',
  `currency_exchange_rate_id` int(11) UNSIGNED NOT NULL,
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_branch_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_asset_liability`
--

CREATE TABLE `organization_asset_liability` (
  `id` int(11) UNSIGNED NOT NULL,
  `organization_asset_id` int(11) UNSIGNED NOT NULL,
  `asset_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `asset_unit_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `quantity` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `quantity_original` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `cost` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `total_value` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `tax_value` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `tax_type` enum('Fixed','Percent','None') NOT NULL DEFAULT 'None',
  `currency` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'USD',
  `currency_exchange_rate_id` int(11) UNSIGNED NOT NULL,
  `receipt_number` varchar(50) DEFAULT NULL,
  `date_expire` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `sku` varchar(255) DEFAULT NULL COMMENT 'FROM Session',
  `serial` varchar(255) DEFAULT NULL COMMENT 'FROM Session',
  `asset_condition_id` int(11) UNSIGNED NOT NULL,
  `organization_asset_location_id` int(11) UNSIGNED NOT NULL,
  `donor_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_branch_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_asset_location`
--

CREATE TABLE `organization_asset_location` (
  `id` int(11) UNSIGNED NOT NULL,
  `geo_location` varchar(1024) NOT NULL DEFAULT '' COMMENT 'Optional',
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_branch_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_asset_location_locale`
--

CREATE TABLE `organization_asset_location_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_branch_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_asset_location_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_asset_received`
--

CREATE TABLE `organization_asset_received` (
  `id` int(11) UNSIGNED NOT NULL,
  `organization_asset_id` int(11) UNSIGNED NOT NULL,
  `asset_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `asset_unit_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `asset_quantity` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `asset_condition_id` int(11) UNSIGNED NOT NULL,
  `asset_value` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `receipt_number` varchar(50) DEFAULT NULL,
  `donor_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_branch_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_asset_required`
--

CREATE TABLE `organization_asset_required` (
  `id` int(11) UNSIGNED NOT NULL,
  `organization_asset_id` int(11) UNSIGNED NOT NULL,
  `asset_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `asset_unit_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `asset_condition_id` int(11) UNSIGNED NOT NULL,
  `asset_quantity` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `status` enum('Pending','Received') DEFAULT 'Pending',
  `organization_asset_received_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_asset_received_date` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_branch_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_branch`
--

CREATE TABLE `organization_branch` (
  `id` int(11) UNSIGNED NOT NULL,
  `mobile_number` varchar(17) NOT NULL DEFAULT '',
  `mobile_number_2` varchar(17) NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:12, Max: 14',
  `phone_number` varchar(17) NOT NULL DEFAULT '',
  `fax` varchar(17) NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:12, Max: 14',
  `country_id` int(11) UNSIGNED NOT NULL,
  `city_id` int(11) UNSIGNED NOT NULL,
  `manager_id` int(11) UNSIGNED NOT NULL,
  `work_days` varchar(255) NOT NULL DEFAULT '',
  `work_hours` varchar(255) NOT NULL DEFAULT '',
  `break_hours` varchar(255) NOT NULL DEFAULT '' COMMENT 'Optional',
  `geo_location` varchar(1024) NOT NULL DEFAULT '' COMMENT 'Optional',
  `is_main_branch` enum('Yes','No') NOT NULL DEFAULT 'No',
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_branch_committee`
--

CREATE TABLE `organization_branch_committee` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_branch_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_branch_committee_locale`
--

CREATE TABLE `organization_branch_committee_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `agenda` varchar(1024) NOT NULL DEFAULT '' COMMENT 'Optional, Textarea, Min:10, Max: 500',
  `annual_plan` varchar(1024) NOT NULL DEFAULT '' COMMENT 'Optional, Textarea, Min:10, Max: 500',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `organization_branch_committee_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_branch_committee_user`
--

CREATE TABLE `organization_branch_committee_user` (
  `id` int(11) UNSIGNED NOT NULL,
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_user_position_id` int(11) UNSIGNED NOT NULL,
  `organization_branch_id` int(11) UNSIGNED NOT NULL,
  `organization_branch_committee_id` int(11) UNSIGNED NOT NULL,
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_branch_locale`
--

CREATE TABLE `organization_branch_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `address` varchar(255) NOT NULL DEFAULT '',
  `website` varchar(255) NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:5, Max:255',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_branch_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_flag`
--

CREATE TABLE `organization_flag` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organization_flag`
--

INSERT INTO `organization_flag` (`id`, `published`, `country_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'No', 1, 1, 1, NULL, NULL),
(2, 'No', 1, 1, 1, NULL, NULL),
(3, 'No', 1, 1, 1, NULL, NULL),
(4, 'No', 1, 1, 1, NULL, NULL),
(5, 'Yes', 1, 1, 1, NULL, NULL),
(7, 'No', 1, 1, 1, NULL, '2017-05-19 11:04:11'),
(8, 'Yes', 1, 1, 1, NULL, '2017-05-19 11:00:33'),
(9, 'No', 1, 1, 1, NULL, '2017-05-19 11:03:59'),
(10, 'Yes', 1, 1, 1, NULL, NULL),
(11, 'No', 1, 1, 1, NULL, '2017-05-19 11:03:59');

-- --------------------------------------------------------

--
-- Table structure for table `organization_flag_locale`
--

CREATE TABLE `organization_flag_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `flag_name` varchar(255) NOT NULL DEFAULT '',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `organization_flag_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organization_flag_locale`
--

INSERT INTO `organization_flag_locale` (`id`, `flag_name`, `locale_id`, `organization_flag_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(3, 'test', 1, 7, 1, 1, NULL, '2017-05-19 11:04:11'),
(4, 'nbn', 2, 7, 1, 1, NULL, '2017-05-19 11:04:11'),
(5, 'test123', 1, 8, 1, 1, NULL, '2017-05-19 11:00:33'),
(6, 'test123', 2, 8, 1, 1, NULL, '2017-05-19 11:00:33'),
(7, 'hello121', 1, 9, 1, 1, NULL, '2017-05-19 11:03:59'),
(8, 'hello 121', 2, 9, 1, 1, NULL, '2017-05-19 11:03:59'),
(9, 'pravin', 1, 10, 1, 1, NULL, NULL),
(10, 'pravin', 2, 10, 1, 1, NULL, NULL),
(11, 'test111', 1, 11, 1, 1, NULL, '2017-05-19 11:03:59'),
(12, 'test111', 2, 11, 1, 1, NULL, '2017-05-19 11:03:59');

-- --------------------------------------------------------

--
-- Table structure for table `organization_has_flag`
--

CREATE TABLE `organization_has_flag` (
  `id` int(11) UNSIGNED NOT NULL,
  `organization_flag_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `flag_value` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_locale`
--

CREATE TABLE `organization_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `logo` varchar(1024) NOT NULL DEFAULT '',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_media_gallery`
--

CREATE TABLE `organization_media_gallery` (
  `id` int(11) UNSIGNED NOT NULL,
  `size` int(11) UNSIGNED NOT NULL,
  `mime_type` varchar(32) NOT NULL,
  `path` varchar(1024) NOT NULL DEFAULT '',
  `media_type_id` tinyint(3) UNSIGNED DEFAULT '0',
  `media_filetype_id` tinyint(3) UNSIGNED DEFAULT '0',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `media_status_id` tinyint(3) UNSIGNED DEFAULT '0',
  `sequence` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_branch_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_media_gallery_locale`
--

CREATE TABLE `organization_media_gallery_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `intro_text` mediumtext NOT NULL,
  `locale_id` int(11) UNSIGNED NOT NULL,
  `organization_media_gallery_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_media_youtube_gallery`
--

CREATE TABLE `organization_media_youtube_gallery` (
  `id` int(11) UNSIGNED NOT NULL,
  `youtube_link` varchar(255) NOT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `media_status_id` tinyint(3) UNSIGNED DEFAULT '0',
  `sequence` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_branch_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_media_youtube_gallery_locale`
--

CREATE TABLE `organization_media_youtube_gallery_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `intro_text` mediumtext NOT NULL,
  `locale_id` int(11) UNSIGNED NOT NULL,
  `organization_media_youtube_gallery_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_task`
--

CREATE TABLE `organization_task` (
  `id` int(11) UNSIGNED NOT NULL,
  `assignee_id` int(11) UNSIGNED NOT NULL,
  `status` enum('Draft','Accepted','In Progress','Completed','Canceled') NOT NULL DEFAULT 'Draft',
  `start_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_branch_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_task_locale`
--

CREATE TABLE `organization_task_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `organization_task_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_type`
--

CREATE TABLE `organization_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organization_type`
--

INSERT INTO `organization_type` (`id`, `published`, `country_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Yes', 1, 1, 1, '2017-05-19 10:09:32', '2017-05-19 10:12:52'),
(2, 'No', 1, 1, 1, '2017-05-19 10:11:01', '2017-05-19 10:13:03');

-- --------------------------------------------------------

--
-- Table structure for table `organization_type_locale`
--

CREATE TABLE `organization_type_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organization_type_locale`
--

INSERT INTO `organization_type_locale` (`id`, `name`, `description`, `locale_id`, `organization_user_id`, `organization_type_id`, `date_added`, `date_updated`) VALUES
(1, 'Ministry of Social Development', 'Ministry of Social Development', 1, 1, 1, '2017-05-19 10:09:32', '2017-05-19 10:12:52'),
(2, 'Ministry of Social Development', 'Ministry of Social Development', 2, 1, 1, '2017-05-19 10:09:32', '2017-05-19 10:12:52'),
(3, 'Zakat Fund', 'Zakat Fund', 1, 1, 2, '2017-05-19 10:11:01', '2017-05-19 10:13:03'),
(4, 'Zakat Fund', 'Zakat Fund', 2, 1, 2, '2017-05-19 10:11:01', '2017-05-19 10:13:03');

-- --------------------------------------------------------

--
-- Table structure for table `organization_user`
--

CREATE TABLE `organization_user` (
  `id` int(11) UNSIGNED NOT NULL,
  `ssn` varchar(32) NOT NULL DEFAULT '',
  `title` enum('Mr.','Mrs.','Miss','Ms.') NOT NULL DEFAULT 'Mr.',
  `gender` enum('Male','Female') NOT NULL DEFAULT 'Male',
  `email` varchar(255) NOT NULL DEFAULT '',
  `date_of_birth` date NOT NULL,
  `mobile_number` varchar(17) NOT NULL DEFAULT '',
  `mobile_number_2` varchar(17) NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:12, Max: 14',
  `phone_number` varchar(17) NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:12, Max: 14',
  `nationality_id` int(11) UNSIGNED NOT NULL,
  `avatar` varchar(1024) NOT NULL DEFAULT '',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_branch_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_user_locale`
--

CREATE TABLE `organization_user_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `second_name` varchar(255) NOT NULL DEFAULT '',
  `third_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_user_position`
--

CREATE TABLE `organization_user_position` (
  `id` int(11) UNSIGNED NOT NULL,
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_user_position_locale`
--

CREATE TABLE `organization_user_position_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `qualifications` varchar(255) NOT NULL DEFAULT '' COMMENT 'Optional, Textarea, Min:3, Max: 100',
  `responsibilities` varchar(255) NOT NULL DEFAULT '',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_user_position_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) UNSIGNED NOT NULL,
  `donor_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_branch_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `hash_id` varchar(255) NOT NULL COMMENT 'FROM Session',
  `currency` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'USD',
  `currency_exchange_rate_id` int(11) UNSIGNED NOT NULL,
  `amount` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `status` enum('Initiated','success','failed','uncertain') NOT NULL DEFAULT 'Initiated',
  `payment_method_id` int(11) UNSIGNED NOT NULL,
  `country_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_cash_details`
--

CREATE TABLE `payment_cash_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `payment_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `received_by` varchar(255) NOT NULL COMMENT 'FROM Session',
  `currency` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'USD',
  `amount` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `collection_type` enum('Cash','Check','Machine') NOT NULL DEFAULT 'Cash',
  `collection_currency` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'USD',
  `currency_exchange_rate_id` int(11) UNSIGNED NOT NULL,
  `date_of_collection` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method_configuration`
--

CREATE TABLE `payment_method_configuration` (
  `id` int(11) UNSIGNED NOT NULL,
  `config_key` varchar(1024) NOT NULL,
  `config_value` varchar(1024) NOT NULL,
  `locale_id` int(11) UNSIGNED NOT NULL,
  `environment` enum('DEV','STG','LIVE') NOT NULL DEFAULT 'LIVE',
  `payment_method_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method_locale`
--

CREATE TABLE `payment_method_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `locale_id` int(11) UNSIGNED NOT NULL,
  `payment_method_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_offline_details`
--

CREATE TABLE `payment_offline_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `payment_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `received_by` varchar(255) NOT NULL COMMENT 'FROM Session',
  `currency` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'USD',
  `amount` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `collection_type` enum('Cash','Check','Machine') NOT NULL DEFAULT 'Cash',
  `collection_currency` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'USD',
  `currency_exchange_rate_id` int(11) UNSIGNED NOT NULL,
  `date_of_collection` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_processing_fees`
--

CREATE TABLE `payment_processing_fees` (
  `id` int(11) UNSIGNED NOT NULL,
  `payment_method_id` int(11) UNSIGNED NOT NULL,
  `country_id` int(11) UNSIGNED NOT NULL,
  `organization_id` int(11) UNSIGNED NOT NULL,
  `fees` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `currency` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'USD',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) UNSIGNED NOT NULL,
  `sequence` int(11) UNSIGNED NOT NULL,
  `post_author_id` int(11) UNSIGNED NOT NULL,
  `post_category_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `status` enum('Draft','Active','Deleted') NOT NULL DEFAULT 'Draft',
  `guid` varchar(255) NOT NULL DEFAULT '' COMMENT 'Hashed UID',
  `post_type_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `subtype_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `feature_image_url` varchar(1024) NOT NULL COMMENT 'FROM Session',
  `feature_image_link` varchar(1024) NOT NULL COMMENT 'FROM Session',
  `feature_video_url` varchar(1024) NOT NULL COMMENT 'FROM Session',
  `feature_video_link` varchar(1024) NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `owner_organization_branch_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post_author`
--

CREATE TABLE `post_author` (
  `id` int(11) UNSIGNED NOT NULL,
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post_author_locale`
--

CREATE TABLE `post_author_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` longtext NOT NULL,
  `locale_id` int(11) UNSIGNED NOT NULL,
  `post_author_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

CREATE TABLE `post_category` (
  `id` int(11) UNSIGNED NOT NULL,
  `status` enum('Draft','Pending','Active','Blocked','Deleted') NOT NULL DEFAULT 'Draft',
  `sequence` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post_category_locale`
--

CREATE TABLE `post_category_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `post_category_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post_locale`
--

CREATE TABLE `post_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `content` longtext NOT NULL,
  `title` varchar(255) NOT NULL COMMENT 'Content title',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `post_id` int(11) UNSIGNED NOT NULL,
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post_media_gallery`
--

CREATE TABLE `post_media_gallery` (
  `id` int(11) UNSIGNED NOT NULL,
  `size` int(11) UNSIGNED NOT NULL,
  `mime_type` varchar(32) NOT NULL,
  `path` varchar(1024) NOT NULL DEFAULT '',
  `media_type_id` tinyint(3) UNSIGNED DEFAULT '0',
  `media_filetype_id` tinyint(3) UNSIGNED DEFAULT '0',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `media_status_id` tinyint(3) UNSIGNED DEFAULT '0',
  `sequence` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `post_id` int(11) UNSIGNED NOT NULL,
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `owner_organization_branch_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post_media_gallery_locale`
--

CREATE TABLE `post_media_gallery_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `intro_text` mediumtext NOT NULL,
  `locale_id` int(11) UNSIGNED NOT NULL,
  `post_media_gallery_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post_media_youtube_gallery`
--

CREATE TABLE `post_media_youtube_gallery` (
  `id` int(11) UNSIGNED NOT NULL,
  `youtube_link` varchar(255) NOT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `media_status_id` tinyint(3) UNSIGNED DEFAULT '0',
  `sequence` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `post_id` int(11) UNSIGNED NOT NULL,
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `owner_organization_branch_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post_media_youtube_gallery_locale`
--

CREATE TABLE `post_media_youtube_gallery_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `intro_text` mediumtext NOT NULL,
  `locale_id` int(11) UNSIGNED NOT NULL,
  `post_media_youtube_gallery_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post_metadata`
--

CREATE TABLE `post_metadata` (
  `id` int(11) UNSIGNED NOT NULL,
  `page_title` varchar(100) NOT NULL COMMENT 'Page meta title',
  `page_description` varchar(200) NOT NULL COMMENT 'Page meta description',
  `page_keywords` varchar(200) NOT NULL COMMENT 'Page meta keywords',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `post_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post_type`
--

CREATE TABLE `post_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `post_category_id` int(11) UNSIGNED NOT NULL,
  `parent_id` int(11) UNSIGNED NOT NULL,
  `sequence` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post_type_locale`
--

CREATE TABLE `post_type_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Content title',
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `post_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) UNSIGNED NOT NULL,
  `sequence` int(11) UNSIGNED NOT NULL,
  `country_id` int(11) UNSIGNED NOT NULL,
  `city_id` int(11) UNSIGNED NOT NULL,
  `geo_location` varchar(1024) NOT NULL DEFAULT '' COMMENT 'Optional',
  `project_type_id` int(11) UNSIGNED NOT NULL,
  `planned_target` float UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Optional, Text Field, Min:1',
  `planned_start_date` datetime NOT NULL,
  `planned_end_date` datetime NOT NULL,
  `planned_duration` tinyint(11) UNSIGNED NOT NULL DEFAULT '1',
  `duration_unit` enum('Minute','Hour','Day','Week','Month','Annual','NA') NOT NULL DEFAULT 'Day',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `status` enum('Draft','Active','Completed','Canceled') NOT NULL DEFAULT 'Draft',
  `progress` tinyint(11) UNSIGNED NOT NULL DEFAULT '0',
  `progress_target` tinyint(11) UNSIGNED NOT NULL DEFAULT '0',
  `currency` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'USD',
  `currency_exchange_rate_id` int(11) UNSIGNED NOT NULL,
  `auto_start_project` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `auto_finish_project` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `actual_target` float UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Optional, Text Field, Min:1',
  `actual_start_date` datetime NOT NULL,
  `actual_end_date` datetime NOT NULL,
  `actual_duration` tinyint(11) UNSIGNED NOT NULL DEFAULT '1',
  `organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `organization_branch_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_agent_contact`
--

CREATE TABLE `project_agent_contact` (
  `id` int(11) UNSIGNED NOT NULL,
  `agent_id` int(11) UNSIGNED NOT NULL,
  `is_main_contact` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `project_id` int(11) UNSIGNED NOT NULL,
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_category`
--

CREATE TABLE `project_category` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `sequence` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_donor`
--

CREATE TABLE `project_donor` (
  `id` int(11) UNSIGNED NOT NULL,
  `project_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `donor_id` int(11) UNSIGNED NOT NULL,
  `currency` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'USD',
  `currency_exchange_rate_id` int(11) UNSIGNED NOT NULL,
  `amount` float UNSIGNED NOT NULL COMMENT 'Optional, Text Field, Min:0.1',
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_donor_contact`
--

CREATE TABLE `project_donor_contact` (
  `id` int(11) UNSIGNED NOT NULL,
  `donor_id` int(11) UNSIGNED NOT NULL,
  `is_main_contact` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `project_id` int(11) UNSIGNED NOT NULL,
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_event_activity`
--

CREATE TABLE `project_event_activity` (
  `id` int(11) UNSIGNED NOT NULL,
  `sequence` tinyint(11) UNSIGNED NOT NULL DEFAULT '1',
  `project_id` int(11) UNSIGNED NOT NULL,
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_event_activity_locale`
--

CREATE TABLE `project_event_activity_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `project_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `project_event_activity_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_event_agenda`
--

CREATE TABLE `project_event_agenda` (
  `id` int(11) UNSIGNED NOT NULL,
  `start_time` time NOT NULL DEFAULT '00:00:00',
  `end_time` time NOT NULL DEFAULT '00:00:00',
  `sequence` tinyint(11) UNSIGNED NOT NULL DEFAULT '1',
  `day_number` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `project_id` int(11) UNSIGNED NOT NULL,
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_event_agenda_locale`
--

CREATE TABLE `project_event_agenda_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `presenter` varchar(255) NOT NULL DEFAULT '',
  `venue_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:3, Max:50',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `project_event_agenda_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_event_comment`
--

CREATE TABLE `project_event_comment` (
  `id` int(11) UNSIGNED NOT NULL,
  `project_id` int(11) UNSIGNED NOT NULL,
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_event_comment_locale`
--

CREATE TABLE `project_event_comment_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `project_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `project_event_comment_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_locale`
--

CREATE TABLE `project_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `intro_text` mediumtext NOT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `logo` varchar(1024) NOT NULL DEFAULT '',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `project_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_masjed`
--

CREATE TABLE `project_masjed` (
  `id` int(11) UNSIGNED NOT NULL,
  `project_masjed_id` int(11) UNSIGNED NOT NULL,
  `project_masjed_construction_type_id` int(11) UNSIGNED NOT NULL,
  `project_masjed_furniture_type_id` int(11) UNSIGNED NOT NULL,
  `project_masjed_type_id` int(11) UNSIGNED NOT NULL,
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_masjed_construction_type`
--

CREATE TABLE `project_masjed_construction_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_masjed_construction_type_locale`
--

CREATE TABLE `project_masjed_construction_type_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `project_masjed_construction_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_masjed_details`
--

CREATE TABLE `project_masjed_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `project_masjed_id` int(11) UNSIGNED NOT NULL,
  `project_masjed_type_details_id` int(11) UNSIGNED NOT NULL,
  `project_masjed_type_details_value` varchar(512) NOT NULL,
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_masjed_furniture_type`
--

CREATE TABLE `project_masjed_furniture_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_masjed_furniture_type_locale`
--

CREATE TABLE `project_masjed_furniture_type_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `project_masjed_furniture_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_masjed_type`
--

CREATE TABLE `project_masjed_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_masjed_type_details`
--

CREATE TABLE `project_masjed_type_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `published` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_masjed_type_details_locale`
--

CREATE TABLE `project_masjed_type_details_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `default_value` varchar(255) NOT NULL DEFAULT '',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `project_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `project_masjed_type_details_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_masjed_type_locale`
--

CREATE TABLE `project_masjed_type_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `project_masjed_type_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_media_gallery`
--

CREATE TABLE `project_media_gallery` (
  `id` int(11) UNSIGNED NOT NULL,
  `size` int(11) UNSIGNED NOT NULL,
  `mime_type` varchar(32) NOT NULL,
  `path` varchar(1024) NOT NULL DEFAULT '',
  `media_type_id` tinyint(3) UNSIGNED DEFAULT '0',
  `media_filetype_id` tinyint(3) UNSIGNED DEFAULT '0',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `media_status_id` tinyint(3) UNSIGNED DEFAULT '0',
  `sequence` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `project_id` int(11) UNSIGNED NOT NULL,
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_media_gallery_locale`
--

CREATE TABLE `project_media_gallery_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `intro_text` mediumtext NOT NULL,
  `locale_id` int(11) UNSIGNED NOT NULL,
  `project_media_gallery_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_media_youtube_gallery`
--

CREATE TABLE `project_media_youtube_gallery` (
  `id` int(11) UNSIGNED NOT NULL,
  `youtube_link` varchar(255) NOT NULL,
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `media_status_id` tinyint(3) UNSIGNED DEFAULT '0',
  `sequence` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `project_id` int(11) UNSIGNED NOT NULL,
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_media_youtube_gallery_locale`
--

CREATE TABLE `project_media_youtube_gallery_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `intro_text` mediumtext NOT NULL,
  `locale_id` int(11) UNSIGNED NOT NULL,
  `project_media_youtube_gallery_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_organization_contact`
--

CREATE TABLE `project_organization_contact` (
  `id` int(11) UNSIGNED NOT NULL,
  `organization_user_id` int(11) UNSIGNED NOT NULL,
  `is_main_contact` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `project_id` int(11) UNSIGNED NOT NULL,
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_type`
--

CREATE TABLE `project_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `project_category_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `published` enum('Yes','No') NOT NULL DEFAULT 'No',
  `country_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_type_locale`
--

CREATE TABLE `project_type_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL COMMENT 'Optional, Text Field, Min:0, Max: 2048',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `project_type_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_venue_contact`
--

CREATE TABLE `project_venue_contact` (
  `id` int(11) UNSIGNED NOT NULL,
  `project_id` int(11) UNSIGNED NOT NULL,
  `is_main_contact` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_venue_contact_locale`
--

CREATE TABLE `project_venue_contact_locale` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `second_name` varchar(255) NOT NULL DEFAULT '',
  `third_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `mobile_number` varchar(17) NOT NULL DEFAULT '',
  `phone_number` varchar(17) NOT NULL DEFAULT '' COMMENT 'Optional, Text Field, Min:12, Max: 14',
  `address` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `avatar` varchar(1024) NOT NULL DEFAULT '',
  `locale_id` int(11) UNSIGNED NOT NULL,
  `project_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `project_venue_contact_id` int(11) UNSIGNED NOT NULL COMMENT 'From Session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `site_authorization`
--

CREATE TABLE `site_authorization` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Role ID',
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(128) NOT NULL DEFAULT '',
  `status` enum('On Hold','Active','Blocked','Deleted') NOT NULL DEFAULT 'On Hold',
  `last_login_date` datetime NOT NULL,
  `last_login_ip` varchar(15) NOT NULL DEFAULT '',
  `user_type` enum('Donor','Beneficiary','Agent') NOT NULL COMMENT 'From session',
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Token creation timestamp',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Site Authorization';

-- --------------------------------------------------------

--
-- Table structure for table `site_authorization_token`
--

CREATE TABLE `site_authorization_token` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Entity ID',
  `token` varchar(32) NOT NULL COMMENT 'Token',
  `type` varchar(16) NOT NULL COMMENT 'session id, csrf, reset password link, sms verification, email verification',
  `revoked` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Is Token revoked',
  `authorized` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Is Token authorized',
  `site_authorization_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'User ID',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Token creation timestamp',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Site Users Tokens';

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) UNSIGNED NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `insertion_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `transaction_type_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_entries`
--

CREATE TABLE `transaction_entries` (
  `id` int(11) UNSIGNED NOT NULL,
  `transaction_id` int(11) UNSIGNED DEFAULT NULL,
  `transaction_entry_seq` int(11) DEFAULT NULL,
  `debit_credit_flag` enum('D','C') DEFAULT NULL,
  `transaction_amount` int(11) DEFAULT NULL,
  `transaction_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `posting_date` timestamp NULL DEFAULT NULL,
  `gl_account_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_type`
--

CREATE TABLE `transaction_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `transaction_type_name` varchar(50) DEFAULT NULL,
  `parent_transaction_type_id` int(11) UNSIGNED DEFAULT '0',
  `notes` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `translation`
--

CREATE TABLE `translation` (
  `id` int(11) UNSIGNED NOT NULL,
  `label` varchar(255) NOT NULL,
  `translation` mediumtext NOT NULL,
  `locale_id` int(11) UNSIGNED NOT NULL,
  `owner_organization_id` int(11) UNSIGNED NOT NULL COMMENT 'FROM Session',
  `owner_organization_user_id` int(11) UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'To be filled dynamically, Only shows in views',
  `date_updated` datetime DEFAULT NULL COMMENT 'To be filled dynamically, Only shows in views'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `translation`
--

INSERT INTO `translation` (`id`, `label`, `translation`, `locale_id`, `owner_organization_id`, `owner_organization_user_id`, `date_added`, `date_updated`) VALUES
(1, 'Lable', 'Lable', 1, 1, 1, '2017-05-12 05:12:05', '2017-05-13 06:53:04');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_asset_condition`
--
CREATE TABLE `view_asset_condition` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`country_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
,`description` mediumtext
,`country_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_asset_storage_type`
--
CREATE TABLE `view_asset_storage_type` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`country_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
,`description` mediumtext
,`country_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_asset_unit_type`
--
CREATE TABLE `view_asset_unit_type` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`country_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
,`description` mediumtext
,`country_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_beneficiary`
--
CREATE TABLE `view_beneficiary` (
`id` int(11) unsigned
,`sequence` varchar(32)
,`family_book_number` varchar(32)
,`status` enum('New','Draft','In Review','Moved','Approved','Rejected','Duplicate','Deleted')
,`visibility` enum('Yes','No')
,`country_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`notes` varchar(1024)
,`options` varchar(1024)
,`family_name` varchar(255)
,`intro_text` mediumtext
,`country_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_beneficiary_profile`
--
CREATE TABLE `view_beneficiary_profile` (
`id` int(11) unsigned
,`details` enum('Yes','No')
,`family` enum('Yes','No')
,`family_flag` enum('Yes','No')
,`income` enum('Yes','No')
,`spending` enum('Yes','No')
,`home` enum('Yes','No')
,`asset` enum('Yes','No')
,`asset_required` enum('Yes','No')
,`education` enum('Yes','No')
,`medical` enum('Yes','No')
,`medical_examination` enum('Yes','No')
,`disabled` enum('Yes','No')
,`volunteer` enum('Yes','No')
,`gallery` enum('Yes','No')
,`research_notes` enum('Yes','No')
,`published` enum('Yes','No')
,`country_id` int(11) unsigned
,`beneficiary_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
,`description` mediumtext
,`country_name` varchar(255)
,`beneficiary_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_beneficiary_profile_disabled_reason`
--
CREATE TABLE `view_beneficiary_profile_disabled_reason` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`country_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
,`description` mediumtext
,`country_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_beneficiary_profile_disabled_type`
--
CREATE TABLE `view_beneficiary_profile_disabled_type` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`country_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
,`description` mediumtext
,`country_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_beneficiary_profile_family_flag`
--
CREATE TABLE `view_beneficiary_profile_family_flag` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`country_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`flag_name` varchar(255)
,`country_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_beneficiary_profile_family_profession`
--
CREATE TABLE `view_beneficiary_profile_family_profession` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`country_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
,`description` mediumtext
,`country_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_beneficiary_profile_home_construction_type`
--
CREATE TABLE `view_beneficiary_profile_home_construction_type` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`country_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
,`description` mediumtext
,`country_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_beneficiary_profile_home_contract_type`
--
CREATE TABLE `view_beneficiary_profile_home_contract_type` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`country_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
,`description` mediumtext
,`country_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_beneficiary_profile_income_type`
--
CREATE TABLE `view_beneficiary_profile_income_type` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`country_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
,`description` mediumtext
,`country_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_beneficiary_profile_spending_type`
--
CREATE TABLE `view_beneficiary_profile_spending_type` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`country_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
,`description` mediumtext
,`country_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_beneficiary_profile_volunteer_type`
--
CREATE TABLE `view_beneficiary_profile_volunteer_type` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`country_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
,`description` mediumtext
,`country_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_beneficiary_relation`
--
CREATE TABLE `view_beneficiary_relation` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`allow_recurrence` enum('Yes','No')
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_city`
--
CREATE TABLE `view_city` (
`id` int(11) unsigned
,`country_id` int(11) unsigned
,`population_count` int(11) unsigned
,`houses_count` int(11) unsigned
,`distance_to_capital` int(11) unsigned
,`published` enum('Yes','No')
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
,`country_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_country`
--
CREATE TABLE `view_country` (
`id` int(11) unsigned
,`iso_code_2` varchar(2)
,`iso_code_3` varchar(3)
,`default_currency` varchar(3)
,`published` enum('Yes','No')
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_death_reason`
--
CREATE TABLE `view_death_reason` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`country_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
,`description` mediumtext
,`country_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_education_level`
--
CREATE TABLE `view_education_level` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`country_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
,`description` mediumtext
,`country_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_locale`
--
CREATE TABLE `view_locale` (
`id` int(11) unsigned
,`locale` varchar(6)
,`name` varchar(255)
,`locale_title` varchar(255)
,`published` enum('Yes','No')
,`status` enum('Draft','Pending','Active','Blocked','Deleted')
,`sequence` int(11) unsigned
,`country_id` int(11) unsigned
,`icon` varchar(1024)
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` timestamp
,`date_updated` datetime
,`country_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_marital_status`
--
CREATE TABLE `view_marital_status` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`country_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
,`description` mediumtext
,`country_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_media_filetype`
--
CREATE TABLE `view_media_filetype` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
,`description` mediumtext
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_media_status`
--
CREATE TABLE `view_media_status` (
`id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
,`description` mediumtext
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_media_type`
--
CREATE TABLE `view_media_type` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`country_id` int(11) unsigned
,`media_category_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
,`description` mediumtext
,`country_name` varchar(255)
,`media_category_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_medical_condition`
--
CREATE TABLE `view_medical_condition` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`country_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
,`description` mediumtext
,`country_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_menu_category`
--
CREATE TABLE `view_menu_category` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`status` enum('Draft','Pending','Active','Inactive','Deleted')
,`sequence` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` timestamp
,`date_updated` datetime
,`name` varchar(255)
,`description` mediumtext
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_message_template`
--
CREATE TABLE `view_message_template` (
`id` int(11)
,`message_type_id` int(11) unsigned
,`message_type` enum('Organization','Donor','Beneficiary')
,`from_mobile_number` varchar(255)
,`from_email` varchar(255)
,`to_mobile_number` varchar(255)
,`to_email` varchar(255)
,`published` enum('Yes','No')
,`organization_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`from_name` varchar(255)
,`to_name` varchar(255)
,`description` mediumtext
,`subject` varchar(255)
,`message_type_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_message_type`
--
CREATE TABLE `view_message_type` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
,`description` mediumtext
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_organization_flag`
--
CREATE TABLE `view_organization_flag` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`country_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`flag_name` varchar(255)
,`country_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_organization_type`
--
CREATE TABLE `view_organization_type` (
`id` int(11) unsigned
,`published` enum('Yes','No')
,`country_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` datetime
,`date_updated` datetime
,`name` varchar(255)
,`description` mediumtext
,`country_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_translation`
--
CREATE TABLE `view_translation` (
`id` int(11) unsigned
,`label` varchar(255)
,`translation` mediumtext
,`locale_id` int(11) unsigned
,`owner_organization_id` int(11) unsigned
,`owner_organization_user_id` int(11) unsigned
,`date_added` timestamp
,`date_updated` datetime
,`locale` varchar(6)
);

-- --------------------------------------------------------

--
-- Structure for view `view_asset_condition`
--
DROP TABLE IF EXISTS `view_asset_condition`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_asset_condition`  AS  select `a`.`id` AS `id`,`a`.`published` AS `published`,`a`.`country_id` AS `country_id`,`a`.`owner_organization_id` AS `owner_organization_id`,`a`.`owner_organization_user_id` AS `owner_organization_user_id`,`a`.`date_added` AS `date_added`,`a`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,`l`.`description` AS `description`,(select `cnt`.`name` from `country_locale` `cnt` where ((`cnt`.`country_id` = `a`.`country_id`) and (`cnt`.`locale_id` = 1))) AS `country_name` from (`asset_condition` `a` left join `asset_condition_locale` `l` on((`l`.`asset_condition_id` = `a`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_asset_storage_type`
--
DROP TABLE IF EXISTS `view_asset_storage_type`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_asset_storage_type`  AS  select `a`.`id` AS `id`,`a`.`published` AS `published`,`a`.`country_id` AS `country_id`,`a`.`owner_organization_id` AS `owner_organization_id`,`a`.`owner_organization_user_id` AS `owner_organization_user_id`,`a`.`date_added` AS `date_added`,`a`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,`l`.`description` AS `description`,(select `cnt`.`name` from `country_locale` `cnt` where ((`cnt`.`country_id` = `a`.`country_id`) and (`cnt`.`locale_id` = 1))) AS `country_name` from (`asset_storage_type` `a` left join `asset_storage_type_locale` `l` on((`l`.`asset_storage_type_id` = `a`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_asset_unit_type`
--
DROP TABLE IF EXISTS `view_asset_unit_type`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_asset_unit_type`  AS  select `a`.`id` AS `id`,`a`.`published` AS `published`,`a`.`country_id` AS `country_id`,`a`.`owner_organization_id` AS `owner_organization_id`,`a`.`owner_organization_user_id` AS `owner_organization_user_id`,`a`.`date_added` AS `date_added`,`a`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,`l`.`description` AS `description`,(select `cnt`.`name` from `country_locale` `cnt` where ((`cnt`.`country_id` = `a`.`country_id`) and (`cnt`.`locale_id` = 1))) AS `country_name` from (`asset_unit_type` `a` left join `asset_unit_type_locale` `l` on((`l`.`asset_unit_type_id` = `a`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_beneficiary`
--
DROP TABLE IF EXISTS `view_beneficiary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_beneficiary`  AS  select `b`.`id` AS `id`,`b`.`sequence` AS `sequence`,`b`.`family_book_number` AS `family_book_number`,`b`.`status` AS `status`,`b`.`visibility` AS `visibility`,`b`.`country_id` AS `country_id`,`b`.`owner_organization_id` AS `owner_organization_id`,`b`.`owner_organization_user_id` AS `owner_organization_user_id`,`b`.`date_added` AS `date_added`,`b`.`date_updated` AS `date_updated`,`b`.`notes` AS `notes`,`b`.`options` AS `options`,`l`.`family_name` AS `family_name`,`l`.`intro_text` AS `intro_text`,(select `cnt`.`name` from `country_locale` `cnt` where ((`cnt`.`country_id` = `b`.`country_id`) and (`cnt`.`locale_id` = 1))) AS `country_name` from (`beneficiary` `b` left join `beneficiary_locale` `l` on((`b`.`id` = `l`.`beneficiary_id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_beneficiary_profile`
--
DROP TABLE IF EXISTS `view_beneficiary_profile`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_beneficiary_profile`  AS  select `p`.`id` AS `id`,`p`.`details` AS `details`,`p`.`family` AS `family`,`p`.`family_flag` AS `family_flag`,`p`.`income` AS `income`,`p`.`spending` AS `spending`,`p`.`home` AS `home`,`p`.`asset` AS `asset`,`p`.`asset_required` AS `asset_required`,`p`.`education` AS `education`,`p`.`medical` AS `medical`,`p`.`medical_examination` AS `medical_examination`,`p`.`disabled` AS `disabled`,`p`.`volunteer` AS `volunteer`,`p`.`gallery` AS `gallery`,`p`.`research_notes` AS `research_notes`,`p`.`published` AS `published`,`p`.`country_id` AS `country_id`,`p`.`beneficiary_id` AS `beneficiary_id`,`p`.`owner_organization_id` AS `owner_organization_id`,`p`.`owner_organization_user_id` AS `owner_organization_user_id`,`p`.`date_added` AS `date_added`,`p`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,`l`.`description` AS `description`,(select `cnt`.`name` from `country_locale` `cnt` where ((`cnt`.`country_id` = `p`.`country_id`) and (`cnt`.`locale_id` = 1))) AS `country_name`,(select `b`.`family_name` from `beneficiary_locale` `b` where ((`b`.`beneficiary_id` = `p`.`beneficiary_id`) and (`b`.`locale_id` = 1))) AS `beneficiary_name` from (`beneficiary_profile` `p` left join `beneficiary_profile_locale` `l` on((`p`.`id` = `l`.`beneficiary_profile_id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_beneficiary_profile_disabled_reason`
--
DROP TABLE IF EXISTS `view_beneficiary_profile_disabled_reason`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_beneficiary_profile_disabled_reason`  AS  select `d`.`id` AS `id`,`d`.`published` AS `published`,`d`.`country_id` AS `country_id`,`d`.`owner_organization_id` AS `owner_organization_id`,`d`.`owner_organization_user_id` AS `owner_organization_user_id`,`d`.`date_added` AS `date_added`,`d`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,`l`.`description` AS `description`,(select `cnt`.`name` from `country_locale` `cnt` where ((`cnt`.`country_id` = `d`.`country_id`) and (`cnt`.`locale_id` = 1))) AS `country_name` from (`beneficiary_profile_disabled_reason` `d` left join `beneficiary_profile_disabled_reason_locale` `l` on((`l`.`beneficiary_profile_disabled_reason_id` = `d`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_beneficiary_profile_disabled_type`
--
DROP TABLE IF EXISTS `view_beneficiary_profile_disabled_type`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_beneficiary_profile_disabled_type`  AS  select `t`.`id` AS `id`,`t`.`published` AS `published`,`t`.`country_id` AS `country_id`,`t`.`owner_organization_id` AS `owner_organization_id`,`t`.`owner_organization_user_id` AS `owner_organization_user_id`,`t`.`date_added` AS `date_added`,`t`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,`l`.`description` AS `description`,(select `cnt`.`name` from `country_locale` `cnt` where ((`cnt`.`country_id` = `t`.`country_id`) and (`cnt`.`locale_id` = 1))) AS `country_name` from (`beneficiary_profile_disabled_type` `t` left join `beneficiary_profile_disabled_type_locale` `l` on((`l`.`beneficiary_profile_disabled_type_id` = `t`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_beneficiary_profile_family_flag`
--
DROP TABLE IF EXISTS `view_beneficiary_profile_family_flag`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_beneficiary_profile_family_flag`  AS  select `b`.`id` AS `id`,`b`.`published` AS `published`,`b`.`country_id` AS `country_id`,`b`.`owner_organization_id` AS `owner_organization_id`,`b`.`owner_organization_user_id` AS `owner_organization_user_id`,`b`.`date_added` AS `date_added`,`b`.`date_updated` AS `date_updated`,`l`.`flag_name` AS `flag_name`,(select `cnt`.`name` from `country_locale` `cnt` where ((`cnt`.`country_id` = `b`.`country_id`) and (`cnt`.`locale_id` = 1))) AS `country_name` from (`beneficiary_profile_family_flag` `b` left join `beneficiary_profile_family_flag_locale` `l` on((`l`.`beneficiary_profile_family_flag_id` = `b`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_beneficiary_profile_family_profession`
--
DROP TABLE IF EXISTS `view_beneficiary_profile_family_profession`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_beneficiary_profile_family_profession`  AS  select `f`.`id` AS `id`,`f`.`published` AS `published`,`f`.`country_id` AS `country_id`,`f`.`owner_organization_id` AS `owner_organization_id`,`f`.`owner_organization_user_id` AS `owner_organization_user_id`,`f`.`date_added` AS `date_added`,`f`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,`l`.`description` AS `description`,(select `cnt`.`name` from `country_locale` `cnt` where ((`cnt`.`country_id` = `f`.`country_id`) and (`cnt`.`locale_id` = 1))) AS `country_name` from (`beneficiary_profile_family_profession` `f` left join `beneficiary_profile_family_profession_locale` `l` on((`l`.`beneficiary_profile_family_profession_id` = `f`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_beneficiary_profile_home_construction_type`
--
DROP TABLE IF EXISTS `view_beneficiary_profile_home_construction_type`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_beneficiary_profile_home_construction_type`  AS  select `c`.`id` AS `id`,`c`.`published` AS `published`,`c`.`country_id` AS `country_id`,`c`.`owner_organization_id` AS `owner_organization_id`,`c`.`owner_organization_user_id` AS `owner_organization_user_id`,`c`.`date_added` AS `date_added`,`c`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,`l`.`description` AS `description`,(select `cnt`.`name` from `country_locale` `cnt` where ((`cnt`.`country_id` = `c`.`country_id`) and (`cnt`.`locale_id` = 1))) AS `country_name` from (`beneficiary_profile_home_construction_type` `c` left join `beneficiary_profile_home_construction_type_locale` `l` on((`l`.`beneficiary_profile_home_construction_type_id` = `c`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_beneficiary_profile_home_contract_type`
--
DROP TABLE IF EXISTS `view_beneficiary_profile_home_contract_type`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_beneficiary_profile_home_contract_type`  AS  select `c`.`id` AS `id`,`c`.`published` AS `published`,`c`.`country_id` AS `country_id`,`c`.`owner_organization_id` AS `owner_organization_id`,`c`.`owner_organization_user_id` AS `owner_organization_user_id`,`c`.`date_added` AS `date_added`,`c`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,`l`.`description` AS `description`,(select `cnt`.`name` from `country_locale` `cnt` where ((`cnt`.`country_id` = `c`.`country_id`) and (`cnt`.`locale_id` = 1))) AS `country_name` from (`beneficiary_profile_home_contract_type` `c` left join `beneficiary_profile_home_contract_type_locale` `l` on((`l`.`beneficiary_profile_home_contract_type_id` = `c`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_beneficiary_profile_income_type`
--
DROP TABLE IF EXISTS `view_beneficiary_profile_income_type`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_beneficiary_profile_income_type`  AS  select `i`.`id` AS `id`,`i`.`published` AS `published`,`i`.`country_id` AS `country_id`,`i`.`owner_organization_id` AS `owner_organization_id`,`i`.`owner_organization_user_id` AS `owner_organization_user_id`,`i`.`date_added` AS `date_added`,`i`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,`l`.`description` AS `description`,(select `cnt`.`name` from `country_locale` `cnt` where ((`cnt`.`country_id` = `i`.`country_id`) and (`cnt`.`locale_id` = 1))) AS `country_name` from (`beneficiary_profile_income_type` `i` left join `beneficiary_profile_income_type_locale` `l` on((`l`.`beneficiary_profile_income_type_id` = `i`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_beneficiary_profile_spending_type`
--
DROP TABLE IF EXISTS `view_beneficiary_profile_spending_type`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_beneficiary_profile_spending_type`  AS  select `v`.`id` AS `id`,`v`.`published` AS `published`,`v`.`country_id` AS `country_id`,`v`.`owner_organization_id` AS `owner_organization_id`,`v`.`owner_organization_user_id` AS `owner_organization_user_id`,`v`.`date_added` AS `date_added`,`v`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,`l`.`description` AS `description`,(select `cnt`.`name` from `country_locale` `cnt` where ((`cnt`.`country_id` = `v`.`country_id`) and (`cnt`.`locale_id` = 1))) AS `country_name` from (`beneficiary_profile_spending_type` `v` left join `beneficiary_profile_spending_type_locale` `l` on((`l`.`beneficiary_profile_spending_type_id` = `v`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_beneficiary_profile_volunteer_type`
--
DROP TABLE IF EXISTS `view_beneficiary_profile_volunteer_type`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_beneficiary_profile_volunteer_type`  AS  select `v`.`id` AS `id`,`v`.`published` AS `published`,`v`.`country_id` AS `country_id`,`v`.`owner_organization_id` AS `owner_organization_id`,`v`.`owner_organization_user_id` AS `owner_organization_user_id`,`v`.`date_added` AS `date_added`,`v`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,`l`.`description` AS `description`,(select `cnt`.`name` from `country_locale` `cnt` where ((`cnt`.`country_id` = `v`.`country_id`) and (`cnt`.`locale_id` = 1))) AS `country_name` from (`beneficiary_profile_volunteer_type` `v` left join `beneficiary_profile_volunteer_type_locale` `l` on((`l`.`beneficiary_profile_volunteer_type_id` = `v`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_beneficiary_relation`
--
DROP TABLE IF EXISTS `view_beneficiary_relation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_beneficiary_relation`  AS  select `r`.`id` AS `id`,`r`.`published` AS `published`,`r`.`allow_recurrence` AS `allow_recurrence`,`r`.`owner_organization_id` AS `owner_organization_id`,`r`.`owner_organization_user_id` AS `owner_organization_user_id`,`r`.`date_added` AS `date_added`,`r`.`date_updated` AS `date_updated`,`l`.`name` AS `name` from (`beneficiary_relation` `r` left join `beneficiary_relation_locale` `l` on((`l`.`beneficiary_relation_id` = `r`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_city`
--
DROP TABLE IF EXISTS `view_city`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_city`  AS  select `c`.`id` AS `id`,`c`.`country_id` AS `country_id`,`c`.`population_count` AS `population_count`,`c`.`houses_count` AS `houses_count`,`c`.`distance_to_capital` AS `distance_to_capital`,`c`.`published` AS `published`,`c`.`owner_organization_id` AS `owner_organization_id`,`c`.`owner_organization_user_id` AS `owner_organization_user_id`,`c`.`date_added` AS `date_added`,`c`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,(select `cnt`.`name` from `country_locale` `cnt` where ((`cnt`.`country_id` = `c`.`country_id`) and (`cnt`.`locale_id` = 1))) AS `country_name` from (`city` `c` left join `city_locale` `l` on((`l`.`city_id` = `c`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_country`
--
DROP TABLE IF EXISTS `view_country`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_country`  AS  select `c`.`id` AS `id`,`c`.`iso_code_2` AS `iso_code_2`,`c`.`iso_code_3` AS `iso_code_3`,`c`.`default_currency` AS `default_currency`,`c`.`published` AS `published`,`c`.`owner_organization_id` AS `owner_organization_id`,`c`.`owner_organization_user_id` AS `owner_organization_user_id`,`c`.`date_added` AS `date_added`,`c`.`date_updated` AS `date_updated`,`l`.`name` AS `name` from (`country` `c` left join `country_locale` `l` on((`l`.`country_id` = `c`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_death_reason`
--
DROP TABLE IF EXISTS `view_death_reason`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_death_reason`  AS  select `d`.`id` AS `id`,`d`.`published` AS `published`,`d`.`country_id` AS `country_id`,`d`.`owner_organization_id` AS `owner_organization_id`,`d`.`owner_organization_user_id` AS `owner_organization_user_id`,`d`.`date_added` AS `date_added`,`d`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,`l`.`description` AS `description`,(select `cnt`.`name` from `country_locale` `cnt` where ((`cnt`.`country_id` = `d`.`country_id`) and (`cnt`.`locale_id` = 1))) AS `country_name` from (`death_reason` `d` left join `death_reason_locale` `l` on((`l`.`death_reason_id` = `d`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_education_level`
--
DROP TABLE IF EXISTS `view_education_level`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_education_level`  AS  select `e`.`id` AS `id`,`e`.`published` AS `published`,`e`.`country_id` AS `country_id`,`e`.`owner_organization_id` AS `owner_organization_id`,`e`.`owner_organization_user_id` AS `owner_organization_user_id`,`e`.`date_added` AS `date_added`,`e`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,`l`.`description` AS `description`,(select `cnt`.`name` from `country_locale` `cnt` where ((`cnt`.`country_id` = `e`.`country_id`) and (`cnt`.`locale_id` = 1))) AS `country_name` from (`education_level` `e` left join `education_level_locale` `l` on((`l`.`education_level_id` = `e`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_locale`
--
DROP TABLE IF EXISTS `view_locale`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_locale`  AS  select `l`.`id` AS `id`,`l`.`locale` AS `locale`,`l`.`name` AS `name`,`l`.`locale_title` AS `locale_title`,`l`.`published` AS `published`,`l`.`status` AS `status`,`l`.`sequence` AS `sequence`,`l`.`country_id` AS `country_id`,`l`.`icon` AS `icon`,`l`.`owner_organization_id` AS `owner_organization_id`,`l`.`owner_organization_user_id` AS `owner_organization_user_id`,`l`.`date_added` AS `date_added`,`l`.`date_updated` AS `date_updated`,`c`.`name` AS `country_name` from (`locale` `l` left join `country_locale` `c` on((`l`.`country_id` = `c`.`country_id`))) where (`c`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_marital_status`
--
DROP TABLE IF EXISTS `view_marital_status`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_marital_status`  AS  select `m`.`id` AS `id`,`m`.`published` AS `published`,`m`.`country_id` AS `country_id`,`m`.`owner_organization_id` AS `owner_organization_id`,`m`.`owner_organization_user_id` AS `owner_organization_user_id`,`m`.`date_added` AS `date_added`,`m`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,`l`.`description` AS `description`,(select `cnt`.`name` from `country_locale` `cnt` where ((`cnt`.`country_id` = `m`.`country_id`) and (`cnt`.`locale_id` = 1))) AS `country_name` from (`marital_status` `m` left join `marital_status_locale` `l` on((`l`.`marital_status_id` = `m`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_media_filetype`
--
DROP TABLE IF EXISTS `view_media_filetype`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_media_filetype`  AS  select `m`.`id` AS `id`,`m`.`published` AS `published`,`m`.`owner_organization_id` AS `owner_organization_id`,`m`.`owner_organization_user_id` AS `owner_organization_user_id`,`m`.`date_added` AS `date_added`,`m`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,`l`.`description` AS `description` from (`media_filetype` `m` left join `media_filetype_locale` `l` on((`l`.`media_filetype_id` = `m`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_media_status`
--
DROP TABLE IF EXISTS `view_media_status`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_media_status`  AS  select `m`.`id` AS `id`,`m`.`owner_organization_id` AS `owner_organization_id`,`m`.`owner_organization_user_id` AS `owner_organization_user_id`,`m`.`date_added` AS `date_added`,`m`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,`l`.`description` AS `description` from (`media_status` `m` left join `media_status_locale` `l` on((`l`.`media_status_id` = `m`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_media_type`
--
DROP TABLE IF EXISTS `view_media_type`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_media_type`  AS  select `m`.`id` AS `id`,`m`.`published` AS `published`,`m`.`country_id` AS `country_id`,`m`.`media_category_id` AS `media_category_id`,`m`.`owner_organization_id` AS `owner_organization_id`,`m`.`owner_organization_user_id` AS `owner_organization_user_id`,`m`.`date_added` AS `date_added`,`m`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,`l`.`description` AS `description`,(select `cnt`.`name` from `country_locale` `cnt` where ((`cnt`.`country_id` = `m`.`country_id`) and (`cnt`.`locale_id` = 1))) AS `country_name`,(select `cat`.`name` from `media_category` `cat` where (`cat`.`id` = `m`.`media_category_id`)) AS `media_category_name` from (`media_type` `m` left join `media_type_locale` `l` on((`l`.`media_type_id` = `m`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_medical_condition`
--
DROP TABLE IF EXISTS `view_medical_condition`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_medical_condition`  AS  select `m`.`id` AS `id`,`m`.`published` AS `published`,`m`.`country_id` AS `country_id`,`m`.`owner_organization_id` AS `owner_organization_id`,`m`.`owner_organization_user_id` AS `owner_organization_user_id`,`m`.`date_added` AS `date_added`,`m`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,`l`.`description` AS `description`,(select `cnt`.`name` from `country_locale` `cnt` where ((`cnt`.`country_id` = `m`.`country_id`) and (`cnt`.`locale_id` = 1))) AS `country_name` from (`medical_condition` `m` left join `medical_condition_locale` `l` on((`l`.`medical_condition_id` = `m`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_menu_category`
--
DROP TABLE IF EXISTS `view_menu_category`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_menu_category`  AS  select `m`.`id` AS `id`,`m`.`published` AS `published`,`m`.`status` AS `status`,`m`.`sequence` AS `sequence`,`m`.`owner_organization_id` AS `owner_organization_id`,`m`.`owner_organization_user_id` AS `owner_organization_user_id`,`m`.`date_added` AS `date_added`,`m`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,`l`.`description` AS `description` from (`menu_category` `m` left join `menu_category_locale` `l` on((`m`.`id` = `l`.`menu_category_id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_message_template`
--
DROP TABLE IF EXISTS `view_message_template`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_message_template`  AS  select `m`.`id` AS `id`,`m`.`message_type_id` AS `message_type_id`,`m`.`message_type` AS `message_type`,`m`.`from_mobile_number` AS `from_mobile_number`,`m`.`from_email` AS `from_email`,`m`.`to_mobile_number` AS `to_mobile_number`,`m`.`to_email` AS `to_email`,`m`.`published` AS `published`,`m`.`organization_id` AS `organization_id`,`m`.`owner_organization_id` AS `owner_organization_id`,`m`.`owner_organization_user_id` AS `owner_organization_user_id`,`m`.`date_added` AS `date_added`,`m`.`date_updated` AS `date_updated`,`l`.`from_name` AS `from_name`,`l`.`to_name` AS `to_name`,`l`.`description` AS `description`,`l`.`subject` AS `subject`,(select `t`.`name` from `message_type_locale` `t` where ((`t`.`message_type_id` = `m`.`message_type_id`) and (`t`.`locale_id` = 1))) AS `message_type_name` from (`message_template` `m` left join `message_template_locale` `l` on((`l`.`message_template_id` = `m`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_message_type`
--
DROP TABLE IF EXISTS `view_message_type`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_message_type`  AS  select `m`.`id` AS `id`,`m`.`published` AS `published`,`m`.`owner_organization_id` AS `owner_organization_id`,`m`.`owner_organization_user_id` AS `owner_organization_user_id`,`m`.`date_added` AS `date_added`,`m`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,`l`.`description` AS `description` from (`message_type` `m` left join `message_type_locale` `l` on((`l`.`message_type_id` = `m`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_organization_flag`
--
DROP TABLE IF EXISTS `view_organization_flag`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_organization_flag`  AS  select `v`.`id` AS `id`,`v`.`published` AS `published`,`v`.`country_id` AS `country_id`,`v`.`owner_organization_id` AS `owner_organization_id`,`v`.`owner_organization_user_id` AS `owner_organization_user_id`,`v`.`date_added` AS `date_added`,`v`.`date_updated` AS `date_updated`,`l`.`flag_name` AS `flag_name`,(select `cnt`.`name` from `country_locale` `cnt` where ((`cnt`.`country_id` = `v`.`country_id`) and (`cnt`.`locale_id` = 1))) AS `country_name` from (`organization_flag` `v` left join `organization_flag_locale` `l` on((`l`.`organization_flag_id` = `v`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_organization_type`
--
DROP TABLE IF EXISTS `view_organization_type`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_organization_type`  AS  select `t`.`id` AS `id`,`t`.`published` AS `published`,`t`.`country_id` AS `country_id`,`t`.`owner_organization_id` AS `owner_organization_id`,`t`.`owner_organization_user_id` AS `owner_organization_user_id`,`t`.`date_added` AS `date_added`,`t`.`date_updated` AS `date_updated`,`l`.`name` AS `name`,`l`.`description` AS `description`,(select `cnt`.`name` from `country_locale` `cnt` where ((`cnt`.`country_id` = `t`.`country_id`) and (`cnt`.`locale_id` = 1))) AS `country_name` from (`organization_type` `t` left join `organization_type_locale` `l` on((`l`.`organization_type_id` = `t`.`id`))) where (`l`.`locale_id` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_translation`
--
DROP TABLE IF EXISTS `view_translation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_translation`  AS  select `t`.`id` AS `id`,`t`.`label` AS `label`,`t`.`translation` AS `translation`,`t`.`locale_id` AS `locale_id`,`t`.`owner_organization_id` AS `owner_organization_id`,`t`.`owner_organization_user_id` AS `owner_organization_user_id`,`t`.`date_added` AS `date_added`,`t`.`date_updated` AS `date_updated`,`l`.`locale` AS `locale` from (`translation` `t` left join `locale` `l` on((`t`.`locale_id` = `l`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_authorization`
--
ALTER TABLE `admin_authorization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_authorization_organization_relation`
--
ALTER TABLE `admin_authorization_organization_relation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_auth_org_relation_owner_organization_id` (`owner_organization_id`),
  ADD KEY `admin_auth_org_relation_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `admin_authorization_organization_relation_role`
--
ALTER TABLE `admin_authorization_organization_relation_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_auth_org_relation_role_owner_organization_id` (`owner_organization_id`),
  ADD KEY `admin_auth_org_relation_role_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `admin_authorization_relation`
--
ALTER TABLE `admin_authorization_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_authorization_resource`
--
ALTER TABLE `admin_authorization_resource`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_authorization_role`
--
ALTER TABLE `admin_authorization_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_authorization_role_parent_id` (`parent_id`);

--
-- Indexes for table `admin_authorization_rule`
--
ALTER TABLE `admin_authorization_rule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authorization_rule_resource_id_role_id` (`authorization_resource_id`,`admin_authorization_role_id`),
  ADD KEY `authorization_rule_role_id_resource_id` (`admin_authorization_role_id`,`authorization_resource_id`);

--
-- Indexes for table `admin_authorization_token`
--
ALTER TABLE `admin_authorization_token`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `authorization_token_token` (`token`),
  ADD KEY `authorization_token_admin_authorization_id` (`admin_authorization_id`);

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ssn` (`ssn`),
  ADD KEY `agent_country_id` (`country_id`),
  ADD KEY `agent_city_id` (`city_id`);

--
-- Indexes for table `agent_locale`
--
ALTER TABLE `agent_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `asset_condition`
--
ALTER TABLE `asset_condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_condition_locale`
--
ALTER TABLE `asset_condition_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_locale`
--
ALTER TABLE `asset_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_storage_type`
--
ALTER TABLE `asset_storage_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_storage_type_locale`
--
ALTER TABLE `asset_storage_type_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_type_condition`
--
ALTER TABLE `asset_type_condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_type_locale`
--
ALTER TABLE `asset_type_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_type_storage_type`
--
ALTER TABLE `asset_type_storage_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_type_unit_type`
--
ALTER TABLE `asset_type_unit_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_unit_type`
--
ALTER TABLE `asset_unit_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_unit_type_locale`
--
ALTER TABLE `asset_unit_type_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary`
--
ALTER TABLE `beneficiary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_owner_organization_id` (`owner_organization_id`),
  ADD KEY `beneficiary_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_duplicate`
--
ALTER TABLE `beneficiary_duplicate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_duplicate_owner_organization_id` (`owner_organization_id`),
  ADD KEY `beneficiary_duplicate_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_group`
--
ALTER TABLE `beneficiary_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_group_member`
--
ALTER TABLE `beneficiary_group_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_has_profile`
--
ALTER TABLE `beneficiary_has_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_has_profile_owner_organization_id` (`owner_organization_id`),
  ADD KEY `beneficiary_has_profile_owner_organization_user_id` (`owner_organization_user_id`),
  ADD KEY `beneficiary_has_profile_ibfk_2` (`beneficiary_id`);

--
-- Indexes for table `beneficiary_locale`
--
ALTER TABLE `beneficiary_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_media_gallery`
--
ALTER TABLE `beneficiary_media_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_media_gallery_locale`
--
ALTER TABLE `beneficiary_media_gallery_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_media_youtube_gallery`
--
ALTER TABLE `beneficiary_media_youtube_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_media_youtube_gallery_locale`
--
ALTER TABLE `beneficiary_media_youtube_gallery_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_message_email`
--
ALTER TABLE `beneficiary_message_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_message_sms`
--
ALTER TABLE `beneficiary_message_sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_movement`
--
ALTER TABLE `beneficiary_movement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_movement_owner_organization_id` (`owner_organization_id`),
  ADD KEY `beneficiary_movement_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_profile`
--
ALTER TABLE `beneficiary_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_profile_owner_organization_id` (`owner_organization_id`),
  ADD KEY `beneficiary_profile_owner_organization_user_id` (`owner_organization_user_id`),
  ADD KEY `beneficiary_profile_ibfk_2` (`beneficiary_id`);

--
-- Indexes for table `beneficiary_profile_asset`
--
ALTER TABLE `beneficiary_profile_asset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_profile_asset_beneficiary_id` (`beneficiary_id`),
  ADD KEY `beneficiary_profile_asset_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_profile_asset_received`
--
ALTER TABLE `beneficiary_profile_asset_received`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_profile_asset_received_beneficiary_id` (`beneficiary_id`),
  ADD KEY `beneficiary_profile_asset_received_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_profile_asset_required`
--
ALTER TABLE `beneficiary_profile_asset_required`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_profile_asset_required_beneficiary_id` (`beneficiary_id`),
  ADD KEY `beneficiary_profile_asset_required_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_profile_details`
--
ALTER TABLE `beneficiary_profile_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_profile_details_owner_organization_id` (`owner_organization_id`),
  ADD KEY `beneficiary_profile_details_owner_organization_user_id` (`owner_organization_user_id`),
  ADD KEY `beneficiary_profile_details_ibfk_2` (`beneficiary_id`);

--
-- Indexes for table `beneficiary_profile_disabled`
--
ALTER TABLE `beneficiary_profile_disabled`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_profile_disabled_beneficiary_id` (`beneficiary_id`),
  ADD KEY `beneficiary_profile_disabled_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_profile_disabled_reason`
--
ALTER TABLE `beneficiary_profile_disabled_reason`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_profile_disabled_reason_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_profile_disabled_reason_locale`
--
ALTER TABLE `beneficiary_profile_disabled_reason_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_profile_disabled_type`
--
ALTER TABLE `beneficiary_profile_disabled_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_profile_disabled_type_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_profile_disabled_type_locale`
--
ALTER TABLE `beneficiary_profile_disabled_type_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_profile_education_level`
--
ALTER TABLE `beneficiary_profile_education_level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_profile_education_level_beneficiary_id` (`beneficiary_id`),
  ADD KEY `beneficiary_profile_education_level_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_profile_education_level_locale`
--
ALTER TABLE `beneficiary_profile_education_level_locale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_education_level_locale_beneficiary_id` (`beneficiary_id`),
  ADD KEY `beneficiary_education_level_locale_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_profile_family`
--
ALTER TABLE `beneficiary_profile_family`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ssn` (`ssn`),
  ADD KEY `beneficiary_profile_family_beneficiary_id` (`beneficiary_id`),
  ADD KEY `beneficiary_profile_family_owner_organization_user_id` (`owner_organization_user_id`),
  ADD KEY `beneficiary_profile_family_beneficiary_relation_id` (`beneficiary_relation_id`);

--
-- Indexes for table `beneficiary_profile_family_flag`
--
ALTER TABLE `beneficiary_profile_family_flag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_profile_family_flag_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_profile_family_flag_locale`
--
ALTER TABLE `beneficiary_profile_family_flag_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_profile_family_has_flag`
--
ALTER TABLE `beneficiary_profile_family_has_flag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_profile_family_has_flag_organization_id` (`owner_organization_id`),
  ADD KEY `beneficiary_profile_family_has_flag_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_profile_family_locale`
--
ALTER TABLE `beneficiary_profile_family_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_profile_family_profession`
--
ALTER TABLE `beneficiary_profile_family_profession`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_profile_family_profession_locale`
--
ALTER TABLE `beneficiary_profile_family_profession_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_profile_family_sponsorship`
--
ALTER TABLE `beneficiary_profile_family_sponsorship`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_sponsorship_beneficiary_id` (`beneficiary_id`),
  ADD KEY `beneficiary_sponsorship_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_profile_home`
--
ALTER TABLE `beneficiary_profile_home`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_profile_home_beneficiary_id` (`beneficiary_id`),
  ADD KEY `beneficiary_profile_home_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_profile_home_construction_type`
--
ALTER TABLE `beneficiary_profile_home_construction_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_profile_home_construction_type_locale`
--
ALTER TABLE `beneficiary_profile_home_construction_type_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_profile_home_contract_type`
--
ALTER TABLE `beneficiary_profile_home_contract_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_profile_home_contract_type_locale`
--
ALTER TABLE `beneficiary_profile_home_contract_type_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_profile_home_locale`
--
ALTER TABLE `beneficiary_profile_home_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_profile_income`
--
ALTER TABLE `beneficiary_profile_income`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_profile_income_beneficiary_id` (`beneficiary_id`),
  ADD KEY `beneficiary_profile_income_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_profile_income_type`
--
ALTER TABLE `beneficiary_profile_income_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_profile_income_type_locale`
--
ALTER TABLE `beneficiary_profile_income_type_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_profile_locale`
--
ALTER TABLE `beneficiary_profile_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_profile_medical`
--
ALTER TABLE `beneficiary_profile_medical`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_profile_medical_beneficiary_id` (`beneficiary_id`),
  ADD KEY `beneficiary_profile_medical_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_profile_medical_examination`
--
ALTER TABLE `beneficiary_profile_medical_examination`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_medical_examination_beneficiary_id` (`beneficiary_id`),
  ADD KEY `beneficiary_medical_examination_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_profile_medical_examination_locale`
--
ALTER TABLE `beneficiary_profile_medical_examination_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_profile_medical_locale`
--
ALTER TABLE `beneficiary_profile_medical_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_profile_research_notes`
--
ALTER TABLE `beneficiary_profile_research_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_profile_research_notes_beneficiary_id` (`beneficiary_id`),
  ADD KEY `beneficiary_profile_research_notes_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_profile_research_notes_locale`
--
ALTER TABLE `beneficiary_profile_research_notes_locale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_locale_beneficiary_id` (`beneficiary_id`),
  ADD KEY `beneficiary_locale_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_profile_spending`
--
ALTER TABLE `beneficiary_profile_spending`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_profile_spending_beneficiary_id` (`beneficiary_id`),
  ADD KEY `beneficiary_profile_spending_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_profile_spending_type`
--
ALTER TABLE `beneficiary_profile_spending_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_profile_spending_type_locale`
--
ALTER TABLE `beneficiary_profile_spending_type_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_profile_volunteer`
--
ALTER TABLE `beneficiary_profile_volunteer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_profile_volunteer_beneficiary_id` (`beneficiary_id`),
  ADD KEY `beneficiary_profile_volunteer_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_profile_volunteer_activity`
--
ALTER TABLE `beneficiary_profile_volunteer_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_profile_volunteer_activity_beneficiary_id` (`beneficiary_id`);

--
-- Indexes for table `beneficiary_profile_volunteer_activity_locale`
--
ALTER TABLE `beneficiary_profile_volunteer_activity_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_profile_volunteer_locale`
--
ALTER TABLE `beneficiary_profile_volunteer_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_profile_volunteer_type`
--
ALTER TABLE `beneficiary_profile_volunteer_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_profile_volunteer_type_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_profile_volunteer_type_locale`
--
ALTER TABLE `beneficiary_profile_volunteer_type_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiary_relation`
--
ALTER TABLE `beneficiary_relation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiary_relation_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `beneficiary_relation_locale`
--
ALTER TABLE `beneficiary_relation_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `city_locale`
--
ALTER TABLE `city_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_locale`
--
ALTER TABLE `country_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency_exchange_rate`
--
ALTER TABLE `currency_exchange_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `death_reason`
--
ALTER TABLE `death_reason`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `death_reason_locale`
--
ALTER TABLE `death_reason_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donor_nationality_id` (`nationality_id`);

--
-- Indexes for table `donor_locale`
--
ALTER TABLE `donor_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education_level`
--
ALTER TABLE `education_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education_level_locale`
--
ALTER TABLE `education_level_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gl_account`
--
ALTER TABLE `gl_account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gl_account_type_id` (`gl_account_type_id`);

--
-- Indexes for table `gl_account_locale`
--
ALTER TABLE `gl_account_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gl_account_type`
--
ALTER TABLE `gl_account_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gl_account_type_locale`
--
ALTER TABLE `gl_account_type_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepage_slider`
--
ALTER TABLE `homepage_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepage_slider_locale`
--
ALTER TABLE `homepage_slider_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locale`
--
ALTER TABLE `locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marital_status`
--
ALTER TABLE `marital_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marital_status_locale`
--
ALTER TABLE `marital_status_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_category`
--
ALTER TABLE `media_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_filetype`
--
ALTER TABLE `media_filetype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_filetype_locale`
--
ALTER TABLE `media_filetype_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_status`
--
ALTER TABLE `media_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_status_locale`
--
ALTER TABLE `media_status_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_type`
--
ALTER TABLE `media_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_type_locale`
--
ALTER TABLE `media_type_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_condition`
--
ALTER TABLE `medical_condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_condition_locale`
--
ALTER TABLE `medical_condition_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_category`
--
ALTER TABLE `menu_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_category_locale`
--
ALTER TABLE `menu_category_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_item`
--
ALTER TABLE `menu_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_item_locale`
--
ALTER TABLE `menu_item_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_inbox`
--
ALTER TABLE `message_inbox`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_inbox_organization_id` (`organization_id`),
  ADD KEY `message_inbox_message_type_id` (`message_type_id`),
  ADD KEY `message_inbox_organization_user_id` (`organization_user_id`),
  ADD KEY `message_inbox_organization_branch_id` (`organization_branch_id`);

--
-- Indexes for table `message_media_gallery`
--
ALTER TABLE `message_media_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_media_youtube_gallery`
--
ALTER TABLE `message_media_youtube_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_outbox`
--
ALTER TABLE `message_outbox`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_outbox_organization_id` (`organization_id`),
  ADD KEY `message_outbox_message_type_id` (`message_type_id`),
  ADD KEY `message_outbox_message_template_id` (`message_template_id`),
  ADD KEY `message_outbox_organization_user_id` (`organization_user_id`),
  ADD KEY `message_outbox_organization_branch_id` (`organization_branch_id`);

--
-- Indexes for table `message_template`
--
ALTER TABLE `message_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_template_locale`
--
ALTER TABLE `message_template_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_type`
--
ALTER TABLE `message_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_type_locale`
--
ALTER TABLE `message_type_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_type_id` (`organization_type_id`);

--
-- Indexes for table `organization_asset`
--
ALTER TABLE `organization_asset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_asset_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `organization_asset_liability`
--
ALTER TABLE `organization_asset_liability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_asset_liability_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `organization_asset_location`
--
ALTER TABLE `organization_asset_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_asset_location_locale`
--
ALTER TABLE `organization_asset_location_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_asset_received`
--
ALTER TABLE `organization_asset_received`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_asset_received_organization_user_id` (`organization_user_id`);

--
-- Indexes for table `organization_asset_required`
--
ALTER TABLE `organization_asset_required`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_asset_required_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `organization_branch`
--
ALTER TABLE `organization_branch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_branch_organization_id` (`organization_id`),
  ADD KEY `organization_branch_country_id` (`country_id`),
  ADD KEY `organization_branch_city_id` (`city_id`),
  ADD KEY `organization_branch_manager_id` (`manager_id`),
  ADD KEY `organization_branch_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `organization_branch_committee`
--
ALTER TABLE `organization_branch_committee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_branch_committee_organization_user_id` (`organization_user_id`),
  ADD KEY `organization_branch_committee_organization_branch_id` (`organization_branch_id`),
  ADD KEY `organization_branch_committee_organization_id` (`organization_id`);

--
-- Indexes for table `organization_branch_committee_locale`
--
ALTER TABLE `organization_branch_committee_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_branch_committee_user`
--
ALTER TABLE `organization_branch_committee_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_branch_committee_position_id` (`organization_user_position_id`),
  ADD KEY `organization_branch_committee_user_id` (`organization_user_id`),
  ADD KEY `organization_branch_committee_branch_committee_id` (`organization_branch_committee_id`);

--
-- Indexes for table `organization_branch_locale`
--
ALTER TABLE `organization_branch_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_flag`
--
ALTER TABLE `organization_flag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_flag_owner_organization_id` (`owner_organization_id`),
  ADD KEY `organization_flag_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `organization_flag_locale`
--
ALTER TABLE `organization_flag_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_has_flag`
--
ALTER TABLE `organization_has_flag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_has_flag_organization_id` (`organization_id`),
  ADD KEY `organization_has_flag_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `organization_locale`
--
ALTER TABLE `organization_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_media_gallery`
--
ALTER TABLE `organization_media_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_media_gallery_locale`
--
ALTER TABLE `organization_media_gallery_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_media_youtube_gallery`
--
ALTER TABLE `organization_media_youtube_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_media_youtube_gallery_locale`
--
ALTER TABLE `organization_media_youtube_gallery_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_task`
--
ALTER TABLE `organization_task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_task_organization_id` (`organization_id`),
  ADD KEY `organization_task_organization_user_id` (`organization_user_id`),
  ADD KEY `organization_task_assignee_id` (`assignee_id`),
  ADD KEY `organization_task_organization_branch_id` (`organization_branch_id`);

--
-- Indexes for table `organization_task_locale`
--
ALTER TABLE `organization_task_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_type`
--
ALTER TABLE `organization_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_type_locale`
--
ALTER TABLE `organization_type_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_user`
--
ALTER TABLE `organization_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `organization_user_ssn` (`ssn`),
  ADD KEY `organization_user_nationality_id` (`nationality_id`),
  ADD KEY `organization_user_organization_id` (`organization_id`),
  ADD KEY `organization_user_organization_branch_id` (`organization_branch_id`);

--
-- Indexes for table `organization_user_locale`
--
ALTER TABLE `organization_user_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_user_position`
--
ALTER TABLE `organization_user_position`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_user_position_organization_id` (`organization_id`);

--
-- Indexes for table `organization_user_position_locale`
--
ALTER TABLE `organization_user_position_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_cash_details`
--
ALTER TABLE `payment_cash_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_method_configuration`
--
ALTER TABLE `payment_method_configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_method_locale`
--
ALTER TABLE `payment_method_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_offline_details`
--
ALTER TABLE `payment_offline_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_processing_fees`
--
ALTER TABLE `payment_processing_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_processing_fees_owner_organization_id` (`owner_organization_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `post_author`
--
ALTER TABLE `post_author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_author_locale`
--
ALTER TABLE `post_author_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_category_locale`
--
ALTER TABLE `post_category_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_locale`
--
ALTER TABLE `post_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_media_gallery`
--
ALTER TABLE `post_media_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_media_gallery_locale`
--
ALTER TABLE `post_media_gallery_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_media_youtube_gallery`
--
ALTER TABLE `post_media_youtube_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_media_youtube_gallery_locale`
--
ALTER TABLE `post_media_youtube_gallery_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_metadata`
--
ALTER TABLE `post_metadata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_type`
--
ALTER TABLE `post_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_type_locale`
--
ALTER TABLE `post_type_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_owner_organization_id` (`owner_organization_id`),
  ADD KEY `project_project_type_id` (`project_type_id`),
  ADD KEY `project_country_id` (`country_id`),
  ADD KEY `project_city_id` (`city_id`),
  ADD KEY `project_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `project_agent_contact`
--
ALTER TABLE `project_agent_contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_agent_contact_project_id` (`project_id`);

--
-- Indexes for table `project_category`
--
ALTER TABLE `project_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_donor`
--
ALTER TABLE `project_donor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_donor_owner_organization_id` (`owner_organization_id`),
  ADD KEY `project_donor_owner_organization_user_id` (`owner_organization_user_id`);

--
-- Indexes for table `project_donor_contact`
--
ALTER TABLE `project_donor_contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_donor_contact_project_id` (`project_id`);

--
-- Indexes for table `project_event_activity`
--
ALTER TABLE `project_event_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_event_activity_project_id` (`project_id`);

--
-- Indexes for table `project_event_activity_locale`
--
ALTER TABLE `project_event_activity_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_event_agenda`
--
ALTER TABLE `project_event_agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_event_agenda_project_id` (`project_id`);

--
-- Indexes for table `project_event_agenda_locale`
--
ALTER TABLE `project_event_agenda_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_event_comment`
--
ALTER TABLE `project_event_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_event_comment_project_id` (`project_id`);

--
-- Indexes for table `project_event_comment_locale`
--
ALTER TABLE `project_event_comment_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_locale`
--
ALTER TABLE `project_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_masjed`
--
ALTER TABLE `project_masjed`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_masjed_project_masjed_type_id` (`project_masjed_type_id`),
  ADD KEY `project_masjed_owner_organization_id` (`owner_organization_id`);

--
-- Indexes for table `project_masjed_construction_type`
--
ALTER TABLE `project_masjed_construction_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_masjed_construction_type_locale`
--
ALTER TABLE `project_masjed_construction_type_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_masjed_details`
--
ALTER TABLE `project_masjed_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_masjed_details_project_masjed_type_details_id` (`project_masjed_type_details_id`),
  ADD KEY `project_masjed_details_owner_organization_id` (`owner_organization_id`);

--
-- Indexes for table `project_masjed_furniture_type`
--
ALTER TABLE `project_masjed_furniture_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_masjed_furniture_type_locale`
--
ALTER TABLE `project_masjed_furniture_type_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_masjed_type`
--
ALTER TABLE `project_masjed_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_masjed_type_details`
--
ALTER TABLE `project_masjed_type_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_masjed_type_details_owner_organization_user_id` (`owner_organization_user_id`),
  ADD KEY `project_masjed_type_details_owner_organization_id` (`owner_organization_id`);

--
-- Indexes for table `project_masjed_type_details_locale`
--
ALTER TABLE `project_masjed_type_details_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_masjed_type_locale`
--
ALTER TABLE `project_masjed_type_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_media_gallery`
--
ALTER TABLE `project_media_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_media_gallery_locale`
--
ALTER TABLE `project_media_gallery_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_media_youtube_gallery`
--
ALTER TABLE `project_media_youtube_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_media_youtube_gallery_locale`
--
ALTER TABLE `project_media_youtube_gallery_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_organization_contact`
--
ALTER TABLE `project_organization_contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_organization_contact_project_id` (`project_id`);

--
-- Indexes for table `project_type`
--
ALTER TABLE `project_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_type_locale`
--
ALTER TABLE `project_type_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_venue_contact`
--
ALTER TABLE `project_venue_contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_venue_contact_project_id` (`project_id`);

--
-- Indexes for table `project_venue_contact_locale`
--
ALTER TABLE `project_venue_contact_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_authorization`
--
ALTER TABLE `site_authorization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_authorization_token`
--
ALTER TABLE `site_authorization_token`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `authorization_token_token` (`token`),
  ADD KEY `authorization_token_site_authorization_id` (`site_authorization_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_type_id` (`transaction_type_id`);

--
-- Indexes for table `transaction_entries`
--
ALTER TABLE `transaction_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gl_account_id` (`gl_account_id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `transaction_type`
--
ALTER TABLE `transaction_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translation`
--
ALTER TABLE `translation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_authorization`
--
ALTER TABLE `admin_authorization`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Admin Authorization ID', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admin_authorization_organization_relation`
--
ALTER TABLE `admin_authorization_organization_relation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admin_authorization_organization_relation_role`
--
ALTER TABLE `admin_authorization_organization_relation_role`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admin_authorization_relation`
--
ALTER TABLE `admin_authorization_relation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Admin Authorization Relation ID';
--
-- AUTO_INCREMENT for table `admin_authorization_resource`
--
ALTER TABLE `admin_authorization_resource`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Rule ID';
--
-- AUTO_INCREMENT for table `admin_authorization_role`
--
ALTER TABLE `admin_authorization_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Role ID';
--
-- AUTO_INCREMENT for table `admin_authorization_rule`
--
ALTER TABLE `admin_authorization_rule`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Rule ID';
--
-- AUTO_INCREMENT for table `admin_authorization_token`
--
ALTER TABLE `admin_authorization_token`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Entity ID';
--
-- AUTO_INCREMENT for table `agent`
--
ALTER TABLE `agent`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `agent_locale`
--
ALTER TABLE `agent_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `asset_condition`
--
ALTER TABLE `asset_condition`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `asset_condition_locale`
--
ALTER TABLE `asset_condition_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `asset_locale`
--
ALTER TABLE `asset_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `asset_storage_type`
--
ALTER TABLE `asset_storage_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `asset_storage_type_locale`
--
ALTER TABLE `asset_storage_type_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `asset_type_condition`
--
ALTER TABLE `asset_type_condition`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `asset_type_locale`
--
ALTER TABLE `asset_type_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `asset_type_storage_type`
--
ALTER TABLE `asset_type_storage_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `asset_type_unit_type`
--
ALTER TABLE `asset_type_unit_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `asset_unit_type`
--
ALTER TABLE `asset_unit_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `asset_unit_type_locale`
--
ALTER TABLE `asset_unit_type_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `beneficiary`
--
ALTER TABLE `beneficiary`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `beneficiary_duplicate`
--
ALTER TABLE `beneficiary_duplicate`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_group`
--
ALTER TABLE `beneficiary_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_group_member`
--
ALTER TABLE `beneficiary_group_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_has_profile`
--
ALTER TABLE `beneficiary_has_profile`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_locale`
--
ALTER TABLE `beneficiary_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `beneficiary_media_gallery`
--
ALTER TABLE `beneficiary_media_gallery`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_media_gallery_locale`
--
ALTER TABLE `beneficiary_media_gallery_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_media_youtube_gallery`
--
ALTER TABLE `beneficiary_media_youtube_gallery`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_media_youtube_gallery_locale`
--
ALTER TABLE `beneficiary_media_youtube_gallery_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_message_email`
--
ALTER TABLE `beneficiary_message_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_message_sms`
--
ALTER TABLE `beneficiary_message_sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_movement`
--
ALTER TABLE `beneficiary_movement`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile`
--
ALTER TABLE `beneficiary_profile`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `beneficiary_profile_asset`
--
ALTER TABLE `beneficiary_profile_asset`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_asset_received`
--
ALTER TABLE `beneficiary_profile_asset_received`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_asset_required`
--
ALTER TABLE `beneficiary_profile_asset_required`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_details`
--
ALTER TABLE `beneficiary_profile_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_disabled`
--
ALTER TABLE `beneficiary_profile_disabled`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_disabled_reason`
--
ALTER TABLE `beneficiary_profile_disabled_reason`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `beneficiary_profile_disabled_reason_locale`
--
ALTER TABLE `beneficiary_profile_disabled_reason_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `beneficiary_profile_disabled_type`
--
ALTER TABLE `beneficiary_profile_disabled_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `beneficiary_profile_disabled_type_locale`
--
ALTER TABLE `beneficiary_profile_disabled_type_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `beneficiary_profile_education_level`
--
ALTER TABLE `beneficiary_profile_education_level`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_education_level_locale`
--
ALTER TABLE `beneficiary_profile_education_level_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_family`
--
ALTER TABLE `beneficiary_profile_family`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_family_flag`
--
ALTER TABLE `beneficiary_profile_family_flag`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `beneficiary_profile_family_flag_locale`
--
ALTER TABLE `beneficiary_profile_family_flag_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `beneficiary_profile_family_has_flag`
--
ALTER TABLE `beneficiary_profile_family_has_flag`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_family_locale`
--
ALTER TABLE `beneficiary_profile_family_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_family_profession`
--
ALTER TABLE `beneficiary_profile_family_profession`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `beneficiary_profile_family_profession_locale`
--
ALTER TABLE `beneficiary_profile_family_profession_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `beneficiary_profile_family_sponsorship`
--
ALTER TABLE `beneficiary_profile_family_sponsorship`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_home`
--
ALTER TABLE `beneficiary_profile_home`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_home_construction_type`
--
ALTER TABLE `beneficiary_profile_home_construction_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `beneficiary_profile_home_construction_type_locale`
--
ALTER TABLE `beneficiary_profile_home_construction_type_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `beneficiary_profile_home_contract_type`
--
ALTER TABLE `beneficiary_profile_home_contract_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `beneficiary_profile_home_contract_type_locale`
--
ALTER TABLE `beneficiary_profile_home_contract_type_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `beneficiary_profile_home_locale`
--
ALTER TABLE `beneficiary_profile_home_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_income`
--
ALTER TABLE `beneficiary_profile_income`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_income_type`
--
ALTER TABLE `beneficiary_profile_income_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `beneficiary_profile_income_type_locale`
--
ALTER TABLE `beneficiary_profile_income_type_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `beneficiary_profile_locale`
--
ALTER TABLE `beneficiary_profile_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `beneficiary_profile_medical`
--
ALTER TABLE `beneficiary_profile_medical`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_medical_examination`
--
ALTER TABLE `beneficiary_profile_medical_examination`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_medical_examination_locale`
--
ALTER TABLE `beneficiary_profile_medical_examination_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_medical_locale`
--
ALTER TABLE `beneficiary_profile_medical_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_research_notes`
--
ALTER TABLE `beneficiary_profile_research_notes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_research_notes_locale`
--
ALTER TABLE `beneficiary_profile_research_notes_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_spending`
--
ALTER TABLE `beneficiary_profile_spending`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_spending_type`
--
ALTER TABLE `beneficiary_profile_spending_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `beneficiary_profile_spending_type_locale`
--
ALTER TABLE `beneficiary_profile_spending_type_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `beneficiary_profile_volunteer`
--
ALTER TABLE `beneficiary_profile_volunteer`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_volunteer_activity`
--
ALTER TABLE `beneficiary_profile_volunteer_activity`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_volunteer_activity_locale`
--
ALTER TABLE `beneficiary_profile_volunteer_activity_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_volunteer_locale`
--
ALTER TABLE `beneficiary_profile_volunteer_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiary_profile_volunteer_type`
--
ALTER TABLE `beneficiary_profile_volunteer_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `beneficiary_profile_volunteer_type_locale`
--
ALTER TABLE `beneficiary_profile_volunteer_type_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `beneficiary_relation`
--
ALTER TABLE `beneficiary_relation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `beneficiary_relation_locale`
--
ALTER TABLE `beneficiary_relation_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `city_locale`
--
ALTER TABLE `city_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `country_locale`
--
ALTER TABLE `country_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `currency_exchange_rate`
--
ALTER TABLE `currency_exchange_rate`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `death_reason`
--
ALTER TABLE `death_reason`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `death_reason_locale`
--
ALTER TABLE `death_reason_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `donor_locale`
--
ALTER TABLE `donor_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `education_level`
--
ALTER TABLE `education_level`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `education_level_locale`
--
ALTER TABLE `education_level_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gl_account`
--
ALTER TABLE `gl_account`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gl_account_locale`
--
ALTER TABLE `gl_account_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gl_account_type`
--
ALTER TABLE `gl_account_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gl_account_type_locale`
--
ALTER TABLE `gl_account_type_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `homepage_slider`
--
ALTER TABLE `homepage_slider`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `homepage_slider_locale`
--
ALTER TABLE `homepage_slider_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `locale`
--
ALTER TABLE `locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `marital_status`
--
ALTER TABLE `marital_status`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `marital_status_locale`
--
ALTER TABLE `marital_status_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `media_category`
--
ALTER TABLE `media_category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `media_filetype`
--
ALTER TABLE `media_filetype`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `media_filetype_locale`
--
ALTER TABLE `media_filetype_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `media_status`
--
ALTER TABLE `media_status`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `media_status_locale`
--
ALTER TABLE `media_status_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `media_type`
--
ALTER TABLE `media_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `media_type_locale`
--
ALTER TABLE `media_type_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `medical_condition`
--
ALTER TABLE `medical_condition`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `medical_condition_locale`
--
ALTER TABLE `medical_condition_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu_category`
--
ALTER TABLE `menu_category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `menu_category_locale`
--
ALTER TABLE `menu_category_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu_item`
--
ALTER TABLE `menu_item`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu_item_locale`
--
ALTER TABLE `menu_item_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `message_inbox`
--
ALTER TABLE `message_inbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `message_media_gallery`
--
ALTER TABLE `message_media_gallery`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `message_media_youtube_gallery`
--
ALTER TABLE `message_media_youtube_gallery`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `message_outbox`
--
ALTER TABLE `message_outbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `message_template`
--
ALTER TABLE `message_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `message_template_locale`
--
ALTER TABLE `message_template_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `message_type`
--
ALTER TABLE `message_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `message_type_locale`
--
ALTER TABLE `message_type_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_asset`
--
ALTER TABLE `organization_asset`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_asset_liability`
--
ALTER TABLE `organization_asset_liability`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_asset_location`
--
ALTER TABLE `organization_asset_location`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_asset_location_locale`
--
ALTER TABLE `organization_asset_location_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_asset_received`
--
ALTER TABLE `organization_asset_received`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_asset_required`
--
ALTER TABLE `organization_asset_required`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_branch`
--
ALTER TABLE `organization_branch`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_branch_committee`
--
ALTER TABLE `organization_branch_committee`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_branch_committee_locale`
--
ALTER TABLE `organization_branch_committee_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_branch_committee_user`
--
ALTER TABLE `organization_branch_committee_user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_branch_locale`
--
ALTER TABLE `organization_branch_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_flag`
--
ALTER TABLE `organization_flag`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `organization_flag_locale`
--
ALTER TABLE `organization_flag_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `organization_has_flag`
--
ALTER TABLE `organization_has_flag`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_locale`
--
ALTER TABLE `organization_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_media_gallery`
--
ALTER TABLE `organization_media_gallery`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_media_gallery_locale`
--
ALTER TABLE `organization_media_gallery_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_media_youtube_gallery`
--
ALTER TABLE `organization_media_youtube_gallery`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_media_youtube_gallery_locale`
--
ALTER TABLE `organization_media_youtube_gallery_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_task`
--
ALTER TABLE `organization_task`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_task_locale`
--
ALTER TABLE `organization_task_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_type`
--
ALTER TABLE `organization_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `organization_type_locale`
--
ALTER TABLE `organization_type_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `organization_user`
--
ALTER TABLE `organization_user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_user_locale`
--
ALTER TABLE `organization_user_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_user_position`
--
ALTER TABLE `organization_user_position`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_user_position_locale`
--
ALTER TABLE `organization_user_position_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_cash_details`
--
ALTER TABLE `payment_cash_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_method_configuration`
--
ALTER TABLE `payment_method_configuration`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_method_locale`
--
ALTER TABLE `payment_method_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_offline_details`
--
ALTER TABLE `payment_offline_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_processing_fees`
--
ALTER TABLE `payment_processing_fees`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_author`
--
ALTER TABLE `post_author`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_author_locale`
--
ALTER TABLE `post_author_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_category`
--
ALTER TABLE `post_category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_category_locale`
--
ALTER TABLE `post_category_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_locale`
--
ALTER TABLE `post_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_media_gallery`
--
ALTER TABLE `post_media_gallery`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_media_gallery_locale`
--
ALTER TABLE `post_media_gallery_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_media_youtube_gallery`
--
ALTER TABLE `post_media_youtube_gallery`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_media_youtube_gallery_locale`
--
ALTER TABLE `post_media_youtube_gallery_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_metadata`
--
ALTER TABLE `post_metadata`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_type`
--
ALTER TABLE `post_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_type_locale`
--
ALTER TABLE `post_type_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_agent_contact`
--
ALTER TABLE `project_agent_contact`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_category`
--
ALTER TABLE `project_category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_donor`
--
ALTER TABLE `project_donor`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_donor_contact`
--
ALTER TABLE `project_donor_contact`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_event_activity`
--
ALTER TABLE `project_event_activity`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_event_activity_locale`
--
ALTER TABLE `project_event_activity_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_event_agenda`
--
ALTER TABLE `project_event_agenda`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_event_agenda_locale`
--
ALTER TABLE `project_event_agenda_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_event_comment`
--
ALTER TABLE `project_event_comment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_event_comment_locale`
--
ALTER TABLE `project_event_comment_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_locale`
--
ALTER TABLE `project_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_masjed`
--
ALTER TABLE `project_masjed`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_masjed_construction_type`
--
ALTER TABLE `project_masjed_construction_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_masjed_construction_type_locale`
--
ALTER TABLE `project_masjed_construction_type_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_masjed_details`
--
ALTER TABLE `project_masjed_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_masjed_furniture_type`
--
ALTER TABLE `project_masjed_furniture_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_masjed_furniture_type_locale`
--
ALTER TABLE `project_masjed_furniture_type_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_masjed_type`
--
ALTER TABLE `project_masjed_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_masjed_type_details`
--
ALTER TABLE `project_masjed_type_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_masjed_type_details_locale`
--
ALTER TABLE `project_masjed_type_details_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_masjed_type_locale`
--
ALTER TABLE `project_masjed_type_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_media_gallery`
--
ALTER TABLE `project_media_gallery`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_media_gallery_locale`
--
ALTER TABLE `project_media_gallery_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_media_youtube_gallery`
--
ALTER TABLE `project_media_youtube_gallery`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_media_youtube_gallery_locale`
--
ALTER TABLE `project_media_youtube_gallery_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_organization_contact`
--
ALTER TABLE `project_organization_contact`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_type`
--
ALTER TABLE `project_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_type_locale`
--
ALTER TABLE `project_type_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_venue_contact`
--
ALTER TABLE `project_venue_contact`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_venue_contact_locale`
--
ALTER TABLE `project_venue_contact_locale`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `site_authorization`
--
ALTER TABLE `site_authorization`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Role ID';
--
-- AUTO_INCREMENT for table `site_authorization_token`
--
ALTER TABLE `site_authorization_token`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Entity ID';
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaction_entries`
--
ALTER TABLE `transaction_entries`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaction_type`
--
ALTER TABLE `transaction_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `translation`
--
ALTER TABLE `translation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_authorization_organization_relation`
--
ALTER TABLE `admin_authorization_organization_relation`
  ADD CONSTRAINT `admin_auth_org_relation_ibfk_2` FOREIGN KEY (`owner_organization_id`) REFERENCES `organization` (`id`),
  ADD CONSTRAINT `admin_auth_org_relation_ibfk_3` FOREIGN KEY (`owner_organization_user_id`) REFERENCES `organization_user` (`id`);

--
-- Constraints for table `admin_authorization_organization_relation_role`
--
ALTER TABLE `admin_authorization_organization_relation_role`
  ADD CONSTRAINT `admin_auth_org_relation_role_ibfk_2` FOREIGN KEY (`owner_organization_id`) REFERENCES `organization` (`id`),
  ADD CONSTRAINT `admin_auth_org_relation_role_ibfk_3` FOREIGN KEY (`owner_organization_user_id`) REFERENCES `organization_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
