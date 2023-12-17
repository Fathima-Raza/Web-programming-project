-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 07:43 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atiweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `CourseID` int(11) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `TitleInShort` varchar(50) DEFAULT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`CourseID`, `Title`, `TitleInShort`, `Description`) VALUES
(1001, 'Higher National Diploma in Information Technology', 'HNDIT', 'The Higher National Diploma in Information Technology (HND-IT) programme at the Sri Lanka Institute of Advance Technical Education (SLIATE) was developed and commenced in the year 2000 with the objective of producing the middle level IT professional required for the new millennium.'),
(1002, 'Higher National Diploma Accountancy', 'HNDA', 'Higher National Diploma in Accountancy is highly recognized qualification today by both public and the Private sectors, conducted by Sri Lanka Institute of Advanced Technological Education (SLIATE) under the Ministry of Higher Education in Sri Lanka.\r\n\r\nHaving completed a Four years of duration consisting of Eight Academic Semesters, the HNDA students become the qualified candidates for Accountant or Assistant Accountant even for middle level management position in the industry. English medium and industrial training along with computer knowledge give a significant push to our students enabling them employed on suitable position in the job market. Further, all the subjects of the course have been designed on the basis of the modern changes as it is students can work as multi-functional personnel in the industry.\r\n\r\nToday an accountant role is not just limited to his job description. He is a person who should make such important decisions, implement and control them. Further, he or she has to get a lot done from the subordinates who work under him or her in order to generate the expected performance by the management or the Owners.\r\n\r\nFurther, the students can develop other activities such as organizing annual ceremonies and blood donation program hoping to change their mind set to work with society.'),
(1003, 'Higher National Diploma in Tourism and Hospitality Management', 'HNDTHM', 'The hospitality and tourism degree provides an in-depth understanding of the hospitality and tourism industry and prepares you to enter any segment of the industry, including sports and entertainment management, hospitality real estate, beverage management, hotel/resort management, travel management, food marketing and distribution, cruise line operations, resorts and spas, event management, and airline catering. You will also find success in many other industries where delivering top innovative services and experiences is a priority.'),
(1004, 'Higher National Diploma in English ', 'HNDE', 'The Higher National Diploma in English course provides an opportunity for School leavers with GCE A’ Level qualifications to improve their expertise in English Language, English Literature and Communication skills. The learners will be focused specialize during the second year in order to strengthen their chances of finding suitable employment. The course also intends to develop their personality, interpersonal skills and general convertible skills such as adaptability, decision making ability and organizational ability which are regarded as important requirements to meet employment prospects. The new program of study is designed according to the course unit system enabling the assessment of students in credits. After completion of NDE level, the students are offered the three specialization areas namely English Language Teaching, Journalism and English for Business Communication. There will be no in-plant training in the area of specialization but a practical component is included for each in the second semester of the final year. Apart from the core program there are two support courses offered for the students throughout the first year named Study Skills and Computer Assisted Language Learning (CALL) to enhance the independent learning ability of the students');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `LecID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Designation` varchar(50) DEFAULT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `profile_picture` char(1) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Phone Number` int(11) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Academic Qualification` varchar(255) DEFAULT NULL,
  `Upload Relevant Document` varchar(255) DEFAULT NULL,
  `Teaching Experience (Years)` varchar(255) DEFAULT NULL,
  `Area of Specialization` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`LecID`, `Name`, `Email`, `Designation`, `CourseID`, `Gender`, `Password`, `profile_picture`, `DOB`, `Phone Number`, `Address`, `Academic Qualification`, `Upload Relevant Document`, `Teaching Experience (Years)`, `Area of Specialization`) VALUES
(1, 'Raza Rafee', 'abcd@gmail.com', 'Lecturer', 1001, 'Male', '$2y$10$zDuDpc7FGyUprVTpIyIiBOEfmBF5pPXZGQ.lb0.DaYK15XfqFMOt2', NULL, '2013-12-11', 771122334, 'Batticaloa', 'Degree ', NULL, '5', 'IT'),
(4, 'add', 'add@gmail.com', 'Lecturer', 1001, 'Female', '$2y$10$GjrPyAc5virWKOlPGQ8xvOQKkEVsC8p.1Sit992B5mgKzt5ZgSGge', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Raza Rafee', 'abc@gmail.com', 'Senior Lecturer ', 1001, 'Female', '$2y$10$UquLK.r4xu/6VaNWoq7lpu.kuWvj94Az4Y1tl6QlC8JQrJn/LQyD6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Renu', 'tamil@gmail.com', 'assistant', NULL, NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`CourseID`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`LecID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `CourseID` (`CourseID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lecturer`
--
ALTER TABLE `lecturer`
  MODIFY `LecID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD CONSTRAINT `lecturer_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `course` (`CourseID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
