<?php
require_once "includes/functions.php";
session_start();

$movieId = $_GET['id'];
$stmt = getDb()->prepare('select * from movie where mov_id=?');
$stmt->execute(array($movieId));
$movie = $stmt->fetch(); // Access first (and only) result line
?>

<!doctype html>
<html>

<?php 
$pageTitle = $movie['mov_title'];
require_once "includes/head.php"; 
?>

<body>
    <div class="container">
        <?php require_once "includes/header.php"; ?>

        <div class="jumbotron">
            <div class="row">
                <div class="col-md-5 col-sm-7">
                    <img class="img-responsive movieImage" src="images/<?= $movie['mov_image'] ?>" title="<?= $movie['mov_title'] ?>" />
                </div>
                <div class="col-md-7 col-sm-5">
                    <h2><?= $movie['mov_title'] ?></h2>
                    <p><?= $movie['mov_director'] ?>, <?= $movie['mov_year'] ?></p>
                    <p><small><?= $movie['mov_description_long'] ?></small></p>
                </h2>
            </div>
        </div>
    </div>

    <?php require_once "includes/footer.php"; ?>
</div>

<?php require_once "includes/scripts.php"; ?>
</body>

</html>