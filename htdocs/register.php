<?php require_once 'operations.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RegisterPage</title>

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
            <h1>Register Page</h1>
            <span class="subheading">Enter your information!</span>
        </div>
    </div>
    </div>
</div>
</header>

<div class="container col-md-5">
    <form role="form" action="" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="first_name">
        </div>

        <div class="form-group">
            <label>Surname</label>
            <input type="text" class="form-control" name="last_name">
        </div>

        <div class="form-group">
            <label>Image</label>
            <input type="file" class="form-control" name="image">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password"  class="form-control" name="password">
        </div>
        <br>
        <input type="submit" name="register" value="Submit" class="btn btn-outline-secondary">

        <br><br>
        Already a member? <br> <br>  <a href="login.php" class="btn btn-outline-secondary">Sign in</a>

        <br> <br>

        <?php include('errors.php'); ?>

    </form>
</div>

<?php require 'includes/footer.php'; ?>

</body>
</html>