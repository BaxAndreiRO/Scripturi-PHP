<div class="container">
	<div class="row">
		<div class="col-lg-12 text-center" style="float: none; margin: 0 auto;">

			<div class="panel panel-primary">
				<div class="panel-body">

				<code>Copyright <i class="fa fa-copyright" aria-hidden="true"></i> <?= date('Y'); ?> <?= NUME_SITE; ?>. Toate drepturile sunt rezervate <i class="fa fa-registered" aria-hidden="true"></i>.</code>
				
				</div>
			</div>

		</div>
	</div>
</div>

<?php if(NAVIGARE == 1) { ?>
<?php if(ACP == 0) { ?><a href="<?= ADRESA_SITE; ?>admin/" id="bx-button" class="btn btn-default">Admin Panel</a><?php } ?>
<?php if(ACP == 1) { ?><a href="<?= ADRESA_SITE; ?>" id="bx-button" class="btn btn-default">Vizualizare Site</a><?php } ?>
<?php } ?>