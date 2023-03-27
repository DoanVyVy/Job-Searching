<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../styles/SignInUp.css">
  <link rel="stylesheet" href="../styles/reset.css">
  <title>Sign in</title>
</head>

<body>

  <?php
  $serverName = "localhost";
  $username = "root";
  $password = "";
  $dbname = "jobsearching";
  $errormsg = null;
  $conn = mysqli_connect($serverName, $username, $password, $dbname) or
    die("Connection failed: " . mysqli_connect_error());

  if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * from user where email = '$email' and password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
      $errormsg = "Email or password was wrong!";
    } else {
      header("Location: /JobSearching/src/pages/HomePage.php");
    }
  }
  mysqli_close($conn);
  ?>

  <div class="main">
    <form action="" method="POST" class="form" id="form-2">
      <a href="HomePage.php">
        <img src="../../public/images/logo.png" alt="logo" class="logo">
      </a>
      <div class="spacer"></div>

      <div class="form-group <?php if ($errormsg) echo 'invalid'; ?>">
        <label for="email" class="form-label">Email</label>
        <input id="email" name="email" type="text" placeholder="Enter your email" class="form-control" value="<?php if (isset($_POST["login"])) if ($email) echo $email; ?>" />
        <span class="form-message">
          <?php
          if ($errormsg) {
            echo $errormsg;
          }
          ?>
        </span>
      </div>

      <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input id="password" name="password" type="password" placeholder="Enter your password" class="form-control" />
        <span class="form-message"></span>
      </div>

      <button class="form-submit" name="login">Login</button>

      <div class="having-account">
        You have not had an account?
        <a href="SignUpPage.php" class="login">Sign up</a>
      </div>
    </form>
  </div>
  <script src="../js/validation.js"></script>
  <script>
    validator({
      form: "#form-2",
      errorSelector: ".form-message",
      rules: [
        validator.isRequire("#email"),
        validator.isRequire("#password"),
      ]
    });
  </script>;
</body>

</html>