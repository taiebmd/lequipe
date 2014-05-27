(function(){

// create cookie
var setCookie = function(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime()+(exdays*24*60*60*1000));
	var expires = "expires="+d.toGMTString();
	document.cookie = cname + "=" + cvalue + "; " + expires;
},

// get cookie
getCookie = function(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++) 
	{
		var c = ca[i].trim();
		if (c.indexOf(name)==0) return c.substring(name.length,c.length);
	}
	return null;
},

// delete cookie
deleteCookie = function(cname) {
	document.cookie = cname + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
},

// create petition cookie
createCookie = function(data) {
	var cookie = {
		count: data.count,
		email: data.email
	};
	setCookie('petitionEquipe', $.toJSON(cookie), 365);
},

// build the ReCaptcha panel
createReCaptcha = function() {
	if(Recaptcha) {
		Recaptcha.create("6LdIzOoSAAAAAG8WFK-egkYF-u4fpd36CqYkn3Om",
			"captcha",
			{
				lang : 'fr',
				theme : 'clean',
				callback: function() {
					$('#recaptcha_response_field')
						.attr('style', '')
						.attr('required', true);
					
					 // IE8 hacks
					var tr1 = $('#recaptcha_table tr').first();
					tr1.attr('style', 'height: 64px');
					tr1.children('td:nth-child(2)').attr('style', 'padding: 7px 0');
					tr1.children('td:nth-child(3)').attr('style', 'padding: 19px 7px');
				}
			}
		);
	}
},

// show the thank you screen
showSuccess = function(nb) {

	$('.invalid').removeClass('invalid');
	
	var nbSup = (nb==1) ? 'er' : 'ème';
	$('#senderNb').html(nb + '<sup>' + nbSup + '</sup>');
	
	$('#petitionMain').hide();
	$('#petitionThanks').show();
	
	updateProgress();
},

// refresh the progress header
drawProgress = function(nbSignatures) {

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

// get the nb of signatures
updateProgress = function() {
	$.ajax({
		type: 'GET',
		url: 'route.php',
		timeout: 2000,
		cache: false,
		success: function(data) {
			if(data.count) drawProgress(data.count);
		},
		error: function(e) {
			console.log('ERROR - GET count', e.responseText);
		}
	});
},

// text regex
 isText = function(str) {
	var regex = /^[a-zA-Z -]*$/;
	return regex.test(str);
},

// zipcode regex
isZipCode = function(str) {
	var regex = /^(F-)?((2[A|B])|[0-9]{2})[0-9]{3}$/;
	return regex.test(str);
},

// email regex
isEmail = function(str) {
	var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return regex.test(str);
},

// clean errors from form
cleanForm = function() {
	$('#inputErrors').empty();
	$('.invalid').removeClass('invalid');
},

// invalid input field
invalidInput = function(id, msg) {
	if(id != '') $('#'+id).addClass('invalid');
	$('#inputErrors').append('<div class="inputError">'+msg+'</div>');
},

// start ajax loader
startLoader = function() {
	$('.sign').hide();
	$('.ajaxLoader').show();
},

// stop ajax loader
 stopLoader = function() {
	$('.ajaxLoader').hide();
	$('.sign').show();
},

// fix for placeholders in IE <= 9
placeholderFix = function() {
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
};

$(document).ready(function() {

	// check cookie
	var cookie = $.parseJSON(getCookie('petitionEquipe'));
	if(cookie) {
		showSuccess(cookie.count);
	}
	else {
		//init
		placeholderFix();
		createReCaptcha();
		updateProgress();
		
		// form submit
		$('#petitionForm').submit(function(e) {
		
			e.preventDefault();
			
			// clean errors + start loader
			cleanForm();
			startLoader();
		
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
				invalidInput('signName', 'Le champ "Nom" est invalide.');
				invalid = true;
			}
			if(data.firstname.length < 2 || data.firstname.length > 999 || !isText(data.firstname)) {
				invalidInput('signFirstname', 'Le champ "Prénom" est invalide.');
				invalid = true;
			}
			if(data.email.length > 999 || !isEmail(data.email)) {
				invalidInput('signEmail', 'Le champ "Email" est invalide.');
				invalid = true;
			}
			if(data.zipcode.length < 2 || data.zipcode.length > 5 || !isZipCode(data.zipcode)) {
				invalidInput('signZipcode', 'Le champ "Code Postal" est invalide.');
				invalid = true;
			}
			if(data.response.length == '') {
				invalidInput('recaptcha_response_field', 'Le reCAPTCHA est invalide.');
				invalid = true;
			}
			
			// if everything OK, send to API
			if(!invalid)
			{
				$.ajax({
					type: 'POST',
					url: 'route.php',
					data: data,
					timeout: 2000,
					cache: false,
					success: function(data) {
						if(data) {
							createCookie(data);
							showSuccess(data.count);
						}
						stopLoader();
					},
					error: function(e) {
						console.log('ERROR - POST', e.responseText);
						var status = $.parseJSON(e.responseText);
						
						if(status.errorMessage == 'CSRF invalid') invalidInput('', 'La session a expiré.<br>Veuillez rafraîchir la page.');
						else if(status.errorMessage == 'reCAPTCHA invalid') {
							invalidInput('recaptcha_response_field', 'Recopie du code sécurité.');
							Recaptcha.reload();
						}
						else if(status.errorMessage == 'e-mail invalid') invalidInput('signEmail', 'Le champ "Email" est invalide.');
						else if(status.errorMessage == 'e-mail exists') invalidInput('signEmail', 'Cette adresse email est déjà utilisée.');
						else if(status.errorMessage == 'name invalid') invalidInput('signName', 'Le champ "Nom" est invalide.');
						else if(status.errorMessage == 'firstname invalid') invalidInput('signFirstname', 'Le champ "Prénom" est invalide.');
						else if(status.errorMessage == 'zipcode invalid') invalidInput('signZipcode', 'Le champ "Code Postal" est invalide.');
					
						stopLoader();
					}
				});
			}
			else {
				stopLoader();
			}
			
			return false;
		});
	}
	
	var worker = setInterval(updateProgress, 5000);
});

})();