
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/index.css">
  <title>Blog</title>
</head>
<?php 
    session_start();
    if($_SESSION["user_id"]) {
      $_SESSION["access_token"] = True;
      $data_user = $_SESSION["data_user"];
      $data_user["avatar_user"] = $data_user["avatar_user"] ? $data_user["avatar_user"] : "images/default_avatar.png";
    }else {
      $_SESSION["access_token"] = False;

    }
    ?>
<body>

  <div class="header">
    <div class="header_c">
      <img src="https://img.icons8.com/?size=200&id=81252&format=png&color=000000" alt="Icon">
      <form method="post" action="">
        <input 
          type="search"
          name="input_search" 
          id="input_search"
          placeholder="Search..."
        />
        <input type="submit" value="Search" name="submit"/>
      </form>
    </div>
    <div class="header_c">
      <form class="nav-links" method = "post">
      <?php
        if ($_SESSION["access_token"]) {
          echo "<div class='nav-links'>
                  <button type='submit' name='write_post' id='write_post'>Write Post</button>
                  <button type='submit' name='notification' id='notification'>
                    <img width='48' height='48' src='https://img.icons8.com/clr-gls/48/alarm.png' alt='alarm'/>
                  </button>
                  <button type='button' name='account' id='account'>
                    <img  src='".$data_user["avatar_user"]."' alt='user-female-circle' class= 'avatar'/>
                  </button>
                </div>";
        } else {
          echo "<div class='nav-links'>
                  <button type='submit' name='sign_in' id='sign_in'>Sign In</button>
                  <button type='submit' name='create_account' id='create_account'>Create Account</button>
                </div>";
        }
      ?>
      </form>
    </div>
  </div>
  <div class="main">
    <form class="body_page" method="post">
      <button type="submit" class="c_body_page">
        <img src="https://img.icons8.com/?size=100&id=wV09Rqzv7s8J&format=png&color=000000" alt="icon_home">
        Home
      </button>
      <button type="submit" class="c_body_page">
        <img src="https://img.icons8.com/?size=100&id=91299&format=png&color=000000" alt="icon_contact">
        Contact
      </button>
      <button type="submit" class="c_body_page">
        <img src="https://img.icons8.com/?size=100&id=110481&format=png&color=000000" alt="icon_about">
        About
      </button>
      <button type="submit" name="read_list" class="c_body_page">
        <img src="https://img.icons8.com/?size=50&id=774&format=png&color=FA5252" alt="icon_read_lists">
        Read Lists
      </button>
      <button type="submit" class="c_body_page">
        <img src="https://img.icons8.com/?size=50&id=42913&format=png&color=000000" alt="icon_FAQ">
        FAQ
      </button>
    </form>
    <div class="dialog" id="dialog">
        <form class="dialog_f" action="" method="post">
        <h1><?php echo $_SESSION["data_user"]["full_name"]?></h1>
        <hr>
        <div class="g_b_d">
          <button class="b_d" type="submit" name ="edit_profile">Edit Profile</button>
          <button class="b_d" type="submit" name="logout">Logout</button>
        </div>
        </form>

        
    </div>
  </div>
  <?php
    if(isset($_POST["sign_in"]) ){
    echo "Anchor";
    header("Location: http://localhost/intern_OLM_PHP/myBioPHP/login.php");
    exit();
    }
    if(isset($_POST["create_account"]) ){
    echo "Anchor";
    header("Location: http://localhost/intern_OLM_PHP/myBioPHP/register.php");
    exit();
    }
    if(isset($_POST["logout"]) ){
      
      $_SESSION["user_id"] = NULL;
      $_SESSION["access_token"] = False;
      $_SESSION["data_user"]= NULL;
      $_SESSION["data_all_posts"] = NULL;
      header("Refresh:0");
    }
    if(isset($_POST["write_post"]) ){
      header("Location: http://localhost/intern_OLM_PHP/myBioPHP/write_post.php");
      exit();
    }
    if(isset($_POST["read_list"]) ){
      header("Location: http://localhost/intern_OLM_PHP/myBioPHP/read_list.php");
      exit();
    }
    if(isset($_POST["edit_profile"]) ){
      header("Location: http://localhost/intern_OLM_PHP/myBioPHP/profile.php");
      exit();
    }
  ?>
  <script>
    account  =true;

    document.getElementById("account").addEventListener("click", function(){
      account =!account; 
      if(account){
        document.getElementById("dialog").style.display="none";
      }else {
        document.getElementById("dialog").style.display="flex";
      }
    })
  </script>
</body>
</html>