--  SQL Database for our dating website project
--  Group 14 CS4416

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Table structure for table `AvailableInterests`
--

CREATE TABLE `AvailableInterests` (
  `InterestID` int(3) NOT NULL,
  `InterestName` varchar(26) NOT NULL COMMENT 'The name of the interest'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Show a list of available interests for registration/search';

-- --------------------------------------------------------

--
-- Table structure for table `Connections`
--

CREATE TABLE `Connections` (
  `ConnectionID` int(11) NOT NULL,
  `userID1` int(11) NOT NULL COMMENT 'Which user initiated the connection?',
  `userID2` int(11) NOT NULL COMMENT 'Which user received the connection',
  `ConnectionDate` date NOT NULL COMMENT 'When was the connection made?',
  `isAccepted` binary(1) NOT NULL COMMENT 'Has the connection been accepted?'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Interests`
--

CREATE TABLE `Interests` (
  `UserID` int(11) NOT NULL COMMENT 'Which user is this?',
  `InterestID` int(3) NOT NULL COMMENT 'Which interest do they have?'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Interests of ALL users';

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `UserID` int(11) NOT NULL,
  `Age` int(2) NOT NULL,
  `Smoker` binary(1) NOT NULL COMMENT 'Binary type because this is yes or no',
  `Drinker` enum('Constantly','Most days','Social Drinker','No') NOT NULL COMMENT 'Enumerated type because there are several answers, but the available answers won''t change',
  `Gender` enum('Female','Male','Other') NOT NULL COMMENT 'See Drinker comment',
  `Seeking` enum('Female','Male','Other') NOT NULL COMMENT 'See Drinker comment',
  `Institution` varchar(256) NOT NULL COMMENT 'Educational Institution that the user is studying at',
  `Course` varchar(256) NOT NULL COMMENT 'Course studied by user',
  `Location` varchar(256) NOT NULL COMMENT 'Location of the user',
  `Instagram` varchar(30) NOT NULL COMMENT 'Instagram username of user',
  `Snapchat` varchar(30) NOT NULL COMMENT 'Snapchat username of user',
  `Occupation` varchar(256) NOT NULL COMMENT 'Occupation/Industry of user',
  `Description` blob NOT NULL COMMENT 'Blob type because this will contain a free text description of the person',
  `Banned` binary(1) NOT NULL COMMENT 'Has the user been banned by an admin?',
  `Photo` varchar(26) NOT NULL COMMENT 'We should allow users to upload photos to the site; this field contains the name of the photo they have uploaded'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Handle` varchar(26) NOT NULL,
  `Email` varchar(320) NOT NULL,
  `Firstname` varchar(26) NOT NULL,
  `Surname` varchar(26) NOT NULL,
  `Password` varchar(256) NOT NULL COMMENT 'See video for information on how to encrypt password BEFORE storing it. Never store the user''s actual password.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Store personal information about the user. ';

--
-- Indexes for table `AvailableInterests`
--
ALTER TABLE `AvailableInterests`
  ADD PRIMARY KEY (`InterestID`);

--
-- Indexes for table `Connections`
--
ALTER TABLE `Connections`
  ADD PRIMARY KEY (`ConnectionID`),
  ADD KEY `userID1` (`userID1`),
  ADD KEY `userID2` (`userID2`);

--
-- Indexes for table `Interests`
--
ALTER TABLE `Interests`
  ADD PRIMARY KEY (`UserID`,`InterestID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `InterestID` (`InterestID`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- Constraints for table `Connections`
--
ALTER TABLE `Connections`
  ADD CONSTRAINT `Connections_ibfk_1` FOREIGN KEY (`userID1`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `Connections_ibfk_2` FOREIGN KEY (`userID2`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `Interests`
--
ALTER TABLE `Interests`
  ADD CONSTRAINT `Interests_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `Interests_ibfk_2` FOREIGN KEY (`InterestID`) REFERENCES `AvailableInterests` (`InterestID`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
