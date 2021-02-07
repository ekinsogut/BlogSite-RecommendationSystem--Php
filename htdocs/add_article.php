<?php require_once 'operations.php'; 

if (!isset($_SESSION['username'])) {
    header('location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AddArticlePage</title>

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
            <h1>Add Article</h1>
            <span class="subheading">Enter your article information!</span>
        </div>
    </div>
    </div>
</div>
</header>

<div class="container col-md-5">
    <form role="form" action="" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name">
        </div>

        <div class="form-group">
            <label>Image</label>
            <input type="file" class="form-control" name="image">
        </div>

        <div class="form-group">
            <label>Body</label>
            <textarea class="form-control" name="body" id="description_textarea"></textarea>
        </div>

        <input type="radio" name="active" value="1">
        <label for="active">Active</label><br>
        <input type="radio" name="active" value="0">
        <label for="passive">Passive</label><br>

        <br>
        <input type="submit" name="add_article" value="Submit" class="btn btn-outline-secondary">

        <br> <br>

        <?php
            if($_GET['addArticle'] == "ok") { ?>
                <div class="alert alert-dark" role="alert" style="text-align: center;">AddArticle is successfully!</div>
            <?php }
            if($_GET['addArticle'] == "err") { ?>
                <div class="alert alert-dark" role="alert" style="text-align: center;">AddArticle is failed!</div>
            <?php }
        ?>

        <?php include('errors.php'); ?>

    </form>
</div>

<?php require 'includes/footer.php'; ?>

</body>
</html>