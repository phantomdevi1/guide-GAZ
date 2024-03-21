-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Мар 14 2024 г., 10:25
-- Версия сервера: 8.0.30
-- Версия PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gazprom_guide`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin_info`
--

CREATE TABLE `admin_info` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Дамп данных таблицы `admin_info`
--

INSERT INTO `admin_info` (`id`, `name`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `guide`
--

CREATE TABLE `guide` (
  `id` int NOT NULL,
  `FIO` varchar(255) NOT NULL,
  `post` varchar(255) NOT NULL,
  `division` varchar(255) NOT NULL,
  `phone` varchar(18) NOT NULL,
  `office` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `img` varchar(255)  DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Дамп данных таблицы `guide`
--

INSERT INTO `guide` (`id`, `FIO`, `post`, `division`, `phone`, `office`, `mail`, `img`) VALUES
(1, 'Иванов Иван Иванович', 'Генеральный директор', 'Главное управление', '123-456-789', '101', 'ivanov@gazprom.ru', 'img/ava/ivanov.jpg'),
(2, 'Петров Петр Петрович', 'Заместитель генерального директора', 'Главное управление', '987-654-321', '102', 'petrov@gazprom.ru', 'img/ava/petrov.jpg'),
(3, 'Сидоров Сидор Сидорович', 'Начальник отдела продаж', 'Отдел продаж', '456-789-123', '201', 'sidorov@gazprom.ru', NULL),
(4, 'Николаев Николай Николаевич', 'Заместитель начальника отдела продаж', 'Отдел продаж', '789-123-456', '202', 'nikolaev@gazprom.ru', NULL),
(5, 'Кузнецова Елена Владимировна', 'Начальник отдела по закупкам', 'Отдел закупок', '321-654-987', '301', 'kuznetsova@gazprom.ru', NULL),
(6, 'Александров Александр Александрович', 'Главный инженер', 'Отдел закупок', '654-987-321', '302', 'aleksandrov@gazprom.ru', NULL),
(7, 'Михайлов Михаил Михайлович', 'Финансовый директор', 'Финансовый отдел', '789-321-654', '401', 'mikhailov@gazprom.ru', 'img/ava/mikhailov.jpg'),
(8, 'Егоров Егор Егорович', 'Заместитель финансового директора', 'Финансовый отдел', '456-321-987', '402', 'egorov@gazprom.ru', NULL),
(9, 'Андреев Андрей Андреевич', 'Начальник отдела технического обслуживания', 'Отдел технического обслуживания', '123-987-654', '501', 'andreev@gazprom.ru', NULL),
(10, 'Федоров Федор Федорович', 'Заместитель начальника отдела технического обслуживания', 'Отдел технического обслуживания', '987-654-123', '502', 'fedorov@gazprom.ru', NULL),
(11, 'Олегов Олег Олегович', 'Начальник отдела маркетинга', 'Отдел маркетинга', '321-987-654', '601', 'olegov@gazprom.ru', NULL),
(12, 'Григорьев Григорий Григорьевич', 'Заместитель начальника отдела маркетинга', 'Отдел маркетинга', '654-321-987', '602', 'grigoriev@gazprom.ru', NULL),
(13, 'Анастасьева Анастасия Александровна', 'Главный бухгалтер', 'Бухгалтерия', '789-123-654', '701', 'anastasia@gazprom.ru', 'img/ava/anastasia.jpg'),
(14, 'Дмитриев Дмитрий Дмитриевич', 'Заместитель главного бухгалтера', 'Бухгалтерия', '987-321-654', '702', 'dmitriev@gazprom.ru', NULL),
(15, 'Артемов Артем Артемович', 'Начальник отдела юридического сопровождения', 'Юридический отдел', '123-654-987', '801', 'artemov@gazprom.ru', NULL),
(16, 'Владимиров Владимир Владимирович', 'Заместитель начальника отдела юридического сопровождения', 'Юридический отдел', '654-123-987', '802', 'vladimirov@gazprom.ru', NULL),
(17, 'Сергеев Сергей Сергеевич', 'Начальник отдела безопасности', 'Отдел безопасности', '321-654-123', '901', 'sergeev@gazprom.ru', NULL),
(18, 'Игорев Игорь Игоревич', 'Заместитель начальника отдела безопасности', 'Отдел безопасности', '654-987-321', '902', 'igorev@gazprom.ru', NULL),
(19, 'Алексеев Алексей Алексеевич', 'Начальник отдела кадров', 'Отдел кадров', '789-321-456', '1001', 'alekseev@gazprom.ru', NULL),
(20, 'Степанов Степан Степанович', 'Заместитель начальника отдела кадров', 'Отдел кадров', '987-456-321', '1002', 'stepanov@gazprom.ru', NULL),
(21, 'Елисеева Елизавета Евгеньевна', 'PR-менеджер', 'Отдел PR', '123-456-789', '1101', 'eliseeva@gazprom.ru', NULL),
(22, 'Антонов Антон Антонович', 'Заместитель PR-менеджера', 'Отдел PR', '456-789-123', '1102', 'antonov@gazprom.ru', NULL),
(23, 'Никитин Никита Никитич', 'Специалист по информационным технологиям', 'Отдел IT', '789-123-456', '1201', 'nikitin@gazprom.ru', NULL),
(24, 'Денисов Денис Денисович', 'Заместитель специалиста по информационным технологиям', 'Отдел IT', '987-654-321', '1202', 'denisov@gazprom.ru', NULL),
(25, 'Марина Маринина Мариновна', 'Менеджер по связям с общественностью', 'Отдел связи с общественностью', '123-987-654', '1301', 'marina@gazprom.ru', NULL),
(26, 'Панков Панк Панкович', 'Главный уборщик', 'Клиннинг', '553', '-', 'uborchik@gazprom.ru', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int NOT NULL,
  `date` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `date`, `title`, `content`) VALUES
(1, '2024-02-16', 'Первая новость', 'Это первая новость в нашем справочнике.'),
(2, '2024-02-15', 'Вторая новость', 'Это вторая новость в нашем справочнике.'),
(3, '2024-02-19', 'Третья новость', 'Третья новость'),
(4, '2024-02-16', 'Новая новость', 'Очень важно читать все новые новости'),
(5, '2024-02-16', 'нвая новость 2', 'нвая новость 2'),
(6, '2024-03-13', 'Новая новость 3', '3');

-- --------------------------------------------------------

--
-- Структура таблицы `slides`
--

CREATE TABLE `slides` (
  `id` int NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Дамп данных таблицы `slides`
--

INSERT INTO `slides` (`id`, `image_path`, `title`) VALUES
(1, 'img\\slider_up\\first.png', 'гололёд'),
(2, 'img\\slider_up\\second.png', 'зарядка для глаз'),
(3, 'img\\slider_up\\third.png', 'зарядка для тела'),
(4, 'img\\slider_up\\four.png', 'экстренные службы');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `guide`
--
ALTER TABLE `guide`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `guide`
--
ALTER TABLE `guide`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
