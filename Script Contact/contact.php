<?php

$trimite_catre = 'BaxAndrei.Ro Owner <bax@baxandrei.ro>';
$php_mail_nume_site = "BaxAndrei.Ro";
$ip_utilizator = strip_tags($_SERVER['REMOTE_ADDR']);

if(isset($_POST['trimite']) && !empty($_POST['trimite']) && isset($_POST['mesaj']) && !empty($_POST['mesaj']) && isset($_POST['subiect']) && !empty($_POST['subiect']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['nume']) && !empty($_POST['nume'])) {

$continutul_mesajului = '<div bgcolor="#f3f3f3" style="margin:0;padding:0">
<table cellspacing="0" cellpadding="0" border="0" width="100%">
	<tbody><tr>
		<td style="padding:10px">
			<table cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="border:1px solid #cfcfcf;width:750px;margin-left:auto;margin-right:auto;font-family:arial,helvetica,sans-serif;border-spacing:0">
				<tbody><tr>
					<td height="85" width="750" colspan="2"><br><h1><center>'.$php_mail_nume_site.'</center></h1></td>
				</tr>
				<tr>
					<td width="697">
						<table width="100%" bgcolor="white" cellspacing="0" cellpadding="0" border="0" style="color:#3e3e3e">
							<tbody><tr>
								<td style="padding:30px 0 0 0">
								<p style="font-weight:bold;font-size:15px;margin-left:25px">Salutare,<br></p>
								<p style="font-size:15px;margin-left:25px">Urmatorul mesaj a fost primit de la '.strip_tags($_POST['nume']).' prin intermediul formularului de contact de pe site.<br></p>
								<p style="font-weight:bold;font-size:15px;margin-left:25px"><br>Mai jos este mesajul detaliat:<br></p>
								<p style="font-size:15px;margin-left:25px">Adresa IP a lui '.strip_tags($_POST['nume']).': <a href="https://who.is/whois-ip/ip-address/'.$ip_utilizator.'">'.$ip_utilizator.'</a><br></p>
								<p style="font-weight:bold;font-size:15px;margin-left:25px"><br>Subiectul mesajului:<br></p>
								<p style="font-size:15px;margin-left:25px"><i>'.strip_tags($_POST['subiect']).'</i><br></p>
								<p style="font-weight:bold;font-size:15px;margin-left:25px"><br>Mesajul trimis de la '.strip_tags($_POST['nume']).' catre dumneavoastra:<br></p>
								<p style="font-size:15px;margin-left:25px"><i>'.strip_tags($_POST['mesaj']).'</i><br></p>
								</td>
							</tr>
							<tr>
								<td height="15">&nbsp;</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
			</tbody></table>
			<table style="width:750px;margin-left:auto;margin-right:auto;font-family:arial,helvetica,sans-serif">
				<tbody><tr>
					<td style="font-size:11px;color:#7b7b7b;text-align:center">&copy; '.date('Y').' '.$php_mail_nume_site.'</td>
				</tr>
			</tbody></table>
		</td>
	</tr>
</tbody></table></div>';

$php_mail_subiect = "Mesaj de contact de pe $php_mail_nume_site. (".strip_tags($_POST['subiect']).")";
$php_mail_continut_mesaj = $continutul_mesajului;
$php_mail_headers = "From: $trimite_catre\n";
$php_mail_headers .= "Reply-To: ".strip_tags($_POST['nume'])." <".strip_tags($_POST['email']).">\r\n";
$php_mail_headers .= "MIME-Version: 1.0\r\n";
$php_mail_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$php_mail_headers .= "X-Priority: 1\r\n";
$php_mail_headers .= "X-MSMail-Priority: High\r\n";
$php_mail_headers .= "X-Mailer: $php_mail_nume_site Mail Service\r\n";
$php_mail_trimite_mesaj = mail($trimite_catre,$php_mail_subiect,$php_mail_continut_mesaj,$php_mail_headers);

if($php_mail_trimite_mesaj) { $mesaj_php = "trimis"; } else { $mesaj_php = "netrimis"; }

} else { $mesaj_php = 'necompletat'; }

?>

<html>
<head>
<title><?php echo $php_mail_nume_site; ?> - Contact</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body style="background: url(http://www.baxandrei.ro/site/img/pattern) repeat;">
<div class="container">
		<div class="row">

<div class="col-lg-12" style="float: none; margin: 0 auto;">

<br><br><br>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Contacteaza-ne!</h3>
  </div>
  <div class="panel-body" style="margin-left:5px; margin-right:5px;">

<?php if($mesaj_php == "necompletat") { ?>
<div class="alert alert-danger text-center">
  <strong>Ne pare rau, dar accesul direct asupra acestei pagini este strict interzis. Va rugam sa va intoarceti <a href="index.html">inapoi</a> si sa completati toate campurile.</strong>
</div>
<?php } ?>
<?php if($mesaj_php == "trimis") { ?>
<div class="alert alert-success text-center">
  <strong>Felicitari <?php echo $_POST['nume']; ?>, mesajul tau a fost trimis! Iti multumim pentru timpul acordat.</strong>
</div>
<?php } ?>
<?php if($mesaj_php == "netrimis") { ?>
<div class="alert alert-warning text-center">
  <strong>Ne pare rau <?php echo $_POST['nume']; ?>, dar mesajul nu poate fi trimis momentan. Va rugam sa <a href="index.html">reincercati</a>, iar daca problema persista sa contactati un Administrator.</strong>
</div>
<?php } ?>
	  
<center><a href="http://baxandrei.ro" class="btn btn-info">« Mai multe Scripturi PHP »</a></center>

</div>
			
  </div>
</div>
			
		</div>
</div>
</body>
</html>