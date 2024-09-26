<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profile.css">
    <title>Edit Profile</title>
</head>
<body>

<div class="header">
    <h2>Edit Profile</h2>
    <button onclick="window.location.href='index.php'">Back to Home</button>
</div>

<div class="profile-container">
    <?php
    session_start();
      $user_id = $_SESSION["user_id"];

    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" id="full_name" value="<?php echo htmlspecialchars($data_user['full_name']); ?>">
        </div>
        
        <div class="form-group">
            <label for="avatar">Upload Avatar</label>
            <input type="file" name="avatar" id="avatar" accept="image/*">
        </div>

        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" name="pass_word" id="password">
        </div>

        <button type="submit" name="update_profile">Update Profile</button>
    </form>
</div>
<?php 
  require __DIR__. "/../config/mySql.php";

  $sql = new MySql();
  $full_name = $_POST['full_name'];
  $avatar = $_FILES['avatar'];
  $password = $_POST['password'];
if (isset($_POST['update_profile'])) {
    if (!empty($full_name) && ($full_name != $data_user["user_name"])) {
    $result = $sql->update_full_name((int) $user_id, $full_name);
    $_SESSION["data_user"]["full_name"] = $full_name;
  } else {
    }
}
    if($_FILES['avatar']["name"] != null) {
    $target_dir = "images/";
    $target_file = $target_dir. basename($avatar["name"]);
    $result = $sql->update_avatar((int) $user_id, $target_dir.$avatar["name"] );
    if($result) {
      unlink($_SESSION["data_user"]["avatar_user"]);
      $data_user = $_SESSION["data_user"];
      move_uploaded_file($avatar["tmp_name"], $target_dir.$data_user["user_name"].$avatar["name"]);
      $_SESSION["data_user"]["avatar_user"] = "images/".$data_user["user_name"].$avatar["name"];
    }
    }

if (isset($_POST["pass_word"])) {
    if (strlen($password) < 6) {
      // echo "Password must be at least 6 characters long.";
    } else {
      $result = $sql->update_password((int) $user_id, md5($i_password));
    }
  }

?>
</body>
</html>