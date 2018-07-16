<?php
require_once('functii.php'); // Aceasta functie incarca totate functiile din fisierul functii.php

if(empty($_POST['login_nume'])) { $_POST['login_nume'] = ""; } // In caz ca datele nu sunt setate, seteaza automat "null" pentru a nu genera erori si brese de securitate.
if(empty($_POST['login_parola'])) { $_POST['login_parola'] = ""; } // In caz ca datele nu sunt setate, seteaza automat "null" pentru a nu genera erori si brese de securitate.
if(empty($_POST['login'])) { $_POST['login'] = ""; } // In caz ca datele nu sunt setate, seteaza automat "null" pentru a nu genera erori si brese de securitate.

if(!empty($_COOKIE['login_redirect'])) { $redirect_login_catre = $_COOKIE['login_redirect']; } else { $redirect_login_catre = "/"; } // In caz ca datele nu sunt setate, seteaza automat "/" pentru a nu genera erori si brese de securitate.

conectare($_POST['login_nume'], $_POST['login_parola'], $redirect_login_catre, $_POST['login']); // Aceasta este functia care efectueaza verificarile si conectarea utilizatorului in caz ca toate datele sunt corecte.
?>
<?php
if(este_conectat()) { // Daca utilizatorul este conectat atunci afiseaza mesajul de eroare precum ca este deja conectat.
?>
<html>
<head>
<title>Hopa... Se pare ca sunteti deja autentificat.</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body style="background: url(http://www.baxandrei.ro/site/img/pattern) repeat;">
<div class="container">
		<div class="row">
			<div class="col-lg-6 text-center" style="float: none; margin: 0 auto;">

<div class="col-lg-12 text-center" style="float: none; margin: 0 auto;">

<br><br><br>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Pentru a continua, va rugam sa va autentificati.</h3>
  </div>
  <div class="panel-body" style="margin-left:5px; margin-right:5px;">
<div class="alert alert-dismissible alert-danger">
  <strong>Eroare!<br></strong> Sunteti deja conectat.
</div>

<a href="<?php echo adresa_site; ?>" class="btn btn-primary">« Mergi pe pagina Principala</a>

</div>
			
  </div>
</div>
			
			</div>
		</div>
</div>
</body>
</html>
<?php
} else { // Daca utilizatorul nu este conectat atunci afiseaza pagina de conectare. ?>
<html>
<head>
<title>Ne pare rau, trebuie sa fiti autentificat pentru a accesa <?php if(isset($redirect_login_catre) && !empty($redirect_login_catre)) { echo $redirect_login_catre;} else { echo "pagina dorita."; } //Aceasta functie pune in titlu automat numele paginii pe care utilizatorul doreste sa o acceseze. ?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body style="background: url(http://www.baxandrei.ro/site/img/pattern) repeat;">
<div class="container">
		<div class="row">
			<div class="col-lg-6 text-center" style="float: none; margin: 0 auto;">

<div class="col-lg-12 text-center" style="float: none; margin: 0 auto;">

<br><br><br>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Pentru a continua, va rugam sa va autentificati.</h3>
  </div>
  <div class="panel-body" style="margin-left:5px; margin-right:5px;">

<form class="form-horizontal" method="post">

  <fieldset>
	 <?php if(isset($_COOKIE['date_gresite'])) { // Daca datele introduse sunt incorecte afiseaza mesajul de eroare. ?>
<div class="alert alert-dismissible alert-danger">
  <strong>Eroare!<br></strong> Este posibil ca numele de utilizator si/sau parola sa fie gresite sau sa nu existe.
</div>
	 <?php } ?>
	
    <div class="form-group">
        <input type="text" class="form-control" id="nume" name="login_nume" placeholder="Nume">
    </div>
    <div class="form-group">
        <input type="password" class="form-control" id="parola" name="login_parola" placeholder="Parola">
    </div>
    <div class="form-group">
        <input style="display:none;" type="text" class="form-control" value="<?php echo $redirect_login_catre; // Daca datele sunt corecte atunci redirectioneaza utilizatorul catre locul dorit. ?>" name="redirect">
        <button type="reset" class="btn btn-default">Reseteaza campurile</button>
        <button type="submit" name="login" value="conectare" class="btn btn-primary">Autentificare</button>
    </div>
  </fieldset>
</form>
</div>
			
  </div>
</div>
			
			</div>
		</div>
</div>

<script>$('.alert').delay(5000).fadeOut('slow');</script>
</body>
</html>
<?php if(isset($_COOKIE['date_gresite'])) { unset($_COOKIE['date_gresite']); setcookie('date_gresite', null, -1, '/'); } // Daca este setat cookie-ul "date_gresite" atunci il poti sterge. ?>
<?php if(isset($_COOKIE['login_redirect'])) { unset($_COOKIE['login_redirect']); setcookie('login_redirect', null, -1, '/'); } // Daca este setat cookie-ul "login_redirect" atunci il poti sterge. ?>
<?php } ?>