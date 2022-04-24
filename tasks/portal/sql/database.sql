SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
-- --------------------------------------------------------

--
-- Структура таблицы `users_info`
--

CREATE TABLE `users_info` (
  `id` int UNSIGNED NOT NULL,
  `login` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `card` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `users_posts`
--

CREATE TABLE `users_posts` (
  `id` int UNSIGNED NOT NULL,
  `post` text CHARACTER SET utf8 COLLATE utf8_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `users_info` (`id`, `login`, `password`, `card`) VALUES
(1, 'John(admin)', 'hguerhg@!r32hf2buJHfe', 'flag{5ucc3ssfu1_1d0r}');
INSERT INTO `users_info` (`id`, `login`, `password`, `card`) VALUES
(2, 'Sam', 'oijrgoih34g234', '8555944938695745');
INSERT INTO `users_info` (`id`, `login`, `password`, `card`) VALUES
(3, 'Kyle', 'gh34u9ht34g3', '8555344950695745');
INSERT INTO `users_info` (`id`, `login`, `password`, `card`) VALUES
(4, 'Tyrell', 'wellik_lol', '7685940687956476');
INSERT INTO `users_info` (`id`, `login`, `password`, `card`) VALUES
(5, 'Jean', 'Hg984gh394gh', '7685037584967415');
INSERT INTO `users_info` (`id`, `login`, `password`, `card`) VALUES
(6, 'Lina', 'regoih8RHG9H389', '1859301285641305');
INSERT INTO `users_info` (`id`, `login`, `password`, `card`) VALUES
(7, 'Elliot', 'EEfhrugbregu!@f1f171Fbu1#!', '4856127560947357');

INSERT INTO `users_posts` (`id`, `post`) VALUES
(1, 'flag{gh3487gh384g38348g}');
INSERT INTO `users_posts` (`id`, `post`) VALUES
(1, 'here you can write posts, as well as see the posts of your colleagues');
INSERT INTO `users_posts` (`id`, `post`) VALUES
(5, 'My avatar has been randomly changing lately, has anyone encountered a similar problem?');
INSERT INTO `users_posts` (`id`, `post`) VALUES
(4, 'hello everyone this is my first post');
INSERT INTO `users_posts` (`id`, `post`) VALUES
(6, 'pwn');
INSERT INTO `users_posts` (`id`, `post`) VALUES
(2, 'Hello everyone I wrote an article about Ballmers peak, you can read it on Portfolio tab :)');
INSERT INTO `users_posts` (`id`, `post`) VALUES
(6, 'What?! I didnt post this');

--
-- Индексы таблицы `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `users_posts`
--
ALTER TABLE `users_posts`
  ADD KEY `id_2` (`id`);

--
-- AUTO_INCREMENT для таблицы `users_info`
--
ALTER TABLE `users_info`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `users_posts`
--
ALTER TABLE `users_posts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
