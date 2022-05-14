-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 13, 2022 at 09:06 AM
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
-- Database: `hikkyshop2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
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
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `photo`, `name`, `position`, `username`, `password`, `email`, `token`) VALUES
(1, NULL, 'Nguyễn Chí Tâm', 0, 'Hikky nè', 'superadmin', 'sieucapvjppro@pro.pro', 'Hikky nè_6263c2ec9aa352.51073502'),
(2, NULL, 'test', 0, 'test', 'test', 'test@test.com', 'test_627deab7d3e181.55752603');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
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
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `dob`, `email`, `phone`, `address`, `password`) VALUES
(1, 'Nguyễn Chí Tâm', '2003-06-29', 'ggraygon@gmail.com', 766614580, 'Đà Nẵng ', '1'),
(2, 'test1', '2022-04-01', 'test@test.com', 340502244, 'Đà Nẵng', 'sdaskdmaskdas');

-- --------------------------------------------------------

--
-- Table structure for table `manufacture`
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
-- Dumping data for table `manufacture`
--

INSERT INTO `manufacture` (`id`, `name`, `address`, `email`, `phone`, `datee`, `note`) VALUES
(1, 'Nike', 'Beaverton, Oregon, Hoa Kỳ', 'ggraygon@gmail.com', '18008066453', '2022-05-06', ''),
(2, 'Adidas', 'Adidas', 'xojijo8633@gruppies.com', '0766234580', '2022-05-07', ' '),
(3, 'Déo lào VN', 'Déo lào VN', 'vietnam@vietnam.com', '899999999', '2022-05-07', 'Hàng Việt Nam chất lượng Việt Nam khum đâu sánh bằng'),
(4, 'Versace', 'Versace', 'Versace@versace.com', '456787654', '2022-05-07', 'Cao cấp'),
(5, 'New Balance', 'New Balance', 'newbalence@newbalence.com', '45678765432', '2022-05-08', 'Vjp'),
(6, 'Blundstone', 'Blundstone', 'Australia@Australia.com', '3453445', '2022-05-08', 'Blundstone Footwear là một thương hiệu giày dép của Úc, có trụ sở tại Hobart, Tasmania');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
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

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `recipient_id`, `recipent_name`, `recipent_address`, `recipent_phone`, `total_cost`, `note`, `status`, `time_order`, `time_accept`) VALUES
(1, 1, 'Crush ', 'Khum biết :((', 766614580, 10000000, 'Khum biết :((', 1, '2022-05-07 14:56:39', '2022-05-07 22:10:06'),
(2, 1, 'Crush', 'Đâu đó ngoài cửa sổ :((', 766614580, 4083832, 'Khum biết', 1, '2022-05-07 15:06:44', '2022-05-07 22:10:03'),
(3, 1, 'Crush của ai đó :((', 'Đâu đó ngoài cửa sổ :V', 766614580, 4923832, 'Đâu đó ngoài cửa sổ :V', 1, '2022-05-07 15:08:54', '2022-05-07 22:10:01'),
(4, 1, 'crush nè', 'Tớ chịu ấy :((', 766614580, 9083832, 'tớ khum biết nữa', 1, '2022-05-07 15:11:59', '2022-05-07 22:13:06'),
(5, 1, 'Crush nữa nè', 'Hmm chịu chịuuuu', 766614580, 9083832, 'Hmm chịu chịuuuu', 2, '2022-05-07 15:16:56', '2022-05-07 22:18:07');

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `product_id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`product_id`, `orders_id`, `quantity`) VALUES
(29, 1, 1),
(34, 2, 3),
(27, 2, 1),
(32, 2, 1),
(35, 4, 10),
(30, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text NOT NULL,
  `cost` double NOT NULL,
  `sold` int(11) DEFAULT '0',
  `manufacture_id` int(10) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `token` text NOT NULL,
  `sale` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `quantity`, `description`, `cost`, `sold`, `manufacture_id`, `type_id`, `date`, `token`, `sale`) VALUES
(26, 'Nike Air Max Pre-Day SE', 100, 'Taking the classic look of heritage Nike running into a new realm, the Nike Air Max Pre-Day brings you a fast-paced look ready for today\'s world. The upper keeps the retro track aesthetic you know best in a bold metallic finish. The new Air window energises the look, mixing head-turning style with unbelievably soft cushioning.', 4409000, 0, 1, 1, '2022-04-07', 'product_62760234c9e404.53490491', 34),
(27, 'Nike Air Max 1 Premium', 99, 'Summer showers call for a sneaker bold enough to stand out under even the darkest of clouds. Meet the leader of the pack: the Nike Air Max 1. Inspired by French architecture, celebrated in sport and revered by fashion, this sneaker introduced the world to Air. Rich jewel tones and semi-transparent moulded overlays bring an eye-catching summer update to this legend—no wonder it\'s reigned supreme since 1987.', 4109000, 1, 1, 1, '2022-05-07', 'product_627602fb2d5401.41983690', 12),
(28, 'Jordan Max Aura 3', 100, 'Get your piece of Jordan history and heritage in the Jordan Max Aura 3. Inspired by the brand\'s rich legacy of performance basketball, it has the energy of a game shoe and a design that puts a fresh spin on classic details.', 3519000, 0, 1, 1, '2022-04-07', 'product_62760359912f56.02766586', 3),
(29, 'Nike Air Huarache Crater Premium', 999, 'When it fits this good and looks this great, it doesn\'t need a Swoosh. From its Crater rubber outsole to its woven, checkerboard textile detailing to its stretchy, \"hug your foot\" fabric and Nike Air cushioning, the Huarache is bragging rights for your feet.', 4109000, 1, 1, 1, '2022-05-07', 'product_627603fa103ff2.82605890', 12),
(30, 'Nike Go FlyEase', 97, 'Just when you thought you\'d seen it all, Nike wows with an all-new way to quickly and easily get into your shoes.The entire heel (including the sole) of the Nike Go FlyEase hinges open for a totally hands-free entry.Slip in, step down and presto!You\'re all set.', 3519000, 3, 1, 1, '2022-05-07', 'product_627604633dabc4.69449732', 12),
(32, 'Nike Zoom 004 X MMW', 99, 'Alyx founder and Givenchy creative director Matthew M. Williams is known for his ability to push fashion into new spaces. His ethos is simple: combine the influence of his experiences in New York and California with recent tech breakthroughs. Previously unveiled at Nike\'s 2020 Future Sport Forum, the Nike Zoom 004 x MMW highlights Nike innovation and creates a space where performance and modern aesthetics collide.', 10575199, 1, 1, 1, '2022-04-07', 'product_6276058fb2e3d4.01055449', 23),
(33, 'ULTRABOOST 22', 100, 'Đôi giày chạy bộ Ultraboost này đem lại sự thoải mái và đàn hồi. Đế giữa BOOST mang đến nguồn năng lượng bất tận, cùng hệ thống Linear Energy Push và đế ngoài bằng cao su Continental™ Rubber. Thân giày làm từ loại sợi hiệu năng cao có chứa ít nhất 50% chất liệu Parley Ocean Plastic — rác thải nhựa tái chế thu gom từ các vùng đảo xa, bãi biển, khu dân cư ven biển và đường bờ biển, nhằm ngăn chặn ô nhiễm đại dương.', 5200000, 0, 2, 1, '2022-05-07', 'product_627629d99588e1.08824647', NULL),
(34, 'Giày Response Super 2.0', 97, 'Chinh phục ngày dài thật thoải mái và sẵn sàng cho tất cả với đôi giày chạy bộ adidas này. Thân giày bằng vải lưới thoáng khí giúp đôi chân bạn luôn khô thoáng kể cả khi trời nóng. Lớp đệm trợ lực cho cảm giác đàn hồi trong từng sải bước.\r\nSản phẩm này có sử dụng chất liệu tái chế, là một phần cam kết của chúng tôi hướng tới chấm dứt rác thải nhựa. 20% thân giày làm từ chất liệu có chứa tối thiểu 50% thành phần tái chế.', 2300000, 3, 2, 1, '2022-04-07', 'product_62762ab5632c70.00983638', 3),
(35, 'Tông Lào Chính hảng', 90, 'Tông Lào hay còn gọi tông Thái rất được ưa chuộng các thập niên trước \r\nNgày này cùng với sự phát triển công nghệ hiện đại dép xỏ ngón tông lào vẫn được ưa chuộng bởi giá cả cực rẻ lại bền 2 3 năm không hỏng \r\nMẫu ảnh bên shop chụp ảnh thật nên các Anh/Chị  yên tâm 100% như hình nhé.', 20000, 10, 3, 5, '2022-05-07', 'product_62762bb297d119.61887077', NULL),
(36, 'SN1997 x Marimekko', 1000, 'Lan tỏa niềm vui trên từng sải bước. Đôi giày chạy bộ adidas x Marimekko này có thân giày cải tiến làm từ đồng phục học sinh đã được tái chế và trang trí thêm họa tiết hoa anh túc tươi sáng của hãng thiết kế này. Lớp đệm BOOST cho khả năng hoàn trả năng lượng tuyệt vời và cảm giác thoải mái tức thì trên từng sải bước, và lớp đệm Bounce siêu nhẹ tăng cường thoải mái và linh hoạt cho tới vạch đích.', 3500000, 0, 2, 1, '2022-05-07', 'product_62766af0d24d08.31613206', 23),
(37, 'test test hel lodsd', 100, '  sdadsadsadasdadas', 1000000, 0, 2, 5, '2022-04-07', 'product_6276784eec9fa3.55495063', 23),
(38, 'V LEATHER LACE-UP SHOES', 100, 'A sleek design that transitions seamlessly from the office to happy hour, these elegant lace-ups were crafted in Italy from premium quality calf leather. The design is embellished with a top-stitched, three-dimensional letter \"V\" on the heel', 24660000, 0, 4, 3, '2022-04-07', 'product_627685c54ed014.23921294', NULL),
(39, 'MEDUSA BIGGIE LOAFERS', 100, 'The Medusa Biggie loafers are crafted in leather and feature the Medusa Biggie hardware across the upper.\r\nMedusa Biggie hardware', 26410000, 0, 4, 3, '2022-04-07', 'product_627686ade4ccb6.11676351', 3),
(40, 'Unisex 250', 100, 'Our 250 sandal is built for all of your adventures from the beach to weekend fun. Made with a two strap construction and a GCEVA footbed carrier with rubber pods, it offers the superior traction needed for confident footing. Our sandal is available in extended widths from D to 4E in seasonal colors that you’ll love.', 1377160, 0, 5, 2, '2022-04-07', 'product_62773119327896.80631295', NULL),
(41, 'Unisex 250', 100, 'Our 250 sandal is built for all of your adventures from the beach to weekend fun. Made with a two strap construction and a GCEVA footbed carrier with rubber pods, it offers the superior traction needed for confident footing. Our sandal is available in extended widths from D to 4E in seasonal colors that you’ll love.', 19456000, 0, 5, 2, '2022-05-08', 'product_6277324f1fdce6.34062164', NULL),
(42, 'Women\'s 340', 100, 'Stay comfortable on your days off with our 340 sandal. These women\'s flip flops are built with a moldable footbed that conforms to your foot for a perfect fit and supreme comfort. The lightweight EVA midsole and soft suede strap ensure a comfortable, secure fit with every step, while the overall design gives your casual wear a laid back vibe for maximum relaxation.', 642552, 0, 5, 2, '2022-05-08', 'product_627733230d5e65.43082668', NULL),
(43, 'BLUNDSTONE CLASSICS Women', 100, 'Ankle-high premium leather Chelsea boots featuring weatherproof elastic gussets, twin logo-woven pull-loops at collar and treaded thermo-urethane outsole with debossed logo at outer heel. Smooth leather lining in tan and removable cotton footbed.', 5509560, 0, 6, 4, '2022-04-07', 'product_6277356295d8d1.09213218', 3),
(44, 'MADE in USA 990v3 Core', 100, 'The 990’s original designers were tasked with creating the single best running shoe on the market. The finished product more than lived up to its billing. When it hit shelves for the first time in 1982 the 990 sported an elegantly understated grey colorway, and a then unheard of three-figure price tag. For avid runners and ahead of the curve tastemakers alike, the 990 was a mark of quality and superior taste. There have been updates to the design since ’82, and more color options, but the 990’s aspirational status symbol aura has never changed. Simply put, the 990 is the shoe so good, that we’ve never stopped making it. The 990v3 features a premium upper construction and ENCAP midsole cushioning.', 3467523, 0, 5, 1, '2022-05-10', 'product_627a28b74438f3.70383825', 24),
(45, 'Nike SB Blazer Court Mid Premium', 100, 'With its minimalist look and classic materials, the Nike SB Blazer Court Mid Premium updates the retro hoops vibe for skating. Its reinforced ollie zone and flexible, grippy rubber help it last through your toughest sessions. The canvas upper with an ink stain Swoosh effect adds classic workwear appeal.', 2499000, 0, 1, 1, '2022-04-07', 'product_627a692abab553.29983394', 23),
(46, 'Fresh Foam X 1080v12', 100, 'If we only made one running shoe, that shoe would be the 1080. What makes the 1080 unique isn’t just that it’s the best running shoe we make, it’s also the most versatile. The 1080 delivers top-of-the-line performance to every kind of runner, whether you’re training for world-class competition, or catching a rush hour train. The Fresh Foam X 1080v12 represents a consistent progression of the model’s signature qualities. The smooth transitions of the pinnacle underfoot cushioning experience are fine-tuned with updated midsole mapping, which applies more foam to wider areas of the midsole and increases flexibility at the narrower points. The ultra-modern outlook is also reflected in the 1080’s upper construction. The v12 offers a supportive, second-skin style fit with an engineered Hypoknit upper, for a more streamlined overall design.', 3400232, 0, 5, 1, '2022-05-12', 'product_627ccda5539cf4.32999495', 3),
(47, 'Minimus TR BOA', 100, 'Whether you\'re lifting weights or performing weekly HIIT workouts, our Minimus TR BOA men\'s training shoe is a must-have for anyone who craves support and a lightweight feel. The premium liners allow you to train without wearing socks, ensuring absolute comfort throughout each session. The TPU-infused design offers amazing durability and support. These performance trainers deliver enhanced cushioning without sacrificing stability. The shoe’s upper features PerformFit™ Wrap, powered by the BOA® Fit System, which hugs the instep providing micro-adjustable, precision fit, seamlessly connecting you to the shoe for stability and control.', 13400000, 0, 5, 1, '2022-05-12', '', 12),
(49, 'Minimus TR BOA86', 100, 'When it comes to running, going the extra mile isn’t just a figure of speech. Whether it’s morning exercise, intense training, or head-clearing relaxation, a daily regimen of training miles, combined with ordinary movement throughout the day, demands a lot from a running shoe. With running comfortably for longer in mind, the 880 was built to provide consistent performance for the neutral runner.  The Fresh Foam X 880v12 is modernization that can be seen and felt. A soft foam compound, and dual-layer midsole setup is featured alongside a sleek, jacquard mesh upper featuring strategic zones of support and breathability.', 1000000, 0, 5, 1, '2022-05-12', 'product_627ccf86a82fb2.10959103', 12);

-- --------------------------------------------------------

--
-- Table structure for table `product_img`
--

CREATE TABLE `product_img` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_img`
--

INSERT INTO `product_img` (`id`, `product_id`, `img`) VALUES
(13, 26, '3416519011693360.jpg'),
(14, 26, '6816519011693541.jpg'),
(15, 26, '5116519011693842.jpg'),
(16, 26, '8216519011693883.jpg'),
(17, 27, '4416519012671700.jpg'),
(18, 27, '8416519012671981.jpg'),
(19, 27, '1716519012672142.jpg'),
(20, 27, '5616519012672203.jpg'),
(21, 28, '3716519013155410.jpg'),
(22, 28, '416519013155581.jpg'),
(23, 28, '7316519013155752.jpg'),
(24, 28, '9516519013155893.jpg'),
(25, 29, '10016519014704840.png'),
(26, 29, '3316519014704891.png'),
(27, 29, '916519014705152.png'),
(28, 29, '7716519014705203.png'),
(29, 30, '4116519015793610.png'),
(30, 30, '1616519015793651.png'),
(31, 30, '8716519015793702.png'),
(32, 30, '4316519015793743.png'),
(37, 32, '6916519019674380.png'),
(38, 32, '4816519019674551.png'),
(39, 32, '1216519019674612.png'),
(40, 32, '2316519019674663.png'),
(41, 33, '7516519111708740.png'),
(42, 33, '2016519111709051.png'),
(43, 33, '2816519111709342.png'),
(44, 33, '4416519111709403.png'),
(45, 34, '6216519114584390.png'),
(46, 34, '9316519114584431.png'),
(47, 34, '6716519114584692.png'),
(48, 34, '016519114584853.png'),
(49, 35, '1716519117802180.jpg'),
(50, 35, '7716519117802341.png'),
(51, 35, '8116519117802512.jpg'),
(52, 36, '6516519278659740.png'),
(53, 36, '616519278659911.png'),
(54, 36, '7216519278660072.png'),
(55, 36, '1316519278660233.png'),
(58, 37, '9716519342510860.png'),
(59, 37, '5716519342511171.png'),
(60, 37, '8916519342511622.png'),
(61, 38, '9616519348331510.png'),
(62, 38, '6616519348331681.png'),
(63, 38, '1116519348331842.png'),
(64, 38, '816519348331993.png'),
(65, 39, '9716519349980530.png'),
(66, 39, '5216519349980711.png'),
(67, 39, '8616519349980752.png'),
(68, 39, '8316519349981023.png'),
(69, 40, '3716519787822370.webp'),
(70, 40, '5716519787822671.webp'),
(71, 40, '2416519787822822.png'),
(72, 40, '2916519787822963.png'),
(73, 41, '3316519789301850.png'),
(74, 41, '7716519789302031.png'),
(75, 41, '016519789302182.png'),
(76, 41, '1616519789302343.png'),
(77, 42, '4316519791537690.png'),
(78, 42, '2916519791537951.png'),
(79, 42, '5516519791538112.png'),
(80, 43, '3716519796771420.jpg'),
(81, 43, '1016519796771691.jpg'),
(82, 43, '7316519796771742.jpg'),
(83, 43, '5216519796772003.jpg'),
(84, 44, '1716521730548280.png'),
(85, 44, '4916521730548351.png'),
(86, 44, '9916521730548572.png'),
(87, 44, '5116521730548733.png'),
(88, 45, '8616521895883190.png'),
(89, 45, '1016521895883251.png'),
(90, 45, '616521895883292.png'),
(91, 45, '6716521895883333.jpg'),
(92, 46, '3216523464040550.png'),
(93, 46, '3516523464040621.png'),
(94, 46, '1016523464040652.png'),
(95, 46, '1516523464040693.png'),
(96, 47, '6516523464783040.png'),
(97, 47, '4016523464783091.png'),
(98, 47, '2216523464783132.png'),
(99, 47, '7716523464783373.png'),
(100, 47, '3716523466337920.png'),
(101, 47, '816523466338201.png'),
(102, 47, '7516523466338242.png'),
(103, 47, '9116523466338503.png'),
(104, 49, '8716523467876920.png'),
(105, 49, '8616523467877101.png'),
(106, 49, '4016523467877262.png'),
(107, 49, '8816523467877413.png');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Sneaker'),
(2, 'Sandals'),
(3, 'Dress shoes'),
(4, 'Boots'),
(5, 'Dép lào');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manufacture`
--
ALTER TABLE `manufacture`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_ibfk_1` (`recipient_id`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD KEY `orders_detail_ibfk_2` (`orders_id`),
  ADD KEY `orders_detail_ibfk_1` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manufacture_id` (`manufacture_id`),
  ADD KEY `product_ibfk_2` (`type_id`);

--
-- Indexes for table `product_img`
--
ALTER TABLE `product_img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_img_ibfk_1` (`product_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manufacture`
--
ALTER TABLE `manufacture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `product_img`
--
ALTER TABLE `product_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`recipient_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD CONSTRAINT `orders_detail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `orders_detail_ibfk_2` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`manufacture_id`) REFERENCES `manufacture` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);

--
-- Constraints for table `product_img`
--
ALTER TABLE `product_img`
  ADD CONSTRAINT `product_img_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
