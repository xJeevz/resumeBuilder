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
	}
?>