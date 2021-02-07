<?php require_once 'operations.php'; 

if (!isset($_SESSION['username'])) {
    header('location: login.php');
}

if($_SESSION["id"] == $_GET["user-id"]) {

    $_SESSION['article_id'] = $_GET["edit-article-id"];

    $id = $_GET["edit-article-id"];
    $getEdit = $db->prepare("SELECT * FROM `articles` WHERE `article_id` = :id");
    $getEdit->bindValue(":id" , $id , PDO::PARAM_INT);
    $getEdit->execute();
    $row = $getEdit->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EditArticlePage</title>

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
            <h1>Edit <?= $row["name"] ?></h1>
            <span class="subheading">Edit your article information!</span>
        </div>
    </div>
    </div>
</div>
</header>

<div class="container col-md-5">
    <form role="form" action="" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="<?= $row["name"] ?>">
        </div>

        <div class="form-group">
            <label>Image</label>
            <input type="file" class="form-control" name="image" value="<?= $row["image"] ?>">
        </div>

        <div class="form-group">
            <label>Body</label>
            <textarea class="form-control" name="body" id="description_textarea"><?= $row["body"] ?></textarea>
        </div>

        <input type="radio" name="active" value="1">
        <label for="active">Active</label><br>
        <input type="radio" name="active" value="2">
        <label for="passive">Passive</label><br>

        <br>
        <input type="submit" name="edit_article" value="EDIT" class="btn btn-outline-secondary">

        <br> <br>

        <?php include('errors.php'); ?>

    </form>
</div>

<?php

} else {
 header('location: login.php');
}

?>

<?php require 'includes/footer.php'; ?>

</body>
</html>