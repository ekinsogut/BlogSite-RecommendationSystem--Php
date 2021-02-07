<?php

require 'db.php';
require 'models/User.php';
require 'models/Article.php';
require 'models/Rating.php';

session_start();

error_reporting(0);
if(@$_POST["register"]) {

    $first_name = htmlspecialchars($_POST["first_name"], ENT_QUOTES, 'UTF-8');
    $last_name = htmlspecialchars($_POST["last_name"], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');

    $image = $_FILES["image"]["name"];
    $target = "images/users/".basename($_FILES['image']['name']);

    if (empty($first_name)) { array_push($errors, "Name is required"); }
    if (empty($last_name)) { array_push($errors, "Surname is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }

    $newReg = new User($first_name,$last_name,$image,$email,$password);

    $check = $db->prepare("SELECT * FROM `users` WHERE `email` = :email");

    $check->bindValue(":email",$newReg->get_email(),PDO::PARAM_STR);
    $check->execute();

    $row = $check-> fetch(PDO::FETCH_ASSOC);

    if($row["email"]) {
      if($row["email"] == $newReg->get_email()) {
        array_push($errors, "User already exists");
      }
    }

    if (count($errors) == 0){

      $add = $db->prepare("INSERT INTO `users` (`first_name`,`last_name`,`image`,`email`,`password`) VALUES (:first_name , :last_name ,:image, :email , :password)");

      $add->bindValue(":first_name",$newReg->get_first_name(),PDO::PARAM_STR);
      $add->bindValue(":last_name",$newReg->get_last_name(),PDO::PARAM_STR);
      $add->bindValue(":image",$newReg->get_image(),PDO::PARAM_STR);
      $add->bindValue(":email",$newReg->get_email(),PDO::PARAM_STR);
      $add->bindValue(":password",$newReg->get_password(),PDO::PARAM_STR);

      if($add -> execute()) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        header("Location: login.php?register");
      }
    }
}

if(@$_POST["login"]) {

    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');

    if (empty($email)) {array_push($errors, "Username is required");}
    if (empty($password)) {array_push($errors, "Password is required");}

    $newLog = new User($email,$password);

    if (count($errors) == 0){

        $log = $db->prepare("SELECT * FROM `users` WHERE `email` = :email AND `password` = :password");
        $log->bindValue(":email",$newLog->get_email(),PDO::PARAM_STR);
        $log->bindValue(":password",$newLog->get_password(),PDO::PARAM_STR);

        $log -> execute();
        $row = $log-> fetch(PDO::FETCH_ASSOC);

        if($newLog->get_email() == $row["email"] && $newLog->get_password() == $row["password"]) {

            $_SESSION['username'] = $row['first_name'];
            $_SESSION['id'] = $row['user_id'];
            $_SESSION['logControl'] = 1;

            header("Location: index.php");

        } else {

            header("Location: login.php?logFail");
        }
    }
}

if(@$_POST["add_article"]){

  $name = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
  $body = htmlspecialchars($_POST["body"], ENT_QUOTES, 'UTF-8');
  $active = htmlspecialchars($_POST["active"], ENT_QUOTES, 'UTF-8');

  $image = $_FILES["image"]["name"];
  $target = "images/articles/".basename($_FILES['image']['name']);

  if (empty($name)) { array_push($errors, "Name is required"); }
  if (empty($body)) { array_push($errors, "Body is required"); }
  if (empty($active)) { array_push($errors, "Active is required"); }

  $addArticle = new Article($name, $image, $body, $active);

  if (count($errors) == 0){

    $add = $db->prepare("INSERT INTO `articles` (`name`,`image`,`body`,`user_id`,`active`) VALUES (:name, :image, :body, :user_id, :active)");

    $add->bindValue(":name",$addArticle->get_name(),PDO::PARAM_STR);
    $add->bindValue(":image",$addArticle->get_image(),PDO::PARAM_STR);
    $add->bindValue(":body",$addArticle->get_body(),PDO::PARAM_STR);
    $add->bindValue(":user_id",$_SESSION["id"],PDO::PARAM_INT);
    $add->bindValue(":active",$addArticle->get_active(),PDO::PARAM_INT);

    if($add->execute()) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        header("Location: add_article.php?addArticle=ok");
    } else {
        header("Location: add_article.php?addArticle=err");
    }
  }
}

if(@$_POST["edit_article"]){

  $name = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
  $body = htmlspecialchars($_POST["body"], ENT_QUOTES, 'UTF-8');
  $active = htmlspecialchars($_POST["active"], ENT_QUOTES, 'UTF-8');

  $image = $_FILES["image"]["name"];
  $target = "images/articles/".basename($_FILES['image']['name']);

  if (empty($name)) { array_push($errors, "Name is required"); }
  if (empty($body)) { array_push($errors, "Body is required"); }
  if (empty($active)) { array_push($errors, "Active is required"); }

  $editArticle = new Article($name, $image, $body, $active);

  if (count($errors) == 0){

    $update = $db->prepare("UPDATE `articles` SET `name` = :name , `image` = :image ,`body` = :body , `user_id` = :user_id ,`active` = :active WHERE `article_id` = :article_id");

    $update->bindValue(":name",$editArticle->get_name(),PDO::PARAM_STR);
    $update->bindValue(":image",$editArticle->get_image(),PDO::PARAM_STR);
    $update->bindValue(":body",$editArticle->get_body(),PDO::PARAM_STR);
    $update->bindValue(":user_id",$_SESSION["id"],PDO::PARAM_INT);
    $update->bindValue(":active",$editArticle->get_active(),PDO::PARAM_INT);
    $update->bindValue(":article_id",$_SESSION["article_id"],PDO::PARAM_INT);

    if($update->execute()) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        header("Location: my_article.php?editArticle=ok");
    } else {
        header("Location: my_article.php?editArticle=err");
    }

  }
}

if(@$_POST["rating"]){

  $article_id = $_GET["article-id"];

  $score = htmlspecialchars($_POST["score"], ENT_QUOTES, 'UTF-8');

  if (empty($score)) { array_push($errors, "Score is required"); }

  $newRating = new Rating($score);

  if (count($errors) == 0){

    $rating = $db->prepare("INSERT INTO `user_ratings` (`article_id`,`article_rating`,`user_id`) VALUES (:article_id, :article_rating, :user_id)");

    $rating->bindValue(":article_id",$article_id,PDO::PARAM_INT);
    $rating->bindValue(":article_rating",$newRating->get_score(),PDO::PARAM_INT);
    $rating->bindValue(":user_id",$_SESSION["id"],PDO::PARAM_INT);

    if($rating->execute()) {
      header("Location: article_detail.php?article-id=$article_id");
    }
  }
}


?>