<?php
if(isset($_POST['ip']) && !empty($_POST['ip']) && isset($_POST['timeout']) && !empty($_POST['timeout']) && isset($_POST['port']) && !empty($_POST['port']) && isset($_POST['verifica']) && !empty($_POST['verifica'])) { require_once('!2.php'); } else { ?>
					<br>
					<form class="form-horizontal" method="POST" action="" style="padding-left:15px; padding-right:15px;">
						<fieldset>
							<div class="form-group">
								<input type="text" required autocomplete="off" class="form-control" id="ip" name="ip" placeholder="Adresa IP pe care doriti sa verificati daca este deschisa conexiunea." value="<?= $_SERVER['REMOTE_ADDR']; ?>">
							</div>
	
							<div class="form-group">
								<input type="text" required autocomplete="off" class="form-control" id="port" name="port" placeholder="Portul pe care doriti sa verificati daca este deschisa conexiunea.">
							</div>
	
							<div class="form-group">
								<input type="number" required autocomplete="off" class="form-control" id="timeout" name="timeout" placeholder="Setati timpul de timout dorit." min="1" max="9">
							</div>
		
							<div class="form-group">
								<center>
									<div class="g-recaptcha" data-sitekey="<?= $key_google_public ?>"></div>
								</center>
							</div>
		
							<div class="form-group">
								<button style="margin-top:3px; margin-bottom:3px;" type="submit" name="verifica" value="verifica" class="btn btn-primary">Verifica portul</button>
							</div>
						</fieldset>
					</form>

<?php } ?>