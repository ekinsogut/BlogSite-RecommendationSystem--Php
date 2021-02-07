<?php require_once 'operations.php';

if (!isset($_SESSION['username'])) {
    header('location: login.php?auth');
}

$id = $_GET["article-id"];
$getDetail = $db->prepare("SELECT * FROM `articles` WHERE `article_id` = :id");
$getDetail->bindValue(":id" , $id , PDO::PARAM_INT);
$getDetail->execute();
$row = $getDetail->fetch(PDO::FETCH_ASSOC);

$getUser = $db->prepare("SELECT * FROM `users` WHERE `user_id` = :user_id");
$getUser->bindValue(":user_id" , $row["user_id"] , PDO::PARAM_INT);
$getUser->execute();
$username = $getUser-> fetch(PDO::FETCH_ASSOC);

$getRating = $db->prepare("SELECT * FROM `user_ratings` WHERE `article_id` = :article_id");
$getRating->bindValue(":article_id" , $id , PDO::PARAM_INT);
$getRating->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DetailPage</title>

    <?php require 'includes/header.php' ?>

</head>
<body>

<?php require 'includes/navbar.php'; ?>

<header class="masthead" style="background-image: url('/images/articles/<?= $row["image"] ?>')">
<div class="overlay"></div>
<div class="container">
    <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
            <h1><?= $row["name"] ?></h1>
            <span class="subheading">Posted by <?= $username["first_name"] ?> <strong> <?= $username["last_name"] ?> </strong> <?= $row["date"] ?></span>
        </div>
    </div>
    </div>
</div>
</header>

<div class="row" style="text-align: center;">
    <div class="col-lg-8 col-md-10 mx-auto">
        <p><?= $row["body"] ?></p>
        <hr>

        <?php while($rating = $getRating-> fetch(PDO::FETCH_ASSOC)){

            $getRateUser = $db->prepare("SELECT * FROM `users` WHERE `user_id` = :user_id");
            $getRateUser->bindValue(":user_id" , $rating["user_id"] , PDO::PARAM_INT);
            $getRateUser->execute();
            $rateUser = $getRateUser-> fetch(PDO::FETCH_ASSOC);

        ?>

        <div class="media">
            <img class="rounded-circle" src="/images/users/<?= $rateUser["image"] ?>" alt="Generic placeholder image" margin: auto width="100" height="100">
            <div class="media-body" align="left" style="margin-left: 30px;">
                <h5 class="mt-0"><?= $rateUser["first_name"] ?> <?= $rateUser["last_name"] ?></h5>
                <?= $rating["article_rating"] ?>
            </div>
        </div>

        <br>

        <?php } ?>
    </div>
</div>

<div class="col-lg-6 col-md-10 mx-auto">

<hr> <br>

<form role="form" action="" method="POST" enctype="multipart/form-data">

<label>Quantity (between 1 and 5):</label>
<input type="number" name="score" min="1" max="5"> <br><br>

<input type="submit" name="rating" value="RATING" class="btn btn-outline-secondary">

<?php include('errors.php'); ?>

</form>
</div>

<?php require 'includes/footer.php'; ?>

</body>
</html>