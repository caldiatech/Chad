-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2015 at 08:30 AM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text,
  `events_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbladditionalphotogallery`
--

CREATE TABLE `tbladditionalphotogallery` (
  `fldAdditionalPhotoGalleryID` int(10) UNSIGNED NOT NULL,
  `fldPhotoGalleryID` varchar(10) DEFAULT NULL,
  `fldAdditionalPhotoGalleryImage` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladditionalphotogallery`
--

INSERT INTO `tbladditionalphotogallery` (`fldAdditionalPhotoGalleryID`, `fldPhotoGalleryID`, `fldAdditionalPhotoGalleryImage`) VALUES
(1, '4', 'img-flexslider.jpg'),
(2, '12', 'image1.JPG'),
(3, '13', 'image1.JPG'),
(4, '14', 'bigstockphoto__d_pie_graph_803779.jpg'),
(5, '15', 'bigstockphoto__d_pie_graph_803779.jpg'),
(6, '16', 'image2.jpg'),
(7, '16', 'image3.jpg'),
(8, '16', 'image4.jpg'),
(9, '16', 'image5.jpg'),
(10, '16', 'image6.jpg'),
(16, '18', 'ajaxslide-01-jpg.jpg'),
(17, '18', 'image3.jpg'),
(18, '18', 'image4.jpg'),
(19, '18', 'image5.jpg'),
(20, '18', 'image6.jpg'),
(23, '19', 'D&R2.jpg'),
(24, '17', 'photo-gallery01.jpg'),
(25, '17', 'photo-gallery02.jpg'),
(26, '17', 'photo-gallery03.jpg'),
(27, '17', 'photo-gallery04.jpg'),
(28, '17', 'photo-gallery05.jpg'),
(29, '17', 'photo-gallery06.jpg'),
(30, '33', 'photo-gallery01.jpg'),
(31, '33', 'photo-gallery02.jpg'),
(32, '33', 'photo-gallery03.jpg'),
(33, '33', 'photo-gallery04.jpg'),
(34, '33', 'photo-gallery05.jpg'),
(35, '21', 'photo-gallery03.jpg'),
(36, '21', 'photo-gallery04.jpg'),
(37, '21', 'photo-gallery05.jpg'),
(38, '21', 'photo-gallery06.jpg'),
(39, '21', 'photo-gallery07.jpg'),
(40, '34', 'DNRGallery2.jpg'),
(41, '34', 'DNRGallery3.jpg'),
(42, '34', 'DNRGallery4.jpg'),
(43, '34', 'DNRGallery5.jpg'),
(44, '35', 'glow.hexagon.green.gradient.white.black.1372x767.002.jpg'),
(45, '35', 'glow.hexagon.green.gradient.white.black.1372x767.002.jpg'),
(46, '44', 'image2.jpg'),
(47, '44', 'image3.jpg'),
(48, '44', 'image4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbladditionalproduct`
--

CREATE TABLE `tbladditionalproduct` (
  `fldAdditionalProductID` int(10) UNSIGNED NOT NULL,
  `fldAdditionalProductProductID` varchar(100) DEFAULT NULL,
  `fldAdditionalProductIDImage` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladditionalproduct`
--

INSERT INTO `tbladditionalproduct` (`fldAdditionalProductID`, `fldAdditionalProductProductID`, `fldAdditionalProductIDImage`) VALUES
(6, '4', 'ajaxslide-01-jpg.jpg'),
(7, '4', 'dnr1.jpg'),
(8, '4', 'dnr2.jpg'),
(9, '4', 'dnr3.jpg'),
(10, '4', 'dnr5.jpg'),
(11, '4', 'dnr6.jpg'),
(12, '3', 'dnr1.jpg'),
(13, '3', 'dnr2.jpg'),
(14, '3', 'dnr3.jpg'),
(15, '3', 'dnr5.jpg'),
(16, '3', 'dnr6.jpg'),
(17, '6', 'ajaxslide-01-jpg.jpg'),
(18, '8', 'ajaxslide-01-jpg.jpg'),
(19, '9', 'ajaxslide-01-jpg.jpg'),
(20, '10', 'ajaxslide-01-jpg.jpg'),
(21, '11', 'ajaxslide-01-jpg.jpg'),
(22, '2', 'ajaxslide-01-jpg.jpg'),
(23, '3', 'ajaxslide-01-jpg.jpg'),
(24, '4', 'ajaxslide-01-jpg.jpg'),
(25, '5', 'ajaxslide-01-jpg.jpg'),
(26, '6', 'ajaxslide-01-jpg.jpg'),
(27, '9', '_75_Category_spxmayd 327x230.jpg'),
(28, '6', 'slide2.jpg'),
(29, '6', 'slide3.jpg'),
(30, '6', 'slide4.jpg'),
(31, '9', 'slide2.jpg'),
(32, '9', 'slide3.jpg'),
(33, '9', 'slide4.jpg'),
(34, '7', 'image2.jpg'),
(35, '7', 'image3.jpg'),
(36, '7', 'image4.jpg'),
(37, '7', 'image5.jpg'),
(38, '7', 'image6.jpg'),
(39, '2', 'image2.jpg'),
(40, '2', 'image3.jpg'),
(41, '2', 'image4.jpg'),
(42, '2', 'image5.jpg'),
(43, '2', 'image6.jpg'),
(44, '5', 'image2.jpg'),
(45, '5', 'image3.jpg'),
(46, '5', 'image4.jpg'),
(47, '5', 'image5.jpg'),
(48, '20', 'shoes.jpg'),
(49, '46', 'WebDevProduct2.jpg'),
(50, '45', 'MB-chronowing.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbladministrator`
--

CREATE TABLE `tbladministrator` (
  `fldAdministratorID` int(10) UNSIGNED NOT NULL,
  `fldAdministratorFullname` varchar(250) DEFAULT NULL,
  `fldAdministratorEmail` varchar(250) DEFAULT NULL,
  `fldAdministratorUsername` varchar(100) DEFAULT NULL,
  `fldAdministratorPassword` varchar(100) DEFAULT NULL,
  `fldAdministratorPhone` varchar(100) DEFAULT NULL,
  `fldAdministratorSiteName` varchar(250) DEFAULT NULL,
  `fldAdministratorFacebook` varchar(250) DEFAULT NULL,
  `fldAdministratorTwitter` varchar(250) DEFAULT NULL,
  `fldAdministratorLinkedIn` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladministrator`
--

INSERT INTO `tbladministrator` (`fldAdministratorID`, `fldAdministratorFullname`, `fldAdministratorEmail`, `fldAdministratorUsername`, `fldAdministratorPassword`, `fldAdministratorPhone`, `fldAdministratorSiteName`, `fldAdministratorFacebook`, `fldAdministratorTwitter`, `fldAdministratorLinkedIn`) VALUES
(1, 'Administrator', 'test1@dogandrooster.net', 'webmaster', '$2y$08$jWcTEXQRxou1CVcssbTxbedeBX5g1UzFuYd4szu/NueVahNRP3lNG', '1234456', 'Dog and Rooster', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblauthorize`
--

CREATE TABLE `tblauthorize` (
  `fldAuthorizeID` int(10) UNSIGNED NOT NULL,
  `fldAuthorizeLoginKey` varchar(100) DEFAULT NULL,
  `fldAuthorizeTranKey` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblauthorize`
--

INSERT INTO `tblauthorize` (`fldAuthorizeID`, `fldAuthorizeLoginKey`, `fldAuthorizeTranKey`) VALUES
(1, '9hhD3AD4E422', '78qYK4876MSSbm82');

-- --------------------------------------------------------

--
-- Table structure for table `tblcart`
--

CREATE TABLE `tblcart` (
  `fldCartID` int(10) UNSIGNED NOT NULL,
  `fldCartProductID` varchar(10) DEFAULT NULL,
  `fldCartClientID` varchar(10) DEFAULT NULL,
  `fldCartProductName` varchar(250) DEFAULT NULL,
  `fldCartProductPrice` varchar(100) DEFAULT NULL,
  `fldCartQuantity` varchar(10) DEFAULT NULL,
  `fldCartOrderNo` varchar(100) DEFAULT NULL,
  `fldCartOrderDate` date DEFAULT NULL,
  `fldCartStatus` varchar(100) DEFAULT NULL,
  `fldCartIpAddress` varchar(100) DEFAULT NULL,
  `fldCartProductOptions` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcart`
--

INSERT INTO `tblcart` (`fldCartID`, `fldCartProductID`, `fldCartClientID`, `fldCartProductName`, `fldCartProductPrice`, `fldCartQuantity`, `fldCartOrderNo`, `fldCartOrderDate`, `fldCartStatus`, `fldCartIpAddress`, `fldCartProductOptions`) VALUES
(15, '2', '7', 'Test Products', '100', '1', '7-20140405-113', '2014-04-05', 'Paid', '::1', NULL),
(16, '6', '11', 'Test Product 4', '50', '1', '11-20140415-81', '2014-04-15', 'New', '75.80.158.188', NULL),
(31, '4', '12', 'Test Products 2', '50', '1', '12-20140514-55', '2014-05-14', 'Paid', '75.80.158.188', NULL),
(32, '5', '12', 'Test Products 3', '100', '5', '12-20140514-55', '2014-05-14', 'Paid', '75.80.158.188', NULL),
(33, '2', '14', 'Test Products', '100', '2', '14-20140515-236', '2014-05-15', 'Paid', '75.80.158.188', NULL),
(34, '6', '14', 'Test Product 4', '50', '4', '14-20140515-236', '2014-05-15', 'Paid', '75.80.158.188', NULL),
(35, '3', '14', 'Test Products 1', '120', '1', '14-20140515-236', '2014-05-15', 'Paid', '75.80.158.188', NULL),
(36, '6', '16', 'Test Product 4', '100', '1', '16-20140523-324', '2014-05-23', 'Paid', '124.105.57.86', NULL),
(37, '2', '17', 'Test Products', '150', '5', '17-20140809-218', '2014-08-09', 'Paid', '75.80.158.188', NULL),
(38, '6', '17', 'Test Product 4', '100', '1', '17-20140809-9', '2014-08-09', 'Paid', '75.80.158.188', NULL),
(39, '6', '17', 'Test Product 4', '100', '1', '17-20140809-181', '2014-08-09', 'Paid', '75.80.158.188', NULL),
(40, '45', '16', '3.1', '250', '2', '16-20141124-108', '2014-11-24', 'Paid', '124.105.57.86', ''),
(41, '45', '16', '3.1', '250', '1', '16-20141124-46', '2014-11-24', 'Paid', '124.105.57.86', ''),
(42, '3', '7', 'Test Products 1', '120', '1', '7-20141124-376', '2014-11-24', 'Paid', '124.105.57.86', ''),
(43, '13', '7', 'Test Shoes 3', '50', '1', '7-20141124-376', '2014-11-24', 'Paid', '124.105.57.86', ''),
(44, '10', '7', 'Test Shoes', '250', '1', '7-20141124-376', '2014-11-24', 'Paid', '124.105.57.86', ''),
(45, '45', '16', '3.1', '400', '1', '16-20141201-63', '2014-12-01', 'Paid', '124.105.57.86', NULL),
(46, '46', '16', 'WebDev Product 1', '400', '4', '16-20141201-63', '2014-12-01', 'Paid', '124.105.57.86', ''),
(47, '47', '16', 'Test 3 Fedon1919', '299', '4', '16-20141201-63', '2014-12-01', 'Paid', '124.105.57.86', ''),
(48, '45', '16', '3.1', '400', '7', '16-20141201-61', '2014-12-01', 'Paid', '124.105.57.86', '2_9');

-- --------------------------------------------------------

--
-- Table structure for table `tblcartcouponcode`
--

CREATE TABLE `tblcartcouponcode` (
  `fldCartCouponCodeID` int(10) UNSIGNED NOT NULL,
  `fldCartCouponCodeOrderNo` varchar(100) DEFAULT NULL,
  `fldCartCouponCodeCouponCode` varchar(100) DEFAULT NULL,
  `fldCartCouponCodeCouponPrice` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcartcouponcode`
--

INSERT INTO `tblcartcouponcode` (`fldCartCouponCodeID`, `fldCartCouponCodeOrderNo`, `fldCartCouponCodeCouponCode`, `fldCartCouponCodeCouponPrice`) VALUES
(1, '3-20140322-155', 'test', '2'),
(2, '3-20140322-262', 'test', '2'),
(3, '3-20140322-380', 'TEST', '2'),
(4, '3-20140322-114', 'TEST', '2'),
(5, '7-20140322-172', 'test', '2'),
(6, '7-20140405-113', 'test', '5'),
(7, '7-20140424-325', 'test', '2'),
(8, '7-20140424-249', 'test', '2'),
(9, '7-20140424-350', 'test', '2'),
(10, '7-20140424-162', 'test', '2'),
(11, '7-20140424-264', 'test', '2'),
(12, '14-20140515-236', 'test', '2'),
(13, '17-20140809-218', 'test', '2'),
(14, '17-20140809-9', 'test', '2'),
(15, '17-20140809-181', 'test', '2'),
(16, '16-20141124-108', 'test', '2'),
(17, '16-20141124-46', 'test', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tblcartshippingrate`
--

CREATE TABLE `tblcartshippingrate` (
  `fldCartShippingRateID` int(10) UNSIGNED NOT NULL,
  `fldCartShippingRateOrderNo` varchar(150) DEFAULT NULL,
  `fldCartShippingRateShippingName` varchar(150) DEFAULT NULL,
  `fldCartShippingRateShippingAmount` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcartshippingrate`
--

INSERT INTO `tblcartshippingrate` (`fldCartShippingRateID`, `fldCartShippingRateOrderNo`, `fldCartShippingRateShippingName`, `fldCartShippingRateShippingAmount`) VALUES
(1, '3-20140315-39', 'Ground', '16.67'),
(2, '3-20140315-130', 'Ground', '16.67'),
(3, '3-20140315-33', 'Ground', '16.67'),
(4, '3-20140315-218', 'Ground', '14.94'),
(5, '7-20140405-113', 'Ground', '10.91'),
(6, '11-20140415-81', 'Next Day Air', '30.97'),
(7, '7-20140424-62', 'Ground', '10.47'),
(8, '7-20140424-147', 'Ground', '10.47'),
(9, '7-20140424-285', 'Ground', '10.47'),
(10, '7-20140424-299', 'Ground', '10.47'),
(11, '7-20140424-31', 'Ground', '10.47'),
(12, '7-20140424-400', 'Ground', '10.47'),
(13, '7-20140424-252', 'Ground', '10.47'),
(14, '7-20140424-148', 'Ground', '13.17'),
(15, '7-20140424-362', 'Ground', '13.17'),
(16, '7-20140424-325', 'Ground', '10.47'),
(17, '7-20140424-249', 'Ground', '13.17'),
(18, '7-20140424-350', 'Ground', '13.17'),
(19, '7-20140424-162', 'Ground', '13.17'),
(20, '7-20140424-264', 'Ground', '13.17'),
(21, '12-20140514-55', 'Next Day Air', '42.58'),
(22, '14-20140515-236', '3-Day Select', '23.36'),
(23, '16-20140523-324', 'Ground', '10.47'),
(24, '16-20140523-341', 'Ground', '10.47'),
(25, '17-20140809-218', 'Priority Mail 1-Day', '8.70'),
(26, '17-20140809-9', '2nd Day Air', '18.90'),
(27, '17-20140809-181', 'Ground', '10.42'),
(28, '16-20141124-108', 'Ground', '15.97'),
(29, '16-20141124-46', 'Ground', '14.17'),
(30, '7-20141124-376', 'Ground', '15.61'),
(31, '16-20141201-63', 'Priority Mail 1-Day', '15.55'),
(32, '16-20141201-61', 'Ground', '36.62');

-- --------------------------------------------------------

--
-- Table structure for table `tblcarttax`
--

CREATE TABLE `tblcarttax` (
  `fldCartTaxID` int(10) UNSIGNED NOT NULL,
  `fldCartTaxOrderNo` varchar(150) DEFAULT NULL,
  `fldCartTax` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcarttax`
--

INSERT INTO `tblcarttax` (`fldCartTaxID`, `fldCartTaxOrderNo`, `fldCartTax`) VALUES
(1, '3-20140315-39', '10.64'),
(2, '3-20140315-130', '10.64'),
(3, '3-20140315-33', '10.64'),
(4, '3-20140315-218', '9.25'),
(5, '3-20140322-155', '9.25'),
(6, '3-20140322-262', '18.50'),
(7, '3-20140322-380', '27.75'),
(8, '3-20140322-114', '37.00'),
(9, '7-20140322-172', '17.57'),
(10, '7-20140405-113', '9.06'),
(11, '11-20140415-81', '4.63'),
(12, '7-20140424-62', '4.63'),
(13, '7-20140424-147', '9.25'),
(14, '7-20140424-285', '9.25'),
(15, '7-20140424-299', '9.25'),
(16, '7-20140424-31', '9.25'),
(17, '7-20140424-400', '9.25'),
(18, '7-20140424-252', '9.25'),
(19, '7-20140424-148', '13.88'),
(20, '7-20140424-362', '13.88'),
(21, '7-20140424-325', '9.06'),
(22, '7-20140424-249', '13.69'),
(23, '7-20140424-350', '18.32'),
(24, '7-20140424-162', '18.32'),
(25, '7-20140424-264', '18.32'),
(26, '12-20140514-55', '50.88'),
(27, '14-20140515-236', '47.91'),
(28, '16-20140523-324', '9.25'),
(29, '16-20140523-341', '9.25'),
(30, '17-20140809-218', '69.19'),
(31, '17-20140809-9', '9.06'),
(32, '17-20140809-181', '9.06'),
(33, '16-20141124-108', '46.06'),
(34, '16-20141124-46', '22.94'),
(35, '7-20141124-376', '38.85'),
(36, '16-20141201-63', '295.63'),
(37, '16-20141201-61', '259.00');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `fldCategoryID` int(10) UNSIGNED NOT NULL,
  `fldCategoryName` varchar(250) DEFAULT NULL,
  `fldCategoryDescription` text,
  `fldCategoryPosition` int(11) DEFAULT '1',
  `fldCategoryMainID` varchar(10) DEFAULT NULL,
  `fldCategoryImage` varchar(250) DEFAULT NULL,
  `fldCategorySlug` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`fldCategoryID`, `fldCategoryName`, `fldCategoryDescription`, `fldCategoryPosition`, `fldCategoryMainID`, `fldCategoryImage`, `fldCategorySlug`) VALUES
(3, 'Test 2', '<p>Test 2</p>', 3, '0', 'ajaxslide-01-jpg.jpg', 'test-2'),
(6, 'test 21', '<p>test 21</p>', 2, '3', 'ajaxslide-01-jpg.jpg', 'test-21-1'),
(7, 'Test 1', '<p>Test 1</p>', 1, '0', 'ajaxslide-01-jpg.jpg', 'test-1-1'),
(8, 'Products 1.1', '<p>Products 1.1</p>', 1, '7', 'ajaxslide-01-jpg.jpg', 'products-11'),
(9, 'Test 3', '<p>This is a test</p>', 4, '0', 'ajaxslide-01-jpg.jpg', 'test-3'),
(11, 'Test 2.2', '<p>This is a test</p>', 1, '3', 'ajaxslide-01-jpg.jpg', 'test-22'),
(12, 'Test 1.2', '<p>this is a test</p>', 2, '7', 'ajaxslide-01-jpg.jpg', 'test-12'),
(13, 'Test 3.1', '<p>test</p>', 1, '9', 'ajaxslide-01-jpg.jpg', 'test-31'),
(14, 'TESTING', '<p>TEST AGAIN</p>', 3, '7', '_75_Category_spxmayd 327x230.jpg', 'testing'),
(18, 'Sub1 WebDev', '<p><!--\r\ntd {border: 1px solid #ccc;}br {mso-data-placement:same-cell;}\r\n--><span style="font-size: 13px; font-family: arial,sans,sans-serif; color: #000000; text-align: left;">Sed imperdiet, sem a facilisis facilisis, neque odio ullamcorper mauris,\r\n id dictum ante ipsum non libero. Praesent a ante lobortis, dapibus sem \r\nvitae, condimentum felis. Aliquam facilisis venenatis tincidunt. Cras ut\r\n interdum diam, feugiat tempor purus.</span></p>', 2, '16', 'webdev1.jpg', 'sub1-webdev-1'),
(19, 'test', '<p>testtest</p>', 2, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblclient`
--

CREATE TABLE `tblclient` (
  `fldClientID` int(10) UNSIGNED NOT NULL,
  `fldClientFirstname` varchar(250) DEFAULT NULL,
  `fldClientLastname` varchar(250) DEFAULT NULL,
  `fldClientEmail` varchar(250) DEFAULT NULL,
  `fldClientUsername` varchar(150) DEFAULT NULL,
  `fldClientPassword` varchar(250) DEFAULT NULL,
  `fldClientHashSecurity` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblclient`
--

INSERT INTO `tblclient` (`fldClientID`, `fldClientFirstname`, `fldClientLastname`, `fldClientEmail`, `fldClientUsername`, `fldClientPassword`, `fldClientHashSecurity`) VALUES
(7, '123', 'Doe', 'test1@dogandrooster.net', 'test1', '$2y$08$YWdJNCpq4wMPw1WwKyrT2O6OWiHU7txK.oViTfxHYSmL2c6gRMo06', 'ff9bd88f4a0fa0d0315ff4cbe6bce748'),
(8, 'Doe', 'Jane', 'test2@dogandrooster.net', 'test2', '$2y$08$8g0iJkJ8dE8oDdCVNugssu.ly2/k7PKvs0.VlHlsbXjR7CNQdMs5e', NULL),
(9, 'Doe', 'Jun', 'test3@dogandrooster.net', 'test3', '$2y$08$nxQasFcOHinoa63oKPZ8wOVsxahztwJljYBuGB93E3.lWXgRleUya', NULL),
(10, 'Doe', 'Jenny', 'test4@dogandrooster.net', 'test4', '$2y$08$gfEJMtgJj1s3C7r97jEtw.S6bDcs2IfHcb0Q8.u0g0I2A/J3ddom6', NULL),
(11, 'steve', 'adams', 'steve@dogandrooster.com', 'steve@dogandrooster.com', '$2y$08$ry6bW9hKBk0MkO9J979zU.7M7NPKDFVXCKiXGlFxf.ZzoRMcNC5B2', '52cc21ce6aa73ab0ca82739c02d9d7dd'),
(12, 'Angela', 'Melfi', 'angela@dogandrooster.com', 'test', '$2y$08$60k9jbwLAW2..eMMddCO3uV21CR.w8Z1t3f472dlxKvYYx3H5cq16', 'c4ae6d16de93eb8ccd315cb5ef3c1d2b'),
(13, 'test4', 'test4', 'm@gmail.com', 'm', '$2y$08$bMmJd6.AW22kk5flyr9x6eLGKqeLm1ojMZPIk7CK1G6xOOn8HjJfe', NULL),
(16, 'Chris', 'Doe', 'chris@dogandrooster.com', 'chris', '$2y$08$4Uvcjq3vXolk2NhFzb2GGu.kmMjbp4nrg7SmOhICYG/VyJku..95a', NULL),
(17, 'Steve', 'ACCOUNT', 'steve7@dogandrooster.com', 'stevetest', '$2y$08$KO6nRlk04vafqkIWk42BhOjbIIS14057mrHOFc0HLcYRm1rKA8eBe', NULL),
(18, 'Jerry', 'Doe', 'test2014@dogandrooster.net', 'test2014@dogandrooster.net', '$2y$08$7WGYQ8aQ3YIOKmgPKogdZuJ86MsqgBRB1LsLublIMlDAWNlbwM1tm', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblclientsbilling`
--

CREATE TABLE `tblclientsbilling` (
  `fldClientsBillingID` int(10) UNSIGNED NOT NULL,
  `fldClientsBillingClientID` varchar(10) DEFAULT NULL,
  `fldClientsBillingFirstname` varchar(250) DEFAULT NULL,
  `fldClientsBillingLastname` varchar(250) DEFAULT NULL,
  `fldClientsBillingAddress` varchar(250) DEFAULT NULL,
  `fldClientsBillingAddress1` varchar(250) DEFAULT NULL,
  `fldClientsBillingCity` varchar(100) DEFAULT NULL,
  `fldClientsBillingState` varchar(100) DEFAULT NULL,
  `fldClientsBillingZip` varchar(100) DEFAULT NULL,
  `fldClientsBillingEmail` varchar(250) DEFAULT NULL,
  `fldClientsBillingPhone` varchar(100) DEFAULT NULL,
  `fldClientsBillingCountry` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblclientsbilling`
--

INSERT INTO `tblclientsbilling` (`fldClientsBillingID`, `fldClientsBillingClientID`, `fldClientsBillingFirstname`, `fldClientsBillingLastname`, `fldClientsBillingAddress`, `fldClientsBillingAddress1`, `fldClientsBillingCity`, `fldClientsBillingState`, `fldClientsBillingZip`, `fldClientsBillingEmail`, `fldClientsBillingPhone`, `fldClientsBillingCountry`) VALUES
(1, '3', 'John', 'Doe', 'Oberlin Drive', '', 'San Diego', 'CA', '92121', 'test1@dogandrooster.net', '123333', 'US'),
(2, '7', 'John', 'Doe', 'Oberlin Drive', NULL, 'San Diego', 'CA', '92121', 'test1@dogandrooster.net', '123', 'US'),
(3, '11', 'steve', 'adams', '1234 main st', 'apt 3', 'san diego', 'CA', '92102', 'steve@dogandrooster.com', '1234567890', 'US'),
(4, '12', 'Angeal', 'Melfi', '888 Happy', '', 'SAN DIEGO', 'CA', '92121', 'angela@dogandrooster.com', '888 888 8888', 'US'),
(5, '14', 'steve1', 'adams', 't', 't', 'test', 'CA', '92102', 'steve1@dogandrooster.com', '1234567890', 'US'),
(6, '16', 'Chris', 'Doe', '456 C Street', NULL, 'San Diego', 'CA', '92024', 'chris@dogandrooster.com', '12334589', 'US'),
(7, '17', 'steve1', 'adams', 't', NULL, 'test', 'CA', '92102', 'steve1@dogandrooster.com', '855555555', 'US');

-- --------------------------------------------------------

--
-- Table structure for table `tblclientsshipping`
--

CREATE TABLE `tblclientsshipping` (
  `fldClientsShippingID` int(10) UNSIGNED NOT NULL,
  `fldClientsShippingClientID` varchar(10) DEFAULT NULL,
  `fldClientsShippingFirstname` varchar(250) DEFAULT NULL,
  `fldClientsShippingLastname` varchar(250) DEFAULT NULL,
  `fldClientsShippingAddress` varchar(250) DEFAULT NULL,
  `fldClientsShippingAddress1` varchar(250) DEFAULT NULL,
  `fldClientsShippingCity` varchar(100) DEFAULT NULL,
  `fldClientsShippingState` varchar(100) DEFAULT NULL,
  `fldClientsShippingZip` varchar(100) DEFAULT NULL,
  `fldClientsShippingEmail` varchar(250) DEFAULT NULL,
  `fldClientsShippingPhone` varchar(250) DEFAULT NULL,
  `fldClientsShippingCountry` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblclientsshipping`
--

INSERT INTO `tblclientsshipping` (`fldClientsShippingID`, `fldClientsShippingClientID`, `fldClientsShippingFirstname`, `fldClientsShippingLastname`, `fldClientsShippingAddress`, `fldClientsShippingAddress1`, `fldClientsShippingCity`, `fldClientsShippingState`, `fldClientsShippingZip`, `fldClientsShippingEmail`, `fldClientsShippingPhone`, `fldClientsShippingCountry`) VALUES
(1, '3', 'John', 'Doe', 'Oberlin Drive', '', 'San Diego', 'CA', '92121', 'test1@dogandrooster.net', '123333', 'US'),
(2, '7', 'John', 'Doe', 'Oberlin Drive', NULL, 'San Diego', 'CA', '92121', 'test1@dogandrooster.net', '123', 'US'),
(3, '11', 'steve', 'adams', '1234 main st', 'apt 3', 'san diego', 'CA', '92102', 'steve@dogandrooster.com', '1234567890', 'US'),
(4, '12', 'Angeal', 'Melfi', '888 Happy', '', 'SAN DIEGO', 'CA', '92121', 'angela@dogandrooster.com', '888 888 8888', 'US'),
(5, '14', 'steve1', 'adams', 't', 't', 'test', 'CA', '92102', 'steve1@dogandrooster.com', '1234567890', 'US'),
(6, '16', 'Chris', 'Doe', '456 C Street', NULL, 'San Diego', 'CA', '92024', 'chris@dogandrooster.com', '12334589', 'US'),
(7, '17', 'steve1', 'adams', 't', NULL, 'test', 'CA', '92102', 'steve1@dogandrooster.com', '855555555', 'US');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontact`
--

CREATE TABLE `tblcontact` (
  `fldContactID` int(10) UNSIGNED NOT NULL,
  `fldContactFirstname` varchar(250) DEFAULT NULL,
  `fldContactLastname` varchar(250) DEFAULT NULL,
  `fldContactSubject` varchar(250) DEFAULT NULL,
  `fldContactComments` text,
  `fldContactEmail` varchar(250) DEFAULT NULL,
  `fldContactPhone` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcontact`
--

INSERT INTO `tblcontact` (`fldContactID`, `fldContactFirstname`, `fldContactLastname`, `fldContactSubject`, `fldContactComments`, `fldContactEmail`, `fldContactPhone`) VALUES
(10, 'John', 'Doe', 'test', '<p>this is a  test</p>', 'test1@dogandrooster.net', '123'),
(11, 'John', 'Doe', 'test', 'this is a test', 'test2@dogandrooster.net', '123'),
(12, 'steve', 'adams', 'test message', 'HI!!!!!', 'steve@dogandrooster.com', '1234567890'),
(13, 'Angela', 'Melfi', 'subject is required', 'comments required test.', 'angela@dogandrooster.com', '888 888 8888'),
(14, 'Chris', 'Doe', 'Test ', '<p>Test</p>', 'chris@dogandrooster.com', '858 1234567'),
(15, 'asd', 'asd', 'asd', 'ads', 'test1@dogandrooster.net', 'asd'),
(16, 'test', 'test', 'test', 'test', 'test1@dogandrooster.net', 'test'),
(17, 'Chris', 'Doe', 'test', '<p>test message FF</p>', 'tes4@dogandrooster.net', '858 234567'),
(18, 'John', 'Doe', 'test', 'test test', 'test1@dogandrooster.net', '123');

-- --------------------------------------------------------

--
-- Table structure for table `tblcouponcode`
--

CREATE TABLE `tblcouponcode` (
  `fldCouponCodeID` int(10) UNSIGNED NOT NULL,
  `fldCouponCodeName` varchar(250) DEFAULT NULL,
  `fldCouponCode` varchar(150) DEFAULT NULL,
  `fldCouponCodeAmount` varchar(150) DEFAULT NULL,
  `fldCouponCodePercentage` varchar(150) DEFAULT NULL,
  `fldCouponCodeIsFreeShipping` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcouponcode`
--

INSERT INTO `tblcouponcode` (`fldCouponCodeID`, `fldCouponCodeName`, `fldCouponCode`, `fldCouponCodeAmount`, `fldCouponCodePercentage`, `fldCouponCodeIsFreeShipping`) VALUES
(2, 'test', 'test1', '', '15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblfedex`
--

CREATE TABLE `tblfedex` (
  `fldFedexID` int(10) UNSIGNED NOT NULL,
  `fldFedexApKey` varchar(250) DEFAULT NULL,
  `fldFedexPassword` varchar(250) DEFAULT NULL,
  `fldFedexAccountNo` varchar(150) DEFAULT NULL,
  `fldFedexMeterNo` varchar(150) DEFAULT NULL,
  `fldFedexAddress` varchar(250) DEFAULT NULL,
  `fldFedexCity` varchar(150) DEFAULT NULL,
  `fldFedexState` varchar(150) DEFAULT NULL,
  `fldFedexZip` varchar(150) DEFAULT NULL,
  `fldFedexCountry` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblfedex`
--

INSERT INTO `tblfedex` (`fldFedexID`, `fldFedexApKey`, `fldFedexPassword`, `fldFedexAccountNo`, `fldFedexMeterNo`, `fldFedexAddress`, `fldFedexCity`, `fldFedexState`, `fldFedexZip`, `fldFedexCountry`) VALUES
(1, 'yOlFkA291x4uK5Ev', 'camrqMM4Yh5GXUZ6eQHA7isMb', '138212017', '103459490', '10 Fed Ex Pkwy', 'Inglewood', 'CA', '90301', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblfooter`
--

CREATE TABLE `tblfooter` (
  `fldFooterID` int(10) UNSIGNED NOT NULL,
  `fldFooterContent` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblfooter`
--

INSERT INTO `tblfooter` (`fldFooterID`, `fldFooterContent`) VALUES
(1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tblgoogle`
--

CREATE TABLE `tblgoogle` (
  `fldGoogleID` int(10) UNSIGNED NOT NULL,
  `fldGoogleAnalytics` varchar(250) DEFAULT NULL,
  `fldGoogleConversion` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblgoogle`
--

INSERT INTO `tblgoogle` (`fldGoogleID`, `fldGoogleAnalytics`, `fldGoogleConversion`) VALUES
(1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblhomeslide`
--

CREATE TABLE `tblhomeslide` (
  `fldHomeSlideID` int(10) UNSIGNED NOT NULL,
  `fldHomeSlideName` varchar(250) DEFAULT NULL,
  `fldHomeSlideDescription` text,
  `fldHomeSlideImage` varchar(250) DEFAULT NULL,
  `fldHomeSlidePosition` int(11) DEFAULT '1',
  `fldHomeSlideLinks` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblhomeslide`
--

INSERT INTO `tblhomeslide` (`fldHomeSlideID`, `fldHomeSlideName`, `fldHomeSlideDescription`, `fldHomeSlideImage`, `fldHomeSlidePosition`, `fldHomeSlideLinks`) VALUES
(7, 'Dog and Rooster Inc.', '<p>Here is the container for slider descriptions...</p>', 'dnr-slider02.jpg', 1, '#'),
(9, 'Dog and Rooster Inc.', '<p>Here is the container for slider descriptions...</p>', 'dnr-slider03.jpg', 2, '#'),
(10, 'Dog and Rooster Inc.', '<p>Here is the container for slider descriptions...</p>', 'dnr-slider04.jpg', 3, '#'),
(11, 'Dog and Rooster Inc.', '<p>Here is the container for slider descriptions...</p>', 'dnr-slider05.jpg', 4, '#'),
(13, 'Dog and Rooster Inc.', '<p>Here is the container for slider descriptions...</p>', 'dnr-slider01.jpg', 1, '#'),
(14, 'Dog and Rooster, Inc,', '<p>Vivamus pulvinar sed sem a consectetur. Mauris sit amet dapibus tortor. \r\nAliquam erat volutpat. Maecenas sed mi ornare augue sollicitudin \r\ntincidunt. Nunc luctus tempus ex vel euismod. Maecenas at scelerisque \r\neros, ut tincidunt nisi. Praesent lacinia dui ac mi ultrices, non tempus\r\n est porttitor.</p>', 'SanDiego.jpg', 5, '#'),
(15, 'Dog and Rooster, Inc.', '<p>Etiam pulvinar sapien vestibulum neque lacinia, a auctor augue \r\nultricies. Pellentesque fermentum pretium nisi, sit amet imperdiet justo\r\n vehicula ut. In congue ultricies metus vitae hendrerit. Vestibulum mi \r\nlectus, mollis in fringilla at, congue vel elit. Pellentesque convallis \r\nnisl enim, ac lacinia eros volutpat vel. Nulla facilisi. Phasellus non \r\nleo nec enim eleifend semper quis eget erat. Quisque imperdiet nulla \r\ndignissim ex suscipit ultricies.</p>', 'SanDiego2.jpg', 6, '#');

-- --------------------------------------------------------

--
-- Table structure for table `tblnews`
--

CREATE TABLE `tblnews` (
  `fldNewsID` int(10) UNSIGNED NOT NULL,
  `fldNewsName` varchar(250) DEFAULT NULL,
  `fldNewsDescription` text,
  `fldNewsNewsDate` date DEFAULT NULL,
  `fldNewsSlug` varchar(250) DEFAULT NULL,
  `fldNewsCategoryID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblnews`
--

INSERT INTO `tblnews` (`fldNewsID`, `fldNewsName`, `fldNewsDescription`, `fldNewsNewsDate`, `fldNewsSlug`, `fldNewsCategoryID`) VALUES
(3, 'Test News 3', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec iaculis malesuada massa auctor tincidunt. Sed pharetra, turpis in lobortis tristique, metus dui venenatis nibh, vitae interdum dui augue sed erat. Aliquam quis dui nec felis semper gravida nec non elit. Maecenas imperdiet odio eget nibh vehicula egestas. Mauris egestas sapien non dolor euismod faucibus. Ut a sem sollicitudin, elementum lectus eu, fringilla nibh. Nunc pretium libero nec turpis blandit elementum. Vestibulum convallis dui sed nunc lacinia vestibulum. Vestibulum et dapibus enim. Nam ac eleifend libero, id vestibulum magna. Maecenas non interdum nisi.</p>\r\n<p>\r\nEtiam nec justo eu turpis rhoncus aliquam. Donec nisi dolor, sodales eu dolor vel, rhoncus condimentum nisi. Maecenas eget quam commodo quam volutpat viverra. Nullam ac erat quis dui volutpat porttitor eget vitae magna. Nulla facilisi. Curabitur malesuada sodales lorem, a sagittis metus eleifend a. Nam pretium mauris at lectus blandit, in scelerisque augue consectetur. Aliquam elementum nisi in ultrices ornare. Nam convallis imperdiet dui vulputate euismod. Nulla facilisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut in dui at urna egestas euismod at quis odio. Aliquam iaculis ac ligula vitae semper. Aenean posuere dolor id eros sodales, at accumsan nibh viverra. Nam suscipit accumsan elit nec cursus. Aliquam at gravida odio, vitae suscipit erat. </p>', '2014-04-12', 'test-news-3', '3'),
(4, 'Test DNR News', '<p>\r\nEtiam pulvinar sapien vestibulum neque lacinia, a auctor augue \r\nultricies. Pellentesque fermentum pretium nisi, sit amet imperdiet justo\r\n vehicula ut. In congue ultricies metus vitae hendrerit. Vestibulum mi \r\nlectus, mollis in fringilla at, congue vel elit. Pellentesque convallis \r\nnisl enim, ac lacinia eros volutpat vel. Nulla facilisi. Phasellus non \r\nleo nec enim eleifend semper quis eget erat. Quisque imperdiet nulla \r\ndignissim ex suscipit ultricies.\r\n</p>\r\n<p>\r\nSed dapibus erat eget enim viverra semper. Phasellus nec arcu ante. \r\nAenean semper porttitor mi a commodo. Duis enim enim, semper quis \r\nviverra consectetur, bibendum eget ex. Integer maximus, orci nec egestas\r\n pretium, nisl dui congue lacus, vel volutpat metus felis sit amet mi. \r\nSed lacinia elementum vestibulum. Proin eleifend porta tempus. Phasellus\r\n tristique quam massa, sed volutpat neque euismod non.\r\n</p>\r\n<p>\r\nSed imperdiet, sem a facilisis facilisis, neque odio ullamcorper mauris,\r\n id dictum ante ipsum non libero. Praesent a ante lobortis, dapibus sem \r\nvitae, condimentum felis. Aliquam facilisis venenatis tincidunt. Cras ut\r\n interdum diam, feugiat tempor purus. Sed sit amet interdum risus, non \r\naliquet enim. Etiam lobortis justo nec magna porttitor, consequat \r\nfermentum neque iaculis. Cras nec convallis est. Nulla tempor velit \r\nnisi, in maximus massa tempor et. Sed feugiat quam a mauris consequat \r\naccumsan. Suspendisse ornare ante ac egestas tincidunt. Interdum et \r\nmalesuada fames ac ante ipsum primis in faucibus. Fusce egestas \r\ncondimentum tortor at laoreet. </p>\r\n<p><img src="http://50.63.185.238/~site/newadmin/_admin/_filemanager/Image/DNR750.250.jpg" alt="" width="750" height="250" /></p>', '2014-11-24', 'test-dnr-news', '7');

-- --------------------------------------------------------

--
-- Table structure for table `tblnewscategory`
--

CREATE TABLE `tblnewscategory` (
  `fldNewsCategoryID` int(10) UNSIGNED NOT NULL,
  `fldNewsCategoryName` varchar(250) DEFAULT NULL,
  `fldNewsCategoryPosition` int(11) DEFAULT NULL,
  `fldNewsCategorySlug` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblnewscategory`
--

INSERT INTO `tblnewscategory` (`fldNewsCategoryID`, `fldNewsCategoryName`, `fldNewsCategoryPosition`, `fldNewsCategorySlug`) VALUES
(1, 'Test 1', 1, 'test-1'),
(2, 'Test 2', 2, 'test-2'),
(3, 'Test 3', 3, 'test-3'),
(4, 'Test 4', 4, 'test-4'),
(6, 'Test 5', 5, 'test-5'),
(7, 'Test DNR News', 6, 'test-dnr-news-1'),
(8, 'test7', 7, 'test7'),
(9, 'test7', 8, 'test7-1'),
(10, 'test', 9, 'test'),
(11, 'test10', 10, 'test10');

-- --------------------------------------------------------

--
-- Table structure for table `tbloptions`
--

CREATE TABLE `tbloptions` (
  `fldOptionsID` int(10) UNSIGNED NOT NULL,
  `fldOptionsName` varchar(1580) DEFAULT NULL,
  `fldOptionsPosition` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbloptions`
--

INSERT INTO `tbloptions` (`fldOptionsID`, `fldOptionsName`, `fldOptionsPosition`) VALUES
(3, 'Color', 1),
(4, 'Size', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbloptionsassets`
--

CREATE TABLE `tbloptionsassets` (
  `fldOptionsAssetsID` int(10) UNSIGNED NOT NULL,
  `fldOptionsAssetsName` varchar(150) DEFAULT NULL,
  `fldOptionsAssetsOptionPrice` varchar(150) DEFAULT NULL,
  `fldOptionsAssetsOptionID` varchar(150) DEFAULT NULL,
  `fldOptionsAssetsPosition` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbloptionsassets`
--

INSERT INTO `tbloptionsassets` (`fldOptionsAssetsID`, `fldOptionsAssetsName`, `fldOptionsAssetsOptionPrice`, `fldOptionsAssetsOptionID`, `fldOptionsAssetsPosition`) VALUES
(1, 'Red', '2', '3', 1),
(2, 'Blue', '2', '3', 2),
(3, 'White', '3', '3', 3),
(9, 'Large', '1', '4', 2),
(11, 'Green', NULL, '3', 4),
(12, 'Small', NULL, '4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `fldPagesID` int(10) UNSIGNED NOT NULL,
  `fldPagesName` varchar(250) DEFAULT NULL,
  `fldPagesDescription` text,
  `fldPagesMetaTitle` text,
  `fldPagesMetaKeywords` text,
  `fldPagesMetaDescription` text,
  `fldPagesSlug` varchar(250) DEFAULT NULL,
  `fldPagesMainID` varchar(10) DEFAULT NULL,
  `fldPagesIsVisible` varchar(10) DEFAULT NULL,
  `fldPagesIsCMS` varchar(10) DEFAULT NULL,
  `fldPagesFilename` varchar(250) DEFAULT NULL,
  `fldPagesPosition` int(11) DEFAULT '1',
  `fldPagesTitle` varchar(250) DEFAULT NULL,
  `fldPagesImage` varchar(250) DEFAULT NULL,
  `fldPagesIsLive` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`fldPagesID`, `fldPagesName`, `fldPagesDescription`, `fldPagesMetaTitle`, `fldPagesMetaKeywords`, `fldPagesMetaDescription`, `fldPagesSlug`, `fldPagesMainID`, `fldPagesIsVisible`, `fldPagesIsCMS`, `fldPagesFilename`, `fldPagesPosition`, `fldPagesTitle`, `fldPagesImage`, `fldPagesIsLive`) VALUES
(32, 'Home', '<h2>Welcome to E-commerce Template 1.0</h2>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dui lorem, sodales sed malesuada id, tempus at eros. Vivamus sit amet ante justo. Suspendisse vitae sem libero. Aliquam nunc urna, tempus eu ornare sit amet, fermentum sit amet urna. Suspendisse lectus enim, gravida id nunc ac, pretium dignissim turpis. Sed feugiat et metus sit amet adipiscing. Cras dictum purus at dui eleifend, eget interdum quam aliquam. Quisque adipiscing, est sed placerat pellentesque, ligula augue pellentesque velit, vel venenatis diam sapien et tellus. Etiam et lacus aliquam, ullamcorper felis eget, posuere risus. Maecenas sit amet vehicula tortor. </p>\r\n<p>Some third party files and plugins are integrated already on the current framework. Others are manually will be integrate if needed on the develoment.</p>', '', '', '', 'home', '0', '1', NULL, '', 1, NULL, NULL, 1),
(33, 'About Us', '<p>about u''s content goes he"re....<img src="http://50.63.185.238/~site/newadmin/_admin/_filemanager/Image/DNR750.250.jpg" alt="" width="750" height="250" /></p>', 'About us', '', '', 'about-us', '0', '1', '1', '', 2, NULL, '', 1),
(34, 'Products', '<p>products</p>', 'Products', '', '', 'products', '0', '1', NULL, 'products/display/products-11', 3, NULL, 'glow.hexagon.green.gradient.white.black.1372x767 (1).jpg', 1),
(35, 'Contact Us', '<p>	\r\n      		Fax: 858-876-1627<br />\r\n            E-mail: info@dogandrooster.com<br />\r\n            Office Location:<br />\r\n            5820 Oberlin Drive, Suite 105,<br />\r\n            San Diego, CA 92121</p>', 'Contact us', '', '', 'contact-us', '0', '1', '1', 'contact-us', 6, NULL, NULL, 1),
(36, 'Privacy Policy', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dui lorem, sodales sed malesuada id, tempus at eros. Vivamus sit amet ante justo. Suspendisse vitae sem libero. Aliquam nunc urna, tempus eu ornare sit amet, fermentum sit amet urna. Suspendisse lectus enim, gravida id nunc ac, pretium dignissim turpis. Sed feugiat et metus sit amet adipiscing. Cras dictum purus at dui eleifend, eget interdum quam aliquam. Quisque adipiscing, est sed placerat pellentesque, ligula augue pellentesque velit, vel venenatis diam sapien et tellus. Etiam et lacus aliquam, ullamcorper felis eget, posuere risus. Maecenas sit amet vehicula tortor. </p>\r\n<p>Some third party files and plugins are integrated already on the current framework. Others are manually will be integrate if needed on the develoment.</p>', 'Privacy Policy', '', '', 'privacy-policy', NULL, NULL, '1', '', 1, NULL, NULL, 1),
(37, 'Return & Refund Policy', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dui lorem, sodales sed malesuada id, tempus at eros. Vivamus sit amet ante justo. Suspendisse vitae sem libero. Aliquam nunc urna, tempus eu ornare sit amet, fermentum sit amet urna. Suspendisse lectus enim, gravida id nunc ac, pretium dignissim turpis. Sed feugiat et metus sit amet adipiscing. Cras dictum purus at dui eleifend, eget interdum quam aliquam. Quisque adipiscing, est sed placerat pellentesque, ligula augue pellentesque velit, vel venenatis diam sapien et tellus. Etiam et lacus aliquam, ullamcorper felis eget, posuere risus. Maecenas sit amet vehicula tortor. </p>\r\n<p>Some third party files and plugins are integrated already on the current framework. Others are manually will be integrate if needed on the develoment.</p>', 'Return & Refund Policy', '', '', 'return-refund-policy', NULL, NULL, '1', '', 1, NULL, NULL, 1),
(38, 'Shipping Policy', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dui lorem, sodales sed malesuada id, tempus at eros. Vivamus sit amet ante justo. Suspendisse vitae sem libero. Aliquam nunc urna, tempus eu ornare sit amet, fermentum sit amet urna. Suspendisse lectus enim, gravida id nunc ac, pretium dignissim turpis. Sed feugiat et metus sit amet adipiscing. Cras dictum purus at dui eleifend, eget interdum quam aliquam. Quisque adipiscing, est sed placerat pellentesque, ligula augue pellentesque velit, vel venenatis diam sapien et tellus. Etiam et lacus aliquam, ullamcorper felis eget, posuere risus. Maecenas sit amet vehicula tortor. </p>\r\n<p>Some third party files and plugins are integrated already on the current framework. Others are manually will be integrate if needed on the develoment.</p>', 'Shipping Policy', '', '', 'shipping-policy', NULL, NULL, '1', '', 1, NULL, NULL, 1),
(39, 'About Us 1.1', '<p>test test test</p>', '', '', '', 'about-us-11', '33', '1', '1', '', 4, NULL, NULL, 1),
(40, 'About us 1.2', '<p>this is a test</p>', '', '', '', 'about-us-12', '33', '1', '1', '', 3, NULL, 'header.jpg', 1),
(41, 'About us 1.1.1', '<p>this is a test</p>', '', '', '', 'about-us-111', '39', '1', '1', '', 1, NULL, NULL, 0),
(42, 'About us 1.1.2', '<p>test test test</p>', '', '', '', 'about-us-112', '39', '1', '1', '', 2, NULL, NULL, 1),
(43, 'About us 1.3', '<p>test test</p>', '', '', '', 'about-us-13', '33', '1', '1', '', 5, NULL, NULL, 1),
(44, 'Thank you', '<p>Thank you for registration content goes here</p>', '', '', '', 'thank-you', '0', NULL, NULL, '', 7, NULL, NULL, 1),
(45, 'Forgot Password', '<p>Your password reset link has been sent to your email on file. Please check your inbox for this email. If you do not receive it please make sure to check your Spam or Junk folders.</p>', '', '', '', 'forgot-password', '0', NULL, NULL, '', 8, NULL, '', 1),
(46, 'Reset Password', '<p>Reset Password content goes here</p>', '', '', '', 'reset-password', '0', NULL, NULL, '', 9, NULL, NULL, 1),
(47, 'Payment', '<p>Thank you for your payment. Our representative will contact you as soon as possible</p>', '', '', '', 'payment', '0', NULL, '1', '', 10, NULL, NULL, 1),
(48, 'Declined', '<p>Sorry your card has been declined</p>', '', '', '', 'declined', '0', NULL, '1', '', 11, NULL, NULL, 1),
(49, 'Paypal', '<p>Thank you payment message for paypal goes here</p>', '', '', '', 'paypal', '0', NULL, '1', '', 12, NULL, NULL, 1),
(50, 'Thank you - contact', 'Thank you for contacting us. Our representative will contact you as soon as possible', NULL, NULL, NULL, 'contact-us-thankyou', NULL, NULL, '1', NULL, 1, NULL, NULL, 1),
(51, 'News', '<p>test</p>', 'News', '', '', 'news', '0', '1', NULL, 'news', 4, NULL, NULL, 1),
(52, 'About us 1.1.3', '<p>this is a test</p>', NULL, NULL, NULL, 'about-us-113', '39', '1', '1', '', 3, NULL, NULL, 1),
(55, 'Registration', '<p>Registration content goes here</p>', NULL, NULL, NULL, 'registration', '0', NULL, '1', '', 13, NULL, NULL, 1),
(56, 'Gallery', '<p>Photo Gallery</p>', NULL, NULL, NULL, 'gallery', '0', '1', NULL, 'photo-gallery', 5, NULL, NULL, 1),
(57, 'Staff', '<p>Staff</p>', NULL, NULL, NULL, 'staff', '0', '1', '1', 'staff-gallery', 6, NULL, NULL, 1),
(58, 'Whats Happening', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio digna</p>', NULL, NULL, NULL, 'whats-happening', '0', NULL, '1', '', 14, NULL, '1-4-1-CatSummerPool-750x250.jpg', 1),
(59, 'About us 1.4', '<p>test test</p>', NULL, NULL, NULL, 'about-us-14', '33', '1', '1', '', 2, NULL, NULL, 1),
(61, 'Blog Test', '<p>Vivamus pulvinar sed sem a consectetur. Mauris sit amet dapibus tortor. \r\nAliquam erat volutpat. Maecenas sed mi ornare augue sollicitudin \r\ntincidunt. Nunc luctus tempus ex vel euismod. Maecenas at scelerisque \r\neros, ut tincidunt nisi. Praesent lacinia dui ac mi ultrices, non tempus\r\n est porttitor.</p>', NULL, NULL, NULL, 'blog-test', '0', '1', '1', '', 15, NULL, 'blog.jpg', 1),
(62, 'About  Us DNR', '<p>Sed imperdiet, sem a facilisis facilisis, neque odio ullamcorper mauris,\r\n id dictum ante ipsum non libero. Praesent a ante lobortis, dapibus sem \r\nvitae, condimentum felis. Aliquam facilisis venenatis tincidunt. Cras ut\r\n interdum diam, feugiat tempor purus. Sed sit amet interdum risus, non \r\naliquet enim. Etiam lobortis justo nec magna porttitor, consequat \r\nfermentum neque iaculis. Cras nec convallis est. Nulla tempor velit \r\nnisi, in maximus massa tempor et. Sed feugiat quam a mauris consequat \r\naccumsan. Suspendisse ornare ante ac egestas tincidunt. Interdum et \r\nmalesuada fames ac ante ipsum primis in faucibus. Fusce egestas \r\ncondimentum tortor at laoreet.</p>\r\n<p>&nbsp;</p>\r\n<p><img style="display: block; margin-left: auto; margin-right: auto;" src="http://50.63.185.238/~site/newadmin/_admin/_filemanager/Image/webdev1.jpg" alt="" width="300" height="200" /></p>', NULL, NULL, NULL, 'about-us-dnr', '33', '1', '1', '', 1, NULL, 'DNR750.250.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpagespreview`
--

CREATE TABLE `tblpagespreview` (
  `fldPagesPreviewID` int(10) UNSIGNED NOT NULL,
  `fldPagesPreviewName` varchar(250) DEFAULT NULL,
  `fldPagesPreviewDescription` text,
  `fldPagesPreviewMetaTitle` text,
  `fldPagesPreviewMetaKeywords` text,
  `fldPagesPreviewMetaDescription` text,
  `fldPagesPreviewSlug` varchar(250) DEFAULT NULL,
  `fldPagesPreviewMainID` varchar(10) DEFAULT NULL,
  `fldPagesPreviewIsVisible` varchar(10) DEFAULT NULL,
  `fldPagesPreviewIsCMS` varchar(10) DEFAULT NULL,
  `fldPagesPreviewFilename` varchar(250) DEFAULT NULL,
  `fldPagesPreviewPosition` int(11) DEFAULT '1',
  `fldPagesPreviewTitle` varchar(250) DEFAULT NULL,
  `fldPagesPreviewImage` varchar(250) DEFAULT NULL,
  `fldPagesPreviewIsLive` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpagespreview`
--

INSERT INTO `tblpagespreview` (`fldPagesPreviewID`, `fldPagesPreviewName`, `fldPagesPreviewDescription`, `fldPagesPreviewMetaTitle`, `fldPagesPreviewMetaKeywords`, `fldPagesPreviewMetaDescription`, `fldPagesPreviewSlug`, `fldPagesPreviewMainID`, `fldPagesPreviewIsVisible`, `fldPagesPreviewIsCMS`, `fldPagesPreviewFilename`, `fldPagesPreviewPosition`, `fldPagesPreviewTitle`, `fldPagesPreviewImage`, `fldPagesPreviewIsLive`) VALUES
(32, 'Home', '<h2>Welcome to E-commerce Template 1.0</h2>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dui lorem, sodales sed malesuada id, tempus at eros. Vivamus sit amet ante justo. Suspendisse vitae sem libero. Aliquam nunc urna, tempus eu ornare sit amet, fermentum sit amet urna. Suspendisse lectus enim, gravida id nunc ac, pretium dignissim turpis. Sed feugiat et metus sit amet adipiscing. Cras dictum purus at dui eleifend, eget interdum quam aliquam. Quisque adipiscing, est sed placerat pellentesque, ligula augue pellentesque velit, vel venenatis diam sapien et tellus. Etiam et lacus aliquam, ullamcorper felis eget, posuere risus. Maecenas sit amet vehicula tortor. </p>\r\n<p>Some third party files and plugins are integrated already on the current framework. Others are manually will be integrate if needed on the develoment.</p>', '', '', '', 'home', '0', '1', NULL, '', 2, NULL, NULL, 1),
(33, 'About Us', '<p>about us content goes here</p>', 'About us', '', '', 'about-us', '0', '1', '1', '', 3, NULL, NULL, 1),
(34, 'Products', '<p>Suspendisse potenti. Suspendisse vehicula nisl sit amet sem varius, ac \r\negestas nunc consequat. In id eros ultrices, sodales leo nec, ultrices \r\nsapien. Pellentesque vel ex sollicitudin, tincidunt est nec, elementum \r\nneque. Nulla rutrum odio ex, et fringilla diam mollis eu. Mauris quis \r\ncongue urna. Phasellus pellentesque lectus dapibus, ornare diam id, \r\nsemper nisi. Suspendisse at efficitur nunc, eu auctor libero.</p>', 'Products', '', '', 'products', '0', '1', NULL, 'products/display/products-11', 1, NULL, 'web-development.jpg', 1),
(35, 'Contact Us', '<p>	\r\n      		Fax: 858-876-1627<br />\r\n            E-mail: info@dogandrooster.com<br />\r\n            Office Location:<br />\r\n            5820 Oberlin Drive, Suite 105,<br />\r\n            San Diego, CA 92121</p>', 'Contact us', '', '', 'contact-us', '0', '1', NULL, 'contact-us', 6, NULL, NULL, 1),
(36, 'Privacy Policy', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dui lorem, sodales sed malesuada id, tempus at eros. Vivamus sit amet ante justo. Suspendisse vitae sem libero. Aliquam nunc urna, tempus eu ornare sit amet, fermentum sit amet urna. Suspendisse lectus enim, gravida id nunc ac, pretium dignissim turpis. Sed feugiat et metus sit amet adipiscing. Cras dictum purus at dui eleifend, eget interdum quam aliquam. Quisque adipiscing, est sed placerat pellentesque, ligula augue pellentesque velit, vel venenatis diam sapien et tellus. Etiam et lacus aliquam, ullamcorper felis eget, posuere risus. Maecenas sit amet vehicula tortor. </p>\r\n<p>Some third party files and plugins are integrated already on the current framework. Others are manually will be integrate if needed on the develoment.</p>', 'Privacy Policy', '', '', 'privacy-policy', NULL, NULL, '1', '', 1, NULL, NULL, 1),
(37, 'Return & Refund Policy', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dui lorem, sodales sed malesuada id, tempus at eros. Vivamus sit amet ante justo. Suspendisse vitae sem libero. Aliquam nunc urna, tempus eu ornare sit amet, fermentum sit amet urna. Suspendisse lectus enim, gravida id nunc ac, pretium dignissim turpis. Sed feugiat et metus sit amet adipiscing. Cras dictum purus at dui eleifend, eget interdum quam aliquam. Quisque adipiscing, est sed placerat pellentesque, ligula augue pellentesque velit, vel venenatis diam sapien et tellus. Etiam et lacus aliquam, ullamcorper felis eget, posuere risus. Maecenas sit amet vehicula tortor. </p>\r\n<p>Some third party files and plugins are integrated already on the current framework. Others are manually will be integrate if needed on the develoment.</p>', 'Return & Refund Policy', '', '', 'return-refund-policy', NULL, NULL, '1', '', 1, NULL, NULL, 1),
(38, 'Shipping Policy', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dui lorem, sodales sed malesuada id, tempus at eros. Vivamus sit amet ante justo. Suspendisse vitae sem libero. Aliquam nunc urna, tempus eu ornare sit amet, fermentum sit amet urna. Suspendisse lectus enim, gravida id nunc ac, pretium dignissim turpis. Sed feugiat et metus sit amet adipiscing. Cras dictum purus at dui eleifend, eget interdum quam aliquam. Quisque adipiscing, est sed placerat pellentesque, ligula augue pellentesque velit, vel venenatis diam sapien et tellus. Etiam et lacus aliquam, ullamcorper felis eget, posuere risus. Maecenas sit amet vehicula tortor. </p>\r\n<p>Some third party files and plugins are integrated already on the current framework. Others are manually will be integrate if needed on the develoment.</p>', 'Shipping Policy', '', '', 'shipping-policy', NULL, NULL, '1', '', 1, NULL, NULL, 1),
(39, 'About Us 1.1', '<p>test test test</p>', '', '', '', 'about-us-11', '33', '1', '1', '', 3, NULL, NULL, 1),
(40, 'About us 1.2', '<p>this is a test</p>', '', '', '', 'about-us-12', '33', '1', '1', '', 2, NULL, 'header.jpg', 1),
(41, 'About us 1.1.1', '<p><img src="../../../_admin/_filemanager/Image/DNR750.250.jpg" alt="" width="750" height="250" /></p>\r\n<p>this is a test</p>', '', '', '', 'about-us-111', '39', '1', '1', '', 1, NULL, NULL, 1),
(42, 'About us 1.1.2', '<p>test test test</p>', '', '', '', 'about-us-112', '39', '1', '1', '', 2, NULL, NULL, 1),
(43, 'About us 1.3', '<p>test test</p>', '', '', '', 'about-us-13', '33', '1', '1', '', 4, NULL, NULL, 1),
(44, 'Thank you', '<p>Thank you for registration content goes here</p>', '', '', '', 'thank-you', '0', NULL, NULL, '', 8, NULL, NULL, 1),
(45, 'Forgot Password', '<p>Your password reset link has been sent to your email on file. Please check your inbox for this email. If you do not receive it please make sure to check your Spam or Junk folders.</p>', '', '', '', 'forgot-password', '0', NULL, NULL, '', 9, NULL, NULL, 1),
(46, 'Reset Password', '<p>Reset Password content goes here</p>', '', '', '', 'reset-password', '0', NULL, NULL, '', 10, NULL, NULL, 1),
(47, 'Payment', '<p>Thank you for your payment. Our representative will contact you as soon as possible</p>', '', '', '', 'payment', '0', NULL, '1', '', 11, NULL, NULL, 1),
(48, 'Declined', '<p>Sorry your card has been declined</p>', '', '', '', 'declined', '0', NULL, '1', '', 12, NULL, NULL, 1),
(49, 'Paypal', '<p>Thank you payment message for paypal goes here</p>', '', '', '', 'paypal', '0', NULL, '1', '', 13, NULL, NULL, 1),
(50, 'Thank you - contact', 'Thank you for contacting us. Our representative will contact you as soon as possible', NULL, NULL, NULL, 'contact-us-thankyou', NULL, NULL, '1', NULL, 1, NULL, NULL, 1),
(51, 'News', '<p>test</p>', 'News', '', '', 'news', '0', '1', NULL, 'news', 4, NULL, NULL, 1),
(52, 'About us 1.1.3', '<p>this is a test</p>', NULL, NULL, NULL, 'about-us-113', '39', '1', '1', '', 3, NULL, NULL, 1),
(55, 'Registration', '<p>Registration content goes here</p>', NULL, NULL, NULL, 'registration', '0', NULL, '1', '', 14, NULL, NULL, 1),
(56, 'Gallery', '<p>Photo Gallery</p>', NULL, NULL, NULL, 'gallery', '0', '1', NULL, 'photo-gallery', 5, NULL, NULL, 1),
(57, 'Staff', '<p>Staff</p>', NULL, NULL, NULL, 'staff', '0', '1', NULL, 'staff-gallery', 7, NULL, NULL, 1),
(58, 'Whats Happening', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio digna</p>', NULL, NULL, NULL, 'whats-happening', '0', NULL, '1', '', 15, NULL, NULL, 1),
(59, 'About us 1.4', '<p>test test</p>', NULL, NULL, NULL, 'about-us-14', '33', '1', '1', '', 1, NULL, NULL, 1),
(60, 'About us 1.5', '<p>test </p>', NULL, NULL, NULL, 'about-us-15', '33', '1', '1', '', 5, NULL, 'header.jpg', 1),
(61, 'Blog Test', '<p>Vivamus pulvinar sed sem a consectetur. Mauris sit amet dapibus tortor. \r\nAliquam erat volutpat. Maecenas sed mi ornare augue sollicitudin \r\ntincidunt. Nunc luctus tempus ex vel euismod. Maecenas at scelerisque \r\neros, ut tincidunt nisi. Praesent lacinia dui ac mi ultrices, non tempus\r\n est porttitor.</p>', NULL, NULL, NULL, 'blog-test', '0', '1', '1', '', 16, NULL, 'blog.jpg', 1),
(62, 'About  Us DNR', '<p>Sed imperdiet, sem a facilisis facilisis, neque odio ullamcorper mauris,\r\n id dictum ante ipsum non libero. Praesent a ante lobortis, dapibus sem \r\nvitae, condimentum felis. Aliquam facilisis venenatis tincidunt. Cras ut\r\n interdum diam, feugiat tempor purus. Sed sit amet interdum risus, non \r\naliquet enim. Etiam lobortis justo nec magna porttitor, consequat \r\nfermentum neque iaculis. Cras nec convallis est. Nulla tempor velit \r\nnisi, in maximus massa tempor et. Sed feugiat quam a mauris consequat \r\naccumsan. Suspendisse ornare ante ac egestas tincidunt. Interdum et \r\nmalesuada fames ac ante ipsum primis in faucibus. Fusce egestas \r\ncondimentum tortor at laoreet.</p>', NULL, NULL, NULL, 'about-us-dnr', '33', NULL, NULL, '', 17, NULL, 'DNR750.250.jpg', 1),
(63, 'Test page', '<p>test</p>\r\n<p><img src="http://50.63.185.238/~site/newadmin/_admin/_filemanager/Image/sample.jpeg" alt="" width="274" height="184" /></p>', NULL, NULL, NULL, 'test-page', '0', NULL, NULL, 'test', 17, NULL, 'glow.hexagon.green.gradient.white.black.1372x767 (1).jpg', 1),
(64, 'test', '<p>test test</p>', NULL, NULL, NULL, 'test', '0', NULL, NULL, '', 17, NULL, '', 1),
(65, 'About Us 1.6', '<p>this is a test</p>', NULL, NULL, NULL, 'about-us-16', '33', '1', '1', '', 17, NULL, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpayment`
--

CREATE TABLE `tblpayment` (
  `fldPaymentID` int(10) UNSIGNED NOT NULL,
  `fldPaymentName` varchar(150) DEFAULT NULL,
  `fldPaymentIsActive` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpayment`
--

INSERT INTO `tblpayment` (`fldPaymentID`, `fldPaymentName`, `fldPaymentIsActive`) VALUES
(1, 'Authorize.net', '1'),
(2, 'Paypal', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tblpaypal`
--

CREATE TABLE `tblpaypal` (
  `fldPaypalID` int(10) UNSIGNED NOT NULL,
  `fldPaypalEmail` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpaypal`
--

INSERT INTO `tblpaypal` (`fldPaypalID`, `fldPaypalEmail`) VALUES
(1, 'ebmarcilla@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tblphotogallery`
--

CREATE TABLE `tblphotogallery` (
  `fldPhotoGalleryID` int(10) UNSIGNED NOT NULL,
  `fldPhotoGalleryName` varchar(250) DEFAULT NULL,
  `fldPhotoGalleryDescription` text,
  `fldPhotoGalleryImage` varchar(250) DEFAULT NULL,
  `fldPhotoGalleryPosition` int(11) DEFAULT NULL,
  `fldPhotoGallerySlug` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblphotogallery`
--

INSERT INTO `tblphotogallery` (`fldPhotoGalleryID`, `fldPhotoGalleryName`, `fldPhotoGalleryDescription`, `fldPhotoGalleryImage`, `fldPhotoGalleryPosition`, `fldPhotoGallerySlug`) VALUES
(17, 'Test Gallery 1', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed\r\n diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam \r\nerat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation \r\nullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>', 'photo-gallery01.jpg', 2, 'test-gallery-1-1'),
(21, 'Gallery Sample 01', '<p>Sample gallery only.</p>', 'photo-gallery07.jpg', 1, 'gallery-sample-01-1'),
(33, 'test', '<p>Sample gallery only.</p>', 'photo-gallery02.jpg', 3, 'test-1'),
(34, 'DNR', '<p>Sed dapibus erat eget enim viverra semper. Phasellus nec arcu ante. \r\nAenean semper porttitor mi a commodo. Duis enim enim, semper quis \r\nviverra consectetur, bibendum eget ex. Integer maximus, orci nec egestas\r\n pretium, nisl dui congue lacus, vel volutpat metus felis sit amet mi. \r\nSed lacinia elementum vestibulum. Proin eleifend porta tempus. Phasellus\r\n tristique quam massa, sed volutpat neque euismod non.</p>', 'DNRGallery1.jpg', 4, 'dnr-1');

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `fldProductID` int(11) UNSIGNED NOT NULL,
  `fldProductName` varchar(250) DEFAULT NULL,
  `fldProductPrice` varchar(100) DEFAULT NULL,
  `fldProductWeight` varchar(100) DEFAULT NULL,
  `fldProductDescription` text,
  `fldProductImage` varchar(250) DEFAULT NULL,
  `fldProductPosition` int(11) DEFAULT '1',
  `fldProductIsNew` varchar(10) DEFAULT NULL,
  `fldProductIsFeatured` varchar(10) DEFAULT NULL,
  `fldProductOldPrice` varchar(150) DEFAULT NULL,
  `fldProductSlug` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`fldProductID`, `fldProductName`, `fldProductPrice`, `fldProductWeight`, `fldProductDescription`, `fldProductImage`, `fldProductPosition`, `fldProductIsNew`, `fldProductIsFeatured`, `fldProductOldPrice`, `fldProductSlug`) VALUES
(2, 'Test Products', '150', '5', '<p>test test</p>', 'ajaxslide-01-jpg.jpg', 1, NULL, '1', '250', 'test-products-1'),
(3, 'Test Products 1', '120', '2', '<p>trest</p>', 'ajaxslide-01-jpg.jpg', 1, '1', '1', '150', 'test-products-1'),
(4, 'Test Products 2', '50', '2', '<p>test test</p>', 'ajaxslide-01-jpg.jpg', 1, '1', '1', '75', 'test-products-2'),
(5, 'Test Products 3', '120', '3', '<p>tes test</p>', 'ajaxslide-01-jpg.jpg', 1, NULL, '1', '100', 'test-products-3-1'),
(6, 'Test Product 4', '100', '2', '<p>test</p>', 'ajaxslide-01-jpg.jpg', 20, NULL, NULL, '50', 'test-product-4-1'),
(7, 'Test', '5', '15 lbs', '<p>tesssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>EGwegewGEWwgewgWGEWGwgewgew</li>\r\n<li>egEWWWWWWWWWWWWWWWWWWWWWWW</li>\r\n<li>ewgWWWWWWWWWWWWWWWWWWW</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>17:58:38</p>\r\n<p>2014-05-14</p>\r\n<h1><strong>ewgfEGwehbWGewf eT4BTt<span style="white-space: pre;">	</span>T2W<span style="white-space: pre;">											</span>efeefffffffffffffffffffffffffffffffffffffffffffffffffff</strong></h1>\r\n<p style="text-align: center;"><strong>fefEWFwfEWf</strong></p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;"><strong>http://50.63.185.238/~site/newadmin/dnradmin/products/new<br /></strong></p>', NULL, 1, NULL, '1', '7', 'test-2'),
(8, 'Test', '7', '15 lbs', '<p>tesssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="text-align: center;"><strong><br /></strong></p>', NULL, 1, '1', '1', '5', 'test'),
(9, 'DNR TEST Product', '5', '1 lb', '<p><span>I entered info for a new product - then chose cat Test 1 and selected to add new sub cat and I was taken to another product/subcat page. I entered info in and clicked save and it seemed to erase my original product info. I went to the product overview and it''s there but I cannot open the folder or pencil to edit</span></p>\r\n<p><span><span>I entered info for a new product - then chose cat Test 1 and selected to add new sub cat and I was taken to another product/subcat page. I entered info in and clicked save and it seemed to erase my original product info. I went to the product overview and it''s there but I cannot open the folder or pencil to edit</span></span></p>\r\n<p><span><span><span>I entered info for a new product - then chose cat Test 1 and selected to add new sub cat and I was taken to another product/subcat page. I entered info in and clicked save and it seemed to erase my original product info. I went to the product overview and it''s there but I cannot open the folder or pencil to edit</span></span></span></p>\r\n<p><span><span><span><span>I entered info for a new product - then chose cat Test 1 and selected to add new sub cat and I was taken to another product/subcat page. I entered info in and clicked save and it seemed to erase my original product info. I went to the product overview and it''s there but I cannot open the folder or pencil to edit</span></span></span></span></p>\r\n<p><span><span><span><span><span>I entered info for a new product - then chose cat Test 1 and selected to add new sub cat and I was taken to another product/subcat page. I entered info in and clicked save and it seemed to erase my original product info. I went to the product overview and it''s there but I cannot open the folder or pencil to edit</span></span></span></span></span></p>\r\n<p><span><span><span><span><span><span>I entered info for a new product - then chose cat Test 1 and selected to add new sub cat and I was taken to another product/subcat page. I entered info in and clicked save and it seemed to erase my original product info. I went to the product overview and it''s there but I cannot open the folder or pencil to edit</span></span></span></span></span></span></p>\r\n<p><span><span><span><span><span><span><span>I entered info for a new product - then chose cat Test 1 and selected to add new sub cat and I was taken to another product/subcat page. I entered info in and clicked save and it seemed to erase my original product info. I went to the product overview and it''s there but I cannot open the folder or pencil to edit</span></span></span></span></span></span></span></p>\r\n<p><span><span><span><span><span><span><span><span>I entered info for a new product - then chose cat Test 1 and selected to add new sub cat and I was taken to another product/subcat page. I entered info in and clicked save and it seemed to erase my original product info. I went to the product overview and it''s there but I cannot open the folder or pencil to edit</span></span></span></span></span></span></span></span></p>\r\n<p><span><span><span><span><span><span><span><span><span>I entered info for a new product - then chose cat Test 1 and selected to add new sub cat and I was taken to another product/subcat page. I entered info in and clicked save and it seemed to erase my original product info. I went to the product overview and it''s there but I cannot open the folder or pencil to edit</span></span></span></span></span></span></span></span></span></p>\r\n<p><span><span><span><span><span><span><span><span><span><span>I entered info for a new product - then chose cat Test 1 and selected to add new sub cat and I was taken to another product/subcat page. I entered info in and clicked save and it seemed to erase my original product info. I went to the product overview and it''s there but I cannot open the folder or pencil to edit</span></span></span></span></span></span></span></span></span></span></p>\r\n<p><span><span><span><span><span><span><span><span><span><span><span>I entered info for a new product - then chose cat Test 1 and selected to add new sub cat and I was taken to another product/subcat page. I entered info in and clicked save and it seemed to erase my original product info. I went to the product overview and it''s there but I cannot open the folder or pencil to edit</span></span></span></span></span></span></span></span></span></span></span></p>\r\n<p><span><span><span><span><span><span><span><span><span><span><span><span>I entered info for a new product - then chose cat Test 1 and selected to add new sub cat and I was taken to another product/subcat page. I entered info in and clicked save and it seemed to erase my original product info. I went to the product overview and it''s there but I cannot open the folder or pencil to edit</span></span></span></span></span></span></span></span></span></span></span></span></p>\r\n<p><span><span><span><span><span><span><span><span><span><span><span><span><br /></span></span></span></span></span></span></span></span></span></span></span></span></p>', '_75_Category_spxmayd.jpg', 1, NULL, '1', '500', 'dnr-test-product-1'),
(10, 'Test Shoes', '250', '3', '<p>test test</p>', NULL, 2, NULL, NULL, '500', 'test-shoes'),
(12, 'Test Shoes 2', '100', '1', '<p>test</p>', NULL, 1, NULL, NULL, '5', 'test-shoes-2-1'),
(13, 'Test Shoes 3', '50', '1', '<p>test</p>', NULL, 3, NULL, NULL, '100', 'test-shoes-3'),
(14, 'Test Shoes 3', '50', '1', '<p>test</p>', NULL, 4, NULL, NULL, '100', 'test-shoes-3-1'),
(15, 'Test Shoes 3', '50', '1', '<p>test</p>', NULL, 5, NULL, NULL, '100', 'test-shoes-3-2'),
(16, 'Test Shoes 3', '50', '1', '<p>test</p>', NULL, 6, NULL, NULL, '100', 'test-shoes-3-3'),
(17, 'Test Shoes 3', '50', '1', '<p>test</p>', NULL, 7, NULL, NULL, '100', 'test-shoes-3-4'),
(18, 'Test Shoes 3', '50', '1', '<p>test</p>', 'shoes.jpg', 19, NULL, NULL, '100', '5'),
(19, 'Test Shoes 4', '10', '1', '<p>test tet</p>', 'shoes.jpg', 8, NULL, NULL, '50', 'test-shoes-4-1'),
(20, 'Test 3', '2', '4', '<p>test</p>', 'shoes.jpg', 9, NULL, NULL, '5', 'test-3'),
(21, 'Test 10', '2', '1', '<p>tgeasr</p>', 'shoes.jpg', 10, NULL, NULL, '10', 'test-10'),
(22, 'Test 10', '2', '1', '<p>tgeasr</p>', 'shoes.jpg', 11, NULL, NULL, '10', 'test-10-1'),
(23, 'Test 10', '2', '1', '<p>tgeasr</p>', 'shoes.jpg', 12, NULL, NULL, '10', 'test-10-2'),
(24, 'Test 11', '25', '2', '<p>test test</p>', 'shoes.jpg', 13, NULL, NULL, '100', 'test-11'),
(25, 'Test 11', '25', '2', '<p>test test</p>', 'shoes.jpg', 14, NULL, NULL, '100', 'test-11-1'),
(26, 'Test 11', '25', '2', '<p>test test</p>', 'shoes.jpg', 15, NULL, NULL, '100', 'test-11-2'),
(32, 'testtest', '20', '1', '<p>test test</p>', NULL, 1, NULL, NULL, '50', 'testtest'),
(33, 'testtest', '20', '1', '<p>test test</p>', NULL, 1, NULL, NULL, '50', 'testtest-1'),
(34, 'test', '5', '1', '<p>test</p>', 'shoes.jpg', 16, NULL, NULL, '10', 'test-7'),
(35, 'test', '5', '1', '<p>test</p>', 'shoes.jpg', 17, NULL, NULL, '10', 'test-8'),
(36, 'test', '5', '1', '<p>test</p>', 'shoes.jpg', 18, NULL, NULL, '10', 'test-9'),
(37, 'Web Dev Product 1', '50', '5', '<p>Suspendisse potenti. Suspendisse vehicula nisl sit amet sem varius, ac \r\negestas nunc consequat. In id eros ultrices, sodales leo nec, ultrices \r\nsapien. Pellentesque vel ex sollicitudin, tincidunt est nec, elementum \r\nneque. Nulla rutrum odio ex, et fringilla diam mollis eu. Mauris quis \r\ncongue urna. Phasellus pellentesque lectus dapibus, ornare diam id, \r\nsemper nisi. Suspendisse at efficitur nunc, eu auctor libero.</p>', NULL, 1, NULL, '1', '75', 'web-dev-product-1'),
(38, 'Web Dev Product 1', '50', '5', '<p>Suspendisse potenti. Suspendisse vehicula nisl sit amet sem varius, ac \r\negestas nunc consequat. In id eros ultrices, sodales leo nec, ultrices \r\nsapien. Pellentesque vel ex sollicitudin, tincidunt est nec, elementum \r\nneque. Nulla rutrum odio ex, et fringilla diam mollis eu. Mauris quis \r\ncongue urna. Phasellus pellentesque lectus dapibus, ornare diam id, \r\nsemper nisi. Suspendisse at efficitur nunc, eu auctor libero.</p>', NULL, 1, NULL, NULL, '75', 'web-dev-product-1-1'),
(39, 'Product 1', '65', '5', '<p><img src="../../_admin/_filemanager/Image/webdev1.jpg" alt="" width="300" height="200" /></p>', NULL, 1, NULL, '1', '100', 'product-1'),
(40, 'Product 1 Web Dev ', '100', '6', '<p>Etiam pulvinar sapien vestibulum neque lacinia, a auctor augue \r\nultricies. Pellentesque fermentum pretium nisi, sit amet imperdiet justo\r\n vehicula ut. In congue ultricies metus vitae hendrerit. Vestibulum mi \r\nlectus, mollis in fringilla at, congue vel elit. Pellentesque convallis \r\nnisl enim, ac lacinia eros volutpat vel. Nulla facilisi. Phasellus non \r\nleo nec enim eleifend semper quis eget erat. Quisque imperdiet nulla \r\ndignissim ex suscipit ultricies.</p>', NULL, 1, NULL, NULL, '300', 'product-1-web-dev'),
(41, 'Product 1 Web Dev ', '300', '6', '<p>Etiam pulvinar sapien vestibulum neque lacinia, a auctor augue \r\nultricies. Pellentesque fermentum pretium nisi, sit amet imperdiet justo\r\n vehicula ut. In congue ultricies metus vitae hendrerit. Vestibulum mi \r\nlectus, mollis in fringilla at, congue vel elit. Pellentesque convallis \r\nnisl enim, ac lacinia eros volutpat vel. Nulla facilisi. Phasellus non \r\nleo nec enim eleifend semper quis eget erat. Quisque imperdiet nulla \r\ndignissim ex suscipit ultricies.</p>', 'MB-chronowing.jpg', 1, NULL, NULL, '100', 'product-1-web-dev-2'),
(42, 'Test', 'test', 'test', '<p>Etiam pulvinar sapien vestibulum neque lacinia, a auctor augue \r\nultricies. Pellentesque fermentum pretium nisi, sit amet imperdiet justo\r\n vehicula ut. In congue ultricies metus vitae hendrerit. Vestibulum mi \r\nlectus, mollis in fringilla at, congue vel elit. Pellentesque convallis \r\nnisl enim, ac lacinia eros volutpat vel. Nulla facilisi. Phasellus non \r\nleo nec enim eleifend semper quis eget erat. Quisque imperdiet nulla \r\ndignissim ex suscipit ultricies.</p>', NULL, 1, NULL, NULL, 'test', 'test-5'),
(43, 'Test', 'test', 'test', '<p>Etiam pulvinar sapien vestibulum neque lacinia, a auctor augue \r\nultricies. Pellentesque fermentum pretium nisi, sit amet imperdiet justo\r\n vehicula ut. In congue ultricies metus vitae hendrerit. Vestibulum mi \r\nlectus, mollis in fringilla at, congue vel elit. Pellentesque convallis \r\nnisl enim, ac lacinia eros volutpat vel. Nulla facilisi. Phasellus non \r\nleo nec enim eleifend semper quis eget erat. Quisque imperdiet nulla \r\ndignissim ex suscipit ultricies.</p>', 'webdev600350.jpg', 1, NULL, NULL, 'test', 'test-6'),
(44, '3.1', '250', '7', '<p>Sed imperdiet, sem a facilisis facilisis, neque odio ullamcorper mauris,\r\n id dictum ante ipsum non libero. Praesent a ante lobortis, dapibus sem \r\nvitae, condimentum felis. Aliquam facilisis venenatis tincidunt. Cras ut\r\n interdum diam, feugiat tempor purus.</p>', NULL, 1, NULL, NULL, '400', '31'),
(45, '3.1', '400', '7', '<p>Sed imperdiet, sem a facilisis facilisis, neque odio ullamcorper mauris,\r\n id dictum ante ipsum non libero. Praesent a ante lobortis, dapibus sem \r\nvitae, condimentum felis. Aliquam facilisis venenatis tincidunt. Cras ut\r\n interdum diam, feugiat tempor purus.</p>', 'MBChrono1.jpg', 1, NULL, NULL, '250', '31-2'),
(46, 'WebDev Product 1', '400', '5', '<p>Sed imperdiet, sem a facilisis facilisis, neque odio ullamcorper mauris,\r\n id dictum ante ipsum non libero. Praesent a ante lobortis, dapibus sem \r\nvitae, condimentum felis. Aliquam facilisis venenatis tincidunt. Cras ut\r\n interdum diam, feugiat tempor purus.</p>\r\n<p><img style="display: block; margin-left: auto; margin-right: auto;" src="http://50.63.185.238/~site/newadmin/_admin/_filemanager/Image/WebDevProduct2.jpg" alt="" width="400" height="233" /></p>', 'webdev600350.jpg', 1, NULL, NULL, '200', 'webdev-product-1-1'),
(47, 'Test 3 Fedon1919', '299', '5', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam finibus\r\n tortor neque, placerat lacinia enim semper a. Praesent a nibh malesuada\r\n purus varius ultricies. Ut sit amet placerat est, eget tincidunt \r\nlibero. Vivamus ultricies vestibulum porta. Nulla facilisi. Nam \r\ntristique pulvinar rhoncus. Fusce sagittis dui tellus, sit amet \r\nfacilisis sem placerat id. Sed in sollicitudin sapien.</p>', 'giorgiofedon.jpg', 1, NULL, NULL, '850', 'test-3-fedon1919-1'),
(48, 'Test', '5', '5', '<p>test</p>', NULL, 1, NULL, NULL, '5', '7'),
(49, 'Test', '5', '5', '<p>test</p>', NULL, 1, NULL, NULL, '5', '8'),
(50, 'Test', '5', '5', '<p>test</p>', 'shoes.jpg', 1, NULL, NULL, '5', '9');

-- --------------------------------------------------------

--
-- Table structure for table `tblproductcategory`
--

CREATE TABLE `tblproductcategory` (
  `fldProductCategoryID` int(10) UNSIGNED NOT NULL,
  `fldProductCategoryCategoryID` varchar(10) DEFAULT NULL,
  `fldProductCategoryProductID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproductcategory`
--

INSERT INTO `tblproductcategory` (`fldProductCategoryID`, `fldProductCategoryCategoryID`, `fldProductCategoryProductID`) VALUES
(3, '6', '3'),
(4, '11', '3'),
(5, '6', '4'),
(6, '11', '4'),
(12, '14', '8'),
(14, '14', '9'),
(15, '14', '7'),
(18, '6', '5'),
(19, '11', '5'),
(20, '8', '10'),
(23, '8', '13'),
(24, '12', '13'),
(25, '8', '14'),
(26, '12', '14'),
(27, '8', '15'),
(28, '12', '15'),
(29, '8', '16'),
(30, '12', '16'),
(31, '8', '17'),
(32, '12', '17'),
(36, '8', '20'),
(37, '8', '21'),
(38, '8', '22'),
(39, '8', '23'),
(40, '8', '24'),
(41, '8', '25'),
(42, '8', '26'),
(48, '8', '34'),
(49, '8', '35'),
(50, '8', '36'),
(64, '8', '6'),
(66, '17', '43'),
(69, '17', '41'),
(78, '18', '46'),
(79, '13', '45'),
(82, '8', '12'),
(84, '11', '2'),
(85, '6', '2'),
(89, '13', '47'),
(91, '8', '19'),
(92, '8', NULL),
(93, '12', NULL),
(94, '8', NULL),
(95, '12', NULL),
(96, '8', NULL),
(97, '12', NULL),
(106, '8', '18'),
(107, '12', '18');

-- --------------------------------------------------------

--
-- Table structure for table `tblproductoptions`
--

CREATE TABLE `tblproductoptions` (
  `fldProductOptionsID` int(10) UNSIGNED NOT NULL,
  `fldProductOptionsProductID` varchar(10) DEFAULT NULL,
  `fldProductOptionsAssetsID` varchar(10) DEFAULT NULL,
  `fldProductOptionsPrice` varchar(10) DEFAULT NULL,
  `fldProductOptionsOptionsID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproductoptions`
--

INSERT INTO `tblproductoptions` (`fldProductOptionsID`, `fldProductOptionsProductID`, `fldProductOptionsAssetsID`, `fldProductOptionsPrice`, `fldProductOptionsOptionsID`) VALUES
(1, '10', '1', '5', NULL),
(2, '10', '3', '10', NULL),
(3, '11', '1', '5', NULL),
(4, '11', '3', '10', NULL),
(7, '13', '2', '10', NULL),
(8, '13', '11', '5', NULL),
(9, '14', '2', '10', NULL),
(10, '14', '11', '5', NULL),
(11, '15', '2', '10', NULL),
(12, '15', '11', '5', NULL),
(13, '16', '2', '10', NULL),
(14, '16', '11', '5', NULL),
(15, '17', '2', '10', NULL),
(16, '17', '11', '5', NULL),
(20, '20', '2', '2', NULL),
(21, '21', '3', '5', NULL),
(22, '22', '3', '5', NULL),
(23, '23', '3', '5', NULL),
(24, '24', '2', '3', NULL),
(25, '25', '2', '3', NULL),
(26, '26', '2', '3', NULL),
(27, '34', '1', '3', NULL),
(28, '35', '1', '3', NULL),
(29, '36', '1', '3', NULL),
(44, '6', '1', '1', '3'),
(45, '6', '2', '2', '3'),
(46, '6', '12', '2', '4'),
(47, '6', '9', '5', '4'),
(51, '41', '2', '', '3'),
(62, '45', '2', '', '3'),
(63, '45', '9', '', '4'),
(68, '19', '1', '', '3'),
(69, '19', '2', '', '3'),
(70, '19', '3', '', '3'),
(71, '19', '11', '', '3'),
(72, '19', '12', '', '4'),
(73, '19', '9', '', '4'),
(74, NULL, '1', '', NULL),
(75, NULL, '2', '', NULL),
(76, NULL, '1', '', NULL),
(77, NULL, '2', '', NULL),
(78, NULL, '1', '', NULL),
(79, NULL, '2', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblshipping`
--

CREATE TABLE `tblshipping` (
  `fldShippingID` int(10) UNSIGNED NOT NULL,
  `fldShippingName` varchar(200) DEFAULT NULL,
  `fldShippingIsActive` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblshipping`
--

INSERT INTO `tblshipping` (`fldShippingID`, `fldShippingName`, `fldShippingIsActive`) VALUES
(1, 'UPS', '1'),
(2, 'Fedex', '0'),
(3, 'USPS', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tblstaff`
--

CREATE TABLE `tblstaff` (
  `fldStaffID` int(10) UNSIGNED NOT NULL,
  `fldStaffFirstname` varchar(250) DEFAULT NULL,
  `fldStaffLastname` varchar(250) DEFAULT NULL,
  `fldStaffDepartment` varchar(250) DEFAULT NULL,
  `fldStaffPosition` int(11) DEFAULT NULL,
  `fldStaffDescription` text,
  `fldStaffImage` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstaff`
--

INSERT INTO `tblstaff` (`fldStaffID`, `fldStaffFirstname`, `fldStaffLastname`, `fldStaffDepartment`, `fldStaffPosition`, `fldStaffDescription`, `fldStaffImage`) VALUES
(2, 'John', 'Doe', 'Web Development', 2, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio digna', 'JohnDoe.jpg'),
(3, 'Jane', 'Doe', 'Web Designing', 1, 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat', 'JaneDoe.jpg'),
(4, 'Matthew', 'Doe', 'Web Development', 3, 'Suspendisse potenti. Suspendisse vehicula nisl sit amet sem varius, ac egestas nunc consequat. In id eros ultrices, sodales leo nec, ultrices sapien. Pellentesque vel ex sollicitudin, tincidunt est nec, elementum neque. Nulla rutrum odio ex, et fringilla diam mollis eu. Mauris quis congue urna. Phasellus pellentesque lectus dapibus, ornare diam id, semper nisi. Suspendisse at efficitur nunc, eu auctor libero.', 'DNRmale1jpg.jpg'),
(5, 'Emma', 'Doe', 'Programming', 4, 'Vivamus pulvinar sed sem a consectetur. Mauris sit amet dapibus tortor. Aliquam erat volutpat. Maecenas sed mi ornare augue sollicitudin tincidunt. Nunc luctus tempus ex vel euismod. Maecenas at scelerisque eros, ut tincidunt nisi. Praesent lacinia dui ac mi ultrices, non tempus est porttitor. Nullam consequat nulla non eros porta, ac congue lorem facilisis. Nulla nunc tellus, mollis nec finibus quis, sodales vitae lorem. Donec hendrerit est nisi', 'DNRWoman.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblstate`
--

CREATE TABLE `tblstate` (
  `fldStateID` char(2) NOT NULL DEFAULT '',
  `fldStateName` varchar(64) DEFAULT NULL,
  `fldStateTax` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstate`
--

INSERT INTO `tblstate` (`fldStateID`, `fldStateName`, `fldStateTax`) VALUES
('AL', 'Alabama', NULL),
('AK', 'Alaska', NULL),
('AZ', 'Arizona', NULL),
('AR', 'Arkansas', NULL),
('CA', 'California', '0.0925'),
('CO', 'Colorado', NULL),
('CT', 'Connecticut', NULL),
('DE', 'Delaware', NULL),
('FL', 'Florida', NULL),
('GA', 'Georgia', NULL),
('HI', 'Hawaii', NULL),
('ID', 'Idaho', NULL),
('IL', 'Illinois', NULL),
('IN', 'Indiana', NULL),
('IA', 'Iowa', NULL),
('KS', 'Kansas', NULL),
('KY', 'Kentucky', NULL),
('LA', 'Louisiana', NULL),
('ME', 'Maine', NULL),
('MD', 'Maryland', NULL),
('MA', 'Massachusetts', NULL),
('MI', 'Michigan', NULL),
('MN', 'Minnesota', NULL),
('MS', 'Mississippi', NULL),
('MO', 'Missouri', NULL),
('MT', 'Montana', NULL),
('NE', 'Nebraska', NULL),
('NV', 'Nevada', NULL),
('NH', 'New Hampshire', NULL),
('NJ', 'New Jersey', NULL),
('NM', 'New Mexico', NULL),
('NY', 'New York', NULL),
('NC', 'North Carolina', NULL),
('ND', 'North Dakota', NULL),
('OH', 'Ohio', NULL),
('OK', 'Oklahoma', NULL),
('OR', 'Oregon', NULL),
('PA', 'Pennsylvania', NULL),
('RI', 'Rhode Island', NULL),
('SC', 'South Carolina', NULL),
('SD', 'South Dakota', NULL),
('TN', 'Tennessee', NULL),
('TX', 'Texas', NULL),
('UT', 'Utah', NULL),
('VT', 'Vermont', NULL),
('VA', 'Virginia', NULL),
('WA', 'Washington', NULL),
('WV', 'West Virginia', NULL),
('WI', 'Wisconsin', NULL),
('WY', 'Wyoming', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbltempcart`
--

CREATE TABLE `tbltempcart` (
  `fldTempCartID` int(10) UNSIGNED NOT NULL,
  `fldTempCartProductID` varchar(10) DEFAULT NULL,
  `fldTempCartClientID` varchar(250) DEFAULT NULL,
  `fldTempCartProductName` varchar(250) DEFAULT NULL,
  `fldTempCartProductPrice` varchar(100) DEFAULT NULL,
  `fldTempCartQuantity` varchar(10) DEFAULT NULL,
  `fldTempCartOrderDate` date DEFAULT NULL,
  `fldTempCartProductOptions` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltempcart`
--

INSERT INTO `tbltempcart` (`fldTempCartID`, `fldTempCartProductID`, `fldTempCartClientID`, `fldTempCartProductName`, `fldTempCartProductPrice`, `fldTempCartQuantity`, `fldTempCartOrderDate`, `fldTempCartProductOptions`) VALUES
(6, '3', 'u71g18k815o6slh8a6tvp423p2', 'Test 8', '100', '6', '2014-02-08', NULL),
(7, '1', 'u71g18k815o6slh8a6tvp423p2', 'test', '100', '15', '2014-02-08', NULL),
(8, '1', '035oubuhajlt9822ro5iuh0or7', 'test', '100', '2', '2014-02-08', NULL),
(9, '3', '035oubuhajlt9822ro5iuh0or7', 'Test 8', '100', '1', '2014-02-08', NULL),
(10, '3', '3', 'Test 8', '100', '3', '2014-02-22', NULL),
(12, '4', 'j0ll3stn1aor2pu7bptnqttlv7', 'test 8.1', '15', '2', '2014-02-22', NULL),
(13, '4', '3', 'test 8.1', '15', '1', '2014-02-23', NULL),
(14, '3', '3', 'Test 8', '100', '1', '2014-03-08', NULL),
(36, '4', '11', 'Test Products 2', '50', '4', '2014-04-15', NULL),
(37, '6', '7', 'Test Product 4', '50', '4', '2014-04-24', NULL),
(38, '6', 'db8f624cfe59b18ea61e53b08430ae77', 'Test Product 4', '50', '1', '2014-04-29', NULL),
(39, '6', '51b0fbd4be73965b064dd93deb85599b', 'Test Product 4', '50', '1', '2014-05-13', NULL),
(40, '6', '7', 'Test Product 4', '50', '1', '2014-05-13', NULL),
(42, '4', '12', 'Test Products 2', '50', '1', '2014-05-14', NULL),
(43, '5', '12', 'Test Products 3', '100', '5', '2014-05-14', NULL),
(44, '6', '13', 'Test Product 4', '50', '1', '2014-05-14', NULL),
(45, '2', '14', 'Test Products', '100', '2', '2014-05-15', NULL),
(46, '6', '14', 'Test Product 4', '50', '4', '2014-05-15', NULL),
(47, '3', '14', 'Test Products 1', '120', '1', '2014-05-15', NULL),
(49, '6', '7', 'Test Product 4', '50', '1', '2014-05-15', NULL),
(50, '4', '7', 'Test Products 2', '50', '1', '2014-05-15', NULL),
(52, '6', '7', 'Test Product 4', '50', '1', '2014-05-15', NULL),
(56, '6', 'acfa35a682ad78918149fe2226ac0ec4', 'Test Product 4', '50', '1', '2014-05-16', NULL),
(57, '3', '00c995a5156c733ead1ed2ed9be8f1dd', 'Test Products 1', '120', '1', '2014-05-19', NULL),
(58, '6', '7', 'Test Product 4', '50', '1', '2014-05-19', NULL),
(67, '4', 'e991544d01228b6ac1149b38d1a0efe5', 'Test Products 2', '50', '1', '2014-05-22', NULL),
(69, '6', '7', 'Test Product 4', '100', '1', '2014-06-06', NULL),
(70, '2', '7', 'Test Products', '150', '1', '2014-07-03', NULL),
(71, '6', '7', 'Test Product 4', '100', '1', '2014-07-04', NULL),
(72, '6', '7', 'Test Product 4', '100', '1', '2014-07-07', NULL),
(73, '5', 'd96429e0d1164cda9c28ae7b51593a07', 'Test Products 3', '120', '1', '2014-07-11', NULL),
(78, '6', '17', 'Test Product 4', '100', '1', '2014-08-09', NULL),
(79, '6', '1290d3f8d66082e7d77b25cfafa5b86a', 'Test Product 4', '100', '1', '2014-08-29', NULL),
(80, '2', '353621510cf2c3880eeb49ff8d23d5c0', 'Test Products', '150', '1', '2014-09-11', NULL),
(81, '6', '19', 'Test Product 4', '100', '1', '2014-10-13', NULL),
(82, '2', '375403c2ccb3e488e9493e13f3b49135', 'Test Products', '150', '1', '2014-10-15', NULL),
(83, '2', '3500067b0a2000d8f8ad2bebbfdf25e8', 'Test Products', '150', '1', '2014-11-10', NULL),
(84, '2', '7', 'Test Products', '150', '1', '2014-11-10', NULL),
(100, '6', '7', 'Test Product 4', '100', '1', '2014-11-10', '2_9'),
(101, '9', '7', 'DNR TEST Product', '5', '1', '2014-11-10', ''),
(102, '2', '86de1feebe873f7790e4645fdc92b6a8', 'Test Products', '150', '1', '2014-11-10', ''),
(103, '2', '1fbcdd8c6d5c350e4783639869a1e4f6', 'Test Products', '150', '1', '2014-11-11', ''),
(104, '3', '3ee6489bc89a6ac961f81cf04abf03da', 'Test Products 1', '120', '1', '2014-11-24', ''),
(105, '39', '3ee6489bc89a6ac961f81cf04abf03da', 'Product 1', '65', '1', '2014-11-24', ''),
(106, '37', '3ee6489bc89a6ac961f81cf04abf03da', 'Web Dev Product 1', '50', '1', '2014-11-24', ''),
(130, '45', '16', '3.1', '400', '1', '2014-11-24', ''),
(132, '10', '7', 'Test Shoes', '250', '1', '2014-11-24', '1'),
(133, '10', '9188a2410eb65b04e2952feb6c5394da', 'Test Shoes', '250', '1', '2014-11-25', ''),
(134, '21', '5e09c1529444d6a95845ae095b3670f6', 'Test 10', '2', '1', '2014-11-30', ''),
(137, '2', '0b51c6142219f0358edbfb33649c3f2d', 'Test Products', '150', '1', '2014-12-01', ''),
(141, '45', '16', '3.1', '400', '5', '2014-12-01', '2_9'),
(142, '8', '19', 'Test', '7', '1', '2014-12-15', ''),
(143, '2', '19', 'Test Products', '150', '1', '2014-12-15', ''),
(144, '23', '19', 'Test 10', '2', '1', '2014-12-15', ''),
(145, '19', '19', 'Test Shoes 4', '10', '1', '2014-12-15', ''),
(146, '10', '19', 'Test Shoes', '250', '1', '2014-12-15', ''),
(147, '13', '19', 'Test Shoes 3', '50', '1', '2014-12-15', ''),
(148, '39', 'fb08ae3956c92bd732d5e37f0506c476', 'Product 1', '65', '1', '2014-12-26', ''),
(149, '2', 'c30c84c469f4200a790ebc78dda7671e', 'Test Products', '150', '6', '2014-12-27', ''),
(150, '13', 'c30c84c469f4200a790ebc78dda7671e', 'Test Shoes 3', '50', '1', '2014-12-27', ''),
(151, '9', 'c30c84c469f4200a790ebc78dda7671e', 'DNR TEST Product', '5', '1', '2014-12-27', ''),
(161, '19', '4d725f22c9cc06e0fcfdb0e43ccf8754', 'Test Shoes 4', '10', '1', '2015-02-03', '11_12'),
(162, '2', '21', 'Test Products', '150', '1', '2015-08-12', ''),
(163, '10', '23', 'Test Shoes', '250', '4', '2015-09-15', NULL),
(164, '8', '23', 'Test', '7', '1', '2015-09-15', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblups`
--

CREATE TABLE `tblups` (
  `fldUPSID` int(10) UNSIGNED NOT NULL,
  `fldUPSXmlAccessKey` varchar(100) DEFAULT NULL,
  `fldUPSUserID` varchar(100) DEFAULT NULL,
  `fldUPSPassword` varchar(100) DEFAULT NULL,
  `fldUPSAddress` varchar(250) DEFAULT NULL,
  `fldUPSCity` varchar(150) DEFAULT NULL,
  `fldUPSState` varchar(100) DEFAULT NULL,
  `fldUPSZip` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblups`
--

INSERT INTO `tblups` (`fldUPSID`, `fldUPSXmlAccessKey`, `fldUPSUserID`, `fldUPSPassword`, `fldUPSAddress`, `fldUPSCity`, `fldUPSState`, `fldUPSZip`) VALUES
(1, 'ACB64C9CDD553A76', 'keithglenn45', 'PonyTalePress1', NULL, 'San Diego', 'CA', '92121');

-- --------------------------------------------------------

--
-- Table structure for table `tblusps`
--

CREATE TABLE `tblusps` (
  `fldUSPSID` int(10) UNSIGNED NOT NULL,
  `fldUSPSUsername` varchar(150) DEFAULT NULL,
  `fldUSPSZip` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusps`
--

INSERT INTO `tblusps` (`fldUSPSID`, `fldUSPSUsername`, `fldUSPSZip`) VALUES
(1, '576PONYT3863', '92121'),
(2, '576PONYT3863', '92121'),
(3, '576PONYT3863', '92121'),
(4, '576PONYT3863', '92121'),
(5, '576PONYT3863', '92121'),
(6, '576PONYT3863', '92121'),
(7, '576PONYT3863', '92121'),
(8, '576PONYT3863', '92121'),
(9, '576PONYT38631', '90010'),
(10, '576PONYT3863', '92121');

-- --------------------------------------------------------

--
-- Table structure for table `tcountry`
--

CREATE TABLE `tcountry` (
  `country_id` int(10) UNSIGNED NOT NULL,
  `country_name` varchar(100) NOT NULL DEFAULT '',
  `country_code` varchar(5) NOT NULL DEFAULT '',
  `country_status` enum('enabled','disabled') NOT NULL DEFAULT 'disabled',
  `country_isdefault` enum('true','false') NOT NULL DEFAULT 'false'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tcountry`
--

INSERT INTO `tcountry` (`country_id`, `country_name`, `country_code`, `country_status`, `country_isdefault`) VALUES
(1, 'AFGHANISTAN', 'AF', 'enabled', 'false'),
(2, 'ALAND ISLANDS', 'AX', 'enabled', 'false'),
(3, 'ALBANIA', 'AL', 'enabled', 'false'),
(4, 'ALGERIA', 'DZ', 'enabled', 'false'),
(5, 'AMERICAN SAMOA', 'AS', 'enabled', 'false'),
(6, 'ANDORRA', 'AD', 'enabled', 'false'),
(7, 'ANGOLA', 'AO', 'enabled', 'false'),
(8, 'ANGUILLA', 'AI', 'enabled', 'false'),
(9, 'ANTARCTICA', 'AQ', 'enabled', 'false'),
(10, 'ANTIGUA AND BARBUDA', 'AG', 'enabled', 'false'),
(11, 'ARGENTINA', 'AR', 'enabled', 'false'),
(12, 'ARMENIA', 'AM', 'enabled', 'false'),
(13, 'ARUBA', 'AW', 'enabled', 'false'),
(14, 'AUSTRALIA', 'AU', 'enabled', 'false'),
(15, 'AUSTRIA', 'AT', 'enabled', 'false'),
(16, 'AZERBAIJAN', 'AZ', 'enabled', 'false'),
(17, 'BAHAMAS', 'BS', 'enabled', 'false'),
(18, 'BAHRAIN', 'BH', 'enabled', 'false'),
(19, 'BANGLADESH', 'BD', 'enabled', 'false'),
(20, 'BARBADOS', 'BB', 'enabled', 'false'),
(21, 'BELARUS', 'BY', 'enabled', 'false'),
(22, 'BELGIUM', 'BE', 'enabled', 'false'),
(23, 'BELIZE', 'BZ', 'enabled', 'false'),
(24, 'BENIN', 'BJ', 'enabled', 'false'),
(25, 'BERMUDA', 'BM', 'enabled', 'false'),
(26, 'BHUTAN', 'BT', 'enabled', 'false'),
(27, 'BOLIVIA', 'BO', 'enabled', 'false'),
(28, 'BOSNIA AND HERZEGOVINA', 'BA', 'enabled', 'false'),
(29, 'BOTSWANA', 'BW', 'enabled', 'false'),
(30, 'BOUVET ISLAND', 'BV', 'enabled', 'false'),
(31, 'BRAZIL', 'BR', 'enabled', 'false'),
(32, 'BRITISH INDIAN OCEAN TERRITORY', 'IO', 'enabled', 'false'),
(33, 'BRUNEI DARUSSALAM', 'BN', 'enabled', 'false'),
(34, 'BULGARIA', 'BG', 'enabled', 'false'),
(35, 'BURKINA FASO', 'BF', 'enabled', 'false'),
(36, 'BURUNDI', 'BI', 'enabled', 'false'),
(37, 'CAMBODIA', 'KH', 'enabled', 'false'),
(38, 'CAMEROON', 'CM', 'enabled', 'false'),
(39, 'CANADA', 'CA', 'enabled', 'false'),
(40, 'CAPE VERDE', 'CV', 'enabled', 'false'),
(41, 'CAYMAN ISLANDS', 'KY', 'enabled', 'false'),
(42, 'CENTRAL AFRICAN REPUBLIC', 'CF', 'enabled', 'false'),
(43, 'CHAD', 'TD', 'enabled', 'false'),
(44, 'CHILE', 'CL', 'enabled', 'false'),
(45, 'CHINA', 'CN', 'enabled', 'false'),
(46, 'CHRISTMAS ISLAND', 'CX', 'enabled', 'false'),
(47, 'COCOS (KEELING) ISLANDS', 'CC', 'enabled', 'false'),
(48, 'COLOMBIA', 'CO', 'enabled', 'false'),
(49, 'COMOROS', 'KM', 'enabled', 'false'),
(50, 'CONGO', 'CG', 'enabled', 'false'),
(51, 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'CD', 'enabled', 'false'),
(52, 'COOK ISLANDS', 'CK', 'enabled', 'false'),
(53, 'COSTA RICA', 'CR', 'enabled', 'false'),
(54, 'COTE D&#039;IVOIRE', 'CI', 'enabled', 'false'),
(55, 'CROATIA', 'HR', 'enabled', 'false'),
(56, 'CUBA', 'CU', 'enabled', 'false'),
(57, 'CYPRUS', 'CY', 'enabled', 'false'),
(58, 'CZECH REPUBLIC', 'CZ', 'enabled', 'false'),
(59, 'DENMARK', 'DK', 'enabled', 'false'),
(60, 'DJIBOUTI', 'DJ', 'enabled', 'false'),
(61, 'DOMINICA', 'DM', 'enabled', 'false'),
(62, 'DOMINICAN REPUBLIC', 'DO', 'enabled', 'false'),
(63, 'ECUADOR', 'EC', 'enabled', 'false'),
(64, 'EGYPT', 'EG', 'enabled', 'false'),
(65, 'EL SALVADOR', 'SV', 'enabled', 'false'),
(66, 'EQUATORIAL GUINEA', 'GQ', 'enabled', 'false'),
(67, 'ERITREA', 'ER', 'enabled', 'false'),
(68, 'ESTONIA', 'EE', 'enabled', 'false'),
(69, 'ETHIOPIA', 'ET', 'enabled', 'false'),
(70, 'FALKLAND ISLANDS (MALVINAS)', 'FK', 'enabled', 'false'),
(71, 'FAROE ISLANDS', 'FO', 'enabled', 'false'),
(72, 'FIJI', 'FJ', 'enabled', 'false'),
(73, 'FINLAND', 'FI', 'enabled', 'false'),
(74, 'FRANCE', 'FR', 'enabled', 'false'),
(75, 'FRENCH GUIANA', 'GF', 'enabled', 'false'),
(76, 'FRENCH POLYNESIA', 'PF', 'enabled', 'false'),
(77, 'FRENCH SOUTHERN TERRITORIES', 'TF', 'enabled', 'false'),
(78, 'GABON', 'GA', 'enabled', 'false'),
(79, 'GAMBIA', 'GM', 'enabled', 'false'),
(80, 'GEORGIA', 'GE', 'enabled', 'false'),
(81, 'GERMANY', 'DE', 'enabled', 'false'),
(82, 'GHANA', 'GH', 'enabled', 'false'),
(83, 'GIBRALTAR', 'GI', 'enabled', 'false'),
(84, 'GREECE', 'GR', 'enabled', 'false'),
(85, 'GREENLAND', 'GL', 'enabled', 'false'),
(86, 'GRENADA', 'GD', 'enabled', 'false'),
(87, 'GUADELOUPE', 'GP', 'enabled', 'false'),
(88, 'GUAM', 'GU', 'enabled', 'false'),
(89, 'GUATEMALA', 'GT', 'enabled', 'false'),
(90, 'GUERNSEY', 'GG', 'enabled', 'false'),
(91, 'GUINEA', 'GN', 'enabled', 'false'),
(92, 'GUINEA-BISSAU', 'GW', 'enabled', 'false'),
(93, 'GUYANA', 'GY', 'enabled', 'false'),
(94, 'HAITI', 'HT', 'enabled', 'false'),
(95, 'HEARD ISLAND AND MCDONALD ISLANDS', 'HM', 'enabled', 'false'),
(96, 'HOLY SEE (VATICAN CITY STATE)', 'VA', 'enabled', 'false'),
(97, 'HONDURAS', 'HN', 'enabled', 'false'),
(98, 'HONG KONG', 'HK', 'enabled', 'false'),
(99, 'HUNGARY', 'HU', 'enabled', 'false'),
(100, 'ICELAND', 'IS', 'enabled', 'false'),
(101, 'INDIA', 'IN', 'enabled', 'false'),
(102, 'INDONESIA', 'ID', 'enabled', 'false'),
(103, 'IRAN, ISLAMIC REPUBLIC OF', 'IR', 'enabled', 'false'),
(104, 'IRAQ', 'IQ', 'enabled', 'false'),
(105, 'IRELAND', 'IE', 'enabled', 'false'),
(106, 'ISLE OF MAN', 'IM', 'enabled', 'false'),
(107, 'ISRAEL', 'IL', 'enabled', 'false'),
(108, 'ITALY', 'IT', 'enabled', 'false'),
(109, 'JAMAICA', 'JM', 'enabled', 'false'),
(110, 'JAPAN', 'JP', 'enabled', 'false'),
(111, 'JERSEY', 'JE', 'enabled', 'false'),
(112, 'JORDAN', 'JO', 'enabled', 'false'),
(113, 'KAZAKHSTAN', 'KZ', 'enabled', 'false'),
(114, 'KENYA', 'KE', 'enabled', 'false'),
(115, 'KIRIBATI', 'KI', 'enabled', 'false'),
(116, 'KOREA, DEMOCRATIC PEOPLE&#039;S REPUBLIC OF', 'KP', 'enabled', 'false'),
(117, 'KOREA, REPUBLIC OF', 'KR', 'enabled', 'false'),
(118, 'KUWAIT', 'KW', 'enabled', 'false'),
(119, 'KYRGYZSTAN', 'KG', 'enabled', 'false'),
(120, 'LAO PEOPLE&#039;S DEMOCRATIC REPUBLIC', 'LA', 'enabled', 'false'),
(121, 'LATVIA', 'LV', 'enabled', 'false'),
(122, 'LEBANON', 'LB', 'enabled', 'false'),
(123, 'LESOTHO', 'LS', 'enabled', 'false'),
(124, 'LIBERIA', 'LR', 'enabled', 'false'),
(125, 'LIBYAN ARAB JAMAHIRIYA', 'LY', 'enabled', 'false'),
(126, 'LIECHTENSTEIN', 'LI', 'enabled', 'false'),
(127, 'LITHUANIA', 'LT', 'enabled', 'false'),
(128, 'LUXEMBOURG', 'LU', 'enabled', 'false'),
(129, 'MACAO', 'MO', 'enabled', 'false'),
(130, 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'MK', 'enabled', 'false'),
(131, 'MADAGASCAR', 'MG', 'enabled', 'false'),
(132, 'MALAWI', 'MW', 'enabled', 'false'),
(133, 'MALAYSIA', 'MY', 'enabled', 'false'),
(134, 'MALDIVES', 'MV', 'enabled', 'false'),
(135, 'MALI', 'ML', 'enabled', 'false'),
(136, 'MALTA', 'MT', 'enabled', 'false'),
(137, 'MARSHALL ISLANDS', 'MH', 'enabled', 'false'),
(138, 'MARTINIQUE', 'MQ', 'enabled', 'false'),
(139, 'MAURITANIA', 'MR', 'enabled', 'false'),
(140, 'MAURITIUS', 'MU', 'enabled', 'false'),
(141, 'MAYOTTE', 'YT', 'enabled', 'false'),
(142, 'MEXICO', 'MX', 'enabled', 'false'),
(143, 'MICRONESIA, FEDERATED STATES OF', 'FM', 'enabled', 'false'),
(144, 'MOLDOVA, REPUBLIC OF', 'MD', 'enabled', 'false'),
(145, 'MONACO', 'MC', 'enabled', 'false'),
(146, 'MONGOLIA', 'MN', 'enabled', 'false'),
(147, 'MONTSERRAT', 'MS', 'enabled', 'false'),
(148, 'MOROCCO', 'MA', 'enabled', 'false'),
(149, 'MOZAMBIQUE', 'MZ', 'enabled', 'false'),
(150, 'MYANMAR', 'MM', 'enabled', 'false'),
(151, 'NAMIBIA', 'NA', 'enabled', 'false'),
(152, 'NAURU', 'NR', 'enabled', 'false'),
(153, 'NEPAL', 'NP', 'enabled', 'false'),
(154, 'NETHERLANDS', 'NL', 'enabled', 'false'),
(155, 'NETHERLANDS ANTILLES', 'AN', 'enabled', 'false'),
(156, 'NEW CALEDONIA', 'NC', 'enabled', 'false'),
(157, 'NEW ZEALAND', 'NZ', 'enabled', 'false'),
(158, 'NICARAGUA', 'NI', 'enabled', 'false'),
(159, 'NIGER', 'NE', 'enabled', 'false'),
(160, 'NIGERIA', 'NG', 'enabled', 'false'),
(161, 'NIUE', 'NU', 'enabled', 'false'),
(162, 'NORFOLK ISLAND', 'NF', 'enabled', 'false'),
(163, 'NORTHERN MARIANA ISLANDS', 'MP', 'enabled', 'false'),
(164, 'NORWAY', 'NO', 'enabled', 'false'),
(165, 'OMAN', 'OM', 'enabled', 'false'),
(166, 'PAKISTAN', 'PK', 'enabled', 'false'),
(167, 'PALAU', 'PW', 'enabled', 'false'),
(168, 'PALESTINIAN TERRITORY, OCCUPIED', 'PS', 'enabled', 'false'),
(169, 'PANAMA', 'PA', 'enabled', 'false'),
(170, 'PAPUA NEW GUINEA', 'PG', 'enabled', 'false'),
(171, 'PARAGUAY', 'PY', 'enabled', 'false'),
(172, 'PERU', 'PE', 'enabled', 'false'),
(173, 'PHILIPPINES', 'PH', 'enabled', 'false'),
(174, 'PITCAIRN', 'PN', 'enabled', 'false'),
(175, 'POLAND', 'PL', 'enabled', 'false'),
(176, 'PORTUGAL', 'PT', 'enabled', 'false'),
(177, 'PUERTO RICO', 'PR', 'enabled', 'false'),
(178, 'QATAR', 'QA', 'enabled', 'false'),
(179, 'REUNION', 'RE', 'enabled', 'false'),
(180, 'ROMANIA', 'RO', 'enabled', 'false'),
(181, 'RUSSIAN FEDERATION', 'RU', 'enabled', 'false'),
(182, 'RWANDA', 'RW', 'enabled', 'false'),
(183, 'SAINT HELENA', 'SH', 'enabled', 'false'),
(184, 'SAINT KITTS AND NEVIS', 'KN', 'enabled', 'false'),
(185, 'SAINT LUCIA', 'LC', 'enabled', 'false'),
(186, 'SAINT PIERRE AND MIQUELON', 'PM', 'enabled', 'false'),
(187, 'SAINT VINCENT AND THE GRENADINES', 'VC', 'enabled', 'false'),
(188, 'SAMOA', 'WS', 'enabled', 'false'),
(189, 'SAN MARINO', 'SM', 'enabled', 'false'),
(190, 'SAO TOME AND PRINCIPE', 'ST', 'enabled', 'false'),
(191, 'SAUDI ARABIA', 'SA', 'enabled', 'false'),
(192, 'SENEGAL', 'SN', 'enabled', 'false'),
(193, 'SERBIA AND MONTENEGRO', 'CS', 'enabled', 'false'),
(194, 'SEYCHELLES', 'SC', 'enabled', 'false'),
(195, 'SIERRA LEONE', 'SL', 'enabled', 'false'),
(196, 'SINGAPORE', 'SG', 'enabled', 'false'),
(197, 'SLOVAKIA', 'SK', 'enabled', 'false'),
(198, 'SLOVENIA', 'SI', 'enabled', 'false'),
(199, 'SOLOMON ISLANDS', 'SB', 'enabled', 'false'),
(200, 'SOMALIA', 'SO', 'enabled', 'false'),
(201, 'SOUTH AFRICA', 'ZA', 'enabled', 'false'),
(202, 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'GS', 'enabled', 'false'),
(203, 'SPAIN', 'ES', 'enabled', 'false'),
(204, 'SRI LANKA', 'LK', 'enabled', 'false'),
(205, 'SUDAN', 'SD', 'enabled', 'false'),
(206, 'SURINAME', 'SR', 'enabled', 'false'),
(207, 'SVALBARD AND JAN MAYEN', 'SJ', 'enabled', 'false'),
(208, 'SWAZILAND', 'SZ', 'enabled', 'false'),
(209, 'SWEDEN', 'SE', 'enabled', 'false'),
(210, 'SWITZERLAND', 'CH', 'enabled', 'false'),
(211, 'SYRIAN ARAB REPUBLIC', 'SY', 'enabled', 'false'),
(212, 'TAIWAN, PROVINCE OF CHINA', 'TW', 'enabled', 'false'),
(213, 'TAJIKISTAN', 'TJ', 'enabled', 'false'),
(214, 'TANZANIA, UNITED REPUBLIC OF', 'TZ', 'enabled', 'false'),
(215, 'THAILAND', 'TH', 'enabled', 'false'),
(216, 'TIMOR-LESTE', 'TL', 'enabled', 'false'),
(217, 'TOGO', 'TG', 'enabled', 'false'),
(218, 'TOKELAU', 'TK', 'enabled', 'false'),
(219, 'TONGA', 'TO', 'enabled', 'false'),
(220, 'TRINIDAD AND TOBAGO', 'TT', 'enabled', 'false'),
(221, 'TUNISIA', 'TN', 'enabled', 'false'),
(222, 'TURKEY', 'TR', 'enabled', 'false'),
(223, 'TURKMENISTAN', 'TM', 'enabled', 'false'),
(224, 'TURKS AND CAICOS ISLANDS', 'TC', 'enabled', 'false'),
(225, 'TUVALU', 'TV', 'enabled', 'false'),
(226, 'UGANDA', 'UG', 'enabled', 'false'),
(227, 'UKRAINE', 'UA', 'enabled', 'false'),
(228, 'UNITED ARAB EMIRATES', 'AE', 'enabled', 'false'),
(229, 'UNITED KINGDOM', 'GB', 'enabled', 'false'),
(230, 'UNITED STATES', 'US', 'enabled', 'true'),
(231, 'UNITED STATES MINOR OUTLYING ISLANDS', 'UM', 'enabled', 'false'),
(232, 'URUGUAY', 'UY', 'enabled', 'false'),
(233, 'UZBEKISTAN', 'UZ', 'enabled', 'false'),
(234, 'VANUATU', 'VU', 'enabled', 'false'),
(235, 'VIRGIN ISLANDS, U.S.', 'VI', 'enabled', 'false'),
(236, 'WALLIS AND FUTUNA', 'WF', 'enabled', 'false'),
(237, 'WESTERN SAHARA', 'EH', 'enabled', 'false'),
(238, 'YEMEN', 'YE', 'enabled', 'false'),
(239, 'ZAMBIA', 'ZM', 'enabled', 'false'),
(240, 'ZIMBABWE', 'ZW', 'enabled', 'false');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladditionalphotogallery`
--
ALTER TABLE `tbladditionalphotogallery`
  ADD PRIMARY KEY (`fldAdditionalPhotoGalleryID`);

--
-- Indexes for table `tbladditionalproduct`
--
ALTER TABLE `tbladditionalproduct`
  ADD PRIMARY KEY (`fldAdditionalProductID`);

--
-- Indexes for table `tbladministrator`
--
ALTER TABLE `tbladministrator`
  ADD PRIMARY KEY (`fldAdministratorID`);

--
-- Indexes for table `tblauthorize`
--
ALTER TABLE `tblauthorize`
  ADD PRIMARY KEY (`fldAuthorizeID`);

--
-- Indexes for table `tblcart`
--
ALTER TABLE `tblcart`
  ADD PRIMARY KEY (`fldCartID`);

--
-- Indexes for table `tblcartcouponcode`
--
ALTER TABLE `tblcartcouponcode`
  ADD PRIMARY KEY (`fldCartCouponCodeID`);

--
-- Indexes for table `tblcartshippingrate`
--
ALTER TABLE `tblcartshippingrate`
  ADD PRIMARY KEY (`fldCartShippingRateID`);

--
-- Indexes for table `tblcarttax`
--
ALTER TABLE `tblcarttax`
  ADD PRIMARY KEY (`fldCartTaxID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`fldCategoryID`);

--
-- Indexes for table `tblclient`
--
ALTER TABLE `tblclient`
  ADD PRIMARY KEY (`fldClientID`);

--
-- Indexes for table `tblclientsbilling`
--
ALTER TABLE `tblclientsbilling`
  ADD PRIMARY KEY (`fldClientsBillingID`);

--
-- Indexes for table `tblclientsshipping`
--
ALTER TABLE `tblclientsshipping`
  ADD PRIMARY KEY (`fldClientsShippingID`);

--
-- Indexes for table `tblcontact`
--
ALTER TABLE `tblcontact`
  ADD PRIMARY KEY (`fldContactID`);

--
-- Indexes for table `tblcouponcode`
--
ALTER TABLE `tblcouponcode`
  ADD PRIMARY KEY (`fldCouponCodeID`);

--
-- Indexes for table `tblfedex`
--
ALTER TABLE `tblfedex`
  ADD PRIMARY KEY (`fldFedexID`);

--
-- Indexes for table `tblfooter`
--
ALTER TABLE `tblfooter`
  ADD PRIMARY KEY (`fldFooterID`);

--
-- Indexes for table `tblgoogle`
--
ALTER TABLE `tblgoogle`
  ADD PRIMARY KEY (`fldGoogleID`);

--
-- Indexes for table `tblhomeslide`
--
ALTER TABLE `tblhomeslide`
  ADD PRIMARY KEY (`fldHomeSlideID`);

--
-- Indexes for table `tblnews`
--
ALTER TABLE `tblnews`
  ADD PRIMARY KEY (`fldNewsID`);

--
-- Indexes for table `tblnewscategory`
--
ALTER TABLE `tblnewscategory`
  ADD PRIMARY KEY (`fldNewsCategoryID`);

--
-- Indexes for table `tbloptions`
--
ALTER TABLE `tbloptions`
  ADD PRIMARY KEY (`fldOptionsID`);

--
-- Indexes for table `tbloptionsassets`
--
ALTER TABLE `tbloptionsassets`
  ADD PRIMARY KEY (`fldOptionsAssetsID`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`fldPagesID`);

--
-- Indexes for table `tblpagespreview`
--
ALTER TABLE `tblpagespreview`
  ADD PRIMARY KEY (`fldPagesPreviewID`);

--
-- Indexes for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD PRIMARY KEY (`fldPaymentID`);

--
-- Indexes for table `tblpaypal`
--
ALTER TABLE `tblpaypal`
  ADD PRIMARY KEY (`fldPaypalID`);

--
-- Indexes for table `tblphotogallery`
--
ALTER TABLE `tblphotogallery`
  ADD PRIMARY KEY (`fldPhotoGalleryID`);

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`fldProductID`);

--
-- Indexes for table `tblproductcategory`
--
ALTER TABLE `tblproductcategory`
  ADD PRIMARY KEY (`fldProductCategoryID`);

--
-- Indexes for table `tblproductoptions`
--
ALTER TABLE `tblproductoptions`
  ADD PRIMARY KEY (`fldProductOptionsID`);

--
-- Indexes for table `tblshipping`
--
ALTER TABLE `tblshipping`
  ADD PRIMARY KEY (`fldShippingID`);

--
-- Indexes for table `tblstaff`
--
ALTER TABLE `tblstaff`
  ADD PRIMARY KEY (`fldStaffID`);

--
-- Indexes for table `tblstate`
--
ALTER TABLE `tblstate`
  ADD PRIMARY KEY (`fldStateID`);

--
-- Indexes for table `tbltempcart`
--
ALTER TABLE `tbltempcart`
  ADD PRIMARY KEY (`fldTempCartID`);

--
-- Indexes for table `tblups`
--
ALTER TABLE `tblups`
  ADD PRIMARY KEY (`fldUPSID`);

--
-- Indexes for table `tblusps`
--
ALTER TABLE `tblusps`
  ADD PRIMARY KEY (`fldUSPSID`);

--
-- Indexes for table `tcountry`
--
ALTER TABLE `tcountry`
  ADD PRIMARY KEY (`country_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbladditionalphotogallery`
--
ALTER TABLE `tbladditionalphotogallery`
  MODIFY `fldAdditionalPhotoGalleryID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `tbladditionalproduct`
--
ALTER TABLE `tbladditionalproduct`
  MODIFY `fldAdditionalProductID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `tbladministrator`
--
ALTER TABLE `tbladministrator`
  MODIFY `fldAdministratorID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblauthorize`
--
ALTER TABLE `tblauthorize`
  MODIFY `fldAuthorizeID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblcart`
--
ALTER TABLE `tblcart`
  MODIFY `fldCartID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `tblcartcouponcode`
--
ALTER TABLE `tblcartcouponcode`
  MODIFY `fldCartCouponCodeID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tblcartshippingrate`
--
ALTER TABLE `tblcartshippingrate`
  MODIFY `fldCartShippingRateID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `tblcarttax`
--
ALTER TABLE `tblcarttax`
  MODIFY `fldCartTaxID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `fldCategoryID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tblclient`
--
ALTER TABLE `tblclient`
  MODIFY `fldClientID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tblclientsbilling`
--
ALTER TABLE `tblclientsbilling`
  MODIFY `fldClientsBillingID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tblclientsshipping`
--
ALTER TABLE `tblclientsshipping`
  MODIFY `fldClientsShippingID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tblcontact`
--
ALTER TABLE `tblcontact`
  MODIFY `fldContactID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tblcouponcode`
--
ALTER TABLE `tblcouponcode`
  MODIFY `fldCouponCodeID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblfedex`
--
ALTER TABLE `tblfedex`
  MODIFY `fldFedexID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblfooter`
--
ALTER TABLE `tblfooter`
  MODIFY `fldFooterID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblgoogle`
--
ALTER TABLE `tblgoogle`
  MODIFY `fldGoogleID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblhomeslide`
--
ALTER TABLE `tblhomeslide`
  MODIFY `fldHomeSlideID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tblnews`
--
ALTER TABLE `tblnews`
  MODIFY `fldNewsID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblnewscategory`
--
ALTER TABLE `tblnewscategory`
  MODIFY `fldNewsCategoryID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbloptions`
--
ALTER TABLE `tbloptions`
  MODIFY `fldOptionsID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbloptionsassets`
--
ALTER TABLE `tbloptionsassets`
  MODIFY `fldOptionsAssetsID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `fldPagesID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `tblpagespreview`
--
ALTER TABLE `tblpagespreview`
  MODIFY `fldPagesPreviewID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `tblpayment`
--
ALTER TABLE `tblpayment`
  MODIFY `fldPaymentID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblpaypal`
--
ALTER TABLE `tblpaypal`
  MODIFY `fldPaypalID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblphotogallery`
--
ALTER TABLE `tblphotogallery`
  MODIFY `fldPhotoGalleryID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `fldProductID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `tblproductcategory`
--
ALTER TABLE `tblproductcategory`
  MODIFY `fldProductCategoryID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `tblproductoptions`
--
ALTER TABLE `tblproductoptions`
  MODIFY `fldProductOptionsID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `tblshipping`
--
ALTER TABLE `tblshipping`
  MODIFY `fldShippingID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblstaff`
--
ALTER TABLE `tblstaff`
  MODIFY `fldStaffID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbltempcart`
--
ALTER TABLE `tbltempcart`
  MODIFY `fldTempCartID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;
--
-- AUTO_INCREMENT for table `tblups`
--
ALTER TABLE `tblups`
  MODIFY `fldUPSID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblusps`
--
ALTER TABLE `tblusps`
  MODIFY `fldUSPSID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tcountry`
--
ALTER TABLE `tcountry`
  MODIFY `country_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
