<?php 

	class Connection
	{
		private 		$connection = NULL;
		private static 	$instance 	= NULL;
		private 		$_HOST 		= "127.0.0.1"; 
		private 		$_DATABASE 	= "XXX"; 
		private 		$_USERNAME 	= "XXX"; 
		private 		$_PASSWORD 	= "XXXX";

		public static function getInstance(){

			if(!self::$instance){
				self::$instance = new self();
			}
			return self::$instance;
		}

		public function __construct(){
			$this->connection = new mysqli($this->_HOST, $this->_USERNAME, $this->_PASSWORD, $this->_DATABASE);
			$this->connection->set_charset("utf8");

			if(mysqli_connect_error()){
				trigger_error("Failed connectio to MySQL: ". mysql_connect_error(), E_USER_ERROR);
			}
		}

		public function __clone(){}


		public function getConnection(){
			return $this->connection;
		}

		public function findAll($query){
			$reponse = mysqli_fetch_all($this->connection->query($query), MYSQLI_ASSOC);
			return $reponse;
		}

		public function crud($query){
			$reponse = $this->connection->query($query);

			if($reponse == true){
				return 1;
			}

			return 0;
		}

		public function getById($query){
			return $this->connection->query($query);
		}
	}
?>