-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2022 a las 20:12:41
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tudai-web2-tp2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `type` text COLLATE utf8_bin NOT NULL,
  `brand` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `type`, `brand`) VALUES
(1, 'Tarjeta Grafica', 'Nvidia'),
(2, 'Tarjeta Grafica', 'AMD'),
(3, 'CPU', 'Intel'),
(4, 'CPU', 'AMD'),
(5, 'Monitor', 'LG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `description` longtext COLLATE utf8_bin NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `fk_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `fk_category`) VALUES
(1, 'ASUS GeForce GTX 1660 TI 6GB GDDR6 TUF EVO OC', 'Tipo\r\npcie\r\nChipset Gpu\r\nGTX 1660 Ti\r\nEntrada Video\r\nNo\r\nPuente Para Sli/croosfirex\r\n-\r\nDoble Puente\r\nNo', '92450.00', 100, 1),
(2, 'Ryzen 5 5600G', 'MARCA: AMD\r\nMODELO: Ryzen 5 5600G\r\n\r\nEspecificaciones\r\nN.° de núcleos de CPU: 6\r\nN.° de subprocesos: 12\r\nN.° de núcleos de GPU: 7\r\nReloj base: 3.9GHz\r\nReloj de aumento máx.: Hasta 4.4GHz\r\nCaché L2 total: 3MB\r\nCaché L3 total: 16MB\r\nDesbloqueados: Sí\r\nCMOS: TSMC 7nm FinFET\r\nPaquete: AM4\r\nVersión de PCI Express: PCIe® 3.0\r\nSolución térmica: Wraith Stealth\r\nTDP/TDP predeterminado: 65W\r\ncTDP: 45-65W\r\nTemp. máx.: 95°C\r\n*Compatible con SO: Windows 10 edición de 64·bits - RHEL x86 edición de 64·bits - Ubuntu x86 edición de 64·bits\r\n*El soporte del sistema operativo (SO) variará según el fabricante.\r\n\r\nMemoria\r\nVelocidad máxima de memoria: Up to 3200MHz\r\nTipo de memoria: DDR4\r\nCanales de memoria: 2\r\n\r\nEspecificaciones de gráficos\r\nFrecuencia de gráficos: 1900 MHz\r\nModelo de gráficos: Radeon™ Graphics\r\nCant. de núcleos de los gráficos: 7\r\n\r\nFuncionalidades principales\r\nDisplay Port: Sí\r\nHDMI™: Sí\r\n\r\nFundación\r\nFamilia de productos: AMD Ryzen™ Processors\r\nLínea de productos: AMD Ryzen™ 5 5000 G-Series Desktop Processors with Radeon™ Graphics\r\nPlataforma: Boxed Processor\r\nBandeja OPN: 100-000000252\r\nOPN PIB: 100-100000252BOX\r\nOPN MPKL: 100-100000252MPK\r\nFecha de lanzamiento: 4/13/2021', '43999.00', 100, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'user@tudai.com', '$2y$10$Lzulm9rUjD8pFEuXgM4fouOwCpRtYhvXRqOm9qscZEtwYK9W9DfSu');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category` (`fk_category`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`fk_category`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
