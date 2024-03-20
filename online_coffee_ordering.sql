-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2024 at 03:58 AM
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
-- Database: `online_coffee_ordering`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `image`) VALUES
(1, 'Cà phê', 'https://www.highlandscoffee.com.vn/vnt_upload/news/10_2023/Cherry/thumbs/470_crop_HCO_7719_CHERRY_BERRY_DIGITAL-Banner_471x3142x_1.png'),
(2, 'Freeze', 'https://www.highlandscoffee.com.vn/vnt_upload/news/08_2023/thumbs/470_crop_banner1.png');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `new_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `image` text NOT NULL,
  `sub_content` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `create_at` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`new_id`, `title`, `image`, `sub_content`, `content`, `create_at`) VALUES
(1, 'THƠM QUẢ MỌNG, NGỌT ANH ĐÀO! BỘ ĐÔI TRÀ & FREEZE', 'https://www.highlandscoffee.com.vn/vnt_upload/news/10_2023/Cherry/HCO_7719_CHERRY_BERRY_DIGITAL-Banner_820x3602x.png', 'Mùa lễ hội cuối cùng đã tới, bộ đôi \"yêu thương\" nhất năm nay trình làng và đem lại những bất ngờ mới cho các fans Trà & Freeze Highlands Coffee phải thưởng thức', '- Trà Quả Mọng Anh Đào là sự kết hợp giữa trà thơm cùng quả mọng chua ngọt, thêm đài quả ngâm giòn giòn, đánh tan cơn khát.\n- Freeze Quả Mọng Anh Đào với kem béo đậm đà, hài hòa cùng vị chua của quả mọng và cherry, thỏa mãn vị giác.\n\nVới bộ đôi lễ hội mới coóng này từ Highlands Coffee, các bạn đã sẵn sàng cho chiếc outfit chất nhất để diện tới Highlands và cùng đón một mùa lễ hội ửng hồng cùng Highlands Coffee chưa, comment cho Highlands biết nhé!', '2024-01-01'),
(2, '24 NĂM CHÚNG MÌNH, HIGHLANDS CÓ PHIN SỮA ĐÁ 19K', 'https://www.highlandscoffee.com.vn/vnt_upload/news/11_2023/BIRTHDAYHIGHLANDS/HCO-7723-24TH-BIRTHDAY-DIGITAL-820X360.jpg', 'Chúng mình đã đến Highlands Coffee nhận quà, mừng sinh nhật 24 năm \"chất như phin\" chưa?!', 'Không chỉ trải dài khắp đất nước, Highlands Coffee luôn tự hào đồng hành:\r\n\r\n Cùng bạn ở muôn nơi.\r\n\r\n Cùng mừng sinh nhật Highlands với nhau\r\n\r\n Và cùng Highlands mua ngay PHIN 19K, NGON ĐẬM CHẤT PHIN nghen!\r\n\r\n \r\n\r\nTìm hiểu thêm: https://promotion.highlandscoffee.com.vn/\r\n\r\n***Lưu ý đến Chúng mình:\r\n\r\n- Ưu đãi chỉ dành cho sản phẩm Phin Sữa Đá, Phin Đen Đá, Bạc Xỉu\r\n\r\n- CHỈ ÁP DỤNG cho sản phẩm cỡ Nhỏ\r\n\r\n- ÁP DỤNG cho Call Center & Đối tác giao hàng\r\n\r\n- ÁP DỤNG tại Highlands Coffee trên toàn quốc trừ khu vực Sân Bay, hệ thống VinWonders và Grand World Phú Quốc.\r\n\r\n- KHÔNG ÁP DỤNG chung với các chương trình khuyến mãi khác và giá daily combo', '2024-01-02');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `date_order` date DEFAULT curdate(),
  `customer_name` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `order_status` varchar(20) DEFAULT 'Chưa duyệt',
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `date_order`, `customer_name`, `phone_number`, `email`, `order_status`, `note`) VALUES
(1, '2024-01-01', 'Nguyễn Văn A', '123-456-7890', 'nguyenvana@example.c', 'Chưa duyệt', 'Thêm đường nhiều'),
(2, '2024-01-01', 'Trần Thị B', '987-654-3210', 'tranthib@example.com', 'Chưa duyệt', 'Không đường'),
(8, '2024-01-02', 'fsafdsa', '42314312', 'test@gmail.com', 'Chưa duyệt', 'fsdafsda');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 1, 1, 2),
(2, 2, 2, 1),
(3, 1, 2, 1),
(4, 1, 3, 2),
(5, 1, 4, 1),
(6, 1, 5, 2),
(7, 1, 6, 1),
(8, 8, 6, 7);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `image` text DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `image`, `price`, `description`, `category_id`) VALUES
(1, 'Phin đen đá', 'https://www.highlandscoffee.com.vn/vnt_upload/product/04_2023/thumbs/270_crop_HLC_New_logo_5.1_Products__PHIN_DEN_DA.jpg', 50000, 'Dành cho những tín đồ cà phê đích thực! Hương vị cà phê truyền thống được phối trộn độc đáo tại Highlands. Cà phê đậm đà pha hoàn toàn từ Phin, cho thêm 1 thìa đường, một ít đá viên mát lạnh, tạo nên Phin Đen Đá mang vị cà phê đậm đà chất Phin. ', 1),
(2, 'Phin sữa nóng', 'https://www.highlandscoffee.com.vn/vnt_upload/product/11_2022/BR_Drink/thumbs/270_crop_HLC__PHIN_SUA_NONG.jpg', 45000, 'Hương vị cà phê Việt Nam đích thực! Từng hạt cà phê hảo hạng được chọn bằng tay, phối trộn độc đáo giữa hạt Robusta từ cao nguyên Việt Nam, thêm Arabica thơm lừng. Kết hợp với nước sôi từng giọt cà phê được chiết xuất từ Phin truyền thống, hoà cùng sữa đặc sánh tạo nên ly Phin Sữa Nóng – Đậm đà chất Phin.', 1),
(3, 'Bạc xỉu đá', 'https://www.highlandscoffee.com.vn/vnt_upload/product/04_2023/New_product/thumbs/270_crop_HLC_New_logo_5.1_Products__BAC_XIU.jpg', 30000, 'Nếu Phin Sữa Đá dành cho các bạn đam mê vị đậm đà, thì Bạc Xỉu Đá là một sự lựa chọn nhẹ “đô\" cà phê nhưng vẫn thơm ngon, chất lừ không kém!', 1),
(4, 'Cookies & Cream', 'https://www.highlandscoffee.com.vn/vnt_upload/product/06_2023/thumbs/270_crop_HLC_New_logo_5.1_Products__COOKIES_FREEZE.jpg', 55000, 'Một thức uống ngon lạ miệng bởi sự kết hợp hoàn hảo giữa cookies sô cô la giòn xốp cùng hỗn hợp sữa tươi cùng sữa đặc đem say với đá viên, và cuối cùng không thể thiếu được chính là lớp kem whip mềm mịn cùng cookies sô cô la say nhuyễn.', 2),
(5, 'Freeze trà xanh', 'https://www.highlandscoffee.com.vn/vnt_upload/product/06_2023/thumbs/270_crop_HLC_New_logo_5.1_Products__FREEZE_TRA_XANH.jpg', 55000, 'Thức uống rất được ưa chuộng! Trà xanh thượng hạng từ cao nguyên Việt Nam, kết hợp cùng đá xay, thạch trà dai dai, thơm ngon và một lớp kem dày phủ lên trên vô cùng hấp dẫn. Freeze Trà Xanh thơm ngon, mát lạnh, chinh phục bất cứ ai!', 2),
(6, 'Caramel phin', 'https://www.highlandscoffee.com.vn/vnt_upload/product/06_2023/thumbs/270_crop_HLC_New_logo_5.1_Products__CARAMEL_FREEZE_PHINDI.jpg', 55000, 'Thơm ngon khó cưỡng! Được kết hợp từ cà phê truyền thống chỉ có tại Highlands Coffee, cùng với caramel, thạch cà phê và đá xay mát lạnh. Trên cùng là lớp kem tươi thơm béo và caramel ngọt ngào. Món nước phù hợp trong những cuộc gặp gỡ bạn bè, bởi sự ngọt ngào thường mang mọi người xích lại gần nhau.', 2),
(7, 'Freeze sô-cô-la', 'https://www.highlandscoffee.com.vn/vnt_upload/product/04_2023/New_product/thumbs/270_crop_HLC_New_logo_5.1_Products__FREEZE_CHOCO.jpg', 55000, 'Thiên đường đá xay sô cô la! Từ những thanh sô cô la Việt Nam chất lượng được đem xay với đá cho đến khi mềm mịn, sau đó thêm vào thạch sô cô la dai giòn, ở trên được phủ một lớp kem whip beo béo và sốt sô cô la ngọt ngào. Tạo thành Freeze Sô-cô-la ngon mê mẩn chinh phục bất kì ai!', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `customer_name` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`review_id`, `product_id`, `customer_name`, `email`, `rating`, `comment`, `created_at`) VALUES
(1, 1, 'Nguyễn Văn A', 'nguyen.vana@example.com', 5, 'Sản phẩm tuyệt vời! Rất đáng giá khuyến khích.', '2024-01-02 12:49:37'),
(2, 1, 'Trần Thị B', 'tranthib@example.com', 4, 'Chất lượng tốt, nhưng hơi đắt.', '2024-01-02 12:49:37'),
(3, 2, 'Lê Minh C', 'leminhc@example.com', 3, 'Cà phê trung bình, có thể cải thiện hơn.', '2024-01-02 12:49:37'),
(4, 2, 'Phạm Thị D', 'phamthid@example.com', 5, 'Yêu thích hoàn toàn!', '2024-01-02 12:49:37'),
(5, 3, 'Trần Văn E', 'tranvane@example.com', 4, 'Tươi mới và ngon.', '2024-01-02 12:49:37'),
(6, 3, 'Lê Thị F', 'lethif@example.com', 5, 'Đáng giá từng đồng.', '2024-01-02 12:49:37'),
(9, 1, 'fdsa', 'huynguyendev18012003@gmail.com', 0, 'fsda', '2024-01-02 13:42:41'),
(10, 1, 'gfds', 'test@gmail.com', 0, 'gdfsgfds', '2024-01-02 13:44:08'),
(11, 1, 'gfds', 'test@gmail.com', 4, 'gdfsgfds', '2024-01-02 13:44:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`new_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `new_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
