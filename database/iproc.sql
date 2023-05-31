-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 29, 2022 at 08:35 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iproc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ADMIN_CODE` int(11) NOT NULL,
  `ADMIN_NRIC` varchar(12) NOT NULL,
  `ADMIN_PASS` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMIN_CODE`, `ADMIN_NRIC`, `ADMIN_PASS`) VALUES
(1, '990917146163', 'ASD@asd123123');

-- --------------------------------------------------------

--
-- Table structure for table `latmajrasmi`
--

CREATE TABLE `latmajrasmi` (
  `LATMAJRASMI_CODE` int(11) NOT NULL,
  `LATMAJRASMI_DESC` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `latmajrasmi`
--

INSERT INTO `latmajrasmi` (`LATMAJRASMI_CODE`, `LATMAJRASMI_DESC`) VALUES
(1, 'Pakej'),
(2, 'Tanpa Pakej'),
(3, 'PK7.3'),
(4, 'Dalam Negara'),
(5, 'Luar Negara');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `MODULE_CODE` int(11) NOT NULL,
  `MODULE_NAME` varchar(50) NOT NULL,
  `MODULE_PREFIX` varchar(3) NOT NULL,
  `MODULE_STATUS` int(1) NOT NULL,
  `MODULE_DATE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`MODULE_CODE`, `MODULE_NAME`, `MODULE_PREFIX`, `MODULE_STATUS`, `MODULE_DATE`) VALUES
(22, 'PENTADBIRAN SISTEM', 'PS', 1, '02:09  28-09-22'),
(23, 'PERANCANGAN PEROLEHAN TAHUNAN', 'PPT', 1, '11:04  27-09-22'),
(24, 'PERANCANGAN TETAP LAHIR', 'PTL', 1, '09:26  28-09-22'),
(25, 'SURAT SETUJU TERIMA', 'SST', 1, '02:37  28-09-22');

-- --------------------------------------------------------

--
-- Table structure for table `ppt`
--

CREATE TABLE `ppt` (
  `PPT_CODE` int(11) NOT NULL,
  `PPT_PROCYEAR` year(4) NOT NULL,
  `PPT_PROCDESC` varchar(150) NOT NULL,
  `PPT_PROCMETHOD` int(11) NOT NULL,
  `PPT_LATMAJRASMI` int(11) DEFAULT NULL,
  `PPT_PROCCAT` int(11) NOT NULL,
  `PPT_CURCONSTART` date DEFAULT NULL,
  `PPT_CURCONEND` date DEFAULT NULL,
  `PPT_CURCONNO` varchar(150) DEFAULT NULL,
  `PPT_CURCONDESC` varchar(150) DEFAULT NULL,
  `PPT_CURCONAMT` decimal(10,2) DEFAULT NULL,
  `PPT_CONSTART` date NOT NULL,
  `PPT_CONEND` date NOT NULL,
  `PPT_SUBMITAPP` date NOT NULL,
  `PPT_ADSTART` date NOT NULL,
  `PPT_ASSTYPE` int(11) NOT NULL,
  `PPT_ ASS_OPEN` date NOT NULL,
  `PPT_ASSTECH` date NOT NULL,
  `PPT_ASSFIN` date NOT NULL,
  `PPT_LPKK_JKSH` date NOT NULL,
  `PPT_CONCOST` decimal(10,2) NOT NULL,
  `PPT_ALLOCSRC` int(11) NOT NULL,
  `PPT_ALLOCCURYEAR` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `proccat`
--

CREATE TABLE `proccat` (
  `PROCCAT_CODE` int(11) NOT NULL,
  `PROCCAT_DESC` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proccat`
--

INSERT INTO `proccat` (`PROCCAT_CODE`, `PROCCAT_DESC`) VALUES
(1, 'Bekalan'),
(2, 'Perkhidmatan'),
(3, 'Kerja'),
(4, 'Perunding');

-- --------------------------------------------------------

--
-- Table structure for table `processes`
--

CREATE TABLE `processes` (
  `PROCESS_CODE` int(11) NOT NULL,
  `PROCESS_STATUS` int(1) NOT NULL,
  `MODULE_CODE` int(11) NOT NULL,
  `PROCESS_DATE` varchar(50) NOT NULL,
  `PROCESS_NAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `processes`
--

INSERT INTO `processes` (`PROCESS_CODE`, `PROCESS_STATUS`, `MODULE_CODE`, `PROCESS_DATE`, `PROCESS_NAME`) VALUES
(10, 1, 22, '02:15  28-09-22', 'SISTEM ADMIN'),
(11, 1, 23, '11:05  27-09-22', 'PENYEDIAAN SEBUT HARGA BARU'),
(12, 1, 24, '09:27  28-09-22', 'PENDAFTARAN BARU'),
(13, 1, 25, '02:38  28-09-22', 'PENDAFTARAN BARU');

-- --------------------------------------------------------

--
-- Table structure for table `procmethod`
--

CREATE TABLE `procmethod` (
  `PROCMETHOD_CODE` int(11) NOT NULL,
  `PROCMETHOD_DESC` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `procmethod`
--

INSERT INTO `procmethod` (`PROCMETHOD_CODE`, `PROCMETHOD_DESC`) VALUES
(1, 'Tender'),
(2, 'Sebut Harga '),
(3, 'Sebut Harga B'),
(4, 'Rundingan Terus'),
(5, 'Latihan'),
(6, 'Majlis Rasmi'),
(7, 'Pembelian Terus (Kontrak)'),
(8, 'Perubahan Kontrak'),
(9, 'Sewa Pejabat');

-- --------------------------------------------------------

--
-- Table structure for table `ptj`
--

CREATE TABLE `ptj` (
  `PTJ_CODE` int(11) NOT NULL,
  `PTJ_NAME` varchar(50) NOT NULL,
  `PTJ_ADDRESS` text NOT NULL,
  `PTJ_PHONE` varchar(12) NOT NULL,
  `PTJ_STATUS` int(1) NOT NULL,
  `PTJ_DATE` varchar(50) NOT NULL,
  `PTJ_PREFIX` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ptj`
--

INSERT INTO `ptj` (`PTJ_CODE`, `PTJ_NAME`, `PTJ_ADDRESS`, `PTJ_PHONE`, `PTJ_STATUS`, `PTJ_DATE`, `PTJ_PREFIX`) VALUES
(3, 'BPPP', 'PUTRAJAYA', '06791830', 1, '09:40  28-09-22', 'BPPP'),
(4, 'JABATAN AKAUNTAN NEGARA MALAYSIA SELANGOR', 'SELANGOR', '034532456', 1, '09:53  19-09-22', 'JANM SEL'),
(5, 'JABATAN AKAUNTAN NEGARA MALAYSIA NEGERI SEMBILAN', 'NEGERI SEMBILAN', '09871623', 1, '09:34  28-09-22', 'JANM NS'),
(6, 'JABATAN AKAUNTAN NEGARA MALAYSIA KELANTAN', 'KELANTAN', '097162323', 1, '02:50  28-09-22', 'JANM K');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `ROLE_CODE` int(11) NOT NULL,
  `ROLE_NAME` varchar(20) NOT NULL,
  `ROLE_STATUS` int(1) NOT NULL,
  `ROLE_DATE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`ROLE_CODE`, `ROLE_NAME`, `ROLE_STATUS`, `ROLE_DATE`) VALUES
(1, 'PENTADBIR SISTEM', 1, '02:40  28-09-22'),
(2, 'PENYEMAK I', 1, '11:36  15-09-22'),
(3, 'PENYEMAK II', 1, '11:36  15-09-22'),
(4, 'PELULUS II', 1, '11:36  15-09-22'),
(5, 'PELULUS I', 1, '11:36  15-09-22'),
(6, 'PELULUS III', 1, '11:36  15-09-22'),
(7, 'NAZIRAN & AUDIT', 1, '11:36  15-09-22'),
(8, 'PENYEDIA', 1, '11:32  15-09-22');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `USER_CODE` int(11) NOT NULL,
  `USER_NRIC` varchar(12) NOT NULL,
  `USER_NAME` varchar(150) NOT NULL,
  `USER_POSITION` varchar(150) NOT NULL,
  `USER_GRADE` varchar(4) NOT NULL,
  `USER_EMAIL` varchar(35) NOT NULL,
  `USER_PHONE` varchar(12) NOT NULL,
  `PTJ_CODE` int(11) NOT NULL,
  `USER_STATUS` int(1) NOT NULL,
  `USER_DATE` varchar(50) NOT NULL,
  `USER_PASS` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USER_CODE`, `USER_NRIC`, `USER_NAME`, `USER_POSITION`, `USER_GRADE`, `USER_EMAIL`, `USER_PHONE`, `PTJ_CODE`, `USER_STATUS`, `USER_DATE`, `USER_PASS`) VALUES
(19, '112233445566', 'ABU BAKAR BIN ALI', 'PEMBANTU AKAUNTAN', 'W19', 'daussubki1709@gmail.com', '0118998765', 5, 1, '03:30  28-09-22', 'ASD@asd123123'),
(20, '112233445598', 'AMIRAH BINTI JODOH', 'PEN EKSEKUTIF PERKHIDMATAN', 'FA29', 'fix@anm.gov.my', '0179795851', 6, 1, '03:03  28-09-22', 'ASD@asd123123');

-- --------------------------------------------------------

--
-- Table structure for table `usermatrix`
--

CREATE TABLE `usermatrix` (
  `USERMATRIX_CODE` int(11) NOT NULL,
  `ROLE_CODE` int(11) NOT NULL,
  `MODULE_CODE` int(11) NOT NULL,
  `PROCESS_CODE` int(11) NOT NULL,
  `USERMATRIX_STATUS` int(1) NOT NULL,
  `USERMATRIX_DATE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usermatrix`
--

INSERT INTO `usermatrix` (`USERMATRIX_CODE`, `ROLE_CODE`, `MODULE_CODE`, `PROCESS_CODE`, `USERMATRIX_STATUS`, `USERMATRIX_DATE`) VALUES
(51, 1, 22, 10, 1, '02:58  28-09-22'),
(52, 2, 23, 11, 1, '11:06  27-09-22'),
(53, 3, 23, 11, 1, '11:10  27-09-22'),
(54, 4, 23, 11, 1, '11:10  27-09-22'),
(55, 5, 23, 11, 1, '11:10  27-09-22'),
(56, 6, 23, 11, 1, '11:11  27-09-22'),
(57, 7, 23, 11, 1, '11:12  27-09-22'),
(58, 8, 23, 11, 1, '11:12  27-09-22'),
(59, 8, 24, 12, 1, '09:44  28-09-22');

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

CREATE TABLE `userroles` (
  `USERROLE_CODE` int(11) NOT NULL,
  `USERMATRIX_CODE` int(11) NOT NULL,
  `USERROLE_STATUS` int(1) NOT NULL,
  `USERROLE_DATE` varchar(50) NOT NULL,
  `USER_CODE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userroles`
--

INSERT INTO `userroles` (`USERROLE_CODE`, `USERMATRIX_CODE`, `USERROLE_STATUS`, `USERROLE_DATE`, `USER_CODE`) VALUES
(31, 51, 1, '03:29  28-09-22', 19),
(32, 52, 1, '03:29  28-09-22', 19),
(33, 54, 1, '03:29  28-09-22', 19),
(34, 55, 1, '03:29  28-09-22', 19),
(35, 57, 1, '03:29  28-09-22', 19),
(36, 58, 0, '03:29  28-09-22', 19),
(37, 53, 1, '03:03  28-09-22', 20),
(38, 55, 1, '03:03  28-09-22', 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_CODE`);

--
-- Indexes for table `latmajrasmi`
--
ALTER TABLE `latmajrasmi`
  ADD PRIMARY KEY (`LATMAJRASMI_CODE`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`MODULE_CODE`);

--
-- Indexes for table `ppt`
--
ALTER TABLE `ppt`
  ADD PRIMARY KEY (`PPT_CODE`),
  ADD KEY `PPT_LATMAJRASMI` (`PPT_LATMAJRASMI`),
  ADD KEY `PPT_PROCCAT` (`PPT_PROCCAT`),
  ADD KEY `PPT_PROCMETHOD` (`PPT_PROCMETHOD`);

--
-- Indexes for table `proccat`
--
ALTER TABLE `proccat`
  ADD PRIMARY KEY (`PROCCAT_CODE`);

--
-- Indexes for table `processes`
--
ALTER TABLE `processes`
  ADD PRIMARY KEY (`PROCESS_CODE`),
  ADD KEY `MODULE_CODE` (`MODULE_CODE`);

--
-- Indexes for table `procmethod`
--
ALTER TABLE `procmethod`
  ADD PRIMARY KEY (`PROCMETHOD_CODE`);

--
-- Indexes for table `ptj`
--
ALTER TABLE `ptj`
  ADD PRIMARY KEY (`PTJ_CODE`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ROLE_CODE`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USER_CODE`),
  ADD KEY `PTJ_CODE` (`PTJ_CODE`);

--
-- Indexes for table `usermatrix`
--
ALTER TABLE `usermatrix`
  ADD PRIMARY KEY (`USERMATRIX_CODE`),
  ADD KEY `MODULE_CODE` (`MODULE_CODE`),
  ADD KEY `ROLE_CODE` (`ROLE_CODE`),
  ADD KEY `PROCESS_CODE` (`PROCESS_CODE`);

--
-- Indexes for table `userroles`
--
ALTER TABLE `userroles`
  ADD PRIMARY KEY (`USERROLE_CODE`),
  ADD KEY `USERMATRIX_CODE` (`USERMATRIX_CODE`),
  ADD KEY `USER_CODE` (`USER_CODE`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ADMIN_CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `latmajrasmi`
--
ALTER TABLE `latmajrasmi`
  MODIFY `LATMAJRASMI_CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `MODULE_CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `ppt`
--
ALTER TABLE `ppt`
  MODIFY `PPT_CODE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proccat`
--
ALTER TABLE `proccat`
  MODIFY `PROCCAT_CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `processes`
--
ALTER TABLE `processes`
  MODIFY `PROCESS_CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `procmethod`
--
ALTER TABLE `procmethod`
  MODIFY `PROCMETHOD_CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ptj`
--
ALTER TABLE `ptj`
  MODIFY `PTJ_CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `ROLE_CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `USER_CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `usermatrix`
--
ALTER TABLE `usermatrix`
  MODIFY `USERMATRIX_CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `userroles`
--
ALTER TABLE `userroles`
  MODIFY `USERROLE_CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `processes`
--
ALTER TABLE `processes`
  ADD CONSTRAINT `processes_ibfk_1` FOREIGN KEY (`MODULE_CODE`) REFERENCES `modules` (`MODULE_CODE`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`PTJ_CODE`) REFERENCES `ptj` (`PTJ_CODE`);

--
-- Constraints for table `usermatrix`
--
ALTER TABLE `usermatrix`
  ADD CONSTRAINT `usermatrix_ibfk_1` FOREIGN KEY (`MODULE_CODE`) REFERENCES `modules` (`MODULE_CODE`),
  ADD CONSTRAINT `usermatrix_ibfk_2` FOREIGN KEY (`PROCESS_CODE`) REFERENCES `processes` (`PROCESS_CODE`),
  ADD CONSTRAINT `usermatrix_ibfk_3` FOREIGN KEY (`ROLE_CODE`) REFERENCES `roles` (`ROLE_CODE`);

--
-- Constraints for table `userroles`
--
ALTER TABLE `userroles`
  ADD CONSTRAINT `userroles_ibfk_1` FOREIGN KEY (`USERMATRIX_CODE`) REFERENCES `usermatrix` (`USERMATRIX_CODE`),
  ADD CONSTRAINT `userroles_ibfk_2` FOREIGN KEY (`USER_CODE`) REFERENCES `user` (`USER_CODE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
