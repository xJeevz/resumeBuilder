<?php
    class Request{
		
		public $verb;
		
		public $url_parameters;
		
		public $payload;
		
		public $payload_format;

		public $accept;

		public $content_type;
		
		function __construct(){
			
			// NOTE-1: 
			// Apache the web server stores request information in the Global variable $_SERVER
			// as an associative array.
			
			$this->verb = $_SERVER["REQUEST_METHOD"];
			$this->content_type = $_SERVER['CONTENT_TYPE'];
			$this->accept = $_SERVER["HTTP_ACCEPT"];
			
			
			// NOTE-2:
			// URL Parameters are passed as what we call a Query String
			// it is the part after the page name separated by a question mark ?
			// e.g., http://localhost/videoconversionservice/api/index.php?client=1&attributes=clientName
			$this->url_parameters = array();
			parse_str($_SERVER["QUERY_STRING"], $this->url_parameters);
			
			// parse_str takes the query string and transforms it into an array
			
			
		}

	}
?>