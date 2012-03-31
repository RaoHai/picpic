-- phpMyAdmin SQL Dump
-- version 4.0.0-dev
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 31, 2012 at 06:54 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pic`
--

-- --------------------------------------------------------

--
-- Table structure for table `active`
--

CREATE TABLE IF NOT EXISTS `active` (
  `ActiveId` int(10) NOT NULL AUTO_INCREMENT,
  `UserId` int(10) NOT NULL,
  `ActionType` int(10) NOT NULL,
  `content` text NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ActiveId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=124 ;

--
-- Dumping data for table `active`
--

INSERT INTO `active` (`ActiveId`, `UserId`, `ActionType`, `content`, `Timestamp`) VALUES
(17, 23, 6, '{"ti":1330510251,"d":"\\u6d4b\\u8bd5\\u8f6c\\u4e49"}', '2012-02-29 10:10:51'),
(53, 23, 1, '{"gid":"33","d":"33_20120229120130_desk_cg_1391.jpg","ti":1330513291,"gn":"xxxx"}', '2012-02-29 11:01:31'),
(84, 4, 6, '{"ti":1330752825,"d":"\\u6bcf\\u6b21\\u65b0\\u6765\\u7684\\u5c0f\\u6df7\\u86cb\\u7b2c\\u4e00\\u6b21\\u9a6c\\u6876\\u603b\\u6709\\u81ed\\u8c46\\u8150\\u86cb\\u7684\\u611f\\u89c9,\\u539f\\u6765\\u5728\\u5ba0\\u7269\\u5e97\\u91cc\\u5403\\u7684\\u4ec0\\u4e48\\u5440!\\u6bcf\\u6b21\\u65b0\\u6765\\u7684\\u5c0f\\u6df7\\u86cb\\u7b2c\\u4e00\\u6b21\\u9a6c\\u6876\\u603b\\u6709\\u81ed\\u8c46\\u8150\\u86cb\\u7684\\u611f\\u89c9,\\u539f\\u6765\\u5728\\u5ba0\\u7269\\u5e97\\u91cc\\u5403\\u7684\\u4ec0\\u4e48\\u5440!\\u6bcf\\u6b21\\u65b0\\u6765\\u7684\\u5c0f\\u6df7\\u86cb\\u7b2c\\u4e00\\u6b21\\u9a6c\\u6876\\u603b\\u6709\\u81ed\\u8c46\\u8150\\u86cb\\u7684\\u611f\\u89c9,\\u539f\\u6765\\u5728\\u5ba0\\u7269\\u5e97\\u91cc\\u5403\\u7684\\u4ec0\\u4e48\\u5440!"}', '2012-03-03 05:33:45'),
(90, 4, 1, '{"gid":"29","d":"29_20120312083047_140.jpg","ti":1331537448,"gn":"xxxx"}', '2012-03-12 07:30:48'),
(91, 4, 1, '{"gid":"29","d":"29_20120312083048_143.jpg","ti":1331537449,"gn":"xxxx"}', '2012-03-12 07:30:49'),
(92, 4, 1, '{"gid":"29","d":"29_20120312083049_142.jpg","ti":1331537450,"gn":"xxxx"}', '2012-03-12 07:30:50'),
(108, 4, 6, '{"ti":1332000774,"d":"Chrome\\u6d4f\\u89c8\\u5668\\u6d4b\\u8bd5\\u5fae\\u535a"}', '2012-03-17 16:12:54'),
(109, 23, 6, '{"ti":1332000793,"d":"IE\\u6d4f\\u89c8\\u5668\\u6d4b\\u8bd5\\u5fae\\u8584"}', '2012-03-17 16:13:13'),
(110, 23, 6, '{"ti":1332000862,"d":"FireFox\\u6d4f\\u89c8\\u5668\\u6d4b\\u8bd5\\u5fae\\u535a"}', '2012-03-17 16:14:22'),
(111, 4, 6, '{"ti":1332001482,"d":"Chrome\\u6d4f\\u89c8\\u5668\\u8f6c\\u53d1\\u6d4b\\u8bd5","repo":"<a href=\\"\\/user\\/23\\" style=\\"margin:5px;color:#995F28;\\">@test1<\\/a>FireFox\\u6d4f\\u89c8\\u5668\\u6d4b\\u8bd5\\u5fae\\u535a"}', '2012-03-17 16:24:42'),
(113, 23, 6, '{"ti":1332001525,"d":"IE\\u6d4f\\u89c8\\u5668\\u8f6c\\u53d1\\u6d4b\\u8bd5","repo":"<a style=\\"margin: 5px; color: rgb(153, 95, 40);\\" href=\\"\\/user\\/4\\">@surgesoft1<\\/a>Chrome\\u6d4f\\u89c8\\u5668\\u6d4b\\u8bd5\\u5fae\\u535a"}', '2012-03-17 16:25:25'),
(114, 23, 6, '{"ti":1332002696,"d":"IE\\u6d4f\\u89c8\\u5668\\u7ee7\\u7eed\\u6d4b\\u8bd5\\u8f6c\\u53d1\\u5fae\\u535a","repo":"<a style=\\"margin: 5px; color: rgb(153, 95, 40);\\" href=\\"\\/user\\/23\\">@test1<\\/a>FireFox\\u6d4f\\u89c8\\u5668\\u6d4b\\u8bd5\\u5fae\\u535a"}', '2012-03-17 16:44:56'),
(115, 4, 6, '{"ti":1332046423,"d":"\\u597d\\u65e0\\u804a\\uff01\\uff01\\uff01"}', '2012-03-18 04:53:43'),
(116, 27, 6, '{"ti":1332135451,"d":"\\u521d\\u6b21\\u89c1\\u9762\\uff0c\\u8bf7\\u591a\\u591a\\u5173\\u7167~"}', '2012-03-19 05:37:31'),
(117, 27, 1, '{"gid":null,"d":"_20120319064504_29_20120312083049_142.jpg","ti":1332135905,"gn":"xxxx"}', '2012-03-19 05:45:05'),
(118, 27, 1, '{"gid":"36","d":"36_20120319064608_29_20120312083049_142.jpg","ti":1332135969,"gn":"xxxx"}', '2012-03-19 05:46:09'),
(119, 23, 1, '{"gid":null,"d":null,"ti":1332136665,"gn":"xxxx"}', '2012-03-19 05:57:45'),
(120, 28, 6, '{"ti":1332136932,"d":"2222\\n"}', '2012-03-19 06:02:12'),
(121, 23, 6, '{"ti":1332137886,"d":"\\u634e\\u5e26\\u8981\\u9769\\u5927\\u4e8b\\u8bb0\\u5730\\u8de8\\u754c\\u7092\\u52a0\\u539a\\u5362\\u8428\\u5361\\u8548\\u6de1\\u306f\\u306e\\u306d\\u3072\\u306d\\u3081\\u306a\\u306e\\u3072\\u3075\\u3085\\u3083\\u3082\\u3081\\u3081\\u307f\\u306a\\u3092\\u3092\\u3066\\u3066\\u3053\\u3064\\u3072"}', '2012-03-19 06:18:06'),
(122, 23, 6, '{"ti":1332137889,"d":"\\u634e\\u5e26\\u8981\\u9769\\u5927\\u4e8b\\u8bb0\\u5730\\u8de8\\u754c\\u7092\\u52a0\\u539a\\u5362\\u8428\\u5361\\u8548\\u6de1\\u306f\\u306e\\u306d\\u3072\\u306d\\u3081\\u306a\\u306e\\u3072\\u3075\\u3085\\u3083\\u3082\\u3081\\u3081\\u307f\\u306a\\u3092\\u3092\\u3066\\u3066\\u3053\\u3064\\u3072"}', '2012-03-19 06:18:09');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `CommentsId` int(10) NOT NULL AUTO_INCREMENT,
  `UserId` int(10) NOT NULL,
  `ImgId` int(10) NOT NULL,
  `SharedId` int(10) NOT NULL,
  `ImgGroupId` int(10) NOT NULL,
  `CommentText` text NOT NULL,
  `QuoteID` int(11) NOT NULL,
  `ReplyID` int(11) NOT NULL,
  `Time` datetime NOT NULL,
  PRIMARY KEY (`CommentsId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`CommentsId`, `UserId`, `ImgId`, `SharedId`, `ImgGroupId`, `CommentText`, `QuoteID`, `ReplyID`, `Time`) VALUES
(32, 4, 0, 0, 11, '继续评论。。测试中= =字数你妹啊', 0, 0, '2012-03-15 07:41:58'),
(33, 4, 0, 0, 0, '坑爹没有之一。。', 0, 32, '2012-03-15 07:42:30'),
(34, 4, 0, 0, 0, '坑爹第二', 0, 32, '2012-03-15 07:43:58'),
(35, 4, 0, 0, 11, '<span style="white-space:normal;">还是坑爹么？<span style="white-space:normal;">还是坑爹么？<span style="white-space:normal;">还是坑爹么？<span style="white-space:normal;">还是坑爹么？<span style="white-space:normal;">还是坑爹么？<span style="white-space:normal;">还是坑爹么？</span></span></span></span></span></span>', 0, 0, '2012-03-15 07:44:15'),
(36, 23, 0, 0, 11, '我也来凑热闹行不行？真是的= =', 0, 0, '2012-03-15 07:48:25'),
(37, 4, 0, 0, 0, '不行- -', 0, 36, '2012-03-15 07:48:43'),
(38, 23, 0, 0, 0, '你说不行就不行？= =', 0, 36, '2012-03-15 07:53:49'),
(39, 4, 0, 0, 0, 'yes', 0, 36, '2012-03-15 07:53:59'),
(40, 4, 0, 0, 0, '怎么着。。', 0, 36, '2012-03-15 07:54:23'),
(41, 4, 0, 0, 0, '0', 0, 35, '2012-03-15 07:56:02'),
(42, 4, 0, 0, 0, '0', 0, 35, '2012-03-15 07:56:33'),
(43, 4, 0, 0, 0, '别null了成不？', 0, 35, '2012-03-15 07:57:00');

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE IF NOT EXISTS `favourite` (
  `favouriteId` int(255) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `ImageId` int(11) NOT NULL,
  `ImgGroupId` int(11) NOT NULL,
  PRIMARY KEY (`favouriteId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE IF NOT EXISTS `friend` (
  `FriendId` int(10) NOT NULL AUTO_INCREMENT,
  `User` int(10) NOT NULL,
  `OtherUserId` int(10) NOT NULL,
  PRIMARY KEY (`FriendId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `friend`
--

INSERT INTO `friend` (`FriendId`, `User`, `OtherUserId`) VALUES
(7, 4, 24),
(8, 24, 4),
(9, 25, 25),
(13, 4, 25),
(14, 25, 4),
(29, 23, 4),
(30, 23, 23),
(40, 4, 4),
(41, 4, 23);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `ImageId` int(10) NOT NULL AUTO_INCREMENT,
  `ImageName` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `author` int(10) NOT NULL,
  `Date` date NOT NULL,
  `imgurl` varchar(255) NOT NULL,
  `feature` varchar(255) NOT NULL,
  `Original` int(10) NOT NULL,
  `ckecked` int(10) NOT NULL,
  `GroupID` int(10) NOT NULL,
  PRIMARY KEY (`ImageId`),
  UNIQUE KEY `img_url` (`imgurl`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=209 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`ImageId`, `ImageName`, `Description`, `author`, `Date`, `imgurl`, `feature`, `Original`, `ckecked`, `GroupID`) VALUES
(89, '', '喵～～', 4, '2012-01-26', '11_20120126034233_2.jpg', '', 5, 0, 11),
(90, '', '123456', 4, '2012-01-26', '11_20120126034234_4a.jpg', 'aaaaa', 5, 0, 11),
(91, '', '', 4, '2012-01-26', '11_20120126034235_3.jpg', '', 5, 0, 11),
(92, '', '', 4, '2012-01-26', '11_20120126034236_4b3.jpg', '', 5, 0, 11),
(93, '', '', 4, '2012-01-26', '11_20120126034237_6.jpg', '', 5, 0, 11),
(94, '', '', 4, '2012-01-26', '11_20120126034239_4b7.jpg', '', 5, 0, 11),
(95, '', '', 4, '2012-01-26', '11_20120126034247_202.jpg', '', 5, 0, 11),
(96, '', '', 4, '2012-01-26', '11_20120126034248_204.jpg', '', 5, 0, 11),
(97, '', '', 4, '2012-01-26', '11_20120126034248_200.jpg', '', 5, 0, 11),
(98, '', '', 4, '2012-01-26', '11_20120126034249_212.jpg', '', 5, 0, 11),
(99, '', '', 4, '2012-01-26', '11_20120126034250_214.jpg', '', 5, 0, 11),
(100, '', '', 4, '2012-01-26', '11_20120126034251_218.jpg', '', 0, 0, 11),
(101, '', '', 4, '2012-01-26', '11_20120126034456_166.jpg', '', 0, 0, 11),
(102, '', '', 4, '2012-01-26', '11_20120126034457_167.jpg', '', 0, 0, 11),
(103, '', '', 4, '2012-01-26', '11_20120126034458_171.jpg', '', 0, 0, 11),
(104, '', '', 4, '2012-01-26', '11_20120126034458_172.jpg', '', 0, 0, 11),
(105, '', '', 4, '2012-01-26', '11_20120126034459_175.jpg', '', 0, 0, 11),
(106, '', '', 4, '2012-01-26', '11_20120126034500_178.jpg', '', 0, 0, 11),
(107, '', '', 4, '2012-01-26', '11_20120126034505_%E5%93%AD40.jpg', '', 0, 0, 11),
(108, '', '', 4, '2012-01-26', '11_20120126034506_%E5%93%AD1.jpg', '', 0, 0, 11),
(109, '', '', 4, '2012-01-26', '11_20120126034506_%E5%93%AD76+%282%29.jpg', '', 0, 0, 11),
(113, '', '', 4, '2012-01-26', '12_20120126131356_Konachan.com%2520-%2520110496%2520sample.jpg', '', 0, 0, 12),
(114, '', '', 4, '2012-01-26', '12_20120126131358_desk_cg_1960.jpg', '', 0, 0, 12),
(115, '', '', 4, '2012-01-26', '12_20120126131359_desk_cg_2050.jpg', '', 0, 0, 12),
(116, '', '', 4, '2012-01-26', '12_20120126131400_desk_cg_2047.jpg', '', 0, 0, 12),
(117, '', '', 4, '2012-01-26', '12_20120126131401_desk_cg_2049.jpg', '', 0, 0, 12),
(118, '', '', 4, '2012-01-26', '12_20120126131402_desk_cg_2084.jpg', '', 0, 0, 12),
(119, '', '', 4, '2012-01-28', '29_20120128070858_%E8%84%B8182.jpg', '', 0, 0, 29),
(120, '', '', 4, '2012-01-28', '29_20120128070900_%E8%84%B8179.jpg', '', 0, 0, 29),
(121, '', '', 4, '2012-01-28', '29_20120128070902_%E8%84%B8180.jpg', '', 0, 0, 29),
(122, '', '', 4, '2012-01-28', '29_20120128070903_%E8%84%B8188.jpg', '', 0, 0, 29),
(123, '', '', 4, '2012-01-28', '29_20120128070955_101.jpg', '', 0, 0, 29),
(124, '', '', 4, '2012-01-28', '30_20120128072803_%E6%99%AF5.jpg', '', 0, 0, 30),
(125, '', '', 4, '2012-01-28', '30_20120128072804_%E6%99%AF58.jpg', '', 0, 0, 30),
(126, '', '', 4, '2012-01-28', '30_20120128072805_%E6%99%AF61.jpg', '', 0, 0, 30),
(127, '', '', 4, '2012-01-28', '30_20120128072807_%E5%93%AD.jpg', '', 0, 0, 30),
(128, '', '', 4, '2012-01-28', '30_20120128072808_%E6%99%AF38.jpg', '', 0, 0, 30),
(129, '', '', 4, '2012-01-28', '30_20120128072809_%E6%99%AF85.jpg', '', 0, 0, 30),
(130, '', '', 4, '2012-01-28', '30_20120128072814_%E5%93%AD1.jpg', '', 0, 0, 30),
(131, '', '', 4, '2012-02-02', '28_20120202044549_01a56b7082873fbf3e8a0468e1ab8f06.jpg', '', 0, 0, 28),
(133, '', '', 4, '2012-02-02', '28_20120202044549_0a504b9ec50173fdbe629b373e4b37a1.JPG', '', 0, 0, 28),
(134, '', '', 4, '2012-02-02', '28_20120202044550_835115_200811121241291.jpg', '', 0, 0, 28),
(141, '', '', 4, '2012-02-02', '13_20120202050815_0a504b9ec50173fdbe629b373e4b37a1.JPG', '', 0, 0, 13),
(142, '', '', 4, '2012-02-02', '13_20120202050816_01a56b7082873fbf3e8a0468e1ab8f06.jpg', '', 0, 0, 13),
(143, '', '', 23, '2012-02-20', '33_20120220091242_101.jpg', '', 0, 0, 33),
(150, '', '', 4, '2012-02-20', '13_20120220113206_9b.png', '', 0, 0, 13),
(159, '', '', 4, '2012-02-21', '28_20120221102108_0+%2842%29.jpg', '', 0, 0, 28),
(160, '', '', 4, '2012-02-21', '28_20120221102950_140.jpg', '', 0, 0, 28),
(162, '', '', 24, '2012-02-21', '34_20120221123442_94.jpg', '', 0, 0, 34),
(167, '', '', 23, '2012-02-22', '33_20120222113910_9c513dd7c350ad5c2adac2a8f18e24d2.jpg', '', 0, 0, 33),
(168, '', '', 24, '2012-02-22', '34_20120222114420_4a.jpg', '', 0, 0, 34),
(170, '', '', 23, '2012-02-23', '35_20120223025251_111.jpg', '', 0, 0, 35),
(181, '', '', 23, '2012-02-24', '35_20120224031917_9b.png', '', 0, 0, 35),
(183, '', '', 23, '2012-02-24', '33_20120224033927_0+%2842%29.jpg', '', 0, 0, 33),
(184, '', '', 23, '2012-02-24', '33_20120224033933_9c513dd7c350ad5c2adac2a8f18e24d2.jpg', '', 0, 0, 33),
(185, '', '', 23, '2012-02-24', '35_20120224035131_desk_cg_1330.jpg', '', 0, 0, 35),
(186, '', '', 23, '2012-02-24', '35_20120224035138_081.jpg', '', 0, 0, 35),
(187, '', '', 23, '2012-02-24', '35_20120224040028_21.jpg', '', 0, 0, 35),
(188, '', '', 4, '2012-02-24', '13_20120224124750_743499b5jw1dnyp388gwfj.jpg', '', 0, 0, 13),
(191, '', '', 4, '2012-02-24', '12_20120224132009_6.jpg', '', 0, 0, 12),
(200, '', '', 4, '2012-02-25', '28_20120225081048_9b.png', '', 0, 0, 28),
(201, '', '', 4, '2012-02-25', '28_20120225081937_35.jpg', '', 0, 0, 28),
(202, '', '', 4, '2012-02-25', '29_20120225083815_desk_cg_1909.jpg', '', 0, 0, 29),
(203, '', '', 23, '2012-02-29', '33_20120229120130_desk_cg_1391.jpg', '', 0, 0, 33),
(204, '', '', 4, '2012-03-12', '29_20120312083047_140.jpg', '', 0, 0, 29),
(205, '', '', 4, '2012-03-12', '29_20120312083048_143.jpg', '', 0, 0, 29),
(206, '', '', 4, '2012-03-12', '29_20120312083049_142.jpg', '', 0, 0, 29),
(208, '', '', 27, '2012-03-19', '36_20120319064608_29_20120312083049_142.jpg', '', 0, 0, 36);

-- --------------------------------------------------------

--
-- Table structure for table `imagegroup`
--

CREATE TABLE IF NOT EXISTS `imagegroup` (
  `ImagegroupId` int(10) NOT NULL AUTO_INCREMENT,
  `GroupName` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `GroupCatalog` int(10) NOT NULL,
  `author` int(10) NOT NULL,
  `updates` date NOT NULL,
  `likes` int(10) NOT NULL,
  `coverid` int(10) NOT NULL,
  PRIMARY KEY (`ImagegroupId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `imagegroup`
--

INSERT INTO `imagegroup` (`ImagegroupId`, `GroupName`, `Description`, `GroupCatalog`, `author`, `updates`, `likes`, `coverid`) VALUES
(1, '测试组', '', 1, 2, '2011-09-13', 0, 0),
(2, '测试组2', '', 1, 2, '2011-09-16', 0, 0),
(3, '1234', '', 1, 2, '2011-09-27', 0, 0),
(4, '组3', '', 1, 0, '2011-09-29', 0, 0),
(11, '杂图', '收集的一些杂图。。看看效果怎么样.\n啦啦啦啦- -\n换行？\n\n换行？', 4, 4, '2011-10-20', 1, 0),
(12, 'rt', '', 0, 4, '2011-10-20', 0, 0),
(13, 'tes', '', 0, 4, '2011-10-20', 0, 0),
(28, 'xx', 'xx', 1, 4, '2012-01-21', 0, 0),
(29, '新建画集1', '测试mkdir', 1, 4, '2012-01-22', 0, 0),
(30, '999', '999', 1, 4, '2012-01-22', 0, 0),
(33, 'x', 'x', 1, 23, '2012-02-20', 2, 0),
(34, 'opop', 'ooooo', 1, 24, '2012-02-21', 3, 0),
(35, '= =', '反正就这样。。', 1, 23, '2012-02-23', 4, 0),
(36, '777', '7777', 1, 27, '2012-03-19', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `MessageId` int(11) NOT NULL AUTO_INCREMENT,
  `senderId` int(11) NOT NULL,
  `reciverId` int(11) NOT NULL,
  `messageText` varchar(255) NOT NULL,
  `readMark` int(11) NOT NULL,
  `senderDel` int(11) NOT NULL,
  `reciverDel` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`MessageId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`MessageId`, `senderId`, `reciverId`, `messageText`, `readMark`, `senderDel`, `reciverDel`, `Title`, `Time`) VALUES
(12, 23, 2, '111111111111111111111111111111', 0, 0, 0, '11111111', '0000-00-00 00:00:00'),
(19, 23, 4, '111111111111111111111111111111', 1, 0, 1, '11111111', '2012-03-12 08:22:38'),
(20, 23, 4, '你个2B。。。懒得说你。。\n约炮什么的最讨厌了', 1, 0, 1, '我艹- -', '2012-03-14 12:42:54');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `ProfileId` int(10) NOT NULL AUTO_INCREMENT,
  `UserId` int(10) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `Birthday` varchar(255) NOT NULL,
  `FavoriteHash` varchar(255) NOT NULL,
  `FriendId` int(10) NOT NULL,
  `Shared` int(10) NOT NULL,
  `Blood` int(11) NOT NULL,
  `Sex` int(11) NOT NULL,
  `Desc` varchar(255) NOT NULL,
  PRIMARY KEY (`ProfileId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`ProfileId`, `UserId`, `avatar`, `Birthday`, `FavoriteHash`, `FriendId`, `Shared`, `Blood`, `Sex`, `Desc`) VALUES
(1, 19, '0', '0', '0', 0, 0, 0, 0, ''),
(2, 20, '0', '0', '0', 0, 0, 0, 0, ''),
(3, 21, '0', '0', '0', 0, 0, 0, 0, ''),
(4, 22, '0', '0', '0', 0, 0, 0, 0, ''),
(5, 23, '0', '0', '0', 0, 0, 0, 0, ''),
(6, 24, '0', '0', '0', 0, 0, 0, 0, ''),
(7, 25, '0', '0', '0', 0, 0, 0, 0, ''),
(8, 26, '0', '0', '0', 0, 0, 0, 0, ''),
(10, 4, '0', '2007-05-17', '0', 0, 0, 0, 0, 'asd as das das d');

-- --------------------------------------------------------

--
-- Table structure for table `share`
--

CREATE TABLE IF NOT EXISTS `share` (
  `SharedId` int(10) NOT NULL AUTO_INCREMENT,
  `SharedName` varchar(255) NOT NULL,
  `SharedDesc` varchar(255) NOT NULL,
  `GroupId` int(10) NOT NULL,
  `Sharedtostring` varchar(255) NOT NULL,
  PRIMARY KEY (`SharedId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UserId` int(10) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(255) NOT NULL,
  `NickName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `usergroup` int(10) NOT NULL,
  `permission` varchar(255) NOT NULL DEFAULT 'user',
  `friendcount` int(11) NOT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserId`, `UserName`, `NickName`, `email`, `password`, `salt`, `usergroup`, `permission`, `friendcount`) VALUES
(4, 'surgesoft1', 'surgesoft1', 'surgesoft1@gmail.com', '94bcbc3ce2efc3da7f1f2de84ef7bd33b8e3d0a0', '63k75cavk0hzwah1268pf2bk9pab4pk2', 0, 'user', 0),
(23, 'test1', 'test1', 'test1@acg.com', '71288421f84a341cc271d4c538624be69412d8e3', 'fyjszusl92vsuuz9itvxrpmfs7dw5xu6', 0, 'user', 0),
(24, 'test2', 'test2', 'test2@acg.com', '6f806e4935163db2cdfd5d1efe98d94307e8ec8c', '2o8nghxmg8mw19nztzndnfd96ctsufvw', 0, 'user', 0),
(25, 'test3', 'test3', 'test3@test.com', 'e130a39d1b4f164eef3db1f1acc55b718e650dff', '9oez0wej5lzhd6ty5wb0h4cv4wzcuzim', 0, 'user', 0),
(26, '111', '111', '1111@11.com', '78492e347370334a360b2565185fdebf2d707c98', 'kdydbq1cbq6ni7ggeyhitk2h2t2t08mm', 0, 'user', 0),
(27, 'test4', 'test4', '22222@qq.com', '617f7a0e7cb8e3be1eeafebf7b60b06427bee046', 'qix363wsrafz9rve8m08riq5ie9oiy0m', 0, 'user', 0),
(28, 'yy', '- -', 'aa@aa.com', '96db2b541b9c2b4d9ab9c73d93dbe7113b20fa15', 'i6w3ut7x4mvzzcjoxntgf61nwsgpr7er', 0, 'user', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usergroup`
--

CREATE TABLE IF NOT EXISTS `usergroup` (
  `GroupId` int(10) NOT NULL AUTO_INCREMENT,
  `GroupName` varchar(255) NOT NULL,
  `GroupCatalog` int(10) NOT NULL,
  `GroupLevel` int(10) NOT NULL,
  PRIMARY KEY (`GroupId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
