<?php
// includem setarile
require_once('.setari.php');

// definire ora pt Romania
date_default_timezone_set('Europe/Bucharest');

// generare cod parteneriat
$cod_parteneriat = '<a href="'.$adresa_site.'" target="_blank"><img src="'.$adresa_minibanner.'" alt="'.$nume_site.'" title="'.$descriere_site.'"></a>';

// definire variabile globale in fisier pentru utilizarea in functii.
$cod_despartitor = "<|bx-hr|>";
define('cod_despartitor',$cod_despartitor);
define('parola_admin',$parola_site);
define('adresa_site_pt_parteneriat',$adresa_site);
define('cod_parteneriat_verificari',$cod_parteneriat);
define('nume_site_cod_porpriu_functie',$nume_site);

// functie ce obtine lista partenerilor pentru utilizarea in scriptul de parteneriat.
function obtinere_parteneri() {
    $ignorate = array('.', '..', '.htaccess');
    $fisiere = array();    
    foreach (scandir('.date.parteneri') as $fisier) {
        if (in_array($fisier, $ignorate)) continue;
        $fisiere[$fisier] = filemtime('.date.parteneri' . '/' . $fisier);
    }
    asort($fisiere);
    $fisiere = array_keys($fisiere);
	$parteneri = "";
    foreach ($fisiere as $partener) {
		$date_partener = file_get_contents('.date.parteneri/'.$partener);
		$date_prelucrate = explode(cod_despartitor, $date_partener);
		$cod_partener = "<a href='{$date_prelucrate['4']}' target='_blank'><img title='{$date_prelucrate['3']}' src='{$date_prelucrate['5']}' alt='{$date_prelucrate['2']}' width='88px' height='33px'></a>&nbsp;";
		$parteneri .= $cod_partener;
    }
return ('document.getElementById("spatiu_parteneri").innerHTML = "'.str_replace('"',"'",cod_parteneriat_verificari).'&nbsp;'.$parteneri.'";');
}

// functie ce afiseaza codul de parteneriat la cerere in format javascript (.js)
if(isset($_GET['parteneri'])) { header('Content-Type: application/javascript'); die(obtinere_parteneri()); }

// functia care verifica daca utilizatorul este conectat.
function verifica_daca_e_conectat() {
if(isset($_COOKIE['bx_parteneri_conectare'])) {
	if($_COOKIE['bx_parteneri_conectare'] == md5(parola_admin)) {
		return true;
	} else {
		return false;
	}
} else {
	return false;
}
}

// functia ce ne genereaza lista de parteneri pentru panoul de administrare
function obtine_lista_parteneri_acp() {
	chdir('..');
    $ignorate = array('.', '..', '.htaccess');
    $fisiere = array();    
    foreach (scandir('.date.parteneri') as $fisier) {
        if (in_array($fisier, $ignorate)) continue;
        $fisiere[$fisier] = filemtime('.date.parteneri' . '/' . $fisier);
    }
    asort($fisiere);
    $fisiere = array_keys($fisiere);
	$id_partener = 0;
	$parteneri = "";
    foreach ($fisiere as $partener) {
		$id_partener++;
		$date_partener = file_get_contents('.date.parteneri/'.$partener);
		$date_prelucrate = explode(cod_despartitor, $date_partener);
		$partener_nume_stergere = str_replace('.txt','',$partener);
		$obtine_continut_complet_site = file_get_contents($date_prelucrate['4']);
		$dezasamblare_url_site_pt_verificari = parse_url(adresa_site_pt_parteneriat);
		if(strpos($obtine_continut_complet_site, cod_parteneriat_verificari) == false) { $status_cod_parteneriat_pe_site = false; } else { $status_cod_parteneriat_pe_site = true; }
		if(strpos($obtine_continut_complet_site, $dezasamblare_url_site_pt_verificari['host']) == false) { $status_cod_parteneriat_pe_site_adresa = false; } else { $status_cod_parteneriat_pe_site_adresa = true; }
		if($status_cod_parteneriat_pe_site) {
		$status_cod_parteneriat = "<a class='label label-success' data-toggle='tooltip' data-original-title='Codul este in stare perfecta si nu prezinta modificari.'>Codul a fost gasit pe acest site!</a>";	
		} elseif($status_cod_parteneriat_pe_site_adresa) {
		$status_cod_parteneriat = "<a class='label label-warning' data-toggle='tooltip' data-original-title='Se are ca, codul prezinta modificari de la cel original, dar totusi indica catre site-ul Dvs.'>Codul este impartial pe acest site! Va rugam sa verificati.</a>";
		} else {
		$status_cod_parteneriat = "<a class='label label-danger' data-toggle='tooltip' data-original-title='Se pare ca, codul nu a fost gasit nicaieri pe site-ul partener.'>Codul nu a fost gasit pe acest site! Va rugam verificati.</a>";
		}
		$cod_partener = "&nbsp;<a data-toggle=\"tooltip\" data-original-title=\"Previzualizare cod site partener.\" href='{$date_prelucrate['4']}' target='_blank'><img title='{$date_prelucrate['3']}' src='{$date_prelucrate['5']}' alt='' width='88px' height='33px'></a>&nbsp;";
		$parteneri .= '<tr><th valign="middle" class="text-center"><a data-toggle="tooltip" data-original-title="Numar de ordine partener.">'.$id_partener.'</a></th><th valign="middle" class="text-center"><a data-toggle="tooltip" data-original-title="Nume site partener.">'.$date_prelucrate['2'].'</a></th><th valign="middle" class="text-center">'.$cod_partener.'</th><th valign="middle" class="text-center"><a data-toggle="tooltip" data-original-title="Contacteaza detinatorul acestui site partener." href="mailto:'.$date_prelucrate['1'].'" traget="_blank">'.$date_prelucrate['0'].'</a></th><th valign="middle" class="text-center">'.$status_cod_parteneriat.'</th><th valign="middle" class="text-center"><form method="post"><a data-toggle="tooltip" data-original-title="Acceseaza site-ul partener." href="'.$date_prelucrate['4'].'" target="_blank"><i class="fa fa-external-link-square" aria-hidden="true"></i></a> &nbsp; <button style="background:transparent; border:0;" name="sterge_site" value="'.$partener_nume_stergere.'"><a data-toggle="tooltip" data-original-title="Sterge acest site partener."><i class="fa fa-trash" aria-hidden="true"></i></a></button></form></th></tr>';
    }
$site_propriu_cod = '<tr><th valign="middle" class="text-center"><a data-toggle="tooltip" data-original-title="Numar de ordine partener.">0</a></th><th valign="middle" class="text-center"><a data-toggle="tooltip" data-original-title="Nume site partener.">'.nume_site_cod_porpriu_functie.'</a></th><th valign="middle" class="text-center">'.cod_parteneriat_verificari.'</th><th valign="middle" class="text-center"><a data-toggle="tooltip" data-original-title="Contacteaza detinatorul acestui site partener." href="mailto:webmaster@'.str_replace('www.','',$_SERVER['HTTP_HOST']).'" traget="_blank">'.nume_site_cod_porpriu_functie.'</a></th><th valign="middle" class="text-center"><a class="label label-success" data-toggle="tooltip" data-original-title="Codul este in stare perfecta si nu prezinta modificari.">Codul a fost gasit pe acest site!</a></th><th valign="middle" class="text-center"><i class="fa fa-window-close" aria-hidden="true"></i></th></tr>';
return ('<table class="tg"><table class="table table-bordered table-striped table-hover table-condensed table-responsive"><thead><tr><th valign="middle" class="text-center">#</th><th valign="middle" class="text-center">Nume Partener</th><th valign="middle" class="text-center">Cod Partener</th><th valign="middle" class="text-center">Nume Detinator</th><th valign="middle" class="text-center">Status Cod Parteneriat</th><th valign="middle" class="text-center">Unelte</th></tr></thead><tbody>'.$site_propriu_cod.''.$parteneri.'</tbody></table>');
}

// functia ce ne obtine numele partenerului din fisier dupa numele fisierului
function nume_partener_dupa_fisier($nume_fisier) {
		$date_partener = file_get_contents('../.date.parteneri/'.$nume_fisier.'.txt');
		$date_prelucrate = explode(cod_despartitor, $date_partener);
		$nume_partener = $date_prelucrate['2'];
return ($nume_partener);
	
}

// functia ce ne obtine adresa partenerului din fisier dupa numele fisierului
function adresa_partener_dupa_fisier($nume_fisier) {
		$date_partener = file_get_contents('../.date.parteneri/'.$nume_fisier.'.txt');
		$date_prelucrate = explode(cod_despartitor, $date_partener);
		$adresa_partener = $date_prelucrate['4'];
return ($adresa_partener);
}

// functia ce ne obtine statusul codului de parteneriat dupa numele fisierului pentr partenerul specificat
function status_cod_partener_dupa_fisier($nume_fisier) {
		$date_partener = file_get_contents('../.date.parteneri/'.$nume_fisier.'.txt');
		$date_prelucrate = explode(cod_despartitor, $date_partener);
		$obtine_continut_complet_site = file_get_contents($date_prelucrate['4']);
		$dezasamblare_url_site_pt_verificari = parse_url(adresa_site_pt_parteneriat);
		if(strpos($obtine_continut_complet_site, cod_parteneriat_verificari) == false) { $status_cod_parteneriat_pe_site = false; } else { $status_cod_parteneriat_pe_site = true; }
		if(strpos($obtine_continut_complet_site, $dezasamblare_url_site_pt_verificari['host']) == false) { $status_cod_parteneriat_pe_site_adresa = false; } else { $status_cod_parteneriat_pe_site_adresa = true; }
		if($status_cod_parteneriat_pe_site) {
		$status_cod_parteneriat = "<span class='text-success'>Codul exista pe acest site si este in stare perfecta.</span>";	
		} elseif($status_cod_parteneriat_pe_site_adresa) {
		$status_cod_parteneriat = "<span class='text-warning'>Codul exista pe acest site, dar a suferit modificari fata de cel original, insa indica in continuare catre adresa site-ului Dvs.</span>";
		} else {
		$status_cod_parteneriat = "<span class='text-danger'>Codul nu exista pe acest site.</span>";
		}	
return $status_cod_parteneriat;
}

// functia ce ne obtine numele detinatorului site-ului specificat din fisier dupa numele fisierului
function nume_detinator_site_dupa_fisier($nume_fisier) {
		$date_partener = file_get_contents('../.date.parteneri/'.$nume_fisier.'.txt');
		$date_prelucrate = explode(cod_despartitor, $date_partener);
		$nume_detinator_site = $date_prelucrate['0'];
return ($nume_detinator_site);
	
}

// functia ce ne obtine adresa de contact a detinatorului site-ului dupa numele fisierului.
function email_detinator_site_dupa_fisier($nume_fisier) {
		$date_partener = file_get_contents('../.date.parteneri/'.$nume_fisier.'.txt');
		$date_prelucrate = explode(cod_despartitor, $date_partener);
		$email_detinator_site = $date_prelucrate['1'];
return ($email_detinator_site);
	
}