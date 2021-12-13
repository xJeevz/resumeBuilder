<?php

	spl_autoload_register('autoLoad');
	require_once('Request.php');
	require_once('Response.php');
	require_once('jwt.php');
	
	function autoLoad($classname){
		
	    if (preg_match('/[a-zA-Z]+Controller$/', $classname)) {
	        require_once('../controllers/' . $classname . '.php');
	        return true;
	    }		
		
	}

	// Request and Response Class
	$request = new Request();
	$response = new Response();

	// Get the target resource controller name from the URL
	$keys = array();
	$keys = array_keys($request->url_parameters);	
	$controllerName = ucfirst($keys[0]).'Controller';

	if(class_exists($controllerName)){
		$controller = new $controllerName();

		// Get Resume
		if ($request->verb == "GET") {
			if($request->content_type == "application/json" && $controllerName == "ResumeController") { 
				$headers = apache_request_headers();
				foreach ($headers as $header => $value) {
					if ($header == "Authorization") {
						$token = str_replace("Bearer", "", $value);
					}
				}

				if ($token == "License Key Invalid") {
					$response->payload = $token;
				} else {
					if ($request->accept == "application/json") {
						$jwt = new jwt();
						$isValid = $jwt->validateToken($token, "secret");
						if ($isValid) {
							$client = $controller->getOne($request->url_parameters["resume"]);
							$data = $controller->getClient($client[0]["clientID"]);
							$controller->makeResume($data);
						} else {
							$response->payload = "Token is expired";
						}
					}
				}
			}
		}

		if ($request->verb == "POST") {

			// Add New Client
			if($request->content_type == "application/json" && $controllerName == "ClientController" && $request->url_parameters["client"] == ""){ 
				$request->payload = json_decode(file_get_contents("php://input"), true);
				$client = $controller->addNewClient($request->payload["client"]["clientName"], $request->payload["client"]["address"], $request->payload["client"]["email"], $request->payload["client"]["phone"]);
				if ($request->accept == "application/json") {
					$response->payload = $client;
				}
			}

			// Delete Client
			if($request->content_type == "application/json" && $controllerName == "ClientController" && $request->url_parameters["client"] != ""){ 
				$clientName = $request->payload = json_decode(file_get_contents("php://input"), true);
				$client = $controller->getOneByNameAndLicenseKey($clientName, $request->url_parameters["client"]);
				if (sizeof($client) == 0) {
					if ($request->accept == "application/json") {
						$response->payload = "License Key or Client Name Invalid";
					}	
				} else {
					$controller->removeClient($client[0]["clientID"]);
					if ($request->accept == "application/json") {
						$response->payload = "Client Has been Deleted";
					}
				}
			}

			// Create/Get Token
			if($request->content_type == "application/json" && $controllerName == "JwttokenController"){
				$request->payload = json_decode(file_get_contents("php://input"), true);
				$client = $controller->getOne($request->url_parameters["jwttoken"]);
				if (sizeof($client) == 0) {
					if ($request->accept == "application/json") {
						$response->payload = "License Key Invalid";
					}	
				} else {
					$token = $controller->createToken($client[0]["clientID"]);
					if ($request->accept == "application/json") {
						if ($token == "Token Already Exists") {
							$tokenInDB = $controller->getToken($client[0]["clientID"]);
							$response->payload = $tokenInDB['token'];
						}
						else {
							$response->payload = $token;
						}	
					}	
				}
			}

			// Create Resume or Renew Token
			if($request->content_type == "application/json" && $controllerName == "ResumeController"){
				$request->payload = json_decode(file_get_contents("php://input"), true);
				$headers = apache_request_headers();
				foreach ($headers as $header => $value) {
					if ($header == "Authorization") {
						$token = str_replace("Bearer", "", $value);
					}	
				}
				if ($token == "License Key Invalid") {
					$response->payload = $token;
				} else {
					$client = $controller->getOne($request->url_parameters["resume"]);
					if (sizeof($client) == 0) {
						if ($request->accept == "application/json") {
							$response->payload = "License Key Invalid";
						}	
					} else {
						$data = array("client" => $request->payload["client"], "education" => $request->payload["education"], "experience" => $request->payload["experience"], "skill" => $request->payload["skill"]);
						$clientID = $client[0]["clientID"];
						$controller->addClient($clientID, $data);
						if ($request->accept == "application/json") {
							$jwt = new jwt();
							$isValid = $jwt->validateToken($token, "secret");
							if ($isValid) {
								$controller->makeResume($data);
							} else {
								$response->payload = "Token is expired and Renewed";
								$controller->renewToken($client[0]["clientID"]);
							}
						}
					}
					
				}
			}
		}
	} else {
		$response->payload = "ERROR: URL Invalid";
	}

	echo $response->payload;
?>