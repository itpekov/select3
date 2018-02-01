SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `task1` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `task1`;

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `id_country` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `city` (`id`, `id_country`, `name`) VALUES
(1, 1, 'Абакан'),
(2, 1, 'Черногорск'),
(3, 1, 'Минусинск'),
(4, 2, 'Токио'),
(5, 2, 'Осака'),
(6, 2, 'Киото'),
(7, 3, 'Маями'),
(8, 3, 'Даллас'),
(9, 3, 'Сиэтл'),
(10, 4, 'Сидней'),
(11, 4, 'Мельбурн'),
(12, 4, 'Брисбан');

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'Россия'),
(2, 'Япония'),
(3, 'США'),
(4, 'Австралия');

CREATE TABLE `hotel` (
  `id` int(11) NOT NULL,
  `id_city` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `hotel` (`id`, `id_city`, `name`) VALUES
(1, 1, 'Абакан1'),
(2, 1, 'Абакан2'),
(3, 1, 'Абакан3'),
(4, 2, 'Ч1'),
(5, 2, 'Ч2'),
(6, 2, 'Ч3'),
(7, 3, 'М1'),
(8, 3, 'М2'),
(9, 3, 'М3'),
(10, 4, 'Токио1'),
(11, 4, 'Токио2'),
(12, 4, 'Токио3'),
(13, 5, 'Осака1'),
(14, 5, 'Осака2'),
(15, 5, 'Осака3'),
(16, 6, 'Киото1'),
(17, 6, 'Киото2'),
(18, 6, 'Киото3'),
(19, 7, 'Маями1'),
(20, 7, 'Маями2'),
(21, 7, 'Маями3'),
(22, 8, 'Даллас1'),
(23, 8, 'Даллас2'),
(24, 8, 'Даллас3'),
(25, 9, 'Сиэтл1'),
(26, 9, 'Сиэтл2'),
(27, 9, 'Сиэтл3'),
(28, 10, 'Сидней1'),
(29, 10, 'Сидней2'),
(30, 10, 'Сидней3'),
(31, 11, 'Мельбурн1'),
(32, 11, 'Мельбурн2'),
(33, 11, 'Мельбурн3'),
(34, 12, 'Брисбан1'),
(35, 12, 'Брисбан2'),
(36, 12, 'Брисбан3');


ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
