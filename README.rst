SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE TABLE `customers` (
  `id` int(8) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `token` int(8) NOT NULL,
  `email` varchar(256) DEFAULT NULL,
  `phone` varchar(256) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `customers` (`id`, `username`, `password`, `token`, `email`, `phone`, `address`, `name`) VALUES
(1, 'admin', 'admin', 303, 'admin@gmail.com', '0543605034', 'Iasi', 'Cosmina'),
(3, 'admin1', 'admin1', 0, 'email', 'phone', 'address', 'plesca');

CREATE TABLE `images` (
  `id` int(8) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `type` varchar(256) DEFAULT NULL,
  `image` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `orders` (
  `id` int(8) NOT NULL,
  `customer_id` int(8) NOT NULL,
  `total_price` int(8) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `orders` (`id`, `customer_id`, `total_price`, `created`, `modified`) VALUES
(1, 1, 24, '2018-06-13 19:31:31', '2018-06-13 19:31:31'),
(2, 1, 12, '2018-06-13 19:39:07', '2018-06-13 19:39:07'),
(3, 1, 7, '2018-06-13 20:22:35', '2018-06-13 20:22:35');

CREATE TABLE `order_items` (
  `id` int(8) NOT NULL,
  `order_id` int(8) DEFAULT NULL,
  `product_id` int(8) DEFAULT NULL,
  `quantity` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 1, 1, 2),
(2, 2, 1, 1),
(3, 3, 5, 1);

CREATE TABLE `products` (
  `id` int(8) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `description` text,
  `price` int(8) DEFAULT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `products` (`id`, `name`, `description`, `price`, `date_added`) VALUES
(2, 'Tricou Romania', 'Tricou cu drapelul Romaniei', 25, NULL),
(3, 'Cana', 'Cana cu steagul Romaniei.', 15, NULL),
(4, 'Bratara', 'Bratara cu steagul Romaniei', 12, NULL),
(5, 'Agenda', 'Agenda cu drapelul Romaniei', 7, NULL),
(6, 'product100', 'description100', 30, '2020-04-24'),
(7, NULL, NULL, 30, '2020-04-24');


DELIMITER $$
CREATE TRIGGER `products_date` BEFORE INSERT ON `products` FOR EACH ROW BEGIN
    SET NEW.date_added = NOW();
END
$$
DELIMITER ;

ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `customers`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `images`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `orders`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `order_items`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `products`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
