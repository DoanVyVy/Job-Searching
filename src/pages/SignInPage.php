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
  <div class="main">
    <form action="" method="POST" class="form" id="form-1">
      <a href="HomePage.php">
        <img src="../../public/images/logo.png" alt="logo" class="logo">
      </a>
      <div class="spacer"></div>

      <div class="form-group">
        <label for="email" class="form-label">Email</label>
        <input id="email" name="email" type="text" placeholder="Enter your email" class="form-control" />
        <span class="form-message"></span>
      </div>

      <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input id="password" name="password" type="password" placeholder="Enter your password" class="form-control" />
        <span class="form-message"></span>
      </div>



      <button class="form-submit">Sign Up</button>

      <div class="having-account">
        You have not had an account?
        <a href="SignUpPage.php" class="login">Sign up</a>
      </div>
    </form>
  </div>
</body>

</html>