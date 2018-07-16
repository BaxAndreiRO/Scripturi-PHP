<?php

if(isset($_POST['ip']) && !empty($_POST['ip'])) { $adresa_utilizator = $_POST['ip']; } else { $adresa_utilizator = "1.1.1.1"; }
if(isset($_POST['port']) && !empty($_POST['port'])) { $port_utilizator = array($_POST['port']); } else { array(0); }

foreach ($port_utilizator as $port)
{
    $coneziune = @fsockopen($adresa_utilizator, $port, $errno, $errstr, $_POST['timeout']);

    if (is_resource($coneziune))
    {
        $status_port = 1;

        fclose($coneziune);
    }

    else
    {
         $status_port = 0;
    }
} ?>