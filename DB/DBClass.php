<?php
if(!defined("__DB__")) {
	define("__DB__", true);
	class DBMySQLClass{
		private $link = false;
		private $host = false;
		private $user = false;
		private $schema = false;
		private $password = false;
		public function init($host, $user, $password, $schema){
			$this->host = $host;
			$this->user = $user;
			$this->password = $password;
			$this->schema = $schema;
			$this->connect();
		}
		function __destruct(){
			if ($this->link) {
				$this->disconnect();
			}
		}
		public function connect(){
			$this->link = new mysqli($this->host, $this->user, $this->password, $this->schema);
			if (!$this->isConnected()) {
				die("Connection failed: " . $this->link->connect_error);
			}
			return true;
		}
		public function printConnectionInfo(){
			echo "Host info: ".$this->link->host_info."<br>";
			echo "Protocol version: ".$this->link->protocol_version."<br>";
			echo "Server info: ".$this->link->server_info."<br>";
			echo "Server version: ".$this->link->server_version."<br>";
		}
		public function link(){
			return $this->link;
		}
		public function disconnect(){
			if ($this->isConnected()) {
				$this->link->close();
			}
			$this->link = false;
			return false;
		}
		public function isConnected(){
			return ($this->link->connect_errno != true) && ($this->link->ping() == true);
		}
	}

	class DBClass extends DBMySQLClass {
		var $dbHost = 'localhost';
		var $dbSchema = 'schema';
		var $dbUser = 'user';
		var $dbPassword = 'password';
		function __construct() {
			$this->init($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbSchema);
		}
	}
}
?>