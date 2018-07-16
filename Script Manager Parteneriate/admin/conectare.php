<?php
require_once('../.functii.php');
if(verifica_daca_e_conectat()) { header('Location:'. $adresa_site_curent.'/admin/'); exit; }

if(isset($_POST['parola_site'])) {

if($_POST['parola_site'] == parola_admin) {
	setcookie("bx_parteneri_conectare", md5($_POST['parola_site']), time()+3600);
	$mesaj_conectare = "<b>Felicitari!</b><br>Autentificarea a fost efectuata!";
	$cod_conectare = "autentificat";
} else {
	$mesaj_conectare = "<b>Ne pare rau!</b><br>Autentificarea a esuat deoarece parola este incorecta!";
	$cod_conectare = "eroare";
}

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="BaxAndrei.Ro">

    <title><?php echo $nume_site; ?> - Parteneriate - Admin Panel - Conectare</title>
	
    <link rel="stylesheet" href="https://www.cdn.baxandrei.ro/bootstrap/css/paper.css">
	<link rel="stylesheet" href="https://www.cdn.baxandrei.ro/toastr/toastr.min.css">

  </head>

  <body>

    <div class="container">
 
 <br><br>
 
<div class="jumbotron">
  <h1 class="text-center">Autentificarea este necesara!</h1>
  
<?php if(!isset($cod_conectare)) { ?>
<form class="form-horizontal" method="post" action="<?php echo $adresa_site_curent; ?>/admin/conectare.php">
<fieldset>

<legend class="text-center"></legend>

<div class="form-group">
  <label class="col-md-4 control-label" for="Nume site">Nume utilizator</label>  
  <div class="col-md-6">
  <input type="text" disabled class="form-control input-md" value="Administrator">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="Nume site">Parola utilizator</label>  
  <div class="col-md-6">
  <input name="parola_site" type="password" placeholder="Parola pentru panoul de administrare" class="form-control input-md" required="" autocomplete="off">
    
  </div>
</div>

<div class="form-group">
  <center>
    <button type="submit" id="trimitere" name="trimitere" class="btn btn-success">Conectare</button>
    <button type="reset" id="resetare" name="resetare" class="btn btn-danger">Reseteaza tot</button>
  </center>
</div>

</fieldset>
</form>
<?php } elseif(isset($cod_conectare) && $cod_conectare === "eroare") { ?>
<legend class="text-center"></legend>
<div class="alert alert-danger"><strong><center>Upps!<br>Parola introdusa nu este corecta. Va rugam sa reincercati!</center></strong></div><br><a href="<?php echo "$adresa_site_curent"; ?>/admin/conectare.php" class="btn btn-primary">&#8810; Mergeti inapoi</a>
<?php } elseif(isset($cod_conectare) && $cod_conectare === "autentificat") { ?>
<div class="alert alert-success"><strong><center>Felicitari!<br>Parola introdusa este corecta. Acum puteti accesa panoul de administrare!</center></strong></div><br><center><a href="<?php echo "$adresa_site_curent"; ?>/admin/" class="btn btn-primary">Mergeti in panoul de administrare</a></center>
<?php } ?>

  
</div>
 
 <br><br>

    </div> 
	
  </body>
  
    <script src="https://www.cdn.baxandrei.ro/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="https://www.cdn.baxandrei.ro/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<?php if(isset($cod_conectare)) { ?>
	<script src="https://www.cdn.baxandrei.ro/toastr/toastr.min.js" type="text/javascript"></script>
	<script>toastr.options = {"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": true,"onclick": null,"showDuration": "300","hideDuration": "1000","timeOut": "5000","extendedTimeOut": "1000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"}</script>
<?php if($cod_conectare === "eroare") { ?>
	<script>toastr['warning']('<?php echo $mesaj_conectare; ?>');</script>
<?php } elseif($cod_conectare === "autentificat") { ?>
	<script>toastr['success']('<?php echo $mesaj_conectare; ?>');</script>
<?php } ?>
<?php } ?>
	
</html>