'use strict';

// number of current signatures
var nbSignatures = 0;

// build the ReCaptcha panel
function createReCaptcha() {
	if(Recaptcha) {
		Recaptcha.create("6LdIzOoSAAAAAG8WFK-egkYF-u4fpd36CqYkn3Om",
			"captcha",
			{
				lang : 'fr',
				theme : 'clean',
				callback: function() {
					$('#recaptcha_response_field').attr('required', true);
					
					 // IE8 hacks
					var tr1 = $('#recaptcha_table tr').first();
					tr1.attr('style', 'height: 64px');
					tr1.children('td:nth-child(2)').attr('style', 'padding: 7px 0');
					tr1.children('td:nth-child(3)').attr('style', 'padding: 19px 7px');
				}
			}
		);
	}
}

// show the thank you screen
function showSuccess(nb) {

	$('.invalid').removeClass('invalid');
	
	var nbSup = (nb==1) ? 'er' : 'ème';
	$('#senderNb').html(nb + '<sup>' + nbSup + '</sup>');
	
	$('#petitionMain').hide();
	$('#petitionThanks').show();
	
	updateProgress();
}

// refresh the nb of  signatures
function updateProgress() {
	$.ajax({
		type: 'GET',
		url: 'route.php',
		success: function(data) {

			nbSignatures = data.count;
			var remaining = (nbSignatures>1000000) ? 'Notre but est atteint' : 'Encore ' + (1000000-nbSignatures) + ' signatures pour atteindre notre but';
			
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
			$('#remaining').html(remaining);
			
			$('#counter .counter-num').last('style', 'margin-right: 0'); // IE8 hack
		},
		error: function(e) {
			console.log('ERROR - GET count', e.responseText);
		}
	});
}

// text regex
function isText(str) {
	var regex = /^[a-zA-Z]*$/;
	return regex.test(str);
}

// alphanumeric regex
function isAlphaNumeric(str) {
	var regex = /^[a-zA-Z0-9 -]*$/;
	return regex.test(str);
}

// email regex
function isEmail(str) {
	var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return regex.test(str);
}

// invalid input field
function invalidInput(id) {
	$('#'+id).addClass('invalid');
}

// fix for placeholders in IE <= 9
function placeholderFix() {
    if($('html').hasClass('.ie7, .ie8')){
        $("[placeholder]").focus(function(){
            if($(this).val()==$(this).attr("placeholder")) $(this).val("");
        }).blur(function(){
            if($(this).val()=="") $(this).val($(this).attr("placeholder"));
        }).blur();

        $("[placeholder]").parents("form").submit(function() {
            $(this).find('[placeholder]').each(function() {
                if ($(this).val() == $(this).attr("placeholder")) {
                    $(this).val("");
                }
            })
        });
    }
}

$(document).ready(function() {

	//init
	placeholderFix();
	createReCaptcha();
	updateProgress();
	var worker = setInterval(updateProgress, 2000);
	
	// form submit
	$('#petitionForm').submit(function(e) {
	
		e.preventDefault();
		$('.invalid').removeClass('invalid');
	
		// get inputs
		var data = {};
		data.csrf = $('#CSRFName').val();
		data.name = $('#signName').val();
		data.firstname = $('#signFirstname').val();
		data.email = $('#signEmail').val();
		data.country = $('#signCountry').val();
		data.zipcode = $('#signZipcode').val();
		data.challenge = $('#recaptcha_challenge_field').val();
		data.response = $('#recaptcha_response_field').val();
		
		//validate inputs
		var invalid = false;
		if(data.name.length < 2 || data.name.length > 999 || !isText(data.name)) {
			invalidInput('signName');
			invalid = true;
		}
		if(data.firstname.length < 2 || data.firstname.length > 999 || !isText(data.firstname)) {
			invalidInput('signFirstname');
			invalid = true;
		}
		if(data.email.length > 999 || !isEmail(data.email)) {
			invalidInput('signEmail');
			invalid = true;
		}
		if(data.zipcode.length < 2 || data.zipcode.length > 999 || !isAlphaNumeric(data.zipcode)) {
			invalidInput('signZipcode');
			invalid = true;
		}
		if(data.response.length == '') {
			invalidInput('recaptcha_response_field');
			invalid = true;
		}
		
		// if everything OK, send to API
		if(!invalid)
		{
			console.log('submitted', data);
			
			$.ajax({
				type: 'POST',
				url: 'route.php',
				data: data,
				success: function(data) {
					console.log(data);
					showSuccess(data.id);
				},
				error: function(e) {
					console.log(e.responseText);
				}
			});
		}
		
		return false;
	});

});