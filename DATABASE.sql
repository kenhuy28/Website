CREATE Database qlpkthucung;
use qlpkthucung;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2023 at 03:34 PM
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
-- Database: `qlpkthucung`
--

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_dat_hang`
--

CREATE TABLE `chi_tiet_don_dat_hang` (
  `maDonHang` varchar(6) NOT NULL,
  `maSanPham` varchar(6) NOT NULL,
  `soLuong` int(11) NOT NULL,
  `donGia` int(11) NOT NULL,
  `thanhTien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chi_tiet_don_dat_hang`
--

INSERT INTO `chi_tiet_don_dat_hang` (`maDonHang`, `maSanPham`, `soLuong`, `donGia`, `thanhTien`) VALUES
('DH0001', 'SP0001', 2, 140000, 280000),
('DH0002', 'SP0001', 2, 140000, 280000),
('DH0003', 'SP0001', 1, 140000, 140000),
('DH0004', 'SP0001', 1, 140000, 133000),
('DH0005', 'SP0001', 2, 140000, 266000),
('DH0006', 'SP0001', 1, 140000, 133000),
('DH0006', 'SP0002', 2, 80000, 160000),
('DH0007', 'SP0004', 1, 38000, 38000);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_phieu_nhap`
--

CREATE TABLE `chi_tiet_phieu_nhap` (
  `maPhieuNhap` varchar(6) NOT NULL,
  `maSanPham` varchar(6) NOT NULL,
  `soLuong` int(11) NOT NULL,
  `donGia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `don_dat_hang`
--

CREATE TABLE `don_dat_hang` (
  `maDonHang` varchar(6) NOT NULL,
  `maKhachHang` varchar(6) NOT NULL,
  `ngayDat` datetime NOT NULL,
  `ngayGiao` datetime DEFAULT NULL,
  `tinhTrang` bit(2) NOT NULL,
  `daThanhToan` bit(1) NOT NULL,
  `tongTien` int(11) NOT NULL,
  `maNhanVien` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `don_dat_hang`
--

INSERT INTO `don_dat_hang` (`maDonHang`, `maKhachHang`, `ngayDat`, `ngayGiao`, `tinhTrang`, `daThanhToan`, `tongTien`, `maNhanVien`) VALUES
('DH0001', 'KH0001', '2023-06-06 23:27:49', NULL, b'01', b'0', 280000, ''),
('DH0002', 'KH0001', '2023-06-07 00:33:12', NULL, b'01', b'0', 280000, ''),
('DH0003', 'KH0002', '2023-06-07 00:54:50', NULL, b'01', b'0', 140000, ''),
('DH0004', 'KH0002', '2023-06-07 02:13:41', NULL, b'01', b'0', 133000, ''),
('DH0005', 'KH0002', '2023-06-07 13:35:53', NULL, b'01', b'0', 280000, ''),
('DH0006', 'KH0002', '2023-06-07 13:56:40', NULL, b'01', b'0', 293000, ''),
('DH0007', 'KH0002', '2023-06-13 08:03:54', NULL, b'00', b'0', 38000, '');

-- --------------------------------------------------------

--
-- Table structure for table `giam_gia`
--

CREATE TABLE `giam_gia` (
  `maGiamGia` varchar(6) NOT NULL,
  `maSanPham` varchar(6) NOT NULL,
  `loaiGiamGia` bit(2) NOT NULL,
  `giaTriGiam` int(11) NOT NULL,
  `ngayBatDau` date NOT NULL,
  `ngayKetThuc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `giam_gia`
--

INSERT INTO `giam_gia` (`maGiamGia`, `maSanPham`, `loaiGiamGia`, `giaTriGiam`, `ngayBatDau`, `ngayKetThuc`) VALUES
('GG0001', 'SP0001', b'00', 5, '2023-11-07', '2023-11-15'),
('GG0002', 'SP0003', b'00', 5, '2023-11-09', '2023-11-12');

-- --------------------------------------------------------

--
-- Table structure for table `huyen`
--

CREATE TABLE `huyen` (
  `maHuyen` varchar(6) NOT NULL,
  `tenHuyen` varchar(50) NOT NULL,
  `maTinh` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `huyen`
--

INSERT INTO `huyen` (`maHuyen`, `tenHuyen`, `maTinh`) VALUES
('HU0001', 'Ninh Hòa', 'TINH33'),
('HU0002', 'Cam Ranh', 'TINH33'),
('HU0003', 'Khánh Vĩnh', 'TINH33'),
('HU0004', 'Diên Khánh', 'TINH33'),
('HU0005', 'Cam Lâm', 'TINH33'),
('HU0006', 'Nha Trang', 'TINH33'),
('HU0007', 'Buôn Ma Thuột', 'TINH19'),
('HU0008', 'Buôn Hồ', 'TINH19'),
('HU0009', 'Krông Ana', 'TINH19'),
('HU0010', 'Krông Bông', 'TINH19'),
('HU0011', 'Krông Nô', 'TINH19'),
('HU0012', 'Lâm Hà', 'TINH19'),
('HU0013', 'Lắk', 'TINH19'),
('HU0014', 'M\'Đrắk', 'TINH19'),
('HU0015', 'Ea Kar', 'TINH19'),
('HU0016', 'Ea Súp', 'TINH19'),
('HU0017', 'Đắk Mil', 'TINH19'),
('HU0018', 'Cư Jút', 'TINH19'),
('HU0019', 'Cư M\'gar', 'TINH19'),
('HU0020', 'Đắk Glong', 'TINH19'),
('HU0021', 'Yên Tử', 'TINH19'),
('HU0022', 'Tây Hòa', 'TINH36'),
('HU0023', 'Tuy An', 'TINH36'),
('HU0024', 'Sông Cầu', 'TINH36'),
('HU0025', 'Sông Hinh', 'TINH36'),
('HU0026', 'Đồng Xuân', 'TINH36'),
('HU0027', 'Phú Hòa', 'TINH36'),
('HU0028', 'Tuy Hòa', 'TINH36');

-- --------------------------------------------------------

--
-- Table structure for table `khanh_hang`
--

CREATE TABLE `khanh_hang` (
  `maKhachHang` varchar(6) NOT NULL,
  `hoKhachHang` varchar(50) NOT NULL,
  `tenKhachHang` varchar(10) NOT NULL,
  `dienThoai` varchar(10) NOT NULL,
  `diaChiCuThe` varchar(255) NOT NULL,
  `tenNguoiDung` varchar(20) NOT NULL,
  `matKhau` char(80) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ngaySinh` date NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `khoiPhucMatKhau` varchar(255) DEFAULT NULL,
  `maXa` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khanh_hang`
--

INSERT INTO `khanh_hang` (`maKhachHang`, `hoKhachHang`, `tenKhachHang`, `dienThoai`, `diaChiCuThe`, `tenNguoiDung`, `matKhau`, `email`, `ngaySinh`, `avatar`, `khoiPhucMatKhau`, `maXa`) VALUES
('KH0001', 'Võ Thanh', 'Hào', '0358932774', '171/Nguyễn Văn Chiểu', 'thanhhao', 'qpalqpal', 'hao@gmail.com', '2002-01-01', 'thanhhao.png', NULL, 'X00007'),
('KH0002', 'Trần Cao', 'Phong', '0514684932', '171/Nguyễn Văn Chiểu', 'caophong', 'qpalqpal', 'phong@gmail.com', '2002-01-01', 'caophong.png', NULL, 'X00012'),
('KH0003', 'Lê Bảo', 'Khoa', '0867984654', '171/Nguyễn Văn Chiểu', 'baokhoa', 'qpalqpal', 'khoa@gmail.com', '2003-01-30', 'baokhoa.png', NULL, 'X00008');

-- --------------------------------------------------------

--
-- Table structure for table `loai_san_pham`
--

CREATE TABLE `loai_san_pham` (
  `maLoai` varchar(6) NOT NULL,
  `tenLoai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loai_san_pham`
--

INSERT INTO `loai_san_pham` (`maLoai`, `tenLoai`) VALUES
('LSP001', 'Thức ăn cho chó'),
('LSP002', 'Thức ăn cho mèo'),
('LSP003', 'Quần áo cho chó'),
('LSP004', 'Quần áo cho mèo'),
('LSP005', 'Sữa tắm'),
('LSP006', 'Pate Tươi'),
('LSP007', 'Raw Food');

-- --------------------------------------------------------

--
-- Table structure for table `loai_tai_khoan`
--

CREATE TABLE `loai_tai_khoan` (
  `maLoai` varchar(6) NOT NULL,
  `tenLoai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loai_tai_khoan`
--

INSERT INTO `loai_tai_khoan` (`maLoai`, `tenLoai`) VALUES
('LTK001', 'Quản Lý'),
('LTK002', 'Nhân viên marketing'),
('LTK003', 'Nhân viên sale');

-- --------------------------------------------------------

--
-- Table structure for table `nhan_vien`
--

CREATE TABLE `nhan_vien` (
  `maNhanVien` varchar(6) NOT NULL,
  `ho` varchar(50) NOT NULL,
  `ten` varchar(10) NOT NULL,
  `ngaySinh` date DEFAULT NULL,
  `diaChiCuThe` varchar(255) NOT NULL,
  `dienThoai` varchar(10) NOT NULL,
  `maLoai` varchar(6) NOT NULL,
  `tenNguoiDung` varchar(20) NOT NULL,
  `matKhau` char(80) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `maXa` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nhan_vien`
--

INSERT INTO `nhan_vien` (`maNhanVien`, `ho`, `ten`, `ngaySinh`, `diaChiCuThe`, `dienThoai`, `maLoai`, `tenNguoiDung`, `matKhau`, `avatar`, `email`, `maXa`) VALUES
('AD0001', 'Nguyễn Hữu', 'Lực', NULL, 'Khánh Hòa', '0856202788', 'LTK001', 'huuluc', 'qpalqpal', 'huuluc.png', 'huuluc@gmail.com', NULL),
('AD0002', 'Ngô Tuấn', 'Lam', NULL, 'Phú Yên', '0347693333', 'LTK001', 'tuanlam', 'qpalqpal', 'tuanlam.png', 'tuanlam@gmail.com', NULL),
('AD0003', 'Nguyễn Lê', 'Tâm', NULL, 'Khánh Hòa', '0924494119', 'LTK001', 'letam', 'qpalqpal', 'letam.png', 'letam@gmail.com', NULL),
('AD0004', 'Phạm Phương', 'Nam', NULL, 'Đăk Lăk', '0867566932', 'LTK001', 'nam5520', 'qpalqpal', 'nam5520.png', 'nam5520000@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `phieu_nhap`
--

CREATE TABLE `phieu_nhap` (
  `maPhieuNhap` varchar(6) NOT NULL,
  `ngayNhap` date NOT NULL,
  `maNhanVien` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `san_pham`
--

CREATE TABLE `san_pham` (
  `maSanPham` varchar(6) NOT NULL,
  `tenSanPham` varchar(255) NOT NULL,
  `donGiaMua` int(11) NOT NULL,
  `donGiaBan` int(11) NOT NULL,
  `maThuongHieu` varchar(6) NOT NULL,
  `maLoai` varchar(6) NOT NULL,
  `soLuong` int(11) NOT NULL,
  `hinhAnh` varchar(255) NOT NULL,
  `moTa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `san_pham`
--

INSERT INTO `san_pham` (`maSanPham`, `tenSanPham`, `donGiaMua`, `donGiaBan`, `maThuongHieu`, `maLoai`, `soLuong`, `hinhAnh`, `moTa`) VALUES
('SP0001', 'Pate Cho Mèo Con Dạng Kem Nekko Kitten Mousse 70g', 100000, 140000, 'THH002', 'LSP002', 92, 'pate-kit-cat-sua-de-bo-sung-canxi-cho-meo-lon-85g-paddy-2_1066x.png', 'Pate Tươi Cho Mèo Hỗn Hợp cho Chó Mèo Biếng Ăn được làm từ hỗn hợp cá biển và gan gà tươi nguyên chất.'),
('SP0002', 'Hạt Chó Trên 6 Tháng ANF 6Free Hữu Cơ', 70000, 80000, 'THH004', 'LSP001', 76, 'hat-cho-anf-6free.png', 'Dùng cho mèo trưởng thành từ 1 năm tuổi trở lên.'),
('SP0003', 'Hạt Chó Trên 6 Tháng ANF 6Free Hữu Cơ', 60000, 75000, 'THH006', 'LSP007', 0, '1_7ee6dfab-63fe-4317-a0b3-37d951d024c3.png', 'Là một chế độ ăn sống, đảm bảo dinh dưỡng và hấp thụ tốt hơn.\r\n- Raw hoàn chỉnh cho Mèo bao gồm 86% thịt cơ, 6% xương sống, 3% gan và 5% các cơ quan khác để đạt được sự cân bằng dinh dưỡng tối ưu.\r\n- Nguồn nguyên liệu tươi ngon tiêu'),
('SP0004', 'Pate Lon Whiskas Cho Mèo Trưởng Thành 400g', 30000, 38000, 'THH003', 'LSP007', 9, 'pate-lon-whiskas-cho-meo-truong-thanh-400g-paddy-1.png', ' Đảm bảo khẩu vị thơm ngon mỗi bữa ăn.\r\nCung cấp đủ vitamin và taurine, giúp đôi mắt của mèo luôn sáng tinh anh và khỏe mạnh.\r\n- Bổ sung dưỡng chất đạm, Vitamin và khoáng chất từ cá tươi tốt cho hệ phát triển tối ưu, giúp mèo có cơ thể năng động và tràn đ'),
('SP0005', 'Pate Kit Cat Sữa Dê Bổ Sung Canxi Cho Mèo (Lon 85g)', 20000, 26500, 'THH002', 'LSP007', 0, 'hat-pedigree-cho-truong-thanh-vi-bo-rau-cu-paddy-1.png', '1. Đặc điểm nổi bật:\r\n\r\n- Hoàn toàn từ thịt trắng, thịt được xé nhỏ\r\n- 12 công thức là 12 hương vị'),
('SP0006', 'Pate Mèo Ciao 6 Vị Thơm Ngon 60g', 10000, 14000, 'THH006', 'LSP007', 18, 'pate-meo-ciao-60g.png', 'Thức Ăn Dinh Dưỡng Cho Mèo Pate Gà Mực Cua Cá Ngừ Cá Cơm Cá Hồi Ciao Gói 60g'),
('SP0007', 'Hạt Cho Chó Nutrience Subzero Fraser Valley Dog', 100000, 150000, 'THH005', 'LSP001', 0, 'hat-nutrience-infusion-small-adult-cho-lon-giong-nho-paddy-1_1066x.png', 'Nutrience Subzero Fraser Valley cho Chó có hạt thịt tươi thơm ngon, sử dụng các nguồn nguyên liệu tự nhiên tươi sống của Canada như thịt gà Canada thả vườn, gà tây, cá hồi, cá trích, cá tuyết, gan gà, tim gà, gan gà tây, tim gà tây, gan cá tuyết và hạt th'),
('SP0008', 'Thịt Tươi Hi Raw CAT Food Cho MÈO Ăn Sống (Ship Now 2h Tp.HCM)', 60000, 75000, 'THH006', 'LSP006', 0, '2_11614cfa-01e2-441d-ad75-1aa82f3305e7_1066x.png', ' THÔNG TIN SẢN PHẨM\r\n- Là một chế độ ăn sống, đảm bảo dinh dưỡng và hấp thụ tốt hơn.\r\n- Raw hoàn chỉnh cho Mèo bao gồm 86% thịt cơ, 6% xương sống, 3% gan và 5% các cơ quan khác để đạt được sự cân bằng dinh dưỡng tối ưu.'),
('SP0009', 'Pate Mèo Ciao 6 Vị Thơm Ngon 60g', 10000, 14000, 'THH002', 'LSP007', 30, '2_11614cfa-01e2-441d-ad75-1aa82f3305e7_1066x.png', 'Thức Ăn Dinh Dưỡng Cho Mèo Pate Gà Mực Cua Cá Ngừ Cá Cơm Cá Hồi Ciao Gói 60g');

-- --------------------------------------------------------

--
-- Table structure for table `thuong_hieu`
--

CREATE TABLE `thuong_hieu` (
  `maThuongHieu` varchar(6) NOT NULL,
  `tenThuongHieu` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thuong_hieu`
--

INSERT INTO `thuong_hieu` (`maThuongHieu`, `tenThuongHieu`, `logo`) VALUES
('THH001', 'Nexgard', 'nexgard_logo.png'),
('THH002', 'Whiskas', 'whiskas-logo.png'),
('THH003', 'ANF', 'anf-logo.png'),
('THH004', 'Nutrience', 'nutrience-logo.png'),
('THH005', 'Pedigree', 'pedigree-logo.png'),
('THH006', 'Monge', 'monge-logo.png'),
('THH007', 'Royal Canin', 'royal-canin-logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `tinh`
--

CREATE TABLE `tinh` (
  `maTinh` varchar(6) NOT NULL,
  `tenTinh` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tinh`
--

INSERT INTO `tinh` (`maTinh`, `tenTinh`) VALUES
('TINH01', 'Hà Nội'),
('TINH02', 'TP. Hồ Chí Minh'),
('TINH03', 'An Giang'),
('TINH04', 'Bà Rịa - Vũng Tàu'),
('TINH05', 'Bắc Giang'),
('TINH06', 'Bắc Kạn'),
('TINH07', 'Bạc Liêu'),
('TINH08', 'Bắc Ninh'),
('TINH09', 'Bến Tre'),
('TINH10', 'Bình Định'),
('TINH11', 'Bình Dương'),
('TINH12', 'Bình Phước'),
('TINH13', 'Bình Thuận'),
('TINH14', 'Bình Định'),
('TINH15', 'Cà Mau'),
('TINH16', 'Cao Bằng'),
('TINH17', 'Cần Thơ'),
('TINH18', 'Đà Nẵng'),
('TINH19', 'Đắk Lắk'),
('TINH20', 'Đắk Nông'),
('TINH21', 'Điện Biên'),
('TINH22', 'Đồng Nai'),
('TINH23', 'Đồng Tháp'),
('TINH24', 'Gia Lai'),
('TINH25', 'Hà Giang'),
('TINH26', 'Hà Nam'),
('TINH27', 'Hà Tĩnh'),
('TINH28', 'Hải Dương'),
('TINH29', 'Hải Phòng'),
('TINH30', 'Hậu Giang'),
('TINH31', 'Hòa Bình'),
('TINH32', 'Hưng Yên'),
('TINH33', 'Khánh Hòa'),
('TINH34', 'Kiên Giang'),
('TINH35', 'Kon Tum'),
('TINH36', 'Lai Châu'),
('TINH37', 'Lâm Đồng'),
('TINH38', 'Lạng Sơn'),
('TINH39', 'Lào Cai'),
('TINH40', 'Long An'),
('TINH41', 'Nam Định'),
('TINH42', 'Nghệ An'),
('TINH43', 'Ninh Bình'),
('TINH44', 'Ninh Thuận'),
('TINH45', 'Phú Thọ'),
('TINH46', 'Phú Yên'),
('TINH47', 'Quảng Bình'),
('TINH48', 'Quảng Nam'),
('TINH49', 'Quảng Ngãi'),
('TINH50', 'Quảng Ninh'),
('TINH51', 'Quảng Trị'),
('TINH52', 'Sóc Trăng'),
('TINH53', 'Sơn La'),
('TINH54', 'Tây Ninh'),
('TINH55', 'Thái Bình'),
('TINH56', 'Thái Nguyên'),
('TINH57', 'Thanh Hóa'),
('TINH58', 'Thừa Thiên Huế'),
('TINH59', 'Tiền Giang'),
('TINH60', 'Trà Vinh'),
('TINH61', 'Tuyên Quang'),
('TINH62', 'Vĩnh Long'),
('TINH63', 'Vĩnh Phúc');

-- --------------------------------------------------------

--
-- Table structure for table `xa`
--

CREATE TABLE `xa` (
  `maXa` varchar(6) NOT NULL,
  `tenXa` varchar(100) NOT NULL,
  `maHuyen` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `xa`
--

INSERT INTO `xa` (`maXa`, `tenXa`, `maHuyen`) VALUES
('X00001', 'Ninh Trung', 'HU0001'),
('X00002', 'Ninh Đông', 'HU0001'),
('X00003', 'Ninh Tây', 'HU0001'),
('X00004', 'Ninh Hòa', 'HU0001'),
('X00005', 'Ninh Hiệp', 'HU0001'),
('X00006', 'Ninh An', 'HU0001'),
('X00007', 'Nha Trang', 'HU0006'),
('X00008', 'Phường Vĩnh Hải', 'HU0006'),
('X00009', 'Phường Vĩnh Hòa', 'HU0006'),
('X00010', 'Phường Vĩnh Hiệp', 'HU0006'),
('X00011', 'Phường Vĩnh Nguyên', 'HU0006'),
('X00012', 'Phường Vĩnh Thọ', 'HU0006'),
('X00013', 'Buôn Ma Thuột', 'HU0019'),
('X00014', 'Phường Tân Hòa', 'HU0019'),
('X00015', 'Phường Tân Tiến', 'HU0019'),
('X00016', 'Phường Thắng Lợi', 'HU0019'),
('X00017', 'Phường Thắng Nhì', 'HU0019'),
('X00018', 'Phường Tân Thành', 'HU0019'),
('X00019', 'Tuy Hòa', 'HU0023'),
('X00020', 'Phường 1', 'HU0023'),
('X00021', 'Phường 2', 'HU0023'),
('X00022', 'Phường 3', 'HU0023'),
('X00023', 'Phường 4', 'HU0023'),
('X00024', 'Phường 5', 'HU0023');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chi_tiet_don_dat_hang`
--
ALTER TABLE `chi_tiet_don_dat_hang`
  ADD PRIMARY KEY (`maDonHang`,`maSanPham`),
  ADD KEY `maSanPham` (`maSanPham`);

--
-- Indexes for table `chi_tiet_phieu_nhap`
--
ALTER TABLE `chi_tiet_phieu_nhap`
  ADD PRIMARY KEY (`maPhieuNhap`,`maSanPham`),
  ADD KEY `maSanPham` (`maSanPham`);

--
-- Indexes for table `don_dat_hang`
--
ALTER TABLE `don_dat_hang`
  ADD PRIMARY KEY (`maDonHang`),
  ADD KEY `maKhachHang` (`maKhachHang`);

--
-- Indexes for table `giam_gia`
--
ALTER TABLE `giam_gia`
  ADD PRIMARY KEY (`maGiamGia`),
  ADD KEY `maSanPham` (`maSanPham`);

--
-- Indexes for table `huyen`
--
ALTER TABLE `huyen`
  ADD PRIMARY KEY (`maHuyen`),
  ADD KEY `maTinh` (`maTinh`);

--
-- Indexes for table `khanh_hang`
--
ALTER TABLE `khanh_hang`
  ADD PRIMARY KEY (`maKhachHang`),
  ADD KEY `maXa` (`maXa`);

--
-- Indexes for table `loai_san_pham`
--
ALTER TABLE `loai_san_pham`
  ADD PRIMARY KEY (`maLoai`);

--
-- Indexes for table `loai_tai_khoan`
--
ALTER TABLE `loai_tai_khoan`
  ADD PRIMARY KEY (`maLoai`);

--
-- Indexes for table `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD PRIMARY KEY (`maNhanVien`),
  ADD KEY `maLoai` (`maLoai`),
  ADD KEY `maXa` (`maXa`);

--
-- Indexes for table `phieu_nhap`
--
ALTER TABLE `phieu_nhap`
  ADD PRIMARY KEY (`maPhieuNhap`),
  ADD KEY `maNhanVien` (`maNhanVien`);

--
-- Indexes for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`maSanPham`),
  ADD KEY `maLoai` (`maLoai`),
  ADD KEY `maThuongHieu` (`maThuongHieu`);

--
-- Indexes for table `thuong_hieu`
--
ALTER TABLE `thuong_hieu`
  ADD PRIMARY KEY (`maThuongHieu`);

--
-- Indexes for table `tinh`
--
ALTER TABLE `tinh`
  ADD PRIMARY KEY (`maTinh`);

--
-- Indexes for table `xa`
--
ALTER TABLE `xa`
  ADD PRIMARY KEY (`maXa`),
  ADD KEY `maHuyen` (`maHuyen`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chi_tiet_don_dat_hang`
--
ALTER TABLE `chi_tiet_don_dat_hang`
  ADD CONSTRAINT `chi_tiet_don_dat_hang_ibfk_1` FOREIGN KEY (`maDonHang`) REFERENCES `don_dat_hang` (`maDonHang`),
  ADD CONSTRAINT `chi_tiet_don_dat_hang_ibfk_2` FOREIGN KEY (`maSanPham`) REFERENCES `san_pham` (`maSanPham`);

--
-- Constraints for table `chi_tiet_phieu_nhap`
--
ALTER TABLE `chi_tiet_phieu_nhap`
  ADD CONSTRAINT `chi_tiet_phieu_nhap_ibfk_1` FOREIGN KEY (`maPhieuNhap`) REFERENCES `phieu_nhap` (`maPhieuNhap`),
  ADD CONSTRAINT `chi_tiet_phieu_nhap_ibfk_2` FOREIGN KEY (`maSanPham`) REFERENCES `san_pham` (`maSanPham`);

--
-- Constraints for table `don_dat_hang`
--
ALTER TABLE `don_dat_hang`
  ADD CONSTRAINT `don_dat_hang_ibfk_1` FOREIGN KEY (`maKhachHang`) REFERENCES `khanh_hang` (`maKhachHang`);

--
-- Constraints for table `giam_gia`
--
ALTER TABLE `giam_gia`
  ADD CONSTRAINT `giam_gia_ibfk_1` FOREIGN KEY (`maSanPham`) REFERENCES `san_pham` (`maSanPham`);

--
-- Constraints for table `huyen`
--
ALTER TABLE `huyen`
  ADD CONSTRAINT `huyen_ibfk_1` FOREIGN KEY (`maTinh`) REFERENCES `tinh` (`maTinh`);

--
-- Constraints for table `khanh_hang`
--
ALTER TABLE `khanh_hang`
  ADD CONSTRAINT `khanh_hang_ibfk_1` FOREIGN KEY (`maXa`) REFERENCES `xa` (`maXa`);

--
-- Constraints for table `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD CONSTRAINT `nhan_vien_ibfk_2` FOREIGN KEY (`maXa`) REFERENCES `xa` (`maXa`),
  ADD CONSTRAINT `nhan_vien_ibfk_3` FOREIGN KEY (`maLoai`) REFERENCES `loai_tai_khoan` (`maLoai`);

--
-- Constraints for table `phieu_nhap`
--
ALTER TABLE `phieu_nhap`
  ADD CONSTRAINT `phieu_nhap_ibfk_1` FOREIGN KEY (`maNhanVien`) REFERENCES `nhan_vien` (`maNhanVien`);

--
-- Constraints for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `san_pham_ibfk_1` FOREIGN KEY (`maLoai`) REFERENCES `loai_san_pham` (`maLoai`),
  ADD CONSTRAINT `san_pham_ibfk_2` FOREIGN KEY (`maThuongHieu`) REFERENCES `thuong_hieu` (`maThuongHieu`);

--
-- Constraints for table `xa`
--
ALTER TABLE `xa`
  ADD CONSTRAINT `xa_ibfk_1` FOREIGN KEY (`maHuyen`) REFERENCES `huyen` (`maHuyen`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
