-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 29-Ago-2019 às 22:27
-- Versão do servidor: 5.7.24
-- versão do PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmacia`
--

--
-- Extraindo dados da tabela `acesso`
--

INSERT INTO `acesso` (`id`, `id_usuario`, `id_perfil`, `login`, `senha`) VALUES
(1, 1, 1, 'igor', '$2y$10$HKXs2e4QqfhWaY874jlSQuh7z/.5ZHIl85x64jeJtW9CPMVXNtmSa'),
(2, 2, 2, 'josue', '$2y$10$HKXs2e4QqfhWaY874jlSQuh7z/.5ZHIl85x64jeJtW9CPMVXNtmSa'),
(3, 17, 1, 'Joao', '$2y$10$Qr4lOctA10aJtRn6/STnFeiSJ3J79PYbDowK4Ib.IysIS4sD6/anS');

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`id`, `nome`, `ativo`) VALUES
(1, 'usuario', 1),
(2, 'admin', 1);

--
-- Extraindo dados da tabela `perfil_permissao`
--

INSERT INTO `perfil_permissao` (`perfil_id`, `permissao_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 7),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15);

--
-- Extraindo dados da tabela `permissao`
--

INSERT INTO `permissao` (`id`, `nome`, `rota`) VALUES
(1, 'Cadastrar cliente', 'cliente.inserir'),
(2, 'Editar cliente', 'cliente.editar'),
(3, 'Buscar cliente', 'cliente'),
(4, 'Deletar cliente', 'cliente.deletar'),
(5, 'Cadastrar usuario', 'usuario.inserir'),
(6, 'Editar usuario', 'usuario.editar'),
(7, 'Buscar usuario', 'usuario'),
(8, 'Deletar usuario', 'usuario.deletar'),
(9, 'Cadastrar remedio', 'remedio.inserir'),
(10, 'Editar remedio', 'remedio.editar'),
(11, 'Deletar remedio', 'remedio.deletar'),
(12, 'Buscar remedio', 'remedio'),
(13, 'Cadastrar compra', 'compra.inserir'),
(14, 'Buscar compra', 'compra'),
(15, 'Buscar compras por cliente', 'compras.por.cliente');

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `sobrenome`, `dataNascimento`, `email`) VALUES
(1, 'Igor', 'Ferreira', '1997-06-06', 'igor@gmail.com'),
(2, 'Josue', 'Wanderley', '1980-05-15', 'josue@wd7.com.br'),
(17, 'Joao', 'José', '1990-12-10', 'aasda@wd7.com.br');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
