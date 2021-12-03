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

		
		if ($request->verb == "GET") {


		}

		if ($request->verb == "POST") {

			if($request->content_type == "application/json" && $controllerName == "JwttokenController" && $request->url_parameters["jwttoken"] == ""){
				$request->payload = json_decode(file_get_contents("php://input"), true);
				$client = $controller->getOne($request->payload['licenseKey']);

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

			if ($request->content_type == "application/json" && $controllerName == "JwttokenController" && $request->url_parameters["jwttoken"] != "") {
				$request->payload = json_decode(file_get_contents("php://input"), true);
				
				if ($request->url_parameters["jwttoken"] == $request->payload['licenseKey']) {
					$client = $controller->getOne($request->payload['licenseKey']);
					$tokenInDB = $controller->getToken($client[0]["clientID"]);

					$token = $controller->renewToken($client[0]["clientID"]);
				}
				if ($request->accept == "application/json") {
					$response->payload = "Token is Expired and has been Renewed";
				}	
			}

			if($request->content_type == "application/json" && $controllerName == "ResumeController"){
				$request->payload = json_decode(file_get_contents("php://input"), true);
				$client = $controller->getOne($request->payload['licenseKey']);
				$headers = apache_request_headers();
				foreach ($headers as $header => $value) {
					if ($header == "Authorization") {
						$token = str_replace("Bearer", "", $value);
					}
				}

				$data = array("client" => $request->payload["client"], "education" => $request->payload["education"], "experience" => $request->payload["experience"], "skill" => $request->payload["skill"]);

				if ($request->accept == "application/json") {
					$jwt = new jwt();
					$isValid = $jwt->validateToken($token, "secret");
					if ($isValid) {
						$controller->makeResume($data);
					} else {
						$response->payload = "<br />Token is expired and Renewed";
						$controller->renewToken($client[0]["clientID"]);
					}
				}
			}
		}
	} else {
		$response->payload = "ERROR: URL Invalid";
	}

	echo $response->payload;
?>