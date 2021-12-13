<?php

	class Skill{
		
        private $skillID;
		private $clientID;
		private $skillName;
		
		private $connectionManager;
		private $dbConnection;
	
		
		function __construct(){
			$this->connectionManager = new ConnectionManager();
			$this->dbConnection = $this->connectionManager->getConnection();
		}

		function getAllSkill($clientID){
			$query = "SELECT skillName FROM skill WHERE clientID = '".$clientID."'";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}

		function deleteAllSkill($clientID) {
			$query = "DELETE FROM skill WHERE clientID = " . $clientID;
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}

		function insert($clientID, $skillName) {
			$query = "INSERT INTO skill(clientID, skillName) 
			VALUES ('".$clientID."', '".$skillName."')";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}
	}

?>