<?php
require_once("utils/rest_utils.php");
require_once("utils/db_utils.php");

class petitionController {
	function __construct() {
		$this->db = new DBUtils();
	}
	
	function get($params, $data) {
		$id = $params[0];
		if ($id) {
			return new RestResponse(200, $this->db->get("petitions", $id));
		} else {
			return new RestResponse(200, $this->db->search("petitions"));
		}
	}
	
	function post($params, $data) {
		return new RestResponse(200, $this->db->insert("petitions", $data));
	}
	
	function put($params, $data) {
		$data["id"] = $params[0];
		return new RestResponse(200, $this->db->update("petitions", $data));
	}
	
	function delete($params, $data) {
		$id = $params[0];
		return new RestResponse(200, $this->db->delete("petitions", $id));
	}
}