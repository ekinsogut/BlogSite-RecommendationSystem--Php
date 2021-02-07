<?php require_once 'operations.php';

if (!isset($_SESSION['username'])) {
    header('location: login.php');
}

if(isset($_GET['delete_id'])) {

    $id = $_GET['delete_id'];

    $delete = $db->prepare("DELETE FROM `articles` WHERE `article_id` = :article_id");
    $delete->bindValue(":article_id" , $id , PDO::PARAM_INT);

    $deleteForRating = $db->prepare("DELETE FROM `user_ratings` WHERE `article_id` = :article_id");
    $deleteForRating->bindValue(":article_id" , $id , PDO::PARAM_INT);
    $deleteForRating->execute();

    if($delete->execute()) {
        header("Location: my_article.php?deleteArticle=ok");
    } else {
        header("Location: my_article.php?deleteArticle=err");
    }

    }

$id = $_SESSION["id"];
$getArticle = $db->prepare("SELECT * FROM `articles` WHERE `user_id` = :id");
$getArticle->bindValue(":id" , $id , PDO::PARAM_INT);
$getArticle->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyArticlePage</title>

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
            <h1>My Articles</h1>
            <span class="subheading">All My Articles!</span>
        </div>
    </div>
    </div>
</div>
</header>

<div class="container col-md-5">

    <?php
        if($_GET['editArticle'] == "ok") { ?>
            <div class="alert alert-dark" role="alert" style="text-align: center;">EditArticle is successfully!</div>
        <?php }
        if($_GET['editArticle'] == "err") { ?>
            <div class="alert alert-dark" role="alert" style="text-align: center;">EditArticle is failed!</div>
        <?php }
    ?>

    <?php
        if($_GET['deleteArticle'] == "ok") { ?>
            <div class="alert alert-dark" role="alert" style="text-align: center;">DeleteArticle is successfully!</div>
        <?php }
        if($_GET['deleteArticle'] == "err") { ?>
            <div class="alert alert-dark" role="alert" style="text-align: center;">DeleteArticle is failed!</div>
        <?php }
    ?>

    <table class="table">
    <thead class="thead-light">
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Date</th>
        <th>Active-Passive</th>
        <th>UserID</th>
        <th>Edit</th>
        <th>Delete</th>
        </tr>
    </thead>
    <tbody>

    <?php while($row = $getArticle-> fetch(PDO::FETCH_ASSOC)){ ?>
        <tr>
        <th scope="row"><?= $row["article_id"] ?></th>
        <td><?= $row["name"] ?></td>
        <td><?= $row["date"] ?></td>
        <td><?= $row["active"] ?></td>
        <td><?= $row["user_id"] ?></td>
        <td><a href="edit_article.php?edit-article-id=<?= $row["article_id"] ?>&user-id=<?= $row["user_id"] ?>" class="btn btn-success">Edit</a></td>
        <td><a href="my_article.php?delete_id=<?= $row["article_id"] ?>" class="btn btn-danger">Delete</a></td>
        </tr>

    <?php } ?>

    </tbody>
    </table>

</div>

<?php require 'includes/footer.php'; ?>

</body>
</html>