<?php if(!isset($_POST['url']) && empty($_POST['url']) && !isset($_POST['scurteaza']) && empty($_POST['scurteaza'])) { ?>
<form method="post">
    <div class="input-group bx-spacer">
      <input type="url" name="url" required class="form-control" placeholder="http://">
      <span class="input-group-btn">
        <button class="btn btn-default" name="scurteaza" type="submit">&nbsp;&nbsp;&nbsp;<i class="fa fa-link" aria-hidden="true"></i>&nbsp;Scurteaza&nbsp;&nbsp;&nbsp;</button>
      </span>
    </div>
	
<div class="input-group bx-spacer">
  <span class="input-group-addon" id="basic-addon1"><?= $ADRESA_CURENTA; ?></span>
  <input type="text" class="form-control" name="nume" placeholder="Nume personalizat pentru adresa (OPTIONAL)" aria-describedby="basic-addon1">
</div>
</form>	
<?php } else {
require_once($CALEA_DIRECTOR_INDEX.'/.inc/php/adauga_in_db.php');
} ?>