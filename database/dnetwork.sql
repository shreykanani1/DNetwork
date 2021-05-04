-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2021 at 12:43 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dnetwork`
--

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE `block` (
  `block_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `u_id`, `description`, `created_on`) VALUES
(249, 111, 76, 'wqqw', '2021-04-16 17:15:28');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `follow_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `is_accepted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `post_id`, `u_id`, `created_on`) VALUES
(378, 111, 76, '2021-04-16 17:15:16'),
(379, 112, 76, '2021-04-16 17:17:38'),
(381, 113, 77, '2021-04-21 16:43:29');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `is_seen` int(11) NOT NULL DEFAULT 0,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_desc` text DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `user_id`, `post_desc`, `created_on`, `updated_on`) VALUES
(105, 58, 'Hello connections, this is my first post on DNetwork', '2021-04-04 13:38:17', '2021-04-04 13:38:17'),
(106, 60, 'Hi connections, this is my first post on DNetwork...', '2021-04-04 13:41:42', '2021-04-04 13:41:42'),
(107, 59, 'Hi connections, this is my first post on DNetwork...', '2021-04-04 13:42:29', '2021-04-04 13:42:29'),
(108, 58, 'mamo', '2021-04-08 18:47:14', '2021-04-08 18:47:14'),
(109, 58, '123', '2021-04-09 10:25:34', '2021-04-09 10:25:34'),
(110, 58, '213123123', '2021-04-12 10:15:07', '2021-04-12 10:15:07'),
(111, 58, '123123', '2021-04-15 21:03:38', '2021-04-15 21:03:38'),
(112, 76, 'btgbtgbtgb', '2021-04-16 17:17:16', '2021-04-16 17:17:16'),
(113, 77, 'hey this is my first post', '2021-04-21 16:43:26', '2021-04-21 16:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `post_file`
--

CREATE TABLE `post_file` (
  `file_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `file_path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_file`
--

INSERT INTO `post_file` (`file_id`, `post_id`, `file_path`) VALUES
(108, 105, 'uploadPostFile/acer-predator-wallpapers_2021-04-04_10_08_17.jpg'),
(109, 106, 'uploadPostFile/dreams_dont_work_unless_you_do_2-wallpaper-5120x2880_2021-04-04_10_11_42.jpg'),
(110, 107, 'uploadPostFile/Rock Island_2021-04-04_10_12_29.jpg'),
(111, 108, 'uploadPostFile/IMG-20200123-WA0003_2021-04-08_15_17_14.jpg'),
(112, 109, 'uploadPostFile/acer-predator-blue-wallpapers_2021-04-09_06_55_34.jpg'),
(113, 110, 'uploadPostFile/IMG-20200123-WA0006_2021-04-12_06_45_07.jpg'),
(114, 111, 'uploadPostFile/2012-06-07 17.06.50_2021-04-15_17_33_38.jpg'),
(115, 112, 'uploadPostFile/3rd bd1_3_2021-04-16_13_47_16.jpg'),
(116, 113, 'uploadPostFile/IP ADDRESS_2021-04-21_13_13_26.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `age` int(3) DEFAULT NULL,
  `profile_picture` text DEFAULT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `current_location` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp(),
  `verification_status` int(11) NOT NULL,
  `verification_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `fname`, `lname`, `email`, `password`, `age`, `profile_picture`, `mobile_no`, `date_of_birth`, `gender`, `education`, `skills`, `current_location`, `branch`, `created_on`, `updated_on`, `verification_status`, `verification_id`) VALUES
(58, 'shrey', 'Shrey', 'Kanani', 'shreykanani1001@gmail.com', '$2y$10$vl8yN4RFMY82YYayP3uE8OCSlc7huz4faBdUSTiJnQsOgeGr1IBpO', 20, 'uploadPostFile/macos1_sierra_2-wallpaper-5120x2880_2021-04-04_10_07_34.jpg', '1231321', '2021-03-11', 'Male', 'B.E. Computer', 'HTML, CSS, JS, Bootstrap, PHP, AngularJS', 'Rajkot', 'Computer', '2021-03-14 13:37:05', '2021-03-14 13:37:05', 1, 322340890),
(59, 'henish', 'Henish', 'Patadiya', 'shreykanani1002@gmail.com', '$2y$10$2uvG9gsfWLBswtYc2JcNrO/IqWowOMFrDGp6/4W.2mlgfpIpSG1Nq', 0, 'uploadPostFile/Annotation 2020-04-12 224613_2021-03-22_05_48_27.png', '6785656757', '0000-00-00', 'Male', 'B.E. Computer', 'HTML, CSS, JS, Bootstrap, PHP, AngularJS', 'Rajkot', 'Computer', '2021-03-14 13:37:53', '2021-03-14 13:37:53', 1, 645150877),
(60, 'raj', 'Raj', 'Kapuriya', 'shreykanani1003@gmail.com', '$2y$10$bEcCOTEvbuGb.1uMFdqFfeUizhqDiPl2Qi9u4vw5iq5cViirHP38y', 20, 'uploadPostFile/Screenshot_2020-06-26-12-31-30-521_2021-04-04_10_10_44.jpg', '', '2021-04-17', 'Male', 'B.E. Computer', 'HTML, CSS, JS, Bootstrap, PHP, AngularJS', 'Rajkot', 'Computer', '2021-03-14 13:38:26', '2021-03-14 13:38:26', 1, 220240553),
(76, 'shyam', 'Shyam', 'Bhalodiya', '180544107001@darshan.ac.in', '$2y$10$EvocmVwa/6xDV.GVtPJEM.Ui1U8OsQclYFKYrp.uXYE8qCw3TTyA.', 18, 'uploadPostFile/3rd bd1_3_2021-04-16_13_52_04.jpg', '123213123', '2021-04-03', 'Male', '', '', 'Rajkot', 'Computer', '2021-04-16 17:12:27', '2021-04-16 17:12:27', 1, 644576606),
(77, 'shreykanani', 'Shrey', 'Kanani', '180540107081@darshan.ac.in', '$2y$10$.NKiYPSubpyQAj88FrHrC.YACIK1khPDE5OLosktkBn63NheppUae', 18, NULL, '1234567890', '2021-04-01', 'Male', '12th', 'HTML,CSS,JS,PHP,Node.js', 'Rajkot', 'Computer', '2021-04-21 16:41:30', '2021-04-21 16:41:30', 1, 768576972);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`block_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`follow_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post_file`
--
ALTER TABLE `post_file`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `block`
--
ALTER TABLE `block`
  MODIFY `block_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=383;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `post_file`
--
ALTER TABLE `post_file`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `block`
--
ALTER TABLE `block`
  ADD CONSTRAINT `block_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `block_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`);

--
-- Constraints for table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `post_file`
--
ALTER TABLE `post_file`
  ADD CONSTRAINT `post_file_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
