-----СОЗДАНИЕ ТАБЛИЦ-----

--создание таблицы `languages`, где хранится информация о языках, на которых написаны книги--
CREATE TABLE IF NOT EXISTS `languages` (
	`id` INT(10) NOT NULL  AUTO_INCREMENT, 
	`language` CHAR(2) NOT NULL, --название языков в формате 'en','ru','cn'
	`created_at` TIMESTAMP NOT NULL,
	PRIMARY KEY (`id`) 
);

--создание таблицы `publishing_houses`, где хранится список издательств-- 
CREATE TABLE IF NOT EXISTS `publishing_houses` (
	`id` INT(10) NOT NULL  AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL, --название издательств
	PRIMARY KEY (`id`)
);

--создание таблицы `publishing_houses` с жанрами книг-- 
CREATE TABLE IF NOT EXISTS `genres` (
	`id_genre` INT(10) NOT NULL  AUTO_INCREMENT,
	`genre` VARCHAR(255) NOT NULL, --название жанры
	`created_at` TIMESTAMP NOT NULL,
	PRIMARY KEY (`id_genre`)
);

--создание таблицы `sales`, где хранится информация о продажах магазина--
CREATE TABLE IF NOT EXISTS `sales` (
	`id_sales` INT(10) NOT NULL  AUTO_INCREMENT,
	`date` DATE NOT NULL, --дата продажи
	`time` TIME NOT NULL, --время продажи
	`id_book` VARCHAR(255) NOT NULL, --id-номер книги, которую продали
	`count_book` INT(10)  NOT NULL, --колчество проданых книг
	`id_price` INT(10)  NOT NULL, --id-номер цены,  за которую продали книгу
	`created_at` TIMESTAMP NOT NULL,
	PRIMARY KEY (`id_sales`),
	KEY `id_book` (`id_book`),
	KEY `id_price` (`id_price`)
);

--создание таблицы `sales`, где хранится информация о поставках книг в магазин--
CREATE TABLE IF NOT EXISTS `deliveries` (
	`id` INT(10) NOT NULL  AUTO_INCREMENT,
	`id_book` INT(10) NOT NULL, --id-номер книги, которую привезли
	`id_prov` INT(10) NOT NULL,	--id-номер поставщика, который осуществил поставку
	`count_book` SMALLINT(10) NOT NULL, --количество поставленных книг
	`date` DATE NOT NULL, --дата поставки
	`created_at` TIMESTAMP NOT NULL,
	PRIMARY KEY (`id`),
	KEY `id_book` (`id_book`), --ключ для более легкого поиска 
	KEY `id_prov` (`id_prov`) --ключ для более легкого поиска 
); 

--создание таблицы `books`, где хранится информация книгах в магазине--
CREATE TABLE IF NOT EXISTS `books` (
	`id_book` INT(10) NOT NULL AUTO_INCREMENT, 
	`name_book` VARCHAR(255) NOT NULL, --название книги
	`year` SMALLINT(4) NOT NULL, --год выпуска книги
	`author` VARCHAR(255) NOT NULL, --автор книги
	`id_publ` INT(10) NOT NULL, --id-номер издательства
	`id_lang` CHAR(2) NOT NULL, --id-номер языка
	`id_price` INT(10) NOT NULL, --id-номер цены
	`pages` SMALLINT(10) NOT NULL, --количество страниц
	`created_at` TIMESTAMP NOT NULL,
	PRIMARY KEY (`id_book`),
	KEY `id_publ` (`id_publ`), --ключ для более легкого поиска 
	KEY `id_price` (`id_price`), --ключ для более легкого поиска 
	KEY `id_lang` (`id_lang`) --ключ для более легкого поиска 
);

--создание таблицы `genres_books` поможет нам для осуществления связи (многие-ко-многим) между двумя таблицами `books` и `genres` 
CREATE TABLE IF NOT EXISTS `genres_books` (
	`id_book` INT(10) NOT NULL, --id-номер книги
	`id_genre` INT(10) NOT NULL, --id-номер жанра
	PRIMARY KEY (`id_book`,`id_genre`),
	KEY `id_book` (`id_book`), --ключ для более легкого поиска 
	KEY `id_genre` (`id_genre`) --ключ для более легкого поиска 
);

--создание таблицы `prices`, где хранится информация о ценах на книги в магазине
CREATE TABLE IF NOT EXISTS `prices` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`price` FLOAT(10) NOT NULL, --значение цены
	PRIMARY KEY (`id`)
);

--создание `providers`, где содержися список поставщиков, осуществляющих поставку книг в магахин
CREATE TABLE IF NOT EXISTS `providers` (
	`id` INT(10) NOT NULL  AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL, --название фирмы, занимающиеся поставкой
	`address` VARCHAR(255) NOT NULL, -- адресс фирмы
	`phone` VARCHAR(255) NOT NULL, -- телефон фирмы
	`email` VARCHAR(255) NOT NULL, --электронный адрес фирмы
	PRIMARY KEY (`id`)
);


-----СОЗДАНИЕ ПРЕДСТАВЛЕНИЯ-----

--создания представления `info`, где хранится базовая инфрмация о книге
CREATE VIEW `info` AS 
SELECT
`b`.`name_book`, --название книги
`pub`.`name` `name_publ`, --название издательства
`b`.`pages`, --количество страниц
`p`.`price`, --цена за книгу
`lang`.`language` --язык книги
FROM `books` `b` --выбор из таблицы `books`
JOIN `publishing_houses` `pub` ON `b`.`id_publ`=`pub`.`id` --объединяем таблицы `books` и `publishing_houses`
JOIN `prices` `p` ON `b`.`id_price`=`p`.`id` --объединяем таблицы `books` и `prices`
JOIN `languages` `lang` ON `b`.`id_lang`=`lang`.`id` --объединяем таблицы `books` и `languages`
ORDER BY `b`.`name_book`; --сортировка по названию книги

CREATE VIEW `book_info` AS
SELECT
`b`.`name_book`, --название книги
`b`.`year`, --год издания
`b`.`author`, --автор книги 
GROUP_CONCAT(`g`.`genre`) as `genres_book` -- сконкатенированные данные столбца `g`.`genre`
FROM `books` `b` --выбор из таблицы `books`
JOIN `genres_books` `gb` ON `b`.`id`=`gb`.`id_book` --объединяем таблицы `books` и `genres`
JOIN `genres` `g` ON `g`.`id_genre`=`gb`.`id_genre` --объединяем таблицы `genres` и `genres_books`
GROUP BY  `b`.`name_book`; --сортировка по названию книги