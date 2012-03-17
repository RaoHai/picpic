-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2011 年 11 月 28 日 14:06
-- 服务器版本: 5.5.8
-- PHP 版本: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `pic`
--

-- --------------------------------------------------------

--
-- 表的结构 `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `CommentsId` int(10) NOT NULL AUTO_INCREMENT,
  `UserId` int(10) NOT NULL,
  `ImgId` int(10) NOT NULL,
  `SharedId` int(10) NOT NULL,
  `ImgGroupId` int(10) NOT NULL,
  PRIMARY KEY (`CommentsId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `friend`
--

CREATE TABLE IF NOT EXISTS `friend` (
  `FriendId` int(10) NOT NULL AUTO_INCREMENT,
  `UserId` int(10) NOT NULL,
  `OtherUserId` int(10) NOT NULL,
  PRIMARY KEY (`FriendId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `ImageId` int(10) NOT NULL AUTO_INCREMENT,
  `ImageName` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `author` int(10) NOT NULL,
  `Date` date NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `feature` varchar(255) NOT NULL,
  `Original` int(10) NOT NULL,
  `ckecked` int(10) NOT NULL,
  `GroupID` int(10) NOT NULL,
  PRIMARY KEY (`ImageId`),
  UNIQUE KEY `img_url` (`img_url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `image`
--

INSERT INTO `image` (`ImageId`, `ImageName`, `Description`, `author`, `Date`, `img_url`, `feature`, `Original`, `ckecked`, `GroupID`) VALUES
(1, '', '', 4, '2011-11-03', '20111103065920RH1.jpg', '', 0, 0, 13),
(2, '', '', 4, '2011-11-03', '2011110306592061e44a60jw1dlgq936s7aj.jpg', '', 0, 0, 13),
(3, '', '', 4, '2011-11-06', '20111106141025line3.jpg', '', 0, 0, 12),
(4, '', '', 4, '2011-11-10', '20111110131203353ae3e0013b706d006787333cdcb3af.jpg', '', 0, 0, 13);

-- --------------------------------------------------------

--
-- 表的结构 `imagegroup`
--

CREATE TABLE IF NOT EXISTS `imagegroup` (
  `GroupID` int(10) NOT NULL AUTO_INCREMENT,
  `GroupName` varchar(255) NOT NULL,
  `GroupCatalog` int(10) NOT NULL,
  `author` int(10) NOT NULL,
  `updates` date NOT NULL,
  `likes` int(10) NOT NULL,
  `coverid` int(10) NOT NULL,
  PRIMARY KEY (`GroupID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `imagegroup`
--

INSERT INTO `imagegroup` (`GroupID`, `GroupName`, `GroupCatalog`, `author`, `updates`, `likes`, `coverid`) VALUES
(1, '测试组', 1, 2, '2011-09-13', 0, 0),
(2, '测试组2', 1, 2, '2011-09-16', 0, 0),
(3, '1234', 1, 2, '2011-09-27', 0, 0),
(4, '组3', 1, 0, '2011-09-29', 0, 0),
(11, '11111111', 0, 4, '2011-10-20', 0, 0),
(12, 'rt', 0, 4, '2011-10-20', 0, 0),
(13, 'tes', 0, 4, '2011-10-20', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `ProfileId` int(10) NOT NULL AUTO_INCREMENT,
  `UserId` int(10) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `Birthday` varchar(255) NOT NULL,
  `FavoriteHash` varchar(255) NOT NULL,
  `FriendId` int(10) NOT NULL,
  `Shared` int(10) NOT NULL,
  PRIMARY KEY (`ProfileId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `share`
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
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UserID` int(10) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(255) NOT NULL,
  `NickName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `usergroup` int(10) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`UserID`, `UserName`, `NickName`, `email`, `password`, `salt`, `usergroup`) VALUES
(2, 'surgesoft', 'surgesoft', 'surgesoft@gmail.com', 'sxdd288', 'sxdd288', 0),
(3, '11111', '', '111@gmail.com', '111111', '', 0),
(4, 'surgesoft1', '', 'surgesoft1@gmail.com', '94bcbc3ce2efc3da7f1f2de84ef7bd33b8e3d0a0', '63k75cavk0hzwah1268pf2bk9pab4pk2', 0);

-- --------------------------------------------------------

--
-- 表的结构 `usergroup`
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
