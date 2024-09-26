<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <style>
    /* Reset some basic elements */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Arial', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-color: #f4f4f4;
    }

    .login-container {
      background-color: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;
      text-align: center;
    }

    h2 {
      margin-bottom: 20px;
      color: #333;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    label {
      font-size: 1rem;
      color: #333;
      text-align: left;
    }

    input[type="text"], input[type="password"] {
      padding: 12px;
      width: 100%;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 1rem;
    }

    input[type="submit"] {
      padding: 12px;
      border: none;
      background-color: #007bff;
      color: white;
      font-size: 1rem;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #0056b3;
    }

    a {
      display: inline-block;
      margin-top: 10px;
      color: #007bff;
      text-decoration: none;
      font-size: 1rem;
    }
    

    a:hover {
      text-decoration: underline;
    }

    .register-link {
      font-size: 0.9rem;
      color: #555;
      margin-top: 15px;
    }
    .error {
      color: red;
      font-size: 0.9rem;
      margin-top: 5px;
    }

  </style>
</head>
<body>
  <?php 
    session_start();
  ?>
  <div class="login-container">
    <h2>Login</h2>
    <form action=" " method="post">
      <label for="username">Username</label>
      <input type="text" name="user_name" id="user_name" placeholder="Enter your username">

      <label for="password">Password</label>
      <input type="password" name="password" id="password" placeholder="Enter your password">

      <input type="submit" name = "login" value="Login">
    </form>

    <div class="register-link">
      Don't have an account? <a href="register.php">Register</a>
      <div id="error_message" class="error"></div>
    </div>
  </div>
  <?php
    require __DIR__. "/../config/mySql.php";
  if (isset($_POST["login"])) {
    $user_name = $_POST["user_name"];
    $password = md5($_POST["password"]);
    $mysql = new MySql();
    $user = $mysql->get_user($user_name);

    if ($user["pass_word"] == $password) {
      session_start();
      $_SESSION["user_id"] = $user["id"];
      $_SESSION["data_user"] = $mysql->get_data_user($user["id"]);;
      $data_all_posts = $mysql->get_all_posts();
      for ($i = 0; $i < count($data_all_posts); $i++) {
        $data = $mysql->get_info_user_add_post($data_all_posts[$i]["user_id"]);
        $data_all_posts[$i]["user_name"] = $data["user_name"];
        $data_all_posts[$i]["full_name"] = $data["full_name"];
      }
      $_SESSION["data_all_posts"] = $data_all_posts;
      header("Location: index.php");
      exit();
    } else {
      echo "<script>document.getElementById('error_message').textContent += 'Login failed '; </script>";


    }
  }
  ?>
</body>
</html>