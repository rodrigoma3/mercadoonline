-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 20-Jul-2016 às 21:25
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
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `cep` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `neighborhood` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `cep`, `address`, `neighborhood`, `city`, `state`) VALUES
(1, 10, '95700000', 'Av. Osvaldo Aranha, 540', 'Juventude', 'Bento Gonçalves', 'RS'),
(2, 10, '95700300', 'Tv Tres de Outubro, 120', 'Cidade Alta', 'Bento Gonçalves', 'RS'),
(3, 10, '95700000', 'Av. Osvaldo Aranha, 540', 'Juventude', 'Bento Gonçalves', 'Estado'),
(4, 10, '95700000', 'Rua Goiânia, 783', 'Botafogo', 'Bento Gonçalves', 'Estado'),
(20, 20, '95700000', 'Rua teste, Bairro teste', 'Bairro Teste', 'Cidade Teste', 'ET');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `carts`
--

INSERT INTO `carts` (`id`, `user_id`) VALUES
(1, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `carts_products`
--

CREATE TABLE IF NOT EXISTS `carts_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `cart_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `carts_products`
--

INSERT INTO `carts_products` (`id`, `product_id`, `cart_id`, `quantity`) VALUES
(5, 2, 1, 3),
(6, 4, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `section_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(7, 'Departamento07', 'd07'),
(8, 'Departamento 09 ', 'Testando cadatro'),
(9, 'Descrição!', ''),
(11, 'Departamento 04', ''),
(12, 'Departamento 10', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `manufacturers`
--

CREATE TABLE IF NOT EXISTS `manufacturers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `cnpj` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `situation_id` int(10) UNSIGNED NOT NULL,
  `total_price` double UNSIGNED NOT NULL,
  `deliver` tinyint(1) NOT NULL,
  `address_to_deliver` varchar(255) NOT NULL,
  `deliver_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `created`, `modified`, `situation_id`, `total_price`, `deliver`, `address_to_deliver`, `deliver_on`) VALUES
(1, 10, '2016-06-26 15:19:31', '2016-06-26 15:19:31', 2, 25, 1, '95700300, Tv Tres de Outubro, 120, Cidade Alta, Bento Gonçalves, RS', '2016-06-26 17:30:00'),
(2, 10, '2016-06-30 15:19:31', '2016-06-30 15:23:31', 2, 25, 1, '95700300, Tv Montenegro, 42, Juventude, Bento Gonçalves, RS', '2016-06-30 18:30:00'),
(3, 10, '2016-07-10 21:36:00', '2016-07-10 21:36:00', 2, 6, 0, '', '0000-00-00 00:00:00'),
(4, 10, '2016-07-10 21:36:00', '2016-07-10 21:36:00', 2, 6, 0, '', '2016-07-11 09:36:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orders_products`
--

CREATE TABLE IF NOT EXISTS `orders_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `unit_price` double UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `orders_products`
--

INSERT INTO `orders_products` (`id`, `product_id`, `order_id`, `quantity`, `unit_price`) VALUES
(1, 1, 1, 1, 5),
(2, 2, 1, 1, 7),
(3, 3, 1, 1, 3),
(4, 4, 1, 1, 10),
(5, 1, 2, 3, 1.66),
(6, 2, 2, 1, 7),
(7, 3, 2, 1, 3),
(9, 2, 3, 1, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `manufacturer_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `stock` int(10) UNSIGNED NOT NULL,
  `price` double UNSIGNED NOT NULL,
  `promotion_price` double UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `manufacturer_id`, `category_id`, `stock`, `price`, `promotion_price`) VALUES
(1, 'Produto 01', '', 1, 1, 10, 5, 0),
(2, 'Produto 02', '', 2, 2, 5, 7, 6.49),
(3, 'Produto 03', '', 3, 3, 8, 3, 0),
(4, 'Produto 04', '', 4, 4, 16, 10, 8.99),
(5, 'Produto de teste', '', 1, 1, 0, 0.04, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(13, 'Seção 13', '', 5),
(14, 'Sec', '', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `situations`
--

CREATE TABLE IF NOT EXISTS `situations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `situations`
--

INSERT INTO `situations` (`id`, `name`, `description`) VALUES
(1, 'Aberto', ''),
(2, 'Novo', ''),
(3, 'Faturando', ''),
(4, 'Coletando', ''),
(5, 'Em transporte', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `last_login` datetime NOT NULL,
  `isRemoved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `cpf`, `email`, `password`, `created`, `modified`, `role_id`, `last_login`, `isRemoved`) VALUES
(1, 'Administrador', 'admin', '02582131083', 'admin@localhost.com', '$2a$10$5edPTLXzPlksBYHsIySni.oP47ij61vk9L44FtdKyM8/yh5wZjS1K', '2016-06-21 00:16:08', '2016-07-12 01:26:15', 1, '2016-07-12 01:26:00', 0),
(10, 'Cliente', 'cliente', '0', 'cliente@email.com', '$2a$10$2WL58gN9hVCmUgFmFTqBweYUMSwWjYiXxKtwGxpfF2D3a5WaELrLK', '2016-06-29 14:00:00', '2016-07-20 03:52:31', 3, '2016-07-20 03:52:00', 0),
(11, 'Funcionário', 'func', '123', 'func@email.com', '$2a$10$2WL58gN9hVCmUgFmFTqBweYUMSwWjYiXxKtwGxpfF2D3a5WaELrLK', '2016-07-03 02:05:38', '2016-07-05 00:01:44', 2, '2016-07-05 00:01:00', 0),
(20, 'Usuario de Teste', 'teste', '', 'teste@teste.com', '', '2016-07-12 02:20:49', '2016-07-12 02:20:49', 1, '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `carts_products`
--
ALTER TABLE `carts_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`situation_id`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_orders_order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manufactory_id` (`manufacturer_id`,`category_id`),
  ADD KEY `fk_products_category_id` (`category_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `situations`
--
ALTER TABLE `situations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `carts_products`
--
ALTER TABLE `carts_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `situations`
--
ALTER TABLE `situations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `fk_addresses_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `fk_carts_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `carts_products`
--
ALTER TABLE `carts_products`
  ADD CONSTRAINT `fk_carts_products_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_carts_products_user_id` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
