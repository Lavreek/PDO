<?php

	class PgSQLController
	{
		private function databaseExists($connection)
		{
			$query = "SELECT datname FROM pg_database WHERE datname = '".$this->env['database']."';";
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
			$connection = $this->databaseConnection();

			$query = "CREATE SCHEMA IF NOT EXISTS ".$this->schemaname.";";
			
			$stmt = $connection->prepare($query);
			$stmt->execute();

			if ($stmt)
				echo "SCHEMA CREATED OR ALIVE<br>";
		}

		public function dropSchema()
		{
			$connection = $this->databaseConnection();

			$query = "DROP SCHEMA ".$this->schemaname.";";
			
			$stmt = $connection->prepare($query);
			$stmt->execute();

			if ($stmt)
				echo "SCHEMA DROPED<br>";
		}

		public function create($connection)
		{
			$exists = $this->databaseExists($connection);

			if (!$exists)
			{
				$query = "CREATE DATABASE ".$this->env['database']." WITH ENCODING = 'UTF8' CONNECTION LIMIT = 100;";
			
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
				$query = "DROP DATABASE ".$this->env['database'].";";
			
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
			$query = "SELECT tablename FROM pg_tables WHERE schemaname = '".$this->schemaname."' and tablename = '".$tablename."';";

			$stmt = $connection->prepare($query);
			$stmt->execute();

			return $stmt->fetchColumn();
		}

		public function createTables($connection)
		{
			$tables = [
				'users' => [
					["id", "serial", "NOT NULL,"],
					["email", "character varying(50)", "UNIQUE,"],
					["name", "character varying(50),",],
					["password", "character varying(50),"],
					["about", "character varying(50),"],
					["PRIMARY KEY (id)"],
				],
				'chats' => [
					["id", "serial", "NOT NULL,"],
					["id_user", "serial", "NOT NULL,"],
					["messages", "character varying(255),",],
					["PRIMARY KEY (id)"],
				],
			];

			foreach ($tables as $tablename => $param_array) {

				$tn = $tablename;
				$table = $this->schemaname.".".$tablename;

				$exists = $this->tablesExists($connection, $tn);

				if (!$exists)
				{
					$query = "CREATE TABLE ".$table." (";

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

				$query = "DROP TABLE ".$this->schemaname.".".$tablename.";";

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