<?php
require_once('../.functii.php');
if(!verifica_daca_e_conectat()) { header('Location:'. $adresa_site_curent.'/admin/conectare.php'); exit; }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="BaxAndrei.Ro">

    <title><?php echo $nume_site; ?> - Parteneriate - Admin Panel - Manager Parteneri</title>
	
    <link rel="stylesheet" href="https://www.cdn.baxandrei.ro/bootstrap/css/paper.css">
	<link rel="stylesheet" href="https://www.cdn.baxandrei.ro/toastr/toastr.min.css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  </head>

  <body>

    <div class="container">
 
 <br><br>
 
<div class="jumbotron">
<?php if(isset($_POST['sterge_site']) && file_exists('../.date.parteneri/'.$_POST['sterge_site'].'.txt')) { ?>

  <h1 class="text-center">Eliminare Partener <?php echo nume_partener_dupa_fisier($_POST['sterge_site']); ?></h1>
  <legend class="text-center"></legend>

  <p>Esti pe cale de a sterge <b><?php echo nume_partener_dupa_fisier($_POST['sterge_site']); ?></b> din lista ta de parteneri. Totusi, inainte de a efectua vre-o operatiune, trebuie sa tii cont de faptul ca, statusul codului de partener de pe <b><?php echo nume_partener_dupa_fisier($_POST['sterge_site']); ?></b> este urmatorul: <i><b><?php echo status_cod_partener_dupa_fisier($_POST['sterge_site']); ?></b></i> Poti de asemenea, inainte de decide daca doresti stergerea acestui site sau nu, sa vizitezi <a href="<?php echo adresa_partener_dupa_fisier($_POST['sterge_site']) ?>"><b><?php echo nume_partener_dupa_fisier($_POST['sterge_site']); ?></b></a> pentru a te asigura ca totul este in regula.

<form class="form-horizontal" method="post">
<fieldset>

<legend class="text-center"></legend>

<div class="alert alert-danger text-center">
  <strong>Atentie: Aceasta actiune este ireversibila, necesitand readaugarea manuala a partenerului de catre Dvs. ori detinatorul site-ului.</strong>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="Nume site">Motivul ce datoreaza stergerea afisat detinatorului <small><small><small>(optional)</small></small></small></label>  
  <div class="col-md-6">
  <input type="text" name="motiv_stergere" autocomplete="off" class="form-control input-md" placeholder="Motivul pentru care doresti eliminarea acestui site de la parteneri">
  <input type="hidden" name="site_ce_se_va_sterge" value="<?php echo $_POST['sterge_site']; ?>" readonly class="form-control input-md" placeholder="Motivul pentru care doresti eliminarea acestui site de la parteneri">
    
  </div>
</div>


<div class="form-group">
  <center>
    <button type="submit" name="sterge" value="1" class="btn btn-success">Sterge <b><?php echo nume_partener_dupa_fisier($_POST['sterge_site']); ?></b> din lista de parteneri</button>
    <a href="<?php echo $adresa_site_curent; ?>/admin/" name="resetare" class="btn btn-danger">Anuleaza</a>
  </center>
</div>

</fieldset>
</form>

  
<?php } elseif(isset($_POST['site_ce_se_va_sterge']) && file_exists('../.date.parteneri/'.$_POST['site_ce_se_va_sterge'].'.txt') && isset($_POST['sterge'])) { ?>
<?php if(!empty($_POST['motiv_stergere'])) { $motiv_stergere_specificat = true; } else { $motiv_stergere_specificat = false; }
if($motiv_stergere_specificat) { $mesaj_motiv_stergere = "<br><b>".nume_detinator_site_dupa_fisier($_POST['site_ce_se_va_sterge'])."</b> o sa primeasca o notificare pe mail cu privire la anularea parteneriatului alaturi de motivul specificat anterior <small>(".$_POST['motiv_stergere'].")</small>."; } else { $mesaj_motiv_stergere = "<br><b>".nume_detinator_site_dupa_fisier($_POST['site_ce_se_va_sterge'])."</b> o sa primeasca o notificare pe mail cu privire la anularea parteneriatului."; }
?>

  <h1 class="text-center">Eliminare Partener <?php echo nume_partener_dupa_fisier($_POST['site_ce_se_va_sterge']); ?></h1>
  <legend class="text-center"></legend>
  
<div class="alert alert-success text-center">
  <strong>Felicitari: <b><?php echo nume_partener_dupa_fisier($_POST['site_ce_se_va_sterge']); ?></b> a fost sters din lista Dvs. de parteneri! <?php echo $mesaj_motiv_stergere; ?></strong>
</div>

<center><a href="<?php echo "$adresa_site_curent"; ?>/admin/" class="btn btn-primary">Mergeti in panoul de administrare</a></center>

<?php

if($motiv_stergere_specificat) { $mesaj_motiv_stergere_mail = $_POST['motiv_stergere']; } else { $mesaj_motiv_stergere_mail = "din pacate motivul nu a fost specifiat."; }

$catre = ''.nume_detinator_site_dupa_fisier($_POST['site_ce_se_va_sterge']).' <'.email_detinator_site_dupa_fisier($_POST['site_ce_se_va_sterge']).'>'; 
$subiect_mesaj = "Parteneriate $nume_site - Site-ul Dvs. a fost sters!";
$continutul_mesajului = "Salutare ".nume_detinator_site_dupa_fisier($_POST['site_ce_se_va_sterge']).",<br><br>Din pacate, va notificam asupra faptului ca site-ul tau <small>(".nume_partener_dupa_fisier($_POST['site_ce_se_va_sterge']).")</small> a fost eliminat din lista noastra de parteneri.<br>Motiv eliminare: $mesaj_motiv_stergere_mail<br><br>Ne pare rau pentru cele intamplate.<br>Daca aveti probleme sau nelamuriri va rugam sa ne contactati pe site!<br><br>Cu stima,<br>Echipa $nume_site.<br><a href='$adresa_site_curent' target='_blank'>Acceseaza Site-ul pentru Parteneriate</a>";
$headers = "From: $nume_site Mail Service <mail@".str_replace('www.','',$_SERVER['HTTP_HOST']).">\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$headers .= "X-Priority: 1\r\n";
$headers .= "X-MSMail-Priority: High\r\n";
$headers .= "X-Mailer: $nume_site Mail Service\r\n";
$trimite_mesaj = mail($catre,$subiect_mesaj,$continutul_mesajului,$headers);

unlink('../.date.parteneri/'.$_POST['site_ce_se_va_sterge'].'.txt');

?>

<?php } else { ?>
  <h1 class="text-center">Lista Parteneri</h1>
  <legend class="text-center"></legend>

<?php echo obtine_lista_parteneri_acp(); ?>
<br>
</div>
<div class="jumbotron">
  <h1 class="text-center">Cod afisare parteneri pe site</h1>
  <legend class="text-center"></legend>
<textarea style="resize:none; width:100%;" id="txt_cod_parteneri" class="text-center" onclick="this.select(); document.execCommand('copy'); window.getSelection().removeAllRanges(); toastr['success']('Va rugam sa introduceti acest cod in locul unde doriti sa apara lista de parteneri.', 'Codul a fost copiat pe tastatura!');" readonly></textarea>
<?php } ?>
</div>

<center><span class="label label-default">Script Manager Parteneriate creat de BaxAndrei. Toate drepturile rezervate. Copyright &copy; <?php echo date('Y'); ?> <a href="https://baxandrei.ro" target="_blank">BaxAndrei.Ro</a></span></center>
 
 <br><br>

    </div> 
	
  </body>
  
    <script src="https://www.cdn.baxandrei.ro/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="https://www.cdn.baxandrei.ro/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="https://www.cdn.baxandrei.ro/toastr/toastr.min.js" type="text/javascript"></script>
	<script>$("[data-toggle=tooltip]").tooltip();</script>
	<script>$("#txt_cod_parteneri").html('&lt;div id=&quot;spatiu_parteneri&quot;&gt;&lt;b&gt;Se incarca ... Va rugam asteptati!&lt;/b&gt;&lt;/div&gt;\n&lt;script src=&quot;<?php echo $adresa_site_curent; ?>?parteneri&quot;&gt;&lt;/script&gt;').height( $("#txt_cod_parteneri")[0].scrollHeight );</script>
	<script>toastr.options = {"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": true,"onclick": null,"showDuration": "300","hideDuration": "1000","timeOut": "5000","extendedTimeOut": "1000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"}</script>
	
</html>