-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2019 at 11:21 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_shopping_cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=Active | 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `grand_total` float(10,2) NOT NULL,
  `created` datetime NOT NULL,
  `status` enum('Pending','Completed','Cancelled') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` float(10,2) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=Active | 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--
INSERT INTO `products` VALUES (1,'Batidora Artisan 4.7 LT tazon Cerámica Rojo','Cuenco de cerámica de 5 cuartos* Para todo lo que quieras hacer ™* Poder para casi cualquier tarea o receta* Diseño de cabezal inclinable para un acceso claro al recipiente',405.00,'2019-05-13 14:36:34','2019-05-13 14:36:34','1'),(2,'Asador A Gas 2 Quemadores + 2 Mesas Laterales','Se trata de tu hogar, el principal y único espacio íntimo donde se convive tanto con familiares como con nuestros colegas del trabajo o colegas de estudio. Por ello, es costumbre dedicar una cantidad de tiempo adicional para lograr dar con los mejores productos para así mantenerla: aquellos que reúnen calidad, durabilidad y utilidad.', 125.00,'2019-05-13 19:48:44','2019-05-13 19:48:44','1'),(3,'Audifonos JBL T600 Bluetooth','Los auriculares Bluetooth JBL TUNE600BTNC con cancelacion de ruido activa, son la solucion compacta, ligera y plegable para el uso diario',150.00,'2019-05-13 19:48:44','2019-05-13 19:48:44','1'),(4,'Parlante JBL FLIP 5 Bluetooth','Lleva tus canciones sobre la marcha con el potente JBL Flip 5. Nuestro ligero altavoz Bluetooth funciona en cualquier sitio. ¿Mal tiempo? No es para preocuparse.',125.00,'2019-05-13 19:48:44','0000-00-00 00:00:00','1'),(5,'Televisor LG 50 Pulgadas LED UHD 4K','El televisor LG UHD fue creado para elevar la calidad de imagen a un nuevo nivel. Cine, deportes o juegos en un televisor con \"Real 4K\" los colores son realmente vivos y los detalles finos.',225.00,'2019-05-13 19:48:44','2019-05-13 19:48:44','1'),(6,'Consola Nintendo Switch 1.1 32gb','Diviertete libremente donde quieras, como quieras. La consola Nintendo Switch esta diseñada para acompañarte a donde quiera que vayas, transformandose de consola para el hogar a consola portatil en un instante',415.00,'2019-05-13 19:48:44','2019-05-13 19:48:44','1'),(7,'Freidora Electrica 120V Home 1,8 lts','Cuenta con control de temperatura hasta 200C, temporizador de 30 minutos que apaga la freidora automaticamente, leds indicadores de estado (encendido y temperatura, ahorrador de energia)',76.00,'2019-05-13 19:48:44','2019-05-13 19:48:44','1'),(8,'Celular realme 6i Blanco 64 GB','Disfruta de un celular diseñado para generar una experiencia superior para todos, con tecnologia de vanguardia aplicada a telefonos inteligentes que marcan tendencia. Vive tus fotos y videos con las cuatro camaras traseras con IA, la funcion de belleza inteligente AI puede hacer que la piel sea mas joven y delicada',210.00,'2019-05-13 19:48:44','2019-05-13 19:48:44','1'),(9,'Camara Fotografica Canon EOS SL3 Con Lente 18-55','Ya sea que se trate de un usuario primerizo de camaras SLR, de un entusiasta de la fotografia en proceso de aprendizaje o de alguien que busque capturar momentos familiares asombrosos; la camara EOS Rebel SL3 puede convertirse en su mejor aliado.',830.00,'2019-05-13 19:48:44','2019-05-13 19:48:44','1');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
