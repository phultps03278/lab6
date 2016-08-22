-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2016 at 06:05 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanlymatkinh_ps03278`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `ID_HD` int(11) NOT NULL,
  `ID_SP` int(11) NOT NULL,
  `Soluong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`ID_HD`, `ID_SP`, `Soluong`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 2),
(4, 4, 1),
(5, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `ID_HD` int(11) NOT NULL,
  `ID_KH` varchar(5) NOT NULL,
  `TongTienHD` int(11) NOT NULL,
  `NgayHD` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`ID_HD`, `ID_KH`, `TongTienHD`, `NgayHD`) VALUES
(1, '1', 2400000, '2016-07-01'),
(2, '3', 900000, '2016-07-02'),
(3, '2', 3000000, '2016-07-01'),
(4, '1', 2800000, '2016-07-22'),
(5, '1', 3600000, '2016-07-29');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `ID_KH` varchar(5) NOT NULL,
  `HoTen` varchar(30) NOT NULL,
  `SDT` int(11) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `DiaChi` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`ID_KH`, `HoTen`, `SDT`, `Email`, `DiaChi`) VALUES
('1', 'Lo Thanh Phu', 905466624, 'phultps03278@fpt.edu.vn', 'TP HCM'),
('2', 'Nguyen Van B', 12356987, 'nguyenvanb@gmail.com', 'TP HCM'),
('3', 'Nguyen Van C', 127896543, 'nguyenvanc@gmail.cm', 'Ha Noi'),
('4', 'Nguyen Thi A', 123456789, 'nguyenthia@ex.com', 'Ha Noi'),
('5', 'Nguyen Van H', 123456789, 'nguyenvanh@ex.com', 'Tp HCM');

-- --------------------------------------------------------

--
-- Table structure for table `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `ID_LSP` int(11) NOT NULL,
  `TenLoai` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loaisanpham`
--

INSERT INTO `loaisanpham` (`ID_LSP`, `TenLoai`) VALUES
(1, 'Rayban'),
(2, 'Gentle Monster'),
(3, 'Louis Vuitton'),
(4, 'Gucci'),
(5, 'Calvin Klein');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `ID_SP` int(11) NOT NULL,
  `TenSP` varchar(100) NOT NULL,
  `HinhSP` varchar(30) NOT NULL,
  `Gia` int(11) NOT NULL,
  `TinhTrang` varchar(100) NOT NULL,
  `ID_LSP` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`ID_SP`, `TenSP`, `HinhSP`, `Gia`, `TinhTrang`, `ID_LSP`) VALUES
(1, 'Rayban - AVIATOR CLASSIC', '1.jpg', 2400000, 'Con Hang', 1),
(2, 'Gentle Monster - ROY 01', '2.jpg', 3000000, 'Con Hang', 3),
(3, 'Rayban - ERIKA VELVET', '3.jpg', 2800000, 'Con Hang', 2),
(4, '\r\nGENTLE MONSTER - VANILLA ROAD G8(2M)\r\n\r\n', '4.jpg', 900000, 'Het hang', 2),
(5, 'Rayban - ORIGINAL WAYFARER ', '5.jpg', 3600000, 'Con Hang', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`ID_HD`,`ID_SP`),
  ADD KEY `ChiTietHoadon_SanPham` (`ID_SP`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`ID_HD`),
  ADD KEY `HoaDon_KhachHang` (`ID_KH`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`ID_KH`);

--
-- Indexes for table `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`ID_LSP`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`ID_SP`),
  ADD KEY `SanPham_LoaiSanPham` (`ID_LSP`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD CONSTRAINT `ChiTietHoadon_HoaDon` FOREIGN KEY (`ID_HD`) REFERENCES `hoadon` (`ID_HD`),
  ADD CONSTRAINT `ChiTietHoadon_SanPham` FOREIGN KEY (`ID_SP`) REFERENCES `sanpham` (`ID_SP`);

--
-- Constraints for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `HoaDon_KhachHang` FOREIGN KEY (`ID_KH`) REFERENCES `khachhang` (`ID_KH`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `SanPham_LoaiSanPham` FOREIGN KEY (`ID_LSP`) REFERENCES `loaisanpham` (`ID_LSP`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
