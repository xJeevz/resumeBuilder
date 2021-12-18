<?php


	require_once('../api/jwt.php');
	require_once("../model/client.php");
	require_once("../model/jwttoken.php");
	require_once("../database/connectionManager.php");
	
	class jwttokenController{
		function __construct(){
		}	

		function getOne($licenseKey) {
			$client = new Client();
			return $client->getClient($licenseKey);	
		}

		function createToken($clientID) {
			$token = new jwttoken();
			$token = $token->getToken($clientID);
			if ($token == "") {
				$header = [
					"alg" => "HS256",
					"typ" => "JWT"
				];
				$payload = [
					'iat' => time(),
					'uid' => $clientID,
					'exp' => time() + 86400,
					'iss' => 'localhost'
				];
				
				$secret = 'secret';
				$jwt = new jwt();
				$token = $jwt->createToken($header, $payload, $secret);
				$tokeninsert = new jwttoken();
				$tokenString = $token;
				$token = $tokeninsert->insert($clientID, $token);
				return $tokenString;
			} 
			else {
				return "Token Already Exists";
			}
		}

		function getToken($clientID) {
			$token = new jwttoken();
			$token = $token->getToken($clientID);
			return $token;
		}
	}
	
	
?>