<?php

	class Client{
		
		private $clientID;
		private $clientName;
		private $licenseNumber;
		private $licenseKey;
		private $licenseStartDate;
		private $licenseEndDate;
		
		private $connectionManager;
		private $dbConnection;
	
		
		function __construct(){
			$this->connectionManager = new ConnectionManager();
			$this->dbConnection = $this->connectionManager->getConnection();
		}

		function getLicenseKey($clientID){
			$query = "SELECT licensekey FROM client WHERE clientID = " . $clientID;
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetch(PDO::FETCH_ASSOC);
		}

		function getClient($licenseKey){
			$query = "SELECT * FROM client WHERE licenseKey = '".$licenseKey."'";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}

		function getClientByNameAndLicenseKey($clientName, $licenseKey){
			$query = "SELECT * FROM client WHERE clientName = '".$clientName."' AND licenseKey = '".$licenseKey."'";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}

		function getOneClient($clientID){
			$query = "SELECT clientName, email, phone FROM client WHERE clientID = '".$clientID."'";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}

		function getClientByToken($token){
			$query = "SELECT * FROM token WHERE token = '".$token."'";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetch(PDO::FETCH_ASSOC);
		}

		function checkLicense($clientName, $licenseKey){
			$query = "SELECT * FROM client WHERE clientName = '".$clientName."' AND licenseKey = '".$licenseKey."'";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}

		function getLicenseEndDate($licenseKey){
			$query = "SELECT licenseEndDate FROM client WHERE licenseKey = '".$licenseKey."'";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetch(PDO::FETCH_ASSOC);
		}

		function delete($clientID) {
			$statement = $this->dbConnection->prepare("DELETE FROM education WHERE clientID = " . $clientID);
			$statement->execute();
			$statement = $this->dbConnection->prepare("DELETE FROM experience WHERE clientID = " . $clientID);
			$statement->execute();
			$statement = $this->dbConnection->prepare("DELETE FROM skill WHERE clientID = " . $clientID);
			$statement->execute();
			$statement = $this->dbConnection->prepare("DELETE FROM token WHERE clientID = " . $clientID);
			$statement->execute();
			$statement = $this->dbConnection->prepare("DELETE FROM client WHERE clientID = " . $clientID);
			$statement->execute();
		}

		function insert($clientName, $licenseKey, $licenseStartDate, $licenseEndDate, $email, $phone) {
			$query = "INSERT INTO client(clientName, licenseKey, licenseStartDate, licenseEndDate, email, phone) 
			VALUES ('".$clientName."', '".$licenseKey."', '".$licenseStartDate."', '".$licenseEndDate."', '".$email."', '".$phone."')";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}

		function update($clientID, $clientName, $email, $phone) {
			$query = "UPDATE client SET clientName = '".$clientName."', email = '".$email."', phone = '".$phone."' WHERE clientID = $clientID";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}
	}

?>