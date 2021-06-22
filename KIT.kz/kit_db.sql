-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 14 2021 г., 08:20
-- Версия сервера: 8.0.22
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kit_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `com_id` int NOT NULL,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `user_id_of_com` int NOT NULL,
  `comment` text NOT NULL,
  `author_Fname` varchar(255) NOT NULL,
  `author_Lname` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`com_id`, `post_id`, `user_id`, `user_id_of_com`, `comment`, `author_Fname`, `author_Lname`, `date`) VALUES
(1, 25, 1, 1, 'sdfsdfs', 'Saken', 'Satenov', '2021-04-24 22:28:47'),
(3, 25, 1, 1, 'hello', 'Saken', 'Satenov', '2021-04-25 01:16:51'),
(4, 25, 1, 1, 'привет', 'Saken', 'Satenov', '2021-04-25 01:19:53'),
(8, 25, 1, 1, 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem ыфлут', 'Saken', 'Satenov', '2021-04-25 01:23:45'),
(10, 23, 1, 1, 'найс', 'Saken', 'Satenov', '2021-04-25 01:27:03'),
(11, 25, 1, 1, 'dsaf', 'Saken', 'Satenov', '2021-04-25 17:12:29'),
(12, 25, 1, 1, 'fdsjfls fjlkds jflkdsjlfjsfoiejw fjiejflkdsoif ewjifjdsjflkds ofewoi jfdks fjoisdjfisdjfoi jfoijdslkjfkldsjfoiew jfkdsjfkloirhegoirnvjd foienrlkqvuihref fhoiuh4efkjdhf uehfoiuhyewfiu43 f', 'Saken', 'Satenov', '2021-04-25 17:12:47'),
(13, 25, 1, 1, 'sdfdsf\r\ndsfds\r\nsdfdsf', 'Saken', 'Satenov', '2021-04-25 17:13:17'),
(14, 42, 4, 5, 'Hi Mark. I think its a bad idea, because you have already so much social networks. Why do you need them?? You are being a monopolist', 'Ilon', 'Musk', '2021-04-25 18:23:45'),
(15, 40, 3, 5, 'hi\r\n', 'Ilon', 'Musk', '2021-04-25 18:24:33'),
(16, 42, 4, 1, 'fsdfsfew', 'Saken', 'Satenov', '2021-04-25 18:38:48'),
(17, 40, 3, 1, 'hehe', 'Saken', 'Satenov', '2021-04-25 19:01:10'),
(18, 41, 2, 6, 'You know nothing John Snow...', 'Ygritte', 'Wild', '2021-04-25 19:15:06'),
(19, 42, 4, 1, 'fdsfds', 'Saken', 'Satenov &#10003;', '2021-04-25 21:22:27'),
(24, 43, 5, 1, 'fdfdfd', 'Saken', 'Satenov ✓', '2021-04-30 22:24:20'),
(25, 43, 5, 1, 'sdfdsfsd', 'Saken', 'Satenov ✓', '2021-04-30 22:24:26'),
(26, 43, 5, 1, 'sdfsdfsda', 'Saken', 'Satenov ✓', '2021-04-30 22:24:30'),
(27, 43, 5, 1, 'fdsf', 'Saken', 'Satenov ✓', '2021-04-30 22:32:00'),
(28, 23, 1, 1, 'dsfdsf', 'Saken', 'Satenov ✓', '2021-04-30 22:41:30'),
(29, 55, 1, 1, 'good', 'Saken', 'Satenov ✓', '2021-04-30 23:06:08'),
(31, 43, 5, 1, 'good', 'Saken', 'Satenov ✓', '2021-05-06 10:49:09'),
(32, 23, 1, 5, 'cool\r\n', 'Ilon', 'Musk &#10003;', '2021-05-07 06:09:17'),
(33, 62, 5, 1, 'congratulations!!!', 'Saken', 'Satenov ✓', '2021-05-07 06:10:35'),
(34, 43, 5, 1, 'fewfe', 'Saken', 'Satenov ✓', '2021-05-07 07:30:48');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `name`, `upload_date`, `author_id`) VALUES
(11, 'harry.jpg.649035405', '2021-05-13 15:39:52', 1),
(13, 'john.png.469427440', '2021-05-13 15:40:19', 1),
(15, 'my_profile.png.853458725', '2021-05-13 19:49:29', 1),
(16, 'ygritte.jpg.91981914', '2021-05-13 19:49:39', 1),
(17, 'ilon.jpg.752801714', '2021-05-13 19:49:49', 1),
(18, '002.jpg.558292098', '2021-05-13 19:49:56', 1),
(19, 'me.jpg.31740643', '2021-05-13 19:51:19', 1),
(20, 'bmw-2019-manhart-mh5-800-m5-f90-sedan-peredniaia-chast-v8-bi.jpg.647320967', '2021-05-13 20:32:38', 1),
(21, 'maxresdefault.jpg.342735463', '2021-05-13 20:34:12', 1),
(22, 'harry.jpg.770731490', '2021-05-14 04:33:49', 1),
(23, 'mark.jpg.615671521', '2021-05-14 05:13:04', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `post_content` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `upload_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_like` int NOT NULL DEFAULT '0',
  `post_com` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_content`, `upload_image`, `post_date`, `post_like`, `post_com`) VALUES
(4, 1, 'Hello Saken!', '002.jpg.878886924', '2021-04-23 22:52:24', 0, 0),
(23, 1, NULL, 'me.jpg.469441235', '2021-04-24 15:37:56', 0, 3),
(25, 1, 'edit me (edited!)&#128512', NULL, '2021-04-24 17:53:34', 0, 7),
(33, 1, 'hi there? whats up?? this is Almaty...', 'IMG_20190905_163624.jpg.710281613', '2021-04-25 17:30:32', 0, 0),
(40, 3, 'hi from Hogwarts ', NULL, '2021-04-25 18:05:13', 0, 2),
(41, 2, 'I know everything...!!!', NULL, '2021-04-25 18:07:06', 0, 1),
(42, 4, 'Well, I think I will buy your Social network. Here we go again....', NULL, '2021-04-25 18:16:09', 3, 3),
(43, 5, NULL, '275840.jpg.219562457', '2021-04-26 01:03:35', 1, 6),
(55, 1, 'finally finished )) !!', NULL, '2021-04-29 23:15:56', 2, 1),
(59, 1, NULL, '004.jpg.682005287', '2021-05-06 04:58:14', 2, 0),
(62, 5, 'hi hello i did like system', NULL, '2021-05-07 06:01:28', 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `post_likes`
--

CREATE TABLE `post_likes` (
  `like_id` int NOT NULL,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `post_likes`
--

INSERT INTO `post_likes` (`like_id`, `post_id`, `user_id`) VALUES
(224, 55, 1),
(225, 59, 1),
(226, 42, 1),
(227, 62, 5),
(228, 59, 5),
(229, 42, 5),
(230, 43, 5),
(231, 62, 2),
(232, 55, 2),
(233, 42, 2),
(235, 62, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `f_name` text NOT NULL,
  `l_name` text NOT NULL,
  `user_name` text NOT NULL,
  `describe_user` varchar(255) NOT NULL,
  `relationship` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_city` text NOT NULL,
  `user_gender` text NOT NULL,
  `user_birthday` text NOT NULL,
  `user_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'my_profile.png',
  `user_reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` text NOT NULL,
  `posts` text NOT NULL,
  `recovery_acc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `images_count` int NOT NULL DEFAULT '0',
  `videos_count` int DEFAULT '0',
  `posts_count` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `f_name`, `l_name`, `user_name`, `describe_user`, `relationship`, `user_pass`, `user_email`, `user_city`, `user_gender`, `user_birthday`, `user_image`, `user_reg_date`, `status`, `posts`, `recovery_acc`, `images_count`, `videos_count`, `posts_count`) VALUES
(1, 'Saken', 'Satenov ✓', 'saken_satenov', 'Sometimes &quot;later&quot; becomes &quot;never&quot;...', 'Not married', '88888888', 'sakensaten1409@gmail.com', 'Shymkent', 'Male', '2002-09-14', 'me.jpg.791780247', '2021-04-19 22:55:46', 'verified', 'yes', 'baha', 11, 2, 6),
(2, 'John', 'Snow', 'john_snow', 'Hello World! ... (this is my default status)', 'Not specified', '99999999', 'johnsnow@gmail.com', 'Nur-Sultan (Astana)', 'Male', '1983-03-21', 'john.png.820859676', '2021-04-24 16:37:56', 'verified', 'yes', 'sake', 0, 0, 1),
(3, 'Harry', 'Potter', 'harry_potter', 'Hello World! ... (this is my default status)', 'Not specified', '99999999', 'harrypotter@gmail.com', 'Atyrau', 'Male', '1994-06-24', 'harry.jpg.469332487', '2021-04-25 17:55:50', 'verified', 'yes', 'Thehardestistostart!', 0, 0, 1),
(4, 'Mark', 'Zuckerberg', 'mark_zuckerberg', 'Hello World! ... (this is my default status)', 'Not specified', '99999999', 'mark@gmail.com', 'Pavlodar', 'Male', '1986-07-15', 'mark.jpg.607669242', '2021-04-25 18:08:57', 'verified', 'yes', 'Thehardestistostart!', 0, 0, 1),
(5, 'Ilon', 'Musk &#10003;', 'ilon_musk', 'Hello World! ... (this is my default status)', 'Not specified', '99999999', 'ilonmusk@gmail.com', 'Almaty', 'Male', '1975-11-23', 'ilon.jpg.120621198', '2021-04-25 18:17:21', 'verified', 'yes', 'Thehardestistostart!', 0, 0, 2),
(6, 'Ygritte', 'Wild', 'ygritte_wild', 'Hello World! ... (this is my default status)', 'Not specified', '99999999', 'ygritte@gmail.com', 'Taraz (Zhambyl)', 'Female', '1987-03-08', 'ygritte.jpg.577503517', '2021-04-25 19:06:16', 'verified', 'no', 'Thehardestistostart!', 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user_messages`
--

CREATE TABLE `user_messages` (
  `id` int NOT NULL,
  `user_to` int NOT NULL,
  `user_from` int NOT NULL,
  `msg_body` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `msg_seen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_messages`
--

INSERT INTO `user_messages` (`id`, `user_to`, `user_from`, `msg_body`, `date`, `msg_seen`) VALUES
(10, 5, 1, 'Hi Ilon Musk, how are u?', '2021-04-26 14:44:09', 'no'),
(11, 5, 1, 'what is up??', '2021-04-26 14:44:30', 'no'),
(12, 5, 1, 'jdskfljsdlkjf jksdjflkjds fjfoiewpoqvkdsl regfkefoi peoi4qfkdslfklds jffjoirew jifoewpfs okfjoire hfok fksjf oiew foiewfoiew qnfei', '2021-04-26 14:48:20', 'no'),
(16, 5, 1, 'Повседневная практика показывает, что постоянное информационно-пропагандистское обеспечение нашей деятельности играет важную роль в формировании систем', '2021-04-26 14:56:38', 'no'),
(17, 5, 1, 'Таким образом постоянный количественный рост и сфера нашей активности обеспечивает широкому кругу (специалистов) участие в формировании направлений прогрессивного развития. ', '2021-04-26 14:56:57', 'no'),
(18, 5, 1, 'как тебе такое Илон Маск??', '2021-04-26 14:57:13', 'no'),
(19, 1, 5, 'Woow Saken, I am pretty good, how are you? ', '2021-04-26 14:58:44', 'no'),
(20, 1, 5, 'what is going on our project? ', '2021-04-26 14:59:32', 'no'),
(21, 1, 5, 'Проект очень мне понравилось I liked it!! wow', '2021-04-26 15:00:16', 'no'),
(22, 5, 1, 'Супер!', '2021-04-26 15:01:12', 'no'),
(23, 5, 1, 'Как насчет встречи в воскресенье в Нью-Йорке?', '2021-04-26 15:02:11', 'no'),
(24, 5, 1, 'fdwfdw', '2021-04-28 15:53:13', 'no'),
(25, 5, 1, 'test\r\n', '2021-04-28 15:56:58', 'no'),
(26, 5, 1, 'fdsf', '2021-04-28 16:06:12', 'no'),
(27, 5, 1, 'fe', '2021-04-28 16:07:13', 'no'),
(28, 5, 1, 'fsd', '2021-04-28 16:07:20', 'no'),
(29, 5, 1, 'test', '2021-04-28 16:10:51', 'no'),
(30, 5, 1, 'dgd', '2021-04-29 12:21:38', 'no'),
(31, 1, 5, 'kjk.', '2021-04-29 12:24:24', 'no'),
(32, 4, 1, 'hi friend', '2021-04-30 13:09:48', 'no'),
(33, 4, 1, 'test5', '2021-05-06 10:50:10', 'no');

-- --------------------------------------------------------

--
-- Структура таблицы `videos`
--

CREATE TABLE `videos` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `videos`
--

INSERT INTO `videos` (`id`, `name`, `upload_date`, `author_id`) VALUES
(5, 'nature2.mp4.209301148', '2021-05-13 23:30:33', 1),
(6, 'nature3.mp4.847984', '2021-05-13 23:30:45', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Индексы таблицы `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`like_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `user_messages`
--
ALTER TABLE `user_messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT для таблицы `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `like_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `user_messages`
--
ALTER TABLE `user_messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
