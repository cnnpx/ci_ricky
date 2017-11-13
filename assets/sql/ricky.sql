-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2017 at 04:02 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ricky`
--

-- --------------------------------------------------------

--
-- Table structure for table `actionlogs`
--

CREATE TABLE `actionlogs` (
  `ActionLogId` int(11) NOT NULL,
  `ItemId` int(11) NOT NULL,
  `ItemTypeId` tinyint(4) NOT NULL,
  `ActionTypeId` tinyint(4) NOT NULL,
  `Comment` varchar(650) NOT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `actionlogs`
--

INSERT INTO `actionlogs` (`ActionLogId`, `ItemId`, `ItemTypeId`, `ActionTypeId`, `Comment`, `CrUserId`, `CrDateTime`) VALUES
(1, 2, 8, 1, 'Ricky: Thêm phiếu nhập kho', 3, '2017-08-31 17:56:03'),
(2, 2, 8, 2, 'Ricky: Cập nhật phiếu nhập kho', 3, '2017-08-31 18:00:28'),
(3, 5, 6, 2, 'Ricky thay đổi trạng thái đơn hàng về Đã báo giao hàng', 3, '2017-09-03 10:42:59'),
(4, 5, 6, 2, 'Ricky thay đổi trạng thái đơn hàng về Chưa báo giao hàng', 3, '2017-09-03 10:49:20'),
(5, 2, 8, 2, 'Ricky thay đổi trạng thái nhập kho về Chưa duyệt', 3, '2017-09-03 15:19:37'),
(6, 5, 6, 2, 'Ricky đã xác thực đơn hàng', 3, '2017-09-03 15:59:04'),
(7, 1, 6, 2, 'Ricky đã xác thực đơn hàng', 3, '2017-09-03 16:30:39'),
(8, 5, 6, 2, 'Ricky đã xác thực đơn hàng', 3, '2017-09-03 16:30:39'),
(9, 1, 6, 2, 'Ricky đã xác thực đơn hàng', 3, '2017-09-03 16:32:20'),
(10, 5, 6, 2, 'Ricky đã xác thực đơn hàng', 3, '2017-09-03 16:32:20'),
(11, 1, 6, 2, 'Ricky chuyển đơn hàng về trạng thái chưa xác thực', 3, '2017-09-03 16:32:24'),
(12, 5, 6, 2, 'Ricky chuyển đơn hàng về trạng thái chưa xác thực', 3, '2017-09-03 16:32:24'),
(13, 1, 6, 2, 'Ricky đã xác thực đơn hàng', 3, '2017-09-03 16:32:29'),
(14, 5, 6, 2, 'Ricky đã xác thực đơn hàng', 3, '2017-09-03 16:32:29'),
(15, 6, 6, 1, 'Ricky: Thêm mới đơn hàng', 3, '2017-09-10 16:47:31'),
(16, 6, 6, 2, 'Ricky đã xác thực đơn hàng', 3, '2017-09-10 16:53:49'),
(17, 4, 9, 1, 'Ricky: Thêm mới vận chuyển', 3, '2017-09-10 16:55:47'),
(18, 5, 9, 1, 'Ricky: Thêm mới vận chuyển', 3, '2017-09-10 21:10:42'),
(19, 6, 9, 1, 'Ricky: Thêm mới vận chuyển', 3, '2017-09-10 21:13:31'),
(20, 4, 9, 2, 'Ricky: Cập nhật vận chuyển', 3, '2017-09-10 21:45:37'),
(21, 4, 7, 1, 'Ricky: Thêm mới lưu chuyển kho', 3, '2017-09-24 11:17:34'),
(22, 1, 14, 1, 'Ricky: Thêm mới Đơn hoàn hàng về', 3, '2017-09-27 23:44:55'),
(23, 2, 14, 1, 'Ricky: Thêm mới Đơn hoàn hàng về', 3, '2017-09-29 15:31:54'),
(24, 1, 14, 2, 'Ricky: Cập nhật Đơn hoàn hàng về', 3, '2017-09-29 19:07:44'),
(25, 1, 14, 2, 'Ricky: Cập nhật Đơn hoàn hàng về', 3, '2017-09-29 20:30:45'),
(27, 2, 10, 1, 'Ricky: Thêm mới phiếu Phiếu thu', 3, '2017-09-30 16:40:15'),
(28, 2, 10, 2, 'Ricky: Cập nhật phiếu Phiếu thu', 3, '2017-09-30 16:50:57'),
(29, 3, 10, 1, 'Ricky: Thêm mới phiếu Phiếu thu', 3, '2017-09-30 16:51:48'),
(30, 2, 10, 2, 'Ricky: Cập nhật phiếu Phiếu thu', 3, '2017-10-01 14:05:30'),
(31, 7, 6, 1, 'Ricky: Thêm mới đơn hàng', 3, '2017-10-08 09:18:04');

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `ActionId` smallint(6) NOT NULL,
  `ActionName` varchar(250) NOT NULL,
  `ActionUrl` varchar(250) NOT NULL,
  `ActionCode` varchar(250) NOT NULL,
  `ParentActionId` smallint(6) DEFAULT NULL,
  `StatusId` tinyint(4) NOT NULL,
  `DisplayOrder` smallint(6) NOT NULL,
  `FontAwesome` varchar(20) DEFAULT NULL,
  `ActionLevel` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`ActionId`, `ActionName`, `ActionUrl`, `ActionCode`, `ParentActionId`, `StatusId`, `DisplayOrder`, `FontAwesome`, `ActionLevel`) VALUES
(1, 'Quản lý bán hàng', '', '', 0, 2, 1, 'fa-shopping-cart', 1),
(2, 'Đơn hàng', '', '', 1, 2, 1, '', 2),
(3, 'Tạo đơn mới', '', '', 1, 2, 2, '', 2),
(4, 'Bảo hành', '', '', 1, 2, 3, '', 2),
(5, 'Đổi trả', '', '', 1, 2, 4, '', 2),
(6, 'Mã khuyến mại', '', '', 1, 2, 5, '', 2),
(7, 'Tổng quan', '', '', 4, 2, 1, '', 3),
(8, 'Xử lý bảo hành', '', '', 4, 2, 2, '', 3),
(9, 'Tổng quan', '', '', 5, 2, 1, '', 3),
(10, 'Xử lý đổi trả', '', '', 5, 2, 2, '', 3),
(11, 'Quản lý vận chuyển', '', '', 0, 0, 3, '', 1),
(22, 'Quản lý vận chuyển', '', '', 0, 2, 2, 'fa-car', 1),
(23, 'Tổng quan', '', '', 22, 2, 2, 'fa-car', 2),
(24, 'Giao hàng', '', '', 22, 2, 1, '', 2),
(25, 'Cập nhật mã đơn vận', '', '', 22, 2, 3, '', 2),
(26, 'Cập nhật phí ship', '', '', 22, 2, 4, '', 2),
(27, 'Thêm thông tin nhà vận chuyển', '', '', 22, 2, 5, '', 2),
(28, 'Quản lý khách hàng', '', '', 0, 2, 3, 'fa-male', 1),
(29, 'Thông tin khách hàng', '', '', 28, 2, 1, '', 2),
(30, 'Danh sách khách hàng', '', '', 29, 2, 2, '', 3),
(31, 'Nhóm khách hàng', '', '', 29, 2, 1, '', 3),
(32, 'Chăm sóc khách hàng', '', '', 28, 2, 2, '', 2),
(33, 'Khách hàng vừa nhận hàng', '', '', 32, 2, 1, '', 3),
(34, 'Khách hàng xử lý bảo hành', '', '', 32, 2, 2, '', 3),
(35, 'Khách hàng khiếu nại/Không hài lòng', '', '', 32, 2, 3, '', 3),
(36, 'Chăm sóc định kì', '', '', 32, 2, 4, '', 3),
(37, 'Tư vấn lại', '', '', 28, 2, 3, '', 2),
(38, 'Khách chờ hàng về', '', '', 37, 2, 1, '', 3),
(39, 'Khách đặt lịch mua', '', '', 37, 2, 2, '', 3),
(40, 'Khách có nhu cầu', '', '', 37, 2, 3, '', 3),
(41, 'Đơn hàng dang dở', '', '', 37, 2, 4, '', 3),
(42, 'Quản lý hàng hóa', '', '', 0, 2, 4, 'fa-product-hunt', 1),
(43, 'Sản phẩm', '', '', 42, 2, 1, '', 2),
(44, 'Danh sách sản phẩm', '', '', 43, 2, 1, '', 3),
(45, 'Thêm mới sản phẩm', '', '', 43, 2, 2, '', 3),
(46, 'Nhóm sản phẩm', '', '', 43, 2, 3, '', 3),
(47, 'Kho', '', '', 42, 2, 2, '', 2),
(48, 'Nhập kho', '', '', 47, 2, 1, '', 3),
(49, 'Xuất kho', '', '', 47, 2, 2, '', 3),
(50, 'Tồn kho', '', '', 47, 2, 3, '', 3),
(51, 'Lưu chuyển kho', '', '', 47, 2, 4, '', 3),
(52, 'Quản lý nhập hàng', '', '', 42, 2, 3, '', 2),
(53, 'Hàng đang đặt', '', '', 52, 2, 1, '', 3),
(54, 'Nhà cung cấp', '', '', 42, 2, 4, '', 2),
(55, 'Danh sách nhà cung cấp', '', '', 54, 2, 1, '', 3),
(56, 'Thêm mới', '', '', 54, 2, 2, '', 3),
(57, 'Công nợ', '', '', 54, 2, 3, '', 3),
(58, 'Tài chính', '', '', 0, 2, 5, 'fa-money', 1),
(59, 'Tổng quan', '', '', 58, 2, 1, '', 2),
(60, 'Quản lý sổ quỹ', '', '', 58, 2, 2, '', 2),
(61, 'Quản lý hóa đơn', '', '', 60, 2, 1, '', 3),
(62, 'Quản lý công nợ', '', '', 58, 2, 3, '', 2),
(63, 'Công nợ nhà cung cấp', '', '', 62, 2, 1, '', 3),
(64, 'Công nợ khách hàng', '', '', 62, 2, 2, '', 3),
(65, 'Công nợ khách buôn', '', '', 62, 2, 3, '', 3),
(66, 'Công nợ CTV', '', '', 62, 2, 4, '', 3),
(67, 'Công nợ VC', '', '', 62, 2, 5, '', 3),
(68, 'Công nợ bưu điện', '', '', 62, 2, 6, '', 3),
(69, 'Web', '', '', 0, 2, 6, 'fa-wikipedia-w', 1),
(70, 'Quản lý comment trên web', '', '', 69, 2, 1, '', 2),
(71, 'Giao diện', '', '', 69, 2, 2, '', 2),
(72, 'Menu', '', '', 69, 2, 3, '', 2),
(73, 'Quản lý page', '', '', 0, 2, 7, 'fa-facebook', 1),
(74, 'Comment và inbox', '', '', 73, 2, 1, '', 2),
(75, 'Cấu hình', '', '', 73, 2, 2, '', 2),
(76, 'Tổng quan', '', '', 73, 2, 3, '', 2),
(77, 'Báo cáo', '', '', 0, 2, 8, 'fa-file-excel-o', 1),
(78, 'Báo cáo bán hàng', '', '', 77, 2, 1, '', 2),
(79, 'Báo cáo hàng hóa', '', '', 77, 2, 2, '', 2),
(80, 'Báo cáo nhân viên', '', '', 77, 2, 3, '', 2),
(81, 'Báo cáo tài chính', '', '', 77, 2, 4, '', 2),
(82, 'Báo cáo hóa đơn-chứng từ', '', '', 77, 2, 5, '', 2),
(83, 'Làm việc chung', '', '', 0, 2, 9, 'fa-users', 1),
(84, 'Chấm công', '', '', 83, 2, 1, '', 2),
(85, 'Đăng ký lịch', '', '', 83, 2, 2, '', 2),
(86, 'Nhiệm vụ', '', '', 83, 2, 3, '', 2),
(87, 'Thưởng/Phạt', '', '', 83, 2, 4, '', 2),
(88, 'Lương thưởng', '', '', 83, 2, 5, '', 2),
(89, 'Xử lý kỹ thuật', '', '', 0, 2, 10, 'fa-wrench', 1),
(90, 'Tư vấn KH', '', '', 89, 2, 1, '', 2),
(91, 'Xử lý bảo hành', '', '', 89, 2, 2, '', 2),
(92, 'Quản lý bài viết', '', '', 0, 2, 11, 'fa-file-text-o', 1),
(93, 'Bài viết up web', '', '', 92, 2, 1, '', 2),
(94, 'Bài viết up facebook', '', '', 92, 2, 2, '', 2),
(95, 'Bài viết Review', '', '', 92, 2, 3, '', 2),
(96, 'Quản lý cấu hình', '', '', 0, 2, 12, 'fa-cog', 1),
(97, 'Tài khoản nhân viên', '', '', 96, 2, 1, '', 2),
(98, 'Phân nhóm quyền', '', '', 96, 2, 2, '', 2),
(99, 'Quản lý file trên host', '', '', 96, 2, 3, '', 2),
(100, 'Thêm cơ sở', '', '', 96, 2, 4, '', 2),
(101, 'Cài đặt bản in', '', '', 96, 2, 5, '', 2),
(102, 'Mẫu in đơn bán hàng', '', '', 101, 2, 1, '', 3),
(103, 'Mẫu phiếu xuất kho', '', '', 101, 2, 2, '', 3),
(104, 'Mẫu phiếu nhập kho', '', '', 101, 2, 3, '', 3),
(105, 'Nhà cung cấp', '', '', 96, 2, 6, '', 2),
(106, 'Danh sách nhà cung cấp', '', '', 105, 2, 1, '', 3),
(107, 'Thêm mới', '', '', 105, 2, 2, '', 3),
(108, 'Công nợ', '', '', 105, 2, 3, '', 3),
(109, 'Cấu hình lương/Thưởng', '', '', 96, 2, 7, '', 2),
(110, 'Cấu hình lương', '', '', 109, 2, 1, '', 3),
(111, 'Cấu hình thưởng', '', '', 109, 2, 2, '', 3),
(112, 'Cấu hình vận chuyển', '', '', 96, 2, 8, '', 2),
(113, 'Cấu hình thanh toán', '', '', 96, 2, 9, '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `ArticleId` int(11) NOT NULL,
  `ArticleTitle` varchar(250) NOT NULL,
  `ArticleSlug` varchar(250) NOT NULL,
  `ArticleLead` text NOT NULL,
  `ArticleContent` text NOT NULL,
  `ArticleTypeId` tinyint(4) NOT NULL,
  `ArticleStatusId` tinyint(4) NOT NULL,
  `ArticleImage` varchar(250) NOT NULL,
  `PublishDateTime` datetime NOT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL,
  `UpdateUserId` int(11) DEFAULT NULL,
  `UpdateDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`ArticleId`, `ArticleTitle`, `ArticleSlug`, `ArticleLead`, `ArticleContent`, `ArticleTypeId`, `ArticleStatusId`, `ArticleImage`, `PublishDateTime`, `CrUserId`, `CrDateTime`, `UpdateUserId`, `UpdateDateTime`) VALUES
(1, 'Bài viết test', 'bai-viet-test', '<p>hbh</p>', '<p>hgggggg</p>', 1, 2, '', '2017-10-01 20:00:00', 3, '2017-10-01 20:11:03', NULL, NULL),
(2, 'Bài test 2', 'bai-test-2', '<p>bbb</p>', '<p>mmnm</p>', 1, 2, 'anh-1-597c9b2f3ecfb.png', '2017-10-01 20:15:00', 3, '2017-10-01 20:24:05', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cancelreasons`
--

CREATE TABLE `cancelreasons` (
  `CancelReasonId` smallint(6) NOT NULL,
  `CancelReasonName` varchar(250) NOT NULL,
  `StatusId` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cancelreasons`
--

INSERT INTO `cancelreasons` (`CancelReasonId`, `CancelReasonName`, `StatusId`) VALUES
(1, 'ghhhh', 2),
(2, 'hhhhhhhhtttttttt3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryId` smallint(6) NOT NULL,
  `CategoryName` varchar(250) NOT NULL,
  `CategoryDesc` varchar(650) NOT NULL,
  `CategorySlug` varchar(250) NOT NULL,
  `ItemTypeId` tinyint(4) NOT NULL,
  `ProductTypeId` tinyint(4) NOT NULL,
  `CategoryTypeId` tinyint(4) NOT NULL,
  `StatusId` tinyint(4) NOT NULL,
  `ParentCategoryId` smallint(6) NOT NULL,
  `DisplayOrder` smallint(6) NOT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL,
  `UpdateUserId` int(11) DEFAULT NULL,
  `UpdateDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryId`, `CategoryName`, `CategoryDesc`, `CategorySlug`, `ItemTypeId`, `ProductTypeId`, `CategoryTypeId`, `StatusId`, `ParentCategoryId`, `DisplayOrder`, `CrUserId`, `CrDateTime`, `UpdateUserId`, `UpdateDateTime`) VALUES
(1, 'Microphone', 'Microphone', 'microphone', 1, 1, 1, 2, 0, 4, 1, '2017-07-30 00:00:00', NULL, NULL),
(2, 'Combo', 'Combo', 'combo', 2, 1, 1, 2, 0, 1, 1, '2017-07-30 00:00:00', NULL, NULL),
(3, 'Phụ kiện', 'Phụ kiện', 'phu-kien', 1, 1, 1, 2, 0, 5, 1, '2017-07-30 00:00:00', NULL, NULL),
(4, 'Sound Card', 'Sound Card', 'sound-card', 1, 1, 1, 2, 0, 7, 1, '2017-07-30 00:00:00', NULL, NULL),
(5, 'Combo Quà tặng', 'Combo Quà tặng', 'combo-qua-tang', 2, 1, 1, 2, 0, 2, 1, '2017-07-30 00:00:00', NULL, NULL),
(6, 'Phụ kiện con 1', '', 'phu-kien-con-1', 1, 1, 1, 2, 3, 1, 3, '2017-10-01 16:51:27', 3, '2017-10-01 17:13:32'),
(7, 'Phụ kiện con 2', '<p>fffffffffb vvvvvvvvv</p>', 'phu-kien-con-2', 1, 1, 1, 2, 3, 3, 3, '2017-10-01 16:53:43', 3, '2017-10-01 17:25:23'),
(8, 'Tin tức', '<p></p>', 'tin-tuc', 4, 1, 1, 2, 0, 1, 3, '2017-10-01 17:37:53', NULL, NULL),
(9, 'Tin nổi bật', '<p></p>', 'tin-noi-bat', 4, 1, 1, 2, 0, 2, 3, '2017-10-01 20:04:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categoryitems`
--

CREATE TABLE `categoryitems` (
  `CategoryItemId` int(11) NOT NULL,
  `CategoryId` smallint(6) NOT NULL,
  `ItemId` int(11) NOT NULL,
  `ItemTypeId` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categoryitems`
--

INSERT INTO `categoryitems` (`CategoryItemId`, `CategoryId`, `ItemId`, `ItemTypeId`) VALUES
(1, 1, 3, 3),
(2, 2, 3, 3),
(3, 1, 4, 3),
(4, 2, 4, 3),
(9, 1, 5, 3),
(10, 3, 5, 3),
(11, 2, 5, 3),
(12, 5, 5, 3),
(19, 1, 8, 3),
(20, 2, 8, 3),
(25, 1, 9, 3),
(26, 2, 9, 3),
(27, 8, 1, 4),
(28, 9, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE `configs` (
  `ConfigId` tinyint(4) NOT NULL,
  `ConfigCode` varchar(45) NOT NULL,
  `ConfigName` varchar(100) NOT NULL,
  `ConfigValue` text NOT NULL,
  `AutoLoad` tinyint(4) NOT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`ConfigId`, `ConfigCode`, `ConfigName`, `ConfigValue`, `AutoLoad`, `CrUserId`, `CrDateTime`) VALUES
(1, 'EMAIL_COMPANY', 'Email', 'ricky@gmail.com', 1, 1, '2016-10-06 10:26:46'),
(2, 'COMPANY_NAME', 'Tên công ty', 'Ricky', 1, 1, '2016-09-05 00:00:00'),
(3, 'SITE_NAME', 'Tên trang web', 'Ricky', 1, 1, '2016-09-05 11:19:29');

-- --------------------------------------------------------

--
-- Table structure for table `contributorproducttypes`
--

CREATE TABLE `contributorproducttypes` (
  `ContributorProductTypeId` int(11) NOT NULL,
  `ContributorId` smallint(6) NOT NULL,
  `ProductTypeId` smallint(6) NOT NULL,
  `Cost` int(11) NOT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contributors`
--

CREATE TABLE `contributors` (
  `ContributorId` smallint(6) NOT NULL,
  `ContributorName` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `ContributorPhone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `BirthDay` datetime NOT NULL,
  `Address` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customeraddress`
--

CREATE TABLE `customeraddress` (
  `CustomerAddressId` int(11) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `CustomerName` varchar(250) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `Address` varchar(250) NOT NULL,
  `ProvinceId` tinyint(4) NOT NULL,
  `DistrictId` smallint(6) NOT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customeraddress`
--

INSERT INTO `customeraddress` (`CustomerAddressId`, `CustomerId`, `CustomerName`, `Email`, `PhoneNumber`, `Address`, `ProvinceId`, `DistrictId`, `CrUserId`, `CrDateTime`) VALUES
(6, 2, 'Hoan Le Van', 'levanhoanhtt@gmail.com', '1669136318', 'Nguyen Thai Hoc Street, Ha Trung', 26, 288, 3, '2017-09-02 22:42:11'),
(7, 0, '', '', '', '', 26, 288, 3, '2017-09-10 21:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `customergroups`
--

CREATE TABLE `customergroups` (
  `CustomerGroupId` smallint(6) NOT NULL,
  `CustomerGroupName` varchar(250) NOT NULL,
  `StatusId` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customergroups`
--

INSERT INTO `customergroups` (`CustomerGroupId`, `CustomerGroupName`, `StatusId`) VALUES
(1, 'Khách lẻ', 2);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerId` int(11) NOT NULL,
  `FullName` varchar(250) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `GenderId` tinyint(4) NOT NULL,
  `StatusId` tinyint(4) NOT NULL,
  `BirthDay` datetime DEFAULT NULL,
  `CustomerTypeId` tinyint(4) NOT NULL,
  `ProvinceId` tinyint(4) NOT NULL,
  `DistrictId` smallint(6) NOT NULL,
  `Address` varchar(250) NOT NULL,
  `CustomerGroupId` tinyint(4) NOT NULL,
  `Facebook` varchar(100) DEFAULT NULL,
  `Commnet` varchar(650) DEFAULT NULL,
  `CareStaffId` int(11) NOT NULL,
  `DiscountTypeId` smallint(6) NOT NULL,
  `PaymentTimeId` smallint(6) NOT NULL,
  `PositionName` varchar(250) DEFAULT NULL,
  `CompanyName` varchar(250) DEFAULT NULL,
  `TaxCode` varchar(15) DEFAULT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL,
  `UpdateUserId` int(11) DEFAULT NULL,
  `UpdateDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerId`, `FullName`, `PhoneNumber`, `Email`, `GenderId`, `StatusId`, `BirthDay`, `CustomerTypeId`, `ProvinceId`, `DistrictId`, `Address`, `CustomerGroupId`, `Facebook`, `Commnet`, `CareStaffId`, `DiscountTypeId`, `PaymentTimeId`, `PositionName`, `CompanyName`, `TaxCode`, `CrUserId`, `CrDateTime`, `UpdateUserId`, `UpdateDateTime`) VALUES
(1, 'Nguyễn Văn An', '0123456789', 'test@gmail.com', 1, 0, '1990-12-12 00:00:00', 1, 1, 1, 'Hà Nội', 1, 'fhf', 'mfnmf', 1, 1, 2, '', '', '', 1, '2017-07-25 00:00:00', NULL, NULL),
(2, 'Hoan Le Van', '1669136318', 'levanhoanhtt@gmail.com', 1, 2, '2017-08-04 00:00:00', 1, 26, 288, 'Nguyen Thai Hoc Street, Ha Trung', 1, NULL, 'vvvv', 1, 1, 2, '', '', '', 3, '2017-08-22 21:38:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `DistrictId` smallint(6) NOT NULL,
  `DistrictName` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `ProvinceId` tinyint(4) NOT NULL,
  `GHNSupport` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `TTCSupport` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `VNPTSupport` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ViettelPostSupport` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ShipChungSupport` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `GHNDistrictCode` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ViettelPostDistrictCode` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ShipChungDistrictCode` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`DistrictId`, `DistrictName`, `ProvinceId`, `GHNSupport`, `TTCSupport`, `VNPTSupport`, `ViettelPostSupport`, `ShipChungSupport`, `GHNDistrictCode`, `ViettelPostDistrictCode`, `ShipChungDistrictCode`) VALUES
(485, 'Huyện Bình Chánh', 50, '1', '1', '1', '1', '1', '0220', 'HCM.7380', '52.567'),
(487, 'Huyện Cần Giờ', 50, '0', '1', '1', '1', '1', '', 'HCM.7590', '52.559'),
(483, 'Huyện Củ Chi', 50, '1', '1', '1', '1', '1', '0221', 'HCM.7330', '52.553'),
(484, 'Huyện Hóc Môn', 50, '1', '1', '1', '1', '1', '0222', 'HCM.7310', '52.563'),
(486, 'Huyện Nhà Bè', 50, '1', '1', '1', '1', '1', '0223', 'HCM.7580', '52.554'),
(466, 'Quận 1', 50, '1', '1', '1', '1', '1', '0201', 'HCM.7100', '52.560'),
(475, 'Quận 10', 50, '1', '1', '1', '1', '1', '0210', 'HCM.7400', '52.555'),
(476, 'Quận 11', 50, '1', '1', '1', '1', '1', '0211', 'HCM.7430', '52.562'),
(477, 'Quận 12', 50, '1', '1', '1', '1', '1', '0212', 'HCM.7290', '52.557'),
(467, 'Quận 2', 50, '1', '1', '1', '1', '1', '0202', 'HCM.7130', '52.571'),
(468, 'Quận 3', 50, '1', '1', '1', '1', '1', '0203', 'HCM.7220', '52.550'),
(469, 'Quận 4', 50, '1', '1', '1', '1', '1', '0204', 'HCM.7540', '52.566'),
(470, 'Quận 5', 50, '1', '1', '1', '1', '1', '0205', 'HCM.7480', '52.549'),
(471, 'Quận 6', 50, '1', '1', '1', '1', '1', '0206', 'HCM.7460', '52.548'),
(472, 'Quận 7', 50, '1', '1', '1', '1', '1', '0207', 'HCM.7560', '52.556'),
(473, 'Quận 8', 50, '1', '1', '1', '1', '1', '0208', 'HCM.7510', '52.565'),
(474, 'Quận 9', 50, '1', '1', '1', '1', '1', '0209', 'HCM.7150', '52.558'),
(679, 'Quận Bình Tân', 50, '1', '1', '1', '1', '1', '0219', 'HCM.7620', '52.564'),
(480, 'Quận Bình Thạnh', 50, '1', '1', '1', '1', '1', '0216', 'HCM.7170', '52.569'),
(478, 'Quận Gò Vấp', 50, '1', '1', '1', '1', '1', '0213', 'HCM.7270', '52.561'),
(481, 'Quận Phú Nhuận', 50, '1', '1', '1', '1', '1', '0217', 'HCM.7250', '52.570'),
(479, 'Quận Tân Bình', 50, '1', '1', '1', '1', '1', '0214', 'HCM.7360', '52.551'),
(680, 'Quận Tân Phú', 50, '1', '1', '1', '1', '1', '0215', 'HCM.7600', '52.552'),
(482, 'Quận Thủ Đức', 50, '1', '1', '1', '1', '1', '0218', 'HCM.7200', '52.568'),
(699, 'Huyện Ba Vì', 1, '1', '1', '1', '1', '1', '1B17', 'HNI.1547', '18.164'),
(700, 'Huyện Chương Mỹ', 1, '1', '1', '1', '1', '1', '1B21', 'HNI.1561', '18.169'),
(701, 'Huyện Đan Phượng', 1, '1', '1', '1', '1', '1', '1B22', 'HNI.1533', '18.185'),
(10, 'Huyện Đông Anh', 1, '1', '1', '1', '1', '1', '1A13', 'HNI.1360', '18.188'),
(11, 'Huyện Gia Lâm', 1, '1', '1', '1', '1', '1', '1A12', 'HNI.1310', '18.172'),
(702, 'Huyện Hoài Đức', 1, '1', '1', '1', '1', '1', '1B23', 'HNI.1529', '18.166'),
(34, 'Huyện Mê Linh', 1, '1', '1', '1', '1', '1', '1B29', 'HNI.1420', '18.175'),
(703, 'Huyện Mỹ Đức', 1, '1', '1', '1', '1', '1', '1B25', 'HNI.1576', '18.182'),
(704, 'Huyện Phú Xuyên', 1, '1', '1', '1', '1', '1', '1B28', 'HNI.1580', '18.184'),
(705, 'Huyện Phúc Thọ', 1, '1', '1', '1', '1', '1', '1B18', 'HNI.1536', '18.179'),
(706, 'Huyện Quốc Oai', 1, '1', '1', '1', '1', '1', '1B20', 'HNI.1557', '18.187'),
(9, 'Huyện Sóc Sơn', 1, '1', '1', '1', '1', '1', '1A14', 'HNI.1390', '18.171'),
(12, 'Huyện Từ Liêm', 1, '0', '1', '0', '1', '0', '', 'HNI.1290', ''),
(707, 'Huyện Thạch Thất', 1, '1', '1', '1', '1', '1', '1B19', 'HNI.1553', '18.168'),
(708, 'Huyện Thanh Oai', 1, '1', '1', '1', '1', '1', '1B24', 'HNI.1567', '18.180'),
(13, 'Huyện Thanh Trì', 1, '1', '1', '1', '1', '1', '1A11', 'HNI.1340', '18.176'),
(710, 'Huyện Thường Tín', 1, '1', '1', '1', '1', '1', '1B27', 'HNI.1585', '18.181'),
(711, 'Huyện Ứng Hòa', 1, '1', '1', '1', '1', '1', '1B26', 'HNI.1571', '18.177'),
(2, 'Quận Ba Đình', 1, '1', '1', '1', '1', '1', '1A01', 'HNI.1180', '18.189'),
(810, 'Quận Bắc Từ Liêm', 1, '1', '1', '1', '1', '1', '0110', 'HNI.1280', '18.717'),
(8, 'Quận Cầu Giấy', 1, '1', '1', '1', '1', '1', '1A06', 'HNI.1220', '18.178'),
(6, 'Quận Đống Đa', 1, '1', '1', '1', '1', '1', '1A04', 'HNI.1150', '18.191'),
(687, 'Quận Hà Đông', 1, '1', '1', '1', '1', '1', '1B15', 'HNI.1510', '18.170'),
(5, 'Quận Hai Bà Trưng', 1, '1', '1', '1', '1', '1', '1A03', 'HNI.1120', '18.173'),
(4, 'Quận Hoàn Kiếm', 1, '1', '1', '1', '1', '1', '1A02', 'HNI.1100', '18.163'),
(688, 'Quận Hoàng Mai', 1, '1', '1', '1', '1', '1', '1A08', 'HNI.1270', '18.167'),
(689, 'Quận Long Biên', 1, '1', '1', '1', '1', '1', '1A09', 'HNI.1250', '18.186'),
(811, 'Quận Nam Từ Liêm', 1, '1', '1', '1', '1', '1', '0130', 'HNI.1260', '18.165'),
(3, 'Quận Tây Hồ', 1, '1', '1', '1', '1', '1', '1A05', 'HNI.1240', '18.174'),
(7, 'Quận Thanh Xuân', 1, '1', '1', '1', '1', '1', '1A07', 'HNI.1200', '18.190'),
(698, 'Thị xã Sơn Tây', 1, '1', '1', '1', '1', '1', '1B16', 'HNI.1540', '18.183'),
(366, 'Huyện Đảo Hoàng Sa', 32, '0', '1', '1', '1', '1', '', 'DNG.5573', '35.380'),
(365, 'Huyện Hòa Vang', 32, '1', '1', '1', '1', '1', '0406', 'DNG.5564', '35.378'),
(685, 'Quận Cẩm Lệ', 32, '1', '1', '1', '1', '1', '0407', 'DNG.5574', '35.373'),
(360, 'Quận Hải Châu', 32, '1', '1', '1', '1', '1', '0401', 'DNG.5510', '35.376'),
(364, 'Quận Liên Chiểu', 32, '1', '1', '1', '1', '1', '0405', 'DNG.5557', '35.379'),
(363, 'Quận Ngũ Hành Sơn', 32, '1', '1', '1', '1', '1', '0404', 'DNG.5568', '35.375'),
(362, 'Quận Sơn Trà', 32, '1', '1', '1', '1', '1', '0403', 'DNG.5533', '35.377'),
(361, 'Quận Thanh Khê', 32, '1', '1', '1', '1', '1', '0402', 'DNG.5542', '35.374'),
(584, 'Huyện An Phú', 57, '1', '1', '1', '1', '1', '5103', 'AGG.8837', '56.598'),
(587, 'Huyện Châu Phú', 57, '1', '1', '1', '1', '1', '5108', 'AGG.8828', '56.600'),
(591, 'Huyện Châu Thành', 57, '1', '1', '1', '1', '1', '5110', 'AGG.8822', '56.603'),
(590, 'Huyện Chợ Mới', 57, '1', '1', '1', '1', '1', '5109', 'AGG.8816', '56.599'),
(586, 'Huyện Phú Tân', 57, '1', '1', '1', '1', '1', '5105', 'AGG.8825', '56.595'),
(588, 'Huyện Tịnh Biên', 57, '1', '1', '1', '1', '1', '5106', 'AGG.8840', '56.602'),
(592, 'Huyện Thoại Sơn', 57, '1', '1', '1', '1', '1', '5111', 'AGG.8846', '56.596'),
(589, 'Huyện Tri Tôn', 57, '1', '1', '1', '1', '1', '5107', 'AGG.8843', '56.604'),
(583, 'Thành phố Châu Đốc', 57, '1', '1', '1', '1', '1', '5102', 'AGG.8830', '56.594'),
(582, 'Thành Phố Long Xuyên', 57, '1', '1', '1', '1', '1', '5101', 'AGG.8810', '56.597'),
(585, 'Thị xã Tân Châu', 57, '1', '1', '1', '1', '1', '5104', 'AGG.8834', '56.601'),
(553, 'Huyện Côn Đảo', 49, '1', '1', '1', '1', '1', '5205', 'VTU.7943', '54.589'),
(549, 'Huyện Châu Đức', 49, '1', '1', '1', '1', '1', '5207', 'VTU.7953', '54.591'),
(693, 'Huyện Đất Đỏ', 49, '1', '1', '1', '1', '1', '5208', 'VTU.7946', '54.593'),
(552, 'Huyện Long Đất', 49, '0', '1', '0', '0', '0', '', '', ''),
(692, 'Huyện Long Điền', 49, '1', '1', '1', '1', '1', '5204', 'VTU.7944', '54.590'),
(551, 'Huyện Tân Thành', 49, '1', '1', '1', '1', '1', '5206', 'VTU.7956', '54.587'),
(550, 'Huyện Xuyên Mộc', 49, '1', '1', '1', '1', '1', '5203', 'VTU.7948', '54.588'),
(548, 'Thành phố Bà Rịa', 49, '1', '1', '1', '1', '1', '5202', 'VTU.7951', '54.586'),
(547, 'Thành phố Vũng Tàu', 49, '1', '1', '1', '1', '1', '5201', 'VTU.7910', '54.592'),
(691, 'Thị trấn Phú Mỹ', 49, '0', '1', '0', '0', '0', '', '', ''),
(719, 'Huyện Bàu Bàng', 47, '1', '1', '1', '1', '1', '4408', 'BDG.8248', '49.708'),
(722, 'Huyện Bắc Tân Uyên', 47, '1', '1', '1', '1', '1', '4409', 'BDG.8247', '49.710'),
(720, 'Huyện Dầu Tiếng', 47, '1', '1', '1', '1', '1', '4407', 'BDG.8236', '49.523'),
(721, 'Huyện Phú Giáo', 47, '1', '1', '1', '1', '1', '4406', 'BDG.8228', '49.526'),
(522, 'Thành phố Thủ Dầu Một', 47, '1', '1', '1', '1', '1', '4401', 'BDG.8210', '49.524'),
(523, 'Thị xã Bến Cát', 47, '1', '1', '1', '1', '1', '4402', 'BDG.8231', '49.522'),
(681, 'Thị xã Dĩ An', 47, '1', '1', '1', '1', '1', '4405', 'BDG.8246', '49.521'),
(524, 'Thị xã Tân Uyên', 47, '1', '1', '1', '1', '1', '4403', 'BDG.8223', '49.520'),
(525, 'Thị xã Thuận An', 47, '1', '1', '1', '1', '1', '4404', 'BDG.8239', '49.525'),
(509, 'Huyện Bù Đăng', 45, '1', '1', '1', '1', '1', '4308', 'BPC.8317', '45.491'),
(723, 'Huyện Bù Đốp', 45, '1', '1', '1', '1', '1', '4306', 'BPC.8336', '45.482'),
(724, 'Huyện Bù Gia Mập', 45, '1', '1', '1', '1', '1', '4310', 'BPC.8340', '45.487'),
(725, 'Huyện Chơn Thành', 45, '1', '1', '1', '1', '1', '4303', 'BPC.8333', '45.490'),
(506, 'Huyện Đồng Phú', 45, '1', '1', '1', '1', '1', '4302', 'BPC.8315', '45.486'),
(726, 'Huyện Hớn Quản', 45, '1', '1', '1', '1', '1', '4309', 'BPC.8341', '45.488'),
(508, 'Huyện Lộc Ninh', 45, '1', '1', '1', '1', '1', '4305', 'BPC.8325', '45.483'),
(727, 'Huyện Phú Riềng', 45, '1', '1', '0', '1', '0', '4311', 'BPC.8342', ''),
(510, 'Thị xã Bình Long', 45, '1', '1', '1', '1', '1', '4304', 'BPC.8329', '45.489'),
(678, 'Thị xã Đồng Xoài', 45, '1', '1', '1', '1', '1', '4301', 'BPC.8310', '45.485'),
(507, 'Thị xã Phước Long', 45, '1', '1', '1', '1', '1', '4307', 'BPC.8339', '45.484'),
(539, 'Huyện Bắc Bình', 39, '1', '1', '1', '1', '1', '4703', 'BTN.8019', '51.544'),
(544, 'Huyện Đức Linh', 39, '1', '1', '1', '1', '1', '4707', 'BTN.8037', '51.542'),
(543, 'Huyện Hàm Tân', 39, '1', '1', '1', '1', '1', '4706', 'BTN.8040', '51.545'),
(540, 'Huyện Hàm Thuận Bắc', 39, '1', '1', '1', '1', '1', '4704', 'BTN.8028', '51.538'),
(541, 'Huyện Hàm Thuận Nam', 39, '1', '1', '1', '1', '1', '4705', 'BTN.8031', '51.547'),
(545, 'Huyện Phú Quí', 39, '1', '1', '1', '1', '1', '4709', 'BTN.8044', '51.539'),
(542, 'Huyện Tánh Linh', 39, '1', '1', '1', '1', '1', '4708', 'BTN.8034', '51.541'),
(538, 'Huyện Tuy Phong', 39, '1', '1', '1', '1', '1', '4702', 'BTN.8023', '51.540'),
(537, 'Thành phố Phan Thiết', 39, '1', '1', '1', '1', '1', '4701', 'BTN.8010', '51.546'),
(728, 'Thị Xã La Gi', 39, '1', '1', '1', '1', '1', '4710', 'BTN.8046', '51.543'),
(398, 'Huyện An Lão', 35, '1', '1', '1', '1', '1', '3702', 'BDH.5938', '39.425'),
(400, 'Huyện Hoài Ân', 35, '1', '1', '1', '1', '1', '3703', 'BDH.5936', '39.423'),
(399, 'Huyện Hoài Nhơn', 35, '1', '1', '1', '1', '1', '3704', 'BDH.5932', '39.426'),
(403, 'Huyện Phù Cát', 35, '1', '1', '1', '1', '1', '3706', 'BDH.5924', '39.427'),
(401, 'Huyện Phù Mỹ', 35, '1', '1', '1', '1', '1', '3705', 'BDH.5928', '39.432'),
(404, 'Huyện Tây Sơn', 35, '1', '1', '1', '1', '1', '3708', 'BDH.5942', '39.422'),
(406, 'Huyện Tuy Phước', 35, '1', '1', '1', '1', '1', '3711', 'BDH.5917', '39.431'),
(407, 'Huyện Vân Canh', 35, '1', '1', '1', '1', '1', '3709', 'BDH.5945', '39.424'),
(402, 'Huyện Vĩnh Thạnh', 35, '1', '1', '1', '1', '1', '3707', 'BDH.5940', '39.429'),
(397, 'Thành phố Quy Nhơn', 35, '1', '1', '1', '1', '1', '3701', 'BDH.5910', '39.430'),
(405, 'Thị xã An Nhơn', 35, '1', '1', '1', '1', '1', '3710', 'BDH.5920', '39.703'),
(695, 'Huyện Đông Hải', 62, '1', '1', '1', '1', '1', '6006', 'BLU.9629', '65.687'),
(697, 'Huyện Hòa Bình', 62, '1', '1', '1', '1', '1', '6007', 'BLU.9632', '65.686'),
(662, 'Huyện Hồng Dân', 62, '1', '1', '1', '1', '1', '6003', 'BLU.9624', '65.691'),
(696, 'Huyện Phước Long', 62, '1', '1', '1', '1', '1', '6005', 'BLU.9621', '65.685'),
(663, 'Huyện Vĩnh Lợi', 62, '1', '1', '1', '1', '1', '6002', 'BLU.9615', '65.690'),
(661, 'Thành phố Bạc Liêu', 62, '1', '1', '1', '1', '1', '6001', 'BLU.9610', '65.688'),
(664, 'Thị xã Giá Rai', 62, '1', '1', '1', '1', '1', '6004', 'BLU.9626', '65.689'),
(219, 'Huyện Hiệp Hòa', 15, '1', '1', '1', '1', '1', '1807', 'BGG.2366', '19.193'),
(220, 'Huyện Lạng Giang', 15, '1', '1', '1', '1', '1', '1808', 'BGG.2340', '19.200'),
(222, 'Huyện Lục Nam', 15, '1', '1', '1', '1', '1', '1805', 'BGG.2318', '19.199'),
(218, 'Huyện Lục Ngạn', 15, '1', '1', '1', '1', '1', '1803', 'BGG.2330', '19.198'),
(221, 'Huyện Sơn Động', 15, '1', '1', '1', '1', '1', '1804', 'BGG.2325', '19.195'),
(217, 'Huyện Tân Yên', 15, '1', '1', '1', '1', '1', '1806', 'BGG.2353', '19.201'),
(223, 'Huyện Việt Yên', 15, '1', '1', '1', '1', '1', '1809', 'BGG.2361', '19.194'),
(224, 'Huyện Yên Dũng', 15, '1', '1', '1', '1', '1', '1810', 'BGG.2372', '19.197'),
(216, 'Huyện Yên Thế', 15, '1', '1', '1', '1', '1', '1802', 'BGG.2347', '19.196'),
(215, 'Thành phố Bắc Giang', 15, '1', '1', '1', '1', '1', '1801', 'BGG.2310', '19.192'),
(156, 'Huyện Ba Bể', 4, '1', '1', '1', '1', '1', '1106', 'BKN.2627', '6.56'),
(160, 'Huyện Bạch Thông', 4, '1', '1', '1', '1', '1', '1103', 'BKN.2619', '6.55'),
(158, 'Huyện Chợ Đồn', 4, '1', '1', '1', '1', '1', '1102', 'BKN.2632', '6.50'),
(161, 'Huyện Chợ Mới', 4, '1', '1', '1', '1', '1', '1107', 'BKN.2638', '6.49'),
(159, 'Huyện Na Rì', 4, '1', '1', '1', '1', '1', '1104', 'BKN.2613', '6.54'),
(157, 'Huyện Ngân Sơn', 4, '1', '1', '1', '1', '1', '1105', 'BKN.2623', '6.51'),
(718, 'Huyện Pác Nặm', 4, '1', '1', '1', '1', '1', '1108', 'BKN.2643', '6.53'),
(155, 'Thành phố Bắc Kạn', 4, '1', '1', '1', '1', '1', '1101', 'BKN.2610', '6.52'),
(59, 'Huyện Gia Bình', 18, '1', '1', '1', '1', '1', '1907', 'BNH.2232', '2.16'),
(58, 'Huyện Lương Tài', 18, '1', '1', '1', '1', '1', '1908', 'BNH.2235', '2.14'),
(54, 'Huyện Quế Võ', 18, '1', '1', '1', '1', '1', '1903', 'BNH.2228', '2.18'),
(55, 'Huyện Tiên Du', 18, '1', '1', '1', '1', '1', '1904', 'BNH.2218', '2.20'),
(57, 'Huyện Thuận Thành', 18, '1', '1', '1', '1', '1', '1906', 'BNH.2224', '2.17'),
(53, 'Huyện Yên Phong', 18, '1', '1', '1', '1', '1', '1902', 'BNH.2214', '2.19'),
(52, 'Thành phố Bắc Ninh', 18, '1', '1', '1', '1', '1', '1901', 'BNH.2210', '2.15'),
(56, 'Thị xã Từ Sơn', 18, '1', '1', '1', '1', '1', '1905', 'BNH.2221', '2.21'),
(618, 'Huyện Ba Tri', 53, '1', '1', '1', '1', '1', '5607', 'BTE.9333', '60.638'),
(617, 'Huyện Bình Đại', 53, '1', '1', '1', '1', '1', '5606', 'BTE.9337', '60.641'),
(613, 'Huyện Châu Thành', 53, '1', '1', '1', '1', '1', '5602', 'BTE.9313', '60.639'),
(614, 'Huyện Chợ Lách', 53, '1', '1', '1', '1', '1', '5603', 'BTE.9317', '60.640'),
(616, 'Huyện Giồng Trôm', 53, '1', '1', '1', '1', '1', '5605', 'BTE.9326', '60.646'),
(615, 'Huyện Mỏ Cày Bắc', 53, '1', '1', '1', '1', '1', '5604', 'BTE.9320', '60.643'),
(802, 'Huyện Mỏ Cày Nam', 53, '1', '1', '1', '1', '1', '5609', 'BTE.9321', '60.642'),
(619, 'Huyện Thạnh Phú', 53, '1', '1', '1', '1', '1', '5608', 'BTE.9330', '60.645'),
(612, 'Thành phố Bến Tre', 53, '1', '1', '1', '1', '1', '5601', 'BTE.9310', '60.644'),
(133, 'Huyện Bảo Lạc', 3, '1', '1', '1', '1', '1', '0602', 'CBG.2762', '1.5'),
(731, 'Huyện Bảo Lâm', 3, '1', '1', '1', '1', '1', '0612', 'CBG.2767', '1.11'),
(141, 'Huyện Hạ Lang', 3, '1', '1', '1', '1', '1', '0611', 'CBG.2722', '1.3'),
(134, 'Huyện Hà Quảng', 3, '1', '1', '1', '1', '1', '0604', 'CBG.2746', '1.13'),
(139, 'Huyện Hoà An', 3, '1', '1', '1', '1', '1', '0608', 'CBG.2738', '1.8'),
(138, 'Huyện Nguyên Bình', 3, '1', '1', '1', '1', '1', '0607', 'CBG.2756', '1.4'),
(732, 'Huyện Phục Hòa', 3, '1', '1', '1', '1', '1', '0613', 'CBG.2778', '1.6'),
(140, 'Huyện Quảng Hoà', 3, '0', '1', '0', '0', '0', '', '', ''),
(733, 'Huyện Quảng Uyên', 3, '1', '1', '1', '1', '1', '0609', 'CBG.2715', '1.9'),
(142, 'Huyện Thạch An', 3, '1', '1', '1', '1', '1', '0610', 'CBG.2771', '1.1'),
(135, 'Huyện Thông Nông', 3, '1', '1', '1', '1', '1', '0603', 'CBG.2752', '1.10'),
(136, 'Huyện Trà Lĩnh', 3, '1', '1', '1', '1', '1', '0605', 'CBG.2734', '1.2'),
(137, 'Huyện Trùng Khánh', 3, '1', '1', '1', '1', '1', '0606', 'CBG.2727', '1.7'),
(132, 'Thành phố Cao Bằng', 3, '1', '1', '1', '1', '1', '0601', 'CBG.2710', '1.12'),
(670, 'Huyện Cái Nước', 63, '1', '1', '1', '1', '1', '6105', 'CMU.9727', '68.692'),
(671, 'Huyện Đầm Dơi', 63, '1', '1', '1', '1', '1', '6106', 'CMU.9730', '68.694'),
(729, 'Huyện Năm Căn', 63, '1', '1', '1', '1', '1', '6108', 'CMU.9739', '68.693'),
(672, 'Huyện Ngọc Hiển', 63, '0', '1', '1', '1', '1', '', 'CMU.9734', '68.695'),
(730, 'Huyện Phú Tân', 63, '1', '1', '1', '1', '1', '6109', 'CMU.9736', '68.697'),
(667, 'Huyện Thới Bình', 63, '1', '1', '1', '1', '1', '6102', 'CMU.9718', '68.696'),
(669, 'Huyện Trần Văn Thời', 63, '1', '1', '1', '1', '1', '6104', 'CMU.9723', '68.700'),
(668, 'Huyện U Minh', 63, '1', '1', '1', '1', '1', '6103', 'CMU.9721', '68.699'),
(666, 'Thành phố Cà Mau', 63, '1', '1', '1', '1', '1', '6101', 'CMU.9710', '68.698'),
(713, 'Huyện Cờ Đỏ', 59, '1', '1', '1', '1', '1', '5506', 'CTO.9046', '59.637'),
(639, 'Huyện Châu Thành', 59, '0', '1', '0', '1', '0', '', 'CTO.9061', ''),
(642, 'Huyện Long Mỹ', 59, '0', '1', '0', '0', '0', '', '', ''),
(712, 'Huyện Phong Điền', 59, '1', '1', '1', '1', '1', '5505', 'CTO.9044', '59.634'),
(640, 'Huyện Phụng Hiệp', 59, '1', '1', '0', '1', '1', '6404', 'CTO.9091', '59.631'),
(714, 'Huyện Thới Lai', 59, '1', '1', '1', '1', '1', '5509', 'CTO.9060', '59.627'),
(715, 'Huyện Vĩnh Thạnh', 59, '1', '1', '1', '1', '1', '5507', 'CTO.9050', '59.632'),
(683, 'Quận Bình Thuỷ', 59, '1', '1', '1', '1', '1', '5502', 'CTO.9028', '59.630'),
(684, 'Quận Cái Răng', 59, '1', '1', '1', '1', '1', '5503', 'CTO.9036', '59.636'),
(682, 'Quận Ninh Kiều', 59, '1', '1', '1', '1', '1', '5501', 'CTO.9010', '59.628'),
(638, 'Quận Ô Môn', 59, '1', '1', '1', '1', '1', '5504', 'CTO.9040', '59.626'),
(637, 'Quận Thốt Nốt', 59, '1', '1', '1', '1', '1', '5508', 'CTO.9042', '59.629'),
(437, 'Huyện Chư Păh', 41, '1', '1', '1', '1', '1', '3802', 'GLI.6030', '40.445'),
(442, 'Huyện Chư Prông', 41, '1', '1', '1', '1', '1', '3808', 'GLI.6042', '40.433'),
(746, 'Huyện Chư Pưh', 41, '1', '1', '1', '1', '1', '3817', 'GLI.6067', '40.447'),
(443, 'Huyện Chư Sê', 41, '1', '1', '1', '1', '1', '3809', 'GLI.6047', '40.441'),
(745, 'Huyện Đắk Đoa', 41, '1', '1', '1', '1', '1', '3813', 'GLI.6017', '40.437'),
(809, 'Huyện Đắk Pơ', 41, '1', '1', '1', '0', '1', '3815', '', '40.438'),
(441, 'Huyện Đức Cơ', 41, '1', '1', '1', '1', '1', '3807', 'GLI.6038', '40.440'),
(438, 'Huyện Ia Grai', 41, '1', '1', '1', '1', '1', '3812', 'GLI.6034', '40.439'),
(748, 'Huyện Ia Pa', 41, '1', '1', '1', '1', '1', '3814', 'GLI.6066', '40.446'),
(435, 'Huyện K''Bang', 41, '1', '1', '1', '1', '1', '3804', 'GLI.6026', '40.442'),
(440, 'Huyện Kông Chro', 41, '1', '1', '1', '1', '1', '3806', 'GLI.6057', '40.443'),
(445, 'Huyện Krông Pa', 41, '1', '1', '1', '1', '1', '3811', 'GLI.6060', '40.434'),
(436, 'Huyện Mang Yang', 41, '1', '1', '1', '1', '1', '3803', 'GLI.6021', '40.444'),
(747, 'Huyện Phú Thiện', 41, '1', '1', '1', '1', '1', '3816', 'GLI.6069', '40.435'),
(434, 'Thành phố Pleiku', 41, '1', '1', '1', '1', '1', '3801', 'GLI.6010', '40.436'),
(439, 'Thị xã An Khê', 41, '1', '1', '1', '1', '1', '3805', 'GLI.6024', '40.448'),
(444, 'Thị xã Ayun Pa', 41, '1', '1', '1', '1', '1', '3810', 'GLI.6053', '40.449'),
(126, 'Huyện Bắc Mê', 2, '1', '1', '1', '1', '1', '0507', 'HGG.3112', '3.27'),
(130, 'Huyện Bắc Quang', 2, '1', '1', '1', '1', '1', '0510', 'HGG.3148', '3.29'),
(122, 'Huyện Đồng Văn', 2, '1', '1', '1', '1', '1', '0502', 'HGG.3126', '3.31'),
(127, 'Huyện Hoàng Su Phì', 2, '1', '1', '1', '1', '1', '0508', 'HGG.3139', '3.22'),
(123, 'Huyện Mèo Vạc', 2, '1', '1', '1', '1', '1', '0503', 'HGG.3121', '3.23'),
(125, 'Huyện Quản Bạ', 2, '1', '1', '1', '1', '1', '0505', 'HGG.3131', '3.25'),
(749, 'Huyện Quang Bình', 2, '1', '1', '1', '1', '1', '0511', 'HGG.3152', '3.24'),
(128, 'Huyện Vị Xuyên', 2, '1', '1', '1', '1', '1', '0506', 'HGG.3134', '3.26'),
(129, 'Huyện Xín Mần', 2, '1', '1', '1', '1', '1', '0509', 'HGG.3144', '3.28'),
(124, 'Huyện Yên Minh', 2, '1', '1', '1', '1', '1', '0504', 'HGG.3115', '3.32'),
(121, 'Thành phố Hà Giang', 2, '1', '1', '1', '1', '1', '0501', 'HGG.3110', '3.30'),
(90, 'Huyện Bình Lục', 23, '1', '1', '1', '1', '1', '2406', 'HNM.4038', '25.257'),
(86, 'Huyện Duy Tiên', 23, '1', '1', '1', '1', '1', '2402', 'HNM.4023', '25.254'),
(87, 'Huyện Kim Bảng', 23, '1', '1', '1', '1', '1', '2403', 'HNM.4027', '25.255'),
(88, 'Huyện Lý Nhân', 23, '1', '1', '1', '1', '1', '2404', 'HNM.4015', '25.256'),
(89, 'Huyện Thanh Liêm', 23, '1', '1', '1', '1', '1', '2405', 'HNM.4033', '25.259'),
(85, 'Thành phố Phủ Lý', 23, '1', '1', '1', '1', '1', '2401', 'HNM.4010', '25.258'),
(326, 'Huyện Can Lộc', 28, '1', '1', '1', '1', '1', '3006', 'HTH.4829', '31.337'),
(328, 'Huyện Cẩm Xuyên', 28, '1', '1', '1', '1', '1', '3009', 'HTH.4876', '31.343'),
(324, 'Huyện Đức Thọ', 28, '1', '1', '1', '1', '1', '3004', 'HTH.4849', '31.336'),
(329, 'Huyện Hương Khê', 28, '1', '1', '1', '1', '1', '3007', 'HTH.4869', '31.342'),
(325, 'Huyện Hương Sơn', 28, '1', '1', '1', '1', '1', '3003', 'HTH.4856', '31.341'),
(330, 'Huyện Kỳ Anh', 28, '1', '1', '1', '1', '1', '3010', 'HTH.4884', '31.344'),
(751, 'Huyện Lộc Hà', 28, '1', '1', '1', '1', '1', '3012', 'HTH.4891', '31.338'),
(323, 'Huyện Nghi Xuân', 28, '1', '1', '1', '1', '1', '3005', 'HTH.4844', '31.340'),
(327, 'Huyện Thạch Hà', 28, '1', '1', '1', '1', '1', '3008', 'HTH.4819', '31.346'),
(750, 'Huyện Vũ Quang', 28, '1', '1', '1', '1', '1', '3011', 'HTH.4866', '31.335'),
(321, 'Thành phố Hà Tĩnh', 28, '1', '1', '1', '1', '1', '3001', 'HTH.4810', '31.345'),
(322, 'Thị xã Hồng Lĩnh', 28, '1', '1', '1', '1', '1', '3002', 'HTH.4837', '31.339'),
(812, 'Thị xã Kỳ Anh', 28, '1', '1', '1', '1', '0', '3013', 'HTH.4892', ''),
(758, 'Huyện Cao Phong', 11, '1', '1', '1', '1', '1', '2311', 'HBH.3537', '23.238'),
(263, 'Huyện Đà Bắc', 11, '1', '1', '1', '1', '1', '2302', 'HBH.3522', '23.229'),
(267, 'Huyện Kim Bôi', 11, '1', '1', '1', '1', '1', '2308', 'HBH.3551', '23.231'),
(265, 'Huyện Kỳ Sơn', 11, '1', '1', '1', '1', '1', '2306', 'HBH.3515', '23.228'),
(269, 'Huyện Lạc Sơn', 11, '1', '1', '1', '1', '1', '2305', 'HBH.3539', '23.233'),
(270, 'Huyện Lạc Thủy', 11, '1', '1', '1', '1', '1', '2309', 'HBH.3558', '23.230'),
(266, 'Huyện Lương Sơn', 11, '1', '1', '1', '1', '1', '2307', 'HBH.3517', '23.234'),
(264, 'Huyện Mai Châu', 11, '1', '1', '1', '1', '1', '2303', 'HBH.3533', '23.235'),
(268, 'Huyện Tân Lạc', 11, '1', '1', '1', '1', '1', '2304', 'HBH.3527', '23.232'),
(271, 'Huyện Yên Thủy', 11, '1', '1', '1', '1', '1', '2310', 'HBH.3548', '23.236'),
(262, 'Thành phố Hòa Bình', 11, '1', '1', '1', '1', '1', '2301', 'HBH.3510', '23.237'),
(80, 'Huyện Ân Thi', 21, '1', '1', '1', '1', '1', '2203', 'HYN.1618', '8.67'),
(78, 'Huyện Châu Giang', 21, '0', '1', '0', '0', '0', '', '', ''),
(81, 'Huyện Kim Động', 21, '1', '1', '1', '1', '1', '2202', 'HYN.1622', '8.71'),
(79, 'Huyện Khoái Châu', 21, '1', '1', '1', '1', '1', '2204', 'HYN.1625', '8.65'),
(759, 'Huyện Mỹ Hào', 21, '1', '1', '1', '1', '1', '2208', 'HYN.1632', '8.70'),
(76, 'Huyện Mỹ Văn', 21, '0', '1', '0', '0', '0', '', '', ''),
(82, 'Huyện Phù Cừ', 21, '1', '1', '1', '1', '1', '2207', 'HYN.1616', '8.63'),
(83, 'Huyện Tiên Lữ', 21, '1', '1', '1', '1', '1', '2206', 'HYN.1613', '8.72'),
(760, 'Huyện Văn Giang', 21, '1', '1', '1', '1', '1', '2210', 'HYN.1638', '8.69'),
(75, 'Huyện Văn Lâm', 21, '1', '1', '1', '1', '1', '2209', 'HYN.1635', '8.64'),
(77, 'Huyện Yên Mỹ', 21, '1', '1', '1', '1', '1', '2205', 'HYN.1629', '8.66'),
(74, 'Thành phố Hưng Yên', 21, '1', '1', '1', '1', '1', '2201', 'HYN.1610', '8.68'),
(70, 'Huyện Bình Giang', 19, '1', '1', '1', '1', '1', '2112', 'HDG.1751', '22.226'),
(69, 'Huyện Cẩm Giàng', 19, '1', '1', '1', '1', '1', '2109', 'HDG.1747', '22.220'),
(67, 'Huyện Gia Lộc', 19, '1', '1', '1', '1', '1', '2105', 'HDG.1754', '22.227'),
(66, 'Huyện Kim Thành', 19, '1', '1', '1', '1', '1', '2111', 'HDG.1731', '22.221'),
(65, 'Huyện Kinh Môn', 19, '1', '1', '1', '1', '1', '2104', 'HDG.1738', '22.224'),
(63, 'Huyện Nam Sách', 19, '1', '1', '1', '1', '1', '2103', 'HDG.1734', '22.223'),
(72, 'Huyện Ninh Giang', 19, '1', '1', '1', '1', '1', '2108', 'HDG.1761', '22.217'),
(68, 'Huyện Tứ Kỳ', 19, '1', '1', '1', '1', '1', '2106', 'HDG.1765', '22.218'),
(64, 'Huyện Thanh Hà', 19, '1', '1', '1', '1', '1', '2110', 'HDG.1727', '22.219'),
(71, 'Huyện Thanh Miện', 19, '1', '1', '1', '1', '1', '2107', 'HDG.1758', '22.222'),
(61, 'Thành phố Hải Dương', 19, '1', '1', '1', '1', '1', '2101', 'HDG.1710', '22.216'),
(62, 'Thị xã Chí Linh', 19, '1', '1', '1', '1', '1', '2102', 'HDG.1742', '22.225'),
(717, 'Huyện An Dương', 20, '1', '1', '1', '1', '1', '0310', 'HPG.1848', '24.242'),
(21, 'Huyện An Hải', 20, '0', '1', '0', '0', '0', '', '', ''),
(22, 'Huyện An Lão', 20, '1', '1', '1', '1', '1', '0307', 'HPG.1853', '24.247'),
(27, 'Huyện Bạch Long Vĩ', 20, '0', '1', '1', '1', '1', '', 'HPG.1872', '24.243'),
(26, 'Huyện Cát Hải', 20, '0', '1', '1', '1', '1', '', 'HPG.1891', '24.250'),
(23, 'Huyện Kiến Thụy', 20, '1', '1', '1', '1', '1', '0308', 'HPG.1867', '24.244'),
(24, 'Huyện Tiên Lãng', 20, '1', '1', '1', '1', '1', '0311', 'HPG.1856', '24.253'),
(20, 'Huyện Thuỷ Nguyên', 20, '1', '1', '1', '1', '1', '0309', 'HPG.1830', '24.251'),
(25, 'Huyện Vĩnh Bảo', 20, '1', '1', '1', '1', '1', '0312', 'HPG.1862', '24.248'),
(716, 'Quận Dương Kinh', 20, '1', '1', '1', '1', '1', '0315', 'HPG.1890', '24.246'),
(19, 'Quận Đồ Sơn', 20, '1', '1', '1', '1', '1', '0306', 'HPG.1871', '24.240'),
(690, 'Quận Hải An', 20, '1', '1', '1', '1', '1', '0305', 'HPG.1875', '24.245'),
(15, 'Quận Hồng Bàng', 20, '1', '1', '1', '1', '1', '0301', 'HPG.1810', '24.239'),
(18, 'Quận Kiến An', 20, '1', '1', '1', '1', '1', '0304', 'HPG.1851', '24.249'),
(17, 'Quận Lê Chân', 20, '1', '1', '1', '1', '1', '0302', 'HPG.1836', '24.241'),
(16, 'Quận Ngô Quyền', 20, '1', '1', '1', '1', '1', '0303', 'HPG.1818', '24.252'),
(754, 'Huyện Châu Thành', 60, '1', '1', '1', '1', '1', '6405', 'HUG.9127', '63.673'),
(755, 'Huyện Châu Thành A', 60, '1', '1', '1', '1', '1', '6406', 'HUG.9125', '63.671'),
(756, 'Huyện Long Mỹ', 60, '1', '1', '1', '1', '1', '6408', 'HUG.9115', '63.672'),
(757, 'Huyện Phụng Hiệp', 60, '1', '1', '1', '1', '1', '6404', 'HUG.9118', '63.676'),
(641, 'Huyện Vị Thủy', 60, '1', '1', '1', '1', '1', '6402', 'HUG.9122', '63.674'),
(636, 'Thành phố Vị Thanh', 60, '1', '1', '1', '1', '1', '6401', 'HUG.9110', '63.670'),
(752, 'Thị Xã Long Mỹ', 60, '0', '1', '0', '1', '0', '', 'HUG.9130', ''),
(753, 'Thị Xã Ngã Bảy', 60, '1', '1', '1', '1', '1', '6407', 'HUG.9129', '63.675'),
(761, 'Huyện Cam Lâm', 37, '1', '1', '1', '1', '1', '4109', 'KHA.6552', '43.472'),
(420, 'Huyện Diên Khánh', 37, '1', '1', '1', '1', '1', '4104', 'KHA.6537', '43.469'),
(423, 'Huyện Khánh Sơn', 37, '1', '1', '1', '1', '1', '4107', 'KHA.6542', '43.467'),
(422, 'Huyện Khánh Vĩnh', 37, '1', '1', '1', '1', '1', '4105', 'KHA.6540', '43.470'),
(424, 'Huyện Trường Sa', 37, '0', '1', '1', '1', '1', '', 'KHA.6548', '43.473'),
(418, 'Huyện Vạn Ninh', 37, '1', '1', '1', '1', '1', '4102', 'KHA.6535', '43.471'),
(421, 'Thành phố Cam Ranh', 37, '1', '1', '1', '1', '1', '4106', 'KHA.6544', '43.468'),
(417, 'Thành phố Nha Trang', 37, '1', '1', '1', '1', '1', '4101', 'KHA.6510', '43.465'),
(419, 'Thị xã Ninh Hòa', 37, '1', '1', '1', '1', '1', '4103', 'KHA.6529', '43.466'),
(628, 'Huyện An Biên', 58, '1', '1', '1', '1', '1', '5409', 'KGG.9224', '62.656'),
(629, 'Huyện An Minh', 58, '1', '1', '1', '1', '1', '5410', 'KGG.9227', '62.659'),
(625, 'Huyện Châu Thành', 58, '1', '1', '1', '1', '1', '5406', 'KGG.9230', '62.661'),
(627, 'Huyện Gò Quao', 58, '1', '1', '1', '1', '1', '5408', 'KGG.9235', '62.655'),
(762, 'Huyện Giang Thành', 58, '1', '1', '1', '1', '1', '5415', 'KGG.9250', '62.663'),
(626, 'Huyện Giồng Riềng', 58, '1', '1', '1', '1', '1', '5407', 'KGG.9238', '62.657'),
(623, 'Huyện Hòn Đất', 58, '1', '1', '1', '1', '1', '5404', 'KGG.9216', '62.662'),
(632, 'Huyện Kiên Hải', 58, '0', '1', '1', '1', '1', '', 'KGG.9241', '62.668'),
(763, 'Huyện Kiên Lương', 58, '1', '1', '1', '1', '1', '5403', 'KGG.9218', '62.660'),
(631, 'Huyện Phú Quốc', 58, '1', '1', '1', '1', '1', '5412', 'KGG.9222', '62.669'),
(624, 'Huyện Tân Hiệp', 58, '1', '1', '1', '1', '1', '5405', 'KGG.9214', '62.667'),
(764, 'Huyện U Minh Thượng', 58, '1', '1', '1', '1', '1', '5414', 'KGG.9246', '62.658'),
(630, 'Huyện Vĩnh Thuận', 58, '1', '1', '1', '1', '1', '5411', 'KGG.9232', '62.664'),
(621, 'Thành phố Rạch Giá', 58, '1', '1', '1', '1', '1', '5401', 'KGG.9210', '62.666'),
(633, 'Thị xã Hà Tiên', 58, '1', '1', '1', '1', '1', '5402', 'KGG.9220', '62.665'),
(427, 'Huyện Đắk Glei', 40, '1', '1', '1', '1', '1', '3602', 'KTM.5832', '38.414'),
(431, 'Huyện Đắk Hà', 40, '1', '1', '1', '1', '1', '3607', 'KTM.5822', '38.413'),
(429, 'Huyện Đắk Tô', 40, '1', '1', '1', '1', '1', '3604', 'KTM.5825', '38.419'),
(430, 'Huyện Kon Plông', 40, '1', '1', '1', '1', '1', '3606', 'KTM.5820', '38.417'),
(765, 'Huyện Kon Rẫy', 40, '1', '1', '1', '1', '1', '3608', 'KTM.5818', '38.421'),
(428, 'Huyện Ngọc Hồi', 40, '1', '1', '1', '1', '1', '3603', 'KTM.5830', '38.420'),
(432, 'Huyện Sa Thầy', 40, '1', '1', '1', '1', '1', '3605', 'KTM.5835', '38.415'),
(813, 'Huyện Tu Mơ Rông', 40, '1', '1', '1', '1', '1', '3609', 'KTM.5837', '38.416'),
(426, 'Thành phố Kon Tum', 40, '1', '1', '1', '1', '1', '3601', 'KTM.5810', '38.418'),
(248, 'Huyện Điện Biên', 8, '0', '1', '0', '0', '0', '', '', ''),
(249, 'Huyện Điện Biên Đông', 8, '1', '1', '0', '0', '0', '6207', '', ''),
(245, 'Huyện Mường Lay', 8, '0', '1', '0', '1', '0', '', 'DBN.3839', ''),
(242, 'Huyện Mường Tè', 8, '1', '1', '1', '1', '1', '0705', 'LCU.3919', '4.37'),
(814, 'Huyện Nậm Nhùn', 8, '1', '1', '1', '0', '1', '0708', '', '4.705'),
(243, 'Huyện Phong Thổ', 8, '1', '1', '1', '1', '1', '0703', 'LCU.3915', '4.34'),
(244, 'Huyện Sìn Hồ', 8, '1', '1', '1', '1', '1', '0704', 'LCU.3923', '4.35'),
(767, 'Huyện Tam Đường', 8, '1', '1', '1', '1', '1', '0702', 'LCU.3911', '4.33'),
(768, 'Huyện Tân Uyên', 8, '1', '1', '1', '1', '1', '0707', 'LCU.3940', '4.713'),
(246, 'Huyện Tủa Chùa', 8, '0', '1', '0', '0', '0', '', '', ''),
(247, 'Huyện Tuần Giáo', 8, '0', '1', '0', '0', '0', '', '', ''),
(766, 'Huyện Than Uyên', 8, '1', '1', '1', '1', '1', '0706', 'LCU.3929', '4.36'),
(241, 'Thành phố Lai Châu', 8, '1', '1', '1', '1', '1', '0701', 'LCU.3910', '4.38'),
(240, 'Thị xã Điện Biên Phủ', 8, '1', '1', '0', '0', '0', '6201', '', ''),
(563, 'Huyện Bến Lức', 51, '1', '1', '1', '1', '1', '4908', 'LAN.8523', '53.580'),
(567, 'Huyện Cần Đước', 51, '1', '1', '1', '1', '1', '4912', 'LAN.8527', '53.575'),
(568, 'Huyện Cần Giuộc', 51, '1', '1', '1', '1', '1', '4913', 'LAN.8531', '53.574'),
(565, 'Huyện Châu Thành', 51, '1', '1', '1', '1', '1', '4910', 'LAN.8518', '53.579'),
(562, 'Huyện Đức Hòa', 51, '1', '1', '1', '1', '1', '4907', 'LAN.8537', '53.584'),
(561, 'Huyện Đức Huệ', 51, '1', '1', '1', '1', '1', '4906', 'LAN.8542', '53.573'),
(558, 'Huyện Mộc Hóa', 51, '1', '1', '1', '1', '1', '4903', 'LAN.8548', '53.583'),
(556, 'Huyện Tân Hưng', 51, '1', '1', '1', '1', '1', '4914', 'LAN.8553', '53.578'),
(559, 'Huyện Tân Thạnh', 51, '1', '1', '1', '1', '1', '4904', 'LAN.8546', '53.581'),
(566, 'Huyện Tân Trụ', 51, '1', '1', '1', '1', '1', '4911', 'LAN.8521', '53.572'),
(560, 'Huyện Thạnh Hóa', 51, '1', '1', '1', '1', '1', '4905', 'LAN.8544', '53.582'),
(564, 'Huyện Thủ Thừa', 51, '1', '1', '1', '1', '1', '4909', 'LAN.8534', '53.577'),
(557, 'Huyện Vĩnh Hưng', 51, '1', '1', '1', '1', '1', '4902', 'LAN.8551', '53.585'),
(555, 'Thành phố Tân An', 51, '1', '1', '1', '1', '1', '4901', 'LAN.8510', '53.576'),
(771, 'Thị Xã Kiến Tường', 51, '1', '1', '1', '1', '1', '4915', 'LAN.8554', '53.706'),
(149, 'Huyện Bảo Thắng', 6, '1', '1', '1', '1', '1', '0804', 'LCI.3341', '5.44'),
(151, 'Huyện Bảo Yên', 6, '1', '1', '1', '1', '1', '0807', 'LCI.3353', '5.48'),
(147, 'Huyện Bát Xát', 6, '1', '1', '1', '1', '1', '0803', 'LCI.3325', '5.43'),
(148, 'Huyện Bắc Hà', 6, '1', '1', '1', '1', '1', '0808', 'LCI.3310', '5.46'),
(146, 'Huyện Mường Khương', 6, '1', '1', '1', '1', '1', '0809', 'LCI.3319', '5.42'),
(150, 'Huyện Sa Pa', 6, '1', '1', '1', '1', '1', '0805', 'LCI.3331', '5.41'),
(769, 'Huyện Si Ma Cai', 6, '1', '1', '1', '1', '1', '0802', 'LCI.3316', '5.47'),
(152, 'Huyện Than Uyên', 6, '1', '1', '0', '0', '0', '0706', '', ''),
(153, 'Huyện Văn Bàn', 6, '1', '1', '1', '1', '1', '0806', 'LCI.3347', '5.45'),
(144, 'Thành phố Lào Cai', 6, '1', '1', '1', '1', '1', '0801', 'LCI.3334', '5.40'),
(145, 'Thị xã Cam Đường', 6, '0', '1', '0', '0', '0', '', '', ''),
(495, 'Huyện Bảo Lâm', 44, '1', '1', '1', '1', '1', '4211', 'LDG.6743', '46.494'),
(499, 'Huyện Cát Tiên', 44, '1', '1', '1', '1', '1', '4209', 'LDG.6755', '46.495'),
(496, 'Huyện Di Linh', 44, '1', '1', '1', '1', '1', '4204', 'LDG.6737', '46.496'),
(497, 'Huyện Đạ Huoai', 44, '1', '1', '1', '1', '1', '4207', 'LDG.6758', '46.497'),
(498, 'Huyện Đạ Tẻh', 44, '1', '1', '1', '1', '1', '4208', 'LDG.6752', '46.500'),
(770, 'Huyện Đam Rông', 44, '1', '1', '1', '1', '1', '4212', 'LDG.6760', '46.502'),
(492, 'Huyện Đơn Dương', 44, '1', '1', '1', '1', '1', '4205', 'LDG.6725', '46.501'),
(493, 'Huyện Đức Trọng', 44, '1', '1', '1', '1', '1', '4203', 'LDG.6733', '46.492'),
(491, 'Huyện Lạc Dương', 44, '1', '1', '1', '1', '1', '4206', 'LDG.6727', '46.493'),
(494, 'Huyện Lâm Hà', 44, '1', '1', '1', '1', '1', '4210', 'LDG.6728', '46.498'),
(490, 'Thành phố Bảo Lộc', 44, '1', '1', '1', '1', '1', '4202', 'LDG.6747', '46.503'),
(489, 'Thành phố Đà Lạt', 44, '1', '1', '1', '1', '1', '4201', 'LDG.6710', '46.499'),
(167, 'Huyện Bắc Sơn', 13, '1', '1', '1', '1', '1', '1005', 'LSN.2450', '14.123'),
(166, 'Huyện Bình Gia', 13, '1', '1', '1', '1', '1', '1003', 'LSN.2445', '14.125'),
(169, 'Huyện Cao Lộc', 13, '1', '1', '1', '1', '1', '1007', 'LSN.2418', '14.128'),
(171, 'Huyện Chi Lăng', 13, '1', '1', '1', '1', '1', '1009', 'LSN.2456', '14.121'),
(172, 'Huyện Đình Lập', 13, '1', '1', '1', '1', '1', '1010', 'LSN.2475', '14.129'),
(173, 'Huyện Hữu Lũng', 13, '1', '1', '1', '1', '1', '1011', 'LSN.2461', '14.120'),
(170, 'Huyện Lộc Bình', 13, '1', '1', '1', '1', '1', '1008', 'LSN.2468', '14.127'),
(164, 'Huyện Tràng Định', 13, '1', '1', '1', '1', '1', '1002', 'LSN.2431', '14.126'),
(165, 'Huyện Văn Lãng', 13, '1', '1', '1', '1', '1', '1004', 'LSN.2425', '14.124'),
(168, 'Huyện Văn Quan', 13, '1', '1', '1', '1', '1', '1006', 'LSN.2439', '14.119'),
(163, 'Thành phố Lạng Sơn', 13, '1', '1', '1', '1', '1', '1001', 'LSN.2410', '14.122'),
(99, 'Huyện Giao Thủy', 24, '1', '1', '1', '1', '1', '2504', 'NDH.4278', '28.283'),
(101, 'Huyện Hải Hậu', 24, '1', '1', '1', '1', '1', '2510', 'NDH.4282', '28.286'),
(94, 'Huyện Mỹ Lộc', 24, '1', '1', '1', '1', '1', '2502', 'NDH.4239', '28.281'),
(96, 'Huyện Nam Trực', 24, '1', '1', '1', '1', '1', '2507', 'NDH.4246', '28.279'),
(100, 'Huyện Nghĩa Hưng', 24, '1', '1', '1', '1', '1', '2509', 'NDH.4265', '28.284'),
(97, 'Huyện Trực Ninh', 24, '1', '1', '1', '1', '1', '2508', 'NDH.4251', '28.280'),
(93, 'Huyện Vụ Bản', 24, '1', '1', '1', '1', '1', '2506', 'NDH.4242', '28.287'),
(98, 'Huyện Xuân Trường', 24, '1', '1', '1', '1', '1', '2503', 'NDH.4271', '28.282'),
(95, 'Huyện ý Yên', 24, '1', '1', '1', '1', '1', '2505', 'NDH.4257', '28.278'),
(92, 'Thành phố Nam Định', 24, '1', '1', '1', '1', '1', '2501', 'NDH.4210', '28.285'),
(314, 'Huyện Anh Sơn', 27, '1', '1', '1', '1', '1', '2913', 'NAN.4724', '30.315'),
(311, 'Huyện Con Cuông', 27, '1', '1', '1', '1', '1', '2909', 'NAN.4730', '30.319'),
(313, 'Huyện Diễn Châu', 27, '1', '1', '1', '1', '1', '2912', 'NAN.4638', '30.329'),
(315, 'Huyện Đô Lương', 27, '1', '1', '1', '1', '1', '2914', 'NAN.4714', '30.332'),
(319, 'Huyện Hưng Nguyên', 27, '1', '1', '1', '1', '1', '2918', 'NAN.4743', '30.320'),
(305, 'Huyện Kỳ Sơn', 27, '1', '1', '1', '1', '1', '2907', 'NAN.4738', '30.330'),
(318, 'Huyện Nam Đàn', 27, '1', '1', '1', '1', '1', '2917', 'NAN.4749', '30.327'),
(317, 'Huyện Nghi Lộc', 27, '1', '1', '1', '1', '1', '2916', 'NAN.4626', '30.333'),
(307, 'Huyện Nghĩa Đàn', 27, '1', '1', '1', '1', '1', '2905', 'NAN.4674', '30.321'),
(303, 'Huyện Quế Phong', 27, '1', '1', '1', '1', '1', '2919', 'NAN.4711', '30.326'),
(304, 'Huyện Quỳ Châu', 27, '1', '1', '1', '1', '1', '2903', 'NAN.4697', '30.323'),
(306, 'Huyện Quỳ Hợp', 27, '1', '1', '1', '1', '1', '2904', 'NAN.4690', '30.318'),
(309, 'Huyện Quỳnh Lưu', 27, '1', '1', '1', '1', '1', '2906', 'NAN.4649', '30.317'),
(310, 'Huyện Tân Kỳ', 27, '1', '1', '1', '1', '1', '2910', 'NAN.4684', '30.328'),
(308, 'Huyện Tương Dương', 27, '1', '1', '1', '1', '1', '2908', 'NAN.4733', '30.325'),
(316, 'Huyện Thanh Chương', 27, '1', '1', '1', '1', '1', '2915', 'NAN.4757', '30.316'),
(312, 'Huyện Yên Thành', 27, '1', '1', '1', '1', '1', '2911', 'NAN.4662', '30.334'),
(301, 'Thành phố Vinh', 27, '1', '1', '1', '1', '1', '2901', 'NAN.4610', '30.331'),
(302, 'Thị xã Cửa Lò', 27, '1', '1', '1', '1', '1', '2902', 'NAN.4624', '30.324'),
(772, 'Thị Xã Hoàng Mai', 27, '1', '1', '0', '0', '1', '2921', '', '30.720'),
(773, 'Thị Xã Thái Hòa', 27, '1', '1', '1', '1', '1', '2920', 'NAN.4716', '30.322'),
(115, 'Huyện Gia Viễn', 25, '1', '1', '1', '1', '1', '2704', 'NBH.4322', '27.273'),
(116, 'Huyện Hoa Lư', 25, '1', '1', '1', '1', '1', '2705', 'NBH.4319', '27.274'),
(119, 'Huyện Kim Sơn', 25, '1', '1', '1', '1', '1', '2707', 'NBH.4339', '27.271'),
(114, 'Huyện Nho Quan', 25, '1', '1', '1', '1', '1', '2703', 'NBH.4326', '27.272'),
(118, 'Huyện Yên Khánh', 25, '1', '1', '1', '1', '1', '2708', 'NBH.4345', '27.277'),
(117, 'Huyện Yên Mô', 25, '1', '1', '1', '1', '1', '2706', 'NBH.4336', '27.275'),
(112, 'Thành phố Ninh Bình', 25, '1', '1', '1', '1', '1', '2701', 'NBH.4310', '27.269'),
(113, 'Thành phố Tam Điệp', 25, '1', '1', '1', '1', '1', '2702', 'NBH.4333', '27.270'),
(774, 'Huyện Bác Ái', 38, '1', '1', '1', '1', '1', '4505', 'NTN.6629', '47.504'),
(503, 'Huyện Ninh Hải', 38, '1', '1', '1', '1', '1', '4503', 'NTN.6626', '47.508'),
(504, 'Huyện Ninh Phước', 38, '1', '1', '1', '1', '1', '4504', 'NTN.6633', '47.505'),
(502, 'Huyện Ninh Sơn', 38, '1', '1', '1', '1', '1', '4502', 'NTN.6631', '47.506'),
(775, 'Huyện Thuận Bắc', 38, '1', '1', '1', '1', '1', '4506', 'NTN.6636', '47.509'),
(776, 'Huyện Thuận Nam', 38, '1', '1', '1', '1', '1', '4507', 'NTN.6630', '47.507'),
(501, 'Thành phố Phan Rang', 38, '1', '1', '1', '1', '1', '4501', 'NTN.6610', '47.510'),
(777, 'Huyện Cẩm Khê', 16, '1', '1', '1', '1', '1', '1506', 'PHO.2970', '17.159'),
(204, 'Huyện Đoan Hùng', 16, '1', '1', '1', '1', '1', '1503', 'PHO.2949', '17.153'),
(205, 'Huyện Hạ Hoà', 16, '1', '1', '1', '1', '1', '1505', 'PHO.2962', '17.162'),
(208, 'Huyện Lâm Thao', 16, '1', '1', '1', '1', '1', '1510', 'PHO.2929', '17.161'),
(207, 'Huyện Phong Châu', 16, '0', '1', '0', '0', '0', '', '', ''),
(778, 'Huyện Phù Ninh', 16, '1', '1', '1', '1', '1', '1509', 'PHO.2923', '17.155'),
(209, 'Huyện Sông Thao', 16, '0', '1', '0', '0', '0', '', '', ''),
(779, 'Huyện Tam Nông', 16, '1', '1', '1', '1', '1', '1511', 'PHO.2940', '17.160'),
(211, 'Huyện Tam Thanh', 16, '0', '1', '0', '0', '0', '', '', ''),
(780, 'Huyện Tân Sơn', 16, '1', '1', '1', '1', '1', '1513', 'PHO.2994', '17.157'),
(206, 'Huyện Thanh Ba', 16, '1', '1', '1', '1', '1', '1504', 'PHO.2956', '17.151'),
(213, 'Huyện Thanh Sơn', 16, '1', '1', '1', '1', '1', '1508', 'PHO.2982', '17.156'),
(212, 'Huyện Thanh Thuỷ', 16, '1', '1', '1', '1', '1', '1512', 'PHO.2945', '17.154'),
(210, 'Huyện Yên Lập', 16, '1', '1', '1', '1', '1', '1507', 'PHO.2976', '17.158'),
(202, 'Thành phố Việt Trì', 16, '1', '1', '1', '1', '1', '1501', 'PHO.2910', '17.152'),
(203, 'Thị xã Phú Thọ', 16, '1', '1', '1', '1', '1', '1502', 'PHO.2935', '17.150'),
(414, 'Huyện Đông Hòa', 36, '1', '1', '1', '1', '1', '3907', 'PYN.6230', '9.78'),
(410, 'Huyện Đồng Xuân', 36, '1', '1', '1', '1', '1', '3902', 'PYN.6222', '9.81'),
(676, 'Huyện Phú Hòa', 36, '1', '1', '1', '1', '1', '3908', 'PYN.6234', '9.73'),
(415, 'Huyện Sông Hinh', 36, '1', '1', '1', '1', '1', '3906', 'PYN.6227', '9.76'),
(413, 'Huyện Sơn Hòa', 36, '1', '1', '1', '1', '1', '3905', 'PYN.6224', '9.80'),
(677, 'Huyện Tây Hòa', 36, '1', '1', '1', '1', '1', '3909', 'PYN.6232', '9.77'),
(412, 'Huyện Tuy An', 36, '1', '1', '1', '1', '1', '3904', 'PYN.6216', '9.75'),
(409, 'Thành phố Tuy Hòa', 36, '1', '1', '1', '1', '1', '3901', 'PYN.6210', '9.79'),
(411, 'Thị xã Sông Cầu', 36, '1', '1', '1', '1', '1', '3903', 'PYN.6219', '9.74'),
(336, 'Huyện Bố Trạch', 29, '1', '1', '1', '1', '1', '3105', 'QBH.5115', '32.350'),
(338, 'Huyện Lệ Thủy', 29, '1', '1', '1', '1', '1', '3107', 'QBH.5139', '32.347'),
(334, 'Huyện Minh Hóa', 29, '1', '1', '1', '1', '1', '3103', 'QBH.5132', '32.352'),
(337, 'Huyện Quảng Ninh', 29, '1', '1', '1', '1', '1', '3106', 'QBH.5136', '32.353'),
(335, 'Huyện Quảng Trạch', 29, '1', '1', '1', '1', '1', '3104', 'QBH.5122', '32.351'),
(333, 'Huyện Tuyên Hóa', 29, '1', '1', '1', '1', '1', '3102', 'QBH.5128', '32.348'),
(332, 'Thành phố Đồng Hới', 29, '1', '1', '1', '1', '1', '3101', 'QBH.5110', '32.349'),
(781, 'Thị Xã Ba Đồn', 29, '1', '1', '1', '1', '1', '3108', 'QBH.5140', '32.719'),
(381, 'Huyện Bắc Trà My', 33, '1', '1', '1', '1', '1', '3411', 'QNM.5636', '36.389'),
(373, 'Huyện Duy Xuyên', 33, '1', '1', '1', '1', '1', '3403', 'QNM.5627', '36.395'),
(371, 'Huyện Đại Lộc', 33, '1', '1', '1', '1', '1', '3405', 'QNM.5647', '36.383'),
(804, 'Huyện Đông Giang', 33, '1', '1', '1', '1', '1', '3412', 'QNM.5655', '36.388'),
(374, 'Huyện Giằng', 33, '0', '1', '0', '0', '0', '', '', ''),
(370, 'Huyện Hiên', 33, '0', '1', '0', '0', '0', '', '', ''),
(377, 'Huyện Hiệp Đức', 33, '1', '1', '1', '1', '1', '3407', 'QNM.5634', '36.393'),
(806, 'Huyện Nam Giang', 33, '1', '1', '1', '1', '1', '3413', 'QNM.5660', '36.384'),
(803, 'Huyện Nam Trà My', 33, '1', '1', '1', '1', '1', '3415', 'QNM.5653', '36.387'),
(782, 'Huyện Nông Sơn', 33, '1', '1', '1', '1', '1', '3418', 'QNM.5611', '36.397'),
(380, 'Huyện Núi Thành', 33, '1', '1', '1', '1', '1', '3409', 'QNM.5623', '36.398'),
(783, 'Huyện Phú Ninh', 33, '1', '1', '1', '1', '1', '3417', 'QNM.5662', '36.381'),
(379, 'Huyện Phước Sơn', 33, '1', '1', '1', '1', '1', '3414', 'QNM.5651', '36.382'),
(376, 'Huyện Quế Sơn', 33, '1', '1', '1', '1', '1', '3406', 'QNM.5630', '36.396'),
(805, 'Huyện Tây Giang', 33, '1', '1', '1', '1', '1', '3416', 'QNM.5658', '36.390'),
(378, 'Huyện Tiên Phước', 33, '1', '1', '1', '1', '1', '3410', 'QNM.5620', '36.392'),
(375, 'Huyện Thăng Bình', 33, '1', '1', '1', '1', '1', '3408', 'QNM.5616', '36.385'),
(369, 'Thành phố Hội An', 33, '1', '1', '1', '1', '1', '3402', 'QNM.5638', '36.391'),
(368, 'Thành phố Tam Kỳ', 33, '1', '1', '1', '1', '1', '3401', 'QNM.5610', '36.386'),
(372, 'Thị xã Điện Bàn', 33, '1', '1', '1', '1', '1', '3404', 'QNM.5642', '36.394'),
(395, 'Huyện Ba Tơ', 34, '1', '1', '1', '1', '1', '3512', 'QNI.5732', '37.401'),
(385, 'Huyện Bình Sơn', 34, '1', '1', '1', '1', '1', '3503', 'QNI.5718', '37.403'),
(394, 'Huyện Đức Phổ', 34, '1', '1', '1', '1', '1', '3511', 'QNI.5735', '37.411'),
(384, 'Huyện Lý Sơn', 34, '0', '1', '1', '1', '1', '', 'QNI.5714', '37.409'),
(392, 'Huyện Minh Long', 34, '1', '1', '1', '1', '1', '3509', 'QNI.5731', '37.402'),
(393, 'Huyện Mộ Đức', 34, '1', '1', '1', '1', '1', '3510', 'QNI.5738', '37.405'),
(391, 'Huyện Nghĩa Hành', 34, '1', '1', '1', '1', '1', '3508', 'QNI.5729', '37.399'),
(389, 'Huyện Sơn Hà', 34, '1', '1', '1', '1', '1', '3506', 'QNI.5726', '37.410'),
(388, 'Huyện Sơn Tây', 34, '1', '1', '1', '1', '1', '3513', 'QNI.5728', '37.406'),
(387, 'Huyện Sơn Tịnh', 34, '1', '1', '1', '1', '1', '3505', 'QNI.5715', '37.412'),
(784, 'Huyện Tây Trà', 34, '1', '1', '1', '1', '1', '3514', 'QNI.5724', '37.408'),
(390, 'Huyện Tư Nghĩa', 34, '1', '1', '1', '1', '1', '3507', 'QNI.5740', '37.400'),
(386, 'Huyện Trà Bồng', 34, '1', '1', '1', '1', '1', '3504', 'QNI.5722', '37.407'),
(383, 'Thành phố Quảng Ngãi', 34, '1', '1', '1', '1', '1', '3501', 'QNI.5710', '37.404'),
(233, 'Huyện Ba Chẽ', 14, '1', '1', '1', '1', '1', '1709', 'QNH.2059', '20.206'),
(229, 'Huyện Bình Liêu', 14, '1', '1', '1', '1', '1', '1705', 'QNH.2061', '20.207'),
(237, 'Huyện Cô Tô', 14, '1', '1', '1', '1', '1', '1714', 'QNH.2055', '20.212'),
(786, 'Huyện Đầm Hà', 14, '1', '1', '1', '1', '1', '1706', 'QNH.2063', '20.208'),
(787, 'Huyện Hải Hà', 14, '1', '1', '1', '1', '1', '1707', 'QNH.2065', '20.214'),
(235, 'Huyện Hoành Bồ', 14, '1', '1', '1', '1', '1', '1712', 'QNH.2072', '20.209'),
(231, 'Huyện Quảng Hà', 14, '0', '1', '0', '0', '0', '', '', ''),
(232, 'Huyện Tiên Yên', 14, '1', '1', '1', '1', '1', '1708', 'QNH.2056', '20.202'),
(234, 'Huyện Vân Đồn', 14, '1', '1', '1', '1', '1', '1713', 'QNH.2053', '20.210'),
(238, 'Huyện Yên Hưng', 14, '0', '1', '0', '1', '0', '', 'QNH.2075', ''),
(227, 'Thành phố Cẩm Phả', 14, '1', '1', '1', '1', '1', '1702', 'QNH.2032', '20.211'),
(226, 'Thành phố Hạ Long', 14, '1', '1', '1', '1', '1', '1701', 'QNH.2010', '20.215'),
(230, 'Thành phố Móng Cái', 14, '1', '1', '1', '1', '1', '1704', 'QNH.2068', '20.213'),
(228, 'Thành phố Uông Bí', 14, '1', '1', '1', '1', '1', '1703', 'QNH.2079', '20.203'),
(236, 'Thị xã Đông Triều', 14, '1', '1', '1', '1', '1', '1710', 'QNH.2086', '20.205'),
(785, 'Thị Xã Quảng Yên', 14, '1', '1', '1', '1', '1', '1711', 'QNH.2075', '20.204'),
(344, 'Huyện Cam Lộ', 30, '1', '1', '1', '1', '1', '3205', 'QTI.5223', '33.359'),
(788, 'Huyện Cồn Cỏ', 30, '0', '1', '1', '1', '1', '', 'QTI.5244', '33.360'),
(348, 'Huyện Đa Krông', 30, '1', '1', '1', '1', '1', '3209', 'QTI.5230', '33.361'),
(343, 'Huyện Gio Linh', 30, '1', '1', '1', '1', '1', '3204', 'QTI.5214', '33.356'),
(346, 'Huyện Hải Lăng', 30, '1', '1', '1', '1', '1', '3207', 'QTI.5238', '33.362'),
(347, 'Huyện Hướng Hóa', 30, '1', '1', '1', '1', '1', '3208', 'QTI.5226', '33.357'),
(345, 'Huyện Triệu Phong', 30, '1', '1', '1', '1', '1', '3206', 'QTI.5233', '33.354'),
(342, 'Huyện Vĩnh Linh', 30, '1', '1', '1', '1', '1', '3203', 'QTI.5218', '33.363'),
(340, 'Thành phố Đông Hà', 30, '1', '1', '1', '1', '1', '3201', 'QTI.5210', '33.355'),
(341, 'Thị xã Quảng Trị', 30, '1', '1', '1', '1', '1', '3202', 'QTI.5237', '33.358'),
(792, 'Huyện Cù Lao Dung', 61, '1', '1', '1', '1', '1', '5908', 'STG.9538', '13.115'),
(791, 'Huyện Châu Thành', 61, '1', '1', '1', '1', '1', '5910', 'STG.9550', '13.112'),
(654, 'Huyện Kế Sách', 61, '1', '1', '1', '1', '1', '5902', 'STG.9520', '13.114'),
(655, 'Huyện Long Phú', 61, '1', '1', '1', '1', '1', '5906', 'STG.9517', '13.109'),
(656, 'Huyện Mỹ Tú', 61, '1', '1', '1', '1', '1', '5903', 'STG.9523', '13.118'),
(657, 'Huyện Mỹ Xuyên', 61, '1', '1', '1', '1', '1', '5904', 'STG.9530', '13.117'),
(658, 'Huyện Thạnh Trị', 61, '1', '1', '1', '1', '1', '5905', 'STG.9527', '13.111'),
(790, 'Huyện Trần Đề', 61, '1', '1', '1', '1', '1', '5911', 'STG.9511', '13.707'),
(653, 'Thành phố Sóc Trăng', 61, '1', '1', '1', '1', '1', '5901', 'STG.9510', '13.116'),
(789, 'Thị Xã Ngã Năm', 61, '1', '1', '1', '1', '1', '5909', 'STG.9540', '13.113'),
(659, 'Thị Xã Vĩnh Châu', 61, '1', '1', '1', '1', '1', '5907', 'STG.9535', '13.110'),
(255, 'Huyện Bắc Yên', 9, '1', '1', '1', '1', '1', '1405', 'SLA.3643', '16.147'),
(257, 'Huyện Mai Sơn', 9, '1', '1', '1', '1', '1', '1407', 'SLA.3615', '16.143'),
(260, 'Huyện Mộc Châu', 9, '1', '1', '1', '1', '1', '1410', 'SLA.3628', '16.148'),
(253, 'Huyện Mường La', 9, '1', '1', '1', '1', '1', '1403', 'SLA.3647', '16.140'),
(256, 'Huyện Phù Yên', 9, '1', '1', '1', '1', '1', '1406', 'SLA.3636', '16.144'),
(252, 'Huyện Quỳnh Nhai', 9, '1', '1', '1', '1', '1', '1402', 'SLA.3653', '16.139'),
(258, 'Huyện Sông Mã', 9, '1', '1', '1', '1', '1', '1409', 'SLA.3668', '16.141'),
(793, 'Huyện Sốp Cộp', 9, '1', '1', '1', '1', '1', '1411', 'SLA.3677', '16.145'),
(254, 'Huyện Thuận Châu', 9, '1', '1', '1', '1', '1', '1404', 'SLA.3657', '16.146'),
(794, 'Huyện Vân Hồ', 9, '1', '1', '1', '1', '1', '1412', 'SLA.3611', '16.714'),
(259, 'Huyện Yên Châu', 9, '1', '1', '1', '1', '1', '1408', 'SLA.3624', '16.149'),
(251, 'Thành phố Sơn La', 9, '1', '1', '1', '1', '1', '1401', 'SLA.3610', '16.142'),
(279, 'Huyện Bá Thước', 26, '1', '1', '1', '1', '1', '2807', 'THA.4481', '29.306'),
(280, 'Huyện Cẩm Thủy', 26, '1', '1', '1', '1', '1', '2814', 'THA.4476', '29.313'),
(295, 'Huyện Đông Sơn', 26, '1', '1', '1', '1', '1', '2820', 'THA.4452', '29.296'),
(288, 'Huyện Hà Trung', 26, '1', '1', '1', '1', '1', '2821', 'THA.4444', '29.310'),
(292, 'Huyện Hậu Lộc', 26, '1', '1', '1', '1', '1', '2824', 'THA.4431', '29.307'),
(294, 'Huyện Hoằng Hóa', 26, '1', '1', '1', '1', '1', '2822', 'THA.4422', '29.289'),
(281, 'Huyện Lang Chánh', 26, '1', '1', '1', '1', '1', '2811', 'THA.4523', '29.298'),
(276, 'Huyện Mường Lát', 26, '1', '1', '1', '1', '1', '2806', 'THA.4532', '29.312'),
(298, 'Huyện Nông Cống', 26, '1', '1', '1', '1', '1', '2819', 'THA.4538', '29.301'),
(289, 'Huyện Nga Sơn', 26, '1', '1', '1', '1', '1', '2823', 'THA.4437', '29.295'),
(283, 'Huyện Ngọc Lặc', 26, '1', '1', '1', '1', '1', '2812', 'THA.4516', '29.288'),
(286, 'Huyện Như Thanh', 26, '1', '1', '1', '1', '1', '2810', 'THA.4546', '29.308'),
(285, 'Huyện Như Xuân', 26, '1', '1', '1', '1', '1', '2809', 'THA.4551', '29.305'),
(277, 'Huyện Quan Hóa', 26, '1', '1', '1', '1', '1', '2804', 'THA.4526', '29.314'),
(278, 'Huyện Quan Sơn', 26, '1', '1', '1', '1', '1', '2805', 'THA.4529', '29.290'),
(297, 'Huyện Quảng Xương', 26, '1', '1', '1', '1', '1', '2825', 'THA.4555', '29.294'),
(299, 'Huyện Tĩnh Gia', 26, '1', '1', '1', '1', '1', '2826', 'THA.4564', '29.302'),
(282, 'Huyện Thạch Thành', 26, '1', '1', '1', '1', '1', '2813', 'THA.4470', '29.292'),
(293, 'Huyện Thiệu Hóa', 26, '1', '1', '1', '1', '1', '2817', 'THA.4456', '29.311'),
(291, 'Huyện Thọ Xuân', 26, '1', '1', '1', '1', '1', '2815', 'THA.4497', '29.291'),
(284, 'Huyện Thường Xuân', 26, '1', '1', '1', '1', '1', '2808', 'THA.4534', '29.303'),
(296, 'Huyện Triệu Sơn', 26, '1', '1', '1', '1', '1', '2818', 'THA.4487', '29.300'),
(287, 'Huyện Vĩnh Lộc', 26, '1', '1', '1', '1', '1', '2816', 'THA.4467', '29.297'),
(290, 'Huyện Yên Định', 26, '1', '1', '1', '1', '1', '2827', 'THA.4462', '29.304'),
(273, 'Thành phố Thanh Hóa', 26, '1', '1', '1', '1', '1', '2801', 'THA.4410', '29.299'),
(274, 'Thị xã Bỉm Sơn', 26, '1', '1', '1', '1', '1', '2802', 'THA.4449', '29.309'),
(275, 'Thị xã Sầm Sơn', 26, '1', '1', '1', '1', '1', '2803', 'THA.4420', '29.293'),
(107, 'Huyện Đông Hưng', 22, '1', '1', '1', '1', '1', '2604', 'TBH.4121', '26.266'),
(105, 'Huyện Hưng Hà', 22, '1', '1', '1', '1', '1', '2603', 'TBH.4142', '26.263'),
(109, 'Huyện Kiến Xương', 22, '1', '1', '1', '1', '1', '2606', 'TBH.4155', '26.268'),
(104, 'Huyện Quỳnh Phụ', 22, '1', '1', '1', '1', '1', '2602', 'TBH.4136', '26.262'),
(110, 'Huyện Tiền Hải', 22, '1', '1', '1', '1', '1', '2607', 'TBH.4162', '26.267'),
(106, 'Huyện Thái Thụy', 22, '1', '1', '1', '1', '1', '2608', 'TBH.4128', '26.260'),
(108, 'Huyện Vũ Thư', 22, '1', '1', '1', '1', '1', '2605', 'TBH.4149', '26.261'),
(103, 'Thành phố Thái Bình', 22, '1', '1', '1', '1', '1', '2601', 'TBH.4110', '26.265'),
(198, 'Huyện Đại Từ', 12, '1', '1', '1', '1', '1', '1206', 'TNN.2553', '12.106'),
(194, 'Huyện Định Hóa', 12, '1', '1', '1', '1', '1', '1203', 'TNN.2544', '12.107'),
(197, 'Huyện Đồng Hỷ', 12, '1', '1', '1', '1', '1', '1207', 'TNN.2525', '12.105'),
(199, 'Huyện Phú Bình', 12, '1', '1', '1', '1', '1', '1208', 'TNN.2575', '12.104'),
(196, 'Huyện Phú Lương', 12, '1', '1', '1', '1', '1', '1204', 'TNN.2538', '12.101'),
(195, 'Huyện Võ Nhai', 12, '1', '1', '1', '1', '1', '1205', 'TNN.2532', '12.102'),
(193, 'Thành phố Sông Công', 12, '1', '1', '1', '1', '1', '1202', 'TNN.2564', '12.108'),
(192, 'Thành phố Thái Nguyên', 12, '1', '1', '1', '1', '1', '1201', 'TNN.2510', '12.103'),
(200, 'Thị xã Phổ Yên', 12, '1', '1', '1', '1', '1', '1209', 'TNN.2568', '12.100'),
(357, 'Huyện A Lưới', 31, '1', '1', '1', '1', '1', '3309', 'HUE.5357', '34.368'),
(358, 'Huyện Nam Đông', 31, '1', '1', '1', '1', '1', '3308', 'HUE.5364', '34.372'),
(351, 'Huyện Phong Điền', 31, '1', '1', '1', '1', '1', '3302', 'HUE.5349', '34.369'),
(356, 'Huyện Phú Lộc', 31, '1', '1', '1', '1', '1', '3307', 'HUE.5371', '34.366');
INSERT INTO `districts` (`DistrictId`, `DistrictName`, `ProvinceId`, `GHNSupport`, `TTCSupport`, `VNPTSupport`, `ViettelPostSupport`, `ShipChungSupport`, `GHNDistrictCode`, `ViettelPostDistrictCode`, `ShipChungDistrictCode`) VALUES
(354, 'Huyện Phú Vang', 31, '1', '1', '1', '1', '1', '3305', 'HUE.5367', '34.365'),
(352, 'Huyện Quảng Điền', 31, '1', '1', '1', '1', '1', '3303', 'HUE.5346', '34.370'),
(350, 'Thành phố Huế', 31, '1', '1', '1', '1', '1', '3301', 'HUE.5310', '34.371'),
(355, 'Thị xã Hương Thủy', 31, '1', '1', '1', '1', '1', '3306', 'HUE.5361', '34.367'),
(353, 'Thị xã Hương Trà', 31, '1', '1', '1', '1', '1', '3304', 'HUE.5353', '34.364'),
(600, 'Huyện Cái Bè', 52, '1', '1', '1', '1', '1', '5303', 'TGG.8647', '58.622'),
(598, 'Huyện Cai Lậy', 52, '1', '1', '1', '1', '1', '5304', 'TGG.8641', '58.620'),
(597, 'Huyện Châu Thành', 52, '1', '1', '1', '1', '1', '5305', 'TGG.8634', '58.624'),
(599, 'Huyện Chợ Gạo', 52, '1', '1', '1', '1', '1', '5306', 'TGG.8620', '58.618'),
(602, 'Huyện Gò Công Đông', 52, '1', '1', '1', '1', '1', '5308', 'TGG.8630', '58.623'),
(601, 'Huyện Gò Công Tây', 52, '1', '1', '1', '1', '1', '5307', 'TGG.8624', '58.621'),
(796, 'Huyện Tân Phú Đông', 52, '1', '1', '1', '1', '1', '5310', 'TGG.8648', '58.617'),
(596, 'Huyện Tân Phước', 52, '1', '1', '1', '1', '1', '5309', 'TGG.8639', '58.625'),
(594, 'Thành phố Mỹ Tho', 52, '1', '1', '1', '1', '1', '5301', 'TGG.8610', '58.619'),
(815, 'Thị xã Cai Lậy', 52, '1', '1', '1', '1', '1', '5311', 'TGG.8641', '58.721'),
(595, 'Thị xã Gò Công', 52, '1', '1', '1', '1', '1', '5302', 'TGG.8627', '58.616'),
(645, 'Huyện Càng Long', 54, '1', '1', '1', '1', '1', '5802', 'TVH.9417', '64.680'),
(647, 'Huyện Cầu Kè', 54, '1', '1', '1', '1', '1', '5803', 'TVH.9421', '64.679'),
(649, 'Huyện Cầu Ngang', 54, '1', '1', '1', '1', '1', '5807', 'TVH.9435', '64.682'),
(646, 'Huyện Châu Thành', 54, '1', '1', '1', '1', '1', '5805', 'TVH.9426', '64.681'),
(648, 'Huyện Tiểu Cần', 54, '1', '1', '1', '1', '1', '5804', 'TVH.9423', '64.684'),
(650, 'Huyện Trà Cú', 54, '1', '1', '1', '1', '1', '5806', 'TVH.9430', '64.677'),
(644, 'Thành phố Trà Vinh', 54, '1', '1', '1', '1', '1', '5801', 'TVH.9410', '64.683'),
(651, 'Thị xã Duyên Hải', 54, '1', '1', '1', '1', '1', '5808', 'TVH.9439', '64.678'),
(177, 'Huyện Chiêm Hóa', 5, '1', '1', '1', '1', '1', '0904', 'TQG.3038', '7.61'),
(178, 'Huyện Hàm Yên', 5, '1', '1', '1', '1', '1', '0905', 'TQG.3055', '7.59'),
(797, 'Huyện Lâm Bình', 5, '1', '1', '1', '1', '1', '0902', 'TQG.3056', '7.702'),
(176, 'Huyện Nà Hang', 5, '1', '1', '1', '1', '1', '0903', 'TQG.3048', '7.62'),
(180, 'Huyện Sơn Dương', 5, '1', '1', '1', '1', '1', '0907', 'TQG.3028', '7.60'),
(179, 'Huyện Yên Sơn', 5, '1', '1', '1', '1', '1', '0906', 'TQG.3015', '7.58'),
(175, 'Thành phố Tuyên Quang', 5, '1', '1', '1', '1', '1', '0901', 'TQG.3010', '7.57'),
(518, 'Huyện Bến Cầu', 46, '1', '1', '1', '1', '1', '4607', 'TNH.8429', '48.513'),
(516, 'Huyện Châu Thành', 46, '1', '1', '1', '1', '1', '4605', 'TNH.8424', '48.512'),
(515, 'Huyện Dương Minh Châu', 46, '1', '1', '1', '1', '1', '4604', 'TNH.8417', '48.519'),
(519, 'Huyện Gò Dầu', 46, '1', '1', '1', '1', '1', '4608', 'TNH.8431', '48.517'),
(517, 'Huyện Hòa Thành', 46, '1', '1', '1', '1', '1', '4606', 'TNH.8427', '48.515'),
(513, 'Huyện Tân Biên', 46, '1', '1', '1', '1', '1', '4602', 'TNH.8422', '48.516'),
(795, 'Huyện Tân Bình', 46, '0', '1', '0', '0', '0', '', '', ''),
(514, 'Huyện Tân Châu', 46, '1', '1', '1', '1', '1', '4603', 'TNH.8419', '48.511'),
(520, 'Huyện Trảng Bàng', 46, '1', '1', '1', '1', '1', '4609', 'TNH.8433', '48.518'),
(512, 'Thành phố Tây Ninh', 46, '1', '1', '1', '1', '1', '4601', 'TNH.8410', '48.514'),
(798, 'Huyện Bình Tân', 55, '1', '1', '1', '1', '1', '5708', 'VLG.8938', '61.652'),
(605, 'Huyện Long Hồ', 55, '1', '1', '1', '1', '1', '5702', 'VLG.8913', '61.651'),
(606, 'Huyện Mang Thít', 55, '1', '1', '1', '1', '1', '5703', 'VLG.8934', '61.654'),
(608, 'Huyện Tam Bình', 55, '1', '1', '1', '1', '1', '5705', 'VLG.8917', '61.650'),
(609, 'Huyện Trà Ôn', 55, '1', '1', '1', '1', '1', '5706', 'VLG.8925', '61.647'),
(610, 'Huyện Vũng Liêm', 55, '1', '1', '1', '1', '1', '5707', 'VLG.8929', '61.653'),
(604, 'Thành phố Vĩnh Long', 55, '1', '1', '1', '1', '1', '5701', 'VLG.8910', '61.648'),
(607, 'Thị xã Bình Minh', 55, '1', '1', '1', '1', '1', '5704', 'VLG.8921', '61.649'),
(35, 'Huyện Bình Xuyên', 17, '1', '1', '1', '1', '1', '1606', 'VPC.2812', '15.137'),
(30, 'Huyện Lập Thạch', 17, '1', '1', '1', '1', '1', '1603', 'VPC.2818', '15.134'),
(800, 'Huyện Sông Lô', 17, '1', '1', '1', '1', '1', '1607', 'VPC.2838', '15.138'),
(31, 'Huyện Tam Dương', 17, '1', '1', '1', '1', '1', '1602', 'VPC.2815', '15.136'),
(801, 'Huyện Tam Đảo', 17, '1', '1', '1', '1', '1', '1609', 'VPC.2836', '15.135'),
(32, 'Huyện Vĩnh Tường', 17, '1', '1', '1', '1', '1', '1604', 'VPC.2823', '15.131'),
(33, 'Huyện Yên Lạc', 17, '1', '1', '1', '1', '1', '1605', 'VPC.2828', '15.133'),
(29, 'Thành phố Vĩnh Yên', 17, '1', '1', '1', '1', '1', '1601', 'VPC.2810', '15.132'),
(799, 'Thị xã Phúc Yên', 17, '1', '1', '1', '1', '1', '1608', 'VPC.2834', '15.130'),
(184, 'Huyện Lục Yên', 10, '1', '1', '1', '1', '1', '1309', 'YBN.3226', '11.96'),
(186, 'Huyện Mù Căng Chải', 10, '1', '1', '1', '1', '1', '1305', 'YBN.3261', '11.99'),
(190, 'Huyện Trạm Tấu', 10, '1', '1', '1', '1', '1', '1308', 'YBN.3259', '11.95'),
(187, 'Huyện Trấn Yên', 10, '1', '1', '1', '1', '1', '1307', 'YBN.3233', '11.93'),
(189, 'Huyện Văn Chấn', 10, '1', '1', '1', '1', '1', '1306', 'YBN.3247', '11.91'),
(185, 'Huyện Văn Yên', 10, '1', '1', '1', '1', '1', '1303', 'YBN.3240', '11.92'),
(188, 'Huyện Yên Bình', 10, '1', '1', '1', '1', '1', '1304', 'YBN.3219', '11.94'),
(182, 'Thành phố Yên Bái', 10, '1', '1', '1', '1', '1', '1301', 'YBN.3210', '11.98'),
(183, 'Thị xã Nghĩa Lộ', 10, '1', '1', '1', '1', '1', '1302', 'YBN.3256', '11.97'),
(736, 'Huyện Điện Biên', 7, '1', '1', '1', '1', '1', '6203', 'DBN.3814', '10.83'),
(737, 'Huyện Điện Biên Đông', 7, '1', '1', '1', '1', '1', '6207', 'DBN.3820', '10.84'),
(738, 'Huyện Mường Ảng', 7, '1', '1', '1', '1', '1', '6209', 'DBN.3848', '10.89'),
(739, 'Huyện Mường Chà', 7, '1', '1', '1', '1', '1', '6205', 'DBN.3833', '10.88'),
(740, 'Huyện Mường Nhé', 7, '1', '1', '1', '1', '1', '6208', 'DBN.3840', '10.87'),
(743, 'Huyện Nậm Pồ', 7, '0', '1', '1', '1', '1', '', 'DBN.3841', '10.704'),
(741, 'Huyện Tủa Chùa', 7, '1', '1', '1', '1', '1', '6206', 'DBN.3836', '10.86'),
(742, 'Huyện Tuần Giáo', 7, '1', '1', '1', '1', '1', '6204', 'DBN.3825', '10.90'),
(686, 'Thành phố Điện Biên Phủ', 7, '1', '1', '1', '1', '1', '6201', 'DBN.3810', '10.82'),
(735, 'Thị xã Mường Lay', 7, '1', '1', '1', '1', '1', '6202', 'DBN.3839', '10.85'),
(452, 'Huyện Buôn Đôn', 42, '1', '1', '1', '1', '1', '4013', 'DLK.6360', '42.460'),
(807, 'Huyện Cư Kuin', 42, '1', '1', '1', '1', '1', '4014', 'DLK.6380', '42.453'),
(453, 'Huyện Cư M''gar', 42, '1', '1', '1', '1', '1', '4006', 'DLK.6343', '42.459'),
(448, 'Huyện Ea H''leo', 42, '1', '1', '1', '1', '1', '4002', 'DLK.6356', '42.464'),
(454, 'Huyện Ea Kar', 42, '1', '1', '1', '1', '1', '4008', 'DLK.6334', '42.454'),
(449, 'Huyện Ea Súp', 42, '1', '1', '1', '1', '1', '4005', 'DLK.6363', '42.461'),
(458, 'Huyện Krông A Na', 42, '1', '1', '1', '1', '1', '4010', 'DLK.6366', '42.456'),
(459, 'Huyện Krông Bông', 42, '1', '1', '1', '1', '1', '4011', 'DLK.6370', '42.462'),
(451, 'Huyện Krông Búk', 42, '1', '1', '1', '1', '1', '4003', 'DLK.6347', '42.450'),
(450, 'Huyện Krông Năng', 42, '1', '1', '1', '1', '1', '4004', 'DLK.6352', '42.451'),
(456, 'Huyện Krông Pắc', 42, '1', '1', '1', '1', '1', '4007', 'DLK.6327', '42.457'),
(462, 'Huyện Lắk', 42, '1', '1', '1', '1', '1', '4012', 'DLK.6374', '42.458'),
(455, 'Huyện M''Đrắk', 42, '1', '1', '1', '1', '1', '4009', 'DLK.6339', '42.463'),
(447, 'Thành phố Buôn Mê Thuột', 42, '1', '1', '1', '1', '1', '4001', 'DLK.6310', '42.455'),
(734, 'Thị Xã Buôn Hồ', 42, '1', '1', '1', '1', '1', '4015', 'DLK.6390', '42.452'),
(457, 'Huyện Cư Jút', 43, '1', '1', '1', '1', '1', '6304', 'DKG.6424', '44.478'),
(464, 'Huyện Đắk Glong', 43, '1', '1', '1', '1', '1', '6307', 'DKG.6427', '44.474'),
(460, 'Huyện Đắk Mil', 43, '1', '1', '1', '1', '1', '6303', 'DKG.6418', '44.481'),
(463, 'Huyện Đắk R''Lấp', 43, '1', '1', '1', '1', '1', '6302', 'DKG.6413', '44.476'),
(673, 'Huyện Đắk Song', 43, '1', '1', '1', '1', '1', '6305', 'DKG.6416', '44.480'),
(461, 'Huyện Krông Nô', 43, '1', '1', '1', '1', '1', '6306', 'DKG.6421', '44.479'),
(675, 'Huyện Tuy Đức', 43, '1', '1', '1', '1', '1', '6308', 'DKG.6430', '44.475'),
(674, 'Thị xã Gia Nghĩa', 43, '1', '1', '1', '1', '1', '6301', 'DKG.6410', '44.477'),
(744, 'Huyện Cẩm Mỹ', 48, '1', '1', '1', '1', '1', '4811', 'DNI.8161', '50.534'),
(529, 'Huyện Định Quán', 48, '1', '1', '1', '1', '1', '4804', 'DNI.8142', '50.536'),
(534, 'Huyện Long Thành', 48, '1', '1', '1', '1', '1', '4808', 'DNI.8153', '50.537'),
(535, 'Huyện Nhơn Trạch', 48, '1', '1', '1', '1', '1', '4809', 'DNI.8158', '50.532'),
(528, 'Huyện Tân Phú', 48, '1', '1', '1', '1', '1', '4803', 'DNI.8146', '50.529'),
(531, 'Huyện Thống Nhất', 48, '1', '1', '1', '1', '1', '4805', 'DNI.8137', '50.530'),
(694, 'Huyện Trảng Bom', 48, '1', '1', '1', '1', '1', '4810', 'DNI.8164', '50.527'),
(530, 'Huyện Vĩnh Cửu', 48, '1', '1', '1', '1', '1', '4802', 'DNI.8150', '50.531'),
(533, 'Huyện Xuân Lộc', 48, '1', '1', '1', '1', '1', '4807', 'DNI.8139', '50.535'),
(527, 'Thành phố Biên Hòa', 48, '1', '1', '1', '1', '1', '4801', 'DNI.8110', '50.533'),
(532, 'Thị xã Long Khánh', 48, '1', '1', '1', '1', '1', '4806', 'DNI.8132', '50.528'),
(577, 'Huyện Cao Lãnh', 56, '1', '1', '1', '1', '1', '5007', 'DTP.8740', '57.614'),
(580, 'Huyện Châu Thành', 56, '1', '1', '1', '1', '1', '5011', 'DTP.8738', '57.612'),
(573, 'Huyện Hồng Ngự', 56, '1', '1', '1', '1', '1', '5004', 'DTP.8721', '57.613'),
(579, 'Huyện Lai Vung', 56, '1', '1', '1', '1', '1', '5010', 'DTP.8728', '57.611'),
(578, 'Huyện Lấp Vò', 56, '1', '1', '1', '1', '1', '5008', 'DTP.8726', '57.607'),
(574, 'Huyện Tam Nông', 56, '1', '1', '1', '1', '1', '5005', 'DTP.8717', '57.608'),
(572, 'Huyện Tân Hồng', 56, '1', '1', '1', '1', '1', '5003', 'DTP.8719', '57.605'),
(575, 'Huyện Thanh Bình', 56, '1', '1', '1', '1', '1', '5006', 'DTP.8724', '57.606'),
(576, 'Huyện Tháp Mười', 56, '1', '1', '1', '1', '1', '5009', 'DTP.8714', '57.610'),
(570, 'Thành phố Cao Lãnh', 56, '1', '1', '1', '1', '1', '5001', 'DTP.8710', '57.609'),
(571, 'Thành phố Sa Đéc', 56, '1', '1', '1', '1', '1', '5002', 'DTP.8731', '57.615'),
(808, 'Thị xã Hồng Ngự', 56, '1', '1', '1', '1', '0', '5012', 'DTP.8721', '');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `FileId` int(11) NOT NULL,
  `FileName` varchar(250) NOT NULL,
  `FileUrl` varchar(250) NOT NULL,
  `FileTypeId` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`FileId`, `FileName`, `FileUrl`, `FileTypeId`) VALUES
(1, 'Testy product 1', '/anh-1-597c9b2f3ecfb.png', 1),
(2, 'Testy product 1', '/anh-2-597c9b2f46ed3.png', 1),
(3, 'Testy product 1', '/anh-3-597c9b2f4ce59.png', 1),
(4, 'Testy product 1', '/anh-4-597c9b2f52f30.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `filters`
--

CREATE TABLE `filters` (
  `FilterId` int(11) NOT NULL,
  `ItemTypeId` tinyint(4) NOT NULL,
  `FilterName` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `FilterSql` varchar(650) COLLATE utf8_unicode_ci NOT NULL,
  `FilterData` text COLLATE utf8_unicode_ci NOT NULL COMMENT '// lưu json của filter',
  `TagFilter` text COLLATE utf8_unicode_ci NOT NULL COMMENT '// tên của tag filter',
  `StatusId` tinyint(4) NOT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `filters`
--

INSERT INTO `filters` (`FilterId`, `ItemTypeId`, `FilterName`, `FilterSql`, `FilterData`, `TagFilter`, `StatusId`, `CrUserId`, `CrDateTime`) VALUES
(4, 5, 'Trịnh Thành', 'StatusId > 0', '[{"field_name":"group_money","conds":["=","100000"]},{"field_name":"group_money","conds":["<>","100000"],"tag":"Số tiền đã mua  khác 100000"}]', '["Số tiền đã mua  bằng 100000","Số tiền đã mua  khác 100000"]', 2, 3, '2017-09-10 01:27:25');

-- --------------------------------------------------------

--
-- Table structure for table `groupactions`
--

CREATE TABLE `groupactions` (
  `GroupActionId` int(11) NOT NULL,
  `GroupId` smallint(6) NOT NULL,
  `Actionid` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groupactions`
--

INSERT INTO `groupactions` (`GroupActionId`, `GroupId`, `Actionid`) VALUES
(87, 2, 1),
(88, 2, 2),
(89, 2, 3),
(90, 2, 4),
(91, 2, 7),
(92, 2, 8),
(93, 2, 5),
(94, 2, 9),
(95, 2, 10),
(96, 2, 6),
(102, 1, 3),
(103, 1, 8),
(104, 1, 5),
(105, 1, 9),
(106, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `GroupId` smallint(6) NOT NULL,
  `GroupName` varchar(250) NOT NULL,
  `StatusId` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`GroupId`, `GroupName`, `StatusId`) VALUES
(1, 'Nhóm 1', 2),
(2, 'Nhóm 2', 2),
(3, 'Nhóm 3', 2),
(4, 'Nhóm 4', 2),
(5, 'Nhóm 5', 2),
(6, 'Nhóm 6', 2);

-- --------------------------------------------------------

--
-- Table structure for table `importproducts`
--

CREATE TABLE `importproducts` (
  `ImportProductId` int(11) NOT NULL,
  `ImportId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `ProductChildId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `importproducts`
--

INSERT INTO `importproducts` (`ImportProductId`, `ImportId`, `ProductId`, `ProductChildId`, `Quantity`) VALUES
(10, 2, 9, 0, 1),
(11, 2, 9, 25, 1),
(12, 2, 9, 26, 1),
(13, 2, 9, 27, 1),
(14, 2, 9, 28, 1),
(15, 2, 9, 29, 1),
(16, 2, 9, 30, 1),
(17, 2, 9, 31, 1),
(18, 2, 9, 32, 1);

-- --------------------------------------------------------

--
-- Table structure for table `imports`
--

CREATE TABLE `imports` (
  `ImportId` int(11) NOT NULL,
  `ImportCode` varchar(45) NOT NULL,
  `StatusId` tinyint(4) NOT NULL,
  `SupplierId` smallint(6) NOT NULL,
  `DeliverName` varchar(250) NOT NULL,
  `DeliverPhone` varchar(45) NOT NULL,
  `StoreId` smallint(6) NOT NULL,
  `Comment` varchar(650) DEFAULT NULL,
  `FileExcel` varchar(250) DEFAULT NULL,
  `ScanBarCodeId` int(11) DEFAULT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL,
  `UpdateUserId` int(11) DEFAULT NULL,
  `UpdateDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imports`
--

INSERT INTO `imports` (`ImportId`, `ImportCode`, `StatusId`, `SupplierId`, `DeliverName`, `DeliverPhone`, `StoreId`, `Comment`, `FileExcel`, `ScanBarCodeId`, `CrUserId`, `CrDateTime`, `UpdateUserId`, `UpdateDateTime`) VALUES
(2, 'NK-10002', 1, 1, 'Le Hoan', '1232344', 1, 'ghi chu', '', 0, 3, '2017-08-31 17:56:03', 3, '2017-08-31 18:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `InventoryId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `ProductChildId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `InventoryTypeId` tinyint(4) NOT NULL,
  `StoreId` smallint(6) NOT NULL,
  `StatusId` tinyint(4) NOT NULL,
  `Comment` varchar(650) NOT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL,
  `UpdateUserId` int(11) DEFAULT NULL,
  `UpdateDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`InventoryId`, `ProductId`, `ProductChildId`, `Quantity`, `InventoryTypeId`, `StoreId`, `StatusId`, `Comment`, `CrUserId`, `CrDateTime`, `UpdateUserId`, `UpdateDateTime`) VALUES
(1, 1, 0, 10, 1, 1, 3, '', 3, '2017-10-08 12:30:22', 3, '2017-10-08 15:49:36'),
(2, 1, 0, 1000, 2, 1, 2, 'SET 1000', 3, '2017-10-08 12:31:42', 3, '2017-10-08 16:58:54'),
(3, 9, 25, 10, 1, 1, 3, '', 3, '2017-10-08 14:24:37', 3, '2017-10-08 16:59:42'),
(4, 9, 25, 10, 1, 1, 2, '', 3, '2017-10-08 16:49:16', 3, '2017-10-08 16:52:18'),
(5, 9, 26, 5, 1, 2, 3, 'Cong 5', 3, '2017-10-08 16:50:50', 3, '2017-10-08 16:59:43'),
(6, 9, 27, -3, 1, 1, 2, 'Tru 3', 3, '2017-10-08 16:51:07', 3, '2017-10-08 16:57:12'),
(7, 1, 0, 100, 2, 1, 2, '', 3, '2017-10-08 16:55:27', 3, '2017-10-08 16:55:49'),
(8, 9, 27, 5, 1, 1, 2, 'Cong 5 = 2', 3, '2017-10-08 17:00:39', 3, '2017-10-08 17:02:03'),
(9, 2, 0, 25000, 2, 1, 2, 'set 25000', 3, '2017-10-08 17:01:27', 3, '2017-10-08 17:02:56'),
(10, 9, 32, 10000, 2, 1, 1, 'Set 10000', 3, '2017-10-08 17:01:51', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `itemfiles`
--

CREATE TABLE `itemfiles` (
  `ItemFileId` int(11) NOT NULL,
  `ItemId` int(11) NOT NULL,
  `ItemTypeId` tinyint(4) NOT NULL,
  `FileId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `itemfiles`
--

INSERT INTO `itemfiles` (`ItemFileId`, `ItemId`, `ItemTypeId`, `FileId`) VALUES
(1, 3, 3, 1),
(2, 3, 3, 2),
(3, 3, 3, 3),
(4, 3, 3, 4),
(5, 4, 3, 1),
(6, 4, 3, 2),
(7, 4, 3, 3),
(8, 4, 3, 4),
(11, 5, 3, 1),
(12, 5, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `itemmetadatas`
--

CREATE TABLE `itemmetadatas` (
  `ItemMetadataId` int(11) NOT NULL,
  `ItemId` int(11) NOT NULL,
  `ItemTypeId` tinyint(4) NOT NULL,
  `TitleSEO` varchar(250) NOT NULL,
  `MetaDesc` varchar(250) NOT NULL,
  `Canonical` varchar(250) NOT NULL,
  `IsRobotIndex` tinyint(4) NOT NULL,
  `IsRobotFollow` tinyint(4) NOT NULL,
  `IsOnSitemap` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `itemmetadatas`
--

INSERT INTO `itemmetadatas` (`ItemMetadataId`, `ItemId`, `ItemTypeId`, `TitleSEO`, `MetaDesc`, `Canonical`, `IsRobotIndex`, `IsRobotFollow`, `IsOnSitemap`) VALUES
(1, 3, 3, 'Testy product 1', '', 'testy-product-1', 0, 0, 0),
(2, 4, 3, 'Testy product 1', 'Testy product 1', 'testy-product-1', 1, 1, 1),
(3, 5, 3, 'Testy product 1', 'Mo ta mncnmcn', 'testy-product-1', 1, 1, 1),
(6, 8, 3, 'Tesst 01', '', 'tesst-01', 1, 1, 1),
(7, 9, 3, 'Tesst 01', '', 'tesst-01', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `itemtags`
--

CREATE TABLE `itemtags` (
  `ItemTagId` int(11) NOT NULL,
  `ItemId` int(11) NOT NULL,
  `ItemTypeId` tinyint(4) NOT NULL,
  `TagId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `itemtags`
--

INSERT INTO `itemtags` (`ItemTagId`, `ItemId`, `ItemTypeId`, `TagId`) VALUES
(1, 3, 3, 1),
(2, 3, 3, 2),
(3, 4, 3, 1),
(4, 4, 3, 2),
(7, 5, 3, 1),
(8, 5, 3, 2),
(13, 8, 3, 1),
(16, 9, 3, 1),
(18, 1, 5, 4),
(19, 1, 5, 5),
(20, 1, 5, 6),
(24, 1, 7, 7),
(25, 1, 7, 8),
(27, 3, 7, 7),
(28, 5, 6, 1),
(29, 5, 6, 2),
(32, 2, 8, 9),
(33, 2, 8, 10),
(34, 2, 5, 5),
(35, 2, 5, 6),
(36, 3, 9, 11),
(37, 3, 9, 12),
(38, 6, 6, 13),
(39, 6, 6, 14),
(42, 4, 9, 11),
(43, 4, 9, 15),
(45, 2, 14, 16),
(48, 1, 14, 16),
(49, 1, 14, 17),
(52, 2, 10, 18),
(53, 1, 4, 19);

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `LoginId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `IpAddress` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `UserAgent` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `LoginDateTime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`LoginId`, `UserId`, `IpAddress`, `UserAgent`, `LoginDateTime`) VALUES
(1, 3, '113.190.232.77', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-22 20:44:15'),
(2, 3, '113.190.232.77', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-22 20:50:37'),
(3, 3, '113.190.232.77', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-22 20:54:12'),
(4, 3, '113.190.232.77', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-22 20:57:20'),
(5, 3, '113.190.232.77', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-22 20:58:17'),
(6, 3, '222.252.207.253', 'Dalvik/1.6.0 (Linux; U; Android 4.4.2; ASUS_T00Q Build/KVT49L)', '2017-07-22 20:59:06'),
(7, 3, '113.190.232.77', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-22 21:15:54'),
(8, 3, '113.190.232.77', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-22 21:18:44'),
(9, 3, '113.190.232.77', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-22 21:25:12'),
(10, 3, '113.190.232.77', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-22 21:31:20'),
(11, 3, '113.190.232.77', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-22 21:35:29'),
(12, 3, '113.190.232.77', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-22 21:36:10'),
(13, 3, '113.190.232.77', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-22 21:37:40'),
(14, 3, '113.190.232.77', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-22 21:38:52'),
(15, 3, '113.190.232.77', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-22 21:44:36'),
(16, 3, '171.229.246.223', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-22 21:48:22'),
(17, 3, '113.190.232.77', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-22 21:53:00'),
(18, 3, '113.190.232.77', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-22 21:55:46'),
(19, 3, '113.190.232.77', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-22 22:11:59'),
(20, 3, '113.190.232.77', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-22 22:14:00'),
(21, 3, '113.190.232.77', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-22 22:17:11'),
(22, 1, '27.76.133.187', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-22 22:41:34'),
(23, 1, '42.119.163.242', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-22 22:43:31'),
(24, 3, '118.69.162.117', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-22 23:18:47'),
(25, 3, '118.69.162.117', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-22 23:28:50'),
(26, 3, '42.112.152.45', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-23 10:30:15'),
(27, 1, '27.76.133.187', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-23 12:05:31'),
(28, 2, '118.69.162.117', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-23 15:00:10'),
(29, 3, '118.69.162.117', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/603.3.8 (KHTML, like Gecko) Version/10.1.2 Safari/603.3.8', '2017-07-23 21:11:11'),
(30, 2, '118.69.162.117', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/603.3.8 (KHTML, like Gecko) Version/10.1.2 Safari/603.3.8', '2017-07-23 21:16:46'),
(31, 3, '118.107.71.16', 'Dalvik/1.6.0 (Linux; U; Android 4.4.2; ASUS_T00Q Build/KVT49L)', '2017-07-24 09:24:02'),
(32, 3, '118.107.71.16', 'Dalvik/1.6.0 (Linux; U; Android 4.4.2; ASUS_T00Q Build/KVT49L)', '2017-07-24 10:08:35'),
(33, 3, '118.107.71.16', 'Dalvik/1.6.0 (Linux; U; Android 4.4.2; ASUS_T00Q Build/KVT49L)', '2017-07-24 10:08:53'),
(34, 3, '118.107.71.16', 'Dalvik/1.6.0 (Linux; U; Android 4.4.2; ASUS_T00Q Build/KVT49L)', '2017-07-24 10:32:21'),
(35, 2, '118.107.71.16', 'Dalvik/1.6.0 (Linux; U; Android 4.4.2; ASUS_T00Q Build/KVT49L)', '2017-07-24 10:33:02'),
(36, 2, '118.107.71.16', 'Dalvik/1.6.0 (Linux; U; Android 4.4.2; ASUS_T00Q Build/KVT49L)', '2017-07-24 10:40:15'),
(37, 3, '118.107.71.16', 'Dalvik/1.6.0 (Linux; U; Android 4.4.2; ASUS_T00Q Build/KVT49L)', '2017-07-24 11:23:13'),
(38, 3, '118.107.71.16', 'Dalvik/1.6.0 (Linux; U; Android 4.4.2; ASUS_T00Q Build/KVT49L)', '2017-07-24 11:24:36'),
(39, 3, '27.76.133.187', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-24 13:56:44'),
(40, 3, '118.107.71.16', 'Dalvik/1.6.0 (Linux; U; Android 4.4.2; ASUS_T00Q Build/KVT49L)', '2017-07-24 16:20:15'),
(41, 3, '118.107.71.16', 'Dalvik/1.6.0 (Linux; U; Android 4.4.2; ASUS_T00Q Build/KVT49L)', '2017-07-24 16:20:16'),
(42, 3, '118.107.71.16', 'Dalvik/1.6.0 (Linux; U; Android 4.4.2; ASUS_T00Q Build/KVT49L)', '2017-07-24 16:20:16'),
(43, 3, '103.199.76.4', 'Dalvik/2.1.0 (Linux; U; Android 7.0; Mi-4c MIUI/V8.2.3.0.NXKCNEC)', '2017-07-24 16:45:30'),
(44, 3, '118.107.71.16', 'Dalvik/1.6.0 (Linux; U; Android 4.4.2; ASUS_T00Q Build/KVT49L)', '2017-07-24 17:24:43'),
(45, 3, '118.69.162.117', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-24 20:56:23'),
(46, 3, '118.69.162.117', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-24 21:23:31'),
(47, 3, '118.69.162.117', 'rickyQRCode/1.0 (com.vn.gary.rickyQRCode; build:1; iOS 10.3.1) Alamofire/1.0', '2017-07-24 21:27:33'),
(48, 3, '171.229.246.223', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-24 22:31:14'),
(49, 3, '27.76.133.187', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-24 22:57:35'),
(50, 3, '27.76.133.187', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-25 09:08:42'),
(51, 3, '103.199.76.4', 'Dalvik/2.1.0 (Linux; U; Android 7.0; Mi-4c MIUI/V8.2.3.0.NXKCNEC)', '2017-07-25 09:40:06'),
(52, 3, '103.199.76.4', 'Dalvik/2.1.0 (Linux; U; Android 7.0; Mi-4c MIUI/V8.2.3.0.NXKCNEC)', '2017-07-25 09:40:07'),
(53, 3, '42.119.163.242', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-25 10:05:47'),
(54, 3, '171.229.246.223', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-25 10:28:50'),
(55, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-25 14:25:10'),
(56, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-25 22:14:14'),
(57, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-26 20:35:11'),
(58, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-27 08:30:56'),
(59, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-27 21:35:00'),
(60, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-28 17:11:12'),
(61, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '2017-07-29 12:45:51'),
(62, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/64.4.146 Chrome/58.4.3029.146 Safari/537.36', '2017-07-29 20:08:26'),
(63, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36', '2017-07-29 22:01:32'),
(64, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36', '2017-07-30 09:31:32'),
(65, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36', '2017-07-31 21:22:42'),
(66, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36', '2017-08-02 14:58:06'),
(67, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', '2017-08-02 23:02:11'),
(68, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36', '2017-08-02 23:06:38'),
(69, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '2017-08-06 08:29:36'),
(70, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '2017-08-07 15:53:20'),
(71, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '2017-08-08 07:43:51'),
(72, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '2017-08-08 21:03:35'),
(73, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '2017-08-08 21:28:13'),
(74, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '2017-08-09 19:19:52'),
(75, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', '2017-08-09 21:11:03'),
(76, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '2017-08-11 22:20:12'),
(77, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '2017-08-12 09:00:07'),
(78, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '2017-08-13 09:06:55'),
(79, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '2017-08-16 09:36:41'),
(80, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '2017-08-16 20:35:18'),
(81, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '2017-08-17 21:02:23'),
(82, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', '2017-08-18 20:04:13'),
(83, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', '2017-08-19 21:48:43'),
(84, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', '2017-08-20 10:06:53'),
(85, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', '2017-08-22 12:09:28'),
(86, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', '2017-08-24 16:13:44'),
(87, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', '2017-08-25 17:32:38'),
(88, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', '2017-08-26 09:10:00'),
(89, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', '2017-08-26 14:47:40'),
(90, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', '2017-08-27 14:28:10'),
(91, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', '2017-08-29 20:27:09'),
(92, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', '2017-08-30 22:59:52'),
(93, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', '2017-08-31 08:31:47'),
(94, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', '2017-08-31 14:35:01'),
(95, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', '2017-09-02 09:01:25'),
(96, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', '2017-09-03 09:19:22'),
(97, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', '2017-09-04 19:10:31'),
(98, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', '2017-09-09 14:05:13'),
(99, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', '2017-09-10 08:57:24'),
(100, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', '2017-09-10 21:20:36'),
(101, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', '2017-09-18 21:45:48'),
(102, 3, '::1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.91 Safari/537.36', '2017-09-19 21:56:53');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE `manufacturers` (
  `ManufacturerId` smallint(6) NOT NULL,
  `ManufacturerName` varchar(250) NOT NULL,
  `StatusId` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `moneyphones`
--

CREATE TABLE `moneyphones` (
  `MoneyPhoneId` smallint(6) NOT NULL,
  `MoneyPhoneName` varchar(250) NOT NULL,
  `StatusId` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `moneyphones`
--

INSERT INTO `moneyphones` (`MoneyPhoneId`, `MoneyPhoneName`, `StatusId`) VALUES
(1, '0123456789 - Máy test', 2);

-- --------------------------------------------------------

--
-- Table structure for table `moneysources`
--

CREATE TABLE `moneysources` (
  `MoneySourceId` smallint(6) NOT NULL,
  `MoneySourceName` varchar(250) NOT NULL,
  `StatusId` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `moneysources`
--

INSERT INTO `moneysources` (`MoneySourceId`, `MoneySourceName`, `StatusId`) VALUES
(1, 'Tiền mặt', 2),
(2, 'Thẻ điện thoại', 2),
(3, 'VCB Hà Nội', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orderproducts`
--

CREATE TABLE `orderproducts` (
  `OrderProductId` int(11) NOT NULL,
  `OrderId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `ProductChildId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `OriginalPrice` int(11) NOT NULL,
  `DiscountReason` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderproducts`
--

INSERT INTO `orderproducts` (`OrderProductId`, `OrderId`, `ProductId`, `ProductChildId`, `Quantity`, `Price`, `OriginalPrice`, `DiscountReason`) VALUES
(1, 1, 1, 0, 2, 10, 0, NULL),
(2, 1, 2, 0, 3, 28, 0, NULL),
(12, 5, 9, 0, 1, 10000, 0, ''),
(13, 5, 9, 25, 1, 1, 0, ''),
(14, 5, 9, 26, 1, 2, 0, ''),
(15, 5, 9, 27, 1, 3, 0, ''),
(16, 5, 9, 28, 1, 4, 0, ''),
(17, 5, 9, 29, 1, 5, 0, ''),
(18, 5, 9, 30, 1, 6, 0, ''),
(19, 5, 9, 31, 1, 7, 0, ''),
(20, 5, 9, 32, 1, 8, 0, ''),
(21, 6, 9, 25, 1, 1, 0, ''),
(22, 6, 9, 26, 1, 2, 0, ''),
(23, 6, 9, 27, 1, 3, 0, ''),
(24, 6, 9, 28, 1, 4, 0, ''),
(25, 6, 9, 29, 1, 5, 0, ''),
(26, 6, 9, 30, 1, 6, 0, ''),
(27, 6, 9, 31, 1, 7, 0, ''),
(28, 6, 9, 32, 1, 8, 0, ''),
(29, 7, 9, 25, 1, 1, 0, ''),
(30, 7, 9, 26, 1, 2, 0, ''),
(31, 7, 9, 27, 1, 3, 0, ''),
(32, 7, 9, 28, 2, 4, 0, ''),
(33, 7, 9, 29, 2, 5, 0, ''),
(34, 7, 9, 30, 1, 6, 0, ''),
(35, 7, 9, 31, 1, 7, 0, ''),
(36, 7, 9, 32, 1, 8, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `orderreasons`
--

CREATE TABLE `orderreasons` (
  `OrderReasonId` smallint(6) NOT NULL,
  `OrderReasonName` varchar(250) NOT NULL,
  `StatusId` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderreasons`
--

INSERT INTO `orderreasons` (`OrderReasonId`, `OrderReasonName`, `StatusId`) VALUES
(1, 'aaaaaa', 2),
(2, 'bbbbbbbbb223', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderId` int(11) NOT NULL,
  `OrderCode` varchar(15) NOT NULL,
  `BarCode` varchar(15) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `CustomerAddressId` int(11) NOT NULL,
  `StaffId` int(11) NOT NULL,
  `OrderChanelId` tinyint(4) NOT NULL,
  `OrderStatusId` tinyint(4) NOT NULL,
  `Comment` varchar(650) DEFAULT NULL,
  `TransportCost` int(11) NOT NULL,
  `IsLendBack` tinyint(4) NOT NULL,
  `LendBackCost` int(11) NOT NULL,
  `Discount` int(11) NOT NULL,
  `PreCost` int(11) NOT NULL,
  `VATPercent` tinyint(4) NOT NULL,
  `PaymentStatusId` tinyint(4) NOT NULL,
  `VerifyStatusId` tinyint(4) NOT NULL,
  `OrderTypeId` smallint(6) NOT NULL,
  `DeliveryTypeId` smallint(6) NOT NULL,
  `OrderReasonId` smallint(6) NOT NULL,
  `CODCost` int(11) NOT NULL,
  `CODStatusId` tinyint(4) NOT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL,
  `UpdateUserId` int(11) DEFAULT NULL,
  `UpdateDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderId`, `OrderCode`, `BarCode`, `CustomerId`, `CustomerAddressId`, `StaffId`, `OrderChanelId`, `OrderStatusId`, `Comment`, `TransportCost`, `IsLendBack`, `LendBackCost`, `Discount`, `PreCost`, `VATPercent`, `PaymentStatusId`, `VerifyStatusId`, `OrderTypeId`, `DeliveryTypeId`, `OrderReasonId`, `CODCost`, `CODStatusId`, `CrUserId`, `CrDateTime`, `UpdateUserId`, `UpdateDateTime`) VALUES
(1, 'RB-0001', '123456', 1, 0, 1, 1, 1, 'abc', 0, 0, 0, 0, 0, 0, 1, 2, 1, 1, 1, 0, 1, 1, '2017-11-25 00:00:00', NULL, NULL),
(5, ' RB-002', '1234567', 2, 6, 0, 1, 3, 'ghi chú', 0, 0, 0, 0, 0, 0, 1, 2, 1, 1, 1, 0, 1, 3, '2017-08-29 20:34:58', NULL, NULL),
(6, 'DH-10006', '', 2, 6, 0, 1, 3, 'ghi chú đơn hàng', 2, 2, 4, 1, 7, 10, 1, 2, 1, 1, 1, 40, 1, 3, '2017-09-10 16:47:31', NULL, NULL),
(7, 'DH-10007', '', 2, 6, 0, 1, 3, '', 15, 2, 0, 5, 0, 10, 1, 1, 1, 2, 1, 83, 1, 3, '2017-10-08 09:18:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orderservices`
--

CREATE TABLE `orderservices` (
  `OrderServiceId` int(11) NOT NULL,
  `OrderId` int(11) NOT NULL,
  `OtherServiceId` int(11) NOT NULL,
  `ServiceCost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderservices`
--

INSERT INTO `orderservices` (`OrderServiceId`, `OrderId`, `OtherServiceId`, `ServiceCost`) VALUES
(1, 6, 1, 5),
(2, 6, 2, 5),
(3, 7, 1, 5),
(4, 7, 2, 15);

-- --------------------------------------------------------

--
-- Table structure for table `ordertypes`
--

CREATE TABLE `ordertypes` (
  `OrderTypeId` smallint(6) NOT NULL,
  `OrderTypeName` varchar(250) NOT NULL,
  `StatusId` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ordertypes`
--

INSERT INTO `ordertypes` (`OrderTypeId`, `OrderTypeName`, `StatusId`) VALUES
(1, 'AC', 2),
(2, 'DB1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `otherservices`
--

CREATE TABLE `otherservices` (
  `OtherServiceId` smallint(6) NOT NULL,
  `OtherServiceName` varchar(250) NOT NULL,
  `StatusId` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `otherservices`
--

INSERT INTO `otherservices` (`OtherServiceId`, `OtherServiceName`, `StatusId`) VALUES
(1, 'Cài đặt tại nhà', 2),
(2, 'Lắp đặt tại nhà', 2);

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `PartId` smallint(6) NOT NULL,
  `PartName` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `StatusId` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`PartId`, `PartName`, `StatusId`) VALUES
(1, 'BPKT', 2),
(2, 'BP TƯ VẤN', 2);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `PositionId` smallint(6) NOT NULL,
  `PositionName` varchar(250) NOT NULL,
  `StatusId` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `productchilds`
--

CREATE TABLE `productchilds` (
  `ProductChildId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `VariantId1` smallint(6) NOT NULL,
  `VariantValue1` varchar(250) NOT NULL,
  `VariantId2` smallint(6) NOT NULL,
  `VariantValue2` varchar(250) NOT NULL,
  `VariantId3` smallint(6) NOT NULL,
  `VariantValue3` varchar(250) NOT NULL,
  `ProductName` varchar(250) NOT NULL,
  `ProductImage` varchar(250) NOT NULL,
  `BarCode` varchar(15) NOT NULL,
  `Sku` varchar(15) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `OldPrice` int(11) NOT NULL,
  `Weight` int(11) NOT NULL,
  `ProductPartId` int(11) NOT NULL COMMENT 'dung cho Combo',
  `VATStatusId` tinyint(4) NOT NULL,
  `GuaranteeMonth` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productchilds`
--

INSERT INTO `productchilds` (`ProductChildId`, `ProductId`, `VariantId1`, `VariantValue1`, `VariantId2`, `VariantValue2`, `VariantId3`, `VariantValue3`, `ProductName`, `ProductImage`, `BarCode`, `Sku`, `Quantity`, `Price`, `OldPrice`, `Weight`, `ProductPartId`, `VATStatusId`, `GuaranteeMonth`) VALUES
(25, 9, 2, 'L', 1, 'xanh', 3, 'gỗ', 'L - xanh - gỗ', 'assets/vendor/dist/img/logo.png', '1', '1', 10, 1, 1, 1, 0, 0, 0),
(26, 9, 2, 'L', 1, 'xanh', 3, 'sắt', 'L - xanh - sắt', 'assets/vendor/dist/img/logo.png', '2', '2', 2, 2, 2, 2, 0, 0, 0),
(27, 9, 2, 'L', 1, 'đỏ', 3, 'gỗ', 'L - đỏ - gỗ', 'assets/vendor/dist/img/logo.png', '3', '3', 2, 3, 3, 3, 0, 0, 0),
(28, 9, 2, 'L', 1, 'đỏ', 3, 'sắt', 'L - đỏ - sắt', 'assets/vendor/dist/img/logo.png', '4', '4', 4, 4, 4, 4, 0, 0, 0),
(29, 9, 2, 'XL', 1, 'xanh', 3, 'gỗ', 'XL - xanh - gỗ', 'assets/vendor/dist/img/logo.png', '5', '5', 5, 5, 5, 5, 0, 0, 0),
(30, 9, 2, 'XL', 1, 'xanh', 3, 'sắt', 'XL - xanh - sắt', 'assets/vendor/dist/img/logo.png', '6', '6', 6, 6, 6, 6, 0, 0, 0),
(31, 9, 2, 'XL', 1, 'đỏ', 3, 'gỗ', 'XL - đỏ - gỗ', 'assets/vendor/dist/img/logo.png', '7', '7', 7, 7, 7, 7, 0, 0, 0),
(32, 9, 2, 'XL', 1, 'đỏ', 3, 'sắt', 'XL - đỏ - sắt', 'assets/vendor/dist/img/logo.png', '8', '8', 8, 8, 8, 80, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `productquantity`
--

CREATE TABLE `productquantity` (
  `ProductQuantityId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `ProductChildId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `StoreId` smallint(6) NOT NULL,
  `IsLast` tinyint(4) NOT NULL,
  `Comment` varchar(650) NOT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL,
  `UpdateUserId` int(11) DEFAULT NULL,
  `UpdateDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productquantity`
--

INSERT INTO `productquantity` (`ProductQuantityId`, `ProductId`, `ProductChildId`, `Quantity`, `StoreId`, `IsLast`, `Comment`, `CrUserId`, `CrDateTime`, `UpdateUserId`, `UpdateDateTime`) VALUES
(1, 9, 25, 10, 1, 1, '', 3, '2017-10-08 16:52:18', NULL, NULL),
(2, 1, 0, 100, 1, 0, '', 3, '2017-10-08 16:55:49', 3, '2017-10-08 16:58:54'),
(3, 9, 27, -3, 1, 0, 'Tru 3', 3, '2017-10-08 16:57:12', 3, '2017-10-08 17:02:03'),
(4, 1, 0, 1000, 1, 1, 'SET 1000', 3, '2017-10-08 16:58:54', NULL, NULL),
(5, 9, 27, 2, 1, 1, 'Cong 5 = 2', 3, '2017-10-08 17:02:03', NULL, NULL),
(6, 2, 0, 25000, 1, 1, 'set 25000', 3, '2017-10-08 17:02:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductId` int(11) NOT NULL,
  `ProductName` varchar(250) NOT NULL,
  `ProductSlug` varchar(250) NOT NULL,
  `ProductDesc` text NOT NULL,
  `ProductTypeId` smallint(6) NOT NULL,
  `ProductStatusId` tinyint(4) NOT NULL,
  `ProductKindId` tinyint(4) NOT NULL,
  `VATStatusId` tinyint(4) NOT NULL,
  `ProductDisplayTypeId` tinyint(4) NOT NULL,
  `ProductLevelId` tinyint(4) NOT NULL,
  `ParentProductId` int(11) DEFAULT NULL,
  `SupplierId` smallint(6) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `IsContactPrice` tinyint(4) NOT NULL,
  `Price` int(11) NOT NULL,
  `OldPrice` int(11) NOT NULL,
  `ProductImage` varchar(250) NOT NULL,
  `ProductCode` varchar(15) NOT NULL,
  `BarCode` varchar(15) NOT NULL,
  `Sku` varchar(15) NOT NULL,
  `Weight` int(11) NOT NULL,
  `PublishDateTime` datetime NOT NULL,
  `IsManageExtraWarehouse` tinyint(4) NOT NULL,
  `FormalStatus` varchar(250) DEFAULT NULL,
  `UsageStatus` varchar(250) DEFAULT NULL,
  `AccessoryStatus` varchar(250) DEFAULT NULL,
  `GuaranteeMonth` tinyint(4) NOT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL,
  `UpdateUserId` int(11) DEFAULT NULL,
  `UpdateDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductId`, `ProductName`, `ProductSlug`, `ProductDesc`, `ProductTypeId`, `ProductStatusId`, `ProductKindId`, `VATStatusId`, `ProductDisplayTypeId`, `ProductLevelId`, `ParentProductId`, `SupplierId`, `Quantity`, `IsContactPrice`, `Price`, `OldPrice`, `ProductImage`, `ProductCode`, `BarCode`, `Sku`, `Weight`, `PublishDateTime`, `IsManageExtraWarehouse`, `FormalStatus`, `UsageStatus`, `AccessoryStatus`, `GuaranteeMonth`, `CrUserId`, `CrDateTime`, `UpdateUserId`, `UpdateDateTime`) VALUES
(1, 'Loa 001', 'loa-001', 'nfdnd', 1, 2, 0, 0, 0, 0, NULL, 1, 1000, 0, 10, 20, 'assets/uploads/images/anh-1-597c9b2f3ecfb.png', '123456', '123', '', 1, '0000-00-00 00:00:00', 0, NULL, NULL, NULL, 0, 1, '2017-07-25 00:00:00', NULL, NULL),
(2, 'Loa 002', 'loa-002', 'nffn', 1, 2, 0, 0, 0, 0, NULL, 1, 25000, 0, 28, 20, 'assets/uploads/images/anh-1-597c9b2f3ecfb.png', '1234567', '1234', '', 1, '0000-00-00 00:00:00', 0, NULL, NULL, NULL, 0, 1, '2017-07-25 00:00:00', NULL, NULL),
(3, 'Testy product 1', 'testy-product-1', '<p>ytyrdn dkjjd djhdj djdj&nbsp;</p>', 1, 2, 1, 2, 1, 2, 0, 1, 10, 0, 10, 5, 'assets/uploads/images/anh-1-597c9b2f3ecfb.png', '123', '123', '123', 1, '2017-07-30 20:30:00', 0, NULL, NULL, NULL, 0, 3, '2017-07-30 20:45:25', NULL, NULL),
(4, 'Testy product 1', 'testy-product-1', '<p>ytyrdn dkjjd djhdj djdj&nbsp;</p>', 1, 2, 1, 2, 1, 2, 0, 1, 10, 0, 10, 5, 'assets/uploads/images/anh-1-597c9b2f3ecfb.png', '123', '123', '123', 1, '2017-07-30 20:30:00', 0, NULL, NULL, NULL, 0, 3, '2017-07-30 20:46:45', NULL, NULL),
(5, 'Testy product 1', 'testy-product-1', '<p>ytyrdn dkjjd djhdj djdj&nbsp;<img alt="" src="/hmd//hmd/anh-3-597c9b2f4ce59.png" style="width: 1280px; height: 1024px;" /></p>', 1, 2, 1, 2, 2, 2, 0, 1, 10, 0, 10, 5, 'assets/uploads/images/anh-1-597c9b2f3ecfb.png', '123', '123', '123', 1, '2017-07-30 22:00:00', 0, NULL, NULL, NULL, 0, 3, '2017-07-30 22:03:52', 3, '2017-07-30 22:27:48'),
(8, 'Tesst 01', 'tesst-01', '<p>aaaaaaaaaaaaa</p>', 1, 2, 2, 1, 1, 2, 0, 1, 10, 0, 0, 0, 'assets/uploads/images/anh-1-597c9b2f3ecfb.png', '', '1', '1', 10, '2017-08-06 09:30:00', 0, NULL, NULL, NULL, 0, 3, '2017-08-06 09:40:50', NULL, NULL),
(9, 'Tesst 01', 'tesst-01', '<p>aaaaaaaaaaaaa</p>', 1, 2, 2, 1, 1, 2, 0, 1, 10, 0, 10000, 0, 'assets/uploads/images/anh-1-597c9b2f3ecfb.png', '', '1', '1', 10, '2017-08-06 09:30:00', 0, NULL, NULL, NULL, 0, 3, '2017-08-06 10:00:07', 3, '2017-08-06 12:37:28');

-- --------------------------------------------------------

--
-- Table structure for table `producttypes`
--

CREATE TABLE `producttypes` (
  `ProductTypeId` smallint(6) NOT NULL,
  `ProductTypeName` varchar(250) NOT NULL,
  `StatusId` tinyint(4) NOT NULL,
  `ActiveDate` datetime NOT NULL,
  `IsShare` tinyint(4) NOT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `producttypes`
--

INSERT INTO `producttypes` (`ProductTypeId`, `ProductTypeName`, `StatusId`, `ActiveDate`, `IsShare`, `CrUserId`, `CrDateTime`) VALUES
(1, 'Thiết bị âm thanh', 2, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(2, 'Quần áo', 2, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `PromotionId` int(11) NOT NULL,
  `PromotionName` varchar(250) NOT NULL,
  `PromotionTypeId` tinyint(4) NOT NULL,
  `PromotionStatusId` tinyint(4) NOT NULL,
  `ReduceTypeId` tinyint(4) NOT NULL,
  `BeginDate` datetime NOT NULL,
  `EndDate` datetime DEFAULT NULL,
  `IsSharePromotion` varchar(45) NOT NULL COMMENT 'su dung chung vs chuong trinh KM',
  `NumberUse` int(11) NOT NULL,
  `ReduceNumber` int(11) NOT NULL COMMENT 'so luong giam (%, vnd)',
  `MinimumCost` int(11) NOT NULL COMMENT 'tri gia don hang tu...,',
  `ProvinceId` tinyint(4) NOT NULL,
  `PromotionItemId` int(11) NOT NULL COMMENT 'doi tuong KM',
  `PromotionItemTypeId` tinyint(4) NOT NULL COMMENT 'loai doi tuong KM',
  `ProductNumber` smallint(6) NOT NULL COMMENT 'so luong sp ap dung',
  `DiscountTypeId` tinyint(4) NOT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL,
  `UpdateUserId` int(11) DEFAULT NULL,
  `UpdateDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`PromotionId`, `PromotionName`, `PromotionTypeId`, `PromotionStatusId`, `ReduceTypeId`, `BeginDate`, `EndDate`, `IsSharePromotion`, `NumberUse`, `ReduceNumber`, `MinimumCost`, `ProvinceId`, `PromotionItemId`, `PromotionItemTypeId`, `ProductNumber`, `DiscountTypeId`, `CrUserId`, `CrDateTime`, `UpdateUserId`, `UpdateDateTime`) VALUES
(1, '4H4DBOFZC2', 1, 3, 1, '2017-09-23 00:00:00', '2017-09-30 00:00:00', '2', 0, 10000, 0, 0, 9, 3, 0, 1, 3, '2017-09-23 19:58:00', NULL, NULL),
(2, '686I4C30HF', 1, 3, 2, '2017-09-23 00:00:00', NULL, '2', 10, 10, 1000000, 0, 0, 6, 0, 1, 3, '2017-09-23 19:58:41', NULL, NULL),
(3, 'Chương trình KM 1', 2, 3, 1, '2017-09-23 00:00:00', NULL, '1', 0, 1000000, 0, 0, 1, 1, 10, 1, 3, '2017-09-23 20:00:12', NULL, NULL),
(4, 'OTX6PQ6F5P', 1, 3, 3, '2017-09-23 00:00:00', NULL, '1', 0, 1000, 0, 40, 0, 0, 0, 1, 3, '2017-09-23 21:27:36', NULL, NULL),
(5, 'DPSIT6MFNT', 1, 3, 2, '2017-09-23 00:00:00', NULL, '1', 0, 15, 0, 0, 25, 13, 0, 2, 3, '2017-09-23 21:33:01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `ProvinceId` tinyint(4) NOT NULL,
  `ProvinceName` varchar(45) NOT NULL,
  `DisplayOrder` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`ProvinceId`, `ProvinceName`, `DisplayOrder`) VALUES
(1, 'Hà Nội', 1),
(2, 'Hà Giang', 1),
(3, 'Cao Bằng', 1),
(4, 'Bắc Kạn', 1),
(5, 'Tuyên Quang', 1),
(6, 'Lào Cai', 1),
(7, 'Điện Biên', 1),
(8, 'Lai Châu', 1),
(9, 'Sơn La', 1),
(10, 'Yên Bái', 1),
(11, 'Hòa Bình', 1),
(12, 'Thái Nguyên', 1),
(13, 'Lạng Sơn', 1),
(14, 'Quảng Ninh', 1),
(15, 'Bắc Giang', 1),
(16, 'Phú Thọ', 1),
(17, 'Vĩnh Phúc', 1),
(18, 'Bắc Ninh', 1),
(19, 'Hải Dương', 1),
(20, 'Hải Phòng', 1),
(21, 'Hưng Yên', 1),
(22, 'Thái Bình', 1),
(23, 'Hà Nam', 1),
(24, 'Nam Định', 1),
(25, 'Ninh Bình', 1),
(26, 'Thanh Hóa', 1),
(27, 'Nghệ An', 1),
(28, 'Hà Tĩnh', 1),
(29, 'Quảng Bình', 1),
(30, 'Quảng Trị', 1),
(31, 'Thừa Thiên Huế', 1),
(32, 'Đà Nẵng', 1),
(33, 'Quảng Nam', 1),
(34, 'Quảng Ngãi', 1),
(35, 'Bình Định', 1),
(36, 'Phú Yên', 1),
(37, 'Khánh Hòa', 1),
(38, 'Ninh Thuận', 1),
(39, 'Bình Thuận', 1),
(40, 'Kon Tum', 1),
(41, 'Gia Lai', 1),
(42, 'Đắk Lắk', 1),
(43, 'Đắk Nông', 1),
(44, 'Lâm Đồng', 1),
(45, 'Bình Phước', 1),
(46, 'Tây Ninh', 1),
(47, 'Bình Dương', 1),
(48, 'Đồng Nai', 1),
(49, 'Bà Rịa - Vũng Tàu', 1),
(50, 'Hồ Chí Minh', 1),
(51, 'Long An', 1),
(52, 'Tiền Giang', 1),
(53, 'Bến Tre', 1),
(54, 'Trà Vinh', 1),
(55, 'Vĩnh Long', 1),
(56, 'Đồng Tháp', 1),
(57, 'An Giang', 1),
(58, 'Kiên Giang', 1),
(59, 'Cần Thơ', 1),
(60, 'Hậu Giang', 1),
(61, 'Sóc Trăng', 1),
(62, 'Bạc Liêu', 1),
(63, 'Cà Mau', 1);

-- --------------------------------------------------------

--
-- Table structure for table `returngoodproducts`
--

CREATE TABLE `returngoodproducts` (
  `ReturnGoodProductId` int(11) NOT NULL,
  `ReturnGoodId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `ProductChildId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `returngoodproducts`
--

INSERT INTO `returngoodproducts` (`ReturnGoodProductId`, `ReturnGoodId`, `ProductId`, `ProductChildId`, `Quantity`) VALUES
(2, 2, 9, 25, 1),
(4, 1, 9, 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `returngoods`
--

CREATE TABLE `returngoods` (
  `ReturnGoodId` int(11) NOT NULL,
  `ReturnGoodCode` varchar(15) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `CustomerAddressId` int(11) NOT NULL,
  `TransportStatusId` tinyint(4) NOT NULL,
  `ReturnGoodTypeId` tinyint(4) NOT NULL,
  `StoreId` smallint(6) NOT NULL,
  `Comment` varchar(650) DEFAULT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL,
  `UpdateUserId` int(11) DEFAULT NULL,
  `UpdateDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `returngoods`
--

INSERT INTO `returngoods` (`ReturnGoodId`, `ReturnGoodCode`, `CustomerId`, `CustomerAddressId`, `TransportStatusId`, `ReturnGoodTypeId`, `StoreId`, `Comment`, `CrUserId`, `CrDateTime`, `UpdateUserId`, `UpdateDateTime`) VALUES
(1, 'HĐH-10001', 2, 6, 1, 1, 1, 'dd', 3, '2017-09-27 23:44:55', 3, '2017-09-29 20:30:45'),
(2, 'HĐH-10002', 2, 6, 1, 1, 1, 'dd', 3, '2017-09-29 15:31:54', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roleactions`
--

CREATE TABLE `roleactions` (
  `RoleActionId` int(11) NOT NULL,
  `RoleId` tinyint(4) NOT NULL,
  `ActionId` smallint(6) NOT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roleactions`
--

INSERT INTO `roleactions` (`RoleActionId`, `RoleId`, `ActionId`, `CrUserId`, `CrDateTime`) VALUES
(1, 3, 7, 2, '2017-07-18 15:23:50'),
(2, 3, 8, 2, '2017-07-18 15:23:50'),
(3, 3, 13, 2, '2017-07-18 15:23:50'),
(4, 3, 23, 2, '2017-07-18 15:23:50'),
(5, 3, 9, 2, '2017-07-18 15:23:50'),
(6, 3, 33, 2, '2017-07-18 15:23:50'),
(7, 3, 37, 2, '2017-07-18 15:23:50'),
(8, 3, 14, 2, '2017-07-18 15:23:50'),
(9, 3, 77, 2, '2017-07-18 15:23:50'),
(10, 3, 10, 2, '2017-07-18 15:23:50'),
(11, 3, 11, 2, '2017-07-18 15:23:50'),
(12, 3, 15, 2, '2017-07-18 15:23:50'),
(13, 3, 17, 2, '2017-07-18 15:23:50'),
(14, 3, 24, 2, '2017-07-18 15:23:50'),
(15, 3, 12, 2, '2017-07-18 15:23:50'),
(16, 3, 109, 2, '2017-07-18 15:23:50'),
(17, 3, 16, 2, '2017-07-18 15:23:50'),
(18, 3, 22, 2, '2017-07-18 15:23:50'),
(19, 3, 28, 2, '2017-07-18 15:23:50'),
(20, 3, 25, 2, '2017-07-18 15:23:50'),
(21, 3, 29, 2, '2017-07-18 15:23:50'),
(22, 3, 89, 2, '2017-07-18 15:23:50'),
(23, 3, 100, 2, '2017-07-18 15:23:50'),
(24, 3, 101, 2, '2017-07-18 15:23:50'),
(25, 3, 102, 2, '2017-07-18 15:23:50'),
(26, 3, 106, 2, '2017-07-18 15:23:50'),
(27, 3, 54, 2, '2017-07-18 15:23:50'),
(28, 3, 55, 2, '2017-07-18 15:23:50'),
(29, 3, 58, 2, '2017-07-18 15:23:50'),
(30, 3, 56, 2, '2017-07-18 15:23:50'),
(31, 3, 59, 2, '2017-07-18 15:23:50'),
(32, 3, 61, 2, '2017-07-18 15:23:50'),
(33, 3, 63, 2, '2017-07-18 15:23:50'),
(34, 3, 57, 2, '2017-07-18 15:23:50'),
(35, 3, 60, 2, '2017-07-18 15:23:50'),
(36, 3, 62, 2, '2017-07-18 15:23:50'),
(37, 3, 64, 2, '2017-07-18 15:23:50'),
(38, 3, 82, 2, '2017-07-18 15:23:50'),
(39, 3, 81, 2, '2017-07-18 15:23:50'),
(40, 3, 97, 2, '2017-07-18 15:23:50'),
(41, 3, 78, 2, '2017-07-18 15:23:50'),
(42, 3, 107, 2, '2017-07-18 15:23:50'),
(43, 3, 108, 2, '2017-07-18 15:23:50'),
(44, 3, 50, 2, '2017-07-18 15:23:50'),
(45, 3, 1, 2, '2017-07-18 15:23:50'),
(46, 3, 44, 2, '2017-07-18 15:23:50'),
(47, 3, 45, 2, '2017-07-18 15:23:50'),
(48, 3, 46, 2, '2017-07-18 15:23:50'),
(49, 3, 83, 2, '2017-07-18 15:23:50'),
(50, 3, 84, 2, '2017-07-18 15:23:50'),
(51, 3, 85, 2, '2017-07-18 15:23:50'),
(52, 3, 47, 2, '2017-07-18 15:23:50'),
(53, 3, 48, 2, '2017-07-18 15:23:50'),
(54, 3, 49, 2, '2017-07-18 15:23:50'),
(55, 3, 51, 2, '2017-07-18 15:23:50'),
(56, 3, 52, 2, '2017-07-18 15:23:50'),
(57, 3, 103, 2, '2017-07-18 15:23:50'),
(58, 3, 104, 2, '2017-07-18 15:23:50'),
(59, 3, 105, 2, '2017-07-18 15:23:50'),
(60, 3, 86, 2, '2017-07-18 15:23:50'),
(61, 3, 87, 2, '2017-07-18 15:23:50'),
(62, 3, 88, 2, '2017-07-18 15:23:50'),
(63, 3, 90, 2, '2017-07-18 15:23:50'),
(64, 3, 91, 2, '2017-07-18 15:23:50'),
(65, 3, 92, 2, '2017-07-18 15:23:50'),
(66, 3, 93, 2, '2017-07-18 15:23:50'),
(67, 3, 94, 2, '2017-07-18 15:23:50'),
(68, 3, 95, 2, '2017-07-18 15:23:50'),
(69, 3, 80, 2, '2017-07-18 15:23:50'),
(70, 3, 18, 2, '2017-07-18 15:23:50'),
(71, 3, 26, 2, '2017-07-18 15:23:50'),
(72, 3, 27, 2, '2017-07-18 15:23:50'),
(73, 3, 4, 2, '2017-07-18 15:23:50'),
(74, 3, 5, 2, '2017-07-18 15:23:50'),
(75, 3, 6, 2, '2017-07-18 15:23:50'),
(76, 3, 65, 2, '2017-07-18 15:23:50'),
(77, 3, 66, 2, '2017-07-18 15:23:50'),
(78, 3, 67, 2, '2017-07-18 15:23:50'),
(79, 3, 68, 2, '2017-07-18 15:23:50'),
(80, 3, 69, 2, '2017-07-18 15:23:50'),
(81, 3, 70, 2, '2017-07-18 15:23:50'),
(82, 3, 71, 2, '2017-07-18 15:23:50'),
(83, 3, 72, 2, '2017-07-18 15:23:50'),
(84, 3, 79, 2, '2017-07-18 15:23:50'),
(85, 3, 73, 2, '2017-07-18 15:23:50'),
(86, 3, 74, 2, '2017-07-18 15:23:50'),
(87, 3, 75, 2, '2017-07-18 15:23:50');

-- --------------------------------------------------------

--
-- Table structure for table `scanbarcodes`
--

CREATE TABLE `scanbarcodes` (
  `ScanBarCodeId` int(11) NOT NULL,
  `ScanName` varchar(250) NOT NULL,
  `ScanTypeId` tinyint(4) NOT NULL,
  `ItemId` int(11) NOT NULL,
  `StoreId` smallint(6) NOT NULL,
  `ScanDateTime` datetime NOT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scanbarcodes`
--

INSERT INTO `scanbarcodes` (`ScanBarCodeId`, `ScanName`, `ScanTypeId`, `ItemId`, `StoreId`, `ScanDateTime`, `CrUserId`, `CrDateTime`) VALUES
(3, 'LCK-10001-1', 4, 1, 2, '2017-09-16 16:37:00', 1, '2017-09-16 17:06:43'),
(4, 'LCK-10001-2', 4, 1, 2, '2017-09-16 16:37:00', 1, '2017-09-16 17:06:43'),
(5, 'LCK-10001-1', 4, 1, 2, '2017-10-02 19:28:58', 1, '2017-10-02 19:28:58'),
(6, 'LCK-10001-2', 4, 1, 2, '2017-10-02 19:28:58', 1, '2017-10-02 19:28:58');

-- --------------------------------------------------------

--
-- Table structure for table `scanproducts`
--

CREATE TABLE `scanproducts` (
  `ScanProductId` int(11) NOT NULL,
  `ScanBarCodeId` int(11) NOT NULL,
  `BarCode` varchar(15) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scanproducts`
--

INSERT INTO `scanproducts` (`ScanProductId`, `ScanBarCodeId`, `BarCode`, `Quantity`) VALUES
(1, 3, '123', 5),
(2, 3, '1234', 5),
(3, 4, '756', 50),
(4, 4, '5652', 15),
(5, 5, '123', 5),
(6, 5, '1234', 5),
(7, 6, '756', 50),
(8, 6, '5652', 15);

-- --------------------------------------------------------

--
-- Table structure for table `storecirculationproducts`
--

CREATE TABLE `storecirculationproducts` (
  `StoreCirculationProductId` int(11) NOT NULL,
  `StoreCirculationId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `ProductChildId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `storecirculationproducts`
--

INSERT INTO `storecirculationproducts` (`StoreCirculationProductId`, `StoreCirculationId`, `ProductId`, `ProductChildId`, `Quantity`) VALUES
(10, 3, 9, 0, 1),
(11, 3, 9, 25, 10),
(12, 3, 9, 26, 10),
(13, 3, 9, 27, 10),
(14, 3, 9, 28, 10),
(15, 3, 9, 29, 10),
(16, 3, 9, 30, 10),
(17, 3, 9, 31, 10),
(18, 3, 9, 32, 10),
(19, 4, 2, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `storecirculations`
--

CREATE TABLE `storecirculations` (
  `StoreCirculationId` int(11) NOT NULL,
  `StoreCirculationCode` varchar(45) NOT NULL,
  `StoreSourceId` smallint(6) NOT NULL,
  `StoreDestinationId` smallint(6) NOT NULL,
  `OrderStatusId` tinyint(4) NOT NULL,
  `StatusId` tinyint(4) NOT NULL,
  `DeliveryTypeId` smallint(6) NOT NULL,
  `Comment` varchar(650) DEFAULT NULL,
  `CancelReason` varchar(650) DEFAULT NULL,
  `HandleDate` datetime DEFAULT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL,
  `UpdateUserId` int(11) DEFAULT NULL,
  `UpdateDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `storecirculations`
--

INSERT INTO `storecirculations` (`StoreCirculationId`, `StoreCirculationCode`, `StoreSourceId`, `StoreDestinationId`, `OrderStatusId`, `StatusId`, `DeliveryTypeId`, `Comment`, `CancelReason`, `HandleDate`, `CrUserId`, `CrDateTime`, `UpdateUserId`, `UpdateDateTime`) VALUES
(1, 'LCK-10001', 1, 2, 1, 2, 2, NULL, NULL, NULL, 1, '2017-08-26 00:00:00', NULL, NULL),
(2, 'LCK10002', 2, 2, 0, 0, 1, NULL, NULL, NULL, 3, '2017-08-26 16:50:54', NULL, NULL),
(3, 'LCK-10003', 2, 1, 3, 2, 2, 'ghi chú 1', NULL, NULL, 3, '2017-08-26 17:01:07', NULL, NULL),
(4, 'LCK-10004', 1, 2, 3, 1, 1, NULL, NULL, NULL, 3, '2017-09-24 11:17:34', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `StoreId` smallint(6) NOT NULL,
  `StoreCode` varchar(45) NOT NULL,
  `StoreName` varchar(250) NOT NULL,
  `ItemStatusId` tinyint(4) NOT NULL,
  `StoreTypeId` tinyint(4) NOT NULL,
  `ProvinceId` tinyint(4) NOT NULL,
  `DistrictId` smallint(6) NOT NULL,
  `Address` varchar(250) NOT NULL,
  `HeadUserId` int(11) NOT NULL,
  `Comment` varchar(650) NOT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`StoreId`, `StoreCode`, `StoreName`, `ItemStatusId`, `StoreTypeId`, `ProvinceId`, `DistrictId`, `Address`, `HeadUserId`, `Comment`, `CrUserId`, `CrDateTime`) VALUES
(1, 'HN', 'Hà Nội', 2, 1, 32, 487, 'Đà Nẵng', 1, 'nfnmfn', 3, '2017-08-25 19:52:28'),
(2, 'DN', 'Đà Nẵng', 2, 1, 32, 487, 'Đà Nẵng', 1, 'nfnmfn', 3, '2017-08-25 19:57:51');

-- --------------------------------------------------------

--
-- Table structure for table `storeusers`
--

CREATE TABLE `storeusers` (
  `StoreUserId` int(11) NOT NULL,
  `StoreId` smallint(6) NOT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `storeusers`
--

INSERT INTO `storeusers` (`StoreUserId`, `StoreId`, `UserId`) VALUES
(4, 2, 1),
(5, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `suppliercontacts`
--

CREATE TABLE `suppliercontacts` (
  `SupplierContactId` int(11) NOT NULL,
  `SupplierId` smallint(6) NOT NULL,
  `ContactName` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `ContactPhone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `PositionName` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `suppliercontacts`
--

INSERT INTO `suppliercontacts` (`SupplierContactId`, `SupplierId`, `ContactName`, `ContactPhone`, `PositionName`) VALUES
(1, 1, 'tg', '78', 'g');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `SupplierId` smallint(6) NOT NULL,
  `SupplierCode` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `SupplierName` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `SupplierTypeId` tinyint(4) NOT NULL,
  `ItemStatusId` tinyint(4) NOT NULL,
  `TaxCode` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HasBill` tinyint(4) NOT NULL,
  `Comment` varchar(650) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`SupplierId`, `SupplierCode`, `SupplierName`, `SupplierTypeId`, `ItemStatusId`, `TaxCode`, `HasBill`, `Comment`, `CrUserId`, `CrDateTime`) VALUES
(1, 'NCC1', 'Nhà Cung cấp 1', 1, 2, 'ggg', 2, 'Nhà Cung cấp 1', 3, '2017-07-30 14:04:20');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `TagId` int(11) NOT NULL,
  `TagName` varchar(250) NOT NULL,
  `TagSlug` varchar(250) NOT NULL,
  `ItemTypeId` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`TagId`, `TagName`, `TagSlug`, `ItemTypeId`) VALUES
(1, 'hoàn', 'hoan', 3),
(2, 'mưa đá', 'mua-da', 3),
(3, 'hoanf', 'hoanf', 5),
(4, 'hoàn', 'hoan', 5),
(5, 'mưa đá', 'mua-da', 5),
(6, 'hoàn mưa đá', 'hoan-mua-da', 5),
(7, 'kho', 'kho', 7),
(8, 'kho HN', 'kho-hn', 7),
(9, 'hoanm', 'hoanm', 8),
(10, '123', '123', 8),
(11, 'hoan', 'hoan', 9),
(12, 'muada', 'muada', 9),
(13, 'mua da', 'mua-da', 6),
(14, 'hoan', 'hoan', 6),
(15, 'giao hang', 'giao-hang', 9),
(16, 'hoàn', 'hoan', 14),
(17, 'mưa đá', 'mua-da', 14),
(18, 'hoan', 'hoan', 10),
(19, 'hoàn', 'hoan', 4);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `TransactionId` int(11) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `OrderId` int(11) NOT NULL,
  `TransactionTypeId` tinyint(4) NOT NULL,
  `TransactionStatusId` tinyint(4) NOT NULL,
  `StoreId` smallint(6) NOT NULL,
  `MoneySourceId` smallint(6) NOT NULL,
  `MoneyPhoneId` smallint(6) NOT NULL,
  `PaidCost` int(11) NOT NULL,
  `Comment` varchar(650) NOT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL,
  `AccountantUserId` int(11) DEFAULT NULL,
  `AccountantDateTime` datetime DEFAULT NULL,
  `AdminUserId` int(11) DEFAULT NULL,
  `AdminDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`TransactionId`, `CustomerId`, `OrderId`, `TransactionTypeId`, `TransactionStatusId`, `StoreId`, `MoneySourceId`, `MoneyPhoneId`, `PaidCost`, `Comment`, `CrUserId`, `CrDateTime`, `AccountantUserId`, `AccountantDateTime`, `AdminUserId`, `AdminDateTime`) VALUES
(2, 2, 6, 1, 1, 1, 2, 1, 100000, 'vb', 3, '2017-09-30 16:40:15', NULL, NULL, NULL, NULL),
(3, 2, 6, 1, 1, 0, 2, 0, 140000, '', 3, '2017-09-30 16:51:48', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transportercontacts`
--

CREATE TABLE `transportercontacts` (
  `TransporterContactId` int(11) NOT NULL,
  `TransporterId` smallint(6) NOT NULL,
  `ContactName` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `ContactPhone` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transportercontacts`
--

INSERT INTO `transportercontacts` (`TransporterContactId`, `TransporterId`, `ContactName`, `ContactPhone`) VALUES
(1, 1, 'Hoan', '0123357'),
(2, 2, 'a', '1'),
(3, 3, 'r', '566');

-- --------------------------------------------------------

--
-- Table structure for table `transporters`
--

CREATE TABLE `transporters` (
  `TransporterId` smallint(6) NOT NULL,
  `TransporterCode` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `TransporterName` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `HasCOD` tinyint(4) NOT NULL,
  `ItemStatusId` tinyint(4) NOT NULL,
  `Comment` varchar(650) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transporters`
--

INSERT INTO `transporters` (`TransporterId`, `TransporterCode`, `TransporterName`, `HasCOD`, `ItemStatusId`, `Comment`, `CrUserId`, `CrDateTime`) VALUES
(1, 'VT', 'Viettel', 2, 2, 'Viettel', 3, '2017-09-02 17:04:06'),
(2, 'VTHN', 'Viettel HN', 2, 2, '', 3, '2017-09-02 17:09:21'),
(3, 'VTDN', 'Viettel DN', 2, 2, '', 3, '2017-09-02 17:09:49');

-- --------------------------------------------------------

--
-- Table structure for table `transporterstores`
--

CREATE TABLE `transporterstores` (
  `TransporterStoresId` int(11) NOT NULL,
  `TransporterId` smallint(6) NOT NULL,
  `StoreId` smallint(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transporterstores`
--

INSERT INTO `transporterstores` (`TransporterStoresId`, `TransporterId`, `StoreId`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `transports`
--

CREATE TABLE `transports` (
  `TransportId` int(11) NOT NULL,
  `TransportCode` varchar(15) NOT NULL,
  `OrderId` int(11) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `CustomerAddressId` int(11) NOT NULL,
  `TransportUserId` int(11) NOT NULL,
  `TransportStatusId` tinyint(4) NOT NULL,
  `TransportTypeId` smallint(6) NOT NULL,
  `TransporterId` smallint(6) NOT NULL,
  `StoreId` smallint(6) NOT NULL,
  `Tracking` varchar(15) NOT NULL,
  `Weight` int(11) NOT NULL,
  `CODCost` int(11) NOT NULL,
  `Comment` varchar(650) DEFAULT NULL,
  `CancerReasonId` smallint(6) DEFAULT NULL,
  `CancerReasonText` varchar(650) DEFAULT NULL,
  `CrUserId` int(11) NOT NULL,
  `CrDateTime` datetime NOT NULL,
  `UpdateUserId` int(11) DEFAULT NULL,
  `UpdateDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transports`
--

INSERT INTO `transports` (`TransportId`, `TransportCode`, `OrderId`, `CustomerId`, `CustomerAddressId`, `TransportUserId`, `TransportStatusId`, `TransportTypeId`, `TransporterId`, `StoreId`, `Tracking`, `Weight`, `CODCost`, `Comment`, `CancerReasonId`, `CancerReasonText`, `CrUserId`, `CrDateTime`, `UpdateUserId`, `UpdateDateTime`) VALUES
(3, 'VC-10003', 5, 2, 6, 0, 1, 1, 1, 1, 'abc XYZ', 10, 11000, 'ghi chus VC', 0, '', 3, '2017-09-02 22:42:11', NULL, NULL),
(4, 'VC-10004', 6, 2, 6, 0, 1, 1, 2, 1, 'đfd', 10, 40, 'ghi chu giao hang', 0, '', 3, '2017-09-10 16:55:47', 3, '2017-09-10 21:45:37'),
(5, 'VC-10005', 0, 0, 7, 0, 1, 1, 0, 1, '', 0, 0, '', 0, '', 3, '2017-09-10 21:10:42', NULL, NULL),
(6, 'VC-10006', 0, 0, 7, 0, 1, 1, 0, 1, '', 0, 0, '', 0, '', 3, '2017-09-10 21:13:31', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transporttypes`
--

CREATE TABLE `transporttypes` (
  `TransportTypeId` smallint(6) NOT NULL,
  `TransportTypeName` varchar(250) NOT NULL,
  `StatusId` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transporttypes`
--

INSERT INTO `transporttypes` (`TransportTypeId`, `TransportTypeName`, `StatusId`) VALUES
(1, 'Bưu điện', 2),
(2, 'Xe ôm', 2),
(3, 'abc22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usergroups`
--

CREATE TABLE `usergroups` (
  `UserGroupId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `GroupId` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `userlevels`
--

CREATE TABLE `userlevels` (
  `UserLevelId` smallint(6) NOT NULL,
  `UserLevelName` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `StatusId` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userproducttypes`
--

CREATE TABLE `userproducttypes` (
  `UserProductTypeId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `ProductTypeId` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `UserPass` varchar(100) NOT NULL,
  `FullName` varchar(250) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `GenderId` tinyint(4) NOT NULL,
  `StatusId` tinyint(4) NOT NULL,
  `ProvinceId` tinyint(4) NOT NULL,
  `Address` varchar(250) NOT NULL,
  `BirthDay` datetime NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `DegreeName` varchar(250) DEFAULT NULL,
  `Facebook` varchar(100) DEFAULT NULL,
  `Avatar` varchar(100) DEFAULT NULL,
  `Token` varchar(15) DEFAULT NULL,
  `Comment` varchar(650) DEFAULT NULL,
  `CrUserId` int(11) DEFAULT NULL,
  `CrDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `UserName`, `UserPass`, `FullName`, `Email`, `GenderId`, `StatusId`, `ProvinceId`, `Address`, `BirthDay`, `PhoneNumber`, `DegreeName`, `Facebook`, `Avatar`, `Token`, `Comment`, `CrUserId`, `CrDateTime`) VALUES
(1, 'hoanmuada', 'd93d62cb20336134bc2d65c98d933d99', 'Hoàn Mưa Đá', 'levanhoanhtt@gmail.com', 1, 2, 54, 'Hà Trung', '1991-07-11 00:00:00', '01669136318', '', 'https://www.facebook.com/hoanmuada212', 'hoanmuada.jpg', '3577c6563e642d5', NULL, 1, '2017-07-23 21:24:59'),
(2, 'hieutt38', '27d61159f5379fadbb4341061a6f52b1', 'Trần Trung Hiếu', 'hieutt38@gmail.com', 1, 2, 24, 'Ha Noi', '1991-05-27 00:00:00', '0939349696', '', 'https://www.facebook.com/trunghieu.trth?fref=ufi', 'no-image.jpg', NULL, NULL, 2, '2017-07-23 21:27:00'),
(3, 'Ricky', '25f9e794323b453885f5181f1b624d0b', 'Ricky', 'ricky@gmail.com', 1, 2, 24, 'Ha Noi', '0001-11-30 00:00:00', '0123456789', '', '', 'no-image.jpg', NULL, NULL, 3, '2017-07-23 10:31:21');

-- --------------------------------------------------------

--
-- Table structure for table `variantoptions`
--

CREATE TABLE `variantoptions` (
  `VariantOptionId` int(11) NOT NULL,
  `VariantId` smallint(6) NOT NULL,
  `OptionValue` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `VariantId` smallint(6) NOT NULL,
  `VariantName` varchar(250) NOT NULL,
  `StatusId` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`VariantId`, `VariantName`, `StatusId`) VALUES
(1, 'Màu săc', 2),
(2, 'Kích thước', 2),
(3, 'Vật liệu', 2),
(4, ',vmvhb', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actionlogs`
--
ALTER TABLE `actionlogs`
  ADD PRIMARY KEY (`ActionLogId`);

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`ActionId`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`ArticleId`);

--
-- Indexes for table `cancelreasons`
--
ALTER TABLE `cancelreasons`
  ADD PRIMARY KEY (`CancelReasonId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryId`);

--
-- Indexes for table `categoryitems`
--
ALTER TABLE `categoryitems`
  ADD PRIMARY KEY (`CategoryItemId`);

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`ConfigId`);

--
-- Indexes for table `contributorproducttypes`
--
ALTER TABLE `contributorproducttypes`
  ADD PRIMARY KEY (`ContributorProductTypeId`);

--
-- Indexes for table `contributors`
--
ALTER TABLE `contributors`
  ADD PRIMARY KEY (`ContributorId`);

--
-- Indexes for table `customeraddress`
--
ALTER TABLE `customeraddress`
  ADD PRIMARY KEY (`CustomerAddressId`);

--
-- Indexes for table `customergroups`
--
ALTER TABLE `customergroups`
  ADD PRIMARY KEY (`CustomerGroupId`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerId`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`DistrictId`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`FileId`);

--
-- Indexes for table `filters`
--
ALTER TABLE `filters`
  ADD PRIMARY KEY (`FilterId`);

--
-- Indexes for table `groupactions`
--
ALTER TABLE `groupactions`
  ADD PRIMARY KEY (`GroupActionId`),
  ADD KEY `groupactions_groups` (`GroupId`),
  ADD KEY `groupactions_actions` (`Actionid`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`GroupId`);

--
-- Indexes for table `importproducts`
--
ALTER TABLE `importproducts`
  ADD PRIMARY KEY (`ImportProductId`);

--
-- Indexes for table `imports`
--
ALTER TABLE `imports`
  ADD PRIMARY KEY (`ImportId`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`InventoryId`);

--
-- Indexes for table `itemfiles`
--
ALTER TABLE `itemfiles`
  ADD PRIMARY KEY (`ItemFileId`);

--
-- Indexes for table `itemmetadatas`
--
ALTER TABLE `itemmetadatas`
  ADD PRIMARY KEY (`ItemMetadataId`);

--
-- Indexes for table `itemtags`
--
ALTER TABLE `itemtags`
  ADD PRIMARY KEY (`ItemTagId`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`LoginId`);

--
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`ManufacturerId`);

--
-- Indexes for table `moneyphones`
--
ALTER TABLE `moneyphones`
  ADD PRIMARY KEY (`MoneyPhoneId`);

--
-- Indexes for table `moneysources`
--
ALTER TABLE `moneysources`
  ADD PRIMARY KEY (`MoneySourceId`);

--
-- Indexes for table `orderproducts`
--
ALTER TABLE `orderproducts`
  ADD PRIMARY KEY (`OrderProductId`),
  ADD KEY `orderproducts_orders` (`OrderId`),
  ADD KEY `orderproducts_products` (`ProductId`);

--
-- Indexes for table `orderreasons`
--
ALTER TABLE `orderreasons`
  ADD PRIMARY KEY (`OrderReasonId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderId`);

--
-- Indexes for table `orderservices`
--
ALTER TABLE `orderservices`
  ADD PRIMARY KEY (`OrderServiceId`);

--
-- Indexes for table `ordertypes`
--
ALTER TABLE `ordertypes`
  ADD PRIMARY KEY (`OrderTypeId`);

--
-- Indexes for table `otherservices`
--
ALTER TABLE `otherservices`
  ADD PRIMARY KEY (`OtherServiceId`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`PartId`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`PositionId`);

--
-- Indexes for table `productchilds`
--
ALTER TABLE `productchilds`
  ADD PRIMARY KEY (`ProductChildId`);

--
-- Indexes for table `productquantity`
--
ALTER TABLE `productquantity`
  ADD PRIMARY KEY (`ProductQuantityId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductId`),
  ADD KEY `products_producttypes` (`ProductTypeId`);

--
-- Indexes for table `producttypes`
--
ALTER TABLE `producttypes`
  ADD PRIMARY KEY (`ProductTypeId`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`PromotionId`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`ProvinceId`);

--
-- Indexes for table `returngoodproducts`
--
ALTER TABLE `returngoodproducts`
  ADD PRIMARY KEY (`ReturnGoodProductId`);

--
-- Indexes for table `returngoods`
--
ALTER TABLE `returngoods`
  ADD PRIMARY KEY (`ReturnGoodId`);

--
-- Indexes for table `roleactions`
--
ALTER TABLE `roleactions`
  ADD PRIMARY KEY (`RoleActionId`),
  ADD KEY `roleactions_actioms` (`ActionId`);

--
-- Indexes for table `scanbarcodes`
--
ALTER TABLE `scanbarcodes`
  ADD PRIMARY KEY (`ScanBarCodeId`);

--
-- Indexes for table `scanproducts`
--
ALTER TABLE `scanproducts`
  ADD PRIMARY KEY (`ScanProductId`);

--
-- Indexes for table `storecirculationproducts`
--
ALTER TABLE `storecirculationproducts`
  ADD PRIMARY KEY (`StoreCirculationProductId`);

--
-- Indexes for table `storecirculations`
--
ALTER TABLE `storecirculations`
  ADD PRIMARY KEY (`StoreCirculationId`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`StoreId`);

--
-- Indexes for table `storeusers`
--
ALTER TABLE `storeusers`
  ADD PRIMARY KEY (`StoreUserId`);

--
-- Indexes for table `suppliercontacts`
--
ALTER TABLE `suppliercontacts`
  ADD PRIMARY KEY (`SupplierContactId`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`SupplierId`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`TagId`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`TransactionId`);

--
-- Indexes for table `transportercontacts`
--
ALTER TABLE `transportercontacts`
  ADD PRIMARY KEY (`TransporterContactId`);

--
-- Indexes for table `transporters`
--
ALTER TABLE `transporters`
  ADD PRIMARY KEY (`TransporterId`);

--
-- Indexes for table `transporterstores`
--
ALTER TABLE `transporterstores`
  ADD PRIMARY KEY (`TransporterStoresId`);

--
-- Indexes for table `transports`
--
ALTER TABLE `transports`
  ADD PRIMARY KEY (`TransportId`);

--
-- Indexes for table `transporttypes`
--
ALTER TABLE `transporttypes`
  ADD PRIMARY KEY (`TransportTypeId`);

--
-- Indexes for table `usergroups`
--
ALTER TABLE `usergroups`
  ADD PRIMARY KEY (`UserGroupId`),
  ADD KEY `usergroups_users` (`UserId`),
  ADD KEY `usergroups_groups` (`GroupId`);

--
-- Indexes for table `userlevels`
--
ALTER TABLE `userlevels`
  ADD PRIMARY KEY (`UserLevelId`);

--
-- Indexes for table `userproducttypes`
--
ALTER TABLE `userproducttypes`
  ADD PRIMARY KEY (`UserProductTypeId`),
  ADD KEY `userproducttypes_users` (`UserId`),
  ADD KEY `userproducttypes_producttypes` (`ProductTypeId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`),
  ADD KEY `users_provinces` (`ProvinceId`);

--
-- Indexes for table `variantoptions`
--
ALTER TABLE `variantoptions`
  ADD PRIMARY KEY (`VariantOptionId`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`VariantId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actionlogs`
--
ALTER TABLE `actionlogs`
  MODIFY `ActionLogId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `ActionId` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `ArticleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cancelreasons`
--
ALTER TABLE `cancelreasons`
  MODIFY `CancelReasonId` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryId` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `categoryitems`
--
ALTER TABLE `categoryitems`
  MODIFY `CategoryItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `contributorproducttypes`
--
ALTER TABLE `contributorproducttypes`
  MODIFY `ContributorProductTypeId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contributors`
--
ALTER TABLE `contributors`
  MODIFY `ContributorId` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customeraddress`
--
ALTER TABLE `customeraddress`
  MODIFY `CustomerAddressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `customergroups`
--
ALTER TABLE `customergroups`
  MODIFY `CustomerGroupId` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `FileId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `filters`
--
ALTER TABLE `filters`
  MODIFY `FilterId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `groupactions`
--
ALTER TABLE `groupactions`
  MODIFY `GroupActionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `GroupId` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `importproducts`
--
ALTER TABLE `importproducts`
  MODIFY `ImportProductId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `imports`
--
ALTER TABLE `imports`
  MODIFY `ImportId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `InventoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `itemfiles`
--
ALTER TABLE `itemfiles`
  MODIFY `ItemFileId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `itemmetadatas`
--
ALTER TABLE `itemmetadatas`
  MODIFY `ItemMetadataId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `itemtags`
--
ALTER TABLE `itemtags`
  MODIFY `ItemTagId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `LoginId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `ManufacturerId` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `moneyphones`
--
ALTER TABLE `moneyphones`
  MODIFY `MoneyPhoneId` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `moneysources`
--
ALTER TABLE `moneysources`
  MODIFY `MoneySourceId` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orderproducts`
--
ALTER TABLE `orderproducts`
  MODIFY `OrderProductId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `orderreasons`
--
ALTER TABLE `orderreasons`
  MODIFY `OrderReasonId` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `orderservices`
--
ALTER TABLE `orderservices`
  MODIFY `OrderServiceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ordertypes`
--
ALTER TABLE `ordertypes`
  MODIFY `OrderTypeId` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `otherservices`
--
ALTER TABLE `otherservices`
  MODIFY `OtherServiceId` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `PartId` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `PositionId` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `productchilds`
--
ALTER TABLE `productchilds`
  MODIFY `ProductChildId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `productquantity`
--
ALTER TABLE `productquantity`
  MODIFY `ProductQuantityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `producttypes`
--
ALTER TABLE `producttypes`
  MODIFY `ProductTypeId` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `PromotionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `returngoodproducts`
--
ALTER TABLE `returngoodproducts`
  MODIFY `ReturnGoodProductId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `returngoods`
--
ALTER TABLE `returngoods`
  MODIFY `ReturnGoodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `roleactions`
--
ALTER TABLE `roleactions`
  MODIFY `RoleActionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `scanbarcodes`
--
ALTER TABLE `scanbarcodes`
  MODIFY `ScanBarCodeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `scanproducts`
--
ALTER TABLE `scanproducts`
  MODIFY `ScanProductId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `storecirculationproducts`
--
ALTER TABLE `storecirculationproducts`
  MODIFY `StoreCirculationProductId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `storecirculations`
--
ALTER TABLE `storecirculations`
  MODIFY `StoreCirculationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `StoreId` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `storeusers`
--
ALTER TABLE `storeusers`
  MODIFY `StoreUserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `suppliercontacts`
--
ALTER TABLE `suppliercontacts`
  MODIFY `SupplierContactId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `SupplierId` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `TagId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `TransactionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transportercontacts`
--
ALTER TABLE `transportercontacts`
  MODIFY `TransporterContactId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transporters`
--
ALTER TABLE `transporters`
  MODIFY `TransporterId` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transporterstores`
--
ALTER TABLE `transporterstores`
  MODIFY `TransporterStoresId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transports`
--
ALTER TABLE `transports`
  MODIFY `TransportId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `transporttypes`
--
ALTER TABLE `transporttypes`
  MODIFY `TransportTypeId` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `usergroups`
--
ALTER TABLE `usergroups`
  MODIFY `UserGroupId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `userlevels`
--
ALTER TABLE `userlevels`
  MODIFY `UserLevelId` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `userproducttypes`
--
ALTER TABLE `userproducttypes`
  MODIFY `UserProductTypeId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `variantoptions`
--
ALTER TABLE `variantoptions`
  MODIFY `VariantOptionId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `VariantId` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderproducts`
--
ALTER TABLE `orderproducts`
  ADD CONSTRAINT `orderproducts_orders` FOREIGN KEY (`OrderId`) REFERENCES `orders` (`OrderId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orderproducts_products` FOREIGN KEY (`ProductId`) REFERENCES `products` (`ProductId`) ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_producttypes` FOREIGN KEY (`ProductTypeId`) REFERENCES `producttypes` (`ProductTypeId`) ON UPDATE CASCADE;

--
-- Constraints for table `usergroups`
--
ALTER TABLE `usergroups`
  ADD CONSTRAINT `usergroups_groups` FOREIGN KEY (`GroupId`) REFERENCES `groups` (`GroupId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usergroups_users` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`) ON UPDATE CASCADE;

--
-- Constraints for table `userproducttypes`
--
ALTER TABLE `userproducttypes`
  ADD CONSTRAINT `userproducttypes_producttypes` FOREIGN KEY (`ProductTypeId`) REFERENCES `producttypes` (`ProductTypeId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `userproducttypes_users` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
