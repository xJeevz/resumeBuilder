<?php
    require_once("../model/client.php");
	require_once("../model/experience.php");
	require_once("../database/connectionManager.php");
	
	class ExperienceController{

        function getClient($licenseKey) {
			$client = new Client();
			return $client->getClient($licenseKey);	
		}

		function getAll($clientID) {
			$experience = new Experience();
			return $experience->getAllExperience($clientID);	
		}

		function addNewExperience($clientID, $companyName, $description) {
			$experience = new Experience();
			$experience->insert($clientID, $companyName, $description);
			return "Experience Successfully Added";	
		}

		function removeAllExperience($clientID) {
			$experience = new Experience();
			$experience->deleteAllExperience($clientID);
			return "Experience Successfully Removed";
		}
	}
?>