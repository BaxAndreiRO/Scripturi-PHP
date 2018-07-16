<title>Genereaza un numar norocos <3</title>
<link rel="stylesheet" href="http://bootswatch.com/paper/bootstrap.css" media="screen">
<br>
<?php

if(isset($_POST['n1']) && isset($_POST['n2']) && !empty($_POST['n1']) && !empty($_POST['n2'])) {
	
	echo "<center>";
	echo "\n";
	echo '<h5 class="text-success">';
	echo "Numarul generat random este: ";
	echo rand($_POST['n1'],$_POST['n2']);
	echo '</h5>';
	echo "\n";
	echo "</center>";
	
?>

<form method="post">
	<center>
	<br>
	<input type="hidden" name="n1" placeholder="intre:" value="<?php echo $_POST['n1']; ?>"></input>
	<input type="hidden" name="n2" placeholder="si intre:" value="<?php echo $_POST['n2']; ?>"></input>
	<input type="submit" class="btn btn-primary" style="width:90%!important" value="Incearca din nou cu aceleasi specificari! (<?php echo $_POST['n1']; ?>,<?php echo $_POST['n2']; ?>)"></input>
	</center>
</form>
<form method="post">
	<center>
	<input type="submit" class="btn btn-success" style="width:90%!important" value="Alege alte numere!"></input>
	</center>
</form>

<?php

} else {
	?>
	
<form method="post">
	<center>
	<h5 class="text-primary">Alege numerele si da-i bataie!</h5>
	<input required autocomplete="off" type="number" name="n1" style="width:95%!important" placeholder="Generaza un numar random intre:"></input>
	<br><br>
	<input required autocomplete="off" type="number" name="n2" style="width:95%!important" placeholder="si intre:"></input>
	<br><br>
	<input type="submit" class="btn btn-primary" style="width:90%!important" value="Ma simt norocos!"></input>
	</center>
</form>
	
	<?php
}

?>