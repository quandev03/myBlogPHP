<?php 
  class MySql {
    private $USERNAME = "root";
    private $PASSWORD = "root";
    private $SERVER_NAME = "localhost:3306";
    private $DB_NAME = "my_blog";

    

    private function connection_sql() {
      try {
          $connect = new PDO(
              "mysql:host=" . $this->SERVER_NAME . ";dbname=" . $this->DB_NAME, 
              $this->USERNAME, 
              $this->PASSWORD
          );

          $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          return $connect;
      } catch (PDOException $e) {
          return "Connection failed: " . $e->getMessage();
      }
  }
    public function add_user(String $username, String $pass_word, String $email, String $full_name){
      try {
        $sql = "INSERT INTO users (user_name, pass_word, email, full_name) VALUES (:user_name, :pass_word, :email, :full_name)";
        $conn = $this->connection_sql();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_name', $username);
        $stmt->bindParam(':pass_word', $pass_word);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':full_name', $full_name);
        $stmt->execute();
        return "Successfully added user";
    } catch (PDOException $e) {
      echo $e -> getMessage();
    }



    }
  public function get_user(String $username)
  {
    try {
      $sql = "SELECT user_name, pass_word, id FROM users WHERE user_name = :user_name";
      $conn = $this->connection_sql();
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':user_name', $username);
      $stmt->execute();
      return  $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
      return $e->getMessage();
    }

  }
  public function get_data_user(int $user_id){
    try {
      $sql = "SELECT user_name, full_name, avatar_user FROM users WHERE id = :user_id";
      $conn = $this->connection_sql();
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':user_id', $user_id);
      $stmt->execute();
      return  $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }
  public function add_a_post(String $title, String $content, int $user_id):Bool {
    try {
      $sql = "INSERT INTO posts (title_post, content, user_id) VALUES (:title_post, :content, :user_id)";
      $conn = $this->connection_sql();
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':title_post', $title, PDO::PARAM_STR);
      $stmt->bindParam(':content', $content, PDO::PARAM_STR);
      $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
      $stmt->execute();
      return True;
    } catch (PDOException $e) {
      echo $e->getMessage();
      return False;
    }
  }
  public function get_all_posts()
  {
    try {
      $sql = "SELECT id, title_post, content, time_create, user_id FROM posts ORDER BY time_create DESC";
      $conn = $this->connection_sql();
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      return  $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }
  public function get_post_by_id(int $post_id){
    try {
      $sql = "SELECT id, title_post, content, ctime_create FROM posts WHERE id = :post_id";
      $conn = $this->connection_sql();
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':post_id', $post_id);
      $stmt->execute();
      return  $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }
  public function get_info_user_add_post(int $user_id)
  {
     try {
      $sql = "SELECT user_name, full_name FROM users WHERE id = :user_id";
      $conn = $this->connection_sql();
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':user_id', $user_id);
      $stmt->execute();
      return  $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }
  public function update_full_name(int $user_id, string $full_name) {
    try {
      $sql = "UPDATE users SET full_name = :full_name WHERE id = :user_id";
      $conn = $this->connection_sql();
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':full_name', $full_name, PDO::PARAM_STR);
      $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
      $stmt->execute();
      return True;
    } catch (PDOException $e) {
      echo $e->getMessage();
      return False;
    }
  }
  public function update_avatar(int $user_id, string $avatar_name)
  {
    try {
      $sql = "UPDATE users SET avatar_user = :avatar_name WHERE id = :user_id";
      $conn = $this->connection_sql();
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':avatar_name', $avatar_name, PDO::PARAM_STR);
      $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
      $stmt->execute();
      return True;
    } catch (PDOException $e) {
      echo $e->getMessage();
      return False;
    }
  }
  public function update_password(int $user_id, string $password){
    try {
      $sql = "UPDATE users SET pass_word = :pass_word WHERE id = :user_id";
      $conn = $this->connection_sql();
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':pass_word', $password, PDO::PARAM_STR);
      $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
      $stmt->execute();
      return True;
    } catch (PDOException $e) {
      echo $e->getMessage();
      return False;
    }
  }

  }
?>