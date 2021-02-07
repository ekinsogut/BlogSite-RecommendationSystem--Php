<?php require_once 'operations.php';

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
            <h1>Your Profile</h1>
            <span class="subheading">Hi <?= $row["first_name"] ?>!</span>
        </div>
    </div>
    </div>
</div>
</header>

<div class="row" style="text-align: center;">
    <div class="col-lg-8 col-md-10 mx-auto">
        <div class="post-preview">
                <img class="rounded-circle" src="/images/users/<?= $row["image"] ?>" alt="" margin: auto width="300" height="300">
                <hr>
                <h2 class="post-title"> <?= $row["first_name"] ?> <?= $row["last_name"] ?> </h2> <br>
            <p class="post-meta"><?= $row["email"] ?> </p>
        </div>
        <hr>

        <h1><a href="recommendItems.php?recommend" class="btn btn-outline-secondary">Recommend Article</a></h1>
    </div>
</div>

<?php require 'includes/footer.php'; ?>

</body>
</html>