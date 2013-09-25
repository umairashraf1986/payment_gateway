-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 16, 2012 at 01:20 PM
-- Server version: 5.1.61
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `paymentgatway`
--

-- --------------------------------------------------------

--
-- Table structure for table `crm_admin`
--

CREATE TABLE IF NOT EXISTS `crm_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `noreplyemail` varchar(200) NOT NULL,
  `notifyemail` varchar(200) NOT NULL,
  `paypal` varchar(500) NOT NULL,
  `role` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=39 ;

--
-- Dumping data for table `crm_admin`
--

INSERT INTO `crm_admin` (`id`, `name`, `username`, `password`, `email`, `noreplyemail`, `notifyemail`, `paypal`, `role`, `datetime`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@email.com', '', '', '', 1, '0000-00-00 00:00:00'),
(22, 'Mark', 'mark', '21232f297a57a5a743894a0e4a801fc3', 'mark@gmail.com', '', '', '', 0, '2012-09-14 10:08:45'),
(23, 'abc', 'abc', '4297f44b13955235245b2497399d7a93', 'abc@email.com', '', '', '', 0, '2012-09-26 17:55:18'),
(24, 'Mike', 'mike', '21232f297a57a5a743894a0e4a801fc3', 'mike@hotmail.com', '', '', '', 0, '2012-09-14 10:09:04'),
(38, 'usman', 'usman', '4297f44b13955235245b2497399d7a93', 'usman@biralsabia.net', '', '', '', 0, '2012-09-14 10:07:51');

-- --------------------------------------------------------

--
-- Table structure for table `crm_bank`
--

CREATE TABLE IF NOT EXISTS `crm_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `crm_bank`
--

INSERT INTO `crm_bank` (`id`, `name`) VALUES
(1, 'KTB Bank - 3D Pay Store'),
(2, 'Halk Bank - Non 3D'),
(3, 'Garanti Bank - Non 3D'),
(4, 'IS Bank - Non 3D'),
(5, 'KTB - Non 3D');

-- --------------------------------------------------------

--
-- Table structure for table `crm_contacts`
--

CREATE TABLE IF NOT EXISTS `crm_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` varchar(200) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(100) NOT NULL,
  `info` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `crm_contacts`
--

INSERT INTO `crm_contacts` (`id`, `user_id`, `group_id`, `name`, `email`, `number`, `info`) VALUES
(1, 1, '8,11,3', 'kiran', '', '923335254383', 'tyrtttttttttttttt'),
(2, 1, '1', 'kiran2', '', '923335254383', 'tyrtttttttttttttt'),
(3, 1, '8', 'test', '', '923009733808', 'test info'),
(9, 1, '', 'testnew2', '', '923335254383', ''),
(7, 1, '', 'eee', '', '232323', 'contact 1'),
(8, 1, '', 'testnew', '', '923009733808', ''),
(10, 13, '10', 'sir sarfraz', '', '923465257259', 'sfsdf'),
(11, 13, '10', 'kiran', '', '923335254383', 'fgfhgghgfh'),
(13, 1, '', '923339655445', '', '923338525199', ''),
(14, 1, '11,8', 'vcbc', '', '923335254383', 'cvbcv'),
(15, 1, '3,8,9', 'vcbc', '', '923335254383', 'cvbcv'),
(16, 1, '12', 'vcbc4', '', '923335254383', 'cvbcv4'),
(17, 1, '9', 'ret', '', '5545448545', 'retr'),
(18, 1, '', 'Personalized message no 1', '', '923338525199', ''),
(19, 1, '', 'Personalized message no 2', '', '923339655445', ''),
(20, 1, '', 'Personalized message no 1', '', '923338525199', ''),
(21, 1, '', 'Personalized message no 2', '', '923339655445', '');

-- --------------------------------------------------------

--
-- Table structure for table `crm_contents`
--

CREATE TABLE IF NOT EXISTS `crm_contents` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `eng_title` varchar(255) NOT NULL,
  `eng_contents` text NOT NULL,
  `language` varchar(255) NOT NULL,
  `pagename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `crm_contents`
--

INSERT INTO `crm_contents` (`id`, `eng_title`, `eng_contents`, `language`, `pagename`) VALUES
(1, 'About us', '<p>\r\n	12121Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32</p>\r\n<p>\r\n	Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32</p>\r\n', 'en', 'aboutus'),
(2, 'Contact Us', '<p>\r\n	Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n<p>\r\n	Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32</p>\r\n<p>\r\n	Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32</p>\r\n', 'en', 'contactus'),
(6, 'About the Game', '<p>\r\n	This is about the game .Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32</p>\r\n<p>\r\n	Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32</p>\r\n', 'en', 'aboutthegame'),
(10, 'Privacy Policy', 'Hotels.com.ng has created this privacy policy to demonstrate our commitment to the privacy of the users of our websites. Please read the following to learn more about our privacy policy, and how we treat personally identifiable information collected from our visitors and users.\n<br><br>\n<b>What this Privacy Policy Covers</b>\n\n<li>This privacy policy covers Hotels.com.ng''s treatment of personally identifiable information collected by Hotels.com.ng through a website owned and operated by Hotels.com.ng.</li>\n<li>This privacy policy does not apply to the practices of companies that Hotels.com.ng does not own or control, or of persons that Hotels.com.ng does not employ or manage, including any third-party content contributors bound by contract and any third-party websites to which Hotels.com.ng websites link.</li>\n<br>\n<b>Collection and Use of Personal Information</b>\n\n<li>You can visit the websites of Hotels.com.ng without revealing any personal information. However, Hotels.com.ng needs certain personal information if you wish to purchase our products, register for an affiliate account, receive Hotels.com.ng newsletter, or use certain Hotels.com.ng services.<br></li>\n<li>Where required, this information may include your personal contact information and/or your company contact information. Hotels.com.ng will use this information to reply to your inquiries, to provide you with requested products and services, to set up your member''s account, and to contact you regarding new products and services.<br></li>\n<li>By accessing the services of Hotels.com.ng and voluntarily providing us with the requested personal information, you consent to the collection and use of the information in accordance with this privacy policy.<br><br></li>\n<b>Collection and Use of Non-Personal Information</b>\n\n<li>Hotels.com.ng automatically receives and records non-personal information on our server logs from your browser including your IP address, cookie information and the page you requested. Hotels.com.ng may use this information to customize the advertising and content you see and to fulfill your requests for certain products and services. However, Hotels.com.ng does not connect this non-personal data to any personal information collected from you.<br></li>\n<li>Hotels.com.ng also allows third party companies that are presenting advertisements on some of our pages to set and access their cookies on your computer. Again, these cookies are not connected to any personal information. Third party cookie usage is subject to their own privacy policies, and Hotels.com.ng assumes no responsibility or liability for this usage.</li>\n<br><b>Information Sharing and Disclosure</b><br>\n\n<li>Hotels.com.ng may disclose your personal information to third parties who work on behalf of Hotels.com.ng to provide products and services requested by you. We will share personal information for these purposes only with third parties whose privacy policies are consistent with ours or who agree to abide by our policies with respect to personal information</li>\n<li>Hotels.com.ng may otherwise disclose your personal information when:\n<br>- We have your express consent to share the information for a specified purpose;\n<br>- We need to respond to subpoenas, court orders or such other legal process;\n<br>- We need to protect the personal safety of the users of our websites or defend the rights or property of Hotels.com.ng;\n<br>- We find that your actions on our websites violate the Hotels.com.ng Terms of Use document or any of our usage guidelines for specific products or services.</li>\n<br><b>\nConsent</b><br>\n\n<li>If you do not consent to the collection, use or disclosure of your personal information as outlined in this policy, please do not provide any personal information to Hotels.com.ng. If you have provided personal information to Hotels.com.ng and no longer consent to its use or disclosure as outlined herein, please notify Hotels.com.ng at hotelsnigeria@gmail.com or hotels.com.ng@gmail.com.</li>\n<br><b>Security</b><br>\n\n<li>Unfortunately, no data transmission over the Internet can be considered 100% secure. However, your Hotels.com.ng Information is protected for your privacy and security. In certain areas of our websites, as identified on the site, Hotels.com.ng uses industry-standard SSL-encryption to protect data transmissions.</li>\n<li>We also safeguard your personal information from unauthorized access, through access control procedures, network firewalls and physical security measures.</li>\n<li>Further, Hotels.com.ng retains your personal information only as long as necessary to fulfil the purposes identified above or as required by law.</li>\n<br><b>Changes to this Privacy Policy</b><br>\n\n<li>Hotels.com.ng may at any time, without notice to you and in its sole discretion, amend this policy from time to time. Please review this policy periodically. Your continued use of Hotels.com.ng websites after any such amendments signifies your acceptance thereof.</li>\n<br><b>Questions or Suggestions</b><br>\n\nIf you have questions or suggestions about this privacy policy, or your own personal information, please e-mail us at info@hotels.com.ng.', 'en', 'privacy'),
(11, 'FAQs', 'yyyyyyyyyyyyyyyyyyyyy', 'en', 'faqs'),
(14, 'How to play', '<p>\r\n	Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32</p>\r\n<p>\r\n	Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32</p>\r\n<p>\r\n	Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32</p>\r\n<p>\r\n	&nbsp;</p>\r\n<div firebugversion="1.5.0" id="_firebugConsole" style="display: none;">\r\n	&nbsp;</div>\r\n', 'en', 'howtoplay'),
(15, 'Home', '<p>\r\n	This is home section.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32</p>\r\n<p>\r\n	Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32</p>\r\n', '', 'home');

-- --------------------------------------------------------

--
-- Table structure for table `crm_merchants`
--

CREATE TABLE IF NOT EXISTS `crm_merchants` (
  `merchant_id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_website` varchar(555) NOT NULL,
  `return_url` text,
  `merchant_status` int(11) NOT NULL,
  `merchant_image` varchar(255) DEFAULT NULL,
  `assigntoadmin` varchar(255) NOT NULL,
  `assign_bank` int(11) DEFAULT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  `api_user` varchar(255) DEFAULT NULL,
  `api_pass` varchar(255) DEFAULT NULL,
  `mercht_username` varchar(255) DEFAULT NULL,
  `api_mode` int(11) NOT NULL,
  PRIMARY KEY (`merchant_id`),
  UNIQUE KEY `merchant_website` (`merchant_website`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=187 ;

--
-- Dumping data for table `crm_merchants`
--

INSERT INTO `crm_merchants` (`merchant_id`, `merchant_website`, `return_url`, `merchant_status`, `merchant_image`, `assigntoadmin`, `assign_bank`, `payment_mode`, `client_id`, `api_user`, `api_pass`, `mercht_username`, `api_mode`) VALUES
(179, 'gmail.com', 'http://115.186.183.245/game/thankyou', 1, '13475992421238336425.jpg', '38', 4, 'Live', '', '', '', 'Mike', 0),
(127, 'example.com', 'http://192.168.1.17/game/thankyou', 0, '13476037911519907716.jpg', '22', 1, 'Test', NULL, NULL, NULL, 'Johnson', 0),
(143, 'apple.com', 'http://192.168.1.17/game/thankyou', 1, '13476037821137473756.jpg', '24', 1, 'Test', NULL, NULL, NULL, 'John', 0),
(154, 'pokeapanda.net', '', 1, '13478867121699857432.jpg', '22', 2, 'Test', '110000000', 'KUVEYTTURKAPI', 'KUVEYTTURK11', 'Demo', 1),
(155, 'yahoo.com', 'http://192.168.1.17/game/thankyou', 1, '1347603806747187929.jpg', '23', 1, 'Test', NULL, NULL, NULL, 'Demo', 0),
(183, 'usman.com', 'http://192.168.1.17/game/thankyou', 1, '', '38', 2, 'Live', '110000000', 'KUVEYTTURKAPI', 'KUVEYTTURK11', 'usman', 0);

-- --------------------------------------------------------

--
-- Table structure for table `crm_payments`
--

CREATE TABLE IF NOT EXISTS `crm_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `dateadded` datetime NOT NULL,
  `status` varchar(100) NOT NULL,
  `payment_fee` float NOT NULL,
  `payer_email` varchar(500) NOT NULL,
  `receiver_email` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `crm_payments`
--

INSERT INTO `crm_payments` (`id`, `user_id`, `amount`, `dateadded`, `status`, `payment_fee`, `payer_email`, `receiver_email`) VALUES
(6, 1, 31.96, '2012-03-19 11:37:44', 'Completed', 0, '', ''),
(13, 1, 34.66, '2012-03-19 11:55:53', 'Completed 	', 1.34, '', ''),
(14, 0, 0, '2012-03-19 12:06:17', '', 0, '', ''),
(15, 1, 441.5, '2012-03-19 12:06:18', 'Completed', 13.5, 'kiran._1328174730_per@biralsabia.net', 'seller_1328175088_biz@biralsabia.net'),
(16, 0, 0, '2012-03-19 12:09:44', '', 0, '', ''),
(17, 1, 3883.7, '2012-03-19 12:09:45', 'Completed', 116.3, 'kiran._1328174730_per@biralsabia.net', 'seller_1328175088_biz@biralsabia.net'),
(18, 0, 0, '2012-03-19 12:11:38', '', 0, '', ''),
(19, 1, 3928.37, '2012-03-19 12:11:39', 'Completed', 117.63, 'kiran._1328174730_per@biralsabia.net', 'seller_1328175088_biz@biralsabia.net'),
(20, 0, 0, '2012-03-19 12:13:34', '', 0, '', ''),
(21, 1, 1941.7, '2012-03-19 12:13:36', 'Completed', 58.3, 'kiran._1328174730_per@biralsabia.net', 'seller_1328175088_biz@biralsabia.net'),
(22, 0, 0, '2012-03-19 12:15:27', '', 0, '', ''),
(23, 1, 227.88, '2012-03-19 12:15:29', 'Completed', 7.12, 'kiran._1328174730_per@biralsabia.net', 'seller_1328175088_biz@biralsabia.net'),
(24, 1, 227.88, '2012-03-19 12:16:13', 'Completed', 7.12, 'kiran._1328174730_per@biralsabia.net', 'seller_1328175088_biz@biralsabia.net'),
(25, 0, 0, '2012-05-11 10:58:46', '', 0, '', ''),
(26, 1, 48.25, '2012-05-11 10:59:26', 'Completed', 1.75, 'kiran._1328174730_per@biralsabia.net', 'seller_1328175088_biz@biralsabia.net'),
(27, 1, 48.25, '2012-05-11 11:06:50', 'Completed', 1.75, 'kiran._1328174730_per@biralsabia.net', 'seller_1328175088_biz@biralsabia.net'),
(28, 1, 48.25, '2012-05-11 11:07:32', 'Completed', 1.75, 'kiran._1328174730_per@biralsabia.net', 'seller_1328175088_biz@biralsabia.net'),
(29, 1, 48.25, '2012-05-11 11:08:46', 'Completed', 1.75, 'kiran._1328174730_per@biralsabia.net', 'seller_1328175088_biz@biralsabia.net'),
(30, 1, 48.25, '2012-05-11 11:10:29', 'Completed', 1.75, 'kiran._1328174730_per@biralsabia.net', 'seller_1328175088_biz@biralsabia.net'),
(31, 0, 0, '2012-05-11 11:13:05', '', 0, '', ''),
(32, 1, 33.68, '2012-05-11 11:13:45', 'Completed', 1.32, 'kiran._1328174730_per@biralsabia.net', 'seller_1328175088_biz@biralsabia.net'),
(33, 1, 33.68, '2012-05-11 11:19:22', 'Completed', 1.32, 'kiran._1328174730_per@biralsabia.net', 'seller_1328175088_biz@biralsabia.net');

-- --------------------------------------------------------

--
-- Table structure for table `crm_site_config`
--

CREATE TABLE IF NOT EXISTS `crm_site_config` (
  `id` int(1) NOT NULL,
  `admin_panel_url` varchar(250) NOT NULL,
  `admin_panel_title` varchar(250) NOT NULL,
  `company_name` text NOT NULL,
  `show_country_list` varchar(3) NOT NULL,
  `date_format` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `crm_site_config`
--

INSERT INTO `crm_site_config` (`id`, `admin_panel_url`, `admin_panel_title`, `company_name`, `show_country_list`, `date_format`) VALUES
(1, 'http://serverpath/dirctoryname/', ':: Company Demo ::', 'Demo', '', 'm/d/Y');

-- --------------------------------------------------------

--
-- Table structure for table `crm_transaction_log`
--

CREATE TABLE IF NOT EXISTS `crm_transaction_log` (
  `rp_id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_web` text,
  `auth_code` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `response` varchar(255) DEFAULT NULL,
  `amount` double(10,2) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `address1` text,
  `address2` text,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `pay_description` text,
  `return_url` text,
  `client_ip` varchar(255) DEFAULT NULL,
  `transaction_datetime` varchar(255) NOT NULL,
  `creditcard_no` varchar(255) DEFAULT NULL,
  `mid` int(11) NOT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `api_mode` int(11) NOT NULL,
  `merchant_order_no` varchar(255) NOT NULL,
  `error_desc` longtext NOT NULL,
  PRIMARY KEY (`rp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=444 ;

--
-- Dumping data for table `crm_transaction_log`
--

INSERT INTO `crm_transaction_log` (`rp_id`, `merchant_web`, `auth_code`, `transaction_id`, `response`, `amount`, `order_id`, `fullname`, `telephone`, `address1`, `address2`, `country`, `city`, `state`, `zip_code`, `pay_description`, `return_url`, `client_ip`, `transaction_datetime`, `creditcard_no`, `mid`, `bank_id`, `api_mode`, `merchant_order_no`, `error_desc`) VALUES
(443, 'pokeapanda.net', '', '12290LAMC19453', 'Error', 9.00, '', 'admin', '090065', 'Address 1', 'Address 21', 'Ao', 'Texas', 'texas states', '46000', '71-ikhan009', '', '192.168.1.212', '2012-10-16 11:00:12', '4025894025894022', 154, 2, 1, '2881488371350375387', 'Islem icin kullanilan kartin CVV degeri 000 olamaz.'),
(442, 'pokeapanda.net', '', '12290JluB19199', 'Error', 1.00, '', 'admin', 'rtyrtyryt', 'Address 1', 'Address 2', 'Dz', 'city', 'state', '46000', '72-ikhan009', '', '192.168.1.212', '2012-10-16 09:37:46', '467293900339801', 154, 2, 1, '17388130921350370304', 'Kredi karti numarasi gecerli formatta degil.'),
(440, 'pokeapanda.net', '775983', '12283HyVF11404', 'Approved', 2.00, '7113677511349759177', 'admin', '09006555', 'Address 1', 'Address 2', 'Az', 'city', 'state', '46000', '67-Golden', 'http://192.168.1.17/game/thankyou', '192.168.1.212', '2012-10-09 07:50:21', '4920244920244921', 154, 2, 1, '7113677511349759177', ''),
(441, 'pokeapanda.net', '974412', '12283IDAF11431', 'Approved', 100.00, '8656046511349759589', 'admin', '09006555', 'Address 11', 'Address 2', 'Bs', 'city', 'state', '46000', '73-any', 'http://192.168.1.17/game/thankyo', '192.168.1.212', '2012-10-09 08:03:00', '4920244920244921', 154, 2, 1, '8656046511349759589', ''),
(439, 'pokeapanda.net', '443742', '12283HvgJ11382', 'Approved', 1.00, '20296190831349759015', 'admin', '090065', 'Address 1', 'Address 21', 'At', 'city', 'state', '46000', '72-ikhan009', 'http://192.168.1.17/game/thankyou', '192.168.1.212', '2012-10-09 07:47:32', '4920244920244921', 154, 2, 1, '20296190831349759015', ''),
(438, 'pokeapanda.net', '901415', '12283Ht9C11371', 'Approved', 2.00, '11871666761349758909', 'admin', '09006555', 'Address 1', 'Address 2', 'Ad', 'city', 'state', '46000', '67-Golden', 'http://192.168.1.17/game/thankyou', '192.168.1.212', '2012-10-09 07:45:59', '4920244920244921', 154, 2, 1, '11871666761349758909', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
