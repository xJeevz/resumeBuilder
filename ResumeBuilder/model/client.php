<?php

	class Client{
		
		private $clientID;
		private $clientName;
		private $licenseNumber;
		private $licenseKey;
		private $licenseStartDate;
		private $licenseEndDate;
		private $address;
		
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

		function getOneClient($clientID){
			$query = "SELECT * FROM client WHERE clientID = '".$clientID."'";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}

		function getClientByToken($token){
			$query = "SELECT clientID FROM client WHERE token = '".$token."'";
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
			$query = "DELETE FROM client WHERE clientID = " . $clientID;
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}

		function insert($clientName, $licenseKey, $licenseStaDate, $licenseEndDate, $address, $email, $phone) {
			$query = "INSERT INTO client(clientName, licenseKey, licenseStaDate, licenseEndDate, address, email, phone) 
			VALUES ('".$clientName."', '".$licenseKey."', '".$licenseStaDate."', '".$licenseEndDate."', '".$address."', '".$email."', '".$phone."')";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}

		function update($clientID, $clientName, $address, $email, $phone) {
			$query = "UPDATE client SET clientName = '".$clientName."', address = '".$address."', email = '".$email."', phone = '".$phone."' WHERE clientID = $clientID";
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}
	}

?>