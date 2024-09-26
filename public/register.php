<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="css/register.css">
</head>
<body>
  <div class="form-container">
    <h1>Register</h1>
    <form id="registerForm" action="" method="POST" onsubmit="return validateForm()">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" required value= <?php if (isset($_POST["username"])) {
        echo $_POST["username"];} ?>  >
        
      <label for="full_name">Full Name</label>
      <input type="text" id="full_named" name="full_name" required>
      
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required minlength="6">


      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>

      <input type="submit" name="register" value="Register">
      <p class="redirect-login">You have an account? <a href="login.php">Login</a></p>
      <div id="error_message" class="error"></div>
      <div id="success_message" class="success"></div>
    </form>
  </div>

  <?php
    require __DIR__ . '/../src/inc/validation.php';
    require __DIR__ . '/../config/mySql.php';

    if (isset($_POST["register"])) {
      // Sanitize inputs
      $i_username = htmlspecialchars(trim($_POST["username"]));
      $i_password = htmlspecialchars(trim($_POST["password"]));
      $i_full_name = htmlspecialchars(trim($_POST["full_name"]));
      $i_email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
      $errors = [];

      // Validate fields
      if (empty($i_username) || strlen($i_username) < 3) {
        $errors[] = "Username must be at least 3 characters long.";
      }
      if (!filter_var($i_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
      }
      if (strlen($i_password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
      }

      if (empty($errors)) {
        echo "<script>document.getElementById('success_message').textContent = 'Registration successful!';</script>";
        $mysql = new MySql();

        $mysql->add_user(
          $i_username,
          md5($i_password), 
          $i_email, 
          $i_full_name
        );
        
        header("Location: http://localhost/intern_OLM_PHP/myBlogPHP/login.php");

      } else {
        foreach ($errors as $error) {
          echo "<script>document.getElementById('error_message').textContent += '$error '; </script>";
        }
      }
    }
    // Close the database connection
    


  ?>
</body>
</html>