<?php
    require_once("../controllers/clientController.php");
    require_once("../controllers/educationController.php");
    require_once("../controllers/experienceController.php");
    require_once("../controllers/skillController.php");
    require_once('../api/jwt.php');
    require_once("../model/client.php");
	require_once("../model/jwttoken.php");
    
	class ResumeController{

        function makeResume($data) {

            include ("../view/resume.php");
        }

		function getClientByToken($token) {
			$client = new Client();
			return $client->getClientByToken($token);	
		}
        function getOne($licenseKey) {
			$client = new Client();
			return $client->getClient($licenseKey);	
		}

        function renewToken($clientID) {
			$token = new jwttoken();
				$header = [
					"alg" => "HS256",
					"typ" => "JWT"
				];
				$payload = [
					'iat' => time(),
					'uid' => $clientID,
					'exp' => time() + 60,
					'iss' => 'localhost'
				];
				
				$secret = 'secret';
				$jwt = new jwt();
				$token = $jwt->createToken($header, $payload, $secret);
				$tokeninsert = new jwttoken();
				$tokenString = $token;
				$token = $tokeninsert->updateToken($clientID, $token);
				return $tokenString;
		}

		function addClient($clientID, $data) {
			$clientController = new ClientController();
			$educationController = new EducationController();
			$experienceController = new ExperienceController();
			$skillController = new SkillController();

			$clientController->addClient($clientID, $data["client"]["clientName"], $data["client"]["address"], $data["client"]["email"], $data["client"]["phone"]);

			$educationController->removeAllEducation($clientID);
			foreach($data["education"] as $educations) {
				$educationController->addNewEducation($clientID, $educations["schoolName"], $educations["major"], $educations["startYear"], $educations["endYear"]);
			}

			$experienceController->removeAllExperience($clientID);
			foreach($data["experience"] as $experiences) {
				$experienceController->addNewExperience($clientID, $experiences["companyName"], $experiences["description"]);
			}

			$skillController->removeAllSkill($clientID);
			foreach($data["skill"] as $skill) {
				$skillController->addNewSkill($clientID, $skill);
			}

			
		}

		function getClient($clientID, $data) {
			$clientController = new ClientController();
			$educationController = new EducationController();
			$experienceController = new ExperienceController();
			$skillController = new SkillController();

			$client = $clientController->getOneClient($clientID);
			return $client;
		}
	}
?>