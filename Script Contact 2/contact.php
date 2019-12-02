<?php
$cod_secret_recaptcha = "SECRET";
$email_admin = "contact@exemplu.ro";
$nume_site = "Exemplu.Ro";
$adresa_site = "http://exemplu.ro";

foreach ($_POST as $cheie => $valoare) {
 $valoare = str_replace('"', "&#x22;", $valoare);
 $valoare = str_replace("'", "&#x27;", $valoare);
 $valoare = strip_tags($valoare);
 $_POST[$cheie] = $valoare;
}

function ip_utilizator() {
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

function verifica_grecaptcha($cod,$ip) {
	global $cod_secret_recaptcha;
	$grecaptcha_verificare=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$cod_secret_recaptcha&response=$cod&remoteip=$ip");
	$raspuns_verificare_grecaptcha = json_decode($grecaptcha_verificare,true);
	if(intval($raspuns_verificare_grecaptcha ["success"]) !== 1) {
		return false;
	} else {
		return true;
	}
}

if(empty($_POST['recaptcha']) || empty($_POST['nume']) || empty($_POST['email']) || empty($_POST['departament']) || empty($_POST['subiect']) || empty($_POST['mesaj'])) {
	$campuri_necesare = '';
	if(empty($_POST['recaptcha'])) { exit('{"eroare": true,"mesaj_eroare": "Va rugam sa efectuati verificarea de securitate."}'); }
	if(empty($_POST['nume'])) { $campuri_necesare = '"formular_contact_baxandreiro_nume",'; }
	if(empty($_POST['email'])) { $campuri_necesare = $campuri_necesare.'"formular_contact_baxandreiro_email",'; }
	if(empty($_POST['departament'])) { $campuri_necesare = $campuri_necesare.'"formular_contact_baxandreiro_departament",'; }
	if(empty($_POST['subiect'])) { $campuri_necesare = $campuri_necesare.'"formular_contact_baxandreiro_subiect",'; }
	if(empty($_POST['mesaj'])) { $campuri_necesare = $campuri_necesare.'"formular_contact_baxandreiro_mesaj",'; }
	exit('{"eroare": true,"mesaj_eroare": "Va rugam sa completati toate campurile.","campuri_necesare":['.substr($campuri_necesare, 0, -1).']}');
}

if(!verifica_grecaptcha($_POST['recaptcha'],ip_utilizator())) {
	exit('{"eroare": true,"mesaj_eroare": "Se pare ca ai fost detectat ca fiind un robot spam."}');
}

if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  exit('{"eroare": true,"mesaj_eroare": "Va rugam sa introduceti o adresa de e-mail valida.","campuri_necesare":["formular_contact_baxandreiro_email"]}');
}

$continutul_mesajului = '<style>
	img,a img {
		border:0;
		height:auto;
		outline:none;
		text-decoration:none;
	}
	body {
		margin:0;
		padding:0;
		background-color: #e9eaec;
	}
	img {
		-ms-interpolation-mode:bicubic;
	}
	h1 {
		color:#202020;
		font-family: fantasy;
		font-size:45px;
		font-style:normal;
		font-weight:bold;
		line-height:125%;
		letter-spacing:normal;
		text-align:center;
		margin-bottom: 0px;
	}
</style>
<table width="100%" height="100%">
	<tr>
		<td valign="top">
			<div style="margin:50px 25px;">
				<div style="background-color: #FFFFFF;border: 1px solid #c1c1c1;max-width:550px;margin:auto;padding-right: 30px;padding-left: 30px;">
					<h1>'.$nume_site.'</h1>
					<p style="border-top: 1px solid #dddddd; font-size: 16px; color:#555555; font-family: \'Helvetica Neue\', Helvetica, Arial, \'Lucida Grande\', sans-serif; line-height:150%; text-align:left;">
						<br>
						<b>Nume</b>
						<br>
						'.$_POST['nume'].'
						<br>
					</p>
					<p style="border-top: 1px solid #dddddd; font-size: 16px; color:#555555; font-family: \'Helvetica Neue\', Helvetica, Arial, \'Lucida Grande\', sans-serif; line-height:150%; text-align:left;">
						<br>
						<b>E-mail</b>
						<br>
						<a style="color: #ff7f50;" href="mailto:'.$_POST['email'].'">'.$_POST['email'].'</a>
						<br>
					</p>
					<p style="border-top: 1px solid #dddddd; font-size: 16px; color:#555555; font-family: \'Helvetica Neue\', Helvetica, Arial, \'Lucida Grande\', sans-serif; line-height:150%; text-align:left;">
						<br>
						<b>Subiect</b>
						<br>
						'.$_POST['subiect'].'
						<br>
					</p>
					<p style="border-top: 1px solid #dddddd; font-size: 16px; color:#555555; font-family: \'Helvetica Neue\', Helvetica, Arial, \'Lucida Grande\', sans-serif; line-height:150%; text-align:left;">
						<br>
						<b>Departament</b>
						<br>
						'.$_POST['departament'].'
						<br>
					</p>
					<p style="border-top: 1px solid #dddddd; font-size: 16px; color:#555555; font-family: \'Helvetica Neue\', Helvetica, Arial, \'Lucida Grande\', sans-serif; line-height:150%; text-align:left;">
						<br>
						<b>Mesaj</b>
						<br>
						<strong style="white-space: pre-wrap; font-weight:normal;">'.$_POST['mesaj'].'</strong>
						<br>
					</p>
					<br>
				</div>
				<br>
				<p style="text-align:center; color:#aaa; font-family: \'Helvetica Neue\', Helvetica, Arial, \'Lucida Grande\', sans-serif; font-size:15px;">
					Trimis prin intermediul formularului de contact de pe <a href="'.$adresa_site.'" style="color: #bbbbbb" target="_blank" rel="noreferrer">'.$nume_site.'</a>
				</p>
			</div>
		</td>
	</tr>
</table>';
	

$subiect_email = $_POST['subiect']." - Mesaj nou de contact de pe ".$nume_site;
$headers = "From: ".$_POST['nume']." <".$_POST['email'].">\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=utf-8\r\n";
$headers .= "X-Priority: 1\r\n";
$headers .= "X-MSMail-Priority: High\r\n";
$headers .= "X-Mailer: ".$nume_site." Mail Service\r\n";
$headers .= "Reply-To: ".$_POST['nume']." <".$_POST['email'].">\r\n";
$trimite_mesaj = mail($email_admin,$subiect_email,$continutul_mesajului,$headers);

if($trimite_mesaj) {
	exit('{"eroare": false}');
} else {
	exit('{"eroare": true,"mesaj_eroare": "Se pare ca mesajul nu a putut fi trimis. Va rugam sa incercati din nou, iar in cazul in care problema persista sa ne contactati pe Facebook."}');
}