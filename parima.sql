
-- CREATE DATABASE IF NOT EXISTS `lifetico_entrega` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci	;
-- USE `lifetico_entrega`;

-- Delete categoria table
DROP TABLE IF EXISTS `categoria`;

-- Create categoria table
CREATE TABLE IF NOT EXISTS `categoria` (
	`id_categoria` int(11) NOT NULL AUTO_INCREMENT,
	`imagem_categoria` longtext NOT NULL,
	`nome_categoria` varchar(128) NOT NULL,
	PRIMARY KEY (`id_categoria`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;



-- Delete entrega table
DROP TABLE IF EXISTS `entrega`;

-- Create entrega table
CREATE TABLE IF NOT EXISTS `entrega` (
	`id_entrega` int(11) NOT NULL AUTO_INCREMENT,
	`tempo_entrega` varchar(128) NOT NULL,
	PRIMARY KEY (`id_entrega`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;



-- Delete marca table
DROP TABLE IF EXISTS `marca`;

-- Create marca table
CREATE TABLE IF NOT EXISTS `marca` (
	`id_marca` int(11) NOT NULL AUTO_INCREMENT,
	`imagem_marca` longtext NOT NULL,
	`nome_marca` varchar(128) NOT NULL,
	PRIMARY KEY (`id_marca`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;



-- Delete produto table
DROP TABLE IF EXISTS `produto`;

-- Create produto table
CREATE TABLE IF NOT EXISTS `produto` (
	`id_produto` int(11) NOT NULL AUTO_INCREMENT,
	`categoria_produto` varchar(128) NOT NULL,
	`marca_produto` varchar(128) NOT NULL,
	`imagem_produto` longtext NOT NULL,
	`produto_produto` varchar(128) NOT NULL,
	`descricao_produto` text NOT NULL,
	`valor_produto` varchar(128) NOT NULL,
	`tempoi_de_entrega` varchar(128) NOT NULL,
	PRIMARY KEY (`id_produto`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;



-- Delete users table
DROP TABLE IF EXISTS `users`;

-- Create users table
CREATE TABLE IF NOT EXISTS `users` (
	`user_id` int(11) NOT NULL AUTO_INCREMENT,
	`user_name` varchar(128) NOT NULL,
	`user_email` varchar(128) NOT NULL,
	`user_website` varchar(128) NOT NULL,
	`user_level` varchar(128) NOT NULL,
	`user_password` varchar(128) NOT NULL,
	PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- Insert default administrator user
INSERT INTO `users` (`user_id` ,`user_name` ,`user_email` ,`user_website`, `user_level` ,`user_password`) VALUES
(NULL , 'Marcos', 'bruno@lifeti.com.br','http://www.lifeti.com.br' , 'admin', '4ac8d9aa31d6988199c12cffebad4d84ad865afd');
