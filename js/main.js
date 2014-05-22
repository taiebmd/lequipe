'use strict';

// number of current signatures
var nbSignatures = 0;

// build the ReCaptcha panel
function createReCaptcha() {
	Recaptcha.create("6LdIzOoSAAAAAG8WFK-egkYF-u4fpd36CqYkn3Om",
		"captcha",
		{
			lang : 'fr',
			theme : 'clean',
			callback: function() {
				$('#recaptcha_response_field').attr('required', true);
			}
		}
	);
}

// show the thank you screen
function showSuccess(nb) {

	$('.invalid').removeClass('invalid');
	
	var nbSup = (nb==1) ? 'er' : 'ème';
	$('#senderNb').html(nb + '<sup>' + nbSup + '</sup>');
	
	$('#petitionMain').hide();
	$('#petitionThanks').show();
}

// refresh the nb of  signatures
function updateNbSignatures() {

	// REPLACE BY AJAX  CALL !!!
	nbSignatures = Math.floor(Math.random()*1000000);
	
	var split = (nbSignatures+'').split('');
	var counters = '';
	
	for(var i=0; i<split.length; i++) {
		if(i>0 && (split.length - i)%3 == 0) {
			// number spacing
			counters += '<span class="counter-space"></span>';
		}
		counters += '<span class="counter-num">' + split[i] + '</span>';
	}
	
	$('#counter').html(counters);
}

// email regex
function isEmail(str) {
	var regex = /[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/;
	return regex.test(str);
}

// invalid input field
function invalidInput(id) {
	$('#'+id).addClass('invalid');
}

$(document).ready(function() {

	//init
	createReCaptcha();
	updateNbSignatures();
	
	// form submit
	$('#petitionForm').submit(function(e) {
	
		e.preventDefault();
	
		// get inputs
		var data = {};
		data.name = $('#signName').val();
		data.firstname = $('#signFirstname').val();
		data.email = $('#signEmail').val();
		data.country = $('#signCountry').val();
		data.zipcode = $('#signZipcode').val();
		data.challenge = $('#recaptcha_challenge_field').val();
		data.response = $('#recaptcha_response_field').val();
		
		//validate inputs
		if(data.name.length > 100) invalidInput('signName');
		else if(data.firstname.length > 100) invalidInput('signFirstname');
		else if(data.email.length > 100 || !isEmail(data.email)) invalidInput('signEmail');
		else if(data.country.length > 100) invalidInput('signCountry');
		else if(data.zipcode.length > 100) invalidInput('signZipcode');
		else 
		{
			// if everything OK, send to API
		
			// REPLACE BY AJAX  CALL !!!
			console.log('submitted', data);
			
			var nbSender = Math.floor(Math.random()*5000) + 1;
			showSuccess(nbSender);
		}
		
		return false;
	});

});