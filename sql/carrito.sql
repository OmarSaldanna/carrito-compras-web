-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 26, 2024 at 10:12 PM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carrito`
--

-- --------------------------------------------------------

--
-- Table structure for table `carritos`
--

CREATE TABLE `carritos` (
  `id_carrito` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `compras`
--

CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_compra` datetime DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(10,2) NOT NULL,
  `estado` enum('pendiente','completada','cancelada') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `compras`
--

INSERT INTO `compras` (`id_compra`, `id_usuario`, `fecha_compra`, `total`, `estado`) VALUES
(1, 5, '2024-11-24 23:52:29', '98.00', 'completada'),
(2, 5, '2024-11-24 23:55:32', '202.00', 'completada'),
(3, 5, '2024-11-26 16:08:43', '56.00', 'completada');

-- --------------------------------------------------------

--
-- Table structure for table `detalles_compra`
--

CREATE TABLE `detalles_compra` (
  `id_detalle` int(11) NOT NULL,
  `id_compra` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detalles_compra`
--

INSERT INTO `detalles_compra` (`id_detalle`, `id_compra`, `id_producto`, `cantidad`, `precio_unitario`) VALUES
(1, 1, 6, 1, '63.00'),
(2, 1, 3, 1, '35.00'),
(4, 2, 3, 1, '35.00'),
(5, 2, 5, 1, '89.00'),
(6, 2, 4, 1, '62.00'),
(7, 2, 16, 1, '16.00'),
(8, 3, 2, 1, '21.00'),
(9, 3, 3, 1, '35.00');

-- --------------------------------------------------------

--
-- Table structure for table `items_carrito`
--

CREATE TABLE `items_carrito` (
  `id_item` int(11) NOT NULL,
  `id_carrito` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen_url` varchar(255) DEFAULT NULL,
  `categorias` varchar(100) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id_producto`, `precio`, `imagen_url`, `categorias`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, '24.00', 'images_37ae0e9016f97d3c.png', 'ícono', '2024-11-06 19:40:54', NULL),
(2, '21.00', 'images_409a85247d175a30.png', 'arte ícono', '2024-11-06 19:40:54', NULL),
(3, '35.00', 'images_47cdc28df36341af.png', 'abstracto', '2024-11-06 19:40:54', NULL),
(4, '62.00', 'images_8fe71411d7ff2de6.png', 'logo vectorial abstracto', '2024-11-06 19:40:54', NULL),
(5, '89.00', 'images_0c28883e17d2b08c.png', 'dibujo', '2024-11-06 19:40:54', NULL),
(6, '63.00', 'images_79ad8f8434955a7b.png', 'abstracto ícono arte', '2024-11-06 19:40:54', NULL),
(8, '39.00', 'images_085dea3147d469ff.png', 'arte ícono logo', '2024-11-06 19:40:54', NULL),
(9, '58.00', 'images_40c25b51e0a007de.png', 'ícono arte logo', '2024-11-06 19:40:54', NULL),
(10, '36.00', 'images_662f026126285aab.png', 'ícono', '2024-11-06 19:40:54', NULL),
(11, '95.00', 'images_2ccbf344e437be9f.png', 'ícono abstracto', '2024-11-06 19:40:54', NULL),
(12, '49.00', 'images_82c503c680de4ed3.png', 'logo', '2024-11-06 19:40:54', NULL),
(13, '54.00', 'images_297802bfa2c71be7.png', 'ícono abstracto dibujo', '2024-11-06 19:40:54', NULL),
(14, '64.00', 'images_64dd4fa07e3d9376.png', 'dibujo', '2024-11-06 19:40:54', NULL),
(15, '82.00', 'images_8314186722a2f9c1.png', 'arte dibujo abstracto', '2024-11-06 19:40:54', NULL),
(16, '16.00', 'images_29622e34e5a12cba.png', 'vectorial', '2024-11-06 19:40:54', NULL),
(17, '15.00', 'images_94137300373aa7f0.png', 'logo abstracto ícono', '2024-11-06 19:40:54', NULL),
(18, '80.00', 'images_3903c611df9ad721.png', 'vectorial', '2024-11-06 19:40:54', NULL),
(19, '68.00', 'images_1a86fe26b68825f7.png', 'logo abstracto', '2024-11-06 19:40:54', NULL),
(20, '16.00', 'images_4c9a1ada96c902b5.png', 'arte abstracto ícono', '2024-11-06 19:40:54', NULL),
(21, '83.00', 'images_946a765d9b08505c.png', 'arte logo vectorial', '2024-11-06 19:40:54', NULL),
(22, '33.00', 'images_766f041b34a5436f.png', 'dibujo logo', '2024-11-06 19:40:54', NULL),
(23, '54.00', 'images_78c0b4f54c804828.png', 'ícono abstracto arte', '2024-11-06 19:40:54', NULL),
(24, '77.00', 'images_853a0124db47d916.png', 'arte', '2024-11-06 19:40:54', NULL),
(25, '87.00', 'images_81dd197682644a81.png', 'ícono', '2024-11-06 19:40:54', NULL),
(26, '19.00', 'images_2aa6d73a95bb7287.png', 'ícono', '2024-11-06 19:40:54', NULL),
(27, '19.00', 'images_08227132b748a6c6.png', 'dibujo ícono logo', '2024-11-06 19:40:54', NULL),
(28, '95.00', 'images_95b5cd99b2e6fcd3.png', 'dibujo abstracto', '2024-11-06 19:40:54', NULL),
(29, '75.00', 'images_36996038a3f15275.png', 'dibujo arte logo', '2024-11-06 19:40:54', NULL),
(30, '87.00', 'images_62b6beec0441927c.png', 'arte ícono vectorial', '2024-11-06 19:40:54', NULL),
(31, '66.00', 'images_3fbc678cfea04587.png', 'ícono', '2024-11-06 19:40:54', NULL),
(32, '68.00', 'images_a0c0e40b7fddb968.png', 'dibujo', '2024-11-06 19:40:54', NULL),
(33, '12.00', 'images_02c7e2cb7b91ef3b.png', 'dibujo logo', '2024-11-06 19:40:54', NULL),
(34, '93.00', 'images_2d9724cea15218aa.png', 'abstracto dibujo logo', '2024-11-06 19:40:54', NULL),
(35, '77.00', 'images_2af3e3baf6d35e3c.png', 'arte abstracto logo', '2024-11-06 19:40:54', NULL),
(36, '82.00', 'images_fa9bc38398008ed8.png', 'ícono abstracto', '2024-11-06 19:40:54', NULL),
(37, '22.00', 'images_9821617a10828c24.png', 'abstracto arte', '2024-11-06 19:40:54', NULL),
(38, '75.00', 'images_889acbdc6625f495.png', 'logo abstracto', '2024-11-06 19:40:54', NULL),
(39, '27.00', 'images_7715418f095b5eb1.png', 'logo dibujo ícono', '2024-11-06 19:40:54', NULL),
(40, '59.00', 'images_5798d711a7bb78d0.png', 'abstracto arte ícono', '2024-11-06 19:40:54', NULL),
(41, '74.00', 'images_0f2bac3da38082b1.png', 'abstracto ícono', '2024-11-06 19:40:54', NULL),
(42, '42.00', 'images_717f7731aa6977ff.png', 'logo', '2024-11-06 19:40:54', NULL),
(43, '42.00', 'images_1af064522c445d41.png', 'dibujo', '2024-11-06 19:40:54', NULL),
(44, '43.00', 'images_8a71099a9a41ceda.png', 'logo dibujo', '2024-11-06 19:40:54', NULL),
(45, '95.00', 'images_1a57e86964648d04.png', 'arte abstracto', '2024-11-06 19:40:54', NULL),
(46, '96.00', 'images_141ec56c94fd1068.png', 'abstracto vectorial', '2024-11-06 19:40:54', NULL),
(47, '22.00', 'images_9c1b446a9e4d74df.png', 'ícono dibujo logo', '2024-11-06 19:40:54', NULL),
(48, '14.00', 'images_8b458de2d470cdaf.png', 'dibujo logo', '2024-11-06 19:40:54', NULL),
(49, '60.00', 'images_0f5afcdc816739ca.png', 'ícono arte abstracto', '2024-11-06 19:40:54', NULL),
(50, '32.00', 'images_69b9b8da451d9884.png', 'arte abstracto ícono', '2024-11-06 19:40:54', NULL),
(56, '100.00', 'stock/images_37ae0e9016f97d3c.png	', 'categorias', '2024-11-26 15:59:03', '2024-11-26 15:59:40');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_registro` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `username`, `email`, `password`, `fecha_registro`) VALUES
(1, 'ana_garcia', 'ana.garcia@email.com', 'pass', '2024-11-06 19:40:46'),
(2, 'carlos_dev', 'carlos.developer@gmail.com', 'pass', '2024-11-06 19:40:46'),
(3, 'maria_rodriguez', 'maria.rdz@outlook.com', 'pass', '2024-11-06 19:40:46'),
(5, 'Omar', 'omarlara997@gmail.com', 'contraseña', '2024-11-11 21:17:34'),
(6, 'Luis', 'luis.to@harina.mx', 'contraseña', '2024-11-11 21:18:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carritos`
--
ALTER TABLE `carritos`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `detalles_compra`
--
ALTER TABLE `detalles_compra`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_compra` (`id_compra`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indexes for table `items_carrito`
--
ALTER TABLE `items_carrito`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_carrito` (`id_carrito`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carritos`
--
ALTER TABLE `carritos`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detalles_compra`
--
ALTER TABLE `detalles_compra`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `items_carrito`
--
ALTER TABLE `items_carrito`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carritos`
--
ALTER TABLE `carritos`
  ADD CONSTRAINT `carritos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Constraints for table `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Constraints for table `detalles_compra`
--
ALTER TABLE `detalles_compra`
  ADD CONSTRAINT `detalles_compra_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compras` (`id_compra`),
  ADD CONSTRAINT `detalles_compra_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Constraints for table `items_carrito`
--
ALTER TABLE `items_carrito`
  ADD CONSTRAINT `items_carrito_ibfk_1` FOREIGN KEY (`id_carrito`) REFERENCES `carritos` (`id_carrito`) ON DELETE CASCADE,
  ADD CONSTRAINT `items_carrito_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
