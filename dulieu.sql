-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2020 at 11:14 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dulieu`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` mediumtext COLLATE utf8mb4_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`chat_message_id`, `to_user_id`, `from_user_id`, `chat_message`, `timestamp`, `status`) VALUES
(54, 6, 1, '123213', '2019-07-06 04:57:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `info_cus`
--

CREATE TABLE `info_cus` (
  `id_cus` int(10) NOT NULL,
  `name_cus` varchar(255) DEFAULT NULL,
  `phone_cus` text NOT NULL,
  `add_cus` varchar(255) NOT NULL,
  `des_cus` varchar(50) NOT NULL,
  `yc_book` varchar(255) NOT NULL,
  `note_book` varchar(255) DEFAULT NULL,
  `kind_book` varchar(50) DEFAULT NULL,
  `date_book` varchar(20) NOT NULL,
  `flag_book` tinyint(1) NOT NULL,
  `flag_status` varchar(16) DEFAULT NULL COMMENT 'Hủy and Khảo Sát and Chờ',
  `nv_add` varchar(100) NOT NULL,
  `phu` varchar(10) NOT NULL DEFAULT 'khong',
  `operator_time` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `info_cus`
--

INSERT INTO `info_cus` (`id_cus`, `name_cus`, `phone_cus`, `add_cus`, `des_cus`, `yc_book`, `note_book`, `kind_book`, `date_book`, `flag_book`, `flag_status`, `nv_add`, `phu`, `operator_time`) VALUES
(724, ' ', '909012296', 'E419 lo e cc binh khanh', 'q2', 'thong nghet bon cau', 'chụp ảnh , quay clip gửi mr Hậu', '', '2020-11-16', 0, NULL, 'Admin', 'khong', NULL),
(725, ' ', '983621033', '39 ben van don', 'q4', 'lap mg', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Nước', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(726, 'a hùng', '962421222', '285b cmtt', 'q10', 'thay đen', 'chụp ảnh , quay clip gửi mr Hậu', '', '2020-11-17', 0, NULL, 'Admin', 'khong', NULL),
(727, 'c thùy anh', '908810305', '872 võ văn kiệt', 'q5', 'nước rò rỉ', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Nước', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(728, 'c. Luyến', '914090609', '86 duong 61', 'Q9', 'chông thấm', '8h chụp ảnh , quay clip gửi mr Hậu', 'Điện Nước', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(729, 'c. hồng', '974288401', 'tòa H1, vincom', 'Q2', 'thong nghet', '3h chụp ảnh , quay clip gửi mr Hậu', 'Điện Nước', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(730, ' ', '908197779', '31/7 út Tich', 'tb', 'chống hôi1', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Nước', '2020-11-16', 0, NULL, 'Admin', 'Thợ Phụ 12', NULL),
(731, 'a quân', '365443344', '79 lien khu 89 bhha', 'btan', 'thay og nuoc', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Nước', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(732, 'c thắm', '962976259', '37 tiền giang', 'tb', 'ktra mất điện', 'hihi', 'Điện Nước', '2020-11-16 - Old', 0, NULL, 'Admin', '', NULL),
(733, 'a minh', '915662396', '71t đồng khởi', 'q1', 'lắp quạt trần', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Nước', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(734, 'Bh A Mèo', '903015977', '37 nguyễn văn hưởng', 'Q2', 'Bh vòi nước', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Nước', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(735, ' ', '918116250', '539/31 cmtt', 'q10', 'Sua dien', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Nước', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(736, 'c. thoa', '938686772', '55/19 nguyen van cong', 'GV', 'thay den', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Nước', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(737, 'c. nga', '908004092', '256/70/40 phan huy ich', 'GV', 'sua ong nuoc', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Nước', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(738, 'a bình', '907146399', '31 nguyễn duy hiệu', 'q2', 'chống thấm tô led', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Nước', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(739, 'a khôi', '847444744', '123 cống quỳnh', 'q1', 'thay may hut khoi', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Nước', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(740, 'c trang', '933339932', '210 thành thái', 'q10', 'thay den', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Nước', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(741, ' ', '2836207346', '1 sog hanh', 'q2', 'sửa máy lọc nước', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Nước', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(742, 'c như', '708512571', '92 hoang dieu 2', 'td', 'thông nghẹt bồn cầu', '', 'Điện Nước', '2020-11-16', 0, NULL, 'Admin', 'khong', NULL),
(743, 'c. trang', '773785711', '218/3 vuon lài', 'q12', 'vòi nước rủa chén', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Nước', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(744, 'a nam', '898704550', '370 nguyễn văn quỳ', 'q7', 'lắp quạt trần', '16h chụp ảnh , quay clip gửi mr Hậu', 'Điện Nước', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(745, 'a lộc 9h', '975241441', '64/75 đường 75 tân phong', 'q7', 'sập cb', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Nước', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(746, 'c thủy', '708161161', '5/15 d 40 hbc', 'td', 'thong nghet bon cau', '', 'Điện Nước', '2020-11-16 - Old', 1, 'Hủy', 'Admin', 'khong', NULL),
(747, 'chieu', '903666092', '19b dg 2, p hbphuoc,', 'tduc', 'lap dien', '', 'Điện Nước', '2020-11-16 - Old', 1, 'Hủy', 'Admin', 'khong', NULL),
(748, 'a giang', '984857853', '72a/30a cô giang', 'pn', 'nuoc ro ri', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Nước', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(749, 'a bình 918271948', '972953888', '281c lãnh đình thăng', 'q11', 'sửa nhà vệ sinh, lót gạch', '   chụp ảnh quay clip gửi Mr Hậu', 'Điện Nước', '2020-11-16 - Old', 1, NULL, 'Admin', '', NULL),
(750, 'Công An Thành phố', '944333979', '240/37/2 NG Văn Luông', 'Q6', 'Vs Bồn nước', ' chụp ảnh quay clip gửi Mr Hậu', 'Điện Nước', '2020-11-16 - Old', 1, NULL, 'Admin', '', NULL),
(751, ' ', '377899533', 'b1/7a nguyễn hữu trí', 'bc', 'sửa tủ lạnh', ' chụp ảnh quay clip gửi Mr Hậu', 'Điện Lạnh', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(752, ' kh1', '366244603', 'lê quang định', 'bthanh', 'nước rò rỉ', '', '', '2020-11-16', 1, NULL, 'Admin', 'khong', NULL),
(753, 'c thu', '938553933', '60A Trang Tử', 'Q5', 'chống thấm', '   chụp ảnh quay clip gửi Mr Hậu', 'Điện Nước', '2020-11-16 - Old', 1, NULL, 'Admin', '', NULL),
(754, ' ', '908.326.397', 'Số 44 Đ. Thạnh Xuân 24, P. Thạnh Xuân, Q12', ' ', 'VSML nhìu', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Lạnh', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(755, ' ', '907692173', '106/3/5 đường 51', 'gv', 'tháo ml mang thang', '11h chụp ảnh , quay clip gửi mr Hậu', 'Điện Lạnh', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(756, 'c hang', '795045263', '32 phan liêm', 'q1', 'vsml', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Lạnh', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(757, 'mag thang', '972819594', '215 le van viet f hiep phub', 'q9', 'sua may lanh chay nc', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Lạnh', '2020-11-16 - Old', 1, NULL, 'Admin', '', NULL),
(758, 'a cường', '902372707', '35/12 bế văn cấm', 'q7', 'lắp ml', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Lạnh', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(760, ' ', '908.326.397', 'Số 44 Đ. Thạnh Xuân 24, P. Thạnh Xuân, Q12', ' ', 'bh ml lỗi f2', ' chụp ảnh quay clip gửi Mr Hậu', 'Điện Lạnh', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(761, ' ', '907010319', '32/5 bùi đình tuý thu', 'PN', 'Vsml', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Lạnh', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(762, 'a. quan', '984978531', '30 nguyen thi thap, khu him lam', 'Q7', 'vsml', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Lạnh', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(764, 'a. Duc', '936617687', 'CC new saigon', 'Q7', 'VSMl + quan si', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Lạnh', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(765, 'a cường', '902372707', '35/12 bé văn cấm', 'q7', 'vsml, tháo lắp ml', ' 8h chụp ảnh , quay clip gửi mr Hậu', 'Điện Lạnh', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(766, 'a phog', '395995981', '1220/2/2 phạm thế hiển', 'q8', 'tháo ml + lap og mg', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Lạnh', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(767, 'c hang', '933254710', '106 phó đức chính', 'bthanh', 'vsml', '2h chụp ảnh , quay clip gửi mr Hậu', 'Điện Lạnh', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(768, ' ', '961707027', '46/40/10 vườn chuối', 'q3', 'vsml', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Lạnh', '2020-11-16 - Old', 1, NULL, 'Admin', 'khong', NULL),
(769, ' ', '708100992', 'Body shop 87 mạc thị Bưởi', 'q1', 'Ksat lắp máy lạnh', '  (Thợ Phụ Cường Quận 11)', 'Điện Lạnh', '2020-11-16 - Old', 1, NULL, 'Admin', 'khong', NULL),
(770, ' ', '918715617', '659 au co ,', 'TP', 'bao hanh ron cua tu lanh', 'chụp ảnh , quay clip gửi mr Hậu ( Vu Lam)', 'Điện Lạnh', '2020-11-16 - Old', 1, NULL, 'Admin', 'Thợ Phụ 1', NULL),
(771, ' ', '795252843', 'vinh loc', 'bc', 'vsmg', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Lạnh', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(772, 'c kong', '935585702', '2 nguyễn thế lộc p12', 'tb', 'bh ml chảy nước', 'chac ( Nin Lam)', 'Điện Lạnh', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(773, ' ', '961707027', 'A đến 46/40/10 Vườn Chuối p4 q3', ' ', '. Lần trước có anh tên Khanh đến làm 1 lần rồi ạ +84961707027 vsml do cô', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Lạnh', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(774, ' ', '979511020', '481/10 tktq', 'tp', 'VSMG', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Lạnh', '2020-11-16 - Old', 1, NULL, 'Admin', 'Thợ Phụ 1', NULL),
(775, ' ', '983282942', '27/3 Đồng xoài', 'tb', 'sửa lò vi sóng', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Lạnh', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(776, 'c hà', '988819704', 'anh đường trục', 'Bình Thạnh', 'sua voi nuoc nog lanh', ' chụp ảnh quay clip gửi Mr Hậu', 'Đồ Gỗ', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(777, 'a nam', '986039292', '448 nguyễn tất thành', 'Quận 4', 'sửa ống nước, máy bơm', ' chụp ảnh quay clip gửi Mr Hậu', 'Điện Nước', '2020-11-16', 0, NULL, 'Admin', '', NULL),
(778, ' ', '817404068', 'thi xa phu my', 'Vũng Tàu', 'Nuoc ro ri', '', 'Điện Gỗ', '2020-11-16 - Old', 1, 'Hủy', 'Admin', 'khong', NULL),
(779, 'a duy', '854332555', '156/17 lâm thị hố, tân chánh hiệp	q12	', 'Quận 12', 'thay vòi nước', 'Chụp ảnh, quay clip gửi mr Hậu', 'Điện Nước', '2020-11-16 - Old', 0, NULL, 'Admin', '', NULL),
(780, 'c thư ', '919356364 2835123436', 'lầu 23 561a đbp ', 'Quận 1', 'chống hôi cống		', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Lạnh', '2020-11-16 - Old', 0, NULL, 'Admin', 'khong', NULL),
(781, '', '907010319			', '32/5 bùi đình tuý thu 	PN	907010319', 'Phú Nhuận', 'Lắp đèn', 'Chụp ảnh, quay clip gửi mr Hậu', 'Điện Nước', '2020-11-16 - Old', 1, NULL, 'Admin', '', NULL),
(782, '', '934919711', 'R1-73 hung phuoc 1', 'Quận 7', 'lap o cam', 'Kh không cần nữa', 'Điện Nước', '2020-11-16 - Old', 1, NULL, 'Admin', '', NULL),
(783, 'c trang', '772072003', '23-25-27 đường 15b phú mỹ', 'Quận 7', 'lắp quạt thông gió	', 'chụp ảnh quay clip gửi Mr Hậu', 'Điện Nước', '2020-11-16', 1, NULL, 'Admin', '', NULL),
(784, 'c thảo', '938094158', '519 cát lái', 'Quận 2', 'sửa tủ gỗ ', 'Chụp ảnh, quay clip gửi mr Hậu', 'Đồ Gỗ', '2020-11-16 - Old', 0, NULL, 'Admin', 'Thợ Phụ co', NULL),
(785, '', '2836207346', '1 sog hanh', 'Quận 2', 'sửa máy lọc nước ', '', 'Điện Nước', '2020-11-16', 1, NULL, 'Trần Mạnh', '', NULL),
(786, 'c. trang', '773785711', '218/3 vuon  lài', 'Quận 12', 'vòi nước rủa chén			', '', 'Điện Nước', '2020-11-16', 1, NULL, 'Trần Mạnh', '', NULL),
(787, '', '0907388717', 'thu thiem lien phuong', 'Quận 9', 'lap ML', '', 'Điện Lạnh', '2020-11-16 - Old', 0, NULL, 'Trần Mạnh', 'khong', NULL),
(788, '', '0906571077', '393/6 tran hung dao', 'Quận 1', 'lap ML', 'Chup anh, quay clip gui Mr hau', 'Điện Lạnh', '2020-11-16 - Old', 1, NULL, 'Trần Mạnh', '', NULL),
(789, 'c nga', '0903852173', '11/5 huynh thi hai', 'Quận 12', 'Vệ Sinh máy lạnh', 'Chup anh, quay clip gui Mr hau', 'Điện Lạnh', '2020-11-16 - Old', 0, NULL, 'Trần Mạnh', 'khong', NULL),
(790, 'a phat', '0937903235', '109/1/10 khu pho 3, linh tay', 'Thủ Đức', 'doi cuc lanh', 'Chup anh, quay clip gui Mr hau', 'Điện Lạnh', '2020-11-16 - Old', 0, NULL, 'Trần Mạnh', 'khong', NULL),
(791, 'trung	', '786584663', '66/32 tran dai nghia, tan tao A', 'Bình Tân', 'son	 giuong fo', 'Chup anh, quay clip gui Mr hau', 'Đồ Gỗ', '2020-11-16 - Old', 1, NULL, 'Trần Mạnh', 'Thợ Phụ co', NULL),
(792, '', '012345678', '456 trần não', 'Quận 2', 'sửa ống nước', 'sửa ống nước1', 'Điện Nước', '2020-11-16 - Old', 1, NULL, 'Admin', '', NULL),
(793, '', '09476123983', '456 trần não', 'Quận 2', 'sửa ống nước', 'sửa ống nước', 'Điện Nước', '2020-11-16 - Old', 1, NULL, 'Admin', 'Thợ Phụ 1', NULL),
(794, 'kh1', '09476123989', '6 trần não', 'Quận 2', '12', '', 'Điện Nước', '2020-11-16', 1, NULL, 'Admin', 'Thợ Phụ 1', NULL),
(795, ' ', '908197779', '31/7 út Tich', 'tb', 'chống hôi1', 'chụp ảnh , quay clip gửi mr Hậu', 'Điện Nước', '2020-11-16', 1, NULL, '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `info_worker`
--

CREATE TABLE `info_worker` (
  `id_worker` int(10) NOT NULL,
  `name_worker` varchar(255) NOT NULL,
  `ho_worker` varchar(100) DEFAULT NULL,
  `add_worker` varchar(255) DEFAULT NULL,
  `phone_cty` varchar(12) DEFAULT NULL,
  `phone_worker` varchar(12) DEFAULT NULL,
  `kind_worker` varchar(10) DEFAULT NULL,
  `status_worker` tinyint(1) DEFAULT NULL,
  `cap_tho` varchar(50) DEFAULT NULL,
  `today_off` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `info_worker`
--

INSERT INTO `info_worker` (`id_worker`, `name_worker`, `ho_worker`, `add_worker`, `phone_cty`, `phone_worker`, `kind_worker`, `status_worker`, `cap_tho`, `today_off`) VALUES
(1, 'Có', 'Lê Xuân ', 'Quận 12', '919839118', '982260718', 'Điện Nước', 0, 'Chuyên gia cao cấp', 0),
(2, 'Hậu', 'Nguyễn Thuần', 'Gò Vấp', '1233797788', '974095170', 'Điện Lạnh', 0, 'Chuyên gia cao cấp', 0),
(3, 'Quận', 'Hoàng Văn', 'Thủ Đức', '918067918', '902465032', 'Điện Nước', 0, NULL, 0),
(4, 'Nhật', 'Lê Minh', 'Gò Vấp', '969301494', '919128918', 'Điện Nước', 0, NULL, 0),
(5, 'Thắng', 'Phan Công', 'Thủ Đức', '913591918', '928046870', 'Điện Nước', 0, NULL, 0),
(6, 'Hào', 'Phạm Văn', 'Thủ Đức', '916812918', '1629181646', 'Điện Nước', 0, '', 0),
(7, 'Ký', 'Trần Hưng', 'Gò Vấp', '918494218', NULL, 'Điện Nước', 0, NULL, 0),
(8, 'Xuân', 'Phùng Tấn', 'Gò Vấp', '916531918', '906570967', 'Điện Lạnh', 0, NULL, 0),
(9, 'Cường', 'Phạm Huy', 'Quận 11', '916972639', '931420156', 'Điện Lạnh', 0, NULL, 0),
(10, 'Thông', 'Ngô Văn', 'Gò Vấp', '915456938', '919128918', 'Điện Nước', 0, NULL, 0),
(11, 'Trọng', 'Nguyễn Đức', 'Quận 9', '916233918', NULL, 'Điện Nước', 0, NULL, 0),
(12, 'Tâm', 'Lê Thanh', 'Bình Tân', '915398138', NULL, 'Điện Nước', 0, NULL, 0),
(13, 'Khanh', 'Lê Tấn ', 'Thủ Đức', '914480718', NULL, 'Điện Nước', 0, NULL, 0),
(14, 'Cường', 'Thái Mạnh ', 'Gò Vấp', '918911318', NULL, 'Điện Nước', 0, NULL, 0),
(16, 'Thái', 'Dương Văn ', 'Bình Tân', '917139418', NULL, 'Điện Nước', 0, NULL, 0),
(17, 'Hưng', 'Đặng Hồng ', 'Quận 2', '918583318', NULL, 'Điện Nước', 0, NULL, 0),
(18, 'Hồng', 'Nguyễn Tô ', 'Gò Vấp', '917590138', NULL, 'Điện Lạnh', 0, NULL, 0),
(19, 'Nin', 'Nguyễn Văn ', 'Quận 12', '917841218', NULL, 'Điện Nước', 0, NULL, 0),
(20, 'Minh', 'Nguyễn Thế ', 'Quận 12', '888717739', NULL, 'Điện Nước', 0, NULL, 0),
(21, 'Nhạc', 'Trần Văn ', 'Thủ Đức', '912071938', NULL, 'Điện Nước', 0, NULL, 0),
(22, 'Thành', 'Vũ Ngọc ', 'Quận 7', '917502938', NULL, 'Điện Nước', 0, NULL, 0),
(23, 'Bảo', 'Bùi Văn ', 'Gò Vấp', '913673918', NULL, 'Điện Nước', 0, NULL, 1),
(24, ' Vĩ', 'Lê Phước', 'Quận 12', '914692418', '989477567', 'Điện Nước', 1, NULL, 1),
(25, 'Thành', 'Nguyễn Tuấn ', 'Gò Vấp', '917590138', '989893727', 'Thợ Mộc', 0, NULL, 0),
(26, 'Cường', 'Nguyễn Đức ', 'Thủ Đức', '913591918', '928046870', 'Điện Nước', 0, '', 0),
(27, 'Ngọc', 'Cái ', 'Thủ Đức', '911529639', NULL, 'Điện Nước', 0, NULL, 0),
(28, 'Nhân', 'Võ Tòng ', 'Gò Vấp', '888916039', '1634380021', 'Điện Nước', 0, NULL, 0),
(29, 'Linh', 'Lê Nhật ', 'Thủ Đức', '918795938', '943037629', 'Điện Lạnh', 0, NULL, 0),
(30, 'Sơn', 'Nguyễn Văn ', 'Quận 12', '915673118', '1677178619', 'Điện Nước', 0, '', 0),
(31, 'Hải', 'Lê ', 'Đồng Nai', '888921039', NULL, 'Điện Nước', 0, NULL, 0),
(32, 'Cảnh', 'Nguyễn Văn ', 'Gò Vấp', '888243138', '965094152', 'Điện Nước', 0, NULL, 0),
(33, 'Công', 'Lê Chí ', 'Thủ Đức', '888702639', '969914677', 'Điện Nước', 0, '', 0),
(34, 'Hùng', 'Hồ Quốc ', 'Gò Vấp', '912279018', '914747743', 'Điện Nước', 0, NULL, 0),
(35, 'Huy', 'Nguyễn Quốc ', 'Gò Vấp', '888287739', NULL, 'Điện Nước', 0, NULL, 0),
(36, 'Nghĩa', 'Trần Công ', 'Bình Tân', '888124739', NULL, 'Điện Nước', 0, NULL, 0),
(37, 'Trường', 'Lê Nhựt ', 'Quận 9', '914835939', '974402461', 'Điện Lạnh', 0, '', 0),
(39, 'SơnTD', 'Nguyễn Văn ', 'Thủ Đức', '913317918', '908227373', 'Điện Nước', 0, '', 0),
(40, 'Học', 'Cao Văn Học', 'Bình Tân', '888405138', '933173177', 'Điện Nước', 0, NULL, 0),
(41, 'Thọ', 'Nguyễn Văn ', 'Quận 12', '88837073', '908576200', 'Thợ Mộc', 0, NULL, 0),
(42, 'Giang', 'Nguyễn Trường ', 'Thủ Đức', '888230138', '389743575', 'Điện Nước', 0, NULL, 0),
(43, 'Ngọc', 'Nguyễn Trọng ', 'Thủ Đức', '888670138', '974869133', 'Điện Nước', 0, NULL, 0),
(44, 'Cường', 'Bùi Xuân ', 'Thủ Đức', '888045138', '961076437', 'Điện Nước', 0, NULL, 0),
(45, 'Thắng', 'Hoàng Hữu ', 'Thủ Đức', '915074718', '363807117', 'Điện Nước', 0, NULL, 0),
(46, 'Tới', 'Đàng Văn ', 'Thủ Đức', '888753739', '902508127', 'Điện Nước', 0, NULL, 0),
(47, 'Triệt', 'Hồ Văn ', 'Thủ Đức', '912464638', '', 'Điện ', 0, '', 0),
(48, 'Ái', 'Lê Thân ', 'Thủ Đức', '888732539', '973855481', 'Điện Lạnh', 1, '', 0),
(49, 'Đạt', 'Hồ Văn Quốc ', 'Thủ Đức', '918067918', '935327421', 'Điện Nước', 0, NULL, 0),
(50, 'Thái', 'Nguyễn Quốc Thái', 'Gò Vấp', '888916739', '707628873', 'Điện Nước', 0, NULL, 0),
(51, 'Trung', 'Trần Văn ', 'Thủ Đức', NULL, '898194622', 'Điện Nước', 0, NULL, 0),
(52, 'Hoài', 'Lê Thanh ', 'Bình Tân', '', '342606247', 'Điện Nước', 0, '', 0),
(53, 'Tấn', 'Nguyễn Minh ', 'Quận 7', '888045939', '906930195', 'Điện Nước', 0, NULL, 0),
(54, 'Đại', 'Vân Duy ', 'Bình Tân', '888715138', '968459859', 'Điện Nước', 0, NULL, 0),
(55, 'Thời', 'Cao Văn ', 'Gò vấp', '888037639', '987054074', 'Điện Nước', 0, NULL, 0),
(56, 'Linh', 'Lê Phú ', 'Thủ Đức', NULL, '396935217', 'Điện Nước', 0, NULL, 0),
(57, 'Tường', 'Võ Văn ', 'Thủ Đức', NULL, '379342423', 'Điện Nước', 0, NULL, 0),
(58, 'Tịch', 'Trần Quốc ', 'Thủ Đức', NULL, '974968744', 'Điện Lạnh', 0, NULL, 0),
(59, 'Quảng', 'Nguyễn Tiến ', 'Thủ Đức', NULL, '967472104', 'Điện Nước', 0, NULL, 0),
(60, 'Tam', 'Lê Quang ', 'Quận 12', '918155938', '838501434', 'Điện Nước', 0, NULL, 0),
(61, 'Tiền', 'Lê Thành ', 'Bình Tân', '919839118', '982260718', 'Điện Nước', 0, '', 0),
(62, 'Hưng', 'Nguyễn Thanh ', 'Quận 12', '916812918', '965809006', 'Điện Nước', 0, NULL, 0),
(63, 'Dũng', 'Lê Ngọc', 'Thủ Đức', '888532138', '987940006', 'Điện Nước', 0, NULL, 0),
(64, 'Lộc', 'Nguyễn Tấn ', 'Bình Thạnh', '888058139', '908745439', 'Điện Nước', 0, NULL, 0),
(65, 'Cảo', 'Trượng Văn  ', 'Thủ Đức', '915269839', '928046870', 'Đã Sửa', 0, 'Thợ Phụ', 0),
(66, 'Hiệp', 'Nguyễn Thanh ', 'Quận 7', '919625938', NULL, 'Điện Nước', 0, NULL, 0),
(67, 'Thuyết', 'Đặng Văn ', 'Quận 2', '913872318', NULL, 'Điện Nước', 0, NULL, 0),
(68, 'Tới', 'Vũ Văn ', 'Quận 8', '888702639', NULL, 'Điện Lạnh', 0, NULL, 0),
(91, 'Anh Trí', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_type` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`login_details_id`, `user_id`, `last_activity`, `is_type`) VALUES
(14, 8, '2019-07-05 05:09:00', 'no'),
(15, 1, '2019-07-05 06:24:13', 'no'),
(16, 2, '2019-07-05 06:31:11', 'no'),
(17, 1, '2019-07-06 02:06:17', 'no'),
(18, 2, '2019-07-06 00:37:23', 'no'),
(19, 4, '2019-07-06 01:12:47', 'no'),
(20, 1, '2019-07-06 01:45:11', 'no'),
(21, 8, '2019-07-06 01:57:21', 'no'),
(22, 6, '2019-07-06 01:59:43', 'no'),
(23, 2, '2019-07-06 05:13:55', 'no'),
(24, 1, '2019-07-06 10:04:14', 'no'),
(25, 4, '2019-07-06 06:36:34', 'no'),
(26, 6, '2019-07-06 05:11:09', 'no'),
(27, 1, '2019-07-07 00:54:44', 'no'),
(28, 3, '2019-07-07 14:47:41', 'no'),
(29, 1, '2019-07-08 00:02:10', 'no'),
(30, 2, '2019-07-08 00:09:55', 'no'),
(31, 7, '2019-07-08 00:36:56', 'no'),
(32, 1, '2019-07-08 00:40:30', 'no'),
(33, 1, '2020-08-27 01:52:06', 'no'),
(34, 3, '2020-11-09 01:06:24', 'no'),
(35, 3, '2020-11-09 02:41:20', 'no'),
(36, 3, '2020-11-09 03:19:54', 'no'),
(37, 3, '2020-11-09 03:27:53', 'no'),
(38, 3, '2020-11-10 00:13:16', 'no'),
(39, 3, '2020-11-10 00:15:12', 'no'),
(40, 3, '2020-11-10 01:38:13', 'no'),
(41, 3, '2020-11-10 02:23:29', 'no'),
(42, 3, '2020-11-10 03:57:34', 'no'),
(43, 3, '2020-11-10 06:33:56', 'no'),
(44, 3, '2020-11-10 10:12:32', 'no'),
(45, 3, '2020-11-11 00:07:05', 'no'),
(46, 3, '2020-11-11 00:07:59', 'no'),
(47, 3, '2020-11-12 00:06:00', 'no'),
(48, 3, '2020-11-12 01:16:11', 'no'),
(49, 3, '2020-11-12 07:53:23', 'no'),
(50, 3, '2020-11-12 07:54:06', 'no'),
(51, 3, '2020-11-13 00:32:21', 'no'),
(52, 3, '2020-11-13 00:43:43', 'no'),
(53, 3, '2020-11-14 01:25:25', 'no'),
(54, 3, '2020-11-14 02:35:48', 'no'),
(55, 3, '2020-11-16 06:05:19', 'no'),
(56, 3, '2020-11-16 06:06:21', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `notication`
--

CREATE TABLE `notication` (
  `id_noti` int(10) NOT NULL,
  `info_noti` varchar(500) NOT NULL,
  `date_noti` varchar(20) NOT NULL,
  `nv_add` varchar(200) NOT NULL,
  `nv_noti` varchar(1000) NOT NULL,
  `status_ad` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `real_name` varchar(255) DEFAULT NULL,
  `contact_number` varchar(64) NOT NULL,
  `addressNV` text DEFAULT NULL,
  `password` varchar(512) NOT NULL,
  `level` tinyint(1) NOT NULL,
  `ava_img` longtext DEFAULT NULL,
  `name_permisstion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='admin and customer users';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `real_name`, `contact_number`, `addressNV`, `password`, `level`, `ava_img`, `name_permisstion`) VALUES
(1, 'manh', 'Trần Mạnh', '914431138', '', '$2y$10$JdsW7/GdInb33vWm/SeT9eN7.WJExqfYmagrS2AnvRehUAfPrE0.u', 1, 'avatar.png', 'Admin'),
(2, 'haunguyen', 'Hậu Nguyễn', '91443113', '', '$2y$10$JdsW7/GdInb33vWm/SeT9eN7.WJExqfYmagrS2AnvRehUAfPrE0.u', 1, 'avatar.png', NULL),
(3, 'admin', 'Admin ', '', '', '$2y$10$JdsW7/GdInb33vWm/SeT9eN7.WJExqfYmagrS2AnvRehUAfPrE0.u', 1, 'avatar.png', NULL),
(4, 'thongngo', 'Thông Ngô', '914431138', NULL, '$2y$10$JdsW7/GdInb33vWm/SeT9eN7.WJExqfYmagrS2AnvRehUAfPrE0.u', 0, NULL, NULL),
(5, 'nhuluong', 'Như Lương', '923330', NULL, '$2y$10$JdsW7/GdInb33vWm/SeT9eN7.WJExqfYmagrS2AnvRehUAfPrE0.u', 1, NULL, NULL),
(6, 'kiettrinh', 'Kiệt Trinh', '0374882814', '61/36/42E Tổ 2, Ấp 6, Đông Thạnh, Hóc Môn', '$2y$10$GudAtoodzP.4uZsHECjlUO5mHBAN.x7RZ2YN7S32dIhZlFRhpa9va', 0, 'avatar.png', NULL),
(7, 'huyluong', 'Huy Lương', '923330', NULL, '$2y$10$JdsW7/GdInb33vWm/SeT9eN7.WJExqfYmagrS2AnvRehUAfPrE0.u', 0, NULL, NULL),
(8, 'haupham', 'Phạm Hậu', '12321321', '', '$2y$10$JdsW7/GdInb33vWm/SeT9eN7.WJExqfYmagrS2AnvRehUAfPrE0.u', 1, 'avatar.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vsbn`
--

CREATE TABLE `vsbn` (
  `id_vsbn` int(11) NOT NULL,
  `name_vsbn` varchar(200) NOT NULL,
  `add_vsbn` int(200) NOT NULL,
  `team_vsbn` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `work_do`
--

CREATE TABLE `work_do` (
  `id_work` int(10) NOT NULL,
  `id_cus` int(10) NOT NULL,
  `id_worker` int(10) NOT NULL,
  `sum_chi` varchar(10) NOT NULL,
  `sum_thu` varchar(10) NOT NULL,
  `date_done` varchar(20) NOT NULL,
  `note_work` varchar(500) DEFAULT NULL,
  `thanh_toan` tinyint(1) NOT NULL DEFAULT 0,
  `nv_phan` varchar(100) NOT NULL,
  `thongtinthem` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `work_do`
--

INSERT INTO `work_do` (`id_work`, `id_cus`, `id_worker`, `sum_chi`, `sum_thu`, `date_done`, `note_work`, `thanh_toan`, `nv_phan`, `thongtinthem`) VALUES
(17, 749, 91, '0', '0', '2020-11-16', '', 1, 'Admin', NULL),
(18, 752, 1, '0', '0', '2019-07-07', NULL, 0, 'Admin', NULL),
(19, 769, 8, '0', '0', '2019-07-08', NULL, 0, 'Hậu Nguyễn', NULL),
(23, 770, 32, '0', '0', '2020-11-12', NULL, 0, 'Admin', NULL),
(24, 774, 32, '0', '0', '2020-11-12', NULL, 0, 'Admin', NULL),
(25, 791, 32, '0', '0', '2020-11-12', NULL, 0, 'Admin', NULL),
(31, 730, 32, '0', '0', '2020-11-13', NULL, 0, 'Admin ', NULL),
(32, 732, 32, '0', '0', '2020-11-14', NULL, 0, 'Admin ', NULL),
(34, 794, 32, '4,555,555', '4,544,411', '2020-11-16', '', 0, 'Admin ', NULL),
(35, 793, 32, '250,000', '3,000,000', '2020-11-16', '', 0, 'Admin ', NULL),
(36, 792, 32, '0', '1', '2020-11-16', '', 0, 'Admin ', NULL),
(47, 795, 32, '0', '0', '2020-11-16', NULL, 0, 'Admin ', NULL),
(48, 786, 32, '0', '0', '2020-11-16', NULL, 0, 'Admin ', NULL),
(49, 785, 32, '0', '0', '2020-11-16', NULL, 0, 'Admin ', NULL),
(50, 783, 32, '0', '0', '2020-11-16', NULL, 0, 'Admin ', NULL),
(51, 782, 32, '0', '0', '2020-11-16', NULL, 0, 'Admin ', NULL),
(52, 781, 32, '0', '0', '2020-11-16', NULL, 0, 'Admin ', NULL),
(53, 753, 32, '0', '0', '2020-11-16', NULL, 0, 'Admin ', NULL),
(54, 749, 32, '0', '0', '2020-11-16', NULL, 0, 'Admin ', NULL),
(55, 750, 32, '0', '0', '2020-11-16', NULL, 0, 'Admin ', NULL),
(56, 757, 32, '0', '0', '2020-11-16', NULL, 0, 'Admin ', NULL),
(57, 788, 32, '0', '0', '2020-11-16', NULL, 0, 'Admin ', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `info_cus`
--
ALTER TABLE `info_cus`
  ADD PRIMARY KEY (`id_cus`),
  ADD KEY `id_cus` (`id_cus`);

--
-- Indexes for table `info_worker`
--
ALTER TABLE `info_worker`
  ADD PRIMARY KEY (`id_worker`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- Indexes for table `notication`
--
ALTER TABLE `notication`
  ADD PRIMARY KEY (`id_noti`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsbn`
--
ALTER TABLE `vsbn`
  ADD PRIMARY KEY (`id_vsbn`);

--
-- Indexes for table `work_do`
--
ALTER TABLE `work_do`
  ADD PRIMARY KEY (`id_work`),
  ADD KEY `id_work` (`id_work`,`id_cus`,`id_worker`),
  ADD KEY `id_cus` (`id_cus`),
  ADD KEY `id_worker` (`id_worker`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `info_cus`
--
ALTER TABLE `info_cus`
  MODIFY `id_cus` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=797;

--
-- AUTO_INCREMENT for table `info_worker`
--
ALTER TABLE `info_worker`
  MODIFY `id_worker` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `notication`
--
ALTER TABLE `notication`
  MODIFY `id_noti` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vsbn`
--
ALTER TABLE `vsbn`
  MODIFY `id_vsbn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `work_do`
--
ALTER TABLE `work_do`
  MODIFY `id_work` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `work_do`
--
ALTER TABLE `work_do`
  ADD CONSTRAINT `work_do_ibfk_1` FOREIGN KEY (`id_cus`) REFERENCES `info_cus` (`id_cus`),
  ADD CONSTRAINT `work_do_ibfk_2` FOREIGN KEY (`id_worker`) REFERENCES `info_worker` (`id_worker`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
