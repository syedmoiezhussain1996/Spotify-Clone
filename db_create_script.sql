-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Dec 25, 2022 at 07:59 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myspotify`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int NOT NULL,
  `title` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `title`) VALUES
(1, 'Album 1'),
(2, 'Album 2'),
(3, 'Album 3'),
(4, 'Album 4'),
(5, 'Album 5');

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `uid` int NOT NULL,
  `songID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`uid`, `songID`) VALUES
(9, 14),
(9, 15),
(10, 16);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int NOT NULL,
  `groupName` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `groupName`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `singers`
--

CREATE TABLE `singers` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `info` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `image` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `singers`
--

INSERT INTO `singers` (`id`, `name`, `info`, `image`) VALUES
(1, 'Sơn Tùng MTP', 'Nguyễn Thanh Tùng, thường được biết đến với nghệ danh Sơn Tùng M-TP, là một nam ca sĩ kiêm sáng tác nhạc, rapper và diễn viên người Việt Nam.', 'images/singers/mtp.png'),
(2, 'Đức Phúc', 'Nguyễn Đức Phúc là một nam ca sĩ người Việt Nam được biết đến rộng rãi với tư cách quán quân của The Voice Vietnam 2015.', 'images/singers/ducphuc.png'),
(3, 'Hoài Lâm', 'Hoài Lâm, tên thật là Nguyễn Tuấn Lộc, là một nam ca sĩ, rapper kiêm diễn viên người Việt Nam. Anh từng giành 1 giải Cống hiến và được công chúng Việt Nam đặc biệt chú ý sau khi giành giải quán quân chương trình truyền hình thực tế Gương mặt thân quen.', 'images/singers/hoailam.png'),
(4, 'Hương Tràm', 'Hương Tràm có tên đầy đủ là Phạm Thị Hương Tràm là một nữ ca sĩ người Việt Nam. Cô là quán quân cuộc thi Giọng hát Việt mùa đầu tiên 2012.', 'images/singers/huongtram.png'),
(5, 'Chế Linh', 'Chế Linh là nam ca sĩ người Chăm nổi tiếng, đồng thời là nhạc sĩ với bút hiệu Tú Nhi và Lưu Trần Lê. Ông nổi danh từ thập niên 60 và được xem như là một trong bốn giọng nam nổi tiếng nhất của nhạc vàng thời kỳ đầu.', 'images/singers/chelinh.png'),
(8, 'Min', 'Nguyễn Minh Hằng, được biết đến với nghệ danh MIN, là một nữ ca sĩ, vũ công và nhà sản xuất âm nhạc người Việt Nam.', 'images/singers/cec.jpg'),
(9, 'Unknown', 'Random Beatiful Songs', 'images/singers/lofi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int NOT NULL,
  `title` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `filePath` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `imgPath` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `singerID` int NOT NULL,
  `file type` varchar(50) COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `languageID` int DEFAULT NULL,
  `genereID` int DEFAULT NULL,
  `albumID` int NOT NULL,
  `year` varchar(4) COLLATE utf8mb3_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `title`, `filePath`, `imgPath`, `dateAdded`, `singerID`, `file type`, `languageID`, `genereID`, `albumID`, `year`) VALUES
(14, 'Pixabay', 'music/pixabay.mp3', 'images/piano.jpg', '2021-06-03 10:38:34', 8, 'audio', NULL, NULL, 0, ''),
(15, 'Midnight', 'music/midnight.mp3', 'images/Midnight_Mist.jpg', '2021-06-03 10:38:58', 9, 'audio', NULL, NULL, 0, ''),
(16, 'Electronica', 'music/electronica.mp3', 'images/lofi.jpg', '2021-06-03 10:39:21', 9, 'audio', NULL, NULL, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `groupID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `groupID`) VALUES
(5, 'pum', '21232f297a57a5a743894a0e4a801fc3', 2),
(9, 'baobao', '21232f297a57a5a743894a0e4a801fc3', 1),
(10, 'admin', '21232f297a57a5a743894a0e4a801fc3', 2),
(11, 'bmblb', 'ff9e6cad0fcb37d9aacbb82840e40896', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`uid`,`songID`),
  ADD KEY `favourites_ibfk_2` (`songID`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `singers`
--
ALTER TABLE `singers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `singerID` (`singerID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groupID` (`groupID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `singers`
--
ALTER TABLE `singers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favourites_ibfk_2` FOREIGN KEY (`songID`) REFERENCES `songs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`singerID`) REFERENCES `singers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`groupID`) REFERENCES `groups` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
