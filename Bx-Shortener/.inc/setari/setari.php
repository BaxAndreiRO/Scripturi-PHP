<?php
// Date SITE
define('NUME_SITE','Nume Site - URL Shortener');
define('FAVICON','');
define('LUNGIME_URL','5');
define('ADRESA_SITE','http://work.baxandrei.ro/');
define('PAROLA_ACP','baxandrei.ro');
define('NAVIGARE','1');

// Date MYSQL
define('HOST_MYSQL','localhost');
define('USER_MYSQL','work');
define('PAROLA_MYSQL','');
define('TABEL_MYSQL','work');
$mysqli = mysqli_connect(HOST_MYSQL,USER_MYSQL,PAROLA_MYSQL,TABEL_MYSQL) or die('Probleme la comunicarea cu baza de date. Va rugam sa verificati setarile!');

// Functii site.
date_default_timezone_set('Europe/Bucharest');

$ADRESA_CURENTA = ADRESA_SITE;

$nr_total_vizualizari = "1+";
$preia_vizualizari_adrese = $mysqli->query("SELECT * FROM `adrese`");
while($row = mysqli_fetch_array($preia_vizualizari_adrese)){ 
$vizualizari = $row["vizualizari"];
$nr_total_vizualizari .= "$vizualizari+";
}
$nr_total_vizualizari = "$nr_total_vizualizari"."0-1";
$NR_TOTAL_VIZUALIZARI = eval('return '.$nr_total_vizualizari.';');

$preia_adresele_scurtate = $mysqli->query("SELECT * FROM `adrese`");
$NR_TOTAL_ADRESE = mysqli_num_rows($preia_adresele_scurtate);

function NUME_URL($lungime) {
    $caractere = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $caractere_disponibile = strlen($caractere);
    $NUME_URL = '';
    for ($i = 0; $i < $lungime; $i++) {
        $NUME_URL .= $caractere[rand(0, $caractere_disponibile - 1)];
    }
    return $NUME_URL;
}

function EXISTA_IN_DB($nume) {
$mysqli = mysqli_connect(HOST_MYSQL,USER_MYSQL,PAROLA_MYSQL,TABEL_MYSQL);
$function_query = $mysqli->query("SELECT * FROM `adrese` WHERE `nume` = '$nume'");
$function_query_rezultat = mysqli_num_rows($function_query);
if($function_query_rezultat == 1) { return true; } else { return false; }
}

if(isset($_GET['url'])) {
if(!empty($_GET['url'])) {
if($_GET['url'] == 'admin') {
define('ACP','1');
} else if(EXISTA_IN_DB($_GET['url'])) {
$preia_nr_vizualizar_si_url = $mysqli->query("SELECT * FROM `adrese` WHERE `nume` = '{$_GET['url']}'");
while($row = mysqli_fetch_array($preia_nr_vizualizar_si_url)){ 
$__URL__ = $row["url"];
$__VIZUALIZRI__ = $row["vizualizari"];
}
$__VIZUALIZRI__ = ($__VIZUALIZRI__ + 1);
$mysqli->query("UPDATE `adrese` SET `vizualizari` = '$__VIZUALIZRI__' WHERE `nume` = '{$_GET['url']}'");
header("Location: $__URL__");
} else {
header("Location: $ADRESA_CURENTA");
}
}
}

function ADRESE() {
$mysqli = mysqli_connect(HOST_MYSQL,USER_MYSQL,PAROLA_MYSQL,TABEL_MYSQL);
$ADRESE_query = $mysqli->query("SELECT * FROM `adrese` ORDER BY id DESC");
$ADRESE = '';
while($row = mysqli_fetch_array($ADRESE_query)){
$ADRESE_id = $row["id"];
$ADRESE_vizualizari = $row["vizualizari"];
$ADRESE_url = $row["url"];
$ADRESE_nume = $row["nume"];
$ADRESE .= '		<tr>
			<td>
				'.$ADRESE_id.'
			</td>
			<td>
				'.$ADRESE_nume.'
			</td>
			<td>
				'.$ADRESE_vizualizari.'
			</td>
			<td>
				<i class="fa fa-external-link-square text-danger" aria-hidden="true"></i> <a href="'.$ADRESE_url.'" class="text-danger" data-toggle="tooltip" title="Va rugam sa aveti mare grija la adresele pe care intentionati sa le vizualizati!" target="_blank">'.$ADRESE_url.'</a>
			</td>
			<td>
				<form method="post"><input type="hidden" name="stergere_id" value="'.$ADRESE_id.'"><button name="stergere" class="btn btn-warning btn-xs" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i> Stergere</button></form>
			</td>
		</tr>';
}
if(empty($ADRESE)) { $ADRESE = '<div class="alert alert-dismissible alert-warning">
  <strong>Momentan nu exista nici o adresa URL in baza de date!</strong>
</div>
<style>table{display:none;}</style>'; }
return $ADRESE;
}

function STERGE($id) {
$mysqli = mysqli_connect(HOST_MYSQL,USER_MYSQL,PAROLA_MYSQL,TABEL_MYSQL);
$STERGE_query = $mysqli->query("DELETE FROM `adrese` WHERE `id` = $id");
if($STERGE_query) { return 1; } else { return 0; }
}

function EXISTA_IN_DB_ID($id) {
$mysqli = mysqli_connect(HOST_MYSQL,USER_MYSQL,PAROLA_MYSQL,TABEL_MYSQL);
$function_query = $mysqli->query("SELECT * FROM `adrese` WHERE `id` = '$id'");
$function_query_rezultat = mysqli_num_rows($function_query);
if($function_query_rezultat == 1) { return true; } else { return false; }
}

if(!defined('ACP')) { define('ACP','0'); }