<?php

	class jwttoken{
		
		private $clientID;
		private $token;

		private $connectionManager;
		private $dbConnection;
	
		
		function __construct(){
			$this->connectionManager = new ConnectionManager();
			$this->dbConnection = $this->connectionManager->getConnection();
		}

		function insert($clientID, $token) {
			$query = "INSERT INTO token(clientID, token) VALUES ('".$clientID."', '".$token."')";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}

        function getToken($clientID) {
			$query = "select token from token where clientID = '".$clientID."'";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetch(PDO::FETCH_ASSOC);
		}

		function updateToken($clientID, $token) {
			$query = "UPDATE token set token = '".$token."' where clientID = '".$clientID."'";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetch(PDO::FETCH_ASSOC);
		}
	}
?>