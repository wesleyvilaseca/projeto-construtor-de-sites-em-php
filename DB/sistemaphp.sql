-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 14-Jul-2021 às 03:46
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistemaphp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) DEFAULT NULL,
  `gallery` varchar(1) DEFAULT 'N',
  `enable` varchar(1) DEFAULT 'S',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `banners`
--

INSERT INTO `banners` (`id`, `description`, `gallery`, `enable`) VALUES
(5, 'Banner1', 'N', 'S'),
(7, 'Static cards', 'N', 'S'),
(8, 'Galery', 'S', 'S'),
(10, 'Comentários', 'N', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `banner_image`
--

DROP TABLE IF EXISTS `banner_image`;
CREATE TABLE IF NOT EXISTS `banner_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `description` varchar(500) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `image` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `banner_image`
--

INSERT INTO `banner_image` (`id`, `banner_id`, `title`, `link`, `description`, `sort_order`, `image`) VALUES
(2, 5, 'Foto1', '#', '', 1, 'SLIDE/slide1.jpg'),
(3, 5, 'Foto2', '#', '', 2, 'SLIDE/slide2.jpg'),
(4, 5, 'Titulo', '#', '', 3, 'imageteste.jpg'),
(5, 7, 'Card 1', '#', '<p style=\"text-align: center;\"><strong><strong>Lorem Ipsum</strong> </strong></p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry.</p>', 1, 'STATICCARDS/destaque4.png'),
(6, 7, 'Card 2', '#', '<p style=\"text-align: center;\"><strong><strong>Lorem Ipsum</strong> </strong></p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry.</p>', 2, 'STATICCARDS/destaque2.png'),
(7, 7, 'Card 3', '#', '<p style=\"text-align: center;\"><strong><strong>Lorem Ipsum</strong></strong></p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry.</p>', 3, 'STATICCARDS/destaque4.png'),
(8, 7, 'Card 4', '#', '<p style=\"text-align: center;\"><strong><strong>Lorem Ipsum</strong></strong></p>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry.</p>', 4, 'STATICCARDS/destaque1.png'),
(9, 10, 'Fulado 1', '#', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', 1, 'DEPOIMENTOS/user4.png'),
(10, 10, 'Fulano 2', '#', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', 2, 'DEPOIMENTOS/user3.png'),
(11, 10, 'Fulano 3', '#', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', 3, 'DEPOIMENTOS/user2.png'),
(12, 10, 'Fulano 4', '#', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</p>', 4, 'DEPOIMENTOS/user1.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `blog_articles`
--

DROP TABLE IF EXISTS `blog_articles`;
CREATE TABLE IF NOT EXISTS `blog_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_category_id` int(11) DEFAULT NULL,
  `thumb` varchar(500) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `seo` varchar(200) NOT NULL,
  `description` varchar(400) DEFAULT NULL,
  `article` text,
  `image_gallery_id` int(11) DEFAULT NULL,
  `enable` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `blog_articles`
--

INSERT INTO `blog_articles` (`id`, `blog_category_id`, `thumb`, `title`, `seo`, `description`, `article`, `image_gallery_id`, `enable`) VALUES
(4, 2, 'GALLERY/8.jpg', 'Artigo 1', 'artigo-1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', '<h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: #000000;\">What is Lorem Ipsum?</h2>\r\n<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">&nbsp;</p>\r\n<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\"><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"http://localhost/sistemaphp/assets/adm/img/images/GALLERY/2.jpg\" alt=\"2\" />&nbsp;</p>\r\n<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">&nbsp;</p>\r\n<h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: #000000;\">Where does it come from?</h2>\r\n<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>\r\n<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">&nbsp;</p>\r\n<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>\r\n<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">&nbsp;</p>\r\n<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>\r\n<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">&nbsp;</p>\r\n<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\"><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"http://localhost/sistemaphp/assets/adm/img/images/GALLERY/4.jpg\" alt=\"4\" width=\"814\" height=\"783\" /></p>\r\n<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">&nbsp;</p>\r\n<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">&nbsp;</p>\r\n<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">&nbsp;</p>\r\n<h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; line-height: 24px; font-size: 24px; padding: 0px; font-family: DauphinPlain; color: #000000;\">Where does it come from?</h2>\r\n<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>\r\n<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">&nbsp;</p>\r\n<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">by Wesley Sanches</p>', 8, 'S'),
(5, 3, 'GALLERY/6.jpg', 'Artigo 2', 'artigo-2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', '<p><strong style=\"margin: 0px; padding: 0px; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></p>', NULL, 'S'),
(6, 2, 'GALLERY/7.jpg', 'Artigo 3', 'artigo-3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', '<p><strong style=\"margin: 0px; padding: 0px; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></p>', NULL, 'S'),
(7, 2, 'GALLERY/5.jpg', 'Artigo 4', 'artigo-4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '<p><strong style=\"margin: 0px; padding: 0px; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></p>', NULL, 'S'),
(8, 3, 'GALLERY/3.jpg', 'Artigo 5', 'artigo-5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', '<p><strong style=\"margin: 0px; padding: 0px; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></p>', NULL, 'S'),
(9, 2, 'GALLERY/9.jpg', 'Artigo 6', 'artigo-6', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', '<p><strong style=\"margin: 0px; padding: 0px; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></p>', NULL, 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
CREATE TABLE IF NOT EXISTS `blog_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) DEFAULT NULL,
  `enable` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `description`, `enable`) VALUES
(2, 'Categoria 1', 'S'),
(3, 'Categoria 2', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `blog_config`
--

DROP TABLE IF EXISTS `blog_config`;
CREATE TABLE IF NOT EXISTS `blog_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `departament_desc` varchar(200) DEFAULT NULL,
  `header` varchar(1) DEFAULT NULL,
  `footer` varchar(1) DEFAULT NULL,
  `articles_per_page` int(11) DEFAULT NULL,
  `enable` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `blog_config`
--

INSERT INTO `blog_config` (`id`, `departament_desc`, `header`, `footer`, `articles_per_page`, `enable`) VALUES
(1, 'blog', 'S', 'S', NULL, 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `config_site`
--

DROP TABLE IF EXISTS `config_site`;
CREATE TABLE IF NOT EXISTS `config_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(200) DEFAULT NULL,
  `sitename1` varchar(100) DEFAULT NULL,
  `sitename2` varchar(100) DEFAULT NULL,
  `brand` varchar(1) NOT NULL,
  `favicon` varchar(200) DEFAULT NULL,
  `fone` varchar(100) DEFAULT NULL,
  `address` text,
  `host` varchar(100) DEFAULT NULL,
  `port` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `homepage_id` int(11) DEFAULT NULL,
  `theme_id` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `config_site`
--

INSERT INTO `config_site` (`id`, `logo`, `sitename1`, `sitename2`, `brand`, `favicon`, `fone`, `address`, `host`, `port`, `user`, `password`, `homepage_id`, `theme_id`, `email`) VALUES
(1, 'LOGOS/kodetree.jpg', 'Code', 'Tree', '2', 'LOGOS/FAVICON.png', '(91) 9 8820 3132', '<p>Passagem h1 20</p>', '', '', NULL, '', 1, 1, 'wesley.vilaseca@hotmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `departaments`
--

DROP TABLE IF EXISTS `departaments`;
CREATE TABLE IF NOT EXISTS `departaments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `top` varchar(1) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `layout_id` int(11) DEFAULT NULL,
  `seo` varchar(500) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `enable` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `departaments`
--

INSERT INTO `departaments` (`id`, `description`, `top`, `parent_id`, `layout_id`, `seo`, `sort_order`, `enable`) VALUES
(1, 'Home', 'S', NULL, 1, 'home', 1, 'S'),
(14, 'Any', 'N', 16, NULL, 'any', 2, 'S'),
(13, 'Sobre a empresa', 'N', 16, 3, 'sobre-a-empresa', 1, 'S'),
(12, 'Contato', 'S', NULL, 2, 'contato', 3, 'S'),
(16, 'Quem somos', 'S', NULL, 2, 'quem-somos', 2, 'S'),
(15, 'Any Sub', 'N', 14, NULL, 'any-sub', 1, 'S'),
(17, 'Blog', 'S', NULL, NULL, 'blog', 5, 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `image_gallery`
--

DROP TABLE IF EXISTS `image_gallery`;
CREATE TABLE IF NOT EXISTS `image_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_id` int(11) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `text` text,
  `tags` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `image_gallery`
--

INSERT INTO `image_gallery` (`id`, `banner_id`, `image`, `text`, `tags`) VALUES
(11, 8, 'GALLERY/4.jpg', '<p>LOREM IPSUM</p>', 'apps'),
(10, 8, 'GALLERY/5.jpg', '<p>LOREM IPSUM</p>', 'email'),
(7, 8, 'GALLERY/1.jpg', '<p>LOREM IPSUM</p>', 'website-apps'),
(8, 8, 'GALLERY/2.jpg', '<p>LOREM IPSUM</p>', 'email'),
(9, 8, 'GALLERY/3.jpg', '<p>LOREM IPSUM</p>', 'apps'),
(12, 8, 'GALLERY/6.jpg', '<p>LOREM IPSUM</p>', 'graficos-apps'),
(13, 8, 'GALLERY/7.jpg', '<p>LOREM IPSUM</p>', 'website'),
(14, 8, 'GALLERY/8.jpg', '<p>LOREM IPSUM</p>', 'email'),
(15, 8, 'GALLERY/9.jpg', '<p>LOREM IPSUN</p>', 'apps');

-- --------------------------------------------------------

--
-- Estrutura da tabela `informative_email`
--

DROP TABLE IF EXISTS `informative_email`;
CREATE TABLE IF NOT EXISTS `informative_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `layout`
--

DROP TABLE IF EXISTS `layout`;
CREATE TABLE IF NOT EXISTS `layout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) DEFAULT NULL,
  `header` varchar(1) DEFAULT NULL,
  `footer` varchar(1) DEFAULT NULL,
  `enable` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `layout`
--

INSERT INTO `layout` (`id`, `description`, `header`, `footer`, `enable`) VALUES
(1, 'Home', 'S', 'S', 'S'),
(2, 'Contato', 'S', 'S', 'S'),
(3, 'Sobre a Empresa', 'S', 'S', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `layout_modules`
--

DROP TABLE IF EXISTS `layout_modules`;
CREATE TABLE IF NOT EXISTS `layout_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `position` varchar(1) DEFAULT NULL,
  `enable` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `layout_modules`
--

INSERT INTO `layout_modules` (`id`, `layout_id`, `module_id`, `sort_order`, `position`, `enable`) VALUES
(23, 1, 10, 2, 'C', 'S'),
(22, 1, 19, 6, 'C', 'S'),
(21, 1, 17, 5, 'C', 'S'),
(20, 1, 12, 4, 'C', 'S'),
(19, 1, 21, 3, 'C', 'S'),
(18, 1, 5, 2, 'C', 'S'),
(16, 2, 20, 1, 'C', 'S'),
(17, 1, 4, 1, 'C', 'S'),
(24, 3, 22, 1, 'L', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  `module_code` varchar(100) NOT NULL,
  `settings` text,
  `enable` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `module`
--

INSERT INTO `module` (`id`, `description`, `module_code`, `settings`, `enable`) VALUES
(5, 'Sessão 1', 'modules-defaultsection', '{\"image\":\"DEFAULT\\/destaque1.png\",\"text\":\"<h1>Lorem Ipsun Dolor aondeai<\\/h1>\\r\\n<h4 class=\\\"mb-4\\\">Et Sumi kapa namur aondeai rocus pocus<\\/h4>\\r\\n<p><a class=\\\"button btn btn-primary button-primary d-md-inline-block d-block mb-md-0 mb-2 mr-md-2\\\" href=\\\"#\\\">Saiba mais<\\/a> <a class=\\\"button btn btn-outline-primary button-primary-outline d-md-inline-block d-block\\\" href=\\\"#\\\">Contato<\\/a><\\/p>\",\"image_position\":\"R\"}', 'S'),
(4, 'Slide', 'modules-fullwidthSlideShow', '{\"banner\":\"5\"}', 'S'),
(17, 'Commentários ', 'modules-testmonials', '{\"banner\":\"10\"}', 'S'),
(20, 'Localização ', 'modules-texteditor', '{\"text\":\"<p><iframe style=\\\"border: 0;\\\" src=\\\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d3657.8747059840416!2d-46.656057784495374!3d-23.53700458469501!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce583e4a595263%3A0xae258b0617e722f3!2sAlameda%20Barros%2C%20278%20-%20Santa%20Cecilia%2C%20S%C3%A3o%20Paulo%20-%20SP%2C%2001232-001!5e0!3m2!1spt-BR!2sbr!4v1583679730376!5m2!1spt-BR!2sbr\\\" width=\\\"100%\\\" height=\\\"500\\\" frameborder=\\\"0\\\" allowfullscreen=\\\"allowfullscreen\\\"><\\/iframe><\\/p>\\r\\n<p><strong style=\\\"color: #000000; font-family: \'Trebuchet MS\', Tahoma, sans-serif; font-size: 14px;\\\"><u>Address:<\\/u><\\/strong><br style=\\\"color: #000000; font-family: \'Trebuchet MS\', Tahoma, sans-serif; font-size: 14px;\\\" \\/><span style=\\\"color: #000000; font-family: \'Trebuchet MS\', Tahoma, sans-serif; font-size: 14px;\\\">Keas 69 Str.<\\/span><br style=\\\"color: #000000; font-family: \'Trebuchet MS\', Tahoma, sans-serif; font-size: 14px;\\\" \\/><span style=\\\"color: #000000; font-family: \'Trebuchet MS\', Tahoma, sans-serif; font-size: 14px;\\\">15234, Chalandri<\\/span><br style=\\\"color: #000000; font-family: \'Trebuchet MS\', Tahoma, sans-serif; font-size: 14px;\\\" \\/><span style=\\\"color: #000000; font-family: \'Trebuchet MS\', Tahoma, sans-serif; font-size: 14px;\\\">Athens,<\\/span><br style=\\\"color: #000000; font-family: \'Trebuchet MS\', Tahoma, sans-serif; font-size: 14px;\\\" \\/><span style=\\\"color: #000000; font-family: \'Trebuchet MS\', Tahoma, sans-serif; font-size: 14px;\\\">Greece<\\/span><br style=\\\"color: #000000; font-family: \'Trebuchet MS\', Tahoma, sans-serif; font-size: 14px;\\\" \\/><br style=\\\"color: #000000; font-family: \'Trebuchet MS\', Tahoma, sans-serif; font-size: 14px;\\\" \\/><span style=\\\"color: #000000; font-family: \'Trebuchet MS\', Tahoma, sans-serif; font-size: 14px;\\\">+30-2106019311 (landline)<\\/span><br style=\\\"color: #000000; font-family: \'Trebuchet MS\', Tahoma, sans-serif; font-size: 14px;\\\" \\/><span style=\\\"color: #000000; font-family: \'Trebuchet MS\', Tahoma, sans-serif; font-size: 14px;\\\">+30-6977664062 (mobile phone)<\\/span><br style=\\\"color: #000000; font-family: \'Trebuchet MS\', Tahoma, sans-serif; font-size: 14px;\\\" \\/><span style=\\\"color: #000000; font-family: \'Trebuchet MS\', Tahoma, sans-serif; font-size: 14px;\\\">+30-2106398905 (fax)<\\/span><\\/p>\\r\\n<p>&nbsp;<\\/p>\"}', 'S'),
(10, 'Tipos de serviços', 'modules-staticcards', '{\"title\":\"is simply dummy text of the printing \",\"subtitle\":\"is simply dummy text\",\"banner\":\"7\",\"text\":null}', 'S'),
(12, 'Galeria Home', 'modules-imageGallery', '{\"title\":\"Ultimos trabalhos\",\"subtitle\":\"\",\"banner\":\"8\"}', 'S'),
(19, 'Fique por dentro das novidades', 'modules-informative', '{\"title\":\"Fique por dentro das novidades\",\"subtitle\":\"Et sumi kapa namur aondeai rocus pocus est talaraum \"}', 'S'),
(21, 'Sessão 2', 'modules-defaultsection', '{\"image\":\"DEFAULT\\/about.png\",\"text\":\"<h2 class=\\\"title\\\">At vero eos et accusamus et iusto<\\/h2>\\r\\n<h4 class=\\\"subtitle\\\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque<\\/h4>\\r\\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.<\\/p>\\r\\n<p><a class=\\\"button btn btn-primary button-primary d-md-inline-block d-block mb-md-0 mb-2 mr-md-2\\\" href=\\\"#\\\">Entre em contato<\\/a><\\/p>\",\"image_position\":\"L\"}', 'S'),
(22, 'Sobre a Empresa', 'modules-texteditor', '{\"text\":\"<p><img src=\\\"http:\\/\\/localhost\\/sistemaphp\\/assets\\/adm\\/img\\/images\\/SLIDE\\/slide1.jpg\\\" alt=\\\"slide1\\\" \\/>&nbsp;<\\/p>\\r\\n<h2 style=\\\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: #000000;\\\">What is Lorem Ipsum?<\\/h2>\\r\\n<p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\\\"><strong style=\\\"margin: 0px; padding: 0px;\\\">Lorem Ipsum<\\/strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<\\/p>\\r\\n<h2 style=\\\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: #000000;\\\">Where does it come from?<\\/h2>\\r\\n<p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\\\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \\\"de Finibus Bonorum et Malorum\\\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \\\"Lorem ipsum dolor sit amet..\\\", comes from a line in section 1.10.32.<\\/p>\\r\\n<p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\\\">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \\\"de Finibus Bonorum et Malorum\\\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<\\/p>\\r\\n<p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\\\">&nbsp;<\\/p>\\r\\n<h2 style=\\\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: #000000;\\\">Why do we use it?<\\/h2>\\r\\n<p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\\\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n<p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\\\">&nbsp;<\\/p>\\r\\n<h2 style=\\\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: #000000;\\\">Where can I get some?<\\/h2>\\r\\n<p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\\\">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.<\\/p>\\r\\n<p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\\\">&nbsp;<\\/p>\"}', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) DEFAULT NULL,
  `module_code` varchar(100) DEFAULT NULL,
  `module_route` varchar(100) DEFAULT NULL,
  `enable` varchar(1) DEFAULT 'N',
  `imagem_example` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modules`
--

INSERT INTO `modules` (`id`, `description`, `module_code`, `module_route`, `enable`, `imagem_example`) VALUES
(1, 'SlideShow FullWidth', 'slideshowfull', 'admin-modules-fullwidthSlideShow', 'S', 'assets/adm/img/modules_image_example/slide_example.png'),
(3, 'Default Section', 'defaultsection', 'admin-modules-defaultsection', 'S', 'assets/adm/img/modules_image_example/default_section.png'),
(4, 'Static cards', 'staticcards', 'admin-modules-staticcards', 'S', 'assets/adm/img/modules_image_example/staticcards.png'),
(5, 'Image Gallery', 'imagegallery', 'admin-modules-imageGallery', 'S', 'assets/adm/img/modules_image_example/image_gallery.png'),
(6, 'Testmonials', 'testmonial', 'admin-modules-testmonials', 'S', 'assets/adm/img/modules_image_example/module_testmonials.png'),
(7, 'Informative', 'informative', 'admin-modules-informative', 'S', 'assets/adm/img/modules_image_example/informative_module.png'),
(8, 'Text Editor', 'texteditor', 'admin-modules-texteditor', 'S', 'assets/adm/img/modules_image_example/editor_module.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) DEFAULT NULL,
  `root_path_theme` varchar(500) DEFAULT NULL,
  `root_css_file` varchar(500) DEFAULT NULL,
  `enable` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `theme`
--

INSERT INTO `theme` (`id`, `description`, `root_path_theme`, `root_css_file`, `enable`) VALUES
(1, 'Default', 'institucional/themes/default', 'assets/institucional/css/default/all.css', 'S'),
(3, 'Blue', 'institucional/themes/blue', 'assets/institucional/css/blue/all.css', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(50) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `enable` varchar(1) NOT NULL DEFAULT 'N',
  `enabled` varchar(1) DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `nome`, `email`, `username`, `senha`, `enable`, `enabled`) VALUES
(1, 'Wesley Vila Seca', 'wesley.vilaseca@hotmail.com', 'wesley.vilaseca', 'e10adc3949ba59abbe56e057f20f883e', 'S', 'S');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
