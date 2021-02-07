<?php require 'db.php';

session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IndexPage</title>

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
        <h1>Blog Site</h1>

        <?php

        if(!isset($_SESSION['username'])){ ?>
            <span class="subheading">Sign up and login to add articles!</span>
        <?php } else { ?>
            <span class="subheading">Welcome <?php echo $_SESSION['username'] ?></span>
        <?php } ?>

        </div>
    </div>
    </div>
</div>
</header>

<div class="container">

    <?php if(isset($_GET['logout'])) { ?>
        <div class="alert alert-dark" role="alert" style="text-align: center;">Logout successfully!</div>
    <?php } ?>

</div>

<?php

error_reporting(0);
$word = $_GET["search"];

if ($word != " "){

    $getArticle = $db->prepare("SELECT * FROM `articles` WHERE `active` = :active && `name` LIKE :search ORDER BY `date` DESC");
    $getArticle->bindValue(":active" , 1 ,PDO::PARAM_INT);
    $getArticle->bindValue(":search" , "%$word%" , PDO::PARAM_STR);

} else {

    $getArticle = $db->prepare("SELECT * FROM `articles` WHERE `active` = :active ORDER BY `date` DESC");
    $getArticle->bindValue(":active" , 1 ,PDO::PARAM_INT);

}

$getArticle->execute();

$getUser = $db->prepare("SELECT * FROM `users` WHERE `user_id` = :user_id");

while($row = $getArticle-> fetch(PDO::FETCH_ASSOC)){

    $getUser->bindValue(":user_id" , $row["user_id"] , PDO::PARAM_INT);
    $getUser->execute();
    $username = $getUser-> fetch(PDO::FETCH_ASSOC);

?>

<div class="row" style="text-align: center;">
    <div class="col-lg-8 col-md-10 mx-auto">
        <div class="post-preview">
            <a href="article_detail.php?article-id=<?=$row["article_id"]?>">
                <img src="/images/articles/<?= $row["image"] ?>" alt="" margin: auto width="320" height="320">
                <h2 class="post-title"> <?= $row["name"] ?> </h2>
            </a>
            <p class="post-meta">Posted by <?= $username["first_name"] ?> <strong> <?= $username["last_name"] ?> </strong> <?= $row["date"] ?> </p>
        </div>
        <hr>
    </div>
</div>

<?php } ?>

<?php require 'includes/footer.php' ?>

</body>
</html>