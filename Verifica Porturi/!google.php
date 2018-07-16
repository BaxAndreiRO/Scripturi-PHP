<?php if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']) ) { 
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$key_google_secret."&response=".$_POST['g-recaptcha-response']."&remoteip=".$ip);
$responseKeys = json_decode($response,true);
if(intval($responseKeys["success"]) !== 1) {
$google_r = 2;
// robot detectat
} else {
$google_r = 0;
// totul este OK
}
} else {
$google_r = 1;
// nu a bifat ca e sau nu robot
} ?>