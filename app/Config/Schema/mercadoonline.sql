-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 04-Jul-2016 às 17:37
-- Versão do servidor: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mercadoonline`
--
CREATE DATABASE IF NOT EXISTS `mercadoonline` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mercadoonline`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `cep` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `neighborhood` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `cep`, `address`, `neighborhood`, `city`, `state`) VALUES
(1, 8, '95700000', 'Av. Osvaldo Aranha, 540', 'Juventude', 'Bento Gonçalves', 'RS'),
(2, 8, '95700300', 'Tv Tres de Outubro, 120', 'Cidade Alta', 'Bento Gonçalves', 'RS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `section_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `section_id` (`section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `section_id`) VALUES
(1, 'Categoria 01', '', 1),
(2, 'Categoria 02', '', 1),
(3, 'Categoria 03', '', 2),
(4, 'Categoria 04', '', 2),
(5, 'Categoria 05', '', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`) VALUES
(1, 'Departamento 01', ''),
(2, 'Departamento 02', ''),
(3, 'Departamento 03', 'Descrição do 03'),
(4, 'Departamento04', 'd'),
(5, 'Departamento05', 'd'),
(6, 'Departamento06', 'd'),
(7, 'Departamento07', 'd07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `manufacturers`
--

CREATE TABLE IF NOT EXISTS `manufacturers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `name`, `cnpj`) VALUES
(1, 'Fabricante 01', ''),
(2, 'Fabricante 02', ''),
(3, 'Fabricante 03', ''),
(4, 'Fabricante 04', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `situation_id` int(10) UNSIGNED NOT NULL,
  `total_price` double UNSIGNED NOT NULL,
  `deliver` tinyint(1) NOT NULL,
  `address_to_deliver` varchar(255) NOT NULL,
  `deliver_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `status_id` (`situation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `created`, `modified`, `situation_id`, `total_price`, `deliver`, `address_to_deliver`, `deliver_on`) VALUES
(1, 8, '2016-06-26 15:19:31', '2016-06-26 15:19:31', 1, 25, 1, '95700300, Tv Tres de Outubro, 120, Cidade Alta, Bento Gonçalves, RS', '2016-06-26 17:30:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orders_products`
--

CREATE TABLE IF NOT EXISTS `orders_products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `total_price` double UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `products_orders_order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `orders_products`
--

INSERT INTO `orders_products` (`id`, `product_id`, `order_id`, `quantity`, `total_price`) VALUES
(1, 1, 1, 1, 5),
(2, 2, 1, 1, 7),
(3, 3, 1, 1, 3),
(4, 4, 1, 1, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `manufacturer_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `stock` int(10) UNSIGNED NOT NULL,
  `price` double UNSIGNED NOT NULL,
  `promotion_price` double UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `manufactory_id` (`manufacturer_id`,`category_id`),
  KEY `fk_products_category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `manufacturer_id`, `category_id`, `stock`, `price`, `promotion_price`) VALUES
(1, 'Produto 01', '', 1, 1, 10, 5, 0),
(2, 'Produto 02', '', 2, 2, 5, 7, 0),
(3, 'Produto 03', '', 3, 3, 8, 3, 0),
(4, 'Produto 04', '', 4, 4, 16, 10, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'Administrador', 'Permissão administrativa total'),
(2, 'Colaborador', 'Permissão administrativa parcial'),
(3, 'Cliente', 'Sem permissão administrativa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sections`
--

INSERT INTO `sections` (`id`, `name`, `description`, `department_id`) VALUES
(1, 'Seção 01', '', 1),
(2, 'Seção 02', '', 1),
(3, 'Seção 03', '', 2),
(4, 'Seção 04', '', 3),
(5, 'Seção 05', '', 4),
(6, 'Seção 06', '', 5),
(7, 'Seção 07', '', 6),
(8, 'Seção 08', '', 4),
(9, 'Seção 09', '', 5),
(10, 'Seção 10', '', 6),
(11, 'Seção 11', '', 3),
(12, 'Seção 12', '', 2),
(13, 'Seção 13', '', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `situations`
--

CREATE TABLE IF NOT EXISTS `situations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `situations`
--

INSERT INTO `situations` (`id`, `name`, `description`) VALUES
(1, 'Situação 01', ''),
(2, 'Situação 02', ''),
(3, 'Situação 03', ''),
(4, 'Situação 04', ''),
(5, 'Situação 05', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `cpf` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `last_login` datetime NOT NULL,
  `isRemoved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `cpf`, `email`, `password`, `created`, `modified`, `role_id`, `last_login`, `isRemoved`) VALUES
(8, 'Administrador', 'admin', 0, 'admin@localhost.com', '$2a$10$2WL58gN9hVCmUgFmFTqBweYUMSwWjYiXxKtwGxpfF2D3a5WaELrLK', '2016-06-21 00:16:08', '2016-07-04 06:14:35', 1, '2016-07-04 06:14:00', 0),
(10, 'Cliente', 'cliente', 0, 'cliente@email.com', '$2a$10$2WL58gN9hVCmUgFmFTqBweYUMSwWjYiXxKtwGxpfF2D3a5WaELrLK', '2016-06-29 14:00:00', '2016-07-03 03:47:13', 3, '2016-07-03 03:47:00', 0),
(11, 'Funcionário', 'func', 0, 'func@email.com', '$2a$10$2WL58gN9hVCmUgFmFTqBweYUMSwWjYiXxKtwGxpfF2D3a5WaELrLK', '2016-07-03 02:05:38', '2016-07-04 07:19:31', 2, '2016-07-04 07:19:00', 0);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `fk_addresses_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_categories_section_id` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_situation_id` FOREIGN KEY (`situation_id`) REFERENCES `situations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_orders_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `orders_products`
--
ALTER TABLE `orders_products`
  ADD CONSTRAINT `products_orders_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_orders_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_products_manufacturer_id` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturers` (`id`);

--
-- Limitadores para a tabela `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `fk_sections_department_id` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
