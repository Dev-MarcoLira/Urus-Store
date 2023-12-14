-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Dez-2023 às 00:52
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tcc2023`
--
CREATE DATABASE IF NOT EXISTS `tcc2023` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `tcc2023`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `addresses`
--

CREATE TABLE `addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `phone` bigint(20) UNSIGNED NOT NULL,
  `cep` int(10) UNSIGNED NOT NULL,
  `estado` varchar(20) NOT NULL,
  `cidade` varchar(20) NOT NULL,
  `bairro` varchar(20) NOT NULL,
  `endereco` varchar(60) NOT NULL,
  `complemento` varchar(60) DEFAULT NULL,
  `numero` smallint(5) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `addresses`
--

INSERT INTO `addresses` (`id`, `first_name`, `last_name`, `phone`, `cep`, `estado`, `cidade`, `bairro`, `endereco`, `complemento`, `numero`, `created_at`, `modified_at`) VALUES
(8, 'adsadas', 'sada', 21980511282, 20765170, 'RJ', 'Rio de Janeiro', 'Inhaúma', 'Estrada Adhemar Bebiano', 'DEFAULT', 3003, '2023-09-19 03:09:08', NULL),
(9, 'MARCO aNTONIO', 'Lira Barros', 21980511282, 21511330, 'RJ', 'Rio de Janeiro', 'Honório Gurgel', 'Rua General Pinto Amando', 'DEFAULT', 10, '2023-10-02 13:52:05', NULL),
(10, 'marco', 'sdsadaas', 21980511282, 20765170, 'RJ', 'Rio de Janeiro', 'Inhaúma', 'Estrada Adhemar Bebiano', 'DEFAULT', 1, '2023-10-19 14:40:49', NULL),
(11, 'marcooo', 'lira barros', 21980511282, 22775036, 'RJ', 'Rio de Janeiro', 'Jacarepaguá', 'Avenida Cláudio Besserman Vianna', 'perto do posto de gasolina', 2, '2023-10-23 13:31:43', NULL),
(12, 'marco', 'antonio', 21980511282, 20765170, 'RJ', 'Rio de Janeiro', 'Inhaúma', 'Estrada Adhemar Bebiano - de 1933 a 3675 - lado ímpar', 'estrada', 3003, '2023-11-07 11:02:40', NULL),
(13, 'Marco Antonio', 'Lira Barros', 21980511282, 20765170, 'RJ', 'Rio de Janeiro', 'Inhaúma', 'Estrada Adhemar Bebiano', 'DEFAULT', 3003, '2023-11-13 01:31:50', NULL),
(14, 'marco', 'antonio', 21980511282, 20765170, 'RJ', 'Rio de Janeiro', 'Inhaúma', 'Estrada Adhemar Bebiano', 'DEFAULT', 3003, '2023-12-12 22:17:28', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cart_products`
--

CREATE TABLE `cart_products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `total_price` decimal(9,2) UNSIGNED NOT NULL,
  `amount` tinyint(4) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `is_active`, `created_at`, `modified_at`) VALUES
(7, 'processador', 'processador brabo', 1, '2023-08-04 17:52:07', NULL),
(8, 'fonte de alimentação', 'fonte de alimentação', 1, '2023-08-04 18:52:47', NULL),
(9, 'placa-mãe', 'não sei', 1, '2023-08-07 20:23:49', NULL),
(11, 'cooler', 'tanto faz', 1, '2023-06-27 19:53:47', NULL),
(16, 'placa de vídeo', '', 1, '2023-07-06 18:11:16', NULL),
(17, 'monitor', '', 1, '2023-07-09 02:19:51', NULL),
(18, 'teclado', NULL, 1, '2023-07-10 17:33:39', NULL),
(20, 'hd', 'hds de qualquer marca', 1, '2023-07-29 22:30:33', NULL),
(21, 'ssd', NULL, 1, '2023-07-10 17:33:39', NULL),
(22, 'tablet', NULL, 1, '2023-07-10 17:33:39', NULL),
(23, 'memória ram', NULL, 1, '2023-07-10 17:34:44', NULL),
(24, 'memória rom', NULL, 1, '2023-07-10 17:34:44', NULL),
(25, 'headset', NULL, 1, '2023-07-10 17:35:01', NULL),
(26, 'ipad', '', 1, '2023-07-22 20:03:45', NULL),
(27, 'mouse', '', 1, '2023-07-22 20:11:37', '2023-10-23 11:27:04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(80) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `type` enum('preco','porcen') NOT NULL,
  `description` tinytext DEFAULT NULL,
  `discount` decimal(8,2) UNSIGNED DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `discounts`
--

INSERT INTO `discounts` (`id`, `name`, `is_active`, `type`, `description`, `discount`, `created_at`, `modified_at`) VALUES
(4, 'desconto alexandre', 1, 'preco', 'adasdsadas', '70.00', '2023-08-20 03:21:33', '2023-11-06 12:06:39'),
(5, 'desconto fonte alimentação', 1, 'preco', 'adasdasd', '200.00', '2023-08-21 19:32:01', '2023-11-06 12:06:35'),
(6, 'desconto placa-mãe', 1, 'porcen', '', '10.00', '2023-10-14 14:02:14', '2023-11-06 12:06:29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `discounts_products`
--

CREATE TABLE `discounts_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `discount_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `expiry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `discounts_products`
--

INSERT INTO `discounts_products` (`id`, `discount_id`, `product_id`, `expiry_date`, `created_at`, `modified_at`) VALUES
(11, 4, 84, '2023-12-13 22:42:00', '2023-12-12 22:42:55', NULL),
(15, 4, 87, '2023-12-14 23:03:00', '2023-12-12 23:03:51', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `marks`
--

CREATE TABLE `marks` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `marks`
--

INSERT INTO `marks` (`id`, `name`, `is_active`, `created_at`, `modified_at`) VALUES
(1, 'nvidiaaaa', 1, '2023-07-06 17:49:59', '2023-11-06 15:48:14'),
(3, 'intel', 1, '2023-07-09 02:17:32', NULL),
(4, 'coolermaster', 1, '2023-07-09 02:17:44', NULL),
(5, 'asus', 1, '2023-07-09 02:19:12', NULL),
(6, 'corsair', 1, '2023-07-09 02:19:19', NULL),
(8, 'amd', 1, '2023-07-22 19:48:48', NULL),
(9, 'aorus', 1, '2023-07-22 19:49:13', NULL),
(10, 'positivo', 1, '2023-07-22 19:49:30', NULL),
(11, 'razer', 1, '2023-07-22 19:49:38', NULL),
(12, 'hyperx', 1, '2023-07-22 19:50:34', NULL),
(13, 'kingston', 1, '2023-07-22 19:54:04', NULL),
(14, 'samsung', 1, '2023-07-22 19:59:28', NULL),
(15, 'apple', 1, '2023-07-22 19:59:33', NULL),
(17, 'Microsoft', 1, '2023-08-20 18:27:55', NULL),
(20, 'gigabyte', 1, '2023-10-14 17:53:51', NULL),
(21, 'seagate', 1, '2023-10-14 18:33:10', NULL),
(22, 'Marco', 1, '2023-11-06 11:49:35', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `order_items`
--

CREATE TABLE `order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` tinyint(11) NOT NULL,
  `total` decimal(7,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `order_items`
--

INSERT INTO `order_items` (`id`, `payment_id`, `product_id`, `quantity`, `total`, `created_at`, `modified_at`) VALUES
(56, 126, 84, 1, '9000.00', '2023-11-11 03:22:54', NULL),
(57, 127, 87, 1, '500.00', '2023-11-13 02:03:01', NULL),
(58, 127, 96, 1, '470.00', '2023-11-13 02:03:01', NULL),
(59, 128, 88, 4, '880.00', '2023-11-18 03:27:44', NULL),
(60, 140, 87, 1, '500.00', '2023-11-18 03:46:33', NULL),
(61, 141, 87, 3, '1500.00', '2023-12-08 18:21:07', NULL),
(62, 141, 91, 3, '3150.00', '2023-12-08 18:21:07', NULL),
(63, 141, 84, 2, '20000.00', '2023-12-08 18:21:07', NULL),
(64, 142, 108, 2, '200.00', '2023-12-08 18:27:59', NULL),
(65, 142, 87, 5, '2500.00', '2023-12-08 18:27:59', NULL),
(66, 143, 87, 6, '3000.00', '2023-12-12 16:15:59', NULL),
(67, 143, 88, 1, '220.00', '2023-12-12 16:15:59', NULL),
(68, 143, 89, 1, '299.00', '2023-12-12 16:15:59', NULL),
(69, 144, 91, 1, '1050.00', '2023-12-12 16:24:48', NULL),
(70, 145, 96, 1, '470.00', '2023-12-12 16:32:38', NULL),
(71, 146, 88, 12, '2640.00', '2023-12-12 22:28:48', NULL),
(72, 147, 89, 1, '299.00', '2023-12-12 23:48:59', NULL),
(73, 147, 87, 2, '860.00', '2023-12-12 23:49:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `payment_details`
--

CREATE TABLE `payment_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `mercado_pago_id` varchar(20) NOT NULL,
  `amount` int(10) UNSIGNED NOT NULL,
  `parcelas` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `method` varchar(15) NOT NULL,
  `status` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `payment_details`
--

INSERT INTO `payment_details` (`id`, `user_id`, `mercado_pago_id`, `amount`, `parcelas`, `method`, `status`, `created_at`, `modified_at`) VALUES
(126, 17, '1319475235', 9000, 1, 'pix', 'pending', '2023-11-11 03:22:54', NULL),
(127, 17, '1315887078', 970, 1, 'pix', 'pending', '2023-11-13 02:03:01', NULL),
(128, 17, '1319606997', 1380, 1, 'pix', 'pending', '2023-11-18 03:27:44', NULL),
(140, 17, '1319607165', 500, 1, 'pix', 'pending', '2023-11-18 03:46:33', NULL),
(141, 17, '1320016043', 24200, 1, 'pix', 'pending', '2023-12-08 18:21:07', NULL),
(142, 17, '1320016125', 2700, 1, 'pix', 'pending', '2023-12-08 18:27:59', NULL),
(143, 17, '1320084365', 3519, 1, 'pix', 'pending', '2023-12-12 16:15:59', NULL),
(144, 17, '1320084441', 900, 1, 'pix', 'pending', '2023-12-12 16:24:48', NULL),
(145, 17, '1320086547', 470, 1, 'pix', 'pending', '2023-12-12 16:32:38', NULL),
(146, 30, '1316256260', 2640, 1, 'pix', 'pending', '2023-12-12 22:28:48', NULL),
(147, 30, '1316258664', 1159, 1, 'pix', 'pending', '2023-12-12 23:48:59', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_limited` tinyint(1) DEFAULT 0,
  `is_init_page` tinyint(1) DEFAULT 1,
  `is_highlighted` tinyint(1) DEFAULT 0,
  `category_id` int(11) NOT NULL,
  `mark_id` int(10) UNSIGNED NOT NULL,
  `price` decimal(9,2) UNSIGNED NOT NULL,
  `promotion_price` decimal(7,2) UNSIGNED DEFAULT 0.00,
  `amount` tinyint(4) UNSIGNED DEFAULT 0,
  `massa` decimal(5,2) UNSIGNED DEFAULT 0.00,
  `altura` decimal(5,2) UNSIGNED DEFAULT 0.00,
  `largura` decimal(5,2) UNSIGNED DEFAULT 0.00,
  `comprimento` decimal(5,2) UNSIGNED DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `is_active`, `is_limited`, `is_init_page`, `is_highlighted`, `category_id`, `mark_id`, `price`, `promotion_price`, `amount`, `massa`, `altura`, `largura`, `comprimento`, `created_at`, `modified_at`) VALUES
(84, 'PLaca de vídeo GTX 1050', 'uma placa muito boa da AMD', 1, 1, 1, 1, 16, 1, '10000.00', '0.00', 2, '0.00', '0.00', '0.00', '0.00', '2023-10-13 18:56:22', '2023-12-12 23:09:00'),
(87, 'placa-mãe prime h510 ASUS', 'Placa mãe destinada para os gamers de alta tecnologia, que buscam recursos poderosos e caros!', 0, 1, 1, 1, 9, 5, '500.00', '0.00', 0, '0.00', '0.00', '0.00', '0.00', '2023-10-14 18:06:14', '2023-12-12 23:49:00'),
(88, 'teclado gamer razer deluxe', 'Teclado gamer com LED muito caro e da Razer Tecnologies!', 1, 1, 1, 0, 18, 11, '220.00', '0.00', 4, '0.00', '0.00', '0.00', '0.00', '2023-10-14 18:07:33', '2023-12-12 22:28:48'),
(89, 'Mouse gamer Razer Deathadder edition', 'Mouse gamer muito caro e legal. Serve para todos os usuários, principalmente os gamerzinhos!', 0, 1, 1, 1, 27, 11, '299.00', '0.00', 0, '0.00', '0.00', '0.00', '0.00', '2023-10-14 18:09:13', '2023-12-12 23:48:59'),
(91, 'processador i5 7700 TDP 4500W', 'Processador i5 da intel de sétima geração! Vale a pena para gamers que buscam performance boa e de custo não tão elevado!', 1, 1, 1, 0, 7, 3, '1050.00', '900.00', 1, '0.00', '0.00', '0.00', '0.00', '2023-10-14 18:14:19', '2023-12-12 23:08:32'),
(93, 'Processador i9 8900 ABSURDO EM PROMOÇÃO', 'A promoção vai acabar! Aproveite agora mesmo! É o melhor processador da Intel atualmente e é muito potente!', 1, 1, 1, 0, 7, 3, '2000.00', '1640.00', 1, '0.00', '0.00', '0.00', '0.00', '2023-10-14 18:17:40', '2023-12-12 23:08:32'),
(94, 'ryzen 7000 series AMD', 'Processador bolado da AMD', 1, 1, 1, 0, 7, 8, '450.00', '0.00', 1, '0.00', '0.00', '0.00', '0.00', '2023-10-14 18:19:20', '2023-12-12 23:08:32'),
(95, 'processador ryzen 3 4100 8 threads 3ghz', 'Processador BOM da AMD, com 8 threads e tecnologia duplicadora, com boa velocidade de clock e baixo custo!', 1, 1, 1, 0, 7, 8, '500.00', '0.00', 1, '0.00', '0.00', '0.00', '0.00', '2023-10-14 18:21:04', '2023-12-12 23:08:32'),
(96, 'processador ryzen 5 4500 5gz', 'processador bem bom da amd, é melhor do que o ryzen 3 e muito melhor que o i3 da intel kkk', 1, 1, 1, 0, 7, 8, '620.00', '470.00', 1, '0.00', '0.00', '0.00', '0.00', '2023-10-14 18:22:44', '2023-12-12 23:08:32'),
(97, 'processador ryzen 7 7100x 16 threads 5.2ghz', 'Processador muito potente e eficaz, perfeito para usuários que buscam uma das melhores performances disponíveis no mercado! Vale muito o preço!', 1, 1, 1, 1, 7, 8, '1200.00', '0.00', 1, '0.00', '0.00', '0.00', '0.00', '2023-10-14 18:25:05', '2023-12-12 23:08:32'),
(98, 'processador ryzen 9 (5ghz turbo) 24-threads', 'Processador top de linha da AMD voltado a jogadores profissionais!', 1, 1, 1, 1, 7, 8, '2100.00', '1900.00', 1, '0.00', '0.00', '0.00', '0.00', '2023-10-14 18:26:47', '2023-12-12 23:08:32'),
(99, 'processador amd threadripper 64 cores 128 hreads', 'processador absurdo! caro demais! melhor de todos <3', 1, 1, 0, 1, 7, 8, '40000.00', '0.00', 1, '0.00', '0.00', '0.00', '0.00', '2023-10-14 18:28:38', '2023-12-12 23:08:32'),
(100, 'HD 500gb disco rígido 3.5', 'hd brabinho de 500 gb da kingston', 1, 1, 1, 0, 20, 13, '100.00', '75.00', 1, '0.00', '0.00', '0.00', '0.00', '2023-10-14 18:30:55', '2023-12-12 23:08:32'),
(101, 'hd 512gb sata 3 5900rpm', 'disco rígido de 512gb da corsair! O custo é camarada e compensa', 1, 1, 0, 1, 7, 6, '95.00', '0.00', 1, '0.00', '0.00', '0.00', '0.00', '2023-10-14 18:32:33', '2023-12-12 23:08:32'),
(102, 'hd 1tb kingston em promoção', 'HD barato da kingston (1 tera)', 1, 1, 0, 0, 20, 13, '240.00', '200.00', 1, '0.00', '0.00', '0.00', '0.00', '2023-10-14 18:34:17', '2023-12-12 23:08:32'),
(103, 'hd 2tb externo 6000rpm seagate 3.5', 'HD gordo e grande da Seagate! Tem bastante espaço pra baixar arquivos e programas', 1, 1, 0, 1, 20, 21, '300.00', '0.00', 1, '0.00', '0.00', '0.00', '0.00', '2023-10-14 18:35:42', '2023-12-12 23:08:32'),
(104, 'ssd 1tb sata 3 kingston', 'ssd brabo', 1, 1, 0, 1, 21, 13, '350.00', '270.00', 1, '0.00', '0.00', '0.00', '0.00', '2023-10-14 18:36:52', '2023-12-12 23:08:32'),
(105, 'monitor 100000Hz', 'Melhor monitor do mundo', 1, 1, 1, 1, 17, 5, '1000.00', '0.00', 10, '0.00', '0.00', '0.00', '0.00', '2023-07-09 02:20:57', '2023-10-31 14:38:09'),
(106, 'water cooler 200w', 'é bom e gasta pouca energia', 1, 1, 1, 1, 11, 4, '200.00', '0.00', 20, '0.00', '0.00', '0.00', '0.00', '2023-08-20 03:27:22', '2023-10-31 14:38:56'),
(107, 'placa gtx 1080ti', 'placa gigante e boa', 1, 1, 1, 1, 16, 1, '2000.00', '0.00', 8, '0.00', '0.00', '0.00', '0.00', '2023-07-09 02:23:08', '2023-10-31 14:39:32'),
(108, 'Pentium 3', 'Pentiumzão bolado', 1, 1, 1, 1, 7, 3, '100.00', '0.00', 88, '0.00', '0.00', '0.00', '0.00', '2023-07-22 19:46:46', '2023-12-08 18:27:59'),
(109, 'ryzen 3', 'Processador muito brabo da AMD, Recomendado para usuários e gamers que buscam máquinas de entrada', 1, 1, 1, 1, 7, 3, '700.00', '0.00', 24, '0.00', '0.00', '0.00', '0.00', '2023-07-22 19:48:39', '2023-10-31 14:41:40'),
(110, 'headset gamer', 'Headset absurdo da Positivo Muito bom!!!!', 1, 1, 1, 1, 25, 10, '1.00', '0.00', 10, '0.00', '0.00', '0.00', '0.00', '2023-07-22 19:51:28', '2023-10-31 14:42:10'),
(111, 'microfone de mesa hyperx', 'Fone de mesa ideal para usuários home office', 1, 1, 1, 1, 25, 12, '150.00', '0.00', 1, '0.00', '0.00', '0.00', '0.00', '2023-07-22 19:53:15', '2023-11-18 02:38:24'),
(112, 'memória ram 2GB kingston', 'Memória bem legal', 1, 1, 1, 1, 23, 13, '50.00', '0.00', 30, '0.00', '0.00', '0.00', '0.00', '2023-07-22 19:54:46', '2023-10-31 14:44:03'),
(113, 'memória ram 64GB absurda', 'Ela é muito boa e tem muita capacidade. Memória bem rápida da Corsair. Não passe borracha!', 1, 1, 1, 1, 23, 6, '720.00', '0.00', 8, '0.00', '0.00', '0.00', '0.00', '2023-07-22 19:55:48', '2023-10-31 14:48:07'),
(114, 'memória ram 8GB', 'Memória média pra usuários gamers que querem desempenho moderado', 1, 1, 1, 1, 23, 6, '250.00', '0.00', 17, '0.00', '0.00', '0.00', '0.00', '2023-07-22 19:57:11', '2023-10-31 14:48:43'),
(115, 'memória 16GB 550W e muito eficiente', 'Ela é braba! Recomendada para usuários, gamers e desenvolvedores de alto nível e que exigem alta performance!', 1, 1, 1, 1, 23, 13, '500.00', '0.00', 14, '0.00', '0.00', '0.00', '0.00', '2023-07-22 19:59:12', '2023-10-31 14:49:43'),
(116, 'tablet samsung android bacana', 'Tablet muito legal da samsung! Tem 8GB de RAM e 256GB de armazenamento', 1, 1, 1, 1, 22, 14, '800.00', '0.00', 5, '0.00', '0.00', '0.00', '0.00', '2023-07-22 20:01:09', '2023-10-31 14:49:56'),
(117, 'ipad tela oled 16GB ram 512GB SSD', 'ele é muito bom e é da Apple, então você deveria comprar (mas é muito caro)', 1, 1, 1, 1, 22, 15, '5000.00', '0.00', 1, '0.00', '0.00', '0.00', '0.00', '2023-07-22 20:02:29', '2023-11-18 02:38:24'),
(118, 'Teclado gamer LED colorido razer', 'tecladinho premium', 1, 1, 1, 1, 18, 10, '150.00', '0.00', 2, '0.00', '0.00', '0.00', '0.00', '2023-08-27 23:08:53', '2023-12-12 22:26:24'),
(119, 'mouse razer deathadder essential 1000000 dpi', 'mouse bem legale  caro da razer!', 1, 1, 1, 1, 27, 11, '259.00', '0.00', 10, '0.00', '0.00', '0.00', '0.00', '2023-08-27 23:09:38', '2023-10-31 14:52:58'),
(120, 'ssd 1tb corsair', 'SSD nvme 1000000 de bytes por segundo muito rápido!!!!', 1, 1, 1, 1, 21, 6, '565.00', '0.00', 8, '0.00', '0.00', '0.00', '0.00', '2023-08-27 23:10:35', '2023-10-31 14:53:54'),
(121, 'hd 2 tb kingston', 'hdd (hard disk drive) sata 3 da kingston!!!', 1, 1, 1, 1, 20, 1, '500.00', '0.00', 20, '0.00', '0.00', '0.00', '0.00', '2023-08-27 23:11:48', '2023-10-31 14:54:21'),
(122, 'Pentium 2', 'pentiumzin boladin', 1, 1, 1, 1, 7, 3, '150.00', '0.00', 5, '0.00', '0.00', '0.00', '0.00', '2023-08-27 23:12:58', '2023-10-31 14:54:57'),
(123, 'cooler 1000 rpm 100W', 'cooler bacana com luz colorida!!!', 1, 1, 1, 1, 7, 4, '240.00', '0.00', 15, '0.00', '0.00', '0.00', '0.00', '2023-08-27 23:13:37', '2023-10-31 14:55:33'),
(125, 'memorias', 'memoria ram de alta velocidade', 1, 1, 1, 0, 23, 12, '400.00', '200.00', 1, '0.00', '0.00', '0.00', '0.00', '2023-10-16 14:26:01', '2023-12-12 23:08:32'),
(126, 'memoria rom 512MB', 'Memória ROM eficiente e boa da Gigabyte', 1, 1, 1, 0, 7, 1, '100.00', '0.00', 1, '0.00', '0.00', '0.00', '0.00', '2023-10-16 14:32:21', '2023-12-12 23:08:32'),
(127, 'Placa-mãe Aorus 2 Portas SATA USB 3.0', 'Placa-mãe da Aorus voltada a usuários que exigem alta performance em aplicações digitais!', 1, 1, 1, 0, 7, 1, '500.00', '0.00', 1, '0.00', '0.00', '0.00', '0.00', '2023-10-16 14:33:11', '2023-11-07 11:03:01'),
(128, 'Processador apple m1', 'Acabei de criar esse produto', 1, 1, 0, 0, 7, 15, '100.00', '0.00', 1, '0.00', '0.00', '0.00', '0.00', '2023-10-23 11:32:05', '2023-12-12 23:08:32'),
(129, 'Monitor 240Hz LED', 'Monitor ideal para gamers', 1, 1, 1, 0, 7, 1, '150.00', '50.00', 1, '0.00', '0.00', '0.00', '0.00', '2023-10-30 16:03:11', '2023-12-12 23:08:32'),
(130, 'Mouse razer deathadder edition', 'Mouse da razer technologies muito bom!', 1, 1, 0, 1, 27, 11, '100.00', '0.00', 1, '0.00', '0.00', '0.00', '0.00', '2023-11-13 19:33:44', '2023-12-12 23:08:32'),
(131, 'dnasjdas', 'dasdasdasdas', 1, 1, 1, 1, 7, 3, '10.00', '0.00', 2, '0.00', '0.00', '0.00', '0.00', '2023-12-12 22:34:07', '2023-12-12 23:09:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `products_images`
--

CREATE TABLE `products_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `order_number` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `products_images`
--

INSERT INTO `products_images` (`id`, `name`, `product_id`, `order_number`, `created_at`, `modified_at`) VALUES
(21, 'coração.jpg', 84, 3, '2023-10-13 18:56:22', NULL),
(22, 'quadrado.png', 84, 4, '2023-10-13 18:56:22', NULL),
(28, 'triangulo.png', 87, 2, '2023-10-14 18:06:15', NULL),
(29, 'coração.jpg', 87, 3, '2023-10-14 18:06:15', NULL),
(30, 'losango.png', 87, 4, '2023-10-14 18:06:15', NULL),
(32, 'cubo.png', 88, 2, '2023-10-14 18:07:33', NULL),
(33, 'quadrado.png', 88, 3, '2023-10-14 18:07:33', NULL),
(34, 'triangulo.png', 88, 4, '2023-10-14 18:07:33', NULL),
(36, 'quadrado.png', 89, 2, '2023-10-14 18:09:14', NULL),
(37, 'triangulo.png', 89, 3, '2023-10-14 18:09:14', NULL),
(38, 'losango.png', 89, 4, '2023-10-14 18:09:14', NULL),
(44, 'quadrado.png', 91, 2, '2023-10-14 18:14:19', NULL),
(45, 'coração.jpg', 91, 3, '2023-10-14 18:14:19', NULL),
(46, 'circulo.png', 91, 4, '2023-10-14 18:14:19', NULL),
(52, 'coração.jpg', 93, 2, '2023-10-14 18:17:40', NULL),
(53, 'cubo.png', 93, 3, '2023-10-14 18:17:40', NULL),
(54, 'triangulo.png', 93, 4, '2023-10-14 18:17:40', NULL),
(56, 'cubo.png', 94, 2, '2023-10-14 18:19:21', NULL),
(57, 'circulo.png', 94, 3, '2023-10-14 18:19:21', NULL),
(58, 'triangulo.png', 94, 4, '2023-10-14 18:19:21', NULL),
(60, 'circulo.png', 95, 2, '2023-10-14 18:21:05', NULL),
(61, 'circulo.png', 95, 3, '2023-10-14 18:21:05', NULL),
(62, 'circulo.png', 95, 4, '2023-10-14 18:21:05', NULL),
(64, 'cubo.png', 96, 2, '2023-10-14 18:22:44', NULL),
(65, 'circulo.png', 96, 3, '2023-10-14 18:22:44', NULL),
(66, 'circulo.png', 96, 4, '2023-10-14 18:22:44', NULL),
(68, 'coração.jpg', 97, 2, '2023-10-14 18:25:06', NULL),
(69, 'cubo.png', 97, 3, '2023-10-14 18:25:06', NULL),
(70, 'circulo.png', 97, 4, '2023-10-14 18:25:06', NULL),
(72, 'circulo.png', 98, 2, '2023-10-14 18:26:47', NULL),
(73, 'coração.jpg', 98, 3, '2023-10-14 18:26:47', NULL),
(74, 'cubo.png', 98, 4, '2023-10-14 18:26:47', NULL),
(76, 'circulo.png', 99, 2, '2023-10-14 18:28:38', NULL),
(77, 'cubo.png', 99, 3, '2023-10-14 18:28:38', NULL),
(78, 'circulo.png', 99, 4, '2023-10-14 18:28:38', NULL),
(80, 'coração.jpg', 100, 2, '2023-10-14 18:30:56', NULL),
(81, 'cubo.png', 100, 3, '2023-10-14 18:30:56', NULL),
(82, 'losango.png', 100, 4, '2023-10-14 18:30:56', NULL),
(84, 'coração.jpg', 101, 2, '2023-10-14 18:32:33', NULL),
(85, 'cubo.png', 101, 3, '2023-10-14 18:32:33', NULL),
(86, 'cubo.png', 101, 4, '2023-10-14 18:32:33', NULL),
(88, 'coração.jpg', 102, 2, '2023-10-14 18:34:17', NULL),
(89, 'circulo.png', 102, 3, '2023-10-14 18:34:17', NULL),
(92, 'cubo.png', 103, 2, '2023-10-14 18:35:43', NULL),
(93, 'coração.jpg', 103, 3, '2023-10-14 18:35:43', NULL),
(94, 'circulo.png', 103, 4, '2023-10-14 18:35:43', NULL),
(96, 'circulo.png', 104, 2, '2023-10-14 18:36:52', NULL),
(97, 'cubo.png', 104, 3, '2023-10-14 18:36:52', NULL),
(98, 'coração.jpg', 104, 4, '2023-10-14 18:36:52', NULL),
(103, 'coração.jpg', 125, 2, '2023-10-16 14:26:01', NULL),
(104, 'circulo.png', 125, 3, '2023-10-16 14:26:01', NULL),
(105, 'circulo.png', 125, 4, '2023-10-16 14:26:02', NULL),
(107, 'circulo.png', 126, 2, '2023-10-16 14:32:21', NULL),
(108, 'circulo.png', 126, 3, '2023-10-16 14:32:21', NULL),
(109, 'circulo.png', 126, 4, '2023-10-16 14:32:21', NULL),
(111, 'circulo.png', 127, 2, '2023-10-16 14:33:11', NULL),
(112, 'coração.jpg', 127, 3, '2023-10-16 14:33:11', NULL),
(113, 'segurandoDocumento.jpg', 127, 4, '2023-10-16 14:33:11', NULL),
(115, 'circulo.png', 128, 2, '2023-10-23 11:32:06', NULL),
(116, 'cubo.png', 128, 3, '2023-10-23 11:32:06', NULL),
(117, 'quadrado.png', 128, 4, '2023-10-23 11:32:06', NULL),
(122, 'circulo.png', 129, 2, '2023-10-30 16:03:11', NULL),
(123, 'circulo.png', 129, 3, '2023-10-30 16:03:11', NULL),
(124, 'circulo.png', 129, 4, '2023-10-30 16:03:11', NULL),
(127, 'placa-de-video-2.jpg', 84, 2, '2023-10-31 14:21:08', NULL),
(131, 'placa-de-video-1.jpg', 84, 1, '2023-10-31 14:22:55', NULL),
(132, 'placa-mae-1.jpg', 87, 1, '2023-10-31 14:23:25', NULL),
(135, 'teclado-2.jpg', 88, 1, '2023-10-31 14:24:26', NULL),
(136, 'mouse-1.jpg', 89, 1, '2023-10-31 14:25:02', NULL),
(137, 'processador-1.jpg', 91, 1, '2023-10-31 14:25:35', NULL),
(138, 'processador-2.jpg', 93, 1, '2023-10-31 14:26:07', NULL),
(139, 'processador-1.jpg', 94, 1, '2023-10-31 14:26:37', NULL),
(140, 'processador-2.jpg', 95, 1, '2023-10-31 14:26:59', NULL),
(141, 'processador-1.jpg', 96, 1, '2023-10-31 14:27:17', NULL),
(142, 'processador-2.jpg', 97, 1, '2023-10-31 14:27:39', NULL),
(143, 'processador-2.jpg', 98, 1, '2023-10-31 14:27:57', NULL),
(144, 'processador-1.jpg', 99, 1, '2023-10-31 14:28:19', NULL),
(145, 'hd-1.jpg', 100, 1, '2023-10-31 14:28:50', NULL),
(146, 'hd-2.jpg', 101, 1, '2023-10-31 14:29:11', NULL),
(147, 'hd-1.jpg', 102, 1, '2023-10-31 14:29:26', NULL),
(148, 'hd-1.jpg', 103, 1, '2023-10-31 14:30:18', NULL),
(150, 'ssd-1.jpg', 104, 1, '2023-10-31 14:30:46', NULL),
(152, 'monitor-2.jpg', 105, 1, '2023-10-31 14:33:27', NULL),
(154, 'coolers-1.jpg', 106, 1, '2023-10-31 14:39:15', NULL),
(156, 'placa-de-video-1.jpg', 107, 1, '2023-10-31 14:39:53', NULL),
(158, 'processador-1.jpg', 108, 1, '2023-10-31 14:41:24', NULL),
(160, 'processador-2.jpg', 109, 1, '2023-10-31 14:41:59', NULL),
(162, 'headset-1.jpg', 110, 1, '2023-10-31 14:42:29', NULL),
(164, 'headset-2.jpg', 111, 1, '2023-10-31 14:43:20', NULL),
(166, 'memoria-ram-2.jpg', 112, 1, '2023-10-31 14:45:09', NULL),
(168, 'memoria-ram-1.jpg', 113, 1, '2023-10-31 14:48:25', NULL),
(170, 'memoria-ram-2.jpg', 114, 1, '2023-10-31 14:49:01', NULL),
(172, 'memoria-ram-1.jpg', 115, 1, '2023-10-31 14:49:43', NULL),
(174, 'tablet-1.jpg', 116, 1, '2023-10-31 14:50:14', NULL),
(176, 'tablet-2.jpg', 117, 1, '2023-10-31 14:50:43', NULL),
(178, 'teclado-2.jpg', 118, 1, '2023-10-31 14:52:25', NULL),
(180, 'mouse-2.jpg', 119, 1, '2023-10-31 14:53:20', NULL),
(182, 'ssd-1.jpg', 120, 1, '2023-10-31 14:54:10', NULL),
(184, 'hd-2.jpg', 121, 1, '2023-10-31 14:54:45', NULL),
(186, 'processador-2.jpg', 122, 1, '2023-10-31 14:55:22', NULL),
(188, 'coolers-2.jpg', 123, 1, '2023-10-31 14:55:51', NULL),
(190, 'memoria-ram-1.jpg', 125, 1, '2023-10-31 14:56:24', NULL),
(191, 'memoria-rom-1.jpg', 126, 1, '2023-10-31 14:58:38', NULL),
(192, 'placa-mae-2.jpg', 127, 1, '2023-10-31 15:03:04', NULL),
(193, 'processador-3.jpg', 128, 1, '2023-10-31 15:07:00', NULL),
(197, 'monitor-2.jpg', 129, 1, '2023-10-31 15:11:11', NULL),
(198, 'mouse-2.jpg', 130, 1, '2023-11-13 19:33:44', NULL),
(199, 'coolers.png', 131, 1, '2023-12-12 22:34:07', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `rank` decimal(2,1) NOT NULL,
  `comment` mediumtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `user_id`, `product_id`, `rank`, `comment`, `created_at`, `modified_at`) VALUES
(11, 17, 87, '4.0', NULL, '2023-10-30 10:28:57', NULL),
(16, 17, 95, '4.0', NULL, '2023-11-02 17:17:24', NULL),
(20, 25, 125, '4.0', NULL, '2023-11-07 11:04:01', NULL),
(24, 17, 96, '2.0', NULL, '2023-11-13 02:38:20', NULL),
(25, 17, 84, '4.0', NULL, '2023-11-26 13:25:15', NULL),
(28, 17, 88, '4.0', NULL, '2023-12-08 18:22:07', NULL),
(30, 30, 88, '4.0', NULL, '2023-12-12 23:27:29', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `product_variations`
--

CREATE TABLE `product_variations` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sac_messages`
--

CREATE TABLE `sac_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `protocol_id` int(10) UNSIGNED NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sac_messages`
--

INSERT INTO `sac_messages` (`id`, `user_id`, `protocol_id`, `message`, `created_at`, `modified_at`) VALUES
(64, 17, 44, 'O que está acontecendo?', '2023-11-02 20:58:40', NULL),
(65, 25, 44, 'Não consigo comprar nada!!!!', '2023-11-02 20:58:54', NULL),
(66, 25, 46, 'me ajuda por favor', '2023-11-06 11:33:58', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sac_protocols`
--

CREATE TABLE `sac_protocols` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` enum('novo','aberto','finalizado') DEFAULT 'novo',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sac_protocols`
--

INSERT INTO `sac_protocols` (`id`, `user_id`, `title`, `status`, `created_at`, `modified_at`) VALUES
(27, 12, 'Esse portal é horroroso!', 'finalizado', '2023-09-24 04:55:03', '2023-10-03 12:23:37'),
(28, 19, 'Seu site é horrível', 'finalizado', '2023-10-02 11:01:16', '2023-10-31 14:04:34'),
(30, 19, 'Minha compra não chegou!', 'finalizado', '2023-10-03 12:25:22', '2023-10-31 14:04:49'),
(44, 25, 'Eu preciso de ajuda', 'aberto', '2023-11-02 20:58:16', '2023-11-02 20:58:31'),
(46, 25, 'Cadê meu biscoito', 'aberto', '2023-11-06 11:33:40', '2023-11-06 11:34:08'),
(54, 17, 'Minha compra ainda não chegou! :(', 'novo', '2023-11-27 08:15:28', NULL),
(55, 30, 'ndhubnashdbnasdad', 'novo', '2023-12-12 22:29:21', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(100) NOT NULL,
  `passwd` tinytext NOT NULL,
  `name` varchar(50) NOT NULL,
  `role` enum('adm','func','usr') NOT NULL DEFAULT 'usr',
  `cpf` varchar(11) DEFAULT NULL,
  `gender` enum('M','F',' O') NOT NULL,
  `birth` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `is_active`, `is_confirmed`, `email`, `passwd`, `name`, `role`, `cpf`, `gender`, `birth`, `created_at`, `modified_at`) VALUES
(12, 1, 0, 'malirab2304@gmail.com', 'e084382bd3d6dc7e5f00f8165eca2926dfe822eec7c52b29273116758d394804d1bcbc1e2da8e16db7e90ca3da0d4b5117869caf68bf625058704a61532c0b17', 'marco', 'usr', '13467523706', 'M', '2006-03-15', '2023-08-13 22:27:13', '2023-11-26 13:20:55'),
(13, 1, 0, 'malirab2301@gmail.com', '8d20711ad5d8e276e0d553ee4e13bfb5a2fd59ac7e5018d9349b08853eea6988a34a9ec4e82315b9f2fba1f18b9a395be0e3f3822a31ec9c58662c75bc84534b', 'marcos', 'adm', NULL, 'M', NULL, '2023-07-27 23:21:16', '2023-11-02 18:48:25'),
(17, 1, 1, 'malirab2302@gmail.com', 'e084382bd3d6dc7e5f00f8165eca2926dfe822eec7c52b29273116758d394804d1bcbc1e2da8e16db7e90ca3da0d4b5117869caf68bf625058704a61532c0b17', 'marcus', 'adm', '12345678909', 'M', '2006-03-23', '2023-08-19 19:11:12', '2023-12-08 18:16:06'),
(18, 1, 0, 'mborba2006@gmail.com', '55db030c935433781c5ad0cccdfb0ed44821e0e38625e5201a0ef74f9d251836cc5cb062aa9ed7aa547e358d0f6abd7bb66c55e962e22c08f69c13afa984c003', 'Matheus Borba', 'func', '18599772783', 'M', '2006-03-21', '2023-10-02 10:54:58', '2023-11-02 19:25:59'),
(19, 1, 0, 'abcd@gmail.como', '28fde44ffdfbc05ffe9765ddc14a35fe459e5b789427a8a2d89219520b59bf2c31c0e7ced229dcd0aee5f822912a64aa1ab4381c3059566b340fcb7127d88386', 'Miguel Curvello', 'func', NULL, 'M', NULL, '2023-10-02 10:59:53', '2023-11-02 19:26:04'),
(20, 1, 0, 'claudio.guimaraes@prof.eteot.faetec.rj.gov.br', '1a4a9bea59c4e66eac857838ea253d76821c58b4f136423ada7fc51c61b658dd444fee5d2c34901885683a57a35a35bdd6743ec87074393163e6825afacc2f86', 'Professor Cládio', 'func', NULL, 'M', NULL, '2023-10-16 14:06:05', '2023-11-02 20:38:26'),
(22, 1, 0, 'prof_claudio2002@yahoo.com.br', '7ef240e5a954557aee1d99eb02b45049b4860eff7fcb2ccb2d8a852e58b99a93ca3a5ee6247a5fe5b3318a1d018a166bceded9f49ebc1401a99dcf152ab1d0c6', 'Cládio', 'usr', NULL, 'M', NULL, '2023-10-16 14:07:07', '2023-11-02 20:38:12'),
(23, 1, 0, 'preto@gmail.com', 'c95e1b9577703ded3ef4ecd59a43be5426a02444d17977e9b344499cc8ae056eb5a033afed54d294277639ecd45328470ad49d251e8afb3601c651a4174820af', 'Alan', 'usr', NULL, 'M', NULL, '2023-10-17 14:20:48', '2023-11-02 20:38:53'),
(24, 1, 0, 'marco2006@gmail.com', 'e084382bd3d6dc7e5f00f8165eca2926dfe822eec7c52b29273116758d394804d1bcbc1e2da8e16db7e90ca3da0d4b5117869caf68bf625058704a61532c0b17', 'Vitinho fotocópia', 'usr', '13467523706', 'M', '2023-10-07', '2023-10-23 13:27:22', '2023-11-02 20:01:19'),
(25, 1, 0, 'mmarcoxbox360@gmail.com', 'e084382bd3d6dc7e5f00f8165eca2926dfe822eec7c52b29273116758d394804d1bcbc1e2da8e16db7e90ca3da0d4b5117869caf68bf625058704a61532c0b17', 'Inspetor Jorge', 'usr', NULL, 'M', NULL, '2023-11-02 20:41:22', '2023-11-06 11:37:09'),
(27, 1, 0, 'miguelcurvello210@gmail.com', '35fc8c0fb2b4589ff8ecc144a4e460b68dc92f9db446bf6029324c3ca41ed421f535bf0de58ea72668989683a8e4b4ecc3061daa70421f163e55dc900770fece', 'miguel curvello', 'usr', NULL, 'M', NULL, '2023-11-06 11:06:04', NULL),
(30, 1, 0, 'malirab2303@gmail.com', 'e084382bd3d6dc7e5f00f8165eca2926dfe822eec7c52b29273116758d394804d1bcbc1e2da8e16db7e90ca3da0d4b5117869caf68bf625058704a61532c0b17', 'marco', 'usr', '', 'M', '2010-01-12', '2023-12-12 22:13:33', '2023-12-12 22:21:06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_addresses`
--

CREATE TABLE `users_addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `address_id` int(10) UNSIGNED NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users_addresses`
--

INSERT INTO `users_addresses` (`id`, `user_id`, `address_id`, `is_default`) VALUES
(8, 12, 8, 0),
(9, 18, 9, 0),
(21, 23, 10, 0),
(22, 24, 11, 0),
(23, 25, 12, 1),
(24, 17, 13, 1),
(25, 30, 14, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cart_products`
--
ALTER TABLE `cart_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cart_user_id` (`user_id`),
  ADD KEY `fk_cart_product_id` (`product_id`);

--
-- Índices para tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);
ALTER TABLE `categories` ADD FULLTEXT KEY `name_2` (`name`);

--
-- Índices para tabela `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `discounts_products`
--
ALTER TABLE `discounts_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_discount_id` (`discount_id`),
  ADD KEY `fk_product_id` (`product_id`);

--
-- Índices para tabela `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Índices para tabela `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Índices para tabela `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category` (`category_id`),
  ADD KEY `fk_marca_id` (`mark_id`);
ALTER TABLE `products` ADD FULLTEXT KEY `name` (`name`);
ALTER TABLE `products` ADD FULLTEXT KEY `description` (`description`);

--
-- Índices para tabela `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_id` (`product_id`);

--
-- Índices para tabela `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices para tabela `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Índices para tabela `sac_messages`
--
ALTER TABLE `sac_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`message`),
  ADD KEY `protocol_id` (`protocol_id`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Índices para tabela `sac_protocols`
--
ALTER TABLE `sac_protocols`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `users_addresses`
--
ALTER TABLE `users_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `address_id` (`address_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `cart_products`
--
ALTER TABLE `cart_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `discounts_products`
--
ALTER TABLE `discounts_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de tabela `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT de tabela `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT de tabela `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sac_messages`
--
ALTER TABLE `sac_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de tabela `sac_protocols`
--
ALTER TABLE `sac_protocols`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `users_addresses`
--
ALTER TABLE `users_addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cart_products`
--
ALTER TABLE `cart_products`
  ADD CONSTRAINT `cart_products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Limitadores para a tabela `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`payment_id`) REFERENCES `payment_details` (`id`);

--
-- Limitadores para a tabela `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `payment_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_marca_id` FOREIGN KEY (`mark_id`) REFERENCES `marks` (`id`);

--
-- Limitadores para a tabela `products_images`
--
ALTER TABLE `products_images`
  ADD CONSTRAINT `products_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Limitadores para a tabela `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `product_variations`
--
ALTER TABLE `product_variations`
  ADD CONSTRAINT `product_variations_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Limitadores para a tabela `sac_messages`
--
ALTER TABLE `sac_messages`
  ADD CONSTRAINT `sac_messages_ibfk_2` FOREIGN KEY (`protocol_id`) REFERENCES `sac_protocols` (`id`),
  ADD CONSTRAINT `sac_messages_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `sac_protocols`
--
ALTER TABLE `sac_protocols`
  ADD CONSTRAINT `sac_protocols_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `users_addresses`
--
ALTER TABLE `users_addresses`
  ADD CONSTRAINT `users_addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_addresses_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
