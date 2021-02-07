<?php require_once 'operations.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginPage</title>

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
            <h1>Login Page</h1>
            <span class="subheading">Enter your information!</span>
        </div>
    </div>
    </div>
</div>
</header>

<div class="container col-md-5">

    <?php if(isset($_GET['auth'])) { ?>

    <div class="alert alert-dark" role="alert" style="text-align: center;">Please login for Detail!</div>

    <?php } ?>

    <form role="form" action="" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password"  class="form-control" name="password">
        </div>
        <br>
        <input type="submit" name="login" value="Submit" class="btn btn-outline-secondary">

        <br><br>
        Not yet a member? <br> <br>  <a href="register.php" class="btn btn-outline-secondary">Sign up</a>

        <br> <br>

        <?php
            if(isset($_GET['register'])) { ?>
                <div class="alert alert-dark" role="alert" style="text-align: center;">Register successfully!</div>
            <?php }
            if(isset($_GET['logFail'])) { ?>
                <div class="alert alert-dark" role="alert" style="text-align: center;">Email or password are not correct!</div>
            <?php }
        ?>

        <?php include('errors.php'); ?>

    </form>
</div>

<?php require 'includes/footer.php'; ?>

</body>
</html>