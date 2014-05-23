<?php
require_once ("utils/rest_utils.php");
require_once ("utils/db_utils.php");
require_once ('utils/recaptchalib.php');

class petitionController {
	function __construct() {
		$this -> db = new DBUtils();
	}

	function get($params, $data) {
		return new RestResponse(200, $this -> db -> search("petitions"));
	}

	function post($params, $data) {
		// CSRF security
		if ($_SESSION['CSRF'] != $data['csrf']) {
			$response = new RestResponse(405, json_encode(array("errorMessage" => json_encode($_SESSION))));
			RestUtils::sendResponse($response);
			die();
		}
		
		unset($data['csrf']);
		
		// Recaptcha security
		$privatekey = "6LdIzOoSAAAAANtnJTzZb3lfJSQtf-O96YVfyvFd";
		$resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $data["challenge"], $data["response"]);

		if (!$resp -> is_valid) {
			$response = new RestResponse(405, json_encode(array("errorMessage" => "reCAPTCHA invalid")));
			RestUtils::sendResponse($response);
			die();
		}
		
		unset($data['challenge']);
		unset($data['response']);


		// Check if email exists
		// Validate all fields;
				
		$data['user_dateadd'] = "now()";


		// Validate all data
		return new RestResponse(200, $this -> db -> insert("petitions", $data));
	}
}
