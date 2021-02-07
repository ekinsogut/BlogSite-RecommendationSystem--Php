<?php

require_once 'operations.php';
include 'recommend.php';

if (!isset($_SESSION['username'])) {
    header('location: login.php?auth');
}

$getUser = $db->prepare("SELECT * FROM `users` WHERE `user_id` = :user_id");
$getUser->bindValue(":user_id" , $_SESSION["id"] , PDO::PARAM_INT);
$getUser->execute();
$row = $getUser-> fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <?php require 'includes/header.php' ?>

</head>
<body>

<?php require 'includes/navbar.php'; ?>

<header class="masthead" style="background-image: url('includes/img/home-bg.jpg')">
<div class="overlay"></div>
<div class="container">
    <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
            <h1>Recommendation!</h1>
            <span class="subheading">For <?= $row["first_name"] ?> <?= $row["last_name"] ?></span>
        </div>
    </div>
    </div>
</div>
</header>

<div class="row" style="text-align: center;">
    <div class="col-lg-8 col-md-10 mx-auto">

        <table class="table">
        <thead class="thead-light">
            <tr>
            <th>Article Name</th>
            <th>Rating</th>
            </tr>
        </thead>
        <tbody>

        <?php if(isset($_GET['recommend'])) {

            $getRating = $db->prepare("SELECT * FROM `user_ratings`");
            $getRating->execute();

            $matrix = array();

            while($rating = $getRating-> fetch(PDO::FETCH_ASSOC)){

            $getRateUser = $db->prepare("SELECT * FROM `users` WHERE `user_id` = :user_id");
            $getRateUser->bindValue(":user_id" , $rating["user_id"] , PDO::PARAM_INT);
            $getRateUser->execute();
            $rateUser = $getRateUser-> fetch(PDO::FETCH_ASSOC);

            $getArticle = $db->prepare("SELECT * FROM `articles` WHERE `article_id` = :article_id");
            $getArticle->bindValue(":article_id" , $rating["article_id"] , PDO::PARAM_INT);
            $getArticle->execute();
            $rateArticle = $getArticle-> fetch(PDO::FETCH_ASSOC);

            $matrix[$rateUser["first_name"]][$rateArticle["name"]] = $rating["article_rating"];

            }

            $recommendation = array();

            $recommendation = getRecommendation($matrix,$_SESSION["username"]);

            foreach($recommendation as $article=>$rating){

        ?>
                <tr>
                <td><?= $article ?></td>
                <td><?= $rating ?></td>
                </tr>

        <?php
            }
        }

        ?>

        </tbody>
        </table>

    </div>
</div>

<?php require 'includes/footer.php'; ?>

</body>
</html>