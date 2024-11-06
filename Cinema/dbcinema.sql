-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2023 at 07:47 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbcinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblmovies`
--

CREATE TABLE `tblmovies` (
  `MovieID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Poster` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Cost` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblmovies`
--

INSERT INTO `tblmovies` (`MovieID`, `Title`, `Poster`, `Description`, `Date`, `Cost`) VALUES
(1, 'The Fabelmans', 'The_Fabelmans.png', 'A coming-of-age story about a young filmmaker’s journey from Arizona to Hollywood.', '2023-11-29', 500),
(2, 'Tár', 'Tár.png', 'A psychological drama about a renowned orchestra conductor who faces scandal.', '2023-12-01', 750),
(3, 'She Said', 'She_Said.png', 'A drama based on the true story of the two New York Times journalists who broke the Harvey Weinstein story.', '2023-11-30', 500),
(4, 'The Banshees of Inisherin', 'The_Banshees_of_Inisherin.png', 'A dark comedy about a group of friends on a remote Irish island whose relationships are tested when a stranger arrives.', '2023-11-28', 750),
(5, 'The Menu', 'The_Menu.png', 'A dark comedy thriller about a young couple who travels to a remote island for a special dinner at an exclusive restaurant.', '2023-11-26', 500),
(6, 'Avatar: The Way of Water', 'Avatar_The_Way_of_Water.png', 'The sequel to the 2009 blockbuster film “Avatar,” set more than a decade after the events of the first film.', '2023-12-02', 750),
(7, 'Glass Onion: A Knives Out Mystery', 'Glass_Onion_A_Knives_Out_Mystery.png', 'The sequel to the 2019 murder mystery film “Knives Out,” with Daniel Craig returning as detective Benoit Blanc.', '2023-12-02', 500),
(8, 'The Woman King', 'The_Woman_King.png', 'A historical epic based on the true story of the Agojie, a group of female warriors in the West African kingdom of Dahomey.', '2023-12-01', 750),
(9, 'Creed III', 'Creed_III.png', 'The sequel to the 2018 film “Creed II,” with Michael B. Jordan returning as Adonis Creed and making his directorial debut.', '2023-11-27', 500),
(10, 'Babylon', 'Babylon.png', 'An epic period drama set in the 1920s Hollywood silent film era, with Brad Pitt and Margot Robbie starring.', '2023-11-29', 750),
(11, 'Men', 'Men.png', 'A psychological horror film about a young woman who goes on a solo vacation to the English countryside and is stalked by a mysterious figure.', '2023-11-27', 500),
(12, 'Petite Maman', 'Petite_Maman.png', 'A French drama about an eight-year-old girl who comes to terms with her grandmother’s death.', '2023-11-29', 500),
(13, 'The Outfit', 'The_Outfit.png', 'A crime thriller set in Chicago in 1951, about a tailor who becomes entangled in a mob deal gone wrong.', '2023-11-29', 500),
(14, 'The Worst Person in the World', 'The_Worst_Person_in_the_World.png', 'A Norwegian romantic comedy-drama about a young woman who struggles to find her place in the world.', '2023-11-29', 750),
(15, 'Decision to Leave', 'Decision_to_Leave.png', 'A South Korean mystery thriller about a detective who falls in love with the widow of a man he is investigating.', '2023-11-30', 750),
(16, 'Women Talking', 'Women_Talking.png', 'A drama about a group of women in a Mennonite colony in Bolivia who decide to leave their community after being subjected to repeated sexual assaults.', '2023-11-26', 500),
(17, 'The Son', 'The_Son.png', 'The sequel to the 2009 film “The Father,” with Hugh Jackman taking over the role of the son of a man with dementia.', '2023-11-26', 750),
(18, 'Empire of Light', 'Empire_of_Light.png', 'A drama set in a 1980s British seaside town, about a young woman who falls in love with a man who works at the local cinema.', '2023-11-26', 500),
(19, 'Poor Things', 'Poor_Things.png', 'A romantic comedy-drama based on the novel of the same name by Evelyn Waugh, about a man who falls in love with a woman with a troubled past.', '2023-11-28', 750),
(20, 'The Whale', 'The_Whale.png', 'A psychological drama about a reclusive man who tries to reconnect with his estranged daughter.', '2023-11-28', 500);

-- --------------------------------------------------------

--
-- Table structure for table `tbltransactions`
--

CREATE TABLE `tbltransactions` (
  `UserID` int(11) NOT NULL,
  `MovieID` int(11) NOT NULL,
  `Quantity` int(10) NOT NULL,
  `TotalCost` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbltransactions`
--

INSERT INTO `tbltransactions` (`UserID`, `MovieID`, `Quantity`, `TotalCost`) VALUES
(1, 3, 3, 500),
(2, 5, 1, 2500),
(3, 2, 5, 500),
(4, 7, 4, 1500),
(5, 10, 4, 1500),
(1, 1, 2, 500),
(2, 6, 3, 1000),
(3, 9, 4, 500),
(4, 4, 3, 2500),
(5, 8, 4, 1500),
(1, 11, 4, 2000),
(2, 13, 1, 500),
(3, 16, 3, 500),
(4, 18, 2, 2500),
(5, 20, 4, 2500),
(1, 15, 1, 500),
(2, 17, 1, 1500),
(3, 12, 1, 2000),
(4, 14, 1, 2000),
(5, 19, 2, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `UserID` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `VerificationCode` varchar(20) NOT NULL,
  `Active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`UserID`, `Email`, `Password`, `Position`, `Name`, `VerificationCode`, `Active`) VALUES
(1, 'JohnDoe584@example.com', 'password1', 'user', 'John Doe', '81fdefd3b6d9', 1),
(2, 'JaneDoe107@example.com', 'password2', 'user', 'Jane Doe', '5e64cc257a80', 1),
(3, 'BobSmith825@example.com', 'password3', 'user', 'Bob Smith', 'ea47739c39bd', 1),
(4, 'AliceJohnson167@example.com', 'password4', 'user', 'Alice Johnson', '430ed6866368', 1),
(5, 'MarkDavis110@example.com', 'password5', 'user', 'Mark Davis', '942a8a599c93', 1),
(6, 'EmilyTaylor321@example.com', 'password6', 'user', 'Emily Taylor', 'b4e141ff11a1', 1),
(7, 'MichaelBrown762@example.com', 'password7', 'user', 'Michael Brown', 'b5a269d412a8', 1),
(8, 'OliviaSmith336@example.com', 'password8', 'user', 'Olivia Smith', '0a906348b883', 1),
(9, 'DavidJones304@example.com', 'password9', 'user', 'David Jones', '59fcc2160768', 1),
(10, 'EmmaClark308@example.com', 'password10', 'user', 'Emma Clark', 'c527e9b78185', 1),
(11, 'DanielWhite449@example.com', 'password11', 'user', 'Daniel White', '68d3f67d4b83', 1),
(12, 'SophiaMartin621@example.com', 'password12', 'user', 'Sophia Martin', 'a4ee38aad4d5', 1),
(13, 'ChristopherHill595@example.com', 'password13', 'user', 'Christopher Hill', 'd102a16b88b0', 1),
(14, 'IsabellaYoung821@example.com', 'password14', 'user', 'Isabella Young', 'eb4090edd6e4', 1),
(15, 'MatthewWard661@example.com', 'password15', 'user', 'Matthew Ward', 'faf21daf9c49', 1),
(16, 'AvaScott710@example.com', 'password16', 'user', 'Ava Scott', 'a97a131a89dc', 1),
(17, 'AndrewCooper999@example.com', 'password17', 'user', 'Andrew Cooper', '3737c4121f1b', 1),
(18, 'EllaMorris798@example.com', 'password18', 'user', 'Ella Morris', '548e0b529b62', 1),
(19, 'JamesLee894@example.com', 'password19', 'user', 'James Lee', 'ebc0f9889ebd', 1),
(20, 'MiaBaker977@example.com', 'password20', 'user', 'Mia Baker', '8b7bcfa65715', 1),
(21, 'woodencrategt@gmail.com', 'pokemon28', 'admin', 'Lyndon Justin M. Bacolor', 'KBz53E8oP4dx', 1),
(22, 'arkinwacky@gmail.com', 'pokemon28', 'user', 'Lyndon Justin M. Bacolor', 'Y6Ek4fHlwI8b', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblmovies`
--
ALTER TABLE `tblmovies`
  ADD PRIMARY KEY (`MovieID`);

--
-- Indexes for table `tbltransactions`
--
ALTER TABLE `tbltransactions`
  ADD KEY `UserID` (`UserID`),
  ADD KEY `MovieID` (`MovieID`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblmovies`
--
ALTER TABLE `tblmovies`
  MODIFY `MovieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbltransactions`
--
ALTER TABLE `tbltransactions`
  ADD CONSTRAINT `tbltransactions_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `tblusers` (`UserID`),
  ADD CONSTRAINT `tbltransactions_ibfk_2` FOREIGN KEY (`MovieID`) REFERENCES `tblmovies` (`MovieID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
