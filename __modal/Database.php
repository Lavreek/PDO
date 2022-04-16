<?php
	include __DIR__."/settings.php";

	include __DIR__."/PDO/MySQLDatabase.php";
	include __DIR__."/PDO/PgSQLDatabase.php";

	class DataBase implements Settings
	{
		private $env;

		private $driver;

		function __construct() {
			if (Settings::settings['driver'] == "mysql")
			{
				$this->driver = new MySQLDatabase("mysql");
				$this->env = $this->driver->getEnvArray();
			}
			elseif (Settings::settings['driver'] == "pgsql")
			{
				$this->driver = new PgSQLDatabase("pgsql");
				$this->env = $this->driver->getEnvArray();
			}
			else
			{
				throw new Exception("Wrong driver selected use \"mysql\" or \"pgsql\"");
				die();
			}
		}

		public function getParam($param)
		{
			return $this->$param;
		}

		public function connection() // ФУНКЦИЯ ПОДКЛЮЧЕНИЯ К БАЗЕ ДАННЫХ
		{
			$query = $this->env['driver'].":host=".$this->env['host'].";port=".$this->env['port'].";dbname=".$this->env['database'].";";
			$connection = new PDO($query, $this->env['user'], $this->env['password']);

			return $connection;
		}

		public function getUsers() // ФУНКЦИЯ КОТОРАЯ ПОЛУЧАЕТ ВСЕ ПРОФИЛИ
		{
			$connection = $this->connection();

			$users = $this->driver->getUsers($connection);

			$connection = null;

			return $users;
		}

		public function getUser($email = "test@test", $password = "123") // ФУНКЦИЯ КОТОРАЯ ПОЛУЧАЕТ ВЫБОРОЧНЫЙ ПРОФИЛЬ
		{
			$connection = $this->connection();

			$user = $this->driver->getUser($connection, $email, $password);

			$connection = null;
			
			return $user;
		}

		public function createUser($email = "test@test2", $password = "123") // ФУНКЦИЯ КОТОРАЯ СОЗДАЁТ ПРОФИЛЬ
		{
			$connection = $this->connection();

			$new = $this->driver->createUser($connection, $email, $password);

			$connection = null;

			return $new;
		}

		public function updateUser($id = 1, $column = "email", $value = "newtest@test")
		{
			$connection = $this->connection();

			$update = $this->driver->updateUser($connection, $id, $column, $value);

			$connection = null;

			return $update;
		}

		public function createMessage($id_user, $message)
		{
			$connection = $this->connection();

			$response = $this->driver->createChatMessage($connection, $id_user, $message);

			$connection = null;

			return $response;
		}

		public function getMessages()
		{
			$connection = $this->connection();

			$response = $this->driver->getChatMessages($connection);

			$connection = null;

			return $response;
		}

		public function getChatUser($id_user)
		{
			$connection = $this->connection();

			$response = $this->driver->getChatUser($connection, $id_user);

			$connection = null;

			return $response;
		}

		public function getLastMessage()
		{
			$connection = $this->connection();

			$response = $this->driver->getLastMessage($connection);

			$connection = null;

			return $response;
		}
	}
?>