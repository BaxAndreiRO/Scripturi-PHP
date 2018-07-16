<?php
// Inceput COD
// Pentru a activa scriptul pe pagina dorita nu trebuie decat sa adaugati aceste cod sus de tot pe pagina, exact ca aici.
require_once('functii.php'); // Aceasta functie incarca totate functiile din fisierul functii.php
conectare_obligatorie(); // Aceasta functie specifica faptul ca aceasta pagina nu se poate accesa fara ca utilizatorul sa fie conectat.
// Sfarsit COD
?>
<html>
<head>
<title>Autentificare cu success! - wWw.BaxAndrei.Ro - Script Autentificare si protejare pagini cu parola.</title>
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
<div class="alert alert-dismissible alert-success">
  <strong>Exemplu pagina protejata cu parola pentru <a href="http://www.baxandrei.ro/sistem-autentificare-si-pagini-protejate-cu-autentificare/">"Sistem autentificare si pagini protejate cu autentificare"</a><br></strong><br>
  Dupa cum vedeti, acest script functioneaza fara nici o problema.<br><br>
  <a href="?deconectare"><b>Deconectare ?</b></a>
</div>

<a href="http://baxandrei.ro" class="btn btn-info">« Mai multe Scripturi PHP »</a>

</div>
			
  </div>
</div>
			
			</div>
		</div>
</div>
</body>
</html>