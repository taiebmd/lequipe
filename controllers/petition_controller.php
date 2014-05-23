<?php
require_once("utils/rest_utils.php");
require_once("utils/db_utils.php");

class petitionController {
	function __construct() {
		$this->db = new DBUtils();
	}
	
	function get($params, $data) {
			return new RestResponse(200, $this->db->search("petitions"));
	}
	
	function post($params, $data) {
		return new RestResponse(200, $this->db->insert("petitions", $data));
	}
}