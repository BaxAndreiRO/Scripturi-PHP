<?php 
// Pentru a introduce scriptul pe o pagina foloseste 'require_once(/calea/catre/contorizare.php);'.
// Pentru a a fisa numarul de utilizatori care au accesat site-ul in decursul zilei de astazi folositi 'echo nr_vizitatori_azi;' pe orice pagina unde este scriptul inclus.

// Date mysql necesare scriptului.
define('host_mysql','localhost');
define('user_mysql','xxxxxxx');
define('parola_mysql','qDF63VyxvMLQNBds');
define('tabel_mysql','xxxxxxx');
$mysqli = mysqli_connect(host_mysql,user_mysql,parola_mysql,tabel_mysql);

// Functia care preia adresa IP a vizitatorului.
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

// Cateva variabile importante si vitale pentru script.
$timp_curent=time();
$verificare_timp=$timp_curent-86400; /// 86400 = 24 ore = 1 zi.

// Variabile care verifica daca utilizatorul cu adresa IP curenta este sau nu este in baza de date.
$verifica_daca_e_in_db = $mysqli->query("SELECT * FROM `bx.vizitatori` WHERE `ip`='$ip'");
$rezultate_verificari = mysqli_num_rows($verifica_daca_e_in_db);

// Daca utilizatorul cu adresa IP curenta nu este in baza de date il adauga.
if($rezultate_verificari == 0) {
$mysqli->query("INSERT INTO `bx.vizitatori` (`ip`, `timp`) VALUES ('$ip', '$timp_curent')");
// Daca utilizatorul cu adresa IP este deja in baza de date, se actualizaeaza ultima afisare.
} else {
$mysqli->query("UPDATE `bx.vizitatori` SET `timp`='$timp_curent' WHERE `ip`='$ip'");
}

// Aceasta functie sterge toti utilizatori care nu au mai intrat pe site de 24 de ore.
$mysqli->query("DELETE FROM `bx.vizitatori` WHERE `timp`<'$verificare_timp'");

// Functii pentru definirea numarului de utilizatori care au vizitat site-ul astazi.
// Puteti adauga pe pagina dorita 'echo nr_vizitatori_azi;' si o sa apara numarul de utilizatori care au vizitat astazi site-ul.
$verifica_cati_vizitatori_a_avut = $mysqli->query("SELECT * FROM `bx.vizitatori`");
$nr_total_vizitatori = mysqli_num_rows($verifica_cati_vizitatori_a_avut);
define('nr_vizitatori_azi',$nr_total_vizitatori);

// Aceste functii adauga un text complet invizibil in fisierul html cu date precum numarul de vizitatori din ziua curenta si adresa IP a vizitatorului.
if($nr_total_vizitatori == 1) {
echo "<!-- Astazi am avut un vizitator. IP-ul tau este $ip. -->";
} else {
echo "<!-- Astazi am avut ".nr_vizitatori_azi." vizitatori. IP-ul tau este $ip. -->";
}

// Aceasta functie inchide conexiunea cu baza de date.
mysqli_close($mysqli);
 ?>