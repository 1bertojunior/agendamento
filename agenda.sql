-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Fev-2021 às 21:12
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `agenda`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id` int(11) NOT NULL,
  `fk_city` int(11) NOT NULL,
  `nome` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `fk_servico` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `data_end` datetime NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `agendamentos`
--

INSERT INTO `agendamentos` (`id`, `fk_city`, `nome`, `phone`, `fk_servico`, `data`, `data_end`, `created`) VALUES
(1, 1, 'Evandro', '(89) 99444-9442', 1, '2021-02-07 08:00:00', '2021-02-07 08:30:00', '2021-02-08 11:36:43'),
(2, 1, 'Guedes', '(89) 99444-9442', 1, '2021-02-07 09:00:00', '2021-02-07 09:30:00', '2021-02-08 11:36:43'),
(286, 1, 'Humberto', '(89) 99444-9442', 1, '2021-02-14 10:00:00', '2021-02-14 10:30:00', '2021-02-14 09:27:32'),
(288, 1, 'Josean', '(89) 99436-6562', 2, '2021-02-14 18:00:00', '2021-02-14 19:00:00', '2021-02-14 13:49:52'),
(289, 1, 'Humberto', '(89) 99444-9442', 1, '2021-02-17 08:00:00', '2021-02-17 08:30:00', '2021-02-14 17:08:01'),
(290, 1, 'Humberto', '(89) 99444-9442', 1, '2021-02-17 08:30:00', '2021-02-17 09:00:00', '2021-02-14 17:09:06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidades`
--

CREATE TABLE `cidades` (
  `id` int(11) NOT NULL,
  `nameCity` enum('Belém do Piauí','Padre Marcos') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `cidades`
--

INSERT INTO `cidades` (`id`, `nameCity`) VALUES
(1, 'Belém do Piauí'),
(2, 'Padre Marcos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `daysoff`
--

CREATE TABLE `daysoff` (
  `idDayOff` int(11) NOT NULL,
  `nameDayOff` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `day` int(11) NOT NULL,
  `fk_city` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `daysoff`
--

INSERT INTO `daysoff` (`idDayOff`, `nameDayOff`, `day`, `fk_city`, `status`) VALUES
(1, 'Segunda-feira', 1, 1, 1),
(2, 'Terça-feira', 2, 1, 1),
(3, 'Sexa-feira', 5, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `nome`) VALUES
(1, 'Israel'),
(2, 'Jr');

-- --------------------------------------------------------

--
-- Estrutura da tabela `holidays`
--

CREATE TABLE `holidays` (
  `idHoliday` int(11) NOT NULL,
  `nameHoliday` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `dateHoliday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `holidays`
--

INSERT INTO `holidays` (`idHoliday`, `nameHoliday`, `dateHoliday`) VALUES
(1, 'Finados', '2020-11-02'),
(2, 'Proclamação da República', '2020-11-15'),
(11, 'Natal', '2020-12-25'),
(13, 'teste', '2021-02-06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `horarios`
--

CREATE TABLE `horarios` (
  `id` int(11) NOT NULL,
  `name` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `value_time` time NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `horarios`
--

INSERT INTO `horarios` (`id`, `name`, `value_time`, `active`) VALUES
(1, '08h00', '08:00:00', 1),
(2, '08h30', '08:30:00', 1),
(3, '09h00', '09:00:00', 1),
(4, '09h30', '09:30:00', 1),
(5, '10h00', '10:00:00', 1),
(6, '10h30', '10:30:00', 1),
(7, '11h00', '11:00:00', 1),
(8, '11h30', '11:30:00', 1),
(9, '12h00', '12:00:00', 0),
(10, '12h30', '12:30:00', 0),
(11, '13h00', '13:00:00', 0),
(12, '13h30', '13:30:00', 0),
(13, '14h00', '14:00:00', 1),
(14, '14h30', '14:30:00', 1),
(15, '15h00', '15:00:00', 1),
(16, '15h30', '15:30:00', 1),
(17, '16h00', '16:00:00', 1),
(18, '16h30', '16:30:00', 1),
(19, '17h00', '17:00:00', 0),
(20, '17h30', '17:30:00', 1),
(21, '18h00', '18:00:00', 1),
(22, '18h30', '18:30:00', 1),
(23, '19h00', '19:00:00', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE `servicos` (
  `idServico` int(11) NOT NULL,
  `nomeServico` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tempo` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`idServico`, `nomeServico`, `tempo`) VALUES
(1, 'Corte normal', '00:30:00'),
(2, 'Corte degradê ', '01:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`) VALUES
(3, 'Humberto', 'Júnior', 'hjunior854@gmail.com', '202cb962ac59075b964b07152d234b70'),
(8, 'Josean', 'Eberth', 'joseaneberth@gmail.com', '202cb962ac59075b964b07152d234b70'),
(9, 'Evilásio ', 'Costa', 'evilasiocosta@gmail.com', 'caf1a3dfb505ffed0d024130f58c5cfa');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_city` (`fk_city`),
  ADD KEY `fk_servico` (`fk_servico`);

--
-- Índices para tabela `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `daysoff`
--
ALTER TABLE `daysoff`
  ADD PRIMARY KEY (`idDayOff`),
  ADD KEY `fk_city` (`fk_city`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`idHoliday`);

--
-- Índices para tabela `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`idServico`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;

--
-- AUTO_INCREMENT de tabela `cidades`
--
ALTER TABLE `cidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `daysoff`
--
ALTER TABLE `daysoff`
  MODIFY `idDayOff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `holidays`
--
ALTER TABLE `holidays`
  MODIFY `idHoliday` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `idServico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD CONSTRAINT `agendamentos_ibfk_1` FOREIGN KEY (`fk_city`) REFERENCES `cidades` (`id`),
  ADD CONSTRAINT `agendamentos_ibfk_2` FOREIGN KEY (`fk_servico`) REFERENCES `servicos` (`idServico`);

--
-- Limitadores para a tabela `daysoff`
--
ALTER TABLE `daysoff`
  ADD CONSTRAINT `daysoff_ibfk_1` FOREIGN KEY (`fk_city`) REFERENCES `cidades` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
