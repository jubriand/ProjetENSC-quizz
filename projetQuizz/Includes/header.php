<?php require_once "functions.php"; ?>

<header>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="PageChoix.php">Page d'accueil</a>
			</div>
				<?php if (isUserConnected()){?>
				<ul class="nav navbar-nav navbar-right">
					<li class="nav-item active">
						<a class="nav-link" href="Profil.php">Profil</a>
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
</header>

