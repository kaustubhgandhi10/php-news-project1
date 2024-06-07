<?php 

    include "config.php";

    session_start();

    if(!isset($_SESSION['username'])){
        header("Location: {$base_url}admin/");
    }

    $uri =  $_SERVER['REQUEST_URI'];
    $uri_arr = explode('/', $uri);
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
        <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <div id="navbar">
        <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container d-block">
            <div class="row">
                <div class="col-md-6 pt-2">
                    <?php 
                        $db = new database();
                        $db->select('settings', '*', null, null, null);
                        $result = $db->getResult();
                        if(count($result) > 0){
                            foreach($result as $row){
                                if($row['logo'] == ""){
                                    echo '<a href="index.php"><h1>'.$row['website_name'].'</h1></a>';
                                }else{
                                   echo '<a href="index.php" id="logo"><img src="images/'.$row['logo'] . '"></a>' ;
                                }
                            }
                        }
                    ?>
                </div>
                <div class="col-md-6  d-grid justify-content-end">
                <span class="user-name">Hello <?php echo $_SESSION["username"] ?>, </span><a href="logout.php" class="btn btn-outline-success  bd-highlight" type="submit">Log Out</a>
                </div>
            </div>
        </div>
        </nav>
    </div>


    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link <?php if($uri_arr[2] == 'dashboard.php') echo 'active'; ?>" aria-current="page" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($uri_arr[2] == 'category.php') echo 'active'; ?>" href="category.php">Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($uri_arr[2] == 'posts.php') echo 'active'; ?>" href="posts.php">Post</a>
                        </li>
                        <?php if($_SESSION['uid'] == '1'){ ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if($uri_arr[2] == 'users.php') echo 'active'; ?>" href="users.php">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($uri_arr[2] == 'settings.php') echo 'active'; ?>" href="settings.php">Settings</a>
                        </li>
                        <?php } ?> 
                    </ul>
                </div>
            </div>
        </div>
    </div>
