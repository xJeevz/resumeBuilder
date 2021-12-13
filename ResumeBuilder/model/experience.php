<?php

	class Experience{
		
        private $experienceID;
		private $clientID;
		private $companyName;
		private $position;
		private $description;
		private $startDate;
        private $endDate;
		
		private $connectionManager;
		private $dbConnection;
	
		
		function __construct(){
			$this->connectionManager = new ConnectionManager();
			$this->dbConnection = $this->connectionManager->getConnection();
		}

		function getAllExperience($clientID){
			$query = "SELECT companyName, description FROM experience WHERE clientID = '".$clientID."'";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}

		function deleteAllExperience($clientID) {
			$query = "DELETE FROM experience WHERE clientID = " . $clientID;
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}

		function insert($clientID, $companyName, $description) {
			$query = "INSERT INTO experience(clientID, companyName, description) 
			VALUES ('".$clientID."', '".$companyName."', '".$description."')";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}
	}

?>