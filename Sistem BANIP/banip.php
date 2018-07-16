<?php

$ip = $_SERVER['REMOTE_ADDR']; // Aceasta variabila obtine adresa IP a vizitatorului

$mysqli = mysqli_connect("db.baxandrei.ro","bax","128d91dcxd","banip"); // Aceasta functie efectueaza conexiunea la baza de date.

$verifica_status_ban_query = $mysqli->query("SELECT * FROM `banip` WHERE `ip` = '$ip'"); // Aceasta functie efectueaza selectarea datelor din baza de date.
$status_ban_ip = mysqli_num_rows($verifica_status_ban_query); // Aceasta functie calculeaza numarul de potriviri din baza de date. 

if($status_ban_ip >= 1) { // Daca calculul efectuat mai sus este mai mare sau egal cu 1, atunci se executa urmatoarele:

$motiv_ban_query = $mysqli->query("SELECT * FROM `banip` WHERE `ip` = '$ip'"); // Aceasta functie selecteaza datele din baza de date.
while($row = mysqli_fetch_array($motiv_ban_query)){ // Daca au fost gasite rezultate atunci executa urmatoarele:
$motiv_ban = $row['motiv']; // Variabila pentru a obtine motivul pentru care este banat vizitatorul.
$id_ban = $row['id']; // Variabila pentru a obtine numarul de intrare al banari in baza de date (ID-ul).
$ip_ban = $row['ip']; // Variabila pentru a obtine IP-ul banat din baza de date.
}

die('Ne pare rau, dar se pare ca adresa ta IP este banata pe acest site.'); // Aceasta functie sterge tot continutul site-ului si afiseaza doar acest mesaj.

}

mysqli_close($mysqli); // Aceasta functie inchide conexiunea cu baza de date.
?>