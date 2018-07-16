<?php require_once('.functii.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="BaxAndrei.Ro">

    <title><?php echo $nume_site; ?> - Parteneriate</title>
	
    <link rel="stylesheet" href="https://www.cdn.baxandrei.ro/bootstrap/css/paper.css">
	<link rel="stylesheet" href="https://www.cdn.baxandrei.ro/toastr/toastr.min.css">

  </head>

  <body>

    <div class="container">
 
 <br><br>
 
<div class="jumbotron">
  <h1 class="text-center">Bun venit!</h1>
  
<form class="form-horizontal" method="post" action="<?php echo $adresa_site_curent; ?>/procesare-cerere.php">
<fieldset>

<legend class="text-center">Daca doriti sa deveniti partener al <?php echo $nume_site; ?> va rugam sa completati formularul de mai jos.</legend>

<div class="form-group">
  <label class="col-md-4 control-label" for="Nume site">Numele Dvs.</label>  
  <div class="col-md-6">
  <input name="nume_detinator" type="text" placeholder="Numele Dvs." class="form-control input-md" required="" autocomplete="off">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="Nume site">Mail Contact</label>  
  <div class="col-md-6">
  <input name="mail_detinator" type="email" placeholder="O adresa de mail pe care sa va putem contacta la nevoie" class="form-control input-md" required="" autocomplete="off">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="Nume site">Nume site</label>  
  <div class="col-md-6">
  <input name="nume_site" type="text" placeholder="Denumirea site-ului" class="form-control input-md" required="" autocomplete="off">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textarea">Descriere site</label>
  <div class="col-md-6">                     
    <textarea class="form-control" name="descriere_site" style="resize:none;" placeholder="Scurta descriere a site-ului" required="" autocomplete="off"></textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="adresa_site">Adresa site</label>  
  <div class="col-md-6">
  <input id="adresa_site" name="adresa_site" type="url" placeholder="Adresa site-ului" class="form-control input-md" required="" autocomplete="off">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="adresa_minibanner">Adresa Mini-Banner</label>  
  <div class="col-md-6">
  <input name="adresa_minibanner" type="url" placeholder="Adresa Mini-Banner-ului" class="form-control input-md" required="" autocomplete="off">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textarea">Cod parteneriat <?php echo $nume_site; ?></label>
  <div class="col-md-6">                     
    <textarea readonly class="form-control" style="resize:none;" id="codparteneriat" onclick="this.select(); document.execCommand('copy'); window.getSelection().removeAllRanges(); toastr['success']('Va rugam sa introduceti acest cod inainte de a trimite cererea.', 'Codul a fost copiat pe tastatura!'); document.getElementById('casuta-cod-ceck').checked = true;" required="" autocomplete="off"></textarea>
	<input type="checkbox" id="casuta-cod-ceck" required> Am adaugat codul de parteneriat pe site-ul meu.
  </div>
</div>

<div class="form-group">
  <div class="col-md-10 col-md-offset-1">    
	<br>
	<center><h3 class="text-warning">Informatie!</h3></center>
    <textarea readonly class="form-control" style="resize:none;" id="informatie" required="" autocomplete="off"></textarea>
	<input type="checkbox" required> Am luat la cunostiinta informatiile de mai sus.
  </div>
</div>

<div class="form-group">
  <center>
    <button type="submit" id="trimitere" name="trimitere" class="btn btn-success">Trimite cererea</button>
    <button type="reset" id="resetare" name="resetare" class="btn btn-danger">Reseteaza tot</button>
  </center>
</div>

</fieldset>
</form>
  
</div>
 
 <br><br>

    </div> 
	
  </body>
  
    <script src="https://www.cdn.baxandrei.ro/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="https://www.cdn.baxandrei.ro/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="https://www.cdn.baxandrei.ro/toastr/toastr.min.js" type="text/javascript"></script>
	<script>$("#informatie").val("Important: La Adresa Site este important sa puneti adresa pe care se gaseste codul de parteneri.\n\nPentru a putea trimite cererea de parteneriat, este strict necesar ca, inainte de trimiterea formularului, pe site-ul Dvs. sa se regaseasca codul nostru de parteneriat, ori, in caz contrar, cererea se va respinge automat.\n\n De asemenea, <?php echo $nume_site; ?> isi rezerva dreptul de a sterge un anumit partener in cazul in care acesta a eliminat codul de parteneriat dupa aprobare.").height( $("#informatie")[0].scrollHeight );</script>
	<script>$("#codparteneriat").val('<?php echo $cod_parteneriat; ?>').height( $("#codparteneriat")[0].scrollHeight );</script>
	<script>toastr.options = {"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": true,"onclick": null,"showDuration": "300","hideDuration": "1000","timeOut": "5000","extendedTimeOut": "1000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"}</script>
  
</html>
