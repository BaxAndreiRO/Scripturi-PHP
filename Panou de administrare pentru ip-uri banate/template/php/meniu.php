<nav style="border-radius:0px;" class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo adresa_site; ?>"><?php echo nume_site; ?></a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo adresa_site; ?>">Acasa</a></li>
      </ul>
	  <?php if(isset($_COOKIE['utilizator']) && !empty($_COOKIE['utilizator'])) { ?>
	  <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_COOKIE['utilizator']; ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
			<li><form id="deconectare" style="display:none;" method="post"><input type="hidden" style="display:none;" name="deconectare" value="deconectare" /></form><a style="cursor:pointer;" onclick="document.getElementById('deconectare').submit();">Deconectare</a></li>
          </ul>
        </li>
	  </ul>
	  <?php } ?>
    </div>
	
  </div>
</nav>