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
  <title>Sign up</title>
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

  if (isset($_POST["create-account"])) {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * from user where email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      $errormsg = "This email already exists";
    } else {
      $sql = "INSERT INTO user (email, password) VALUES ('$email', '$password')";
      if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Success!');</script>";
        header("Location: /JobSearching/src/pages/HomePage.php");
      } else {
        echo
        "<script>alert('Something was wrong!');</script>";
      }
    }
  }
  mysqli_close($conn);
  ?>

  <div class="main">
    <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="POST" class="form" id="form-1">
      <a href="HomePage.php">
        <img src="../../public/images/logo.png" alt="logo" class="logo">
      </a>
      <div class="spacer"></div>
      <div class="form-group">
        <label for="fullname" class="form-label">Fullname</label>
        <input id="fullname" name="fullname" type="text" placeholder="Enter your fullname" class="form-control" value="<?php if (isset($_POST["create-account"])) if ($fullname) echo $fullname; ?>" required />
        <span class="form-message"></span>
      </div>

      <div class="form-group <?php if ($errormsg) echo 'invalid'; ?>">
        <label for="email" class="form-label">Email</label>
        <input id="email" name="email" type="text" placeholder="Enter your email" class="form-control" value="<?php if (isset($_POST["create-account"])) if ($email) echo $email; ?>" required />
        <span class="form-message">
          <?php if ($errormsg) echo $errormsg; ?>
        </span>
      </div>

      <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input id="password" name="password" type="password" placeholder="Enter your password" class="form-control" required />
        <span class="form-message"></span>
      </div>

      <div class="form-group">
        <label for="password_confirmation" class="form-label">Confirm password</label>
        <input id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" type="password" class="form-control" required />
        <span class="form-message"></span>
      </div>

      <button class="form-submit" name="create-account">Create an account</button>

      <div class="having-account">
        You already have an account?
        <a href="SignInPage.php" class="login"> Login</a>
      </div>
    </form>
  </div>

  <script src="../js/validation.js"></script>
  <script>
    validator({
      form: "#form-1",
      errorSelector: ".form-message",
      rules: [
        validator.isRequire("#fullname"),
        validator.isRequire("#email"),
        validator.isEmail("#email"),
        validator.isRequire("#password"),
        validator.isPassword("#password"),
        validator.isRequire("#password_confirmation"),
        validator.confirmPassword("#password_confirmation")
      ]
    });
  </script>

</body>

</html>