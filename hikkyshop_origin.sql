-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th4 28, 2022 lúc 02:49 PM
-- Phiên bản máy phục vụ: 5.7.33
-- Phiên bản PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `hikkyshop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `position` int(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `photo`, `name`, `position`, `username`, `password`, `email`, `token`) VALUES
(1, NULL, 'Nguyễn Chí Tâm', 0, 'Hikky nè', 'superadmin', 'sieucapvjppro@pro.pro', 'Hikky nè_6263c2ec9aa352.51073502'),
(2, NULL, 'test', 0, 'test', 'test', 'test@test.com', 'test_626a8f008c05b6.49324059');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id`, `name`, `dob`, `email`, `phone`, `address`, `password`) VALUES
(1, 'Nguyễn Chí Tâm', '2003-06-29', 'ggraygon@gmail.com', 766614580, 'Đà Nẵng ', '1'),
(2, 'test1', '2022-04-01', 'test@test.com', 340502244, 'Đà Nẵng', 'sdaskdmaskdas');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manufacture`
--

CREATE TABLE `manufacture` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `datee` date NOT NULL,
  `note` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `manufacture`
--

INSERT INTO `manufacture` (`id`, `name`, `address`, `email`, `phone`, `datee`, `note`) VALUES
(53, 'Nike', 'Nike', 'ggay3@gmail.com', '076614503', '2022-01-11', 'sdsdsd'),
(54, 'Addidas', 'Addidas', 'ggay4@gmail.com', '076614504', '2022-01-11', 'sdsdsd'),
(56, 'Gucci', 'Gucci', 'ggay6@gmail.com', '076614506', '2022-01-11', 'Hàng Fha kê'),
(57, 'Gucci FhaKE', 'Gucci FhaKE', 'ggay7@gmail.com', '076614507', '2022-01-11', 'sdsdsd'),
(58, 'Bittis', 'Bittis', 'ggay8@gmail.com', '076614508', '2022-01-11', 'sdsdsd'),
(59, 'Local', 'America', 'ggayd@gmail.com', '076614509', '2022-01-11', 'sdsdsd'),
(63, 'Dép lào', 'Đà Nẵng', 'ggayg1@gmail.com', '0766145071', '2022-01-11', 'sdsdsd'),
(68, 'New Balance', 'New Balance', 'tabbnddc.21it@vku.udn.vn', '07896143480', '2022-04-11', 'hello'),
(70, 'Hàng china', 'Hàng china', 'china@china.com', '084332323', '2022-04-13', 'hello'),
(72, 'Blaenciaga', 'Blaenciaga', 'tattc.21it@vku.udn.vn', '056614580', '2022-04-13', 'hello'),
(75, 'Addidas Fhake', 'Addidas Fhake', 'hie2906@gmail.com', '0766614', '2022-04-14', 'fdfdfdf'),
(76, 'Germano Bellesi', 'Germano Bellesi', 'germanobellesi@bellesi.com', '076874580', '2022-04-17', 'ok');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `recipent_name` varchar(100) NOT NULL,
  `recipent_address` text NOT NULL,
  `recipent_phone` int(11) NOT NULL,
  `total_cost` double NOT NULL,
  `note` text NOT NULL,
  `status` int(2) NOT NULL,
  `time_order` datetime NOT NULL,
  `time_accept` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders_detail`
--

CREATE TABLE `orders_detail` (
  `product_id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text NOT NULL,
  `cost` double NOT NULL,
  `sold` int(11) DEFAULT '0',
  `manufacture_id` int(10) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `quantity`, `description`, `cost`, `sold`, `manufacture_id`, `type_id`, `date`) VALUES
(8, 'Giày Thể Thao Nam New Balance 5740 Classic', '1649996292.jpg', 23, 'Lấy cảm hứng từ phong cách \'80s-meets-\'90s, Giày Thể Thao Nam New Balance 57/40 Classic thiết kế dành cho những người không chỉ tìm kiếm sự thoải mái và còn mong muốn một vẻ ngoài thật cuốn hút. Chất liệu da lộn kết hợp mũ lưới pha trộn những gam màu đương đại mới lạ, kiểu dáng cổ điển vượt thời gian mang đến sự cân bằng hoàn hảo giữa thời trang và phong cách cá nhân, là sự bổ sung tuyệt vời cho tủ đồ hàng ngày của bạn.', 10000000, 0, 68, 1, NULL),
(10, 'Adidas Men\'s Drogo M Running Shoes', '1650007682.png', 10, 'Đến từ thương hiệu giày dép sức khỏe Aetrex của Mỹ (từ 1946)\r\nMẫu giày sneaker trẻ trung, thiết kế đạt tiêu chuẩn y khoa của Mỹ.\r\nPhù hợp cho hoạt động đi bộ trong thời gian dài. Thiết kế hỗ trợ vòm chân, đệm memory foam, đệm gót chân và vải co giãn tốt, giúp bạn thoải mái và năng động cả ngày.', 3000000, 0, 54, 1, NULL),
(12, 'Giày Sneaker Unisex Converse', '1650029006.jpg', 100, 'Sử dụng chất liệu vải canvas dày dặn, bền đẹp với dường chỉ may tinh tế, tỉ mỉ. Phần đế cao hơn dòng Chuck cơ bản, có màu trắng ngà và được phủ lớp bóng. Lót giày Ortholite êm, hỗ trợ di chuyển, thoải mái khi mang. Thiết kế đế chống trơn trượt hiệu quả.', 1805000, 0, 54, 1, NULL),
(13, 'Sneaker Unisex Converse Chuck Taylor All Star Classic Hi - Black/w', '1650029239.jpg', 10, 'Thiết kế tinh tế, tỉ mỉ\r\nKiểu dáng thể thao, mạnh mẽ, đế cao su bền chắc, có độ bám cao. Đường may vô cùng tỉ mỉ, chắc chắn giúp bạn hoàn toàn an tâm về chất lượng sản phẩm. Logo thương hiệu được bố trí nổi bật trên sản phẩm.', 1805000, 0, 54, 1, NULL),
(14, 'Giày Da Nam Cao Cấp Italia Germano Bellesi GB 182', '1650200786.jpg', 10, 'Giày Da Nam Cao Cấp Italia Germano Bellesi GB 182 được sử dụng chất liệu cao su cho phần đế, chống mài mòn tốt, chắc chắn khi sử dụng.\r\nKiểu dáng phần đế hài hòa với kích thước sản phẩm, độ dày vừa phải nhằm đảm bảo tính trẻ trung, lịch lãm khi kết hợp cùng trang phục.\r\nĐế giày được làm từ chất liệu cao su tự nhiên, chống trơn trượt.\r\nĐường may tỉ mỉ, tinh tế.\r\nGiày được thiết kế không dây theo phong cách công sở mang đến cho phái mạnh nét lịch lãm và nam tính.', 10450000, 0, 76, 3, '2022-04-17'),
(15, 'Giày Tây Da Nam Germano Bellesi Italia GB 471', '1650200845.jpg', 3, 'Giày Tây Da Nam Germano Bellesi Italia GB 471iày Tây Da Nam Germano Bellesi Italia GB 378 được sử dụng chất liệu cao su cho phần đế, chống mài mòn tốt, chắc chắn khi sử dụng.\r\nKiểu dáng phần đế hài hòa với kích thước sản phẩm, độ dày vừa phải nhằm đảm bảo tính trẻ trung, lịch lãm khi kết hợp cùng trang phục.\r\nĐế giày được làm từ chất liệu cao su tự nhiên, chống trơn trượt.\r\nĐường may tỉ mỉ, tinh tế.\r\nGiày được thiết kế không dây theo phong cách công sở mang đến cho phái mạnh nét lịch lãm và nam tính.', 9260000, 0, 76, 3, '2022-04-17'),
(16, 'Giày thể thao nam - giày sneaker nam mầu trắng phong cách ST009W', '1650200963.jpg', 100, 'Giày Sneaker nam phong cách hàn quốc Hamishu-HMS220 Mẫu giày sneaker nam luôn được ưu chuộng nhất mọi thời đại\r\nDa Pu rât mềm và bền, không bị bong và nổ da trong suốt quá trình sử dụng\r\nĐế cao su non siêu êm\r\nThiết kế đơn giản nhưng tinh tế, đem lại vẻ đẹp bền vưỡng cho đôi giày bạn mang\r\nGiày form thường nên quý khách chọn đúng size chân của quý khách vẫn đi', 200000, 0, 53, 1, '2022-04-17'),
(17, 'Giày Chạy Bộ Nữ Mizuno Wave Sky 4 - J1GD200242', '1650201116.jpg', 10, 'Giày dễ phối đồ thích hợp cho các hoạt động đi lại hàng ngày, chạy bộ ️ Mũi Giày tròn, đế cao su tổng hợp, xẻ rãnh tạo cảm giác thoải mái khi đi\r\n️ Thích hợp với các mùa trong năm: Xuân - Hè - Thu - Đông', 1805000, 0, 54, 1, '2022-04-17'),
(18, 'Giày Thể Thao Nam MWC NATT - 5353', '1650709068.png', 10, 'Giày Thể Thao Nam MWC NATT - 5353 là mẫu giày được thiết kế theo phong cách hiện đại, màu sắc khỏe khoắn, sang trọng mang đến cho bạn 1 diện mạo hoàn toàn cá tính. Đặc biệt sản phẩm sử dụng chất liệu cao cấp có độ bền tối ưu giúp bạn thoải mái trong mọi hoàn cảnh.\r\nChất liệu cao cấp : thoáng khí cả mặt trong lẫn mặt ngoài khiến người mang luôn cảm thấy dễ chịu dù hoạt động trong thời gian dài.', 295000, 0, 54, 1, '2022-04-23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Sneaker'),
(2, 'Sandals'),
(3, 'Dress shoes'),
(4, 'Boots'),
(5, 'Dép lào');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `manufacture`
--
ALTER TABLE `manufacture`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_ibfk_1` (`recipient_id`);

--
-- Chỉ mục cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD KEY `orders_detail_ibfk_2` (`orders_id`),
  ADD KEY `orders_detail_ibfk_1` (`product_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manufacture_id` (`manufacture_id`),
  ADD KEY `product_ibfk_2` (`type_id`);

--
-- Chỉ mục cho bảng `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `manufacture`
--
ALTER TABLE `manufacture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`recipient_id`) REFERENCES `customer` (`id`);

--
-- Các ràng buộc cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD CONSTRAINT `orders_detail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `orders_detail_ibfk_2` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`manufacture_id`) REFERENCES `manufacture` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
