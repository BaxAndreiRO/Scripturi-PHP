<?php if(isset($_POST['nume']) && !empty($_POST['nume'])) {
$NUME_URL = preg_replace('/[^a-zA-Z0-9]/', '', $_POST['nume']);
$_URL = $_POST['url'];
if(EXISTA_IN_DB($NUME_URL) || $NUME_URL == 'admin') { ?>
<div class="alert alert-dismissible alert-warning">
  <h4>Eroare!</h4>
  <p>Imi pare rau, dar numele personalizat pe care doresti sa il pui adresei url specificate este deja folosit! <br> <a class="label label-danger" href="<?= $ADRESA_CURENTA; ?>">Apasa aici</a> pentru a alege altul sau a utiliza unul random.</p>
</div>
<?php } else {
$mysqli->query("INSERT INTO `adrese` (`id`, `nume`, `url`, `vizualizari`) VALUES (NULL, '$NUME_URL', '$_URL', '0');"); ?>
<div class="alert alert-dismissible alert-success">
  <h4>Felicitari!</h4>
  <p>Adresa <code><a href="<?= $ADRESA_CURENTA; ?><?= $NUME_URL; ?>/" target="_blank"><?= $ADRESA_CURENTA; ?><?= $NUME_URL; ?>/</a></code> a fost generata! <br> <a class="label label-info" href="<?= $ADRESA_CURENTA; ?>">Apasa aici</a> pentru a genera o alta adresa.</p>
</div>
<?php }
} else {
$NUME_URL = NUME_URL(LUNGIME_URL);
$NUME_URL2 = NUME_URL(LUNGIME_URL+3);
$_URL = $_POST['url'];
if(EXISTA_IN_DB($NUME_URL) || $NUME_URL == 'admin') {
$mysqli->query("INSERT INTO `adrese` (`nume`, `url`) VALUES ('$NUME_URL2', '$_URL')"); ?>
<div class="alert alert-dismissible alert-success">
  <h4>Felicitari!</h4>
  <p>Adresa <code><a href="<?= $ADRESA_CURENTA; ?><?= $NUME_URL2; ?>/" target="_blank"><?= $ADRESA_CURENTA; ?><?= $NUME_URL2; ?>/</a></code> a fost generata! <br> <a class="label label-info" href="<?= $ADRESA_CURENTA; ?>">Apasa aici</a> pentru a genera o alta adresa.</p>
</div>
<?php } else {
$mysqli->query("INSERT INTO `adrese` (`nume`, `url`) VALUES ('$NUME_URL', '$_URL')"); ?>
<div class="alert alert-dismissible alert-success">
  <h4>Felicitari!</h4>
  <p>Adresa <code><a href="<?= $ADRESA_CURENTA; ?><?= $NUME_URL; ?>/" target="_blank"><?= $ADRESA_CURENTA; ?><?= $NUME_URL; ?>/</a></code> a fost generata! <br> <a class="label label-info" href="<?= $ADRESA_CURENTA; ?>">Apasa aici</a> pentru a genera o alta adresa.</p>
</div>
<?php }
} ?>