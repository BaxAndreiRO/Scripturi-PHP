<div class="container">
	<div class="row">
		<div class="col-lg-12 text-center" style="float: none; margin: 0 auto;">

			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Va rugam sa introduceti parola!</h3>
				</div>
				<div class="panel-body">
<?php if($bun_venit == 1) { ?>
<div class="alert alert-dismissible alert-success bx-alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Bun venit in panoul de administrare!</strong>
</div>

<?php } ?>
<?php if(isset($_POST['stergere_id']) && isset($_POST['stergere'])) {
if(EXISTA_IN_DB_ID($_POST['stergere_id'])) {
if(STERGE($_POST['stergere_id'])) { ?>
<div class="alert alert-dismissible alert-success bx-alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Elementulu cu id-ul #<?= $_POST['stergere_id']; ?> a fost sters!</strong>
</div>
<?php } else { ?>
<div class="alert alert-dismissible alert-danger bx-alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Se pare ca a aparut o problema neasteptata la stergerea elementului cu id-ul #<?= $_POST['stergere_id']; ?>!</strong>
</div>
<?php }
} else { ?>
<div class="alert alert-dismissible alert-warning bx-alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Se pare ca nu exista nimic in baza de date care sa aiba id-ul #<?= $_POST['stergere_id']; ?>!</strong>
</div>
<?php }
} ?>
<table class="table table-bordered table-striped table-hover table-condensed table-responsive">
	<thead>
		<tr>
			<th>
				<center>#</center>
			</th>
			<th>
				<center>Nume</center>
			</th>
			<th>
				<center>Afisari</center>
			</th>
			<th>
				<center>URL</center>
			</th>
			<th>
				<center>Stergere</center>
			</th>
		</tr>
	</thead>
	<tbody>
<?= ADRESE(); ?>
	</tbody>
</table>
		
				</div>
			</div>

		</div>
	</div>
</div>