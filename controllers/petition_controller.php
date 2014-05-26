<?php
require_once ("utils/rest_utils.php");
require_once ("utils/db_utils.php");
require_once ('utils/recaptchalib.php');
require_once ('utils/validators.php');

class petitionController {
	function __construct() {
		$this -> db = new DBUtils();
	}

	function get($params, $data) {
		return new RestResponse(200, $this -> db -> countPetitons("petitions"));
	}

	function post($params, $data) {
		// CSRF security
		if ($_SESSION['CSRF'] != $data['csrf']) {
			$response = new RestResponse(405, array("errorMessage" => "CSRF invalid"));
			RestUtils::sendResponse($response);
			return;
		}
		
		unset($data['csrf']);
		
		// Recaptcha security
		$privatekey = "6LdIzOoSAAAAANtnJTzZb3lfJSQtf-O96YVfyvFd";
		$resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $data["challenge"], $data["response"]);

		if (!$resp -> is_valid) {
			$response = new RestResponse(405, array("errorMessage" => "reCAPTCHA invalid"));
			RestUtils::sendResponse($response);
			return;
		}
		
		unset($data['challenge']);
		unset($data['response']);


		// Check if email exists
		if (!checkEmailAdress($data['email'])) {
			$response = new RestResponse(405, array("errorMessage" => "e-mail invalid"));
			RestUtils::sendResponse($response);
			return;
		}
		
		// Validate Email address
		if ($this->db->getByEmail("petitions", $data['email']) != null) {
			$response = new RestResponse(405, array("errorMessage" => "e-mail exists"));
			RestUtils::sendResponse($response);
			return;
		}
		
		// Validate name
		if (!checkValidName($data['name'])) {
			$response = new RestResponse(405, array("errorMessage" => "name invalid"));
			RestUtils::sendResponse($response);
			return;
		}
		
		// Validate firstName
		if (!checkValidName($data['firstname'])) {
			$response = new RestResponse(405, array("errorMessage" => "firstname invalid"));
			RestUtils::sendResponse($response);
			return;
		}
		
		// Validate zipCode
		if (!checkZipCode($data['zipcode'])) {
			$response = new RestResponse(405, array("errorMessage" => "zipcode invalid"));
			RestUtils::sendResponse($response);
			return;
		}
		
		$data['user_dateadd'] = "now()";
		$this -> db -> insert("petitions", $data);
		return new RestResponse(200, $this -> db -> countPetitons("petitions"));
	}
}
