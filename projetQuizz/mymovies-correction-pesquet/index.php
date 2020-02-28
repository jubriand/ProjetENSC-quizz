<?php
require_once "includes/functions.php";
session_start();

// Retrieve all movies
$movies = getDb()->query('select * from movie order by mov_id desc'); 
?>

<!doctype html>
<html>

<?php require_once "includes/head.php"; ?>

<body>
    <div class="container">
        <?php require_once "includes/header.php"; ?>

        <?php foreach ($movies as $movie) { ?>
            <article>
                <h3><a class="movieTitle" href="movie.php?id=<?= $movie['mov_id'] ?>"><?= $movie['mov_title'] ?></a></h3>
                <p class="movieContent"><?= $movie['mov_description_short'] ?></p>
            </article>
        <?php } ?>

        <?php require_once "includes/footer.php"; ?>
    </div>

    <?php require_once "includes/scripts.php"; ?>
</body>

</html>