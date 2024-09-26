<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/styles.css"> -->
     <style>
      body {
    font-family: Arial, sans-serif;
    margin: 0;
    background-color: #f4f4f4;
}

.header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #007bff;
    padding: 15px;
    color: white;
}

.user-info {
    display: flex;
    align-items: center;
}

.avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
}

.full-name {
    font-size: 20px;
    margin-right: 20px;
}

.back {
    padding: 10px 15px;
    background-color: #ff0000;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 28px;
    margin-bottom: 20px;
    color: #007bff;
}

button {
    padding: 10px 15px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 20px;
}

button:hover {
    background-color: #0056b3;
}

.post-list {
    margin-top: 20px;
}

.post {
    background-color: #ffffff;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.post-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.author {
    font-weight: bold;
}

.time {
    color: #666;
}

.options {
    background: none;
    border: none;
    color: #007bff;
    cursor: pointer;
}
     </style>
    <title>Read List</title>
</head>
<body>
    <?php
      session_start();
      $data_user = $_SESSION["data_user"];
    ?>
    <div class="header">
        <div class="user-info">
            <img src="<?php echo $data_user["avatar_user"]?>" alt="User Avatar" class="avatar">
            <span class="full-name">Full Name</span>
            <button class="back" onclick="window.location='index.php'">Back to Home</button>
        </div>
    </div>

    <div class="container">
        <h1>My Read List</h1>
        <button id="toggle-mode">View My Posts</button>

        <div class="post-list">
            <?php
            session_start();
            $data_all_posts = $_SESSION['data_all_posts'];
            // if ($mode === 'my_posts') {
            //     $user_id = $_SESSION['user_id'];

            // } else {
                
            // }

            foreach ($data_all_posts as $post) {
              // print_r($post);
                echo "<div class='post'>
                          <div class='post-header'>
                              <h3 class='author'>" . $post['full_name'] . "</h3></br>
                              <p >@".$post['user_name']."</p>
                              <span class='time'>" . $post['time_create'] . "</span>
                              <button class='options'>Options</button>
                          </div>
                          <h2>" . $post['title_post'] . "</h2>
                          <p>" . $post['content'] . "</p>
                      </div>";
            }
            ?>
        </div>
    </div>
</body>
</html>