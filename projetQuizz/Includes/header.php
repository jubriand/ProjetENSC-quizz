<?php require_once "functions.php"; ?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <a class="navbar-brand media-heading" href="PageChoix.php"><img width="100px" class="d-inline-block align-top"  src="../Images/logoQuizz.png" title="logo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <?php if (isUserConnected()){?>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="btn btn-light" type="button" href="Profil.php">Profil <span class="sr-only">(current)</span></a>
      </li>
	  <?php if (isAdmin()==0){ ?>
      <li class="nav-item">
        <a class="btn btn-secondary" type="button" href="ChangementMode.php">
        <?php if($_SESSION['mode']=="admin")
        {
          print "Mode administrateur";
        }
        elseif($_SESSION['mode']=="joueur")
        {
          print "Mode joueur";
        }?>  
        </a>        
      </li>
      <?php } ?>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="navbar-right">
        <a class="btn btn-danger navbar-btn" type="button" href="Deconnexion.php">Deconnexion</a> 
      </li>
    </ul>
    <?php } 
    else {?>
    <ul class="navbar-nav ml-auto">
      <button class="btn btn-danger navbar-btn" type="button" data-toggle="modal" data-target="#Connexion">Connexion</button> 
      <?php AddIdent("Connexion");?>
      <button class="btn btn-outline-success" type="button" data-toggle="modal" data-target="#Inscription">Inscription</button>
      <?php AddIdent("Inscription");?>
    <?php } ?>
	  </ul>

  </div>
</nav>


