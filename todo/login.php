<?php

require_once 'functions/db_file.php';

/**
 * Check user login credentials and initiate a session if login is successful.
 *
 * This script checks if the login form is submitted, validates the provided username and password,
 * and starts a session if the login is successful, redirecting the user to 'notes.php'.
 */
$username = htmlspecialchars("");

if(isset($_POST['login'])){
    $username = $_POST['name'];
    $password = $_POST['password'];
    $user = existence_of_user($username);
    if($user){
        if (password_verify($password, $user['password'])){
            session_start();
            $_SESSION['user'] = $user;
            header('Location: notes.php');
        } else {
            $error = 'Password or username is incorrect';
        }
    } else {
        $error = 'Password or username is incorrect';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log In</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
</head>
<body>
<div class="main" id="login">
  <div class="content_box blue_box">
      <h1>Log In</h1>
      <form method="post" enctype="multipart/form-data">
          <div class="login_form">
              <div class="form_group">
                  <label for="name">
                      <i class="zmdi zmdi-account material-icons-name"></i>
                  </label>
                  <input type="text" name="name" id="name" value="<?= isset($username)?htmlspecialchars($username):''?>" placeholder="Username" required>
              </div>
              <div class="form_group">
                  <label for="password">
                      <i class="zmdi zmdi-lock"></i>
                  </label>
                  <input type="password" autocomplete="off" name="password" id="password" placeholder="Password" required>
                  <?php
                  if(isset($error)){
                      echo '<span class ="error_name">'.$error.'</span>';
                  }
                  ?>
              </div>
              <input type="submit" value="Log in" name="login" class="button">
          </div>
      </form>
  </div>
</div>
</body>
</html>