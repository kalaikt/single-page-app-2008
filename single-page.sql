-- phpMyAdmin SQL Dump
-- version 2.10.0.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Sep 18, 2008 at 07:38 AM
-- Server version: 5.0.37
-- PHP Version: 5.2.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `peopleu`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `admin_users`
-- 

CREATE TABLE `admin_users` (
  `user_id` int(11) NOT NULL auto_increment,
  `username` varchar(30) collate latin1_general_ci NOT NULL,
  `password` varchar(50) collate latin1_general_ci NOT NULL,
  `first_name` varchar(30) collate latin1_general_ci NOT NULL,
  `last_name` varchar(30) collate latin1_general_ci NOT NULL,
  `email` varchar(50) collate latin1_general_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `admin_users`
-- 

INSERT INTO `admin_users` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3 ', 'kalai', 'kumar', '', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `menus`
-- 

CREATE TABLE `menus` (
  `menu_id` tinyint(4) NOT NULL auto_increment,
  `menu_name` varchar(50) collate latin1_general_ci NOT NULL,
  `menu_content` text collate latin1_general_ci NOT NULL,
  `menu_parent_id` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY  (`menu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `menus`
-- 

INSERT INTO `menus` VALUES (1, 'zxzx', '<div><img src="images/services.jpg"/><br/><div><div class="heading">xzxz</div><div class="sub_heading">zxcxzc</div>xczxczxcxcxz', 0, 1);
INSERT INTO `menus` VALUES (2, 'qwqwe', '<div><img src="images/services.jpg"><br><div><div class="heading">qweqwe</div><div class="sub_heading">qweqwe</div>qweqeqweqwe<br><br><div class="heading">ertert</div><div class="sub_heading">ertert</div> ewrtetr</div></div>', 0, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `news`
-- 

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `title` varchar(250) collate latin1_general_ci NOT NULL,
  `description` text collate latin1_general_ci NOT NULL,
  `image` varchar(250) collate latin1_general_ci NOT NULL,
  `added_date` timestamp NOT NULL default '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY  (`news_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;

-- 
-- Dumping data for table `news`
-- 

INSERT INTO `news` VALUES (1, 1, 'Lirel Holt and Dr. Brad Rahe Present at AASPA Boot Camp in Louisville, KY', 'U, Inc. CEO, Lirel Holt, and Senior Manager of SchoolDistrictU, Dr. Brad Rahe, were presenters at the American Association of School Personnel Administrators (AASPA) Boot Camp held in Louisville, Kentucky. Lirel presented on the subject of mentoring, drawing on his role as president of the Helzberg Entrepreneurial Mentoring Program. He challenged the participants to boldly approach a person they might otherwise not think available to ask them to be a mentor. "It never hurts to ask. Who can turn down someone in schools? I know that I couldn''t. Somehow I would fit it in."\n\nA former superintendent of schools, Dr. Rahe related his professional experiences in school administration to the online training provided by SchoolDistrictU. "The Human Resource department is the meat and potatoes of a school district. Our online training adds the bread and butter to their table," shared Dr. Rahe.\n\nAASPA is the professional organization for the Human Resource Department Administrators in school districts.', '20080807112756DSC00287.JPG', '2008-08-07 11:28:16', 1);
INSERT INTO `news` VALUES (2, 1, 'asd', 'Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description', '20080807112740DSC00285.JPG', '2008-08-07 11:32:08', 1);
INSERT INTO `news` VALUES (5, 1, 'retert', 'wewe wer wor uwe woei weoi oiwer oiwero weori oiweruo weourwo oiweru oiwe oiweoi oioi oiwe oiwer oi weroi oweiu oiewuoiew oiuweroi ewoir oiew oiweoi ewo oiwe oiweroi oweir oiewoi ewou oweuouweo uoiweu oiweuro uweoiroiw eoweuro ewroiu oirueo', '20080807112450DSC00276.JPG', '2008-08-07 11:25:16', 1);
INSERT INTO `news` VALUES (11, 1, 'wrqwr', 'Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description', '20080807112709DSC00301.JPG', '2008-08-07 11:32:46', 1);
INSERT INTO `news` VALUES (10, 1, 'werwer', 'Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description', '', '2008-08-07 11:32:35', 1);
INSERT INTO `news` VALUES (8, 1, 'Sean Ochester and Lirel Holt Take 2nd Place at Bonneville', 'We thought we would add a little "personal" or internal news for those of you that know our CEO and VP of Automotive. What most clients do not know is that Sean Ochester (VP) and Lirel Holt (CEO) enjoy speed. Lirel has been involved in the automotive industry since he was 16 years old and Sean wasn''t alive then, but the two paired up on Saturday June 23rd, with Sean navigating and Lirel driving their 2003 Cobra SVT Mustang to a 2nd place finish at the Bonneville 100 in Wendover, Utah.\n\n"We finished the event .8 seconds off a perfect average of 135 miles an hour, but the winner was .2 seconds closer than we were." Said Vice-President Ochester. "Darn," he added. Holt commented, "Any day that I can drive in something at that speed I feel 19 years old again." I was too slow and got us behind in the curves in the mountains, but Sean urged me on and we caught up when we dropped down into the desert. We were forced to run at almost 160 for the last fifteen to twenty miles."\n\nOchester added, "We ran a good race, but are happy to be home safe and sound."', '20080807113641DSC00271.JPG', '2008-08-07 11:36:48', 1);
INSERT INTO `news` VALUES (9, 1, 'sdfsdf', 'Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description', '20080807112720DSC00279.JPG', '2008-08-07 11:32:23', 1);
INSERT INTO `news` VALUES (12, 1, 'werwerwer wer ewrwerwer ewr', 'Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description', '20080807112651DSC00302.JPG', '2008-08-07 11:32:59', 1);
INSERT INTO `news` VALUES (13, 1, 'test rwrwewe we werwrwr we wer ewrr', 'Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description', '20080807112641DSC00290.JPG', '2008-08-07 11:33:16', 1);
