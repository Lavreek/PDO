Структура каталога сайта:

	__modal:
		PDO: - Каталог управления базой данных
			SQLDatabase - Взаимодействие с базой данных.
			SQLInterface - Настройки подключения к базе данных.
			SQLController - Контроль над созданием и удалением базы данных.

		Database.php - Управление базой данных.
		DatabaseHandler.php - Создание и удаление базы данных.
		Settings.php - Настройки подключения к базе данных.
		Request.php - Обращение к базе данных.

	_bootstrap:
		css - стили сайта (bootstrap).
		js - скрипты сайта (bootstrap).
		readme.txt - информационый файл о версии.

	_construct:
		Файлы игры о голубе.

	_images:
		Картинки используемые на сайте.

	_package:
		templates:
			assets:
				header:
					header.php - Управляющий файл тега <header>.
					header.html - Визуальная часть <header>.
				footer:
					footer.php - Управляющий файл тега <footer>.
					header.html - Визуальная часть <footer>.

			auth:
				- Тело страницы авторизации.
			change:
				assets:
					password.html - Визуальная часть изменения пароля.
					profile.html - Визуальная часть изменения профиля.
				- Тело страницы изменения данных.
			game:
				- Тело страницы игры.
			home:
				- Тело главной страницы.
			logout:
				- Тело страницы выхода из профиля.
			profile:
				- Тело страницы профиля.
			register:
				- Тело страницы регистрации.

			index.php - Основной шаблон страницы сайта.

	_scripts:
		- Каталог содержащий код js подключённый к сайту.
	_styles:

	auth: (Каталог)
		- Авторизация.

	change: (Каталог)
		- Изменение

	database: (Каталог)
		database.php - Работа с базой данных (Создание, удаление базы / Создание, удаление схемы / Создание, удаление таблиц).
		databaseuse.php - Функции обработки пользователей.

	game: (Каталог)
		- Игра.

	home: (Каталог)
		- Главная страница.

	logout: (Каталог)
		- Выход из профиля.

	profile: (Каталог)
		- Профиль.

	register: (Каталог)
		- Регистрация.

	users: (Каталог)
		-Пользователи.

	index.php - Корневой файл сайта, способствует перемещению в домашнюю страницу (/home/)

SQL:
	SELECT - ВЫБРАТЬ.
	* - все поля.
	FROM - ИЗ.
	WHERE - ГДЕ.
	CREATE - СОЗДАТЬ.
	DATABASE - БАЗА ДАННЫХ.
	IF EXISTS / IF NOT EXISTS - ЕСЛИ СУЩЕСТВУЕТ / ЕСЛИ НЕ СУЩЕСТВУЕТ.
	DROP - УДАЛИТЬ.
	INSERT INTO - ВСТАВИТЬ В.
	VALUES - ЗНАЧЕНИЯ.
	UPDATE - ОБНОВИТЬ.
	SET - УСТАНОВИТЬ ЗНАЧЕНИЕ.
	ORDER BY <TABLE_FIELD> ASC / DESC - СОРТИРОВАТЬ ПО <ПОЛЮ> ПО ВОЗРАСТАНИЮ / ПО УБЫВАНИЮ.
	LIMIT - КОЛИЧЕСТВО ЗАПИСЕЙ.

FTP:
	WinSCP - Приложение позволяющее установить ftp соединение с сервером.
	FileZila Client - Приложение позволяющее установить ftp соединение с сервером.

Текстовый редактор:
	Sublime Text 3 - текстовый редактор с возможностью использования шаблонов синтаксиса языка.

Локальный веб-сервер:
	XAMPP - бесплатный локальный сервер apache с предустановленой СУБД MySQL (phpmyadmin)
	PostgreSQL - бесплатный локальный сервер postgree с менеджером СУБД pgAdmin

Git: - Приложение отслеживания изменений.
	git init - Создание git'а
	git add <расположение> - Добавление файлов к комиту
	git commit - Комментарии к файловым обновлениям.
		*git commit -am "Commit!"*
	git push - Отправка изменений в удалённый репозиторий

Heroku Git:
	heroku login - подключение к Heroku
	heroku git:remote -a <app> - Выбор установленного приложения
		*heroku git:remote -a pegionlife*
	git push heroku <branch> - Отправка изменений в репозиторий heroku
		*git push heroku master*

Heroku PostgreSQL: - Бесплатное дополнение к приложению Heroku
	Создание базы данных PgSQL:
		heroku addons:create heroku-postgresql:hobby-dev -a <app>
			- Создание Add-on для приложения heroku.
		heroku addons:destroy heroku-postgresql:hobby-dev -a <app>
			- Удаление Add-on для приложения heroku.