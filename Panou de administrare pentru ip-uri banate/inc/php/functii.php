<?php

require_once('setari.php');

///////////////////////////////////////////////////
///////////////// Inceput Functii /////////////////
///////////////////////////////////////////////////

function este_banip($ip) {
$mysqli = mysqli_connect(host_mysql,utilizator_mysql,parola_utilizator_mysql,nume_baza_de_date_mysql);
$function_query = $mysqli->query("SELECT * FROM `".nume_tabel_mysql."` WHERE `ip` = '$ip'");
$function_query_rezultat = mysqli_num_rows($function_query);
if($function_query_rezultat >= 1) {
return true;
} else { return false; }
mysqli_close($mysqli);
}

function verifica_date_conectare($utilizator,$parola) {
if($utilizator === webmaster_nume) {
if($parola != md5(webmaster_parola)) { return false; } else {
return true;
}
} else { 
if(file_exists(cale_conturi_utilizatori."$utilizator")) { 
if($parola === md5(file_get_contents(cale_conturi_utilizatori."$utilizator"))) {
return true;
} else { return false; }
} else { return false; }
}
}


if(isset($_COOKIE['utilizator'])) { $verificare_utilizator = $_COOKIE['utilizator']; } else { $verificare_utilizator = "null"; }
if(isset($_COOKIE['parola'])) { $verificare_parola = $_COOKIE['parola']; } else { $verificare_parola = "null"; }
if(verifica_date_conectare($verificare_utilizator,$verificare_parola)){
if(isset($_GET['pagina'])) { $pagina = $_GET['pagina']; } else { $pagina = "acasa"; }
if(file_exists(cale_director_template."$pagina.php")) { $pagina = $pagina; } else { $pagina = "acasa"; }
} else { $pagina = "conectare"; }
if(verifica_date_conectare($verificare_utilizator,$verificare_parola) && $pagina = "conectare"){ $pagina = "acasa"; }

function titlu_pagina($pagina) {
if($pagina === "acasa") { $pagina_curenta = "Pagina Principala - Bun venit!"; }
if($pagina === "conectare") { $pagina_curenta = "Autentificare"; }
if($pagina === "deconectare") { $pagina_curenta = "Deconectare"; }
$returneaza = $pagina_curenta." - ".nume_site;
return $returneaza;
}

function adresa_curenta() {
	return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}

function banuri_si_unelte() {
$mysqli = mysqli_connect(host_mysql,utilizator_mysql,parola_utilizator_mysql,nume_baza_de_date_mysql);
$obtine_banip = $mysqli->query("SELECT * FROM `".nume_tabel_mysql."`"); 
$arata_lista = '';
while($row = mysqli_fetch_array($obtine_banip)){ 
$id_ban = $row["id"];
$ip_ban = $row["ip"];
$motiv_ban = $row["motiv"];
$debaneaza_buton = "<form class='form-horizontal' method='post'><button type='submit' value='$id_ban' class='btn btn-primary btn-xs' name='unban'>Debaneaza</button><input name='unban_ip' style='display:none' value='$ip_ban' /></form>";
$arata_lista .= "<tr><td><center>$id_ban</center></td><td><center>$ip_ban</center></td><td><center>$motiv_ban</center></td><td><center>$debaneaza_buton</center></td></tr>";
}
if(!empty($arata_lista)) { echo " <table class='table table-hover' style='margin-bottom:0px!important'><tr><th style='text-align:center;'># ID</th><th style='text-align:center;'>IP</th><th style='text-align:center;'>Motiv</th><th style='text-align:center;'>Unban</th></tr>"; echo $arata_lista; echo "</table>"; } else { echo '<div class="alert alert-dismissible alert-info"><b>Nu exista nici o adresa IP banata momentan.</b></div>'; }
mysqli_close($mysqli);
}

if(!empty($_POST['deconectare'])) {
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }
}
}