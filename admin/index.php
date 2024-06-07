<?php 
  include "config.php";
  
  session_start();

  if(isset($_SESSION["username"])){
    header("location: {$base_url}admin/dashboard.php");
  }
  


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <title>ADMIN | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
  <div class="login-container">
    <h2>Login</h2>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
      <div class="form-group mb-4">
        <input type="text" class="form-control"   name="username" id="username" placeholder="Username" required>
      </div>
      <div class="form-group mb-4">
        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
      </div>
      <input type="submit" class="btn btn-primary btn-block btn-login" name="login"/>
    </form>
    <?php 
      if(isset($_POST['login'])){

        if(empty($_POST['username']) || empty($_POST['password'])){
          echo "<div class='alert alert-danger'>All fields must be entered</div>";
          die();
        }else{
          $db= new database();
          $username = $db->escapeString($_POST['username']);
          $password = md5($db->escapeString($_POST['password']));

          $db->select("users",'id,full_name',null, "username = '$username' AND password = '$password'", null, 0 );
          $result = $db->getResult();
          if(!empty($result)){
            session_start();

            $_SESSION['username'] = $username;
            $_SESSION['uid'] = $result[0]['id'];

           header("Location: {$base_url}admin/dashboard.php");

          }
          
        }
      }
    
    
    ?>
  </div>
</div>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
