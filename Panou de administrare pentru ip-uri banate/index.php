<?php
require_once("inc/php/functii.php");
?>
<?php

if(isset($_POST['trimite_login']) && isset($_POST['nume']) && isset($_POST['parola'])) {
	
$parola_utilizator = $_POST['parola'];
$utilizator_login = $_POST['nume'];
	
if($utilizator_login === webmaster_nume) {
if($parola_utilizator != webmaster_parola) { $status_conectare = "parola_incorecta"; } else {
$status_conectare = "date_corecte";
setcookie('utilizator', webmaster_nume, time() + (durata_cookie_s), "/");
setcookie('parola', md5(webmaster_parola), time() + (durata_cookie_s), "/");
}
} else {
if(file_exists(cale_conturi_utilizatori."$utilizator_login")) { 
if(md5($parola_utilizator) === md5(file_get_contents(cale_conturi_utilizatori."$utilizator_login"))) {
$status_conectare = "date_corecte";
setcookie('utilizator', $utilizator_login, time() + (durata_cookie_s), "/");
setcookie('parola', md5($parola_utilizator), time() + (durata_cookie_s), "/");
} else { $status_conectare = "parola_incorecta"; }
} else { $status_conectare = "utilizator_inexistent"; }
}
}

?>
<HTML>
<HEAD>
<title><?php echo titlu_pagina($pagina); ?></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://bootswatch.com/<?php echo nume_tema; ?>/bootstrap.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="<?php echo adresa_site; ?>template/bootstrap/js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>
<script>jQuery(document).ready(function(){$.backstretch("<?php echo imagine_fundal; ?>");});</script>
<style>body { background-color: <?php echo culoare_fundal; ?>; }</style>
<style>#preloader  {     position: fixed;     top: 0;     left: 0;     right: 0;     bottom: 0;     background-color: #fefefe;     z-index: 999999;    height: 100%; } #status  {     width: 200px;     height: 200px;     position: absolute;     left: 50%;     top: 50%;     background-image: url(http://www.baxandrei.ro/wp-content/uploads/2016/04/ajax-loader.gif);     background-repeat: no-repeat;     background-position: center;     margin: -100px 0 0 -100px; }</style>
<style>div#social{position:fixed;left:0;bottom:400px}div#element{width:45.16px;height:51px;font-size:41;text-align:right;cursor:alias}.facebook{background:#4965A0}.youtube{background:#cc181e;margin-right:3px}.twitter{background:#0084B4}i.fa{color:#fff;margin:5px}i.fa:hover{opacity:.5}div#element:hover{width:55px}div#cadru_player_radio{position:fixed;width:100%;bottom:0}</style>
</HEAD>
<BODY>
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>


<?php include cale_director_template."meniu.php"; ?>

<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center" style="float: none; margin: 0 auto;">

<?php include cale_director_template."$pagina.php"; ?>
			
			</div>
		</div>
</div>

<center><code>Website created by <a href="http://www.baxandrei.ro">BaxAndrei</a>.</code></center>

<br>

</BODY>
<?php if(isset($status_conectare) && $status_conectare === "date_corecte") { ?>
<script>var _0x431b=["\x66\x61\x64\x65\x4F\x75\x74","\x23\x73\x74\x61\x74\x75\x73","\x73\x6C\x6F\x77","\x64\x65\x6C\x61\x79","\x23\x70\x72\x65\x6C\x6F\x61\x64\x65\x72","\x6C\x6F\x61\x64"];jQuery(window)[_0x431b[5]](function(){jQuery(_0x431b[1])[_0x431b[0]]();jQuery(_0x431b[4])[_0x431b[3]](1000)[_0x431b[0]](_0x431b[2])})
window.location.replace("<?php echo adresa_site; ?>");</script>
<?php } else { ?>
<script>var _0x431b=["\x66\x61\x64\x65\x4F\x75\x74","\x23\x73\x74\x61\x74\x75\x73","\x73\x6C\x6F\x77","\x64\x65\x6C\x61\x79","\x23\x70\x72\x65\x6C\x6F\x61\x64\x65\x72","\x6C\x6F\x61\x64"];jQuery(window)[_0x431b[5]](function(){jQuery(_0x431b[1])[_0x431b[0]]();jQuery(_0x431b[4])[_0x431b[3]](1000)[_0x431b[0]](_0x431b[2])})
$('.alert-bx').delay(5000).fadeOut('slow');</script>
<?php } ?>
<?php if(!empty($_POST['deconectare'])) { ?>
<script>window.location.replace("<?php echo adresa_site; ?>");</script>
<?php } ?>
<?php mysqli_close($mysqli); ?>
</HTML>