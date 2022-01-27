<?php
	class Database {
		private $dbHost = 'localhost';
		private $dbUser = 'root';
		private $dbPass = 'root';
		private $dbName = 'clockerbd';
		
		private $statement;
		private $dbHandler;
		private $error;

		public function __construct() {
			$conn = 'mysql:host=3306' . $this->dbHost . ';dbname=clockerbd' . $this->dbName;
			$options = array(
				PDO::ATTR_PERSISTENT => true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			);
			try {
				$this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
			} catch (PDOException $e) {
				$this->error = $e->getMessage();
				echo $this->error;
			}
		}

		public function query($sql) {
			$this->statement = $this->dbHandler->prepare($sql);
		}

		public function bind($parameter, $value, $type = null) {
			switch (is_null($type)) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
			$this->statement->bindValue($parameter, $value, $type);
		}

		public function execute() {
			return $this->statement->execute();
		}

		public function fetchAll() {
			$this->execute();
			return $this->statement->fetchAll(PDO::FETCH_OBJ);
		}

		public function fetch() {
			$this->execute();
			return $this->statement->fetch(PDO::FETCH_OBJ);
		}

		public function rowCount() {
			return $this->statement->rowCount();
		}
	}