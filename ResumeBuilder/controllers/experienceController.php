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

		function addEducation($clientID, $companyName, $position, $description, $startDate, $endDate) {
			$experience = new Experience();
			$experience->insert($clientID, $companyName, $position, $description, $startDate, $endDate);
			return "Experience Successfully Added";	
		}

		function removeEducation($experienceID) {
			$experience = new Experience();
			$experience->delete($experienceID);
			return "Experience Successfully Removed";
		}
	}
?>