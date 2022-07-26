-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 26. 07 2022 kl. 12:24:23
-- Serverversion: 10.4.24-MariaDB
-- PHP-version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bilbixenv2`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `administration`
--

CREATE TABLE `administration` (
  `id` int(11) NOT NULL,
  `navn` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `brugernavn` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `rettigheder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `administration`
--

INSERT INTO `administration` (`id`, `navn`, `email`, `brugernavn`, `password`, `rettigheder`) VALUES
(1, 'Christian H', 'chri14kw@edu.sde.dk', 'chri14kw', '1234', 3),
(2, 'Serhii V', 'serh0227@edu.sde.dk', 'serh0227', '1234', 3);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `biler`
--

CREATE TABLE `biler` (
  `id` int(11) NOT NULL,
  `model` varchar(64) NOT NULL,
  `pris` float NOT NULL,
  `kørt kilometer` int(11) DEFAULT NULL,
  `først registreret` date NOT NULL,
  `type` int(11) NOT NULL,
  `forhandler` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `billede` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `biler`
--

INSERT INTO `biler` (`id`, `model`, `pris`, `kørt kilometer`, `først registreret`, `type`, `forhandler`, `status`, `billede`) VALUES
(1, 'Audi 80 1,8 S', 22000, 342000, '1987-01-01', 1, 2, 1, './img/Personbiler/Audi_80_1,8_S.jpg'),
(2, 'BMW 320i 2,0', 17000, 230000, '1987-01-01', 1, 1, 1, './img/Personbiler/BMW_320i_2,0.jpg'),
(3, 'Ford Ka 1,3', 33000, 79000, '1997-05-01', 1, 1, 1, './img/Personbiler/Ford_Ka_1,3.jpg'),
(4, 'Ford Sierra 2,0 CL DOHC', 17000, 278000, '1990-01-05', 1, 1, 1, './img/Personbiler/Ford_Sierra_2,0_CL_DOHC.jpg'),
(5, 'Mazda 323F 1,6 GLX', 17000, 233000, '1993-01-01', 1, 2, 1, './img/Personbiler/Mazda_323F_1,6_GLX.jpg'),
(6, 'Mercedes 190 2,0', 10000, 253000, '1984-01-01', 1, 2, 1, './img/Personbiler/Mercedes_190_2,0.jpg'),
(7, 'Opel Astra 1,6i GL', 32000, 190000, '1994-01-01', 1, 1, 1, './img/Personbiler/Opel_Astra_1,6i_GL.jpg'),
(8, 'Toyota Carina 1,6 XLi', 14000, 342000, '1990-01-01', 1, 1, 1, './img/Personbiler/Toyota_Carina_1,6_XLi.jpg'),
(9, 'VW Golf 1,6', 14000, 340000, '1986-07-01', 1, 1, 1, './img/Personbiler/VW_Golf_1,6.jpg'),
(10, 'BMW 320i 2,0', 3000, NULL, '1985-01-01', 3, 2, 1, './img/Vrag/BMW_320i_2,0_V.jpg'),
(11, 'Ford Escort 1,3', 3000, NULL, '1985-01-01', 3, 2, 1, './img/Vrag/Ford_Escort_1,3_V.jpg'),
(12, 'Ford Granada 2,0 st car', 7000, NULL, '1987-01-01', 3, 1, 1, './img/Vrag/Ford_Granada_2,0_st_car_V.jpg'),
(13, 'Ford Sierra 1,6', 4000, NULL, '1984-02-01', 3, 2, 1, './img/Vrag/Ford_Sierra_1,6_V.jpg'),
(14, 'Ford Sierra 2,0 v6', 4000, NULL, '1975-01-01', 3, 2, 1, './img/Vrag/Ford_Sierra_2,0_v6_V.jpg'),
(15, 'Ford Sierra 2,0i CLX', 5000, NULL, '1986-01-01', 3, 2, 1, './img/Vrag/Ford_Sierra_2,0i_CLX_V.jpg'),
(16, 'Honda Civic 1,3', 3000, NULL, '1984-01-01', 3, 1, 1, './img/Vrag/Honda_Civic_1,3_V.jpg'),
(17, 'Ford Sierra 2,0i dohc CL', 4000, NULL, '1991-01-01', 3, 1, 1, './img/Vrag/Ford_Sierra_2,0i_dohc_CL_V.jpg'),
(18, 'Mercedes 300 TD 3,0 st.car', 2000, NULL, '1986-01-01', 3, 1, 1, './img/Vrag/Mercedes_300_TD_3,0_st.car_V.jpg'),
(19, 'Mercedes Sprinter 312 2,9 D', 60000, 321000, '1996-01-01', 2, 1, 1, './img/Varebiler/Mercedes_Sprinter_312_2,9_D.jpg'),
(20, 'Mazda E2200 6,7 d ladvogn', 8750, NULL, '1989-01-01', 2, 2, 1, './img/Varebiler/Mazda_E2200_6,7_d_ladvogn.jpg'),
(21, 'Mazda E2200 D Ladvogn', 5000, NULL, '1986-01-01', 2, 2, 1, './img/Varebiler/Mazda_E2200_D_Ladvogn.jpg'),
(22, 'Mazda B2000 B Pick-Up', 10000, 219000, '1989-01-01', 2, 1, 1, './img/Varebiler/Mazda_B2000_B_Pick-Up.jpg'),
(23, 'Ford Transit 100L CL 2,5 D', 15000, NULL, '1991-01-01', 2, 2, 1, './img/Varebiler/Ford_Transit_100L_CL_2,5_D_2.jpg'),
(24, 'Ford Transit 100L CL 2,5 D', 45000, 203000, '1997-11-01', 2, 1, 1, './img/Varebiler/Ford_Transit_100L_CL_2,5_D.jpg'),
(25, 'VW Transporter benzin Pick-Up', 6250, NULL, '1990-01-01', 2, 2, 2, './img/Varebiler/VW_Transporter_benzin_Pick-Up.jpg'),
(26, 'VW Transporter 2,0 benzin', 17500, NULL, '1980-01-01', 2, 2, 1, './img/Varebiler/VW_Transporter_2,0_benzin.jpg'),
(27, 'VW Transporter 2,4 D', 37500, 260000, '1995-01-01', 2, 1, 1, './img/Varebiler/VW_Transporter_2,4_D.jpg');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `bilstatus`
--

CREATE TABLE `bilstatus` (
  `id` int(11) NOT NULL,
  `status` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `bilstatus`
--

INSERT INTO `bilstatus` (`id`, `status`) VALUES
(1, 'tilgængelig'),
(2, 'solgt'),
(3, 'til udlejning');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `forhandler`
--

CREATE TABLE `forhandler` (
  `id` int(11) NOT NULL,
  `navn` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `brugernavn` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `rettighedder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `forhandler`
--

INSERT INTO `forhandler` (`id`, `navn`, `email`, `brugernavn`, `password`, `rettighedder`) VALUES
(1, 'forhandler1', 'forhandler1@email.com', 'forhandler1', '1reldnahrof', 2),
(2, 'forhandler2', 'forhandler2@email.com', 'forhandler2', '2reldnahrof', 2);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `kommentar`
--

CREATE TABLE `kommentar` (
  `id` int(11) NOT NULL,
  `navn` varchar(64) NOT NULL,
  `dato` date NOT NULL,
  `email` varchar(64) NOT NULL,
  `text` varchar(500) NOT NULL,
  `bilID` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `kommentar`
--

INSERT INTO `kommentar` (`id`, `navn`, `dato`, `email`, `text`, `bilID`, `status`) VALUES
(1, 'test person', '2022-06-15', 'test@mail.com', 'den er godt nok dyr', 4, 3),
(2, 'test person', '2022-06-15', 'test@mail.com', 'denne bil kører rigtig godt', 1, 1);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `kommentarstatus`
--

CREATE TABLE `kommentarstatus` (
  `id` int(11) NOT NULL,
  `status` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `kommentarstatus`
--

INSERT INTO `kommentarstatus` (`id`, `status`) VALUES
(1, 'godkendt'),
(2, 'venter godkendelse'),
(3, 'afvist');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `rettigheder`
--

CREATE TABLE `rettigheder` (
  `id` int(11) NOT NULL,
  `type` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `rettigheder`
--

INSERT INTO `rettigheder` (`id`, `type`) VALUES
(1, 'uden login'),
(2, 'forhandler'),
(3, 'administrator');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `type` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `type`
--

INSERT INTO `type` (`id`, `type`) VALUES
(1, 'personbil'),
(2, 'varevogn'),
(3, 'vrag');

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `administration`
--
ALTER TABLE `administration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rettigheder` (`rettigheder`);

--
-- Indeks for tabel `biler`
--
ALTER TABLE `biler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bilType` (`type`),
  ADD KEY `status` (`status`) USING BTREE,
  ADD KEY `forhandler` (`forhandler`) USING BTREE;

--
-- Indeks for tabel `bilstatus`
--
ALTER TABLE `bilstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `forhandler`
--
ALTER TABLE `forhandler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rettighedder` (`rettighedder`);

--
-- Indeks for tabel `kommentar`
--
ALTER TABLE `kommentar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bilID` (`bilID`),
  ADD KEY `status` (`status`);

--
-- Indeks for tabel `kommentarstatus`
--
ALTER TABLE `kommentarstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `rettigheder`
--
ALTER TABLE `rettigheder`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `administration`
--
ALTER TABLE `administration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tilføj AUTO_INCREMENT i tabel `biler`
--
ALTER TABLE `biler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Tilføj AUTO_INCREMENT i tabel `bilstatus`
--
ALTER TABLE `bilstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tilføj AUTO_INCREMENT i tabel `forhandler`
--
ALTER TABLE `forhandler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tilføj AUTO_INCREMENT i tabel `kommentar`
--
ALTER TABLE `kommentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tilføj AUTO_INCREMENT i tabel `kommentarstatus`
--
ALTER TABLE `kommentarstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tilføj AUTO_INCREMENT i tabel `rettigheder`
--
ALTER TABLE `rettigheder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tilføj AUTO_INCREMENT i tabel `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Begrænsninger for dumpede tabeller
--

--
-- Begrænsninger for tabel `administration`
--
ALTER TABLE `administration`
  ADD CONSTRAINT `administration_ibfk_1` FOREIGN KEY (`rettigheder`) REFERENCES `rettigheder` (`id`);

--
-- Begrænsninger for tabel `biler`
--
ALTER TABLE `biler`
  ADD CONSTRAINT `biler_ibfk_1` FOREIGN KEY (`type`) REFERENCES `type` (`id`),
  ADD CONSTRAINT `biler_ibfk_2` FOREIGN KEY (`forhandler`) REFERENCES `forhandler` (`id`),
  ADD CONSTRAINT `biler_ibfk_3` FOREIGN KEY (`status`) REFERENCES `bilstatus` (`id`);

--
-- Begrænsninger for tabel `forhandler`
--
ALTER TABLE `forhandler`
  ADD CONSTRAINT `forhandler_ibfk_1` FOREIGN KEY (`rettighedder`) REFERENCES `rettigheder` (`id`);

--
-- Begrænsninger for tabel `kommentar`
--
ALTER TABLE `kommentar`
  ADD CONSTRAINT `kommentar_ibfk_1` FOREIGN KEY (`bilID`) REFERENCES `biler` (`id`),
  ADD CONSTRAINT `kommentar_ibfk_2` FOREIGN KEY (`status`) REFERENCES `kommentarstatus` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
