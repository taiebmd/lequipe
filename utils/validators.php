<?php
/**
 * Function to check if an email address is valid
 *
 * @param string email adress
 * @return boolean true if email is valid
 */
function checkEmailAdress($adresse) {
	if (strlen($adresse) > 254) {
		return false;
	}
	
	$syntaxe = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";

	if (preg_match($syntaxe, $adresse)) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check Name & First Name
 * 
 * @param string name or firstName
 * @return boolean true if name is valid
 */
function checkValidName($name) {
	if(preg_match("/^[[:alpha:]( |\.)]{2,99}$/",$name)) {
		return true;
	}
	
	return false;
}


/**
 * Check if the zip code is valid
 * 
 * @param string zip code
 * @return boolean true if the zip code is valid
 */
function checkZipCode ($zip) {
	if (preg_match("/^[a-zA-Z0-9 -]{2,99}$/",$zip)) {
		return true;
	}
	
	return false;
}