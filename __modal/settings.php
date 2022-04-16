<?php
	interface Settings
	{
		const settings = [
			'driver' => "mysql",
			'host' => "localhost", //ip / доменное имя
			'user' => "root",
			'password' => "",
			'database' => "pigeon",
			'port' => "3306",
			'schema' => "pigeon",
			
			// 'driver' => "pgsql",
			// 'host' => "ec2-54-75-184-144.eu-west-1.compute.amazonaws.com", //ip / доменное имя
			// 'user' => "kczknuujftalwk",
			// 'password' => "4e566d48781ff593f694e288c6d155339093fdb86e2fadb2f2b4cbfca43f4688",
			// 'database' => "dcsbi50slu1c8t",
			// 'port' => "5432",
			// 'schema' => "pigeon",
		];
	}

	//pgsql //user:password@host:port/dbname / Hekoku DATABASE_URL