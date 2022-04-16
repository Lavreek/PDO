<?php
	include __DIR__."/settings.php";

	include __DIR__."/PDO/MySQLDatabase.php";
	include __DIR__."/PDO/PgSQLDatabase.php";

	class DatabaseHandler 
	{
		private $env;

		private $driver;

		/**
		 *	driver - выбор базы данных (MySQL / PgSQL)
		 *		host - имя домена или ip-адрес удалённого расположения
		 *		user - имя пользователя домена
		 *		password - пароль пользователя
		 */
		function __construct(string $driver)
		{
			if ($driver == "mysql")
			{
				$this->driver = new MySQLDatabase($driver);
				$this->env = $this->driver->getEnvArray();
			}
			elseif ($driver == "pgsql") {
				$this->driver = new PgSQLDatabase($driver);
				$this->env = $this->driver->getEnvArray();
			}
			else
			{
				throw new Exception("Wrong driver selected use \"mysql\" or \"pgsql\"");
				die();
			}

		}

		public function connection()
		{
			$query = $this->env['driver'].":host=".$this->env['host'].";port=".$this->env['port'].";";
			$connection = new PDO($query, $this->env['user'], $this->env['password']);
			
			return $connection;
		}

		public function createDatabase()
		{
			$connection = $this->connection();

			$this->driver->create($connection, $this->env['database']);

			$connection = null;
		}

		public function createSchema()
		{
			$this->driver->createSchema();
		}

		public function dropSchema()
		{
			$this->driver->dropSchema();
		}

		public function dropDatabase()
		{
			$connection = $this->connection();
			
			$this->driver->drop($connection, $this->env['database']);
			
			$connection = null;
		}

		public function createDatabaseTables()
		{
			$connection = $this->driver->databaseConnection();
			
			$this->driver->createTables($connection, $this->env['database']);
			
			$connection = null;
		}

		public function dropDatabaseTables()
		{
			$connection = $this->driver->databaseConnection();
			
			$this->driver->dropTables($connection);
			
			$connection = null;
		}
	}