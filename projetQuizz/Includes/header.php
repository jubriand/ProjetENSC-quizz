<?php require_once "functions.php"; ?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">">
  <a class="navbar-brand" href="PageChoix.php">Page d'accueil</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  	<?php if (isUserConnected()){?>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="Profil.php">Profil <span class="sr-only">(current)</span></a>
      </li>
	  <?php if (isAdmin()==0){ ?>
      <li class="nav-item">
        <a class="nav-link" href="Admin.php">Administrateur</a>
      </li>
      <?php } ?>
	</ul>
	<?php } ?> 
  </div>
</nav>


