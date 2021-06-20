-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 20-Jun-2021 às 21:48
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistemaphp`
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
-- Estrutura da tabela `config_site`
--

DROP TABLE IF EXISTS `config_site`;
CREATE TABLE IF NOT EXISTS `config_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(200) DEFAULT NULL,
  `favicon` varchar(200) DEFAULT NULL,
  `fone` varchar(100) DEFAULT NULL,
  `address` text,
  `host` varchar(100) DEFAULT NULL,
  `port` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `sitename` varchar(100) DEFAULT NULL,
  `homepage_id` int(11) DEFAULT NULL,
  `theme_id` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `config_site`
--

INSERT INTO `config_site` (`id`, `logo`, `favicon`, `fone`, `address`, `host`, `port`, `user`, `password`, `sitename`, `homepage_id`, `theme_id`, `email`) VALUES
(1, 'LOGOS/FAVICON.png', 'LOGOS/kodetree.jpg', '(91) 9 8820 3132', '<p>Passagem h1 20</p>', '', '', NULL, '', 'Code Tree', 1, 1, 'wesley.vilaseca@hotmail.com');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `departaments`
--

INSERT INTO `departaments` (`id`, `description`, `top`, `parent_id`, `layout_id`, `seo`, `sort_order`, `enable`) VALUES
(1, 'Home', 'S', NULL, 1, 'home', 1, 'S');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `layout`
--

INSERT INTO `layout` (`id`, `description`, `header`, `footer`, `enable`) VALUES
(1, 'Home', 'S', 'S', 'S'),
(2, 'Sobre nós', NULL, NULL, 'N');

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `layout_modules`
--

INSERT INTO `layout_modules` (`id`, `layout_id`, `module_id`, `sort_order`, `position`, `enable`) VALUES
(3, 1, 4, 1, 'C', 'S'),
(4, 1, 5, 2, 'C', 'S'),
(9, 1, 21, 3, 'C', 'S'),
(10, 1, 10, 4, 'C', 'S'),
(11, 1, 12, 5, 'C', 'S'),
(12, 1, 17, 6, 'C', 'S'),
(13, 1, 19, 7, 'C', 'S');

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
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `module`
--

INSERT INTO `module` (`id`, `description`, `module_code`, `settings`, `enable`) VALUES
(5, 'Sessão 1', 'modules-defaultsection', '{\"image\":\"DEFAULT\\/destaque1.png\",\"text\":\"<h1>Lorem Ipsun Dolor aondeai<\\/h1>\\r\\n<h4 class=\\\"mb-4\\\">Et Sumi kapa namur aondeai rocus pocus<\\/h4>\\r\\n<p><a class=\\\"button btn btn-primary button-primary d-md-inline-block d-block mb-md-0 mb-2 mr-md-2\\\" href=\\\"#\\\">Saiba mais<\\/a> <a class=\\\"button btn btn-outline-primary button-primary-outline d-md-inline-block d-block\\\" href=\\\"#\\\">Contato<\\/a><\\/p>\",\"image_position\":\"R\"}', 'S'),
(4, 'Slide', 'modules-fullwidthSlideShow', '{\"banner\":\"5\"}', 'S'),
(17, 'Commentários ', 'modules-testmonials', '{\"banner\":\"10\"}', 'S'),
(20, 'Localização ', 'modules-texteditor', '{\"text\":\"<p><iframe style=\\\"border: 0px none; width: 100%; height: 300px;\\\" src=\\\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d3657.8747059840416!2d-46.656057784495374!3d-23.53700458469501!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce583e4a595263%3A0xae258b0617e722f3!2sAlameda%20Barros%2C%20278%20-%20Santa%20Cecilia%2C%20S%C3%A3o%20Paulo%20-%20SP%2C%2001232-001!5e0!3m2!1spt-BR!2sbr!4v1583679730376!5m2!1spt-BR!2sbr\\\" width=\\\"323\\\" height=\\\"538\\\" frameborder=\\\"0\\\" allowfullscreen=\\\"allowfullscreen\\\"><\\/iframe><\\/p>\"}', 'S'),
(10, 'Tipos de serviços', 'modules-staticcards', '{\"title\":\"is simply dummy text of the printing \",\"subtitle\":\"is simply dummy text\",\"banner\":\"7\",\"text\":null}', 'S'),
(12, 'Galeria Home', 'modules-imageGallery', '{\"title\":\"Ultimos trabalhos\",\"subtitle\":\"\",\"banner\":\"8\"}', 'S'),
(19, 'Fique por dentro das novidades', 'modules-informative', '{\"title\":\"Fique por dentro das novidades\",\"subtitle\":\"Et sumi kapa namur aondeai rocus pocus est talaraum \"}', 'S'),
(21, 'Sessão 2', 'modules-defaultsection', '{\"image\":\"DEFAULT\\/about.png\",\"text\":\"<h2 class=\\\"title\\\">At vero eos et accusamus et iusto<\\/h2>\\r\\n<h4 class=\\\"subtitle\\\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque<\\/h4>\\r\\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.<\\/p>\\r\\n<p><a class=\\\"button btn btn-primary button-primary d-md-inline-block d-block mb-md-0 mb-2 mr-md-2\\\" href=\\\"#\\\">Entre em contato<\\/a><\\/p>\",\"image_position\":\"L\"}', 'S');

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
