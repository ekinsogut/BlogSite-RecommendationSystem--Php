<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
<div class="container">
    <a class="navbar-brand" href="index.php">IP2</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    Menu
    <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav ml-auto">

        <?php if(isset($_SESSION['username'])) {?>
        <li class="nav-item">
        <a class="nav-link" href="profile.php">Profile</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="my_article.php">My Articles</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="add_article.php">Add Article</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
        </li>
        <li class="nav-item">
        <form action="index.php" method="GET">
            <input type="text" name="search" placeholder="Search.." class="form-control">
        </form>
        </li>

        <?php } else { ?>

        <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
        </li>

        <?php } ?>

    </ul>
    </div>
</div>
</nav>