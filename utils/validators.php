<?php
/**
 * Function to check if email adress is vali
 *
 * @param string email adress
 * @return boolean true if email is valid
 */
function checkEmailAdress($adresse) {
	if (strlen($adresse) > 254) {
		return false;
	}
	
	//Caractères non-ASCII autorisés dans un nom de domaine .eu :
	$nonASCII = 'ďđēĕėęěĝğġģĥħĩīĭįıĵķĺļľŀłńņňŉŋōŏőoeŕŗřśŝsťŧ';
	$nonASCII .= 'ďđēĕėęěĝğġģĥħĩīĭįıĵķĺļľŀłńņňŉŋōŏőoeŕŗřśŝsťŧ';
	$nonASCII .= 'ũūŭůűųŵŷźżztșțΐάέήίΰαβγδεζηθικλμνξοπρςστυφ';
	$nonASCII .= 'χψωϊϋόύώабвгдежзийклмнопрстуфхцчшщъыьэюяt';
	$nonASCII .= 'ἀἁἂἃἄἅἆἇἐἑἒἓἔἕἠἡἢἣἤἥἦἧἰἱἲἳἴἵἶἷὀὁὂὃὄὅὐὑὒὓὔ';
	$nonASCII .= 'ὕὖὗὠὡὢὣὤὥὦὧὰάὲέὴήὶίὸόὺύὼώᾀᾁᾂᾃᾄᾅᾆᾇᾐᾑᾒᾓᾔᾕᾖᾗ';
	$nonASCII .= 'ᾠᾡᾢᾣᾤᾥᾦᾧᾰᾱᾲᾳᾴᾶᾷῂῃῄῆῇῐῑῒΐῖῗῠῡῢΰῤῥῦῧῲῳῴῶῷ';
	
	// note : 1 caractète non-ASCII vos 2 octets en UTF-8
	$syntaxe = "#^[[:alnum:][:punct:]]{1,64}@[[:alnum:]-.$nonASCII]{2,253}\.[[:alpha:].]{2,6}$#";

	if (preg_match($syntaxe, $adresse)) {
		return true;
	} else {
		return false;
	}
}

function checkValidName($name) {
	if (!preg_match("#^[:alnum:]{2, 99}$#", $name) || strlen($name) > 100 ) {
		return false;
	}
}

function checkZipCode ($zip) {
	if (!preg_match("#^[[:alnum:]( |-)]{2, 99}$#", $name) || strlen($name) > 100 ) {
		return false;
	}
}