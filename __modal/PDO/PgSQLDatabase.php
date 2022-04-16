<?php
	include __DIR__."/PgSQLInterface.php";
	include __DIR__."/PgSQLController.php";


	class PgSQLDatabase extends PgSQLController implements PgSQLInterface
	{
		public $env = ['driver' => "", 'host' => "", 'user' => "", 'password' => "", 'database' => "", 'port' => "", 'schema' => ""];

		public $schemaname;

		function __construct(string $driver)
		{	
			$this->setEnvParam($driver);
			$this->schemaname = $this->env['schema']."schema";
		}

		private function setEnvParam(string $driver)
		{
			$env = parse_url(getenv('DATABASE_URL'));

			if (isset($env['host'], $env['user'], $env['pass']))
			{
				foreach ($env as $key => $value) {
					if (isset($this->env[$key]))
						$this->env[$key] = $value;
				}
				$this->env['driver'] = $driver;
				$this->env['schema'] = "pigeon";
				$this->env['password'] = $env['pass'];
				$this->env['database'] = str_replace("/", "", $env['path']);
			}
			else
			{
				foreach (PgSQLInterface::settings as $key => $value) {
					if (isset($this->env[$key]))
						$this->env[$key] = $value;
				}
			}
		}

		public function getEnvArray()
		{
			return $this->env;
		}

		public function getUsers($connection)
		{
			$table = $this->schemaname.".users";

			$query = "SELECT * FROM ".$table;

			$stmt = $connection->prepare($query);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getUser($connection, $email, $password)
		{
			$table = $this->schemaname.".users";

			$query = "SELECT * FROM ".$table." WHERE email = '".$email."' AND password = '".$password."';";

			$stmt = $connection->prepare($query);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		private function userExists($connection, $email)
		{
			$table = $this->schemaname.".users";

			$query = "SELECT * FROM ".$table." WHERE email = '".$email."';";

			$stmt = $connection->prepare($query);
			$stmt->execute();

			return $stmt->fetchColumn();
		}

		public function createUser($connection, $email, $password, $name = "My nickname!", $description = "Something about me.")
		{
			$table = $this->schemaname.".users";

			$exists = $this->userExists($connection, $email);

			if (!$exists)
			{
				$query = "INSERT INTO ".$this->schemaname.".users(email, name, password, about) VALUES ('".$email."', '".$name."', '".$password."', '".$description."');";

				$stmt = $connection->prepare($query);
				$stmt->execute();

				return $stmt->fetchAll(PDO::FETCH_ASSOC);	
			}
			else
			{
				echo "USER ALREADY EXISTS";
			}
		}

		public function updateUser($connection, $id, $column, $value)
		{
			$table = $this->schemaname.".users";

			$query = "UPDATE ".$table." SET ".$column." = '".$value."' WHERE id = '".$id."';";

			$stmt = $connection->prepare($query);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function createChatMessage($connection, $id_user, $message)
		{
			$table = $this->schemaname.".chats";

			$query = "INSERT INTO ".$table." (id_user, messages) VALUES ('".$id_user."', '".$message."');";

			$stmt = $connection->prepare($query);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getChatMessages($connection)
		{
			$table = $this->schemaname.".chats";

			$query = "SELECT * FROM ".$table." ORDER BY id DESC LIMIT 14;";

			$stmt = $connection->prepare($query);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getChatUser($connection, $id_user)
		{
			$table = $this->schemaname.".users";

			$query = "SELECT name FROM ".$table." WHERE id = ".$id_user.";";

			$stmt = $connection->prepare($query);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getLastMessage($connection)
		{
			$table = $this->schemaname.".chats";

			$query = "SELECT id FROM ".$table." ORDER BY id DESC LIMIT 1;";

			$stmt = $connection->prepare($query);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	}