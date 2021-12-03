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
			$query = "SELECT * FROM experience WHERE clientID = '".$clientID."'";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}

		function delete($experienceID) {
			$query = "DELETE FROM experience WHERE experienceID = " . $experienceID;
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}

		function insert($clientID, $companyName, $position, $description, $startDate, $endDate) {
			$query = "INSERT INTO experience(clientID, companyName, position, description, startDate, endDate) 
			VALUES ('".$clientID."', '".$companyName."', '".$position."', '".$description."', '".$startDate."', '".$endDate."')";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}
	}

?>