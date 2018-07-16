<?php

define('adresa_site','http://bx.baxandrei.ro'); // Aceasta functie defineste adresa site-ului.
define('timp_maxim_sesiunea_ore','1'); // Aceasta functie ii spune site-ului cate ore sa fie valabila sesiunea. (sesiunea de autentificare, adica cat timp sa fie conectat dupa care este deconectat automat.)

define('mysqli_host','localhost'); // Functia care defineste hostul pentru serverul mysql.
define('mysqli_db','conectare'); // Functia care defineste numele bazei de date mysql.
define('mysqli_user','conectare'); // Functia care defineste utilizatorul pentru serverul mysql.
define('mysqli_pass','9XqL4Y53mtWuSPbH'); // Functia care defineste parola pentru utilizatorul mysql.
$mysqli = mysqli_connect(mysqli_host,mysqli_user,mysqli_pass,mysqli_db); // Functia care efectueaza conectarea la baza de date.

if(!$mysqli) { die("Nu se poate efectua conexiunea MySql. Va rugam sa reincercati, iar daca problema persista va rugam sa anuntati adminul."); } // Aceasta functie afiseaza un mesaj de eroare in caz ca nu se poate conecta la baza de date.

////////// Functia care verifica daca utilizatorul este conectat.
function este_conectat() { // Incepem functia care ne spune daca utilizatorul este conectat sau nu.
if(isset($_COOKIE['este_conectat']) && !empty($_COOKIE['conectat_ca'])) { return true; } else { return false; } // Aceasta functie verifica daca utilizatorul este conectat si ne returneaza raspunsul.
}

////////// Functia care ii spune site-ului ca pagina pe care incearca utilizatorul sa o acceseze necesita ca acesta sa fie conectat.
function conectare_obligatorie() { // Aceasta functie obliga utilizatorul sa se conecteze pentru a accesa pagina dorita.

if(isset($_COOKIE['este_conectat']) && !empty($_COOKIE['conectat_ca'])) { $raspuns_conectare_obligatorie = true; } else { $raspuns_conectare_obligatorie = false; } // Aceasta functie verifica daca utilizatorul este conectat si ne returneaza raspunsul.

if(!$raspuns_conectare_obligatorie) { header("Location: ".adresa_site."/conectare.php"); } // Aceasta functie redirectioneaza utilizatorul pe pagina de conectare in caz ca nu este conectat, dupa care il trimite inapoi pe pagina dorita.
setcookie('login_redirect', $_SERVER['REQUEST_URI'], time() + (10), "/"); // Aceasta functie seteaza adresa curenta, adica unde sa redirectioneze utilizatorul dupa conectare.

}

////////// Functia care efectueaza conectarea utilizatorului.
function conectare($nume_utilizator, $parola_utilizator, $redirect_login_catre, $formular_conectare) { // Aceasta functie preia datele din formularul de conectare (daca este existent) si efectueaza conectarea.
	
$mysqli = mysqli_connect(mysqli_host,mysqli_user,mysqli_pass,mysqli_db); // Functia care efectueaza conectarea la baza de date.
	
if(!isset($nume_utilizator) || empty($nume_utilizator)) { $nume_utilizator = "null"; } // Aceasta functie ii spune site-ului ce sa faca in caz ca nu este specificat nici un nume de utilizator.
if(!isset($parola_utilizator) || empty($parola_utilizator)) { $parola_utilizator = "null"; } // Aceasta functie ii spune site-ului ce sa faca in caz ca nu este specificat nici o parola.
if(isset($formular_conectare) && !empty($formular_conectare)) { $formular_conectare = true; } // Aceasta functie spune site-ului daca a fost trimis formularul de conectare sau nu.
	
if($formular_conectare) { // Aceasta functie spune site-ului sa efectueze operatiunea de conectare daca a fost trimis formularul de conectare.

$conectare_query = $mysqli->query("SELECT * FROM `utilizatori_site` WHERE `nume` = '$nume_utilizator' and `parola` = '$parola_utilizator'"); // Aceasta functie efectueaza selectarea datelor din baza de date.
$conectare_valida = mysqli_num_rows($conectare_query); // Aceasta functie calculeaza numarul de potriviri din baza de date. 

if($conectare_valida == 1) { // Daca calculul efectuat mai sus este mai mare sau egal cu 1, atunci se executa urmatoarele:
	
$preia_numele_din_baza_de_date = $mysqli->query("SELECT * FROM `utilizatori_site` WHERE `nume` = '$nume_utilizator'"); // Aceasta functie efectueaza selectarea numelui din baza de date.
while($row = mysqli_fetch_array($preia_numele_din_baza_de_date)){ $numele_din_baza_de_date = $row["nume"]; } // Aceasta functie transforma datele prinite text din MySql intr-o variabila pe care o vom utiliza ulterior.

setcookie('este_conectat', '1', time() + (3600 * timp_maxim_sesiunea_ore), "/"); // Aceata functie salveaza pentru numarul de ore specificate mai sus faptul ca utilizatorul este conectat.
setcookie('conectat_ca', $numele_din_baza_de_date, time() + (3600 * timp_maxim_sesiunea_ore), "/"); // Aceata functie salveaza pentru numarul de ore specificate mai sus numele utilizatorului obtinut din MySql.
header("Location: ".adresa_site."".$redirect_login_catre.""); // Aceasta functie redirectioneaza utilizatorul pe pagina ceruta in caz ca datele de conectare sunt corecte.

} else { // In caz ca Utilizatorul/Parola sunt gresite se efectueaza:
	
setcookie('date_gresite', '1', time() + (10), "/"); // Aceasta functie seteaza pentru 5 secunde (destul pentru a afisa mesajul de eroare) faptul ca datele introduse sunt eronate.
setcookie('login_redirect', $redirect_login_catre, time() + (10), "/"); // Aceasta functie seteaza din nou ce pagina dorea utilizatorul sa acceseze in caz ca nu mai este setata.
header("Location: ".adresa_site."/conectare.php"); // Aceasta functie redirectioneaza utilizatorul pe pagina de conectare din nou, in caz ca a gresit parola. (Este nevoie sa fie din nou trimis pe pagina de conectare pentru ca unele functii sa se actualizeze.)

}
}

mysqli_close($mysqli); // Aceasta functie inchide conexiunea cu baza de date.

}

////////// Functia pentru deconectarea utilizatorului daca doreste. (Inainte de expirarea timpului setat mai sus.)
if(isset($_GET['deconectare'])) { // Aceasta functie detecteaza daca utilizatorul cere sa fie deconectat, apoi executa:

if (isset($_SERVER['HTTP_COOKIE'])) { // Aceasta functie verifica daca utilizatorul este conectat.
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']); // Aceasta functie preia datele utilizatorului care au fost setate in momentul in care a fost autentificat.
    foreach($cookies as $cookie) { // Daca au fost gasite date precum daca este conectat sau numele sub care este conectat atunci sterge-le si deconecteaza utilizatorul.
        $parts = explode('=', $cookie); // Functii pentru a deconecta utilizatorul si pentru a sterge COOKIE.
        $name = trim($parts[0]); // Functii pentru a deconecta utilizatorul si pentru a sterge COOKIE.
        setcookie($name, '', time()-1000); // Functii pentru a deconecta utilizatorul si pentru a sterge COOKIE.
        setcookie($name, '', time()-1000, '/'); // Functii pentru a deconecta utilizatorul si pentru a sterge COOKIE.
    }
}

header("Location: ".adresa_site.""); // Aceasta functie redirectioneaza utilizatorul pe pagina principala dupa ce a fost deconectat.

}

mysqli_close($mysqli); // Aceasta functie inchide conexiunea cu baza de date.

?>