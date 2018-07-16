<?php
 
if(!isset($_FILES['fisier']) && !isset($_POST['trimite'])){
die("Imi pare rau, dar nu ai voie sa intri aici!");
return false;
}
 
date_default_timezone_set('Europe/Bucharest');
$erori= array();
$lista_cu_extensiile_pernmise= array("jpeg","jpg","png","gif","ico","bmp","txt","doc","psd","sql");
$marime_maxima_fisier = "2097152"; // marimea in B(ytes).
$folder_pentru_incarcari = "imagini"; // Doar numele, fara nici un /.
$adresa_site = "http://localhost/up/";
 
if (!file_exists($folder_pentru_incarcari)) {
mkdir($folder_pentru_incarcari, 0777, true);
}
 
$nume_fisier = $_FILES['fisier']['name'];
$marime_fisier =$_FILES['fisier']['size'];
$nume_fisier_temporar =$_FILES['fisier']['tmp_name'];
$tip_fisier=$_FILES['fisier']['type'];
$extensie_fisier=strtolower(end(explode('.',$_FILES['fisier']['name'])));
$nume_fisier_complet = date('dmYHis').'.'.$extensie_fisier;
if(in_array($extensie_fisier,$lista_cu_extensiile_pernmise)=== false){
$erori="Ne pare rau, dar fisierul pe care incercati sa il incarci nu are nici una din extensiile permise.";
} else {
if($marime_fisier > $marime_maxima_fisier){
$erori="Ne pare rau, dar fisierul pe care incercati sa il incarci are marimea mai mare decat cea permisa.";
} else {
if($marime_fisier < 1){
$erori="Ne pare rau, dar fisierul pe care incercati sa il incarci este prea mic.";
} else {
move_uploaded_file($nume_fisier_temporar,$folder_pentru_incarcari."/".$nume_fisier_complet);
echo "Felicitari! Fisierul tau a fost incarcat si il poti accesa la adresa urmatoare: $adresa_site$folder_pentru_incarcari/$nume_fisier_complet";
}
}
}
 
if($erori==true){
print_r($erori);
}
?>