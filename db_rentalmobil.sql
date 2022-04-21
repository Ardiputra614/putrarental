-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 19, 2022 at 12:19 PM
-- Server version: 10.3.29-MariaDB-0+deb10u1
-- PHP Version: 7.3.19-1+eagle

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rentalmobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `kd_customer` int(8) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`kd_customer`, `nama`, `alamat`, `no_hp`) VALUES
(1, 'NONI ARIESTA', 'BANYUMAS', '088882222'),
(2, 'SUSI SUSANTI', 'CILACAP', '088883456'),
(3, 'RINA WIRAWAN', 'PURBALINGGA', '088882020'),
(4, 'TOMI SAPUTRA', 'BANJARNEGARA', '088889100'),
(5, 'PUTRA', 'BANYUMAS', '088882121'),
(7, 'ARDIANTO ', 'PURBALINGGA', '088881234');

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `kd_mobil` int(8) NOT NULL,
  `jenis_mobil` varchar(35) NOT NULL,
  `warna` varchar(35) NOT NULL,
  `stok` int(8) NOT NULL,
  `tarif_sewa` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`kd_mobil`, `jenis_mobil`, `warna`, `stok`, `tarif_sewa`) VALUES
(1, 'SEDAN', 'PUTIH', 1, 150000),
(2, 'STATION WAGON', 'HITAM', 17, 250000),
(3, 'SUV', 'BIRU', 6, 300000),
(4, 'HATCHBACK', 'SILVER', 10, 250000),
(6, 'Avanza', 'Putih', 10, 200000),
(7, 'Alphard', 'Hitam', 10, 300000);

-- --------------------------------------------------------

--
-- Table structure for table `sewa`
--

CREATE TABLE `sewa` (
  `kd_sewa` int(8) NOT NULL,
  `kd_mobil` int(8) NOT NULL,
  `kd_customer` int(8) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `total_sewa` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sewa`
--

INSERT INTO `sewa` (`kd_sewa`, `kd_mobil`, `kd_customer`, `tgl_pinjam`, `tgl_kembali`, `total_sewa`) VALUES
(4, 2, 2, '2022-04-20', '2022-04-21', 500000),
(5, 1, 3, '2022-04-19', '2022-04-20', 300000),
(6, 1, 1, '2022-04-19', '2022-04-19', 150000);

--
-- Triggers `sewa`
--
DELIMITER $$
CREATE TRIGGER `tr_pengembalian` AFTER DELETE ON `sewa` FOR EACH ROW begin update mobil set stok = stok + 1 where kd_mobil = OLD.kd_mobil; end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_sewa` AFTER INSERT ON `sewa` FOR EACH ROW begin update mobil set stok = stok - 1 where kd_mobil = NEW.kd_mobil; end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_update` AFTER UPDATE ON `sewa` FOR EACH ROW begin
if OLD.kd_mobil <> NEW.kd_mobil then
update mobil set stok = stok + 1 where kd_mobil = OLD.kd_mobil;
update mobil set stok = stok - 1 where kd_mobil = NEW.kd_mobil;
end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `kd_user` int(8) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL,
  `email` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`kd_user`, `username`, `password`, `email`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`kd_customer`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`kd_mobil`);

--
-- Indexes for table `sewa`
--
ALTER TABLE `sewa`
  ADD PRIMARY KEY (`kd_sewa`),
  ADD KEY `kd_mobil` (`kd_mobil`),
  ADD KEY `kd_customer` (`kd_customer`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`kd_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `kd_customer` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `kd_mobil` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sewa`
--
ALTER TABLE `sewa`
  MODIFY `kd_sewa` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `kd_user` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sewa`
--
ALTER TABLE `sewa`
  ADD CONSTRAINT `sewa_ibfk_1` FOREIGN KEY (`kd_customer`) REFERENCES `customer` (`kd_customer`),
  ADD CONSTRAINT `sewa_ibfk_2` FOREIGN KEY (`kd_mobil`) REFERENCES `mobil` (`kd_mobil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
