<?php
$ip_banat_succes = "";
if(isset($_POST['trimite_ban']) && isset($_POST['ip_ban']) && isset($_POST['motiv_ban'])) {
$ban_ip_nf = $_POST['ip_ban'];
$ban_motiv = $_POST['motiv_ban'];
$ban_ip = preg_replace("/[^0-9,.]/","",$ban_ip_nf);
if(filter_var($ban_ip, FILTER_VALIDATE_IP)) {
if(!este_banip($ban_ip)) {
$baneaza_ip = $mysqli->query("INSERT INTO `".nume_tabel_mysql."` (`ip`, `motiv`) VALUES ('$ban_ip', '$ban_motiv');");
if($baneaza_ip) {$ip_banat_succes = "da";} else {$ip_banat_succes = "nu";}
} else { $ip_banat_succes = "existent"; }
} else { $ip_banat_succes = "invalid"; }
}

$ip_debanat_succes = "";
if(isset($_POST['unban']) && !empty($_POST['unban']) && isset($_POST['unban_ip']) && !empty($_POST['unban_ip'])) {
if(filter_var($_POST['unban_ip'], FILTER_VALIDATE_IP)) {
if(este_banip($_POST['unban_ip'])) {
$debaneaza_ip = $mysqli->query("DELETE FROM `".nume_tabel_mysql."` WHERE `id` = '".$_POST['unban']."' AND `ip` = '".$_POST['unban_ip']."'");
if($debaneaza_ip) {$ip_debanat_succes = "da";} else {$ip_debanat_succes = "nu";}
} else { $ip_debanat_succes = "inexistent"; }
} else { $ip_debanat_succes = "invalid"; }
}	
?>

<?php 
if($ip_banat_succes == "da") { ?>
<div class="alert alert-dismissible alert-success alerta-bax">
<script>$('.alerta-bax').delay(5000).fadeOut('slow');</script>
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Adresa IP a fost banata!</strong>
</div>
<?php } elseif($ip_banat_succes == "nu") { ?>
<div class="alert alert-dismissible alert-danger alerta-bax">
<script>$('.alerta-bax').delay(5000).fadeOut('slow');</script>
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Se pare ca a intervenit o eroare, te rog sa reincerci.</strong>
</div>
<?php } elseif($ip_banat_succes == "existent") { ?>
<div class="alert alert-dismissible alert-danger alerta-bax">
<script>$('.alerta-bax').delay(5000).fadeOut('slow');</script>
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Adresa IP pe care vrei sa o banezi este deja banata.</strong>
</div>
<?php } elseif($ip_banat_succes == "invalid") { ?>
<div class="alert alert-dismissible alert-danger alerta-bax">
<script>$('.alerta-bax').delay(5000).fadeOut('slow');</script>
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Adresa IP pe care vrei sa o banezi este invalida.</strong>
</div>
<?php } ?>
<?php 
if($ip_debanat_succes == "da") { ?>
<div class="alert alert-dismissible alert-success alerta-bax">
<script>$('.alerta-bax').delay(5000).fadeOut('slow');</script>
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Adresa IP a fost debanata.</strong>
</div>
<?php } elseif($ip_debanat_succes == "nu") { ?>
<div class="alert alert-dismissible alert-danger alerta-bax">
<script>$('.alerta-bax').delay(5000).fadeOut('slow');</script>
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Se pare ca a intervenit o eroare, te rugam sa reincerci.</strong>
</div>
<?php } elseif($ip_debanat_succes == "inexistent") { ?>
<div class="alert alert-dismissible alert-danger alerta-bax">
<script>$('.alerta-bax').delay(5000).fadeOut('slow');</script>
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Adresa IP pe care vrei sa o debanezi nu este banata.</strong>
</div>
<?php } elseif($ip_debanat_succes == "invalid") { ?>
<div class="alert alert-dismissible alert-danger alerta-bax">
<script>$('.alerta-bax').delay(5000).fadeOut('slow');</script>
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Adresa IP pe care vrei sa o debanezi este invalida.</strong>
</div>
<?php } ?>

<div class="panel panel-default">
  <div class="panel-heading"><?php echo titlu_pagina($pagina); ?> - Adauga o adresa IP la lista celor interziste.</div>
  <div class="panel-body">
<form class="form-horizontal" method="post">
  <fieldset> 
<table class="table" style="margin:0">
<tr>
<td style="border:0">
<input type="text" class="form-control" name='ip_ban' autocomplete=off required placeholder="Adresa IP pe care doriti sa o banati." name="ip_ban">    
</div></td><td style="border:0">
<input type="text" class="form-control" name='motiv_ban' autocomplete=off required placeholder="Motivul pentru care doriti sa banati acest IP." name="motiv_ban">    
</td><td style="border:0; width:154px;">
<button type="submit" value="<?php echo baneaza_ip_banip_trimite_lang; ?>" name="trimite_ban" class="btn btn-danger">Baneaza adresa IP</button>
</td>
</tr>
</table>
  </fieldset>
</form>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading"><?php echo titlu_pagina($pagina); ?> - Lista cu adrese IP interziste.</div>
  <div class="panel-body">
	<?php echo banuri_si_unelte(); ?>
  </div>
</div>