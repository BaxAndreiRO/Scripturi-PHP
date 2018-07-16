<?php

// Define-uri generale site.
define('adresa_site','http://localhost/bacp/');
define('nume_site','BaxAndrei BanIP Admin Panel');
define('adresa_favicon','null');
define('durata_cookie_s','86400'); // in secunde
define('culoare_fundal','black');
define('imagine_fundal','http://www.baxandrei.ro/wp-content/uploads/2016/03/pattern.png');

// Tema utilizata de site.
define('nume_tema','lumen');
// Lista teme disponibile (1/2): cerulean , journal , lumen , cyborg , darkly , cosmo , flatly , paper , readable
// Lista teme disponibile (2/2): sandstone , simplex , slate , yeti , spacelab , superhero , united

// Define-uri directoare.
define('cale_director_imagini','template/imagini/');
define('cale_director_bootstrap','template/bootstrap/');
define('cale_director_css','template/css/');
define('cale_director_template','template/php/');
define('cale_conturi_utilizatori','inc/.conturi/');

// Define-uri pentru baza de date mysql(i).
define('host_mysql','localhost');
define('utilizator_mysql','banip');
define('parola_utilizator_mysql','JGF94fZtL6SCudMH');
define('nume_baza_de_date_mysql','banip');
define('nume_tabel_mysql','banip');
$mysqli = mysqli_connect(host_mysql,utilizator_mysql,parola_utilizator_mysql,nume_baza_de_date_mysql);

// Define-uri webmaster.
define('webmaster_nume','Admin');
define('webmaster_parola','administrator1');

?>