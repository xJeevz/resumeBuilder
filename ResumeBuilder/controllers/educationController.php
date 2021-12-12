<?php
    require_once("../model/client.php");
	require_once("../model/education.php");
	require_once("../database/connectionManager.php");
	
	class EducationController{

        function getClient($licenseKey) {
			$client = new Client();
			return $client->getClient($licenseKey);	
		}

		function getAll($clientID) {
			$education = new Education();
			return $education->getAllEducation($clientID);	
		}

		function addNewEducation($clientID, $schoolName, $major, $startYear, $endYear) {
			$education = new Education();
			$education->insert($clientID, $schoolName, $major, $startYear, $endYear);
			return "Education Successfully Added";	
		}

		function removeAllEducation($clientID) {
			$education = new Education();
			$education->deleteAllEducation($clientID);
			return "Education Successfully Removed";
		}
	}
?>