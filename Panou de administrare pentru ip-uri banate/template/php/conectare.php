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

<div class="panel panel-default">
  <div class="panel-heading"><?php echo titlu_pagina($pagina); ?></div>
  <div class="panel-body">
<form method="post" action="<?php echo adresa_curenta(); ?>">
  <fieldset>
    <legend><?php if(isset($status_conectare) && $status_conectare === "date_corecte") { ?>Conectare in curs ...<?php } else { ?>Pentru a continua va rugam sa va autentificati!<?php } ?></legend>
	 
	 <?php if(isset($_POST['trimite_login']) && $status_conectare != "date_corecte") { ?>
	 <?php if($status_conectare === "parola_incorecta") { ?>
	 <div class="alert alert-bx alert-dismissible alert-danger">
	 <button type="button" class="close" data-dismiss="alert">x</button>
	 <strong>Ne pare rau!<br></strong> Parola introdusa nu este corecta!
	 </div>
	 <?php } ?>
	 <?php if($status_conectare === "utilizator_inexistent") { ?>
	 <div class="alert alert-bx alert-dismissible alert-danger">
	 <button type="button" class="close" data-dismiss="alert">x</button>
	 <strong>Ne pare rau!<br></strong> Numele de utilizator specificat nu exista!
	 </div>
	 <?php } ?>
	 <?php } elseif(isset($status_conectare) && $status_conectare === "date_corecte") { ?>
	 <div class="alert alert-bx alert-dismissible alert-info">
	 <strong>Felicitari!<br></strong> Datele introduse sunt corecte, conectarea se va efectua in cateva secunde!
	 </div>
	 <style>.form-control,.btn-default,.btn-primary { display:none; }</style>
	 <?php } ?>
	
    <div class="form-group">
        <input type="text" class="form-control" id="nume" name="nume" placeholder="Va rugam sa introduceti numele de utilizator.">
    </div>
    <div class="form-group">
        <input type="password" class="form-control" id="parola" name="parola" placeholder="Va rugam sa introduceti parola utilizatorului.">
    </div>
    <div class="form-group">
        <button type="reset" class="btn btn-default">Reseteaza campurile</button>
        <button type="submit" name="trimite_login" value="autentificare" class="btn btn-primary">Autentificare</button>
    </div>
  </fieldset>
</form>
  </div>
</div>