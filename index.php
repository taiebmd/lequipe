<?php
error_reporting(0);
session_start();
$_SESSION["CSRF"] = 'CSRF_' . mt_rand();
?>
<!doctype html>
<!--[if lt IE 7 ]> <html class="ie7"> <![endif]-->
<!--[if IE 7 ]> <html class="ie7"> <![endif]-->
<!--[if IE 8 ]>  <html class="ie8"> <![endif]-->
<!--[if IE 9 ]> <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html> <!--<![endif]-->
	<head>
		<link href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700,100" rel="stylesheet" type="text/css">
		<link href="css/style.css" rel="stylesheet">
	</head>
	<body>

		<div id=sectionLeft>
			<h1>Pétition</h1>
			<h2><b>M</b>ONSIEUR <b>LE PRÉSIDENT DE LA RÉPUBLIQUE,</b>
			<br>
			<b>M</b>ESDAMES ET <b>M</b>ESSIEURS <b>LES MINISTRES</b>, </h2>
			<p class="indent">
				Le 13 juillet 2014 se déroulera la finale de la Coupe du monde. Dans l'éventualité d'une victoire de la France, nous demandons à ce que <strong>le mardi 15 juillet soit déclaré jour férié.</strong> Le 14 juillet étant déjà comme chacun sait, un jour non travaillé.
			</p>
			<p class="indent">
				La Coupe du monde, c'est ce mois sacré où le temps s'arrête, où les hommes peuvent se maquiller sans peur du regard des autres, où les femmes peuvent crier <i>« Y'a faute là »</i>, où on troque la crise et le pouvoir d'achat contre des penalties et des coups de pieds arrêtés, où l'on ne se dit plus <i>« Bonjour »</i>, mais <i>« T'as vu le match hier ? »</i>, où on tremble devant un autre spectacle que celui de sa facture téléphonique, où on rêve à autre chose qu'à une belle voiture, et où enfin, on descend dans la rue juste parce qu'on est heureux.
			</p>
			<p class="indent">
				C'est pour toutes ces raisons et bien d'autres encore, que nous L'Équipe ainsi que le peuple de France vous présentons cette pétition.
			</p>
			<p class="indent">
				Cordialement,
			</p>

			<div class="centered">
				<img class="logo-equipe" src="img/logo-equipe.png">
			</div>

			<p class="legal">
				Ces informations, recueillies par SAS L’ÉQUIPE, font l’objet d’un traitement informatique destiné à l’élaboration et la présentation de la pétition au gouvernement. Les destinataires des données sont SAS L’ÉQUIPE. Conformément à la loi « informatique et libertés » du 6 janvier 1978 modifiée en 2004, vous bénéficiez d’un droit d’accès et de rectification aux informations qui vous concernent, que vous pouvez exercer en vous adressant à «LA PÉTITION» SAS L’ÉQUIPE 4 COURS DE L’ILE SEGUIN 92130 BOULOGNE BILLANCOURT. Vous pouvez également, pour des motifs légitimes, vous opposer au traitement des données vous concernant.
			</p>
		</div>

		<div id=sectionRight>

			<div id=progress class="centered">
				<div id=counter></div>
				<p id=remaining class="italic"></p>
			</div>

			<div id=petitionMain>
				<form id=petitionForm class="centered">
					<p class="punchline red">
						Si vous soutenez l'équipe de France, <strong>signez cette pétition</strong>
					</p>
					<div class="inputs">
						<div id=inputErrors></div>

						<input id=CSRFName name=CSRFName type="hidden" value="<?php echo $_SESSION["CSRF"]; ?>">
						<input id=signName name=signName class="full" type="text" placeholder="Nom" required>
						<input id=signFirstname name=signFirstname class="full" type="text" placeholder="Prénom" required>
						<input id=signEmail name=signEmail class="full" type="email" placeholder="Email"required>

						<select id=signCountry name=signCountry class="half" required>
							<option value="France" selected>France</option>
							<option value="Afghanistan">Afghanistan</option>
							<option value="Afrique_du_Sud">Afrique du Sud</option>
							<option value="Albanie">Albanie</option>
							<option value="Algerie">Algérie</option>
							<option value="Allemagne">Allemagne</option>
							<option value="Andorre">Andorre</option>
							<option value="Angola">Angola</option>
							<option value="Antigua-et-Barbuda">Antigua-et-Barbuda</option>
							<option value="Arabie_saoudite">Arabie saoudite</option>
							<option value="Argentine">Argentine</option>
							<option value="Armenie">Arménie</option>
							<option value="Australie">Australie</option>
							<option value="Autriche">Autriche</option>
							<option value="Azerbaidjan">Azerbaïdjan</option>
							<option value="Bahamas">Bahamas</option>
							<option value="Bahrein">Bahreïn</option>
							<option value="Bangladesh">Bangladesh</option>
							<option value="Barbade">Barbade</option>
							<option value="Belau">Belau</option>
							<option value="Belgique">Belgique</option>
							<option value="Belize">Belize</option>
							<option value="Benin">Bénin</option>
							<option value="Bhoutan">Bhoutan</option>
							<option value="Bielorussie">Biélorussie</option>
							<option value="Birmanie">Birmanie</option>
							<option value="Bolivie">Bolivie</option>
							<option value="Bosnie-Herzégovine">Bosnie-Herzégovine</option>
							<option value="Botswana">Botswana</option>
							<option value="Bresil">Brésil</option>
							<option value="Brunei">Brunei</option>
							<option value="Bulgarie">Bulgarie</option>
							<option value="Burkina">Burkina</option>
							<option value="Burundi">Burundi</option>
							<option value="Cambodge">Cambodge</option>
							<option value="Cameroun">Cameroun</option>
							<option value="Canada">Canada</option>
							<option value="Cap-Vert">Cap-Vert</option>
							<option value="Chili">Chili</option>
							<option value="Chine">Chine</option>
							<option value="Chypre">Chypre</option>
							<option value="Colombie">Colombie</option>
							<option value="Comores">Comores</option>
							<option value="Congo">Congo</option>
							<option value="Cook">Cook</option>
							<option value="Coree_du_Nord">Corée du Nord</option>
							<option value="Coree_du_Sud">Corée du Sud</option>
							<option value="Costa_Rica">Costa Rica</option>
							<option value="Cote_Ivoire">Côte d'Ivoire</option>
							<option value="Croatie">Croatie</option>
							<option value="Cuba">Cuba</option>
							<option value="Danemark">Danemark</option>
							<option value="Djibouti">Djibouti</option>
							<option value="Dominique">Dominique</option>
							<option value="Egypte">Égypte</option>
							<option value="Emirats_arabes_unis">Émirats arabes unis</option>
							<option value="Equateur">Équateur</option>
							<option value="Erythree">Érythrée</option>
							<option value="Espagne">Espagne</option>
							<option value="Estonie">Estonie</option>
							<option value="Etats-Unis">États-Unis</option>
							<option value="Ethiopie">Éthiopie</option>
							<option value="Fidji">Fidji</option>
							<option value="Finlande">Finlande</option>
							<option value="Gabon">Gabon</option>
							<option value="Gambie">Gambie</option>
							<option value="Georgie">Géorgie</option>
							<option value="Ghana">Ghana</option>
							<option value="Grèce">Grèce</option>
							<option value="Grenade">Grenade</option>
							<option value="Guatemala">Guatemala</option>
							<option value="Guinee">Guinée</option>
							<option value="Guinee-Bissao">Guinée-Bissao</option>
							<option value="Guinee_equatoriale">Guinée équatoriale</option>
							<option value="Guyana">Guyana</option>
							<option value="Haiti">Haïti</option>
							<option value="Honduras">Honduras</option>
							<option value="Hongrie">Hongrie</option>
							<option value="Inde">Inde</option>
							<option value="Indonesie">Indonésie</option>
							<option value="Iran">Iran</option>
							<option value="Iraq">Iraq</option>
							<option value="Irlande">Irlande</option>
							<option value="Islande">Islande</option>
							<option value="Israël">Israël</option>
							<option value="Italie">Italie</option>
							<option value="Jamaique">Jamaïque</option>
							<option value="Japon">Japon</option>
							<option value="Jordanie">Jordanie</option>
							<option value="Kazakhstan">Kazakhstan</option>
							<option value="Kenya">Kenya</option>
							<option value="Kirghizistan">Kirghizistan</option>
							<option value="Kiribati">Kiribati</option>
							<option value="Koweit">Koweït</option>
							<option value="Laos">Laos</option>
							<option value="Lesotho">Lesotho</option>
							<option value="Lettonie">Lettonie</option>
							<option value="Liban">Liban</option>
							<option value="Liberia">Liberia</option>
							<option value="Libye">Libye</option>
							<option value="Liechtenstein">Liechtenstein</option>
							<option value="Lituanie">Lituanie</option>
							<option value="Luxembourg">Luxembourg</option>
							<option value="Macedoine">Macédoine</option>
							<option value="Madagascar">Madagascar</option>
							<option value="Malaisie">Malaisie</option>
							<option value="Malawi">Malawi</option>
							<option value="Maldives">Maldives</option>
							<option value="Mali">Mali</option>
							<option value="Malte">Malte</option>
							<option value="Maroc">Maroc</option>
							<option value="Marshall">Marshall</option>
							<option value="Maurice">Maurice</option>
							<option value="Mauritanie">Mauritanie</option>
							<option value="Mexique">Mexique</option>
							<option value="Micronesie">Micronésie</option>
							<option value="Moldavie">Moldavie</option>
							<option value="Monaco">Monaco</option>
							<option value="Mongolie">Mongolie</option>
							<option value="Mozambique">Mozambique</option>
							<option value="Namibie">Namibie</option>
							<option value="Nauru">Nauru</option>
							<option value="Nepal">Népal</option>
							<option value="Nicaragua">Nicaragua</option>
							<option value="Niger">Niger</option>
							<option value="Nigeria">Nigeria</option>
							<option value="Niue">Niue</option>
							<option value="Norvège">Norvège</option>
							<option value="Nouvelle-Zelande">Nouvelle-Zélande</option>
							<option value="Oman">Oman</option>
							<option value="Ouganda">Ouganda</option>
							<option value="Ouzbekistan">Ouzbékistan</option>
							<option value="Pakistan">Pakistan</option>
							<option value="Panama">Panama</option>
							<option value="Papouasie-Nouvelle_Guinee">Papouasie - Nouvelle Guinée</option>
							<option value="Paraguay">Paraguay</option>
							<option value="Pays-Bas">Pays-Bas</option>
							<option value="Perou">Pérou</option>
							<option value="Philippines">Philippines</option>
							<option value="Pologne">Pologne</option>
							<option value="Portugal">Portugal</option>
							<option value="Qatar">Qatar</option>
							<option value="Republique_centrafricaine">République centrafricaine</option>
							<option value="Republique_dominicaine">République dominicaine</option>
							<option value="Republique_tcheque">République tchèque</option>
							<option value="Roumanie">Roumanie</option>
							<option value="Royaume-Uni">Royaume-Uni</option>
							<option value="Russie">Russie</option>
							<option value="Rwanda">Rwanda</option>
							<option value="Saint-Christophe-et-Nieves">Saint-Christophe-et-Niévès</option>
							<option value="Sainte-Lucie">Sainte-Lucie</option>
							<option value="Saint-Marin">Saint-Marin </option>
							<option value="Saint-Siège">Saint-Siège, ou leVatican</option>
							<option value="Saint-Vincent-et-les_Grenadines">Saint-Vincent-et-les Grenadines</option>
							<option value="Salomon">Salomon</option>
							<option value="Salvador">Salvador</option>
							<option value="Samoa_occidentales">Samoa occidentales</option>
							<option value="Sao_Tome-et-Principe">Sao Tomé-et-Principe</option>
							<option value="Senegal">Sénégal</option>
							<option value="Seychelles">Seychelles</option>
							<option value="Sierra_Leone">Sierra Leone</option>
							<option value="Singapour">Singapour</option>
							<option value="Slovaquie">Slovaquie</option>
							<option value="Slovenie">Slovénie</option>
							<option value="Somalie">Somalie</option>
							<option value="Soudan">Soudan</option>
							<option value="Sri_Lanka">Sri Lanka</option>
							<option value="Sued">Suède</option>
							<option value="Suisse">Suisse</option>
							<option value="Suriname">Suriname</option>
							<option value="Swaziland">Swaziland</option>
							<option value="Syrie">Syrie</option>
							<option value="Tadjikistan">Tadjikistan</option>
							<option value="Tanzanie">Tanzanie</option>
							<option value="Tchad">Tchad</option>
							<option value="Thailande">Thaïlande</option>
							<option value="Togo">Togo</option>
							<option value="Tonga">Tonga</option>
							<option value="Trinite-et-Tobago">Trinité-et-Tobago</option>
							<option value="Tunisie">Tunisie</option>
							<option value="Turkmenistan">Turkménistan</option>
							<option value="Turquie">Turquie</option>
							<option value="Tuvalu">Tuvalu</option>
							<option value="Ukraine">Ukraine</option>
							<option value="Uruguay">Uruguay</option>
							<option value="Vanuatu">Vanuatu</option>
							<option value="Venezuela">Venezuela</option>
							<option value="Viet_Nam">Viêt Nam</option>
							<option value="Yemen">Yémen</option>
							<option value="Yougoslavie">Yougoslavie</option>
							<option value="Zaire">Zaïre</option>
							<option value="Zambie">Zambie</option>
							<option value="Zimbabwe">Zimbabwe</option>
						</select>

						<input id=signZipcode name=signZipcode class="half" type="text" placeholder="Code Postal" required>
					</div>

					<div id=captcha></div>

					<p class="instructions italic">
						Tous les champs sont obligatoires.
						<br>
						Chaque participant ne peut signer la pétition qu'une seule fois.
					</p>
					<button class="sign" title="Signez la pétition">
						Signez la pétition
					</button>
					<div class="ajaxLoader"><img src="img/ajax-loader.gif">
					</div>
				</form>

				<hr class="dotted">

				<div id=pdf class="centered">
					<p>
						Téléchargez, imprimez,
						<br>
						et remplissez la pétition pour faire
						<br>
						signer tous vos proches
					</p>
					<a href="petition.pdf" target="_blank">
						<button class="pdfBtn" title="Téléchargez le pdf">
							Téléchargez le pdf
						</button>
					</a>
				</div>

				<hr class="dotted">

			</div>

			<div id=petitionThanks class="centered">

				<p class="red">
					<strong> <span class="huge">Merci</span>
					<br>
					de votre soutien </strong>
				</p>
				<hr class="thick">
				<p class="red">
					Vous êtes le
					<br>
					<strong id=senderNb class="huge"></strong>
					<br>
					participant
					<br>
					à avoir signé en ligne !
				</p>
				<hr class="thick">
				<p class="bottomMsg">
					N'hésitez pas
					<br>
					à faire signer
					<br>
					cette pétition
					<br>
					autour de vous
					<a href="petition.pdf" target="_blank">
						<button class="pdfBtn" title="Téléchargez le pdf">
							Téléchargez le pdf
						</button>
					</a>
				</p>

			</div>

			<div id=social class="centered">
				<p class="red">
					Partagez la pétition
				</p>

				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
					<a class="addthis_button_twitter"></a>
					<a class="addthis_button_facebook"></a>
				</div>
				<script type="text/javascript">
					var addthis_config = {
						"data_track_addressbar" : false
					};
					
					var addthis_share = {
					  	"url": "http://lequipe.fr/petition",
						"description": "Faites comme moi, engagez-vous à faire du 15 juillet un jour ferié"
					};
				</script>
				<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-538353f3212340c8"></script>
				<!-- AddThis Button END -->
			</div>

		</div>
		<div class="clear"></div>

		<script src="http://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
		<script src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js" type="text/javascript"></script>
		<script src="js/json.js" type="text/javascript"></script>
		<script src="js/main.js" type="text/javascript"></script>

		<script>
			(function(i, s, o, g, r, a, m) {
				i['GoogleAnalyticsObject'] = r;
				i[r] = i[r] ||
				function() {
					(i[r].q = i[r].q || []).push(arguments)
				}, i[r].l = 1 * new Date();
				a = s.createElement(o), m = s.getElementsByTagName(o)[0];
				a.async = 1;
				a.src = g;
				m.parentNode.insertBefore(a, m)
			})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
			ga('create', 'UA-51180784-1', 'ddbparis.net');
			ga('send', 'pageview');
		</script>

	</body>
</html>