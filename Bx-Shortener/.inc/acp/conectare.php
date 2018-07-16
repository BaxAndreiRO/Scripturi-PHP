<div class="container">
	<div class="row">
		<div class="col-lg-12 text-center" style="float: none; margin: 0 auto;">

			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Va rugam sa introduceti parola!</h3>
				</div>
				<div class="panel-body">
<?php if($eroare_login == 1) { ?>
<div class="alert alert-dismissible alert-danger bx-alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Parola introdusa este incorecta!</strong>
</div>

<?php } ?>
<form method="post">
    <div class="input-group bx-spacer">
      <input type="password" name="parola" required class="form-control" placeholder="Parola ACP">
      <span class="input-group-btn">
        <button class="btn btn-default" name="conectare" type="submit">&nbsp;&nbsp;&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;Autentificare&nbsp;&nbsp;&nbsp;</button>
      </span>
    </div>
</form>		
		
				</div>
			</div>

		</div>
	</div>
</div>