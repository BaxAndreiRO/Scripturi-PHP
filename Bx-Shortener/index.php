<?php $CALEA_DIRECTOR_INDEX = getcwd();
require_once(getcwd()."/.inc/setari/setari.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" id="min-width" lang="ro" xml:lang="ro" xmlns:og="http://opengraphprotocol.org/schema/">
<?php require_once($CALEA_DIRECTOR_INDEX."/.inc/componente/head.php"); ?>
<body style="background: #f5f5f5;">

<br>
<h1 class="text-center text-info"><?= NUME_SITE; ?></h1>
<br>

<?php if(ACP == 1) { require_once($CALEA_DIRECTOR_INDEX."/.inc/acp/index.php"); } else { require_once($CALEA_DIRECTOR_INDEX."/.inc/pagini/pagina-1.php"); } ?>

<?php require_once($CALEA_DIRECTOR_INDEX."/.inc/componente/footer.php"); ?>

</body>
</html>