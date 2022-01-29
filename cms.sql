-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2022 at 03:45 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(53, 'PHP'),
(54, 'Python'),
(55, 'HTML');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(2, 136, 'Pede nascetur', 'nascetur@cms.com', 'Magna pede iaculis duis luctus maecenas sagittis tristique parturient', 'approved', '2022-01-03'),
(3, 151, 'GomuOP', 'gomu@cms.com', 'OP Post', 'approved', '2022-01-27'),
(4, 151, 'PeachuOP', 'peachu@cms.com', 'OP Post', 'approved', '2022-01-27'),
(5, 136, 'Nascetur euismod', 'euismod@cms.com', 'Maecenas consectetuer viverra nulla potenti donec ultrices fusce lacus praesent per.', 'approved', '2022-01-27');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` varchar(255) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(136, 53, 'Suscipit ultrices augue', 'Facilisi phasellus', 'test', '2022-01-29', 'img-8.png', '<p>Nunc nec odio venenatis erat duis cras vehicula dictum. Conubia cubilia venenatis consectetuer maximus mus accumsan litora fermentum. Eleifend senectus sapien dictumst magna cras fames finibus. Est facilisi letius pharetra enim at quam maecenas tortor ultrices. Primis felis vel elementum rhoncus nullam finibus auctor montes quam. Himenaeos magnis montes ipsum tortor amet magna. Sit lobortis ante aptent interdum vivamus curae nisl odio viverra rutrum tristique. Nullam imperdiet metus velit ipsum purus phasellus aenean eu.</p><p><br></p><p>Sagittis efficitur eget proin potenti pede integer facilisi nostra massa aliquet. Litora dapibus tortor parturient venenatis proin enim libero maximus ultricies mi. Pellentesque litora potenti dictumst quis elementum a vivamus semper. Ante rhoncus et venenatis elementum penatibus eros ullamcorper faucibus facilisi. Pretium morbi placerat amet curae iaculis consequat sociosqu. Sem sodales vulputate mus et cras inceptos torquent letius pellentesque libero. Maximus eget scelerisque lacus justo magnis arcu litora velit hendrerit. Dictumst mi sociosqu ullamcorper congue hac turpis integer tincidunt.</p>', 'php', '2', 'published', 13),
(137, 54, 'Neque pede sociosqu', 'Quam facilisi', 'test', '2022-01-29', 'img-7.png', '<p>Pretium fringilla netus proin vehicula consectetur penatibus. Pulvinar adipiscing vestibulum tortor tempor sociosqu facilisis sed sem ultrices nisi. Est posuere ad id pede natoque diam neque lorem non. Aptent nulla suscipit massa quis vehicula rutrum mollis eleifend semper tempus. Aenean rhoncus nulla tempus urna porttitor. Ut congue semper leo etiam curae fusce curabitur vestibulum viverra. Et nibh cursus netus eros pellentesque dictum volutpat commodo justo class. Ipsum pede gravida vestibulum mus cubilia aptent eu montes.</p><p><br></p><p>Finibus vehicula fames posuere cursus fringilla. Nisi et aptent euismod convallis pede rutrum a vulputate pulvinar. Luctus mattis rhoncus ex si viverra maximus dictumst. Dictum ad consequat dui vestibulum dictumst blandit aptent turpis arcu. Tortor praesent amet auctor justo faucibus consequat odio mauris. Massa cubilia scelerisque torquent duis nisl ligula.</p>', 'php', '0', 'published', 3),
(138, 54, 'Potenti malesuada donec', 'Quam facilisi', 'test', '2022-01-29', 'img-6.png', '<p>Ipsum integer taciti magna himenaeos per hac. Lobortis facilisi dis dapibus sagittis arcu amet porttitor felis praesent. Vestibulum consectetuer placerat dictumst senectus eros est consectetur praesent bibendum vitae nascetur. Rutrum arcu natoque curae letius cubilia at. Venenatis cursus odio cras at tempor dui nascetur. Sem rutrum mollis maximus quam risus curabitur velit fringilla proin id</p>', 'php', '0', 'published', 0),
(139, 54, 'Suscipit ultrices augue', 'Facilisi phasellus', 'test', '2022-01-29', 'img-5.png', '<p>Nunc nec odio venenatis erat duis cras vehicula dictum. Conubia cubilia venenatis consectetuer maximus mus accumsan litora fermentum. Eleifend senectus sapien dictumst magna cras fames finibus. Est facilisi letius pharetra enim at quam maecenas tortor ultrices. Primis felis vel elementum rhoncus nullam finibus auctor montes quam. Himenaeos magnis montes ipsum tortor amet magna. Sit lobortis ante aptent interdum vivamus curae nisl odio viverra rutrum tristique. Nullam imperdiet metus velit ipsum purus phasellus aenean eu.</p><p><br></p><p>Sagittis efficitur eget proin potenti pede integer facilisi nostra massa aliquet. Litora dapibus tortor parturient venenatis proin enim libero maximus ultricies mi. Pellentesque litora potenti dictumst quis elementum a vivamus semper. Ante rhoncus et venenatis elementum penatibus eros ullamcorper faucibus facilisi. Pretium morbi placerat amet curae iaculis consequat sociosqu. Sem sodales vulputate mus et cras inceptos torquent letius pellentesque libero. Maximus eget scelerisque lacus justo magnis arcu litora velit hendrerit. Dictumst mi sociosqu ullamcorper congue hac turpis integer tincidunt.</p>', 'php', '0', 'published', 0),
(140, 53, 'Suscipit ultrices augue', 'Facilisi phasellus', 'hacker', '2022-01-29', 'img-4.png', '<p>Nunc nec odio venenatis erat duis cras vehicula dictum. Conubia cubilia venenatis consectetuer maximus mus accumsan litora fermentum. Eleifend senectus sapien dictumst magna cras fames finibus. Est facilisi letius pharetra enim at quam maecenas tortor ultrices. Primis felis vel elementum rhoncus nullam finibus auctor montes quam. Himenaeos magnis montes ipsum tortor amet magna. Sit lobortis ante aptent interdum vivamus curae nisl odio viverra rutrum tristique. Nullam imperdiet metus velit ipsum purus phasellus aenean eu.</p><p><br></p><p>Sagittis efficitur eget proin potenti pede integer facilisi nostra massa aliquet. Litora dapibus tortor parturient venenatis proin enim libero maximus ultricies mi. Pellentesque litora potenti dictumst quis elementum a vivamus semper. Ante rhoncus et venenatis elementum penatibus eros ullamcorper faucibus facilisi. Pretium morbi placerat amet curae iaculis consequat sociosqu. Sem sodales vulputate mus et cras inceptos torquent letius pellentesque libero. Maximus eget scelerisque lacus justo magnis arcu litora velit hendrerit. Dictumst mi sociosqu ullamcorper congue hac turpis integer tincidunt.</p>', 'php', '0', 'published', 0),
(141, 53, 'Suscipit ultrices augue', 'Facilisi phasellus', 'hacker', '2022-01-29', 'img-3.png', '<p>Nunc nec odio venenatis erat duis cras vehicula dictum. Conubia cubilia venenatis consectetuer maximus mus accumsan litora fermentum. Eleifend senectus sapien dictumst magna cras fames finibus. Est facilisi letius pharetra enim at quam maecenas tortor ultrices. Primis felis vel elementum rhoncus nullam finibus auctor montes quam. Himenaeos magnis montes ipsum tortor amet magna. Sit lobortis ante aptent interdum vivamus curae nisl odio viverra rutrum tristique. Nullam imperdiet metus velit ipsum purus phasellus aenean eu.</p><p><br></p><p>Sagittis efficitur eget proin potenti pede integer facilisi nostra massa aliquet. Litora dapibus tortor parturient venenatis proin enim libero maximus ultricies mi. Pellentesque litora potenti dictumst quis elementum a vivamus semper. Ante rhoncus et venenatis elementum penatibus eros ullamcorper faucibus facilisi. Pretium morbi placerat amet curae iaculis consequat sociosqu. Sem sodales vulputate mus et cras inceptos torquent letius pellentesque libero. Maximus eget scelerisque lacus justo magnis arcu litora velit hendrerit. Dictumst mi sociosqu ullamcorper congue hac turpis integer tincidunt.</p>', 'php', '0', 'published', 0),
(142, 53, 'Suscipit ultrices augue', 'Facilisi phasellus', 'hacker', '2022-01-29', 'img-2.png', '<p>Nunc nec odio venenatis erat duis cras vehicula dictum. Conubia cubilia venenatis consectetuer maximus mus accumsan litora fermentum. Eleifend senectus sapien dictumst magna cras fames finibus. Est facilisi letius pharetra enim at quam maecenas tortor ultrices. Primis felis vel elementum rhoncus nullam finibus auctor montes quam. Himenaeos magnis montes ipsum tortor amet magna. Sit lobortis ante aptent interdum vivamus curae nisl odio viverra rutrum tristique. Nullam imperdiet metus velit ipsum purus phasellus aenean eu.</p><p><br></p><p>Sagittis efficitur eget proin potenti pede integer facilisi nostra massa aliquet. Litora dapibus tortor parturient venenatis proin enim libero maximus ultricies mi. Pellentesque litora potenti dictumst quis elementum a vivamus semper. Ante rhoncus et venenatis elementum penatibus eros ullamcorper faucibus facilisi. Pretium morbi placerat amet curae iaculis consequat sociosqu. Sem sodales vulputate mus et cras inceptos torquent letius pellentesque libero. Maximus eget scelerisque lacus justo magnis arcu litora velit hendrerit. Dictumst mi sociosqu ullamcorper congue hac turpis integer tincidunt.</p>', 'php', '0', 'published', 0),
(143, 55, 'Suscipit ultrices augue', 'Facilisi phasellus', 'hacker', '2022-01-29', 'img-1.png', '<p>Nunc nec odio venenatis erat duis cras vehicula dictum. Conubia cubilia venenatis consectetuer maximus mus accumsan litora fermentum. Eleifend senectus sapien dictumst magna cras fames finibus. Est facilisi letius pharetra enim at quam maecenas tortor ultrices. Primis felis vel elementum rhoncus nullam finibus auctor montes quam. Himenaeos magnis montes ipsum tortor amet magna. Sit lobortis ante aptent interdum vivamus curae nisl odio viverra rutrum tristique. Nullam imperdiet metus velit ipsum purus phasellus aenean eu.</p><p><br></p><p>Sagittis efficitur eget proin potenti pede integer facilisi nostra massa aliquet. Litora dapibus tortor parturient venenatis proin enim libero maximus ultricies mi. Pellentesque litora potenti dictumst quis elementum a vivamus semper. Ante rhoncus et venenatis elementum penatibus eros ullamcorper faucibus facilisi. Pretium morbi placerat amet curae iaculis consequat sociosqu. Sem sodales vulputate mus et cras inceptos torquent letius pellentesque libero. Maximus eget scelerisque lacus justo magnis arcu litora velit hendrerit. Dictumst mi sociosqu ullamcorper congue hac turpis integer tincidunt.</p>', 'php', '0', 'published', 0),
(144, 55, 'Suscipit ultrices augue', 'Facilisi phasellus', 'user', '2022-01-29', 'img-1.png', '<p>Nunc nec odio venenatis erat duis cras vehicula dictum. Conubia cubilia venenatis consectetuer maximus mus accumsan litora fermentum. Eleifend senectus sapien dictumst magna cras fames finibus. Est facilisi letius pharetra enim at quam maecenas tortor ultrices. Primis felis vel elementum rhoncus nullam finibus auctor montes quam. Himenaeos magnis montes ipsum tortor amet magna. Sit lobortis ante aptent interdum vivamus curae nisl odio viverra rutrum tristique. Nullam imperdiet metus velit ipsum purus phasellus aenean eu.</p><p><br></p><p>Sagittis efficitur eget proin potenti pede integer facilisi nostra massa aliquet. Litora dapibus tortor parturient venenatis proin enim libero maximus ultricies mi. Pellentesque litora potenti dictumst quis elementum a vivamus semper. Ante rhoncus et venenatis elementum penatibus eros ullamcorper faucibus facilisi. Pretium morbi placerat amet curae iaculis consequat sociosqu. Sem sodales vulputate mus et cras inceptos torquent letius pellentesque libero. Maximus eget scelerisque lacus justo magnis arcu litora velit hendrerit. Dictumst mi sociosqu ullamcorper congue hac turpis integer tincidunt.</p>', 'php', '0', 'published', 0),
(145, 55, 'Suscipit ultrices augue', 'Facilisi phasellus', 'user', '2022-01-29', 'img-2.png', '<p>Nunc nec odio venenatis erat duis cras vehicula dictum. Conubia cubilia venenatis consectetuer maximus mus accumsan litora fermentum. Eleifend senectus sapien dictumst magna cras fames finibus. Est facilisi letius pharetra enim at quam maecenas tortor ultrices. Primis felis vel elementum rhoncus nullam finibus auctor montes quam. Himenaeos magnis montes ipsum tortor amet magna. Sit lobortis ante aptent interdum vivamus curae nisl odio viverra rutrum tristique. Nullam imperdiet metus velit ipsum purus phasellus aenean eu.</p><p><br></p><p>Sagittis efficitur eget proin potenti pede integer facilisi nostra massa aliquet. Litora dapibus tortor parturient venenatis proin enim libero maximus ultricies mi. Pellentesque litora potenti dictumst quis elementum a vivamus semper. Ante rhoncus et venenatis elementum penatibus eros ullamcorper faucibus facilisi. Pretium morbi placerat amet curae iaculis consequat sociosqu. Sem sodales vulputate mus et cras inceptos torquent letius pellentesque libero. Maximus eget scelerisque lacus justo magnis arcu litora velit hendrerit. Dictumst mi sociosqu ullamcorper congue hac turpis integer tincidunt.</p>', 'php', '0', 'published', 0),
(146, 54, 'Suscipit ultrices augue', 'Facilisi phasellus', 'user', '2022-01-29', 'img-3.png', '<p>Nunc nec odio venenatis erat duis cras vehicula dictum. Conubia cubilia venenatis consectetuer maximus mus accumsan litora fermentum. Eleifend senectus sapien dictumst magna cras fames finibus. Est facilisi letius pharetra enim at quam maecenas tortor ultrices. Primis felis vel elementum rhoncus nullam finibus auctor montes quam. Himenaeos magnis montes ipsum tortor amet magna. Sit lobortis ante aptent interdum vivamus curae nisl odio viverra rutrum tristique. Nullam imperdiet metus velit ipsum purus phasellus aenean eu.</p><p><br></p><p>Sagittis efficitur eget proin potenti pede integer facilisi nostra massa aliquet. Litora dapibus tortor parturient venenatis proin enim libero maximus ultricies mi. Pellentesque litora potenti dictumst quis elementum a vivamus semper. Ante rhoncus et venenatis elementum penatibus eros ullamcorper faucibus facilisi. Pretium morbi placerat amet curae iaculis consequat sociosqu. Sem sodales vulputate mus et cras inceptos torquent letius pellentesque libero. Maximus eget scelerisque lacus justo magnis arcu litora velit hendrerit. Dictumst mi sociosqu ullamcorper congue hac turpis integer tincidunt.</p>', 'php', '0', 'published', 0),
(147, 54, 'Suscipit ultrices augue', 'Facilisi phasellus', 'user', '2022-01-29', 'img-4.png', '<p>Nunc nec odio venenatis erat duis cras vehicula dictum. Conubia cubilia venenatis consectetuer maximus mus accumsan litora fermentum. Eleifend senectus sapien dictumst magna cras fames finibus. Est facilisi letius pharetra enim at quam maecenas tortor ultrices. Primis felis vel elementum rhoncus nullam finibus auctor montes quam. Himenaeos magnis montes ipsum tortor amet magna. Sit lobortis ante aptent interdum vivamus curae nisl odio viverra rutrum tristique. Nullam imperdiet metus velit ipsum purus phasellus aenean eu.</p><p><br></p><p>Sagittis efficitur eget proin potenti pede integer facilisi nostra massa aliquet. Litora dapibus tortor parturient venenatis proin enim libero maximus ultricies mi. Pellentesque litora potenti dictumst quis elementum a vivamus semper. Ante rhoncus et venenatis elementum penatibus eros ullamcorper faucibus facilisi. Pretium morbi placerat amet curae iaculis consequat sociosqu. Sem sodales vulputate mus et cras inceptos torquent letius pellentesque libero. Maximus eget scelerisque lacus justo magnis arcu litora velit hendrerit. Dictumst mi sociosqu ullamcorper congue hac turpis integer tincidunt.</p>', 'php', '0', 'published', 0),
(148, 54, 'Suscipit ultrices augue', 'Facilisi phasellus', 'user', '2022-01-29', 'img-5.png', '<p>Nunc nec odio venenatis erat duis cras vehicula dictum. Conubia cubilia venenatis consectetuer maximus mus accumsan litora fermentum. Eleifend senectus sapien dictumst magna cras fames finibus. Est facilisi letius pharetra enim at quam maecenas tortor ultrices. Primis felis vel elementum rhoncus nullam finibus auctor montes quam. Himenaeos magnis montes ipsum tortor amet magna. Sit lobortis ante aptent interdum vivamus curae nisl odio viverra rutrum tristique. Nullam imperdiet metus velit ipsum purus phasellus aenean eu.</p><p><br></p><p>Sagittis efficitur eget proin potenti pede integer facilisi nostra massa aliquet. Litora dapibus tortor parturient venenatis proin enim libero maximus ultricies mi. Pellentesque litora potenti dictumst quis elementum a vivamus semper. Ante rhoncus et venenatis elementum penatibus eros ullamcorper faucibus facilisi. Pretium morbi placerat amet curae iaculis consequat sociosqu. Sem sodales vulputate mus et cras inceptos torquent letius pellentesque libero. Maximus eget scelerisque lacus justo magnis arcu litora velit hendrerit. Dictumst mi sociosqu ullamcorper congue hac turpis integer tincidunt.</p>', 'php', '0', 'published', 0),
(149, 53, 'Potenti malesuada donec', 'Quam facilisi', 'admin', '2022-01-29', 'img-6.png', '<p>Ipsum integer taciti magna himenaeos per hac. Lobortis facilisi dis dapibus sagittis arcu amet porttitor felis praesent. Vestibulum consectetuer placerat dictumst senectus eros est consectetur praesent bibendum vitae nascetur. Rutrum arcu natoque curae letius cubilia at. Venenatis cursus odio cras at tempor dui nascetur. Sem rutrum mollis maximus quam risus curabitur velit fringilla proin id</p>', 'php', '0', 'published', 0),
(150, 53, 'Neque pede sociosqu', 'Quam facilisi', 'admin', '2022-01-29', 'img-7.png', '<p>Pretium fringilla netus proin vehicula consectetur penatibus. Pulvinar adipiscing vestibulum tortor tempor sociosqu facilisis sed sem ultrices nisi. Est posuere ad id pede natoque diam neque lorem non. Aptent nulla suscipit massa quis vehicula rutrum mollis eleifend semper tempus. Aenean rhoncus nulla tempus urna porttitor. Ut congue semper leo etiam curae fusce curabitur vestibulum viverra. Et nibh cursus netus eros pellentesque dictum volutpat commodo justo class. Ipsum pede gravida vestibulum mus cubilia aptent eu montes.</p><p><br></p><p>Finibus vehicula fames posuere cursus fringilla. Nisi et aptent euismod convallis pede rutrum a vulputate pulvinar. Luctus mattis rhoncus ex si viverra maximus dictumst. Dictum ad consequat dui vestibulum dictumst blandit aptent turpis arcu. Tortor praesent amet auctor justo faucibus consequat odio mauris. Massa cubilia scelerisque torquent duis nisl ligula.</p>', 'php', '-4', 'published', 15),
(151, 53, 'Suscipit ultrices augue', 'Facilisi phasellus', 'admin', '2022-01-29', 'img-8.png', '<p>Nunc nec odio venenatis erat duis cras vehicula dictum. Conubia cubilia venenatis consectetuer maximus mus accumsan litora fermentum. Eleifend senectus sapien dictumst magna cras fames finibus. Est facilisi letius pharetra enim at quam maecenas tortor ultrices. Primis felis vel elementum rhoncus nullam finibus auctor montes quam. Himenaeos magnis montes ipsum tortor amet magna. Sit lobortis ante aptent interdum vivamus curae nisl odio viverra rutrum tristique. Nullam imperdiet metus velit ipsum purus phasellus aenean eu.</p><p><br></p><p>Sagittis efficitur eget proin potenti pede integer facilisi nostra massa aliquet. Litora dapibus tortor parturient venenatis proin enim libero maximus ultricies mi. Pellentesque litora potenti dictumst quis elementum a vivamus semper. Ante rhoncus et venenatis elementum penatibus eros ullamcorper faucibus facilisi. Pretium morbi placerat amet curae iaculis consequat sociosqu. Sem sodales vulputate mus et cras inceptos torquent letius pellentesque libero. Maximus eget scelerisque lacus justo magnis arcu litora velit hendrerit. Dictumst mi sociosqu ullamcorper congue hac turpis integer tincidunt.</p>', 'php', '2', 'published', 24),
(156, 53, 'TEST', '', 'admin', '2022-01-29', 'img-9.png', '<p>TEST<br></p>', 'TEST', '', 'published', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22',
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`, `token`) VALUES
(4, 'admin', '$2y$10$iusesomecrazystrings2uwxqVj7J7zQRBheEH.fn4YwpBoRp5IC6', 'Admin', '', 'admin@cms.com', 'user-male.png', 'admin', '$2y$10$iusesomecrazystrings22', ''),
(5, 'user', '$2y$10$iusesomecrazystrings2uhdMPokOSZ/iRZh9BuNsp5gZKUni49l6', 'User', '', 'user@cms.com', 'user-male.png', 'admin', '$2y$10$iusesomecrazystrings22', ''),
(8, 'hacker', '$2y$10$KcIvkX3efkBTzKtv5yejxe3qmvn13rIPdCcjs.2mk6makFzKB62aq', 'Hacker', '', 'hacker@cms.com', 'user-male.png', 'admin', '$2y$10$iusesomecrazystrings22', ''),
(9, 'test', '$2y$12$dOGT3y3yDcIsLVAGg2YnAujLTHhTAHxvDLoJvAbDvxKP8jR/C8/va', 'Test', '', 'test@cms.com', 'user-male.png', 'admin', '$2y$10$iusesomecrazystrings22', ''),
(10, 'Sumesh', '$2y$12$fY6FTyb7kKokliLXtwNIiu9tDYLWMlz4tqrJf6J0dVOMq0XKsD0cG', 'Sumesh', 'Majhi', 'sumesh@cms.com', 'MJ-Anime.png', 'admin', '$2y$10$iusesomecrazystrings22', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(66, 'h4u76k60d63rjdbtb1jkcdlpua', 1643083813),
(67, 'lcvljagosr583pl2fghi7gnvh5', 1643082996),
(68, 'ojmp7k417kcj3vlfs7tj09hke4', 1643101256),
(69, 'schu69am2rbab6imfn0vld0e4a', 1643086061),
(70, 'mv2abvaecf2qvgvm8mn4n7ef5u', 1643280488),
(71, 'n09i21ia4kro0pq0l287i7d2fq', 1643393556),
(72, 'vbs15vh95p2akjtjir5clptoa3', 1643467508);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
