<?php

require_once('.functii.php');

if(!isset($_POST['nume_detinator'])) { exit; }
if(!isset($_POST['mail_detinator'])) { exit; }
if(!isset($_POST['nume_site'])) { exit; }
if(!isset($_POST['descriere_site'])) { exit; }
if(!isset($_POST['adresa_site'])) { exit; }
if(!isset($_POST['adresa_minibanner'])) { exit; }

if(!isset($_POST['trimitere'])) { exit; }

$adresa_site_pt_fisier = preg_replace('/[^a-zA-Z0-9]/', '', $_POST['adresa_site']);

$sablon_1 = '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="author" content="BaxAndrei.Ro"><title>'.$nume_site.' - Parteneriate</title><link rel="stylesheet" href="https://www.cdn.baxandrei.ro/bootstrap/css/paper.css"></head><body><div class="container"><br><br><div class="jumbotron">';

$sablon_2 = '</div><br><br></div> </body></html>';

$dezasamblare_url_site_pt_verificari = parse_url($adresa_site);
if (strpos(file_get_contents($_POST['adresa_site']), $dezasamblare_url_site_pt_verificari['host']) == false) { die($sablon_1.'<div class="alert alert-danger"><strong><center>Upps!<br>Se pare ca nu a fost gasit codul nostru de parteneriat pe site-ul Dvs. Va rugam sa verificati, iar apoi sa reincercati sa trimiteti iar cererea.</center></strong></div><br><a onclick="window.history.go(-1);" class="btn btn-primary">&#8810; Mergeti inapoi</a>'.$sablon_2);  exit; }

if(file_exists('.date.parteneri/'.$adresa_site_pt_fisier.'.txt')) { die($sablon_1.'<div class="alert alert-danger"><strong><center>Upps!<br>Se pare ca acest site deja este partener cu noi.<br>Daca totusi, ai completat cererea de parteneriat, iar site-ul tau nu apare in lista partenerilor este posibil ca acesta sa fie in asteptare, nefiind necesara retrimiterea cereri de parteneriat, iar imediat ce se accepta ori este respins se va trimite o notificare catre Dvs.</center></strong></div><br><a onclick="window.history.go(-1);" class="btn btn-primary">&#8810; Mergeti inapoi</a>'.$sablon_2); exit; }

is_writable('index.php') or exit($sablon_1.'<div class="alert alert-danger"><strong><center>Upps!<br>Se pare ca a aprut o problema neprevazuta! Va rugam sa incercati din nou mai tarziu si va multumim pentru intelegere.</center></strong></div><br><a onclick="window.history.go(-1);" class="btn btn-primary">&#8810; Mergeti inapoi</a>'.$sablon_2);

echo($sablon_1.'<div class="alert alert-success"><strong><center>Felicitari '.$_POST['nume_detinator'].', cererea ta a fost primita!<br>Acum mai trebuie decat sa fie acceptata de un administrator, urmand ca Dvs. sa primiti o notificare pe adresa de mail specificata.</center></strong></div><br><center><a href="'.$adresa_site.'" class="btn btn-success">Acceseaza site-ul '.$nume_site.'</a></center>'.$sablon_2);

touch('.date.parteneri/'.$adresa_site_pt_fisier.'.txt');
$fisier_parteneriat = fopen('.date.parteneri/'.$adresa_site_pt_fisier.'.txt', "w");
$text_date = "".$_POST['nume_detinator']."".$cod_despartitor."".$_POST['mail_detinator']."".$cod_despartitor."".$_POST['nume_site']."".$cod_despartitor."".str_replace('"', "'", $_POST['descriere_site'])."".$cod_despartitor."".$_POST['adresa_site']."".$cod_despartitor."".$_POST['adresa_minibanner']."";
fwrite($fisier_parteneriat, $text_date);
fclose($fisier_parteneriat);
?>