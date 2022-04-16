<?php

	class MySQLController
	{
		private function databaseExists($connection)
		{
			$query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '".$this->env['database']."';";
			$stmt = $connection->prepare($query);
			$stmt->execute();

			return $stmt->fetchColumn();
		}

		public function databaseConnection()
		{
			$query = $this->env['driver'].":host=".$this->env['host'].";port=".$this->env['port'].";dbname=".$this->env['database'].";";
			$connection = new PDO($query, $this->env['user'], $this->env['password']);
			
			return $connection;
		}

		public function createSchema()
		{
			echo "CREATE SCHEMA: Method empty. But schema name equivalent to database name";
		}

		public function dropSchema()
		{
			echo "DROP SCHEMA: Method empty. But schema name equivalent to database name";
		}

		public function create($connection)
		{
			$exists = $this->databaseExists($connection);

			if (!$exists)
			{
				$query = "CREATE DATABASE IF NOT EXISTS ".$this->env['database'].";";
			
				$stmt = $connection->prepare($query);
				$stmt->execute();

				if ($stmt)
				{
					echo "DATABASE CREATED<br>";
					
				}

				$this->createSchema();
			}
			else
			{
				echo "DATABASE ALIVE<br>";
			}
		}

		public function drop($connection)
		{
			$exists = $this->databaseExists($connection);

			if (!$exists)
			{
				echo "DATABASE DEAD<br>";
			}
			else
			{
				$query = "DROP DATABASE IF EXISTS ".$this->env['database'].";";
			
				$stmt = $connection->prepare($query);
				$stmt->execute();

				if ($stmt)
				{
					echo "DATABASE DROPED<br>";
				}
			}
		}

		private function tablesExists($connection, $tablename)
		{
			$query = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$this->env['database']."' and TABLE_NAME = '".$tablename."';";

			$stmt = $connection->prepare($query);
			$stmt->execute();

			return $stmt->fetchColumn();
		}

		public function createTables($connection)
		{
			$tables = [
				'users' => [
					["id", "INT", "NOT NULL", "AUTO_INCREMENT,"],
					["email", "VARCHAR(50)", "NOT NULL,"],
					["name", "VARCHAR(50)", "NOT NULL,"],
					["password", "VARCHAR(50)", "NOT NULL,"],
					["about", "VARCHAR(50)", "NOT NULL,"],
					["PRIMARY KEY (id),"],
					["UNIQUE `email_index` (email)"],
				],
				'chats' => [
					["id", "INT", "NOT NULL", "AUTO_INCREMENT,"],
					["id_user", "INT", "NOT NULL,"],
					["messages",  "VARCHAR(255)", "NOT NULL,",],
					["PRIMARY KEY (id)"],
				],
			];

			foreach ($tables as $tablename => $param_array) {

				$exists = $this->tablesExists($connection, $tablename);

				if (!$exists)
				{
					$query = "CREATE TABLE ".$tablename." (";

					foreach ($param_array as $key => $params)
					{
						foreach ($params as $value)
						{
							$query .= $value." ";
						}
					}

					$query .= ");";

					$stmt = $connection->prepare($query);
					$result = $stmt->execute();

					if ($result)
					{
						echo "TABLE ".$tablename." WAS CREATED<br>";
					}
				}
				else
				{
					echo "TABLE ".$tablename." ALREADY EXISTS<br>";
				}
			}
		}

		public function dropTables($connection)
		{
			$tables = [
				"users",
				"chats",
			];

			foreach ($tables as $tablename) {
				$exists = $this->tablesExists($connection, $tablename);

				$query = "DROP TABLE ".$tablename.";";

				if ($exists)
				{
					$stmt = $connection->prepare($query);
					$stmt->execute();

					if ($stmt)
					{
						echo "TABLE ".$tablename." DROPED<br>";
					}
				}
				else
				{
					echo "TABLE ".$tablename." NOT EXISTS<br>";
				}
			}
		}
	}