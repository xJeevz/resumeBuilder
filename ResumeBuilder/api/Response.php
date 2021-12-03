<?php
    class Response{

		public $statusCode;

		public $headers;

		public $payload;

		function __construct() {
		
			$this->statusCode = 201	;
		}

	}
?>