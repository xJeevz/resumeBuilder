<?php

	class Education{
		
        private $educationID;
		private $clientID;
		private $schoolName;
		private $major;
		private $startYear;
		private $endYear;
		
		private $connectionManager;
		private $dbConnection;
	
		
		function __construct(){
			$this->connectionManager = new ConnectionManager();
			$this->dbConnection = $this->connectionManager->getConnection();
		}

		function getAllEducation($clientID){
			$query = "SELECT schoolName, major, startYear, endYear FROM education WHERE clientID = '".$clientID."'";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}

		function deleteAllEducation($clientID) {
			$query = "DELETE FROM education WHERE clientID = " . $clientID;
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}

		function insert($clientID, $schoolName, $major, $startYear, $endYear) {
			$query = "INSERT INTO education(clientID, schoolName, major, startYear, endYear) 
			VALUES ('".$clientID."', '".$schoolName."', '".$major."', '".$startYear."', '".$endYear."')";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}
	}

?>