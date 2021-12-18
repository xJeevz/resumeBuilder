<?php

	require_once("../model/client.php");
	require_once("../database/connectionManager.php");
	
	class ClientController{

		function getOne($licenseKey) {
			$client = new Client();
			return $client->getClient($licenseKey);	
		}

		function getOneByNameAndLicenseKey($clientName, $licenseKey) {
			$client = new Client();
			return $client->getClientByNameAndLicenseKey($clientName, $licenseKey);	
		}

		function getOneClient($clientID) {
			$client = new Client();
			return $client->getOneClient($clientID);	
		}

		function addNewClient($clientName, $email, $phone) {
			$client = new Client();
			$licenseStaDate = date('Y/m/d');
			$licenseEndDate = date('Y/m/d', strtotime('+2 months'));
			$licenseKey = rand(1000,9999) . '-' . rand(1000,9999);
			$client->insert($clientName, $licenseKey, $licenseStaDate, $licenseEndDate, $email, $phone);
			return "Client Successfully Created <br /> License Key: " . $licenseKey;	
		}

		function addClient($clientID, $clientName, $email, $phone) {
			$client = new Client();
			$client->update($clientID, $clientName, $email, $phone);
			return "Client Successfully Added";
		}

		function removeClient($clientID) {
			$client = new Client();
			$client->delete($clientID);
			return "Client Successfully Removed";
		}

		function validateLicense($clientName, $licenseKey) {
			$client = new Client();
			$isClientExist = $client->checkLicense($clientName, $licenseKey);
			if ($isClientExist != "") {
				$endDate = $client->getLicenseEndDate($licenseKey);
				$date = date('Y/m/d');
				$date = date('Y/m/d', strtotime($date));
				if ($date < $endDate) {
					return true;
				} else {
					return "License Expired";
				}
			} else {
				return "License Invalid";
			}
		}

	}
	
	
?>