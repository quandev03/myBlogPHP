<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/write_post.css"> 
   
    <title>Write Post</title>
</head>
  <?php 
    session_start();
    $user = $_SESSION['user_id'];
    if (!$user) {
      // header('Location: login.php');
      // exit();
  } else {
    $image = glob("../src/lib/images/default_avatar.png");
    $user_id = $_SESSION["user_id"];
    $data_user = $_SESSION["data_user"];
    
    $data_user["avatar_user"] = $data_user["avatar_user"] ? $data_user["avatar_user"] : "images/default_avatar.png";
    print_r($data_user);
  }
 ?>
<body>
<div class="header">
    <div class="logo">
        <img src="https://img.icons8.com/?size=200&id=81252&format=png&color=000000" alt="Logo" class="logo-img">
    </div>
    <div class="user-info">
        <img src="<?php echo $data_user["avatar_user"]; ?>" alt="Avatar" class="avatar">
        <span class="full-name"><?php echo $data_user['full_name']; ?></span>
    </div>
</div>
    <div class="back">
    </div>
    <div class="container">
        <h1>Write a New Post</h1>
        <form method="post" action=""> 
            <div class="form-group">
                <label for="title">Post Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Post Content:</label>
                <textarea id="content" name="content" rows="10" required></textarea>
            </div>
            <div class="group_button">
              <button class="back" onclick="window.location.href='index.php'">Back</button>
              <button type="submit" name="add_post">
                Submit Post
              </button>
            </div>
        </form>
    </div>
    <?php
      session_start();
      require __DIR__. "/../config/mySql.php";

      if (isset($_SESSION["user_id"])) {
          $user_id = (int) $_SESSION["user_id"];
          

          if (isset($_POST["add_post"])) {
              // Get and sanitize the input
              $title = trim($_POST["title"]);
              $content = trim($_POST["content"]);
              
              if (!empty($title) && !empty($content)) {
                  $mysql = new MySql();
                  $result = $mysql->add_a_post($title, $content, $user_id);
                  $data_all_posts = $mysql->get_all_posts();
                  for ($i = 0; $i < count($data_all_posts); $i++) {
                    $data = $mysql->get_info_user_add_post($data_all_posts[$i]["user_id"]);
                    $data_all_posts[$i]["user_name"] = $data["user_name"];
                    $data_all_posts[$i]["full_name"] = $data["full_name"];
                  }
                  $_SESSION["data_all_posts"] = $data_all_posts;

              if ($result) {
                echo "
                <script>
                  alert('Post added successfully!');
                  if (confirm('Do you want to add another post?')) {
                    window.location.href = 'write_post.php';  
                  } else {
                    window.location.href = 'index.php';
                  }
                </script>
                ";
              }
              
              } else {
                  // Input validation failed
                  echo "Title and content cannot be empty!";
              }
          }
      } else {
          // User is not logged in
          echo "Please log in to add a post.";
      }
      ?>
</body>
</html>