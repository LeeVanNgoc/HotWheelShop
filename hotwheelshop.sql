-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 12, 2025 lúc 02:24 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `hotwheelshop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `product` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`cart_id`, `user`, `price`, `product`, `qty`, `created_at`) VALUES
(7, 6, '59000', 3, 1, '2025-01-12 13:18:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_user` int(11) NOT NULL,
  `description` text NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_user`, `description`, `active`, `created_at`) VALUES
(2, 'New Models', 6, 'Phiên bản mới nhất', 1, '2025-01-12 07:51:18'),
(3, 'Teams ', 6, 'Một dòng xe được sản xuất theo nhóm, mỗi nhóm có những đặc điểm khác nhau', 1, '2025-01-12 07:51:55'),
(4, 'Track ', 6, 'Dòng xe chủ yếu cho những đường đua', 1, '2025-01-12 07:52:23'),
(5, 'Treasure ', 6, 'Dòng xe này cực kỳ hiếm thấy, thường để sưu tầm.', 1, '2025-01-12 07:53:06'),
(6, 'Event', 6, 'Các loại xe được thiết kế cho các sự kiện đặc biệt', 0, '2025-01-12 07:54:06'),
(7, 'Basic', 6, 'Thể loại xe thường thấy', 0, '2025-01-12 08:03:46'),
(8, 'Premium', 6, 'Thể loại xe đặc biệt và giới hạn                                    ', 0, '2025-01-12 08:04:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `c_order`
--

CREATE TABLE `c_order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `order_total` varchar(255) NOT NULL,
  `order_status` tinyint(2) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `c_order`
--

INSERT INTO `c_order` (`order_id`, `customer_id`, `shipping_id`, `payment_id`, `order_total`, `order_status`, `created_at`) VALUES
(3, 6, 4, 3, '656', 1, '2024-12-19 07:22:54'),
(4, 6, 5, 4, '590000', 1, '2025-01-12 08:36:31'),
(5, 6, 6, 5, '545000', 1, '2025-01-12 08:37:19'),
(6, 6, 7, 6, '693000', 0, '2025-01-12 08:37:36'),
(7, 6, 8, 7, '952000', 0, '2025-01-12 08:37:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `c_order_details`
--

CREATE TABLE `c_order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_qty` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

--
-- Đang đổ dữ liệu cho bảng `c_order_details`
--

INSERT INTO `c_order_details` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `product_qty`, `user`, `created_at`) VALUES
(2, 4, 3, 'Honda S800 Racing', '59000', '10', 6, '2025-01-12 08:36:31'),
(3, 5, 7, 'Tred Shredder', '109000', '5', 6, '2025-01-12 08:37:19'),
(4, 6, 11, '17 Ford GT', '99000', '7', 6, '2025-01-12 08:37:36'),
(5, 7, 12, 'LB-Silhouette WORKS GT Nissan 35GT-RR VER.2', '119000', '8', 6, '2025-01-12 08:37:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gallary`
--

CREATE TABLE `gallary` (
  `gallary_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manufactures`
--

CREATE TABLE `manufactures` (
  `man_id` int(11) NOT NULL,
  `man_name` varchar(255) NOT NULL,
  `man_user` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `brand` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `manufactures`
--

INSERT INTO `manufactures` (`man_id`, `man_name`, `man_user`, `active`, `description`, `created_at`, `brand`, `image`) VALUES
(9, 'Honda', 6, 1, 'Nhà sản sản xuất đến từ Nhật Bản', '2025-01-12 07:37:27', 'Honda', 'Honda_Logo.svg1736667447.png'),
(10, 'Aston Martin', 6, 1, 'Nhà sản xuất đến từ vương quốc Anh', '2025-01-12 07:41:20', 'Aston Martin', 'aston-martin-1-logo-png-transparent1736667680.png'),
(11, 'Chevrolet', 6, 1, 'Nhà sản xuất đến từ Mỹ', '2025-01-12 07:42:03', 'Chevrolet', 'Chevrolet-logo1736667723.png'),
(12, 'Lamborghini', 6, 1, 'Hãng xe sang đến từ Ý', '2025-01-12 07:44:02', 'Lamborghini', 'images1736667842.png'),
(13, 'Ford', 6, 1, 'Hãng xe đến từ Mỹ', '2025-01-12 07:44:42', 'Ford', 'Ford_logo_flat.svg1736667882.png'),
(14, 'Nissan', 6, 1, 'Hãng xe đến từ Nhật', '2025-01-12 07:46:17', 'Nissan', 'logo1736667977.png'),
(15, 'Mclaren', 6, 1, 'Hãng xe đến từ nước Anh', '2025-01-12 07:47:23', 'Mclaren', 'pngimg.com - Mclaren_PNG21736668043.png'),
(16, 'Mazda', 6, 1, 'Hãng xe đến từ Nhật Bản', '2025-01-12 07:48:06', 'Mazda', 'Mazda-Logo1736668086.png'),
(17, 'Hot Wheels', 6, 0, 'Nhà phân phối chính', '2025-01-12 08:11:13', 'Hot Wheels', 'images (1)1736669473.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment`
--

CREATE TABLE `payment` (
  `Payment_id` int(11) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_status` tinyint(2) NOT NULL DEFAULT 0,
  `payment_shipping` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `payment`
--

INSERT INTO `payment` (`Payment_id`, `payment_method`, `payment_status`, `payment_shipping`, `created_at`) VALUES
(1, 'cash', 0, 2, '2019-04-28 11:33:30'),
(2, 'cash', 0, 3, '2019-05-18 08:22:07'),
(3, 'cash', 0, 4, '2024-12-19 07:22:54'),
(4, 'cash', 0, 5, '2025-01-12 08:36:31'),
(5, 'cash', 0, 6, '2025-01-12 08:37:19'),
(6, 'cash', 0, 7, '2025-01-12 08:37:36'),
(7, 'cash', 0, 8, '2025-01-12 08:37:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `cat` int(11) NOT NULL,
  `man` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `active` tinyint(2) NOT NULL DEFAULT 0,
  `image` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `cat`, `man`, `user`, `active`, `image`, `color`, `size`, `price`, `created_at`) VALUES
(3, 'Honda S800 Racing', 'Honda S800 là một chiếc xe thể thao 2 cửa được sản xuất năm 1966 đến 1970, để thay thế chiếc S600. Với động cơ 0.8L I4 và 9500 rpm, hộp số 4 số, nó có tên gọi là chiếc xe phân hạng 1L nhanh nhất thế giới', 4, 9, 6, 1, 's-l4001736669009.jpg', 'Yellow', '20', 59000, '2025-01-12 08:03:29'),
(4, 'Aston Martin DB4GT High-Speed Edition', 'Aston Martin DB4GT High-Speed Edition\r\n', 2, 10, 6, 1, 'images1736669236.jpg', 'Silver White ', '40', 59000, '2025-01-12 08:07:16'),
(5, '59 Chevy Impala (Treasure Hunt)', 'Đời thứ 2 của dòng Chevrolet Impala, sản xuất vỏn vẹn trong 1 năm (1959 - 1960), chiếc xe này là 1 gương mặt quen thuộc trong giới lowrider - giới xe Mỹ độ hạ gầm. Tồn tại dưới dạng 2 hoặc 4 cửa, động cơ I6 hoặc V8 và kiểu dáng đặc trưng với đèn hậu thiết kế theo hình giọt nước, đây là chiếc xe không thể thiếu trong bộ sưu tập của người chơi xe cổ.\r\n', 8, 11, 6, 1, 'maxresdefault1736669334.jpg', 'Silver Black', '40', 89000, '2025-01-12 08:08:54'),
(6, 'Roll Cage', 'Roll Cage là một chiếc xe do chính Hot Wheels thiết kế. Với ý tưởng chinh phục những bãi cát trên sa mạc hay địa hình hiểm trở trên núi, họ đã tạo nên một con xe có thiết kế chỉ có khung không có tấm chắn bảo vệ. Mặc dù khi lái có thể gây cảm giác khó chịu vì bụi, cát nhưng chiếc xe này là người bạn hoàn hảo khi bạn muốn tham gia vào những trò mạo hiểm.\r\n', 7, 17, 6, 1, 'images (1)1736669421.jpg', 'Yellow', '40', 49000, '2025-01-12 08:10:21'),
(7, 'Tred Shredder', 'Sự thay thế của Gallardo, một con xe mà từ triệu phú tới tỷ phú ai cũng phải có, Huracán mang trong mình hình tượng kinh điển của Lamborghini cũng nhưng những cải tiến mới nhất về mặt thiết kế cũng như là hiệu năng. Mang trong mình động cơ 5.2L CSJ V10 với 612 mã lực, và giờ với bản đặc biệt Super Trofeo chuyên về đua xe, chiếc xe này hiện tại là gương mặt tiêu biểu của Lamborghini trong các giải đấu. \r\n', 5, 12, 6, 1, 'lamborghini-huracan_lp620-2_super_trofeo_2015_1_5269_20871736669564.jpg', 'Grey', '40', 109000, '2025-01-12 08:12:44'),
(8, 'Lamborghini Huracán LP 620-2 Super Trofeo (Super Treasure Hunt)', 'Sự thay thế của Gallardo, một con xe mà từ triệu phú tới tỷ phú ai cũng phải có, Huracán mang trong mình hình tượng kinh điển của Lamborghini cũng nhưng những cải tiến mới nhất về mặt thiết kế cũng như là hiệu năng. Mang trong mình động cơ 5.2L CSJ V10 với 612 mã lực, và giờ với bản đặc biệt Super Trofeo chuyên về đua xe, chiếc xe này hiện tại là gương mặt tiêu biểu của Lamborghini trong các giải đấu. ', 4, 12, 6, 1, '$_571736669639.jpg', 'Red', '40', 1500000, '2025-01-12 08:13:59'),
(9, 'Mazda RX7', 'Cùng với R34 của Nissan và Supra của Toyota, dòng RX của Mazda cũng là một trong những cái tên không thể không nhắc tới khi nói đến JDM (Japanese Domestic Market). Với động cơ Rotary 13B có thiết kế độc lạ nhất, sản sinh ra 276 mã lực, RX7 đã làm mưa làm gió giới JDM cho tới tận bây giờ, đủ để chứng minh nó xứng đáng được gọi là \"huyền thoại\" khi được xuất hiện trong nhiều bộ phim đình đám về đua xe như Initial D hay Fast and Furious.', 3, 16, 6, 1, 'images (2)1736669696.jpg', 'Red', '40', 99000, '2025-01-12 08:14:56'),
(10, 'McLaren P1', 'Chiếc P1 được sinh ra để kế thừa và phát huy truyền thống của huyền thoại McLaren F1: nhanh, chính xác và rất bắt mắt, và chiếc xe này đã làm nhiều hơn thế. Với thiết kế mềm mại và mượt, và động cơ 3.8L McLaren M838TQ twin-turbo V8 và động cơ điện riêng biệt đồng thời sản sinh ra 903 mã lực, chiếc xe này vừa mang trong mình khả năng của một chiếc xe đua F1 thực sự, và cũng mang trong mình độ hiếm của nó khi số lượng sản xuất chỉ vỏn vẹn 375 chiếc toàn thế giới', 8, 15, 6, 1, 'vn-11134207-7r98o-ly57fimnyisha41736669771.jpg', 'Blue', '40', 99000, '2025-01-12 08:16:11'),
(11, '17 Ford GT', 'Đời thứ 2 của dòng Ford GT, được vén màn tại buổi triển lãm North American Auto Show cùng với game đình đám Forza Motorsport, chiếc xe hứa hẹn sẽ tiếp nối truyền thống siêu xe duy nhất của Ford. Và với động cơ 3.5L Ecoboost D35 V6 sản sinh ra 647 mã lực và mới đây được nâng cấp lên 660, chiếc xe này đúng xứng đáng với cái tên của nó.', 2, 13, 6, 1, 'hq7201736669856.jpg', 'White', '40', 99000, '2025-01-12 08:17:36'),
(12, 'LB-Silhouette WORKS GT Nissan 35GT-RR VER.2', 'Sự kết hợp giữa 2 thế lực lớn nhất thế giới trong ngành của họ: Liberty Walk với các mẫu body kit hùng hổ, chất lượng và Nissan với mẫu xe R35, hậu thân của mẫu R34 nổi tiếng, và chính nó cũng nổi tiếng không kém. Sự kết hợp này đem lại cho chúng ta một con xe với từ duy nhất để miêu tả nó là một \"kiệt tác nghệ thuật\" của tốc độ và phong cách. ', 4, 14, 6, 1, 'hq720 (1)1736669911.jpg', 'White', '40', 119000, '2025-01-12 08:18:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shipping`
--

CREATE TABLE `shipping` (
  `shipping_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `shipping`
--

INSERT INTO `shipping` (`shipping_id`, `full_name`, `email`, `mobile`, `address`, `city`, `created_at`) VALUES
(1, 'ibrahim elgadid', 'ibrahimelgadid30@gmail.com', '00102 487 6339', 'elsalam', 'kafr sqr', '2019-04-28 11:19:46'),
(2, 'ibrahim elgadid', 'ibrahimelgadid30@gmail.com', '00102 487 6339', 'elsalam', 'kafr sqr', '2019-04-28 11:33:30'),
(3, 'ibrahim elgadid', 'will123@gmail.com', '01024876339', 'elsalam', 'ÙƒÙØ± ØµÙ‚Ø±', '2019-05-18 08:22:06'),
(4, 'Aozama', 'lee.admin@gmail.com', '10985645342123', '1234 Hà Nội', '1', '2024-12-19 07:22:54'),
(5, 'Aozama', 'lee.admin@gmail.com', '10985645342123', '1234 Hà Nội', '1', '2025-01-12 08:36:31'),
(6, 'Aozama', 'lee.admin@gmail.com', '10985645342123', '1234 Hà Nội', '1', '2025-01-12 08:37:19'),
(7, 'Aozama', 'lee.admin@gmail.com', '10985645342123', '1234 Hà Nội', '1', '2025-01-12 08:37:36'),
(8, 'Aozama', 'lee.admin@gmail.com', '10985645342123', '1234 Hà Nội', '1', '2025-01-12 08:37:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `vkey` varchar(255) NOT NULL,
  `token_expire` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `verified` tinyint(4) NOT NULL DEFAULT 0,
  `admin` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `image`, `active`, `vkey`, `token_expire`, `verified`, `admin`, `created_at`) VALUES
(6, 'Mr Lee', 'lee.admin@gmail.com', '$2y$10$QvZRL7VHws14NQXcxSfPXu9hNhfWsoxr4iWkeyBimHsNXoTz5myQK', 'Cutoe-pegy1736579817.jpg', 1, 'c5d4a8674208e92466bea4efdb8a6175', '2025-01-11 07:40:30', 1, 1, '2024-12-14 14:11:37'),
(7, 'Ngọc', 'lee.admin1@gmail.com', '$2y$10$ZEAxjdPR7k.WzrKsn.nPk.5AQ1jpBVedV8xKbm55Ej6K8UUIO.k6m', '', 1, '', '2025-01-11 14:32:23', 0, 0, '2025-01-11 13:46:07'),
(9, 'Trang', 'dotrang@gmail.com', '$2y$10$sQtEqxYUPiFEnjeZNYDbV.M.Naeb1OvF5PZDMyeQ43nQCopdPu3v.', '', 1, '', '2025-01-12 07:57:41', 0, 1, '2025-01-12 07:57:39'),
(10, 'Hiếu', 'duyhieu@gmail.com', '$2y$10$nIxNXWbKwZ55caFHl0yY6eR/mrSTTa2qmpS4OcRUpu.in.mjzWpTW', '', 1, '', '2025-01-12 07:59:28', 0, 1, '2025-01-12 07:58:24'),
(11, 'Thắng', 'dangthang@gmail.com', '$2y$10$JO.nxSaViQCRL9qR8enuJe5/buXF2SQM9ss18bggIfpQw.Xo8IyEi', '', 1, '', '2025-01-12 07:59:30', 0, 1, '2025-01-12 07:58:38'),
(12, 'Sơn', 'hungson@gmail.com', '$2y$10$TVkl3dymZymACTIbfrq3L.0UWTwBSvNgdqmHKWl9bKVgG5juzZ0u.', '', 1, '', '2025-01-12 07:59:31', 0, 1, '2025-01-12 07:58:57'),
(13, 'Hoa', 'hoaviolet@gmail.com', '$2y$10$vCH7FEV5vyBvYm6jCE.siO//albYtre22lc3pIWUzc/FrF8RYAbRO', '', 1, '', '2025-01-12 07:59:31', 0, 1, '2025-01-12 07:59:26'),
(14, 'Đức', 'vanduc@gmail.com', '$2y$10$zXGFMTr8NvSpwAef3MoXR.482em/NSsHbzpARMNWdcL3y.DCIk/ZG', '', 1, '', '2025-01-12 07:59:51', 0, 1, '2025-01-12 07:59:48'),
(15, 'Loan', 'hoangloan@gmail.com', '$2y$10$ZefYwNTaXcSVJYpIftv6qul4./ZmI7xNLd1q9s6LhbQ3bRM0Q7klq', '', 0, '', '2025-01-12 08:00:07', 0, 1, '2025-01-12 08:00:07'),
(16, 'Thanh', 'vanthanh@gmail.com', '$2y$10$/LiDTM1w39w8NDCu7EZaYeyGuJSZHkg7uuShl5uVaFMQvzGcHFaaS', '', 0, '', '2025-01-12 08:00:40', 0, 1, '2025-01-12 08:00:40');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `cat_user` (`cat_user`);

--
-- Chỉ mục cho bảng `c_order`
--
ALTER TABLE `c_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `o_shipping` (`shipping_id`),
  ADD KEY `o_payment` (`payment_id`),
  ADD KEY `o_user` (`customer_id`);

--
-- Chỉ mục cho bảng `c_order_details`
--
ALTER TABLE `c_order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `d_order` (`order_id`),
  ADD KEY `d_product` (`product_id`);

--
-- Chỉ mục cho bảng `gallary`
--
ALTER TABLE `gallary`
  ADD PRIMARY KEY (`gallary_id`),
  ADD KEY `g_pro` (`product_id`);

--
-- Chỉ mục cho bảng `manufactures`
--
ALTER TABLE `manufactures`
  ADD PRIMARY KEY (`man_id`),
  ADD KEY `man_user` (`man_user`);

--
-- Chỉ mục cho bảng `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_id`),
  ADD KEY `pay_shipping` (`payment_shipping`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `p_user` (`user`),
  ADD KEY `p_man` (`man`),
  ADD KEY `p_cat` (`cat`);

--
-- Chỉ mục cho bảng `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `c_order`
--
ALTER TABLE `c_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `c_order_details`
--
ALTER TABLE `c_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `gallary`
--
ALTER TABLE `gallary`
  MODIFY `gallary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `manufactures`
--
ALTER TABLE `manufactures`
  MODIFY `man_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `cat_user` FOREIGN KEY (`cat_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `c_order`
--
ALTER TABLE `c_order`
  ADD CONSTRAINT `o_payment` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`Payment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `o_shipping` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`shipping_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `o_user` FOREIGN KEY (`customer_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `c_order_details`
--
ALTER TABLE `c_order_details`
  ADD CONSTRAINT `d_order` FOREIGN KEY (`order_id`) REFERENCES `c_order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `d_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `gallary`
--
ALTER TABLE `gallary`
  ADD CONSTRAINT `g_pro` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `manufactures`
--
ALTER TABLE `manufactures`
  ADD CONSTRAINT `man_user` FOREIGN KEY (`man_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `pay_shipping` FOREIGN KEY (`payment_shipping`) REFERENCES `shipping` (`shipping_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `p_cat` FOREIGN KEY (`cat`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `p_man` FOREIGN KEY (`man`) REFERENCES `manufactures` (`man_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `p_user` FOREIGN KEY (`user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
