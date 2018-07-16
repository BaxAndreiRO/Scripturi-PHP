<?php
require_once('!google.php');

if($google_r == 2) { die('<div class="alert alert-danger"><strong><i class="fa fa-times" aria-hidden="true"></i> Imi pare rau, dar ai fost detectat ca robot spam!</div>'); }
if($google_r == 1) { die('<div class="alert alert-danger"><strong><i class="fa fa-times" aria-hidden="true"></i> Imi pare rau, dar trebuie sa bifezi ca nu esti robot spam!</div>'); }

if($google_r == 0) {
	
require_once('!porturi.php');

if($status_port == 1) { echo '<div class="alert alert-success"><strong><i class="fa fa-check" aria-hidden="true"></i> Portul '.$_POST['port'].' pe adresa IP '.$_POST['ip'].' este deschis!</div><a href="'.$adresa_site.'" style="margin-top:3px; margin-bottom:3px;" class="btn btn-primary">Verifica alt port</a>'; } else { echo '<div class="alert alert-danger"><strong><i class="fa fa-times" aria-hidden="true"></i> Portul '.$_POST['port'].' pe adresa IP '.$_POST['ip'].' este inchis!</div><a href="'.$adresa_site.'" style="margin-top:3px; margin-bottom:3px;" class="btn btn-primary">Verifica alt port</a>'; }

}