<?php if(!isset($_POST['parola'])) {
$_POST['parola'] = 1;
$eroare_login = 0;
} elseif (isset($_POST['parola']) && $_POST['parola'] != PAROLA_ACP) {
$eroare_login = 1;
}

if(!isset($_COOKIE['parola_acp'])) { $_COOKIE['parola_acp'] = ""; }
if($_POST['parola'] == PAROLA_ACP || $_COOKIE['parola_acp'] == md5(PAROLA_ACP)) {
setcookie("parola_acp", md5(PAROLA_ACP), time()+3600);
if(isset($_POST['parola'])) { if($_POST['parola'] == PAROLA_ACP) { $bun_venit = 1; } else { $bun_venit = 0; } } else { $bun_venit = 0; }
require_once($CALEA_DIRECTOR_INDEX."/.inc/acp/acp.php");
} else {
require_once($CALEA_DIRECTOR_INDEX."/.inc/acp/conectare.php");
} ?>